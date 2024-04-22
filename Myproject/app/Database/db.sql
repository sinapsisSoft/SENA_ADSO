-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-04-2024 a las 02:51:27
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `memory_games`
--
CREATE DATABASE IF NOT EXISTS `memory_games` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `memory_games`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `Module_id` int(11) NOT NULL AUTO_INCREMENT,
  `Module_name` varchar(20) NOT NULL,
  `Module_route` varchar(30) NOT NULL,
  `Module_icon` varchar(20) NOT NULL,
  `Module_description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `module`
--

TRUNCATE TABLE `module`;
--
-- Volcado de datos para la tabla `module`
--

INSERT INTO `module` (`Module_id`, `Module_name`, `Module_route`, `Module_icon`, `Module_description`) VALUES
(1, 'Home', '/home', '/icons/home', 'home'),
(2, 'User', '/user', '/icons/user', 'user'),
(3, 'Role', '/role', '/icons/role', 'role'),
(4, 'User Status', '/statusUser', '/icons/statusUser', 'statusUser'),
(5, 'Module', '/module', '/icons/module', 'module');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `module_role`
--

DROP TABLE IF EXISTS `module_role`;
CREATE TABLE IF NOT EXISTS `module_role` (
  `Module_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `Module_FK` int(11) NOT NULL,
  `Role_FK` int(11) NOT NULL,
  PRIMARY KEY (`Module_role_id`),
  KEY `Module_FK` (`Module_FK`),
  KEY `Role_FK` (`Role_FK`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `module_role`
--

TRUNCATE TABLE `module_role`;
--
-- Volcado de datos para la tabla `module_role`
--

INSERT INTO `module_role` (`Module_role_id`, `Module_FK`, `Role_FK`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permitions`
--

DROP TABLE IF EXISTS `permitions`;
CREATE TABLE IF NOT EXISTS `permitions` (
  `Permitions_id` int(11) NOT NULL AUTO_INCREMENT,
  `Permitions_name` varchar(30) NOT NULL,
  `Permitions_description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Permitions_id`),
  UNIQUE KEY `Permitions_name` (`Permitions_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `permitions`
--

TRUNCATE TABLE `permitions`;
--
-- Volcado de datos para la tabla `permitions`
--

INSERT INTO `permitions` (`Permitions_id`, `Permitions_name`, `Permitions_description`) VALUES
(1, 'Create', 'This Create'),
(2, 'Show', 'This Show'),
(3, 'Edit', 'This Edit'),
(4, 'Delete', 'This Delete');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permitions_module_role`
--

DROP TABLE IF EXISTS `permitions_module_role`;
CREATE TABLE IF NOT EXISTS `permitions_module_role` (
  `Permitions_module_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `Module_role_FK` int(11) NOT NULL,
  `Permitions_FK` int(11) NOT NULL,
  PRIMARY KEY (`Permitions_module_role_id`),
  KEY `Module_role_FK` (`Module_role_FK`),
  KEY `Permitions_FK` (`Permitions_FK`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `permitions_module_role`
--

TRUNCATE TABLE `permitions_module_role`;
--
-- Volcado de datos para la tabla `permitions_module_role`
--

INSERT INTO `permitions_module_role` (`Permitions_module_role_id`, `Module_role_FK`, `Permitions_FK`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 2, 1),
(6, 3, 1),
(7, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `Role_id` int(11) NOT NULL AUTO_INCREMENT,
  `Role_name` varchar(20) NOT NULL,
  `Role_description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Role_id`),
  UNIQUE KEY `Role_name` (`Role_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `role`
--

TRUNCATE TABLE `role`;
--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`Role_id`, `Role_name`, `Role_description`) VALUES
(1, 'Administrator', 'This is Administrator'),
(2, 'Client', 'This is Client'),
(3, 'Player', 'This is Player');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `User_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_user` varchar(30) NOT NULL,
  `User_password` varchar(256) NOT NULL,
  `User_status_FK` int(11) NOT NULL,
  `Role_FK` int(11) NOT NULL,
  PRIMARY KEY (`User_id`),
  UNIQUE KEY `User_user` (`User_user`),
  KEY `User_status_FK` (`User_status_FK`),
  KEY `Role_FK` (`Role_FK`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `users`
--

TRUNCATE TABLE `users`;
--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`User_id`, `User_user`, `User_password`, `User_status_FK`, `Role_FK`) VALUES
(1, 'diego@gmail.com', '$2y$10$ICFjMfjfwcQQBAqDdR2OtO.DOGWOWOzaB1F1Wob1173FPgH2FOhlK', 1, 1),
(2, 'juan@gmail.com', '$2y$10$ICFjMfjfwcQQBAqDdR2OtO.DOGWOWOzaB1F1Wob1173FPgH2FOhlK', 1, 2),
(3, 'camila@gmail.com', '$2y$10$ICFjMfjfwcQQBAqDdR2OtO.DOGWOWOzaB1F1Wob1173FPgH2FOhlK', 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_status`
--

DROP TABLE IF EXISTS `user_status`;
CREATE TABLE IF NOT EXISTS `user_status` (
  `User_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_status_name` varchar(20) NOT NULL,
  `User_status_description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`User_status_id`),
  UNIQUE KEY `User_status_name` (`User_status_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `user_status`
--

TRUNCATE TABLE `user_status`;
--
-- Volcado de datos para la tabla `user_status`
--

INSERT INTO `user_status` (`User_status_id`, `User_status_name`, `User_status_description`) VALUES
(1, 'Active', 'This is Active'),
(2, 'Inactive', 'This is Inactive'),
(3, 'Blocked', 'This is Blocked'),
(4, 'Delete', 'This is Delete');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `module_role`
--
ALTER TABLE `module_role`
  ADD CONSTRAINT `module_role_ibfk_1` FOREIGN KEY (`Module_FK`) REFERENCES `module` (`Module_id`),
  ADD CONSTRAINT `module_role_ibfk_2` FOREIGN KEY (`Role_FK`) REFERENCES `role` (`Role_id`);

--
-- Filtros para la tabla `permitions_module_role`
--
ALTER TABLE `permitions_module_role`
  ADD CONSTRAINT `permitions_module_role_ibfk_1` FOREIGN KEY (`Module_role_FK`) REFERENCES `module_role` (`Module_role_id`),
  ADD CONSTRAINT `permitions_module_role_ibfk_2` FOREIGN KEY (`Permitions_FK`) REFERENCES `permitions` (`Permitions_id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`User_status_FK`) REFERENCES `user_status` (`User_status_id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`Role_FK`) REFERENCES `role` (`Role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-04-2024 a las 02:51:27
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `memory_games`
--
CREATE DATABASE IF NOT EXISTS `memory_games` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `memory_games`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `Module_id` int(11) NOT NULL AUTO_INCREMENT,
  `Module_name` varchar(20) NOT NULL,
  `Module_route` varchar(30) NOT NULL,
  `Module_icon` varchar(20) NOT NULL,
  `Module_description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `module`
--

TRUNCATE TABLE `module`;
--
-- Volcado de datos para la tabla `module`
--

INSERT INTO `module` (`Module_id`, `Module_name`, `Module_route`, `Module_icon`, `Module_description`) VALUES
(1, 'Home', '/home', '/icons/home', 'home'),
(2, 'User', '/user', '/icons/user', 'user'),
(3, 'Role', '/role', '/icons/role', 'role'),
(4, 'User Status', '/statusUser', '/icons/statusUser', 'statusUser'),
(5, 'Module', '/module', '/icons/module', 'module');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `module_role`
--

DROP TABLE IF EXISTS `module_role`;
CREATE TABLE IF NOT EXISTS `module_role` (
  `Module_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `Module_FK` int(11) NOT NULL,
  `Role_FK` int(11) NOT NULL,
  PRIMARY KEY (`Module_role_id`),
  KEY `Module_FK` (`Module_FK`),
  KEY `Role_FK` (`Role_FK`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `module_role`
--

TRUNCATE TABLE `module_role`;
--
-- Volcado de datos para la tabla `module_role`
--

INSERT INTO `module_role` (`Module_role_id`, `Module_FK`, `Role_FK`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permitions`
--

DROP TABLE IF EXISTS `permitions`;
CREATE TABLE IF NOT EXISTS `permitions` (
  `Permitions_id` int(11) NOT NULL AUTO_INCREMENT,
  `Permitions_name` varchar(30) NOT NULL,
  `Permitions_description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Permitions_id`),
  UNIQUE KEY `Permitions_name` (`Permitions_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `permitions`
--

TRUNCATE TABLE `permitions`;
--
-- Volcado de datos para la tabla `permitions`
--

INSERT INTO `permitions` (`Permitions_id`, `Permitions_name`, `Permitions_description`) VALUES
(1, 'Create', 'This Create'),
(2, 'Show', 'This Show'),
(3, 'Edit', 'This Edit'),
(4, 'Delete', 'This Delete');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permitions_module_role`
--

DROP TABLE IF EXISTS `permitions_module_role`;
CREATE TABLE IF NOT EXISTS `permitions_module_role` (
  `Permitions_module_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `Module_role_FK` int(11) NOT NULL,
  `Permitions_FK` int(11) NOT NULL,
  PRIMARY KEY (`Permitions_module_role_id`),
  KEY `Module_role_FK` (`Module_role_FK`),
  KEY `Permitions_FK` (`Permitions_FK`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `permitions_module_role`
--

TRUNCATE TABLE `permitions_module_role`;
--
-- Volcado de datos para la tabla `permitions_module_role`
--

INSERT INTO `permitions_module_role` (`Permitions_module_role_id`, `Module_role_FK`, `Permitions_FK`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 2, 1),
(6, 3, 1),
(7, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `Role_id` int(11) NOT NULL AUTO_INCREMENT,
  `Role_name` varchar(20) NOT NULL,
  `Role_description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Role_id`),
  UNIQUE KEY `Role_name` (`Role_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `role`
--

TRUNCATE TABLE `role`;
--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`Role_id`, `Role_name`, `Role_description`) VALUES
(1, 'Administrator', 'This is Administrator'),
(2, 'Client', 'This is Client'),
(3, 'Player', 'This is Player');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `User_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_user` varchar(30) NOT NULL,
  `User_password` varchar(256) NOT NULL,
  `User_status_FK` int(11) NOT NULL,
  `Role_FK` int(11) NOT NULL,
  PRIMARY KEY (`User_id`),
  UNIQUE KEY `User_user` (`User_user`),
  KEY `User_status_FK` (`User_status_FK`),
  KEY `Role_FK` (`Role_FK`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `users`
--

TRUNCATE TABLE `users`;
--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`User_id`, `User_user`, `User_password`, `User_status_FK`, `Role_FK`) VALUES
(1, 'diego@gmail.com', '$2y$10$ICFjMfjfwcQQBAqDdR2OtO.DOGWOWOzaB1F1Wob1173FPgH2FOhlK', 1, 1),
(2, 'juan@gmail.com', '$2y$10$ICFjMfjfwcQQBAqDdR2OtO.DOGWOWOzaB1F1Wob1173FPgH2FOhlK', 1, 2),
(3, 'camila@gmail.com', '$2y$10$ICFjMfjfwcQQBAqDdR2OtO.DOGWOWOzaB1F1Wob1173FPgH2FOhlK', 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_status`
--

DROP TABLE IF EXISTS `user_status`;
CREATE TABLE IF NOT EXISTS `user_status` (
  `User_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_status_name` varchar(20) NOT NULL,
  `User_status_description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`User_status_id`),
  UNIQUE KEY `User_status_name` (`User_status_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `user_status`
--

TRUNCATE TABLE `user_status`;
--
-- Volcado de datos para la tabla `user_status`
--

INSERT INTO `user_status` (`User_status_id`, `User_status_name`, `User_status_description`) VALUES
(1, 'Active', 'This is Active'),
(2, 'Inactive', 'This is Inactive'),
(3, 'Blocked', 'This is Blocked'),
(4, 'Delete', 'This is Delete');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `module_role`
--
ALTER TABLE `module_role`
  ADD CONSTRAINT `module_role_ibfk_1` FOREIGN KEY (`Module_FK`) REFERENCES `module` (`Module_id`),
  ADD CONSTRAINT `module_role_ibfk_2` FOREIGN KEY (`Role_FK`) REFERENCES `role` (`Role_id`);

--
-- Filtros para la tabla `permitions_module_role`
--
ALTER TABLE `permitions_module_role`
  ADD CONSTRAINT `permitions_module_role_ibfk_1` FOREIGN KEY (`Module_role_FK`) REFERENCES `module_role` (`Module_role_id`),
  ADD CONSTRAINT `permitions_module_role_ibfk_2` FOREIGN KEY (`Permitions_FK`) REFERENCES `permitions` (`Permitions_id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`User_status_FK`) REFERENCES `user_status` (`User_status_id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`Role_FK`) REFERENCES `role` (`Role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
