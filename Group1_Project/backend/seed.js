// using axios here because it's easier for multiple API calls than fetch
const axios = require("axios");
const dotenv = require("dotenv");
const pool = require("./db");

dotenv.config();

// API settings
const BASE_URL = process.env.PERENUAL_BASE_URL;
const API_KEY = process.env.PERENUAL_API_KEY;

// ---- Seeding settings ----
const TARGET_INDOOR_COUNT = 80;
const PER_PAGE = 30;               // max allowed by Perenual
const MAX_DETAIL_REQUESTS = 95;    // in order to stay under free limit (~100/day)

// ---- Network settings ----
const REQUEST_TIMEOUT_MS = 8000; // 8s timeout

const axiosInstance = axios.create({
  timeout: REQUEST_TIMEOUT_MS,
});

// small wait to avoid hammering api
function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

// ---------------------- FETCH HELPERS ------------------------

async function fetchSpeciesListPage(page) {
  const url = `${BASE_URL}/species-list?key=${API_KEY}&indoor=1&page=${page}&per_page=${PER_PAGE}`;
  const res = await axiosInstance.get(url);
  return res.data.data || [];
}

async function fetchSpeciesDetails(id) {
  const url = `${BASE_URL}/species/details/${id}?key=${API_KEY}`;
  const res = await axiosInstance.get(url);
  return res.data;
}


// ---------------------- MAPPING ------------------------

function mapPlantToRow(plant) {
  if (!plant.id) return null; // cannot insert without PK

  const sciName = plant.scientific_name?.[0] || null;

  const sunlight = Array.isArray(plant.sunlight)
    ? plant.sunlight[0]
    : plant.sunlight || null;

  const imageUrl = plant.default_image?.original_url || null;

  // convert height to cm
  let maxHeightCm = null;
  const dim = plant.dimensions?.[0];

  if (dim?.max_value && dim.unit) {
    const unit = dim.unit.toLowerCase();
    if (unit.includes("feet") || unit.includes("foot")) {
      maxHeightCm = Math.round(dim.max_value * 30.48);
    } else if (unit.includes("cm")) {
      maxHeightCm = Math.round(dim.max_value);
    }
  }

  const careLevel = plant.care_level || plant.maintenance || null;

  // If the plant is unusable for filtering, or for displaying the detailed info, skip it
 if (!plant.watering || !sunlight || !careLevel || !imageUrl || !plant.description) {
  return null;
}

  return {
    id: plant.id,
    common_name: plant.common_name ?? null,
    scientific_name: sciName,
    watering: plant.watering || null,
    sunlight,
    care_level: careLevel,
    poisonous_to_pets: plant.poisonous_to_pets ?? null,
    max_height_cm: maxHeightCm,
    image_url: imageUrl,
    description: plant.description || null,
  };
}

// ---------------------- INSERT ------------------------

async function insertPlant(row) {
  const sql = `
    INSERT INTO plants (
      id, common_name, scientific_name, watering, sunlight, 
      care_level, poisonous_to_pets, max_height_cm, image_url, description
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ON DUPLICATE KEY UPDATE
      common_name = VALUES(common_name),
      scientific_name = VALUES(scientific_name),
      watering = VALUES(watering),
      sunlight = VALUES(sunlight),
      care_level = VALUES(care_level),
      poisonous_to_pets = VALUES(poisonous_to_pets),
      max_height_cm = VALUES(max_height_cm),
      image_url = VALUES(image_url),
      description = VALUES(description)
  `;

  const params = [
    row.id,
    row.common_name,
    row.scientific_name,
    row.watering,
    row.sunlight,
    row.care_level,
    row.poisonous_to_pets,
    row.max_height_cm,
    row.image_url,
    row.description,
  ];

  await pool.execute(sql, params);
}

// ---------------------- MAIN LOOP ------------------------

async function runSeed() {
  try {
    console.log("Starting seeding from Perenual...");
    console.log(`Target: ${TARGET_INDOOR_COUNT} | PER_PAGE=${PER_PAGE}`);

    let page = 1;
    let totalInserted = 0;
    let totalDetailRequests = 0;

    while (totalInserted < TARGET_INDOOR_COUNT) {
      console.log(`\nFetching species list page ${page}...`);

      let list;
      try {
        list = await fetchSpeciesListPage(page);
      } catch (err) {
        console.error(`Failed to fetch species list page ${page}:`, err.message);
        break;
      }

      if (!list || list.length === 0) {
        console.log("No more plants returned from species-list. Stopping.");
        break;
      }

      for (const item of list) {
        if (totalInserted >= TARGET_INDOOR_COUNT) break;
        if (totalDetailRequests >= MAX_DETAIL_REQUESTS) {
          console.log(`Max detail requests reached: ${MAX_DETAIL_REQUESTS}`);
          break;
        }

        console.log(`Fetching details for ${item.id} (${item.common_name})`);

        let detail;
        try {
          detail = await fetchSpeciesDetails(item.id);
          totalDetailRequests++;
        } catch (err) {
          console.error(`Failed details for ${item.id}:`, err.message);
          totalDetailRequests++;
          continue;
        }

        const row = mapPlantToRow(detail);
        if (!row) {
          console.log(`Skipping ${item.id} (missing required fields)`);
          continue;
        }

        await insertPlant(row);
        totalInserted++;

        console.log(` Inserted ${item.id}. Now: ${totalInserted}/${TARGET_INDOOR_COUNT}`);

        await sleep(200);
      }

      if (totalDetailRequests >= MAX_DETAIL_REQUESTS) break;
      page++;
    }

    console.log(`\nDone. Inserted: ${totalInserted}. Details used: ${totalDetailRequests}.`);
    process.exit(0);
  } catch (err) {
    console.error("Unexpected error:", err);
    process.exit(1);
  }
}

runSeed();
