<?php

require 'connet.php';
 
 
ini_set('max_execution_time', 300); //300 seconds = 5 minutes

if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
		die();
	
	}



 
  if(if_logged_in() != true){
die();
 }
 
// exporter 
 
function exporter($query,$title,$collms,$fileName_with_path,$tabs){  //$tabs : 2-tab2 or reports 
            
		if(@$query_run = mysql_query($query)){
        


			$totals = array("total_cashIn","total_cashOut","total_cashBalace","total_dollIn","total_dollarOut","total_dollarBalace"); 
        
		  		// if credit and debts tab 
					if($tabs == "2-tab") {
						$toggle_collHeader = "<th> Mobile </th>";
					}else {
						$toggle_collHeader = "<th> Description </th> <th> Date </th>";
					}
		 		
		  
		  
				if ($collms == "3-c"){ // cashin cashout cash balance,
			          $table_header = "<tr><th>Name</th> <th>Cash In</th> <th>Cash Out</th> <th>Cash Balance</th> $toggle_collHeader </tr>";
				 }else if ($collms == "3-d"){ // dollar in, dollar out, dollar balance
                      $table_header = "<tr><th>Name </th> <th>Dollar In</th> <th>Dollar Out</th> <th>Dollar Balance</th> $toggle_collHeader </tr>";	
				 }else if ($collms == "6-all"){ // all 
				      $table_header = "<tr><th>Name </th> <th>Cash In </th> <th> Cash Out </th> <th> Cash Balance </th> <th>Dollar In </th> <th>Dollar Out</th> <th>Dollar Balance</th> $toggle_collHeader  </tr>";
				 }
		     $row_no = 0;
			 $loopName = '';
		     $table .= '<table class="table">'.$table_header.'';
			 $tableInt = 1;
		    while($sql_row = mysql_fetch_assoc($query_run)){
					$name = 	$sql_row['full_name'];
					$cash_in = 		number_format($sql_row['cash_in']);
					$cash_out = 	number_format($sql_row['cash_out']);
					$blance = 		number_format($sql_row['blance']);
				 
					$dolla_in = 		number_format($sql_row['doller_in']);
					$dolla_out = 	number_format($sql_row['doller_out']);
					$dolla_blance = 		number_format($sql_row['doller_blance']);
					
				    $row_no += 1;
				 
				if ($collms == "3-c"){ // cashin cashout cash balance,
				    
 		
						// if credit and debts tab 
					if($tabs == "2-tab") {
						$mobile = 	$sql_row['number']; 
						$toggle_collms = "<td>$mobile</td>";
						$loopName  = "Customers";
					}else {
					     $description = 	$sql_row['description'];
                         $date =  explode('@',$sql_row['date']);						
						$toggle_collms = "<td>$description</td> <td>".$date[0]."</td>";
						 $loopName  = "Transactions";
					}
					
		 		
					
					$table .= "<tr><td>$name</td> <td>$cash_in</td> <td>$cash_out</td> <td style='font-weight:bold;color:blue;'>$blance</td> $toggle_collms<tr>";
		        



				  // cash totals 
				    $totals['total_cashIn'] += $sql_row['cash_in'];
					$totals['total_cashOut'] += $sql_row['cash_out'];
					$totals['total_cashBalace'] += $sql_row['cash_in'] - $sql_row['cash_out'];
				 
					
				}else if ($collms == "3-d"){ // dollar in, dollar out, dollar balance

					
					// if credit and debts tab 
					if($tabs == "2-tab") {
						
						$mobile = 	$sql_row['number'];
						$toggle_collms = "<td>$mobile</td>";
											 // dollar totals
						$loopName  = "Customers";
					}else {
						$description = 	$sql_row['description'];
						$date =  explode('@',$sql_row['date']);						
						$toggle_collms = "<td>$description</td> <td>".$date[0]."</td>";
                          $loopName  = "Transactions";
					}
				 
					$table .= "<tr> <td>$name</td> <td>$$dolla_in</td><td>$$dolla_out </td> <td style='font-weight:bold;color:blue;' >$$dolla_blance </td> $toggle_collms <tr>";
		            $totals['total_dollIn'] += $sql_row['doller_in']; 
					$totals['total_dollarOut'] += $sql_row['doller_out'];
					$totals['total_dollarBalace'] += $sql_row['doller_in'] - $sql_row['doller_out'];

				
				}else if ($collms == "6-all"){ // all 
  
					$description = 	$sql_row['description'];
					$date = 	$sql_row['date'];
					
					
							// if credit and debts tab 
					if($tabs == "2-tab") {
						
						$mobile = 	$sql_row['number'];
						$toggle_collms = "<td>$mobile</td>";
					$loopName  = "Customers";				 

					}else {
						$description = 	$sql_row['description'];
						$date =  explode('@',$sql_row['date']);						
						$toggle_collms = "<td>$description</td> <td>".$date[0]."</td>";
                        $loopName  = "Transactions";
					}
					
					
					$table .= "<tr> <td>$name</td> <td>$cash_in</td> <td>$cash_out</td> <td style='font-weight:bold;color:blue;' >$blance</td> <td>$<b>$dolla_in</b></td><td>$<b>$dolla_out</b></td> <td>$<b style='font-weight:bold;color:blue;' >$dolla_blance</b></td> $toggle_collms <tr>";
		             // cash totals 
				    $totals['total_cashIn'] += $sql_row['cash_in'];
					$totals['total_cashOut'] += $sql_row['cash_out'];
					$totals['total_cashBalace'] += $sql_row['cash_in'] - $sql_row['cash_out'];
					 // dollar totals
					$totals['total_dollIn'] += $sql_row['doller_in'];
					$totals['total_dollarOut'] += $sql_row['doller_out'];
					$totals['total_dollarBalace'] += $sql_row['doller_in'] - $sql_row['doller_out'];
				
				}
				
				
					
					if ($tableInt == 20 ){
						$table  .= $table_header;
						$tableInt = 1;
					}else{
						$tableInt++;
						
					}
					
					
			}
		 
			
                   // create totals table 
				if ($collms == "3-c"){ // cashin cashout cash balance,
			     $total_row =   "<td>".number_format($totals['total_cashIn'])."</td><td>".number_format($totals['total_cashOut'])."</td><td style='font-weight:bold;color:blue;' >".number_format($totals['total_cashBalace'])."</td>";
				 $total_header = "<th>Total Cash In</th> <th> Total Cash Out</th> <th>Total Cash Balance</th>";
				}else if ($collms == "3-d"){ // dollar in, dollar out, dollar balance
                  $total_row =       "<td>$".number_format($totals['total_dollIn'])."</td><td>$".number_format($totals['total_dollarOut'])."</td><td style='font-weight:bold;color:blue;' >$".number_format($totals['total_dollarBalace'])."</td>";
				  $total_header = "<th>Total Dollar In </th> <th>Total Dollar Out</th> <th> Total Dollar Balance</th>";
				}else if ($collms == "6-all"){ // all 
	             $total_row =  "<td>".number_format($totals['total_cashIn'])."</td><td>".number_format($totals['total_cashOut'])."</td><td style='font-weight:bold;color:blue;' >".number_format($totals['total_cashBalace'])."</td><td>$".number_format($totals['total_dollIn'])."</td><td>$".number_format($totals['total_dollarOut'])."</td><td style='font-weight:bold;color:blue;'>$".number_format($totals['total_dollarBalace'])."</td>";
				 $total_header = "<th>Total Cash In</th> <th> Total Cash Out</th> <th>Total Cash Balance</th> <th>Total Dollar In </th> <th>Total Dollar Out</th> <th> Total Dollar Balance</th>";
			}
				 $total_row =  "<table  class='table' ><tr>$total_header</tr><tr>$total_row</tr></table>";
			
			$table .= "</table>";
			
		        // title for reports 
				 if($tabs == 'rep'){
				$date = explode("%",$query);
				$title = get_report_totals($date[1]);
				$total_row1 = '';
				}else{
					$total_row1 = $total_row;
				} 
					
			// the complate file with title,total header, body and total footer
			$cssFile1 = file_get_contents('css/main.css');	//	  main file 
			$cssFiles = $cssFile1.''.file_get_contents('css/styles.css');	// style file 
			
            $counts	 = '<b styl="" style="border-bottom: 2px solid blue; padding: 5px; font-size: 13px;background-color: #fff;">(<b style="color:blue;">'.$row_no.'<b>) '.$loopName.'</b>';
			
			
			$file_html = "<html><head> <style>  
    $cssFiles body{ padding: 10px; background-color: orange;} </style></head> <body> $title<br>$total_row1<br>() $table<br>$total_row</body><html>";  // $title if reports view title is total.php
			 
			 // create the file 
		 
	        
				 
		    $ppp = file_get_contents('from.text');
			// if not from the backup function
			if($ppp != 'bb'){ // replace slashes with dot
	            $folders = explode('/',$fileName_with_path);
				$path =  $folders[0].'/'.$folders[1]; 
				unset($folders[0]); unset($folders[1]);  // remove the path 
				$fileName_with_path = $path.'/'.str_replace("/",'.',implode('/',$folders));
			}else{
				// clear
				 $from = fopen('from.text', "w");
			      fwrite($from, '');
				fclose($from);	
			}
			 
 
					 
 
			 
			 /*
			     // fix slashes in the file name
			    $folders = explode('/',$fileName_with_path);	
				     array_pop($folders); // remove the file name 
 
				$current_path = '';
				foreach($folders as $folderName){
					$folderName = $current_path.$folderName;
					
					if(!file_exists($folderName)){
						mkdir($folderName,0755, true);
						$current_path .= $folderName.'/';  // update path 
					}else{
						$current_path .= $folderName.'/';  // update path 
					}
  	
				}
 	               */
  
				$file_exported = fopen($fileName_with_path.'.html', "w");
			      fwrite($file_exported, $file_html);
				fclose($file_exported);
				 return $fileName_with_path.'.html';
	 
			 
 
		}
 

}
 


 

 // backup function
