SET FOREIGN_KEY_CHECKS = 0;

-- 
-- Table structure for table `history` 
-- 

DROP TABLE IF EXISTS `history`;
CREATE TABLE `history` (
`id` int(22) NOT NULL auto_increment,
`full_name` varchar(100) NOT NULL,
`cash_in` int(20) NOT NULL,
`cash_out` int(20) NOT NULL,
`blance` int(20) NOT NULL,
`doller_in` int(20) NOT NULL,
`doller_out` int(20) NOT NULL,
`doller_blance` int(20) NOT NULL,
`number` varchar(20) NOT NULL,
`date` varchar(50) NOT NULL,
`id_card` int(20) NOT NULL,
`months` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1069;

-- --------------------------------------------------------

-- 
-- Table structure for table `login_in` 
-- 

DROP TABLE IF EXISTS `login_in`;
CREATE TABLE `login_in` (
`id` int(11) NOT NULL auto_increment,
`username_e` varchar(100) NOT NULL,
`password_w` varchar(200) NOT NULL,
`ip_address` varchar(22) NOT NULL,
`active_ip` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2;

-- --------------------------------------------------------

-- 
-- Table structure for table `main_details` 
-- 

DROP TABLE IF EXISTS `main_details`;
CREATE TABLE `main_details` (
`id` int(20) NOT NULL auto_increment,
`full_name` varchar(100) NOT NULL,
`cash_in` int(20) NOT NULL,
`cash_out` int(20) NOT NULL,
`blance` int(20) NOT NULL,
`doller_in` int(20) NOT NULL,
`doller_out` int(20) NOT NULL,
`doller_blance` int(20) NOT NULL,
`number` varchar(100) NOT NULL,
`time` varchar(100) NOT NULL,
`date` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=310;

-- --------------------------------------------------------

-- 
-- Table structure for table `oppen_day` 
-- 

DROP TABLE IF EXISTS `oppen_day`;
CREATE TABLE `oppen_day` (
`id` int(11) NOT NULL auto_increment,
`name` varchar(100) NOT NULL,
`cash_in` int(20) NOT NULL,
`cash_out` int(20) NOT NULL,
`blance` int(20) NOT NULL,
`dolla_in` int(20) NOT NULL,
`dolla_out` int(20) NOT NULL,
`dolla_blance` int(20) NOT NULL,
`date` varchar(30) NOT NULL,
`month` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47;

-- --------------------------------------------------------

-- 
-- Dumping data for table `history` 
-- 

INSERT INTO `history` (`id`, `full_name`, `cash_in`, `cash_out`, `blance`, `doller_in`, `doller_out`, `doller_blance`, `number`, `date`, `id_card`, `months`) VALUES ('1050','mohamed','0','9000','-9000','100','0','100','','21/Feb/2015 @ 07:12:06 am','299','02/2015'),
 ('1051','mohamed','0','0','0','0','0','0','0701653365','21/Feb/2015 @ 07:12:31 am','299','02/2015'),
 ('1052','xalima','20000','0','20000','0','200','-200','072222222','21/Feb/2015 @ 07:13:50 am','300','02/2015'),
 ('1053','cabdalla','0','9000','-9000','100','0','100','0723459258','22/Feb/2015 @ 08:22:05 am','301','02/2015'),
 ('1054','cabdalla','200000','0','200000','0','0','0','0723459258','22/Feb/2015 @ 08:24:27 am','301','02/2015'),
 ('1061','muse ahmed','9000','0','9000','0','100','-100','0700200222','06/Apr/2015 @ 07:41:39 am','306','04/2015'),
 ('1056','unknown','0','9000','-9000','100','0','100','','22/Feb/2015 @ 08:41:50 am','303','02/2015'),
 ('1058','Muse','9000','0','9000','0','0','0','','11/Mar/2015 @ 12:04:08 pm','304','03/2015'),
 ('1059','Muse','0','1000','-1000','0','0','0','','11/Mar/2015 @ 12:05:27 pm','304','03/2015'),
 ('1060','yasin','1000','0','1000','0','0','0','','05/Apr/2015 @ 09:59:39 am','305','04/2015'),
 ('1062','ahmed`','200000','0','200000','0','0','0','07222222','06/Apr/2015 @ 07:42:59 am','307','04/2015'),
 ('1063','muse ahmed','0','0','0','2000','0','2000','0700200222','06/Apr/2015 @ 07:43:52 am','306','04/2015'),
 ('1064','muse ahmed','0','1000','-1000','0','200','-200','0700200222','06/Apr/2015 @ 07:44:39 am','306','04/2015'),
 ('1065','ahmed abdi','5000000','0','5000000','0','5000','-5000','07546464333','07/Apr/2015 @ 08:19:11 am','308','04/2015'),
 ('1066','harun','20000','0','20000','900','0','900','','07/Apr/2015 @ 01:02:22 pm','309','04/2015'),
 ('1067','harun','0','0','0','0','0','0','','07/Apr/2015 @ 01:04:50 pm','309','04/2015'),
 ('1068','mohamed','9000','0','9000','0','100','-100','0701653365','21/Apr/2015 @ 05:44:50 am','299','04/2015');

-- --------------------------------------------------------

-- 
-- Dumping data for table `login_in` 
-- 

INSERT INTO `login_in` (`id`, `username_e`, `password_w`, `ip_address`, `active_ip`) VALUES ('1','yahye','f933db339227df3bfc0ed001d7bce599b4f9c8c51','105.57.60.38','1');

-- --------------------------------------------------------

-- 
-- Dumping data for table `main_details` 
-- 

INSERT INTO `main_details` (`id`, `full_name`, `cash_in`, `cash_out`, `blance`, `doller_in`, `doller_out`, `doller_blance`, `number`, `time`, `date`) VALUES ('299','mohamed','9000','9000','0','100','100','0','0701653365','21/Apr/2015 @ 05:44:50 am','21/Apr/2015'),
 ('300','xalima','20000','0','20000','0','200','-200','072222222','21/Feb/2015 @ 07:13:50 am','21/Feb/2015'),
 ('301','cabdalla','200000','9000','191000','100','0','100','0723459258','22/Feb/2015 @ 08:24:27 am','22/Feb/2015'),
 ('302','yahye mohamed','0','0','0','0','0','0','0701653365','25/Feb/2015 @ 01:09:37 am','25/Feb/2015'),
 ('303','unknown','0','9000','-9000','100','0','100','','22/Feb/2015 @ 08:41:50 am','22/Feb/2015'),
 ('304','Muse','9000','1000','8000','0','0','0','','11/Mar/2015 @ 12:05:27 pm','11/Mar/2015'),
 ('305','yasin','1000','0','1000','0','0','0','','05/Apr/2015 @ 09:59:39 am','05/Apr/2015'),
 ('306','muse ahmed','9000','1000','8000','2000','300','1700','0700200222','06/Apr/2015 @ 07:44:39 am','06/Apr/2015'),
 ('307','ahmed`','200000','0','200000','0','0','0','07222222','06/Apr/2015 @ 07:42:59 am','06/Apr/2015'),
 ('308','ahmed abdi','5000000','0','5000000','0','5000','-5000','07546464333','07/Apr/2015 @ 08:19:11 am','07/Apr/2015'),
 ('309','harun','20000','0','20000','900','0','900','','07/Apr/2015 @ 01:04:50 pm','07/Apr/2015');

-- --------------------------------------------------------

-- 
-- Dumping data for table `oppen_day` 
-- 

INSERT INTO `oppen_day` (`id`, `name`, `cash_in`, `cash_out`, `blance`, `dolla_in`, `dolla_out`, `dolla_blance`, `date`, `month`) VALUES ('41','test day','100000','0','100000','4200','0','4200','21/Feb/2015','02/2015'),
 ('42','22 feb 2015','500000','0','500000','2000','0','2000','22/Feb/2015','02/2015'),
 ('43','Mo','222','11','211','10','5','5','11/Mar/2015','03/2015'),
 ('44','6 - april - 2015','2000000','500000','1500000','20000','0','20000','06/Apr/2015','04/2015'),
 ('45','dalmar musa','400000','70000','330000','5000','400','4600','07/Apr/2015','04/2015'),
 ('46','21/04/2015','10000','0','10000','1000','0','1000','21/Apr/2015','04/2015');

-- --------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 1;

