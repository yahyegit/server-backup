<?php
    require '../../clasess/dataBase_class.php';



 function get_customer_info_form($cust_id){

 return "
 
  <form  id='customer_info_form' action='#'  >

<table class='table'><tr>
 
 <td>	<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 

 <input type='text' placeholder='name' name='customer_name' value='".mysqli_result_(mysqli_query_("SELECT `customer_name` FROM `customers` where customer_id={$cust_id['id']} "), 0)."' error_empty_msg='name is required !' required>  </td>

 
 <td>
		<input type='hidden' name='customer_id' value='{$cust_id['id']}'>
		<input type='hidden' name='edit_cust_info' value='true'>

 <input type='text' placeholder='mobile' name='mobile' value='".mysqli_result_(mysqli_query_("SELECT `mobile` FROM `customers` where customer_id={$cust_id['id']} "), 0)."' >  </td>


 </tr>



 </table>

<div class=\"form_footer_btns\">   

<a href='#' style='  margin-left: 0px;' file_name=\"php_files/clasess/customers_class.php\" class=\"primary_button submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Submit</span></a>

<a href='#' class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\"  onclick=\"close_element('#customer_info_form');\"  role=\"button\" aria-disabled=\"false\" style=\"
    margin-left: 32px;
\"><span class=\"ui-button-icon-primary ui-icon ui-icon-closethick\"></span><span class=\"ui-button-text\">Close</span></a>
</div>


</form>";

 }

 









 
 
// submited 
if(isset($_POST['data'])){
    if_logged_in('die');
  
  echo get_customer_info_form($_POST['data']);

}









?>