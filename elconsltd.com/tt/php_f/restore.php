<?php
  require '../includes/inc_func.php';
   if(if_logged_in() != true){
      die();
   }
 
  
 if(isset($_POST)){
	$data =  array('id'=>$_POST['id'],'tableName'=>$_POST['tableName'],'id_coll_Name'=>$_POST['id_coll_name']);
	restore($data);
  }


?>