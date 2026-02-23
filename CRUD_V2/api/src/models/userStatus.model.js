import { connect } from '../config/db/connect.js';

class UserStatusModel {
  constructor(id, name, description) {
    this.id = id;
    this.name = name;
    this.description = description;
  }

 async showUserStatus ( res) {
    try {
      let sqlQuery = "SELECT * FROM user_status";
      const [result] = await connect.query(sqlQuery);
      res.status(200).json(result);
    } catch (error) {
      res.status(500).json({ error: "Error fetching User Status", details: error.message });
    }
  };

  async showUserStatusId (req, res) {
    try {
      const [result] = await connect.query('SELECT * FROM user_status WHERE User_status_id= ?', [req.params.id]);
      if (result.length === 0) return res.status(404).json({ error: "UserStatus not found" });
      res.status(200).json(result[0]);
    } catch (error) {
      res.status(500).json({ error: "Error fetching UserStatus", details: error.message });
    }
  };

  async addUserStatus (req, res) {
    try {
      const { name, description } = req.body;
      if (!name || !description) {
        return res.status(400).json({ error: "Missing required fields" });
      }
      let sqlQuery = "INSERT INTO user_status (User_status_name ,User_status_description) VALUES (?,?)";
      const [result] = await connect.query(sqlQuery, [name, description]);
      res.status(201).json({
        data: [{ id: result.insertId, name, description }],
        status: 201
      });
    } catch (error) {
      res.status(500).json({ error: "Error adding UserStatus", details: error.message });
    }
  };

  async updateUserStatus (req, res)  {
    try {
      const { name, description } = req.body;
      if (!name || !description) {
        return res.status(400).json({ error: "Missing required fields" });
      }
      let sqlQuery = "UPDATE user_status SET User_status_name=?,User_status_description=?,update_at=? WHERE User_status_id = ?";
      const update_at = new Date().toLocaleString("en-CA", { timeZone: "America/Bogota" }).replace(",", "").replace("/", "-").replace("/", "-");
      const [result] = await connect.query(sqlQuery, [name, description, update_at, req.params.id]);
      if (result.affectedRows === 0) return res.status(404).json({ error: "User Status not found" });
      res.status(200).json({
        data: [{ name, description, update_at }],
        status: 200,
        updated: result.affectedRows
      });
    } catch (error) {
      res.status(500).json({ error: "Error updating UserStatus", details: error.message });
    }
  };

  async deleteUserStatus (req, res) {
    try {
      let sqlQuery = "DELETE FROM user_status WHERE User_status_id= ?";
      const [result] = await connect.query(sqlQuery, [req.params.id]);
      if (result.affectedRows === 0) return res.status(404).json({ error: "User Status not found" });
      res.status(200).json({
        data: [],
        status: 200,
        deleted: result.affectedRows
      });
    } catch (error) {
      res.status(500).json({ error: "Error deleting UserStatus", details: error.message });
    }

  };

};

export default UserStatusModel;
