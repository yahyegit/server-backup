<?php

require 'includes/inc_func.php';
 
 //crf_code:crf_code,car_name_new:car_name_new,car_price_new:car_price_new,car_price_type:car_price_type},function(feedback){
$email = sanitize($_POST['email']);  

if(mysql_result(mysql_query("SELECT count('id') FROM `settings` WHERE `company_email`='$email'"), 0) != '0'){

		$reset_code = get_unique_code('reset');
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."?reset=$reset_code";
		$body = "
		 username:".mysql_result(mysql_query("SELECT username FROM `settings` WHERE `company_email`='$email'"), 0)."   \n
		 password resert link: $actual_link \n 
		 <a href='$actual_link' title='click to reset your password' > reset password</a>
		";
	    echo "($email,".mysql_result(mysql_query("select company_name from settings limit 1"),0)." Password Reset ,$body,From: $email);"
	   
}else{
	die('sorry email is not found in the system !');
}


?>