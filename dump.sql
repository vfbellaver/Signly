-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: signly1
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

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
-- Table structure for table `active_proposal`
--

DROP TABLE IF EXISTS `active_proposal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `active_proposal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proposal_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `instance_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `proposal_id` (`proposal_id`),
  KEY `instance_id` (`instance_id`),
  CONSTRAINT `active_proposal_ibfk_1` FOREIGN KEY (`proposal_id`) REFERENCES `proposal` (`id`),
  CONSTRAINT `active_proposal_ibfk_2` FOREIGN KEY (`instance_id`) REFERENCES `instance` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `active_proposal`
--

LOCK TABLES `active_proposal` WRITE;
/*!40000 ALTER TABLE `active_proposal` DISABLE KEYS */;
INSERT INTO `active_proposal` VALUES (1,1,'2016-02-29 09:17:12','0000-00-00 00:00:00',16,4),(2,13,'2016-03-01 03:02:19','0000-00-00 00:00:00',9,1),(3,19,'2017-02-06 18:17:13','0000-00-00 00:00:00',7,2),(4,2,'2017-07-18 02:07:52','0000-00-00 00:00:00',16,4),(11,48,'2017-09-06 16:12:44','0000-00-00 00:00:00',2,1);
/*!40000 ALTER TABLE `active_proposal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `active_proposal_billboards`
--

DROP TABLE IF EXISTS `active_proposal_billboards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `active_proposal_billboards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active_proposal_id` int(11) NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `billboard_id` int(11) NOT NULL,
  `billboard_face_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `proposal_price` double NOT NULL,
  `instance_id` int(11) NOT NULL DEFAULT '0',
  `order_proposal_billboards` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `active_proposal_id` (`active_proposal_id`),
  KEY `billboard_id` (`billboard_id`),
  KEY `billboard_face_id` (`billboard_face_id`),
  KEY `proposal_id` (`proposal_id`),
  KEY `instance_id` (`instance_id`),
  CONSTRAINT `active_proposal_billboards_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `active_proposal_billboards_ibfk_2` FOREIGN KEY (`active_proposal_id`) REFERENCES `active_proposal` (`id`),
  CONSTRAINT `active_proposal_billboards_ibfk_3` FOREIGN KEY (`billboard_id`) REFERENCES `billboard` (`id`),
  CONSTRAINT `active_proposal_billboards_ibfk_4` FOREIGN KEY (`billboard_face_id`) REFERENCES `billboard_faces` (`id`),
  CONSTRAINT `active_proposal_billboards_ibfk_5` FOREIGN KEY (`proposal_id`) REFERENCES `proposal` (`id`),
  CONSTRAINT `active_proposal_billboards_ibfk_6` FOREIGN KEY (`instance_id`) REFERENCES `instance` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `active_proposal_billboards`
--

LOCK TABLES `active_proposal_billboards` WRITE;
/*!40000 ALTER TABLE `active_proposal_billboards` DISABLE KEYS */;
INSERT INTO `active_proposal_billboards` VALUES (1,1,1,1,16,7,600,4,0),(50,1,1,1,1,7,600,4,1),(51,3,2,2,1,7,200,4,2),(52,3,3,3,2,7,200,4,3),(53,4,4,4,3,3,400,4,0),(54,4,5,5,3,3,100,4,1),(55,4,5,6,4,3,150,4,2),(56,4,5,7,5,3,375,4,3),(64,11,48,138,57,2,1500,1,0);
/*!40000 ALTER TABLE `active_proposal_billboards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `billboard`
--

