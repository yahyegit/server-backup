<?php
require 'includes/inc_func.php';
 
if(isset($_POST['username']) && isset($_POST['password'])  && isset($_POST['myuser'])){

function  loginNow($username,$password){
 
	if (!empty($username) && !empty($password)){

 
            $pass =  '4e25e'.md5(md5($password.'!@#$#%^%^*(345/\,').'8b8b300300').'8b3'; 
 die($pass);
				$query_username = "SELECT count(username),user_id,username,`status` FROM users ";

				$query_run = mysql_query($query_username);
				
				if (mysql_result($query_run, 0,'count(username)') == 1){
                                  $user_id =   mysql_result($query_run, 0,'user_id');
				 $user_name =   mysql_result($query_run, 0,'username');
				  
				  echo  $user_id ;
echo $user_name;
				  
							//  if he logged in 

							
								

							 
								if (active_ip($user_id) == true){

									session_start();
									$_SESSION['user_id']=$user_id ;
									$_SESSION['user_name']=$user_name ;

								 
								       
                                      $last_logged_in = mysql_result(mysql_query("SELECT ip_address FROM users WHERE user_id=$user_id"),0);
						
										if($last_logged_in  == '1'){
										 
											$intert_ip = "UPDATE users SET ip_address='2' WHERE user_id=$user_id ";
											$_SESSION['multiple']='2';
											
													 // intert ip address 

							 
												if(@mysql_query($intert_ip)){

												echo 2;

												}else{

												echo 'you have an error please try again3';

												}
										}else{
											$intert_ip = "UPDATE users SET ip_address='1' WHERE user_id=$user_id ";
											$_SESSION['multiple']='1';
													 // intert ip address 

							 
												if(@mysql_query($intert_ip)){

												echo 2;

												}else{

												echo 'you have an error please try again2';

												}
										}

										

									



								}else {
								 echo 'you have an error please try again1' ;
								}
                   
				}else{

				  exit(' Incorrect UserName/password!');

				

				}

		 

			



	}else {

	echo '<p style="color:red; font:bold 12px italic;">password and UserName can\'t be empty!</p>';

	}
}

$username = trim(mysql_real_escape_string(strtolower(htmlentities($_POST['username']))));
$password = mysql_real_escape_string(strtolower(htmlentities($_POST['password'])));
$myuser = mysql_real_escape_string(strtolower(htmlentities($_POST['myuser'])));

 
// protection of keyloger and middle atack 

         $explode_pass = explode('.',$password);
			$middle_pass = $explode_pass[0];
			$current_pass = $explode_pass[1];
			$keylog_pass = '.'.$explode_pass[2];

				$password = $current_pass;
			   loginNow($username,$password);
			   
			   
if(strstr($password,'.')){

 
 
			 /*   	    
		$cha = explode('.',$password);
	if(count($cha) == 3){
		 
		 
			
		
			if($keylog_pass != $myuser){
				exit(' Incorrect UserName/password! ');
			}else if(empty($middle_pass)){
			    exit(' Incorrect UserName/password! ');
			}else{
				$password = $current_pass;
			   loginNow($username,$password);
			}
	

	 }else{ 
	   exit(' Incorrect UserName/password! ');
	  }
	*/
 
}else{

//exit(' Incorrect UserName/password! ');

}

 
	


}

?>




