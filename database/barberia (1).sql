-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-12-2019 a las 12:50:44
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `barberia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abono_cliente`
--

DROP TABLE IF EXISTS `abono_cliente`;
CREATE TABLE IF NOT EXISTS `abono_cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prestamo` int(11) NOT NULL,
  `id_cliente_p` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `valor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente_p` (`id_cliente_p`),
  KEY `id_prestamo` (`id_prestamo`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `abono_cliente`
--

INSERT INTO `abono_cliente` (`id`, `id_prestamo`, `id_cliente_p`, `fecha`, `valor`) VALUES
(6, 2, 2, '2019-11-09', 12778),
(7, 2, 2, '2019-11-10', 12778),
(8, 2, 2, '2019-11-10', 12778),
(9, 3, 1, '2019-11-10', 4000),
(10, 4, 4, '2019-11-10', 100000),
(11, 3, 1, '2019-11-10', 236000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abono_compra`
--

DROP TABLE IF EXISTS `abono_compra`;
CREATE TABLE IF NOT EXISTS `abono_compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_factura` int(11) NOT NULL,
  `fecha` int(11) NOT NULL,
  `descripcion` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_factura` (`id_factura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abono_entregados_prestamos_sucursal`
--

DROP TABLE IF EXISTS `abono_entregados_prestamos_sucursal`;
CREATE TABLE IF NOT EXISTS `abono_entregados_prestamos_sucursal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_estilista` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `valor` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `abono_entregados_prestamos_sucursal`
--

INSERT INTO `abono_entregados_prestamos_sucursal` (`id`, `id_estilista`, `id_sucursal`, `fecha`, `valor`, `estado`) VALUES
(1, 3, 1, '2019-12-26', 2000, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abono_prestamos_estilista`
--

DROP TABLE IF EXISTS `abono_prestamos_estilista`;
CREATE TABLE IF NOT EXISTS `abono_prestamos_estilista` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prestamo` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `id_estilista` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `valor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sucursal` (`id_sucursal`),
  KEY `id_estilista` (`id_estilista`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `abono_prestamos_estilista`
--

INSERT INTO `abono_prestamos_estilista` (`id`, `id_prestamo`, `id_sucursal`, `id_estilista`, `fecha`, `valor`) VALUES
(1, 1, 1, 1, '2019-12-07', 3833);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abono_prestamos_sucursal`
--

DROP TABLE IF EXISTS `abono_prestamos_sucursal`;
CREATE TABLE IF NOT EXISTS `abono_prestamos_sucursal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sucursal` int(11) NOT NULL,
  `id_estilista` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncio`
--

DROP TABLE IF EXISTS `anuncio`;
CREATE TABLE IF NOT EXISTS `anuncio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `img` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avances`
--

DROP TABLE IF EXISTS `avances`;
CREATE TABLE IF NOT EXISTS `avances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sucursal` int(11) NOT NULL,
  `id_estilista` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sucursal` (`id_sucursal`),
  KEY `id_estilista` (`id_estilista`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `avances`
--

INSERT INTO `avances` (`id`, `id_sucursal`, `id_estilista`, `valor`, `fecha`, `estado`) VALUES
(1, 1, 1, 10000, '2019-12-07', 0),
(2, 1, 3, 10000, '2019-12-08', 0),
(3, 1, 3, 5000, '2019-12-08', 0),
(4, 1, 2, 1000, '2019-12-08', 1),
(5, 1, 2, 8000, '2019-12-08', 1),
(6, 1, 1, 20000, '2019-12-08', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_producto`
--

DROP TABLE IF EXISTS `categoria_producto`;
CREATE TABLE IF NOT EXISTS `categoria_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria_producto`
--

INSERT INTO `categoria_producto` (`id`, `nombre`) VALUES
(1, 'PRODUCTOS MEKATO'),
(2, 'PRODUCTOS ESTÃ‰TICOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cierre_caja`
--

DROP TABLE IF EXISTS `cierre_caja`;
CREATE TABLE IF NOT EXISTS `cierre_caja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sucursal` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_cierre` int(11) NOT NULL,
  `venta_producto` int(11) NOT NULL,
  `venta_servicio` int(11) NOT NULL,
  `pagos_estilista` int(11) NOT NULL,
  `abono_prestamos` int(11) NOT NULL,
  `efectivo_entregado` int(11) NOT NULL,
  `diferencia` int(11) NOT NULL,
  `totalgastos` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sucursal` (`id_sucursal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cierre_pago_estilista`
--

DROP TABLE IF EXISTS `cierre_pago_estilista`;
CREATE TABLE IF NOT EXISTS `cierre_pago_estilista` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_estilista` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `valortotal` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `valorcomision` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cierre_pago_estilista`
--

INSERT INTO `cierre_pago_estilista` (`id`, `id_estilista`, `id_sucursal`, `valor`, `valortotal`, `fecha`, `valorcomision`) VALUES
(1, 1, 1, 21000, 30000, '2019-12-10', 9000),
(2, 1, 1, 5000, 10000, '2019-12-18', 5000),
(3, 3, 1, 9000, 18000, '2019-12-26', 9000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_prestamo`
--

DROP TABLE IF EXISTS `cliente_prestamo`;
CREATE TABLE IF NOT EXISTS `cliente_prestamo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `nit` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `ciudad` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente_prestamo`
--

INSERT INTO `cliente_prestamo` (`id`, `nombre`, `nit`, `telefono`, `direccion`, `ciudad`) VALUES
(1, 'PEDRO JOSE MARTINEZ DIAZ', '78454540', '3007414710', 'CALLE 15 CENTRO', 'SAHAGUN'),
(2, 'MARLOS ARRIETA BRUN', '106948784', 'calle 11 NÂ° 20 - 4', 'SAHAGUN', '7777777'),
(3, 'MARIA DEL CARMEN BUSTAMENTE LOPEZ', '45454545', 'calle 8 centro', 'SAHAGUN', '7877772'),
(4, 'WALTER ALVAREZ CORDERO', '10647878', 'calle 4 ', 'SAHAGUN', '312457863');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_venta`
--

DROP TABLE IF EXISTS `cliente_venta`;
CREATE TABLE IF NOT EXISTS `cliente_venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `nit` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `direcion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente_venta`
--

INSERT INTO `cliente_venta` (`id`, `nombre`, `nit`, `direcion`) VALUES
(1, 'CLIENTE GENÉRICO', '9999999', 'CLIENTE GENÉRICO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comisiones`
--

DROP TABLE IF EXISTS `comisiones`;
CREATE TABLE IF NOT EXISTS `comisiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` int(11) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comisiones`
--

INSERT INTO `comisiones` (`id`, `valor`, `fecha`) VALUES
(1, 50, '2019-12-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `componentes_servicio`
--

DROP TABLE IF EXISTS `componentes_servicio`;
CREATE TABLE IF NOT EXISTS `componentes_servicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_servicio` int(11) NOT NULL,
  `detalle` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_servicio` (`id_servicio`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `componentes_servicio`
--

INSERT INTO `componentes_servicio` (`id`, `id_servicio`, `detalle`) VALUES
(2, 6, '[{\"id\":\"2\",\"codigo\":\"1001\",\"descripcion\":\"displey de cuchichas\",\"cantidad\":\"2\"}]'),
(4, 7, '[{\"id\":\"2\",\"codigo\":\"1001\",\"descripcion\":\"displey de cuchichas\",\"cantidad\":\"5\"}]'),
(6, 1, '[{\"id\":\"2\",\"codigo\":\"1001\",\"descripcion\":\"displey de cuchichas\",\"cantidad\":\"1\"}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

DROP TABLE IF EXISTS `compra`;
CREATE TABLE IF NOT EXISTS `compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_proveedor` int(11) NOT NULL,
  `num_factura` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `plazo` int(11) NOT NULL,
  `fecha_compra` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `detalles` text COLLATE utf8_spanish_ci NOT NULL,
  `subtotal` int(11) NOT NULL,
  `iva` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_proveedor` (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `id_proveedor`, `num_factura`, `tipo`, `plazo`, `fecha_compra`, `fecha_vencimiento`, `detalles`, `subtotal`, `iva`, `total`, `saldo`) VALUES
(4, 5, 10150, 1, 10, '2019-11-23', '2019-12-23', '[{\"id\":\"1\",\"codigo\":\"1000\",\"descripcion\":\"papas de limon 150g \",\"cantidad\":\"10\",\"precio\":\"900\",\"descuento\":\"0\",\"subtotal\":\"9000\"},{\"id\":\"2\",\"codigo\":\"1001\",\"descripcion\":\"gaseosa 250 ml \",\"cantidad\":\"10\",\"precio\":\"500\",\"descuento\":\"0\",\"subtotal\":\"5000\"}]', 0, 0, 14000, 14000),
(5, 5, 10151, 1, 15, '2019-11-23', '2019-12-23', '[{\"id\":\"1\",\"codigo\":\"1000\",\"descripcion\":\"papas de limon 150g \",\"cantidad\":\"10\",\"precio\":\"900\",\"descuento\":\"0\",\"subtotal\":\"9000\"},{\"id\":\"2\",\"codigo\":\"1001\",\"descripcion\":\"gaseosa 250 ml \",\"cantidad\":\"10\",\"precio\":\"500\",\"descuento\":\"0\",\"subtotal\":\"5000\"}]', 0, 0, 14000, 14000),
(6, 5, 10153, 1, 30, '2019-11-23', '2019-12-23', '[{\"id\":\"1\",\"codigo\":\"1000\",\"descripcion\":\"papas de limon 150g \",\"cantidad\":\"10\",\"precio\":\"900\",\"descuento\":\"0\",\"subtotal\":\"9000\"},{\"id\":\"2\",\"codigo\":\"1001\",\"descripcion\":\"gaseosa 250 ml \",\"cantidad\":\"10\",\"precio\":\"500\",\"descuento\":\"0\",\"subtotal\":\"5000\"}]', 0, 0, 14000, 14000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_producto`
--

DROP TABLE IF EXISTS `compra_producto`;
CREATE TABLE IF NOT EXISTS `compra_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `num_factura` int(11) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `compra_producto`
--

INSERT INTO `compra_producto` (`id`, `id_producto`, `cantidad`, `num_factura`, `fecha`) VALUES
(59, 2, 10, 10153, '2019-11-23'),
(58, 1, 10, 10153, '2019-11-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido`
--

DROP TABLE IF EXISTS `contenido`;
CREATE TABLE IF NOT EXISTS `contenido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuotas`
--

DROP TABLE IF EXISTS `cuotas`;
CREATE TABLE IF NOT EXISTS `cuotas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `num_cuota` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_empresa`
--

DROP TABLE IF EXISTS `datos_empresa`;
CREATE TABLE IF NOT EXISTS `datos_empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `nit` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `ciudad` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `departamento` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `datos_empresa`
--

INSERT INTO `datos_empresa` (`id`, `nombre`, `nit`, `direccion`, `ciudad`, `departamento`, `telefono`, `fecha_inicio`) VALUES
(1, 'NOMBRE EMPRESA', '890454500-2', 'CALLE 11 CENTRO', 'SAHAGUN', 'CORDOBA', '7777777', '2019-11-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

DROP TABLE IF EXISTS `empleado`;
CREATE TABLE IF NOT EXISTS `empleado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sucursal` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `nit` int(11) NOT NULL,
  `telefono` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha_ingreso` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `id_sucursal`, `nombre`, `nit`, `telefono`, `direccion`, `fecha_ingreso`) VALUES
(1, 1, 'carlor macea lopez', 7854545, '7777777', 'calle 4 ', '2017-07-15'),
(2, 1, 'pedro peres', 15047854, '7770000', 'calle 15 N 21 -48', '2014-05-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilista`
--

DROP TABLE IF EXISTS `estilista`;
CREATE TABLE IF NOT EXISTS `estilista` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sucursal` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `nit` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sucursal` (`id_sucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estilista`
--

INSERT INTO `estilista` (`id`, `id_sucursal`, `nombre`, `nit`, `telefono`, `direccion`, `fecha_registro`) VALUES
(1, 1, 'PEDRO PEREZ', '45454545', '777777', 'CALLE 2', '2019-11-04'),
(2, 1, 'CALOR MARIO', '45454545', '777777', 'CALLE 2', '2019-11-04'),
(3, 1, 'JUAN CARLOS', '45454545', '777777', 'CALLE 2', '2019-11-04'),
(4, 2, 'VICTOR DIAZ', '45454545', '777777', 'CALLE 2', '2019-11-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

DROP TABLE IF EXISTS `gastos`;
CREATE TABLE IF NOT EXISTS `gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sucursal` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `detalle` text COLLATE utf8_spanish_ci NOT NULL,
  `valor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sucursal` (`id_sucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id`, `id_sucursal`, `fecha`, `detalle`, `valor`) VALUES
(1, 1, '2019-12-21', 'prueba de registro editado', 7000),
(2, 1, '2019-12-21', 'prueba de registro', 5000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `iniciar_punto_venta`
--

DROP TABLE IF EXISTS `iniciar_punto_venta`;
CREATE TABLE IF NOT EXISTS `iniciar_punto_venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sucursal` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_cierre` date NOT NULL,
  `basecaja` int(11) NOT NULL,
  `totalingresos` int(11) NOT NULL,
  `totalgastos` int(11) NOT NULL,
  `montoentregado` int(11) NOT NULL,
  `diferencia` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `iniciar_punto_venta`
--

INSERT INTO `iniciar_punto_venta` (`id`, `id_sucursal`, `fecha_inicio`, `fecha_cierre`, `basecaja`, `totalingresos`, `totalgastos`, `montoentregado`, `diferencia`, `estado`) VALUES
(1, 1, '2019-11-10', '2019-12-26', 30000, 118640, 12000, 106640, 0, 0),
(2, 1, '2019-12-26', '2019-12-26', 30000, 32960, 0, 32960, 0, 0),
(3, 1, '2019-12-26', '2019-12-26', 30000, 20000, 0, 20000, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

DROP TABLE IF EXISTS `insumos`;
CREATE TABLE IF NOT EXISTS `insumos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `costo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `codigo_vendedor` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`id`, `codigo`, `nombre`, `costo`, `cantidad`, `stock`, `id_vendedor`, `codigo_vendedor`) VALUES
(1, '1', 'pulvo para afeitar', 4500, 10, 2, 1, '5454'),
(2, '2', 'cuchillas en hojas', 150, 200, 50, 1, 'chi1002'),
(3, '3', 'cuchillas en hojas', 150, 200, 50, 1, 'chi1002');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos_sucursal`
--

DROP TABLE IF EXISTS `insumos_sucursal`;
CREATE TABLE IF NOT EXISTS `insumos_sucursal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_insumo` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `stock_minimo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `insumos_sucursal`
--

INSERT INTO `insumos_sucursal` (`id`, `id_insumo`, `id_sucursal`, `cantidad`, `stock_minimo`) VALUES
(1, 2, 1, 88, 50),
(2, 2, 2, 100, 50),
(3, 2, 3, 50, 50),
(4, 2, 9, 50, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intereses`
--

DROP TABLE IF EXISTS `intereses`;
CREATE TABLE IF NOT EXISTS `intereses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `valor` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

DROP TABLE IF EXISTS `parametros`;
CREATE TABLE IF NOT EXISTS `parametros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_inicio_factura` int(11) NOT NULL,
  `generar_codigo` int(11) NOT NULL,
  `codigo_prod` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`id`, `num_inicio_factura`, `generar_codigo`, `codigo_prod`) VALUES
(1, 1, 1, 1000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos_cliente`
--

DROP TABLE IF EXISTS `prestamos_cliente`;
CREATE TABLE IF NOT EXISTS `prestamos_cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `interes` int(11) NOT NULL,
  `fecha_entrega` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `num_cuotas` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `valorcuota` int(11) NOT NULL,
  `valortotal` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `cuota_saldo` int(11) NOT NULL,
  `utilidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `prestamos_cliente_ibfk_1` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `prestamos_cliente`
--

INSERT INTO `prestamos_cliente` (`id`, `id_cliente`, `interes`, `fecha_entrega`, `fecha_vencimiento`, `num_cuotas`, `valor`, `valorcuota`, `valortotal`, `saldo`, `cuota_saldo`, `utilidad`) VALUES
(2, 2, 10, '2019-11-07', '2019-12-22', 45, 500000, 12778, 575000, 536666, 44, 75000),
(3, 1, 10, '2019-11-08', '2020-01-07', 60, 200000, 4000, 240000, 0, 0, 40000),
(4, 4, 5, '2019-11-10', '2020-01-09', 60, 1000000, 18333, 1100000, 1000000, 59, 100000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos_entregados`
--

DROP TABLE IF EXISTS `prestamos_entregados`;
CREATE TABLE IF NOT EXISTS `prestamos_entregados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `prestamos_entregados`
--

INSERT INTO `prestamos_entregados` (`id`, `id_cliente`, `valor`, `fecha`) VALUES
(6, 4, 1000000, '2019-11-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos_entregados_sucursal`
--

DROP TABLE IF EXISTS `prestamos_entregados_sucursal`;
CREATE TABLE IF NOT EXISTS `prestamos_entregados_sucursal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_estilista` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `prestamos_entregados_sucursal`
--

INSERT INTO `prestamos_entregados_sucursal` (`id`, `id_estilista`, `id_sucursal`, `valor`, `fecha`) VALUES
(1, 1, 1, 100000, '2019-12-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo_estilista`
--

DROP TABLE IF EXISTS `prestamo_estilista`;
CREATE TABLE IF NOT EXISTS `prestamo_estilista` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_estilista` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `interes` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `valortotal` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `cuotas` int(11) NOT NULL,
  `saldocuota` int(11) NOT NULL,
  `utilidad` int(11) NOT NULL,
  `valorcuota` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_estilista` (`id_estilista`),
  KEY `id_sucursal` (`id_sucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `prestamo_estilista`
--

INSERT INTO `prestamo_estilista` (`id`, `id_estilista`, `id_sucursal`, `fecha`, `fecha_vencimiento`, `interes`, `valor`, `valortotal`, `saldo`, `cuotas`, `saldocuota`, `utilidad`, `valorcuota`) VALUES
(1, 1, 1, '2019-12-07', '2020-01-06', 15, 100000, 115000, 107334, 30, 28, 30, 3833),
(2, 2, 1, '2019-12-07', '2020-01-06', 10, 150000, 165000, 165000, 30, 30, 15000, 5500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `codigo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `costo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` int(11) NOT NULL,
  `porcentaje_utilidad` int(11) NOT NULL,
  `utilidad` int(11) NOT NULL,
  `stock_minimo` int(11) NOT NULL,
  `codigo_vendedor` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `id_categoria`, `codigo`, `nombre`, `costo`, `cantidad`, `precio_venta`, `porcentaje_utilidad`, `utilidad`, `stock_minimo`, `codigo_vendedor`, `id_vendedor`) VALUES
(1, 1, '1000', 'papas de limon 150g ', 900, 210, 1260, 40, 360, 20, '454545', 1),
(2, 1, '1001', 'gaseosa 250 ml ', 500, 196, 700, 40, 200, 20, '454545', 1),
(6, 1, '1005', 'producto prueba', 500, 11, 750, 50, 250, 5, 'cre1450', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_sucursal`
--

DROP TABLE IF EXISTS `producto_sucursal`;
CREATE TABLE IF NOT EXISTS `producto_sucursal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `stock_minimo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_producto`),
  KEY `id_sucursal` (`id_sucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto_sucursal`
--

INSERT INTO `producto_sucursal` (`id`, `id_producto`, `id_sucursal`, `cantidad`, `stock_minimo`) VALUES
(1, 1, 1, 9, 10),
(2, 2, 1, 23, 5),
(3, 6, 2, 20, 5),
(4, 6, 3, 20, 5),
(5, 6, 9, 30, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE IF NOT EXISTS `proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `nit` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `ciudad` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `departamento` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `nombre`, `nit`, `direccion`, `telefono`, `ciudad`, `departamento`) VALUES
(1, 'distribuidora sahagun', '7801645985', 'carrera 11A #21 - 20', '3007412721', 'sahagun', 'cordoba'),
(5, 'comercializaras del norte ', '7801645985', 'carrera 11A #21 - 20', '3007412721', 'sahagun', 'cordoba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saldo_pendiente`
--

DROP TABLE IF EXISTS `saldo_pendiente`;
CREATE TABLE IF NOT EXISTS `saldo_pendiente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_estilista` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `saldo_pendiente`
--

INSERT INTO `saldo_pendiente` (`id`, `id_estilista`, `id_sucursal`, `valor`, `fecha`) VALUES
(3, 1, 1, -5000, '2019-12-18'),
(4, 3, 1, -2000, '2019-12-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

DROP TABLE IF EXISTS `servicios`;
CREATE TABLE IF NOT EXISTS `servicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `valor` int(11) NOT NULL,
  `img` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `valor`, `img`) VALUES
(1, 'CORTE BASICO', 5000, '1.jpg'),
(2, 'CORTE MEDIO', 7000, '2.jpg'),
(3, 'CORTE EXPERTO', 10000, '3.jpg'),
(4, 'CORTE BASICO 2', 7000, '4.jpg'),
(5, 'CORTE BASICO 3', 6000, '5.jpg'),
(6, 'CORTE BASICO 4', 8000, '6.jpg'),
(7, 'corte de cabello ', 15000, '1575287568descarga.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

DROP TABLE IF EXISTS `sucursal`;
CREATE TABLE IF NOT EXISTS `sucursal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `ciudad` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `departamento` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`id`, `nombre`, `direccion`, `ciudad`, `departamento`, `fecha_inicio`) VALUES
(1, 'sucursal 1', 'calle 11', 'sahagun', 'cordoba', '2019-11-04'),
(2, 'sucursal monteria', 'calle 41', 'sahagun', 'cordoba', '2019-11-15'),
(3, 'sucursal sahagun', 'carrera 11A #21 - 20', 'sahagun', 'cordoba', '2019-11-15'),
(9, 'prueba', 'carrera 11A #21 - 20', 'sahagun', 'cordoba', '2019-11-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traslado_mercancia`
--

DROP TABLE IF EXISTS `traslado_mercancia`;
CREATE TABLE IF NOT EXISTS `traslado_mercancia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sucursal` int(11) NOT NULL,
  `num_registro` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `detalles` text COLLATE utf8_spanish_ci NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sucursal` (`id_sucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `traslado_mercancia`
--

INSERT INTO `traslado_mercancia` (`id`, `id_sucursal`, `num_registro`, `fecha`, `detalles`, `total`) VALUES
(3, 1, 10002, '2019-11-27', '[{\"id\":\"1\",\"codigo\":\"1000\",\"descripcion\":\"papas de limon 150g \",\"cantidad\":\"10\",\"precio\":\"900\"},{\"id\":\"2\",\"codigo\":\"1001\",\"descripcion\":\"gaseosa 250 ml \",\"cantidad\":\"10\",\"precio\":\"500\"}]', 14000),
(4, 1, 10003, '2019-11-28', '[{\"id\":\"1\",\"codigo\":\"1000\",\"descripcion\":\"papas de limon 150g \",\"cantidad\":\"10\",\"precio\":\"900\",\"subtotal\":\"9000\"},{\"id\":\"2\",\"codigo\":\"1001\",\"descripcion\":\"gaseosa 250 ml \",\"cantidad\":\"20\",\"precio\":\"500\",\"subtotal\":\"10000\"},{\"id\":\"6\",\"codigo\":\"1005\",\"descripcion\":\"producto prueba\",\"cantidad\":\"1\",\"precio\":\"500\",\"subtotal\":\"500\"}]', 19500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `password`, `tipo`, `estado`, `fecha_registro`) VALUES
(1, 'leonelbula', '$2y$04$xjnDLNprz/Gy83mw9TEbwuNX6.Y.rYtwCd/7K82l66j.Jr15u3xEW', 'admin', 1, '2019-10-31'),
(2, 'usuario', '$2y$04$xjnDLNprz/Gy83mw9TEbwuNX6.Y.rYtwCd/7K82l66j.Jr15u3xEW', 'usuario', 1, '2019-11-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_ubicacion`
--

DROP TABLE IF EXISTS `usuario_ubicacion`;
CREATE TABLE IF NOT EXISTS `usuario_ubicacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_sucursal` (`id_sucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario_ubicacion`
--

INSERT INTO `usuario_ubicacion` (`id`, `id_usuario`, `id_sucursal`, `estado`) VALUES
(1, 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_producto`
--

DROP TABLE IF EXISTS `venta_producto`;
CREATE TABLE IF NOT EXISTS `venta_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sucursal` int(11) NOT NULL,
  `num_factura` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `detalles` text COLLATE utf8_spanish_ci NOT NULL,
  `utilidad` int(11) NOT NULL,
  `totalventa` int(11) NOT NULL,
  `totalcosto` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sucursal` (`id_sucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `venta_producto`
--

INSERT INTO `venta_producto` (`id`, `id_sucursal`, `num_factura`, `fecha`, `detalles`, `utilidad`, `totalventa`, `totalcosto`, `saldo`, `estado`) VALUES
(3, 2, 1, '2019-11-16', '[{\"id\":\"1\",\"codigo\":\"1000\",\"descripcion\":\"papas de limon 150g \",\"cantidad\":\"4\",\"costo\":\"900\",\"precio\":\"1260\",\"descuento\":\"0\",\"subtotal\":\"5040\"},{\"id\":\"2\",\"codigo\":\"1001\",\"descripcion\":\"gaseosa 250 ml \",\"cantidad\":\"4\",\"costo\":\"500\",\"precio\":\"700\",\"descuento\":\"0\",\"subtotal\":\"2800\"}]', 40000, 80000, 40000, 0, 0),
(4, 2, 3, '2019-11-16', '[{\"id\":\"1\",\"codigo\":\"1000\",\"descripcion\":\"papas de limon 150g \",\"cantidad\":\"4\",\"costo\":\"900\",\"precio\":\"1260\",\"descuento\":\"0\",\"subtotal\":\"5040\"},{\"id\":\"2\",\"codigo\":\"1001\",\"descripcion\":\"gaseosa 250 ml \",\"cantidad\":\"4\",\"costo\":\"500\",\"precio\":\"700\",\"descuento\":\"0\",\"subtotal\":\"2800\"}]', 40000, 80000, 40000, 0, 0),
(5, 3, 1, '2019-11-16', '[{\"id\":\"1\",\"codigo\":\"1000\",\"descripcion\":\"papas de limon 150g \",\"cantidad\":\"4\",\"costo\":\"900\",\"precio\":\"1260\",\"descuento\":\"0\",\"subtotal\":\"5040\"},{\"id\":\"2\",\"codigo\":\"1001\",\"descripcion\":\"gaseosa 250 ml \",\"cantidad\":\"4\",\"costo\":\"500\",\"precio\":\"700\",\"descuento\":\"0\",\"subtotal\":\"2800\"}]', 40000, 80000, 40000, 0, 0),
(6, 3, 2, '2019-11-16', '[{\"id\":\"1\",\"codigo\":\"1000\",\"descripcion\":\"papas de limon 150g \",\"cantidad\":\"4\",\"costo\":\"900\",\"precio\":\"1260\",\"descuento\":\"0\",\"subtotal\":\"5040\"},{\"id\":\"2\",\"codigo\":\"1001\",\"descripcion\":\"gaseosa 250 ml \",\"cantidad\":\"4\",\"costo\":\"500\",\"precio\":\"700\",\"descuento\":\"0\",\"subtotal\":\"2800\"}]', 40000, 80000, 40000, 0, 0),
(7, 1, 3, '2019-11-17', '[{\"id\":\"1\",\"codigo\":\"1000\",\"descripcion\":\"papas de limon 150g \",\"cantidad\":\"4\",\"costo\":\"900\",\"precio\":\"1260\",\"descuento\":\"0\",\"subtotal\":\"5040\"},{\"id\":\"2\",\"codigo\":\"1001\",\"descripcion\":\"gaseosa 250 ml \",\"cantidad\":\"4\",\"costo\":\"500\",\"precio\":\"700\",\"descuento\":\"0\",\"subtotal\":\"2800\"}]', 40000, 80000, 40000, 0, 0),
(8, 1, 4, '2019-12-06', '[{\"id\":\"1\",\"codigo\":\"1000\",\"descripcion\":\"papas de limon 150g \",\"cantidad\":\"4\",\"costo\":\"900\",\"precio\":\"1260\",\"descuento\":\"0\",\"subtotal\":\"5040\"},{\"id\":\"2\",\"codigo\":\"1001\",\"descripcion\":\"gaseosa 250 ml \",\"cantidad\":\"4\",\"costo\":\"500\",\"precio\":\"700\",\"descuento\":\"0\",\"subtotal\":\"2800\"}]', 2240, 7840, 5600, 0, 0),
(9, 1, 5, '2019-12-26', '[{\"id\":\"1\",\"codigo\":\"1000\",\"descripcion\":\"papas de limon 150g \",\"cantidad\":\"3\",\"costo\":\"900\",\"precio\":\"1300\",\"descuento\":\"0\",\"subtotal\":\"3900\"},{\"id\":\"2\",\"codigo\":\"1001\",\"descripcion\":\"gaseosa 250 ml \",\"cantidad\":\"2\",\"costo\":\"500\",\"precio\":\"700\",\"descuento\":\"0\",\"subtotal\":\"1400\"}]', 1600, 5300, 3700, 0, 0),
(10, 1, 6, '2019-12-26', '[{\"id\":\"2\",\"codigo\":\"1001\",\"descripcion\":\"gaseosa 250 ml \",\"cantidad\":\"1\",\"costo\":\"500\",\"precio\":\"700\",\"descuento\":\"0\",\"subtotal\":\"700\"}]', 200, 700, 500, 0, 0),
(11, 1, 7, '2019-12-26', '[{\"id\":\"1\",\"codigo\":\"1000\",\"descripcion\":\"papas de limon 150g \",\"cantidad\":\"1\",\"costo\":\"900\",\"precio\":\"1260\",\"descuento\":\"0\",\"subtotal\":\"1260\"},{\"id\":\"2\",\"codigo\":\"1001\",\"descripcion\":\"gaseosa 250 ml \",\"cantidad\":\"1\",\"costo\":\"500\",\"precio\":\"700\",\"descuento\":\"0\",\"subtotal\":\"700\"}]', 560, 1960, 1400, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_servicio`
--

DROP TABLE IF EXISTS `venta_servicio`;
CREATE TABLE IF NOT EXISTS `venta_servicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sucursal` int(11) NOT NULL,
  `num_venta` int(11) NOT NULL,
  `detalle` text COLLATE utf8_spanish_ci NOT NULL,
  `id_estilista` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `valor` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `valorinterno` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sucursal` (`id_sucursal`),
  KEY `id_estilista` (`id_estilista`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `venta_servicio`
--

INSERT INTO `venta_servicio` (`id`, `id_sucursal`, `num_venta`, `detalle`, `id_estilista`, `fecha`, `valor`, `saldo`, `valorinterno`, `estado`) VALUES
(1, 1, 1, 'venta', 1, '2019-11-16', 5000, 0, 2500, 0),
(2, 1, 2, 'venta', 1, '2019-11-16', 5000, 0, 2500, 0),
(3, 1, 3, '[{\"id\":\"5\",\"codigo\":\"5\",\"descripcion\":\"CORTE BASICO 3\",\"cantidad\":\"1\",\"precio\":\"6000\",\"descuento\":\"0\",\"subtotal\":\"6000\"}]', 3, '2019-11-30', 6000, 0, 3000, 0),
(4, 1, 4, '[{\"id\":\"6\",\"codigo\":\"6\",\"descripcion\":\"CORTE BASICO 4\",\"cantidad\":\"1\",\"precio\":\"8000\",\"descuento\":\"0\",\"subtotal\":\"8000\"}]', 2, '2019-12-04', 8000, 0, 4000, 0),
(5, 1, 5, '[{\"id\":\"6\",\"codigo\":\"6\",\"descripcion\":\"CORTE BASICO 4\",\"cantidad\":\"1\",\"precio\":\"8000\",\"descuento\":\"0\",\"subtotal\":\"8000\"}]', 2, '2019-12-04', 8000, 0, 4000, 0),
(6, 1, 6, '[{\"id\":\"1\",\"codigo\":\"1\",\"descripcion\":\"CORTE BASICO\",\"cantidad\":\"1\",\"precio\":\"5000\",\"descuento\":\"0\",\"subtotal\":\"5000\"}]', 1, '2019-12-04', 5000, 0, 2500, 0),
(7, 1, 7, '[{\"id\":\"3\",\"codigo\":\"3\",\"descripcion\":\"CORTE EXPERTO\",\"cantidad\":\"1\",\"precio\":\"10000\",\"descuento\":\"0\",\"subtotal\":\"10000\"}]', 2, '2019-12-26', 10000, 0, 10000, 0),
(8, 1, 8, '[{\"id\":\"1\",\"codigo\":\"1\",\"descripcion\":\"CORTE BASICO\",\"cantidad\":\"1\",\"precio\":\"5000\",\"descuento\":\"0\",\"subtotal\":\"5000\"}]', 3, '2019-12-26', 5000, 5000, 2500, 0),
(9, 1, 9, '[{\"id\":\"1\",\"codigo\":\"1\",\"descripcion\":\"CORTE BASICO\",\"cantidad\":\"1\",\"precio\":\"5000\",\"descuento\":\"0\",\"subtotal\":\"5000\"},{\"id\":\"6\",\"codigo\":\"6\",\"descripcion\":\"CORTE BASICO 4\",\"cantidad\":\"1\",\"precio\":\"8000\",\"descuento\":\"0\",\"subtotal\":\"8000\"}]', 3, '2019-12-26', 13000, 0, 6500, 0),
(10, 1, 10, '[{\"id\":\"3\",\"codigo\":\"3\",\"descripcion\":\"CORTE EXPERTO\",\"cantidad\":\"1\",\"precio\":\"10000\",\"descuento\":\"0\",\"subtotal\":\"10000\"}]', 3, '2019-12-26', 10000, 0, 5000, 0);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `abono_cliente`
--
ALTER TABLE `abono_cliente`
  ADD CONSTRAINT `abono_cliente_ibfk_1` FOREIGN KEY (`id_cliente_p`) REFERENCES `cliente_prestamo` (`id`),
  ADD CONSTRAINT `abono_cliente_ibfk_2` FOREIGN KEY (`id_prestamo`) REFERENCES `prestamos_cliente` (`id`);

--
-- Filtros para la tabla `abono_compra`
--
ALTER TABLE `abono_compra`
  ADD CONSTRAINT `abono_compra_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `compra` (`id`);

--
-- Filtros para la tabla `abono_prestamos_estilista`
--
ALTER TABLE `abono_prestamos_estilista`
  ADD CONSTRAINT `abono_prestamos_estilista_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursal` (`id`),
  ADD CONSTRAINT `abono_prestamos_estilista_ibfk_2` FOREIGN KEY (`id_estilista`) REFERENCES `estilista` (`id`);

--
-- Filtros para la tabla `avances`
--
ALTER TABLE `avances`
  ADD CONSTRAINT `avances_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursal` (`id`),
  ADD CONSTRAINT `avances_ibfk_2` FOREIGN KEY (`id_estilista`) REFERENCES `estilista` (`id`);

--
-- Filtros para la tabla `cierre_caja`
--
ALTER TABLE `cierre_caja`
  ADD CONSTRAINT `cierre_caja_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursal` (`id`);

--
-- Filtros para la tabla `componentes_servicio`
--
ALTER TABLE `componentes_servicio`
  ADD CONSTRAINT `componentes_servicio_ibfk_1` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id`);

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id`);

--
-- Filtros para la tabla `estilista`
--
ALTER TABLE `estilista`
  ADD CONSTRAINT `estilista_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursal` (`id`);

--
-- Filtros para la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD CONSTRAINT `gastos_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursal` (`id`);

--
-- Filtros para la tabla `prestamos_cliente`
--
ALTER TABLE `prestamos_cliente`
  ADD CONSTRAINT `prestamos_cliente_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente_prestamo` (`id`);

--
-- Filtros para la tabla `prestamo_estilista`
--
ALTER TABLE `prestamo_estilista`
  ADD CONSTRAINT `prestamo_estilista_ibfk_1` FOREIGN KEY (`id_estilista`) REFERENCES `estilista` (`id`),
  ADD CONSTRAINT `prestamo_estilista_ibfk_2` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursal` (`id`);

--
-- Filtros para la tabla `producto_sucursal`
--
ALTER TABLE `producto_sucursal`
  ADD CONSTRAINT `producto_sucursal_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `producto_sucursal_ibfk_2` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursal` (`id`);

--
-- Filtros para la tabla `traslado_mercancia`
--
ALTER TABLE `traslado_mercancia`
  ADD CONSTRAINT `traslado_mercancia_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursal` (`id`);

--
-- Filtros para la tabla `usuario_ubicacion`
--
ALTER TABLE `usuario_ubicacion`
  ADD CONSTRAINT `usuario_ubicacion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `usuario_ubicacion_ibfk_2` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursal` (`id`);

--
-- Filtros para la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD CONSTRAINT `venta_producto_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursal` (`id`);

--
-- Filtros para la tabla `venta_servicio`
--
ALTER TABLE `venta_servicio`
  ADD CONSTRAINT `venta_servicio_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursal` (`id`),
  ADD CONSTRAINT `venta_servicio_ibfk_2` FOREIGN KEY (`id_estilista`) REFERENCES `estilista` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
