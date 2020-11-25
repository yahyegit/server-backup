<?php
// error_reporting(0);

 

 $debugging = false; 

 date_default_timezone_set('africa/nairobi');
$myServer_ = "mysqldb.kunisii.cash";
$myUser_ = "kunisii";  
$myPass_ = 'ssd[Vfs%^d456hfgKMa@tX[';

$conn = new mysqli($myServer_, $myUser_, $myPass_);

 
function mysqli_real_escape_string_($data){
          global $conn;
    return mysqli_real_escape_string($conn,$data);
}

 
function sanitize_1($value){

  return htmlentities(mysqli_real_escape_string_(str_replace("'",'',str_replace('"','',trim(str_replace('`','',str_replace("|",'', $value)))))));
}

 
function enc_password_1($pass){
  return md5(md5($pass.'!@#$%#twertwe%#$').'ASDFSDGF3#345$%8908#$').'1546/>][7987^^&)51';
}


 
 
?>