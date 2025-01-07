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
-- Table structure for table `libros`
--

DROP TABLE IF EXISTS `libros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `libros` (
  `id_libro` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `autor` varchar(100) DEFAULT NULL,
  `editorial` varchar(100) DEFAULT NULL,
  `anio` year DEFAULT NULL,
  `categoria_id` int DEFAULT NULL,
  `unidades_disponibles` int DEFAULT NULL,
  `fecha_publicacion` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_libro`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libros`
--

LOCK TABLES `libros` WRITE;
/*!40000 ALTER TABLE `libros` DISABLE KEYS */;
INSERT INTO `libros` VALUES (1,'Cien años de soledad','Gabriel García Márquez','Editorial Sudamericana',1967,1,499,'2024-11-26 18:46:49'),(2,'El hombre en el castillo','Philip K. Dick','Penguin Random House',1962,2,498,'2024-11-26 18:46:52'),(3,'1984','George Orwell','Secker & Warburg',1949,2,3333,'2024-11-26 19:07:59'),(4,'Matar a un ruiseñor','Harper Lee','J.B. Lippincott & Co.',1960,1,111,'2024-11-26 19:18:46'),(5,'Don Quijote de la Mancha','Miguel de Cervantes','Editorial Espasa',1905,1,2323,'2024-11-26 19:18:56'),(6,'El camino de los reyes','Brandon Sanderson','Tor Books',2010,7,4242,'2024-11-26 19:19:09'),(7,'El senor de los anillos','J. R. R. Tolkien','George Allen &amp; Unwin HarperCollins',1954,7,401,'2024-11-27 00:22:46'),(9,'El principito','Antoine de Saint-Exupery','Editorial Salamandra',1943,7,757,'2024-11-27 00:28:24'),(10,'Fahrenheit 451','Ray Bradbury','Editorial Minotauro',1953,7,666,'2024-11-27 00:28:55'),(11,'La sombra del viento','Carlos Ruiz Zafon','Editorial Planeta',2001,7,879,'2024-11-27 00:29:26'),(12,'La metamorfosis','Franz Kafka','Editorial Alianza',1915,7,777,'2024-11-27 00:30:20'),(14,'Las dos torres','J.R.R. Tolkien','Allen &amp; Unwin',1954,7,900,'2024-11-27 00:48:33'),(15,'El retorno del rey','J.R.R. Tolkien','Allen &amp; Unwin',1955,5,456,'2024-11-27 00:51:03');
/*!40000 ALTER TABLE `libros` ENABLE KEYS */;
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
