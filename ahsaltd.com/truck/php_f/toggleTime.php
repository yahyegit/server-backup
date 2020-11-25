<?php

require '../includes/inc_func.php';
 
if(if_logged_in() != true){
die();
 }
 
 
 $status  = (mysql_result(mysql_query("SELECT `toggleTime` FROM `adminSettings` limit 1"),0)=='0')?'1':'0';
 
  if(@mysql_query("UPDATE `adminSettings` SET `toggleTime`='$status'  ")){
			echo 1; 
		 }else{
		 echo 'Error  please try again !!' ;
		 }

 
 
 
 
 
 
 ?>