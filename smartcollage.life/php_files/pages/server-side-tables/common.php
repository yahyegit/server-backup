<?php

             // 		name,mobile,balance,more,action
		      $row[] = " {$aRow['customer_name']}<br> ({$aRow['mobile']}) ";
 
		      $row[] = $aRow['courses'];
			  // view btn 
		      $row[] = number_format($aRow['paid'],2)."<br> <button  title='see payment history for {$aRow['name']}' class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('',{id:{$aRow['id']}},'pages/other_pages/payment_history.php');\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon-person  '></span><span class='ui-button-text'>show history </span></button>";
		      
		      $row[] = $aRow['balance']."<br> <button  title='make payment or set remainder ' class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('',{id:{$aRow['id']}},'pages/other_pages/make_payment.php');\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon-person  '></span><span class='ui-button-text'>make payment </span></button>";
		      $row[] = $aRow['address'];
		      $row[] = $aRow['description'];

		 


			 	$row[] = " <div  class='hide_for_print' style='
    
    margin: 0px !important;
     
'> <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['id']},'edit_customer_info_form','pages/forms/edite_student.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit info</span></button>  <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['customer_id']},msg:'deleting please confirm <strong>{$aRow['customer_name']}</strong> ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete student</span></button>  </div>
 

			 	"; 
					

?>