 <?php
 
 require '../includes/inc_func.php';
 if(if_logged_in() != true){
die();
 }
  
 if(isset($_POST['storeName'])){
 $newEmail = sanitize(trim($_POST['storeName']));
 
  if(empty($newEmail)){
	     echo "Enter  Location !!";
	 }else{
	 // update now 
	  $query_update_user = "UPDATE `adminSettings` SET `storeLocation`='$newEmail' ";
			 if(@mysql_query($query_update_user)){
			   
				echo 1; 
			 }else{
			 echo 'Error Updating please try again  !!';
			 }
	 }
 
 
 
 }else{
 
 
 }
 
 
 
 
 ?>