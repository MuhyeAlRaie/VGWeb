const express = require('express');
const app = express();
const bodyParser = require('body-parser');
const fs = require('fs');
const cors = require('cors'); // Import the CORS middleware

const PORT = 3000;

app.use(bodyParser.json());
app.use(cors()); // Enable CORS for all routes

app.get('/apartments', (req, res) => {
    fs.readFile('apartments.json', 'utf8', (err, data) => {
        if (err) {
            console.error(err);
            res.status(500).json({ error: 'Internal Server Error' });
            return;
        }
        const apartments = JSON.parse(data);
        res.json(apartments);
    });
});

app.put('/apartments', (req, res) => {
    const newData = req.body;
    fs.writeFile('apartments.json', JSON.stringify(newData, null, 2), 'utf8', (err) => {
        if (err) {
            console.error(err);
            res.status(500).json({ error: 'Internal Server Error' });
            return;
        }
        res.json({ success: true });
    });
});

app.listen(PORT, () => {
    console.log(`CMS server is running on http://localhost:${PORT}`);
});
