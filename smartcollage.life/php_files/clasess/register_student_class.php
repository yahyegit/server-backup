
<?php 
     include 'db_connector.php';
 
 

 
 
 // add or edit transaction 
function register_student($data){
  global $current_user;

  	if(check_token($data['crf_code'],'check')){


if (preg_match('/-/', $data['balance'])) {
      exit('invalid balance please check paid or discounts');
}

// fix date

if ($data['admin_date'] > 31) {
  exit('invalid billing date ');
}else{
  $data['admin_date'] = date('Y-m').'-'.$data['admin_date'];  
}

$data['gender']  = 'male';

/*  if (empty($data['gender'])) {
      exit('choose gender!');
    }*/


// register student 
if(empty($data['student_id'])){
 mysqli_query_("INSERT INTO `students`(`name`, `mobile`, `date`, `address`, `status`, `gender`, `description`) VALUES ('{$data['name']}','{$data['mobile']}','{$data['admin_date']}','{$data['address']}','1','{$data['gender']}','{$data['description']}')");
 $student_id = mysqli_result_(mysqli_query_("select student_id from students where  delete_status!='1' ORDER BY student_id DESC LIMIT 1"),0);
$data['student_id'] = $student_id;
}else{
  $student_id = sanitize($data['student_id']);
  $data['student_id'] = sanitize($data['student_id']);

}

$student_id = mysqli_result_(mysqli_query_("select student_id from students where  delete_status!='1' ORDER BY student_id DESC LIMIT 1"),0);

            // create student subject 
      for ($i=0; $i <  count($data['courses_data']['subject']); $i++) { 
                    $subject =  sanitize($data['courses_data']['subject'][$i]);
                  $oneTimeDisounct_ =  sanitize($data['courses_data']['oneTimeDisounct'][$i]);
                                
                    $cost =   sanitize(str_replace(',','',$data['courses_data']['cost'][$i]));
                    $monthly_discount =   sanitize(str_replace(',','',$data['courses_data']['monthly_discount'][$i])); 
                    $monthly_discount  = (ctype_digit($monthly_discount ))?$monthly_discount:0;
 $paid_ =   sanitize(str_replace(',','',$data['courses_data']['paid'][$i]));
  $subject_id =   sanitize(str_replace(',','',$data['courses_data']['subject_id'][$i]));

              
                     $teacher = mysqli_result_(mysqli_query_("select teacher from subjects where subject='$subject_id'"),0);
                     $time = mysqli_result_(mysqli_query_("select time from subjects where subject='$subject_id'"),0);                     
                     $discription = mysqli_result_(mysqli_query_("select description from subjects where subject='$subject_id'"),0);

                    // student subject 
                  mysqli_query_("INSERT INTO `student_subjects`(`subject`, `teacher`, `time`, `discount`, `cost`, `description`, `student_id`, `subject_id`, `admin_date`) VALUES ('$subject','$teacher','$time','$monthly_discount','$cost','$discription','$student_id','$subject_id','{$data['admin_date']}')");

 
              // create invoices
            $from_date = date('Y-m-d',strtotime("{$data['admin_date']}"));
            $to_date = date('Y-m-d',strtotime("+1 month $from_date"));
                  
                    $cos_d = $cost-$monthly_discount;
               mysqli_query_("INSERT INTO `invoices`(`student_id`, `from_date`, `to_date`, `student_subject`, `balance`, `status`) VALUES ('$student_id','$from_date','$to_date','$subject','$cos_d','1')");




// single payment 

        if (!empty($paid_ + $oneTimeDisounct_)) {
             
             $description = "<br>$subject, from $from_date to $to_date " ;

                mysqli_query_("INSERT INTO payments (`student_id`,`amount`,`discount`,`date`,`description`,`taken_by` )VALUES('{$data['student_id']}','$paid_','$oneTimeDisounct_','{$data['admin_date']}','$description','$current_user')");


   $inv_id =    mysqli_result_(mysqli_query_("select id from invoices where delete_status!='1' and balance!='0' ORDER BY id DESC  LIMIT 1"),0);
             $paid_ = $paid_ + $oneTimeDisounct_;

            mysqli_query_("update invoices set balance=balance-$paid_ where id='$inv_id' "); 
             }
                  
         


 

              }

             


              $data['balance'] = sanitize(str_replace(',','',$data['balance']));
             $data['paid'] = sanitize(str_replace(',','',$data['paid']));
             $data['discount'] = sanitize(str_replace(',','',$data['discount']));
 
              $data['paid'] = (ctype_digit($data['paid']))?$data['paid']:0;
              $data['discount'] = (ctype_digit($data['discount']))?$data['discount']:0;



// make payment 
 
/*        if (!empty($data['paid']+$data['discount'])) {
          
         mysqli_query_("INSERT INTO payments (`student_id`,`amount`,`discount`,`date`,`description`,`taken_by`)VALUES('$student_id','{$data['paid']}','{$data['discount']}','{$data['admin_date']}','{$data['description']}','$current_user')");

          $data['paid'] = $data['paid']+$data['discount'];
         fix_unpaid_invoices($student_id,$data['paid']);


    } */ 

 if (!empty($data['r_fee'])){
    mysqli_query_("INSERT INTO payments (`student_id`,`amount`,`discount`,`date`,`description`,`taken_by`)VALUES('$student_id','{$data['r_fee']}','0','{$data['admin_date']}','registration fee','$current_user')");

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

}
 


?>


