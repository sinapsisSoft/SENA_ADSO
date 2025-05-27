import { connect } from '../config/db/connectMysql.js';

export const showMysql = async (req, res) => {
  try {
    let sqlQuery = "SHOW TABLES; ";
    const [result] = await connect.query(sqlQuery);
    res.status(200).json(result);
  } catch (error) {
    res.status(500).json({ error: "Error fetching users", details: error.message });
  }
};