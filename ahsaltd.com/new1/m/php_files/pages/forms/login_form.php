<?php
    require '../../clasess/dataBase_class.php';



 function get_login_form(){

 return "


 <form id='login_form' action='#'  style='
    width: 50%;
    margin: 0 auto;'>


<div  style='font-style: italic;text-align: center;padding:10px;' class='ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix' style='
   text-align: left;
    margin-bottom: 4px;
 '><span id='ui-id-13' class='ui-dialog-title'>login to ".mysqli_result_(mysqli_query_("select company_name from settings limit 1"), 0)." </span>  </div>

<table class='table'><tr>
 
 <td>	<input type='hidden' name='crf_code'  value='".get_unique_code()."'  > 
 <input type='text' name='username' value='' placeholder='username' required>  </td></tr>
<tr>
 
 <td>  
 <input type='password' placeholder='password' name='password' required >  </td></tr>
 </table>


<div class=\"form_footer_btns\">   
<a href='#' style='  margin-left: 0px;' file_name=\"php_files/clasess/auth.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Login</span></a>

</a>
</div>

</form>";

 

 }






 
 
// submited 
if(isset($_POST['data'])){
  
  echo get_login_form();

}









?>