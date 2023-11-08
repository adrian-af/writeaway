-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2023 a las 19:43:15
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `writeaway`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `ID` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `storyId` int(11) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `content` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genres`
--

CREATE TABLE `genres` (
  `ID` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `genres`
--

INSERT INTO `genres` (`ID`, `name`) VALUES
(1, 'romance'),
(2, 'fantasy'),
(3, 'paranormal'),
(4, 'terror'),
(5, 'historical fiction'),
(6, 'fanfic'),
(7, 'short story'),
(8, 'scifi'),
(9, 'humour'),
(10, 'mystery'),
(11, 'action'),
(12, 'youth novel'),
(13, 'poetry'),
(14, 'non fiction'),
(15, 'other');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stories`
--

CREATE TABLE `stories` (
  `ID` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `genreId` int(11) NOT NULL,
  `text` longtext NOT NULL,
  `public` tinyint(4) NOT NULL DEFAULT 0,
  `datetime` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `stories`
--

INSERT INTO `stories` (`ID`, `userId`, `title`, `genreId`, `text`, `public`, `datetime`) VALUES
(1, 17, '', 2, 'tjhis is the fantasy text 1', 0, '0000-00-00 00:00:00.000000'),
(2, 17, '', 2, 'tjhis is the fantasy text 1', 0, '0000-00-00 00:00:00.000000'),
(3, 17, '', 2, 'tjhis is the fantasy text 1', 0, '0000-00-00 00:00:00.000000'),
(4, 17, '', 7, 'this is the short text 1', 0, '0000-00-00 00:00:00.000000'),
(5, 17, '', 6, 'this is fanfic', 0, '0000-00-00 00:00:00.000000'),
(6, 17, '', 6, 'this is fanfic', 0, '0000-00-00 00:00:00.000000'),
(7, 17, '', 5, 'historical fiction text that is public', 1, '0000-00-00 00:00:00.000000'),
(8, 17, '', 1, 'this is a story\r\nthta has many lines\r\nwith different paragraphs and enters', 1, '0000-00-00 00:00:00.000000'),
(10, 17, '', 3, 'g paranormal', 0, '2023-11-06 19:34:37.252049'),
(11, 17, '', 1, 'stori', 0, '2023-11-06 19:40:02.702191'),
(12, 17, 'title of the story', 1, 'text of th estory', 1, '2023-11-06 19:43:07.991560'),
(21, 11, 'dsdf', 1, 'gfgfhfg', 0, '2023-11-08 17:46:30.657256');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` longblob DEFAULT NULL,
  `confirmationCode` int(11) NOT NULL,
  `about` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`ID`, `email`, `username`, `password`, `photo`, `confirmationCode`, `about`) VALUES
(3, 'asd@hot.com', 'asd', '$2y$10$iECWUkmYj81vXqYlMUSPqu/COoacNWnPGoA2fEvtJkn.Wq2h6c38S', '', 0, ''),
(8, 'abc@cde.es', 'abc', '$2y$10$3kbnCDZCpQhtovl0h93IaeLwAzsMc1Nvc/gEfZ2A63Fhc5xKA7.tG', NULL, 6482491, ''),
(11, 'bbb@ccc.ddd', 'bbb', '$2y$10$9Y9KWZRENmcueQfvSeDnRunD5t2BhQtJZXJe2.CGqksR6yNUZ2X66', NULL, 3173642, 'the about section of the user'),
(16, 'bbb@ccc.es', 'ccc', '$2y$10$N1NxEiVXda7FmTdZYOnOA.qQ34GdJkdhVqOtRYWq8LhGkjEu617Cq', NULL, 4755968, ''),
(17, 'adrian.fernandez1196@gmail.com', 'adrian', '$2y$10$muybdtRJFTQuVCdKb.iB3OST2xZqkOoAqrStrNHGuejAMPujT7E9G', NULL, 841672, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`),
  ADD KEY `storyId` (`storyId`),
  ADD KEY `userId` (`userId`);

--
-- Indices de la tabla `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Indices de la tabla `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`),
  ADD KEY `genreId` (`genreId`),
  ADD KEY `userId` (`userId`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `genres`
--
ALTER TABLE `genres`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `stories`
--
ALTER TABLE `stories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`storyId`) REFERENCES `stories` (`ID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`ID`);

--
-- Filtros para la tabla `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `stories_ibfk_1` FOREIGN KEY (`genreId`) REFERENCES `genres` (`ID`),
  ADD CONSTRAINT `stories_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
