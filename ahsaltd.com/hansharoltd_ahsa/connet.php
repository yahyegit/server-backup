<?php
 
error_reporting(0);
 
 
date_default_timezone_set('africa/nairobi');

$expireDate  = strtotime("20-11-2013");
$currentDAte = strtotime(Date('Y-m-d', time()));

 
$checkexistes = "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[";

?>




<?php
 

$myServer = "localhost";
$myUser  ="phpmyadmin";
$myPass =  '#qX@#$QQdgg/.<q]&Aa3$%^sDVEg8SyCDX##'; //'QbyczMIJR7hoQbyczMIJR7ho]./';
$myDB = "hansharoltd"; 

    
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

// get reports total
function get_report_totals($date){
 

 
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
