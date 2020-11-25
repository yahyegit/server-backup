<?php

require 'connet.php';
if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
		die();
	
	}

  if(if_logged_in() != true){
die();
 }
 	
if (isset($_POST['date1'])){

 
$date_to_select		=   trim(mysql_real_escape_string(htmlentities($_POST['date1'])));


	$query_select = "SELECT `id`, `name`, `cash_in_day`, `cash_out_day`, `blance` , `dolla_in`,`dolla_out`,`dolla_blance`,`number`,`time` FROM `daily_details` WHERE `date`='$date_to_select' ORDER BY `name` "; 
	
		if(@$query_run = mysql_query($query_select)){
	


		$table_data = '';
		$table_data .= '<table class="table" ><thead> <tr> <th> Name </th><th>Cash In </th><th>Cash Out</th> <th>Balance</th>  <th> Doller In </th> <th> Doller Out </th> <th> Doller Balance </th><th> Number </th> <th> Time </th> </tr> </thead> <tbody>';
		
			
			while($sql_row = mysql_fetch_assoc($query_run)){
			
				$name = 	$sql_row['name'];
				$cash_in = 		number_format($sql_row['cash_in_day']);
				$cash_out = 	number_format($sql_row['cash_out_day']);
				$blance = 		number_format($sql_row['blance']);
			 	$dolla_in = 		number_format($sql_row['dolla_in']);
				$dolla_out = 		number_format($sql_row['dolla_out']);	
				$dolla_blance = 		number_format($sql_row['dolla_blance']);	
				$number = 			$sql_row['number'];	
				$date = 		$sql_row['time'];	

				
				

				$table_data .= '<tr><td class="day" date="'.$date.'">'.$name.'</td><td>'.$cash_in.' </td><td>'.$cash_out.'</td><td>'.$blance.'</td> <td>$'.$dolla_in.'</td> <td>$'.$dolla_out.'</td><td>$'.$dolla_blance.'</td> <td>'.$number.'</td>     <td>'.$date.'<b> <a href="#"   name="'.$name.'" cash_in="'.$sql_row['cash_in_day'].'" cash_out="'.$sql_row['cash_out_day'].'" blance="'.$sql_row['blance'].'" dolla_in="'.$sql_row['dolla_in'].'" dolla_out="'.$sql_row['dolla_out'].'" dolla_blance="'.$sql_row['dolla_blance'].'"   edit_="edit_"  class="button edit">edit</a>  </b> </td></tr>'; 
				}
		$table_data .= '</tbody></table>';
		
			echo $table_data;
		}

}

?>


