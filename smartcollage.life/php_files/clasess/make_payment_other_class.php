
<?php 
     include 'db_connector.php';
 
 

 
 // add or edit transaction 
function pay_now($data){
  global $current_user;
  if(check_token($data['crf_code'],'check')){
           $data = clean_security($data);
               $data['balance'] = 0;
               $data['amount'] = str_replace(',','',$data['amount']);
              $data['discount'] = str_replace(',','',$data['discount']);

 
               $data['amount'] = (empty($data['amount']))?0: $data['amount'];
             $data['discount'] = (empty($data['discount']))?0: $data['discount'];
             if (preg_match('/-/', $data['balance'])) {
                  exit('invalid paid or discount please check ');
             }
		$data['description'] .= ' *_ ';
               $total = $data['amount']+$data['discount'];
             if (!empty( $total) ) {
                mysqli_query_("INSERT INTO payments (`student_id`,`amount`,`discount`,`date`,`description`,`taken_by` )VALUES('{$data['student_id']}','{$data['amount']}','{$data['discount']}','{$data['date']}','{$data['description']}','$current_user')");
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


  echo   pay_now($_POST['data']);
     // Export_Database($myServer,$myUser,$myPass,$myDB);

}
 


?>
