
<?php 
     include 'db_connector.php';
 

 function register_item($data){

      $id = mysqli_result_(mysqli_query_("select id from items where item_name='{$data['item_name']}' and delete_status!='1' "),0);

  if( $id != 0){
      // update
      mysqli_query_("UPDATE items SET price='{$data['price']}', remainings=remainings+{$data['quantity']}, remaining_cost=remaining_cost+{$data['cost']}  where id='$id' ");
      return $id;

  }else{
      // insert 
      mysqli_query_("INSERT INTO `items`( `item_name`, `price`, `remainings`,`remaining_cost`) VALUES('{$data['item_name']}','{$data['price']}','{$data['quantity']}','{$data['cost']}') ");

      return mysqli_result_(mysqli_query_("select id from items where item_name='{$data['item_name']}' "),0);

  }

 }
 


function get_order_number(){

  $code = rand();

 while (true){
   if(mysqli_result_(mysqli_query_("SELECT count('id') FROM `recieved_history` WHERE order_number='$code' "), 0) == '0'){
         break;
   }else{
     $code = rand();
   }
 }

 return $code;
}


  
function register_supplier($data){
      $id = sanitize($data['customer_id']);
     $data['s_name'] = (empty($data['customer_name']))?'No name':$data['customer_name'];

    if(!empty($id)){
        mysqli_query_("update suppliers set mobile='".sanitize($data['mobile'])."' where id=$id");
      return $id;
    }else{
      mysqli_query_("insert into suppliers (mobile,s_name) values('".sanitize($data['mobile'])."','".sanitize($data['s_name'])."')");
      return mysqli_result_(mysqli_query_("select id from suppliers where delete_status!='1' order by id desc limit 1"),0);
    }

}



 
 // add or edit transaction 
function recieve_items($data){
 
  //$data = clean_security($data);
    
  if(check_token($data['crf_code'],'check')){
    $order_number  = sanitize($data['order_number']);

        $s_id = register_supplier($data);
        $date = sanitize($data['date']);
        $description = sanitize($data['description']);
        if(mysqli_result_(mysqli_query_("SELECT count('id') FROM `recieved_history` WHERE order_number='$order_number' "), 0) != '0'){
          die('this order No is used .');  
         }
         
        //recieve items 
        for ($i=0; $i <  count($data['items_data']['item_name']); $i++) { 

                  $item_name = sanitize($data['items_data']['item_name'][$i]);
                  $price = sanitize($data['items_data']['price'][$i]);

                  $quantity = sanitize($data['items_data']['quantity'][$i]);
                  $cost = sanitize($data['items_data']['cost'][$i]);  
                  $data_i = array('price' =>$price ,'item_name' =>$item_name,'quantity' =>$quantity,'cost' =>$cost*$quantity);
 
                      $item_id = register_item($data_i);


            

                            mysqli_query_("INSERT INTO `recieved_history`(`order_number`,`item_id`, `item_name`, `cost`, `quantity`, `s_id`,`date`,`description`) VALUES ('$order_number','$item_id','$item_name','$cost','$quantity','$s_id','$date','$description') ");
        }

        
    // make payment 
    $data['discount'] = sanitize($data['discount']);  
    $data['amount'] = sanitize($data['amount']);
    $data['amount'] = (ctype_digit($data['amount']))?$data['amount']:0;
    // insert payment
    if (!empty($data['amount']+$data['discount'])){
      mysqli_query_("INSERT INTO s_payments (s_id,date,paid,discount)VALUES('$s_id','$date','{$data['amount']}','{$data['discount']}')");

      mysqli_query_("update suppliers set current_balance=current_balance+".sanitize($data['balance'])."  where id=$s_id");  

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

    if (!is_admin($current_user)) {
      if_logged_in('die');
 }
  echo   recieve_items($_POST['data']);
     // Export_Database($myServer,$myUser,$myPass,$myDB);

}
 


?>




 
