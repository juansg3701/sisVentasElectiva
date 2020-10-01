-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-10-2020 a las 19:03:34
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `electiva`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`, `descripcion`) VALUES
(4, 'Frutas', '---'),
(5, 'Verduras', ''),
(6, 'Helados', ''),
(7, 'Bebidas', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `documento` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `direccion`, `telefono`, `correo`, `documento`) VALUES
(8, 'Juan Jose', 'calle 12', '312456312', 'juan@gmail.com', '1026732432'),
(9, 'juliana', 'calle 15', '1234', 'juliana@gmail.com', '1234432'),
(11, 'karem', 'calle 12', '312', 'karem@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `id_detallef` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` double NOT NULL,
  `factura_id_factura` int(11) NOT NULL,
  `producto_id_producto` int(11) NOT NULL,
  `total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_factura`
--

INSERT INTO `detalle_factura` (`id_detallef`, `cantidad`, `precio_venta`, `factura_id_factura`, `producto_id_producto`, `total`) VALUES
(170, 1, 1000000, 213, 18, 1000000),
(171, 1, 12000, 214, 19, 12000),
(172, 1, 1000000, 215, 18, 1000000),
(173, 1, 1000000, 216, 18, 1000000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `pago_total` double NOT NULL,
  `noproductos` int(11) NOT NULL,
  `tipo_pago_id_tpago` int(11) NOT NULL,
  `cliente_id_cliente` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `tiendaodomicilio` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `facturaPaga` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_factura`, `pago_total`, `noproductos`, `tipo_pago_id_tpago`, `cliente_id_cliente`, `fecha`, `tiendaodomicilio`, `facturaPaga`) VALUES
(212, 0, 0, 2, 9, '2020-10-01 01:25:00', '0', 1),
(213, 1000000, 1, 1, 9, '2020-02-01 14:22:00', '0', 1),
(214, 12000, 1, 1, 9, '2020-10-01 02:03:00', '0', 1),
(215, 1000000, 1, 1, 11, '2020-10-01 11:12:00', '0', 1),
(216, 1000000, 1, 1, 11, '2020-10-01 11:44:00', '0', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `plu` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `ean` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `unidad_de_medida` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `precio` double NOT NULL,
  `stock_minimo` double NOT NULL,
  `categoria_id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `plu`, `ean`, `nombre`, `unidad_de_medida`, `precio`, `stock_minimo`, `categoria_id_categoria`) VALUES
(10, '123', '123456', 'Helado casero', 'copas', 1000000, 12, 4),
(11, '1234', '987', 'banana split', 'copas', 12000, 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `producto_id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `disponibilidad` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`id_stock`, `producto_id_producto`, `cantidad`, `disponibilidad`) VALUES
(18, 10, 42, '1'),
(19, 11, 3, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `id_tpago` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_pago`
--

INSERT INTO `tipo_pago` (`id_tpago`, `nombre`, `descripcion`) VALUES
(1, 'Efectivo', 'pago efectivo'),
(2, 'Datafono', 'pago electrÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â Ã'),
(3, 'Pasarela de pago', 'pasarale de pago'),
(4, 'Pago a cuotas', 'cartera');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`id_detallef`),
  ADD KEY `detalle_factura_factura_fk` (`factura_id_factura`),
  ADD KEY `detalle_factura_producto_fk` (`producto_id_producto`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `factura_cliente_fk` (`cliente_id_cliente`),
  ADD KEY `factura_tipo_pago_fk` (`tipo_pago_id_tpago`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `producto_categoria_fk` (`categoria_id_categoria`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`),
  ADD KEY `stock_producto_fk` (`producto_id_producto`);

--
-- Indices de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`id_tpago`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id_detallef` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  MODIFY `id_tpago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `detalle_factura_ibfk_1` FOREIGN KEY (`factura_id_factura`) REFERENCES `factura` (`id_factura`),
  ADD CONSTRAINT `detalle_factura_ibfk_2` FOREIGN KEY (`producto_id_producto`) REFERENCES `stock` (`id_stock`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`tipo_pago_id_tpago`) REFERENCES `tipo_pago` (`id_tpago`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`cliente_id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoria_id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Filtros para la tabla `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`producto_id_producto`) REFERENCES `producto` (`id_producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
