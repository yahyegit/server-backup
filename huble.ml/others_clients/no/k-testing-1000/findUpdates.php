<?php

require 'connet.php';
if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
		die();
	
	}
if (isset($_POST['date1'])){

$date		=    trim(mysql_real_escape_string(htmlentities($_POST['date1'])));
 
		$query_select = "SELECT * FROM `history` WHERE `date` like '%$date%'  ORDER BY `full_name` ASC"; 
	
	
						if(@$query_run = mysql_query($query_select)){
						

													$table_data = '<table class="table"><thead> <tr> <th>Full Name </th><th>Cash In </th><th>Cash Out</th> <th>Cash Balance</th>   <th>Dollar in </th>  <th>Dollar Out</th>  <th>Dollar Balance</th> <th>Description</th>  <th>Date</th> </tr>  </thead> <tbody>';
										
													while($sql_row = mysql_fetch_assoc($query_run)){
													
														$id_c = 	$sql_row['id_card'];
														$id = 	$sql_row['id'];
														$full_name = 	$sql_row['full_name'];
															$cash_in = 		number_format($sql_row['cash_in']);
															$cash_out = 	number_format($sql_row['cash_out']);
															$blance = 		number_format($sql_row['blance']);
															
															
															$doller_in = 		number_format($sql_row['doller_in']);
															$doller_out = 		number_format($sql_row['doller_out']);
															$doller_blance = 		number_format($sql_row['doller_blance']);
															
															
															
															
															
														$description = 		$sql_row['description'];
														$number = 		$sql_row['number'];
														$date = 		$sql_row['date'];
													 	
												
												 $table_data .= '<tr><td  class="namehisy" myid="'.$id_c.'" >'.$full_name.'</td><td>'.$cash_in.' </td><td>'.$cash_out.'</td><td>'.$blance.'</td> <td>$'.$doller_in.'</td> <td>$'.$doller_out.'</td> <td>$'.$doller_blance.'</td>  <td>'.$description.'</td><td><pre> '.$date.'   <a href="#" id="delete_histry" id_crd="'.$id_c.'" delet_hist="'.$id.'"class="button delete"> delete </a></pre></td></tr>'; 
													}
													$table_data .= '</tbody></table>';
													echo $table_data;
						}
 
 
}


?>