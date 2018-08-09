-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 10-08-2016 a las 17:28:56
-- Versión del servidor: 5.0.51
-- Versión de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `jpetdeshdn`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `asistencia`
-- 

CREATE TABLE `asistencia` (
  `id_asistencia` int(11) NOT NULL,
  `id_usuario` varchar(45) collate utf8_unicode_ci NOT NULL,
  `fecha` date default NULL,
  `tipo` varchar(45) collate utf8_unicode_ci default NULL,
  `hora` timestamp NULL default CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Volcar la base de datos para la tabla `asistencia`
-- 

INSERT INTO `asistencia` (`id_asistencia`, `id_usuario`, `fecha`, `tipo`, `hora`) VALUES (4, 'vendedor1', NULL, 'Entrada', '2016-02-25 18:22:50');
INSERT INTO `asistencia` (`id_asistencia`, `id_usuario`, `fecha`, `tipo`, `hora`) VALUES (7, 'vendedor1', NULL, 'Entrada', '2016-02-19 18:22:50');
INSERT INTO `asistencia` (`id_asistencia`, `id_usuario`, `fecha`, `tipo`, `hora`) VALUES (15, 'vendedor1', NULL, 'Entrada', '2016-02-20 18:22:50');
INSERT INTO `asistencia` (`id_asistencia`, `id_usuario`, `fecha`, `tipo`, `hora`) VALUES (16, 'vendedor1', NULL, 'Entrada', '2016-02-22 18:22:50');
INSERT INTO `asistencia` (`id_asistencia`, `id_usuario`, `fecha`, `tipo`, `hora`) VALUES (17, 'vendedor1', NULL, 'Entrada', '2016-02-06 18:22:50');
INSERT INTO `asistencia` (`id_asistencia`, `id_usuario`, `fecha`, `tipo`, `hora`) VALUES (18, 'vendedor1', NULL, 'Entrada', '2016-02-10 18:22:50');
INSERT INTO `asistencia` (`id_asistencia`, `id_usuario`, `fecha`, `tipo`, `hora`) VALUES (19, 'jorge', NULL, 'Entrada', '2016-02-10 18:22:50');
INSERT INTO `asistencia` (`id_asistencia`, `id_usuario`, `fecha`, `tipo`, `hora`) VALUES (20, 'jorge', NULL, 'Entrada', '2016-02-04 18:22:50');
INSERT INTO `asistencia` (`id_asistencia`, `id_usuario`, `fecha`, `tipo`, `hora`) VALUES (21, 'vendedor2', NULL, 'Entrada', '2016-02-04 18:22:50');
INSERT INTO `asistencia` (`id_asistencia`, `id_usuario`, `fecha`, `tipo`, `hora`) VALUES (22, 'vendedor2', NULL, 'Entrada', '2016-02-10 18:22:50');
INSERT INTO `asistencia` (`id_asistencia`, `id_usuario`, `fecha`, `tipo`, `hora`) VALUES (23, 'vendedor2', NULL, 'Entrada', '2016-02-22 18:22:50');
INSERT INTO `asistencia` (`id_asistencia`, `id_usuario`, `fecha`, `tipo`, `hora`) VALUES (24, 'vendedor2', NULL, 'Entrada', '2016-02-11 18:22:50');
INSERT INTO `asistencia` (`id_asistencia`, `id_usuario`, `fecha`, `tipo`, `hora`) VALUES (25, 'vendedor2', NULL, 'Entrada', '2016-02-10 18:22:50');
INSERT INTO `asistencia` (`id_asistencia`, `id_usuario`, `fecha`, `tipo`, `hora`) VALUES (32, 'jorge', NULL, 'Entrada', '2016-03-15 16:19:33');
INSERT INTO `asistencia` (`id_asistencia`, `id_usuario`, `fecha`, `tipo`, `hora`) VALUES (34, 'jorge', NULL, 'Entrada', '2016-03-31 16:59:14');
INSERT INTO `asistencia` (`id_asistencia`, `id_usuario`, `fecha`, `tipo`, `hora`) VALUES (36, 'vendedor1', NULL, 'Entrada', '2016-03-31 16:59:25');
INSERT INTO `asistencia` (`id_asistencia`, `id_usuario`, `fecha`, `tipo`, `hora`) VALUES (37, 'jorge', NULL, 'Entrada', '2016-07-10 19:39:04');
INSERT INTO `asistencia` (`id_asistencia`, `id_usuario`, `fecha`, `tipo`, `hora`) VALUES (38, 'jorge', NULL, 'Salida', '2016-07-10 19:39:13');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `base_inventario`
-- 

CREATE TABLE `base_inventario` (
  `id_entrada_producto` int(11) default NULL,
  `id_producto` bigint(20) default NULL,
  `id_tienda` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `base_inventario`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `bitacora_accesos`
-- 

CREATE TABLE `bitacora_accesos` (
  `id_bitacoraaccesos` int(11) NOT NULL,
  `id_usuario` varchar(45) collate utf8_unicode_ci default NULL,
  `fecha_registro` timestamp NULL default CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Volcar la base de datos para la tabla `bitacora_accesos`
-- 

INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (1, '789.mx', '2016-02-11 15:18:10');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (2, '789.mx', '2016-02-12 00:53:45');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (3, '789.mx', '2016-02-12 00:53:50');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (4, '789.mx', '2016-02-12 00:56:50');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (5, '789.mx', '2016-02-16 19:07:29');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (6, '789.mx', '2016-02-16 21:45:33');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (7, '789.mx', '2016-02-17 23:48:07');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (8, '789.mx', '2016-02-20 16:47:39');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (9, '789.mx', '2016-02-23 04:02:31');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (10, '789.mx', '2016-02-23 05:53:18');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (11, '789.mx', '2016-02-23 05:54:04');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (12, '789.mx', '2016-02-23 19:18:03');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (13, '789.mx', '2016-02-24 03:15:08');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (14, '789.mx', '2016-02-24 15:29:29');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (15, 'ejoloy', '2016-02-24 15:37:00');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (16, 'ejoloy', '2016-02-24 15:37:24');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (17, '789.mx', '2016-02-24 15:38:25');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (18, '789.mx', '2016-02-24 16:50:11');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (19, 'vendedor1', '2016-02-24 17:18:36');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (20, 'vendedor1', '2016-02-24 17:24:44');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (21, '789.mx', '2016-02-24 17:36:10');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (22, '789.mx', '2016-02-24 17:37:24');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (23, '789.mx', '2016-02-24 18:01:01');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (24, 'liron', '2016-02-24 18:06:56');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (25, '789.mx', '2016-02-24 18:19:04');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (26, '789.mx', '2016-02-24 19:00:53');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (27, '789.mx', '2016-02-25 17:12:04');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (28, '789.mx', '2016-02-25 18:59:22');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (29, '789.mx', '2016-02-26 15:10:43');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (30, '789.mx', '2016-02-26 16:00:42');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (31, '789.mx', '2016-02-26 16:55:47');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (32, '789.mx', '2016-02-26 17:54:26');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (33, '789.mx', '2016-02-26 19:34:29');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (34, '789.mx', '2016-02-29 22:05:39');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (35, '789.mx', '2016-02-29 22:12:13');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (36, '789.mx', '2016-03-01 20:45:39');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (37, '789.mx', '2016-03-02 17:10:19');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (38, '789.mx', '2016-03-03 17:35:00');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (39, '789.mx', '2016-03-07 05:15:33');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (40, '789.mx', '2016-03-07 17:34:17');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (41, '789.mx', '2016-03-08 15:51:39');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (42, '789.mx', '2016-03-08 16:08:06');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (43, '789.mx', '2016-03-08 16:17:47');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (44, '789.mx', '2016-03-08 16:28:06');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (45, '789.mx', '2016-03-08 16:47:08');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (46, '789.mx', '2016-03-08 17:07:28');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (47, '789.mx', '2016-03-08 17:08:56');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (48, '789.mx', '2016-03-08 17:19:26');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (49, '789.mx', '2016-03-08 17:20:05');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (50, 'jorge', '2016-03-08 17:21:16');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (51, 'jorge', '2016-03-09 02:06:58');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (52, '789.mx', '2016-03-10 16:45:41');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (53, '789.mx', '2016-03-10 19:21:01');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (54, '789.mx', '2016-03-10 19:24:41');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (55, '789.mx', '2016-03-10 19:26:18');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (56, 'jorge', '2016-03-11 02:27:14');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (57, 'jorge', '2016-03-11 05:44:27');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (58, 'jorge', '2016-03-11 20:27:32');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (59, 'jorge', '2016-03-14 15:10:40');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (60, '789.mx', '2016-03-14 20:37:07');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (61, '2385', '2016-03-14 20:56:03');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (62, 'jorge', '2016-03-14 23:56:31');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (63, 'jorge', '2016-03-15 15:01:43');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (64, 'jorge', '2016-03-15 16:12:16');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (65, 'jorge', '2016-03-15 18:28:18');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (66, 'jorge', '2016-03-15 21:46:53');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (67, '789.mx', '2016-03-15 23:12:34');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (68, 'jorge', '2016-03-16 01:27:45');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (69, '789.mx', '2016-03-18 18:41:48');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (70, 'jorge', '2016-03-22 21:40:58');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (71, 'jorge', '2016-03-23 17:19:24');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (72, 'jorge', '2016-03-28 16:01:22');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (73, 'jorge', '2016-03-28 18:21:11');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (74, 'jorge', '2016-03-29 00:08:19');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (75, 'jorge', '2016-03-30 15:07:12');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (76, 'jorge', '2016-03-30 15:13:52');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (77, 'jorge', '2016-03-31 15:16:56');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (78, '789.mx', '2016-04-04 15:06:27');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (79, '789.mx', '2016-04-04 18:58:48');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (80, '789.mx', '2016-04-04 19:15:17');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (81, '789.mx', '2016-04-04 19:16:59');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (82, '789.mx', '2016-04-11 14:31:13');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (83, '789.mx', '2016-04-11 23:36:27');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (84, '789.mx', '2016-04-12 16:55:55');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (85, '789.mx', '2016-04-12 19:22:58');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (86, '789.mx', '2016-04-12 22:30:10');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (87, '789.mx', '2016-04-13 15:26:09');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (88, '789.mx', '2016-04-13 15:54:24');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (89, 'jorge', '2016-04-13 18:44:25');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (90, '789.mx', '2016-04-13 18:54:40');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (91, '789.mx', '2016-04-14 17:47:10');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (92, 'jorge', '2016-04-14 18:03:56');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (93, 'jorge', '2016-04-15 17:42:22');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (94, 'jorge', '2016-04-18 15:00:56');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (95, 'jorge', '2016-04-18 20:58:26');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (96, '789.mx', '2016-04-19 14:53:45');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (97, '789.mx', '2016-04-19 14:58:47');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (98, '789.mx', '2016-04-19 18:33:16');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (99, '789.mx', '2016-04-27 18:33:42');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (100, 'jorge', '2016-04-28 23:35:33');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (101, '789.mx', '2016-05-09 15:15:11');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (102, '789.mx', '2016-05-11 21:07:20');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (103, '789.mx', '2016-05-12 02:31:22');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (104, '789.mx', '2016-05-12 15:11:19');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (105, 'jorge', '2016-07-04 21:45:05');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (106, '789.mx', '2016-07-10 19:27:52');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (107, '789.mx', '2016-07-10 19:38:42');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (108, '789.mx', '2016-07-13 12:16:17');
INSERT INTO `bitacora_accesos` (`id_bitacoraaccesos`, `id_usuario`, `fecha_registro`) VALUES (109, 'jorge', '2016-08-06 22:01:05');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `categoria`
-- 

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `descuento` double default '0',
  `descuento_activado` tinyint(4) default '0',
  `categoria` varchar(45) collate utf8_unicode_ci default NULL,
  `status` varchar(45) collate utf8_unicode_ci default 'ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Volcar la base de datos para la tabla `categoria`
-- 

INSERT INTO `categoria` (`id_categoria`, `descuento`, `descuento_activado`, `categoria`, `status`) VALUES (1, 0, 0, 'No asignado', 'ACTIVO');
INSERT INTO `categoria` (`id_categoria`, `descuento`, `descuento_activado`, `categoria`, `status`) VALUES (2, 0, 0, 'FACE CARE', 'BAJA');
INSERT INTO `categoria` (`id_categoria`, `descuento`, `descuento_activado`, `categoria`, `status`) VALUES (3, 0, 0, 'Labial', 'ACTIVO');
INSERT INTO `categoria` (`id_categoria`, `descuento`, `descuento_activado`, `categoria`, `status`) VALUES (4, 0, 0, 'Esmalte', 'ACTIVO');
INSERT INTO `categoria` (`id_categoria`, `descuento`, `descuento_activado`, `categoria`, `status`) VALUES (5, 0, 0, 'Cabello', 'ACTIVO');
INSERT INTO `categoria` (`id_categoria`, `descuento`, `descuento_activado`, `categoria`, `status`) VALUES (6, 0, 0, 'Face', 'ACTIVO');
INSERT INTO `categoria` (`id_categoria`, `descuento`, `descuento_activado`, `categoria`, `status`) VALUES (7, 0, 0, 'Aceites', 'ACTIVO');
INSERT INTO `categoria` (`id_categoria`, `descuento`, `descuento_activado`, `categoria`, `status`) VALUES (8, 0, 0, 'Mascara', 'ACTIVO');
INSERT INTO `categoria` (`id_categoria`, `descuento`, `descuento_activado`, `categoria`, `status`) VALUES (9, 0, 0, 'Faja', 'ACTIVO');
INSERT INTO `categoria` (`id_categoria`, `descuento`, `descuento_activado`, `categoria`, `status`) VALUES (10, 0, 0, 'Maleta/Bolsa', 'ACTIVO');
INSERT INTO `categoria` (`id_categoria`, `descuento`, `descuento_activado`, `categoria`, `status`) VALUES (11, 0, 0, 'Bisuteria', 'ACTIVO');
INSERT INTO `categoria` (`id_categoria`, `descuento`, `descuento_activado`, `categoria`, `status`) VALUES (12, 0, 0, 'Accesorios', 'ACTIVO');
INSERT INTO `categoria` (`id_categoria`, `descuento`, `descuento_activado`, `categoria`, `status`) VALUES (13, 0, 0, 'Decoracion', 'ACTIVO');
INSERT INTO `categoria` (`id_categoria`, `descuento`, `descuento_activado`, `categoria`, `status`) VALUES (14, 0, 0, ' Brocha', 'ACTIVO');
INSERT INTO `categoria` (`id_categoria`, `descuento`, `descuento_activado`, `categoria`, `status`) VALUES (15, 0, 0, 'Koreano', 'ACTIVO');
INSERT INTO `categoria` (`id_categoria`, `descuento`, `descuento_activado`, `categoria`, `status`) VALUES (16, 0, 0, 'NAILS', 'ACTIVO');
INSERT INTO `categoria` (`id_categoria`, `descuento`, `descuento_activado`, `categoria`, `status`) VALUES (17, 0, 0, 'BROCHA', 'ACTIVO');
INSERT INTO `categoria` (`id_categoria`, `descuento`, `descuento_activado`, `categoria`, `status`) VALUES (18, 0, 0, 'BODY', 'ACTIVO');
INSERT INTO `categoria` (`id_categoria`, `descuento`, `descuento_activado`, `categoria`, `status`) VALUES (19, 0, 0, 'LENCERIA', 'ACTIVO');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `comisiones`
-- 

CREATE TABLE `comisiones` (
  `id_comisiones` int(11) NOT NULL auto_increment,
  `concepto` varchar(100) default NULL,
  `fecha_registro` timestamp NULL default CURRENT_TIMESTAMP,
  `fecha_inicial` varchar(45) default NULL,
  `fecha_final` varchar(45) default NULL,
  `vendedor` varchar(45) default NULL,
  `id_usuario` varchar(45) default NULL,
  `status` varchar(45) default 'ACTIVO',
  PRIMARY KEY  (`id_comisiones`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- 
-- Volcar la base de datos para la tabla `comisiones`
-- 

INSERT INTO `comisiones` (`id_comisiones`, `concepto`, `fecha_registro`, `fecha_inicial`, `fecha_final`, `vendedor`, `id_usuario`, `status`) VALUES (1, NULL, '2016-04-11 15:38:47', ' 2016-03-01 ', ' 2016-03-15 ', ' ', '789.mx', 'ACTIVO');
INSERT INTO `comisiones` (`id_comisiones`, `concepto`, `fecha_registro`, `fecha_inicial`, `fecha_final`, `vendedor`, `id_usuario`, `status`) VALUES (2, NULL, '2016-04-12 22:32:22', ' 2016-03-01 ', ' 2016-03-15 ', '789.mx ', '789.mx', 'ACTIVO');
INSERT INTO `comisiones` (`id_comisiones`, `concepto`, `fecha_registro`, `fecha_inicial`, `fecha_final`, `vendedor`, `id_usuario`, `status`) VALUES (3, NULL, '2016-04-13 18:50:28', ' 2016-03-15 ', ' 2016-03-31 ', ' ', 'jorge', 'ACTIVO');
INSERT INTO `comisiones` (`id_comisiones`, `concepto`, `fecha_registro`, `fecha_inicial`, `fecha_final`, `vendedor`, `id_usuario`, `status`) VALUES (4, NULL, '2016-04-13 18:57:55', ' 2016-03-15 ', ' 2016-03-31 ', ' ', '789.mx', 'ACTIVO');
INSERT INTO `comisiones` (`id_comisiones`, `concepto`, `fecha_registro`, `fecha_inicial`, `fecha_final`, `vendedor`, `id_usuario`, `status`) VALUES (5, NULL, '2016-04-13 18:58:46', ' 2016-03-15 ', ' 2016-03-31 ', ' ', '789.mx', 'ACTIVO');
INSERT INTO `comisiones` (`id_comisiones`, `concepto`, `fecha_registro`, `fecha_inicial`, `fecha_final`, `vendedor`, `id_usuario`, `status`) VALUES (6, NULL, '2016-04-13 18:58:52', ' 2016-03-15 ', ' 2016-03-31 ', ' ', 'jorge', 'ACTIVO');
INSERT INTO `comisiones` (`id_comisiones`, `concepto`, `fecha_registro`, `fecha_inicial`, `fecha_final`, `vendedor`, `id_usuario`, `status`) VALUES (7, NULL, '2016-04-13 19:00:34', ' 2016-03-15 ', ' 2016-03-31 ', ' ', '789.mx', 'ACTIVO');
INSERT INTO `comisiones` (`id_comisiones`, `concepto`, `fecha_registro`, `fecha_inicial`, `fecha_final`, `vendedor`, `id_usuario`, `status`) VALUES (8, NULL, '2016-04-13 19:01:25', ' 2016-03-15 ', ' 2016-03-31 ', ' ', '789.mx', 'ACTIVO');
INSERT INTO `comisiones` (`id_comisiones`, `concepto`, `fecha_registro`, `fecha_inicial`, `fecha_final`, `vendedor`, `id_usuario`, `status`) VALUES (9, NULL, '2016-04-14 18:05:17', ' 2016-04-01 ', ' 2016-04-15 ', '789.mx ', '789.mx', 'ACTIVO');
INSERT INTO `comisiones` (`id_comisiones`, `concepto`, `fecha_registro`, `fecha_inicial`, `fecha_final`, `vendedor`, `id_usuario`, `status`) VALUES (10, NULL, '2016-04-18 21:28:43', ' 2016-03-01 ', ' 2016-03-15 ', ' ', 'jorge', 'ACTIVO');
INSERT INTO `comisiones` (`id_comisiones`, `concepto`, `fecha_registro`, `fecha_inicial`, `fecha_final`, `vendedor`, `id_usuario`, `status`) VALUES (11, NULL, '2016-04-19 14:54:32', ' 2016-03-15 ', ' 2016-03-31 ', ' ', '789.mx', 'ACTIVO');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `comisiones_vendedor`
-- 

CREATE TABLE `comisiones_vendedor` (
  `id_comisiones_vendedor` int(11) NOT NULL auto_increment,
  `id_comisiones` int(11) default NULL,
  `idsusuario` varchar(45) default NULL,
  `status` varchar(45) default 'ACTIVO',
  `totalvtas` double default NULL,
  `totalasis` int(11) default NULL,
  `descgastos` double default NULL,
  `montocomi` double default NULL,
  `porcen` int(11) default NULL,
  `totalcomi` double default NULL,
  `id_tienda` int(11) default NULL,
  PRIMARY KEY  (`id_comisiones_vendedor`),
  KEY `ID_comi_dx_idx` (`id_comisiones`),
  KEY `id_tiendadxcomi_idx` (`id_tienda`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- 
-- Volcar la base de datos para la tabla `comisiones_vendedor`
-- 

INSERT INTO `comisiones_vendedor` (`id_comisiones_vendedor`, `id_comisiones`, `idsusuario`, `status`, `totalvtas`, `totalasis`, `descgastos`, `montocomi`, `porcen`, `totalcomi`, `id_tienda`) VALUES (1, 1, '789.mx ', 'ACTIVO', 1000, 2, 10, 490, 20, 98, 12);
INSERT INTO `comisiones_vendedor` (`id_comisiones_vendedor`, `id_comisiones`, `idsusuario`, `status`, `totalvtas`, `totalasis`, `descgastos`, `montocomi`, `porcen`, `totalcomi`, `id_tienda`) VALUES (2, 1, 'jorge ', 'ACTIVO', 1500, 1, 45, 1455, 20, 291, 13);
INSERT INTO `comisiones_vendedor` (`id_comisiones_vendedor`, `id_comisiones`, `idsusuario`, `status`, `totalvtas`, `totalasis`, `descgastos`, `montocomi`, `porcen`, `totalcomi`, `id_tienda`) VALUES (3, 2, '789.mx ', 'ACTIVO', 10, 2, 3, 2, 80, 1.6, 12);
INSERT INTO `comisiones_vendedor` (`id_comisiones_vendedor`, `id_comisiones`, `idsusuario`, `status`, `totalvtas`, `totalasis`, `descgastos`, `montocomi`, `porcen`, `totalcomi`, `id_tienda`) VALUES (4, 3, 'jorge ', 'ACTIVO', 10, 2, 2, 3, 20, 0.6, 13);
INSERT INTO `comisiones_vendedor` (`id_comisiones_vendedor`, `id_comisiones`, `idsusuario`, `status`, `totalvtas`, `totalasis`, `descgastos`, `montocomi`, `porcen`, `totalcomi`, `id_tienda`) VALUES (5, 4, 'jorge ', 'ACTIVO', 10, 2, 0, 5, 20, 1, 13);
INSERT INTO `comisiones_vendedor` (`id_comisiones_vendedor`, `id_comisiones`, `idsusuario`, `status`, `totalvtas`, `totalasis`, `descgastos`, `montocomi`, `porcen`, `totalcomi`, `id_tienda`) VALUES (6, 5, 'jorge ', 'ACTIVO', 100, 2, 1, 49, 20, 9.8, 13);
INSERT INTO `comisiones_vendedor` (`id_comisiones_vendedor`, `id_comisiones`, `idsusuario`, `status`, `totalvtas`, `totalasis`, `descgastos`, `montocomi`, `porcen`, `totalcomi`, `id_tienda`) VALUES (7, 6, 'jorge ', 'ACTIVO', 100, 2, 1, 49, 20, 9.8, 13);
INSERT INTO `comisiones_vendedor` (`id_comisiones_vendedor`, `id_comisiones`, `idsusuario`, `status`, `totalvtas`, `totalasis`, `descgastos`, `montocomi`, `porcen`, `totalcomi`, `id_tienda`) VALUES (8, 7, 'jorge ', 'ACTIVO', 100, 2, 0, 50, 10, 5, 13);
INSERT INTO `comisiones_vendedor` (`id_comisiones_vendedor`, `id_comisiones`, `idsusuario`, `status`, `totalvtas`, `totalasis`, `descgastos`, `montocomi`, `porcen`, `totalcomi`, `id_tienda`) VALUES (9, 8, 'jorge ', 'ACTIVO', 10, 2, 0, 5, 20, 1, 13);
INSERT INTO `comisiones_vendedor` (`id_comisiones_vendedor`, `id_comisiones`, `idsusuario`, `status`, `totalvtas`, `totalasis`, `descgastos`, `montocomi`, `porcen`, `totalcomi`, `id_tienda`) VALUES (10, 9, '789.mx ', 'ACTIVO', 135, 1, 0, 135, 20, 27, 12);
INSERT INTO `comisiones_vendedor` (`id_comisiones_vendedor`, `id_comisiones`, `idsusuario`, `status`, `totalvtas`, `totalasis`, `descgastos`, `montocomi`, `porcen`, `totalcomi`, `id_tienda`) VALUES (11, 10, '789.mx ', 'ACTIVO', 100, 2, 3, 50, 20, 7, 12);
INSERT INTO `comisiones_vendedor` (`id_comisiones_vendedor`, `id_comisiones`, `idsusuario`, `status`, `totalvtas`, `totalasis`, `descgastos`, `montocomi`, `porcen`, `totalcomi`, `id_tienda`) VALUES (12, 10, 'jorge ', 'ACTIVO', 100, 1, 7, 100, 20, 13, 13);
INSERT INTO `comisiones_vendedor` (`id_comisiones_vendedor`, `id_comisiones`, `idsusuario`, `status`, `totalvtas`, `totalasis`, `descgastos`, `montocomi`, `porcen`, `totalcomi`, `id_tienda`) VALUES (13, 10, 'prueba ', 'ACTIVO', 0, 0, 0, 0, 0, 0, 14);
INSERT INTO `comisiones_vendedor` (`id_comisiones_vendedor`, `id_comisiones`, `idsusuario`, `status`, `totalvtas`, `totalasis`, `descgastos`, `montocomi`, `porcen`, `totalcomi`, `id_tienda`) VALUES (14, 11, 'jorge ', 'ACTIVO', 1000, 2, 50, 500, 20, 50, 13);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `datos_facturacion`
-- 

CREATE TABLE `datos_facturacion` (
  `id_datos_facturacion` int(11) NOT NULL auto_increment,
  `serie` varchar(45) collate utf8_unicode_ci default NULL,
  `folio_inicial` int(11) default NULL,
  `folio_actual` int(11) default NULL,
  `predeterminado` tinyint(4) default '0',
  `id_persona` bigint(20) NOT NULL,
  PRIMARY KEY  (`id_datos_facturacion`),
  KEY `fk_datos_facturacion_persona1_idx` (`id_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `datos_facturacion`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `descgastos_comision`
-- 

CREATE TABLE `descgastos_comision` (
  `id_descgastos_comision` int(11) NOT NULL auto_increment,
  `monto` double default NULL,
  `id_comisiones_vendedor` int(11) default NULL,
  `concepto` varchar(100) default NULL,
  `fecha_registro` timestamp NULL default CURRENT_TIMESTAMP,
  `status` varchar(45) default 'ACTIVO',
  PRIMARY KEY  (`id_descgastos_comision`),
  KEY `ID_COMIDXVENDEDOR_idx` (`id_comisiones_vendedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Volcar la base de datos para la tabla `descgastos_comision`
-- 

INSERT INTO `descgastos_comision` (`id_descgastos_comision`, `monto`, `id_comisiones_vendedor`, `concepto`, `fecha_registro`, `status`) VALUES (1, 1, 11, 'prueba1', '2016-04-18 21:28:43', 'ACTIVO');
INSERT INTO `descgastos_comision` (`id_descgastos_comision`, `monto`, `id_comisiones_vendedor`, `concepto`, `fecha_registro`, `status`) VALUES (2, 2, 11, 'prueba2', '2016-04-18 21:28:43', 'ACTIVO');
INSERT INTO `descgastos_comision` (`id_descgastos_comision`, `monto`, `id_comisiones_vendedor`, `concepto`, `fecha_registro`, `status`) VALUES (3, 3, 12, 'prueba3', '2016-04-18 21:28:43', 'ACTIVO');
INSERT INTO `descgastos_comision` (`id_descgastos_comision`, `monto`, `id_comisiones_vendedor`, `concepto`, `fecha_registro`, `status`) VALUES (4, 4, 12, 'prueba4', '2016-04-18 21:28:43', 'ACTIVO');
INSERT INTO `descgastos_comision` (`id_descgastos_comision`, `monto`, `id_comisiones_vendedor`, `concepto`, `fecha_registro`, `status`) VALUES (5, 50, 14, 'prestamo', '2016-04-19 14:54:32', 'ACTIVO');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `descuentos`
-- 

CREATE TABLE `descuentos` (
  `id_descuentos` int(11) NOT NULL auto_increment,
  `id_usuario` varchar(45) default NULL,
  `porcentajedesc` varchar(45) default NULL,
  `montodesc` double default NULL,
  `totaldesc` double default NULL,
  `id_venta` bigint(20) NOT NULL,
  `fecha_registro` timestamp NULL default CURRENT_TIMESTAMP,
  `descripciondesc` varchar(80) default NULL,
  `status` varchar(45) default 'ACTIVO',
  PRIMARY KEY  (`id_descuentos`),
  KEY `id_venta1_idx` (`id_venta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `descuentos`
-- 


-- --------------------------------------------------------

-- 
-- Estructura Stand-in para la vista `detalle_ventascorte`
-- 
CREATE TABLE `detalle_ventascorte` (
`id` int(1)
,`id_venta` null
,`cantidad` null
,`codinter` null
,`nombre` null
,`exento_iva` null
,`exento_ieps` null
,`fecha` null
,`total` null
,`tipo` null
,`id_usuario` null
,`id_tienda` null
);
-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `deudores`
-- 

CREATE TABLE `deudores` (
  `id_deudores` int(11) NOT NULL auto_increment,
  `id_venta` bigint(20) default NULL,
  `id_persona` bigint(20) default NULL,
  `fecha_abono` varchar(45) default NULL,
  `fecha_registro` timestamp NULL default CURRENT_TIMESTAMP,
  `status` varchar(45) default 'ACTIVA',
  `montoabono` double default NULL,
  `id_usuario` varchar(45) default NULL,
  `id_tienda` int(11) default NULL,
  PRIMARY KEY  (`id_deudores`),
  KEY `id_venta_idx` (`id_venta`),
  KEY `id_persona_idx` (`id_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `deudores`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `entrada`
-- 

CREATE TABLE `entrada` (
  `id_entrada` int(11) NOT NULL auto_increment,
  `fecha_registro` timestamp NULL default CURRENT_TIMESTAMP,
  `fecha` timestamp NULL default NULL,
  `costo_total` double default NULL,
  `total` double default NULL,
  `concepto` varchar(45) collate utf8_unicode_ci default 'Entrada de Almacen',
  `folio` varchar(45) collate utf8_unicode_ci default NULL,
  `referencia` varchar(45) collate utf8_unicode_ci default NULL,
  `cancelado` tinyint(4) default '0',
  `id_usuario` varchar(45) collate utf8_unicode_ci NOT NULL,
  `id_tienda` int(11) NOT NULL default '6',
  `comentarios` varchar(45) collate utf8_unicode_ci default NULL,
  `status` varchar(45) collate utf8_unicode_ci default 'SOLICITADO',
  `ticket_items` text collate utf8_unicode_ci,
  PRIMARY KEY  (`id_entrada`),
  KEY `fk_entrada_usuario1_idx` (`id_usuario`),
  KEY `id_tienda_idx` (`id_tienda`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `entrada`
-- 

INSERT INTO `entrada` (`id_entrada`, `fecha_registro`, `fecha`, `costo_total`, `total`, `concepto`, `folio`, `referencia`, `cancelado`, `id_usuario`, `id_tienda`, `comentarios`, `status`, `ticket_items`) VALUES (1, '2016-08-14 05:00:00', '2016-08-14 05:00:00', NULL, NULL, 'Inventario inicial', '1', 'Inventario inicial', 0, 'jorge', 13, 'Inventario inicial', 'SOLICITADO', NULL);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `entrada_producto`
-- 

CREATE TABLE `entrada_producto` (
  `id_entrada_producto` int(11) NOT NULL auto_increment,
  `id_producto` bigint(20) NOT NULL,
  `fechare_gistro` timestamp NULL default CURRENT_TIMESTAMP,
  `cantidad` double default NULL,
  `status` varchar(45) collate utf8_unicode_ci NOT NULL default 'ACTIVO',
  `costo` double NOT NULL default '0',
  `multiplicador` double default NULL,
  `precio` double default NULL,
  `iva` varchar(45) collate utf8_unicode_ci default NULL,
  `cantvendida` double default '0',
  `ieps` double default '0',
  `id_entrada` int(11) NOT NULL,
  `totalcosto` double default '0',
  `nombre` varchar(100) collate utf8_unicode_ci default NULL,
  `id_tienda` int(11) default NULL,
  `precio_descuento` double default NULL,
  `cancelado` tinyint(4) default '0',
  `cantidad_anterior` double default NULL,
  `precio_costo` double default '0',
  PRIMARY KEY  (`id_entrada_producto`),
  KEY `fk_entrada_producto_producto1` (`id_producto`),
  KEY `id_entrada_idx` (`id_entrada`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `entrada_producto`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `entrada_productocancelado`
-- 

CREATE TABLE `entrada_productocancelado` (
  `id_entrada_productocancelado` int(11) NOT NULL auto_increment,
  `id_usuario` varchar(45) default NULL,
  `fecha_registro` timestamp NULL default CURRENT_TIMESTAMP,
  `id_entrada_producto` int(11) default NULL,
  PRIMARY KEY  (`id_entrada_productocancelado`),
  KEY `id_entra_idx` (`id_entrada_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `entrada_productocancelado`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `factura`
-- 

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL auto_increment,
  `serie` varchar(45) collate utf8_unicode_ci default NULL COMMENT '	',
  `folio` int(11) default NULL,
  `subtotal` double default NULL,
  `impuestos` double default NULL,
  `total` double default NULL,
  `status` varchar(20) collate utf8_unicode_ci default 'ACTIVA',
  `urlxml` text collate utf8_unicode_ci,
  `urlpdf` text collate utf8_unicode_ci,
  `metodo_de_pago` varchar(45) collate utf8_unicode_ci default NULL,
  `forma_de_pago` varchar(45) collate utf8_unicode_ci default NULL,
  `fecha_registro` timestamp NULL default CURRENT_TIMESTAMP,
  `digitos` varchar(45) collate utf8_unicode_ci default NULL,
  `tipo_comprobante` varchar(45) collate utf8_unicode_ci default NULL,
  `id_persona` bigint(20) NOT NULL,
  `id_venta` bigint(20) default NULL,
  `cancelada` int(11) default '0',
  `iva` double default NULL,
  `ieps` double default NULL,
  `id_usuario` varchar(45) collate utf8_unicode_ci default NULL,
  `fechainicial` varchar(45) collate utf8_unicode_ci default NULL,
  `fechafinal` varchar(45) collate utf8_unicode_ci default NULL,
  `id_usuariocancelacion` varchar(45) collate utf8_unicode_ci default NULL,
  `fecha_cancelacion` varchar(45) collate utf8_unicode_ci default NULL,
  `exentos` double default NULL,
  PRIMARY KEY  (`id_factura`),
  KEY `fk_factura_persona1_idx` (`id_persona`),
  KEY `fk_factura_venta1_idx` (`id_venta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `factura`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `gasto`
-- 

CREATE TABLE `gasto` (
  `id_gasto` int(11) NOT NULL auto_increment,
  `concepto` varchar(45) collate utf8_unicode_ci default NULL,
  `fecha` date default NULL,
  `monto` double default NULL,
  PRIMARY KEY  (`id_gasto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `gasto`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `inventariocostomensual`
-- 

CREATE TABLE `inventariocostomensual` (
  `id` tinyint(4) NOT NULL,
  `id_tienda` tinyint(4) NOT NULL,
  `existencias` tinyint(4) NOT NULL,
  `precio` tinyint(4) NOT NULL,
  `precio_mayoreo` tinyint(4) NOT NULL,
  `costo` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `inventariocostomensual`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `marca`
-- 

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL auto_increment,
  `nombre` varchar(200) collate utf8_unicode_ci default NULL,
  `descuento` double default '0',
  `descuento_activado` tinyint(4) default '0',
  PRIMARY KEY  (`id_marca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=58 ;

-- 
-- Volcar la base de datos para la tabla `marca`
-- 

INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (1, 'No asignada', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (2, 'Shelo Nabel', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (4, 'MARCA PRUEBA', 10, 1);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (5, 'Bissu', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (6, 'Prolux', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (7, 'SHE MAKEUP', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (8, 'Kejel Jabibe', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (9, 'Nabi', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (10, 'My Colors', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (11, 'Hanifee', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (12, 'Santeé', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (13, 'Organix', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (14, 'Apple', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (15, 'Meng Ping', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (16, 'Profusion', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (18, 'Naturone', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (19, 'JEICA  ORGANIX', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (20, 'Jabibe', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (21, 'LUXURY', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (22, 'LIME CRIME', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (23, 'LIP SMACKER', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (24, 'MISS MAJOR', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (25, 'L.A. GIRL', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (26, 'KLEANCOLOR', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (27, 'ROMANTIC BEAR', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (28, 'JORDANA', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (29, 'SANIYE', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (30, 'PENIEL COSMETIC', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (31, 'HANLFEI', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (33, 'FULLY ROSE', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (34, 'NYX', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (35, 'KYLIE', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (36, 'BIOCOSMETIC', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (38, 'ALARGA', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (39, 'AVON', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (40, 'ASEPXIA', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (41, 'BELLA', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (42, 'CALA NATURALE', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (43, 'CITY COLOR', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (44, 'DERMAL', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (45, 'DEVLIN', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (46, 'KLEANCOLOR', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (47, 'LUIGI BRA', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (48, 'RETRO POP', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (49, 'ITALIA', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (50, 'PRINCESSA', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (51, 'PROFUSSION', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (52, 'SHAERY', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (53, 'TNGO', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (54, 'TONY MOLY', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (55, 'USHAS', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (56, 'VERONICA CONTI', 0, 0);
INSERT INTO `marca` (`id_marca`, `nombre`, `descuento`, `descuento_activado`) VALUES (57, 'YOUNIQUE', 0, 0);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `paquete`
-- 

CREATE TABLE `paquete` (
  `id_paquete` int(11) NOT NULL auto_increment,
  `id_producto` bigint(20) default NULL,
  `id_productocompuesto` bigint(20) default NULL,
  `nombre` varchar(45) default NULL,
  `status` varchar(45) default 'ACTIVO',
  `fecha_registro` timestamp NULL default CURRENT_TIMESTAMP,
  `id_usuario` varchar(45) default NULL,
  `cantidad` double default NULL,
  `comentarios` text,
  PRIMARY KEY  (`id_paquete`),
  KEY `id_opr_idx` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `paquete`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `persona`
-- 

CREATE TABLE `persona` (
  `id_persona` bigint(20) NOT NULL auto_increment,
  `nombre` varchar(250) collate utf8_unicode_ci default NULL,
  `rfc` varchar(20) collate utf8_unicode_ci default NULL,
  `calle` varchar(200) collate utf8_unicode_ci default NULL,
  `num_exterior` varchar(45) collate utf8_unicode_ci default NULL,
  `num_interior` varchar(45) collate utf8_unicode_ci default NULL,
  `colonia` varchar(100) collate utf8_unicode_ci default NULL,
  `ciudad` varchar(100) collate utf8_unicode_ci default NULL,
  `estado` varchar(100) collate utf8_unicode_ci default NULL,
  `codigo_postal` varchar(10) collate utf8_unicode_ci default NULL,
  `pais` varchar(80) collate utf8_unicode_ci default 'MEXICO',
  `email` varchar(150) collate utf8_unicode_ci NOT NULL,
  `fecha_registro` timestamp NULL default CURRENT_TIMESTAMP,
  `id_usuario_tipo` bigint(20) NOT NULL,
  `ap_paterno` varchar(45) collate utf8_unicode_ci default NULL,
  `ap_materno` varchar(45) collate utf8_unicode_ci default NULL,
  `st_idcliente` varchar(45) collate utf8_unicode_ci default NULL,
  `fecha_nacimiento` text collate utf8_unicode_ci,
  `status` varchar(45) collate utf8_unicode_ci NOT NULL default 'ACTIVO',
  `id_tienda` int(11) default NULL,
  `razon_social` varchar(100) collate utf8_unicode_ci default NULL,
  `lada` varchar(45) collate utf8_unicode_ci default NULL,
  `telefono` varchar(45) collate utf8_unicode_ci default NULL,
  `observaciones` varchar(100) collate utf8_unicode_ci default NULL,
  `banco` varchar(45) collate utf8_unicode_ci default NULL,
  `num_cuenta` varchar(45) collate utf8_unicode_ci default NULL,
  `dir_cuenta` varchar(100) collate utf8_unicode_ci default NULL,
  `tiempo_credito` varchar(45) collate utf8_unicode_ci default NULL,
  `celular` varchar(45) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id_persona`),
  KEY `fk_persona_usuario_tipo1_idx` (`id_usuario_tipo`),
  KEY `id_tienda_idx` (`id_tienda`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10115 ;

-- 
-- Volcar la base de datos para la tabla `persona`
-- 

INSERT INTO `persona` (`id_persona`, `nombre`, `rfc`, `calle`, `num_exterior`, `num_interior`, `colonia`, `ciudad`, `estado`, `codigo_postal`, `pais`, `email`, `fecha_registro`, `id_usuario_tipo`, `ap_paterno`, `ap_materno`, `st_idcliente`, `fecha_nacimiento`, `status`, `id_tienda`, `razon_social`, `lada`, `telefono`, `observaciones`, `banco`, `num_cuenta`, `dir_cuenta`, `tiempo_credito`, `celular`) VALUES (1, 'Administrador', '1234', 'calle1', '1', '2', 'col', 'cd', 'edo', '1233', 'MEXICO', 'email@hotmail.com', '2014-07-28 16:44:21', 2, 'adminpat', 'adminmat', '', '07/15/2014', 'ACTIVO', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `persona` (`id_persona`, `nombre`, `rfc`, `calle`, `num_exterior`, `num_interior`, `colonia`, `ciudad`, `estado`, `codigo_postal`, `pais`, `email`, `fecha_registro`, `id_usuario_tipo`, `ap_paterno`, `ap_materno`, `st_idcliente`, `fecha_nacimiento`, `status`, `id_tienda`, `razon_social`, `lada`, `telefono`, `observaciones`, `banco`, `num_cuenta`, `dir_cuenta`, `tiempo_credito`, `celular`) VALUES (2, 'Venta al publico ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MEXICO', '', '2016-07-10 21:18:26', 0, NULL, NULL, NULL, NULL, 'ACTIVO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `persona` (`id_persona`, `nombre`, `rfc`, `calle`, `num_exterior`, `num_interior`, `colonia`, `ciudad`, `estado`, `codigo_postal`, `pais`, `email`, `fecha_registro`, `id_usuario_tipo`, `ap_paterno`, `ap_materno`, `st_idcliente`, `fecha_nacimiento`, `status`, `id_tienda`, `razon_social`, `lada`, `telefono`, `observaciones`, `banco`, `num_cuenta`, `dir_cuenta`, `tiempo_credito`, `celular`) VALUES (3, 'YAC', '', '', '', '', '', '', '', '', 'MEXICO', '', '2016-02-24 15:36:48', 3, ' ', ' ', '', '02/16/2016', 'ACTIVO', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `persona` (`id_persona`, `nombre`, `rfc`, `calle`, `num_exterior`, `num_interior`, `colonia`, `ciudad`, `estado`, `codigo_postal`, `pais`, `email`, `fecha_registro`, `id_usuario_tipo`, `ap_paterno`, `ap_materno`, `st_idcliente`, `fecha_nacimiento`, `status`, `id_tienda`, `razon_social`, `lada`, `telefono`, `observaciones`, `banco`, `num_cuenta`, `dir_cuenta`, `tiempo_credito`, `celular`) VALUES (10113, 'Shelo Nabel', ' ', ' ', '', '', '', ' ', '  ', ' ', 'MEXICO', ' ', '2016-07-10 19:56:52', 3, ' ', ' ', NULL, '07/19/2016', 'ACTIVO', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `persona` (`id_persona`, `nombre`, `rfc`, `calle`, `num_exterior`, `num_interior`, `colonia`, `ciudad`, `estado`, `codigo_postal`, `pais`, `email`, `fecha_registro`, `id_usuario_tipo`, `ap_paterno`, `ap_materno`, `st_idcliente`, `fecha_nacimiento`, `status`, `id_tienda`, `razon_social`, `lada`, `telefono`, `observaciones`, `banco`, `num_cuenta`, `dir_cuenta`, `tiempo_credito`, `celular`) VALUES (10114, 'Andori', ' ', '  ', ' ', ' ', ' ', ' ', ' ', ' ', 'MEXICO', ' ', '2016-07-10 19:57:19', 3, ' ', ' ', NULL, '07/04/2016', 'ACTIVO', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `producto`
-- 

CREATE TABLE `producto` (
  `id_producto` bigint(20) NOT NULL auto_increment,
  `nombre` varchar(200) collate utf8_unicode_ci default NULL,
  `precio` double default NULL,
  `costo` double default NULL,
  `precio_descuento` double default '0',
  `descuento_activado` tinyint(4) default '0',
  `status` varchar(45) collate utf8_unicode_ci default 'ACTIVO',
  `codbarras` varchar(45) collate utf8_unicode_ci default NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `multiplicador` double default NULL,
  `id_categoria` int(11) NOT NULL,
  `fecha_registro` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `codinter` varchar(45) collate utf8_unicode_ci NOT NULL,
  `condiciones` varchar(45) collate utf8_unicode_ci NOT NULL,
  `exento_iva` int(11) default '0',
  `ieps` double default '0',
  `paquete` tinyint(4) default '0',
  `alerta_minima` double default NULL,
  `exento_ieps` tinyint(4) default '0',
  `precio_costo` double default '0',
  `imagen` text collate utf8_unicode_ci,
  PRIMARY KEY  (`id_producto`),
  KEY `nombre` (`nombre`),
  KEY `fk_producto_proveedor1_idx` (`id_proveedor`),
  KEY `fk_producto_marca1_idx` (`id_marca`),
  KEY `fk_producto_categoria1_idx` (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=499 ;

-- 
-- Volcar la base de datos para la tabla `producto`
-- 

INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (24, 'PESTANAS POSTIZAS', 10, 0, 7, 0, 'ACTIVO', '10879', 1, 1, 1.5, 12, '2016-08-13 04:36:43', '10879', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (25, 'SUSPIRO 01', 50, 0, 45, 0, 'ACTIVO', '362021', 1, 5, 1.5, 3, '2016-08-13 04:37:19', '362021', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (26, 'SEX APPEAL 02', 50, 0, 45, 0, 'ACTIVO', '362022', 1, 5, 1.5, 3, '2016-08-13 04:37:19', '362022', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (27, 'INTUICION 03', 50, 0, 45, 0, 'ACTIVO', '362023', 1, 5, 1.5, 3, '2016-08-13 04:37:19', '362023', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (28, 'FANTASIA 04', 50, 0, 45, 0, 'ACTIVO', '362024', 1, 5, 1.5, 3, '2016-08-13 04:37:19', '362024', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (29, 'CLICHE 05', 50, 0, 45, 0, 'ACTIVO', '362025', 1, 5, 1.5, 3, '2016-08-13 04:37:19', '362025', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (30, 'PINK ENERGY 06', 50, 0, 45, 0, 'ACTIVO', '362026', 1, 5, 1.5, 3, '2016-08-13 04:37:19', '362026', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (31, 'RUMOR 07', 50, 0, 45, 0, 'ACTIVO', '362027', 1, 5, 1.5, 3, '2016-08-13 04:37:19', '362027', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (32, 'POISON 10', 50, 0, 45, 0, 'ACTIVO', '362030', 1, 5, 1.5, 3, '2016-08-13 04:37:20', '362030', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (33, 'PASION 11', 50, 0, 45, 0, 'ACTIVO', '362031', 1, 5, 1.5, 3, '2016-08-13 04:37:20', '362031', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (34, 'RED VELVET 13', 50, 0, 45, 0, 'ACTIVO', '362033', 1, 5, 1.5, 3, '2016-08-13 04:37:20', '362033', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (35, 'MOUSSE FRIZZ-EASE', 20, 0, 0, 0, 'ACTIVO', '132-8', 1, 1, 1.5, 5, '2016-08-13 04:37:20', '132-8', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (36, 'ACEITE DE ARGAN 125ML', 60, 0, 0, 0, 'ACTIVO', '142-A', 1, 1, 1.5, 5, '2016-08-13 04:37:20', '142-A', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (37, 'SHAMPOO COLA DE CABALLO 950ML', 120, 0, 0, 0, 'ACTIVO', '180-S', 1, 1, 1.5, 5, '2016-08-13 04:37:20', '180-S', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (38, 'DESMAQUILLANTE BIOCOSMETIC 50ML', 27.5, 0, 0, 0, 'ACTIVO', '20-DOS', 1, 36, 1.5, 6, '2016-08-13 04:37:20', '20-DOS', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (39, 'DESMAQUILLANTE BIOCOSMETIC 70ML', 30, 0, 0, 0, 'ACTIVO', '20-TRES', 1, 36, 1.5, 6, '2016-08-13 04:37:20', '20-TRES', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (40, 'SHAMPOO DE ARGAN 950ML', 99, 0, 0, 0, 'ACTIVO', '340-S', 1, 1, 1.5, 5, '2016-08-13 04:37:20', '340-S', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (41, 'DESMAQUILLANTE DEVLIN 125ML', 30, 0, 0, 0, 'ACTIVO', '381-D', 1, 45, 1.5, 6, '2016-08-13 04:37:20', '381-D', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (42, 'SEPARADOR DE PESTANAS', 25, 0, 0, 0, 'ACTIVO', '44-C', 1, 1, 1.5, 12, '2016-08-13 04:37:20', '44-C', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (43, 'APLICADOR DE RIMEL', 15, 0, 0, 0, 'ACTIVO', '45-C', 1, 1, 1.5, 12, '2016-08-13 04:37:20', '45-C', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (44, 'DESMAQUILLANTE KEJEL JABIBE 30ML', 15, 0, 0, 0, 'ACTIVO', '480-F', 1, 8, 1.5, 6, '2016-08-13 04:37:20', '480-F', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (45, 'BOLSA CHICA FRUTAS', 120, 0, 0, 0, 'ACTIVO', '572-B', 1, 1, 1.5, 10, '2016-08-13 04:37:20', '572-B', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (46, 'BOLSA MEDIANA FRUTAS', 160, 0, 0, 0, 'ACTIVO', '573-B', 1, 1, 1.5, 10, '2016-08-13 04:37:20', '573-B', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (47, 'FAJA NEGRA', 150, 0, 0, 0, 'ACTIVO', '622-F', 1, 1, 1.5, 9, '2016-08-13 04:37:20', '622-F', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (48, 'SEDA BI FACE 260ML', 60, 0, 0, 0, 'ACTIVO', '734-S', 1, 1, 1.5, 5, '2016-08-13 04:37:20', '734-S', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (49, 'ACEITES CHICOS', 12, 0, 0, 0, 'ACTIVO', 'AC-001', 1, 1, 1.5, 7, '2016-08-13 04:37:20', 'AC-001', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (50, 'ACEITES MEDIANOS', 15, 0, 0, 0, 'ACTIVO', 'AC-002', 1, 1, 1.5, 7, '2016-08-13 04:37:20', 'AC-002', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (51, 'ACETONA LIQUIDA', 15, 0, 0, 0, 'ACTIVO', 'ACT-01', 1, 1, 1.5, 16, '2016-08-13 04:37:20', 'ACT-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (52, 'ARETE ARGOLLA', 5, 0, 0, 0, 'ACTIVO', 'ART-AR', 1, 1, 1.5, 11, '2016-08-13 04:37:20', 'ART-AR', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (53, 'ARETE BOLA', 15, 0, 0, 0, 'ACTIVO', 'ART-BOL', 1, 1, 1.5, 11, '2016-08-13 04:37:20', 'ART-BOL', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (54, 'ARETE DE FRUTA', 10, 0, 0, 0, 'ACTIVO', 'ART-FT', 1, 1, 1.5, 11, '2016-08-13 04:37:20', 'ART-FT', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (55, 'ARETE DE FRUTA PLASTICO', 3, 0, 0, 0, 'ACTIVO', 'ART-FT-01', 1, 1, 1.5, 11, '2016-08-13 04:37:20', 'ART-FT-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (56, 'ARETE DE GATO', 20, 0, 0, 0, 'ACTIVO', 'ART-GT2', 1, 1, 1.5, 11, '2016-08-13 04:37:20', 'ART-GT2', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (57, 'ARETE LARGO', 75, 0, 0, 0, 'ACTIVO', 'ART-LA01', 1, 1, 1.5, 11, '2016-08-13 04:37:20', 'ART-LA01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (58, 'ARETE METALICO', 20, 0, 0, 0, 'ACTIVO', 'ART-M1', 1, 1, 1.5, 11, '2016-08-13 04:37:20', 'ART-M1', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (59, 'ARETE CON LUZ', 75, 0, 0, 0, 'ACTIVO', 'ART-PL-02', 1, 1, 1.5, 11, '2016-08-13 04:37:20', 'ART-PL-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (60, 'ARETE PLANTA ZOMBIE', 75, 0, 0, 0, 'ACTIVO', 'ART-PZ-01', 1, 1, 1.5, 11, '2016-08-13 04:37:20', 'ART-PZ-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (61, 'ARETE TORNILLO', 45, 0, 0, 0, 'ACTIVO', 'ART-TO1', 1, 1, 1.5, 11, '2016-08-13 04:37:20', 'ART-TO1', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (62, 'ASEPXIA SPOT', 15, 0, 0, 0, 'ACTIVO', 'ASPX-01', 1, 40, 1.5, 6, '2016-08-13 04:37:20', 'ASPX-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (63, 'ASEPXIA CAMUFLAGE', 30, 0, 0, 0, 'ACTIVO', 'ASPX-02', 1, 40, 1.5, 6, '2016-08-13 04:37:20', 'ASPX-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (64, 'MAQUILLAJE EN POLVO COMPACTO ASEPXIA', 45, 0, 0, 0, 'ACTIVO', 'AX-MP-01', 1, 40, 1.5, 6, '2016-08-13 04:37:20', 'AX-MP-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (65, 'BANANA SOBRE', 16, 0, 0, 0, 'ACTIVO', 'BANANA-S', 1, 54, 1.5, 15, '2016-08-13 04:37:20', 'BANANA-S', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (66, 'BBCREAM FUNDATION CREAM', 30, 0, 0, 0, 'ACTIVO', 'BB-01', 1, 1, 1.5, 6, '2016-08-13 04:37:20', 'BB-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (67, 'BEETIT', 100, 0, 0, 0, 'ACTIVO', 'BEETIT', 1, 22, 1.5, 3, '2016-08-13 04:37:20', 'BEETIT', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (68, 'BOLSA GRANDE DAMA', 150, 0, 0, 0, 'ACTIVO', 'BOL-DG', 1, 1, 1.5, 10, '2016-08-13 04:37:20', 'BOL-DG', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (69, 'BOLSA EMOJI', 60, 0, 0, 0, 'ACTIVO', 'BOL-E1', 1, 1, 1.5, 10, '2016-08-13 04:37:20', 'BOL-E1', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (70, 'BOLSA MEDIANA DAMA', 50, 0, 0, 0, 'ACTIVO', 'BOL-MD', 1, 1, 1.5, 10, '2016-08-13 04:37:20', 'BOL-MD', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (71, 'TIRANTE DE BRASIER', 10, 0, 0, 0, 'ACTIVO', 'BRA-584', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'BRA-584', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (72, 'BROCHA DUO PARA SOMBRA 2 PZA', 20, 0, 0, 0, 'ACTIVO', 'BRO-002', 1, 1, 1.5, 17, '2016-08-13 04:37:20', 'BRO-002', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (73, 'BROCHA PARA BRONCEAR 1 PZA', 35, 0, 0, 0, 'ACTIVO', 'BRO-003', 1, 30, 1.5, 17, '2016-08-13 04:37:20', 'BRO-003', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (74, 'CARTERA DE BROCHAS 12 PZA', 100, 0, 0, 0, 'ACTIVO', 'BRO-12', 1, 1, 1.5, 17, '2016-08-13 04:37:20', 'BRO-12', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (75, 'CARTERA DE BROCHAS 24 PZA', 400, 0, 0, 0, 'ACTIVO', 'BRO-24', 1, 1, 1.5, 17, '2016-08-13 04:37:20', 'BRO-24', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (76, 'CARTERA DE BROCHAS 32 PZA', 500, 0, 0, 0, 'ACTIVO', 'BRO-32', 1, 1, 1.5, 17, '2016-08-13 04:37:20', 'BRO-32', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (77, 'BROCHA PARA CORRECTOR 1 PZA', 50, 0, 0, 0, 'ACTIVO', 'BRO-76408', 1, 42, 1.5, 17, '2016-08-13 04:37:20', 'BRO-76408', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (78, 'BROCHA PARA SOMBRA 1 PZA', 35, 0, 0, 0, 'ACTIVO', 'BRO-803', 1, 1, 1.5, 17, '2016-08-13 04:37:20', 'BRO-803', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (79, 'BROCHA PARA POLVO 1 PZA', 50, 0, 0, 0, 'ACTIVO', 'BRO-B120', 1, 50, 1.5, 17, '2016-08-13 04:37:20', 'BRO-B120', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (80, 'BROCHA DE ABANICO PLANO', 50, 0, 0, 0, 'ACTIVO', 'BRO-BS-MB-011', 1, 29, 1.5, 17, '2016-08-13 04:37:20', 'BRO-BS-MB-011', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (81, 'BROCHA PARA COLORETE CON ANGULO', 40, 0, 0, 0, 'ACTIVO', 'BRO-BS-MB-023', 1, 29, 1.5, 17, '2016-08-13 04:37:20', 'BRO-BS-MB-023', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (82, 'BROCHA PARA CORRECTOR 1 PZA', 30, 0, 0, 0, 'ACTIVO', 'BRO-BS-MB-027', 1, 29, 1.5, 17, '2016-08-13 04:37:20', 'BRO-BS-MB-027', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (83, 'BROCHA PARA CEJAS EN ANGULO', 30, 0, 0, 0, 'ACTIVO', 'BRO-BS-MB-031', 1, 29, 1.5, 17, '2016-08-13 04:37:20', 'BRO-BS-MB-031', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (84, 'BROCHA PARA POLVO 1 PZA', 35, 0, 0, 0, 'ACTIVO', 'BRO-CB756', 1, 46, 1.5, 17, '2016-08-13 04:37:20', 'BRO-CB756', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (85, 'BROCHA PARA SOMBRA 1 PZA', 20, 0, 0, 0, 'ACTIVO', 'BRO-CB758', 1, 46, 1.5, 17, '2016-08-13 04:37:20', 'BRO-CB758', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (86, 'BROCHA PARA CORRECTOR 1 PZA', 30, 0, 0, 0, 'ACTIVO', 'BRO-CB759', 1, 46, 1.5, 17, '2016-08-13 04:37:20', 'BRO-CB759', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (87, 'BROCHA CON ESPONJA', 55, 0, 0, 0, 'ACTIVO', 'BRO-ESP-01', 1, 1, 1.5, 17, '2016-08-13 04:37:20', 'BRO-ESP-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (88, 'BROCHA CON ESPONJA', 45, 0, 0, 0, 'ACTIVO', 'BRO-ESP-02', 1, 1, 1.5, 17, '2016-08-13 04:37:20', 'BRO-ESP-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (89, 'PAQUETE DE BROCHAS MARIPOSA 5 PZA', 27, 0, 0, 0, 'ACTIVO', 'BRO-IN', 1, 1, 1.5, 17, '2016-08-13 04:37:20', 'BRO-IN', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (90, 'PAQUETE DE BROCHAS AZUL Y BLANCO 5 PZA', 40, 0, 0, 0, 'ACTIVO', 'BRO-PC1', 1, 30, 1.5, 17, '2016-08-13 04:37:20', 'BRO-PC1', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (91, 'PAQUETE DE BROCHAS ROJO Y ROSA', 45, 0, 0, 0, 'ACTIVO', 'BRO-PC2', 1, 30, 1.5, 17, '2016-08-13 04:37:20', 'BRO-PC2', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (92, 'PAQUETE DE BROCHAS PROFUSSION 5 PZA', 30, 0, 0, 0, 'ACTIVO', 'BRO-PF', 1, 51, 1.5, 17, '2016-08-13 04:37:20', 'BRO-PF', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (93, 'BROCHA RETRACTIL EN COLORES', 45, 0, 0, 0, 'ACTIVO', 'BRO-RE-01', 1, 1, 1.5, 17, '2016-08-13 04:37:20', 'BRO-RE-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (94, 'BRONCEADO EN CREMA TNGO', 65, 0, 0, 0, 'ACTIVO', 'BR-TN-01', 1, 53, 1.5, 18, '2016-08-13 04:37:20', 'BR-TN-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (95, 'BUFFY', 100, 0, 0, 0, 'ACTIVO', 'BUFFY', 1, 22, 1.5, 3, '2016-08-13 04:37:20', 'BUFFY', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (96, 'PERFILADOR 1 PZA', 25, 0, 0, 0, 'ACTIVO', 'CAL-1PEG', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'CAL-1PEG', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (97, 'PERFILADOR 3 PZA', 50, 0, 0, 0, 'ACTIVO', 'CAL-3PT4', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'CAL-3PT4', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (98, 'PERFILADOR 3 PZA', 45, 0, 0, 0, 'ACTIVO', 'CAL-4PET', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'CAL-4PET', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (99, 'CC CREAM', 35, 0, 0, 0, 'ACTIVO', 'CC-705', 1, 31, 1.5, 6, '2016-08-13 04:37:20', 'CC-705', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (100, 'ESMALTE FOSFORECENTE', 20, 0, 0, 0, 'ACTIVO', 'CL-96', 1, 1, 1.5, 16, '2016-08-13 04:37:20', 'CL-96', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (101, 'CORRECTOR AMUSE 5 COLORES CHICO', 35, 0, 0, 0, 'ACTIVO', 'CO-AM-01', 1, 1, 1.5, 6, '2016-08-13 04:37:20', 'CO-AM-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (102, 'CORRECTOR EN LAPIZ BISSU VIOLET', 25, 0, 0, 0, 'ACTIVO', 'CO-BS-01', 1, 5, 1.5, 6, '2016-08-13 04:37:20', 'CO-BS-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (103, 'CORRECTOR EN LAPIZ BISSU GREEN', 25, 0, 0, 0, 'ACTIVO', 'CO-BS-02', 1, 5, 1.5, 6, '2016-08-13 04:37:20', 'CO-BS-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (104, 'CORRECTOR EN LAPIZ BISSU GOLD BEIGE', 25, 0, 0, 0, 'ACTIVO', 'CO-BS-03', 1, 5, 1.5, 6, '2016-08-13 04:37:20', 'CO-BS-03', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (105, 'CORRECTOR EN LAPIZ BISSU BRICK', 25, 0, 0, 0, 'ACTIVO', 'CO-BS-04', 1, 5, 1.5, 6, '2016-08-13 04:37:20', 'CO-BS-04', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (106, 'CORRECTOR PROFUSSION 5 COLORES CHICO', 40, 0, 0, 0, 'ACTIVO', 'CO-CC-C1', 1, 51, 1.5, 6, '2016-08-13 04:37:20', 'CO-CC-C1', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (107, 'CORRECTOR EN GEL JABIBE', 25, 0, 0, 0, 'ACTIVO', 'CO-GL-01', 1, 20, 1.5, 6, '2016-08-13 04:37:20', 'CO-GL-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (108, 'CORRECTOR Y RUBOR 10 COLORES GRANDE', 80, 0, 0, 0, 'ACTIVO', 'CO-HE-01', 1, 33, 1.5, 6, '2016-08-13 04:37:20', 'CO-HE-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (109, 'CORRECTOR KISS BEAUTY 2O COLORES GRANDE', 100, 0, 0, 0, 'ACTIVO', 'CO-KB-01', 1, 1, 1.5, 6, '2016-08-13 04:37:20', 'CO-KB-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (110, 'COLLAR CERPIENTE', 100, 0, 0, 0, 'ACTIVO', 'COLL-01', 1, 1, 1.5, 11, '2016-08-13 04:37:20', 'COLL-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (111, 'CORRECTOR MY COLORS 10 COLORES GRANDE', 85, 0, 0, 0, 'ACTIVO', 'CO-MC-G1', 1, 10, 1.5, 6, '2016-08-13 04:37:20', 'CO-MC-G1', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (112, 'CORRECTOR MELS 6 COLORES MEDIANO', 40, 0, 0, 0, 'ACTIVO', 'CO-ME-MT', 1, 1, 1.5, 6, '2016-08-13 04:37:20', 'CO-ME-MT', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (113, 'CORRECTOR PROFUSSION CONTOUR 8 COLORES', 180, 0, 0, 0, 'ACTIVO', 'CO-PF-01', 1, 51, 1.5, 6, '2016-08-13 04:37:20', 'CO-PF-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (114, 'CORRECTOR PROFUSSION 20 COLORES', 140, 0, 0, 0, 'ACTIVO', 'CO-PF-02', 1, 51, 1.5, 6, '2016-08-13 04:37:20', 'CO-PF-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (115, 'CORRECTOR PROLUX 6 COLORES MEDIANO', 85, 0, 0, 0, 'ACTIVO', 'CO-PR-01', 1, 6, 1.5, 6, '2016-08-13 04:37:20', 'CO-PR-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (116, 'CORTAUNA', 10, 0, 0, 0, 'ACTIVO', 'CORT-01', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'CORT-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (117, 'COSMETIQUERA', 20, 0, 0, 0, 'ACTIVO', 'COS-01', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'COS-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (118, 'COSMETIQUERA', 25, 0, 0, 0, 'ACTIVO', 'COS-02', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'COS-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (119, 'CORRECTOR SANIYE 5 COLORES CHICO', 30, 0, 0, 0, 'ACTIVO', 'CO-SA-C1', 1, 29, 1.5, 6, '2016-08-13 04:37:20', 'CO-SA-C1', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (120, 'CORRECTOR SANIYE 10 COLORES GRANDE', 85, 0, 0, 0, 'ACTIVO', 'CO-SA-G1', 1, 29, 1.5, 6, '2016-08-13 04:37:20', 'CO-SA-G1', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (121, 'CORRECTOR STARRY 10 COLORES GRANDE', 90, 0, 0, 0, 'ACTIVO', 'CO-ST-01', 1, 1, 1.5, 6, '2016-08-13 04:37:20', 'CO-ST-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (122, 'CORRECTOR USHAS 10 COLORES GRANDE', 100, 0, 0, 0, 'ACTIVO', 'CO-US-01', 1, 55, 1.5, 6, '2016-08-13 04:37:20', 'CO-US-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (123, 'CORRECTOR EN TARRO VERONICA 5 COLORES', 50, 0, 0, 0, 'ACTIVO', 'CO-VC-001', 1, 56, 1.5, 6, '2016-08-13 04:37:20', 'CO-VC-001', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (124, 'CORRECTOR EN LAPIZ VERONICA BLANCO', 15, 0, 0, 0, 'ACTIVO', 'CO-VC-01', 1, 56, 1.5, 6, '2016-08-13 04:37:20', 'CO-VC-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (125, 'CORRECTOR EN LAPIZ VERONICA AMARILLO', 15, 0, 0, 0, 'ACTIVO', 'CO-VC-02', 1, 56, 1.5, 6, '2016-08-13 04:37:20', 'CO-VC-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (126, 'CORRECTOR EN LAPIZ VERONICA BEIGE', 15, 0, 0, 0, 'ACTIVO', 'CO-VC-03', 1, 56, 1.5, 6, '2016-08-13 04:37:20', 'CO-VC-03', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (127, 'CORRECTOR EN LAPIZ VERONICA LILA', 15, 0, 0, 0, 'ACTIVO', 'CO-VC-04', 1, 56, 1.5, 6, '2016-08-13 04:37:20', 'CO-VC-04', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (128, 'CORRECTOR EN LAPIZ VERONICA VERDE', 15, 0, 0, 0, 'ACTIVO', 'CO-VC-05', 1, 56, 1.5, 6, '2016-08-13 04:37:20', 'CO-VC-05', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (129, 'CORRECTOR EN LAPIZ VERONICA TAN', 15, 0, 0, 0, 'ACTIVO', 'CO-VC-06', 1, 56, 1.5, 6, '2016-08-13 04:37:20', 'CO-VC-06', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (130, 'CUBRE PIE DAMA', 20, 0, 0, 0, 'ACTIVO', 'CP-01', 1, 1, 1.5, 19, '2016-08-13 04:37:20', 'CP-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (131, 'CREMA DE FRUTAS', 40, 0, 0, 0, 'ACTIVO', 'CR-FR-01', 1, 1, 1.5, 18, '2016-08-13 04:37:20', 'CR-FR-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (132, 'CUPID', 100, 0, 0, 0, 'ACTIVO', 'CUPID', 1, 22, 1.5, 3, '2016-08-13 04:37:20', 'CUPID', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (133, 'DONA TELA GRUESA ', 5, 0, 0, 0, 'ACTIVO', 'D-01', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'D-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (134, 'DONA TELA COLOR PAQUETE', 10, 0, 0, 0, 'ACTIVO', 'DC-01', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'DC-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (135, 'DONA CHICA TELA PAQUETE', 5, 0, 0, 0, 'ACTIVO', 'DCH-04', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'DCH-04', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (136, 'DELINEADOR CON RIMEL', 20, 0, 0, 0, 'ACTIVO', 'DEL-02', 1, 1, 1.5, 6, '2016-08-13 04:37:20', 'DEL-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (137, 'DELINEADOR CAFÉ  BY APPLE', 25, 0, 0, 0, 'ACTIVO', 'DELC-01', 1, 14, 1.5, 6, '2016-08-13 04:37:20', 'DELC-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (138, 'DELINEADOR NEGRO CUBO', 30, 0, 0, 0, 'ACTIVO', 'DEL-CU', 1, 31, 1.5, 6, '2016-08-13 04:37:20', 'DEL-CU', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (139, 'DELINEADOR FRESA', 15, 0, 0, 0, 'ACTIVO', 'DELF-01', 1, 1, 1.5, 6, '2016-08-13 04:37:20', 'DELF-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (140, 'DELINEADOR AZUL BY APPLE', 25, 0, 0, 0, 'ACTIVO', 'DEL-F1-05', 1, 14, 1.5, 6, '2016-08-13 04:37:20', 'DEL-F1-05', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (141, 'DELINEADOR PLATA BY APPLE', 25, 0, 0, 0, 'ACTIVO', 'DEL-F1-06', 1, 14, 1.5, 6, '2016-08-13 04:37:20', 'DEL-F1-06', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (142, 'DELINEADOR BLANCO BY APPLE', 25, 0, 0, 0, 'ACTIVO', 'DEL-F1-07', 1, 14, 1.5, 6, '2016-08-13 04:37:20', 'DEL-F1-07', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (143, 'DELINEADOR NEGRO IM', 25, 0, 0, 0, 'ACTIVO', 'DEL-IM', 1, 1, 1.5, 6, '2016-08-13 04:37:20', 'DEL-IM', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (144, 'DELINEADOR NEGRO MY COLORS', 30, 0, 0, 0, 'ACTIVO', 'DEL-MC', 1, 10, 1.5, 6, '2016-08-13 04:37:20', 'DEL-MC', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (145, 'DELINEADOR NEGRO BY APPLE', 25, 0, 0, 0, 'ACTIVO', 'DELN-02', 1, 14, 1.5, 6, '2016-08-13 04:37:20', 'DELN-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (146, 'DELINEADOR NEGRO ALARGA', 25, 0, 0, 0, 'ACTIVO', 'DEL-N1', 1, 38, 1.5, 6, '2016-08-13 04:37:20', 'DEL-N1', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (147, 'DELINEADOR NEGRO PROLUX', 35, 0, 0, 0, 'ACTIVO', 'DELN-50', 1, 6, 1.5, 6, '2016-08-13 04:37:20', 'DELN-50', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (148, 'DEPILADOR GRANDE', 15, 0, 0, 0, 'ACTIVO', 'DEP-01', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'DEP-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (149, 'DEPILADOR CHICO', 10, 0, 0, 0, 'ACTIVO', 'DEP-02', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'DEP-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (150, 'MASCARILLA DERMAL', 30, 0, 0, 0, 'ACTIVO', 'DERMAL-1', 1, 44, 1.5, 15, '2016-08-13 04:37:20', 'DERMAL-1', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (151, 'DESTAPADOR', 23, 0, 0, 0, 'ACTIVO', 'DEST-045', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'DEST-045', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (152, 'ESMALTE 3D KLEANCOLOR', 25, 0, 0, 0, 'ACTIVO', 'DGA403J', 1, 46, 1.5, 16, '2016-08-13 04:37:20', 'DGA403J', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (153, 'DILUYENTE DE UNAS', 35, 0, 0, 0, 'ACTIVO', 'DIL-01', 1, 1, 1.5, 16, '2016-08-13 04:37:20', 'DIL-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (154, 'DONA MAGICA GRANDE', 15, 0, 0, 0, 'ACTIVO', 'DM-001', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'DM-001', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (155, 'CHOCOLATE', 30, 0, 25, 0, 'ACTIVO', 'E10', 1, 8, 1.5, 3, '2016-08-13 04:37:20', 'E10', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (156, 'ROSA', 30, 0, 25, 0, 'ACTIVO', 'E13', 1, 8, 1.5, 3, '2016-08-13 04:37:20', 'E13', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (157, 'VINO NACARADO', 30, 0, 25, 0, 'ACTIVO', 'E15', 1, 8, 1.5, 3, '2016-08-13 04:37:20', 'E15', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (158, 'LILA', 30, 0, 25, 0, 'ACTIVO', 'E2', 1, 8, 1.5, 3, '2016-08-13 04:37:20', 'E2', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (159, 'CHAMPAGNE', 30, 0, 25, 0, 'ACTIVO', 'E21', 1, 8, 1.5, 3, '2016-08-13 04:37:20', 'E21', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (160, 'MARRRON', 30, 0, 25, 0, 'ACTIVO', 'E22', 1, 8, 1.5, 3, '2016-08-13 04:37:20', 'E22', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (161, 'ULTRA RED', 30, 0, 25, 0, 'ACTIVO', 'E24', 1, 8, 1.5, 3, '2016-08-13 04:37:20', 'E24', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (162, 'SALMON', 30, 0, 25, 0, 'ACTIVO', 'E3', 1, 8, 1.5, 3, '2016-08-13 04:37:20', 'E3', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (163, 'LUXURIOUS', 30, 0, 25, 0, 'ACTIVO', 'E32', 1, 8, 1.5, 3, '2016-08-13 04:37:20', 'E32', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (164, 'SUPER PINK', 30, 0, 25, 0, 'ACTIVO', 'E39', 1, 8, 1.5, 3, '2016-08-13 04:37:20', 'E39', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (165, 'JUST PINK', 30, 0, 25, 0, 'ACTIVO', 'E41', 1, 8, 1.5, 3, '2016-08-13 04:37:20', 'E41', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (166, 'FIUSHA', 30, 0, 25, 0, 'ACTIVO', 'E43', 1, 8, 1.5, 3, '2016-08-13 04:37:20', 'E43', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (167, 'LUCKY', 30, 0, 25, 0, 'ACTIVO', 'E44', 1, 8, 1.5, 3, '2016-08-13 04:37:20', 'E44', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (168, 'MOKA FRIZE', 30, 0, 25, 0, 'ACTIVO', 'E45', 1, 8, 1.5, 3, '2016-08-13 04:37:20', 'E45', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (169, 'WINE', 30, 0, 25, 0, 'ACTIVO', 'E48', 1, 8, 1.5, 3, '2016-08-13 04:37:20', 'E48', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (170, 'ORANGE', 30, 0, 25, 0, 'ACTIVO', 'E5', 1, 8, 1.5, 3, '2016-08-13 04:37:20', 'E5', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (171, 'GALAXY PINK', 30, 0, 25, 0, 'ACTIVO', 'E60', 1, 8, 1.5, 3, '2016-08-13 04:37:20', 'E60', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (172, 'EXOTIC LIPS', 30, 0, 25, 0, 'ACTIVO', 'E61', 1, 8, 1.5, 3, '2016-08-13 04:37:20', 'E61', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (173, 'SILVERT METALIC', 30, 0, 25, 0, 'ACTIVO', 'E66', 1, 8, 1.5, 3, '2016-08-13 04:37:20', 'E66', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (174, 'SECRET KISS', 30, 0, 25, 0, 'ACTIVO', 'E67', 1, 8, 1.5, 3, '2016-08-13 04:37:20', 'E67', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (175, 'ELECTRIC BLUE', 30, 0, 25, 0, 'ACTIVO', 'E910', 1, 8, 1.5, 3, '2016-08-13 04:37:20', 'E910', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (176, 'NUDE', 30, 0, 25, 0, 'ACTIVO', 'E912', 1, 8, 1.5, 3, '2016-08-13 04:37:20', 'E912', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (177, 'SKY BLUE', 30, 0, 25, 0, 'ACTIVO', 'E99', 1, 8, 1.5, 3, '2016-08-13 04:37:20', 'E99', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (178, 'ENCHINADOR PRINCESSA', 30, 0, 0, 0, 'ACTIVO', 'ENC-809', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'ENC-809', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (179, 'ENCHINADOR YOLI', 25, 0, 0, 0, 'ACTIVO', 'ENC-810', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'ENC-810', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (180, 'ESMALTE BISSU STARDUST', 30, 0, 0, 0, 'ACTIVO', 'ESBS-02', 1, 5, 1.5, 16, '2016-08-13 04:37:20', 'ESBS-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (181, 'ESMALTE BISSU TRATAMIENTOS', 30, 0, 0, 0, 'ACTIVO', 'ESBT-01', 1, 5, 1.5, 16, '2016-08-13 04:37:20', 'ESBT-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (182, 'ESMALTE METALICO EFECTO ESPEJO', 20, 0, 0, 0, 'ACTIVO', 'ESES-01', 1, 1, 1.5, 16, '2016-08-13 04:37:20', 'ESES-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (183, 'ESMALTE BISSU GOTAS SEDA', 30, 0, 0, 0, 'ACTIVO', 'ESGS-01', 1, 5, 1.5, 16, '2016-08-13 04:37:20', 'ESGS-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (184, 'ESMALTE DUO DECORACION', 10, 0, 0, 0, 'ACTIVO', 'ESM-13', 1, 1, 1.5, 16, '2016-08-13 04:37:20', 'ESM-13', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (185, 'ESMALTE BISSU METALICO', 30, 0, 0, 0, 'ACTIVO', 'ESMB-03', 1, 5, 1.5, 16, '2016-08-13 04:37:20', 'ESMB-03', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (186, 'ESMALTE CHICO', 10, 0, 0, 0, 'ACTIVO', 'ESM-CH', 1, 1, 1.5, 16, '2016-08-13 04:37:20', 'ESM-CH', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (187, 'ESMALTE DE LIGA', 25, 0, 0, 0, 'ACTIVO', 'ESML-01', 1, 1, 1.5, 16, '2016-08-13 04:37:20', 'ESML-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (188, 'ESMALTE BISSU COLORES', 20, 0, 0, 0, 'ACTIVO', 'ESML-BI', 1, 5, 1.5, 16, '2016-08-13 04:37:20', 'ESML-BI', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (189, 'ESPEJO CHICO CARTERA', 6, 0, 0, 0, 'ACTIVO', 'ESPC-03', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'ESPC-03', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (190, 'ESPONJAS ECONOMICAS', 6, 0, 0, 0, 'ACTIVO', 'ESP-ECO2', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'ESP-ECO2', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (191, 'ESPONJAS ECONOMICAS  DE ESTRELLA', 5, 0, 0, 0, 'ACTIVO', 'ESP-ECO3', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'ESP-ECO3', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (192, 'ESPEJO FLOR', 10, 0, 0, 0, 'ACTIVO', 'ESPF-01', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'ESPF-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (193, 'ESPEJO MUNECA', 10, 0, 0, 0, 'ACTIVO', 'ESPM-02', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'ESPM-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (194, 'ESPONJAS PACHS', 20, 0, 0, 0, 'ACTIVO', 'ESP-PA01', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'ESP-PA01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (195, 'EXTENCION DE CABELLO CHICA', 25, 0, 0, 0, 'ACTIVO', 'EXC-01', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'EXC-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (196, 'EXTENCION DE CABELLO GRANDE', 50, 0, 0, 0, 'ACTIVO', 'EXG-02', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'EXG-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (197, 'EXTENSOR PARA BRASIER', 10, 0, 0, 0, 'ACTIVO', 'EXT-IN', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'EXT-IN', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (198, 'FAJA TIPO CORSE BLANCA', 150, 0, 0, 0, 'ACTIVO', 'FG-001', 1, 1, 1.5, 19, '2016-08-13 04:37:20', 'FG-001', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (199, 'FAJA DEPORTIVA CHICA', 250, 0, 0, 0, 'ACTIVO', 'FG-CH', 1, 1, 1.5, 9, '2016-08-13 04:37:20', 'FG-CH', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (200, 'FAJA DEPORTIVA EXTRA GRANDE', 250, 0, 0, 0, 'ACTIVO', 'FG-EX', 1, 1, 1.5, 9, '2016-08-13 04:37:20', 'FG-EX', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (201, 'FAJA DEPORTIVA GRANDE', 250, 0, 0, 0, 'ACTIVO', 'FG-GD', 1, 1, 1.5, 9, '2016-08-13 04:37:20', 'FG-GD', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (202, 'FAJA DEPORTIVA MEDIANA', 250, 0, 0, 0, 'ACTIVO', 'FG-MD', 1, 1, 1.5, 9, '2016-08-13 04:37:20', 'FG-MD', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (203, 'FIJADOR DE SOMBRA KEJEL', 30, 0, 0, 0, 'ACTIVO', 'FS-002', 1, 8, 1.5, 6, '2016-08-13 04:37:20', 'FS-002', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (204, 'ESMALTE EFECTO GEL', 40, 0, 0, 0, 'ACTIVO', 'GELISH', 1, 7, 1.5, 16, '2016-08-13 04:37:20', 'GELISH', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (205, 'GUANTES DE GATO', 150, 0, 0, 0, 'ACTIVO', 'GUT-12', 1, 1, 1.5, 12, '2016-08-13 04:37:20', 'GUT-12', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (206, 'HENNA DE CEJA COLOR 1', 35, 0, 0, 0, 'ACTIVO', 'HE-01', 1, 1, 1.5, 6, '2016-08-13 04:37:20', 'HE-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (207, 'HENNA DE CEJA COLOR 2', 35, 0, 0, 0, 'ACTIVO', 'HE-02', 1, 1, 1.5, 6, '2016-08-13 04:37:20', 'HE-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (208, 'HENNA JABIBE CAFÉ CLARO', 35, 0, 0, 0, 'ACTIVO', 'HECC-01', 1, 20, 1.5, 6, '2016-08-13 04:37:20', 'HECC-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (209, 'HENNA JABIBE CAFÉ OBSCURO', 35, 0, 0, 0, 'ACTIVO', 'HECO-02', 1, 20, 1.5, 6, '2016-08-13 04:37:20', 'HECO-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (210, 'HENNA JABIBE NEGRO', 35, 0, 0, 0, 'ACTIVO', 'HEN-03', 1, 20, 1.5, 6, '2016-08-13 04:37:20', 'HEN-03', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (211, 'MAQUILLAJE EN POLVO COMPACTO ITALIA', 35, 0, 0, 0, 'ACTIVO', 'IT-MP-01', 1, 49, 1.5, 6, '2016-08-13 04:37:20', 'IT-MP-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (212, 'BRANDY', 35, 0, 30, 0, 'ACTIVO', 'JEIBRA', 1, 19, 1.5, 3, '2016-08-13 04:37:20', 'JEIBRA', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (213, 'VINO', 35, 0, 30, 0, 'ACTIVO', 'JEIVIN', 1, 19, 1.5, 3, '2016-08-13 04:37:20', 'JEIVIN', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (214, 'KISS FOR KEEPS', 30, 0, 0, 0, 'ACTIVO', 'KISS', 1, 26, 1.5, 3, '2016-08-13 04:37:20', 'KISS', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (215, 'KIT DE MAQUILLAJE P Y W', 120, 0, 0, 0, 'ACTIVO', 'KIT-01', 1, 1, 1.5, 6, '2016-08-13 04:37:20', 'KIT-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (216, 'ESMALTE KIM TAYLOR', 35, 0, 0, 0, 'ACTIVO', 'KT-95', 1, 1, 1.5, 16, '2016-08-13 04:37:20', 'KT-95', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (217, 'CARINA', 140, 0, 0, 0, 'ACTIVO', 'KY-CARINA', 1, 35, 1.5, 3, '2016-08-13 04:37:20', 'KY-CARINA', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (218, 'DAINTY', 140, 0, 0, 0, 'ACTIVO', 'KY-DAINTY', 1, 35, 1.5, 3, '2016-08-13 04:37:20', 'KY-DAINTY', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (219, 'KING K', 140, 0, 0, 0, 'ACTIVO', 'KY-KINGK', 1, 35, 1.5, 3, '2016-08-13 04:37:20', 'KY-KINGK', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (220, 'KOKO K', 140, 0, 0, 0, 'ACTIVO', 'KY-KOKOK', 1, 35, 1.5, 3, '2016-08-13 04:37:20', 'KY-KOKOK', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (221, 'LIKE', 140, 0, 0, 0, 'ACTIVO', 'KY-LIKE', 1, 35, 1.5, 3, '2016-08-13 04:37:20', 'KY-LIKE', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (222, 'MARY JOK', 140, 0, 0, 0, 'ACTIVO', 'KY-MARY JOK', 1, 35, 1.5, 3, '2016-08-13 04:37:20', 'KY-MARY JOK', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (223, 'PEING', 140, 0, 0, 0, 'ACTIVO', 'KY-PEING', 1, 35, 1.5, 3, '2016-08-13 04:37:20', 'KY-PEING', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (224, 'RIOT', 140, 0, 0, 0, 'ACTIVO', 'KY-RIOT', 1, 35, 1.5, 3, '2016-08-13 04:37:20', 'KY-RIOT', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (225, 'SOCUTE', 140, 0, 0, 0, 'ACTIVO', 'KY-SOCUTE', 1, 35, 1.5, 3, '2016-08-13 04:37:20', 'KY-SOCUTE', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (226, 'GLAZED', 45, 0, 0, 0, 'ACTIVO', 'L.A', 1, 25, 1.5, 3, '2016-08-13 04:37:20', 'L.A', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (227, 'ROSA 1', 25, 0, 20, 0, 'ACTIVO', 'LAB-MC1', 1, 10, 1.5, 3, '2016-08-13 04:37:20', 'LAB-MC1', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (228, 'NARANJA 3', 25, 0, 20, 0, 'ACTIVO', 'LAB-MC3', 1, 10, 1.5, 3, '2016-08-13 04:37:20', 'LAB-MC3', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (229, 'MAMEY 4', 25, 0, 20, 0, 'ACTIVO', 'LAB-MC4', 1, 10, 1.5, 3, '2016-08-13 04:37:20', 'LAB-MC4', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (230, 'ROSA DUAL', 35, 0, 30, 0, 'ACTIVO', 'LAB-ST187', 1, 12, 1.5, 3, '2016-08-13 04:37:20', 'LAB-ST187', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (231, 'LAPIZ DELINEADOR CHICO BY APPLE', 10, 0, 0, 0, 'ACTIVO', 'LAP-AC01', 1, 14, 1.5, 6, '2016-08-13 04:37:20', 'LAP-AC01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (232, 'LAPIZ DELINEADOR GRANDE BY APPLE', 15, 0, 0, 0, 'ACTIVO', 'LAP-AC02', 1, 14, 1.5, 6, '2016-08-13 04:37:20', 'LAP-AC02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (233, 'LAPIZ DELINEADOR LABIOS AVON', 30, 0, 0, 0, 'ACTIVO', 'LAP-AV-01', 1, 39, 1.5, 6, '2016-08-13 04:37:20', 'LAP-AV-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (234, 'LAPIZ DELINEADOR BISSU', 37, 0, 0, 0, 'ACTIVO', 'LAP-BIS', 1, 5, 1.5, 6, '2016-08-13 04:37:20', 'LAP-BIS', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (235, 'LAPIZ DELINEADOR COLORES HUSHAS', 20, 0, 0, 0, 'ACTIVO', 'LAP-HU', 1, 1, 1.5, 6, '2016-08-13 04:37:20', 'LAP-HU', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (236, 'LAPIZ DELINEADOR COLORES KEJEL', 37, 0, 0, 0, 'ACTIVO', 'LAP-KEJ', 1, 8, 1.5, 6, '2016-08-13 04:37:20', 'LAP-KEJ', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (237, 'LAPIZ DELINEADOR L.A. GIRL', 20, 0, 0, 0, 'ACTIVO', 'LAPLA01', 1, 25, 1.5, 6, '2016-08-13 04:37:20', 'LAPLA01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (238, 'CINTURILLA CHICA', 220, 0, 0, 0, 'ACTIVO', 'LB-CH', 1, 47, 1.5, 9, '2016-08-13 04:37:20', 'LB-CH', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (239, 'CINTURILLA GRANDE', 220, 0, 0, 0, 'ACTIVO', 'LB-G', 1, 47, 1.5, 9, '2016-08-13 04:37:20', 'LB-G', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (240, 'LEBANTA GLUTEO CHICO', 150, 0, 0, 0, 'ACTIVO', 'LB-LGC', 1, 47, 1.5, 19, '2016-08-13 04:37:20', 'LB-LGC', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (241, 'LEBANTA GLUTEO GRANDE', 150, 0, 0, 0, 'ACTIVO', 'LB-LGG', 1, 47, 1.5, 19, '2016-08-13 04:37:20', 'LB-LGG', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (242, 'LEBANTA GLUTEO MEDIANO', 150, 0, 0, 0, 'ACTIVO', 'LB-LGM', 1, 47, 1.5, 19, '2016-08-13 04:37:20', 'LB-LGM', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (243, 'CINTURILLA MEDIANA', 220, 0, 0, 0, 'ACTIVO', 'LB-MD', 1, 47, 1.5, 9, '2016-08-13 04:37:20', 'LB-MD', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (244, 'LIMA ECONOMICA PAQUETE', 5, 0, 0, 0, 'ACTIVO', 'LIM-01', 1, 1, 1.5, 16, '2016-08-13 04:37:20', 'LIM-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (245, 'LIMA DE FLORES', 8, 0, 0, 0, 'ACTIVO', 'LIM-02', 1, 1, 1.5, 16, '2016-08-13 04:37:20', 'LIM-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (246, 'LIMA BISSU', 18, 0, 0, 0, 'ACTIVO', 'LIM-03', 1, 5, 1.5, 16, '2016-08-13 04:37:20', 'LIM-03', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (247, 'LIMA MEDIANA', 20, 0, 0, 0, 'ACTIVO', 'LIM-04', 1, 1, 1.5, 16, '2016-08-13 04:37:20', 'LIM-04', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (248, 'LIMA ESPONJA', 28, 0, 0, 0, 'ACTIVO', 'LIM-05', 1, 1, 1.5, 16, '2016-08-13 04:37:20', 'LIM-05', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (249, 'LIMA ECONOMICA 2 PZA', 1, 0, 0, 0, 'ACTIVO', 'LIM-06', 1, 1, 1.5, 16, '2016-08-13 04:37:20', 'LIM-06', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (250, 'LIP BAL', 20, 0, 0, 0, 'ACTIVO', 'LIP-5', 1, 5, 1.5, 3, '2016-08-13 04:37:20', 'LIP-5', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (251, 'BISSU BARRA', 17, 0, 0, 0, 'ACTIVO', 'LIP-BAL', 1, 27, 1.5, 3, '2016-08-13 04:37:20', 'LIP-BAL', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (252, 'LIP CAT', 20, 0, 0, 0, 'ACTIVO', 'LIP-CAT', 1, 10, 1.5, 3, '2016-08-13 04:37:20', 'LIP-CAT', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (253, 'LIP COCA COLA', 30, 0, 0, 0, 'ACTIVO', 'LIP-CO', 1, 23, 1.5, 3, '2016-08-13 04:37:20', 'LIP-CO', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (254, 'LIP CRAYON', 25, 0, 0, 0, 'ACTIVO', 'LIP-CRAYON', 1, 33, 1.5, 3, '2016-08-13 04:37:20', 'LIP-CRAYON', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (255, 'LIP HANLFEI', 10, 0, 0, 0, 'ACTIVO', 'LIP-HAN', 1, 31, 1.5, 3, '2016-08-13 04:37:20', 'LIP-HAN', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (256, 'LIP HEBBLE', 25, 0, 0, 0, 'ACTIVO', 'LIP-HEB', 1, 33, 1.5, 3, '2016-08-13 04:37:20', 'LIP-HEB', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (257, 'JORDANA BARRA', 20, 0, 0, 0, 'ACTIVO', 'LIP-JOR', 1, 28, 1.5, 3, '2016-08-13 04:37:20', 'LIP-JOR', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (258, 'LAPIZ MAGICO', 10, 0, 0, 0, 'ACTIVO', 'LIP-LAPIZ', 1, 29, 1.5, 3, '2016-08-13 04:37:20', 'LIP-LAPIZ', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (259, 'LIP MATTE', 25, 0, 0, 0, 'ACTIVO', 'LIP-MATTE', 1, 1, 1.5, 3, '2016-08-13 04:37:20', 'LIP-MATTE', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (260, 'LIP MC BB', 25, 0, 0, 0, 'ACTIVO', 'LIP-MC001', 1, 10, 1.5, 3, '2016-08-13 04:37:20', 'LIP-MC001', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (261, 'MAGICO NARANJA', 10, 0, 0, 0, 'ACTIVO', 'LIP-MORG', 1, 30, 1.5, 3, '2016-08-13 04:37:20', 'LIP-MORG', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (263, 'CAPPUCCINO', 25, 0, 0, 0, 'ACTIVO', 'LIP-NA', 1, 1, 1.5, 3, '2016-08-13 04:39:55', 'LIP-NA', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (264, 'LIP SHALALA', 20, 0, 0, 0, 'ACTIVO', 'LIP-SHAL', 1, 14, 1.5, 3, '2016-08-13 04:39:55', 'LIP-SHAL', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (265, 'LIP SKITTLES', 30, 0, 0, 0, 'ACTIVO', 'LIP-SKI', 1, 23, 1.5, 3, '2016-08-13 04:39:55', 'LIP-SKI', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (266, 'LIP SMACKER', 30, 0, 0, 0, 'ACTIVO', 'LIP-SMAR', 1, 23, 1.5, 3, '2016-08-13 04:39:55', 'LIP-SMAR', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (267, 'LIP SPRITE', 35, 0, 0, 0, 'ACTIVO', 'LIP-SPRITE', 1, 23, 1.5, 3, '2016-08-13 04:39:55', 'LIP-SPRITE', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (268, 'LIP STARBURST', 30, 0, 0, 0, 'ACTIVO', 'LIP-STAR', 1, 23, 1.5, 3, '2016-08-13 04:39:55', 'LIP-STAR', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (269, 'LLAVERO STAR WAR', 25, 0, 0, 0, 'ACTIVO', 'LLA-01', 1, 1, 1.5, 12, '2016-08-13 04:39:55', 'LLA-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (270, 'LIGAS DE PLASTICO CHICAS', 5, 0, 0, 0, 'ACTIVO', 'LP-CH', 1, 1, 1.5, 12, '2016-08-13 04:39:55', 'LP-CH', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (271, 'LIGAS DE PLASTICO GRANDES', 10, 0, 0, 0, 'ACTIVO', 'LP-GD', 1, 1, 1.5, 12, '2016-08-13 04:39:55', 'LP-GD', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (272, 'LUSTY RED', 45, 0, 40, 0, 'ACTIVO', 'LW11', 1, 20, 1.5, 3, '2016-08-13 04:39:55', 'LW11', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (273, 'SMOKED RED', 45, 0, 40, 0, 'ACTIVO', 'LW13', 1, 20, 1.5, 3, '2016-08-13 04:39:55', 'LW13', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (274, 'MOKA FREEZE', 45, 0, 40, 0, 'ACTIVO', 'LW16', 1, 20, 1.5, 3, '2016-08-13 04:39:55', 'LW16', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (275, 'LIGHT BROWN', 45, 0, 40, 0, 'ACTIVO', 'LW17', 1, 20, 1.5, 3, '2016-08-13 04:39:55', 'LW17', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (276, 'DARK', 45, 0, 40, 0, 'ACTIVO', 'LW18', 1, 20, 1.5, 3, '2016-08-13 04:39:55', 'LW18', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (277, 'PINK ', 45, 0, 40, 0, 'ACTIVO', 'LW3', 1, 20, 1.5, 3, '2016-08-13 04:39:55', 'LW3', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (278, 'CHERRY', 45, 0, 40, 0, 'ACTIVO', 'LW6', 1, 20, 1.5, 3, '2016-08-13 04:39:55', 'LW6', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (279, 'PURPLE', 45, 0, 40, 0, 'ACTIVO', 'LW7', 1, 20, 1.5, 3, '2016-08-13 04:39:55', 'LW7', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (280, 'ULTRA RED', 45, 0, 40, 0, 'ACTIVO', 'LW8', 1, 20, 1.5, 3, '2016-08-13 04:39:55', 'LW8', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (281, 'WINE', 45, 0, 40, 0, 'ACTIVO', 'LW9', 1, 20, 1.5, 3, '2016-08-13 04:39:55', 'LW9', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (282, 'PINK', 35, 0, 30, 0, 'ACTIVO', 'LX25', 1, 21, 1.5, 3, '2016-08-13 04:39:55', 'LX25', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (283, 'CORAL', 35, 0, 30, 0, 'ACTIVO', 'LX29', 1, 21, 1.5, 3, '2016-08-13 04:39:55', 'LX29', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (284, 'FIUSHA', 35, 0, 30, 0, 'ACTIVO', 'LX36', 1, 21, 1.5, 3, '2016-08-13 04:39:55', 'LX36', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (285, 'BOMBSHELL', 35, 22.5, 30, 0, 'ACTIVO', 'M01', 1, 6, 1.5, 3, '2016-08-13 04:39:55', 'M01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (286, 'PARTY PINK', 35, 22.5, 30, 0, 'ACTIVO', 'M02', 1, 6, 1.5, 3, '2016-08-13 04:39:55', 'M02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (287, 'PINK POP', 35, 22.5, 30, 0, 'ACTIVO', 'M03', 1, 6, 1.5, 3, '2016-08-13 04:39:55', 'M03', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (288, 'CARNATION PINK', 35, 22.5, 30, 0, 'ACTIVO', 'M04', 1, 6, 1.5, 3, '2016-08-13 04:39:55', 'M04', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (289, 'UPTOWN PINK', 35, 22.5, 30, 0, 'ACTIVO', 'M05', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M05', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (290, 'BABY DOLL', 35, 22.5, 30, 0, 'ACTIVO', 'M06', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M06', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (291, 'JUICY PAPAYA', 35, 22.5, 30, 0, 'ACTIVO', 'M07', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M07', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (292, 'WINE', 35, 22.5, 30, 0, 'ACTIVO', 'M10', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M10', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (293, 'SANGRIA', 35, 22.5, 30, 0, 'ACTIVO', 'M11', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M11', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (294, 'SCARLET', 35, 22.5, 30, 0, 'ACTIVO', 'M12', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M12', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (295, 'RUSSION RED', 35, 22.5, 30, 0, 'ACTIVO', 'M13', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M13', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (296, 'FERRARL RED', 35, 22.5, 30, 0, 'ACTIVO', 'M14', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M14', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (297, 'ROCK RED', 35, 22.5, 30, 0, 'ACTIVO', 'M15', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M15', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (298, 'ROYALTY', 35, 22.5, 30, 0, 'ACTIVO', 'M16', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M16', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (299, 'ULTRA VIOLET', 35, 22.5, 30, 0, 'ACTIVO', 'M17', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M17', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (300, 'MAGENTA', 35, 22.5, 30, 0, 'ACTIVO', 'M18', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M18', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (301, 'FUCHSIA FUSION', 35, 22.5, 30, 0, 'ACTIVO', 'M19', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M19', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (302, 'DOLCI', 35, 22.5, 30, 0, 'ACTIVO', 'M20', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M20', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (303, 'CHARMING', 35, 22.5, 30, 0, 'ACTIVO', 'M22', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M22', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (304, 'NUDE', 35, 22.5, 30, 0, 'ACTIVO', 'M24', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M24', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (305, 'FIRECRACKER', 35, 22.5, 30, 0, 'ACTIVO', 'M25', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M25', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (306, 'RED OVER HEELS', 35, 22.5, 30, 0, 'ACTIVO', 'M26', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M26', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (307, 'DAREDEVIL', 35, 22.5, 30, 0, 'ACTIVO', 'M27', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M27', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (308, 'NAKED', 35, 22.5, 30, 0, 'ACTIVO', 'M28', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M28', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (309, 'SORBET', 35, 22.5, 30, 0, 'ACTIVO', 'M29', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M29', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (310, 'JEWEL', 35, 22.5, 30, 0, 'ACTIVO', 'M30', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M30', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (311, 'TEDDY', 35, 22.5, 30, 0, 'ACTIVO', 'M31', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M31', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (312, 'MOCHA MADNESS', 35, 22.5, 30, 0, 'ACTIVO', 'M32', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M32', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (313, 'EXPRESSO', 35, 22.5, 30, 0, 'ACTIVO', 'M34', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M34', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (314, 'BE WITCH', 35, 22.5, 30, 0, 'ACTIVO', 'M40', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M40', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (315, 'WICKED', 35, 22.5, 30, 0, 'ACTIVO', 'M41', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M41', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (316, 'STONE', 35, 22.5, 30, 0, 'ACTIVO', 'M42', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M42', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (317, 'TOXIC', 35, 22.5, 30, 0, 'ACTIVO', 'M44', 1, 6, 1.5, 3, '2016-08-13 04:39:56', 'M44', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (318, 'MASCARILLA TONY MOLY', 35, 0, 0, 0, 'ACTIVO', 'MASC-TM', 1, 54, 1.5, 15, '2016-08-13 04:39:56', 'MASC-TM', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (319, 'MATIZADOR DE UNAS', 25, 0, 0, 0, 'ACTIVO', 'MAT-01', 1, 5, 1.5, 16, '2016-08-13 04:39:56', 'MAT-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (320, 'CUTE PINK', 40, 0, 35, 0, 'ACTIVO', 'MG06', 1, 9, 1.5, 3, '2016-08-13 04:39:56', 'MG06', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (321, 'CLASSIC PINK', 40, 0, 35, 0, 'ACTIVO', 'MG07', 1, 9, 1.5, 3, '2016-08-13 04:39:56', 'MG07', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (322, 'PURE PINK', 40, 0, 35, 0, 'ACTIVO', 'MG09', 1, 9, 1.5, 3, '2016-08-13 04:39:56', 'MG09', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (323, 'BABY PINK', 40, 0, 35, 0, 'ACTIVO', 'MG37', 1, 9, 1.5, 3, '2016-08-13 04:39:56', 'MG37', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (324, 'PUPPLE', 35, 0, 30, 0, 'ACTIVO', 'MLG02', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (325, 'BABY PINK', 35, 0, 30, 0, 'ACTIVO', 'MLG10', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG10', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (326, 'ANGEL RED', 40, 0, 35, 0, 'ACTIVO', 'MLG1-01', 1, 9, 1.5, 3, '2016-08-13 04:39:56', 'MLG1-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (327, 'RUBY', 40, 0, 35, 0, 'ACTIVO', 'MLG1-09', 1, 9, 1.5, 3, '2016-08-13 04:39:56', 'MLG1-09', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (328, 'REAL PINK', 40, 0, 35, 0, 'ACTIVO', 'MLG1-25', 1, 9, 1.5, 3, '2016-08-13 04:39:56', 'MLG1-25', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (329, 'PINKLE', 40, 0, 35, 0, 'ACTIVO', 'MLG1-29', 1, 9, 1.5, 3, '2016-08-13 04:39:56', 'MLG1-29', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (330, 'ANGEL RED', 35, 0, 30, 0, 'ACTIVO', 'MLG13', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG13', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (331, 'ROSE', 40, 0, 35, 0, 'ACTIVO', 'MLG1-30', 1, 9, 1.5, 3, '2016-08-13 04:39:56', 'MLG1-30', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (332, 'MOCHA', 40, 0, 35, 0, 'ACTIVO', 'MLG1-38', 1, 9, 1.5, 3, '2016-08-13 04:39:56', 'MLG1-38', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (333, 'RED', 40, 0, 35, 0, 'ACTIVO', 'MLG1-39', 1, 9, 1.5, 3, '2016-08-13 04:39:56', 'MLG1-39', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (334, 'DARK PLUM', 35, 0, 30, 0, 'ACTIVO', 'MLG14', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG14', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (335, 'REAL RED', 35, 0, 30, 0, 'ACTIVO', 'MLG15', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG15', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (336, 'CUTE RED', 35, 0, 30, 0, 'ACTIVO', 'MLG16', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG16', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (337, 'RED', 35, 0, 30, 0, 'ACTIVO', 'MLG17', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG17', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (338, 'PLUSH RED', 35, 0, 30, 0, 'ACTIVO', 'MLG18', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG18', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (339, 'ORANGE RED', 35, 0, 30, 0, 'ACTIVO', 'MLG19', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG19', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (340, 'BRIGHT RED', 35, 0, 30, 0, 'ACTIVO', 'MLG20', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG20', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (341, 'ORANGE', 35, 0, 30, 0, 'ACTIVO', 'MLG21', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG21', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (342, 'PETITE ORANGE', 35, 0, 30, 0, 'ACTIVO', 'MLG22', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG22', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (343, 'CUTE ORANGE', 35, 0, 30, 0, 'ACTIVO', 'MLG23', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG23', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (344, 'PINK RED', 35, 0, 30, 0, 'ACTIVO', 'MLG24', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG24', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (345, 'BABY ORANGE', 35, 0, 30, 0, 'ACTIVO', 'MLG25', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG25', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (346, 'HOT ROSE', 35, 0, 30, 0, 'ACTIVO', 'MLG30', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG30', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (347, 'RUBY', 35, 0, 30, 0, 'ACTIVO', 'MLG33', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG33', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (348, 'PINKLE', 35, 0, 30, 0, 'ACTIVO', 'MLG34', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG34', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (349, 'CHAMPAGNE', 35, 0, 30, 0, 'ACTIVO', 'MLG38', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG38', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (350, 'MOCHA', 35, 0, 30, 0, 'ACTIVO', 'MLG39', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG39', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (351, 'HONEY', 35, 0, 30, 0, 'ACTIVO', 'MLG40', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG40', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (352, 'PASTEL ORANGE', 35, 0, 30, 0, 'ACTIVO', 'MLG41', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG41', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (353, 'RED RED', 35, 0, 30, 0, 'ACTIVO', 'MLG42', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG42', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (354, 'BLACKBERRY', 35, 0, 30, 0, 'ACTIVO', 'MLG45', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG45', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (355, 'LILAC', 35, 0, 30, 0, 'ACTIVO', 'MLG48', 1, 7, 1.5, 3, '2016-08-13 04:39:56', 'MLG48', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (356, 'MAQUILLAJE LIQUIDO JORDANA', 60, 0, 0, 0, 'ACTIVO', 'ML-JO-01', 1, 28, 1.5, 6, '2016-08-13 04:39:56', 'ML-JO-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (357, 'MAQUILLAJE LIQUIDO KLEANCOLOR', 45, 0, 0, 0, 'ACTIVO', 'ML-KC-01', 1, 46, 1.5, 6, '2016-08-13 04:39:56', 'ML-KC-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (358, 'MAQUILLAJE LIQUIDO PROFUSSION', 30, 0, 0, 0, 'ACTIVO', 'ML-PF-01', 1, 51, 1.5, 6, '2016-08-13 04:39:56', 'ML-PF-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (359, 'MAQUILLAJE LIQUIDO PROLUX', 30, 0, 0, 0, 'ACTIVO', 'ML-PX-01', 1, 6, 1.5, 6, '2016-08-13 04:39:56', 'ML-PX-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (360, 'MAQUILLAJE LIQUIDO WONDER FINISH', 20, 0, 0, 0, 'ACTIVO', 'ML-WF-F', 1, 1, 1.5, 6, '2016-08-13 04:39:56', 'ML-WF-F', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (361, 'MALETA TIPO NIKE', 150, 0, 0, 0, 'ACTIVO', 'MN-O1', 1, 1, 1.5, 10, '2016-08-13 04:39:56', 'MN-O1', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (362, 'MONEDERO EMOJI', 40, 0, 0, 0, 'ACTIVO', 'MON-EM02', 1, 1, 1.5, 12, '2016-08-13 04:39:56', 'MON-EM02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (363, 'MONEDERO POOP', 35, 0, 0, 0, 'ACTIVO', 'MON-PO-03', 1, 1, 1.5, 12, '2016-08-13 04:39:56', 'MON-PO-03', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (364, 'MALETA TIPO PUMA', 150, 0, 0, 0, 'ACTIVO', 'MP-02', 1, 1, 1.5, 10, '2016-08-13 04:39:56', 'MP-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (365, 'ESMALTE SANIYE', 20, 0, 0, 0, 'ACTIVO', 'N8230', 1, 29, 1.5, 16, '2016-08-13 04:39:56', 'N8230', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (366, 'NUDO TIPO BOLITA', 10, 0, 0, 0, 'ACTIVO', 'ND-03', 1, 1, 1.5, 12, '2016-08-13 04:39:56', 'ND-03', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (367, 'TOALLA REMOVEDOR ESMALTE', 20, 0, 0, 0, 'ACTIVO', 'NR01', 1, 7, 1.5, 16, '2016-08-13 04:39:56', 'NR01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (368, 'POLVO DE ARROZ DARK BEIGE', 35, 0, 0, 0, 'ACTIVO', 'PA-DB-04', 1, 52, 1.5, 6, '2016-08-13 04:39:56', 'PA-DB-04', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (369, 'POLVO DE ARROZ MEDUIM BEIGE ', 35, 0, 0, 0, 'ACTIVO', 'PA-MB-02', 1, 52, 1.5, 6, '2016-08-13 04:39:56', 'PA-MB-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (370, 'POLVO DE ARROZ NATURAL', 35, 0, 0, 0, 'ACTIVO', 'PA-N-01', 1, 52, 1.5, 6, '2016-08-13 04:39:56', 'PA-N-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (371, 'POLVO DE ARROZ NATURAL BEIGE', 35, 0, 0, 0, 'ACTIVO', 'PA-NB-03', 1, 52, 1.5, 6, '2016-08-13 04:39:56', 'PA-NB-03', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (372, 'PANDA MASCARILLA', 70, 0, 0, 0, 'ACTIVO', 'PANDA-M', 1, 44, 1.5, 15, '2016-08-13 04:39:56', 'PANDA-M', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (373, 'PANDA SOBRE', 16, 0, 0, 0, 'ACTIVO', 'PANDA-S', 1, 54, 1.5, 15, '2016-08-13 04:39:56', 'PANDA-S', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (374, 'PANDA TARRO', 360, 0, 0, 0, 'ACTIVO', 'PANDA-T', 1, 54, 1.5, 15, '2016-08-13 04:39:56', 'PANDA-T', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (375, 'POLVO DE ARROZ TOPICAL BEIGE', 35, 0, 0, 0, 'ACTIVO', 'PA-TB-05', 1, 52, 1.5, 6, '2016-08-13 04:39:56', 'PA-TB-05', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (376, 'POLVO DE ARROZ TRANSLUCIDO', 35, 0, 0, 0, 'ACTIVO', 'PA-TR-06', 1, 52, 1.5, 6, '2016-08-13 04:39:56', 'PA-TR-06', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (377, 'PERLAS BRONCEADORAS NATURE', 50, 0, 0, 0, 'ACTIVO', 'PB-N-01', 1, 18, 1.5, 6, '2016-08-13 04:39:56', 'PB-N-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (378, 'PEACOCK', 100, 0, 0, 0, 'ACTIVO', 'PEACOCCK', 1, 22, 1.5, 3, '2016-08-13 04:39:56', 'PEACOCCK', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (379, 'PEGAMENTO PARA PESTANAS', 10, 0, 0, 0, 'ACTIVO', 'PEG-151', 1, 1, 1.5, 12, '2016-08-13 04:39:56', 'PEG-151', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (380, 'PEINETA DE CABELLO', 20, 0, 0, 0, 'ACTIVO', 'PEI-02', 1, 1, 1.5, 12, '2016-08-13 04:39:56', 'PEI-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (381, 'COLAGENO LABIOS', 20, 0, 0, 0, 'ACTIVO', 'PILATEN-CL', 1, 1, 1.5, 15, '2016-08-13 04:39:56', 'PILATEN-CL', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (382, 'COLAGENO OJOS', 20, 0, 0, 0, 'ACTIVO', 'PILATEN-CO', 1, 1, 1.5, 15, '2016-08-13 04:39:56', 'PILATEN-CO', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (383, 'PILATEN MASCARILLA', 15, 0, 0, 0, 'ACTIVO', 'PILATEN-M', 1, 1, 1.5, 15, '2016-08-13 04:39:56', 'PILATEN-M', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (384, 'PILATEN TARRO', 130, 0, 0, 0, 'ACTIVO', 'PILATEN-T', 1, 1, 1.5, 15, '2016-08-13 04:39:56', 'PILATEN-T', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (385, 'PINZA DE CABELLO CHICA', 10, 0, 0, 0, 'ACTIVO', 'PIN-01', 1, 1, 1.5, 12, '2016-08-13 04:39:56', 'PIN-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (386, 'PINCEL DELINEADOR KEJEL COLORES', 35, 0, 0, 0, 'ACTIVO', 'PIN-KEJ', 1, 8, 1.5, 6, '2016-08-13 04:39:56', 'PIN-KEJ', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (387, 'LLAVERO PIXEL CHICO', 10, 0, 0, 0, 'ACTIVO', 'PIX-CH', 1, 1, 1.5, 12, '2016-08-13 04:39:56', 'PIX-CH', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (388, 'LLAVERO PIXEL GRANDE', 25, 0, 0, 0, 'ACTIVO', 'PIX-G1', 1, 1, 1.5, 12, '2016-08-13 04:39:56', 'PIX-G1', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (389, 'LLAVERO PIXEL GRANDE', 30, 0, 0, 0, 'ACTIVO', 'PIX-G2', 1, 1, 1.5, 12, '2016-08-13 04:39:56', 'PIX-G2', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (390, 'LLAVERO PIXEL GRANDE', 35, 0, 0, 0, 'ACTIVO', 'PIX-G3', 1, 1, 1.5, 12, '2016-08-13 04:39:56', 'PIX-G3', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (391, 'LLAVERO PIXEL MEDIANO', 15, 0, 0, 0, 'ACTIVO', 'PIX-MD', 1, 1, 1.5, 12, '2016-08-13 04:39:56', 'PIX-MD', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (392, 'PLANTILLA DE CEJA', 5, 0, 0, 0, 'ACTIVO', 'PLA-01', 1, 1, 1.5, 12, '2016-08-13 04:39:56', 'PLA-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (393, 'PLANTILLA DE CEJA CON APLICADOR', 10, 0, 0, 0, 'ACTIVO', 'PLA-02', 1, 1, 1.5, 12, '2016-08-13 04:39:56', 'PLA-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (394, 'POLVO LUMINOSO ORGANIX GOLD', 35, 0, 0, 0, 'ACTIVO', 'PL-OX-01', 1, 19, 1.5, 6, '2016-08-13 04:39:56', 'PL-OX-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (395, 'PRIMER MORADO SHE', 45, 0, 0, 0, 'ACTIVO', 'PR-M-01', 1, 7, 1.5, 6, '2016-08-13 04:39:56', 'PR-M-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (396, 'PRIMER TNGO', 95, 0, 0, 0, 'ACTIVO', 'PR-TN-01', 1, 53, 1.5, 6, '2016-08-13 04:39:56', 'PR-TN-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (397, 'PASADOR PARA CABELLO PAQUETE', 20, 0, 0, 0, 'ACTIVO', 'PST-01', 1, 1, 1.5, 12, '2016-08-13 04:39:56', 'PST-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (398, 'POLVO COMPACTO TRANSLUCIDO CITY COLOR', 60, 0, 0, 0, 'ACTIVO', 'PT-HD-01', 1, 43, 1.5, 6, '2016-08-13 04:39:56', 'PT-HD-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (399, 'PULCERA CERPIENTE', 70, 0, 0, 0, 'ACTIVO', 'PUL-02', 1, 1, 1.5, 11, '2016-08-13 04:39:56', 'PUL-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (400, 'PANTIMEDIA DE RED DECORADA', 70, 0, 0, 0, 'ACTIVO', 'R091', 1, 1, 1.5, 19, '2016-08-13 04:39:56', 'R091', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (401, 'REPUESTO DE RIZADOR', 5, 0, 0, 0, 'ACTIVO', 'R-102', 1, 1, 1.5, 12, '2016-08-13 04:39:56', 'R-102', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (402, 'RUBOR FEBBLE 4 COLORES CHICO', 30, 0, 0, 0, 'ACTIVO', 'RB-FB-01', 1, 1, 1.5, 6, '2016-08-13 04:39:56', 'RB-FB-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (403, 'RUBOR ITALIA CHICO', 20, 0, 0, 0, 'ACTIVO', 'RB-IT-01', 1, 49, 1.5, 6, '2016-08-13 04:39:56', 'RB-IT-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (404, 'RUBOR MY COLORS 6 COLORES GRANDE', 50, 0, 0, 0, 'ACTIVO', 'RB-MC-01', 1, 10, 1.5, 6, '2016-08-13 04:39:56', 'RB-MC-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (405, 'RUBOR PROFUSSION 10 COLORES GRANDE', 45, 0, 0, 0, 'ACTIVO', 'RB-PF-0G', 1, 51, 1.5, 6, '2016-08-13 04:39:56', 'RB-PF-0G', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (406, 'RUBOR SANIYE 3 COLORES CHICO', 23, 0, 0, 0, 'ACTIVO', 'RB-SN-01', 1, 29, 1.5, 6, '2016-08-13 04:39:56', 'RB-SN-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (407, 'RUBOR USHAS CHICO', 25, 0, 0, 0, 'ACTIVO', 'RB-US-01', 1, 55, 1.5, 6, '2016-08-13 04:39:56', 'RB-US-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (408, 'RELOJ PULSERA', 110, 0, 0, 0, 'ACTIVO', 'REJ-01', 1, 1, 1.5, 12, '2016-08-13 04:39:56', 'REJ-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (409, 'RELOJ HOMBRE', 100, 0, 0, 0, 'ACTIVO', 'REJ-02', 1, 1, 1.5, 12, '2016-08-13 04:39:56', 'REJ-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (410, 'RESPINGADOR CHICO', 60, 0, 0, 0, 'ACTIVO', 'RES-01', 1, 1, 1.5, 12, '2016-08-13 04:39:56', 'RES-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (411, 'RESPINGADOR MEDIANOI', 60, 0, 0, 0, 'ACTIVO', 'RES-02', 1, 1, 1.5, 12, '2016-08-13 04:39:56', 'RES-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (412, 'RESPINGADOR GRANDE', 60, 0, 0, 0, 'ACTIVO', 'RES-03', 1, 1, 1.5, 12, '2016-08-13 04:39:56', 'RES-03', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (413, 'RIMEL EXTENSIONS 4D', 30, 0, 0, 0, 'ACTIVO', 'RIM-4D', 1, 14, 1.5, 6, '2016-08-13 04:39:56', 'RIM-4D', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (414, 'RIMEL BELLA', 22, 0, 0, 0, 'ACTIVO', 'RIM-BELLA', 1, 41, 1.5, 6, '2016-08-13 04:39:56', 'RIM-BELLA', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (415, 'RIMEL HOLLIWOOD', 22, 0, 0, 0, 'ACTIVO', 'RIM-HC-01', 1, 1, 1.5, 6, '2016-08-13 04:39:56', 'RIM-HC-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (416, 'RIMEL IM', 25, 0, 0, 0, 'ACTIVO', 'RIM-IM', 1, 1, 1.5, 6, '2016-08-13 04:39:56', 'RIM-IM', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (417, 'RIMEL KEJEL DE COLORES', 30, 0, 0, 0, 'ACTIVO', 'RIM-KC-04', 1, 8, 1.5, 6, '2016-08-13 04:39:56', 'RIM-KC-04', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (418, 'RIMEL MAXIMUS', 25, 0, 0, 0, 'ACTIVO', 'RIM-MAX', 1, 1, 1.5, 6, '2016-08-13 04:39:56', 'RIM-MAX', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (419, 'RIMEL ORGANIX', 25, 0, 0, 0, 'ACTIVO', 'RIM-OR-01', 1, 19, 1.5, 6, '2016-08-13 04:39:56', 'RIM-OR-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (420, 'RIMEL PROSA', 25, 0, 0, 0, 'ACTIVO', 'RIM-P-02', 1, 1, 1.5, 6, '2016-08-13 04:39:56', 'RIM-P-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (421, 'RIMEL POSTISSIMUS ESFERICO APLICADOR', 30, 0, 0, 0, 'ACTIVO', 'RIM-POSS', 1, 1, 1.5, 6, '2016-08-13 04:39:56', 'RIM-POSS', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (422, 'RIMEL TU TOOP', 35, 0, 0, 0, 'ACTIVO', 'RIM-TT-01', 1, 1, 1.5, 6, '2016-08-13 04:39:56', 'RIM-TT-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (423, 'RIMEL YOUNIQUE', 220, 0, 0, 0, 'ACTIVO', 'RIM-YOUNIQUE', 1, 57, 1.5, 6, '2016-08-13 04:39:56', 'RIM-YOUNIQUE', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (424, 'RIZADOR CAMITA 90 PZA', 20, 0, 0, 0, 'ACTIVO', 'RIZ-01', 1, 1, 1.5, 12, '2016-08-13 04:39:56', 'RIZ-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (425, 'RIZADOR ALMA 48 PZA', 14, 0, 0, 0, 'ACTIVO', 'RIZ-02', 1, 1, 1.5, 12, '2016-08-13 04:39:56', 'RIZ-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (426, 'SOMBRA VENAS CHICA', 20, 0, 0, 0, 'ACTIVO', 'S-002', 1, 1, 1.5, 6, '2016-08-13 04:39:56', 'S-002', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (427, 'SOMBRA 10 COLORES CHICA', 15, 0, 0, 0, 'ACTIVO', 'S-01', 1, 1, 1.5, 6, '2016-08-13 04:39:56', 'S-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (428, 'SAINT', 100, 0, 0, 0, 'ACTIVO', 'SAINT', 1, 22, 1.5, 3, '2016-08-13 04:39:56', 'SAINT', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (429, 'SILK BASE MAQUILLAJE', 30, 0, 0, 0, 'ACTIVO', 'SB-01', 1, 31, 1.5, 6, '2016-08-13 04:39:56', 'SB-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (430, 'SOMBRA BISSU GLITTER 1 COLOR', 15, 0, 0, 0, 'ACTIVO', 'S-BS-GL', 1, 5, 1.5, 6, '2016-08-13 04:39:56', 'S-BS-GL', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (431, 'SOMBRANUDES BEAUTY TREATS', 70, 0, 0, 0, 'ACTIVO', 'S-BT-01', 1, 1, 1.5, 6, '2016-08-13 04:39:56', 'S-BT-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (432, 'SOMBRA DE CEJA CHOCOLATE', 35, 0, 0, 0, 'ACTIVO', 'SC-01', 1, 1, 1.5, 6, '2016-08-13 04:39:56', 'SC-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (433, 'SOMBRA DE CEJA CAFÉ MEDIO', 35, 0, 0, 0, 'ACTIVO', 'SC-02', 1, 1, 1.5, 6, '2016-08-13 04:39:56', 'SC-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (434, 'SOMBRA DE CEJA CAFÉ CLARO', 35, 0, 0, 0, 'ACTIVO', 'SC-03', 1, 1, 1.5, 6, '2016-08-13 04:39:56', 'SC-03', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (435, 'SOMBRA DE CEJA CANELA', 35, 0, 0, 0, 'ACTIVO', 'SC-04', 1, 1, 1.5, 6, '2016-08-13 04:39:56', 'SC-04', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (436, 'SOMBRA DE CEJA', 30, 0, 0, 0, 'ACTIVO', 'SC-MG', 1, 1, 1.5, 6, '2016-08-13 04:39:56', 'SC-MG', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (437, 'SOMBRA FEBBLE 4 COLORES CHICA', 30, 0, 0, 0, 'ACTIVO', 'S-FB-01', 1, 1, 1.5, 6, '2016-08-13 04:39:56', 'S-FB-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (438, 'SOMBRA FEBBLE NATURAL 5 COLORES CHICA', 20, 0, 0, 0, 'ACTIVO', 'S-FB-02', 1, 1, 1.5, 6, '2016-08-13 04:39:56', 'S-FB-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (439, 'SOMBRA HENG FRANG 1 COLOR CHICA', 10, 0, 0, 0, 'ACTIVO', 'S-HF-01', 1, 1, 1.5, 6, '2016-08-13 04:39:56', 'S-HF-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (440, 'SOMBRA HEBBLE GLITTER 5 COLORES', 30, 0, 0, 0, 'ACTIVO', 'S-HG-01', 1, 33, 1.5, 6, '2016-08-13 04:39:56', 'S-HG-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (441, 'SOMBRA MY COLORS 52 COLORES', 130, 0, 0, 0, 'ACTIVO', 'S-MCC-001', 1, 10, 1.5, 6, '2016-08-13 04:39:56', 'S-MCC-001', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (442, 'SOMBRA CARTERA MY CLORS', 45, 0, 0, 0, 'ACTIVO', 'S-MC-C1', 1, 10, 1.5, 6, '2016-08-13 04:39:56', 'S-MC-C1', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (443, 'SOMBRA MY COLOR I PHONE', 40, 0, 0, 0, 'ACTIVO', 'S-MC-HP', 1, 10, 1.5, 6, '2016-08-13 04:39:56', 'S-MC-HP', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (444, 'SOMBRA MY COLORS NEONS', 75, 0, 0, 0, 'ACTIVO', 'S-MCN-03', 1, 10, 1.5, 6, '2016-08-13 04:39:56', 'S-MCN-03', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (445, 'SOMBRA MY COLORS SMOKY', 75, 0, 0, 0, 'ACTIVO', 'S-MCS-02', 1, 10, 1.5, 6, '2016-08-13 04:39:56', 'S-MCS-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (446, 'SOMBRA MY COLORS ULTRA', 75, 0, 0, 0, 'ACTIVO', 'S-MCU-01', 1, 10, 1.5, 6, '2016-08-13 04:39:56', 'S-MCU-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (447, 'AMSFERDARM', 90, 0, 0, 0, 'ACTIVO', 'SMLC01', 1, 34, 1.5, 3, '2016-08-13 04:39:56', 'SMLC01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (448, 'SFOCKHOLM', 90, 0, 0, 0, 'ACTIVO', 'SMLC02', 1, 34, 1.5, 3, '2016-08-13 04:39:56', 'SMLC02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (449, 'LONDON', 90, 0, 0, 0, 'ACTIVO', 'SMLC04', 1, 34, 1.5, 3, '2016-08-13 04:39:56', 'SMLC04', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (450, 'ANTIWERP', 90, 0, 0, 0, 'ACTIVO', 'SMLC05', 1, 34, 1.5, 3, '2016-08-13 04:39:56', 'SMLC05', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (451, 'ADDIS ABABA', 90, 0, 0, 0, 'ACTIVO', 'SMLC07', 1, 34, 1.5, 3, '2016-08-13 04:39:56', 'SMLC07', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (452, 'SAO PAULO', 90, 0, 0, 0, 'ACTIVO', 'SMLC08', 1, 34, 1.5, 3, '2016-08-13 04:39:56', 'SMLC08', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (453, 'ABU DHABI', 90, 0, 0, 0, 'ACTIVO', 'SMLC09', 1, 34, 1.5, 3, '2016-08-13 04:39:56', 'SMLC09', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (454, 'MONTE CARLO', 90, 0, 0, 0, 'ACTIVO', 'SMLC10', 1, 34, 1.5, 3, '2016-08-13 04:39:56', 'SMLC10', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (455, 'MILAN', 90, 0, 0, 0, 'ACTIVO', 'SMLC11', 1, 34, 1.5, 3, '2016-08-13 04:39:56', 'SMLC11', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (456, 'BUENOS AIRES', 90, 0, 0, 0, 'ACTIVO', 'SMLC12', 1, 34, 1.5, 3, '2016-08-13 04:39:56', 'SMLC12', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (457, 'BRONCEADO ORO SHELO NABEL', 75, 0, 0, 0, 'ACTIVO', 'SN-BR-S153', 1, 2, 1.5, 18, '2016-08-13 04:39:56', 'SN-BR-S153', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (458, 'CREMA CONCHA NACAR 290 GR', 150, 0, 0, 0, 'ACTIVO', 'SN-S004', 2, 2, 1.5, 18, '2016-08-13 04:39:56', 'SN-S004', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (459, 'AGUA DE ROSAS', 110, 0, 0, 0, 'ACTIVO', 'SN-S012', 2, 2, 1.5, 18, '2016-08-13 04:39:56', 'SN-S012', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (460, 'CLOROFILA LIQUIDA', 185, 0, 0, 0, 'ACTIVO', 'SN-S039', 2, 2, 1.5, 18, '2016-08-13 04:39:56', 'SN-S039', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (461, 'ACONDICIONADOR DE CHILE', 90, 0, 0, 0, 'ACTIVO', 'SN-S064', 2, 2, 1.5, 5, '2016-08-13 04:39:56', 'SN-S064', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (462, 'ACEITE DE CHILE', 120, 0, 0, 0, 'ACTIVO', 'SN-S065', 2, 2, 1.5, 5, '2016-08-13 04:39:56', 'SN-S065', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (463, 'REDUGEL CON ALGAS MARINAS ', 170, 0, 0, 0, 'ACTIVO', 'SN-S090', 2, 2, 1.5, 18, '2016-08-13 04:39:56', 'SN-S090', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (464, 'CREMA BB DE CARACOL 1000 ML', 185, 0, 0, 0, 'ACTIVO', 'SN-S156', 2, 2, 1.5, 18, '2016-08-13 04:39:56', 'SN-S156', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (465, 'JUGO DE SABILA', 110, 0, 0, 0, 'ACTIVO', 'SN-S195', 2, 2, 1.5, 18, '2016-08-13 04:39:56', 'SN-S195', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (466, 'CREMA UVA 50ML', 50, 0, 0, 0, 'ACTIVO', 'SN-S311', 2, 2, 1.5, 18, '2016-08-13 04:39:56', 'SN-S311', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (467, 'CREMA AZUCAR MIEL Y VAINILLA 50 ML', 50, 0, 0, 0, 'ACTIVO', 'SN-S313', 2, 2, 1.5, 18, '2016-08-13 04:39:56', 'SN-S313', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (468, 'CREMA LECHE DE PEPINO', 49, 0, 0, 0, 'ACTIVO', 'SN-S316', 2, 2, 1.5, 18, '2016-08-13 04:39:56', 'SN-S316', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (469, 'SHAMPOO CONCENTRADO DE CHILE 400ML', 135, 0, 0, 0, 'ACTIVO', 'SN-S341', 2, 2, 1.5, 5, '2016-08-13 04:39:56', 'SN-S341', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (470, 'JARABE DE HIERBAS', 110, 0, 0, 0, 'ACTIVO', 'SN-S409', 2, 2, 1.5, 18, '2016-08-13 04:39:56', 'SN-S409', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (471, 'GEL PARA CABELLO', 25, 0, 0, 0, 'ACTIVO', 'SN-S423', 2, 2, 1.5, 5, '2016-08-13 04:39:56', 'SN-S423', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (472, 'SHAMPOO COLA DE CABALLO 950ML', 210, 0, 0, 0, 'ACTIVO', 'SN-S731', 2, 2, 1.5, 5, '2016-08-13 04:39:56', 'SN-S731', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (473, 'SEDA PURE SPRAY', 50, 0, 0, 0, 'ACTIVO', 'SP-73', 1, 1, 1.5, 5, '2016-08-13 04:39:56', 'SP-73', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (474, 'SOMBRA PROFUSSION 28 COLORES', 75, 0, 0, 0, 'ACTIVO', 'S-PF-001', 1, 51, 1.5, 6, '2016-08-13 04:39:56', 'S-PF-001', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (475, 'SOMBRA CARTERA PROFUSSION ', 180, 0, 0, 0, 'ACTIVO', 'S-PFC-01', 1, 51, 1.5, 6, '2016-08-13 04:39:56', 'S-PFC-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (476, 'SOMBRA PROFUSSION GLAM 10 COLORES GRANDE', 85, 0, 0, 0, 'ACTIVO', 'S-PFG-002', 1, 51, 1.5, 6, '2016-08-13 04:39:56', 'S-PFG-002', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (477, 'SOMBRA PROFUSSION SMOKY 10 COLORES GRANDE', 85, 0, 0, 0, 'ACTIVO', 'S-PFN-001', 1, 51, 1.5, 6, '2016-08-13 04:39:56', 'S-PFN-001', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (478, 'SOMBRA PENIEL GLITTER 20 COLORES', 70, 0, 0, 0, 'ACTIVO', 'S-P-GL', 1, 30, 1.5, 6, '2016-08-13 04:39:56', 'S-P-GL', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (479, 'SOMBRA PROFUSSION MATTE 34 COLORES', 40, 0, 0, 0, 'ACTIVO', 'S-PM-01', 1, 51, 1.5, 6, '2016-08-13 04:39:56', 'S-PM-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (480, 'SOMBRA ART COLOR 12 COLORES', 50, 0, 0, 0, 'ACTIVO', 'S-SAT-01', 1, 12, 1.5, 6, '2016-08-13 04:39:56', 'S-SAT-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (481, 'STICKERS GRANDE PARA DECORACION', 55, 0, 0, 0, 'ACTIVO', 'STIC-01G', 1, 1, 1.5, 13, '2016-08-13 04:39:56', 'STIC-01G', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (482, 'STICKERS MEDIANO PARA DECORACION', 45, 0, 0, 0, 'ACTIVO', 'STIC-02M', 1, 1, 1.5, 13, '2016-08-13 04:39:56', 'STIC-02M', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (483, 'STICKERS CHICO PARA DECORACION', 35, 0, 0, 0, 'ACTIVO', 'STIC-03C', 1, 1, 1.5, 13, '2016-08-13 04:39:56', 'STIC-03C', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (484, 'SOMBRA TNGO 28 COLORES', 75, 0, 0, 0, 'ACTIVO', 'S-TNG-002', 1, 53, 1.5, 6, '2016-08-13 04:39:56', 'S-TNG-002', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (485, 'SOMBRA USHAS GLAM 10 COLORES GRANDE', 85, 0, 0, 0, 'ACTIVO', 'S-US-G02', 1, 55, 1.5, 6, '2016-08-13 04:39:56', 'S-US-G02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (486, 'SOMBRA USHAS NUDE 10 COLORES GRANDE', 85, 0, 0, 0, 'ACTIVO', 'S-US-N01', 1, 55, 1.5, 6, '2016-08-13 04:39:56', 'S-US-N01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (487, 'SOMBRA USHAS SMOKY', 85, 0, 0, 0, 'ACTIVO', 'S-US-S03', 1, 55, 1.5, 6, '2016-08-13 04:39:56', 'S-US-S03', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (488, 'SOMBRA VERONICA CONTI GRANDE', 75, 0, 0, 0, 'ACTIVO', 'S-VC-01', 1, 56, 1.5, 6, '2016-08-13 04:39:56', 'S-VC-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (489, 'PINK LUST', 30, 0, 25, 0, 'ACTIVO', 'T35', 1, 8, 1.5, 3, '2016-08-13 04:39:56', 'T35', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (490, 'NEGRO', 30, 0, 25, 0, 'ACTIVO', 'T68', 1, 8, 1.5, 3, '2016-08-13 04:39:56', 'T68', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (491, 'TARJETA DE FELICITACION', 10, 0, 0, 0, 'ACTIVO', 'TAR-01', 1, 1, 1.5, 13, '2016-08-13 04:39:56', 'TAR-01', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (492, 'SOBRE PARA TARJETA', 5, 0, 0, 0, 'ACTIVO', 'TAR-02', 1, 1, 1.5, 13, '2016-08-13 04:39:56', 'TAR-02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (493, 'TOMATOX SOBRE', 20, 0, 0, 0, 'ACTIVO', 'TOMATOX-S', 1, 54, 1.5, 15, '2016-08-13 04:39:56', 'TOMATOX-S', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (494, 'TOMATOX TARRO', 260, 0, 0, 0, 'ACTIVO', 'TOMATOX-T', 1, 54, 1.5, 15, '2016-08-13 04:39:56', 'TOMATOX-T', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (495, 'TRUE LOVE', 100, 0, 0, 0, 'ACTIVO', 'TRUE LOVE', 1, 22, 1.5, 3, '2016-08-13 04:39:56', 'TRUE LOVE', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (496, 'LIP COLOR', 17, 0, 0, 0, 'ACTIVO', 'WOW', 1, 24, 1.5, 3, '2016-08-13 04:39:56', 'WOW', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (497, 'SWEET MINT', 30, 0, 25, 0, 'ACTIVO', 'Z02', 1, 8, 1.5, 3, '2016-08-13 04:39:56', 'Z02', '1.16', 0, 0, 0, 1, 1, 0, NULL);
INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `costo`, `precio_descuento`, `descuento_activado`, `status`, `codbarras`, `id_proveedor`, `id_marca`, `multiplicador`, `id_categoria`, `fecha_registro`, `codinter`, `condiciones`, `exento_iva`, `ieps`, `paquete`, `alerta_minima`, `exento_ieps`, `precio_costo`, `imagen`) VALUES (498, 'LENTES DE SOL', 165, 0, 0, 0, 'ACTIVO', 'ZONA-G', 3, 48, 1.5, 12, '2016-08-13 04:39:56', 'ZONA-G', '1.16', 0, 0, 0, 1, 1, 0, NULL);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `productos_venta`
-- 

CREATE TABLE `productos_venta` (
  `id_productos_venta` bigint(20) NOT NULL auto_increment,
  `id_venta` bigint(20) NOT NULL,
  `cantidad` double default NULL,
  `nombre` varchar(45) collate utf8_unicode_ci default NULL,
  `total` double default NULL,
  `cancelado` tinyint(4) default '0',
  `id_productotienda` int(11) NOT NULL,
  `costototal` double default '0',
  `status` varchar(45) collate utf8_unicode_ci default 'ACTIVO',
  `folio` int(11) default NULL,
  `paquete` int(11) default '0',
  `tipoprecio` varchar(45) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id_productos_venta`),
  KEY `fk_productos_venta_venta1` (`id_venta`),
  KEY `fk_productos_venta_producto1_idx` (`id_productotienda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `productos_venta`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `producto_tienda`
-- 

CREATE TABLE `producto_tienda` (
  `id_productotienda` int(11) NOT NULL auto_increment,
  `existencias` double default '0',
  `status` varchar(45) default 'ACTIVO',
  `tienda_id_tienda` int(11) NOT NULL default '13',
  `id_producto` bigint(20) NOT NULL,
  `alerta_minima` double default NULL,
  PRIMARY KEY  (`id_productotienda`),
  KEY `fk_producto_tienda_tienda1_idx` (`tienda_id_tienda`),
  KEY `fk_producto_tienda_producto1_idx` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `producto_tienda`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `proveedor`
-- 

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL auto_increment,
  `nombre_corto` varchar(45) collate utf8_unicode_ci default NULL,
  `telefono` varchar(45) collate utf8_unicode_ci default NULL,
  `info_adicional` text collate utf8_unicode_ci,
  `id_persona` bigint(20) NOT NULL,
  PRIMARY KEY  (`id_proveedor`),
  KEY `fk_proveedor_persona1_idx` (`id_persona`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- 
-- Volcar la base de datos para la tabla `proveedor`
-- 

INSERT INTO `proveedor` (`id_proveedor`, `nombre_corto`, `telefono`, `info_adicional`, `id_persona`) VALUES (1, 'YAC', '', '', 3);
INSERT INTO `proveedor` (`id_proveedor`, `nombre_corto`, `telefono`, `info_adicional`, `id_persona`) VALUES (2, 'Shelo Nabel', '', '', 3);
INSERT INTO `proveedor` (`id_proveedor`, `nombre_corto`, `telefono`, `info_adicional`, `id_persona`) VALUES (3, 'Zona Glam', '', '', 3);
INSERT INTO `proveedor` (`id_proveedor`, `nombre_corto`, `telefono`, `info_adicional`, `id_persona`) VALUES (4, 'Estilo Andori', NULL, NULL, 3);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `salida`
-- 

CREATE TABLE `salida` (
  `id_salida` int(11) NOT NULL auto_increment,
  `fecha_registro` timestamp NULL default CURRENT_TIMESTAMP,
  `fecha` timestamp NULL default NULL,
  `costo_total` double default NULL,
  `total` double default NULL,
  `concepto` varchar(100) character set utf8 collate utf8_unicode_ci default 'Traspaso de Almacen',
  `referencia` varchar(45) character set utf8 collate utf8_unicode_ci default NULL,
  `cancelado` tinyint(4) default '0',
  `id_usuario` varchar(45) character set utf8 collate utf8_unicode_ci NOT NULL,
  `id_tienda` int(11) default '6',
  `comentarios` varchar(100) character set utf8 collate utf8_unicode_ci default NULL,
  `status` varchar(45) character set utf8 collate utf8_unicode_ci default 'POR AUTORIZAR',
  `ticket_items` text character set utf8 collate utf8_unicode_ci,
  `id_tiendaanterior` int(11) default NULL,
  PRIMARY KEY  (`id_salida`),
  KEY `id_tienda_idx` (`id_tienda`),
  KEY `id_usu_idx` (`id_usuario`),
  KEY `id_tien_idx` (`id_tiendaanterior`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `salida`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `salida_producto`
-- 

CREATE TABLE `salida_producto` (
  `id_salida_producto` int(11) NOT NULL auto_increment,
  `id_producto` bigint(20) NOT NULL,
  `fechare_gistro` timestamp NULL default CURRENT_TIMESTAMP,
  `cantidad` double default NULL,
  `status` varchar(45) character set utf8 collate utf8_unicode_ci NOT NULL default 'ACTIVO',
  `costo` double NOT NULL default '0',
  `multiplicador` double default NULL,
  `precio` double default NULL,
  `iva` varchar(45) character set utf8 collate utf8_unicode_ci default NULL,
  `cantvendida` double default '0',
  `ieps` double default '0',
  `id_salida` int(11) NOT NULL,
  `totalcosto` double default '0',
  `nombre` varchar(100) character set utf8 collate utf8_unicode_ci default NULL,
  `id_tienda` int(11) default NULL,
  `precio_descuento` double default NULL,
  `cancelado` tinyint(4) default '0',
  PRIMARY KEY  (`id_salida_producto`),
  KEY `id_salida_idx` (`id_salida`),
  KEY `id_p_idx` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `salida_producto`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `tienda`
-- 

CREATE TABLE `tienda` (
  `id_tienda` int(11) NOT NULL auto_increment,
  `nombre` varchar(100) default NULL,
  `telefono` varchar(45) default NULL,
  `info_adicional` varchar(45) default NULL,
  `status` varchar(45) default 'ACTIVA',
  `ubicacion` varchar(100) default NULL,
  `permiso_adicional` int(11) default '0',
  PRIMARY KEY  (`id_tienda`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- 
-- Volcar la base de datos para la tabla `tienda`
-- 

INSERT INTO `tienda` (`id_tienda`, `nombre`, `telefono`, `info_adicional`, `status`, `ubicacion`, `permiso_adicional`) VALUES (4, 'No Seleccionada', '', '', 'BAJA', '*', 0);
INSERT INTO `tienda` (`id_tienda`, `nombre`, `telefono`, `info_adicional`, `status`, `ubicacion`, `permiso_adicional`) VALUES (12, 'Almacen', '', '', 'BAJA', '', 0);
INSERT INTO `tienda` (`id_tienda`, `nombre`, `telefono`, `info_adicional`, `status`, `ubicacion`, `permiso_adicional`) VALUES (13, 'YAC', '', '', 'ACTIVA', '', 0);
INSERT INTO `tienda` (`id_tienda`, `nombre`, `telefono`, `info_adicional`, `status`, `ubicacion`, `permiso_adicional`) VALUES (14, 'Tienda2', '', '', 'BAJA', '', 0);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `traspaso`
-- 

CREATE TABLE `traspaso` (
  `id_traspaso` int(11) NOT NULL auto_increment,
  `fecha_registro` timestamp NULL default CURRENT_TIMESTAMP,
  `fecha` timestamp NULL default NULL,
  `costo_total` double default NULL,
  `total` double default NULL,
  `concepto` varchar(100) character set utf8 collate utf8_unicode_ci default 'Traspaso de Almacen',
  `folio` varchar(45) character set utf8 collate utf8_unicode_ci default NULL,
  `referencia` varchar(45) character set utf8 collate utf8_unicode_ci default NULL,
  `cancelado` tinyint(4) default '0',
  `id_usuario` varchar(45) character set utf8 collate utf8_unicode_ci NOT NULL,
  `id_tienda` int(11) NOT NULL default '6',
  `comentarios` varchar(100) character set utf8 collate utf8_unicode_ci default NULL,
  `status` varchar(45) character set utf8 collate utf8_unicode_ci default 'SOLICITADO',
  `ticket_items` text character set utf8 collate utf8_unicode_ci,
  `id_tiendaanterior` int(11) default NULL,
  PRIMARY KEY  (`id_traspaso`),
  KEY `id_tienda_idx` (`id_tienda`),
  KEY `id_usu_idx` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `traspaso`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `traspaso_producto`
-- 

CREATE TABLE `traspaso_producto` (
  `id_traspaso_producto` int(11) NOT NULL auto_increment,
  `id_producto` bigint(20) NOT NULL,
  `fechare_gistro` timestamp NULL default CURRENT_TIMESTAMP,
  `cantidad` double default NULL,
  `status` varchar(45) collate utf8_unicode_ci NOT NULL default 'ACTIVO',
  `costo` double NOT NULL default '0',
  `multiplicador` double default NULL,
  `precio` double default NULL,
  `iva` varchar(45) collate utf8_unicode_ci default NULL,
  `cantvendida` double default '0',
  `ieps` double default '0',
  `id_traspaso` int(11) NOT NULL,
  `totalcosto` double default '0',
  `nombre` varchar(100) collate utf8_unicode_ci default NULL,
  `id_tienda` int(11) default NULL,
  `precio_descuento` double default NULL,
  `cancelado` tinyint(4) default '0',
  `cant_anterior` int(11) default '0',
  PRIMARY KEY  (`id_traspaso_producto`),
  KEY `fk_traspaso_producto_producto1` (`id_producto`),
  KEY `id_traspaso_idx` (`id_traspaso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `traspaso_producto`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuario`
-- 

CREATE TABLE `usuario` (
  `id_usuario` varchar(45) collate utf8_unicode_ci NOT NULL,
  `password` varchar(45) collate utf8_unicode_ci default NULL,
  `session_id` varchar(45) collate utf8_unicode_ci default NULL,
  `status` varchar(45) collate utf8_unicode_ci default 'ACTIVO',
  `id_usuario_tipo` bigint(20) NOT NULL,
  `nombre` varchar(45) collate utf8_unicode_ci default NULL,
  `id_tienda` int(11) default NULL,
  `permisos` varchar(45) collate utf8_unicode_ci default 'TODO',
  PRIMARY KEY  (`id_usuario`),
  KEY `fk_usuario_usuario_tipo1_idx` (`id_usuario_tipo`),
  KEY `id_tienda_idx` (`id_tienda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Volcar la base de datos para la tabla `usuario`
-- 

INSERT INTO `usuario` (`id_usuario`, `password`, `session_id`, `status`, `id_usuario_tipo`, `nombre`, `id_tienda`, `permisos`) VALUES ('jorge', 'jorge', 'ef24627831f1019002e0690ba4ebadc5', 'ACTIVO', 2, 'jorge', 13, 'TODO');
INSERT INTO `usuario` (`id_usuario`, `password`, `session_id`, `status`, `id_usuario_tipo`, `nombre`, `id_tienda`, `permisos`) VALUES ('prueba', 'prueba', '18c678fe28668a9d4dd02c1ed6f02a4d', 'ACTIVO', 2, 'prueba', 14, 'VENDEDOR');
INSERT INTO `usuario` (`id_usuario`, `password`, `session_id`, `status`, `id_usuario_tipo`, `nombre`, `id_tienda`, `permisos`) VALUES ('vendedor1', 'vendedor1', 'b6e6995b993f6986aa087db5ebf796e4', 'ACTIVO', 2, 'vendedor1', 13, 'TODO');
INSERT INTO `usuario` (`id_usuario`, `password`, `session_id`, `status`, `id_usuario_tipo`, `nombre`, `id_tienda`, `permisos`) VALUES ('vendedor2', 'vendedor2', NULL, 'ACTIVO', 4, 'vendedor2', 12, 'VENDEDOR');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuarios_venta`
-- 

CREATE TABLE `usuarios_venta` (
  `id_usuarios_venta` int(11) NOT NULL auto_increment,
  `id_usuario` varchar(45) default NULL,
  `fecha_registro` timestamp NULL default CURRENT_TIMESTAMP,
  `id_venta` bigint(20) default NULL,
  `porcentaje` int(11) default NULL,
  `monto` double default NULL,
  PRIMARY KEY  (`id_usuarios_venta`),
  KEY `id_ventadx_idx` (`id_venta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `usuarios_venta`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuario_tipo`
-- 

CREATE TABLE `usuario_tipo` (
  `id_usuario_tipo` bigint(20) NOT NULL auto_increment,
  `usuario_tipo` varchar(45) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id_usuario_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- 
-- Volcar la base de datos para la tabla `usuario_tipo`
-- 

INSERT INTO `usuario_tipo` (`id_usuario_tipo`, `usuario_tipo`) VALUES (1, 'Cliente');
INSERT INTO `usuario_tipo` (`id_usuario_tipo`, `usuario_tipo`) VALUES (2, 'Administrador');
INSERT INTO `usuario_tipo` (`id_usuario_tipo`, `usuario_tipo`) VALUES (3, 'Proveedor');
INSERT INTO `usuario_tipo` (`id_usuario_tipo`, `usuario_tipo`) VALUES (4, 'Empleado');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `validaentrada`
-- 

CREATE TABLE `validaentrada` (
  `id_validaentrada` int(11) NOT NULL auto_increment,
  `id_entrada` int(11) default NULL,
  `cantidad` double default NULL,
  `status` varchar(45) default 'ACTIVO',
  `fecha_registro` timestamp NULL default CURRENT_TIMESTAMP,
  `id_usuario` varchar(45) default NULL,
  `validaentradacol` varchar(45) default NULL,
  `cancelado` tinyint(4) default '0',
  PRIMARY KEY  (`id_validaentrada`),
  KEY `id_entradaprod_idx` (`id_entrada`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `validaentrada`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `validasalida`
-- 

CREATE TABLE `validasalida` (
  `id_validasalida` int(11) NOT NULL auto_increment,
  `id_salida` int(11) NOT NULL,
  `cantidad` double default NULL,
  `status` varchar(45) default 'ACTIVO',
  `fecha_registro` timestamp NULL default CURRENT_TIMESTAMP,
  `id_usuario` varchar(45) default NULL,
  PRIMARY KEY  (`id_validasalida`),
  KEY `id_salidaprod_idx` (`id_salida`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `validasalida`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `validatraspaso`
-- 

CREATE TABLE `validatraspaso` (
  `id_validatraspaso` int(11) NOT NULL auto_increment,
  `id_traspaso` int(11) default NULL,
  `cantidad` double default NULL,
  `status` varchar(45) default 'ACTIVO',
  `fecha_registro` timestamp NULL default CURRENT_TIMESTAMP,
  `id_usuario` varchar(45) default NULL,
  PRIMARY KEY  (`id_validatraspaso`),
  KEY `id_traspasoprod_idx` (`id_traspaso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `validatraspaso`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `valida_inventario`
-- 

CREATE TABLE `valida_inventario` (
  `id_validainventario` int(11) NOT NULL auto_increment,
  `id_usuario` varchar(45) default NULL,
  `fecha_registro` timestamp NULL default CURRENT_TIMESTAMP,
  `fecha_validacion` varchar(45) default NULL,
  `comentarios` varchar(45) default NULL,
  `estatus_validacion` varchar(45) default NULL,
  `status` varchar(45) default 'ACTIVO',
  `cantidad` double default NULL,
  PRIMARY KEY  (`id_validainventario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `valida_inventario`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `venta`
-- 

CREATE TABLE `venta` (
  `id_venta` bigint(20) NOT NULL auto_increment,
  `fecha` timestamp NULL default CURRENT_TIMESTAMP,
  `usuariosventa` varchar(150) collate utf8_unicode_ci default NULL,
  `total` double default NULL,
  `tipo` varchar(45) collate utf8_unicode_ci default NULL,
  `factura` tinyint(4) default NULL,
  `no_calculable` tinyint(4) default '0',
  `ticket_items` text collate utf8_unicode_ci,
  `cancelado` tinyint(4) default '0',
  `id_usuario` varchar(45) collate utf8_unicode_ci NOT NULL,
  `id_persona` bigint(20) default NULL,
  `id_tienda` int(11) default NULL,
  `consignacion` tinyint(4) default '0',
  `icredito` tinyint(4) default '0',
  `folio` int(11) default NULL,
  PRIMARY KEY  (`id_venta`),
  KEY `fk_venta_usuario1_idx` (`id_usuario`),
  KEY `id_persona1_idx` (`id_persona`),
  KEY `id_tienda_idx` (`id_tienda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `venta`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `ventascorte`
-- 

CREATE TABLE `ventascorte` (
  `id` tinyint(4) NOT NULL,
  `id_venta` tinyint(4) NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  `total` tinyint(4) NOT NULL,
  `id_tienda` tinyint(4) NOT NULL,
  `nombre` tinyint(4) NOT NULL,
  `abono` tinyint(4) NOT NULL,
  `id_usuario` tinyint(4) NOT NULL,
  `fecha` tinyint(4) NOT NULL,
  `fechahora` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `ventascorte`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `venta_cancelada`
-- 

CREATE TABLE `venta_cancelada` (
  `id_ventacancelada` int(11) NOT NULL auto_increment,
  `total` double default '0',
  `id_usuario` varchar(45) default NULL,
  `id_venta` bigint(20) default NULL,
  `fecha_registro` timestamp NULL default CURRENT_TIMESTAMP,
  `id_tienda_destino` int(11) default NULL,
  `observaciones` varchar(100) default NULL,
  PRIMARY KEY  (`id_ventacancelada`),
  KEY `id_prod_idx` (`id_venta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `venta_cancelada`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `venta_productocancelado`
-- 

CREATE TABLE `venta_productocancelado` (
  `id_venta_productocancelado` int(11) NOT NULL auto_increment,
  `id_usuario` varchar(45) default NULL,
  `fecha_registro` timestamp NULL default CURRENT_TIMESTAMP,
  `id_productos_venta` bigint(20) default NULL,
  `total` double default NULL,
  `observaciones` varchar(100) default NULL,
  `id_tienda_destino` int(11) default NULL,
  PRIMARY KEY  (`id_venta_productocancelado`),
  KEY `id_pro_idx` (`id_productos_venta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `venta_productocancelado`
-- 


-- --------------------------------------------------------

-- 
-- Estructura para la vista `detalle_ventascorte`
-- 
DROP TABLE IF EXISTS `detalle_ventascorte`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jpetdeshdn`@`localhost` SQL SECURITY DEFINER VIEW `jpetdeshdn`.`detalle_ventascorte` AS select (`vc`.`id` = 0) AS `id`,`vc`.`id_venta` AS `id_venta`,`pv`.`cantidad` AS `cantidad`,`p`.`codinter` AS `codinter`,`p`.`nombre` AS `nombre`,`p`.`exento_iva` AS `exento_iva`,`p`.`exento_ieps` AS `exento_ieps`,`vc`.`fecha` AS `fecha`,`pv`.`total` AS `total`,`vc`.`tipo` AS `tipo`,`vc`.`id_usuario` AS `id_usuario`,`vc`.`id_tienda` AS `id_tienda` from ((((`jpetdeshdn`.`ventascorte` `vc` left join `jpetdeshdn`.`venta` `v` on((`vc`.`id_venta` = `v`.`id_venta`))) left join `jpetdeshdn`.`productos_venta` `pv` on((`vc`.`id_venta` = `pv`.`id_venta`))) left join `jpetdeshdn`.`producto_tienda` `pt` on((`pt`.`id_productotienda` = `pv`.`id_productotienda`))) left join `jpetdeshdn`.`producto` `p` on((`pt`.`id_producto` = `p`.`id_producto`))) where ((`pv`.`cancelado` = 0) and (`vc`.`abono` <> 1));

-- 
-- Filtros para las tablas descargadas (dump)
-- 

-- 
-- Filtros para la tabla `comisiones_vendedor`
-- 
ALTER TABLE `comisiones_vendedor`
  ADD CONSTRAINT `ID_comi_dx` FOREIGN KEY (`id_comisiones`) REFERENCES `comisiones` (`id_comisiones`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_tiendadxcomi` FOREIGN KEY (`id_tienda`) REFERENCES `tienda` (`id_tienda`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `datos_facturacion`
-- 
ALTER TABLE `datos_facturacion`
  ADD CONSTRAINT `fk_datos_facturacion_persona1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `descgastos_comision`
-- 
ALTER TABLE `descgastos_comision`
  ADD CONSTRAINT `id_comisionesvendedx` FOREIGN KEY (`id_comisiones_vendedor`) REFERENCES `comisiones_vendedor` (`id_comisiones_vendedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `descuentos`
-- 
ALTER TABLE `descuentos`
  ADD CONSTRAINT `id_venta1` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `deudores`
-- 
ALTER TABLE `deudores`
  ADD CONSTRAINT `id_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_venta` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `entrada`
-- 
ALTER TABLE `entrada`
  ADD CONSTRAINT `fk_entrada_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idtienda` FOREIGN KEY (`id_tienda`) REFERENCES `tienda` (`id_tienda`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `entrada_producto`
-- 
ALTER TABLE `entrada_producto`
  ADD CONSTRAINT `fk_entrada_producto_producto1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_entr` FOREIGN KEY (`id_entrada`) REFERENCES `entrada` (`id_entrada`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `entrada_productocancelado`
-- 
ALTER TABLE `entrada_productocancelado`
  ADD CONSTRAINT `id_entra` FOREIGN KEY (`id_entrada_producto`) REFERENCES `entrada_producto` (`id_entrada_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `factura`
-- 
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_factura_persona1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `paquete`
-- 
ALTER TABLE `paquete`
  ADD CONSTRAINT `id_opr` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;
