-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-01-2020 a las 19:01:59
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `school_ue9o`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `flag` (IN `usuario` VARCHAR(50))  BEGIN
	SELECT m.ventana
    FROM sys_menu AS m
    INNER JOIN sys_acceso AS a
    ON (a.idacceso=m.idmenu)
    WHERE a.usuario=usuario
    AND m.estado='A'
    AND m.es_menu='NO'
    ORDER BY m.idpadre, m.orden
    LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `permisos_pagina` (IN `usuario` VARCHAR(50), IN `pagina` VARCHAR(50))  BEGIN
SELECT a.idacceso, m.nombre, m.ventana, m.libreria
            FROM sys_acceso AS a
            INNER JOIN sys_menu AS m
            ON (a.idacceso=m.idmenu)
            WHERE a.usuario=usuario
            AND m.ventana=pagina
            AND m.estado='A';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `submenu` (IN `usuario` VARCHAR(50))  BEGIN
SELECT m.idmenu, m.idpadre, m.nombre, m.ventana, m.es_menu, m.icono
FROM sys_menu AS m
LEFT JOIN sys_acceso AS a
ON (m.idmenu=a.idacceso)
WHERE a.usuario=usuario
AND m.estado='A'
AND m.idpadre IS NOT NULL
ORDER BY m.orden;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `lista_parametro`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `lista_parametro` (
`parametro` int(10) unsigned zerofill
,`nombre` varchar(50)
,`descripcion` varchar(150)
,`valor` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_acceso`
--

CREATE TABLE `sys_acceso` (
  `idacceso` int(10) UNSIGNED ZEROFILL NOT NULL,
  `usuario` varchar(75) NOT NULL,
  `usuario_update` varchar(50) DEFAULT NULL,
  `fecha_update` datetime DEFAULT NULL,
  `usuario_registro` varchar(50) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sys_acceso`
--

INSERT INTO `sys_acceso` (`idacceso`, `usuario`, `usuario_update`, `fecha_update`, `usuario_registro`, `fecha_registro`) VALUES
(0000000001, 'Desarrollador', NULL, NULL, 'Desarrollador', '2020-01-29 11:05:44'),
(0000000002, 'Desarrollador', NULL, NULL, 'Desarrollador', '2020-01-29 10:45:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_menu`
--

CREATE TABLE `sys_menu` (
  `idmenu` int(10) UNSIGNED ZEROFILL NOT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `libreria` varchar(250) DEFAULT NULL,
  `orden` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `idpadre` int(11) UNSIGNED ZEROFILL DEFAULT NULL,
  `ventana` varchar(50) DEFAULT NULL,
  `es_menu` char(3) DEFAULT NULL,
  `icono` varchar(50) NOT NULL,
  `usuario_registro` varchar(50) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `usuario_update` varchar(50) DEFAULT NULL,
  `fecha_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sys_menu`
--

INSERT INTO `sys_menu` (`idmenu`, `nombre`, `libreria`, `orden`, `estado`, `idpadre`, `ventana`, `es_menu`, `icono`, `usuario_registro`, `fecha_registro`, `usuario_update`, `fecha_update`) VALUES
(0000000001, 'Inicio', NULL, 0000000001, 'A', NULL, NULL, 'SI', 'fa fa-home', NULL, NULL, 'Desarrollador', '2020-01-29 10:33:53'),
(0000000002, 'Inicio', NULL, 0000000001, 'A', 00000000001, 'inicio', 'NO', 'fa fa-home', NULL, NULL, 'Desarrollador', '2020-01-29 11:04:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_parametro`
--

CREATE TABLE `sys_parametro` (
  `id_parametro` int(10) UNSIGNED ZEROFILL NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `valor` varchar(50) NOT NULL,
  `usuario_update` varchar(50) DEFAULT NULL,
  `fecha_update` datetime DEFAULT NULL,
  `usuario_registro` varchar(50) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sys_parametro`
--

INSERT INTO `sys_parametro` (`id_parametro`, `nombre`, `descripcion`, `valor`, `usuario_update`, `fecha_update`, `usuario_registro`, `fecha_registro`) VALUES
(0000000001, 'nameMini', 'Nombre de la institución a la que opera el sistema. Tomando las iniciales de la institución.', 'U.E.9.O.', NULL, NULL, 'Desarrollador', '2020-01-29 10:15:57'),
(0000000002, 'webversion', 'Sistema de versionamiento para los css y javascript.', '5', NULL, NULL, 'Desarrollador', '2020-01-24 10:17:39'),
(0000000003, 'nameEmpresa', 'Nombre de la empresa la cual opera el sistema, con nombres largos.', 'Unidad Educativa 9 de Octubre', NULL, NULL, 'Desarrollador', '2020-01-29 10:17:50'),
(0000000004, 'paginaDefault', 'Página de inicio por default del sistema.', 'inicio', NULL, NULL, 'Desarrollador', '2020-01-29 10:35:07');

-- --------------------------------------------------------

--
-- Estructura para la vista `lista_parametro`
--
DROP TABLE IF EXISTS `lista_parametro`;

CREATE ALGORITHM=TEMPTABLE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lista_parametro`  AS  select `sys_parametro`.`id_parametro` AS `parametro`,`sys_parametro`.`nombre` AS `nombre`,`sys_parametro`.`descripcion` AS `descripcion`,`sys_parametro`.`valor` AS `valor` from `sys_parametro` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sys_acceso`
--
ALTER TABLE `sys_acceso`
  ADD PRIMARY KEY (`idacceso`);

--
-- Indices de la tabla `sys_menu`
--
ALTER TABLE `sys_menu`
  ADD PRIMARY KEY (`idmenu`);

--
-- Indices de la tabla `sys_parametro`
--
ALTER TABLE `sys_parametro`
  ADD PRIMARY KEY (`id_parametro`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sys_acceso`
--
ALTER TABLE `sys_acceso`
  MODIFY `idacceso` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sys_menu`
--
ALTER TABLE `sys_menu`
  MODIFY `idmenu` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sys_parametro`
--
ALTER TABLE `sys_parametro`
  MODIFY `id_parametro` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
