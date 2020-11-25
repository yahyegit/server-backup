
<?php 
     include 'db_connector.php';
 
 

 
 
 // add or edit transaction 
function users_add_update($data){
  if(check_token($data['crf_code'],'check')){
           $data = clean_security($data);
            $password = (!empty($data['password']))?",password='".enc_password($data['password'])."'":'';
             if (!empty($data['id'])) {
                     if (!user_exists($data['username'],$data['id'])){

                      // update 
                       mysqli_query_("UPDATE `users` set full_name='{$data['full_name']}',  type='{$data['type']}',  username='{$data['username']}' $password where id={$data['id']}"); 
        return 'ok';  
                    }else{
                      return "sorry <strong> {$data['username']} </strong> is already exists .";
                    }
              }else{
                 if (!user_exists($data['username'],'')){
                        mysqli_query_("INSERT INTO `users`(`full_name`, `username`, `password`,`type`,status) VALUES('{$data['full_name']}','{$data['username']}','".enc_password($data['password'])."','staff','1')");
                      }else{
                      return "sorry <strong> {$data['username']} </strong> is already exists .";
                    }


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


   echo  users_add_update($_POST['data']);
     // Export_Database($myServer,$myUser,$myPass,$myDB);

}
 


?>
