<?php
    require '../../clasess/dataBase_class.php';



 function get_bodyHider_form(){
   $cv_ = mysqli_result_(mysqli_query_("SELECT `body_hider` FROM `settings` LIMIT 1"), 0);
 return "
<div class='form' id='body_hider_form' action='#' style='margin:auto; width:40%' >
<input type='hidden' name='crf_code'  value='".get_unique_code()."'>
<table class='table'><tr>
 
 <td>	 <label class='show_'  >Content hider: </label><br>  
<select  remove_filter='true' name='body_hider' >

<option>enable</option>
<option>disable</option>
</select>
                                                                                                              
 </td></tr></table>

<div class=\"form_footer_btns\">   
<a href='#'  file_name=\"php_files/clasess/settings_class.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Submit</span></a>

<a href='#'  class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"close_element('#body_hider_form');\" role=\"button\" aria-disabled=\"false\" style=\"
    margin-left: 32px;
\"><span class=\"ui-button-icon-primary ui-icon ui-icon-closethick\"></span><span class=\"ui-button-text\">Close</span></a>
</div>


</div>";

 

 }









 
 
// submited 
if(isset($_POST['data'])){
    if_logged_in('die');
  
  echo get_bodyHider_form();

}









?>