 <?php
 
 require '../includes/inc_func.php';
 if(if_logged_in() != true){
die();
 }
 
 
 
 if(isset($_POST['dayName'])){
    $dayName = sanitize(trim($_POST['dayName']));
    $daysNames = array('sunday','monday','tuesday','wednesday','thursday','friday','saturday');
  if(!in_array($dayName,$daysNames)){
	     echo "Invalid DayName!!";
	 }else{

	 // update now 
			 if(@mysql_query("UPDATE `adminSettings` SET `total_days`='$dayName'")){
		 
				echo 1; 
			 }else{
			 echo 'Error Updating please try again  !!';
			 }
	 }
 
 
 
 }else{
 
 
 }
 
 
 
 
 ?>