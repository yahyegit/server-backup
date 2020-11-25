<?php
    require '../../clasess/dataBase_class.php';

  


 function get_login_form(){

 return "



<div id=\"tabs_login\" style=\"
     margin:auto auto;
     width: 500px; 
 
 clear:both;
\">
 
  <div id=\"login\"  >
  
 <form file_name=\"php_files/clasess/auth.php\" style=\"
  display:none;
\" id='login_form_l' action='#'  >

<table class='table'>

 
<tr>
 <td><label class=''> Username </label></br> <input type='hidden' name='crf_code'  verror_empty_msg='Username is required !'  alue='".get_unique_code()."' autofocus > 
 <input type='text'  placeholder='username'  name='username' value=''  required>  </td></tr>
<tr>
 
 <td>  <label class=''> Password </label></br>
 <input type='password' error_empty_msg='password can't be empty !'  placeholder='password' name='password' required >  </td></tr>
 </table>




<div class=\"form_footer_btns\">   

<a href='#' form_id=\"login_form\" file_name=\"php_files/clasess/auth.php\" class=\"submit_btn change ui-button ui-widget primary_button ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon  \"></span><span class=\"ui-button-text\">Login</span></a>

 <br>
<a href='#' style='color:#7c11a2; display:none'  title='click to get your login credentials .'   onclick=\"get_template.settings('pages/forms/reset_form.php');\"> forgot password ? </a>
 
</div>


</form>
  </div>


    









  </div>

 



 ";

 

 }






 
 
// submited 
if(isset($_POST['data'])){
  
  echo get_login_form();

}









?>