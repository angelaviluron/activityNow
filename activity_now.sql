-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2025 a las 00:07:55
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
-- Base de datos: `activity_now`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colabora`
--

CREATE TABLE `colabora` (
  `id` int(11) NOT NULL,
  `c_tarea_id` int(11) NOT NULL,
  `c_user_id` int(11) NOT NULL,
  `c_tipo` enum('dueño','colaborador') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subtarea`
--

CREATE TABLE `subtarea` (
  `st_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `u_id` int(11) DEFAULT NULL,
  `st_asunto` varchar(25) NOT NULL,
  `st_descripcion` text NOT NULL,
  `st_estado` enum('Definido','En proceso','Completada') DEFAULT 'Definido',
  `st_prioridad` enum('Baja','Normal','Alta') DEFAULT 'Normal',
  `st_fechaVenc` date DEFAULT NULL,
  `st_comentario` text DEFAULT NULL,
  `st_responsable` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subtarea`
--

INSERT INTO `subtarea` (`st_id`, `t_id`, `u_id`, `st_asunto`, `st_descripcion`, `st_estado`, `st_prioridad`, `st_fechaVenc`, `st_comentario`, `st_responsable`) VALUES
(5, 3, 3, 'Subtarea', 'Nueva', 'Completada', 'Baja', '2025-05-24', '', 2),
(7, 5, 3, 'Ejemplo', 'Ejemplo', 'Completada', 'Baja', '2025-05-22', '', 3),
(9, 9, 4, 'Otra subtarea', 'Otra', 'Definido', 'Baja', '2025-05-22', '', 3),
(10, 12, 4, 'Subtarea', 'lalala', 'Completada', 'Baja', '2025-05-22', '', NULL),
(11, 12, 4, 'Nueva', 'nueva', 'Definido', 'Alta', '2025-05-22', '', NULL),
(12, 13, 3, 'Muestra Subtarea 1', '11111', 'Definido', 'Baja', '2025-05-22', 'Ndaa', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subtarea_responsables`
--

CREATE TABLE `subtarea_responsables` (
  `id` int(11) NOT NULL,
  `st_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `permiso` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subtarea_responsables`
--

INSERT INTO `subtarea_responsables` (`id`, `st_id`, `u_id`, `permiso`) VALUES
(4, 5, 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE `tarea` (
  `t_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `t_asunto` varchar(100) NOT NULL,
  `t_descripcion` text DEFAULT NULL,
  `t_prioridad` int(11) NOT NULL,
  `t_estado` int(11) NOT NULL,
  `t_fechaVenc` date NOT NULL,
  `t_fechaRec` date NOT NULL,
  `t_color` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tarea`
--

INSERT INTO `tarea` (`t_id`, `u_id`, `t_asunto`, `t_descripcion`, `t_prioridad`, `t_estado`, `t_fechaVenc`, `t_fechaRec`, `t_color`) VALUES
(3, 3, 'Tarea Editada', 'Desc', 2, 4, '2025-05-15', '2025-05-15', '#FFF3CD'),
(5, 3, 'Tarea Ejemplo', 'Prueba', 3, 4, '2025-05-23', '2025-05-21', '#E6F4EA'),
(6, 3, 'ejemplo 3', 'descripcion', 2, 3, '2025-05-13', '2025-05-20', '#E6F4EA'),
(7, 3, 'Nueva', 'Nueva tarea', 1, 1, '2025-05-31', '2025-05-16', '#E6F4EA'),
(8, 1, 'Notificada', 'Notificada', 3, 1, '2025-05-24', '2025-05-16', '#E6F4EA'),
(9, 4, 'Mi Tarea', 'Mi tarea', 2, 4, '2025-05-23', '2025-05-20', '#E8EAF6'),
(10, 4, 'Ejemploooo', 'Ejemplo', 2, 1, '2025-05-17', '2025-05-16', '#E8EAF6'),
(11, 4, 'Nueva', 'kjbhjb', 1, 1, '2025-05-24', '2025-05-14', '#FDE2E2'),
(12, 4, 'nueo', 'sdfns', 2, 2, '2025-05-24', '2025-05-22', '#E6F4EA'),
(13, 2, 'Nueva Muestra profe', 'Muestra', 1, 1, '2025-05-23', '2025-05-16', '#E8EAF6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea_colaboradores`
--

CREATE TABLE `tarea_colaboradores` (
  `id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `permiso` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tarea_colaboradores`
--

INSERT INTO `tarea_colaboradores` (`id`, `t_id`, `u_id`, `permiso`) VALUES
(3, 3, 1, 'lectura'),
(4, 3, 3, 'edicion'),
(5, 5, 2, 'edicion'),
(6, 5, 3, 'edicion'),
(7, 8, 3, 'lectura'),
(8, 9, 3, 'lectura'),
(9, 13, 4, 'edicion'),
(10, 13, 3, 'lectura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `u_id` int(11) NOT NULL,
  `u_nombre` varchar(25) NOT NULL,
  `u_apellido` varchar(25) NOT NULL,
  `u_pwd` varchar(255) NOT NULL,
  `u_email` varchar(50) NOT NULL,
  `u_user` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`u_id`, `u_nombre`, `u_apellido`, `u_pwd`, `u_email`, `u_user`) VALUES
(1, 'Juan', 'Gomez', '12345678', 'juanGomez@gmail.com', 'juanGomez'),
(2, 'Angela', 'Viluron', '12345678', 'angela@gmail.com', 'angelaViluron'),
(3, 'Karina', 'Sosa', '$2y$10$vx2aKOHlzKImn0uPHSsLF.MSNJeZW.mX0Jax92ZV6GQxCifG2tQY.', 'msosa@gmail.com', 'mSosa'),
(4, 'Juana', 'Lopez', '$2y$10$o1R5VDZmS.QchZ1hHqI03eoRLh0IgYAUJgUJXpL3Cbba/gsDbjoja', 'juanaLopez@gmail.com', 'juanaLopez');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `colabora`
--
ALTER TABLE `colabora`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_colaboracion` (`c_tarea_id`,`c_user_id`),
  ADD KEY `c_user_id` (`c_user_id`);

--
-- Indices de la tabla `subtarea`
--
ALTER TABLE `subtarea`
  ADD PRIMARY KEY (`st_id`),
  ADD KEY `t_id` (`t_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `st_responsable` (`st_responsable`);

--
-- Indices de la tabla `subtarea_responsables`
--
ALTER TABLE `subtarea_responsables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `subtarea_responsables_ibfk_1` (`st_id`);

--
-- Indices de la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indices de la tabla `tarea_colaboradores`
--
ALTER TABLE `tarea_colaboradores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `t_id` (`t_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `colabora`
--
ALTER TABLE `colabora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subtarea`
--
ALTER TABLE `subtarea`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `subtarea_responsables`
--
ALTER TABLE `subtarea_responsables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tarea`
--
ALTER TABLE `tarea`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tarea_colaboradores`
--
ALTER TABLE `tarea_colaboradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `colabora`
--
ALTER TABLE `colabora`
  ADD CONSTRAINT `colabora_ibfk_1` FOREIGN KEY (`c_tarea_id`) REFERENCES `tarea` (`t_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `colabora_ibfk_2` FOREIGN KEY (`c_user_id`) REFERENCES `usuario` (`u_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `subtarea`
--
ALTER TABLE `subtarea`
  ADD CONSTRAINT `subtarea_ibfk_1` FOREIGN KEY (`t_id`) REFERENCES `tarea` (`t_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subtarea_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `usuario` (`u_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `subtarea_ibfk_3` FOREIGN KEY (`st_responsable`) REFERENCES `usuario` (`u_id`);

--
-- Filtros para la tabla `subtarea_responsables`
--
ALTER TABLE `subtarea_responsables`
  ADD CONSTRAINT `subtarea_responsables_ibfk_1` FOREIGN KEY (`st_id`) REFERENCES `subtarea` (`st_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subtarea_responsables_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `usuario` (`u_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD CONSTRAINT `tarea_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `usuario` (`u_id`);

--
-- Filtros para la tabla `tarea_colaboradores`
--
ALTER TABLE `tarea_colaboradores`
  ADD CONSTRAINT `tarea_colaboradores_ibfk_1` FOREIGN KEY (`t_id`) REFERENCES `tarea` (`t_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tarea_colaboradores_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `usuario` (`u_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
