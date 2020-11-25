<?php
 include 'db_connector.php';
 if_logged_in('die');

 mysqli_query_("update settings set current_lang='".sanitize($_POST['data']['lang'])."'");

$url = (isset($_SERVER['HTTPS']) ? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url = str_replace('php_files/clasess/change_lang.php','', $url);

echo '
 <script  charset="utf-8" type="text/javascript"> 
window.location.href = "'.$url.'../";
 </script>

 ';









?>