
<?php 
     include 'db_connector.php';

	require 'customers_class.php';
 // add or edit transaction 
function make_transaction($data){
	if(check_token($data['crf_code'],'check')){
   		    $data = clean_security($data);
 			$customer_id = add_customer($data);

   			$current_balance =  mysqli_fetch_assoc_(mysqli_query_("select current_ksh_balance,current_dollar_balance from customers where customer_id='".sanitize($customer_id)."'  and delete_status!='1'"));
                $current_balance['current_ksh_balance'] += ($data['cash_in'] - $data['cash_out']);
 				$current_balance['current_dollar_balance'] += ($data['dollar_in'] - $data['dollar_out']);

				if(is_numeric($data['id'])){
					 
					// update the transaction row
					mysqli_query_("UPDATE `transactions` SET `customer_id`='$customer_id',`cash_in`='{$data['cash_in']}',`cash_out`='{$data['cash_out']}',`cash_balance`='{$current_balance['current_ksh_balance']}',`dollar_in`='{$data['dollar_in']}',`dollar_out`='{$data['dollar_out']}',`dollar_balance`='{$current_balance['current_dollar_balance']}',`date`='{$data['date']}',`description`='{$data['description']}' WHERE id='{$data['id']}'");
 
					
				}else{


					   // create new transaction 
					  mysqli_query_("INSERT INTO `transactions`(`id`, `customer_id`, `cash_in`, `cash_out`, `cash_balance`, `dollar_in`, `dollar_out`, `dollar_balance`, `date`, `description`, `delete_status`) VALUES ('','$customer_id','{$data['cash_in']}','{$data['cash_out']}','{$current_balance['current_ksh_balance']}','{$data['dollar_in']}','{$data['dollar_out']}','{$current_balance['current_dollar_balance']}','{$data['date']}','{$data['description']}','0')");
			
				}

 

  		        update_customer_balance($customer_id);
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

	echo make_transaction($_POST['data']);


}

?>
