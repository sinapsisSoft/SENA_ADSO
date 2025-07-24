/*
  author: Diego Casallas
  date: 14/07/2025  
  description: Backend application using Node.js and MongoDB.
  version: 1.0.0    
  license: MIT License
*/
import UserModel from '../models/user.model.js';//Import the UserModel
import dotenv from 'dotenv';

dotenv.config();

class UserController {
  // User registration
  async addUser(req, res) {
    const passwordRegex = /^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/;
    try {
      const { username, email, password } = req.body;
      if (!username || !email || !password) {
        return res.status(400).json({ error: 'All data is mandatory for entry' });
      }
      if (!passwordRegex.test(password)) {
        return res.status(400).json({ error: 'The password must be between 8 and 16 characters long, with at least one digit, at least one lowercase letter, at least one uppercase letter, and at least one non-alphanumeric character.' });
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

  // Users list
  async show(req, res) {
    try {
      const userModel = await UserModel.find();
      if (!userModel) throw new Error('User not found');
      return res.status(200).json({ data: userModel });
    } catch (err) {
      res.status(400).json({ error: err.message });
    }
  };

  // Find user by ID
  async findById(req, res) {
    try {
      const id = req.params.id;
      if (!id) {
        return res.status(400).json({ error: 'User Id is required' });
      }
      const userModel = await UserModel.findOne({ _id: id });
      if (!userModel) throw new Error('User not found');
      return res.status(200).json({ data: userModel });
    } catch (err) {
      res.status(400).json({ error: err.message });
    }
  };

  // User update
  async update(req, res) {
    const passwordRegex = /^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/;
    try {
      const { username, email, password } = req.body;
      if (!username || !email || !password) {
        return res.status(400).json({ error: 'All data is mandatory for entry' });
      }
      if (!passwordRegex.test(password)) {
        return res.status(400).json({ error: 'The password must be between 8 and 16 characters long, with at least one digit, at least one lowercase letter, at least one uppercase letter, and at least one non-alphanumeric character.' });
      }
      const existingUserModel = await UserModel.findOne({ email });
      if (!existingUserModel) {
        return res.status(400).json({ error: 'User not found' });
      }
      const updateUser = await UserModel.findOneAndUpdate(
        { _id: req.params.id }, // Filtro
        { username, password }, // Datos nuevos
        { new: true } // Devuelve el documento actualizado
      );
      if (!updateUser) {
        return res.status(404).json({ error: 'User not updated' });
      }
      res.status(200).json(updateUser);
    } catch (error) {
      res.status(400).json({ error: error.message });
    }
  };

  // User deletion
  async delete(req, res) {
    try {
      const deletedUser = await UserModel.findOneAndDelete({
        _id: req.params.id
      });
      if (!deletedUser) {
        return res.status(404).json({ error: 'User not updated' });
      }
      res.status(200).json({ message: 'Deleted successfully' });
    } catch (error) {
      res.status(500).json({ error: 'Error deleting user' });
    }
  };

}
export default new UserController();