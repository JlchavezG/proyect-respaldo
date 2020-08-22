-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 22-08-2020 a las 03:18:36
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Proyect`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Asignaciones`
--

CREATE TABLE `Asignaciones` (
  `Id_asignacion` int(11) NOT NULL,
  `Id_Laptop` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Numero` varchar(255) NOT NULL,
  `User_Reg` varchar(255) NOT NULL,
  `Id_Estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Asignaciones`
--

INSERT INTO `Asignaciones` (`Id_asignacion`, `Id_Laptop`, `Id_Usuario`, `Fecha`, `Numero`, `User_Reg`, `Id_Estado`) VALUES
(10, 9, 24, '2020-08-20', 'GgHqTocQYz', 'JlchavezG', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Estado`
--

CREATE TABLE `Estado` (
  `id_Estado` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Estado`
--

INSERT INTO `Estado` (`id_Estado`, `Nombre`) VALUES
(1, 'Operación'),
(2, 'Reparación'),
(3, 'Detenida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Estatus`
--

CREATE TABLE `Estatus` (
  `Id_estatus` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Codigo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Estatus`
--

INSERT INTO `Estatus` (`Id_estatus`, `Nombre`, `Codigo`) VALUES
(1, 'Asignada', 'AS0001'),
(2, 'No asignada', 'AS0002');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Laptop`
--

CREATE TABLE `Laptop` (
  `Id_laptop` int(11) NOT NULL,
  `Modelo` varchar(255) NOT NULL,
  `Id_marca` int(11) NOT NULL,
  `Nserie` varchar(255) NOT NULL,
  `NKey` varchar(255) NOT NULL,
  `Reset` varchar(255) NOT NULL,
  `Fecha` date NOT NULL,
  `RegAuto` varchar(255) NOT NULL,
  `Estatus` int(11) NOT NULL,
  `Identificador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Laptop`
--

INSERT INTO `Laptop` (`Id_laptop`, `Modelo`, `Id_marca`, `Nserie`, `NKey`, `Reset`, `Fecha`, `RegAuto`, `Estatus`, `Identificador`) VALUES
(7, 'Macbook Pro 15', 6, 'W8005B0666E', 'HG-009701', 'ADM001', '2020-08-11', 'YGRQkc#POb', 1, 1),
(9, 'Imac Pro 27', 6, 'W0067345-98', 'RTYULKMÑ', 'rE990986', '2020-08-20', 'JhzQpeiGw2', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Marcas`
--

CREATE TABLE `Marcas` (
  `Id_Marca` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Codigo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Marcas`
--

INSERT INTO `Marcas` (`Id_Marca`, `Nombre`, `Codigo`) VALUES
(1, 'Lenovo', 'Len001'),
(2, 'AZUS', 'As001'),
(3, 'Dell', 'Dell001'),
(4, 'HP', 'HP001'),
(5, 'Acer', 'Acer001'),
(6, 'Apple', 'Apple001'),
(7, 'Razer', 'Raze001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Niveles`
--

CREATE TABLE `Niveles` (
  `Id_Nivel` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Niveles`
--

INSERT INTO `Niveles` (`Id_Nivel`, `Nombre`) VALUES
(1, 'Sistemas'),
(2, 'Administracion'),
(3, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `Id_notificacion` int(11) NOT NULL,
  `Titulo` varchar(255) NOT NULL,
  `Mensaje` varchar(300) NOT NULL,
  `Estado` int(11) NOT NULL,
  `Usuario` varchar(55) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`Id_notificacion`, `Titulo`, `Mensaje`, `Estado`, `Usuario`, `Fecha`) VALUES
(8, 'Noticia', 'Hoy salen temprano', 0, 'Naye', '2020-08-11'),
(9, 'Cambio codigo', 'Se realizaron cambios en el codigo, se aumentaron modulos', 0, 'JlchavezG', '2020-08-19'),
(10, 'Revisión', 'Estamos revisando el codigo', 0, 'JlchavezG', '2020-08-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `Usuarios` (
  `Id_Usuario` int(11) NOT NULL,
  `Nombre` varchar(55) NOT NULL,
  `ApellidoP` varchar(55) NOT NULL,
  `ApellidoM` varchar(55) NOT NULL,
  `Id_Nivel` int(11) NOT NULL,
  `Telefono` varchar(355) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Usuario` varchar(55) NOT NULL,
  `Password` varchar(55) NOT NULL,
  `Imagen` varchar(255) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`Id_Usuario`, `Nombre`, `ApellidoP`, `ApellidoM`, `Id_Nivel`, `Telefono`, `Email`, `Usuario`, `Password`, `Imagen`, `Fecha`) VALUES
(1, 'Jose Luis', 'Chavez', 'Gomez', 1, '5611099054', 'luis.chavez@gatech.mx', 'JlchavezG', '827ccb0eea8a706c4c34a16891f84e7b', 'firma.png', '2020-07-08'),
(24, 'Nayeli', 'Cruz', 'Calva', 2, '56789095', 'nayeli5@gmail.com', 'Naye', '827ccb0eea8a706c4c34a16891f84e7b', 'uvmnuevamenete.jpg', '2020-08-05');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Asignaciones`
--
ALTER TABLE `Asignaciones`
  ADD PRIMARY KEY (`Id_asignacion`),
  ADD KEY `Id_Laptop` (`Id_Laptop`),
  ADD KEY `Id_Usuario` (`Id_Usuario`),
  ADD KEY `Id_Estado` (`Id_Estado`);

--
-- Indices de la tabla `Estado`
--
ALTER TABLE `Estado`
  ADD PRIMARY KEY (`id_Estado`);

--
-- Indices de la tabla `Estatus`
--
ALTER TABLE `Estatus`
  ADD PRIMARY KEY (`Id_estatus`);

--
-- Indices de la tabla `Laptop`
--
ALTER TABLE `Laptop`
  ADD PRIMARY KEY (`Id_laptop`),
  ADD KEY `Id_marca` (`Id_marca`),
  ADD KEY `Estatus` (`Estatus`),
  ADD KEY `Identificador` (`Identificador`);

--
-- Indices de la tabla `Marcas`
--
ALTER TABLE `Marcas`
  ADD PRIMARY KEY (`Id_Marca`);

--
-- Indices de la tabla `Niveles`
--
ALTER TABLE `Niveles`
  ADD PRIMARY KEY (`Id_Nivel`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`Id_notificacion`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`Id_Usuario`),
  ADD KEY `Id_Nivel` (`Id_Nivel`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Asignaciones`
--
ALTER TABLE `Asignaciones`
  MODIFY `Id_asignacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `Estado`
--
ALTER TABLE `Estado`
  MODIFY `id_Estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Estatus`
--
ALTER TABLE `Estatus`
  MODIFY `Id_estatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `Laptop`
--
ALTER TABLE `Laptop`
  MODIFY `Id_laptop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `Marcas`
--
ALTER TABLE `Marcas`
  MODIFY `Id_Marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `Niveles`
--
ALTER TABLE `Niveles`
  MODIFY `Id_Nivel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `Id_notificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `Id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Asignaciones`
--
ALTER TABLE `Asignaciones`
  ADD CONSTRAINT `asignaciones_ibfk_1` FOREIGN KEY (`Id_Laptop`) REFERENCES `Laptop` (`Id_laptop`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asignaciones_ibfk_2` FOREIGN KEY (`Id_Usuario`) REFERENCES `Usuarios` (`Id_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Laptop`
--
ALTER TABLE `Laptop`
  ADD CONSTRAINT `laptop_ibfk_1` FOREIGN KEY (`Id_marca`) REFERENCES `Marcas` (`Id_Marca`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Id_Nivel`) REFERENCES `Niveles` (`Id_Nivel`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
