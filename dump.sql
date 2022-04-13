-- MySQL dump 10.13  Distrib 8.0.28, for Linux (x86_64)
--
-- Host: localhost    Database: eti_symfony
-- ------------------------------------------------------
-- Server version	8.0.28-0ubuntu0.20.04.3

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
-- Current Database: `eti_symfony`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `eti_symfony` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `eti_symfony`;

--
-- Table structure for table `blog_article`
--

DROP TABLE IF EXISTS `blog_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_article` (
  `id` int NOT NULL AUTO_INCREMENT,
  `blog_category_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EECCB3E5CB76011C` (`blog_category_id`),
  CONSTRAINT `FK_EECCB3E5CB76011C` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_article`
--

LOCK TABLES `blog_article` WRITE;
/*!40000 ALTER TABLE `blog_article` DISABLE KEYS */;
INSERT INTO `blog_article` VALUES (1,1,'Maintenance','Maintenance will happen tomorrow at 15:00','We\'ve detected some major security issues, we need to fix them','2022-04-01 00:00:00','Admin'),(2,2,'Why am I still here','I cannot find point of life','Why am I still here? Just to suffer','2022-03-21 00:00:00','Sad monkey'),(4,3,'Title1','description1','content1','2022-04-01 00:00:00','Author1'),(5,4,'Title2','description2','content2','2022-04-02 00:00:00','Author2'),(6,5,'Title3','description3','content3','2022-04-03 00:00:00','Author3'),(7,6,'Title4','description4','content4','2022-04-04 00:00:00','Author4'),(8,7,'Title5','description5','content5','2022-04-05 00:00:00','Author5'),(9,8,'Title6','description6','content6','2022-04-06 00:00:00','Author6'),(10,9,'Title7','description7','content7','2022-04-07 00:00:00','Author7'),(11,10,'Title8','description8','content8','2022-04-08 00:00:00','Author8'),(12,11,'Title9','description9','content9','2022-04-09 00:00:00','Author9'),(13,12,'Title10','description10','content10','2022-04-10 00:00:00','Author10'),(14,12,'Title11','description11','content11','2022-04-10 00:00:00','Author1'),(15,11,'Title12','description12','content12','2022-04-09 00:00:00','Author2'),(16,10,'Title13','description13','content13','2022-04-08 00:00:00','Author3'),(17,9,'Title14','description14','content14','2022-04-07 00:00:00','Author4'),(18,8,'Title15','description15','content15','2022-04-06 00:00:00','Author5'),(19,7,'Title16','description16','content16','2022-04-05 00:00:00','Author6'),(20,6,'Title17','description17','content17','2022-04-04 00:00:00','Author7'),(21,5,'Title18','description18','content18','2022-04-03 00:00:00','Author8'),(22,4,'Title19','description19','content19','2022-04-02 00:00:00','Author9'),(23,3,'Title20','description20','content20','2022-04-01 00:00:00','Author20');
/*!40000 ALTER TABLE `blog_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_category`
--

DROP TABLE IF EXISTS `blog_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_category`
--

LOCK TABLES `blog_category` WRITE;
/*!40000 ALTER TABLE `blog_category` DISABLE KEYS */;
INSERT INTO `blog_category` VALUES (1,'Administration','Category used for administration notifications','2022-01-02 00:00:00'),(2,'Sadness river','Category made for those who feel sad','2022-03-10 00:00:00'),(3,'Category1','description1','2022-04-01 00:00:00'),(4,'Category2','description2','2022-04-02 00:00:00'),(5,'Category3','description3','2022-04-03 00:00:00'),(6,'Category4','description4','2022-04-04 00:00:00'),(7,'Category5','description5','2022-04-05 00:00:00'),(8,'Category6','description6','2022-04-06 00:00:00'),(9,'Category7','description7','2022-04-07 00:00:00'),(10,'Category8','descriptiom8','2022-04-08 00:00:00'),(11,'Category9','description9','2022-04-09 00:00:00'),(12,'Category10','description10','2022-04-10 00:00:00');
/*!40000 ALTER TABLE `blog_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20220323123202','2022-03-23 13:32:19',167),('DoctrineMigrations\\Version20220329134235','2022-03-29 15:42:50',57),('DoctrineMigrations\\Version20220409091858','2022-04-09 11:19:13',58),('DoctrineMigrations\\Version20220410101449','2022-04-10 12:15:06',69),('DoctrineMigrations\\Version20220410205506','2022-04-10 22:55:20',165),('DoctrineMigrations\\Version20220410212224','2022-04-10 23:22:40',156),('DoctrineMigrations\\Version20220413151913','2022-04-13 17:19:23',243),('DoctrineMigrations\\Version20220413153655','2022-04-13 17:37:09',58);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `probe`
--

DROP TABLE IF EXISTS `probe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `probe` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `probe`
--

LOCK TABLES `probe` WRITE;
/*!40000 ALTER TABLE `probe` DISABLE KEYS */;
INSERT INTO `probe` VALUES (1,'Why am I still here?','Just to suffer','Because I have to','Because I can\'t move anywhere'),(2,'Is there any point of life?','There is not','Point of life is to not think about it','Death'),(3,'Which of those colors you like the most?','Red','Green','Blue');
/*!40000 ALTER TABLE `probe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (5,'Admin','[\"ROLE_ADMIN\"]','$2y$13$DKJzyKkIPaY8MFsOMGwjIOVIYUVWqBOh7PYSfO9tuAPOumZrli3VK'),(6,'Sad monkey','[\"ROLE_USER\"]','$2y$13$gFXzPnFjDXsbxdRuCvC6EOcbEStI45/0fxjXxEWb8iO3Zv9J27Ctm');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vote`
--

DROP TABLE IF EXISTS `vote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vote` (
  `id` int NOT NULL AUTO_INCREMENT,
  `chosen_answer` int NOT NULL,
  `question_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vote`
--

LOCK TABLES `vote` WRITE;
/*!40000 ALTER TABLE `vote` DISABLE KEYS */;
INSERT INTO `vote` VALUES (1,2,1,5);
/*!40000 ALTER TABLE `vote` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-13 17:39:16
