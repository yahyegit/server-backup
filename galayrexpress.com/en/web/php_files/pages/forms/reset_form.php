<?php
    require '../../clasess/dataBase_class.php';



 function reset_form(){

 return "
   <form id='com_email_form' action='#'  style='
    width: 50%;
    margin: 0 auto;'>

<table class='table'><tr>
 <td>	<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 
 <label class='show_'> Recovery Email </label></br>
 <input type='email' name='email' value='' error_empty_msg='recovery email is required !' required> <p id='error_line' class=' hide'></p> 
 </td></tr></table>

<div class=\"form_footer_btns\">   
<a href='#'  style='margin-left:auto' file_name=\"php_files/clasess/reset_class.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Send me login details</span></a>


<span style='margin-left:4px; margin-right:4px;'>|</span>

<a href='#' title='back to login or ragister.'   onclick=\"get_template.settings('pages/forms/login_form.php');\"> back to login or ragister. </a>


 
</div>


</form>";

}

 









 
 
// submited 
if(isset($_POST['data'])){
   
  echo reset_form();

}









?>