<?php
require 'connet.php';

  if(if_logged_in() != true){
die();
 }
 	


	if (isset($_POST['date_del'])){

  
$id_del		=   trim(mysql_real_escape_string(htmlentities($_POST['date_del'])));

$query_select = @mysql_query("SELECT * FROM `history` WHERE `date` like '$id_del %'");
$dellPassword		=   trim(mysql_real_escape_string($_POST['dellPassword']));

	 if(mysql_result(mysql_query("SELECT count(`id`) FROM  `settings` WHERE `delete_pass`='$dellPassword'"),0) == '1'){	 
	 
	 									if(mysql_num_rows($query_select) >= 1){
									echo 3;
								 
									}else{
											
									$select_to_delete = "DELETE FROM `oppen_day`  WHERE date='$id_del'"; 
												
											if(@mysql_query($select_to_delete)){
												fix_bugs();

												echo 1;
											}else{
											echo 'error please try again !!';
											}
									}
									

									
 }else{
	 		echo ' sorry Wrong Password ';
	 
 }
 	

 						
	}		


?>
