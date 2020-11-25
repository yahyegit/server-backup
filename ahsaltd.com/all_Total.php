<?php

require 'connet.php';
if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
		die();
	
	}
if (isset($_POST['id5'])){


$id		=   trim(mysql_real_escape_string(htmlentities($_POST['id5'])));


			$query_total_manth = "SELECT SUM(blance) , SUM(cash_in) ,SUM(cash_out), SUM(doller_in),SUM(doller_out),SUM(doller_blance) FROM `history` WHERE `id_card` = $id"; 
			$query_count = "SELECT count(id_card) FROM `history` WHERE `id_card` = $id";
				if(@$query_run = mysql_query($query_total_manth)){
					$total_blance = number_format(mysql_result($query_run,0,'SUM(cash_in)') - mysql_result($query_run,0,'SUM(cash_out)'));
					$total_cash_in = number_format(mysql_result($query_run,0,'SUM(cash_in)'));
					$total_cash_out = number_format(mysql_result($query_run,0,'SUM(cash_out)'));
					
					$total_cust_doller_in = number_format(mysql_result($query_run,0,'SUM(doller_in)'));
					$totalcust_doller_out = number_format(mysql_result($query_run,0,'SUM(doller_out)'));
					$total_cust_doller_blance = number_format(mysql_result($query_run,0,'SUM(doller_in)') - mysql_result($query_run,0,'SUM(doller_out)'));
					
					
					$query_countr = mysql_query($query_count);
					
					$count = number_format(mysql_result($query_countr,0,'count(id_card)'));
				
				echo "<div>Total Cash In of All months is: <strong style='color:red;'>$total_cash_in</strong> </div>  <div>Total Cash Out of All months is: <strong style='color:red;'>$total_cash_out</strong> </div>  <div>Total Cash Blance of All months is: <strong style='color:red;'>$total_blance</strong> </div>  <br/>  <div>Total Dollar In of All months is: $<strong style='color:red;'>$total_cust_doller_in</strong> </div> <div>Total Dollar Out of All months is: $<strong style='color:red;'>$totalcust_doller_out</strong> </div> <div>Total Dollar Blance of All months is : $<strong style='color:red;'>$total_cust_doller_blance</strong> </div>";
				}

				
				
			
					
	

}


?>
