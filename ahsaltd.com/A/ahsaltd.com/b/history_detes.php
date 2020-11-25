<?php

require 'connet.php';
						 
		
          // exports buttons creator
function exportBtsCreator($query,$title,$colms,$filename,$tab,$btnTitle,$styles,$type){
    
if($type == "option"){
   return "<option query='$query' title='$title' colms='$colms' filename='$filename' tab='$tab')'>$btnTitle</option>";
}else{
   return "<a href='#' style='$styles' onclick='exporter(&quot;$query&quot;,&quot;$title&quot;,&quot;$colms&quot;,&quot;$filename&quot;,&quot;$tab&quot;)'   class='button'>$btnTitle</a>";
}

}	

if (isset($_POST['id2']) && isset($_POST['date_name'])){

  
$id		=   trim(mysql_real_escape_string(htmlentities($_POST['id2'])));
$date_name		=    trim(mysql_real_escape_string(htmlentities($_POST['date_name'])));


if($date_name == 'ALL'){


	$query_select = "SELECT `description`,`id_card`,`id`,`full_name`, `cash_in`, `cash_out`, `blance` , `doller_in`,`doller_out`,`doller_blance`,`number`, `date` FROM `history` WHERE `id_card` = $id  ORDER BY `id` ASC"; 
 
	
				if(@$query_run = mysql_query($query_select)){
						
							$nameOfCustom = mysql_result(mysql_query("SELECT `full_name` FROM `main_details` WHERE  `id`=$id "),0); 
					$passsport = mysql_result(mysql_query("SELECT `id_passport` FROM `main_details` WHERE  `id`=$id "),0); 
					$mobile = mysql_result(mysql_query("SELECT `number` FROM `main_details` WHERE  `id`=$id "),0); 
					$mobile_2 = mysql_result(mysql_query("SELECT `number` FROM `main_details` WHERE  `id`=$id "),0); 
			  $main_records  = mysql_fetch_assoc(mysql_query("SELECT * FROM `main_details` WHERE `id`=$id "));
			
		      $updateBtn = '<a href="#" style="/* float:right; */padding: 6px;margin-bottom: 3px;width: 116px;text-align: center;margin-left: 113px;/* margin: 5px; */" id="'.$id.'" name="'.$nameOfCustom.'" passsport="'.$passsport.'"  cash_in="'.$main_records['cash_in'].'" cash_out="'.$main_records['cash_out'].'" blance="'.$main_records['blance'].'"     doller_in="'.$main_records['doller_in'].'"  doller_out="'.$main_records['doller_out'].'"  doller_blance="'.$main_records['doller_blance'].'"      number="'.$mobile.'" edit="edit"  class="button edit update_btn">update</a>';	 
	
					
                      $mobile = (!empty($mobile))?', Mobile: ('.$mobile.')':'';
					  $passsport = (!empty($passsport))?', ID/Passport: ('.$passsport.')':'';
					  
					  
					  
				  // exports 
                        $title = '<strong style="color:blue;">'.strtoupper(substr($nameOfCustom, 0, 1)).'</strong>'.substr($nameOfCustom, 1).' <span class="subMobile">'.$mobile.'</span> '.$passsport.'</h3>';

				        $query_full_account = "SELECT * FROM `history` WHERE `id_card`=$id ORDER BY `id` ";
						$query_cash_debts = "SELECT * FROM `history` WHERE `id_card`=$id and blance LIKE \"-%\" ORDER BY `id` ";
						$query_dollar_debts = "SELECT * FROM `history` WHERE `id_card`=$id and doller_blance LIKE \"-%\" ORDER BY `id` ";
						$query_cash_credit = "SELECT * FROM `history` WHERE `id_card`=$id and blance NOT LIKE \"-%\" and blance !=\"0\" ORDER BY `id` ";
						$query_dollar_credit = "SELECT * FROM `history` WHERE `id_card`=$id  and doller_blance NOT LIKE \"-%\" and doller_blance !=\"0\" ORDER BY `id` ";
	
	// export buttons select option
			$exports_selector = 	"<select onchange='exporter($(this).find(&quot;option:selected&quot;).attr(&quot;query&quot;),$(this).find(&quot;option:selected&quot;).attr(&quot;title&quot;),$(this).find(&quot;option:selected&quot;).attr(&quot;colms&quot;),$(this).find(&quot;option:selected&quot;).attr(&quot;filename&quot;),$(this).find(&quot;option:selected&quot;).attr(&quot;two_tabs&quot;))' > <option> Export... </option> ".exportBtsCreator($query_full_account,'<h3 style="margin-left:14%;">Account For '.$title,'6-all',"exports/customers/$nameOfCustom-$mobile_2-full-Account.pdf","","Export full Account","","option");
			$exports_selector .= 	exportBtsCreator($query_cash_debts,'<h3 style="margin-left:14%;">Cash Debts for '.$title,'3-c',"exports/customers/$nameOfCustom-$mobile_2-All-Debt-cash.pdf","","Export All Cash Debts!","","option");
			$exports_selector .= 	exportBtsCreator($query_dollar_debts,'<h3 style="margin-left:14%;">Dollar Debts for '.$title,'3-d',"exports/customers/$nameOfCustom-$mobile_2-All-Debt-dollar.pdf","","Export All Debts Dollar!","","option");
			$exports_selector .= 	exportBtsCreator($query_cash_credit,'<h3 style="margin-left:14%;">Cash Credits for '.$title,'3-c',"exports/customers/$nameOfCustom-$mobile_2-All-Credit-cash.pdf","","Export All Cash Credits!","","option");
			$exports_selector .= 	exportBtsCreator($query_dollar_credit,'<h3 style="margin-left:14%;">Dollar Credits for '.$title,'3-d',"exports/customers/$name-$mobile_2-All-credit-dollar.pdf","","Export All Dollar Credits!","","option");
	 		$exports_selector .= "</select>"; 	 
	
	// exports	  
 
					  
										$table_data = ' <br><hr> <h3 style="margin-left:14%;"><strong style="color:blue;">'.strtoupper(substr($nameOfCustom, 0, 1)).'</strong>'.substr($nameOfCustom, 1).' <span class="subMobile">'.$mobile.'</span> '.$passsport.' '.$updateBtn.'   |  '.$exports_selector.' </h3>  <hr/> <table class="table"   ><thead> <tr> <th>Full Name </th><th>Cash In </th><th>Cash Out</th> <th>Cash Balance</th>   <th>Dollar in </th>  <th>Dollar Out</th>  <th>Dollar Balance</th>    <th>Description</th> <th>Date</th>  <th>Action</th> </tr>  </thead> <tbody>';
										
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

												
													$table_data .= '<tr><td>'.$full_name.'</td><td>'.$cash_in.' </td><td>'.$cash_out.'</td><td>'.$blance.'</td> <td>$'.$doller_in.'</td> <td>$'.$doller_out.'</td> <td>$'.$doller_blance.'</td>   <td>'.$description.'</td><td>'.$date.' </td> <td>  <a href="#" id="delete_histry" id_card="'.$id_card.'" delet_hist="'.$id.'"class="button delete"> delete </a></td></tr>'; 
													}
													$table_data .= '</tbody></table>';
													echo $table_data;
						}


				}else{


					$query_select = "SELECT `description`,`id`,`id_card`,`full_name`, `cash_in`, `cash_out`, `blance` , `doller_in`,`doller_out`,`doller_blance`,`number`, `date` FROM `history` WHERE `id_card` = $id and months ='$date_name'  ORDER BY `id` ASC"; 
				 
					
						if(@$query_run = mysql_query($query_select)){
						

					 $nameOfCustom = mysql_result(mysql_query("SELECT `full_name` FROM `main_details` WHERE  `id`=$id "),0); 
					$passsport = mysql_result(mysql_query("SELECT `id_passport` FROM `main_details` WHERE  `id`=$id "),0); 
					$mobile = mysql_result(mysql_query("SELECT `number` FROM `main_details` WHERE  `id`=$id "),0); 
					$mobile_2 = mysql_result(mysql_query("SELECT `number` FROM `main_details` WHERE  `id`=$id "),0); 
				 $main_records  = mysql_fetch_assoc(mysql_query("SELECT * FROM `main_details` WHERE `id`=$id "));
			     $updateBtn = '<a href="#" style="/* float:right; */padding: 6px;margin-bottom: 3px;width: 116px;text-align: center;margin-left: 113px;/* margin: 5px; */" id="'.$id.'" name="'.$nameOfCustom.'" passsport="'.$passsport.'"  cash_in="'.$main_records['cash_in'].'" cash_out="'.$main_records['cash_out'].'" blance="'.$main_records['blance'].'"     doller_in="'.$main_records['doller_in'].'"  doller_out="'.$main_records['doller_out'].'"  doller_blance="'.$main_records['doller_blance'].'"      number="'.$mobile.'" edit="edit"  class="button edit update_btn">update</a>';	 
	
	
                      $mobile = (!empty($mobile))?', Mobile: ('.$mobile.')':'';
					  $passsport = (!empty($passsport))?', ID/Passport: ('.$passsport.')':'';
							
					 
					  
				  // exports 
                        $title = '<strong style="color:blue;">'.strtoupper(substr($nameOfCustom, 0, 1)).'</strong>'.substr($nameOfCustom, 1).' <span class="subMobile">'.$mobile.'</span> '.$passsport.'</h3>';
				        $query_full_account = "SELECT * FROM `history` WHERE `id_card`=$id and months ='$date_name' ORDER BY `id` ";
						$query_cash_debts = "SELECT * FROM `history` WHERE `id_card`=$id and blance LIKE \"-%\" and months =\"$date_name\" ORDER BY `id` ";
						$query_dollar_debts = "SELECT * FROM `history` WHERE `id_card`=$id and doller_blance LIKE \"-%\"  and months =\"$date_name\" ORDER BY `id` ";
						$query_cash_credit = "SELECT * FROM `history` WHERE `id_card`=$id and blance NOT LIKE \"-%\" and blance !=\"0\"  and months =\"$date_name\" ORDER BY `id` ";
						$query_dollar_credit = "SELECT * FROM `history` WHERE `id_card`=$id  and doller_blance NOT LIKE \"-%\" and doller_blance !=\"0\" and months =\"$date_name\" ORDER BY `id` ";
	
	// export buttons select option
			$exports_selector = 	"<select onchange='exporter($(this).find(&quot;option:selected&quot;).attr(&quot;query&quot;),$(this).find(&quot;option:selected&quot;).attr(&quot;title&quot;),$(this).find(&quot;option:selected&quot;).attr(&quot;colms&quot;),$(this).find(&quot;option:selected&quot;).attr(&quot;filename&quot;),$(this).find(&quot;option:selected&quot;).attr(&quot;two_tabs&quot;))' ><option> Export... </option> ".exportBtsCreator($query_full_account,'<h3 style="margin-left:14%;">Export Transactions for ('.$date_name.')'.$title,'6-all',"exports/customers/$nameOfCustom-$mobile_2-Transactions-for-($date_name).pdf","","Export Transactions for ($date_name)","","option");
			$exports_selector .= 	exportBtsCreator($query_cash_debts,'<h3 style="margin-left:14%;">Cash Debts for ('.$date_name.') | '.$title,'3-c',"exports/customers/$nameOfCustom-$mobile_2-All-Debt-Cash-(".str_replace('/','-',$date_name).").pdf","","Export All Cash Debts for ($date_name) !","","option");
			$exports_selector .= 	exportBtsCreator($query_dollar_debts,'<h3 style="margin-left:14%;">Dollar Debts for  ('.$date_name.') |'.$title,'3-d',"exports/customers/$nameOfCustom-$mobile_2-All-Debt-dollar-(".str_replace('/','-',$date_name).").pdf","","Export All Debts Dollar for ($date_name) !","","option");
			$exports_selector .= 	exportBtsCreator($query_cash_credit,'<h3 style="margin-left:14%;">Cash Credits for  ('.$date_name.') |'.$title,'3-c',"exports/customers/$nameOfCustom-$mobile_2-All-Credit-cash-(".str_replace('/','-',$date_name).").pdf","","Export All Cash Credits for ($date_name) !","","option");
			$exports_selector .= 	exportBtsCreator($query_dollar_credit,'<h3 style="margin-left:14%;">Dollar Credits for ('.$date_name.') |'.$title,'3-d',"exports/customers/$name-$mobile_2-All-credit-dollar-(".str_replace('/','-',$date_name).").pdf","","Export All Dollar Credits for ($date_name) !","","option");
	 		$exports_selector .= "</select>"; 	 
	
	// exports	  
 			
							
 
							
										$table_data = ' <br><hr> <h3 style="margin-left:14%;"><strong style="color:blue;">'.strtoupper(substr($nameOfCustom, 0, 1)).'</strong>'.substr($nameOfCustom, 1).' <span class="subMobile">'.$mobile.'</span> '.$passsport.''.$updateBtn.' | '.$exports_selector.' </h3>   <hr/>  <table class="table"   ><thead> <tr> <th>Full Name </th><th>Cash In </th><th>Cash Out</th> <th>Cash Balance</th>   <th>Dollar in </th>  <th>Dollar Out</th>  <th>Dollar Balance</th>    <th>Description</th> <th>Date</th> <th>Action</th> </tr>  </thead> <tbody>';
										
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

												
													$table_data .= '<tr><td>'.$full_name.'</td><td>'.$cash_in.' </td><td>'.$cash_out.'</td><td>'.$blance.'</td> <td>$'.$doller_in.'</td> <td>$'.$doller_out.'</td> <td>$'.$doller_blance.'</td>  <td>'.$description.'</td><td>'.$date.'   </td> <td> <a href="#" id="delete_histry" id_card="'.$id_card.'" delet_hist="'.$id.'"class="button delete"> delete </a> </td></tr>'; 
													}
												$table_data .= '</tbody></table>';
													echo $table_data;
						}



				}
 
}


