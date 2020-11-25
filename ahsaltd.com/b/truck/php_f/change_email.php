 <?php
 
 require '../includes/inc_func.php';
 if(if_logged_in() != true){
die();
 }
 
 
 
 if(isset($_POST['newEmail'])){
 $newEmail = sanitize(trim($_POST['newEmail']));
  $password_ = trim($_POST['password_']);
 
  if(empty($newEmail)){
	     echo "Invalid Email Address !!";
	 }else{
	 // update now 
	 
	 $pass = (empty($password_))?"":",`password`='$password_'";
	 
	 
	  $query_update_user = "UPDATE `adminSettings` SET `email`='$newEmail' $pass";
			 if(@mysql_query($query_update_user)){
			  
				echo 1; 
			 }else{
			 echo 'Error Updating please try again  !!';
			 }
	 }
 
 
 
 }else{
 
 
 }
 
 
 
 
 ?>