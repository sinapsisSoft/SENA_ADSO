
--
-- Base de datos: crud_node
--

DELIMITER $$
--
-- Procedimientos
--
CREATE PROCEDURE sp_module_role_user (IN userId INT, roleId INT)   BEGIN
SELECT MD.id, MD.name, MD.route, MD.icon, MD.description, MD.is_active FROM module_role AS MR
INNER JOIN module AS MD ON MR.module_fk=MD.id
WHERE role_user_fk= (SELECT id FROM user_role WHERE user_id=userId AND role_id=roleId) ORDER BY  MD.name DESC;
END$$

CREATE PROCEDURE sp_show_id_user_active (IN Id INT)   BEGIN
    SELECT US.id,US.username,US.email,US.password_hash,US.status_id,UST.name AS status_name,US.last_login,US.created_at,US.updated_at  FROM user AS US 
    INNER JOIN  user_status UST ON US.status_id=UST.id WHERE US.status_id=1 AND US.id=Id ORDER BY US.id;
    END$$

CREATE PROCEDURE sp_show_profile ()   BEGIN 

SELECT PR.id, PR.user_id, US.username, PR.first_name, PR.last_name, PR.address, PR.phone, PR.document_type_id, DT.name AS document_type_name ,PR.document_number, PR.photo_url, PR.birth_date FROM profile AS PR 
INNER JOIN user AS US ON PR.user_id = US.id
INNER JOIN document_type AS DT ON PR.document_type_id = DT.id;

END$$

CREATE PROCEDURE sp_show_user_active ()   BEGIN
    SELECT US.id,US.username,US.email,US.password_hash,US.status_id,UST.name AS status_name,US.last_login,US.created_at,US.updated_at  FROM user AS US 
    INNER JOIN  user_status UST ON US.status_id=UST.id WHERE US.status_id=1 ORDER BY US.id;
    END$$

CREATE PROCEDURE sp_user_role_id (IN userID INT)   BEGIN
SELECT UR.id, UR.user_id,US.username AS user_name,  UR.role_id,RL.name AS role_name,  UR.status_id,ST.name 
FROM user_role AS UR
INNER JOIN user US on UR.user_id=US.id
INNER JOIN role RL on UR.role_id=RL.id
INNER JOIN user_status ST on UR.status_id=ST.id
WHERE UR.user_id=userID AND UR.status_id=1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla document_type
--

