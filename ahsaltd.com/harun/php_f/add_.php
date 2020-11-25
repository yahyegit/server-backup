<?php

require '../includes/inc_func.php';
 
if(if_logged_in() != true){
	die('login');
 }
						 
$customer_id = sanitize($_POST['customer_id']);
$customer_name = sanitize($_POST['customer_name']);
$rent_from_date =	date_corrector(sanitize($_POST['rent_from_date'])); 
$rent_to_date = date_corrector(sanitize($_POST['rent_to_date'])); 
$per_number = sanitize($_POST['per_number']);
$rent_price = sanitize($_POST['rent_price']);
$rent_paid = sanitize($_POST['rent_paid']); 
$rent_balance = $rent_price - $rent_paid; 
$rent_mobile = sanitize($_POST['rent_mobile']);
$due_date_rent = sanitize($_POST['due_date_rent']);

$rented_car_id = sanitize($_POST['rented_car_id']);
$rented_car_name = sanitize($_POST['rented_car_name']);
$rented_car_price_type = sanitize($_POST['rented_car_price_type']);
$rented_car_price = sanitize($_POST['rented_car_price']);
$currentDate = date('Y-m-d'); 
$crf_code = sanitize($_POST['crf_code']);

if(mysql_result(mysql_query("SELECT count('id') FROM `security` WHERE crf_token='$crf_code' and crf_token_status!='0'"), 0) != '0'){

		if(mysql_result(mysql_query("select count(car_id) from cars where car_name='$rented_car_name'  and $not_deleted"),0) != '0' && empty($rented_car_id)){
		  	exit("sorry <strong> ".$rented_car_name." </strong> is already exists, please choose from the dropdown menu!");
		  }



			 // add new customer
		   if(empty($customer_id)){
			 mysql_query("INSERT INTO `customers`(`customer_id`, `customer_name`, `mobile`, `email`, `date`, `delete_status`) VALUES ('','$customer_name','$rent_mobile','','$currentDate','0')");
			 $customer_id = mysql_result(mysql_query("select customer_id from customers ORDER BY customer_id DESC LIMIT 1"), 0); // last customer aded id
		 	}else{
		 	  mysql_query("UPDATE `customers` SET `mobile`='$rent_mobile' WHERE customer_id=$customer_id");
		 	}

		   if(empty($rented_car_id)){
		 	// add the new car 
		 	mysql_query("INSERT INTO `cars`(`car_id`, `car_name`, `status`, `price`, `price_type`, `date`, `delete_status`) VALUES ('','$rented_car_name','$customer_id','$rented_car_price','$rented_car_price_type','$currentDate','0') ");

 
		 	$rented_car_id =  mysql_result(mysql_query("select car_id from cars where car_name='$rented_car_name'"), 0);
		 	}else{
		 		 mysql_query("UPDATE `cars` SET `status`='$customer_id' WHERE car_id=$rented_car_id");

          $rented_car_price_type = mysql_result(mysql_query("select  price_type from cars where car_name='$rented_car_name'"), 0);


		 	} 

		 	// rent record 
		 	mysql_query("INSERT INTO `rented_cars`(`id`, `car_id`, `car_name`, `customer_id`, `from`, `to`, `price`, `price_type`, `paid`, `balance`, `date`, `due_date`, `delete_status`) VALUES ('','$rented_car_id','$rented_car_name','$customer_id','$rent_from_date','$rent_to_date','$rent_price','$rented_car_price_type','$rent_paid','$rent_balance','$currentDate','$due_date_rent','0')");
			 $rented_row_id = mysql_result(mysql_query("select id from rented_cars ORDER BY id DESC LIMIT 1"), 0); 
			 	 	
		 	// payment 
			 mysql_query("INSERT INTO `payments`(`id`, `paid`, `customer_id`, `car_id`, `car_name`, `rented_car_id`, `date`, `description`, `delete_status`) VALUES ('','$rent_paid','$customer_id',',$rented_car_id,','$rented_car_name','$rented_row_id','$rent_from_date','','0')");

			mysql_query("update security set crf_token_status='0' WHERE crf_token='$crf_code' "); // update the crf 

			set_car_avaible(); 
			echo '1';
}else{
	die('login');
}


?>
