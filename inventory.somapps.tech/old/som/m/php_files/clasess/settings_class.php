<?php
 include 'db_connector.php';
 // require 'extra_functions.php';
 include 'service_class.php';


function change_settings($data){
	global $current_user; 
 		//$data =  array_keys($data);
	if(check_token($data['crf_code'],'check')){

		 	if(!empty($data['current_password'])){
					// change password
					$pass =  enc_password(sanitize($data['current_password']));
					$new_pass =   enc_password(sanitize($data['password_new']));   

							if($data['id'] != $current_user) {
								exit('error changing');
							}


					if(mysqli_result_(mysqli_query_("select count(username) from users where password='$pass' and id='".sanitize($data['id'])."' "),0) == '1'){
						mysqli_query_("update users set password='$new_pass' where id='".sanitize($data['id'])."' ");
					 	//service_update($data);
						check_token($data['crf_code'],'');   // remove_crf
						return 'ok';
					}else{
						return 'incorrect current password';
					}
		 			
			}else{  
					foreach($data as $key => $value) {
						if($key !='crf_code' ){

						 
						if($key =='username'){
							if ($data['id'] != $current_user) {
								exit('error changing');
							}
							     mysqli_query_("update users set username='".sanitize($data['username'])."' where id='".sanitize($data['id'])."' ");
							            exit(); 
							     
							 }else{

if (is_admin($current_user)) {
   mysqli_query_("update settings set ".sanitize($key)." ='".sanitize($value)."'"); 
}



							 }


 							    
	
							 
							}
						}

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





