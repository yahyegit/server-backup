 <?php
 
 require '../includes/inc_func.php';
 if(if_logged_in() != true){
die();
 }
 
 
 if(isset($_POST['newMobileNumber'])){
 $mobile_number = sanitize(trim($_POST['newMobileNumber']));
 
  if(false){
	     echo "Invalid Mobile Number !";
	 }else{
	 // update now 
	  $query_update_user = "UPDATE users SET mobile_number='$mobile_number' WHERE user_id=$userId_activities ";
			 if(@mysql_query($query_update_user)){
			   
				echo 411; 
			 }else{
			 echo 'Error Updating please try again  !!';
			 }
	 }
 
 
 
 }else{
 
 
 }
 
 
 
 
 ?>
