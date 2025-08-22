-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-08-2025 a las 23:54:31
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
-- Base de datos: `bdkiush`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `Cod` int(3) UNSIGNED ZEROFILL NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`Cod`, `Nombre`) VALUES
(001, 'Profesorado en Letras'),
(003, 'Profesorado en Historia'),
(004, 'Profesorado en Geografía'),
(016, 'Analista de Sistemas'),
(023, 'Ingenieria en Recursos Naturales Renovables'),
(045, 'Licenciatura en Psicopedagogía'),
(049, 'Profesorado en Matemática'),
(060, 'Licenciatura en Letras'),
(061, 'Licenciatura en Turismo'),
(062, 'Tecnicatura Universitaria en Turismo'),
(064, 'Licenciatura en Geografía'),
(069, 'Ingeniería Química'),
(072, 'Licenciatura en Sistemas'),
(074, 'Licenciatura en Trabajo Social'),
(076, 'Tecnicatura Universitaria en Acompañamiento Terapéutico'),
(093, 'Título intermedio Enfermero/a - Licenciatura en Enfermería'),
(096, 'Licenciatura en Historia'),
(912, 'Tecnicatura Universitaria en Gestión de Organizaciones'),
(913, 'Licenciatura en Administración'),
(914, 'Profesorado en Economía y Gestión de Organizaciones'),
(918, 'Licenciatura en Comunicación Social');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `fechasDictado` varchar(500) NOT NULL,
  `fechaInicioInscripcion` date NOT NULL,
  `fechaFinInscripcion` date NOT NULL,
  `lugar` varchar(100) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `imagen` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id`, `nombre`, `descripcion`, `fechasDictado`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `lugar`, `estado`, `usuario_id`, `imagen`) VALUES
(1, '1era parte de PHP', 'Programación en PHP para principiantes', 'lunes a viernes de 15 a 16', '2023-09-10', '2025-12-31', 'Aula A5', 1, 43, 'PHP.png'),
(2, 'HTML8', 'Codigo', 'martes y jueves de 13 a 14', '2023-10-20', '2025-12-31', 'Aula A5 UNPA - UARG', 1, 43, 'OIP.jpg'),
(3, 'Python ', 'Progamacion nivel 3', 'lunes, miercoles y viernes de 10 a 11', '2023-09-10', '2025-12-31', 'Aula B9 UNPA - UARG', 1, 43, 'R.jpg'),
(4, 'REACT', 'Programacion basica', 'sabados y domingos 10 a 14', '2023-09-10', '2025-12-31', 'Aula B10 UNPA - UARG', 1, 43, 'R.png'),
(38, 'Git Hub avanzado', 'Creación de repositorios, creación de ramas, trabajo en equipo.', 'Lunes y miércoles de 14:00 hs. a 16:00hs', '2023-12-01', '2025-12-31', 'UNPA-UARG Sector A, aula A4', 1, 43, 'GitHub.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_integrante`
--

