<?php
  error_reporting(0);
 
 
   include '../PHPMailer/class.phpmailer.php';  
 


$myServer = "localhost";
$myUser = "phpmyadmin";
$myPass = '#qX@#$QQdgg/.<q]&Aa3$%^sDVEg8SyCDX##';
$myDB = "harun_rent"; 



 
    //connection to the database
  if(!@mysql_connect($myServer, $myUser, $myPass)){
   die("Error't connect To the server "); 
  }else if(!@mysql_select_db($myDB)){
    die("Couldn't open database "); 
  }else{
  
  } 

  $not_deleted = '`delete_status`!=1';  
 
function sanitize($value){
  return htmlentities(mysql_real_escape_string(str_replace("'",'',str_replace('"','',trim(str_replace('`','',str_replace("|",'', $value)))))));
  }

function sanitize_security($value){
  return htmlentities(mysql_real_escape_string($value));
  }


// check login 
    
$userId_activities = 0;
  
 function if_logged_in(){
    session_start();
    if (isset($_SESSION['user_id'])){
        global  $userId_activities;
                $userId_activities = $_SESSION['user_id'];
        return true;
     
    }else{

    return false;
    }
 }

   

  function get_dueDate_th($id_collmn,$value){
      $query = (trim($id_collmn) == '')?'':'and $id_collmn=$value';
    return (mysql_result(mysql_query("select count(id) from rented_cars where due_date!='0000-00-00' $query and delete_status!='1'"), 0) != '0')?'<th> Due-date </th>':'';
  }




   // display time ago or afer 
 
 function timeago($date)

{

    if(empty($date)) {

        return false;

    }
   if(trim($date) == '') {

        return false;

    }

    

    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");

    $lengths         = array("60","60","24","7","4.35","12","10");

    

    $now             = time();

    $unix_date         = strtotime($date);

    

       // check validity of date

    if(empty($unix_date)) {    

        return "!";

    }



    // is it future date or past date

    if($now > $unix_date) {    

        $difference     = $now - $unix_date;

        $tense         = "ago";

        

    } else {

        $difference     = $unix_date - $now;

        $tense         = "from now";

    }

    

    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {

        $difference /= $lengths[$j];

    }

    

    $difference = round($difference);

    

    if($difference != 1) {

        $periods[$j].= "s";

    }

    

 
    return "$difference $periods[$j] {$tense}";     

}

/**
 * @param $interval
 * @param $datefrom
 * @param $dateto
 * @param bool $using_timestamps
 * @return false|float|int|string
 */

function datediff($interval, $datefrom, $dateto, $using_timestamps = false)
{
    /*
    $interval can be:
    yyyy - Number of full years
    q    - Number of full quarters
    m    - Number of full months
    y    - Difference between day numbers
           (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
    d    - Number of full days
    w    - Number of full weekdays
    ww   - Number of full weeks
    h    - Number of full hours
    n    - Number of full minutes
    s    - Number of full seconds (default)
    */

    if (!$using_timestamps) {
        $datefrom = strtotime($datefrom, 0);
        $dateto   = strtotime($dateto, 0);
    }

    $difference        = $dateto - $datefrom; // Difference in seconds
    $months_difference = 0;

    switch ($interval) {
        case 'yyyy': // Number of full years
            $years_difference = floor($difference / 31536000);
            if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
                $years_difference--;
            }

            if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
                $years_difference++;
            }

            $datediff = $years_difference;
        break;

        case "q": // Number of full quarters
            $quarters_difference = floor($difference / 8035200);

            while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                $months_difference++;
            }

            $quarters_difference--;
            $datediff = $quarters_difference;
        break;

        case "m": // Number of full months
            $months_difference = floor($difference / 2678400);

            while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                $months_difference++;
            }

            $months_difference--;

            $datediff = $months_difference;
        break;

        case 'y': // Difference between day numbers
            $datediff = date("z", $dateto) - date("z", $datefrom);
        break;

        case "d": // Number of full days
            $datediff = floor($difference / 86400);
        break;

        case "w": // Number of full weekdays
            $days_difference  = floor($difference / 86400);
            $weeks_difference = floor($days_difference / 7); // Complete weeks
            $first_day        = date("w", $datefrom);
            $days_remainder   = floor($days_difference % 7);
            $odd_days         = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?

            if ($odd_days > 7) { // Sunday
                $days_remainder--;
            }

            if ($odd_days > 6) { // Saturday
                $days_remainder--;
            }

            $datediff = ($weeks_difference * 5) + $days_remainder;
        break;

        case "ww": // Number of full weeks
            $datediff = floor($difference / 604800);
        break;

        case "h": // Number of full hours
            $datediff = floor($difference / 3600);
        break;

        case "n": // Number of full minutes
            $datediff = floor($difference / 60);
        break;

        default: // Number of full seconds (default)
            $datediff = $difference;
        break;
    }


 $datefrom = explode('-', $datefrom);
