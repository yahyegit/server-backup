<?php 

    require 'dataBase_class.php';

// submited request handler
if(isset($_POST['data'])){
 	  echo if_logged_in($_POST['data']);
}

?>