CREATE TABLE `curso_integrante` (
  `curso_id` int(11) NOT NULL,
  `integrante_id` int(11) NOT NULL,
  `rol` varchar(45) DEFAULT NULL,
  `afeccionHorasSemanales` varchar(3) DEFAULT NULL,
  `afeccionTotalHoras` varchar(6) DEFAULT NULL,
  `instituto` varchar(45) DEFAULT NULL,
  `categoriaDocente` varchar(45) DEFAULT NULL,
  `dedicacion` varchar(45) DEFAULT NULL,
  `categoriaExtensionista` varchar(100) DEFAULT NULL,
  `organizacion` varchar(45) DEFAULT NULL,
  `funcion` varchar(100) DEFAULT NULL,
  `nivelEstudios` varchar(45) DEFAULT NULL,
  `ocupacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `curso_integrante`
--

INSERT INTO `curso_integrante` (`curso_id`, `integrante_id`, `rol`, `afeccionHorasSemanales`, `afeccionTotalHoras`, `instituto`, `categoriaDocente`, `dedicacion`, `categoriaExtensionista`, `organizacion`, `funcion`, `nivelEstudios`, `ocupacion`) VALUES
(1, 4, 'Co-director', '40', '400', 'unpa uarg', 'categoria 1', 'docente', 'categoria 2', 'unpa-uarg', 'docente', 'universitario', 'docente'),
(2, 21, 'Director', '26', '30', 'Unpa uarg', 'no se', 'Profesor', 'no se ', '', '', '', ''),
(3, 23, 'Director', '26', '30', 'Unpa uarg', 'no se', 'Profesor', 'no se ', '', '', '', ''),
(4, 21, 'Director', '26', '30', 'Unpa uarg', 'no se', 'Profesor', 'no se ', '', '', '', ''),
(4, 24, 'Integrante externo', '26', '30', '', '', '', '', 'UNPA UART', 'Docente', 'Universitarios', 'Docentes'),
(38, 4, 'Co-director', '40', '400', 'unpa uarg', 'categoria 1', 'docente', 'categoria 2', 'unpa-uarg', 'docente', 'universitario', 'docente'),
(38, 23, 'Director', '26', '30', 'Unpa uarg', 'no se', 'Profesor', 'no se ', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_persona`
--

CREATE TABLE `curso_persona` (
  `curso_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `pago` smallint(4) DEFAULT NULL,
  `nota` varchar(45) DEFAULT NULL,
  `asistencia` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `curso_persona`
--

INSERT INTO `curso_persona` (`curso_id`, `persona_id`, `estado`, `pago`, `nota`, `asistencia`) VALUES
(1, 1, '', NULL, NULL, NULL),
(1, 8, '', NULL, NULL, NULL),
(1, 9, 'Preinscripto', NULL, NULL, NULL),
(2, 1, 'Preinscripto', NULL, NULL, NULL),
(2, 8, 'Preinscripto', NULL, NULL, NULL),
(3, 8, 'Preinscripto', NULL, NULL, NULL),
(4, 9, 'Preinscripto', NULL, NULL, NULL),
(38, 8, 'Preinscripto', NULL, NULL, NULL),
(38, 9, '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `País` varchar(100) NOT NULL,
  `Provincia` varchar(100) NOT NULL,
  `Localidad` varchar(100) NOT NULL,
  `CodPostal` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`País`, `Provincia`, `Localidad`, `CodPostal`) VALUES
('Argentina', 'Seleccione', 'SANTA CRUZ', ''),
('Argentina', 'Seleccione', 'SANTA CRUZ', '1234'),
('Argentina', 'Santa Cruz', 'Río Gallegos', '9400'),
('Argentina', 'Seleccione', 'SANTA CRUZ', 'cdsc9400');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `integrante`
--

CREATE TABLE `integrante` (
  `id` int(11) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `dni` varchar(45) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `direccion_CodPostal` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `carrera_Cod` int(3) UNSIGNED ZEROFILL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `integrante`
--

INSERT INTO `integrante` (`id`, `nombres`, `apellidos`, `dni`, `titulo`, `direccion`, `direccion_CodPostal`, `telefono`, `email`, `tipo_id`, `carrera_Cod`) VALUES
(4, 'Esteban', 'Gesto', '98765432', 'licenciado en sistemas', 'san martin N°1', '9400', '2966789654', 'egestos@gmail.com', 2, 072),
(21, 'Osiris', 'Sofia', '11111111', 'Licenciado en sistemas', 'Calle 1 n 2', '9400', '2966111111', 'osofia@gmail.com', 2, 072),
(23, 'Karim', 'Hallar', '10101010', 'Licenciado en sistemas', 'Calle 1 n 2', '9400', '2966111111', 'khallar@gmail.com', 2, 072),
(24, 'Leonardo', 'Gonzalez', '45454545', 'Licenciado en sistemas', 'Zapiola 34', '9400', '2966122356', 'lgonzalez@gmail.com', 5, 072);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id`, `nombre`) VALUES
(4, 'Preinscriptos'),
(5, 'Integrantes'),
(6, 'Cursos'),
(7, 'Usuarios'),
(8, 'Roles'),
(9, 'Permisos'),
(11, 'Salir'),
(12, 'Ingresar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `dni` varchar(45) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `carrera_Cod` int(3) UNSIGNED ZEROFILL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombre`, `apellido`, `email`, `dni`, `tipo_id`, `carrera_Cod`) VALUES
(1, 'carla', 'gleadell', 'carlagleadell2000@gmail.com', '42428983', 1, 072),
(8, 'Pedro', 'Gimenez', 'pperez@gmail.com', '98765432', 1, 016),
(9, 'Juan ', 'Perez', 'juanperez@gmail.com', '12345678', 1, 072);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`) VALUES
(7, 'Encargado Gestion Cursos'),
(8, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_permiso`
--

CREATE TABLE `rol_permiso` (
  `id_rol` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `rol_permiso`
--

INSERT INTO `rol_permiso` (`id_rol`, `id_permiso`) VALUES
(7, 4),
(7, 5),
(7, 6),
(7, 11),
(7, 12),
(8, 4),
(8, 5),
(8, 6),
(8, 7),
(8, 8),
(8, 9),
(8, 11),
(8, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id`, `nombre`) VALUES
(1, 'alumno'),
(2, 'docente'),
(3, 'no docente'),
(4, 'externo'),
(5, 'graduado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`) VALUES
(41, 'Yohana Bahamonde', 'bahamondeyohana7@gmail.com'),
(25, 'Carla Gleadell', 'carlagleadell2000@gmail.com'),
(42, 'Car Gleadell', 'carlagleadell@gmail.com'),
(43, 'KIUSH - admin', 'cursoskiushunpa@gmail.com'),
(45, 'Esteban Gesto', 'egesto@uarg.unpa.edu.ar'),
(44, 'Karim Hallar', 'khallar@uarg.unpa.edu.ar'),
(46, 'Osiris Sofia', 'osofia@uarg.unpa.edu.ar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`id_usuario`, `id_rol`) VALUES
(42, 7),
(25, 8),
(41, 8),
(43, 8),
(44, 8),
(45, 8),
(46, 8);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`Cod`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_curso_usuario1_idx` (`usuario_id`);

--
-- Indices de la tabla `curso_integrante`
--
ALTER TABLE `curso_integrante`
  ADD PRIMARY KEY (`curso_id`,`integrante_id`),
  ADD KEY `fk_curso_has_integrante_integrante1_idx` (`integrante_id`),
  ADD KEY `fk_curso_has_integrante_curso1_idx` (`curso_id`);

--
-- Indices de la tabla `curso_persona`
--
ALTER TABLE `curso_persona`
  ADD PRIMARY KEY (`curso_id`,`persona_id`),
  ADD KEY `fk_curso_has_persona_persona1_idx` (`persona_id`),
  ADD KEY `fk_curso_has_persona_curso1_idx` (`curso_id`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`CodPostal`);

--
-- Indices de la tabla `integrante`
--
ALTER TABLE `integrante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_integrante_direccion1` (`direccion_CodPostal`),
  ADD KEY `fk_integrante_tipo1` (`tipo_id`),
  ADD KEY `fk_integrante_carrera1` (`carrera_Cod`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ID_PERMISO_IND` (`id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD KEY `fk_persona_tipo1_idx` (`tipo_id`),
  ADD KEY `fk_persona_carrera1_idx` (`carrera_Cod`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ID_ROL_IND` (`id`);

--
-- Indices de la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD PRIMARY KEY (`id_rol`,`id_permiso`),
  ADD UNIQUE KEY `ID_ROL_PERMISO_IND` (`id_permiso`,`id_rol`),
  ADD KEY `FKASO_ROL_IND` (`id_rol`),
  ADD KEY `FKASO_PER_idx` (`id_permiso`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UN_USUARIO` (`email`,`nombre`),
  ADD UNIQUE KEY `ID_USUARIO_IND` (`id`);

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD UNIQUE KEY `ID_USUARIO_ROL_IND` (`id_rol`,`id_usuario`),
  ADD KEY `FKVIN_USU_IND` (`id_usuario`),
  ADD KEY `FKVIN_ROL_idx` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `integrante`
--
ALTER TABLE `integrante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `fk_curso_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `curso_integrante`
--
ALTER TABLE `curso_integrante`
  ADD CONSTRAINT `fk_curso_has_integrante_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`),
  ADD CONSTRAINT `fk_curso_has_integrante_integrante1` FOREIGN KEY (`integrante_id`) REFERENCES `integrante` (`id`);

--
-- Filtros para la tabla `curso_persona`
--
ALTER TABLE `curso_persona`
  ADD CONSTRAINT `fk_curso_has_persona_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`),
  ADD CONSTRAINT `fk_curso_has_persona_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `integrante`
--
ALTER TABLE `integrante`
  ADD CONSTRAINT `fk_integrante_carrera1` FOREIGN KEY (`carrera_Cod`) REFERENCES `carrera` (`Cod`),
  ADD CONSTRAINT `fk_integrante_direccion1` FOREIGN KEY (`direccion_CodPostal`) REFERENCES `direccion` (`CodPostal`),
  ADD CONSTRAINT `fk_integrante_tipo1` FOREIGN KEY (`tipo_id`) REFERENCES `tipo` (`id`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `fk_persona_carrera1` FOREIGN KEY (`carrera_Cod`) REFERENCES `carrera` (`Cod`),
  ADD CONSTRAINT `fk_persona_tipo1` FOREIGN KEY (`tipo_id`) REFERENCES `tipo` (`id`);

--
-- Filtros para la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD CONSTRAINT `fk_rol_permiso_permiso` FOREIGN KEY (`id_permiso`) REFERENCES `permiso` (`id`),
  ADD CONSTRAINT `fk_rol_permiso_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);

--
-- Filtros para la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD CONSTRAINT `fk_usuario_rol_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`),
  ADD CONSTRAINT `fk_usuario_rol_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
