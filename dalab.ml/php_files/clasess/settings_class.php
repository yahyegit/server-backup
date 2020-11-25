<?php
  require 'dataBase_class.php';


function change_settings($data){
 		//$data =  array_keys($data);
	if(check_token($data['crf_code'],'check')){

		 	if(!empty($data['current_password'])){
					// change password
					$pass =  enc_password(sanitize($data['current_password']));
					$new_pass =   enc_password(sanitize($data['password_new']));   
					if(mysqli_result_(mysqli_query_("select count(username) from settings where password='$pass'"),0) == '1'){
						mysqli_query_("update settings set password='$new_pass', pw_last_changed='".date('Y-m-d')."' ");
						check_token($data['crf_code'],'');   // remove_crf
						return 'ok';
					}else{
						return 'incorrect current password';
					}
		 			
			}else{  
					foreach($data as $key => $value) {
						if($key !='crf_code' ){
								mysqli_query_("update settings set ".sanitize($key)." ='".sanitize($value)."'"); 
						}

					}
						check_token($data['crf_code'],'');   // remove_crf
						return 'ok';
			}
	}else{
		echo 'login';
	}	
		
}



// submited request handler
if(isset($_POST)){
	 if_logged_in('die');
	  echo change_settings($_POST['data']);
}

?>





