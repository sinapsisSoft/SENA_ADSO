import { connect } from '../config/db/connect.js';
import {encryptPassword} from '../library/appBcrypt.js';
export const showUser = async (req, res) => {
  try {
    let sqlQuery = "SELECT * FROM user";
    const [result] = await connect.query(sqlQuery);
    res.status(200).json(result);
  } catch (error) {
    res.status(500).json({ error: "Error fetching users", details: error.message });
  }
};

export const showUserId = async (req, res) => {
  try {
    const [result] = await connect.query('SELECT * FROM user WHERE User_id = ?', [req.params.id]);
    if (result.length === 0) return res.status(404).json({ error: "user not found" });
    res.status(200).json(result[0]);
  } catch (error) {
    res.status(500).json({ error: "Error fetching user", details: error.message });
  }
};

export const addUser = async (req, res) => {
  try {
    const { user, password, status, role } = req.body;
    if (!user || !password || !status || !role ) {
      return res.status(400).json({ error: "Missing required fields" });
    }
     const hashedPassword = await encryptPassword(password);
   
    let sqlQuery = "INSERT INTO user (User_user,User_password,User_status_fk,Role_fk) VALUES (?,?,?,?)";
    const [result] = await connect.query(sqlQuery, [user, hashedPassword, status, role]);
    res.status(201).json({
      data: [{ id: result.insertId, user, hashedPassword, status, role }],
      status: 201
    });
  } catch (error) {
    res.status(500).json({ error: "Error adding user", details: error.message });
  }
};

export const updateUser = async (req, res) => {
  try {
    const { user, status, role } = req.body;
    if (!user || !status || !role ) {
      return res.status(400).json({ error: "Missing required fields" });
    }
    let sqlQuery = "UPDATE user SET User_user=?,User_status_fk=?,Role_fk =?,Updated_at=? WHERE User_id= ?";
    const updated_at = new Date().toLocaleString("en-CA", { timeZone: "America/Bogota" }).replace(",", "").replace("/", "-").replace("/", "-");
    const [result] = await connect.query(sqlQuery, [user, status, role,updated_at, req.params.id]);
    if (result.affectedRows === 0) return res.status(404).json({ error: "user not found" });
    res.status(200).json({
      data: [{ user, status, role,updated_at }],
      status: 200,
      updated: result.affectedRows
    });
  } catch (error) {
    res.status(500).json({ error: "Error updating user", details: error.message });
  }
};

export const deleteUser = async (req, res) => {
  try {
    let sqlQuery = "DELETE FROM user WHERE User_id = ?";
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


