 <?php

 require '../includes/inc_func.php';

 $data_array = Array('type'=>$_POST['type'],'id'=>$_POST['id'],'tableName'=>$_POST['tableName']);
 
 echo load($data_array);   // type,tableName and id 


 
?>