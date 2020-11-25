
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
 
 
 // add or edit transaction 
function recieve_items($data){
  if(check_token($data['crf_code'],'check')){
           $data = clean_security($data);
                $data['quantity'] = str_replace(',','',$data['quantity']);
   $data['cost'] = $data['cost']*$data['quantity'];
               $data['date'] = date('Y-m-d');
               $item_id = register_item($data);

                     mysqli_query_("INSERT INTO `recieved_history`(`item_id`, `item_name`, `cost`, `quantity`, `description`,`date`) VALUES ('$item_id','{$data['item_name']}','{$data['cost']}','{$data['quantity']}','{$data['description']}','{$data['date']}')");
 
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


  echo   recieve_items($_POST['data']);
     // Export_Database($myServer,$myUser,$myPass,$myDB);

}
 


?>