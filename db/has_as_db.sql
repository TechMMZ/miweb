-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-03-2025 a las 14:08:53
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `has_as_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `dni`, `nombres`, `password`) VALUES
(1, '12345678', 'Jean Meza', '$2y$10$4Vsdgl7XFtYppM1i28uOhOGdOfIB/QW01ryYUaPtycdBqUFvHyH/a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id` int(11) NOT NULL,
  `usuario_nombre` varchar(100) NOT NULL,
  `codigo_entrada_id` int(11) DEFAULT NULL,
  `codigo_salida_id` int(11) DEFAULT NULL,
  `fecha` date NOT NULL DEFAULT curdate(),
  `hora_entrada` time NOT NULL DEFAULT curtime(),
  `hora_salida` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigos`
--

CREATE TABLE `codigos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `codigo` varchar(8) NOT NULL,
  `fecha_generado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `enfermedades` text DEFAULT NULL,
  `horario_practicas` varchar(50) NOT NULL,
  `universidad_instituto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `dni`, `nombre`, `cargo`, `fecha_nacimiento`, `enfermedades`, `horario_practicas`, `universidad_instituto`) VALUES
(1, '72543001', 'ALEXIA F PAZ ZAPATA', 'PRACTICANTE DE MARKETING', '2004-04-06', 'GASTRITIS', '10:30 A 2:00PM', 'UNIVERSIDAD TECNOLOGICA DEL PERÚ'),
(2, '73214915', 'ASHLY V CARRASCO GARCIA', 'PRACTICANTE DE ADMINISTRACION', '2003-11-20', 'NINGUNA', '10:30 A 2:30PM', 'UNIVERSIDAD DE PIURA'),
(3, '74886401', 'BRENDA ARMIJOS RIVERA', 'PRACTICANTE DE MARKETING', '2003-08-15', 'GASTRITIS', '10:30 A 2:00PM', 'UNIVERSIDAD TECNOLOGICA DEL PERÚ'),
(4, '72195838', 'HELAR CHERO RUFINO', 'PRACTICANTE DE SISTEMAS', '2005-10-06', 'NINGUNA', '9:00 A 2:45 PM', 'SENATI'),
(5, '60426476', 'JEFERSSON SANDOVAL AQUINO', 'PRACTICANTE DE SISTEMAS', '2006-06-21', 'NINGUNA', '9:00 A 2:45 PM', 'SENATI'),
(6, '74503909', 'MAX FRANK MAZA ESTRADA', 'PRACTICANTE DE SISTEMAS', '2004-05-13', 'NINGUNA', '9:00 A 2:45 PM', 'SENATI'),
(7, '75531523', 'JOSÉ C PUELLES ROSAS', 'PRACTICANTE DE SISTEMAS', '2005-05-26', 'NINGUNA', '9:00 A 2:45 PM', 'SENATI'),
(8, '75115435', 'NORBI SOTOMAYOR TENE', 'PRACTICANTE DE MARKETING', '', 'NINGUNA', '', ''),
(9, '70699519', 'MANUEL A LITIANO FLORES', 'EDITOR', '', 'NINGUNA', '', ''),
(10, '75471873', 'ANGHELO A ALFONSO SULLON', 'DISEÑADOR', '', 'NINGUNA', '', ''),
(11, '71698208', 'MARÍA BELÉN CERDA LAZO', 'ENCARGADA DE MARKETING', '', 'NINGUNA', '', ''),
(12, '75453994', 'JOSELYN M VILELA MARQUEZ', 'ENCARGADA DE MARKETING', '', 'NINGUNA', '', ''),
(13, '71726586', 'NICK ALONSO CRUZ SOTO', 'EDITOR', '', 'NINGUNA', '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codigo_entrada_id` (`codigo_entrada_id`),
  ADD KEY `codigo_salida_id` (`codigo_salida_id`),
  ADD KEY `fk_usuario_nombre` (`usuario_nombre`);

--
-- Indices de la tabla `codigos`
--
ALTER TABLE `codigos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `codigos`
--
ALTER TABLE `codigos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`codigo_entrada_id`) REFERENCES `codigos` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `asistencia_ibfk_2` FOREIGN KEY (`codigo_salida_id`) REFERENCES `codigos` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_usuario_nombre` FOREIGN KEY (`usuario_nombre`) REFERENCES `usuarios` (`nombre`);

--
-- Filtros para la tabla `codigos`
--
ALTER TABLE `codigos`
  ADD CONSTRAINT `codigos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
