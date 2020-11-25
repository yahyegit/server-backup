<?php
 include 'db_connector.php';
 

function change_settings($data){
 		//$data =  array_keys($data);
	if(check_token($data['crf_code'],'check')){


	//$old_subject = mysqli_result_(mysqli_query_("select subject from student_subjects where id='{$data['id']}'  "), 0);

		if ($data['admin_date'] > 31) {
		  exit('invalid billing date ');
		}else{
		  $data['admin_date'] = date('Y-m').'-'.$data['admin_date'];  
		}

	  
					foreach($data as $key => $value) {
						if($key !='crf_code' ){

						 	if($key !='id'){

					 $key = ($key =='monthly_discount')?'discount':$key;


							      mysqli_query_("update student_subjects set ".sanitize($key)." ='".sanitize($value)."' where id='{$data['id']}' "); 
	
							 } 

 
							}
						}

					  // update unpaid invoices 
/*echo "update invoices set student_subject ='".sanitize($data['subject'])."' where student_subject='$old_subject' and student_id='{$old['student_id']}' and balance!='0' ";
  mysqli_query_("update invoices set student_subject ='".sanitize($data['subject'])."' where student_subject='$old_subject' and student_id='{$old['student_id']}' and balance!='0' "); 
*/

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






