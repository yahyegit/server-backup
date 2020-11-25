<?php
 require '../includes/inc_func.php';
 if(if_logged_in() == true){
    session_destroy();
	echo 111;
 }

 

?>