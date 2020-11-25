<?php

require 'connet.php';
//error_reporting(E_ALL);

ini_set('max_execution_time', 1800);


  require("others/PHPMailer.php");
  require("others/SMTP.php");



function get_transactions($query_select){

	
						if($query_run = mysql_query($query_select)){
						

													$table_data = '<table class="table"><thead> <tr> <th>Full Name </th><th>Cash In </th><th>Cash Out</th> <th>Cash Balance</th>   <th>Dollar in </th>  <th>Dollar Out</th>  <th>Dollar Balance</th> <th>Description</th>  <th>Date</th> </tr>  </thead> <tbody>';
										
													while($sql_row = mysql_fetch_assoc($query_run)){
													
														$id_c = 	$sql_row['id_card'];
														$id = 	$sql_row['id'];
														$full_name = 	$sql_row['full_name'];
															$cash_in = 		number_format($sql_row['cash_in']);
															$cash_out = 	number_format($sql_row['cash_out']);
															$blance = 		number_format($sql_row['blance']);
															
															
															$doller_in = 		number_format($sql_row['doller_in']);
															$doller_out = 		number_format($sql_row['doller_out']);
															$doller_blance = 		number_format($sql_row['doller_blance']);
															
															
															
															
															
														$description = 		$sql_row['description'];
														$number = 		$sql_row['number'];
														$date = 		$sql_row['date'];
													 	
												
												 $table_data .= '<tr><td  class="namehisy" myid="'.$id_c.'" >'.$full_name.'</td><td>'.$cash_in.' </td><td>'.$cash_out.'</td><td>'.$blance.'</td> <td>$'.$doller_in.'</td> <td>$'.$doller_out.'</td> <td>$'.$doller_blance.'</td>  <td>'.$description.'</td><td><pre> '.$date.'   <a href="#" id="delete_histry" id_crd="'.$id_c.'" delet_hist="'.$id.'"class="button delete"> delete </a></pre></td></tr>'; 
													}
													$table_data .= '</tbody></table>';
													return $table_data;
						}
 
 
}




 
function cust_transations($id){


 $id_2d = $id;
 
  				$nameOfCustom = mysql_result(mysql_query("SELECT `full_name` FROM `main_details` WHERE  `id`=$id "),0); 
					$passsport = mysql_result(mysql_query("SELECT `id_passport` FROM `main_details` WHERE  `id`=$id "),0); 
					$mobile = mysql_result(mysql_query("SELECT `number` FROM `main_details` WHERE  `id`=$id "),0); 
					$mobile_2 = $mobile;
			$main_records  = mysql_fetch_assoc(mysql_query("SELECT * FROM `main_details` WHERE `id`=$id "));
			
		   $mobile = (!empty($mobile))?', Mobile: ('.$mobile.')':'';
		   $passsport = (!empty($passsport))?', ID/Passport: ('.$passsport.')':'';	
			
						
	      	$updateBtn = '<a href="#" style="/* float:right; */padding: 6px;margin-bottom: 3px;width: 116px;text-align: center;margin-left: 113px;/* margin: 5px; */" id="'.$id.'" name="'.$nameOfCustom.'" passsport="'.$passsport.'"  cash_in="'.$main_records['cash_in'].'" cash_out="'.$main_records['cash_out'].'" blance="'.$main_records['blance'].'"     doller_in="'.$main_records['doller_in'].'"  doller_out="'.$main_records['doller_out'].'"  doller_blance="'.$main_records['doller_blance'].'"      number="'.$mobile.'" edit="edit"  class="button edit update_btn">update</a>';	 
	      
		             // exports 
                        $title = '<strong style="color:blue;">'.strtoupper(substr($nameOfCustom, 0, 1)).'</strong>'.substr($nameOfCustom, 1).' <span class="subMobile">'.$mobile.'</span> '.$passsport.'</h3>';

				        $query_full_account = "SELECT * FROM `history` WHERE `id_card`=$id ORDER BY `date` ";
						$query_cash_debts = "SELECT * FROM `history` WHERE `id_card`=$id and blance LIKE \"-%\" ORDER BY `date` ";
						$query_dollar_debts = "SELECT * FROM `history` WHERE `id_card`=$id and doller_blance LIKE \"-%\" ORDER BY `date` ";
						$query_cash_credit = "SELECT * FROM `history` WHERE `id_card`=$id and blance NOT LIKE \"-%\" and blance !=\"0\" ORDER BY `date` ";
						$query_dollar_credit = "SELECT * FROM `history` WHERE `id_card`=$id  and doller_blance NOT LIKE \"-%\" and doller_blance !=\"0\" ORDER BY `date` ";
	
	// export buttons select option
			$exports_selector =  '';	 
	
	// exports
 
 $month_n =  array();
 $arrayIndex = 0;
 
 		 if($query_run = mysql_query("SELECT DISTINCT `months` FROM `history` WHERE `id_card` = $id  order by date ASC")){
		 
					while($sql_row = mysql_fetch_assoc($query_run)){
				       $month_n[$arrayIndex] = strtotime(str_replace('/','-','20/'.$sql_row['months']));
					   $arrayIndex++;
			        }
		 } 

 
 sort($month_n, SORT_NATURAL | SORT_FLAG_CASE);	 
 
 
     	  
	 $table_data = ' <br><hr> <h3 style="margin-left:14%;"><strong style="color:blue;">'.strtoupper(substr($nameOfCustom, 0, 1)).'</strong>'.substr($nameOfCustom, 1).' <span class="subMobile">'.$mobile.'</span> '.$passsport.' '.$updateBtn.' | '.$exports_selector.' </h3>  <hr/>  <table class="table"   > <thead> <tr> <th>Full Name </th><th>Cash In </th><th>Cash Out</th> <th>Cash Balance</th>   <th>Dollar in </th>  <th>Dollar Out</th>  <th>Dollar Balance</th>      <th>Description</th> <th>Date</th> <th>Action</th> </tr>  </thead> <tbody>';
									
        // loob by months			
			foreach($month_n as $month){
				
				$month = date("m/Y",$month);
	 	
						$query_select = "SELECT `description`,`id_card` ,`id`,`full_name`, `cash_in`, `cash_out`, `blance` , `doller_in`,`doller_out`,`doller_blance`,`number`, `date` FROM `history` WHERE `id_card` = $id_2d and months='$month' order by date,id ASC"; 
									
							if($query_run = mysql_query($query_select)){
								
														while($sql_row = mysql_fetch_assoc($query_run)){
														$id = 	$sql_row['id'];
														$id_card = 	$sql_row['id_card'];
														
														$full_name = 	$sql_row['full_name'];
														$cash_in = 		number_format($sql_row['cash_in']);
														$cash_out = 	number_format($sql_row['cash_out']);
														$blance = 		number_format($sql_row['blance']);
														
														
														$doller_in = 		number_format($sql_row['doller_in']);
														$doller_out = 		number_format($sql_row['doller_out']);
														$doller_blance = 		number_format($sql_row['doller_blance']);
														
														
														
														
														
														$description = 		$sql_row['description'];
														$number = 		$sql_row['number'];
														$date = 		$sql_row['date'];

													
														$table_data .= '<tr><td>'.$full_name.'</td><td>'.$cash_in.' </td><td>'.$cash_out.'</td><td>'.$blance.'</td> <td>$'.$doller_in.'</td> <td>$'.$doller_out.'</td> <td>$'.$doller_blance.'</td>  <td>'.$description.'</td><td>'.$date.' </td><td>  <a href="#" id="delete_histry" id_card="'.$id_card.'" delet_hist="'.$id.'"class="button delete"> delete </a></td></tr>'; 
														}
													
											
							}

							
		
		
           }
		   
		   	$table_data .= '</tbody></table>';
			
			
		/* 	    // loob by months			
			foreach($month_n as $month){
				
				$month = date("m/Y",$month);
					echo  "SELECT `description`,`id_card` ,`id`,`full_name`, `cash_in`, `cash_out`, `blance` , `doller_in`,`doller_out`,`doller_blance`,`number`, `date` FROM `history` WHERE `id_card` = $id_2d and months='$month' order by date ASC <br> "; 
				 	
			} */
	 return 	$table_data;
 
}



