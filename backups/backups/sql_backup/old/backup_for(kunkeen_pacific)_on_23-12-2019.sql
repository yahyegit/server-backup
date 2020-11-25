-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: localhost    Database: kunkeen_pacific
-- ------------------------------------------------------
-- Server version	5.7.28-0ubuntu0.18.04.4

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
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history` (
  `id` int(22) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cash_in` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cash_out` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `blance` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `doller_in` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `doller_out` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `doller_blance` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_card` int(20) NOT NULL,
  `months` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42452 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
INSERT INTO `history` VALUES (42427,'abdullahi/gab','0','0','0','0','605465','-605465','','19/Dec/2019',2236,'12/2019','24702981 bir/2.50/102'),(42428,'gina','0','0','0','0','18371','-18371','','20/Dec/2019',2237,'12/2019','dayn'),(42429,'gina','0','0','0','0','3308','-21679','','20/Dec/2019',2237,'12/2019','less karat'),(42430,'maxamudey','0','1501930','-1501930','0','0','0','','19/Dec/2019',2238,'12/2019','dayn'),(42431,'adan fotoqsa','0','560000','-560000','0','0','0','','20/Dec/2019',2239,'12/2019','dayn'),(42432,'ali kalay','0','92900','-92900','0','0','0','','20/Dec/2019',2240,'12/2019','kiro guri'),(42404,'abgalow','0','0','0','0','4822','-4822','','10/Sep/2019',2220,'09/2019','500kun dayn'),(42424,'abgalow','0','0','0','1960','0','-2862','','16/Dec/2019',2220,'12/2019',''),(42434,'bashir dhere','0','0','0','200000','0','350000','','18/Dec/2019',2235,'12/2019','abdimajid'),(42435,'bashir dhere','0','0','0','0','250000','100000','','19/Dec/2019',2235,'12/2019','abdifitax/dubai'),(42436,'bashir dhere','0','0','0','0','50000','50000','','19/Dec/2019',2235,'12/2019','abdifitax/dubai'),(42437,'bashir dhere','0','0','0','50000','0','100000','','19/Dec/2019',2235,'12/2019','cumar'),(42438,'cumar','0','0','0','184950','0','184950','','20/Dec/2019',2242,'12/2019','shaqada shirkata'),(42439,'cumar','0','0','0','20000','0','204950','','20/Dec/2019',2242,'12/2019','dahab/shaqo'),(42440,'abdimajis','0','0','0','168000','0','168000','','20/Dec/2019',2243,'12/2019','shaqada shirkata'),(42383,'ahmed','0','0','0','0','4821','-4821','','13/Oct/2019',2215,'10/2019','500kun mpesa'),(42441,'abdimajis','0','0','0','30000','0','198000','','20/Dec/2019',2243,'12/2019','dahab/shaqo'),(42442,'abdimajis','0','0','0','0','2500','195500','','20/Dec/2019',2243,'12/2019','casho cunsheye dayn'),(42443,'khalif','0','0','0','142304','0','142304','','20/Dec/2019',2244,'12/2019','shqada shirkata'),(42444,'ahmed somali','0','0','0','0','3000','120950','','20/Dec/2019',2245,'12/2019',''),(42418,'xawo/hodan','0','0','0','4807','0','4807','','18/Oct/2019',2230,'10/2019','500kun hodan kentay'),(42445,'ahmed somali','0','0','0','0','0','120950','','20/Dec/2019',2245,'12/2019','dayn'),(42446,'ahmed somali','0','0','0','223950','0','223950','','19/Dec/2019',2245,'12/2019','dahab'),(42447,'ahmed somali','0','0','0','0','100000','123950','','19/Dec/2019',2245,'12/2019','edahan aya lagu shubay'),(42448,'abdimajid','0','0','0','0','0','195500','','20/Dec/2019',2243,'12/2019',''),(42449,'maxamudey','0','71300','-1573230','0','0','0','','22/Dec/2019',2238,'12/2019','faido/umar'),(42450,'ahmed somali','0','0','0','0','179','120771','','22/Dec/2019',2245,'12/2019','transport'),(42451,'ahmed somali','0','0','0','0','60771','60000','','22/Dec/2019',2245,'12/2019','cawil/bank'),(42425,'bashir dhere','0','0','0','150000','0','150000','','17/Dec/2019',2235,'12/2019','c.majid'),(42433,'dhoblow/fadumo y /mama/cabiyo/f cunsheye/m.xusen','170500','187000','-16500','1145','7000','-5855','','20/Dec/2019',2241,'12/2019','7000$ dhobka/2000$  f/yusuf 1145$mama c');
/*!40000 ALTER TABLE `history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_in`
--

DROP TABLE IF EXISTS `login_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_in` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username_e` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password_w` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(22) COLLATE utf8_unicode_ci NOT NULL,
  `active_ip` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_in`
--

LOCK TABLES `login_in` WRITE;
/*!40000 ALTER TABLE `login_in` DISABLE KEYS */;
INSERT INTO `login_in` VALUES (1,'pacific','60cfe76a56749322c5c44b3e9ef27accb4f9c8c51','41.220.242.123',1);
/*!40000 ALTER TABLE `login_in` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `main_details`
--

DROP TABLE IF EXISTS `main_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `main_details` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cash_in` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cash_out` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `blance` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `doller_in` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `doller_out` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `doller_blance` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_passport` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2246 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `main_details`
--

LOCK TABLES `main_details` WRITE;
/*!40000 ALTER TABLE `main_details` DISABLE KEYS */;
INSERT INTO `main_details` VALUES (2235,'bashir dhere','0','0','0','400000','300000','100000','','17/Dec/2019','17/Dec/2019',''),(2230,'xawo/hodan','0','0','0','4807','0','4807','','18/Oct/2019','18/Oct/2019',''),(2245,'ahmed somali','0','0','0','223950','163950','60000','','20/Dec/2019','20/Dec/2019',''),(2237,'gina','0','0','0','0','21679','-21679','','20/Dec/2019','20/Dec/2019',''),(2220,'abgalow','0','0','0','1960','4822','-2862','','10/Sep/2019','10/Sep/2019',''),(2236,'abdullahi/gab','0','0','0','0','605465','-605465','','19/Dec/2019','19/Dec/2019',''),(2242,'cumar','0','0','0','204950','0','204950','','20/Dec/2019','20/Dec/2019',''),(2238,'maxamudey','0','1573230','-1573230','0','0','0','','19/Dec/2019','19/Dec/2019',''),(2215,'ahmed','0','0','0','0','4821','-4821','','13/Oct/2019','13/Oct/2019',''),(2243,'abdimajid','0','0','0','198000','2500','195500','','20/Dec/2019','20/Dec/2019',''),(2244,'khalif','0','0','0','142304','0','142304','','20/Dec/2019','20/Dec/2019',''),(2239,'adan fotoqsa','0','560000','-560000','0','0','0','','20/Dec/2019','20/Dec/2019',''),(2240,'ali kalay','0','92900','-92900','0','0','0','','20/Dec/2019','20/Dec/2019',''),(2241,'dhoblow/fadumo y /mama/cabiyo/f cunsheye/m.xusen','170500','187000','-16500','1145','7000','-5855','','20/Dec/2019','20/Dec/2019','');
/*!40000 ALTER TABLE `main_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oppen_day`
--

DROP TABLE IF EXISTS `oppen_day`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oppen_day` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cash_in` int(20) NOT NULL,
  `cash_out` int(20) NOT NULL,
  `blance` int(20) NOT NULL,
  `dolla_in` int(20) NOT NULL,
  `dolla_out` int(20) NOT NULL,
  `dolla_blance` int(20) NOT NULL,
  `date` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `month` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cashRate` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dollarRate` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1237 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oppen_day`
--

LOCK TABLES `oppen_day` WRITE;
/*!40000 ALTER TABLE `oppen_day` DISABLE KEYS */;
/*!40000 ALTER TABLE `oppen_day` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `delete_pass` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'123pa');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-23  2:30:03
