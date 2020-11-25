<?php
require 'en/web/php_files/clasess/dataBase_class.php';


if(if_logged_in('')){
$lang = mysqli_result_(mysqli_query_("select current_lang from users where id=$current_user "),0); // result is folder name en or som

}else{
	$lang = 'en';
}
  $lang = (empty($lang))?'en':$lang;
 header("location: $lang/");


?>




