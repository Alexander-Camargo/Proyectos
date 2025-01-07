-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: bd_examen_ing_web
-- ------------------------------------------------------
-- Server version	9.1.0

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
-- Table structure for table `reservas`
--

DROP TABLE IF EXISTS `reservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservas` (
  `id_reserva` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `id_libro` int DEFAULT NULL,
  `fecha_entrega` datetime DEFAULT CURRENT_TIMESTAMP,
  `cantidad_reservada` int DEFAULT NULL,
  `estado_reserva` enum('reservado','devuelto') DEFAULT 'reservado',
  `fecha_devolucion` datetime DEFAULT NULL,
  PRIMARY KEY (`id_reserva`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_libro` (`id_libro`),
  CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservas`
--

LOCK TABLES `reservas` WRITE;
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
INSERT INTO `reservas` VALUES (7,1,1,'2024-11-26 21:03:11',1,'reservado','2024-12-02 10:00:00'),(8,4,1,'2024-11-26 21:03:11',1,'reservado','2024-12-03 10:00:00'),(9,3,2,'2024-11-26 21:03:11',1,'reservado','2024-12-04 11:00:00'),(10,4,2,'2024-11-26 21:03:11',1,'reservado','2024-12-05 11:00:00'),(11,4,3,'2024-11-26 21:03:11',1,'reservado','2024-12-06 12:00:00'),(12,1,3,'2024-11-26 21:03:11',1,'reservado','2024-12-07 12:00:00'),(13,3,4,'2024-11-26 21:03:11',1,'reservado','2024-12-02 14:00:00'),(14,1,4,'2024-11-26 21:03:11',1,'reservado','2024-12-03 14:00:00'),(15,3,5,'2024-11-26 21:03:11',1,'reservado','2024-12-04 15:00:00'),(16,4,5,'2024-11-26 21:03:11',1,'reservado','2024-12-05 15:00:00'),(17,3,6,'2024-11-26 21:03:11',1,'reservado','2024-12-06 16:00:00'),(18,4,6,'2024-11-26 21:03:11',1,'reservado','2024-12-07 16:00:00'),(22,1,1,'2024-10-10 00:00:00',1,'reservado',NULL),(23,4,1,'2024-10-10 00:00:00',1,'reservado',NULL),(24,3,1,'2024-10-10 00:00:00',1,'reservado',NULL),(25,4,5,'2024-10-10 00:00:00',1,'reservado',NULL),(26,1,1,'2024-11-26 22:20:27',1,'reservado',NULL),(29,1,2,'2024-11-26 22:33:44',1,'reservado',NULL),(30,1,2,'2024-11-26 22:33:45',1,'reservado',NULL);
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-27  0:58:38
