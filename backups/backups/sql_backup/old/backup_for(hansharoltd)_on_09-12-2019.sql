-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: localhost    Database: hansharoltd
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
) ENGINE=MyISAM AUTO_INCREMENT=49906 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
INSERT INTO `history` VALUES (49868,'Ahmed Yamani','0','0','0','50000','0','50000','','18/Oct/2019',2162,'10/2019','to adizone investment'),(49862,'Abdi Shire','60000','0','60000','0','0','0','','18/Oct/2019',2156,'10/2019',''),(49863,'Abdirashiid Mohamed Abdi','0','0','0','0','14850','-14850','','18/Oct/2019',2157,'10/2019',''),(49864,'Actros KCJ 634C','400600','0','400600','0','0','0','','18/Oct/2019',2158,'10/2019',''),(49865,'Adizone Investment','0','0','0','0','200000','-200000','','18/Oct/2019',2159,'10/2019',''),(49866,'Ahmed George','0','5000','-5000','0','0','0','','18/Oct/2019',2160,'10/2019',''),(49867,'Ahmed Mohamed Hersi','1904000','0','1904000','10250','0','10250','','18/Oct/2019',2161,'10/2019',''),(49869,'Amal A\\c','0','0','0','0','68120','-68120','','18/Oct/2019',2163,'10/2019',''),(49870,'Anab Ali xagaaa','0','0','0','0','7000','-7000','','18/Oct/2019',2164,'10/2019',''),(49871,'Bashir Adan','0','2600000','-2600000','0','0','0','','18/Oct/2019',2165,'10/2019',''),(49872,'Amal Cafa','0','0','0','0','0','0','','18/Oct/2019',2166,'10/2019',''),(49873,'Dukanka','0','0','0','0','13050','-13050','','18/Oct/2019',2167,'10/2019',''),(49874,'Fadumo Qambi','0','0','0','0','108820','-108820','','18/Oct/2019',2168,'10/2019',''),(49875,'Farah Adan Gaab harun','0','0','0','25000','0','25000','','18/Oct/2019',2169,'10/2019','to harun  amal ac'),(49876,'Fartun Xansharo','0','0','0','1000','0','1000','','18/Oct/2019',2170,'10/2019',''),(49877,'Garweyne','0','300000','-300000','0','0','0','','18/Oct/2019',2171,'10/2019',''),(49878,'GulfAfrican Bank','0','0','0','0','0','0','','18/Oct/2019',2172,'10/2019',''),(49879,'Hajir','0','100000','-100000','0','0','0','','18/Oct/2019',2173,'10/2019',''),(49880,'Hansharo Rental Cars','1013550','0','1013550','3150','0','3150','','18/Oct/2019',2174,'10/2019',''),(49881,'Harun Adizone','0','0','0','100000','0','100000','','18/Oct/2019',2175,'10/2019','to adizome Investment'),(49882,'Harun Hansharo','0','1606410','-1606410','0','21095','-21095','','18/Oct/2019',2176,'10/2019',''),(49883,'KBY FIELD','0','173000','-173000','0','0','0','','18/Oct/2019',2177,'10/2019',''),(49884,'KCF342V','534000','0','534000','0','0','0','','18/Oct/2019',2178,'10/2019',''),(49885,'Khalif ilkodahab','0','0','0','40000','0','40000','','18/Oct/2019',2179,'10/2019',''),(49905,'Muse Foodcade','0','0','0','1900','0','1900','','18/Oct/2019',2198,'10/2019','qaaran from dahir abshir'),(49887,'Luul Ahmed','0','0','0','0','10407','-10407','','18/Oct/2019',2181,'10/2019',''),(49888,'Mahad Muse','0','0','0','0','20000','-20000','','18/Oct/2019',2182,'10/2019',''),(49889,'Maryan Duulo','0','0','0','0','51000','-51000','','18/Oct/2019',2183,'10/2019',''),(49890,'Maryan Gafaje','0','0','0','0','9600','-9600','','18/Oct/2019',2184,'10/2019',''),(49891,'Maryan Kamas Adizone','0','0','0','10000','0','10000','','18/Oct/2019',2185,'10/2019','to adizone investment'),(49892,'Maryan Kamas self','0','0','0','6926','0','6926','','18/Oct/2019',2186,'10/2019',''),(49893,'Mohamed Dayib','29000','0','29000','0','0','0','','18/Oct/2019',2187,'10/2019',''),(49894,'Muxubo Tubako','0','0','0','0','7810','-7810','','18/Oct/2019',2188,'10/2019',''),(49895,'Osman Cige','0','12000','-12000','0','0','0','','18/Oct/2019',2189,'10/2019',''),(49896,'Primo','0','15000','-15000','0','0','0','','18/Oct/2019',2190,'10/2019',''),(49897,'Inni garyar qaran','0','0','0','7750','0','7750','','18/Oct/2019',2191,'10/2019',''),(49898,'Fadumo Qambi','0','0','0','2800','0','-106020','','18/Oct/2019',2168,'10/2019',''),(49899,'Rahmo Asad','0','0','0','0','30000','-30000','','18/Oct/2019',2192,'10/2019',''),(49900,'Sacdiyo Adan Salax','0','0','0','0','1000','-1000','','18/Oct/2019',2193,'10/2019',''),(49901,'Sadiiq Farah Abdi','701000','0','701000','0','10800','-10800','','18/Oct/2019',2194,'10/2019',''),(49902,'Safar Construction','0','0','0','0','16150','-16150','','18/Oct/2019',2195,'10/2019',''),(49903,'Sharif Osman MPLS','0','0','0','40000','0','40000','','18/Oct/2019',2196,'10/2019','to Adizone investment'),(49904,'Xawo Koronto Ayuto','0','0','0','0','3000','-3000','','18/Oct/2019',2197,'10/2019','');
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
INSERT INTO `login_in` VALUES (1,'harun','0c0f2c9d6f694b16ca1d1747c582c795b4f9c8c51','41.84.141.62',0);
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
) ENGINE=MyISAM AUTO_INCREMENT=2199 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `main_details`
--

