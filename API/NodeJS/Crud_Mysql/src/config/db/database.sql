-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-03-2025 a las 15:29:12
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
-- Base de datos: `api_nodejs`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_users`
--

DROP TABLE IF EXISTS `api_users`;
CREATE TABLE IF NOT EXISTS `api_users` (
  `Api_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `Api_user` varchar(60) NOT NULL,
  `Api_password` varchar(255) NOT NULL,
  `Api_role` enum('Admin','Read-only') NOT NULL,
  `Api_status` enum('Active','Inactive') NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Api_user_id`),
  UNIQUE KEY `Api_user` (`Api_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `api_users`
--

TRUNCATE TABLE `api_users`;
--
-- Volcado de datos para la tabla `api_users`
--

INSERT INTO `api_users` (`Api_user_id`, `Api_user`, `Api_password`, `Api_role`, `Api_status`, `Created_at`, `Updated_at`) VALUES
(2, 'user@email.com', '$2b$10$AePsbYEdKE.LXL3rziTgROaX1o5CFCz5K6Qkk0cb9tqwzO72uZrRa', 'Admin', 'Active', '2025-03-29 00:30:19', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `document_type`
--

DROP TABLE IF EXISTS `document_type`;
CREATE TABLE IF NOT EXISTS `document_type` (
  `Document_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `Document_type_name` varchar(20) NOT NULL,
  `Document_type_description` varchar(80) DEFAULT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Document_type_id`),
  UNIQUE KEY `Document_type_name` (`Document_type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `document_type`
--

TRUNCATE TABLE `document_type`;
--
-- Volcado de datos para la tabla `document_type`
--

INSERT INTO `document_type` (`Document_type_id`, `Document_type_name`, `Document_type_description`, `Created_at`, `Updated_at`) VALUES
(1, 'RC', 'Registro civil', '2025-03-28 07:52:32', NULL),
(2, 'TI', 'Tarjeta de identidad', '2025-03-28 07:52:32', NULL),
(3, 'CC', 'Cédula de ciudadanía', '2025-03-28 07:52:32', NULL),
(4, 'TE', 'Tarjeta de extranjería', '2025-03-28 07:52:32', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `Profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `Profile_name` varchar(20) NOT NULL,
  `Profile_last_name` varchar(20) NOT NULL,
  `Profile_document` varchar(11) NOT NULL,
  `Profile_email` varchar(30) NOT NULL,
  `Profile_phone` varchar(11) NOT NULL,
  `Profile_photo` varchar(100) NOT NULL,
  `Profile_address` varchar(30) NOT NULL,
  `Document_type_fk` int(11) NOT NULL,
  `User_fk` int(11) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Profile_id`),
  UNIQUE KEY `Profile_email` (`Profile_email`),
  UNIQUE KEY `User_fk` (`User_fk`),
  KEY `Document_type_fk` (`Document_type_fk`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `profile`
--

TRUNCATE TABLE `profile`;
--
-- Volcado de datos para la tabla `profile`
--

INSERT INTO `profile` (`Profile_id`, `Profile_name`, `Profile_last_name`, `Profile_document`, `Profile_email`, `Profile_phone`, `Profile_photo`, `Profile_address`, `Document_type_fk`, `User_fk`, `Created_at`, `Updated_at`) VALUES
(2, 'Juan Camilo', 'Castellaños', '1004477521', 'profile1@email.com', '3011234567', 'img/profile.png', 'Calle falsa 1234', 1, 1, '2025-03-28 07:53:18', '2025-03-28 14:03:47'),
(3, 'Pedro', 'Sanchez', '1004477521', 'profile@email.com', '3011234567', 'img/profile.png', 'Calle falsa 123', 1, 2, '2025-03-28 07:53:18', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `Role_id` int(11) NOT NULL AUTO_INCREMENT,
  `Role_name` varchar(20) NOT NULL,
  `Role_description` varchar(80) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Role_id`),
  UNIQUE KEY `Role_name` (`Role_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `role`
--

TRUNCATE TABLE `role`;
--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`Role_id`, `Role_name`, `Role_description`, `Created_at`, `Updated_at`) VALUES
(1, 'Admin', 'This is role Admin', '2025-03-28 07:53:48', NULL),
(2, 'Client', 'This is role client', '2025-03-28 17:11:22', '2025-03-28 17:14:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `User_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_user` varchar(60) NOT NULL,
  `User_password` varchar(255) NOT NULL,
  `User_status_fk` int(11) NOT NULL,
  `Role_fk` int(11) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`User_id`),
  UNIQUE KEY `User_user` (`User_user`),
  KEY `user_user_status` (`User_status_fk`),
  KEY `user_role` (`Role_fk`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `user`
--

TRUNCATE TABLE `user`;
--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`User_id`, `User_user`, `User_password`, `User_status_fk`, `Role_fk`, `Created_at`, `Updated_at`) VALUES
(1, 'user@email.com', '12345678', 1, 1, '2025-03-28 07:54:31', NULL),
(2, 'user1@email.com', '12345678', 1, 1, '2025-03-28 07:54:31', NULL),
(3, 'user3@email.com', '12345678', 1, 1, '2025-03-28 14:43:39', '2025-03-28 14:44:18'),
(5, 'user4@email.com', '$2b$10$EiUeACAsb3go8b8zr3TXc.7prymEzQ1Aq5Fbzhb6RlVIchX7qRxhW', 1, 1, '2025-03-28 16:55:44', NULL),
(6, 'user5@email.com', '$2b$10$0Tnt/NgP3asaTHJAFII7D.ONLTYbSP3JMGgXVATbgUyPDSAVgvQ2e', 1, 1, '2025-03-28 16:56:01', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_status`
--

DROP TABLE IF EXISTS `user_status`;
CREATE TABLE IF NOT EXISTS `user_status` (
  `User_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_status_name` varchar(20) NOT NULL,
  `User_status_description` varchar(80) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`User_status_id`),
  UNIQUE KEY `User_status_name` (`User_status_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `user_status`
--

TRUNCATE TABLE `user_status`;
--
-- Volcado de datos para la tabla `user_status`
--

INSERT INTO `user_status` (`User_status_id`, `User_status_name`, `User_status_description`, `Created_at`, `Updated_at`) VALUES
(1, 'Active', 'This is status active', '2025-03-28 07:55:02', NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_document_type` FOREIGN KEY (`Document_type_fk`) REFERENCES `document_type` (`Document_type_id`),
  ADD CONSTRAINT `profile_user` FOREIGN KEY (`User_fk`) REFERENCES `user` (`User_id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_role` FOREIGN KEY (`Role_fk`) REFERENCES `role` (`Role_id`),
  ADD CONSTRAINT `user_user_status` FOREIGN KEY (`User_status_fk`) REFERENCES `user_status` (`User_status_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
