<?php

     include 'db_connector.php';

function change_settings($data){
           $data = clean_security($data);
	if(check_token($data['crf_code'],'check')){



             if (!empty($data['id'])) {
					$ao = mysqli_query_("select * from subjects where id='{$data['id']}' ");
					$old = mysqli_fetch_assoc_($ao);
 

 					 	    mysqli_query_("UPDATE `subjects` SET  `subject`='".sanitize($data['subject'])."',`teacher`='".sanitize($data['teacher'])."' ,`time`='".sanitize($data['time'])."', `cost`='".sanitize($data['cost'])."' ,`description`='".sanitize($data['description'])."'  where id='".sanitize($data['id'])."' ");

           					   mysqli_query_("UPDATE `invoices` SET `student_subject`='{$data['subject']}, ({$data['time']}) ({$data['teacher']})' WHERE `student_subject`='{$old['subject']}, ({$old['time']}) ({$old['teacher']})'");

					 	     mysqli_query_("update student_subjects set subject='{$data['subject']}, ({$data['time']}) ({$data['teacher']})'  where subject='{$old['subject']}, ({$old['time']}) ({$old['teacher']})'  "); 


				  
			}else{
                    mysqli_query_("INSERT INTO `subjects`(`subject`, `time`,`teacher`, `cost`,`description`) VALUES('{$data['subject']}','{$data['time']}','{$data['teacher']}','{$data['cost']}','{$data['description']}')");

			}
 
						///service_update($data);
						check_token($data['crf_code'],'');   // remove_crf
	  					return 'ok';
 
	}else{
		echo 'login';
	}	
		
}


 //print_r($_POST);


// submited request handler
if(isset($_POST)){  
	 if_logged_in('die');
	  echo change_settings($_POST['data']);
}



?>