//if ($datefrom[2] == '01'  ){
          return $datediff +1;
/*}else{
    return $datediff ;
}*/

}

// rented date formater
// daily,weekly,monthly,yearly
function format_rented_date($from,$to,$price_type){
	$price_type = trim(strtolower($price_type));
  if(trim($price_type) == ''){  
    return str_replace('-','',datediff('d', $from, $to, false)).' Days';
  }else  if($price_type == 'daily'){  
    return str_replace('-','',datediff('d', $from, $to, false)).' Days';
  }else if($price_type == 'weekly'){
    return str_replace('-','',datediff('ww', $from, $to, false)).' Weeks';
  }else if($price_type == 'monthly'){
        $xd = str_replace('-','',datediff('m', $from, $to, false));
    return (trim($xd) == '0')?'1 month':$xd.' Months';

  }else if($price_type == 'yearly'){
    return  str_replace('-','',datediff('yyyy', $from, $to, false)).' Years';
  }
}
 
//echo datediff('w','1-10-2018', '8-10-2018', true).' s Days';


// get customer account 
function get_customer_account($customer_account_id,$custom_type=''){
  $not_deleted = '`delete_status`!=1';
  $customer__name = mysql_result(mysql_query("SELECT `customer_name` FROM `customers` WHERE `customer_id`='$customer_account_id'"), 0);

  $rent_colmns = 'id, customer_id, car_name, from , price, paid, balance, due_date';
  $currentDate = date('Y-m-d'); 
  $rent_theed = '<th> name </th><th> car </th> <th> Rented Date </th> <th> price </th> <th> Paid </th> <th> Balance </th> '.get_dueDate_th('customer_id',$current_Row_id).' <th> Action </th> ';  

  $customer_acount = array(
        'status' => 'customer_account', 
        'customer_name' => $customer__name,
        'overDue_count' => number_format(mysql_result(mysql_query(" SELECT count(id) FROM `rented_cars` WHERE customer_id=$customer_account_id and balance!=0 and `due_date`!='0000-00-00' and `due_date`<='$currentDate' and $not_deleted "), 0)),
      // car rent 
        'table_rent' => 'rented_cars',
        'where_query_rent' => "customer_id=$customer_account_id",
        'primary_key_rent' => 'id',
        'colmns_rent' => $rent_colmns,
        'thead_rent' => $rent_theed,

      // car rent Debts
        'table_rent_debt' => 'rented_cars',
        'where_query_rent_debt' => "customer_id=$customer_account_id AND balance!=0 ",
        'primary_key_rent_debt' => 'id',
        'colmns_rent_debt' => $rent_colmns,
        'thead_rent_debt' => $rent_theed,

      // car rent due-dates
        'table_rent_overDue' => 'rented_cars',
        'where_query_rent_overDue' => "customer_id=$customer_account_id AND balance!=0 AND `due_date`!=0000-00-00 AND `due_date`<=111",
        'primary_key_rent_overDue' => 'id',
        'colmns_rent_overDue' => $rent_colmns,
        'thead_rent_overDue' => $rent_theed,

      // customer payments
        'table_cust_payments' => 'payments',
        'where_query_cust_payments' => "customer_id=$customer_account_id",
        'primary_key_cust_payments' => 'id',
        'colmns_cust_payments' => 'id, paid, customer_id, car_name, date, description',
        'thead_cust_payments' => '<th>Paid</th><th>Name</th><th>Car</th><th>Date</th><th>Description</th><th>Action</th>'

     
      );

  if($custom_type == '2'){
     return "<div class='get_details' onclick='data_table_creator(".htmlentities(json_encode($customer_acount)).")'>".$customer__name."</div>";
  }else{
    return $customer_acount;
  }
} 



