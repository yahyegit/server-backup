<?php
  require 'clasess/dataBase_class.php';
 
 
 if(isset($_POST['data'])){
	 	 if_logged_in('die'); 
		
		$table = sanitize($_POST['data']['table']);
		$id = sanitize($_POST['data']['id']);
 
 
		 
if($table == 'payments'){

		 $q = mysqli_query_("SELECT `amount`,`status`,`user_id` FROM `payments` where delete_status!='1' and id=$id");
		$qq = mysqli_fetch_assoc_($q);

		 

		if (trim($qq['status'])=='paid') {
			// if 'paid' don't update limits
		    mysqli_query_("update $table set delete_status='1' where id=$id");
		}else{
		 	 update_limit($qq['user_id'],$qq['amount'],'+');
		 	 mysqli_query_("update $table set delete_status='1' where id=$id");
		 
		}
		 

 }else if($table == 'limit_history'){
  
		 $q = mysqli_query_("SELECT `amount`,`user_id` FROM `limit_history` where delete_status!='1' and id=$id");
		$qq = mysqli_fetch_assoc_($q);


		 	update_limit($qq['user_id'],$qq['amount'],'-');
		 	mysqli_query_("update $table set delete_status='1' where id=$id");
		 
		  			
}else{
	  mysqli_query_("update $table set delete_status='1' where id=$id");
} 


echo 'ok';
	
 }
?>
