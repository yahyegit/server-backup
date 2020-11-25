<?php

require '../includes/inc_func.php';
 
if(if_logged_in() != true){
	die('login');
 }
 



 $n = sanitize($_POST['number']);
 $from_date = date_corrector(sanitize($_POST['from_date']));
 $per = day_convert(sanitize($_POST['chosen_per']));
  $per1 =  $per;

$per = ($n == '1')?substr($per, 0,strlen($per)-1):$per;

$todate = date('Y-m-d',strtotime("$from_date +$n $per"));

 $datefrom = explode('-', $from_date);
//if ($datefrom[2] == '01'  ){
          echo date('Y-m-d', strtotime("$todate -1 day "));

//}else{
      //        echo $todate;
//}








 ?>
