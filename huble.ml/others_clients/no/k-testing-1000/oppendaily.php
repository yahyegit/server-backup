<?php

require 'connet.php';

if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
		die();
	
	}
  if(if_logged_in() != true){
die();
 }
 	

 
  

	$query_select = 'SELECT `id`, `name`, `cash_in`, `cash_out`, `cash_in`- `cash_out` as `blance` , `dolla_in`,`dolla_out`,`dolla_in` - `dolla_out` as `dolla_blance`,`date` FROM `oppen_day`  WHERE `month`="'.getLastMonth('SELECT DISTINCT `month` FROM `oppen_day` WHERE 1','month').'"ORDER BY `date`'; 
	
		if(@$query_run = mysql_query($query_select)){
		$table_data = ' <table class="table"   > <thead> <tr> <th>Title </th><th>Cash In </th> <th> Dollar In </th>  <th> Date </th>   <th> Action  </th> </tr> </thead> <tbody>';
				while($sql_row = mysql_fetch_assoc($query_run)){
				$id = 	$sql_row['id'];
			
				$name = 	$sql_row['name'];
				$cash_in = 		number_format($sql_row['cash_in']);
				$cash_out = 	number_format($sql_row['cash_out']);
				$blance = 		number_format($sql_row['blance']);
			 	$dolla_in = 		number_format($sql_row['dolla_in']);
				$dolla_out = 		number_format($sql_row['dolla_out']);	
				$dolla_blance = 		number_format($sql_row['dolla_blance']);
				
				$date 	= 		$sql_row['date'];	
				
				$blance_b = 		$sql_row['blance'];
				$dolla_blance_b = 	$sql_row['dolla_blance'];	
				
				$query_of_benefit = "SELECT sum(blance) - $blance_b as `cash_benefit`, sum(doller_blance) - $dolla_blance_b as `dollar_benefit` FROM `history`  WHERE `date` like '$date %' ";
				
				// calculatin benefit of each day  
				if(@$query_run_benefit = mysql_query($query_of_benefit)){
					$q_cash_b = number_format(mysql_result($query_run_benefit,0,'cash_benefit'));
					$q_dol_b = number_format(mysql_result($query_run_benefit,0,'dollar_benefit'));
					
						if(preg_match('/-/',$q_cash_b)){
						$cash_benefit   = 	"<span style='color:red;'>$q_cash_b</span>";
						}else{
						$cash_benefit   = 	"<span style='color:green;'>$q_cash_b</span>";
						}
						if(preg_match('/-/',$q_dol_b)){
						$dollar_benefit =	"$<span style='color:red;'>$q_dol_b</span>";
						}else{
						$dollar_benefit =	"$<span style='color:green;'>$q_dol_b</span>";
						}
						
					
					
					
				}
				

				$table_data .= '<tr><td class="day" date="'.$date.'">'.$name.'</td><td>'.$cash_in.' </td><td>$'.$dolla_in.'</td><td>'.$date.'</td> <td><pre><a href="#"  id="'.$id.'" name="'.$name.'" cash_in="'.$sql_row['cash_in'].'" cash_out="'.$sql_row['cash_out'].'" blance="'.$sql_row['blance'].'" dolla_in="'.$sql_row['dolla_in'].'" dolla_out="'.$sql_row['dolla_out'].'" dolla_blance="'.$sql_row['dolla_blance'].'"   edit="edit"  class="button ">edit</a> <a href="#"  id="'.$id.'"   date="'.$date.'"  delete="delet" class="button delete">Delete</a> </pre></td></tr>'; 
				}
		$table_data .= '</tbody></table>';
		
			echo $table_data;
		}



?>


