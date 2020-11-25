<?php
  require '../includes/inc_func.php';
  
  for ($x = 5; $i <= 10; $i++) {
	   mysql_query("INSERT INTO `expense`(`id`, `name`, `quantity`, `type`, `cost`, `description`, `date`, `delete_status`) VALUES ('','expense test $i Truck No (T2001$i)','20','test','2000','Description test ','2017-1-23','0')");
	
   //  mysql_query("INSERT INTO `expense`(`id`, `name`, `quantity`, `type`, `cost`, `description`, `date`, `delete_status`) VALUES ('','expense test $i Driver license No (888889999$i)','20','test','2000','Description test ','2017-1-23','0')");
	  mysql_query("INSERT INTO `trucks`(`id`, `truck_no`, `driverName`, `driverLicenseNo`, `source`, `distination`, `cost`, `date`, `description`, `delete_status`,`mobile`) VALUES ('','T2001$i','driver name $i','888889999$i','narobi','garissa','2000','2017-1-23','description test','0','0755555555')");

} 
   


?>