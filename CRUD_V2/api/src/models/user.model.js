
import { connect } from '../config/db/connect.js';
import { encryptPassword } from '../library/appBcrypt.js';

class UserModel {
  constructor(id, user, password, status, role) {
    this.id = id;
    this.user = user;
    this.password = password;
    this.status = status;
    this.role = role;
  }

  async addUser(req, res) {
    // Logic to add user to the database
    try {
      const { user, password, status, role } = req.body;
      if (!user || !password || !status || !role) {
        return res.status(400).json({ error: "Missing required fields" });
      }
      const hashedPassword = await encryptPassword(password);

      let sqlQuery = "INSERT INTO users (User_user,User_password,User_status_fk,Roles_fk ) VALUES (?,?,?,?)";
      const [result] = await connect.query(sqlQuery, [user, hashedPassword, status, role]);
      res.status(201).json({
        data: [{ id: result.insertId, user, hashedPassword, status, role }],
        status: 201
      });
    } catch (error) {
      res.status(500).json({ error: "Error adding user", details: error.message });
    }
  }

  async updateUser(req, res) {
    // Logic to update user in the database
    try {
      const { user, status, role } = req.body;
      if (!user || !status || !role) {
        return res.status(400).json({ error: "Missing required fields" });
      }
      let sqlQuery = "UPDATE users SET User_user=?,User_status_fk=?,Roles_fk  =?,update_at=? WHERE User_id= ?";
      const update_at = new Date().toLocaleString("en-CA", { timeZone: "America/Bogota" }).replace(",", "").replace("/", "-").replace("/", "-");
      const [result] = await connect.query(sqlQuery, [user, status, role, update_at, req.params.id]);
      if (result.affectedRows === 0) return res.status(404).json({ error: "user not found" });
      res.status(200).json({
        data: [{ user, status, role, update_at }],
        status: 200,
        updated: result.affectedRows
      });
    } catch (error) {
      res.status(500).json({ error: "Error updating user", details: error.message });
    }
  }

  async deleteUser(req, res) {
    // Logic to delete user from the database
    try {
      let sqlQuery = "DELETE FROM users WHERE User_id = ?";
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
  }


  async showUser(res) {
    // Logic to show user from the database
    try {
      let sqlQuery = "SELECT * FROM users";
      const [result] = await connect.query(sqlQuery);
      res.status(200).json(result);
    } catch (error) {
      res.status(500).json({ error: "Error fetching users , details: error.message" });
    }
  }
  async showUserById(res, req) {
    // Logic to show user from the database by ID
    try {
      const [result] = await connect.query('SELECT * FROM users WHERE User_id = ?', [req.params.id]);
      if (result.length === 0) return res.status(404).json({ error: "user not found" });
      res.status(200).json(result[0]);
    } catch (error) {
      res.status(500).json({ error: "Error fetching users , details: error.message " });
    }
  }

}

export default UserModel;