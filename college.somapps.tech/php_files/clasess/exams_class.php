<?php

     include 'db_connector.php';

function exams($data){
 
	if(check_token($data['crf_code'],'check')){
 
             if (!empty($data['id'])) {
             	           $data = clean_security($data);

					   mysqli_query_("UPDATE `exams` SET  `subject`='{$data['subject']}',`marks`='{$data['marks']}',`date`='{$data['date']}',`student_id`='{$data['student_id']}' WHERE id='{$data['id']}'  ");
  
			}else{


			   for ($i=0; $i <  count($data['courses_data']['subject']); $i++) { 
                       $subject =  sanitize($data['courses_data']['subject'][$i]);
						 $subject =  sanitize($data['courses_data']['subject'][$i]);
						  $marks =  sanitize($data['courses_data']['marks'][$i]);
						   $student_id =  sanitize($data['courses_data']['student_id'][$i]);
						  $date =  sanitize($data['courses_data']['date'][$i]);

//echo "INSERT INTO `exams`(  `subject`, `marks`, `date`, `student_id`) VALUES ('$subject','$marks','$date','$student_id' )";

                      mysqli_query_("INSERT INTO `exams`(  `subject`, `marks`, `date`, `student_id`) VALUES ('$subject','$marks','$date','$student_id' )");

                  }

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
	   //echo 'posted';print_r($_POST);

	  echo exams($_POST['data']);
}



?>
