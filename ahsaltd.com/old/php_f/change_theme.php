 <?php
 
 require '../includes/inc_func.php';
 if(if_logged_in() != true){
die();
 }
 
 
 
 
 if(isset($_POST['chosen_theme'])){
 $chosen_theme = sanitize(trim($_POST['chosen_theme']));
 
  if(!empty($chosen_theme)){
	 
	 // update now 
	  $query_update_user = "UPDATE users SET theme='$chosen_theme' WHERE user_id=$userId_activities ";
			 if(@mysql_query($query_update_user)){
			  
				echo 511; 
			 }else{
			 echo 'Error Updating please try again  !!';
			 }
	 }
 
 
 
 }else{
 
 
 }
 
 
 
 
 ?>