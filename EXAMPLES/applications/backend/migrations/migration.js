import mysql from "mysql2/promise";
import dotenv from 'dotenv';


dotenv.config();
// Database configuration
const dbConfig = {
  host: process.env.DB_HOST || 'localhost',
  user: process.env.DB_USER || 'root',
  password: process.env.DB_PASSWORD || '',
  database: process.env.DB_NAME || 'crud-node',
  multipleStatements: true
};

// SQL statements for table creation
const sqlStatements = [
  // Drop tables in reverse order of creation (to avoid foreign key constraints)
  `DROP TABLE IF EXISTS ApiAccessLog;`,
  `DROP TABLE IF EXISTS UserApi;`,
  `DROP TABLE IF EXISTS ApiRolePermission;`,
  `DROP TABLE IF EXISTS ApiRoleDataModel;`,
  `DROP TABLE IF EXISTS UserRole;`,
  `DROP TABLE IF EXISTS Profile;`,
  `DROP TABLE IF EXISTS User;`,
  `DROP TABLE IF EXISTS ApiPermission;`,
  `DROP TABLE IF EXISTS ApiDataModel;`,
  `DROP TABLE IF EXISTS ApiRole;`,
  `DROP TABLE IF EXISTS Role;`,
  `DROP TABLE IF EXISTS DocumentType;`,
  `DROP TABLE IF EXISTS UserStatus;`,

  // Create tables in proper order
  `CREATE TABLE UserStatus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    description VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ) ENGINE=InnoDB;`,

  `CREATE TABLE DocumentType (
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
    FOREIGN KEY (status_id) REFERENCES UserStatus(id) ON DELETE RESTRICT ON UPDATE CASCADE,
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
    FOREIGN KEY (document_type_id) REFERENCES DocumentType(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    INDEX idx_profile_user (user_id),
    INDEX idx_profile_document (document_number)
  ) ENGINE=InnoDB;`,

  `CREATE TABLE UserRole (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    role_id INT NOT NULL,
    status_id INT NOT NULL,
    assigned_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (role_id) REFERENCES Role(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (status_id) REFERENCES UserStatus(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (assigned_by) REFERENCES User(id) ON DELETE SET NULL ON UPDATE CASCADE,
    UNIQUE KEY uk_user_role (user_id, role_id),
    INDEX idx_userrole_user (user_id),
    INDEX idx_userrole_role (role_id)
  ) ENGINE=InnoDB;`,

  `CREATE TABLE ApiDataModel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    table_name VARCHAR(50) NOT NULL UNIQUE,
    description VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ) ENGINE=InnoDB;`,

  `CREATE TABLE ApiPermission (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    http_method ENUM('GET','POST','PUT','DELETE','PATCH') NOT NULL,
    description VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ) ENGINE=InnoDB;`,

  `CREATE TABLE ApiRole (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    description VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ) ENGINE=InnoDB;`,

  `CREATE TABLE ApiRoleDataModel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT NOT NULL,
    model_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES ApiRole(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (model_id) REFERENCES ApiDataModel(id) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE KEY uk_role_model (role_id, model_id)
  ) ENGINE=InnoDB;`,

  `CREATE TABLE ApiRolePermission (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT NOT NULL,
    permission_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES ApiRole(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (permission_id) REFERENCES ApiPermission(id) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE KEY uk_role_permission (role_id, permission_id)
  ) ENGINE=InnoDB;`,

  `CREATE TABLE UserApi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    api_key VARCHAR(128) UNIQUE NOT NULL,
    secret_key VARCHAR(128) NOT NULL,
    role_id INT NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    last_used_at TIMESTAMP NULL,
    expires_at TIMESTAMP NULL,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES ApiRole(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (created_by) REFERENCES User(id) ON DELETE SET NULL ON UPDATE CASCADE,
    INDEX idx_userapi_key (api_key),
    INDEX idx_userapi_username (username)
  ) ENGINE=InnoDB;`,

  `CREATE TABLE ApiAccessLog (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_api_id INT,
    endpoint VARCHAR(255) NOT NULL,
    http_method VARCHAR(10) NOT NULL,
    status_code INT NOT NULL,
    ip_address VARCHAR(45) NOT NULL,
    user_agent VARCHAR(255),
    response_time_ms INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_api_id) REFERENCES UserApi(id) ON DELETE SET NULL ON UPDATE CASCADE,
    INDEX idx_apiaccess_user (user_api_id),
    INDEX idx_apiaccess_created (created_at)
  ) ENGINE=InnoDB;`,

  // Insert initial data
  `INSERT INTO UserStatus (name, description) VALUES 
    ('active', 'Active user'),
    ('inactive', 'Inactive user'),
    ('suspended', 'Suspended user');`,

  `INSERT INTO DocumentType (name, description) VALUES 
    ('DNI', 'National Identity Document'),
    ('Passport', 'International Passport'),
    ('Driver License', 'Driver License');`,

  `INSERT INTO Role (name, description) VALUES 
    ('admin', 'System Administrator'),
    ('user', 'Regular User'),
    ('manager', 'Department Manager');`,

  `INSERT INTO ApiPermission (name, http_method, description) VALUES 
    ('read', 'GET', 'Read access'),
    ('create', 'POST', 'Create access'),
    ('update', 'PUT', 'Update access'),
    ('delete', 'DELETE', 'Delete access');`,

  `INSERT INTO ApiDataModel (table_name, description) VALUES 
    ('User', 'System users'),
    ('Profile', 'User profiles'),
    ('Role', 'User roles');`,

  `INSERT INTO ApiRole (name, description) VALUES 
    ('api-read', 'Read-only API access'),
    ('api-write', 'Read-write API access'),
    ('api-admin', 'Full API access');`
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