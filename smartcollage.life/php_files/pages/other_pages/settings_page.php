<?php
 include '../../clasess/db_connector.php';

function get_settings_page(){
global $current_user;
	return "
 <table class='table settings_page c_ac_page'>
 <tr> <th>Username</th> <td> ".mysqli_result_(mysqli_query_("select username from users where id='$current_user' "), 0)."  <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"request_template('',{id:$current_user},'pages/forms/edit_company_username_form.php')\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>change</span></button></td>  </tr> 
 

  <tr> <th> Password </th>  <td> *********  <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"request_template('',{id:$current_user},'pages/forms/edit_company_password_form.php')\"  role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>change</span></button></td>  </tr> 
".((is_admin($current_user))?"
  <tr> <th>Recorvery Email</th> <td> ".mysqli_result_(mysqli_query_("select email from settings limit 1"), 0)."  <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.settings('pages/forms/edit_password_recovery_email_form.php')\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>change</span></button></td>  </tr> 

  <tr> <th> school name </th> <td> ".mysqli_result_(mysqli_query_("select company_name from settings limit 1"), 0)."  <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.settings('pages/forms/edit_company_name_form.php')\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>change</span></button></td>  </tr> 

 <tr> <th>school mobile</th> <td> ".mysqli_result_(mysqli_query_("select mobile from settings limit 1"), 0)."  <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.settings('pages/forms/edit_company_mobile_form.php')\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>change</span></button></td>  </tr> 


 

":"")."


 </table>";

}

// submited 
if(isset($_POST['data'])){
    if_logged_in('die');

	echo get_settings_page();

}


?>