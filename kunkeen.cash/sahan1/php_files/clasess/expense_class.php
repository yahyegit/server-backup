
<?php 
     include 'db_connector.php';
 
 

 
 
 // add or edit transaction 
function exp_add_update($data){
  if(check_token($data['crf_code'],'check')){
           $data = clean_security($data);
            
             if (!empty($data['id'])) {
                      // update 
                       mysqli_query_("UPDATE `expenses` set name='{$data['name']}',quantity='{$data['quantity']}',cost='{$data['cost']}',`date`='{$data['date']}',`description`='{$data['description']}' where id={$data['id']}"); 
        return 'ok';  

              }else{
                    mysqli_query_("INSERT INTO `expenses`(`name`, `quantity`, `cost`,`date`,`description`) VALUES('{$data['name']}','{$data['quantity']}','{$data['cost']}','{$data['date']}','{$data['description']}')");
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