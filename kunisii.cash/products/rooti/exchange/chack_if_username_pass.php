<?php

require 'connet.php';

if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
		die();
	
	}
  if(if_logged_in() != true){
die();
 }
 	



if(isset($_POST['chack_if_us'])){

$chack_if_us		=   mysql_real_escape_string(strtolower(htmlentities($_POST['chack_if_us'])));

	
	
	$query_chack = "SELECT username_e FROM login_in";
	$query_run    =   mysql_query($query_chack);
				if (mysql_result($query_run, 0) != ''){
					echo '<span style="color: green;">yes</span>';
				
					}else if (mysql_result($query_run, 0) == ''){
					echo '<span style="color: red;">no</span>';
					
					}else {
					
					echo '<span style="color: red;">error !! </span>';
					
					}
		



}


if(isset($_POST['chack_if_pw'])){
 
	
	$query_chack2 = "SELECT  password_w FROM login_in";
	$query_run2    =   mysql_query($query_chack2);
				if (mysql_result($query_run2, 0) != ''){
					echo '<span style="color: green;">yes</span>';
				
					}else if (mysql_result($query_run2, 0) == ''){
					echo '<span style="color: red;">no</span>';
					
					}else {
					
					echo '<span style="color: red;">error !! </span>';
					
					}
		



}




if(isset($_POST['chack_multi'])){
 
	
	$query_chack3 = "SELECT active_ip FROM login_in";
	$query_run3    =   mysql_query($query_chack3);
				if (mysql_result($query_run3, 0) == 1){
					echo '<span style="color: green;">no</span>';
				
					}else if (mysql_result($query_run3, 0) == 0){
					echo '<span style="color: red;">yes</span>';
					
					}else {
					
					echo '<span style="color: red;">error !! </span>';
					
					}
		



}
?>

