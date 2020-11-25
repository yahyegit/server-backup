<?php

 require '../connet.php';
 
$errors	= array( );
             
	$query_select = "SELECT `id`, `full_name`, `cash_in`, `cash_out`, `blance` , `doller_in`,`doller_out`,`doller_blance`,`time`,`number` FROM `main_details` "; 
	
		if(@$query_run = mysql_query($query_select)){
	 
		    while($sql_row = mysql_fetch_assoc($query_run)){
				
				$id = 			$sql_row['id']; // 
				$full_name = 	$sql_row['full_name'];
		  
				$query_select_ = mysql_fetch_assoc(mysql_query("SELECT  sum(`cash_in`), sum(`cash_out`), sum(`blance`), sum(`doller_in`), sum(`doller_out`),sum(`doller_blance`)  FROM `history`  WHERE id_card='$id' ")); 
	
				if($sql_row['cash_in'] != $query_select_['sum(`cash_in`)'] || $sql_row['cash_out'] != $query_select_['sum(`cash_out`)']   || $sql_row['doller_in'] != $query_select_['sum(`doller_in`)'] || $sql_row['doller_out'] != $query_select_['sum(`doller_out`)']){
				 /// $errors[] .= $query_select_['sum(`cash_in`)']." : $full_name   : ".$sql_row['cash_in']; 
				
					 
							 $errors[] .="<b style='background:red; color:black;'> $id: $full_name <b>"; 
						 
				}else{
					
					
				}
		 
			}
	 
		 
		}
 
foreach($errors as $name){
   
     echo "<p >$name <p>";
 

}
   
   echo "<p> ".count($errors)." customers not success</p>";
 

 
 
 
 
 ?>