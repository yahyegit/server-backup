<?php
  require 'dataBase_class.php';


  
function add_customer($customer_info){ // edit or add customer info 

	 if(check_token($customer_info['crf_code'],'check')){
	 	$cust_iden = mysqli_result_(mysqli_query_("select count('customer_id') from customers where mobile='".sanitize($customer_info['mobile'])."'"), 0);
		if($cust_iden != '1'){

  				$cust_id = mysqli_result_(mysqli_query_("select customer_id from customers where customer_name='".sanitize($customer_info['customer_name'])."' and mobile='".sanitize($customer_info['mobile'])."' "), 0);
				if($cust_id  && sanitize($customer_info['mobile']) !=''){
					return $cust_id;
				 }else{

						if(mysqli_result_(mysqli_query_("select count(customer_id) from customers where customer_name='".sanitize($customer_info['customer_name'])."' and mobile='' "), 0) != '0' && sanitize($customer_info['mobile']) ==''){
							die(" <strong> write fullname or add mobile because this ".sanitize($customer_info['customer_name'])." is already exist </strong>");
						}else{
						 	mysqli_query_("insert into customers (customer_id,customer_name,mobile,delete_status,address) values('','".sanitize($customer_info['customer_name'])."','".sanitize($customer_info['mobile'])."','0','".sanitize($customer_info['address'])."')");
							return mysqli_result_(mysqli_query_("SELECT customer_id FROM customers ORDER BY customer_id DESC LIMIT 1"),0);
						}
				  }

			}else{

				$cust_name = (sanitize($customer_info['customer_name']) != '')?"customer_name='".sanitize($customer_info['customer_name'])."', ":'';
				mysqli_query_("update customers set $cust_name mobile='".sanitize($customer_info['mobile'])."', address='".sanitize($customer_info['address'])."' where mobile=".sanitize($customer_info['mobile']));
				return $cust_iden;
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