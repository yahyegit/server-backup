<?php
 
error_reporting(0);
 
 
date_default_timezone_set('africa/nairobi');

$expireDate  = strtotime("20-11-2013");
$currentDAte = strtotime(Date('Y-m-d', time()));

 
$checkexistes = "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[";

?>




<?php
 
$myServer = "mysql.ahsaltd.com";
$myUser = "ahsaltd";  
$myPass = "tR2QZZV4dr";
$myDB = "ahsaltd"; 

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
						$total_blance2 = number_format(mysql_result($query_run2,0,'SUM(cash_in)') - mysql_result($query_run2,0,'SUM(cash_out)'));
						
						$total_cash_in2 = number_format(mysql_result($query_run2,0,'SUM(cash_in)'));
						$total_cash_out2 = number_format(mysql_result($query_run2,0,'SUM(cash_out)'));
						
						$cash_blance2 = mysql_result($query_run2,0,'SUM(cash_in)') - mysql_result($query_run2,0,'SUM(cash_out)'); // oppen Cash
						
						
						$total_cust_doller_in2 = number_format(mysql_result($query_run2,0,'SUM(dolla_in)'));
						$totalcust_doller_out2 = number_format(mysql_result($query_run2,0,'SUM(dolla_out)'));
						$total_cust_doller_blance2 = number_format(mysql_result($query_run2,0,'SUM(dolla_in)') - mysql_result($query_run2,0,'SUM(dolla_out)'));
			      		// rates 
							$cashRate = mysql_result($query_run2,0,'cashRate'); 
							$dollarRate = mysql_result($query_run2,0,'dollarRate'); 
										
						$doller_blance2 = mysql_result($query_run2,0,'SUM(dolla_in)') - mysql_result($query_run2,0,'SUM(dolla_out)'); // open dollar
						
					$tti = explode('/',$date);
			 
				if (count($tti) == 2){ // monthly 
				      $rateOnlyDay =  "";
				}else{ // daily 
			          $rateOnlyDay =  " <th style='width: 95px;'> Rate: </th>  <td style='color: red;'>".number_format($dollarRate,2)."</td>";
				 }
				
					
						
					$return_total = "<center color='#ffffff'> <h3 style='width: 477px; /* margin-left:-53%; */ border-bottom: 2px solid blue;padding: 7px;/* padding-left: 0px; *//* margin-top: 72px; */ '>Reports for (<span style=color:blue;'>".$tti[0]."</span>/".$tti[1].((count($tti) == 3)?'/'.$tti[2]:'').")</h3> </center><br>  <h3 style='margin-left: 0px; border-bottom:2px solid blue; width:83%; '><span style='color:blue; '>O</span>Pen Cash:</h3>  <table class='table' style='width: 83%;margin-left: 0;'><tr><th>Open Cash: </th> <td><span style='color:red;'>$total_cash_in2</span></td> $rateOnlyDay </tr> </table>";
		 
			
		 
			
			        $query_run = mysql_query($query_total_manth);		
					$total_blance = number_format(mysql_result($query_run,0,'SUM(cash_in)') - mysql_result($query_run,0,'SUM(cash_out)'));
					$total_cash_in = number_format(mysql_result($query_run,0,'SUM(cash_in)'));
					$total_cash_out = number_format(mysql_result($query_run,0,'SUM(cash_out)'));
					$number_of_transactions = number_format(mysql_result($query_run,0,'ids'));
					
					$blance = mysql_result($query_run,0,'SUM(cash_in)') - mysql_result($query_run,0,'SUM(cash_out)');
					
					$total_cust_doller_in = number_format(mysql_result($query_run,0,'SUM(doller_in)'));
					$totalcust_doller_out = number_format(mysql_result($query_run,0,'SUM(doller_out)'));
					$total_cust_doller_blance = number_format(mysql_result($query_run,0,'SUM(doller_in)') - mysql_result($query_run,0,'SUM(doller_out)'));	
					 
					$doller_blance = mysql_result($query_run,0,'SUM(doller_in)') - mysql_result($query_run,0,'SUM(doller_out)');
					
					
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

function sanatizeDataSql($data){
	return trim(mysql_real_escape_string($data));
}
 
/*
// exporter 
 
function exporter($query,$title,$collms,$fileName_with_path,$tabs){  //$tabs : 2-tab2 or reports 
 
		if(@$query_run = mysql_query(sanatizeDataSql($query))){
			
			$totals = array("total_cashIn","total_cashOut","total_cashBalace","total_dollIn","total_dollarOut","total_dollarBalace"); 
        
		  		// if credit and debts tab 
					if($tabs == "2-tab") {
						$toggle_collHeader = "<th> Mobile </th>";
					}else {
						$toggle_collHeader = "<th> Description </th> <th> Date </th>";
					}
		 		
		  
		  
				if ($collms == "3-c"){ // cashin cashout cash balance,
			          $table_header = "<th>Name</th> <th>Cash In</th> <thCash Out</th> <th>Cash Balance</th> $toggle_collHeader";
				 }else if ($collms == "3-d"){ // dollar in, dollar out, dollar balance
                      $table_header = "<th>Name </th> <th>Dollar In</th> <th>Dollar Out</th> <th>Dollar Balance</th> $toggle_collHeader";	
				 }else if ($collms == "6-all"){ // all 
				      $table_header = "<th>Name </th> <th>Cash In </th> <th> Cash Out </th> <th> Cash Balance </th> <th>Dollar In </th> <th>Dollar Out</th> <th>Dollar Balance</th> $toggle_collHeader";
				 }
				 
		     $table .= "<table><tr>$table_header </tr></table>";
		    while($sql_row = mysql_fetch_assoc($query_run)){
				$id_card = 	$sql_row['id_card'];
				$mobile = mysql_result(mysql_query("SELECT `number` FROM `main_details` WHERE `id` = '$id_card' "),0);

				if ($collms == "3-c"){ // cashin cashout cash balance,
				    $name = 	$sql_row['name'];
					$cash_in = 		number_format($sql_row['cash_in']);
					$cash_out = 	number_format($sql_row['cash_out']);
					$blance = 		number_format($sql_row['blance']);
					
					$description = 	$sql_row['description'];
					$date = 	$sql_row['date'];
						
						// if credit and debts tab 
					if($tabs == "2-tab") {
						$toggle_collms = "$mobile";
					}else {
						$toggle_collms = "$description, $date";
					}
		 		
					
					$table .= "<tr><td>$name</td> <td>$cash_in</td> <td>$cash_out</td> <td>$blance</td> <td>$toggle_collms</td><tr>";
		             // cash totals 
				    $totals['total_cashIn'] += $sql_row['cash_in'];
					$totals['total_cashOut'] += $sql_row['cash_out'];
					$totals['total_cashBalace'] += $sql_row['blance'];
				 
					
				}else if ($collms == "3-d"){ // dollar in, dollar out, dollar balance
				 $name = 	$sql_row['name'];
				    $dolla_in = 		number_format($sql_row['dolla_in']);
					$dolla_out = 		number_format($sql_row['dolla_out']);	
					$dolla_blance = 		number_format($sql_row['dolla_blance']);
					$description = 	$sql_row['description'];
					$date = 	$sql_row['date'];
					
					// if credit and debts tab 
					if($tabs == "2-tab") {
						$toggle_collms = "<td>$mobile</td>";
					}else {
						$toggle_collms = "<td>$description</td> <td>$date</td>";
					}
					
					
					$table .= "<tr> <td>$name</td> <td>$$dolla_in</td><td>$$dolla_in</td><td>$$dolla_out </td> <td>$$dolla_blance </td> <td>$toggle_collms</td> <tr>";
		             
					 // dollar totals
					$totals['total_dollIn'] += $sql_row['dolla_in']; 
					$totals['total_dollarOut'] += $sql_row['dolla_out'];
					$totals['total_dollarBalace'] += $sql_row['dolla_blance'];
				
				}else if ($collms == "6-all"){ // all 
				    $name = 	$sql_row['name'];
					$cash_in = 		number_format($sql_row['cash_in']);
					$cash_out = 	number_format($sql_row['cash_out']);
					$blance = 		number_format($sql_row['blance']);
					
					$dolla_in = 		number_format($sql_row['dolla_in']);
					$dolla_out = 		number_format($sql_row['dolla_out']);	
					$dolla_blance = 		number_format($sql_row['dolla_blance']);
					$description = 	$sql_row['description'];
					$date = 	$sql_row['date'];
					
					$table .= "<tr> <td>$name</td> <td>$cash_in</td> <td>$cash_out</td> <td>$blance</td> <td>$$dolla_in</td><td>$$dolla_out </td> <td>$$dolla_blance </td> <td>$description</td> <td>$date</td> <tr>";
		             // cash totals 
				    $totals['total_cashIn'] += $sql_row['cash_in'];
					$totals['total_cashOut'] += $sql_row['cash_out'];
					$totals['total_cashBalace'] += $sql_row['blance'];
					 // dollar totals
					$totals['total_dollIn'] += $sql_row['dolla_in'];
					$totals['total_dollarOut'] += $sql_row['dolla_out'];
					$totals['total_dollarBalace'] += $sql_row['dolla_blance'];
				
				}
				
				
					
			}
		 
			
                   // create totals table 
				if ($collms == "3-c"){ // cashin cashout cash balance,
			     $total_row =   "<td>".number_format($totals['total_cashIn'])."</td><td>".number_format($totals['total_cashOut'])."</td><td>".number_format($totals['total_cashBalace'])."</td>";
				 $total_header = "<th>Total Cash In</th> <th> Total Cash Out</th> <th>Total Cash Balance</th>";
				}else if ($collms == "3-d"){ // dollar in, dollar out, dollar balance
                  $total_row =       "<td>".number_format($totals['total_dollIn'])."</td><td>".number_format($totals['total_dollarOut'])."</td><td>".number_format($totals['total_dollarBalace'])."</td>";
				  $total_header = "<th>Total Dollar In </th> <th>Total Dollar Out</th> <th> Total Dollar Balance</th>";
				}else if ($collms == "6-all"){ // all 
	             $total_row =  "<td>".number_format($totals['total_cashIn'])."</td><td>".number_format($totals['total_cashOut'])."</td><td>".number_format($totals['total_cashBalace'])."</td><td>".number_format($totals['total_dollIn'])."</td><td>".number_format($totals['total_dollarOut'])."</td><td>".number_format($totals['total_dollarBalace'])."</td>";
				 $total_header = "<th>Total Cash In</th> <th> Total Cash Out</th> <th>Total Cash Balance</th> <th>Total Dollar In </th> <th>Total Dollar Out</th> <th> Total Dollar Balance</th>";
			}
				 $total_row =  "<table><tr>$total_header</tr><tr>$total_row</tr></table>";
			
			$table .= "</table> ($query) <br> $total_row ";
			
			// the complate file with title,total header, body and total footer
			$file_html = $title."<br>".$total_row."<br>".$table;  // $title if reports view title is total.php
			
			
			
			
			
			
			
		}
 

}
 

 // backup function
function backup_f(){  
  
  
              // create backup folder  for current date
					$current_backupFolder = "backups/Backup for (".date('d-M-Y').")";
					mkdir($current_backupFolder,0755, true);  
		  
					$creditsFolder =  "$current_backupFolder/Credits";
					$debtsFolder =  "$current_backupFolder/Debts";
					$reportsFolder = "$current_backupFolder/Reports";
					$customers_folder  = "$current_backupFolder/customers";
					
					mkdir($customers_folder, 0755, true);			
					mkdir($creditsFolder,0755, true);
					mkdir($debtsFolder,0755, true);
					mkdir($reportsFolder,0755, true);
              // end of creating backup folder structure 
			  
  
               // create customers files
		    while($sql_row = mysql_fetch_assoc(mysql_query("SELECT * FROM 'main_details' ORDER BY `id` "))){
				$customerId = 	$sql_row['id'];
				$name = $sql_row['fullName'];
				$mobile =  $sql_row['Number'];
                $mobile_2 = (!empty($mobile))?"($mobile)":"";
				
				
				// customer Backup files 
						// Titles 
						$title1 = "<h1> All Transactions for ( $name ) $mobile_2 </h1>";
						$title2 = "<h1> All Cash Debt Transactions for ( $name )  $mobile_2 </h1>";
						$title3 = "<h1> All Dollar Debt Transactions for ( $name ) $mobile_2</h1>";
						$title4 = "<h1> All Cash Credit Transactions for ( $name )  $mobile_2 </h1>";	
						$title5 = "<h1> All Dollar Credit Transactions for ( $name )  $mobile_2 </h1>";
						 // Queries       
						$query_full_account = "SELECT * FROM `history` WHERE `id_card`=$customerId ORDER BY `id` ";
						$query_cash_debts = "SELECT * FROM `history` WHERE `id_card`=$customerId and blance LIKE '-%' ORDER BY `id` ";
						$query_dollar_debts = "SELECT * FROM `history` WHERE `id_card`=$customerId and doller_blance LIKE '-%' ORDER BY `id` ";
						$query_cash_credit = "SELECT * FROM `history` WHERE `id_card`=$customerId  and blance NOT LIKE '-%' and blance !='0' ORDER BY `id` ";
						$query_dollar_credit = "SELECT * FROM `history` WHERE `id_card`=$customerId   and doller_blance NOT LIKE '-%' and doller_blance !='0' ORDER BY `id` ";

						// file Names
						$file_all_debt_cash = "$name-$mobile_2-All-Debt-cash.pdf";
						$file_all_debt_dollar = "$name-$mobile_2-All-Debt-dollar.pdf";
						$file_all_credit_cash = "$name-$mobile_2-All-Credit-cash.pdf";
						$file_all_credit_Dollar = "$name-$mobile_2-All-credit-dollar.pdf";
						$file_full_account = "$name-$mobile_2-full-Account.pdf";
								
					     
						 // create folder for for current customer 
						$current_customer_folder = "$customers_folder/$name-$mobile_2";
						 mkdir($current_customer_folder, 0755, true);
								
							
								 
				       // export one by one         
						exporter($query_full_account,$title1,"6-all","$current_customer_folder/$file_full_account",''); // export full Account 
				        
						exporter($query_cash_debts,$title2,"3-c","$current_customer_folder/$file_all_debt_cash",''); // export full Account 
							
						exporter($query_dollar_debts,$title3,"3-d","$current_customer_folder/$file_all_debt_dollar",''); // export full Account 
							
						exporter($query_cash_credit,$title4,"3-c","$current_customer_folder/$file_all_credit_cash",''); // export full Account 
							
						exporter($query_dollar_credit,$title5,"3-d","$current_customer_folder/$file_all_credit_Dollar",''); // export full Account 
 
}  // end of customers Backup 
               // end of  creating customers files
 
 				    $currentMonth = date('m/Y');
					$currentdayDate = date('d/m/Y');
 
				// creating credits,debts,reports 
				
						// Titles 
						$title1 = "<h1> All Cash Credits  </h1>";
						$title2 = "<h1> All Dollar Credits </h1>";
						$title3 = "<h1> All Dollar Debts </h1>";
						$title4 = "<h1> All Cash Debts </h1>";	
						
						$title5 = get_report_totals($currentdayDate); // Reports title   Daily 
						$title6 =  get_report_totals($currentMonth); // Reports title monthly 
						
						// Queries       
						$query_all_credit_cash= "SELECT * FROM `main_details`  WHERE blance NOT LIKE '-%' and blance !='0' ORDER BY `full_name`";
						$query_all_credit_dollar= "SELECT * FROM `main_details`  WHERE doller_blance NOT LIKE '-%' and doller_blance !='0' ORDER BY `full_name`";

						$query_all_debts_cash = "SELECT * FROM `main_details`  WHERE blance like '-%' ORDER BY `full_name`";
						$query_all_debts_dollar = "SELECT * FROM `main_details`  WHERE doller_blance like'-%' ORDER BY `full_name`";				   
				
						$query_current_day_Reports = "SELECT * FROM `history` WHERE `date` LIKE '$currentdayDate%' ORDER BY `id` ";
						$query_current_month_Reports = "SELECT * FROM `history` WHERE `date` LIKE '%$currentMonth%' ORDER BY `id` ";

						
						// file Names
						$file_creditTab_cash = "All-Credit-Cash.pdf";
						$file_creditTab_dollar = "All-Credit-dollar.pdf";
						
						$file_debtsTab_cash = "All-Debt-Cash.pdf";
						$file_debtsTab_dollar = "All-Debts-dollar.pdf";	
						
						$file_month_reports = "Reports-for-(".date('M-Y').").pdf";
						$file_daily_reports = "Reports-for-(".date('d-M-Y').").pdf";
					     
						// create folder for for current customer 
						$current_customer_folder = "$current_backupFolder/$name-$mobile_2";
						 mkdir($current_customer_folder);
					 
				       // export other files one by one         
					 
						exporter($query_all_credit_cash,$title1,"3-c","$creditsFolder/$file_creditTab_cash",'2-tab'); // export full Account 
							
						exporter($query_all_credit_dollar,$title2,"3-d","$creditsFolder/$file_creditTab_dollar",'2-tab'); // export full Account 
							
						exporter($query_all_debts_cash,$title4,"3-c","$debtsFolder/$file_debtsTab_cash",'2-tab'); // export full Account 
							
						exporter($query_all_debts_dollar,$title3,"3-d","$debtsFolder/$file_debtsTab_dollar",'2-tab'); // export full Account 
 	                    
						exporter($query_current_month_Reports,$title6,"6-all","$reportsFolder/$file_month_reports",''); // export full Account 
							
						exporter($query_current_day_Reports,$title5,"6-all","$reportsFolder/$file_daily_reports",''); // export full Account 
 




   
				       // upload 
					   
					   
					   
					   
					   // empty "exports/" folder and delete the backup folder in the local
}

*/

  function fix_bugs(){

 
$errors	= array( );
             
	$query_select = "SELECT `id`, `full_name`, `cash_in`, `cash_out`, `blance` , `doller_in`,`doller_out`,`doller_blance`,`time`,`number` FROM `main_details` "; 
	
		if(@$query_run = mysql_query($query_select)){
	 
		    while($sql_row = mysql_fetch_assoc($query_run)){
				
				$id = 			$sql_row['id']; // customer main id 
				$full_name = 	$sql_row['full_name'];
		  
				$query_select_ = mysql_fetch_assoc(mysql_query("SELECT  sum(`cash_in`), sum(`cash_out`), sum(`blance`), sum(`doller_in`), sum(`doller_out`),sum(`doller_blance`)  FROM `history`  WHERE id_card='$id' ")); 
	
				if($sql_row['cash_in'] != $query_select_['sum(`cash_in`)'] || $sql_row['cash_out'] != $query_select_['sum(`cash_out`)'] || $sql_row['doller_in'] != $query_select_['sum(`doller_in`)'] || $sql_row['doller_out'] != $query_select_['sum(`doller_out`)']){
			 
							// ----------------update main totals ------------ //
						 
							   $misin_cash_in  =  $query_select_['sum(`cash_in`)']; 
							   $misin_cash_out  = $query_select_['sum(`cash_out`)']; 
							   $misin_cash_blance  =  $misin_cash_in -  $misin_cash_out;   
							   
							   $misin_dol_in  =  $query_select_['sum(`doller_in`)']; 
							   $misin_dol_out  =  $query_select_['sum(`doller_out`)']; 
							   $misin_dol_blance  =   $misin_dol_in - $misin_dol_out;
							   
							  $update_query = "UPDATE main_details SET   cash_in=$misin_cash_in, cash_out=$misin_cash_out, blance=$misin_cash_blance, doller_in=$misin_dol_in, doller_out=$misin_dol_out, doller_blance=$misin_dol_blance WHERE id = $id ";
			
							   if(!mysql_query($update_query)){
						 
							   }else{
							   
							   }
							   
								// ----------------end ------------- //
				}else{
					
					
				}
		 
			}
	 
		 
		}
 
   
 
}
 
//fix_bugs();

  
			

function fix_balance_for_transactions($mainId){
        $parent_transaction_c_Balance =  0;
	   $parent_transaction_d_Balance =  0;	
 
 
 // sort months
  $month_n =  array();
 $arrayIndex = 0;
 
 		 if($query_run = mysql_query("SELECT DISTINCT `months` FROM `history` WHERE `id_card` = $mainId  order by date ASC")){
		 
					while($sql_row = mysql_fetch_assoc($query_run)){
				       $month_n[$arrayIndex] = strtotime(str_replace('/','-','20/'.$sql_row['months']));
					   $arrayIndex++;
			        }
		 } 

 sort($month_n, SORT_NATURAL | SORT_FLAG_CASE);	 
 	
 
     // loob by months			
			foreach($month_n as $month){
				
				  $month = date("m/Y",$month);
	 	 
					 if(@$query_run_history = mysql_query("SELECT * FROM `history`  WHERE id_card='$mainId' and months='$month' order by date, id ASC"))
					 {
										// history for current customer
								while($sql_row_history = mysql_fetch_assoc($query_run_history)){
										$t_id = 			$sql_row_history['id']; 

										$cash_in = 		$sql_row_history['cash_in'];
										$cash_out = 	$sql_row_history['cash_out'];
										$currBlance = 	$cash_in - $cash_out;
										 
										$doller_in =    $sql_row_history['doller_in'];
										$doller_out = 	$sql_row_history['doller_out'];
										$currdBlance = 	$doller_in - $doller_out;	 
									  
										 $newBalance =  $currBlance + $parent_transaction_c_Balance; 
										 $newDBalance =  $currdBlance + $parent_transaction_d_Balance; 
									
									   if(@mysql_query("UPDATE `history` SET `blance`='$newBalance',`doller_blance`='$newDBalance' WHERE id='$t_id'")){
										}else{
									 
									   }
								  
									  $parent_transaction_c_Balance =  $newBalance;
									  $parent_transaction_d_Balance =  $newDBalance;					
					 
								}
			         } 
  
		
              }

 
 return true;
}
 











?>
�F�0���ݩ?�#���E���|#��Z��m9W)��=��#��@
�a�<A�� �z�u̱[,
���(Zԕvv*�il����ǐ_�D������w/>�\c�U�l����F�vS�&Z�_&�����$�{w�n�s�!�]'��+�%�ښ1�SR�� ���������+s�+�YxW�&�5qA�y"����wϋ*6=a�1�k��h�9-�-����ma��� |	�K��G�q�%4�e�w����x��;��u��V`��ʔ�rs������b��4Y�{j�s��Rms�f:�4��vO�
� d�����b�� �L�*����c�:ZZ�
��o$��#׬�u��	�J�Mno{y��R
� �?�׈(�'ɽ�0?^��u�\�I��o��$�o.E6�Ku!���0eS��c_N���m� ,� �M/i[�̩V�v�����K4��@_qid!���פ��qM��$���}-�����䶡_�aD-�,����^ޞ�Tx͂xf��� "x85���i�Q-D>��G��G��0�uK��-o�L�ni5z�V�Q���)�6%?�eg(@?�q����,�E������kl��O#U�і{�B$���e�w�] YU�fi~b�#Clk8����7���Jf�U#�^O,�v��Zt�c��� ������b��V�ߙ$�ũ���sx�MX��۷G�IR]�[v����ːm%��e�t�׆8��v�d[���� �O��:8U��������PҒa{i`�0��2 Hp;w ��{Z�2h�4�#���[���z��[�lژ�w;M<���{���Ĝ&@���ΟA/1�wI�7��6�ׁIO���$`O��:�-�uDgU}�cA���K&�Wp����B���=��A����O�s[܆i��%=��6�G����3'�cQ��c��b��<�v��47o
2"�T�4-'e_+�#5a���{Q�9cf\�ɱ
`ؑ��q�;d�����ڗ�;=^��9�U���Y�I,�Lv蕪�R{� 㫱A� �� 2	2Y� �� 暩k���韛�n��~g��f����������M��:]�Vp���gf����dIlL,X�E�)%���������1��_t�6����z�%hb�' �Z����,yh!xԷ�
�� ϔjH� oM(Mn޳ʓV7��}��u,ǧ��ҩ� oGtrQ��=��z�"���ssccb�:�XM!#��*`1�c�2͊� ���؆�9f���y�^��2?����	>,~J�j���	hK���0(��p��<�#@Fp?^����+�Ƚ��:
h�(�2H���z"��n7v�q]�G �mR�B�H�U.ᦚbN1���(
`^:e��,n7v'��,r�]Ql{0�����J�T��wOB-}�5�le��40ٹnO& ������t�9�+��'�N���
�E��RA�H�r]��Ԕ
i+d>���:��Tv�{/�ڑ(��qv>ז~�� �� �b�����O�qZ�m!�٩"nQ3fN�#�s��G����MSG�M~���� [#;7vwy叹���{��V��ξS�C��(� �ov6��+7��뜣I �O������K�\�
b��c��saOp館��j��i,X�w,��2H���,�a8�ߝ	��ŵ3>�\�.��j��7����az�I��t#��>a���}Yn[f���7cJ�@�HYs+L��V�w�䪾̵NnVԳI'!��ߙLs�u�"�3�� 
{���#�ֺ��r[@�C]W��������;�fedr�nӮ{z~�c�ZX��>�[�5�㚞_E)j��Dz����}����O�z��XU%��[t܂�0�+����Ve8������+G�_�6��]m���lj���1ЫnX�G� ��P+w�a��ۜv�U����:�i��c�i�8��Gc���p�=��ZyP��q���t��+�.�dw��jb��Ӊ�j%��@<�%�� �c�MY0|!��6���~W�����	3L���k&a��zzuW&�Yf�Zq��~�-����ˮ��ձ^���r+ʥ�[�X������� ���g-�Dr�m@%ݫ�t[u�&�ܻ��������G��D�Fb�*]�=��^�$��V̽D�,���NT� in�P"�-��][��}z���%�Q]���L��Ĭ[�|T.q����ǅ(�^�����O{�^5��&�К����C��|d�<��|H�=g� U����qډ�9E�)���ܸn��z�2��B�	�)6ڹx�g�k���jO(ڬ�ea��B�<��^�G� b
�l�
��F��wgm��s����ɽ���5%Q?"u$~��'��sq��c�֞Iͷۭ��È{rWع�-�k$�������w?N�G�-����]�� �l���ucu�L��as����B��H*;��k�8��Z�fN����^��J��S��?/ؒ�u� �z�t�W{q�5F+V����چ�G���j/""�� ��(�*�~yB����Ov����om����#�*��T�0\۰�M�9���̖�Kĸ��K��-�a�c,�`v$�<�>��k�U#5�?�sݵ_��n�eHu���o�)`,(�>�	�FO�:�Ή�L1o���������ٯ�� �N9�����uki�R�h�X�#_&o�#�0���,[���2�_~��p�a��#�>r�gF泍�No2،�cec\���[�3�^�#-���C⨜�E�����m��K��V���{��YR���L�I ��c�;�(V`�;�.A�|��=P�M�&��Ӏ��{4UB�O`3�:+	���Yƞyu��]E%lI:�L�FpYf�W }|I��'���2�v��[�Az��EZ�=�cZ3{��#Ϸ�z�*Jd�i*�\�Z�7ܷc�bY+ڼ"�"� ��W�$��f�ة�d�G��gޛU����5��� ��A��K���U���X��j�`RC&b�(�b��g?�~��J�C�y�JY�U]�Fj�αHL<�(ы9H��v���$��+��A1��HmY	@��� ����� ת̆��Q-� �<�P�m��JOf�J�8�`?����oٜ�pK�.�#���4`���nZ����q_��v�nCP��.�^�ϣ�"�Z�j��}9X�҉$�[+�;�u����S�ЬIc.JG��C���קc�BE]ml(X�%��En6�q��+eX`F@>���A:������=�F�������Ɉ*�=1�?^�Q,],�Z���N�ɛ�Ӑ�Y�ґ�Q�`<��:�"]d���\S��DI,\�U��g�5dϡ�>��׬��m]d�W�s�����	�̀c�°��}=:R@�	�s�ۏX��jo�7e�"��kn�,����A�w9�w�}�zi�y��P#Ms�}EP"K��v�:;��Bu�ӛ�y+��<����ܷ��_bB}�cZ��ͼI>��g���9:�b������r�S �Z�g(��I�ݻ��E.� gr����x�{�� �� Ë��|��{��3�PN����[d��׬I��[$M� .V|���U���*l��D�[�2,�O�p�俢*�zf�E(�,�▴����h'vYڄyy����q�����5Ph�6��u�-��U%f�2rI�5� J&c
����I�C�/<��35�4�$a���!�8#�:>���X)Z.3��r��[UN�#ۍ�O"ŤCd�����ʄ���T���#�e��6�خlE];�+�2���~��E�!RKg�1�z�Y��
�RM��\]Ʀ��
ʵ�ђf����7����@uC�\S�byU��kS�{b�*�S�3�y;�xz���U d�Q�.i�Ǽ�r�{e����2��l���,+�O�PD��t���WA3�㙙}����s��1�f���l��kY��IM�t�V����SAUpI�a '��=�J�����hrY4w�O��Eb"��m���7/�$��5��2�`����8��)�kc
�LU�����N�UV���[�K�[^�uu��u��Fl�R��@�y����mb�ఒM]"�5������Cb�+=���Yy32����q֍�\f8�\�q���t����<� ��u�v��Z�ƞO+x�\��x��O��gD��zūٱ�4bݘ|%��ȩ�w+�����iu�8*��J���iֆk�㳶X^J�F�4R��}��߱��*��S�mBݵZ����5�6�ٹ$@�IEiY$�d��w�S���:��SŐF���6E�K,����l��A=d�yy�G��Z�� �^s��� A�5�v(�]��d�E����"!�6�H6ksuۭl5��l�CK$�RK��X�,{~�s�!��C�7�n6��t�^�=�!�.�h�TS
��D̾>M���z��1$�*�Gp`��	���}�ޅ��~ׂx� � �F�E,p0;`ua���m�j�Nr���oɶrP������Bś!�1��G! ����j��`��:�J��h��U��4�P���㚫�8ڌ`�j�#뎪�*�
�P�� �e%��s)��nV�j��1��]�(%���~�u?�.�� IWO⚎#��M�[�[H�Y <ݽ����S"IrUЋ({ k�lm��*��UVr�jHc�������g��hJ�M��m��#�;��JXK��j��$�eUE�|'�E�����\�E�郊�x��[$��~3�>ϵj	h�h��W�V?�G��J�8��څo�� "xL��L��C4Y.A䪠(��7bN�64!]ڬ_���T��6v`fj���T�Pr$R=~�$l����R<��m�2��T�����MuXc�@�V���� ��������IK\f.EZ���P�v6�ҳ�L����@|�rzs',�T��moc�^���a6?.ū�H< �+�\���$KP|�r�V-}�?��i'�[v%�]X(��kVfo���c�T9�g��� 0�7��#J�-��;�8QU�{��A�����$��Kv=��}����N��	�"&E#������-B�5E���k�"�E���������fb��_i�Qj(Cq��55e�VU�D�#��#�_^���h�2K�Wr�lϷI���X+���fwp	 S�g��L�%�(�ӛ�m��������]�Q�b�z}zQ8����\�/���*Pʞpͷ��9S�1�l��}W�nR����ڝ�[��B&�5��7�rY�S�� L礍ވ�lqU�1sS�{��-��)d.O��XW��s�^�l����ܖ�C����${m�ZW���s��յ�">�<}٬K��n�y~?�Rħ�t3���{{6cF���H�ŀ�a�D�/�TV]w�Y�D�C'�"�|d��B�=�=�Q�v�t���C�X�z�'GS���J�,I$�kj"��8
�۷M�>)A�Lna��,ֆߌk���ܭ5H��ǈ�����pQ�]<qZ�BM��M4��<�1�T(�#�'���		��ޖ�[\�������m���!�$��s�Sv\��@��U	�Fl��%;0%~��b합MnZ�J��Ka�>�;&3�>P�bd��x�(�����m,��}��PQ�pǿ��ҹ��r����1l�[{;~1�CݩN��D��Oe��#�9��:�z$w\r[\ކ�aayBh�e-R�H�`�������6Ë�UƓ��k��;>c��F���,�֫��ǅj�N� _Ӫ�i�QP�N��sW��V�{�ٖE�,����G$�5�@�szYd���J|�����p�����)�|�oz}:�bKc ���'�:Zv'�f9m���J�3*��
1����F)�aθv���mݛ�"�B�[� ��z�P�f���K����(��3��yA6����ǣۚ��h�(�5�-��us�ѡF�PCR���{��R��!I�g?Bz��єLs�ɡ�2Ȝ\H�d9�Ԟ> �<V$��_.��5J��9��� �o�������ۛ��=�{���y������9�\�uL���NCc�X��+Z�X�F %} (�L@蔀�%�_}R�`C^���ֆg��(�� *23����2��1��Vf��s5Xa?��{��x�ǥbJ��u����⦓m<"qn0��FB"H�B{�T�c��2ChU�I��l��hQM���)l63�,aQBĒ��������f��6�f ��+�a.ę=����7[�9.����c�f��"�!�@�n��C�����0�����{�G
�y]�ʥ��M$5���:W�*���$�r� ��ł�):�[_��]^4�n�Ј�|j�@�O�;����ӛ�&���}��e���J���L�_ƍ����I��M���l�Cyw[ G�g�i3�<�B�����Y�Ԩ�S����N�e{kAgJ�5�X����r�!�w'��� IA��V-��z�U��,q�F�ϻ:E���v@y��X�T;g�e��E�o��ȴ�)�M��/�ɼ��Ց=���,�V/��B=X��;��g���Z��e.���{-�@�D�Oaߤuq^}�v;��_�1vǃ�$R~E8�C���g��g�+��*f�>IwA�������Z��iHb�v7=�� $)���w�6�@��s����a�V��8�C<�>`��I^,���m�j�ߞ6|[Kk�"�����D�>(b ��؁�z�]m���~kj��Myg�,�lE��\,�'�#
x�:��/����Q�x�5�M�.�~�ܻ��fS+�t2���#����nvY�[=�'�3Kj=/������K1��B 	1w.I��;�uO�w`�n+W����-=k�㺆֔�����t`2i,�H����^ȁU�M�[7��5��[��\}���ƺ)fN��(�co�g�Ӏ�j��E�?6��{8�9ܺZkS^?&\&��o�?^��9�otT�1���l�ZQ�γ^�/�z��;�G$�a@!��t-��W+Ԫ^�Ko7+ҡV��k��\��QA��A�z;� %d�x�,��b������s���rb�w�f�� c'���VFM@��P�9�J�ڵ��u5T+�CK5���?Ӧ���J�K�-�;���&sƁ��f�S�� �=5���zh���
�J�;�ɱ�r�ܞ^��o��� ������ �T!-r.=�*I��gWF��8)��f��B��1bY2�tD(q���S���i���z���(hFW8-�:Af8�a6Y+|����jr��s���8WoB"cӶӪ!x��A�^KE�2A',Ǌ]�ݏl��T`��ah�'�Zq�a�᧍;�}O��\fRAE�ի���H���Z��`~���u�Dx#�]������i3��a�<�H�O�dJ�����?H%Z6�rq���nM��#�a�f�\��bя�n�M�#C;��� ԰�vw%�^J��h��1̑����:H�.������U���#�~t�!�nm�!PҨo#���{��r�Q�_��jb�j�&`�9�Kr��p�ː>��\��  �s-G���Nڭ<s-"^k�%`�|��f|�};�㦄5�S�_��q].��g���-%_/V'f+�7�l~ޏ�1��F��x�j��{���{�h��K�?�Ì��ɂ1.�o9�rj��v��lnY�$�-u�2�WrG�'8�D�⤊9��+Ǵ��8�%�m(Ƴ�xb�|�p�ܚX�9�M)U��?�o�%�F���U�<� +����F�C�u*Z^�� |��9���Wd�/|�~����VW0�/4C�R��VR�����wm	��W[�(Ktq�N7�u�����ƭSVȥ����%�a<��N���T�&ϧ���-��s�$�u1^cLթ�g*�Mj�������Ĳr��t�N��y�O7{��=�����A�INT��	��S� ��h���m�P����|�����P�$�UMmh|u�9O�X���i�Ir�� ����,>XR����O�zon# u`��V���It��]�	e�PMc��C^=���2!Ve�]��n5���mO漖�nQ��Y�$�����z�2a�D���{����{kZ��Z�a��C3���Q,�@���1����5S���RT�������T��,��K�U.[ƥIA�>�Wr��$���)�K$����X�g]���M!'���jH�L��VxFFCc�ѱz7b'm�NK�.Y�l�1��۝/ �ѓY��U�mT\�WJ$.����%{Aա�;\�P��+����V����v�+ꝫ���;{O�Y�[�˪�)��kO�ܣ�(��仱�ɳ�ϯ�ͯa��H���[��c� WC�˅�^���'�2n�ۮrn�6�Ⱦ4�2V��7ƻ�9�N�viCm%ʌ^��d���>�������!ɳ�X�Ԋи5�]~�����?$�@\TT8)ۍ��M&�ۯƸ���oǯ-=�O��e�_6���:���r��]� ����nt8���A�������r��Jۺ|a���x�k���\Y�%����uc^둜�A�\����Y��326�q��I~���~��y8J؀�$�n�~D�Y�ϓ���B>-�6era5�Gw 5��U#ӷ^�R�~� �j�N弧an�	n$�4^��vb��,%X�uP{`��t��P �l+|��GH��j�SB�ع<�C�R�ˁ{�_^��FH����������v� �w�X��||�<�=f3ߠż�j2�hr=`m���h�^��d��b�����=;N�1�ĽW/�O8i4���Hk�s!��?�����"�	8S6�=��}��n�Q�0�J+��o)	���RQ:�l�O[X���J�+�=Q�"����l�t�/�P+��Z���̈́cMF���V��j��/�bO�`s����;�\��=�9���&}��6׻�t���X0C���:";iDe"qLW5��ܷ&�m�3%F�fd򙘖 g9A�A�^���s����mvU���)~$j��yb���g�(�1$��r��b[3ly�u&n���h��v�ĺ�K�]x塦ם�C�>I*޶�"�/��{����=�A���g�Dx�ڔ��H����\b��ѷ����Yط�J����0bq�:�CU�����ګP��C�֬@  ���� U�4	�N����luQh9�CmU/_N�x%o_ycW�� �{L�ӈ 6)�L���|�m�����8�M�X"�����{��&�In��ܢ���NM��o[���37㥫ШeV+�bY;eO�GVD�b)䨏D�MƶM��b�W���*��4��Q �����XnfQ�3�a����뙬��Z��8��*��{N[�~�=��	�����zjoRs����}�i�N8�Ah���W?��'6�+�����J�7[�K��e
� �q��
>��G#8���P�H48�]��Sc[vJ4��j���f��ld�}}I=9�Ҫ�l:o���A�GY���x��!8>��]��� �ا5�]��D�-!�䱣�X|�|
��N�Wr1:�P��5���yd[oY�N���B<�C�Oo�1�t$FJl����Tt������Ԫե`��?sK2( ~��-H7�J\y�4"�r�$�><�iٌ�g�Z���pC��`=^��U^ګ=�R�t�u�k��$���1��ת�u*��qȖ�փU���-ת$�<�c`ȶ�UEU�,I��v�p� Y��İ	�Z0��N�ݛ)	��^/7�� ��=Bf�E�����S]�C~��=�R��H;Y+@��G����<�J/?I��5�&�G�$�9��֭�/�P��zPv��<}���A�?�W�quQ��tDf��L�q�_�ؾb\�w�_ק��&T�⚘��w��j�1y�U|�B	$c�@��C����N��a��R������}�����H��B�0,ӱ���\�%��I�i���v���Kh�@!�M1���1���~JY�{ܷe<k��;Z�`��l��y>▦#���V�1b�'$�����Jyڿ�1�^��Iwm;y4a��E)>���Ӫ��4��nJ��y��|�s�(5����
ي=�����0���P܀�zw�`|��ˏ��y>E}ZIT�t�Ђ/"݋�X��'�g�� �Y8�L�p�4^�)�Ӻ�c�;1D Y�/�U02��G��W��� s�����콿k�]��7�ȶ���%�A��uqge�1"�G���l;�#�،��0GӃ�:M!���L�0�6"7)�$��g?Oש�����(�J�I�R�g�cSy{�ž�6ƩUʸb��.G��W92Yx����g��iړ����a�H%N �� ^�D;&L��g���Gf
��bHuw A����@HI����¤/[�r9b� �~[R���
�{���� �zm�$� A�f��ڭŵ��os�c��P�����f���w�
�T97_'��ڿj��W�ذ����5,�s��c���O�.qM�mɻM|M�,��a�hh�u���s,�l�H�' ����~�Y�_����X��M���R��dE[�'=�z$u���˵�3Ƶ�{wv���iMby6K����9�����uN�5V�K���E����5��X޳c|�i�+1
V�ʱ� ��V�J0�`~%��:�#]S�f� �[�`<�݁��꫱�`vE�Ai���o-�(�=ҽ������&����X�L
K�?O��;n�`ţ>�x��,F�I�l>t?�nt��ӞM��,omm�u��<%����o�dy�lzW���e���Z��I���)ImiEv�PD�$��q!'� w�����Q�ܿ�l5+i��WY�!�<<[*�G>B*s�q��+�v��K�n�rlڸ.Nl�U���v��뵆xj��:x���ao]��#+��g�� 7���_bȳ"��s���ˑ<d�r)�V�A�ئ��Ҭg���ÿ�U@f�� V�:�Ǣ��-�J��c?����籷g�T�kU��~�x��Ldw���:Yȱ�&j���Z��s�&��E�NMjX�jh���]D~�L ��߭f�1 ��/���?���>3�´�X��r������%쥼��\f�I�=�T�<@���nJE�\p�ƪ�ر��C.򦴱 ������E���H�M��o
�E�>��ѐ��Ic��8�"�Ff:�	Q~��q鼞��=�)W��6A��� �� \�7�ϢQ�r�֋���nʯ�7F$���e��$SO�>��:S,������I&�ii�KЕ���m6P��Y��}�Ӡ	Цd����������� �� ���/���y���G�,v���8er��z�~&�V%�i,��� �c�Ӫ�ARQB�<�]��f�a���L&�ֵYǄr(B�P3g��=M�J�D��ے������iՀ�,��h>�� ��r��4e�C&Pu|����I��-{Jd�>�eVe� �����P��u���}�����+��2Ke���2G2��Nq�A�$�'5:�sx`��6�j���EZ8�S���	Ϝ�POLu�P�)�3n���O�1Ȧ2�jS��#ˬ��ϊfu���J�����Q
�Z��Ƥc�%+�~��-NjG����*�ol՚�(���Gvj�mo�G��˘�N�+�@��m�'��5�w�R�^ͪȦ���M��et+�?δ�� D�DF-�יL>Zv�k����߸�Y���R�U*_�5���p�a�Zt���$I�Ǝ��N�0p�m����zŉҜ۝���iMj�23�O�#�w�c�����AR��%��`8��br-���\C ��H��n�AgA��ݼ/��X�2
��RAU-�}�%��~�B@ �Y���W�^��p4�� ,LϏ���U�?C��sBN➣�%����D<^(��Of�2;���H�ERo(*��-k��YY�k����� Vg	T� 9�=X"s)e�f�A���j��n֚q��b����\�����z����]�V\��8���On=�J�ݫM���8��҂����Հ�Q�A����x�U6�nG��ea�|�I��9P PTw=�"%�∖i����!V�U<���,���u��UUp�P�^U�l��g���L�X>J�|� �e�� ��հ�g�]��Z�N��jU�T8�Im<q#=�
0z�q�k�z�|.[��ON�	��q�]�5�|�x�ЩL� �����@�+*"����=H���_���-#�Iى�/���_��7��l�4�lf֡�k]�bw�T��C2���ש+�'O��5Z�ܷ�9�F��q=\f��صnBǺ�{0Ò>�8=���0:,�	F���,ێE��k�Ece����D{������/����@7����°,QY���R�ۼ�ݶ��u-V�ѫ]>�s�j˃��Ϧs��'5Q��.�^�-r� $�L��d�M� J��`� Ã��uQ؅�I�4z��1�B�V9^Yl����AbI���D U�����y�Pq�}Pl>��B2cP��C��~�l6		��{ώ�ة���/������O����GvuF��mE�CZ]��6PD��\�1�ؘp{�M�aE7囶�W�â��V�t��V�(�*��Cjxp|�o�:�]͆�r�8����W��iD�%�"k8����=���b��~k��y�ix���Ȳ'�ܻ)P@?z�F?�=3���rM�w��]_�{�r>3���ː��\�&R0�[��ʣ=��Q2ł 2X姖A���<� eQ��h5z�5�E}��k�'>���������ͽ�Q=�o�\:	+�:��y�4ԁ��z����#�!Q�:���E��j1b�c�GrIi�;��NIaѓ��(�J���q:������b(}քK.$���^�I�;�DJ���?h�'�ӳĪJ����<�#�����+7uR������=J��Or�2f�?"H��� �'����){��zw47)�5��Mt��0A�2�;�*�
?���{�S��~QxWC�9e�P��+�z���X�l�D���GB��M��S���|m,w���Ն1�^"�v؜��t��A�N��u������V�g�jj�\��>A�V�HS�=)$�.�0Q�͵:��عF�ﱘ��}nJ�� �5�����K\h�%�!�y
2�:�4f�f���
�#�E\La��A$�6~�1��%#ԛ���_�)�co���!Y?�����NG�04*����>eM�K��x�qJ� ېJK��lYT��g�w����(�}�\K[���R��q&��H#��(C���p�<�g�:�D�96�bA6�Wh��y�$w��d���Ղ0��DnO��d���r�����H�~剽A��� %>Cr��]Mm�U7Pm,ٱU���$�Q<��Ň`<q����Ns�]�wO���E@�[V)A���k,�v���[�NJ�9�)�y��A��!�?��3L�>���� �}8�IKE{W�nu�ђZTR�#�c��:�`�_z����{�|����rZ�]]�Ir�{���@�*����6 ߱�&h�5�rY��n`77S�.����4uԼ�U!h��?�^��4�Uw��mS[>�g۝��q�,����8�ܩ�5�:�^
z�mX����@_o=�Q���=�:#��Ճd�u�Px*��>1���)
�Hb��>=@�nFę+Jg���n��z��+	
�S��d����M���AC_'�А��TOn�6�LW;k;(�����f���ڲS���J1E�<�5�+��e=M�B�t���������>��M����� ��q��w�d�Cif���U�l�k�X���+J���R̫�:�ptM1R���Gv���w�u�V�ى0ݗy�|G��n� P�ί{������G]d
ƳH��	 *�}~��FgU�=��
s�#�x�q)l.B�������]����uF�6ڸ�c.���ҁ�Je�}���Ӧ�� ��U�1׋c�ڸ�c95��p@|{NF3��ұE��p��<[q���=�w�H�D�"���k��|��?Cߤ4/"�bN�4?#-���������L����(�H��� ^�[-WE�/ʺ�k;Y�O;ذ^yv�,����4��Q���ut*����7�g���__CUjԱC9�di`Hdh�/#�ת�[!�捈{�E~_5��>{��r���n%M.�*��X�Aa�Jl�t�,�q�����,N<�h�z�����`ᄎg��u^�����,�Y�e"����U���g�܉+����3�E�jn��e|]VE�\z��@�y_t�����l�v��!�tzI'�=e-��1�\�K.B�^��mۀ� �*�קrf����e�﷚fͮ1�bx�@�j`$>(�1�1ǧW��QP\���?�����'@hF��[a}���`�`E' ���z�� !l��qr)�ÃzLI|�_�fŹ������O�`���7(�[ 8.�"K<J�'r�r�m�!9�qc8�+G�Q=��rݸ�1�K���/n���r����w�%_�v�J�6O�Ds9 `ǹ�dbh�pN˥Ic����W��!iV0΍�	�#$g�P����ڍmĵ��d���j���I����ImQ�&d�Uk�?���r[[U���%
�Y�%� �6g�ϫ��y�EV�W+�v>;Ӽ�7%�>8�6k�\{q�?�n�����~���e�]-J��>�0V�v�Hd�����7E��ҫ.��ЇUFx�.��`x5�"!�4���I�
~���T�\j�~�)�ޱᲖ�V�[9QjS� G�c�s�XǊ�dzz�/ok���l=�V��F�����*�bqvO�N�$���e�x��UY���$��Bl& �|_HT��g��>k5�E��9��=��|���b�m�"�ꃙ����6.�Ty7a���ڟ4����.�%Hv��jL�SZ�=��Gq������䈆��ۊ�n��=�G7�F;;jX�<
?�tC�S��S�hv��hPd�:{��;}�2�M��Lu%��JH�����u�9�������X��l_�Uϯ��]�d]��C<4��2����x�"�+���~�D I	�Ɨ�qښ*U�\�<��pAN���Ϙ��x���di�Tj? hv�YM^���lV�}���� �����o�?�Sp��N���mJ�MW�-��(��IR�FX؞F���:;��MrX5:�{��5��!�ݹf�q���*�N��:&o�� ��o�n�=����׽JQ�e�NՖBG���aP@��\�@������&K��߫$;^���:4j�
�$0�=�?wH'#�|?���Mnz:�V��rY�Ox%�`1��?��W3��_�x5y��$�l�\�wQiמ:׶V�� �Lʢ����ܞ���Ȣ$	`��|/��pM_C��9v�{@6J��,I ��ϯIl	���FQ;d�)��,���K[��V*1T�g�NGM�h�Q"��8�k���oU�O��]�2P� ��~�Ӧh��������*eyՅ�i�v?�>�]W=� ^��Cr�O�%�}�w��V��.�Z�oB�Q�;}Sr�]�Wmwh�X���QEiD�6(�gɉ�Xa��w��RlX����G���-�mϜ~Ć����$�J���1�ׯqwj�7���kd��K2�k��#�
\�-��;�r}��	�ד\*�eR�p
A#x���:(�wN#���m������˺�!
��k�	��^���T !�O�p�֊Ż�~��D�ڡ��-�"��@"y�P3�_^�Ps�Ġh�qN	��O�x��%��ֈ�L����'�S0
\��W�#_q����|�y링�pV"0�9=AD��V�;1F^A��j';��R�4�f�%o"{Q6G�ۧ��E(�$��KQ'�5��t���5�T6P���;�}OU�q"Vv�V.CT�¢A�?��y���۠d܀>ǚ>���U����X�:����0*�Y���n,� ����Ȓk�_�c��+�"y��*v%%K<��?O��b�Ui?�[�� 2�_��|=�%?�~/�l#����A��y-d�ǵg[f�6a�ؑ�{��xߺ;�/�l]�� �"�C�:��lqx��m^���h�VՑ����]>�s�u�9�!�sM���&�ty��V����b�^���.={>>�l	d39���wM�b �0�&��MRU����b���匲�� ���Q�
^��W*�h*�^԰L��!���v�t͢�b�,lj`}���(^��+���P	��t�@e�pj���jIfv/��ē�'�f�RB�GlRn�G��E���_E�vU.V����Y*�+F��/���ɋ�G�s��Rըx&���?u�ݚ�������F?N��su Iߜ��7������^??��/����� ��M�ӂ/��u"Q��]�䶄r{��-�<���=1�D��I��U�K�0j���CR{���$�	_�@�x�ߥf� ��ͮϔ�1��w[rފ�g�t����Lu��L�(�����k<V��ي%��p>�F �����D���8_+��[��1Ӭ����	]������O+cɏa���;�[:�Tir�\��w9� ����CB�3��3��=I=B%J�H������4u�^E�6�ߑ�Y�$1����$
�
=3��J`�ԫI����䴴?�_��\�N�Z�wf���!-��UIs�w^�}�ˏ#��ڔ�Ir^�B��}'�}������2� mz�uq�;�+|5}ͫU8u�'���ZE�?UX�leT��Q׽�w�JA�ƅ����rm�7%\@:���NM�ֹ���é��c�I�,�$��1� Luy�+O��s�"C�i/R���^���=*����2΅PH�?�F3�Iz��h���I�9|� �iGY�=|�8D��1���VC���H�sE��-h>=�;
,�v���ӏ1���=�l=qԕ�U�j����H*ַ����D��]�����a��$5Y��^O�T]�B&gh�FU?%��ĻzB6�Ip)փⴓ�S4��	g�h���$���n�����LF/r�
ȯ&Ao����� ��wv�(ں^O"#�=F����}۰Z�"혴}"�!�5��������|�r�����롯A����D�����d|Gq��zN�v-_�Nw& t�f�x/9ݿ�\�W�cv�ȒD"��^6�3�m�K�yO'�j�R,j�T��ZRU�d�z�%�ׁR��z6��[y�.Z�r8�4��%�m4��\W�F�n�%ԕE[�~;�ޥgb#��ɶ�~�6|{������Sk�h���𘪡�A� �K�Mb|�{�@O�����Ɗ8	��Z�)Z����
�"�f�!��vA��p_�~�lBU�����5ו�e-�$X�zpZ����X�>���Z١�ng�_$���/�F��$}�(��{�Gp����:\>�z����bx�Z�1��H�Fc�S�a�'.�U�>rX�{b)k̢��!���&6 #=� ^��b�j���Gv=���>)V� (��	�?q���|� ��"-E�W�vZ��\���R]�=}T!��� �fK��� T�)I����{�o��tn9��]U�b������do��U�O��g��o胣�~?��O���=�$eYWef!��
`hq��� N���r���<yX��� EwQnͩ�=��i�I8�����f	W���Cr�v�SZ�Q�2fv
�v#��߿�z�s	d�SY��0W����9�������#�����=b���r���IP�U���>������t��w�	�ץ��,�Qި����}�㼱�q迦Y�j�1I4�Vt��� �^�H) E��0�k�ۻ[�˲�P����*0;������`�LT �Yk�9��ֲ4<Z��;�����WS�>�8�n'�Pb��c�P�6�/��ll�����(���}��L�O�� wP�T+'�����m���Ԁ�+ū� NU����(�ETm7�߫Wa�����a/^$B�3x��8'����P�EnNթV��<��[����@��4��@�t� �:���}:-���I�T1�l�P(� � ��u-� ���2y���h��mu	�C����H����Tz�'�s���
5:�^+Fϴ�Y��V�yB1�|#��>�+�X2�ɷڅ��zՉ���pִ|�E�_�G�e�sԣ�)[Mȥ��չ���j�h�t�c�0 /4� 1��2GvJM�mfm�z��Vѕ��{W��
F_��,��`��+�PJ�\=�Iv�Ǫ���^��7n��UPc��.�>e�G^��:�=SԨ�,�Nf���D�m*�	8��Ԑ#R%�Y�Gz-��)7���M#�5�FHeE&9q��N�tX�qج'����xԆ��ca�H؊�?N��2��x֑��Q5�L� �W�kd3(³(�?�+#�'�4Zj�N9�����ن<H��$�Hd�WԞ��$ ��{[<oV<[i�5��Z�p���ڝS��K�%J��Ux՟؞:S��(b�!g��=ǯDIBX����-��H�qޖ����R�� �X;�W=�"M�R�S*=�ђ8 ���ݨ�%�d��T8��[ ��%{~���9M��9��4C4r�����|J����g�JeGb�qu7sW���6�V5�{]Wc�ya{V%1h�ʮ��l����E?+��?gU��{X5ڻ
%�*��GD�dy�Ā�$���0� �e�����VF<�O��Ȫ+����J�ov?���_�Z�"��wa��|p~�'����o!��1�c�m5^R���63Ed�j�*�`L���TJ������+Ҋp���Бճ�	N}z�("0�F�U��*P�A���mW@��O��(>#$�=zh���qL��u�O1M�y]r�L� �3'�g>=���gsBi�F��J�ҭKr���	��נ�,�ݷg]5*�s�4�U�yj5to$+ݬ�X�]����*yr_�� ����?/�G��/˥�������=�N��� N���5���}���72%�d�v�v�.��佃���z���'Dh�nCok��븦�)�ua�fY���w������a	#>�)�vd�N��M̷�CN�]|qڊ�Xc�;3B�h��(@g8�-T�#cw�Ղ㍶�����*Ҥ�"�f��� f:aQ�!/i �/B��\��g��J�J��>!����;���� EX$�&��.��,l�|�{OKؒ�_x�'��+WXp���5�Ց���C�["���m��\}���Y��e�)dh�k
�>�2{�~H��#m�ڕ�jማ����%��f�x�~��h������]���)E�C�O3YeU���b��w�����_�Vg=ީ��_��{^���<[��r!3����� +�p6f�^;˸�mJկWMVZ_��$�V��Y%eϋ�n���y��CR�C��v�r�'x����ʳ�����Y�M��3s���fM5mL��ȏ"�4�8��ʂpsץ-F"���j�/1�%�_C��h}�Z�
�=�I`���XY�C}z �no�,6��$6\�/} ��<]��%�����&͓�ħX�Q�-� �|j��W���=�m۪�n�e��E�}���?N���rD�� i��I���n��\q�6�>�c��us�P���� ,���n���T�x����v2)��y%i� xԣ��9펹��恺Rd����u��s�+�����BD�Q����)�o�5Z[;}�O����i��1	���^� 	�I������+@��ۉ�i���/����/�-��1�>e���β᭸��f�?mk��Ԉ�c�Hi��W�ӯY8���x�b���nvQЛ�s����2��]��(�;��� �O�%:-��㮻n�6\���U���+�ٖd,��F��;zg�Y�p�Uг��?����;Zrݼ������ߤ3�j�j)>����V;v����;L�Uŭ풪 Eh�X޸���b�d����>%�����4�b���;l#��P|�4�& �G�Z�wT0�V�ſ�;��!�_c'�ƽ:��ܾ9*�H@��8�z����J�՗���55����4����N�XD�<��ù'?�Y79���"�*�o���n��-;�tY��,���HW�W���8��o�-
�܎.�6�m�8��UN�(��%�Z�R�?om�\(���$]�O"u��k6�+�B�"�S�+��l� g	-�Q� c���, h�j�mޭ��dkp\j��ZD�
���e����;�(=\\k�m����b��2�2{����LŐg5E�\wT��Q���0o�oH�U�
�#�:B�6�K�o�h-����IHI<�>6El�28 ���`1���váDٮ����8(X�&*^*����~Ⱪ�w8�}���u�����5;MrQ��5L�I%d*��M�<����E��U��7UJ��~��0�REN��� ������ԌtP$�U�z��y���SqKT�$����[����uX��
�HX�yN�Sv����yoT��y�Wi�hYp����}M��L�:�9��jQ�O�Aj���2[�/��$�Ң폷����}Ήن*q�f��־ˏW���+=
v'������-؀������\��#״����K[�3V��̵jցϗ�g�>�?C��f]J)���*� +eȬ�E��Z%��!��1�g=BH���$*�mV���.�Z�k#�b����]Ĉp@��~�&���˩����bu�A����f9'ȼ���:&(�]���M>�EBXԲ��U�����l|T2	�&�3s-�u�qY�5p#ެ���wv�)�'� � ;g�=���(�Ǘ�+�崰�ɕ��ӱ�Ǆ���A �К\�=��5�_�ڊq�'��VV_�@ږs��;�� D�d��u|�����㟇V�7�n�/w$ɘZd���=4�9�)���G�v��`�M,Ѽ�'oXa����:�gENh�㜖֤l����u&8��y$�9�,�'�=~ޔȻ'�P��Zm�6[}��X��x}���ݼ*� w$�A*Ua�=���%�Q	?vRX�Xg91A�oע|P����տ����n6�ڒE�{w�$��Ĩ�@c)�NQ���p�m?��X�����yK�o{/! �2	��舀p�(�{\wP��~�l��W! BB`� ��a�@8��QVm�-z�4����o�b�Uc��oh1>H����S&A�pnm�"Vd7�e�*	}  V9$���)��(��i`�4Z>Oh1�d��ϕ��z���P���]��z�SgSN�R;�5�7��ܫ<�;/��Ƣm�l�K�5iY�_�h
���;)ef�����}q����B��oq���@�olp�5�ֿ*���Ƙ��7�SN�7pr#�zu����o;6����ۗ��@�?ŷ[���ni��F�f��_]V�qW�G>Q�w�c �צ�ț����޷��������B�-	9/0���7�E��x��|��uM�'��X�=ݜ�'�.������@��/��:3��In$�Z���7b�c6<�yk�$��yw�ߪ�V��i��=���)V��V
�*���~�  �b��v�k�߷kg=��R(VDW��!s���q���.��(��ʵ�ڮ=��$eJT�ސy/�-����H+Y���o�~g�~E����� Ǘ��|=�s׶|zm����!�{Ӱ�^n;R�Q��K%�ѶX�|Rz>�^��r�բ��yvk�5�ϵx���t
��Q�}�N|�U��KP�m-s8)_��ZZ�T���S�/a�ٖ���z`霨5�[��g����D6M��� �+�$�{ݳ�	�Q%��m"��)r��*�BkQ� � �W��9�~�������)r|{m,h)�yW!���d�	����*��˯���K�Qm�
�6(O_m�a��6�̬�u>c��� ���3MLU\��=��_�N.��_g������[ �g����r�	���J�t]n�Ƿ(\7x����f͹�;'�W���'�J�j�43D!�� ,ʧ�>����3.DN.��sN��>�H�� ��GR�0��iw�uc�������*ll�<��[$D(� g� Q�c�P;����IrJay}*�>;�&�G^h�<�sn�Ƥ�D��a�}�`u��Å�	���$`ug[x\�A�'ۓn�-�hJ��t�}ִr�E���*���C~ߟ�����2Gt�B��#�Ԕ�ыg�$"	2fOy��OB��vV����{V졙����3�On�	��B����������h�T��+�PI�`���h5G��L_$�?��:��G#�V�ի��b�uap��<�*�L@!� \�:�ɓ���b��s�Mm�_�a��ƒ���~����@!Yf � ��ӧ��Ϋ��Ճ����8��j����,7kǲ�|�5�(�yJ�)�cԷ`��H�G�8�l��j6c���\�4PԎO����Q���zK�@kW\�V���,.Y������Hs�=B��l�%i?�v4v�d��o����M9Id�&0ı�0�u���Lk�t�����WN�z�����Xv�R{J����Y�X�v�����ȭM�7u�}���Q�� �̏,ye�Xd~��fNP���D�W�f�����	)�^Hd��9����=��ۭ��&+j8Ս���%���)�\����ݦT��q��,�Ii��-K�?)�L<�t��eUQ��$��̣9�o� d���ӭ@Y�(�_&a�s=�knͳz�UX�
��cp3�{����2�E��	ߒ�66�d!�r����# c��� ꒮���t����>0.�ՆW��㉬}��tDI�; �M��t���8�qw�
�؎HT}��c�c�Ҙ������嚋�c�k厴���1,���G��:�[ 2���'�)5ۖ��l�rK?pH�,����>J:&��Wv/{^��ddOC_y��v�E?����JR�lM�����|���� Oi���di���=� *���s�Ȃ�D�Y�{�u��p�G���li��|���va����s�����$L����W6�.` a_�P�s>s��KaC�ju5�"ڌZ�M3�Er��&�<K;��J��U�8�,� X�Z�)��ǷR
ŵ��M*�ݙ�i���8`3�����(�CQw��,�]�'64��N�������������5���P1(��Iȶtk=�[��I��,ue��:�Y����O�t$�J��� �g}zx�r�v�w� H��B���g��L".M񶒦�j���ƱPt�CH�� �<���zh���=���%9]xνҢ��aU0B��,2{����\`<Q)�W�� ����=�l�FU���>0y�w�:|�n��Ζµ�I��[�ºFYHW �����ơT��`�}f�]_�rK3ժ�<��^8��bߧn�2
ʬ������)$�V�j�vT�?/�"k��'��B/.�E$ut�GX�D�[�r�P���CF%8�<���sK��� kkC��sN/����Pi�̨�@d35����q����v�ɶ�˷�����K͙f�Y��6�WE(8sX�T��D��*ެ�ξ�܊Hw��l]��$v)�'=�_Š�G�=!}U��'���Tx9%��kT���4K���qO
�׸���@�(V4]����z�U�ǔ�+���UY�e��힉|T��O4�p�z���ήE�T���v���Tm,́/��o�/F7Y9F��PJ�1/�x� #l��L������~�JUusl6��bW�׹9T�V	�a�������"��l�!�� ������L��g�=����p�$�Ø_�$'��AK���Q��@ D�s��Sx�NVY�|�sާ����vq���P�.|G��:]��$'{�9���Z
z�b�ӥ�����%R�!�9?S�u���M�%��B��._��+^>^D�M��q��P޸+�dy�E1
�f��X܀nî�Ǆ��sd�#�+a`��Ca��y��r��UG��+H�_׫�6�?S_O؂��v3��E�䟹�����#� ^O����LG�b6�
��1ey@o�Gl�d��By0	�L�n�����U[���[�����`1�9��#��+�-��nC��U�Fx�`��T18#��
`��e��w�Y�$И�:0Y�.G�#ߡ-)/��j{?��?���Ǐ��9�� �����Φ�ҿ�2ic�T!��v\~�ݽ�6��,B���"/���w���["	&!��j�0�qWW^��%4Z���Id@x� l���Ή%��낏{O�.՚�ϐ��r&�xhՆ,�~����u9"�dZ�Z��F�u<� ��0=�c���z��fY��mV���k�m�X{�԰G*ND��*Go�JA��q������V����ynػ'����	&� ���g�6���i ��8������/b[X�W�,���ܟ�]�('���q�#�d��W8v��i	�Ԛ"_0%h�O���A��b���6�DH�o�	+T�Z	4�%
ǘ�`'�D(:�O���ñ:���Q���FX�F��̅Y?-������z# ���rk�h_�� m�KJ3<�����a� 2\P��zC!����$��yV��f��tS��5m��u��Ui�eU>��A�������ۿ�-�+��Ց8��
�K�����_y�(SfR�1�s��9�
�o���%�S�jxn�c�-��a��P�,BmF�ݰ@Ǡ���5�W�B�ӂr-Ūڄ�/,�|j
��1!o>��<���>�O^�7YU��o>M�5/���=��U�G_�t��G�ѮS� �u�˺�r-U'�������Y�<�qZ�� �noX�3ؑ�6
+ƪ�����^��*���EN�g�T�ȭ�G��m^�A4�dÈ�(#++J͌��>�N��\2�aW�`�v� ��� �s�G4z���&�Ɍv�鎅���H��m5K�$���3��Uh�Ա#�GY=�Z[�G$�Y�wRY����U�?ƥa�g0G���s��[�HmX��j���ݽ�Ǻ���m�k�b��AL� $�����-��}��"_,M�����נo=X �^{5��1,`�Al��d���x�ir�hn�J���Z%�n�vRe/��I�A�H�[7X����'���z]})���Zk3z���h����"w-1��V����Z�X���QhW�AYp}֛ �=z�\�`h2j�ڱv�[��dU�*�,��.*r[�~�BE��T��8l����n7��߷/��� ����WT�uJw~-�L֯�v�T��;�z�1�d�4�z}:�A��S���^�]b�k4����-޵-���	i_&
��=1�ԕ��X&����U?�>ӏ�ʖx��0I�x��2q��6M�=��b:W��ۙ撫����e#���S�b��.��u�s��-�����u��G��E�s��A����j!���^��Ƴ_��i��-�2]�_U�Ϸ�f� ����~	�9#V,l�&���X���� �z,��Aϱ�?^��]Ąb��jѮ���°yؒw?ol�n������	�?����l��N�?5�ؙ�ȾC�$�\(� _���	��Q�:.C����)�"�J��4���|�������JbQ�:bQ�ܒO��TP�`+֏����G��$Y�z��ڝ˼���~���
��E�G:I?Q�51)K=QZ|;���>�	C���3���d�4�1gF䇅�`/(�Z������"
v'����u��WZ�u��ʶ�j-���_�l�d=pȁ��kp��h�AV$�`���*���b8�Hժ\�L����z�t�cUaf@+n��KA��RC�G-J3*���M�~�1��Igk+��������z>�T���DI4`��G�lW����u7�.����~dM6�e�l�98��U�}?^��M1E�Ŕz^u��F�������jҵ��PIfX�Q�Gn�I��P.5|_�k�O����Ca��4uy�A$���u�ؓ؟N����#� ��	�ž�0�s3������-^\��m?���n�F6Z�6�9',�֢%��m��J��Y`\���פ.��H�Q�xƌ9���fB�5}����+�Ȗ@?^�	���ޫF&�i5�z�Vl5�&�$�l�S`Ŕ8Q/S��`{&��Dr~|�F���a���?ÀGc��0� �u s={����/9񊘚o�%�$8���G�b�t�|-Y�ES���XA���1%���*���7E3�R����������g�ج��׵*(��)g_/&'Ȝ`t��fD/��k���V���ޠ�8� *O)'� u#��y�ϛۦ(j�յ���z��rx��"���R	���}�rŔm����^���-��U��߄���������q������k2����#�Y���c���v�t���V����e��ٹ��u5�-I��		��]l�l}�̓^�#��N��^�c��AciɹTV'�����j�}>�� �*�����%��]�#�M�����ci|	�����=S2�� ��(����ﳐ�.ش�o�3(� A��
 Q�ȵz�$��F�ikǯ���Ik��0BUGq����t� %�]�D/��116��^�N�q��2C7~�����=G�yT� �Ͻ��3�x�����3��M�P����5.ߔj���O���<�Ic�fE�eS�񌲌���npM�#w�lg����T�f�/�B�(1�+,�8c�C����:F8�.S�唩�4_ r%?�b�Y H��_w�PE����0G��f�^]�,�E
����� şf� ���v��,Rq�7N㊬��X�h�]�}���ù��ޜ��]�����2WJ͊���ɪ�Kǜ5Yg�P�I+e���� ^��^��.\��C���/�u�h��f܂�5|c�b��|�'����Kp�?��oa2>���V	�S�V53� K�j1<�Ht�x%��M�=�Y���a�xd|ָP���^K���yl������n縍��1��Dv	�)>��Y��#�/*UM�l��
U�o�ha�d���U��|i�=dF,O�͙�+��F�=:���_�(ݑrhEH[9���ef. �"���k�t� ����s"�Q�*|�F���a�^6�!r��drDu
:[��+UmJ��v�c���Zj�bB��8�$�[�lT��������	5�� sx�`P	, ꋗ��UYn&]؄�#��6����z�{�y\��C��ǋ+�
����\��G�U���ڍ"����+��(+D��{�9[��!|�q 0H.QY��%���5��O�!����ǧWXIU~�U��\_Mߒ�f��g�Bv]����,� �yI�ON��Vt�1e|o�����_cM����Z�+O.^6l:�pIg��i��Y>���$l����ꆵ{�C�#T�T ��~ñ����b"(�X��-�}��)x�*��d���Ъ�m�YZ!�M݌�#O-^�����=Գ�##U�AF�Af �G|u��*�����k� �j���[Q��2L�+K&������g��e�+U��u#�{�t��g���V	E˵��̩ؕcשjGvK��ޭ.Aj��t׎�T�4�B�;3H�P�` ?���"��(u�Z��|@S�����޵픆g
\̣�A#9�1�2���� ��v�N��r)��u�Ѭ��bK\㭄���=Mu:�0����Ն�jf�����+�|k�R ӥ�j��� �Q���1���C9����"���@���~��=0�#��Q8tz��c�UvS�M}�ڐ���kSK���A�Ƞ�A�+��T��	�^�nU{/�S������V�r-t��)c�kZ�Mw�4�Z!��'ڞP��g ��M ��Y�%�M6�Զ1v�w�����4\!�I�b�ڡ��Io �"��|X(���	L�-V��ܳ�t�-*DRĕ��B���>]�IN��Z���wQ�P��ڗ��{���\t��`+�]�!�*ֆ�OP�~�qObĬ3�L��T���z�!$�~+�_������Q�g˶����}{4�L����ȀH�� ��;����U��ݴ�^t�U�8���K�A>q�8����wb��H�î[�V��,oq�-8y�n�>��Nz$��7O��X�V���5��n4�1�g1�'�1�s�;�>'�[�9�Yk���œe}��Dl�Ye|���H�:X�@2+���>9sO�}'�>�J�u�ۥ\Ye�2�N�C��#%�OX%0.�e���,��v8\?�7� ��Ӓ89?���*����
�>g��Z}��\�s�M�ڴV�Z���U�V��R2x�_nL>��ףT%"jj���nʞ�Z��7����$�(ՑW�uIl`z�l��"��{͜w��5q�V_qaj�H�`�l&�˿o��Њ�dV}��촤E�j���޹[W�W�|rD4��^�kX�hV�k�Юx�5�_h�
ܑ�@�� {�����H(%�[JS�N�֩[Q<��( ˁ��u���=���$M��Ć"�4KR#�a�¼�z�P:a����?�����L����~�8�Ӡb�
#p�}[ߤ�N������얬!'
<��$'ӥ-�J".t������O"��e�{������RA�]��q�p��q���#H����}�'���gK{�I����ܩ�li4��-9�R9�B3�3�Pb�j�i��M��J̖#�rU �ok�RRB�:(;�oGz��k��S�o��"6=�di����?��31)�sM��J���m&���a���T��|�څ
ٕT�zy�I�>�g�η���E��ûyš���)��u�gY�&�,J�T�Ŵ��o���#��������/���LT�=3߯7�y����}�b�w8���`߉���Waι|�����-R���j���*7�VW�h�1���Cx��ׯ]�kǎ���ԭ��/Ȼ-du��j�G,JzЮ��~�,ٟ�ǧ�Q�,�u�V�{qȪW��T����wo/�g_"{���To �5��-|7�LT�Yl:�l���\'�m���'�n��&�t����Q�� R�� �6SZ�޹?��q���f�Qډ�C���j�.?Jr��%�2/`��}��pz�N& @y5��J�����M�cY����F�F��ܶ�Ӓ�suh� �� ����/���g�ǟ���z���y�'kil�.��mv�S�Dѥ���f�b�јHIĎ�so�I��!&ĳ�+�k�@�t�#�c��~� ��hv�J���6�_a�����Ѯ�":���`c�Ǒ?����e.*Qr.�� �U>��۵�]�$ޭYD�^��Z&�d+2G팯���ӐuCj4xv����-[�Q�U�r�-�����DĲ�#4�ø� �f��J�Z2S�X�&�M����9�xR?_ z��Uv�d����=y��>#�����׍J�pY�3�����'�1J<Ǚp[|cn�=�g���V�GM�V|��:BW �'8��D��0G�� :�]]ZԒ��~"�RS�fGG1�,���F _�T�|*N��
;�����Z�CPQFgW��ř+�r?��YG�_����+���p����%��w_K3�#
��_�����t���q�K/��./O��u%��Ϊ:����kh�<a�~� O_^�������Y��I^�������P�Kr��}�+�X����	�$��h�|}��u���U��V�O1��F�1>>lY���R�ٻhZ���|���������$���ŕ�*��T' �Q����u��>�b�+y�:�ɨ��>�uY�lZ"$�e�8�z�"s+�W�1�5���h�vT�kYmr� /���!�� N��檼(�߃54u����Q���QAMē �K�bW�@��O�Wz�[+e(��kq]%�q��w�یy�֎`?w~�����dV��gȵ�~I���x��Q�?�5�"�����Eb��\c�fY-�Zك��1�j��ؗ�(�b<X�*���� Y��V��|��5�>A�@�m�i�HaJV���x���)�;��b@�b�&+g�#�n����E�ĩ5uY����S��v�����h������.����ԹqQX�����$F`�#��{���D���zK-��絶pi5�?]gm1��fڬ#���5f$�n$3�<V I���t�����C}wG��_�Jס�GnO	
��VW�@,3�}GX�I�E�Qh7E��U�o���⁘ �G_�� �g�?���uz,�|�=~�kb��\�w`T�,kt���R귑���JEqP
�J���U�5�l�n�s�*Mj�a/ٌk� H�3�ޝF:�vj���4iGgS����i���	�W��>(��ۏ�x�ZRI�A\��ϺkT%�Hʞ.P���!�"���I?����X5���^�����0�:�G�j����&��9�0"G��ۨd\ ��S�]��wa#@��=� �oo?�=��[*z����ܿO�=dO�%���`��׷P� %�#j��,���\�W�� �FHJ��~���tN����������_�1�7��ه���QΟ4�PlC�o���X"0	�ێ�~q!b�+f��*��z���ˢ��J�9F���Kxh�=������� e�|S�U��n9YV>+w"�T~�H�Ǡ���M�?�.R�]�r��~+#�3�,d���=�zp�;�Ƌ��>���+��	Ꭿ��rk�o =&�L��Q�b��~�wSR�F�4U���Mn:�Cټ��D���=��l5T�
GqE��;�lk�P��Z�����x/��d=�<�'�z;B���9>�(fݱ"ԭ����T*�IfX�}?S�����\�����[��x���U���=�������~�n�K�[y����EX*���6,P��̎�ckL���?N�,�˰�H�J��M!�������U����߯EΟ�����ܾ�X�Ջ�kD��#�m��eVo����Q��s���I"���>Gr��m��{q{u����S��2O�rs۹^�H�Q�{z�$����Z$�صhiģ�rU�������"G���M��ܗg��a3-�k�IµH�Ga�����I�=��jt�.k�\���ؖ��ϕ� p���:��f�Q��|jśN�W��?��~(�P���BI$����U%-~ˌ�ɮ���"������1�>*����ӋZ�$Vu�|rf����_t��d��+����dw�,ӧ����l;2Ů�v�7�OرWe$����& ������q[^��ͪ-׎&*ʉ���\g�8�?C�wfA��/ȗd��5����CT6�Mf������ �ב�B�H��߬���$��:-�~A�w�l�ѿ����q5���-=_�뫦�"^I-p^�4���Xd�Icu1��,_w�;�BT�;�i��{�@iC��]n/w�o��L�Q�U����9|����?���i�����o1�����A�u���)�H�R1��,PЍ~������l]��$K�r]^��������̾Z �,����sN�U`^�Gb�;��l o\u�7���A5��S��BվW-(lJ���+�H�%>���$_O��)!9긞����^�r�ݟ`�H.\��C6IH��p;��U������x��+P�)e[�䬋�3�#���8�P���E7"ݵ�;��u���	��������� 3s�0�*�j�_S��K*��� �U!��J������(�H
����+��� ^��>^ϻ<� O�>_��[K+=.٪ۊY�u��{a϶��=�V8t��V�Q��<�L{�䞴�%�uU�S�5�+�����������	���O�� g?N� ��K<�W��r*�W�lE_-���ʊ����ק9���S!�5¼�s_/��m����}�����6�F-�`��������B�oH�}HF2q�:��@��R�}�k�u8���A��H*�y���<#� �Փ�p��!��#��!D֬�kC%��@¢�� t� 
3'��X+����G1_��+O��?�c����a���UZj��'���ٵ]��@	dvB�v�����:�c�H��.l� x�E�5[�#hUk�")�Ey0<��q��`Q��Ri� w�U���8���K�m\'Е�����t7�����yg��-�'�(j�^���=<�Tv�A�Ci[q���>@�iJ�-�Ucg^+um�B)c�D
�"IX����c�15[J+^��t淶�ӽ�[&��*.Rj+#cͣ�jy`0<�:�W�E���%m���G^ K۩�jB8d��� U,"�!� p:�U��L��R��WW��������˲��عș{e�Z8񫕞���{�r��t�TU����䝄�)R�yY��o����c�[ V��ى�Dv�,��h/rN�=fi2Z���S'Ȼ�c^k�&�3��Q!
Q[9
OZ/�-��u���[�5��
�bgX,x�;2�#��ak1+I�T�Gs�%���mmF��i4��_�T�6�؏�~����l��]%l|O���ՓE�D�E#=�}�3W
�X���d�$������V[�P�����oPR�2I��S�e"p��z���$.om��k}�	����|�A���p	IE���;���� �C�X�#����d2(�=�$�~����v��Eێ`��r�Vg�l'"?�h�#Ԁ��G��ӛ�R����]h��m�4�f�;���53�����?�h K2��|B��\r�S`X���Tk�cT�#&H���<�62F1���^�2&8? 5�?Nώ�g-�^�S�Ve_�tL_��F�|cRL0U�z�	�#��6��F{g�6�$70][�К�cN�ۯ^��5�r��&@T�T�&�1�u ��U(�"�eh���Y$Mz�$팀����:pF���y#��q�WuOu�T�~�mO���A0�'.h�Y������(���D�)�J�LW&�qݺ�P��1� XH�S��BD^S�, �����8��G'"�*6�m����X��*r�ui�ϕ$���Oע�E�h5�}����W���V�H/�J��MjCܶOo�FNC#���M����h6;"�2��p~�HϒI�+ʄ,)�w�rl�K����A`	���8�;�"
D�g��6��*biPIf���j�TO#a|�Qӱԩ�
�;5��h��ҭ�EFd����r��� >i �s��OJ@j �d�Ղ{T8�wh¬�:j@�I� \�}�F��� 5Ẩ�w����d���!�>�cV'�}Sj&C$q�x~� G��ŰnA%���Ч�����T�����Sp�	Bd��x(T�mG'�Z�������P��Q�ǯ@���Cv���R>)ʚ�UtR��I�I��c���@ܫ�͍���J>0���Y仱��1"�,�Ul���n� sD�E��ү���Ƃ$������W�JjX(� 1ny)��B�z���[(<��!� z�tOT�����\�gGc�[�����k|�U#�
�-��~į�u$%�&v�@��z����yH" u0҉����7��sА#F�~�I.�wJ��u��t�T{I��,~�FUP/��X*�rp:Q�T��T3�x���2h�����>�kVI$��ޝ�;��X`:��5��o��v�]��%e���CMc�~�"������4@G2�9��X�|SY*㴗Yjm���՚��~�FN������N�-��Um��L� �O��e�_���iv�K�1��vϖ|#p3�H���;q��i0��?�Z���^ �LXe\�X��'�� T�w����J�Mf�¬���&�
?a=h��b��Ƙ$~]�v\�_�M¹��6�n���F ���l` ?i^� �ю�T7$hT�m.N�,��;0$Q{�'�ܥ^J�ɀ3(���Or�!��(j�������4R��]��FU� C1�I�{u-L� ���SM��SU���J&��V��-�� {P���bMQ͔x�rMp��;��E
�)$:�'��3Y�{~��J�yyM{ԣ��w�๲Hd�R�h �K3�)T���z&�+U�M���u4��.�N�&��V+ l���R��Ǫ���D&.�Za%-]��jիJ\�J$2Xr\c'���NP *;Ȭp���א�\kQC_Q���V�V0�O��F`��;�GJb��҇�-��/��E�~��+ʿ��>繏�Lg��liX�#p�*z�5��˹�A���n��0Xk�<��V�Q�!3�s�{��^up�6?���f�F,����(�W$�ߣVĤ�^��_��L�-V�vV��^�0S����q��������1��ޞ����pǙ�&��( ��V'}:]��J ��ˆ��GdDXK�қpG�2r����}:,�DRo�>=�Kk;��I�:������BW�Ϩ�$������'U� ���P�2;߭q��N�(��|�Я�ӿFغӦ��D������SW]#D���I$g�yc��uM0EB���M�h�������6���0�X��L��OV��Y�w�����PF�\�y6|��9>K]�ף����ڛ}V��s�a��H�%�(,��?��@;�Mˬ��<�� ����X�� [*��B�UY���V�m73�5��(�:��,2�v���@T��$~�U��+'� 1xK�*U���r��*W�<;F|!�� �U�Y�;��x�X��5۝�Õ�]��qd�e����ߩ6�C{ECrH�܊��o�t���Sy���� ˁ%��)?��Ԟ�h��)UD��('
�Z�3�w�3��LU%x�5q�ʏȉՂ`�0��ϡ�Rv��K�wV~��h�5�{�3��5����el����2	�����ES��⑩數v��]���A'�Q�ӕ+��c����ۦ&)h*��|��mQ�_b��˗gU�P��#U.
w!�PzP"�HU�����Q�7-m�+����bK�� �ק�?��~�o�X����9B����6�q
8��GY&,�z����+�rmy�-4E��X�����~��<�X�3V� �m9u��լ�ԻRe��� .Ϲ�>���G|��є�%wY'��vRWK���S,�.���cy(�ŀ�6��:]媃�G����k�3��H�r}�=;��dR�h9�e��k�n��KR�1 �|}�s#K]"f-��F:��d����dIm6�ܱ��kV�H���q�����ˬ㨤X���\���۟�w��6�U(G6�סb����f�0IV�Q23�	`�+��ʟ��~��a���m��6X�Z$�HH�#��z�}� o���B�kRʄF�(^��@�H0;�Rq�$;�V
�+tjը�.Gv�5�$h�F��"�͚ O���L��@;,���h�ƶBѬ,��u�����^w6�_&R{���w��VX
r���vC�����y(lI��q��yզa�x����	�
2ꍺY��5 ����~�AR��� �&��ǯ�A��PBD���j� W���#���o�.rRKCH�>��MT^�=>?ȷPY���>��v�k�V2�2;��r��3lIȦ�8�ҭc-�4HQp�YeDF3� OD����������=nד�_e�b�[hhѿ-�x�>⼶J�1��ק�N�_�e)CO_���v+��4v�-��$Q����zv_�����~Ȍ,e#� �G�}��|�|��#bO�[!��/W.����~-�����J5u�C��A+!eB'���j7��2�����s��� �lyW���jv���(|`����V��A�S�;�6�L�yY1/�G��"j���	n_�W�t�b]�U\ƌ2Kc׫.�d��7�&�S߷�ڻI�����R3�L�$~d~�u�\��Z8�2��Kù�*�4���IFۊբh|IW{+��!��h�x�@Ġ��P�si6������k��V0A¤�7�����P��p�O�hl(h���al����X/d�%WZ�$�L���~����J����}4�T �܂�wM��b�i_e@�T�ȟ#ֳy�5A�Q��p��$Z#g�w4-��mW�S��c���;��� ?oTN��а1�U�K��uu־�:�Q|U5pӇ���c�U��%^=jSZ��k�'ȯn�A�r��J�3���S�8�8�w���|_s��ze�ߡRM����γ"ґ�Ȫ��?Pz����Uv�gVtZ=>�����8��hf�gG��w�>���_׭f!�`���Ũ<λm��R�Z�j��%��v�@�ǌ$�H9��X���kAn''�r�l{��=s� )�;��y�I������]�������rH}�f�X�A���c�n�T���iF17%R04�&�oY`��m�xG�;R;y���Q�;��&E��ǒ��
W��rZQq���1�.�֥|��ZNߧn��h�((����5�xu8ա��m6��2�s� �ǎ랚$��@ʮQ����xiٸ��� ��BMka9=��B=?oD�J9])U�OiJ���<�6�XX�k��Q_'��k�	Q��阢A��-����}3��jz�eh�R�����I��z��/E��3N�{���B0	��
� /��l�O��K'��B3L�S�5�����%��ǱodKz��d�)6�o.�_ר\��J�<_��V9x���I�ۻ�	�Ͼ�zc�Umr��Ho�ދ�?'�_C����1�>���m3�W��R����r��Ss~d
��`�01��O�WJ%
�s긼S���� Ye�[$��27���ӥ��t:�gU��X��ӛ��������By_����a�Rΰ6Ӊ�2�%�8��*Z��$~�XT���鶄ۂ�[�q�c�}��/�zPY�����	� AҒ���d�j:[�O����V(!���$v��ϊ8_������Qi~@������b��^3V�[��K�I�Ғ��|�s&b��T|����� O�vk��{u7x��a�&��:#ICO'�zi	�����<�q����GdF�^He�gSh}�d��Y"^��+�����I#�M�E̺[���;�4Q�YzV&f��g�1���9D����"�����kk�F�閖i�s� ���d��	m��X�{�-�!�#R!��>g�	�$C��R(�-dn�M�f��>�Ԁ�3x,K�p3���Ṭ��z���G�
u��V�v{HĕYge��q�t�#T	K���2ZI<Z�|�[Y�'� ���K/�RH#��6�J$�=�=R�H��|J����F2�� w8� ^�@`SF@`�rΞx��R޶ii�[���$��
�����z�6��	U�˩�J�������J䣾rr��ݽz"CTi�[��v(��蹕��9؂��>'bX���!���Vm�ݔw߉m*Կ
��Eÿ�d���RpO�t��L���6�j�OAcB�K6�d30P�VL�oע$�	+�X��X�xtl��g�� ԤD�%/è�L��g�{[�X^����v�8��"��N �$���ҙ�j(-� �G����rIk5��U�u�#�P���db� �g�	�?�'%4km��K\˔��HU#�iV � CD0'����O�m���us�QOʯY��L��#J��D���o��lt�46������Y%�}f�*��E��nWys�<4�����>�Sv�0h}]pWز7�pzs��|ƴ�
ESC$�є�_T$��VS�i$������4�B	�I�Z#��� �(#����K;5�u�=�6Ua`H
��?�㭢q9Ud�HU�q��cR��{Uu�Jy��fX��VfF��F?.���N��ʂtW_�lyL'd��iuf_k�+n�x�>���G��8��g�Ȍ���%[�8.��m*�9 �f�<Jބ\�۪���^- ���w���n'��=���ۊ6`���=�=~�Az]T�¤~O����k��->��ۏS���.ފ;w�}��(u$�#�>����zT݁�
���>Q�ܯ_�G��p�3<���I7���o'Uc�#��wA�UĲ�.�m14�������	nX��B�tD
�¶'��G��rA��K�e%�ݐ*jU���lG4��7�F�)Ij��8��Cl����Js�DU�s��L9�:Ĥ�J�B����2�����^i�}��Yw����D͏x�XU�����M����5�`UTc��ˉ�w�c/$�H�w-�rY�"Y�8,|I ��I�U�U��U�V@#���ń3�I�� �:�~{䵵\R�~ACZ���#�!�R�<��F}:��}J��`��y�;no�u�ɪZ/�%X�$#Gp�@�3�� ��W@8,��	��K�?����N�/�x��ݱ�?x�o#UE|��=NO��|�gcA9�n8b�h�!O� �\���	��7@+=��2Z����v���� cۯ�U���j�)*��31���l�2p[��Qڿ��
�פ��Cٶ�AC� �G^N�����m��- ����Ⱥ�5��XS���V�^�l�op���ƔSȄl�8�u�q`�|�8
�^����یA>�MJ6��M#x��U��@���25]6*��j�JZej��oO��m���Vx�&oo�E��I��s�����Y�2��)Ʋ_z��6r�,W��͘�	��j�~��w��_zSMV{{\�-�Ѥ{߇.=��_�&�aP�t��=�E�E��� q�u��K����\�A�5	���*�K�&y�l#�/�0rO�=:���ӌ[ī�.��%�`�7<_�K6�/�n-�uI��f�Z,<n�x�рG�V��:���Nq&�j�;��P�E�����/���q۹��!�3����� 	*�����舒�X�qSu\�KdU��{K$a��r�_o㤟���$�M��$�MZ���֡�l~D��1$�$d���ݻ���Q�@*�(��N���}�H�6�%(�����?��{���&�ocyoO'�_k���P]�@G1"f�9�,T�A�����_ T"����y��F��nӋ�j@�/�l]fL�(����ϧLe-�*ey�N��-�>�xV� ��$���>�K���`z/,��,��7��;|�g���4k.�W
�$����b	 �4�&���_ٲn.�Z��*S�a��r=�G�#���M
���kY��Y$�ˤ�!v}��I�'̯�UR�� �`}>�IE�PT�j')�A�
�x��+qQ��ۗi����IU'��{}}^��n��e�� ������ _�����cݹ�{�>����Y���ꧫ����������m.�Ĺ�l�,�,��i%%�z�G�8:�˯���݆-V�#z�",uk���T���zf���$:z	f]��D�8kу�NazC��Q������f��O7�'�#�B�X�@;��CU!Z�^_^�f�K4��*w\) ywXpI���p���,�؛][�s����":�����)��j����Д���(��RM�Ia�4|OuR(m����=H0��X��fbq� u#1�+�����A�4�U��$ϰ�),J{��8=��"����}�ך��Ў�]o�]��_%.��9��������#���E����4���R��`t*�Ǹ#iX����BP~m��?r	wu#k�&�I��"WUof�d�@?�z�`K�'j��R�[��r��1��zPV/k�Yk��������J.�x�Md������.]� ř��Ur|����d[0M��]�v�jK��m���糲�d��ǀ�L�����'��Y�D���nE_������C$�fS��}�ê���'�HU�%��qd�n�ҽ.W��5Z6�9�ݤU+�z3�ѐ*�1U�^7��b+}Kk��#h5S��@>�DFU���3�iw���]��=��V��3�)> ��&�o�u�W@�j+��z��/�|Y��
hyM�(�+�f�<�Pq��^�_/B�6F��㟎8�:����ҽ8�eg�3���[��{���M���~R����j!⚝}�͹�����kR%ēO+�1�T�9���D�]�w�|���"�!�R�����ɦ��KL�A,Q"��_������.�"�#n��n��?�T�+�n'�cb�68�-�����]� d�����e��H�#k����?#��u	٦��(-#�����n��A��|����D����[���J܂va�H_�ʶ@����@N!ID�i%����&�b���?�*�T��(������'�����}*ng���K#X�`�`�(��u

�����c�I�j�+e����oSAV�K.�fV�G�)�f�'�am�4���T]��4Խ��\{]L_{eb�������;��0)�WiO�t� ��m�jU���ܶd�с&�����:�#��� I��o��'�v��i6歉�Z��IXI<���IU��ϯ[*d�o�fV�(o�)\T�c�p��|@�"�1�#5���*�p�6�G�����V�@��i�O�w��鬗�-�@��j)|��0�v;_n4��k�k�����}�_��֙,����p� ���W�i�ͩ�ٱ�x���(��N��� 5Z�=*���W�����v�����K��&H܈���xb
T�`�t�(�٩�V?�;�P������Z����fH�x��XA�͞��Z�/Ό������)���w�.�)�x*Я�B ��
�v?��Z-�̷ݵ�~������o�p{���;�\�]%W|���\���,� V��Z�޸�j�}���� ���@�*o}+\>=�|e9���'���݅�-5�����%�~���	1X�Dnx���(}�5��X9#�~��YS�m�tB��i��^B���a��y%u����o������B;�{�j���k�Nmǒ-�-�y�u�	�'ۈ�ǧ����6L��'�ܣ�I�0��If��k'#?L�1��e���}��ή�/�F���E��B�%� ��@��h!��o6�[S���02lN��=�i��h��������h�s�-��Av1|o*��]E�\�|Ic�ח=f�d����� �v5��=���z)�<���1jeC�x�1�I> � :�9e� 8[�x�R%z�jA�� ؏��$�3��9[���џ���_��A�Z�k� $�� 5,�_^��K�g�3*"����/����{M�X<�Pǭo^�I�Y0.�KEJ����ݘ�i)�����vIon;@u�22W�=g�$����ZO���.=���~M��M�������ї�d�	�g*I�1�oNnb���bL�Z�|�CW`OS���}J2�^��|�/�>ܨ��³��w�������̘��c��3��v�`���<V�E�Z�5*ɡ�R4H!�*x/�|Ւ`�T�"��>��d�+�J��>cR�;oi��p��C��l��"Zwŵ��v\��?黫v��N��K��4p���[8#8��z�f��������$4� ~��G��"�6Ϳ�=�q��H����Z��X�BgV`��p]� �OZ��=O�r~薎�BA*��v+6H�c� j�RU~C��a���>7z]�J��]=�¤6�k�2X��&U�.<c\����=Ylт�$�Bn����U��.)�ʬ^��gl�݁$n�Oק$�P��iȨ.���6QY�?�(�0BH>C����pd���c��e�/�$���;
����&��k ���c�%$e+2����\�Z���c��R�=̶�$�� �6��s�<�B�ɛy�:���J�^���y��H}q���s� sJ�YO�������H�f���_і1��pL��<c��|6�>~�� ������x�}<1�v�m�X��Cb*�Z�:ʪX˒q�Hv=�z&*֮҆���\��R|�X"�9��A���B�N�����ٱ���i�+N�ț��*G�,a�R2}=z�D␐�k�"q�A���l[�=�~������\�w��@F)�أ���NK5����r�1�j3��}���܄q�=����S�ߦ���l�׽%h�wdE�$g�\ Oa�N�R$����B�hd�+�ҕH:����!<Rg�`O~�ODL��`��*���j5�eZ&��a�|����}�z��(]6��#�,t�QV:��*B&��U��`3 �t��@��ܮ�j����eK-Ѷ�]���h�UX�K�B�� p�g~HWc�TrG�n8�Oq��,��e؅?B{�z��P%��V�đ�yo �[���լ��a}�ʠ��/�Q�2���/�z��0�]�nZ*=ت��9l8,XՆR Gl�=f�H���<Զ�-F���YX����+X�e��X�ǰ�����>_�������H�m�o�)(dp~��?�Z!�YO+D���Nq��8�OZ���ۺ�J�Q����l�0`N�Ra��]$���\r��*S�� ����{�7*~��~��:������#�k�q>&�/Kp�DR��}��d��c���͙X�������{���{�[�1��j�v��tW�X��Ֆ&����u�5ll�ӎ޿W��,8x%x�\gK�̄����dʊD��K=��1լ�d�i�]��׍�H�i������UH8���K]�Q��no��]�b��ժ���%�QLg�I�}�2���c�\�F蜪6�au-ݴmŢwI45�-1Z~~4�9D��? >�ޗja�a������L��:�|ٳ�0>�����x	��')\`ڮ�/�yJѱj� $����� ��u�������+LE*�{��,�>���=vo�y�;�[j	�8�=��ޚq����rJ�D����8%j+F6QlOu��Yr6�;�<��9�XOƂ"�����m7KV�sDkG.�O�ktq]
%����Ic�͉��0$>���s�=s�İ/�b*$���l8�nބ1ҹn�L+b9O��9| Gs��q�銧�=,�2���C�tx�QU�[I5Į1��'�g�{i\V0�E�-�����T�-Xt�γE�yʤ�{�z����Z����m6�Is�Q�A6R�׍�C[bY�3"�*�g����j�5J��o͍�h+��R�-JY��.0 z���Xw��
���g(��$��r;Q=���Z(�,��"y�+���{Sg��ha�������,ڈR��8"�U"���09$�_�;u�R�lVP퓭ҳ��t�16�iu5�\P<���G�08/w�=c���>J���9�iA�I�i�)N|`�՗�#�
�#����mYl}I��f��zH�r�tɧ;��	��_3m{�w�Yv�?#�\�.A��_rM���.��Y+�uZ芉g_��̬����a���TJC��v
*���m��Tz�2p?�W�q] ���i�[�mD��Ng�ݚՕo��{d��_oM��j���i�^嫊���!�$��+�~=� -����;��>ڬ�����bև��MHu9S�B1�����d�B�I|��5z=�[�=}T���B�TE!$�`zt� �~D��|#�۞q]t���zoz��s+��Җ)����U�`@���ǐ[���p�4?խo�-[lI��h�Xg'�m�+�e��W�$�AC�߲V��=-%� !5[z|�]f/�j��l�3�X���D�y9*Gӹ'��{�j�a�ăL���N۔����R�Z�RcZ������n�L���Un^���j�ߋ�w��ϑ���\CY�U�%��,C8:�!!X`g������h� ��#G}(�;��epdW�j;6W,3����:��萵�����������Z��p��V�@�,O���H>�]�|�<���[��u����ζ�J�r� �]LW�� �h�M} ps�֩��#�-����q�g�lhr[5�ۯ�S�\����,e�ِ�nG�c=����>�r���*F���d�:�a���e�F�j������:Պ�`�)z��\~A�R���y^y$bY2����d'!|���� Q�^�[��s.zR�h`P�� /ר �jT��\
��3n�mB��,T�ۺ��:]�Tp�w�ǋ����ZM�^An+u��r� oF����'���I��u�sM$N���ȠdU���2=s�2+�SS_u�_��<��(IǍh����� ��GPM�0�]��9SP�_O�M���$Q��άe!|�"w�''6�"K �X�W�k���Z��������cF��-YJ���=	\�A����]��i4���Z귫ؗ�����5@1� �s��L��E�$����q�$����2}����',@�e��_��t	=�N��[��=��˜Z��l�m��SR�qJUUV(��&�E��^��J��<k}����>[j�U��jn׬���-Q�u��Y����_�|��� �~o�Q�>y�����㟧�ӥ�]?�֨�\�@!�>9M� ���~�~q�����W���n�۞�@��"5UEX�q��$����d"�$��ɟ��T����9d3���]#''��u� wQ���=�uӽV�apڭ$<Z��s d̖5�z1�z!#�)z��S�����]k��U�*  >�� ?O��|���k�~]
|gabz��dKo_V�y�?�NpG~æ*	aCe.�_<�r�������ط�N�,�󜞀$�JHz��O!�IlE�Ѥ1�"_v��C).I"��o�� oL+D��KG�_����}z]X��NJ�%�5���ߑ�#���\/D��Qi8��^���5skc|�i�x�<p���UQ�=OC�F=E5�4k� �O<�XuѤ�@�{�U��Gg���9�$��cA 6
��(��B�Aq!� 9(��~�t��)���U�	x�;��I!Qb��|c�Q�YI�;��b�Q[l})ǒ�j]��IRO�Y�z�k
�n�	�=���"*�y�4�F�։��jF�/uſjf\6U��y`~�o6�U��m�
�q��W�[���[��.����	>F!���߬w�D��'ҵ&��C���Y��ts�%���h^YW���ٰ<pZ�.�Xě�G�֓����I�i��p�f5ǬC�=`2����o\� ����Q��,��Q$~,�2:`uoCs��Ҵ�����5�x��8�Ԣ�-UZ�䪠i��sֈ�pVZ ��Z�b�?�6�X�}ݚ���*����02�w�>��Ǧh���@y�.�=}N�	v���Me��TV�@o�����U�Ȣ�=��~�}�л����K�{O#6BY��EP d��	�PU��>qK����W�Z�+kֽ�U�Q3J&w!d�f@�$��C�]�5+h��B��m/2���Z��������p�Y�y���67/Kk��v�,M$ukZ��X,�Z��~�� h}z�;0��B�n���n���wS_��D���`�A����>��n�ԓ�������`��Ҙe�����E�/ut��e��o�Jff�3�֫���>��|��u\gr����a��oƒ����B�*o,���Z#5X%%�[�������.I4I�J��w��,��2p	f�OS�Y0���n��G�^��>�!�Wn�Ҵ�KQ���yT+<����������[v�C-�y��h"�n���ZK�Q~�݋�8��bܺF���k��׉� �b9.~E�6+�c%��`;g�8��V~NK\u<�w��-?�{?��5�v��$$1Yg�X$�9��L�ê�}B�l�5��l?��,�y5Z&��w�FbF�c'�}z� �['-�e�� ?=Nk��Ms�G^]�SZ쓷�/�=�v�q߫o#E�����onZ��9��k�aFt�MJɏ	�� -Ã��ǯKb2"���Īan�a���=�H6�b��BdGS-n�RrZ�!fmW�A��{�5aX�����>Y'��&u�eW|��5�>;���l�k�^��L&ʌ�a�w�zknW�mV��[�������q�#a����2ʠ֕XB$-��9#�Z��5Yl�U�*Ҧ	Z��j���L�GX�.��^�� �h��z��m%u�w))jj��b&�a�O�o��֞<F�_f����$���y���<�*k�eo����<��������#p[Ѳ�<O�X�����`�����@�[��� x�j��܎���s)Q�k�/g�r�O+̒լ�����W��e8���C05L��Űj�? �����5�5�@;��E�*Gn�tE��������i��������Q�{�a8���f��L���/VU|zV�p��S�5kW�"�ߓ�e�سbD�U<yCφq�:�:�E�������=�D�8���!^+r8�NIyu�$��ֽ� ���Ԛn;\�Q���I[_��cЉ�s�N��&�7/ ɷ�?���o������Ó������}�pL`
?�l��� �#�ē�^&G�`�}QϘ8���י!��J�W��f�-+i�<q3E*��2��=&��|�� ĭ��kU5pױ��WbxKZ�ْWg ��(*ı9�= t�3\�'�H��:�#��t��Z�줱3xġ�B��� �OӠb
v
3�j�ځt\o_[�i&�]T��'����צ�$3@�oY������gQ*�X�Xd���P�.���L��OƼq!�i�8��[���n%fv� D�'��I�\慢�����Y�$o��rEe�;H�q��1j��f�+��Z����l5�k�n}��5��(ٜ+?��ǶORA���Fmr[�5�v	��AZ?˸d�F?%|�����&��\�{̶�1�l��\�ܡa���F)
�?k	���\�GW&�A�1�i�Ɍ`i�.��C.k�~�}&���[��z��fk�:Y�A�8k�~#��'>��[��8��F!���y }���6zT-K�� ���-����F��8]��Ooͷj�����x�WK�ӎW����wD�-�(RGp������D#Zf����^�ӟe��
�XU�r{G�N����P?�� �����}�M���<}� ����ϗ��gS��ʇ����kd�b��:k=�?�g//��v���ȱ��1œH�kTM>X�~D�8���g?�J�+����I+������#�U�(3�>i��֟m��k����M����#,jT��2pG��:x��%~���F�x�G�E�܁%��= �$������ �S��l�4Q��6hF%F�R��O�n��v�,�emF��ؤz��#���U�~�!�5�$��~�1��h� �wk�W�-���ئ�8�X�)2��Uo�d,��Uk�	�"]���{� �08~a1.�}xX�5�]q
����pWR;����vT4@nyZ��q��-�Cj�o���	���j)��b-�/ٚ�Õε�ю�Q�iS��3�}��B�}:&2rW��G5��*� sb�-H�W�X,T���;���-��>��5��-���$f�?*X��B#�n�)T�:��[�� ˹n�6mMw�le_ϳba$�$�=ɛ ,`��OXy����}*��ͪ���"ɦ�S`��E�����f'�zHP�'X��g"�hb�n��:�$��S]d���Ǌ��G,���z���0΋j� �I�U��$�<K�JBSWn�@�x�,�$��[�n��i��j�܇]j��kivj�?��ѿ'�Y�>L`�8��m�^�o�Ů;���짎����[Q�V�*�2�,��ۮd�
�-��cf86�Mg��e�fr֫58��2K0/dd.{���YbLsU�m�i-�ݬ	=/��L���-Z�x=�I%8?N�k���"0B6� ���Sp7��%�h�4�܅�T�N���P.3J# \���z�2�_�$��0l��b��bF/
�p|�f�%@�Y�+���5y��n	�\�>GW��$�ŉ{���G~��e�D� ��]�ݞ��%�l�oU�:�֭�Fat-��?�=����AFO��5��� ��M
:*�6�������-��'��$~$�pQ��9��ߩT%�F|���m��\�K�ܞ�4D8�gl`��v�s߷W�uHbog��f��H�z�`�Ԇ�$�0-<�I��{��1��`���^��:*Ւ�D���[ �X��"��T~��h��St��Z�'+⚵!7�n�q��"�J<w�v��z�-��e��k������[<����Ƭ8�U1����[ ����h��y-B��������vy8���T��p�HZ(�%�|K�#ӷZ���,��r��}�Ŝj��c+U����B�ręuPM��-d�w���Y�)��I"$� 
���w?��ά�� R�@}X*�Gθm	}N5P\���GP���x�/#�����Ψ`���/�9׎Y���k?/YJK�屴� ���H�Kٔ�9�|u,�@���\8T'»�S�)�>#��Z6��)�rQ��9R�R<����ڳZ���4� ���7�V5�km�t�,ؿXڎWy�H�h��v�?n��T��̵\y~Ǒ�C�;�T1�3t��2+8�Jρ�);(9��pY�'+Ԩ��c1Z���ڙcRi�D��<�p׍s�@����Ug͕e���qַ���r��J[�/�|��fc�����7ǥj��E6?8�in\�ޯN���J��� v�d2��O|6�1��D�Ym8�0^������kHǓ4�#�?���8@bˢ�]� �}^�����-5q�G�SOB@�;v��j�D>$ਟ��\{K��b�k���N�=��c��v����x�����Uh��O��>���j��&��-�6��9(��>ܷnê��pj��6�[3�9޻�iu\�W�a[oM.�t�s�>��@ �z�H���æ�#��,A#hvTc��L�ZW,aM��Հ�D��uU�gk���gf>9gj�z���[tb�V�S,�z�������UU܉"�A�6��������ԗ�����䪲��UjK��e�z�9zpX����S�Ż� nM��, {k[�fVo�Y��s���ar@-l� #jm!�q����v��dx�:%�PA�<Z&�$���(�9,���x�� |��趼�r̈́N;��S�4*W��+�+" �A`��8�.��՗���	,�L�[�jSN-�ĭ��[Eo�k��(8H�g��gh8/5�ǭ�Ug�n��V����~��2���u�6���´U����N�S,��Cn�����V[��N'�K2�L�����������`��x��c���ˀ=Ȣ�p ?^�M�Y�,��kWf�l��F�!M��F�����|������.�|#c[U]��i2�a�R�"�XWȱv�6R�諜�h�ם��B�{�}U�t� � �¾�1��+7�� |���lT�&�j���J������,Ъ�׹�� ��0]6[w�]�O�r��%��8l׎.�B�������	H%pv<�UW]�����e(E�:�V2x���{���@U������v����,�{M-��"xF�I"����l���_�j����ݞg�S�k��\I�Z�I�8�Ta��%�fR�\�G��Ȣ������ �+���@b{*��\�y��Z�F܉����n[Ƶ��r�{�Z���-UP�!p�IdW>�=4+�3b��=��� �9'��c�=�>��/o�Ϗ��t�gC�w��h��b��D!Z*������D~Χ�+�N2��o9�޻u-���&�c%K�Ja1G�P�jY?��}~�	HU�Se�`�j�s��ڽ!��B��$d��J��g�t�qC�o6rӵq]�o4đڞ�_Ƭ�9����tbj������(Э��ƫ�5�X��J(��F����o�	?���	|�Zd `�=VX��)��B~?��˯?;W����F��zg�sӛz~j�2��s�04�j�⍥�^*t�2M`,�>RI:y(�2� ����۶�NR��I�� !ٯf�{�?J*�d�%��3HJ��*�&��Ӧo��8� �۪��m����WG����q�e]�`~�!�&�?ƍ�f�0�+h��	 j+�b�O�+�F{����A���'Ц�h9�hll�e��O�8*0����]Kg�2ԢVt4Db��Ű�ڵd��YUG��t��S3[c���AS��z�sD6��݌7�@;�o�����u������E5��M5A]�H+�!���|~���uNغ�ʪ��?S�-̺�Z� [!cS� �F�z�qfYŸ�.[v޿�ۯ��j�U�ΐR�eȁP�)G������-� ��K/7��"����[r]��[�la�*@�b�(�ٚ&T8
{�{�=j5g�'�U����ƴ�p�*͛B��<��`x��cUҎ"�A�����4*������F�T$���� ¹?�VZ�%�t�f r���}���oT��B�nK8o�QV� ~��<�_0���ϒ�S���[Y�Ƶ_YZ_ȳp\ϕ���E�O�w$d�ޝ_nю*�����]}��&�Z�P��g�%Z�;eb�$�.;�����V�%��c�9��/#�rA���+�Q����^# ӿ�֘��f�-B��;��A���Y��Z�Y�k���ь�!�U$�Os�yd�����|���o�=U�RԜÙ���%}y�-h�We�:�x����GӪ�vY�+�`|�o�N��}�,�"�$�4P��l��Ƭ|<V҃�㭛N�,�����=n�LZ�$�=H3�LI�x�3�߮i�ܺ>���z�ީz��ӓgT46!��䌉 �~����S~T�Z%�u<2m �'�H�a����� �4A���:� K�5u�Z>Iĵ���uө�g��� F�.
����s���ֱ?�ߢ��?�Sr$m�n�}�p_���2fN�ҙ_��֩�m+<&���ݖׇ��ܷ���{����C1�d�?�u�2�k����V��"��m'�'v��h�����6�{�� GZ8ҩ�d����l������ڰ��{�
��?����`���l��)і�m���Y�OZs�Ff�I�}�$u���5�C�Z���\� [4�]0ԧna�H� ��y���Q�����Dk��hz�W�	��}���7qGZ-L�A����3wY�y;�9^��O����nT\�MQ�V��6c��e�x�Y�xy��0`���ӭD�A�^�Z����@�P�?��l%�� ���+���>_�B� ]����E���Z�	ouI?�t����J�@x�h���ч�]���d�wF{ۑ�K���`���e��+-�� ��}&�E+ɯ��h�)#��bN�m�M�����˩���T�a�<���K@�,��I�z�ƀY9g�3h)s�d�T�Vw�"RU��
�q��:����Q%�7 1S?�NC�����k{V��1��l� �2��� ���wF��	��o�"��%��XvZ�:k"���(�eܑ�n��.�F+b��h��1�����שfO�n���zͻU�*���z��/a4|ɢ���hP����Ky�X�kF�+��@a��Gn�����b�* ��Ho��_�ך��𴗆ݞ�o�KbT�MD���+6P>c��=uf}8.m�iE��˄�W]V��8,�X��� �H������t]2������KƭT���gw"?���u��&?��;���N�>P`U��>%��6�SN�����a&X����f�$VL?^���X�]oƪNI���\��=����E�e݄u�#�T�R1� {�d�׮}�D��ړ«K+|c���M��XO8�KC�0-xb���L��e��1��������V����Mfi��o,�u�˱��OU�z#���/��EZ�T�z�w�Gn��}�d�	� �L�	-�Fq�߷X���,=H$�/î�;q<YrK�d#��K��b��qW��}�\sSZ��bĖ)׎F�Y��}���=���H�h��٪���)�pǰ��,bj���@�Q���M�2s�&��U/ KdZ���±� wE|P�7�����=�潭ԳS5*ڐ4H���b���T�{��c5 5Dۙk�llK�����[:�)\��`E�����J$�VoMV}�ϑ[�z���eǹU�sկC���l¤��Ԍ���fD��$K�U��eZ��n�1:��x��@��pI��$��!��d�Na�F��VocY�ڑA�s�� ?o~���b���]���~����&���~�ǹ�AǦ:K��$кF
.ڿ%��;�ΥV��|ū�7�H�����?�$�c�V�E�2/$����^?����o�M?g8��//<����Y�c��9��j��k[g]�U�jLh d,!`{�����# �.�K͘�H�rm���Y����3���9�;c��7�V^E��z�@�{z��:�,խ2lJ�Ub��(A����Y�3^�K�K���U���wk a�f�\�'�LxH�>����Ƀ��\�li��mn�Àq%�23��s�g��3#׭��cf�ۚ����Z�G<��@x1)���#��骩b��3���htZ�tɾ��\��X�1B�G�� �38���dH�xά�p�G4F	�����Dխ.�]R��$Ydk?L���I�_D�t�W^��X$�Oxu��4@ ��
�ā����b��u����	����Z�X,G�^G,��� �wV� ��0�b���u�we���6wl��Q'��(a�P;}1�*F �RT�R��Z�f(+�a��&�Iɞ��랠�©�«k� ǛZ�~.�[�����f��$�����g'��X.�el��!Xܳ���E$;�dU�ٕr�=���Ob=s�@�Y#E�"䚝��EWt�Y���^���Ufc� c���LƯd�W�a���Yg��jw�QLֺ���+���8��%��5Z`��sKM_)�c�HX.��((̬Kj#�[��e2|�ٝ��jo��{��壈�R�!{��1�H
*S���o)pz1��W��
��Eb�a�%U<�^�>�[�%G(�j,�9���0ŭ�i��	v�5��Y��,iM�P���:��OQD��{�ꍢ����Ia���O��J Ӱ�?��r�c!��߂��������*�X�c��H��;^ܽ� Ӭ��|������Il�n6��Y��Xjdy;��zg� �PWO��_}{M�U"�^(��V��3��ߎ�K��nH>kG1+cR������o<J��Y� ��ۊ?\}:�b��K���Gn����&��Z�߻�ς�[ ������SoU�;\��\_O�n1��4�c�i�(�Uʏ��'=� i�(Ё,���4J��C���ڰ�Ԇ!r
y�.R2I����<C������^�|s�3'�ص8J�UV98g"%ʪ�(�z� 4Yfb̷]�8�?Y���V�|Jԑɩ���4�H0+g N��7���ſ%�����WOh���췃w��%Iϻ�`��(qU���?�ZnL1X�`W��nsm��3N�'�QA }ʿ�\�#���g����6:Me?��W���޾��Ś1���q���Y���gc����Z4|WoƸ���S��n�\V�m+���@�+�o�l�ܞ��,���oY��?�Vj�n��p�#��g�W��e�������ޏ%F�K���d�]U��Fh����o(����_�ۂ���;�C��Mks��]˵�z��%Y�z�ʙ�� ��j5�� K��'�*�]�|Kv��*�n}��ԕcz�*P�[���&)�>^�v1���)2�(֫ҥ�C��wm�&DP���!����� ��a�]uw�F�Yk���s��U1��0�g�R<=��㷧Oa�b��=5Z���u�b㕁���.��5�;��L�)���Q�`��=l�N�VK`o^�C��VP������<����#7X�B�d����Z?���-M �g���W�}���{����b!��x�G��!��lV��K#V�"jB�&��YY ��?gW_�ڳ�� �O_�/'��K����t�"];�ܱ���rI\��ߧIc��@!�w���'[����n�vUm�(^�Q��2�xa�p����ˠʨɥ�-���3^���?��U�\�&?�G@|Oձ���a��V|����9�X�rJ͵�Yg�#� ���4_�V[��吝�H�il�a��Q����v�[� �ڱ��L���A��w=o��5V)5�
o�Z�5���i���\4p����z���]'	G�p�|ώ��l-��#��E��3�Lo� *,��0����.�e�kW� >P���9��ic���}�%p	��f�*�=h<��Vo�֥_<���4�7 �h�I���W�|�I�]��9,K�ꈉJJ�b�hsiv�IE��y\��CZ-m��B�����o �Q&i���&�՛w�oExֲK���-���B��o����0t���N�h�I��>E�!�Dw�7�Lr?u~������2�ޭs��E�����9=�_�]�q
����[|{)
X�v��K�]�+����sĮZ�q�?�mK<b�uQ*�J�.	�������0t�܋��I�\V�J�dw��$jq�_��3�6�$!�~M�T��zKm��_[0~��<c�#'��=Ȩ;�'���ע6�)�BaSJ,��io��?œ��	g7�6��+כW�,X�C �]m�p�HcU+���3�p�>����G'��\����E^��}���<����q���+w��1$|#`���򹰤��'�yJ
;�L�U��F�����ߓ����ǳ��vg8E0Vb�+w����P��Q��ϒjtֶMk�<��f��0�%C�χ�I9o�Q�Gq�W�� �� �]���<?�����6|�>׻��Y�l�k��T��뭳J���w���d�JTF����U�F�yN��������%X�cl*,�KC��:&UJ	�{ے[�M8��Im�a�{��>߼�dyqۿFr͒z���<��kK�n����+Z�be*��؈�lz}ݺ��)�J��qu�;��UE1�Yl���f�!����H�	@���E��X����?�br|���N;e�v���b0_�hf[�˺�u�I�W�;;y:�1l��?��w�dIGf����4�ً��`x#kP%� H�T��#�7��"*����je2Ej��^v��7.�e������;�L W3��#��qq��V�i��r2��o@:"JH0r�g�����ֵQL6� !lG4��Z8��V̘!T�^��(�1�B��.y�~F�AP����Q ���r{���0�o'�1������H���s�X���Af��{uͺ��u��	��u~3�6��*UN�pfo�:�����ܓ�Դ�ߤ���� K"|����?�Zڷ��*	!*�	�nB�$0[��>����z4y���U̚����/�g�:�~cw�j�=%i��wg]�4��w=��a?�ԍP�GEYg���#����R��m�<{m����<KoW١3�&� ��`M#v�s%*��0U_��7�T5������WI$�דƨ$fdX�|��q֞4������;6�:�W����F�5��Xlv�U;��֐����v�$�d��a$�&HnJH����K�ۢb�Ț���?S����M��k�տ�u��NEܻ=�r��������+E��	+U�F��»{���� iʤZ�>�f%ă�A֨Ƹ���l��Ϡ�C��]�r]��IҤr�!�
��$iB�UC�z�|�jV�0���ZH��$'�2Ib\��
펩.���/���э�I&�V�a�ȉ�s�m(��=:���r��k4���x��Szɥ�/3I.@���G?O�\��=WN٢U��M��p[�b��-<6���=�Ŋ��8Ea���8鬰�pIx8Z��9���봶�ϼ�;Pk��$�ġ���G<��[e(
�X� U�ܳq��:����v?�z���K��<�s͟sێ�#G�Ӭpm�E��Ŗ��>SǶ{MQ^CbI6��đkoF�K:)�)����h�Y���װ��lS�ݕ`I	a��ˌ`�X̂ި?���R���oar?ɰ���������ݳo��]h����=&��_v��!�买��p
�K�� ɞ���������g���V����� ���t�l����~���g�a����J���r!�h٘q8|hYfX�+������l��]zGn
�O����sͯP���Y��$Xu����y�/n���TB�WN����'UCqS}��;}��X�V�X�y�4ci���i^�E!`�ᱫ	��L����ڶz�E��k���j��#��yV��v�MV㤉@����͏a��X�Yo�J��?�:�_���Y�[(Z&���RO��eQ&H�=�ղrf�NV�yqT�����A�3-ה:���$�?׬��V�p2�/����KC_�]%��8&y�0ւH���#�Ă(��~�]b��צI�����Y�q�[7�Ȟ����V`���@'��i�K�������'&��w0����h�Ra��N���U�r��w�Kǋb��h�}V�E����O��f�Q*4���x�W���f��R"�䐐͚�=W�1�z�<�g�v��qSQ���8_�
���d�=z�v�W����e�+T�vv6zq�lMx�&�Q,0�H�a-�!(���c>�Sך�k�y��_:����#`ڲLKc�GJ.��^�*��� �-���h��*�r�@YA�v���י輌%|q��9��
�5nƎY��շv��Vl�"h���8�;��:��)���'�tV�O
Ն1y�o�G�����/�՟�:${��>�&��q
����vc;Dm]��P=	 �8ڠ9%�	�/?�Wu �]��9� �ׯ+���Xѯ�Rs�"	���ۂ�w%�R�Z	�]�mn;&�ޱb�$%�'�<͏�q��Ԝ��Y��V[S쵛�K�Ԟ��i�YEP�Ī�?�@��zv� #\W68}��d�.��[�m<��	Z��럧�:M�WSh)g�=W�\9�^㛈�U�ۥj����sC3��1nO��u����T�G������M<V%��4K�{7c�/tI�B��Җ\���z8�	�[i�Y-�59{MRy#�U}�9Bp{�����6�`�T?�����enC��^����r�F��I����� /a�ބ��h��]>��<V	&���'��HJ��/�=�{I0$��v�U��w	C���B���S��)�#zT66I��#����������n9n�h��00w�2^��9�m�㼮A��i�v�BW�,)����a~��Pl�F���ko����p�֧H��5�>��Fz�a�BRL�܃|����d�[Y2V��{aMR6a��=�����:WlSFd�{�o%+�j���ԑ�Z{��g+�A^�F{g�$]і�{�����G�� ��ny�>>�����1㞃�d�!��߅LU�<�H)D����#U��diY�؁�җ�'�A���NQ�ޣ�Q��d\�l��B#&6	h��K7��@5��'��;��X�WRMB��`[3<N� B�+�Fq�Ӛ�P�н��C�M�qG�Ԡ��Tw
�Ԟ����v�_ˮ���zȕ�Z��L�=ԻOeN>��J$pdv�������T�ݖK5���N ����g����rtCkU��Vm���"ٶ��$��V�(��2���� ��I#�(��	�ñ�G|=9�|�T��xcz�P�*�� ����I
T�4�s	�n9]ʱ����XA�a#H�~ܞ�Ɖ����-�m����Λ)����` {@��dz����XDb�� lp���t���+���s���#�}z:�����|n4P?����殕}��/܏�ȓ�G|�P�lq+{�����t�S�j�C�W1���@{�>���p]���i�἞7�&�h��b�E�dq6r[��m�����{�
^���k�����5�E���rc�c�d�랶�E��گ��|��QO*��m���S_e�b>��TS�O\��-5��x�E���R4�o4�+�ܯR��]R���>�lUb�t^��l펖��u�^�ҷn�4@���?����q]�%�c��\�N5oOM��K��V�\�a� T�2$��U��Uts	Z~_Ţ�G$
�nJ�O�	��6����w��W�gQ̩9�D����b���=�[�#N��)U�J��Д'�^O�����nE/��Y�ģ^���8����a� ����S�F�ym������ۖ._}���f�;1C�� ��V�'��q~B����]ӆ��������M^�J5��u�"��$���=VA�U������V�d�mg�������'��A��s�
���N��m˗Tܛ�K"�թ�P������=� ��,���u�WU�`_�Z\&�\wo��ͪ�լCX|�̡e�e��;��=�E��n��ǯ�/�k�*o8�7���6W�S��>Q� ��=�����No�
����K{<׌�m��W]b�n���(�S���T.��Y�%�~QDЀ0�S]$ӪgՉH���������*gwv*�✫_��'����;�kን�0Ȏ��8����՗*�ou��O�q^�rض�\��Ǯ���O��{C���Yek��<U3��L��-E*�H(ԆH�Џ�ZB_�<�����ulm���3%P��sj�����/�{j�I9� ��|�J��զZ:H�1Vn��z��c�q*�եS�;Y'>�@c �������� �X.������&�nk�q�&d��$���F����>9|Ў4*~���<����k����ŧ�iYI�An%�=O�J-VO�z�)��R��y��U?)k+��ZZ�� N�G��%�(�(�=z��K���ѳ��7��m�4��VJ�V�T����Wg���cZ(dst�gU@;��O}�V.n�2�BGn�=Yg@�C�V�n��\�og�Q�Tצ�`+B��FA8Vf�Olt��(S�p^9]I(�[F��;/,��}�#�Ζ��ЄK�8�������+�%�<0{���?i��B�5Z��"�M�!ũ���꥖6��$���%�8�[� S�0�A�:��p�epl��3N8�"i.UEE'����;�t6Vn
4�ÂY�G��x�ɏzcF�r�Ps��,q�����%�-�{��K|��V�ۖ��Rđ�Lȋ!d��>�8�$:'/1������/ ]M*W'c�ؐ��H�
X���W�׮�M��[*������d�ʺ�3ǂ�0~��0.����Wq��Mֵ�.%��ݽx#�	5Hř{w��ȑ�B�"�&�1W�R.+�{"�]�x��px�/rzc=�'�l6��}�3���oK�}u��������3����2|���(��;ى��'��|�Xޤ��*ჟrH�ߴ~ΔH�`Tm�e�Z�)�ke�^a��
1ب�׏���� ��;����q�_���|�����Q���X��V'���=	?��b��`�5�wǸ׹�,��,&��a��>��?��s2�Y T9�7Ғ+C6�:�����Z��*RV�-��?��٥�rH{.�5��%��_�g�i�O��`�@F��3�	�B��zx~�%d���U�|_��Y˸�rI�,dOV{]FJs��D�!���!���*���|��	��ș�Xwܩ!�mh��T�f�#ZÙL��>> ���޽F{��_'�뵵!�uI��8�{~L�}����I��H�"e��E��5�w�fk �a�VԮ�=��z��T���q�zȰt܄�jrǑ�;��Ղ�eS)ؿ�7Ji��_e�k^ʵd�+I����w���U�,��-��I��#� =�z�DD�w���J��f��<=�/��^��xǖ3��_��U����l�~��<y��(��b�j@��Y0 ��\�'���4;f�5���$�7��ܨ34�SX�9b�x�z�]#�-���������[
"kSE���}���Oc���A�b�Y%��`�r��s�b�Ui�|��Y�e{���>�CU�s'(�s���ժ��[^��UT��&�C/~���� ��|�A�~U��Է��6 vRe�W[B%����<�V����=��I�&q\�ӥK+67�^h�(��`d�*1��� N��҃�����,��0�X��Ib��e\H�
W����z�[�<�Řm�G�w�����Ȓ�յV>��jԇjSH�_˻��%q�pIl��}:�u+π1��A��9�ƛJ�a +�	>�1$�8��Б���h�a���'�q]%�R?��r?��8Қ����>W����^!B`�#j+���8#�:ANe�?�>~��O�]�-�Pz����DY�����J>Olc��Y�X.�_o��+�?�5R�;����i{���bk� ��x-do�3-pś�v�� ^��Eܥ�x3-C�j�W�)R����pY"\���0�S�-���������.��L�d� LYuɑh�=� O�g��W;/'�YndE�T/�6:��,�ZS`ƢYV�0͏��,W�~�Y�U���8o���i.�'��t�V��pdTp�%?�VO.��z��i¸p�!�&���� &W��pZ>�>���||@Y�� {���Bi\�J�~^��0F���dE���-�߹���Ӌq8���iZ/�>F�t�R�\�,${	!�GM����� ���NFpgOm�(e$>-w��-I��ҖZ/�)�B��LR�ӷN_�9Lw>C��cW4T9�%��)HbI�; Y@��|0;���(�	�m����/�\�GB}�#�'����j�~�(b�Uc��|v=HZ�C9��Uݮ9Rk3Z�[o-����7%�l�i�
��'��U@P�
; :�G�U�$'c�t�CZĔ�P�`�G�f�(V�ęge%�`g뎦Ѕ3Lͤ�Z�������!�{��F�g9��I�!Z$���uզ�}���Q�y]��B��U�`x�����[�d���il5�,l��8�.L?��!*��S���Ԕc�$fU���xB"��(�өݐ�1Va���ɕ��L��t K0>��f�u�=u�R��U��$b� ��W���c_Kˆ�u�A����/�d�Y�G���M�j���J���!�*h7�^�V�fӥeE7�6�� w�����9��[�����+�4+"��@�
��s�$}q�>�	d��9��lvԸ榮��WX���	�D��g�j�aO�`�;c$��ud�pY�y�`�by5�Z���B�oY|�J�4K�N�@~Π}�$�~g4H/m��)D�T*[��}?�O?�N�U�Ԛ:;����9	6S����urd��� �e
�^�A:%1"�_�� }T����"^�Q�?f=V��J���E1���v��G�n5��ns�gl���E rY����e�{���E�3)�����v|��� �v6�Y@@���0�L��Ӧ�l��WNI���]n��y�e�,-��D.�y�k=��N{tc�MpQ6���㈪�m�u�"���������:�H����۪=E@�Dq���,4<F�>�:S�N0\���w�|���x���۞5_M~�94
�UE?u�o�>�9����g9�L-�$΋\��	�K�2���p�I~҅c�����jp��[����ܿM$��<�UY��Ž������ГtR2����7R����s����x�U��>K+x�'�,j2�����2�����U��i%H�Z�X�j�;��k}�w w�qլ<R���g��m~mJ�����rOn���ȼ��*>�����щɓo"1�t�'���Gu��omH$� X�c����I7w(��U�x�$t���rķ�{'�����Q2�1�X��u%>��$Y�|ϕ���N%nda�%eظ_.�IaFq������MO:�k�ݷ����Ū�j�Vg�y�*��o��;t�����]��z����W���9��",1�Q<���''�LHF�+>�-�
7nK��Wj�<�(�U��'̂@;�נ�����[M���͗&�I`�����?�L�~��R�M�%��$w��hy[gnԮ@p��)�Q���Gh�Y*p�'@/A�YgW��|��Ӡ�[T�ˮ�w�<Z�[�X+�+�A��* ��d'���K�HN�d��3.�W�fc�)��?� e:
��.��96���\����a��'�&1i��)�1�}���k�9�VK(w����@��� ʀ	,5K��$&I��ǥzB@�� �~��K9��j�7+��4��R�ݪ�i���dx���hԌ�����Z��l��g����D����^�n���W���M%h��[�?��ܛ������5?�>^~~?��t}nL�m�9li�%9㨯)���$�}H�ZL[�:�h4Y)6|�Zuv�KE�72V�<�&2� ^�(};t[$�T��&�ռ���K�Xj����h��d�=�;rK"Ȟ�{�(Tռ[m���qk$�Va�.�|���MM(�����IΤ�DNY)b|�����}rl4���,ɤ
R���x���r���D�r�SY�)�f&dX���LH }LZD�hm]� skqr���� ��\
�3�&8������2����=���.�jfQ��ےD}0|d��^��47ooV���sg��f�[���q�$Jd�IZYdk�bL�������)d�P���jΫ��?�+Yyk�άT�23��,��c���pF,@JUy�Io[����om.[�1�> ��<�	\��z�.=�l�"GC���7�F���\�|�P�y����J�ӎ��ڻ^����UT%BOl����6Ǫ[���E_3��x�0�K�ϸ�YJ���Ke�GQe��bB��ði:8YE�ɲ�3�n�*��;?Ƌ�9҅�h�x�xU?ٞ�WNh���u/"���٩���wYFx-��(ȞH|Jr���Kl�����c"b&K7uk����E�F��5$iF"(�/�f#ԌS��3�f��`��H�gyq�8�u���6�O@p��� N�wDKd]S�.\��i�z����֚f�q�!�E%�gӪ�J���G'���Wo��W��a�X�����m��*<��&�V�<@�z��`$�&A4Gi���  %I������w����Q"1@5�MF}���f���d�ï���s�P�/�� N���%�tCA����[*;>c�����^a^�<���
1�P�I���. 
5T�� �_��,����rՄ�����s���K�Y:`�
|G�QJ�շ�g�c��{,��x���@Q�3�y�� ���j�ǔso��no�F�hu��Wm{UQ�s�`3��ѿ���k9J*뵏�8݇acP��$���̡ǡ"[23۷N� 18�U~9��,'��B(��y�Si���23���YZ�� rdW����zKZ_���Xf�^X����QeT�8��K1(*��������F�O�6�9�E����� �I:�d�*����x�RN��+ƾ�S�)31���~����bw��\����ȵ�$F�������9}��w�R^�Ekڑ��g� ����#׭V=�M�A�����<`�q���Q�+�_���Cm�j��8^Zڴ�0L�#)*�x�ɂ@'�] @\�̳f��+���3�4���F�b�Z�բ�I>$���*p=O��Jq*͛��[�o>���3k�R��dФum��S�
��������N0:�������붐���Rg�N�1�A���Ȱ� ��������i!���ܧ��b�i�:Ʊq=����Uя�3I2���N;t��K�X+��%�=�� &��e@$�G����d��� r;�A��� ̦�� �^a�7�`<K2	3댂���~��g�_��A�~"��fKVu��nӏT�9&���m��Hb�e}����c�WB��{���EW��]�'�l/��\ׂ�!�
���ӱ���T�f����ǿ�˕M��y���G�ك=�,ͱ듏�:�;��%��#�8���M��uv+렯�s[TēI��lFT�c$�c�LJ� �.��B� �mY��$�b���g �' ��ԉ8�(������	4|�3JN;%�5�Zv%R��P�%�� *BH���;�T��Z,�2;J�~ȋ��>ׇ.�a�����_�=�haYVuR�9��w�D��`���:M�#�^��c���,��V2遐c�Pw$��f�Z���f�|yZ�p#/�A��=	�5yy'�8 ��!�o �|L�rs���1�e����>c�W�]�5��Q���T�H�,U���)��0>��z�@���^{�g��߬�)"
�bRN@�!l���K)�Q�\wh��E7��0�#V�_t.7�F|�۠n��-���_�)�9���~u���T�eU�3<����؁���Cp �F��W��Ւj�#v�QJE4Ԡa�W�=� ;��{�0�@�o�ʛz]w��b�#;�6p�Q,�41K��w=A'�JEN���}��5^/����v�=��b �h������/�r	S-�5�m�߈E����|@^ϰ�f:6*sr{��u�9N����J��cPaR�'�m�%�^ރנAH�%�c��}�A��Ú d��5"�7��NG������v.�������Պ��͔�_�x� @�H�������$b��>sǶ5�)���9���v���)��}�^�1�W"B�8���?�&��!�-��˷�YS#�'�@��<�'���t��z�^�"���^�X�1���dv�1����z-*�|������Q�}��P����x�˴�k��X�Y��	[Ć�s�߶q���I1�S}�[�j��/1�#[R�W"���&7p?���D�@�j�{p�k���*Y�0
	,����(߸=G|�{��f�;��o%:��Ey��\-4� .�4~x
q���RA�bJp��)�i���F��ٚw�#�U�L����qЁd�#Wܗ���I������?/k�����/��t��Tl�P$NW>�Xߍj*O<e<'���!��l�G��������=~�[������5EQ-�7�9#�@�'>����wэ� y��Z�W�%k4�מv��8�݌�+g�^�qv,��V������\��m[��� J�7�Ij0���ԓ����� J��)�jq����v�m�@�S�Z�#��2�#�a� ����[�l�����B���^�Qxۚ	"�ܐ3lC���ӪS�j�k�>�Ab͉��+���Wm{��@����_��� ^� �츶�NU��IV��z��X���Z2!�#� �s���a�Q�tB9����k��MƵ�&�g���M��A�Q�i�{��z�p��k`�Ĝj@zϴ��m�F�h�`�J�õC���Ic��f�����DI��d�Rc���t�n���r��]�Y�� D�wv�7�ab@��wc��.jx�ƺ�M�(ǡ�u�[�&���L(��Q��g(T1�\�9�^���nr];������[];�1֢���UK0Y�{�" C|T�7:��mD��6�FMZ��7eid ��s�I� ��L�*T2p�
���^o�
���6ql`�a����;(��=��H� �i�I�%+��^始�n��"������}�r~�����ȁ��6��I��c�K��C��mX��ؼ4e�|�}�#��z� �UL��]��˹�m�&� ��m]��W׬��� ���� �����X�+��$T����Z�O0�Ig�����fǓ}�{��2��e�����MNm�)�^��f� ��|�ف�:�1����e�?�C�˽�:���F �ϸ:_�K�c���� ��+ؒ6��Y?b�	-0q��ď��{���6"�>)�>C�9��H5�B�J�D,\�)\׬��x��%�Gӷ�Zn�,5Y����_τx���Z;;�M,p��������$z����F�pZo����[��˜��N��2�F�c4>a�wZ��í�u�@;e�;�����O�O�.�=���Y�+�"���b�� 0� O�s�a����+l@n/�!��j���G��)Ǿ�O>�׌�u��x��`�ؓ�����S� �m�~.�{����ܞ�� ��ӵZ�$L��I3���o�x��w���%��q`�V�"���>7��W5�7'�1�e�B(J�I"1�1�C���� �x_=�<�Yw�ckJ޾�aFȮч�g%�%�"@콎p~�W81ee��A�e�X��)M��MV�)��Hf�~�0	V�Gq�%C/?yN⦃�n4Uk��uuWY�J�B�IXϋ��Є��$�`�b̶g�-��8��s�,7�B�j�6%��%W1���$���c�OԵ��eu��n"�ٸ���f��N�?��}U�9_�خl:q���K(���s�Iq�=t�7{-��������`�ڴm�5��\�,+��G��G����0H�X'2�m�Ҋo��� ��nLu��OE �Y�M��s�l R I魼�#r[C�j�揘���.��rXU�S��!���/����F���.�U��^�"��c��j�m���e�]Z��E$~0C<�UAN���4��Z�x-N⚾Y7&�;r؍HvP4��R�Y��rR\���~��\�b�"�n�I�kQ�mح��-�/ͅ�FQ)�cD��898�5��-w����ƿnv�w܂��;���Hl~�0���K���qa��ס�u�㬇jߙjkԳ�^�fR<�W��w=�ü�.�.V�7q����=��Yn2��.#JrlB�~��8�鬇��������7��tM��F��$A �����:��X���Ӆpw�,���:1�R�#A�:;BY�QA�z����SMZ�?�8�ߔ5�u$�Fab�����V"7)�X���u���k��,ҏ�l]�.cF_�z��w蚌�]���ƪ��7h���C�Z<{���I�f�~7����<[}Ի:S�3�[��xǌv�� ���]�E%9�����\5"�`��>��<��K0^���u=�Q)��0�"�Zχ�j}��?�n� p��`᾿^�$@�7���r���y�/`n#�^�]����˅o8V'gf����p(J�0l� ��j����Z��{����b!��=za�$�ԯ�٘->Ï�r���*ձ'����K����r��5P6�N��m��/j���T�{N�!�erĩ#� ���R�,T���j�co���Q�)���I+���X�� 팓�v�������,��_��Pݝ�/�/	!_f��Vf�	`�RBd���'F��p��;Qگ6חާ�K����T�T�U=� gHL�Nb��c�$}ߒI ��h��� dV`���
" b�t\g_w}�����M}*�r+3۔�$��i�;�s�rN��Ѹ���3,(�ntL��Ɛ4�p%���=�ٽI�NY��V�_e";��%_�E�کQ #�gͣ'=M�D,0Q�V���62�>/^F�O��*�X����Ȉ��+ݰ�z W�MǕp� �ǖ�ZxS�.U_O�?���JzQXH\A�x͚-o0��~����q��~��Ģ$�KcY������/�,~�}}��6 1� ����Dƪ�I{����_�S�7%����o��?��q�o�����n�2l���!�q�k��>�9��0b�H��~� ��f�(f���{~��vSU>��'�Gb�1��L�>��m]>�Y�j�Z�p`��)���&K��Չ���HY�,KAL{|�i�rM��t`�A
���1A�H^_��.��j�Z\b�m�)�����ߴB��TQĝ����n:��,��"/	m��t��N�@Q��>��=+U6ԍ�M^��$�������}�]G��O�v�~��Y(�Im�u6N;��D�HD�Q`ye�wR���� �Ӡ�!�}˫�Y(��Q���Z�C�2�9�$
�?�X�OC��2ڙ�[�#��,o[�Wo�f��zф�f\� ��~�+%0K�Pȹ���M9)3y4H�!VVs��{q�w����	Q@�駰�l��c-}dsY1S�*���F1��]�^�E��%���+��^���;�n�Qb�ow7.��H+�2,``�2�=s��ɂ�h��7���-n1˶�l��1ݩ^"Lg�����T	齜�K����v���b�kjI6�gZ)�ֱ$0��!�.T7|'�T�utd��  �H��B�z96:[U� �fvX���,���8?Q��$]Qʋ�T���� ����f�_G���A\5�~�Ę>0�p�O�9#�զۜ
�]� M�+�_�/�^7����Vu�oF�ڬS���3L��=	�B>�Uv�%��� 
�	��9jĖ���D�$2Ea����_�~�^��-E��?</�K'�h9umF�a����E/�^�K]��ط`2}z��4d�!������_vjV�C��P=���_"�{�F>�� N�X2����_��ϼ�z�0�f�V�__�Y�|�L��^�>������g�;��q�*�)���M6�tǊ�O�W�2q������ie�o=�6�Ӗ5�\����e�(��}�
�r��g��uр�乒����?��_K�{����l#��2�]��ae��j^A��2��a�����A�|V�$hK|�Z_8����aH͠�Z��+Y�y�Ibf��If�(�o^�7��2�J��ƧE�㏖>?��pi��
��nlU�E('F��PP� e����ʹ�l�D��]�=�����i'�?-�U��Ƣ�m�=����Uejh#��$g�#���נ�v>�L1#ⷻ�u�<NF� ���w"�������$��	�Ur��l
�3��t"����*�C���)�z��/>~F�k��0�l����h,��k�z�=���EDdvh��3(��[lߨ�[E�����磦�
�mmH�f��ʤ�á ��{��-+
�g�R�i��ȒB�,/-e9S�� C�;��E�4�T�3q�#�%��خ�`H���`�$}:�&��^�|[j�K��2�+ȼz��Z�0�\(X�?�Ӯ]��]kX u�Gh6;��z��}eI�w`���goj7.�<jPopn��U\���R#NU��Q�όεjGV+kY���O)rD2�q�z�����m�����[S�����.ْJz�
�G������ Ï��X����Pg���6�7 �V=�)�l�l�X�
0��fUb�3x�z}z�9�%��o�H�Rs.5{WWs��e�K���p�x��_�V%CF~�c�1.��;��&��A˯iwR��zK���|���t�2�ĐA����� �q�b���\����Z��kY����1�\���+�>Z���֖�7[`N�剞3��=�t���t��Ѫ���k���&����v����B�;�x���Gb$�����w�x��v�O+K�k"��k8�)%_٣���O�};������wo����񪌋�؞�����:h>x�Hd���Z�v4�/"�:S٥��V�H�na	PA`pN���؂�a�x��yEȖ��j�g�{����t���<��Ї�Nk�v�3·�d�@}ݿ�q����Itص��uSU���!��'�j,QC"�Hiʱc����N3��C7�E%�@����Ӈ#��/+g�b:��9/�cy�-l�D5�+	�ml�"F�d�%� ��]C%����	��q�y�]����&�������;w����O�R��u��������}��(��eH�G������]�Z�鱫��� ۪��V���W�x�~�Q%��x�(��Y�TD>H5�����n�q�����YqC����J��v�(r��Z��N�ݙ�$$�$�΅P��H�Y�t-��ȼ��l��Q�SF�� ����e�� �רĠFJ+q	/���']�gJҝ�� ẁ-h��w� wCbz�Tm�7�5�:O�ݶ�ڛS�{u~I�0
��S8/�<@��;c�"I�J"3@��n3T^M^�f-V@d�m6��q�oYlJs��ON�j� �"�3�j6<Z�_�T�l,DlY�x���%�e�탁���k�"�d�8o�^[[.5��_i��8�%B���7��@�4b��4�N��~7E�E"	^�c�`�u,��z�Y3 �.������M_#Ѫ��E�=i�x��bE Op��ψ�.��Dm݈5�����j��������JQ,(o%�nFH���;����j��nz����{q� (� ���?� ����|c�}�o9�yg�wE�e7�U�<�{�����G���*�u����ؕ����B`�r>?B�-���YDs�1�	�pC��3%#2��Gi�'�n(6�a&�L�6'���yVo\���4��*���5ɷV�g&��H�'�ZH c�R/n( �����Cn��!�ϣ��wV9'%����m\u�2ȉ���@����1RNn���|{e^zwc�_�� ���r.0	ʴ����G�:H�����U����ޜz��L#9G�P�Pd� Aѓ�h��:>2֘#㵩Y�Y�x�́���e�I	%@>#�r~�4T���O[�Qd�:�R`*AO�NrH#>�X"��E���@�-:���\$f�D�B#�'ר	����q�em��m�ҷ6�å^��b�<
�z� �>�,�Q���c��-ҋMf5.�a��[QR�hc�̞>2�f/8 ���� ٦��S�_$]�m~�S�q�Sgg?��*�#�1���װ>�a�\A��D}���y&����������h�2E#{c�������l�б��w�;��L53V1�#�Sjj�,�9O�G��#�25f[��
�i���}R8�3�"�� �%��Tb>�#�=[`����}4ZJb���$���}R�,�l]|��p��ۿ���L�	fX�,��&图E��/K�k)Z��r���ƪ�\�@���߿�U_�V�B�f�m�&��@Ы�>��$�� N��[��� ��yo��yN�m���֒:^QZ��*@���
���Ip '9��6��'��~�Gkc�j��[sv���D��5�n���*��F�&���^���ZmKvTJ܆4z� Ux��6��n[>�ao}�i����ua��ҩ���}�Ąz���?+��$X[5-(!�}��U�qCh� �pDq'���������IN�*�#l]_m��ЊL�0�g��N1����.]���]G8t���$��nI-���jgv
3��U����T��S�,Xh�?�MG����twx��֢����E��V�o�f� ��N��G�f�%�q��|M��umj���d���x�"@�=Sr#r�n^��g}�F&�k�L�L�d�G�pc��!��^��sY�?�m�q�G�ݥ={ڝ|��&�H=�O��9>*:��Ewԭ��{�_ƭx�	-�Դ;c�/(G�� ���U��{���_+Ƌ���h$����/��	Tgh�}=pO[���κ=d���*����pqݍ*�n�+D�c�7��c���=�wY/�Ե�n
�ű���K"��l�UR���~�T�W����lD�Z�V#���٬��wV ,��u�\rW����^!ǯ�mm9&�ԐP�;6@��h��#���]�WZ��
���l�ge[�U�[�޼��e+�;��bA�d`7^ޝ?z��_(��C8͟�7܀���S��O�[zM���װ�W�ůlJL�10 $v�Y�b�������u����%��`kP�_h�6X G�!*�s����d������T��*�3��έ��T�dԩR.�1����Np1����D�B�p�����+�4܋}"�p��t ���p�����s�� NK���T�o������Qے+q6<|��5zw^�~��bH�����1U-�71��R��M�`B���,ۖZ���/�4D�8+��:��,qT��
T-P��-�ɠ��lOLml�.����V�
��-�����^�۶"K,�fQ�V�|f�X�Q�!
O䡛���&s!$���+��F�>�GW��qb
� �|�v�:"#E\Z����$��߁� �i��XZ�X5�rQб�������mo�x�A"�2��=���Y.�V_	�U���:}�4�`�A�����Ýil�0�*N_�Бa���J	&��8��.��n�6��ɧ�KS��&���E�����il�}O��L��c���>V�K�n��9�hU���6(�!@Go8P�r@�q��鷍Tw4N�=�F��s)ao���a�{�I�F�c�?J.L��5o��;-��^	�f�f+S�]��X���k���\�}:_r(1/%�a��z�k:�3��U#��ף����G����<d��m+ɫ#%�I�ī&�"��3�y:a(�P�q���n5�������u%�V������L�UHac���J.tGiRvV�O���lm��>�U$���V��U� =��*�{�Ǣmő-E.cf�}�ǚ���E��YA%r�F�9�"��1���tw� Dq*�5�`�;_�j�Nm45U^3�}�I ?�z�v���E��H>+��%	[_�=� �mK�[S�L�_�ڔ3d�g�~�)eIC����"��y١��.���mӂWI<d�f�Zj˖ �p�ӫDsK)U�Vv��B�R�y�n��"Acecȯ��U�~��Gr"��1E��P}�2����m[?h@�8� Ǥ%8�3Ir�'/3�j�AA�]=�3y�}�e�,��?�� W(���k��]]lq�:I�5k�?��r��z�ӥ��9P-��f�Y~���?A!B��dD/���2Kv��(| b���#�u���T,ig�kh��[[��K�1y�N����)��]_�_� l��������K�'�^�|� ����y��s��&��-����+ٯ�m	ol ��"�P �IR�2�����~
K�5'�9x���w���2�5hu�(��p��H��ҀR9�
�چ-~�u]�9�~ز�s��/,����8�L:�1���kw}�)I��{:ׯV9��v?q�b$_���V��$_rj<S�*6�6{ĂX�n�Fq���+�\t���8��M�xMmƷ��i�k.���� 1~��S@�����]3���S[�$�Wv!@��H�z�s�l�� L�[�r;��5��g�]x  O�{x����rM ���@�p��B�~],��6VF�bt��Gb�<���8�6�]΅8��'��
�k��p
:���_C���J��t\�E���)k�����h�W|�P��^�= ȃT����n�@�y��r���O�����_�,Ka吔�P�B�N;���włF;�z�Hn��Q��k�SN�5eU�+�)��z�����_^�C.׋�m���	���U��$x�������WZ���\�q�� ��(�q:YN+ȵ�p��n-��G������=���J/"@Mnl���� *ju�Y5Z�*n.nv�h��'a��,��+��׫l�#�!@��p3ָ)�s,��V�(�D�-�o�b�AUc���} ?���1�;�d��v�m�w_iv<��V��f4���dH��䤺F�,2X�'�w��?SJ�Ʊ9�Hv�oE��
�ξAd�	We (o E���c��$֋iE����rk\/]?#��k�J߆�N��Zh�ef� N1��=k�"�|T-y��r$x&����m�_a��e�B�d�E� �U�(@z"�',Hs�ת�\��/9?�� :-�� ryo.��y�o�wL��Ӯ��z�b&d�C��''ש|�W���e��)I����I�	�pS���uIC/9yG�k��kv&�1����`@�{eT>#�����T���K���>]�}DLu|V	��6�8f���Ҷ[�����H�Mc�%3|ݩ�K�w�>�_/�
���E
�J�%���Ֆ-�P��U���-��[	^������{U��弗���g��_d�(�?�r�����q�bS�SU�j��$j5~�s�����[6�e���n���̸ͭ�-W"��H���Mt�`|���㬜�7-�b��&���M��^��0"=R$��/:y�*�[��}v�^�r'j3�R���2��L$Nc*�P�Q����@3�ΙbOU�����|oNo���k���������óc#�܉z���>�V�[�4VKi�pW���}7a�OUj��0�~)�E��6�#*^m�b�}�L�9f��u�!�-ڌ�(໮M��fi8�:S>����vu�����]#*H��=������}�����ǖ�T<n����L=��N]%Wb�y*}z��}J�@&,��9�����O�=E6�NijZ�(��$sw'U����-���Ia~zV�%Q5}��z��T�lH0Zds��\~ΰ��2�lz�I�܂c���4P�SYp1��yN=�sh�1[�>T�+W���O���D7�jT�0��?*2�{wu�>��O�rZ!y�Il=�X��䛽��)��DVVU/8��.��,�P ��Ƨ_f)V̻飙Z)#���eq�R��� N.������?�=V��!�����W�\v���1��1̊�=Xz鎴ڸw1z��,��>!�w�a���OģF�����%坤��l�� zu�h�e mV��:��O���!�^��{�Ō�y��z�O�� ��}RM}I���{/�׈ч������S��#=q��%'�8�>cz(��X)ɩ�2S��s;2��?��H�:y�[�j�9�|gX����D}�D�)#6>���}zCl2���<��ȃ;�d�0½��J�>AQ۷�Y@�HegoLw�Cw(�>�K���ɪ�i�C"F�Uc-��!�zIa�$�L���xL*���	cY|�k��ydl7o����"5G�o��^�cSU��v%�_�����yF<I�� N�`*T%s]�$��u4�<?�M�m��/X�
�:�����fw�S�S�:II�U����KQ/��UT��ė�:xP���?)۶{v��3FN�lyȚ�p�i|p�ٱ]�noi@��H<C7pOB�:���-�ߗ���fp�ݨ�n\��g.�Y�k}���˜tC�bUr�G�(|�Y>=�%z+��rY�Zi#
��k�#�z�;���'�5Y��R�� #w�~E�5�$Z����y6UN;���ޘqȐ�<{�����(Q�׉��-4q))�}�-JI���C�IA��i�+fT�ܐݽ3Y�b��]�88x_��a�ޝ�2���˸�kM��m%���E��-Ǔݢ��Br���1�;~ރ!`��tԶ�}~�����;Q�il��>����=:S�m�� �x��Y�cKy�WA��evo�>�}	�@�S1.J?�}����%����f3�� h{��,}3��c�E��3\���qN;n��}W[S�k+qZ)eE, a�7o�=$��ɨ1M�#�Kbη�q(l�F+2ӭ����$.Goצ���F��1��� L���ߏ��WϏ�3��أH׾>��-RM��<�J��뱫J�}uq���eJ�G�̐;�~�)%Cu�:��ζ�Ȓ6<�ó�c�I��d��+�RZ����2�[��v������"��k{�̣�8 	F@����M����iM���w1��ޞ��g�����~�N��#���~8��DVF���.ڭFY�[s�4��� ̴=��:�b:&�@M48��ZX<��q
����\4������6��*L'�x���ָ5z�6X��?���v �����E��>-���j�6|fZk��+�k���d�Z�P����b:,(�L=Jb���+4{mt���-	p���x?����dbغo^W�)Ób��j&*н/�s���'�U"Q�E[��~������X��:�,Do3����|Xv��{�a��W	2!S�,�W]��Xv:D�Z6(���bH�>��B���,�z~?�	y��-TZm��qT�f�Ԅ�U
g��,�FH��}z�r,�[���Y�>�Z��?�x(F���Ư�B3�=:�ʹ(r>�����q�QIxW�%�D���c�Nߨ=�F7d	%l�� 7�g�ec��&��>v"�m�7gv/?���4�o�C��ۮ���@��E�4H2��V��l�."������-~Fx�]�D
G��|秮�d�i�.��r3ö��ކ�e�F�'��X�T�-���8��;}��k��]�����u�m|W���>�1��s�4�J�w�q�x��˳0Ps����Q�H�sZ��V��z��7�����%YkN$�CaϽb�*d�� ���q�B�r�B�t��Q�2�2F��ku��r ������Ag2jd���l���k����]�rjPG4�A�#Y��1	���l�=c�¡l����Iu�׳D5�Mg򭈊-�<Ta�-��R:�]V��g*����rRK�쥭��K�ؔ���������r�?�Êi*��
�y�|vx�˭,�$��c�>�ת9@0O�>�U/�4�k[�f��:�����l�N�#{uk�1���Dd�r[���z��� m-��e�_��U� ��n5I�c6a���U˞Ǹ�:�r-5��д־���6��2e�䞎�� �_?�[e�,�@��?�v׌&�n�M���(lF�ޣ*�k�b4�~�`�����C�b*�bf��eV�7i+wby$#�rB�8� ��E�� ɜ�C��� ���`��ףzX�*�}Ĭ�H���F̽!s� $\f�c�����Iu�j��9�i\�er���Rg�X��ԵX�
ܷnHiϝ^�f6U�IFr�v���9�Z�ƞ��噗����DI*?���%�q���$�W�^��/�ĸ�߂��%7J���7��h��3/|w �ʺ*�n^����*��[����i�(젞d�rD�	+9򎬙�S����}X*9%�����g����4�j��a%k�m�E`0]R�bG_N��YD����M�/�l��񡰽��>��-���2�`|�,�_N��?�:�l��Z?ʢ�7WB�ޫ��v54��zx"�� ���b2<����pG^��d�q�_�g����h\���q˲A���Y�4j��O=ݓ�2��ϡ�Y'ɖL�{$ԕ�����Er?��{Ƿ����{�+��@��1	&�k�E�S�}GM�����P.�W���i�uy���oaY[�{T`�2=C���8�RGY�nC5�LI2�M%	xG*�Ž������2^�xXd�|��B%�tn3�?U�xF�9'�_~{�͛7n�,�0��|�>��u�1��� 	�x��K����K^��$��j��*Pg?t͌(8 c=H��J�j��ߎo�u�lp�6㖌Vf{�<�3��H���NO��2�#mS�N�� ���3�AM��x�=	S�L�v2��Gn�h�s��e�9jբ!X���8��4D����ܣ����Zɶ�H�pʭ5h�9�6	�e|c�s��n��T��d�/ɜ&�N_���1'�|?�,���:; M�EB���3 ��M\�3�/|wY� N��RF&�+���1Y�`l�[M��5�Ӵ��P3:���FFOLHY�\SW�+���W�~$(e���d&�I1.0:]�0��A�Y�M[]���3��<z��W�{�ɂ�zK��]nL(���m���y�oƣ_Tk��Y��LŃy�O���� ���
�j��(�2Sᒼ��F�6���1�ǿ׷P�]�A�r~y��,0��^QZy,����
���t gרB#@�nu�}H���8��--��h���%�'$s�NA4*U���^�+S,�H|q��eU�>'��(t��kϗŶ��kwƁzor�_`��p���3��~ޘ�N�׏�T'������'Zt<� �y�Խ�;�d��Bt��٫�d�|�8���k���,x�# 1��OCe�n�sʴ�S��b�)�ْ�5%�.Ł+� 0���H�;t#�C �e~6�OVo�yMɄa����{�d�aG����gPk|c�'�� ��G)���[����Af���M 2LCc�m��.؎'��;�"fv��6wf$�ޕ[�Le�<}���?����� ��^>��� ��z�~�[�:�/5b�7��8�Nw��,N��bon�̞�1ܖ�t� ��bjΟ����	yg(���k�	V�G��1��"#Ft&o���EI��mZ"�^�[+�I���:������|n�#�P�ГcN�u��W�]��ȅ�o��9�����$���W����Q8Λ>,^� ��)�q��Vq�	���������B��j��U��M�(��������ֲw^'Ni��\LP����q��C��h� ��\��P�z�w�F���؊Z�=����8��,�����g�:Zp֫Oy���m�[Sѩ�2��FX� �9=� C�m��`�ګc߇{u�Q�����__#���ɷP�r�_���m��l�xh�>>�#�~�4H� &) ��ߚU�R�<�c��Q&�c/�������Y��� ���;�{�N�WW�p���� sի��l�]u_/��<���=GT��EU�H�!_\o�~Y��WE�O���=-���cg^#q��������~�uF�*��"�Wξ]���R�I��!���h�x4p�l��G��ZD�T_�.�w��"�}^�b��pĶ��2L�£��ğ���wuO �J������TJ\B�؅�/fk��,���(�`s�����Y�U��_�k9G
�kw���0V���+K�����/8�+,�!o��r'������,�i�[ �xh�{�z�U�kϜj��c��u�3뢨m�Z
��]�(¹�BW��[,H��b�,�+�*�����K31�Y�P�⤼M߭ Ȭ� b��-����{�����؍�jЪV����x�1��=d�Ї[8�[y4�F �d�����]�yc>$���u�D-^+��斵���cw����ؐ@�^t��<<�Q\�S���A���y�٪����B��ݒ�U�om��$�=�z��(���S�\�?_��]�㶤jqձcc���J�� ����I`��ʻ�9��O��\�yu��ATU�|?��� ��>�!����gд/Yk� ڦ�.+Jz�9)��
J=�����9��n�oX
����j+���^�P�&�D�4`e�����z�|��WN�6��j�+�bR�Z0�bB�O�(�� ��-���<��<ϒ�/CȠ�_j�O�6�R��-v�=��}�gX�/Qu�?^����?���v�EpY����A@@���Y�R�`�U�o��Ӟ���ٖ�	}�P���ȗ)�g=T
��^sM-��ۉr�sӕ�{�	�`��Ied��:�	�\��[���;v��b�z�8�i�����=�
?�������m�UсaEY� �����z��+��ma���)H��P�2������GM%W <h�>��^������ix��e:�P�A�lg���r�Ȗ[s�v\���v"�G��Ȝr���A��
����x����S�:�8�ح����2�
-�����64Pӱ��Zĕj[wh���ieA�(�׭�,(�E��]E0�Z��x@�G����k��V�� ����-�S�4���/��H�"�vrG� ���ힴ���F�je*;�\�쓘l�6?$MR�z��>]�K0W8#׷[v�B�ȱw�މ�G��uso���χO4�I���Vh���###�a0i�N�FfP|ֆk�ji���nrK^1[+dM"��a�3����rX �f֧Gy$�+l� 9��_�D��Y3?��q���Ȁ<���|�ۣm���r�§��� �P�\��o�ږ�P��u�\[���ܸ=�`�#|Kz��U��D������o�l��������`�"�_#����~��p����1�x��߻���,5�v%�T�*�̟£�Ж)�A�5.?cSb�sq�����j5�bZ?$DP���$�L�s�N���J�֯�cX�7�eT>=���1Һx��^�^����Q��Q���@纀���p�va,�~G�)lu�6��ک$G��~�wB0?�^"2�8�	$Be�:�k�j�&�����u��̪*���=<�U�b]�Ϡ�3�^C�F�sJ�D�@�2$�=On����EM���D�Wm�~�5�뛹�:)Ċ��r7vvIZV�t�V���T>_iĒzv�:��U@5HM�Ora���G��d]�e�FH+����S&NNj��r=�����q,�[`�%�i�W<C�z YЀd��2�59.�q���D���/��׶�^X�!#.�V`ʤyza@���7QAl��S����d��O9<`�<�$���'a�Ө�l�[�y^ߊ�䦬��pٚ�:�d�p�-Ï��~�"C����xL���yN��0X[&��ц3"�a�@� �������)��ċcm���!�OZ\^՛��K�	��l�~1��W�����'�A����_i"9b�`z�.�# �jx��eri��nޚ����<lOv'��Nz&8& `��������El~7��3���<��s���{�>��Ы�;h��wY6	��r�SkJ��Fݙj��`Ҵ~�t���K૛b�E[��[Qt��n�ы��[�j܅%t��)P��+�3��:�U�D�j���ۍ�ۑ������aya��$ #Y�`��C�B1$:s��㔠YF���+
�Y䝙�����>�@�-��%�Mv�95�8��0Wu��� %���c���}3�u\�y�D��'����BNpG��� +h�(_��S#�8Y��c�ta���u{}z�'D�G���&���m=�}LM¤�ڢ1������s���d�XQ ,����*O{�h�-�_��l 2�����R����9���=�#8�R�����s�åppJ$��O��e&Kz�P��T�!�5���,���%X�zy\��Ȣ3�J4���&���b��\Б%h́_*B�,d� ��L�'��/J��4z�*R��H����^(�@�T7��3�-�K%K���R�>̍�ۍ��H�&���%�x�w��֞).V~Li����ߘ�����^5�~;Wf�ݚ����8V��AP��0.���z��3�Ub�*�� !�ܛy��Q�8�6�B����'��j�u>$�� �W������uZ{sE�$!�ū��(��L2r0�������bY>|#0�̸屸�)P�<���;�E�`��#��� �ߪ9$�OǑ2��Ȩr6�g��y�Mj�N��(М�"{�?��� N���%��'�������w,�Z-�4mF���+�*��~+�ޝl�,<�^�U���$os��������<�e�LN�8�Z@9������ 8���s{W���=�ƓX��NR(fT��
d�׬|��x-\HЭ����:忨o}�"'��8,숣��5[]y���r6�b_}�fIv6J���;���î��z�K�V���OCC�o�5�ƽ��H�M,��p�i��������;����������]$�0�O[0��f��!1�^�3)�N;}�}z��}g�^emO���$E�z�'����V��X�ǆ=__�YnDoZl������i��W�G$)�/�SR�ʆ8\筓���eTA�u~�Cc�޷^�[I�Ú�2���8�1!I�ݿgX%�.FkD&$L�@N-�M��%�P=J����=!:k���|󘲍�ɢ���b�F� >o�'Џ�uф��u�ʥ_� �t7� ���\��׊����z��'���"��� '��Y/�+8���a��
�,u6��U�1�~��2����'�ؓY��\�`�bI��-h���+�{6"S�:�{�x�s�^�p��Z�<~�+��i� ��r��X�$�
�ާ�[`	-|��w���ߡ��F����k�:�o!_1��ݔ����#�n�IѹcE�^=�G(��u�%*��(ɷ�lV����)M����'��=\g�9�y�������p�nF�Is�|AU.ښ˪��R����ea�H�I{zu��l  	-�s��.�2 |� �Zo��^�I����}���ڷ,�3HQ$F#8R;���r�Lj�^��.�mH�����S�9lU�с �F��{ۮQ�����U�� e�%
	oyB��M�sN`��K0�e/i�W^�L�[b�I~ؐ���3׋c���D�5��J����c@&,r~�u��%��ȫ�a��q����F�m,�C^�
��Z)�_m|�k3f�� u��d��у-3��E���g�ϲ�u�=�}��$� b �����\dN%b�F!D�����r�k�^I����� �1�_�NA� 'Ƿ5|����"�r
ھ3�].�mŻ��!�����R@�I��G�Nrq�:U�Q3O>|ei�*��3,���:a�B*xw�*=�=���Y#�Uv�f�?RO~��I��VK^����p]�U����H�тe�+O<�+{�?r�ض���-��V4{>����~3FV�c�|� S��ۡ��w����p���d�|n�`J�U��;��l��B$�Tܳ������Ǧ�z׭��ky��[`#� �"6BJ��M&T8#�C�m��F�T�9�	h�<�Ed�����.=<w�u Vj��� �����*���I�'���h�a��ʞ	c��}�E�^���[;����$�B̬K8�T��[���@�R�Q0kyxmp'Cɿ&<���V2� j^U 1���;��F�z|�k7��t�H6S�֧4�C"��3�����QH�zf�m7�Z�d���+2IFR��с�9��~�ӥJ�����zj�!����QHvU�s��$�u\��`�ͱ���WA����,��V(����\�Ӣ�Vo>H��9}����֝r�{�#��uxQT�1؜�� =$��q��K[>O���;흸�d��ن0���x�`2I'��\Q,�]c���h5�n��{�ՆK�;Q�ZEO'��N�#�a� Q%��i���h��A��j��F���a1I���z�#8�F�a-��m��ۮA��h�Tk�#����=����S�=Y$f.7�u�8���9AOr�����c?���B����w�v� �������g��� X��7��x{���~.|<;y{����tX����Y`�C�gM��c�槰�<V%k��B��H���'���H��ۜ[U|�O��O`���I	 ���a۾F?gA��=�&�_�,5�ča6-PR�� `w�%����=w����DZ�T�m�L������d��>D��� LU��R������U`ߊrq�����rQ��pU�ޖYxzX�	Z���,�Q����u"C�.7D/����՗k��.�cJ��W#�F�W1�>`����={{Y;˽�!��֖kEj�X��\$1I�~� �R�g����Ǩh5��So�oe+��p���!��a$��0�ǯVQ�����z��pE��eb;�u��׹1}:Q ��H�LR��4�s�J<�Yc>�I��n��E_�߿P��H2���6�����޿MEm �j#�i�?"i��1��P	�s��N�@a�V�׭m6�=a�=�
��!tg���Ol =z�.��+����=������<+n`���Wt�H�  /�G��@'��wy�9 ���{�9q�x�\�o����)e�G�/�Y���Ps�9��h�r���n�l��+�-�/��즎��-rMn��t�U2�b��FLk���?S�<wrtG&��ej����z�
o�c����l��\�$}:չ���,���;��4�AY����{=6c�������dvS�r؎��xR���� SX䐳��  o �?~� ^��e�-T� #4�_�j�� V��1ي8�p���F��=z��,:�\�z�IT�܁�a���>�	V+��H������R�[��C&��&����:�ޅ�ϲ�r(�,�2�^�*�!(��%�R�`�v�Ɂ �$���YY�6�M���$�dH?UO�u[YU�� �8F���� �j��)Zk�ךof��?�
�@8�@�&T��(W�_�[$��&0�U�����b��x#*��1ic�v'��$�P�D�|���E�9W0�?�ؒ�ל[�*ڝ�~�U+y�zЯ���q�l��P	�6������?흏��}�4��j��j4H�A	�ʌ����c9g�W>�B�d��|5���X��v/�r�Y�Z/d$KI@�G%�rӢo�J8�^z��ԡ��zZ�ʭ���@�,~���I
��/�NO��б����*5!k3͉J�PI��vA\���M'�&ܒm��4ܓ�_��,u.�-{33@��!Ǆh���%G����Fx�mw�_7�J~'y�4�G�v�Mj������a	��(݈p�� �=���j�h�t+����������]�Z�ej�"���?��e�����\u@�&��] /+�����u��ˊrV-��<�Zѵ��Zy���@-��#
;�[�I�`�m��2�~/���[G�[�&�NUn�׭�A�sN���
�ż|[�'���<����Cv������HF�;��Ց� ��W�2�����o8���׍��ͣ<�H#r��k��I�e��#�=y�k�d���-�t¥���w��x�؄���q��<�?O�حg�<;CE�׷M�]�H���X���͟�^�Y���ˋ�k� ��+���.��=.�b�A�l{ҼH\<�k�����M� _5���H%~/%(���p��l�z�c��ӫ���,ӏ�_"p�jr-��%��W�Լ�D%r�v[0��I�r��3���wd+?m��=bk�޷b��
Q�A����M�>�L����[+����wL�j�2���k	L.~�JC�����j��y��sk562�nCǦ�����G\����Vuf�`H���WF�<��u�v��6�/��� .�	m։e���^�D��ޜAVM	M0p��@� '�7�K;��� �`�/\w�ѩ������X���R�4�	&�0�-�f����''��6ђ^�|lj8���E��4>u�{�ĎB��� Z���q���N�E�GҞ5�GKoSY�����Ү�`�Kf�vE���ɜ6H�t�� �)�q+6��҈�2Zf��2{���3���C�8'��P�0	n}_�k�[��ⵣ�^v�Ԡ���8�&2���1WT�E´�g^v�.)^���Z��HZ�Lyy�(���oۏ��0J��?��6�}�i��%ue�A�s�Glt_��2e����|��c�c4@���p�s����9ʴu�;�^�~.�`�+�{:�(�d�����FLʀ�#�k��{	*�<�g�i`g9�����
x�9C#��i(�h�V��`��uV�@�l�G��'�dئ��	�I��l�<[��sJ=JOr����#-#N��U.[ ��M� ʯV*��%��j�^o����t�%mˎ��%lI)Uw��vνu���)�N�?i%d⬱;0 �8���bG�`�U�w�KN+:�� ��ga9_�u@V*_p`{��z��)������LӖ��Y��ą�RFQ2~߰�A� �ߡ#��M��X-o>E�o4�i6<[�-�ޭ���E��#Mf,d� ('?��5)���?�����Z��纤��Ofh���D��y.��S�����9�2t=8�(կ���Պ��ةcUY�U#²�l��׿V9w)H�~�� xk�vo� {9�<b�UR5$�0Y�?l�z�\�_2��u;���s����~CC]t#��`���B���h�sF� ���S���Ա��O�Ow�||����8�{���t!~<�kG^8�laO&���dPW��*���۠K�� !Iw��4���Du%�Z����dR�-5�����b�� JKE�vz����3��xY!�� ,�1P]�6{�N� _�[��9����q�#aɌ�^4Pǿ�q����"��d�n����U�E�#�C�H�2W4�!�s#2���*<~��$���2�9W�'�=�y0|b��[�9�`�8�w�@
��f�w$�h��$��t{�Vv�PAv�G^
nWܺV���g� w�u��v�b��%'̵5��m�F̥��Ų\��N����ַ�-[�5���� qd��i�
<  ��v$g��@�DԺ�s����\�uk��w�u�z���~�(nR��� g5k��i��ҵv�B�* ��z%r�K�'p�c�V���)-��{�%8hB�[����I�)���<�@�Q:��a�,� �mu/��v��ګ�U<12�����N2}H꫱��~��2��X,�Wj|��pߙ��j���M��U[��$�T�61@<ܐG��uD�����1V,�"���2�a�+V�˩�'�?nz�ڞ +=褥���j�u�����E].Y]V%�y�-*ׅA�Ğ�ٙ5	E���/�^S�eikq��M>�lu5-~d��O�:����g����]���Y/<������i@~(�Y�F�-��� 9�Ϩ��D��R%�N/�~H^Gfz2q*��6§�5kRj��i�W�����\�D-���je�j�X����{������\#1R<U�ğo���dV�xb�Ǚ��|�c>��%�A%�}��j�@,���R�\��$�OZm���v��W�oock��6�k�Ye2�@�b8��I$`�*� ��qӐ������}����.IY#]����0S�xd�v�Y8�O�Q�5;[��*�G��e�A ���G>�V�?�
zQ�M�~t��#�鵑��g!���|<�����鎩�b5te~Y$~Y��sy�þ�%���k�`��VS��_/���'�=��6��R���)�,i�_�4��KfM�v��s$5�3��,��Q����׫@�S2�+������N��u��t�
�UU<��(���$�����;�(�j�g��nsI*u,%�J����#n `�:��_:�Ò��Ԟ*TE���]��"�"��"�Cvs㜌�ޝ�d��2������±�Τ�F~卬۝�@�:�n�@2'����:m��H6V�:0UZ�^��ӿ������/w�h���M����bƻ`,�a�� �`����۠f��f˴�^��NAp����Z$�;�1����p�U`!�$i�;I=���w*��d�4�W��R3핞�L���:XD��"^�<�����lkq��g��,��'�FX�c�R��)�;�y�{*�6�ϐ���v�����P�d������>�,�DӉ'�����u��j�pzl�{&�+�A\��0��`�s�3Б�q�����o��l���5�ѐ�e�����Z�ơW����
$��ж��U^�UQ��~���8(�G�ע�t� ���kֿ�-#����҉T��D_m����;�X�3/FK�Ç�~ucF�>C���sb�}q�k�K��+���,�2 z!�d� ⎭u�'��?�y$�����}!=�NOGj-,@���/&����~C�Q�Sb:�6�[�W��<�,R
}O@� 2-��� ���RF,���ҽK$<V��1$D���C�FG�z����ȩ�՛"���%XP-��1�ש� \����c�Ik�K��凎C��WmŘg��r��)����Rs�t@@E��~��"�]��P�<�;m��[�퓐{�N�˵Sq�5������p$S���rA�ȫx���>G���%��2��ҋ�f�=d��o^� �RF�DjU��N@�����\�Wo��g"=���I� \�����3%"�����,ɢKR(�W��W*	 1'>���)قR�N/-D�}架v5����(�VUD�����#�z{����Ɲ�R����!l�]�lk�^N�$h��c���oץ`�L�>(�_(qf��q�n<�)�V
����  �rwA������@�>��]v�+����*F+ܲ<���"O�{w�B�F�U�R�'�V��w]O�y٫�kcY�����q�� ?N��i�� j�X�_��&�g��1VV�f�X�Ϡ {v��3�.�����gm�����	r�)E�s�Ʋ�BA�w�:>�D���ass��7�������z5� *��*��� ş�N��@�b��[k((�`U% .v�����z ����ב��kҝxi�zKc`|Kǀ�1���0Xv�עd�b	\7��i�����{^��친��X�W����%Jg�]wI>N����"�S̪Ͱ g�T� O��A��X	X���b�שnnR��,��2��3<e�� ����T���)�=o"�SMe�a��̀�OS;�� ; ����
H�j�\����S���>�s���
�B�����t�,���?��g� 1.���1�7Y�_����:����]��?Q6ۉ��O�6�Z�KE ���`�z����Y0��UZc���������g�<z�5�G���->�tC�:N2�?"���Ѻ@��AÀ���Nڪ��E�� @��Uh� I`��\¨#�E,�	bs���b�R�X���i� -C�]B�ݗ ��~��G������Nx��R����4է� >�H}0}z�@P�Ex�!��Z�a��x�UT�X)�,0��.>�۠Bh�4LI����2�ٱ(e_*������'ש��w�K;�+�}��]��Z���2jJ����)��N
~��F'"���.&s]�6�~Y#����~�Ϗ��Q�1A����l�}�QR�G2�%x�~�)7s�����VM��(���nts����Չ��_t<�f�3�����~�.@��.�}�u}��︋��$�aQ<QT�6��c���d�iJ���#���A6�S�����dOn�2<��������GD�nK��6����i��D�Y匄����Yϯ���B����7ܳY���C�e���CB��Dc��'|��רQ��=�<�:��;ٙ��%E� }�i��?\�=L����9ť�ڻ�NC�g�H�]��WxL��Fl�6. �=���T!
ܭ��j3���y.�VhL5Я�\DXI�+\zd����B�3A7z�E�F��}�j����]x`ހ�X��˫Y���.�+k#�Ss�`��D�E5`Y��f��BGs�"�R�\{t9W�C�9�W���{q~��'H�
"�maU,�;��}:R�+$��CH�OZ���f�d�]��ܤ�!e^���FE�.�p�&�+�4lN)	0��\>�J�� >�t% �4���CǇ3�jkS��M^���ifH�B�Q�y<��*���C<l>E�8���Z��h��Q,=hK���-"�oO��ۘN-����r���V�Fd��9ǎpר̔���'�����؎=T�4�;,	h�Cx��P2{����j�&����+>�	�TP�R1���UG���h�Ի ��l��6V���M�n��]1�Pȱ�W9� ��wE�t�s�݇!��m���|-U`�7�p����+K�d�lg=�P�d0V�� ,q�׆I9X����b����O���h�O΢�&J�>Mg��
��JN )���?^�̀&5M�.��I��b��䥶[����dUp��ٱ�����1�Ֆ�HrH� `� %��c���Wx���z_j�^tJB���=��>�Xho `����$�!��r2�*�Z�FI���-�q�����ߢO�M����TW��wҶ�5��h�a+d��GQ��Oa���4����h���l�bU���6���rs��^�"�:�(B�_C8��L�V�{���1���6B�����8�ى=w#(���xj�]?��-Ă/�V�%�ط7`UTH�A[$�{��PN�I.����(��7�����^��Yz�q���ؒL��P?`�њM�P������j�=,���G��ufqrG�)��x����t&4G����k~j��j�����ޱ/�Ϧs�	&���G����cE��ۻjC5�iTPą��1����� RR%4b@�O��^�� ���R'�.�U���#U-*K�|@鞠u$����ٵF���8�n�aB+B���I��<)+ӥ�"�D?j��vvܺ��Ϸvm��Q� cD/A��ܟ۫�2A����9+G⑝�߷ wțȞ߯A�(p�;��n��]���yU3n��v�� �%�A]eŏ.����Ӧ���p�1�$�I������;��>>m+7���+��C�7�9�8��RI$܈J?�il� ���& *�K�8T�ו��_�Fe��� O��jbT�������rAo,~Οeqc&V�]g���qmx
c��� -N{��j���Y��?m?�Y��S	c�ʲ殊�� Gӡ"��&o��v�Iz�'�W�����`X��QAx�L|�2N0U�J� �� � >W9��<��#'$,ps��Q��b�����n,]H����K�����]`e#���7`��W���q�����w;��*�����D���UX�ܒ÷DH%�P�S�-w
汬0�xҖ�� E��( /lv�;%����s�?�*��S1�*ֶ�x�r�A%��l������;˵��GzT!f��˷��;��n|\��5��{ƨدW�-�ǵr[Q��U��3r�J����sՒ���nJ�&�T�UԷ��c��Ib�{��!|"?|��ט��� `�j��Y��r�~g1���b��X�oa����o�t@%uG���k��ca���J������/�T�s w��O�����*�a˵��1\�OI��;c�J��$%q��� tX�)��7ԇ�%�n�� B�����6��H�����T�.��)~G������?��?� ����N�\��G��� ���zef2�sr�` � ������	�,�+�i|{����t0��e[��>�ۨ	�!V�c��O4��on;���m!���l�c|cN���TM6����ӂ��g�)+��� ���2t��vz��KgG]j��WZ�z�Q�?2ߓ3(FV��� ��F$|��	����r��<JUa�9#��c�fW{��6�U�f��OY��4��!�F�s�����$f�#�P�\�Y�:�45<��jt���1Q�\���Q0�x�L�����n��-pͽ$� f�MV:���4fQ4т��\��v;��NY�y��L����N@��tR��lnB^�
�βF$V��@�rU�k��VnH%�@��rt�}�+�x/�k�b��D��Ŭ�$�g����z�$����;��l�}�ǣ@�i�2$M1���G�9��($(����zv���/,MI=��*@?bHN3���;�P�'�j(Q��k�5����J��NN� ^�U`��}d��g�j1鵰����<��ݔy7�����P���L�n���
,qh)�����!�e�`��`�ϯK�Y(��T��G� ;�3���l�$g��Q܎�% <���ݭֶ�%��Az}9�P��ΥT�&2�FR� i�#��7��i�v;�ϑ�v=X?�ƵutvU�r$�o�9#׿B:"�S��.����'2���Vrc�hP�ǐ��� oc��?^�Ej�����iu��\ǐ�6�STY*���,�1UN@ �_N��#mÔk�2�VV�{��YZ�],�d�*Y������:�@;yłk咾���a�A�����������v�Â��6yl���H��I�\��R}:����_��A�fK��3O,��x<����l<p;��	e���>/^�k}I7�Nܑ4����#`<�3�����0j)�	�Q�4�hW]�kGtCU�# '��}z��HԦy_���?]@�DV���v���CЦ#����;�׎I �}5"͛�@�A�TC ��l�w�ł��$�/*�w�ySu�P��8�b�������=q���VnAuܗK��=�O����;"���� L�ݳ��&Ή1ݛ|���� ;}���}?,�=��ʤ�eVE�9��+��'�=�Ӥ�d�pbǨ��q|:�L�u0H�Z^C30��$z#�׫�*!&@*�I�]�Z��;IjHb�*E��b��8Pq��P$��A&��u��(��u��iM$�E�-o���w�@jȆ���V����ޑ>��e�T����`}3���IH
�$�;ɷ��ݻc�y�muū�ce�����XQ�ǒ�x�?�=Q>0߼�S3���[o�sg�	��C�tR���Zx�=n�MzM�m,of�;y�1�=h�2�	 G�8�lKR_��[��J���ݼ:tV"��q�"aW��F��{Ď�p�H�/ I!AǠ���e�W	���K�MZ]��wֈě
�X��(�C�����:&,��mG��J�ےi䆳%��GFy���Y�{����F�hC:U�ҏ�yj�����6	��lq���4"I8�6�k�F�?.�:�Qy*�+��i�tOm������1�랈D�Ԩ�-N�gZ*�9�����#�Y��1���f���	?�ш!%u�G���OYT�>V#3xI=A�����Sړ����� J�tI�+�7�zM%.k�$��2�~ɚ�&5��J
K9=���צ1K��UX�||�ad�˹��D<�2���eb�Ӫ��a��[?q97 ��iR���p�0<�X_&!@���@�tF	;���?��ܥ�}��w|�l��v�����tP���I����FC2��Cg��ǜ&��56x~�[�O�i^��|��e;�b�׮w���۹m� ��۶��_��1��[�����(5����R�ZR�������C�]g6~��"�������+]�R(m�f�Ƞ�:I����:�!�^/�t�CGN2)h+<��%`�q��N;�n��� ��:�	�ǐ'�<ԣ#��`O�t��Pج���G�-�{}2O$n�Aj�rT�$���2"AЈ���J�w9�1K�k$P<<����<
[�>4���F�Y�]^*��RC� �#��G�����%eW�7�%Y���K�<��	X ����W
���5��6]�vU�W��2��ߛ��7�{@�r{�!0��~M����k|k��Un4��RH ��M�h�M�	���><�Ta�-*�� ��{ќ�����-5�E��j�����֒Gm��dB_%PU^|�	'׷O�C�*���h��js�X��ϑ	�)�w&�.u�����[���F�N�GR��?9dG(ʢ*�Q���ݪP���N���[�����X�]�H� B
��\�O^��	��V~/�>A��{_���㜧aQdrA=�+��IJ#�a��#,@���w����/.����|����oe� ���|=?nz.R�.ʦ�|���q�~���Z�ʨ�F(d *����K$�� O�����~/����q�v���蔀�B�T<F�S�%Z7۶=~�&N��M�ѷ*�nQM�+ҋ�lP�#1ܰ�=z�&�(��?�,Z�5��A(�,p>���D:�P,�߂�����{,�J�d�@�?��i�SV9o�L�kni����uڍ�S�Z������<5�� �����]�Y�	5�{�V�L>C��w���ݸ`��F�`Jz�ru�W���}�j�!1! ����`rFz�渒 J���q��4�٩Ƕ�\����ߎa��ۧfIU��G���c-�;�7�F�q���-��eЇp#�>.R�e� � R{�m�Ϭ��3f���Fzm+����pB�vdu��\�H�{;�B��㿑b	۴� ��orp���7=͖��T��&���R�	��kW���V`��c�?O�Q�%�# ��v;�Ux�:�>ٓ�]���d��^���ʂL���Q[���j:	��scc�O|a)Eܯ�� %1)t�o��&�jo�j�Vb�n�@&Xx�ub����X��r� 9�k�%6\Ri���Н@I\F_�[�`���Ie�e��(�*J��O+5����O������Վ�<J�OE�jr�7wZ�%�R<4��$o'��� v�eTcl�R�,��j�_��{qog} �z����]\@�{j�Y� ~ޣГ�RQ�&nE�xڈ�<��A�F�(N,G��� d��3�B=z�2�Ch�i5��0
{>a�?�
�ױ3�O�bR�����&I��MiF�*l��5ƙ�ao.�A0dt�����ӊ�P�%�X��u��4�����3�� ⁏��R�����cu�+,M��3�rdǧ�$��� ^� �Z�V�a�x�Z��*V�g�0�
��+�>l�Қ5S��O�T�ŭ�L�ܱ"��	���?�z,���S��q��Kj�<z*�Pʒ�+G�� i����=(�hgR�[#$���O��W��i�X��i�P��J�P������ƚ%�8��6����5Z���4�$�$�U2|�I���)�d���hUPqk]���{�>�TF�o��dF4HZK������6�{>�Z���}�'1wa�1�1��*��uE<���8j��k2���J���g
�Ќ�������b}o &?ڜ�[�y�����r�g�=!��/�@�v��Uɚ-�ͮ��� $H��~�`��� ��UJ/T����	a�gQ��-dv��*I`����=�nN:)�<�gs�1������~R��2=����g�F�l5������;��t���`��F0��N{v��ΉDH=���wV�Sp�U��e� �V�E dPK4�gU���z�igSqpQ��@F�q�Y������?tT��	LICj�_R�����V�o,bX��8�%�+"�1e��~��f@8�B����i)Er��2��Y0�%*�d1F�<�I'��aBFOo_N��be, ���ȈĖj�����3����;Y5��k���e�J g��f�!�vlv=��v���뒷e�!��/E�>��p-����"ԫukM�o�7��m�o_������&K�1�{u���ȶ�y-I��&�.�&�e�Z����2���*�=��o�M\�KD�v�A&�W����jTc_"�|4�;c�=��V1���f�,r.A%�r椱�$8���_ O����fK��D䴷���ޥ�y�v�B�Ar26@��'����F`�Ud�����y_1�U����3�,i]�	hY��$`���=G��=�Րc]t^�����G�jW(� :�1��u����;q�7�<Ssˬ�%�0�lAb�d`������,����+�I�x�l>܍�z�������J��I����_$<�J��oޕ��d�H}��7��t�87h�l?ο�v-��lt�lڦdԴ̡e���"@��A|C�/S��n� ����vX��g7h�Ѯ=�_��tZ�M��f>ShI���f���]���ti�#1L�l�G^��w���x���e�1�qa����3 7���]L��՜��� ^�(��5�x*��r}\�wƣ��`��_kJ�:���]��|W�I	��A*A����	"īJ���QY�I��q�%Z�1�&�)������V�j�v�:6Fk�y�����b=AC�bª�H�Y��sQ���*]�l�~͚�i��ߺ�w�&q���cۨY�,�qV�)qq@y����K����^�pD�!������P�XnX϶�hAvc�A�񂳏�I� oP������jw���F���v�C��W�1���� ��0�v)d�_kİ���k�O�[Wy�� v��z��fX���=٫���:�fd�I�.��3�H�=����mL��^�^U1s��p�����&��~ޔ�A́���U��3c�jK,���$iY��������C$��Ôm�u��w��5�e@cH�g!PG~�=z�8�]��_�r�<���X;�Z�ڰRr02��� wJ�n�� ���_����~7��� V�������=�d\��J��a�>����}��43E_�E6bЩ�6X��~�1Cpdyyo�]Թ�y�¥���,x�H8�~�g���:��m�i�Ej�$������%��'�0��L�F5�NNU�dũ��<���@�_�a�����p�*s� ��jֵZ���� 0���@�d�$]�	�c�g%�L%��1o��cz2�� ����r7�����{;�Z�)ۘU�+�2DVbk�V����.�f�4!|��	��V��ɱs�r�5�H���@������9�ui�&�
����ɀ9�����.TfJ�%ֽ������N��H�e��@Y%\ ���t*l���%��ܢ��y�� �RA��{^��N&h���I'��Zx��f�ߺ�(u�� L�ΔU1�U�Q��5���C�}��e-ټ/@�T�؋�����:b\�b��囻�I�3��^LֳojQ Q��NC�}1��T=�K� �e�.kx�,��j幀_��򠟯Ө
$�������kjˠx�h��kj����=���({��]����⒄qKbY�R�d����_Sۦ!L��]������m�V���d�X�LG��Ҹ#��B$Qd�{a�K|�� �3k�Վ@@��q ��0:�S��Q�<wf��*�J�IQ�Xj�]due���� gU��R��9$��w����V��!�'��'u�����CQTLN�6Ξ���af�o7�P�ښ��	<}�	f�����DD��;MZ���w-��IgoV9/�bfuf��``x���X��=sGWG��Yl��A#UZQ�_�4�� ����uVlQ��ں+~ƶ�[�XT����!8d������I -��MG�Ÿ�׹�:�9@g�	,�$}~� �j,��u��?�Z�&uͫF_+�y��OS��jT��On�T�WG��mw�|eJ����BB������uv�Vm��:�=nTm���Ebd��W�`�Ȧ�O�=W����2��]�%z�:P�|#��uW=� .n�`P��K%��I�ꄶu�j_4�얉Q���8�z!������=
�~AE�T����g�8�.�e%!��:gQ^B���R�.�N��z,�
�sR��T�c�����[�$���C"+���"Oo�P��H�2�7Wn����޻@�GU�rA�	�G�� *ܡ�o[c�.���f���R�>ی3+���,��#�Xd�����^9ȣ�A��%�.��)2�S��6��1)�Y7�0^'�>Dc�z���6rs�:R�S���ޚ�4�n�,i��D�?������Q�/��KO��n4�텊K�<��¨.$P�*���	�!W}��y@v���1#�`���ap:I̋��ÓڟeHq�j�D�vċ�Pp1Ys�{�bQWuiG�[��kuzs�rO7�+y��4�4y9�zYj��#�ן�>�|O�$��9�f�Jƺ:��XRa����,�� ������yN���x7�~$�1�w}���:�lN 1' ��s�����t��X�[�ל��/(̶�\��S��[��&��ƶ_�^���bYS���=ϱ����8�|@�����(��"i��B���֬ +�i�VRG���������)E��-��_,ߝI��m^���?i��*zr1�@	�}0Gj1%��w�<6�)����EzI�,��E201�����X+�-� '�ʿ������Qwg��?����R� U��Z�eC2�`䃁�����ʔ�H��4Ӣ��a��۠n��mwş�V�C���ɶ����uUv<����*ѕQ$P�e���l���7ۗD7�;_-?����Y\�m��Y�պ"���g�/q%�,kv����R}��I �w�A9��^�n�I%w#lL8�W����?�&ˏ��GMu/�P���v$��O�����`�|�NA��jQ`�ܳ��Qx���s��?|��w��_w�4�4��RRZ��Υ
���B�#��Д'���_%��0���G���t�)|oN�%��z>s�\j9TS�'[n��}�oe�LV�O2�>�N���y�T9��wNm\��p[_��%��C�W��Õ�b��2hG�~㜑��D�����{�q�t����T��9|ռ�:��*�~�9#�F;]�R�V��W�->'U{/$U��2Y�g=�oV@�CA�I?ֆ�.�B�%H��>�@�EXH���;�{<��щS�,�@��K8��U=^�O�]�חq�%���2X���I!?�>_j�;~Ό��)ILv9��<E�׺˙b��ͲIǌD��3�&��nm��g�U��R�_Gg;,�g2���k"� �c�A�Q�RRt	�{�܎-�,�Kn�j����%Zi`=�p��c�;� e\[_*�i(��k�+0������`�8-�?�z�(���W�w�t6�;P�!Jk��Y����#�,�W�gר��������4tx$�]�;�f�u�,��"�3t$�,��颫���C��ۑ8�.^;75���p�ņ�s߷K\�g9;�˖� T�� ���?#���:�������������l��Gd=Ã$���Wa5-��hj�n<�5�dH�8v�V�l��կJ$�\�J�GL��v%>����Q��U~ߦ3�F�F'5-�C�����8$�� �9�����X����t��4d�N���\��Q��2E���K�V�{�QL�0�U.���Y!�h��g%��ζl�7 G� ��?a�ŏ��Î��z@���T���R'���2�b!�(ʇ'8��
x��z �R�Z�\k��
:�ѝ�>"I?4@��g��{�_���0dY`�B��]�K⍞?���4�]$��bB9dx� �{�=+QՑ�|;M�͍Y����H}��k��+H���`�K) NH}�)&2����w���u�$g�+��ۨ:�ka�{$���4�۝�����br�G�Bϡ�~�)Xʫ��A��q�Ӯ���^F��-���_&H�&|}p�;�On@�3X��_�l���=*��`{k�Ȩ� �<~ܜ~�(t�vsFS?�<?�<�q,�WhS��$>#��~��@�tX�zIj�����W�׳x�e�X����>�ӢNIv�Y��}���26m[��Xh?�2�K���JK<vخ� ��T M�V?������l��u7+v�T"����jC�oي�pKZ����{��ܞ�uJ
�����JNGn�֖��C\���>^���Kğ5-���,��ʹC�1�:�U�=�2�A���䑟Z}f��H��Rª��\O�����s��1�x$M�W.�UK�r�u85�nՁb7�gv
��`P� I$~���$�;��4?	��I�ͅ?���K�a;����r��t��������v���k�����'������� B@gT�����o�굶#:�VT�(�^l�>}٘�9�����!w+���cj�&��,[�s�_03�tDR�t]v���V���X����aԕF$���҈�fC!�nQ������/V�틚���S �bT��=s�J!�H�3�G� �J�-����+$~'ۖ�#�x޸����MNaƪM����[��%��T�e{��I���JU�{g��9o�����݋�O�N�#7�dȱɞɀ3��gHfF��1_�?��o{����	={`�W$���2 U4�Z�7�g���ĎO������4� BR	�C v�������?���U�i���7�`9
��g�LHU��/���!6�\O�U���-�M�2L���� ��p"�v{)�I���S���	��y'ѱ%��G��cf��w[5wS��_�V��\�Y���{RG7�f����H�|\}�=ZK��及#����!�-�#��h�L��!oA�"2�d���(�D��y��w��o�⓽)"���G�3�3�AP{�	� N�PH��j����W_����lZ�ٙ�l/��1
b@���aD�m�n��ڴ�2�3$v.<�r�8�D_#���P�z�����GkQ�RgU��V� ��\"��{�]dγk��2K;��Z��P���v4
���n�Tw��t�R�WM����R՟�M,�Z��⮥�b�-�}�c��8�H(NJ���ق�Y�f�� [RGO[��BIf\�;u�!�Qׅ�[���xfD�XR�RrU��'�w� ^��̤@v�`���p	��˹��)�ZeW��,`� �?\��|����jDJ���	߅�XU��ǾS� +>>����W>8���ۘ�X+W����y�Y��,����,z����.Wܭ�ڲcہ{�/Os_;-�M_9[ � �z[��ÃEWc�F�ٜ�ZS�=�,���<e�K9_,�ӬD��q��U������m��A
�X�z�u��ÈY�6��0^9܏G��A��f�Rlm��R`R-��z��@��]<�~�}z�f`�qŗ���6��qT��'z�=�].�c�]<�F�ւ���e�#	�#���0�߹�r	�����ɗʻ�A�\]{1'�R�^=V��?�)>R�ϐA2<���^���!]'�h,{�5J��y��v��=;�7U4�Z��=(k�֩UC��&O��AZu�5����K���ӵ���0{Q�?���|O���OӢ$���#K?�B�7��uC-"�>���:�m$�8s!�o8�H˕Xl�_!��+gN�9!{��ڥ�5�.�oQ�)��P�rp��D�%::S�q=�Q[g��IJ�u�Ab�^1�P��G�}Lu@j��������l'�hB$�+[x�ѐ����r`z~���w�E~O��g=oc-��F�EV��h�X1)'���}��J�>J�r;v�����q�C�jlw[S��Y�^�)�ٻ�H�/�6�f ��ղ�UDJl��x�tIlj�jF�!�m.�(%�u����n	��Sk�*��_Ĺ�qΦh���A����	�\p������k�x�����q�����3��%S�<B�I�s�uUT����*�"��H�NC))_��%|F��7��[?nd�_���$���"�~�?�;trr1d7U��?ө�&��*�r֯V�*�O�z�\��R8�)sj������2��+��#���OME	�"o��ȨF��Y#k��S��4_����O0Gە#�:yJ,b�wX�9��!�c�r�`D^�T�w>BE��R�-"t��y���4:M����0dHP�!*��l)$`�N����sk�޹v��>?e�S_�Of��gbJ�&?�v��fH*]����[�?��ƾ"F��l�r�X������ٙqb��@�c��� r�b���;����6�,�C�����O�l�8���!������E]A2(T�ɼ���V��;=Ն��R߼��c�ݣַ�� 	?SҐ���57i��7s����G�U�e?r6��,~�b�Gӣj�$�������������\lfs���8W�?h�Ҁ�����|���X�T��R��Y-Y�MB�FL�|"�5���� �� A�B$������z��g�x�H)�5����0_#6�\�~����m���4����PX� ��Tl�s�l�O���2#��O"��}W����S�#��,�*�3��'��zw�H1b�I�.�kciֹ��k&Rj��5/��	_�r3�ר�R%�U&��4� �yg,��Y!zQ��1�K�Q�s��tU�]���Mvթ����5��+��RQ���~�[��KxU=�x�Z�lESu�+�K4��P�!|K��,�߷�Ĥ�醈'!�T�S����td�U�tk�J��b��
���~�[^�.� �~4�\����]���ĒN��[��_�YU@����S�8�*�Ӂhh� ��I(�������$z㢈���<+IoS�zT'����pA����E��%]I?�H�]Ȅ@j8�S���8�t��3Mn(lJp�I&�v=�X�zH�9Gh�M��E*�M(#�5�QQW���p�JN0����f7ѐ�%��������c�VM����/Z	���w�G��\���Rr���76�+��|n���Z彶r�Dw����<ӎ�2�G�T�:�2>}Gq��A����K|��m+�E���߯:D�غ��F}����{~΁Szd�́�º�M�yqUh�$��rV�J��7 ��U"����e� Ѹ�]��0<I�}F}=z �@�%�S���)>�W��Q��5�Mc[}(��e���5#����`��X��3AO_�,�jz���m|�Ԍ8�1o��������P��8)2��/��������D�N�%f�C�N�}��V�F.�=���؆����
�δ���5Sq�d�vZ�=��U�:���#�e�C���.~�.��5*�
eh�k���_ga����ʀ��?N��V�R�������7:�=^�]�a��>܌����ʜ`���=Vd��\o*��QW������籹>*����t\��q��D�$�,�g�������BI-���� �Bk����)% dB����s��Vnmu���yo��;�LՋ#������ dV]�>C��[�Z��(MȌS�U�.<H�>�c=�oN�b��ᒴ�|���b��8L�d��&�Qy�� *C���=O�s��r@4]x���2�[�s)�RqZ��%Ī�3^lc=�{�*�:�8�{�2��ȿ.Xr`��k@%b��̋4�A�'s����,J��e��^�/Fw>�W��.� ����g�����q>S���=�
�weGY���mۭ��scKM���IA��������+�7$�w�J�_c��F؝��*��Z��I� �G?��h�W�� �\z��$	��9n�ՖE �.��� i�'�#��9 Fb#�E5f+��� L�U4�����@q����o����ߙ���7eľ����_��ڝb��2W)�f��[�{�{m���)�_�6�uʘ���u�����͛V�`�!����ճ^v��G�Z���g��>}��H�`�A�/=���� Bz�����˶>�ק��ۏ�{b>'��e��"��I���+���� �.���O���q��?#P�'����)�﯆̭^��I�_g�I}�	�H%q�H�r��9 �Q��hW�c��ܕ��ld�Wq���п��~?���c�m�mi8Z��k�=�򉥦��&ϚĀ���I�����w��Z.<
��y��O��"$è�z�8��dy��h�۹oa*)E }�ϊ��ׯM�xF|R/5�R�J1R��V���Q���65� �d��"���,1���M_�,�
�*-]*z��;���Ė�� �%d-)>'�-�p�n�i�J�E���ޑ�p�1$g��,�+J��@<mߦ`�aJ<S�L� ��\aЌì�� %�!���N������Ƨ�=�6��U�;vk;��� <R�l��(�_�R�( j&�-Ye�H�I#��b8c �O�:V܎%�u�[Fj:$�?`�
��',W׷a��QF�K�{���hԚ]E;�jZº�xTĲ�t��3��?Sӂ�I����A��ϩ�0b�}��Y?gn�pFR�
� )q��?k�j,��5hE{�P]	Xݾ�#��A�H�)w�rȹ �hx�ֶ�g>�s�$vg�C]Ĳ�d��Ϸ`OMB�����RK1��� 3ٓ))Ub;�OQ�ӡ�d�wh}�k�����ϵ�V��}s����ϧ~���(]���%��,�{�?�I&��� q��`O�h3��Q������e�Ҷ�"{ߑj���DĜ���YI�� %�nw��#�N儎˴qR��1�B��$�Nq����A�t\�w\�a�*����b�V�Abֺ�^�,�H�G��|�Ֆ� Y)���Dv_�5o%z�A��m/+�V�в^U@}��2��� A�I���c�ͮ�src3i�(,����=��d��g�2)�(�->� ����}\��rX�MK�v`W���A����5CaQ��uf;?�J�����f�W���W.|�g��C*�������%���ca"܀����Ĩ��q��3FnrD&���������c��^�#	U���^�d��%-&˘r�l-v��֥fI�����B��~�W�~��
�# �=��^ޞ���e�34�n�M�
����GQ�������( �6���n�f�q��M��Tc�+��8�<���H,�̓�J���lhT���D3ۅ'�^��G䡊X��3鞪���Wo��z�^Q���'��'>�ġU#)h�$�Oצ�NH���|��em_*�M<�)�����p����l�����郤�9b���rKj!���)ZI)i�/��y1� Bb��=W�N���_�/e��35Za݈���{�};~Ζr.�F�sw���Mm/!�Z;s��~�U̪����
��߹P���N�3A�p��e�^�O���X�,~�1WSߨ4R@��O���P˿�r�D%-$y�yČ�����])+������/�7(J����u봙f�+���ƪ�o���uY�ϯ�X��E$Aگ"c:� 8������#�:�EY�T���"�c�ȪK$I��z�ݬ����ވ�wLb�k���n�KV��╡��m^oo1��#�,?�1a����h�ESi�Fh�Ţ�H~�W����ˑ����3�6�AV���-��H��W�^ERK}��7�pN;}zv�U[��k�����������{��SXڌ՚"���#!\��'�y�� �� ��5�4ͱU��� ��*V��ԣB^�Q�!�%�~�����n���n������Ĳ�!��~~B0[�r3�=q~���+��y��mbCj�`��H���^̻f�N�!�15,��-�����f�?�eb�ף����̎��`��!d����.\�er;I%��/���͛W�mHN"1r5oPj?�q�?�z�v�=f���vo�K5�X�d��H#����:��eq�ːu+/&�'vS��I@��q�Br�,J�kOю�+�'���Ӑ��y~V�	�� �d��W�&~��Q���Sx+I����*��e��&����3{�Ul,�*�p}FzyI��������|Ӕ����]}�c���(1��s�t^�Q�*\�혥m~��K:E�B�ұY$���� ��9���@�U}�)ɗP5��/ў	$cSU��d2�Ǌ�7�\� ��W�	6����ޯ��ۏn�~MR8��1 Q.@$���.�V	0�w�<#�����?*�����n.�8��aC�-+@Z��SCa���&�m$1zg�i�|D�᫗T�w<�b�p��MX,"\����dyJ� ߯sև.��FH}�'�j�m���p�N$Ѷ�[�A�J�a�A8���'�!9�hҧ!�^����֯���vuI˨`<bY;�3�0%�Xt�}"�J���ձ�ze���{rJ��'�)7��c�7	.� "�<�74�{�CH��?����G۠��\tDɢ[�{]�4�����&Y�h��'i<[
�#�Y�6pw~���b���F�i���49~�9./NƦi`��_�1�����$v�I'$@ :+RM�Ti?��5��.�����13l_g�ȑ5L_�}G��ߧ���O�l�9���o�-���!H��_��G_���7_5�ll�� >2'��~ܭ��f�e�:����~���X�>�������	�R2F͵�E���g�[���{�ս��~@�:��.�m,����c�vz��V�*�yc�YW�>�u��8��N�Z�N��va�os�Dcp�!���^����_�7���� ���\����T�w�|�V+1GU�cN��1bЈh{Q�ˇ� ��Z�V�2ieZ� ��p�ڹ�2��tj��&�U�� ���{q-m/˛x�0��_Z�ۆj�$��z��T�Ŏs����ـ��cՖ9}�c܄�F:?�^�q_�8OĿ����:ꔴɯ�4m}���6l�{ie�d�Y�PҾA���P5ݺ� N��e�ķb ?�%��W���ç���G��m~:�r]�X9�]��h�ꪝ|�!9"������x��z��8�0�t��R�>n�q�~�@���`w{v�-ٴ��b�=.���x�y���3R�ô�+	����~^��{�j����UN0k50\�e��ȮH���r1�<����=?g@E��]��e3/����H�V��"PK~��n�B�b[�'�ox�P�e�b�M��or$��X��AV�	�A�oi�YU�w	�A^+��}��&��dk�H�l�{a8����8%Ō�����@�BL�I!Dr��Ltv��@��	Ƿ����i��K�X��� ���n���� �韎|W�uڽt3�MM׎�`�v(�܅�9y7��V@U�Ȝ�K��ȵ��{_C[n��Y��Ս��S�F|Ǖ�O!��
��z��% ��5��SJ�e�h(O#�-h��|��*	#��@	�Fh-]��p������3[ҽ�+'��$�\�}q�~�C�$�Eb�Z��=�y�&�gkp �Y�����z���sU��Ț�T�̜�]�[(kބ�>8�VW��>���A:ԅ�����?�}�������ϖ||���trek�]�<�Ӵ�M���M����e#��	vX�����)4Sp�v�����mo���+Z�5�,P���@�� 6����0S;�g�:�}N�7��4;ƭ7$���$2H���*���*��� �μ�b<�z� �+2m�IzSL�{?�Ok��<�}'�t1��U�/\4Og�q�V�5�������_35�T>F}}:��x� 0P,һ.�]��iv�Ճ[%$���%h�q����O�p0c��Te%R���;:�܌"3�'�p���Y������jW�}�$MK��m�JH��R�#��������uY'$��������K<���:�+ީ�>+���$�l�t�Uu\b�l9N�J�����]��"6�ό������@�b} ��u�2��%���Y��gc���}��4#Ī�cW*�l��#�t���'E'GKk�5������Ӧ�˖��I�<��Qn��zR���O����Z�q&���8Y�ʑ�Tg5�d�������]��؃{��6�l��*�of��r�6#�B�*�p;�j�T.h��$�)+�h`�}��ӚWe\g&�}�8�=��Ĥ'�r}�"��wtM����aj-d�*I#P?�J`�#���՛Hd�u]�b[�{mcة)�u�fuV��Ib����W�w.��E�e����|H�b~���=nI���U��^6��&�V�%hD4���F@���3�O���������w��G�IЖJɅ��R���>�:�=G~�'��������^[�VfX$�wk5���|b��P�өT�Z�.-Ʒo��K�朏m-��=������hF�VD�@9��AX���L�Ev�ZX�V��rP�L`�x�\(��n	�T���{�W��Y�������XљI�$@ Ǡ�uD��j�)IB��V�[�J��K.�c ,��btl�޸�mꔓDu8��ĭ5�?�U��F��)P<}���gU�}:
�+���M�C��F�E��i��Yrȳ&cQ4�(����8��ǡ���n+�!�Tj��I'-'��?�U�Ҩ���ih�J�sQ�����mU��ơ�¡pJ�I8� �#4a��X�_k�v�U����Hɍ���}�?��  ��Ǣ.רDez<��$���Ѩ�Q\eYJ+��A褩D�wu�6R՞K�g�Z� �-���OeE&B����Վ�(��{ơ�����7��uSنy�Or'�c*��� ��@��ά�Nm����o�x�R9�e`������Ұ�<YH����#;쉙_ێ�I$�8�B7�=:��Aл�����T�����׻b����8��s�J����>��P��A�'Xy�I�-W��D�lW����5ps۪�6
�·��:]�[�U��V#�q�Z)���F|]���?�����������::����t�Vh!(����`z�?�RR�Rpȍ�o$�&�n�e),�'��ݒ/�)P�Pm�.3���j�g����g�<����~�ɨT%/gskn��[�]���Yn�B!]Y���9���9=4d\ ݛ���?�y�c�d��$�������
>���w�z��{�V���]��Z=�fH�y'3�?�#�r�%7��δ�V�ִ�9%�<�<�P�GOG�3�:�FJnp�C��P��8�d+����ݒ� q�Z/�q�P��Z�51���-���J�~]{v,3��U!�9Prqߧ%�}�L�4�IB��Td�j�S����+���LD`�=�l��˧ �+��}֣�-n?~��5~?�/�oz
��}��-3�ц�`Q�ݒT��~��� �0�5 �V_T��-��n�=�� �2�'�u�_?pķ�U��Q���(I6��X���YLI��,1x����ӯ�\�����U�7�wI���r�� ��� *�w�������������C�(Y���U�<�� wb?o]K\XN�!|G�{��ڡr���l��IG�9�̨ꛐ|S������Me���Ֆ"G�i������c>��~�L��0#�^W�nq&m�{�~?7[Z�d�^����Y�f:�`�VX��3�H@lw!Oo�]�fw�,��K^'�wxq`y\��
�����3M�#�Q�i�7���݋Z),Mfe_y�MJw�#͉�}���cbз?���N�w�r�ɝ��`?~�>!�ӵ�o{���mq.�kȒI�c*T�>��_���u���ݾ+���n�6Ù�V�=�R�j�|����R��qy�Z��l���{3��Ng<H<�ʿb$랄���W-�4�`Y�w�n���w$x{�M��p0Ypq�%�Q�s^P���P̳f���2�30���)�"�?�~���
b԰W��Ҫ�����`����?N�ꁩ��	���Im�%��̯�81�i�� ���iF?ilI#���tE!�k.Ns���FgI�'�c�n*��LÎVzb��+��$o$P����F#���ߧ���j��o�������YN'��/����$�%�8�1'q�qt����%^=���n�E\Մ�x���?�||]X`�zq�sKv�`�Y�K��U�G����AL���C����=�zQS���~���51�>�$���Z������y`��랭�*��8p���Z�c8�� �硵5MGmi��E.��@hǵ�Z�s!�H�!�.	�NX�LӘ�B�D��<�rZ���گY�*P�걠�h�{g�P�ةk�b��b�������dM]�J�p'��=+���d�Œ����Y✊�;���ԭ�eG#�l���=Y)*��P�6޾���1��G;#�J��~J2��Pޠ��ް��O��g_�0�j��3.�)9�{���F�	.T(�j�
����^X�5c�d��0��<C�H� \�%��V����~68ݙ/�յ��{����W��'�!�~�=¨��H��v�%�Z*�QB!���;�b'�g ��Y�뎠�I�iE.(y$���f���M�����H��J�*8��建��qf�U8�g]��Y�� (���硱��:)b���Ҟ��=4w�*_W:Ijh�J1*��G�=}?P��{u�T�M����ݬ3qI%�h+ҥ~�ҳ2��,�e���b�ܓ�	�Y�3$1@�{~[���6�Zzڈؒ�l�x��<�� W$�ǧ@�$�$٪�k����+��&�oI^�I$ *���a�
�oRz�R����ka�v�m��3Cu-R#�I�>��שΤ˂��I��A`�yAR�*S9��.�b��F+�t��m}�ɱ;~/��1%�#�*	'�v�^�F��)�͠�m��[��Quo�>��H�%sT�,S����Bqe%,*�4zJ�f�l�F%��J+� X�g���'
�z�\F����,K�W��F��~��Q��^���`�nKB�$��ɭE5)暋ۼ�dTo"b�-����D;)q��t� v�O�B��쐱#��Ei���q��e6r.=�I�I4���yB�Os۾, 1��:vGjNޙ�G$֞[���8v6I0ٱ7��(�ٿ��b3��E� �����������K?R����%�N"�[Q�f�'��q�����4>,;�?��G���D� b�W��lr]���|nM���d�YҪ<d�L���2���v0�eXgl�"Y�V�[0R�i;����H�(���ר"sO�;�A��$����Jˉ'j�21��ӶhLf�ʺ���w�)��4G��<@8=���*��]���-����G���Z0��� �}z�df�EnQJ0I � �����L�� N��# ڮ�r�z:�m��vM4��
�|4�K���q�,�K8���������0�������#U-�� ��݇��ĸr����'�r�?��Y��U�������9�n�dFH�
�:^!I$�\s(y��<�z0��NU}RĈ���H($Y����b�:��Ac�/#$�}gA�)���"iwgd�'�1F���F�fg��=�0$��k��jS]K�f�i�Z�dpu�T����$7:�ƌ�6�M��,���!V�7�!���	`�r{߫H]A�4�B�z[��b�Q��q��ǧ׿@�1����m�K~�qilǲ~��U8T�9e_�=���F1̬�����K��٤�Di�_m�Rʸ
$��N}0נY0�&|���m}vxCf��,��@p��8����w"$t��cM���:��Q6w't���c�UP0��l����}��5\͓�%�H >k�;2W� *Fq�N���*&��Fj�$�q8\2Φ�W�����Y����oDJ&24Mn��!1� ��"��8��{J��ʌ[}z���O|@"�[�Y����u���b��r��W���\��fW���_"� �w5��� /ecQ?�w0_h�	��ϧ��es�)�buu�8��n"�M̾`��]�d��o�E{��۰��W��	#�;���sll��������6� �ڏ��_���KT���X��KH�*��d��`����b[{���%��� �7I�#���1��`��Z�(_kS_'�|-?����~r.�� M�T��\��C��G.K�Ȭ�=��F��IvM_�QM� �;.]��&�(0�K��&��X|��O��;������}1%6����R�t��ט���7&��1�_�gUX�/�%~�OөQ�	����/�����,Oq+M�����B�O��B&��b�(���Y_��4�	lJvv�Y$l���G���(u�q.�]u�#}�N���=���xRK�M�uj�����f��]�Ri��l�x�˻]�����b0{���� ���x�ff�C�h#����,�����+��F�&���,Njk�B@LI�Yl�-)�L1RV���4ܛ����<�~0�/+��H����a��ə3���ó*�T�<7��|{Ħ�X��ک�bq������ި�5N�{fq��8�����N�,��%��?��T�E�����F�q�����߅[� ����?^�����So�j�đ4���'�P�6nY�p�~�ւs�W)7���v��5�K=�Ab�]j$'�	�yQ<W�=N��5	��8G�?�K�R��@���01������膿�B'��\'�X�V��5d�[�����v;tJQ0
X�o�F���޷�m)S��m���ܔVi��h�ѭ�U�/������*6�e' �4������w�o�Zŝj�������"�����ΚX"k'��yvu��`�ھ?^�G
2L���Õj�W�d�j�]c^���O4�_�b���� n��{��Lc�% ��f���i��oY��z��v�+v$=�\}�����u"*�
f�I��+Rޱ�,Eq��J�Id�8)�h�)�s�$�=3�2�P$̻���S�Y൧�c=č,����![���#=Ȉ���;;=[�sJ�Mj:#�;D���!�i"#�,��N��]v�9�O�l��]�K{E��$g"B�ط�z,�(�����t�ģ��C+��b(��S����J΀	$%�{��]ʂ%�m���Z���I���Bk�k�4V��i0�7��@l�lA�$��DU�e�4e�أc���S��m��R6) �p�Ld��n�qz#(�j%��MQ��y�&H*(���P��P�Wz�Y���rE6��洖�4j�m�-$o���(�gκ"�g�=0� >h�i5���� i�w��������(�e��pU��������6�G��j�� EC�Aq�H�5���3.��Mz��R���ҿ-	=��/�ў��"��#�����¨�Z�%yoX��vy�IV�Kz�K��E	U��3��d�rL"�Z��GU���#Xq�wo�S�� ���ߩ�D�!�O[��*�&�\�f�-�{���%�7�Sh���M����mn�XZ�}4���Q�������rś OCgUi�H-�O�QvYx�ץh�i��Q1~���;�q���K� &'��+��p~U�c�0 �ӿ�9=,a�H��%�?����F"�3K^�U�[ 2:c�hJ����-}jN��)3��AV�ԥ3��.d��.5�؀?\�$A$�B��}[��a�GGo&U���OO۷M�� ֫<���Gj���H��3T�`r����)'��-�!�wڻ�����@�`D#0A9s��S�t� 
�J�?��KK}���t/��a��Ԙ�������R[�Ef���ӻ�TY˦r;*.s��*��:K�K=A����6��o����=��3���Sd<[�jM�^�(7'�p,���,����N����Q�t���5l�MZE�h]�,�T:/z�$���nCs���o�`֤|g��lI�Ilǵ�<�{0�Z"]@
�W�F^��QR�ͪ��g�a��7J�������`L`���E�pm=��\���s7�MG�:���`s��� ��fz湷Gy��ף��m�����ў$FGF�5���0�	e���/TD��;���e�W( ��{+�D��L�w%�0���8�~˧�J��O�Y �cUfg��*��w�꩓�����5�w��UǦ��ܹ��o�e}E�J�Y��Y'�C�`��5BNC.?��J��j��̱���&l��YC3��=0��"	,�OR�:�8�O����Z����粎��DȄ/k��Q����жm̲_��"��;�1�5�@�~Ε�B�7�q�j|u�ԉ/����#�i��[�%���Ӥpը?�<�g8� ��#'�}˸��؟&��n�L�����'w�Fͺ�dԒ����#�k�������G^��]��rIY3�M⤌���2;�ο:�	����� �uiT|��w�,\��Bt�='�4?������[n+�,I��4��,�,p2^���3��/Gn��u߂|A�մvl���t�s��# r?�נ�T�[�,ln������t��C��m��������;'t����dO�d���f+�;'������c���ܠM���� ld[{f#C&�;/%����;��,.����e�j�W�_��*|{�>L��#��O�:X7�M��VLO��Q���%��	c`9F ��ݫ�F��W�e�ƙ��_C%��/5��Z���/�;}�������J���bz<�Ǌ�!�X�C�-$d}������5��-^���Rl�E3U�X�)@����8��� O�E��b諊w+[�K1y1 o8C�|�g��LS���b�HBXm����l��w�_�?\dt�BƅE�_��Y�8��5m�>Kl����p�{y�`��zg8�� Y[�i��T�m�$ȑ$���FT�����t��I�t�G;�y:.|b����踌���c� ���%}��C����c�,:�i�%�k��̡������q���W-Q
�>5x"��aPJ��q��W#� ����r�@�,Sqn$SN4���n������fah'�w=�!�X��I+��j���Y��-��0C�I�z�ʧ�h8��y�8��S��-��F{�P�4H��)�����v���P�$�g� �o�� �?�u���~G��?���^^� �����m��غ����9^�]����0�ɫ{h�]�@�#B������v�zy]U��ɚ��X�V4;��4%�a�F�3�/��= c��ɍpJ�9}���m^;���$�<��_qX�$Tk�G|0�ʝ�� �6�7��a�㼚�Q�CN?fbH�J��#�9��ۿM2��[$�S���^Z�io�e����.Y��ٸp;��:���q�^;�ՃG�cI�!�~�`�L�{w铗9Q&����ce��~dR���ĳ$�/�yx+>�� N�g.`�+����إJ��,S��g����c�v
��U�f��OBTdw}*\��O��>��qzu�0�Gzi$$1 T �.?N�,d�� �ɕ�<�1x8BF�'����o���zD�e}�$+j�^;hT��=���vi� �!� ����� �Ir�v'
U�x{�g���RLS�)-���uI�H�ԝe�MmH<�l�?��x����bԯ�:)ʰ @�Q�.[�|�	��MRB��WGd�����1�؎��v����,�뾻G��J��<Ϊ4��t]v��<�yd��l��z}:S��~I�|MK{*�6� �z�(�J�/q�gT�B�	� �o6FuA��c�J�(\�G���Z�0�߉��s�~��L�9a�C� ?�Mn-℅��C�k��Z�wS��AG^� Oũ�>r8�'�{c�u6���9��B{�=���{�u��+�h\/n�G>Jͬ�$����X����gn�&�j�*b�±5$8>��:".
��G�z���y��Q(2�6�þF�W\g�/��0�пF�M~�Y�����{��V����*<�=�O����.������ɺ�e����l}�}��b}:V��-\Q;��5jS��W�%��e�z�����0�����S���
Ezx�Z�D¢* �T,��tf
�P� �5v��f�T�[�f���o~F��E��J�;�Qۤ$�����[����.�ĸ�����P�FS����SE�'ę�Ix���ئ�2O|$�dc�$�Ǹ��q��x��'�3T��}7_l*��yE��{z�`�H1d笽��I�C��V*��k��IRL�����N�������v_�b-x�`l�`(�.�o߃���츭H����Ԓ��Fd*2o��.;}zi������Œ9c�6J�{�܀�9@@���(P�f���ݪ����g��[�0Ewl�Ň�:l M1I���Oao��j�m��mP���a��p̋(��Rco�#v�D��D��"6�W�+��~G�A]�c�,��.3��R� �;��N͚a���+����O(���$$�uGxK�z���#O���Ƶ�N���x�6һ7�o�-���P���I�X�F��3K/  �&��l� �o��׶:j�`��!ğ��$V ���v��!�S�r+�+�Mvo{q�[{kV]~�9xc
��j� vϯ������/+�I��kr�M�-��lJ >�x��8K����9��8kK����eV�y�Ҭ׍Wĩ����_ӥ$:y\�#�+m�K.�֛}ƬtR��"@e����g,��Hc��@��P���m��G�y���0
���ձ8$K� !�5���ۻ��u�X�c�\�P,���V;7јӣ� T����ӟ����ۃ\����|�{&�U>�O�ѹJ��"�12MlV0~�V�ǡ�Dx�=+���>��ᖉs�������#��� k/5�D����
4�{I�G��ǌY����}UX�s�K��ZŲ� 7�'�po�9�)����W�-z��ٞ�� S{JK��QQ%?n1�ׂ� %v�s;3�o�b���� E����w�޹Q�5��k�|�y�u���y�Ļ�x��ҫ>�@��qͺ�>��~�+��)� �~��~��\���s�[H>L_0]~��g�p�Й24�������[�i���E�Yrv�*����]�%�:͠0�k��Թr��<�|�{ ��2;����d�}�C*_���M�)|{�ފ1f�?,�~_~x>�R��q[eb÷�*�Y��=��x��v����K�@��8���" jL�N��@PA�?%���� p_����_�;����ܛ�=��x(��I4rm-��VB�ZW��L�� <�����gqn�ć&�E�BZ�����_r���~V~�vm�n,���w������v��ߊ�q�%h���<���l<���r���|-�������V]�;L2���� �S�j��
���M|f��*�h�N�mN�|��
��������T]��/�Al-�5��NI��r��)_kKV�-���h�����9�Zj(���r=	,�4+=XW�w�E��T{����NN1�Ӡc��.]K��n�osc�d������#�����8�t�$d��'������^{�d�^�ѫdT��"���A�c%�%�#�ջ�J�g�����ȼ�p?�+C�Xؓ�sH�~�z�
�c���%�n�;|ۙo���75֧2֧옜x����+Blw���)�ѩ�� �S�Y����j����m�' �Vd�����,p~�B!��ࣾ�QƗ��d�kB� �G�5J@L�u�޾/��RӞB����y�)���;NpO���A9��p.9����;��A������;}�@�� wU�Y�,��!�C���omb	%��^�$���#����g9�n�fD2�� ���� k�� />?����� ��Ӫ��`�/��"ynl+�ED/"fw��P"{�D�ӫ�Q��%�m���,OCv���,����boN��'T+]��H��@�15�c�U���`��{�!T��7k���$��=�^�R¸megiUO��z��F �Vy��vo^k}���n����+�ۗ���t�2�NH�����k�J����v�`c9 I!9>��E����y.�6�n;�d���[4PB?�>�v8=
MV��U��dq*�<)5�zv~yY�Ir@�==:2��AB�W9�J�'�[���1�X�ta;}�������e:��a�S���:}�Ϙd�<���t�)��z,z���د�լ�{���զ�B��TX'��ҒX8Sw:��v�A돻]�Ѕ���X©.�jI$�è5M*����7rG�<�T���Z�ي�������C�8�O$��V�.E�mu(}�䳭otG� ��=O@�Me�����[��1��д���iK��kG�P��3���B"D�����5v\�씼��:5�g�eq��rc�}>�@N�m|J澞��C��yJp&�퓐p`oעK�!�N�v���ȷq7rQE��87�#2�,M<��Tg��UvR"����H)3�N��[O��F�[m�Uǽ
["W(z��d�� �����@*��lx�qŸg�m� ����{���N�
�G���F	��\>��'k�g���^����������NG2��-وf��ʑ���+:�\�v���ʓ��j{��4ѻ"���(���۷]�1�D��j�Q������X�-���� }b����K�>�}	���Y�1�W�
�ѩ�/ڳV�%ZO(�>�k+D@� �\!��v��
�pQ��\h�h݂��e��X��`�2H��6-���3�S"���x���&���G3��a�p�J�!�_��� �R�46�	O�W��m��O�Tv�(��xp��c�'-=�x�pB������Wp�YG���իb� �ȏV)#���y@rRIH=�~�ƕD���&&�ubP�A� ��)�{���4Du@�d��:�0��MRj7Z��y>SF�"�p{�Ξ!�I"0Fu�}EM^1��,m��Mu%��;�=�:F
��5�vkI��i|�UT�Bq��G�� +��$�C&uSG������H��P�Ƭc�_r� ���I�QN����X߅�I���J6\
Td�8�U�@�,˼Ǉ�$1?'�1� a�M?q3�W���~�0�#��?(����i� Y�_V�"�Px�g"1���I=���8gD�s-,��?-��	?����<@·c�ߣ ���3�'�� ����I2�V��A�B���Pў�{��]V�E��"I�"��(|��v�Tc�c���<6��0Cɦ���^�������+ i0#P;0Y0��~ΔǢ���ʺ[{6���Gvw��U�Zoc
�s�������#U����tlk���ha���\�re��<|��~���2��;���_&�%
�Q����� �a �;v�c�8Q�5X۝j�+5�O4�"��YtוBF��O�*�$�ӨpV� �� $�a�,s�I�5;�xW	����K����sM�{�B�r��U�~�n�ى���yno>��a
D�� � !�_�;ķ>��Q+EI]�ilx�e�<�3;(�8n$3��6K��~+Y�7�S|��5-;R��x�p��++�yK!�9�_��\���F���g�i�[#-���c���D�	�B;{��_�����д��j%u���xu�)���ץ-�����4�����鞱�-	-|9r��_T\r�#��l� ?���ܓw����#ڵ'��J�҂�̧�y"n�['��z�D� �~�c������C�z�؇�cr��-���J��]�� z�!ԃO��j9�|�UV� lCn�D���gcӿ_��Ż�0+�Ýl����4�Ǝh�ߜ18X����;u�p�H��/	
/;?�]������/� ��8�T��hNE8�;$�;�\w�_�>���?s����~��.����spd\P��H���wG����0��	�O��/�-84kEP8U���VQ܂��ӯ�l���4�2�#,�MU�q�g�y���X`�{�Q���W�%��k�V�\�5kN��D
N0{� �>� �B�B9b����k�߆��c�ϕ��N��(ܔ�|�%9�J�?_(�P�ܱ	���1^��_������þ$� #�OĹ�"��,|�B���5s_v���1V�:���Y[�VEb��H�-�u�t[���䥶�y����mk��O�4�K���grGn��Q�;�����!�R�%~U�����4p��=d0����C-��<j[5Y�lT��]{/4�T���WJ�rc��=�ԔY���}t�$��v������Q�U�*�g�� '�tQ`�Z�حJ͛�n��W���*=�#?�<N}1��"�J:=n��j�6ܧil߁-CR��] D�T��)>*@'�w�Fi"s)�8n�gj��^�֘�U��Q�j��RI���u	NK�I��IbI)r��(��1\!%|��q��s���P6i\�:�3���ʧ��*�6ך#$~FP%��#=�� \�d�&�&������c�/�o|�����7�O����///?c�}�/��>�UD��u�k���t�C{.�KrU��E�HH��������� �be�����mY��7n �{��� d�#g�^�r�!�+�r-�X䏇o�)�܈����ԮT���2=3��͘ ����[��kZ���F� ��ּ�I�S1�)�QT�-��:b&E��ζ��Ѡ�?c1�m�EdZ����*��
���:�%�0�\٬r+-��[��F� Qۻ{ud��=D���P�6����K64�F���^�2������K`Ӷ:2.](5�ۛ�����t;ev�$�:�vwb�{��0dNP��@?\u�;�
\�~e_5K���+9X���Xly)ol5hp;}rq҉M풚�j�M��DVׁ��)�s�ܬc���r��H9��[	��������W\���ڊ���@h�CoOc��zb�$��H�α�P����Vl(�1�z��#����6�_]����l�a����!H_,�k�q���F.�n�I{��4�o^�j�%�:�C�C�@�&� ��X|B"Y)vicIב�� ��rʌ��(��Iϗ����� ����J��� [�,�$Q�-�G����`(l�}:�J�%VY�9�ٺ#f4����9)'��LSn�Z�뼲�ܥ����QI&C#�X.���.�Ε�Ds=�
|�}�a�l��R8�H�3̆�0�+�+�O�@��rHMz)���;�NE{{��qNk���<q1�F�:�`���Yeôn��<�0#�m�2�+���A1ȑ��	���R��+���Ja��,���bI�gӭ.���`�[�h����6<�-g��o�X�+��*��g�$c9?��#Gꔉnd^N#�dA�U�6�fY$����Xq�0G�;}: �%n��n9����Z���rO�������1�� ?����Te�Ir�u{^I����]�Z��?������ê�=����N ��S*�Z�EjZ�Z�]�q2I�{�*G��̘�cF�D���8��"���GN#������0lg9���t�Q1|�Th�Y�������GeN�	�7v$N�0 Xpٳ(�r;�;td3*�9}U�'�����.1��,'ۍdYdpFq�#�DL[%%�u�%�֎l�|�A�$�L�߷��:%m6��m���qmPųz�Ž|Q���>�F�}��;���d�`�n?��BCix�>��3��i"b1���Vl~��:�$���\Ɔ�@���;���F�F�Z���m�U�Kgs��j�<u%xȉ#c�9ǩ��l�䨍1c�J�3M���UOq\�
*g?wgP^�Df�%d��5��NE�hĪ�,v+�#����3_��P�H,<���[{�7�������YoB�H��Y�C�$��� ��J�͵u�k��ء�+�i@��� ���ӢM��%�d�8�U�G%�5�7�}�����$)�7Y��z�v[.E�.__��g�i!a�_m��|.|��9 (������"w5��jۛ�qX���^Y��,���d�P��z��M��)��GdX�����V�㖵(���>�O~� d�W*�[� ʿ���|%��4���^wVyW�^�3�:��X�/�3X>*��۩�
��6��+����Gɜ^��d�"��Evϑ%#����B�A�gd:�&�^Z��s�B8��2����� ��_�U#й�ֳ)m}6�L���2�-=]�?t�%�9pA#��H���V\�7�AX�,4x��x�Aa�HM���'�a���#޸���#�ܲ�e�����G@���I꫱et� �g�{����?�� �z�����|}���K{�<V}���ln�u5���åR/HĲ�OuE
��ݏ����%Ϸ����F�q	'�n2%��\�@������b�C�/n�TrEh��^��_���?
�'�����K�Ѱ��8̛������i��rF?`x��Hʓ���� �?�o�r�۹B_Ļ�G�6��$���� ���"�[���|����A�N�_�]F9�� 4ܫ��O��.)�+�'�r�]���q��~%n{z�6"h�we,�Z'��oqb�B��vlc��ɟ���ݹ�p��c gv�D1��^1�6�kRV������e)r�h�ih�͵>Axm��_*�σ�P�S�_���3l7���|i�&����^����v�h�(��̫��	�u��=���~��w�f<{vn�v�k�1��Ā$�O�@�w����g�p�2��3�r�E��K��r�����������L�C)�Ǵ��D���N��	 ��2�McٸYY�n<{���L�A|��A��ٵ4�F�]���%u��ؙª.�sb�ٞ)^9�V��H	p~�%��F��tnX�(���|�ȿ�/����츭�� �i����lK�RͪٛQ�+���U�#˺�Ǩ�~�#Z���n��rR���iι�ʟݖh³q�0����[::x�,�a���,��Fl��[��ʷ�~WrGZ���eؤM� �Y�~�z �S� Z��6n۫����R�H��_kadYdor0s����%(Ou��挺����\���6�S9���2��-?�A�@��B/�RQ2��jhө��zi��X��t�C!��`�݀9�pF1 d�nk��D�r^/�����y�#xi찆�0V��M�P���׫S%T��n�৭�׃��Y�+��(�?��2[����W�謈��[n�,ͮݤki��I^���c����3ӂ��.�{,c���s�� ��Tǹ����?���t�I�V?��冃l��%;W^�C�
�͖u������=[,0Bd�T���ˬj�V��\�g����O5(3�;�Fs�= ,Q���������@���� G�ԆP�z��,j�$�J�
�/�q�o@�;�<S<��YV���x+�CjZ�$�&ƌj�`�.�8�3�ʪ��.�[��n�����о/Z�]�2<���{h�� _ԟ�R�9`@�OHy�����`���5��?�Q�ۿn�� �A\GS�Α���Z/8|����O� �*(���m+��?�������I�Q�^�� .Ӂ%��)���A���2��"�u����Zz�w�\5��)D.Y�w��⌻G���('^��"� waDğ%�u���C]|^-���Q�eH�`��������n��}��Xwz���혮�+�,�<������U@��OVH�u\mL��������.���.�+R�ӚD��_�@�9e0G�� w�e�IR[Bf�A�f��ώ#IXB��Դ����[^�����PI��$��x��.����!�*k�
��G�EA�y^�,��Aэ��TAn�7��h飱{U����K �-kـ������Z"�q�3�,��`+C"�c�������i$� GGydv)�CZS���*�,WJ�Os���&�ͫ�E��k6܃^&�߉N�HR<���_�@�N��( HQ�p�m�#��"�S=��4M�F�R��V�>@d�����pܥ^ԣ��Xk����wU'�q?L�6=H��~-��V��Y�nMj�ve2\��`�V���z���Z��+4�� 6�1u�=ŏ�Q I�3�
c�*�uz�����Z���gr�B;�H�~�� oM�K/��->�f�d��UI�m��� N������e�V{Z-<vZ3�t�!�N�߼�B���
3��EP-�SO������p�&�l̞r��D��VeV=��酰JRKQ:������y�{tC��#�\7��Ҟ� ��TlV=*�"�
�pM�ѽ0��b{ojFW�
�g��e��>�^�W%����9�ϑ8���V��u��a<%�-<�<��Md��>����zkR�R\���;~��K�MVDÿ�\��ć�태�zm�:�cC�,%_�����Z�,T����vQ�B!XR�(���8��88���$���+���x�����ŊI���g��H+��^11G�"��K c=�B� �hq�jJ���-Շ���I��>X_ /פ�/�Bo#�C��hگ/��T�HR���N�Dj�%X�%�=r:�8��X6j��R�j5�5����t�VZp$i[QGo6��Ԝ�S�[��^�,w75�)Rk����#�< �y��?����.mf���p6�X�6�z�Ͼ���#x`rAf���FA!K�m�w��y�k��(-K���)��X���#��P�5Sw_$�~=��y�-m���)h�����0����?k I=@TbS��,ʮy�����v�ϦT��ܡ�Q���n�Z�%��W����"XX��4��c�RK���0f����_*G�.�]�����#I�EZ�Б��Ȍ4����N����̑,�G?��^�Q�nn.EFH+laۋ�QY9���� �N����&!b��&`drUg�{(�{N?^�ȵ��T����	,)"�>����nT�����k� �q��aB�
�{g=jar̲o'H�:J�E}�B�#`��'��@3�z�D�_�R��ϴ�Ƨ��\�v�|��Mւ�����k�Z��f'��Mƥ�����c#����������ƥ�6g�i?�+����{�o[���~o���(kWY{t*"N�p�M�!n4��� 1FY�������n{��W O��}���IN�_|{��r�C��%X*,a��V�#Q���y�~W.F7%-��G��k}�Ո���� �_;�;�
&��M��ϐ��7&eH�c/�SZ?�29�Q����C��}�;�p\�˓6%/j%�̈�΁��E_�~h� ���0�B�m�+� �t�
�$(���� \��={u�^�E������~�m�af�##�����שRJ�Q��q ��#���Ir.�������Gf-	�l~�d�
�QyQ
�O=�1W�d�����q�������C�N	�&���_R_������̟���JL/���,�Dcʾ�{~j���YH���znH��U�9d�����C�z�� o�X��Z�l��r���9��������t֧7���)N��G�U��2ɂ���6{v�X�T�7Ln��m��#�rl$a�r��ϖǠ����XN�swE=��f_~��'w�E�#�CDD��A'(����Mt*H/ēĳ��Ta��k�A�+耉C��}������h��}7绉�G�u�Ԑp���{�shd�j�/#
"}�6P�:��BI=�Lx=GiA�ݛ��m�#�:Ho�u��&���$Bg����t��00:���\4G�� ?���{X���w9���� z}}:1@.��[�������؞ĉ<��H����������C$��ԝ�!�QVK�h62�N�ʓR',B�d�$���!2B)n�1�� �����d�r���F�1 L�(d��3 0�y�ݍ���d��U����BȊ��'��>���pfH`T)[�׵��j�פ�=t��a�_"IU8��u�ۂ����qGmk�EzrA}<jј��k�����1���^��	 �CZ���RūikVHݞܮ 
j����KPk�ë��o]�Ҋ�����fͲ���$"0�G�8$�
���8�4��/q��q-����y"}��C���t���q-
��{�7���c����k�H$�:ڈI�/�^H�@x&�pq��\���<n<l�[�C;3�N����{��3�#�H���N9�j�{��:�kO�!��<S�[*��2}��s�OC�Y�\�q�H�1��׽-�<��F��GRp�Y�/��Np1��8$&��^���6%�j<�E�:S�(����'�~�`�Ê��5�eYm�-	.F��
z�%hê����0a�� C�
�	�>l�kxd��6��~M�����-=�^b<P���!P#'��sU�~m��)�~�sm4�*�k3���L�>=��߷E�ݖ�6���Y�NW�-'�N�=� l��?ӡ"�t(��GO�zy��[݋Z�p�� �v�2zRJ"$f�yG���N3G]�ޚ��������7�4?�o`X�����=p�2r��ԽZz��)�P��W4;��W�������Cr.�Jb�6���<T��	 c�<���Q�9��>�/�Л�r���Z�m?����"�

�Kb�ϗ`:����؂m����Q�N�˔좐�"�mT:�Q�ሁ�z$��Q�O���mn��!���v����>�/�U`� U�k.�
���k����5^��T���*��Wϰ=�3q���^IŸ��y�{Z��e��mXe(��#��� �U��M�FN�3�hgb��H���|ש��.�Бyn��^M��kƪ������O4Ĥ���{M�۱ հ�!�IJ��E���7U���5�UR;�p��v�H���"*��;� ��Ű�Xt�ױJ	F�P������� gפc��1AM�*���4�I�8ڝf�̣ȯ�ݼP��g�c��5 i'�[+�0���(�j1�\���b:C<��%��@���q��V2�KJ����[�]�ь��*��Vҷ#Ջx�Z����AMY�c��`�q�zucU���+��"
Ը�Ic,9�r���Lz�/��UeR�jG�BR�~"���`I=����rbQg��������l|��T�adZ�U�&!V9l�8PrU	��tF�=��j����X��-d+�q�*�� ����!#�m�aV��lk�́<�Nq���Ooצ`�⹭sU��h��v��4-=��bH �2�/��l�$g�h
.ģ��D�=����"����~��t��+$��m�<��hǴ�X�u~�}r}ϧCpM�j��g���"�[�(���G{]��m3B�yVT�gq��r����gU���NT����/����x���"�F�Z�dE1���|��:�8P��h����A5To�M�yc�VoYb��~�(	����q@��"Z��.S����M5\5� ���r?����Qc����V�d�qWĕ�܍�?k��@����K���w�A%r�S�n��Ϗ��R0 �l�~ΪZ%A\��� ����:o�x�Y*֮�.��5�F{��'���� �3�}� ����J'�|��f�>i�m�Y� ��>F#�^�p��|����|_�xw�[������z{����v">BX<��##�z�u�2�ݳ��a��|O���$��dH"$J�Ib�0 /�}����������Q�ۀb	�P�M���~-�iɰ�ڑ��Z��K#�|{�������e#d02$}�$�' ����@��j�Nk����hq��?	ԿZ���sa�v��D�bp3��f��V�_�O� �G�ӳ��]��� ޝ�0:�bS���5�������;tHx�\���#�
�V�V�� -�ȯ���߯��E��`�8\H�W�Y  
��w� gS�`�#�J$���B<?PG����[��l�U� 2�W��,&P4%��?gXy�Z�do]x��^7��=�TB�d���2?N���Y'2��2^�� �� �Q�=��s�sI�g�c�<����9��`��T��q �=^b��)ǓWE�߸�r�����O�f�) �ǐ#&+`9'�o�X#0UԔ]g���k'���fe���!��-�o�b}GK�:��Hչ���zz�� �EOr��ׁ��3˛9 =?Q���'[Ց��{�km�V*U�3Y1r�Q�@c!,����MT�N�v�/�=$�ƒ&�aW �J탅�R��P]�En]���Y��e��ىvAT~A�}ڀk����K(��UO��N)�N'��ݧ��+;x���J�$ya^4b��� ��@��?k����#gKrx#�^;S_i!� h�8�l��}:��`�K���Ow���|� *� �}q�y��ӥV9�Q�n��WW��ӪI<����«��I�:�RcU'\��rީ�4�Y�Y���XK��
���M�� ��K�.��	��.�ԃUJ�]r�>5���Y+���ↇ'8����B1�M��.Q��}�gF��Ƴ�v�`�6�J��=��Cm��\&�,�*�;[�v�ΛR߁RX*��[//�ggjj P0<W�̫�.��ۑӭx�;2<�\��bG`��5n���"�� `��]�ҟ*�(O���۰���Q��DH��[O�����Fނ��6��g-�ED��#�B�F�~� ^��M���w�a�E��>�Zm�Y�"$q��R���'�ߥ1,��v�L}�>�����YD�R��{��w'���ТIF�Yw^+�׵���e��ڒF<ۼ�N�$���uk�) 0F�����ߤ�*Ԣ���&��]�7��kd��zIQ�4aDo�;�����r�!>R_�}����7��B+���eOw�ӚV�(�X�b�����zP2@F�K:��2����WZ�Iu��V�d2Fp�Krq���5d��NG�M�����W0��'H(�Uo��#,;���nlu.���̣s���g�k� �@�?o�����j��^������q~���XQ��(�2e������YT>�S|eWi�����G&�O�����D�	w(�YY��'#	\`�)+a��ݯ�Ǯ�%m��i������ٌ�Bƫc%{��:H��( ������wv����Y\[�]5-����E'�rP���#��j�h�	!�4Z�v*�'#�Z��,��G@�3*xR ��A�D�PE���j�
7��9,�AU������뒴=�� 3��C
b����dZr]��IMD��G58��*�#ש�޾��L��֖������v'��0�v��ɒ�j��23�6Ԅ|V��W&��x��z�d��������9�?Q��@I�"��?���7�=������X��,B�s��o��Ce��p���ik��U.Z��~<onݫ
s�=�\�a��q�:@%�}�_+��:{~ή�{3K�e2��P�d?�Y%�
��DN��v��j�[MdZ�
N�̬�8V\z���x����	$�.!�Ɇ��UFJ� �8$��ף�P� ��_�b��ަ����V�k�efP�F{�=N4HGEҷ�`��/��7�Ɠ�<H�n�nˁ�����jP�� k���G����� �����`|z Ҩ�3(�f��{F�k��C���^�u`���dFlv�ߢ$Hb�~�G��T�?��Ҋx�hav��h�d��1����@=S��gW{Q6���n��J�89A�9��ϧM��FQ :K�&��i���r:��s�
4�S���� ��t����O��q�?���d�?��-��뵫!l%��^�?A۷Y�jY=���p����z�/>��-O�$�*��� Q��J�XNC*�%�5��߿���`+.�I ���z�â��+_ɵ�����*~M�>Rק��ҳ#�_/1�2�>�_�3�ܾK�ˏ���䏔�x�4������p*~<�T���� F�;�����A�Ŀ�)��[}��_�+��#ģ�|�C� ~��ӭ� �,��D�F���[ć�3���'����ؘ  ��ѳ܀z<k��9��GTG_�Mzb����e�q���֨����4C9���u��=���~�*B9�x	6�t�x�d��$fưO�K1�X�����BB�� �׭���G��0��i;\GQ��G��ڷ^I ?��^�:� � !}�o���n݁� �e� �_�?�'0G�˰?��A{s�;%�ͳ�3�b\,�9T�_�Gq�v���(�]�ߏ�~��ʮ�=���8�0����Ͱ����J�G�b8Ɋ��]�ON�C�n^�&D <K��ӻp7e���� 'y�$��>]�9]�k{�vMȭ���Eb4+��E]q�=y� �۶{wټ[b��ȟ������E��� 5wI�{��̹#�5�&�\�I�xu{@����� �0?y=~�bd� �P�E�%t��W �rps�=�u%'�h[����%ٲ��7�����(%Z��g:=�S����N3����?I]�i�S8��6��R }��Kᓀ�!p� ���Fy�KZS��e�d8du!�ԏB��Z�0��.����4|����� .&��\�>/�o.ۯT�Oyj�m�I<Ǘ��%S�GY/E�@�t�]$�ٷS���+� aH�`.F?oU� S����� k��Q{Q��$-J��;Vd¬�6B�_��Ϧ>�H�����&M>����WXD�[�d��nB�� ���D&=SE}f֨Um-��PʐZ��Œ������;J���x���iq�h���w�{׵ѫC,mƞݹIv%q�s��"@������m���]��� 2N,6;���;�����m�ۊ�8�i��̵�k&�^�Ԏ�DC��I����H%5d��r����֩�x� T���_k���*l�CiU�4.��?t\�?�V��B/bɂI'8�:y�D(݇%�:��\�� �H���W��ҿ�j�5e��N��(6!Mj<�ksN��=R���֣n���8�I�� G�� ���bP�'�\j�4�n=�J��%������J��W��I_�`}:{�z��w��+3�.��UL�5��nؕUU�%i�$��Q�}���'�Û8y�,Y�/;�@g�;���(I�!f��堏�^�Κ��w8Z����BoR\�mw;��B�jn�?�:�a,�����2Ty`�ש*K�������nɶ�6��U�+�B���?��'�}>�!���%�D�_�c�k�q����Z:^D\z+5����=:��K�
���j�l���uoI"���3�F̂Gq�~9�F>�&)I�������,�4�H�ݳ6��ir A��R<@�rs����<`�_uF���r�a)�\U]JbR���Tg����d%"w�=���8��5�Z���Q�3��K)�}2:� �:�_C��B��rM�q]�S���rK�;���:��rB1�$��f��!�g[̭G�mWN�Y�E}�3��C}ſq�随���"�Ɵ�G�۹dx�د�נ��"�l�ޣ��)�+.�O�։ ����h���BƓ���������)�{����F �r-խ&Ëѩ�7�7$ܝZ����*{m!�'�lx��=M��J�$X�"��k�쭣'�'��6|HBh���{�҈6�D��[���r8`�"�$��1��ڣ������P4��b�nZ<yy��U_z�c��S�H�.�
���r�!��>��v`�M�>�S!�y&�$���$��Oj�����`ɰDD`�li�#i&�{p,�م�EE�p�>�0)���M�M���d�SZ�oԣo.��y0� �$�d��Fl��.,D�?%�dRЫl�(�S�~�E�|�ɑ0�5�ia_r|b
]s��������!�Pu�N���q�m����U�c31���+;x�}�2�;}}z�%�s����P�M�,vd�_8�|�p�J������Pĳ"6h�=$u�0��尩�x��ޘ� ]X`Uj�}#s0˧�5�&���#4l1c?l}���4�J*�7D���%��EŴ�-f��� oo,�fn��?��6��b4�D�[T�Mn>=��=�i��ǳ��S��n�6��\u7㍹��~-��Wvg^��l��To<��9�=�c �@b��jx���+q9^5TA��X�Ϗ�8vbs�=L�:�m��u8�_k�&����1��6�Gk����hj_���4�-3�t�_�>����<��z"
H2#^-7�$�M�ҍ`pO��,I����7T�#E�qU��-������PQ��I��h�s�ND$]դZ�EL�-Z�ŵ,P5:�""��(����l���!��X-�lOYa�S<,�ةV�WS���
���{Bm�*{���Z���Rm�V�r�	(Q� &�b�l2�9`c$��0�j�1�r�Bu¥��#$X8Ǡ$~�Ѱ 5\��z�����K�vr��-t�YJ��2H�L �����he�\� �C�ۖy/�_j+���+�X@?�vxT�� R��:^5B<�cp�oCJ-:��5c����'=u���>*��H�gf�ydg���~��
�Գ�z+��Z�^/z��m}��`}¾��۴�?��S�t����O�zllT� '&�N"�nK�Fʱ��a^��#�������ۍﳭ_��*�P���}� ��r�����`����{\cd���^#kSâ�qң���M�5rFG��[��I=��]}��{W/�͗s�� �8��"d/]6����.�e�7���X��ų��w����?��\�u��w<��|3�ca,���� ��_���*��NI$u��K�y]��c+��`\���}����G(����W!�v���ܛ���H��V4�Pd�~�����d;b����a�!�ĕ�����._v�p�nK�c�-RCMZQ�ڟ�͉=	�ϓc��ۯOnD�p�[��b�B�9�%Ug���$wS�}1�z��A� �A#�_�f�9�أ�3�+al�J�y��I��Ph�� /|�����ˑ!v;t}nWO���k�	L��c��������"���2��Egֶ�L�`�I�� �u����8/�o���7� �?짿>����	Eb�̀���ciN0У��ZP��3����EЀoJ�5�B�{Z홑���_s$�� ���q�,/��3����焌�:��]�}|�����@�A�ų��Hh9-�����`�L(~)Pr��z�A�%`�kl4i.���!�~<���`(�q���9� �Q�m��E�j9_�/�����|���zt7�e����"㜖l�����3���
�C�Z�a݉Sv��^�����*D�g�<Qp� �َ�!8'?c�����$ώ?��g���H���[^p�I��m�����->��Rm-[��Y�4���d.���� '�#�&@;N*���ĺ�õ7�t�4l�\�Oo1��Dq���t��d��\���jӳl��~+InC&�/�fr1T��urC�����7u�\��Jߐ�ab��f�8o� �8$z�G��2>�੼������YO_B�D���Gw�7&���b�#$x�ޙ�ʑK��-ͭmh�� �rex"{G�Y�T��P ��ӠB��!J�nI��8��2�E�Rߊ?�}D��IZ�W#�Z�m��yki��mvͩ�QO'�AJ���I�@9��Wn[C.�NY��\��(�8����{	�v�TH�ė��S���0�V)k�q�M�)W�r:}>��g]<�̆i"xQ�@�� �%G�p~�Fj��b��k�:�5�:%(�Q�r���2GBfi�FK���I��)�I��7�_���u�N�-�)Xc#2��t�؟���1!Y	��#�����%�T���H�ן�>_q�1������Ia��S2/$�}��g��f��l���*���{%�NwoJ�K�k�*j�y%�X+H\�8'Ă�(�tDWRv�S��%�Ik}`�B��D��i�N��*,|��v����ȶ��N �D�UϨV�����@�XŉA8�Z���v���6,�y�Z�U�^�}?A� �	 h��������aȹ�:xY�8h"@�4�o��>�H�9j(@%�K�֩CWr���iV:t���Z�
�$g�4 ��R5(0e�WV��v�ݝ��ܖ�I<�i�,@?j~1 w��r���E��,����lZ���X�4*��T�(��$�S���s�m�W5��F��Ūvwu�GU����
J�� �GӨ*R�2뫫��f� '��$x�f5��GQOoPI�;����]-w���lࡱ����v��ű�U��g�F�� ].��G��<�i٥JktmIh(IR6�4' �뎬K)��>;Z��e	��nSbi��rh�a$k�Jr��`~�U��pqE�������eX� !�VO��� Oקځ5�ޣ����٩o��v�)m,���3*+0R���,;�� Ib��N�]+	u��Y��-(�˲�� /�#�I�ӈ[攥�j^ylX����"U�G���v�0�h}1��� ,#K�j�f�Z�:��Sgi�`]Q����>G�#U�+� ��R�4�ܵa#����b��VA5�����?^��ST8�v�ix>����d�,rI!� K$��g�f�7MG�C�i��l5=	�(�����!O�������08��,'�mf��ø;O:I��{bo���UNOo�ר"�f�����I����M,%��rI�T�,�Y�s��=0���Ҽz��ذ�:��n��[x.�d�v��1�6�OS�Sxx�[r�Y.J�w����Q�v�����a�A#����Ѵ��	e�.�� ���F{���U m�m6Q��tQ�
{>F�(��۷������ ��(��Ɲw��Q�#|�H��H��Ta���9o���
p���0�cl|�r>9[���0�w�:I\�G9��s�*I9��(�u͐w�ߟ����]V-mu���3'�&��Rz7�,��m����/�V��3������I�;c�gK�!�%�]t	�sn����d6m͙�<�O]P���Z����
G������Â�*$p	�.��H=�����=r[y�<|�[��>>���U�C]��ch6wj_Ǭ��:� �o��w/�y6,���Y u�"?U�/�sn�jr,n���/xx�ä��k-ݒ
�F���R#S�}�X���{�ټ�W�ka,H)J/�</�-Jؖ��� �� =j~A�W�EV��~d�ŀ9�<`}I�^��1��&tq��,L�֟��zw��r�@������rԏ&�O$��c�g?�A� i��ye-�"�6��'�G�e�%�ʪ�ĭ����	����	e�aݹ����_���?\�v�]XP	l3���q���T�h��
������0¡I�����������>p2���{� �}zk@�۾��Vy� P;�N޾����a�����ҟ� C���O�~w�ַqk+rωio�VfX�KM�q��&PXE��~������:���K��ei�)��H���W(O~�lx۰-��0Z�ȵ
W�W�wsbM�p6�Q`	��D�S��Q�ܑ�Ւ�`�Y�|���<��#�o�7�&?��zF��h2��Ǯ���)��{�q����$� �����V)�{Kt�K[K�;ٜ�K�!J���=4N%C'G��O1WکWx��F�C*|p<���cץdw(�˵�l�g�d,0`Jw��oP����mvE����� ��� o>��_�� �ϱ��:	�⫾9�N������ܛ�&����,��<�<�_a��;u�E�)6��>Sv��C
��{nꎶ�P��Y�HaN�1���w��g�f�m�<*�Om�8�|���B�	`��7k�F]L�#T2�����_��� QQ�5˶gժ�_�H�����7�H+{c�$�6[�Q���~=��Gw6$��ǵ�G�3�zt�Te2(���I����ٍ}�u�����m���҃�qJ:m�0�U�`���Xb�%$���7�|��q��>ܒFNں��(v.E��خ�֊���
�6���t ,�Q�5��ZĐ��$ζj��݋ck#�阠pA���ݚ�l��j`��qW�A�F��
�׾�뎐�0�G⩹����꽋S�M�6����!M�  \��%Z��!�y1o*0ku�<1��{�E����R#5%"j���*����ь���YS�{}�ߡ���� �^�����(+	���-#I!i��󓟯R�����t�85��b$�]���-pUwl�I>#��C�	!g�S�▍�Aɢ�4�)[ZjUc�A�hk�N��0��죨|Jh�U��z�͖�
�AU����P�� rnz����-�W���k?���zK��[�"�g12��!�1 U�®�Ԩ��3D� ���:�f³�X�5K��je��X��T��bH�h�l���;��z��G�\V5  �Z�O�D�VI�m��BNE���=G�W���]YN � �3�O^��"fN)�4�8��;]�ʻ����P��*Z�� �� )q��{|�R?�i��ǒ3�#h�� wP���$�n��Վ� #����r�-{���!o,��=�c#�~��%w,�Kƪ߉��Z��ᐅ1\��F�O0�P3g�@�3��RQp�H���j�E/��;��p1���q�1�:�D�F���-�kssJ�S�]]!~V.�KN�U؁���Q��I��m��4�������͒[w#Cd˚0�= Ρ9&jԢء��6Q)B��V'%s�*�9 ~��iT6斠՚|�Hd�qsS[X,���4��)�p{���=B(�GE�N�HY7�e
�� �9=����T4�I&:�	I��-������o ��:� �JS�ѣm��i�(��X�l�������Yo}�'��蘥�:��֑b"������M��b{g��g t�ɘd�od0Hͥ�T l���d�BeoP>�@�HԸ������ �<rMs_%��4�<ATcp\@����.Ў�t�A�P.�c�V$���?��0On���Г�q��[��Y-̆x� ;c�8�-�����?N�� ��_IF�8��בc�4��4�$F�D�d9bA'Ǿ:!��x��lq��r&aR�q���w�^6�_c���~������O�p��-�KY8�d�N�@�;��c���d�B���/���3����x� �<S[9�YN�l���Lz��M0�b}RZ���Ƹ%[�Z����W2�� �k���ʝ����b���;{/�A� I[��m[��;uQ߷�Y����V��gՓ|�m/�!�p��H�'��B���V�Id��l��a���1յ�=�¸�TW&2�#?��t��V��S�Ke�(<V'��&����<�ZI"�#�?�u���=� o�~m�������O�N����=��ȏ�H^�����n�#�ބi����4�G$�����J�)#?Lzdg�=�_t�q�E��{a�z� >�b3�Z��_�;l!s�.\N��
��ʾ-���5��U��q�4U�/�P� �<������k���r�iH .HlE���Ĝ;%�q	W��κ"�+�ٓ���'��坉>�'�����&�����c*@� `� N��@��aϐ�RO�w���A�^����>�g�Z�O�د�3��C�;fU�����5]���,�>h�#Fs��~��kS� T��($�����{���ф5\�^/�oW��>W���j�\��SE����<媌 m_"�u6�8�5��'ѐ�F�ڧ���}���b���Pʲ��%y�R����䌗U�X�����k|�/Ċ?�v$������� ����.��k�eD�Z�R:��{�x���d���%7K�G��f�{rJ�ޙtu{Q�d�l���A�Al���Ւd��D&�[�-s�W�����``7c�����uY?�tk"���Xd��]����HO�=z_7�TO9�7'�\^EY5��b�I��hB���v6JF�t���W����c�������q�����+Pɫ��Z����m~��I�k�!Wt?����2q�3�~��Z%&�T�HL����:�Y	�k�8+4�"���O`�'�҂�7as��Vk˧�Q�R)'�ݿl�#VfPV�oO\��c����@�����|�M�q~�sZټ�91��B�Fq�����(r�vt~���{�\�ŵp�JY�.�B�!?Rsѫ(Ǣ鱗��v�}d�p��Oi-�[0��dR�
NH�t�gL	��O5I=���F �x��|\��=ON��E�WǷtj�]6�y;��y)�rd`K����}=:bI�IS�]�;��m�t�7|hZ���w_d��P����슣,���$(����)�	�n_�kĵ�	�����ăŋ	mHI\��?\���N�]5�9dv��W�� H��^�������=�g��%$ /D\�*m�@����~�z��k���T��!�;�#���6R\Ke{x��2�?/�X`so/�Dck�9����ކ�a�QON� 1�bS�� �zc�zs%Y�i��2��V<�ׅ[2B^mUW�_��Y�c��``~�%�;#�~�L�[�*W�\�bv+��JZ���S�T�F��H`lؕ�h��
�'�~�1,Y-J9w���]����ԫh^�� ��Q���GS�z����z2iD�TA�7��>qi�Dd�Φ�P@/��?v{c�� F���(�|���V�m��M}���z��*ƮB(1��{����F���&�Z��*rڨ:�Z��+	vVg�����#�t�2Z�Q�F�}��?��iYɱR�M���,g����222:_j��2Y����o)C����I�;Ÿ�K��y�;{bFH�A#(��b@�n�����<t`ik�ejt�GXZ�U�V����~�NI?�=(PD�+<�*�37�<�ۊ/~D�u'��W� ������ɣ˷�������y�:y�¶Ex����2�ކI�Ж(��tPp�!�<5�W-�k2i��"Q�� L�U���}�
lC4�䟓�)M$rV��j�	-�R�} ��Rl�v�C����H��D�����aI�d�R���l(�:�l�*�^-~����3=��v�p�h�w2%�ݽ:p	����N�S%ʓrU�%g����B7U%���G�n��=X�#DO_��[]N��o���Qb�~����@��1Dʋ��ӥD�utrS�0�ch,I*<��fG`����B<{����GM�B��4�9(l/�n*�5GNI���A�8�D��B6:L5j׍�m%���cx� �ϣg�ס ��,Txƚ��$[+�#۽nF
;�W����'���ވ� �|���Zs�׾�+tզ�;m��fꁣp����#��B(���t5�� /a�6�$��Iku�
f*�!����N?oR8҈mR���"	}���1�FM[����_,�z�=+T�⺿ı*��喼L=�v�ˁ����� Q_�5����ñ䖮OZ?ʔ�6��,���n} �����N��7"��J5����H	A�i����(an��W޷Jh ��I��ܕ^�Y�� F:��>��W����5�Z�G�|{�$O���:�����,~�b�.ev-G\pNz����-����ϝ��S�o��%��|��r�>�����J��}:�j@E�\��w&���>B���Ȩ�l�i���(A��5Ϣ�;��ff[%���cf�+n��ԓW�.��� �x}�;��+���d5���m#�eb^�(U��s+!g#�d��_[���� *�HE�bs� �{��2���8�x ��O����Iv^����<��=���|�?���"�q��3��z��� h;����͐,d!������ �0��lKM������Q����V(�~L�
� �,O����t��/�e"��_О�n 8��R� 9?�����}�'ĵ}� (�p����1�W�f�W�/��wRq���� �����}���,�;E�n,	Cqg��%�� �}�� ��H��jc��Y|�P�a�̳�S�br~�ׯE8�ݣ���\�7������u eQ;��pH9b?OO�N�T�X1P �� ������|��p�UA�)�J1�4?�O\�����h��Ro
�(�vb~���?\{u_곛�;�lf��,cW�~��5u9������7z�wYZ}�M�A��p�Y����b������x���3�j��.�����:z���4.&�[�E���xRpS��,�ۮm�3�ڷ&�q�w�r�Mj·G��Sў�x�)I!`�!�'��A��;�NJʛOģ�t�q��@�О:��]�B2���c��ǧUNe��V�G0��k���;�S�,�>ؑ��@ f+���
b�m�6�zJ?(q=}]���Hh_�b����+� kH�~�b�=��۫a0B�A�epͰ���Z�r暝J05�vfh H�y3�2}Ө��E��¿��_WJ����� @`{��oנFI�]u���yy� p鱜� �MOOO�x�'ϢC�k�T�	,���5�nX����fI���q�����k�ϴ�WM��u��M^�ě+�_^?Ȼ����!��_S��V�S*�Z�r+uҳU��`�'[Y������A��Ќ�MW1����QAC�֎%�_ʃ�k#8����D��m�t/��)^F8�J�P2k��[���
�_�P�g鎌�j�͂7���v������t����2�	��/�	�ۿK��pL �b�٩ʼ�Ż�2J��)�V@v, ̒[_�=F�
V�nY���D��q�I���ݡ�$�yfGk�G�><AY,D]��w$���qs���VǠ�k^?e��b��e�B�#��\��f���������D��|��~���� ��JD7A�gl����bř���Z�� .G�>K}�tf�Ė܉�_�P����5�Ie�I�]Qe�`��/�\�"O���g��,�j�l�����a�k��C,�����=Z-�gU�Mz����{��j���-٣F*�G�.d$� ��^�w�V���8ź�d���eR��Y�u�l��Jdy�!���ϧM'%�aGK<�Q��%�ܭ'y���Y���y}��$���}1�B4I9Hf���n_�V���E��b�EMIϊ�&���}�VB��I���5�(9��VH���k(�) UX�z�ר1�r
��ݎ���x�V���-e_:Zئ����_�UB{)��؂R9:�(��/�>�:�+da��KUܓ߿�:$���Pʴ�[���u冋UP�>f㷠�����o_��gZ��N�*�RIq�t��WI�w>c���6hQ�ʚ]���%�;��?�EWZ�##�����=E"����_�^�ncʫ�:�R�i��6�KFLdF<�NOJ@5�BK3��Y���nim�~R�E���>�땏�+&% ��~�Ǝ�\�GF�֚+������ЫȬ��̚������h�j�W��[�ؽ���셊��Hㇰ
��(�A�;Q>�V
�r;z�#�-
ڣ�[��㼾�1�  �����)呹x��9�lyl��5���J�'�2E,h��l~��U�TC/�4:fɓk���d��L�H����GF]0wQ��ra�mΆ�*���
&k'�4���`c��:Q�O*f�Y����+�H&��v����VH�Xè>�}z�]A���X���,ymʷa+\���p�I���0%)��R��9��l-�M]M[���{�f[G���)�x��LE�S����k�	��Z P�	��1���RQLQq�2��]�Ȭ��Ym��>Y����Vm�T�k��2n��Ѷ�)ɱ�Z'.��pO� On� �D����b��㱻���{E��g>�̬
�c����c�qm�������x�[1RM���6S�J@�60=D��/�2);�k�����O�or[�ٽ6��^����fa6|�����ŏ�Y��]o�5��h,�͔e�M��P�0W�0@�pzx�D�:��� �M���׏��š�� h�s��y�&�\��O$�9�6B�~���O���E����� �^s��rBhP[m[[A}�k�Z/���c�G[�`R˛�}#�܆n3������ٚ�~|{k�_�uE�B?EJ�Č��Z:j�K�<��p^Y�����y&s�.������H�[;�bm��`a���XG�O0ž��=t�W���Pv��A'������&��@�tV�c�!E���v���tA)n[ 8^����K� "8��s�)�Z�7}�+�.k#�A�Ң=�M"�5�x�y��'
<�����}���O&�n��h� �On#x����{�>7p�M�S�a6Ƨ�!��{��M�ik��T��S�l�У�$�q������9����O���
�`2?��K��9���%��	4qܒk��q�n�|�8 *���z��?� (��еn��m������W����Q�JO��O�yh�Ov*��EfH�*���$�?F�����W�8��o�d�8��۹�����R�|����~�����l%c�aTr9W8�8���ΈL$ب��Q�����hꩂ�Bn�ߔ�}8��b,���	��N�ђ�v�b	U~�ƃ���%�X�*>��ǯ�߬�5#��r��N�-���Ӕ/���� �Dau��\��=�t����Yi�k]�<-�r�� :1�1��ֈ�.
\xq�6�f�j�����������g�|�\[S�yF���'�շF��X�UjW�O0YdKH�g�`GZo}D�n �J����x�"L<OBC`H&���� �Ӫ̉P@*mF�(f0q.9�dI�Ђ9;��,~C���"J$�GW���iܱ�8�<��n��U���+��;�8=�ק��R���ީP�7�y,���!F-�d���R,MP h�/�,G��g�FAɕ(V��rb�z EFJ��]���Ǵb�zZ�)-��#4Ŀ��0�Ԏ���@��O�=���������J��~���4qL�%�?���<�P ��^9��]��4����ψ��Xg�Re�郔�wS��Rx6�Fjv��M��e*Y������\ bY�wnF�������P���td��h:\�<���$�$tu��XvH咴�	�����bة
���[X92�ཤ�����V߷��ܓ�g tdI���D�<���]&�uw]�䥮�g�d��`r@)ȒF����%3j��e��Aj�:���3Y.�G���՞1����tL�V�C��O~�{=%��7�>�R��*Ʃ�"����=IOb^K�9�\���{g��ֲ�}�&2`�I��@E�T!C�rFi�t�J讑2Q��+�[`	9�~�Y��I�e���ꛚ!]|�/=)�9ɼ�-�>�ӷ~��f�FG�ٶñ�Fk��6RIĿ��H�����߷I����L���NZ���s������0Rn0�D�$9���a�<�����5))��H���F`�I��|��߫0��}���%O�W'�K(9=C�-�!k��ݴ������,%�ƭB�Qe���K���n�!�!f�O�ˑ`�4+E#x5��Q���V�6T�c����X6*9D8Λ��z��~}��h�d��5]wY� �+�|2`����I �qj����˲}��U�h6��u����r��1�y�� �����F�e��ߦũ��t"�82���)��H�ۓ߾:Y_�m���<yJ&c Y���VR��+i�Ʒ�%����[�'n1�}U@�}-�j�s����WR?$c��?s�u �5�^;ʒ1�s{�*��,7���z��E㺞e�����
�"Z��hu�х��(�h;���?��d ,�c#U5�>ʮ��޷9�M��W���2עY���HEP���-��s����
���|��ENu��a��g��'$����w�J䰦�sgC��7?�PX� �b("ւz /D� dv�:" �呍WX��|r�i-˰����U݂y`�O I�FK!VP8�������-ߟū-������6?y���� �n�%���Ÿ��u��m��ߒ�%���^���T c�ΰ%��/�������l�j:�⿃m��9O'm���{*H�9`�Z#P�=�#��(��%r-w(ZWE.a���w�cj}�	���p3�v�8�A��������y6���i^+7kZ�YሀB�
(�W �?_ی��(�LSI�� �6�7<���Ƒ�q/{M���x�$_\�~��"MQ���o�Ng���K�����#��� g@(x!���d�P٧%�r�2�N+[�J���߷DD�P���K4������j{Q�-�81�x�+lOa��ۃ�h6����)o'�5^c��@�j�ڀ3���Tc�׿DD(�g]8��luR5�c�ZO͕U�O���I�<O�>9,����0K����/\�woy�m�7�c)�4S�~!c�S�s�衍Qy8eS�o��"4ܑ�' ����@(��S��{���6|�G�ϳ���m��=��U��aEI<s�&Ϗ��t���*9R!�^�*Gf	6w����r�LЩ�=�g�:�C0�s��$Ѐ���m������V�N������s�������l�v�7ȹ[�Sa����|���G邩
c���Y���w��Ce�-���秧����$ ľ��H!{�uш^v��Hj��T�~���8��:pZ�i'Ϧ_z� �ݙ����$��:�#��a��`X��Һ�%�I=��<� h��\�l��e�icN7^�/��H��i�W2x�����ׯ�o�������f��>� e����vS���� �� ���:^#���{7��Aee��f}ߌ��WRp��/93���_۵*�/���������x~�?�q5Z��Я�N��Lc1��X�	^����q8\���TԾQ�� #_mW������m��?�|�|���r�V���D��W=�ԐZUɌ���  �q�������lq�V=F2��VaC� �j/���~�y��h�D�����:i��F�r7�3����,=K����Gl0�2�y*�}{�=6��]�Q��7�����'C&�}N�ߒ�.��?|�,p�q��+���G8�^���|y���f�+�$�լr�f�B���Ӫ�.3�ɮ� ��Io�+`�M�A��ۆ������� �WǶO���ǽ� �py�i�KF�G��[�*Zjp�{dZ�F{g>�Us�ȆkM��L�_~� ����M�� �g��&�WfM���9]���~���e}BE���q��;~���p����Ѐf[�[���݌2뤈־c�	o_fH�����	o��{@������f'���� Ć��Ǳϡ�s�ӡL�ڲ�����Z�SP+V��q��\�?�Bĺ	�𨣳�������x�-휉��~>t;#�� �	�����f�W�aT~}�$};��r?gB$̗"��S�Y�R�f3���]2yx����� ����� N�ڕ��vx��s�����W�פ�d3Y�V�kq��ޱ�؝�����b`�$�������'�VN$�(�?U�y����K�q�r�6�_�l- U��#0��.O��H`��s�){��<���qn%~����ن%,p�Ro �����v�FL�2��i��J��,[]P�?+����j<I��d��:cSFd
���>]���<�%��6�=)�/�<�%�^7��|������@j$�Tݲ��9��qͲqd�m����i�_nE�ᝀ_'�v#��� 6�t� �5kխr>+���:� �;�(`�q���}�r�q6�yA��F:�{+RK�%�.��@_,���z�ڐ,�@v�9�(�
X�ӥSQd_յy/��Na�2�$���0V���%2�������}�� ��>މ�� �q��>�שhU��^x�8a{�6�B��ŲѰ:����#V���]�M�v�BJ0�"��X�vB��翈�?��1�)\P����5-ےN�Z!��bUT��r?Lv9��酽
���OO�{��6;���dC��<a�1W-�e�^�g��U3!�s�˰�˴��Hn	5r�X�LF#��'��9��c�%�qB0/E�gg�X$S��|2�*K�O3�G$��Oq6A�(>����(��&q�$���,�0ʵuP�!�+�bL�$�� ���
�E��]8��9�<�ml6O~����3)BЪN �;~ށ���D�@���mM��R�<ukr��}mJ����+��ic$ȣ��8���UC���5���5}�[ۍ�����ᒝ����<��G�g�SӪ�1��%�;���9Y��[]�4ե���]�~M�yЮ��#���ă��Đ Ǡ?^���0Y���-�:z�9~�1v��f����#Ox��,ş d��P`��'d�.���o^Wr"��EJ��Y�`� �� f�4.���h5�W^J����i��»��Gr`���pv�:��N(GtC(�������
ڄ�xW�T�����K{8��ө팊���Fiky}�ݧ�3�]Z,�����W.��G�t�  M��6b�?%�b3�:Ӫ�`����`�Ӣ&�+#s]�F�okD���V���R�ף�^L��0�?R U������[��!	�K�������`����C"��QF����)-}^��zTst��Y�W9ǓG��w��Ш�%j�ʬ����J5!�TRP%\���@T��FE�B	��T���2�������kpӧB"��� �#�  :�ָ�4�
���U�*d���� Ԟ��)�P�zyg��+l�#Z�U���$�4�Y�P��� ޿^�� BXԞ����Ә��9�d��T,������t��0�jtiGu漜S��ƿ��>!��Vs]� wC�*\��kr���m?Sr���,~C9�5Q�8,rA��@����7	-�^w�Z;���xu��9�s8����01�z!ԪW�ũ�*չ�.�U���]d����^�I%�Sߢ�
�W2���4�ʢ��KW.X�-;RL)�>K��w }}:4u�����C�֤�����Ge���d�b���s�����!%|��k��0� 0�D:��&��q��~��{�3(��l&�h��N$��v�R�i,\�
>K�~M�n�v�k�:���*2 ^���B7	\�[�Z/�^W�lF�,�#-߹9?^�\���I�lj���=�� ��(��ځ����<Y����GL ���q����/�yq+k��� �{J�>#���9���I�Wث�f�Wk�=����v�~��4bdV��}!]<7S�ٯ3ĮÒ0A�#�#�ճ��+��+���SES�k����4~G�\��f���յ[_*k|�Jb�q�	,W#-߿_������r>⌍�8֠-�YH�ɼ%&�_��6-Z�q@ܸL��>��]��u;$�v:�w_�C��UF@e'v�ۯ�r���E���~q�zN;Š�j��mq{�s�T�+AC3ӧ��;���ͼI�A��Ts�F��`�}�\�n��V��^�rۤQ���r�1���������^�0�cLx�����ܕ�i��O�#�Z��Ŝ���a��c� O_���y/��qQ��'��=(2*�[`�dʟr��l����梦&�
��N	.ӭV��O.� y�=qy�q`�_oC��|>�%���:�4n��A�z�3��le�3dz�ue��8,��n�8RM�
蛅R��kL��YRU>�� �(� ��])�b~�W&�2B�O��oy�.���A����*7�EG�6.l�EJ���{bIAc�d�����0�)D���� |F�|c����rX�?pmW׼�_�j�CO�FJJ@s`O~�T\�22�l� ��Y�O�b�˽�ݭ,�4�Fe��B�������4GoU2]"��� �1�D��1�I�f�q۠K���5"涼˽�"I�Ye�r�5F�q�=h�[�w��rX%��r�f�g�X�n�H�V8�	�:1�S�M���ȹ��*�ښ+p� ��`C��@���Ԣc�e��d�}�g�ꥈ�j ��*�"��o��mE�M����ϗ�N[�� 3?��Yϗ� k��=?Ӫ�7�T�k��7�
�4����]o��}�e��I[�L1
$�~��ѝ�.G��Iv*�ye��7��[6��d�+ڠ�g��(�I�@�oy��k�W��+�,�c�cw�%����`G���Fu�9]4�k��k6�q~?��a].u�&5`p���8�Sx"z�#��������:��A\Mk�#Gg,d01,�� 	��)����=��V[�5�t������Eݧ�E����=�>���w�A�S�ɼ/+�8� ��A��l�5���L0G4��9K���w�2�lIp���u���.
O�� ~��ԍ�!��(��㚴�q�/��-s=�U�8 i�W9���z�B �SD�΀H�V�8V�/�s�>M� ��붛�[��x���@�q�[=�U_9��'�h�NNcȥ�c\u�H�#��`��Q،}֣9�����E�I�D�Z�ۚW��=T�X�k&���\a�f�d��ϧVB$f��bI��z5�S�p�j�GaF�
����@��_��HmhS�%�5c�n���Vf�ZΚ��Xd
}ȣ;B����u$5B2,�Ї��5��r�r41��؊@P��]�����;u ��%�aA�q�0�������
B���uc2Z�|Kk�9�ݚ8�	 ��׫l5S�e5�hL����7�c؎����bB0�� �������ź�<&1��6�S��e@=�����Xd/l�"Xx��w�h�U�Y�8��u��Ks�����h�+�������aN1���p��� �J-��g�2���0A�����]��*w�DL���!�7Fud63#/l��~��vT����]�E���E�M�WZT/8��'g�0er l H���R5]:3m�S��k�`�|�8�����M����t��P�G��r��r�^[*0��U�VQ��I=��H
�����Kqg} �&�ƺ=u�/��R&b�����{����$��.�/#Ne��Y���Z����nj�i�A(Uo$[F�鎔,���n���Œm�9��e���-Mo4i�l�s���\�#�g�q������l[��[�m������B�����צ蠉���~��r���kd������h��褬%�)|C0�ߦ��4%"*T� ��'�s*�v�T�b��U�H���rK
X�8?h��DQ.����E�����yg�B+X�RҠUU�$Sⱏls�q�ۦ2�䀍]������rNC�Vi��iN(����,��!�[�#��D��"CUc���=ٹ�� >��2���(�c�@���nj"]��x~ҍ۷*�=ٛc��Ͱ�F`�X�H��@���;�ROP2V8�7_��$^c5�J/rWmu)ϞJ�d��dc���
EST�n�9-� 	
H̔iǟIR}}H M$t�&sc��Ņ�VJU�Sͤ��o�մ��T�ڭ=�չ�lC��ΕO(��~�8聪B.�jx�ț8�ۇ�h���%�^Ɩ9<C�b=ĺ��7�,�Tj�t�[�U��sJ�^��k}�ښ��A�4��o'o�ޘ�^�����r�K���q5\DL��^0W�0�d�H"0�s�������ߟ>i�й-�|������#�II��P|@�Ѐi���V^G�.�@L��̆C
zw�{�҉��s���w4�w{�b�ě�)����=r/�Ez^lz��G�p���c����~�a�S�B�p{RO�8�ר��n1,(��mu�{+F0���c$�\I����Us̶�ki^��EVoON�� �\�z�*������q.S�������}K�~W*6�J��O��<>9�z0ȁ��w�1�  n�~ �������]d�.-����qK*�eu�HP=�J1$�����S��r{�;�O���<')��!� ��'�Dǖ��n,E��L��v�¾��˚�w�~��nD@�:� ��H�X$c�� O���˶}�9�0_Y���:-V�  ��-���rPU���Oڥ��d�����v�����r�/���l�._v�\6���_;?7�i��q��ͼu��dC("	��+ܒ��w��i��ׁĽo��ŉ�T`h�A~f� "}�s�Ɲ��<EUgRȈ=ٓ� ����������y�c�����E�ğR�;zt��F!_s�J���J�� L���>��*q�)ʕV�º��n� �� ��+�n'��[�������.�-�o2�<��yBx�]��Ce�T�E&7�^n��1p�2W��m�\ү�̵򞮇%����!�{V)�3�ή�ŕ��������0"&q+șJ�ͱ�+�_�S:�k�ˆDn���Y'#H[m�,��� �O��s��V�;�Mb�� ��� #�ڊ�i�Zc���d��Ig�y�|�z�ţ������������܉�ϐm�R"A�"��"d�� ^�� tѶ�J&�-nC��9}�U*�%k'W]�v��ea� �ꚹĕv�9�bH#��+�����z���ҧ���+A�Ze���\A ����������EW&���?��0�^<���jj��c�e1�$`ҡ����S��҈(dq]$��V�����z�V��T� ��p�fR���cy�S�`J��@'�ci!wRlvZ�_m'#���H#������l�{�$����苗t�������>_� ���� �פ`��P�w��8���<zě[��m0�2$RH�1 ��U@�����~iL�7&���P��8ջ��\�Z�m2D��B�¡���a�L��u@������Af8x���Y�/vʈ���"�P�,�: �N�?��:��j#�����QJ��]�D$�����T���O����x�`�5��l�[��T�A^���e>L�������h��]�M��:�ޖ��	vL��1�w*���a�s��F,�6#c*� K��}U��c�>�jz�DD�	I���(�S�c���V&�W޿g!F�K� �X!�sۧ ����$�.{���.�/�.�I"!�šc�P�K��e_����9�YN&��w�hx��i
q[��뼞��QS*���!����H#��p�U	����R�ߋ�륚��1�K҅.��g�Мg��AEP8��W�Ǹ���w�Gr�E_`�W��#�a5��)��'��⁐�d�nc�׵�L�_e4�a�Z��\�4�J���LpȒ<~�'4$�"s��c�+5��a����>A_��~��� %�����x��<rv��쉣��[�(��

�	�}H?��R�)���K�X� ��{���47Ƀ�2�30�|���GJŜ$��4�[S�*L��tYB�-z��@xQm�}݂�����DC_�vz�V<��5涶�GUvf�o�τ��c�����I"�H]�wro��6|t�u��Ԭ0�(e�6��&r��ӢE���f�/4����rRKڻu�ٓ�R�5�`��z��1Nf�,ѫ��}u{�m�T_n/*��V8�Y������uU6��_�y�5���$�׌�ZeH�7���&%��K F%.���s���u�TkQ��jv%�֞9�n�p�5��H8�U�5Br���J��5T���k��j�؅.՗*�~�Z;i����tvPT�Jm��;~S��{=����N�*��*\I�˞XGw��(Q��NI�q��J"8�7�N�ۑ|yʹ=�]��j�����O]+�$g����� ��@OH.a�!��?�C[$Q���=Ф�s�I$�Ғ�;� PD q��f���B��[���Wg�p�4�����q��1#Y���A��=����1ߨ(��Ig�[m���ɱY�Y�U�Jzp�r��	%R���v�9Q�O��N2Q�A�c��k�]#H�AId)��~H �oV#�a�2�M�
�l��v���\��C���K���yOk�T�g��T��lx�$�W�[k��_eDSE��p=���8���E1p�P��5Z�y�0��B�4,҅��� v�:�=J5]�uy���ʞ×iu)\�at�}��Fd­��/���%�VG��϶�)�y����&�Z����VY6.��2��9#�.1ꔇ���R��,���t�_j�j˹e>'���F�}�&b�u1�k�]��N+%J4�Ț[>~r<��n?�&F;t� e���1٬��[an	#��+�E� ��_\`6��z�غ�!����u�u���5Z}]�$(� ]�`��z��p�	�� ���d{]�K��L�ԭ�����[�P�;�Dy���&Y���L{;�1����Zk$d4륕܃������:H��M)�� qU�U�K�+�b�<��8�E��>�>->���8�z{R$�u\�\���pq�.X�]�n&��z`.~����X%JV�lP��Z�c��;]�|���c��p0��~�rn�T�z;Cm��/M�{�^#K�$�&�aa�{�bц���$fT$G����zud �ÿ)�J��]�����4�3v�N�֦�,��.���fH�(	 *��~�����m
��������~�
��GG���l*�j��}�cN��^�����C����y��-ǛğD�N��l�_ۼYq���F����&|��8���ޜZ;>=��u����M���v� �D�q��  B���Y� �������y�#ɕ۶�B��*<��;G��hFQ9��͹� -�^�:�nki�$�M�6o{m���o*�U����U�������q�C��c�[�����0�,���o����������͝���ݧ+W�݄�<��}�O׿�_���?������	�Ha�<Nt�S��%�� ̰�Z�鏘@~@� ���_$��톂~+w�u��ի٬C�bk�я.�
�~�e��'��p]�V�>U �����W����<֖mv�O���47�����f;T�$�����YN ��Q�ۯ�G���_�٭q�OOssD4Mu\	���Z��)ߴ7Z���GP���A���,�>�B<r2q����<W�54U'�\�N����Ȃ�+���T}O��\^�x�b����2s���4�Y�ǰM�R��9�+��ʅ�v`�>#=�����%���{���+"��];˦�g�հ{�p{y~���G[v<sa{{M��^���[�[����a?� ����s�[�K�ل��m��'��� �]�6� ��S�ͥ��?�+P|���j��W_-ok�ղb��է�� �i�?\j�( q�U���8�z�=��.ZT�>1����a��rrČNGӶ:�m��A�|�
}Z?(A~��ž"KZ:q�jG��T��q+��'' `����ÂA�5c��*��<���>�Y-K1���!�P��p��~�"IY��zv�{م-W�'�H�潕����q�ǣ⃓�(��ߚU�v�y�Ӻ��8v4�	/ �`y��L~ވ�P1'E&��%*~!6p� a�>�YN?^�HȄƩV��ok���U�𥯭��F����$k��1����V�� ���霳� Փ��(�����>�=�og�_�����V��d�KE����Z�֞�*���Z��LQ��8޷�R��ӷV&p�ԇ�f��^e^���:�&���XY�92ye�:��ķa��rz2��6� #=.�U����U��EN���3>��{j���5�ð�P\r��������b���Lo���<e�p��~��4DI���ʵ����ɛa/�Φ��U�� DA ��ۑ�u_ӌ�n?5���u�a��@uf�cK;��J�	A��>I�^Z���M5�dUM��ܸ�(q�V�Ԅ;M���M��M�����-�Ui^����Uq�A&��333��Q�I,F��7`���r����Zhu�mO�%¢)]�E�YO�P�~�*9�
�b�^��+�뚻78�x�����r�Z/�/��=� He�'柑:U���bj	d˕h$,K��� 
���Cy��g��;=7���ۆ�M�Ͱ"ْ2�ꊬT/a����Kp,���Z��l�^�[��_f-�a^ev��*1h����wǡ�D���E��Ni1���g�u� �,��[`W�?\I�|O��L�q�6����'�D�.��Zvjm��T��0�+I�%$��PAPc��e2 �T���asi��P]"J���x`��bg�4�e|.C8� ��:#,]ԊyPS6ˌ������o"��'�GeP�R����&���5��&��g�,j�/�r+2��<���q��#�p��~�o��9(�I��۽c�v�Dj�m�O\Bdid��a��۲�;��=h�EB�cw�3ՖH��T��Y��b}��%����H�Y�I����? ��z��uߛ �(�}��>�C���;��:�� I	�W$�h���|eo��%$��W�C���g���U��m���}�9�j�ߋ�3`�k�`WH6H�gO8P?i8�A,
2���j4�_�UkT����!��)0�����O�:�����K�Xչ��߳���tG�x��`��_#/|� �ջމv5TŎQŵ;=�z�B�t&ˉg�,o�$H��7��1���2���a��n���U��nV����lZD����c"���6��;v�P�hSۙ��� ��d��9�����qWU���ڗچ���fC�O��$�����DF8D6�߻+�%vL�$���[�� ��k�3�4�J���;�K�� LeU���v�zr3�PI���|��V_����^�3�+$~X�{u7� �N���yW�n)r^9[cj�UmT�R̕eX���$β#)rI�w�g0[65].ow|���M�X��s�c��R8vu�f��/�e�{�돧R1t�E�K�4Z��y7
�Ԟ�����b�"�8��Pp	��D	2����&�]��=��䷠�}�\�^R�(��Y1�%A��=1U"Ny����Ț:��Ǿɵ Kwh�_ĶX�b����� NCp���1�#���^ �'y���|r<s�c�)^�+q�SGi7$���`�Y���k4;*��uoilDZPOf#��rL (�7'�:�� �v�x�5a�`�C+�.G>#'�1қ/�qp��ےr��Fe��%!U�#��u����>'��V 	�)K�{W�5������ݰ�U_O8�ZaGw��Xv���Ռ�����E��b��{�7���U�"�c?�0H���`BH�6� �Iow�� ,�a�W�V��s$�a�#MO%z��e*���GK�\�]y��kŦ�tg`��5[�,�'÷�u����ѝF����.�er?�Q� �u͸=k��J�Q)-��[���
����S�����F�gzN�ʦ�i$�����䃟��ы��@e�Q�H��Y
���_�Ԝ�z����n$�<� ȍ�^c�ڴ"���i��c�y�T�!#����.=:���M��v�+v�&]~Ƽ���oʸ�2�$�N?��а��XGG��Y�d��SA+��`@'8�5��	�kb�[���"�9w/�rmZit�|i�� @V��6_DP|#;=��e.[� q���=[�)���>����3i��I�V��ɐɏ�cՇ�DT*-wY\,BG�ǌ9
W���x�X�m�"d=;�I�g������4[��3d��i�lx�e ��$���\6onև����qe~ɉ�5��n.��PE0��*A��^��ݡ׆�o|�k#٧ �	>�}}�����?�uŁ�%����mC`��U�hhG4U�c���;ȹl�9��V��A��q��<�&�ߍ�^���Ϲ����+��e��tlp��3[��
� �\����  �_�l����yW�[U+�q�lH����|��rG����z�����+m�$D\�VK�h-r
��/��pM�M��ǭ��{���xj��CK�i �=�NEN�Pg�{�+��?W*�O��aFoPi�s�l�΋c��oaRK�t��.梪��W��!'ă�8�~��h�U��n��eF�Y�\�+I���YG��9��1��Ix,�������6�^­d�[��H��P3�ƍ�ԓb�uw��kd�º�]�v6��h����6�;)?�����D���4E8��D��������d��dH9*��͇'�X�:�[gf*pQ������;�>Y���׿O��	Hr�;�G�����q���W_�_���g�㡺I��CCo���5>?�_���|ٱr`�r����
{��s���}�F�*�ˏ�=@Щ���,�g��C��� �����o��͆q2� �	 g ���U\��!�s���r�Hu�z��Zrk�a���YAC"�%e#˶zhCi|RI�dZ���t5�OD�jԊ�r���H�0���8�:�����X���r֪�4�8�MY&��)S���3dT�	S���3�H�;�?(�nt7�n3V��y6��\��i"hrXU\Y��ԅ2wCv�^[J��Q�����-�d�\�xąق�y$�zc׫�2e�Ew��u���K�jó�Ȑ�l"��������Vj��9E.Cs��f�{�hǧ�v�b5X �����Ϫv�6� rJ$At����������g���vr���|F�'����W��t�W�q���n$��4Gam�rN{�#�����Q�����}�����Y��5^͟jX���4� *}߷�Lj] 
��rM\��)���l7wYX_�������`����������þ�����l�������	��M�<d�h���1�z��r���nI�Z��g�P�k�Jz^=�!�����&�&�l�y��>�UW��x��n{�:���1�UW-�H�X�B#r� '���Y��^̛h%����Xc�Ĺ���q�����4L�ۓ�kä�!%��I��yy��� ����t��5E�����6��z1,�Y�T�W�S��1��t3$ ��k���5~#@�V�W�v�1��H�h�_�$�;�|u�YcXy�Ge"����D��˸�Q"�����s���k��Nj��S��HqM5����Ԇ�{SL����w�GU)���D�˹|�v56<?K�m��{[I[���!�8'8�C�(�)�Y�N�[=���o@ՋO~����g�]r������ьZ�	C �U�̪�H�W�l�8=�fk��deP2)�zgK(�L	A�{�W��n������뿧� V>M<r>ܿ�S�'��e��4}T>�.G��gYG��-�A��BjI����l[�#��~$� �;���sx�{�j���VV��%�̒�
�`�UB�������qƊ�ĕU�y^��c�iu�O@=�ܘb��5�On��!��Y��NI��R
Ը�{8�fkw��C�r�P�C���+�2z`r%	�I)��|�_��$`Fo�pX�|�&�N@�_נXbSUA�{�=��յ�g��u�κy�en4�Q�#ʁb�>�� ���J���C�qy�m$;}G�GK���ٞ��ۉ��7���0�q�,O鎞24'lҘU5~4��47�Q������*�W+��FI�q�Y�2:(ڝ��cM쾚��F�e>̪?�1�{��ōYH�,��w����� �4��O�y�ň�>xUZ �A�D����JT�G��Pxf6;	�����k ����a%����5��Ԕ}�{Y��8vE:ᐧ �$�P��'sNjS#��]���%�(�J%HV1M|ي�q��z"J��"���gI�6c��7R�.��k��� wU�E��r��\p}i����o ,�A�@e@l�G׷N蔞��<�sBmU^)Ƶ��V�.�m�J�B����?S�D1�Ȣ��� 39pϜ~~����}��[�V�c"׊�������T�h�rj����;V��}�r{p՚g�O,������m�,׋��Zc��� �N��@��*����'�]���G^���k�+�x�CɊ�#�����y9�uP�������?_LS�9	���G朒%�w<�i|*2=do��#�0;�˰K�`䫸���T��v�ܱfk��6,\��O'���F,�s��uʶ��|���h�}}��hkM�2����7�ֈʫ�pQk�B��c�.�L�Sߧ7
��AC%�^v-b/m�O��a�w�	ul^8%��j�fVV��=o�ꛐt8�dqJV��I�#���f��J�ں��<���R9�3뢋N|�<K��8�]?~R���\�δJ�?P�K�U��|��\�rI��%�K,������F�hU��J��R�O�/�:�̤_E����R3��d��n�3ajK0=���I'=�� N��.���c��_v���� ����6��Ŝ�?��n���w�=s5z�6��#��$AV���� �����O�b6||�/n.^����i ��n^�[f5�Ɣdb툯6 �rzV)wt\.�x�_s Y�+��#�3�99�ߩ�A.��>浭͉�g+�l.����^GUH#�%�������)��M�����{Wx�2��X��J)/� 9������Q2lP�m��������T9 ���Ƕ;��҆� ���\���=&��Nv��VgHƍ\#��,�H|�o��}H���>_�u����������ĕ
�x#���ã�,�ySd�i��Z��$�ؐ�,��T�<��|�݁�}z�|HM&�I���+����/���~W��� ������MWF��v�^C=Z��O��E-�r�C T=��֚��v�w�o��-?������T@�A����� t���PW���IZ��]����%*���2��g�g5� rz����b�O'-3��ҤǺ�-�L<�=ύ>�?�� ^�TQ��Ni�t�j�k���P�[kQOf���B�?�����?P?^���з��y5}�ML�k@'���b�[��v�!�����&�����(��j�:�(v1�Ra��>ܠ��MT����j� HdU?�j�����j嫯�(��|E��_*����o�􂹢�������c�u�7#}����+���$g#����Ϫ���Mj�� ��g��� D�/�� �&|�q��Jf�U��f�$��#)��6$�I8����GPI2��r]����|1R��ݫ��x�j��ʸ�9��tıd�����Mkg��.�O:��ʬw���?m��0�1$�N~�L�/���伮�[f��ZJ��We�������'�>�W�'܄A�yN�T�^��[���b�$+ ۼm@x�S�}:���	4�:m��q�ó�.��o����s�C=OLB�M�0��vf�Rc�ݺ��ԹTM��]��h��v2���W��l$U�KI?hױ,I� g��HG���M����FyQI���<J˜�� �G�}:�u]� 5c$�u�&R�.`��)<l9x�������l	�4�~� �Վ��J�|���Ӕk�Y�i݌���3��x�������S���n��׆ՎN��ʼ�C{jq�p- �>�T"�LdY�@��E[�m�ڼm��m-�V�x�xEY����}Kz�ˀ4e!K �I��m`�R��t�K�/�`mf�1��<�͚���'׷U[�f�1Mr�o���a��e�����2K�v��H�
^����ۦtU�_$S�.5�$қ�lk���Z���C2��"��`���a�],I��^���� ~#�n��_�[x/��	��ic�H�0E��䑎ݺ�O�p]�l�'���Eַ�-JɵxKpk3>d���i��%{2�`��R�VE�����i�ZKL\��q�I>� uД4eʷLS.�C�n�+S�x��kwk��p^�Q�e��b������?����W(���cJ]i�U?s�l��6� U�o+4���X
��c�:V��`K�&d��ꯛ�=B9>,$�A�}���zv꽏�"gP�6�~�mg����o~]�����_����3�G�s�N.�2@7�/r=r��k�Н�L.��]41D����<���	9�l dț��?�y��h8�y y����N�K:�v�Fe$0���:$du�M0������>v�^�$�������$U�B���u%>���%�E��{]cT,p�K6��Ǵ�/���[�*aI�bA�(���|��KF��8���hɲ�q��$�WE,R�Q���q����g��1�lCɿ��+����/4�lkp�k���✃�H���J�m�jF\�y�$ ���V9���۴A�hG_5u��p�#,�/����&��8�o�c�ގ��
��Z�+c�"ӵb���>�����{u�l�Y���㔖g��k|��>����� 1��Bz���=J�P��Z�ךj����p+t�o��c����B!�d��r�����'v ��R��fd H	���{DI����%Jqʭb]tڹDAHȋ}N;��I-W�O��ǚ��/�u=�Iu���V߆�bΆm��Č��|�LbG~ǥ�X����-;�6�tuD��K� x�?��oӭv�+%��/15����dM�G�b?�*���s	� v��ee�,�C�\������{�O�p=��/|4�Af�Op����g�zv��"3Z��Qr�|�x=i����m��� §ѿyX���<������m�rC��n;FuT�#Ğ�����A����_0�!�Vi+ف�p�>'Č����k.td[K�������z��f���,rԈ\Fr���n1�d-1��[�pr����	 �����k��]$|�$�'��&ҳ'$�b��V.�����5U����F����W�x�$��u��8��'�{�[��ڹ�Gp��EO�{��Z�Ve��������~��|�P|@�8�޹��	��� np}��	�O�z�� c��[�J� ��c�z-����ڬ<�� �Ҟ�KܒI?����$�DRE%��D*f�=��O�wdb6
~��}�K���(���%>�6�e���+T�;L�kYf��i�o����ގ�W^g�_���@�rx��̵2�UH^ߨ遡P�;'�'�L�S�F���5o����Q�5\C� �؆�$��A�b8��3�=���=z(��gʸ�ۋl���Pܞ�j����y��2��������jܘ0e3c��B)ٓ�.��k��qԞGD�,�4e�U��I��[r��L��#(����u�4rE˴�,؍|-�xDQ<�=�Y�0���3�J$k�PJ������e^SBĦS�'�@�b�P3��|u`����6�M聯eU����gX���ٍ$>f3���s�:r�i�� 2����������������<3珦1���>�2^��H�U�SX�ӂp��~���Sd��U��I6�R�ҷ�*�Ԗ���'��d*�H<��0��Iq�P�;�V5qɬ�F�.������Z0qx������l�(L%w��.���\� �d�d��� j�a���H,�?D'Kɷ�Ǝ�~)��NA��ͱ�)��@��v�GP�(T�'%l7Ϳ���[�qN��E^��ozP�|� �*Tc#��Ȋ!WI��}Β���Ÿ�S�3���LՒ�y��E.[�� {����s@Ϣ2O+���-�X�X�X�0�+����Ĝ`�3�u����ֵ��ޛ�_M����Wa�\�$~4՗����DΪ��g�9�����N�܋n5U&�i��m'��+1D
�,{g��%�SvI���H�o=� ��Iv��5� GBR9�;Y��EDX嫢hK�;���$��� ?�ӛ�$bE-�#�hw:m$|M6��K#W���+��̐⤀ݞ��8�19,�]��*��ᦻQ�h����.�@bc����D��Bz$(uܖ���.�5*�\� P���j��X���.���w�j����/��j4����XsۡU�NE���U�%.#n3��Ҏ�li$��!L��8��ԌH.��3������-Z��}�m�3:*�+P��d�תM��Y��R͎�?���~.�X:�"{��mu�GL��Ye��>��N��F�w:���݌ګ_���-Mf�����jL��Ȋ$� ��˴� ~���f��|��{~<���i��r�r'pN�)�tJ�^G�����M��U`�v�#ce%K��I���;g���~g݁�"6����~��ȇ�(W���I���z4p֙�� F�c��ff�,�c��!Ic�װ��'l탌%�}���~����ݣ��p�0���o���F�����v�o���:螌˒&�e��#� �|u�����>M,SO�;���!A���#�S�8� 9=r���q�R�2!�ߪ�g�%h�$ ~Ҏ�����y5�y���(��:�U�U�3B�+����=GX��� >�|�t�Ɓ {�?�O�� ���nu<wK�o�0mw{���Q�$�~Տ�k�� �ݳ��K�����Ѳ"A�`i�-W�a��sp,?�m&���W���M'��䒋��M������ r�qi��W(�ס6�Q�22���՞g�n;-���K:k��b�{]k���h�XDvs��T��lߡ*B�V�VKsr��pͭ�O%+sZ��;�20zp�2�
���7lI$U� �b�����G�I����H7x���m��L�eB=sJ�mڵ�fe(<b�c������;u�B���y�zݔ�K�rAWd6�mv<���E����z��b������*���r�䧳j�Z2�#HfE�(T�T�wǧ��O��S}7c7$m��^'�R:;a���G[�H�^7bK� v��T�%�/�>� '��4�7\�]��WW�|��j�-�ʕ[M|��/+BhIZ�F�H����P���˛!ʔI"�:��xUz��ƌ���O�����q|oS��K\H��T���5��d����\c�������'���}�F�#L�>.���ιpX���C���g��ߘ~-�䍇���C�8� #�/����6���o۸�z��t�_�dF_yvp�����efݣO�'��ܟۜ�n7gt1I�D~�/E~4� &a��<����SE_���ɯ2#<V+'��s�	�W�I���yR��a�z���|���/�1��*�? E$�:NxnWr��]gܾk�O9�\ �����Dƫ���]��m?�Q���kz���Ar�A�F� �q���wM���a� #��/��� /� �.]��kc�8�|�n�|��;�q�KGZ�;��3<�(^%VY �^O�`���7�s���>ϜxܛWo��зn/J�e#�$OE��� �<��=��,D�2�� 3�浯��_y����珎66�YSS�'�FP�ߵ! �S��[?�G�]��شs������|(��/��۸��]�����ׄ� '�Ew㏟.�Kc��˧����� ��P�ñ�����+���C�^���1-��`�-��c�m�ˏh�@?_�m��a#ө`F��1�� �@�:��0���]�S��h�w��f���ђ�'�.T��p;�.ͅT��24�yu��\漟k��K�,q� ����Q��� u�'yu�{PLڍs)B,YE�w�[".O*Q2cP���k�;sLT˕�z���ui���Q�t�i`_ȹǿ~��@�I��Q$o,�݇�U�u��p��=� zc�=z
�v�K�Y� �2}3�2��Z��n4�;�h�Mz�@'�e�9�x�%#�� ^�<+Д6�7���#w� �9��Y��҅t�2�G��v�� w] 8�p%"e\W�?�b� � ǯ��� ��� �[�5θuO�)�8��QU�:���{�忪�ڞ:���fe&#�L0�/$;����)
�_O��ß��M������G������$؛��{m�݅��Y�[�f�iVRU��( �4� 0���^D�涯Gθ5}m��H�J1!�m�Ud�P�]L�Čw\���tF��|FI"�G�q������;}��e=�����Q��V����H�W�Z���q� �����N�����4�ͼ�عY�Y��V9��)o#���fL�>��:yd�3�6�9l2� q댃�d!�@� t3�տ���7"�GZ7Xg�® �=OJdȊ���9F�lx�V��2/ h㎽����y��1
��q��¯��rdhn�'�w�àl����8�g�z�����8B�@&� _��oA5Wo�Y�>??/uq����Vђ����&e��3p�]���g���U�$�Mɛ��!�u�El!YQ
��o(ʜ��n���RFI:�7��r�?ǬpK0X�I���$0�x^g��Tʨ������ ��Jn�#��y��n��qm`�z���~/$x��|����� ^����!����>6t���{:�Z����E�˒Uh@`���ۨC��*h9'/���q~C�7w������Oڞt��f%���1� �N��J�.���kkKv��Vm�1�RE�6p[(�}��P��L�7��n5K����b;v�Dd��j����ɤ�G����:����S�*��jP�2}:F8"
\�G�������?i��#�c\������F���ӫ#I�˒�.��e���?3�9��i!f�BX�HS/�x�_��s�f�O��ې�ZMz>7��(6vu�lr�ט�� ھ!��{����7��7�7���MPï��+ץr)��H-� �T�F?ק��`�nT]��g[����n'��eȽ�u ����}q�D�2H�yT��z_r+��+-�r.��dO�=z`��Uֹ��,X���I���x��<�(]����d��u�5vG��f��goA�����4��
����I$��@�s&�/3�Oʋ���(Y�u���s�k��rwI#,�ܪ�5��������r�y�ǡJ)R̅j�T�O�q� ���V��NĜ���϶�O�9�x.�����f@q��w�Bs�N�L�Uk��m���^�؏�nB�%�7��A���/?���c��꧓�dp�Xi�vUl�eN�"���V�5`�*1#~Z��'� t�� YB����]�_a��U(o]�ؙ�:� \������r[ }OJ!�P�4�o�l�K>��}��`�ZI?p��힄b�/ʗ�����]V�T6�J�����h�� v@�ܒ����C��߽���?�?���^��m��4$��	��z��SAi\��V���,��)��G^	!C�I8l�ǅ��Z{@���qrzw�$���������2|QM��(�jo��\����2�vπ~�=t�����[���R��^�,�0y~a{���{~/N���\���me�C��R�$b�6th�����}��K��E�Sz|��f��x��l�b+�ԧ�����<�)�
A�� �%jR�~KG�G$�&��Y�������z�3�2�-㐧�KU���Ȥ�!���[gĹ��k�[;*V���3�9i��Q���W̗Y��2��4u�CZ���ڴb�I�va��D�l��F2q��1:+}њ�w�S�H�����fO�݀=�����ۦ ����~H�i�%M�������la?�62�Y�c�,.�;����!�H��>N��'����ү/�MS��T��h���3�<毷@����""dF	�,�Q9�K��[G6��9���V��u��X�z�T�9��|���߹.�|�^��vڄz�+կ�w������?�&��<��j\G��'�-�J�HV�d�~������ �t	Z� �� ��E�D��p!$�=�wǟ#�����w�`����"��x���N��㴾Ɏ�L���$9=v8�o��Y�����|�7��p��+�1��#5Xi~F�[㏐�|�����|��T�-���Vk�u�������5e�Fm�a׮��ƴ�\gq�ݐ7e�o���ۏ���+���r><�j>��]?�=�Z˱ӎ;�VN�HZq�$}�|�i[#�Bn%z��O�׉���weU�j;0�I�b��G�'��@l��LӼ�⿞�3���]'��Z���|�_��)�VH��>��ӳ�;����[�|zF芖���t���*�r�sr�%A�(탯?�o��-�H��~�*�u�_N$X�@3���y�-��֫�'���/�����?�_#�	c�b��玼�J���Rp%I������ݸ� ����~W� %qgk�8��`G�	�E�����Q��:��Ϋ�\��z� &�E�g=o�x��u�8���B{4�Ur=|�� L�}:�˸	�g�q��v^_��-^��(�<��U۶�[�7����U�����z���D���L���������zg�z�6 2`�!���`O`�;�=q��ע�e�
+t�yE�����հ ��+���|Dxϧ�� ^�@5Tr�X���e�=T���W��{Oo�s�> ��� \�D\���4M�vm�O�gyU@>F*z�#�֞4��%d�ٵ2�>_���� �� �po�;���-v��|�%�}�=搬���U�4���Hc�&$�g2��F�"8:��]~�������гBs�#���}Âs�>=���ꜱ��ؐ	��	=�@̥��g���qA��[���зV�;F�P"$�4����X+����3$(@:jײ�ۂ-m�, ���� �0�eqeN{}:T�B&���K���bZ��~�����3���r�!]��M�IB�$k�,�� �Q�F��f(�}F���%��t��Z��;ҭ#7��|���?�ת$I,��?�,�:qN1��n�����{D=:pN���X%�!���~é�G� !?oE��*�.-�����ן��,��A%H������Il��zf�Đ�?���'��ǻ�Ǐ��=sҰN�u���H� �%�=��\���̽�g�e�t
�3��$��ö��Vܺ�/=�yi��ȍ}߹~��ϯ�R1 ��]�{)w�.@�zi�V���%ځ���h�Q#�O��ui.!ߢ�c��c�=���6HP��Q���x�p ���DN�f�j�Mͮ���8����_�+�b�3 U�VbG�z����V]����/y`��mu=u�T����;N2�s� 禘x�WvYv۾I^9$n!$p��k[�-#�(# �oץ��E��Qr�I�=�s�%z�Jr���@��7��fd[���[;��Ŭ]�}�}��G���?n
��7��~�<�2Uƙ({�C��I��6�Yvwej�-q,�,�.��I=�?^�%���":���{2��֩89�e���F���r��_����v�Ճ��4�fg5���gk ��ߥ�%�$燇Ն� �\��2��G+<��*`}Iע�D�U���m�����wz�{���,�W�R�IU��*U[!�{�:xb��	f	���0R�B~?����#b�T;��0�}ת������I&����Q���UB�$f���8�zbJ��^�_�Z����}�aZݙ�I��e��m��F7�HbHj�+?�k4G�\���u�TVPO�(?�3��3��H�I�Ŭ�_c-��0�"�����̡�a'��ÿ���ziH��B��`t�ip�q]�WWcZ���%U1v���$�%RP�����K��K!T�����c�p�O����������иϡ ٞ��S:�Uw?�=�E!��-Z��dl0�w��רA�� ��\���%�N�F=sY�g�+��^X�f��Dc����'�#AT�9�kg��KW���4��H�+��˰����K]�����z�M�6ۙE����6��;2V����I$� �V����1哌��#߻u��̄I���/������ �n�а�z*�9�<�G�f��������ͯ�B�WlVGeWԏ9)���� u��B�ͤ
����9�]��{7�SoG���W�w_-���m��[�몬qQ�5��y��ci5��)U�q�������""� �� F�ku��;�6�bc*�I���Oȴ��(R���l5�V�X�~���' �%��J���O����ܭ�������J����+���� w`��H���� H2�s�.9]���He�U�*K� �������@���S=o��+�c�{~����'�m�du���G��ޘ��W�	]��Q�y�z�{�@���mn�v��[
"E�Ϊ1�7�ױ#� ,qHd7QY�|�èf�ܒY�"��bbs������S��1���F�1�SejH��;��*v#�z���t�ЦH��/��sN=G�R�^�J�vƦ�ӊx�����T��lO��?�Ur�֥����W��$פ{�hH�;ø����`�P�_!��&�&pz�� �39�_����P2�����	-{MJ�k+6����nH�������!����O�.-�Q�3���vj��Q��A���5ਫ�p�cS���gk�{� �V>���D_��
��>� ���\�'�$���Y rݥ�&� �QG�?p�0}�$$ӍB�sp�?�K���ߐ?��)⎵�uW�"��3�=ƽ�9�e� �R/���!!�� �ȷ��A!��q�{WD�pF����3��?k�%����ڵ�)�;u'`#�����k$R8`��0�J��c�B��I�pcZ�B�wt�.q��d9 5�9��Z_��w�@�B��aS!G?�ʡ�l0�/N��t;�NG_ʋ��i�6��`1�ƿ��O�������`��U�ҩP�
��,Gc��D
���]��|Y� �� YR�~2��!ioT��.\��w*V�pX�0��d��z߶�L�g���� �o��1+ήK���G�g�q�-��{z[[B3p}d_l��l�{��r`P/Μ{6�3�a���k%%�>����J�kR�ݙ݉vc�N}z[VZ��k�򚑠��z�bY�H^�c�׭!�*{�LԆ�I1H�H�/�� �Ԕ�JF�)g�N`��UDk������S~L��0�f�D�)�����w�FF?_/\��#'Vݶ"�ѿ57���8oL~Θ
��!!�t�OwN@�vTb0	����_��s�Z `�_��I����������zYʪ�Qt�3HI��K7UH��:;@�@Q V>����D&7�,u_�;�ΣW�� ��0�uz]���;�㳵��LD�9&�Wf�� �}O�W	��7o�'�u;��q?=�5�:��k3L~�c?��DՐ��Ud����W�~��j}L6�ܰy�ZH՜�BIn�u'�a�o�x����:��J؉�
��rd}:���Y�4���^�#"EY�� $�/�8�� �Jf�� 0U��>3.�(5SO��y�{�'�V@bq�~����e���B���9�`���T����v;.�FI�߿�J�6��K�p��)���}Ih�p.c9=)��a�H�P�Uz�m�9��^���vh}�2�}H\�O��h���������
յ���-����.�#-s��
���{t�c�m������ ��ؼ�ٝ�� �$�f�s����:�"��>/�~�����������3��ǧ�?��Y� M���2@�Wd��̷�g�p�I��U����l�0Z����� ���b�C����rB���?��JAw@QS�$��4lqkpغ�^���%,��� �׷A䠘�u[�w5-��h��i!.�j`3+)\�L����A��Z���ê�!�
׊Q����>�"�?wJ�:�?.���X�W�'eb�1�rZ�]�bP}������;!��%NS��;c(x��X��3��g�o�,��9ݛ>8�:�Д���ۄ���Jج�k	�ؕo�P��U{dUY�ʊ>S�a,D�+�Z���:U�@�O��[�$t�ą	Wu��o�?�k8�+}GK7���ׂ��,"W�{������;�v�]#�'�yf��o��\q�dua��h@6�rGP��W��ݪ�n�Ƽ�j�=�,gQ�[.?���Be� �K��n70�`���JGUVj&�ӧ�I|�'��L�g�Y�Tr��m��X��9�z�{J�R�P�<�w����M�/�2h��kqy������c@I�O��������P�V=�-�"�M��X�\�+T�Z�hڲi�9� ��Gӫ$ED����ܜRj� ��䨯"��Q����Q��=��Ĳ}�f��*S�lI��4�E�e��K�#��6�DH:F�<�ͫ{}���AKc��g�"��q��!��!χ�'#���VN8x$����y����*ڧ����)F5d#$����W���%1W�����˜��\�p�}zT	S���݅���7�q���[H��K,�yD=����A'Ў�=��,M��)j(Y�R��s����Zua�Xw��_)<@�!Gs��ے�5�fr�ڟ$`(f� �=��p �c��Ci�2;�~�
���a�m��(�#�ڎ���+��24�"*���Ť�=���o߇һ��٥��ٞ;4b:��F
�O��f�g��rV�z���aõ{����Yeiu[EO� �� oS�@�z�˺F�ŝ]cmj����(P�˦޲V��`���d�ᑖ�V�}I���`��� %�>H��ck�.Y��4��v��F%�#;��9�s߫�B�� ����/�k�KZC#�H�61�>0~��ĜX�$`�'��%��%>I���f���׶V�g�Y��	Z�11������qB�ԭ?�	�����Z<�]j]��7/3�I`Ez��:#���a<{�w .Z$b�k����l6%��dZ$��H1� ���|w zc�3@�(7���l�}��Z�����oZ�X�f���X��
�\�^��)a0j�������e�����O����\{�
��p�l,�]o5�G`�� '�=r;���)U����t5W�ܺڞY�.A"2\�H����j=@8�Q�������I�?ƫ���ݗ�T�PI��џ��|�9��>��n�e���|f�=��a6�i����܈��P�d�^���Aմ!�1�s^���������s|�u_/q}r�kN��c�Yb���?�������vK�\���F��KR9O���?�U_[��J`�l'`@X��;א��F���M�W��]��v�O��i�5s�̸�kf�cQθ^�_kH?�C#7���Y/^p>���0&lS�;hp_JV� �?���
�����i喛�O�'�"Sؠj02%d�t�z	��;�ۏ&p��G�_�>��7y;m��!�������� �ۑ�,�|wg>�I�5f���Ad�,'`��� ��n�� ����ÉŔ��(�{?;}��<;�
֫U���F⥄>R��'=�2�S��O�N����A� ��l�?�jQX�A]Z5bd�}H� �u��@_��$iUP���JT�v*1�����t#:W�vV!��01��
�L�̃��$!� 2=GJ�����g��Y��=��˕@].��2�O�^3�t�n0�}q�_��u�3T�m��`Q:Q��u�dg����^��L�TVX�Y� �z;*��S�
<������ =�ӣ%]���e��p3��g��j3&��zؕ�M_FXg��GV� �:/�����4<���P�ֹkc�>x�q�u���-k45Xc�f}��s랮�!5Ϭ�qn|{�-@�d���M
m��\�|��H=�s�D2M����Âkc𫤻]���R�߅ؾ	,���>��G@����gWGu�u��<���ѹ��L]!EeDa`0\�''M�D���U�<�T�&k��%t0���<�>���r}=}:F��5�I���Ev��=�j�Z6�Ƕ��|�$�w鄁���¨��'��VŸ��X$�Fi#���� ��	B�q�dN�M(0Cߌǰ�֗���i�+µQS�U9O:L݁�''����A&�OH�� �<u��ݳ��3&|	� � ���Ӆa��&�Ks�j�ٟޜL5�yz/�*3��b�6�D� ��e:|ӑ��i��Fi!6Q�����>�� k��DA�j��������ʿ�O� �^M�~�~W���3�{~>���{�������b=�L�ç�����EOo���:��mWJ�ػ{Z���;�5���RR�f�ܩ+��{��w�:Fp봔���j�/�*-i�u�G2$�
���ps�1��b������\�A������;{� g8͞��z�h��Gf��XfE�f����*����� gPI3�Xh��� U���{[�j��,�Q,I��A ��d� �+ߓͣ�l\�<��F��Wmk��#� ��ױ�U&RO �Q�]�ۚF2�~0��>�'�z�Sn�	���@f��r����`T�}%��K�����О�S��"�!������y�?�;5��H�<��O��%�=~�,�gj'�0N:M�l͙'�\�
�H%�kV8,ʈ�Fg�pFr��{~ާ���蟐kuu`�q�F�S�I6��N�����VöT`7��;t	�,	�P�ly�5��y�֥���^L��*�>��S��r	���k�:�g[�����"�fƢ�Q�Iwe���9�� ;��I���q�c�_I�g��ũ��`�|\x�Ў�=,Y�4���KO�kV�56����2i�7���9a�#'�t��
�1���伆� ��G�����0���En�,��2NcFv?��HClI�p*{�$J"�<O��5���������5��M;#�A�r+�lOu'8���
I��?�/vܒ����!"Q���k�$�\h��M�A���C #���rY��H3���uȸ�ʝUZ-Lع�O[~��E��d���W�>�=U)��j��u�9,��F�?���y�Ʊ������_���������ݷ��`�֯��<��tY&QS�fV��Lt�*��]�a,<�85�l�<�j6cmA�3���c�#�e�X������ �|���N��5^�/��᪱���ݮ���ƃ�y����B��>�d��u����f�j�q��������Js�#�h���E�:)��'���^d�<͠����v�v%˄o�F�,N@u+]'�M��ͥ��O���V��WQ"��yg� �	X� �:���˷����_D�˶۰,��wң"udwG��Θ���[�R��*;��ҕ�4�&��?:�č�_�G��w�π'i5�W� ����w.�ڤ�\�,H1��hI�[2rN-/)��S��/�WGj��!�$R��Ii�@����Fp~��x�=ϩ�k�gl�>���L� �4�N�/,��$��<s���n1������p��h���<#��6	#8�n{��A ��'l����l��x0��#a)$�#H�՜ Ǚ ���Z&�!�nU��'o�,�G�!-� 8 x��=�t����P-r�'|��D������{��y��{��_Sq���
����6�����I����ش��q�7!mZWg��+��`�
�d�B~�yo�������� nY󞟺�N���ci�4��wrC�X,���/��h��]i�$�FP,�X�8W�s�Qݱ�3�ޟ���*���3��s*��8�����ȓ�����?�9#���<�K��_��̲V�'*Xd�G��}G��$V&A^�kw<C�����5�SM���M�=�LQG��$7�1�������b}���.op�	�r�E6�{�cc�r*ͬ�U�ӧ6�QbeRU+����9a�~�OCrM�."�i�l�ܧ���<������w<s���_��_�G����f�\�,{y]b���+1�!TǇ�r;w\��xFR�@��V�� ��7ؿv]�[�c�D	i99�s$�?��m�9��>��W��B�����2��E��V�[~��촙�,�W�C����1��;Q&&0�b>��z�>�Ƿ�r5�|�/�'��y�ūJ������3[^�1�4�*�U
>��{�w��/�q��W�?�_qO"\x7�m۪�ao��uL���X����/ϗm1��T��U�W�|�y����u��O�M�MHW�O��JK���:a���>��Gc�u1U_�,e�@���J��c��������.�m����5a��!�B��{���]j��h�N���I���R?y�a�b���� ��l��_m�����3�ޭ���Y�I�%����G��=v�΅W��#$__���t�U`G먎�����9���9��Wrl��1~��� ���>��O�����R��j�V�K]`p�cJ��'�a��`����0�W:ȷE�(㜊�}/=�CcR�DI�)��*0z#ԃ�Ӧ��,������(R7�V�6-KI,��uy2lb�����:��)�9�N�[�v�9� ��^��T�L{�TV#���=�N�&J"�Z�[k^�6��H��b�c��Ρǡ {g��� �hB����{b����b�Ve�k3H���<B�  ���5��gL64���y*��L6k4�jh��82���=��N(\�y5:Qӯ͠����e���@ O&��poL��B�K���=*i�u6V��7�t�(���!��݇~�޸!Tj�sX�E^AǦ/�_�&=q��"?N���;����=�.K��g�-�V��e���$���੎��D��U���������=���ox�y~_����g�*�?&�e�^8x�� �TU�3�����Z1��n�5 ��Q$J���Im�o�o&�a��c����L\��$��ӗT��G%���Y���ؙ0$���:��(�P����?r�z_q��&j�$P�K���pa��79Bpx�S�܅��n;���k,OcB���*�Y�U���ӓZ.a�5��e�����V�(��^�����d�<��.�qӎ�w!�%�q��+�E-xF��������ߣ��gi��-&��I	oS����Ǫr�lr������aJ��օ��� �*FA8�D�2H�,�&�M���ݵl�M,�ӓ�2*����,G�'8�Gqj*ڠ���"q�j޵1�
�!�y�m^�Q>�\v�I��%_f�����N��f�*\���ko�4n���0�$�䈐I�죹ɶ[j{;�5��҅յ���"F,D�ȏF\��.T˛}N�9/�m�X�ޟ]�P	8�?����Z�uG�m�<?c�yM]�Ϟ��\�^ua�EbZ��!�᪓$����?n:�q{q�g7�)���Lp���z0�l�R�z��bkk��៕�v�Kl�,�F�g��Bl��L!�@����bjs���r:'[��E��karg�ǲ�������U?^߿�D��pG��nڼ�*�?��C �w�A���' Q
��z��`u�9'(�ȫ�46P�����1��	1�|�c���n���������׸����-�s �&��@�i�d1�uk�fB[�c��z���sL��O�.-f����{����mExe��K�����ON����*q~G�{��؝�Xw�w��{��౬�{q�)�[�0q��s��$Ug��8��a�^2B3_Y�S�v��?��9��CTJ�=�WG���Y�ց��]�i\�?dJY<��S��x���yn�v����.Y�M7&��qZ�A<�}��S��r���%�$��l�]& eVW=�[��e�NG����k� �Ɛg�$�,�?&�������@������$�l��)Xy*2��7�њ��7l'�w�vK,����⽲;��9�	��J���ؕ�h�G�c��T�>n1��޴n-R��A��sҎ�Qh��*�J}�D[�c�?�n�OTHP�G��ګ��=���b�����ZO�>��;�h�p�\s[�J���@�3�0gQA�ӿI�uO���>�Z+��&��,D���i!I8#�tD��LC`�>�� ��Y����v�~Y���5��[�7��/��v��t�&A�%�J����6Z��Ikc��ij|}�0�]#�E�{�n�⑄`��c>�ӯ�m��oR??�w�����K�
1_��Ca(H����:��R)�E%y���#�er{��=zdY-�dI,b"���{���OY���('��KH�c�Ē���r'���J�E9|a�'�������X�S�?;\��)��|B=��d:�]�V��� �?��� -z<�W�� Q�tn�	�|~�ۮ�l�N=����. '}�3^N���9��� f��a�]��m�f8���gmj�љ"$,��#>�{�؇'��'��g�~\q`Ș�ί�W�]�<���co��M�u���I5��AF�e�1������rX/v�=�}��N`��>]pw�]�rg)��M���[���:�4���&x�S��Ȥ�0�|������������_qW�᩺��g-�{DG���Q.��W#�A�Tś��$��|B��T��hg�]� ,~ܓ냏َ޽V���������b@e�}2;�^��7m��}�g�.�� ̿�ז|!��jھM�8�ŏgB� ��M����lYeV�շ~)~�1��#=Sn؜�82�[v"G�Ahg����>���'¿*h��!|oɬ�>U��%����8� �6Y��vx�Xv=b�� ��L��%�.A �!��}tcU���)� N*د�#�o���[Ž	F^��f@�q⬘�u�@"�L������ �� ��Z\)`�g|���;� ���! �p P/�O��6�$������r�h7�F�E��.+�]�s)�c' vǯW���\$H��S}'6�ћZ�׏��c�,�]L�L�F���os�\�#m˔��e�d�pAJ�~_�V�V4Y��*�*�?�"N >����+�	�m�K��J��� �Mm�ڂƦ�
��%����}<��g��gP$�1Lt��1��w��#qm��Ӱm�=� N�E�E��w�A�;W/�����,q%z�#9P<C3L�on���U�ﶼ�S^����ݕ��	"������QNǓvϧW��%��^�ȷ����^�ཷ�FNH�� ��V��O��T��L�[�|�i!�
�M�1||Lnd��>��D�@	Di\�4������ ĩ��3���oRq�Ȑ�����aws���I6�Ofċ���I�/���.�r��������L����_��� /8�n(�lz�	%i�8-�ve1�^#8��a����*��:���Cc#]��9s�x��GR5r��{j�Էq�Gפ2p�T���of��)��)�eŚ@�H7;�/M@�Gr�n9k�Z�7ެU�2�G� �l�3�D�YII��Pɲj��K�w՞�)!IR����Ak#�3���nE�� ��]��+_խ$�xO�YV8bƬ���ؑ�g�d�b%M���FKo�� ϴ�^��H8���=��t_5�[��4\�#$&UX����,����GK�&A���G��Cc���:,�~,�}�FHʂA�ә!���:_�Z�����Z�/��#H�$� �7�wJ%�%u�ͬ����k���vTެ~���dO�̑�F}3�FUK0��]���5I�cz�
��_i���%h�e�ld�ڈ�
5�S��\����^��`�Z�����+��~�Fhn
U���֭V(v�,�`����#_n7���_��g�щ��uW����C�SОckN���]����x��vbx�
��B�����w�<�� ��SJ�⻝��3��~�����H� "�0��7��k :x���I,�{W�r��RD�l�0�p3�v�K�=�<��Nt����j�v�x����2L?���FV�!ܵ��t���������sd$U�U=�	�$�3��)��g�`E//��';�%�R�"��0%��b7bC}��+�o �9����_Eh� ʪ+r��8~Q��k�I�����_�:�0A��ےp[[�>�}�9��m؟^��V�QK�~*�e����0�J�D:x���e��S!��]�@ ���z�D'
}Ng��c��H� c=�~�VS	a��{NI��9��M%*��v������l�	HU ����עIʵfO�y�*�?/�D[)_�T��K}�:�s!Y�&�w1��ɬ�i.J��,�X���rHo3�iȭ��n�F��;�[��5�m��:6M�d����T���/sň'�a������o��b=-�+$�t7��|������G�B/��өC��g��(kjW����e����W� /�o�NߧVې���T�,붛xd����
�c7"9�(��`��=kMx�O�dq{�����.'ZT���*�ݏF!(�]?���M��ʦi�+�  3�a����I�	+�'�rNOJF��I�v�i*���̱����/�#�=D7U����<>/mc��l4��+�s��/��NNOJ�l�v���|T$�zj��v��+�{��u '4X32��� -����Ul���k����IJ���1��]dV8�-{g���}�=ܨ�B�  �we�#Ǒ�T� E��J4R��8h�E��#$��1�� ����W+I�Pl�Vú� XE0��aO�{���=R."����H�,�|�?oӫ#(R-�$�ʆ9Q���>���� S��w��2�uĢ5$��<X������_GC�_��n��]0��b��<��j!��n�� �㷧�=)�\P��^�� �_������?|/I�iQ�&��(��_)!*;��%I#Ӯ��/znP\��}�T>��̷�� r�����ܒ��e�����
�[6E6ڥ�h�lHY�"Be�9S��mܗ*<�4����o�v8=��x��ݎ��/�@��m��]���Or��v�**?c�v"��}��Ź 5^k�bk�JP٭7��]��=T�Q�6���eX��](�+���1�S2��� 9Ϗ�� gJJԃ�  ���~ߧ����z�]��@�'������'{P��?�����s|��[c.�p����H�Ec�}�"��X�1r�1�9� I����o2�7_��[���Ŝs����)�������A�����N(֧.��l�P���#�������G��UP*�� �/����B�FNr���M�GN�)�{)��U\���b�1�D�D.��"?@�~��=;~�ac�����=��U��J�M̠���ĺ� ��� ��۪.�ձX��}�� �{㽆���nƦ��|���կe�IZ6�M��ܤN
��A�u��mIg#�z�~�!��&$i&�ܴp��HN�%�d���J�f�2�v�,�0�����~��隩j�k��[��kW��AZ������8 ����q�ݏ����]��`���WM��쥒(��E'�2�F�9�D�j��W~A�b׷��@���-���H����A����:Ap��qdut��c�/��[4R�&�]#��?���A��s�up�]� �Qk����P���ek���{�� m�G�T��G8ϧH
u�頻��g�� �(�Z�3�ȅmI�Ө�T~��Q����0�������'�	�Б��R�{6F�k~�����7��E��U~�3�Ȃ_קHD>J'��/�_����� ��������ϗ�<��������kh{Q� L�$��Dq8>�7�{��h)HA4�}��WR��+E�bI"�E#3)>g$�OK�%� .�wW����n�6���)V�� ��[v=7P��B7�6<�WYO]�{��ZY*��a"�Y��l�bk��cpa�n���^HΛv�$I|�%K� ̭�r	�ҊQ\���u�Z�`�Ig^�,�Z��u��@˓���%&��7,�q�>H5��}��Yh���of<�P��^��ꃺ;v[�X�-}?+�Va:�%�̒�i��葒�k�U��S�[�Y�a�������~'�z�Qs��ٱm/ͧ�E%x$1���'�8@�9����^��`3LSٛW�ݡ��V(3���aU{�`�7n����2��
�g�Gj��o?��U�~��a� �3]ȸ�ߙX䖶-S��]}a=k~��.|��e�����Xd��[������Y6�l�j����)�2X�
N;�C'u������h��_
B|�f�t��	�Q�	�w�
.U��n�[*������Z�9���<���FX���Հ���R��kPrBd�|#G��� y��l�n\�X����r�<���K�t΁d�C���Z�(�WH�{���h�EE�8��"Gs�+۶s�N��@@9������$�UB��U��p<r|KݟO��d�3�/g���ug��!��K�$��R�lI��!�8�?���u�J!|[��'gr�ی�}��ڜ��[������d�O����]�n�
|�rN+A������k���^��,���Y3��  ��\���� ���)��y�RF�a�5Y}��H��'� �'-�J�\e��B����jĭn��+	Y[%gѲ003۪n�ʾ��lՅka�I�_1c��]�;���=T�a��6�M��M~�|{U�����6+T�4L�f>� t'&h�F���O��PۏW��^ŹEy�S�&#!���䮬�S����,���[�0QV.��ƜwJPƫ�^�U�a��!Q��[����]�Ob5����"|��F��� E_��?A��Ԩ
�z+Z�gs��W���yڮC�� �c�G�c�u%R�hB�^�j/��c�9Xa�_�wR����Y��C!ˢ�6���9�^½݄^$P��~Ρ�G	@~���q}\�o���\�w*ׂ-��9�$��1�c��t��6�j�$�;s_��˶��|V�� �"��f��� ��^�a$�ݎ?��$��ܓ��;��.i-�?2��<`d|��-O�S���a�a@�n���SpR"�'���ȣ�/���>%�?fZ�I�UD.����m�bp�'�`�0�K՝d*H��� o�27���A���T�-�ry$k �ٌ�Gq���_��1C{��ܤKy�O�ܩ��9�랜
�5[�;� �|��v�i��;�����6�C��8�$����K��a��ǝ� �_���{~=�Lh������w��G����U����ԖMPM�ik:���h����\r����ax`�=�|�+��Dղ��^u��O�e���>��|m�&�Sw�ؽ&���Sl֬�Dn��A^�f�)#w�V5��3级
�#����������dj1�~�%�����a���'cu<k� {����.�Q�a|G�q�}��aڮrei�q�пǪ��Ձs� �&Q�ˢ��ďI��,R4r�*�)!��2 �=tYrTc�	 /��ߢȂ��l�� ����+e�º�����SG������YMA�������T���_u�!��%�'�U�y9�������7»����)��K:ݶ��w�B�%�&���$]/ �iv2yM<�ۆɦ��{՜�gh��Sś$q_��ܮ=Ӭ�yc���x�?������D1��̀�ТO)����g����Մ�MPy���]� \d�?N���Rȩ�H�����;>~���חW�'�/�� �M��i�2|N��!�p� ������[���_�3��2;I�$� G׿[�� �c2�[;o�o������O;�'5lj�:�R={�g�]�F"�o'����-�oj4����P�`�)�bGl�g���lT%[�`HS�wv�-1ZU
�Fr fX�.N}:��
%6��R$~?�l��Z�rw��3��:W������]Y��+Bﭱ � ����$��:�e�X) Y�["S�D����
� ?��ٲze��c�����QCv��ne���ll���W��}~ꀑ��Pf�D�s�����g5h\�{�k\ʈ��
�'ɇlt6г��~-�+��TR�˘�[*���Ў�tA9,u�[��_�Z��Md���Ha��u?����"�dخ�#�������� ��,c���s��3��U��������M͈���T�+I+��Ew�jK(��9�����=��_�ۑ�����z���D�L|��^mcy��������W�E, 7��$�c2d����`v껼�[5RL�z��n,'����M�aMf�b23T�b�U���g�ӱp�$(���ζ/u��9J_��k-�N<��X�G�^�o萖��Ҭ��v�v �vM�~�I	�*�D��8�{w�z���*�W{ׅ�T��-�k7m��j�j$��|P�|1����Е̊p�"6���+ȵ^�x�:�١�_)HE�� Oרh�5��R�Kc�ۼ����[xر,��6=�����I E�9��_`Eiv�����������VU������Zm���hmO;Z��א�� �@�o�On�Y�� �M���%����u����*�$�bv�Ԩ	��b�vSD��|���y��~�I����� `���%.Y�_��jZ��RX�݂���%�����=0K7d�O�i��\�[l��7��� �}?N�� ���x�Ak��j�`}���׉���W�U?����uQ�����K�kv^;"�W�^Vړ����
�������d�LY��#�\X�ш"��ͅh��8�J$�OS�
&�t[�uҘ,����$� �O6O�?�;���Z��&���
5����R���t���౧���s�8g=( ����Dn�z*'�"	��I�j���N2~��ST�)����B=��	��Ĩ�����% ?ӣES��ga�v�E��m��1Պ��0Ψ��b��c=VK�P0��Рt1�����X��:4�e������UEep8�j�i�!m����� ���{��!@8�	b�������t��4n�v.�J(�r ��TE(�������GHffB!
;���A�ޖ�����ګ�h&���SJ��|�q�;x�۫�[�9%�-ޥI�=N�goU��Y4��%
-n���Ei r;���F�U�G$�S���!��/���� ���P�:�
m�A�'��j$E��(-ߌw�!-/�s��m�(��q-$�k��=�m��+��g:2;2�%��>#���c��+�\+�k�5��2xe�}���#�c3�v���Q)��q��׭��\�_5hvtv[љU�X����;yw��Jۄ�,�d�M���{|_�>{Pjy����r:LK�e��-E�e 	���9A�J�� ���YÓp\>N� 5�~2�+�%��c�
Da�Oy�}A8N߳��$�ĸt��Z���h�8R1��q��ӭ���nsQ��٣�X:�T�
~�=}H�L�AFwH�\�p��������	�up�
��<�C�"�p0<W�#�ת� �B��Ze���b_1L)�3�uc���O��kȰ'���) �c���c(�d��m���I��sշ��?��'�1?��C����z��[�(�!�]]��۫���;�	����
�掗A$��y�=��� �s�u�|��~��y�E�h��F�}����.�U\�����
�T����D	��.ި?�O��o�b�N��ho�_�Ǒ�"��zT���u�ޱe��W_&�$1G0��v�O2��X�-�+ϩ��h�:8o	"q�RJ�`�N�B�Q&R�;eB��v:�࣭<yWn���� �꯭�?��ϟ"lW�k��_/C�+���9�� ����^:�W��S%�o/PA��<��߉��3�X�k^�K�c������q��>�
:������o�k��{�m��r����a�V��
�k�>bDB���ボt��N�FV���1�D�~��6.�_�0q�����kl{��;es��p��׭1vu͜v��s�3�T�9�|u}��Y9ϰx���K01��Յc�Py�g�n����t]8ƫc��n|��?�?���K�ʺ9b� �g�-�����������Y��܁��y�m�pF%��������.%��Ss�����X�^�@�����������Y�k��w�~M��ܵ���d�Z�s���;EVČNH�~���b���w�`�+t|ʲX�5li6�
��f����y�u�:��yb��c�V7+<��G�<|��~�#�1u^��+�Zɷ��Cε.2~�� ?gA�OCT���V����9��AxN%5.{�Lùl�"� ��תwA��"��Wī֕d�8�Қ8���$y0�^���ϩ���h����j���?(�Q�*�Ӛ�F~��h�������	m&����CbQܗ^�"��މ��I${�� �����4�T�rJbr�f4�) ��$=�p�	p��-�~A��U��V�OZ�H�DS�ȳƄ� w��wBMD�>����w���?��=�/ty�g��� �}� L�F�m۸~�o�^{Z�B��[r��Y� �L�j2�H��"�,�o#��ׯ+���A�	��c��E�,}� H�(�i���LY7��t���"� 2J՜�p;d�c��p����Dڴ������-�b��t�o�R�^�Y�;�vQ��U�Jѓ2)d ,O�@$�wyp�Q��'!��\�r5� �oܵcUJ.C\���ku�>24h���f` �N��:$��<B}�|ò��cm�Ҝr�(^�,�$�s�ǷZ�wb�XЪ.�0&�P�=�	��ܔ��rjPׁM�_�uϞ��5��s��=�������8��"���?��{"p�e2ސj_�9I�!����j�(t:�R5���v��~	�I
�H�������K����0 �\|�2=����*�Ē2��5�J�Eص��4r[�X�Tc"�A����AN���m��s͙�3�e>�����TIXD&9L�A>߈��'=��i5Dٞ,�Ĳ�t�6rY�ZaJ�4�����O2K�� ~��7bd�6�"IU|��A����_�^Ȗ�Y���g�Q����a����r�X�*�N�z#����[Uy5;:��-j���I�ڋ2L��۬��ڀ���D8�%�(v��s�o"��m-����b�	/iQ�F!�|��`�M}��c0N����^R��N69F��sߟu����v�3DP��/�F1ѻʷ e) 5FՉ̴���~C��z��r�D��-#V����*Cw��=S��ٽ��$:o'�v̶݉�ꪽ#�<��s=��i���G��ko���1zn|��$b����VO��2�<y���Tg��8�A2��E��@���?hȏ��n���6@2��e�=��}�q:Qk�;����cI��KzzV�!���
V5_qc��̃�ԏ�g��)�{Am0�셮#q��N�#���nkڭ�}<T����XY�!��J�(g� ���U��'G���1r!l7�� $p�g����E��q����k�S���Z6��:{�n������^�b� r�b���~���,Z�݃Z�$W�謣/��X��)�a`KO��ѳ�D�rr?Ӿz��ɦ�&E����"�ޫ�mw����ZKr���5H���2������R �2��*C��5SvK�ͥ*7x����ҽ�5���t�)=�g�$��<��T[�Dnű�Z'bLdޗgN�{�|~D�w�iSbDY��?��z��6�W�� |��/�<�������n��U�=�$�+ֲ��Y��C��� 9� y����;�q�4ƫ�}���#�JB�DG?��8�.�����Δs�����m��o�<@�^9����ힷ���k�j`3?_��w�w�zvnT��9+���Gz�X��M�a�$ؾNrs�mc9���+@�����3�oQ�6{���X�$Mn�h$��#���& }�>��H���6���z���v[�ol�̽~��� ڭ��E��W�[9����Q�q��$���d�'���RrN�m��E�F�C	 C��ת���W%nu�$Ac��n���6��v&M��Z���kkw֚<�|@3� ����X�K��eڿ����v�!Tvp�r��	u�NQ�<�L�}:IۋT��x�&��O؃[SgϹ���U����ӊw'�Q�EE
�׿F�PbV=�"�km��� �O_��I��_p�����>�b�:�n&@L��[!��+F�����S⫺[Ns�)��k~L��h]f��kt5��>�v��n��5Ĭ���X� +�ݯ�	���.K�/�-	��Y�N�ρ^I�����efc�?�)�𳎹\���A���~����� ?�� �^(�-ܫ6�O��k[���u{Mm�h�V�)|lW�3�$�Dea���Z;�ї�p�"y��/����l�$�=�K�.�+@Xl�"�8���p@� Wň�)(������B����F1�����h��Nc(�y���"I��8=A�P)�J�ե���:��0W����3��%GHc���C��FB���}O�.��u�h�h�&N@�o��}:m�U��۟�C���W���W�nFˮ���ֿ��Kbł��|����r�n�r�#�-�p0�� +����ʷ�_����3]��a�G[�����+D��A��o_a����_5�yYY�|�C9�m�ͺ��Z��N�X�� ��00|�ZB|cr~�������b���f��� %�c6����uMޒ���P>�H� �~�ӓ�R	�Y/;���x;����=�N��4e��Q�}P��E�� �5��q�����m��Tmklǩe�IN����c|{t��2�}3�~ݿ�盐0/����&���a���흰X�&�FS�i�L�g�l��d���M�uv_�U,�<�4L]N�s��w� ��� s���\��(�]����&fS�HjōW�� �Z⼣�qk��V��W����<rѷ-i#`2��6I�	_���/I ��r3� ���������@�A/�&�9��z��0V;�L�����=@��zy� gnI��?��
���V;��Zz�G�
����UlƄ��Oy+-G�}���À�94��!f��Š�<X�b�2�=� g�Ց�Z�����*>X�U�9g_�?�,K�������G�k9Y���4��d������\H�(�By��2Շ��\�?O�q�<�T�'�Yns�2X|Q>����7 �[[Vf���:�8��ȈӲ��r:���c��8I��8+�\oh��2q�/�3�T���r=i=ֵ)������ŤwcaW����\.w6�,���ӌ�$�~M�X�i��f ,dF��/|��a����S�n3$x��jR��*�ӳ㜆��^��"�����"�+�`����]j�!��I(5$�_�����n?�
���S�2�>��c Ӣ �IGn*����%�W���A>�����8�UC2c�Y�}�������8�P�Y����y�1��m.[zS��e�y;�b��ȋ���~�c�{�6�Io�Ʈ���o�B&O �|���E�� �U�P�|�+/Z�0����|�c��ְ���1�#�G�^� �� ��G��}� ����x{�߳��s�,x�tXn��iOczwS���/0���q�v�Ƽ��k-C���P���K�> ��=|� ���j�_^�勢��ޔ����Ge=�5[f	�{v*ZL���\���_z�	J�\���g�lݘ���� �����K�5��^�v ;dwC^�1����,�^���ֻ4�w%.���A��X/�����Ǵ��R��f���W�S�b��<���er��,���'�z��Hq��qj/�ro���R���7��öt�������Z��yj�csvC4XGV���yE#�Q��������O��fe`�H֘a��vx�����y0OMqsR����Q�:��ϱ�M�r��mLrH���]��T_��u��y�$�e�IG�o�+�p�o\˷��{��z���x��j���}��gZ)#�Hj]�X�F�|���1��א���">�@lJ��[�ns	��~5O�9�ֵxb���
�F�{jR1����
�2 �u,wnq����̨�|�NW�B[`K� |Vj��,��}&۟m`��R�%�]#�iRX�B�3 G���v9�q��f3�Ț*p�V�q;oc��<���� �(L�5�{�c��i��^~L��TF�m�E��UϜ���������دw�#�ѹ(Ȇ}�w\���ݣ�ǿ�V�8	8��=$�n�Ƕ�3��s��O���9��H �՛�P�jf�܌��on�<[|iq�_��$1j8��>n�wk7����6