function get_unique_code($type){ // type e.g: crf
  $type = (trim($type) == 'crf')?'`crf_token`':'`pass_reset_code`';
  $status_colm = (trim($type) == '`crf_token`')?'`crf_token_status`':'`pass_reset_code_status`';
  $expiration = date('Y-m-d',strtotime("+ 1 day"));
  $code = rand();

  while (true){
    if(mysql_result(mysql_query("SELECT count('id') FROM `security` WHERE $type='$code' "), 0) == '0'){
         mysql_query("INSERT INTO `security`(`id`, $type, $status_colm,`expiration_date`) VALUES ('','$code','1','$expiration')");
         break;
    }else{
      $code = rand();
    }
  }

  return $code;
}

function check_code_expiration(){
return false;
  $currentDate = date('Y-m-d'); 
    // crf
    mysql_query("update security set crf_token_status='0' WHERE `expiration_date`<='$currentDate' and crf_token_status!='0'"); 
    // pass reset 
    mysql_query("update security set pass_reset_code_status='0' WHERE `expiration_date`<='$currentDate' and pass_reset_code_status!='0'");     

}

 

function set_car_avaible(){

return false;
/*
  $currentDate = date('Y-m-d'); 
    if(@$q = mysql_query("SELECT  `status`,`car_id`, `car_name`,  `price`, `price_type` FROM `cars` WHERE `status`!='available' and `delete_status`!='1'")){
        while($row = mysql_fetch_assoc($q)){
            $car_id = $row['car_id'];
            $customer_id = $row['status'];
            if(!empty(mysql_result(mysql_query("SELECT `to` FROM `rented_cars` WHERE  `car_id`=$car_id and `customer_id`=$customer_id and `to`<'$currentDate'  and `delete_status`!='1' ORDER BY `id` DESC LIMIT 1"), 0))){
              // the car is availbe
                 mysql_query("UPDATE `cars` SET `status`='available' WHERE car_id='$car_id'");
             }
        }
    } */
}





 // get currency 
 $us_ = '';
 $ksh = '';
function get_currency(){
  global $us_,$ksh;

  $cc = strtolower(mysql_result(mysql_query("select currency from currency where status='1'" ),0));

  if($cc == '$'){ 
    $us_ = '<span class="dollar_currency">$</span>';
    $ksh = '';
  }else if($cc == 'ksh'){
    $us_ = '';
    $ksh = '<span class="ksh_currency">Ksh</span>'; 
  }

} 
get_currency();
 

 // date corrector
function date_corrector($date){
  $date = str_replace(' ', '-', str_replace('/', '-', str_replace('\\', '-', $date)));
  return date('Y-m-d',strtotime($date)); 
}


function day_convert($name){
  $name = strtolower($name);
  if($name == 'weekly'){
    return 'weeks';
  }else if($name == 'monthly'){
    return 'months';
  }else if($name == 'yearly'){
    return 'years';
  }else if($name == 'daily'){
    return 'days';
  }
}


// make payment
function make_payment($payment,$customer_id,$payment_date,$description){
    if(@$q = mysql_query("SELECT `car_id`, `id`, `paid`, `car_name`, `price`, `balance` FROM `rented_cars` WHERE `customer_id`='$customer_id' and `balance`!='0' and `delete_status`!='1'")){
          $car_names = '';
          $payment_ = $payment;
          $payment = $payment;
          $car_ids = ',';
          while($row = mysql_fetch_assoc($q)){
                
                if(empty($payment)){
                        break;
                }else{

                    if($payment <= $row['balance'] ){
                          mysql_query("update rented_cars set `paid`=`paid`+$payment, `balance`=`price`-".($row['paid']+$payment)." WHERE id=".$row['id']); 
                          $payment = '0'; 
                    }else{
                          mysql_query("update rented_cars set `paid`='".$row['price']."', `balance`='0' WHERE id=".$row['id']); 
                          $payment = $payment-$row['balance']; 
                    }

                    if($payment == '0'){
                          if(empty($car_names)){
                              $car_names .= $row['car_name'];
                          }else{
                              $car_names .= ' and '.$row['car_name'];
                          }
                    }else{
                        $car_names .= ((empty($car_names))?'':',').$row['car_name'];
                    }
                     $car_ids .= $row['car_id'].',';
                }     
          } 
        mysql_query("INSERT INTO `payments`(`id`,`car_id`, `paid`, `customer_id`, `car_name`, `date`, `description`, `delete_status`) VALUES ('','$car_ids','$payment_','$customer_id','$car_names','$payment_date','$description','0')");  
    }
}


