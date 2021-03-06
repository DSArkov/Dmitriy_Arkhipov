-- MySQL dump 10.13  Distrib 8.0.13, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: cities_les1
-- ------------------------------------------------------
-- Server version	8.0.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `cities` (
  `id_city` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `district` varchar(75) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city_name` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_city`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,1,1,'','Донецк'),(2,1,1,NULL,'Макеевка'),(3,1,1,NULL,'Краматорск'),(4,1,1,NULL,'Константиновка'),(5,1,2,NULL,'Харьков'),(6,1,2,'Изюмский район','Изюм'),(7,1,3,NULL,'Днепропетровск'),(8,1,3,'Криворожский район','Кривой Рог'),(9,1,3,NULL,'Павлоград'),(10,1,4,NULL,'Киев'),(11,1,4,NULL,'Припять'),(12,1,4,NULL,'Борисполь'),(13,1,5,NULL,'Одесса'),(14,1,5,'Измаильский район','Измаил'),(15,2,6,NULL,'Самара'),(16,2,6,'Ставропольский район','Тольятти'),(17,2,6,'Сызранский муниципальный район','Сызрань'),(18,2,7,NULL,'Краснодар'),(19,2,7,NULL,'Анапа'),(20,2,7,'Адлерский район Сочи','Адлер'),(21,2,8,NULL,'Пермь'),(22,2,8,'Краснокамский район','Краснокамск'),(23,2,9,NULL,'Волгоград'),(24,2,9,NULL,'Волжский'),(25,2,10,NULL,'Санкт-петербург'),(26,2,10,'Петродворцовский район города федерального значения Санкт-Петербурга','Петергоф'),(27,2,11,NULL,'Москва'),(28,2,11,NULL,'Домодедово'),(29,2,11,NULL,'Мытищи'),(30,3,12,NULL,'Минск'),(31,3,12,'Борисовский район','Борисов'),(32,3,13,NULL,'Брест '),(33,3,13,'Ляховичский район','Ляховичи'),(34,3,14,NULL,'Могилёв'),(35,3,14,'Бобруйский район','Бобруйск');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-12 14:02:02
