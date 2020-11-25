<?php

require 'connet.php';
if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
		die();
	
	}




  if(if_logged_in() != true){
die();
 }
 	






if(isset($_POST['search_val'])){

		
		
	$search_val = trim(mysql_real_escape_string(htmlentities($_POST['search_val'])));
	
	

	
	
if (!empty($search_val)){

		
			if (strstr($search_val, ' ')){
			
			
			$search_val_all = explode(' ',$search_val);
			
			$firstname = $search_val_all[0];
			$lasttname = $search_val_all[1];
			
			$searc =  $firstname.'%'.$lasttname.'%';
			
		
			
			
		
			$query_select = "SELECT id_passport, `id`, `full_name`, `cash_in`, `cash_out`, `blance` , `doller_in`,`doller_out`,`doller_blance`,`time`,`number` FROM `main_details`  WHERE full_name like'$searc' OR number='$searc' ORDER BY `full_name` "; 
	
					if(@$query_run = mysql_query($query_select)){
							$nmrow = mysql_num_rows($query_run);
							
						if ($nmrow == 0){
							echo '<p style="color:red; text-align:center; padding:10px;background:#000;">search not found</p>';

						}else {
						
					   
						$table_data = '<br>  <h3>Search for (<strong style="color:blue;">'.strtoupper(substr($search_val, 0, 1)).'</strong>'.substr($search_val, 1).')  | Result is ('.$nmrow.') Customer'.(($nmrow=='1' && !empty($nmrow))?'':'s').'  </h3>  <hr/>  <table class="table"   > <thead> <tr> <th>Full Name </th><th>Cash In </th><th>Cash Out</th> <th>Cash Balance</th> <th> Dollar In </th> <th>Dollar Out</th> <th> Dollar Balance </th>  <th>Number</th>  <th>Update/Delete</th>  </tr>  </thead> <tbody>';
				
								while($sql_row = mysql_fetch_assoc($query_run)){
						
								$id = 			$sql_row['id'];
						 
									 
								$full_name = 	$sql_row['full_name'];
								$cash_in = 		number_format($sql_row['cash_in']);
								$cash_out = 	number_format($sql_row['cash_out']);
								$blance = 		number_format($sql_row['blance']);
								 
									
								$doller_in = 		number_format($sql_row['doller_in']);
								$doller_out = 		number_format($sql_row['doller_out']);
								$doller_blance = 		number_format($sql_row['doller_blance']);
								
								$time = 		$sql_row['time'];
								$number = 		$sql_row['number'];
					            $passsport_ =	$sql_row['id_passport'];
					
								
 
								
								$table_data .= '<tr><td class="full_name" id="'.$id.'">'.$full_name.'</td><td>'.$cash_in.' </td><td>'.$cash_out.'</td><td>'.$blance.'</td>  <td>$'.$doller_in.'</td>  <td>$'.$doller_out.'</td> <td>$'.$doller_blance.'</td>  <td>'.$number.'  </td>  <td>     <pre> <a href="#"  id="'.$id.'" name="'.$full_name.'" passsport="'.$passsport_.'"  cash_in="'.$sql_row['cash_in'].'" cash_out="'.$sql_row['cash_out'].'" blance="'.$sql_row['blance'].'"     doller_in="'.$sql_row['doller_in'].'"  doller_out="'.$sql_row['doller_out'].'"  doller_blance="'.$sql_row['doller_blance'].'"      number="'.$number.'" edit="edit"  class="button edit">update</a> <a href="#"  id="'.$id.'"   name="'.$full_name.'" cash_in="'.$cash_in.'" cash_out="'.$cash_out.'" blance="'.$blance.'" number="'.$number.'"   del="del" class="button delete">Delete</a> </pre> </td></tr>'; 
				}
								
								$table_data .= '</tbody><table>';
								echo $table_data;
								
						}
							
					}else{
					echo '<p style="color:red;">search not found</p>';
					
					}
			
			
			

			
			
			}else if($search_val == 'debt%'){  // only debt customers
 
		$query_select = "SELECT id_passport, `id`, `full_name`, `cash_in`, `cash_out`, `blance` , `doller_in`,`doller_out`,`doller_blance`,`time`,`number` FROM `main_details`  WHERE doller_blance like'-%' OR blance like'-%' ORDER BY `full_name`";
	
					if(@$query_run = mysql_query($query_select)){
					
						$nmrow2 = mysql_num_rows($query_run);
							
						if ($nmrow2 == 0){
							exit('<p style="color:red; text-align:center; padding:10px;background:#000;">search not found</p>');

						}
					
						$table_data = ' <br>  <h3>(<strong style="color:blue;">'.$nmrow2.'</strong>) Customer'.(($nmrow2=='1' && !empty($nmrow2))?'':'s').'  in the Debt Section  </h3>  <table class="table"   >  <thead> <tr> <th>Full Name </th><th>Cash In </th><th>Cash Out</th> <th>Cash Balance</th> <th> Dollar In </th> <th>Dollar Out</th> <th> Dollar Balance </th>  <th>Number</th>  <th>Update/Delete</th>  </tr>  </thead> <tbody>';
		
						while($sql_row = mysql_fetch_assoc($query_run)){
				
								$id = 			$sql_row['id'];
								$full_name = 	$sql_row['full_name'];
								$cash_in = 		number_format($sql_row['cash_in']);
								$cash_out = 	number_format($sql_row['cash_out']);
								$blance = 		number_format($sql_row['blance']);
								 
									
								$doller_in = 		number_format($sql_row['doller_in']);
								$doller_out = 		number_format($sql_row['doller_out']);
								$doller_blance = 		number_format($sql_row['doller_blance']);
								
								$time = 		$sql_row['time'];
								$number = 		$sql_row['number'];
								 $passsport_ =	$sql_row['id_passport'];
						
						
						$table_data .= '<tr><td class="full_name" id="'.$id.'">'.$full_name.'</td><td>'.$cash_in.' </td><td>'.$cash_out.'</td><td>'.$blance.'</td>  <td>$'.$doller_in.'</td>  <td>$'.$doller_out.'</td> <td>$'.$doller_blance.'</td>   <td>'.$number.'  </td>  <td>    <pre> <a href="#"  id="'.$id.'" name="'.$full_name.'" passsport="'.$passsport_.'"   cash_in="'.$sql_row['cash_in'].'" cash_out="'.$sql_row['cash_out'].'" blance="'.$sql_row['blance'].'"     doller_in="'.$sql_row['doller_in'].'"  doller_out="'.$sql_row['doller_out'].'"  doller_blance="'.$sql_row['doller_blance'].'"      number="'.$number.'" edit="edit"  class="button edit">update</a> <a href="#"  id="'.$id.'"   name="'.$full_name.'" cash_in="'.$cash_in.'" cash_out="'.$cash_out.'" blance="'.$blance.'" number="'.$number.'"   del="del" class="button delete">Delete</a> </pre> </td></tr>'; 
				}
						
						$table_data .= '</tbody></table>  <table class="table" style="margin-top:10px; width: 71%;    margin-left: 1px;"><tbody> <tr><th style="width: 287px;" >Total Cash Debt for All customers is: </th><td style="font-weight: bold;color: red;">'.number_format(mysql_result(mysql_query('SELECT sum(`blance`) FROM `main_details` WHERE `blance` like "-%"'),0)).'</td>  </tr>  <tr><th style="width: 295px;" >Total Dollar Debt for All Customers is: </th> <td style=" font-weight: bold;color: red;" >'.number_format(mysql_result(mysql_query('SELECT sum(`doller_blance`) FROM `main_details` WHERE `doller_blance` like "-%"'),0)).'</td></tr>  </tbody></table>';
						  
						echo $table_data;
					}else{
					echo '<p style="color:red;">Search Not Found</p>';
					
					}
		 
			
			}else{
		
 
 
		$query_select = "SELECT id_passport, `id`, `full_name`, `cash_in`, `cash_out`, `blance` , `doller_in`,`doller_out`,`doller_blance`,`time`,`number` FROM `main_details`  WHERE full_name REGEXP'$search_val' OR  number='$search_val'  ORDER BY `full_name`"; 
	
					if(@$query_run = mysql_query($query_select)){
					
						$nmrow2 = mysql_num_rows($query_run);
							
						if ($nmrow2 == 0){
							exit('<p style="color:red; text-align:center; padding:10px;background:#000;">search not found</p>');

						}
					
						$table_data = ' <br>  <h3>Search for (<strong style="color:blue;">'.strtoupper(substr($search_val, 0, 1)).'</strong>'.substr($search_val, 1).')  | Result is ('.$nmrow2.') Customer'.(($nmrow2=='1' && !empty($nmrow2))?'':'s').'  </h3>  <table class="table"   >  <thead> <tr> <th>Full Name </th><th>Cash In </th><th>Cash Out</th> <th>Cash Balance</th> <th> Dollar In </th> <th>Dollar Out</th> <th> Dollar Balance </th>  <th>Number</th>  <th>Update/Delete</th>  </tr>  </thead> <tbody>';
		
						while($sql_row = mysql_fetch_assoc($query_run)){
				
								$id = 			$sql_row['id'];
								$full_name = 	$sql_row['full_name'];
								$cash_in = 		number_format($sql_row['cash_in']);
								$cash_out = 	number_format($sql_row['cash_out']);
								$blance = 		number_format($sql_row['blance']);
								 
									
								$doller_in = 		number_format($sql_row['doller_in']);
								$doller_out = 		number_format($sql_row['doller_out']);
								$doller_blance = 		number_format($sql_row['doller_blance']);
								
								$time = 		$sql_row['time'];
								$number = 		$sql_row['number'];
								 $passsport_ =	$sql_row['id_passport'];
						
						
						$table_data .= '<tr><td class="full_name" id="'.$id.'">'.$full_name.'</td><td>'.$cash_in.' </td><td>'.$cash_out.'</td><td>'.$blance.'</td>  <td>$'.$doller_in.'</td>  <td>$'.$doller_out.'</td> <td>$'.$doller_blance.'</td>   <td>'.$number.'  </td>  <td>    <pre> <a href="#"  id="'.$id.'" name="'.$full_name.'" passsport="'.$passsport_.'"   cash_in="'.$sql_row['cash_in'].'" cash_out="'.$sql_row['cash_out'].'" blance="'.$sql_row['blance'].'"     doller_in="'.$sql_row['doller_in'].'"  doller_out="'.$sql_row['doller_out'].'"  doller_blance="'.$sql_row['doller_blance'].'"      number="'.$number.'" edit="edit"  class="button edit">update</a> <a href="#"  id="'.$id.'"   name="'.$full_name.'" cash_in="'.$cash_in.'" cash_out="'.$cash_out.'" blance="'.$blance.'" number="'.$number.'"   del="del" class="button delete">Delete</a> </pre> </td></tr>'; 
				}
						
						$table_data .= '</tbody></table>';
						echo $table_data;
					}else{
					echo '<p style="color:red;">Search Not Found</p>';
					
					}
			}	
					
	}else {
	echo 'empty !!!';
	} 

}

?>


