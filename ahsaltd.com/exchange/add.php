
<?php

require 'connet.php';

if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
		die();
	
	}



  if(if_logged_in() != true){
die();
 }
 	







if (isset($_POST['new_ful_name']) && isset($_POST['new_cash_in']) && isset($_POST['new_cash_out']) && isset($_POST['new_doll_in'])&& isset($_POST['new_doll_out']) &&  isset($_POST['new_number'])){


$new_ful_name		=   trim(mysql_real_escape_string(htmlentities($_POST['new_ful_name'])));

$new_ful_name     =  str_replace("&quot;",'',str_replace("'",'', $new_ful_name));


$new_cash_in 	=   trim(mysql_real_escape_string(htmlentities($_POST['new_cash_in'])));
$new_cash_out	    =   trim(mysql_real_escape_string(htmlentities($_POST['new_cash_out'])));
$new_doll_in 	=   trim(mysql_real_escape_string(htmlentities($_POST['new_doll_in'])));
$new_doll_out	    =   trim(mysql_real_escape_string(htmlentities($_POST['new_doll_out'])));

$desctiption	    =   trim(mysql_real_escape_string(htmlentities($_POST['desctiption'])));
$id_or_passport	    =   trim(mysql_real_escape_string(htmlentities($_POST['id_or_passport'])));

$new_number	    =   trim(mysql_real_escape_string(htmlentities($_POST['new_number'])));
 
$date_e	    =   trim(mysql_real_escape_string(htmlentities($_POST['date_a'])));


	if(!is_numeric($new_cash_in) || !is_numeric($new_cash_out) || !is_numeric($new_doll_in) || !is_numeric($new_doll_out) ){
	exit('<font style="color:red ;font:bold 16px verdana;"> what you entered is not digit number !</font>');
 
	}else if (!preg_match("/^([0-9+-])/", $new_number) && !empty($new_number)){
	exit('<font style="color:red ;font:bold 16px verdana;">invalid phone number !</font>');	
	}
	 


      if($date_e == ''){
           exit('<font style="color:red ;font:bold 16px verdana;">sorry date is required !</font>');	
       }else{
           $date_e  =  date('d/M/Y',strtotime(str_replace('/','-',$date_e)));
		   
           $time   =  $date_e;
           $date   =  $date_e;
           $month   =  date('m/Y',strtotime(str_replace('/','-',$date_e)));
 
     }


		if (!empty($new_ful_name)){
		 }else{
			$new_ful_name = 'unknown';
		 }	
		
			$blance = 	$new_cash_in - $new_cash_out;
			$dol_blance = 	$new_doll_in - $new_doll_out;
			
			$update_query = "INSERT INTO `main_details`  VALUES('','$new_ful_name','$new_cash_in','$new_cash_out','$blance', '$new_doll_in','$new_doll_out','$dol_blance','$new_number','$time','$date','$id_or_passport')";
			$query_select = "SELECT `id`, `full_name`, `cash_in`, `cash_out`, `blance` ,`doller_in`,`doller_out`,`doller_blance`, `number` FROM `main_details` WHERE `full_name`='$new_ful_name' and `cash_in`=$new_cash_in and `cash_out`=$new_cash_out and `blance`=$blance and `doller_in`=$new_doll_in and `doller_out`=$new_doll_out and `doller_blance`=$dol_blance and `number`='$new_number' and `time`='$time' and `date`='$date'  ORDER BY `id` DESC LIMIT 1"; 
 
				//echo $update_query; die();	  
				if(@mysql_query($update_query) == true){
				
				
					if(@$query_run2 = mysql_query($query_select)){
								
							$sql_row_2 = mysql_fetch_assoc($query_run2);
																		 
									$id   = $sql_row_2['id'];
									$full_name   = $sql_row_2['full_name'];
									$cash_in   = $sql_row_2['cash_in'];
									$cash_out   = $sql_row_2['cash_out'];
									$blance   = $sql_row_2['blance'];
									
									$doller_in   = $sql_row_2['doller_in'];
									$doller_out   = $sql_row_2['doller_out'];
									$doller_blance   = $sql_row_2['doller_blance'];
									$number   = $sql_row_2['number'];
						
						$update_query2 = "INSERT INTO `history`  VALUES('','$new_ful_name',$cash_in,$cash_out, $blance ,$doller_in,$doller_out,$doller_blance,'$number','$time','$id','$month','$desctiption')";
							if(@mysql_query($update_query2)){
						
							echo 1;	//fix_bugs();
					               				 
							}else{ echo $update_query2; }

							
						}else{ echo 'error 22'; }
				
				
				
				
				
				}else{
					
					echo 'error1';
					
					}															
	
		 
		

}else{
echo 'error';

}
?>
