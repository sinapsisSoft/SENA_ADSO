-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2024 a las 02:19:12
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
-- Base de datos: `codeigniter-crud`
--
CREATE DATABASE IF NOT EXISTS `codeigniter-crud` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `codeigniter-crud`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `sp_permissions_module_id`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_permissions_module_id` (IN `roleModulesId` INT)   BEGIN
SELECT  CONCAT('permission_',PM.Permissions_fk) AS "permission", 1 AS 'Status',RM.Modules_fk AS Modules_id FROM permissions_modules AS PM
INNER JOIN permissions P ON PM.Permissions_fk=P.Permissions_id
INNER JOIN role_modules RM ON PM.RoleModules_fk=RM.RoleModules_id
WHERE PM.RoleModules_fk=roleModulesId;
END$$

DROP PROCEDURE IF EXISTS `sp_role_modules`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_role_modules` ()   BEGIN
SELECT RM.RoleModules_id,RM.Modules_fk,M.Modules_name,RM.Roles_fk,R.Roles_name,RM.update_at  FROM role_modules as RM
INNER JOIN modules M ON RM.Modules_fk=M.Modules_id
INNER JOIN roles R ON RM.Roles_fk=R.Roles_id;
END$$

DROP PROCEDURE IF EXISTS `sp_role_modules_id`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_role_modules_id` (IN `roleId` INT)   BEGIN
SELECT RM.Modules_fk, MO.Modules_name,MO.Modules_route,MO.Modules_icon,MO.Modules_submodule,MO.Modules_parent_module, MO.Modules_description
FROM role_modules as RM
INNER JOIN modules MO ON RM.Modules_fk=MO.Modules_id
WHERE RM.Roles_fk=roleId;
END$$

DROP PROCEDURE IF EXISTS `sp_role_module_id`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_role_module_id` (IN `roleId` INT)   BEGIN
SELECT  CONCAT('module_',RM.Modules_fk) AS "modules", 1 AS Status, RM.Roles_fk AS Roles_id FROM role_modules as RM
INNER JOIN modules M ON RM.Modules_fk=M.Modules_id
WHERE RM.Roles_fk=roleId;
END$$

