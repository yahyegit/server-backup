<?php
 include 'db_connector.php';
 

function change_settings($data){
	global $current_user; 
   		  $data = clean_security($data);
	if(check_token($data['crf_code'],'check')){
 
				if (empty($data['id'])) {
					mysqli_query_("INSERT INTO `customers`( `customer_name`, `mobile`, `address`,`email`) VALUES ('{$data['customer_name']}','{$data['mobile']}','{$data['address']}','{$data['email']}')");
				}else{
				 
				     mysqli_query_("update customers set customer_name='{$data['customer_name']}',  email='{$data['email']}', address='{$data['address']}',     mobile='{$data['mobile']}' where id={$data['id']} ");
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





