<?php

             // 		name,mobile,balance,more,action
		      $row[] = "<div class='view_account' style='display:inline;' title='click to see the account ' onclick=\"r_page('',{customer_id:{$aRow['customer_id']}},'pages/other_pages/customer_acount_page.php');\" >{$aRow['customer_name']} 


		      </div><div  class='hide_for_print'> <button title='click to add transaction to {$aRow['customer_name']} ' class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary'  onclick=\"request_template('',{customer_id:{$aRow['customer_id']}},'pages/forms/make_transction_form_page.php');\"  role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-plus'></span><span class='ui-button-text'>Add trans</span></button> </div> ";
							
				  $row[] = $aRow['mobile']; 
				  $row[] = '<pre>ksh'.number_format($aRow['total_cash_in'],2).' </pre>'; 
				  $row[] = '<pre>ksh'.number_format($aRow['total_cash_out'],2).' </pre>'; 
				  $row[] = '<pre class='.toggle_debt_color($aRow['current_ksh_balance']).' >ksh'.number_format($aRow['current_ksh_balance'],2).'</pre>';  

				  $row[] = '<pre>$'.number_format($aRow['total_dollar_in'],2).' </pre>'; 
				  $row[] = '<pre>$'.number_format($aRow['total_dollar_out'],2).' </pre>'; 
				  $row[] = '<pre class='.toggle_debt_color($aRow['current_dollar_balance']).' > $'.number_format($aRow['current_dollar_balance'],2).'</pre>'; 
 
  
		 
			// view btn 

			 $row[] = "  <div  class='hide_for_print'>  <button  title='see transactions for {$aRow['customer_name']}' class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('',{customer_id:{$aRow['customer_id']}},'pages/other_pages/customer_acount_page.php');\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon-person  '></span><span class='ui-button-text'>show account </span></button> </div>"; 
				 
			// edit btn and delete btn 
 

 


			 	$row[] = " <div  class='hide_for_print'> <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['customer_id']},'edit_customer_info_form','pages/forms/edit_customer_info_form.php');\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit info</span></button>  <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['customer_id']},msg:'Delete all transactions for <strong>{$aRow['customer_name']}</strong> ?'}); \" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete account</span></button>  </div>
 

			 	"; 
					

?>