-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-03-2025 a las 17:41:37
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mi_sistema_login`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `creado_en`) VALUES
(1, 'franciscosignes1978@gmail.com', '$2y$10$8jVpcUh3SsJCeyHLEeAD8O7R2Poj68V8FlvLSOk/FKQpooR9xwEVS', '2025-02-24 16:56:23'),
(3, 'antonia@gmail.com', '$2y$10$lOsNCojWJv0PujYYHe06Qeyi5TL5Lgd1GsePqckHPb3VOu/InFqrm', '2025-02-27 17:20:17'),
(4, 'pedro@gmail.com', '$2y$10$xuD07KEMuuNgGGpyGajir.G3dOcQlvlwEtRdOJBXUCkeQ5ACyPe/2', '2025-02-27 17:30:26'),
(7, 'fosca@gmail.com', '$2y$10$M62qdgRGe36H0slvj/P3FuxRkH9HqRLr51n/cgAKS3.i.WeB3PqJq', '2025-02-28 15:28:01'),
(8, 'pancho@gmail.com', '$2y$10$E4N9IiLK1iiTiBlPgIxkmuHGmugf3HwMT8qM7DAfUrIz51nZZKm3u', '2025-02-28 15:29:50');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
