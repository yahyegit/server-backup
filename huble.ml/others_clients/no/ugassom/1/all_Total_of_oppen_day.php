<?php



require 'connet.php';
if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
		die();
	
	}


if (isset($_POST['oppen1'])){

 /*

			$query_total_manth = "SELECT SUM(blance) , SUM(cash_in) ,SUM(cash_out), SUM(dolla_in),SUM(dolla_out),SUM(dolla_blance) FROM `oppen_day`";

		 

				if(@$query_run = mysql_query($query_total_manth)){

					$total_blance = number_format(mysql_result($query_run,0,'SUM(blance)'));

					$total_cash_in = number_format(mysql_result($query_run,0,'SUM(cash_in)'));

					$total_cash_out = number_format(mysql_result($query_run,0,'SUM(cash_out)'));

					

					$total_cust_doller_in = number_format(mysql_result($query_run,0,'SUM(dolla_in)'));

					$totalcust_doller_out = number_format(mysql_result($query_run,0,'SUM(dolla_out)'));

					$total_cust_doller_blance = number_format(mysql_result($query_run,0,'SUM(dolla_blance)'));

				 

					

			$cash = mysql_result($query_run,0,'SUM(blance)');
			$dol = mysql_result($query_run,0,'SUM(dolla_blance)');
					 
					 
					 			 
				$query_of_benefit = "SELECT sum(blance) - $cash as `cash_benefit`, sum(doller_blance) - $dol as `dollar_benefit` FROM `history`";

				
				

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

						$dollar_benefit =	"<span style='color:green;'>$q_dol_b</span>";

						}

						

				}
 
					 
				echo "<div> $<strong style='color:red;'>$total_cust_doller_blance</strong> </div>   ";
	
					
 
				}

*/
 $month   = date('M/Y',strtotime('1-'.str_replace('/','-',getLastMonth('SELECT DISTINCT `month` FROM `oppen_day` WHERE 1','month')))); 
 $month2   =  getLastMonth('SELECT DISTINCT `month` FROM `oppen_day` WHERE 1','month');
echo "<table class='table' style='width: 50%;'> <tr class='monthly' style=' cursor: pointer;' title='Click to See Reports for ($month)' mmmonth='$month' ><th style='width: 185px;'> Click to See Reports for </th> <td style='color:black;'  >$month</td></tr></table>   ";
	

}





?>
