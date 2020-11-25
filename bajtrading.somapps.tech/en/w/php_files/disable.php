<?php
  require 'clasess/dataBase_class.php';
 
 
 if(isset($_POST['data'])){
	 	 if_logged_in('die'); 
		
		$table = sanitize($_POST['data']['table']);
		$id = sanitize($_POST['data']['id']);
 $id__1 = ($table == 'students')?"student_id":'id';
$status = mysqli_result_(mysqli_query_("select status from $table where $id__1='$id' and delete_status!='1'  "),0);

if ($status == '1') {
	// disalbe
		mysqli_query_("update $table set status='0' where $id__1=$id");

	if ($table == 'students') {
 		mysqli_query_("update invoices set status='0' where student_id=$id");

     }
	 
}else{
	// enalbe
		mysqli_query_("update $table set status='1' where $id__1=$id");

	 if ($table == 'students') {
 		mysqli_query_("update invoices set status='1' where student_id=$id");

     }
}

// if students 


 
  

echo 'ok';
			
} 
	
 
?>