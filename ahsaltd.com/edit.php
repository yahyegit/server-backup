<?php

require 'connet.php';
if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
		die();
	
	}
  if(if_logged_in() != true){
die();
 }
 	
// update poth

if (isset($_POST['edit_ful_name'])){

$id_edit	    =   trim(mysql_real_escape_string(htmlentities($_POST['id_edit'])));
$edit_ful_name		=   trim(mysql_real_escape_string(htmlentities($_POST['edit_ful_name'])));
$edit_ful_name     =  str_replace("&quot;",'',str_replace("'",'', $edit_ful_name));


$edit_cash_in 	=   trim(mysql_real_escape_string(htmlentities($_POST['edit_cash_in'])));
$edit_cash_out	    =   trim(mysql_real_escape_string(htmlentities($_POST['edit_cash_out'])));
$edit_dol_in 	=   trim(mysql_real_escape_string(htmlentities($_POST['edit_dol_in'])));
$edit_dol_out	    =   trim(mysql_real_escape_string(htmlentities($_POST['edit_dol_out'])));
$edit_number	    =   trim(mysql_real_escape_string(htmlentities($_POST['edit_number'])));
$description	    =   trim(mysql_real_escape_string(htmlentities($_POST['description'])));
$id_or_passport_edit	    =   trim(mysql_real_escape_string(htmlentities($_POST['id_or_passport_edit'])));



$date_e	    =   trim(mysql_real_escape_string(htmlentities($_POST['date_e'])));

$cash_in 	=   trim(mysql_real_escape_string(htmlentities($_POST['cash_in'])));
$cash_out	    =   trim(mysql_real_escape_string(htmlentities($_POST['cash_out'])));
$dol_in 	=   trim(mysql_real_escape_string(htmlentities($_POST['dol_in'])));
$dol_out	    =   trim(mysql_real_escape_string(htmlentities($_POST['dol_out'])));

	  
	if(!is_numeric($edit_cash_in) || !is_numeric($edit_cash_out) || !is_numeric($edit_dol_in) || !is_numeric($edit_dol_out)   || !is_numeric($cash_in) || !is_numeric($cash_out)  || !is_numeric($dol_in)  || !is_numeric($dol_out)){
	exit('<font style="color:red ;font:bold 16px verdana;"> what you entered is not digit number !</font>');
 
	}else if (!preg_match("/^([0-9+-])/", $edit_number) && !empty($edit_number)){
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
	 


		if (!empty($edit_ful_name)){
			$blance      		= 	$edit_cash_in - $edit_cash_out;
			$h_doller_blance 	=	$edit_dol_in - $edit_dol_out;
			
			
			$current_cash_in = $cash_in + $edit_cash_in; 
			$current_cash_out = $cash_out + $edit_cash_out; 
			
			$current_doll_in = $dol_in + $edit_dol_in; 
			$current_doll_out = $dol_out + $edit_dol_out; 
			
			
			$current_cash_blance = $current_cash_in - $current_cash_out; 
			
			$current_doll_blance = $current_doll_in - $current_doll_out; 
			
			$update_query = "UPDATE main_details SET full_name='$edit_ful_name', cash_in=$current_cash_in, cash_out=$current_cash_out, blance=$current_cash_blance, doller_in=$current_doll_in, doller_out=$current_doll_out, doller_blance=$current_doll_blance, number='$edit_number', id_passport='$id_or_passport_edit' WHERE id = $id_edit ";
			$update_query2 = "INSERT INTO `history`(`full_name`, `cash_in`, `cash_out`, `blance`, `doller_in`, `doller_out`, `doller_blance`, `number`, `date`, `id_card`, `months`, `description`)  VALUES('$edit_ful_name', $edit_cash_in, $edit_cash_out, $current_cash_blance, $edit_dol_in, $edit_dol_out, $current_doll_blance, '$edit_number','$time','$id_edit','$month','$description')";
							
				if(@mysql_query($update_query) == true){
				
				
					if(@mysql_query($update_query2)){

                                                    if(fix_balance_for_transactions($id_edit)){
							fix_bugs();
                                                          echo 1;
                                                      }
					
					}else{
						echo 'error';
					}
				
				
				
				
				
				}																
	
		}else{
			echo '<font style="color: red;">please enter The name !</font>';
		}
		

}
?>
