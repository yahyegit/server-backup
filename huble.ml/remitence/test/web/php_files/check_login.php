<?php
  require 'clasess/dataBase_class.php';
 
 
 if(isset($_POST)){
	 	 if(!if_logged_in('')){
	 	 	echo 'login';

	 	 }else{
	 	 	echo 'active';
	 	 } 
		
}


?>
