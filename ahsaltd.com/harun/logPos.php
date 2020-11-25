 
<?php
 
require 'includes/inc_func.php';
 


function  loginNow($username,$password){
 
	if (!empty($username) && !empty($password)){

 
            $pass =  '4e25e'.md5(md5($password.'!@#$#%^%^*(345/\,').'8b8b300300').'8b3'; 
   			 
				if ( mysql_result(mysql_query("SELECT count(id) FROM settings WHERE username='$username' and password='$pass' "), 0) == 1){
                 
									session_start();
							$_SESSION['user_id']= mysql_result(mysql_query("SELECT id FROM settings WHERE username='$username' and password='$pass' "),0);
							$_SESSION['user_name']=$username;
									echo 1;
							 
				}else{ 
				  exit(' Incorrect UserName or password!');
				}



	}else {

	echo '<p style="color:red; font:bold 12px italic;">password and UserName can\'t be empty!</p>';

	}
}

if(isset($_POST['username']) && isset($_POST['password'])){

$username = trim(mysql_real_escape_string(strtolower(htmlentities($_POST['username']))));
$password = mysql_real_escape_string(strtolower(htmlentities($_POST['password'])));
$myuser = mysql_real_escape_string(strtolower(htmlentities($_POST['myuser'])));

 loginNow($username,$password);


}

?>




