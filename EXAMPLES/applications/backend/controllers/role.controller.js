import RoleModel from '../models/role.model.js';

class RoleController {

  async register(req, res) {
    try {
      const { name, description, is_active } = req.body;
      // Basic validate
      if (!name || !description || !is_active ) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }
      // Create the new document type
      const RoleModelId = await RoleModel.create({
        name,
        description,
        is_active
      });
      res.status(201).json({ 
        message: 'Role created successfully',
        data:RoleModelId 
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }

  async show(req, res) {
    try {
      // Verify if the role model already exists
      const existingRoleModel = await RoleModel.show();
      if (!existingRoleModel) {
        return res.status(409).json({ error: 'The role model no already exists' });
      }
      res.status(201).json({ 
        message: 'Role model successfully',
        data:existingRoleModel 
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }
  
  async update(req, res) {
    try {
      const { name, description, is_active} = req.body;
      const id = req.params.id;  
      // Basic validate
      if (!name || !description || !id || !is_active) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }
      // Verify if the Role model already exists
      const updateRoleModel = await RoleModel.update(id,{name,description, is_active});
      if (!updateRoleModel) {
        return res.status(409).json({ error: 'The Role model already exists' });
      }
      res.status(201).json({ 
        message: 'Role model update successfully',
        data:updateRoleModel 
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
      // Verify if the document type already exists
      const deleteRoleModel = await RoleModel.delete(id);
      if (!deleteRoleModel) {
        return res.status(409).json({ error: 'The Role already exists' });
      }
      res.status(201).json({ 
        message: 'Role delete successfully',
        data:deleteRoleModel 
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
      // Verify if the Role already exists
      const existingRoleModel = await RoleModel.findById(id);
      if (!existingRoleModel) {
        return res.status(409).json({ error: 'The Rol No already exists' });
      }
      res.status(201).json({ 
        message: 'Rol successfully',
        data:existingRoleModel 
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }
}
export default new RoleController();