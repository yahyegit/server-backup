
<?php 
     include 'db_connector.php';
         require 'auto_create.php';

 

 
 
 // add or edit transaction 
function register_student($data){
	if(check_token($data['crf_code'],'check')){
   		   // $data = clean_security($data);
   		    $courses_data = $data['courses_data'];
           $courses_ = '<div class="bl_list"> ';
     			for ($i=0; $i <  count($data['courses_data']['course']); $i++) { 
              $course =  sanitize($data['courses_data']['course'][$i]);
              $cost =   sanitize(str_replace(',','',$data['courses_data']['cost'][$i]));
              $duration =   sanitize($data['courses_data']['duration'][$i]);
              $data['balance'] = str_replace(',','',$data['balance']);
             $data['paid'] = str_replace(',','',$data['paid']);
 
             

              if (mysqli_result_(mysqli_query_("select course from courses where course = '$course'"),0) != 1) {

                  mysqli_query_("INSERT INTO `courses`(id,course,cost,duration) VALUES('','$course','$cost','$duration')");
                 }else{
                    /// exit("<strong>$course</strong> is already exists ");
                 }

                $courses_ .="<div c=\"~$course~\"> $course </div>";
              }
                $courses_ .=" </div>";

           	  mysqli_query_("INSERT INTO `students`(`id`,`category`, `name`, `courses`, `address`, `mobile`, `balance`,`date`,`description`,`due_date`) VALUES ('','{$data['category']}','{$data['name']}','$courses_','{$data['address']}','{$data['mobile']}','{$data['balance']}','{$data['date']}','{$data['description']}','{$data['due_date']}')");
              $stu_id = mysqli_result_(mysqli_query_("select id from students where delete_status !='1' ORDER BY id DESC LIMIT 1"));
             if (!empty($data['paid'])) {
                    mysqli_query_("INSERT INTO payments (`paid`,`time`,`description`,`balance`,`student_id`)VALUES('{$data['paid']}','{$data['date']}','{$data['description']}','{$data['balance']}','$stu_id')");
              } 
   
			 
				// remove_crf
				  check_token($data['crf_code'],''); 

				return 'ok';	
				  
	}else{
		return 'login';
	}
}








// submited 

   
 
 if(isset($_POST['data'])){
    if_logged_in('die');
    // echo 'posted';print_r($_POST['data']);


	  echo register_student($_POST['data']);
     // Export_Database($myServer,$myUser,$myPass,$myDB);

}
 


?>
