
<?php 
     include 'db_connector.php';
         require 'auto_create.php';

 

 
 
 // add or edit transaction 
function pay_now($data){
  if(check_token($data['crf_code'],'check')){
           $data = clean_security($data);
               $data['balance'] = str_replace(',','',$data['balance']);
                    $data['paid'] = str_replace(',','',$data['paid']);

             if (!empty($data['paid'])) {
                    mysqli_query_("INSERT INTO payments (`paid`,`time`,`description`,`balance`,`student_id`)VALUES('{$data['paid']}','{$data['date']}','{$data['description']}','{$data['balance']}','{$data['id']}')");

                      mysqli_query_("update students set balance='{$data['balance']}' where id='{$data['id']}'");
              } 
             if (!empty($data['due_date'])) {
                    mysqli_query_("update students set due_date='{$data['due_date']}' where id='{$data['id']}'");
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
