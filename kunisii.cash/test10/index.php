<?php
require 'en/php_files/clasess/dataBase_class.php';

$lang = mysqli_result_(mysqli_query_("select current_lang from settings limit 1"),0); // result is folder name en or som

header("location: $lang/");


?>
