<?php
  error_reporting(0);
 //$debugging = true; 



 date_default_timezone_set('africa/nairobi');
// ssdVfsa@tX[]#O$#%^dq[9n1$|

$myServer = "localhost";
$myUser  ="phpmyadmin";
$myPass = '#qX@#$QQdgg/.<q]&Aa3$%^sDVEg8SyCDX##';
$myDB = "remittance_galayrexpress"; 




/* 
  function select_database_(){
  global  $myDB;
   session_start();
  if(!empty($_SESSION['db_name'])){
  $myDB = $_SESSION['db_name'];
  }else{
  $myDB = "remittance_service";
  }
}
select_database_();  */
  // Try and connect to the database
$connection = mysqli_connect($myServer,$myUser,$myPass,$myDB);


  
 // If connection was not successful, handle the error

if($connection === false) {
     session_start();
  if(!empty($_SESSION['db_name'])){
      $myDB = str_replace('DB','',strtolower($_SESSION['db_name']));
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

 
 
 function sanitize_other_query($val)
 {
  return sanitize_other_query_3($val);
 }
  
function sanitize_other_query_3($value){ 
  return $value;
   if(!empty($value)){
         $v = explode("'", $value);
                return mysqli_real_escape_string_($v[0])."'".mysqli_real_escape_string_($v[1])."'";
            
 
         }else{
          return $value;
         }

     
}
 

 function user_exists($username,$id)
{

    $g = mysqli_result_(mysqli_query_("select count(id) from users where id!='$id' and username='$username' and delete_status!='1'  "),0);

    if ($g != '0') {
       return true; // exisits 
    }else{
      return false;
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




$current_user = '';

function is_admin($current_user){
global $current_user;
   if (trim(mysqli_result_(mysqli_query_("select type from users where id='$current_user' "),0)) == 'admin'){
    return true;
  }else{
    return false;
  }

}
// check login 
 @session_start();
 function if_logged_in($type){
  global $current_user;
     // check,check with die(), login,
  //    $type = clean_security($type);
 //  session_start();
//echo enc_password(sanitize($type['password'])); die();
 
        global $myDB;  
        global $connection;

 /*       if(!empty($type['company_name'])){
           $connection->select_db('remittance_'.sanitize(str_replace("'", '', preg_replace('/[^a-zA-Z0-9\']/', '',strtolower($type['company_name'])))));
        }*/ 
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

                   if(mysqli_result_(mysqli_query_("select count(username) from users where id='{$_SESSION['user_id']}' and delete_status!='1' and status='1' "),0) == '1'){
                           $_SESSION['last_action'] = time();
                           $current_user = $_SESSION['user_id'];
                              return true; 
                    }else{
 
                         session_destroy();
                         return 'login';   
                    }
  
              }
        }else{
 
                   if(isset($type['username'])){  // authenticate now 
                            if(mysqli_result_(mysqli_query_("select count(username) from users where password='".enc_password($type['password'])."' and username='".sanitize($type['username'])."' and delete_status!='1' and status='1' "),0) == '1'){
                              
                                 $_SESSION['last_action'] = time();
                                // $_SESSION['db_name'] =  sanitize('remittance_'.sanitize(str_replace("'", '', preg_replace('/[^a-zA-Z0-9\']/', '',$type['company_name'])))); 
 
                           
                                $current_user = mysqli_result_(mysqli_query_("select id from users where password='".enc_password($type['password'])."' and username='".sanitize($type['username'])."' and delete_status!='1' and status='1' "),0);
                                 $_SESSION['user_id'] = $current_user;

 $location = 'https://' . $_SERVER['HTTP_HOST'];

if ($location =='https://localhost') {
$location = '';
}
                                  sleep(3);
                        return "<!DOCTYPE html>
<html>
<head>
  <title></title>
  <script type='text/javascript'>window.location.href='$location' </script>
</head>
<body>

</body>
</html>";
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

 
 function update_limit($user,$amount,$type){
        $user = sanitize($user);
        $remain_limit = mysqli_result_(mysqli_query_("select current_remaining_limit from users where id=$user "),0);
          
  if (trim($type) == '-') {
 
          $new_r = $remain_limit - $amount;
          $new_r = (preg_match('/-/',$new_r))?0:$new_r;

          mysqli_query_("UPDATE users SET current_remaining_limit='$new_r'   WHERE id=$user "); 
  
  }else if (trim($type) == '+') { 
 
          $new_r = $remain_limit + $amount;
          $new_r = (preg_match('/-/',$new_r))?0:$new_r;

          mysqli_query_("UPDATE users SET current_remaining_limit='$new_r'   WHERE id=$user "); 
 
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

 
 


 

function get_autoComplate($query,$key){

 $avai = array();
 $q = mysqli_query_($query);
while ($qq = mysqli_fetch_assoc_($q)) {
$avai[] = $qq[$key];

}

return json_encode($avai);
}
 
 
 

?>
