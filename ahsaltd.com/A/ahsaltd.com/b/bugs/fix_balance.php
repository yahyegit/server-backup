
 <?php

 require '../connet.php';
 
function fix_balance_for_all_transactions(){

 
$errors	= array( );
             
	    $query_select = "SELECT `id`, `full_name`, `cash_in`, `cash_out`, `blance` , `doller_in`,`doller_out`,`doller_blance`,`time`,`number` FROM `main_details` "; 
 
	   $parent_transaction_c_Balance =  0;
	   $parent_transaction_d_Balance =  0;					
 
		if(@$query_run = mysql_query($query_select)){ 
	 
		    while($sql_row = mysql_fetch_assoc($query_run)){
				
				    $id = 			$sql_row['id']; 
								 
								  // sort months for current customer
								$month_n =  array();
								$arrayIndex = 0;
						 
								 if($query_run = mysql_query("SELECT DISTINCT `months` FROM `history` WHERE `id_card` = $id  order by date ASC")){
								 
											while($sql_row = mysql_fetch_assoc($query_run)){
											   $month_n[$arrayIndex] = strtotime(str_replace('/','-','20/'.$sql_row['months']));
											   $arrayIndex++;
											}
								 } 

								sort($month_n, SORT_NATURAL | SORT_FLAG_CASE);	 
							
									  // loob transactions by months			
									foreach($month_n as $month){
										
										  $month = date("m/Y",$month);
								 
								 
											 if(@$query_run_history = mysql_query("SELECT * FROM `history`  WHERE id_card='$id' and months='$month' order by date, id ASC"))
											 {
														// history for current customer
												while($sql_row_history = mysql_fetch_assoc($query_run_history)){
														$t_id = 			$sql_row_history['id']; 

														$cash_in = 		$sql_row_history['cash_in'];
														$cash_out = 	$sql_row_history['cash_out'];
														$currBlance = 	$cash_in - $cash_out;
														 
														$doller_in =    $sql_row_history['doller_in'];
														$doller_out = 	$sql_row_history['doller_out'];
														$currdBlance = 	$doller_in - $doller_out;	 
													  
														 $newBalance =  $currBlance + $parent_transaction_c_Balance; 
														 $newDBalance =  $currdBlance + $parent_transaction_d_Balance; 
													
													   if(@mysql_query("UPDATE `history` SET `blance`='$newBalance',`doller_blance`='$newDBalance' WHERE id='$t_id'")){
														}else{
														  $errors[] = "<p style='color:red;'> customer id ($id) : this transaction id was not excuted </p>"; 
														
													   }
												  
													  $parent_transaction_c_Balance =  $newBalance;
													  $parent_transaction_d_Balance =  $newDBalance;					
												 echo "cash $newBalance , dollar : $newDBalance;	<br>";
												}
											 }else{
												 
												// echo mysql_error();
											 }
									
									
									}
						   
						   
						   
   // reset second customer 
                 $parent_transaction_c_Balance =  0;
		 $parent_transaction_d_Balance =  0;	
		 
			}
	 
		 
		}
 
foreach($errors as $name){
   
     echo "<p >$name <p>";
 

}
   
   echo "<p> ".count($errors)." customers not success</p>";
 
}
 
 
 fix_balance_for_all_transactions();
 
 ?>

