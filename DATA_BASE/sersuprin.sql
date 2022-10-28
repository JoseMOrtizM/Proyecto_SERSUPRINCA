-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2022 a las 20:03:36
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sersuprin`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sspi_carrito_compras`
--

CREATE TABLE `sspi_carrito_compras` (
  `ID_CARRITO_COMPRA` int(11) NOT NULL,
  `ID_USUARIO` int(11) NOT NULL,
  `ID_PRODUCTO` int(11) NOT NULL,
  `CANTIDAD` int(11) DEFAULT NULL,
  `FECHA_AGREGADO` datetime DEFAULT NULL,
  `ESTATUS` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sspi_categorias`
--

CREATE TABLE `sspi_categorias` (
  `ID_CATEGORIA` int(11) NOT NULL,
  `NOMBRE_CATEGORIA` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sspi_categorias`
--

INSERT INTO `sspi_categorias` (`ID_CATEGORIA`, `NOMBRE_CATEGORIA`) VALUES
(1, 'CORREAS AUTOMOTRICES'),
(2, 'SISTEMAS DE SEGURIDAD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sspi_ganancias`
--

CREATE TABLE `sspi_ganancias` (
  `ID_GANANCIA` int(11) NOT NULL,
  `JURIDICO_NATURAL` varchar(300) DEFAULT NULL,
  `NIVEL_ACCESO` varchar(300) DEFAULT NULL,
  `PORCENTAJE_ADM` decimal(5,2) DEFAULT NULL,
  `PORCENTAJE_VEN_1` decimal(5,2) DEFAULT NULL,
  `PORCENTAJE_VEN_2` decimal(5,2) DEFAULT NULL,
  `COMISION_SUSCRIPCION_DOLAR` decimal(20,2) DEFAULT NULL,
  `RUBRO` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sspi_ganancias`
--

INSERT INTO `sspi_ganancias` (`ID_GANANCIA`, `JURIDICO_NATURAL`, `NIVEL_ACCESO`, `PORCENTAJE_ADM`, `PORCENTAJE_VEN_1`, `PORCENTAJE_VEN_2`, `COMISION_SUSCRIPCION_DOLAR`, `RUBRO`) VALUES
(1, 'JURÍDICO', 'ADMINISTRADOR', '20.00', '0.00', '0.00', '0.00', 'SEGURIDAD'),
(2, 'JURÍDICO', 'VENDEDOR_1', '10.00', '10.00', '0.00', '0.00', 'SEGURIDAD'),
(3, 'JURÍDICO', 'VENDEDOR_2', '5.00', '5.00', '10.00', '0.00', 'SEGURIDAD'),
(4, 'NATURAL', 'ADMINISTRADOR', '26.00', '0.00', '0.00', '0.00', 'SEGURIDAD'),
(5, 'NATURAL', 'VENDEDOR_1', '16.00', '15.00', '0.00', '0.00', 'SEGURIDAD'),
(6, 'NATURAL', 'VENDEDOR_2', '5.00', '6.00', '15.00', '0.00', 'SEGURIDAD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sspi_gastos`
--

CREATE TABLE `sspi_gastos` (
  `ID_GASTO` int(11) NOT NULL,
  `NOMBRE_GASTO` varchar(300) DEFAULT NULL,
  `FECHA_GASTO` datetime DEFAULT NULL,
  `DESCRIPCION_GASTO` text,
  `GASTO_DOL` decimal(20,2) DEFAULT NULL,
  `GASTO_BS` decimal(20,2) DEFAULT NULL,
  `GASTO_BS_X_DOLAR` decimal(20,2) DEFAULT NULL,
  `GASTO_DOL_EQ` decimal(20,2) DEFAULT NULL,
  `GASTO_BS_EQ` decimal(20,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sspi_mensajes`
--

CREATE TABLE `sspi_mensajes` (
  `ID_MENSAJE` int(11) NOT NULL,
  `NOMBRE_CLIENTE` varchar(300) DEFAULT NULL,
  `CORREO_CLIENTE` varchar(300) DEFAULT NULL,
  `TELEFONO_CLIENTE` varchar(300) DEFAULT NULL,
  `FECHA_MENSAJE` datetime DEFAULT NULL,
  `COMENTARIO` text,
  `FECHA_RESPUESTA` datetime DEFAULT NULL,
  `RESPUESTA` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sspi_metodos_de_pago`
--

CREATE TABLE `sspi_metodos_de_pago` (
  `ID_METODO_DE_PAGO` int(11) NOT NULL,
  `METODO_DE_PAGO` varchar(300) DEFAULT NULL,
  `BANCO` varchar(300) DEFAULT NULL,
  `TITULAR` varchar(300) DEFAULT NULL,
  `CEDULA_RIF` varchar(300) DEFAULT NULL,
  `TIPO_DE_CUENTA` varchar(300) DEFAULT NULL,
  `NUMERO_CUENTA` varchar(300) DEFAULT NULL,
  `TELEFONO` varchar(300) DEFAULT NULL,
  `CORREO` varchar(300) DEFAULT NULL,
  `COMENTARIO` varchar(300) DEFAULT NULL,
  `FOTO` varchar(300) DEFAULT NULL,
  `MONEDA` varchar(300) DEFAULT NULL,
  `METODO_ACTIVO` varchar(300) DEFAULT NULL,
  `LINK_DEL_BANCO` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sspi_metodos_de_pago`
--

INSERT INTO `sspi_metodos_de_pago` (`ID_METODO_DE_PAGO`, `METODO_DE_PAGO`, `BANCO`, `TITULAR`, `CEDULA_RIF`, `TIPO_DE_CUENTA`, `NUMERO_CUENTA`, `TELEFONO`, `CORREO`, `COMENTARIO`, `FOTO`, `MONEDA`, `METODO_ACTIVO`, `LINK_DEL_BANCO`) VALUES
(1, 'TRANSFERENCIA', 'BANCO ACTIVO', 'SERSUPRINCA', 'J-405273674', 'CORRIENTE', '1234987612348650', '0414-1234455', 'SERSUPRINCA@GMAIL.COM', 'Sólo depósitos y transferencias', 'banco_activo.png', 'Bolívares', 'NO', 'N/A'),
(2, 'TRANSFERENCIA', 'BANCO MERCANTIL', 'SERSUPRINCA', 'J-405273674', 'AHORRO', '1234234534564560', '0414-1234455', 'SERSUPRINCA@GMAIL.COM', 'Sólo depósitos y transferencias', 'banco_mercantil.png', 'Bolívares', 'SI', 'N/A'),
(3, 'TRANSFERENCIA', 'BANCO PROVINCIAL', 'SERSUPRINCA', 'J-405273674', 'CORRIENTE', '7654567887654560', '0414-1234455', 'SERSUPRINCA@GMAIL.COM', 'Sólo depósitos y transferencias', 'banco_provincial.png', 'Bolívares', 'SI', 'N/A'),
(4, 'TRANSFERENCIA', 'BANCO DE VENEZUELA', 'SERSUPRINCA', 'J-405273674', 'CORRIENTE', '3456987667890980', '0414-1234455', 'SERSUPRINCA@GMAIL.COM', 'Sólo depósitos y transferencias', 'banco_venezuela.png', 'Bolívares', 'SI', 'N/A'),
(5, 'PAGO MOVIL', 'BANCO MERCANTIL', 'SERSUPRINCA', 'J-405273674', 'CORRIENTE', '9878905345643450', '0414-1234455', 'SERSUPRINCA@GMAIL.COM', 'Sölo Pago Movil', 'banco_mercantil.png', 'Bolívares', 'SI', 'N/A'),
(6, 'PAGO MOVIL', 'BANCO DE VENEZUELA', 'SERSUPRINCA', 'J-405273674', 'CORRIENTE', '3465478987678990', '0414-1234455', 'SERSUPRINCA@GMAIL.COM', 'Sölo Pago Movil', 'J-405273674.png', 'Bolívares', 'SI', 'N/A'),
(7, 'TARJETA DE DÉBITO', 'BANCO MERCANTIL', '', '', '', '', '', '', 'Paga con tu tarjeta de débito Mercantil', 'banco_mercantil.png', 'Bolívares', 'SI', 'link_ejemplo.com'),
(8, 'TARJETA DE CRÉDITO', '', '', '', '', '', '', '', '', '', 'Bolívares', 'NO', 'NO DISPONIBLE'),
(9, 'ZELLER', 'XXXX', 'YYYY', 'ZZZZ', 'VVVV', 'BBBB', 'NNNN', 'MMMM', 'KKKK', '', 'Dólares', 'NO', 'N/A'),
(10, 'PAYPAL', 'XXXX', 'YYYY', 'ZZZZ', 'VVVV', 'BBBB', 'NNNN', 'MMMM', 'KKKK', '', 'Dólares', 'NO', 'N/A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sspi_pago_comisiones`
--

CREATE TABLE `sspi_pago_comisiones` (
  `ID_PAGO_COMISION` int(11) NOT NULL,
  `FECHA_PAGO` datetime DEFAULT NULL,
  `CEDULA_RIF_VENDEDOR` varchar(300) DEFAULT NULL,
  `PAGO_DOL` decimal(20,2) DEFAULT NULL,
  `PAGO_BS` decimal(20,2) DEFAULT NULL,
  `PAGO_BS_X_DOLAR` decimal(20,2) DEFAULT NULL,
  `PAGO_DOL_EQ` decimal(20,2) DEFAULT NULL,
  `PAGO_BS_EQ` decimal(20,2) DEFAULT NULL,
  `INF_PAGO` text,
  `OBSERVACIONES` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sspi_pago_comisiones`
--

INSERT INTO `sspi_pago_comisiones` (`ID_PAGO_COMISION`, `FECHA_PAGO`, `CEDULA_RIF_VENDEDOR`, `PAGO_DOL`, `PAGO_BS`, `PAGO_BS_X_DOLAR`, `PAGO_DOL_EQ`, `PAGO_BS_EQ`, `INF_PAGO`, `OBSERVACIONES`) VALUES
(1, '2021-10-12 07:10:56', '13813353', '500.00', '700.00', '4.09', '671.15', '2745.00', 'Tipo de pago: EFECTIVO / N° ref: 7955587855765757657676576755', 'todavia te debo x');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sspi_productos`
--

CREATE TABLE `sspi_productos` (
  `ID_PRODUCTO` int(11) NOT NULL,
  `TIPO_PRODUCTO_SERVICIO` varchar(300) DEFAULT NULL,
  `NOMBRE_PRODUCTO` varchar(300) DEFAULT NULL,
  `NOMBRE_CATEGORIA` varchar(300) DEFAULT NULL,
  `DESCRIPCION_CORTA` text,
  `DESCRIPCION_LARGA` text,
  `PRECIO_UNITARIO_DOLARES` decimal(20,2) DEFAULT NULL,
  `FOTO_1_CARRUSEL` varchar(300) DEFAULT NULL,
  `FOTO_2_CORTA` varchar(300) DEFAULT NULL,
  `FOTO_3_LARGA` varchar(300) DEFAULT NULL,
  `UNIDAD_DE_VENTA` varchar(300) DEFAULT NULL,
  `CANTIDAD_DISPONIBLE` int(11) DEFAULT NULL,
  `DESTACADO` varchar(300) DEFAULT NULL,
  `CODIGO` varchar(300) DEFAULT NULL,
  `MARCA` varchar(300) DEFAULT NULL,
  `RUBRO` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sspi_productos`
--

INSERT INTO `sspi_productos` (`ID_PRODUCTO`, `TIPO_PRODUCTO_SERVICIO`, `NOMBRE_PRODUCTO`, `NOMBRE_CATEGORIA`, `DESCRIPCION_CORTA`, `DESCRIPCION_LARGA`, `PRECIO_UNITARIO_DOLARES`, `FOTO_1_CARRUSEL`, `FOTO_2_CORTA`, `FOTO_3_LARGA`, `UNIDAD_DE_VENTA`, `CANTIDAD_DISPONIBLE`, `DESTACADO`, `CODIGO`, `MARCA`, `RUBRO`) VALUES
(1, 'SERVICIO', 'Seguridad Industrial', 'SERVICIOS', 'Asesoría técnica y suministro de equipos de protección industrial, elaboración de procedimientos, y planes específicos, diseño y estructuración del departamento SIAHO y estudios ergonómicos.', '<h4>SERVICIOS DISPONIBLES:</h4><p>Aquí se pueden enumerar los servicios que se puedan prestar en este campo.</p><h4>EXPERIENCIA PREVIA:</h4><p>Comentar los trabajos realizados previamente.</p><h4>EQUIPOS DISPONIBLES:</h4><p>Comentar sobre los equipos y el capital humano con el que cuenta para realizar ete tipo de servicios.</p>', '0.00', 'Carrusel_Seguridad_Industrial.png', 'F_Corta_Seguridad_Industrial.png', 'F_Larga_Seguridad_Industrial.png', 'N/A', 0, 'SI', 'SERVICIOS', 'SERVICIOS', 'SERVICIOS'),
(2, 'SERVICIO', 'Protección Contra Incendios', 'SERVICIOS', 'Suministro de equipos especiales para el combate de incendios, recarga de extintores, equipos de protección personal, equipos de detección y alarma de incendios.', '<h4>SERVICIOS DISPONIBLES:</h4><p>Aquí se pueden enumerar los servicios que se puedan prestar en este campo.</p><h4>EXPERIENCIA PREVIA:</h4><p>Comentar los trabajos realizados previamente.</p><h4>EQUIPOS DISPONIBLES:</h4><p>Comentar sobre los equipos y el capital humano con el que cuenta para realizar ete tipo de servicios.</p>', '0.00', 'Carrusel_Proteccion_Contra_Incendios.png', 'F_Corta_Proteccion_Contra_Incendios.png', 'F_Larga_Proteccion_Contra_Incendios.png', 'N/A', 0, 'SI', 'SERVICIOS', 'SERVICIOS', 'SERVICIOS'),
(3, 'SERVICIO', 'Seguridad Física', 'SERVICIOS', 'Instalación y mantenimiento de sistemas integrales de protección física, Circuito cerrado de televisión, sensores de movimiento, cercos eléctricos, control de acceso automatizado, puertas automáticas, molinetes.', '<h4>SERVICIOS DISPONIBLES:</h4><p>Aquí se pueden enumerar los servicios que se puedan prestar en este campo.</p><h4>EXPERIENCIA PREVIA:</h4><p>Comentar los trabajos realizados previamente.</p><h4>EQUIPOS DISPONIBLES:</h4><p>Comentar sobre los equipos y el capital humano con el que cuenta para realizar ete tipo de servicios.</p>', '0.00', 'Carrusel_Seguridad_Fisica.png', 'F_Corta_Seguridad_Fisica.png', 'F_Larga_Seguridad_Fisica.png', 'N/A', 0, 'SI', 'SERVICIOS', 'SERVICIOS', 'SERVICIOS'),
(4, 'SERVICIO', 'Refrigeración', 'SERVICIOS', 'Instalación y mantenimiento de equipos de refrigeración en general.', '<h4>SERVICIOS DISPONIBLES:</h4><p>Aquí se pueden enumerar los servicios que se puedan prestar en este campo.</p><h4>EXPERIENCIA PREVIA:</h4><p>Comentar los trabajos realizados previamente.</p><h4>EQUIPOS DISPONIBLES:</h4><p>Comentar sobre los equipos y el capital humano con el que cuenta para realizar ete tipo de servicios.</p>', '0.00', 'Carrusel_Refrigeracion.png', 'F_Corta_Refrigeracion.png', 'F_Larga_Refrigeracion.png', 'N/A', 0, 'SI', 'SERVICIOS', 'SERVICIOS', 'SERVICIOS'),
(5, 'SERVICIO', 'Sistemas Eléctricos', 'SERVICIOS', 'Diseño, instalación y manteniiento de sistemas eléctricos en general.', '<h4>SERVICIOS DISPONIBLES:</h4><p>Aquí se pueden enumerar los servicios que se puedan prestar en este campo.</p><h4>EXPERIENCIA PREVIA:</h4><p>Comentar los trabajos realizados previamente.</p><h4>EQUIPOS DISPONIBLES:</h4><p>Comentar sobre los equipos y el capital humano con el que cuenta para realizar ete tipo de servicios.</p>', '0.00', 'Carrusel_Sistemas_Electricos.png', 'F_Corta_Sistemas_Electricos.png', 'F_Larga_Sistemas_Electricos.png', 'N/A', 0, 'SI', 'SERVICIOS', 'SERVICIOS', 'SERVICIOS'),
(6, 'SERVICIO', 'Asesoría Técnica y Capacitación', 'SERVICIOS', 'Servicios de asesoría técnica en todos los servicios prestados, adiestramiento y capacitación en materia SIAHO.', '<h4>SERVICIOS D<span style="background-color: inherit;">ISPON</span>IBLES:</h4><p>Aquí se pueden enumerar los servicios que se puedan prestar en este campo.</p><h4>EXPERIENCIA PREVIA:</h4><p>Comentar los trabajos realizados previamente.</p><h4>EQUIPOS DISPONIBLES:</h4><p>Comentar sobre los equipos y el capital humano con el que cuenta para realizar este tipo de servicios.</p>', '30.00', 'Carrusel_Asesoria_Tecnica_y_Capacitacion.png', 'F_Corta_Asesoria_Tecnica_y_Capacitacion.png', 'F_Larga_Asesoria_Tecnica_y_Capacitacion.png', 'PARTICIPANTE', 20, 'SI', 'SERVICIOS', 'SERVICIOS', 'SERVICIOS'),
(7, 'SERVICIO', 'Suministros', 'SERVICIOS', 'Suministro de insumos y equipamiento en general para la industria.', '<h4>SECTOR AUTOMOTRIZ:</h4><p>comentar en lineas más específicas lo que ofrece la empresa en este campo… y así el resto de los campos.</p>', '0.00', 'Carrusel_Suministros.png', 'F_Corta_Suministros.png', 'F_Larga_Suministros.png', 'N/A', 0, 'SI', 'SERVICIOS', 'SERVICIOS', 'SERVICIOS'),
(8, 'PRODUCTO', 'RPF2215', 'CORREAS AUTOMOTRICES', 'RPF2215 (21,5 Pulgadas)', 'RPF2215 (21,5 Pulgadas)', '3.22', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2215', 'BANDO', 'CORREAS'),
(9, 'PRODUCTO', 'RPF2220', 'CORREAS AUTOMOTRICES', 'RPF2220 (22 Pulgadas)', 'RPF2220 (22 Pulgadas)', '3.28', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2220', 'BANDO', 'CORREAS'),
(10, 'PRODUCTO', 'RPF2225', 'CORREAS AUTOMOTRICES', 'RPF2225 (22,5 Pulgadas)', 'RPF2225 (22,5 Pulgadas)', '3.38', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2225', 'BANDO', 'CORREAS'),
(11, 'PRODUCTO', 'RPF2230', 'CORREAS AUTOMOTRICES', 'RPF2230 (23 Pulgadas)', 'RPF2230 (23 Pulgadas)', '3.44', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2230', 'BANDO', 'CORREAS'),
(12, 'PRODUCTO', 'RPF2235', 'CORREAS AUTOMOTRICES', 'RPF2235 (23,5 Pulgadas)', 'RPF2235 (23,5 Pulgadas)', '3.53', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2235', 'BANDO', 'CORREAS'),
(13, 'PRODUCTO', 'RPF2240', 'CORREAS AUTOMOTRICES', 'RPF2240 (24 Pulgadas)', 'RPF2240 (24 Pulgadas)', '3.59', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2240', 'BANDO', 'CORREAS'),
(14, 'PRODUCTO', 'RPF2245', 'CORREAS AUTOMOTRICES', 'RPF2245 (24,5 Pulgadas)', 'RPF2245 (24,5 Pulgadas)', '3.69', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2245', 'BANDO', 'CORREAS'),
(15, 'PRODUCTO', 'RPF2250', 'CORREAS AUTOMOTRICES', 'RPF2250 (25 Pulgadas)', 'RPF2250 (25 Pulgadas)', '3.75', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2250', 'BANDO', 'CORREAS'),
(16, 'PRODUCTO', 'RPF2255', 'CORREAS AUTOMOTRICES', 'RPF2255 (25,5 Pulgadas)', 'RPF2255 (25,5 Pulgadas)', '3.81', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2255', 'BANDO', 'CORREAS'),
(17, 'PRODUCTO', 'RPF2260', 'CORREAS AUTOMOTRICES', 'RPF2260 (26 Pulgadas)', 'RPF2260 (26 Pulgadas)', '3.91', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2260', 'BANDO', 'CORREAS'),
(18, 'PRODUCTO', 'RPF2265', 'CORREAS AUTOMOTRICES', 'RPF2265 (26,5 Pulgadas)', 'RPF2265 (26,5 Pulgadas)', '3.97', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2265', 'BANDO', 'CORREAS'),
(19, 'PRODUCTO', 'RPF2270', 'CORREAS AUTOMOTRICES', 'RPF2270 (27 Pulgadas)', 'RPF2270 (27 Pulgadas)', '4.06', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2270', 'BANDO', 'CORREAS'),
(20, 'PRODUCTO', 'RPF2275', 'CORREAS AUTOMOTRICES', 'RPF2275 (27,5 Pulgadas)', 'RPF2275 (27,5 Pulgadas)', '4.12', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2275', 'BANDO', 'CORREAS'),
(21, 'PRODUCTO', 'RPF2280', 'CORREAS AUTOMOTRICES', 'RPF2280 (28 Pulgadas)', 'RPF2280 (28 Pulgadas)', '4.19', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2280', 'BANDO', 'CORREAS'),
(22, 'PRODUCTO', 'RPF2285', 'CORREAS AUTOMOTRICES', 'RPF2285 (28,5 Pulgadas)', 'RPF2285 (28,5 Pulgadas)', '4.28', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2285', 'BANDO', 'CORREAS'),
(23, 'PRODUCTO', 'RPF2290', 'CORREAS AUTOMOTRICES', 'RPF2290 (29 Pulgadas)', 'RPF2290 (29 Pulgadas)', '4.34', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2290', 'BANDO', 'CORREAS'),
(24, 'PRODUCTO', 'RPF2295', 'CORREAS AUTOMOTRICES', 'RPF2295 (29,5 Pulgadas)', 'RPF2295 (29,5 Pulgadas)', '4.44', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2295', 'BANDO', 'CORREAS'),
(25, 'PRODUCTO', 'RPF2300', 'CORREAS AUTOMOTRICES', 'RPF2300 (30 Pulgadas)', 'RPF2300 (30 Pulgadas)', '4.50', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2300', 'BANDO', 'CORREAS'),
(26, 'PRODUCTO', 'RPF2305', 'CORREAS AUTOMOTRICES', 'RPF2305 (30,5 Pulgadas)', 'RPF2305 (30,5 Pulgadas)', '4.56', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2305', 'BANDO', 'CORREAS'),
(27, 'PRODUCTO', 'RPF2310', 'CORREAS AUTOMOTRICES', 'RPF2310 (31 Pulgadas)', 'RPF2310 (31 Pulgadas)', '4.66', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2310', 'BANDO', 'CORREAS'),
(28, 'PRODUCTO', 'RPF2315', 'CORREAS AUTOMOTRICES', 'RPF2315 (31,5 Pulgadas)', 'RPF2315 (31,5 Pulgadas)', '4.72', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2315', 'BANDO', 'CORREAS'),
(29, 'PRODUCTO', 'RPF2320', 'CORREAS AUTOMOTRICES', 'RPF2320 (32 Pulgadas)', 'RPF2320 (32 Pulgadas)', '4.81', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2320', 'BANDO', 'CORREAS'),
(30, 'PRODUCTO', 'RPF2325', 'CORREAS AUTOMOTRICES', 'RPF2325 (32,5 Pulgadas)', 'RPF2325 (32,5 Pulgadas)', '4.87', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2325', 'BANDO', 'CORREAS'),
(31, 'PRODUCTO', 'RPF2330', 'CORREAS AUTOMOTRICES', 'RPF2330 (33 Pulgadas)', 'RPF2330 (33 Pulgadas)', '4.94', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2330', 'BANDO', 'CORREAS'),
(32, 'PRODUCTO', 'RPF2335', 'CORREAS AUTOMOTRICES', 'RPF2335 (33,5 Pulgadas)', 'RPF2335 (33,5 Pulgadas)', '5.03', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2335', 'BANDO', 'CORREAS'),
(33, 'PRODUCTO', 'RPF2340', 'CORREAS AUTOMOTRICES', 'RPF2340 (34 Pulgadas)', 'RPF2340 (34 Pulgadas)', '5.09', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2340', 'BANDO', 'CORREAS'),
(34, 'PRODUCTO', 'RPF2345', 'CORREAS AUTOMOTRICES', 'RPF2345 (34,5 Pulgadas)', 'RPF2345 (34,5 Pulgadas)', '5.19', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2345', 'BANDO', 'CORREAS'),
(35, 'PRODUCTO', 'RPF2350', 'CORREAS AUTOMOTRICES', 'RPF2350 (35 Pulgadas)', 'RPF2350 (35 Pulgadas)', '5.25', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2350', 'BANDO', 'CORREAS'),
(36, 'PRODUCTO', 'RPF2355', 'CORREAS AUTOMOTRICES', 'RPF2355 (35,5 Pulgadas)', 'RPF2355 (35,5 Pulgadas)', '5.31', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2355', 'BANDO', 'CORREAS'),
(37, 'PRODUCTO', 'RPF2360', 'CORREAS AUTOMOTRICES', 'RPF2360 (36 Pulgadas)', 'RPF2360 (36 Pulgadas)', '5.40', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2360', 'BANDO', 'CORREAS'),
(38, 'PRODUCTO', 'RPF2365', 'CORREAS AUTOMOTRICES', 'RPF2365 (36,5 Pulgadas)', 'RPF2365 (36,5 Pulgadas)', '5.47', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2365', 'BANDO', 'CORREAS'),
(39, 'PRODUCTO', 'RPF2370', 'CORREAS AUTOMOTRICES', 'RPF2370 (37 Pulgadas)', 'RPF2370 (37 Pulgadas)', '5.56', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2370', 'BANDO', 'CORREAS'),
(40, 'PRODUCTO', 'RPF2375', 'CORREAS AUTOMOTRICES', 'RPF2375 (37,5 Pulgadas)', 'RPF2375 (37,5 Pulgadas)', '5.62', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2375', 'BANDO', 'CORREAS'),
(41, 'PRODUCTO', 'RPF2380', 'CORREAS AUTOMOTRICES', 'RPF2380 (38 Pulgadas)', 'RPF2380 (38 Pulgadas)', '5.69', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2380', 'BANDO', 'CORREAS'),
(42, 'PRODUCTO', 'RPF2385', 'CORREAS AUTOMOTRICES', 'RPF2385 (38,5 Pulgadas)', 'RPF2385 (38,5 Pulgadas)', '5.78', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2385', 'BANDO', 'CORREAS'),
(43, 'PRODUCTO', 'RPF2390', 'CORREAS AUTOMOTRICES', 'RPF2390 (39 Pulgadas)', 'RPF2390 (39 Pulgadas)', '5.84', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2390', 'BANDO', 'CORREAS'),
(44, 'PRODUCTO', 'RPF2395', 'CORREAS AUTOMOTRICES', 'RPF2395 (39,5 Pulgadas)', 'RPF2395 (39,5 Pulgadas)', '5.93', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2395', 'BANDO', 'CORREAS'),
(45, 'PRODUCTO', 'RPF2400', 'CORREAS AUTOMOTRICES', 'RPF2400 (40 Pulgadas)', 'RPF2400 (40 Pulgadas)', '6.00', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2400', 'BANDO', 'CORREAS'),
(46, 'PRODUCTO', 'RPF2405', 'CORREAS AUTOMOTRICES', 'RPF2405 (40,5 Pulgadas)', 'RPF2405 (40,5 Pulgadas)', '6.06', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2405', 'BANDO', 'CORREAS'),
(47, 'PRODUCTO', 'RPF2410', 'CORREAS AUTOMOTRICES', 'RPF2410 (41 Pulgadas)', 'RPF2410 (41 Pulgadas)', '6.15', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2410', 'BANDO', 'CORREAS'),
(48, 'PRODUCTO', 'RPF2415', 'CORREAS AUTOMOTRICES', 'RPF2415 (41,5 Pulgadas)', 'RPF2415 (41,5 Pulgadas)', '6.22', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2415', 'BANDO', 'CORREAS'),
(49, 'PRODUCTO', 'RPF2420', 'CORREAS AUTOMOTRICES', 'RPF2420 (42 Pulgadas)', 'RPF2420 (42 Pulgadas)', '6.31', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2420', 'BANDO', 'CORREAS'),
(50, 'PRODUCTO', 'RPF2425', 'CORREAS AUTOMOTRICES', 'RPF2425 (42,5 Pulgadas)', 'RPF2425 (42,5 Pulgadas)', '6.37', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2425', 'BANDO', 'CORREAS'),
(51, 'PRODUCTO', 'RPF2430', 'CORREAS AUTOMOTRICES', 'RPF2430 (43 Pulgadas)', 'RPF2430 (43 Pulgadas)', '6.43', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2430', 'BANDO', 'CORREAS'),
(52, 'PRODUCTO', 'RPF2435', 'CORREAS AUTOMOTRICES', 'RPF2435 (43,5 Pulgadas)', 'RPF2435 (43,5 Pulgadas)', '6.53', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2435', 'BANDO', 'CORREAS'),
(53, 'PRODUCTO', 'RPF2440', 'CORREAS AUTOMOTRICES', 'RPF2440 (44 Pulgadas)', 'RPF2440 (44 Pulgadas)', '6.59', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2440', 'BANDO', 'CORREAS'),
(54, 'PRODUCTO', 'RPF2445', 'CORREAS AUTOMOTRICES', 'RPF2445 (44,5 Pulgadas)', 'RPF2445 (44,5 Pulgadas)', '6.65', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2445', 'BANDO', 'CORREAS'),
(55, 'PRODUCTO', 'RPF2450', 'CORREAS AUTOMOTRICES', 'RPF2450 (45 Pulgadas)', 'RPF2450 (45 Pulgadas)', '6.75', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2450', 'BANDO', 'CORREAS'),
(56, 'PRODUCTO', 'RPF2455', 'CORREAS AUTOMOTRICES', 'RPF2455 (45,5 Pulgadas)', 'RPF2455 (45,5 Pulgadas)', '6.81', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2455', 'BANDO', 'CORREAS'),
(57, 'PRODUCTO', 'RPF2460', 'CORREAS AUTOMOTRICES', 'RPF2460 (46 Pulgadas)', 'RPF2460 (46 Pulgadas)', '6.90', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2460', 'BANDO', 'CORREAS'),
(58, 'PRODUCTO', 'RPF2465', 'CORREAS AUTOMOTRICES', 'RPF2465 (46,5 Pulgadas)', 'RPF2465 (46,5 Pulgadas)', '6.96', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2465', 'BANDO', 'CORREAS'),
(59, 'PRODUCTO', 'RPF2470', 'CORREAS AUTOMOTRICES', 'RPF2470 (47 Pulgadas)', 'RPF2470 (47 Pulgadas)', '7.03', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2470', 'BANDO', 'CORREAS'),
(60, 'PRODUCTO', 'RPF2475', 'CORREAS AUTOMOTRICES', 'RPF2475 (47,5 Pulgadas)', 'RPF2475 (47,5 Pulgadas)', '7.12', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2475', 'BANDO', 'CORREAS'),
(61, 'PRODUCTO', 'RPF2480', 'CORREAS AUTOMOTRICES', 'RPF2480 (48 Pulgadas)', 'RPF2480 (48 Pulgadas)', '7.18', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2480', 'BANDO', 'CORREAS'),
(62, 'PRODUCTO', 'RPF2485', 'CORREAS AUTOMOTRICES', 'RPF2485 (48,5 Pulgadas)', 'RPF2485 (48,5 Pulgadas)', '7.28', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2485', 'BANDO', 'CORREAS'),
(63, 'PRODUCTO', 'RPF2490', 'CORREAS AUTOMOTRICES', 'RPF2490 (49 Pulgadas)', 'RPF2490 (49 Pulgadas)', '7.34', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2490', 'BANDO', 'CORREAS'),
(64, 'PRODUCTO', 'RPF2495', 'CORREAS AUTOMOTRICES', 'RPF2495 (49,5 Pulgadas)', 'RPF2495 (49,5 Pulgadas)', '7.43', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2495', 'BANDO', 'CORREAS'),
(65, 'PRODUCTO', 'RPF2500', 'CORREAS AUTOMOTRICES', 'RPF2500 (50 Pulgadas)', 'RPF2500 (50 Pulgadas)', '7.50', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2500', 'BANDO', 'CORREAS'),
(66, 'PRODUCTO', 'RPF2505', 'CORREAS AUTOMOTRICES', 'RPF2505 (50,5 Pulgadas)', 'RPF2505 (50,5 Pulgadas)', '7.56', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2505', 'BANDO', 'CORREAS'),
(67, 'PRODUCTO', 'RPF2510', 'CORREAS AUTOMOTRICES', 'RPF2510 (51 Pulgadas)', 'RPF2510 (51 Pulgadas)', '7.65', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2510', 'BANDO', 'CORREAS'),
(68, 'PRODUCTO', 'RPF2515', 'CORREAS AUTOMOTRICES', 'RPF2515 (51,5 Pulgadas)', 'RPF2515 (51,5 Pulgadas)', '7.71', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2515', 'BANDO', 'CORREAS'),
(69, 'PRODUCTO', 'RPF2520', 'CORREAS AUTOMOTRICES', 'RPF2520 (52 Pulgadas)', 'RPF2520 (52 Pulgadas)', '7.81', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2520', 'BANDO', 'CORREAS'),
(70, 'PRODUCTO', 'RPF2525', 'CORREAS AUTOMOTRICES', 'RPF2525 (52,5 Pulgadas)', 'RPF2525 (52,5 Pulgadas)', '7.87', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2525', 'BANDO', 'CORREAS'),
(71, 'PRODUCTO', 'RPF2530', 'CORREAS AUTOMOTRICES', 'RPF2530 (53 Pulgadas)', 'RPF2530 (53 Pulgadas)', '7.93', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2530', 'BANDO', 'CORREAS'),
(72, 'PRODUCTO', 'RPF2535', 'CORREAS AUTOMOTRICES', 'RPF2535 (53,5 Pulgadas)', 'RPF2535 (53,5 Pulgadas)', '8.03', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2535', 'BANDO', 'CORREAS'),
(73, 'PRODUCTO', 'RPF2540', 'CORREAS AUTOMOTRICES', 'RPF2540 (54 Pulgadas)', 'RPF2540 (54 Pulgadas)', '8.09', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2540', 'BANDO', 'CORREAS'),
(74, 'PRODUCTO', 'RPF2545', 'CORREAS AUTOMOTRICES', 'RPF2545 (54,5 Pulgadas)', 'RPF2545 (54,5 Pulgadas)', '8.18', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2545', 'BANDO', 'CORREAS'),
(75, 'PRODUCTO', 'RPF2550', 'CORREAS AUTOMOTRICES', 'RPF2550 (55 Pulgadas)', 'RPF2550 (55 Pulgadas)', '8.24', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2550', 'BANDO', 'CORREAS'),
(76, 'PRODUCTO', 'RPF2555', 'CORREAS AUTOMOTRICES', 'RPF2555 (55,5 Pulgadas)', 'RPF2555 (55,5 Pulgadas)', '8.31', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2555', 'BANDO', 'CORREAS'),
(77, 'PRODUCTO', 'RPF2560', 'CORREAS AUTOMOTRICES', 'RPF2560 (56 Pulgadas)', 'RPF2560 (56 Pulgadas)', '8.40', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2560', 'BANDO', 'CORREAS'),
(78, 'PRODUCTO', 'RPF2565', 'CORREAS AUTOMOTRICES', 'RPF2565 (56,5 Pulgadas)', 'RPF2565 (56,5 Pulgadas)', '8.46', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2565', 'BANDO', 'CORREAS'),
(79, 'PRODUCTO', 'RPF2570', 'CORREAS AUTOMOTRICES', 'RPF2570 (57 Pulgadas)', 'RPF2570 (57 Pulgadas)', '8.56', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2570', 'BANDO', 'CORREAS'),
(80, 'PRODUCTO', 'RPF2575', 'CORREAS AUTOMOTRICES', 'RPF2575 (57,5 Pulgadas)', 'RPF2575 (57,5 Pulgadas)', '8.62', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2575', 'BANDO', 'CORREAS'),
(81, 'PRODUCTO', 'RPF2580', 'CORREAS AUTOMOTRICES', 'RPF2580 (58 Pulgadas)', 'RPF2580 (58 Pulgadas)', '8.68', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2580', 'BANDO', 'CORREAS'),
(82, 'PRODUCTO', 'RPF2585', 'CORREAS AUTOMOTRICES', 'RPF2585 (58,5 Pulgadas)', 'RPF2585 (58,5 Pulgadas)', '8.77', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2585', 'BANDO', 'CORREAS'),
(83, 'PRODUCTO', 'RPF2590', 'CORREAS AUTOMOTRICES', 'RPF2590 (59 Pulgadas)', 'RPF2590 (59 Pulgadas)', '8.84', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2590', 'BANDO', 'CORREAS'),
(84, 'PRODUCTO', 'RPF2595', 'CORREAS AUTOMOTRICES', 'RPF2595 (59,5 Pulgadas)', 'RPF2595 (59,5 Pulgadas)', '8.93', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2595', 'BANDO', 'CORREAS'),
(85, 'PRODUCTO', 'RPF2600', 'CORREAS AUTOMOTRICES', 'RPF2600 (60 Pulgadas)', 'RPF2600 (60 Pulgadas)', '8.99', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2600', 'BANDO', 'CORREAS'),
(86, 'PRODUCTO', 'RPF2605', 'CORREAS AUTOMOTRICES', 'RPF2605 (60,5 Pulgadas)', 'RPF2605 (60,5 Pulgadas)', '9.06', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2605', 'BANDO', 'CORREAS'),
(87, 'PRODUCTO', 'RPF2610', 'CORREAS AUTOMOTRICES', 'RPF2610 (61 Pulgadas)', 'RPF2610 (61 Pulgadas)', '9.15', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2610', 'BANDO', 'CORREAS'),
(88, 'PRODUCTO', 'RPF2615', 'CORREAS AUTOMOTRICES', 'RPF2615 (61,5 Pulgadas)', 'RPF2615 (61,5 Pulgadas)', '9.21', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2615', 'BANDO', 'CORREAS'),
(89, 'PRODUCTO', 'RPF2620', 'CORREAS AUTOMOTRICES', 'RPF2620 (62 Pulgadas)', 'RPF2620 (62 Pulgadas)', '9.31', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2620', 'BANDO', 'CORREAS'),
(90, 'PRODUCTO', 'RPF2630', 'CORREAS AUTOMOTRICES', 'RPF2630 (63 Pulgadas)', 'RPF2630 (63 Pulgadas)', '9.43', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2630', 'BANDO', 'CORREAS'),
(91, 'PRODUCTO', 'RPF2640', 'CORREAS AUTOMOTRICES', 'RPF2640 (64 Pulgadas)', 'RPF2640 (64 Pulgadas)', '9.59', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2640', 'BANDO', 'CORREAS'),
(92, 'PRODUCTO', 'RPF2645', 'CORREAS AUTOMOTRICES', 'RPF2645 (64,5 Pulgadas)', 'RPF2645 (64,5 Pulgadas)', '9.68', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2645', 'BANDO', 'CORREAS'),
(93, 'PRODUCTO', 'RPF2650', 'CORREAS AUTOMOTRICES', 'RPF2650 (65 Pulgadas)', 'RPF2650 (65 Pulgadas)', '9.74', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2650', 'BANDO', 'CORREAS'),
(94, 'PRODUCTO', 'RPF2660', 'CORREAS AUTOMOTRICES', 'RPF2660 (66 Pulgadas)', 'RPF2660 (66 Pulgadas)', '9.90', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2660', 'BANDO', 'CORREAS'),
(95, 'PRODUCTO', 'RPF2670', 'CORREAS AUTOMOTRICES', 'RPF2670 (67 Pulgadas)', 'RPF2670 (67 Pulgadas)', '10.02', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2670', 'BANDO', 'CORREAS'),
(96, 'PRODUCTO', 'RPF2680', 'CORREAS AUTOMOTRICES', 'RPF2680 (68 Pulgadas)', 'RPF2680 (68 Pulgadas)', '10.18', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF2680', 'BANDO', 'CORREAS'),
(97, 'PRODUCTO', 'RPF2690', 'CORREAS AUTOMOTRICES', 'RPF2690 (69 Pulgadas)', 'RPF2690 (69 Pulgadas)', '10.34', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF2690', 'BANDO', 'CORREAS'),
(98, 'PRODUCTO', 'RPF2700', 'CORREAS AUTOMOTRICES', 'RPF2700 (70 Pulgadas)', 'RPF2700 (70 Pulgadas)', '10.49', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF2700', 'BANDO', 'CORREAS'),
(99, 'PRODUCTO', 'RPF3210', 'CORREAS AUTOMOTRICES', 'RPF3210 (21 Pulgadas)', 'RPF3210 (21 Pulgadas)', '3.91', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3210', 'BANDO', 'CORREAS'),
(100, 'PRODUCTO', 'RPF3215', 'CORREAS AUTOMOTRICES', 'RPF3215 (21,5 Pulgadas)', 'RPF3215 (21,5 Pulgadas)', '4.00', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3215', 'BANDO', 'CORREAS'),
(101, 'PRODUCTO', 'RPF3220', 'CORREAS AUTOMOTRICES', 'RPF3220 (22 Pulgadas)', 'RPF3220 (22 Pulgadas)', '4.09', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3220', 'BANDO', 'CORREAS'),
(102, 'PRODUCTO', 'RPF3225', 'CORREAS AUTOMOTRICES', 'RPF3225 (22,5 Pulgadas)', 'RPF3225 (22,5 Pulgadas)', '4.19', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3225', 'BANDO', 'CORREAS'),
(103, 'PRODUCTO', 'RPF3230', 'CORREAS AUTOMOTRICES', 'RPF3230 (23 Pulgadas)', 'RPF3230 (23 Pulgadas)', '4.28', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3230', 'BANDO', 'CORREAS'),
(104, 'PRODUCTO', 'RPF3235', 'CORREAS AUTOMOTRICES', 'RPF3235 (23,5 Pulgadas)', 'RPF3235 (23,5 Pulgadas)', '4.37', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3235', 'BANDO', 'CORREAS'),
(105, 'PRODUCTO', 'RPF3240', 'CORREAS AUTOMOTRICES', 'RPF3240 (24 Pulgadas)', 'RPF3240 (24 Pulgadas)', '4.47', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3240', 'BANDO', 'CORREAS'),
(106, 'PRODUCTO', 'RPF3245', 'CORREAS AUTOMOTRICES', 'RPF3245 (24,5 Pulgadas)', 'RPF3245 (24,5 Pulgadas)', '4.56', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3245', 'BANDO', 'CORREAS'),
(107, 'PRODUCTO', 'RPF3250', 'CORREAS AUTOMOTRICES', 'RPF3250 (25 Pulgadas)', 'RPF3250 (25 Pulgadas)', '4.66', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3250', 'BANDO', 'CORREAS'),
(108, 'PRODUCTO', 'RPF3255', 'CORREAS AUTOMOTRICES', 'RPF3255 (25,5 Pulgadas)', 'RPF3255 (25,5 Pulgadas)', '4.75', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3255', 'BANDO', 'CORREAS'),
(109, 'PRODUCTO', 'RPF3260', 'CORREAS AUTOMOTRICES', 'RPF3260 (26 Pulgadas)', 'RPF3260 (26 Pulgadas)', '4.84', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3260', 'BANDO', 'CORREAS'),
(110, 'PRODUCTO', 'RPF3265', 'CORREAS AUTOMOTRICES', 'RPF3265 (26,5 Pulgadas)', 'RPF3265 (26,5 Pulgadas)', '4.94', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3265', 'BANDO', 'CORREAS'),
(111, 'PRODUCTO', 'RPF3270', 'CORREAS AUTOMOTRICES', 'RPF3270 (27 Pulgadas)', 'RPF3270 (27 Pulgadas)', '5.03', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3270', 'BANDO', 'CORREAS'),
(112, 'PRODUCTO', 'RPF3275', 'CORREAS AUTOMOTRICES', 'RPF3275 (27,5 Pulgadas)', 'RPF3275 (27,5 Pulgadas)', '5.12', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3275', 'BANDO', 'CORREAS'),
(113, 'PRODUCTO', 'RPF3280', 'CORREAS AUTOMOTRICES', 'RPF3280 (28 Pulgadas)', 'RPF3280 (28 Pulgadas)', '5.22', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3280', 'BANDO', 'CORREAS'),
(114, 'PRODUCTO', 'RPF3285', 'CORREAS AUTOMOTRICES', 'RPF3285 (28,5 Pulgadas)', 'RPF3285 (28,5 Pulgadas)', '5.31', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3285', 'BANDO', 'CORREAS'),
(115, 'PRODUCTO', 'RPF3290', 'CORREAS AUTOMOTRICES', 'RPF3290 (29 Pulgadas)', 'RPF3290 (29 Pulgadas)', '5.40', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3290', 'BANDO', 'CORREAS'),
(116, 'PRODUCTO', 'RPF3295', 'CORREAS AUTOMOTRICES', 'RPF3295 (29,5 Pulgadas)', 'RPF3295 (29,5 Pulgadas)', '5.50', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3295', 'BANDO', 'CORREAS'),
(117, 'PRODUCTO', 'RPF3300', 'CORREAS AUTOMOTRICES', 'RPF3300 (30 Pulgadas)', 'RPF3300 (30 Pulgadas)', '5.59', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3300', 'BANDO', 'CORREAS'),
(118, 'PRODUCTO', 'RPF3305', 'CORREAS AUTOMOTRICES', 'RPF3305 (30,5 Pulgadas)', 'RPF3305 (30,5 Pulgadas)', '5.69', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3305', 'BANDO', 'CORREAS'),
(119, 'PRODUCTO', 'RPF3310', 'CORREAS AUTOMOTRICES', 'RPF3310 (31 Pulgadas)', 'RPF3310 (31 Pulgadas)', '5.78', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3310', 'BANDO', 'CORREAS'),
(120, 'PRODUCTO', 'RPF3315', 'CORREAS AUTOMOTRICES', 'RPF3315 (31,5 Pulgadas)', 'RPF3315 (31,5 Pulgadas)', '5.87', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3315', 'BANDO', 'CORREAS'),
(121, 'PRODUCTO', 'RPF3320', 'CORREAS AUTOMOTRICES', 'RPF3320 (32 Pulgadas)', 'RPF3320 (32 Pulgadas)', '5.97', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3320', 'BANDO', 'CORREAS'),
(122, 'PRODUCTO', 'RPF3325', 'CORREAS AUTOMOTRICES', 'RPF3325 (32,5 Pulgadas)', 'RPF3325 (32,5 Pulgadas)', '6.06', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3325', 'BANDO', 'CORREAS'),
(123, 'PRODUCTO', 'RPF3330', 'CORREAS AUTOMOTRICES', 'RPF3330 (33 Pulgadas)', 'RPF3330 (33 Pulgadas)', '6.15', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3330', 'BANDO', 'CORREAS'),
(124, 'PRODUCTO', 'RPF3335', 'CORREAS AUTOMOTRICES', 'RPF3335 (33,5 Pulgadas)', 'RPF3335 (33,5 Pulgadas)', '6.25', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3335', 'BANDO', 'CORREAS'),
(125, 'PRODUCTO', 'RPF3340', 'CORREAS AUTOMOTRICES', 'RPF3340 (34 Pulgadas)', 'RPF3340 (34 Pulgadas)', '6.34', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3340', 'BANDO', 'CORREAS'),
(126, 'PRODUCTO', 'RPF3345', 'CORREAS AUTOMOTRICES', 'RPF3345 (34,5 Pulgadas)', 'RPF3345 (34,5 Pulgadas)', '6.43', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3345', 'BANDO', 'CORREAS'),
(127, 'PRODUCTO', 'RPF3350', 'CORREAS AUTOMOTRICES', 'RPF3350 (35 Pulgadas)', 'RPF3350 (35 Pulgadas)', '6.53', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3350', 'BANDO', 'CORREAS'),
(128, 'PRODUCTO', 'RPF3355', 'CORREAS AUTOMOTRICES', 'RPF3355 (35,5 Pulgadas)', 'RPF3355 (35,5 Pulgadas)', '6.62', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3355', 'BANDO', 'CORREAS'),
(129, 'PRODUCTO', 'RPF3360', 'CORREAS AUTOMOTRICES', 'RPF3360 (36 Pulgadas)', 'RPF3360 (36 Pulgadas)', '6.71', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3360', 'BANDO', 'CORREAS'),
(130, 'PRODUCTO', 'RPF3365', 'CORREAS AUTOMOTRICES', 'RPF3365 (36,5 Pulgadas)', 'RPF3365 (36,5 Pulgadas)', '6.81', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3365', 'BANDO', 'CORREAS'),
(131, 'PRODUCTO', 'RPF3370', 'CORREAS AUTOMOTRICES', 'RPF3370 (37 Pulgadas)', 'RPF3370 (37 Pulgadas)', '6.90', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3370', 'BANDO', 'CORREAS'),
(132, 'PRODUCTO', 'RPF3375', 'CORREAS AUTOMOTRICES', 'RPF3375 (37,5 Pulgadas)', 'RPF3375 (37,5 Pulgadas)', '7.00', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3375', 'BANDO', 'CORREAS'),
(133, 'PRODUCTO', 'RPF3380', 'CORREAS AUTOMOTRICES', 'RPF3380 (38 Pulgadas)', 'RPF3380 (38 Pulgadas)', '7.09', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3380', 'BANDO', 'CORREAS'),
(134, 'PRODUCTO', 'RPF3385', 'CORREAS AUTOMOTRICES', 'RPF3385 (38,5 Pulgadas)', 'RPF3385 (38,5 Pulgadas)', '7.15', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3385', 'BANDO', 'CORREAS'),
(135, 'PRODUCTO', 'RPF3390', 'CORREAS AUTOMOTRICES', 'RPF3390 (39 Pulgadas)', 'RPF3390 (39 Pulgadas)', '7.25', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3390', 'BANDO', 'CORREAS'),
(136, 'PRODUCTO', 'RPF3395', 'CORREAS AUTOMOTRICES', 'RPF3395 (39,5 Pulgadas)', 'RPF3395 (39,5 Pulgadas)', '7.34', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3395', 'BANDO', 'CORREAS'),
(137, 'PRODUCTO', 'RPF3400', 'CORREAS AUTOMOTRICES', 'RPF3400 (40 Pulgadas)', 'RPF3400 (40 Pulgadas)', '7.43', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3400', 'BANDO', 'CORREAS'),
(138, 'PRODUCTO', 'RPF3405', 'CORREAS AUTOMOTRICES', 'RPF3405 (40,5 Pulgadas)', 'RPF3405 (40,5 Pulgadas)', '7.53', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3405', 'BANDO', 'CORREAS'),
(139, 'PRODUCTO', 'RPF3410', 'CORREAS AUTOMOTRICES', 'RPF3410 (41 Pulgadas)', 'RPF3410 (41 Pulgadas)', '7.62', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3410', 'BANDO', 'CORREAS'),
(140, 'PRODUCTO', 'RPF3415', 'CORREAS AUTOMOTRICES', 'RPF3415 (41,5 Pulgadas)', 'RPF3415 (41,5 Pulgadas)', '7.71', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3415', 'BANDO', 'CORREAS'),
(141, 'PRODUCTO', 'RPF3420', 'CORREAS AUTOMOTRICES', 'RPF3420 (42 Pulgadas)', 'RPF3420 (42 Pulgadas)', '7.81', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3420', 'BANDO', 'CORREAS'),
(142, 'PRODUCTO', 'RPF3425', 'CORREAS AUTOMOTRICES', 'RPF3425 (42,5 Pulgadas)', 'RPF3425 (42,5 Pulgadas)', '7.90', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3425', 'BANDO', 'CORREAS'),
(143, 'PRODUCTO', 'RPF3430', 'CORREAS AUTOMOTRICES', 'RPF3430 (43 Pulgadas)', 'RPF3430 (43 Pulgadas)', '7.99', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3430', 'BANDO', 'CORREAS'),
(144, 'PRODUCTO', 'RPF3435', 'CORREAS AUTOMOTRICES', 'RPF3435 (43,5 Pulgadas)', 'RPF3435 (43,5 Pulgadas)', '8.09', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3435', 'BANDO', 'CORREAS'),
(145, 'PRODUCTO', 'RPF3440', 'CORREAS AUTOMOTRICES', 'RPF3440 (44 Pulgadas)', 'RPF3440 (44 Pulgadas)', '8.18', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3440', 'BANDO', 'CORREAS'),
(146, 'PRODUCTO', 'RPF3445', 'CORREAS AUTOMOTRICES', 'RPF3445 (44,5 Pulgadas)', 'RPF3445 (44,5 Pulgadas)', '8.28', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3445', 'BANDO', 'CORREAS'),
(147, 'PRODUCTO', 'RPF3450', 'CORREAS AUTOMOTRICES', 'RPF3450 (45 Pulgadas)', 'RPF3450 (45 Pulgadas)', '8.37', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3450', 'BANDO', 'CORREAS'),
(148, 'PRODUCTO', 'RPF3455', 'CORREAS AUTOMOTRICES', 'RPF3455 (45,5 Pulgadas)', 'RPF3455 (45,5 Pulgadas)', '8.46', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3455', 'BANDO', 'CORREAS'),
(149, 'PRODUCTO', 'RPF3460', 'CORREAS AUTOMOTRICES', 'RPF3460 (46 Pulgadas)', 'RPF3460 (46 Pulgadas)', '8.56', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3460', 'BANDO', 'CORREAS'),
(150, 'PRODUCTO', 'RPF3465', 'CORREAS AUTOMOTRICES', 'RPF3465 (46,5 Pulgadas)', 'RPF3465 (46,5 Pulgadas)', '8.65', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3465', 'BANDO', 'CORREAS'),
(151, 'PRODUCTO', 'RPF3470', 'CORREAS AUTOMOTRICES', 'RPF3470 (47 Pulgadas)', 'RPF3470 (47 Pulgadas)', '8.74', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3470', 'BANDO', 'CORREAS'),
(152, 'PRODUCTO', 'RPF3475', 'CORREAS AUTOMOTRICES', 'RPF3475 (47,5 Pulgadas)', 'RPF3475 (47,5 Pulgadas)', '8.84', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3475', 'BANDO', 'CORREAS'),
(153, 'PRODUCTO', 'RPF3480', 'CORREAS AUTOMOTRICES', 'RPF3480 (48 Pulgadas)', 'RPF3480 (48 Pulgadas)', '8.93', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3480', 'BANDO', 'CORREAS'),
(154, 'PRODUCTO', 'RPF3485', 'CORREAS AUTOMOTRICES', 'RPF3485 (48,5 Pulgadas)', 'RPF3485 (48,5 Pulgadas)', '9.02', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3485', 'BANDO', 'CORREAS'),
(155, 'PRODUCTO', 'RPF3490', 'CORREAS AUTOMOTRICES', 'RPF3490 (49 Pulgadas)', 'RPF3490 (49 Pulgadas)', '9.12', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3490', 'BANDO', 'CORREAS'),
(156, 'PRODUCTO', 'RPF3495', 'CORREAS AUTOMOTRICES', 'RPF3495 (49,5 Pulgadas)', 'RPF3495 (49,5 Pulgadas)', '9.21', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3495', 'BANDO', 'CORREAS'),
(157, 'PRODUCTO', 'RPF3500', 'CORREAS AUTOMOTRICES', 'RPF3500 (50 Pulgadas)', 'RPF3500 (50 Pulgadas)', '9.31', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3500', 'BANDO', 'CORREAS'),
(158, 'PRODUCTO', 'RPF3505', 'CORREAS AUTOMOTRICES', 'RPF3505 (50,5 Pulgadas)', 'RPF3505 (50,5 Pulgadas)', '9.40', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3505', 'BANDO', 'CORREAS'),
(159, 'PRODUCTO', 'RPF3510', 'CORREAS AUTOMOTRICES', 'RPF3510 (51 Pulgadas)', 'RPF3510 (51 Pulgadas)', '9.49', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3510', 'BANDO', 'CORREAS'),
(160, 'PRODUCTO', 'RPF3515', 'CORREAS AUTOMOTRICES', 'RPF3515 (51,5 Pulgadas)', 'RPF3515 (51,5 Pulgadas)', '9.59', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3515', 'BANDO', 'CORREAS'),
(161, 'PRODUCTO', 'RPF3520', 'CORREAS AUTOMOTRICES', 'RPF3520 (52 Pulgadas)', 'RPF3520 (52 Pulgadas)', '9.68', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3520', 'BANDO', 'CORREAS'),
(162, 'PRODUCTO', 'RPF3525', 'CORREAS AUTOMOTRICES', 'RPF3525 (52,5 Pulgadas)', 'RPF3525 (52,5 Pulgadas)', '9.77', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3525', 'BANDO', 'CORREAS'),
(163, 'PRODUCTO', 'RPF3530', 'CORREAS AUTOMOTRICES', 'RPF3530 (53 Pulgadas)', 'RPF3530 (53 Pulgadas)', '9.87', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3530', 'BANDO', 'CORREAS'),
(164, 'PRODUCTO', 'RPF3535', 'CORREAS AUTOMOTRICES', 'RPF3535 (53,5 Pulgadas)', 'RPF3535 (53,5 Pulgadas)', '9.96', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3535', 'BANDO', 'CORREAS'),
(165, 'PRODUCTO', 'RPF3540', 'CORREAS AUTOMOTRICES', 'RPF3540 (54 Pulgadas)', 'RPF3540 (54 Pulgadas)', '10.05', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3540', 'BANDO', 'CORREAS'),
(166, 'PRODUCTO', 'RPF3545', 'CORREAS AUTOMOTRICES', 'RPF3545 (54,5 Pulgadas)', 'RPF3545 (54,5 Pulgadas)', '10.15', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3545', 'BANDO', 'CORREAS'),
(167, 'PRODUCTO', 'RPF3550', 'CORREAS AUTOMOTRICES', 'RPF3550 (55 Pulgadas)', 'RPF3550 (55 Pulgadas)', '10.24', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3550', 'BANDO', 'CORREAS'),
(168, 'PRODUCTO', 'RPF3555', 'CORREAS AUTOMOTRICES', 'RPF3555 (55,5 Pulgadas)', 'RPF3555 (55,5 Pulgadas)', '10.34', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3555', 'BANDO', 'CORREAS'),
(169, 'PRODUCTO', 'RPF3560', 'CORREAS AUTOMOTRICES', 'RPF3560 (56 Pulgadas)', 'RPF3560 (56 Pulgadas)', '10.43', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3560', 'BANDO', 'CORREAS'),
(170, 'PRODUCTO', 'RPF3565', 'CORREAS AUTOMOTRICES', 'RPF3565 (56,5 Pulgadas)', 'RPF3565 (56,5 Pulgadas)', '10.52', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3565', 'BANDO', 'CORREAS'),
(171, 'PRODUCTO', 'RPF3570', 'CORREAS AUTOMOTRICES', 'RPF3570 (57 Pulgadas)', 'RPF3570 (57 Pulgadas)', '10.62', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3570', 'BANDO', 'CORREAS'),
(172, 'PRODUCTO', 'RPF3575', 'CORREAS AUTOMOTRICES', 'RPF3575 (57,5 Pulgadas)', 'RPF3575 (57,5 Pulgadas)', '10.71', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3575', 'BANDO', 'CORREAS'),
(173, 'PRODUCTO', 'RPF3580', 'CORREAS AUTOMOTRICES', 'RPF3580 (58 Pulgadas)', 'RPF3580 (58 Pulgadas)', '10.80', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3580', 'BANDO', 'CORREAS'),
(174, 'PRODUCTO', 'RPF3585', 'CORREAS AUTOMOTRICES', 'RPF3585 (58,5 Pulgadas)', 'RPF3585 (58,5 Pulgadas)', '10.90', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3585', 'BANDO', 'CORREAS'),
(175, 'PRODUCTO', 'RPF3590', 'CORREAS AUTOMOTRICES', 'RPF3590 (59 Pulgadas)', 'RPF3590 (59 Pulgadas)', '10.99', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3590', 'BANDO', 'CORREAS'),
(176, 'PRODUCTO', 'RPF3595', 'CORREAS AUTOMOTRICES', 'RPF3595 (59,5 Pulgadas)', 'RPF3595 (59,5 Pulgadas)', '11.08', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3595', 'BANDO', 'CORREAS'),
(177, 'PRODUCTO', 'RPF3600', 'CORREAS AUTOMOTRICES', 'RPF3600 (60 Pulgadas)', 'RPF3600 (60 Pulgadas)', '11.18', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3600', 'BANDO', 'CORREAS'),
(178, 'PRODUCTO', 'RPF3605', 'CORREAS AUTOMOTRICES', 'RPF3605 (60,5 Pulgadas)', 'RPF3605 (60,5 Pulgadas)', '11.27', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3605', 'BANDO', 'CORREAS'),
(179, 'PRODUCTO', 'RPF3610', 'CORREAS AUTOMOTRICES', 'RPF3610 (61 Pulgadas)', 'RPF3610 (61 Pulgadas)', '11.37', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3610', 'BANDO', 'CORREAS'),
(180, 'PRODUCTO', 'RPF3615', 'CORREAS AUTOMOTRICES', 'RPF3615 (61,5 Pulgadas)', 'RPF3615 (61,5 Pulgadas)', '11.46', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3615', 'BANDO', 'CORREAS'),
(181, 'PRODUCTO', 'RPF3620', 'CORREAS AUTOMOTRICES', 'RPF3620 (62 Pulgadas)', 'RPF3620 (62 Pulgadas)', '11.55', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3620', 'BANDO', 'CORREAS'),
(182, 'PRODUCTO', 'RPF3625', 'CORREAS AUTOMOTRICES', 'RPF3625 (62,5 Pulgadas)', 'RPF3625 (62,5 Pulgadas)', '11.65', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3625', 'BANDO', 'CORREAS'),
(183, 'PRODUCTO', 'RPF3630', 'CORREAS AUTOMOTRICES', 'RPF3630 (63 Pulgadas)', 'RPF3630 (63 Pulgadas)', '11.74', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3630', 'BANDO', 'CORREAS'),
(184, 'PRODUCTO', 'RPF3635', 'CORREAS AUTOMOTRICES', 'RPF3635 (63,5 Pulgadas)', 'RPF3635 (63,5 Pulgadas)', '11.83', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3635', 'BANDO', 'CORREAS'),
(185, 'PRODUCTO', 'RPF3640', 'CORREAS AUTOMOTRICES', 'RPF3640 (64 Pulgadas)', 'RPF3640 (64 Pulgadas)', '11.90', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3640', 'BANDO', 'CORREAS'),
(186, 'PRODUCTO', 'RPF3650', 'CORREAS AUTOMOTRICES', 'RPF3650 (65 Pulgadas)', 'RPF3650 (65 Pulgadas)', '12.08', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3650', 'BANDO', 'CORREAS'),
(187, 'PRODUCTO', 'RPF3655', 'CORREAS AUTOMOTRICES', 'RPF3655 (65,5 Pulgadas)', 'RPF3655 (65,5 Pulgadas)', '12.18', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3655', 'BANDO', 'CORREAS'),
(188, 'PRODUCTO', 'RPF3660', 'CORREAS AUTOMOTRICES', 'RPF3660 (66 Pulgadas)', 'RPF3660 (66 Pulgadas)', '12.27', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3660', 'BANDO', 'CORREAS'),
(189, 'PRODUCTO', 'RPF3665', 'CORREAS AUTOMOTRICES', 'RPF3665 (66,5 Pulgadas)', 'RPF3665 (66,5 Pulgadas)', '12.36', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3665', 'BANDO', 'CORREAS'),
(190, 'PRODUCTO', 'RPF3670', 'CORREAS AUTOMOTRICES', 'RPF3670 (67 Pulgadas)', 'RPF3670 (67 Pulgadas)', '12.46', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3670', 'BANDO', 'CORREAS'),
(191, 'PRODUCTO', 'RPF3680', 'CORREAS AUTOMOTRICES', 'RPF3680 (68 Pulgadas)', 'RPF3680 (68 Pulgadas)', '12.64', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3680', 'BANDO', 'CORREAS'),
(192, 'PRODUCTO', 'RPF3690', 'CORREAS AUTOMOTRICES', 'RPF3690 (69 Pulgadas)', 'RPF3690 (69 Pulgadas)', '12.83', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3690', 'BANDO', 'CORREAS'),
(193, 'PRODUCTO', 'RPF3695', 'CORREAS AUTOMOTRICES', 'RPF3695 (69,5 Pulgadas)', 'RPF3695 (69,5 Pulgadas)', '12.93', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3695', 'BANDO', 'CORREAS'),
(194, 'PRODUCTO', 'RPF3700', 'CORREAS AUTOMOTRICES', 'RPF3700 (70 Pulgadas)', 'RPF3700 (70 Pulgadas)', '13.02', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3700', 'BANDO', 'CORREAS'),
(195, 'PRODUCTO', 'RPF3705', 'CORREAS AUTOMOTRICES', 'RPF3705 (70,5 Pulgadas)', 'RPF3705 (70,5 Pulgadas)', '13.11', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3705', 'BANDO', 'CORREAS'),
(196, 'PRODUCTO', 'RPF3710', 'CORREAS AUTOMOTRICES', 'RPF3710 (71 Pulgadas)', 'RPF3710 (71 Pulgadas)', '13.21', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3710', 'BANDO', 'CORREAS'),
(197, 'PRODUCTO', 'RPF3715', 'CORREAS AUTOMOTRICES', 'RPF3715 (71,5 Pulgadas)', 'RPF3715 (71,5 Pulgadas)', '13.30', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3715', 'BANDO', 'CORREAS'),
(198, 'PRODUCTO', 'RPF3720', 'CORREAS AUTOMOTRICES', 'RPF3720 (72 Pulgadas)', 'RPF3720 (72 Pulgadas)', '13.39', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3720', 'BANDO', 'CORREAS'),
(199, 'PRODUCTO', 'RPF3725', 'CORREAS AUTOMOTRICES', 'RPF3725 (72,5 Pulgadas)', 'RPF3725 (72,5 Pulgadas)', '13.49', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3725', 'BANDO', 'CORREAS'),
(200, 'PRODUCTO', 'RPF3730', 'CORREAS AUTOMOTRICES', 'RPF3730 (73 Pulgadas)', 'RPF3730 (73 Pulgadas)', '13.58', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3730', 'BANDO', 'CORREAS'),
(201, 'PRODUCTO', 'RPF3735', 'CORREAS AUTOMOTRICES', 'RPF3735 (73,5 Pulgadas)', 'RPF3735 (73,5 Pulgadas)', '13.67', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF3735', 'BANDO', 'CORREAS'),
(202, 'PRODUCTO', 'RPF3740', 'CORREAS AUTOMOTRICES', 'RPF3740 (74 Pulgadas)', 'RPF3740 (74 Pulgadas)', '13.77', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF3740', 'BANDO', 'CORREAS'),
(203, 'PRODUCTO', 'RPF3745', 'CORREAS AUTOMOTRICES', 'RPF3745 (74,5 Pulgadas)', 'RPF3745 (74,5 Pulgadas)', '13.86', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF3745', 'BANDO', 'CORREAS'),
(204, 'PRODUCTO', 'RPF4260', 'CORREAS AUTOMOTRICES', 'RPF4260 (26 Pulgadas)', 'RPF4260 (26 Pulgadas)', '4.84', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4260', 'BANDO', 'CORREAS'),
(205, 'PRODUCTO', 'RPF4270', 'CORREAS AUTOMOTRICES', 'RPF4270 (27 Pulgadas)', 'RPF4270 (27 Pulgadas)', '5.03', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4270', 'BANDO', 'CORREAS'),
(206, 'PRODUCTO', 'RPF4275', 'CORREAS AUTOMOTRICES', 'RPF4275 (27,5 Pulgadas)', 'RPF4275 (27,5 Pulgadas)', '5.12', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4275', 'BANDO', 'CORREAS'),
(207, 'PRODUCTO', 'RPF4280', 'CORREAS AUTOMOTRICES', 'RPF4280 (28 Pulgadas)', 'RPF4280 (28 Pulgadas)', '5.22', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4280', 'BANDO', 'CORREAS'),
(208, 'PRODUCTO', 'RPF4285', 'CORREAS AUTOMOTRICES', 'RPF4285 (28,5 Pulgadas)', 'RPF4285 (28,5 Pulgadas)', '5.31', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4285', 'BANDO', 'CORREAS'),
(209, 'PRODUCTO', 'RPF4290', 'CORREAS AUTOMOTRICES', 'RPF4290 (29 Pulgadas)', 'RPF4290 (29 Pulgadas)', '5.40', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4290', 'BANDO', 'CORREAS'),
(210, 'PRODUCTO', 'RPF4295', 'CORREAS AUTOMOTRICES', 'RPF4295 (29,5 Pulgadas)', 'RPF4295 (29,5 Pulgadas)', '5.50', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4295', 'BANDO', 'CORREAS'),
(211, 'PRODUCTO', 'RPF4300', 'CORREAS AUTOMOTRICES', 'RPF4300 (30 Pulgadas)', 'RPF4300 (30 Pulgadas)', '5.59', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4300', 'BANDO', 'CORREAS'),
(212, 'PRODUCTO', 'RPF4305', 'CORREAS AUTOMOTRICES', 'RPF4305 (30,5 Pulgadas)', 'RPF4305 (30,5 Pulgadas)', '5.69', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4305', 'BANDO', 'CORREAS'),
(213, 'PRODUCTO', 'RPF4310', 'CORREAS AUTOMOTRICES', 'RPF4310 (31 Pulgadas)', 'RPF4310 (31 Pulgadas)', '5.78', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4310', 'BANDO', 'CORREAS'),
(214, 'PRODUCTO', 'RPF4315', 'CORREAS AUTOMOTRICES', 'RPF4315 (31,5 Pulgadas)', 'RPF4315 (31,5 Pulgadas)', '5.87', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4315', 'BANDO', 'CORREAS'),
(215, 'PRODUCTO', 'RPF4320', 'CORREAS AUTOMOTRICES', 'RPF4320 (32 Pulgadas)', 'RPF4320 (32 Pulgadas)', '5.97', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4320', 'BANDO', 'CORREAS'),
(216, 'PRODUCTO', 'RPF4325', 'CORREAS AUTOMOTRICES', 'RPF4325 (32,5 Pulgadas)', 'RPF4325 (32,5 Pulgadas)', '6.06', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4325', 'BANDO', 'CORREAS'),
(217, 'PRODUCTO', 'RPF4330', 'CORREAS AUTOMOTRICES', 'RPF4330 (33 Pulgadas)', 'RPF4330 (33 Pulgadas)', '6.15', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4330', 'BANDO', 'CORREAS'),
(218, 'PRODUCTO', 'RPF4335', 'CORREAS AUTOMOTRICES', 'RPF4335 (33,5 Pulgadas)', 'RPF4335 (33,5 Pulgadas)', '6.25', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4335', 'BANDO', 'CORREAS'),
(219, 'PRODUCTO', 'RPF4340', 'CORREAS AUTOMOTRICES', 'RPF4340 (34 Pulgadas)', 'RPF4340 (34 Pulgadas)', '6.34', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4340', 'BANDO', 'CORREAS'),
(220, 'PRODUCTO', 'RPF4345', 'CORREAS AUTOMOTRICES', 'RPF4345 (34,5 Pulgadas)', 'RPF4345 (34,5 Pulgadas)', '6.43', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4345', 'BANDO', 'CORREAS'),
(221, 'PRODUCTO', 'RPF4350', 'CORREAS AUTOMOTRICES', 'RPF4350 (35 Pulgadas)', 'RPF4350 (35 Pulgadas)', '6.53', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4350', 'BANDO', 'CORREAS'),
(222, 'PRODUCTO', 'RPF4355', 'CORREAS AUTOMOTRICES', 'RPF4355 (35,5 Pulgadas)', 'RPF4355 (35,5 Pulgadas)', '6.62', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4355', 'BANDO', 'CORREAS'),
(223, 'PRODUCTO', 'RPF4360', 'CORREAS AUTOMOTRICES', 'RPF4360 (36 Pulgadas)', 'RPF4360 (36 Pulgadas)', '6.71', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4360', 'BANDO', 'CORREAS'),
(224, 'PRODUCTO', 'RPF4365', 'CORREAS AUTOMOTRICES', 'RPF4365 (36,5 Pulgadas)', 'RPF4365 (36,5 Pulgadas)', '6.81', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4365', 'BANDO', 'CORREAS'),
(225, 'PRODUCTO', 'RPF4370', 'CORREAS AUTOMOTRICES', 'RPF4370 (37 Pulgadas)', 'RPF4370 (37 Pulgadas)', '6.90', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4370', 'BANDO', 'CORREAS'),
(226, 'PRODUCTO', 'RPF4375', 'CORREAS AUTOMOTRICES', 'RPF4375 (37,5 Pulgadas)', 'RPF4375 (37,5 Pulgadas)', '7.00', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4375', 'BANDO', 'CORREAS'),
(227, 'PRODUCTO', 'RPF4380', 'CORREAS AUTOMOTRICES', 'RPF4380 (38 Pulgadas)', 'RPF4380 (38 Pulgadas)', '7.09', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4380', 'BANDO', 'CORREAS'),
(228, 'PRODUCTO', 'RPF4385', 'CORREAS AUTOMOTRICES', 'RPF4385 (38,5 Pulgadas)', 'RPF4385 (38,5 Pulgadas)', '7.15', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4385', 'BANDO', 'CORREAS'),
(229, 'PRODUCTO', 'RPF4390', 'CORREAS AUTOMOTRICES', 'RPF4390 (39 Pulgadas)', 'RPF4390 (39 Pulgadas)', '7.25', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4390', 'BANDO', 'CORREAS'),
(230, 'PRODUCTO', 'RPF4395', 'CORREAS AUTOMOTRICES', 'RPF4395 (39,5 Pulgadas)', 'RPF4395 (39,5 Pulgadas)', '7.34', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4395', 'BANDO', 'CORREAS'),
(231, 'PRODUCTO', 'RPF4400', 'CORREAS AUTOMOTRICES', 'RPF4400 (40 Pulgadas)', 'RPF4400 (40 Pulgadas)', '7.43', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4400', 'BANDO', 'CORREAS'),
(232, 'PRODUCTO', 'RPF4405', 'CORREAS AUTOMOTRICES', 'RPF4405 (40,5 Pulgadas)', 'RPF4405 (40,5 Pulgadas)', '7.53', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4405', 'BANDO', 'CORREAS'),
(233, 'PRODUCTO', 'RPF4410', 'CORREAS AUTOMOTRICES', 'RPF4410 (41 Pulgadas)', 'RPF4410 (41 Pulgadas)', '7.62', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4410', 'BANDO', 'CORREAS'),
(234, 'PRODUCTO', 'RPF4415', 'CORREAS AUTOMOTRICES', 'RPF4415 (41,5 Pulgadas)', 'RPF4415 (41,5 Pulgadas)', '7.71', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4415', 'BANDO', 'CORREAS'),
(235, 'PRODUCTO', 'RPF4420', 'CORREAS AUTOMOTRICES', 'RPF4420 (42 Pulgadas)', 'RPF4420 (42 Pulgadas)', '7.81', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4420', 'BANDO', 'CORREAS'),
(236, 'PRODUCTO', 'RPF4425', 'CORREAS AUTOMOTRICES', 'RPF4425 (42,5 Pulgadas)', 'RPF4425 (42,5 Pulgadas)', '7.90', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4425', 'BANDO', 'CORREAS'),
(237, 'PRODUCTO', 'RPF4430', 'CORREAS AUTOMOTRICES', 'RPF4430 (43 Pulgadas)', 'RPF4430 (43 Pulgadas)', '7.99', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4430', 'BANDO', 'CORREAS'),
(238, 'PRODUCTO', 'RPF4435', 'CORREAS AUTOMOTRICES', 'RPF4435 (43,5 Pulgadas)', 'RPF4435 (43,5 Pulgadas)', '8.09', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4435', 'BANDO', 'CORREAS'),
(239, 'PRODUCTO', 'RPF4440', 'CORREAS AUTOMOTRICES', 'RPF4440 (44 Pulgadas)', 'RPF4440 (44 Pulgadas)', '8.18', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4440', 'BANDO', 'CORREAS'),
(240, 'PRODUCTO', 'RPF4445', 'CORREAS AUTOMOTRICES', 'RPF4445 (44,5 Pulgadas)', 'RPF4445 (44,5 Pulgadas)', '8.28', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4445', 'BANDO', 'CORREAS'),
(241, 'PRODUCTO', 'RPF4450', 'CORREAS AUTOMOTRICES', 'RPF4450 (45 Pulgadas)', 'RPF4450 (45 Pulgadas)', '8.37', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4450', 'BANDO', 'CORREAS'),
(242, 'PRODUCTO', 'RPF4455', 'CORREAS AUTOMOTRICES', 'RPF4455 (45,5 Pulgadas)', 'RPF4455 (45,5 Pulgadas)', '8.46', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4455', 'BANDO', 'CORREAS'),
(243, 'PRODUCTO', 'RPF4460', 'CORREAS AUTOMOTRICES', 'RPF4460 (46 Pulgadas)', 'RPF4460 (46 Pulgadas)', '8.56', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4460', 'BANDO', 'CORREAS'),
(244, 'PRODUCTO', 'RPF4465', 'CORREAS AUTOMOTRICES', 'RPF4465 (46,5 Pulgadas)', 'RPF4465 (46,5 Pulgadas)', '8.65', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4465', 'BANDO', 'CORREAS'),
(245, 'PRODUCTO', 'RPF4470', 'CORREAS AUTOMOTRICES', 'RPF4470 (47 Pulgadas)', 'RPF4470 (47 Pulgadas)', '8.74', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4470', 'BANDO', 'CORREAS'),
(246, 'PRODUCTO', 'RPF4475', 'CORREAS AUTOMOTRICES', 'RPF4475 (47,5 Pulgadas)', 'RPF4475 (47,5 Pulgadas)', '8.84', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4475', 'BANDO', 'CORREAS');
INSERT INTO `sspi_productos` (`ID_PRODUCTO`, `TIPO_PRODUCTO_SERVICIO`, `NOMBRE_PRODUCTO`, `NOMBRE_CATEGORIA`, `DESCRIPCION_CORTA`, `DESCRIPCION_LARGA`, `PRECIO_UNITARIO_DOLARES`, `FOTO_1_CARRUSEL`, `FOTO_2_CORTA`, `FOTO_3_LARGA`, `UNIDAD_DE_VENTA`, `CANTIDAD_DISPONIBLE`, `DESTACADO`, `CODIGO`, `MARCA`, `RUBRO`) VALUES
(247, 'PRODUCTO', 'RPF4480', 'CORREAS AUTOMOTRICES', 'RPF4480 (48 Pulgadas)', 'RPF4480 (48 Pulgadas)', '8.93', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4480', 'BANDO', 'CORREAS'),
(248, 'PRODUCTO', 'RPF4485', 'CORREAS AUTOMOTRICES', 'RPF4485 (48,5 Pulgadas)', 'RPF4485 (48,5 Pulgadas)', '9.02', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4485', 'BANDO', 'CORREAS'),
(249, 'PRODUCTO', 'RPF4490', 'CORREAS AUTOMOTRICES', 'RPF4490 (49 Pulgadas)', 'RPF4490 (49 Pulgadas)', '9.12', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4490', 'BANDO', 'CORREAS'),
(250, 'PRODUCTO', 'RPF4495', 'CORREAS AUTOMOTRICES', 'RPF4495 (49,5 Pulgadas)', 'RPF4495 (49,5 Pulgadas)', '9.21', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4495', 'BANDO', 'CORREAS'),
(251, 'PRODUCTO', 'RPF4500', 'CORREAS AUTOMOTRICES', 'RPF4500 (50 Pulgadas)', 'RPF4500 (50 Pulgadas)', '9.31', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4500', 'BANDO', 'CORREAS'),
(252, 'PRODUCTO', 'RPF4505', 'CORREAS AUTOMOTRICES', 'RPF4505 (50,5 Pulgadas)', 'RPF4505 (50,5 Pulgadas)', '9.40', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4505', 'BANDO', 'CORREAS'),
(253, 'PRODUCTO', 'RPF4510', 'CORREAS AUTOMOTRICES', 'RPF4510 (51 Pulgadas)', 'RPF4510 (51 Pulgadas)', '9.49', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4510', 'BANDO', 'CORREAS'),
(254, 'PRODUCTO', 'RPF4520', 'CORREAS AUTOMOTRICES', 'RPF4520 (52 Pulgadas)', 'RPF4520 (52 Pulgadas)', '9.68', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4520', 'BANDO', 'CORREAS'),
(255, 'PRODUCTO', 'RPF4525', 'CORREAS AUTOMOTRICES', 'RPF4525 (52,5 Pulgadas)', 'RPF4525 (52,5 Pulgadas)', '9.77', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4525', 'BANDO', 'CORREAS'),
(256, 'PRODUCTO', 'RPF4530', 'CORREAS AUTOMOTRICES', 'RPF4530 (53 Pulgadas)', 'RPF4530 (53 Pulgadas)', '9.87', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4530', 'BANDO', 'CORREAS'),
(257, 'PRODUCTO', 'RPF4535', 'CORREAS AUTOMOTRICES', 'RPF4535 (53,5 Pulgadas)', 'RPF4535 (53,5 Pulgadas)', '9.96', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4535', 'BANDO', 'CORREAS'),
(258, 'PRODUCTO', 'RPF4540', 'CORREAS AUTOMOTRICES', 'RPF4540 (54 Pulgadas)', 'RPF4540 (54 Pulgadas)', '10.05', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4540', 'BANDO', 'CORREAS'),
(259, 'PRODUCTO', 'RPF4545', 'CORREAS AUTOMOTRICES', 'RPF4545 (54,5 Pulgadas)', 'RPF4545 (54,5 Pulgadas)', '10.15', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4545', 'BANDO', 'CORREAS'),
(260, 'PRODUCTO', 'RPF4550', 'CORREAS AUTOMOTRICES', 'RPF4550 (55 Pulgadas)', 'RPF4550 (55 Pulgadas)', '10.24', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4550', 'BANDO', 'CORREAS'),
(261, 'PRODUCTO', 'RPF4555', 'CORREAS AUTOMOTRICES', 'RPF4555 (55,5 Pulgadas)', 'RPF4555 (55,5 Pulgadas)', '10.34', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4555', 'BANDO', 'CORREAS'),
(262, 'PRODUCTO', 'RPF4560', 'CORREAS AUTOMOTRICES', 'RPF4560 (56 Pulgadas)', 'RPF4560 (56 Pulgadas)', '10.43', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4560', 'BANDO', 'CORREAS'),
(263, 'PRODUCTO', 'RPF4565', 'CORREAS AUTOMOTRICES', 'RPF4565 (56,5 Pulgadas)', 'RPF4565 (56,5 Pulgadas)', '10.52', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4565', 'BANDO', 'CORREAS'),
(264, 'PRODUCTO', 'RPF4570', 'CORREAS AUTOMOTRICES', 'RPF4570 (57 Pulgadas)', 'RPF4570 (57 Pulgadas)', '10.62', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4570', 'BANDO', 'CORREAS'),
(265, 'PRODUCTO', 'RPF4575', 'CORREAS AUTOMOTRICES', 'RPF4575 (57,5 Pulgadas)', 'RPF4575 (57,5 Pulgadas)', '10.71', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4575', 'BANDO', 'CORREAS'),
(266, 'PRODUCTO', 'RPF4580', 'CORREAS AUTOMOTRICES', 'RPF4580 (58 Pulgadas)', 'RPF4580 (58 Pulgadas)', '10.80', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4580', 'BANDO', 'CORREAS'),
(267, 'PRODUCTO', 'RPF4585', 'CORREAS AUTOMOTRICES', 'RPF4585 (58,5 Pulgadas)', 'RPF4585 (58,5 Pulgadas)', '10.90', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4585', 'BANDO', 'CORREAS'),
(268, 'PRODUCTO', 'RPF4590', 'CORREAS AUTOMOTRICES', 'RPF4590 (59 Pulgadas)', 'RPF4590 (59 Pulgadas)', '10.99', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4590', 'BANDO', 'CORREAS'),
(269, 'PRODUCTO', 'RPF4600', 'CORREAS AUTOMOTRICES', 'RPF4600 (60 Pulgadas)', 'RPF4600 (60 Pulgadas)', '11.18', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4600', 'BANDO', 'CORREAS'),
(270, 'PRODUCTO', 'RPF4605', 'CORREAS AUTOMOTRICES', 'RPF4605 (60,5 Pulgadas)', 'RPF4605 (60,5 Pulgadas)', '11.27', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4605', 'BANDO', 'CORREAS'),
(271, 'PRODUCTO', 'RPF4610', 'CORREAS AUTOMOTRICES', 'RPF4610 (61 Pulgadas)', 'RPF4610 (61 Pulgadas)', '11.37', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4610', 'BANDO', 'CORREAS'),
(272, 'PRODUCTO', 'RPF4620', 'CORREAS AUTOMOTRICES', 'RPF4620 (62 Pulgadas)', 'RPF4620 (62 Pulgadas)', '11.55', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4620', 'BANDO', 'CORREAS'),
(273, 'PRODUCTO', 'RPF4630', 'CORREAS AUTOMOTRICES', 'RPF4630 (63 Pulgadas)', 'RPF4630 (63 Pulgadas)', '11.74', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4630', 'BANDO', 'CORREAS'),
(274, 'PRODUCTO', 'RPF4640', 'CORREAS AUTOMOTRICES', 'RPF4640 (64 Pulgadas)', 'RPF4640 (64 Pulgadas)', '11.90', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4640', 'BANDO', 'CORREAS'),
(275, 'PRODUCTO', 'RPF4650', 'CORREAS AUTOMOTRICES', 'RPF4650 (65 Pulgadas)', 'RPF4650 (65 Pulgadas)', '12.08', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4650', 'BANDO', 'CORREAS'),
(276, 'PRODUCTO', 'RPF4660', 'CORREAS AUTOMOTRICES', 'RPF4660 (66 Pulgadas)', 'RPF4660 (66 Pulgadas)', '12.27', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4660', 'BANDO', 'CORREAS'),
(277, 'PRODUCTO', 'RPF4665', 'CORREAS AUTOMOTRICES', 'RPF4665 (66,5 Pulgadas)', 'RPF4665 (66,5 Pulgadas)', '12.36', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4665', 'BANDO', 'CORREAS'),
(278, 'PRODUCTO', 'RPF4670', 'CORREAS AUTOMOTRICES', 'RPF4670 (67 Pulgadas)', 'RPF4670 (67 Pulgadas)', '12.46', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4670', 'BANDO', 'CORREAS'),
(279, 'PRODUCTO', 'RPF4680', 'CORREAS AUTOMOTRICES', 'RPF4680 (68 Pulgadas)', 'RPF4680 (68 Pulgadas)', '12.64', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4680', 'BANDO', 'CORREAS'),
(280, 'PRODUCTO', 'RPF4690', 'CORREAS AUTOMOTRICES', 'RPF4690 (69 Pulgadas)', 'RPF4690 (69 Pulgadas)', '12.83', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4690', 'BANDO', 'CORREAS'),
(281, 'PRODUCTO', 'RPF4700', 'CORREAS AUTOMOTRICES', 'RPF4700 (70 Pulgadas)', 'RPF4700 (70 Pulgadas)', '13.02', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4700', 'BANDO', 'CORREAS'),
(282, 'PRODUCTO', 'RPF4710', 'CORREAS AUTOMOTRICES', 'RPF4710 (71 Pulgadas)', 'RPF4710 (71 Pulgadas)', '13.21', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4710', 'BANDO', 'CORREAS'),
(283, 'PRODUCTO', 'RPF4720', 'CORREAS AUTOMOTRICES', 'RPF4720 (72 Pulgadas)', 'RPF4720 (72 Pulgadas)', '13.39', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4720', 'BANDO', 'CORREAS'),
(284, 'PRODUCTO', 'RPF4725', 'CORREAS AUTOMOTRICES', 'RPF4725 (72,5 Pulgadas)', 'RPF4725 (72,5 Pulgadas)', '13.49', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4725', 'BANDO', 'CORREAS'),
(285, 'PRODUCTO', 'RPF4730', 'CORREAS AUTOMOTRICES', 'RPF4730 (73 Pulgadas)', 'RPF4730 (73 Pulgadas)', '13.58', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4730', 'BANDO', 'CORREAS'),
(286, 'PRODUCTO', 'RPF4740', 'CORREAS AUTOMOTRICES', 'RPF4740 (74 Pulgadas)', 'RPF4740 (74 Pulgadas)', '13.77', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF4740', 'BANDO', 'CORREAS'),
(287, 'PRODUCTO', 'RPF4750', 'CORREAS AUTOMOTRICES', 'RPF4750 (75 Pulgadas)', 'RPF4750 (75 Pulgadas)', '13.96', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF4750', 'BANDO', 'CORREAS'),
(288, 'PRODUCTO', 'RPF4770', 'CORREAS AUTOMOTRICES', 'RPF4770 (77 Pulgadas)', 'RPF4770 (77 Pulgadas)', '14.33', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF4770', 'BANDO', 'CORREAS'),
(289, 'PRODUCTO', 'RPF5300', 'CORREAS AUTOMOTRICES', 'RPF5300 (30 Pulgadas)', 'RPF5300 (30 Pulgadas)', '8.15', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF5300', 'BANDO', 'CORREAS'),
(290, 'PRODUCTO', 'RPF5310', 'CORREAS AUTOMOTRICES', 'RPF5310 (31 Pulgadas)', 'RPF5310 (31 Pulgadas)', '8.43', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF5310', 'BANDO', 'CORREAS'),
(291, 'PRODUCTO', 'RPF5320', 'CORREAS AUTOMOTRICES', 'RPF5320 (32 Pulgadas)', 'RPF5320 (32 Pulgadas)', '8.68', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF5320', 'BANDO', 'CORREAS'),
(292, 'PRODUCTO', 'RPF5325', 'CORREAS AUTOMOTRICES', 'RPF5325 (32,5 Pulgadas)', 'RPF5325 (32,5 Pulgadas)', '8.84', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF5325', 'BANDO', 'CORREAS'),
(293, 'PRODUCTO', 'RPF5330', 'CORREAS AUTOMOTRICES', 'RPF5330 (33 Pulgadas)', 'RPF5330 (33 Pulgadas)', '8.96', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF5330', 'BANDO', 'CORREAS'),
(294, 'PRODUCTO', 'RPF5340', 'CORREAS AUTOMOTRICES', 'RPF5340 (34 Pulgadas)', 'RPF5340 (34 Pulgadas)', '9.24', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF5340', 'BANDO', 'CORREAS'),
(295, 'PRODUCTO', 'RPF5345', 'CORREAS AUTOMOTRICES', 'RPF5345 (34,5 Pulgadas)', 'RPF5345 (34,5 Pulgadas)', '9.37', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF5345', 'BANDO', 'CORREAS'),
(296, 'PRODUCTO', 'RPF5350', 'CORREAS AUTOMOTRICES', 'RPF5350 (35 Pulgadas)', 'RPF5350 (35 Pulgadas)', '9.49', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF5350', 'BANDO', 'CORREAS'),
(297, 'PRODUCTO', 'RPF5355', 'CORREAS AUTOMOTRICES', 'RPF5355 (35,5 Pulgadas)', 'RPF5355 (35,5 Pulgadas)', '0.00', 'correas_2.png', '', '', 'Pieza', 0, 'NO', 'RPF5355', 'BANDO', 'CORREAS'),
(298, 'PRODUCTO', 'RPF5360', 'CORREAS AUTOMOTRICES', 'RPF5360 (36 Pulgadas)', 'RPF5360 (36 Pulgadas)', '9.77', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF5360', 'BANDO', 'CORREAS'),
(299, 'PRODUCTO', 'RPF5365', 'CORREAS AUTOMOTRICES', 'RPF5365 (36,5 Pulgadas)', 'RPF5365 (36,5 Pulgadas)', '9.93', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF5365', 'BANDO', 'CORREAS'),
(300, 'PRODUCTO', 'RPF5370', 'CORREAS AUTOMOTRICES', 'RPF5370 (37 Pulgadas)', 'RPF5370 (37 Pulgadas)', '10.05', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF5370', 'BANDO', 'CORREAS'),
(301, 'PRODUCTO', 'RPF5380', 'CORREAS AUTOMOTRICES', 'RPF5380 (38 Pulgadas)', 'RPF5380 (38 Pulgadas)', '10.34', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF5380', 'BANDO', 'CORREAS'),
(302, 'PRODUCTO', 'RPF5385', 'CORREAS AUTOMOTRICES', 'RPF5385 (38,5 Pulgadas)', 'RPF5385 (38,5 Pulgadas)', '10.46', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF5385', 'BANDO', 'CORREAS'),
(303, 'PRODUCTO', 'RPF5390', 'CORREAS AUTOMOTRICES', 'RPF5390 (39 Pulgadas)', 'RPF5390 (39 Pulgadas)', '10.58', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF5390', 'BANDO', 'CORREAS'),
(304, 'PRODUCTO', 'RPF5395', 'CORREAS AUTOMOTRICES', 'RPF5395 (39,5 Pulgadas)', 'RPF5395 (39,5 Pulgadas)', '10.74', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF5395', 'BANDO', 'CORREAS'),
(305, 'PRODUCTO', 'RPF5400', 'CORREAS AUTOMOTRICES', 'RPF5400 (40 Pulgadas)', 'RPF5400 (40 Pulgadas)', '10.87', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF5400', 'BANDO', 'CORREAS'),
(306, 'PRODUCTO', 'RPF5405', 'CORREAS AUTOMOTRICES', 'RPF5405 (40,5 Pulgadas)', 'RPF5405 (40,5 Pulgadas)', '10.99', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF5405', 'BANDO', 'CORREAS'),
(307, 'PRODUCTO', 'RPF5410', 'CORREAS AUTOMOTRICES', 'RPF5410 (41 Pulgadas)', 'RPF5410 (41 Pulgadas)', '11.15', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF5410', 'BANDO', 'CORREAS'),
(308, 'PRODUCTO', 'RPF5415', 'CORREAS AUTOMOTRICES', 'RPF5415 (41,5 Pulgadas)', 'RPF5415 (41,5 Pulgadas)', '11.27', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF5415', 'BANDO', 'CORREAS'),
(309, 'PRODUCTO', 'RPF5420', 'CORREAS AUTOMOTRICES', 'RPF5420 (42 Pulgadas)', 'RPF5420 (42 Pulgadas)', '11.40', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF5420', 'BANDO', 'CORREAS'),
(310, 'PRODUCTO', 'RPF5425', 'CORREAS AUTOMOTRICES', 'RPF5425 (42,5 Pulgadas)', 'RPF5425 (42,5 Pulgadas)', '11.55', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF5425', 'BANDO', 'CORREAS'),
(311, 'PRODUCTO', 'RPF5430', 'CORREAS AUTOMOTRICES', 'RPF5430 (43 Pulgadas)', 'RPF5430 (43 Pulgadas)', '11.68', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF5430', 'BANDO', 'CORREAS'),
(312, 'PRODUCTO', 'RPF5435', 'CORREAS AUTOMOTRICES', 'RPF5435 (43,5 Pulgadas)', 'RPF5435 (43,5 Pulgadas)', '11.80', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF5435', 'BANDO', 'CORREAS'),
(313, 'PRODUCTO', 'RPF5440', 'CORREAS AUTOMOTRICES', 'RPF5440 (44 Pulgadas)', 'RPF5440 (44 Pulgadas)', '11.96', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF5440', 'BANDO', 'CORREAS'),
(314, 'PRODUCTO', 'RPF5445', 'CORREAS AUTOMOTRICES', 'RPF5445 (44,5 Pulgadas)', 'RPF5445 (44,5 Pulgadas)', '12.08', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF5445', 'BANDO', 'CORREAS'),
(315, 'PRODUCTO', 'RPF5450', 'CORREAS AUTOMOTRICES', 'RPF5450 (45 Pulgadas)', 'RPF5450 (45 Pulgadas)', '12.24', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF5450', 'BANDO', 'CORREAS'),
(316, 'PRODUCTO', 'RPF5455', 'CORREAS AUTOMOTRICES', 'RPF5455 (45,5 Pulgadas)', 'RPF5455 (45,5 Pulgadas)', '12.36', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF5455', 'BANDO', 'CORREAS'),
(317, 'PRODUCTO', 'RPF5460', 'CORREAS AUTOMOTRICES', 'RPF5460 (46 Pulgadas)', 'RPF5460 (46 Pulgadas)', '12.49', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF5460', 'BANDO', 'CORREAS'),
(318, 'PRODUCTO', 'RPF5465', 'CORREAS AUTOMOTRICES', 'RPF5465 (46,5 Pulgadas)', 'RPF5465 (46,5 Pulgadas)', '12.64', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF5465', 'BANDO', 'CORREAS'),
(319, 'PRODUCTO', 'RPF5470', 'CORREAS AUTOMOTRICES', 'RPF5470 (47 Pulgadas)', 'RPF5470 (47 Pulgadas)', '12.77', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF5470', 'BANDO', 'CORREAS'),
(320, 'PRODUCTO', 'RPF5475', 'CORREAS AUTOMOTRICES', 'RPF5475 (47,5 Pulgadas)', 'RPF5475 (47,5 Pulgadas)', '12.89', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF5475', 'BANDO', 'CORREAS'),
(321, 'PRODUCTO', 'RPF5480', 'CORREAS AUTOMOTRICES', 'RPF5480 (48 Pulgadas)', 'RPF5480 (48 Pulgadas)', '13.05', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF5480', 'BANDO', 'CORREAS'),
(322, 'PRODUCTO', 'RPF5485', 'CORREAS AUTOMOTRICES', 'RPF5485 (48,5 Pulgadas)', 'RPF5485 (48,5 Pulgadas)', '13.18', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF5485', 'BANDO', 'CORREAS'),
(323, 'PRODUCTO', 'RPF5490', 'CORREAS AUTOMOTRICES', 'RPF5490 (49 Pulgadas)', 'RPF5490 (49 Pulgadas)', '13.30', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF5490', 'BANDO', 'CORREAS'),
(324, 'PRODUCTO', 'RPF5495', 'CORREAS AUTOMOTRICES', 'RPF5495 (49,5 Pulgadas)', 'RPF5495 (49,5 Pulgadas)', '13.46', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF5495', 'BANDO', 'CORREAS'),
(325, 'PRODUCTO', 'RPF5500', 'CORREAS AUTOMOTRICES', 'RPF5500 (50 Pulgadas)', 'RPF5500 (50 Pulgadas)', '13.58', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF5500', 'BANDO', 'CORREAS'),
(326, 'PRODUCTO', 'RPF5505', 'CORREAS AUTOMOTRICES', 'RPF5505 (50,5 Pulgadas)', 'RPF5505 (50,5 Pulgadas)', '13.71', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF5505', 'BANDO', 'CORREAS'),
(327, 'PRODUCTO', 'RPF5510', 'CORREAS AUTOMOTRICES', 'RPF5510 (51 Pulgadas)', 'RPF5510 (51 Pulgadas)', '13.86', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF5510', 'BANDO', 'CORREAS'),
(328, 'PRODUCTO', 'RPF5515', 'CORREAS AUTOMOTRICES', 'RPF5515 (51,5 Pulgadas)', 'RPF5515 (51,5 Pulgadas)', '13.99', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF5515', 'BANDO', 'CORREAS'),
(329, 'PRODUCTO', 'RPF5520', 'CORREAS AUTOMOTRICES', 'RPF5520 (52 Pulgadas)', 'RPF5520 (52 Pulgadas)', '14.14', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF5520', 'BANDO', 'CORREAS'),
(330, 'PRODUCTO', 'RPF5525', 'CORREAS AUTOMOTRICES', 'RPF5525 (52,5 Pulgadas)', 'RPF5525 (52,5 Pulgadas)', '14.27', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF5525', 'BANDO', 'CORREAS'),
(331, 'PRODUCTO', 'RPF5530', 'CORREAS AUTOMOTRICES', 'RPF5530 (53 Pulgadas)', 'RPF5530 (53 Pulgadas)', '14.39', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF5530', 'BANDO', 'CORREAS'),
(332, 'PRODUCTO', 'RPF5535', 'CORREAS AUTOMOTRICES', 'RPF5535 (53,5 Pulgadas)', 'RPF5535 (53,5 Pulgadas)', '14.52', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF5535', 'BANDO', 'CORREAS'),
(333, 'PRODUCTO', 'RPF5540', 'CORREAS AUTOMOTRICES', 'RPF5540 (54 Pulgadas)', 'RPF5540 (54 Pulgadas)', '14.67', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF5540', 'BANDO', 'CORREAS'),
(334, 'PRODUCTO', 'RPF5545', 'CORREAS AUTOMOTRICES', 'RPF5545 (54,5 Pulgadas)', 'RPF5545 (54,5 Pulgadas)', '14.80', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF5545', 'BANDO', 'CORREAS'),
(335, 'PRODUCTO', 'RPF5550', 'CORREAS AUTOMOTRICES', 'RPF5550 (55 Pulgadas)', 'RPF5550 (55 Pulgadas)', '14.95', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF5550', 'BANDO', 'CORREAS'),
(336, 'PRODUCTO', 'RPF5560', 'CORREAS AUTOMOTRICES', 'RPF5560 (56 Pulgadas)', 'RPF5560 (56 Pulgadas)', '15.20', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF5560', 'BANDO', 'CORREAS'),
(337, 'PRODUCTO', 'RPF5570', 'CORREAS AUTOMOTRICES', 'RPF5570 (57 Pulgadas)', 'RPF5570 (57 Pulgadas)', '15.48', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF5570', 'BANDO', 'CORREAS'),
(338, 'PRODUCTO', 'RPF5580', 'CORREAS AUTOMOTRICES', 'RPF5580 (58 Pulgadas)', 'RPF5580 (58 Pulgadas)', '15.77', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF5580', 'BANDO', 'CORREAS'),
(339, 'PRODUCTO', 'RPF5590', 'CORREAS AUTOMOTRICES', 'RPF5590 (59 Pulgadas)', 'RPF5590 (59 Pulgadas)', '16.02', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF5590', 'BANDO', 'CORREAS'),
(340, 'PRODUCTO', 'RPF5600', 'CORREAS AUTOMOTRICES', 'RPF5600 (60 Pulgadas)', 'RPF5600 (60 Pulgadas)', '16.30', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF5600', 'BANDO', 'CORREAS'),
(341, 'PRODUCTO', 'RPF5605', 'CORREAS AUTOMOTRICES', 'RPF5605 (60,5 Pulgadas)', 'RPF5605 (60,5 Pulgadas)', '16.42', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF5605', 'BANDO', 'CORREAS'),
(342, 'PRODUCTO', 'RPF5610', 'CORREAS AUTOMOTRICES', 'RPF5610 (61 Pulgadas)', 'RPF5610 (61 Pulgadas)', '16.58', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF5610', 'BANDO', 'CORREAS'),
(343, 'PRODUCTO', 'RPF5615', 'CORREAS AUTOMOTRICES', 'RPF5615 (61,5 Pulgadas)', 'RPF5615 (61,5 Pulgadas)', '0.00', 'correas_3.png', '', '', 'Pieza', 0, 'NO', 'RPF5615', 'BANDO', 'CORREAS'),
(344, 'PRODUCTO', 'RPF5620', 'CORREAS AUTOMOTRICES', 'RPF5620 (62 Pulgadas)', 'RPF5620 (62 Pulgadas)', '0.00', 'correas_1.png', '', '', 'Pieza', 0, 'NO', 'RPF5620', 'BANDO', 'CORREAS'),
(345, 'PRODUCTO', 'RPF5625', 'CORREAS AUTOMOTRICES', 'RPF5625 (62,5 Pulgadas)', 'RPF5625 (62,5 Pulgadas)', '0.00', 'correas_2.png', '', '', 'Pieza', 0, 'NO', 'RPF5625', 'BANDO', 'CORREAS'),
(346, 'PRODUCTO', 'RPF5650', 'CORREAS AUTOMOTRICES', 'RPF5650 (65 Pulgadas)', 'RPF5650 (65 Pulgadas)', '17.67', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF5650', 'BANDO', 'CORREAS'),
(347, 'PRODUCTO', 'RPF5655', 'CORREAS AUTOMOTRICES', 'RPF5655 (65,5 Pulgadas)', 'RPF5655 (65,5 Pulgadas)', '17.79', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF5655', 'BANDO', 'CORREAS'),
(348, 'PRODUCTO', 'RPF5660', 'CORREAS AUTOMOTRICES', 'RPF5660 (66 Pulgadas)', 'RPF5660 (66 Pulgadas)', '0.00', 'correas_2.png', '', '', 'Pieza', 0, 'NO', 'RPF5660', 'BANDO', 'CORREAS'),
(349, 'PRODUCTO', 'RPF5665', 'CORREAS AUTOMOTRICES', 'RPF5665 (66,5 Pulgadas)', 'RPF5665 (66,5 Pulgadas)', '0.00', 'correas_3.png', '', '', 'Pieza', 0, 'NO', 'RPF5665', 'BANDO', 'CORREAS'),
(350, 'PRODUCTO', 'RPF5670', 'CORREAS AUTOMOTRICES', 'RPF5670 (67 Pulgadas)', 'RPF5670 (67 Pulgadas)', '18.20', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF5670', 'BANDO', 'CORREAS'),
(351, 'PRODUCTO', 'RPF5675', 'CORREAS AUTOMOTRICES', 'RPF5675 (67,5 Pulgadas)', 'RPF5675 (67,5 Pulgadas)', '18.45', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF5675', 'BANDO', 'CORREAS'),
(352, 'PRODUCTO', 'RPF5680', 'CORREAS AUTOMOTRICES', 'RPF5680 (68 Pulgadas)', 'RPF5680 (68 Pulgadas)', '18.48', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF5680', 'BANDO', 'CORREAS'),
(353, 'PRODUCTO', 'RPF5700', 'CORREAS AUTOMOTRICES', 'RPF5700 (70 Pulgadas)', 'RPF5700 (70 Pulgadas)', '19.01', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF5700', 'BANDO', 'CORREAS'),
(354, 'PRODUCTO', 'RPF5710', 'CORREAS AUTOMOTRICES', 'RPF5710 (71 Pulgadas)', 'RPF5710 (71 Pulgadas)', '19.29', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF5710', 'BANDO', 'CORREAS'),
(355, 'PRODUCTO', 'RPF5720', 'CORREAS AUTOMOTRICES', 'RPF5720 (72 Pulgadas)', 'RPF5720 (72 Pulgadas)', '0.00', 'correas_3.png', '', '', 'Pieza', 0, 'NO', 'RPF5720', 'BANDO', 'CORREAS'),
(356, 'PRODUCTO', 'RPF5740', 'CORREAS AUTOMOTRICES', 'RPF5740 (74 Pulgadas)', 'RPF5740 (74 Pulgadas)', '20.10', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF5740', 'BANDO', 'CORREAS'),
(357, 'PRODUCTO', 'RPF5750', 'CORREAS AUTOMOTRICES', 'RPF5750 (75 Pulgadas)', 'RPF5750 (75 Pulgadas)', '20.38', 'correas_2.png', '', '', 'Pieza', 100, 'NO', 'RPF5750', 'BANDO', 'CORREAS'),
(358, 'PRODUCTO', 'RPF5760', 'CORREAS AUTOMOTRICES', 'RPF5760 (76 Pulgadas)', 'RPF5760 (76 Pulgadas)', '20.63', 'correas_3.png', '', '', 'Pieza', 100, 'NO', 'RPF5760', 'BANDO', 'CORREAS'),
(359, 'PRODUCTO', 'RPF5770', 'CORREAS AUTOMOTRICES', 'RPF5770 (77 Pulgadas)', 'RPF5770 (77 Pulgadas)', '20.92', 'correas_1.png', '', '', 'Pieza', 100, 'NO', 'RPF5770', 'BANDO', 'CORREAS'),
(360, 'PRODUCTO', 'MICRO V: 10PK1545', 'CORREAS AUTOMOTRICES', 'MICRO V: 10PK1545 (15,45 Pulgadas)', 'MICRO V: 10PK1545 (15,45 Pulgadas)', '21.62', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '10PK1545', 'BANDO', 'CORREAS'),
(361, 'PRODUCTO', 'MICRO V: 10PK1575', 'CORREAS AUTOMOTRICES', 'MICRO V: 10PK1575 (15,75 Pulgadas)', 'MICRO V: 10PK1575 (15,75 Pulgadas)', '22.83', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '10PK1575', 'BANDO', 'CORREAS'),
(362, 'PRODUCTO', 'MICRO V: 10PK1590', 'CORREAS AUTOMOTRICES', 'MICRO V: 10PK1590 (15,90 Pulgadas)', 'MICRO V: 10PK1590 (15,90 Pulgadas)', '23.18', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '10PK1590', 'BANDO', 'CORREAS'),
(363, 'PRODUCTO', 'MICRO V: 10PK1625', 'CORREAS AUTOMOTRICES', 'MICRO V: 10PK1625 (16,25 Pulgadas)', 'MICRO V: 10PK1625 (16,25 Pulgadas)', '21.22', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '10PK1625', 'BANDO', 'CORREAS'),
(364, 'PRODUCTO', 'MICRO V: 10PK1660', 'CORREAS AUTOMOTRICES', 'MICRO V: 10PK1660 (16,60 Pulgadas)', 'MICRO V: 10PK1660 (16,60 Pulgadas)', '24.06', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '10PK1660', 'BANDO', 'CORREAS'),
(365, 'PRODUCTO', 'MICRO V: 10PK1665', 'CORREAS AUTOMOTRICES', 'MICRO V: 10PK1665 (16,65 Pulgadas)', 'MICRO V: 10PK1665 (16,65 Pulgadas)', '24.13', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '10PK1665', 'BANDO', 'CORREAS'),
(366, 'PRODUCTO', 'MICRO V: 10PK1680', 'CORREAS AUTOMOTRICES', 'MICRO V: 10PK1680 (16,80 Pulgadas)', 'MICRO V: 10PK1680 (16,80 Pulgadas)', '24.35', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '10PK1680', 'BANDO', 'CORREAS'),
(367, 'PRODUCTO', 'MICRO V: 10PK1690', 'CORREAS AUTOMOTRICES', 'MICRO V: 10PK1690 (16,90 Pulgadas)', 'MICRO V: 10PK1690 (16,90 Pulgadas)', '24.48', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '10PK1690', 'BANDO', 'CORREAS'),
(368, 'PRODUCTO', 'MICRO V: 10PK1805', 'CORREAS AUTOMOTRICES', 'MICRO V: 10PK1805 (18,05 Pulgadas)', 'MICRO V: 10PK1805 (18,05 Pulgadas)', '26.16', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '10PK1805', 'BANDO', 'CORREAS'),
(369, 'PRODUCTO', 'MICRO V: 10PK1850', 'CORREAS AUTOMOTRICES', 'MICRO V: 10PK1850 (18,50 Pulgadas)', 'MICRO V: 10PK1850 (18,50 Pulgadas)', '26.88', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '10PK1850', 'BANDO', 'CORREAS'),
(370, 'PRODUCTO', 'MICRO V: 10PK1880', 'CORREAS AUTOMOTRICES', 'MICRO V: 10PK1880 (18,80 Pulgadas)', 'MICRO V: 10PK1880 (18,80 Pulgadas)', '27.30', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '10PK1880', 'BANDO', 'CORREAS'),
(371, 'PRODUCTO', 'MICRO V: 10PK1885', 'CORREAS AUTOMOTRICES', 'MICRO V: 10PK1885 (18,85 Pulgadas)', 'MICRO V: 10PK1885 (18,85 Pulgadas)', '27.39', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '10PK1885', 'BANDO', 'CORREAS'),
(372, 'PRODUCTO', 'MICRO V: 12PK1625', 'CORREAS AUTOMOTRICES', 'MICRO V: 12PK1625 (16,25 Pulgadas)', 'MICRO V: 12PK1625 (16,25 Pulgadas)', '25.45', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '12PK1625', 'BANDO', 'CORREAS'),
(373, 'PRODUCTO', 'MICRO V: 12PK1830', 'CORREAS AUTOMOTRICES', 'MICRO V: 12PK1830 (18,30 Pulgadas)', 'MICRO V: 12PK1830 (18,30 Pulgadas)', '31.80', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '12PK1830', 'BANDO', 'CORREAS'),
(374, 'PRODUCTO', 'MICRO V: 12PK1875', 'CORREAS AUTOMOTRICES', 'MICRO V: 12PK1875 (18,75 Pulgadas)', 'MICRO V: 12PK1875 (18,75 Pulgadas)', '32.62', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '12PK1875', 'BANDO', 'CORREAS'),
(375, 'PRODUCTO', 'MICRO V: 12PK1995', 'CORREAS AUTOMOTRICES', 'MICRO V: 12PK1995 (19,95 Pulgadas)', 'MICRO V: 12PK1995 (19,95 Pulgadas)', '34.69', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '12PK1995', 'BANDO', 'CORREAS'),
(376, 'PRODUCTO', 'MICRO V: 12PK2310', 'CORREAS AUTOMOTRICES', 'MICRO V: 12PK2310 (23,10 Pulgadas)', 'MICRO V: 12PK2310 (23,10 Pulgadas)', '51.12', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '12PK2310', 'BANDO', 'CORREAS'),
(377, 'PRODUCTO', 'MICRO V: 3PK495', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK495 (4,95 Pulgadas)', 'MICRO V: 3PK495 (4,95 Pulgadas)', '3.20', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '3PK495', 'BANDO', 'CORREAS'),
(378, 'PRODUCTO', 'MICRO V: 3PK510', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK510 (5,10 Pulgadas)', 'MICRO V: 3PK510 (5,10 Pulgadas)', '2.83', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '3PK510', 'BANDO', 'CORREAS'),
(379, 'PRODUCTO', 'MICRO V: 3PK555', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK555 (5,55 Pulgadas)', 'MICRO V: 3PK555 (5,55 Pulgadas)', '3.07', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '3PK555', 'BANDO', 'CORREAS'),
(380, 'PRODUCTO', 'MICRO V: 3PK600', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK600 (6,00 Pulgadas)', 'MICRO V: 3PK600 (6,00 Pulgadas)', '3.33', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '3PK600', 'BANDO', 'CORREAS'),
(381, 'PRODUCTO', 'MICRO V: 3PK610', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK610 (6,10 Pulgadas)', 'MICRO V: 3PK610 (6,10 Pulgadas)', '3.38', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '3PK610', 'BANDO', 'CORREAS'),
(382, 'PRODUCTO', 'MICRO V: 3PK630', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK630 (6,30 Pulgadas)', 'MICRO V: 3PK630 (6,30 Pulgadas)', '3.49', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '3PK630', 'BANDO', 'CORREAS'),
(383, 'PRODUCTO', 'MICRO V: 3PK635', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK635 (6,35 Pulgadas)', 'MICRO V: 3PK635 (6,35 Pulgadas)', '3.53', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '3PK635', 'BANDO', 'CORREAS'),
(384, 'PRODUCTO', 'MICRO V: 3PK640', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK640 (6,40 Pulgadas)', 'MICRO V: 3PK640 (6,40 Pulgadas)', '3.53', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '3PK640', 'BANDO', 'CORREAS'),
(385, 'PRODUCTO', 'MICRO V: 3PK645', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK645 (6,45 Pulgadas)', 'MICRO V: 3PK645 (6,45 Pulgadas)', '3.58', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '3PK645', 'BANDO', 'CORREAS'),
(386, 'PRODUCTO', 'MICRO V: 3PK660', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK660 (6,60 Pulgadas)', 'MICRO V: 3PK660 (6,60 Pulgadas)', '3.67', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '3PK660', 'BANDO', 'CORREAS'),
(387, 'PRODUCTO', 'MICRO V: 3PK665', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK665 (6,65 Pulgadas)', 'MICRO V: 3PK665 (6,65 Pulgadas)', '3.73', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '3PK665', 'BANDO', 'CORREAS'),
(388, 'PRODUCTO', 'MICRO V: 3PK670', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK670 (6,70 Pulgadas)', 'MICRO V: 3PK670 (6,70 Pulgadas)', '3.69', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '3PK670', 'BANDO', 'CORREAS'),
(389, 'PRODUCTO', 'MICRO V: 3PK675', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK675 (6,75 Pulgadas)', 'MICRO V: 3PK675 (6,75 Pulgadas)', '3.73', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '3PK675', 'BANDO', 'CORREAS'),
(390, 'PRODUCTO', 'MICRO V: 3PK680', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK680 (6,80 Pulgadas)', 'MICRO V: 3PK680 (6,80 Pulgadas)', '3.75', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '3PK680', 'BANDO', 'CORREAS'),
(391, 'PRODUCTO', 'MICRO V: 3PK685', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK685 (6,85 Pulgadas)', 'MICRO V: 3PK685 (6,85 Pulgadas)', '3.80', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '3PK685', 'BANDO', 'CORREAS'),
(392, 'PRODUCTO', 'MICRO V: 3PK710', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK710 (7,10 Pulgadas)', 'MICRO V: 3PK710 (7,10 Pulgadas)', '3.93', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '3PK710', 'BANDO', 'CORREAS'),
(393, 'PRODUCTO', 'MICRO V: 3PK735', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK735 (7,35 Pulgadas)', 'MICRO V: 3PK735 (7,35 Pulgadas)', '4.06', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '3PK735', 'BANDO', 'CORREAS'),
(394, 'PRODUCTO', 'MICRO V: 3PK750', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK750 (7,50 Pulgadas)', 'MICRO V: 3PK750 (7,50 Pulgadas)', '4.15', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '3PK750', 'BANDO', 'CORREAS'),
(395, 'PRODUCTO', 'MICRO V: 3PK760', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK760 (7,60 Pulgadas)', 'MICRO V: 3PK760 (7,60 Pulgadas)', '4.22', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '3PK760', 'BANDO', 'CORREAS'),
(396, 'PRODUCTO', 'MICRO V: 3PK765', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK765 (7,65 Pulgadas)', 'MICRO V: 3PK765 (7,65 Pulgadas)', '4.24', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '3PK765', 'BANDO', 'CORREAS'),
(397, 'PRODUCTO', 'MICRO V: 3PK775', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK775 (7,75 Pulgadas)', 'MICRO V: 3PK775 (7,75 Pulgadas)', '4.33', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '3PK775', 'BANDO', 'CORREAS'),
(398, 'PRODUCTO', 'MICRO V: 3PK785', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK785 (7,85 Pulgadas)', 'MICRO V: 3PK785 (7,85 Pulgadas)', '4.37', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '3PK785', 'BANDO', 'CORREAS'),
(399, 'PRODUCTO', 'MICRO V: 3PK790', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK790 (7,90 Pulgadas)', 'MICRO V: 3PK790 (7,90 Pulgadas)', '4.37', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '3PK790', 'BANDO', 'CORREAS'),
(400, 'PRODUCTO', 'MICRO V: 3PK805', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK805 (8,05 Pulgadas)', 'MICRO V: 3PK805 (8,05 Pulgadas)', '4.44', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '3PK805', 'BANDO', 'CORREAS'),
(401, 'PRODUCTO', 'MICRO V: 3PK815', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK815 (8,15 Pulgadas)', 'MICRO V: 3PK815 (8,15 Pulgadas)', '4.50', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '3PK815', 'BANDO', 'CORREAS'),
(402, 'PRODUCTO', 'MICRO V: 3PK820', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK820 (8,20 Pulgadas)', 'MICRO V: 3PK820 (8,20 Pulgadas)', '4.13', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '3PK820', 'BANDO', 'CORREAS'),
(403, 'PRODUCTO', 'MICRO V: 3PK830', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK830 (8,30 Pulgadas)', 'MICRO V: 3PK830 (8,30 Pulgadas)', '4.59', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '3PK830', 'BANDO', 'CORREAS'),
(404, 'PRODUCTO', 'MICRO V: 3PK850', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK850 (8,50 Pulgadas)', 'MICRO V: 3PK850 (8,50 Pulgadas)', '4.72', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '3PK850', 'BANDO', 'CORREAS'),
(405, 'PRODUCTO', 'MICRO V: 3PK855', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK855 (8,55 Pulgadas)', 'MICRO V: 3PK855 (8,55 Pulgadas)', '4.75', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '3PK855', 'BANDO', 'CORREAS'),
(406, 'PRODUCTO', 'MICRO V: 3PK860', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK860 (8,60 Pulgadas)', 'MICRO V: 3PK860 (8,60 Pulgadas)', '4.77', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '3PK860', 'BANDO', 'CORREAS'),
(407, 'PRODUCTO', 'MICRO V: 3PK865', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK865 (8,65 Pulgadas)', 'MICRO V: 3PK865 (8,65 Pulgadas)', '4.79', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '3PK865', 'BANDO', 'CORREAS'),
(408, 'PRODUCTO', 'MICRO V: 3PK885', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK885 (8,85 Pulgadas)', 'MICRO V: 3PK885 (8,85 Pulgadas)', '4.88', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '3PK885', 'BANDO', 'CORREAS'),
(409, 'PRODUCTO', 'MICRO V: 3PK890', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK890 (8,90 Pulgadas)', 'MICRO V: 3PK890 (8,90 Pulgadas)', '3.53', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '3PK890', 'BANDO', 'CORREAS'),
(410, 'PRODUCTO', 'MICRO V: 3PK905', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK905 (9,05 Pulgadas)', 'MICRO V: 3PK905 (9,05 Pulgadas)', '5.01', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '3PK905', 'BANDO', 'CORREAS'),
(411, 'PRODUCTO', 'MICRO V: 3PK910', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK910 (9,10 Pulgadas)', 'MICRO V: 3PK910 (9,10 Pulgadas)', '5.08', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '3PK910', 'BANDO', 'CORREAS'),
(412, 'PRODUCTO', 'MICRO V: 3PK925', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK925 (9,25 Pulgadas)', 'MICRO V: 3PK925 (9,25 Pulgadas)', '5.12', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '3PK925', 'BANDO', 'CORREAS'),
(413, 'PRODUCTO', 'MICRO V: 3PK990', 'CORREAS AUTOMOTRICES', 'MICRO V: 3PK990 (9,90 Pulgadas)', 'MICRO V: 3PK990 (9,90 Pulgadas)', '5.50', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '3PK990', 'BANDO', 'CORREAS'),
(414, 'PRODUCTO', 'MICRO V: 4PK1000', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1000 (10,00 Pulgadas)', 'MICRO V: 4PK1000 (10,00 Pulgadas)', '7.37', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1000', 'BANDO', 'CORREAS'),
(415, 'PRODUCTO', 'MICRO V: 4PK1005', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1005 (10,05 Pulgadas)', 'MICRO V: 4PK1005 (10,05 Pulgadas)', '7.41', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1005', 'BANDO', 'CORREAS'),
(416, 'PRODUCTO', 'MICRO V: 4PK1010', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1010 (10,10 Pulgadas)', 'MICRO V: 4PK1010 (10,10 Pulgadas)', '7.46', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1010', 'BANDO', 'CORREAS'),
(417, 'PRODUCTO', 'MICRO V: 4PK1015', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1015 (10,15 Pulgadas)', 'MICRO V: 4PK1015 (10,15 Pulgadas)', '7.48', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1015', 'BANDO', 'CORREAS'),
(418, 'PRODUCTO', 'MICRO V: 4PK1020', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1020 (10,20 Pulgadas)', 'MICRO V: 4PK1020 (10,20 Pulgadas)', '7.50', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1020', 'BANDO', 'CORREAS'),
(419, 'PRODUCTO', 'MICRO V: 4PK1030', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1030 (10,30 Pulgadas)', 'MICRO V: 4PK1030 (10,30 Pulgadas)', '7.59', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1030', 'BANDO', 'CORREAS'),
(420, 'PRODUCTO', 'MICRO V: 4PK1035', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1035 (10,35 Pulgadas)', 'MICRO V: 4PK1035 (10,35 Pulgadas)', '7.63', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1035', 'BANDO', 'CORREAS'),
(421, 'PRODUCTO', 'MICRO V: 4PK1040', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1040 (10,40 Pulgadas)', 'MICRO V: 4PK1040 (10,40 Pulgadas)', '7.68', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1040', 'BANDO', 'CORREAS'),
(422, 'PRODUCTO', 'MICRO V: 4PK1045', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1045 (10,45 Pulgadas)', 'MICRO V: 4PK1045 (10,45 Pulgadas)', '7.72', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1045', 'BANDO', 'CORREAS'),
(423, 'PRODUCTO', 'MICRO V: 4PK1050', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1050 (10,50 Pulgadas)', 'MICRO V: 4PK1050 (10,50 Pulgadas)', '7.74', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1050', 'BANDO', 'CORREAS'),
(424, 'PRODUCTO', 'MICRO V: 4PK1055', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1055 (10,55 Pulgadas)', 'MICRO V: 4PK1055 (10,55 Pulgadas)', '7.79', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1055', 'BANDO', 'CORREAS'),
(425, 'PRODUCTO', 'MICRO V: 4PK1060', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1060 (10,60 Pulgadas)', 'MICRO V: 4PK1060 (10,60 Pulgadas)', '7.83', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1060', 'BANDO', 'CORREAS'),
(426, 'PRODUCTO', 'MICRO V: 4PK1065', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1065 (10,65 Pulgadas)', 'MICRO V: 4PK1065 (10,65 Pulgadas)', '7.85', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1065', 'BANDO', 'CORREAS'),
(427, 'PRODUCTO', 'MICRO V: 4PK1070', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1070 (10,70 Pulgadas)', 'MICRO V: 4PK1070 (10,70 Pulgadas)', '7.90', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1070', 'BANDO', 'CORREAS'),
(428, 'PRODUCTO', 'MICRO V: 4PK1075', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1075 (10,75 Pulgadas)', 'MICRO V: 4PK1075 (10,75 Pulgadas)', '7.92', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1075', 'BANDO', 'CORREAS'),
(429, 'PRODUCTO', 'MICRO V: 4PK1080', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1080 (10,80 Pulgadas)', 'MICRO V: 4PK1080 (10,80 Pulgadas)', '7.97', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1080', 'BANDO', 'CORREAS'),
(430, 'PRODUCTO', 'MICRO V: 4PK1085', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1085 (10,85 Pulgadas)', 'MICRO V: 4PK1085 (10,85 Pulgadas)', '8.01', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1085', 'BANDO', 'CORREAS'),
(431, 'PRODUCTO', 'MICRO V: 4PK1090', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1090 (10,90 Pulgadas)', 'MICRO V: 4PK1090 (10,90 Pulgadas)', '8.05', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1090', 'BANDO', 'CORREAS'),
(432, 'PRODUCTO', 'MICRO V: 4PK1095', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1095 (10,95 Pulgadas)', 'MICRO V: 4PK1095 (10,95 Pulgadas)', '8.08', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1095', 'BANDO', 'CORREAS'),
(433, 'PRODUCTO', 'MICRO V: 4PK1100', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1100 (11,00 Pulgadas)', 'MICRO V: 4PK1100 (11,00 Pulgadas)', '8.12', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1100', 'BANDO', 'CORREAS'),
(434, 'PRODUCTO', 'MICRO V: 4PK1105', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1105 (11,05 Pulgadas)', 'MICRO V: 4PK1105 (11,05 Pulgadas)', '8.14', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1105', 'BANDO', 'CORREAS'),
(435, 'PRODUCTO', 'MICRO V: 4PK1110', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1110 (11,10 Pulgadas)', 'MICRO V: 4PK1110 (11,10 Pulgadas)', '8.19', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1110', 'BANDO', 'CORREAS'),
(436, 'PRODUCTO', 'MICRO V: 4PK1115', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1115 (11,15 Pulgadas)', 'MICRO V: 4PK1115 (11,15 Pulgadas)', '8.23', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1115', 'BANDO', 'CORREAS'),
(437, 'PRODUCTO', 'MICRO V: 4PK1120', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1120 (11,20 Pulgadas)', 'MICRO V: 4PK1120 (11,20 Pulgadas)', '8.27', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1120', 'BANDO', 'CORREAS'),
(438, 'PRODUCTO', 'MICRO V: 4PK1125', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1125 (11,25 Pulgadas)', 'MICRO V: 4PK1125 (11,25 Pulgadas)', '8.30', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1125', 'BANDO', 'CORREAS'),
(439, 'PRODUCTO', 'MICRO V: 4PK1130', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1130 (11,30 Pulgadas)', 'MICRO V: 4PK1130 (11,30 Pulgadas)', '8.34', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1130', 'BANDO', 'CORREAS'),
(440, 'PRODUCTO', 'MICRO V: 4PK1135', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1135 (11,35 Pulgadas)', 'MICRO V: 4PK1135 (11,35 Pulgadas)', '8.38', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1135', 'BANDO', 'CORREAS'),
(441, 'PRODUCTO', 'MICRO V: 4PK1145', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1145 (11,45 Pulgadas)', 'MICRO V: 4PK1145 (11,45 Pulgadas)', '8.45', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1145', 'BANDO', 'CORREAS'),
(442, 'PRODUCTO', 'MICRO V: 4PK1155', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1155 (11,55 Pulgadas)', 'MICRO V: 4PK1155 (11,55 Pulgadas)', '8.52', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1155', 'BANDO', 'CORREAS'),
(443, 'PRODUCTO', 'MICRO V: 4PK1160', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1160 (11,60 Pulgadas)', 'MICRO V: 4PK1160 (11,60 Pulgadas)', '8.56', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1160', 'BANDO', 'CORREAS'),
(444, 'PRODUCTO', 'MICRO V: 4PK1170', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1170 (11,70 Pulgadas)', 'MICRO V: 4PK1170 (11,70 Pulgadas)', '8.63', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1170', 'BANDO', 'CORREAS'),
(445, 'PRODUCTO', 'MICRO V: 4PK1175', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1175 (11,75 Pulgadas)', 'MICRO V: 4PK1175 (11,75 Pulgadas)', '8.67', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1175', 'BANDO', 'CORREAS'),
(446, 'PRODUCTO', 'MICRO V: 4PK1180', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1180 (11,80 Pulgadas)', 'MICRO V: 4PK1180 (11,80 Pulgadas)', '8.69', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1180', 'BANDO', 'CORREAS'),
(447, 'PRODUCTO', 'MICRO V: 4PK1185', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1185 (11,85 Pulgadas)', 'MICRO V: 4PK1185 (11,85 Pulgadas)', '8.76', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1185', 'BANDO', 'CORREAS'),
(448, 'PRODUCTO', 'MICRO V: 4PK1195', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1195 (11,95 Pulgadas)', 'MICRO V: 4PK1195 (11,95 Pulgadas)', '8.82', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1195', 'BANDO', 'CORREAS'),
(449, 'PRODUCTO', 'MICRO V: 4PK1200', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1200 (12,00 Pulgadas)', 'MICRO V: 4PK1200 (12,00 Pulgadas)', '8.85', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1200', 'BANDO', 'CORREAS'),
(450, 'PRODUCTO', 'MICRO V: 4PK1205', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1205 (12,05 Pulgadas)', 'MICRO V: 4PK1205 (12,05 Pulgadas)', '8.91', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1205', 'BANDO', 'CORREAS'),
(451, 'PRODUCTO', 'MICRO V: 4PK1210', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1210 (12,10 Pulgadas)', 'MICRO V: 4PK1210 (12,10 Pulgadas)', '8.94', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1210', 'BANDO', 'CORREAS'),
(452, 'PRODUCTO', 'MICRO V: 4PK1215', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1215 (12,15 Pulgadas)', 'MICRO V: 4PK1215 (12,15 Pulgadas)', '8.98', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1215', 'BANDO', 'CORREAS'),
(453, 'PRODUCTO', 'MICRO V: 4PK1220', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1220 (12,20 Pulgadas)', 'MICRO V: 4PK1220 (12,20 Pulgadas)', '9.00', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1220', 'BANDO', 'CORREAS'),
(454, 'PRODUCTO', 'MICRO V: 4PK1225', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1225 (12,25 Pulgadas)', 'MICRO V: 4PK1225 (12,25 Pulgadas)', '9.05', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1225', 'BANDO', 'CORREAS'),
(455, 'PRODUCTO', 'MICRO V: 4PK1230', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1230 (12,30 Pulgadas)', 'MICRO V: 4PK1230 (12,30 Pulgadas)', '9.09', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1230', 'BANDO', 'CORREAS'),
(456, 'PRODUCTO', 'MICRO V: 4PK1240', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1240 (12,40 Pulgadas)', 'MICRO V: 4PK1240 (12,40 Pulgadas)', '9.13', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1240', 'BANDO', 'CORREAS'),
(457, 'PRODUCTO', 'MICRO V: 4PK1245', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1245 (12,45 Pulgadas)', 'MICRO V: 4PK1245 (12,45 Pulgadas)', '9.18', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1245', 'BANDO', 'CORREAS'),
(458, 'PRODUCTO', 'MICRO V: 4PK1255', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1255 (12,55 Pulgadas)', 'MICRO V: 4PK1255 (12,55 Pulgadas)', '9.27', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1255', 'BANDO', 'CORREAS'),
(459, 'PRODUCTO', 'MICRO V: 4PK1260', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1260 (12,60 Pulgadas)', 'MICRO V: 4PK1260 (12,60 Pulgadas)', '9.31', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1260', 'BANDO', 'CORREAS'),
(460, 'PRODUCTO', 'MICRO V: 4PK1270', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1270 (12,70 Pulgadas)', 'MICRO V: 4PK1270 (12,70 Pulgadas)', '9.35', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1270', 'BANDO', 'CORREAS'),
(461, 'PRODUCTO', 'MICRO V: 4PK1285', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1285 (12,85 Pulgadas)', 'MICRO V: 4PK1285 (12,85 Pulgadas)', '9.46', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1285', 'BANDO', 'CORREAS'),
(462, 'PRODUCTO', 'MICRO V: 4PK1290', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1290 (12,90 Pulgadas)', 'MICRO V: 4PK1290 (12,90 Pulgadas)', '9.53', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1290', 'BANDO', 'CORREAS'),
(463, 'PRODUCTO', 'MICRO V: 4PK1295', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1295 (12,95 Pulgadas)', 'MICRO V: 4PK1295 (12,95 Pulgadas)', '9.57', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1295', 'BANDO', 'CORREAS'),
(464, 'PRODUCTO', 'MICRO V: 4PK1300', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1300 (13,00 Pulgadas)', 'MICRO V: 4PK1300 (13,00 Pulgadas)', '9.60', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1300', 'BANDO', 'CORREAS'),
(465, 'PRODUCTO', 'MICRO V: 4PK1305', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1305 (13,05 Pulgadas)', 'MICRO V: 4PK1305 (13,05 Pulgadas)', '9.62', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1305', 'BANDO', 'CORREAS'),
(466, 'PRODUCTO', 'MICRO V: 4PK1310', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1310 (13,10 Pulgadas)', 'MICRO V: 4PK1310 (13,10 Pulgadas)', '9.66', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1310', 'BANDO', 'CORREAS'),
(467, 'PRODUCTO', 'MICRO V: 4PK1315', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1315 (13,15 Pulgadas)', 'MICRO V: 4PK1315 (13,15 Pulgadas)', '9.71', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1315', 'BANDO', 'CORREAS'),
(468, 'PRODUCTO', 'MICRO V: 4PK1320', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1320 (13,20 Pulgadas)', 'MICRO V: 4PK1320 (13,20 Pulgadas)', '9.75', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1320', 'BANDO', 'CORREAS'),
(469, 'PRODUCTO', 'MICRO V: 4PK1335', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1335 (13,35 Pulgadas)', 'MICRO V: 4PK1335 (13,35 Pulgadas)', '9.84', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1335', 'BANDO', 'CORREAS'),
(470, 'PRODUCTO', 'MICRO V: 4PK1345', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1345 (13,45 Pulgadas)', 'MICRO V: 4PK1345 (13,45 Pulgadas)', '9.93', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1345', 'BANDO', 'CORREAS'),
(471, 'PRODUCTO', 'MICRO V: 4PK1355', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1355 (13,55 Pulgadas)', 'MICRO V: 4PK1355 (13,55 Pulgadas)', '9.99', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1355', 'BANDO', 'CORREAS'),
(472, 'PRODUCTO', 'MICRO V: 4PK1360', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1360 (13,60 Pulgadas)', 'MICRO V: 4PK1360 (13,60 Pulgadas)', '10.02', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1360', 'BANDO', 'CORREAS'),
(473, 'PRODUCTO', 'MICRO V: 4PK1385', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1385 (13,85 Pulgadas)', 'MICRO V: 4PK1385 (13,85 Pulgadas)', '10.21', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1385', 'BANDO', 'CORREAS'),
(474, 'PRODUCTO', 'MICRO V: 4PK1395', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1395 (13,95 Pulgadas)', 'MICRO V: 4PK1395 (13,95 Pulgadas)', '9.31', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1395', 'BANDO', 'CORREAS'),
(475, 'PRODUCTO', 'MICRO V: 4PK1400', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1400 (14,00 Pulgadas)', 'MICRO V: 4PK1400 (14,00 Pulgadas)', '10.32', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1400', 'BANDO', 'CORREAS'),
(476, 'PRODUCTO', 'MICRO V: 4PK1413', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1413 (14,13 Pulgadas)', 'MICRO V: 4PK1413 (14,13 Pulgadas)', '10.43', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1413', 'BANDO', 'CORREAS'),
(477, 'PRODUCTO', 'MICRO V: 4PK1420', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1420 (14,20 Pulgadas)', 'MICRO V: 4PK1420 (14,20 Pulgadas)', '10.39', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1420', 'BANDO', 'CORREAS'),
(478, 'PRODUCTO', 'MICRO V: 4PK1425', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1425 (14,25 Pulgadas)', 'MICRO V: 4PK1425 (14,25 Pulgadas)', '10.52', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1425', 'BANDO', 'CORREAS'),
(479, 'PRODUCTO', 'MICRO V: 4PK1435', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1435 (14,35 Pulgadas)', 'MICRO V: 4PK1435 (14,35 Pulgadas)', '10.59', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1435', 'BANDO', 'CORREAS'),
(480, 'PRODUCTO', 'MICRO V: 4PK1440', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1440 (14,40 Pulgadas)', 'MICRO V: 4PK1440 (14,40 Pulgadas)', '10.63', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1440', 'BANDO', 'CORREAS'),
(481, 'PRODUCTO', 'MICRO V: 4PK1460', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1460 (14,60 Pulgadas)', 'MICRO V: 4PK1460 (14,60 Pulgadas)', '10.79', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1460', 'BANDO', 'CORREAS'),
(482, 'PRODUCTO', 'MICRO V: 4PK1510', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1510 (15,10 Pulgadas)', 'MICRO V: 4PK1510 (15,10 Pulgadas)', '11.14', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1510', 'BANDO', 'CORREAS'),
(483, 'PRODUCTO', 'MICRO V: 4PK1525', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1525 (15,25 Pulgadas)', 'MICRO V: 4PK1525 (15,25 Pulgadas)', '11.27', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1525', 'BANDO', 'CORREAS'),
(484, 'PRODUCTO', 'MICRO V: 4PK1535', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1535 (15,35 Pulgadas)', 'MICRO V: 4PK1535 (15,35 Pulgadas)', '11.34', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1535', 'BANDO', 'CORREAS'),
(485, 'PRODUCTO', 'MICRO V: 4PK1540', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1540 (15,40 Pulgadas)', 'MICRO V: 4PK1540 (15,40 Pulgadas)', '11.40', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1540', 'BANDO', 'CORREAS'),
(486, 'PRODUCTO', 'MICRO V: 4PK1550', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1550 (15,50 Pulgadas)', 'MICRO V: 4PK1550 (15,50 Pulgadas)', '11.43', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1550', 'BANDO', 'CORREAS'),
(487, 'PRODUCTO', 'MICRO V: 4PK1560', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1560 (15,60 Pulgadas)', 'MICRO V: 4PK1560 (15,60 Pulgadas)', '9.05', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1560', 'BANDO', 'CORREAS'),
(488, 'PRODUCTO', 'MICRO V: 4PK1600', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1600 (16,00 Pulgadas)', 'MICRO V: 4PK1600 (16,00 Pulgadas)', '9.16', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1600', 'BANDO', 'CORREAS'),
(489, 'PRODUCTO', 'MICRO V: 4PK1615', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1615 (16,15 Pulgadas)', 'MICRO V: 4PK1615 (16,15 Pulgadas)', '9.35', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1615', 'BANDO', 'CORREAS');
INSERT INTO `sspi_productos` (`ID_PRODUCTO`, `TIPO_PRODUCTO_SERVICIO`, `NOMBRE_PRODUCTO`, `NOMBRE_CATEGORIA`, `DESCRIPCION_CORTA`, `DESCRIPCION_LARGA`, `PRECIO_UNITARIO_DOLARES`, `FOTO_1_CARRUSEL`, `FOTO_2_CORTA`, `FOTO_3_LARGA`, `UNIDAD_DE_VENTA`, `CANTIDAD_DISPONIBLE`, `DESTACADO`, `CODIGO`, `MARCA`, `RUBRO`) VALUES
(490, 'PRODUCTO', 'MICRO V: 4PK1625', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1625 (16,25 Pulgadas)', 'MICRO V: 4PK1625 (16,25 Pulgadas)', '9.40', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1625', 'BANDO', 'CORREAS'),
(491, 'PRODUCTO', 'MICRO V: 4PK1640', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1640 (16,40 Pulgadas)', 'MICRO V: 4PK1640 (16,40 Pulgadas)', '9.51', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1640', 'BANDO', 'CORREAS'),
(492, 'PRODUCTO', 'MICRO V: 4PK1645', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1645 (16,45 Pulgadas)', 'MICRO V: 4PK1645 (16,45 Pulgadas)', '9.53', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK1645', 'BANDO', 'CORREAS'),
(493, 'PRODUCTO', 'MICRO V: 4PK1675', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1675 (16,75 Pulgadas)', 'MICRO V: 4PK1675 (16,75 Pulgadas)', '10.30', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK1675', 'BANDO', 'CORREAS'),
(494, 'PRODUCTO', 'MICRO V: 4PK1685', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK1685 (16,85 Pulgadas)', 'MICRO V: 4PK1685 (16,85 Pulgadas)', '10.57', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK1685', 'BANDO', 'CORREAS'),
(495, 'PRODUCTO', 'MICRO V: 4PK540', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK540 (5,40 Pulgadas)', 'MICRO V: 4PK540 (5,40 Pulgadas)', '4.00', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK540', 'BANDO', 'CORREAS'),
(496, 'PRODUCTO', 'MICRO V: 4PK555', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK555 (5,55 Pulgadas)', 'MICRO V: 4PK555 (5,55 Pulgadas)', '4.08', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK555', 'BANDO', 'CORREAS'),
(497, 'PRODUCTO', 'MICRO V: 4PK585', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK585 (5,85 Pulgadas)', 'MICRO V: 4PK585 (5,85 Pulgadas)', '4.33', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK585', 'BANDO', 'CORREAS'),
(498, 'PRODUCTO', 'MICRO V: 4PK590', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK590 (5,90 Pulgadas)', 'MICRO V: 4PK590 (5,90 Pulgadas)', '4.37', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK590', 'BANDO', 'CORREAS'),
(499, 'PRODUCTO', 'MICRO V: 4PK605', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK605 (6,05 Pulgadas)', 'MICRO V: 4PK605 (6,05 Pulgadas)', '4.46', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK605', 'BANDO', 'CORREAS'),
(500, 'PRODUCTO', 'MICRO V: 4PK610', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK610 (6,10 Pulgadas)', 'MICRO V: 4PK610 (6,10 Pulgadas)', '4.50', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK610', 'BANDO', 'CORREAS'),
(501, 'PRODUCTO', 'MICRO V: 4PK630', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK630 (6,30 Pulgadas)', 'MICRO V: 4PK630 (6,30 Pulgadas)', '4.66', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK630', 'BANDO', 'CORREAS'),
(502, 'PRODUCTO', 'MICRO V: 4PK635', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK635 (6,35 Pulgadas)', 'MICRO V: 4PK635 (6,35 Pulgadas)', '4.70', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK635', 'BANDO', 'CORREAS'),
(503, 'PRODUCTO', 'MICRO V: 4PK640', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK640 (6,40 Pulgadas)', 'MICRO V: 4PK640 (6,40 Pulgadas)', '4.72', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK640', 'BANDO', 'CORREAS'),
(504, 'PRODUCTO', 'MICRO V: 4PK645', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK645 (6,45 Pulgadas)', 'MICRO V: 4PK645 (6,45 Pulgadas)', '4.77', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK645', 'BANDO', 'CORREAS'),
(505, 'PRODUCTO', 'MICRO V: 4PK650', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK650 (6,50 Pulgadas)', 'MICRO V: 4PK650 (6,50 Pulgadas)', '4.79', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK650', 'BANDO', 'CORREAS'),
(506, 'PRODUCTO', 'MICRO V: 4PK660', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK660 (6,60 Pulgadas)', 'MICRO V: 4PK660 (6,60 Pulgadas)', '4.86', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK660', 'BANDO', 'CORREAS'),
(507, 'PRODUCTO', 'MICRO V: 4PK665', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK665 (6,65 Pulgadas)', 'MICRO V: 4PK665 (6,65 Pulgadas)', '4.92', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK665', 'BANDO', 'CORREAS'),
(508, 'PRODUCTO', 'MICRO V: 4PK675', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK675 (6,75 Pulgadas)', 'MICRO V: 4PK675 (6,75 Pulgadas)', '4.99', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK675', 'BANDO', 'CORREAS'),
(509, 'PRODUCTO', 'MICRO V: 4PK685', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK685 (6,85 Pulgadas)', 'MICRO V: 4PK685 (6,85 Pulgadas)', '5.08', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK685', 'BANDO', 'CORREAS'),
(510, 'PRODUCTO', 'MICRO V: 4PK690', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK690 (6,90 Pulgadas)', 'MICRO V: 4PK690 (6,90 Pulgadas)', '5.10', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK690', 'BANDO', 'CORREAS'),
(511, 'PRODUCTO', 'MICRO V: 4PK695', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK695 (6,95 Pulgadas)', 'MICRO V: 4PK695 (6,95 Pulgadas)', '5.12', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK695', 'BANDO', 'CORREAS'),
(512, 'PRODUCTO', 'MICRO V: 4PK700', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK700 (7,00 Pulgadas)', 'MICRO V: 4PK700 (7,00 Pulgadas)', '5.19', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK700', 'BANDO', 'CORREAS'),
(513, 'PRODUCTO', 'MICRO V: 4PK705', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK705 (7,05 Pulgadas)', 'MICRO V: 4PK705 (7,05 Pulgadas)', '5.21', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK705', 'BANDO', 'CORREAS'),
(514, 'PRODUCTO', 'MICRO V: 4PK710', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK710 (7,10 Pulgadas)', 'MICRO V: 4PK710 (7,10 Pulgadas)', '5.25', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK710', 'BANDO', 'CORREAS'),
(515, 'PRODUCTO', 'MICRO V: 4PK720', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK720 (7,20 Pulgadas)', 'MICRO V: 4PK720 (7,20 Pulgadas)', '5.30', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK720', 'BANDO', 'CORREAS'),
(516, 'PRODUCTO', 'MICRO V: 4PK725', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK725 (7,25 Pulgadas)', 'MICRO V: 4PK725 (7,25 Pulgadas)', '5.34', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK725', 'BANDO', 'CORREAS'),
(517, 'PRODUCTO', 'MICRO V: 4PK735', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK735 (7,35 Pulgadas)', 'MICRO V: 4PK735 (7,35 Pulgadas)', '5.41', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK735', 'BANDO', 'CORREAS'),
(518, 'PRODUCTO', 'MICRO V: 4PK740', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK740 (7,40 Pulgadas)', 'MICRO V: 4PK740 (7,40 Pulgadas)', '5.45', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK740', 'BANDO', 'CORREAS'),
(519, 'PRODUCTO', 'MICRO V: 4PK750', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK750 (7,50 Pulgadas)', 'MICRO V: 4PK750 (7,50 Pulgadas)', '5.54', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK750', 'BANDO', 'CORREAS'),
(520, 'PRODUCTO', 'MICRO V: 4PK760', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK760 (7,60 Pulgadas)', 'MICRO V: 4PK760 (7,60 Pulgadas)', '5.63', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK760', 'BANDO', 'CORREAS'),
(521, 'PRODUCTO', 'MICRO V: 4PK765', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK765 (7,65 Pulgadas)', 'MICRO V: 4PK765 (7,65 Pulgadas)', '5.63', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK765', 'BANDO', 'CORREAS'),
(522, 'PRODUCTO', 'MICRO V: 4PK770', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK770 (7,70 Pulgadas)', 'MICRO V: 4PK770 (7,70 Pulgadas)', '5.69', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK770', 'BANDO', 'CORREAS'),
(523, 'PRODUCTO', 'MICRO V: 4PK775', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK775 (7,75 Pulgadas)', 'MICRO V: 4PK775 (7,75 Pulgadas)', '5.72', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK775', 'BANDO', 'CORREAS'),
(524, 'PRODUCTO', 'MICRO V: 4PK780', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK780 (7,80 Pulgadas)', 'MICRO V: 4PK780 (7,80 Pulgadas)', '5.76', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK780', 'BANDO', 'CORREAS'),
(525, 'PRODUCTO', 'MICRO V: 4PK785', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK785 (7,85 Pulgadas)', 'MICRO V: 4PK785 (7,85 Pulgadas)', '5.78', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK785', 'BANDO', 'CORREAS'),
(526, 'PRODUCTO', 'MICRO V: 4PK790', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK790 (7,90 Pulgadas)', 'MICRO V: 4PK790 (7,90 Pulgadas)', '5.83', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK790', 'BANDO', 'CORREAS'),
(527, 'PRODUCTO', 'MICRO V: 4PK795', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK795 (7,95 Pulgadas)', 'MICRO V: 4PK795 (7,95 Pulgadas)', '5.87', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK795', 'BANDO', 'CORREAS'),
(528, 'PRODUCTO', 'MICRO V: 4PK800', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK800 (8,00 Pulgadas)', 'MICRO V: 4PK800 (8,00 Pulgadas)', '5.91', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK800', 'BANDO', 'CORREAS'),
(529, 'PRODUCTO', 'MICRO V: 4PK805', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK805 (8,05 Pulgadas)', 'MICRO V: 4PK805 (8,05 Pulgadas)', '5.94', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK805', 'BANDO', 'CORREAS'),
(530, 'PRODUCTO', 'MICRO V: 4PK810', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK810 (8,10 Pulgadas)', 'MICRO V: 4PK810 (8,10 Pulgadas)', '5.98', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK810', 'BANDO', 'CORREAS'),
(531, 'PRODUCTO', 'MICRO V: 4PK815', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK815 (8,15 Pulgadas)', 'MICRO V: 4PK815 (8,15 Pulgadas)', '6.02', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK815', 'BANDO', 'CORREAS'),
(532, 'PRODUCTO', 'MICRO V: 4PK820', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK820 (8,20 Pulgadas)', 'MICRO V: 4PK820 (8,20 Pulgadas)', '6.05', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK820', 'BANDO', 'CORREAS'),
(533, 'PRODUCTO', 'MICRO V: 4PK825', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK825 (8,25 Pulgadas)', 'MICRO V: 4PK825 (8,25 Pulgadas)', '6.09', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK825', 'BANDO', 'CORREAS'),
(534, 'PRODUCTO', 'MICRO V: 4PK830', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK830 (8,30 Pulgadas)', 'MICRO V: 4PK830 (8,30 Pulgadas)', '6.11', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK830', 'BANDO', 'CORREAS'),
(535, 'PRODUCTO', 'MICRO V: 4PK835', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK835 (8,35 Pulgadas)', 'MICRO V: 4PK835 (8,35 Pulgadas)', '6.22', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK835', 'BANDO', 'CORREAS'),
(536, 'PRODUCTO', 'MICRO V: 4PK840', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK840 (8,40 Pulgadas)', 'MICRO V: 4PK840 (8,40 Pulgadas)', '6.20', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK840', 'BANDO', 'CORREAS'),
(537, 'PRODUCTO', 'MICRO V: 4PK845', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK845 (8,45 Pulgadas)', 'MICRO V: 4PK845 (8,45 Pulgadas)', '6.25', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK845', 'BANDO', 'CORREAS'),
(538, 'PRODUCTO', 'MICRO V: 4PK850', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK850 (8,50 Pulgadas)', 'MICRO V: 4PK850 (8,50 Pulgadas)', '6.27', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK850', 'BANDO', 'CORREAS'),
(539, 'PRODUCTO', 'MICRO V: 4PK855', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK855 (8,55 Pulgadas)', 'MICRO V: 4PK855 (8,55 Pulgadas)', '6.31', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK855', 'BANDO', 'CORREAS'),
(540, 'PRODUCTO', 'MICRO V: 4PK860', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK860 (8,60 Pulgadas)', 'MICRO V: 4PK860 (8,60 Pulgadas)', '6.36', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK860', 'BANDO', 'CORREAS'),
(541, 'PRODUCTO', 'MICRO V: 4PK865', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK865 (8,65 Pulgadas)', 'MICRO V: 4PK865 (8,65 Pulgadas)', '6.40', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK865', 'BANDO', 'CORREAS'),
(542, 'PRODUCTO', 'MICRO V: 4PK870', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK870 (8,70 Pulgadas)', 'MICRO V: 4PK870 (8,70 Pulgadas)', '6.42', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK870', 'BANDO', 'CORREAS'),
(543, 'PRODUCTO', 'MICRO V: 4PK875', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK875 (8,75 Pulgadas)', 'MICRO V: 4PK875 (8,75 Pulgadas)', '6.47', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK875', 'BANDO', 'CORREAS'),
(544, 'PRODUCTO', 'MICRO V: 4PK880', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK880 (8,80 Pulgadas)', 'MICRO V: 4PK880 (8,80 Pulgadas)', '6.49', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK880', 'BANDO', 'CORREAS'),
(545, 'PRODUCTO', 'MICRO V: 4PK885', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK885 (8,85 Pulgadas)', 'MICRO V: 4PK885 (8,85 Pulgadas)', '6.53', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK885', 'BANDO', 'CORREAS'),
(546, 'PRODUCTO', 'MICRO V: 4PK890', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK890 (8,90 Pulgadas)', 'MICRO V: 4PK890 (8,90 Pulgadas)', '6.58', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK890', 'BANDO', 'CORREAS'),
(547, 'PRODUCTO', 'MICRO V: 4PK895', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK895 (8,95 Pulgadas)', 'MICRO V: 4PK895 (8,95 Pulgadas)', '6.60', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK895', 'BANDO', 'CORREAS'),
(548, 'PRODUCTO', 'MICRO V: 4PK900', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK900 (9,00 Pulgadas)', 'MICRO V: 4PK900 (9,00 Pulgadas)', '6.64', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK900', 'BANDO', 'CORREAS'),
(549, 'PRODUCTO', 'MICRO V: 4PK905', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK905 (9,05 Pulgadas)', 'MICRO V: 4PK905 (9,05 Pulgadas)', '6.09', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK905', 'BANDO', 'CORREAS'),
(550, 'PRODUCTO', 'MICRO V: 4PK910', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK910 (9,10 Pulgadas)', 'MICRO V: 4PK910 (9,10 Pulgadas)', '6.73', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK910', 'BANDO', 'CORREAS'),
(551, 'PRODUCTO', 'MICRO V: 4PK915', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK915 (9,15 Pulgadas)', 'MICRO V: 4PK915 (9,15 Pulgadas)', '6.75', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK915', 'BANDO', 'CORREAS'),
(552, 'PRODUCTO', 'MICRO V: 4PK920', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK920 (9,20 Pulgadas)', 'MICRO V: 4PK920 (9,20 Pulgadas)', '6.80', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK920', 'BANDO', 'CORREAS'),
(553, 'PRODUCTO', 'MICRO V: 4PK925', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK925 (9,25 Pulgadas)', 'MICRO V: 4PK925 (9,25 Pulgadas)', '6.82', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK925', 'BANDO', 'CORREAS'),
(554, 'PRODUCTO', 'MICRO V: 4PK930', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK930 (9,30 Pulgadas)', 'MICRO V: 4PK930 (9,30 Pulgadas)', '6.88', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK930', 'BANDO', 'CORREAS'),
(555, 'PRODUCTO', 'MICRO V: 4PK935', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK935 (9,35 Pulgadas)', 'MICRO V: 4PK935 (9,35 Pulgadas)', '6.91', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK935', 'BANDO', 'CORREAS'),
(556, 'PRODUCTO', 'MICRO V: 4PK940', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK940 (9,40 Pulgadas)', 'MICRO V: 4PK940 (9,40 Pulgadas)', '6.95', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK940', 'BANDO', 'CORREAS'),
(557, 'PRODUCTO', 'MICRO V: 4PK945', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK945 (9,45 Pulgadas)', 'MICRO V: 4PK945 (9,45 Pulgadas)', '6.95', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK945', 'BANDO', 'CORREAS'),
(558, 'PRODUCTO', 'MICRO V: 4PK950', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK950 (9,50 Pulgadas)', 'MICRO V: 4PK950 (9,50 Pulgadas)', '7.02', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK950', 'BANDO', 'CORREAS'),
(559, 'PRODUCTO', 'MICRO V: 4PK955', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK955 (9,55 Pulgadas)', 'MICRO V: 4PK955 (9,55 Pulgadas)', '7.06', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK955', 'BANDO', 'CORREAS'),
(560, 'PRODUCTO', 'MICRO V: 4PK960', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK960 (9,60 Pulgadas)', 'MICRO V: 4PK960 (9,60 Pulgadas)', '7.08', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK960', 'BANDO', 'CORREAS'),
(561, 'PRODUCTO', 'MICRO V: 4PK965', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK965 (9,65 Pulgadas)', 'MICRO V: 4PK965 (9,65 Pulgadas)', '7.13', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK965', 'BANDO', 'CORREAS'),
(562, 'PRODUCTO', 'MICRO V: 4PK970', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK970 (9,70 Pulgadas)', 'MICRO V: 4PK970 (9,70 Pulgadas)', '7.17', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK970', 'BANDO', 'CORREAS'),
(563, 'PRODUCTO', 'MICRO V: 4PK975', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK975 (9,75 Pulgadas)', 'MICRO V: 4PK975 (9,75 Pulgadas)', '7.17', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK975', 'BANDO', 'CORREAS'),
(564, 'PRODUCTO', 'MICRO V: 4PK980', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK980 (9,80 Pulgadas)', 'MICRO V: 4PK980 (9,80 Pulgadas)', '7.24', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK980', 'BANDO', 'CORREAS'),
(565, 'PRODUCTO', 'MICRO V: 4PK985', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK985 (9,85 Pulgadas)', 'MICRO V: 4PK985 (9,85 Pulgadas)', '7.28', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '4PK985', 'BANDO', 'CORREAS'),
(566, 'PRODUCTO', 'MICRO V: 4PK990', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK990 (9,90 Pulgadas)', 'MICRO V: 4PK990 (9,90 Pulgadas)', '7.30', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '4PK990', 'BANDO', 'CORREAS'),
(567, 'PRODUCTO', 'MICRO V: 4PK995', 'CORREAS AUTOMOTRICES', 'MICRO V: 4PK995 (9,95 Pulgadas)', 'MICRO V: 4PK995 (9,95 Pulgadas)', '7.35', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '4PK995', 'BANDO', 'CORREAS'),
(568, 'PRODUCTO', 'MICRO V: 5PK1005', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1005 (10,05 Pulgadas)', 'MICRO V: 5PK1005 (10,05 Pulgadas)', '9.27', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1005', 'BANDO', 'CORREAS'),
(569, 'PRODUCTO', 'MICRO V: 5PK1010', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1010 (10,10 Pulgadas)', 'MICRO V: 5PK1010 (10,10 Pulgadas)', '9.33', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1010', 'BANDO', 'CORREAS'),
(570, 'PRODUCTO', 'MICRO V: 5PK1015', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1015 (10,15 Pulgadas)', 'MICRO V: 5PK1015 (10,15 Pulgadas)', '9.35', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1015', 'BANDO', 'CORREAS'),
(571, 'PRODUCTO', 'MICRO V: 5PK1020', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1020 (10,20 Pulgadas)', 'MICRO V: 5PK1020 (10,20 Pulgadas)', '9.42', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1020', 'BANDO', 'CORREAS'),
(572, 'PRODUCTO', 'MICRO V: 5PK1030', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1030 (10,30 Pulgadas)', 'MICRO V: 5PK1030 (10,30 Pulgadas)', '9.49', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1030', 'BANDO', 'CORREAS'),
(573, 'PRODUCTO', 'MICRO V: 5PK1040', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1040 (10,40 Pulgadas)', 'MICRO V: 5PK1040 (10,40 Pulgadas)', '9.60', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1040', 'BANDO', 'CORREAS'),
(574, 'PRODUCTO', 'MICRO V: 5PK1050', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1050 (10,50 Pulgadas)', 'MICRO V: 5PK1050 (10,50 Pulgadas)', '9.68', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1050', 'BANDO', 'CORREAS'),
(575, 'PRODUCTO', 'MICRO V: 5PK1055', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1055 (10,55 Pulgadas)', 'MICRO V: 5PK1055 (10,55 Pulgadas)', '9.75', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1055', 'BANDO', 'CORREAS'),
(576, 'PRODUCTO', 'MICRO V: 5PK1060', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1060 (10,60 Pulgadas)', 'MICRO V: 5PK1060 (10,60 Pulgadas)', '9.80', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1060', 'BANDO', 'CORREAS'),
(577, 'PRODUCTO', 'MICRO V: 5PK1065', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1065 (10,65 Pulgadas)', 'MICRO V: 5PK1065 (10,65 Pulgadas)', '9.82', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1065', 'BANDO', 'CORREAS'),
(578, 'PRODUCTO', 'MICRO V: 5PK1070', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1070 (10,70 Pulgadas)', 'MICRO V: 5PK1070 (10,70 Pulgadas)', '9.86', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1070', 'BANDO', 'CORREAS'),
(579, 'PRODUCTO', 'MICRO V: 5PK1075', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1075 (10,75 Pulgadas)', 'MICRO V: 5PK1075 (10,75 Pulgadas)', '9.93', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1075', 'BANDO', 'CORREAS'),
(580, 'PRODUCTO', 'MICRO V: 5PK1080', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1080 (10,80 Pulgadas)', 'MICRO V: 5PK1080 (10,80 Pulgadas)', '9.95', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1080', 'BANDO', 'CORREAS'),
(581, 'PRODUCTO', 'MICRO V: 5PK1090', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1090 (10,90 Pulgadas)', 'MICRO V: 5PK1090 (10,90 Pulgadas)', '10.04', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1090', 'BANDO', 'CORREAS'),
(582, 'PRODUCTO', 'MICRO V: 5PK1100', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1100 (11,00 Pulgadas)', 'MICRO V: 5PK1100 (11,00 Pulgadas)', '10.15', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1100', 'BANDO', 'CORREAS'),
(583, 'PRODUCTO', 'MICRO V: 5PK1105', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1105 (11,05 Pulgadas)', 'MICRO V: 5PK1105 (11,05 Pulgadas)', '10.17', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1105', 'BANDO', 'CORREAS'),
(584, 'PRODUCTO', 'MICRO V: 5PK1110', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1110 (11,10 Pulgadas)', 'MICRO V: 5PK1110 (11,10 Pulgadas)', '10.24', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1110', 'BANDO', 'CORREAS'),
(585, 'PRODUCTO', 'MICRO V: 5PK1115', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1115 (11,15 Pulgadas)', 'MICRO V: 5PK1115 (11,15 Pulgadas)', '10.30', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1115', 'BANDO', 'CORREAS'),
(586, 'PRODUCTO', 'MICRO V: 5PK1120', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1120 (11,20 Pulgadas)', 'MICRO V: 5PK1120 (11,20 Pulgadas)', '10.32', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1120', 'BANDO', 'CORREAS'),
(587, 'PRODUCTO', 'MICRO V: 5PK1125', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1125 (11,25 Pulgadas)', 'MICRO V: 5PK1125 (11,25 Pulgadas)', '10.37', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1125', 'BANDO', 'CORREAS'),
(588, 'PRODUCTO', 'MICRO V: 5PK1130', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1130 (11,30 Pulgadas)', 'MICRO V: 5PK1130 (11,30 Pulgadas)', '10.43', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1130', 'BANDO', 'CORREAS'),
(589, 'PRODUCTO', 'MICRO V: 5PK1135', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1135 (11,35 Pulgadas)', 'MICRO V: 5PK1135 (11,35 Pulgadas)', '10.48', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1135', 'BANDO', 'CORREAS'),
(590, 'PRODUCTO', 'MICRO V: 5PK1140', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1140 (11,40 Pulgadas)', 'MICRO V: 5PK1140 (11,40 Pulgadas)', '10.52', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1140', 'BANDO', 'CORREAS'),
(591, 'PRODUCTO', 'MICRO V: 5PK1145', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1145 (11,45 Pulgadas)', 'MICRO V: 5PK1145 (11,45 Pulgadas)', '10.57', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1145', 'BANDO', 'CORREAS'),
(592, 'PRODUCTO', 'MICRO V: 5PK1150', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1150 (11,50 Pulgadas)', 'MICRO V: 5PK1150 (11,50 Pulgadas)', '10.59', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1150', 'BANDO', 'CORREAS'),
(593, 'PRODUCTO', 'MICRO V: 5PK1155', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1155 (11,55 Pulgadas)', 'MICRO V: 5PK1155 (11,55 Pulgadas)', '10.66', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1155', 'BANDO', 'CORREAS'),
(594, 'PRODUCTO', 'MICRO V: 5PK1160', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1160 (11,60 Pulgadas)', 'MICRO V: 5PK1160 (11,60 Pulgadas)', '10.70', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1160', 'BANDO', 'CORREAS'),
(595, 'PRODUCTO', 'MICRO V: 5PK1165', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1165 (11,65 Pulgadas)', 'MICRO V: 5PK1165 (11,65 Pulgadas)', '10.77', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1165', 'BANDO', 'CORREAS'),
(596, 'PRODUCTO', 'MICRO V: 5PK1170', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1170 (11,70 Pulgadas)', 'MICRO V: 5PK1170 (11,70 Pulgadas)', '10.79', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1170', 'BANDO', 'CORREAS'),
(597, 'PRODUCTO', 'MICRO V: 5PK1175', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1175 (11,75 Pulgadas)', 'MICRO V: 5PK1175 (11,75 Pulgadas)', '10.83', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1175', 'BANDO', 'CORREAS'),
(598, 'PRODUCTO', 'MICRO V: 5PK1180', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1180 (11,80 Pulgadas)', 'MICRO V: 5PK1180 (11,80 Pulgadas)', '10.88', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1180', 'BANDO', 'CORREAS'),
(599, 'PRODUCTO', 'MICRO V: 5PK1185', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1185 (11,85 Pulgadas)', 'MICRO V: 5PK1185 (11,85 Pulgadas)', '10.94', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1185', 'BANDO', 'CORREAS'),
(600, 'PRODUCTO', 'MICRO V: 5PK1190', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1190 (11,90 Pulgadas)', 'MICRO V: 5PK1190 (11,90 Pulgadas)', '9.88', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1190', 'BANDO', 'CORREAS'),
(601, 'PRODUCTO', 'MICRO V: 5PK1195', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1195 (11,95 Pulgadas)', 'MICRO V: 5PK1195 (11,95 Pulgadas)', '11.01', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1195', 'BANDO', 'CORREAS'),
(602, 'PRODUCTO', 'MICRO V: 5PK1205', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1205 (12,05 Pulgadas)', 'MICRO V: 5PK1205 (12,05 Pulgadas)', '11.12', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1205', 'BANDO', 'CORREAS'),
(603, 'PRODUCTO', 'MICRO V: 5PK1210', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1210 (12,10 Pulgadas)', 'MICRO V: 5PK1210 (12,10 Pulgadas)', '11.16', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1210', 'BANDO', 'CORREAS'),
(604, 'PRODUCTO', 'MICRO V: 5PK1215', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1215 (12,15 Pulgadas)', 'MICRO V: 5PK1215 (12,15 Pulgadas)', '11.21', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1215', 'BANDO', 'CORREAS'),
(605, 'PRODUCTO', 'MICRO V: 5PK1220', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1220 (12,20 Pulgadas)', 'MICRO V: 5PK1220 (12,20 Pulgadas)', '11.27', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1220', 'BANDO', 'CORREAS'),
(606, 'PRODUCTO', 'MICRO V: 5PK1230', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1230 (12,30 Pulgadas)', 'MICRO V: 5PK1230 (12,30 Pulgadas)', '11.34', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1230', 'BANDO', 'CORREAS'),
(607, 'PRODUCTO', 'MICRO V: 5PK1235', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1235 (12,35 Pulgadas)', 'MICRO V: 5PK1235 (12,35 Pulgadas)', '11.38', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1235', 'BANDO', 'CORREAS'),
(608, 'PRODUCTO', 'MICRO V: 5PK1240', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1240 (12,40 Pulgadas)', 'MICRO V: 5PK1240 (12,40 Pulgadas)', '11.45', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1240', 'BANDO', 'CORREAS'),
(609, 'PRODUCTO', 'MICRO V: 5PK1245', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1245 (12,45 Pulgadas)', 'MICRO V: 5PK1245 (12,45 Pulgadas)', '11.49', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1245', 'BANDO', 'CORREAS'),
(610, 'PRODUCTO', 'MICRO V: 5PK1255', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1255 (12,55 Pulgadas)', 'MICRO V: 5PK1255 (12,55 Pulgadas)', '11.56', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1255', 'BANDO', 'CORREAS'),
(611, 'PRODUCTO', 'MICRO V: 5PK1260', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1260 (12,60 Pulgadas)', 'MICRO V: 5PK1260 (12,60 Pulgadas)', '11.63', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1260', 'BANDO', 'CORREAS'),
(612, 'PRODUCTO', 'MICRO V: 5PK1270', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1270 (12,70 Pulgadas)', 'MICRO V: 5PK1270 (12,70 Pulgadas)', '11.71', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1270', 'BANDO', 'CORREAS'),
(613, 'PRODUCTO', 'MICRO V: 5PK1280', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1280 (12,80 Pulgadas)', 'MICRO V: 5PK1280 (12,80 Pulgadas)', '11.80', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1280', 'BANDO', 'CORREAS'),
(614, 'PRODUCTO', 'MICRO V: 5PK1285', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1285 (12,85 Pulgadas)', 'MICRO V: 5PK1285 (12,85 Pulgadas)', '11.85', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1285', 'BANDO', 'CORREAS'),
(615, 'PRODUCTO', 'MICRO V: 5PK1295', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1295 (12,95 Pulgadas)', 'MICRO V: 5PK1295 (12,95 Pulgadas)', '11.96', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1295', 'BANDO', 'CORREAS'),
(616, 'PRODUCTO', 'MICRO V: 5PK1300', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1300 (13,00 Pulgadas)', 'MICRO V: 5PK1300 (13,00 Pulgadas)', '11.98', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1300', 'BANDO', 'CORREAS'),
(617, 'PRODUCTO', 'MICRO V: 5PK1305', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1305 (13,05 Pulgadas)', 'MICRO V: 5PK1305 (13,05 Pulgadas)', '12.04', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1305', 'BANDO', 'CORREAS'),
(618, 'PRODUCTO', 'MICRO V: 5PK1310', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1310 (13,10 Pulgadas)', 'MICRO V: 5PK1310 (13,10 Pulgadas)', '12.07', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1310', 'BANDO', 'CORREAS'),
(619, 'PRODUCTO', 'MICRO V: 5PK1320', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1320 (13,20 Pulgadas)', 'MICRO V: 5PK1320 (13,20 Pulgadas)', '12.18', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1320', 'BANDO', 'CORREAS'),
(620, 'PRODUCTO', 'MICRO V: 5PK1325', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1325 (13,25 Pulgadas)', 'MICRO V: 5PK1325 (13,25 Pulgadas)', '12.20', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1325', 'BANDO', 'CORREAS'),
(621, 'PRODUCTO', 'MICRO V: 5PK1330', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1330 (13,30 Pulgadas)', 'MICRO V: 5PK1330 (13,30 Pulgadas)', '12.26', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1330', 'BANDO', 'CORREAS'),
(622, 'PRODUCTO', 'MICRO V: 5PK1345', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1345 (13,45 Pulgadas)', 'MICRO V: 5PK1345 (13,45 Pulgadas)', '12.40', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1345', 'BANDO', 'CORREAS'),
(623, 'PRODUCTO', 'MICRO V: 5PK1350', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1350 (13,50 Pulgadas)', 'MICRO V: 5PK1350 (13,50 Pulgadas)', '12.46', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1350', 'BANDO', 'CORREAS'),
(624, 'PRODUCTO', 'MICRO V: 5PK1355', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1355 (13,55 Pulgadas)', 'MICRO V: 5PK1355 (13,55 Pulgadas)', '12.49', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1355', 'BANDO', 'CORREAS'),
(625, 'PRODUCTO', 'MICRO V: 5PK1365', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1365 (13,65 Pulgadas)', 'MICRO V: 5PK1365 (13,65 Pulgadas)', '12.57', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1365', 'BANDO', 'CORREAS'),
(626, 'PRODUCTO', 'MICRO V: 5PK1370', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1370 (13,70 Pulgadas)', 'MICRO V: 5PK1370 (13,70 Pulgadas)', '12.64', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1370', 'BANDO', 'CORREAS'),
(627, 'PRODUCTO', 'MICRO V: 5PK1385', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1385 (13,85 Pulgadas)', 'MICRO V: 5PK1385 (13,85 Pulgadas)', '12.79', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1385', 'BANDO', 'CORREAS'),
(628, 'PRODUCTO', 'MICRO V: 5PK1395', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1395 (13,95 Pulgadas)', 'MICRO V: 5PK1395 (13,95 Pulgadas)', '12.86', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1395', 'BANDO', 'CORREAS'),
(629, 'PRODUCTO', 'MICRO V: 5PK1400', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1400 (14,00 Pulgadas)', 'MICRO V: 5PK1400 (14,00 Pulgadas)', '12.90', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1400', 'BANDO', 'CORREAS'),
(630, 'PRODUCTO', 'MICRO V: 5PK1435', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1435 (14,35 Pulgadas)', 'MICRO V: 5PK1435 (14,35 Pulgadas)', '13.23', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1435', 'BANDO', 'CORREAS'),
(631, 'PRODUCTO', 'MICRO V: 5PK1445', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1445 (14,45 Pulgadas)', 'MICRO V: 5PK1445 (14,45 Pulgadas)', '13.23', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1445', 'BANDO', 'CORREAS'),
(632, 'PRODUCTO', 'MICRO V: 5PK1455', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1455 (14,55 Pulgadas)', 'MICRO V: 5PK1455 (14,55 Pulgadas)', '13.41', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1455', 'BANDO', 'CORREAS'),
(633, 'PRODUCTO', 'MICRO V: 5PK1470', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1470 (14,70 Pulgadas)', 'MICRO V: 5PK1470 (14,70 Pulgadas)', '13.57', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1470', 'BANDO', 'CORREAS'),
(634, 'PRODUCTO', 'MICRO V: 5PK1495', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1495 (14,95 Pulgadas)', 'MICRO V: 5PK1495 (14,95 Pulgadas)', '13.79', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1495', 'BANDO', 'CORREAS'),
(635, 'PRODUCTO', 'MICRO V: 5PK1510', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1510 (15,10 Pulgadas)', 'MICRO V: 5PK1510 (15,10 Pulgadas)', '13.92', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1510', 'BANDO', 'CORREAS'),
(636, 'PRODUCTO', 'MICRO V: 5PK1525', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1525 (15,25 Pulgadas)', 'MICRO V: 5PK1525 (15,25 Pulgadas)', '14.07', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1525', 'BANDO', 'CORREAS'),
(637, 'PRODUCTO', 'MICRO V: 5PK1550', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1550 (15,50 Pulgadas)', 'MICRO V: 5PK1550 (15,50 Pulgadas)', '14.29', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1550', 'BANDO', 'CORREAS'),
(638, 'PRODUCTO', 'MICRO V: 5PK1560', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1560 (15,60 Pulgadas)', 'MICRO V: 5PK1560 (15,60 Pulgadas)', '11.32', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1560', 'BANDO', 'CORREAS'),
(639, 'PRODUCTO', 'MICRO V: 5PK1575', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1575 (15,75 Pulgadas)', 'MICRO V: 5PK1575 (15,75 Pulgadas)', '11.49', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1575', 'BANDO', 'CORREAS'),
(640, 'PRODUCTO', 'MICRO V: 5PK1590', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1590 (15,90 Pulgadas)', 'MICRO V: 5PK1590 (15,90 Pulgadas)', '11.52', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1590', 'BANDO', 'CORREAS'),
(641, 'PRODUCTO', 'MICRO V: 5PK1645', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1645 (16,45 Pulgadas)', 'MICRO V: 5PK1645 (16,45 Pulgadas)', '11.93', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1645', 'BANDO', 'CORREAS'),
(642, 'PRODUCTO', 'MICRO V: 5PK1650', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1650 (16,50 Pulgadas)', 'MICRO V: 5PK1650 (16,50 Pulgadas)', '11.98', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1650', 'BANDO', 'CORREAS'),
(643, 'PRODUCTO', 'MICRO V: 5PK1680', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1680 (16,80 Pulgadas)', 'MICRO V: 5PK1680 (16,80 Pulgadas)', '12.18', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1680', 'BANDO', 'CORREAS'),
(644, 'PRODUCTO', 'MICRO V: 5PK1750', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1750 (17,50 Pulgadas)', 'MICRO V: 5PK1750 (17,50 Pulgadas)', '12.68', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1750', 'BANDO', 'CORREAS'),
(645, 'PRODUCTO', 'MICRO V: 5PK1765', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1765 (17,65 Pulgadas)', 'MICRO V: 5PK1765 (17,65 Pulgadas)', '12.88', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1765', 'BANDO', 'CORREAS'),
(646, 'PRODUCTO', 'MICRO V: 5PK1790', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1790 (17,90 Pulgadas)', 'MICRO V: 5PK1790 (17,90 Pulgadas)', '12.97', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1790', 'BANDO', 'CORREAS'),
(647, 'PRODUCTO', 'MICRO V: 5PK1810', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1810 (18,10 Pulgadas)', 'MICRO V: 5PK1810 (18,10 Pulgadas)', '13.32', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1810', 'BANDO', 'CORREAS'),
(648, 'PRODUCTO', 'MICRO V: 5PK1815', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1815 (18,15 Pulgadas)', 'MICRO V: 5PK1815 (18,15 Pulgadas)', '13.17', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK1815', 'BANDO', 'CORREAS'),
(649, 'PRODUCTO', 'MICRO V: 5PK1830', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1830 (18,30 Pulgadas)', 'MICRO V: 5PK1830 (18,30 Pulgadas)', '13.59', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK1830', 'BANDO', 'CORREAS'),
(650, 'PRODUCTO', 'MICRO V: 5PK1875', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK1875 (18,75 Pulgadas)', 'MICRO V: 5PK1875 (18,75 Pulgadas)', '13.59', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK1875', 'BANDO', 'CORREAS'),
(651, 'PRODUCTO', 'MICRO V: 5PK2110', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK2110 (21,10 Pulgadas)', 'MICRO V: 5PK2110 (21,10 Pulgadas)', '15.26', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK2110', 'BANDO', 'CORREAS'),
(652, 'PRODUCTO', 'MICRO V: 5PK2120', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK2120 (21,20 Pulgadas)', 'MICRO V: 5PK2120 (21,20 Pulgadas)', '15.37', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK2120', 'BANDO', 'CORREAS'),
(653, 'PRODUCTO', 'MICRO V: 5PK2140', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK2140 (21,40 Pulgadas)', 'MICRO V: 5PK2140 (21,40 Pulgadas)', '15.48', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK2140', 'BANDO', 'CORREAS'),
(654, 'PRODUCTO', 'MICRO V: 5PK2145', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK2145 (21,45 Pulgadas)', 'MICRO V: 5PK2145 (21,45 Pulgadas)', '15.55', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK2145', 'BANDO', 'CORREAS'),
(655, 'PRODUCTO', 'MICRO V: 5PK2250', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK2250 (22,50 Pulgadas)', 'MICRO V: 5PK2250 (22,50 Pulgadas)', '16.28', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK2250', 'BANDO', 'CORREAS'),
(656, 'PRODUCTO', 'MICRO V: 5PK2255', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK2255 (22,55 Pulgadas)', 'MICRO V: 5PK2255 (22,55 Pulgadas)', '16.34', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK2255', 'BANDO', 'CORREAS'),
(657, 'PRODUCTO', 'MICRO V: 5PK2285', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK2285 (22,85 Pulgadas)', 'MICRO V: 5PK2285 (22,85 Pulgadas)', '16.56', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK2285', 'BANDO', 'CORREAS'),
(658, 'PRODUCTO', 'MICRO V: 5PK510', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK510 (5,10 Pulgadas)', 'MICRO V: 5PK510 (5,10 Pulgadas)', '5.14', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK510', 'BANDO', 'CORREAS'),
(659, 'PRODUCTO', 'MICRO V: 5PK685', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK685 (6,85 Pulgadas)', 'MICRO V: 5PK685 (6,85 Pulgadas)', '6.33', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK685', 'BANDO', 'CORREAS'),
(660, 'PRODUCTO', 'MICRO V: 5PK690', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK690 (6,90 Pulgadas)', 'MICRO V: 5PK690 (6,90 Pulgadas)', '6.40', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK690', 'BANDO', 'CORREAS'),
(661, 'PRODUCTO', 'MICRO V: 5PK695', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK695 (6,95 Pulgadas)', 'MICRO V: 5PK695 (6,95 Pulgadas)', '6.42', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK695', 'BANDO', 'CORREAS'),
(662, 'PRODUCTO', 'MICRO V: 5PK800', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK800 (8,00 Pulgadas)', 'MICRO V: 5PK800 (8,00 Pulgadas)', '7.37', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK800', 'BANDO', 'CORREAS'),
(663, 'PRODUCTO', 'MICRO V: 5PK805', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK805 (8,05 Pulgadas)', 'MICRO V: 5PK805 (8,05 Pulgadas)', '7.44', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK805', 'BANDO', 'CORREAS'),
(664, 'PRODUCTO', 'MICRO V: 5PK810', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK810 (8,10 Pulgadas)', 'MICRO V: 5PK810 (8,10 Pulgadas)', '7.48', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK810', 'BANDO', 'CORREAS'),
(665, 'PRODUCTO', 'MICRO V: 5PK815', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK815 (8,15 Pulgadas)', 'MICRO V: 5PK815 (8,15 Pulgadas)', '7.50', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK815', 'BANDO', 'CORREAS'),
(666, 'PRODUCTO', 'MICRO V: 5PK825', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK825 (8,25 Pulgadas)', 'MICRO V: 5PK825 (8,25 Pulgadas)', '7.61', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK825', 'BANDO', 'CORREAS'),
(667, 'PRODUCTO', 'MICRO V: 5PK830', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK830 (8,30 Pulgadas)', 'MICRO V: 5PK830 (8,30 Pulgadas)', '7.66', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK830', 'BANDO', 'CORREAS'),
(668, 'PRODUCTO', 'MICRO V: 5PK835', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK835 (8,35 Pulgadas)', 'MICRO V: 5PK835 (8,35 Pulgadas)', '7.72', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK835', 'BANDO', 'CORREAS'),
(669, 'PRODUCTO', 'MICRO V: 5PK840', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK840 (8,40 Pulgadas)', 'MICRO V: 5PK840 (8,40 Pulgadas)', '7.74', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK840', 'BANDO', 'CORREAS'),
(670, 'PRODUCTO', 'MICRO V: 5PK845', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK845 (8,45 Pulgadas)', 'MICRO V: 5PK845 (8,45 Pulgadas)', '7.79', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK845', 'BANDO', 'CORREAS'),
(671, 'PRODUCTO', 'MICRO V: 5PK850', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK850 (8,50 Pulgadas)', 'MICRO V: 5PK850 (8,50 Pulgadas)', '7.83', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK850', 'BANDO', 'CORREAS'),
(672, 'PRODUCTO', 'MICRO V: 5PK865', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK865 (8,65 Pulgadas)', 'MICRO V: 5PK865 (8,65 Pulgadas)', '7.99', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK865', 'BANDO', 'CORREAS'),
(673, 'PRODUCTO', 'MICRO V: 5PK870', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK870 (8,70 Pulgadas)', 'MICRO V: 5PK870 (8,70 Pulgadas)', '8.01', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK870', 'BANDO', 'CORREAS'),
(674, 'PRODUCTO', 'MICRO V: 5PK875', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK875 (8,75 Pulgadas)', 'MICRO V: 5PK875 (8,75 Pulgadas)', '8.08', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK875', 'BANDO', 'CORREAS'),
(675, 'PRODUCTO', 'MICRO V: 5PK880', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK880 (8,80 Pulgadas)', 'MICRO V: 5PK880 (8,80 Pulgadas)', '8.12', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK880', 'BANDO', 'CORREAS'),
(676, 'PRODUCTO', 'MICRO V: 5PK885', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK885 (8,85 Pulgadas)', 'MICRO V: 5PK885 (8,85 Pulgadas)', '7.39', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK885', 'BANDO', 'CORREAS'),
(677, 'PRODUCTO', 'MICRO V: 5PK890', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK890 (8,90 Pulgadas)', 'MICRO V: 5PK890 (8,90 Pulgadas)', '8.21', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK890', 'BANDO', 'CORREAS'),
(678, 'PRODUCTO', 'MICRO V: 5PK900', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK900 (9,00 Pulgadas)', 'MICRO V: 5PK900 (9,00 Pulgadas)', '8.30', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK900', 'BANDO', 'CORREAS'),
(679, 'PRODUCTO', 'MICRO V: 5PK905', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK905 (9,05 Pulgadas)', 'MICRO V: 5PK905 (9,05 Pulgadas)', '8.34', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK905', 'BANDO', 'CORREAS'),
(680, 'PRODUCTO', 'MICRO V: 5PK910', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK910 (9,10 Pulgadas)', 'MICRO V: 5PK910 (9,10 Pulgadas)', '8.41', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK910', 'BANDO', 'CORREAS'),
(681, 'PRODUCTO', 'MICRO V: 5PK915', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK915 (9,15 Pulgadas)', 'MICRO V: 5PK915 (9,15 Pulgadas)', '8.43', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK915', 'BANDO', 'CORREAS'),
(682, 'PRODUCTO', 'MICRO V: 5PK920', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK920 (9,20 Pulgadas)', 'MICRO V: 5PK920 (9,20 Pulgadas)', '8.47', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK920', 'BANDO', 'CORREAS'),
(683, 'PRODUCTO', 'MICRO V: 5PK925', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK925 (9,25 Pulgadas)', 'MICRO V: 5PK925 (9,25 Pulgadas)', '8.52', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK925', 'BANDO', 'CORREAS'),
(684, 'PRODUCTO', 'MICRO V: 5PK935', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK935 (9,35 Pulgadas)', 'MICRO V: 5PK935 (9,35 Pulgadas)', '8.63', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK935', 'BANDO', 'CORREAS'),
(685, 'PRODUCTO', 'MICRO V: 5PK940', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK940 (9,40 Pulgadas)', 'MICRO V: 5PK940 (9,40 Pulgadas)', '8.67', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK940', 'BANDO', 'CORREAS'),
(686, 'PRODUCTO', 'MICRO V: 5PK945', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK945 (9,45 Pulgadas)', 'MICRO V: 5PK945 (9,45 Pulgadas)', '8.74', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK945', 'BANDO', 'CORREAS'),
(687, 'PRODUCTO', 'MICRO V: 5PK950', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK950 (9,50 Pulgadas)', 'MICRO V: 5PK950 (9,50 Pulgadas)', '8.76', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK950', 'BANDO', 'CORREAS'),
(688, 'PRODUCTO', 'MICRO V: 5PK955', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK955 (9,55 Pulgadas)', 'MICRO V: 5PK955 (9,55 Pulgadas)', '8.80', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK955', 'BANDO', 'CORREAS'),
(689, 'PRODUCTO', 'MICRO V: 5PK960', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK960 (9,60 Pulgadas)', 'MICRO V: 5PK960 (9,60 Pulgadas)', '8.87', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK960', 'BANDO', 'CORREAS'),
(690, 'PRODUCTO', 'MICRO V: 5PK965', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK965 (9,65 Pulgadas)', 'MICRO V: 5PK965 (9,65 Pulgadas)', '8.91', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK965', 'BANDO', 'CORREAS'),
(691, 'PRODUCTO', 'MICRO V: 5PK970', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK970 (9,70 Pulgadas)', 'MICRO V: 5PK970 (9,70 Pulgadas)', '8.96', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK970', 'BANDO', 'CORREAS'),
(692, 'PRODUCTO', 'MICRO V: 5PK975', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK975 (9,75 Pulgadas)', 'MICRO V: 5PK975 (9,75 Pulgadas)', '8.98', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK975', 'BANDO', 'CORREAS'),
(693, 'PRODUCTO', 'MICRO V: 5PK980', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK980 (9,80 Pulgadas)', 'MICRO V: 5PK980 (9,80 Pulgadas)', '9.05', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK980', 'BANDO', 'CORREAS'),
(694, 'PRODUCTO', 'MICRO V: 5PK985', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK985 (9,85 Pulgadas)', 'MICRO V: 5PK985 (9,85 Pulgadas)', '9.07', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '5PK985', 'BANDO', 'CORREAS'),
(695, 'PRODUCTO', 'MICRO V: 5PK990', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK990 (9,90 Pulgadas)', 'MICRO V: 5PK990 (9,90 Pulgadas)', '9.13', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '5PK990', 'BANDO', 'CORREAS'),
(696, 'PRODUCTO', 'MICRO V: 5PK995', 'CORREAS AUTOMOTRICES', 'MICRO V: 5PK995 (9,95 Pulgadas)', 'MICRO V: 5PK995 (9,95 Pulgadas)', '9.18', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '5PK995', 'BANDO', 'CORREAS'),
(697, 'PRODUCTO', 'MICRO V: 6PK1000', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1000 (10,00 Pulgadas)', 'MICRO V: 6PK1000 (10,00 Pulgadas)', '11.05', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1000', 'BANDO', 'CORREAS'),
(698, 'PRODUCTO', 'MICRO V: 6PK1015', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1015 (10,15 Pulgadas)', 'MICRO V: 6PK1015 (10,15 Pulgadas)', '11.21', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1015', 'BANDO', 'CORREAS'),
(699, 'PRODUCTO', 'MICRO V: 6PK1030', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1030 (10,30 Pulgadas)', 'MICRO V: 6PK1030 (10,30 Pulgadas)', '11.40', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1030', 'BANDO', 'CORREAS'),
(700, 'PRODUCTO', 'MICRO V: 6PK1035', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1035 (10,35 Pulgadas)', 'MICRO V: 6PK1035 (10,35 Pulgadas)', '11.45', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1035', 'BANDO', 'CORREAS'),
(701, 'PRODUCTO', 'MICRO V: 6PK1040', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1040 (10,40 Pulgadas)', 'MICRO V: 6PK1040 (10,40 Pulgadas)', '11.52', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1040', 'BANDO', 'CORREAS'),
(702, 'PRODUCTO', 'MICRO V: 6PK1045', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1045 (10,45 Pulgadas)', 'MICRO V: 6PK1045 (10,45 Pulgadas)', '11.56', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1045', 'BANDO', 'CORREAS'),
(703, 'PRODUCTO', 'MICRO V: 6PK1055', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1055 (10,55 Pulgadas)', 'MICRO V: 6PK1055 (10,55 Pulgadas)', '11.67', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1055', 'BANDO', 'CORREAS'),
(704, 'PRODUCTO', 'MICRO V: 6PK1060', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1060 (10,60 Pulgadas)', 'MICRO V: 6PK1060 (10,60 Pulgadas)', '11.74', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1060', 'BANDO', 'CORREAS'),
(705, 'PRODUCTO', 'MICRO V: 6PK1065', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1065 (10,65 Pulgadas)', 'MICRO V: 6PK1065 (10,65 Pulgadas)', '11.78', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1065', 'BANDO', 'CORREAS'),
(706, 'PRODUCTO', 'MICRO V: 6PK1070', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1070 (10,70 Pulgadas)', 'MICRO V: 6PK1070 (10,70 Pulgadas)', '11.85', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1070', 'BANDO', 'CORREAS'),
(707, 'PRODUCTO', 'MICRO V: 6PK1075', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1075 (10,75 Pulgadas)', 'MICRO V: 6PK1075 (10,75 Pulgadas)', '11.91', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1075', 'BANDO', 'CORREAS'),
(708, 'PRODUCTO', 'MICRO V: 6PK1080', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1080 (10,80 Pulgadas)', 'MICRO V: 6PK1080 (10,80 Pulgadas)', '11.96', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1080', 'BANDO', 'CORREAS'),
(709, 'PRODUCTO', 'MICRO V: 6PK1085', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1085 (10,85 Pulgadas)', 'MICRO V: 6PK1085 (10,85 Pulgadas)', '12.00', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1085', 'BANDO', 'CORREAS'),
(710, 'PRODUCTO', 'MICRO V: 6PK1095', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1095 (10,95 Pulgadas)', 'MICRO V: 6PK1095 (10,95 Pulgadas)', '12.11', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1095', 'BANDO', 'CORREAS'),
(711, 'PRODUCTO', 'MICRO V: 6PK1105', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1105 (11,05 Pulgadas)', 'MICRO V: 6PK1105 (11,05 Pulgadas)', '12.22', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1105', 'BANDO', 'CORREAS'),
(712, 'PRODUCTO', 'MICRO V: 6PK1110', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1110 (11,10 Pulgadas)', 'MICRO V: 6PK1110 (11,10 Pulgadas)', '12.29', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1110', 'BANDO', 'CORREAS'),
(713, 'PRODUCTO', 'MICRO V: 6PK1115', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1115 (11,15 Pulgadas)', 'MICRO V: 6PK1115 (11,15 Pulgadas)', '12.33', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1115', 'BANDO', 'CORREAS'),
(714, 'PRODUCTO', 'MICRO V: 6PK1120', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1120 (11,20 Pulgadas)', 'MICRO V: 6PK1120 (11,20 Pulgadas)', '12.40', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1120', 'BANDO', 'CORREAS'),
(715, 'PRODUCTO', 'MICRO V: 6PK1125', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1125 (11,25 Pulgadas)', 'MICRO V: 6PK1125 (11,25 Pulgadas)', '12.44', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1125', 'BANDO', 'CORREAS'),
(716, 'PRODUCTO', 'MICRO V: 6PK1130', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1130 (11,30 Pulgadas)', 'MICRO V: 6PK1130 (11,30 Pulgadas)', '12.51', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1130', 'BANDO', 'CORREAS'),
(717, 'PRODUCTO', 'MICRO V: 6PK1135', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1135 (11,35 Pulgadas)', 'MICRO V: 6PK1135 (11,35 Pulgadas)', '12.55', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1135', 'BANDO', 'CORREAS'),
(718, 'PRODUCTO', 'MICRO V: 6PK1140', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1140 (11,40 Pulgadas)', 'MICRO V: 6PK1140 (11,40 Pulgadas)', '12.62', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1140', 'BANDO', 'CORREAS');
INSERT INTO `sspi_productos` (`ID_PRODUCTO`, `TIPO_PRODUCTO_SERVICIO`, `NOMBRE_PRODUCTO`, `NOMBRE_CATEGORIA`, `DESCRIPCION_CORTA`, `DESCRIPCION_LARGA`, `PRECIO_UNITARIO_DOLARES`, `FOTO_1_CARRUSEL`, `FOTO_2_CORTA`, `FOTO_3_LARGA`, `UNIDAD_DE_VENTA`, `CANTIDAD_DISPONIBLE`, `DESTACADO`, `CODIGO`, `MARCA`, `RUBRO`) VALUES
(719, 'PRODUCTO', 'MICRO V: 6PK1145', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1145 (11,45 Pulgadas)', 'MICRO V: 6PK1145 (11,45 Pulgadas)', '12.68', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1145', 'BANDO', 'CORREAS'),
(720, 'PRODUCTO', 'MICRO V: 6PK1155', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1155 (11,55 Pulgadas)', 'MICRO V: 6PK1155 (11,55 Pulgadas)', '12.79', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1155', 'BANDO', 'CORREAS'),
(721, 'PRODUCTO', 'MICRO V: 6PK1160', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1160 (11,60 Pulgadas)', 'MICRO V: 6PK1160 (11,60 Pulgadas)', '12.84', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1160', 'BANDO', 'CORREAS'),
(722, 'PRODUCTO', 'MICRO V: 6PK1165', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1165 (11,65 Pulgadas)', 'MICRO V: 6PK1165 (11,65 Pulgadas)', '12.88', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1165', 'BANDO', 'CORREAS'),
(723, 'PRODUCTO', 'MICRO V: 6PK1170', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1170 (11,70 Pulgadas)', 'MICRO V: 6PK1170 (11,70 Pulgadas)', '12.95', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1170', 'BANDO', 'CORREAS'),
(724, 'PRODUCTO', 'MICRO V: 6PK1175', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1175 (11,75 Pulgadas)', 'MICRO V: 6PK1175 (11,75 Pulgadas)', '13.01', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1175', 'BANDO', 'CORREAS'),
(725, 'PRODUCTO', 'MICRO V: 6PK1180', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1180 (11,80 Pulgadas)', 'MICRO V: 6PK1180 (11,80 Pulgadas)', '13.06', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1180', 'BANDO', 'CORREAS'),
(726, 'PRODUCTO', 'MICRO V: 6PK1190', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1190 (11,90 Pulgadas)', 'MICRO V: 6PK1190 (11,90 Pulgadas)', '13.17', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1190', 'BANDO', 'CORREAS'),
(727, 'PRODUCTO', 'MICRO V: 6PK1195', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1195 (11,95 Pulgadas)', 'MICRO V: 6PK1195 (11,95 Pulgadas)', '13.23', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1195', 'BANDO', 'CORREAS'),
(728, 'PRODUCTO', 'MICRO V: 6PK1200', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1200 (12,00 Pulgadas)', 'MICRO V: 6PK1200 (12,00 Pulgadas)', '13.30', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1200', 'BANDO', 'CORREAS'),
(729, 'PRODUCTO', 'MICRO V: 6PK1205', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1205 (12,05 Pulgadas)', 'MICRO V: 6PK1205 (12,05 Pulgadas)', '13.35', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1205', 'BANDO', 'CORREAS'),
(730, 'PRODUCTO', 'MICRO V: 6PK1210', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1210 (12,10 Pulgadas)', 'MICRO V: 6PK1210 (12,10 Pulgadas)', '13.41', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1210', 'BANDO', 'CORREAS'),
(731, 'PRODUCTO', 'MICRO V: 6PK1212', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1212 (12,12 Pulgadas)', 'MICRO V: 6PK1212 (12,12 Pulgadas)', '13.43', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1212', 'BANDO', 'CORREAS'),
(732, 'PRODUCTO', 'MICRO V: 6PK1215', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1215 (12,15 Pulgadas)', 'MICRO V: 6PK1215 (12,15 Pulgadas)', '13.46', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1215', 'BANDO', 'CORREAS'),
(733, 'PRODUCTO', 'MICRO V: 6PK1220', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1220 (12,20 Pulgadas)', 'MICRO V: 6PK1220 (12,20 Pulgadas)', '13.52', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1220', 'BANDO', 'CORREAS'),
(734, 'PRODUCTO', 'MICRO V: 6PK1230', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1230 (12,30 Pulgadas)', 'MICRO V: 6PK1230 (12,30 Pulgadas)', '13.59', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1230', 'BANDO', 'CORREAS'),
(735, 'PRODUCTO', 'MICRO V: 6PK1245', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1245 (12,45 Pulgadas)', 'MICRO V: 6PK1245 (12,45 Pulgadas)', '13.79', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1245', 'BANDO', 'CORREAS'),
(736, 'PRODUCTO', 'MICRO V: 6PK1250', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1250 (12,50 Pulgadas)', 'MICRO V: 6PK1250 (12,50 Pulgadas)', '13.83', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1250', 'BANDO', 'CORREAS'),
(737, 'PRODUCTO', 'MICRO V: 6PK1255', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1255 (12,55 Pulgadas)', 'MICRO V: 6PK1255 (12,55 Pulgadas)', '13.87', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1255', 'BANDO', 'CORREAS'),
(738, 'PRODUCTO', 'MICRO V: 6PK1260', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1260 (12,60 Pulgadas)', 'MICRO V: 6PK1260 (12,60 Pulgadas)', '13.96', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1260', 'BANDO', 'CORREAS'),
(739, 'PRODUCTO', 'MICRO V: 6PK1265', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1265 (12,65 Pulgadas)', 'MICRO V: 6PK1265 (12,65 Pulgadas)', '14.01', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1265', 'BANDO', 'CORREAS'),
(740, 'PRODUCTO', 'MICRO V: 6PK1270', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1270 (12,70 Pulgadas)', 'MICRO V: 6PK1270 (12,70 Pulgadas)', '14.05', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1270', 'BANDO', 'CORREAS'),
(741, 'PRODUCTO', 'MICRO V: 6PK1275', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1275 (12,75 Pulgadas)', 'MICRO V: 6PK1275 (12,75 Pulgadas)', '14.12', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1275', 'BANDO', 'CORREAS'),
(742, 'PRODUCTO', 'MICRO V: 6PK1280', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1280 (12,80 Pulgadas)', 'MICRO V: 6PK1280 (12,80 Pulgadas)', '14.18', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1280', 'BANDO', 'CORREAS'),
(743, 'PRODUCTO', 'MICRO V: 6PK1285', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1285 (12,85 Pulgadas)', 'MICRO V: 6PK1285 (12,85 Pulgadas)', '14.21', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1285', 'BANDO', 'CORREAS'),
(744, 'PRODUCTO', 'MICRO V: 6PK1300', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1300 (13,00 Pulgadas)', 'MICRO V: 6PK1300 (13,00 Pulgadas)', '14.38', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1300', 'BANDO', 'CORREAS'),
(745, 'PRODUCTO', 'MICRO V: 6PK1305', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1305 (13,05 Pulgadas)', 'MICRO V: 6PK1305 (13,05 Pulgadas)', '14.43', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1305', 'BANDO', 'CORREAS'),
(746, 'PRODUCTO', 'MICRO V: 6PK1310', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1310 (13,10 Pulgadas)', 'MICRO V: 6PK1310 (13,10 Pulgadas)', '14.49', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1310', 'BANDO', 'CORREAS'),
(747, 'PRODUCTO', 'MICRO V: 6PK1320', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1320 (13,20 Pulgadas)', 'MICRO V: 6PK1320 (13,20 Pulgadas)', '14.60', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1320', 'BANDO', 'CORREAS'),
(748, 'PRODUCTO', 'MICRO V: 6PK1325', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1325 (13,25 Pulgadas)', 'MICRO V: 6PK1325 (13,25 Pulgadas)', '14.67', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1325', 'BANDO', 'CORREAS'),
(749, 'PRODUCTO', 'MICRO V: 6PK1335', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1335 (13,35 Pulgadas)', 'MICRO V: 6PK1335 (13,35 Pulgadas)', '14.78', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1335', 'BANDO', 'CORREAS'),
(750, 'PRODUCTO', 'MICRO V: 6PK1345', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1345 (13,45 Pulgadas)', 'MICRO V: 6PK1345 (13,45 Pulgadas)', '14.89', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1345', 'BANDO', 'CORREAS'),
(751, 'PRODUCTO', 'MICRO V: 6PK1355', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1355 (13,55 Pulgadas)', 'MICRO V: 6PK1355 (13,55 Pulgadas)', '15.00', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1355', 'BANDO', 'CORREAS'),
(752, 'PRODUCTO', 'MICRO V: 6PK1360', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1360 (13,60 Pulgadas)', 'MICRO V: 6PK1360 (13,60 Pulgadas)', '15.04', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1360', 'BANDO', 'CORREAS'),
(753, 'PRODUCTO', 'MICRO V: 6PK1365', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1365 (13,65 Pulgadas)', 'MICRO V: 6PK1365 (13,65 Pulgadas)', '15.11', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1365', 'BANDO', 'CORREAS'),
(754, 'PRODUCTO', 'MICRO V: 6PK1370', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1370 (13,70 Pulgadas)', 'MICRO V: 6PK1370 (13,70 Pulgadas)', '15.18', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1370', 'BANDO', 'CORREAS'),
(755, 'PRODUCTO', 'MICRO V: 6PK1385', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1385 (13,85 Pulgadas)', 'MICRO V: 6PK1385 (13,85 Pulgadas)', '15.33', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1385', 'BANDO', 'CORREAS'),
(756, 'PRODUCTO', 'MICRO V: 6PK1390', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1390 (13,90 Pulgadas)', 'MICRO V: 6PK1390 (13,90 Pulgadas)', '15.40', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1390', 'BANDO', 'CORREAS'),
(757, 'PRODUCTO', 'MICRO V: 6PK1395', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1395 (13,95 Pulgadas)', 'MICRO V: 6PK1395 (13,95 Pulgadas)', '15.44', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1395', 'BANDO', 'CORREAS'),
(758, 'PRODUCTO', 'MICRO V: 6PK1400', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1400 (14,00 Pulgadas)', 'MICRO V: 6PK1400 (14,00 Pulgadas)', '15.51', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1400', 'BANDO', 'CORREAS'),
(759, 'PRODUCTO', 'MICRO V: 6PK1420', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1420 (14,20 Pulgadas)', 'MICRO V: 6PK1420 (14,20 Pulgadas)', '15.70', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1420', 'BANDO', 'CORREAS'),
(760, 'PRODUCTO', 'MICRO V: 6PK1425', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1425 (14,25 Pulgadas)', 'MICRO V: 6PK1425 (14,25 Pulgadas)', '15.84', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1425', 'BANDO', 'CORREAS'),
(761, 'PRODUCTO', 'MICRO V: 6PK1435', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1435 (14,35 Pulgadas)', 'MICRO V: 6PK1435 (14,35 Pulgadas)', '15.88', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1435', 'BANDO', 'CORREAS'),
(762, 'PRODUCTO', 'MICRO V: 6PK1445', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1445 (14,45 Pulgadas)', 'MICRO V: 6PK1445 (14,45 Pulgadas)', '16.01', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1445', 'BANDO', 'CORREAS'),
(763, 'PRODUCTO', 'MICRO V: 6PK1450', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1450 (14,50 Pulgadas)', 'MICRO V: 6PK1450 (14,50 Pulgadas)', '16.04', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1450', 'BANDO', 'CORREAS'),
(764, 'PRODUCTO', 'MICRO V: 6PK1460', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1460 (14,60 Pulgadas)', 'MICRO V: 6PK1460 (14,60 Pulgadas)', '16.15', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1460', 'BANDO', 'CORREAS'),
(765, 'PRODUCTO', 'MICRO V: 6PK1470', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1470 (14,70 Pulgadas)', 'MICRO V: 6PK1470 (14,70 Pulgadas)', '16.26', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1470', 'BANDO', 'CORREAS'),
(766, 'PRODUCTO', 'MICRO V: 6PK1475', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1475 (14,75 Pulgadas)', 'MICRO V: 6PK1475 (14,75 Pulgadas)', '16.30', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1475', 'BANDO', 'CORREAS'),
(767, 'PRODUCTO', 'MICRO V: 6PK1490', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1490 (14,90 Pulgadas)', 'MICRO V: 6PK1490 (14,90 Pulgadas)', '16.48', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1490', 'BANDO', 'CORREAS'),
(768, 'PRODUCTO', 'MICRO V: 6PK1500', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1500 (15,00 Pulgadas)', 'MICRO V: 6PK1500 (15,00 Pulgadas)', '16.59', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1500', 'BANDO', 'CORREAS'),
(769, 'PRODUCTO', 'MICRO V: 6PK1510', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1510 (15,10 Pulgadas)', 'MICRO V: 6PK1510 (15,10 Pulgadas)', '16.72', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1510', 'BANDO', 'CORREAS'),
(770, 'PRODUCTO', 'MICRO V: 6PK1515', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1515 (15,15 Pulgadas)', 'MICRO V: 6PK1515 (15,15 Pulgadas)', '16.76', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1515', 'BANDO', 'CORREAS'),
(771, 'PRODUCTO', 'MICRO V: 6PK1520', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1520 (15,20 Pulgadas)', 'MICRO V: 6PK1520 (15,20 Pulgadas)', '16.83', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1520', 'BANDO', 'CORREAS'),
(772, 'PRODUCTO', 'MICRO V: 6PK1525', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1525 (15,25 Pulgadas)', 'MICRO V: 6PK1525 (15,25 Pulgadas)', '16.87', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1525', 'BANDO', 'CORREAS'),
(773, 'PRODUCTO', 'MICRO V: 6PK1535', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1535 (15,35 Pulgadas)', 'MICRO V: 6PK1535 (15,35 Pulgadas)', '16.98', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1535', 'BANDO', 'CORREAS'),
(774, 'PRODUCTO', 'MICRO V: 6PK1540', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1540 (15,40 Pulgadas)', 'MICRO V: 6PK1540 (15,40 Pulgadas)', '15.40', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1540', 'BANDO', 'CORREAS'),
(775, 'PRODUCTO', 'MICRO V: 6PK1550', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1550 (15,50 Pulgadas)', 'MICRO V: 6PK1550 (15,50 Pulgadas)', '17.14', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1550', 'BANDO', 'CORREAS'),
(776, 'PRODUCTO', 'MICRO V: 6PK1555', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1555 (15,55 Pulgadas)', 'MICRO V: 6PK1555 (15,55 Pulgadas)', '13.52', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1555', 'BANDO', 'CORREAS'),
(777, 'PRODUCTO', 'MICRO V: 6PK1560', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1560 (15,60 Pulgadas)', 'MICRO V: 6PK1560 (15,60 Pulgadas)', '13.57', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1560', 'BANDO', 'CORREAS'),
(778, 'PRODUCTO', 'MICRO V: 6PK1565', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1565 (15,65 Pulgadas)', 'MICRO V: 6PK1565 (15,65 Pulgadas)', '13.61', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1565', 'BANDO', 'CORREAS'),
(779, 'PRODUCTO', 'MICRO V: 6PK1570', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1570 (15,70 Pulgadas)', 'MICRO V: 6PK1570 (15,70 Pulgadas)', '13.65', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1570', 'BANDO', 'CORREAS'),
(780, 'PRODUCTO', 'MICRO V: 6PK1575', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1575 (15,75 Pulgadas)', 'MICRO V: 6PK1575 (15,75 Pulgadas)', '13.70', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1575', 'BANDO', 'CORREAS'),
(781, 'PRODUCTO', 'MICRO V: 6PK1580', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1580 (15,80 Pulgadas)', 'MICRO V: 6PK1580 (15,80 Pulgadas)', '13.74', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1580', 'BANDO', 'CORREAS'),
(782, 'PRODUCTO', 'MICRO V: 6PK1590', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1590 (15,90 Pulgadas)', 'MICRO V: 6PK1590 (15,90 Pulgadas)', '13.83', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1590', 'BANDO', 'CORREAS'),
(783, 'PRODUCTO', 'MICRO V: 6PK1600', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1600 (16,00 Pulgadas)', 'MICRO V: 6PK1600 (16,00 Pulgadas)', '13.92', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1600', 'BANDO', 'CORREAS'),
(784, 'PRODUCTO', 'MICRO V: 6PK1615', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1615 (16,15 Pulgadas)', 'MICRO V: 6PK1615 (16,15 Pulgadas)', '14.05', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1615', 'BANDO', 'CORREAS'),
(785, 'PRODUCTO', 'MICRO V: 6PK1625', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1625 (16,25 Pulgadas)', 'MICRO V: 6PK1625 (16,25 Pulgadas)', '14.12', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1625', 'BANDO', 'CORREAS'),
(786, 'PRODUCTO', 'MICRO V: 6PK1630', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1630 (16,30 Pulgadas)', 'MICRO V: 6PK1630 (16,30 Pulgadas)', '14.18', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1630', 'BANDO', 'CORREAS'),
(787, 'PRODUCTO', 'MICRO V: 6PK1635', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1635 (16,35 Pulgadas)', 'MICRO V: 6PK1635 (16,35 Pulgadas)', '12.73', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1635', 'BANDO', 'CORREAS'),
(788, 'PRODUCTO', 'MICRO V: 6PK1640', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1640 (16,40 Pulgadas)', 'MICRO V: 6PK1640 (16,40 Pulgadas)', '14.25', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1640', 'BANDO', 'CORREAS'),
(789, 'PRODUCTO', 'MICRO V: 6PK1650', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1650 (16,50 Pulgadas)', 'MICRO V: 6PK1650 (16,50 Pulgadas)', '14.36', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1650', 'BANDO', 'CORREAS'),
(790, 'PRODUCTO', 'MICRO V: 6PK1660', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1660 (16,60 Pulgadas)', 'MICRO V: 6PK1660 (16,60 Pulgadas)', '14.43', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1660', 'BANDO', 'CORREAS'),
(791, 'PRODUCTO', 'MICRO V: 6PK1670', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1670 (16,70 Pulgadas)', 'MICRO V: 6PK1670 (16,70 Pulgadas)', '14.51', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1670', 'BANDO', 'CORREAS'),
(792, 'PRODUCTO', 'MICRO V: 6PK1675', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1675 (16,75 Pulgadas)', 'MICRO V: 6PK1675 (16,75 Pulgadas)', '14.62', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1675', 'BANDO', 'CORREAS'),
(793, 'PRODUCTO', 'MICRO V: 6PK1680', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1680 (16,80 Pulgadas)', 'MICRO V: 6PK1680 (16,80 Pulgadas)', '14.69', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1680', 'BANDO', 'CORREAS'),
(794, 'PRODUCTO', 'MICRO V: 6PK1685', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1685 (16,85 Pulgadas)', 'MICRO V: 6PK1685 (16,85 Pulgadas)', '14.71', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1685', 'BANDO', 'CORREAS'),
(795, 'PRODUCTO', 'MICRO V: 6PK1690', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1690 (16,90 Pulgadas)', 'MICRO V: 6PK1690 (16,90 Pulgadas)', '14.71', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1690', 'BANDO', 'CORREAS'),
(796, 'PRODUCTO', 'MICRO V: 6PK1695', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1695 (16,95 Pulgadas)', 'MICRO V: 6PK1695 (16,95 Pulgadas)', '14.73', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1695', 'BANDO', 'CORREAS'),
(797, 'PRODUCTO', 'MICRO V: 6PK1700', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1700 (17,00 Pulgadas)', 'MICRO V: 6PK1700 (17,00 Pulgadas)', '14.78', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1700', 'BANDO', 'CORREAS'),
(798, 'PRODUCTO', 'MICRO V: 6PK1710', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1710 (17,10 Pulgadas)', 'MICRO V: 6PK1710 (17,10 Pulgadas)', '14.87', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1710', 'BANDO', 'CORREAS'),
(799, 'PRODUCTO', 'MICRO V: 6PK1715', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1715 (17,15 Pulgadas)', 'MICRO V: 6PK1715 (17,15 Pulgadas)', '14.91', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1715', 'BANDO', 'CORREAS'),
(800, 'PRODUCTO', 'MICRO V: 6PK1725', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1725 (17,25 Pulgadas)', 'MICRO V: 6PK1725 (17,25 Pulgadas)', '15.00', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1725', 'BANDO', 'CORREAS'),
(801, 'PRODUCTO', 'MICRO V: 6PK1730', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1730 (17,30 Pulgadas)', 'MICRO V: 6PK1730 (17,30 Pulgadas)', '15.04', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1730', 'BANDO', 'CORREAS'),
(802, 'PRODUCTO', 'MICRO V: 6PK1735', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1735 (17,35 Pulgadas)', 'MICRO V: 6PK1735 (17,35 Pulgadas)', '15.09', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1735', 'BANDO', 'CORREAS'),
(803, 'PRODUCTO', 'MICRO V: 6PK1740', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1740 (17,40 Pulgadas)', 'MICRO V: 6PK1740 (17,40 Pulgadas)', '13.54', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1740', 'BANDO', 'CORREAS'),
(804, 'PRODUCTO', 'MICRO V: 6PK1750', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1750 (17,50 Pulgadas)', 'MICRO V: 6PK1750 (17,50 Pulgadas)', '15.22', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1750', 'BANDO', 'CORREAS'),
(805, 'PRODUCTO', 'MICRO V: 6PK1755', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1755 (17,55 Pulgadas)', 'MICRO V: 6PK1755 (17,55 Pulgadas)', '15.29', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1755', 'BANDO', 'CORREAS'),
(806, 'PRODUCTO', 'MICRO V: 6PK1760', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1760 (17,60 Pulgadas)', 'MICRO V: 6PK1760 (17,60 Pulgadas)', '15.33', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1760', 'BANDO', 'CORREAS'),
(807, 'PRODUCTO', 'MICRO V: 6PK1765', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1765 (17,65 Pulgadas)', 'MICRO V: 6PK1765 (17,65 Pulgadas)', '15.35', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1765', 'BANDO', 'CORREAS'),
(808, 'PRODUCTO', 'MICRO V: 6PK1790', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1790 (17,90 Pulgadas)', 'MICRO V: 6PK1790 (17,90 Pulgadas)', '15.57', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1790', 'BANDO', 'CORREAS'),
(809, 'PRODUCTO', 'MICRO V: 6PK1800', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1800 (18,00 Pulgadas)', 'MICRO V: 6PK1800 (18,00 Pulgadas)', '15.66', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1800', 'BANDO', 'CORREAS'),
(810, 'PRODUCTO', 'MICRO V: 6PK1805', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1805 (18,05 Pulgadas)', 'MICRO V: 6PK1805 (18,05 Pulgadas)', '15.68', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1805', 'BANDO', 'CORREAS'),
(811, 'PRODUCTO', 'MICRO V: 6PK1810', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1810 (18,10 Pulgadas)', 'MICRO V: 6PK1810 (18,10 Pulgadas)', '15.75', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1810', 'BANDO', 'CORREAS'),
(812, 'PRODUCTO', 'MICRO V: 6PK1815', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1815 (18,15 Pulgadas)', 'MICRO V: 6PK1815 (18,15 Pulgadas)', '15.77', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1815', 'BANDO', 'CORREAS'),
(813, 'PRODUCTO', 'MICRO V: 6PK1820', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1820 (18,20 Pulgadas)', 'MICRO V: 6PK1820 (18,20 Pulgadas)', '15.84', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1820', 'BANDO', 'CORREAS'),
(814, 'PRODUCTO', 'MICRO V: 6PK1825', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1825 (18,25 Pulgadas)', 'MICRO V: 6PK1825 (18,25 Pulgadas)', '15.88', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1825', 'BANDO', 'CORREAS'),
(815, 'PRODUCTO', 'MICRO V: 6PK1830', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1830 (18,30 Pulgadas)', 'MICRO V: 6PK1830 (18,30 Pulgadas)', '15.90', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1830', 'BANDO', 'CORREAS'),
(816, 'PRODUCTO', 'MICRO V: 6PK1840', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1840 (18,40 Pulgadas)', 'MICRO V: 6PK1840 (18,40 Pulgadas)', '16.01', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1840', 'BANDO', 'CORREAS'),
(817, 'PRODUCTO', 'MICRO V: 6PK1850', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1850 (18,50 Pulgadas)', 'MICRO V: 6PK1850 (18,50 Pulgadas)', '14.51', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1850', 'BANDO', 'CORREAS'),
(818, 'PRODUCTO', 'MICRO V: 6PK1860', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1860 (18,60 Pulgadas)', 'MICRO V: 6PK1860 (18,60 Pulgadas)', '16.17', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1860', 'BANDO', 'CORREAS'),
(819, 'PRODUCTO', 'MICRO V: 6PK1865', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1865 (18,65 Pulgadas)', 'MICRO V: 6PK1865 (18,65 Pulgadas)', '16.23', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1865', 'BANDO', 'CORREAS'),
(820, 'PRODUCTO', 'MICRO V: 6PK1870', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1870 (18,70 Pulgadas)', 'MICRO V: 6PK1870 (18,70 Pulgadas)', '16.26', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1870', 'BANDO', 'CORREAS'),
(821, 'PRODUCTO', 'MICRO V: 6PK1875', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1875 (18,75 Pulgadas)', 'MICRO V: 6PK1875 (18,75 Pulgadas)', '16.30', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1875', 'BANDO', 'CORREAS'),
(822, 'PRODUCTO', 'MICRO V: 6PK1880', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1880 (18,80 Pulgadas)', 'MICRO V: 6PK1880 (18,80 Pulgadas)', '16.34', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1880', 'BANDO', 'CORREAS'),
(823, 'PRODUCTO', 'MICRO V: 6PK1885', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1885 (18,85 Pulgadas)', 'MICRO V: 6PK1885 (18,85 Pulgadas)', '16.39', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1885', 'BANDO', 'CORREAS'),
(824, 'PRODUCTO', 'MICRO V: 6PK1890', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1890 (18,90 Pulgadas)', 'MICRO V: 6PK1890 (18,90 Pulgadas)', '16.43', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1890', 'BANDO', 'CORREAS'),
(825, 'PRODUCTO', 'MICRO V: 6PK1900', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1900 (19,00 Pulgadas)', 'MICRO V: 6PK1900 (19,00 Pulgadas)', '16.52', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1900', 'BANDO', 'CORREAS'),
(826, 'PRODUCTO', 'MICRO V: 6PK1905', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1905 (19,05 Pulgadas)', 'MICRO V: 6PK1905 (19,05 Pulgadas)', '16.56', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1905', 'BANDO', 'CORREAS'),
(827, 'PRODUCTO', 'MICRO V: 6PK1910', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1910 (19,10 Pulgadas)', 'MICRO V: 6PK1910 (19,10 Pulgadas)', '16.61', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1910', 'BANDO', 'CORREAS'),
(828, 'PRODUCTO', 'MICRO V: 6PK1920', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1920 (19,20 Pulgadas)', 'MICRO V: 6PK1920 (19,20 Pulgadas)', '16.70', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1920', 'BANDO', 'CORREAS'),
(829, 'PRODUCTO', 'MICRO V: 6PK1925', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1925 (19,25 Pulgadas)', 'MICRO V: 6PK1925 (19,25 Pulgadas)', '16.74', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1925', 'BANDO', 'CORREAS'),
(830, 'PRODUCTO', 'MICRO V: 6PK1930', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1930 (19,30 Pulgadas)', 'MICRO V: 6PK1930 (19,30 Pulgadas)', '16.79', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1930', 'BANDO', 'CORREAS'),
(831, 'PRODUCTO', 'MICRO V: 6PK1940', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1940 (19,40 Pulgadas)', 'MICRO V: 6PK1940 (19,40 Pulgadas)', '16.87', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1940', 'BANDO', 'CORREAS'),
(832, 'PRODUCTO', 'MICRO V: 6PK1955', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1955 (19,55 Pulgadas)', 'MICRO V: 6PK1955 (19,55 Pulgadas)', '17.01', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1955', 'BANDO', 'CORREAS'),
(833, 'PRODUCTO', 'MICRO V: 6PK1960', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1960 (19,60 Pulgadas)', 'MICRO V: 6PK1960 (19,60 Pulgadas)', '17.07', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1960', 'BANDO', 'CORREAS'),
(834, 'PRODUCTO', 'MICRO V: 6PK1965', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1965 (19,65 Pulgadas)', 'MICRO V: 6PK1965 (19,65 Pulgadas)', '17.09', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1965', 'BANDO', 'CORREAS'),
(835, 'PRODUCTO', 'MICRO V: 6PK1970', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1970 (19,70 Pulgadas)', 'MICRO V: 6PK1970 (19,70 Pulgadas)', '17.14', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK1970', 'BANDO', 'CORREAS'),
(836, 'PRODUCTO', 'MICRO V: 6PK1980', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1980 (19,80 Pulgadas)', 'MICRO V: 6PK1980 (19,80 Pulgadas)', '17.23', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK1980', 'BANDO', 'CORREAS'),
(837, 'PRODUCTO', 'MICRO V: 6PK1995', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK1995 (19,95 Pulgadas)', 'MICRO V: 6PK1995 (19,95 Pulgadas)', '17.36', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK1995', 'BANDO', 'CORREAS'),
(838, 'PRODUCTO', 'MICRO V: 6PK2000', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2000 (20,00 Pulgadas)', 'MICRO V: 6PK2000 (20,00 Pulgadas)', '22.12', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2000', 'BANDO', 'CORREAS'),
(839, 'PRODUCTO', 'MICRO V: 6PK2005', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2005 (20,05 Pulgadas)', 'MICRO V: 6PK2005 (20,05 Pulgadas)', '17.42', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2005', 'BANDO', 'CORREAS'),
(840, 'PRODUCTO', 'MICRO V: 6PK2010', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2010 (20,10 Pulgadas)', 'MICRO V: 6PK2010 (20,10 Pulgadas)', '17.47', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2010', 'BANDO', 'CORREAS'),
(841, 'PRODUCTO', 'MICRO V: 6PK2020', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2020 (20,20 Pulgadas)', 'MICRO V: 6PK2020 (20,20 Pulgadas)', '17.56', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2020', 'BANDO', 'CORREAS'),
(842, 'PRODUCTO', 'MICRO V: 6PK2025', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2025 (20,25 Pulgadas)', 'MICRO V: 6PK2025 (20,25 Pulgadas)', '17.60', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2025', 'BANDO', 'CORREAS'),
(843, 'PRODUCTO', 'MICRO V: 6PK2045', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2045 (20,45 Pulgadas)', 'MICRO V: 6PK2045 (20,45 Pulgadas)', '17.78', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2045', 'BANDO', 'CORREAS'),
(844, 'PRODUCTO', 'MICRO V: 6PK2050', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2050 (20,50 Pulgadas)', 'MICRO V: 6PK2050 (20,50 Pulgadas)', '17.82', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2050', 'BANDO', 'CORREAS'),
(845, 'PRODUCTO', 'MICRO V: 6PK2055', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2055 (20,55 Pulgadas)', 'MICRO V: 6PK2055 (20,55 Pulgadas)', '17.87', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2055', 'BANDO', 'CORREAS'),
(846, 'PRODUCTO', 'MICRO V: 6PK2060', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2060 (20,60 Pulgadas)', 'MICRO V: 6PK2060 (20,60 Pulgadas)', '17.91', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2060', 'BANDO', 'CORREAS'),
(847, 'PRODUCTO', 'MICRO V: 6PK2070', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2070 (20,70 Pulgadas)', 'MICRO V: 6PK2070 (20,70 Pulgadas)', '18.00', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2070', 'BANDO', 'CORREAS'),
(848, 'PRODUCTO', 'MICRO V: 6PK2075', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2075 (20,75 Pulgadas)', 'MICRO V: 6PK2075 (20,75 Pulgadas)', '18.06', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2075', 'BANDO', 'CORREAS'),
(849, 'PRODUCTO', 'MICRO V: 6PK2080', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2080 (20,80 Pulgadas)', 'MICRO V: 6PK2080 (20,80 Pulgadas)', '18.09', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2080', 'BANDO', 'CORREAS'),
(850, 'PRODUCTO', 'MICRO V: 6PK2085', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2085 (20,85 Pulgadas)', 'MICRO V: 6PK2085 (20,85 Pulgadas)', '18.17', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2085', 'BANDO', 'CORREAS'),
(851, 'PRODUCTO', 'MICRO V: 6PK2095', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2095 (20,95 Pulgadas)', 'MICRO V: 6PK2095 (20,95 Pulgadas)', '18.22', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2095', 'BANDO', 'CORREAS'),
(852, 'PRODUCTO', 'MICRO V: 6PK2100', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2100 (21,00 Pulgadas)', 'MICRO V: 6PK2100 (21,00 Pulgadas)', '18.26', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2100', 'BANDO', 'CORREAS'),
(853, 'PRODUCTO', 'MICRO V: 6PK2110', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2110 (21,10 Pulgadas)', 'MICRO V: 6PK2110 (21,10 Pulgadas)', '18.35', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2110', 'BANDO', 'CORREAS'),
(854, 'PRODUCTO', 'MICRO V: 6PK2120', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2120 (21,20 Pulgadas)', 'MICRO V: 6PK2120 (21,20 Pulgadas)', '18.44', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2120', 'BANDO', 'CORREAS'),
(855, 'PRODUCTO', 'MICRO V: 6PK2125', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2125 (21,25 Pulgadas)', 'MICRO V: 6PK2125 (21,25 Pulgadas)', '18.48', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2125', 'BANDO', 'CORREAS'),
(856, 'PRODUCTO', 'MICRO V: 6PK2130', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2130 (21,30 Pulgadas)', 'MICRO V: 6PK2130 (21,30 Pulgadas)', '18.50', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2130', 'BANDO', 'CORREAS'),
(857, 'PRODUCTO', 'MICRO V: 6PK2135', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2135 (21,35 Pulgadas)', 'MICRO V: 6PK2135 (21,35 Pulgadas)', '18.57', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2135', 'BANDO', 'CORREAS'),
(858, 'PRODUCTO', 'MICRO V: 6PK2145', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2145 (21,45 Pulgadas)', 'MICRO V: 6PK2145 (21,45 Pulgadas)', '18.66', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2145', 'BANDO', 'CORREAS'),
(859, 'PRODUCTO', 'MICRO V: 6PK2150', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2150 (21,50 Pulgadas)', 'MICRO V: 6PK2150 (21,50 Pulgadas)', '18.70', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2150', 'BANDO', 'CORREAS'),
(860, 'PRODUCTO', 'MICRO V: 6PK2155', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2155 (21,55 Pulgadas)', 'MICRO V: 6PK2155 (21,55 Pulgadas)', '18.75', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2155', 'BANDO', 'CORREAS'),
(861, 'PRODUCTO', 'MICRO V: 6PK2160', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2160 (21,60 Pulgadas)', 'MICRO V: 6PK2160 (21,60 Pulgadas)', '18.77', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2160', 'BANDO', 'CORREAS'),
(862, 'PRODUCTO', 'MICRO V: 6PK2165', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2165 (21,65 Pulgadas)', 'MICRO V: 6PK2165 (21,65 Pulgadas)', '18.81', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2165', 'BANDO', 'CORREAS'),
(863, 'PRODUCTO', 'MICRO V: 6PK2170', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2170 (21,70 Pulgadas)', 'MICRO V: 6PK2170 (21,70 Pulgadas)', '18.88', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2170', 'BANDO', 'CORREAS'),
(864, 'PRODUCTO', 'MICRO V: 6PK2175', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2175 (21,75 Pulgadas)', 'MICRO V: 6PK2175 (21,75 Pulgadas)', '18.92', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2175', 'BANDO', 'CORREAS'),
(865, 'PRODUCTO', 'MICRO V: 6PK2185', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2185 (21,85 Pulgadas)', 'MICRO V: 6PK2185 (21,85 Pulgadas)', '18.99', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2185', 'BANDO', 'CORREAS'),
(866, 'PRODUCTO', 'MICRO V: 6PK2195', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2195 (21,95 Pulgadas)', 'MICRO V: 6PK2195 (21,95 Pulgadas)', '19.10', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2195', 'BANDO', 'CORREAS'),
(867, 'PRODUCTO', 'MICRO V: 6PK2200', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2200 (22,00 Pulgadas)', 'MICRO V: 6PK2200 (22,00 Pulgadas)', '19.12', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2200', 'BANDO', 'CORREAS'),
(868, 'PRODUCTO', 'MICRO V: 6PK2205', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2205 (22,05 Pulgadas)', 'MICRO V: 6PK2205 (22,05 Pulgadas)', '19.17', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2205', 'BANDO', 'CORREAS'),
(869, 'PRODUCTO', 'MICRO V: 6PK2210', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2210 (22,10 Pulgadas)', 'MICRO V: 6PK2210 (22,10 Pulgadas)', '19.23', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2210', 'BANDO', 'CORREAS'),
(870, 'PRODUCTO', 'MICRO V: 6PK2220', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2220 (22,20 Pulgadas)', 'MICRO V: 6PK2220 (22,20 Pulgadas)', '19.32', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2220', 'BANDO', 'CORREAS'),
(871, 'PRODUCTO', 'MICRO V: 6PK2225', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2225 (22,25 Pulgadas)', 'MICRO V: 6PK2225 (22,25 Pulgadas)', '19.34', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2225', 'BANDO', 'CORREAS'),
(872, 'PRODUCTO', 'MICRO V: 6PK2230', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2230 (22,30 Pulgadas)', 'MICRO V: 6PK2230 (22,30 Pulgadas)', '19.41', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2230', 'BANDO', 'CORREAS'),
(873, 'PRODUCTO', 'MICRO V: 6PK2235', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2235 (22,35 Pulgadas)', 'MICRO V: 6PK2235 (22,35 Pulgadas)', '19.45', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2235', 'BANDO', 'CORREAS'),
(874, 'PRODUCTO', 'MICRO V: 6PK2240', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2240 (22,40 Pulgadas)', 'MICRO V: 6PK2240 (22,40 Pulgadas)', '19.48', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2240', 'BANDO', 'CORREAS'),
(875, 'PRODUCTO', 'MICRO V: 6PK2245', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2245 (22,45 Pulgadas)', 'MICRO V: 6PK2245 (22,45 Pulgadas)', '19.52', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2245', 'BANDO', 'CORREAS'),
(876, 'PRODUCTO', 'MICRO V: 6PK2247', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2247 (22,47 Pulgadas)', 'MICRO V: 6PK2247 (22,47 Pulgadas)', '19.54', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2247', 'BANDO', 'CORREAS'),
(877, 'PRODUCTO', 'MICRO V: 6PK2250', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2250 (22,50 Pulgadas)', 'MICRO V: 6PK2250 (22,50 Pulgadas)', '19.59', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2250', 'BANDO', 'CORREAS'),
(878, 'PRODUCTO', 'MICRO V: 6PK2255', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2255 (22,55 Pulgadas)', 'MICRO V: 6PK2255 (22,55 Pulgadas)', '19.61', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2255', 'BANDO', 'CORREAS'),
(879, 'PRODUCTO', 'MICRO V: 6PK2260', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2260 (22,60 Pulgadas)', 'MICRO V: 6PK2260 (22,60 Pulgadas)', '19.65', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2260', 'BANDO', 'CORREAS'),
(880, 'PRODUCTO', 'MICRO V: 6PK2270', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2270 (22,70 Pulgadas)', 'MICRO V: 6PK2270 (22,70 Pulgadas)', '19.74', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2270', 'BANDO', 'CORREAS'),
(881, 'PRODUCTO', 'MICRO V: 6PK2275', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2275 (22,75 Pulgadas)', 'MICRO V: 6PK2275 (22,75 Pulgadas)', '19.78', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2275', 'BANDO', 'CORREAS'),
(882, 'PRODUCTO', 'MICRO V: 6PK2280', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2280 (22,80 Pulgadas)', 'MICRO V: 6PK2280 (22,80 Pulgadas)', '19.78', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2280', 'BANDO', 'CORREAS'),
(883, 'PRODUCTO', 'MICRO V: 6PK2285', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2285 (22,85 Pulgadas)', 'MICRO V: 6PK2285 (22,85 Pulgadas)', '19.87', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2285', 'BANDO', 'CORREAS'),
(884, 'PRODUCTO', 'MICRO V: 6PK2290', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2290 (22,90 Pulgadas)', 'MICRO V: 6PK2290 (22,90 Pulgadas)', '19.92', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2290', 'BANDO', 'CORREAS'),
(885, 'PRODUCTO', 'MICRO V: 6PK2300', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2300 (23,00 Pulgadas)', 'MICRO V: 6PK2300 (23,00 Pulgadas)', '20.00', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2300', 'BANDO', 'CORREAS'),
(886, 'PRODUCTO', 'MICRO V: 6PK2310', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2310 (23,10 Pulgadas)', 'MICRO V: 6PK2310 (23,10 Pulgadas)', '20.09', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2310', 'BANDO', 'CORREAS'),
(887, 'PRODUCTO', 'MICRO V: 6PK2315', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2315 (23,15 Pulgadas)', 'MICRO V: 6PK2315 (23,15 Pulgadas)', '20.14', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2315', 'BANDO', 'CORREAS'),
(888, 'PRODUCTO', 'MICRO V: 6PK2320', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2320 (23,20 Pulgadas)', 'MICRO V: 6PK2320 (23,20 Pulgadas)', '20.18', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2320', 'BANDO', 'CORREAS'),
(889, 'PRODUCTO', 'MICRO V: 6PK2325', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2325 (23,25 Pulgadas)', 'MICRO V: 6PK2325 (23,25 Pulgadas)', '20.22', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2325', 'BANDO', 'CORREAS'),
(890, 'PRODUCTO', 'MICRO V: 6PK2330', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2330 (23,30 Pulgadas)', 'MICRO V: 6PK2330 (23,30 Pulgadas)', '20.27', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2330', 'BANDO', 'CORREAS'),
(891, 'PRODUCTO', 'MICRO V: 6PK2335', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2335 (23,35 Pulgadas)', 'MICRO V: 6PK2335 (23,35 Pulgadas)', '20.29', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2335', 'BANDO', 'CORREAS'),
(892, 'PRODUCTO', 'MICRO V: 6PK2340', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2340 (23,40 Pulgadas)', 'MICRO V: 6PK2340 (23,40 Pulgadas)', '20.36', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2340', 'BANDO', 'CORREAS'),
(893, 'PRODUCTO', 'MICRO V: 6PK2345', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2345 (23,45 Pulgadas)', 'MICRO V: 6PK2345 (23,45 Pulgadas)', '20.40', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2345', 'BANDO', 'CORREAS'),
(894, 'PRODUCTO', 'MICRO V: 6PK2350', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2350 (23,50 Pulgadas)', 'MICRO V: 6PK2350 (23,50 Pulgadas)', '20.42', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2350', 'BANDO', 'CORREAS'),
(895, 'PRODUCTO', 'MICRO V: 6PK2360', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2360 (23,60 Pulgadas)', 'MICRO V: 6PK2360 (23,60 Pulgadas)', '20.51', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2360', 'BANDO', 'CORREAS'),
(896, 'PRODUCTO', 'MICRO V: 6PK2365', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2365 (23,65 Pulgadas)', 'MICRO V: 6PK2365 (23,65 Pulgadas)', '20.58', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2365', 'BANDO', 'CORREAS'),
(897, 'PRODUCTO', 'MICRO V: 6PK2370', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2370 (23,70 Pulgadas)', 'MICRO V: 6PK2370 (23,70 Pulgadas)', '20.60', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2370', 'BANDO', 'CORREAS'),
(898, 'PRODUCTO', 'MICRO V: 6PK2375', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2375 (23,75 Pulgadas)', 'MICRO V: 6PK2375 (23,75 Pulgadas)', '20.64', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2375', 'BANDO', 'CORREAS'),
(899, 'PRODUCTO', 'MICRO V: 6PK2380', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2380 (23,80 Pulgadas)', 'MICRO V: 6PK2380 (23,80 Pulgadas)', '20.69', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2380', 'BANDO', 'CORREAS'),
(900, 'PRODUCTO', 'MICRO V: 6PK2385', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2385 (23,85 Pulgadas)', 'MICRO V: 6PK2385 (23,85 Pulgadas)', '20.75', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2385', 'BANDO', 'CORREAS'),
(901, 'PRODUCTO', 'MICRO V: 6PK2390', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2390 (23,90 Pulgadas)', 'MICRO V: 6PK2390 (23,90 Pulgadas)', '20.78', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2390', 'BANDO', 'CORREAS'),
(902, 'PRODUCTO', 'MICRO V: 6PK2395', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2395 (23,95 Pulgadas)', 'MICRO V: 6PK2395 (23,95 Pulgadas)', '20.82', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2395', 'BANDO', 'CORREAS'),
(903, 'PRODUCTO', 'MICRO V: 6PK2400', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2400 (24,00 Pulgadas)', 'MICRO V: 6PK2400 (24,00 Pulgadas)', '20.86', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2400', 'BANDO', 'CORREAS'),
(904, 'PRODUCTO', 'MICRO V: 6PK2405', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2405 (24,05 Pulgadas)', 'MICRO V: 6PK2405 (24,05 Pulgadas)', '20.91', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2405', 'BANDO', 'CORREAS'),
(905, 'PRODUCTO', 'MICRO V: 6PK2415', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2415 (24,15 Pulgadas)', 'MICRO V: 6PK2415 (24,15 Pulgadas)', '21.00', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2415', 'BANDO', 'CORREAS'),
(906, 'PRODUCTO', 'MICRO V: 6PK2425', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2425 (24,25 Pulgadas)', 'MICRO V: 6PK2425 (24,25 Pulgadas)', '21.08', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2425', 'BANDO', 'CORREAS'),
(907, 'PRODUCTO', 'MICRO V: 6PK2435', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2435 (24,35 Pulgadas)', 'MICRO V: 6PK2435 (24,35 Pulgadas)', '21.17', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2435', 'BANDO', 'CORREAS'),
(908, 'PRODUCTO', 'MICRO V: 6PK2440', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2440 (24,40 Pulgadas)', 'MICRO V: 6PK2440 (24,40 Pulgadas)', '21.20', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2440', 'BANDO', 'CORREAS'),
(909, 'PRODUCTO', 'MICRO V: 6PK2445', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2445 (24,45 Pulgadas)', 'MICRO V: 6PK2445 (24,45 Pulgadas)', '21.31', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2445', 'BANDO', 'CORREAS'),
(910, 'PRODUCTO', 'MICRO V: 6PK2455', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2455 (24,55 Pulgadas)', 'MICRO V: 6PK2455 (24,55 Pulgadas)', '21.33', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2455', 'BANDO', 'CORREAS'),
(911, 'PRODUCTO', 'MICRO V: 6PK2460', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2460 (24,60 Pulgadas)', 'MICRO V: 6PK2460 (24,60 Pulgadas)', '21.42', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2460', 'BANDO', 'CORREAS'),
(912, 'PRODUCTO', 'MICRO V: 6PK2465', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2465 (24,65 Pulgadas)', 'MICRO V: 6PK2465 (24,65 Pulgadas)', '21.44', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2465', 'BANDO', 'CORREAS'),
(913, 'PRODUCTO', 'MICRO V: 6PK2475', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2475 (24,75 Pulgadas)', 'MICRO V: 6PK2475 (24,75 Pulgadas)', '21.53', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2475', 'BANDO', 'CORREAS'),
(914, 'PRODUCTO', 'MICRO V: 6PK2480', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2480 (24,80 Pulgadas)', 'MICRO V: 6PK2480 (24,80 Pulgadas)', '21.55', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2480', 'BANDO', 'CORREAS'),
(915, 'PRODUCTO', 'MICRO V: 6PK2490', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2490 (24,90 Pulgadas)', 'MICRO V: 6PK2490 (24,90 Pulgadas)', '21.66', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2490', 'BANDO', 'CORREAS'),
(916, 'PRODUCTO', 'MICRO V: 6PK2500', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2500 (25,00 Pulgadas)', 'MICRO V: 6PK2500 (25,00 Pulgadas)', '21.72', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2500', 'BANDO', 'CORREAS'),
(917, 'PRODUCTO', 'MICRO V: 6PK2505', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2505 (25,05 Pulgadas)', 'MICRO V: 6PK2505 (25,05 Pulgadas)', '21.79', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2505', 'BANDO', 'CORREAS'),
(918, 'PRODUCTO', 'MICRO V: 6PK2515', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2515 (25,15 Pulgadas)', 'MICRO V: 6PK2515 (25,15 Pulgadas)', '21.86', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2515', 'BANDO', 'CORREAS'),
(919, 'PRODUCTO', 'MICRO V: 6PK2525', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2525 (25,25 Pulgadas)', 'MICRO V: 6PK2525 (25,25 Pulgadas)', '21.97', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2525', 'BANDO', 'CORREAS'),
(920, 'PRODUCTO', 'MICRO V: 6PK2530', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2530 (25,30 Pulgadas)', 'MICRO V: 6PK2530 (25,30 Pulgadas)', '21.99', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2530', 'BANDO', 'CORREAS'),
(921, 'PRODUCTO', 'MICRO V: 6PK2540', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2540 (25,40 Pulgadas)', 'MICRO V: 6PK2540 (25,40 Pulgadas)', '22.10', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2540', 'BANDO', 'CORREAS'),
(922, 'PRODUCTO', 'MICRO V: 6PK2555', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2555 (25,55 Pulgadas)', 'MICRO V: 6PK2555 (25,55 Pulgadas)', '22.21', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2555', 'BANDO', 'CORREAS'),
(923, 'PRODUCTO', 'MICRO V: 6PK2560', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2560 (25,60 Pulgadas)', 'MICRO V: 6PK2560 (25,60 Pulgadas)', '22.25', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2560', 'BANDO', 'CORREAS'),
(924, 'PRODUCTO', 'MICRO V: 6PK2565', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2565 (25,65 Pulgadas)', 'MICRO V: 6PK2565 (25,65 Pulgadas)', '22.32', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2565', 'BANDO', 'CORREAS'),
(925, 'PRODUCTO', 'MICRO V: 6PK2575', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2575 (25,75 Pulgadas)', 'MICRO V: 6PK2575 (25,75 Pulgadas)', '22.39', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2575', 'BANDO', 'CORREAS'),
(926, 'PRODUCTO', 'MICRO V: 6PK2580', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2580 (25,80 Pulgadas)', 'MICRO V: 6PK2580 (25,80 Pulgadas)', '22.45', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2580', 'BANDO', 'CORREAS'),
(927, 'PRODUCTO', 'MICRO V: 6PK2585', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2585 (25,85 Pulgadas)', 'MICRO V: 6PK2585 (25,85 Pulgadas)', '22.50', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2585', 'BANDO', 'CORREAS'),
(928, 'PRODUCTO', 'MICRO V: 6PK2590', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2590 (25,90 Pulgadas)', 'MICRO V: 6PK2590 (25,90 Pulgadas)', '22.52', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2590', 'BANDO', 'CORREAS'),
(929, 'PRODUCTO', 'MICRO V: 6PK2600', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2600 (26,00 Pulgadas)', 'MICRO V: 6PK2600 (26,00 Pulgadas)', '22.61', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2600', 'BANDO', 'CORREAS'),
(930, 'PRODUCTO', 'MICRO V: 6PK2605', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2605 (26,05 Pulgadas)', 'MICRO V: 6PK2605 (26,05 Pulgadas)', '22.72', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2605', 'BANDO', 'CORREAS'),
(931, 'PRODUCTO', 'MICRO V: 6PK2615', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2615 (26,15 Pulgadas)', 'MICRO V: 6PK2615 (26,15 Pulgadas)', '22.74', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2615', 'BANDO', 'CORREAS'),
(932, 'PRODUCTO', 'MICRO V: 6PK2620', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2620 (26,20 Pulgadas)', 'MICRO V: 6PK2620 (26,20 Pulgadas)', '22.78', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2620', 'BANDO', 'CORREAS'),
(933, 'PRODUCTO', 'MICRO V: 6PK2635', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2635 (26,35 Pulgadas)', 'MICRO V: 6PK2635 (26,35 Pulgadas)', '22.94', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2635', 'BANDO', 'CORREAS'),
(934, 'PRODUCTO', 'MICRO V: 6PK2655', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2655 (26,55 Pulgadas)', 'MICRO V: 6PK2655 (26,55 Pulgadas)', '23.09', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2655', 'BANDO', 'CORREAS'),
(935, 'PRODUCTO', 'MICRO V: 6PK2680', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2680 (26,80 Pulgadas)', 'MICRO V: 6PK2680 (26,80 Pulgadas)', '23.29', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2680', 'BANDO', 'CORREAS'),
(936, 'PRODUCTO', 'MICRO V: 6PK2685', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2685 (26,85 Pulgadas)', 'MICRO V: 6PK2685 (26,85 Pulgadas)', '23.36', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2685', 'BANDO', 'CORREAS'),
(937, 'PRODUCTO', 'MICRO V: 6PK2705', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2705 (27,05 Pulgadas)', 'MICRO V: 6PK2705 (27,05 Pulgadas)', '23.51', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2705', 'BANDO', 'CORREAS'),
(938, 'PRODUCTO', 'MICRO V: 6PK2730', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2730 (27,30 Pulgadas)', 'MICRO V: 6PK2730 (27,30 Pulgadas)', '23.73', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2730', 'BANDO', 'CORREAS'),
(939, 'PRODUCTO', 'MICRO V: 6PK2745', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2745 (27,45 Pulgadas)', 'MICRO V: 6PK2745 (27,45 Pulgadas)', '23.86', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2745', 'BANDO', 'CORREAS'),
(940, 'PRODUCTO', 'MICRO V: 6PK2775', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2775 (27,75 Pulgadas)', 'MICRO V: 6PK2775 (27,75 Pulgadas)', '24.13', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2775', 'BANDO', 'CORREAS'),
(941, 'PRODUCTO', 'MICRO V: 6PK2805', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2805 (28,05 Pulgadas)', 'MICRO V: 6PK2805 (28,05 Pulgadas)', '24.39', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2805', 'BANDO', 'CORREAS'),
(942, 'PRODUCTO', 'MICRO V: 6PK2830', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2830 (28,30 Pulgadas)', 'MICRO V: 6PK2830 (28,30 Pulgadas)', '24.61', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2830', 'BANDO', 'CORREAS'),
(943, 'PRODUCTO', 'MICRO V: 6PK2840', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2840 (28,40 Pulgadas)', 'MICRO V: 6PK2840 (28,40 Pulgadas)', '24.68', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2840', 'BANDO', 'CORREAS');
INSERT INTO `sspi_productos` (`ID_PRODUCTO`, `TIPO_PRODUCTO_SERVICIO`, `NOMBRE_PRODUCTO`, `NOMBRE_CATEGORIA`, `DESCRIPCION_CORTA`, `DESCRIPCION_LARGA`, `PRECIO_UNITARIO_DOLARES`, `FOTO_1_CARRUSEL`, `FOTO_2_CORTA`, `FOTO_3_LARGA`, `UNIDAD_DE_VENTA`, `CANTIDAD_DISPONIBLE`, `DESTACADO`, `CODIGO`, `MARCA`, `RUBRO`) VALUES
(944, 'PRODUCTO', 'MICRO V: 6PK2845', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2845 (28,45 Pulgadas)', 'MICRO V: 6PK2845 (28,45 Pulgadas)', '24.75', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2845', 'BANDO', 'CORREAS'),
(945, 'PRODUCTO', 'MICRO V: 6PK2870', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2870 (28,70 Pulgadas)', 'MICRO V: 6PK2870 (28,70 Pulgadas)', '24.97', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2870', 'BANDO', 'CORREAS'),
(946, 'PRODUCTO', 'MICRO V: 6PK2890', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2890 (28,90 Pulgadas)', 'MICRO V: 6PK2890 (28,90 Pulgadas)', '25.12', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2890', 'BANDO', 'CORREAS'),
(947, 'PRODUCTO', 'MICRO V: 6PK2900', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2900 (29,00 Pulgadas)', 'MICRO V: 6PK2900 (29,00 Pulgadas)', '25.23', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2900', 'BANDO', 'CORREAS'),
(948, 'PRODUCTO', 'MICRO V: 6PK2910', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2910 (29,10 Pulgadas)', 'MICRO V: 6PK2910 (29,10 Pulgadas)', '25.32', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK2910', 'BANDO', 'CORREAS'),
(949, 'PRODUCTO', 'MICRO V: 6PK2980', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2980 (29,80 Pulgadas)', 'MICRO V: 6PK2980 (29,80 Pulgadas)', '25.91', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK2980', 'BANDO', 'CORREAS'),
(950, 'PRODUCTO', 'MICRO V: 6PK2995', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK2995 (29,95 Pulgadas)', 'MICRO V: 6PK2995 (29,95 Pulgadas)', '26.05', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK2995', 'BANDO', 'CORREAS'),
(951, 'PRODUCTO', 'MICRO V: 6PK750', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK750 (K7,50 Pulgadas)', 'MICRO V: 6PK750 (K7,50 Pulgadas)', '8.30', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK750', 'BANDO', 'CORREAS'),
(952, 'PRODUCTO', 'MICRO V: 6PK780', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK780 (K7,80 Pulgadas)', 'MICRO V: 6PK780 (K7,80 Pulgadas)', '9.75', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK780', 'BANDO', 'CORREAS'),
(953, 'PRODUCTO', 'MICRO V: 6PK875', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK875 (K8,75 Pulgadas)', 'MICRO V: 6PK875 (K8,75 Pulgadas)', '9.64', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK875', 'BANDO', 'CORREAS'),
(954, 'PRODUCTO', 'MICRO V: 6PK880', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK880 (K8,80 Pulgadas)', 'MICRO V: 6PK880 (K8,80 Pulgadas)', '9.75', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK880', 'BANDO', 'CORREAS'),
(955, 'PRODUCTO', 'MICRO V: 6PK915', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK915 (K9,15 Pulgadas)', 'MICRO V: 6PK915 (K9,15 Pulgadas)', '10.13', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK915', 'BANDO', 'CORREAS'),
(956, 'PRODUCTO', 'MICRO V: 6PK920', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK920 (K9,20 Pulgadas)', 'MICRO V: 6PK920 (K9,20 Pulgadas)', '9.27', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK920', 'BANDO', 'CORREAS'),
(957, 'PRODUCTO', 'MICRO V: 6PK925', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK925 (K9,25 Pulgadas)', 'MICRO V: 6PK925 (K9,25 Pulgadas)', '7.22', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK925', 'BANDO', 'CORREAS'),
(958, 'PRODUCTO', 'MICRO V: 6PK930', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK930 (K9,30 Pulgadas)', 'MICRO V: 6PK930 (K9,30 Pulgadas)', '10.30', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK930', 'BANDO', 'CORREAS'),
(959, 'PRODUCTO', 'MICRO V: 6PK940', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK940 (K9,40 Pulgadas)', 'MICRO V: 6PK940 (K9,40 Pulgadas)', '10.39', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK940', 'BANDO', 'CORREAS'),
(960, 'PRODUCTO', 'MICRO V: 6PK945', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK945 (K9,45 Pulgadas)', 'MICRO V: 6PK945 (K9,45 Pulgadas)', '10.46', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK945', 'BANDO', 'CORREAS'),
(961, 'PRODUCTO', 'MICRO V: 6PK955', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK955 (K9,55 Pulgadas)', 'MICRO V: 6PK955 (K9,55 Pulgadas)', '10.57', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK955', 'BANDO', 'CORREAS'),
(962, 'PRODUCTO', 'MICRO V: 6PK965', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK965 (K9,65 Pulgadas)', 'MICRO V: 6PK965 (K9,65 Pulgadas)', '10.68', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '6PK965', 'BANDO', 'CORREAS'),
(963, 'PRODUCTO', 'MICRO V: 6PK986', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK986 (K9,86 Pulgadas)', 'MICRO V: 6PK986 (K9,86 Pulgadas)', '10.94', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '6PK986', 'BANDO', 'CORREAS'),
(964, 'PRODUCTO', 'MICRO V: 6PK990', 'CORREAS AUTOMOTRICES', 'MICRO V: 6PK990 (K9,90 Pulgadas)', 'MICRO V: 6PK990 (K9,90 Pulgadas)', '10.96', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '6PK990', 'BANDO', 'CORREAS'),
(965, 'PRODUCTO', 'MICRO V: 7PK1020', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1020 (10,20 Pulgadas)', 'MICRO V: 7PK1020 (10,20 Pulgadas)', '13.30', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK1020', 'BANDO', 'CORREAS'),
(966, 'PRODUCTO', 'MICRO V: 7PK1030', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1030 (10,30 Pulgadas)', 'MICRO V: 7PK1030 (10,30 Pulgadas)', '13.37', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK1030', 'BANDO', 'CORREAS'),
(967, 'PRODUCTO', 'MICRO V: 7PK1040', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1040 (10,40 Pulgadas)', 'MICRO V: 7PK1040 (10,40 Pulgadas)', '13.43', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK1040', 'BANDO', 'CORREAS'),
(968, 'PRODUCTO', 'MICRO V: 7PK1070', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1070 (10,70 Pulgadas)', 'MICRO V: 7PK1070 (10,70 Pulgadas)', '13.94', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK1070', 'BANDO', 'CORREAS'),
(969, 'PRODUCTO', 'MICRO V: 7PK1125', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1125 (11,25 Pulgadas)', 'MICRO V: 7PK1125 (11,25 Pulgadas)', '14.51', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK1125', 'BANDO', 'CORREAS'),
(970, 'PRODUCTO', 'MICRO V: 7PK1130', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1130 (11,30 Pulgadas)', 'MICRO V: 7PK1130 (11,30 Pulgadas)', '14.60', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK1130', 'BANDO', 'CORREAS'),
(971, 'PRODUCTO', 'MICRO V: 7PK1135', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1135 (11,35 Pulgadas)', 'MICRO V: 7PK1135 (11,35 Pulgadas)', '14.67', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK1135', 'BANDO', 'CORREAS'),
(972, 'PRODUCTO', 'MICRO V: 7PK1140', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1140 (11,40 Pulgadas)', 'MICRO V: 7PK1140 (11,40 Pulgadas)', '14.71', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK1140', 'BANDO', 'CORREAS'),
(973, 'PRODUCTO', 'MICRO V: 7PK1150', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1150 (11,50 Pulgadas)', 'MICRO V: 7PK1150 (11,50 Pulgadas)', '14.84', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK1150', 'BANDO', 'CORREAS'),
(974, 'PRODUCTO', 'MICRO V: 7PK1260', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1260 (12,60 Pulgadas)', 'MICRO V: 7PK1260 (12,60 Pulgadas)', '16.21', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK1260', 'BANDO', 'CORREAS'),
(975, 'PRODUCTO', 'MICRO V: 7PK1270', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1270 (12,70 Pulgadas)', 'MICRO V: 7PK1270 (12,70 Pulgadas)', '16.41', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK1270', 'BANDO', 'CORREAS'),
(976, 'PRODUCTO', 'MICRO V: 7PK1275', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1275 (12,75 Pulgadas)', 'MICRO V: 7PK1275 (12,75 Pulgadas)', '16.52', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK1275', 'BANDO', 'CORREAS'),
(977, 'PRODUCTO', 'MICRO V: 7PK1280', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1280 (12,80 Pulgadas)', 'MICRO V: 7PK1280 (12,80 Pulgadas)', '16.52', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK1280', 'BANDO', 'CORREAS'),
(978, 'PRODUCTO', 'MICRO V: 7PK1285', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1285 (12,85 Pulgadas)', 'MICRO V: 7PK1285 (12,85 Pulgadas)', '16.59', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK1285', 'BANDO', 'CORREAS'),
(979, 'PRODUCTO', 'MICRO V: 7PK1290', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1290 (12,90 Pulgadas)', 'MICRO V: 7PK1290 (12,90 Pulgadas)', '16.67', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK1290', 'BANDO', 'CORREAS'),
(980, 'PRODUCTO', 'MICRO V: 7PK1350', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1350 (13,50 Pulgadas)', 'MICRO V: 7PK1350 (13,50 Pulgadas)', '17.42', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK1350', 'BANDO', 'CORREAS'),
(981, 'PRODUCTO', 'MICRO V: 7PK1435', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1435 (14,35 Pulgadas)', 'MICRO V: 7PK1435 (14,35 Pulgadas)', '18.50', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK1435', 'BANDO', 'CORREAS'),
(982, 'PRODUCTO', 'MICRO V: 7PK1440', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1440 (14,40 Pulgadas)', 'MICRO V: 7PK1440 (14,40 Pulgadas)', '18.62', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK1440', 'BANDO', 'CORREAS'),
(983, 'PRODUCTO', 'MICRO V: 7PK1460', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1460 (14,60 Pulgadas)', 'MICRO V: 7PK1460 (14,60 Pulgadas)', '18.95', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK1460', 'BANDO', 'CORREAS'),
(984, 'PRODUCTO', 'MICRO V: 7PK1470', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1470 (14,70 Pulgadas)', 'MICRO V: 7PK1470 (14,70 Pulgadas)', '19.10', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK1470', 'BANDO', 'CORREAS'),
(985, 'PRODUCTO', 'MICRO V: 7PK1475', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1475 (14,75 Pulgadas)', 'MICRO V: 7PK1475 (14,75 Pulgadas)', '19.03', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK1475', 'BANDO', 'CORREAS'),
(986, 'PRODUCTO', 'MICRO V: 7PK1515', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1515 (15,15 Pulgadas)', 'MICRO V: 7PK1515 (15,15 Pulgadas)', '19.56', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK1515', 'BANDO', 'CORREAS'),
(987, 'PRODUCTO', 'MICRO V: 7PK1520', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1520 (15,20 Pulgadas)', 'MICRO V: 7PK1520 (15,20 Pulgadas)', '19.63', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK1520', 'BANDO', 'CORREAS'),
(988, 'PRODUCTO', 'MICRO V: 7PK1550', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1550 (15,50 Pulgadas)', 'MICRO V: 7PK1550 (15,50 Pulgadas)', '14.16', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK1550', 'BANDO', 'CORREAS'),
(989, 'PRODUCTO', 'MICRO V: 7PK1620', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1620 (16,20 Pulgadas)', 'MICRO V: 7PK1620 (16,20 Pulgadas)', '16.43', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK1620', 'BANDO', 'CORREAS'),
(990, 'PRODUCTO', 'MICRO V: 7PK1625', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1625 (16,25 Pulgadas)', 'MICRO V: 7PK1625 (16,25 Pulgadas)', '16.48', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK1625', 'BANDO', 'CORREAS'),
(991, 'PRODUCTO', 'MICRO V: 7PK1630', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1630 (16,30 Pulgadas)', 'MICRO V: 7PK1630 (16,30 Pulgadas)', '16.52', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK1630', 'BANDO', 'CORREAS'),
(992, 'PRODUCTO', 'MICRO V: 7PK1640', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1640 (16,40 Pulgadas)', 'MICRO V: 7PK1640 (16,40 Pulgadas)', '16.70', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK1640', 'BANDO', 'CORREAS'),
(993, 'PRODUCTO', 'MICRO V: 7PK1646', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1646 (16,46 Pulgadas)', 'MICRO V: 7PK1646 (16,46 Pulgadas)', '16.81', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK1646', 'BANDO', 'CORREAS'),
(994, 'PRODUCTO', 'MICRO V: 7PK1650', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1650 (16,50 Pulgadas)', 'MICRO V: 7PK1650 (16,50 Pulgadas)', '16.87', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK1650', 'BANDO', 'CORREAS'),
(995, 'PRODUCTO', 'MICRO V: 7PK1655', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1655 (16,55 Pulgadas)', 'MICRO V: 7PK1655 (16,55 Pulgadas)', '16.90', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK1655', 'BANDO', 'CORREAS'),
(996, 'PRODUCTO', 'MICRO V: 7PK1660', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1660 (16,60 Pulgadas)', 'MICRO V: 7PK1660 (16,60 Pulgadas)', '16.94', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK1660', 'BANDO', 'CORREAS'),
(997, 'PRODUCTO', 'MICRO V: 7PK1675', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1675 (16,75 Pulgadas)', 'MICRO V: 7PK1675 (16,75 Pulgadas)', '16.96', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK1675', 'BANDO', 'CORREAS'),
(998, 'PRODUCTO', 'MICRO V: 7PK1680', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1680 (16,80 Pulgadas)', 'MICRO V: 7PK1680 (16,80 Pulgadas)', '17.05', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK1680', 'BANDO', 'CORREAS'),
(999, 'PRODUCTO', 'MICRO V: 7PK1685', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1685 (16,85 Pulgadas)', 'MICRO V: 7PK1685 (16,85 Pulgadas)', '17.20', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK1685', 'BANDO', 'CORREAS'),
(1000, 'PRODUCTO', 'MICRO V: 7PK1690', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1690 (16,90 Pulgadas)', 'MICRO V: 7PK1690 (16,90 Pulgadas)', '17.27', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK1690', 'BANDO', 'CORREAS'),
(1001, 'PRODUCTO', 'MICRO V: 7PK1700', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1700 (17,00 Pulgadas)', 'MICRO V: 7PK1700 (17,00 Pulgadas)', '17.25', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK1700', 'BANDO', 'CORREAS'),
(1002, 'PRODUCTO', 'MICRO V: 7PK1710', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1710 (17,10 Pulgadas)', 'MICRO V: 7PK1710 (17,10 Pulgadas)', '17.29', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK1710', 'BANDO', 'CORREAS'),
(1003, 'PRODUCTO', 'MICRO V: 7PK1715', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1715 (17,15 Pulgadas)', 'MICRO V: 7PK1715 (17,15 Pulgadas)', '17.40', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK1715', 'BANDO', 'CORREAS'),
(1004, 'PRODUCTO', 'MICRO V: 7PK1720', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1720 (17,20 Pulgadas)', 'MICRO V: 7PK1720 (17,20 Pulgadas)', '17.51', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK1720', 'BANDO', 'CORREAS'),
(1005, 'PRODUCTO', 'MICRO V: 7PK1730', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1730 (17,30 Pulgadas)', 'MICRO V: 7PK1730 (17,30 Pulgadas)', '17.56', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK1730', 'BANDO', 'CORREAS'),
(1006, 'PRODUCTO', 'MICRO V: 7PK1732', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1732 (17,32 Pulgadas)', 'MICRO V: 7PK1732 (17,32 Pulgadas)', '17.58', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK1732', 'BANDO', 'CORREAS'),
(1007, 'PRODUCTO', 'MICRO V: 7PK1735', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1735 (17,35 Pulgadas)', 'MICRO V: 7PK1735 (17,35 Pulgadas)', '17.60', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK1735', 'BANDO', 'CORREAS'),
(1008, 'PRODUCTO', 'MICRO V: 7PK1740', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1740 (17,40 Pulgadas)', 'MICRO V: 7PK1740 (17,40 Pulgadas)', '17.67', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK1740', 'BANDO', 'CORREAS'),
(1009, 'PRODUCTO', 'MICRO V: 7PK1745', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1745 (17,45 Pulgadas)', 'MICRO V: 7PK1745 (17,45 Pulgadas)', '17.71', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK1745', 'BANDO', 'CORREAS'),
(1010, 'PRODUCTO', 'MICRO V: 7PK1750', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1750 (17,50 Pulgadas)', 'MICRO V: 7PK1750 (17,50 Pulgadas)', '17.76', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK1750', 'BANDO', 'CORREAS'),
(1011, 'PRODUCTO', 'MICRO V: 7PK1755', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1755 (17,55 Pulgadas)', 'MICRO V: 7PK1755 (17,55 Pulgadas)', '17.80', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK1755', 'BANDO', 'CORREAS'),
(1012, 'PRODUCTO', 'MICRO V: 7PK1760', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1760 (17,60 Pulgadas)', 'MICRO V: 7PK1760 (17,60 Pulgadas)', '17.84', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK1760', 'BANDO', 'CORREAS'),
(1013, 'PRODUCTO', 'MICRO V: 7PK1765', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1765 (17,65 Pulgadas)', 'MICRO V: 7PK1765 (17,65 Pulgadas)', '17.91', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK1765', 'BANDO', 'CORREAS'),
(1014, 'PRODUCTO', 'MICRO V: 7PK1770', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1770 (17,70 Pulgadas)', 'MICRO V: 7PK1770 (17,70 Pulgadas)', '17.98', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK1770', 'BANDO', 'CORREAS'),
(1015, 'PRODUCTO', 'MICRO V: 7PK1775', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1775 (17,75 Pulgadas)', 'MICRO V: 7PK1775 (17,75 Pulgadas)', '18.02', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK1775', 'BANDO', 'CORREAS'),
(1016, 'PRODUCTO', 'MICRO V: 7PK1780', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1780 (17,80 Pulgadas)', 'MICRO V: 7PK1780 (17,80 Pulgadas)', '18.06', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK1780', 'BANDO', 'CORREAS'),
(1017, 'PRODUCTO', 'MICRO V: 7PK1785', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1785 (17,85 Pulgadas)', 'MICRO V: 7PK1785 (17,85 Pulgadas)', '18.11', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK1785', 'BANDO', 'CORREAS'),
(1018, 'PRODUCTO', 'MICRO V: 7PK1790', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1790 (17,90 Pulgadas)', 'MICRO V: 7PK1790 (17,90 Pulgadas)', '18.15', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK1790', 'BANDO', 'CORREAS'),
(1019, 'PRODUCTO', 'MICRO V: 7PK1800', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1800 (18,00 Pulgadas)', 'MICRO V: 7PK1800 (18,00 Pulgadas)', '18.26', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK1800', 'BANDO', 'CORREAS'),
(1020, 'PRODUCTO', 'MICRO V: 7PK1835', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1835 (18,35 Pulgadas)', 'MICRO V: 7PK1835 (18,35 Pulgadas)', '23.71', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK1835', 'BANDO', 'CORREAS'),
(1021, 'PRODUCTO', 'MICRO V: 7PK1855', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1855 (18,55 Pulgadas)', 'MICRO V: 7PK1855 (18,55 Pulgadas)', '23.97', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK1855', 'BANDO', 'CORREAS'),
(1022, 'PRODUCTO', 'MICRO V: 7PK1865', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1865 (18,65 Pulgadas)', 'MICRO V: 7PK1865 (18,65 Pulgadas)', '18.92', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK1865', 'BANDO', 'CORREAS'),
(1023, 'PRODUCTO', 'MICRO V: 7PK1870', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1870 (18,70 Pulgadas)', 'MICRO V: 7PK1870 (18,70 Pulgadas)', '19.10', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK1870', 'BANDO', 'CORREAS'),
(1024, 'PRODUCTO', 'MICRO V: 7PK1890', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1890 (18,90 Pulgadas)', 'MICRO V: 7PK1890 (18,90 Pulgadas)', '19.17', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK1890', 'BANDO', 'CORREAS'),
(1025, 'PRODUCTO', 'MICRO V: 7PK1905', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1905 (19,05 Pulgadas)', 'MICRO V: 7PK1905 (19,05 Pulgadas)', '19.32', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK1905', 'BANDO', 'CORREAS'),
(1026, 'PRODUCTO', 'MICRO V: 7PK1920', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1920 (19,20 Pulgadas)', 'MICRO V: 7PK1920 (19,20 Pulgadas)', '19.48', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK1920', 'BANDO', 'CORREAS'),
(1027, 'PRODUCTO', 'MICRO V: 7PK1930', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1930 (19,30 Pulgadas)', 'MICRO V: 7PK1930 (19,30 Pulgadas)', '19.59', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK1930', 'BANDO', 'CORREAS'),
(1028, 'PRODUCTO', 'MICRO V: 7PK1935', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1935 (19,35 Pulgadas)', 'MICRO V: 7PK1935 (19,35 Pulgadas)', '19.63', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK1935', 'BANDO', 'CORREAS'),
(1029, 'PRODUCTO', 'MICRO V: 7PK1940', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1940 (19,40 Pulgadas)', 'MICRO V: 7PK1940 (19,40 Pulgadas)', '19.67', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK1940', 'BANDO', 'CORREAS'),
(1030, 'PRODUCTO', 'MICRO V: 7PK1950', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1950 (19,50 Pulgadas)', 'MICRO V: 7PK1950 (19,50 Pulgadas)', '19.83', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK1950', 'BANDO', 'CORREAS'),
(1031, 'PRODUCTO', 'MICRO V: 7PK1960', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1960 (19,60 Pulgadas)', 'MICRO V: 7PK1960 (19,60 Pulgadas)', '19.89', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK1960', 'BANDO', 'CORREAS'),
(1032, 'PRODUCTO', 'MICRO V: 7PK1970', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK1970 (19,70 Pulgadas)', 'MICRO V: 7PK1970 (19,70 Pulgadas)', '19.98', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK1970', 'BANDO', 'CORREAS'),
(1033, 'PRODUCTO', 'MICRO V: 7PK2020', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2020 (20,20 Pulgadas)', 'MICRO V: 7PK2020 (20,20 Pulgadas)', '20.49', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK2020', 'BANDO', 'CORREAS'),
(1034, 'PRODUCTO', 'MICRO V: 7PK2035', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2035 (20,35 Pulgadas)', 'MICRO V: 7PK2035 (20,35 Pulgadas)', '20.64', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK2035', 'BANDO', 'CORREAS'),
(1035, 'PRODUCTO', 'MICRO V: 7PK2040', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2040 (20,40 Pulgadas)', 'MICRO V: 7PK2040 (20,40 Pulgadas)', '20.69', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK2040', 'BANDO', 'CORREAS'),
(1036, 'PRODUCTO', 'MICRO V: 7PK2050', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2050 (20,50 Pulgadas)', 'MICRO V: 7PK2050 (20,50 Pulgadas)', '20.80', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK2050', 'BANDO', 'CORREAS'),
(1037, 'PRODUCTO', 'MICRO V: 7PK2060', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2060 (20,60 Pulgadas)', 'MICRO V: 7PK2060 (20,60 Pulgadas)', '20.91', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK2060', 'BANDO', 'CORREAS'),
(1038, 'PRODUCTO', 'MICRO V: 7PK2075', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2075 (20,75 Pulgadas)', 'MICRO V: 7PK2075 (20,75 Pulgadas)', '21.13', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK2075', 'BANDO', 'CORREAS'),
(1039, 'PRODUCTO', 'MICRO V: 7PK2090', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2090 (20,90 Pulgadas)', 'MICRO V: 7PK2090 (20,90 Pulgadas)', '21.20', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK2090', 'BANDO', 'CORREAS'),
(1040, 'PRODUCTO', 'MICRO V: 7PK2095', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2095 (20,95 Pulgadas)', 'MICRO V: 7PK2095 (20,95 Pulgadas)', '21.26', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK2095', 'BANDO', 'CORREAS'),
(1041, 'PRODUCTO', 'MICRO V: 7PK2120', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2120 (21,20 Pulgadas)', 'MICRO V: 7PK2120 (21,20 Pulgadas)', '21.50', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK2120', 'BANDO', 'CORREAS'),
(1042, 'PRODUCTO', 'MICRO V: 7PK2145', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2145 (21,45 Pulgadas)', 'MICRO V: 7PK2145 (21,45 Pulgadas)', '21.70', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK2145', 'BANDO', 'CORREAS'),
(1043, 'PRODUCTO', 'MICRO V: 7PK2160', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2160 (21,60 Pulgadas)', 'MICRO V: 7PK2160 (21,60 Pulgadas)', '21.90', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK2160', 'BANDO', 'CORREAS'),
(1044, 'PRODUCTO', 'MICRO V: 7PK2164', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2164 (21,64 Pulgadas)', 'MICRO V: 7PK2164 (21,64 Pulgadas)', '21.92', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK2164', 'BANDO', 'CORREAS'),
(1045, 'PRODUCTO', 'MICRO V: 7PK2165', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2165 (21,65 Pulgadas)', 'MICRO V: 7PK2165 (21,65 Pulgadas)', '21.97', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK2165', 'BANDO', 'CORREAS'),
(1046, 'PRODUCTO', 'MICRO V: 7PK2170', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2170 (21,70 Pulgadas)', 'MICRO V: 7PK2170 (21,70 Pulgadas)', '22.01', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK2170', 'BANDO', 'CORREAS'),
(1047, 'PRODUCTO', 'MICRO V: 7PK2190', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2190 (21,90 Pulgadas)', 'MICRO V: 7PK2190 (21,90 Pulgadas)', '22.21', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK2190', 'BANDO', 'CORREAS'),
(1048, 'PRODUCTO', 'MICRO V: 7PK2217', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2217 (22,17 Pulgadas)', 'MICRO V: 7PK2217 (22,17 Pulgadas)', '22.50', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK2217', 'BANDO', 'CORREAS'),
(1049, 'PRODUCTO', 'MICRO V: 7PK2225', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2225 (22,25 Pulgadas)', 'MICRO V: 7PK2225 (22,25 Pulgadas)', '23.14', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK2225', 'BANDO', 'CORREAS'),
(1050, 'PRODUCTO', 'MICRO V: 7PK2235', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2235 (22,35 Pulgadas)', 'MICRO V: 7PK2235 (22,35 Pulgadas)', '22.67', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK2235', 'BANDO', 'CORREAS'),
(1051, 'PRODUCTO', 'MICRO V: 7PK2245', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2245 (22,45 Pulgadas)', 'MICRO V: 7PK2245 (22,45 Pulgadas)', '22.78', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK2245', 'BANDO', 'CORREAS'),
(1052, 'PRODUCTO', 'MICRO V: 7PK2250', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2250 (22,50 Pulgadas)', 'MICRO V: 7PK2250 (22,50 Pulgadas)', '22.83', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK2250', 'BANDO', 'CORREAS'),
(1053, 'PRODUCTO', 'MICRO V: 7PK2260', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2260 (22,60 Pulgadas)', 'MICRO V: 7PK2260 (22,60 Pulgadas)', '22.94', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK2260', 'BANDO', 'CORREAS'),
(1054, 'PRODUCTO', 'MICRO V: 7PK2275', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2275 (22,75 Pulgadas)', 'MICRO V: 7PK2275 (22,75 Pulgadas)', '23.09', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK2275', 'BANDO', 'CORREAS'),
(1055, 'PRODUCTO', 'MICRO V: 7PK2285', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2285 (22,85 Pulgadas)', 'MICRO V: 7PK2285 (22,85 Pulgadas)', '23.18', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK2285', 'BANDO', 'CORREAS'),
(1056, 'PRODUCTO', 'MICRO V: 7PK2300', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2300 (23,00 Pulgadas)', 'MICRO V: 7PK2300 (23,00 Pulgadas)', '23.33', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK2300', 'BANDO', 'CORREAS'),
(1057, 'PRODUCTO', 'MICRO V: 7PK2325', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2325 (23,25 Pulgadas)', 'MICRO V: 7PK2325 (23,25 Pulgadas)', '23.58', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK2325', 'BANDO', 'CORREAS'),
(1058, 'PRODUCTO', 'MICRO V: 7PK2345', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2345 (23,45 Pulgadas)', 'MICRO V: 7PK2345 (23,45 Pulgadas)', '23.80', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK2345', 'BANDO', 'CORREAS'),
(1059, 'PRODUCTO', 'MICRO V: 7PK2415', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2415 (24,15 Pulgadas)', 'MICRO V: 7PK2415 (24,15 Pulgadas)', '24.50', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK2415', 'BANDO', 'CORREAS'),
(1060, 'PRODUCTO', 'MICRO V: 7PK2425', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2425 (24,25 Pulgadas)', 'MICRO V: 7PK2425 (24,25 Pulgadas)', '24.59', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK2425', 'BANDO', 'CORREAS'),
(1061, 'PRODUCTO', 'MICRO V: 7PK2470', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2470 (24,70 Pulgadas)', 'MICRO V: 7PK2470 (24,70 Pulgadas)', '25.05', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK2470', 'BANDO', 'CORREAS'),
(1062, 'PRODUCTO', 'MICRO V: 7PK2480', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2480 (24,80 Pulgadas)', 'MICRO V: 7PK2480 (24,80 Pulgadas)', '25.23', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK2480', 'BANDO', 'CORREAS'),
(1063, 'PRODUCTO', 'MICRO V: 7PK2555', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2555 (25,55 Pulgadas)', 'MICRO V: 7PK2555 (25,55 Pulgadas)', '25.91', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK2555', 'BANDO', 'CORREAS'),
(1064, 'PRODUCTO', 'MICRO V: 7PK2570', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2570 (25,70 Pulgadas)', 'MICRO V: 7PK2570 (25,70 Pulgadas)', '26.07', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK2570', 'BANDO', 'CORREAS'),
(1065, 'PRODUCTO', 'MICRO V: 7PK2640', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2640 (26,40 Pulgadas)', 'MICRO V: 7PK2640 (26,40 Pulgadas)', '26.77', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '7PK2640', 'BANDO', 'CORREAS'),
(1066, 'PRODUCTO', 'MICRO V: 7PK2870', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK2870 (28,70 Pulgadas)', 'MICRO V: 7PK2870 (28,70 Pulgadas)', '29.11', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '7PK2870', 'BANDO', 'CORREAS'),
(1067, 'PRODUCTO', 'MICRO V: 7PK990', 'CORREAS AUTOMOTRICES', 'MICRO V: 7PK990 (K9,90 Pulgadas)', 'MICRO V: 7PK990 (K9,90 Pulgadas)', '11.49', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '7PK990', 'BANDO', 'CORREAS'),
(1068, 'PRODUCTO', 'MICRO V: 8PK1055', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1055 (10,55 Pulgadas)', 'MICRO V: 8PK1055 (10,55 Pulgadas)', '15.57', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK1055', 'BANDO', 'CORREAS'),
(1069, 'PRODUCTO', 'MICRO V: 8PK1065', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1065 (10,65 Pulgadas)', 'MICRO V: 8PK1065 (10,65 Pulgadas)', '15.70', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK1065', 'BANDO', 'CORREAS'),
(1070, 'PRODUCTO', 'MICRO V: 8PK1105', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1105 (11,05 Pulgadas)', 'MICRO V: 8PK1105 (11,05 Pulgadas)', '16.30', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK1105', 'BANDO', 'CORREAS'),
(1071, 'PRODUCTO', 'MICRO V: 8PK1230', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1230 (12,30 Pulgadas)', 'MICRO V: 8PK1230 (12,30 Pulgadas)', '18.13', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK1230', 'BANDO', 'CORREAS'),
(1072, 'PRODUCTO', 'MICRO V: 8PK1255', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1255 (12,55 Pulgadas)', 'MICRO V: 8PK1255 (12,55 Pulgadas)', '18.50', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK1255', 'BANDO', 'CORREAS'),
(1073, 'PRODUCTO', 'MICRO V: 8PK1290', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1290 (12,90 Pulgadas)', 'MICRO V: 8PK1290 (12,90 Pulgadas)', '19.03', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK1290', 'BANDO', 'CORREAS'),
(1074, 'PRODUCTO', 'MICRO V: 8PK1350', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1350 (13,50 Pulgadas)', 'MICRO V: 8PK1350 (13,50 Pulgadas)', '19.94', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK1350', 'BANDO', 'CORREAS'),
(1075, 'PRODUCTO', 'MICRO V: 8PK1365', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1365 (13,65 Pulgadas)', 'MICRO V: 8PK1365 (13,65 Pulgadas)', '20.16', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK1365', 'BANDO', 'CORREAS'),
(1076, 'PRODUCTO', 'MICRO V: 8PK1370', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1370 (13,70 Pulgadas)', 'MICRO V: 8PK1370 (13,70 Pulgadas)', '20.22', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK1370', 'BANDO', 'CORREAS'),
(1077, 'PRODUCTO', 'MICRO V: 8PK1395', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1395 (13,95 Pulgadas)', 'MICRO V: 8PK1395 (13,95 Pulgadas)', '20.58', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK1395', 'BANDO', 'CORREAS'),
(1078, 'PRODUCTO', 'MICRO V: 8PK1400', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1400 (14,00 Pulgadas)', 'MICRO V: 8PK1400 (14,00 Pulgadas)', '20.64', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK1400', 'BANDO', 'CORREAS'),
(1079, 'PRODUCTO', 'MICRO V: 8PK1410', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1410 (14,10 Pulgadas)', 'MICRO V: 8PK1410 (14,10 Pulgadas)', '20.80', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK1410', 'BANDO', 'CORREAS'),
(1080, 'PRODUCTO', 'MICRO V: 8PK1420', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1420 (14,20 Pulgadas)', 'MICRO V: 8PK1420 (14,20 Pulgadas)', '20.95', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK1420', 'BANDO', 'CORREAS'),
(1081, 'PRODUCTO', 'MICRO V: 8PK1435', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1435 (14,35 Pulgadas)', 'MICRO V: 8PK1435 (14,35 Pulgadas)', '21.17', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK1435', 'BANDO', 'CORREAS'),
(1082, 'PRODUCTO', 'MICRO V: 8PK1450', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1450 (14,50 Pulgadas)', 'MICRO V: 8PK1450 (14,50 Pulgadas)', '21.42', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK1450', 'BANDO', 'CORREAS'),
(1083, 'PRODUCTO', 'MICRO V: 8PK1455', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1455 (14,55 Pulgadas)', 'MICRO V: 8PK1455 (14,55 Pulgadas)', '21.48', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK1455', 'BANDO', 'CORREAS'),
(1084, 'PRODUCTO', 'MICRO V: 8PK1460', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1460 (14,60 Pulgadas)', 'MICRO V: 8PK1460 (14,60 Pulgadas)', '21.55', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK1460', 'BANDO', 'CORREAS'),
(1085, 'PRODUCTO', 'MICRO V: 8PK1470', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1470 (14,70 Pulgadas)', 'MICRO V: 8PK1470 (14,70 Pulgadas)', '21.68', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK1470', 'BANDO', 'CORREAS'),
(1086, 'PRODUCTO', 'MICRO V: 8PK1485', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1485 (14,85 Pulgadas)', 'MICRO V: 8PK1485 (14,85 Pulgadas)', '21.92', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK1485', 'BANDO', 'CORREAS'),
(1087, 'PRODUCTO', 'MICRO V: 8PK1500', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1500 (15,00 Pulgadas)', 'MICRO V: 8PK1500 (15,00 Pulgadas)', '22.12', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK1500', 'BANDO', 'CORREAS'),
(1088, 'PRODUCTO', 'MICRO V: 8PK1510', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1510 (15,10 Pulgadas)', 'MICRO V: 8PK1510 (15,10 Pulgadas)', '22.28', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK1510', 'BANDO', 'CORREAS'),
(1089, 'PRODUCTO', 'MICRO V: 8PK1525', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1525 (15,25 Pulgadas)', 'MICRO V: 8PK1525 (15,25 Pulgadas)', '22.50', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK1525', 'BANDO', 'CORREAS'),
(1090, 'PRODUCTO', 'MICRO V: 8PK1535', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1535 (15,35 Pulgadas)', 'MICRO V: 8PK1535 (15,35 Pulgadas)', '22.65', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK1535', 'BANDO', 'CORREAS'),
(1091, 'PRODUCTO', 'MICRO V: 8PK1550', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1550 (15,50 Pulgadas)', 'MICRO V: 8PK1550 (15,50 Pulgadas)', '22.87', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK1550', 'BANDO', 'CORREAS'),
(1092, 'PRODUCTO', 'MICRO V: 8PK1560', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1560 (15,60 Pulgadas)', 'MICRO V: 8PK1560 (15,60 Pulgadas)', '18.09', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK1560', 'BANDO', 'CORREAS'),
(1093, 'PRODUCTO', 'MICRO V: 8PK1590', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1590 (15,90 Pulgadas)', 'MICRO V: 8PK1590 (15,90 Pulgadas)', '18.44', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK1590', 'BANDO', 'CORREAS'),
(1094, 'PRODUCTO', 'MICRO V: 8PK1600', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1600 (16,00 Pulgadas)', 'MICRO V: 8PK1600 (16,00 Pulgadas)', '18.55', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK1600', 'BANDO', 'CORREAS'),
(1095, 'PRODUCTO', 'MICRO V: 8PK1620', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1620 (16,20 Pulgadas)', 'MICRO V: 8PK1620 (16,20 Pulgadas)', '18.79', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK1620', 'BANDO', 'CORREAS'),
(1096, 'PRODUCTO', 'MICRO V: 8PK1630', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1630 (16,30 Pulgadas)', 'MICRO V: 8PK1630 (16,30 Pulgadas)', '18.90', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK1630', 'BANDO', 'CORREAS'),
(1097, 'PRODUCTO', 'MICRO V: 8PK1640', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1640 (16,40 Pulgadas)', 'MICRO V: 8PK1640 (16,40 Pulgadas)', '19.01', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK1640', 'BANDO', 'CORREAS'),
(1098, 'PRODUCTO', 'MICRO V: 8PK1650', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1650 (16,50 Pulgadas)', 'MICRO V: 8PK1650 (16,50 Pulgadas)', '19.12', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK1650', 'BANDO', 'CORREAS'),
(1099, 'PRODUCTO', 'MICRO V: 8PK1660', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1660 (16,60 Pulgadas)', 'MICRO V: 8PK1660 (16,60 Pulgadas)', '19.25', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK1660', 'BANDO', 'CORREAS'),
(1100, 'PRODUCTO', 'MICRO V: 8PK1680', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1680 (16,80 Pulgadas)', 'MICRO V: 8PK1680 (16,80 Pulgadas)', '19.45', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK1680', 'BANDO', 'CORREAS'),
(1101, 'PRODUCTO', 'MICRO V: 8PK1690', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1690 (16,90 Pulgadas)', 'MICRO V: 8PK1690 (16,90 Pulgadas)', '19.63', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK1690', 'BANDO', 'CORREAS'),
(1102, 'PRODUCTO', 'MICRO V: 8PK1715', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1715 (17,15 Pulgadas)', 'MICRO V: 8PK1715 (17,15 Pulgadas)', '19.89', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK1715', 'BANDO', 'CORREAS'),
(1103, 'PRODUCTO', 'MICRO V: 8PK1730', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1730 (17,30 Pulgadas)', 'MICRO V: 8PK1730 (17,30 Pulgadas)', '20.09', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK1730', 'BANDO', 'CORREAS'),
(1104, 'PRODUCTO', 'MICRO V: 8PK1740', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1740 (17,40 Pulgadas)', 'MICRO V: 8PK1740 (17,40 Pulgadas)', '20.16', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK1740', 'BANDO', 'CORREAS'),
(1105, 'PRODUCTO', 'MICRO V: 8PK1750', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1750 (17,50 Pulgadas)', 'MICRO V: 8PK1750 (17,50 Pulgadas)', '20.29', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK1750', 'BANDO', 'CORREAS'),
(1106, 'PRODUCTO', 'MICRO V: 8PK1755', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1755 (17,55 Pulgadas)', 'MICRO V: 8PK1755 (17,55 Pulgadas)', '20.36', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK1755', 'BANDO', 'CORREAS'),
(1107, 'PRODUCTO', 'MICRO V: 8PK1760', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1760 (17,60 Pulgadas)', 'MICRO V: 8PK1760 (17,60 Pulgadas)', '20.45', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK1760', 'BANDO', 'CORREAS'),
(1108, 'PRODUCTO', 'MICRO V: 8PK1780', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1780 (17,80 Pulgadas)', 'MICRO V: 8PK1780 (17,80 Pulgadas)', '20.58', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK1780', 'BANDO', 'CORREAS'),
(1109, 'PRODUCTO', 'MICRO V: 8PK1790', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1790 (17,90 Pulgadas)', 'MICRO V: 8PK1790 (17,90 Pulgadas)', '20.75', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK1790', 'BANDO', 'CORREAS'),
(1110, 'PRODUCTO', 'MICRO V: 8PK1800', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1800 (18,00 Pulgadas)', 'MICRO V: 8PK1800 (18,00 Pulgadas)', '20.91', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK1800', 'BANDO', 'CORREAS'),
(1111, 'PRODUCTO', 'MICRO V: 8PK1810', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1810 (18,10 Pulgadas)', 'MICRO V: 8PK1810 (18,10 Pulgadas)', '21.04', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK1810', 'BANDO', 'CORREAS'),
(1112, 'PRODUCTO', 'MICRO V: 8PK1820', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1820 (18,20 Pulgadas)', 'MICRO V: 8PK1820 (18,20 Pulgadas)', '21.13', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK1820', 'BANDO', 'CORREAS'),
(1113, 'PRODUCTO', 'MICRO V: 8PK1830', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1830 (18,30 Pulgadas)', 'MICRO V: 8PK1830 (18,30 Pulgadas)', '21.20', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK1830', 'BANDO', 'CORREAS'),
(1114, 'PRODUCTO', 'MICRO V: 8PK1840', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1840 (18,40 Pulgadas)', 'MICRO V: 8PK1840 (18,40 Pulgadas)', '21.33', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK1840', 'BANDO', 'CORREAS'),
(1115, 'PRODUCTO', 'MICRO V: 8PK1855', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1855 (18,55 Pulgadas)', 'MICRO V: 8PK1855 (18,55 Pulgadas)', '21.50', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK1855', 'BANDO', 'CORREAS'),
(1116, 'PRODUCTO', 'MICRO V: 8PK1870', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1870 (18,70 Pulgadas)', 'MICRO V: 8PK1870 (18,70 Pulgadas)', '21.68', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK1870', 'BANDO', 'CORREAS'),
(1117, 'PRODUCTO', 'MICRO V: 8PK1890', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1890 (18,90 Pulgadas)', 'MICRO V: 8PK1890 (18,90 Pulgadas)', '21.92', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK1890', 'BANDO', 'CORREAS'),
(1118, 'PRODUCTO', 'MICRO V: 8PK1935', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1935 (19,35 Pulgadas)', 'MICRO V: 8PK1935 (19,35 Pulgadas)', '22.61', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK1935', 'BANDO', 'CORREAS'),
(1119, 'PRODUCTO', 'MICRO V: 8PK1970', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK1970 (19,70 Pulgadas)', 'MICRO V: 8PK1970 (19,70 Pulgadas)', '22.85', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK1970', 'BANDO', 'CORREAS'),
(1120, 'PRODUCTO', 'MICRO V: 8PK2020', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK2020 (20,20 Pulgadas)', 'MICRO V: 8PK2020 (20,20 Pulgadas)', '23.42', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK2020', 'BANDO', 'CORREAS'),
(1121, 'PRODUCTO', 'MICRO V: 8PK2025', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK2025 (20,25 Pulgadas)', 'MICRO V: 8PK2025 (20,25 Pulgadas)', '23.49', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK2025', 'BANDO', 'CORREAS'),
(1122, 'PRODUCTO', 'MICRO V: 8PK2030', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK2030 (20,30 Pulgadas)', 'MICRO V: 8PK2030 (20,30 Pulgadas)', '23.55', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK2030', 'BANDO', 'CORREAS'),
(1123, 'PRODUCTO', 'MICRO V: 8PK2035', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK2035 (20,35 Pulgadas)', 'MICRO V: 8PK2035 (20,35 Pulgadas)', '23.64', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK2035', 'BANDO', 'CORREAS'),
(1124, 'PRODUCTO', 'MICRO V: 8PK2045', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK2045 (20,45 Pulgadas)', 'MICRO V: 8PK2045 (20,45 Pulgadas)', '23.71', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK2045', 'BANDO', 'CORREAS'),
(1125, 'PRODUCTO', 'MICRO V: 8PK2060', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK2060 (20,60 Pulgadas)', 'MICRO V: 8PK2060 (20,60 Pulgadas)', '23.89', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK2060', 'BANDO', 'CORREAS'),
(1126, 'PRODUCTO', 'MICRO V: 8PK2070', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK2070 (20,70 Pulgadas)', 'MICRO V: 8PK2070 (20,70 Pulgadas)', '24.06', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK2070', 'BANDO', 'CORREAS'),
(1127, 'PRODUCTO', 'MICRO V: 8PK2095', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK2095 (20,95 Pulgadas)', 'MICRO V: 8PK2095 (20,95 Pulgadas)', '24.28', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK2095', 'BANDO', 'CORREAS'),
(1128, 'PRODUCTO', 'MICRO V: 8PK2110', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK2110 (21,10 Pulgadas)', 'MICRO V: 8PK2110 (21,10 Pulgadas)', '24.48', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK2110', 'BANDO', 'CORREAS'),
(1129, 'PRODUCTO', 'MICRO V: 8PK2120', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK2120 (21,20 Pulgadas)', 'MICRO V: 8PK2120 (21,20 Pulgadas)', '24.57', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK2120', 'BANDO', 'CORREAS'),
(1130, 'PRODUCTO', 'MICRO V: 8PK2130', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK2130 (21,30 Pulgadas)', 'MICRO V: 8PK2130 (21,30 Pulgadas)', '24.68', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK2130', 'BANDO', 'CORREAS'),
(1131, 'PRODUCTO', 'MICRO V: 8PK2165', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK2165 (21,65 Pulgadas)', 'MICRO V: 8PK2165 (21,65 Pulgadas)', '25.10', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK2165', 'BANDO', 'CORREAS'),
(1132, 'PRODUCTO', 'MICRO V: 8PK2170', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK2170 (21,70 Pulgadas)', 'MICRO V: 8PK2170 (21,70 Pulgadas)', '25.16', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK2170', 'BANDO', 'CORREAS'),
(1133, 'PRODUCTO', 'MICRO V: 8PK2190', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK2190 (21,90 Pulgadas)', 'MICRO V: 8PK2190 (21,90 Pulgadas)', '25.38', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK2190', 'BANDO', 'CORREAS'),
(1134, 'PRODUCTO', 'MICRO V: 8PK2225', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK2225 (22,25 Pulgadas)', 'MICRO V: 8PK2225 (22,25 Pulgadas)', '23.25', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK2225', 'BANDO', 'CORREAS'),
(1135, 'PRODUCTO', 'MICRO V: 8PK2235', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK2235 (22,35 Pulgadas)', 'MICRO V: 8PK2235 (22,35 Pulgadas)', '25.91', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK2235', 'BANDO', 'CORREAS'),
(1136, 'PRODUCTO', 'MICRO V: 8PK2315', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK2315 (23,15 Pulgadas)', 'MICRO V: 8PK2315 (23,15 Pulgadas)', '26.95', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK2315', 'BANDO', 'CORREAS'),
(1137, 'PRODUCTO', 'MICRO V: 8PK2410', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK2410 (24,10 Pulgadas)', 'MICRO V: 8PK2410 (24,10 Pulgadas)', '26.27', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK2410', 'BANDO', 'CORREAS'),
(1138, 'PRODUCTO', 'MICRO V: 8PK2415', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK2415 (24,15 Pulgadas)', 'MICRO V: 8PK2415 (24,15 Pulgadas)', '28.01', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK2415', 'BANDO', 'CORREAS'),
(1139, 'PRODUCTO', 'MICRO V: 8PK2490', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK2490 (24,90 Pulgadas)', 'MICRO V: 8PK2490 (24,90 Pulgadas)', '28.87', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK2490', 'BANDO', 'CORREAS'),
(1140, 'PRODUCTO', 'MICRO V: 8PK2515', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK2515 (25,15 Pulgadas)', 'MICRO V: 8PK2515 (25,15 Pulgadas)', '29.16', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK2515', 'BANDO', 'CORREAS'),
(1141, 'PRODUCTO', 'MICRO V: 8PK2540', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK2540 (25,40 Pulgadas)', 'MICRO V: 8PK2540 (25,40 Pulgadas)', '29.44', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK2540', 'BANDO', 'CORREAS'),
(1142, 'PRODUCTO', 'MICRO V: 8PK2555', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK2555 (25,55 Pulgadas)', 'MICRO V: 8PK2555 (25,55 Pulgadas)', '29.95', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK2555', 'BANDO', 'CORREAS'),
(1143, 'PRODUCTO', 'MICRO V: 8PK3035', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK3035 (30,35 Pulgadas)', 'MICRO V: 8PK3035 (30,35 Pulgadas)', '35.17', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK3035', 'BANDO', 'CORREAS'),
(1144, 'PRODUCTO', 'MICRO V: 8PK830', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK830 (8,30 Pulgadas)', 'MICRO V: 8PK830 (8,30 Pulgadas)', '12.24', 'correas_3.png', '', '', 'Pieza', 100, 'NO', '8PK830', 'BANDO', 'CORREAS'),
(1145, 'PRODUCTO', 'MICRO V: 8PK950', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK950 (9,50 Pulgadas)', 'MICRO V: 8PK950 (9,50 Pulgadas)', '14.03', 'correas_1.png', '', '', 'Pieza', 100, 'NO', '8PK950', 'BANDO', 'CORREAS'),
(1146, 'PRODUCTO', 'MICRO V: 8PK955', 'CORREAS AUTOMOTRICES', 'MICRO V: 8PK955 (9,55 Pulgadas)', 'MICRO V: 8PK955 (9,55 Pulgadas)', '14.07', 'correas_2.png', '', '', 'Pieza', 100, 'NO', '8PK955', 'BANDO', 'CORREAS'),
(1147, 'PRODUCTO', 'EZVIZ-C3N', 'SISTEMAS DE SEGURIDAD', 'CAMARA BULLET EZVIZ WIFI 1080P OUTDOOR', 'CAMARA BULLET EZVIZ WIFI 1080P OUTDOOR', '106.61', 'ezviz.png', '', '', 'Pieza', 100, 'NO', 'EZVIZ-C3N', 'EZVIZ', 'SEGURIDAD'),
(1148, 'PRODUCTO', 'EZVIZ-TY2', 'SISTEMAS DE SEGURIDAD', 'CAMARA DOMO  IP EZVIZ 2MP INDOOR', 'CAMARA DOMO  IP EZVIZ 2MP INDOOR', '57.23', 'ezviz.png', '', '', 'Pieza', 100, 'NO', 'EZVIZ-TY2', 'EZVIZ', 'SEGURIDAD'),
(1149, 'PRODUCTO', 'EZVIZ-ClC', 'SISTEMAS DE SEGURIDAD', 'CAMARA EZVIZ WIFI 1080P  INDOOR', 'CAMARA EZVIZ WIFI 1080P  INDOOR', '62.77', 'ezviz.png', '', '', 'Pieza', 100, 'NO', 'EZVIZ-ClC', 'EZVIZ', 'SEGURIDAD'),
(1150, 'PRODUCTO', 'EZVIZ-C3WN', 'SISTEMAS DE SEGURIDAD', 'CAMARA EZVIZ WIFI 1080P  OUTDOOR 2.8MM', 'CAMARA EZVIZ WIFI 1080P  OUTDOOR 2.8MM', '100.16', 'ezviz.png', '', '', 'Pieza', 100, 'NO', 'EZVIZ-C3WN', 'EZVIZ', 'SEGURIDAD'),
(1151, 'PRODUCTO', 'EZVIZ-C3W', 'SISTEMAS DE SEGURIDAD', 'CAMARA EZVIZ WIFI 1080P  OUTDOOR ALARMA', 'CAMARA EZVIZ WIFI 1080P  OUTDOOR ALARMA', '175.75', 'ezviz.png', '', '', 'Pieza', 100, 'NO', 'EZVIZ-C3W', 'EZVIZ', 'SEGURIDAD'),
(1152, 'PRODUCTO', 'EZVIZ-C4W', 'SISTEMAS DE SEGURIDAD', 'CAMARA EZVIZ WIFI 1080P  OUTDOOR LUZ/SIRE', 'CAMARA EZVIZ WIFI 1080P  OUTDOOR LUZ/SIRE', '134.66', 'ezviz.png', '', '', 'Pieza', 100, 'NO', 'EZVIZ-C4W', 'EZVIZ', 'SEGURIDAD'),
(1153, 'PRODUCTO', 'EZVIZ-C6P', 'SISTEMAS DE SEGURIDAD', 'CAMARA EZVIZ WIFI DUAL BAND PANO 3MP', 'CAMARA EZVIZ WIFI DUAL BAND PANO 3MP', '280.03', 'ezviz.png', '', '', 'Pieza', 100, 'NO', 'EZVIZ-C6P', 'EZVIZ', 'SEGURIDAD'),
(1154, 'PRODUCTO', 'CER-BAT-12-71', 'BATERIAS', 'BATERIA INFINITY 12V 7 AMP', 'BATERIA INFINITY 12V 7 AMP', '19.78', 'cer-bat.png', '', '', 'Pieza', 100, 'NO', 'CER-BAT-12-71', 'INFINITY', 'SEGURIDAD'),
(1155, 'PRODUCTO', 'CER-BAT-12-7', 'BATERIAS', 'BATERIA PARA CERCO SPTLINE 12V 7 AMP', 'BATERIA PARA CERCO SPTLINE 12V 7 AMP', '20.43', 'cer-bat.png', '', '', 'Pieza', 100, 'NO', 'CER-BAT-12-7', 'SPTLINE', 'SEGURIDAD'),
(1156, 'PRODUCTO', 'CER-BAT-12-lOOI', 'BATERIAS', 'BATERIA INFINITY 12V 100 AMP', 'BATERIA INFINITY 12V 100 AMP', '303.68', 'cer-bat.png', '', '', 'Pieza', 100, 'NO', 'CER-BAT-12-lOOI', 'INFINITY', 'SEGURIDAD'),
(1157, 'PRODUCTO', 'CER-BAT-12-4.51', 'BATERIAS', 'BATERIA INFINITY 12V 4.5 AMP', 'BATERIA INFINITY 12V 4.5 AMP', '16.79', 'cer-bat.png', '', '', 'Pieza', 100, 'NO', 'CER-BAT-12-4.51', 'INFINITY', 'SEGURIDAD'),
(1158, 'PRODUCTO', 'CER-BATW-12V9A', 'BATERIAS', 'BATERIA WIREPLUS 12V 9 AMPERIOS', 'BATERIA WIREPLUS 12V 9 AMPERIOS', '26.13', 'cer-bat.png', '', '', 'Pieza', 100, 'NO', 'CER-BATW-12V9A', 'WIREPLUS', 'SEGURIDAD'),
(1159, 'PRODUCTO', 'CER-BAT-12-401', 'BATERIAS', 'BATERIA INFINITY 12V 40 AMP', 'BATERIA INFINITY 12V 40 AMP', '129.94', 'cer-bat.png', '', '', 'Pieza', 100, 'NO', 'CER-BAT-12-401', 'INFINITY', 'SEGURIDAD'),
(1160, 'PRODUCTO', 'CER-BAT-12V-65A', 'BATERIAS', 'BATERIA CICLO PROF. SPTLINE 12V 65 AMP', 'BATERIA CICLO PROF. SPTLINE 12V 65 AMP', '204.40', 'cer-bat.png', '', '', 'Pieza', 100, 'NO', 'CER-BAT-12V-65A', 'SPTLINE', 'SEGURIDAD'),
(1161, 'PRODUCTO', 'CER-BATW-12-18A', 'BATERIAS', 'BATERIA WIREPLUS 12V 18AH', 'BATERIA WIREPLUS 12V 18AH', '60.90', 'cer-bat.png', '', '', 'Pieza', 100, 'NO', 'CER-BATW-12-18A', 'WIREPLUS', 'SEGURIDAD'),
(1162, 'PRODUCTO', 'CER-BATW-12V4.5', 'BATERIAS', 'BATERIA WIREPLUS 12V 4.5 AMPERIOS', 'BATERIA WIREPLUS 12V 4.5 AMPERIOS', '17.51', 'cer-bat.png', '', '', 'Pieza', 100, 'NO', 'CER-BATW-12V4.5', 'WIREPLUS', 'SEGURIDAD'),
(1163, 'PRODUCTO', 'MVT·DY·lAMP', 'ACCESORIOS', 'FUENTE 12V 1 AMP MVTEAM', 'FUENTE 12V 1 AMP MVTEAM', '2.34', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'MVT·DY·lAMP', 'MVTEAM', 'SEGURIDAD'),
(1164, 'PRODUCTO', 'MVT·DYOl', 'ACCESORIOS', 'FUENTE 12V 2 AMP MVTEAM', 'FUENTE 12V 2 AMP MVTEAM', '4.16', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'MVT·DYOl', 'MVTEAM', 'SEGURIDAD'),
(1165, 'PRODUCTO', 'MVT-DY02', 'ACCESORIOS', 'FUENTE 12V SAMP MVTEAM CON SPUTIER', 'FUENTE 12V SAMP MVTEAM CON SPUTIER', '12.12', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'MVT-DY02', 'MVTEAM', 'SEGURIDAD'),
(1166, 'PRODUCTO', 'CON-PLUG-H', 'ACCESORIOS', 'CONECTOR  PLUG 12V HEMBRA', 'CONECTOR  PLUG 12V HEMBRA', '0.32', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'CON-PLUG-H', 'SEGURIDAD', 'SEGURIDAD'),
(1167, 'PRODUCTO', 'CON-BNC-RCA', 'ACCESORIOS', 'RCA MACHO  A BNC HEMBRA', 'RCA MACHO  A BNC HEMBRA', '0.15', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'CON-BNC-RCA', 'SEGURIDAD', 'SEGURIDAD'),
(1168, 'PRODUCTO', 'H100-E7', 'ACCESORIOS', 'CAMARA BOMBILLO MVTEAM WIFI l.3MP 3602', 'CAMARA BOMBILLO MVTEAM WIFI l.3MP 3602', '36.49', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'H100-E7', 'MVTEAM', 'SEGURIDAD'),
(1169, 'PRODUCTO', 'H100-B7', 'ACCESORIOS', 'CAMARA WIFI MVTEAM IP 2MP HD 3.6MM', 'CAMARA WIFI MVTEAM IP 2MP HD 3.6MM', '36.49', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'H100-B7', 'MVTEAM', 'SEGURIDAD');
INSERT INTO `sspi_productos` (`ID_PRODUCTO`, `TIPO_PRODUCTO_SERVICIO`, `NOMBRE_PRODUCTO`, `NOMBRE_CATEGORIA`, `DESCRIPCION_CORTA`, `DESCRIPCION_LARGA`, `PRECIO_UNITARIO_DOLARES`, `FOTO_1_CARRUSEL`, `FOTO_2_CORTA`, `FOTO_3_LARGA`, `UNIDAD_DE_VENTA`, `CANTIDAD_DISPONIBLE`, `DESTACADO`, `CODIGO`, `MARCA`, `RUBRO`) VALUES
(1170, 'PRODUCTO', 'CON-RJll-100', 'ACCESORIOS', 'CONECTOR RJll POR UNIDAD', 'CONECTOR RJll POR UNIDAD', '0.42', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'CON-RJll-100', 'SEGURIDAD', 'SEGURIDAD'),
(1171, 'PRODUCTO', 'CAB·RG6-NET', 'ACCESORIOS', 'BOBINA CABLE RG6 lOOM', 'BOBINA CABLE RG6 lOOM', '29.19', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'CAB·RG6-NET', 'SEGURIDAD', 'SEGURIDAD'),
(1172, 'PRODUCTO', 'CAB·ALARM·NET70', 'ACCESORIOS', 'BOBINA ALARMA lOOM NETVISION 70/30', 'BOBINA ALARMA lOOM NETVISION 70/30', '23.36', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'CAB·ALARM·NET70', 'NETVISION', 'SEGURIDAD'),
(1173, 'PRODUCTO', 'ACC-TUB20', 'ACCESORIOS', 'TUBO PVC CONDUIT 1/2 20MM 3MTS LESSO', 'TUBO PVC CONDUIT 1/2 20MM 3MTS LESSO', '2.39', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'ACC-TUB20', 'LESSO', 'SEGURIDAD'),
(1174, 'PRODUCTO', 'ACC-MJOllO', 'ACCESORIOS', 'TAPA PLASTICA DE CAJETIN 4X2', 'TAPA PLASTICA DE CAJETIN 4X2', '0.67', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'ACC-MJOllO', 'SEGURIDAD', 'SEGURIDAD'),
(1175, 'PRODUCTO', 'APC-PE63', 'ACCESORIOS', 'REGLETA APC 6 ENCHUFES', 'REGLETA APC 6 ENCHUFES', '15.51', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'APC-PE63', 'SEGURIDAD', 'SEGURIDAD'),
(1176, 'PRODUCTO', 'ACC-ENCH·HEMBRA', 'ACCESORIOS', 'ENCHUFE POLARIZADO uov HEMBRA', 'ENCHUFE POLARIZADO uov HEMBRA', '2.91', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'ACC-ENCH·HEMBRA', 'SEGURIDAD', 'SEGURIDAD'),
(1177, 'PRODUCTO', 'ACC-ENCH·MACHO', 'ACCESORIOS', 'ENCHUFE POLARIZADO llOV MACHO', 'ENCHUFE POLARIZADO llOV MACHO', '2.91', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'ACC-ENCH·MACHO', 'SEGURIDAD', 'SEGURIDAD'),
(1178, 'PRODUCTO', 'ADAP·EU·AMER', 'ACCESORIOS', 'ADAPTADOR ENCHUFE EUROPEO A AMERICANO', 'ADAPTADOR ENCHUFE EUROPEO A AMERICANO', '1.46', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'ADAP·EU·AMER', 'SEGURIDAD', 'SEGURIDAD'),
(1179, 'PRODUCTO', 'AUDI02', 'ACCESORIOS', 'MICROFONO  CCTV 100-6000HZ, 100M2, 6-14V', 'MICROFONO  CCTV 100-6000HZ, 100M2, 6-14V', '1.46', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'AUDI02', 'SEGURIDAD', 'SEGURIDAD'),
(1180, 'PRODUCTO', 'SPYAUDIO', 'ACCESORIOS', 'MICROFONO PARA SISTEMA CCTV', 'MICROFONO PARA SISTEMA CCTV', '1.46', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'SPYAUDIO', 'SEGURIDAD', 'SEGURIDAD'),
(1181, 'PRODUCTO', 'RB941·2ND-TC', 'ACCESORIOS', 'AP, BALANCEADOR, ROUTER, MIKROTIK 4PORT', 'AP, BALANCEADOR, ROUTER, MIKROTIK 4PORT', '1.46', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'RB941·2ND-TC', 'MIKROTIK', 'SEGURIDAD'),
(1182, 'PRODUCTO', 'B·ABT-60', 'ACCESORIOS', 'HAZ FOTOELECTRICO SPTLINE PHOTOBEAM', 'HAZ FOTOELECTRICO SPTLINE PHOTOBEAM', '56.94', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'B·ABT-60', 'SEGURIDAD', 'SEGURIDAD'),
(1183, 'PRODUCTO', 'B·LUZROJA', 'ACCESORIOS', 'LUZ ESTROBOSCOPICA ROJA SPTLINE', 'LUZ ESTROBOSCOPICA ROJA SPTLINE', '11.67', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'B·LUZROJA', 'SPTLINE', 'SEGURIDAD'),
(1184, 'PRODUCTO', 'BIO·B·PANIC', 'ACCESORIOS', 'BOTON DE PANICO BLANCO', 'BOTON DE PANICO BLANCO', '1.45', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'BIO·B·PANIC', 'SEGURIDAD', 'SEGURIDAD'),
(1185, 'PRODUCTO', 'ACC-TDY-SPUT', 'ACCESORIOS', 'CABLE TDY SPLIT 4 SALIDAS (PULPO)', 'CABLE TDY SPLIT 4 SALIDAS (PULPO)', '1.45', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'ACC-TDY-SPUT', 'SEGURIDAD', 'SEGURIDAD'),
(1186, 'PRODUCTO', 'ACC-OIS-500GBSP', 'DISCO DURO', 'DISCO DURO SEAGATE 500GB PULL', 'DISCO DURO SEAGATE 500GB PULL', '32.12', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'ACC-OIS-500GBSP', 'SEAGATE', 'SEGURIDAD'),
(1187, 'PRODUCTO', 'ACC-DIS-WDlEUPU', 'DISCO DURO', 'DISCO DURO lTB WESTER DIGITAL lOEURX PULL', 'DISCO DURO lTB WESTER DIGITAL lOEURX PULL', '65.70', 'vacio.png', '', '', 'Pieza', 90, 'NO', 'ACC-DIS-WDlEUPU', 'WESTER DIGITAL', 'SEGURIDAD'),
(1188, 'PRODUCTO', 'ACC-DIS-500GBPU', 'DISCO DURO', 'DISCO DURO PULL WESTERN DIGITAL 500GB', 'DISCO DURO PULL WESTERN DIGITAL 500GB', '32.12', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'ACC-DIS-500GBPU', 'WESTER DIGITAL', 'SEGURIDAD'),
(1189, 'PRODUCTO', 'ACC-DIS-4TBSG', 'DISCO DURO', 'DISCO DURO 4TB SEAGATE SKYHAWK', 'DISCO DURO 4TB SEAGATE SKYHAWK', '255.50', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'ACC-DIS-4TBSG', 'SEAGATE', 'SEGURIDAD'),
(1190, 'PRODUCTO', 'ACC-DIS-6TBSG', 'DISCO DURO', 'DISCO DURO 6TB SEAGATE SKYHAWK', 'DISCO DURO 6TB SEAGATE SKYHAWK', '357.70', 'vacio.png', '', '', 'Pieza', 80, 'NO', 'ACC-DIS-6TBSG', 'SEAGATE', 'SEGURIDAD'),
(1191, 'PRODUCTO', 'ACC-DIS-lTBSGSH', 'DISCO DURO', 'DISCO DURO lTB SEAGATE SKYHAWK', 'DISCO DURO lTB SEAGATE SKYHAWK', '109.50', 'vacio.png', '', '', 'Pieza', 98, 'NO', 'ACC-DIS-lTBSGSH', 'SEAGATE', 'SEGURIDAD'),
(1192, 'PRODUCTO', 'ST2000VM002', 'DISCO DURO', 'DISCO DURO SEAGATE PULL 2TB', 'DISCO DURO SEAGATE PULL 2TB', '94.90', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'ST2000VM002', 'SEAGATE', 'SEGURIDAD'),
(1193, 'PRODUCTO', 'DS-2CE16C0T-IRPF', 'SISTEMAS DE SEGURIDAD', 'CAM BALA HIKVISION 720P 2.8 IP66 P 4IN1', 'CAM BALA HIKVISION 720P 2.8 IP66 P 4IN1', '25.02', 'DS-2CE16C0T-IRPF.png', '', '', 'Pieza', 100, 'NO', 'DS-2CE16C0T-IRPF', 'HIKVISION', 'SEGURIDAD'),
(1194, 'PRODUCTO', 'DS-2CE56C0T-IRPF-2', 'SISTEMAS DE SEGURIDAD', 'CAM DOMO HIKVISION TURBO 2.8MM 720P', 'CAM DOMO HIKVISION TURBO 2.8MM 720P', '19.27', 'DS-2CE16C0T-IRPF-2.png', '', '', 'Pieza', 100, 'NO', 'DS-2CE56C0T-IRPF-2', 'HIKVISION', 'SEGURIDAD'),
(1195, 'PRODUCTO', 'DS-2CE56D0T-IRMF', 'SISTEMAS DE SEGURIDAD', 'CAMARA HIKVISION DOMO 1080P METALICA', 'CAMARA HIKVISION DOMO 1080P METALICA', '35.57', 'DS-2CE56D0T-IRMF.png', '', '', 'Pieza', 100, 'NO', 'DS-2CE56D0T-IRMF', 'HIKVISION', 'SEGURIDAD'),
(1196, 'PRODUCTO', 'DS-7216HGHI-K1', 'SISTEMAS DE SEGURIDAD', 'DVR HIKVISION 16 CANALES TURBO HD 1080P', 'DVR HIKVISION 16 CANALES TURBO HD 1080P', '131.98', 'DS-7216HGHI-K1.png', '', '', 'Pieza', 100, 'NO', 'DS-7216HGHI-K1', 'HIKVISION', 'SEGURIDAD'),
(1197, 'PRODUCTO', 'DS-7208HGHI-F1N', 'SISTEMAS DE SEGURIDAD', 'DVR HIKVISION 8 CANALES TURBO HD 1080P', 'DVR HIKVISION 8 CANALES TURBO HD 1080P', '84.68', 'DS-7208HGHI-F1N.png', '', '', 'Pieza', 100, 'NO', 'DS-7208HGHI-F1N', 'HIKVISION', 'SEGURIDAD'),
(1198, 'PRODUCTO', 'DS-19K00-Y', 'SISTEMAS DE SEGURIDAD', 'CONTROL REMOTO BIDIRECCIONAL HIKVISION', 'CONTROL REMOTO BIDIRECCIONAL HIKVISION', '584.00', 'DS-19K00-Y.png', '', '', 'Pieza', 100, 'NO', 'DS-19K00-Y', 'HIKVISION', 'SEGURIDAD'),
(1199, 'PRODUCTO', 'DS-KH6320-WTE2', 'SISTEMAS DE SEGURIDAD', 'INTERCOMUNICADOR HIKVISION', 'INTERCOMUNICADOR HIKVISION', '150.67', 'DS-KH6320-WTE2.png', '', '', 'Pieza', 100, 'NO', 'DS-KH6320-WTE2', 'HIKVISION', 'SEGURIDAD'),
(1200, 'PRODUCTO', 'DS-KIS202', 'SISTEMAS DE SEGURIDAD', 'KIT DE VIDEO PORTERO HIKVISION', 'KIT DE VIDEO PORTERO HIKVISION', '126.26', 'DS-KIS202.png', '', '', 'Pieza', 100, 'NO', 'DS-KIS202', 'HIKVISION', 'SEGURIDAD'),
(1201, 'PRODUCTO', 'DS-K1T331W', 'SISTEMAS DE SEGURIDAD', 'RECONOCIMIENTO FACIAL HIKVISION WIFI', 'RECONOCIMIENTO FACIAL HIKVISION WIFI', '226.59', 'DS-K1T331W.png', '', '', 'Pieza', 100, 'NO', 'DS-K1T331W', 'HIKVISION', 'SEGURIDAD'),
(1202, 'PRODUCTO', 'DS-KIS601', 'SISTEMAS DE SEGURIDAD', 'VIDEO PORTERO HIKVISION IP METALICO EXT', 'VIDEO PORTERO HIKVISION IP METALICO EXT', '327.04', 'DS-KIS601.png', '', '', 'Pieza', 100, 'NO', 'DS-KIS601', 'HIKVISION', 'SEGURIDAD'),
(1203, 'PRODUCTO', 'THC-B120-PC', 'SISTEMAS DE SEGURIDAD', 'CAM BALA HILOOK 2MP 1080P IP66 PLASTICA', 'CAM BALA HILOOK 2MP 1080P IP66 PLASTICA', '32.70', 'THC-B120-PC.png', '', '', 'Pieza', 100, 'NO', 'THC-B120-PC', 'HILOOK', 'SEGURIDAD'),
(1204, 'PRODUCTO', 'CAMEXT-THCB110P', 'SISTEMAS DE SEGURIDAD', 'CAM BALA HILOOK THC-B110P 2,8MM IP66 1MP', 'CAM BALA HILOOK THC-B110P 2,8MM IP66 1MP', '19.48', 'CAMEXT-THCB110P.png', '', '', 'Pieza', 100, 'NO', 'CAMEXT-THCB110P', 'HILOOK', 'SEGURIDAD'),
(1205, 'PRODUCTO', 'CAMEXT-B340-VF', 'SISTEMAS DE SEGURIDAD', 'CAM BALA HILOOK VARIFOCAL 4MP 4IN1 IP66', 'CAM BALA HILOOK VARIFOCAL 4MP 4IN1 IP66', '68.71', 'CAMEXT-B340-VF.png', '', '', 'Pieza', 100, 'NO', 'CAMEXT-B340-VF', 'HILOOK', 'SEGURIDAD'),
(1206, 'PRODUCTO', 'THC-T140-P', 'SISTEMAS DE SEGURIDAD', 'CAM DOMO HILOOK 4MP 2.8MM 4IN1', 'CAM DOMO HILOOK 4MP 2.8MM 4IN1', '35.77', 'THC-T140-P.png', '', '', 'Pieza', 100, 'NO', 'THC-T140-P', 'HILOOK', 'SEGURIDAD'),
(1207, 'PRODUCTO', 'PTZ-N42151-DE', 'SISTEMAS DE SEGURIDAD', 'CAM DOMO HILOOK 2MP-1080P 15X', 'CAM DOMO HILOOK 2MP-1080P 15X', '367.45', 'PTZ-N42151-DE.png', '', '', 'Pieza', 100, 'NO', 'PTZ-N42151-DE', 'HILOOK', 'SEGURIDAD'),
(1208, 'PRODUCTO', 'CAMDOM-THCT320V', 'SISTEMAS DE SEGURIDAD', 'CAM DOMO HILOOK VARIFOCAL 2.8-12MM 2 MP', 'CAM DOMO HILOOK VARIFOCAL 2.8-12MM 2 MP', '59.89', 'CAMDOM-THCT320V.png', '', '', 'Pieza', 100, 'NO', 'CAMDOM-THCT320V', 'HILOOK', 'SEGURIDAD'),
(1209, 'PRODUCTO', 'CAMDOM-T340-VF', 'SISTEMAS DE SEGURIDAD', 'CAM DOMO HILOOK VARIFOCAL 4MP 4IN1 IP66', 'CAM DOMO HILOOK VARIFOCAL 4MP 4IN1 IP66', '68.71', 'CAMDOM-T340-VF.png', '', '', 'Pieza', 100, 'NO', 'CAMDOM-T340-VF', 'HILOOK', 'SEGURIDAD'),
(1210, 'PRODUCTO', 'TK-4041B-PP', 'SISTEMAS DE SEGURIDAD', 'COMBO HILOOK 4 CAM THC-B110-P 3.6MM', 'COMBO HILOOK 4 CAM THC-B110-P 3.6MM', '341.76', 'TK-4041B-PP.png', '', '', 'Pieza', 100, 'NO', 'TK-4041B-PP', 'HILOOK', 'SEGURIDAD'),
(1211, 'PRODUCTO', 'DVR-216G-K1', 'SISTEMAS DE SEGURIDAD', 'DVR HILOOK 16CH 1080P', 'DVR HILOOK 16CH 1080P', '120.86', 'DVR-216G-K1.png', '', '', 'Pieza', 100, 'NO', 'DVR-216G-K1', 'HILOOK', 'SEGURIDAD'),
(1212, 'PRODUCTO', 'DVRHIL-216Q-K1', 'SISTEMAS DE SEGURIDAD', 'DVR HILOOK 16CH PENTAHIBRIDO', 'DVR HILOOK 16CH PENTAHIBRIDO', '221.63', 'DVRHIL-216Q-K1.png', '', '', 'Pieza', 100, 'NO', 'DVRHIL-216Q-K1', 'HILOOK', 'SEGURIDAD'),
(1213, 'PRODUCTO', 'DVRHIL-208Q-F1', 'SISTEMAS DE SEGURIDAD', 'DVR HILOOK 8 CANALES 1080P', 'DVR HILOOK 8 CANALES 1080P', '132.73', 'DVRHIL-208Q-F1.png', '', '', 'Pieza', 100, 'NO', 'DVRHIL-208Q-F1', 'HILOOK', 'SEGURIDAD'),
(1214, 'PRODUCTO', 'DVRHIL-116G-F1', 'SISTEMAS DE SEGURIDAD', 'DVR HILOOK H.264 PLUS 1080 LITE', 'DVR HILOOK H.264 PLUS 1080 LITE', '134.90', 'DVRHIL-116G-F1.png', '', '', 'Pieza', 100, 'NO', 'DVRHIL-116G-F1', 'HILOOK', 'SEGURIDAD'),
(1215, 'PRODUCTO', 'DVR-216U-K2', 'SISTEMAS DE SEGURIDAD', 'DVR HILOOK H.265 PRO+16CH FULL HD 4K', 'DVR HILOOK H.265 PRO+16CH FULL HD 4K', '490.27', 'DVR-216U-K2.png', '', '', 'Pieza', 100, 'NO', 'DVR-216U-K2', 'HILOOK', 'SEGURIDAD'),
(1216, 'PRODUCTO', 'DVR-216Q-F1', 'SISTEMAS DE SEGURIDAD', 'DVR HILOOK TURBO 3MP 16CHANNEL 1080P', 'DVR HILOOK TURBO 3MP 16CHANNEL 1080P', '120.86', 'DVR-216Q-F1.png', '', '', 'Pieza', 100, 'NO', 'DVR-216Q-F1', 'HILOOK', 'SEGURIDAD'),
(1217, 'PRODUCTO', 'DVR-204G-F1', 'SISTEMAS DE SEGURIDAD', 'DVR HILOOK TURBO 4CH 1080P', 'DVR HILOOK TURBO 4CH 1080P', '60.44', 'DVR-204G-F1.png', '', '', 'Pieza', 100, 'NO', 'DVR-204G-F1', 'HILOOK', 'SEGURIDAD'),
(1218, 'PRODUCTO', 'DVR-216Q-F2', 'SISTEMAS DE SEGURIDAD', 'DVR HILOOK TURBO HD 16 CHANNEL 1080P', 'DVR HILOOK TURBO HD 16 CHANNEL 1080P', '138.99', 'DVR-216Q-F2.png', '', '', 'Pieza', 100, 'NO', 'DVR-216Q-F2', 'HILOOK', 'SEGURIDAD'),
(1219, 'PRODUCTO', 'CAMEXT-IPC-B121', 'SISTEMAS DE SEGURIDAD', 'CAM BALA IP HILOOK 2MP 2.8mm METALPLASTI', 'CAM BALA IP HILOOK 2MP 2.8mm METALPLASTI', '87.70', 'CAMEXT-IPC-B121.png', '', '', 'Pieza', 100, 'NO', 'CAMEXT-IPC-B121', 'HILOOK', 'SEGURIDAD'),
(1220, 'PRODUCTO', 'IPC-T651H-Z', 'SISTEMAS DE SEGURIDAD', 'CAM DOMO IP HILOOK 5MP 2.8-12MM', 'CAM DOMO IP HILOOK 5MP 2.8-12MM', '168.19', 'IPC-T651H-Z.png', '', '', 'Pieza', 100, 'NO', 'IPC-T651H-Z', 'HILOOK', 'SEGURIDAD'),
(1221, 'PRODUCTO', 'IPC-B620H-V', 'SISTEMAS DE SEGURIDAD', 'CAMARA BALA IP HILOOK 2MP VARIFOCAL', 'CAMARA BALA IP HILOOK 2MP VARIFOCAL', '134.90', 'IPC-B620H-V.png', '', '', 'Pieza', 100, 'NO', 'IPC-B620H-V', 'HILOOK', 'SEGURIDAD'),
(1222, 'PRODUCTO', 'IPC-B620-Z', 'SISTEMAS DE SEGURIDAD', 'CAMARA BALA IP HILOOK POE VARIFOCAL IP67', 'CAMARA BALA IP HILOOK POE VARIFOCAL IP67', '160.48', 'IPC-B620-Z.png', '', '', 'Pieza', 100, 'NO', 'IPC-B620-Z', 'HILOOK', 'SEGURIDAD'),
(1223, 'PRODUCTO', 'IPC-D720H-Z', 'SISTEMAS DE SEGURIDAD', 'CAMARA DOMO IP HILOOK VARIFOCAL ZOOM MOT', 'CAMARA DOMO IP HILOOK VARIFOCAL ZOOM MOT', '153.02', 'IPC-D720H-Z.png', '', '', 'Pieza', 100, 'NO', 'IPC-D720H-Z', 'HILOOK', 'SEGURIDAD'),
(1224, 'PRODUCTO', 'PTZ-N4215-DE3', 'SISTEMAS DE SEGURIDAD', 'CAMARA IP DOMO HILOOK 2MP-1080P 15X POE', 'CAMARA IP DOMO HILOOK 2MP-1080P 15X POE', '367.45', 'PTZ-N4215-DE3.png', '', '', 'Pieza', 100, 'NO', 'PTZ-N4215-DE3', 'HILOOK', 'SEGURIDAD'),
(1225, 'PRODUCTO', 'ACC-CDP-UPR1008', 'SISTEMAS DE SEGURIDAD', 'UPS INTERACTIVO CDP 1000VA/500W', 'UPS INTERACTIVO CDP 1000VA/500W', '90.94', 'ACC-CDP-UPR1008.png', '', '', 'Pieza', 100, 'NO', 'ACC-CDP-UPR1008', 'CDP', 'SEGURIDAD'),
(1226, 'PRODUCTO', 'CDP-UPR508', 'SISTEMAS DE SEGURIDAD', 'UPS INTERACTIVO CDP 500VA/250W', 'UPS INTERACTIVO CDP 500VA/250W', '76.11', 'CDP-UPR508.png', '', '', 'Pieza', 100, 'NO', 'CDP-UPR508', 'CDP', 'SEGURIDAD'),
(1227, 'PRODUCTO', 'CDP-UPR758', 'SISTEMAS DE SEGURIDAD', 'UPS INTERACTIVO CDP 750VA/375W', 'UPS INTERACTIVO CDP 750VA/375W', '79.22', 'CDP-UPR758.png', '', '', 'Pieza', 100, 'NO', 'CDP-UPR758', 'CDP', 'SEGURIDAD'),
(1228, 'PRODUCTO', 'CDP-UPO11-2RT', 'SISTEMAS DE SEGURIDAD', 'UPS CDP 2000VA 1800 W 4 TOMA NEMA 5-15R', 'UPS CDP 2000VA 1800 W 4 TOMA NEMA 5-15R', '1217.44', 'CDP-UPO11-2RT.png', '', '', 'Pieza', 100, 'NO', 'CDP-UPO11-2RT', 'CDP', 'SEGURIDAD'),
(1229, 'PRODUCTO', 'ACC-CDP-RPP2R', 'SISTEMAS DE SEGURIDAD', 'PROTECTOR DE REFRIGERADOR CDP 1800W 15A', 'PROTECTOR DE REFRIGERADOR CDP 1800W 15A', '22.22', 'ACC-CDP-RPP2R.png', '', '', 'Pieza', 100, 'NO', 'ACC-CDP-RPP2R', 'CDP', 'SEGURIDAD'),
(1230, 'PRODUCTO', 'ACC-CDP-RPP2M', 'SISTEMAS DE SEGURIDAD', 'PROTECTOR ELECTRICO MICROONDAS CDP 1800W', 'PROTECTOR ELECTRICO MICROONDAS CDP 1800W', '22.22', 'ACC-CDP-RPP2M.png', '', '', 'Pieza', 100, 'NO', 'ACC-CDP-RPP2M', 'CDP', 'SEGURIDAD'),
(1231, 'PRODUCTO', 'CDP-XVERTER3048', 'SISTEMAS DE SEGURIDAD', 'INVERSOR CDP 3KVA 2400W  48VDC', 'INVERSOR CDP 3KVA 2400W  48VDC', '1091.07', 'CDP-XVERTER3048.png', '', '', 'Pieza', 100, 'NO', 'CDP-XVERTER3048', 'CDP', 'SEGURIDAD'),
(1232, 'PRODUCTO', 'CDP-SOLUPRS5048', 'SISTEMAS DE SEGURIDAD', 'INVERSOR HIBRIDO CDP 5KVA 48V PV100-144V', 'INVERSOR HIBRIDO CDP 5KVA 48V PV100-144V', '2806.41', 'CDP-SOLUPRS5048.png', '', '', 'Pieza', 100, 'NO', 'CDP-SOLUPRS5048', 'CDP', 'SEGURIDAD'),
(1233, 'PRODUCTO', 'CDP-RSS5', 'SISTEMAS DE SEGURIDAD', 'REGLETA CDP 5 TOMAS 1250W  10A', 'REGLETA CDP 5 TOMAS 1250W  10A', '12.60', 'CDP-RSS5.png', '', '', 'Pieza', 100, 'NO', 'CDP-RSS5', 'CDP', 'SEGURIDAD'),
(1234, 'PRODUCTO', 'DH-XVR5232AN-X', 'SISTEMAS DE SEGURIDAD', 'DVR DAHUA 32 CH 1080P PENTAHIBRIDO 6MP', 'DVR DAHUA 32 CH 1080P PENTAHIBRIDO 6MP', '571.01', 'DH-XVR5232AN-X.png', '', '', 'Pieza', 100, 'NO', 'DH-XVR5232AN-X', 'DAHUA', 'SEGURIDAD'),
(1235, 'PRODUCTO', 'DH-HAC-D1A21N-0280B', 'SISTEMAS DE SEGURIDAD', 'DOMO PLASTCIO 1080P 4 EN 1 LENTE 2.8MM / 2MP COOPER, PARA INTERIOR / VISION NOCTURNA 20MTS IR  / ANGULO DE VISION 103°.', 'DOMO PLASTCIO 1080P 4 EN 1 LENTE 2.8MM / 2MP COOPER, PARA INTERIOR / VISION NOCTURNA 20MTS IR  / ANGULO DE VISION 103°.', '31.73', 'DH-HAC-D1A21N-0280B.png', '', '', 'Pieza', 100, 'NO', 'DH-HAC-D1A21N-0280B', 'DAHUA', 'SEGURIDAD'),
(1236, 'PRODUCTO', 'DH-HAC-B2A21', 'SISTEMAS DE SEGURIDAD', 'CAMARA BALA DAHUA 2MP 2.8MM IP67 4IN1', 'CAMARA BALA DAHUA 2MP 2.8MM IP67 4IN1', '32.75', 'DH-HAC-B2A21.png', '', '', 'Pieza', 100, 'NO', 'DH-HAC-B2A21', 'DAHUA', 'SEGURIDAD'),
(1237, 'PRODUCTO', 'DH-HAC-B2A41', 'SISTEMAS DE SEGURIDAD', 'CAMARA BALA DAHUA 4M 2.8MM IP67 4IN1', 'CAMARA BALA DAHUA 4M 2.8MM IP67 4IN1', '44.03', 'DH-HAC-B2A41.png', '', '', 'Pieza', 100, 'NO', 'DH-HAC-B2A41', 'DAHUA', 'SEGURIDAD'),
(1238, 'PRODUCTO', 'DH-HDW1200TLN', 'SISTEMAS DE SEGURIDAD', 'CAMARA DOMO DAHUA 2MP 2.8MM IP67 4IN1', 'CAMARA DOMO DAHUA 2MP 2.8MM IP67 4IN1', '36.69', 'DH-HDW1200TLN.png', '', '', 'Pieza', 100, 'NO', 'DH-HDW1200TLN', 'DAHUA', 'SEGURIDAD'),
(1239, 'PRODUCTO', 'DH-HDW1209TLQ-2', 'SISTEMAS DE SEGURIDAD', 'CAMARA DOMO DAHUA 2MP 2.8MM IP67 4IN1', 'CAMARA DOMO DAHUA 2MP 2.8MM IP67 4IN1', '36.69', 'DH-HDW1209TLQ-2.png', '', '', 'Pieza', 100, 'NO', 'DH-HDW1209TLQ-2', 'DAHUA', 'SEGURIDAD'),
(1240, 'PRODUCTO', 'DH-HAC-T2A41', 'SISTEMAS DE SEGURIDAD', 'CAMARA DOMO DAHUA 4MP 2.8MM IP67 4IN1', 'CAMARA DOMO DAHUA 4MP 2.8MM IP67 4IN1', '46.57', 'DH-HAC-T2A41.png', '', '', 'Pieza', 100, 'NO', 'DH-HAC-T2A41', 'DAHUA', 'SEGURIDAD'),
(1241, 'PRODUCTO', 'HDBW1200RN-Z', 'SISTEMAS DE SEGURIDAD', 'CAMARA DOMO DAHUA METAL MOTORIZADA 2MP', 'CAMARA DOMO DAHUA METAL MOTORIZADA 2MP', '87.24', 'HDBW1200RN-Z.png', '', '', 'Pieza', 100, 'NO', 'HDBW1200RN-Z', 'DAHUA', 'SEGURIDAD'),
(1242, 'PRODUCTO', 'DH-HAC-B1A11N-0280B', 'SISTEMAS DE SEGURIDAD', 'BULLET PLASTICO 4 EN 1, 1MP 720P / LENTE 2.8MM IR 20M IP67', 'BULLET PLASTICO 4 EN 1, 1MP 720P / LENTE 2.8MM IR 20M IP67', '21.80', 'DH-HAC-B1A11N-0280B.png', '', '', 'Pieza', 100, 'NO', 'DH-HAC-B1A11N-0280B', 'DAHUA', 'SEGURIDAD'),
(1243, 'PRODUCTO', 'CAMDOM-T3A21N', 'SISTEMAS DE SEGURIDAD', 'CAM DOMO DAHUA VARIFOCAL 2MP 1080P', 'CAM DOMO DAHUA VARIFOCAL 2MP 1080P', '89.94', 'CAMDOM-T3A21N.png', '', '', 'Pieza', 100, 'NO', 'CAMDOM-T3A21N', 'DAHUA', 'SEGURIDAD'),
(1244, 'PRODUCTO', 'NVR1104-P', 'SISTEMAS DE SEGURIDAD', 'NVR DAHUA 4CH 1080P 1 SATA HDD UP TO 4TB', 'NVR DAHUA 4CH 1080P 1 SATA HDD UP TO 4TB', '62.63', 'NVR1104-P.png', '', '', 'Pieza', 100, 'NO', 'NVR1104-P', 'DAHUA', 'SEGURIDAD'),
(1245, 'PRODUCTO', 'DVRDAH-XVR1B16', 'SISTEMAS DE SEGURIDAD', 'DVR DAHUA LINEA COOPER 16 CANALES', 'DVR DAHUA LINEA COOPER 16 CANALES', '175.20', 'DVRDAH-XVR1B16.png', '', '', 'Pieza', 100, 'NO', 'DVRDAH-XVR1B16', 'DAHUA', 'SEGURIDAD'),
(1246, 'PRODUCTO', 'DHI-NVR4216-16P', 'SISTEMAS DE SEGURIDAD', 'NVR DAHUA 16CH POE 8MP H265 10TB', 'NVR DAHUA 16CH POE 8MP H265 10TB', '423.41', 'vacio.png', '', '', 'Pieza', 100, 'NO', 'DHI-NVR4216-16P', 'DAHUA', 'SEGURIDAD'),
(1247, 'PRODUCTO', 'DH-IPC-HFW1230S1N-0280B- S5', 'SISTEMAS DE SEGURIDAD', 'BULLET IP SEMIMETALICA 1/2,7" CMOS 2MP@30FPS LENTE 2.8MM FOV 115° DWDR IR 30M H.265+ POE IP67', 'BULLET IP SEMIMETALICA 1/2,7" CMOS 2MP@30FPS LENTE 2.8MM FOV 115° DWDR IR 30M H.265+ POE IP67', '83.03', 'DH-IPC-HFW1230S1N-0280B- S5.png', '', '', 'Pieza', 100, 'NO', 'DH-IPC-HFW1230S1N-0280B- S5', 'DAHUA', 'SEGURIDAD'),
(1248, 'PRODUCTO', 'CDP-R-UPR504', 'UPS', 'UPS CDP 500VA/250W 4 OUT', 'UPS CDP 500VA/250W 4 OUT', '74.46', 'CDP-R-UPR504.png', '', '', 'Pieza', 21, 'NO', 'CDP-R-UPR504', 'CDP', 'SEGURIDAD'),
(1249, 'PRODUCTO', 'ACC-UPS-800VA', 'UPS', 'UPS APC 800VA', 'UPS APC 800VA', '124.10', 'ACC-UPS-800VA.png', '', '', 'Pieza', 3, 'NO', 'ACC-UPS-800VA', 'CDP', 'SEGURIDAD'),
(1250, 'PRODUCTO', 'CDP-UPO11-2', 'UPS', 'UPS CDP 2000VA 1800W 4 TOMA NEMA 5-15R', 'UPS CDP 2000VA 1800W 4 TOMA NEMA 5-15R', '923.25', 'CDP-UPO11-2.png', '', '', 'Pieza', 1, 'NO', 'CDP-UPO11-2', 'CDP', 'SEGURIDAD'),
(1251, 'PRODUCTO', 'CDP-UPO22-6AX', 'UPS', 'UPS ONLINE DOBLE CONVERSION CDP 6KVA', 'UPS ONLINE DOBLE CONVERSION CDP 6KVA', '3838.16', 'CDP-UPO22-6AX.png', '', '', 'Pieza', 1, 'NO', 'CDP-UPO22-6AX', 'CDP', 'SEGURIDAD'),
(1252, 'PRODUCTO', 'HG-A1101', 'SISTEMAS DE SEGURIDAD', 'ADSL+2 MODEM', 'ADSL+2 MODEM', '28.54', 'HG-A1101.png', '', '', 'Pieza', 100, 'NO', 'HG-A1101', 'EXPLORE', 'SEGURIDAD'),
(1253, 'PRODUCTO', 'DECO E4 (2 PACK)', 'SISTEMAS DE SEGURIDAD', 'MESH WI-FI SYSTEM AC1200  DELETE DEAD SIGNAL AREAS, INTERNET FAST AND STABLE. COMPATIBLE WITH IFTTT AND WORKS WITH ALEXA  2 MESH MODULES', 'MESH WI-FI SYSTEM AC1200  DELETE DEAD SIGNAL AREAS, INTERNET FAST AND STABLE. COMPATIBLE WITH IFTTT AND WORKS WITH ALEXA  2 MESH MODULES', '131.05', 'DECO E4 (2 PACK).png', '', '', 'Pieza', 100, 'NO', 'DECO E4 (2 PACK)', 'TP-LINK', 'SEGURIDAD'),
(1254, 'PRODUCTO', 'UH400', 'SISTEMAS DE SEGURIDAD', '4 PUERTOS 3.0 HUB USB COMPACTO Y MODERNOS, NO REQUIERE DRIVER.', '4 PUERTOS 3.0 HUB USB COMPACTO Y MODERNOS, NO REQUIERE DRIVER.', '19.64', 'UH400.png', '', '', 'Pieza', 100, 'NO', 'UH400', 'TP-LINK', 'SEGURIDAD'),
(1255, 'PRODUCTO', 'TL-WN722N', 'SISTEMAS DE SEGURIDAD', 'ADAPTADOR USB 2,4GHZ ALTA GANANCIA. I ANTENA DESPRENDIBLE,', 'ADAPTADOR USB 2,4GHZ ALTA GANANCIA. I ANTENA DESPRENDIBLE,', '17.36', 'TL-WN722N.png', '', '', 'Pieza', 100, 'NO', 'TL-WN722N', 'TP-LINK', 'SEGURIDAD'),
(1256, 'PRODUCTO', 'LS1008', 'SISTEMAS DE SEGURIDAD', '8× 10/100Mbps Auto-Negotiation RJ45 port, supporting Auto- MDI/MDIX Green Ethernet technology saves power IEEE 802.3X flow control provides reliable data transfer', '8× 10/100Mbps Auto-Negotiation RJ45 port, supporting Auto- MDI/MDIX Green Ethernet technology saves power IEEE 802.3X flow control provides reliable data transfer', '16.70', 'LS1008.png', '', '', 'Pieza', 100, 'NO', 'LS1008', 'TP-LINK', 'SEGURIDAD'),
(1257, 'PRODUCTO', 'TL-SF1016D', 'SISTEMAS DE SEGURIDAD', 'SWITCH 16 PUERTOS RJ4510/100 MBP', 'SWITCH 16 PUERTOS RJ4510/100 MBP', '43.20', 'TL-SF1016D.png', '', '', 'Pieza', 100, 'NO', 'TL-SF1016D', 'TP-LINK', 'SEGURIDAD'),
(1258, 'PRODUCTO', 'LS105G', 'SISTEMAS DE SEGURIDAD', '10/100/1000 DESKTOP SWITCH 5 PORTS.', '10/100/1000 DESKTOP SWITCH 5 PORTS.', '30.48', 'LS105G.png', '', '', 'Pieza', 100, 'NO', 'LS105G', 'TP-LINK', 'SEGURIDAD'),
(1259, 'PRODUCTO', 'LS108G', 'SISTEMAS DE SEGURIDAD', '10/100/1000 DESKTOP SWITCH 8 PORTS.', '10/100/1000 DESKTOP SWITCH 8 PORTS.', '42.49', 'LS108G.png', '', '', 'Pieza', 100, 'NO', 'LS108G', 'TP-LINK', 'SEGURIDAD'),
(1260, 'PRODUCTO', 'TL-SF1005P', 'SISTEMAS DE SEGURIDAD', '802.3af 5 PORTS SWITCH- 4X POE PORTS - TOTAL POWER 56W - UP TO 250M', '802.3af 5 PORTS SWITCH- 4X POE PORTS - TOTAL POWER 56W - UP TO 250M', '66.75', 'TL-SF1005P.png', '', '', 'Pieza', 100, 'NO', 'TL-SF1005P', 'TP-LINK', 'SEGURIDAD'),
(1261, 'PRODUCTO', 'TL-SG108PE', 'SISTEMAS DE SEGURIDAD', '4X POE PORTS 802,3af PORTS, 56W TOTAL POWER. 10/100/100 8 PORTS SWITCH', '4X POE PORTS 802,3af PORTS, 56W TOTAL POWER. 10/100/100 8 PORTS SWITCH', '113.88', 'TL-SG108PE.png', '', '', 'Pieza', 100, 'NO', 'TL-SG108PE', 'TP-LINK', 'SEGURIDAD'),
(1262, 'PRODUCTO', 'TL-WR820N', 'SISTEMAS DE SEGURIDAD', 'ROUTER 2,4GHZ, 2 ANTENAS 5DBI, PUERTOS 10/100; hasta 300 MBPS, 2 PUERTOS LAN, 1 WAN', 'ROUTER 2,4GHZ, 2 ANTENAS 5DBI, PUERTOS 10/100; hasta 300 MBPS, 2 PUERTOS LAN, 1 WAN', '27.86', 'TL-WR820N.png', '', '', 'Pieza', 100, 'NO', 'TL-WR820N', 'TP-LINK', 'SEGURIDAD'),
(1263, 'PRODUCTO', 'TL-WR844N', 'SISTEMAS DE SEGURIDAD', 'High-Speed Wi-Fi - 300 Mbps. Boosted Coverage - Two omnidirectional antennas and 2×2 MIMO deliver strong Wi-Fi signal and reliable connections. Multi-Mode 4 in 1 - Supports Router, Access Point, Range Extender, and WISP modes to meet any network need.', 'High-Speed Wi-Fi - 300 Mbps. Boosted Coverage - Two omnidirectional antennas and 2×2 MIMO deliver strong Wi-Fi signal and reliable connections. Multi-Mode 4 in 1 - Supports Router, Access Point, Range Extender, and WISP modes to meet any network need.', '27.23', 'TL-WR844N.png', '', '', 'Pieza', 100, 'NO', 'TL-WR844N', 'TP-LINK', 'SEGURIDAD'),
(1264, 'PRODUCTO', 'TL-WR845N', 'SISTEMAS DE SEGURIDAD', 'ROUTER 2,4GHZ, 3 ANTENAS 5DBI, PUERTOS 10/100; hasta 300 MBPS, 4 PUERTOS LAN, 1 WAN', 'ROUTER 2,4GHZ, 3 ANTENAS 5DBI, PUERTOS 10/100; hasta 300 MBPS, 4 PUERTOS LAN, 1 WAN', '34.69', 'TL-WR845N.png', '', '', 'Pieza', 100, 'NO', 'TL-WR845N', 'TP-LINK', 'SEGURIDAD'),
(1265, 'PRODUCTO', 'TL-WR841HP', 'SISTEMAS DE SEGURIDAD', 'ROUTER 2,4GHZ, ALTO PODER, 2 ANTENAS DESPRENDIBLES, PUERTOS 10/100, ROUTER DE ALTA POTENCIA DE HASTA 300MBPS', 'ROUTER 2,4GHZ, ALTO PODER, 2 ANTENAS DESPRENDIBLES, PUERTOS 10/100, ROUTER DE ALTA POTENCIA DE HASTA 300MBPS', '73.79', 'TL-WR841HP.png', '', '', 'Pieza', 100, 'NO', 'TL-WR841HP', 'TP-LINK', 'SEGURIDAD'),
(1266, 'PRODUCTO', 'TL-WA855RE', 'SISTEMAS DE SEGURIDAD', 'REPETIDOR EXTENSOR DE SEÑAL Y MODO AP ACCESS POINT TIPO ENCHUFE 2,4GHZ, 300MBPS PLUG-WALL, 2 ANTENAS EXTERNAS,', 'REPETIDOR EXTENSOR DE SEÑAL Y MODO AP ACCESS POINT TIPO ENCHUFE 2,4GHZ, 300MBPS PLUG-WALL, 2 ANTENAS EXTERNAS,', '35.16', 'TL-WA855RE.png', '', '', 'Pieza', 100, 'NO', 'TL-WA855RE', 'TP-LINK', 'SEGURIDAD'),
(1267, 'PRODUCTO', 'TL-WPA4220 KIT', 'SISTEMAS DE SEGURIDAD', '600MBPS WIRED + 300MPBS WIRELESS POWERLINE KIT', '600MBPS WIRED + 300MPBS WIRELESS POWERLINE KIT', '98.83', 'TL-WPA4220 KIT.png', '', '', 'Pieza', 100, 'NO', 'TL-WPA4220 KIT', 'TP-LINK', 'SEGURIDAD'),
(1268, 'PRODUCTO', 'TL-WR941HP', 'SISTEMAS DE SEGURIDAD', 'ROUTER 2,4GHZ, ALTO PODER, 3 ANTENAS DESPRENDIBLES, PUERTOS 10/100, ROUTER DE ALTA POTENCIA DE HASTA 450MBPS', 'ROUTER 2,4GHZ, ALTO PODER, 3 ANTENAS DESPRENDIBLES, PUERTOS 10/100, ROUTER DE ALTA POTENCIA DE HASTA 450MBPS', '99.35', 'TL-WR941HP.png', '', '', 'Pieza', 100, 'NO', 'TL-WR941HP', 'TP-LINK', 'SEGURIDAD'),
(1269, 'PRODUCTO', 'TL-WA850RE', 'SISTEMAS DE SEGURIDAD', 'ACCESS  POINT / RANGE EXTENDER 2,4GHZ, 300MBPS PLUG- WALL, 2 ANTENAS INTERNAS,', 'ACCESS  POINT / RANGE EXTENDER 2,4GHZ, 300MBPS PLUG- WALL, 2 ANTENAS INTERNAS,', '30.88', 'TL-WA850RE.png', '', '', 'Pieza', 100, 'NO', 'TL-WA850RE', 'TP-LINK', 'SEGURIDAD'),
(1270, 'PRODUCTO', 'ARCHER  C54', 'SISTEMAS DE SEGURIDAD', 'AC1200 DUAL BAND 300MBPS 2,4GHZ + 867MBPS 5GHZ, MULTIMODO 3 EN 1. MU-MIMO X2 + BEAMFORMING', 'AC1200 DUAL BAND 300MBPS 2,4GHZ + 867MBPS 5GHZ, MULTIMODO 3 EN 1. MU-MIMO X2 + BEAMFORMING', '51.92', 'ARCHER  C54.png', '', '', 'Pieza', 100, 'NO', 'ARCHER  C54', 'TP-LINK', 'SEGURIDAD'),
(1271, 'PRODUCTO', 'AC1350 Archer C60', 'SISTEMAS DE SEGURIDAD', 'ROUTER DUAL BAND, CONEXIONES SIMULTÁNEAS DE 2.4GHZ A 450MBPS Y 5GHZ 867MBPS PARA 1.35GBPS DE ANCHO DE BANDA DISPONIBLE TOTAL, 5 ANTENAS ORGANIZADAS', 'ROUTER DUAL BAND, CONEXIONES SIMULTÁNEAS DE 2.4GHZ A 450MBPS Y 5GHZ 867MBPS PARA 1.35GBPS DE ANCHO DE BANDA DISPONIBLE TOTAL, 5 ANTENAS ORGANIZADAS', '70.28', 'AC1350 Archer C60.png', '', '', 'Pieza', 100, 'NO', 'AC1350 Archer C60', 'TP-LINK', 'SEGURIDAD'),
(1272, 'PRODUCTO', 'TL-RE220', 'SISTEMAS DE SEGURIDAD', 'REPETIDOR EXTENSOR DE SEÑAL Y MODO AP/ ACCESS POINT TIPO ENCHUFE, 2.4 GHz 300 MBPS Y 5 GHZ 433 MBPS, AC750 DUAL BAND. CONECTA HASTA 32 EQUIPOS. MAS ANCHO DE BANDA HASTA 150%', 'REPETIDOR EXTENSOR DE SEÑAL Y MODO AP/ ACCESS POINT TIPO ENCHUFE, 2.4 GHz 300 MBPS Y 5 GHZ 433 MBPS, AC750 DUAL BAND. CONECTA HASTA 32 EQUIPOS. MAS ANCHO DE BANDA HASTA 150%', '44.79', 'TL-RE220.png', '', '', 'Pieza', 100, 'NO', 'TL-RE220', 'TP-LINK', 'SEGURIDAD'),
(1273, 'PRODUCTO', 'TL-RE205', 'SISTEMAS DE SEGURIDAD', 'REPETIDOR EXTENSOR DE SEÑAL Y MODO AP/ ACCESS POINT TIPO ENCHUFE, 2.4 GHz 300 MBPS Y 5 GHZ 433 MBPS, AC750 DUAL BAND. CONECTA HASTA 32 EQUIPOS. MAS ANCHO DE BANDA HASTA 150%, ANTENAS EXTERNAS PARA MAYOR GANACIA', 'REPETIDOR EXTENSOR DE SEÑAL Y MODO AP/ ACCESS POINT TIPO ENCHUFE, 2.4 GHz 300 MBPS Y 5 GHZ 433 MBPS, AC750 DUAL BAND. CONECTA HASTA 32 EQUIPOS. MAS ANCHO DE BANDA HASTA 150%, ANTENAS EXTERNAS PARA MAYOR GANACIA', '50.27', 'TL-RE205.png', '', '', 'Pieza', 100, 'NO', 'TL-RE205', 'TP-LINK', 'SEGURIDAD'),
(1274, 'PRODUCTO', 'TD-W8961N', 'SISTEMAS DE SEGURIDAD', 'MODEM ADSL+2 / ROUTER 2,4GHZ 300MBPS 2 ANTENAS FIJAS.', 'MODEM ADSL+2 / ROUTER 2,4GHZ 300MBPS 2 ANTENAS FIJAS.', '47.45', 'TD-W8961N.png', '', '', 'Pieza', 100, 'NO', 'TD-W8961N', 'TP-LINK', 'SEGURIDAD'),
(1275, 'PRODUCTO', 'AC1200 Archer C50', 'SISTEMAS DE SEGURIDAD', 'ROUTER DUAL BAND, CONEXIONES SIMULTÁNEAS DE 2.4GHZ A 300MBPS Y 5GHZ 867MBPS PARA 1.2GBPS DE ANCHO DE BANDA DISPONIBLE TOTAL, 4 ANTENAS', 'ROUTER DUAL BAND, CONEXIONES SIMULTÁNEAS DE 2.4GHZ A 300MBPS Y 5GHZ 867MBPS PARA 1.2GBPS DE ANCHO DE BANDA DISPONIBLE TOTAL, 4 ANTENAS', '49.64', 'AC1200 Archer C50.png', '', '', 'Pieza', 99, 'NO', 'AC1200 Archer C50', 'TP-LINK', 'SEGURIDAD'),
(1276, 'PRODUCTO', 'DECO S4 (3- PACK)', 'SISTEMAS DE SEGURIDAD', 'MESH WI-FI SYSTEM AC1200  DELETE DEAD SIGNAL AREAS, INTERNET FAST AND STABLE. COMPATIBLE WITH IFTTT AND WORKS WITH ALEXA  2 MESH MODULES', 'MESH WI-FI SYSTEM AC1200  DELETE DEAD SIGNAL AREAS, INTERNET FAST AND STABLE. COMPATIBLE WITH IFTTT AND WORKS WITH ALEXA  2 MESH MODULES', '268.25', 'DECO S4 (3- PACK).png', '', '', 'Pieza', 100, 'NO', 'DECO S4 (3- PACK)', 'TP-LINK', 'SEGURIDAD'),
(1277, 'PRODUCTO', 'TPL-ARCHERC20', 'SISTEMAS DE SEGURIDAD', 'Router Inalámbrico Banda Dual AC750', 'Router Inalámbrico Banda Dual AC750', '45.67', 'TPL-ARCHERC20.png', '', '', 'Pieza', 100, 'NO', 'TPL-ARCHERC20', 'TP-LINK', 'SEGURIDAD'),
(1278, 'PRODUCTO', 'TL-WR841N', 'SISTEMAS DE SEGURIDAD', 'Router inalámbrico N a 300Mbps', 'Router inalámbrico N a 300Mbps', '34.68', 'TL-WR841N.png', '', '', 'Pieza', 100, 'NO', 'TL-WR841N', 'TP-LINK', 'SEGURIDAD'),
(1279, 'PRODUCTO', 'TL-WR940N', 'SISTEMAS DE SEGURIDAD', 'ROUTER 2,4GHZ, 3 ANTENAS FIJAS, PUERTOS 10/100; hasta 450 Mbps', 'ROUTER 2,4GHZ, 3 ANTENAS FIJAS, PUERTOS 10/100; hasta 450 Mbps', '40.44', 'TL-WR940N.png', '', '', 'Pieza', 100, 'NO', 'TL-WR940N', 'TP-LINK', 'SEGURIDAD'),
(1280, 'PRODUCTO', 'DECO M5 (2-PACK)', 'SISTEMAS DE SEGURIDAD', 'TP-LINK DECO M5 (2-PACK) AC1300 WHOLE HOME', 'TP-LINK DECO M5 (2-PACK) AC1300 WHOLE HOME', '208.78', 'DECO M5 (2-PACK).png', '', '', 'Pieza', 100, 'NO', 'DECO M5 (2-PACK)', 'TP-LINK', 'SEGURIDAD'),
(1281, 'PRODUCTO', 'DECO M5 (3-PACK)', 'SISTEMAS DE SEGURIDAD', 'TP-LINK DECO M5 (3-PACK) AC1300 WHOLE HOME', 'TP-LINK DECO M5 (3-PACK) AC1300 WHOLE HOME', '271.47', 'DECO M5 (3-PACK).png', '', '', 'Pieza', 100, 'NO', 'DECO M5 (3-PACK)', 'TP-LINK', 'SEGURIDAD'),
(1282, 'PRODUCTO', 'DECO X20 (2-PACK)', 'SISTEMAS DE SEGURIDAD', 'TP-LINK DECO X20 (2-PACK) AX1800 WHOLE HOME', 'TP-LINK DECO X20 (2-PACK) AX1800 WHOLE HOME', '294.42', 'DECO X20 (2-PACK).png', '', '', 'Pieza', 100, 'NO', 'DECO X20 (2-PACK)', 'TP-LINK', 'SEGURIDAD'),
(1283, 'PRODUCTO', 'TL-WN725N', 'SISTEMAS DE SEGURIDAD', 'TARJETA DE RED USB TL-WN725N MICRO', 'TARJETA DE RED USB TL-WN725N MICRO', '11.04', 'TL-WN725N.png', '', '', 'Pieza', 100, 'NO', 'TL-WN725N', 'TP-LINK', 'SEGURIDAD'),
(1284, 'PRODUCTO', 'T3U-PLUS', 'SISTEMAS DE SEGURIDAD', 'ADAP USB ARCHER T3U PLUS AC1300 HIGH GAIN', 'ADAP USB ARCHER T3U PLUS AC1300 HIGH GAIN', '33.38', 'T3U-PLUS.png', '', '', 'Pieza', 100, 'NO', 'T3U-PLUS', 'TP-LINK', 'SEGURIDAD'),
(1285, 'PRODUCTO', 'LS1005', 'SISTEMAS DE SEGURIDAD', 'SWITCH LS1005 5 PTOS 10/100M DESK', 'SWITCH LS1005 5 PTOS 10/100M DESK', '13.13', 'LS1005.png', '', '', 'Pieza', 100, 'NO', 'LS1005', 'TP-LINK', 'SEGURIDAD'),
(1286, 'PRODUCTO', 'RE300', 'SISTEMAS DE SEGURIDAD', 'TP-LINK RANGE EXTENDER RE300 AC1200', 'TP-LINK RANGE EXTENDER RE300 AC1200', '58.08', 'RE300.png', '', '', 'Pieza', 100, 'NO', 'RE300', 'TP-LINK', 'SEGURIDAD'),
(1287, 'PRODUCTO', 'CPE220', 'SISTEMAS DE SEGURIDAD', 'PHAROS TP-LINK CPE220 300MBPS 2.4GHZ', 'PHAROS TP-LINK CPE220 300MBPS 2.4GHZ', '72.39', 'CPE220.png', '', '', 'Pieza', 100, 'NO', 'CPE220', 'TP-LINK', 'SEGURIDAD'),
(1288, 'PRODUCTO', 'TL-MR100', 'SISTEMAS DE SEGURIDAD', 'ROUTER TL-MR100 4G LTE 300MBPS', 'ROUTER TL-MR100 4G LTE 300MBPS', '130.07', 'TL-MR100.png', '', '', 'Pieza', 100, 'NO', 'TL-MR100', 'TP-LINK', 'SEGURIDAD'),
(1289, 'PRODUCTO', 'ARCHER  A7', 'SISTEMAS DE SEGURIDAD', 'ROUTER ARCHER A7 AC1750 GIGABIT', 'ROUTER ARCHER A7 AC1750 GIGABIT', '128.55', 'ARCHER  A7.png', '', '', 'Pieza', 100, 'NO', 'ARCHER  A7', 'TP-LINK', 'SEGURIDAD'),
(1290, 'PRODUCTO', 'DECO E4 (3-PACK)', 'SISTEMAS DE SEGURIDAD', 'TP-LINK DECO E4 (3-PACK) AC1200 WHOLE HOME', 'TP-LINK DECO E4 (3-PACK) AC1200 WHOLE HOME', '189.95', 'DECO E4 (3-PACK).png', '', '', 'Pieza', 100, 'NO', 'DECO E4 (3-PACK)', 'TP-LINK', 'SEGURIDAD'),
(1291, 'PRODUCTO', 'ARCHER VR300', 'SISTEMAS DE SEGURIDAD', 'MODEM ROUTER ARCHER VR300 AC1200 VDSL/ADSL', 'MODEM ROUTER ARCHER VR300 AC1200 VDSL/ADSL', '105.12', 'ARCHER VR300.png', '', '', 'Pieza', 100, 'NO', 'ARCHER VR300', 'TP-LINK', 'SEGURIDAD'),
(1292, 'PRODUCTO', 'DECO M4 (2-PACK)', 'SISTEMAS DE SEGURIDAD', 'TP-LINK DECO M4 (2-PACK) AC1200 WHOLE HOME', 'TP-LINK DECO M4 (2-PACK) AC1200 WHOLE HOME', '186.63', 'DECO M4 (2-PACK).png', '', '', 'Pieza', 100, 'NO', 'DECO M4 (2-PACK)', 'TP-LINK', 'SEGURIDAD'),
(1293, 'PRODUCTO', 'CAMARA C100', 'SISTEMAS DE SEGURIDAD', 'CAMARA SEG WI-FI TAPO C100 HD 1080', 'CAMARA SEG WI-FI TAPO C100 HD 1080', '52.60', 'CAMARA C100.png', '', '', 'Pieza', 100, 'NO', 'CAMARA C100', 'TP-LINK', 'SEGURIDAD'),
(1294, 'PRODUCTO', 'WHOLE HOME WI-FI HALO S3 (2 PACK)', 'SISTEMAS DE SEGURIDAD', 'One Unified Network – With advanced Mesh Technology, Halo units work together to form one unified whole-home network with one Wi-Fi name and one password. Seamless Roaming – Automatically switch between Halos as you move around your home, always getting the best signal to enjoy the fastest connections for all your devices. Ultra-High Performance Wi-Fi – Blanket up to 2,200 square feet (200 m²) with high-speed Wi-Fi, ideal for 3–5 bedroom houses. Connects over 60 devices – Enjoy lag-free connection and non- stop entertainment on all your devices, at the same time.', 'One Unified Network – With advanced Mesh Technology, Halo units work together to form one unified whole-home network with one Wi-Fi name and one password. Seamless Roaming – Automatically switch between Halos as you move around your home, always getting the best signal to enjoy the fastest connections for all your devices. Ultra-High Performance Wi-Fi – Blanket up to 2,200 square feet (200 m²) with high-speed Wi-Fi, ideal for 3–5 bedroom houses. Connects over 60 devices – Enjoy lag-free connection and non- stop entertainment on all your devices, at the same time.', '55.68', 'WHOLE HOME WI-FI HALO S3 (2 PACK).png', '', '', 'Pieza', 100, 'NO', 'WHOLE HOME WI-FI HALO S3 (2 PACK)', 'MERCUSYS', 'SEGURIDAD'),
(1295, 'PRODUCTO', 'WIRELESS ROUTER MW301R', 'SISTEMAS DE SEGURIDAD', 'IDEAL BASIC WORK 300MBPS ROUTER, 2* 5DBI ANTENNAS, 2* LAN 10/100', 'IDEAL BASIC WORK 300MBPS ROUTER, 2* 5DBI ANTENNAS, 2* LAN 10/100', '22.05', 'WIRELESS ROUTER MW301R.png', '', '', 'Pieza', 100, 'NO', 'WIRELESS ROUTER MW301R', 'MERCUSYS', 'SEGURIDAD'),
(1296, 'PRODUCTO', 'WIRELESS ROUTER MW305R', 'SISTEMAS DE SEGURIDAD', 'IDEAL BASIC WORK 300MBPS ROUTER, 2* 5DBI ANTENNAS, 2* LAN 10/100', 'IDEAL BASIC WORK 300MBPS ROUTER, 2* 5DBI ANTENNAS, 2* LAN 10/100', '23.94', 'WIRELESS ROUTER MW305R.png', '', '', 'Pieza', 100, 'NO', 'WIRELESS ROUTER MW305R', 'MERCUSYS', 'SEGURIDAD'),
(1297, 'PRODUCTO', 'WIRELESS ROUTER MW325R', 'SISTEMAS DE SEGURIDAD', '300MBPS WIRELESS HIGH SPEED, 4* 5DBI ANTENNAS UP TO 500M2, 3* LAN 10/100', '300MBPS WIRELESS HIGH SPEED, 4* 5DBI ANTENNAS UP TO 500M2, 3* LAN 10/100', '28.98', 'WIRELESS ROUTER MW325R.png', '', '', 'Pieza', 100, 'NO', 'WIRELESS ROUTER MW325R', 'MERCUSYS', 'SEGURIDAD'),
(1298, 'PRODUCTO', 'WIRELESS ROUTER MR50G', 'SISTEMAS DE SEGURIDAD', 'DUAL BAND WIRELESS ROUTER 802,11ac UP TO 1900MBPS 6* 5DBI ANTENNAS, 2* GIGABIT 10/100/1000 LAN PORTS, 1* GIGABIT 10/100/1000 WAN PORT. 2.4GHZ / 5GHZ.', 'DUAL BAND WIRELESS ROUTER 802,11ac UP TO 1900MBPS 6* 5DBI ANTENNAS, 2* GIGABIT 10/100/1000 LAN PORTS, 1* GIGABIT 10/100/1000 WAN PORT. 2.4GHZ / 5GHZ.', '64.25', 'WIRELESS ROUTER MR50G.png', '', '', 'Pieza', 100, 'NO', 'WIRELESS ROUTER MR50G', 'MERCUSYS', 'SEGURIDAD'),
(1299, 'PRODUCTO', 'USB ADAPTER MW300UM', 'SISTEMAS DE SEGURIDAD', 'FAST 300MBPS USB ADAPTER, 2* INTERNAL ANTENNAS', 'FAST 300MBPS USB ADAPTER, 2* INTERNAL ANTENNAS', '13.13', 'USB ADAPTER MW300UM.png', '', '', 'Pieza', 100, 'NO', 'USB ADAPTER MW300UM', 'MERCUSYS', 'SEGURIDAD'),
(1300, 'PRODUCTO', 'WHOLE HOME WI-FI HALO S12 (3 PACK)', 'SISTEMAS DE SEGURIDAD', 'S12 units work together to form a single unified whole-home network with one Wi-Fi name and password. Seamless Roaming – Automatically switch between Halos as you move around your home, always getting the best signal to enjoy the fastest connections for all your devices. Whole-Home Coverage – Blanket up to 3,500 ft² (320 m²) with high-speed Wi-Fi, eliminating Wi-Fi dead zones at your home. Hi-Speed Wi-Fi – Halo S12 provides fast and stable connections with speeds of up to 1,167 Mbps and works with major internet service providers (ISP) and modems.', 'S12 units work together to form a single unified whole-home network with one Wi-Fi name and password. Seamless Roaming – Automatically switch between Halos as you move around your home, always getting the best signal to enjoy the fastest connections for all your devices. Whole-Home Coverage – Blanket up to 3,500 ft² (320 m²) with high-speed Wi-Fi, eliminating Wi-Fi dead zones at your home. Hi-Speed Wi-Fi – Halo S12 provides fast and stable connections with speeds of up to 1,167 Mbps and works with major internet service providers (ISP) and modems.', '145.20', 'WHOLE HOME WI-FI HALO S12 (3 PACK).png', '', '', 'Pieza', 100, 'NO', 'WHOLE HOME WI-FI HALO S12 (3 PACK)', 'MERCUSYS', 'SEGURIDAD'),
(1301, 'PRODUCTO', 'USB ADAPTER MU6H', 'SISTEMAS DE SEGURIDAD', 'AC 650 HIGH GAIN DUAL BAND USB ADAPTER 256-QAM support increases the 2.4 GHz data rate from 150 Mbps to 200 Mbps. Enjoy speeds of up to200 Mbps on the 2.4 GHz band and 433 Mbps on the 5 GHz band, to take full advantage of your AC Wi-Fi.', 'AC 650 HIGH GAIN DUAL BAND USB ADAPTER 256-QAM support increases the 2.4 GHz data rate from 150 Mbps to 200 Mbps. Enjoy speeds of up to200 Mbps on the 2.4 GHz band and 433 Mbps on the 5 GHz band, to take full advantage of your AC Wi-Fi.', '21.84', 'USB ADAPTER MU6H.png', '', '', 'Pieza', 100, 'NO', 'USB ADAPTER MU6H', 'MERCUSYS', 'SEGURIDAD'),
(1302, 'PRODUCTO', 'WHOLE HOME WI-FI HALO S3 (3 PACK)', 'SISTEMAS DE SEGURIDAD', 'One Unified Network – With advanced Mesh Technology, Halo units work together to form one unified whole-home network with one Wi-Fi name and one password. Seamless Roaming – Automatically switch between Halos as you move around your home, always getting the best signal to enjoy the fastest connections for all your devices. Ultra-High Performance Wi-Fi – Blanket up to 3,000 square feet (280 m²) with high-speed Wi-Fi, ideal for 3–5 bedroom houses. Connects over 60 devices – Enjoy lag-free connection and non- stop entertainment on all your devices, at the same time.', 'One Unified Network – With advanced Mesh Technology, Halo units work together to form one unified whole-home network with one Wi-Fi name and one password. Seamless Roaming – Automatically switch between Halos as you move around your home, always getting the best signal to enjoy the fastest connections for all your devices. Ultra-High Performance Wi-Fi – Blanket up to 3,000 square feet (280 m²) with high-speed Wi-Fi, ideal for 3–5 bedroom houses. Connects over 60 devices – Enjoy lag-free connection and non- stop entertainment on all your devices, at the same time.', '76.26', 'WHOLE HOME WI-FI HALO S3 (3 PACK).png', '', '', 'Pieza', 100, 'NO', 'WHOLE HOME WI-FI HALO S3 (3 PACK)', 'MERCUSYS', 'SEGURIDAD'),
(1303, 'PRODUCTO', 'WHOLE HOME WI-FI HALO S12 (2 PACK)', 'SISTEMAS DE SEGURIDAD', 'One Unified Network – With advanced Mesh Technology, Halo S12 units work together to form a single unified whole-home network with one Wi-Fi name and password. Seamless Roaming – Automatically switch between Halos as you move around your home, always getting the best signal to enjoy the fastest connections for all your devices. Whole-Home Coverage – Blanket up to 2,800 ft² (260 m²) with high-speed Wi-Fi, eliminating Wi-Fi dead zones at your home. Hi-Speed Wi-Fi – Halo S12 provides fast and stable connections with speeds of up to 1,167 Mbps and works with major internet service providers (ISP) and modems.', 'One Unified Network – With advanced Mesh Technology, Halo S12 units work together to form a single unified whole-home network with one Wi-Fi name and password. Seamless Roaming – Automatically switch between Halos as you move around your home, always getting the best signal to enjoy the fastest connections for all your devices. Whole-Home Coverage – Blanket up to 2,800 ft² (260 m²) with high-speed Wi-Fi, eliminating Wi-Fi dead zones at your home. Hi-Speed Wi-Fi – Halo S12 provides fast and stable connections with speeds of up to 1,167 Mbps and works with major internet service providers (ISP) and modems.', '99.83', 'WHOLE HOME WI-FI HALO S12 (2 PACK).png', '', '', 'Pieza', 100, 'NO', 'WHOLE HOME WI-FI HALO S12 (2 PACK)', 'MERCUSYS', 'SEGURIDAD'),
(1304, 'PRODUCTO', 'WIRELESS ROUTER AC10', 'SISTEMAS DE SEGURIDAD', 'DUAL BAND WIRELESS ROUTER 802,11ac UP TO 1200MBPS 4* 5DBI ANTENNAS, 2* FAST 10/100 LAN PORTS, 1* FAST 10/100 WAN PORT. 2.4GHZ / 5GHZ.', 'DUAL BAND WIRELESS ROUTER 802,11ac UP TO 1200MBPS 4* 5DBI ANTENNAS, 2* FAST 10/100 LAN PORTS, 1* FAST 10/100 WAN PORT. 2.4GHZ / 5GHZ.', '34.95', 'WIRELESS ROUTER AC10.png', '', '', 'Pieza', 100, 'NO', 'WIRELESS ROUTER AC10', 'MERCUSYS', 'SEGURIDAD'),
(1305, 'PRODUCTO', 'WIRELESS RANGE EXTENDER MW300RE', 'SISTEMAS DE SEGURIDAD', '300MBPS WI-FI RANGE EXTENDER WHOLE-HOME WI-FI COVERAGE. WI-FI DEAD ZONES ELIMINATION. MIMO TECHNOLOGY', '300MBPS WI-FI RANGE EXTENDER WHOLE-HOME WI-FI COVERAGE. WI-FI DEAD ZONES ELIMINATION. MIMO TECHNOLOGY', '25.42', 'WIRELESS RANGE EXTENDER MW300RE.png', '', '', 'Pieza', 100, 'NO', 'WIRELESS RANGE EXTENDER MW300RE', 'MERCUSYS', 'SEGURIDAD'),
(1306, 'PRODUCTO', 'WIRELESS ROUTER MW330HP', 'SISTEMAS DE SEGURIDAD', '300MBPS WIRELESS HIGH POWER, 4* 5DBI ANTENNAS UP TO 500M2, 3* LAN 10/100', '300MBPS WIRELESS HIGH POWER, 4* 5DBI ANTENNAS UP TO 500M2, 3* LAN 10/100', '34.89', 'WIRELESS ROUTER MW330HP.png', '', '', 'Pieza', 100, 'NO', 'WIRELESS ROUTER MW330HP', 'MERCUSYS', 'SEGURIDAD'),
(1307, 'PRODUCTO', 'WIRELESS ROUTER MW302R', 'SISTEMAS DE SEGURIDAD', 'MW302R ROUTER INAL. N 300MBPS MULTI-MODE 2ANT', 'MW302R ROUTER INAL. N 300MBPS MULTI-MODE 2ANT', '22.35', 'WIRELESS ROUTER MW302R.png', '', '', 'Pieza', 100, 'NO', 'WIRELESS ROUTER MW302R', 'MERCUSYS', 'SEGURIDAD'),
(1308, 'PRODUCTO', 'WIRELESS ROUTER AC12', 'SISTEMAS DE SEGURIDAD', 'AC12 ROUTER INAL. DUALBAND AC1200 4ANT', 'AC12 ROUTER INAL. DUALBAND AC1200 4ANT', '48.73', 'WIRELESS ROUTER AC12.png', '', '', 'Pieza', 100, 'NO', 'WIRELESS ROUTER AC12', 'MERCUSYS', 'SEGURIDAD'),
(1309, 'PRODUCTO', 'BANDEJA NEGRA DE METALNET 19X12', 'SISTEMAS DE SEGURIDAD', 'BANDEJA NEGRA DE METALNET - 19X12 - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'BANDEJA NEGRA DE METALNET - 19X12 - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '17.67', 'BANDEJA NEGRA DE METALNET 19X12.png', '', '', 'Pieza', 100, 'NO', 'BANDEJA NEGRA DE METALNET 19X12', 'METALNET ', 'SEGURIDAD'),
(1310, 'PRODUCTO', 'BANDEJA TRAMMA DE METALNET', 'SISTEMAS DE SEGURIDAD', 'BANDEJA TRAMMA DE METALNET - 19X12 - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'BANDEJA TRAMMA DE METALNET - 19X12 - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '21.21', 'BANDEJA TRAMMA DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'BANDEJA TRAMMA DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1311, 'PRODUCTO', 'BANDEJA TECLADO Y MOUSE DE METALNET', 'SISTEMAS DE SEGURIDAD', 'BANDEJA TECLADO Y MOUSE DE METALNET - 19X12 - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'BANDEJA TECLADO Y MOUSE DE METALNET - 19X12 - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '24.88', 'BANDEJA TECLADO Y MOUSE DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'BANDEJA TECLADO Y MOUSE DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1312, 'PRODUCTO', 'BANDEJA NEGRA DE METALNET 19X25', 'SISTEMAS DE SEGURIDAD', 'BANDEJA NEGRA DE METALNET - 19X25 - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'BANDEJA NEGRA DE METALNET - 19X25 - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '38.87', 'BANDEJA NEGRA DE METALNET 19X25.png', '', '', 'Pieza', 100, 'NO', 'BANDEJA NEGRA DE METALNET 19X25', 'METALNET ', 'SEGURIDAD'),
(1313, 'PRODUCTO', 'BANDEJA DOBLE NEGRA DE METALNET', 'SISTEMAS DE SEGURIDAD', 'BANDEJA DOBLE NEGRA DE METALNET - 19X25 - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'BANDEJA DOBLE NEGRA DE METALNET - 19X25 - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '41.96', 'BANDEJA DOBLE NEGRA DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'BANDEJA DOBLE NEGRA DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1314, 'PRODUCTO', 'RACK ABIERTO DE PARED 2U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'RACK ABIERTO DE PARED 2U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'RACK ABIERTO DE PARED 2U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '16.79', 'RACK ABIERTO DE PARED 2U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'RACK ABIERTO DE PARED 2U DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1315, 'PRODUCTO', 'RACK ABIERTO DE PARED 4U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'RACK ABIERTO DE PARED 4U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'RACK ABIERTO DE PARED 4U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '22.75', 'RACK ABIERTO DE PARED 4U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'RACK ABIERTO DE PARED 4U DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1316, 'PRODUCTO', 'RACK ABIERTO DE PARED 6U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'RACK ABIERTO DE PARED 6U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'RACK ABIERTO DE PARED 6U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '29.80', 'RACK ABIERTO DE PARED 6U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'RACK ABIERTO DE PARED 6U DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1317, 'PRODUCTO', 'RACK ABIERTO DE PARED 9U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'RACK ABIERTO DE PARED 9U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'RACK ABIERTO DE PARED 9U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '38.88', 'RACK ABIERTO DE PARED 9U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'RACK ABIERTO DE PARED 9U DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1318, 'PRODUCTO', 'RACK ABIERTO DE PARED 12U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'RACK ABIERTO DE PARED 12U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'RACK ABIERTO DE PARED 12U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '52.97', 'RACK ABIERTO DE PARED 12U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'RACK ABIERTO DE PARED 12U DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1319, 'PRODUCTO', 'RACK CERRADO DE 4U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'RACK CERRADO DE 4U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'RACK CERRADO DE 4U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '120.89', 'RACK CERRADO DE 4U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'RACK CERRADO DE 4U DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1320, 'PRODUCTO', 'RACK CERRADO DE 6U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'RACK CERRADO DE 6U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'RACK CERRADO DE 6U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '157.99', 'RACK CERRADO DE 6U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'RACK CERRADO DE 6U DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1321, 'PRODUCTO', 'RACK CERRADO DE 6U TRAMMA DE METALNET', 'SISTEMAS DE SEGURIDAD', 'RACK CERRADO DE 6U TRAMMA DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'RACK CERRADO DE 6U TRAMMA DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '189.58', 'RACK CERRADO DE 6U TRAMMA DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'RACK CERRADO DE 6U TRAMMA DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1322, 'PRODUCTO', 'RACK CERRADO DE 9U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'RACK CERRADO DE 9U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'RACK CERRADO DE 9U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '224.91', 'RACK CERRADO DE 9U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'RACK CERRADO DE 9U DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1323, 'PRODUCTO', 'RACK CERRADO DE 9U TRAMMA DE METALNET', 'SISTEMAS DE SEGURIDAD', 'RACK CERRADO DE 9U TRAMMA DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'RACK CERRADO DE 9U TRAMMA DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '269.87', 'RACK CERRADO DE 9U TRAMMA DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'RACK CERRADO DE 9U TRAMMA DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1324, 'PRODUCTO', 'RACK CERRADO DE 12U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'RACK CERRADO DE 12U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'RACK CERRADO DE 12U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '327.41', 'RACK CERRADO DE 12U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'RACK CERRADO DE 12U DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1325, 'PRODUCTO', 'RACK CERRADO DE 18U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'RACK CERRADO DE 18U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'RACK CERRADO DE 18U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '401.21', 'RACK CERRADO DE 18U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'RACK CERRADO DE 18U DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1326, 'PRODUCTO', 'RACK CERRADO DE 22U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'RACK CERRADO DE 22U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'RACK CERRADO DE 22U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '578.16', 'RACK CERRADO DE 22U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'RACK CERRADO DE 22U DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1327, 'PRODUCTO', 'RACK CERRADO DE 42U DE METALNET - 205CMX80CMX60CM', 'SISTEMAS DE SEGURIDAD', 'RACK CERRADO DE 42U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO - JUEGO DE RUEDAS                                                              - 205CMX80CMX60CM', 'RACK CERRADO DE 42U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO - JUEGO DE RUEDAS                                                              - 205CMX80CMX60CM', '1149.75', 'RACK CERRADO DE 42U DE METALNET - 205CMX80CMX60CM.png', '', '', 'Pieza', 100, 'NO', 'RACK CERRADO DE 42U DE METALNET - 205CMX80CMX60CM', 'METALNET ', 'SEGURIDAD');
INSERT INTO `sspi_productos` (`ID_PRODUCTO`, `TIPO_PRODUCTO_SERVICIO`, `NOMBRE_PRODUCTO`, `NOMBRE_CATEGORIA`, `DESCRIPCION_CORTA`, `DESCRIPCION_LARGA`, `PRECIO_UNITARIO_DOLARES`, `FOTO_1_CARRUSEL`, `FOTO_2_CORTA`, `FOTO_3_LARGA`, `UNIDAD_DE_VENTA`, `CANTIDAD_DISPONIBLE`, `DESTACADO`, `CODIGO`, `MARCA`, `RUBRO`) VALUES
(1328, 'PRODUCTO', 'RACK CERRADO DE 42U TRAMMA DE METALNET', 'SISTEMAS DE SEGURIDAD', 'RACK CERRADO DE 42U TRAMMA DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO - JUEGO DE RUEDAS                                                                - 205CMX80CMX60CM', 'RACK CERRADO DE 42U TRAMMA DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO - JUEGO DE RUEDAS                                                                - 205CMX80CMX60CM', '1682.65', 'RACK CERRADO DE 42U TRAMMA DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'RACK CERRADO DE 42U TRAMMA DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1329, 'PRODUCTO', 'RACK CERRADO DE 42U DE METALNET - 205CMX1MTSX60CM', 'SISTEMAS DE SEGURIDAD', 'RACK CERRADO DE 42U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO - JUEGO DE RUEDAS                                                              - 205CMX1MTSX60CM', 'RACK CERRADO DE 42U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO - JUEGO DE RUEDAS                                                              - 205CMX1MTSX60CM', '1297.58', 'RACK CERRADO DE 42U DE METALNET - 205CMX1MTSX60CM.png', '', '', 'Pieza', 100, 'NO', 'RACK CERRADO DE 42U DE METALNET - 205CMX1MTSX60CM', 'METALNET ', 'SEGURIDAD'),
(1330, 'PRODUCTO', 'TAPA CIEGA 1U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'TAPA CIEGA 1U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'TAPA CIEGA 1U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '3.05', 'TAPA CIEGA 1U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'TAPA CIEGA 1U DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1331, 'PRODUCTO', 'TAPA CIEGA 2U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'TAPA CIEGA 2U DE METANET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'TAPA CIEGA 2U DE METANET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '5.42', 'TAPA CIEGA 2U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'TAPA CIEGA 2U DE METANET ', 'METALNET ', 'SEGURIDAD'),
(1332, 'PRODUCTO', 'TAPA CIEGA 3U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'TAPA CIEGA 3U DE METANET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'TAPA CIEGA 3U DE METANET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '7.43', 'TAPA CIEGA 3U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'TAPA CIEGA 3U DE METANET ', 'METALNET ', 'SEGURIDAD'),
(1333, 'PRODUCTO', 'TAPA CIEGA 4U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'TAPA CIEGA 4U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'TAPA CIEGA 4U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '9.18', 'TAPA CIEGA 4U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'TAPA CIEGA 4U DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1334, 'PRODUCTO', 'TAPA CIEGA 5U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'TAPA CIEGA 5U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'TAPA CIEGA 5U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '11.27', 'TAPA CIEGA 5U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'TAPA CIEGA 5U DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1335, 'PRODUCTO', 'TAPA CIEGA 6U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'TAPA CIEGA 6U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'TAPA CIEGA 6U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '14.50', 'TAPA CIEGA 6U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'TAPA CIEGA 6U DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1336, 'PRODUCTO', 'TAPA CIEGA 9U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'TAPA CIEGA 9U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'TAPA CIEGA 9U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '24.56', 'TAPA CIEGA 9U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'TAPA CIEGA 9U DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1337, 'PRODUCTO', 'RACK ABIERTO DE PISO 18U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'RACK ABIERTO DE PISO 18U DE METALNET - PINTURA ELECTROESTÁTICA - 2 POST VERTICALES - 2 PATAS DE SOPORTE - MATERIAL DE HIERRO', 'RACK ABIERTO DE PISO 18U DE METALNET - PINTURA ELECTROESTÁTICA - 2 POST VERTICALES - 2 PATAS DE SOPORTE - MATERIAL DE HIERRO', '67.86', 'RACK ABIERTO DE PISO 18U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'RACK ABIERTO DE PISO 18U DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1338, 'PRODUCTO', 'RACK ABIERTO DE PISO 24U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'RACK ABIERTO DE PISO 24U DE METALNET -PINTURA ELECTROESTÁTICA - 2 POST VERTICALES - 2 PATAS DE SOPORTE - MATERIAL DE HIERRO', 'RACK ABIERTO DE PISO 24U DE METALNET -PINTURA ELECTROESTÁTICA - 2 POST VERTICALES - 2 PATAS DE SOPORTE - MATERIAL DE HIERRO', '95.27', 'RACK ABIERTO DE PISO 24U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'RACK ABIERTO DE PISO 24U DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1339, 'PRODUCTO', 'RACK ABIERTO DE PISO 36U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'RACK ABIERTO DE PISO 36U DE METALNET -PINTURA ELECTROESTÁTICA - 2 POST VERTICALES - 2 PATAS DE SOPORTE - MATERIAL DE HIERRO', 'RACK ABIERTO DE PISO 36U DE METALNET -PINTURA ELECTROESTÁTICA - 2 POST VERTICALES - 2 PATAS DE SOPORTE - MATERIAL DE HIERRO', '104.46', 'RACK ABIERTO DE PISO 36U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'RACK ABIERTO DE PISO 36U DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1340, 'PRODUCTO', 'RACK ABIERTO DE PISO 42U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'RACK ABIERTO DE PISO 42U DE METALNET -PINTURA ELECTROESTÁTICA - 2 POST VERTICALES - 2 PATAS DE SOPORTE - MATERIAL DE HIERRO', 'RACK ABIERTO DE PISO 42U DE METALNET -PINTURA ELECTROESTÁTICA - 2 POST VERTICALES - 2 PATAS DE SOPORTE - MATERIAL DE HIERRO', '135.79', 'RACK ABIERTO DE PISO 42U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'RACK ABIERTO DE PISO 42U DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1341, 'PRODUCTO', 'ORGANIZADOR 1U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'ORGANIZADOR 1U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'ORGANIZADOR 1U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '10.92', 'ORGANIZADOR 1U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'ORGANIZADOR 1U DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1342, 'PRODUCTO', 'ORGANIZADOR 2U DE METALNET', 'SISTEMAS DE SEGURIDAD', 'ORGANIZADOR 2U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'ORGANIZADOR 2U DE METALNET - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '14.80', 'ORGANIZADOR 2U DE METALNET.png', '', '', 'Pieza', 100, 'NO', 'ORGANIZADOR 2U DE METALNET ', 'METALNET ', 'SEGURIDAD'),
(1343, 'PRODUCTO', 'TUBO 5 HILOS ESQUINA', 'SISTEMAS DE SEGURIDAD', 'TUBO 5 HILOS ESQUINA - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'TUBO 5 HILOS ESQUINA - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '9.46', 'TUBO 5 HILOS ESQUINA.png', '', '', 'Pieza', 100, 'NO', 'TUBO 5 HILOS ESQUINA ', 'METALNET ', 'SEGURIDAD'),
(1344, 'PRODUCTO', 'TUBO 5 HILOS PASO', 'SISTEMAS DE SEGURIDAD', 'TUBO 5 HILOS PASO - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'TUBO 5 HILOS PASO - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '10.89', 'TUBO 5 HILOS PASO.png', '', '', 'Pieza', 100, 'NO', 'TUBO 5 HILOS PASO ', 'METALNET ', 'SEGURIDAD'),
(1345, 'PRODUCTO', 'TUBO 6 HILOS ESQUINA', 'SISTEMAS DE SEGURIDAD', 'TUBO 6 HILOS ESQUINA - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'TUBO 6 HILOS ESQUINA - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '11.53', 'TUBO 6 HILOS ESQUINA.png', '', '', 'Pieza', 100, 'NO', 'TUBO 6 HILOS ESQUINA ', 'METALNET ', 'SEGURIDAD'),
(1346, 'PRODUCTO', 'TUBO 6 HILOS PASO', 'SISTEMAS DE SEGURIDAD', 'TUBO 6 HILOS PASO - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'TUBO 6 HILOS PASO - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '12.50', 'TUBO 6 HILOS PASO.png', '', '', 'Pieza', 100, 'NO', 'TUBO 6 HILOS PASO ', 'METALNET ', 'SEGURIDAD'),
(1347, 'PRODUCTO', 'TUBO 10 HILOS ESQUINA', 'SISTEMAS DE SEGURIDAD', 'TUBO 10 HILOS ESQUINA - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'TUBO 10 HILOS ESQUINA - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '21.89', 'TUBO 10 HILOS ESQUINA.png', '', '', 'Pieza', 100, 'NO', 'TUBO 10 HILOS ESQUINA ', 'METALNET ', 'SEGURIDAD'),
(1348, 'PRODUCTO', 'TUBO 10 HILOS PASO', 'SISTEMAS DE SEGURIDAD', 'TUBO 10 HILOS PASO - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', 'TUBO 10 HILOS PASO - PINTURA ELECTROESTÁTICA - MATERIAL: HIERRO', '24.92', 'TUBO 10 HILOS PASO.png', '', '', 'Pieza', 100, 'NO', 'TUBO 10 HILOS PASO ', 'METALNET ', 'SEGURIDAD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sspi_productos_vendidos`
--

CREATE TABLE `sspi_productos_vendidos` (
  `ID_PRODUCTO_VENDIDO` int(11) NOT NULL,
  `NOMBRE_PRODUCTO` varchar(300) DEFAULT NULL,
  `PRECIO_UNITARIO_DOL` decimal(20,2) DEFAULT NULL,
  `CANTIDAD_VENDIDA` int(11) DEFAULT NULL,
  `TOTAL_DOL` decimal(20,2) DEFAULT NULL,
  `ID_VENTA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sspi_productos_vendidos`
--

INSERT INTO `sspi_productos_vendidos` (`ID_PRODUCTO_VENDIDO`, `NOMBRE_PRODUCTO`, `PRECIO_UNITARIO_DOL`, `CANTIDAD_VENDIDA`, `TOTAL_DOL`, `ID_VENTA`) VALUES
(1, 'AC1200 Archer C50', '49.64', 1, '49.64', 1),
(2, 'ACC-DIS-lTBSGSH', '109.50', 2, '219.00', 1),
(3, 'ACC-DIS-WDlEUPU', '65.70', 10, '657.00', 2),
(4, 'ACC-DIS-6TBSG', '357.70', 20, '7154.00', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sspi_rubros`
--

CREATE TABLE `sspi_rubros` (
  `ID_RUBRO` int(11) NOT NULL,
  `NOMBRE_RUBRO` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sspi_rubros`
--

INSERT INTO `sspi_rubros` (`ID_RUBRO`, `NOMBRE_RUBRO`) VALUES
(2, 'CORREAS'),
(3, 'SEGURIDAD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sspi_tasas_de_cambio`
--

CREATE TABLE `sspi_tasas_de_cambio` (
  `ID_TASA_CAMBIO` int(11) NOT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  `BS_X_DOLAR` decimal(20,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sspi_tasas_de_cambio`
--

INSERT INTO `sspi_tasas_de_cambio` (`ID_TASA_CAMBIO`, `FECHA_REGISTRO`, `BS_X_DOLAR`) VALUES
(1, '2021-08-19 00:00:00', '4142988.77'),
(3, '2021-09-04 05:09:23', '4000000.00'),
(4, '2021-10-12 07:10:19', '4.09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sspi_tienda`
--

CREATE TABLE `sspi_tienda` (
  `ID_TIENDA` int(11) NOT NULL,
  `SECCION` varchar(300) DEFAULT NULL,
  `DESCRIPCION` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sspi_tienda`
--

INSERT INTO `sspi_tienda` (`ID_TIENDA`, `SECCION`, `DESCRIPCION`) VALUES
(1, 'POLITICAS', '		<h2 class="px-2 py-2 bg-naranja text-center text-light mb-0 rounded-top border border-dark"><b>Política de Privacidad:</b></h2>\r\n		<div class="bg-white text-dark py-2 px-3 rounded-bottom border border-dark">\r\n			<p class="text-right"><i><b>Última actualización: 31 de Enero del 2021</b></i></p>\r\n			<p>El presente Política de Privacidad establece los términos en que SERSUPRINCA usa y protege la información que es proporcionada por sus usuarios al momento de utilizar su sitio web. Esta compañía está comprometida con la seguridad de los datos de sus usuarios. Cuando le pedimos llenar los campos de información personal con la cual usted pueda ser identificado, lo hacemos asegurando que sólo se empleará de acuerdo con los términos de este documento. Sin embargo esta Política de Privacidad puede cambiar con el tiempo o ser actualizada por lo que le recomendamos y enfatizamos revisar continuamente esta página para asegurarse que está de acuerdo con dichos cambios.</p>\r\n		</div>\r\n		<br><br>\r\n		<h2 class="px-2 py-2 bg-naranja text-center text-light mb-0 rounded-top border border-dark"><b>Información que es recogida:</b></h2>\r\n		<div class="bg-white text-dark py-2 px-3 rounded-bottom border border-dark">\r\n			<p>Nuestro sitio web podrá recoger información personal por ejemplo: Nombre,  información de contacto como  su dirección de correo electrónica e información demográfica. Así mismo cuando sea necesario podrá ser requerida información específica para procesar algún pedido o realizar una entrega o facturación.</p>\r\n		</div>\r\n		<br><br>\r\n		<h2 class="px-2 py-2 bg-naranja text-center text-light mb-0 rounded-top border border-dark"><b>Uso de la información recogida:</b></h2>\r\n		<div class="bg-white text-dark py-2 px-3 rounded-bottom border border-dark">\r\n			<p>Nuestro sitio web emplea la información con el fin de proporcionar el mejor servicio posible, particularmente para mantener un registro de usuarios, de pedidos en caso que aplique, y mejorar nuestros productos y servicios.  Es posible que sean enviados correos electrónicos periódicamente a través de nuestro sitio con ofertas especiales, nuevos productos y otra información publicitaria que consideremos relevante para usted o que pueda brindarle algún beneficio, estos correos electrónicos serán enviados a la dirección que usted proporcione y podrán ser cancelados en cualquier momento.</p>\r\n			<p>SERSUPRINCA está altamente comprometido para cumplir con el compromiso de mantener su información segura. Usamos los sistemas más avanzados y los actualizamos constantemente para asegurarnos que no exista ningún acceso no autorizado.</p>\r\n		</div>\r\n		<br><br>\r\n		<h2 class="px-2 py-2 bg-naranja text-center text-light mb-0 rounded-top border border-dark"><b>Cookies:</b></h2>\r\n		<div class="bg-white text-dark py-2 px-3 rounded-bottom border border-dark">\r\n			<p>Una cookie se refiere a un fichero que es enviado con la finalidad de solicitar permiso para almacenarse en su ordenador, al aceptar dicho fichero se crea y la cookie sirve entonces para tener información respecto al tráfico web, y también facilita las futuras visitas a una web recurrente. Otra función que tienen las cookies es que con ellas las web pueden reconocerte individualmente y por tanto brindarte el mejor servicio personalizado de su web.</p>\r\n			<p>Nuestro sitio web emplea las cookies para poder identificar las páginas que son visitadas y su frecuencia. Esta información es empleada únicamente para análisis estadístico y después la información se elimina de forma permanente. Usted puede eliminar las cookies en cualquier momento desde su ordenador. Sin embargo las cookies ayudan a proporcionar un mejor servicio de los sitios web, estás no dan acceso a información de su ordenador ni de usted, a menos de que usted así lo quiera y la proporcione directamente, <strong class="text-danger">visitas a una web</strong>. Usted puede aceptar o negar el uso de cookies, sin embargo la mayoría de navegadores aceptan cookies automáticamente pues sirve para tener un mejor servicio web. También usted puede cambiar la configuración de su ordenador para declinar las cookies. Si se declinan es posible que no pueda utilizar algunos de nuestros servicios.</p>\r\n		</div>\r\n		<br><br>\r\n		<h2 class="px-2 py-2 bg-naranja text-center text-light mb-0 rounded-top border border-dark"><b>Enlaces a Terceros:</b></h2>\r\n		<div class="bg-white text-dark py-2 px-3 rounded-bottom border border-dark">\r\n			<p>Este sitio web pudiera contener enlaces a otros sitios que pudieran ser de su interés. Una vez que usted de clic en estos enlaces y abandone nuestra página, ya no tenemos control sobre al sitio al que es redirigido y por lo tanto no somos responsables de los términos o privacidad ni de la protección de sus datos en esos otros sitios terceros. Dichos sitios están sujetos a sus propias políticas de privacidad por lo cual es recomendable que los consulte para confirmar que usted está de acuerdo con estas.</p>\r\n		</div>\r\n		<br><br>\r\n		<h2 class="px-2 py-2 bg-naranja text-center text-light mb-0 rounded-top border border-dark"><b>Control de su información personal:</b></h2>\r\n		<div class="bg-white text-dark py-2 px-3 rounded-bottom border border-dark">\r\n			<p>En cualquier momento usted puede restringir la recopilación o el uso de la información personal que es proporcionada a nuestro sitio web. Cada vez que se le solicite rellenar un formulario, como el de alta de usuario (Registro de nuevos usuarios), puede marcar o desmarcar la opción de recibir información por correo electrónico.  En caso de que haya marcado la opción de recibir nuestro boletín o publicidad usted puede cancelarla en cualquier momento.</p>\r\n			<p>Esta compañía no venderá, cederá ni distribuirá la información personal que es recopilada sin su consentimiento, salvo que sea requerido por un juez con un orden judicial.</p>\r\n			<p>SERSUPRINCA Se reserva el derecho de cambiar los términos de la presente Política de Privacidad en cualquier momento.</p>\r\n		</div>\r\n'),
(2, 'CONDICIONES', '<h2 class="px-2 py-2 bg-naranja text-center text-light mb-0 rounded-top border border-dark"><b>Información Relevante:</b></h2>\r\n		<div class="bg-white text-dark py-2 px-3 rounded-bottom border border-dark">\r\n			<p class="text-right"><i><b>Última actualización: 31 de Enero del 2021</b></i></p>\r\n			<p>Es requisito necesario para la adquisición de los productos que se ofrecen en este sitio, que lea y acepte los siguientes Términos y Condiciones que a continuación se redactan. El uso de nuestros servicios así como la compra de nuestros productos implicará que usted ha leído y aceptado los Términos y Condiciones de Uso en el presente documento. Todas los productos  que son ofrecidos por nuestro sitio web pudieran ser creadas, cobradas, enviadas o presentadas por una página web tercera y en tal caso estarían sujetas a sus propios Términos y Condiciones. En algunos casos, para adquirir un producto, será necesario el registro por parte del usuario, con ingreso de datos personales fidedignos y definición de una contraseña.</p>\r\n			<p>El usuario puede elegir y cambiar la clave para su acceso de administración de la cuenta en cualquier momento, en caso de que se haya registrado y que sea necesario para la compra de alguno de nuestros productos. www.sersuprinca.com no asume la responsabilidad en caso de que entregue dicha clave a terceros.</p>\r\n			<p>Todas las compras y transacciones que se lleven a cabo por medio de este sitio web, están sujetas a un proceso de confirmación y verificación, el cual podría incluir la verificación del stock y disponibilidad de producto, validación de la forma de pago, validación de la factura (en caso de existir) y el cumplimiento de las condiciones requeridas por el medio de pago seleccionado. En algunos casos puede que se requiera una verificación por medio de correo electrónico.</p>\r\n			<p>Los precios de los productos ofrecidos en esta Tienda Online es válido solamente en las compras realizadas en este sitio web.</p>\r\n		</div>\r\n		<br><br>\r\n		<h2 class="px-2 py-2 bg-naranja text-center text-light mb-0 rounded-top border border-dark"><b>Licencia:</b></h2>\r\n		<div class="bg-white text-dark py-2 px-3 rounded-bottom border border-dark">\r\n			<p>SERSUPRINCA a través de su sitio web concede una licencia para que los usuarios utilicen los productos que son vendidos en este sitio web de acuerdo a los Términos y Condiciones que se describen en este documento.</p>\r\n		</div>\r\n		<br><br>\r\n		<h2 class="px-2 py-2 bg-naranja text-center text-light mb-0 rounded-top border border-dark"><b>Uso no Autorizado:</b></h2>\r\n		<div class="bg-white text-dark py-2 px-3 rounded-bottom border border-dark">\r\n			<p>En caso de que aplique (para venta de software, templetes, u otro producto de diseño y programación) usted no puede colocar uno de nuestros productos, modificado o sin modificar, en un CD, sitio web o ningún otro medio y ofrecerlos para la redistribución o la reventa de ningún tipo.</p>\r\n		</div>\r\n		<br><br>\r\n		<h2 class="px-2 py-2 bg-naranja text-center text-light mb-0 rounded-top border border-dark"><b>Propiedad:</b></h2>\r\n		<div class="bg-white text-dark py-2 px-3 rounded-bottom border border-dark">\r\n			<p>Usted no puede declarar propiedad intelectual o exclusiva a ninguno de nuestros productos, modificado o sin modificar. Todos los productos son propiedad  de los proveedores del contenido. En caso de que no se especifique lo contrario, nuestros productos se proporcionan sin ningún tipo de garantía, expresa o implícita. En ningún esta compañía será  responsables de ningún daño incluyendo, pero no limitado a, daños directos, indirectos, especiales, fortuitos o consecuentes u otras pérdidas resultantes del uso o de la imposibilidad de utilizar nuestros productos.</p>\r\n		</div>\r\n		<br><br>\r\n		<h2 class="px-2 py-2 bg-naranja text-center text-light mb-0 rounded-top border border-dark"><b>Política de reembolso y Garantía:</b></h2>\r\n		<div class="bg-white text-dark py-2 px-3 rounded-bottom border border-dark">\r\n			<p>En el caso de productos que sean  mercancías irrevocables no-tangibles, no realizamos reembolsos después de que se envíe el producto, usted tiene la responsabilidad de entender antes de comprarlo. Le pedimos que lea cuidadosamente antes de comprarlo. Hacemos solamente excepciones con esta regla cuando la descripción no se ajusta al producto. Hay algunos productos que pudieran tener garantía y posibilidad de reembolso pero este será especificado al comprar el producto. En tales casos la garantía solo cubrirá fallas de fábrica y sólo se hará efectiva cuando el producto se haya usado correctamente. La garantía no cubre averías o daños ocasionados por uso indebido. Los términos de la garantía están asociados a fallas de fabricación y funcionamiento en condiciones normales de los productos y sólo se harán efectivos estos términos si el equipo ha sido usado correctamente. Esto \r\n			incluye:</p>\r\n			<ul>\r\n				<li>De acuerdo a las especificaciones técnicas indicadas para cada producto.</li>\r\n				<li>En condiciones ambientales acorde con las especificaciones indicadas por el fabricante.</li>\r\n				<li>En uso específico para la función con que fue diseñado de fábrica.</li>\r\n				<li>En condiciones de operación eléctricas acorde con las especificaciones y tolerancias indicadas.</li>\r\n			</ul>\r\n		</div>\r\n		<br><br>\r\n		<h2 class="px-2 py-2 bg-naranja text-center text-light mb-0 rounded-top border border-dark"><b>Comprobación antifraude:</b></h2>\r\n		<div class="bg-white text-dark py-2 px-3 rounded-bottom border border-dark">\r\n			<p>La compra del cliente puede ser aplazada para la comprobación antifraude. También puede ser suspendida por más tiempo para una investigación más rigurosa, para evitar transacciones fraudulentas.</p>\r\n		</div>\r\n		<br><br>\r\n		<h2 class="px-2 py-2 bg-naranja text-center text-light mb-0 rounded-top border border-dark"><b>Privacidad:</b></h2>\r\n		<div class="bg-white text-dark py-2 px-3 rounded-bottom border border-dark">\r\n			<p>Este sitio web www.sersuprinca.com garantiza que la información personal que usted envía cuenta con la seguridad necesaria. Los datos ingresados por usuario o en el caso de requerir una validación de los pedidos no serán entregados a terceros, salvo que deba ser revelada en cumplimiento a una orden judicial o requerimientos legales.</p>\r\n			<p>La suscripción a boletines de correos electrónicos publicitarios es voluntaria y podría ser seleccionada al momento de crear su cuenta.</p>\r\n			<p>SERSUPRINCA reserva los derechos de cambiar o de modificar estos términos sin previo aviso.</p>\r\n		</div>'),
(3, 'COOKIES', '<h2 class="px-2 py-2 bg-naranja text-center text-light mb-0 rounded-top border border-dark"><b>Sobre del Uso de Cookies:</b></h2>\r\n		<div class="bg-white text-dark py-2 px-3 rounded-bottom border border-dark">\r\n			<p class="text-right"><i><b>Última actualización: 31 de Enero del 2021</b></i></p>\r\n			<p>Este sitio web utiliza cookies para mejorar la experiencia del usuario en este portal de internet llevando a cabo determinadas funciones que son consideradas imprescindibles para el correcto funcionamiento y visualización del sitio. Las Cookies son archivos que el sitio web o la aplicación que utilizas instala en tu navegador o en tu dispositivo (Smartphone, tableta o televisión conectada) durante tu recorrido por páginas o por aplicación, y sirven para almacenar información sobre tu visita.</p>\r\n			<p>El portal web de SERSUPRINCA se reserva el derecho de utilizar Cookies para:</p>\r\n    		<ul>\r\n    			<li>Que las páginas web pueden funcionar correctamente.</li>\r\n    			<li>Almacenar tus preferencias.</li>\r\n    			<li>Conocer tu experiencia de navegación.</li>\r\n    			<li>Recopilar información estadística anónima, como qué páginas has visto o cuánto tiempo has estado navegando.</li>\r\n    		</ul>\r\n    		<p>El uso de Cookies nos permitirán optimizar tu navegación, adaptando la información y los servicios ofrecidos a tus intereses, para proporcionarte una mejor experiencia siempre que nos visites. El sitio web de SERSUPRINCA utiliza Cookies para funcionar, adaptar y facilitar al máximo la navegación del Usuario. Las Cookies se asocian únicamente a un usuario anónimo y su ordenador/dispositivo y no proporcionan referencias que permitan conocer datos personales. En todo momento podrás acceder a la configuración de tu navegador para modificar y/o bloquear la instalación de las Cookies enviadas por nuestro sitio web, aunque algunas de las funcionalidades pueden verse afectadas.</p>\r\n		</div>\r\n		<br><br>\r\n		<h2 class="px-2 py-2 bg-naranja text-center text-light mb-0 rounded-top border border-dark"><b>¿Qué tipos de Cookies podría utilizar este sitio web?</b></h2>\r\n		<div class="bg-white text-dark py-2 px-3 rounded-bottom border border-dark">\r\n			<p><b>Cookies técnicas:</b> Son aquéllas que permiten al usuario la navegación a través de una página web, plataforma o aplicación y la utilización de las diferentes opciones o servicios que en ella existan como, por ejemplo, controlar el tráfico y la comunicación de datos, identificar la sesión, acceder a partes de acceso restringido, recordar los elementos que integran un pedido, realizar el proceso de compra de un pedido, realizar la solicitud de inscripción o participación en un evento, utilizar elementos de seguridad durante la navegación, almacenar contenidos para la difusión de videos o sonido o compartir contenidos a través de redes sociales.</p>\r\n			<p><b>Cookies de personalización:</b> Son aquéllas que permiten al usuario acceder al servicio con algunas características de carácter general predefinidas en función de una serie de criterios en el terminal del usuario como por ejemplo serian el idioma, el tipo de navegador a través del cual accede al servicio, la configuración regional desde donde accede al servicio, etc.</p>\r\n			<p><b>Cookies de análisis:</b> Son aquéllas que bien tratadas por nosotros o por terceros, nos permiten cuantificar el número de usuarios y así realizar la medición y análisis estadístico de la utilización que hacen los usuarios del servicio ofertado. Para ello se analiza su navegación en nuestra página web con el fin de mejorar la oferta de productos o servicios que le ofrecemos.</p>\r\n			<p><b>Cookies publicitarias:</b> Son aquéllas que, bien tratadas por nosotros o por terceros, nos permiten gestionar de la forma más eficaz posible la oferta de los espacios publicitarios que hay en la página web, adecuando el contenido del anuncio al contenido del servicio solicitado o al uso que realice de nuestra página web. Para ello podemos analizar sus hábitos de navegación en Internet y podemos mostrarle publicidad relacionada con su perfil de navegación.</p>\r\n			<p><b>Cookies de publicidad comportamental:</b> Son aquéllas que permiten la gestión, de la forma más eficaz posible, de los espacios publicitarios que, en su caso, el editor haya incluido en una página web, aplicación o plataforma desde la que presta el servicio solicitado. Estas cookies almacenan información del comportamiento de los usuarios obtenida a través de la observación continuada de sus hábitos de navegación, lo que permite desarrollar un perfil específico para mostrar publicidad en función del mismo.</p>\r\n			<p>En particular, este sitio Web utiliza Google Analytics, un servicio analítico de web prestado por Google, Inc. con domicilio en los Estados Unidos con sede central en 1600 Amphitheatre Parkway, Mountain View, California 94043. Para la prestación de estos servicios, estos utilizan cookies que recopilan la información, incluida la dirección IP del usuario, que será transmitida, tratada y almacenada por Google en los términos fijados en la Web Google.com. Incluyendo la posible transmisión de dicha información a terceros por razones de exigencia legal o cuando dichos terceros procesen la información por cuenta de Google.</p>\r\n		</div>\r\n		<br><br>\r\n		<h2 class="px-2 py-2 bg-naranja text-center text-light mb-0 rounded-top border border-dark"><b>¿Cómo puedo configurar mis preferencias?</b></h2>\r\n		<div class="bg-white text-dark py-2 px-3 rounded-bottom border border-dark">\r\n			<p>Dado que las Cookies no son necesarias para el uso de nuestro Sitio Web, puede bloquearlas o deshabilitarlas activando la configuración de su navegador, que le permite rechazar la instalación de todas las cookies o de algunas de ellas. La mayoría de los navegadores permiten advertir de la presencia de Cookies o rechazarlas automáticamente. Si las rechaza podrá seguir usando nuestro Sitio Web, aunque el uso de algunos de sus servicios podrá ser limitado y por tanto su experiencia en nuestro Sitio Web será menos satisfactoria.</p>\r\n			<p>Para permitir, conocer, bloquear o eliminar las cookies instaladas en tu equipo puedes hacerlo mediante la configuración de las opciones del navegador instalado en su ordenador.</p>\r\n			<p>A continuación le ofrecemos enlaces en los que encontrará información sobre cómo puede activar sus preferencias en los principales navegadores:</p>\r\n    		<ul>\r\n    			<li>Firefox: <a href="http://support.mozilla.org/es/products/firefox/cookies">http://support.mozilla.org/es/products/firefox/cookies</a>.</li>\r\n    			<li>Chrome: <a href="http://support.google.com/chrome/bin/answer.py?hl=es&answer=95647">http://support.google.com/chrome/bin/answer.py?hl=es&answer=95647</a>.</li>\r\n    			<li>Explorer: <a href="http://windows.microsoft.com/es-es/windows7/how-to-manage-cookies-in-internet-explorer-9">http://windows.microsoft.com/es-es/windows7/how-to-manage-cookies-in-internet-explorer-9</a>.</li>\r\n    			<li>Safari: <a href="http://support.apple.com/kb/ph5042">http://support.apple.com/kb/ph5042</a>.</li>\r\n    			<li>Opera: <a href="http://help.opera.com/Windows/11.50/es-ES/cookies.html">http://help.opera.com/Windows/11.50/es-ES/cookies.html</a>.</li>\r\n    		</ul>\r\n		</div>\r\n		<br><br>\r\n		<h2 class="px-2 py-2 bg-naranja text-center text-light mb-0 rounded-top border border-dark"><b>¿Actualizamos nuestra Política de Cookies?</b></h2>\r\n		<div class="bg-white text-dark py-2 px-3 rounded-bottom border border-dark">\r\n			<p>Es posible que actualicemos la Política sobre el uso de Cookies de nuestro Sitio Web, por ello le recomendamos revisar esta política cada vez que acceda a nuestro Sitio Web con el objetivo de estar adecuadamente informado sobre cómo y para qué usamos las cookies.</p>\r\n		</div>'),
(4, 'NOSOTROS', '<h2 class="px-2 py-2 bg-naranja text-center text-light mb-0 rounded-top border border-dark"><b>Quiénes Somos</b></h2>\r\n		<div class="bg-white text-dark py-2 px-3 rounded-bottom border border-dark">\r\n			<p>Somos una  empresa  venezolana  impulsada  por la  iniciativa de  profesionales calificados y con estudios de ingeniería, dedicados al desarrollo de actividades referidas a la seguridad industrial, protección contra incendios, seguridad física, proyectos, consultoría, asesoría técnica, inspección de obras, sistemas eléctricos, suministro de equipos e insumos para la industria y el sector civil. Fundada  en el  año  2013  con  amplias expectativas de crecimiento, competencias y posicionamiento dentro del mercado venezolano.</p>\r\n		</div>\r\n		<br><br>\r\n		<h2 class="px-2 py-2 bg-naranja text-center text-light mb-0 rounded-top border border-dark"><b>Misión</b></h2>\r\n		<div class="bg-white text-dark py-2 px-3 rounded-bottom border border-dark">\r\n			<p>Prestar servicios con alto nivel de compromiso y de calidad en las áreas de Seguridad Industrial, Protección Contra Incendios, Seguridad física, proyectos, consultoría, asesoría técnica, inspección de obras, Suministro de equipos e insumos para la industria y el sector civil, orientados al desarrollo del país y convertirse en una de las principales empresas dedicadas a este sector.</p>\r\n		</div>\r\n		<br><br>\r\n		<h2 class="px-2 py-2 bg-naranja text-center text-light mb-0 rounded-top border border-dark"><b>Visión</b></h2>\r\n		<div class="bg-white text-dark py-2 px-3 rounded-bottom border border-dark">\r\n			<p>Ser la principal empresa en el ámbito de la Seguridad Industrial y de referencia nacional en el suministro de servicios, equipos, asesoría técnica, protección contra incendios y proyectos que impulsen con su valor agregado el desarrolla Nacional, en concordancia con el entorno y el compromiso social.</p>\r\n		</div>\r\n		<br><br>\r\n		<h2 class="px-2 py-2 bg-naranja text-center text-light mb-0 rounded-top border border-dark"><b>Valores</b></h2>\r\n		<div class="bg-white text-dark py-2 px-3 rounded-bottom border border-dark">\r\n			<ul>\r\n				<li>Responsabilidad</li>\r\n				<li>Cordialidad</li>\r\n				<li>Integridad</li>\r\n				<li>Profesionalismo</li>\r\n				<li>Calidad de Servicio</li>\r\n				<li>Suministro Oportuno</li>\r\n			</ul>\r\n			<p>Somos un equipo de trabajo que tiene una elevada vocación de servicio con nuestros Clientes, estamos comprometidos en aumentar los equipos y maquinaria para mejorar la eficiencia de nuestros servicios, e incrementar su confianza en la organización. Respetamos el medio ambiente, la diversidad, la libertad de pensamiento, dentro de los parámetros morales y legales establecidos. Escuchamos, Respetamos y valoramos las ideas y creencias de colaboradores, proveedores, gobierno, comunidad en general y partes interesadas. Unimos esfuerzos y saberes para ser cada vez más competitivos y productivos.</p>\r\n		</div>\r\n		<br><br>\r\n		<h2 class="px-2 py-2 bg-naranja text-center text-light mb-0 rounded-top border border-dark"><b>Política de Calidad</b></h2>\r\n		<div class="bg-white text-dark py-2 px-3 rounded-bottom border border-dark">\r\n			<p>Para cumplir con nuestros servicios, la Compañía está dedicada a:</p>\r\n			<ul>\r\n				<li>Lograr la satisfacción del cliente, cumpliendo sus requerimientos de calidad, tiempo y costo.</li>\r\n				<li>Promover la participación de las partes interesadas con el fin de alcanzar mutuos beneficios.</li>\r\n				<li>Cumplir las leyes y normas nacionales e internacionales.</li>\r\n				<li>Establecer y revisar periódicamente los Objetivos del Sistema de Gestión de la Calidad.</li>\r\n				<li>Mejorar, a través de la formación, información y sensibilización de nuestros representantes con respecto a la aplicación efectiva del Sistema de Gestión de la Calidad y su aporte a la mejora de sus procesos.</li>\r\n				<li>Promover la mejora continua en base a la medición de los resultados del Sistema de Gestión de la Calidad y el análisis de las lecciones aprendidas y de las no conformidades.</li>\r\n			</ul>\r\n		</div>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sspi_usuarios`
--

CREATE TABLE `sspi_usuarios` (
  `ID_USUARIO` int(11) NOT NULL,
  `NOMBRE` varchar(300) DEFAULT NULL,
  `APELLIDO` varchar(300) DEFAULT NULL,
  `CEDULA_RIF` varchar(300) DEFAULT NULL,
  `FECHA_NACIMIENTO` date DEFAULT NULL,
  `TELEFONO` varchar(300) DEFAULT NULL,
  `CORREO` varchar(300) DEFAULT NULL,
  `CONTRASENA` varchar(300) DEFAULT NULL,
  `FOTO` varchar(300) DEFAULT NULL,
  `DIRECCION` varchar(300) DEFAULT NULL,
  `BANCO_NOMBRE` varchar(300) DEFAULT NULL,
  `BANCO_CEDULA_RIF` varchar(300) DEFAULT NULL,
  `BANCO_TIPO_CUENTA` varchar(300) DEFAULT NULL,
  `BANCO_NUMERO_CUENTA` varchar(300) DEFAULT NULL,
  `BANCO_TELEFONO` varchar(300) DEFAULT NULL,
  `NIVEL_ACCESO` varchar(300) DEFAULT NULL,
  `ID_JEFE` int(11) NOT NULL,
  `JURIDICO_NATURAL` varchar(300) DEFAULT NULL,
  `PAGO_SUSCRIPCION_INF` text,
  `PAGO_SUSCRIPCION_BS` decimal(20,2) DEFAULT NULL,
  `PAGO_SUSCRIPCION_DOLAR` decimal(20,2) DEFAULT NULL,
  `ESTATUS` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sspi_usuarios`
--

INSERT INTO `sspi_usuarios` (`ID_USUARIO`, `NOMBRE`, `APELLIDO`, `CEDULA_RIF`, `FECHA_NACIMIENTO`, `TELEFONO`, `CORREO`, `CONTRASENA`, `FOTO`, `DIRECCION`, `BANCO_NOMBRE`, `BANCO_CEDULA_RIF`, `BANCO_TIPO_CUENTA`, `BANCO_NUMERO_CUENTA`, `BANCO_TELEFONO`, `NIVEL_ACCESO`, `ID_JEFE`, `JURIDICO_NATURAL`, `PAGO_SUSCRIPCION_INF`, `PAGO_SUSCRIPCION_BS`, `PAGO_SUSCRIPCION_DOLAR`, `ESTATUS`) VALUES
(1, 'OSCAR', 'IDROGO', '13813353', '1977-12-17', '0424-9612361', 'OSCAR.IDROGO.OI@GMAIL.COM', '$2y$10$b05pAzqON.DtOy9O3JcJ2.ORpChXShFwNyRx9vcVKJEwwuHxwpY2O', 'prueba@prueba.png', 'Sector Tipuro, Urbanización Villas de la Laguna', 'BANCO MERCANTIL', '13813353', 'AHORRO', '01050229250229016979', '0424-9612361', 'ADMINISTRADOR', 0, 'Natural', '', '0.00', '0.00', 'ACTIVO'),
(2, 'prueba', '123123A', '1231212', '2021-10-06', '87234982794382734', 'asdas@d.asd', '$2y$10$b05pAzqON.DtOy9O3JcJ2.ORpChXShFwNyRx9vcVKJEwwuHxwpY2O', 'vacio.png', 'prueba', 'Bancaribe C.A. Banco Universal', '51351351', 'Ahorro', '7236498263498', '676345-34535', 'CLIENTE', 0, 'Natural', 'EFECTIVO', '100.00', '0.00', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sspi_ventas`
--

CREATE TABLE `sspi_ventas` (
  `ID_VENTA` int(11) NOT NULL,
  `TIPO_VENTA` varchar(300) DEFAULT NULL,
  `ESTATUS_VENTA` varchar(300) DEFAULT NULL,
  `ESTATUS_ENTREGA` varchar(300) DEFAULT NULL,
  `NIVEL_ACCESO_VENDEDOR` varchar(300) DEFAULT NULL,
  `CEDULA_RIF_VENDEDOR` varchar(300) DEFAULT NULL,
  `CEDULA_RIF_CLIENTE` varchar(300) DEFAULT NULL,
  `TOTAL_A_PAGAR_DOL_PUROS` decimal(20,2) DEFAULT NULL,
  `PORC_ADM` decimal(20,2) DEFAULT NULL,
  `CEDULA_RIF_ADM` varchar(300) DEFAULT NULL,
  `PORC_VEN_1` decimal(20,2) DEFAULT NULL,
  `CEDULA_RIF_VEN_1` varchar(300) DEFAULT NULL,
  `PORC_VEN_2` decimal(20,2) DEFAULT NULL,
  `CEDULA_RIF_VEN_2` varchar(300) DEFAULT NULL,
  `ABONO_1_FECHA` datetime DEFAULT NULL,
  `ABONO_1_BS_X_DOLAR` decimal(20,2) DEFAULT NULL,
  `ABONO_1_DOL` decimal(20,2) DEFAULT NULL,
  `ABONO_1_BS` decimal(20,2) DEFAULT NULL,
  `ABONO_1_DOL_EQ` decimal(20,2) DEFAULT NULL,
  `ABONO_1_BS_EQ` decimal(20,2) DEFAULT NULL,
  `ABONO_1_INF` text,
  `ABONO_2_FECHA` datetime DEFAULT NULL,
  `ABONO_2_BS_X_DOLAR` decimal(20,2) DEFAULT NULL,
  `ABONO_2_DOL` decimal(20,2) DEFAULT NULL,
  `ABONO_2_BS` decimal(20,2) DEFAULT NULL,
  `ABONO_2_DOL_EQ` decimal(20,2) DEFAULT NULL,
  `ABONO_2_BS_EQ` decimal(20,2) DEFAULT NULL,
  `ABONO_2_INF` text,
  `ABONO_3_FECHA` datetime DEFAULT NULL,
  `ABONO_3_BS_X_DOLAR` decimal(20,2) DEFAULT NULL,
  `ABONO_3_DOL` decimal(20,2) DEFAULT NULL,
  `ABONO_3_BS` decimal(20,2) DEFAULT NULL,
  `ABONO_3_DOL_EQ` decimal(20,2) DEFAULT NULL,
  `ABONO_3_BS_EQ` decimal(20,2) DEFAULT NULL,
  `ABONO_3_INF` text,
  `ABONO_4_FECHA` datetime DEFAULT NULL,
  `ABONO_4_BS_X_DOLAR` decimal(20,2) DEFAULT NULL,
  `ABONO_4_DOL` decimal(20,2) DEFAULT NULL,
  `ABONO_4_BS` decimal(20,2) DEFAULT NULL,
  `ABONO_4_DOL_EQ` decimal(20,2) DEFAULT NULL,
  `ABONO_4_BS_EQ` decimal(20,2) DEFAULT NULL,
  `ABONO_4_INF` text,
  `OBSERVACIONES` text,
  `IVA` decimal(20,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sspi_ventas`
--

INSERT INTO `sspi_ventas` (`ID_VENTA`, `TIPO_VENTA`, `ESTATUS_VENTA`, `ESTATUS_ENTREGA`, `NIVEL_ACCESO_VENDEDOR`, `CEDULA_RIF_VENDEDOR`, `CEDULA_RIF_CLIENTE`, `TOTAL_A_PAGAR_DOL_PUROS`, `PORC_ADM`, `CEDULA_RIF_ADM`, `PORC_VEN_1`, `CEDULA_RIF_VEN_1`, `PORC_VEN_2`, `CEDULA_RIF_VEN_2`, `ABONO_1_FECHA`, `ABONO_1_BS_X_DOLAR`, `ABONO_1_DOL`, `ABONO_1_BS`, `ABONO_1_DOL_EQ`, `ABONO_1_BS_EQ`, `ABONO_1_INF`, `ABONO_2_FECHA`, `ABONO_2_BS_X_DOLAR`, `ABONO_2_DOL`, `ABONO_2_BS`, `ABONO_2_DOL_EQ`, `ABONO_2_BS_EQ`, `ABONO_2_INF`, `ABONO_3_FECHA`, `ABONO_3_BS_X_DOLAR`, `ABONO_3_DOL`, `ABONO_3_BS`, `ABONO_3_DOL_EQ`, `ABONO_3_BS_EQ`, `ABONO_3_INF`, `ABONO_4_FECHA`, `ABONO_4_BS_X_DOLAR`, `ABONO_4_DOL`, `ABONO_4_BS`, `ABONO_4_DOL_EQ`, `ABONO_4_BS_EQ`, `ABONO_4_INF`, `OBSERVACIONES`, `IVA`) VALUES
(1, 'DE CONTADO', 'PAGADO', 'ENTREGADO', 'ADMINISTRADOR', '13813353', '1231212', '268.64', '0.00', '13813353', '0.00', 'N/A', '0.00', 'N/A', '2021-10-12 07:10:12', '4000000.00', '268.64', '0.00', '268.64', '1074560000.00', 'Método de Pago: EFECTIVO / N° Ref: 0 (Banco Origen: N/A / Banco Destino: N/A)', '0000-00-00 00:00:00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '0000-00-00 00:00:00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '0000-00-00 00:00:00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 'Pagado el: 2021-10-12, Entregado el: 2021-10-12, (2021-10-12) esto es una prueba', '16.00'),
(2, 'DE CONTADO', 'PAGADO', 'ENTREGADO', 'ADMINISTRADOR', '13813353', '1231212', '657.00', '0.00', '13813353', '0.00', 'N/A', '0.00', 'N/A', '2021-10-12 07:10:30', '4.09', '0.00', '2687.13', '657.00', '2687.13', 'Método de Pago: EFECTIVO / N° Ref: 0 (Banco Origen: N/A / Banco Destino: N/A)', '0000-00-00 00:00:00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '0000-00-00 00:00:00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '0000-00-00 00:00:00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 'Pagado el: 2021-10-12, Entregado el: 2021-10-12, (2021-10-12) otra prueba', '16.00'),
(3, 'DE CONTADO', 'PAGADO', 'ENTREGADO', 'ADMINISTRADOR', '13813353', '1231212', '7154.00', '26.00', '13813353', '0.00', 'N/A', '0.00', 'N/A', '2021-10-12 07:10:31', '4.09', '7154.00', '0.00', '7154.00', '29259.86', 'Método de Pago: EFECTIVO / N° Ref: 0 (Banco Origen: N/A / Banco Destino: N/A)', '0000-00-00 00:00:00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '0000-00-00 00:00:00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '0000-00-00 00:00:00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 'Pagado el: 2021-10-12, Entregado el: 2021-10-12, (2021-10-12) sdfisdhusfhishuf', '16.00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sspi_carrito_compras`
--
ALTER TABLE `sspi_carrito_compras`
  ADD PRIMARY KEY (`ID_CARRITO_COMPRA`);

--
-- Indices de la tabla `sspi_categorias`
--
ALTER TABLE `sspi_categorias`
  ADD PRIMARY KEY (`ID_CATEGORIA`);

--
-- Indices de la tabla `sspi_ganancias`
--
ALTER TABLE `sspi_ganancias`
  ADD PRIMARY KEY (`ID_GANANCIA`);

--
-- Indices de la tabla `sspi_gastos`
--
ALTER TABLE `sspi_gastos`
  ADD PRIMARY KEY (`ID_GASTO`);

--
-- Indices de la tabla `sspi_mensajes`
--
ALTER TABLE `sspi_mensajes`
  ADD PRIMARY KEY (`ID_MENSAJE`);

--
-- Indices de la tabla `sspi_metodos_de_pago`
--
ALTER TABLE `sspi_metodos_de_pago`
  ADD PRIMARY KEY (`ID_METODO_DE_PAGO`);

--
-- Indices de la tabla `sspi_pago_comisiones`
--
ALTER TABLE `sspi_pago_comisiones`
  ADD PRIMARY KEY (`ID_PAGO_COMISION`);

--
-- Indices de la tabla `sspi_productos`
--
ALTER TABLE `sspi_productos`
  ADD PRIMARY KEY (`ID_PRODUCTO`);

--
-- Indices de la tabla `sspi_productos_vendidos`
--
ALTER TABLE `sspi_productos_vendidos`
  ADD PRIMARY KEY (`ID_PRODUCTO_VENDIDO`);

--
-- Indices de la tabla `sspi_rubros`
--
ALTER TABLE `sspi_rubros`
  ADD PRIMARY KEY (`ID_RUBRO`);

--
-- Indices de la tabla `sspi_tasas_de_cambio`
--
ALTER TABLE `sspi_tasas_de_cambio`
  ADD PRIMARY KEY (`ID_TASA_CAMBIO`);

--
-- Indices de la tabla `sspi_tienda`
--
ALTER TABLE `sspi_tienda`
  ADD PRIMARY KEY (`ID_TIENDA`);

--
-- Indices de la tabla `sspi_usuarios`
--
ALTER TABLE `sspi_usuarios`
  ADD PRIMARY KEY (`ID_USUARIO`);

--
-- Indices de la tabla `sspi_ventas`
--
ALTER TABLE `sspi_ventas`
  ADD PRIMARY KEY (`ID_VENTA`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sspi_carrito_compras`
--
ALTER TABLE `sspi_carrito_compras`
  MODIFY `ID_CARRITO_COMPRA` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sspi_categorias`
--
ALTER TABLE `sspi_categorias`
  MODIFY `ID_CATEGORIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `sspi_ganancias`
--
ALTER TABLE `sspi_ganancias`
  MODIFY `ID_GANANCIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `sspi_gastos`
--
ALTER TABLE `sspi_gastos`
  MODIFY `ID_GASTO` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sspi_mensajes`
--
ALTER TABLE `sspi_mensajes`
  MODIFY `ID_MENSAJE` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sspi_metodos_de_pago`
--
ALTER TABLE `sspi_metodos_de_pago`
  MODIFY `ID_METODO_DE_PAGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `sspi_pago_comisiones`
--
ALTER TABLE `sspi_pago_comisiones`
  MODIFY `ID_PAGO_COMISION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `sspi_productos`
--
ALTER TABLE `sspi_productos`
  MODIFY `ID_PRODUCTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1349;
--
-- AUTO_INCREMENT de la tabla `sspi_productos_vendidos`
--
ALTER TABLE `sspi_productos_vendidos`
  MODIFY `ID_PRODUCTO_VENDIDO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `sspi_rubros`
--
ALTER TABLE `sspi_rubros`
  MODIFY `ID_RUBRO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sspi_tasas_de_cambio`
--
ALTER TABLE `sspi_tasas_de_cambio`
  MODIFY `ID_TASA_CAMBIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `sspi_tienda`
--
ALTER TABLE `sspi_tienda`
  MODIFY `ID_TIENDA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `sspi_usuarios`
--
ALTER TABLE `sspi_usuarios`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `sspi_ventas`
--
ALTER TABLE `sspi_ventas`
  MODIFY `ID_VENTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
