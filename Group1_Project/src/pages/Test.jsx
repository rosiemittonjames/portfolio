import { useState } from "react";
import { getPlantList } from "../services/perenualAPIs";

export function Test() {
  const [plants, setPlants] = useState([]);
// hard coded jsut to see if ti works
async function testBackend() {
  try {
    const filters = {
      watering: "Frequent",
      sunlight: "full sun",
      difficulty: "hard",
      petSafe: true,
      heightCategory: "tall"
    };

    const result = await getPlantList(filters);
    console.log("Plants from backend:", result);

    setPlants(result?.plants || result || []);
  } catch (err) {
    console.error("Error fetching plants:", err);
  }
}

  return (
    <div>
      <h1>Landing Page</h1>

      <button onClick={testBackend}>Test backend API</button>

      <div style={{ marginTop: "2rem" }}>
        {plants.map((p) => (
          <div
            key={p.id}
            style={{
              marginBottom: "2rem",
              padding: "1rem",
              border: "1px solid #ccc",
              borderRadius: "8px",
              maxWidth: "600px",
            }}
          >
            <h2>{p.common_name}</h2>

            {/* image */}
            {p.image_url && (
              <img
                src={p.image_url}
                alt={p.common_name}
                style={{ maxWidth: "100%", height: "auto", marginBottom: "1rem" }}
              />
            )}

            {/* description */}
            {p.description && (
              <p style={{ marginBottom: "0.5rem" }}>{p.description}</p>
            )}

            {/* some extra meta */}
            <p style={{ fontSize: "0.9rem", color: "#555" }}>
              Watering: {p.watering} | Sunlight: {p.sunlight} | Difficulty:{p.care_level}
            </p>
            <p style={{ fontSize: "0.9rem", color: "#555" }}>
              Pet safe: {p.poisonous_to_pets ? "poisonous" : "safe"}
            </p>
          </div>
        ))}
      </div>
    </div>
  );
}
