<?php 

    require '../../clasess/customers_class.php';



function get_transction_form($data){
	   		// $data = clean_security($data,'2');

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
'><span id='ui-id-13' class='ui-dialog-title'>$title_</span><a href='#' onclick=\"close_element('form#transaction_form');\" class='ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only ui-dialog-titlebar-close' role='button' aria-disabled='false' title='close' style='
    margin-left: 10px;
'><span class='ui-button-icon-primary ui-icon ui-icon-closethick'>close</span><span class='ui-button-text'>close</span></a></div>

     
    <input type='hidden' name='customer_id' value='$customer_id'>
          <input type='hidden' name='id' value='{$trans_data['id']}'>

    <input type='hidden' name='crf_code'  value='".get_unique_code()."'>

<table class=\"table\">


<tr>
    <th> <label for=\"customer_name\">Name</label></th>
     <td> <input type='text' autocomplete='off'  name='customer_name'  onkeyup='calc_balance()' onchange='customer_info($(this).val());' onload='customer_info($(this).val());' $disabled_input  value=\"{$data['customer_info']}\" required   error_empty_msg=' customer name is required !' > </td>
        <th><label for=\"mobile\">mobile</label> </th><td>
    <input type='text' name='mobile' $disabled_input placeholder=\"mobile is option\" value='{$data['mobile']}'    > </td> 

       <tr><th><label for=\"cash_in\">Cash In</label></th>
 <td>   <input type='text' name='cash_in' placeholder=\"Cash In\" value='{$trans_data['cash_in']}'    format_comma='true' onkeyup='calc_balance()' onchange='calc_balance()'   ><span class=\"currency\">Ksh</span> </td> <th>   <label for=\"cash_out\">Cash Out</label></th>
<td>
    <input type='text' name='cash_out' placeholder=\"Cash Out\" value='{$trans_data['cash_out']}'    format_comma='true' onkeyup='calc_balance()' onchange='calc_balance()'   ><span class=\"currency\">Ksh</span> </td>
     <th> <label>Cash balance</label> </th> 
    <td> <b id=\"cash_balance\" cash_balance='0'> 0  </b> </td> </tr>
  <tr> <th> <label for=\"dollar_in\">Dollar In</label>  </th>

    <td> <span class=\"currency\">$</span><input type='text' name='dollar_in' placeholder=\"Dollar In\" value='{$trans_data['dollar_in']}'    format_comma='true' onkeyup='calc_balance()' onchange='calc_balance()'   > </td>
  <th>  <label for=\"dollar_out\">Dollar Out</label> </th>
<td>
    <span class=\"currency\">$</span><input type='text' name='dollar_out'  placeholder=\"Dollar Out\" value='{$trans_data['dollar_out']}'    format_comma='true' onkeyup='calc_balance()' onchange='calc_balance()'   >
  </td>
  <th> <label  >Dollar balance</label> </th>
  <td><b id=\"dollar_balance\" dollar_balance=\"0\"> 0 </b></td></tr>
<tr>
 <th><label  for=\"date\">Date</label></th> 
   <td><input type='date' name='date' required  error_empty_msg='date is required!' value='{$trans_data['date']}'>  </td> </tr>

</table>

     <textarea id='description' name='description' placeholder='Description is optional' style='border: 2px groove;border-radius: 0.5em;' ></textarea>  


    <div class='form_footer_btns'>
    <a href='#'  file_name='php_files/clasess/transactions_class.php' class='submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' role='button' aria-disabled='false'><span class='ui-button-icon-primary ui-icon'></span><span class='ui-button-text'> ".((is_numeric(trim($data['id'])))?'edit':'add')."  </span></a>

    <a href='#'    onclick=\"close_element('#transaction_form');\"   class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary'  role='button' aria-disabled='false' style='
        margin-left: 32px;
    '><span class='ui-button-icon-primary ui-icon ui-icon-closethick'></span><span class='ui-button-text'>Close</span></a>
    </div> 
</form>

 
<script type=\"text/javascript\" >  

  $('document').ready(function(){
  
       $('input[name=\"customer_name\"').autocomplete({
        source:  ".get_customers_names()."   
       });

       customer_info($('input[name=\"customer_name\"]').val());
    });

      $('input[name=\"customer_name\"').autocomplete({
        source:  ".get_customers_names()."   
       });
       customer_info($('input[name=\"customer_name\"]').val());
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