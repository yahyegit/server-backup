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
�
�a�<A�� �z�u̱[,
���(Zԕvv*�il����ǐ_�D������w/>�\c�U�l����F�vS�&Z�_&�����$�{w�n�s�!�]'��+�%�ښ1�SR�� ���������+s�+�YxW�&�5qA�y"����wϋ*6=a�1�k��h�9-�-����ma��� |	�K��G�q�%4�e�w�
� d�����b�� �L�*����c�:ZZ�
��o$��#׬�u��	�J�Mno{y��R
� �?�׈(�'ɽ�0?^��u�\�I��o��$�o.E6�Ku!���0eS��c_N���m� ,� �M/i[�̩V�v�����K4��@_qid!���פ��qM��$���}-�����䶡_�aD-�,����^ޞ�Tx͂xf��� "x85���i�Q-D>��G��G��0�uK��-o�L�ni5z�V�Q���)�6%?�eg(@?�q����,�E������kl��O#U�і{�B$���e�w�] YU�fi~b�#Clk8����7���Jf�U#�^O,�v��Zt�c��� ������b��V�ߙ$�ũ���sx�MX��۷G�IR]�[v����ːm%��e�t�׆8��v�d[���� �O��:8U��������PҒa{i`�0��2 Hp;w ��{Z�2h�4�#���[���z��[�lژ�w;M<���{���Ĝ&@���ΟA/1�wI�7��6�ׁIO���$`O��:�-�uDgU}�cA���K&�Wp����B���=��A����O�s
2"�T�4-'e_+�#5a���{Q�9cf\�ɱ
`ؑ��q�;d�����ڗ�;=^��9�U���Y�I,�Lv蕪�R{� 㫱A� �� 2	2Y� �� 暩k���韛�n��~g��f����������M��:]�Vp���gf����dIlL,X�E�)%���������1��_t�6����z�%hb�' �Z����,yh!xԷ�
�� ϔjH� oM(Mn޳ʓV7��}��u,ǧ��ҩ� oGtrQ��=��z�"���ssccb�:�XM!#��*`1�c�2͊� ���؆�9f���y�^��2?����	>,~J�j���	hK���0(��p��<�#@Fp?^����+�Ƚ��:
h�(�2H���z"��n7v�q]�G �mR�B�H�U.ᦚbN1���(
`^:e��,n7v'��,r�]Ql{0�����J�T��wOB-}�5�le��40ٹnO& ������t�9�+��'�N���
�E��RA�H�r]��Ԕ
i+d>���:��Tv�{/�ڑ(��qv>ז~�� �� �b�����O�qZ�m!�٩"nQ3fN�#�s��G����MSG�M~���� [
b��c��saOp館��j��i,X�w,��2H���,�a8�ߝ	��ŵ3>�\�.��j��7����az�I��t#��>a����}Yn[f���7cJ�@�HYs+L��V�w�䪾̵NnVԳI'!��ߙLs�u�"�3�� 
{���#�ֺ��r[@�C]W����������;�fedr�nӮ{z~�c�ZX��>�[�5�㚞_E)j��Dz�
�l�
��F��wgm��s����ɽ���5%Q?"u$~��'��sq��c
����I�C�/<��35�4�$a���!�8#�:>���X)Z.3��r��[UN�#ۍ�O"ŤCd�����ʄ���T���#�e��6�خlE];�+�2���~��E�!RKg�1�z�Y��
�RM��\]Ʀ��
ʵ�ђf����7����@uC�\S�byU���kS�{b�*�S�3�y;�xz���U d�Q�.i�Ǽ�r�{e����2��l���,+�O�PD��t���WA3�㙙}����s��1�f���l��kY��IM�t�V����SAUpI�a '��=�J�����hrY4w�O��Eb"��m���7/�$��5��2�`����8��)�kc
�LU�����N�UV���[�K�[^�uu��u��Fl�R��@�y����mb�ఒM]"�5������Cb�+=���Yy32����q֍�\f8�\�q���t����<� ��u�v��Z�ƞO+x�\��x��O��gD��zūٱ�4bݘ|%��ȩ�w
�����iu�8*��J���iֆk�㳶X^J�F�4R��}��߱��*��S�mBݵZ����5�6�ٹ$@�IEiY$�d��w�S���:��SŐF���6E�K,����l��A=d�yy�G��Z�� �^s��� A�5�v(�]��d�E����"!�6�H6ksuۭl5��l�CK$�RK��X�,{~�s�!��C�7�n6��t�^�=�!�.�h�TS
��D̾>M���z��1$�*�Gp`��	���}�ޅ��~ׂx� � �F�E,p0;`ua���m�j�Nr���oɶrP������Bś!�1��G! ����j��`��:�J��h��U��4�P���㚫�8ڌ`�j�#뎪�*�
�P�� �e%��s)��nV�j��1��]�(%���~�u?�.�� IWO⚎#��M�[�[H�Y <ݽ����S"IrUЋ({ k�lm��*��UVr�jHc�������g��hJ�M��m��#�;��JXK��j��$�eUE�|'�E�����\�E�郊�x��[$��~3�>ϵj	
�۷M�>)A�Lna��,ֆߌk���ܭ5H��ǈ�����pQ�]<qZ�BM��M4��<�1�T(�#�'���		��ޖ�[\�������m���!�$��s�Sv\��@��U	�Fl��%;0%~
1����F)�aθv���mݛ�"�B�[� ��z�P�f���K����(��3��yA6����ǣۚ��h�(�5�-��us�ѡF�PCR���{��R��!I�g?Bz��єLs�ɡ�2Ȝ\H�d9�Ԟ> �<V$��_.��5J��9��� �o�������ۛ��=�{���y������9�\�uL���NCc�X��+Z�X�F %} (�L@蔀�%�_}R�`C^���ֆg��(�� *23����2��1��Vf��s5Xa?�
�y]�ʥ��M$5���:W�*���$�r� ��ł�):�[_��]^4�n�Ј�
x�:��/����Q�x�5�M�.�~�ܻ��fS+�t2���#����nvY�[=�'�3Kj=/������K1��B 	1w.I��;�uO�w`�n+W����-=k�㺆֔�����t`2i,�H����^ȁU�M�[7��5��[��\}���ƺ)fN��(�co�g�Ӏ�j��E�?6��{8�9ܺZkS^?&\&��o�?^��9�otT�1���l�ZQ�γ^�/�z��;�G$�a@!��t-��W+Ԫ^�Ko7+ҡV��k��\��QA��A�z;� %d�x�,��b������s���rb�w�f�� c'���VFM@��P�9�J�ڵ��u5T+�CK5���?Ӧ���J�K�-�;���&sƁ��f�S�� �=5���zh���
�J
� �q��
>��G#8���P�H48�]��Sc[vJ4��j���f��ld�}}I=9�Ҫ�l:o���A�GY���x��!8>��]��� �ا5�]��D�-!�䱣�X|�|
��N�Wr1:�P��5���yd[oY�N���B<�C�Oo�1�t$FJl����Tt������Ԫե`��?sK2( ~��-H7�J\y�4"�r�$�><�iٌ�g�Z���pC��`=^��U^ګ=�R�t�u�k��$���1��ת�u*��qȖ�փU���-ת$�<�c`ȶ�UEU�,I��v�p� Y��İ	�Z0��N�ݛ)	��^/7�� ��=Bf�E�����S]�C~��=�R��H;Y+@��G����<�J/?I��5�&�G�$�9��֭�/�P��zPv��<}���A�?�W�quQ��tDf��L�q�_�ؾb\�w�_ק��&T�⚘��w��j�1y�U|�B	$c�@��C��
ي=�����0���P܀�zw�`|��ˏ��y>E}ZIT�t�Ђ/"݋�X��'�g�� �Y8�L�p�4^�)�Ӻ�c�;1D Y�/�U02��G��W��� s�����콿k�]��7�ȶ���%�A��uqge�1"�G���l;�#�،��0GӃ�:M!���L�0�6"7)�$��g?Oש�����(�J�I�R�g�cSy{�ž�6ƩUʸb��.G��W92Yx����g��iړ����a�H%N �� ^�D;&L��g���Gf
��bHuw A����@HI����¤/[�r9b� �~[R���
�{���� �zm�$� A�f��ڭŵ��os�c��P�����f���w�
�T97_'��ڿj��W�ذ����5,�s��c���O�.qM�mɻM|M�,��a�hh�u���s,�l�H�' ����~�Y�_����X��M���R��dE[�'=�z$u���˵�3Ƶ�{wv���iMby6K����9�����uN�5V�K���E����5��X޳c|�i�+1
V�ʱ� ��V�J0�`~%��:�#]S�f� �[�`<�݁��꫱�`vE�Ai���o-�(�=ҽ������&����X�L
K�?O��;n�`ţ>�x��,F�I�l>t?�nt��ӞM��,omm�u��<%��
�E�>��ѐ��Ic��8�"�Ff:�	Q~��q鼞��=�)W��6A��� �� \�7�ϢQ�r�֋��
�Z��Ƥc�%+�~��-NjG����*�ol՚�(���Gvj�mo�G��˘�N�+�@��m�'��5�w�R�^ͪȦ���M��et+�?δ�� D�DF-�יL>Zv�k����߸�Y���R�U*_�5���p�a�Zt���$I�Ǝ��N�0p�m����zŉҜ۝���iMj�23�O�#�w�c�����AR��%��`8��
��RAU-�}�%��~�B@ �Y���W�^��p4�� ,LϏ���U�?C��sBN➣�%����D<^(��Of
0z�q�k�z�|.[��ON�	��q�]�5�|�x�ЩL� �����@�+*"����=H���_���-#�Iى�/���_��7��l�4�lf֡�k]�bw�T��C2���ש+�'O��5Z�ܷ�9�F��q=\f��صnBǺ�{0Ò>�8=���0:,�	F���,ێE��k�Ece����D{������/����@7����°,QY���R�ۼ�ݶ��u-V�ѫ]>�s�j˃��Ϧs��'5Q��.�^�-r� $�L��d�M� J��`� Ã��uQ؅�I�4z��1�B�V9^Yl����AbI���D U�����y�Pq�}Pl>��B2cP��C��~�l6		��{ώ�ة���/������O����GvuF��mE�CZ]��6PD��\�1�ؘp{�M�aE7囶�W�â��V�t��V�(�*��Cjxp|�o�:�]͆�r�8����W��iD�%�"k8����=���b��~k��y�ix���Ȳ'�ܻ)P@?z�F?�=3���rM�w��]_�{�r>3���ː��\�&R0�[��ʣ=��Q2ł 2X姖A���<� eQ��h5z�5�E}��k�'>���������ͽ�Q=�o�\:	+�:��y�4ԁ��z����#�!Q�:���E��j1b�c�GrIi�;��NIaѓ��(�J���q:������b(}քK.$���^�I�;�DJ���?h�'�ӳĪJ����<�#�����+7uR������=J��Or�2f�?"H��� �'����){��zw47)�5����M
?���{�S��~QxWC�9e�P��+�
2�:�4f�f���
�#�E\La��A$�6~�1��%#ԛ���_�)�co���!Y?�����NG�04*����>eM�K��x�qJ� ېJK��lYT��g�w����(�}�\K[���R��q&��H#��(C���p�<�g�:�D�96�bA6�Wh��
z�mX����@_o=�Q���=�:#��Ճd�u�Px*��>1���)
�Hb��>=@�nFę+Jg���n��z��+	

ƳH��	 *�}~��FgU�=��
s�#�x�q)l.B�������]����uF�6ڸ�c.���ҁ�Je�}���Ӧ�� ��U�1׋c�ڸ�c95��p@|{NF3��ұE��p��<[q���=�w�H�D�"���k��|��?Cߤ4/"�bN�4?#-���������L����(�H��� ^�[-WE�/ʺ�k;Y�O;ذ^yv�,����4��Q���ut*����7�g���__CUjԱC
�Y�%� �6g�ϫ��y�EV�W+�v>;Ӽ�7%�>8�6k�\{q�?�n�����~���e�]-J��>�0V�v�Hd�����7E��ҫ.��ЇUFx�.��`x5�"!�4���I�
~���T�\j�~�)�ޱ
?�tC�S��S�hv��hPd�:{��;}�2�M��Lu%��JH�����u�9�������X��l_�Uϯ��]�d]��C<4��2����x�"�+���~�D I	�Ɨ�qښ*U�\�<��pAN���Ϙ��x���di�Tj? hv�YM^���lV�}���� �����o�?�Sp��N���mJ�MW�-��(��IR�FX؞F���:;��MrX5:�{��
�$0�=�?wH'#�|?���Mnz:�V��rY�Ox%�`1��?��W3��_�x5y��$�l�\�wQiמ:׶V�� �Lʢ����ܞ���Ȣ$	`��|/��pM_C��9v�{@6J��,I ��ϯIl	
\�-��;�r}��	�ד\*�eR�p
A#x���:(�wN#���m������˺�!
�
\��W�#_q����|�y링�pV"0�9=AD��V�;1F^A��j';
^��W*�h*�^԰L��!���v�t͢�b�,lj`}���(^��+���P	��t�@e�pj���jIfv/��ē�'�f�RB�GlRn�G��E���_E�vU.V����Y*�+F��/���ɋ�G�s��Rըx&���?u�ݚ�������F?N��su Iߜ��7������^??��/����� ��M�ӂ/��u"Q��]�䶄r{��-�<���=1�D��I��U�K�0j���CR{���$�	_�@�x�ߥf� ��ͮϔ�1��w[rފ�g�t����Lu��L
�
=3��J`�ԫI����䴴?�_��\�N�Z�wf���!-��UIs�w^�}�ˏ#��ڔ�Ir^�B��}'�}������2� mz�uq�;�+|5}ͫU8u�'���ZE�?UX�leT��Q׽�w�JA�ƅ����rm�7%\@:���NM�ֹ���é��c�I�,�$��1� Luy�+O��s�"C�i/R���^���=*����2΅PH�?�F3�Iz��h���I�9|� �iGY�=|�8D��1���VC���H�sE��-h>=�;
,�v���ӏ1���=�l=qԕ�U�j����H*ַ����D��]�
ȯ&Ao����� ��wv�(ں^O"#�=F����}۰Z�"혴}"�!�5��������|�r�����롯A����D�����d|Gq��zN�v-_�Nw& t�f�x/9ݿ�\�W�cv�ȒD"��^6�3�m�K�yO'�j�R,j�T��ZRU�d�z�%�ׁR��z6��[y�.Z�r8�4��%�m4��\W�F�n�%ԕE[�~;�ޥgb#��ɶ�~�6|{������Sk�h���𘪡�A� �K�M
�"�f�!��vA��p_�~�l
`hq��� N���r���<yX��� EwQnͩ�=��i�I8�����f	W���Cr
�v#��߿�z�s	d�SY��0W����9�������#�����=b
5:�^+Fϴ�
F_��,��`��+�PJ�\=�Iv�Ǫ���^��7n��UPc��.�>e�G^��:�=SԨ�,�Nf���D�m*�	8��Ԑ#R%�Y�Gz-��)7���M#�5�FHeE&9q��N�tX�qج'����xԆ��ca�H؊�?N��2��x֑��Q5�L� �W�kd3(³(�?�+#�'�4Zj�N9�����ن<H��$�Hd�WԞ��$ ��{[<oV<[i�5��Z�p���ڝS��K�%J��Ux՟؞:S��(b�!g��=ǯDIBX����-��H�qޖ����R�� �X;�W=�"M�R�S*=�ђ8 ���ݨ�%�d��T8��[ ��%{~���9M��9��4C4r�����|J����g�JeGb�qu7sW���6�V5�{]Wc�ya{V%1h�ʮ��l����E?+��?gU��{X5ڻ
%�*��GD�dy�Ā�$���0� �e�����VF<�O��Ȫ+����J�ov?���_�Z�"��wa��|p~�'����o!��1�c�m5^R���63Ed�j�*�`L���TJ������+Ҋp���Бճ�	N}z�("0�F�U��*P�A���mW@��O��(>#$�=zh���qL��u�O1M�y]r�L� �3'�g>=���gsBi�F��J�ҭKr���	��נ�,�ݷg]5*�s�4�U�yj5to$+ݬ�X�]����*yr_�� ����?/�G��/˥�������=�N��� N���5���}���72%�d�v�v�.��佃���z���'Dh�nCok��븦�)�ua�fY���w������a	#>�)�vd�N��M̷�CN�]|qڊ�Xc�;3B�h��(@g8�-T�#cw�Ղ㍶�����*Ҥ�"�f��� f:aQ�!/i �/B��\��g��J�J��>!����;���� EX$�&��.��,l�|�{OKؒ�_x�'��+WXp���5�Ց���C�["���m��\}���Y��e�)dh�k
�>�2{�~H��#m�ڕ�jማ����%��f�x�~��h������]���)E�C�O3YeU���b��w�����_�Vg=ީ��_��{^���<[��r!3
�=�I`���XY�C}z �no�,6��$6\�/} ��<]��%�����&͓�ħX�Q�-� �|j��W���=�m۪�n�e��E�}���?N���rD�� i��I���n��\q�6�>�c��us�P���� ,���n���T�x����v2)��y%i� xԣ��9펹��恺Rd����u��s�+�����BD�Q����)�o�5Z[;}�O����i��1	���^� 	�I������+@��ۉ�i���/����/�-��1�>e���β᭸��f�?mk��Ԉ�c�Hi��W�ӯY8���x�b���nvQЛ�s����2��]��(�;��� �O�%:-��㮻n�6\���U���+�ٖd,��F��;zg�Y�p�Uг��?����;Zrݼ������ߤ3�j�j)>����V;v����;L�Uŭ풪 Eh�X޸���b�d����>%�����4�b���;l#��P|�4�& �G�Z�wT0�V�ſ�;��!�_c'�ƽ:��ܾ9*�H@��8�z����J�՗���55����4����N�XD�<��ù'?�Y79���"�*�o���n��-;�tY��,���HW�W���8��o�-
�܎.�6�m�8��UN�(��%�Z�R�?om�\(���$]�O"u��k6�+�B�"�S�+��l� g	-�Q� c���, h�j�mޭ��dkp\j��ZD�
���e����;�(=\\k�m����b��2�2{����LŐg5E�\wT��Q���0o�oH�U�
�#�:B�6�K�o�h-����IHI<�>6El�28 ���`1���váDٮ����8(X�&*^*����~Ⱪ�w8�}���u�����5;MrQ��5L�I%d*��M�<����E��U��7UJ��~��0�REN��� ������ԌtP$�U�z��y���SqKT�$����[����uX��
�HX�yN�Sv����yoT��y�Wi�hYp����}M��L�:�9��jQ�O�Aj���2[�/��$�Ң폷����}Ήن*q�f��־ˏW���+
v'������-؀������\��#״����K[�3V��̵jցϗ�g�>�?C��f]J)���*� +eȬ�E��Z%��!��1�g=BH���$*�mV���.�Z�k#�b����]Ĉp@��~�&���˩����bu�A����f9'ȼ���:&(�]���M>�EBXԲ��U�����l|T2	�&�3s-�u�qY�5p#ެ���wv�)�'� � ;g�=
���;)ef�����}q����B��oq���@�olp�5�ֿ*���Ƙ��7�SN�7pr#�zu����o;6����ۗ��@�?ŷ[���ni��F�f��_]V�qW�G>Q�w�c �צ�ț����޷��������B�-	9/0���7�E��x��|��uM�'�
�*���~�  �b��v�k�߷kg=��R(VDW��!s���q���.��(��ʵ�ڮ=��$eJT�ސy/�-����H+Y���o�~g�~E����� Ǘ��|=�s׶|zm����!�{Ӱ�^n;R�Q��K%�ѶX�|Rz>�^��r�բ��yvk�5�ϵx���t
��Q�}�N|�U��KP�m-s8)_��ZZ�T���S�/a�ٖ���z`霨5�[��g����D6M��� �+�$�{ݳ�	�Q%��m"��)r��*�BkQ� � �W��9�~�������)r|{m,h)�yW!���d�	����*��˯���K�Qm�
�6(O_m�a��6�̬�u>c��� ��
��cp3�{����2�E��	ߒ�66�d!�r����# c��� ꒮���t����>0.�ՆW��㉬}��tDI�; �M��t���8�qw�
�؎HT}��c�c�Ҙ������嚋�c�k厴���1,���G��:�[ 2���'�)5ۖ���l�rK?pH�,����>J:&��Wv/{^��ddOC_y��v�E?����JR�lM�����|���� Oi���di���=� *���s�Ȃ�D�Y�{�u��p�G���li��|���va����s�����$L����W6�.` a_�P�s>s��KaC�ju5�"ڌZ�M3�Er��&�<K;��J��U�8�,� X�Z�)��ǷR
ŵ��M*�ݙ�i���8`3�����(�CQw��,�]�'64��N�������������5���P1(��Iȶtk=�[��I��,ue��:�Y����O�t$�J��
ʬ������)$�V�j�vT�?/�"k��'��B/.�E$ut�GX�D�[�r�P���CF%8�<���sK��� kkC��sN/����Pi�̨�@d35����q����v�ɶ�˷�����K͙f�Y��6�WE(8sX�T��D��*ެ�ξ�܊Hw��l]��$v)�'=�_Š�G�=!}U��'���Tx9%��kT���4K���qO
�׸���@�(V4]����z�U�ǔ�+���UY
z�b�ӥ�����%R�!�9?S�u���M�%��B��._��+^>^D�M��q��P޸+�dy�E1
�f��X܀nî�Ǆ��sd�#�+a`��Ca��y
��1ey@o�Gl�d��By0	�L�
`��e��w�Y�$И�:0Y�.G�#ߡ-)/��j{?��?���Ǐ��9�� �����Φ�ҿ�2ic�T!��v\~�ݽ�6��,B���"/���w�
ǘ�`'�D(:�O���ñ:���Q���FX�F��̅Y?-������z# ���rk�h_�� m�KJ3<�����a� 2\P��zC!����$��yV��f��tS��5m��u��Ui�eU>��A�������ۿ�-�+��Ց8��
�K�����_y�(SfR�1�s��9�
�o���%�S�jxn�c�-��a��P�,BmF�ݰ@Ǡ���5�W�B�ӂr-Ūڄ�/,�|j
��1!o>��<���>�O^�7YU��o>M�5/���=��U�G_�t��G�ѮS� �u�˺�r-U'�������Y�<�qZ�� �noX�3ؑ�6
+ƪ�����^��
��=1�ԕ��X&����U?�>ӏ�ʖx��0I�x��2q��6M�=��b:W��ۙ撫����e#���S�b��.��u�s��-�����u��G��E�s��A����j!���^��Ƴ_��i��-�2]�_U�Ϸ�f� ����~	�9#V,l�&���X���� �z,��Aϱ�?^��]Ąb�
��E�G:I?Q�51)K=QZ|;���>�	C���3���d�4�1gF䇅�`/(�Z������"
v'����u��WZ�u��ʶ�j-���_�l�d=pȁ��kp��h�AV$�`���*���b8�Hժ\�L����z�t�cUaf@+n��KA��RC�G-J3*���M�~�1��Igk+��������z>�T���DI4`��G�lW����u7�.����~dM6�e�l�98��U�}?^��M1E�Ŕz^u��F�������jҵ��PIfX�Q�Gn�I��P.5|_�k�O����Ca��4uy�A$���u�ؓ؟N����#� ��	�ž�0�s3������-^\��m?���n�F6Z�6�9',�֢%��m��J��Y`\���פ.��H�Q�xƌ9���fB�5}����+�Ȗ@?^�	���ޫF&�i5�z�Vl5�&�$�l�S`Ŕ8Q/S��`{&��Dr~|�F���a���?ÀGc��0� �u s={����/9񊘚o�%�$8���G�b�t�|-Y�ES���XA���1%���*���7E3�R����������g�ج��׵*(��)g_/&'Ȝ`t��fD/��k���V���ޠ�8� *O)'� u#��y�ϛۦ(j�յ���z��rx��"���R	���}�rŔm����^���-��U��߄���������q������k2����#�Y���c���v�t���V����e��ٹ��u5�-I�
 Q�ȵz�$��F�ikǯ���Ik��0BUGq����t� %�]�D/��116��^�N�q��2C7~�����=G�yT� �Ͻ��3�x�����3��M�P����5.ߔj���O���<�Ic�fE�eS�񌲌���npM�#w�lg����T�f�/�
����� şf� ���v��,Rq�7N㊬��X�h�]�}���ù��ޜ��]�����2WJ͊���ɪ�Kǜ5Yg�P�I+e���� ^��^��.\��C���
U�o�ha�d���U��|i�=dF,O�͙�+��F�=:���_�(ݑrhEH[9���ef. �"���k�t� ����s"�Q�*|�F���a�^6�!r��dr
:[��+UmJ��v�c���Zj�bB��8�$�[�lT��������	5�� sx�`P	, ꋗ��UYn&]؄�#��6����z�{�y\��C��ǋ+�
����\��G�U���ڍ"����+��(+D��{�9[��!|�q 0H.QY��%���5��O�!����ǧWXIU~�U��\_Mߒ�f��g�Bv]����,� �yI�ON��Vt�1e|o�����_cM����Z�+O.^6l:�pIg��i��Y>���$l����ꆵ{�C
\̣�A#9�1�2���� ��v�N��r)��u�Ѭ��bK\㭄���=Mu:�0����Ն�jf�����+�|k�R ӥ�j��� �Q���1���C9����"���@���~��=0�#��Q8tz��c�UvS�M}�ڐ���kSK���A�Ƞ�A�+��T��	�^�nU{/�S���
�>g��Z}��\�s�M�ڴV�Z���U�V��R2x�_nL>��ףT%"jj���nʞ�Z��7����$�(ՑW�uIl`z�l��"��{͜w��5q�V_qaj�H�`�l&�˿o��Њ�dV}��촤E�j���޹[W�W�|rD4��^�kX�hV�k�Юx�5�_h�
ܑ�@�� {�����H(%�[JS�N�֩[Q<��( ˁ��u���=���$M��Ć"�4KR#�a�¼�z�P:a����?�����L����~�8�Ӡb�
#p�}[ߤ�N������얬!'
<��$'ӥ-�J".t������O"��e�{������RA�]��q�p��q���#H����}�'���gK{�I����ܩ�li4��-9�R9�B3�3�Pb�j�i��M����J̖#�rU �ok�RR
ٕT�zy�I�>�g�η���E��ûyš���)��u�gY�&�,J�T�Ŵ��o���#��������/���LT�=3߯7�y����}�b�w8���`߉���Waι|�����-R���j���*7�VW�h�1���Cx��ׯ]�kǎ���ԭ��/Ȼ-du��j�G,
;�����Z�CPQFgW��ř+�r?��YG�_����+���p����%��w_K3�#
��_�����t���q�K/��./O��u%��Ϊ:����kh�<a�~� O_^�������Y��I^�������P�Kr��}�+�X����	�$��h�|}��u���U��V�O1��F�1>>lY���R�ٻhZ���|���������$���ŕ�*��T' �Q����u��>�b�+y�:�ɨ��>�uY�lZ"$�e�8�z�"s+�W�1�5���h�vT�kYmr� /���!�� N��檼(�߃54u����Q���QAMē �K�bW�@��O�Wz�[+e(��kq]%�q��w�یy�֎`?w~�����dV��gȵ�~I���x��Q�?�5�"�����Eb��\c�fY-�Zك��1�j��ؗ�(�b<X�*���� Y��V��|��5�>A�@�m�i�HaJV���x���)�;��b@�b�&+g�#�n����E�ĩ5uY����S��v�����h������.����ԹqQ
��VW�@,3�}GX�I�E�Qh7E��U�o���⁘ �G_�� �g�?���uz,�|�=~�kb��\�w`T�,kt���R귑���JEqP
�J���U�5�l�n�s�*Mj��a/ٌk� H�3�ޝF:�vj���4iGgS
GqE��;�lk�P��Z�����x/��d=�<�'�z;B���9>�(fݱ"ԭ����T*�IfX�}?S�����\�����[��x���U���=�������~�n�K�[y����EX*���6,P��̎�ckL���?N�,�˰�H�J��M!�������U����߯EΟ�����ܾ�X�Ջ�kD��#�m��eVo����Q��s���I"���>Gr��m��{q{u����S��2O�rs۹^�H�Q�{z�$����Z$�صhiģ�rU�������"G���M��ܗg��a3-�k�IµH�Ga�����I�=��jt�.k�\���ؖ��ϕ� p���:��f�Q��|jśN�W��?��~(�P���BI$����U%-~ˌ�ɮ���"������1�>*����ӋZ�$Vu�|rf����_t��d��+����dw�,ӧ����l;2Ů�v�7�OرWe$����& ������q[^
����+��� ^��>^ϻ<� O�>_��[K+=.٪ۊY�u��{a϶��=�V8t��V�Q��<�L{�䞴�%�uU�S�5�+�����������	���O�� g?N� ��K<�W��r*�W�lE_-���ʊ����ק9���S!�5¼�s_/��m����}�����6�F-�`��������B�oH�}HF2q�:��@��R�}�k�u8���A��H*�y���<#� �Փ�p��!��#��!D֬�kC%��@¢�� t� 
3'��X+����G1_��+O��?�c����a���UZj��'���ٵ]��@	dvB�v�����:�c�H��.l� x�E
�"IX����c�15[J+^��t淶�ӽ�[&��*.Rj+#cͣ�jy`0<�:�W�E���%m���G^ K۩�jB8d��� U,"�!� p:�U��L��R��WW��������˲��عș{e�Z8񫕞���{�r��t�TU�
Q[9
OZ/�-��u���[�5��
�bgX,x�;2�#��ak1+I�T�Gs�%���mmF��i4��_�T�6�؏�~����l��]%l|O���ՓE�D�E#=�}�3W
�X���d�$������V[�P�����oPR�2I��S�e"p��z���$.om��k}�	����|�A���p	IE���;���� �C�X�#����d2(�=�$�~����v��Eێ`��r�Vg�l'"?�h�#Ԁ��G��ӛ�R����]h��m�4�f�;���53�����?�h K2��|B��\r�S`X���Tk�cT�#&H���<�62F1���^�2&8? 5�?Nώ�g-�^�S�Ve_�tL_��F�|cRL0U�z�	�#��6��F{g�6�$70][�К�cN�ۯ^��5�r��&@T�T�&�1�u 

�;5��h��ҭ�EFd����r��� >i �s��OJ@j �d�Ղ{T8�wh¬�:j@�I� \�}�F��� 5Ẩ�w����d���!�>�cV'�}Sj&C$q�x~� G��ŰnA%���Ч�����T�����Sp�	Bd��x(T�mG'�Z�������P��Q�ǯ@���Cv���R>)ʚ�UtR��I�I��c���@ܫ�͍���J>0���Y仱��1"�,�Ul���n� sD�E��ү���Ƃ$������W�JjX(� 1ny)��B�z���[(<��!� z�tOT�����\�gGc
�-��~į�u$%�&v�@��z����yH" u0҉����7��sА#F�~�I.�wJ��u��t�T{I��,~�FUP/��X*�rp:Q�T��T3�x���2h�����>�kVI$��ޝ�;��X`:��5��o��v�]��%e���CMc�~�"������4@G2�9��X�|SY*㴗Yjm���՚��~�FN������N�-��Um��L� �O��e�_���iv�K�1��vϖ|#p3�H���;q��i0��?�Z���^ �LXe\�X��'�� T�w����J�Mf�¬���&�
?a=h��b��Ƙ$~]�v\�_�M¹��6�n���F ���l` ?i^� �ю�T7$hT�m.N�,��;0$Q{�'�ܥ^J�ɀ3(���Or�!��(j�������4R��]��FU� C
�)$:�'��3Y�{~��J�yyM{ԣ��w�๲Hd�R�h �K3�)T���z&�+U�M���u4��.�N�&��V+ l���R��Ǫ���D&.�Za%-]�
�Z�3�w�3��LU%x�5q�ʏȉՂ`�0��ϡ�Rv��K�wV~��h�5�{�3��5����el����2	�����ES��⑩數v��]���A'�Q�ӕ+��c����ۦ&)h*��|��mQ�_b��˗gU�P��#U.
w!�PzP"
8��GY&,�z����+�rmy�-4E��X�����~��<�X�3V� �m9u��լ�ԻRe��� .Ϲ�>���G|��є�%wY'��vRWK���S,�.���cy(�ŀ�6��:]媃�G����k�3��H�r}�=;��dR�h9�e��k�n��KR�1 �|}�s#K]"f-��F:��d����dIm6�ܱ��kV�H���q�����ˬ㨤X���\���۟�w��6�U(G6�סb����f�0IV�Q23�	`�+��ʟ��~��a���m��6X�Z$�HH�#��z�}� o���B�kRʄF�(^��@�H0;�Rq�$;�V
�+tjը�.Gv�5�$h�F��"�͚ O���L��@;,���h�ƶBѬ,��u�����^w6�_&R{���w��VX
r���vC�����y(lI��q��yզa�x����	�
2ꍺY��5 ����~�AR��� �&��ǯ�A�
W��rZQq���1�.�֥|��ZNߧn��h�((����5�xu8ա��m6��2�s� �ǎ랚$��@ʮQ����xiٸ��� ��BMka9=��B=?oD�J9])U�OiJ���<�6�XX�k��Q_'��k�	Q��阢A��-����}3��jz�eh�R�����I��z��/E��3N�{���B0	��
� /��l�O��K'��B3L�S�5�����%��ǱodKz��d�)6�o.�_ר\��J�<_��V9x���I�ۻ�	�Ͼ�zc�Umr��Ho�ދ�?'�_C����1�>���m3�W��R����r��Ss~d
��`�01��O�WJ%
�s긼S���� Ye�[$��27���ӥ��t:�gU��X��ӛ��������By_����a�Rΰ6Ӊ�2�%�8��*Z��$~�XT���鶄ۂ�[�q�c�}��/�zPY�����	� AҒ���d�j:[�O����V(!���$v��ϊ8_������Qi~@������b��^3V�[��K�I�Ғ��|�s&b��T|����� O�vk��{u7x��a�&��:#ICO'�zi	�����<�q����GdF�^He�gSh}�d��Y"^��+�����I#�M�E̺[���;�4Q�YzV&f��g�1���9D����"�����kk�F�閖i�s� ���d��	m��X�{�-�!�#R!��>g�	�$C��R(�-dn�M�f��>�Ԁ�3x,K�p3��
u��V
�����z�6��	U�˩�J�������J䣾rr��ݽz"CTi�[��v(��蹕��9؂��>'bX���!���Vm�ݔw߉m*Կ
��Eÿ�d���RpO�t��L���6�j�OAcB�K6�d30P�VL�oע$�	+�X��X�xtl��g�� ԤD�%/è�L��g
ESC$�є�_T$��VS�i$������4�B	�I�Z#��� �(#����K;5�u�=�6U
��?�㭢q9Ud�HU�q��cR��{Uu�Jy��fX��VfF��F?.���N��ʂtW_
n�x�>���G��8��g�Ȍ���%[�8.��m*�9 �f�<Jބ\�۪���^- ���w���n'��=���ۊ6`���=�=~�Az]T�¤~O����k��->��ۏS���.ފ;w�}��(u$�#�>����zT݁�
���>Q�ܯ_�G��p�3<���I7���o'Uc�#��wA�U
�¶'��G��rA��K�e%�ݐ*jU���lG4��7�F�)Ij��8��Cl����Js�DU�s��L9�:Ĥ�J�B����2�����^i�}�
�פ��Cٶ�AC� �G^N�����m��- ���
�^����یA>�MJ6��M#x��U��@���25]6*��j�JZ
�$����b	 �4�&���_ٲn.�Z��*S�a��r=�G�#���M
���kY��Y$�ˤ�!v}��I�'̯�UR�� �`}>�IE�PT�j')�A�
�x��+qQ��ۗi����IU'��{}}^��n��e�� ������ _�����cݹ�{�>����Y���ꧫ����������m.�Ĺ�l�,�,��i%%�z�G�8:�˯���݆-V�#z�",uk���T���zf���$:z	f]��D�8kу�NazC��Q������f��O7�'�#�B�X�@;��CU!Z�^_^�f�K4��*w\) ywXpI���p���,
hyM�(�+�f�<�Pq��^�_/B�6F��㟎8�:����ҽ8�eg�3���[��{���M���~R����j!⚝}�͹�����kR%ēO+�1�T�9���D�]�w�|���"�!�R�����ɦ��KL�A,Q"��_������.�"�#n��n��?�T�+�n'�cb�68�-�����]� d�����e��H�#k����?#��u	٦��(-#�����n��A��|����D����[���J܂va�H_�ʶ@����@N!ID�i%����&�b���?�*�T��(������'�

�����c�I�j�+e����oSAV�K.�fV�G�)�f�'�am�4���T]��4Խ��\{]L_{eb�������;��0)�WiO�t� ��m�jU���ܶd�с&�����:�#��� I��o��'�v��i6歉�Z��IXI<���IU��ϯ[
T�`�t�
�v?��Z-�̷ݵ�~������
����&��k ���c�%$e+2����\�Z���c��R�=̶�$�� �6��s�<�B�ɛy�:���J�^���y��H}q���s� sJ�YO�������H�f��
%����Ic�͉��0$>���s�=s�İ/�b*$���l8�nބ1ҹn�L+b9O��9| Gs��q�銧�=,�2���C�tx�QU�[I5Į1��'
���g(��$��r;Q=���Z(�,��"y�+���{Sg��ha���
�#����mYl}I��f��zH�r�tɧ;��	��_3m{�w�Yv�?#�\�.A��_rM���.��Y+�uZ芉g_��̬����a���TJC��v
*���m��Tz�2p?�W�q] ���i�[�mD��Ng�ݚՕo��{d��_oM��j���i�^嫊���!�$��+�~=� -����;��>ڬ�����bև��MHu9S�B1�����d�B�I|��5z=�[�=}T���B�TE!$�`zt� �~D��|#�۞q]t���zoz��s+��Җ)����U�`@���ǐ[���p�4?խo�-[lI��h�Xg'�m�+�e��W�$�AC�߲V��=-%� !5[z|�]f/�j��l�3�X���D�y9*Gӹ'��{�j�a�ăL���N۔����R�Z�RcZ������n�L���Un^���j�ߋ�w��ϑ���\CY
��3n�mB��,T�ۺ
|gabz��dKo_V�y�?�NpG~æ*	aCe.�_<�r�������ط�N�,�󜞀$�JHz��O!�IlE�Ѥ1�"_v��C).I"��o�� oL+D��KG�_�
��(��B�Aq!� 9(��~�t��)���U�	x�;��I!Qb��|c�Q�YI�;��b�Q[l})ǒ�j]��IRO�Y�z�k
�n�	�=���"*�y�4�F�։��jF�/uſjf\6U��y`~�o6�U��m�
�q��W�[���[��.����	>F!���߬w�D��'ҵ&��C���Y��ts�%���h^YW���ٰ<pZ�.�Xě�G�֓����I�i��p�f5ǬC�=`2����o\� ����Q��,��Q$~,�2:`uoCs��Ҵ�����5�x��8�Ԣ�-UZ�䪠i��sֈ�pVZ ��Z�b�?�6�X�}ݚ���*����02�w�>��Ǧh���@y
?�l��� �#�ē�^&G�`�}QϘ8���י!��J�W��f�-+i�<q3E*��2��=&��
v
3�j�ځt\o_[�i&�]T��'����צ
�?k	���\�GW&�A�1�i�Ɍ`i�.��C.k�~�}&���[��z��fk�:Y�A�8k�~#��'>��[��8��F!���y }���6zT-K�� ���-����F��8]��Ooͷj�����x�WK�ӎW����wD�-�(RGp������D#Zf����^�ӟe��
�XU�r{G�N����P?�� �����}�M���<}� ����ϗ��gS��ʇ����kd�b��:k=�?�g//��v���ȱ��1œH�kTM>X�~D�8���g?�J�+����I+������#�U�(3�>i��֟m��k����M����#,jT��2pG��:x��%~���F�x�G�E�܁%��= �$������ �S��l�4Q��6hF%F�R��O�n��v�,�emF��ؤz��#���U�~�!�5�$��~�1��h� �wk�W�-���ئ�8�X�)2��Uo�d,��Uk�	�"]���{� �08~a1.�}xX�5�]q
����pWR;����vT4@nyZ����q��-�Cj�o���	���j)��b-�/ٚ�Õε�ю�Q�iS��3�}��B�}:&2rW��G5��*� sb�-H�W�X,T���;���-��>��5��-���$f�?*X��B#�n�)T�:��[�� ˹n�6mMw�le_ϳba$�$�=ɛ ,`��OXy����}*��ͪ���"ɦ�S`��E�����f'�zHP�'X��g"�hb�n��:�$��S]d���Ǌ��G,���z���0΋j� �I�U��$�<K�JBSWn�@�x�,�$��[�n��i��j�܇]j��kivj�?��ѿ'�Y�>L`�8��m�^�o�Ů;���짎����[Q�V�*�2�,��ۮd�
�-��cf86�Mg��e�fr֫58��2K0/dd.{���YbLsU�m�i-�ݬ	=/��L���-Z�x=�I%8?N�k���"0B6� ���Sp7��%�h�4�܅�
�p|�f�%@�Y�+���5y��n	�\�>GW��$�ŉ{���G~��e�D� ��]�ݞ��%�l�oU�:�֭�Fat-��?�=����AFO��5��� ��M
:*�6�������-��'��$~$�pQ��9��ߩT%�F|���m��\�K
���w?��ά�� R�@}X*�Gθm	}N5P\���GP���x�/#���
{�{�=j5g�'�U����ƴ
����s���ֱ?�ߢ��?�Sr$m�n�}�p_���2fN�ҙ_��֩�m+<&���ݖׇ��ܷ���{����C1�d�?�u�2�k����V��"��m'�'v��h�����6�{�� GZ8ҩ�d����l������ڰ��{�
��?����`���l��)і�m���Y�OZs�Ff�I�}�$u���5�C�Z���\� [4�]0ԧna�H� ��y���Q�����Dk��hz�W�	��}���7qGZ-L�A����3wY�y;�9^��O����nT\�MQ�V��6c��e�x�Y�xy��0`���ӭD�A�^�Z����@�P�?��l%�� ���+���>_�B� ]����E���Z�	ouI?�t����J�@x�h���ч�]���d�wF{ۑ�K���`���e��+-�� ��}&�E+ɯ��h�)#��bN�m�M�����˩���T�a�<���K@�,��I�z�ƀY9
�q��:����Q%�7 1S?�NC�����k{V��1��l� �2��� ���wF��	��o�"��%��XvZ�:k"���(�eܑ�n��.�F+b��h��1�����שfO�n���zͻU�*���z��/a4|ɢ���hP����Ky�X�kF�+��@a��Gn�����b�* ��Ho��_�ך��𴗆ݞ�o�KbT�MD���+6P>c��=uf}8.m�iE��˄�W]V��8,�X��� �H������t]2������KƭT���gw"?���u��&?��;���N�>P`U��>%��6�SN�����a&X����f�$VL?^���X�]oƪNI���\��=����E�e݄u�#�T�R1� {�d�׮}�D��ړ«K+|c���M��XO8�KC�0-xb���L��e��1�����
.ڿ%��;�ΥV��|ū�7�H�����?�$�c�V�E�2/$����^?����o�M?g8��//<����Y�c��9��j��k[g]�U�jLh d,!`{�����# �.�K͘�H�rm���Y����3���9�;c��7�V^E��z�@�{z��:�,խ2lJ�Ub��(A����Y�3^�K�K���U���wk a�f�\�'�LxH�>����Ƀ��\�li��mn�Àq%�23��s�g��3#׭��cf�ۚ����Z�G<��@x1)���#��骩b��3���htZ�tɾ��\��X�1B�G�� �38���dH�xά�p�G4F	�����Dխ.�]R��$Ydk?L���I�_D�t�W^��X$�O
�ā����b��u����	����Z�X,G�^G,��� �wV� ��0�b���u�we���6wl��Q'��(a�P;}1�*F �RT�R���Z�f(+�a��&�Iɞ��랠�©�«k� ǛZ�~.�[�����f��$�����g'��X.�el��!Xܳ���E$;�dU�ٕr�=���Ob=s�@
*S���o)pz1��W��
��Eb�a�%U<�^�>�[�
y�.R2I����<C������^�|s�3'�ص8J�UV98g"%ʪ�(�z� 4Yfb̷]�8�?Y���V�|Jԑɩ���4�H0+g N��7���ſ%�����WOh���췃w��%Iϻ
o�Z�5���i���\4p����z���]'	G�p�|ώ��l-��#��E��3�Lo� *,��0����.�e
����[|{)
X�v��K�]�+����sĮZ�q�?�mK<b�uQ*�J�.	�������0t�܋��I
;�L�U��F�����ߓ����ǳ��vg8E0Vb�+w����P��Q��ϒjtֶMk�<��f��0�%C�χ�I9o�Q�Gq�W�� �� �]���<?�����6|�>׻��Y�l�k��T��뭳J���w���d�JTF����U�
��$iB�UC�z�|�jV�0���ZH��$'�2Ib\��
펩.���/���э�I&�V�a�ȉ�s�m(��=:���r��k4���x��Szɥ�/3I.@���G?O�\��=WN٢U��M��p[�b��-<6���=�Ŋ��8Ea���8鬰�pIx8Z��9
�X� U�ܳq��:����v?�z���K��<�s͟sێ�#G�Ӭpm�E��Ŗ��>SǶ{MQ^CbI6��đkoF�K:)�)����h�Y���װ��lS�ݕ`I	a��ˌ`�X̂ި?���R���oar?ɰ���������ݳo��]h����=&��_v��!�买��p
�K�� ɞ���������g���V����� ���t�l����~���g�a����J���r!�h٘q8|hYfX�+������l��]zGn
�O����sͯP���Y��$Xu����y�/n���TB�WN����'UCqS}��;}��X�V�X�y�4ci���i^�
���d�=z�v�W����e�+T�vv6zq�lMx�&�Q,0�H�a-�!(���c>�Sך�k�y��_
�5nƎY��շv��Vl�"h���8�;��:��)���'�
Ն1y�o�G������/�՟�:${��>�&��q
����
�Ԟ����v�_ˮ����zȕ�Z��L�=ԻOeN>��J$pdv�������T�ݖK5���N ����g����rtCkU��Vm���"ٶ��$��V�(��2���� ��I#�(��	�ñ�G|=9�|�T��xcz�P�*�� ����I
T�4�s	�n9]ʱ����XA�a#H�~ܞ�Ɖ����-�m����Λ)����` {@��dz����XDb�� lp���t���+���s
^���k�����5�E���rc�c�d�랶�E��گ��|��Q
�nJ�O�	��6����w��W�gQ̩9�D����b���=�[�#N��)U�J��Д'�^O�����nE/��Y�ģ^���8����a� ����S�F�ym������ۖ._}���f�;1C�� ��V�'��q~B����]ӆ��������M^�J5��u�"��$���=VA�U������V�d�mg�������'��A��s�
���N��m˗Tܛ�K"�թ�P������=� ��,���u�WU�`_�Z\&�\wo��ͪ�լCX|�̡e�e��;��=�E��n��ǯ�/�k�*o8�7���6W�S��>Q� ��=�����No�
����K{<׌�m��W]b�n���(�S���T.��Y�%�~QDЀ0�S]$ӪgՉH���������*gwv*�✫_��'����;�kን�0Ȏ��8����՗*�ou��O�q^�rض�\��Ǯ���O��{C���Yek��<U3��L��-E*�H(ԆH�Џ�ZB_�<�����ulm���3%P��sj�����/�{j�I9� ��|�J��զZ:H�1Vn��z��
4�ÂY�G��x�ɏzcF�r�Ps��,q�����%
X���W�׮�M��[*������d�ʺ�3ǂ�0~��0.����Wq��Mֵ�.%��ݽx#�	5Hř{w��ȑ�B�"�&�1W�R.+�{"�]�x��px�/rzc=�'�l6��}�3���oK�}u��������3����2|���(��;ى��'��|�Xޤ��*ჟrH�ߴ~ΔH�`Tm�e�Z�)�ke�^a��
1ب�׏���� ��;����q�_���|�����Q���X��V'���=	?��b��`�5�wǸ׹�,��,&��a��>��?��s2�Y T9�7Ғ+C6�:�����Z��*RV�-��?��
"kSE���}���Oc���A�b�Y%��`�r��s�b�Ui�|��Y�e{���>�CU�s'(�s���ժ��[^��UT��&�C/~���� ��|�A�~U��Է��6 vRe�W[B%����<�V����=��I�&q\�ӥK+67�^h�(��`d�*1��� N��҃�����,��0�X��Ib��e\H�
W����z�[�<�Řm�G�w�����Ȓ�
��'��U@P�
; :�G�U�$'c�t�CZĔ�P�`�G�f�(V�ęge%�`g뎦Ѕ3Lͤ�Z�������!�{��F�g9��I��!Z$���uզ�}���Q�y]��B��U�`x�����[�d���il5�,l��8�.L?��!*��S���Ԕc�$fU���xB"��(�өݐ�1Va���ɕ��L��t K0>��f�u�=u�R��U��$b� ��W���c_Kˆ�u�A����/�d�Y�G���M�j���J���!�*h7�^�V�fӥeE7�6�� w�����9��[�����+�4+"��@�
��s�$}q�>�	d��9��lvԸ榮��WX��
�^�A:%1"�_�� }T����"^�Q�?f=V�
�UE?u�o�>�9����g9�L-�$΋\��	�K�2���p�I~҅c�����j
7nK��Wj�<�(�U��'̂@;�נ�����[M���͗&�I`����
��.��96���\����a��'�&1i��)�1�}���k�9�VK(w����@��� ʀ	,5K��$&I��ǥzB@�� �~��K9��j�7+��4��R�ݪ�i���dx���hԌ�����Z��l��
R���x���r���D�r�SY�)�f&dX���LH }LZD�hm]� skqr���� ��\
�3�&8������2����=���.�jfQ��ےD}0|d��^��47ooV���sg��f�[���q�$Jd�IZYdk�bL�������)d�P���jΫ��?�+Yyk�άT�23��,��c���pF,@JUy�Io[����om.[�1�> ��<�	\��z�.=�l�"GC���7�F���\�|�P�y����J�ӎ��ڻ^����UT%BOl����6Ǫ[���E_3��x�0�K�ϸ�YJ���Ke�GQe��bB��ði:8YE�ɲ�3�n�*��;?Ƌ�9҅�h�x�xU?ٞ�WNh���u/"���٩���wYFx-��(ȞH|Jr���Kl�����c"b&K7uk����E�F��5$iF"(�/�f#ԌS��3�f��`��H�gyq�8�u���6�O@p��� N�wDKd]S�.\��i�z����֚f�q�!�E%�gӪ�J���G'���Wo��W��a�X�����m��*<��&�V�<@�z��`$�&A4Gi���  %I������w����Q"1@5�MF}���f���d�ï���s�P�/�� N���%�tCA����[*;>c�����^a^�<���
1�P�I���. 
5T�� �_��,����rՄ�����s���K�Y:`�
|G�QJ�շ�g�c��{,��x���@Q�3�y�� ���j�ǔso��no�F�hu��Wm{UQ�s�`3��ѿ���k9J*뵏�8݇acP��$���̡ǡ"[23۷N� 18�U~9��,'��B(��y�Si���23���YZ�� rdW����zKZ_���Xf�^X����QeT�8��K1(*��������F�O�6�9�E����� �I:�d�*����x�RN��+ƾ�S�)31���~����bw��\����ȵ�$F�������9}��w�R^�Ekڑ��g� ����#׭V=�M�A�����<`�q���Q�+�_���Cm�j��8^Zڴ�0L�#)*�x�ɂ@'�] @\�̳f��+���3�4���F�b�Z�բ�I>$���*p=O��Jq*͛��[�o>���3k�R���dФum��S�
��������N0:�������붐���Rg�N�1�A���Ȱ� ��������i!���ܧ��b�i�:Ʊq=����Uя�3I2���N;t��K�X+��%�=�� &��e@$�G����d��� r;�A��� ̦�� �^a�7�`<K2	3댂���~��g�_��A�~"��fKVu��nӏT�9&���m��Hb�e}����c�WB��{���EW��]�'�l/��\ׂ�!�
���ӱ���T�f����ǿ�˕M��y���G�ك=�,ͱ듏�:�;��%��#�8���M��uv+렯�s[TēI��lFT�c$�c�LJ� �.��B� �mY��$�b���g �' ��ԉ8�(
�bRN@�!l���K)�Q�\wh��E7��0�#V�_t.7�F|�۠n��-�
	,����(߸=G|�{��f�;��o%:��E
q���RA�bJp��)�i���F��ٚw�#�U�L����qЁd�#Wܗ����I������?/k�����/��t��Tl�P$NW>�Xߍj*O<e<'���!��l�G������
���^o�
���6ql`�a����;(��=��H� �i�I�%+��^始�n��"������}�r~�����ȁ��6��I��c�K��C��mX��ؼ4e�|�}�#��z� �UL��]��˹�m�&� ��m]��W׬��� ���� �����X�+��$T����Z�O0�Ig�����fǓ}�{��2��e�����MNm�)�^��f� ��|�ف�:�1����e�?�C�˽�:���F �ϸ:_�K�c���� ��+ؒ6��Y?b�	-0q��ď��{���6"�>)�>C�9��H5�B�J�D,\�)\׬��x��%�Gӷ�Zn�,5Y����_τx���Z;;�M,p��������$z����F�pZo����[��˜��N��2�F�c4>a�wZ��í�u�@;e�;�����O�O�.�=���Y�+�"���b�� 0� O�s�a����+l@n/�!��j���G��)Ǿ�O>�׌�u��x��`�ؓ�����S� �m�~.�{����ܞ�� ��ӵZ�$L��I3���o�x��w���%��q`�V�"���>7��W5�7'�1�e�B(J�I"1�1�C���� �x_=�<�Yw�ckJ޾�aFȮч�g%�%�"@콎p~�W81ee��A�e�X��)M��MV�)��Hf�~�0	V�Gq�%C/?yN⦃�n4Uk��uuWY�J�B�IXϋ��Є��$�`�b̶g�-��8��s�,7�B�j�6%��%W1���$���c�OԵ��eu��n"�ٸ���f��N�?��}U�9_�خl:q���K(���s�Iq�=t�7{-��������`�ڴm�5��\�,+��G��G����0H�X'2�m�Ҋo��� ��nLu��OE �Y�M��s�l R I魼�#r[C�j�揘���.��rXU�S��!���/����F���.�U��^�"��c��j�m���e�]Z��E$~0C<�UAN���4��Z�x-N⚾Y7&�;r؍HvP4��R�Y��rR\���~��\�b�"�n�I�kQ�mح��-�
" b�t\g_w}�����M}*�r+3۔�$��i�;�s�rN��Ѹ���3,(�ntL��Ɛ4�p%���=�ٽI�NY��V�_e";��%_�E�کQ #�gͣ'=M�D,0Q�V���62�>/^F�O��*�X����Ȉ��+ݰ�z W�MǕp� �ǖ�ZxS�.U_O�?���JzQXH\A�x͚-o0��~����q��~��Ģ$�KcY������/�,~�}}��6 1� ����Dƪ�I{����_�S�7%����o��?��q�o�����n�2l���!�q�k��>�9��0b�H��~� ��f�(f���{~��vSU>��'�Gb�1��L�>��m]>�Y�j�Z�p`��)���&K��Չ���HY�,KAL{|�i�rM��t`�A
���1A�H^_��.��j�Z\b�m�)�����ߴB��TQĝ����n:��,��"/	m��t��N�@Q��>��=+U6ԍ�M^
�?�X�OC��2ڙ�[�#��,o[�Wo�f��zф�f\� ��~�+%0K�Pȹ���M9)3y4H�!VVs��{q�w����	Q@�駰�l��c-}dsY1S�*���F1��]�^�E��%���+��^���;�n�Qb�ow7.��H+�2,``�2�=s��ɂ�h��7���-n1˶�l��1ݩ^"Lg�����T	齜�K����v���b�kjI6�gZ)�ֱ$0��!�.T7|'�T�utd��  �H��B�z96:[U� �fvX���,���8?Q��$]Qʋ�T���� ����f�_G���A\5�~�Ę>0�p�O�9#�զۜ
�]� M�+�_�/�^7����Vu�oF�ڬS���3L��=	�B>�Uv�%��� 
�	��9jĖ���D�$2Ea����_�~�^��-E��?</�K'�h9umF�a����E/�^�K]��ط`2}z��4d�!������_vjV�C��P=���_"�{�F>�� N�X2����_��ϼ�z�0�f�V�__�Y�|�L��^�>������g�;��q�*�)���M6�tǊ�O�W�2q������ie�o=�6�Ӗ5�\����e�(��}�
�r��g��uр�乒����?��_K�{����l#��2�]��ae��j^A��2��a�����A�|V�$hK|�Z_8����aH͠�Z��+Y�y�Ibf��If�(�o^�7��2�J��ƧE�㏖>?��pi��
��nlU�E('F��PP� e����ʹ�l�D��]�=�����i'�?-�U��Ƣ�m�=����Uejh#��$g�#���נ�v>�L1#ⷻ�u�<NF� ���w"�������$��	�Ur��l
�3��t"����*�C���)�z��/>~F�k��0�l����h,��k�z�=���EDdvh��3(��[lߨ�[E�����磦�
�mmH�f��ʤ�á ��{��-+
�g�R�i��ȒB�,/-e9S�� C�;��E�4�T�3q�#�%��خ�`H���`�$}:�&��^�|[j�K��2�+ȼz��Z�0�\(X�?�Ӯ]��]kX u�Gh6;��z��}eI�w`���goj7.�<jPopn��U\���R#NU��Q�όεjGV+kY���O)rD2�q�z�����m�
�G������ Ï��X����Pg���6�7 �V=�)�l�l�X�
0��fUb�3x�z}z�9�%��o�H�Rs.5{WWs��e�K���p�x��_�V%CF~�c�1.��;��&��A˯iwR��zK���|���t�2�ĐA����� �q�b���\�
��S8/�<@��;c�"I�J"3@��n3T^M^�f-V@d�m6��q�oYlJs��ON�j� �"�3�j6<Z�_�T�l,DlY�x���%�e�탁���k�"�d�8o�^[[.5��_i��8�%B���7��@�4b��4�N��~7E�E"	^�c�`�u,��z�Y3 �.������M_#Ѫ��E�=i�x��bE Op��ψ�.��Dm݈5�����j��������JQ,(o%�nFH���;����j��nz����{q� (� ���?� ����|c�}�o9�yg�wE�e7�U�<�{�����G���*�u����ؕ����B`�r>?B�-���YDs�1�	�pC��3%#2��Gi�'�n(6�a&�L�6'���yVo\���4��*���5ɷV�g&��H�'�ZH c�R/n( �����Cn��!�ϣ��wV9'%����m\u�2ȉ���@����1RNn���|{e^zwc�_�� ���r.0	ʴ����G�:H�����U����ޜz��L#9G�P�Pd� Aѓ�h��:>2֘#㵩Y�Y�x�́���e�I	%@>#�r~�4T���O[�Qd�:�R`*AO�NrH#>�X"��E���@�-:���\$f�D�B#�'ר	����q�em��m�ҷ6�å^��b�<
�z� �>�,�Q���c��-ҋMf5.�a��[QR�hc�̞>2�f/8 ���� ٦��S�_$]�m~�S�q�Sgg?��*�#�1���װ>�a�\A��D}���y&����������h�2E#{c�������l�б��w�;��L53V1�#�Sjj�,�9O�G��#�25f[��
�i���}R8�3�"�� �%��Tb>�#�=[`����}4ZJb���$���}R�,�l]|��p��ۿ���L�	fX�,��&图E��/K�k)Z��r���ƪ�\�@���߿�U_�V�B�f�m�&��@Ы�>��$�� N��[��� ��yo��yN�m
���Ip '9��6��'��~�Gkc�j��[sv���D��5�n���*��F�&���^���ZmKvTJ܆4z� Ux��6��n[>�ao}�i����ua��ҩ���}�Ąz���?+��$X[5-(!�}��U�qCh� �pDq'���������IN�*�#l]_m��ЊL�0�g��N1����.]���]G8t���$��nI-���jgv
3��U����T��S�,Xh�?�MG����twx��֢
�ű���K"��l�UR���~�T�W����lD�Z�V#���٬��wV ,��u�\rW����^!ǯ�mm9&�ԐP�;6@��h��#���]�WZ��
���l�ge[�U�[�޼��e+�;��bA�d`7^ޝ?z��_(��C8͟�7܀���S��O�[zM���װ�W�ůlJL�10 $v�Y�b�������u����%��`kP�_h�6X G�!*�s����d������T��*�3��έ��T�dԩR.�1����Np1����D�B�p�����+�4܋}"�p��t ���p�����s�� NK���T�o������Qے+q6<|��5zw^�~��bH�����1U-�71��R��M�`B���,ۖZ���/�4D�8+��:��,qT��
T-P��-�ɠ����lOLml�.����V
��-�����^�۶"K,�fQ�V�|f�X�Q�!
O䡛���&s!$���+��F�>�GW��qb
� �|�v�:"#E\Z����$��߁� �i��XZ�X5�rQб�������mo�x�A"�2��=���Y.�V_	�U���:}�4�`�A�����Ýil�0�*N_�Бa���J	&��8��.��n�6��ɧ�KS��&���E�����il�}O��L��c���>V�K�n��9�hU���6(�!@Go8P�r@�q��鷍Tw4N�=�F��s)ao���a�{�I�F�c�?J.L��5o��;-��^	�f�f+S�]��X���k���\�}:_r(1/%�a��z�k:�3��U#��ף����G����<d
K�5'�9
�چ-~�u]�9�~ز�s��/,����8�L:�1���kw}�)I��{:ׯV9��v?q�b$_���V��$_rj<S�*6�6{ĂX�n�Fq���+�\t���8��M�xM
�k��p
:���_C���J��t\�E���)k�����h�W|�P��^�= ȃT����n�@�y��r���O�����_�,Ka吔�P�B�N;���włF;�z�Hn��Q��k�SN�5eU�+�)��z�����_^�C.׋�m���	���U��$x�������WZ���\�q�� ��(�q:YN+ȵ�p��n-��G������=���J/"@Mnl���� *ju�Y5Z�*n.nv�h��'a�
�ξAd�	We (o E���c��$֋i
���E
�J�%���Ֆ-�P��U���-��[	^������{U��弗���g��_d�(�?�r�����q�bS�SU�j��$j5~�s�����[6�e���n���̸ͭ�-W"��H���Mt�`|���㬜�7-�b��&���M��^��0"=R$��/:y�*�[��}v�^�r'j3�R���2��L$Nc*�P�Q����@3�ΙbOU�����|oNo���k���������óc#�܉z���>�V�[�4VKi�pW���}7a�OUj��0�~)�E��6�#*^m�b�}�L�9f��u�!�-ڌ�(໮M��fi8�:S>����vu�����]#*H��=������}�����ǖ�T<n����L=��N]%Wb�y*}z��}J�@&,��9�����O�=E6�NijZ�(��$sw'U����-���Ia~zV�%Q5}��z��T�lH0Zds��\~ΰ��2�lz�I�܂c���4P�SYp1��yN=�sh�1[�>T�+W���O���D7�jT�0��?*2�{wu�>��O�rZ!y�Il=�X��䛽��)��DVVU/8��.��,�P ��Ƨ_f)V̻飙Z)#���eq�R��� N.������?�=V��!�����W�\v���1��1̊�=Xz鎴ڸw1z��,��>!�w�a���OģF�����%坤��l�� zu�h�e mV��:��O���!�^��{�Ō�y��z�O�� ��}RM}I���{/�׈ч������S��#=q��%'�8�>cz(��X)ɩ�2S��s;2��?��H�:y�[�j�9�|gX����D}�D�)#6>���}zCl2���<��ȃ;�d�0½��J�>AQ۷�Y@�HegoLw�Cw(�>�K���ɪ�i�C"F�Uc-��!�zIa�$�L���xL*���	cY|�k��ydl7o����"5G�o��^�cSU��v%�_�����yF<I�� N�`*T%s]�$��u4�<?�M�m��/X�
�:����
��k�#�z�;���'�5Y��R�� #w�~E�5�$Z����y6UN;���ޘqȐ�<{�����(Q�׉��-4q))�}�-JI���C�IA��i�+fT�ܐݽ3Y�b��]�88x_��a�ޝ�2���˸�kM��m%���E��-Ǔݢ��Br���1�;~ރ!`��tԶ�}~�����;Q�il��>����=:S�m�� �x��Y�cKy�WA��evo�>�}	�@�S1.J?�}����%����f3�� h{��,}3��c�E��3\���qN;n��}W[S�k+qZ)eE, a�7o�=$��ɨ1M�#�Kbη�q(l�F+2ӭ����$.Goצ���F��1��� L���ߏ��WϏ�3��أH׾>��-RM��<�J��뱫J�}uq���eJ�G�̐;�~�)%Cu�:��ζ�Ȓ6<�ó�c�I��d��+�RZ����2�[��v������"��k{�̣�8 	F@����M����iM���w1��ޞ��g�����~�N��#���~8��DVF���.ڭFY�[s�4��� ̴=��:�b:&�@M48��ZX<��q
����\4������6��*L'�x���ָ5z�6X��?���v �����E��>-���j�6|fZk��+�k���d�Z�P����b:,(�L=Jb���+4{mt���-	p���x?����dbغo^W�)Ób��j&*н/�s���'�U"Q�E[���~������X��:�,Do3����|Xv��{�a��W	2!S�,�W]��Xv
g��,�FH��}z�r,�[���Y�>�Z��?�x(F���Ư�B3�=:�ʹ(r>�����q�QIxW�%�D���c�Nߨ=�F7d	%l�� 7�g�ec��&��>v"�m�7gv/?���4�o�C��ۮ���@��E�4H2��V��l�."������-~Fx�]�D
G��|秮�d�i�.��r3ö��ކ�e�F�'��X�T�-���8��;}��k��]�����u�m|W���>�1��s�4�J�w�q�x��˳0Ps����Q�H�sZ��V��z��7�����%YkN$�CaϽb�*d�� ���q�B�r�B�t��Q�2�2F��ku��r ������Ag2jd���l���k����]�rjPG4�A�#Y��1	���l�=c�¡l����Iu�׳D5�Mg򭈊-�<Ta�-��R:�]V��g*����rRK�쥭��K�ؔ���������r�?�Êi*��
�y�|vx�˭,�$��c�>�ת9@0O�>�U/�4�k[�f��:�����l�N�#{uk�1���Dd�r[���z��� m-��e�_��U� ��n5
ܷnHiϝ^�f6U�IFr�v���9�Z�ƞ��噗����DI*?���%�q���$�W�^��/�ĸ�߂��%7J���7��h��3/|w �ʺ*�n^����*��[����i�(젞d�rD�	+9򎬙�S����}X*9%�����g����4�j��a%k�m�E`0]R�bG_N��YD����M�/�l��񡰽��>��-���2�`|�,�_N��?�:�l��Z?ʢ�7WB�ޫ��v54��zx"�� ���b2<����pG^��d�q�_�g����h\���q˲A���Y�4j��O=ݓ�2�
�j��(�2Sᒼ��F�6���1�ǿ׷P�]�A�r~y��,0��^QZy,����
���t gרB#@�nu�}H���8��--��h���%�'$s�NA4*U���^�
S,�H|q��eU�>'��(t��kϗŶ��kwƁzor�_`��p���3��~ޘ�N�׏��T'������'Zt<� �y�Խ�;�d��Bt��٫�d�|�8���k���,x�# 1��OCe�n�sʴ�S��b�)�ْ�5%�.Ł+� 0���H�;t#�C �e~6�OVo�yMɄa����{�d�aG����gPk|c�'�� ��G)���[����Af���M 2LCc�m��.؎'��;�"fv��6wf$�ޕ[�Le�<}���?����� ��^>��� ��z�~�[�:�/5b�7��8�Nw��,N��bon�̞�1ܖ�t� ��bjΟ����	yg(���k�	V�G��1��"#Ft&o���EI��mZ"�^�[+�I���:������|n�#�P�ГcN�u��W�]��ȅ�o��9�����$���W����Q8Λ>,^� ��)�q��Vq�	���������B��j��U��M�(��������ֲw^'Ni��\LP����q��C��h� ��\��P�z�w�F���؊Z�=����8��,�����g�:Zp֫Oy���m�[Sѩ�2��FX� �9=� C�m��`�ګc߇{u�Q�����__#���ɷP�r�_���m��l�xh�>>�#�~�4H� &) ��ߚU�R�<�c��Q&�c/�������Y��� ���;�{�N�WW�p���� sի��l�]u_/��<���=GT��E
�kw���0V���+K�����/8�+,�!o��r'��������,�i�[ �xh�{�z�U�kϜj��c��u�3뢨m�Z
��]�(¹�BW��[,H��b�,�+�*�����K31�Y�P�⤼M߭ Ȭ� b��-����{�����؍�jЪV����x�1��=d�Ї[8�[y4�F �d�����]�yc>$���u�D-^+��斵���cw����ؐ@�^t��<<�Q\�S���A���y�٪����B��ݒ�U�om��$�=�z��(���S�\�?_��]�㶤jqձcc���J�� ����I`��ʻ�9��O��\�yu����ATU�|?��� ��>�!����gд/Yk� ڦ�.+Jz�9)��
J=�����9��n�oX
����j+���^�P�&�D�4`e�����z�|��WN�6��j�+�bR�Z0�bB�O�(�� ��-���<��<ϒ�/CȠ�_j�O�6�R��-v�=��}�gX�/Qu�?^����?���v�EpY����A@@���Y�R�`�U�o��Ӟ���ٖ�	}�P���ȗ)�g=T
��^sM-��ۉr�sӕ�{�	�`��Ied��:�	�\��[���;v��b�z�8�i�
?�������m�UсaEY� �����z��+��ma���)H��P�2������GM%W <h�>��^������ix��e:�P�A�lg���r�Ȗ[s�v\���v"�G��Ȝr���A��
����x����S�:�8�ح����2�
-�����64Pӱ��Zĕj[wh���ieA�(�׭�,(�E��]E0�Z��x@�G����k��V�� ����-�S�4���/��H�"�vrG� ���ힴ���F�je*;�\�쓘l�6?$MR�z��>]�K0W8#׷[v�B�ȱw�މ�G��uso���χO4�I���Vh���###�a0i�N�FfP|ֆk�ji���nrK^1[+dM"��a�3����rX �f֧Gy$�+l� 9��_�D��Y3?��q���Ȁ<���|�ۣm���r�§��� �P�\��o�ږ�P��u�\[��
�Y䝙�����>�@�-��%�Mv�95�8��0Wu��� %���c���}3�u\�y�D��'����BNpG��� +h�(_��S#�8
d�׬|��x-\HЭ����:忨o}�"'��8,숣��5[]y���r6�b_}�fIv6J���;���î��z�K�V���OCC�o�5�ƽ��H�M,��p�i��������;����������]$�0�O[0��f��!1�^�3)�N;}�}z��}g�^emO���$E�z�'����V��X�ǆ=__�YnDoZl������i��W�G$)�/�SR�ʆ8\筓���eTA�u~�Cc�޷^�[I�Ú�2���8�1!I�ݿgX%�.FkD&$L�@N-�M��%�P=J����=!:k���|󘲍�ɢ���b�F� >o�'Џ�uф��u�ʥ_� �t7� ���\��׊����z��'���"��� '��Y/�+8���a��
�,u6��U�1�~��2����'�ؓY��\�`�bI��-h���+�{6"S�:�{�x�s�^�p��Z�<~�+��i� ��r��X�$�
�ާ�[`	-|��w���ߡ��F����k�:�o!_1��ݔ����#�n�IѹcE�^=�G(��u�%*��(ɷ�lV����)M����'��=\g�9�y�������p�nF�Is�|AU.ښ˪��R����ea�H�I{zu��l  	-�s��.�2 |� �Zo��^�I����}���ڷ,�3HQ$F#8R;���r�Lj�^��.�mH�����S�9lU�с �F��{ۮQ�����U�� e�%
	oyB��M�sN`��K0�e/i�W^�L�[b�I~ؐ���3׋c���D�5��J����c@&,r~�u��%��ȫ�a��q����F�m,�C^�
��Z)�_m|�k3f�� u��d��у-3��E���g�ϲ�u�=�}��$� b �����\dN%b�F!D�����r�k�^I����� �1�_�NA� 'Ƿ5|����"�r
ھ3�].�mŻ��!�
��!tg���Ol =z�.��+����=������<+n`���Wt�H�  /�G��@'��wy�9 ���{�9q�x�\�o����)e�G�/�Y���Ps�9��h�r���n�l��+�-�/��즎��-rMn��t�U2�b��FLk���?S�<wrtG&��ej����z�
o�c����l��\�$}:չ���,���;��4�AY����{=6c�������dvS�r؎��xR���� SX䐳��  o �?~� ^��e�-T� #4�_�j�� V��1ي8�p���F��=z��,:�\�z�IT�܁�a���>�	V+��H������R�[��C&��&����:�ޅ�ϲ�r(�,�2�^�*�!(��%�R�`�v�Ɂ �$���YY�6�M���$�dH?UO�u[YU�� �8F���� �j��)Zk�ךof��?�
�@8�@�&T��(W�_�[$��&0�U�����b��x#*��1ic�v'��$�P�D�|���E�9W0�?�ؒ�ל[�*ڝ�~�U+y�zЯ���q�l��P	�6������?흏��}�4��j��j4H�A	�ʌ����c9g�W>�B�d
��/�NO��б����*5!k3͉J�PI��vA\���M'�&ܒm��4ܓ�_��,u.�-{33@��!Ǆh���%G����Fx�mw�_7�J~'y�4�G�v�Mj������a	��(݈p�� �=���j�h�t+����������]�Z�ej�"���?��e�����\u@�&��] /+�����u��ˊrV-��<�Zѵ��Zy���@-��#
;�[�I�`�m��2�~/���[G�[�&�NUn�׭�A�sN���
�ż|[�'���<����Cv������HF�;��Ց� ��W�2�����o8���׍��ͣ<�H#r��k��I�e��#�=y�k�d���-�t¥���w��x�؄���q��<�?O�حg�<;CE�׷M�]�H���X���͟�^�Y���ˋ�k� ��+���.��
Q�A����M�>�L����[+����wL�j�2���k	L.~�JC�����j��y��sk562�nCǦ�����G\����Vuf�`H���WF�<��u�v��6�/��� .�	m։e���^�D��ޜAVM	M0p��@� '�7�K;��� �`�/\w�ѩ������X���R�4�	&�0�-�f����''��6ђ^�|lj8���E��4>u�{�ĎB��� Z���q���N�E�GҞ5�GKoSY�����Ү�`�Kf�vE���ɜ6H�t�� �)�q+6��҈�2Zf��2{���3���C�8'��P�0	n}_�k�[��ⵣ�^v�Ԡ���8�&2���1WT�E´�g^v�.)^���Z��HZ�Lyy�(���oۏ��0J��?��6�}�i��%ue�A�s�Glt_��2e����|��c�c4@���p�s����9ʴu�;�^�~.�`�+�
x�9C#��i(�h�V��`��uV�@�l�G��'�dئ��	�I��l�<[��sJ=JOr����#-#N��U.[ ��M� ʯV*��%��j�^o����t�%mˎ��%lI)Uw��vνu���)�N�?i%d⬱;0 �8���bG�`�U�w�KN+:�� ��ga9_�u@V*_p`{��z��)������LӖ��Y��ą�RFQ2~߰�A� �ߡ#��M��X-o>E�o4�i6<[�-�ޭ���E��#Mf,d� ('?��5)���?�����Z��纤��Ofh���D��y.��S�����9�2t=8�(կ���Պ��ةcUY�U#²�l��׿V9w)H�~�� xk�vo� {9�<b�UR5$�0Y�?l�z�\�_2��u;���s����~CC
��f�w$�h��$��t{�Vv�PAv�G^
nWܺV���g� w�u��v�b��%'̵5��m�F̥��Ų\��N����ַ�-[�5���� qd��i�
<  ��v$g��@�DԺ�s����\�uk��w�u�z���~�(nR��� g5k���i��ҵv�B�* ��z%r�K�'p�c�V���)-��{�%8hB�[����I�)���<�@�Q:��a�,� �m
zQ�M�~t��#�鵑��g!���|<�����鎩�b5te~Y$~Y��sy�þ�%���k�`��VS��_/���'�=��6��R���)�,i�_�4��KfM�v��s$5�3��,��Q����׫@�S2�+������N��u��t�
�UU<��(���$�����;�(�j�g��nsI*u,%�J����#n `�:��_:�Ò��Ԟ*TE���]��"�"��"�Cvs㜌�ޝ
$��ж��U^�UQ��~���8(�G�ע�t� ���kֿ�-#����҉T��D_m����;�X�3/FK�Ç�~ucF�>C���sb�}q�k�K��+���,�2 z!�d� ⎭u�'��?�y$�����}!=�NOGj-,@���/&����~C�Q�Sb:�6�[�W��<�
}O@� 2-��� ���RF,���ҽK$<V��1$D���C�FG�z����ȩ�՛"���%XP-��1�ש� \��
����  �rwA������@�>��]v�+����*F+ܲ<���"O�{w�B�F�U�R�'�V��w]O�y٫�kcY�����q�� ?N��i�� j�X�_��&�g��1VV�f�X�Ϡ {v��3�.�����gm�����	r�)E�s�Ʋ�BA�w�:>�D���ass��7�������z5� *�
H�j�\����S���>�s���
�B�����t�,���?��g� 1.���1�7Y�_����:����]��?Q6ۉ��O�6�Z�KE ���`�z����Y0��UZc���������g�<z�5�G���->�tC�:N2�?"���Ѻ@��AÀ���Nڪ��E�� @��Uh� I`��\¨#�E,�	bs���b�R�X���i� -C�]B�ݗ ��~��G������Nx��R����4է� >�H}0}z�@P�Ex�!��Z�a��x�UT�X)�,0��.>�۠Bh�4LI����2�ٱ(e_*������'ש��w�K;�+�}��]��Z���2jJ����)��N
~��F'"���.&s]�6�~Y#����~�Ϗ��Q�1A����l�}�QR�G2�%x�~�)7s�����VM��(���nts����Չ��_t<�f�3�����~�.@��.�}�u}��︋��$�aQ<QT�6��c���d�iJ���#���A6�S�����dOn�2<��������GD�nK��6����i��D�Y匄����Yϯ���B����7ܳY���C�e���CB��Dc��'|��רQ��=�<�:��;ٙ��%E� }�i��?\�=L����9ť�ڻ�NC�g�H�]��WxL��Fl�6. �=���T!
ܭ��j3���y.�VhL5Я�\DXI�+\zd����B�3A7z�E�F��}�j����]x`ހ�X��˫Y���.�+k#�Ss�`��D�E5`Y��f��BGs�"�R�\{t9W�C�9�W���{q~��'H�
"�maU,�;��}:R�+$��CH�OZ���f�d�]��ܤ�!e^���FE�.�p�&�+�4lN)	0��\>�J�� >�t% �4���CǇ3�jkS��M^���ifH�B�Q�y<��*���C<l>E�8���Z��h��Q,=hK���-"�oO��ۘN-����r���V�Fd��9ǎpר̔���'�����؎=T�4�;,
��JN )���?^�̀&5M�.��I��b��䥶[��
c��� -N{��j���Y��?m?�Y��S	c�ʲ殊�� Gӡ"��&o��v�Iz�'�W�����`X��QAx�L|�2N0U�J� �� � >W9��<��#'$,ps��Q��b�����n,]H����K�����]`e#���7`��W���q�����w;��*�����D���UX�ܒ÷DH%�P�S�-w
汬0�xҖ�� E��( /lv�;%����s�?�*��S1�*ֶ�
�βF$V��@�rU�k��VnH%�@��r
,qh)�����!�e�`��`�ϯK�Y(��T��G� ;�3����l�$g��Q܎�% <���ݭ
�$�;ɷ��ݻc�y�muū�ce�����XQ�ǒ�x�?�=Q>0߼�S3���[o�sg�	��C�tR���Zx�=n�MzM�m,of�;y�1�=h�2�	 G�8�lKR_��[��J���ݼ:tV"��q�"aW��F��{Ď�p�H�/ I!AǠ���e�W	���K�MZ]��wֈě
�X��(�C�����:&,��mG��J�ےi䆳%��GFy���Y�{����F�hC:U�ҏ�yj�����6	��lq���4"I8�6�k�F�?.�:�Qy*�+��i�tOm������1�랈D�Ԩ�-N�gZ*�9�����#�Y��1���f���	?�ш!%u�G���OYT�>V#3xI=A�����Sړ����� J�tI�+�7�zM%.k�$��2�~ɚ�&5��J
K9=���צ1K��UX�||�ad�˹��D<�2���eb�Ӫ��a��[?q97 ��iR���p�0<�X_&!@���@�tF	;���?��ܥ�}��w|�l��v�����tP���I����FC2��Cg��ǜ&��56x~�[�O�i^��|��e;�b�׮w���۹m� ��۶��_��1��[�����(5����R�ZR�������C�]g6~��"�������+]�R(m�f�Ƞ�:I����:�!�^/�t�CGN2)h+<��%`�q��N;�n��� ��:�	�ǐ'�<ԣ#��`O�t��Pج���G�-�{}2O$n�Aj�rT�$���2"AЈ���J�w9�1K�k$P<<����<
[�>4���F�Y�]^*��RC� �#��G�����%eW�7�%Y���K�<��	X 
���5��6]�vU�W��2��ߛ��7�{@�r{�!0��~M����k|k��Un4��RH ��M�h�M�	���><�Ta�-*�� ��{ќ�����-5�E��j�����֒Gm��dB_%PU^|�	'׷O�C�*���h��js�X��ϑ	�)�w&�.u�����[���F�N�GR��?9dG(ʢ*�Q���ݪP���N���[�����X�]�H� B
��\�O^��	��V~/�>A��{_���㜧aQdrA=�+��IJ#�a��#,@���w����/.����|����oe� ���|=?nz.R�.ʦ�|���q�~���Z�ʨ�F(d *����K$�� O�����~/����q�v���蔀�B�T<F�S�%Z7۶=~�&N��M�ѷ*�nQM�+ҋ�lP�#1ܰ�=z�&�(��?�,Z�5��A(�,p>���D:�P,�߂�����{,�J�d�@�?��i�SV9o�L�kni����uڍ�S�Z������<5�� �����]�Y�	5�{�V�L>C��w���ݸ`��F�`Jz�ru�W���}�j�!1! ����`rFz�渒 J���q��4�٩Ƕ�\����ߎa��ۧfIU��G���c-�;�7�F�q���-��eЇp#�>.R�e� � R{�m�Ϭ��3f���Fzm+����pB�vdu��\�H�{;�B��㿑b	
{>a�?�
�ױ3�O�bR�����&I��MiF�*l��5ƙ���ao.�A0dt�����ӊ�P�%�X��u��4�����3�� ⁏��R�����cu�+,M��3�rdǧ�$��� ^� �Z�V�a�x�Z��*V�g�0�
��+�>l�Қ5S��O�T�ŭ�L�ܱ"��	���?�z,���S��q��Kj�<z*�Pʒ�+G�� i����=(�hgR�[#$���O��W��i�X��i�P��J�P������ƚ%�8��6����5Z���4�$�$�U2|�I���)�d���hUPqk]���{�>�TF�o��dF4HZK�����
�Ќ�������b}o &?ڜ�[�y�����r�g�=!��/�@�v��Uɚ-�ͮ��� $H��~�`��� ��UJ/T����	a�gQ��-dv��*I`����=�nN:)�<�gs�1������~R��2=����g�F�l5�
����ɀ9�����.TfJ�%ֽ������N��H�e��@Y%\ ���t*l���%��ܢ��y�� �RA��{^��N&h���I'��Zx��f�ߺ�(u�� L�ΔU1�U�Q��5���C�}��e-ټ/@�T�؋�����:b\�b��囻�I�3��^LֳojQ Q��NC�}1��
$�������kjˠx�h��kj����=���({��]����⒄qKbY�R�d����_Sۦ!L��]������m�V���d�X�LG��Ҹ#��B$Qd�{a�K|�� �3k�Վ@@��q ��0:�S��Q�<wf��*�J�IQ�Xj�]due���� gU��R��9$��w����V��!�'��'u�����CQTLN�6Ξ���af�o7�P�ښ
�~AE�T����g�8�.�e%!��:gQ^B���R�.�N��z,�
�sR��T�c�����[�$���C"+���"Oo�P��H�2�7Wn����޻@�GU�rA�	�G�� *ܡ�o[c�.���f��
���B�#��Д'���_%��0���G���t�)|oN�%��z>s�\j9TS�'[n��}�oe�LV�O2�>�N���y�T9��wNm\��p[_��%��C�W��Õ�b��2hG�~㜑��D�����{�q�t����T��9|ռ�:��*�~�9#�F;]�R�V��W�->'U{/$U��2Y�g=�oV@�CA�I?ֆ�.�B�%H��>�@�EXH���;�{<��щS�,�@��K8��U=^�O�]�חq�%���2X���I!?�>_j�;~Ό��)ILv9��<E�׺˙b��ͲIǌD��3�&��nm��g�U��R�_Gg;,�g2���k"� �c�A�Q�RRt	�{�܎-�,�Kn�j����%Zi`=�p��c�;� e\[_*�i(��k�+0������`�8-�?�z�(���W�w�t6�;P�!Jk��Y����#�,�W�gר����������4tx$�]�;�f�u�,��"�3t$�,��颫���C��ۑ8�.^;75���p�ņ�s߷K\�g9;�˖� T�� ���?#���:�������������l��Gd=Ã$���Wa5-��hj�n<��5�dH�8v�V�l��կJ$�\�J�GL��v%>����Q��U~ߦ3�F�F'5-�C�����8$�� �9�
x��z �R�Z�\k��
:�ѝ�>"I?4@��g��{�_���0dY`�B��]�K⍞?���4�]$��bB9
�����JNGn�֖��C\���>^���Kğ5-���,��ʹC�1�:�U�=�2�A���䑟Z}f��H���Rª��\O�����s��1�x$M�W.�UK�r�u85�nՁb7�gv
��`P� I$~���$�;��4?	��I�ͅ?���K�a;����r��t��������v���k�����'������� B@gT�����o�굶#:�VT�(�^l�>}٘�9�����!w+���cj�&��,[�s�_03�tDR�t]v���V���X����aԕF$���҈�fC!�nQ������/V�틚���S �bT��=s�J!�H�3�G� �J�-����+$~'ۖ�#�x޸����MNaƪM����[��%��T�e{��I���JU�{g��9o�������݋�O�N�#7�dȱɞɀ3��gHfF��1_�?��o{����	={`�W$���2 U4�Z�7�g���ĎO������4� BR	�C v�������?���U�i���7�`9
��g�LHU��/���!6�\O�U���-�M�2L���� ��p"�v{)�I���S���	��y'ѱ%��G��cf��w[5wS��_�V��\�Y���{RG7�f����H�|\}�=ZK��及#����!�-�#��h�L��!oA�"2�d���(�D��y��w��o�⓽)"���G�3�3�AP{�	� N�PH��j����W_����lZ�ٙ�l/��1
b@���aD�m�n��ڴ�2�3$v.<�r�8�D_#���P�z�����GkQ�RgU��V� ��\"��{�]dγk��2K;
���n�Tw��t�R�WM����R՟�M,�Z��⮥�b�-�}�c��8�H(NJ���ق�Y�f�� [RGO[��BIf\�;u�!�Qׅ�[���xfD�XR�RrU��'�w� ^��̤@v�`���p	��˹��)�
�X�z�u��ÈY�6��0^9܏G��A��f�Rlm��R`R-��z��@�
���~�[^�.� �~4�\����]���ĒN��[��_�YU@����S�8�*�Ӂhh� ��I(�������$z㢈���<+IoS�zT'����pA����E��%]I?�H�]Ȅ@j8�S���8�t��3Mn(lJp�I&�v=�X�zH�9Gh�M��E*�M(#�5�QQW���p�JN0����f7ѐ�%��������c�VM����/Z	���w�G��\���Rr���76�+��|n���Z彶r�Dw����
�δ���5Sq�d�vZ�=��U�:���#�e�C���.~�.��5*�
eh�k���_ga����ʀ��?N��V�R�������7:�=^�]�a��>܌����ʜ`���=Vd��\o*��QW������籹>*����t\��q��D�$�,�g�������BI-���� �Bk����)% dB����s��Vnmu���yo��;�LՋ#������ dV]�>C��[�Z��(MȌS�U�.<H�>�c=�oN�b��ᒴ�|���b��8L�d��&�Qy�� *C���=O�s��r@4]x���2�[�s)�RqZ��%Ī�3^lc=�{�*�:�8�{�2��ȿ.Xr`��k@%b��̋4�A�'s����,J��e��^�/Fw>�W��.� ����g�����q>S���=�
�weGY���mۭ��scKM���IA��������+�7$�w�J�_c��F؝��*��Z��I� �G?��
��y��O��"$
�*-]*z��;���
��',W׷a��QF�K�{���hԚ]E;�jZº�xTĲ�t��3��?Sӂ�I����A��ϩ�0b�}��Y?gn�pFR�
� )q��?k�j,��5hE{�P]	
�# �=��^ޞ���e�34�n�M�
����GQ�������( �6���n�f�q��M��Tc�+��8�<���H,�̓�J���lhT���D3ۅ'�^��G䡊X��3鞪���Wo��z�^Q���'��'>�ġU#)h�$�Oצ�NH���|��em_*�M<�)�����p����l�����郤�9b���rKj!���)ZI)i�/��y1� Bb��=W�N���_�/e��35Za݈���{�};~Ζr.�F�sw���Mm/!�Z;s��~�U̪����
��߹P���N�3A�p��e�^�O���X�,~�1WSߨ4R@��O���P˿�r�D%-$y�yČ�����])+������/�7(J����u봙f�+���ƪ�o���uY�
�#�Y�6pw~���b���F�i���49~�9./NƦi`��_�1�����$v�I'$@ :+RM�Ti?��5��.�����13l_g�ȑ5L_�}G��ߧ���O�l�9���o�-���!H��_��G_���7_5�ll�� >2'��~ܭ��f�e�:����~���X�>�������	�R2F͵�E���g�[���{�ս��~@�:��.�m,����c�vz��V�*�yc�YW�>
��z��% ��5��SJ�e�h(O#�-h��|��*	#��@	�Fh-]��p������3[ҽ�+'��$�\�}q�~�C�$�Eb�Z��=�y�&�gkp �Y�����z���sU��Ț�T�̜�]�[(kބ�>8�VW��>���A:ԅ�����?�}�������ϖ||���trek�]�<�Ӵ�M���M����e#��	vX�����)4Sp�v�����mo���+Z�5�,P���@�� 6����0S;�g�:�}N�7��4;ƭ7$���$2H���*���*��� �μ�b<�z� �+2m�IzSL�{?�Ok��<�}'�t1��U�/\4Og�q�V�5�������_35�T>F}}:��x� 0P,һ.�]��iv�Ճ[%$���%h�q����O�p0c��Te%R���;:�܌"3�'�p���Y������jW�}�$MK��m�JH��R�#��������uY'$��������K<�
�+���M�C��F�E��i��Yrȳ&cQ4�(����8��ǡ���n+�!�Tj��I'-'��?�U�Ҩ���ih�J�sQ�����mU��ơ�¡pJ�I8� �#4a��X�_k�v�U����Hɍ���}�?��  ��Ǣ.רDez<��$���Ѩ�Q\eYJ+��A褩D�wu�6R՞K�g�Z� �-���OeE&B����Վ�(��{ơ�����7��uSنy�Or'�c*��� ��@��ά�Nm����o�x�R9�e`������Ұ�<YH����#;쉙_ێ�I$�8�B7�=:��Aл�����T�����׻b����8��s�J����>��P��A�'Xy�I�-W��D�lW����5ps۪�6
�·��:]�[�U��V#�q�Z)���F|]���?�����������::��
>���w�z��{�V���]��Z=�fH�y'3�?�#�r�%7��δ�V�ִ�9%�<�<�P�GOG�3�:�FJnp�C��P��8�d+����ݒ� q�Z/�q�P��Z�51���-���J�~]{v,3��U!�9Prqߧ%�}�L�4�IB��Td�j�S����+���LD`�=�l��˧ �+��}֣�-n?~��5~?�/�oz
��}��-3�ц�`Q�ݒT��~���� �0�5 �V_T��-��n�=�� �2�'�u�_?pķ�U
�����3M�#�Q�i�7���݋Z),Mfe_y�MJw�#͉�}���cbз?���N�w�r�ɝ��`?~�>!�ӵ�o{���mq.�kȒI�c*T�>��_���u���ݾ+���n�6Ù�V�=�R�j�|����R��qy�Z��l���{3��Ng<H<�ʿb$랄���W-�4�`Y�w�n���w$x{�M��p0Ypq�%�Q�s^P���P̳f���2�30���)�"�?�~���
b԰W��Ҫ�����`����?N�ꁩ��	���Im�%��̯�81�i�� ���iF?ilI#���tE!�k.Ns���FgI�'�c�n*��LÎVzb��+��$o$P����F#���ߧ���j��o�������YN'��/����$�%�8�1'q�qt����%^=���n�E\Մ�x���?�||]X`�zq�sKv�`�Y�K��U�G����AL���C����=�zQ
����^X�5c�d����0��<C�H� \�%��V���
�oRz�R����ka�v�m��3Cu-R#�I�>��שΤ˂��I��A`�yAR�*S9��.�b��F+�t��m}�ɱ;~/��1%�#�*	'�v�^�F��)�͠�m��[��Quo�>��H�%sT�,S����Bqe%,*�4zJ�f�l�F%��J+� X�g���'
�z�\F����,K�W��F��~��Q��^���`�nKB�$��ɭE5)暋ۼ�dTo"b�-����D;)q��t� v�O�B��쐱#��Ei���q��e6r.=�I�I4���yB�Os۾, 1��:vGjNޙ�G$֞[���8v6I0ٱ7��(�ٿ��b3��E� �����������K?R����%�N"�[Q�f�'��q�����4>,;�?��G���
�|4�K���q�,�K8���������0�������#U-�� ��݇��ĸr����'�r�?��Y��U�������9�n�dFH�
�:^!I$�\s(y��<�z0��NU}RĈ���H($Y����b�:��Ac�/#$�}gA�)���"iwgd�'�1F���F�fg��=�0$��k��jS]K�f�i�Z�dpu�T����$7:�ƌ�6�M��,���!V�7�!���	`�r{߫H]A�4�B�z[��b�Q��q��ǧ׿@�1����m�K~�qilǲ~��U8T�9e_�=���F1̬�����K��٤�Di�_m�Rʸ
$��N}0נ
X�o�F���޷�m)S��m���ܔVi��h�ѭ�U�/������*6�e' �4������w�o�Zŝj�������"�����ΚX"k'��yvu��`�ھ?^�G
2L���Õj�W�d�j��]c^���O4�_�b���� n��{��Lc�% ��f���i��oY��z��v�+v$=�\}�����u"*�
f�I��+Rޱ�,Eq��J�Id�8)�h�)�s�$�=3�2�P$̻���S�Y൧�c=č,����![���#=Ȉ���;;=[�sJ�Mj:#�;D���!�i"#�,��N��]v�9�O�l��]�K{E��$g"B�ط�z,�(�����t�ģ��C+��b(��S����J΀	$%�{��]ʂ%�m���Z���I���Bk�k�4V��i0�7��@l�lA�$��DU�e�4e�أc���S��m��R6) �p�Ld��n�qz#(�j%��MQ��y�&H*(���P��P�Wz�Y���r
�J�?��KK}���t/��a��Ԙ�������R[�Ef���ӻ�TY˦r;*.s��*��:K�K=A����6��o����=��3���Sd<[�jM�^�(7'�p,���,����N����Q�t���5l��MZE�h]�,�T:/z�$���nCs���o�`֤|g��lI�Ilǵ�<�{0�Z"]@
�W�F^��QR�ͪ��g�a��7J�������`L`���E�pm=��\���s7�MG�:���`s��� ��fz湷Gy��ף��m�����ў$FGF�5���0�	e���/TD��;���e�W( ��{+�D��L�w%�0���8�~˧�J��O�Y �cUfg��*��w�꩓�����5�w��UǦ��ܹ��o�e}E�J�Y��Y'�C�`��5BNC.?��J��j��̱���&l��YC3��=0��"	,�OR�:�8�O����Z����粎��DȄ/k��Q����жm̲_��"��;�1�5�@�~Ε�B�7�q�j|u�ԉ/����#�i��[�%���Ӥpը?�<�g8� ��#'�}˸��؟&��n�L�����'w�Fͺ�dԒ����#�k�������G^��]��rIY3�M⤌���2;�ο:�	����� �uiT|��w�,\��Bt�='�4?������[n+�,I
�>5x"��aPJ��q��W#� ����r�@�,Sqn$SN4���n������fah'�w=�!�X��I+��j���Y��-��0C�I�z�ʧ�h8��y�8��S��-��F{�P�4H��)�����v���P�$�g� �o�� �?�u���~G��?���^^� �����m��غ����9^�]����0�ɫ{h�]�@�#B������v�zy]
��U�f��OBTdw}*\��O��>��qzu�0�Gzi$$1 T �.?N�,d�� �ɕ�<�1x8BF�'����o���zD�e}�$+j�^;hT��=���vi� �!� ����� �Ir�v'
U�x{�g���RLS�)-���uI�H�ԝe�MmH<�l�?��x����bԯ�:)ʰ @�Q�.[�|�	��MRB��WGd�����1�؎��v����,�뾻G��J��<Ϊ4��t]v��<�yd��l��z}:S��~I�|MK{*�6� �z�(�J�/q�gT�B�	� �o6FuA��c�J�(\�G���Z�0�߉��s�~��L�9a�C� ?�Mn-℅��C�k��Z�wS��AG^� Oũ�>r8�'�{c�u6���9��B{�=���{�u��+�h\/n�G>Jͬ�$����X����gn�&�j�*b�±5$8>��:".
��G�z���y��Q(2�6�þF�W\g�/��0�пF�M~�Y�����{��V����*<�=�O����.������ɺ�e����l}�}��b}:V��-\Q;��5jS��W�%��e�z�����0�����S���
Ezx�Z�D¢* �T,��tf
�P� �5v��f�T�[�f���o~F��E��J�;�Qۤ$�����[����.�ĸ�����P�FS����SE�'ę�Ix���ئ�2O|$�dc�$�Ǹ��q��x��'�3T��}7_l*��yE��{z�`�H1d笽��I�C��V*��k��IRL�
��j� vϯ������/+�I��kr�M�-��lJ >�x��8K����9��8kK����eV�y�Ҭ׍Wĩ����_ӥ$:y\�#�+m�K.�֛}ƬtR��"@e����g,��Hc��@��
���ձ8$K� !�5���ۻ��u�X�c�\�P,���V;7јӣ� T����ӟ����ۃ\����|�{&�U>�O�ѹJ��"�12MlV0~�V�ǡ�Dx�=+���>��ᖉs�������#��� k/5�D����
4�{I�G��ǌY����}UX�s�K��ZŲ� 7�'�po�9�)����W�-z��ٞ�� S{JK��QQ%?n1�ׂ� %v�s;3�o�b�
���M|f��*�h�N�mN�|��
��������T]��/�Al-�5��NI��r��)_kKV�-���h�����9�Zj(���r=	,�4+=XW�w�E��T{����NN1�Ӡc��.]K��n�osc�d������#�����8�t�$d��'������^{�d�^�ѫdT��"���A�c%�%�#�ջ�J�g�����ȼ�p?�+C�Xؓ�sH�~�z�
�c���%�n�;|ۙo���75֧2֧옜x����+Blw���)�ѩ�� �S�Y����j����m���' �Vd�����,p~�B!��ࣾ�QƗ��d�kB� �G�5J@L�u�޾/��RӞB����y�)���;NpO���A9��p.9����;��A������;}�@�� wU�Y�,��!�C���omb	%��^�$���#����g9�n�fD2�� ���� k�� />?����� ��Ӫ��`�/��"ynl+�ED/"fw��P"{�D�ӫ�Q��%�m���,OCv���,����boN��'T+]��H��@�15�c�U���`��{�!T��7k���$��=�^�R¸megiUO��z��F �Vy��vo^k}���n����+�ۗ���t�2�NH�����k�J����v�`c9 I!9>��E����y.�6�n;�d���[4PB?�>�v8=
MV��U��dq*�<)5�zv~yY�Ir@�==:2��AB�W9�J�'�[���1�X�ta;}�������e:��a�S���:}�Ϙd�<���t�)��z,z���د�լ�{���զ�B��TX'��ҒX8Sw:��v�A돻]�Ѕ���X©.�jI$�è5M*����7rG�<�T���Z�ي�������C�8�
["W(z��d�� �����@*��lx�qŸg�m� ����{���N�
�G���F	��\>��'k�g���^����������NG2��-وf��ʑ���+:�\�v���ʓ��j{��4ѻ"���(�
�ѩ�/ڳV�%ZO(�>�k+D@� �\!��v��
�pQ��\h�h݂��e
��5�vkI��i|�UT�Bq��G�� +��$�C&uSG������H��P�Ƭc�_r� ���I�QN����X߅�I���J6\
Td�8�U�@�,˼Ǉ�$1?'�1� a�M?q3�W���~�0�#��?(����i� Y�_V�"�Px�g"1���I=���8gD�s-,��?-��	?����<@·c�ߣ ���3�'�� ����I2�V��A�B���Pў�{��]V�E��"I�"��(|��v�Tc�c���<6��0Cɦ���^�������+ i0#P;0Y0��~ΔǢ���ʺ[{6���Gvw��U�Zoc
�s�������#U����tlk���ha���\�re��<|��~���2��;���_&�%
�Q����� �a �;v�c�8Q�5X۝j�+5�O4�"��YtוBF��O�*�$�ӨpV� �� $�a�,s�I�5;�xW	����K����sM�{�B�r��U�~�n�ى���yno>��a
D�� � !�_�;ķ>��Q+EI]�ilx�e�<�3;(�8n$3��6K��~+Y�7�S|��5
/;?�]������/� ��8�T��hNE8�;$�;�\w�_�>���?s����~��.����spd\P��H���wG����0��	�
N0{� �>� �B�B9b����k�߆��c�ϕ��N��(ܔ�|�%9�J�?_(�P�ܱ	���1^��_������þ$� #�OĹ�"��,|�B���5s_v���1V�:���Y[�VEb��H�-�u�t[���䥶�y����mk��O�4�K���grGn��Q�;�����!�R�%~U�����4p
���:�%�0�\٬r+-��[��F� Qۻ{ud��=D���P�6����K64�F���^�2����
\�~e_5K���+9X���Xly)ol5hp;}rq҉M풚�j�M��DVׁ��)�s�ܬc���r��H9��[	���
|�}�a�l��R8�H�3̆�0�+�+�O�@��rHMz)���;
*g?wgP^�Df�%d��5��NE�hĪ�,v+�#����3_��P�H,<���[{�7�������YoB�H��Y�C�$��� ��J�͵u�k��ء�+�i@��� ���ӢM��%�d�8�U�G%�5�7�}�����$)�7Y��z�v[.E�.__��g�i!a�_m��|.|��9 (������"w5��jۛ�qX���^Y��,���d�P��z��M��)��GdX�����V�㖵(���>�O~� d�W*�[� ʿ���|%��4���^wVyW�^�3�:��X�/�3X>*��۩�
��6��+����Gɜ^��d�"��Evϑ%#����B�A�gd:�&�^Z��s�B8��2����� ��_�U#й�ֳ)m}6�L���2�-=]�?t�%�9pA#��H���V\�7�AX�,4x��x�Aa�HM���'�a���#޸���#�ܲ�e�����G@���I꫱et� �g�{����?�� �z�����|}���K{�<V}���ln�u5���åR/HĲ�OuE
��ݏ����%Ϸ����F�q	'�n2%��\�@������b�C�/n�TrEh��^��_���?
�'�����K�Ѱ��8̛������i��rF?`x��Hʓ���� �?�o�r�۹B_Ļ�G�6��$���� ���"�[���|����A�N�_�]F9�� 4ܫ��O��.)�+�'�r�]���q��~%n{z�6"h�we,�Z'��oqb�B��vlc��ɟ���ݹ�p��c gv�D1��^1�6�kRV������e)r�h�ih�͵>Axm��_*�σ�P�S�_���3l7���|i�&����^����v�h�(��̫��	�u��=���~��w�f<{vn�v�k�1��Ā$�O�@�w����g�p�2��3�r�E��K��r�����������L�C)�Ǵ��D���N��	 ��2�McٸYY�n<{���L�A|��A��ٵ4�F�]���%u��ؙª.�sb�ٞ)^9�V��H	p~�%��F��tnX�(���|�ȿ�/����츭�� �i����lK�RͪٛQ�+���U�#˺�Ǩ�~�#Z���n��rR���iι�ʟݖh³q�0����[::x�,�a���,��Fl��[��ʷ�~WrGZ���eؤM� �Y�~�z �S� Z��6n۫����R�H��_kadYdor0s����%(Ou��挺����\���6�S9���2��-?�A�@��B/�RQ2��jhө��zi��X��t�C!��`�݀9�pF1 d�nk��D�r^/�����y�#xi찆�0V��M�P��
�͖u������=[,0Bd�T���ˬj�V��\�g����O5(3�;�Fs�= ,Q���������@���� G�ԆP�z��,j�$�J�
�/�q�o@�;�<S<��YV���x+�CjZ�$�&ƌj�`�.�8�3�ʪ��.�[��n�����о/Z�]�2<���{h�� _ԟ�R�9`@�OHy�����`���5��?�Q�ۿn�� �A\GS�Α���Z/8|����O� �*(���m+��?�������I�Q�^�� .Ӂ%��)���A���2��"�u����Zz��w�\5��)D.Y�w��⌻G���('^��"� waDğ%�u���C]|^-���Q�eH�`��������n��}
��G�EA�y^�,��Aэ��TAn�7��h飱
c�*�uz�����Z���gr�B;�H�~�� oM�K/��->�f�d��UI�m��� N������e�V{Z-<vZ3�t�!�N�߼�B���
3��E
�pM�ѽ0��b{ojFW�
�g��e��>�^�W%����9�ϑ8���V��u��a<%�-<�<��Md��>����zkR�R\���;~��K�MVDÿ�\��ć�태�zm�:�cC�,%_�����Z�,T����vQ�B!XR�(���8��88���$���+���x�����ŊI���g��H+��^11G�"��K c=�B� �hq�jJ���-Շ���I��>X_ /פ�/�Bo#�C��hگ/��T�HR���N�Dj�%X�%�=r:�8��X6j��R�j5�5����t�VZp$i[QGo6��Ԝ�S�[��^�,w75�)Rk����#�< �y��?����.mf���p6�X�6�z�Ͼ���#x`rAf���FA!K�m�w��y�k��(-K���)��X���#��P�5Sw_$�~=��y�-m���)h�����0����?k I=@TbS��,ʮy�����v�ϦT��ܡ�Q���n�Z�%��W����"XX��4��c�RK���0f����_*G�.�]�����#I�EZ�Б��Ȍ4����N����̑,�G?��^�Q�nn.EFH+laۋ�QY9���� �N����&!b��&`drUg�{(�{N?^�ȵ��T����	,)"�>����nT�����k� �q��aB�
�{g=jar̲o'H�:J�E}�B�#`��'��@3�z�D�_�R��ϴ�Ƨ��\�v�|��Mւ�����k�Z��f'��Mƥ�����c#����������ƥ�6g�i?�+����{�o[���~o���(kWY{t*"N�p�M�!n4��� 1FY�������n{��W O��}���IN�_|{��r�C��%X*,a��V�#Q���y�~W.F7%-��G��k}�Ո���� �_;�;�
&��M��ϐ��7&eH�c/�SZ?�29�Q����C��}�;�p\�˓6%/j%�̈�΁��E_�~h� ���0�B�m�+� �t�
�$(���� \��={u�^�
�QyQ
�O=�1W�d�����q�������C�N	�&���_R_������̟���JL/���,�Dcʾ�{~j���YH���znH��U�9d�����C�z�� o�X��Z�l��r���9��������t֧7���)N��G�U��2ɂ���6{v�X�T�7Ln��m��#�rl$a�r��ϖǠ����XN�swE=��f_~��'w�E�#�CDD��A'(����Mt*H/ēĳ��Ta��k�A�+耉C��}������h��}7绉�G�u�Ԑp���{�shd�j�
"}�6P�:��BI=�Lx=GiA�ݛ��m�#�:Ho�u��&���$Bg����t��00:���\4G�� ?���{X���w9���� z}}:1@.��[�������؞ĉ<��H����������C$��ԝ�!�QVK�h62�N�ʓR',B�d�$���!2B)n�1�� �����d�r���F�1 L�(d��3 0�y�ݍ���d��U����BȊ��'��>���pfH`T)[�׵��j�פ�=t��a�_"IU8��u�ۂ����qGmk�EzrA}<jј��k�����1���^��	 �CZ���RūikVHݞܮ 
j����KPk�ë��o]�Ҋ�����fͲ���$"0�G�8$�
���8�4��/q��q-����y"}��C���t���q-
��{�7���c����k�H$�:ڈI�/�^H�@x&�pq��\���<n<l�[�C;3�N����{��3�#�H���N9�j�{��:�kO�!��<S�[*��2}��s�OC�Y�\�q�H�1��׽-�<��F��GRp�Y�/��Np1��8$&��^���6%�j<�E�:S�(����'�~�`�Ê��5�eYm�-	.F��
z�%hê����0a�� C�
�	�>l�kxd��6��~M�����-=�^b<P���!P#'��sU�~m��)�~�sm

�Kb�ϗ`:����؂m����Q�N�˔좐�"�mT:�Q�ሁ�z$��Q�O���mn��!���v����>�/�U`� U�k.�
���k����5^��T���*��Wϰ=�3q���^IŸ��y�{Z��e��mXe(��#��� �U��M�FN�3�hgb��H���|ש��.�Бyn��^M��kƪ������O4Ĥ���{M�۱ հ�!�IJ��E���7U���5�UR;�p��v�H���"*��;� ��Ű�Xt�ױJ	F�P������� gפc��1AM�*���4�I�8ڝf�̣ȯ�ݼP��g�c��5 i'�[+�0���(�j1�\���b:C<��%��@���q��V2�KJ����[�]�ь��*��Vҷ#Ջx�Z����AMY�c��`�q�zucU���+��"
Ը�Ic,9�r���Lz�/��UeR�jG�BR�~"���`I=����rbQg��������l|��T�adZ�U�&!V9l�8PrU	��tF�=��j����X��-d+�q�*�� ����!#�m�aV��lk�́<�Nq���Ooצ`�⹭sU��h��v��4-=��bH �2�/��l�$g�h
.ģ��D�=����"����~��t��+$��m�<��hǴ�X�u~�}r}ϧCpM�j��g���"�[�(���G{]��m3B�yVT�gq��r����gU���NT����/����x���"�F�Z�dE1���|��:�8P��h����A5To�M�yc�VoYb��~�
�V�V�� -�ȯ���߯��E��`�8\H�W�Y  
��w� gS�`�#�J$���B<?PG����[��l�U� 2�W��,&P4%��?gXy�Z�do]x��^7��=�TB�d���2?N���Y'2��2^�� �� �Q�=��s�sI�g�c�<����9��`��T��q �=^b��)ǓWE�߸�r�����O�f�) �ǐ#&+`9'�o�X#0UԔ]g���k'���fe���!��-�o�b}GK�:��Hչ���zz�� �EOr��ׁ��3˛9 =?Q���'[Ց��{�km�V*U�3Y1r�Q�@c!,����MT�N�v�/�=$�ƒ&�aW �J탅�R��P]�En]���Y��e��ىvAT~A�}ڀk����K(��UO��N)�N'��ݧ��+;x���J�$ya^4b��� ��@��?k����#gKrx#�^;S_i!� h�8�l��}:��`�K���Ow���|� *� �}q�y��ӥV9�Q�n��WW��ӪI<����«��I�:�RcU'\��r
���M�� ��K�.��	��.�ԃUJ�]r�>5���Y+���ↇ'8����B1�M��.Q��}�gF��Ƴ�v�`�6�J��=��Cm��\&�,�*�;[�v�ΛR߁RX*��[//�ggjj P0<W�̫�.��ۑӭx�;2<�\��bG`��5n���"�� `��]�ҟ*�(O���۰���Q��DH��[O�����Fނ��6��g-�ED��#�B�F�~� ^��M���w�a�E��>�Zm�Y�"$q��R���'�ߥ1,��v�L}�>�����YD�R��{��w'���ТIF�Yw^+�׵���e��ڒF<ۼ�N�$���uk�) 0F�����ߤ�*Ԣ���&��]�7��kd��zIQ�4aDo�;�����r�!>R_�}����7��B+���eOw�ӚV�(�X�b�����zP2@F�K:��2����WZ�Iu��V�d2Fp�Krq���5d��NG�M�����W0��'H(�Uo��#,;���nlu.���̣s���g�k� �@�?o�����j��^������q~���XQ��(�2e������YT>�S|eWi�����G&�O�����D�	w(�YY��'#	\`�)+a��ݯ�Ǯ�%m��i������ٌ�Bƫc%{��:H��( ������wv����Y\[�]5-����E'�rP���#��j�h�	!�4Z�v*�'#�Z��,��G@�3*xR ��A�D�PE���j�
7��9,�AU������뒴=�� 3��C
b����dZr]��IMD��G58��*�#ש�޾�
s�=�\�a��q�:@%�}�_+��:{~ή�{3K�e2��P�d?�Y%�
��DN��v��j�[MdZ�
N�̬�8V\z���x����	$�.!�Ɇ��UFJ� �8$��ף�P� ��_�b��ަ����V�k�efP�F{�=N4HGEҷ
4�S���� ��t����O��q�?���d�?��-��뵫!l%��^�?A۷Y�jY=���p����z�/>��-O�$�*��� Q��J�XNC*�%�5��߿���`+.�I ���z�â��+_ɵ�����*~M�>Rק��ҳ#�_/1�2�>�_�3�ܾK�ˏ���䏔�x�4������p*~<�T���� F�;�����A�Ŀ�)��[}��_�+��#ģ�|�C� ~��ӭ� �,��D�F���[ć�3���'����ؘ  ��ѳ܀z<k��9��GTG_�Mzb����e�q���֨����4C9���u��=���~�*B9�x	6�t�x�d��$fưO�K1�X�����BB�� �׭���G��0��i;\GQ��G��ڷ^I ?��^�:� � !}�o���n݁� �e� �_�?�'0G�˰?��A{s�;%�ͳ�3�b\,�9T�_�Gq�v���(�]�ߏ�~��ʮ�=���8�0����Ͱ����J�G�b8Ɋ��]�ON�C�n^�&D <K��ӻp7e���� 'y�$��>]�9]�k{�vMȭ���Eb4+��E]q�=y� �۶{wټ[b��ȟ������E��� 5wI�{��̹#�5�&�\�I�xu{@����� �0?y=~�bd� �P�E�%t��W �rps�=�u%'�h[����%ٲ��7�����(%Z��g:=�S����N3����?I]�i�S8��6��R }��Kᓀ�!p� ���Fy�KZS��e�d8du!�ԏB��Z�0��.����4|����� .&��\�>/�o.ۯT�Oyj�m�I<Ǘ��%S�GY/E�@�t�]$�ٷS���+� aH�`.F?oU� S����� k��Q{Q��$-J��;Vd¬�6B�_��Ϧ>�H�����&M>����WXD�[�d��nB�� ���D&=SE}f֨Um-��PʐZ��Œ
���j�l���uoI"���3�F̂Gq�~9�F>�&)I�������,�4�H�ݳ6��ir A��R<@�rs����<`�_uF���r�a)�\U]JbR���Tg����d%"w�=���8��5�Z���Q�3��K)�}2:� �:�_C��B��rM�q]�S���rK�;���:��rB1�$��f��!�g[̭G�mWN�Y�E}�3��C}ſq�随���"�Ɵ�G�۹dx�د�נ�
���r�!��>��v`�M�>�S!�y&�$���$��Oj�����`ɰDD`�li�#i&�{p,�م�EE�p�>�0)���M
]s��������!�Pu�N���q�m����U�c31���+;x�}�2�;}}z�%�s����P�M�,vd�_8�|�p�J������Pĳ"6h�=$u�0��尩�x��ޘ� ]X`Uj�}#s0˧�5�&���#4l1c?l}���4�J*�7D���%��EŴ�-f��� oo,�fn��?��6��b4�D�[T�Mn>=��=�i��ǳ��S��n�6��\u7㍹��~-��Wvg^��l��To<��9�=�c �@b��jx���+q9^5TA��X�Ϗ�8vbs�=L�:�m��u8�_k�&����1��6�Gk����hj_���4�-3�t�_�>����<��z"
H2#^-7�$�M�ҍ`pO��,I����7T�#E�qU��-������PQ��I��h�s�ND$]դZ�EL�-Z�ŵ,P5:�""��(����l���!��X-�lOYa�S<,�ةV�WS���
���{Bm�*{���Z���Rm�V�r�	(Q� &�b�l2�9`c$��0�j�1�r�Bu¥��#$X8Ǡ$~�Ѱ 5\��z�����K�vr��-t�YJ��2H�L �����he�\� �C�ۖy/�_j+���+�X@?�vxT�� R��:^5B<�cp�oCJ-:��5c����'=u���>*��H�gf�ydg���~��
�Գ�z+��Z�^/z��m}��`}¾��۴�?��S�t����O�zllT� '&�N"�nK�Fʱ��a^��#���
�C�Z�a݉Sv��^�����*D�g�<Qp� �َ�!8'?c�����$ώ?��g���H���[^p�I��m�����->��Rm-[��Y�4���d.���� '�#�&@;N*���ĺ�õ7�t�4l�\�Oo1��Dq���t��d��\���jӳl��~+InC&�/�fr1T��urC�����7u�\��Jߐ�ab��f�8o� �8$z�G��2>�੼������YO_B�D���Gw�7&���b�#$x�ޙ�ʑK��-ͭmh���� �r
�$g�4 ��R5(0e�WV��v�ݝ��ܖ�I<�i�,@?j~1 w��r���E��,����lZ���X�4*��T�(��$�S���s�m�W5��F��Ūvwu�GU����
J�� �GӨ*R�2뫫��
{>F�(��۷������ ��(��Ɲw��Q�#|�H��H��Ta���9o���
p���0�cl|�r>9[���0�w�:I\�G9��s�*I9��(�u͐w�ߟ����]V-mu���3'�&��Rz7�,��m����/�V��3������I
G������Â�*$p	�.��H=�����=r[y�<|�[��>>���U�C]��ch6wj_Ǭ��:� �o��w/�y6,���Y u�"?U�/�sn�jr,n���/xx�ä��k-ݒ
�F���R#S�}�X���{�ټ�W�ka,H)J/�</�-Jؖ��� �� =j~A�W�EV��~d�ŀ9�<`}I�^��1��&tq��,L�֟��zw��r�@������rԏ&�O$��c�g?�A� i��ye-�"�6��'�G�e�%�ʪ�ĭ����	����	e�aݹ����_���?\�v�]XP	l3���q���T�h��
������0¡I�����������>p2���{� �}zk@�۾��V
W�W�wsbM�p6�Q`	��D�S��Q�ܑ�Ւ�`�Y�|���<��#�o�7�&?��zF��h2��Ǯ���)��{�q����$� �����V)�{Kt�K[K�;ٜ�K�!J���=4N%C'G��O1WکWx��F�C*|p<���cץdw(�˵�l�g�d,0`Jw��oP����mvE����� ��� o>��_�� �ϱ��:	�⫾9�N������ܛ�&����,��<�<�_a��;u�E�)6��>Sv��C
��{nꎶ�P��Y�HaN�1���w��g�f�m�<*�Om�8�|���B�	`��7k�F]L�#T2�����_��� QQ�5˶gժ�_�H�����7�H+{c�$�6[�Q���~=��Gw6$��ǵ��G�3�zt�Te2(���I����ٍ}�u�����m���҃�qJ:m�0�U�`���Xb�%$���7�|��q��>ܒFNں��(v.E��خ�֊���
�6���t ,�Q�5��ZĐ��$ζj��݋ck#�阠pA���ݚ�l��j`��qW�A�F��
�׾�뎐�0�G⩹����꽋S�M�6����!M�  \��%Z��!�y1o*0ku�<1��{�E����R#5%"j���*����ь���YS�{}�ߡ���� �^�����(+	���-#I!i��󓟯R��
�AU����P�� rnz����-�W���k?���zK��[�"�g12��!�1 U�®�Ԩ��3D� ���:�f³�X�5K��je��X��T��bH�h�l���;��z��G�\V5  �Z�O�D�VI�m��BNE���=G�W���]YN � �3�O^��"fN)�4�8��;]�ʻ����P��*Z�� �� )q��{|�R?�i��ǒ3�#h�� wP���$�n��Վ� #����r�-{���!o,��=�c#�~��%w,�Kƪ߉��Z��ᐅ1\��F�O0�P3g�@�3��RQp�H���j�E/��;��p1���q�1�:�D�F���-�kssJ�S�]]!~V.�KN�U؁���Q��I��m��4�������͒[w#Cd˚0�= Ρ9&jԢء��6Q)B��V'%s�*�9 ~��iT6斠՚|�Hd�qsS[X,���4��)�p{���=B(�GE�N�HY7�e
�� �9=����T4�I&:�	I��-������o ��:� �JS�ѣm��i�(��X�l�������Yo}�'��蘥�:��֑b"������M��b{g��g t�ɘd�o
��ʾ-���5��U��q�4U�/�P� �<������k���r�iH .HlE���Ĝ;%�q	W��κ"�+�ٓ���'��坉>�'�����&�����c*@� `� N��@��aϐ�RO�w���A
NH�t�gL	��O5I=���F �x��|\��=ON��E�WǷtj�]6�y;��y)�rd`K����}=:bI�IS�]�;��m�t�7|hZ���w_d��P����슣,���$(����)�	�n_�kĵ�	�����ăŋ	mHI\��?\���N�]5�9dv��W�� H��^�������=�g��%$ /D\�*m�@����~
�'�~�1,Y-J9w���]����ԫh^�� ��Q���GS�z����z2iD�TA�7��>qi�Dd�Φ�P@/��?v{c�� F���(�|���V�m��M}���z��*ƮB(1��{����F���&�Z��*rڨ:�Z��+	vVg�����#�t�2Z�Q�F�}��?��iYɱR�M���,g����222:_j��2Y����o)C����I�;Ÿ�K��y�;{bFH�A#(��b@�n�����<t`ik�ejt�GXZ�U�V����~�NI?�=(PD�+<�*�37�<�ۊ/~D�u'��W� ������ɣ˷�������y�:y�¶Ex����2�ކI�Ж(��tPp�!�<5�W-�k2i��"Q�� L�U���}�
lC4�䟓�)M$rV��j�	-�R�} ��Rl�v�C����H��
;�W����'���ވ� �|���Zs�׾�+tզ�;m��fꁣp����#��B(���t5�� /a�6�$��Iku�
f*�!����N?oR8҈mR���"	}���1�FM[����_,�z�=+T�⺿ı*��喼L=�v�ˁ����� Q_�5����ñ䖮OZ?ʔ�6��,���n} �����N��7"��J5����H	A�i����(an��W޷Jh ��I��ܕ^�Y�� F:��>��W����5�Z�G�|{�$O���:�����,~�b��.ev-G\pNz����-����ϝ��S�o��%��|��r�>�����J��}:�j@E�\��w&���>B���Ȩ�l�i���(A��5Ϣ�;��ff[%���cf�+n��ԓW�.��� �x}�;��+���d5���m#�eb^�(U��s+!g#�d��_[���� *�HE�bs� �{��2���8�x ��O����Iv^����<��=���|�?���"�q��3��z��� h;����͐,d!������ �0��lKM������Q����V(�~L�
� �,O����t��/�e"��_О�n 8��R� 9?�����}�'ĵ}� (�p����1�W�f�W�/��wRq���� �����}���,�;E�n,	Cqg��%�� �}�� ��H��jc��Y|�P�a�̳�S�br~�ׯE8�ݣ���\�7������u eQ;��pH9b?OO�N�T�X1P �� ������|��p�UA�)�J1�4?�O\�����h��Ro
�(�
b�m�6�zJ?(q=}]���Hh_�b����+� kH�~�b�=��۫a0B�A�epͰ���Z�r暝J05�vfh H�y3�2}Ө��E��¿��_WJ����� @`{��oנFI�]u���yy� p鱜� �MOOO�x�'ϢC�k�T�	,���5�nX����fI���q�����k�ϴ�WM��u��M^�ě+�_^?Ȼ����!��_S��V�S*�Z�r+uҳU��`�'[Y������A��Ќ�MW1����QAC�֎%�_ʃ�k#8����D��m�t/��)^F8�J�P2k��[���
�_�P�g鎌�j�͂7���v������t����2�	��/�	�ۿK��pL �b�٩ʼ�Ż�2J��)�V@v, ̒[_�=F�
V�nY���D��q�I���ݡ�$�yfGk�G�><AY,D]��w$���qs���VǠ�k^?e��b��e�B�#��\��f���������D��|��~���� ��JD7A�gl����bř���Z�� .G�>K}�tf�Ė܉�_�P����5�Ie�I�]Qe�`��/�\�"O���g��,�j�l�����a�k��C,��
��ݎ���x�V
��(�A�;Q>�V
�r;z�#�-
ڣ�[��㼾�1�  �����)呹x��9�lyl��5���J�'�2E,h��l~��U�TC/�4:fɓk���d��L�H����GF]0wQ��ra�mΆ�*���
&k'�4���`c��:Q�O*f�
�c����c�qm�������x�[1RM���6S�J@�60=D��/�2);�k�����O�or[�ٽ6��^����fa6|�����ŏ�Y��]o�5��h,�͔e�M��P�0W�0@�pzx�D�:��� �M���׏��š�� h�s��y�&�\��O$�9�6B�~���O���E����� �^s��rBhP[m[[A}�k�Z/���c�G[�`R˛�}#�܆n3������ٚ�~|{k�_�uE�B?EJ�Č��Z:j�K�<��p^Y�����y&s�.������H�[;�bm��`a���XG�O0ž��=t�W���Pv��A'������&��@�tV�c�!E���v���tA)n[ 8^����K� "8��s�)�Z�7}�+�.k#�A�Ң=�M"�5�x�y��'
<�����}���O&�n��h� �On#x����{�>7p�M�S�a6Ƨ�!��{��M�ik��T��S�l�У�$�q������9����O���
�`2?��K��9���%��	4qܒk��q�n�|�8 *���z��?� (��еn��m������W����Q�JO��O�y
\xq�6�f�j�����������g�|�\[S�yF���'�շF��X�UjW�O0YdKH�g�`GZo}D�n �J����x�"L<OBC`H&���� �Ӫ̉P@*mF�(f0q.9�dI�Ђ9;��,~C���"J$�GW���iܱ�8�<��n��U���+��;�8=�ק��R���ީP�7�y,���!F-�d���R,MP h�/�,G��g�FAɕ(V��rb�z EFJ��]���Ǵb�zZ�)-��#4Ŀ��0�Ԏ���@��O�=���������J��~���4qL�%�?���<�P ��^9��]��4����ψ��Xg�Re�郔�wS��Rx6�Fjv
���[X92�ཤ�����V߷����ܓ�g tdI���D�<���]&�uw]�䥮�g�d��`r@)ȒF����%3j��e��Aj�:���3Y.�G���՞1����tL�V�C��O~�{=%��7�>�R��*Ʃ�"����=IOb^K�9�\���{g��ֲ�}�&2`�I��@E�T!C�rFi�t�J讑2Q��+�[`	9�~�Y��I�e���ꛚ!]|�/=)�9ɼ�-�>�ӷ~��f�FG�ٶñ�Fk��6RIĿ��H�����߷I����L���NZ���s������0Rn0�D�$9���a�<�����5))��H���F`�I��|��߫0��}���%O�W'�K(9=C�-�!k��ݴ������,%�ƭB�Qe���K���n�!�!f�O�ˑ`�4+E#x5��Q���V�6T�c����X6*9D8Λ��z��~}��h�d��5]wY� �+�|2`����I �qj����˲}��U�h6��u����r��1�y�� �����F�e��ߦũ��t"�82���)��H�ۓ߾:Y_�m���<yJ&c Y���VR��+i�Ʒ�
�"Z��hu�х��(�h;���?��d ,�c#U5�>ʮ��޷9�M��W���2עY���HEP���-��s����
���|��ENu��a��g��'$����w�J䰦�sgC��7?�PX� �b("ւz /D� dv�:" �呍WX��|r�i-˰����U݂y`�O I�FK!VP8�������-ߟū-������6?y���� �n�%���Ÿ��u��m��ߒ�%���^���T c�ΰ%��/�������l�j:�⿃m��9O'm���{
(�W �?_ی��(�LSI�� �6�7<���Ƒ�q/{M���x�$_\�~��"MQ���o�Ng���K��
c���Y���w��Ce�-���秧����$ ľ��H!{�uш^v��Hj��T�~���8��:pZ�i'Ϧ_z� �ݙ����$��:�#��a��`X��Һ�%�I=��<� h��\�l��e�icN7^�/��H��i�W2x�����ׯ�o�������f��>� e����vS���� �� ���:^#���{7��Aee��f}ߌ��WRp��/93���_۵*�/���������x~�?�q5Z��Я�N��Lc1��X�	^����q8\���TԾQ�� #_mW������m��?�|�|���r�V���D��W=�ԐZUɌ���  �q�������lq�V=F2��VaC� �j/���~�y��h�D�����:i��F�r7�3����,=K����Gl0�2�y*�}{�=6��]�Q��7�����'C&�}N�ߒ�.��?|�,p�q��+���G8�^���|y���f�+�$�լr�f�B���Ӫ�.3�ɮ� ��Io�+`�M�A��ۆ������� �WǶO���ǽ� �py�i�KF�G��[�*Zjp�{dZ�F{g>�Us�ȆkM��L�_~� ����M�� �g��&�WfM���9]���~���e}BE
���>]���<�%��6�=)�/�<�%�^7��|������@j$�Tݲ��9��qͲqd�m����i�_nE�ᝀ_'�v#��� 6�t� �5kխr>+���:� �;�(`�q���}�r�q6�yA��F:�{+RK�%�.��@_,���z�ڐ,�@v�9�(�
X�ӥSQd_յy/��Na�2�$���0V���%2�������}�� ��>މ�� �q��>�שhU��^x�8a{�6�B��ŲѰ:����#V���]�M�v�BJ0�"��X�vB��翈�?��1�)\P����5-ےN�Z!��bUT��r?Lv9��酽
���OO�{��6;���dC��<a�1W-�e�^�g��U3!�s�˰�˴��Hn	5r�X�LF#��'��9��c�%�qB0/E�gg�X$S��|2�*K�O3�G$��Oq6A�(>����(��&q�$���,�0ʵuP�!�+�bL�$�� ���
�E��]8��9�<�ml6O~����3)BЪN �;~ށ���D�@���mM��R�<ukr��}mJ����+��ic$ȣ��8���UC���5���5}�[ۍ�����ᒝ����<��G�g�SӪ�1��%��;���9Y��
ڄ�xW�T�����K{8��ө팊���Fiky}�ݧ�3�]Z,�����W.��G�t�  M��6b�?%�b3�:Ӫ�`����`�Ӣ&�+#s]�F�okD���V���R�ף�^L��0�?R U������[��!	�K�������`����C"��QF����)-}^��zTst��Y�W9ǓG��w��Ш�%j�ʬ����J5!�TRP%\���@T��FE�B	��T���2�������kpӧB"��� �#�  :�ָ�4�
���U�*d���� Ԟ��)�P�zyg��+l�#Z�U���$�4�Y�P��� ޿^�� BXԞ����Ә��9�d��T,������t��0�jtiGu漜S��ƿ��>!��Vs]� wC�*\��kr���m?Sr���,~C9�5Q�8,rA��@����7	-�^w�Z;���xu��9�s8����01�z!Ԫ
�W2���4�ʢ��KW.X�-;RL)�>K��w }}:4u�����C�֤�����Ge���d�b���s�����!%|��k��0� 0�D:��&��q��~��{�3(��l&�h��N$��v�R�i,\�
>K�~M�n�v�k�:���*2 ^���B7	\�[�Z/�^W�lF�,�#-߹9?^�\���I�
��N	.ӭV��O.� y�=qy�q`�_oC��|>�%���:�4n��A�z�3��le�3dz�ue��8,��n�8RM�
蛅R��kL��YRU>�� �(� ��])�b~�W&�2B�O��oy�.���A����*7�EG�6.l�EJ���{bIAc�d�����0�)D���� |F�|c����rX�?pmW׼�_�j�CO�FJJ@s`O~�T\�22�l� ��Y�O�b�˽�ݭ,�4�Fe��B�������4GoU2]"��� �1�D��1�I�f�q۠K���5"涼˽�"I�Ye�r�5F�q�=h�[�w��rX%��r�f�g�X�n�H�V8�	�:1�S�M���ȹ��*�ښ+p� ��`C��@���Ԣc�
�4����]o��}�e��I[�L1
$�~��ѝ�.G��Iv*�ye��7��[6��d�+ڠ�g��(�I�@�oy��k�W��+�,�c�cw�%����`G���Fu�9]4�k��k6�q~?��a].
O�� ~��ԍ�!��(��㚴�q�/��-s=�U�8 i�W9���z�B �SD�΀H�V�8V�/�s�>M� ��붛�[��x���@�q�[=�U_9��'�h�NNcȥ�c\u�H�#��`��Q،}֣9�����E�I�D�Z�ۚW��
����@��_��HmhS�%�5c�n���Vf�ZΚ��Xd
}ȣ;B����u$5B2,�Ї��5��r�r41��؊@P��]�����;u ��%�aA�q�0�������
B���uc2Z�|Kk�9�ݚ8�	 ��׫l5S�e5�hL����7�c؎����bB0�� �������ź�<&1��6�S��e@=�����Xd/l�"Xx��w�h�U�Y�8��u��Ks�����h�+�������aN1���p��� �J-��g�2���0A�����]��*w�DL���!�7Fud63#/l��~��vT����]�E���E�M�WZT/8��'g�0er l H���R5]:3m�S��k�`�
����
X�8?h��DQ.����E�����yg�B+X�RҠUU�$Sⱏls�q�ۦ2�䀍]������rNC�Vi��iN(����,��!�[�#��D��"CUc���=ٹ�� >��2���(�c�@���nj"]��x~ҍ۷*�=ٛc��Ͱ�F`�X�H��@���;�ROP2V8�7_��$^c5�J/rWmu)ϞJ�d��dc���
EST�n�9-� 	
H̔iǟIR}}H M$t�&sc��Ņ�VJU�Sͤ��o�մ��T�ڭ=�չ
zw�{�҉��s���w4�w{�b�ě�)����=r/�Ez^lz��G�p���c����~�a�S�B�p{RO�8�ר��n1,(��mu�{+F0���c$�\I����Us̶�ki^��EVoON�� �\�z�*������q.S�������}K�~W*6�J��O��<>9�z0ȁ��w�1�  n�~ �����
q[��뼞��QS*���!����H#��p�U	����R�ߋ�륚��1�K҅.��g�Мg��AEP8��W�Ǹ���w�Gr�E_`�W��#�a5��)��'��⁐�d�nc�׵�L�_e4�a�Z��\�4�J���LpȒ<~�'4$�"s��c�+5��a����>A_��~��� %�����x��<rv��쉣��[�(��

�	�}H?��R�)���K�X� ��{���47Ƀ�2�30�|���GJŜ$��4�[S�*L��tYB�-z��@xQm�}݂�����DC_�vz�V<��5涶�G
�l��v���\��C���K���yOk�T�g��T��lx�$�W�[k��_eDSE��p=���8���E
��������~�
��GG���l*�j��}�cN��^�����C����y��-ǛğD�N��l�_ۼYq���F����&|��8���ޜZ;>=��u����M���v� �D�q��  B���Y� �������y�#ɕ۶�B��
�~�e��'��p]�V�>U �����W�����<֖mv�O���47�����f;T�$�����YN ��Q�ۯ�G���_�٭q�OOssD4Mu
}Z?(A~��ž"KZ:q�jG��T��q+��'' `����ÂA�5c��*��<���>�Y-K1���!�P��p��~�"IY��zv�{م-W�'�H�潕����q�ǣ⃓�(��ߚU�v�y�Ӻ��8v4�	/ �`y��L~ވ�P1'E&��%*~!6p� a�>�YN?^�HȄƩV��ok���U�𥯭��F����$k��1����V�� ���霳� Փ��(�����>�=�og�_�����V��d�KE����Z�֞�*���Z��LQ��8޷�R��ӷV&p�ԇ�f��^e^���:�&���XY�92ye�:��ķa��rz2��6� #=.�U����U��EN���3>��{j���5�ð�P\r��������b���Lo���<e�p��~��4DI���ʵ����ɛa/�Φ��U�� DA ��ۑ�u_ӌ�n?5���u�a��@uf�cK;��J�	A��>I�^Z���M5�dUM��ܸ�(q�V�Ԅ;M���M��M�����-�Ui^����Uq�A&��333��Q�I,F��7`���r����Zhu�mO�%¢)]�E�YO�P�~�*9�
�b�^��+�뚻78�x�����r�Z/�/��=� He�'柑:U���bj	d˕h$,K��� 
���Cy��g��;=7���ۆ�M�Ͱ"ْ2�ꊬT/a����Kp,���Z��l�^�[��_f-�a^ev��*1h����wǡ�D���E��Ni1���g�u� �,��[`W�?\I�|O��L�q�6����'�D�.��Zvjm��T��0�+I�%
2���j4�_�UkT����!��)0�����O�:�����K�Xչ��߳���tG�x��`��_#/|� �ջމv5T
�Ԟ�����b�"�8��Pp	��D	2����&�]��=��䷠�}�\�^R�(��Y1�%A��=1U"Ny����Ț:��
����S�����F�gzN�
���_�Ԝ�z����n$�<� ȍ�^c�ڴ"���i��c�y�T�!#����.=:���M��v�+v�&]~Ƽ���oʸ�2�$�N?��а��XGG��Y�d��SA+��`@'8�5��	�kb�[���"�9w/�rmZit�|i�� @V��6_DP|#;=��e.[� q���=[�)���>����3i��I�V��ɐɏ�cՇ�DT*-wY\,BG�ǌ9
W���x�X�m�"d=;�I�g������4[��3d��i�lx�e ��$���\6onև����qe~ɉ�5��n.��PE0��*A��^��ݡ׆�o|�k#٧ �	>�}}�����?�uŁ�%����mC`��U�hhG4U�c���;ȹl�9��V��A��q��<�&�ߍ�^���Ϲ����+��e��tlp��3[��
� �\����  �_�l����yW�[U+�q�lH����|��rG����z�����+m�$D\�VK�h-r
��/��pM�M��ǭ��{���xj��CK�i �=�NEN�Pg�{�+��?W*�O��aFoPi�s�l�΋
{��s���}�F�*�ˏ�=@Щ���,�g��C��� ���
��rM\��)���l7wYX_�������`����������þ�����l�������	��M�<d�h���1�z��r����nI�Z��g�P�k�Jz^=�!�����&�&�l�y��>�UW��x��n{�:���1�UW-�H�X�B#r� '���Y��^̛h%����Xc�Ĺ���q�����4L�ۓ�kä�!%��I��yy��� ����t��
�`�UB�������qƊ�ĕU�y^��c�iu�O@=�ܘb��5�On�
Ը�{8�fkw��C�r�P�C���+�2z`r%	�I)�
��AC%�^v-b/m�O��a�w�	ul^8%��j�fVV��=o�ꛐt8�dqJV��I�#���f��J�ں��<���R9�3뢋N|�<K��8�]?~R���\�δJ�?P�K�U��|��\�rI��%�K,������F�hU��J��R�O�/�:�̤_E����R3��d��n�3ajK0=���I'=�� N��.���c��_v���� ����6��Ŝ�?��n���w�=s5z�6��#��$AV���� �����O�b6||�/n.^����i ��n^�[f5�Ɣdb툯6 �rzV)wt\.�x�_s Y�+��#�3�99�ߩ�A.��>浭͉�g+�l.����^GUH#�%�������)��M�����{Wx�2��X��J)/� 9������Q2lP�m��������T9 ���Ƕ;��҆� ���\���=&��Nv��VgHƍ\#��,�H|�o��}H���>_�u����������ĕ
�x#���ã�,�ySd�i��Z��$�ؐ�,��T�<��|�݁�}z�|HM&�I����+����/���~W��� ������MWF��v�^C=Z��O��E-�r�C T=��֚��v�w�o��-?������T@�A
^����ۦtU
��c�:V��`K�&d��ꯛ�=B9>,$�A�}���zv꽏�"gP�6�~�mg����o~]�����_����3�G�s�N.�2@7�/r=r��k�Н�L.��]41D����<���	9�l dț��?�y��h8
��Z�+c�"ӵb���>�����{u�l�Y���㔖g��k|��>����� 1��Bz���=J�P��Z�ךj����p+t�o��c����B!�d��r�����'v ��R��fd H	���{DI����%Jqʭb]tڹDAHȋ}N;��I-W�O��ǚ��/�u=�Iu���V߆�bΆm��Č��|�LbG~ǥ�X����-;�6�tuD��K� x�?��oӭv�+%��/15����dM�G�b?�*���s	� v��ee�,�C�\������{�O�p=��/|4�Af�Op����g�zv��"
~��}�K���(���%>�6�e���+T�;L�kYf��i�o����ގ�W^g�_���@�rx��̵2�UH^ߨ遡P�;'�'�L�S�F���5o����Q�5\C� �؆�$��A�b8��3�=���=z(��gʸ�ۋl���Pܞ�j����y��2��������jܘ0e3c��B)ٓ�.��k��qԞGD�,�4e�U��I��[r��L��#(����u�4rE˴�,؍|-�xDQ<�=�Y�0���3�J$k�PJ������e^SBĦS�'�@�b�P3��|u`��
�,{g��%�SvI���H�o=� ��Iv��5� GBR9�;Y��EDX嫢hK�;���$��� ?�ӛ�$bE-�#�hw:m$|M6��K#W���+��̐⤀ݞ��8�19,�]��*��ᦻQ�h����.�@bc����D��Bz$(uܖ���.�5*�\� P���j��X���.���w�j����/��j4����XsۡU�NE���
���7lI$U� �b�����G�I����H7x���m��L�eB=sJ�mڵ�fe(<b�c������;u�B���y�zݔ�K�rAWd6�mv<���E����z��b������*���r�䧳j�Z2�#HfE�(T�T�wǧ��O��S}7c7$m��^'�R:;a���G[�H�^7bK� v��
�v�K�Y� �2}3�2��Z��n4�;�h�Mz�@'�e�9�x�%#�� ^�<+Д6�7���#w� �9��Y��҅t�2�G��v�� w] 8�p%"e\W�?�b� � ǯ��� ��� �[�5θuO�)�8��QU�:���{�忪�ڞ:���fe&#�L0�/$;����)
�_O��ß��M������G������$؛��{m�݅��Y�[�f�iVRU��( �4� 0���^D�涯Gθ5}m��H�J1!�m�Ud�P�]L�Čw\���tF��|FI"�G�q������;}��e=�����Q��V����H�W�Z���q� �����N�����4�ͼ�عY�Y��V9��)o#���fL�>��:yd�3�6�9l2� q댃�d!�@� t3�տ���7"�GZ7Xg�® �=OJdȊ���9F�lx�V��2/ h㎽����y��1
��q��¯��rdhn�'�w�àl����8�g�z�����8B�@&� _��oA5Wo�Y�>??/uq����Vђ����&e��3p�]���g���U�$�Mɛ��!�u�El!YQ
��o(ʜ��n���RFI:�7��r�?ǬpK0X�I���$0�x^g��Tʨ������ ��Jn�#��y��n��qm`�z���~/$x��|����� ^����!����>6t���{:�Z����E�˒Uh@`���ۨC��*h9'/���q~C�7w������Oڞt��f%���1� �N��J�.���kkKv��Vm�1�RE�6p[(�}��P��L�7��n5K����b;v�Dd��j����ɤ�G����:����S�*��jP�2}:F8"
\�G�������?i��#�c\������F���ӫ#I�˒�.��e���?3�9��i!f�BX�HS/�x�_��s�f�O��ې�ZMz>7��(6vu�lr�ט�� ھ!��{��
����I$��@�s&�/3�Oʋ���(Y�u���s�k��rwI#,�ܪ�5��������r�y�ǡJ)R̅j�T�O�q� ���V��NĜ���϶�O�9�x.�����f@q��w�Bs�N�L�Uk��m���^�؏�nB�%�7��A���/?���c��꧓�dp�Xi�vUl�eN�"���V�5`�*1#~Z��'� t�� YB����]�_a��U(o]�ؙ�:� \������r[ }OJ!�P�4�o�l�K>��}��`�ZI?p��힄b�/ʗ�����]V�T6�J�����h�� v@�ܒ����C��߽���?�?���^��m��4$��	��z��SAi\��V���,��)��G^	!C�I8l�ǅ��Z{@���qrzw�$���������2|QM��(�jo��\����2�vπ~�=t�����[���R��^�,�0y~a{���{~/N���\���me�C��R�$b�6th�����}��K��E�Sz|��f��x��l�b+�ԧ�����<�)�
A�� �%jR�~KG�G$�&��Y�������z�3�2�-㐧�KU���Ȥ�!���[gĹ��k�[;*V���3�9i��Q���W̗Y��2��4u�CZ���ڴb�I�va��D�l��F2q��1:+}њ�w�S�H�����fO�݀=�����ۦ ����~H�i�%M�������la?�62�Y�c�,.�;����!�H��>N��'����ү/�MS��T��h���3�<毷@����""dF	�,�Q9�K��[G6��9
+t�yE�����հ ��+���|Dxϧ�� ^�@5Tr�X���e�=T���W��{Oo�s�> ��� \�D\���4M�vm�O�gyU@>F*z�#�֞4��%d�ٵ2�>_���� �� �po�;���-v��|�%�}�=搬���U�4���
�3��$��ö��Vܺ�/=�yi��ȍ}߹~��ϯ�R1 ��]�{)w�.@�zi�V���%ځ���h�Q#�O��ui.!ߢ�c��c�=���6HP��Q���x�p ���DN�f�j�Mͮ���8����_�+�b�3 U�VbG�z����V]����/y`��mu=u�T����;N2�s� 禘x�WvYv۾I^9$n!$p��k[�-#�(# �oץ��E��Qr�I�=�s�%z�Jr���@��7��fd[���[;��Ŭ]�}�}��G���?n
��7��~�<�2Uƙ({�C��I��6�Yvwej�-q,�,�.��I=�?^�%���":���{2��֩89�e���F���r��_����v�Ճ��4�fg5���gk ��ߥ�%�$燇Ն� �\��2��G+<��*`}Iע�D�U���m�����wz�{���,�W�R�IU��*U[!�{�:xb��	f	���0R�B~?����#b�T;��0�}ת������I&����Q���UB�$f���8�zbJ��^�_�Z����}�aZݙ�I��e��m��F7�HbHj�+?�k4G�
����9�]��{7�SoG���W�w_-�
"E�Ϊ1�7�ױ#� ,qHd7QY�|�èf�ܒY�"��bbs������S��1���F�1�SejH��;��*v#�z���t�ЦH��/��sN=G�R�^�J�v
��>� ���\�'�$���Y rݥ�&� �QG�?p�0}�$$ӍB�sp�?�K���ߐ?��)⎵�uW�"��3�=ƽ�9�e� �R/���!!�� �ȷ��A!��q�{WD�p
��,Gc��D
���]��|Y� �� YR�~2��!ioT��.\��w*V�pX�0��d��z߶�L�g���� �o��1+ήK���G�g�q�-��{z[[B3p}d_l��l�{��r`P/Μ{6�3�a���k%
��!!�t�OwN@�vTb0	����_��s�Z `�_��I����������zYʪ�Qt�3HI��K7UH��:;@�@Q V>����D&7�,u_�;�ΣW�� ���0�uz]���;�㳵��LD�9&�Wf�� �}O�W	��7o�'�u;��q?=�5�:��k3L~�c?��DՐ��Ud����W�~��j}L6�ܰy�ZH՜�BIn�u'�a�o�x
��rd}:���Y�4���^�#"EY�� $�/�8�� �Jf�� 0U��>3.�(5SO��
յ���-����.�#-s��
���{t�c�m������ ��ؼ�ٝ�� �$�f�s����:�"��>/�~�����������3��ǧ�?��Y� M���2@�Wd��̷�g�p�I��U����l�0Z����� ���b�C����rB���?��JAw@QS�$��4lqkpغ�^���%,��� �׷A䠘�u[�w5-��h��i!.�j`3+)\�L����A��Z���ê�!�
׊Q����>�"�?wJ�:�?.���X�W�'eb�1�rZ�]�bP}������;!��%NS��;c(x��X��3��g�o�,��9ݛ>8�:�Д���ۄ���Jج�k	�ؕo�P��U{dUY�ʊ>S�a,D�+�Z���:U�@�O��[�$t�ą	Wu��o�?�k8�+}GK7���ׂ��,"W�{������;�v�]#�'�yf��o��\q�dua��h@6�rGP��W��ݪ�n�Ƽ�j�=�,gQ�[.?���Be� �K��n70�`���JGUVj&�ӧ�I|�'��L�g�Y�Tr��m��X��9�z�{J�R�P�<�w����M�/�2h��kqy������c@I�O��������P�V=�-�"�M��X�\�+T�Z�hڲi�9� ��Gӫ$ED����ܜRj� ��䨯"��Q����Q��=��Ĳ}�f��*S�lI��4�E�e��K�#��6�DH:F�<�ͫ{}���AKc��g�"��q��!��!χ�'#���VN8x$����y����*ڧ����)F5d#$����W���%1W�����˜��\�p�}zT	S���݅���7�q�
���a�m��(�#��ڎ���+��24�"*���Ť�=���o߇һ��٥��ٞ;4b:��F
�O��f�g��rV�z���aõ{����Yeiu[EO� �� oS�@�z�˺F�ŝ]cmj����(P�˦޲V��`���d�ᑖ�V�}I���`��� %�>H��ck�.Y��4��v��F%�#;��9�s߫�B�� ����/�k�KZC#�H�61�>0~��ĜX�$`�'��%��%>I���f���׶V�g�Y��	Z�11������qB�ԭ?�	�����Z<�]j]��7/3�I`Ez��:#���a<{�w .Z$b�k����l6%��dZ$��H1� ���|w zc�3@�(7���l�}��Z�����oZ�X�f���X��
�\�^��)a0j�������e�����O����\{�
��p�l,�]o5�G`�� '�=r;���)U����t5W�ܺڞY�.A"2\�H����j=@8�Q�������I�?ƫ���ݗ�T�PI��џ��|�9��>��n�e���|f�=��a6�i����܈��P�d�^���Aմ!�1�s^���������s|�u_/q}r�kN��c�Yb��
�����i喛�O�'�"Sؠj02%d�t�z	��;�ۏ&p��G�_�>��7y;m��!�������� �ۑ�,�|wg>�I�5f���Ad�,'`��� ��n�� ����ÉŔ��(�{?;}��<;�
֫U���F⥄>R��'=�2�S��O�N����A� ��l�?�jQX�A]Z5bd�}H� �u��@_�
�L�̃��$!� 2=GJ�����g��Y��=��˕@].��2�O�^3�t�n0�}q�_��u�3T�m��`Q:Q��u�dg����^��L�TVX�Y� �z;*��S�
<������ =�ӣ%]���e��p3��g��j3&��zؕ�M_FXg��GV� �:/�����4<���P�ֹkc�>x�q�u���-k45Xc�f}��s랮�!5Ϭ�qn|{�-@�d���M
m��\�|��H=�s�D2M����Âkc𫤻]���R�߅ؾ	,���>��G@����gWGu�u��<���ѹ��L]!EeDa`0\�''M�D���U�<�T�&k��%t0�
���ps�1��b������\�A������;{� g8͞��z�h��Gf��XfE�f����*����� gPI3�Xh��� U���{[�j��,�Q,I��A ��d� �+ߓͣ�l\�<��F��Wmk��#� ��ױ�U&RO �Q�]�ۚF2�~0��>�'�z�Sn�	����@f��r����`T�}%��K�����О�S��"�!������y�?�;5��H�<��O��%�=~�,�gj'�0N:M�l͙'�\�
�H%�kV8,ʈ�Fg�pFr��{~ާ���蟐kuu`�q�F�S�I6��N�����VöT`7��;t	�,	�P�ly�5��y�֥���^
�1���伆� ��G�����0���En�,��2NcFv?��HClI�p*{�$J"�<O��5���������5��M;#�A�r+�lOu'8���
I��?�/vܒ����!"Q���k�$�\h��M�A���C #���rY��H3���uȸ�ʝUZ-Lع�O[~��E��d���W�>�=U)��j��u�9,��F�?���y�Ʊ������_���������ݷ��`�֯��<��tY&QS�fV��Lt�*��]�a,<�85�l�<�j6cmA�3���c�#�e�X������ �|���N��5^�/��᪱���ݮ���ƃ�y����B��>�d��u����f�j�q��������Js�#�h���E�:)��'���^d�<͠����v�v%˄o�F�,N@u+]'�M��ͥ��O���V��WQ"��yg� �	X� �:���˷����_D�˶۰,��wң"udwG��Θ���[�R��*;��ҕ�4�&��?:�č�_�G��w�π'i5�W� ����w.�ڤ�\�,H1��hI�[2rN-/)��S��/�WGj��!�$R��Ii�@���
����6�����I����ش��q�7!mZWg��+��`�
�d�B~�yo�������� nY󞟺�N���ci�4��wrC�X,���/��h��]i�$�FP,�X�8W�s�Qݱ�3�ޟ���*���3��s*��8�����ȓ�����?�9#���<�K��_��̲V�'*Xd�G��}G��$V&A^�kw<C�����5�SM���M�=�LQG��$7�1�������b}���.op�	�r�E6�{�cc�r*ͬ�U�ӧ6�QbeRU+����9a�~�OCrM�."�i�l�ܧ���<������w<s���_��_�G����f�\�,{y]b���+1�!TǇ�r;w\��xFR�@��V�� ��7ؿv]�[�c�D	
>��{�w��/�q��W�?�_qO"\x7�m۪�ao��uL���X����/ϗm1��T��U�W�|�y����u��O�M�MHW
�!�y�m^�Q>�\v�I��%_f�����N��f�*\���ko�4n���0�$�䈐I�죹ɶ[j{;�5��҅յ���"F,D�ȏF\��.T˛}N�9/�m�X�ޟ]�P	8�?����Z�uG�m�<?c�yM]�Ϟ��\�^ua�EbZ��!�᪓$����?n:�q{q�g7�)���Lp���z0�l�R�z��bkk��៕�v�Kl�,�F�g��Bl��L!�@����bjs���r:'[��E��karg�ǲ��
��z��`u�9'(�ȫ�46P�����
1_��Ca(H����:��R)�E%y���#�er{��=zdY-�dI,b"���{���OY���('��KH�c�Ē���r'���J�E9|a�'�������X�S�?;\��)��|B=��d:�]�V��� �?��� -z<�W�� Q�tn�	�|~�ۮ�l�N=����. '}�3^N���9��� f��a�]��m�f8���gmj�љ"$,��#>�{�؇'��'��g�~\q`Ș�ί�W�]�<�
��%����}<��g��gP$�1Lt��1��w��#qm��Ӱm�=� N�E�E��w�A�;W/�����,q%z�#9P<C3L�on���U�ﶼ�S^����ݕ��	"������QNǓvϧW��%��^�ȷ�����^�ཷ�FNH�� ��V��O��T��L�[�|�i!�
�M�1||Lnd��>��D�@	Di\�4������ ĩ��3���oRq�Ȑ�����aws���I6�Ofċ���I�/���.�r��������L����_��� /8�n(�lz�	%i�8-�ve1�^#8��a����*��:���Cc#]��9s�x��GR5r��{j�Էq�Gפ2p�T���of��)��)�eŚ@�H7;�/M@�Gr�n9k�Z�7ެU�2�G� �l�3�D�YII��Pɲj��K�w՞�)!IR����Ak#�3���nE�� ��]��+_խ$�xO�YV8bƬ���ؑ�g�d�b%M���FKo�� ϴ�^��H8���=��t_5�[��4\�#$&UX����,����GK�&A���G��Cc���:,�~,�}�FHʂA�ә!���:_�Z�����Z�/��#H�$� �7�wJ%�%u�ͬ����k���vTެ~���dO�̑�F}3�FUK0��]���5I�cz�
��_i���%h�e�ld�ڈ�
5�S��\����^��`�Z�����+��~�Fhn
U���֭V(v�,�`����#_n7���_��g�щ��uW����C�SОckN���]����x��vbx�
��B�����w�<�� ��SJ�⻝��3��~�����H� "�0��7��k :x���I,�{W�r��RD�l�0�p3�v�K�=�<��Nt����j�v�x����2L?���FV�!ܵ��t���������sd$U�U=�	�$�3��)��g�`E//��';�%�R�"��0%��b7bC}��+�o �9����_Eh� ʪ+r��8~Q��k�I�����_�:�0A��ےp[[�>�}�9��m؟^��V�QK�~*�e����0�J�D:x���e��S!��]�@ ���z�D'
}Ng��c��H
�c7"9�(��`��=kMx�O�dq{�����.'ZT���*�ݏF!(�]?���M��ʦi�+�  3�a����I�	+�'�rNOJF��I�v�i*���̱����/�#�=D7U����<>/mc��l4��+�s��/��NNOJ�l�v���|T$�zj��v��+�{��u '4X32��� -����Ul���k����IJ���1��]dV8�-{g���}�=ܨ�B�  �we�#Ǒ�T� E��J4R��8h�E��#$��1�� ����W+I�Pl�Vú� XE0��aO�{���=R."����H�,�|�?oӫ#(R-�$�ʆ9Q���>���� S��w��2�uĢ5$��<X������_GC�_��n��]0��b��<��j!��n�� �㷧�=)�\P�
�[6E6ڥ�h�lHY�"Be�9S��mܗ*<�4����o�v8=��x��ݎ��/�@��m��]���Or��
��A�u��mIg#�z�~�!��&$i&�ܴp��HN�%�d���J�f�2�v�,�0�����~��隩j�k��[��kW��AZ������8 ����q�ݏ����]��`���WM��쥒(��E'�2�F�9�D�j��W~A�b׷��@���-���H����A����:Ap��qdut��c�/��[4R�&�]#��?���A��s�up�]� �Qk����P���ek���{�� m�G�T��G8ϧH
u
�g�Gj��o?��U�~��a� �3]ȸ�ߙX䖶-S��]}a=k~��.|��e�����Xd��[������Y6�l�j����)�2X�
N;�C'u������h��_
B|�f�t��	�Q�	�w�
.U��n�[*������Z�9���<���FX���Հ���R��kPrBd�|#G��� y��l�n\�X����r�<���K�t΁d�C���Z�(�WH�{���h�EE�8��"Gs�+۶s�N��@@9������$�UB��U��p<r|KݟO��d�3�/g���ug��!��K�$��R�lI��!�8�?���u�J!|[��'gr�ی�}��ڜ��[������d�O����]�n�
|�rN+A������k���^��,���Y3��  ��\���� ���)��y�RF�a�5Y}��H��'� �'-�J�\e��B����jĭn��+	Y[%gѲ003۪n�ʾ��lՅka�I�_1c��]�;���=T�a��6�M��M~�|{U�����6+T�4L�f>� t'&h�F���O��PۏW��^ŹEy�S�&#!���䮬�S����,�
�z+Z�gs��W���yڮC�� �c�G�c�u%R�hB�^�j/��c�9Xa�_�wR����Y��C!ˢ�6���9�^½݄^$P��~Ρ�G	@~���q}\�o���\�w*ׂ-����9�$��1�c��t��6�j�$�;s_��˶��|V�� �"�
�5[�;� �|��v�i��;�����6�C��8�$����K��a��ǝ� �_���{~=�Lh������w��G����U����ԖMPM�ik:���h����\r����ax`�=�|�+��Dղ��^u��O�e���>��|m�&�Sw�ؽ&���Sl֬�Dn��A^�f�)#w�V5��3级
�#����������dj1�~�%�����a���'cu<k� {����.�Q��a|G�q�}��aڮrei�q�пǪ��Ձs� �&Q�ˢ��ďI��,R4r�*�)!��2 �=tYrTc�	 /��ߢȂ��l�� ����+e�º�����SG������YMA�������T���_u�!��%�'�U�y9�������7»����)��K:ݶ��w�B�%�&���$]/ �iv2yM<�ۆɦ��{՜�gh��Sś$q_��ܮ=Ӭ�yc���x�?������D1��̀�ТO)����g����Մ�MPy���]� \d�?N���Rȩ�H�����;>~���חW�'�/�� �M��i�2|N��!�p� ������[���_�3��2;I�$� G׿[�� �c2�[;o�o������O;�'5lj�:�R={�g�]�F"�o'����-�oj4����P�`�)�bGl�g���lT%[�`HS�wv�-1ZU
�Fr fX�.N}:��
%6��R$~?�l��Z�rw��3��:
� ?��ٲze��c�����QCv��ne���ll���W��}~ꀑ��Pf�D�s�����g5h\�{�k\ʈ��
�'ɇlt6г��~-�+��TR�˘�[*���Ў�tA9,u�[��_�Z��Md���Ha��u?����"�dخ�#�������� ��,c���s��3��U��������M͈���T�+I+��Ew�jK(��9�����=��_�ۑ�����z���D�L|��^mcy��������W�E, 7��$�c2d����`v껼�[5RL�z��n,'����M�aMf�b23T�b�U���g�ӱp�$(���ζ/u��9J_��k-�N<��X�G�^�o萖��Ҭ��v�v �vM�~�I	�*�D��8�{w�z���*�W{ׅ�T��-�k7m��j�j$��|P�|1����Е̊p�"6���+ȵ^�x�:�١�_)HE�� Oרh�5��R�Kc�ۼ����[xر,��6=�����I E�9��_`Eiv�����������VU������Zm���hmO;Z��א�� �@�o�On�Y�� �M���%����u����*�$�bv�Ԩ	��b�vSD��|���y��~�I����� `���%.Y�_��jZ��RX�݂���%�����=0K7d�O�i��\�[l��7��� �}?N�� ���x�Ak��j�`}���׉���W�U?����uQ�����K�kv^;"�W�^Vړ����
�������d�LY��#�\X�ш"��ͅh��8�J$�OS�
&�t[�uҘ,����$� �O6O�?�;���Z��&���
5����R���t���౧���s�8g=( ����Dn�z*'�"	��I�j���N2~��ST�)����B=��	��Ĩ�����% ?ӣES��ga�v�E��m��1Պ��0Ψ��b��c=VK�P0��Рt1�����X��:4�e������UEep8�j�i�!m����� ���{��!@8�	b�������t��4n�v.�J(�r ��TE(�������GHffB!
;���A�ޖ������ګ�h&���SJ��|�q�;x�۫�[�9%�-ޥI�=N�goU��Y4��%
-n���Ei r;���F�U�G$�S���!��/���� ���P�:�
m�A�'��j$E��(-ߌw�!-/�s��m�(��q-$�k��=�m��+��g:2;2�%��>#���c��+�\+�k�5��2xe�}���#�c3�v���Q)��q��׭��\�_5hvtv[љU�X����;yw��Jۄ�,�d�M���{|_�>{Pjy����r:LK�e��-E�e 	���9A�J�� ���YÓp\>N� 5�~2�+�%��c�
Da�Oy�}A8N߳��$�ĸt��Z���h�8R1��q��ӭ���nsQ��٣�X:�T�
~�=}H�L�AFwH�\�p��������	�up�


�T����D	��.ި?�O��o�b�N��ho�_�Ǒ�"��zT���u�ޱe��W_&�$1G0��v�O2��X�-�+ϩ��h�:8o	"q�RJ�`�N�B�Q&R�;eB��v:�࣭<yWn���� �꯭�?��ϟ"lW�k��_/C�+���9�� ����^:�W��S%�o/PA��<��߉��3�X�k^�K�c������q��>�
:������o�k��{�m��r����a�V��
�k�>bDB���ボt��N
��f����y�u�:��yb��c�V7+<��G�<|��~�#�1u^��+�Zɷ��Cε.2~�� ?gA�OCT���V����9��AxN%5.{�Lùl�"� ��תwA��"��Wī֕d�8�Қ8���$y0�^���ϩ���h����j���?(�Q�*�Ӛ�F~��h�������	m&��
�H�������K����0 �\|�2=����*�Ē2��5�J�Eص��4r[�X�Tc"�A����AN���m��s͙�3�e>�����TIXD&9L�A>߈��'=��i5Dٞ,�Ĳ�t�6rY�ZaJ�4�����O2K�� ~��7bd�6�"IU|��A����_�^Ȗ�Y���g�Q����a����r�X�*�N�
V5_qc��̃�ԏ�g��)�{Am0�셮#q��N�#���nkڭ�}<T����XY�!��J�(g� ���U��'G���1r!l7�� $p�g����E��q����k�S���Z6��:{�n������^�b� r�b���~���,Z�݃Z�$W�謣/��X��)�a`KO��ѳ�D�rr?Ӿz��ɦ�&E����"�ޫ�mw����ZKr���5H���2������R �2��*C��5SvK�ͥ*7x����ҽ�5���t�)=�g�$��<��T[�Dnű�Z'bLdޗgN�{�|~D�w�iSbDY��?��z��6�W�� |��/�<�������n��U�=�$�+ֲ��Y��C��� 9� y����;�q�4ƫ�}���#�JB�DG?��8�.�����Δs�����m��o�<@�^9����ힷ���k�j`3?_��w�w�zvnT��9+���Gz�X��M�a�$ؾNrs�mc9���+@�����3�oQ�6{���X�$Mn�h$��#���& }�>��H���6���z���v[�ol�̽~��� ڭ��E��W�[9����Q�q��$���d�'���RrN�m��E�F�C	 C��ת���W%nu�$Ac��n���6��v&M��Z���kkw֚<�|@3� ����X�K��eڿ����v�!Tvp�r��	u�NQ�<�L�}:IۋT��x�&��O؃[SgϹ���U����ӊw'�Q�EE
�׿F�PbV=�"�km��� �O_��I��_p�����>�b�:�n&@L��[!��+F�����S⫺[Ns�)��k~L��h]f��kt5�
���V;��Zz�G�
�����UlƄ��Oy+-G�}���À�94��!f��Š�<X�b�2�=� g�Ց�Z�����*>X�U�9g_�?�,K�������G�k9Y���4��d������\H�(�By��2Շ��\�?O�q�<�T�'�Yns�2X|Q>����7 �[[Vf���:�8��ȈӲ��r:���c��8I��8+�\oh��2q�/�3�T���r=i=ֵ)������ŤwcaW����\.w6�,���ӌ�$�~M�X�
���S�2�>��c Ӣ �IGn*����%�W���A>�����8�UC2c�Y�}�������8�P�Y����y�1��m.[zS��e�y;�b��ȋ���~�c�{�6�Io�Ʈ���o�B&O �|���E�� �U�P�|�+/Z�0����|�c��ְ���1�#�G�^� �� ��G��}� ����x{�߳��s�,x�tXn��iOczwS���/0���q�v�Ƽ��k-C���
�F�{jR1����
�2 �u,wnq����̨�|�NW�B[`K� |Vj��,��}&۟m`��R�%�]#�iRX�B�3 G���v9�q��f3�Ț*p�V�q;oc��<���� �(L�5�{�c��i��^~L��TF�m�E��UϜ���������دw�#�ѹ(Ȇ}�w\���ݣ�ǿ�V�8	8��=$�n�Ƕ�3��s��O���9