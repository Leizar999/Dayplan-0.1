-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-07-2017 a las 23:41:24
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dayplan`
--

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `dayplan`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `dayplan` (
`id` int(9)
,`login` varchar(40)
,`name` varchar(40)
,`surname` varchar(40)
,`department` varchar(60)
,`texteditor` varchar(900)
,`dateplan` varchar(21)
,`email` varchar(40)
,`comments` varchar(500)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dayplans`
--

CREATE TABLE `dayplans` (
  `id` int(9) NOT NULL,
  `login` varchar(40) NOT NULL,
  `texteditor` varchar(900) NOT NULL,
  `dateplan` varchar(21) NOT NULL,
  `comments` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `login` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `name` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `department` varchar(60) NOT NULL,
  `role` varchar(40) NOT NULL,
  `email` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura para la vista `dayplan`
--
DROP TABLE IF EXISTS `dayplan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`manager`@`%` SQL SECURITY DEFINER VIEW `dayplan`  AS  select `dayplans`.`id` AS `id`,`users`.`login` AS `login`,`users`.`name` AS `name`,`users`.`surname` AS `surname`,`users`.`department` AS `department`,`dayplans`.`texteditor` AS `texteditor`,`dayplans`.`dateplan` AS `dateplan`,`users`.`email` AS `email`,`dayplans`.`comments` AS `comments` from (`users` join `dayplans`) where (`users`.`login` = `dayplans`.`login`) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dayplans`
--
ALTER TABLE `dayplans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login` (`login`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dayplans`
--
ALTER TABLE `dayplans`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dayplans`
--
ALTER TABLE `dayplans`
  ADD CONSTRAINT `dayplans_ibfk_1` FOREIGN KEY (`login`) REFERENCES `users` (`login`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
