
<?php 
     include 'db_connector.php';
 
 
function fix_bl($id,$amount){

// first fix expired remainders 

 
      $q = mysqli_query_("select id,balance,order_number from invoices where customer_id='$id' and balance!='0' and delete_status!='1'  ");
      while($qq = mysqli_fetch_assoc_($q)){
      if ( $amount == '0') {
            break;
      }else{                                                 
             if($qq['balance'] > $amount){
                $qq['balance'] = $qq['balance']-$amount;
                $amount = 0;
 
            }else{
                $amount = $amount-$qq['balance'];

                $qq['balance'] = 0;
             }


           mysqli_query_("update invoices set balance='{$qq['balance']}'  where id='{$qq['id']}'");

            if (mysqli_result_( mysqli_query_("select sum(balance) from invoices where customer_id='$id' and balance!='0' and status!='paid' and order_number='{$qq['order_number']}' and delete_status!='1'  "),0)) {
                mysqli_query_("update invoices set status='paid' where order_number='{$qq['order_number']}' ");
            } // order status 


          

      }

       
      }


       


}
 

 
 
 // add or edit transaction 
function pay_now($data){
           $data = clean_security($data);

global $current_user;


$c_bl = mysqli_result_(mysqli_query_("select current_balance from customers where id='{$data['id']}'"),0);
        


               $data['discount'] = (ctype_digit($data['discount']))?$data['discount']:0;
               $data['amount'] = (ctype_digit($data['amount']))?$data['amount']:0;
             
             if (empty($data['amount']+$data['discount'])){
                return 'ok';
                exit();
             }
           if ($c_bl < ($data['amount']+$data['discount'])){
                return 'invalid paid or discount ';
                exit();
             }

  if(check_token($data['crf_code'],'check')){
               $data['balance'] = str_replace(',','',$data['balance']);
               $data['amount'] = str_replace(',','',$data['amount']);
               $data['discount'] = str_replace(',','',$data['discount']);   
                $data['date'] = date('Y-m-d');

                     mysqli_query_("INSERT INTO `payments`(`customer_id`, `paid`, `discount`, `date`, `description`,user_id)   VALUES ('{$data['id']}','{$data['amount']}','{$data['discount']}','{$data['date']}','{$data['description']}','$current_user')");
 
         mysqli_query_("update customers set current_balance='".sanitize($data['balance'])."',last_date='{$data['date']}'  where id={$data['id']}");  


         fix_bl($data['id'],$data['discount']+$data['amount']);
      


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
