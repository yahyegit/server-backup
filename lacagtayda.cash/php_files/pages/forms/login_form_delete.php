<?php
    require '../../clasess/dataBase_class.php';

     require '../../clasess/service_class.php';
 


 function get_login_form($data){

 return "
 
 
  <div id=\"login\" >
  <div id=\"error\" title=\"Error\" style=\" display:none; margin: auto;margin-bottom:3px;\">  </div>
 <form class='form' file_name=\"php_files/clasess/auth.php\" style=\"
  
\" id='login_form' action='#'  >

<table class='table'>
 
 <td><label class='show_'> Username </label></br> <input type='hidden' name='crf_code'   value='".get_unique_code()."'  > 




 <input type='hidden' name='id'   value='{$data['id']}'  > 

 <input type='hidden' name='table'   value='{$data['table']}'  > 




 <input type='text'  placeholder='username'  name='username' value=''  required>  </td></tr>
<tr>
 
 <td>  <label class='show_'> Password </label></br>
 <input type='password' error_empty_msg='password can't be empty !'  placeholder='password' name='password' required >  </td></tr>
 </table>




<div class=\"form_footer_btns\" style=\"
    background: #fafbfc;
\">   

<a href='#' form_id=\"login_form\" file_name=\"php_files/clasess/delete_auth.php\" class=\"submit_btn change ui-button ui-widget primary_button ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon  \"></span><span class=\"ui-button-text\">Delete</span></a>
 
 <a href='#'  class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\"  onclick=\"$('#warning').dialog('close');\"  aria-disabled=\"false\" style=\"
    margin-left: 32px;
\"><span class=\"ui-button-icon-primary ui-icon ui-icon-closethick\"></span><span class=\"ui-button-text\">No</span></a>
</div>


</form>
 
  </div>
 

 

 ";

 

 }






 
 
// submited 
if(isset($_POST['data'])){
  
  echo get_login_form($_POST['data']);

}









?>