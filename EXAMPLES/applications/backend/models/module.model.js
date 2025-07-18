import { connect } from '../config/db/connectMysql.js';

class ModuleModel {

  static async create({ name, route, icon, description, is_active }) {
    const [result] = await connect.query(
      'INSERT INTO Module (name, route, icon, description, is_active) VALUES (?, ?, ?, ?, ?)',
      [name, route, icon, description, is_active]
    );
    return result.insertId;
  }

  static async show() {
    try {
      let sqlQuery = "SELECT * FROM `module` ORDER BY `id`";
      const [result] = await connect.query(sqlQuery);
      return result;
    } catch (error) {
      return [0];
    }
  }

  static async update(id, { name, route, icon, description, is_active }) {
    const [result] = await connect.query(
      'UPDATE Module SET name = ?, route = ?, icon=?, description = ?, is_active = ?, updated_at =CURRENT_TIMESTAMP WHERE id = ?',
      [name, route, icon, description, is_active, id]
    );
    return result.affectedRows > 0 ? this.findById(id) : null;
  }

  static async delete(id) {
    const [result] = await connect.query(
      'DELETE FROM Module WHERE id=?',
      [id]
    );
    return result.affectedRows > 0 ? this.findById(id) : null;
  }


  static async findById(id) {
    try {
      let sqlQuery = "SELECT * FROM `module` WHERE id = ? ORDER BY `id`";
      const [result] = await connect.query(sqlQuery, id);
      return result;
    } catch (error) {
      return [0];
    }
  }

  static async findModulesByUserRole(idUser,idRole) {
    try {
      let sqlQuery = "CALL sp_module_role_user(?,?); ";
      const [result] = await connect.query(sqlQuery, [idUser,idRole]);
      return result;
    } catch (error) {
      return [0];
    }
  }

}
export default ModuleModel;