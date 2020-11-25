
<?php 
     include 'db_connector.php';
 
 

 
 
 // add or edit transaction 
function exp_add_update($data){
  if(check_token($data['crf_code'],'check')){
           $data = clean_security($data);
            
             if (!empty($data['id'])) {
                      // update 


              foreach($data as $key => $value) {
                    if($key =='crf_code'  ){}else if( $key =='id'){}else{

                            mysqli_query_("update courses set ".sanitize($key)." ='".sanitize($value)."' where id='{$data['id']}'"); 
                      }
            }

 
 
              }else{
                    mysqli_query_("INSERT INTO `courses`(`course`, `cost`, `duration`) VALUES ('{$data['course']}','{$data['cost']}','{$data['duration']}')");
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
