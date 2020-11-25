<?php
 
 include 'db_connector.php';

function add_customer($customer_info){ // edit or add customer info 
	 if(check_token($customer_info['crf_code'],'check')){
 
		if(mysqli_result_(mysqli_query_("select count('customer_id') from customers where customer_id='".sanitize($customer_info['customer_id'])."'"), 0) == '1'){

 
   				 		// update then return id 
				mysqli_query_("update customers set customer_name='".sanitize($customer_info['customer_name'])."', mobile='".sanitize($customer_info['mobile'])."' where customer_id=".sanitize($customer_info['customer_id']));
				return sanitize($customer_info['customer_id']);

			}else{
					//  create then return id
 						mysqli_query_("insert into customers (customer_id,customer_name,mobile,delete_status) values('','".sanitize($customer_info['customer_name'])."','".sanitize($customer_info['mobile'])."','0')");
						return mysqli_result_(mysqli_query_("SELECT customer_id FROM customers ORDER BY customer_id DESC LIMIT 1"),0);
			}
		}else{
  			die('login');  
		}
}
 

 function get_customers_names($current_cust){ 
 //return '';
  
         $options = array();
         $result_q = mysqli_query_("select customer_id,mobile, customer_name,current_ksh_balance,current_dollar_balance
 from customers where delete_status !='1'  ");       
    while($aRow = mysqli_fetch_assoc_($result_q) ){ 
    	 


 			$options[] = "<option mobile='{$aRow['mobile']}'  customer_name='{$aRow['customer_name']}'  ".((trim($current_cust) == $aRow['customer_id'])?"selected='selected'":'')." cash_balance='{$aRow['current_ksh_balance']}'   dollar_balance='{$aRow['current_dollar_balance']}' customer_id='{$aRow['customer_id']}' > {$aRow['customer_name']} ".((!empty($aRow['mobile'])?"({$aRow['mobile']})":"")).",  Balance: ksh".number_format($aRow['current_ksh_balance'],2)."  |  $".number_format($aRow['current_dollar_balance'],2)." </option>"; 
                   
    }

 
    return    "<select class='customers_select' ".((count($options) < 4)?"remove_filter='true'":"")." onchange='customer_info($(this).find(\"option:selected\"))' ><option>choose..</option><option>Add </option>".implode('', $options)."</select>";
 }
 


// updates when transaction is modifed or delated or aded 
function update_customer_balance($customer_id){
		$customer_id = sanitize($customer_id);
		$not_deleted = "delete_status!='1'";

	mysqli_query_("UPDATE customers set `total_cash_in`=(SELECT sum(cash_in) FROM transactions WHERE customer_id='$customer_id' and $not_deleted ), `total_cash_out`=(SELECT sum(cash_out) FROM transactions WHERE customer_id='$customer_id' and $not_deleted ),`current_ksh_balance`=(SELECT sum(cash_in) FROM transactions WHERE customer_id='$customer_id' and $not_deleted ) - (SELECT sum(cash_out) FROM transactions WHERE customer_id='$customer_id' and $not_deleted ),

		`total_dollar_in`=(SELECT sum(dollar_in) FROM transactions WHERE customer_id='$customer_id' and $not_deleted ), `total_dollar_out`=(SELECT sum(dollar_out) FROM transactions WHERE customer_id='$customer_id' and $not_deleted ),`current_dollar_balance`=(SELECT sum(dollar_in) FROM transactions WHERE customer_id='$customer_id' and $not_deleted ) - (SELECT sum(dollar_out) FROM transactions WHERE customer_id='$customer_id' and $not_deleted ) where customer_id='$customer_id' and $not_deleted  ");

}





 	
if(isset($_POST['data']['edit_cust_info'])){
	  if_logged_in('die'); 
 	if(ctype_digit(add_customer($_POST['data']))){
 		check_token($_POST['data']['crf_code'],'');   // remove_crf
 		echo 'ok';
 	}  
			
} 



?>