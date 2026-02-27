// using promise  so we can do async/await
const mysql = require("mysql2/promise");
const dotenv = require("dotenv");

dotenv.config();

// create your own .env in the backend folder with your host, username, password and the plants db
const pool = mysql.createPool({
  host: process.env.DB_HOST,   
  user: process.env.DB_USER,   
  password: process.env.DB_PASS, 
  database: process.env.DB_NAME, 
});


module.exports = pool;