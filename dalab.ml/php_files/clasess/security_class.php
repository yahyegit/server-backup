<?php


function enc_password($pass){
  return md5(md5($pass.'!@#$%#twertwe%#$').'ASDFSDGF3#345$%8908#$').'1546/>][7987^^&)51';
}



// check login 
 function if_logged_in($type){   // check,check with die(), login,
 session_start();
       global $myDB;
        if(isset($_SESSION[$myDB])){
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
           mysqli_query_("UPDATE `crf` SET `crf_token_status`='0'  ");
      }

  }
 





 

function sanitize($value){
  return htmlentities(mysqli_real_escape_string_(str_replace("'",'',str_replace('"','',trim(str_replace('`','',str_replace("|",'', $value)))))));
}

 
function clean_security($data){
 $data_ = array();
foreach ($data as $key => $value) {
     $data_[sanitize($key)] = sanitize($value);	
}

return $data_;
}



function sanitize_other_query($value){ 
     $v = explode("'", $value);
     if(preg_match('/between/',strtolower($value))){
          return mysqli_real_escape_string_($v[0])."'".mysqli_real_escape_string_(str_replace('%', '',$v[1]))."' AND '".mysqli_real_escape_string_(str_replace('%', '',$v[3]))."'";
     }else{
          return mysqli_real_escape_string_($v[0])."'".mysqli_real_escape_string_($v[1])."'";
     }
}
 









?>