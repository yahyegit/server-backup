<?php

require 'includes/inc_func.php';
 
$email = sanitize($_POST['car_name_new']);  
 
if(mysql_result(mysql_query("SELECT count('id') FROM `settings` WHERE `company_email`='$email'"), 0) != '0'){
		// send the reset code now 
		$reset_code = get_unique_code('reset');
		mail();
		
}else{
	die('sorry email is not found in the system !');
}


?>