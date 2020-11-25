<?php
  require 'clasess/dataBase_class.php';
 
 
 if(isset($_POST)){
	 	 if(!if_logged_in('i')){
	 	 	echo 'login';

	 	 }else{
	 	 	echo 'active';
	 	 } 
		
}


?>
