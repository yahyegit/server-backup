<?php
  error_reporting(0);
 $debugging = false; 



 date_default_timezone_set('africa/nairobi');



$myServer = "localhost";
$myUser = "root";  
$myPass = 'ssdVfsa@tX[]#O$#%^dq[9n1$|';
$myDB = "geelayga";




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
           echo '<p>'.$query.'</p>';
          }
      }
} 


 
function mysqli_real_escape_string_($data){
          global $connection;
    return mysqli_real_escape_string($connection,$data);
}

function validate_msg_type($val){
  return mysqli_real_escape_string_($val);
}



function sanitize($value){
   $value = (is_numeric(str_replace(',','',$value)))?str_replace(',','',$value):$value;

  return htmlentities(mysqli_real_escape_string_(str_replace("'",'',str_replace('"','',trim(str_replace('`','',str_replace("|",'', $value)))))));
}

 
 
function sanitize_other_query($value){ 
     $v = explode("'", $value);
     if(preg_match('/between/',strtolower($value))){
          return mysqli_real_escape_string_($v[0])."'".mysqli_real_escape_string_(str_replace('%', '',$v[1]))."' AND '".mysqli_real_escape_string_(str_replace('%', '',$v[3]))."'";
     }else{
          return mysqli_real_escape_string_($v[0])."'".mysqli_real_escape_string_($v[1])."'";
     }
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

 
function enc_password($pass){
  return md5(md5($pass.'!@#$%#twertwe%#$').'ASDFSDGF3#345$%8908#$').'1546/>][7987^^&)51';
}


// check login 
 
 function if_logged_in($type){   // check,check with die(), login,
 session_start();

       global $myDB;  

        if($type == 'logout'){
                $_SESSION[$myDB] = '';
             return 'out_done';   
             die();
        }else if(isset($_SESSION[$myDB]) && !empty($_SESSION[$myDB])){
            return true;         
        }else{
          


             if(isset($type['username'])){  // authenticate now 
                if(mysqli_result_(mysqli_query_("select count(username) from settings where password='".enc_password(sanitize($type['password']))."' and username='".sanitize($type['username'])."'"),0) == '1'){
                      
                       $_SESSION[$myDB] = rand().'3453'.rand();

                       return 'login';
                }else{
                     return 'incorrect username or password !';
                }
            }else if(trim($type) == 'die'){
                  die('login'); // return login to auto refrash the page
            }else{
                  return false;
            }
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

function check_token($token,$type){
    $currentDate = date('Y-m-d'); 
    $token = sanitize($token);
      if(trim($type) == 'check'){

           if(mysqli_result_(mysqli_query_("SELECT count('id') FROM `crf` WHERE crf_token='$token' and expiration_date >=$currentDate and crf_token_status!='0' "), 0) == '1'){ 
                return true;
              }else{
                return false;
              }
      }else{
        // update 
           mysqli_query_("UPDATE `crf` SET `crf_token_status`='0'  WHERE crf_token='$token' ");
      }

  }
 







 
function clean_security($data){
 $data_ = array();
foreach ($data as $key => $value) {
     $value = (is_numeric(str_replace(',','',$value)))?str_replace(',','',$value):$value;
     $data_[sanitize($key)] = sanitize($value); 

}

return $data_;
}





?>
