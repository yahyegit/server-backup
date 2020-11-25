<?php
  require 'clasess/dataBase_class.php';

 
   if(if_logged_in('logout') == 'out_done'){

                $url = (isset($_SERVER['HTTPS']) ? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $url = str_replace('php_files/logout.php','index.php', $url);

                echo '
                 <script  charset="utf-8" type="text/javascript"> 
                window.location.href = "'.$url.'";
                 </script>

                 ';
   }

?>


