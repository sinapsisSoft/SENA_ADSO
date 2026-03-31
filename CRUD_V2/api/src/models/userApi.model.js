
import { connect } from '../config/db/connect.js';
import { encryptPassword, comparePassword } from '../library/appBcrypt.js';
import jwt from "jsonwebtoken";

class UserApiModel {
  constructor(id, user, password, status, role) {
    this.id = id;
    this.user = user;
    this.password = password;
    this.status = status;
    this.role = role;
  }

  async showApiUser(req, res) {
    try {
      let sqlQuery = "SELECT * FROM api_users";
      const [result] = await connect.query(sqlQuery);
      res.status(200).json(result);
    } catch (error) {
      res.status(500).json({ error: "Error fetching users", details: error.message });
    }
  };

  async showApiUserId(req, res) {
    try {
      const [result] = await connect.query('SELECT * FROM api_users WHERE Api_user_id= ?', [req.params.id]);
      if (result.length === 0) return res.status(404).json({ error: "user not found" });
      res.status(200).json(result[0]);
    } catch (error) {
      res.status(500).json({ error: "Error fetching user", details: error.message });
    }
  };

  async addApiUser(req, res) {
    try {
      const { user, password, status, role } = req.body;
      if (!user || !password || !status || !role) {
        return res.status(400).json({ error: "Missing required fields" });
      }
      const hashedPassword = await encryptPassword(password);

      let sqlQuery = "INSERT INTO api_users(Api_user,Api_password,Api_status,Api_role) VALUES (?,?,?,?)";
      const [result] = await connect.query(sqlQuery, [user, hashedPassword, status, role]);
      res.status(201).json({
        data: [{ id: result.insertId, user, hashedPassword, status, role }],
        status: 201
      });
    } catch (error) {
      res.status(500).json({ error: "Error adding user", details: error.message });
    }
  };

  async updateApiUser(req, res) {
    try {
      const { user, password, role, status } = req.body;
      if (!user || !password || !status || !role) {
        return res.status(400).json({ error: "Missing required fields" });
      }
      let sqlQuery = "UPDATE  api_users SET Api_user=?,Api_password=?,Api_role =?,Api_status=?,Updated_at=? WHERE Api_user_id= ?";
      const updated_at = new Date().toLocaleString("en-CA", { timeZone: "America/Bogota" }).replace(",", "").replace("/", "-").replace("/", "-");
      const [result] = await connect.query(sqlQuery, [user, password, role, status, updated_at, req.params.id]);
      if (result.affectedRows === 0) return res.status(404).json({ error: "user not found" });
      res.status(200).json({
        data: [{ user, status, role, updated_at }],
        status: 200,
        updated: result.affectedRows
      });
    } catch (error) {
      res.status(500).json({ error: "Error updating user", details: error.message });
    }
  };

  async deleteApiUser(req, res) {
    try {
      let sqlQuery = "DELETE FROM api_users WHERE Api_user_id = ?";
      const [result] = await connect.query(sqlQuery, [req.params.id]);
      if (result.affectedRows === 0) return res.status(404).json({ error: "user not found" });
      res.status(200).json({
        data: [],
        status: 200,
        deleted: result.affectedRows
      });
    } catch (error) {
      res.status(500).json({ error: "Error deleting user", details: error.message });
    }
  };

  async loginApiUser(req, res) {
    try {
      const { api_user, api_password } = req.body;
      let sqlQuery = "SELECT * FROM api_users WHERE Api_user= ?";
      const [result] = await connect.query(sqlQuery, api_user);
      //await connect.end();
      if (result.length === 0) return res.status(400).json({ error: "user not found" });
      const user = result[0];
      const validPassword = await comparePassword(api_password, user.Api_password);
      if (!validPassword) return res.status(400).json({ error: "Incorrect password" });
      const token = jwt.sign({ id: user.Api_user_id, role: user.Api_role, status: user.Api_status }, process.env.JWT_SECRET, {
        expiresIn: "1h",
      });
      res.json({ token });
    } catch (error) {
      res.status(500).json({ error: "Error deleting user", details: error.message });
    }

  }

};
export default UserApiModel;