function clear_local($dir){

 // delete from local server 
 
$di = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
$ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
foreach ( $ri as $file ) {
    $file->isDir() ?  rmdir($file) : unlink($file);
}



}

function exporter(){  
 
 clear_local('backups');

 	$email = mysql_result(mysql_query("select backup_email from login_in limit 1 "), 0);
	

if(empty($email)){   // email 
  mysql_query("ALTER TABLE login_in
ADD backup_email varchar(100); ");

}


	if (empty($email)) {
	    return false;
	    exit();
	}




 // report 

    $headerCss = "<!DOCTYPE html>
<html>
<head>

<style>
  button,a,input,select{ 
  	display:none !important;

  }




#totals div, #totals2 div{
	width:auto; 
    color: #D5DDE5;
    background: #1b1e24;
    border-bottom: 4px solid #9ea7af;
    border-right: 1px solid #343a45;
    font-size: 16px;
    font-weight: bold;
    padding: 16px;
    text-align: left;
    text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    vertical-align: middle;
    display:inline-block;
}


#totals strong, #totals2 strong{
	/* width:700px !important; */
  background: #FFFFFF;
    padding: 15px;
    padding-left:0;
    text-align: left;
    vertical-align: middle;
    font-weight: 300;
    font-size: 16px;
    text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
    border-right: 1px solid #C1C3D1;
}

