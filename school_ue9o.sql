-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-02-2020 a las 20:29:50
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
	IF usuario = "Desarrollador" OR usuario = "Administrador" THEN
        SELECT m.ventana
        FROM sys_menu AS m
        INNER JOIN sys_acceso AS a
        ON (m.idmenu=a.idacceso);
	ELSE
        SELECT m.ventana
        FROM sys_menu AS m
        INNER JOIN sys_acceso AS a
        ON (m.idmenu=a.idacceso)
        WHERE a.usuario=usuario
        AND m.estado='A'
        AND m.es_menu='N'
        ORDER BY m.idpadre, m.orden
        LIMIT 1;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `menu` (IN `usuario` VARCHAR(50))  BEGIN
    IF usuario ='Administrador' OR usuario='Desarrollador' THEN
    	SELECT m.idmenu, m.idpadre, m.nombre, m.ventana, m.es_menu, m.icono
        FROM sys_menu AS m
        INNER JOIN sys_acceso AS a
        ON (m.idmenu=a.idacceso)
        ORDER BY m.orden;
    ELSE
    	SELECT m.idmenu, m.idpadre, m.nombre, m.ventana, m.es_menu, m.icono
        FROM sys_menu AS m
        INNER JOIN sys_acceso AS a
        ON (m.idmenu=a.idacceso)
        WHERE a.usuario=usuario
        AND m.estado='A'
        AND m.idpadre IS NOT NULL
        ORDER BY m.orden;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `permisos` (IN `usuario` VARCHAR(50) CHARSET utf8, IN `pagina` VARCHAR(50) CHARSET utf8)  BEGIN
	IF usuario="Desarrollador" OR usuario = "Administrador" THEN
    	SELECT a.idacceso, m.nombre, m.ventana, m.libreria
        FROM sys_acceso AS a
        INNER JOIN sys_menu as m
        ON (a.idacceso=m.idmenu)
        WHERE a.usuario=usuario
        AND m.ventana=pagina;
    ELSE
        SELECT a.idacceso, m.nombre, m.ventana, m.libreria
        FROM sys_acceso AS a
        INNER JOIN sys_menu as m
        ON (a.idacceso=m.idmenu)
        WHERE a.usuario=usuario
        AND m.ventana=pagina
        AND m.estado='A';
    END if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `submenu` (IN `padre_menu` INT, IN `usuario` VARCHAR(50) CHARSET utf8)  BEGIN
	IF usuario='Administrador' OR usuario='Desarrollador' THEN
    	SELECT m.idmenu, m.idpadre, m.nombre, m.ventana, m.es_menu, m.icono
        FROM sys_menu AS m;
    ELSE
    	SELECT m.idmenu, m.idpadre, m.nombre, m.ventana, m.es_menu, m.icono
        FROM sys_menu AS m
        WHERE m.idmenu IN (padre_menu)
        AND m.estado='A'
        ORDER BY m.orden;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateDocenteUsuario` (IN `paraIDDocente` INT, IN `paraEstado` CHAR(2), OUT `respuesta` VARCHAR(50))  BEGIN
	UPDATE sys_docente SET 
    estado=`paraEstado`,
    usuario_update="Desarrollador",
    fecha_update=now()
    WHERE idDocente=`paraIDDocente`;
    if row_count()>0 then
		set respuesta = "1,Éxito al actualizar";
	else
		set respuesta = "2,Error al actualizar";
	end if;
    select respuesta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateMenu` (IN `codMenu` INT, IN `paraIdMenu` INT, IN `paraNombremenu` VARCHAR(100) CHARSET utf8, IN `paraVentana` VARCHAR(100) charset utf8, IN `paraOrden` INT, IN `paraLibreria` TEXT, IN `paraEs_menu` CHAR(2) charset utf8, IN `paraEstado` CHAR(2) charset utf8, IN `paraListicons` VARCHAR(100) charset utf8, IN `paraUsuario` VARCHAR(50) charset utf8, OUT `respuesta` VARCHAR(100))  BEGIN
	declare total int default 0;
    
    select count(*) into total
    from sys_menu
    where idmenu=codMenu;
    
    if total > 0 then
		update sys_menu set 
        nombre=paraNombremenu,
        libreria=paraLibreria,
        orden=paraOrden,
        estado=paraEstado,
        idpadre=paraIdMenu,
        ventana=paraVentana,
        es_menu=paraEs_menu,
        icono=paraListicons,
        usuario_update=paraUsuario,
        fecha_update=now()
        where idmenu=codMenu;
        if row_count() > 0 then
			set respuesta = "1,Éxito al actualizar";
        else
			set respuesta = "2,Error al actualizar";
        end if;
	else
		INSERT INTO `sys_menu`(`nombre`, `libreria`, `orden`, `estado`, `idpadre`, `ventana`, `es_menu`, `icono`, `usuario_registro`, `fecha_registro`) 
					   VALUES (paraNombremenu,paraLibreria,paraOrden,paraEstado,paraIdMenu,paraVentana,paraEs_menu,paraListicons,paraUsuario,now());
		if row_count() > 0 then
			set respuesta = "1,Éxito al guardar";
		else
			set respuesta = "2,Error al guardar";
		end if;
	end if;
    select respuesta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateParalelos` (IN `paraIDParalelo` INT, IN `paraEstado` CHAR(2) CHARSET utf8, IN `paraUSuario` VARCHAR(50) CHARSET utf8, OUT `respuesta` VARCHAR(50) CHARSET utf8)  BEGIN
	UPDATE sys_paralelo SET 
    estado = `paraEstado`,
    usuario_update = `paraUsuario`,
    fecha_update=NOW()
    WHERE idParalelo = `paraIDParalelo`;
    IF row_count() > 0 THEN
		SET respuesta = "1,Éxito al actualizar";
	ELSE
		SET respuesta = "2,Érror al actualizar";
	END IF;
    SELECT respuesta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePeriodoAcademinco` (IN `paraIdPeriodo` INT, IN `paraNombre` VARCHAR(100) CHARSET utf8, IN `paraLectivo` CHAR(5) CHARSET utf8, IN `paraEstado` CHAR(2) CHARSET utf8, IN `paraUsuario` VARCHAR(50) CHARSET utf8, OUT `respuesta` VARCHAR(50) CHARSET utf8)  BEGIN
    	DECLARE total INT DEFAULT 0;
        declare existe int default 0;
		SELECT COUNT(*) INTO total
        FROM sys_ciclo_lectivo AS cl
        WHERE cl.idCicloAcad = `paraIdPeriodo`;
        IF total > 0 THEN
			UPDATE sys_ciclo_lectivo SET 
            nombre_lectivo=`paraNombre`,
            anio_lectivo=`paraLectivo`,
            estado=`paraEstado`,
            usuario_update=`paraUsuario`,
            fecha_update=NOW()
            WHERE idCicloAcad=`paraIdPeriodo`;
            IF row_count() > 0 THEN
				SET respuesta = "1,Éxito al actualizar";
			ELSE
				SET respuesta = "2,Error al actualizar";
			END IF;
		ELSE
			SELECT count(*) into existe 
            FROM sys_ciclo_lectivo
            WHERE anio_lectivo = `paraLectivo`;			
            IF existe > 0 THEN
				SET respuesta = "2,Lo siento ya existe el périodo academico.";
			ELSE
				INSERT INTO sys_ciclo_lectivo(nombre_lectivo, anio_lectivo, estado, usuario_registro, fecha_registro) 
				VALUES (`paraNombre`,`paraLectivo`,`paraEstado`,`paraUsuario`,NOW());
                if row_count() > 0 then
					SET respuesta = "1,Éxito al guardar";
				else
					set respuesta = "2,Error al guardar";
				end if;
			END IF;
        END IF;
        SELECT respuesta;
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `lista_ciclo_academico`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `lista_ciclo_academico` (
`idCicloAcad` int(11) unsigned zerofill
,`nombre_lectivo` varchar(100)
,`anio_lectivo` char(5)
,`estado` char(2)
,`fecha_registro` datetime
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `lista_docente`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `lista_docente` (
`id` int(10) unsigned zerofill
,`dni` char(10)
,`usuario` varchar(75)
,`pass` char(2)
,`estado` char(2)
,`nombres` varchar(100)
,`apellidos` varchar(100)
,`movil` char(10)
,`fijo` char(10)
,`direccion` text
,`mail` varchar(50)
,`registro` varchar(10)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `lista_menu`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `lista_menu` (
`idmenu` int(10) unsigned zerofill
,`nombre` varchar(80)
,`libreria` varchar(250)
,`orden` int(10) unsigned zerofill
,`estado` char(2)
,`idpadre` int(11) unsigned zerofill
,`ventana` varchar(50)
,`es_menu` char(3)
,`icono` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `lista_paralelo`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `lista_paralelo` (
`idParalelo` int(11) unsigned zerofill
,`paralelo` char(2)
,`estado` char(2)
,`registro` varchar(10)
);

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
(0000000002, 'Desarrollador', NULL, NULL, 'Desarrollador', '2020-01-29 10:45:49'),
(0000000003, 'Desarrollador', NULL, NULL, 'Desarrollador', '2020-02-02 14:50:04'),
(0000000004, 'Desarrollador', NULL, NULL, 'Desarrollador', '2020-02-02 14:50:04'),
(0000000005, 'Desarrolador', NULL, NULL, 'Desarrolador', '2020-02-02 18:29:56'),
(0000000006, 'Desarrollador', NULL, NULL, 'Desarrollador', '2020-02-10 11:34:01'),
(0000000007, 'Desarrollador', NULL, NULL, 'Desarrollador', '2020-02-10 11:34:01'),
(0000000008, 'Desarrollador', NULL, NULL, 'Desarrollador', '2020-02-10 11:34:01'),
(0000000009, 'Desarrollador', NULL, NULL, 'Desarrollador', '2020-02-10 11:34:01'),
(0000000010, 'Desarrollador', NULL, NULL, 'Desarrollador', '2020-02-10 11:34:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_ciclo_lectivo`
--

CREATE TABLE `sys_ciclo_lectivo` (
  `idCicloAcad` int(11) UNSIGNED ZEROFILL NOT NULL,
  `nombre_lectivo` varchar(100) NOT NULL,
  `anio_lectivo` char(5) DEFAULT NULL,
  `estado` char(2) NOT NULL,
  `usuario_update` varchar(50) DEFAULT NULL,
  `fecha_update` datetime DEFAULT NULL,
  `usuario_registro` varchar(50) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sys_ciclo_lectivo`
--

INSERT INTO `sys_ciclo_lectivo` (`idCicloAcad`, `nombre_lectivo`, `anio_lectivo`, `estado`, `usuario_update`, `fecha_update`, `usuario_registro`, `fecha_registro`) VALUES
(00000000001, 'Año Lectivo', '2020', 'A', 'Desarrollador', '2020-02-13 16:36:48', 'Desarrollador', '2020-02-11 14:45:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_docente`
--

CREATE TABLE `sys_docente` (
  `idDocente` int(10) UNSIGNED ZEROFILL NOT NULL,
  `estado` char(2) NOT NULL,
  `d_n_i` char(10) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `tlf_movil` char(10) NOT NULL,
  `tlf_fijo` char(10) NOT NULL,
  `direccion` text NOT NULL,
  `mail` varchar(50) NOT NULL,
  `usuario_update` varchar(50) DEFAULT NULL,
  `fecha_update` datetime DEFAULT NULL,
  `usuario_registro` varchar(50) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sys_docente`
--

INSERT INTO `sys_docente` (`idDocente`, `estado`, `d_n_i`, `nombres`, `apellidos`, `tlf_movil`, `tlf_fijo`, `direccion`, `mail`, `usuario_update`, `fecha_update`, `usuario_registro`, `fecha_registro`) VALUES
(0000000001, 'I', '0987654321', 'david fernando', 'Coello Suaréz', '0960776685', '', 'Coop.: Casas del tigre MZ:2208 Sl:20', 'david@mail.com', 'Desarrollador', '2020-02-16 12:06:53', 'Desarrollador', '2020-02-13 12:08:26'),
(0000000002, 'I', '0912345678', 'maria esther', 'inguillay valento', '0912873465', '', 'Coop. Nueva prosperian', 'mariachikita@mail.com', 'Desarrollador', '2020-02-15 16:48:45', 'Desarrollador', '2020-02-13 13:47:31');

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
(0000000001, 'Configuracion', '', 0000000003, 'A', 00000000001, '', 'S', 'fa-cog', NULL, NULL, 'Desarrollador', '2020-02-09 22:54:16'),
(0000000002, 'Menú', 'datatables', 0000000001, 'A', 00000000001, 'menu', 'N', 'fa fa-list', NULL, NULL, 'Desarrollador', '2020-02-09 22:55:00'),
(0000000003, 'Permiso', 'datatables,jquery,select', 0000000003, 'I', 00000000001, 'permiso', 'N', 'fa-cogs', 'Desarrollador', '2020-02-09 23:25:31', 'Desarrollador', '2020-02-10 11:30:46'),
(0000000004, 'Inicio', '', 0000000001, 'A', 00000000000, 'inicio', 'S', 'fa fa-home', 'Desarrollador', '2020-02-10 08:28:54', 'Desarrollador', '2020-02-10 08:45:00'),
(0000000007, 'Ciclo Escolar', 'datatables', 0000000001, 'A', 00000000009, 'ciscloescol', 'N', 'fa fa-flag', 'Desarrollador', '2020-02-10 11:09:08', 'Desarrollador', '2020-02-13 11:34:02'),
(0000000008, 'Paralelos', 'datatables', 0000000004, 'A', 00000000009, 'paralelos', 'N', 'fa-certificate', 'Desarrollador', '2020-02-11 15:55:17', 'Desarrollador', '2020-02-13 12:13:01'),
(0000000009, 'Gestión Escolar', '', 0000000006, 'A', 00000000000, '', 'S', 'fa-university', 'Desarrollador', '2020-02-12 14:03:10', 'Desarrollador', '2020-02-13 11:32:17'),
(0000000010, 'Docentes', 'datatables,imask', 0000000002, 'A', 00000000009, 'docentes', 'N', 'fa-users', 'Desarrollador', '2020-02-13 12:11:20', 'Desarrollador', '2020-02-13 12:13:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_paralelo`
--

CREATE TABLE `sys_paralelo` (
  `idParalelo` int(11) UNSIGNED ZEROFILL NOT NULL,
  `paralelo` char(2) DEFAULT NULL,
  `estado` char(2) NOT NULL,
  `usuario_update` varchar(50) DEFAULT NULL,
  `fecha_update` datetime DEFAULT NULL,
  `usuario_registro` varchar(50) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sys_paralelo`
--

INSERT INTO `sys_paralelo` (`idParalelo`, `paralelo`, `estado`, `usuario_update`, `fecha_update`, `usuario_registro`, `fecha_registro`) VALUES
(00000000001, 'A', 'A', 'Desarrollador', '2020-02-15 16:46:51', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000002, 'B', 'I', 'Desarrollador', '2020-02-13 16:37:02', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000003, 'C', 'I', 'Desarrollador', '2020-02-13 11:27:10', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000004, 'D', 'I', 'Desarrollador', '2020-02-13 11:27:09', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000005, 'E', 'I', 'Desarrollador', '2020-02-13 11:13:10', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000006, 'F', 'I', 'Desarrollador', '2020-02-13 10:40:38', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000007, 'G', 'I', 'Desarrollador', '2020-02-13 10:40:38', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000008, 'H', 'I', 'Desarrollador', '2020-02-13 10:40:38', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000009, 'I', 'I', 'Desarrollador', '2020-02-13 10:40:38', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000010, 'J', 'I', 'Desarrollador', '2020-02-13 10:40:38', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000011, 'K', 'I', 'Desarrollador', '2020-02-13 10:40:38', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000012, 'M', 'I', 'Desarrollador', '2020-02-13 10:40:38', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000013, 'N', 'I', 'Desarrollador', '2020-02-13 10:40:38', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000014, 'Ñ', 'I', 'Desarrollador', '2020-02-13 10:40:38', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000015, 'O', 'I', 'Desarrollador', '2020-02-13 10:40:38', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000016, 'P', 'I', 'Desarrollador', '2020-02-13 10:40:38', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000017, 'Q', 'I', 'Desarrollador', '2020-02-13 10:40:38', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000018, 'R', 'I', 'Desarrollador', '2020-02-13 10:40:38', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000019, 'S', 'I', 'Desarrollador', '2020-02-13 10:40:38', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000020, 'T', 'I', 'Desarrollador', '2020-02-13 10:40:38', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000021, 'U', 'I', 'Desarrollador', '2020-02-13 10:40:38', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000022, 'V', 'I', 'Desarrollador', '2020-02-13 10:40:38', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000023, 'W', 'I', 'Desarrollador', '2020-02-13 10:40:38', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000024, 'X', 'I', 'Desarrollador', '2020-02-13 10:40:38', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000025, 'Y', 'I', 'Desarrollador', '2020-02-13 10:40:38', 'Desarrollador', '2020-02-13 10:39:42'),
(00000000026, 'Z', 'I', 'Desarrollador', '2020-02-13 11:28:33', 'Desarrollador', '2020-02-13 10:39:42');

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
(0000000002, 'webversion', 'Sistema de versionamiento para los css y javascript.', '97', NULL, NULL, 'Desarrollador', '2020-01-24 10:17:39'),
(0000000003, 'nameEmpresa', 'Nombre de la empresa la cual opera el sistema, con nombres largos.', 'Unidad Educativa 9 de Octubre', NULL, NULL, 'Desarrollador', '2020-01-29 10:17:50'),
(0000000004, 'paginaDefault', 'Página de inicio por default del sistema.', 'inicio', NULL, NULL, 'Desarrollador', '2020-01-29 10:35:07'),
(0000000005, 'numMaxMenu', 'Número máxino de mmenús y submenus', '10', NULL, NULL, 'Desarrollador', '2020-02-04 13:20:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_usuario`
--

CREATE TABLE `sys_usuario` (
  `idUsario` int(10) UNSIGNED ZEROFILL NOT NULL,
  `id_docente` char(10) NOT NULL,
  `usuario` varchar(75) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `camb_pass` char(2) NOT NULL,
  `usua_update` varchar(45) DEFAULT NULL,
  `fecha_update` datetime DEFAULT NULL,
  `usuario_registro` varchar(45) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sys_usuario`
--

INSERT INTO `sys_usuario` (`idUsario`, `id_docente`, `usuario`, `contrasena`, `camb_pass`, `usua_update`, `fecha_update`, `usuario_registro`, `fecha_registro`) VALUES
(0000000001, '0987654321', 'dfcoello@ue90.com', '12345', 'S', '', NULL, 'Desarrollador', '2020-02-13 13:20:00'),
(0000000002, '0912345678', 'meinguillay@ue9o.com', '123456789', 'N', NULL, NULL, 'Desarrollador', '2020-02-13 13:48:29');

-- --------------------------------------------------------

--
-- Estructura para la vista `lista_ciclo_academico`
--
DROP TABLE IF EXISTS `lista_ciclo_academico`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lista_ciclo_academico`  AS  select `cl`.`idCicloAcad` AS `idCicloAcad`,`cl`.`nombre_lectivo` AS `nombre_lectivo`,`cl`.`anio_lectivo` AS `anio_lectivo`,`cl`.`estado` AS `estado`,`cl`.`fecha_registro` AS `fecha_registro` from `sys_ciclo_lectivo` `cl` order by `cl`.`anio_lectivo` desc ;

-- --------------------------------------------------------

--
-- Estructura para la vista `lista_docente`
--
DROP TABLE IF EXISTS `lista_docente`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lista_docente`  AS  select `dc`.`idDocente` AS `id`,`dc`.`d_n_i` AS `dni`,`us`.`usuario` AS `usuario`,`us`.`camb_pass` AS `pass`,`dc`.`estado` AS `estado`,`dc`.`nombres` AS `nombres`,`dc`.`apellidos` AS `apellidos`,`dc`.`tlf_movil` AS `movil`,`dc`.`tlf_fijo` AS `fijo`,`dc`.`direccion` AS `direccion`,`dc`.`mail` AS `mail`,date_format(`dc`.`fecha_registro`,'%d-%m%-%Y') AS `registro` from (`sys_docente` `dc` left join `sys_usuario` `us` on(`dc`.`d_n_i` = `us`.`id_docente`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `lista_menu`
--
DROP TABLE IF EXISTS `lista_menu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lista_menu`  AS  select `m`.`idmenu` AS `idmenu`,`m`.`nombre` AS `nombre`,`m`.`libreria` AS `libreria`,`m`.`orden` AS `orden`,`m`.`estado` AS `estado`,`m`.`idpadre` AS `idpadre`,`m`.`ventana` AS `ventana`,`m`.`es_menu` AS `es_menu`,`m`.`icono` AS `icono` from `sys_menu` `m` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `lista_paralelo`
--
DROP TABLE IF EXISTS `lista_paralelo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lista_paralelo`  AS  select `p`.`idParalelo` AS `idParalelo`,`p`.`paralelo` AS `paralelo`,`p`.`estado` AS `estado`,date_format(`p`.`fecha_registro`,'%d-%m-%Y') AS `registro` from `sys_paralelo` `p` ;

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
-- Indices de la tabla `sys_ciclo_lectivo`
--
ALTER TABLE `sys_ciclo_lectivo`
  ADD PRIMARY KEY (`idCicloAcad`);

--
-- Indices de la tabla `sys_docente`
--
ALTER TABLE `sys_docente`
  ADD PRIMARY KEY (`idDocente`),
  ADD UNIQUE KEY `d-n-i` (`d_n_i`);

--
-- Indices de la tabla `sys_menu`
--
ALTER TABLE `sys_menu`
  ADD PRIMARY KEY (`idmenu`);

--
-- Indices de la tabla `sys_paralelo`
--
ALTER TABLE `sys_paralelo`
  ADD PRIMARY KEY (`idParalelo`);

--
-- Indices de la tabla `sys_parametro`
--
ALTER TABLE `sys_parametro`
  ADD PRIMARY KEY (`id_parametro`);

--
-- Indices de la tabla `sys_usuario`
--
ALTER TABLE `sys_usuario`
  ADD PRIMARY KEY (`idUsario`),
  ADD KEY `fk_usuario_to_docente_idx` (`id_docente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sys_acceso`
--
ALTER TABLE `sys_acceso`
  MODIFY `idacceso` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `sys_ciclo_lectivo`
--
ALTER TABLE `sys_ciclo_lectivo`
  MODIFY `idCicloAcad` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sys_docente`
--
ALTER TABLE `sys_docente`
  MODIFY `idDocente` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sys_menu`
--
ALTER TABLE `sys_menu`
  MODIFY `idmenu` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `sys_paralelo`
--
ALTER TABLE `sys_paralelo`
  MODIFY `idParalelo` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `sys_parametro`
--
ALTER TABLE `sys_parametro`
  MODIFY `id_parametro` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sys_usuario`
--
ALTER TABLE `sys_usuario`
  MODIFY `idUsario` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `sys_usuario`
--
ALTER TABLE `sys_usuario`
  ADD CONSTRAINT `fk_usuario_to_docente` FOREIGN KEY (`id_docente`) REFERENCES `sys_docente` (`d_n_i`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
