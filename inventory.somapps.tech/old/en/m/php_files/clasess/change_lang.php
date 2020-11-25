
<?php 
     include 'db_connector.php';
 
 
 

// submited 

   
 
 if(isset($_POST['data'])){
    if_logged_in('die');
   // echo 'posted';print_r($_POST['data']);
$lang = mysqli_result_(mysqli_query_("select current_lang from users where id=$current_user "),0); // result is folder name en or som

if ($lang == 'en') {
  $l = 'som';
}else{
  $l = 'en';
}

mysqli_query_("update users set current_lang='$l' where id='$current_user' ");
 $location = 'https://' . $_SERVER['HTTP_HOST'];

                        echo "<!DOCTYPE html>
<html>
<head>
  <title></title>
  <script type='text/javascript'>window.location.href='$location' </script>
</head>
<body>

</body>
</html>";
 }




 

 


?>
