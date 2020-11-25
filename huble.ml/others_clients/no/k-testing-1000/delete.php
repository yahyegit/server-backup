<?php
require 'connet.php';

  if(if_logged_in() != true){
die();
 }
 	


	if (isset($_POST['id_del'])){

  
$id_del		=   trim(mysql_real_escape_string(htmlentities($_POST['id_del'])));


				$select_to_delete = "DELETE FROM `main_details`  WHERE id='$id_del'"; 
                $select_to_delete2 = "DELETE FROM `history`  WHERE id_card='$id_del'"; 
										
								if(@$query_run2 = mysql_query($select_to_delete)){
									
									if(@$query_run3 = mysql_query($select_to_delete2)){
									echo 1;
									}
									
								}else{
								echo 'error please try again !!';
								}
	}		


?>