div#totals  .table tr:hover td ,div#totals2  .table tr:hover td,div#totals  td ,div#totals2  td{
  background:#FFFFFF;
}
div#totals  th ,div#totals2  th{
  width:165px;
}



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
<body>";
 
$footer = "</body>
</html>";


$back_path = 'backup for '.date('d-M-Y');

mkdir("backups/$back_path");
mkdir("backups/$back_path/customers");
mkdir("backups/$back_path/report");

// report


	 
				$r_date = date('d/M/Y');
			$report_html_ = $headerCss.get_report_totals($r_date).get_transactions("select * from history where date like '%$r_date%' ")."<br>".$footer; 

$f = fopen("backups/$back_path/report/report for (".date('d-M-Y').').html', 'w');
	fwrite($f, $report_html_);
fclose($f);



				 


// customer account 
		if($query_run = mysql_query("SELECT `id`, `full_name`, `cash_in`, `cash_out`, `blance`, `doller_in`, `doller_out`, `doller_blance`, `number` FROM `main_details`  ")){

$c = 0;	
//echo mysql_result(mysql_query("select count(id) from main_details"), 0);
//echo mysql_error();
				 while($sql_row = mysql_fetch_assoc($query_run)){
$c++;

  
	            $name = $sql_row['full_name'];
				$mobile =  $sql_row['number'];
 
  
  
	            $cash_in = number_format($sql_row['cash_in']);
				$cash_out =    number_format($sql_row['cash_out']);  
	            $blance =   number_format($sql_row['blance']);

				$doller_in =    number_format($sql_row['doller_in']);
	            $doller_out =   number_format($sql_row['doller_out']);
				$doller_blance =  number_format($sql_row['doller_blance']);
 
					 
				$cust_total = "<div id='totals' > <div>Total Cash In of All months is: <strong style='color:red;'>  $cash_in </strong> </div>  <div>Total Cash Out of All months is: <strong style='color:red;'>  $cash_out</strong> </div>  <div>Total Cash Blance of All months is: <strong style='color:red;'>  $blance</strong> </div>  <br/>  <div>Total Dollar In of All months is: $<strong style='color:red;'>  $doller_in </strong> </div> <div>Total Dollar Out of All months is: $<strong style='color:red;'>$doller_out</strong> </div> <div>Total Dollar Blance of All months is : $<strong style='color:red;'>$doller_blance</strong> </div> </div>";
				

				
				
			
					
	


				$customer_html_ = "<p> backup for (".date('d-M-Y').")  </p>".$cust_total."<br>".cust_transations($sql_row['id']); 


				$customer_html_ = "
								$headerCss

								$customer_html_
								$footer 
								";

$mobile = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', "$mobile");
$name = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', "$name ");

$file = "$name ($mobile) full account (".date('d-M-Y').").html";


$f = fopen("backups/$back_path/customers/$file", 'w');
	fwrite($f, $customer_html_);
fclose($f);
 
 
					} 			 echo mysql_error();

					echo $c.' times';

		}else{
			 echo mysql_error();
		}			


// send 


 
 // Get real path for our folder
$rootPath = realpath("backups/$back_path");

// Initialize archive object
$zip = new ZipArchive();
$zip->open("backups/backup for ".date('d-M-Y').".zip", ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** var SplFileInfo[] $files */
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


	 
 

  $mail = new PHPMailer\PHPMailer\PHPMailer();

 


    $mail->IsSMTP(); // enable SMTP

    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "kunkeen.cash@gmail.com";
    $mail->Password = "5bkUvsmcD.#)Hq^.";
    $mail->SetFrom("kunkeen.cash@gmail.com");
    $mail->Subject = "waa backup kii ".date('d-M-Y');
    $mail->Body = "waa xisaab xirkii ".date('d-M-Y')."   ";
    $mail->AddAddress($email);
    $mail->addAttachment("backups/backup for ".date('d-M-Y').".zip");   // I took this from the phpmailer example on github but I'm not sure if I have it right.      

     if(!$mail->Send()) {
       // return "sorry somthing went wrong please try again !";
     }
 

 clear_local('backups');


}
 

 

exporter();

?>



 

