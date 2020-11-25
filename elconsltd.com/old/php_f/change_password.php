<?php
 
 require '../includes/inc_func.php';
 if(if_logged_in() != true){
die();
 }
 
 if(isset($_POST['change_pass_new']) && isset($_POST['change_pass_current'])){
 
    $change_pass_new =  strtolower($_POST['change_pass_new']);
	      
    $change_pass_current =  strtolower($_POST['change_pass_current']);
			 $change_pass_current_ =  '4e25e'.md5(md5($change_pass_current.'!@#$#%^%^*(345/\,').'8b8b300300').'8b3'; 
			 
			 
 
  //  middle attack
     $cha = explode('.',$change_pass_new);
	if(count($cha) == 2){
	  $change_pass_new_ = explode('.',$change_pass_new);
	  $change_pass_new  = $change_pass_new_[1];
	}else{
	 exit('you have an  error please try again!');
	}
 
 
  if(strstr($change_pass_new,'.')){
  exit('Password can\'t contain dot or . !');
  }			
			 
 	 
			 
  if(checkPass($userId_activities,$change_pass_current_) == false){
	     echo 'incorrect Current Password';
	 }else{
	 // update now 
	   $change_pass_new_ =  '4e25e'.md5(md5($change_pass_new.'!@#$#%^%^*(345/\,').'8b8b300300').'8b3'; 
	  $query_update_user = "UPDATE users SET password='$change_pass_new_' WHERE user_id=$userId_activities";
			 if(@mysql_query($query_update_user)){
			   updateOtherUsers();
				echo 311; 
			 }else{
			 echo 'Error Updating please try again  !!';
			 }
	 }
 
 
 
 }else{
 
 
 }
 
 
 
 
 ?>