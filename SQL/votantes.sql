-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 10-08-2023 a las 06:47:11
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `desis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votantes`
--

CREATE TABLE `votantes` (
  `id` int NOT NULL,
  `nombre_apellido` varchar(100) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `alias` varchar(20) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `rut` varchar(12) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `region_id` int NOT NULL,
  `comuna_id` int NOT NULL,
  `candidato` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `web` tinyint(1) NOT NULL DEFAULT '0',
  `tv` tinyint(1) NOT NULL DEFAULT '0',
  `redes_sociales` tinyint(1) NOT NULL DEFAULT '0',
  `amigo` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `votantes`
--
ALTER TABLE `votantes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rut` (`rut`),
  ADD KEY `region_id` (`region_id`),
  ADD KEY `comuna_id` (`comuna_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `votantes`
--
ALTER TABLE `votantes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `votantes`
--
ALTER TABLE `votantes`
  ADD CONSTRAINT `votantes_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regiones` (`id`),
  ADD CONSTRAINT `votantes_ibfk_2` FOREIGN KEY (`comuna_id`) REFERENCES `comunas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
