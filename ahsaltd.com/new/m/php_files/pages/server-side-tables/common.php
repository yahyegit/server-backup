<?php
             // 		name,mobile,balance,more,action
		      $row[] = '<div class="trans_panel_box dashboard_panel " style="margin-top:0px;">
<div class="underline pl"> '."<div class='view_account' style='display:inline;' title='click to see the account ' onclick=\"r_page('',{customer_id:{$aRow['customer_id']}},'pages/other_pages/customer_acount_page.php');\" >{$aRow['customer_name']} ({$aRow['mobile']})


		      </div><button title='click to add transaction to {$aRow['customer_name']} ' class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary'  onclick=\"request_template('',{customer_info:'id:{$aRow['customer_id']}\' {$aRow['customer_name']}\' ".number_format($aRow['current_ksh_balance'],2)." ksh and $".number_format($aRow['current_dollar_balance'],2)." \' {$aRow['mobile']}'},'pages/forms/make_transction_form_page.php');\"  role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-plus'></span><span class='ui-button-text'>Add trans</span></button> ".'  </div>
<div class="underline pl">  <span class="plc" style="
    margin-left: 8px;
">Balance:</span> '.'<b class='.toggle_debt_color($aRow['current_ksh_balance']).'>'.number_format($aRow['current_ksh_balance'],2).' ksh</b>  <b style="padding:3px">|</b>   <b class='.toggle_debt_color($aRow['current_dollar_balance']).'>$'.number_format($aRow['current_dollar_balance'],2).'</b>'.' </div>
<div class="underline pl"> '."<button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['customer_id']},'edit_customer_info_form','pages/forms/edit_customer_info_form.php');\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit info</span></button>  <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['customer_id']},msg:'Delete all transactions for <strong>{$aRow['customer_name']}</strong> ?'}); \" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete account</span></button>".'</div>
</div>';


					

?>