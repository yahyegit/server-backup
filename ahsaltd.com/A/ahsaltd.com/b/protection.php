<?php

require 'connet.php';
if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
		die();
	
	}

if(isset($_POST['multi'])){
		
		$query_chack = "SELECT active_ip FROM login_in";
				  $query_run    =   mysql_query($query_chack);
				
					if (mysql_result($query_run, 0) == 1){
						$update_query = "UPDATE login_in SET active_ip=0";
						mysql_query($update_query);
						echo 'successfull';		
					}else if (mysql_result($query_run, 0) == 0){
						$update_query2 = "UPDATE login_in SET active_ip=1";
						mysql_query($update_query2);
						echo 'successfull';	
					}else {
					
						echo 'error please try again!!';
					}

}



?>

