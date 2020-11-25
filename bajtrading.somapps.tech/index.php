<?php 




require 'en/w/php_files/clasess/dataBase_class.php';

 


$lang =   mysqli_result_(mysqli_query_("select current_lang from users where id=$current_user "),0); // result is folder name en or som
$lang = (empty($lang))?'en':$lang;
 
  header("location: $lang/");
 








?>
