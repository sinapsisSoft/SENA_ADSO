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


  `DROP TABLE IF EXISTS Module_role;`,
  `DROP TABLE IF EXISTS User_role;`,
  `DROP TABLE IF EXISTS Module;`,
  `DROP TABLE IF EXISTS Role;`,
  `DROP TABLE IF EXISTS Profile;`,
  `DROP TABLE IF EXISTS User;`,
  `DROP TABLE IF EXISTS Document_type;`,
  `DROP TABLE IF EXISTS User_status;`,

  // Create tables in proper order
  `CREATE TABLE IF NOT EXISTS Document_type (
id int(11) NOT NULL AUTO_INCREMENT,
name varchar(50) NOT NULL,
description varchar(255) DEFAULT NULL,
created_at timestamp NOT NULL DEFAULT current_timestamp(),
updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
PRIMARY KEY (id),
UNIQUE KEY name (name)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci`,

  `CREATE TABLE IF NOT EXISTS User_status (
id int(11) NOT NULL AUTO_INCREMENT,
name varchar(50) NOT NULL,
description varchar(255) DEFAULT NULL,
created_at timestamp NOT NULL DEFAULT current_timestamp(),
updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
PRIMARY KEY (id),
UNIQUE KEY name (name)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci`,

  `CREATE TABLE IF NOT EXISTS Role (
id int(11) NOT NULL AUTO_INCREMENT,
name varchar(50) NOT NULL,
description varchar(255) DEFAULT NULL,
is_active tinyint(1) DEFAULT 1,
created_at timestamp NOT NULL DEFAULT current_timestamp(),
updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
PRIMARY KEY (id),
UNIQUE KEY name (name),
KEY idx_role_name (name)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci`,

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

  `CREATE TABLE IF NOT EXISTS module (
id int(11) NOT NULL AUTO_INCREMENT,
name varchar(50) NOT NULL,
route varchar(100) NOT NULL,
icon varchar(50) DEFAULT NULL,
description varchar(255) DEFAULT NULL,
is_active tinyint(1) DEFAULT 1,
created_at timestamp NOT NULL DEFAULT current_timestamp(),
updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
PRIMARY KEY (id),
UNIQUE KEY module_name_unique (name),
UNIQUE KEY module_route_unique (route)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci`,

  `CREATE TABLE User_role (
id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT NOT NULL,
role_id INT NOT NULL,
status_id INT NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (role_id) REFERENCES Role(id) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (status_id) REFERENCES user_status(id) ON DELETE RESTRICT ON UPDATE CASCADE,
UNIQUE KEY uk_user_role (user_id, role_id),
INDEX idx_user_role_user (user_id),
INDEX idx_user_role_role (role_id)
) ENGINE=InnoDB;`,
  `CREATE TABLE IF NOT EXISTS Module_role (
id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
module_fk int(11) NOT NULL,
role_user_fk int(11) NOT NULL,
can_view tinyint(1) DEFAULT 1,
can_create tinyint(1) DEFAULT 0,
can_edit tinyint(1) DEFAULT 0,
can_delete tinyint(1) DEFAULT 0,
created_at timestamp NOT NULL DEFAULT current_timestamp(),
updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
UNIQUE KEY module_role_unique (module_fk,role_user_fk),
KEY fk_module_role_user (role_user_fk),
FOREIGN KEY (module_fk) REFERENCES Module(id) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (role_user_fk) REFERENCES User_role(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci`,

  // Insert initial data
  `INSERT INTO User_status (id, name, description, created_at, updated_at) VALUES
(1, 'active', 'Active user', '2025-06-18 01:46:06', '2025-06-18 01:46:06'),
(2, 'inactive', 'Inactive user', '2025-06-18 01:46:06', '2025-06-18 01:46:06'),
(3, 'suspended', 'Suspended user', '2025-06-18 01:46:06', '2025-06-18 01:46:06');`,

  `INSERT INTO Document_type (id, name, description, created_at, updated_at) VALUES
(1, 'CC', 'Cedula de ciudadanía', '2025-06-18 01:46:06', '2025-06-18 01:46:06'),
(2, 'TI', 'Tarjeta de identidad', '2025-06-18 01:46:06', '2025-06-18 01:46:06'),
(3, 'CE', 'Cédula de Extranjería', '2025-06-18 01:46:06', '2025-06-18 01:46:06');`,

  `INSERT INTO Role (id, name, description, is_active, created_at, updated_at) VALUES
(1, 'admin', 'System Administrator', 1, '2025-06-18 01:46:06', '2025-06-18 01:46:06'),
(2, 'user', 'Regular User', 1, '2025-06-18 01:46:06', '2025-06-18 01:46:06'),
(3, 'manager', 'Department Manager', 1, '2025-06-18 01:46:06', '2025-06-18 01:46:06');`,

  `INSERT INTO Module (id, name, route, icon, description, is_active, created_at, updated_at) VALUES
(1, 'Dashboard', '#dashboard', 'bi-speedometer2', NULL, 1, '2025-06-26 20:46:24', '2025-06-26 20:46:24'),
(2, 'Usuarios', '#user', 'bi-people', NULL, 1, '2025-06-26 20:46:24', '2025-06-26 20:46:24'),
(3, 'Roles', '#role', 'bi-people-fill', NULL, 1, '2025-06-26 20:47:01', '2025-06-26 20:47:01'),
(4, 'Estados', '#userStatus', 'bi-back', NULL, 1, '2025-06-26 20:47:01', '2025-06-26 20:47:01'),
(5, 'Perfiles', '#profile', 'bi-person-bounding-box', NULL, 1, '2025-06-26 20:47:41', '2025-06-26 20:47:41'),
(6, 'Documentos', '#documentType', 'bi-file-earmark-text', NULL, 1, '2025-06-26 20:47:41', '2025-06-26 20:47:41'),
(9, 'Module', '#module', 'bi-window-stack', 'This is module', 1, '2025-06-27 02:28:07', '2025-06-27 04:38:27');`,

  `INSERT INTO User (id, username, email, password_hash, status_id, last_login, created_at, updated_at) VALUES
(1, 'admin', 'admin@gmail.com', '$2b$10$pRvxy7sQXQIpwAGlCOMRzO6cIpiFN6xd4RCQKoZ4eiRLqF2atnXNm', 1, '2025-06-27 15:06:26', '2025-06-18 01:46:06', '2025-06-27 15:06:26');`,

  `INSERT INTO Profile (id, user_id, first_name, last_name, address, phone, document_type_id, document_number, photo_url, birth_date, created_at, updated_at) VALUES
(1, 1, 'Juan', 'Juan', '123123213', '5555555', 1, '123123123', 'img.jpg', '2000-04-10', '2025-06-18 01:55:31', '2025-06-18 01:55:31');`,

  `INSERT INTO User_role (id, user_id, role_id, status_id, created_at, updated_at) VALUES
(2, 1, 1, 1, '2025-06-26 23:24:15', '2025-06-26 23:58:26'),
(3, 1, 2, 1, '2025-06-27 01:06:13', '2025-06-27 01:06:13'),
(4, 1, 3, 1, '2025-06-27 01:28:33', '2025-06-27 01:28:33');`,

  `INSERT INTO Module_role (id, module_fk, role_user_fk, can_view, can_create, can_edit, can_delete, created_at, updated_at) VALUES
(3, 1, 2, 1, 0, 0, 0, '2025-06-27 14:19:10', '2025-06-27 14:19:10'),
(4, 2, 2, 1, 0, 0, 0, '2025-06-27 14:22:44', '2025-06-27 14:22:44'),
(6, 6, 2, 1, 0, 0, 0, '2025-06-27 16:02:48', '2025-06-27 16:02:48'),
(7, 5, 2, 1, 0, 0, 0, '2025-06-27 16:03:31', '2025-06-27 16:03:31'),
(8, 1, 3, 1, 0, 0, 0, '2025-06-27 16:04:32', '2025-06-27 16:04:32');`,

  `DROP PROCEDURE IF EXISTS sp_module_role_user;`,
  `CREATE PROCEDURE sp_module_role_user (IN userId INT, roleId INT)
BEGIN
SELECT MD.id, MD.name, MD.route, MD.icon, MD.description, MD.is_active FROM module_role AS MR
INNER JOIN module AS MD ON MR.module_fk=MD.id
WHERE role_user_fk= (SELECT id FROM user_role WHERE user_id=userId AND role_id=roleId) ORDER BY  MD.name DESC;
END;`,

  `DROP PROCEDURE IF EXISTS sp_show_id_user_active;`,
  `CREATE PROCEDURE sp_show_id_user_active (IN Id INT)
BEGIN
SELECT US.id,US.username,US.email,US.password_hash,US.status_id,UST.name AS status_name,US.last_login,US.created_at,US.updated_at  FROM user AS US 
INNER JOIN  user_status UST ON US.status_id=UST.id WHERE US.status_id=1 AND US.id=Id ORDER BY US.id;
END;`,

  `DROP PROCEDURE IF EXISTS sp_show_profile;`,
  `CREATE PROCEDURE sp_show_profile ()
BEGIN 
SELECT PR.id, PR.user_id, US.username, PR.first_name, PR.last_name, PR.address, PR.phone, PR.document_type_id, DT.name AS document_type_name ,PR.document_number, PR.photo_url, PR.birth_date FROM profile AS PR 
INNER JOIN user AS US ON PR.user_id = US.id
INNER JOIN document_type AS DT ON PR.document_type_id = DT.id;
END;`,

  `DROP PROCEDURE IF EXISTS sp_show_user_active;`,
  `CREATE PROCEDURE sp_show_user_active ()   BEGIN
SELECT US.id,US.username,US.email,US.password_hash,US.status_id,UST.name AS status_name,US.last_login,US.created_at,US.updated_at  FROM user AS US 
INNER JOIN  user_status UST ON US.status_id=UST.id WHERE US.status_id=1 ORDER BY US.id;
END;`,

  `DROP PROCEDURE IF EXISTS sp_user_role_id;`,
  `CREATE PROCEDURE sp_user_role_id (IN userID INT)   BEGIN
SELECT UR.id, UR.user_id,US.username AS user_name,  UR.role_id,RL.name AS role_name,  UR.status_id,ST.name 
FROM user_role AS UR
INNER JOIN user US on UR.user_id=US.id
INNER JOIN role RL on UR.role_id=RL.id
INNER JOIN user_status ST on UR.status_id=ST.id
WHERE UR.user_id=userID AND UR.status_id=1;
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