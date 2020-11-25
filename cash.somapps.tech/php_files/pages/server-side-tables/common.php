<?php

             // 		name,mobile,balance,more,action
		      $row[] = "<div class='view_account' style='display:inline;' title='click to see the account ' onclick=\"r_page('',{customer_id:{$aRow['customer_id']}},'pages/other_pages/customer_acount_page.php');\" >{$aRow['customer_name']}</div><div  class='hide_for_print' style='display:inline'> <button title='click to add transaction to {$aRow['customer_name']} ' class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary'  onclick=\"get_template.customers({$aRow['customer_id']},'transction_form','pages/forms/make_transction_form_page.php');\"  role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-plus'></span><span class='ui-button-text'></span></button> </div> ";
		 		   $row[] = $aRow['mobile'];

		   $row[] = $Balances_;
			// view btn 

			 $row[] = "  <div  class='hide_for_print'>  <button  title='see transactions for {$aRow['customer_name']}' class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('',{customer_id:{$aRow['customer_id']}},'pages/other_pages/customer_acount_page.php');\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon-person  '></span><span class='ui-button-text'>show account </span></button> </div>"; 
				 
			// edit btn and delete btn 
 

 


			 	$row[] = " <div  class='hide_for_print' style='
    
    margin: 0px !important;
     
'> <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['customer_id']},'edit_customer_info_form','pages/forms/edit_customer_info_form.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit info</span></button>  <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['customer_id']},msg:'Delete all transactions for <strong>{$aRow['customer_name']}</strong> ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete account</span></button>  </div>
 

			 	"; 
					

?>