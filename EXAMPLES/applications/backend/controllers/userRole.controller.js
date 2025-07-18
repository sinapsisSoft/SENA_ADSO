import UserRoleModel from '../models/userRole.model.js';

class UserRoleController {

  async register(req, res) {
    try {
      const { user_id, role_id, status_id} = req.body;
      // Basic validation
      if (!user_id || !role_id || !status_id ) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }
      
      const userId = await UserRoleModel.create({
        user_id,
        role_id,
        status_id
      });
      res.status(201).json({
        message: 'User Role created successfully',
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
      const userRoleModel = await UserRoleModel.show();
      if (!userRoleModel) {
        return res.status(409).json({ error: 'The User  Role no already exists' });
      }
      res.status(201).json({
        message: 'User successfully',
        data: userRoleModel
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }

    async showRoleUser(req, res) {
    try {
      const id = req.params.id;
      const userRoleModel = await UserRoleModel.showRoleUser(id);
      if (!userRoleModel) {
        return res.status(409).json({ error: 'The User Role no already exists' });
      }
      res.status(201).json({
        message: 'User successfully',
        data: userRoleModel
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }

  async update(req, res) {
    try {
         const { user_id, role_id, status_id} = req.body;
         const id = req.params.id;
      // Basic validation
      if (!user_id || !role_id|| !status_id|| !id) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }
      // Verify if the User already exists  
      const existingUser = await UserRoleModel.findById(id);
      if (existingUser.length === 0) {
        return res.status(409).json({ data:'',error: 'The User Role no already exists' });
      }   

      const updateUserRoleModel = await UserRoleModel.update(id, { user_id, role_id, status_id });
      res.status(201).json({
        message: 'User update successfully',
        data: updateUserRoleModel

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
      const deleteUserRoleModel = await UserRoleModel.delete(id);
      res.status(201).json({
        message: 'User delete successfully',
        data: deleteUserRoleModel
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
      const existingUserRoleModel = await UserRoleModel.findById(id);
      if (!existingUserRoleModel) {
        return res.status(409).json({ error: 'The User Role No already exists' });
      }
      res.status(201).json({
        message: 'User successfully',
        data: existingUserRoleModel
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }

 
}

export default new UserRoleController();