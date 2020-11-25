<?php
 include 'db_connector.php';
 

function change_settings($data){
 		//$data =  array_keys($data);
	if(check_token($data['crf_code'],'check')){

	  
					foreach($data as $key => $value) {
						if($key !='crf_code' ){

						 	if($key !='id'){
							      mysqli_query_("update students set ".sanitize($key)." ='".sanitize($value)."' where id='{$data['id']}' "); 
	
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





