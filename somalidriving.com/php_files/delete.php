<?php
  require 'clasess/dataBase_class.php';
 
 
 if(isset($_POST['data'])){
	 	 if_logged_in('die'); 
		
		$table = sanitize($_POST['data']['table']);
		$id = sanitize($_POST['data']['id']);
 
			// just delete the row 
			mysqli_query_("update $table set delete_status='1' where id=$id");
 
echo 'ok';
			
} 
	
 
?>
