-- database that has the table that stores the api json data
CREATE DATABASE plantsdb;

USE plantsdb;

SELECT * FROM plants;

SELECT care_level, COUNT(*) FROM plants GROUP BY care_level;

SELECT watering, COUNT(*) FROM plants GROUP BY watering;

SELECT poisonous_to_pets, COUNT(*) FROM plants GROUP BY poisonous_to_pets;

SELECT 
  COUNT(*) AS total,
  SUM(image_url IS NULL) AS no_image,
  SUM(description IS NULL) AS no_description
FROM plants;

SELECT COUNT(*) FROM plants;

DELETE FROM plants
WHERE image_url IS NULL
   OR description IS NULL;

CREATE TABLE plants (
  id INT PRIMARY KEY,  --  plant id from Perenual 
  common_name VARCHAR(255),        
  scientific_name VARCHAR(255),    -- scientific na,e, sometimes empty
  watering VARCHAR(100),  -- "Frequent", "Average", "Minimum" ...
  sunlight VARCHAR(100),-- only storing first sunlight value for now (nut api gives an array like full shade, partial shade, need to change this later)
  care_level VARCHAR(100),  -- "Easy", "Medium", "Difficult"...
  poisonous_to_pets BOOLEAN,    -- api's true/false that sql stoers as tinyint 1/0
  max_height_cm INT,     -- height 
  image_url VARCHAR(500),   -- plant image
  description TEXT                 --  long paragraph description form species/details
);

SELECT * FROM plants;