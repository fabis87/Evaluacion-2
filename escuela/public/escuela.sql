-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-09-2024 a las 00:09:39
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `escuela`
--
CREATE DATABASE IF NOT EXISTS `escuela` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `escuela`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones`
--

CREATE TABLE `asignaciones` (
  `asignacion_id` int(11) NOT NULL,
  `estudiante_id` int(11) NOT NULL,
  `profesor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asignaciones`
--

INSERT INTO `asignaciones` (`asignacion_id`, `estudiante_id`, `profesor_id`) VALUES
(3, 1, 1),
(4, 2, 2),
(5, 4, 5),
(6, 1, 3),
(7, 3, 2),
(8, 2, 1),
(9, 6, 1),
(10, 5, 5),
(11, 8, 1),
(12, 9, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `estudiante_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `grado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`estudiante_id`, `nombre`, `apellido`, `fecha_nacimiento`, `grado`) VALUES
(1, 'Adrian', 'Palacios', '2002-05-07', 'tercero'),
(2, 'Kevin', 'Barroso', '1999-08-04', 'septimo'),
(3, 'Gabriela', 'Gonsalez', '1991-05-29', 'terceroBGU'),
(4, 'Adnan', 'Ziyagil', '2010-09-03', 'quinto'),
(5, 'Mikaela', 'Salas', '2002-09-18', 'tercero BGU'),
(6, 'Francisco', 'Quinteros', '2010-07-08', 'quinto'),
(7, 'Paulo', 'Flores', '2010-03-12', 'quinto'),
(8, 'Giuliana', 'Rojas', '2002-07-22', '3ro BGU'),
(9, 'Jefferson', 'Montana', '2021-07-09', 'primero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `profesor_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `especialidad` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`profesor_id`, `nombre`, `apellido`, `especialidad`, `email`) VALUES
(1, 'Diego', 'Leon', 'quimico', 'diego03@gmail.com'),
(2, 'Luis', 'Lopez', 'lengua', 'luis003@gmail.com'),
(3, 'Julia', 'Lindao', 'ciencias', 'julia03@hotmail.com'),
(4, 'Ernesto', 'Guevara', 'educacion fisica', 'ernes2002@hotmail.es'),
(5, 'Paola', 'Farias', 'estetica', 'paola04@hot.com'),
(6, 'Maria Jose', 'Bermeo', 'matematica', 'majo09@hotmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD PRIMARY KEY (`asignacion_id`),
  ADD KEY `estudiante_id` (`estudiante_id`),
  ADD KEY `profesor_id` (`profesor_id`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`estudiante_id`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`profesor_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  MODIFY `asignacion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `estudiante_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `profesor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD CONSTRAINT `asignaciones_ibfk_1` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiantes` (`estudiante_id`),
  ADD CONSTRAINT `asignaciones_ibfk_2` FOREIGN KEY (`profesor_id`) REFERENCES `profesores` (`profesor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
