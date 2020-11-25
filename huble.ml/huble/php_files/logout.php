<?php
  require 'clasess/dataBase_class.php';

 
    if_logged_in('die');
    session_destroy();
    echo 'login';
  	 


?>


