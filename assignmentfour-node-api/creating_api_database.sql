CREATE DATABASE pet_adoption;

USE pet_adoption;

CREATE TABLE pets (
  pet_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  animal VARCHAR(255) NOT NULL,
  breed VARCHAR(255),
  age INT,
  gender CHAR(1) NOT NULL
);

INSERT INTO pets (pet_id, name, animal, breed, age, gender)
VALUES 
(1, 'Alfie', 'Dog', 'Jack Russel', '4', 'M'), 
(2, 'Rosie', 'Dog', 'Cocker Spaniel', '3', 'F'), 
(3, 'Terry', 'Cat', 'British Shorthair', '1', 'M'), 
(4, 'Henry', 'Dog', 'Border Terrier', '12', 'M');


