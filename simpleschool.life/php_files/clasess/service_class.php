<?php
 
 include 'db_connector.php';
 



function company_exist($data){
 //$data = clean_security($data);
 global $connection;
 global $myDB;
 $connection->select_db("college_service");


 if(mysqli_result_(mysqli_query_("select count(id) from customers  where company_name='".sanitize($data)."'"),0) == '0'){
     return false;
 }else{
   return false;
 }
 


   select_database_();// select back the user db 
}

function get_companies_list(){
  global $connection;
 global $myDB;
 $connection->select_db("college_service");
$row = [];
$qr = mysqli_query_("select company_name from customers ");
while($q = mysqli_fetch_assoc_($qr)){
$row[] = $q['company_name'];
 }
return $row;
   select_database_();// select back the user db 
}
 
function service_update($data){
 $data = clean_security($data);
 global $connection;
 global $myDB;
 $connection->select_db("college_service");
 
  foreach($data as $key => $value) {
            if($key !='crf_code' ){

            if($key == 'current_password'){
              $key = 'password';
            }
              if($key == 'password_new'){
              $key = 'password';
            }
         //   echo "update customers set ".sanitize($key)." ='".sanitize($value)."' where company_name='".str_replace('college_', '',$myDB)."' ";
                mysqli_query_("update customers set ".sanitize($key)." ='".sanitize($value)."' where company_name='".str_replace('college_', '',$myDB)."' ");
            }

          }
 select_database_();// select back the user db 
}

 
function service_register($data){
 $data = clean_security($data);
 global $connection;
 $connection->select_db("college_service");

  mysqli_query_("INSERT INTO `customers`(`company_name`, `mobile`, `email`, `username`, `password`, `active_status`, `registered_date`, `delete_status`, `trail_days`) VALUES ('{$data['company_name']}','{$data['mobile']}','{$data['email']}','{$data['username']}','{$data['password']}','trail','".date('Y-m-d')."','0','15')");

   select_database_();// select back the user db 
}


function get_days_left($company_name){
 $company_name = sanitize($company_name);
 global $connection;
 $connection->select_db("college_service");

    if(mysqli_result_(mysqli_query_("select count(id) from customers where active_status='active' and company_name='$company_name'"),0) == 1){
      return 'registered';
    }else{
       $registered_date =  mysqli_result_(mysqli_query_("select registered_date from customers where company_name='$company_name'"),0);

       $trail_days =  mysqli_result_(mysqli_query_("select trail_days from customers where active_status='trail' and company_name='$company_name'"),0);
   

      $datediff = time() - strtotime($registered_date); 
      $left = $trail_days - round($datediff / (60 * 60 * 24));
      return (!preg_match('/-/', $left))?number_format( $left):'';

 
}


 select_database_();// select back the user db 
}

// only backup when registed 
 

 

   
?>
