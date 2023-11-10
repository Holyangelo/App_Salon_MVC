-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: localhost    Database: barbershop
-- ------------------------------------------------------
-- Server version	8.1.0

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
-- Table structure for table `citas`
--

DROP TABLE IF EXISTS `citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `citas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `usuarioId` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuarioId` (`usuarioId`),
  CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`usuarioId`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` VALUES (1,'2023-11-15','14:03:00',10),(2,'2023-11-15','14:03:00',10),(3,'2023-11-15','16:03:00',10),(4,'2023-11-15','16:05:00',10),(5,'2023-11-14','15:21:00',10),(6,'2023-11-15','16:27:00',10),(7,'2023-11-23','15:39:00',10),(8,'2023-11-16','15:41:00',10),(9,'2023-11-14','15:49:00',10),(10,'2023-11-14','15:49:00',10),(11,'2023-11-14','15:49:00',10),(12,'2023-11-14','15:49:00',10),(13,'2023-11-14','15:49:00',10),(14,'2023-11-14','15:49:00',10),(15,'2023-11-14','15:49:00',10),(16,'2023-11-14','15:49:00',10),(17,'2023-11-29','15:50:00',10),(18,'2023-11-14','15:51:00',10),(19,'2023-11-13','15:51:00',10),(20,'2023-11-14','15:56:00',10),(21,'2023-11-17','15:56:00',10),(22,'2023-11-13','16:48:00',10),(23,'2023-11-21','09:06:00',10),(24,'2023-11-14','16:18:00',10);
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `citas_servicios`
--

DROP TABLE IF EXISTS `citas_servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `citas_servicios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `citasId` int DEFAULT NULL,
  `serviciosId` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `citasId` (`citasId`),
  KEY `serviciosId` (`serviciosId`),
  CONSTRAINT `citas_servicios_ibfk_1` FOREIGN KEY (`citasId`) REFERENCES `citas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `citas_servicios_ibfk_2` FOREIGN KEY (`serviciosId`) REFERENCES `servicios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas_servicios`
--

LOCK TABLES `citas_servicios` WRITE;
/*!40000 ALTER TABLE `citas_servicios` DISABLE KEYS */;
/*!40000 ALTER TABLE `citas_servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicios`
--

DROP TABLE IF EXISTS `servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `precio` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios`
--

LOCK TABLES `servicios` WRITE;
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT INTO `servicios` VALUES (1,'corte caballero',20.00),(2,'corte dama',30.00),(3,'corte niño',30.00);
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telefono` varchar(14) NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `confirmado` tinyint(1) DEFAULT '0',
  `token` varchar(15) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `creado` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,' Osmant','Sallath','osmsallath@gmail.com','+584146441588',0,0,'6522fa8d07850','$2y$10$2y.1LN7JSy8qMdLrAF974OXsC20bHGrF5LYnEm2sBDZgMt95RKpV2','2023-10-08 14:53:01'),(2,' Osmant','Sallath','osmantsallath@gmail.com','+584146441588',0,0,'6522fdb6588a3','$2y$10$V7ZViJIyA3c4s.oHJXgDLuObAYnifKBUoRM39/Y3S1./MybL6KJXy','2023-10-08 15:06:30'),(3,' Osmant','Sallath','admin@realstate.com','+584146441588',0,0,'65230269d7ecb','$2y$10$8qelusg5SteYS1nH3pAI/.QH53WcsNvbEWtvmRIkHhAtpYPnpHyx6','2023-10-08 15:26:35'),(4,' Osmant','Sallath','tcdprotocol@gmail.com','+584146441588',0,0,'6523037713767','$2y$10$oNIePi8Zh3Lno5E9NZt3C.oVGQUnJ1P9S742r421Tu4hpuJJZgiKS','2023-10-08 15:31:04'),(5,' Osmant','Sallath','deezerpacc@gmail.com','+584146441588',0,0,'652307304661d','$2y$10$L5ngQD3aUpdoYfKAjVIbNOqVW7ke/K27MTDS52jYagVKOBTN8cv2C','2023-10-08 15:46:58'),(6,' Osmant','Sallath','mydreamsmusicmind@gmail.com','+584146441588',0,1,'','$2y$10$wSmQeUAQcrO/0bf1Zfp5cOPa.6oi4qTbDwbtLyzeyYmKiLt5Rs3le','2023-10-08 15:48:15'),(7,' Osmant','Sallath','osmurdaneta@gmail.com','+584146441588',0,0,'65230bc3e2ecd','$2y$10$GaGgIxehTkU.huWwotTK3eo5aA9G3HjWWB/a0Ofl6INtd9gRduDKq','2023-10-08 16:06:29'),(8,' Osmant','Sallath','ignistergaming@gmail.com','+584146441588',1,1,'','$2y$10$zy/8DVvcl5PaMM2DSL3WO.hCg7uNv.PoDgJGDjCFlhuGKLI6eep3O','2023-10-08 16:08:08'),(9,' Osmant','Sallath','dreamsofdeveloper@gmail.com','+584146441588',0,1,'','$2y$10$.NdUIS2d5bK6ou7cwK6ySOT8qdn7TSqzo9Cziy06HDds5suTjCKW2','2023-10-08 16:09:36'),(10,' Osmant','Sallath','ignistechcorp@gmail.com','+584146441588',0,1,'','$2y$10$EEcGNnbwvLI3L83Y1GfjcOXVFIAVbEDakqKRKQ.fdnjPz3GjCCmnG','2023-10-08 16:38:57'),(11,' Osmant','Sallath','archangelsariel1992@gmail.com','+584146441588',0,1,'','$2y$10$KcfX2RvSBHaaI9df.bg1juRZugZnFiYaafRZ0fqtb2iELDHOLRbFq','2023-10-08 17:26:32');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'barbershop'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-10 19:01:21
