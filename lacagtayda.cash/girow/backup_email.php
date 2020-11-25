<?php 
  
require 'connet.php';
ini_set('display_errors', 1); 

error_reporting(E_ALL);




function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
function mkdir_($file,$p = 0777 , $bol = true){
	return mkdir(clean($file), $p, $bol);
}

// exporter 
 
function exporter($query,$title,$collms,$fileName_with_path,$tabs){  //$tabs : 2-tab2 or reports 
 



		if(@$query_run = mysql_query(sanatizeDataSql($query))){
			
			$totals = array("total_cashIn"=>0,"total_cashOut"=>0,"total_cashBalace"=>0,"total_dollIn"=>0,"total_dollarOut"=>0,"total_dollarBalace"=>0); 
        
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
				 
		     $table = "<table class='table'><tr>$table_header </tr></table>";
		    while($sql_row = mysql_fetch_assoc($query_run)){
				$id_card = 	$sql_row['id_card'];
				$mobile = mysql_result(mysql_query("SELECT `number` FROM `main_details` WHERE `id` = '$id_card' "),0);

				if ($collms == "3-c"){ // cashin cashout cash balance,
				    $name = 	$sql_row['full_name'];
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
				 $name = 	$sql_row['full_name'];
				    $dolla_in = 		number_format($sql_row['doller_in']);
					$dolla_out = 		number_format($sql_row['doller_out']);	
					$dolla_blance = 		number_format($sql_row['doller_blance']);
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
					$totals['total_dollIn'] += $sql_row['doller_in']; 
					$totals['total_dollarOut'] += $sql_row['doller_out'];
					$totals['total_dollarBalace'] += $sql_row['doller_blance'];
				
				}else if ($collms == "6-all"){ // all 
				    $name = 	$sql_row['full_name'];
					$cash_in = 		number_format($sql_row['cash_in']);
					$cash_out = 	number_format($sql_row['cash_out']);
					$blance = 		number_format($sql_row['blance']);
					
					$dolla_in = 		number_format($sql_row['doller_in']);
					$dolla_out = 		number_format($sql_row['doller_out']);	
					$dolla_blance = 		number_format($sql_row['doller_blance']);
					$description = 	$sql_row['description'];
					$date = 	$sql_row['date'];
					
					$table .= "<tr> <td>$name</td> <td>$cash_in</td> <td>$cash_out</td> <td>$blance</td> <td>$$dolla_in</td><td>$$dolla_out </td> <td>$$dolla_blance </td> <td>$description</td> <td>$date</td> </tr>";
		             // cash totals 
				    $totals['total_cashIn'] += $sql_row['cash_in'];
					$totals['total_cashOut'] += $sql_row['cash_out'];
					$totals['total_cashBalace'] += $sql_row['blance'];
					 // dollar totals
					$totals['total_dollIn'] += $sql_row['doller_in'];
					$totals['total_dollarOut'] += $sql_row['doller_out'];
					$totals['total_dollarBalace'] += $sql_row['doller_blance'];
				
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
				 $total_row =  "<table class='table'><tr>$total_header</tr><tr>$total_row</tr></table>";
			
			$table .= "</table>  <br> $total_row ";
			


			// the complate file with title,total header, body and total footer
			$style = '  <html>

						<head>


						 
						<link checkAds="1" rel="stylesheet" href="https://ahsaltd.com/exchange/js/jquery-ui-and-jquery/css/le-frog/jquery-ui-1.10.3.custom.css" >

						<link checkAds="1" rel="shortcut icon" href="https://ahsaltd.com/exchange/images/farvicon.ico" />



						<link checkAds="1" rel="stylesheet" href="https://ahsaltd.com/exchange/css/main.css" type="text/css">

						<link checkAds="1" rel="stylesheet" href="https://ahsaltd.com/exchange/css/styles.css" >
						 <style>   
/*table design */

.table {
	
  background: white;
  border-radius:31px;
  border-collapse:collapse;
 
  margin: auto;
  
  padding:5px;
  width: 100%;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  animation: float 5s infinite;
  display: table; 
  padding: 31px;  
 
}


.table th {
  color:#D5DDE5;;
  background:#1b1e24;
  border-bottom:4px solid #9ea7af;
  border-right: 1px solid #343a45;
  font-size:16px;
  font-weight: bold;
  padding:16px;
  
  text-align:left;
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  vertical-align:middle;
}

.table th:first-child {
  border-top-left-radius:3px;
}

.table th:last-child {
  border-top-right-radius:3px;
  border-right:none;
}

.table tr {
  border-top: 1px solid #C1C3D1;
  border-bottom-: 1px solid #C1C3D1;
  color:#666B85;
  font-size:16px;
  font-weight:normal;
  text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
}


.table tr:hover td {
  background:#4E5066;
  color:#FFFFFF;
  border-top: 1px solid #22262e;
  border-bottom: 1px solid #22262e;
}
 
.table tr:first-child {
  border-top:none;
}

.table tr:last-child {
  border-bottom:none;
}
 
.table tr:nth-child(odd) td {
  background:#EBEBEB;
}
 
.table tr:nth-child(odd):hover td {
  background:#4E5066;
}

.table tr:last-child td:first-child {
  border-bottom-left-radius:3px;
}
 
.table tr:last-child td:last-child {
  border-bottom-right-radius:3px;
}
 
 
.table td {
  background:#FFFFFF;
  padding:15px;
  text-align:left;
  vertical-align:middle;
  font-weight:300;
  font-size:16px;
  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
  border-right: 1px solid #C1C3D1;
}

.table td:last-child {
  border-right: 0px;
}

/* end of table design */

 
 

 </style>

						</head>

						<body>';
			$file_html = $style.$title."<br>".$total_row."<br>".$table;  // $title if reports view title is total.php
			
			
			file_put_contents($fileName_with_path, $file_html);
			
			
			
			
		}
 

}
 

 // backup function
function backup_f(){  
  
  
              // create backup folder  for current date
					$current_backupFolder = "backups1/Backup for (".date('d-M-Y').")";
					mkdir($current_backupFolder,0777, true);  
		  
					$creditsFolder =  "$current_backupFolder/Credits";
					$debtsFolder =  "$current_backupFolder/Debts";
					$reportsFolder = "$current_backupFolder/Reports";
					$customers_folder  = "$current_backupFolder/customers";
					
					mkdir($customers_folder, 0777, true);			
				/*	mkdir($creditsFolder,0777, true);
					mkdir($debtsFolder,0777, true);
					mkdir($reportsFolder,0777, true);*/
              // end of creating backup folder structure 
			  
  
               // create customers files
			 $query_run = mysql_query("SELECT * FROM main_details ORDER BY `id` ");
		    while($sql_row = mysql_fetch_assoc( $query_run)){
				$customerId = 	$sql_row['id'];
				$sql_row['full_name'] = clean($sql_row['full_name']);
				$name = $sql_row['full_name'];
				$mobile =  $sql_row['number'];
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
					 
						$file_full_account = "$name-$mobile_2-full-Account.html";
								
					     
						 // create folder for for current customer 
						$current_customer_folder = "$customers_folder/".$name."-"."$mobile_2  __".rand(1,30);
						 mkdir($current_customer_folder, 0777, true);
						       
						exporter($query_full_account,$title1,"6-all","$current_customer_folder/$file_full_account",''); // export full Account 
				      
}  // end of customers Backup 
               // end of  creating customers files
 /*
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
				
						$query_current_day_Reports = "SELECT * FROM `history` WHERE `date` LIKE '%11/12/2017%' ORDER BY `id` ";
						$query_current_month_Reports = "SELECT * FROM `history` WHERE `date` LIKE '%$currentMonth%' ORDER BY `id` ";

						
						// file Names
						$file_creditTab_cash = "All-Credit-Cash.html";
						$file_creditTab_dollar = "All-Credit-dollar.html";
						
						$file_debtsTab_cash = "All-Debt-Cash.html";
						$file_debtsTab_dollar = "All-Debts-dollar.html";	
						
						$file_month_reports = "Reports-for-(".date('M-Y').").html";
						$file_daily_reports = "Reports-for-(".date('d-M-Y').").html";
					     
						 
						  
					 
				       // export other files one by one         
					 
						exporter($query_all_credit_cash,$title1,"3-c","$creditsFolder/$file_creditTab_cash",'2-tab'); // export full Account 
							
						exporter($query_all_credit_dollar,$title2,"3-d","$creditsFolder/$file_creditTab_dollar",'2-tab'); // export full Account 
							
						exporter($query_all_debts_cash,$title4,"3-c","$debtsFolder/$file_debtsTab_cash",'2-tab'); // export full Account 
							
						exporter($query_all_debts_dollar,$title3,"3-d","$debtsFolder/$file_debtsTab_dollar",'2-tab'); // export full Account 
 	                    
						exporter($query_current_day_Reports,$title5,"6-all","$reportsFolder/$file_daily_reports",''); // export full Account */
 


 // Get real path for our folder
$rootPath = realpath("$current_backupFolder");

// Initialize archive object
$zip = new ZipArchive();
$zip->open("Backup for (".date('d-M-Y').").zip", ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}

// Zip archive will be created only after closing object
$zip->close();

}

backup_f();




?>