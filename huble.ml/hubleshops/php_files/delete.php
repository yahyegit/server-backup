<?php
  require 'clasess/dataBase_class.php';

 
  $posted_data = $_POST['data'];

 if(isset($posted_data)){
	 	 if_logged_in('die'); 
		
		$table = sanitize($posted_data['table']);
		$id = sanitize($posted_data['id']);


		if($table == 'customers'){
			// delete the customer and all transcations belongs to that customer
			mysqli_query_("update customers set delete_status='1' where customer_id=$id");
			mysqli_query_("update transactions set delete_status='1' where customer_id=$id");
		}else {
			// just delete the row 
			mysqli_query_("update transactions set delete_status='1' where id=$id");
		}
		echo 'ok';
			
} 
	
 
?>