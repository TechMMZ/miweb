-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Base de datos: `hashtagpe_as_db`
CREATE DATABASE IF NOT EXISTS `as_db`;
USE `as_db`;

-- --------------------------------------------------------

-- Estructura de tabla para `usuarios`
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `rol` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Estructura de tabla para `codigos`
CREATE TABLE `codigos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `codigo` varchar(8) NOT NULL UNIQUE,
  `fecha_generado` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `codigos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Estructura de tabla para `asistencia`
CREATE TABLE `asistencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_nombre` varchar(100) NOT NULL,
  `codigo_entrada_id` int(11) DEFAULT NULL,
  `codigo_salida_id` int(11) DEFAULT NULL,
  `fecha` date NOT NULL DEFAULT current_date(),
  `hora_entrada` time NOT NULL DEFAULT current_time(),
  `hora_salida` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `codigo_entrada_id` (`codigo_entrada_id`),
  KEY `codigo_salida_id` (`codigo_salida_id`),
  CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`codigo_entrada_id`) REFERENCES `codigos` (`id`) ON DELETE SET NULL,
  CONSTRAINT `asistencia_ibfk_2` FOREIGN KEY (`codigo_salida_id`) REFERENCES `codigos` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;
