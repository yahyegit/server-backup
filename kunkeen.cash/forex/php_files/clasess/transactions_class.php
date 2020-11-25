
<?php 
     include 'db_connector.php';
         require 'auto_create.php';

  if(!function_exists('add_customer')){
       require 'customers_class.php';
  }
  if(!function_exists('toggle_debt_color')){
       require '../global_functions/toggle_debt_or_in_color.php';
  }

  function clean_now($va){
  	return mysqli_real_escape_string_(str_replace(',', '', trim($va)));
  }
    function resul_($va){
    	$val = explode(' ',trim($va));
  	return $val[1];
   }
 // add or edit transaction 
function make_transaction($data){
	if(check_token($data['crf_code'],'check')){
   		   // $data = clean_security($data);
   		    $amount_data = $data['amount_data'];
 			$customer_id = add_customer($data);
    			$prev_balance =  get_balance($customer_id);
   			for ($i=0; $i <  count($data['amount_data']['amount']); $i++) { 



 	  mysqli_query_("INSERT INTO `transactions`(`id`, `customer_id`, `currency`, `amount`, `type`, `sell_rate`, `buy_rate`, `conv_to_currency`, `converted_result`, `profit`, `description`, `msg_type`,`date`,`delete_status`) VALUES ('','$customer_id','".clean_now($amount_data['currency'][$i])."',".clean_now($amount_data['amount'][$i]).",'".clean_now($amount_data['type'][$i])."','".clean_now($amount_data['sell_rate'][$i])."','".clean_now($amount_data['buy_rate'][$i])."','".clean_now($amount_data['conv_to_currency'][$i])."','".clean_now(resul_($amount_data['converted_result'][$i]))."','".clean_now(resul_($amount_data['profit'][$i]))."','".clean_now($data['description'])."','','".clean_now($data['date'])."',0) ");

 

 $amount_data['amount'][$i] = clean_now($amount_data['amount'][$i]);

 $amount_data['converted_result'][$i] = clean_now(resul_($amount_data['converted_result'][$i]));
$amount_data['profit'][$i] = clean_now(resul_($amount_data['profit'][$i]));

   			$new_balance =  get_balance($customer_id);
			
 
   			// msg_type 
   	 

   			if (($amount_data["type"][$i] == 'In' || $amount_data["type"][$i] == 'Out') && !empty($amount_data['converted_result'][$i])) {
 



$msg_type = "

<div ><b>".strtoupper($amount_data["type"][$i])."</b>: <b>".strtoupper($amount_data["conv_to_currency"][$i]).number_format($amount_data["converted_result"][$i],2)."</b>

	<br><p style=\"
    font-style: italic;
    margin: 3px;
    margin-left: 29px;
\">
	converted from <b>".strtoupper($amount_data["currency"][$i]).number_format($amount_data["amount"][$i],2)."</b>
	sell rate: <b>
	".strtoupper($amount_data["conv_to_currency"][$i]).number_format($amount_data["sell_rate"][$i],2)."</b> buy rate: <b>".strtoupper($amount_data["conv_to_currency"][$i]).number_format($amount_data["buy_rate"][$i],2)."</b>

	 Profit: <span style='color:green; font-weight:bold;' > ".strtoupper($amount_data["conv_to_currency"][$i]).number_format($amount_data["profit"][$i],2)."</span>

	</p>


<div  class=\"bl_list\" style=\"
    margin-left: 34px;     margin-top: 4px;
\"> <div > prev  balance:".strtoupper($amount_data["conv_to_currency"][$i])."<span class='".toggle_debt_color($prev_balance[$amount_data["conv_to_currency"][$i]])."'>".number_format($prev_balance[$amount_data["conv_to_currency"][$i]],2)."</span></div>

<div > new balance:".strtoupper($amount_data["conv_to_currency"][$i])."<span class='".toggle_debt_color($new_balance[$amount_data["conv_to_currency"][$i]])."'>".number_format($new_balance[$amount_data["conv_to_currency"][$i]],2)."</span></div>
	</div>	 
</div>
";



   			}else if ($amount_data['type'][$i] != 'forex' && empty($amount_data['converted_result'][$i])) { // in or out only 
  $msg_type = '
<div style="
    /* clear: both; */
   
"><b>'.strtoupper($amount_data["type"][$i])."</b>: <b>".strtoupper($amount_data["currency"][$i]).number_format($amount_data["amount"][$i],2).'</b>

  
<div class="bl_list" style=\"
    margin-left: 34px;     margin-top: 4px;
\"> <div >  prev  balance:'."<span class='".toggle_debt_color($prev_balance[$amount_data["currency"][$i]])."'>".strtoupper($amount_data["currency"][$i]).number_format($prev_balance[$amount_data["currency"][$i]],2)."</span></div>

	<div >  new balance: <span class='".toggle_debt_color($new_balance[$amount_data["currency"][$i]])."'>".strtoupper($amount_data["currency"][$i]).number_format($new_balance[$amount_data["currency"][$i]],2).'</span></div>
		</div>	 
</div>
';

 

   			}else if ($amount_data['type'][$i] == 'forex'){
 
		$msg_type = '
				<div><b>'.strtoupper($amount_data["type"][$i])."</b>: <p style=\"
    display: inline;
\"><b>".strtoupper($amount_data["currency"][$i]).number_format($amount_data["amount"][$i],2).'</b> converted to <b>'.strtoupper($amount_data["conv_to_currency"][$i]).number_format($amount_data["converted_result"][$i],2).'</b>   sell rate: '.strtoupper($amount_data["conv_to_currency"][$i]).number_format($amount_data["sell_rate"][$i],2).' buy rate: '.strtoupper($amount_data["conv_to_currency"][$i]).number_format($amount_data["buy_rate"][$i],2).'
			 Profit: <b style="color:green" > '.strtoupper($amount_data["conv_to_currency"][$i]).number_format($amount_data["profit"][$i],2).'  </b>
                       </p>

				 </div>
					 ';

   			}

			// update msg type 

			$trans_id = mysqli_result_(mysqli_query_("select id from  transactions where customer_id=$customer_id and delete_status!=1 ORDER BY id DESC LIMIT 1"));
			mysqli_query_("update transactions set msg_type=\"".sanitize($msg_type)." \" where id=$trans_id");

			}
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


	  make_transaction($_POST['data']);
     // Export_Database($myServer,$myUser,$myPass,$myDB);

}
 


?>
