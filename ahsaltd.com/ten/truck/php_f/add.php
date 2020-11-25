 <?php
  require '../includes/inc_func.php';
   if(if_logged_in() != true){
      die();
   }
 
  
 if(isset($_POST)){
	  
     add($_POST);


  }


?>