<?php
 
$myServer_ = "mysqldb.kunisii.cash";
$myUser_ = "kunisii";  
$myPass_ = 'ssd[Vfs%^d456hfgKMa@tX[';
//$myDB = "_kunisii_demo";


$conn = new mysqli($myServer_, $myUser_, $myPass_);



$sql = "CREATE DATABASE `test_create_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";

// Performs the $sql query on the server to create the database
if ($conn->query($sql) === TRUE) {

echo 'done';
}



?>
