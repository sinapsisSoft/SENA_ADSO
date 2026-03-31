
import { connect } from '../config/db/connect.js';


class RoleModel {
  constructor(id, name, descriptions) {
    this.id = id;
    this.name = name;
    this.descriptions = descriptions;
  }

  async addRole(req, res) {
    // Logic to add role to the database
    try {
      const { name, description } = req.body;
      if (!name || !description) {
        return res.status(400).json({ error: "Missing required fields" });
      }
      let sqlQuery = "INSERT INTO roles (Roles_name,Roles_description) VALUES (?,?)";
      const [result] = await connect.query(sqlQuery, [name, description]);
      res.status(201).json({
        data: [{ id: result.insertId, name, description }],
        status: 201
      });
    } catch (error) {
      res.status(500).json({ error: "Error adding Role", details: error.message });
    }
  }

  async updateRole(req, res) {
    // Logic to update role in the database
    try {
      const { name, description } = req.body;
      if (!name || !description) {
        return res.status(400).json({ error: "Missing required fields" });
      }
      let sqlQuery = "UPDATE roles SET Roles_name=?,Roles_description=?,update_at=? WHERE Roles_id= ?";
      const update_at = new Date().toLocaleString("en-CA", { timeZone: "America/Bogota" }).replace(",", "").replace("/", "-").replace("/", "-");
      const [result] = await connect.query(sqlQuery, [name, description, update_at, req.params.id]);
      if (result.affectedRows === 0) return res.status(404).json({ error: "Role not found" });
      res.status(200).json({
        data: [{ name, description, update_at }],
        status: 200,
        updated: result.affectedRows
      });
    } catch (error) {
      res.status(500).json({ error: "Error updating Role", details: error.message });
    }
  }

  async deleteRRole(req, res) {
    // Logic to delete role from the database
    try {
      let sqlQuery = "DELETE FROM roles WHERE Roles_id = ?";
      const [result] = await connect.query(sqlQuery, [req.params.id]);
      if (result.affectedRows === 0) return res.status(404).json({ error: "Role not found" });
      res.status(200).json({
        data: [],
        status: 200,
        deleted: result.affectedRows
      });
    } catch (error) {
      res.status(500).json({ error: "Error deleting Role", details: error.message });
    }
  }


  async showRole(res) {
    // Logic to show role from the database
    try {
      let sqlQuery = "SELECT * FROM roles";
      const [result] = await connect.query(sqlQuery);
      res.status(200).json(result);
    } catch (error) {
      res.status(500).json({ error: "Error fetching Roles", details: error.message });
    }
  }
  async showRoleById(res, req) {
    // Logic to show role from the database by ID
    try {
      const [result] = await connect.query('SELECT * FROM roles WHERE Roles_id = ?', [req.params.id]);
      if (result.length === 0) return res.status(404).json({ error: "Role not found" });
      res.status(200).json(result[0]);
    } catch (error) {
      res.status(500).json({ error: "Error fetching Role", details: error.message });
    }
  }

}

export default RoleModel;