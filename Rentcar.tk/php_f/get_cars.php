 <?php

require '../includes/inc_func.php';
 
if(if_logged_in() != true){
	die('login');
 }
set_car_avaible();

$t = '<select id="car_name" data-placeholder="choose..." onchange="car_or_customer_changed($(this).find(\'option:selected\').attr(\'da\'),$(this).val())"  placeholder="choose..."> <option da=\'{"status":"cars"}\'>choose...</option>  <option da=\'{"status":"cars"}\'> Add</option>';
if(@$q = mysql_query("SELECT `car_id`, `car_name`,  `price`, `price_type` FROM `cars` WHERE `delete_status`!='1'")){
	while($row = mysql_fetch_assoc($q)){
			$da = array(
					'status'=> 'cars',
					'car_id' => $row['car_id'],
					'price' => $row['price'],
					'car_name' => $row['car_name'],
					'price_type' => $row['price_type'],
		 );

		$t .= "<option da='".json_encode($da)."' > ".$row['car_name']."  |  $us_".number_format($row['price'])." $ksh | ".$row['price_type']."  </optoin>";
	}
}	
echo "$t</select>  <div style='display:none' class='add_car_auto'> <pre> <input type=\"text\" id=\"car_name\"  placeholder='car name ' style=\"
    
\">   $us_<input placeholder=\"set price \" type='number' id=\"car_price_add\" class=\"digit_size\"> $ksh    
							<select id='car_price_type_add'>
								<option>per...</option>
								<option>Daily</option>
								<option>Weekly</option>
								<option>Monthly</option>
								<option>Yearly</option>
							</select></pre></div>";
 


 ?>  