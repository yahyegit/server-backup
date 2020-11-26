<?php

require 'connet.php';

if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
		die();
	
	}

  if(if_logged_in() != true){
die();
 }

if ( isset($_POST['namex2']) && isset($_POST['cash_inx2']) && isset($_POST['cash_outx2']) &&  isset($_POST['dol_inx2']) &&  isset($_POST['dol_outx2'])){

$namex1		=   trim(mysql_real_escape_string(htmlentities($_POST['namex2'])));
$cash_inx1 	=   trim(mysql_real_escape_string(htmlentities($_POST['cash_inx2'])));
$cash_outx1	    =   trim(mysql_real_escape_string(htmlentities($_POST['cash_outx2'])));
$dol_inx1	    =   trim(mysql_real_escape_string(htmlentities($_POST['dol_inx2'])));
$dol_outx1	    =   trim(mysql_real_escape_string(htmlentities($_POST['dol_outx2'])));


$date_openday    =   trim(mysql_real_escape_string(htmlentities($_POST['date_openday'])));




$cashRate	    =   trim(mysql_real_escape_string(htmlentities($_POST['cashRate'])));
$dollRate    =   trim(mysql_real_escape_string(htmlentities($_POST['dollRate'])));

 
 
$dol_outx1 = str_replace(' ','',$dol_outx1);
$cash_outx1 = str_replace(' ','',$cash_outx1);
$cash_inx1 = str_replace(' ','',$cash_inx1);
$dol_inx1 = str_replace(' ','',$dol_inx1);

if($cash_inx1 == ''){
$cash_inx1 =0;
}else if($dol_inx1 == ''){
$dol_inx1 =0;
}
  
	if (!is_numeric($cash_inx1) || !is_numeric($cash_outx1)|| !is_numeric($dol_inx1) ||!is_numeric($dol_outx1)){
	exit('<font style="color:red ;font:bold 16px verdana;"> invalid digit number !</font>');
	}
    if(empty($dollRate)){
exit('<font style="color:red ;font:bold 16px verdana;"> Please Enter the Dollar Rate!</font>');
 }
    if(!is_numeric($dollRate)){
exit('<font style="color:red ;font:bold 16px verdana;">  Error Invalid Dollar Rate !</font>');
 }



    if(empty($date_openday)){
      exit('<font style="color:red ;font:bold 16px verdana;">  please enter the date !</font>');
		 }else{
			 
				   $date_e  =  date('d/M/Y',strtotime(str_replace('/','-',$date_openday)));
			 
				   $admitiondate   =  $date_e;
				   $month   =  date('m/Y',strtotime(str_replace('/','-',$date_openday)));
		 
		 }



	 
	if($namex1 == ''){
	$namex1 = date('d/M/Y');
	}


 		
			$cash_blance = 	$cash_inx1 - $cash_outx1;
			$doll_blance = 	$dol_inx1 - $dol_outx1;
			
				$chack_exist_query = "SELECT `date` FROM `oppen_day` WHERE `date`='$admitiondate'";
				$chack_exist_query_run   =  mysql_query($chack_exist_query);
				
				if(mysql_num_rows($chack_exist_query_run) == 1){			
						exit("<font style='color:red ;font:bold 16px verdana;'>$admitiondate is all ready exists</font>");
					}else{
							$update_query = "INSERT INTO `oppen_day`  VALUES('','$namex1','$cash_inx1','$cash_outx1','$cash_blance', '$dol_inx1','$dol_outx1','$doll_blance','$admitiondate','$month','$cashRate','$dollRate')";
										
							if(@mysql_query($update_query) == true){			
								
							fix_bugs();
							echo 1;
							}																
						}
	
 
		

}
?>
