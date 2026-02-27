const express = require("express");
const cors = require("cors");
const dotenv = require("dotenv");
const pool = require("./db"); // sql conneciton

dotenv.config();

const app = express();
app.use(cors());
app.use(express.json());

// Health check 
app.get("/", (req, res) => {
  res.send("Backend API is running");
});

// Main plants filtering 
app.get("/plants", async (req, res) => {
  try {
    const { watering, sunlight, difficulty, petSafe, heightCategory } = req.query;


    let sql = "SELECT * FROM plants WHERE 1=1";
    const params = [];

    // Q1 –Watering
    if (watering) {
      sql += " AND watering = ?";
      params.push(watering);
    }

    // Q2 – Difficulty 
    // "easy"  -> only Easy/Low plants
    // "hard"  -> Medium/Moderate OR Difficult/High plants
    if (difficulty) {
      if (difficulty === "easy") {
        sql += " AND care_level IN (?, ?)";
        params.push("Easy", "Low");
      } else if (difficulty === "hard") {
        sql += " AND care_level IN (?, ?, ?, ?)";
        params.push("Medium", "Moderate", "Difficult", "High");
      }
    }

   // Q3 – Sunlight 
  // "shy"       -> deep/full/filtered shade
  // "ambivert"  -> part shade + part sun/part shade
  // "extrovert" -> full sun
  if (sunlight) {
    if (sunlight === "shy") {
      sql += " AND sunlight IN (?, ?, ?)";
      params.push("deep shade", "full shade", "filtered shade");
    } else if (sunlight === "ambivert") {
      sql += " AND sunlight IN (?, ?)";
      params.push("part shade", "part sun/part shade");
    } else if (sunlight === "extrovert") {
      sql += " AND sunlight = ?";
      params.push("full sun");
    }
  }

    // Q4– Pet safty
    // petSafe comes as "true" when user wants only safe plants
    // in sql poisonous_to_pets is stored as 0 for fales or 1 for true
    if (petSafe === "true") {
      sql += " AND poisonous_to_pets = 0";
    }
    

    // Q5 – Height
    if (heightCategory) {
      switch (heightCategory) {
        case "short":
          // up to 40cm
          sql += " AND max_height_cm IS NOT NULL AND max_height_cm <= ?";
          params.push(40);
          break;
        case "average":
          // between 40 and 120cm
          sql += " AND max_height_cm IS NOT NULL AND max_height_cm > ? AND max_height_cm <= ?";
          params.push(40, 120);
          break;
        case "tall":
          // 120cm or more
          sql += " AND max_height_cm IS NOT NULL AND max_height_cm >= ?";
          params.push(120);
          break;
        default:
          // "any" or unknown → do nothing
          break;
      }
}

    const [rows] = await pool.execute(sql, params);
    res.json(rows);
  } catch (err) {
    console.error("Error in GET /plants:", err);
    res.status(500).json({ error: "Internal server error" });
  }
});

// get detail of plant by id
app.get("/plants/:id", async (req, res) => {
  try {
    const { id } = req.params;
    const [rows] = await pool.execute(
      "SELECT * FROM plants WHERE id = ?",
      [id]
    );

    if (rows.length === 0) {
      return res.status(404).json({ error: "Plant not found" });
    }

    res.json(rows[0]);
  } catch (err) {
    console.error("Error in GET /plants/:id:", err);
    res.status(500).json({ error: "Internal server error" });
  }
});

const PORT = process.env.PORT || 4000;

app.listen(PORT, () => {
  console.log(`Backend server running on port ${PORT} `);
});