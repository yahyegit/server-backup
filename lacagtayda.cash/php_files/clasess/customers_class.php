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
 						mysqli_query_("insert into customers (customer_name,mobile,delete_status) values('".sanitize($customer_info['customer_name'])."','".sanitize($customer_info['mobile'])."','0')");
						return mysqli_result_(mysqli_query_("SELECT customer_id FROM customers ORDER BY customer_id DESC LIMIT 1"),0);
			}
		}else{
  			die('login');  
		}
}
 

 function get_customers_names($current_cust){ 
 //return '';
   
 }
 


// updates when transaction is modifed or delated or aded 
function update_customer_balance($customer_id){ 
}



function get_credit_debt($type){
	$type = trim($type);
$Balances = array();
	$Balances_ = '<div class="bl_list" >';

	$c_id = mysqli_query_("SELECT DISTINCT customer_id from customers where delete_status!='1' ");
	   while($cust_id = mysqli_fetch_assoc_($c_id)){ 
          $Balances[] = get_balance($cust_id['customer_id']);
     }


 	 $len = 0;

$Balances_2 = array();

     foreach ($Balances as $array => $bl) {

     	//if(count($bl) != 0){
     		foreach ($bl as $currency => $val) {
     			$bb = (!empty($Balances_2[$currency]))?$Balances_2[$currency]:0;
     	        $Balances_2[$currency] = $bb + $val; 
     		}
     }			



 
     	//if(count($bl) != 0){
     		foreach ($Balances_2 as $currency => $val) {
     			# code...
     		
				      		if($type == 'credit' && !preg_match('/-/',$val) && !empty($val)){
				     				$Balances_ .= "<div class='in_color' >".strtoupper($currency).number_format($val,2)."</div>";
				     				$len = $len + 1;
				     		}else if($type == 'debt' && preg_match('/-/',$val)){
				     				$Balances_ .= "<div class='debt_color'>".strtoupper($currency).number_format($val,2)."</div>";
				       				$len = $len + 1;
				   				
				     		}
			}
     //	}

    


     return  array('len' =>$len , 'value'=>$Balances_.'</div>');
}



function get_balance_($customer_id){
	$Balances = get_balance($customer_id);
	$Balances_ = '<div class="bl_list">';

	     foreach ($Balances as $currency => $val) {


	     		if(!preg_match('/-/',$val)){
	     				$Balances_ .= "<div class='in_color'>".strtoupper($currency).number_format($val,2)."</div>";
	     		}else if(preg_match('/-/',$val)){
	     				$Balances_ .= "<div class='debt_color'>".strtoupper($currency).number_format($val,2)."</div>";
	     		}
	     }


 

    
	     return $Balances_.'</div>';

}

function  get_balance($customer_id){
	$customer_id = sanitize($customer_id);
 
	$cust = (!empty($customer_id))?" and customer_id=$customer_id":''; 

$currencies = array();
	$c = mysqli_query_("SELECT DISTINCT currency from transactions where converted_result='0'  $cust and delete_status!='1' ");
   while($cu = mysqli_fetch_assoc_($c)){ 
    	$currencies[] = $cu['currency']; 
    }

	$c = mysqli_query_("SELECT DISTINCT conv_to_currency from transactions where converted_result!='0'  $cust  and delete_status!='1' ");
   while($cu = mysqli_fetch_assoc_($c)){ 
    	$currencies[] = $cu['conv_to_currency']; 
    }
$currencies = array_unique($currencies);


$Balances = array();

	foreach ($currencies as $currency) {
		 
		$in = mysqli_result_(mysqli_query_("SELECT  sum(amount) from transactions where type='in' and currency='$currency' and converted_result='0'   $cust  and delete_status!='1' ")) + mysqli_result_(mysqli_query_("SELECT  sum(converted_result) from transactions where type='in' and conv_to_currency='$currency' and converted_result!='0'  $cust  and delete_status!='1' "));

		$out = mysqli_result_(mysqli_query_("SELECT  sum(amount) from transactions where type='out' and currency='$currency' and converted_result='0'  $cust  and delete_status!='1' ")) + mysqli_result_(mysqli_query_("SELECT  sum(converted_result) from transactions where type='out' and conv_to_currency='$currency' and converted_result!='0'   $cust  and delete_status!='1' "));

		$bl = $in - $out;

		$Balances[$currency] = $bl;
	}

 return $Balances;



}




 	
if(isset($_POST['data']['edit_cust_info'])){
	  if_logged_in('die'); 
 	if(ctype_digit(add_customer($_POST['data']))){
 		check_token($_POST['data']['crf_code'],'');   // remove_crf
 		echo 'ok';
 	}  
			
} 



?>
