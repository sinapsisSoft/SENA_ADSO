import ModuleModel from '../models/module.model.js';

class ModuleController {

  async register(req, res) {
    try {
      const { name, route, icon, description, is_active } = req.body;
      // Basic validation
      if (!name || !route || !icon || !description || !is_active) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }

      const userId = await ModuleModel.create({
        name,
        route,
        icon, description, is_active
      });
      res.status(201).json({
        message: 'Module created successfully',
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
      const moduleModel = await ModuleModel.show();
      if (!moduleModel) {
        return res.status(409).json({ error: 'The module no already exists' });
      }
      res.status(201).json({
        message: 'Module successfully',
        data: moduleModel
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }

  async update(req, res) {
    try {
      const { name, route, icon, description, is_active } = req.body;
      const id = req.params.id;
      // Basic validation
      if (!name || !route || !icon || !description || !is_active || !id) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }

      const existingUser = await ModuleModel.findById(id);
      if (existingUser.length === 0) {
        return res.status(409).json({ data: '', error: 'The Module no already exists' });
      }

      const updateModuleModel = await ModuleModel.update(id, { name, route, icon, description, is_active });
      res.status(201).json({
        message: 'Module update successfully',
        data: updateModuleModel

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
      const deleteModuleModel = await ModuleModel.delete(id);
      res.status(201).json({
        message: 'Module delete successfully',
        data: deleteModuleModel
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
      const existingModuleModel = await ModuleModel.findById(id);
      if (!existingModuleModel) {
        return res.status(409).json({ error: 'The User Role No already exists' });
      }
      res.status(201).json({
        message: 'Module successfully',
        data: existingModuleModel
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }

  async modulesByUserRole(req, res) {
    try {
      const { user_id, route_id } = req.body;

      // Basic validation
      if (!user_id || !route_id) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }
      const getModules = await ModuleModel.findModulesByUserRole(user_id, route_id);
      if (!getModules) {
        return res.status(409).json({ error: 'The module no already exists' });
      }

      res.status(201).json({
        message: 'Get Module User Role successfully',
        data: getModules
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }
}

export default new ModuleController();