DROP PROCEDURE IF EXISTS `sp_users`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_users` ()   BEGIN
SELECT US.User_id,US.User_user,US.User_password,US.update_at,RL.Roles_name, US.Roles_fk,UST.User_status_name, US.User_status_fk FROM users AS US 
INNER JOIN roles RL ON US.Roles_fk=RL.Roles_id
INNER JOIN user_status UST ON US.User_status_fk=UST.User_status_id 
ORDER BY US.User_id ASC;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(93, '2024-05-11-194201', 'App\\Database\\Migrations\\AddUserStatus', 'default', 'App', 1715883093, 1),
(94, '2024-05-11-194202', 'App\\Database\\Migrations\\AddUserRoles', 'default', 'App', 1715883093, 1),
(95, '2024-05-11-194203', 'App\\Database\\Migrations\\AddUsers', 'default', 'App', 1715883093, 1),
(96, '2024-05-11-195204', 'App\\Database\\Migrations\\AddPermissions', 'default', 'App', 1715883093, 1),
(97, '2024-05-11-195205', 'App\\Database\\Migrations\\AddModules', 'default', 'App', 1715883093, 1),
(98, '2024-05-11-195206', 'App\\Database\\Migrations\\AddRoleModules', 'default', 'App', 1715883093, 1),
(99, '2024-05-11-225191', 'App\\Database\\Migrations\\AddPermissionsModules', 'default', 'App', 1715883093, 1),
(100, '2024-05-11-235206', 'App\\Database\\Migrations\\AddProfiles', 'default', 'App', 1715883093, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `Modules_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Modules_name` varchar(30) NOT NULL,
  `Modules_description` varchar(300) DEFAULT NULL,
  `Modules_route` varchar(80) DEFAULT NULL,
  `Modules_icon` varchar(30) DEFAULT NULL,
  `Modules_submodule` tinyint(3) NOT NULL DEFAULT 0,
  `Modules_parent_module` varchar(11) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Modules_id`),
  UNIQUE KEY `Modules_name` (`Modules_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `modules`
--

INSERT INTO `modules` (`Modules_id`, `Modules_name`, `Modules_description`, `Modules_route`, `Modules_icon`, `Modules_submodule`, `Modules_parent_module`, `create_at`, `update_at`) VALUES
(1, 'Dashboard', 'This is dashboard', 'dashboard', 'bi-speedometer', 0, 'NULL', '2024-05-16 18:13:05', '0000-00-00 00:00:00'),
(2, 'User', 'This is user', 'user', 'bi-person-circle', 0, 'NULL', '2024-05-16 18:13:23', '0000-00-00 00:00:00'),
(3, 'Module', 'This is module', 'module', 'bi-box-fill', 0, 'NULL', '2024-05-16 18:13:53', '2024-05-28 01:07:47'),
(4, 'User Status', 'This is module the User Status', 'userStatus', 'bi-people-fill', 1, '2', '2024-05-25 17:13:17', NULL),
(5, 'Role', 'This is module the Role', 'role', 'bi-person-lock', 1, '2', '2024-05-25 19:03:41', NULL),
(6, 'Role Modules', 'This is Role Modules', 'roleModule', 'bi-boxes', 1, '3', '2024-05-27 15:46:42', NULL),
(7, 'Permissions', 'This is permissions', 'permission', 'bi-shield-lock-fill', 0, NULL, '2024-05-27 20:14:30', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `Permissions_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Permissions_name` varchar(30) NOT NULL,
  `Permissions_description` varchar(300) DEFAULT NULL,
  `Permissions_icon` varchar(30) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Permissions_id`),
  UNIQUE KEY `Permissions_name` (`Permissions_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`Permissions_id`, `Permissions_name`, `Permissions_description`, `Permissions_icon`, `create_at`, `update_at`) VALUES
(1, 'CREATE', 'This is create', 'bi-plus-circle-fill', '2024-05-16 18:14:29', '0000-00-00 00:00:00'),
(2, 'SHOW', 'This is show', 'bi-eye-fill', '2024-05-16 18:15:19', '0000-00-00 00:00:00'),
(3, 'EDIT', 'This is Edit', 'bi-pencil-square', '2024-05-16 18:15:53', '0000-00-00 00:00:00'),
(4, 'DELETE', 'This is Delete', 'bi-trash3-fill', '2024-05-28 00:31:01', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions_modules`
--

DROP TABLE IF EXISTS `permissions_modules`;
CREATE TABLE IF NOT EXISTS `permissions_modules` (
  `PermissionsModules_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `RoleModules_fk` int(11) UNSIGNED DEFAULT NULL,
  `Permissions_fk` int(11) UNSIGNED DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`PermissionsModules_id`),
  KEY `fk_permissions_modules_modules` (`RoleModules_fk`),
  KEY `fk_permissions_modules_permissions` (`Permissions_fk`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `permissions_modules`
--

INSERT INTO `permissions_modules` (`PermissionsModules_id`, `RoleModules_fk`, `Permissions_fk`, `create_at`, `update_at`) VALUES
(7, 1, 1, '2024-05-28 10:01:18', NULL),
(8, 1, 2, '2024-05-28 10:01:18', NULL),
(9, 1, 3, '2024-05-28 10:01:32', NULL),
(10, 1, 4, '2024-05-28 10:01:32', NULL),
(11, 2, 1, '2024-05-28 10:03:58', NULL),
(12, 2, 2, '2024-05-28 10:03:58', NULL),
(13, 2, 3, '2024-05-28 10:03:58', NULL),
(14, 2, 4, '2024-05-28 10:03:58', NULL),
(15, 4, 1, '2024-05-28 10:05:46', NULL),
(16, 4, 2, '2024-05-28 10:05:46', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profiles`
--

DROP TABLE IF EXISTS `profiles`;
CREATE TABLE IF NOT EXISTS `profiles` (
  `Profile_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Profile_email` varchar(255) NOT NULL,
  `Profile_name` varchar(30) NOT NULL,
  `Profile_photo` varchar(255) DEFAULT NULL,
  `User_id_fk` int(11) UNSIGNED DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Profile_id`),
  UNIQUE KEY `Profile_email` (`Profile_email`),
  KEY `fk_user_profile` (`User_id_fk`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `profiles`
--

INSERT INTO `profiles` (`Profile_id`, `Profile_email`, `Profile_name`, `Profile_photo`, `User_id_fk`, `create_at`, `update_at`) VALUES
(2, 'Diego@gmail.com', 'Diego Casallas', 'https://cdn-icons-png.flaticon.com/512/622/622848.png', 5, '2024-05-23 17:00:55', NULL),
(3, 'laura@gmail.com', 'Laura Camila', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQUzNr-zMxcqeJwrncR5YG1EN-ygMrDAz1_U5gwTqfJsg&s', 4, '2024-05-24 01:24:11', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `Roles_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Roles_name` varchar(30) NOT NULL,
  `Roles_description` varchar(300) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Roles_id`),
  UNIQUE KEY `Roles_name` (`Roles_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`Roles_id`, `Roles_name`, `Roles_description`, `create_at`, `update_at`) VALUES
(1, 'Admin', 'This is admin', '2024-05-16 18:11:57', '0000-00-00 00:00:00'),
(2, 'Test', 'This is test', '2024-05-16 18:12:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_modules`
--

DROP TABLE IF EXISTS `role_modules`;
CREATE TABLE IF NOT EXISTS `role_modules` (
  `RoleModules_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Modules_fk` int(11) UNSIGNED DEFAULT NULL,
  `Roles_fk` int(11) UNSIGNED DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`RoleModules_id`),
  KEY `fk_module` (`Modules_fk`),
  KEY `fk_roles` (`Roles_fk`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `role_modules`
--

INSERT INTO `role_modules` (`RoleModules_id`, `Modules_fk`, `Roles_fk`, `create_at`, `update_at`) VALUES
(1, 1, 1, '2024-05-16 18:16:45', NULL),
(2, 2, 1, '2024-05-16 18:16:45', NULL),
(3, 3, 1, '2024-05-16 18:16:57', NULL),
(4, 1, 2, '2024-05-16 18:17:06', NULL),
(5, 3, 2, '2024-05-17 16:10:31', NULL),
(6, 4, 1, '2024-05-25 17:14:07', NULL),
(7, 5, 1, '2024-05-25 19:04:12', NULL),
(8, 6, 1, '2024-05-27 15:47:26', NULL),
(9, 7, 1, '2024-05-27 20:14:50', NULL),
(10, 2, 2, '2024-05-28 00:38:57', NULL),
(11, 4, 2, '2024-05-28 00:39:26', NULL),
(12, 6, 2, '2024-05-28 00:39:54', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `User_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `User_user` varchar(255) NOT NULL,
  `User_password` varchar(255) NOT NULL,
  `Roles_fk` int(11) UNSIGNED DEFAULT NULL,
  `User_status_fk` int(11) UNSIGNED DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`User_id`),
  UNIQUE KEY `User_user` (`User_user`),
  KEY `fk_user_status` (`User_status_fk`),
  KEY `fk_user_role` (`Roles_fk`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`User_id`, `User_user`, `User_password`, `Roles_fk`, `User_status_fk`, `create_at`, `update_at`) VALUES
(4, 'd.casallas@sinapsist.com.co', '$2y$10$/F0Kxg/eZKVYX/Uq7GD6xO1IOfWYcYHgy10XrO7.GI7qkLB9yNFM2', 1, 1, '2024-05-18 10:07:53', '0000-00-00 00:00:00'),
(5, 'info@sinapsist.com.co', '$2y$10$/F0Kxg/eZKVYX/Uq7GD6xO1IOfWYcYHgy10XrO7.GI7qkLB9yNFM2', 2, 1, '2024-05-23 17:06:37', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_status`
--

DROP TABLE IF EXISTS `user_status`;
CREATE TABLE IF NOT EXISTS `user_status` (
  `User_status_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `User_status_name` varchar(30) NOT NULL,
  `User_status_description` varchar(300) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`User_status_id`),
  UNIQUE KEY `User_status_name` (`User_status_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `user_status`
--

INSERT INTO `user_status` (`User_status_id`, `User_status_name`, `User_status_description`, `create_at`, `update_at`) VALUES
(1, 'Active', 'Active', '2024-05-18 00:44:01', NULL),
(2, 'Inactive', 'Inactive', '2024-05-18 00:44:01', NULL),
(3, 'Blocked', 'This is Blocked', '2024-05-27 20:05:28', '0000-00-00 00:00:00'),
(4, 'Delete', 'Delete', '2024-06-01 20:44:23', '0000-00-00 00:00:00');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `permissions_modules`
--
ALTER TABLE `permissions_modules`
  ADD CONSTRAINT `fk_permissions_modules_modules` FOREIGN KEY (`RoleModules_fk`) REFERENCES `role_modules` (`RoleModules_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_permissions_modules_permissions` FOREIGN KEY (`Permissions_fk`) REFERENCES `permissions` (`Permissions_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`User_id_fk`) REFERENCES `users` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `role_modules`
--
ALTER TABLE `role_modules`
  ADD CONSTRAINT `fk_module` FOREIGN KEY (`Modules_fk`) REFERENCES `modules` (`Modules_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_roles` FOREIGN KEY (`Roles_fk`) REFERENCES `roles` (`Roles_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`Roles_fk`) REFERENCES `roles` (`Roles_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_status` FOREIGN KEY (`User_status_fk`) REFERENCES `user_status` (`User_status_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
