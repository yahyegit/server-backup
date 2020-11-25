
<?php
	require 'customers_class.php';
 // add or edit transaction 
function make_transaction($data){
	// check_crf // crf validatation is the last one before query()
 
 
	if(check_token($data['crf_code'],'check') ){

 
				if($customer_id = add_customer($data)){
					 // edit or add customer then return id 
 
  				$data['trans_type'] = strtolower($data['trans_type']);
				$data['date'] = (trim($data['date'])!='')?$data['date']:date('Y-m-d');
				if(mysqli_result_(mysqli_query_("select count(id) from transactions where id='".sanitize($data['transaction_id'])."'"),0) == '1'){ 
				/* 
					// update the transaction row
					mysqli_query_("UPDATE `transactions` SET  `amount_ksh`='".sanitize($data['amount_money_ksh'])."', `amount_dollar`='".sanitize($data['amount_money_dollar'])."', customer_id='".sanitize($customer_id)."',`type_msg`='".validate_msg_type($data['msg_type'])."', `type`='".sanitize($data['trans_type'])."', `cash_rate`='".sanitize($data['rate_ksh'])."', `dollar_rate`='".sanitize($data['rate_dollar'])."',`date`='".sanitize($data['date'])."', `description`='".sanitize($data['description'])."' WHERE id=".sanitize($data['transaction_id']));
*/
					
				}else{

					// create new transaction 
					mysqli_query_("INSERT INTO `transactions` (id,`r_amount_ksh`,`r_amount_dollar`,`amount_ksh`,`amount_dollar`,`customer_id`,`type_msg`, `type`,`cash_rate`, `dollar_rate`,`date`,`description`) values('','".sanitize($data['r_amount_ksh'])."','".sanitize($data['r_amount_dollar'])."','".sanitize($data['amount_money_ksh'])."','".sanitize($data['amount_money_dollar'])."','".sanitize($customer_id)."','".validate_msg_type($data['msg_type'])."','".sanitize($data['trans_type'])."','".sanitize($data['rate_ksh'])."','".sanitize($data['rate_dollar'])."','".sanitize($data['date'])."','".sanitize($data['description'])."')");


				}


				//  current rate
				if(mysqli_result_(mysqli_query_("select count(id) from current_rate where  date='".date('Y-m-d')."' and delete_status!='1'    "), 0) == '0'){	// isert currency
				
							mysqli_query_("INSERT INTO `current_rate`( `dollar_rate`, `cash_rate`, `date`, `delete_status`) VALUES ('".sanitize($data['rate_dollar'])."','".sanitize($data['rate_ksh'])."','".date('Y-m-d')."','0')");
				 }else{ // update
					mysqli_query_("UPDATE `current_rate` set `dollar_rate`='".sanitize($data['rate_dollar'])."',`cash_rate`='".sanitize($data['rate_ksh'])."'  where   date='".date('Y-m-d')."' and delete_status!='1'   " );
				}
 
				// remove_crf
				  check_token($data['crf_code'],''); 
				return 'ok';	
				}	 
	}else{
		return 'login';
	}
}








// submited 
 
if(isset($_POST['data'])){
    if_logged_in('die');

	echo make_transaction($_POST['data']);


}

?>
