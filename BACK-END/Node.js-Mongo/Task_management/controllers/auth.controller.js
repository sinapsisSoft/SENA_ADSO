
/*
  author: Diego Casallas
  date: 14/07/2025  
  description: Backend application using Node.js and MongoDB.
  version: 1.0.0    
  license: MIT License
*/

import UserModel from '../models/user.model.js';// Import the user model
import jwt from 'jsonwebtoken';
import {  comparePassword } from '../library/appBcrypt.js';

import dotenv from 'dotenv';
dotenv.config();

class AuthController {
  //User registration
  async register(req, res) {
    try {
      const { username, email, password } = req.body;
      if (!username || !email || !password) {
        return res.status(400).json({ error: 'All fields are required' });
      }
      if (password.length < 6) {
        return res.status(400).json({ error: 'The password must be at least 6 characters long.' });
      }
      const existingUserModel = await UserModel.findOne({ email });
      if (existingUserModel) {
        return res.status(400).json({ error: 'The user already exists' });
      }
      const newUserModel = new UserModel({ username, email, password });
      await newUserModel.save();
      return res.status(201).json({ message: 'User successfully registered' });

    } catch (err) {
      res.status(400).json({ error: err.message });
    }
  };

// Login
  async login(req, res) {
    try {
      const { email, password } = req.body;
      const userModel = await UserModel.findOne({ email });
      if (!userModel) throw new Error('User not found');
      const isMatch = await comparePassword(password, userModel.password);
      if (!isMatch) throw new Error('Incorrect password');
      const token = jwt.sign({ id: userModel._id }, process.env.JWT_SECRET, { expiresIn: '1h' });
      res.cookie('token', token, { httpOnly: true });
      res.status(200).json({ message: 'Successful login', token: token });
    } catch (err) {
      res.status(400).json({ error: err.message });
    }
  };
}

export default new AuthController();