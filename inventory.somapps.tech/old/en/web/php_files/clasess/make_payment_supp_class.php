
<?php 
     include 'db_connector.php';
 
 
 
 // add or edit transaction 
function pay_now($data){
           $data = clean_security($data);

global $current_user;


$c_bl = mysqli_result_(mysqli_query_("select current_balance from suppliers where id='{$data['id']}'"),0);
        


                $data['amount'] = (ctype_digit($data['amount']))?$data['amount']:0;
             
             if (empty($data['amount'])){
                return 'ok';
                exit();
             }
           if ($c_bl < ($data['amount'])){
                return 'invalid paid  ';
                exit();
             }

  if(check_token($data['crf_code'],'check')){
               $data['balance'] = str_replace(',','',$data['balance']);
               $data['amount'] = str_replace(',','',$data['amount']);
                 $data['date'] = date('Y-m-d');

                     mysqli_query_("INSERT INTO `s_payments`(`s_id`, `paid`, `date`, `description`)   VALUES ('{$data['id']}','{$data['amount']}','{$data['date']}','{$data['description']}')");
 
         mysqli_query_("update suppliers set current_balance='".sanitize($data['balance'])."'  where id={$data['id']}");  


       //  fix_bl($data['id'],$data['discount']+$data['amount']);
      


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
    if (!is_admin($current_user)) {
        if_logged_in('die');
   }

  echo   pay_now($_POST['data']);
     // Export_Database($myServer,$myUser,$myPass,$myDB);

}
 


?>
