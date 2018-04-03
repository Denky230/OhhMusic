CREATE DATABASE  IF NOT EXISTS `ohhmusic` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ohhmusic`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ohhmusic
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `applyconcert`
--

DROP TABLE IF EXISTS `applyconcert`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applyconcert` (
  `id_musician` int(11) NOT NULL,
  `id_concert` int(11) NOT NULL,
  `state` int(1) NOT NULL,
  PRIMARY KEY (`id_musician`,`id_concert`),
  KEY `fk_apply_concert` (`id_concert`),
  CONSTRAINT `fk_apply_concert` FOREIGN KEY (`id_concert`) REFERENCES `concert` (`id_concert`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_apply_mus` FOREIGN KEY (`id_musician`) REFERENCES `musician` (`id_musician`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applyconcert`
--

LOCK TABLES `applyconcert` WRITE;
/*!40000 ALTER TABLE `applyconcert` DISABLE KEYS */;
/*!40000 ALTER TABLE `applyconcert` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assist`
--

DROP TABLE IF EXISTS `assist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assist` (
  `id_fan` int(11) NOT NULL,
  `id_concert` int(11) NOT NULL,
  PRIMARY KEY (`id_fan`,`id_concert`),
  KEY `fk_assist_concert` (`id_concert`),
  CONSTRAINT `fk_assist_concert` FOREIGN KEY (`id_concert`) REFERENCES `concert` (`id_concert`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_assist_fan` FOREIGN KEY (`id_fan`) REFERENCES `fan` (`id_fan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assist`
--

LOCK TABLES `assist` WRITE;
/*!40000 ALTER TABLE `assist` DISABLE KEYS */;
/*!40000 ALTER TABLE `assist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city` (
  `id_city` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `province` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_city`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` VALUES (1,'c1','p1'),(2,'c2','p1'),(3,'c3','p2'),(4,'c4','p2');
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `concert`
--

DROP TABLE IF EXISTS `concert`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `concert` (
  `id_concert` int(11) NOT NULL AUTO_INCREMENT,
  `state` int(1) NOT NULL,
  `concert_date` date NOT NULL,
  `concert_time` time NOT NULL,
  `id_genre` int(11) NOT NULL,
  `payment` decimal(10,0) NOT NULL,
  `id_local` int(11) NOT NULL,
  `id_musician` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_concert`),
  KEY `fk_conc_genre` (`id_genre`),
  KEY `fk_conc_local` (`id_local`),
  KEY `fk_conc_musician` (`id_musician`),
  CONSTRAINT `fk_conc_genre` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_conc_local` FOREIGN KEY (`id_local`) REFERENCES `local` (`id_local`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_conc_musician` FOREIGN KEY (`id_musician`) REFERENCES `musician` (`id_musician`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `concert`
--

LOCK TABLES `concert` WRITE;
/*!40000 ALTER TABLE `concert` DISABLE KEYS */;
/*!40000 ALTER TABLE `concert` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fan`
--

DROP TABLE IF EXISTS `fan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fan` (
  `id_fan` int(11) NOT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `surname` varchar(30) NOT NULL,
  PRIMARY KEY (`id_fan`),
  CONSTRAINT `fk_fan_user` FOREIGN KEY (`id_fan`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fan`
--

LOCK TABLES `fan` WRITE;
/*!40000 ALTER TABLE `fan` DISABLE KEYS */;
INSERT INTO `fan` VALUES (3,'12345','bondia','aun mas feliz');
/*!40000 ALTER TABLE `fan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genre` (
  `id_genre` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genre`
--

LOCK TABLES `genre` WRITE;
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` VALUES (1,'Platano'),(2,'Banano');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `local`
--

DROP TABLE IF EXISTS `local`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `local` (
  `id_local` int(11) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `capacity` int(11) NOT NULL,
  `web` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_local`),
  CONSTRAINT `fk_local_user` FOREIGN KEY (`id_local`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `local`
--

LOCK TABLES `local` WRITE;
/*!40000 ALTER TABLE `local` DISABLE KEYS */;
INSERT INTO `local` VALUES (2,'12345',50,'hola.com');
/*!40000 ALTER TABLE `local` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `musician`
--

DROP TABLE IF EXISTS `musician`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `musician` (
  `id_musician` int(11) NOT NULL,
  `artist_name` varchar(35) NOT NULL,
  `id_genre` int(11) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `web` varchar(255) DEFAULT NULL,
  `group_size` int(11) NOT NULL,
  PRIMARY KEY (`id_musician`),
  KEY `fk_musician_genre` (`id_genre`),
  CONSTRAINT `fk_musician_genre` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_musician_user` FOREIGN KEY (`id_musician`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `musician`
--

LOCK TABLES `musician` WRITE;
/*!40000 ALTER TABLE `musician` DISABLE KEYS */;
INSERT INTO `musician` VALUES (1,'musico-sama',1,'feliz','12345','',3);
/*!40000 ALTER TABLE `musician` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(1) NOT NULL,
  `username` varchar(25) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `id_city` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`),
  KEY `fk_user_city` (`id_city`),
  CONSTRAINT `fk_user_city` FOREIGN KEY (`id_city`) REFERENCES `city` (`id_city`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,1,'musico','$2y$10$iT06alkKn68gKlIgX9Fx/eTQeH3qcqLbdB26m8YBr4kc/xYnu1a/i','musico','musico@hola.com',1,'0'),(2,2,'local','$2y$10$uVcOrolCdawzoGruUskAx.2T7RDAZRanhLfByxWHThRnJtYuLYl46','local','local@hola.com',2,'0'),(3,3,'fan','$2y$10$E5kts.8hnvhhho0m9LV6R.pjhKlp5ATiib2qngeEvl/JGhXLVxJrC','fan','fan@hola.com',3,'0');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voteconcert`
--

DROP TABLE IF EXISTS `voteconcert`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voteconcert` (
  `id_fan` int(11) NOT NULL,
  `id_concert` int(11) NOT NULL,
  PRIMARY KEY (`id_fan`,`id_concert`),
  KEY `fk_concert` (`id_concert`),
  CONSTRAINT `fk_concert` FOREIGN KEY (`id_concert`) REFERENCES `concert` (`id_concert`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user` FOREIGN KEY (`id_fan`) REFERENCES `fan` (`id_fan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voteconcert`
--

LOCK TABLES `voteconcert` WRITE;
/*!40000 ALTER TABLE `voteconcert` DISABLE KEYS */;
/*!40000 ALTER TABLE `voteconcert` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votemusician`
--

DROP TABLE IF EXISTS `votemusician`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votemusician` (
  `id_fan` int(11) NOT NULL,
  `id_musician` int(11) NOT NULL,
  PRIMARY KEY (`id_fan`,`id_musician`),
  KEY `fk_userna` (`id_musician`),
  CONSTRAINT `fk_usern` FOREIGN KEY (`id_fan`) REFERENCES `fan` (`id_fan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_userna` FOREIGN KEY (`id_musician`) REFERENCES `musician` (`id_musician`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votemusician`
--

LOCK TABLES `votemusician` WRITE;
/*!40000 ALTER TABLE `votemusician` DISABLE KEYS */;
/*!40000 ALTER TABLE `votemusician` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-23 23:26:35
