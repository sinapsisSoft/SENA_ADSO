import RoleModel from '../models/role.model.js';

export const showRole = async (req, res) => {
  try {
    const roleModel = new RoleModel();
    roleModel.showRole(res);
  } catch (error) {
    res.status(500).json({ error: "Error fetching Roles", details: error.message });
  }
};

export const showRoleId = async (req, res) => {
  try {
    const roleModel = new RoleModel();
    roleModel.showRoleById(res, req);

  } catch (error) {
    res.status(500).json({ error: "Error fetching Role", details: error.message });
  }
};

export const addRole = async (req, res) => {
  try {
    const roleModel = new RoleModel();
    roleModel.addRole(req, res);

  } catch (error) {
    res.status(500).json({ error: "Error adding Role", details: error.message });
  }
};

export const updateRole = async (req, res) => {
  try {
    const roleModel = new RoleModel();
    roleModel.updateRole(req, res);

  } catch (error) {
    res.status(500).json({ error: "Error updating Role", details: error.message });
  }
};

export const deleteRole = async (req, res) => {
  try {
    const roleModel = new RoleModel();
    roleModel.deleteRRole(req, res);
    
  } catch (error) {
    res.status(500).json({ error: "Error deleting Role", details: error.message });
  }
};


