<?php
    require '../../clasess/dataBase_class.php';



 function get_login_form(){

 return "


 <form id='login_form'  action=\"php_files/clasess/auth.php\" method=\"post\"  style='
    width: 50%;
    margin: 0 auto;'>


<div  style='font-style: italic;text-align: center;padding:10px;' class='ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix' style='
    text-align: center;
    margin-bottom: 4px;
'><span id='ui-id-13' class='ui-dialog-title'>Welcome to ".mysqli_result_(mysqli_query_("select company_name from settings limit 1"), 0)." </span>  </div>

<table class='table'><tr>
 <th>username</th>
 <td>	<input type='hidden' name='crf_code'  value='".get_unique_code()."'  > 
 <input type='text' name='username'  required>  </td></tr>
<tr>
 <th>password</th>
 <td>  
 <input type='password' name='password' required >  </td></tr>
 </table>


<div class=\"form_footer_btns\">  

<input type=\"submit\" value='login' class=\" change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" >


</div>

</form>";

 

 }






 
 
// submited 
if(isset($_POST['data'])){
  
  echo get_login_form();

}









?>
