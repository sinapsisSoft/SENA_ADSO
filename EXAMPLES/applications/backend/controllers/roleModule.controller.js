import RoleModuleModel from '../models/roleModule.model.js';

class RoleModuleController {

  async register(req, res) {
    try {
      const { module_fk, role_user_fk, can_view, can_create, can_edit, can_delete } = req.body;
      // Basic validate
      if (!module_fk || !role_user_fk || !can_view || !can_create || !can_edit || !can_delete ) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }
      // Create the new Module Role
      const RoleModuleModelId = await RoleModuleModel.create({
        module_fk, role_user_fk, can_view, can_create, can_edit, can_delete
      });
      res.status(201).json({ 
        message: 'Rol module created successfully',
        data:RoleModuleModelId 
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }

  async show(req, res) {
    try {
      // Verify if the Module Role already exists
      const existingRoleModuleModel = await RoleModuleModel.show();
      if (!existingRoleModuleModel) {
        return res.status(409).json({ error: 'The Module Role no already exists' });
      }
      res.status(201).json({ 
        message: 'Module Role successfully',
        data:existingRoleModuleModel 
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }
  
  async update(req, res) {
    try {
      const { module_fk, role_user_fk, can_view, can_create, can_edit, can_delete} = req.body;
      const id = req.params.id;  
      // Basic validate
      if (!module_fk || !role_user_fk || !can_view || !can_create || !can_edit || !can_delete || !id) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }
      // Verify if the Module Role already exists
      const updateRoleModuleModel = await RoleModuleModel.update(id,{module_fk, role_user_fk, can_view, can_create, can_edit, can_delete});
      if (!updateRoleModuleModel) {
        return res.status(409).json({ error: 'The Module Role already exists' });
      }
      res.status(201).json({ 
        message: 'Module Role update successfully',
        data:updateRoleModuleModel 
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
      // Verify if the Module Role already exists
      const deleteRoleModuleModel = await RoleModuleModel.delete(id);
      if (!deleteRoleModuleModel) {
        return res.status(409).json({ error: 'The Module Role already exists' });
      }
      res.status(201).json({ 
        message: 'Module Role delete successfully',
        data:deleteRoleModuleModel 
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
      // Verify if the Module Role already exists
      const existingRoleModuleModel = await RoleModuleModel.findById(id);
      if (!existingRoleModuleModel) {
        return res.status(409).json({ error: 'The Module Role No already exists' });
      }
      res.status(201).json({ 
        message: 'Module Role successfully',
        data:existingRoleModuleModel 
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }
}
export default new RoleModuleController();