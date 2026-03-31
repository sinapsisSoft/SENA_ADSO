import UserModel from '../models/user.model.js';


export const showUser = async (req, res) => {
  try {
    const userInstance = new UserModel();
    userInstance.showUser(res);
  } catch (error) {
    res.status(500).json({ error: "Error fetching users , details: error.message" });
  }
};

export const showUserId = async (req, res) => {
  try {
    const userInstance = new UserModel();
    userInstance.showUserById(res, req);
  } catch (error) {
    res.status(500).json({ error: "Error fetching users , details: error.message " });
  }
};

export const addUser = async (req, res) => {
  try {
    const userInstance = new UserModel();
    userInstance.addUser(req, res);
  } catch (error) {
    res.status(500).json({ error: "Error adding user", details: error.message });
  }
};

export const updateUser = async (req, res) => {
  try {
    const userInstance = new UserModel();
    userInstance.updateUser(req, res);
  } catch (error) {
    res.status(500).json({ error: "Error updating user", details: error.message });
  }
};

export const deleteUser = async (req, res) => {
  try {
    const userInstance = new UserModel();
    userInstance.deleteUser(req, res);
  } catch (error) {
    res.status(500).json({ error: "Error deleting user", details: error.message });
  }
};


