<?php
    require '../../clasess/dataBase_class.php';

/*function available_companies(){
	    return json_encode(explode(',',file_get_contents('../../clasess/avai_companies.txt')));

 
}
*/
 function get_register_form(){

 return "


 <form id='login_form' action='#'  style='
    width: 50%;
    margin: 0 auto;'>
<div  style='font-style: italic;text-align: center;padding:10px;' class='ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix' style='
    text-align: center;
    margin-bottom: 4px;
'> Registering to kunkeen    </div>
<table class='table'>
<tr>   <td>  <label class='show_'> Company name </label></br><input type='text' name='company_name' placeholder='your company name' > </td> </tr>

<tr>
 
 <td>	<input type='hidden' name='crf_code'  value='".get_unique_code()."'  > <label class='show_'> Username </label></br>
 <input type='text' name='username' value=''  required>  </td></tr>
<tr>
 
 <td>  <label class='show_'> password </label></br>
 <input type='password' name='password' required >  </td></tr>

 <tr>  
<td><label class='show_'>Email (<i>optional</i>)</label></br>
<input type='email' name='email' value='' placeholder='optional' > 
 </td></tr>



 </table>


<div class=\"form_footer_btns\">   

<a href='#'  file_name=\"php_files/clasess/register_new_company.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Register trail</span></a>


<span style='margin-left:4px; margin-right:4px;'>|</span>

<a href='#' title='already have an account login.' onclick=\"get_template.settings('pages/forms/login_form.php');\" class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\"> Login </span></a>

 
</div>

</form>



 

";

 

 }






 
 
// submited 
if(isset($_POST['data'])){
  
  echo get_register_form();

}









?>