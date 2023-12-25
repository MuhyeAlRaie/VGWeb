const mongoose = require('mongoose');

const userSchema = new mongoose.Schema({
  username: {
    type: String,
    required: true,
    unique: true,
  },
  password: {
    type: String,
    required: true,
  },
  phone_number: {
    type: String,
    required: false,
  },
  email: {
    type: String,
    required: false,
  },
  position: {
    type: String,
    required: false,
  },
  // Add other fields as needed
});

const User = mongoose.model('User', userSchema);

module.exports = User;