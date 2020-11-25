<?php

require '../includes/inc_func.php';
 
if(if_logged_in() != true){
	die('login');
 }
						 
$x_id = sanitize($_POST['x_id']);
$x_name = sanitize($_POST['x_name']);
$x_quantity = sanitize($_POST['x_quantity']); 
$x_cost = sanitize($_POST['x_cost']); 
$x_car_name = sanitize($_POST['x_car_name']);
$x_date = sanitize(date_corrector($_POST['x_date']));
$crf_code = sanitize($_POST['crf_code']);
$x_car_id = mysql_result(mysql_query("select car_id from cars where car_name='$x_car_name'"), 0);

if(mysql_result(mysql_query("SELECT count('id') FROM `security` WHERE crf_token='$crf_code' and crf_token_status!='0'"), 0) != '0'){

					mysql_query("UPDATE `expense` SET `expense_name`='$x_name',`quantity`='$x_quantity',`cost`='$x_cost',`car_id`='$x_car_id',`car_name`='$x_car_name',`date`='$x_date' WHERE `id`=$x_id");

					mysql_query("update security set crf_token_status='0' WHERE crf_token='$crf_code' "); // update the crf 
					echo '1';
}else{
	die('login');
}


?>