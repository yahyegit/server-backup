<?php

require '../includes/inc_func.php';
 
if(if_logged_in() != true){
	die('login');
 }
/* 
set_car_avaible();
echo number_format(mysql_result(mysql_query("SELECT count(`car_id`) FROM `cars` WHERE `status`='available' and `delete_status`!=1"), 0));
*/

?>