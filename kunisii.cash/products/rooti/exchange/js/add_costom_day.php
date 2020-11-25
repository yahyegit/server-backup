<?php

require 'connet.php';
if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
		die();
	
	}
  if(if_logged_in() != true){
die();
 }

if ( isset($_POST['namex2_']) && isset($_POST['cash_inx2_']) && isset($_POST['cash_outx2_']) &&  isset($_POST['dol_inx2_']) &&  isset($_POST['dol_outx2_']) &&  isset($_POST['exp_number'])){

$namex1		=   trim(mysql_real_escape_string(htmlentities($_POST['namex2_'])));
$cash_inx1 	=   trim(mysql_real_escape_string(htmlentities($_POST['cash_inx2_'])));
$cash_outx1	    =   trim(mysql_real_escape_string(htmlentities($_POST['cash_outx2_'])));
$dol_inx1	    =   trim(mysql_real_escape_string(htmlentities($_POST['dol_inx2_'])));
$dol_outx1	    =   trim(mysql_real_escape_string(htmlentities($_POST['dol_outx2_'])));
$number	    =   trim(mysql_real_escape_string(htmlentities($_POST['exp_number'])));
$admitiondate   =  date('d/M/Y');
$time   =  date('d/M/Y @ h:i:s a');

$dol_outx1 = str_replace(' ','',$dol_outx1);
$cash_outx1 = str_replace(' ','',$cash_outx1);
$cash_inx1 = str_replace(' ','',$cash_inx1);
$dol_inx1 = str_replace(' ','',$dol_inx1);

if($cash_inx1 == ''){
$cash_inx1 =0;
}else if($dol_inx1 == ''){
$dol_inx1 =0;
}
	if(empty($cash_inx1) & empty($dol_inx1)){  
	exit('<font style="color:red ;font:bold 16px verdana;">please enter amout !</font>');
	}
	if(!ctype_digit($cash_inx1) & !ctype_digit($dol_inx1)){
	exit('<font style="color:red ;font:bold 16px verdana;">invalid cash in !</font>');
	}

	if (!ctype_digit($cash_outx1) && !empty($cash_outx1) || !ctype_digit($dol_outx1) && !empty($dol_outx1)){
	exit('<font style="color:red ;font:bold 16px verdana;">invalid cash out !</font>');
	}
	 


	if (!empty($namex1)){
			
			$cash_blance = 	$cash_inx1 - $cash_outx1;
			$doll_blance = 	$dol_inx1 - $dol_outx1;

	
			$update_query = "INSERT INTO `daily_details`  VALUES('','$namex1','$cash_inx1','$cash_outx1','$cash_blance', '$dol_inx1','$dol_outx1','$doll_blance','$number','$time','$admitiondate')";
							
				if(@mysql_query($update_query) == true){			
					echo 1;
				}																
	
		}else{
			echo '<font style="color: red;">please enter The name of the person </font>';
		}
		

}
?>
