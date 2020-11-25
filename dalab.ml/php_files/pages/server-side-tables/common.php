<?php

			$row[] = "<div class='view_account'  title='click to see the account ' onclick=\"request_template('',{customer_id:{$aRow['customer_id']}},'pages/other_pages/customer_acount_page.php');\"  >{$aRow['customer_name']} 

				<button  onclick=\"request_template('',{customer_id:{$aRow['customer_id']}},'pages/other_pages/customer_acount_page.php');\"  class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary'  title='click to see the account '   role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-'></span><span class='ui-button-text'>show account</span></button>

			</div>";
							
			 $row[] = $aRow['mobile'];
			 $row[] = $aRow['address'];
			 $row[] = '<b class='.$debt_color.'>$'.number_format($balance,2).'</b>';
		 
		 
			// edit btn and delete btn 
 
			 	$row[] = " <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"request_template('',{customer_id:{$aRow['customer_id']}},'pages/forms/edit_customer_info_form.php');\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit info</span></button>  <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['customer_id']},msg:'Delete all products for <strong>{$aRow['customer_name']}</strong> ?'}); \" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete account</span></button>
 
			 	"; 

?>