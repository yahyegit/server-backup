<?php
 // sigle program but each user should have his own DB 

 
require 'db_connector.php';
 include 'service_class.php';



 function register($data){
// connect to the MySQL server
	 
	  global $connection;

 	if(trim($data['password']) == '' || trim($data['username']) == '' || trim($data['company_name']) == ''){
 		die('all the fields are required !');
 	}
    $current_lang = 'en';//sanitize($data['current_lang']);
 	$username = sanitize($data['username']);
 	$password = enc_password($data['password']);
 	$password_plain = sanitize($data['password']);

    $company_name =  sanitize(str_replace("'", '', preg_replace('/[^a-zA-Z0-9\']/', '',$data['company_name'])));

    $company_name_db = str_replace(' ','',strtolower("kunkeen_".$company_name));

   	 service_register($data);

// sql query with CREATE DATABASE
$sql = "CREATE DATABASE `$company_name_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";

// Performs the $sql query on the server to create the database
if ($connection->query($sql) === TRUE) {
		   // coppy folder 
  
 
		 $connection->select_db("$company_name_db");
  
        // import the sql file  
 
				$query = '';
				$sqlScript = file('kunisii_db.sql');
				foreach ($sqlScript as $line){
					
					$startWith = substr(trim($line), 0 ,2);
					$endWith = substr(trim($line), -1 ,1);
					
					if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
						continue;
					}
						
					$query = $query . $line;
					if ($endWith == ';') {
						mysqli_query($connection,$query);// or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>'.$query.'</b></div>');
						$query= '';		



						mysqli_query($connection,"update settings set current_lang='$current_lang',password='$password',username='$username',company_name='$company_name', pw_last_changed='".date('Y-m-d')."' ");// or mysqli_error($connection);
					}
				}
 
         // register to service db 

        file_put_contents('companies_list.txt', ','.$company_name,FILE_APPEND);

        // auto login
         echo if_logged_in( array('company_name'=>$company_name,'username' =>"$username",'password' =>"$password_plain"));


    

}
else {
 	echo 'sorry <b>'.$company_name.'</b> is allready Registered !';
}
	




}
if(isset($_POST['data'])){
 	  echo register($_POST['data']);
}

?>

 