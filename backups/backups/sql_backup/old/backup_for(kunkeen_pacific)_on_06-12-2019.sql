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
) ENGINE=MyISAM AUTO_INCREMENT=42423 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
INSERT INTO `history` VALUES (42410,'sadaq','0','0','0','0','119364','-119364','','18/Oct/2019',2223,'10/2019',''),(42408,'imo','0','0','0','0','10000','70605','','18/Oct/2019',2221,'10/2019','guriga casho'),(42389,'shariq','0','0','0','86376','287000','-200624','','01/Oct/2019',2217,'10/2019',''),(42407,'imo','0','0','0','0','385','80605','','18/Oct/2019',2221,'10/2019','40kun racday'),(42400,'cumar/c.majid','0','0','0','30000','0','50000','','10/Oct/2019',2219,'10/2019','c.majid utala'),(42401,'c.majid','0','0','0','100','0','140000','','18/Oct/2019',2183,'10/2019',''),(42402,'cumar','0','0','0','1000','0','144050','','18/Oct/2019',2181,'10/2019',''),(42403,'khalif','0','0','0','3150','0','109150','','03/Oct/2019',2182,'10/2019',''),(42404,'abgalow','0','0','0','0','4822','-4822','','10/Sep/2019',2220,'09/2019','500kun dayn'),(42405,'imo','0','0','0','19000','0','19000','','18/Oct/2019',2221,'10/2019','shaqo dahab'),(42406,'imo','0','0','0','61990','0','80990','','18/Oct/2019',2221,'10/2019','rasumal'),(42385,'abdinasir','0','0','0','0','10000','50660','','13/Oct/2019',2216,'10/2019','sahro/guriga'),(42409,'abdulahi moyale','0','0','0','0','238076','-238076','','18/Oct/2019',2222,'10/2019','9596875 bir 2.58/104'),(42287,'cumar','0','0','0','120000','0','120000','','31/Aug/2019',2181,'08/2019',''),(42288,'khalif','0','0','0','91485','0','91485','','31/Aug/2019',2182,'08/2019',''),(42289,'c.majid','0','0','0','120000','0','120000','','31/Aug/2019',2183,'08/2019',''),(42411,'shige','0','0','0','88452','0','88452','','18/Oct/2019',2224,'10/2019','9199000/104'),(42292,'mama hodan','0','0','0','0','55000','-55000','','26/Aug/2019',2186,'08/2019',''),(42422,'gina','0','0','0','1806','0','1806','','20/Oct/2019',2233,'10/2019','balance/dahab'),(42412,'duke','0','0','0','2840','0','2840','','18/Oct/2019',2225,'10/2019','295250 /104'),(42413,'x.m farax','0','0','0','82692','0','82692','','18/Oct/2019',2226,'10/2019','8.6m /104'),(42414,'axmed qoxoti','0','0','0','0','47529','-47529','','18/Oct/2019',2227,'10/2019','xisab racday'),(42415,'ganey','0','0','0','9615','0','9615','','18/Oct/2019',2228,'10/2019','1m/104'),(42300,'mama hodan','0','0','0','1500','0','-53500','','01/Sep/2019',2186,'09/2019','lcg hindiya katimit ayan kajaray'),(42301,'mama cabiyo','0','0','0','2000','0','2000','','01/Sep/2019',2192,'09/2019',''),(42397,'c.majid','0','0','0','3900','0','139900','','07/Oct/2019',2183,'10/2019',''),(42399,'cumar/c.majid','0','0','0','20000','0','20000','','10/Oct/2019',2219,'10/2019','cumar utala'),(42383,'ahmed','0','0','0','0','4821','-4821','','13/Oct/2019',2215,'10/2019','500kun mpesa'),(42394,'mama hodan','0','0','0','3000','0','-45500','','07/Oct/2019',2186,'10/2019',''),(42308,'fadumo','0','0','0','1145','0','1145','','01/Sep/2019',2199,'09/2019',''),(42384,'abdinasir','0','0','0','60660','0','60660','','13/Oct/2019',2216,'10/2019',''),(42382,'ali kalay','0','0','0','173','0','173','','13/Oct/2019',2214,'10/2019','17900'),(42395,'mama hodan','0','0','0','0','65000','-105000','','17/Oct/2019',2186,'10/2019','dukan'),(42396,'mama hodan','0','0','0','20000','0','-85000','','17/Oct/2019',2186,'10/2019',''),(42418,'xawo/hodan','0','0','0','4807','0','4807','','18/Oct/2019',2230,'10/2019','500kun hodan kentay'),(42386,'abdinasir','0','0','0','19000','0','69660','','13/Oct/2019',2216,'10/2019','dahab/sharif'),(42387,'cumar','0','0','0','3900','0','139900','','07/Oct/2019',2181,'10/2019',''),(42388,'cumar','0','0','0','3150','0','143050','','11/Oct/2019',2181,'10/2019',''),(42373,'khalif','0','0','0','11000','0','106000','','26/Sep/2019',2182,'09/2019',''),(42421,'sharif/imo','0','0','0','7442','0','-32875','','20/Oct/2019',2231,'10/2019','300kun/bir/2.58/104/bibi'),(42370,'c.majid','0','0','0','11000','0','136000','','26/Sep/2019',2183,'09/2019',''),(42371,'cumar','0','0','0','11000','0','136000','','26/Sep/2019',2181,'09/2019',''),(42392,'mama hodan','0','0','0','5500','0','-40000','','15/Oct/2019',2186,'10/2019',''),(42393,'mama hodan','0','0','0','5000','0','-48500','','01/Oct/2019',2186,'10/2019',''),(42419,'sharif/imo','0','0','0','0','40317','-40317','','18/Oct/2019',2231,'10/2019','1634869 bir/40.55'),(42346,'cumar','0','0','0','5000','0','125000','','05/Sep/2019',2181,'09/2019','faido'),(42347,'c.majid','0','0','0','5000','0','125000','','05/Sep/2019',2183,'09/2019','faido'),(42348,'khalif','0','0','0','5000','1485','95000','','05/Sep/2019',2182,'09/2019','cash/faido'),(42420,'adan f','0','0','0','0','5385','-5385','','18/Oct/2019',2232,'10/2019','560000 dayn'),(42380,'mohamed/abdi','0','0','0','0','2035','-2035','','13/Oct/2019',2213,'10/2019','dayn shaqsi ahan');
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
) ENGINE=MyISAM AUTO_INCREMENT=2234 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `main_details`
--

