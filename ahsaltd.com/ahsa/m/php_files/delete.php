<?php
  require 'clasess/dataBase_class.php';
  require 'clasess/customers_class.php';

 
 if(isset($_POST['data'])){
	 	 if_logged_in('die'); 
		
		$table = sanitize($_POST['data']['table']);
		$id = sanitize($_POST['data']['id']);


		if($table == 'customers'){
			// delete the customer and all transcations belongs to that customer
			mysqli_query_("update customers set delete_status='1' where customer_id=$id");
			mysqli_query_("update transactions set delete_status='1' where customer_id=$id");
		}else if($table == 'open_cash'){
 			mysqli_query_("update open_cash set delete_status='1' where id=$id");

		}else {
			// just delete the row 
			mysqli_query_("update transactions set delete_status='1' where id=$id");
			update_customer_balance(mysqli_result_(mysqli_query_("select customer_id from transactions where id='$id'"),0));
			
 
		}

echo 'ok';
			
} 
	
 
?>