// reverse payment
function reverse_payment($payment,$customer_id){
    if(@$q = mysql_query("SELECT `id`, `paid`,  `price`, `balance` FROM `rented_cars` WHERE `customer_id`='$customer_id' and `paid`!='0' and `delete_status`!='1'")){
          while($row = mysql_fetch_assoc($q)){
                if($payment == '0'){
                        break;
                }else{
                    if($payment <= $row['paid']){
                          mysql_query("update rented_cars set `paid`=`paid`-$payment, `balance`=`price`-".($row['paid']-$payment)." WHERE id=".$row['id']); 
                          $payment = 0; 
                    }else{
                          mysql_query("update rented_cars set `paid`='0', `balance`=`price` WHERE id=".$row['id']); 
                          $payment = $payment - $row['paid']; 
                    }
                }
                      
          } 
    }
}


function get_last_rented_by($current_Row_id){
  // last rented 
  $from__ = mysql_result(mysql_query("select `from` from rented_cars where car_id='$current_Row_id' and delete_status!=1  ORDER BY `to` DESC LIMIT 1 "), 0);
  $to__ = mysql_result(mysql_query("select `to` from rented_cars where car_id='$current_Row_id' and delete_status!=1  ORDER BY `to` DESC LIMIT 1 "), 0);
  $price_type__ = mysql_result(mysql_query("select `price_type` from rented_cars where car_id='$current_Row_id' and delete_status!=1  ORDER BY `to` DESC LIMIT 1 "), 0);
   $rented_last_id = mysql_result(mysql_query("select `customer_id` from rented_cars where car_id='$current_Row_id' and delete_status!=1  ORDER BY `to` DESC LIMIT 1 "), 0);

  if(!empty($from__)){
    $car_acount = '<span style="font-weight: bold;">from </span>'.date('D, d/M/Y',strtotime($from__)).'<span style="font-weight: bold;"> to </span>'.date('D, d/M/Y',strtotime($to__)).', '.format_rented_date($from__,$to__,$price_type__).' ,    rented by <a href="#" onclick=\'data_table_creator('.str_replace('"',"'", htmlentities(json_encode(get_customer_account($rented_last_id )))).')\'  class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"  role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon "></span><span class="ui-button-text"> '.mysql_result(mysql_query("select customer_name from customers where customer_id=$rented_last_id"),0).' </span></a>';


  }else{
    $car_acount = 'Never';
  }

  return $car_acount;

}  


