<?php 
require 'dataBase_class.php';

// submited request handler
if(isset($_POST['data'])){
$company_name = strtolower(sanitize_1($_POST['data']['company_name']));
if(file_exists("../../$company_name/en/php_files/clasess/dataBase_class.php")){
			$conn->close();
	        include "../../$company_name/en/php_files/clasess/dataBase_class.php";
	        if_logged_in($_POST['data']);

        // redirect to his complany 
		$url = (isset($_SERVER['HTTPS']) ? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$url = str_replace('php_files/clasess/auth.php',"$company_name", $url);
		echo '
		 <script  charset="utf-8" type="text/javascript"> 
		window.location.href = "'.$url.'";
		 </script>

		 ';



	}else{
		exit("sorry your company name <strong> $company_name </strong> doesn't exist click register to add company ");
	}	 	  
}

?>

