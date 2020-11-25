<?php
  require '../includes/inc_func.php';
  
 mysql_query('DELETE FROM `trucks`');
 mysql_query('DELETE FROM `registerd_trucks`');
 mysql_query('DELETE FROM `expense`');
 
  mysql_query('CREATE TABLE `trucks` (
  `id` int(11) NOT NULL,
  `truck_no` varchar(100) NOT NULL,
  `driverName` varchar(100) NOT NULL,
  `driverLicenseNo` varchar(100) NOT NULL,
  `source` varchar(100) NOT NULL,
  `distination` varchar(100) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `quantity` varchar(200) NOT NULL,
  `unit_price` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(100) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `mobile` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;');

mysql_query('
ALTER TABLE `trucks`
  ADD PRIMARY KEY (`id`);');

mysql_query('ALTER TABLE `trucks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');

  // ----
  
  
  
  
  mysql_query('CREATE TABLE `registerd_trucks` (
  `id` int(11) NOT NULL,
  `truck_no` varchar(100) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `driverName` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `driverLicenseNo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;');

mysql_query('
ALTER TABLE `registerd_trucks`
  ADD PRIMARY KEY (`id`);');

mysql_query('ALTER TABLE `registerd_trucks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
  
  // -- 
mysql_query('CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `tripId` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `cost` int(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `delete_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
');					 
   
mysql_query('ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);
');

mysql_query('ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');
  
?>