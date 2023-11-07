CREATE DATABASE  IF NOT EXISTS `bdkiush` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bdkiush`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: bdkiush
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `carrera`
--

DROP TABLE IF EXISTS `carrera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrera` (
  `Cod` int(3) unsigned zerofill NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`Cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrera`
--

LOCK TABLES `carrera` WRITE;
/*!40000 ALTER TABLE `carrera` DISABLE KEYS */;
INSERT INTO `carrera` VALUES (001,'Profesorado en Letras'),(003,'Profesorado en Historia'),(004,'Profesorado en Geografía'),(016,'Analista de Sistemas'),(023,'Ingenieria en Recursos Naturales Renovables'),(045,'Licenciatura en Psicopedagogía'),(049,'Profesorado en Matemática'),(060,'Licenciatura en Letras'),(061,'Licenciatura en Turismo'),(062,'Tecnicatura Universitaria en Turismo'),(064,'Licenciatura en Geografía'),(069,'Ingeniería Química'),(072,'Licenciatura en Sistemas'),(074,'Licenciatura en Trabajo Social'),(076,'Tecnicatura Universitaria en Acompañamiento Terapéutico'),(093,'Título intermedio Enfermero/a - Licenciatura en Enfermería'),(096,'Licenciatura en Historia'),(912,'Tecnicatura Universitaria en Gestión de Organizaciones'),(913,'Licenciatura en Administración'),(914,'Profesorado en Economía y Gestión de Organizaciones'),(918,'Licenciatura en Comunicación Social');
/*!40000 ALTER TABLE `carrera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `curso`
--

DROP TABLE IF EXISTS `curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `curso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `fechasDictado` varchar(500) NOT NULL,
  `fechaInicioInscripcion` date NOT NULL,
  `fechaFinInscripcion` date NOT NULL,
  `lugar` varchar(100) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_curso_usuario1_idx` (`usuario_id`),
  CONSTRAINT `fk_curso_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso`
--

LOCK TABLES `curso` WRITE;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` VALUES (1,'Carpintería avanzada para adultos','Madera, herramientas','lunes a viernes de 15 a 16','2023-09-10','2023-09-11','Aula A5',0,25,'Curso_1.png'),(2,'HTML8','Codigo','martes y jueves de 13 a 14','2023-10-20','2023-10-25','Aula A5 UNPA - UARG',0,25,'OIP.jpg'),(3,'Python ','Progamacion nivel 3','lunes, miercoles y viernes de 10 a 11','2023-09-10','2023-09-11','Aula B9 UNPA - UARG',0,25,'R.jpg'),(4,'REACT','Programacion basica','sabados y domingos 10 a 14','2023-09-10','2023-09-10','Aula B10 UNPA - UARG',0,25,'R.png'),(5,'Prevencion contra el suicidio','Charla sobre salud mental','lunes 12 de 12 a 15','2023-09-10','2023-09-10','Aula B11 UNPA - UARG',0,25,'g63xqkjk5ni61.jpg'),(31,'Curso de programación nivel 1','En este curso se van a ver muchas cosas como html css php java python javascrips, entre otras muchísimas cosas más.También se verán:- tema 1- tema 2- tema 3- tema 4Esperamos su participación','De lunes a viernes de 13:00hs. a 14:00hs.','2023-11-12','2023-11-24','Aula A6 del campus UNPA-UARG',0,25,'cursoDefecto.jpg'),(36,'Curso x','dfghjk','todos los dias','2023-11-05','2023-11-25','fd',1,25,'cursoDefecto.jpg');
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `curso_integrante`
--

DROP TABLE IF EXISTS `curso_integrante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `curso_integrante` (
  `curso_id` int(11) NOT NULL,
  `integrante_id` int(11) NOT NULL,
  PRIMARY KEY (`curso_id`,`integrante_id`),
  KEY `fk_curso_has_integrante_integrante1_idx` (`integrante_id`),
  KEY `fk_curso_has_integrante_curso1_idx` (`curso_id`),
  CONSTRAINT `fk_curso_has_integrante_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`),
  CONSTRAINT `fk_curso_has_integrante_integrante1` FOREIGN KEY (`integrante_id`) REFERENCES `integrante` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso_integrante`
--