LOCK TABLES `main_details` WRITE;
/*!40000 ALTER TABLE `main_details` DISABLE KEYS */;
INSERT INTO `main_details` VALUES (2156,'Abdi Shire','60000','0','60000','0','0','0','','18/Oct/2019','18/Oct/2019',''),(2157,'Abdirashiid Mohamed Abdi','0','0','0','0','14850','-14850','','18/Oct/2019','18/Oct/2019',''),(2158,'Actros KCJ 634C','400600','0','400600','0','0','0','','18/Oct/2019','18/Oct/2019',''),(2159,'Adizone Investment','0','0','0','0','200000','-200000','','18/Oct/2019','18/Oct/2019',''),(2160,'Ahmed George','0','5000','-5000','0','0','0','','18/Oct/2019','18/Oct/2019',''),(2161,'Ahmed Mohamed Hersi','1904000','0','1904000','10250','0','10250','','18/Oct/2019','18/Oct/2019',''),(2162,'Ahmed Yamani','0','0','0','50000','0','50000','','18/Oct/2019','18/Oct/2019',''),(2163,'Amal A\\c','0','0','0','0','68120','-68120','','18/Oct/2019','18/Oct/2019',''),(2164,'Anab Ali xagaaa','0','0','0','0','7000','-7000','','18/Oct/2019','18/Oct/2019',''),(2165,'Bashir Adan','0','2600000','-2600000','0','0','0','','18/Oct/2019','18/Oct/2019',''),(2166,'Amal Cafa','0','0','0','0','0','0','','18/Oct/2019','18/Oct/2019',''),(2167,'Dukanka','0','0','0','0','13050','-13050','','18/Oct/2019','18/Oct/2019',''),(2168,'Fadumo Qambi','0','0','0','2800','108820','-106020','','18/Oct/2019','18/Oct/2019',''),(2169,'Farah Adan Gaab harun','0','0','0','25000','0','25000','','18/Oct/2019','18/Oct/2019',''),(2170,'Fartun Xansharo','0','0','0','1000','0','1000','','18/Oct/2019','18/Oct/2019',''),(2171,'Garweyne','0','300000','-300000','0','0','0','','18/Oct/2019','18/Oct/2019',''),(2172,'GulfAfrican Bank','0','0','0','0','0','0','','18/Oct/2019','18/Oct/2019',''),(2173,'Hajir','0','100000','-100000','0','0','0','','18/Oct/2019','18/Oct/2019',''),(2174,'Hansharo Rental Cars','1013550','0','1013550','3150','0','3150','','18/Oct/2019','18/Oct/2019',''),(2175,'Harun Adizone','0','0','0','100000','0','100000','','18/Oct/2019','18/Oct/2019',''),(2176,'Harun Hansharo','0','1606410','-1606410','0','21095','-21095','','18/Oct/2019','18/Oct/2019',''),(2177,'KBY FIELD','0','173000','-173000','0','0','0','','18/Oct/2019','18/Oct/2019',''),(2178,'KCF342V','534000','0','534000','0','0','0','','18/Oct/2019','18/Oct/2019',''),(2179,'Khalif ilkodahab','0','0','0','40000','0','40000','','18/Oct/2019','18/Oct/2019',''),(2198,'Muse Foodcade','0','0','0','1900','0','1900','','18/Oct/2019','18/Oct/2019',''),(2181,'Luul Ahmed','0','0','0','0','10407','-10407','','18/Oct/2019','18/Oct/2019',''),(2182,'Mahad Muse','0','0','0','0','20000','-20000','','18/Oct/2019','18/Oct/2019',''),(2183,'Maryan Duulo','0','0','0','0','51000','-51000','','18/Oct/2019','18/Oct/2019',''),(2184,'Maryan Gafaje','0','0','0','0','9600','-9600','','18/Oct/2019','18/Oct/2019',''),(2185,'Maryan Kamas Adizone','0','0','0','10000','0','10000','','18/Oct/2019','18/Oct/2019',''),(2186,'Maryan Kamas self','0','0','0','6926','0','6926','','18/Oct/2019','18/Oct/2019',''),(2187,'Mohamed Dayib','29000','0','29000','0','0','0','','18/Oct/2019','18/Oct/2019',''),(2188,'Muxubo Tubako','0','0','0','0','7810','-7810','','18/Oct/2019','18/Oct/2019',''),(2189,'Osman Cige','0','12000','-12000','0','0','0','','18/Oct/2019','18/Oct/2019',''),(2190,'Primo','0','15000','-15000','0','0','0','','18/Oct/2019','18/Oct/2019',''),(2191,'Inni garyar qaran','0','0','0','7750','0','7750','','18/Oct/2019','18/Oct/2019',''),(2192,'Rahmo Asad','0','0','0','0','30000','-30000','','18/Oct/2019','18/Oct/2019',''),(2193,'Sacdiyo Adan Salax','0','0','0','0','1000','-1000','','18/Oct/2019','18/Oct/2019',''),(2194,'Sadiiq Farah Abdi','701000','0','701000','0','10800','-10800','','18/Oct/2019','18/Oct/2019',''),(2195,'Safar Construction','0','0','0','0','16150','-16150','','18/Oct/2019','18/Oct/2019',''),(2196,'Sharif Osman MPLS','0','0','0','40000','0','40000','','18/Oct/2019','18/Oct/2019',''),(2197,'Xawo Koronto Ayuto','0','0','0','0','3000','-3000','','18/Oct/2019','18/Oct/2019','');
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
) ENGINE=MyISAM AUTO_INCREMENT=1535 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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
INSERT INTO `settings` VALUES (1,'777');
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

-- Dump completed on 2019-12-09  2:30:03
