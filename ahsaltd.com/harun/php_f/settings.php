<?php

require '../includes/inc_func.php';
 
if(if_logged_in() != true){
	die('login');
 }

  	 
// settings 
$settings = array(
		'status' => 'settings',
		'username' => mysql_result(mysql_query("select username from settings limit 1"),0),
	 	'password' => '*******',
		'companyName' =>  mysql_result(mysql_query("select company_name from settings limit 1"),0),
		'companyMobile' =>  mysql_result(mysql_query("select company_mobile from settings limit 1"),0),
		'companyAddress' =>  mysql_result(mysql_query("select company_address from settings limit 1"),0),
		'companyEmail' =>  mysql_result(mysql_query("select company_email from settings limit 1"),0),
		'currency' =>  mysql_result(mysql_query("select currency from currency where status='1'"),0),
		 
);

echo json_encode($settings);



?>