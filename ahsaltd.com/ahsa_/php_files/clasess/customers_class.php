<?php
 
 include 'db_connector.php';


 
function add_customer($customer_info){ // edit or add customer info 

	 if(check_token($customer_info['crf_code'],'check')){
		if(mysqli_result_(mysqli_query_("select count('customer_id') from customers where customer_id='".sanitize($customer_info['customer_id'])."'"), 0) != '1'){

  				$cust_id = mysqli_result_(mysqli_query_("select customer_id from customers where customer_name='".sanitize($customer_info['customer_name'])."' and mobile='".sanitize($customer_info['mobile'])."' LIMIT 1 "), 0);
				if($cust_id  && sanitize($customer_info['mobile']) !=''){  // if exist return id 
					return $cust_id;
				 }else{ // create then return id not dublicate 

						if(mysqli_result_(mysqli_query_("select count(customer_id) from customers where customer_name='".sanitize($customer_info['customer_name'])."' and customer_name!='' and mobile='' "), 0) != '0' && sanitize($customer_info['mobile']) ==''){
							die(" <strong> write fullname or add mobile because this ".sanitize($customer_info['customer_name'])." is already exist </strong>");
						}else{
						 	mysqli_query_("insert into customers (customer_id,customer_name,mobile,delete_status) values('','".sanitize($customer_info['customer_name'])."','".sanitize($customer_info['mobile'])."','0')");
							return mysqli_result_(mysqli_query_("SELECT customer_id FROM customers ORDER BY customer_id DESC LIMIT 1"),0);
						}
				  }

			}else{

				$cust_name = (sanitize($customer_info['customer_name']) != '')?"customer_name='".sanitize($customer_info['customer_name'])."', ":'';
				mysqli_query_("update customers set $cust_name mobile='".sanitize($customer_info['mobile'])."' where customer_id=".sanitize($customer_info['customer_id']));
				return sanitize($customer_info['customer_id']);
			}
		}else{
  			die('login');  
		}
}
 

 function get_customers_names(){ 
 //return '';
  
         $tags = array();
         $result_q = mysqli_query_("select mobile, customer_name,current_ksh_balance,current_dollar_balance
 from customers where delete_status !='1'  ");       
    while($aRow = mysqli_fetch_assoc_($result_q) ){ 
    	 
 			$tags[] = "{$aRow['customer_name']}' ".number_format($aRow['current_ksh_balance'],2)." ksh and $".number_format($aRow['current_dollar_balance'],2)." ' {$aRow['mobile']} "; // // name , 100ksh and $1000, | 07555555
                   
    }
    return json_encode($tags);
 }
 


// updates when transaction is modifed or delated or aded 
function update_customer_balance($customer_id){
		$customer_id = sanitize($customer_id);

		mysqli_query_("UPDATE customers set `total_cash_in`=(SELECT sum(cash_in) FROM transactions WHERE customer_id='$customer_id'), `total_cash_out`=(SELECT sum(cash_out) FROM transactions WHERE customer_id='$customer_id'),`current_ksh_balance`=(SELECT sum(cash_in) FROM transactions WHERE customer_id='$customer_id') - (SELECT sum(cash_out) FROM transactions WHERE customer_id='$customer_id'),

		`total_dollar_in`=(SELECT sum(dollar_in) FROM transactions WHERE customer_id='$customer_id'), `total_dollar_out`=(SELECT sum(dollar_out) FROM transactions WHERE customer_id='$customer_id'),`current_dollar_balance`=(SELECT sum(dollar_in) FROM transactions WHERE customer_id='$customer_id') - (SELECT sum(dollar_out) FROM transactions WHERE customer_id='$customer_id') where customer_id='$customer_id' ");

}





 	
if(isset($_POST['data']['edit_cust_info'])){
	  if_logged_in('die'); 
 	if(ctype_digit(add_customer($_POST['data']))){
 		check_token($_POST['data']['crf_code'],'');   // remove_crf
 		echo 'ok';
 	}  
			
} 



?>