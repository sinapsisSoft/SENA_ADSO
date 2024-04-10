-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-04-2024 a las 00:40:01
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
-- Base de datos: `apisena`
--
CREATE DATABASE IF NOT EXISTS `apisena` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `apisena`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `changePassword`$$
CREATE PROCEDURE `changePassword` (IN `userId` INT, `UserPassword` VARCHAR(256))   BEGIN
UPDATE user SET User_password=UserPassword WHERE User_id=userId;
END$$

DROP PROCEDURE IF EXISTS `loginUser`$$
CREATE PROCEDURE `loginUser` (IN `user` VARCHAR(30))   BEGIN
SELECT User_password FROM user WHERE User_user=user AND User_status_id=1;
END$$

DROP PROCEDURE IF EXISTS `sp_change_password`$$
CREATE PROCEDURE `sp_change_password` (IN `IdUser` INT, `UserPassword` VARCHAR(256))   BEGIN
UPDATE user SET User_password=UserPassword WHERE User_id=IdUser;
END$$

DROP PROCEDURE IF EXISTS `sp_delete_user`$$
CREATE PROCEDURE `sp_delete_user` (IN `IdUser` INT)   BEGIN
DELETE FROM user WHERE User_id=IdUser;
SELECT COUNT(*) FROM user WHERE User_id=IdUser; 
END$$

DROP PROCEDURE IF EXISTS `sp_insert_user`$$
CREATE PROCEDURE `sp_insert_user` (IN `UserUser` VARCHAR(30), IN `UserPassword` VARCHAR(256), IN `UserStatusId` INT, IN `RoleId` INT)   BEGIN
INSERT INTO `user`(`User_id`, `User_user`, `User_password`, `User_status_id`, `Role_id`) VALUES (null,UserUser,UserPassword,UserStatusId,RoleId);

SELECT LAST_INSERT_ID();
END$$

DROP PROCEDURE IF EXISTS `sp_login`$$
CREATE PROCEDURE `sp_login` (IN `UserUser` VARCHAR(30))   BEGIN
SELECT User_id,Role_id,User_password FROM user WHERE User_user=UserUser;
END$$

DROP PROCEDURE IF EXISTS `sp_select_all_users`$$
CREATE PROCEDURE `sp_select_all_users` ()   BEGIN
SELECT US.User_id,US.User_user,US.User_password,US.User_status_id,UST.User_status_name, US.Role_id,ROL.Role_name FROM `user` US
INNER JOIN role ROL ON US.Role_id=ROL.Role_id
INNER JOIN user_status UST ON US.User_status_id=UST.User_status_id 
WHERE US.User_status_id=1;
END$$

DROP PROCEDURE IF EXISTS `sp_select_id_user`$$
CREATE PROCEDURE `sp_select_id_user` (IN `IdUser` INT)   BEGIN
SELECT US.User_id,US.User_user,US.User_password,US.User_status_id,UST.User_status_name, US.Role_id,ROL.Role_name FROM `user` US
INNER JOIN role ROL ON US.Role_id=ROL.Role_id
INNER JOIN user_status UST ON US.User_status_id=UST.User_status_id 
WHERE US.User_status_id=1 AND US.User_id=IdUser;
END$$

DROP PROCEDURE IF EXISTS `sp_update_user`$$
CREATE PROCEDURE `sp_update_user` (IN `IdUser` INT, IN `UserStatusId` INT, IN `RoleId` INT)   BEGIN
UPDATE user SET User_status_id=UserStatusId,Role_id=RoleId WHERE User_id=IdUser;
CALL`sp_select_all_users`();
END$$

DROP PROCEDURE IF EXISTS `validateUser`$$
CREATE PROCEDURE `validateUser` (IN `UserUser` VARCHAR(30))   BEGIN
SELECT COUNT(*) FROM user WHERE User_user=UserUser AND User_status_id=1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `Role_id` int(11) NOT NULL AUTO_INCREMENT,
  `Role_name` varchar(20) NOT NULL,
  `Role_description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `role`
--

TRUNCATE TABLE `role`;
--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`Role_id`, `Role_name`, `Role_description`) VALUES
(1, 'Administrator', 'Administrator'),
(2, 'Client', 'Client');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `User_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_user` varchar(30) NOT NULL,
  `User_password` varchar(256) NOT NULL,
  `User_status_id` int(11) NOT NULL,
  `Role_id` int(11) NOT NULL,
  PRIMARY KEY (`User_id`),
  UNIQUE KEY `User_user` (`User_user`),
  KEY `User_status_id` (`User_status_id`),
  KEY `Role_id` (`Role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `user`
--

TRUNCATE TABLE `user`;
--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`User_id`, `User_user`, `User_password`, `User_status_id`, `Role_id`) VALUES
(31, 'dieher@gmail.com', '$2y$10$Ormm1OPYtVh.rd2yhVswDuTBs6HhT5KZvFlWsAVve2r6gydcSDSnq', 2, 2),
(34, 'info@sinapsist.com.co', '$2y$10$On5TM57LOrxzy9ea6snlN.5.BDS2Guc5nKVIM51hnpoBgjh7JyVfe', 1, 1),
(35, 'g.rodriguez@sinapsist.com.co', '$2y$10$/Y.X/GqBDb7FbrDVFbpzjuzC4vt9TShl.6gT1YVxTZd/4IdLlkzEC', 2, 1),
(36, 'admin@sinapsist.com.co', '$2y$10$DKbIm5z3FLz.QFCLS91Gyeh/AilisDsanzkhe0r2y6TFnJ0oENnvK', 2, 2),
(38, 'diehercasvan@gmail.com', '$2y$10$0Xk28IwFLi6QODSCbXKHnek/6fSnTiklWMQA.BpiJigN8a5j8nEA6', 1, 1),
(39, 'f.casallas@sinapsist.com.co', '$2y$10$Dysw9XEbf/gLzGhH34DCF.JszUZy1uigfa5JTSNnXSd50QtpAbx6i', 1, 1),
(43, 'c.peres@sinapsis.com', '$2y$10$hUwXES91XwWsLXI.XMLTyeiSs3CFt5iQwNrsuEiIvuOP/kSgsH8NO', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_status`
--

DROP TABLE IF EXISTS `user_status`;
CREATE TABLE IF NOT EXISTS `user_status` (
  `User_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_status_name` varchar(20) NOT NULL,
  `User_status_description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`User_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `user_status`
--

TRUNCATE TABLE `user_status`;
--
-- Volcado de datos para la tabla `user_status`
--

INSERT INTO `user_status` (`User_status_id`, `User_status_name`, `User_status_description`) VALUES
(1, 'Active', 'Active'),
(2, 'Cancel', 'Cancel'),
(3, 'Block', 'Block');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`User_status_id`) REFERENCES `user_status` (`User_status_id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`Role_id`) REFERENCES `role` (`Role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
