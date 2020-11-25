<?php
  require 'clasess/dataBase_class.php';
 
 
 if(isset($_POST['data'])){
	 	 if_logged_in('die'); 
		
		$table = sanitize($_POST['data']['table']);
		$id = sanitize($_POST['data']['id']);
  $id__1 = ($table == 'students')?"student_id":'id';

			// just delete the row 
			mysqli_query_("update $table set delete_status='1' where $id__1=$id");
		 
			if($table == 'students'){
				// also delete payments, invoices for the student 
mysqli_query_("update payments set delete_status='1' where student_id=$id");
mysqli_query_("update invoices set delete_status='1' where student_id=$id");

mysqli_query_("update student_subjects set delete_status='1' where student_id=$id");




			}
  

echo 'ok';
			
} 
	
 
?>