DROP TABLE IF EXISTS `billboard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `billboard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `billboard_id` varchar(10) COLLATE utf8_bin NOT NULL,
  `owner_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `address` text COLLATE utf8_bin NOT NULL,
  `city` text COLLATE utf8_bin NOT NULL,
  `state` text COLLATE utf8_bin NOT NULL,
  `zipcode` text COLLATE utf8_bin NOT NULL,
  `rate` decimal(10,0) NOT NULL,
  `digital_driveby` text COLLATE utf8_bin NOT NULL,
  `lat` varchar(100) COLLATE utf8_bin NOT NULL,
  `lng` varchar(100) COLLATE utf8_bin NOT NULL,
  `hard_cost` decimal(10,0) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `instance_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`),
  KEY `instance_id` (`instance_id`),
  CONSTRAINT `billboard_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`id`),
  CONSTRAINT `billboard_ibfk_3` FOREIGN KEY (`instance_id`) REFERENCES `instance` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billboard`
--

LOCK TABLES `billboard` WRITE;
/*!40000 ALTER TABLE `billboard` DISABLE KEYS */;
INSERT INTO `billboard` VALUES (1,'',4,'Centerville (Parrish)','','Mount Olympus, Millcreek, UT, EUA','','','',0,'','40.67329279407306','-111.80191559891682',2150,NULL,'2017-08-31 00:00:00',NULL,1),(2,'',3,'3300 South 355 E','','3300 South 355 East, Salt Lake City, UT 84115','','','',0,'','40.69984970000001','-111.8809402',400,NULL,NULL,NULL,1),(3,'',3,'3900 SOUTH Street','','3900 South 500 West Salt Lake City, UT 84123','','','',0,'','40.6609843','-111.91647790000002',900,NULL,NULL,NULL,1),(4,'',3,'I-1 5000','','4892 Commerce Dr Murray, UT 84107','','','',0,'','40.6649616','-111.89993300000003',3300,NULL,NULL,NULL,1),(5,'',3,'Ft. Union','','6985 De Ville Dr E Cottonwood Heights, UT 84121','','','',0,'','40.6242375','-111.83710050000002',1500,NULL,NULL,NULL,1),(6,'',3,'Lindon Digital','','426 N Frontage Rd Lindon, UT 84042','','','',0,'','40.34491','-111.75858399999998',2150,NULL,NULL,NULL,1),(7,'',3,'I-1 Springville (North)','','1575-1699 E 4800 S St Springville, UT 84663','','','',0,'','40.1445662','-111.64375010000003',800,NULL,NULL,NULL,1),(8,'',3,'I-1 Springville (South)','','792 E 4800 S Spanish Fork, UT 84660','','','',0,'','40.143697','-111.63870199999997',900,NULL,NULL,NULL,1),(9,'',3,'I-1 4300 South','','4150 Commerce Dr Murray, UT 84107','','','',0,'','40.681435','-111.90031299999998',3350,NULL,NULL,NULL,1),(10,'',3,'3900 South Digital','','411-425 W 3900 S Salt Lake City, UT 84115','','','',0,'','40.6866964','-111.90330169999999',3000,NULL,NULL,NULL,1),(11,'',2,'30 Sheet - 513 West 24th','','513 WEST 24TH ST, Ogden, UT','','','',0,'','41.2229845','-111.99024680000002',750,NULL,NULL,NULL,1),(12,'',2,'30 Sheet - 247 WEST 31ST','','247 WEST 31ST, Ogden, UT','','','',0,'','41.2082957','-111.98227559999998',750,NULL,NULL,NULL,1),(13,'',2,'30 Sheet - 1775 WEST RIVERDALE RD','','1775 WEST RIVERDALE RD, Roy, UT','','','',0,'','41.168823','-112.0232795',750,NULL,NULL,NULL,1),(14,'',2,'30 Sheet - 1484 NORTH MAIN ST','','1484 NORTH MAIN ST, Layton, UT','','','',0,'','41.0816443','-111.99080079999999',750,NULL,NULL,NULL,1),(15,'',2,'30 Sheet - 1801 NORTH BECK ST','','1801 NORTH BECK ST, Salt Lake City, UT','','','',0,'','40.8062152','-111.91793039999999',750,NULL,NULL,NULL,1),(16,'',2,'30 Sheet - 6022 SOUTH 1900 WEST','','6022 SOUTH 1900 WEST, Roy, UT','','','',0,'','41.154271','-112.02560740000001',750,NULL,NULL,NULL,1),(17,'',2,'30 Sheet - 500 WEST 600 NORTH','','500 WEST 600 NORTH, Salt Lake City, UT','','','',0,'','40.7824108','-111.9052206',750,NULL,NULL,NULL,1),(18,'',2,'30 Sheet - 3060 SOUTH REDWOOD RD','','3060 SOUTH REDWOOD RD, West Valley, UT','','','',0,'','40.7045586','-111.9394752',750,NULL,NULL,NULL,1),(19,'',2,'30 Sheet - 204 WEST 2100 SOUTH','','204 WEST 2100 SOUTH, Salt Lake City, UT','','','',0,'','40.7257561','-111.89716470000002',750,NULL,NULL,NULL,1),(20,'',2,'30 Sheet - 150 EAST 3900 SOUTH','','150 EAST 3900 SOUTH, Millcreek, UT','','','',0,'','40.6870621','-111.8867515',750,NULL,NULL,NULL,1),(21,'',2,'30 Sheet - 5051 SOUTH I-1','','5062 Commerce Dr, Murray, UT','','','',0,'','40.66164','-111.90020900000002',750,NULL,NULL,NULL,1),(22,'',2,'30 Sheet - 4100 SOUTH 3900 WEST','','4100 SOUTH 3900 WEST, West Valley, UT','','','',0,'','40.6740205','-111.98469239999997',750,NULL,NULL,NULL,1),(23,'',2,'30 Sheet - 7400 SOUTH 900 EAST','','7400 SOUTH 900 EAST, Midvale, UT','','','',0,'','40.6166251','-111.86675550000001',750,NULL,NULL,NULL,1),(24,'',2,'30 Sheet - 8290 SOUTH STATE ST','','8290 SOUTH STATE ST, Sandy, UT','','','',0,'','40.6009319','-111.89080509999997',750,NULL,NULL,NULL,1),(25,'',2,'30 Sheet - 4571 SOUTH 5600 WEST','','4571 SOUTH 5600 WEST, West Valley, UT','','','',0,'','40.6711436','-112.02470340000002',750,NULL,NULL,NULL,1),(26,'',2,'30 Sheet - 59 WEST MAIN ST','','59 WEST MAIN ST, American Fork, UT','','','',0,'','40.3766001','-111.80008759999998',750,NULL,NULL,NULL,1),(27,'',2,'30 Sheet - 495 NORTH GENEVA RD','','495 NORTH GENEVA RD, Lindon, UT','','','',0,'','40.3468362','-111.74076809999997',750,NULL,NULL,NULL,1),(28,'',2,'30 Sheet - 300 NORTH I-1','','1301 400 North, Orem, UT','','','',0,'','40.30406259999999','-111.72657859999998',750,NULL,NULL,NULL,1),(29,'',2,'30 Sheet - 1315 NORTH STATE ST','','1315 NORTH STATE ST, Provo, UT','','','',0,'','40.2516114','-111.66885739999998',750,NULL,NULL,NULL,1),(30,'',2,'30 Sheet - 1004 EAST 1860 SOUTH','','1004 EAST 1860 SOUTH, Ironton, UT','','','',0,'','40.200392','-111.62620049999998',750,NULL,NULL,NULL,1),(31,'',4,'59 WEST MAIN ST','','59 WEST MAIN ST, American Fork, UT','','','',0,'','40.3766001','-111.80008759999998',3500,NULL,NULL,NULL,1),(32,'',5,'6325 Newark Rd.','','6325 Newark Rd. Nashport, OH, 43830','','','',0,'','40.03128359999999','-82.10630270000001',375,NULL,NULL,NULL,2),(33,'',5,'16325 Millersburg Rd.','','16325 Millersburg Rd, Danville, OH 43014','','','',0,'','40.464829','-82.206117',200,NULL,NULL,NULL,2),(34,'',5,'10019 Jacksontown Rd','','10019 Jacksontown Rd, Thornville, OH 43076','','','',0,'','39.948191','-82.40675999999996',400,NULL,NULL,NULL,2),(35,'',5,'10019 Jacksontown Rd #2','','10019 Jacksontown Rd, Thornville, OH 43076','','','',0,'','39.948191','-82.40675999999996',300,NULL,NULL,NULL,2),(36,'',5,'2865 Millersburg Rd','','2865 Millersburg Rd, Martinsburg, OH 43037','','','',0,'','40.270478','-82.35977300000002',150,'2017-07-12 00:00:00',NULL,NULL,2),(37,'',5,'5420 Fallsburg Rd','','5420 Fallsburg Rd NE, Newark, OH 43055','','','',0,'','40.120396','-82.34985389999997',150,'2017-07-12 00:00:00',NULL,NULL,2),(38,'',5,'5357 OH-95','','5357 OH-95, Mt Gilead, OH 43338','','','',0,'','40.5236244','-82.7538601',125,'2017-07-13 00:00:00',NULL,NULL,2),(39,'',5,'7757 State RT 13','','7757 State RT 13 Bellville, OH 43338','','','',0,'','40.550818','-82.53906699999999',150,'2017-07-13 00:00:00',NULL,NULL,2),(40,'',5,'1330 Johnstown Utica Rd.','','1330 Johnstown Utica Rd. Utica, OH 43080','','','',0,'','40.22707279999999','-82.52446270000002',375,'2017-07-13 00:00:00',NULL,NULL,2),(41,'',5,'347 S Main St','','347 S Main St, Utica, OH 43080','','','',0,'','40.2286307','-82.45208109999999',375,'2017-07-13 00:00:00',NULL,NULL,2),(80,'',3,'Centerville (Parrish)','','960 N 950 W Centerville, UT 84014','','','',0,'','40.928862','-111.89266900000001',2150,NULL,NULL,NULL,1),(81,'',3,'3300 South 355 E','','3300 South 355 East, Salt Lake City, UT 84115','','','',0,'','40.69984970000001','-111.8809402',400,NULL,NULL,NULL,1),(82,'',3,'3900 SOUTH Street','','3900 South 500 West Salt Lake City, UT 84123','','','',0,'','40.6609843','-111.91647790000002',900,NULL,NULL,NULL,1),(83,'',3,'I-1 5000','','4892 Commerce Dr Murray, UT 84107','','','',0,'','40.6649616','-111.89993300000003',3300,NULL,NULL,NULL,1),(84,'',3,'Ft. Union','','6985 De Ville Dr E Cottonwood Heights, UT 84121','','','',0,'','40.6242375','-111.83710050000002',1500,NULL,NULL,NULL,1),(85,'',3,'Lindon Digital','','426 N Frontage Rd Lindon, UT 84042','','','',0,'','40.34491','-111.75858399999998',2150,NULL,NULL,NULL,1),(86,'',3,'I-1 Springville (North)','','1575-1699 E 4800 S St Springville, UT 84663','','','',0,'','40.1445662','-111.64375010000003',800,NULL,NULL,NULL,1),(87,'',3,'I-1 Springville (South)','','792 E 4800 S Spanish Fork, UT 84660','','','',0,'','40.143697','-111.63870199999997',900,NULL,NULL,NULL,1),(88,'',3,'I-1 4300 South','','4150 Commerce Dr Murray, UT 84107','','','',0,'','40.681435','-111.90031299999998',3350,NULL,NULL,NULL,1),(89,'',3,'3900 South Digital','','411-425 W 3900 S Salt Lake City, UT 84115','','','',0,'','40.6866964','-111.90330169999999',3000,NULL,NULL,NULL,1),(90,'',2,'30 Sheet - 513 West 24th','','513 WEST 24TH ST, Ogden, UT','','','',0,'','41.2229845','-111.99024680000002',750,NULL,NULL,NULL,1),(91,'',2,'30 Sheet - 247 WEST 31ST','','247 WEST 31ST, Ogden, UT','','','',0,'','41.2082957','-111.98227559999998',750,NULL,NULL,NULL,1),(92,'',2,'30 Sheet - 1775 WEST RIVERDALE RD','','1775 WEST RIVERDALE RD, Roy, UT','','','',0,'','41.168823','-112.0232795',750,NULL,NULL,NULL,1),(93,'',2,'30 Sheet - 1484 NORTH MAIN ST','','1484 NORTH MAIN ST, Layton, UT','','','',0,'','41.0816443','-111.99080079999999',750,NULL,NULL,NULL,1),(95,'',2,'30 Sheet - 1801 NORTH BECK ST','','1801 NORTH BECK ST, Salt Lake City, UT','','','',0,'','40.8062152','-111.91793039999999',750,NULL,NULL,NULL,1),(96,'',2,'30 Sheet - 6022 SOUTH 1900 WEST','','6022 SOUTH 1900 WEST, Roy, UT','','','',0,'','41.154271','-112.02560740000001',750,NULL,NULL,NULL,1),(97,'',2,'30 Sheet - 500 WEST 600 NORTH','','500 WEST 600 NORTH, Salt Lake City, UT','','','',0,'','40.7824108','-111.9052206',750,NULL,NULL,NULL,1),(98,'',2,'30 Sheet - 3060 SOUTH REDWOOD RD','','3060 SOUTH REDWOOD RD, West Valley, UT','','','',0,'','40.7045586','-111.9394752',750,NULL,NULL,NULL,1),(99,'',2,'30 Sheet - 204 WEST 2100 SOUTH','','204 WEST 2100 SOUTH, Salt Lake City, UT','','','',0,'','40.7257561','-111.89716470000002',750,NULL,NULL,NULL,1),(100,'',2,'30 Sheet - 150 EAST 3900 SOUTH','','150 EAST 3900 SOUTH, Millcreek, UT','','','',0,'','40.6870621','-111.8867515',750,NULL,NULL,NULL,1),(101,'',2,'30 Sheet - 5051 SOUTH I-1','','5062 Commerce Dr, Murray, UT','','','',0,'','40.66164','-111.90020900000002',750,NULL,NULL,NULL,1),(102,'',2,'30 Sheet - 4100 SOUTH 3900 WEST','','4100 SOUTH 3900 WEST, West Valley, UT','','','',0,'','40.6740205','-111.98469239999997',750,NULL,NULL,NULL,1),(103,'',2,'30 Sheet - 7400 SOUTH 900 EAST','','7400 SOUTH 900 EAST, Midvale, UT','','','',0,'','40.6166251','-111.86675550000001',750,NULL,NULL,NULL,1),(104,'',2,'30 Sheet - 8290 SOUTH STATE ST','','8290 SOUTH STATE ST, Sandy, UT','','','',0,'','40.6009319','-111.89080509999997',750,NULL,NULL,NULL,1),(105,'',2,'30 Sheet - 4571 SOUTH 5600 WEST','','4571 SOUTH 5600 WEST, West Valley, UT','','','',0,'','40.6711436','-112.02470340000002',750,NULL,NULL,NULL,1),(106,'',2,'30 Sheet - 59 WEST MAIN ST','','59 WEST MAIN ST, American Fork, UT','','','',0,'','40.3766001','-111.80008759999998',750,NULL,NULL,NULL,1),(107,'',2,'30 Sheet - 495 NORTH GENEVA RD','','495 NORTH GENEVA RD, Lindon, UT','','','',0,'','40.3468362','-111.74076809999997',750,NULL,NULL,NULL,1),(108,'',2,'30 Sheet - 300 NORTH I-1','','1301 400 North, Orem, UT','','','',0,'','40.30406259999999','-111.72657859999998',750,NULL,NULL,NULL,1),(109,'',2,'30 Sheet - 1315 NORTH STATE ST','','1315 NORTH STATE ST, Provo, UT','','','',0,'','40.2516114','-111.66885739999998',750,NULL,NULL,NULL,1),(110,'',2,'30 Sheet - 1004 EAST 1860 SOUTH','','1004 EAST 1860 SOUTH, Ironton, UT','','','',0,'','40.200392','-111.62620049999998',750,NULL,NULL,NULL,1),(111,'',4,'59 WEST MAIN ST','','59 WEST MAIN ST, American Fork, UT','','','',0,'','40.3766001','-111.80008759999998',3500,NULL,NULL,NULL,1),(116,'',5,'6325 Newark Rd.','','6325 Newark Rd. Nashport, OH, 43830','','','',0,'','40.03128359999999','-82.10630270000001',375,NULL,NULL,NULL,1),(117,'',5,'16325 Millersburg Rd.','','16325 Millersburg Rd, Danville, OH 43014','','','',0,'','40.464829','-82.206117',200,NULL,NULL,NULL,1),(118,'',5,'10019 Jacksontown Rd','','10019 Jacksontown Rd, Thornville, OH 43076','','','',0,'','39.948191','-82.40675999999996',400,NULL,NULL,NULL,1),(119,'',5,'10019 Jacksontown Rd #2','','10019 Jacksontown Rd, Thornville, OH 43076','','','',0,'','39.948191','-82.40675999999996',300,NULL,NULL,NULL,1),(120,'',5,'2865 Millersburg Rd','','2865 Millersburg Rd, Martinsburg, OH 43037','','','',0,'','40.270478','-82.35977300000002',150,'2017-07-12 00:00:00',NULL,NULL,1),(121,'',5,'5420 Fallsburg Rd','','5420 Fallsburg Rd NE, Newark, OH 43055','','','',0,'','40.120396','-82.34985389999997',150,'2017-07-12 00:00:00',NULL,NULL,1),(122,'',5,'5357 OH-95','','5357 OH-95, Mt Gilead, OH 43338','','','',0,'','40.5236244','-82.7538601',125,'2017-07-13 00:00:00',NULL,NULL,1),(123,'',5,'7757 State RT 13','','7757 State RT 13 Bellville, OH 43338','','','',0,'','40.550818','-82.53906699999999',150,'2017-07-13 00:00:00',NULL,NULL,1),(124,'',5,'1330 Johnstown Utica Rd.','','1330 Johnstown Utica Rd. Utica, OH 43080','','','',0,'','40.22707279999999','-82.52446270000002',375,'2017-07-13 00:00:00',NULL,NULL,1),(125,'',5,'347 S Main St','','347 S Main St, Utica, OH 43080','','','',0,'','40.2286307','-82.45208109999999',375,'2017-07-13 00:00:00',NULL,NULL,1),(126,'',4,'Test proposal','','North Temple Bridge/Guadalupe Station, Salt Lake City, UT 84103, EUA','','','',0,'','40.771931959249095','-111.90479538490763',1,'2017-08-29 00:00:00',NULL,NULL,1),(127,'',6,'Test proposal','','Planetarium Station, Salt Lake City, UT 84101, EUA','','','',0,'','40.7674454549295','-111.90246235157247',1,'2017-08-29 00:00:00',NULL,NULL,1),(128,'',1,'Test proposal','','1300 E @ 3830 S, Millcreek, UT 84124, EUA','','','',0,'','40.68846908656077','-111.85467806062661',1,'2017-08-30 00:00:00',NULL,NULL,1),(129,'',1,'Test proposal 1','','1300 E @ 3830 S, Millcreek, UT 84124, EUA','','','',0,'','40.68846908656077','-111.85467806062661',1,'2017-08-30 00:00:00',NULL,NULL,1),(130,'',1,'Test proposal','','Highland Dr @ 3330 S, Millcreek, UT 84106, EUA','','','',0,'','40.69857311238375','-111.85007832100382',1,'2017-08-30 00:00:00',NULL,NULL,1),(131,'',3,'Test 123','','3300 S @ 1460 E, East Millcreek, UT 84106, EUA','','','',0,'','40.6996063','-111.8494293',1,'2017-08-30 00:00:00',NULL,NULL,1),(132,'',2,'Test billboard','','Holladay, UT, EUA','','','',0,'','40.6688363','-111.8246557',1,'2017-08-30 00:00:00',NULL,NULL,1),(133,'',3,'Test Billboard','','East Millcreek, UT, EUA','','','',0,'','40.68458473475711','-111.79781132144853',1,'2017-08-30 00:00:00',NULL,NULL,1),(134,'',2,'Test billboard','','East Millcreek, UT, EUA','','','',0,'','40.67989836013519','-111.80090122623369',1,'2017-08-30 00:00:00',NULL,NULL,1),(135,'',6,'aaaa','','East Millcreek, UT, EUA','','','',0,'','40.6746908907848','-111.80330448551103',1,'2017-08-30 00:00:00',NULL,NULL,1),(136,'',5,'Test Billboard (A)','Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente. kkkkkkkkkkkkkkkkkkkkkkk','East Millcreek, UT, EUA','','','',0,'','40.675766444605046','-111.8031172285555',1,'2017-08-30 00:00:00','2017-08-31 00:00:00',NULL,1),(137,'',5,'saaaaaa','','East Millcreek, UT, EUA','','','',0,'','40.675766444605046','-111.8031172285555',1,'2017-08-30 00:00:00',NULL,NULL,1),(138,'',4,'Test Billboard(B)','','Holladay, UT, EUA','','','',0,'','40.638597280211485','-111.80712784873322',123,'2017-09-01 00:00:00',NULL,NULL,1);
/*!40000 ALTER TABLE `billboard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `billboard_faces`
--

