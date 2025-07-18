import { connect } from '../config/db/connectMysql.js';

class RoleModuleModel {
  
  static async create({ module_fk, role_user_fk, can_view, can_create, can_edit, can_delete }) {
     try {
      let sqlQuery = "INSERT INTO module_role ( module_fk, role_user_fk, can_view, can_create, can_edit, can_delete) VALUES (?, ?, ?, ?, ?, ?);";
      const [result] = await connect.query(sqlQuery,[module_fk, role_user_fk, can_view, can_create, can_edit, can_delete]);
      return result.insertId;
    } catch (error) {
      return [0];
    }
  }

  static async show() {
    try {
      let sqlQuery = "SELECT * FROM `module_role` ORDER BY `id`";
      const [result] = await connect.query(sqlQuery);
      return result;
    } catch (error) {
      return [0];
    }
  }

  static async update(id, { module_fk, role_user_fk, can_view, can_create, can_edit, can_delete }) {
    try {
      let sqlQuery = "UPDATE module_role SET module_fk = ?, role_user_fk = ?, can_view = ?, can_create = ?, can_edit = ?, can_delete = ?, updated_at = CURRENT_TIMESTAMP WHERE id =?;";
      const [result] = await connect.query(sqlQuery, [module_fk, role_user_fk, can_view, can_create, can_edit, can_delete, id]);
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
      let sqlQuery = "DELETE FROM module_role WHERE id=?";
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
      let sqlQuery = 'SELECT * FROM `module_role` WHERE `id`= ?';
      const [result] = await connect.query(sqlQuery, id);
      return result;
    } catch (error) {
      return [0];
    }

  }
}

export default RoleModuleModel;