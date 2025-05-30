import { connect } from '../config/db/connectMysql.js';

class UserStatusModel {
  
  static async create({ name, description }) {
     try {
      let sqlQuery = "INSERT INTO user_status (name, description) VALUES (?, ?);";
      const [result] = await connect.query(sqlQuery,[name, description]);
      return result.insertId;
    } catch (error) {
      return [0];
    }
  }

  static async show() {
    try {
      let sqlQuery = "SELECT * FROM `user_status` ORDER BY `id`";
      const [result] = await connect.query(sqlQuery);
      return result;
    } catch (error) {
      return [0];
    }
  }

  static async update(id, { name, description }) {
    try {
      let sqlQuery = "UPDATE user_status SET name = ?, description = ?, updated_at = CURRENT_TIMESTAMP WHERE id =?;";
      const [result] = await connect.query(sqlQuery, [name, description, id]);
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
      let sqlQuery = "DELETE FROM user_status WHERE id=?";
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
      let sqlQuery = 'SELECT * FROM `user_status` WHERE `id`= ?';
      const [result] = await connect.query(sqlQuery, id);
      return result;
    } catch (error) {
      return [0];
    }

  }
}

export default UserStatusModel;