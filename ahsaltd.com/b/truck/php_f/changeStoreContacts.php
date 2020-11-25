 <?php
 
 require '../includes/inc_func.php';
 if(if_logged_in() != true){
die();
 }
 
 
 
 if(isset($_POST['contacts'])){
 $contacts = sanitize(trim($_POST['contacts']));
 //echo $contacts;
  if(empty($contacts)){
	     echo "Error Enter store contacts !!";
	 }else{
	 // update now 
	  $query_update_user = "UPDATE `storeNumber` SET `number`='$contacts' ";
			 if(@mysql_query($query_update_user)){
			   
				echo 1; 
			 }else{
			 echo 'Error Updating please try again  !!';
			 }
	 }
 
 
 
 }else{
 
 
 }
 
 
 
 
 ?>