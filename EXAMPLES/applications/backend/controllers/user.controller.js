import UserModel from '../models/user.model.js';
import { encryptPassword, comparePassword } from '../library/appBcrypt.js';

class UserController {

  async register(req, res) {
    try {
      const { username, email, password, status } = req.body;
      // Basic validation
      if (!username || !email || !password || !status) {
        return res.status(400).json({ error: 'Faltan campos obligatorios' });
      }
      // Additional validation
      if (password.length < 8) {
        return res.status(400).json({
          error: 'La contraseña debe tener al menos 8 caracteres'
        });
      }
      // Verify if the User already exists
      const existingUser = await UserModel.findByName(username);
      if (existingUser) {
        return res.status(409).json({
          error: 'El nombre de usuario ya está en uso'
        });
      }
      const passwordHash = await encryptPassword(password);
      const userId = await UserModel.create({
        username,
        email,
        passwordHash,
        statusId: status
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
      const { email, status } = req.body;
      const id = req.params.id;
      // Basic validate
      if (!email || !status || !id) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }

      const updateUserModel = await UserModel.update(id, { email, status });
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
          res.status(200).json({
            message: 'Login successful',
            user: {
              id: existingUser.id,
              username: existingUser.username,
              email: existingUser.email,
              statusId: existingUser.statusId,
              token: 'your_jwt_token_here' // Replace with actual JWT token generation logic
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