 <?php

require '../includes/inc_func.php';
 
if(if_logged_in() != true){
	die('login');
 }
 
$t = '<select id="customer_name" onchange="car_or_customer_changed($(this).find(\'option:selected\').attr(\'da\'),$(this).val())" data-placeholder="choose..." placeholder="choose..."> <option da=\'{"status":"customer"}\'>choose...</option>  <option da=\'{"status":"customer"}\'> Add </option>';
if(@$q = mysql_query("SELECT `customer_id`, `customer_name`, `mobile`, `email` FROM `customers` WHERE `delete_status`!='1'")){
	while($row = mysql_fetch_assoc($q)){
		$da = array('status'=> 'customer',
			 		'customer_id' => $row['customer_id'],
					'customer_name' => $row['customer_name'],
					'customer_mobile' => $row['mobile'],
					'customer_email' => $row['email'],
		 );

		$t .= "<option  da='".json_encode($da)."'> ".$row['customer_name']."  ".((!empty($row['mobile']))?" | ".$row['mobile']:'')." </optoin>";
	}
}	
echo "$t</select> <br><input type=\"text\" id=\"customer_name\" style='display:none'> ";
 ?>  