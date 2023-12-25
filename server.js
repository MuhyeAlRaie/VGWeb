const express = require('express');
const bodyParser = require('body-parser');
const app = express();
const PORT = process.env.PORT || 3000;

app.use(bodyParser.json());

app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});

// Sample route
app.get('/api/data', (req, res) => {
    // Logic to retrieve data from the database
    res.json({ message: 'Data retrieved successfully' });
  });

  const mongoose = require('mongoose');
const MONGODB_URI = 'your-mongodb-uri';

mongoose.connect(MONGODB_URI, { useNewUrlParser: true, useUnifiedTopology: true });

const db = mongoose.connection;

db.on('error', console.error.bind(console, 'MongoDB connection error:'));
db.once('open', () => {
  console.log('Connected to MongoDB');
});