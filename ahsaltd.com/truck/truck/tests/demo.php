<?php
  require '../includes/inc_func.php';
  
  for ($x = 0; $i <= 10; $i++) {

   //  mysql_query("INSERT INTO `expense`(`id`, `name`, `quantity`, `type`, `cost`, `description`, `date`, `delete_status`) VALUES ('','expense test $i Driver license No (888889999$i)','20','test','2000','Description test ','2017-1-23','0')");
	$truck_no = register("T001$i","driver name $i","888889999$i",'0755555555');
	 $unit  = $i + 1000;
	$quantity = 1000;
	$cost = $unit * $quantity;
	

					mysql_query("INSERT INTO `trucks`(`id`, `truck_no`, `driverName`, `driverLicenseNo`, `source`, `distination`, `cost`,`quantity`,`unit_price`, `date`, `description`, `delete_status`,`mobile`) VALUES ('','$truck_no','driver name $i','888889999$i','narobi','garissa','$cost','$quantity','$unit','2017-1-23','description test','0','0755555555')");
	  					$currentTripId = (!empty($truck_no))?mysql_result(mysql_query("SELECT id FROM `trucks` WHERE `truck_no`='$truck_no' ORDER BY id desc limit 1"),0):'';
					mysql_query("INSERT INTO `expense`(`id`,  `tripId`, `name`, `quantity`, `type`, `cost`, `description`, `date`, `delete_status`) VALUES ('','$currentTripId','expense test $i , Truck No ($truck_no)','1','salary','30000','Description test ','2017-1-23','0')");
					mysql_query("INSERT INTO `expense`(`id`,  `tripId`, `name`, `quantity`, `type`, `cost`, `description`, `date`, `delete_status`) VALUES ('','$currentTripId','fault $i , Truck No ($truck_no)','1','mileage','5000','Description test ','2017-1-25','0')");
					mysql_query("INSERT INTO `expense`(`id`,  `tripId`, `name`, `quantity`, `type`, `cost`, `description`, `date`, `delete_status`) VALUES ('','$currentTripId','Rent $i , Truck No ($truck_no)','1','billing','50000','Description test ','2017-1-21','0')");

					
					
					mysql_query("INSERT INTO `trucks`(`id`, `truck_no`, `driverName`, `driverLicenseNo`, `source`, `distination`, `cost`,`quantity`,`unit_price`, `date`, `description`, `delete_status`,`mobile`) VALUES ('','$truck_no','driver name $i','888889999$i','narobi','garissa','$cost','$quantity','$unit','2017-1-23','description test','0','0755555555')");
	  	
			$currentTripId = (!empty($truck_no))?mysql_result(mysql_query("SELECT id FROM `trucks` WHERE `truck_no`='$truck_no' ORDER BY id desc limit 1"),0):'';
					mysql_query("INSERT INTO `expense`(`id`,  `tripId`, `name`, `quantity`, `type`, `cost`, `description`, `date`, `delete_status`) VALUES ('','$currentTripId','expense test $i , Truck No ($truck_no)','1','salary','30000','Description test ','2017-1-23','0')");
					mysql_query("INSERT INTO `expense`(`id`,  `tripId`, `name`, `quantity`, `type`, `cost`, `description`, `date`, `delete_status`) VALUES ('','$currentTripId','fault $i , Truck No ($truck_no)','1','mileage','5000','Description test ','2017-1-25','0')");
					mysql_query("INSERT INTO `expense`(`id`,  `tripId`, `name`, `quantity`, `type`, `cost`, `description`, `date`, `delete_status`) VALUES ('','$currentTripId','Rent $i , Truck No ($truck_no)','1','billing','5000','Description test ','2017-1-21','0')");

					
					
		mysql_query("INSERT INTO `trucks`(`id`, `truck_no`, `driverName`, `driverLicenseNo`, `source`, `distination`, `cost`,`quantity`,`unit_price`, `date`, `description`, `delete_status`,`mobile`) VALUES ('','$truck_no','driver name $i','888889999$i','narobi','garissa','$cost','$quantity','$unit','2017-1-23','description test','0','0755555555')");
	  
					$currentTripId = (!empty($truck_no))?mysql_result(mysql_query("SELECT id FROM `trucks` WHERE `truck_no`='$truck_no' ORDER BY id desc limit 1"),0):'';
					mysql_query("INSERT INTO `expense`(`id`,  `tripId`, `name`, `quantity`, `type`, `cost`, `description`, `date`, `delete_status`) VALUES ('','$currentTripId','expense test $i , Truck No ($truck_no)','1','salary','30000','Description test ','2017-1-23','0')");
					mysql_query("INSERT INTO `expense`(`id`,  `tripId`, `name`, `quantity`, `type`, `cost`, `description`, `date`, `delete_status`) VALUES ('','$currentTripId','fault $i , Truck No ($truck_no)','1','mileage','5000','Description test ','2017-1-25','0')");
					mysql_query("INSERT INTO `expense`(`id`,  `tripId`, `name`, `quantity`, `type`, `cost`, `description`, `date`, `delete_status`) VALUES ('','$currentTripId','Rent $i , Truck No ($truck_no)','1','billing','5000','Description test ','2017-1-21','0')");

	
} 
   


   
     //  mysql_query("INSERT INTO `expense`(`id`, `name`, `quantity`, `type`, `cost`, `description`, `date`, `delete_status`) VALUES ('','expense test $i Driver license No (888889999$i)','20','test','2000','Description test ','2017-1-23','0')");
	$i = 1;
	$truck_no = register("T001$i","driver name $i","888889999$i",'0755555555');
	 $unit  = $i + 1000;
	$quantity = 1000;
	$cost = $unit * $quantity;
	

					mysql_query("INSERT INTO `trucks`(`id`, `truck_no`, `driverName`, `driverLicenseNo`, `source`, `distination`, `cost`,`quantity`,`unit_price`, `date`, `description`, `delete_status`,`mobile`) VALUES ('','$truck_no','driver name $i','888889999$i','narobi','garissa','$cost','$quantity','$unit','2017-1-23','description test','0','0755555555')");
	  					$currentTripId = (!empty($truck_no))?mysql_result(mysql_query("SELECT id FROM `trucks` WHERE `truck_no`='$truck_no' ORDER BY id desc limit 1"),0):'';
					mysql_query("INSERT INTO `expense`(`id`,  `tripId`, `name`, `quantity`, `type`, `cost`, `description`, `date`, `delete_status`) VALUES ('','$currentTripId','expense test $i , Truck No ($truck_no)','1','salary','30000','Description test ','2017-1-23','0')");
					mysql_query("INSERT INTO `expense`(`id`,  `tripId`, `name`, `quantity`, `type`, `cost`, `description`, `date`, `delete_status`) VALUES ('','$currentTripId','fault $i , Truck No ($truck_no)','1','mileage','5000','Description test ','2017-1-25','0')");
					mysql_query("INSERT INTO `expense`(`id`,  `tripId`, `name`, `quantity`, `type`, `cost`, `description`, `date`, `delete_status`) VALUES ('','$currentTripId','Rent $i , Truck No ($truck_no)','1','billing','50000000','Description test ','2017-1-21','0')");

					 
   
   
?>