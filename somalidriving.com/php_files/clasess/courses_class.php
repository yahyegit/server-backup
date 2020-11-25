
<?php 
     include 'db_connector.php';
 
 

 
 
 // add or edit transaction 
function courses($data){
   if(check_token($data['crf_code'],'check')){
           $data = clean_security($data);
            
             if (!empty($data['id'])) {
                      // update 
                       mysqli_query_("UPDATE `courses` set course='{$data['course']}', cost='{$data['cost']}', duration='{$data['duration']}' where id={$data['id']} "); 
                return 'ok';  

              }else{
                    mysqli_query_("INSERT INTO `courses`(`course`,`cost`, `duration`) VALUES('{$data['course']}','{$data['cost']}','{$data['duration']}')");
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


   echo  courses($_POST['data']);
     // Export_Database($myServer,$myUser,$myPass,$myDB);

}
 


?>
