<?php

require '../includes/inc_func.php';
 
if(if_logged_in() != true){
	die('login');
 }
 //crf_code:crf_code,car_name_new:car_name_new,car_price_new:car_price_new,car_price_type:car_price_type},function(feedback){
$car_name_new = sanitize($_POST['car_name_new']);  
$car_name_new = str_replace('Others','',$car_name_new); 
$car_price_new = sanitize($_POST['car_price_new']);
$car_price_type = sanitize($_POST['car_price_type']);
$crf_code = sanitize($_POST['crf_code']);
$currentDate = date('Y-m-d'); 
if(mysql_result(mysql_query("SELECT count('id') FROM `security` WHERE crf_token='$crf_code' and crf_token_status!='0'"), 0) != '0'){

if(mysql_result(mysql_query("select count(car_id) from cars where car_name='$car_name_new'  and $not_deleted"),0) != '0'){
  	exit("sorry <strong>$car_name_new </strong> is already exists !");
  }else{
		if($car_price_type != 'per... ' || !empty($car_name_new) || !empty($car_price_new)){			 
					mysql_query("INSERT INTO `cars`(`car_id`, `car_name`, `status`, `price`, `price_type`, `date`, `delete_status`) VALUES ('','$car_name_new','available','$car_price_new','$car_price_type','$currentDate','0') ");
					mysql_query("update security set crf_token_status='0' WHERE crf_token='$crf_code' "); // update the crf 
					echo '1';
		}else{
			echo 'sorry you have an error please refresh the page !';
		}
  }
}else{
	die('login');
}


?>