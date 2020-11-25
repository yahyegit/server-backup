 <?php

require '../includes/inc_func.php';
 
if(if_logged_in() != true){
	die('login');
 }

$t = '<select id="x_car_name_"> <option>Others</option>';
if(@$q = mysql_query("SELECT `car_id`, `car_name`,  `price`, `price_type` FROM `cars` WHERE `delete_status`!='1'")){
	while($row = mysql_fetch_assoc($q)){
	 		$t .= "<option>".$row['car_name']."</optoin>";
	}
}	
$t .= "$t</select>";

echo json_encode(array('select' => $t,'x_date'=> date('Y-m-d') ));

 ?>  