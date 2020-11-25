<?php

require 'connet.php';
include 'function_s.php';
if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
		die();
	
	}
  if(if_logged_in() != true){
die();
 }
 	


 if (isset($_POST['month'])){
	








	$id_no		=   trim(mysql_real_escape_string(htmlentities($_POST['month'])));
  
		            $nameOfCustom = mysql_result(mysql_query("SELECT `full_name` FROM `main_details` WHERE  `id`=$id_no "),0); 
					$passsport_ = mysql_result(mysql_query("SELECT `id_passport` FROM `main_details` WHERE  `id`=$id_no "),0); 
					$mobile = mysql_result(mysql_query("SELECT `number` FROM `main_details` WHERE  `id`=$id_no "),0); 
                      $mobile = (!empty($mobile))?', Mobile: ('.$mobile.')':'';
					  $passsport = (!empty($passsport_))?', ID/Passport: ('.$passsport_.')':'';
	
	$query_select = "SELECT `id`, `full_name`, `cash_in`, `cash_out`, `blance` , `doller_in`,`doller_out`,`doller_blance`,`time`,`number` FROM `main_details` WHERE `id`=$id_no ORDER BY `full_name`"; 
	
		if(@$query_run = mysql_query($query_select)){
	 
		 $table_data = '   <h3><strong style="color:blue;">'.strtoupper(substr($nameOfCustom, 0, 1)).'</strong>'.substr($nameOfCustom, 1).' <span class="subMobile">'.$mobile.'</span>'.$passsport.' </h3> <hr style="background: blue;height: 2;border: none;" /> <br> <table class="table"   > <thead> <tr> <th>Full Name </th><th>Cash In </th><th>Cash Out</th> <th>Cash Balance</th> <th> Dollar In </th> <th>Dollar Out</th> <th> Dollar Balance </th>  <th>Number</th>  <th>Update/Delete</th> </tr>  </thead> <tbody>';
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
					
					
					
				
				
				
				

				$table_data .= '<tr><td class="full_name" id="'.$id.'">'.$full_name.'</td><td>'.$cash_in.' </td><td>'.$cash_out.'</td><td>'.$blance.'</td>  <td>$'.$doller_in.'</td>  <td>$'.$doller_out.'</td> <td>$'.$doller_blance.'</td> </td> <td>'.$number.'  </td>  <td>    <pre> <a href="#"  id="'.$id.'" name="'.$full_name.'" passsport="'.$passsport_.'"  cash_in="'.$sql_row['cash_in'].'" cash_out="'.$sql_row['cash_out'].'" blance="'.$sql_row['blance'].'"     doller_in="'.$sql_row['doller_in'].'"  doller_out="'.$sql_row['doller_out'].'"  doller_blance="'.$sql_row['doller_blance'].'"      number="'.$number.'" edit="edit"  class="button edit">update</a> <a href="#"  id="'.$id.'"   name="'.$full_name.'" cash_in="'.$cash_in.'" cash_out="'.$cash_out.'" blance="'.$blance.'" number="'.$number.'"   del="del" class="button delete">Delete</a> </pre> </td></tr>'; 
				}
		$table_data .= '</tbody> </table>';
		
			echo $table_data;
		}

}

?>


