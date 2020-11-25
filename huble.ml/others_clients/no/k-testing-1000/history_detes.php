<?php

require 'connet.php';

if (isset($_POST['id2']) && isset($_POST['date_name'])){

  
$id		=   trim(mysql_real_escape_string(htmlentities($_POST['id2'])));
$date_name		=    trim(mysql_real_escape_string(htmlentities($_POST['date_name'])));


if($date_name == 'ALL'){


	$query_select = "SELECT `description`,`id_card`,`id`,`full_name`, `cash_in`, `cash_out`, `blance` , `doller_in`,`doller_out`,`doller_blance`,`number`, `date` FROM `history` WHERE `id_card` = $id  ORDER BY `date` ASC"; 
 
	
				if(@$query_run = mysql_query($query_select)){
						
							$nameOfCustom = mysql_result(mysql_query("SELECT `full_name` FROM `main_details` WHERE  `id`=$id "),0); 
					$passsport = mysql_result(mysql_query("SELECT `id_passport` FROM `main_details` WHERE  `id`=$id "),0); 
					$mobile = mysql_result(mysql_query("SELECT `number` FROM `main_details` WHERE  `id`=$id "),0); 
			  $main_records  = mysql_fetch_assoc(mysql_query("SELECT * FROM `main_details` WHERE `id`=$id "));
			
		      $updateBtn = '<a href="#" style="/* float:right; */padding: 6px;margin-bottom: 3px;width: 116px;text-align: center;margin-left: 113px;/* margin: 5px; */" id="'.$id.'" name="'.$nameOfCustom.'" passsport="'.$passsport.'"  cash_in="'.$main_records['cash_in'].'" cash_out="'.$main_records['cash_out'].'" blance="'.$main_records['blance'].'"     doller_in="'.$main_records['doller_in'].'"  doller_out="'.$main_records['doller_out'].'"  doller_blance="'.$main_records['doller_blance'].'"      number="'.$mobile.'" edit="edit"  class="button edit update_btn">update</a>';	 
	
					
                      $mobile = (!empty($mobile))?', Mobile: ('.$mobile.')':'';
					  $passsport = (!empty($passsport))?', ID/Passport: ('.$passsport.')':'';
					  
										$table_data = ' <br><hr> <h3 style="margin-left:14%;"><strong style="color:blue;">'.strtoupper(substr($nameOfCustom, 0, 1)).'</strong>'.substr($nameOfCustom, 1).' <span class="subMobile">'.$mobile.'</span> '.$passsport.' '.$updateBtn.'</h3>  <hr/> <table class="table"   ><thead> <tr> <th>Full Name </th><th>Cash In </th><th>Cash Out</th> <th>Cash Balance</th>   <th>Dollar in </th>  <th>Dollar Out</th>  <th>Dollar Balance</th>    <th>Description</th> <th>Date</th> </tr>  </thead> <tbody>';
										
													while($sql_row = mysql_fetch_assoc($query_run)){
													
													$id = 	$sql_row['id'];
													$id_card = 	$sql_row['id_card'];
													
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

												
													$table_data .= '<tr><td>'.$full_name.'</td><td>'.$cash_in.' </td><td>'.$cash_out.'</td><td>'.$blance.'</td> <td>$'.$doller_in.'</td> <td>$'.$doller_out.'</td> <td>$'.$doller_blance.'</td>   <td>'.$description.'</td><td>'.$date.'   <a href="#" id="delete_histry" id_card="'.$id_card.'" delet_hist="'.$id.'"class="button delete"> delete </a></td></tr>'; 
													}
													$table_data .= '</tbody></table>';
													echo $table_data;
						}


				}else{


					$query_select = "SELECT `description`,`id`,`id_card`,`full_name`, `cash_in`, `cash_out`, `blance` , `doller_in`,`doller_out`,`doller_blance`,`number`, `date` FROM `history` WHERE `id_card` = $id and months ='$date_name'  ORDER BY `date` ASC"; 
				 
					
						if(@$query_run = mysql_query($query_select)){
						

					 $nameOfCustom = mysql_result(mysql_query("SELECT `full_name` FROM `main_details` WHERE  `id`=$id "),0); 
					$passsport = mysql_result(mysql_query("SELECT `id_passport` FROM `main_details` WHERE  `id`=$id "),0); 
					$mobile = mysql_result(mysql_query("SELECT `number` FROM `main_details` WHERE  `id`=$id "),0); 
				 $main_records  = mysql_fetch_assoc(mysql_query("SELECT * FROM `main_details` WHERE `id`=$id "));
			     $updateBtn = '<a href="#" style="/* float:right; */padding: 6px;margin-bottom: 3px;width: 116px;text-align: center;margin-left: 113px;/* margin: 5px; */" id="'.$id.'" name="'.$nameOfCustom.'" passsport="'.$passsport.'"  cash_in="'.$main_records['cash_in'].'" cash_out="'.$main_records['cash_out'].'" blance="'.$main_records['blance'].'"     doller_in="'.$main_records['doller_in'].'"  doller_out="'.$main_records['doller_out'].'"  doller_blance="'.$main_records['doller_blance'].'"      number="'.$mobile.'" edit="edit"  class="button edit update_btn">update</a>';	 
	
	
                      $mobile = (!empty($mobile))?', Mobile: ('.$mobile.')':'';
					  $passsport = (!empty($passsport))?', ID/Passport: ('.$passsport.')':'';
							
										$table_data = ' <br><hr> <h3 style="margin-left:14%;"><strong style="color:blue;">'.strtoupper(substr($nameOfCustom, 0, 1)).'</strong>'.substr($nameOfCustom, 1).' <span class="subMobile">'.$mobile.'</span> '.$passsport.''.$updateBtn.' </h3>   <hr/>  <table class="table"   ><thead> <tr> <th>Full Name </th><th>Cash In </th><th>Cash Out</th> <th>Cash Balance</th>   <th>Dollar in </th>  <th>Dollar Out</th>  <th>Dollar Balance</th>    <th>Description</th> <th>Date</th> </tr>  </thead> <tbody>';
										
													while($sql_row = mysql_fetch_assoc($query_run)){
													
															$id = 	$sql_row['id'];
															$id_card = 	$sql_row['id_card'];
															
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

												
													$table_data .= '<tr><td>'.$full_name.'</td><td>'.$cash_in.' </td><td>'.$cash_out.'</td><td>'.$blance.'</td> <td>$'.$doller_in.'</td> <td>$'.$doller_out.'</td> <td>$'.$doller_blance.'</td>  <td>'.$description.'</td><td>'.$date.'    <a href="#" id="delete_histry" id_card="'.$id_card.'" delet_hist="'.$id.'"class="button delete"> delete </a> </td></tr>'; 
													}
												$table_data .= '</tbody></table>';
													echo $table_data;
						}



				}
 
}


?>