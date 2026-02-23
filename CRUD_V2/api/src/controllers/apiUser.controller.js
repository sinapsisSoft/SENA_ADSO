import UserApiModel from '../models/userApi.model.js';

export const showApiUser = async (req, res) => {
  try {
    const userApiModel = new UserApiModel();
    userApiModel.showApiUser(req, res);
  } catch (error) {
    res.status(500).json({ error: "Error fetching users", details: error.message });
  }
};

export const showApiUserId = async (req, res) => {
  try {
    const userApiModel = new UserApiModel();
    userApiModel.showApiUserId(req, res);
  } catch (error) {
    res.status(500).json({ error: "Error fetching user", details: error.message });
  }
};

export const addApiUser = async (req, res) => {
  try {
    const userApiModel = new UserApiModel();
    userApiModel.addApiUser(req, res);

  } catch (error) {
    res.status(500).json({ error: "Error adding user", details: error.message });
  }
};

export const updateApiUser = async (req, res) => {
  try {
    const userApiModel = new UserApiModel();
    userApiModel.updateApiUser(req, res);
    
  } catch (error) {
    res.status(500).json({ error: "Error updating user", details: error.message });
  }
};

export const deleteApiUser = async (req, res) => {
  try {
    const userApiModel = new UserApiModel();
    userApiModel.deleteApiUser(req, res); 

  } catch (error) {
    res.status(500).json({ error: "Error deleting user", details: error.message });
  }
};

export const loginApiUser = async (req, res) => {
  try {
    const userApiModel = new UserApiModel();
    userApiModel.loginApiUser(req, res);
  } catch (error) {
    res.status(500).json({ error: "Error logging in user", details: error.message });
  }
};


