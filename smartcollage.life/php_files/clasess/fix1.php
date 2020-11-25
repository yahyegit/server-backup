
 <?php
   include 'db_connector.php'; 
   $err = array();

/*
   $qq = mysqli_query_("SELECT `id`, `student_id`, `student_subject`, `subject_id`, `balance` FROM `invoices` WHERE  `delete_status`!='1' ");


//die();
   while ($q = mysqli_fetch_assoc_($qq)) {
// Scientific, (3:00 pm) (Alas)  2020-Feb-01 to 2020-Mar-01
      $qqq = explode(', from',$q['student_subject']);
      $date = explode('to',$q['student_subject']);

      $from_ = date('Y-m-d',strtotime(trim($date[0])));
      $to_ = date('Y-m-d',strtotime(trim($date[1])));


      $subject = explode(',', $qqq[0]);
       $subject_name =  trim($subject[0]);
  $subject_ =  explode(')',trim($subject[1]));

       $subject_time =  trim(str_replace('(','', $subject_[0]));
       $subject_time_o =  trim(str_replace('(','', $subject_[0]));

       $subject_teacher =  trim(str_replace('(','',$subject_[1]));

 $subject_time = str_replace('pm','',strtolower($subject_time));
 $subject_time = str_replace(' ','',strtolower($subject_time));
 $subject_time = str_replace('am','',strtolower($subject_time));
  $subject_time = str_replace('00','',strtolower($subject_time));
  $subject_time = str_replace('30','',strtolower($subject_time));

   $subject_id = mysqli_result_(mysqli_query_("select id from subjects where subject='$subject_name' and  time like '%$subject_time%' and  teacher='$subject_teacher' order by id asc limit 1"), 0);


 if (empty($subject_id)) {
    $err[] = "select id from subjects where subject='$subject_name' and  time like '%$subject_time%' and  teacher='$subject_teacher' order by id asc limit 1"; 
 }

    mysqli_query_("update student_subjects set subject_id ='$subject_id' where subject='".trim($qqq[0])."' ");


     mysqli_query_("update students set `delete_status`='0' where student_id={$q['student_id']}");

    mysqli_query_("update invoices set delete_status='0', student_subject ='$subject_name, ($subject_time_o) ($subject_teacher)'  where id={$q['id']}  "); 



        }*/
 


/*


   $qq = mysqli_query_("SELECT `id`, `student_id`, `from_date`, `to_date`, `subject_id`, `balance` FROM `invoices` WHERE `from_date`='0000-00-00' and `delete_status`!='1' ");
 $err = array();

 
   while ($q = mysqli_fetch_assoc_($qq)) {
 
   $admin_date = mysqli_result_(mysqli_query_("select admin_date from student_subjects where student_id='{$q['student_id']}'  "), 0);

  if (empty($admin_date)) {
    $err[] = "select admin_date from student_subjects where student_id='{$q['student_id']}'  "; 
 }

  //die("update invoices set from_date='$admin_date',to_date='".date('Y-m-d',strtotime("+1 month ".$admin_date))."'  where id={$q['id']}  ");
    mysqli_query_("update invoices set from_date='$admin_date',to_date='".date('Y-m-d',strtotime("+1 month ".$admin_date))."'  where id={$q['id']}  "); 



        }
















 print_r( $err);
*/




 

   $qq = mysqli_query_("SELECT `id`,`subject`, `subject_id` FROM `student_subjects` WHERE `subject` NOT LIKE '%:%'  and `delete_status`!='1' ");
 $err = array();

 
   while ($q = mysqli_fetch_assoc_($qq)) {
     $qa = mysqli_query_("select * from subjects where id='{$q['subject_id']}'  ");

   $subject = mysqli_fetch_assoc_($qa);

  if (empty($subject['subject'])) {
    $err[] = "select * from subjects where id='{$q['subject_id']}'  "; 
 }
//die("update student_subjects set subject='{$subject['subject']}, ({$subject['time']}) ({$subject['teacher']})' where id='{$q['id']}'");

 mysqli_query_("update student_subjects set subject='{$subject['subject']}, ({$subject['time']}) ({$subject['teacher']})' where id='{$q['id']}'");

 

        }




?>
