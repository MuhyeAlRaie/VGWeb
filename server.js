const express = require('express');
const bodyParser = require('body-parser');
const User = require('./models/User'); // Adjust the path as needed
const bcrypt = require('bcrypt');
const app = express();
const PORT = process.env.PORT || 3007;

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
const MONGODB_URI = 'mongodb+srv://admin:ae4EMn4nj7kxdkxE@cluster0.2qj4rzj.mongodb.net/?retryWrites=true&w=majority';

mongoose.connect(MONGODB_URI, { useNewUrlParser: true, useUnifiedTopology: true });

const db = mongoose.connection;

db.on('error', console.error.bind(console, 'MongoDB connection error:'));
db.once('open', () => {
  console.log('Connected to MongoDB');
});

// Login route
app.post('/api/login', async (req, res) => {
    const { username, password } = req.body;
  
    try {
      // Find the user by username
      const user = await User.findOne({ username });
  
      // Check if the user exists
      if (!user) {
        return res.status(401).json({ error: 'Invalid username or password' });
      }
  
      // Compare the provided password with the stored hashed password
      const isPasswordValid = await bcrypt.compare(password, user.password);
  
      if (isPasswordValid) {
        // Password is valid, you can generate a token here for authentication
        res.status(200).json({ message: 'Login successful' });
      } else {
        // Password is invalid
        res.status(401).json({ error: 'Invalid username or password' });
      }
    } catch (error) {
      console.error(error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  });
  
  app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
  });