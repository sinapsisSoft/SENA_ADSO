import { connect } from '../config/db/connectMysql.js';

class ProfileModel {

  static async create({ userId, first_name, last_name, address, phone, documentTypeId, documentNumber, photoUrl, birthDate }) {
    const [result] = await connect.query(
      'INSERT INTO Profile (user_id, first_name, last_name, address,phone,document_type_id,document_number,photo_url,birth_date) VALUES (?, ?, ?, ?,?, ?, ?, ?, ?)',
      [userId, first_name, last_name, address, phone, documentTypeId, documentNumber, photoUrl, birthDate]
    );
    return result.insertId;
  }

  static async show() {
    const [rows] = await connect.query(
      'SELECT * FROM Profile ORDER BY id'
    );
    return rows[0];
  }

 
  static async update(id, { userId, first_name, last_name, address, phone, documentTypeId, documentNumber, photoUrl, birthDate}) {
    const [result] = await connect.query(
      'UPDATE Profile SET user_id=?, first_name=?, last_name=?, address=?,phone=?,document_type_id=?,document_number=?,photo_url=?,birth_date=? updated_at = CURRENT_TIMESTAMP WHERE id = ?',
      [userId, first_name, last_name, address, phone, documentTypeId, documentNumber, photoUrl, birthDate, id]
    );
    return result.affectedRows > 0 ? this.findById(id) : null;
  }

  static async delete(id) {
    const [result] = await connect.query(
      'DELETE FROM Profile WHERE id=?',
      [id]
    );
    return result.affectedRows > 0 ? this.findById(id) : null;
  }

  static async findById(id) {
    const [rows] = await connect.query(
      'SELECT * FROM Profile WHERE id = ?',
      [id]
    );
    return rows[0];
  }
 
}
export default ProfileModel;