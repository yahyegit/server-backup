-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2017 at 08:14 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transportation`
--

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `cost` int(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `delete_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `name`, `quantity`, `type`, `cost`, `description`, `date`, `delete_status`) VALUES
(1, '`name`(888e)', '20', 'test', 20, 'test', '2017-01-18', 0),
(2, 'test', '22', 'test1', 222, 'test', '2017-01-18', 0),
(3, 'test  ', '333', 'type test', 3333333, 'test dex', '2017-01-20', 0),
(4, 'test', '333', 'type test', 3333333, 'test dex', '2017-01-19', 0),
(5, 'test name (9999999999)', '1', 'extra', 1000, '', '2017-01-19', 0),
(6, '`name`(888e)', '1', 'extra', 8000, '', '2017-01-20', 0),
(7, '`name`(888e)', '2', 'test type_', 9000, 'test t2', '2017-01-20', 0),
(8, 'testName e,  Driver license No (999999999991e),  Truck No (9991e)', '9', 'typeTest', 8000, 'test des', '2017-01-20', 0),
(9, '`name`(0999999)', '1', 'extra', 9000, '', '2017-01-20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `trucks`
--

CREATE TABLE `trucks` (
  `id` int(11) NOT NULL,
  `truck_no` varchar(100) NOT NULL,
  `driverName` varchar(100) NOT NULL,
  `driverLicenseNo` varchar(100) NOT NULL,
  `source` varchar(100) NOT NULL,
  `distination` varchar(100) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(100) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `mobile` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trucks`
--

INSERT INTO `trucks` (`id`, `truck_no`, `driverName`, `driverLicenseNo`, `source`, `distination`, `cost`, `date`, `description`, `delete_status`, `mobile`) VALUES
(1, 'D100 l', '!hhhh', '0999999', 'garissa l', 'nakuru l', '100', '2017-01-20', 'test l', 0, '88888'),
(2, '888e', 'teste', '999', '88', '888', '88888', '0000-00-00', '8888888', 0, '99999'),
(3, '99995', 'test 5', '8888885', '8885', '85', '885', '2017-01-19', '88885', 0, '8888'),
(4, '9999', 'test', '888888', '888', '8', '88', '0000-00-00', '8888', 0, '8888'),
(5, 'T10000', 'test name', '9999999999', 'garaisa', 'hell', '20000', '2017-01-19', 'test transports', 0, '88888888'),
(6, '88888', 'test ex', '88888888', 'hello', 'hell', '300', '2017-01-19', 'test ext', 0, '9999999999'),
(7, 'e200', 'ehhhh', '0999999', 'from', 'to', '33333', '2017-01-20', '', 0, '88888');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trucks`
--
ALTER TABLE `trucks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `trucks`
--
ALTER TABLE `trucks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
