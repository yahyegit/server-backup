 -- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 26, 2020 at 08:37 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 5.6.40-13+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_moha`
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
(166, 1350068301, 0, '2020-04-28', 0);

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
  `description` int(11) NOT NULL,
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
  `company_reg_session_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `username`, `password`, `pw_last_changed`, `address`, `mobile`, `email`, `company_reg_session_id`) VALUES
(1, 'mohamed', 'mohamed', '46ca13903fff4181ab3867d9684ebae41546/>][7987^^&)51', '2019-03-05', '', '05555555', 'test@email.com', '');

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
  `delete_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `password`, `type`, `responsibility`, `status`, `delete_status`) VALUES
(10, 'mohamed', 'mohamed', 'fc112bc2464793f384c62ebd42be3cae1546/>][7987^^&)51', 'admin', '', 1, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `recieved_history`
--
ALTER TABLE `recieved_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;