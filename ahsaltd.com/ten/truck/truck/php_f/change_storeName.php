 <?php
 
 require '../includes/inc_func.php';
 if(if_logged_in() != true){
die();
 }
 
 
 
 if(isset($_POST['storeName'])){
 $newEmail = sanitize(trim($_POST['storeName']));
 
  if(empty($newEmail)){
	     echo "Enter Store Name!!";
	 }else{
	 // update now 
	  $query_update_user = "UPDATE `adminSettings` SET `storeName`='$newEmail' ";
			 if(@mysql_query($query_update_user)){
			  
				echo '1'; 
			 }else{
			 echo 'Error Updating please try again  !!';
			 }
	 }
 
 
 
 }else{
 
 
 }
 
 
 
 
 ?>