# 🪴 Plant Pal

## CFG Degree - Fullstack - Goup One Project

Plant Pal is a fun, retro-themed web app that works like a dating app — but for houseplants.  
Users answer a playful questionnaire that helps match them with plants suited to their lifestyle, environment and preferences.  
The app uses the Perenual API to generate personalised recommendations and displays plant options in a swipe-style gallery, leading to a final shortlist of perfect matches.

This repo was created as part of the **CFG Full-Stack Group Assignment**, following the requirements to build a group project, design wireframes, collaborate via GitHub and ensure each team member contributes individually to `App.js`.

## 🩷 Project Details Document

All details about the project concept, branding, design choices, colour palette, wireframes, workflow, and API logic can be found in our proposal PDF:

**[View the project Details Document](ProjectDetailsDocument.pdf)**

## 🌿 Group App.js Commits

Each team member updated the `App.js` file with:
Name:
What your focus will be on the project:
Your relationship with plants:

### 📸 Screenshots of App.js Contributions

<img width="2672" height="5120" alt="screencapture-localhost-5174-2025-11-20-23_14_53" src="https://github.com/user-attachments/assets/aac84c8c-483b-4331-9edc-ace03f5ae1ab" />

## 🌱 How to Run the Project

```bash
npm install
npm run dev
```

## 🛠️ Backend Overview (NEW — added for this submission)

To reduce API calls and avoid hitting the free Perenual API daily limit, Plant Pal uses its own local backend:

**🌿 Node.js + Express server**
**🌿 MySQL database**
**🌿 Seed script that loads plant data from Perenual**
**🌿 Database filtering logic aligned with the quiz questions**
**🌿 Frontend communicates only with our backend (never directly with Perenual)**

This gives us:

**😁 faster responses**

**😁 stable results**

**😁 custom filtering logic**

**😁 fewer API token issues**

## 🚩 Backend Setup

1. Install backend dependencies

From inside backend/:

```bash
cd backend
npm install
```

2. Create the MySQL Database

Create the database and table:

```sql
CREATE DATABASE plantsdb;
USE plantsdb;

CREATE TABLE plants (
  id INT PRIMARY KEY,
  common_name VARCHAR(255),
  scientific_name VARCHAR(255),
  watering VARCHAR(100),
  sunlight VARCHAR(100),
  care_level VARCHAR(100),
  poisonous_to_pets BOOLEAN,
  max_height_cm INT,
  image_url VARCHAR(500),
  description TEXT
);
```

Or run the provided plantsDB.sql.

3. Backend Environment Variables

Create backend/.env:

```env
DB_HOST=localhost
DB_USER=your_user
DB_PASS=your_password
DB_NAME=plantsdb

PERENUAL_BASE_URL=https://perenual.com/api/v2
PERENUAL_API_KEY=your_perenual_key_here

PORT=4000
```

4. Seed the Local Database

##### The seed script does:

###### Fetch plant pages from species-list

###### For each plant ID, fetch full details from species/details/:id

###### Insert them into MySQL

##### Run:

`node seed.js`

5. Start the Backend Server
   `node server.js`

###### You should see:

**Backend server running on port 4000**

## Start the front end

Create a `.env` file in the project root (not in backend/):

```env
VITE_BACKEND_URL=http://localhost:4000
```

Then run:

```bash
cd ..
npm run dev
```

###### You should see:

group1_project@0.0.0 dev

> vite

VITE v7.2.2 ready in 214 ms
VITE v7.2.2 ready in 214 ms

➜ Local: http://localhost:5173/
➜ Network: use --host to expose
➜ Network: use --host to expose
➜ press h + enter to show help

## ☘️ Backend API Endpoints

GET /plants

Returns filtered plant results from MySQL.

Query params:

watering

sunlight

difficulty

petSafe=true (only safe plants)

heightCategories (in cm)

Example:

/plants?watering=Minimum&sunlight=extrovert&difficulty=easy&petSafe=true&heightCategory=average

GET /plants/:id

Returns a single plant by ID.

## ↔️ Frontend → Backend Flow

Frontend uses getPlantList(filters) from src/services/perenualAPIs.js.

The function builds a query string and calls:

The backend returns plants that match all answers.

## PLEASE REFER TO THE FILTER_MAPPING.md document for full mapping of frontend values to query params to DB
