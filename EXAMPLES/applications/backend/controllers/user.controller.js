import UserModel from '../models/user.model.js';
import { encryptPassword, comparePassword } from '../library/appBcrypt.js';
import jwt from "jsonwebtoken";
import dotenv from 'dotenv';
dotenv.config();
class UserController {

  async register(req, res) {
    try {
      const { username, email, password_hash, status_id} = req.body;
      // Basic validation
      if (!username || !email || !password_hash || !status_id) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }
      // Additional validation
      if (password_hash.length < 8) {
        return res.status(400).json({
          error: 'The password must be at least 8 characters long.'
        });
      }
      // Verify if the User already exists
      const existingUser = await UserModel.findByName(username);
      if (existingUser) {
        return res.status(409).json({
          error: 'The username is already in use'
        });
      }
      const passwordHash = await encryptPassword(password_hash);
      const userId = await UserModel.create({
        username,
        email,
        passwordHash,
        statusId: status_id
      });
      res.status(201).json({
        message: 'User created successfully',
        id: userId
      });
    } catch (error) {
      console.error('Registration error:', error);
      res.status(500).json({ error: 'Internal Server Errorr' });
    }
  }

  async show(req, res) {
    try {
      // Verify if the User already exists
      const userModel = await UserModel.showActive();
      if (!userModel) {
        return res.status(409).json({ error: 'The User no already exists' });
      }
      res.status(201).json({
        message: 'User successfully',
        data: userModel
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }

  async update(req, res) {
    try {
         const {  email,  status_id} = req.body;
         const id = req.params.id;
      // Basic validation
      if (!email || !status_id|| !id) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }
      // Verify if the User already exists  
      const existingUser = await UserModel.findByIdActive(id);
      if (existingUser.length === 0) {
        return res.status(409).json({ data:'',error: 'The User no already exists' });
      }   

      const updateUserModel = await UserModel.update(id, { email, status_id});
      res.status(201).json({
        message: 'User update successfully',
        data: updateUserModel

      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }

  async delete(req, res) {
    try {
      const id = req.params.id;
      // Basic validate
      if (!id) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }
      // Verify if the User already exists
      const deleteUserModel = await UserModel.delete(id);
      res.status(201).json({
        message: 'User delete successfully',
        data: deleteUserModel
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }

  async findById(req, res) {
    try {
      const id = req.params.id;
      // Basic validate
      if (!id) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }
      // Verify if the User already exists
      const existingUserModel = await UserModel.findByIdActive(id);
      if (!existingUserModel) {
        return res.status(409).json({ error: 'The User No already exists' });
      }
      res.status(201).json({
        message: 'User successfully',
        data: existingUserModel
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }

  async login(req, res) {
    try {
      const { user, password } = req.body;
      // Basic validate
      if (!user || !password) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }
      // Check if the user already exists
      const existingUser = await UserModel.findByName(user);
      if (existingUser) {
        const passwordHash = await comparePassword(password, existingUser.password_hash);
        if (!passwordHash) {
          return res.status(401).json({ error: 'Invalid password' });
        } else {
          const updateLogin = await UserModel.updateLogin(existingUser.id);
          if (!updateLogin) {
            return res.status(500).json({ error: 'Failed to update login time' });
          }
          const token = jwt.sign({ id: existingUser.id, email: existingUser.email, status: existingUser.status_id }, process.env.JWT_SECRET, {
            expiresIn: "1h",
            algorithm: "HS256"
          });
          res.status(200).json({
            message: 'Login successful',
            user: {
              id: existingUser.id,
              username: existingUser.username,
              email: existingUser.email,
              statusId: existingUser.statusId,
              token: token
            }
          });
        }
      } else {
        return res.status(404).json({ error: 'User not found' });
      }
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }
}

export default new UserController();