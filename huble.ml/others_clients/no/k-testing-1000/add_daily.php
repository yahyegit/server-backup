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
$admitiondate   =  date('d/M/Y');
$month   =  date('m/Y');

$dol_outx1 = str_replace(' ','',$dol_outx1);
$cash_outx1 = str_replace(' ','',$cash_outx1);
$cash_inx1 = str_replace(' ','',$cash_inx1);
$dol_inx1 = str_replace(' ','',$dol_inx1);

if($cash_inx1 == ''){
$cash_inx1 =0;
}else if($dol_inx1 == ''){
$dol_inx1 =0;
}
  
	if (!ctype_digit($cash_inx1) || !ctype_digit($cash_outx1)|| !ctype_digit($dol_inx1) ||!ctype_digit($dol_outx1)){
	exit('<font style="color:red ;font:bold 16px verdana;"> invalid digit number !</font>');
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
							$update_query = "INSERT INTO `oppen_day`  VALUES('','','0','$namex1','$cash_inx1','$cash_outx1','$cash_blance', '$dol_inx1','$dol_outx1','$doll_blance','$admitiondate','$month')";
										
							if(@mysql_query($update_query) == true){			
								echo 1;
							}																
						}
	
 
		

}
?>
