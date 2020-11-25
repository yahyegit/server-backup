<?php 

   require '../../clasess/dataBase_class.php';



 function get_customers_select($customer_id){ 
  // return '';
  
         $options = "<option customer_id='' cash_rate='0' current_dollar_balance='0' current_cash_balance='0'>choose..</option><option customer_id='' cash_rate='0' current_dollar_balance='0' current_cash_balance='0'>Add</option>";
         $result_q = mysqli_query_("select customer_id, mobile, customer_name from customers where delete_status !='1' ");       
    while($aRow = mysqli_fetch_assoc_($result_q) ){
            $balance_ksh =  mysqli_result_(mysqli_query_("select sum(amount_ksh) as amount_ksh from transactions where type='out' and customer_id={$aRow['customer_id']} and delete_status!='1' "), 0) - mysqli_result_(mysqli_query_("select sum(amount_ksh) as amount_ksh from transactions where type='in' and customer_id={$aRow['customer_id']} and delete_status!='1' "), 0);

			$balance_dollar = mysqli_result_(mysqli_query_("select sum(amount_dollar) as amount_dollar from transactions where type='out' and customer_id={$aRow['customer_id']} and delete_status!='1' "), 0) - mysqli_result_(mysqli_query_("select sum(amount_dollar) as amount_dollar from transactions where type='in' and customer_id={$aRow['customer_id']} and delete_status!='1' "), 0);

			if($balance_ksh !='0' && $balance_dollar !='0'){  // both 
				$display_bb = ((number_format($balance_ksh,2) !='0.00')?number_format($balance_ksh,2).' ksh':'' ).' and '.((number_format($balance_dollar,2) !='0.00')?'$'.number_format($balance_dollar,2):'');
			}else{  // single 
				$display_bb = ((number_format($balance_ksh,2) !='0.00')?number_format($balance_ksh,2).' ksh':'' ).' | '.((number_format($balance_dollar,2) !='0.00')?'$'.number_format($balance_dollar,2):'');
			} 
 			$selected_c = (trim($customer_id) == $aRow['customer_id'])?'selected="selected"':'';
             $options .= "<option customer_id='{$aRow['customer_id']}' current_cash_balance='$balance_ksh'  current_dollar_balance='$balance_dollar' $selected_c > {$aRow['customer_name']} ".'('." {$aRow['mobile']} ".')'." $display_bb </option>";      
    }
    return $options;
 }
