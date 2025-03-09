-- MySQL dump 10.13  Distrib 8.0.41, for macos15 (x86_64)
--
-- Host: localhost    Database: spirit11
-- ------------------------------------------------------
-- Server version	8.0.35

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
-- Table structure for table `players`
--

DROP TABLE IF EXISTS `players`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `players` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `university` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_runs` int NOT NULL DEFAULT '0',
  `balls_faced` int NOT NULL DEFAULT '0',
  `innings_played` int NOT NULL DEFAULT '0',
  `wickets` int NOT NULL DEFAULT '0',
  `overs_bowled` double NOT NULL DEFAULT '0',
  `runs_conceded` int NOT NULL DEFAULT '0',
  `points` decimal(10,2) DEFAULT NULL,
  `value` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `players`
--

LOCK TABLES `players` WRITE;
/*!40000 ALTER TABLE `players` DISABLE KEYS */;
INSERT INTO `players` VALUES (1,'Chamika Chandimal','University of the Visual & Performing Arts','Batsman',530,588,10,0,3,21,563.76,5200000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(2,'Dimuth Dhananjaya','University of the Visual & Performing Arts','All-Rounder',250,208,10,8,40,240,64.59,700000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(3,'Avishka Mendis','Eastern University','All-Rounder',210,175,7,7,35,210,68.56,700000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(4,'Danushka Kumara','University of the Visual & Performing Arts','Batsman',780,866,15,0,5,35,562.95,5200000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(5,'Praveen Vandersay','Eastern University','Batsman',329,365,7,0,3,24,558.54,5100000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(6,'Niroshan Mathews','University of the Visual & Performing Arts','Batsman',275,305,5,0,2,18,564.63,5200000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(7,'Chaturanga Gunathilaka','University of Moratuwa','Bowler',132,264,11,29,88,528,50.95,600000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(8,'Lahiru Rathnayake','University of Ruhuna','Batsman',742,824,14,0,1,8,563.33,5200000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(9,'Jeewan Thirimanne','University of Jaffna','Batsman',780,866,15,0,3,24,562.53,5200000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(10,'Kalana Samarawickrama','Eastern University','Batsman',728,808,14,0,4,32,562.54,5200000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(11,'Lakshan Vandersay','University of the Visual & Performing Arts','All-Rounder',405,337,15,15,75,450,66.19,700000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(12,'Roshen Samarawickrama','University of Kelaniya','Bowler',140,280,14,46,140,560,51.21,600000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(13,'Sammu Sandakan','University of Ruhuna','Bowler',120,240,10,26,80,320,52.52,600000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(14,'Kalana Jayawardene','University of Jaffna','Bowler',120,240,10,33,100,400,52.93,600000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(15,'Binura Samarawickrama','University of the Visual & Performing Arts','Bowler',77,154,7,21,63,252,52.41,600000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(16,'Dasun Thirimanne','Eastern University','Bowler',121,242,11,29,88,440,50.93,600000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(17,'Angelo Samarawickrama','University of Kelaniya','Batsman',424,471,8,0,1,7,563.74,5200000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(18,'Nuwan Jayawickrama','University of Ruhuna','Batsman',300,333,6,0,3,27,560.61,5100000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(19,'Kusal Dhananjaya','South Eastern University','Batsman',480,533,10,0,2,16,559.33,5100000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(20,'Chamika Bandara','Eastern University','Batsman',270,300,5,0,5,45,563.79,5200000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(21,'Dilruwan Shanaka','University of Peradeniya','Batsman',384,426,8,0,5,45,559.02,5100000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(22,'Danushka Jayawickrama','University of Peradeniya','All-Rounder',350,291,14,14,70,350,65.39,700000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(23,'Charith Shanaka','University of Colombo','Batsman',477,530,9,0,3,27,562.99,5200000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(24,'Asela Nissanka','University of Sri Jayewardenepura','Batsman',765,850,15,0,0,1,698.80,6400000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(25,'Wanindu Hasaranga','University of Colombo','Bowler',120,240,10,30,90,540,51.27,600000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(26,'Asela Vandersay','University of the Visual & Performing Arts','Bowler',154,308,14,37,112,448,52.16,600000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(27,'Pathum Fernando','University of Peradeniya','Batsman',450,500,10,0,2,18,556.59,5100000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(28,'Angelo Kumara','Eastern University','Batsman',330,366,6,0,1,8,564.95,5200000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(29,'Danushka Rajapaksa','University of Peradeniya','Batsman',441,490,9,0,5,35,560.53,5100000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(30,'Suranga Shanaka','South Eastern University','Bowler',55,110,5,13,40,160,51.72,600000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(31,'Pathum Dhananjaya','Eastern University','Batsman',360,400,8,0,1,9,556.59,5100000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(32,'Asela Asalanka','South Eastern University','Batsman',550,611,11,0,0,1,698.00,6400000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(33,'Minod Rathnayake','University of Kelaniya','Bowler',154,308,14,37,112,448,52.16,600000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(34,'Binura Lakmal','University of Kelaniya','Batsman',540,600,12,0,2,16,556.92,5100000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(35,'Praveen Asalanka','Eastern University','Batsman',477,530,9,0,1,7,563.73,5200000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(36,'Angelo Jayawardene','University of Jaffna','Batsman',468,520,9,0,3,21,562.93,5200000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(37,'Kamindu Asalanka','University of Moratuwa','Bowler',135,270,15,45,135,810,48.87,500000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(38,'Sadeera Rajapaksa','University of Jaffna','All-Rounder',275,229,11,8,44,264,63.06,700000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(39,'Sandakan Hasaranga','University of Kelaniya','Batsman',795,883,15,0,1,7,563.74,5200000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(40,'Bhanuka Rajapaksa','University of Moratuwa','All-Rounder',364,303,14,11,56,336,65.08,700000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(41,'Chamika Rajapaksa','University of Ruhuna','Batsman',450,500,9,0,1,7,561.33,5200000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(42,'Kamindu Lakmal','University of the Visual & Performing Arts','Batsman',780,866,15,0,5,35,562.95,5200000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(43,'Lakshan Gunathilaka','University of Peradeniya','Bowler',84,168,7,21,63,315,52.04,600000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(44,'Tharindu Thirimanne','South Eastern University','Batsman',611,678,13,0,2,18,558.22,5100000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(45,'Dinesh Samarawickrama','University of Jaffna','Batsman',400,444,8,0,3,27,560.61,5100000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(46,'Suranga Sandakan','University of Moratuwa','Batsman',235,261,5,0,4,36,558.20,5100000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(47,'Sandakan Dickwella','University of Jaffna','Batsman',368,408,8,0,3,27,557.43,5100000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(48,'Sammu Rajapaksa','University of Ruhuna','Batsman',240,266,5,0,2,16,559.36,5100000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(49,'Suranga Bandara','University of Moratuwa','Bowler',154,308,14,46,140,840,50.07,600000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27'),(50,'Tharindu Embuldeniya','University of the Visual & Performing Arts','All-Rounder',264,220,12,12,60,360,62.16,700000.00,'2025-03-08 05:48:27','2025-03-08 05:48:27');
/*!40000 ALTER TABLE `players` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-09 15:24:59
