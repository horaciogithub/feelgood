-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-04-2018 a las 03:45:19
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `feelgood`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `email` varchar(40) NOT NULL,
  `sexo` enum('hombre','mujer') DEFAULT NULL,
  `edad` int(2) NOT NULL,
  `estatura` decimal(3,2) NOT NULL,
  `peso` decimal(6,3) NOT NULL,
  `id_dieta` int(3) DEFAULT NULL,
  `id_tabla` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`email`, `sexo`, `edad`, `estatura`, `peso`, `id_dieta`, `id_tabla`) VALUES
('bullock@gmail.com', 'mujer', 40, '1.62', '70.000', 1, 1),
('horacioram94@gmail.com', 'hombre', 30, '1.82', '76.000', NULL, NULL),
('juana@gmail.com', 'mujer', 72, '1.60', '60.000', 1, 1),
('smoothCriminal@gmail.com', 'hombre', 56, '1.96', '56.000', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comenta`
--

CREATE TABLE `comenta` (
  `email` varchar(40) NOT NULL,
  `id_hilo` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comenta`
--

INSERT INTO `comenta` (`email`, `id_hilo`) VALUES
('bullock@gmail.com', 3),
('bullock@gmail.com', 5),
('smoothCriminal@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicio`
--

CREATE TABLE `ejercicio` (
  `id_tabla` int(3) NOT NULL,
  `id_ejercicio` int(2) NOT NULL,
  `nombre_ejercicio` varchar(25) DEFAULT NULL,
  `n_series` int(1) NOT NULL,
  `n_repeticiones` int(2) NOT NULL,
  `t_descanso` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ejercicio`
--

INSERT INTO `ejercicio` (`id_tabla`, `id_ejercicio`, `nombre_ejercicio`, `n_series`, `n_repeticiones`, `t_descanso`) VALUES
(1, 1, 'Sentadillas', 3, 15, '00:01:00'),
(1, 2, 'Hombro', 3, 15, '00:01:15'),
(1, 3, 'Press-banca', 3, 15, '00:01:00'),
(1, 4, 'Dorsal', 3, 15, '00:01:00'),
(1, 5, 'Trapecio', 3, 15, '00:01:00'),
(1, 6, 'Tríceps', 3, 15, '00:01:00'),
(1, 7, 'Antebrazo', 3, 15, '00:01:00'),
(1, 8, 'Zancadas', 3, 15, '00:01:00'),
(1, 9, 'Press Francés', 3, 15, '00:01:00'),
(2, 10, 'Press-banca', 4, 12, '00:01:00'),
(2, 11, 'Dorsal', 4, 12, '00:01:00'),
(2, 12, 'Trapecio', 4, 12, '00:01:00'),
(2, 13, 'Tríceps', 4, 12, '00:01:00'),
(2, 14, 'Antebrazo', 4, 10, '00:01:00'),
(2, 15, 'Zancadas', 4, 10, '00:01:00'),
(2, 16, 'Press Francés', 4, 10, '00:01:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenador`
--

CREATE TABLE `entrenador` (
  `id_entrenador` int(2) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `entrenador`
--

INSERT INTO `entrenador` (`id_entrenador`, `email`) VALUES
(2, 'luisa@hotmail.com'),
(3, 'erojasan@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hilo_foro`
--

CREATE TABLE `hilo_foro` (
  `id_hilo` int(2) NOT NULL,
  `autor_hilo` varchar(20) NOT NULL,
  `asunto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `hilo_foro`
--

INSERT INTO `hilo_foro` (`id_hilo`, `autor_hilo`, `asunto`) VALUES
(1, 'Michael Jackson', 'Buenos d&iacute;as, tengo una duda con respecto a las nueves. &iquest;Es cierto de que son una buena fuente de omega3?\r\n'),
(3, 'Sandra Bullock', 'Alguien podr&iacute;a recomendarme un fisioterapeuta por la zona de  Mesa y L&oacute;pez. Resulta que me he hecho un esguince en el tobillo y necesito recuperarme pronto de la lesi&oacute;n. Gracias.'),
(5, 'Sandra Bullock', 'De acuerdo Estefan&iacute;a Rojas. ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id_hilo` int(2) NOT NULL,
  `id_mensaje` int(3) NOT NULL,
  `hora_mensaje` time NOT NULL,
  `fecha_mensaje` date NOT NULL,
  `contenido` text NOT NULL,
  `autor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nutricionista`
--

CREATE TABLE `nutricionista` (
  `id_nutricionista` int(2) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nutricionista`
--

INSERT INTO `nutricionista` (`id_nutricionista`, `email`) VALUES
(1, 'saulodietas@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `id_dieta` int(3) NOT NULL,
  `id_plato` varchar(2) NOT NULL,
  `nombre_plato` varchar(40) NOT NULL,
  `cant_proteinas` decimal(6,3) NOT NULL,
  `cant_carbohidratos` decimal(6,3) NOT NULL,
  `calorias` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `platos`
--

INSERT INTO `platos` (`id_dieta`, `id_plato`, `nombre_plato`, `cant_proteinas`, `cant_carbohidratos`, `calorias`) VALUES
(1, '1', 'Pescado a la plancha con patatas', '0.200', '0.050', 500),
(1, '2', 'Pez espada con ensalada variada', '0.200', '0.020', 200),
(1, '3', 'Conejo con verduras al horno', '0.150', '0.100', 300),
(2, '4', 'Ternera con patatas', '0.300', '0.350', 500),
(2, '5', 'Pollo rebozado con ensalada', '0.350', '0.250', 400),
(2, '6', 'Hamburguesas de ternera', '0.300', '0.350', 500),
(2, '7', 'Filetes de atún con patatas', '0.300', '0.350', 500),
(2, '8', 'Pechugas de pavo al horno', '0.300', '0.350', 500),
(2, '9', 'Solomillo con puré de patatas', '0.300', '0.350', 500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_dieta`
--

CREATE TABLE `tabla_dieta` (
  `id_dieta` int(3) NOT NULL,
  `id_nutricionista` int(2) DEFAULT NULL,
  `tipo_dieta` enum('hipercalorica','hipocalorica') NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tabla_dieta`
--

INSERT INTO `tabla_dieta` (`id_dieta`, `id_nutricionista`, `tipo_dieta`, `fecha_inicio`, `fecha_fin`) VALUES
(1, NULL, 'hipocalorica', '2018-05-25', '2018-06-25'),
(2, NULL, 'hipercalorica', '2018-05-25', '2018-06-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_ejercicio`
--

CREATE TABLE `tabla_ejercicio` (
  `id_tabla` int(3) NOT NULL,
  `id_entrenador` int(2) DEFAULT NULL,
  `tipo_ejercicio` enum('aerobico','anaerobico') NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `min_ejercicio` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tabla_ejercicio`
--

INSERT INTO `tabla_ejercicio` (`id_tabla`, `id_entrenador`, `tipo_ejercicio`, `fecha_inicio`, `fecha_fin`, `min_ejercicio`) VALUES
(1, NULL, 'aerobico', '2018-05-25', '2018-06-25', '00:45:00'),
(2, 2, 'anaerobico', '2018-05-27', '2018-06-27', '00:40:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_registrado`
--

CREATE TABLE `usuario_registrado` (
  `email` varchar(40) NOT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(70) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `tipo` varchar(14) NOT NULL DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario_registrado`
--

INSERT INTO `usuario_registrado` (`email`, `contrasena`, `nombre`, `apellidos`, `fecha_nacimiento`, `tipo`) VALUES
('bullock@gmail.com', '$2y$10$7o.W5tngOYFDBI78UlhCHOtDSpYXwv4xbx1NKTnH1JsIya5AvE67.', 'Sandra', 'Bullock', '1977-01-12', 'cliente'),
('erojasan@gmail.com', '$2y$10$7sKVaIgbJRlpGIIZgAjYTeGeVW6pZmcemA2y20G9enVzyGhoS1XDK', 'EstefanÃƒÂ­a', 'Rojas', '1990-05-17', 'entrenador'),
('horacioram94@gmail.com', '$2y$10$ZrBjxoKnxoPOtDn0YKFko.aGbP4v/fRxiSl5ZtvIrcVUyNsBk3X5u', 'Horacio', 'RamÃƒÂ­rez', '1987-11-22', 'cliente'),
('juana@gmail.com', '$2y$10$s8YAkIOgXO3D1a.JPancNOHqSnZUfetqU4OqGQ7wudtqttcPWSlfC', 'Juana', 'EstupiÃƒÂ±ÃƒÂ¡n', '1945-09-26', 'cliente'),
('luisa@hotmail.com', '$2y$10$1Y1pK0YrjUOSlmbuHXZM1.KF7yz//IlrgXnK118XpWjNEndsiDsdC', 'Luisa', 'RamÃƒÂ­rez', '1982-05-10', 'entrenador'),
('obed@gmail.com', '$2y$10$ev.xVeY7P0VdQTmZh6ikqOBq3slsLI/WJzcAeRxyBNWaIyrDwMwAW', 'Obed', 'Guerras', '1986-06-05', 'cliente'),
('saulodietas@gmail.com', '$2y$10$0BKSlEB09tehvC/LlGai2ebf92qPfB5oIJaJaYcpQPNDtREDvzSbq', 'Saulo', 'Poveda', '1988-05-10', 'nutricionista'),
('smoothCriminal@gmail.com', '$2y$10$3hHHENs6HoR5FoARxa1/FOYhVlBr/ATJtowK9VKcGUDhAKCYHlhNm', 'Michael', 'Jackson', '1968-05-05', 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vasos_agua`
--

CREATE TABLE `vasos_agua` (
  `id_agua` int(4) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `n_vasos` int(2) DEFAULT NULL,
  `hora` time NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vasos_agua`
--

INSERT INTO `vasos_agua` (`id_agua`, `email`, `n_vasos`, `hora`, `fecha`) VALUES
(1, 'horacioram94@gmail.com', 1, '02:37:47', '2018-04-28');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`email`),
  ADD KEY `fk_11` (`id_dieta`),
  ADD KEY `fk_12` (`id_tabla`);

--
-- Indices de la tabla `comenta`
--
ALTER TABLE `comenta`
  ADD PRIMARY KEY (`email`,`id_hilo`),
  ADD KEY `fk_3` (`id_hilo`);

--
-- Indices de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  ADD PRIMARY KEY (`id_tabla`,`id_ejercicio`);

--
-- Indices de la tabla `entrenador`
--
ALTER TABLE `entrenador`
  ADD PRIMARY KEY (`id_entrenador`,`email`),
  ADD KEY `fk_7` (`email`);

--
-- Indices de la tabla `hilo_foro`
--
ALTER TABLE `hilo_foro`
  ADD PRIMARY KEY (`id_hilo`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id_hilo`,`id_mensaje`);

--
-- Indices de la tabla `nutricionista`
--
ALTER TABLE `nutricionista`
  ADD PRIMARY KEY (`id_nutricionista`,`email`),
  ADD KEY `fk_4` (`email`);

--
-- Indices de la tabla `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`id_dieta`,`id_plato`);

--
-- Indices de la tabla `tabla_dieta`
--
ALTER TABLE `tabla_dieta`
  ADD PRIMARY KEY (`id_dieta`),
  ADD KEY `fk_5` (`id_nutricionista`);

--
-- Indices de la tabla `tabla_ejercicio`
--
ALTER TABLE `tabla_ejercicio`
  ADD PRIMARY KEY (`id_tabla`),
  ADD KEY `fk_8` (`id_entrenador`);

--
-- Indices de la tabla `usuario_registrado`
--
ALTER TABLE `usuario_registrado`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `vasos_agua`
--
ALTER TABLE `vasos_agua`
  ADD PRIMARY KEY (`id_agua`),
  ADD KEY `fk_13` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comenta`
--
ALTER TABLE `comenta`
  MODIFY `id_hilo` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `hilo_foro`
--
ALTER TABLE `hilo_foro`
  MODIFY `id_hilo` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id_hilo` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vasos_agua`
--
ALTER TABLE `vasos_agua`
  MODIFY `id_agua` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario_registrado` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`id_dieta`) REFERENCES `tabla_dieta` (`id_dieta`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cliente_ibfk_3` FOREIGN KEY (`id_tabla`) REFERENCES `tabla_ejercicio` (`id_tabla`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cliente_ibfk_4` FOREIGN KEY (`email`) REFERENCES `usuario_registrado` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comenta`
--
ALTER TABLE `comenta`
  ADD CONSTRAINT `comenta_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario_registrado` (`email`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comenta_ibfk_2` FOREIGN KEY (`id_hilo`) REFERENCES `hilo_foro` (`id_hilo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comenta_ibfk_3` FOREIGN KEY (`email`) REFERENCES `usuario_registrado` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comenta_ibfk_4` FOREIGN KEY (`id_hilo`) REFERENCES `hilo_foro` (`id_hilo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comenta_ibfk_5` FOREIGN KEY (`id_hilo`) REFERENCES `hilo_foro` (`id_hilo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  ADD CONSTRAINT `ejercicio_ibfk_1` FOREIGN KEY (`id_tabla`) REFERENCES `tabla_ejercicio` (`id_tabla`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entrenador`
--
ALTER TABLE `entrenador`
  ADD CONSTRAINT `entrenador_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario_registrado` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entrenador_ibfk_2` FOREIGN KEY (`email`) REFERENCES `usuario_registrado` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `mensaje_ibfk_1` FOREIGN KEY (`id_hilo`) REFERENCES `hilo_foro` (`id_hilo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `nutricionista`
--
ALTER TABLE `nutricionista`
  ADD CONSTRAINT `nutricionista_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario_registrado` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `platos`
--
ALTER TABLE `platos`
  ADD CONSTRAINT `platos_ibfk_1` FOREIGN KEY (`id_dieta`) REFERENCES `tabla_dieta` (`id_dieta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tabla_dieta`
--
ALTER TABLE `tabla_dieta`
  ADD CONSTRAINT `tabla_dieta_ibfk_1` FOREIGN KEY (`id_nutricionista`) REFERENCES `nutricionista` (`id_nutricionista`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tabla_ejercicio`
--
ALTER TABLE `tabla_ejercicio`
  ADD CONSTRAINT `tabla_ejercicio_ibfk_1` FOREIGN KEY (`id_entrenador`) REFERENCES `entrenador` (`id_entrenador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tabla_ejercicio_ibfk_2` FOREIGN KEY (`id_entrenador`) REFERENCES `entrenador` (`id_entrenador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vasos_agua`
--
ALTER TABLE `vasos_agua`
  ADD CONSTRAINT `vasos_agua_ibfk_1` FOREIGN KEY (`email`) REFERENCES `cliente` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vasos_agua_ibfk_2` FOREIGN KEY (`email`) REFERENCES `cliente` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
