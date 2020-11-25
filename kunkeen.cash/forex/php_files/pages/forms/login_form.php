<?php
    require '../../clasess/dataBase_class.php';

/*function available_companies(){
      return json_encode(explode(',',file_get_contents('../../clasess/avai_companies.txt')));

 
}
*/
 function get_login_form(){

 return "
 
 <form id='login_form' action='#'  style='
    width: 50%;
    margin: 0 auto;'>

<table class='table c_ac_page'>
 
<tr>
 <th colspan='2'>Login to <b>".mysqli_result_(mysqli_query_("select company_name from settings limit 1"), 0)." </b></th> 

</tr>

<tr><td>
 <label class=''> username </label> <br>
  <input type='hidden' name='crf_code' value='".get_unique_code()."'  > 
 <input type='text' name='username' value='' placeholder='enter username'   required>  </td></tr>
<tr>
  <td>   <label class=''> passwrod </label> <br>

 <input type='password' name='password'  placeholder='enter password'  required >  </td></tr>
 </table>


<div class=\"form_footer_btns\">   

<a href='#'  file_name=\"php_files/clasess/auth.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Login</span></a>


 
<br><br>
 
<a href='#' title='get your login details '   onclick=\"get_template.settings('pages/forms/reset_form.php');\"> forget passwrod or username . </a>

</div>

</form>



 

";

 

 }






 
 
// submited 
if(isset($_POST['data'])){
  
  echo get_login_form();

}









?>