<?php

		
						 	$row[] = "<div class='view_account'  title='click to see the account ' onclick=\"get_template.customers({$aRow['customer_id']},'customer_acount','pages/other_pages/customer_acount_page.php')\" >{$aRow['customer_name']} </div>";
							
			 $row[] = $aRow['mobile'];
			 $row[] = '<b class='.toggle_debt_color($aRow['current_ksh_balace']).'>'.number_format($aRow['current_ksh_balace'],2).' ksh</b>   <span  class=\'span_\'> and </span>   <b class='.toggle_debt_color($aRow['current_dollar_balace']).'>$'.number_format($aRow['current_dollar_balace'],2).'</b>';
		 
			// view btn 

			 $row[] = "<button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary'  onclick=\"get_template.customers({$aRow['customer_id']},'transction_form','pages/forms/make_transction_form_page.php');\"  role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-plus'></span><span class='ui-button-text'>Add trans</span></button>   <button  class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['customer_id']},'customer_acount','pages/other_pages/customer_acount_page.php')\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon-person  '></span><span class='ui-button-text'>view account </span></button>"; 
				 
			// edit btn and delete btn 
 
			 	$row[] = " <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['customer_id']},'edit_customer_info_form','pages/forms/edit_customer_info_form.php');\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit info</span></button>  <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['customer_id']},msg:'Delete all transactions for <strong>{$aRow['customer_name']}</strong> ?'}); \" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete account</span></button>

					

 

			 	"; 
					

?>