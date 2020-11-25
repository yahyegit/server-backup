 <?php

require '../includes/inc_func.php';
 
if(if_logged_in() != true){
	die('login');
 }
 
set_car_avaible();
$car_id = sanitize($_POST['car_id']);

 $car_acount = get_car_details($car_id);

 $rent_now_btn =  '<a href="#" onclick=\'add_({"carName":"'.$car_acount['carName'].'"})\'  class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"  role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon "></span><span class="ui-button-text">Rent Now </span></a> '; 

 echo '<table class="table table totals_table"  > <thead> <tr><th> Car </th> <th> price </th> <th> Last Rented </th> <th> Action </th></tr> </thead><tbody> <tr><td class="sorting_1" style="cursor: pointer;">'.$car_acount["carName"].'  '.$rent_now_btn.'</td><td class="">'.$car_acount["car_price"].'</td><td class="">'.$car_acount["car_last_rented_date"].'</td><td class="">'.$car_acount["edit_btn"].' '.$car_acount["delete_btn"].' </td> </tr></tbody></table>';
													

 ?>  