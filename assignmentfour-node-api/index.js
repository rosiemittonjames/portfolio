const express = require('express');
const mysql = require('mysql2');
const dotenv = require('dotenv');

dotenv.config();

const app = express();
const PORT = process.env.PORT || 3000;

app.use(express.json());
app.use(express.urlencoded({ extended: true}));

const pool = mysql.createPool({
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_NAME
  });

  app.get('/', (req, res) => {
    res.send('Welcome!');
  });

  app.use((err, req, res, next) => {
    console.error(err.stack);
    res.status(500).send('Something went wrong!');
  });

  app.get('/pets', (req, res) => {
    pool.query('SELECT * FROM pets', (err, results) => {
      if (err) {
        console.error('Database query error:', err);
        return res.status(500).json({ error: 'Database query failed'});
      }
      res.status(200).json(results);
    });
  });

  app.post('/pets', (req, res) => {
    const pets = Array.isArray(req.body) ? req.body : [req.body];

    for(let p of pets) {
      if (!p.name || !p.animal || !p.gender) {
        return res.status(400).json({
          error: 'There is a missing required field: name, animal and gender'
        });
      }
    }

    const query = 'INSERT INTO pets (name, animal, breed, age, gender) VALUES ?';
    const values = pets.map(p => [p.name, p.animal, p.breed, p.age, p.gender]);

    pool.query(query, [values], (err, result) => {
      if (err) {
        console.error('Error inserting pet:', err);
        return res.status(500).json({ error: 'Failed to add a pet'});
      }

      res.status(201).json({
        message: `${result.affectedRows} pets added successfully`
      });
    });
  });

  app.delete('/pets/:id', (req, res) => {
    const petId = req.params.id; 

    const query = 'DELETE FROM pets WHERE pet_id = 4';
    pool.query(query, [petId], (err, result) => {
      if (err) {
        console.error('Error deleting pet:', err);
        return res.status(500).json({ error: 'Failed to delete pet'});
      }

      if (result.affectedRows === 0) {
        return res.status(404).json({ error: 'Pet not found'});
      }

      res.status(200).json({ message: 'Pet deleted successfully' });
    });
   });

   app.get('/pets/filter/:animal', (req, res) => { 
    const animalType = req.params.animal; 

    const query = 'SELECT * FROM pets WHERE animal = ?';
    pool.query(query, [animalType], (err, results) => {
      if (err) {
        console.error('Error filtering pets:', err);
        return res.status(500).json({ error: 'Failed to filter pets' });
      }

      if (results.length === 0) {
        return res.status(404).json({ message: `No ${animalType}s found`});
      }

      res.status(200).json(results);
    });
   });

  app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
  });