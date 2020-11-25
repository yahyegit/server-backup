
<?php



require 'connet.php';





if(isset($_POST['username']) && isset($_POST['password'])  && isset($_POST['myuser'])){

function  loginNow($username,$password){
 
  if (!empty($username) && !empty($password)){


 
      $pass =  md5($password.'!@%#$').'b4f9c8c51';
//echo $pass;die();
        $query_username = "SELECT count(username_e) FROM login_in WHERE username_e='$username' and password_w='$pass'";

        $query_run = mysql_query($query_username);

        if (mysql_result($query_run, 0) == 1){

              //  if he logged in 

                session_start();

                $_SESSION['user_id_342ahsa']=$username;

                

                @$http_client_ip = $_SERVER['HTTP_CLIENT_IP'];

                @$http_X_forwarded_for = $_SERVER['HTTP_X_FORWARDED_FOR'];

                $remote_addr = $_SERVER['REMOTE_ADDR'];



                $query_chack = "SELECT active_ip, ip_address  FROM login_in";



              

            

                    

                if(@$query_run = mysql_query($query_chack)){

                      $active_ip = mysql_result($query_run,0,'active_ip');

                       

                

                if ($active_ip == 1){

                

                  // grup his ip address

                    if(!empty($http_client_ip)){

                      $ip_address_ = $http_client_ip ;

                    }else if (!empty($http_X_forwarded_for)) {

                      $ip_address_ = $$http_X_forwarded_for; 

                    }else {

                      $ip_address_ = $remote_addr;

                    }

                    

                    $intert_ip = "UPDATE login_in SET ip_address='$ip_address_'";

                       // intert ip address 

                      

                        if(@mysql_query($intert_ip)){

                        echo 2;

                        }else{

                        echo 'you have an error please try again';

                        }



                }else if ($active_ip == 0){

                    // you are multi user 

                    echo 2;

                }



                

                

                

                }else {

                echo 'you have an error please try again';

                }

          

        }else{

        echo '<p style="color:red; font:bold 12px italic;">Incorrect username/password!</p>';

         

        }

     

      



  }else {

  echo '<p style="color:red; font:bold 12px italic;">password and username can\'t be empty!</p>';

  }
}

$username = trim(mysql_real_escape_string(strtolower(htmlentities($_POST['username']))));
$password = mysql_real_escape_string(strtolower(htmlentities($_POST['password'])));
$myuser = mysql_real_escape_string(strtolower(htmlentities($_POST['myuser'])));





// protection of keyloger and middle atack 
  loginNow($username,$password);
/*
if(strstr($password,'.')){

 
   
    $cha = explode('.',$password);
  if(count($cha) == 3){
     
     
      $explode_pass = explode('.',$password);
      $middle_pass = $explode_pass[0];
      $current_pass = $explode_pass[1];
      $keylog_pass = '.'.$explode_pass[2];

      if($keylog_pass != $myuser){
        exit('<p style="color:red; font:bold 12px italic;">Incorrect username/password!</p>');
      }else if(empty($middle_pass)){
        exit('<p style="color:red; font:bold 12px italic;">Incorrect username/password!</p>');
      }else{
        $password = $current_pass;
       
      }
    

   }else if(count($cha) == 2) {
  
    $explode_pass = explode('.',$password);
    $middle_pass = $explode_pass[0];
    $current_pass = $explode_pass[1]; 

    if(empty($middle_pass)){
    exit('<p style="color:red; font:bold 12px italic;">Incorrect username/password!</p>');
    }else{
    $password = $current_pass;
          loginNow($username,$password);
    }
  
    }else{
      exit('<p style="color:red; font:bold 12px italic;">Incorrect username/password!</p>');
    }



}else{

exit('<p style="color:red; font:bold 12px italic;">Incorrect username/password!</p>');

}
*/
 
  


}

?>



