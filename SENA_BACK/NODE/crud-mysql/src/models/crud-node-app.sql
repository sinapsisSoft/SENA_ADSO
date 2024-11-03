-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-11-2024 a las 22:55:33
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
-- Base de datos: `crud-node-app`
--
CREATE DATABASE IF NOT EXISTS `crud-node-app` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `crud-node-app`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(20) NOT NULL,
  `module_route` varchar(20) NOT NULL,
  `module_description` varchar(200) NOT NULL,
  PRIMARY KEY (`module_id`),
  UNIQUE KEY `module_name` (`module_name`),
  UNIQUE KEY `module_route` (`module_route`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `module`
--

TRUNCATE TABLE `module`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `role`
--

TRUNCATE TABLE `role`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_module`
--

DROP TABLE IF EXISTS `role_module`;
CREATE TABLE IF NOT EXISTS `role_module` (
  `roleModule_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_fk` int(11) NOT NULL,
  `module_fk` int(11) NOT NULL,
  PRIMARY KEY (`roleModule_id`),
  KEY `role_module_role` (`role_fk`),
  KEY `role_module_module` (`module_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `role_module`
--

TRUNCATE TABLE `role_module`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_user` varchar(30) NOT NULL,
  `user_password` varchar(256) NOT NULL,
  `userStatus_fk` int(11) NOT NULL,
  `role_fk` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_user` (`user_user`),
  KEY `userStatus_fk` (`userStatus_fk`),
  KEY `user_status` (`role_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `user`
--

TRUNCATE TABLE `user`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userstatus`
--

DROP TABLE IF EXISTS `userstatus`;
CREATE TABLE IF NOT EXISTS `userstatus` (
  `userStatus_id` int(11) NOT NULL AUTO_INCREMENT,
  `userStatus_name` varchar(20) NOT NULL,
  PRIMARY KEY (`userStatus_id`),
  UNIQUE KEY `userStatus_name` (`userStatus_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `userstatus`
--

TRUNCATE TABLE `userstatus`;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `role_module`
--
ALTER TABLE `role_module`
  ADD CONSTRAINT `role_module_module` FOREIGN KEY (`module_fk`) REFERENCES `module` (`module_id`),
  ADD CONSTRAINT `role_module_role` FOREIGN KEY (`role_fk`) REFERENCES `role` (`role_id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`userStatus_fk`) REFERENCES `userstatus` (`userStatus_id`),
  ADD CONSTRAINT `user_status` FOREIGN KEY (`role_fk`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
