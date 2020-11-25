


<?php
 include 'db_connector.php';
 

function update_($data){
 		//$data =  array_keys($data);
	global $current_user;


	if(check_token($data['crf_code'],'check')){


       $data['amount'] =  mysqli_result_(mysqli_query_("select amount from payments where id={$data['id']} "),0); 
 
	  
    $remain_limit = mysqli_result_(mysqli_query_("select current_remaining_limit from users where id=$current_user "),0);

    if(preg_match('/-/',$remain_limit-$data['amount'])){
                  exit('invalid <b>amount</b><br> your current payment   limit is: <b>$'.number_format($remain_limit).'<b> ');
       }


					foreach($data as $key => $value) {
						if($key !='crf_code' ){

						 	if($key !='id'){

		                            if($key =='paid_user_id'){
		                            	$value = $current_user;
		                            }
 

							      mysqli_query_("update payments set ".sanitize($key)." ='".sanitize($value)."' where id='{$data['id']}' "); 
	
							 } 

 
							}
						}

       update_limit($current_user,$data['amount'],'-');

 						check_token($data['crf_code'],'');   // remove_crf
	  					return 'ok';
					 
						
	 

	}else{
		echo 'login';
	}	
		
}



// submited request handler
if(isset($_POST)){   //print_r($_POST);
	 if_logged_in('die');
	  echo update_($_POST['data']);
}

?>