LOCK TABLES `curso_integrante` WRITE;
/*!40000 ALTER TABLE `curso_integrante` DISABLE KEYS */;
INSERT INTO `curso_integrante` VALUES (1,4),(1,5),(1,12),(2,5);
/*!40000 ALTER TABLE `curso_integrante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `curso_persona`
--

DROP TABLE IF EXISTS `curso_persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `curso_persona` (
  `curso_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  PRIMARY KEY (`curso_id`,`persona_id`),
  KEY `fk_curso_has_persona_persona1_idx` (`persona_id`),
  KEY `fk_curso_has_persona_curso1_idx` (`curso_id`),
  CONSTRAINT `fk_curso_has_persona_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`),
  CONSTRAINT `fk_curso_has_persona_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso_persona`
--

LOCK TABLES `curso_persona` WRITE;
/*!40000 ALTER TABLE `curso_persona` DISABLE KEYS */;
/*!40000 ALTER TABLE `curso_persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `direccion`
--

DROP TABLE IF EXISTS `direccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `direccion` (
  `País` varchar(100) NOT NULL,
  `Provincia` varchar(100) NOT NULL,
  `Localidad` varchar(100) NOT NULL,
  `CodPostal` varchar(45) NOT NULL,
  PRIMARY KEY (`CodPostal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `direccion`
--

LOCK TABLES `direccion` WRITE;
/*!40000 ALTER TABLE `direccion` DISABLE KEYS */;
INSERT INTO `direccion` VALUES ('Argentina','Santa Cruz','Río Gallegos','9400');
/*!40000 ALTER TABLE `direccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `integrante`
--

DROP TABLE IF EXISTS `integrante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `integrante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `dni` varchar(45) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `instituto` varchar(45) DEFAULT NULL,
  `categoriaDocente` varchar(45) DEFAULT NULL,
  `dedicacion` varchar(45) DEFAULT NULL,
  `categoriaExtensionista` varchar(100) DEFAULT NULL,
  `direccion` varchar(150) NOT NULL,
  `direccion_CodPostal` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `rol` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `organizacion` varchar(45) DEFAULT NULL,
  `funcion` varchar(100) DEFAULT NULL,
  `nivelEstudios` varchar(45) DEFAULT NULL,
  `ocupacion` varchar(100) DEFAULT NULL,
  `afeccionHorasSemanales` varchar(3) NOT NULL,
  `afeccionTotalHoras` varchar(6) NOT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `carrera_Cod` int(3) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_integrante_direccion1` (`direccion_CodPostal`),
  KEY `fk_integrante_tipo1` (`tipo_id`),
  KEY `fk_integrante_carrera1` (`carrera_Cod`),
  CONSTRAINT `fk_integrante_carrera1` FOREIGN KEY (`carrera_Cod`) REFERENCES `carrera` (`Cod`),
  CONSTRAINT `fk_integrante_direccion1` FOREIGN KEY (`direccion_CodPostal`) REFERENCES `direccion` (`CodPostal`),
  CONSTRAINT `fk_integrante_tipo1` FOREIGN KEY (`tipo_id`) REFERENCES `tipo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `integrante`
--

LOCK TABLES `integrante` WRITE;
/*!40000 ALTER TABLE `integrante` DISABLE KEYS */;
INSERT INTO `integrante` VALUES (4,'esteban','gesto','98765432','licenciado en sistemas','unpa uarg','categoria 1','docente','categoria 2','san martin N°1','9400','2966789654','Co-director','egestos@gmail.com','unpa-uarg','docente','universitario','docente','40','400',2,072),(5,'juancito','ejemplo','77777777','licenciado en sistemas','unpa uarg','categoria 1','docente','categoria 2','san martin N°1','9400','02966789654','Co-director','carlaglea3616@gmail.com','unpa-uarg','docente','universitario','docente','30','400',2,076),(12,'maria','perez','55555555','tecnica','','','','','san martin N°1','9400','02966123456','Integrante externo','maria@gmail.com','unpa-uarg','docente','universitario','docente','30','400',2,912);
/*!40000 ALTER TABLE `integrante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permiso`
--

DROP TABLE IF EXISTS `permiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permiso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ID_PERMISO_IND` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permiso`
--

LOCK TABLES `permiso` WRITE;
/*!40000 ALTER TABLE `permiso` DISABLE KEYS */;
INSERT INTO `permiso` VALUES (4,'Preinscriptos'),(5,'Integrantes'),(6,'Cursos'),(7,'Usuarios'),(8,'Roles'),(9,'Permisos'),(11,'Salir'),(12,'Ingresar');
/*!40000 ALTER TABLE `permiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `dni` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `pago` tinyint(4) DEFAULT NULL,
  `nota` varchar(45) DEFAULT NULL,
  `asistencia` varchar(45) DEFAULT NULL,
  `tipo_id` int(11) NOT NULL,
  `carrera_Cod` int(3) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_persona_tipo1_idx` (`tipo_id`),
  KEY `fk_persona_carrera1_idx` (`carrera_Cod`),
  CONSTRAINT `fk_persona_carrera1` FOREIGN KEY (`carrera_Cod`) REFERENCES `carrera` (`Cod`),
  CONSTRAINT `fk_persona_tipo1` FOREIGN KEY (`tipo_id`) REFERENCES `tipo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES (1,'carla','gleadell','carlagleadell2000@gmail.com','42428983','0',NULL,NULL,NULL,1,072),(3,'juancito','ejemplo','carlaglea3616@gmail.com','12345678','',NULL,NULL,NULL,2,093),(4,'pablo','lopez','pablolopez@gmail.com','98765432','',NULL,NULL,NULL,2,912);
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ID_ROL_IND` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (7,'Encargado Gestion Cursos'),(8,'Administrador');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol_permiso`
--

DROP TABLE IF EXISTS `rol_permiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rol_permiso` (
  `id_rol` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL,
  PRIMARY KEY (`id_rol`,`id_permiso`),
  UNIQUE KEY `ID_ROL_PERMISO_IND` (`id_permiso`,`id_rol`),
  KEY `FKASO_ROL_IND` (`id_rol`),
  KEY `FKASO_PER_idx` (`id_permiso`),
  CONSTRAINT `fk_rol_permiso_permiso` FOREIGN KEY (`id_permiso`) REFERENCES `permiso` (`id`),
  CONSTRAINT `fk_rol_permiso_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol_permiso`
--

LOCK TABLES `rol_permiso` WRITE;
/*!40000 ALTER TABLE `rol_permiso` DISABLE KEYS */;
INSERT INTO `rol_permiso` VALUES (7,4),(7,5),(7,6),(7,11),(7,12),(8,4),(8,5),(8,6),(8,7),(8,8),(8,9),(8,11),(8,12);
/*!40000 ALTER TABLE `rol_permiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo`
--

DROP TABLE IF EXISTS `tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo`
--

LOCK TABLES `tipo` WRITE;
/*!40000 ALTER TABLE `tipo` DISABLE KEYS */;
INSERT INTO `tipo` VALUES (1,'alumno'),(2,'docente'),(3,'no docente'),(4,'externo'),(5,'graduado');
/*!40000 ALTER TABLE `tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UN_USUARIO` (`email`,`nombre`),
  UNIQUE KEY `ID_USUARIO_IND` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (2,'Yohana Bahamonde','bahamondeyohana7@gmail.com'),(28,'Carla Ejemplo','carlagleadell2000@gmail.com'),(25,'Carla Gleadell','carlagleadell@gmail.com'),(4,'Eder Dos Santos','esantos@uarg.unpa.edu.ar'),(3,'Jose Martín Chuchuy ','martinj_76@hotmail.com');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_rol`
--

DROP TABLE IF EXISTS `usuario_rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario_rol` (
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  UNIQUE KEY `ID_USUARIO_ROL_IND` (`id_rol`,`id_usuario`),
  KEY `FKVIN_USU_IND` (`id_usuario`),
  KEY `FKVIN_ROL_idx` (`id_rol`),
  CONSTRAINT `fk_usuario_rol_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`),
  CONSTRAINT `fk_usuario_rol_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_rol`
--

LOCK TABLES `usuario_rol` WRITE;
/*!40000 ALTER TABLE `usuario_rol` DISABLE KEYS */;
INSERT INTO `usuario_rol` VALUES (2,7),(3,7),(4,7),(28,7),(25,8);
/*!40000 ALTER TABLE `usuario_rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'bdkiush'
--

--
-- Dumping routines for database 'bdkiush'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-05 15:53:23