?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ne;
   
	 -moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
	 -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
	 box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;		
}

#search_button::-moz-focus-inner
{
       border: 0;  /* Small centering fix for Firefox */
}		







.input{
	font:bold 16px verdana;
	padding:5px; 
	border:1px solid #b9bdc1;
	width:200px;
	color:#505050;
}
.input:focus{
	background-color:white;
	border:1px solid #f6bdd3;
}

.hover{
color:#fff;
cursor: pointer;

		background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #f6b33d), color-stop(1, #d29105) );
		background:-moz-linear-gradient( center top, #f6b33d 5%, #d29105 100% );
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f6b33d', endColorstr='#d29105');
		background-color:#f6b33d;
}

.feedback {

	text-align:center;
	display:inline-block;
	color:#ffffff;
	font-family:arial;
	font-size:14px;
	font-weight:bold;
	text-decoration:none;
	text-shadow: 1px 1px 5px #303030;
	margin:10px;
	padding:20px;
	background:#006699;
	border-radius:7px;
	-moz-border-radius:7px;
	-webkit-border-radius:7px;
	box-shadow:5px 5px 15px #A0A0A0; /*zero*/
	-moz-box-shadow:5px 5px 15px #A0A0A0;
	-webkit-box-shadow:5px 5px 15px #A0A0A0;
}

.remove_default_table_style{
 
}
 body{ padding: 10px; background-color: orange;} </style></head> <body> <h3 style="margin-left:14%;">Account For <strong style="color:blue;">Y</strong>assin Rwanda <span class="subMobile"></span> </h3><br><table  class='table' ><tr><th>Total Cash In</th> <th> Total Cash Out</th> <th>Total Cash Balance</th> <th>Total Dollar In </th> <th>Total Dollar Out</th> <th> Total Dollar Balance</th></tr><tr><td>1,444,000</td><td>1,052,000</td><td style='font-weight:bold;color:blue;' >392,000</td><td>$11,683</td><td>$10,000</td><td style='font-weight:bold;color:blue;'>$1,683</td></tr></table><br>() <table class="table"><tr><th>Name </th> <th>Cash In </th> <th> Cash Out </th> <th> Cash Balance </th> <th>Dollar In </th> <th>Dollar Out</th> <th>Dollar Balance</th> <th> Description </th> <th> Date </th></tr><tr> <td>Yassin Rwanda</td> <td>0</td> <td>48,000</td> <td style='font-weight:bold;color:blue;' >-48,000</td> <td>$<b>4,447</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >4,447</b></td> <td></td> <td>08/Oct/2015 @ 11:43:45 pm</td> <tr><tr> <td>Yassin Rwanda</td> <td>1,000,000</td> <td>345,000</td> <td style='font-weight:bold;color:blue;' >655,000</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>22/Oct/2015 @ 01:00:31 pm</td> <tr><tr> <td>Yassin Rwanda</td> <td>0</td> <td>0</td> <td style='font-weight:bold;color:blue;' >0</td> <td>$<b>0</b></td><td>$<b>10,000</b></td> <td>$<b style='font-weight:bold;color:blue;' >-10,000</b></td> <td></td> <td>23/Oct/2015 @ 01:56:36 pm</td> <tr><tr> <td>Yassin Rwanda</td> <td>0</td> <td>10,000</td> <td style='font-weight:bold;color:blue;' >-10,000</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>M-pesa</td> <td>23/Oct/2015 @ 02:50:18 pm</td> <tr><tr> <td>Yassin Rwanda</td> <td>144,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >144,000</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>from patrick</td> <td>24/Oct/2015 @ 09:49:14 am</td> <tr><tr> <td>Yassin Rwanda</td> <td>0</td> <td>607,000</td> <td style='font-weight:bold;color:blue;' >-607,000</td> <td>$<b>5,893</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >5,893</b></td> <td></td> <td>01/Nov/2015 @ 04:50:15 pm</td> <tr><tr> <td>Yassin Rwanda</td> <td>0</td> <td>5,000</td> <td style='font-weight:bold;color:blue;' >-5,000</td> <td>$<b>1,343</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >1,343</b></td> <td></td> <td>01/Nov/2015 @ 04:51:05 pm</td> <tr><tr> <td>Yassin Rwanda</td> <td>300,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >300,000</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>07/Nov/2015 @ 05:19:08 pm</td> <tr><tr> <td>Yassin Rwanda</td> <td>0</td> <td>10,000</td> <td style='font-weight:bold;color:blue;' >-10,000</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>m-pesa</td> <td>08/Nov/2015 @ 05:30:38 pm</td> <tr><tr> <td>Yassin Rwanda</td> <td>0</td> <td>27,000</td> <td style='font-weight:bold;color:blue;' >-27,000</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>gulf/rent</td> <td>12/Nov/2015 @ 10:51:28 pm</td> <tr></table><br><table  class='table' ><tr><th>Total Cash In</th> <th> Total Cash Out</th> <th>Total Cash Balance</th> <th>Total Dollar In </th> <th>Total Dollar Out</th> <th> Total Dollar Balance</th></tr><tr><td>1,444,000</td><td>1,052,000</td><td style='font-weight:bold;color:blue;' >392,000</td><td>$11,683</td><td>$10,000</td><td style='font-weight:bold;color:blue;'>$1,683</td></tr></table> </body><html>