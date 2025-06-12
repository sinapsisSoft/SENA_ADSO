import { connect } from '../config/db/connectMysql.js';

class UserModel {

  static async create({ username, email, passwordHash, statusId }) {
    const [result] = await connect.query(
      'INSERT INTO User (username, email, password_hash, status_id) VALUES (?, ?, ?, ?)',
      [username, email, passwordHash, statusId]
    );
    return result.insertId;
  }

  static async show() {
    const [rows] = await connect.query(
      'SELECT * FROM user ORDER BY id'
    );
    return rows[0];
  }

  static async showActive() {
    const [rows] = await connect.query(
      'CALL sp_show_user_active()'
    );
    return rows[0];
  }

  static async update(id, { email, status_id }) {
    const [result] = await connect.query(
      'UPDATE user SET email = ?, status_id = ?, updated_at =CURRENT_TIMESTAMP WHERE id = ?',
      [email, status_id, id]
    );
    return result.affectedRows > 0 ? this.findById(id) : null;
  }

  static async delete(id) {
    const [result] = await connect.query(
      'DELETE FROM user WHERE id=?',
      [id]
    );
    return result.affectedRows > 0 ? this.findById(id) : null;
  }

  static async findById(id) {
    const [rows] = await connect.query(
      'SELECT * FROM user WHERE id = ?',
      [id]
    );
    return rows[0];
  }

  static async findByIdActive(id) {
    const [rows] = await connect.query(
      'CALL sp_show_id_user_active(?)',
      [id]
    );
    return rows[0];
  }

  static async findByName(username) {
    const [rows] = await connect.query(
      'SELECT * FROM user WHERE username = ?',
      [username]
    );
    return rows[0];
  }

  static async updateLogin(id) {
    const [result] = await connect.query(
      'UPDATE User SET last_login = CURRENT_TIMESTAMP WHERE id = ?',
      [id]
    );
    return result.affectedRows > 0 ? this.findById(id) : null;
  }

}
export default UserModel;