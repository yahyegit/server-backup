<?php

require 'includes/inc_func.php';
 
if(if_logged_in() != true){
	die('login');
 }
 
 check_code_expiration(); 
$new_password = sanitize(strtolower($_POST['new_password']));  
$reset_code = sanitize(strtolower($_POST['reset_code']));

if(mysql_result(mysql_query("SELECT count('id') FROM `security` WHERE pass_reset_code='$reset_code' and pass_reset_code_status!='0'"), 0) != '0'){

		if(!empty($new_password)){
			$new_password = '4e25e'.md5(md5($new_password.'!@#$#%^%^*(345/\,').'8b8b300300').'8b3'; 
 
					mysql_query("update settings set password='$new_password'");
					mysql_query("update security set `pass_reset_code_status`='0' WHERE  pass_reset_code='$reset_code'");
					echo '1';
		}else{
			echo 'new password is empty';
		}

}else{
	die('your reset code is expired please request new one !');
}


?>