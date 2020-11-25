<?php 

    require '../../clasess/customers_class.php';



function get_transction_form($data){
	   	 $data = clean_security($data,'2');

	if(is_numeric(trim($data['id']))){
		$disabled_input = 'disabled="disabled"';
		$trans_data = mysqli_fetch_assoc_(mysqli_query_("select * from transactions where id='{$data['id']}'  and delete_status !='1' ") );
		  $customer_id =  $trans_data['customer_id'];
		  $cust_info = mysqli_fetch_assoc_(mysqli_query_("select customer_id,customer_name,mobile from customers where  customer_id='$customer_id' and delete_status!='1' "));
		  $data['customer_info'] =  "'{$cust_info['customer_name']}' ".number_format($cust_info['current_ksh_balance'],2)." ksh and $".number_format($cust_info['current_dollar_balance'],2)." ' {$cust_info['mobile']}' ";
		  
		  $title_ = 'Editing transation ..';
	}else{
		$customer_id = $data['customer_id'];
		$title_ = 'Making New Transaction ..';
	}
  
	  $trans_data['date'] = (trim($trans_data['date'])!='')?$trans_data['date']:date('Y-m-d');

 	$form = "
 
<!----transaction form ------>


<form id='transaction_form' action='#' style='
    width: 82%;
' class='dashboard_panel' >

<div class='ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix' style='
    text-align: center;
    margin-bottom: 4px;
'><span id='ui-id-13' class='ui-dialog-title'>$title_</span><a href='#' onclick=\"close_element('#transaction_form');\" class='ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only ui-dialog-titlebar-close' role='button' aria-disabled='false' title='close' style='
    margin-left: 10px;
'><span class='ui-button-icon-primary ui-icon ui-icon-closethick'>close</span><span class='ui-button-text'>close</span></a></div>

     
    <input type='hidden' name='customer_id' value='$customer_id'>
          <input type='hidden' name='id' value='{$trans_data['id']}'>

    <input type='hidden' name='crf_code'  value='".get_unique_code()."'>

<table class=\"table\">


<tr>
     
     <td> <label class='show_'>Customer name</label><br> <input type='text' placeholder='Customer name' autocomplete='off'  name='customer_name'    required   error_empty_msg=' customer name is required !' style='display:none;' >    <div >".get_customers_names($data['customer_id'])."</div>  </td>
         <td> <label>mobile</label><br> 
    <input type='text' name='mobile' $disabled_input placeholder=\"mobile is option\" value='{$data['mobile']}'    > </td> 

       <tr> 
 <td style=\"
    width: 277px;
\">  <label>Ksh in </label><br>  <span class=\"currency\">Ksh</span><input type='text'  placeholder='Ksh In'  name='cash_in' placeholder=\"Cash In\" value='{$trans_data['cash_in']}'    format_comma='true' onkeyup='calc_balance()' onchange='calc_balance()'   > </td>   
<td style=\"
    width: 277px;
\">
    <label>Ksh Out</label><br>  <span class=\"currency\">Ksh</span> <input type='text' name='cash_out' placeholder=\"ksh Out\" value='{$trans_data['cash_out']}'    format_comma='true' onkeyup='calc_balance()' onchange='calc_balance()'   > </td>
     
    <td>  <label>Cash balance: </label> <b id=\"cash_balance\" cash_balance='0'> 0  </b> </td> </tr>
  <tr> 

    <td>  <label>Dollar In</label><br> <span class=\"currency\">$</span><input type='text' name='dollar_in' placeholder=\"Dollar In\" value='{$trans_data['dollar_in']}'    format_comma='true' onkeyup='calc_balance()' onchange='calc_balance()'   > </td>
 
<td>
     <label>Dollar Out</label><br> <span class=\"currency\">$</span><input type='text' name='dollar_out'  placeholder=\"Dollar Out\" value='{$trans_data['dollar_out']}'    format_comma='true' onkeyup='calc_balance()' onchange='calc_balance()'   >
  </td>
 
  <td><label  class='v_label'>Dollar balance</label> <b id=\"dollar_balance\" dollar_balance=\"0\"> 0 </b></td></tr>
<tr>
 
   <td><input type='date' name='date' required  error_empty_msg='date is required!' value='{$trans_data['date']}'>   </td> </tr>
<tr>
       <td colspan=\"3\"> <label>Description (optional)</label><br>  <textarea id='description' name='description' placeholder='Description is optional' style='border: 2px groove;border-radius: 0.5em;'  ></textarea>  

</td> </tr>

</table>
    <div class='form_footer_btns'>
    <a href='#'  file_name='php_files/clasess/transactions_class.php' class='submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' role='button' aria-disabled='false'><span class='ui-button-icon-primary ui-icon'></span><span class='ui-button-text'> ".((is_numeric(trim($data['id'])))?'edit':'add')."  </span></a>

    <a href='#'    onclick=\"close_element('#transaction_form');\"   class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary'  role='button' aria-disabled='false' style='
        margin-left: 32px;
    '><span class='ui-button-icon-primary ui-icon ui-icon-closethick'></span><span class='ui-button-text'>Close</span></a>
    </div> 
</form>

 
<script type=\"text/javascript\" >  
 
 
 //var cards_box_timer = setInterval(cards_box_filter, 1000);
customer_info($('.customers_select').find('option:selected'));

    //   customer_info($('input[name=\"customer_name\"]').val());
</script> 


";

return $form;
}









 
 
// submited 
if(isset($_POST['data'])){
    if_logged_in('die');
  
  echo get_transction_form($_POST['data']);

}







?>