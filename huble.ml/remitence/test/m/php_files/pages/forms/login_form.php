<?php
    require '../../clasess/dataBase_class.php';

     require '../../clasess/service_class.php';
 


 function get_login_form(){

 return "

 <div style='display:none'>
<div class='l_page_list'>


    <p  > Wuxuu kaacaawinayaa <b>sarifka</b>, <b>lacag haynta</b> iyo <b> Daymaha </b>  </p> 
    <p  ><b>Lacag kasta</b> waad ku isticmaali kartaa </p>
    <p  > <b>Xisaab xirka</b>,<b>daymaha</b>, <b>dadkad lacagaha uhaysid</b>,  <b>faaiidooyinka</b> iyo wax yaabo kale </p>
    <p  >Daily backup na wuu leeyahay oo google drive ah </p>
    <p  > Bilaash kutijaabi kadib nalasoo xiriir  </p> 
    <p  > Waa program easy ah tooba bar uuma baahna. </p>
    <p  > Hadaad rabtid in wax lagaaga badalo waa diyaar for free </p>

</div>


</div>

 
  
 <div class='form' file_name=\"php_files/clasess/auth.php\" style=\"
   width: 50%;
     margin-top: 150px !important;
\" id='login_form' action='#'  >

<table class='table'>

 
<tr>
 <td><label class='show_'> Username </label></br> <input type='hidden' name='crf_code'  verror_empty_msg='Username is required !'  alue='".get_unique_code()."'  > 
 <input type='text'  placeholder='username'  name='username' value=''  required>  </td></tr>
<tr>
 
 <td>  <label class='show_'> Password </label></br>
 <input type='password' error_empty_msg='password can't be empty !'  placeholder='password' name='password' required >  </td></tr>
 </table>




<div class=\"form_footer_btns\">   

<a href='#' form_id=\"login_form\" file_name=\"php_files/clasess/auth.php\" class=\"submit_btn change ui-button ui-widget primary_button ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon  \"></span><span class=\"ui-button-text\">Login</span></a>

 <br><br>
<a href='#' style='color:#7c11a2;'  title='click to get your login credentials .'   onclick=\"get_template.settings('pages/forms/reset_form.php');\"> forgot password ? </a>
 
</div>


</div>

   <script type='text/javascript' > 

 

$(\"#des-sit-toggle\").hide();
 </script> 
 ";

 

 }






 
 
// submited 
if(isset($_POST['data'])){
  
  echo get_login_form();

}









?>