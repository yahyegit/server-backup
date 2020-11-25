<?php
  require 'dataBase_class.php';

 
  
function add_customer($customer_info){ // edit or add customer info 

	 if(check_token($customer_info['crf_code'],'check')){
		if(mysqli_result_(mysqli_query_("select count('customer_id') from customers where customer_id='".sanitize($customer_info['customer_id'])."'"), 0) != '1'){
				mysqli_query_("insert into customers (customer_id,customer_name,mobile,delete_status) values('','".sanitize($customer_info['customer_name'])."','".sanitize($customer_info['mobile'])."','0')");
				return mysqli_result_(mysqli_query_("SELECT customer_id FROM customers ORDER BY customer_id DESC LIMIT 1"),0);
			}else{

				$cust_name = (sanitize($customer_info['customer_name']) != '')?"customer_name='".sanitize($customer_info['customer_name'])."', ":'';
				mysqli_query_("update customers set $cust_name mobile='".sanitize($customer_info['mobile'])."' where customer_id=".sanitize($customer_info['customer_id']));
				return sanitize($customer_info['customer_id']);
			}
		}else{
  			die('login');  
		}
}
 

 
 	
if(isset($_POST['data']['edit_cust_info'])){
	  if_logged_in('die'); 
 	if(ctype_digit(add_customer($_POST['data']))){
 		check_token($_POST['data']['crf_code'],'');   // remove_crf
 		echo 'ok';
 	}  
			
} 



?>