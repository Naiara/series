-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2024 a las 13:45:59
-- Versión del servidor: 8.0.35
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `series`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `series`
--

CREATE TABLE `series` (
  `id` int NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `ISAN` char(8) NOT NULL,
  `descripcion` text NOT NULL,
  `estreno` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `series`
--

INSERT INTO `series` (`id`, `titulo`, `ISAN`, `descripcion`, `estreno`) VALUES
(2, 'Squid Game', '44556677', ' Un grupo de personas en deuda compite en juegos mortales por un gran premio.', '2021'),
(3, 'Money Heist', '22334455', ' Una banda planea el mayor atraco en la historia de España: imprimir 2.4 mil millones de euros en la Casa de la Moneda.', '2017'),
(4, 'Stranger Things', '55667788', ' Una serie de ciencia ficción ambientada en la década de 1980 en la ciudad ficticia de Hawkins, Indiana.', '2016'),
(5, 'The Witcher', '12123434', 'Basada en la serie de libros, sigue las aventuras de Geralt de Rivia, un cazador de monstruos.', '2019'),
(6, 'The Mandalorian', '99001122', 'Una serie de Star Wars que sigue las aventuras de un cazarrecompensas en la galaxia.', '2019'),
(8, 'Euphoria', '87654321', ' Un drama que sigue a un grupo de adolescentes mientras navegan por el amor, la amistad y la identidad.', '2019'),
(9, 'The Queens Gambit', '10112233', 'Una joven prodigio del ajedrez lucha por encontrar su lugar en un mundo dominado por hombres.', '2020'),
(10, 'Ozark', '33445566', 'Un asesor financiero se muda a los Ozarks tras un lavado de dinero que sale mal.', '2017'),
(12, 'The leftovers', '20123412', 'Esta serie dramática se ambienta después de un evento sobrenatural en el que el 2% de la población mundial desaparece sin dejar rastro. La historia sigue a los residentes de un pequeño pueblo mientras intentan lidiar con la pérdida, el dolor y la búsqueda de respuestas. La serie explora temas profundos de fe, duelo y la complejidad de las relaciones humanas.', '2014'),
(13, 'Loki', '11223344', ' La serie sigue al dios de las travesuras tras los eventos de \"Avengers: Endgame\".', '2021'),
(14, 'The Boys', '77889900', ' Un grupo de vigilantes intenta derrocar a superhéroes corruptos que abusan de su poder.', '2019'),
(15, 'WandaVision', '13123445', ' Una serie que mezcla la comedia clásica y el drama, siguiendo a Wanda Maximoff y Vision en una realidad alternativa.', '2021'),
(16, 'Dark', '16123478', 'Un thriller de ciencia ficción alemán sobre viajes en el tiempo y los oscuros secretos de una pequeña ciudad.', '2017'),
(17, 'The Handmaids Tale', '17123489', 'Una distopía donde las mujeres fértiles son forzadas a la servidumbre reproductiva en un régimen totalitario.', '2017'),
(20, 'Fleabag', '21123413', 'Una comedia dramática británica que sigue la vida de una mujer joven en Londres mientras navega por sus relaciones familiares, su vida romántica y el duelo. Con su característico humor oscuro y diálogos rompientes, la protagonista (interpretada por Phoebe Waller-Bridge) habla directamente a la audiencia rompiendo la cuarta pared, lo que le da un toque único e íntimo.', '2016'),
(21, 'Kaos', '22123414', 'Kaos es una serie de mitología griega moderna que explora las vidas de dioses, héroes y mortales, destacando la lucha entre el destino y el libre albedrío. Con una mezcla de comedia y drama, esta serie promete ofrecer una versión renovada de las historias clásicas.', '2024'),
(22, 'New Amsterdam', '23547689', '\"New Amsterdam\" es una serie dramática ambientada en el Hospital New Amsterdam, el centro médico público más antiguo de Estados Unidos. La historia sigue al Dr. Max Goodwin, un director médico decidido y carismático, cuya misión es reformar y revitalizar el hospital, enfrentándose a un sistema burocrático y lleno de desafíos. Max adopta un enfoque poco convencional, siempre poniendo a los pacientes en primer lugar y cuestionando las prácticas tradicionales de la medicina para ofrecer una atención más humana.\r\n\r\nLa serie destaca los problemas del sistema de salud y las tensiones que enfrentan los médicos y el personal de salud, al mismo tiempo que explora las vidas personales de sus personajes y las complejas relaciones que desarrollan en medio de un entorno hospitalario caótico pero inspirador. Mezcla de drama médico y social, \"New Amsterdam\" plantea preguntas profundas sobre el cuidado médico, la compasión y el sacrificio.', '2016');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','usuario') NOT NULL DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `name`, `username`, `email`, `password`, `role`) VALUES
(1, 'administrador', 'admin', 'admin@lhusurbil.eus', '$2y$10$MnzSQAM5C1VOJti6wCLG6u75Lt2eaIuYodMQePATVe5ye1.Wm5.4e', 'admin'),--admin123
(2, 'Usuario', 'usuario', 'usuario@lhusurbil.eus', '$2y$10$MnzSQAM5C1VOJti6wCLG6u75Lt2eaIuYodMQePATVe5ye1.Wm5.4e', 'usuario'),--Usurbi123
(9, 'Pepita', 'pepita', 'pepita@gmail.com', '$2y$10$57VungPllOhFcE9fpNX41.CUk5m48P5vQ/EiHGzPTInRI1Kg9LF7q', 'usuario'),
(12, 'Pepito', 'irpepito', 'pepito@gmail.com', '$2y$10$2j.SHHgfhgDMnKvn8h2upuilCzbxmvBmNFDMD5rf0rMcIs4fllOEW', 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE `valoraciones` (
  `id` int NOT NULL,
  `serie_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `puntuacion` int DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`id`, `serie_id`, `usuario_id`, `puntuacion`) VALUES
(4, 2, 1, 4),
(5, 2, 2, 1),
(7, 3, 1, 5),
(8, 4, 1, 3),
(9, 4, 2, 4),
(10, 5, 1, 3),
(12, 6, 1, 4),
(16, 8, 1, 1),
(17, 8, 2, 4),
(18, 9, 1, 5),
(19, 9, 2, 5),
(20, 10, 1, 3),
(23, 12, 1, 4),
(24, 13, 1, 5),
(25, 14, 1, 4),
(26, 15, 1, 2),
(27, 15, 1, 2),
(28, 3, 2, 2),
(29, 5, 2, 3),
(30, 6, 2, 3),
(31, 10, 2, 1),
(33, 12, 2, 4),
(34, 13, 2, 4),
(35, 14, 2, 4),
(36, 15, 2, 3),
(38, 8, 9, 2),
(39, 13, 9, 2),
(40, 3, 9, 1),
(41, 10, 9, 2),
(42, 2, 9, 4),
(43, 4, 9, 2),
(46, 14, 9, 2),
(47, 6, 9, 2),
(48, 9, 9, 2),
(49, 5, 9, 1),
(50, 15, 9, 1),
(51, 12, 9, 1),
(52, 16, 1, 5),
(53, 20, 1, 5),
(54, 21, 1, 5),
(55, 17, 1, 5),
(56, 16, 9, 2),
(57, 20, 9, 1),
(58, 21, 9, 4),
(64, 2, 12, 3),
(65, 3, 12, 5),
(66, 4, 12, 1),
(67, 5, 12, 4),
(68, 6, 12, 3),
(69, 8, 12, 3),
(70, 9, 12, 4),
(71, 10, 12, 1),
(72, 12, 12, 4),
(73, 13, 12, 3),
(74, 14, 12, 4),
(75, 15, 12, 1),
(76, 16, 12, 4),
(77, 17, 12, 5),
(78, 20, 12, 5),
(79, 22, 12, 5),
(80, 21, 12, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ISAN` (`ISAN`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `serie_id` (`serie_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `series`
--
ALTER TABLE `series`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD CONSTRAINT `fk_foreign_key_name` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `valoraciones_ibfk_1` FOREIGN KEY (`serie_id`) REFERENCES `series` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
