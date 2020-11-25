<?php

require 'db_connector.php';



 function register($data){
// connect to the MySQL server
	  global $conn;

 	if(trim($data['password']) == '' || trim($data['username']) == '' || trim($data['company_name']) == ''){
 		die('all the fields are required !');
 	}
    $current_lang = sanitize_1($data['current_lang']);
 	$username = sanitize_1($data['username']);
 	$password = sanitize_1(enc_password_1($data['password']));
 	$password_plain = sanitize_1($data['password']);

    $company_name_db = str_replace(' ','_',strtolower("kunisii_".sanitize_1(str_replace("'", '', preg_replace('/[^a-zA-Z0-9\']/', '',$data['company_name'])))));

    $company_name = strtolower(str_replace("'", '', preg_replace('/[^a-zA-Z0-9\']/', '',$data['company_name'])));


 
// sql query with CREATE DATABASE
$sql = "CREATE DATABASE `$company_name_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";

// Performs the $sql query on the server to create the database
if ($conn->query($sql) === TRUE) {
		   // coppy folder 
 
	     shell_exec("mkdir ../../../$company_name; chmod 777 ../../../$company_name; cd ./../../$company_name; chmod 777 . ");
 	     
		 shell_exec("cp -r ../../../products/kunisii/* ../../../$company_name");
 


 		 $file = fopen("../../../$company_name/en/php_files/clasess/dataBase_class.php", "w");
			    fwrite($file, str_replace("geelayga","$company_name_db", file_get_contents("../../../$company_name/en/php_files/clasess/dataBase_class.php")));
			      fwrite($file, str_replace("geelayga","$company_name_db", file_get_contents("../../../$company_name/som/php_files/clasess/dataBase_class.php")));
		 fclose($file);

 
		 $conn->select_db("$company_name_db");

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
						mysqli_query($conn,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>'.$query.'</b></div>');
						$query= '';		
					}
				}
 

        // set settings and login 
        mysqli_query($conn,"update settings set current_lang='$current_lang',password='$password',username='$username',company_name='$company_name' pw_last_changed='".date('Y-m-d')."' ");


        // auto login
        include "../../../$company_name/en/php_files/clasess/dataBase_class.php";
        if_logged_in( array('username' =>"$username",'password' =>"$password_plain"));


        // redirect to his complany 
		$url = (isset($_SERVER['HTTPS']) ? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$url = str_replace('php_files/clasess/register.php',"$company_name", $url);
		echo '
		 <script  charset="utf-8" type="text/javascript"> 
		window.location.href = "'.$url.'";
		 </script>

		 ';



}
else {
 	echo 'sorry company name allready exists !';
}

$conn->close();



}
if(isset($_POST['data'])){
 	  echo register($_POST['data']);
}

?>

 