function get_transction_form($data){
		$data['id'] = sanitize($data['id']);  // clean it security check 
// edit or add form using default values

	
	
	if(trim($data['type']) == 'edit_trans'){
		  $transation_id = $data['id'];
		  $customer_id = mysqli_result_(mysqli_query_("select customer_id from transactions where  id={$data['id']} and delete_status!='1' "), 0);
		  $title_ = 'Editing transation ..';
	}else{
		$customer_id = $data['id'];
		$title_ = 'Making New Transaction ..';
		$transation_id = '-0';
	}
     

	   $latest_rate_dollar  = mysqli_result_(mysqli_query_("select `dollar_rate` from transactions where  id=$transation_id  and delete_status !='1'    "), 0);
	   $latest_rate_dollar = (trim($latest_rate_dollar) == '')?mysqli_result_(mysqli_query_("SELECT `dollar_rate` FROM `current_rate` where date='".date('Y-m-d')."' LIMIT 1 "), 0):$latest_rate_dollar;
	   
	   $latest_rate_ksh = mysqli_result_(mysqli_query_("select `cash_rate` from transactions where  id=$transation_id  and delete_status!='1' "), 0);
 	   $latest_rate_ksh = (trim($latest_rate_ksh) == '')?mysqli_result_(mysqli_query_("SELECT `cash_rate` FROM `current_rate` where date='".date('Y-m-d')."' LIMIT 1 "), 0):$latest_rate_ksh;


  	  $trans_type = mysqli_result_(mysqli_query_("select type from transactions where  id=$transation_id and delete_status!='1' "), 0); 

 
      $amount_ksh_ = mysqli_result_(mysqli_query_("select amount_ksh from transactions where  id=$transation_id and delete_status!='1' "), 0); 
 	  
 	  $msg_type_ = mysqli_result_(mysqli_query_("select type_msg from transactions where  id=$transation_id and delete_status!='1' "), 0); 

	  $amount_dollar_ = mysqli_result_(mysqli_query_("select amount_dollar from transactions where  id=$transation_id and delete_status!='1' "), 0);

	   $mobile_ = mysqli_result_(mysqli_query_("select mobile from customers where  customer_id='$customer_id' and delete_status!='1' "), 0); 
	  $date_ = mysqli_result_(mysqli_query_("select `date` from transactions where  id=$transation_id  and delete_status!='1'    "), 0);
	   $description_ = mysqli_result_(mysqli_query_("select description from transactions where  id=$transation_id  and delete_status!='1' "), 0);

	  $date_ = (trim($date_)!='')?$date_:date('Y-m-d');





 	$form = "
<!----transaction form ------><form id='transaction_form' action='#' style='
    width: 82%;
' class='dashboard_panel'>

<div class='ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix' style='
    text-align: center;
    margin-bottom: 4px;
'><span id='ui-id-13' class='ui-dialog-title'>$title_</span><a href='#' onclick=\"close_element('form#transaction_form');\" class='ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only ui-dialog-titlebar-close' role='button' aria-disabled='false' title='close' style='
    margin-left: 10px;
'><span class='ui-button-icon-primary ui-icon ui-icon-closethick'>close</span><span class='ui-button-text'>close</span></a></div>



	 <table class='table'>
		<input type='hidden' name='customer_id' value='$customer_id'>
".((trim($data['type']) == 'edit_trans')?"<input type='hidden' name='transaction_id' value='$transation_id'>":'')."

		<input type='hidden' name='msg_type' value='$msg_type_'>
		<input type='hidden' name='crf_code'  value='".get_unique_code()."'>

		<tbody><tr><th>name</th><td class='customer_names_select'> <select onchange=\"chosen_customer($(this).find('option:selected'));\" onload=\"chosen_customer($(this).find('option:selected')\" > ".get_customers_select($customer_id)."
		</select>

<script>  
	$('document').ready(function(){
		chosen_customer($('.customer_names_select select').find('option:selected'));
	});

</script> 


		 <!--select with no name attr----> <input type='text' name='customer_name' id='customer_name_new' style='display: none;'>  <p id='error_line' class='hide'></p>  </td> <th class='trans_f_b'>Balance</th><td class='trans_f_b'> <b id='current_cash_balance' style='display: inline;'> </b> <i  class='hide'>and</i> <b id='current_dollar_balance' style='display: inline;'> </b> </td> </tr> 
		<tr>    </tr>
	</tbody></table>
	<p id='error_line' class='hide'></p>

<table class='table' style='
    margin-top: 6px;
'>	 
		<tbody><tr><th  style=\"
    width: 127px;
\">Transaction Type</th> <td>



		<div id='trans_type_validate' one_is_required='#trans_type_deposit,#trans_type_deb,#trans_type_exchange' error_empty_msg='select transaction type '  >
			   <label for='trans_type_deposit'>  In </label>
					<input type='radio' name='trans_type'  onclick=\"new_current_balance(); toggle_rate('deposit'); \" value='In'  ".((trim($trans_type) == 'deposit')?'selected="selected"':'')."
 id='trans_type_deposit' > 
		        <label for='trans_type_deb' >  Out </label>
					<input type='radio'   name='trans_type' onclick=\"new_current_balance();  toggle_rate('debt'); \" value='Out' ".((trim($trans_type) == 'debt')?'selected="selected"':'')."
 id='trans_type_deb' > 
					 <label  for='trans_type_exchange'> Exchange </label>

					<input type='radio' name='trans_type'   id='trans_type_exchange'  onclick=\"new_current_balance();  toggle_rate('exchange'); \"  value='exchange'  ".((trim($trans_type) == 'exchange')?'selected="selected"':'')."  id='trans_type_exchange'>  
		</div>
 
					<p id='error_line' class=' hide'></p> 
           </td>   
              
		  </tr></tbody>
	</table>


	<table class='table' id='amount_validator' one_is_required='#amount_money_ksh,#amount_money_dollar' error_empty_msg=' enter Amount dollar or Ksh !' style='
    margin-top: 6px;
'>
		<thead><tr><th>Amount</th></tr></thead>
					<tbody> <tr style=\"
    border-bottom: 2px solid rgba(46,61,73,0.2);
\">

					 <td>

	<b class='currency_style'  style='
    margin-right: -3px;
'>$</b>

<input type='hidden' name='r_amount_dollar' value=''> 
<input type='hidden' name='r_amount_ksh' value=''> 


<input type='hidden' name='amount_money_dollar' value='$amount_dollar_'> 
	<input type='text' format_comma='true'  id='amount_money_dollar' value='".number_format($amount_dollar_,2)."' onkeyup=\"convert($('#convert_to_ksh_check').is(':checked'),'ksh');\" onblur=\"convert($('#convert_to_ksh_check').is(':checked'),'ksh');\"   one_is_required='#amount_money_ksh,#amount_money_dollar' error_empty_msg=' enter Amount dollar or Ksh !'   style=\"clip-path: inset(-5px 0px -5px -5px);\"  > 

						 <label>
		<input type='checkbox' name='convert_to_ksh' id='convert_to_ksh_check' onclick=\"if($(this).is(':checked')){".'$'."('.ksh_sign').show();}else{".'$'."('.ksh_sign').hide();} convert($(this).is(':checked'),'ksh');\"> Convert to Ksh</label> 
					<i class='ksh_sign hide'>puy rate</i> <input type='number'     onkeyup=\"convert($('#convert_to_ksh_check').is(':checked'),'ksh');\" onblur=\"convert($('#convert_to_ksh_check').is(':checked'),'ksh');\" class='hide' name='rate_ksh' style='margin-right: 9px; width: 100px; display: none;' id='rate_ksh'    value=\"".((number_format($latest_rate_ksh,2) == '0.00')?'':number_format($latest_rate_ksh,2))."\"> <span id='error_line' class=' hide'></span>   
						<b class='balance_converted_to_ksh hide' style='display: none;' balance='0'>0</b> <b class='ksh_sign hide' style='display: inline;'>ksh</b>
 
					 

					 </td>
</tr><tr>  
 
					 <td>
					
<input type='hidden' name='amount_money_ksh' value='$amount_ksh_' > 
	<input type='text' style=\"
    margin-left: 22px;
\" format_comma='true' id='amount_money_ksh'  one_is_required='#amount_money_ksh,#amount_money_dollar' error_empty_msg=' enter Amount dollar or Ksh !'   value='".number_format($amount_ksh_ ,2)."'  onkeyup=\"
	convert($('#convert_to_dollar_check').is(':checked'),'dollar');\" onblur=\"convert($('#convert_to_dollar_check').is(':checked'),'dollar');\"> <b style=' margin-left: -6px; clip-path: inset(-5px 0px -5px -5px);' class='currency_style'    > ksh</b> 


	 <label>
					<input type='checkbox' name='convert_to_dollar' id='convert_to_dollar_check' onclick=\" if($(this).is(':checked')){".'$'."('.dollar_sign').show();}else{".'$'."('.dollar_sign').hide();} convert($(this).is(':checked'),'dollar');\" value='' > convert to $ </label>
					<i class='dollar_sign hide'>sell rate</i> <input type='number'   onkeyup=\"convert($('#convert_to_dollar_check').is(':checked'),'dollar');\" onblur=\"convert($('#convert_to_dollar_check').is(':checked'),'dollar');\" name='rate_dollar' style='width: 100px; margin-right: 9px; display: none;' class='hide' id='rate_dollar' value=\"".((number_format($latest_rate_dollar,2) == '0.00')?'':number_format($latest_rate_dollar,2))."\"> 	
					
					 <span id='error_line' class=' hide'></span> 
 
						<b class='dollar_sign hide'>$</b>
						<b class='balance_converted_to_dollar hide'>0</b>
					 </td></tr>
					      <tr></tr> </tbody>

	</table>

	<p id='error_line' class='hide'></p> 
	

	<table class='table'>
		<tbody><tr> <th style='
    width: 76px;
'>Date</th> <td><input type='date' name='date' value='$date_'></td> <th style='
    width: 70px;
'>mobile</th>  <td><input type='number' name='mobile' placeholder=\"optional\" value='$mobile_'></td> </tr>
	    
	</tbody></table>


	<table class='table'>
		<tbody><tr><th  style=\"
    width: 157px;
    height: 3px !important;
\" >Description <i>(optional)</i> </th> <td> <textarea id='description' name='description' placeholder='Description is optional' style='border: 2px groove;border-radius: 0.5em;' >
$description_
 </textarea> </td></tr>
	</tbody></table>


<div class='form_footer_btns'>
<a href='#'  file_name='php_files/clasess/transactions_class.php' class='submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' role='button' aria-disabled='false'><span class='ui-button-icon-primary ui-icon'></span><span class='ui-button-text'> ".((trim($data['type']) == 'edit_trans')?'update':'add')."  </span></a>

<a href='#'    onclick=\"close_element('#transaction_form');\"   class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary'  role='button' aria-disabled='false' style='
    margin-left: 32px;
'><span class='ui-button-icon-primary ui-icon ui-icon-closethick'></span><span class='ui-button-text'>Close</span></a>
</div>
</form>";

return $form;
}









 
 
// submited 
if(isset($_POST['data'])){
    if_logged_in('die');
  
  echo get_transction_form($_POST['data']);

}







?>