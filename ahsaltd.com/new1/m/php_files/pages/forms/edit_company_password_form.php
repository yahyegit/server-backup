<?php
require '../../clasess/dataBase_class.php';

function get_change_pw_form(){

 return "

 <form id='pass_form' action='#' style='
    width: 50%;
    margin: 0 auto;' >
<input type='hidden' name='crf_code'  value='".get_unique_code()."'>


<table class='table'><tr>

 
 <td>	
   <input type='password' placeholder='current password' name='current_password' error_empty_msg='password is required !' required> <p id='error_line' class=' hide'></p> </td> </tr>
<tr>
  
 <td>  

 <input type='password' placeholder='new password' name='password_new' id='newPass'  error_empty_msg='password is required !' required>  <p id='error_line' class=' hide'></p>
</td></tr>

 
<tr>
 <td>	
   <input type='password' placeholder='confirm password' pw_confirm='#newPass' error_empty_msg='password is required !' required><p id='error_line' class=' hide'></p> </td> </tr>

 </table>

<div class=\"form_footer_btns\">   
<a href='#'  style='  margin-left: 0px;' file_name=\"php_files/clasess/settings_class.php\" class=\"primary_button submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Submit</span></a>

<a href='#'  class=\"change ui-button  ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\"  onclick=\"close_element('#pass_form');\"  role=\"button\" aria-disabled=\"false\" style=\"
    margin-left: 32px;
\"><span class=\"ui-button-icon-primary ui-icon ui-icon-closethick\"></span><span class=\"ui-button-text\">Close</span></a>
</div>


</form>";

 

 }









 
 
// submited 
if(isset($_POST['data'])){
    if_logged_in('die');
  
  echo get_change_pw_form();

}









?>