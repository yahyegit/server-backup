
<?php 
     include 'db_connector.php';
 
 

 
 
 // add or edit transaction 
function limit_add_update($data){

  if(check_token($data['crf_code'],'check')){
           $data = clean_security($data);
          $data['amount'] = str_replace(',','',$data['amount']);

            $password = (!empty($data['password']))?",password='".enc_password($data['password'])."'":'';
             if (!empty($data['id'])) {
           
                      // update 
                       mysqli_query_("UPDATE `limit_history` set amount='{$data['amount']}', send_amount='{$data['send_amount']}', user_id='{$data['user_id']}', description='{$data['description']}', `date`='{$data['date']}'  where id={$data['id']}"); 
                 
              }else{
 
                         mysqli_query_("INSERT INTO `limit_history`( `amount`,`send_amount`,`user_id`, `description`, `date`) VALUES ('{$data['amount']}','{$data['send_amount']}','{$data['user_id']}','{$data['description']}','{$data['date']}')");
      
              } 
          update_limit($data['user_id'],$data['amount'],'+');
          update_limit($data['user_id'],$data['send_amount'],'+s');

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
    if (is_admin($current_user)) {

          echo  limit_add_update($_POST['data']);
     // Export_Database($myServer,$myUser,$myPass,$myDB);

 }

}

  

 


?>
