<?php

require '../includes/inc_func.php';
 
if(if_logged_in() != true){
	die('login');
 }
 //crf_code:crf_code,car_name_new:car_name_new,car_price_new:car_price_new,car_price_type:car_price_type},function(feedback){
$table = sanitize($_POST['table']);  
$id = sanitize($_POST['id']);
$colmn = sanitize($_POST['colmn']);
$crf_code = sanitize($_POST['crf_code']);
$customer_id = mysql_result(mysql_query("SELECT `customer_id` FROM `$table` WHERE id=".sanitize($_POST['id'])),0);

$currentDate = date('Y-m-d'); 
if(mysql_result(mysql_query("SELECT count('id') FROM `security` WHERE crf_token='$crf_code' and crf_token_status!='0'"), 0) != '0'){
	 
		 			 if($table == 'customers'){ // customer account  			 	
		 			 	mysql_query("UPDATE `rented_cars` set `delete_status`='1' WHERE `customer_id`='$id'");
		 			 	mysql_query("UPDATE `payments` set `delete_status`='1' WHERE `customer_id`='$id'"); 
		 			 	mysql_query("UPDATE `customers` set `delete_status`='1' WHERE `$colmn`='$id'");


		 				mysql_query("UPDATE `cars` SET `status`='available' WHERE `status`='$id'");

		 			 }else if($table == 'rented_cars'){
			 			 // free the car befor delete 
			            $to_date = mysql_result(mysql_query("SELECT `to` FROM `rented_cars` WHERE `id`=$id and `to`>='$currentDate'"), 0);
						$car_id_rented = mysql_result(mysql_query("SELECT `car_id` FROM `rented_cars` WHERE `id`=$id and `to`>='$currentDate'"), 0);
						if(!empty($to_date)){
							// free the car now
							 mysql_query("UPDATE `cars` SET `status`='available' WHERE car_id='$car_id_rented'");
						}

		 			 	mysql_query("UPDATE `$table` set `delete_status`='1' WHERE `id`='$id'");
		 			 	mysql_query("UPDATE `payments` set `delete_status`='1' WHERE `rented_car_id`='$id' and customer_id='$customer_id' and  `delete_status`!='1'");

		 			 }else if($table == 'payments'){ 
		 			 	 
		 			 	$rented_colm_id = mysql_result(mysql_query("SELECT `rented_car_id` FROM `payments` WHERE id=".sanitize($_POST['id'])),0);
		 			 	$payment = mysql_result(mysql_query("SELECT `paid` FROM `payments` WHERE id=".sanitize($_POST['id'])),0);	

		 			 	if(!empty($rented_colm_id)){
		 			 		mysql_query("update rented_cars set `paid`='$payment', `balance`=`price`-$payment WHERE id=".$rented_colm_id);
		 			 	}else{
		 			 		 reverse_payment($payment,$customer_id);
		 			 	}
						mysql_query("UPDATE `$table` set `delete_status`='1' WHERE `$colmn`='$id'");	
		 			 }else{
		 			 	mysql_query("UPDATE `$table` set `delete_status`='1' WHERE `$colmn`='$id'");	
		 			 } 
						
					mysql_query("update security set crf_token_status='0' WHERE crf_token='$crf_code' "); // update the crf 
					echo '1';
 
}else{
	die('login');
}


?>