function get_car_account($car_id,$car_type = ''){
     $rent_colmns = 'id, customer_id, car_name, from , price, paid, balance, due_date';

        $current_Row_id = $car_id;
        $car_acount = array(
        'status' => 'car_account',  
        'carName' => mysql_result(mysql_query("select car_name from cars where car_id='$current_Row_id'"), 0),
 
      // car rent history 
        'table_rent' => 'rented_cars',
        'where_query_rent' => "car_id=$current_Row_id",
        'primary_key_rent' => 'id',
        'colmns_rent' => $rent_colmns,
        'thead_rent' => '<th> name </th><th> car </th> <th> Rented Date </th> <th> price </th> <th> Paid </th> <th> Balance </th> '.get_dueDate_th('car_id',$current_Row_id).' <th> more </th> <th> Action </th> ',

      // car income
        'table_income' => 'payments',
        'where_query_income' => "`car_id` like |~,$current_Row_id,~| ",
        'primary_key_income' => 'id',
        'colmns_income' => 'id,paid,customer_id, car_name, date, description',
        'thead_income' => '<th>Paid</th><th>Name</th><th>Car</th><th>Date</th><th>Description</th><th>Action</th>',

       // car expense
        'table_expense' => 'expense',
        'where_query_expense' => "car_id=$current_Row_id",
        'primary_key_expense' => 'id',
        'colmns_expense' => 'id, expense_name, quantity, cost , car_name, date',
        'thead_expense' => '<th>Name</th><th>Quantity</th><th>Cost</th><th>Car</th><th>Date</th> <th>Action</th>',

      );



  $car_price = "<pre> $us_".number_format(mysql_result(mysql_query("select price from cars where car_id=$current_Row_id"),0),2)." $ksh".' per '.mysql_result(mysql_query("select price_type from cars where car_id=$current_Row_id  and  $not_deleted  "), 0).'</pre>';
  
 /*
 ' <a href="#" onclick=\'add_({"carName":"'.$car_acount['carName'].'"}) \'  class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"  role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon "></span><span class="ui-button-text">Rent Now , <strong>    $car_acount['carName'] </strong> </span></a> ';   */ 

  // last rented 
  
  // last rented 


  $car_acount['car_last_rented_date'] = get_last_rented_by($current_Row_id);
  $car_acount['car_price'] = $car_price;


  if($car_type == '2'){
        $car_acount['car_last_rented_date'] = '';
        $car_acount['car_status'] = '';     
        return "<div class='get_details' onclick='data_table_creator(".htmlentities(json_encode($car_acount)).",$current_Row_id)'>".$car_acount['carName']."</div>"; 
  }else{
    return $car_acount;
  }

}


// get car details

function get_car_details($car_id){
 
        $current_Row_id = $car_id;
        $car_acount = array(
        'carName' => mysql_result(mysql_query("select car_name from cars where car_id='$current_Row_id'"), 0),
      );



  $car_price = "<pre> $us_".number_format(mysql_result(mysql_query("select price from cars where car_id=$current_Row_id"),0),2)." $ksh".' per '.mysql_result(mysql_query("select price_type from cars where car_id=$current_Row_id"), 0).'</pre>';
  // car status 
  $status_val = mysql_result(mysql_query("select status from cars where car_id=$current_Row_id"),0);
  if($status_val == 'available'){

     $car_acount['car_status'] = '<b style="color:green;">Available</b>  <a href="#" onclick=\'console.log({"carName":"'.$car_acount['carName'].' ` | '.$car_price.'"}) \'  class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"  role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon "></span><span class="ui-button-text">Rent Now </span></a> ';

  }else{
     $car_acount['car_status'] = 'Rented by <a href="#" onclick=\'data_table_creator('.str_replace('"',"'", htmlentities(json_encode(get_customer_account($status_val)))).')\'  class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"  role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon "></span><span class="ui-button-text"> '.mysql_result(mysql_query("select customer_name from customers where customer_id=$status_val"),0).' </span></a>';
  }


 
  $car_acount['car_last_rented_date'] = get_last_rented_by($current_Row_id);
 

  $car_acount['car_price'] = $car_price;



// edit car button 
$car_acount['edit_btn'] = '<a href="#"   class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"   onclick=\'add_car('.json_encode(array('status'=>'edit', 'car_name' => $car_acount['carName'],'car_id' => $current_Row_id, 'price' => mysql_result(mysql_query("select price from cars where car_id=$current_Row_id"),0),'price_type'=>mysql_result(mysql_query("select price_type from cars where car_id=$current_Row_id"),0))).')\' role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-pencil"></span><span class="ui-button-text">Edit</span></a>';


// delete btn
$car_acount['delete_btn'] = '<a href="#" class=" ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-state-hover" onclick=\'delete_('.json_encode(array('msg'=> 'Deleting <strong>'.$car_acount['carName'].'</strong>','table' => 'cars','id' => $current_Row_id, 'colmn'=> 'car_id' )).')\' role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-trash"></span><span class="ui-button-text">Delete</span></a>';  

return $car_acount;

}




















































?>

