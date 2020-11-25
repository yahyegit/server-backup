-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 07, 2020 at 02:15 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 5.6.40-13+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kunkeen_sarif`
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
(67, 1819016939, 1, '2020-01-08', 0),
(68, 1205108897, 1, '2020-01-08', 0),
(69, 1998876709, 1, '2020-01-08', 0),
(70, 175607547, 1, '2020-01-08', 0),
(71, 811839140, 1, '2020-01-08', 0),
(72, 2009239386, 1, '2020-01-08', 0),
(73, 1806036716, 1, '2020-01-08', 0),
(74, 1113991415, 1, '2020-01-08', 0),
(75, 1804418101, 1, '2020-01-08', 0),
(76, 773411688, 1, '2020-01-08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `delete_status` int(2) NOT NULL
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
(0, 'sarif', 'ljk', '8f03824088987fbbb8e47de563f204f81546/>][7987^^&)51', '2020-02-07', '', '555-555-555', 'test@email.com', '', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `currency` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  `type` varchar(100) NOT NULL,
  `sell_rate` double NOT NULL,
  `buy_rate` double NOT NULL,
  `conv_to_currency` varchar(100) NOT NULL,
  `converted_result` double NOT NULL,
  `profit` double NOT NULL,
  `description` varchar(300) NOT NULL,
  `msg_type` text NOT NULL,
  `date` date NOT NULL,
  `delete_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD PRIMARY KEY (`customer_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
