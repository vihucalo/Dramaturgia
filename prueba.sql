-- MariaDB dump 10.19  Distrib 10.4.19-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: prueba
-- ------------------------------------------------------
-- Server version	10.4.19-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `listaautores`
--

DROP TABLE IF EXISTS `listaautores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `listaautores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_obra` varchar(255) DEFAULT NULL,
  `autor` varchar(50) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `femenino` varchar(50) DEFAULT NULL,
  `masculino` varchar(50) DEFAULT NULL,
  `otros` varchar(50) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `descargas` int(11) NOT NULL DEFAULT 0,
  `url_doc` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `listaautores`
--

LOCK TABLES `listaautores` WRITE;
/*!40000 ALTER TABLE `listaautores` DISABLE KEYS */;
INSERT INTO `listaautores` VALUES (1,'El consuelo','Luis Carlos Castro','Colombia','2','4','0','representativo',2,'https://drive.google.com/uc?id=1ytGLMbTpKN9X6HyGoRk9h9saP2qOvoHI&export=download'),(2,'Los Rodríguez','Nicolás Neita','Colombia','3','5','0','representativo',1,'https://drive.google.com/uc?id=17JXD3dMsq7Mo9ELOhjRHOHAtk7Q4uszy&export=download'),(3,'La tabla de Luciana','Ana Elvira Mejía','Colombia','1','2','0','representativo',0,'https://drive.google.com/uc?id=1EaoeFQMwrDuqyLa-4ALCgjCX2uEe9nO8&export=download'),(4,'Coleccionista de bestias','Andrea Marín Arcila','Colombia','5','2','0','representativo',0,'https://drive.google.com/uc?id=1ZFi5E0xQJuT9WCZX7tGGIRWsVzQPi9jh&export=download'),(5,'El color de las palabras palidece','Mauricio Lazo Castañeda','Colombia','1','1','0','representativo',0,'https://drive.google.com/uc?id=1xHPYsG4DP9uVOQ50nHep3pboWYlG9oSS&export=download'),(6,'Cocos nucífera','Jessica Yuliana Sánchez Garzón','Colombia','1','1','0','representativo',0,'https://drive.google.com/uc?id=1kisKJNmah4mN3to7WeMPa_eqO9AMNSVd&export=download'),(7,'Ilumina mi divina tina','Juan Pablo Villamil','Colombia','1','1','0','repositorio',0,'https://drive.google.com/uc?id=1VTEO788OZlfEuYf7n5AuIkBd5TIMilo1&export=download'),(8,'De doble filo','Anngie Lorena Panesso Garcia','Colombia','2','0','0','repositorio',0,'https://drive.google.com/uc?id=1-C4YabLSdB4dsIrK8ipBs1VAn6S3whFM&export=download');
/*!40000 ALTER TABLE `listaautores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-29  6:53:20
