<?php

require 'connet.php';
if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
		die();
	
	}
  if(if_logged_in() != true){
die();
 }


if (isset($_POST['id_edit_x']) && isset($_POST['namex1']) && isset($_POST['cash_inx1']) && isset($_POST['cash_outx1']) &&  isset($_POST['dol_inx1']) &&  isset($_POST['dol_outx1'])){

$id_edit_x	    =   trim(mysql_real_escape_string(htmlentities($_POST['id_edit_x'])));
$namex1		=   trim(mysql_real_escape_string(htmlentities($_POST['namex1'])));
$cash_inx1 	=   trim(mysql_real_escape_string(htmlentities($_POST['cash_inx1'])));
$cash_outx1	    =   trim(mysql_real_escape_string(htmlentities($_POST['cash_outx1'])));
$dol_inx1	    =   trim(mysql_real_escape_string(htmlentities($_POST['dol_inx1'])));
$dol_outx1	    =   trim(mysql_real_escape_string(htmlentities($_POST['dol_outx1'])));


$date_openday    =   trim(mysql_real_escape_string(htmlentities($_POST['date_openday'])));


$cashRate_	    =   trim(mysql_real_escape_string(htmlentities($_POST['cashRate_'])));
$dollRate_    =   trim(mysql_real_escape_string(htmlentities($_POST['dollRate_'])));

    if(empty($dollRate_)){
exit('<font style="color:red ;font:bold 16px verdana;"> Please Enter the Dollar Rate!</font>');
 }

    if(!is_numeric($dollRate_)){
exit('<font style="color:red ;font:bold 16px verdana;">  Error Invalid Dollar Rate !</font>');
 }


    if(empty($date_openday)){
      exit('<font style="color:red ;font:bold 16px verdana;">  please enter the date !</font>');
		 }else{
			 
					$date_e  =  date('d/M/Y',strtotime(str_replace('/','-',$date_openday)));
			 
				   $date   =  $date_e;
				   $month   =  date('m/Y',strtotime(str_replace('/','-',$date_openday)));
		 
		 }


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
	$namex1 = 'untitled day';
	}

 
			$cash_blance = 	$cash_inx1 - $cash_outx1;
			$doll_blance = 	$dol_inx1 - $dol_outx1;

	
			$update_query = "UPDATE `oppen_day` SET name='$namex1', cash_in='$cash_inx1', cash_out='$cash_outx1', blance='$cash_blance', dolla_in='$dol_inx1', dolla_out='$dol_outx1', dolla_blance='$doll_blance', `cashRate`='$cashRate_',`dollarRate`='$dollRate_', `month`='$month', `date`='$date'  WHERE id = $id_edit_x ";
							
				if(@mysql_query($update_query) == true){
								fix_bugs();
							echo 1;

				}																
	
	 
		

}
?>
