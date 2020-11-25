<?php
 
 die('no use '); 
  /* 
    include 'db_connector.php';
	require 'customers_class.php';

 
 $result = mysqli_query_("select * from history  ");
  while($aRow = mysqli_fetch_assoc_($result))
            {
            	$open_day_date = $aRow['date'];
            	$aRow['date'] = explode('@', $aRow['date']); 
            	$aRow['date'] = date('Y-m-d',strtotime(str_replace('/', '-', trim($aRow['date'][0])))); 
	 			$aRow['blance'] = $aRow['cash_in'] - $aRow['cash_out']; 
	 			$aRow['doller_blance'] = $aRow['doller_in'] - $aRow['doller_out'];
	 			$amout_ksh_db =  str_replace('-','',$aRow['blance']);
	 			$amout_dollar_db =  str_replace('-','',$aRow['doller_blance']);
  			






// open cash 
if(mysqli_result_(mysqli_query_(" select count(id) from open_cash where date='{$aRow['date']}'  "),0) == 0){
  $open_data = mysqli_fetch_assoc_(mysqli_query_(" select blance,dolla_blance from oppen_day where date='$open_day_date' "));


  mysqli_query_("INSERT INTO `open_cash`(`id`, `amount_ksh`, `amount_dollar`, `delete_status`, `date`) VALUES ('','{$open_data['blance']}','{$open_data['dolla_blance']}','0','{$aRow['date']}')");
}






 
 




 			if(mysqli_result_(mysqli_query_("select count(customer_id) from customers where customer_id='{$aRow['id_card']}'
			   "),0) == 0){
				// add 
					$cust_info = mysqli_fetch_assoc_(mysqli_query_("SELECT `id`, `full_name`, `number` FROM `main_details` WHERE `id`='{$aRow['id_card']}' "));

					mysqli_query_("insert into customers (customer_id,customer_name,mobile,delete_status) values('{$aRow['id_card']}','{$cust_info['full_name']}','{$cust_info['number']}','0')");
			     }


            








 			if(!preg_match('/-/', $aRow['doller_blance']) && trim($aRow['doller_blance']) !='0' && !preg_match('/-/', $aRow['blance']) && trim($aRow['blance']) !='0'){
 			    //  1 in trans		 
 
 					$transType = 'in';
                    $cust_balance = get_customer_balance($aRow['id_card']);
                        $cust_balance['ksh'] = ($transType == 'out')?$cust_balance['ksh'] - $amout_ksh_db:$cust_balance['ksh'] + $amout_ksh_db; 
                     $cust_balance['dollar'] = ($transType == 'out')?$cust_balance['ksh'] - $amout_dollar_db:$cust_balance['ksh'] + $amout_dollar_db; 

 					$msg_type = "  <b> <b class=\"title_\">$transType:</b>  ".number_format($amout_ksh_db,2)." ksh <span class=\"span_\">and</span> $".number_format($amout_dollar_db,2)." </b><p style=\"float: right;color: black;\"><span class=\"span_\"> Balance : </span><span class=\"span_\" style=\"font-weight:normal\"> ".number_format($cust_balance['ksh'],2)." ksh </span> <span class='span_'> and </span> <span class=\"span_\" style=\"font-weight:normal\">$".number_format($cust_balance['dollar'],2)."</span> </p> ";    // ksh  balance 


 						mysqli_query_("INSERT INTO `transactions`(`id`, `customer_id`, `amount_ksh`, `amount_dollar`, `r_amount_ksh`, `r_amount_dollar`, `type_msg`, `type`, `cash_rate`, `dollar_rate`, `date`, `description`, `delete_status`) VALUES ('','{$aRow['id_card']}','$amout_ksh_db','$amout_dollar_db','$amout_ksh_db','$amout_dollar_db','".validate_msg_type($msg_type)."','$transType','0','0','{$aRow['date']}','{$aRow['description']}','0')");
 
 

 			}else if(preg_match('/-/', $aRow['doller_blance']) && preg_match('/-/', $aRow['blance'])){
 				// 1 out trans
 
 					$transType = 'out';
                    $cust_balance = get_customer_balance($aRow['id_card']);
                        $cust_balance['ksh'] = ($transType == 'out')?$cust_balance['ksh'] - $amout_ksh_db:$cust_balance['ksh'] + $amout_ksh_db; 
                     $cust_balance['dollar'] = ($transType == 'out')?$cust_balance['ksh'] - $amout_dollar_db:$cust_balance['ksh'] + $amout_dollar_db; 

 					$msg_type = "  <b> <b class=\"title_\">$transType:</b>  ".number_format($amout_ksh_db,2)." ksh <span class=\"span_\">and</span> $".number_format($amout_dollar_db,2)." </b><p style=\"float: right;color: black;\"><span class=\"span_\"> Balance : </span><span class=\"span_\" style=\"font-weight:normal\"> ".number_format($cust_balance['ksh'],2)." ksh </span> <span class='span_'> and </span> <span class=\"span_\" style=\"font-weight:normal\">$".number_format($cust_balance['dollar'],2)."</span> </p> ";    // ksh  balance 


 						mysqli_query_("INSERT INTO `transactions`(`id`, `customer_id`, `amount_ksh`, `amount_dollar`, `r_amount_ksh`, `r_amount_dollar`, `type_msg`, `type`, `cash_rate`, `dollar_rate`, `date`, `description`, `delete_status`) VALUES ('','{$aRow['id_card']}','$amout_ksh_db','$amout_dollar_db','$amout_ksh_db','$amout_dollar_db','".validate_msg_type($msg_type)."','$transType','0','0','{$aRow['date']}','{$aRow['description']}','0')");
 
 

 			}else if(preg_match('/-/', $aRow['doller_blance']) && !preg_match('/-/', $aRow['blance']) && trim($aRow['blance']) !='0'){
                   // 2 trans 
 
 				    // out dollar 
 					$transType = 'out';
                    $cust_balance = get_customer_balance($aRow['id_card']);
                        // $cust_balance['ksh'] = ($transType == 'out')?$cust_balance['ksh'] - $amout_ksh_db:$cust_balance['ksh'] + $amout_ksh_db; 
                         $cust_balance['dollar'] = ($transType == 'out')?$cust_balance['ksh'] - $amout_dollar_db:$cust_balance['ksh'] + $amout_dollar_db; 

 					$msg_type = "  <b> <b class=\"title_\">$transType:</b>  $".number_format($amout_dollar_db,2)."  </b><p style=\"float: right;color: black;\"><span class=\"span_\"> Balance : </span><span class=\"span_\" style=\"font-weight:normal\"> ".number_format($cust_balance['ksh'],2)." ksh </span> <span class='span_'> and </span> <span class=\"span_\" style=\"font-weight:normal\">$".number_format($cust_balance['dollar'],2)."</span> </p> ";    // ksh  balance 


 						mysqli_query_("INSERT INTO `transactions`(`id`, `customer_id`, `amount_ksh`, `amount_dollar`, `r_amount_ksh`, `r_amount_dollar`, `type_msg`, `type`, `cash_rate`, `dollar_rate`, `date`, `description`, `delete_status`) VALUES ('','{$aRow['id_card']}','$amout_ksh_db','$amout_dollar_db','$amout_ksh_db','$amout_dollar_db','".validate_msg_type($msg_type)."','$transType','0','0','{$aRow['date']}','{$aRow['description']}','0')");
 



 					// in ksh 	
 					$transType = 'in';
                    $cust_balance = get_customer_balance($aRow['id_card']);
                         $cust_balance['ksh'] = ($transType == 'out')?$cust_balance['ksh'] - $amout_ksh_db:$cust_balance['ksh'] + $amout_ksh_db; 
                         //$cust_balance['dollar'] = ($transType == 'out')?$cust_balance['ksh'] - $amout_dollar_db:$cust_balance['ksh'] + $amout_dollar_db; 

 					$msg_type = "  <b> <b class=\"title_\">$transType:</b>  $".number_format($amout_ksh_db,2)."  </b><p style=\"float: right;color: black;\"><span class=\"span_\"> Balance : </span><span class=\"span_\" style=\"font-weight:normal\"> ".number_format($cust_balance['ksh'],2)." ksh </span> <span class='span_'> and </span> <span class=\"span_\" style=\"font-weight:normal\">$".number_format($cust_balance['dollar'],2)."</span> </p> ";    // ksh  balance 


 						mysqli_query_("INSERT INTO `transactions`(`id`, `customer_id`, `amount_ksh`, `amount_dollar`, `r_amount_ksh`, `r_amount_dollar`, `type_msg`, `type`, `cash_rate`, `dollar_rate`, `date`, `description`, `delete_status`) VALUES ('','{$aRow['id_card']}','$amout_ksh_db','$amout_dollar_db','$amout_ksh_db','$amout_dollar_db','".validate_msg_type($msg_type)."','$transType','0','0','{$aRow['date']}','{$aRow['description']}','0')");
 


 
 			}else if(!preg_match('/-/', $aRow['doller_blance']) && preg_match('/-/', $aRow['blance'])  && trim($aRow['doller_blance']) !='0' ){
 				// ount $transType = 
                // 2 trans 
 
 				    // in dollar 
 					$transType = 'in';
                    $cust_balance = get_customer_balance($aRow['id_card']);
                        // $cust_balance['ksh'] = ($transType == 'out')?$cust_balance['ksh'] - $amout_ksh_db:$cust_balance['ksh'] + $amout_ksh_db; 
                         $cust_balance['dollar'] = ($transType == 'out')?$cust_balance['ksh'] - $amout_dollar_db:$cust_balance['ksh'] + $amout_dollar_db; 

 					$msg_type = "  <b> <b class=\"title_\">$transType:</b>  $".number_format($amout_dollar_db,2)."  </b><p style=\"float: right;color: black;\"><span class=\"span_\"> Balance : </span><span class=\"span_\" style=\"font-weight:normal\"> ".number_format($cust_balance['ksh'],2)." ksh </span> <span class='span_'> and </span> <span class=\"span_\" style=\"font-weight:normal\">$".number_format($cust_balance['dollar'],2)."</span> </p> ";    // ksh  balance 


 						mysqli_query_("INSERT INTO `transactions`(`id`, `customer_id`, `amount_ksh`, `amount_dollar`, `r_amount_ksh`, `r_amount_dollar`, `type_msg`, `type`, `cash_rate`, `dollar_rate`, `date`, `description`, `delete_status`) VALUES ('','{$aRow['id_card']}','$amout_ksh_db','$amout_dollar_db','$amout_ksh_db','$amout_dollar_db','".validate_msg_type($msg_type)."','$transType','0','0','{$aRow['date']}','{$aRow['description']}','0')");
 



 					// out ksh 	
 					$transType = 'out';
                    $cust_balance = get_customer_balance($aRow['id_card']);
                         $cust_balance['ksh'] = ($transType == 'out')?$cust_balance['ksh'] - $amout_ksh_db:$cust_balance['ksh'] + $amout_ksh_db; 
                         //$cust_balance['dollar'] = ($transType == 'out')?$cust_balance['ksh'] - $amout_dollar_db:$cust_balance['ksh'] + $amout_dollar_db; 

 					$msg_type = "  <b> <b class=\"title_\">$transType:</b>  $".number_format($amout_ksh_db,2)."  </b><p style=\"float: right;color: black;\"><span class=\"span_\"> Balance : </span><span class=\"span_\" style=\"font-weight:normal\"> ".number_format($cust_balance['ksh'],2)." ksh </span> <span class='span_'> and </span> <span class=\"span_\" style=\"font-weight:normal\">$".number_format($cust_balance['dollar'],2)."</span> </p> ";    // ksh  balance 


 						mysqli_query_("INSERT INTO `transactions`(`id`, `customer_id`, `amount_ksh`, `amount_dollar`, `r_amount_ksh`, `r_amount_dollar`, `type_msg`, `type`, `cash_rate`, `dollar_rate`, `date`, `description`, `delete_status`) VALUES ('','{$aRow['id_card']}','$amout_ksh_db','$amout_dollar_db','$amout_ksh_db','$amout_dollar_db','".validate_msg_type($msg_type)."','$transType','0','0','{$aRow['date']}','{$aRow['description']}','0')");
 

 			}else{

                // single  ksh			 
 				if(trim($aRow['blance']) != '0'){
 					$transType = (preg_match('/-/', $aRow['blance']))?'out':'in';
                    $cust_balance = get_customer_balance($aRow['id_card']);
                        $cust_balance['ksh'] = ($transType == 'out')?$cust_balance['ksh'] - $amout_ksh_db:$cust_balance['ksh'] + $amout_ksh_db; 
                        // $cust_balance['dollar'] = ($transType == 'out')?$cust_balance['ksh'] - $amout_dollar_db:$cust_balance['ksh'] + $amout_dollar_db; 

 					$msg_type = "  <b> <b class=\"title_\">$transType:</b>  ".number_format($amout_ksh_db,2)." ksh  </b><p style=\"float: right;color: black;\"><span class=\"span_\"> Balance : </span><span class=\"span_\" style=\"font-weight:normal\"> ".number_format($cust_balance['ksh'],2)." ksh </span> <span class='span_'> and </span> <span class=\"span_\" style=\"font-weight:normal\">$".number_format($cust_balance['dollar'],2)."</span> </p> ";    // ksh  balance 


 						mysqli_query_("INSERT INTO `transactions`(`id`, `customer_id`, `amount_ksh`, `amount_dollar`, `r_amount_ksh`, `r_amount_dollar`, `type_msg`, `type`, `cash_rate`, `dollar_rate`, `date`, `description`, `delete_status`) VALUES ('','{$aRow['id_card']}','$amout_ksh_db','$amout_dollar_db','$amout_ksh_db','$amout_dollar_db','".validate_msg_type($msg_type)."','$transType','0','0','{$aRow['date']}','{$aRow['description']}','0')");

  				}

				// single  dollar
 			 
 				if(trim($aRow['doller_blance']) != '0'){
 					$transType = (preg_match('/-/', $aRow['doller_blance']))?'out':'in';
                    $cust_balance = get_customer_balance($aRow['id_card']);
                        //$cust_balance['ksh'] = ($transType == 'out')?$cust_balance['ksh'] - $amout_ksh_db:$cust_balance['ksh'] + $amout_ksh_db; 
                         $cust_balance['dollar'] = ($transType == 'out')?$cust_balance['ksh'] - $amout_dollar_db:$cust_balance['ksh'] + $amout_dollar_db; 

 					$msg_type = "  <b> <b class=\"title_\">$transType:</b>  $".number_format($amout_dollar_db,2)."  </b><p style=\"float: right;color: black;\"><span class=\"span_\"> Balance : </span><span class=\"span_\" style=\"font-weight:normal\"> ".number_format($cust_balance['ksh'],2)." ksh </span> <span class='span_'> and </span> <span class=\"span_\" style=\"font-weight:normal\">$".number_format($cust_balance['dollar'],2)."</span> </p> ";    // ksh  balance 


 						mysqli_query_("INSERT INTO `transactions`(`id`, `customer_id`, `amount_ksh`, `amount_dollar`, `r_amount_ksh`, `r_amount_dollar`, `type_msg`, `type`, `cash_rate`, `dollar_rate`, `date`, `description`, `delete_status`) VALUES ('','{$aRow['id_card']}','$amout_ksh_db','$amout_dollar_db','$amout_ksh_db','$amout_dollar_db','".validate_msg_type($msg_type)."','$transType','0','0','{$aRow['date']}','{$aRow['description']}','0')");

  				}   

 			}
 			
 

                   // update cust balance 

                     $current_balance =  mysqli_fetch_assoc_(mysqli_query_("select current_ksh_balace,current_dollar_balace from customers where ".sanitize($aRow['id_card'])." and delete_status!='1'"));
                    $current_balance['current_dollar_balace'] += sanitize($data['amount_money_dollar']);
                    $current_balance['current_ksh_balace'] += sanitize($data['amount_money_ksh']);

                        mysqli_query_("update customers set current_ksh_balace='{$current_balance['current_ksh_balace']}', current_dollar_balace='$current_balance['current_dollar_balace']}' where customer_id=".sanitize($aRow['id_card']));
 
 
}
echo 'done';






*/



?>