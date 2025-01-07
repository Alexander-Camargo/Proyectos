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
-- Table structure for table `imagenes_libros`
--

DROP TABLE IF EXISTS `imagenes_libros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `imagenes_libros` (
  `id_imagen` int NOT NULL AUTO_INCREMENT,
  `id_libro` int DEFAULT NULL,
  `ruta_imagen` text,
  PRIMARY KEY (`id_imagen`),
  KEY `id_libro` (`id_libro`),
  CONSTRAINT `imagenes_libros_ibfk_1` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagenes_libros`
--

LOCK TABLES `imagenes_libros` WRITE;
/*!40000 ALTER TABLE `imagenes_libros` DISABLE KEYS */;
INSERT INTO `imagenes_libros` VALUES (1,1,'../../Public/Assets/imagenes/img_libros/libro_6746af6d6a0e59.66247415.png'),(2,2,'../../Public/Assets/imagenes/img_libros/libro_6746aedf506c81.64844094.png'),(3,6,'../../Public/Assets/imagenes/img_libros/libro_674670dfc8d816.66468771.png'),(4,7,'../../Public/Assets/imagenes/img_libros/libro_6746acf6753111.34162595.png'),(6,3,'../../Public/Assets/imagenes/img_libros/libro_6746af142cf625.19981932.png'),(8,4,'../../Public/Assets/imagenes/img_libros/libro_6746b0da30d183.27772955.png'),(9,5,'../../Public/Assets/imagenes/img_libros/libro_6746b10f79a0e1.69399886.png'),(10,9,'../../Public/Assets/imagenes/img_libros/libro_6746b1cd89b906.32719210.png'),(11,10,'../../Public/Assets/imagenes/img_libros/libro_6746b1f4e456d1.76811244.png'),(12,11,'../../Public/Assets/imagenes/img_libros/libro_6746b229d62fe7.20004119.png'),(13,12,'../../Public/Assets/imagenes/img_libros/libro_6746b25b904fd1.73863733.png'),(14,14,'../../Public/Assets/imagenes/img_libros/libro_6746b2e89ff9d0.86162690.png'),(15,15,'../../Public/Assets/imagenes/img_libros/libro_6746b4df3c8ba4.03458831.png');
/*!40000 ALTER TABLE `imagenes_libros` ENABLE KEYS */;
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
