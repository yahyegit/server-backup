<?php
    require '../../clasess/dataBase_class.php';

     require '../../clasess/service_class.php';
 


 function get_login_form(){

 return "

<div id=\"tabs_login\" style=\"
    width: 34%;    float: right;
    
\">
  <ul style=\"
 
\"> <li style=\"
    margin-bottom: 3px;  
\"><a href=\"#register\"   onclick=\"$('#login_form').fadeOut(); $('#register_form').fadeIn(); \" >Register</a></li>
    <li><a href=\"#login\"  onclick=\"$('#register_form').fadeOut(); $('#login_form').fadeIn();\" >Login</a></li>
   
  </ul>
  <div id=\"login\" style='margin-left:-20px;'>
  
 <form file_name=\"php_files/clasess/auth.php\" style=\"
  
\" id='login_form' action='#'  >

<table class='table'>

<tr><td>  <label class='show_'> Company name </label></br><input type='text' name='company_name' error_empty_msg='Company name is required !'  placeholder='your company name' > </td> </tr>
<tr>
 <td><label class='show_'> Username </label></br> <input type='hidden' name='crf_code'  verror_empty_msg='Username is required !'  alue='".get_unique_code()."'  > 
 <input type='text'  placeholder='username'  name='username' value=''  required>  </td></tr>
<tr>
 
 <td>  <label class='show_'> Password </label></br>
 <input type='password' error_empty_msg='password can't be empty !'  placeholder='password' name='password' required >  </td></tr>
 </table>




<div class=\"form_footer_btns\">   

<a href='#' form_id=\"login_form\" file_name=\"php_files/clasess/auth.php\" class=\"submit_btn change ui-button ui-widget primary_button ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon  \"></span><span class=\"ui-button-text\">Login</span></a>

 <br>
<a href='#' style='color:#7c11a2;'  title='click to get your login credentials .'   onclick=\"get_template.settings('pages/forms/reset_form.php');\"> forgot password ? </a>
 
</div>


</form>
  </div>
  <div id=\"register\" style='margin-left:-20px;'>  

 <form id='register_form' style=\"
 
\" file_name=\"php_files/clasess/register_class.php\"    >
 
<table class='table'> 
<tr>   <td>  <label class='show_'> Company name </label></br><input error_empty_msg='Company name is required !' type='text' name='company_name' placeholder='your company name' > </td> </tr>

<tr>
 
 <td> <input type='hidden' name='crf_code'  value='".get_unique_code()."'  > <label class='show_'> Username </label></br>
 <input type='text' error_empty_msg='Username is required !'  name='username' value=''  required>  </td></tr>
<tr>
 
 <td>  <label class='show_'> Password </label></br>
 <input type='password' name='password' required error_empty_msg='Password is required !' >  </td></tr>

 <tr>  
<td><label class='show_'>Email (<i>optional</i>)</label></br>
<input type='email' name='email' value='' placeholder='optional' > 
 </td></tr>



 </table>


<div class=\"form_footer_btns\">   

<a href='#' form_id=\"register_form\" file_name=\"php_files/clasess/register_class.php\" class=\"submit_btn change primary_button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon \"></span><span class=\"ui-button-text\">Register trail</span></a>

 
</div>

</form>

  </div>

</div>



<script type=\"text/javascript\">
      
    $(\"input[name='company_name']:first\").autocomplete({
      source: ".json_encode(get_companies_list())."
    });
 
    $( \"#tabs_login\" ).tabs();
</script>

 ";

 

 }






 
 
// submited 
if(isset($_POST['data'])){
  
  echo get_login_form();

}









?>