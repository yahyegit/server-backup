<?php
 include 'db_connector.php';
 

function change_settings($data){
	global $current_user; 
   		  $data = clean_security($data);
	   
	   mysqli_query_("update settings set defaut_exp='{$data['defaut_exp']}'  ");
		
}



// submited request handler
if(isset($_POST)){   //print_r($_POST);
	 if_logged_in('die');
	  echo change_settings($_POST['data']);
}

?>





