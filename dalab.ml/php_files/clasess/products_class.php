
<?php
	require 'customers_class.php';
 // add or edit transaction 
function add_products($data){
 		$data = clean_security($data);
/*  $data['quantity'] = str_replace(',', '', $data['quantity']);
  $data['price'] = str_replace(',', '', $data['price']);
  $data['paid'] = str_replace(',', '', $data['paid']);*/
	if(check_token($data['crf_code'],'check') ){

 
				if($customer_id = add_customer($data)){
							$balance  = ($data['price'] * $data['quantity'])-$data['paid'];
								 // edit or add customer then return id 
			 				$data['date'] = (trim($data['date'])!='')?$data['date']:date('Y-m-d');
							if(mysqli_result_(mysqli_query_("select count(id) from products where id='".sanitize($data['product_id'])."'"),0) == '1'){ 
						
								// update the transaction row
								mysqli_query_( "UPDATE `products` SET `product_name`='{$data['product_name']}',`quantity`='{$data['quantity']}',`price`='{$data['price']}',`paid`='{$data['paid']}',`balance`='$balance',`date`='{$data['date']}',`description`='{$data['description']}', address='{$data['address']}' WHERE  id={$data['product_id']}");
			 
								
							}else{

								// add product 

								mysqli_query_("INSERT INTO `products`(`id`, `customer_id`,`product_name`, `quantity`, `price`, `paid`, `balance`, `date`, `description`, `delete_status`,`address`) values('','$customer_id','{$data['product_name']}','{$data['quantity']}','{$data['price']}','{$data['paid']}','$balance','{$data['date']}','{$data['description']}','0','{$data['address']}')
									");

							}
 
   check_token('','');
			
				return 'ok';	
				}	 
	}else{
		return 'login';
	}
}








// submited 
 
if(isset($_POST['data'])){
    if_logged_in('die');

	echo add_products($_POST['data']);


}

?>
