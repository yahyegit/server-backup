
<?php 
     include 'db_connector.php';
 



 
function fix_bl($id,$amount,$order_number){

// first fix expired remainders 

 
      $q = mysqli_query_("select id,balance,order_number from invoices where customer_id='$id' and balance!='0' and order_number='$order_number' and delete_status!='1'  ");
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

            if (!mysqli_result_( mysqli_query_("select sum(balance) from invoices where customer_id='$id' and balance!='0' and status!='paid' and order_number='{$qq['order_number']}' and delete_status!='1'  "),0)) {
             
                mysqli_query_("update invoices set status='paid' where order_number='{$qq['order_number']}' ");
            } // order status 


           

      }

       
      }


       


}
 



function get_order_number(){

   $code = rand();

//  while (true){
    if(mysqli_result_(mysqli_query_("SELECT count('id') FROM `invoices` WHERE order_number='$code' "), 0) == '0'){
         break;
  }else{
   //   $code = rand();
   }
  //}

  //return $code;
}

 
function register_cust($data){
        $id = sanitize($data['customer_id']);
    $id = mysqli_result_(mysqli_query_("select id from customers where id='$id'"),0);
 $data['customer_name'] = (empty($data['customer_name']))?'No name':$data['customer_name'];
 
    if(!empty($id)){
          mysqli_query_("update customers set current_balance=current_balance+".sanitize($data['balance']).", email='".sanitize($data['email'])."', last_date='".date('Y-m-d')."', mobile='".sanitize($data['mobile'])."' where id=$id");
         return $id;
    }else{
        mysqli_query_("insert into customers (current_balance,mobile,customer_name,last_date,email) values('".sanitize($data['balance'])."','".sanitize($data['mobile'])."','".sanitize($data['customer_name'])."','".date('Y-m-d')."','".sanitize($data['email'])."')");
        return mysqli_result_(mysqli_query_("select id from customers where delete_status!='1' order by id desc limit 1"),0);
    }

}
 
 
 // add or edit transaction 
function sell_items($data){
    global $current_user;


	if(check_token($data['crf_code'],'check')){
   		   // $data = clean_security($data);
   		    $delevered_by =   sanitize($data['delevered_by']);
          $date =   sanitize($data['date']);

           $customer_id = register_cust($data);
               $order_number  = sanitize($data['order_number']);


               if(mysqli_result_(mysqli_query_("SELECT count('id') FROM `invoices` WHERE order_number='$order_number' "), 0) != '0'){
                die('this Invoice No is used .');  
               }
       
           // instert items 
     			for ($i=0; $i <  count($data['items_data']['item_name']); $i++) { 
              $item_name =  sanitize($data['items_data']['item_name'][$i]);
              $price =   sanitize($data['items_data']['price'][$i]);
              $quantity =   sanitize($data['items_data']['quantity'][$i]);
                
              $rem = mysqli_result_(mysqli_query_("select remainings from items where item_name='$item_name' and delete_status!=1 "),0);
            $remaining_cost =   mysqli_result_(mysqli_query_("select remaining_cost from items where item_name='$item_name' and delete_status!=1 "),0);

            $single_cost = ($remaining_cost/$rem);


              $t_cost = $quantity*$single_cost;
              $t_price =  $price;
              $profit = $t_price-$t_cost;
               // update remainings  


 


              if ($rem < $quantity) {
                  exit("invalid quantity for <b> $item_name </b> only ".number_format($rem). " is remaining.");
              }
                $rem = $rem-$quantity;
                
               mysqli_query_("UPDATE items SET  remainings=$rem, remaining_cost=remaining_cost-$t_cost   where item_name='$item_name' and delete_status!=1 ");


              mysqli_query_("insert into invoices (item_name,quantity,price,date,user_id,delevered_by,customer_id,profit,order_number,address,balance) values('$item_name','$quantity','$price','$date','$current_user','$delevered_by','$customer_id','$profit','$order_number','{$data['address']}','$price') ");

               }
 
              $data['discount'] = (ctype_digit($data['discount']))?$data['discount']:0;
              $data['amount'] = (ctype_digit($data['amount']))?$data['amount']:0;
              // insert payment
             if (!empty($data['amount']+$data['discount'])){
                    mysqli_query_("INSERT INTO payments (customer_id,user_id,date,paid,discount,order_number)VALUES('$customer_id','$current_user','$date','{$data['amount']}','{$data['discount']}','$order_number')");
                     $am = $data['amount']+$data['discount'];
                fix_bl($customer_id,$am,$order_number);
              } 
               




            if ($data['receipt_type'] == 'send' || $data['receipt_type'] == 'both'){

                 send_reciept($invoice_as_html,$data['email']);
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
$lisence_code = '34l3jk634$%^$%g3{u2#N[jwR~Q3#Hffsdfpisj';
$hostname = $_SERVER['SERVER_NAME'];

if(isset($_SESSION['lisence_ip'])){
    $lisenced_ip = $_SESSION['lisence_ip'];
}else{
    $lisenced_ip = dns_get_record($hostname)[4]['ip'];
    $_SESSION['lisence_ip'] = $lisenced_ip;
}

    if_logged_in('die');
    // echo 'posted';print_r($_POST['data']);


	  echo sell_items($_POST['data']);
     // Export_Database($myServer,$myUser,$myPass,$myDB);

}
 


?>