CREATE TABLE IF NOT EXISTS document_type (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  description varchar(255) DEFAULT NULL,
  created_at timestamp NOT NULL DEFAULT current_timestamp(),
  updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (id),
  UNIQUE KEY name (name)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar document_type
--

TRUNCATE TABLE document_type;
--
-- Volcado de datos para la tabla document_type
--

INSERT INTO document_type (id, name, description, created_at, updated_at) VALUES
(1, 'CC', 'Cedula de ciudadanía', '2025-06-18 01:46:06', '2025-06-18 01:46:06'),
(2, 'TI', 'Tarjeta de identidad', '2025-06-18 01:46:06', '2025-06-18 01:46:06'),
(3, 'CE', 'Cédula de Extranjería', '2025-06-18 01:46:06', '2025-06-18 01:46:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla module
--

CREATE TABLE IF NOT EXISTS module (
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar module
--

TRUNCATE TABLE module;
--
-- Volcado de datos para la tabla module
--

INSERT INTO module (id, name, route, icon, description, is_active, created_at, updated_at) VALUES
(1, 'Dashboard', '#dashboard', 'bi-speedometer2', NULL, 1, '2025-06-26 20:46:24', '2025-06-26 20:46:24'),
(2, 'Usuarios', '#user', 'bi-people', NULL, 1, '2025-06-26 20:46:24', '2025-06-26 20:46:24'),
(3, 'Roles', '#role', 'bi-people-fill', NULL, 1, '2025-06-26 20:47:01', '2025-06-26 20:47:01'),
(4, 'Estados', '#userStatus', 'bi-back', NULL, 1, '2025-06-26 20:47:01', '2025-06-26 20:47:01'),
(5, 'Perfiles', '#profile', 'bi-person-bounding-box', NULL, 1, '2025-06-26 20:47:41', '2025-06-26 20:47:41'),
(6, 'Documentos', '#documentType', 'bi-file-earmark-text', NULL, 1, '2025-06-26 20:47:41', '2025-06-26 20:47:41'),
(9, 'Module', '#module', 'bi-window-stack', 'This is module', 1, '2025-06-27 02:28:07', '2025-06-27 04:38:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla module_role
--

CREATE TABLE IF NOT EXISTS module_role (
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar module_role
--

TRUNCATE TABLE module_role;
--
-- Volcado de datos para la tabla module_role
--

INSERT INTO module_role (id, module_fk, role_user_fk, can_view, can_create, can_edit, can_delete, created_at, updated_at) VALUES
(3, 1, 2, 1, 0, 0, 0, '2025-06-27 14:19:10', '2025-06-27 14:19:10'),
(4, 2, 2, 1, 0, 0, 0, '2025-06-27 14:22:44', '2025-06-27 14:22:44'),
(6, 6, 2, 1, 0, 0, 0, '2025-06-27 16:02:48', '2025-06-27 16:02:48'),
(7, 5, 2, 1, 0, 0, 0, '2025-06-27 16:03:31', '2025-06-27 16:03:31'),
(8, 1, 3, 1, 0, 0, 0, '2025-06-27 16:04:32', '2025-06-27 16:04:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla profile
--

CREATE TABLE IF NOT EXISTS profile (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_id int(11) NOT NULL,
  first_name varchar(50) NOT NULL,
  last_name varchar(50) NOT NULL,
  address varchar(255) DEFAULT NULL,
  phone varchar(20) DEFAULT NULL,
  document_type_id int(11) NOT NULL,
  document_number varchar(50) NOT NULL,
  photo_url varchar(255) DEFAULT NULL,
  birth_date date DEFAULT NULL,
  created_at timestamp NOT NULL DEFAULT current_timestamp(),
  updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (id),
  UNIQUE KEY user_id (user_id),
  UNIQUE KEY document_number (document_number),
  KEY document_type_id (document_type_id),
  KEY idx_profile_user (user_id),
  KEY idx_profile_document (document_number)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar profile
--

TRUNCATE TABLE profile;
--
-- Volcado de datos para la tabla profile
--

INSERT INTO profile (id, user_id, first_name, last_name, address, phone, document_type_id, document_number, photo_url, birth_date, created_at, updated_at) VALUES
(1, 1, 'Juan', 'Juan', '123123213', '5555555', 1, '123123123', 'img.jpg', '2000-04-10', '2025-06-18 01:55:31', '2025-06-18 01:55:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla role
--

CREATE TABLE IF NOT EXISTS role (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  description varchar(255) DEFAULT NULL,
  is_active tinyint(1) DEFAULT 1,
  created_at timestamp NOT NULL DEFAULT current_timestamp(),
  updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (id),
  UNIQUE KEY name (name),
  KEY idx_role_name (name)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar role
--

TRUNCATE TABLE role;
--
-- Volcado de datos para la tabla role
--

INSERT INTO role (id, name, description, is_active, created_at, updated_at) VALUES
(1, 'admin', 'System Administrator', 1, '2025-06-18 01:46:06', '2025-06-18 01:46:06'),
(2, 'user', 'Regular User', 1, '2025-06-18 01:46:06', '2025-06-18 01:46:06'),
(3, 'manager', 'Department Manager', 1, '2025-06-18 01:46:06', '2025-06-18 01:46:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla user
--

CREATE TABLE IF NOT EXISTS user (
  id int(11) NOT NULL AUTO_INCREMENT,
  username varchar(50) NOT NULL,
  email varchar(100) DEFAULT NULL,
  password_hash varchar(255) NOT NULL,
  status_id int(11) NOT NULL,
  last_login timestamp NULL DEFAULT NULL,
  created_at timestamp NOT NULL DEFAULT current_timestamp(),
  updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (id),
  UNIQUE KEY username (username),
  UNIQUE KEY email (email),
  KEY status_id (status_id),
  KEY idx_user_username (username),
  KEY idx_user_email (email)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar user
--

TRUNCATE TABLE user;
--
-- Volcado de datos para la tabla user
--

INSERT INTO user (id, username, email, password_hash, status_id, last_login, created_at, updated_at) VALUES
(1, 'admin', 'admin@gmail.com', '$2b$10$pRvxy7sQXQIpwAGlCOMRzO6cIpiFN6xd4RCQKoZ4eiRLqF2atnXNm', 1, '2025-06-27 15:06:26', '2025-06-18 01:46:06', '2025-06-27 15:06:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla user_role
--

CREATE TABLE IF NOT EXISTS user_role (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_id int(11) NOT NULL,
  role_id int(11) NOT NULL,
  status_id int(11) NOT NULL,
  created_at timestamp NOT NULL DEFAULT current_timestamp(),
  updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (id),
  UNIQUE KEY uk_user_role (user_id,role_id),
  KEY status_id (status_id),
  KEY idx_user_role_user (user_id),
  KEY idx_user_role_role (role_id)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar user_role
--

TRUNCATE TABLE user_role;
--
-- Volcado de datos para la tabla user_role
--

INSERT INTO user_role (id, user_id, role_id, status_id, created_at, updated_at) VALUES
(2, 1, 1, 1, '2025-06-26 23:24:15', '2025-06-26 23:58:26'),
(3, 1, 2, 1, '2025-06-27 01:06:13', '2025-06-27 01:06:13'),
(4, 1, 3, 1, '2025-06-27 01:28:33', '2025-06-27 01:28:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla user_status
--

CREATE TABLE IF NOT EXISTS user_status (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  description varchar(255) DEFAULT NULL,
  created_at timestamp NOT NULL DEFAULT current_timestamp(),
  updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (id),
  UNIQUE KEY name (name)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar user_status
--

TRUNCATE TABLE user_status;
--
-- Volcado de datos para la tabla user_status
--

INSERT INTO user_status (id, name, description, created_at, updated_at) VALUES
(1, 'active', 'Active user', '2025-06-18 01:46:06', '2025-06-18 01:46:06'),
(2, 'inactive', 'Inactive user', '2025-06-18 01:46:06', '2025-06-18 01:46:06'),
(3, 'suspended', 'Suspended user', '2025-06-18 01:46:06', '2025-06-18 01:46:06');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla module_role
--
ALTER TABLE module_role
  ADD CONSTRAINT fk_module_role_module FOREIGN KEY (module_fk) REFERENCES module (id) ON DELETE CASCADE,
  ADD CONSTRAINT fk_module_role_user FOREIGN KEY (role_user_fk) REFERENCES user_role (id) ON DELETE CASCADE;

--
-- Filtros para la tabla profile
--
ALTER TABLE profile
  ADD CONSTRAINT profile_ibfk_1 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT profile_ibfk_2 FOREIGN KEY (document_type_id) REFERENCES document_type (id) ON UPDATE CASCADE;

--
-- Filtros para la tabla user
--
ALTER TABLE user
  ADD CONSTRAINT user_ibfk_1 FOREIGN KEY (status_id) REFERENCES user_status (id) ON UPDATE CASCADE;

--
-- Filtros para la tabla user_role
--
ALTER TABLE user_role
  ADD CONSTRAINT user_role_ibfk_1 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT user_role_ibfk_2 FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT user_role_ibfk_3 FOREIGN KEY (status_id) REFERENCES user_status (id) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
