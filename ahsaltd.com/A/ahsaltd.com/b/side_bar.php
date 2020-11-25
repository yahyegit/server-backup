<?php
require 'connet.php';
if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
		die();
	
	}


  if(if_logged_in() != true){
die();
 }
 






if(isset($_POST['blace_side'])){

$sidbar = mysql_real_escape_string(htmlentities($_POST['blace_side']));

			$query_sidbar = "SELECT `full_name`, `blance`, `doller_blance` FROM `main_details` ORDER BY `date` ASC"; 
			
			//$query_sidbar_ = "SELECT sum(course_blance) FROM students WHERE course_blance != '0'";
		 if(@$query_run = mysql_query($query_sidbar)){
			
			
			
	
			  while($sql_row = mysql_fetch_assoc($query_run)){
							
							
							$full_name = $sql_row['full_name'];
						if(trim($full_name) != 'unknown'){
							
						 
							
							$cash_blance = number_format($sql_row['blance']);
							$doller_blance = number_format($sql_row['doller_blance']);
							
							if (preg_match('/-/',$sql_row['blance'])){
							 echo "<pre> $full_name  Cash Balance : <span>$cash_blance</span></pre>";	
							}
							
							if (preg_match('/-/',$sql_row['doller_blance'])){
							 echo "<pre> $full_name  Dollar Balance : $<span>$doller_blance</span></pre>";	
							}
			            }
				
				}
	 
			
			 }
 
}


?>
