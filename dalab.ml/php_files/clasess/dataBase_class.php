<?php
 error_reporting(0);
 $debugging = false;

  require 'security_class.php';


 date_default_timezone_set('africa/nairobi');

$myServer = "mysql.dalab.ml";
$myUser = "dalab";  // should have his own user and DB
$myPass = 'q78nUfiXEz9dSP81';
$myDB = 'dalab';
 




// Try and connect to the database
$connection = mysqli_connect($myServer,$myUser,$myPass,$myDB);
 
// If connection was not successful, handle the error
if($connection === false) {
  die('DB connection error ');
}
 

// mysqli_result
function mysqli_result_($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
}
 

function mysqli_fetch_assoc_($result){
  return  mysqli_fetch_assoc($result);
}


function mysqli_query_($query){
    global $connection;
    global $debugging;
      // Query the database
    $result = mysqli_query($connection,$query);

     if($result){
      
         return $result;
      }else{
          if($debugging == true){
           echo mysqli_error($connection);
           echo '<p style="border:2px solid red;">'.$query.'</p>';
          }
      }
} 


 
function mysqli_real_escape_string_($data){
          global $connection;
    return mysqli_real_escape_string($connection,$data);
}






 // date corrector
function date_corrector($date){
  $date =  str_replace('/', '-', str_replace('\\', '-', $date));
  $date = explode('-', $date);
  $date_str = implode('-',$date);
  if(count($date) == 3 ){   // day   
    return date('Y-m-d',strtotime($date_str)); 
  }else if(count($date) == 2) { // month
    return date('Y-m',strtotime($date_str)); 
  }else{
    // year 
    return $date_str;
  }

  
}

 






 

function get_unique_code(){  
 
  $expiration = date('Y-m-d',strtotime("+ 2 day"));
  $code = rand();

  while (true){
    if(mysqli_result_(mysqli_query_("SELECT count('id') FROM `crf` WHERE crf_token='$code' "), 0) == '0'){
         mysqli_query_("INSERT INTO `crf`(id, crf_token, crf_token_status, expiration_date) VALUES ('','$code','1','$expiration')");
         break;
    }else{
      $code = rand();
    }
  }

  return $code;
}











?>
