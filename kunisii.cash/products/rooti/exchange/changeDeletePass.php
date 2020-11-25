<?php

require 'connet.php';
  if(if_logged_in() != true){
die();
 }
 	 
if(isset($_POST['c_pass']) && isset($_POST['new_pass'])){
 
$c_pass		=    mysql_real_escape_string(strtolower(htmlentities($_POST['c_pass'])));
$new_pass		=   mysql_real_escape_string(strtolower(htmlentities($_POST['new_pass'])));
	 
$pass = md5($c_pass.'!@%#$').'b4f9c8c51';



			$query_chack = "SELECT count(username_e) FROM login_in WHERE password_w='$pass'"; 
				

if(empty($new_pass)){
    echo 'password can\'t be empty !!!';
}else{

 

 
				if (@mysql_result(mysql_query($query_chack), 0) == 1){
					   mysql_query("UPDATE `settings` SET `delete_pass`='$new_pass'"); 
						echo 2;		
					}else {
					echo'incorrect login password!';
					}
				
 }


}


?>
