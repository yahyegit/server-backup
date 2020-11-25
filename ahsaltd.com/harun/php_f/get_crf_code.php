<?php

require '../includes/inc_func.php';
 
if(if_logged_in() != true){
	die('login');
 }
 
 
echo json_encode(array('date' => date('Y-m-d'), 'crf_code'=> get_unique_code('crf')));
 






 ?>