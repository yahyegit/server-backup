<?php

require '../includes/inc_func.php';
 
if(if_logged_in() != true){
	die('login');
 }


$paid_amount = sanitize($_POST['paid_amount']);
$description = sanitize($_POST['description']);
$payment_date = date_corrector(sanitize($_POST['payment_date']));
$payment_date = (substr($payment_date,0,4) == '1970')?date('Y-m-d'):$payment_date;
$customer_id = sanitize($_POST['customer_id']);
$crf_code = sanitize($_POST['crf_code']);

if(mysql_result(mysql_query("SELECT count('id') FROM `security` WHERE crf_token='$crf_code' and crf_token_status!='0'"), 0) != '0'){
		if(!empty($paid_amount)){
			// make the pament 
			make_payment($paid_amount,$customer_id,$payment_date,$description);
			
			mysql_query("update security set crf_token_status='0' WHERE crf_token='$crf_code' "); // update the crf 
			echo '1';
		}else{
			echo 'sorry you have an error please refresh the page !';
		}
}else{
	die('login');
}


?>