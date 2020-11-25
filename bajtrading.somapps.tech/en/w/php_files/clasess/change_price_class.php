
<?php 
     include 'db_connector.php';
 
 

 
 
 // add or edit transaction 
function update_item($data){
  if(check_token($data['crf_code'],'check')){
           $data = clean_security($data);
            
             if (!empty($data['id'])) {
                      // update 
                  $old_item = mysqli_result_(mysqli_query_("select item_name from items where id={$data['id']}"),0);

                      mysqli_query_("UPDATE `items` set price='{$data['price']}', item_name='{$data['item_name']}' where id={$data['id']}"); 
                      mysqli_query_("update customer_items set item_name='{$data['item_name']}' where item_name='$old_item'");
                      mysqli_query_("update recieved_history set item_name='{$data['item_name']}' where item_name='$old_item'");
               
                return 'ok';  

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


   echo  update_item($_POST['data']);
     // Export_Database($myServer,$myUser,$myPass,$myDB);

}
 


?>
