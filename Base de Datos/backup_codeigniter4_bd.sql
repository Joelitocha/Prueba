-- MySQL dump 10.13  Distrib 8.0.42, for Linux (x86_64)
--
-- Host: localhost    Database: codeigniter4_bd
-- ------------------------------------------------------
-- Server version	8.0.42-0ubuntu0.24.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `componente_seguridad`
--

DROP TABLE IF EXISTS `componente_seguridad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `componente_seguridad` (
  `ID_Componente` int NOT NULL AUTO_INCREMENT,
  `Tipo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Modelo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Activo` tinyint(1) NOT NULL,
  `ID_Sistema` int DEFAULT NULL,
  PRIMARY KEY (`ID_Componente`),
  KEY `ID_Sistema` (`ID_Sistema`),
  CONSTRAINT `componente_seguridad_ibfk_1` FOREIGN KEY (`ID_Sistema`) REFERENCES `sistema_seguridad` (`ID_Sistema`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `componente_seguridad`
--

LOCK TABLES `componente_seguridad` WRITE;
/*!40000 ALTER TABLE `componente_seguridad` DISABLE KEYS */;
/*!40000 ALTER TABLE `componente_seguridad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresa` (
  `id_empresa` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` VALUES (1,'RackON S.A.'),(2,'SeguriTech SRL');
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimiento`
--

DROP TABLE IF EXISTS `movimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movimiento` (
  `ID_Movimiento` int NOT NULL AUTO_INCREMENT,
  `Fecha_Hora` datetime NOT NULL,
  `Tipo_Movimiento` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Alarma_Activada` tinyint(1) NOT NULL,
  `ID_Rack` int DEFAULT NULL,
  PRIMARY KEY (`ID_Movimiento`),
  KEY `ID_Rack` (`ID_Rack`),
  CONSTRAINT `movimiento_ibfk_1` FOREIGN KEY (`ID_Rack`) REFERENCES `rack` (`ID_Rack`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimiento`
--

LOCK TABLES `movimiento` WRITE;
/*!40000 ALTER TABLE `movimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `movimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rack`
--

DROP TABLE IF EXISTS `rack`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rack` (
  `ID_Rack` int NOT NULL AUTO_INCREMENT,
  `Ubicacion` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID_Rack`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rack`
--

LOCK TABLES `rack` WRITE;
/*!40000 ALTER TABLE `rack` DISABLE KEYS */;
INSERT INTO `rack` VALUES (1,'Puerto Madero',1);
/*!40000 ALTER TABLE `rack` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registro_acceso_rf`
--

DROP TABLE IF EXISTS `registro_acceso_rf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registro_acceso_rf` (
  `ID_Acceso` int NOT NULL AUTO_INCREMENT,
  `Fecha_Hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Resultado` tinyint(1) DEFAULT NULL,
  `Accion_Tomada` varchar(100) DEFAULT NULL,
  `Archivo_Video` varchar(255) DEFAULT NULL,
  `Ubicacion_Camara` varchar(100) DEFAULT NULL,
  `ID_Sistema` int DEFAULT NULL,
  `ID_Tarjeta` int DEFAULT NULL,
  PRIMARY KEY (`ID_Acceso`)
) ENGINE=InnoDB AUTO_INCREMENT=407 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro_acceso_rf`
--

LOCK TABLES `registro_acceso_rf` WRITE;
/*!40000 ALTER TABLE `registro_acceso_rf` DISABLE KEYS */;
INSERT INTO `registro_acceso_rf` VALUES (301,'2025-06-13 12:02:29',1,NULL,NULL,NULL,NULL,44),(302,'2025-06-13 12:02:37',0,NULL,NULL,NULL,NULL,45),(303,'2025-06-13 12:02:40',0,NULL,NULL,NULL,NULL,43),(304,'2025-06-13 12:39:52',1,NULL,NULL,NULL,NULL,44),(305,'2025-06-13 12:40:01',0,NULL,NULL,NULL,NULL,45),(306,'2025-06-13 12:40:06',1,NULL,NULL,NULL,NULL,42),(307,'2025-06-13 12:40:18',1,NULL,NULL,NULL,NULL,44),(308,'2025-06-13 12:48:09',1,NULL,NULL,NULL,NULL,42),(309,'2025-06-19 15:57:37',1,NULL,NULL,NULL,NULL,44),(310,'2025-06-19 15:57:47',0,NULL,NULL,NULL,NULL,45),(311,'2025-06-19 15:57:51',1,NULL,NULL,NULL,NULL,44),(312,'2025-06-19 16:39:18',1,NULL,NULL,NULL,NULL,44),(313,'2025-06-19 16:39:29',1,NULL,NULL,NULL,NULL,42),(314,'2025-06-19 16:39:41',0,NULL,NULL,NULL,NULL,45),(315,'2025-06-19 16:40:17',0,NULL,NULL,NULL,NULL,43),(316,'2025-06-19 16:40:22',1,NULL,NULL,NULL,NULL,42),(317,'2025-06-19 16:40:31',1,NULL,NULL,NULL,NULL,42),(318,'2025-06-19 16:40:36',1,NULL,NULL,NULL,NULL,42),(319,'2025-06-19 16:40:42',1,NULL,NULL,NULL,NULL,44),(320,'2025-06-19 16:40:52',0,NULL,NULL,NULL,NULL,43),(321,'2025-06-19 17:45:29',1,NULL,NULL,NULL,NULL,44),(322,'2025-06-19 17:45:38',0,NULL,NULL,NULL,NULL,43),(323,'2025-06-19 17:45:42',0,NULL,NULL,NULL,NULL,45),(324,'2025-06-19 17:45:47',1,NULL,NULL,NULL,NULL,42),(325,'2025-06-19 17:56:30',1,NULL,NULL,NULL,NULL,42),(326,'2025-06-19 17:56:35',0,NULL,NULL,NULL,NULL,43),(327,'2025-06-19 17:56:40',1,NULL,NULL,NULL,NULL,42),(328,'2025-06-27 11:01:35',1,NULL,NULL,NULL,NULL,44),(329,'2025-06-27 11:01:48',0,NULL,NULL,NULL,NULL,45),(330,'2025-06-27 11:02:08',0,NULL,NULL,NULL,NULL,45),(331,'2025-06-27 11:02:12',1,NULL,NULL,NULL,NULL,42),(332,'2025-06-27 11:02:25',1,NULL,NULL,NULL,NULL,42),(333,'2025-06-27 11:02:36',0,NULL,NULL,NULL,NULL,45),(334,'2025-06-27 11:03:55',0,NULL,NULL,NULL,NULL,43),(335,'2025-06-27 11:04:02',0,NULL,NULL,NULL,NULL,43),(336,'2025-06-27 11:04:08',1,NULL,NULL,NULL,NULL,44),(337,'2025-06-27 11:04:15',1,NULL,NULL,NULL,NULL,44),(338,'2025-06-27 11:04:20',0,NULL,NULL,NULL,NULL,43),(339,'2025-06-27 11:20:36',1,NULL,NULL,NULL,NULL,42),(340,'2025-06-27 11:20:51',1,NULL,NULL,NULL,NULL,42),(341,'2025-06-27 11:20:59',1,NULL,NULL,NULL,NULL,42),(342,'2025-06-27 11:21:46',1,NULL,NULL,NULL,NULL,42),(343,'2025-06-27 11:21:55',1,NULL,NULL,NULL,NULL,44),(344,'2025-06-27 11:22:04',1,NULL,NULL,NULL,NULL,44),(345,'2025-06-27 11:22:13',1,NULL,NULL,NULL,NULL,44),(346,'2025-06-27 11:22:46',1,NULL,NULL,NULL,NULL,44),(347,'2025-06-27 11:22:54',1,NULL,NULL,NULL,NULL,42),(348,'2025-06-27 11:23:06',0,NULL,NULL,NULL,NULL,43),(349,'2025-06-27 11:23:11',0,NULL,NULL,NULL,NULL,43),(350,'2025-06-27 11:23:17',1,NULL,NULL,NULL,NULL,42),(351,'2025-06-27 11:26:20',1,NULL,NULL,NULL,NULL,44),(352,'2025-06-27 11:26:26',0,NULL,NULL,NULL,NULL,43),(353,'2025-06-27 11:26:30',1,NULL,NULL,NULL,NULL,44),(354,'2025-06-27 11:30:09',1,NULL,NULL,NULL,NULL,44),(355,'2025-06-27 11:30:15',0,NULL,NULL,NULL,NULL,43),(356,'2025-06-27 14:39:58',1,NULL,NULL,NULL,NULL,42),(357,'2025-06-27 14:40:19',1,NULL,NULL,NULL,NULL,44),(358,'2025-06-27 14:40:25',1,NULL,NULL,NULL,NULL,44),(359,'2025-06-27 14:40:32',0,NULL,NULL,NULL,NULL,43),(360,'2025-06-27 14:40:46',1,NULL,NULL,NULL,NULL,44),(361,'2025-06-27 14:41:07',1,NULL,NULL,NULL,NULL,42),(362,'2025-06-27 14:41:21',1,NULL,NULL,NULL,NULL,42),(363,'2025-06-27 14:41:26',1,NULL,NULL,NULL,NULL,42),(364,'2025-06-27 14:41:32',1,NULL,NULL,NULL,NULL,42),(365,'2025-06-27 14:41:40',1,NULL,NULL,NULL,NULL,42),(366,'2025-06-27 14:41:55',1,NULL,NULL,NULL,NULL,42),(367,'2025-06-27 14:42:00',1,NULL,NULL,NULL,NULL,42),(368,'2025-06-27 14:42:06',1,NULL,NULL,NULL,NULL,42),(369,'2025-06-27 14:42:15',1,NULL,NULL,NULL,NULL,42),(370,'2025-06-27 14:42:26',1,NULL,NULL,NULL,NULL,42),(371,'2025-06-27 14:42:32',1,NULL,NULL,NULL,NULL,42),(372,'2025-06-27 14:42:39',1,NULL,NULL,NULL,NULL,42),(373,'2025-07-22 14:40:55',1,NULL,NULL,NULL,NULL,44),(374,'2025-07-22 14:41:21',1,NULL,NULL,NULL,NULL,44),(375,'2025-07-22 14:41:33',1,NULL,NULL,NULL,NULL,44),(376,'2025-07-22 14:42:05',1,NULL,NULL,NULL,NULL,44),(377,'2025-07-22 14:42:21',0,NULL,NULL,NULL,NULL,45),(378,'2025-07-22 14:43:11',1,NULL,NULL,NULL,NULL,42),(379,'2025-07-22 14:43:32',1,NULL,NULL,NULL,NULL,44),(380,'2025-07-22 14:44:27',1,NULL,NULL,NULL,NULL,44),(381,'2025-07-22 14:44:48',1,NULL,NULL,NULL,NULL,44),(382,'2025-07-22 14:45:05',1,NULL,NULL,NULL,NULL,44),(383,'2025-07-22 14:45:24',1,NULL,NULL,NULL,NULL,44),(384,'2025-07-22 15:05:20',0,NULL,NULL,NULL,NULL,43),(385,'2025-07-22 15:05:24',1,NULL,NULL,NULL,NULL,44),(386,'2025-07-22 15:35:11',0,NULL,NULL,NULL,NULL,43),(387,'2025-07-22 15:37:05',1,NULL,NULL,NULL,NULL,44),(388,'2025-07-22 15:37:22',0,NULL,NULL,NULL,NULL,45),(389,'2025-07-22 15:37:29',1,NULL,NULL,NULL,NULL,42),(390,'2025-07-22 15:37:38',1,NULL,NULL,NULL,NULL,42),(391,'2025-07-22 15:39:12',1,NULL,NULL,NULL,NULL,42),(392,'2025-07-22 15:51:32',1,NULL,NULL,NULL,NULL,44),(393,'2025-07-22 16:09:48',1,NULL,NULL,NULL,NULL,44),(394,'2025-07-22 16:10:35',1,NULL,NULL,NULL,NULL,44),(395,'2025-07-22 16:10:52',1,NULL,NULL,NULL,NULL,44),(396,'2025-07-24 11:05:57',1,NULL,NULL,NULL,NULL,44),(397,'2025-07-24 11:06:04',1,NULL,NULL,NULL,NULL,44),(398,'2025-07-25 11:06:03',1,NULL,NULL,NULL,NULL,44),(399,'2025-07-25 11:06:08',0,NULL,NULL,NULL,NULL,45),(400,'2025-07-25 11:06:11',0,NULL,NULL,NULL,NULL,43),(401,'2025-07-25 11:06:21',1,NULL,NULL,NULL,NULL,42),(402,'2025-07-25 11:35:27',1,NULL,NULL,NULL,NULL,44),(403,'2025-07-25 14:11:24',1,NULL,NULL,NULL,NULL,42),(404,'2025-07-25 14:11:28',1,NULL,NULL,NULL,NULL,44),(405,'2025-07-25 14:11:33',0,NULL,NULL,NULL,NULL,43),(406,'2025-07-25 14:11:36',0,NULL,NULL,NULL,NULL,45);
/*!40000 ALTER TABLE `registro_acceso_rf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rol` (
  `ID_Rol` int NOT NULL AUTO_INCREMENT,
  `N_Rol` enum('Administrador','Supervisor','Usuario') COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID_Rol`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (5,'Administrador'),(6,'Supervisor'),(7,'Usuario');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sistema_seguridad`
--

DROP TABLE IF EXISTS `sistema_seguridad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sistema_seguridad` (
  `ID_Sistema` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Nivel` smallint NOT NULL,
  `codevin` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8mb4_general_ci DEFAULT 'activo',
  `usuario_id` int DEFAULT NULL,
  `ID_Rack` int DEFAULT NULL,
  `creado_en` datetime DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `direccion_ip` varchar(80) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID_Sistema`),
  KEY `ID_Rack` (`ID_Rack`),
  CONSTRAINT `sistema_seguridad_ibfk_1` FOREIGN KEY (`ID_Rack`) REFERENCES `rack` (`ID_Rack`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sistema_seguridad`
--

LOCK TABLES `sistema_seguridad` WRITE;
/*!40000 ALTER TABLE `sistema_seguridad` DISABLE KEYS */;
INSERT INTO `sistema_seguridad` VALUES (11,'Gordos Minecraft',1,'00:1e:c2:9e:28:6b','activo',8,1,'2025-07-22 13:07:19','2025-07-27 02:47:59',NULL),(12,'fofo',1,'hhh','activo',73,1,'2025-07-29 13:35:26','2025-07-29 13:35:26',NULL);
/*!40000 ALTER TABLE `sistema_seguridad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tarjeta_acceso`
--

DROP TABLE IF EXISTS `tarjeta_acceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tarjeta_acceso` (
  `ID_Tarjeta` int NOT NULL AUTO_INCREMENT,
  `Estado` tinyint(1) NOT NULL,
  `Fecha_emision` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Fecha_Expiracion` date DEFAULT NULL,
  `Intentos_Fallidos` int DEFAULT '0',
  `Horario_Uso` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `UID` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_empresa` int DEFAULT NULL,
  PRIMARY KEY (`ID_Tarjeta`),
  KEY `fk_tarjeta_empresa` (`id_empresa`),
  CONSTRAINT `fk_tarjeta_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarjeta_acceso`
--

LOCK TABLES `tarjeta_acceso` WRITE;
/*!40000 ALTER TABLE `tarjeta_acceso` DISABLE KEYS */;
INSERT INTO `tarjeta_acceso` VALUES (42,1,'2025-06-15 03:00:00',NULL,0,NULL,'0x352d930289 ',1),(43,0,'2025-06-15 03:00:00',NULL,0,NULL,'0x839df72cc5',1),(44,1,'2025-06-15 03:00:00',NULL,0,NULL,'0x2a6a991ac3',2),(45,0,'2025-06-15 03:00:00',NULL,0,NULL,'0xaa12e080d8',2);
/*!40000 ALTER TABLE `tarjeta_acceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `ID_Usuario` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `Contraseña` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Ultimo_Acceso` datetime DEFAULT NULL,
  `ID_Rol` int DEFAULT NULL,
  `ID_Tarjeta` int DEFAULT NULL,
  `Token` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Verificado` tinyint(1) DEFAULT '0',
  `id_empresa` int DEFAULT NULL,
  PRIMARY KEY (`ID_Usuario`),
  KEY `ID_Rol` (`ID_Rol`),
  KEY `ID_Tarjeta` (`ID_Tarjeta`),
  KEY `fk_usuario_empresa` (`id_empresa`),
  CONSTRAINT `fk_usuario_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`ID_Rol`) REFERENCES `rol` (`ID_Rol`),
  CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`ID_Tarjeta`) REFERENCES `tarjeta_acceso` (`ID_Tarjeta`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (8,'Joel Martinez Vilche','$2y$10$GQirBH.eUWP1/pUFQsqDZeQmmHANI3sdeL4rng.67xzO68KMhYm52','Joel@gmail.com','2025-08-01 08:31:00',5,42,NULL,1,1),(53,'Santiago Salgado','$2y$10$FAGrp06tOb/XoEIuEE0l.eSz3HzPX.oCCHEFEy0z86x2TZeK6dEbi','santiagosalgado@alumnos.itr3.edu.ar','2025-07-29 09:57:41',6,44,NULL,1,2),(58,'Federico Arias','$2y$10$217lVXP.GQnSpDNRPEmYCuvoZyC.cAwi7cenn1kZmwOsH1bSUZc2O','federicoarias@alumnos.itr3.edu.ar','2025-07-29 10:07:26',5,43,NULL,1,1),(72,'ariasfedericoadrian@gmail.com','$2y$10$2EhEQ4saEr8bpddGAdenK.8mnbni7PEvKkg4qXomOgPimZks.xB5C','ariasfedericoadrian@gmail.com','2025-07-25 09:03:52',5,43,NULL,1,1),(73,'Catriel Garay','$2y$10$08WLtA2YWT3/W0GvnCUgI.hVQB1wCAb/gYW.bPSZkJFljA7xokS7S','catrielgaray@alumnos.itr3.edu.ar','2025-07-29 13:21:42',5,45,NULL,1,2),(74,'Federico Arias','$2y$10$W6oG/GBp3nXYVWqwV7CWg.PEcNQsDJKc0KFhSF5yuHrsfvkFciev6','tpbgeorge2025@gmail.com','2025-07-29 09:47:57',5,44,NULL,1,2);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-01  8:33:55