LOCK TABLES `main_details` WRITE;
/*!40000 ALTER TABLE `main_details` DISABLE KEYS */;
INSERT INTO `main_details` VALUES (2232,'adan f','0','0','0','0','5385','-5385','','18/Oct/2019','18/Oct/2019',''),(2233,'gina','0','0','0','1806','0','1806','','20/Oct/2019','20/Oct/2019',''),(2230,'xawo/hodan','0','0','0','4807','0','4807','','18/Oct/2019','18/Oct/2019',''),(2231,'sharif/imo','0','0','0','7442','40317','-32875','','18/Oct/2019','18/Oct/2019',''),(2226,'x.m farax','0','0','0','82692','0','82692','','18/Oct/2019','18/Oct/2019',''),(2219,'cumar/c.majid','0','0','0','50000','0','50000','','10/Oct/2019','10/Oct/2019',''),(2220,'abgalow','0','0','0','0','4822','-4822','','10/Sep/2019','10/Sep/2019',''),(2222,'abdulahi moyale','0','0','0','0','238076','-238076','','18/Oct/2019','18/Oct/2019',''),(2181,'cumar','0','0','0','144050','0','144050','','31/Aug/2019','31/Aug/2019',''),(2182,'khalif','0','0','0','110635','1485','109150','','31/Aug/2019','31/Aug/2019',''),(2183,'c.majid','0','0','0','140000','0','140000','','31/Aug/2019','31/Aug/2019',''),(2225,'duke','0','0','0','2840','0','2840','','18/Oct/2019','18/Oct/2019',''),(2186,'mama hodan','0','0','0','35000','120000','-85000','','26/Aug/2019','26/Aug/2019',''),(2227,'axmed qoxoti','0','0','0','0','47529','-47529','','18/Oct/2019','18/Oct/2019',''),(2217,'shariq','0','0','0','86376','287000','-200624','','01/Oct/2019','01/Oct/2019',''),(2228,'ganey','0','0','0','9615','0','9615','','18/Oct/2019','18/Oct/2019',''),(2192,'mama cabiyo','0','0','0','2000','0','2000','','01/Sep/2019','01/Sep/2019',''),(2223,'sadaq','0','0','0','0','119364','-119364','','18/Oct/2019','18/Oct/2019',''),(2221,'imo','0','0','0','80990','10385','70605','','18/Oct/2019','18/Oct/2019',''),(2215,'ahmed','0','0','0','0','4821','-4821','','13/Oct/2019','13/Oct/2019',''),(2199,'fadumo','0','0','0','1145','0','1145','','01/Sep/2019','01/Sep/2019',''),(2214,'ali kalay','0','0','0','173','0','173','','13/Oct/2019','13/Oct/2019',''),(2224,'shige','0','0','0','88452','0','88452','','18/Oct/2019','18/Oct/2019',''),(2216,'abdinasir','0','0','0','79660','10000','69660','','13/Oct/2019','13/Oct/2019',''),(2213,'mohamed/abdi','0','0','0','0','2035','-2035','','13/Oct/2019','13/Oct/2019','');
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

-- Dump completed on 2019-12-06  2:30:03
