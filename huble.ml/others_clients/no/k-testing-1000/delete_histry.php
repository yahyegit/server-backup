<?php
require 'connet.php';

  if(if_logged_in() != true){
die();
 }
 	


	if (isset($_POST['delete_histryRow']) && isset($_POST['id_card'])){

  
$id_del		=   trim(mysql_real_escape_string(htmlentities($_POST['delete_histryRow'])));
$id_card		=   trim(mysql_real_escape_string(htmlentities($_POST['id_card'])));


			$query_select_his = "SELECT `id`,`cash_in`, `cash_out`, `blance` , `doller_in`,`doller_out`,`doller_blance` FROM `history` WHERE id='$id_del'"; 
			
					
                $select_to_delete2 = "DELETE FROM `history`  WHERE id='$id_del'"; 
							
							 
									if(@$query_run_h = mysql_query($query_select_his)){
								 
									$sql_row_2 = mysql_fetch_assoc($query_run_h);
									 
									$cash_in   = $sql_row_2['cash_in'];
									$cash_out   = $sql_row_2['cash_out'];
									$blance   = $sql_row_2['blance'];
									
									$doller_in   = $sql_row_2['doller_in'];
									$doller_out   = $sql_row_2['doller_out'];
								    $doller_blance   = $sql_row_2['doller_blance'];
									
										$query_select_main_d = "SELECT  `cash_in` - $cash_in as `cash_in`, `cash_out` - $cash_out as `cash_out`, `blance` - $blance as `blance`, `doller_in` - $doller_in as `doller_in` ,`doller_out` - $doller_out as `doller_out`,`doller_blance` - $doller_blance as `doller_blance` FROM `main_details` WHERE id='$id_card'"; 
	
											if(@$query_run_m = mysql_query($query_select_main_d)){
									
												$sql_row_3 = mysql_fetch_assoc($query_run_m);
												 
												$cash_in1   = $sql_row_3['cash_in'];
												$cash_out1   = $sql_row_3['cash_out'];
												$blance1   = $sql_row_3['blance'];
												
												$doller_in1   = $sql_row_3['doller_in'];
												$doller_out1   = $sql_row_3['doller_out'];
												$doller_blance1   = $sql_row_3['doller_blance'];
									
													$update_query = "UPDATE main_details SET cash_in=$cash_in1, cash_out=$cash_out1, blance=$blance1, doller_in=$doller_in1, doller_out=$doller_out1, doller_blance=$doller_blance1  WHERE id = $id_card ";
														if(@mysql_query($update_query)){
														     if(@mysql_query($select_to_delete2)){
																	echo'<font style="color: green;"><strong>successfull</strong></font>';
														
																}
														
														}
									
												
											}
									}else{
										echo '<font style="color: red;"><strong>error please try again !!</strong></font>';
									}
					 
	}		


?>