<?php
 include 'db_connector.php';
 

function change_settings($data){
	global $current_user; 
   		  $data = clean_security($data);
	if(check_token($data['crf_code'],'check')){
 
				if (empty($data['id'])) {
					mysqli_query_("INSERT INTO `suppliers`( `s_name`, `mobile` ) VALUES ('{$data['n_name']}','{$data['mobile']}')");
				}else{
				 
				     mysqli_query_("update suppliers set s_name='{$data['s_name']}',  mobile='{$data['mobile']}' where id={$data['id']} ");
				}


						///service_update($data);
						check_token($data['crf_code'],'');   // remove_crf
	  					return 'ok';
					 
						
	 

	}else{
		echo 'login';
	}	
		
}



// submited request handler
if(isset($_POST)){   //print_r($_POST);
	 if_logged_in('die');
	  echo change_settings($_POST['data']);
}

?>





