// functions for calling our own backend API
// the actual perenual key is on the backend side, so frontend never exposes it
//  VITE_BACKEND_URL should be in another .env at root

export async function getPlantList(filters = {}) {
  const baseUrl = import.meta.env.VITE_BACKEND_URL;

  // beuilding the query string
  const params = new URLSearchParams();

  if (filters.watering) params.set("watering", filters.watering);
  if (filters.sunlight) params.set("sunlight", filters.sunlight);
  if (filters.difficulty) params.set("difficulty", filters.difficulty);

  // petSafe only  sent if usr wants safe for pets
  if (filters.petSafe === true) {
    params.set("petSafe", "true");
  }

  if (filters.heightCategory) {
  params.set("heightCategory", filters.heightCategory);
}

  // final url
  const url = `${baseUrl}/plants?${params.toString()}`;


  const res = await fetch(url);


  if (!res.ok) {
    throw new Error("Failed to fetch plants from backend");
  }

  // return  fitlered plants array
  return await res.json();
}
