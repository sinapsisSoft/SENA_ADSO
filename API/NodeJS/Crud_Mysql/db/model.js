import { connect } from '../db/connect.js';

function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

async function executeQuery(pool, query) {
  let connection;
  try {
    connection = await pool.getConnection();
    const [rows] = await connection.query(query);
    connection.release();
    console.log(rows);
    return rows;
  } catch (error) {
    console.error('Error executing query', error.message);
    return null;
  } finally {
    await sleep(2000);
    if (connection) connection.release();
  }

}
const queries = [
  'CREATE TABLE IF NOT EXISTS document_type( '
  +'Document_type_id int(11) NOT NULL AUTO_INCREMENT,'
  +'Document_type_name varchar(20) NOT NULL,'
  +'Document_type_description varchar(80) DEFAULT NULL,'  
  +'PRIMARY KEY (Document_type_id),  UNIQUE KEY Document_type_name (Document_type_name)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;',
  'CREATE TABLE IF NOT EXISTS profile ('
  +'Profile_id int(11) NOT NULL AUTO_INCREMENT,'
  +'Profile_name varchar(20) NOT NULL,'
  +'Profile_last_name varchar(20) NOT NULL,'
  +'Profile_document varchar(11) NOT NULL,'
  +'Profile_email varchar(30) NOT NULL UNIQUE,'
  +'Profile_phone varchar(11) NOT NULL,' 
  +'Profile_photo varchar(100) NOT NULL,'
  +'Profile_address varchar(30) NOT NULL,'
  +'Document_type_fk int(11) NOT NULL,'
  +'PRIMARY KEY (Profile_id),  KEY Document_type_fk (Document_type_fk))'
  +'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;',
  'ALTER TABLE profile ADD CONSTRAINT profile_document_type FOREIGN KEY (Document_type_fk) REFERENCES document_type (Document_type_id);',
];
for(let query of queries){
  console.log(query);
  executeQuery(connect, query);
}