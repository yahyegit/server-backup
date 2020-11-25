-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 22, 2019 at 07:37 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `geelayga`
--

-- --------------------------------------------------------

--
-- Table structure for table `crf`
--

CREATE TABLE `crf` (
  `id` int(11) NOT NULL,
  `crf_token` int(11) NOT NULL,
  `crf_token_status` int(11) NOT NULL,
  `expiration_date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crf`
--

INSERT INTO `crf` (`id`, `crf_token`, `crf_token_status`, `expiration_date`, `user_id`) VALUES
(890, 2015422254, 1, '2019-04-14', 0),
(891, 876850100, 1, '2019-04-14', 0),
(892, 1791025724, 1, '2019-04-14', 0),
(893, 1632835828, 1, '2019-04-14', 0),
(894, 189890040, 0, '2019-04-14', 0),
(895, 986093340, 0, '2019-04-14', 0),
(896, 1145416483, 0, '2019-04-14', 0),
(897, 1047223149, 0, '2019-04-14', 0),
(898, 938617524, 1, '2019-04-14', 0),
(899, 37146336, 1, '2019-04-14', 0),
(900, 1996882428, 1, '2019-04-14', 0),
(901, 1677398919, 1, '2019-04-14', 0),
(902, 1189727099, 0, '2019-04-14', 0),
(903, 1701349817, 0, '2019-04-14', 0),
(904, 1355744933, 0, '2019-04-14', 0),
(905, 1073117523, 1, '2019-04-14', 0),
(906, 927908701, 0, '2019-04-14', 0),
(907, 1955172392, 0, '2019-04-14', 0),
(908, 1085069298, 1, '2019-04-14', 0),
(909, 44607614, 1, '2019-04-18', 0),
(910, 385851289, 1, '2019-04-18', 0),
(911, 480004659, 1, '2019-04-18', 0),
(912, 2000052466, 1, '2019-04-21', 0),
(913, 438486342, 1, '2019-04-21', 0),
(914, 1283962055, 1, '2019-04-21', 0),
(915, 1275283710, 0, '2019-04-21', 0),
(916, 2122281759, 0, '2019-04-21', 0),
(917, 1876561215, 0, '2019-04-21', 0),
(918, 363357363, 0, '2019-04-21', 0),
(919, 577667915, 0, '2019-04-21', 0),
(920, 1473785653, 0, '2019-04-21', 0),
(921, 389103365, 1, '2019-04-21', 0),
(922, 1978739851, 0, '2019-04-21', 0),
(923, 1912179524, 0, '2019-04-21', 0),
(924, 2113190397, 1, '2019-04-21', 0),
(925, 1608743705, 0, '2019-04-21', 0),
(926, 2066987928, 1, '2019-04-21', 0),
(927, 1638618148, 1, '2019-04-21', 0),
(928, 119645503, 1, '2019-04-21', 0),
(929, 1604796161, 0, '2019-04-21', 0),
(930, 1545302805, 1, '2019-04-21', 0),
(931, 1818212181, 0, '2019-04-21', 0),
(932, 678452514, 1, '2019-04-21', 0),
(933, 419316948, 1, '2019-04-21', 0),
(934, 682035303, 0, '2019-04-21', 0),
(935, 1193583533, 0, '2019-04-21', 0),
(936, 1902521789, 0, '2019-04-21', 0),
(937, 1020097286, 1, '2019-04-21', 0),
(938, 1176913213, 1, '2019-04-21', 0),
(939, 1749175303, 1, '2019-04-21', 0),
(940, 1464182197, 1, '2019-04-21', 0),
(941, 121079727, 1, '2019-04-21', 0),
(942, 1837072519, 1, '2019-04-21', 0),
(943, 1807922263, 1, '2019-04-21', 0),
(944, 2059866710, 1, '2019-04-21', 0),
(945, 511278310, 1, '2019-04-21', 0),
(946, 1737880804, 1, '2019-04-21', 0),
(947, 982175151, 1, '2019-04-21', 0),
(948, 107007818, 1, '2019-04-21', 0),
(949, 1077040604, 1, '2019-04-21', 0),
(950, 616433329, 1, '2019-04-21', 0),
(951, 844803703, 1, '2019-04-21', 0),
(952, 1115761888, 1, '2019-04-21', 0),
(953, 502062837, 1, '2019-04-21', 0),
(954, 519190651, 1, '2019-04-21', 0),
(955, 1900594387, 1, '2019-04-21', 0),
(956, 1068588795, 1, '2019-04-21', 0),
(957, 1703339123, 1, '2019-04-21', 0),
(958, 1324682043, 1, '2019-04-21', 0),
(959, 1353392054, 1, '2019-04-21', 0),
(960, 445450688, 1, '2019-04-21', 0),
(961, 1619544172, 0, '2019-04-21', 0),
(962, 1519606548, 1, '2019-04-21', 0),
(963, 906021424, 1, '2019-04-21', 0),
(964, 504129999, 1, '2019-04-21', 0),
(965, 1336522814, 0, '2019-04-21', 0),
(966, 1504012905, 1, '2019-04-21', 0),
(967, 1067094250, 1, '2019-04-21', 0),
(968, 1567919785, 1, '2019-04-21', 0),
(969, 2043439224, 1, '2019-04-21', 0),
(970, 1984704913, 1, '2019-04-21', 0),
(971, 2013940309, 1, '2019-04-21', 0),
(972, 188423530, 1, '2019-04-21', 0),
(973, 589045224, 1, '2019-04-21', 0),
(974, 1461412914, 0, '2019-04-21', 0),
(975, 421242076, 1, '2019-04-21', 0),
(976, 1671159475, 1, '2019-04-21', 0),
(977, 521487023, 1, '2019-04-21', 0),
(978, 404726699, 1, '2019-04-21', 0),
(979, 928335457, 1, '2019-04-21', 0),
(980, 1513993958, 1, '2019-04-21', 0),
(981, 868177433, 1, '2019-04-21', 0),
(982, 1701499421, 1, '2019-04-21', 0),
(983, 629342628, 1, '2019-04-21', 0),
(984, 653207650, 0, '2019-04-21', 0),
(985, 148589872, 1, '2019-04-23', 0),
(986, 441577921, 1, '2019-04-23', 0),
(987, 1315605472, 1, '2019-04-23', 0),
(988, 917234347, 1, '2019-04-23', 0),
(989, 1085592284, 1, '2019-04-23', 0),
(990, 56405115, 1, '2019-04-23', 0),
(991, 836026511, 1, '2019-04-23', 0),
(992, 1443947473, 1, '2019-04-23', 0),
(993, 949784354, 1, '2019-04-23', 0),
(994, 1395197548, 1, '2019-04-23', 0),
(995, 1146162001, 1, '2019-04-23', 0),
(996, 693757235, 1, '2019-04-23', 0),
(997, 2101545443, 1, '2019-04-23', 0),
(998, 2015261141, 1, '2019-04-23', 0),
(999, 644394474, 1, '2019-04-23', 0),
(1000, 1449352990, 1, '2019-04-23', 0),
(1001, 908792524, 1, '2019-04-23', 0),
(1002, 780230607, 0, '2019-04-23', 0),
(1003, 2121019897, 1, '2019-04-23', 0),
(1004, 1806775144, 0, '2019-04-23', 0),
(1005, 1999315556, 0, '2019-04-23', 0),
(1006, 2135560781, 1, '2019-04-23', 0),
(1007, 1293046815, 0, '2019-04-23', 0),
(1008, 146622240, 0, '2019-04-23', 0),
(1009, 22003866, 0, '2019-04-23', 0),
(1010, 751090920, 0, '2019-04-23', 0),
(1011, 396613675, 0, '2019-04-23', 0),
(1012, 1126026902, 0, '2019-04-23', 0),
(1013, 1008558372, 1, '2019-04-23', 0),
(1014, 23612531, 0, '2019-04-23', 0),
(1015, 1111390323, 0, '2019-04-23', 0),
(1016, 1945588443, 0, '2019-04-23', 0),
(1017, 1384219112, 0, '2019-04-23', 0),
(1018, 581124619, 1, '2019-04-23', 0),
(1019, 66343208, 0, '2019-04-23', 0),
(1020, 916194926, 0, '2019-04-23', 0),
(1021, 357125925, 0, '2019-04-23', 0),
(1022, 654378750, 0, '2019-04-23', 0),
(1023, 1198950617, 0, '2019-04-23', 0),
(1024, 1519436132, 0, '2019-04-23', 0),
(1025, 160533888, 0, '2019-04-23', 0),
(1026, 745201505, 0, '2019-04-23', 0),
(1027, 1100631543, 0, '2019-04-23', 0),
(1028, 1172633094, 0, '2019-04-23', 0),
(1029, 630692437, 1, '2019-04-23', 0),
(1030, 441503226, 1, '2019-04-23', 0),
(1031, 1425361676, 0, '2019-04-23', 0),
(1032, 281005462, 1, '2019-04-24', 0),
(1033, 1122333272, 1, '2019-04-24', 0),
(1034, 1933003897, 1, '2019-04-24', 0),
(1035, 1689950206, 1, '2019-04-24', 0),
(1036, 364978243, 1, '2019-04-24', 0),
(1037, 1390396794, 1, '2019-04-24', 0),
(1038, 982408044, 1, '2019-04-24', 0),
(1039, 1599727811, 1, '2019-04-24', 0),
(1040, 1690676418, 1, '2019-04-24', 0),
(1041, 803556655, 1, '2019-04-24', 0),
(1042, 145938874, 1, '2019-04-24', 0),
(1043, 1452235609, 1, '2019-04-24', 0),
(1044, 675561136, 1, '2019-04-24', 0),
(1045, 965895846, 1, '2019-04-24', 0),
(1046, 113436364, 0, '2019-04-24', 0),
(1047, 1769910361, 0, '2019-04-24', 0),
(1048, 1210687197, 0, '2019-04-24', 0),
(1049, 1384405747, 1, '2019-04-24', 0),
(1050, 1951636496, 0, '2019-04-24', 0),
(1051, 85911612, 0, '2019-04-24', 0),
(1052, 520150957, 0, '2019-04-24', 0),
(1053, 188518840, 1, '2019-04-24', 0),
(1054, 943395237, 0, '2019-04-24', 0),
(1055, 1435023654, 1, '2019-04-24', 0),
(1056, 485845590, 0, '2019-04-24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `current_rate`
--

CREATE TABLE `current_rate` (
  `id` int(11) NOT NULL,
  `dollar_rate` float NOT NULL,
  `cash_rate` float NOT NULL,
  `date` date NOT NULL,
  `delete_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `current_rate`
--

INSERT INTO `current_rate` (`id`, `dollar_rate`, `cash_rate`, `date`, `delete_status`) VALUES
(1, 0.93, 0.95, '2019-03-04', 0),
(2, 100, 0.93, '2019-03-05', 0),
(3, 0, 0, '2019-03-27', 0),
(4, 0, 0, '2019-03-28', 0),
(5, 0, 0, '2019-03-29', 0),
(6, 0, 0, '2019-03-30', 0),
(7, 0, 0, '2019-04-06', 0),
(8, 0, 0, '2019-04-07', 0),
(9, 0, 0, '2019-04-12', 0),
(10, 103, 102, '2019-04-19', 0),
(11, 0, 0, '2019-04-21', 0),
(12, 93, 102, '2019-04-22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `current_ksh_balace` double NOT NULL,
  `current_dollar_balace` double NOT NULL,
  `delete_status` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `mobile`, `current_ksh_balace`, `current_dollar_balace`, `delete_status`) VALUES
(1, 'mohamed', '', 40000, 2000, 0),
(2, 'xalima', '', 102000, 122.58064516129, 0),
(3, 'yasiin', '', 152000, 0, 0),
(4, '', '', 0, 0, 0),
(5, '', '', 0, 0, 0),
(6, '', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `open_cash`
--

CREATE TABLE `open_cash` (
  `id` int(11) NOT NULL,
  `amount_ksh` double NOT NULL,
  `amount_dollar` double NOT NULL,
  `delete_status` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `pw_last_changed` date NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company_reg_session_id` varchar(200) NOT NULL,
  `current_lang` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `username`, `password`, `pw_last_changed`, `address`, `mobile`, `email`, `company_reg_session_id`, `current_lang`) VALUES
(0, 'ahsa', 'test', '50de6614e7baf61a941aae8e0a868d371546/>][7987^^&)51', '2019-04-19', '', '05555555', 'test@email.com', '', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount_ksh` double NOT NULL,
  `amount_dollar` double NOT NULL,
  `r_amount_ksh` double NOT NULL,
  `r_amount_dollar` double NOT NULL,
  `type_msg` text NOT NULL,
  `type` varchar(100) NOT NULL,
  `cash_rate` double NOT NULL,
  `dollar_rate` double NOT NULL,
  `date` date NOT NULL,
  `description` varchar(100) NOT NULL,
  `delete_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `customer_id`, `amount_ksh`, `amount_dollar`, `r_amount_ksh`, `r_amount_dollar`, `type_msg`, `type`, `cash_rate`, `dollar_rate`, `date`, `description`, `delete_status`) VALUES
(1, 1, 40000, 2000, 40000, 2000, ' <b> <b class=\"title_\">in:</b> $2,000.00 <span>and</span>  40,000.00 ksh  </b><p style=\"float: right;color: black;\"><span> Balance : </span><span class=\"in_color\" style=\"font-weight:normal\">40,000.00 ksh </span><span> and </span><span class=\"in_color\" style=\"font-weight:normal\">$2,000.00</span> </p>', 'in', 0, 0, '2019-04-22', '', 0),
(2, 2, 0, 200, 0, 200, ' <b> <b class=\"title_\">out:</b> $200.00  </b><p style=\"float: right;color: black;\"><span> Balance : </span><span class=\"in_color\" style=\"font-weight:normal\">0.00 ksh </span><span> and </span><span class=\"debt_color\" style=\"font-weight:normal\">$-,200.00</span> </p>', 'out', 0, 0, '2019-04-22', '', 0),
(3, 3, 152000, 0, 50000, 1000, ' <b> <b class=\"title_\">in:</b> 152,000.00 ksh  </b><br><p style=\" margin-top: 4px;    margin-left: 72px;\"> converted from $<span style=\"display:none !important\" _></span>1,000.00<span _ style=\"display:none !important\" conveted_dollar\r\n ></span>, puy rate was:102.00 ksh </p><p style=\"float: right;color: black;\"><span> Balance : </span><span class=\"in_color\" style=\"font-weight:normal\">152,000.00 ksh </span><span> and </span><span class=\"in_color\" style=\"font-weight:normal\">$0.00</span> </p>', 'in', 102, 0, '2019-04-22', '', 0),
(4, 4, 0, 100, 0, 100, '<b><b class=\" \">Exchange:</b>  $100.00  <span><i>To</i></span> 10,200.00 ksh, <span conveted_ksh >  puy rate: 102.00 ksh </span>   </b>', 'exchange', 102, 0, '2019-04-22', '', 0),
(5, 5, 1000, 200, 1000, 200, '<b><b class=\"\">Exchange:</b>  $200.00  <span><i>To</i></span> 20,400.00 ksh,  <span conveted_dollar > puy rate:  102.00 ksh </span> </b> <br><p tyle=\" margin-top: 4px;    margin-left: 72px;\">  and  <b>1,000.00 ksh</b> <span><i>To</i></span> <b>$10.75</b>,  <span conveted_ksh > sell rate: 93.00 ksh  </span> </p>', 'exchange', 102, 93, '2019-04-22', '', 1),
(6, 3, 10200, 32.25806451612903, 3000, 100, ' <b> <b class=\"title_\">in:</b> $32.26 <span>and</span>  10,200.00 ksh  </b><br><p style=\" margin-top: 4px;    margin-left: 72px;\"> converted from <span style=\"display:none !important\" _></span>3,000.00<span _ style=\"display:none !important\"  conveted_dollar  ></span> ksh , sell rate: 93.00 ksh <br>  and $<span style=\"display:none !important\" _></span>100.00<span _ style=\"display:none !important\" conveted_ksh  ></span>, puy rate :102.00ksh </p><p style=\"float: right;color: black;\"><span> Balance : </span><span class=\"in_color\" style=\"font-weight:normal\">162,200.00 ksh </span><span> and </span><span class=\"in_color\" style=\"font-weight:normal\">$32.26</span> </p>', 'in', 102, 93, '2019-04-22', '', 1),
(7, 6, 0, 0, 0, 0, ' <b> <b class=\"title_\">:</b>   </b><span style=\"    float: right;color: black;\"><span> Balance : </span><span class=\"in_color\" style=\"font-weight:normal\">0.00 ksh </span><span> and </span><span class=\"in_color\" style=\"font-weight:normal\">$0.00</span> </span>', 'in', 102, 93, '2019-04-22', '', 1),
(8, 2, 102000, 322.5806451612903, 30000, 1000, ' <b> <b class=\"title_\">in:</b> $322.58 <span>and</span>  102,000.00 ksh  </b><br><p style=\" margin-top: 4px;    margin-left: 13px;\"> converted from <span style=\"display:none !important\" _></span>30,000.00<span _ style=\"display:none !important\"  conveted_dollar  ></span> ksh , sell rate: 93.00 ksh <br>  and $<span style=\"display:none !important\" _></span>1,000.00<span _ style=\"display:none !important\" conveted_ksh  ></span>, puy rate :102.00ksh </p><span style=\"    float: right;color: black;\"><span> Balance : </span><span class=\"in_color\" style=\"font-weight:normal\">102,000.00 ksh </span><span> and </span><span class=\"in_color\" style=\"font-weight:normal\">$122.58</span> </span>', 'in', 102, 93, '2019-04-22', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crf`
--
ALTER TABLE `crf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `current_rate`
--
ALTER TABLE `current_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `open_cash`
--
ALTER TABLE `open_cash`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `date` (`date`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crf`
--
ALTER TABLE `crf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1057;

--
-- AUTO_INCREMENT for table `current_rate`
--
ALTER TABLE `current_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `open_cash`
--
ALTER TABLE `open_cash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;