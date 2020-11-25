<?php
  require '../includes/inc_func.php';
   if(if_logged_in() != true){
      die();
   }
 
  
 if(isset($_POST)){
	  $data =  array('date'=>$_POST['date'],'suplier_id'=>$_POST['account_id'],'amount'=>$_POST['amount_paid'],'description'=>$_POST['payment_description']);
	  echo make_payment($data);
  }


?>