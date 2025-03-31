-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-03-2025 a las 17:54:13
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `api_users`
--

TRUNCATE TABLE `api_users`;
--
-- Volcado de datos para la tabla `api_users`
--

INSERT INTO `api_users` (`Api_user_id`, `Api_user`, `Api_password`, `Api_role`, `Api_status`, `Created_at`, `Updated_at`) VALUES
(1, 'user@email.com', '$2b$10$A.RezjA04B1GcvfGDnnve.elhd56BPN.44qUtvgyVG5Jy8IkwxoFi', 'Admin', 'Active', '2025-03-30 15:22:51', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
