import { connect } from '../config/db/connectMysql.js';

class RoleModel {
  
  static async create({ name, description, is_active }) {
     try {
      let sqlQuery = "INSERT INTO role (name, description, is_active) VALUES (?, ?, ?);";
      const [result] = await connect.query(sqlQuery,[name, description, is_active]);
      return result.insertId;
    } catch (error) {
      return [0];
    }
  }

  static async show() {
    try {
      let sqlQuery = "SELECT * FROM `role` ORDER BY `id`";
      const [result] = await connect.query(sqlQuery);
      return result;
    } catch (error) {
      return [0];
    }
  }

  static async update(id, { name, description, is_active }) {
    try {
      let sqlQuery = "UPDATE role SET name = ?, description = ?, is_active = ?, updated_at = CURRENT_TIMESTAMP WHERE id =?;";
      const [result] = await connect.query(sqlQuery, [name, description, is_active, id]);
      if (result.affectedRows === 0) {
        return [0];
      } else {
        return result.affectedRows;
      }

    } catch (error) {
      return [0];
    }
  }

  static async delete(id) {
    try {
      let sqlQuery = "DELETE FROM role WHERE id=?";
      const [result] = await connect.query(sqlQuery, id);
      if (result.affectedRows === 0) {
        return [0];
      } else {
        return result.affectedRows
      }
    } catch (error) {
      return [0];
    }
  }

  static async findById(id) {
    try {
      let sqlQuery = 'SELECT * FROM `role` WHERE `id`= ?';
      const [result] = await connect.query(sqlQuery, id);
      return result;
    } catch (error) {
      return [0];
    }

  }
}

export default RoleModel;