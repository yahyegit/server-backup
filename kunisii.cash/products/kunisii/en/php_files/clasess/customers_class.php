<?php
 
 include 'db_connector.php';


 
function add_customer($customer_info){ // edit or add customer info 

	 if(check_token($customer_info['crf_code'],'check')){
		if(mysqli_result_(mysqli_query_("select count('customer_id') from customers where customer_id='".sanitize($customer_info['customer_id'])."'"), 0) != '1'){

  				$cust_id = mysqli_result_(mysqli_query_("select customer_id from customers where customer_name='".sanitize($customer_info['customer_name'])."' and mobile='".sanitize($customer_info['mobile'])."' "), 0);
				if($cust_id  && sanitize($customer_info['mobile']) !=''){
					return $cust_id;
				 }else{

						if(mysqli_result_(mysqli_query_("select count(customer_id) from customers where customer_name='".sanitize($customer_info['customer_name'])."' customer_name!='' and mobile='' "), 0) != '0' && sanitize($customer_info['mobile']) ==''){
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
 

 function get_customers_select($customer_id){ 
 //return '';
  
         $options = "<option customer_id='' cash_rate='0' current_dollar_balance='0' current_cash_balance='0'>choose..</option><option customer_id='' cash_rate='0' current_dollar_balance='0' current_cash_balance='0'>Add</option>";
         $result_q = mysqli_query_("select customer_id, mobile, customer_name,current_ksh_balace,current_dollar_balace
 from customers where delete_status !='1'  ");       
    while($aRow = mysqli_fetch_assoc_($result_q) ){ 
    	 
 			$selected_c = (trim($customer_id) == $aRow['customer_id'])?'selected="selected"':'';
             $options .= "<option customer_id='{$aRow['customer_id']}' current_cash_balance='{$aRow['current_ksh_balace']}'  current_dollar_balance='{$aRow['current_dollar_balace']}' $selected_c > {$aRow['customer_name']} ".'('." {$aRow['mobile']} ".')'." | ".number_format($aRow['current_ksh_balace'],2)." ksh  and $".number_format($aRow['current_dollar_balace'],2)." </option>";      
    }
    return $options;
 }
 


// updates when transaction is modifed or delated or aded 
function update_customer_balance($customer_id){
 

		       $out =  mysqli_fetch_assoc_(mysqli_query_("select sum(amount_ksh) as ksh_out,sum(amount_dollar) as dollar_out from transactions where customer_id='".sanitize($customer_id)."' and type='out' and delete_status!='1'"));

		       $in =  mysqli_fetch_assoc_(mysqli_query_("select sum(amount_ksh) as ksh_in,sum(amount_dollar) as dollar_in from transactions where customer_id='".sanitize($customer_id)."' and type='in' and delete_status!='1'"));

		       $balance_ksh = $in['ksh_in'] - $out['ksh_out'];
                $balance_doll = $in['dollar_in'] - $out['dollar_out'];

 						mysqli_query_("update customers set current_ksh_balace='$balance_ksh', current_dollar_balace='$balance_doll' where customer_id='".sanitize($customer_id)."'");
}





 	
if(isset($_POST['data']['edit_cust_info'])){
	  if_logged_in('die'); 
 	if(ctype_digit(add_customer($_POST['data']))){
 		check_token($_POST['data']['crf_code'],'');   // remove_crf
 		echo 'ok';
 	}  
			
} 



?>