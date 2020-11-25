-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 19, 2020 at 11:43 PM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 5.6.40-13+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_bajtradinglimited`
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
(1, 1649807532, 1, '2020-01-06', 0),
(2, 909982417, 1, '2020-01-06', 0),
(3, 1673610751, 1, '2020-01-06', 0),
(4, 672377783, 1, '2020-01-06', 0),
(5, 605471117, 0, '2020-01-06', 0),
(6, 2055985282, 0, '2020-01-06', 0),
(7, 1549262252, 1, '2020-01-06', 0),
(8, 2060415472, 1, '2020-01-06', 0),
(9, 2140473750, 1, '2020-01-07', 0),
(10, 48629361, 1, '2020-01-07', 0),
(11, 2020159134, 1, '2020-01-07', 0),
(12, 125834378, 1, '2020-01-07', 0),
(13, 1613400413, 1, '2020-01-07', 0),
(14, 581259490, 1, '2020-01-07', 0),
(15, 1083942573, 1, '2020-01-07', 0),
(16, 1263086654, 1, '2020-01-07', 0),
(17, 1971387516, 1, '2020-01-07', 0),
(18, 1933465445, 1, '2020-01-07', 0),
(19, 334238882, 1, '2020-01-07', 0),
(20, 117628209, 1, '2020-01-07', 0),
(21, 93391727, 1, '2020-01-07', 0),
(22, 1064743876, 1, '2020-01-07', 0),
(23, 789665720, 1, '2020-01-07', 0),
(24, 670553762, 1, '2020-01-07', 0),
(25, 223623551, 1, '2020-01-07', 0),
(26, 186957706, 1, '2020-01-07', 0),
(27, 1568375759, 1, '2020-01-07', 0),
(28, 277685311, 1, '2020-01-07', 0),
(29, 1504331460, 1, '2020-01-07', 0),
(30, 1906827373, 1, '2020-01-07', 0),
(31, 2098092571, 1, '2020-01-07', 0),
(32, 1245249619, 1, '2020-01-07', 0),
(33, 1208423083, 1, '2020-01-07', 0),
(34, 1286456759, 1, '2020-01-07', 0),
(35, 477709183, 1, '2020-01-07', 0),
(36, 1852400830, 1, '2020-01-07', 0),
(37, 1152991239, 1, '2020-01-07', 0),
(38, 1648632256, 1, '2020-01-07', 0),
(39, 488990079, 1, '2020-01-07', 0),
(40, 1509899059, 1, '2020-01-07', 0),
(41, 1004444180, 1, '2020-01-07', 0),
(42, 317036779, 1, '2020-01-07', 0),
(43, 202033897, 1, '2020-01-08', 0),
(44, 1893208162, 1, '2020-01-08', 0),
(45, 1417042008, 0, '2020-01-08', 0),
(46, 2117460139, 0, '2020-01-08', 0),
(47, 104453282, 1, '2020-01-08', 0),
(48, 1216799664, 1, '2020-01-08', 0),
(49, 726066345, 1, '2020-01-08', 0),
(50, 249575407, 1, '2020-01-08', 0),
(51, 787503199, 1, '2020-01-08', 0),
(52, 1562876294, 1, '2020-01-08', 0),
(53, 1809441288, 1, '2020-01-08', 0),
(54, 753144885, 1, '2020-01-08', 0),
(55, 213250097, 1, '2020-01-08', 0),
(56, 1571637818, 1, '2020-01-08', 0),
(57, 762468754, 1, '2020-01-08', 0),
(58, 634166707, 1, '2020-01-08', 0),
(59, 1836656095, 1, '2020-01-08', 0),
(60, 117895988, 1, '2020-01-08', 0),
(61, 1665915831, 1, '2020-01-08', 0),
(62, 720210740, 1, '2020-01-08', 0),
(63, 1958483036, 1, '2020-01-08', 0),
(64, 565246013, 1, '2020-01-08', 0),
(65, 897334615, 1, '2020-01-08', 0),
(66, 1254492824, 1, '2020-01-08', 0),
(67, 159662323, 1, '2020-01-08', 0),
(68, 1200510518, 1, '2020-01-08', 0),
(69, 686022130, 1, '2020-01-08', 0),
(70, 856097534, 1, '2020-01-08', 0),
(71, 694343620, 1, '2020-01-08', 0),
(72, 1546829120, 1, '2020-01-08', 0),
(73, 1693795039, 1, '2020-01-08', 0),
(74, 567729562, 1, '2020-01-08', 0),
(75, 755062079, 0, '2020-04-26', 0),
(76, 1363944707, 0, '2020-04-26', 0),
(77, 1122225657, 1, '2020-04-26', 0),
(78, 577893956, 0, '2020-04-26', 0),
(79, 355135438, 0, '2020-04-26', 0),
(80, 1051485744, 0, '2020-04-26', 0),
(81, 1640960197, 0, '2020-04-26', 0),
(82, 2049465476, 1, '2020-04-26', 0),
(83, 709448150, 1, '2020-04-26', 0),
(84, 371606721, 1, '2020-04-26', 0),
(85, 1863039959, 1, '2020-04-26', 0),
(86, 179928712, 1, '2020-04-26', 0),
(87, 37346603, 1, '2020-04-26', 0),
(88, 374467506, 1, '2020-04-26', 0),
(89, 513082623, 1, '2020-04-26', 0),
(90, 1842403674, 1, '2020-04-26', 0),
(91, 1011372666, 1, '2020-04-26', 0),
(92, 506736269, 1, '2020-04-26', 0),
(93, 1789109143, 1, '2020-04-26', 0),
(94, 839119594, 1, '2020-04-26', 0),
(95, 1369332240, 1, '2020-04-26', 0),
(96, 185528583, 1, '2020-04-26', 0),
(97, 887969843, 1, '2020-04-26', 0),
(98, 962455477, 0, '2020-04-26', 0),
(99, 296796040, 0, '2020-04-26', 0),
(100, 168397479, 0, '2020-04-26', 0),
(101, 1334539920, 0, '2020-04-26', 0),
(102, 114598826, 0, '2020-04-26', 0),
(103, 649666352, 0, '2020-04-26', 0),
(104, 328687021, 1, '2020-04-26', 0),
(105, 903194043, 0, '2020-04-26', 0),
(106, 1239545603, 0, '2020-04-26', 0),
(107, 2096961957, 1, '2020-04-26', 0),
(108, 1192882200, 1, '2020-04-26', 0),
(109, 421442031, 1, '2020-04-26', 0),
(110, 1700290951, 1, '2020-04-26', 0),
(111, 314089628, 1, '2020-04-26', 0),
(112, 1314436403, 1, '2020-04-26', 0),
(113, 1418991882, 1, '2020-04-26', 0),
(114, 1315844549, 1, '2020-04-26', 0),
(115, 1649796499, 1, '2020-04-26', 0),
(116, 990275892, 1, '2020-04-26', 0),
(117, 1487801545, 1, '2020-04-26', 0),
(118, 1931618868, 1, '2020-04-26', 0),
(119, 119029785, 1, '2020-04-26', 0),
(120, 106001508, 1, '2020-04-26', 0),
(121, 334091196, 1, '2020-04-26', 0),
(122, 220072352, 1, '2020-04-26', 0),
(123, 1163717335, 1, '2020-04-26', 0),
(124, 150054049, 1, '2020-04-26', 0),
(125, 405051139, 1, '2020-04-26', 0),
(126, 194725583, 1, '2020-04-26', 0),
(127, 1126720589, 1, '2020-04-26', 0),
(128, 1126738429, 0, '2020-04-26', 0),
(129, 2109142305, 1, '2020-04-26', 0),
(130, 789971312, 0, '2020-04-27', 0),
(131, 1395855193, 1, '2020-04-27', 0),
(132, 727368275, 0, '2020-04-27', 0),
(133, 1244648231, 0, '2020-04-27', 0),
(134, 1990904939, 0, '2020-04-27', 0),
(135, 63432236, 0, '2020-04-27', 0),
(136, 486037666, 0, '2020-04-27', 0),
(137, 667958343, 0, '2020-04-27', 0),
(138, 407561252, 0, '2020-04-27', 0),
(139, 1639000572, 0, '2020-04-27', 0),
(140, 855822000, 0, '2020-04-27', 0),
(141, 1245952682, 0, '2020-04-27', 0),
(142, 926100575, 0, '2020-04-27', 0),
(143, 1215832637, 1, '2020-04-27', 0),
(144, 1457193279, 1, '2020-04-28', 0),
(145, 479902098, 1, '2020-04-28', 0),
(146, 644983181, 0, '2020-04-28', 0),
(147, 1210868620, 1, '2020-04-28', 0),
(148, 861810046, 0, '2020-04-28', 0),
(149, 333944468, 1, '2020-04-28', 0),
(150, 1341984368, 1, '2020-04-28', 0),
(151, 954555923, 1, '2020-04-28', 0),
(152, 315758635, 1, '2020-04-28', 0),
(153, 50398452, 1, '2020-04-28', 0),
(154, 565270601, 1, '2020-04-28', 0),
(155, 758778742, 0, '2020-04-28', 0),
(156, 1654393741, 1, '2020-04-28', 0),
(157, 1852363774, 1, '2020-04-28', 0),
(158, 1576598488, 0, '2020-04-28', 0),
(159, 1763206306, 0, '2020-04-28', 0),
(160, 669109466, 1, '2020-04-28', 0),
(161, 1283483469, 0, '2020-04-28', 0),
(162, 1283554510, 0, '2020-04-28', 0),
(163, 1408084979, 1, '2020-04-28', 0),
(164, 1582396360, 0, '2020-04-28', 0),
(165, 1645508534, 0, '2020-04-28', 0),
(166, 1350068301, 0, '2020-04-28', 0),
(167, 118225940, 1, '2020-05-21', 0),
(168, 1903157325, 1, '2020-05-21', 0),
(169, 1944839394, 1, '2020-05-21', 0),
(170, 1356895519, 1, '2020-05-21', 0),
(171, 1793778769, 1, '2020-05-21', 0),
(172, 683048399, 1, '2020-05-21', 0),
(173, 386132186, 1, '2020-05-21', 0),
(174, 398629369, 1, '2020-05-21', 0),
(175, 1065284277, 1, '2020-05-21', 0),
(176, 1974656846, 1, '2020-05-21', 0),
(177, 404845687, 1, '2020-05-21', 0),
(178, 1156694007, 1, '2020-05-21', 0),
(179, 1347351427, 1, '2020-05-21', 0),
(180, 924211710, 1, '2020-05-21', 0),
(181, 1152863674, 1, '2020-05-21', 0),
(182, 1075688285, 1, '2020-05-21', 0),
(183, 1793645852, 1, '2020-05-21', 0),
(184, 2126570463, 1, '2020-05-21', 0),
(185, 1635967389, 1, '2020-05-21', 0),
(186, 1810587852, 1, '2020-05-21', 0),
(187, 2000688248, 1, '2020-05-21', 0),
(188, 597869595, 1, '2020-05-21', 0),
(189, 194519045, 1, '2020-05-21', 0),
(190, 905167350, 1, '2020-05-21', 0),
(191, 1285150811, 1, '2020-05-21', 0),
(192, 1649944878, 1, '2020-05-21', 0),
(193, 1125834763, 1, '2020-05-21', 0),
(194, 783187638, 1, '2020-05-21', 0),
(195, 1566726240, 1, '2020-05-21', 0),
(196, 801475931, 1, '2020-05-21', 0),
(197, 1241304111, 1, '2020-05-21', 0),
(198, 1436310867, 1, '2020-05-21', 0),
(199, 648566547, 1, '2020-05-21', 0),
(200, 242515879, 1, '2020-05-21', 0),
(201, 1425380283, 1, '2020-05-21', 0),
(202, 289223081, 1, '2020-05-21', 0),
(203, 1746028499, 1, '2020-05-21', 0),
(204, 13536886, 1, '2020-05-21', 0),
(205, 311381273, 1, '2020-05-21', 0),
(206, 550589352, 1, '2020-05-21', 0),
(207, 1316933653, 1, '2020-05-21', 0),
(208, 1134738402, 1, '2020-05-21', 0),
(209, 1877701559, 1, '2020-05-21', 0),
(210, 1353982068, 1, '2020-05-21', 0),
(211, 597577713, 1, '2020-05-21', 0),
(212, 1298614801, 1, '2020-05-21', 0),
(213, 971744358, 1, '2020-05-21', 0),
(214, 1590860526, 1, '2020-05-21', 0),
(215, 1873246443, 1, '2020-05-21', 0),
(216, 1562648327, 1, '2020-05-21', 0),
(217, 478684949, 1, '2020-05-21', 0),
(218, 504112137, 1, '2020-05-21', 0),
(219, 362633041, 0, '2020-05-21', 0),
(220, 475039564, 1, '2020-05-21', 0),
(221, 758195333, 1, '2020-05-21', 0),
(222, 1286516804, 1, '2020-05-21', 0),
(223, 1091550947, 1, '2020-08-09', 0),
(224, 1426925648, 1, '2020-08-09', 0),
(225, 1511803512, 1, '2020-08-09', 0),
(226, 792830923, 0, '2020-08-09', 0),
(227, 300683404, 1, '2020-08-09', 0),
(228, 1411515785, 1, '2020-08-09', 0),
(229, 54177051, 1, '2020-08-09', 0),
(230, 494878997, 1, '2020-08-09', 0),
(231, 188620623, 1, '2020-08-09', 0),
(232, 1458302936, 0, '2020-08-09', 0),
(233, 415792934, 0, '2020-08-09', 0),
(234, 1853351841, 1, '2020-08-09', 0),
(235, 1546056582, 1, '2020-08-09', 0),
(236, 1380487919, 1, '2020-08-09', 0),
(237, 1412437899, 1, '2020-08-09', 0),
(238, 2093937625, 1, '2020-08-09', 0),
(239, 1200877744, 1, '2020-08-09', 0),
(240, 1640072273, 1, '2020-08-09', 0),
(241, 1563382721, 1, '2020-08-09', 0),
(242, 1560980627, 1, '2020-08-09', 0),
(243, 393492570, 1, '2020-08-09', 0),
(244, 1360428361, 0, '2020-08-09', 0),
(245, 210925117, 1, '2020-08-09', 0),
(246, 1112752100, 1, '2020-08-09', 0),
(247, 1912744551, 1, '2020-08-09', 0),
(248, 308389795, 0, '2020-08-09', 0),
(249, 1249433914, 1, '2020-08-09', 0),
(250, 789104167, 0, '2020-08-09', 0),
(251, 1511345820, 0, '2020-08-10', 0),
(252, 126716322, 1, '2020-08-10', 0),
(253, 1627102402, 1, '2020-08-10', 0),
(254, 581879812, 1, '2020-08-10', 0),
(255, 1654443209, 0, '2020-08-10', 0),
(256, 1039190693, 1, '2020-08-10', 0),
(257, 2125254799, 1, '2020-08-10', 0),
(258, 1693859009, 1, '2020-08-10', 0),
(259, 1974430930, 1, '2020-08-10', 0),
(260, 805579647, 0, '2020-08-10', 0),
(261, 237072866, 1, '2020-08-10', 0),
(262, 1153647857, 1, '2020-08-11', 0),
(263, 1502856829, 0, '2020-09-20', 0),
(264, 830683722, 1, '2020-09-20', 0),
(265, 116911658, 0, '2020-09-20', 0),
(266, 83763909, 1, '2020-09-20', 0),
(267, 788423119, 1, '2020-09-20', 0),
(268, 564322103, 1, '2020-09-20', 0),
(269, 1792141805, 0, '2020-09-20', 0),
(270, 738414470, 1, '2020-09-20', 0),
(271, 611983286, 1, '2020-09-20', 0),
(272, 809112041, 1, '2020-09-20', 0),
(273, 1024074146, 1, '2020-09-20', 0),
(274, 1181344979, 1, '2020-09-20', 0),
(275, 1262421169, 1, '2020-09-20', 0),
(276, 1416219749, 1, '2020-09-21', 0),
(277, 1921639017, 0, '2020-09-21', 0),
(278, 475928476, 1, '2020-09-21', 0),
(279, 1796345820, 1, '2020-09-21', 0),
(280, 543296859, 0, '2020-09-21', 0),
(281, 1874157793, 0, '2020-09-21', 0),
(282, 1675068419, 0, '2020-09-21', 0),
(283, 56308215, 0, '2020-09-21', 0),
(284, 661268279, 0, '2020-09-21', 0),
(285, 1645644202, 1, '2020-09-21', 0),
(286, 391302610, 1, '2020-09-21', 0),
(287, 593260315, 1, '2020-09-21', 0),
(288, 128850889, 0, '2020-09-21', 0),
(289, 1345413121, 1, '2020-09-21', 0),
(290, 2133415399, 1, '2020-09-21', 0),
(291, 613576084, 0, '2020-09-21', 0),
(292, 479340559, 1, '2020-09-21', 0),
(293, 1330853468, 0, '2020-09-21', 0),
(294, 566219509, 0, '2020-09-21', 0),
(295, 1530694067, 1, '2020-09-21', 0),
(296, 359623879, 0, '2020-09-21', 0),
(297, 1661333864, 1, '2020-09-21', 0),
(298, 1793197333, 1, '2020-09-21', 0),
(299, 1050346643, 1, '2020-09-21', 0),
(300, 1279831185, 0, '2020-09-21', 0),
(301, 553573632, 1, '2020-09-21', 0),
(302, 2100712614, 0, '2020-09-21', 0),
(303, 953872104, 0, '2020-09-21', 0),
(304, 329840172, 0, '2020-09-21', 0),
(305, 1750412635, 1, '2020-09-21', 0),
(306, 803879473, 0, '2020-09-21', 0),
(307, 1272629467, 1, '2020-09-21', 0),
(308, 819220259, 1, '2020-09-21', 0),
(309, 454987811, 0, '2020-09-21', 0),
(310, 1732046833, 0, '2020-09-21', 0),
(311, 365441750, 0, '2020-09-21', 0),
(312, 1115655756, 0, '2020-09-21', 0),
(313, 1438344439, 1, '2020-09-21', 0),
(314, 1016376268, 1, '2020-09-21', 0),
(315, 893489316, 0, '2020-09-21', 0),
(316, 1753481714, 0, '2020-09-21', 0),
(317, 1732600558, 0, '2020-09-21', 0),
(318, 1902768250, 0, '2020-09-21', 0),
(319, 1905085142, 0, '2020-09-21', 0),
(320, 673715983, 0, '2020-09-21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `last_date` date NOT NULL,
  `current_balance` double NOT NULL,
  `address` varchar(100) NOT NULL,
  `delete_status` int(2) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `cost` double NOT NULL,
  `description` varchar(600) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `quantity` double NOT NULL,
  `price` double NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_number` int(11) NOT NULL,
  `paid` double NOT NULL,
  `status` varchar(100) NOT NULL,
  `profit` double NOT NULL,
  `address` varchar(100) NOT NULL,
  `balance` double NOT NULL,
  `delevered_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `remainings` double NOT NULL,
  `delete_status` int(2) NOT NULL,
  `remaining_cost` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `paid` double NOT NULL,
  `discount` double NOT NULL,
  `date` date NOT NULL,
  `user_id` int(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `order_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recieved_history`
--

CREATE TABLE `recieved_history` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `cost` double NOT NULL,
  `quantity` double NOT NULL,
  `description` varchar(200) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `date` date NOT NULL,
  `s_id` int(11) NOT NULL,
  `order_number` varchar(100) NOT NULL
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
  `currency` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `username`, `password`, `pw_last_changed`, `address`, `mobile`, `email`, `company_reg_session_id`, `currency`) VALUES
(1, 'BAJTRADINGLIMITED', 'mohamed', '46ca13903fff4181ab3867d9684ebae41546/>][7987^^&)51', '2019-03-05', '', '05555555', 'test@email.com', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `s_name` varchar(200) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `current_balance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_payments`
--

CREATE TABLE `s_payments` (
  `id` int(11) NOT NULL,
  `paid` double NOT NULL,
  `date` date NOT NULL,
  `delete_status` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `s_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `responsibility` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `current_lang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `password`, `type`, `responsibility`, `status`, `delete_status`, `current_lang`) VALUES
(10, 'mohamed', 'Mohamud', '64adc6c500e6240b04d8ef5b4955f5681546/>][7987^^&)51', 'admin', '', 1, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crf`
--
ALTER TABLE `crf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recieved_history`
--
ALTER TABLE `recieved_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_payments`
--
ALTER TABLE `s_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crf`
--
ALTER TABLE `crf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `recieved_history`
--
ALTER TABLE `recieved_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `s_payments`
--
ALTER TABLE `s_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
