<?php
    require '../../clasess/dataBase_class.php';



 function get_expense_form($data){

 return "
 
  <form  id='expense_form' action='#'  autocomplete='on'  >
<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 
<input type='hidden' name='id'  value='".$data['id']."'> 
<table class='table'>

<tr>
 <th>name</th>
 <td>	
 <input type='text' name='name' value='".$data['name']."' error_empty_msg='name is required !' required> <p id='error_line' class='name_error hide'></p>  </td>
</tr>
<tr> <th>Quantity</th>
 <td>
 <input format_comma='true' type='text' name='quantity' value='".$data['quantity']."' error_empty_msg='Quantity is required !' required><p id='error_line' class='quantity_error hide'></p>   </td>
</tr>
<tr> <th>Cost</th>
 <td>
 <input format_comma='true' type='text' name='cost' value='".$data['cost']."' error_empty_msg='cost is required !' required><p id='error_line' class='cost_error hide'></p>   </td>
</tr>


<tr>
<th> date </th>
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

<a href='#' file_name=\"php_files/clasess/expense_class.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Submit</span></a>

<a href='#' class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\"  onclick=\"close_element('#expense_form');\"  role=\"button\" aria-disabled=\"false\" style=\"
    margin-left: 32px;
\"><span class=\"ui-button-icon-primary ui-icon ui-icon-closethick\"></span><span class=\"ui-button-text\">Close</span></a>
</div>


</form>";

 }

 









 
 
// submited 
if(isset($_POST['data'])){
    if_logged_in('die');
  
  echo get_expense_form($_POST['data']);

}









?>