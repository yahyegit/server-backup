 <?php
 require '../includes/inc_func.php';
 if(if_logged_in() != true){
die();
 }
 
 
 if(isset($_POST['newUsername'])){
 $find = '"';
$find2 = "'";
 
   $newUsername =   str_replace($find2,"",$_POST['newUsername']);
  $newUsername_ =  strtolower(sanitize( str_replace($find,"",$newUsername)));
 
 
 
	 // update now 
	  $query_update_user = "UPDATE users SET username='$newUsername_' WHERE user_id=$userId_activities ";
			 if(@mysql_query($query_update_user)){
	 
				echo '211'; 
			 }else{
			 echo 'Error Updating please try again  !!';
			 }
	  
 
 
 
 }else{
 
 
 }
 
 
 
 
 ?>