
import UserStatusModel from '../models/userStatus.model.js';

export const showUserStatus = async (req, res) => {
  try {
    const userStatusModel = new UserStatusModel();
    userStatusModel.showUserStatus(res);
  } catch (error) {
    res.status(500).json({ error: "Error fetching User Status", details: error.message });
  }
};

export const showUserStatusId = async (req, res) => {
  try {
    const userStatusModel = new UserStatusModel();
    userStatusModel.showUserStatusId(res, req);
  } catch (error) {
    res.status(500).json({ error: "Error fetching UserStatus", details: error.message });
  }
};

export const addUserStatus = async (req, res) => {
  try {
    const userStatusModel = new UserStatusModel();
    userStatusModel.addUserStatus(req, res);
  } catch (error) {
    res.status(500).json({ error: "Error adding UserStatus", details: error.message });
  }
};

export const updateUserStatus = async (req, res) => {
  try {
    const userStatusModel = new UserStatusModel();
    userStatusModel.updateUserStatus(req, res);
  } catch (error) {
    res.status(500).json({ error: "Error updating UserStatus", details: error.message });
  }
};

export const deleteUserStatus = async (req, res) => {
  try {
    const userStatusModel = new UserStatusModel();
    userStatusModel.deleteUserStatus(req, res);
  } catch (error) {
    res.status(500).json({ error: "Error deleting UserStatus", details: error.message });
  }
};


