-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 09-11-2019 a las 12:46:09
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `abono_cliente`
--

INSERT INTO `abono_cliente` (`id`, `id_prestamo`, `id_cliente_p`, `fecha`, `valor`) VALUES
(6, 2, 2, '2019-11-09', 12778);

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
-- Estructura de tabla para la tabla `abono_prestamos_estilista`
--

DROP TABLE IF EXISTS `abono_prestamos_estilista`;
CREATE TABLE IF NOT EXISTS `abono_prestamos_estilista` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sucursal` int(11) NOT NULL,
  `id_estilista` int(11) NOT NULL,
  `fecha` int(11) NOT NULL,
  `descripcion` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sucursal` (`id_sucursal`),
  KEY `id_estilista` (`id_estilista`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
  `fecha` int(11) NOT NULL,
  `detalle` text COLLATE utf8_spanish_ci NOT NULL,
  `valor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sucursal` (`id_sucursal`),
  KEY `id_estilista` (`id_estilista`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_producto`
--

DROP TABLE IF EXISTS `categoria_producto`;
CREATE TABLE IF NOT EXISTS `categoria_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
(3, 'MARIA DEL CARMEN BUSTAMENTE LOPEZ', '45454545', 'calle 8 centro', 'SAHAGUN', '7877772');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `componetes_servicio`
--

DROP TABLE IF EXISTS `componetes_servicio`;
CREATE TABLE IF NOT EXISTS `componetes_servicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_servicio` int(11) NOT NULL,
  `detalle` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_servicio` (`id_servicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
  `fecha_compra` int(11) NOT NULL,
  `fecha_vencimiento` int(11) NOT NULL,
  `detalles` text COLLATE utf8_spanish_ci NOT NULL,
  `subtotal` int(11) NOT NULL,
  `iva` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_proveedor` (`id_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
(4, 1, 'VICTOR DIAZ', '45454545', '777777', 'CALLE 2', '2019-11-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

DROP TABLE IF EXISTS `gastos`;
CREATE TABLE IF NOT EXISTS `gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gastos` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `detalle` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `prestamos_cliente`
--

INSERT INTO `prestamos_cliente` (`id`, `id_cliente`, `interes`, `fecha_entrega`, `fecha_vencimiento`, `num_cuotas`, `valor`, `valorcuota`, `valortotal`, `saldo`, `cuota_saldo`, `utilidad`) VALUES
(2, 2, 10, '2019-11-07', '2019-12-22', 45, 500000, 12778, 575000, 562222, 44, 75000),
(3, 1, 10, '2019-11-08', '2020-01-07', 60, 200000, 4000, 240000, 240000, 59, 40000);

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo_estilista`
--

DROP TABLE IF EXISTS `prestamo_estilista`;
CREATE TABLE IF NOT EXISTS `prestamo_estilista` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_estilista` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `fecha` int(11) NOT NULL,
  `descripcion` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `plazo` int(11) NOT NULL,
  `cuotas` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_estilista` (`id_estilista`),
  KEY `id_sucursal` (`id_sucursal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `costo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` int(11) NOT NULL,
  `porcentaje_utilidad` int(11) NOT NULL,
  `utilidad` int(11) NOT NULL,
  `stock_minimo` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_sucursal`
--

DROP TABLE IF EXISTS `producto_sucursal`;
CREATE TABLE IF NOT EXISTS `producto_sucursal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `costo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` int(11) NOT NULL,
  `porcentaje_utilidad` int(11) NOT NULL,
  `utilidad` int(11) NOT NULL,
  `stock_minimo` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_sucursal` (`id_sucursal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
  `fecha_registro` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `valor`, `img`) VALUES
(1, 'CORTE BASICO', 5000, '1.jpg'),
(2, 'CORTE MEDIO', 7000, '2.jpg'),
(3, 'CORTE EXPERTO', 10000, '3.jpg'),
(4, 'CORTE BASICO 2', 7000, '4.jpg'),
(5, 'CORTE BASICO 3', 6000, '5.jpg'),
(6, 'CORTE BASICO 4', 8000, '6.jpg');

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
  `dias_atencion` text COLLATE utf8_spanish_ci NOT NULL,
  `hora_atencion` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`id`, `nombre`, `direccion`, `ciudad`, `departamento`, `dias_atencion`, `hora_atencion`, `fecha_inicio`) VALUES
(1, 'sucuarsal 1', 'calle 11', 'sahagun', 'cordoba', 'lunes a sabado', '7', '2019-11-04');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
-- Estructura de tabla para la tabla `vanta_servicio`
--

DROP TABLE IF EXISTS `vanta_servicio`;
CREATE TABLE IF NOT EXISTS `vanta_servicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sucursal` int(11) NOT NULL,
  `num_venta` int(11) NOT NULL,
  `detalle` text COLLATE utf8_spanish_ci NOT NULL,
  `id_estilista` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `valor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sucursal` (`id_sucursal`),
  KEY `id_estilista` (`id_estilista`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_producto`
--

DROP TABLE IF EXISTS `venta_producto`;
CREATE TABLE IF NOT EXISTS `venta_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sucursal` int(11) NOT NULL,
  `num_factura` int(11) NOT NULL,
  `fecha` int(11) NOT NULL,
  `detalles` int(11) NOT NULL,
  `utilidad` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `totalventa` int(11) NOT NULL,
  `totalcosto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sucursal` (`id_sucursal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
-- Filtros para la tabla `componetes_servicio`
--
ALTER TABLE `componetes_servicio`
  ADD CONSTRAINT `componetes_servicio_ibfk_1` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id`);

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
  ADD CONSTRAINT `producto_sucursal_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_producto` (`id`),
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
-- Filtros para la tabla `vanta_servicio`
--
ALTER TABLE `vanta_servicio`
  ADD CONSTRAINT `vanta_servicio_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursal` (`id`),
  ADD CONSTRAINT `vanta_servicio_ibfk_2` FOREIGN KEY (`id_estilista`) REFERENCES `estilista` (`id`);

--
-- Filtros para la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD CONSTRAINT `venta_producto_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursal` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