function backup_f(){
	
	      $from = fopen('from.text', "w");
			      fwrite($from, 'bb');
				fclose($from);
				
				
				
  // Disable the system
			$disableFile = fopen('status.text', "w");
			      fwrite($disableFile, '1');
				fclose($disableFile);
   // end of Disable the system 
  
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
		    while($sql_row = mysql_fetch_assoc(mysql_query("SELECT * FROM `main_details` ORDER BY `id` "))){
				$customerId = 	$sql_row['id'];
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
						$file_all_debt_cash = "$name-$mobile_2-All-Debt-cash.pdf";
						$file_all_debt_dollar = "$name-$mobile_2-All-Debt-dollar.pdf";
						$file_all_credit_cash = "$name-$mobile_2-All-Credit-cash.pdf";
						$file_all_credit_Dollar = "$name-$mobile_2-All-credit-dollar.pdf";
						$file_full_account = "$name-$mobile_2-full-Account.pdf";
								
					     
						 // create folder for for current customer  if does not exists
						$current_customer_folder = "$customers_folder/$name-$mobile_2";
						if(!file_exists($current_customer_folder)){
							mkdir($current_customer_folder, 0755, true);
						}
						 
								
							
								 
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
						$title7 = "<h1> All Customers </h1>";
						// Queries  
						$query_all_customers = "SELECT * FROM `main_details` ORDER BY `full_name`";

						$query_all_credit_cash = "SELECT * FROM `main_details`  WHERE blance NOT LIKE '-%' and blance !='0' ORDER BY `full_name`";
						$query_all_credit_dollar = "SELECT * FROM `main_details`  WHERE doller_blance NOT LIKE '-%' and doller_blance !='0' ORDER BY `full_name`";

						$query_all_debts_cash = "SELECT * FROM `main_details`  WHERE blance like '-%' ORDER BY `full_name`";
						$query_all_debts_dollar = "SELECT * FROM `main_details`  WHERE doller_blance like'-%' ORDER BY `full_name`";				   
				
						$query_current_day_Reports = "SELECT * FROM `history` WHERE `date` LIKE '$currentdayDate%' ORDER BY `id` ";
						$query_current_month_Reports = "SELECT * FROM `history` WHERE `date` LIKE '%$currentMonth%' ORDER BY `id` ";

						
						// file Names
						$file_creditTab_cash = "All-Credit-Cash.pdf";
						$file_all_customers = "All-Customers.pdf";
						$file_creditTab_dollar = "All-Credit-dollar.pdf";
						
						$file_debtsTab_cash = "All-Debt-Cash.pdf";
						$file_debtsTab_dollar = "All-Debts-dollar.pdf";	
						
						$file_month_reports = "Reports-for-(".date('M-Y').").pdf";
						$file_daily_reports = "Reports-for-(".date('d-M-Y').").pdf";
					      
					 
				       // export other files one by one         
					    exporter($query_all_customers,$title5,"6-all","$reportsFolder/$file_all_customers",''); // export full Account 
 
						exporter($query_all_credit_cash,$title1,"3-c","$creditsFolder/$file_creditTab_cash",'2-tab'); // export full Account 
							
						exporter($query_all_credit_dollar,$title2,"3-d","$creditsFolder/$file_creditTab_dollar",'2-tab'); // export full Account 
							
						exporter($query_all_debts_cash,$title4,"3-c","$debtsFolder/$file_debtsTab_cash",'2-tab'); // export full Account 
							
						exporter($query_all_debts_dollar,$title3,"3-d","$debtsFolder/$file_debtsTab_dollar",'2-tab'); // export full Account 
 	                    
						exporter($query_current_month_Reports,$title6,"6-all","$reportsFolder/$file_month_reports",''); // export full Account 
							
						exporter($query_current_day_Reports,$title5,"6-all","$reportsFolder/$file_daily_reports",''); // export full Account 
 




   
				       // upload 
					   
					   
					   
					   
					   // empty "exports/" folder and delete the backup folder in the local
					   
					   
	  // Enable the system
			$disableFile = fopen('includes/status.text', "w");
			      fwrite($disableFile, '');
				fclose($disableFile);
   // end of Enable the system 
  				   
}













?>