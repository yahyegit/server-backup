
<?php 
     include 'db_connector.php';
 
 


 // add or edit transaction 
function users_add_update($data){
  global $current_user;

  if(check_token($data['crf_code'],'check')){
      $data['amount'] = str_replace(',','',$data['amount']);

           $data = clean_security($data);
            $password = (!empty($data['password']))?",password='".enc_password($data['password'])."'":'';

             $remain_limit = mysqli_result_(mysqli_query_("select current_remaining_limit from users where id=$current_user "),0);

             if (!empty($data['id'])) {
                  $prev_amount = mysqli_result_(mysqli_query_("select amount from payments where id={$data['id']} "),0);
                  // $remain_limit = $prev_amount +  $remain_limit;

             /*   if(preg_match('/-/',$remain_limit-$data['amount'])){
                  exit('invalid <b>amount</b><br> your remaining limit is: <b>$'.number_format($remain_limit).'<b> ');
                }*/

            
                   // update 
                    mysqli_query_("UPDATE `payments` set sender_id_no='{$data['sender_id_no']}', commission='{$data['commission']}', amount='{$data['amount']}' , sender_mobile='{$data['sender_mobile']}',   pay_to_name='{$data['pay_to_name']}' ,   pay_to_mobile='{$data['pay_to_mobile']}',   description='{$data['description']}'  where id={$data['id']}"); 

                      // update limit 

              /*     update_limit($current_user,$prev_amount,'+');
                   update_limit($current_user,$data['amount'],'-');

*/
 

                     return 'ok';  
                 
              }else{
             /*   if(preg_match('/-/',$remain_limit-$data['amount'])){
                  exit('invalid <b>amount</b><br> your remaining limit is: <b>$'.number_format($remain_limit).'<b> ');
                }*/


  
              
                   mysqli_query_(" INSERT INTO `payments`(`sent_date`,`sender_id_no`,`sender_name`, `amount`,`commission`, `sender_mobile`, `pay_to_name`, `pay_to_mobile`, `description`, `status`, `pay_to_id`, `user_id`, `paid_user_id`) VALUES ('{$data['date']}','{$data['sender_id_no']}','{$data['sender_name']}','{$data['amount']}','{$data['commission']}','{$data['sender_mobile']}','{$data['pay_to_name']}','{$data['pay_to_mobile']}','{$data['description']}','unpaid','','$current_user','')");

              } 

             // update limit 
          //     update_limit($current_user,$data['amount'],'-');

$last_id = mysqli_result_(mysqli_query_("select id from payments where delete_status!='1'  and user_id='$current_user' order by id desc limit 1 "),0);

shell_exec("
curl -X POST https://rest.messagebird.com/messages  -H 'Authorization: AccessKey qAgDtHF2lJOATjDiBBh1Ffr3i'   --data  'recipients={$data['pay_to_mobile']}' --data  'originator=Galayr Express'  --data 'body=Asc lacag ayaa laguusoo diray fadlan Galayr Express aad. Refrence No:#$last_id   ' 

");

 
            
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

