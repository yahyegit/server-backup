<?php

require '../includes/inc_func.php';
 
if(if_logged_in() != true){
	die('login');
 }
 //cust_id:cust_id,crf_code:crf_code,cust_name:cust_name,cust_mobile:cust_mobile,cust_email:cust_email},function(feedback){
$cust_name = sanitize($_POST['cust_name']);  
$cust_mobile = sanitize($_POST['cust_mobile']);
$cust_email = sanitize($_POST['cust_email']);
$cust_id = sanitize($_POST['cust_id']);
$crf_code = sanitize($_POST['crf_code']);
$currentDate = date('Y-m-d'); 

if(mysql_result(mysql_query("SELECT count('id') FROM `security` WHERE crf_token='$crf_code' and crf_token_status!='0'"), 0) != '0'){
 
 // if car exists 
 if(empty($cust_name)){
  	exit("customer name is required !");
  }else{
		mysql_query("UPDATE `customers` SET `customer_name`='$cust_name',`mobile`='$cust_mobile',`email`='$cust_email'  WHERE customer_id=$cust_id");
		 


		mysql_query("update security set crf_token_status='0' WHERE crf_token='$crf_code' "); // update the crf 
				echo '1';
	}
}else{
	die('login');
}


?>