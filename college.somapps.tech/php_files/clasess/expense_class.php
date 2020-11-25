
<?php 
     include 'db_connector.php';
 
 

 
 
 // add or edit transaction 
function exp_add_update($data){
  global $current_user;
  if(check_token($data['crf_code'],'check')){
           $data = clean_security($data);
            
             if (!empty($data['id'])) {
                      // update 
                       mysqli_query_("UPDATE `expenses` set name='{$data['name']}', type='{$data['type']}', quantity='{$data['quantity']}',cost='{$data['cost']}',`date`='{$data['date']}',`user_id`='$current_user',`description`='{$data['description']}' where id={$data['id']}"); 
        return 'ok';  

              }else{
                    mysqli_query_("INSERT INTO `expenses`(`name`,`type`, `quantity`, `cost`,`date`,`description`,`user_id`) VALUES('{$data['name']}','{$data['type']}','{$data['quantity']}','{$data['cost']}','{$data['date']}','{$data['description']}','$current_user')");
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


   echo  exp_add_update($_POST['data']);
     // Export_Database($myServer,$myUser,$myPass,$myDB);

}
 


?>
