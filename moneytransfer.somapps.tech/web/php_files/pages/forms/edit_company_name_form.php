<?php
    require '../../clasess/dataBase_class.php';



 function get_company_name_form(){

 return "
 <form id='com_name_form' action='#' style=\"
    width: 45%;
    margin: auto;
\" >

<table class='table'><tr>
 
 <td><label>Company name</label><br>	<input type='hidden' name='crf_code'  value='".get_unique_code()."'> <input type='text' placeholder='Company Name' name='company_name' value='".mysqli_result_(mysqli_query_("SELECT `company_name` FROM `settings` LIMIT 1"), 0)."' required>  </td></tr></table>

<div class=\"form_footer_btns\">   
<a href='#'  file_name=\"php_files/clasess/settings_class.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Submit</span></a>

<a href='#'  class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"close_element('#com_name_form');\" role=\"button\" aria-disabled=\"false\" style=\"
    margin-left: 32px;
\"><span class=\"ui-button-icon-primary ui-icon ui-icon-closethick\"></span><span class=\"ui-button-text\">Close</span></a>
</div>

</form>";

 

 }









 
 
// submited 
if(isset($_POST['data'])){
    if_logged_in('die');
  
  echo get_company_name_form();

}









?>