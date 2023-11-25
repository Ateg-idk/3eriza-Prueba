-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 25-11-2023 a las 00:44:46
-- Versión del servidor: 8.0.28
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `practicabd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_backoffice`
--

DROP TABLE IF EXISTS `estados_backoffice`;
CREATE TABLE IF NOT EXISTS `estados_backoffice` (
  `id` int NOT NULL,
  `backoffice_nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `estados_backoffice`
--

INSERT INTO `estados_backoffice` (`id`, `backoffice_nombre`) VALUES
(1, 'Pendiente'),
(2, 'Aprobado'),
(3, 'Rechazado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_venta`
--

DROP TABLE IF EXISTS `estados_venta`;
CREATE TABLE IF NOT EXISTS `estados_venta` (
  `id` int NOT NULL,
  `nombre_estado` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `estados_venta`
--

INSERT INTO `estados_venta` (`id`, `nombre_estado`) VALUES
(1, 'En proceso'),
(2, 'Aprobada'),
(3, 'Aceptada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

DROP TABLE IF EXISTS `perfiles`;
CREATE TABLE IF NOT EXISTS `perfiles` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id`, `nombre`) VALUES
(1, 'asesor'),
(2, 'supervisor'),
(3, 'backoffice');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `perfil_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `perfil_id` (`perfil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `perfil_id`) VALUES
(1, 'Pedro Asesor', 1),
(2, 'Carlos Supervisor', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `asesor_id` int DEFAULT NULL,
  `estado_venta_id` int DEFAULT NULL,
  `tipo_documento` varchar(20) DEFAULT NULL,
  `numero_documento` varchar(20) DEFAULT NULL,
  `nombre_cliente` varchar(50) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `tipo_plan` varchar(20) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `nivel1` varchar(50) DEFAULT NULL,
  `nivel2` varchar(50) DEFAULT NULL,
  `nivel3` varchar(50) DEFAULT NULL,
  `activacion_inmediata` varchar(10) DEFAULT NULL,
  `mostrar_numero_sn` int DEFAULT NULL,
  `observaciones` varchar(500) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `estados_backoffice_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `asesor_id` (`asesor_id`),
  KEY `estado_venta_id` (`estado_venta_id`),
  KEY `estados_backoffice_id` (`estados_backoffice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `asesor_id`, `estado_venta_id`, `tipo_documento`, `numero_documento`, `nombre_cliente`, `telefono`, `tipo_plan`, `apellidos`, `nivel1`, `nivel2`, `nivel3`, `activacion_inmediata`, `mostrar_numero_sn`, `observaciones`, `fecha_creacion`, `estados_backoffice_id`) VALUES
(20, 1, 1, 'DNI', '73990824', 'Angelo', '930808867', 'ILIMITADO', 'Anticona', 'Contacto No Efectivo', 'No Venta', 'Acepta upgrade', 'Si', 0, 'dsadsadasd', '2023-11-24 05:00:00', NULL),
(21, 1, 1, 'RUC', '8123994', 'Diego', '9832323', 'REGULAR', 'Caceres', 'Contacto No Efectivo', 'No Llamar', 'Acepta upgrade + Renovación de equipo', 'Si', 0, 'dsadadsada', '2023-11-25 00:29:52', NULL),
(22, 1, 1, 'DNI', '73990824', 'Angelo', '930808867', 'REGULAR', 'Anticona', 'Contacto Efectivo', 'Venta', 'Acepta upgrade + Renovación de equipo', 'Si', 8328382, NULL, '2023-11-25 01:26:35', NULL),
(23, 1, 1, 'DNI', '73990824', 'Angelo', '930808867', 'REGULAR', 'Anticona', 'Contacto Efectivo', 'Venta', 'Acepta upgrade + Renovación de equipo', 'Si', 8328382, NULL, '2023-11-25 01:26:55', NULL),
(24, 1, 1, 'RUC', '8123994', 'Diego', '9832323', 'REGULAR', 'Caceres', 'Contacto No Efectivo', 'No Llamar', 'Acepta upgrade + Renovación de equipo', 'Si', 0, 'dsadadsada', '2023-11-25 01:26:58', NULL),
(25, 1, 1, 'DNI', '73990824', 'Angelo', '930808867', 'REGULAR', 'Anticona', 'Contacto Efectivo', 'Venta', 'Acepta upgrade + Renovación de equipo', 'Si', 8328382, NULL, '2023-11-25 01:55:21', NULL),
(26, 1, 1, 'DNI', '73990824', 'Angelo', '930808867', 'REGULAR', 'Anticona', 'Contacto Efectivo', 'Venta', 'Acepta upgrade + Renovación de equipo', 'Si', 8328382, NULL, NULL, NULL),
(27, 1, 1, 'DNI', '73990824', 'Angelo', '930808867', 'REGULAR', 'Anticona', 'Contacto Efectivo', 'Venta', 'Acepta upgrade + Renovación de equipo', 'Si', 8328382, NULL, '2023-11-25 01:58:11', NULL),
(28, 1, 1, 'DNI', '73990824', 'Angelo', '930808867', 'REGULAR', 'Anticona', 'Contacto Efectivo', 'Venta', 'Acepta upgrade + Renovación de equipo', 'Si', 8328382, NULL, NULL, NULL),
(29, 1, 1, 'DNI', '73990824', 'Angelo', '930808867', 'REGULAR', 'Anticona', 'Contacto Efectivo', 'Venta', 'Acepta upgrade + Renovación de equipo', 'Si', 8328382, NULL, '2023-11-25 02:00:34', NULL),
(30, 1, 1, 'C.E.', '73932332', 'Angelo', '930808867', 'ILIMITADO', 'Anticona', 'Contacto Efectivo', 'Venta', 'Acepta upgrade', 'Si', 0, 'DSADASDASDASD', '2023-11-25 02:00:43', NULL),
(31, 1, 1, 'C.E.', '73932332', 'Angelo', '930808867', 'ILIMITADO', 'Anticona', 'Contacto Efectivo', 'Venta', 'Acepta upgrade', 'Si', 0, 'DSADASDASDASD', '2023-11-25 02:00:48', NULL),
(32, 1, 1, 'DNI', '73990824', 'Angelo', '930808867', 'ILIMITADO', 'Anticona', 'Contacto No Efectivo', 'No Venta', 'Renovación de equipo', 'Seleccione', 8328382, 'hola añadiendo', NULL, NULL),
(33, 1, 1, 'C.E.', '73990023', 'Enrique', '93923932', 'ILIMITADO', 'Lara', 'Contacto No Efectivo', 'No Venta', 'Acepta upgrade + Renovación de equipo', 'No', 0, 'Si', NULL, NULL),
(34, 1, 1, 'C.E.', '73990023', 'Enrique', '93923932', 'ILIMITADO', 'Lara', 'Contacto No Efectivo', 'No Venta', 'Acepta upgrade + Renovación de equipo', 'No', 0, 'Si', NULL, NULL),
(35, 1, 1, 'C.E.', '73990824', 'Angelo', '930808867', 'ILIMITADO', 'Anticona', 'Contacto No Efectivo', 'Venta', 'Acepta upgrade + Renovación de equipo', 'Si', 0, 'sadasdasd', '2023-11-25 02:49:18', NULL),
(36, 1, 1, 'RUC', '73990824', 'Angelo', '930808867', 'ILIMITADO', 'Anticona', 'Contacto No Efectivo', 'Lamada Vicio', 'Renovación de equipo', 'Si', 0, 'sddasdas', '2023-11-25 02:49:29', NULL),
(37, 1, 1, 'RUC', '73990824', 'Angelo', '930808867', 'ILIMITADO', 'Anticona', 'Contacto No Efectivo', 'Lamada Vicio', 'Renovación de equipo', 'Si', 0, 'sddasdas', '2023-11-25 02:50:03', NULL),
(38, 1, 1, 'RUC', '73990824', 'Angelo', '930808867', 'ILIMITADO', 'Anticona', 'Contacto No Efectivo', 'Lamada Vicio', 'Renovación de equipo', 'Si', 0, 'sddasdas', '2023-11-25 02:52:07', NULL),
(39, 1, 1, 'DNI', '73990827', 'Torito', '930808867', 'ILIMITADO', 'Anticona', 'Contacto Efectivo', 'Agendado', 'Acepta upgrade + Renovación de equipo', 'Seleccione', 8328382, 'hola', '2023-11-25 05:26:36', NULL),
(40, 1, 1, 'DNI', '73990827', 'Heramno', '930808867', 'REGULAR', 'Anticona', 'Contacto No Efectivo', 'No Llamar', 'Cliente no desea recibir llamadas', 'Seleccione', 8328382, 'hola', '2023-11-25 05:26:51', NULL),
(41, 1, 1, 'DNI', '739908243232', 'Angelo', '930808867', 'ILIMITADO', 'Anticona', 'Contacto Efectivo', 'Venta', 'Acepta upgrade', 'Seleccione', 1233321, 'dsad', '2023-11-25 05:27:22', NULL),
(42, 1, 1, 'DNI', '73990824', 'Angelo', '930808867', 'ILIMITADO', 'Anticona', 'Contacto No Efectivo', 'No Llamar', 'Cliente no desea recibir llamadas', 'Seleccione', 1233321, 'DASDAS', '2023-11-25 05:30:59', NULL),
(43, 1, 1, 'RUC', '73990824345', 'Angelo', '930808867', 'ILIMITADO', 'Anticona', 'Contacto Efectivo', 'Venta', 'Acepta upgrade', 'Seleccione', 0, 'dsada', '2023-11-25 05:32:51', NULL),
(44, 1, 1, 'DNI', '73990824', 'Hola', '930808867', 'ILIMITADO', 'Anticona', 'Contacto Efectivo', 'Venta', 'Acepta upgrade', 'Seleccione', 1233321, 'dasdas', '2023-11-25 05:33:19', NULL),
(45, 1, 1, 'RUC', '73990824321', 'Angelo', '930808867', 'ILIMITADO', 'Anticona', 'Contacto Efectivo', 'Venta', 'Acepta upgrade', 'Seleccione', 0, 'sada', '2023-11-25 05:33:50', NULL),
(46, 1, 1, 'SELECCIONE', '739908242314', 'Gerad', '930808867', 'ILIMITADO', 'Anticona', 'Contacto Efectivo', 'Agendado', 'Renovación de equipo', 'Seleccione', 0, 'gerad', '2023-11-25 05:34:39', NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`asesor_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`estado_venta_id`) REFERENCES `estados_venta` (`id`),
  ADD CONSTRAINT `ventas_ibfk_3` FOREIGN KEY (`estados_backoffice_id`) REFERENCES `estados_backoffice` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