DROP TABLE IF EXISTS `billboard_faces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `billboard_faces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `billboard_id` int(11) NOT NULL,
  `unique_id` varchar(15) COLLATE utf8_bin NOT NULL,
  `height` float NOT NULL DEFAULT '0',
  `width` float NOT NULL DEFAULT '0',
  `reads` varchar(50) COLLATE utf8_bin NOT NULL,
  `label` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'north east sout west custom',
  `digital_driveby` text COLLATE utf8_bin,
  `sign_type` int(11) NOT NULL DEFAULT '0' COMMENT '0 for static 1 for digital',
  `hard_cost` float NOT NULL DEFAULT '0',
  `monthly_impressions` float NOT NULL DEFAULT '0',
  `notes` text COLLATE utf8_bin NOT NULL,
  `max_ads` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `photo` text COLLATE utf8_bin NOT NULL,
  `instance_id` int(11) NOT NULL,
  `is_iluminated` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `billboard_id` (`billboard_id`),
  KEY `instance_id` (`instance_id`),
  CONSTRAINT `billboard_faces_ibfk_1` FOREIGN KEY (`billboard_id`) REFERENCES `billboard` (`id`),
  CONSTRAINT `billboard_faces_ibfk_3` FOREIGN KEY (`instance_id`) REFERENCES `instance` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='billboard faces for each billboard view';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billboard_faces`
--

LOCK TABLES `billboard_faces` WRITE;
/*!40000 ALTER TABLE `billboard_faces` DISABLE KEYS */;
INSERT INTO `billboard_faces` VALUES (1,1,'1',12,40,'right','NORTH','',0,2150,155300,'I-1 CENTERVILLE NF RR',0,0,'376f0488e6f8050d8382435ef197095f.jpg',1,0),(2,2,'2',12,40,'cross','SOUTH','',0,2150,155300,'I-1 CENTERVILLE SF LR',0,0,'3cf55c54363bdcd4b98b7e16071baf9c.jpg',1,0),(3,3,'11',12,24,'cross','WEST','',0,400,155300,'3300 S 355 E WF LR',0,0,'039ca2b69344659e669bca89781b22e1.jpg',1,0),(4,4,'12',12,24,'right','EAST','',0,400,155300,'3300 S 355 E EF RR',0,0,'3f1ceaf151157175d230306ccd73b9a8.jpg',1,0),(5,5,'1314',15,15,'right','WEST','',0,900,52550,'Testing Notes',0,0,'dd0226c3e9c80b41aeb64b3daef22eb7.jpg',1,0),(6,6,'1',12,24,'cross','EAST','',0,900,52550,'3900 S 500 W EF LR',0,0,'6c39a2bf00f1d6b4c6c31b5a4b6616bf.jpg',1,0),(7,7,'16',14,48,'right','NORTH','',0,3300,309550,'I-1 5000 S NF RR',0,0,'fd04e5e04fab8740b4e41ff6abce482a.jpg',1,0),(8,8,'1',14,48,'cross','SOUTH','',0,3300,309550,'I-1 5000 S SF LR',0,0,'cc6730ed59b26e1f8249fba5c54db4a8.jpg',1,0),(9,9,'17',14,48,'cross','EAST','',0,1500,78225,'1912 FT UNION EF LR',0,0,'591fed5ecfee2e20dceb52158ff42fe6.jpg',1,0),(10,10,'18',14,48,'right','WEST','',0,1500,78225,'1912 FT UNION WF RR',0,0,'7fb35cd78345d02433dd47f862a2f80f.jpg',1,0),(11,11,'19',14,48,'cross','NORTH','',1,2150,240200,'I-1 Lindon (Digital) NF LR',7,8,'4c8fe74976c5f70d0d32cc229f4865fc.jpg',1,0),(12,12,'20',14,48,'right','SOUTH','',1,2150,240200,'I-1 Lindon (Digital) SF RR',7,8,'6c84c8fe2fcfb0bfb5b1c38ed36c0b33.jpg',1,0),(13,13,'21',14,48,'cross','NORTH','',0,800,67225,'I-1 N SPRINGVILLE NF LR',0,0,'280b525a64a4fdc655f4b600d7a66b73.jpg',1,0),(14,14,'22',14,48,'right','SOUTH','',0,800,67225,'I-1 N SPRINGVILLE SF RR',0,0,'5177a0ed77ec46d11fb7cfc975aa3eb5.jpg',1,0),(15,15,'23',14,48,'cross','NORTH','',0,900,67225,'I-1 N SPRINGVILLE NF LR',0,0,'a62c49b37fd94cd945a293ce1d485408.jpg',1,0),(16,16,'24',14,48,'right','SOUTH','',0,900,67225,'I-1 N SPRINGVILLE SF RR',0,0,'fe5f9494ba72bb7f1c4e4b8d8bb37dbb.jpg',1,0),(17,17,'37',14,48,'cross','NORTH','',0,3350,150000,'I-1 4300 S NF LR',0,0,'a33c889cb5d7cb541b9be54452c72b88.jpg',1,0),(18,18,'39',14,48,'cross','SOUTH','',1,3000,304027,'I-1 3900 South (Digital) SF LR',7,8,'3fe2bc5fbe581ccf6a2396e2b0aef32f.jpg',1,0),(19,19,'69',10,20,'right','EAST','',0,750,100000,'69',0,0,'2db92cce3f774b8b4d7595fe20155be6.jpeg',1,0),(20,20,'97',10,20,'right','EAST','',0,750,100000,'97',0,0,'7723c06dc728b81102c3ddaac042f9b1.jpeg',1,0),(21,21,'115',10,20,'right','WEST','',0,750,100000,'115',0,0,'a6fbcf4ce7713e477c125d9383e077e3.jpg',1,0),(22,22,'279',10,20,'right','SOUTH','',0,750,100000,'279',0,0,'5523842810ffa6597b47753c801a182b.jpg',1,0),(23,23,'00326A',10,20,'right','NORTH','',0,750,100000,'00326A',0,0,'732e53a00cf337fb0cd31cdefb315333.jpg',1,0),(24,24,'285',10,20,'right','SOUTH','',0,750,100000,'285',0,0,'86bb220b22a91a2ef0ee8199851c3c50.jpg',1,0),(25,25,'426',10,20,'right','WEST','',0,750,100000,'426',0,0,'997a674b8d344bf6f9210b3116ae2da0.jpg',1,0),(26,26,'498',10,20,'right','SOUTH','',0,750,1000000,'498',0,0,'3ddaec3c81c7f8fdf150bb7f36ee989e.jpg',1,0),(27,27,'547',10,20,'right','EAST','',0,750,100000,'547',0,0,'97f834ceedb5d696379c61ecb20aae7d.jpg',1,0),(28,28,'676',10,20,'right','WEST','',0,750,100000,'676',0,0,'cec3d2c8d8d7c496f0f5936db0144c71.jpg',1,0),(29,29,'768',10,20,'right','SOUTH','',0,750,100000,'768',0,0,'37df0be68b3b075b47ae84addec4f745.jpg',1,0),(30,30,'807',10,20,'right','EAST','',0,750,100000,'807',0,0,'73dc2f11f5524721d235ae29c7cbec3b.jpg',1,0),(31,31,'914',10,20,'right','NORTH','',0,750,100000,'914',0,0,'bbc9393899d0c0ec6005309d309570e9.jpg',1,0),(32,32,'929',10,20,'right','NORTH','',0,750,100000,'929',0,0,'9196d8045e9fa5e9b65f5aaead32e0ab.jpg',2,0),(33,33,'999',10,20,'right','NORTH','',0,750,100000,'999',0,0,'18acc8f139577f8a7508fac9a0da02f0.jpg',2,0),(34,34,'1011',10,20,'right','EAST','',0,750,100000,'1011',0,0,'cbc51a58a1638b860d7c73ffb67fb0dd.jpg',2,0),(35,35,'1030',10,20,'right','SOUTH','',0,750,100000,'1030',0,0,'59c2a45dcc4231d7e781877d65dc6c0a.jpg',2,0),(36,36,'1041',10,20,'right','NORTH','',0,750,100000,'1041',0,0,'8d84039ba3cb57bffe4cb37ba5a3625f.jpg',2,0),(37,37,'1099',10,20,'right','SOUTH','',0,750,100000,'1099',0,0,'836517606a23025c666fad553c622148.jpg',2,0),(38,38,'1166',10,20,'right','WEST','',0,750,100000,'1166',0,0,'82c426689a22d67d9a82a1fa3d4864e8.jpg',2,0),(39,39,'1',10,30,'right','NORTH','',0,3500,180000,'On the frontage road.',0,0,'d23ec2141bf516829205be1115c1ee1c.jpg',2,0),(40,40,'1',11,22,'right','NORTH','',0,375,9280,'$350 1 year Contract\r\n$375 6 Months Or Less Contract',0,0,'65f819db7c3ef715b4e9b35fa3d4010c.png',2,0),(41,41,'1-South',11,22,'cross','SOUTH','',0,375,9280,'$350 1 year Contract\r\n$375 6 Months Or Less Contract',0,0,'60ab84b01543e91180ee67cf5035b39a.jpg',2,0),(43,131,'123',400,600,'right','SOUTH','',0,1,100000,'teste',0,0,'8f2cd086c3121bec65272d1f3b2b7758.png',1,0),(44,133,'123342',500,500,'right','NORTH','',0,1,100000,'test',0,0,'',1,0),(45,133,'12343',111,111,'cross','EAST','',0,1,1050000,'asdrtewasd',0,0,'b296c2a1429b92e6e1c0f31357acadf7.png',1,0),(46,133,'dsfewa',222,2222,'right','SOUTH','',0,1,100056000,'fdgrewdasfre',0,0,'8a26146fee67ee93a59507e4e4307f03.png',1,0),(47,133,'aaaa',123,123,'right','WEST','',0,1,11111100,'O que é Lorem Ipsum?\r\nLorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.',0,0,'70d235bd44c54ae2cc5f0a382c476620.png',1,0),(48,134,'1q22',444,4444,'right','EAST','',0,1,1050000,'rsdfferwadsfghtrewasdzx',0,0,'f3e788796d38a0e9a21315ca17238e47.png',1,0),(54,136,'Teste C',400,400,'right','SOUTH','',0,1,200000,'Test D',0,0,'145d28a342e73756fce3063f10e5a2df.png',1,0),(55,136,'Test B',300,300,'right','EAST','',0,1,2000,'Test B',0,0,'d2bd4603864509c56bb19bf21cee6c7f.png',1,0),(56,136,'Teste D',500,500,'right','WEST','',0,2,10000,'Testando 12345678',0,0,'ad1575b2ae8856aa9d02d0e3fa25aa69.jpg',1,0),(57,138,'Face Cx',500,500,'right','NORTH','',0,1,50000,'Mussum Ipsum, cacilds vidis litro abertis. Nullam volutpat risus nec leo commodo, ut interdum diam laoreet. Sed non consequat odio. Atirei o pau no gatis, per gatis num morreus. Manduma pindureta quium dia nois paga. Posuere libero varius. Nullam a nisl ut ante blandit hendrerit. Aenean sit amet nisi.',0,0,'e2f7adb66bed1b5a86144e0f90c1dab7.jpg',1,0),(58,5,'1315',10,10,'right','NORTH','',0,800,110000,'North Test',0,0,'ff9d4c648bd8db90ba95af73afcf0a59.jpg',1,0);
/*!40000 ALTER TABLE `billboard_faces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_booking`
--

DROP TABLE IF EXISTS `client_booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client_booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `billboard_id` int(11) NOT NULL,
  `billboard_face_id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `proposal_id` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_bin,
  `book_start_date` datetime DEFAULT NULL,
  `book_end_date` datetime DEFAULT NULL,
  `set_price` decimal(10,0) DEFAULT NULL,
  `billboard_type` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `photo` text COLLATE utf8_bin NOT NULL,
  `instance_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `proposal_id` (`proposal_id`),
  KEY `billboard_id` (`billboard_id`),
  KEY `billboard_face_id` (`billboard_face_id`),
  KEY `client_id` (`client_id`),
  KEY `instance_id` (`instance_id`),
  CONSTRAINT `client_booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `client_booking_ibfk_2` FOREIGN KEY (`proposal_id`) REFERENCES `proposal` (`id`),
  CONSTRAINT `client_booking_ibfk_3` FOREIGN KEY (`billboard_id`) REFERENCES `billboard` (`id`),
  CONSTRAINT `client_booking_ibfk_4` FOREIGN KEY (`billboard_face_id`) REFERENCES `billboard_faces` (`id`),
  CONSTRAINT `client_booking_ibfk_5` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `client_booking_ibfk_6` FOREIGN KEY (`instance_id`) REFERENCES `instance` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_booking`
