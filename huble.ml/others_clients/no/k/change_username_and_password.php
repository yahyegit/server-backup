<?php

require 'connet.php';


  if(if_logged_in() != true){
die();
 }
 	



if(isset($_POST['_username']) && isset($_POST['password']) && isset($_POST['new_user'])){

$_username		=   mysql_real_escape_string(strtolower(htmlentities($_POST['_username'])));
$_pass		=   mysql_real_escape_string(strtolower(htmlentities($_POST['password'])));
$new_user		=    mysql_real_escape_string(strtolower(htmlentities($_POST['new_user'])));
	

 
	if(!empty($_username)){
		$pass = md5($_pass.'!@%#$').'b4f9c8c51';
			
			$query_chack = "SELECT count(username_e) FROM login_in WHERE username_e = '$_username' and password_w='$pass'"; 
				  $query_run    =   mysql_query($query_chack);
				
					if (mysql_result($query_run, 0) == 1){
						$update_query = "UPDATE login_in SET username_e='$new_user'";
						mysql_query($update_query);
						echo 2;		
					}else if (mysql_result($query_run, 0) == 0){
						echo 'incorrect username/password!';
					
					}else {
					
						echo 'error please try again!!';
					}
					
					
					
					
					
					
					
					
				
	}else {
	echo 'please fill all fields!';
	}


}

if(isset($_POST['c_username']) && isset($_POST['c_pass']) && isset($_POST['new_pass'])){

$c_username		=   mysql_real_escape_string(strtolower(htmlentities($_POST['c_username'])));
$c_pass		=    mysql_real_escape_string(strtolower(htmlentities($_POST['c_pass'])));
$new_pass		=   mysql_real_escape_string(strtolower(htmlentities($_POST['new_pass'])));
	
 
 
 
 // protection of keyloger 
if(strstr($new_pass,'.')){
exit('<p style="color:red; font:bold 12px italic;"> password can\'t contain dot .  !</p>');
}
 
 
 
 
 
	if(!empty($c_username)){
		$c_pass5 = md5($c_pass.'!@%#$').'b4f9c8c51';
		$new_pass1 = md5($new_pass.'!@%#$').'b4f9c8c51';
		
			$query_chack = "SELECT count(username_e) FROM login_in WHERE username_e = '$c_username' and password_w='$c_pass5'"; 
				  $query_run    =   mysql_query($query_chack);
				if (@mysql_result($query_run, 0) == 1){
					$update_query = "UPDATE login_in SET password_w='$new_pass1'";
					mysql_query($update_query);
						echo 2;		
					}else {
					echo'incorrect username/password!';
					}
				
	}else {
	echo 'please fill all fields!';
	}


}


?>

