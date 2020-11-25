<?php

 error_reporting(0);



if(time() > strtotime('26-June-2020')){
  // enbale after 1 week 
}else{
  if(strtotime('17-June-2020') < time()){
            die("<p> tijaabadii way dhamaatay laxiriir WhatsApp ka  +25261-6311-168   </p>");

  }




}




//$debugging = false; 


$myServer = "localhost";
$myUser  ="phpmyadmin";
$myPass = '#qX@#$QQdgg/.<q]&Aa3$%^sDVEg8SyCDX##';


 
 function select_database_(){
  global  $myDB;
   session_start();

//print_r($_SESSION);
  if(!empty($_SESSION['db_name'])){
  $myDB = $_SESSION['db_name'];


  }else{
  $myDB = "lacagtayda_service";
  }
}
select_database_(); 
  // Try and connect to the database
$connection = mysqli_connect($myServer,$myUser,$myPass,$myDB);


  
 // If connection was not successful, handle the error

if($connection === false) {
     session_start();
  if(!empty($_SESSION['db_name'])){
      $myDB = str_replace('db','',strtolower($_SESSION['db_name']));
    }

    $connection = mysqli_connect($myServer,$myUser,$myPass,$myDB);

    if($connection === false) {
      die('database connection error ');
    }
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
  $value = str_replace("\\", '',$value);
  return htmlentities(mysqli_real_escape_string_(trim($value)));
}

 
 
function sanitize_other_query($value){ 
     $v = explode("'", $value);
     if(preg_match('/between/',strtolower($value))){
          return mysqli_real_escape_string_($v[0])."'".mysqli_real_escape_string_(str_replace('%', '',$v[1]))."' AND '".mysqli_real_escape_string_(str_replace('%', '',$v[3]))."'";
     }else{
          return mysqli_real_escape_string_($v[0])."'".mysqli_real_escape_string_($v[1])."'";
     }
}
  
function sanitize_other_query2($value){ 
        $allowed_values = array('customer_id=');
  if(!empty($value)){
         $v = explode("'", $value);
 
             if(in_array(trim($v[0]),$allowed_values)){
               return mysqli_real_escape_string_($v[0])."'".mysqli_real_escape_string_($v[1])."'";
             }else{
               return '';
             }
 
         }else{
          return $value;
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
 @session_start();
 function if_logged_in($type){
    // check,check with die(), login,
  //    $type = clean_security($type);

 //  session_start();
 //echo enc_password(sanitize($type['password'])); die();

        global $myDB;  
        global $connection;

       if(!empty($type['company_name'])){
           $connection->select_db('lacagtayda_'.sanitize(str_replace("'", '', preg_replace('/[^a-zA-Z0-9\']/', '',strtolower($type['company_name'])))));
        } 
        // auth
        if($type == 'logout'){
               session_destroy();
             return 'out_done';   
             die();
        }else if(isset($_SESSION) && !empty($_SESSION)){

              if(round(abs(time() - $_SESSION['last_action']) / 60,2) >= 18){ // auto logout if no action in 18 min
                session_destroy();
                return 'login';   
              }else{
                 $_SESSION['last_action'] = time();
                  return true;   
              }
        }else{
 
                   if(isset($type['username'])){  // authenticate now 
                            if(mysqli_result_(mysqli_query_("select count(username) from settings where password='".enc_password($type['password'])."' and username='".sanitize($type['username'])."'"),0) == '1'){
                              
                                    $_SESSION['last_action'] = time();
                                  $_SESSION['db_name'] =  sanitize('lacagtayda_'.sanitize(str_replace("'", '', preg_replace('/[^a-zA-Z0-9\']/', '',$type['company_name'])))); 


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
         mysqli_query_("INSERT INTO `crf`(crf_token, crf_token_status, expiration_date) VALUES ('$code','1','$expiration')");
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
