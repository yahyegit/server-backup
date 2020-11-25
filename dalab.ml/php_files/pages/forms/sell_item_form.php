<?php
    require '../../clasess/dataBase_class.php';


/* function get_customers_select($customer_id){ 
  // return '';
  
         $options = "<option customer_id='' cash_rate='0' current_dollar_balance='0' current_cash_balance='0'>choose..</option><option customer_id='' cash_rate='0' current_dollar_balance='0' current_cash_balance='0'>Add</option>";
         $result_q = mysqli_query_("select customer_id, mobile, customer_name from customers where delete_status !='1' ");       
    while($aRow = mysqli_fetch_assoc_($result_q) ){
            $balance =  mysqli_result_(mysqli_query_("select price - paid as balance from products where customer_id={$aRow['customer_id']} and delete_status!='1' "), 0); 
	 
 			$selected_c = (trim($customer_id) == $aRow['customer_id'])?'selected="selected"':'';
             $options .= "<option customer_id='{$aRow['customer_id']}' current_cash_balance='$balance_ksh'  current_dollar_balance='$balance_dollar' $selected_c > {$aRow['customer_name']} ".'('." {$aRow['mobile']} ".')'." $display_bb </option>";      
    }
    return $options;
 }
*/
 function get_sell_form($data){

 return "
 
  <form  id='selling_form' action='#' class='sell_form'  autocomplete='on'>
<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 
<input type='hidden' name='customer_id'  value='".$data['customer_id']."'> 
<input type='hidden' name='product_id'  value='".$data['id']."'> 
<table class='table'>

<tr>
 <th>customer name</th>
 <td>	
 <input type='text'  autocomplete='on'  name='customer_name' value='".$data['customer_name']."' error_empty_msg='name is required !' required> <p id='error_line' class='customer_name_error hide'></p>  </td>
</tr>

<tr>
 <th>Mobile</th>
 <td>
 <input   type='number' name='mobile'   class='mobile'  value='".$data['mobile']."' error_empty_msg='mobile is required !' required><p id='error_line' class='mobile_error hide'></p></td>
</tr><tr>


<tr>
 <th>address</th>
 <td>
 <input   type='text' name='address'   class='address'  value='".$data['address']."' error_empty_msg='address is required !' required><p id='error_line' class='address_error hide'></p></td>
</tr><tr>

<tr>
 <th>Product name</th>
 <td>
 <input  type='text' name='product_name' value='".$data['product_name']."' error_empty_msg='product name is required !' required><p id='error_line' class='product_name_error hide'></p> </td>
</tr>

<tr>
 <th>Price</th>
 <td>
 <input format_comma='true' type='text' name='price'   class='price' onkeyup=\"calc_balance();\"  value='".$data['price']."' error_empty_msg='price is required !' required><p id='error_line' class='price_error hide'></p></td>
</tr><tr>

<tr> <th>Quantity</th>
 <td>
 <input format_comma='true' type='text' name='quantity' class='quantity'  onkeyup=\"calc_balance();\"value='".$data['quantity']."' error_empty_msg='Quantity is required !' required><p id='error_line' class='quantity_error hide'></p>   </td>
</tr>
 <th>Paid</th>
 <td>
 <input format_comma='true' type='text'  class='paid'  onkeyup=\"calc_balance();\" name='paid' value='".$data['paid']."'  > </td>
<th>Balance</th>  <td>
 <input type='text' name='balance' value='".$data['balance']."'    class='balance'   disabled='disabled' > </td> </tr> 
 
<tr><th> date </th>
      <td> <input type='date' name='date'  value=\"".date('Y-m-d')."\"   > </td>

 <th>Description</th>
 <td>

<textarea  name='description' placeholder='Description is optional' style='border: 2px groove;border-radius: 0.5em;' >
".$data['description']."
 </textarea>

</td>
 </tr>



 </table>

<div class=\"form_footer_btns\">   

<a href='#' file_name=\"php_files/clasess/products_class.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Submit</span></a>

<a href='#' class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\"  onclick=\"close_element('#selling_form');\"  role=\"button\" aria-disabled=\"false\" style=\"
    margin-left: 32px;
\"><span class=\"ui-button-icon-primary ui-icon ui-icon-closethick\"></span><span class=\"ui-button-text\">Close</span></a>
</div>


</form>";

 }

 









 
 
// submited 
if(isset($_POST['data'])){
    if_logged_in('die');
  
  echo get_sell_form($_POST['data']);

}









?>