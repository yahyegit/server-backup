<?php

require '../includes/inc_func.php';
 
if(if_logged_in() != true){
	die('login');
 }
 
$sql_colmn = sanitize(strtolower($_POST['sql_colmn']));  
$edit_value = sanitize(strtolower($_POST['edit_value']));  
$crf_code = sanitize(strtolower($_POST['crf_code']));  



if(mysql_result(mysql_query("SELECT count('id') FROM `security` WHERE crf_token='$crf_code' and crf_token_status!='0'"), 0) != '0'){


if($sql_colmn == 'currency'){
	mysql_query("update currency set status='0'");
	mysql_query("update currency set status='1' where currency='$edit_value'");
	echo '1';
}else{
		if(!empty($edit_value)){
			mysql_query("update settings set $sql_colmn='$edit_value'");
			mysql_query("update security set crf_token_status='0' WHERE crf_token='$crf_code' ");
			echo '1';
		}else{
			echo 'error empty field ';
		}
	
}


}else{
	die('login');
}

?>