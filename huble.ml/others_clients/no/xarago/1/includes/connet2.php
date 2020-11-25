<?php
 /*
error_reporting(0);
 
 
date_default_timezone_set('africa/nairobi');

$expireDate  = strtotime("20-11-2013");
$currentDAte = strtotime(Date('Y-m-d', time()));

 
$checkexistes = "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[";

?>




<?php

$myServer = "localhost";
$myUser = "yahye123_ahsa";  
$myPass = "v^fTT_eC*pH8";
$myDB = "yahye123_ahsa"; 
 
 
 

    //connection to the database
	if(!@mysql_connect($myServer, $myUser, $myPass)){
	 die("Error't connect To the server "); 
	}else if(!@mysql_select_db($myDB)){
		die("Couldn't open database "); 
	}else{
	
	}
 
 
 
 
 // check login  		
   $userId_activities = 0;
  
 function if_logged_in(){  
session_start();
if (isset($_SESSION['user_id_342ahsa'])){
	 return true;
}else{
return false;
}

 
 }
 
 
 // get last month or day 

function getLastMonth($queryRun,$rowOf){
 $month_n =  array();
 $arrayIndex = 0;
 
 
 		 if(@$query_run = mysql_query($queryRun)){
		     //  if(mysql_num_rows($query_run)){}
					while(@$sql_row = mysql_fetch_assoc($query_run)){
				       $month_n[$arrayIndex] = strtotime(str_replace('/','-','20/'.$sql_row[$rowOf]));
					   $arrayIndex++;
			        }
		 } 
 
 sort($month_n, SORT_NATURAL | SORT_FLAG_CASE);	 
   $xc = count($month_n)-1;
return (!empty($month_n[$xc]))?date("m/Y",$month_n[$xc]):'';		 
}



// get reports total
function get_report_totals($date){
 
	 // converts dollar in and dollar out to cash for month 
function totalDollarToCashMonth($date){
	
 
$query_change_mony = "SELECT  doller_in, doller_out,date FROM `history`  WHERE `date` like '%$date%' "; 
 	
	if(@$query_run = mysql_query($query_change_mony)){
				
			$doll_out_total_cash = 0;
			$doll_in_total_cash = 0;	
				while($sql_row = mysql_fetch_assoc($query_run)){
					$m_doller_in = 	$sql_row['doller_in'];
					$m_doller_out = 	$sql_row['doller_out'];  
					  $m_dayDate = 	explode("@",$sql_row['date']); 
					 
				   $currentRate = 	mysql_result(mysql_query("SELECT dollarRate FROM `oppen_day`  WHERE `date` = '".trim($m_dayDate['0'])."' "),0); 
				 // change all 
				 $doll_in_total_cash += $m_doller_in * $currentRate;
				 $doll_out_total_cash += $m_doller_out * $currentRate;
			 
					}

	}
 return array('dollarInToCash'=>$doll_in_total_cash,'dollarOutToCash'=>$doll_out_total_cash);
}
 
$date		=   trim(mysql_real_escape_string(htmlentities($date)));

  
			$query_total_manth = "SELECT count(`id`) as ids, SUM(blance) , SUM(cash_in) ,SUM(cash_out), SUM(doller_in),SUM(doller_out),SUM(doller_blance) FROM `history`  WHERE `date` like '%$date%' ";
			$query_total_manth2 = "SELECT name, SUM(blance) , SUM(cash_in) ,SUM(cash_out), SUM(dolla_in),SUM(dolla_out),SUM(dolla_blance),cashRate,dollarRate FROM `oppen_day`  WHERE `date` like '%$date%' ";
 
						$query_run2 = mysql_query($query_total_manth2);
						$namedate =  mysql_result($query_run2,0,'name');
						$total_blance2 = number_format(mysql_result($query_run2,0,'SUM(blance)'));
						$total_cash_in2 = number_format(mysql_result($query_run2,0,'SUM(cash_in)'));
						$total_cash_out2 = number_format(mysql_result($query_run2,0,'SUM(cash_out)'));
						
						$cash_blance2 = mysql_result($query_run2,0,'SUM(blance)'); // oppen Cash
						
						
						$total_cust_doller_in2 = number_format(mysql_result($query_run2,0,'SUM(dolla_in)'));
						$totalcust_doller_out2 = number_format(mysql_result($query_run2,0,'SUM(dolla_out)'));
						$total_cust_doller_blance2 = number_format(mysql_result($query_run2,0,'SUM(dolla_blance)'));
			      		// rates 
							$cashRate = mysql_result($query_run2,0,'cashRate'); 
							$dollarRate = mysql_result($query_run2,0,'dollarRate'); 
										
						$doller_blance2 = mysql_result($query_run2,0,'SUM(dolla_blance)'); // open dollar
						
					$tti = explode('/',$date);
			 
				if (count($tti) == 2){ // monthly 
				      $rateOnlyDay =  "";
				}else{ // daily 
			          $rateOnlyDay =  " <th style='width: 95px;'> Rate: </th>  <td style='color: red;'>".number_format($dollarRate,2)."</td>";
				 }
				 	
					$return_total = "<center color='#ffffff'> <h3 style='width: 477px; /* margin-left:-53%; */ border-bottom: 2px solid blue;padding: 7px;/* padding-left: 0px; *//* margin-top: 72px; */ '>Reports for (<span style=color:blue;'>".$tti[0]."</span>/".$tti[1].((count($tti) == 3)?'/'.$tti[2]:'').")  |   $export </h3> </center><br>  <h3 style='margin-left: 0px; border-bottom:2px solid blue; width:83%; '><span style='color:blue; '>O</span>Pen Cash:</h3>  <table class='table' style='width: 83%;margin-left: 0;'><tr><th>Open Cash: </th> <td><span style='color:red;'>$total_cash_in2</span></td> $rateOnlyDay </tr> </table>";
		 
			
		 
			
			        $query_run = mysql_query($query_total_manth);		
					$total_blance = number_format(mysql_result($query_run,0,'SUM(blance)'));
					$total_cash_in = number_format(mysql_result($query_run,0,'SUM(cash_in)'));
					$total_cash_out = number_format(mysql_result($query_run,0,'SUM(cash_out)'));
					$number_of_transactions = number_format(mysql_result($query_run,0,'ids'));
					
					$blance = mysql_result($query_run,0,'SUM(blance)');
					
					$total_cust_doller_in = number_format(mysql_result($query_run,0,'SUM(doller_in)'));
					$totalcust_doller_out = number_format(mysql_result($query_run,0,'SUM(doller_out)'));
					$total_cust_doller_blance = number_format(mysql_result($query_run,0,'SUM(doller_blance)'));	
					
					$doller_blance = mysql_result($query_run,0,'SUM(doller_blance)');	
					
					
				     // open cash   + total cash in + total dollar in - all out 
			 
				if (count($tti) == 2){ // monthly 
				$dollarINandDollarOut_inCash = totalDollarToCashMonth($date);
			  
				$total_cash_blance = (($cash_blance2 + mysql_result($query_run,0,'SUM(cash_in)')) + $dollarINandDollarOut_inCash['dollarInToCash']) - (mysql_result($query_run,0,'SUM(cash_out)') + $dollarINandDollarOut_inCash['dollarOutToCash']); // all to Cash
 
				}else{ // daily 
				    $total_cash_blance = (($cash_blance2 + mysql_result($query_run,0,'SUM(cash_in)')) + (mysql_result($query_run,0,'SUM(doller_in)') * $dollarRate)) - (mysql_result($query_run,0,'SUM(cash_out)') + (mysql_result($query_run,0,'SUM(doller_out)') * $dollarRate)); // all to Cash
				}
					
					
					
					
					
					
					$total_dollar_blance =  $doller_blance + $doller_blance2;
		
		
			
			
			 // convation  
			 $allToCash  = (($total_dollar_blance * $dollarRate) + $total_cash_blance); // all to Cash
			 $allToDollar = (($total_cash_blance / $cashRate) + $total_dollar_blance); // all to Dollar
			 
         
			 
					
			    // profit calculation  
			 $cash_profit =    number_format($allToCash - ($cash_blance2 + ($doller_blance2 * $dollarRate))); // cash profit = allToCash - (open_cash + changed_Open_Dollar_to_Cash)
			 $doller_profit =  number_format($allToDollar - ($doller_blance2 + ($cash_blance2 / $cashRate)));   // Dollar profit = allToDollar - (open_dollar + changed_Open_Cash_to_Dollar)
			 
			 $profitColor =  array( 'cash' => ((preg_match("/-/",$cash_profit))?'red':'green'),'dollar'=> ((preg_match("/-/",$doller_profit))?'red':'green')  );
			 

			$return_total .=  "<h3 style='width: auto; /* margin-left:-53%; */ border-bottom: 2px solid blue;padding: 7px;/* padding-left: 0px; *//* margin-top: 72px; */margin-left: 0;'><span style=color:blue;'>T</span>ransactions:</h3> <table class='table'><tbody> <tr> <th>Total Cash In: </th><td><span style='color:red;'>$total_cash_in</span>   </td><th>Total Cash Out :</th><td> <span style='color:red;'>$total_cash_out</span>  </td><th> Total Cash Balance : </th><td><span style='color:red;'>$total_blance</span>   </td> </tr> <tr> <th> Total Dollar In: </th><td> $<span style='color:red;'>$total_cust_doller_in</span>  </td><th> Total Dollar Out :</th> <td>$<span style='color:red;'>$totalcust_doller_out</span> </td> <th> Total Dollar Balance : </th> <td>$<span style='color:red;'>$total_cust_doller_blance</span> </td></tr>  </tbody> </table> ";
			    // currents   <h3 style='width: auto; /* margin-left:-53%; */ border-bottom: 2px solid blue;padding: 7px;/* padding-left: 0px; *//* margin-top: 72px; */margin-left: 0;'><span style=color:blue;'>P</span>rofits:</h3> 
		$return_total .=  "<h3 style='width: auto; /* margin-left:-53%; */ border-bottom: 2px solid blue;padding: 7px;/* padding-left: 0px; *//* margin-top: 72px; */margin-left: 0;'><span style=color:blue;'>|</span></h3> 
		<table class='table' style='width:90%;margin-left:0px;'><tbody> 
		<tr> <th style='width: 280px;'>Your Current Total Cash Balance is :</th><td><span style='color:red;'>".number_format($total_cash_blance,2)."</span> </td> <th  style='width: 213px;'>Number of Transactions is :</th><td ><span style='color:#000;'>(<b style='color:blue;'>$number_of_transactions</b>)</span></td></tr> ";
		 
      return $return_total;
	
}
 
function sanatizeData($data){
      return  trim(mysql_real_escape_string(htmlentities($data)));
}

function sanitize($value){
return htmlentities(mysql_real_escape_string(trim($value)));
}
 */


?>