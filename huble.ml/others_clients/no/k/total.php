<?php

require 'connet.php';
if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
		die();
	
	}
if (isset($_POST['date1'])){
$date		=   trim(mysql_real_escape_string(htmlentities($_POST['date1'])));

  
			$query_total_manth = "SELECT SUM(blance) , SUM(cash_in) ,SUM(cash_out), SUM(doller_in),SUM(doller_out),SUM(doller_blance) FROM `history`  WHERE `date` like '%$date%' ";
			$query_total_manth2 = "SELECT name, SUM(blance) , SUM(cash_in) ,SUM(cash_out), SUM(dolla_in),SUM(dolla_out),SUM(dolla_blance) FROM `oppen_day`  WHERE `date` like '%$date%' ";
			
			
						$query_run2 = mysql_query($query_total_manth2);
						$namedate =  mysql_result($query_run2,0,'name');
						$total_blance2 = number_format(mysql_result($query_run2,0,'SUM(blance)'));
						$total_cash_in2 = number_format(mysql_result($query_run2,0,'SUM(cash_in)'));
						$total_cash_out2 = number_format(mysql_result($query_run2,0,'SUM(cash_out)'));
						
						$cash_blance2 = mysql_result($query_run2,0,'SUM(blance)');
						
						
						$total_cust_doller_in2 = number_format(mysql_result($query_run2,0,'SUM(dolla_in)'));
						$totalcust_doller_out2 = number_format(mysql_result($query_run2,0,'SUM(dolla_out)'));
						$total_cust_doller_blance2 = number_format(mysql_result($query_run2,0,'SUM(dolla_blance)'));
						
						$doller_blance2 = mysql_result($query_run2,0,'SUM(dolla_blance)');
					$tti = explode('/',$date);
			 
					
						
						echo "<center color='#ffffff'> <h3 style='width: 477px; /* margin-left:-53%; */ border-bottom: 2px solid blue;padding: 7px;/* padding-left: 0px; *//* margin-top: 72px; */ '>Reports for (<span style=color:blue;'>".$tti[0]."</span>/".$tti[1].((count($tti) == 3)?'/'.$tti[2]:'').")</h3> </center><br>  <h3 style='margin-left: 0px; border-bottom:2px solid blue; width:83%; '><span style='color:blue; '>O</span>Pen Cash:</h3>  <table class='table' style='width: 83%;margin-left: 0;'><tr><th>Cash In: </th> <td><span style='color:red;'>$total_cash_in2</span></td>  <th> Dollar In: </th><td>  $<span style='color:red;'>$total_cust_doller_in2</span></td></tr> </table>";
		 
			
			
			
			
			
			        $query_run = mysql_query($query_total_manth);		
					$total_blance = number_format(mysql_result($query_run,0,'SUM(blance)'));
					$total_cash_in = number_format(mysql_result($query_run,0,'SUM(cash_in)'));
					$total_cash_out = number_format(mysql_result($query_run,0,'SUM(cash_out)'));
					
					$blance = mysql_result($query_run,0,'SUM(blance)');
					
					$total_cust_doller_in = number_format(mysql_result($query_run,0,'SUM(doller_in)'));
					$totalcust_doller_out = number_format(mysql_result($query_run,0,'SUM(doller_out)'));
					$total_cust_doller_blance = number_format(mysql_result($query_run,0,'SUM(doller_blance)'));	
					
					$doller_blance = mysql_result($query_run,0,'SUM(doller_blance)');	
					
					$total_cash_blance =  number_format($cash_blance2 + $blance);
					$total_dollar_blance =  number_format($doller_blance + $doller_blance2);
					
				
					
	 
				echo "<h3 style='width: auto; /* margin-left:-53%; */ border-bottom: 2px solid blue;padding: 7px;/* padding-left: 0px; *//* margin-top: 72px; */margin-left: 0;'><span style=color:blue;'>T</span>ransactions:</h3> <table class='table'><tbody> <tr> <th>Total Cash In: </th><td><span style='color:red;'>$total_cash_in</span>   </td><th>Total Cash Out :</th><td> <span style='color:red;'>$total_cash_out</span>  </td><th> Total Cash Balance : </th><td><span style='color:red;'>$total_blance</span>   </td> </tr> <tr> <th> Total Dollar In: </th><td> $<span style='color:red;'>$total_cust_doller_in</span>  </td><th> Total Dollar Out :</th> <td>$<span style='color:red;'>$totalcust_doller_out</span> </td> <th> Total Dollar Balance : </th> <td>$<span style='color:red;'>$total_cust_doller_blance</span> </td></tr>  </tbody> </table> ";
				echo " <h3 style='width: auto; /* margin-left:-53%; */ border-bottom: 2px solid blue;padding: 2px;/* padding-left: 0px; *//* margin-top: 72px; */margin-left: 0;'></h3> <div>Your Current Total Cash Balance is : <strong style='color:red;'> $total_cash_blance  </strong> </div> </br> <div>Your Current Total dollar Balance is :  $<strong style='color:red;'>$total_dollar_blance  </strong>  </div>    ";
			
		
				
			

	
}			
?>