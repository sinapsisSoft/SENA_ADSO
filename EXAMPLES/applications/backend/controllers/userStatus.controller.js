import UserStatusModel from '../models/userStatus.model.js';

class UserStatusController {

  async register(req, res) {
    try {
      const { name, description } = req.body;
      // Basic validate
      if (!name || !description ) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }
      // Create the new User Status
      const UserStatusModelId = await UserStatusModel.create({
        name,
        description
      });
      res.status(201).json({ 
        message: 'User Status created successfully',
        data:UserStatusModelId 
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }

  async show(req, res) {
    try {
      // Verify if the User Status already exists
      const existingUserStatusModel = await UserStatusModel.show();
      if (!existingUserStatusModel) {
        return res.status(409).json({ error: 'The User Status no already exists' });
      }
      res.status(201).json({ 
        message: 'User Status successfully',
        data:existingUserStatusModel 
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }
  
  async update(req, res) {
    try {
      const { name, description} = req.body;
      const id = req.params.id;  
      // Basic validate
      if (!name || !description || !id) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }
      // Verify if the User Status already exists
      const updateUserStatusModel = await UserStatusModel.update(id,{name,description});
      if (!updateUserStatusModel) {
        return res.status(409).json({ error: 'The User Status already exists' });
      }
      res.status(201).json({ 
        message: 'User Status update successfully',
        data:updateUserStatusModel 
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
      // Verify if the User Status already exists
      const deleteUserStatusModel = await UserStatusModel.delete(id);
      if (!deleteUserStatusModel) {
        return res.status(409).json({ error: 'The User Status already exists' });
      }
      res.status(201).json({ 
        message: 'User Status delete successfully',
        data:deleteUserStatusModel 
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
      if (!id ) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }
      // Verify if the User Status already exists
      const existingUserStatusModel = await UserStatusModel.findById(id);
      if (!existingUserStatusModel) {
        return res.status(409).json({ error: 'The User Status No already exists' });
      }
      res.status(201).json({ 
        message: 'User Status successfully',
        data:existingUserStatusModel 
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }
}
export default new UserStatusController();