--

LOCK TABLES `client_booking` WRITE;
/*!40000 ALTER TABLE `client_booking` DISABLE KEYS */;
INSERT INTO `client_booking` VALUES (1,1,1,NULL,NULL,NULL,'This is a test.','2016-03-01 12:00:00','2016-05-31 12:00:00',NULL,NULL,'2016-03-01 12:00:00','2016-03-01 12:00:00',NULL,16,'',4);
/*!40000 ALTER TABLE `client_booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `phone1` varchar(50) COLLATE utf8_bin NOT NULL,
  `phone2` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `fax` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `billing_address` text COLLATE utf8_bin,
  `billing_city` text COLLATE utf8_bin,
  `billing_state` text COLLATE utf8_bin,
  `billing_zipcode` text COLLATE utf8_bin,
  `logo` text COLLATE utf8_bin,
  `contact_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `company` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `instance_id` int(11) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `instance_id` (`instance_id`),
  CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`instance_id`) REFERENCES `instance` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'Michael','Spencer','michael@sjatty.com','8017431507','8017431507','8017431507','5664 S Green Street','5664 S Green Street','5664 S Green Street','5664 S Green Street','user.jpg',NULL,'Siegfried & Jensen',NULL,NULL,NULL,1,0),(2,'Julianna','Spencer',' jewels@mikeandjewels.com','8012004964','8012004964','8012004964','636 south 500 west','Provo','UT','84601','logo1.jpg',NULL,'Jsweetie',NULL,NULL,NULL,1,0),(3,'Matt ','Reid','Matt@mammothbillboards.com','801 898 2420','Same','None','1727 e 27th street','Ogden','Utah','84003',NULL,NULL,'Mammoth Billboards',NULL,NULL,NULL,1,0),(4,'John','Doe','cesar.benedicto.espinosa@gmail.com','023939959','4940594509','495495495','test','test','test','test','secomp.jpg',NULL,'ACME Ltd.',NULL,NULL,NULL,1,0),(5,'H Le ','Spencer','hlespencer@yahoo.com','6262521630','6262521630','6262521630','1683 N. Rocky Rd.','Upland','California','91784',NULL,NULL,'Spencer Dynamics',NULL,NULL,NULL,1,0),(6,'Mike','Spencer','mike@signly.com','8012004395','8012004395','8012004395','1291 Springfield St','Upland','CA','91786',NULL,NULL,'Signly',NULL,NULL,NULL,2,0),(7,'Jared','Spencer','lemeilleurmec@gmail.com','6266650927','6266650927','6666666666','9176 Regents Rd. Apt. J','9176 Regents Rd. Apt. J','9176 Regents Rd. Apt. J','9176 Regents Rd. Apt. J',NULL,NULL,'Jared Spencer',NULL,NULL,NULL,1,0),(8,'Test','Test','Test@TEst.com','123456789','123456789','123456789','5664 S Green Street','Salt Lake City','Utah','84123',NULL,NULL,'Test',NULL,NULL,NULL,2,0),(9,'Ned','Siegfried','ned@sjatty.com','8012660999','8015981218','8012660999','5664 S Green Street','Salt Lake City','UT','84123',NULL,NULL,'Siegfried & Jensen',NULL,NULL,NULL,3,0),(10,'Jay','Kimball','jay@jaysradiator.com','8015468574','8015468574','8015468574','453 Rancho Alegre','Covina','CA','91724',NULL,NULL,'Jay\'s Radioator',NULL,NULL,NULL,4,0),(11,'Jenny','Ritza','ritza@pizza.com','7859083485','7859083485','7859083485','7859083485','7859083485','7859083485','7859083485',NULL,NULL,'Ritza\'s Pizza',NULL,NULL,NULL,4,0),(12,'Thomas','Monson','tmonson@lds.org','8012448578','8012448578','8012448578','8012448578','8012448578','8012448578','8012448578',NULL,NULL,'LDS Church',NULL,NULL,NULL,2,0),(13,'Randall','Day','rday@byu.edu','8014224278','8014224278','8014224278','8014224278','8014224278','8014224278','8014224278',NULL,NULL,'Flourishing Families',NULL,NULL,NULL,1,0),(14,'Vagner','Felipe','vfb@example.com','999999999','99999999','99999999','Rua December','Coxim','MS','89080989',NULL,NULL,'DevTeamCx',NULL,NULL,NULL,1,0),(15,'Vagner','Felipe','vfb@example.com','999999999','99999999','99999999','Rua December','Coxim','MS','89080989',NULL,NULL,'DevTeamCx',NULL,NULL,NULL,1,0),(16,'Vagner','Felipe','vfb@example.com','999999999','99999999','99999999','Rua December','Coxim','MS','89080989',NULL,NULL,'DevTeamCx',NULL,NULL,NULL,1,0),(17,'Vagner','Felipe','vfb@example.com','999999999','99999999','99999999','Rua December','Coxim','MS','89080989',NULL,NULL,'DevTeamCx',NULL,NULL,'2017-08-31 00:00:00',1,1),(18,'Vagner','Felipe','vfb@example.com','999999999','99999999','99999999','Rua December','Coxim','MS','89080989',NULL,NULL,'DevTeamCx',NULL,NULL,NULL,1,0),(19,'Vagner','Felipe','vfb@example.com','999999999','99999999','99999999','Rua December','Coxim','MS','89080989','secomp.jpg',NULL,'DevTeamCx',NULL,NULL,NULL,1,0),(20,'Vagner','Felipe','vfb@example.com','999999999','99999999','99999999','December','Coxim','MS','93949392','ifms logo.jpg',NULL,'DevTeamCx',NULL,NULL,NULL,1,0),(21,'Vagner','Felipe','vfb@example.com','999999999','99999999','99999999','December','Coxim','MS','93949392','ifms logo.jpg',NULL,'DevTeamCx',NULL,NULL,NULL,1,0),(22,'Vagner','Felipe','vfb@example.com','999999999','99999999','99999999','December','Coxim','MS','93949392','ifms logo.jpg',NULL,'DevTeamCx',NULL,NULL,NULL,1,0),(23,'Vagner','Felipe','vfb@example.com','999999999','99999999','99999999','December','Coxim','MS','93949392','ifms logo.jpg',NULL,'DevTeamCx',NULL,NULL,NULL,1,0),(24,'Vagner','Felipe','vfb@example.com','999999999','99999999','99999999','December','Coxim','MS','93949392','secomp.jpg',NULL,'DevTeamCx',NULL,NULL,NULL,1,0),(25,'Vagner','Felipe','vfb@example.com','999999999','99999999','99999999','December','Coxim','MS','93949392','secomp.jpg',NULL,'DevTeamCx',NULL,NULL,NULL,1,0),(26,'R.','Cursino','r.cursino@ex.com','9987766127','98723637','921837283','4th January','Salt Lake City','UTAH','828339932','20728955_1518200158227750_4298693555256474512_o.jpg',NULL,'Cursino',NULL,NULL,'2017-09-01 00:00:00',1,1),(27,'R.','Cursino','rodrigoapmc@gmail.com','999999999','99999999','99999999','Coxim','Salt Lake City','UTAH','789098789','20728955_1518200158227750_4298693555256474512_o.jpg',NULL,'Cursino',NULL,NULL,NULL,1,0),(28,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(29,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(30,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(31,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(32,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(33,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(34,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(35,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(36,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(37,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(38,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(39,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(40,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(41,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(42,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(43,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(44,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(45,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(46,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(47,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(48,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(49,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(50,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(51,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(52,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(53,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(54,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(55,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932',NULL,NULL,'Beer',NULL,NULL,NULL,1,0),(56,'Jr','Cuevas','jrcuevas@example.com','123123132131','123123131','123123131','Test Address','Salt Lake City','UTAH','828339932','123.jpg',NULL,'Beer',NULL,NULL,NULL,1,0),(57,'company','teste','teste@ex.com','12343','99999999','99999999','Test Address','Salt Lake City','UTAH','780003400','ccc.jpg',NULL,' Cursino Cxm',NULL,NULL,NULL,1,0),(58,'Test','Test 2','vrb@example.com','4576543456765','5654676524','435654','Test Address','Salt Lake City','UTA','9879032','Screenshot from 2017-08-30 11-35-13.jpg',NULL,'DevTeamCx',NULL,NULL,NULL,1,0);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contract`
--

DROP TABLE IF EXISTS `contract`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contract` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proposal_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `email_to` varchar(255) NOT NULL,
  `email_cc` varchar(255) NOT NULL,
  `email_subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `proposal_id` (`proposal_id`),
  CONSTRAINT `contract_ibfk_1` FOREIGN KEY (`proposal_id`) REFERENCES `proposal` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contract`
--

LOCK TABLES `contract` WRITE;
/*!40000 ALTER TABLE `contract` DISABLE KEYS */;
/*!40000 ALTER TABLE `contract` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instance`
--

DROP TABLE IF EXISTS `instance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `instance` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instance`
--

LOCK TABLES `instance` WRITE;
/*!40000 ALTER TABLE `instance` DISABLE KEYS */;
INSERT INTO `instance` VALUES (1,'Main Instance','Main Instance'),(2,'Kennedy Outdoor','Beta-User'),(3,'Circle City Billboards',''),(4,'Independent Outdoor','');
/*!40000 ALTER TABLE `instance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `owners`
--

DROP TABLE IF EXISTS `owners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `owners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `phone1` varchar(50) COLLATE utf8_bin NOT NULL,
  `phone2` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `fax` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `billing_address` text COLLATE utf8_bin,
  `billing_city` text COLLATE utf8_bin,
  `billing_state` text COLLATE utf8_bin,
  `billing_zipcode` text COLLATE utf8_bin,
  `logo` text COLLATE utf8_bin,
  `contact_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `company` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `instance_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `instance_id` (`instance_id`),
  CONSTRAINT `owners_ibfk_1` FOREIGN KEY (`instance_id`) REFERENCES `instance` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `owners`
--

LOCK TABLES `owners` WRITE;
/*!40000 ALTER TABLE `owners` DISABLE KEYS */;
INSERT INTO `owners` VALUES (1,'John','Doe','john.doe@test.com','1234567','1234567','1234567','test','test','test','test',NULL,NULL,'J&M Company',NULL,NULL,NULL,1),(2,'Dave','Tomei','david@reaganusa.com','(801) 521-1775','801-555-5555','(801) 521-9741','1775 North Warm Springs Road','Salt Lake City','UT','84116',NULL,NULL,'Reagan',NULL,NULL,NULL,1),(3,'Matt','Reid','matt@mammothbillboards.com','801-898-2420','801-898-2420','801-898-2420','1728 27th ST','Ogden','UT','84403',NULL,NULL,'Mammoth Outdoor',NULL,NULL,NULL,1),(4,'R.C.','Channel','kennedyoutdoor9@gmail.com','740-258-7083','740-258-7083','740-258-7083','9327 Martinsburg Rd',' St Louisville','OH','43071',NULL,NULL,'Kennedy Outdoor',NULL,NULL,NULL,1),(5,'R.C.','Kennedy','kennedyoutdoor9@gmail.com','740-258-7083','740-258-7083','740-258-7083','9327 Martinsburg Rd',' St Louisville','OH','43071',NULL,NULL,'Kennedy Outdoor',NULL,NULL,NULL,1),(6,'Eric','Lambert','eric@independentoutdoor.com','203-318-9097','203-318-9097','203-318-9097','1, 346 Quinnipiac St.','Wallingford','CT','06492',NULL,NULL,'Independent Outdoor',NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `owners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proposal`
--

DROP TABLE IF EXISTS `proposal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proposal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `budget` decimal(10,0) DEFAULT NULL,
  `budget_validity` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `map_area_lat` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `map_area_long` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `hash` text COLLATE utf8_bin,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `accepted` int(11) NOT NULL,
  `booked` int(11) NOT NULL DEFAULT '0',
  `instance_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `client_id` (`client_id`),
  KEY `instance_id` (`instance_id`),
  CONSTRAINT `proposal_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `proposal_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `proposal_ibfk_3` FOREIGN KEY (`instance_id`) REFERENCES `instance` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proposal`
--

LOCK TABLES `proposal` WRITE;
/*!40000 ALTER TABLE `proposal` DISABLE KEYS */;
INSERT INTO `proposal` VALUES (1,4,'Sweetie',1000000,'Week','2015-08-10','2015-08-10',NULL,NULL,'aea7d19b7890703006e56b16b5fbf4c7',NULL,NULL,NULL,16,0,0,4),(2,4,'Matt\'s',87878,'Week','2015-08-04','2016-04-29',NULL,NULL,'ceb658eddf71814eea21212deb08deab',NULL,NULL,NULL,16,0,0,4),(3,1,'Mike\'s Test Proposal',50000,'Month','2015-11-06','2016-03-10',NULL,NULL,'063389020202701d6289ca94fa7cbcc8',NULL,NULL,NULL,16,0,0,4),(4,2,'Show off to J',50000,'Year','2015-11-09','2016-11-09',NULL,NULL,'831d11995955ed168c0501b7851dbe2a',NULL,NULL,NULL,2,0,0,4),(5,1,'New Boards for Ned',15000,'Month','2015-12-23','2016-02-29',NULL,NULL,'3bbd474cdb6575d18ae1033e59fc25a4',NULL,NULL,NULL,16,0,0,4),(6,1,'tester',3000,'Month','2015-12-01','2016-03-31',NULL,NULL,'45c48cce2e2d7fbdea1afc51c7c6ad26',NULL,NULL,NULL,16,0,0,4),(7,4,'Test User Proposal',10000,'Week','2016-01-04','2016-01-04',NULL,NULL,'2d5c04770d6d73aceb812574a55eb4d9',NULL,NULL,NULL,16,0,0,4),(8,4,'My New Test Proposal',10000,'Week','2016-01-05','2016-01-05',NULL,NULL,'c0f54a0eb3ae4302fba56a2d1c3fab19',NULL,NULL,NULL,16,0,0,4),(9,2,'Clip Earring Shop',5000,'Month','2016-01-21','2016-04-21',NULL,NULL,'d0c0ed84d041a2cc5a1a45d9e6ec67f2',NULL,NULL,NULL,16,0,0,4),(10,4,'Test User Proposal',10000,'Week','2016-01-01','2016-01-01',NULL,NULL,'9bf31c7ff062936a96d3c8bd1f8f2ff3',NULL,NULL,NULL,16,0,0,4),(11,1,'My New Test Proposal',100000,'Week','2016-01-01','2016-02-29',NULL,NULL,'f45581dce368ecc53386d0ff5058f17b',NULL,NULL,NULL,16,0,0,4),(12,2,'My New User Locking Test Proposal',200000,'Week','2016-02-19','2016-02-19',NULL,NULL,'a653c6bdba6d477c165ad250add8211f',NULL,NULL,NULL,7,0,0,2),(13,5,'signly scrrenshot',1000,'Week','2016-03-01','2016-03-01',NULL,NULL,'cc1bd048c5784806a842f453ebe7558d',NULL,NULL,NULL,9,0,0,1),(14,6,'25 Mar 2016 - Signly',5000,'Month','2016-04-01','2016-06-30',NULL,NULL,'3416a75f4cea9109507cacd8e2f2aefc',NULL,NULL,NULL,2,1,1,3),(15,6,'30 Mar 2016 Hoogle Zoo',5000,'Month','2016-09-01','2016-12-31',NULL,NULL,'a1d0c6e83f027327d8461063f4ac58a6',NULL,NULL,NULL,2,1,1,3),(16,1,'22 Apr 2016 - Test',5000,'Month','2016-04-01','2016-05-31',NULL,NULL,'f7177163c833dff4b38fc8d2872f1ec6',NULL,NULL,NULL,2,1,1,3),(17,6,'22 Apr 2016 - Karen Demo',5000,'Month','2016-07-01','2016-08-31',NULL,NULL,'6c8349cc7260ae62e3b1396831a8398f',NULL,NULL,NULL,2,1,1,3),(18,7,'26 Apr 2016 - Jared Test',5000,'Month','2016-08-01','2016-09-30',NULL,NULL,'d9d4f495e875a2e075a1a4a6e1b9770f',NULL,NULL,NULL,2,1,1,3),(19,1,'#11 #12 #21 mammoth deal',1000,'Week','2017-02-06','2017-02-06',NULL,NULL,'5828e13641dba1e5760fc91288615b13',NULL,NULL,NULL,7,0,0,2),(20,1,'S&J - Fire Sale',1000,'Week','2017-03-01','2018-02-28',NULL,NULL,'36ba0baf8dd2683f5fcf44c4194db0b4',NULL,NULL,NULL,2,0,1,3),(21,1,'11 Mar 2017',10000,'Week','2017-04-01','2017-06-30',NULL,NULL,'419e886416fa01c05fdea200e3c72818',NULL,NULL,NULL,2,1,1,3),(22,1,'demo',5000,'Week','2017-04-22','2017-04-22',NULL,NULL,'6619530c2aa3d0cf74145acda7e1db0e',NULL,NULL,NULL,2,1,0,3),(23,1,'Demo for Lee',5000,'Week','2017-05-01','2017-07-31',NULL,NULL,'ab4c0f8f84ec97e90ce1423e70405926',NULL,NULL,NULL,2,0,0,3),(24,1,'Demo 3 May',5000,'Week','2017-05-01','2017-07-31',NULL,NULL,'af211804fe2ca754621ed78ae97611ab',NULL,NULL,NULL,2,0,0,3),(25,1,'May Rotary Posters',15000,'Week','2017-05-01','2017-06-01',NULL,NULL,'c93faebac05a730f14451e5cc4274a14',NULL,NULL,NULL,2,0,0,3),(26,1,'June Rotary Posters',3000,'Week','2017-06-01','2017-07-01',NULL,NULL,'7d0b8db5b9761551d858021a989eff97',NULL,NULL,NULL,2,0,0,3),(27,1,'June Rotary Posters',3000,'Week','2017-06-01','2017-07-01',NULL,NULL,'f97fd948ae91b9e4bd259682ada5b818',NULL,NULL,NULL,2,1,0,3),(28,1,'6 Jun 2017 - Big Proposal',30000,'Week','2017-06-01','2017-08-31',NULL,NULL,'a7759ca8d3748450ee8b8487b6f351e6',NULL,NULL,NULL,2,0,0,3),(29,1,'Dave\'s demo',5000,'Week','2017-06-19','2017-06-19',NULL,NULL,'d63ed23c053651c706a2b27fcee2232f',NULL,NULL,NULL,2,1,0,3),(30,1,'Test',5000,'Week','2017-07-01','2017-09-30',NULL,NULL,'0b85c9d8b43c1a6af73324d664066140',NULL,NULL,NULL,2,1,0,3),(31,1,'RC Demo',5000,'Week','2017-07-01','2017-09-30',NULL,NULL,'226f6fff4c0b887ee7477870d4729ac9',NULL,NULL,NULL,2,1,0,3),(32,1,'adsf',1000,'Week','2017-06-26','2017-06-26',NULL,NULL,'fa25bd59362661ae8f54a5f2ad086f57',NULL,NULL,NULL,2,0,0,3),(33,1,'Don\'s Demo',5000,'Week','2017-07-01','2017-09-30',NULL,NULL,'7137f34be9b93a04856053672a0053c6',NULL,NULL,NULL,2,0,0,3),(34,1,'Eric Demo',5000,'Week','2017-07-01','2017-09-30',NULL,NULL,'969fd7534e54fe4d2fb69e0b6b0668bc',NULL,NULL,NULL,2,0,0,3),(35,1,'RC\'s Boards',750,'Week','2017-07-12','2017-07-12',NULL,NULL,'e4cb0afc1aca321962f24a8330efbd72',NULL,NULL,NULL,2,0,0,3),(36,1,'17 Jun - Signly',500,'Week','2017-07-17','2018-06-30',NULL,NULL,'3829f449faf255f3edce7401d85045b7',NULL,NULL,NULL,16,0,0,4),(37,1,'Signly',500,'Week','2017-07-18','2017-07-18',NULL,NULL,'c284575f12b04a0cc883ff6259dceb14',NULL,NULL,NULL,16,0,0,4),(38,7,'demo felipe',45000,'Week','2017-08-04','2017-08-04',NULL,NULL,'fbeb20baa82f627e2322a8b9f3e91f85',NULL,NULL,NULL,16,0,0,4),(39,26,'Proposal Test',100,'Week','2017-09-04','2017-09-04',NULL,NULL,'4ebfada509f2aaebe4260d1ae3a2184e',NULL,NULL,NULL,2,0,0,1),(40,1,'Test 1',10000,'Week','2017-09-04','2017-09-04',NULL,NULL,'c1f3d8042f2ba01c4830d69d3d63ca60',NULL,NULL,NULL,2,0,0,1),(41,1,'Test 1',10000,'Week','2017-09-04','2017-09-04',NULL,NULL,'5306deda7d6cbafba2cdb7917b30b7ec',NULL,NULL,NULL,2,0,0,1),(42,1,'Test 1',10000,'Week','2017-09-04','2017-09-04',NULL,NULL,'0f46cb7f91619da522b148219ab52dd4',NULL,NULL,NULL,2,0,0,1),(43,1,'Test 1',10000,'Week','2017-09-04','2017-09-04',NULL,NULL,'72a4fe71430207d8d5b5f3db6511a73c',NULL,NULL,NULL,2,0,0,1),(44,1,'Test 1',10000,'Week','2017-09-04','2017-09-04',NULL,NULL,'4ab51648b3ae1d04d9705bbf0d0bde11',NULL,NULL,NULL,2,0,0,1),(45,2,'Test proposal',100000,'Week','2017-09-04','2017-09-04',NULL,NULL,'0cb934042524becab2b5fdf59cdff1c3',NULL,NULL,NULL,2,0,0,1),(46,1,'Test Michael',10000,'Week','2017-09-04','2017-09-04',NULL,NULL,'abc455104fdd763e02167041299f4fbd',NULL,NULL,NULL,2,0,0,1),(47,5,'Test Proposal',1000,'Week','2017-09-06','2017-09-06',NULL,NULL,'9aac5fa7054502350f6edf6d85d03119',NULL,NULL,NULL,2,0,0,1),(48,57,'Proposal Company',150,'Week','2017-09-06','2017-09-06',NULL,NULL,'3457280002463bec63143351aef67595',NULL,NULL,NULL,2,0,0,1);
/*!40000 ALTER TABLE `proposal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proposal_billboard`
--

DROP TABLE IF EXISTS `proposal_billboard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proposal_billboard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proposal_id` int(11) NOT NULL,
  `billboard_id` int(11) NOT NULL,
  `billboard_face_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_accepted` int(11) NOT NULL,
  `client_rejected` int(11) NOT NULL,
  `proposal_price` double DEFAULT NULL,
  `instance_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `proposal_id` (`proposal_id`),
  KEY `billboard_id` (`billboard_id`),
  KEY `billboard_face_id` (`billboard_face_id`),
  KEY `instance_id` (`instance_id`),
  CONSTRAINT `proposal_billboard_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `proposal_billboard_ibfk_2` FOREIGN KEY (`proposal_id`) REFERENCES `proposal` (`id`),
  CONSTRAINT `proposal_billboard_ibfk_3` FOREIGN KEY (`billboard_id`) REFERENCES `billboard` (`id`),
  CONSTRAINT `proposal_billboard_ibfk_4` FOREIGN KEY (`billboard_face_id`) REFERENCES `billboard_faces` (`id`),
  CONSTRAINT `proposal_billboard_ibfk_5` FOREIGN KEY (`instance_id`) REFERENCES `instance` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proposal_billboard`
--

LOCK TABLES `proposal_billboard` WRITE;
/*!40000 ALTER TABLE `proposal_billboard` DISABLE KEYS */;
INSERT INTO `proposal_billboard` VALUES (1,1,1,1,'2017-08-23 09:59:25','2017-08-23 09:59:25','2017-08-23 09:59:25',16,1,0,20000,4),(2,1,2,2,'2017-08-23 09:59:25','2017-08-23 09:59:25','2017-08-23 09:59:25',16,1,0,15000,4),(3,3,3,3,'2017-08-23 09:59:25','2017-08-23 09:59:25','2017-08-23 09:59:25',16,1,0,30000,4);
/*!40000 ALTER TABLE `proposal_billboard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proposal_comments`
--

DROP TABLE IF EXISTS `proposal_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proposal_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `proposal_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `message_from` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `client_id` (`client_id`),
  KEY `proposal_id` (`proposal_id`),
  CONSTRAINT `proposal_comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `proposal_comments_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `proposal_comments_ibfk_3` FOREIGN KEY (`proposal_id`) REFERENCES `proposal` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proposal_comments`
--

LOCK TABLES `proposal_comments` WRITE;
/*!40000 ALTER TABLE `proposal_comments` DISABLE KEYS */;
INSERT INTO `proposal_comments` VALUES (1,16,1,4,'Hello! this is a test.','client','2017-08-23 10:11:07','2017-08-23 10:11:07','2017-08-25 10:11:23');
/*!40000 ALTER TABLE `proposal_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proposal_permissions`
--

DROP TABLE IF EXISTS `proposal_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proposal_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proposal_permissions`
--

LOCK TABLES `proposal_permissions` WRITE;
/*!40000 ALTER TABLE `proposal_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `proposal_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proposal_settings`
--

DROP TABLE IF EXISTS `proposal_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proposal_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `path_image` varchar(50) DEFAULT NULL,
  `user_street` varchar(100) DEFAULT NULL,
  `user_state` varchar(100) DEFAULT NULL,
  `user_city` varchar(100) DEFAULT NULL,
  `user_zipcode` varchar(15) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL,
  `user_phone` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proposal_settings`
--

LOCK TABLES `proposal_settings` WRITE;
/*!40000 ALTER TABLE `proposal_settings` DISABLE KEYS */;
INSERT INTO `proposal_settings` VALUES (1,2,'user.png','Marte','MS','Coxim','780000000','www.slc.com','12345432');
/*!40000 ALTER TABLE `proposal_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role_permission`
--

DROP TABLE IF EXISTS `user_role_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_role_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `view` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role_permission`
--

LOCK TABLES `user_role_permission` WRITE;
/*!40000 ALTER TABLE `user_role_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_role_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `photo` varchar(255) COLLATE utf8_bin NOT NULL,
  `first_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `phone` varchar(50) COLLATE utf8_bin NOT NULL,
  `company` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `about_me` text COLLATE utf8_bin,
  `password` text COLLATE utf8_bin,
  `remember_token` text COLLATE utf8_bin,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `instance_id` int(11) NOT NULL,
  `is_founder` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `instance_id` (`instance_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `users_roles` (`id`),
  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`instance_id`) REFERENCES `instance` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'','John','Doe','cesar.benedicto.espinosa@gmail.com','',NULL,NULL,'$2a$10$btFdgfVD74eLeYeOzS0JvO0uQZPOywcSQJrOeJ98UsAeroATHKb8W','ABdqJGxag4j1Lc5Xuk5AvToZpDRDJ5H0eCTwfHCss5GpIQ5YfMw1rHyUjYsd','2016-04-12 03:35:02','2015-02-21 08:29:13',NULL,4,1),(2,1,'','Michael','Spencer','mike@mikeandjewels.com','',NULL,NULL,'$2y$10$dEMsdMd6pc52Sx0NWfdwv.dFEr8cMr8FoQqnIsbEFMhg52jROzdj.','jmKGyul0HLiyGxvK3uXJgmy5y0J8wbnyQupcpuWl2AqX4QDU3AD4IUWIQcF7','2017-08-03 13:27:01','2015-04-06 16:48:45',NULL,1,1),(3,1,'','Marian','Pop','marian@creatiph.com','',NULL,NULL,'$2y$10$U9dKW2L/eOGrbO8ugHKbiOWtJLvYB8fVSE7p2OfsYWk32w1iZz6B6',NULL,'2015-04-08 18:46:25','2015-04-08 18:46:25',NULL,4,0),(4,1,'','Test','User','test@test.com','',NULL,NULL,'$2a$10$btFdgfVD74eLeYeOzS0JvO0uQZPOywcSQJrOeJ98UsAeroATHKb8W','VXVBU5Jzs5TDyWr6oSsBcYDD3QXD0DJ0dyEAyScgRkuzvwN9mgZPrdzCQmWl','2016-01-13 00:18:30',NULL,NULL,1,0),(5,1,'','Juliana','Spencer','jewels@mikeandjewels.com','',NULL,NULL,'$2y$10$dEMsdMd6pc52Sx0NWfdwv.dFEr8cMr8FoQqnIsbEFMhg52jROzdj.',NULL,NULL,NULL,NULL,3,0),(6,1,'','Matt','','matt@mammothbillboards.com','',NULL,NULL,'$2a$10$qqqGWrz9A.doo1u4w3OKuu8WM5rpxt4VGasE85ND3xXROLjrAS1bW','hrmeaqfpdE7dtWGGLLBZ36XnET0sPCJ7kLkn3qEquzhmnqwkp89ncfeh6tA1','2017-06-01 00:10:25',NULL,NULL,4,0),(7,1,'','a','a','fluflux2003@gmail.com','',NULL,NULL,'$2y$10$ipOfMELulkeR.V8AJlRcv.3mCevzhFLWI4VKjgkTh3lgMRr3ZYpLK','XVi7naNeXVIbB5EAi1FHDfQ0e2Jv51KhCCuBDS1W0PYihbwBle4kbKvzg0og','2016-01-01 13:34:56','2016-01-01 13:33:49',NULL,1,0),(8,1,'','H Le','Spencer','hlespencer@yahoo.com','',NULL,NULL,'$2y$10$NJAHEmigHsVjoyFOQXI.x.uKR8LLnTtmZ.cInmzta2FzSshct1CUi',NULL,'2016-03-01 01:51:52','2016-03-01 01:51:52',NULL,1,0),(9,1,'','Jared','Spencer','jaredspencer12@gmail.com','',NULL,NULL,'$2a$06$ZVcdkzjUkyLvMzsqXLT15uWQzv.BUaulrLExJ2AUF7FEn2cUmS4OW',NULL,'2016-05-11 10:41:01','2016-05-11 10:41:20',NULL,2,0),(10,1,'','Chase','Chase','chase@yellowbus.media','12355556',NULL,NULL,'$2a$06$hkGLDs2U7D3Oj6icxaHkZucQUyGVVflmNIRSmlyL5rgo.XU.hdTf2',NULL,NULL,NULL,NULL,3,0),(11,1,'','R.C.','Kennedy','kennedyoutdoor9@gmail.com','',NULL,NULL,'$2a$06$vADOw4zEYHs4LZYtJ5gqZeq2FNVlg894NIaewgAQHDxo1pYq0q.JW','bTdL2YFMpN7xDsx6qyraoqCkPnpYels2pYONWqUI7A14h13pDXbz2ay4BiU0','2017-07-12 00:18:12','2017-06-27 00:00:00',NULL,2,0),(12,1,'','Dave','Westburg','circlecitybillboards@gmail.com','',NULL,NULL,'$2a$06$Qkzyhj1cFJ3.UC0lNUgDv.tkdhdAXiUR9niDXXluXscI0u0suxIWy',NULL,'2017-06-27 00:00:00','2017-06-27 00:00:00',NULL,2,0),(13,1,'','Michael','Spencer','jim@mikeandjewels.com','',NULL,NULL,'$2y$10$sJA8lrac290LS4OlgEm7i.YS3taypI.hXEd7cDxgoHm5vWTkR/aqq',NULL,'2017-06-27 00:00:00','2017-06-27 00:00:00',NULL,2,0),(14,1,'','Dave','Westburg','circlecitybillboards@gmail.com','',NULL,NULL,'$2y$10$veq8btbWItB0/DcvI9vnBeRA1k.1igUDberCp9KLSCsU8mQu/im4W',NULL,'2017-06-27 00:00:00','2017-06-27 00:00:00',NULL,3,0),(15,1,'','Test','Test','test@test.com','',NULL,NULL,'$2y$10$dgsinB8.oTsdJfUGUvt4J.gPmZJbiG343iPV8JArRkq/SPu1v3FiC',NULL,'2017-07-04 00:00:00','2017-07-04 00:00:00',NULL,1,0),(16,1,'','Eric','Lambert','eric@independentoutdoor.com','',NULL,NULL,'$2y$10$Uodmgn.Fd3AGvyUWa9uTZuWyd3cWKzmWJxiBIFiVVT846SCQPg0qu','b6TGZRyIKXhg8N8hEUEeJ61RC5Pb87DwF8BDu7sZXNAZAmyzMOzzyQjEGeq2','2017-07-26 00:41:50','2017-07-26 00:00:00',NULL,4,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_roles`
--

DROP TABLE IF EXISTS `users_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_roles`
--

LOCK TABLES `users_roles` WRITE;
/*!40000 ALTER TABLE `users_roles` DISABLE KEYS */;
INSERT INTO `users_roles` VALUES (1,'role');
/*!40000 ALTER TABLE `users_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_settings`
--

DROP TABLE IF EXISTS `users_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `posting_cycle` int(11) NOT NULL,
  `can_hold` int(11) NOT NULL,
  `release_hold_value` decimal(10,0) NOT NULL,
  `release_hool_period` int(11) NOT NULL,
  `allow_remove` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `users_settings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_settings`
--

LOCK TABLES `users_settings` WRITE;
/*!40000 ALTER TABLE `users_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_settings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-06 12:20:38
