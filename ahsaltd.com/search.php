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
						
					   
	                     $query_all_Customers = "SELECT * FROM `main_details` ORDER BY `full_name` ";
					  
                         $title = '<h3><strong style=\"color:blue;\">A</strong>ll Customers |   ('.number_format($nmrow).') Customers ';	
						                                 
					     $export = "<a href='#' onclick='exporter(&quot;$query_all_Customers&quot;,&quot;$title</h3>&quot;,&quot;6-all&quot;,&quot;exports/others/All-Customers.pdf&quot;,&quot;2-tab&quot;)'   class='button'>Export All Customers </a>";
						 
					   
						$table_data = '<br> <h3>Search for (<strong style="color:blue;">'.strtoupper(substr($search_val, 0, 1)).'</strong>'.substr($search_val, 1).')  | Result is ('.$nmrow.') Customer'.(($nmrow=='1' && !empty($nmrow))?'':'s').' | '.$export.' </h3>  <hr/>  <table class="table"   > <thead> <tr> <th>Full Name </th><th>Cash In </th><th>Cash Out</th> <th>Cash Balance</th> <th> Dollar In </th> <th>Dollar Out</th> <th> Dollar Balance </th>  <th>Number</th>  <th>Update/Delete</th>  </tr>  </thead> <tbody>';
				
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
						   // all Totals 	
		$all_Totals = mysql_fetch_assoc(mysql_query("SELECT  sum(`cash_in`) as cash_in, sum(`cash_out`) as cash_out, sum(`blance`) as blance, sum(`doller_in`) as doller_in,sum(`doller_out`) as doller_out,sum(`doller_blance`)as doller_blance FROM `main_details`  WHERE 1 "));
		   		 								   
       if($search_val == '% %'){
		$table_data .=  '<br><table class="table"> <thead> <tr> <th>Total Cash In </th><th>Total Cash Out</th> <th>Total Cash Balance</th> <th>Total Dollar In </th> <th>Total Dollar Out</th> <th>Total Dollar Balance </th> </tr>  </thead> <tbody>';						
        $table_data .= '<tr> <td>'.number_format($all_Totals['cash_in']).' </td><td>'.number_format($all_Totals['cash_out']).'</td><td>'.number_format($all_Totals['blance']).'</td>  <td>$'.number_format($all_Totals['doller_in']).'</td>  <td>$'.number_format($all_Totals['doller_out']).'</td> <td>$'.number_format($all_Totals['doller_blance']).'</td> </tr> </tbody><table> ';    
	   }

						
								
								
								echo $table_data;
								
						}
							
					}else{
					echo '<p style="color:red;">search not found</p>';
					
					}
			
			
			

			
			
			}else if($search_val == 'credit%'){


		$query_select = "SELECT id_passport, `id`, `full_name`, `cash_in`, `cash_out`, `blance` , `doller_in`,`doller_out`,`doller_blance`,`time`,`number` FROM `main_details`  WHERE blance NOT LIKE '-%' and blance !='0' ORDER BY `full_name`";
		$query_select_ = "SELECT id_passport, `id`, `full_name`, `cash_in`, `cash_out`, `blance` , `doller_in`,`doller_out`,`doller_blance`,`time`,`number` FROM `main_details`  WHERE doller_blance NOT LIKE '-%' and doller_blance !='0'  ORDER BY `full_name`";
	
	$Credit_tabs = '
 <div id="search_tabs">
  <ul>
    <li><a href="#credit_tabs-1">Credit Cash</a></li>
    <li><a href="#credit_tabs-2">Credit Dollar</a></li>
  </ul>';
 
	                 // cash table
					if(@$query_run = mysql_query($query_select)){
					
						$nmrow2 = mysql_num_rows($query_run);
							
						if ($nmrow2 == 0){  // if search empty
							exit('<p style="color:red; text-align:center; padding:10px;background:#000;"> Cash Credits Not Foud !!! </p>');
						}
						
	 
	                     $query_all_credit_cash= 'SELECT * FROM `main_details`  WHERE blance NOT LIKE \"-%\" and blance !=\"0\" ORDER BY `full_name`';

                         $title_cash_credit = '<h3>(<strong style=\"color:blue;\">'.number_format($nmrow2).'</strong>) Customer'.(($nmrow2=='1' && !empty($nmrow2))?'':'s').'  in the Cash Credit Section';	
						                                 
					     $export = "<a href='#' onclick='exporter(&quot;$query_all_credit_cash&quot;,&quot;$title_cash_credit</h3>&quot;,&quot;3-c&quot;,&quot;exports/others/All-Credit-Cash.pdf&quot;,&quot;2-tab&quot;)'   class='button'>Export All Cash Credits </a>";
						
						$table_data = '<div id="credit_tabs-1"> <br>  '.$title_cash_credit.'  |     '.$export.' </h3>  <table class="table"   >  <thead> <tr> <th>Full Name </th><th>Cash In </th><th>Cash Out</th> <th>Cash Balance</th> <th> Dollar In </th> <th>Dollar Out</th> <th> Dollar Balance </th>  <th>Number</th>  <th>Update/Delete</th>  </tr>  </thead> <tbody>';
		
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
						
						
						$table_data .= '<tr><td class="full_name" id="'.$id.'">'.$full_name.'</td><td>'.$cash_in.' </td><td>'.$cash_out.'</td><td style="font-weight: bold;color: blue;">'.$blance.'</td>  <td>$'.$doller_in.'</td>  <td>$'.$doller_out.'</td> <td>$'.$doller_blance.'</td>   <td>'.$number.'  </td>  <td>    <pre> <a href="#"  id="'.$id.'" name="'.$full_name.'" passsport="'.$passsport_.'"   cash_in="'.$sql_row['cash_in'].'" cash_out="'.$sql_row['cash_out'].'" blance="'.$sql_row['blance'].'"     doller_in="'.$sql_row['doller_in'].'"  doller_out="'.$sql_row['doller_out'].'"  doller_blance="'.$sql_row['doller_blance'].'"      number="'.$number.'" edit="edit"  class="button edit">update</a> <a href="#"  id="'.$id.'"   name="'.$full_name.'" cash_in="'.$cash_in.'" cash_out="'.$cash_out.'" blance="'.$blance.'" number="'.$number.'"   del="del" class="button delete">Delete</a> </pre> </td></tr>'; 
				}
						
					     $table_data .= '</tbody></table>   </div>';

						$Credit_tabs .= $table_data;
					}
		   

		        // Dollar table
					if(@$query_run = mysql_query($query_select_)){
					
						$nmrow2 = mysql_num_rows($query_run);
							
						if ($nmrow2 == 0){  // if search empty
							exit('<p style="color:red; text-align:center; padding:10px;background:#000;"> Dollar Credits Not Foud !!! </p>');
						}
					
				 $query_all_credit_dollar= 'SELECT * FROM `main_details`  WHERE doller_blance NOT LIKE \"-%\" and doller_blance !=\"0\" ORDER BY `full_name`';
                         $title = '<h3>(<strong style=\"color:blue;\">'.number_format($nmrow2).'</strong>) Customer'.(($nmrow2=='1' && !empty($nmrow2))?'':'s').'  in the Dollar Credit Section';	
						                                 
					     $export = "<a href='#' onclick='exporter(&quot;$query_all_credit_dollar&quot;,&quot;$title</h3>&quot;,&quot;3-d&quot;,&quot;exports/others/All-Credit-dollar.pdf&quot;,&quot;2-tab&quot;)'   class='button'>Export All Dollar Credits </a>";
						
					
					
					
					
						$table_data = '<div id="credit_tabs-2"> <br> '.$title.'  | '.$export.'</h3>  <table class="table"   >  <thead> <tr> <th>Full Name </th><th>Cash In </th><th>Cash Out</th> <th>Cash Balance</th> <th> Dollar In </th> <th>Dollar Out</th> <th> Dollar Balance </th>  <th>Number</th>  <th>Update/Delete</th>  </tr>  </thead> <tbody>';
		
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
						
						
						$table_data .= '<tr><td class="full_name" id="'.$id.'">'.$full_name.'</td><td>'.$cash_in.' </td><td>'.$cash_out.'</td><td>'.$blance.'</td>  <td>$'.$doller_in.'</td>  <td>$'.$doller_out.'</td> <td style="font-weight: bold;color: blue;">$'.$doller_blance.'</td>   <td>'.$number.'  </td>  <td>    <pre> <a href="#"  id="'.$id.'" name="'.$full_name.'" passsport="'.$passsport_.'"   cash_in="'.$sql_row['cash_in'].'" cash_out="'.$sql_row['cash_out'].'" blance="'.$sql_row['blance'].'"     doller_in="'.$sql_row['doller_in'].'"  doller_out="'.$sql_row['doller_out'].'"  doller_blance="'.$sql_row['doller_blance'].'"      number="'.$number.'" edit="edit"  class="button edit">update</a> <a href="#"  id="'.$id.'"   name="'.$full_name.'" cash_in="'.$cash_in.'" cash_out="'.$cash_out.'" blance="'.$blance.'" number="'.$number.'"   del="del" class="button delete">Delete</a> </pre> </td></tr>'; 
				}
						
						$table_data .= '</tbody></table>   </div>';
						  
						$Credit_tabs .= $table_data;
					}
  
  $Credit_tabs .= '</div> <table class="table" style="margin-top:10px; width: 71%;    margin-left: 1px;"><tbody> <tr><th style="width: 287px;" >Total Cash Credit for All customers is: </th><td style="font-weight: bold;color: red;">'.number_format(mysql_result(mysql_query('SELECT sum(`blance`) FROM `main_details` WHERE `blance` NOT LIKE "-%"'),0)).'</td>  </tr>  <tr><th style="width: 313px;" >Total Dollar Credit for All Customers is: </th> <td style=" font-weight: bold;color: red;" >$'.number_format(mysql_result(mysql_query('SELECT sum(`doller_blance`) FROM `main_details` WHERE `doller_blance` NOT LIKE "-%"'),0)).'</td></tr>  </tbody></table> ';
 
 echo $Credit_tabs;
 
}else if($search_val == 'debt%'){  // only debt customers
 
		$query_select = "SELECT id_passport, `id`, `full_name`, `cash_in`, `cash_out`, `blance` , `doller_in`,`doller_out`,`doller_blance`,`time`,`number` FROM `main_details`  WHERE blance like'-%' ORDER BY `full_name`";
		$query_select_ = "SELECT id_passport, `id`, `full_name`, `cash_in`, `cash_out`, `blance` , `doller_in`,`doller_out`,`doller_blance`,`time`,`number` FROM `main_details`  WHERE doller_blance like'-%' ORDER BY `full_name`";
		
	$Credit_tabs = '
 <div id="search_tabs">
  <ul>
    <li><a href="#credit_tabs-1">Debt Cash</a></li>
    <li><a href="#credit_tabs-2">Debt Dollar</a></li>
  </ul>';
 
	                 // cash table
					if(@$query_run = mysql_query($query_select)){
					
						$nmrow2 = mysql_num_rows($query_run);
							
						if ($nmrow2 == 0){  // if search empty
							exit('<p style="color:red; text-align:center; padding:10px;background:#000;"> Cash Debt Not Foud !!! </p>');
						}
					
						 $query = 'SELECT * FROM `main_details`  WHERE blance like \"-%\" ORDER BY `full_name`';
                         $title = ' <h3>(<strong style=\"color:blue;\">'.number_format($nmrow2).'</strong>) Customer'.(($nmrow2=='1' && !empty($nmrow2))?'':'s').'  in the Cash Debt Section ';	
						                                 
					     $export = "<a href='#' onclick='exporter(&quot;$query&quot;,&quot;$title</h3>&quot;,&quot;3-c&quot;,&quot;exports/others/All-Debt-Cash.pdf&quot;,&quot;2-tab&quot;)'   class='button'>Export All Cash Debts </a>";
						
					 
						$table_data = '<div id="credit_tabs-1">  <br> '.$title.'  | '.$export.' </h3>  <table class="table"   >  <thead> <tr> <th>Full Name </th><th>Cash In </th><th>Cash Out</th> <th>Cash Balance</th> <th> Dollar In </th> <th>Dollar Out</th> <th> Dollar Balance </th>  <th>Number</th>  <th>Update/Delete</th>  </tr>  </thead> <tbody>';
		
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
						
						
						$table_data .= '<tr><td class="full_name" id="'.$id.'">'.$full_name.'</td><td>'.$cash_in.' </td><td>'.$cash_out.'</td><td style="font-weight: bold;color: blue;" >'.$blance.'</td>  <td>$'.$doller_in.'</td>  <td>$'.$doller_out.'</td> <td>$'.$doller_blance.'</td>   <td>'.$number.'  </td>  <td>    <pre> <a href="#"  id="'.$id.'" name="'.$full_name.'" passsport="'.$passsport_.'"   cash_in="'.$sql_row['cash_in'].'" cash_out="'.$sql_row['cash_out'].'" blance="'.$sql_row['blance'].'"     doller_in="'.$sql_row['doller_in'].'"  doller_out="'.$sql_row['doller_out'].'"  doller_blance="'.$sql_row['doller_blance'].'"      number="'.$number.'" edit="edit"  class="button edit">update</a> <a href="#"  id="'.$id.'"   name="'.$full_name.'" cash_in="'.$cash_in.'" cash_out="'.$cash_out.'" blance="'.$blance.'" number="'.$number.'"   del="del" class="button delete">Delete</a> </pre> </td></tr>'; 
				}
						
					     $table_data .= '</tbody></table>   </div>';

						$Credit_tabs .= $table_data;
					}
		   

		        // Dollar table
					if(@$query_run = mysql_query($query_select_)){
					
						$nmrow2 = mysql_num_rows($query_run);
							
						if ($nmrow2 == 0){  // if search empty
							exit('<p style="color:red; text-align:center; padding:10px;background:#000;"> Dollar Debt Not Foud !!! </p>');
						}
					
						 $query = 'SELECT * FROM `main_details`  WHERE doller_blance like \"-%\" ORDER BY `full_name`';	
                         $title = ' <h3>(<strong style=\"color:blue;\">'.number_format($nmrow2).'</strong>) Customer'.(($nmrow2=='1' && !empty($nmrow2))?'':'s').'  in the Dollar Debt Section ';	
						                                 
					     $export = "<a href='#' onclick='exporter(&quot;$query&quot;,&quot;$title</h3>&quot;,&quot;3-d&quot;,&quot;exports/others/All-Debts-dollar.pdf&quot;,&quot;2-tab&quot;)'   class='button'>Export All Dollar Debts </a>";
						
					    $table_data = '<div id="credit_tabs-2"> <br> '.$title.'  | '.$export.'  </h3>  <table class="table"   >  <thead> <tr> <th>Full Name </th><th>Cash In </th><th>Cash Out</th> <th>Cash Balance</th> <th> Dollar In </th> <th>Dollar Out</th> <th> Dollar Balance </th>  <th>Number</th>  <th>Update/Delete</th>  </tr>  </thead> <tbody>';
		
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
						
						
						$table_data .= '<tr><td class="full_name" id="'.$id.'">'.$full_name.'</td><td>'.$cash_in.' </td><td>'.$cash_out.'</td><td>'.$blance.'</td>  <td>$'.$doller_in.'</td>  <td>$'.$doller_out.'</td> <td style="font-weight: bold;color: blue;" >$'.$doller_blance.'</td>   <td>'.$number.'  </td>  <td>    <pre> <a href="#"  id="'.$id.'" name="'.$full_name.'" passsport="'.$passsport_.'"   cash_in="'.$sql_row['cash_in'].'" cash_out="'.$sql_row['cash_out'].'" blance="'.$sql_row['blance'].'"     doller_in="'.$sql_row['doller_in'].'"  doller_out="'.$sql_row['doller_out'].'"  doller_blance="'.$sql_row['doller_blance'].'"      number="'.$number.'" edit="edit"  class="button edit">update</a> <a href="#"  id="'.$id.'"   name="'.$full_name.'" cash_in="'.$cash_in.'" cash_out="'.$cash_out.'" blance="'.$blance.'" number="'.$number.'"   del="del" class="button delete">Delete</a> </pre> </td></tr>'; 
				}
						
						$table_data .= '</tbody></table>   </div>';
						  
						$Credit_tabs .= $table_data;
					}
  
 $Credit_tabs .= '</div> <table class="table" style="margin-top:10px; width: 71%;    margin-left: 1px;"><tbody> <tr><th style="width: 287px;" >Total Cash Debt for All customers is: </th><td style="font-weight: bold;color: red;">'.number_format(mysql_result(mysql_query('SELECT sum(`blance`) FROM `main_details` WHERE `blance` like "-%"'),0)).'</td>  </tr>  <tr><th style="width: 295px;" >Total Dollar Debt for All Customers is: </th> <td style=" font-weight: bold;color: red;" >$'.number_format(mysql_result(mysql_query('SELECT sum(`doller_blance`) FROM `main_details` WHERE `doller_blance` like "-%"'),0)).'</td></tr>  </tbody></table>';
					
  echo $Credit_tabs;
 		
			}else{
		
 
 
		$query_select = "SELECT id_passport, `id`, `full_name`, `cash_in`, `cash_out`, `blance` , `doller_in`,`doller_out`,`doller_blance`,`time`,`number` FROM `main_details`  WHERE full_name REGEXP'$search_val' OR  number='$search_val'  ORDER BY `full_name`"; 
	
					if(@$query_run = mysql_query($query_select)){
					
						$nmrow2 = mysql_num_rows($query_run);
							
						if ($nmrow2 == 0){
							exit('<p style="color:red; text-align:center; padding:10px;background:#000;">search not found</p>');

						}
					
						$table_data = ' <br>  <h3>Search for (<strong style="color:blue;">'.strtoupper(substr($search_val, 0, 1)).'</strong>'.substr($search_val, 1).')  | Result is ('.number_format($nmrow2).') Customer'.(($nmrow2=='1' && !empty($nmrow2))?'':'s').'  </h3>  <table class="table"   >  <thead> <tr> <th>Full Name </th><th>Cash In </th><th>Cash Out</th> <th>Cash Balance</th> <th> Dollar In </th> <th>Dollar Out</th> <th> Dollar Balance </th>  <th>Number</th>  <th>Update/Delete</th>  </tr>  </thead> <tbody>';
		
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

