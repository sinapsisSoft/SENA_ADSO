import mysql from "mysql2/promise";
import dotenv from 'dotenv';


dotenv.config();
// Database configuration
const dbConfig = {
  host: process.env.DB_HOST || 'localhost',
  user: process.env.DB_USER || 'root',
  password: process.env.DB_PASSWORD || '',
  database: process.env.DB_NAME || 'crud_node',
  multipleStatements: true
};

// SQL statements for table creation
const sqlStatements = [
  // Drop tables in reverse order of creation (to avoid foreign key constraints)

  `DROP TABLE IF EXISTS User_role;`,
  `DROP TABLE IF EXISTS Profile;`,
  `DROP TABLE IF EXISTS User;`,
  `DROP TABLE IF EXISTS Role;`,
  `DROP TABLE IF EXISTS Document_type;`,
  `DROP TABLE IF EXISTS User_status;`,

  // Create tables in proper order
  `CREATE TABLE User_status (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    description VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ) ENGINE=InnoDB;`,

  `CREATE TABLE Document_type (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    description VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ) ENGINE=InnoDB;`,

  `CREATE TABLE Role (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    description VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_role_name (name)
  ) ENGINE=InnoDB;`,

  `CREATE TABLE User (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    status_id INT NOT NULL,
    last_login TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (status_id) REFERENCES user_status(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    INDEX idx_user_username (username),
    INDEX idx_user_email (email)
  ) ENGINE=InnoDB;`,

  `CREATE TABLE Profile (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNIQUE NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    address VARCHAR(255),
    phone VARCHAR(20),
    document_type_id INT NOT NULL,
    document_number VARCHAR(50) UNIQUE NOT NULL,
    photo_url VARCHAR(255),
    birth_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (document_type_id) REFERENCES document_type(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    INDEX idx_profile_user (user_id),
    INDEX idx_profile_document (document_number)
  ) ENGINE=InnoDB;`,

  `CREATE TABLE User_role (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    role_id INT NOT NULL,
    status_id INT NOT NULL,
    assigned_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (role_id) REFERENCES Role(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (status_id) REFERENCES user_status(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (assigned_by) REFERENCES User(id) ON DELETE SET NULL ON UPDATE CASCADE,
    UNIQUE KEY uk_user_role (user_id, role_id),
    INDEX idx_user_role_user (user_id),
    INDEX idx_user_role_role (role_id)
  ) ENGINE=InnoDB;`,

  // Insert initial data
  `INSERT INTO User_status (name, description) VALUES 
    ('active', 'Active user'),
    ('inactive', 'Inactive user'),
    ('suspended', 'Suspended user');`,

  `INSERT INTO Document_type (name, description) VALUES 
    ('CC', 'Cedula de ciudadanía'),
    ('TI', 'Tarjeta de identidad'),
    ('CE', 'Cédula de Extranjería');`,

  `INSERT INTO Role (name, description) VALUES 
    ('admin', 'System Administrator'),
    ('user', 'Regular User'),
    ('manager', 'Department Manager');`,
  `INSERT INTO user (username, email,password_hash,status_id) VALUES 
    ('admin', 'admin@gmail.com','$2b$10$pRvxy7sQXQIpwAGlCOMRzO6cIpiFN6xd4RCQKoZ4eiRLqF2atnXNm',1);`,
  `DROP PROCEDURE IF EXISTS sp_show_user_active;`,
  `CREATE PROCEDURE sp_show_user_active()
    BEGIN
    SELECT US.id,US.username,US.email,US.password_hash,US.status_id,UST.name AS status_name,US.last_login,US.created_at,US.updated_at  FROM user AS US 
    INNER JOIN  user_status UST ON US.status_id=UST.id WHERE US.status_id=1 ORDER BY US.id;
    END;`,
  `DROP PROCEDURE IF EXISTS sp_show_id_user_active;`,
  `CREATE PROCEDURE sp_show_id_user_active(IN Id INT)
    BEGIN
    SELECT US.id,US.username,US.email,US.password_hash,US.status_id,UST.name AS status_name,US.last_login,US.created_at,US.updated_at  FROM user AS US 
    INNER JOIN  user_status UST ON US.status_id=UST.id WHERE US.status_id=1 AND US.id=Id ORDER BY US.id;
    END;`,

];

export async function runMigration() {
  let connection;
  try {
    // Create connection
    connection = await mysql.createConnection(dbConfig);
    console.log('Connected to MySQL database');

    // Execute all SQL statements
    for (const sql of sqlStatements) {
      try {
        await connection.query(sql);
        console.log('Executed SQL statement successfully');
      } catch (error) {
        console.error('Error executing SQL:', error.message);
        throw error;
      }
    }

    console.log('Database migration completed successfully!');
    return { success: true };
  } catch (error) {
    console.error('Migration failed:', error);
    return { success: false, error };
  } finally {
    if (connection) {
      await connection.end();
      console.log('Database connection closed');
    }
  }
}