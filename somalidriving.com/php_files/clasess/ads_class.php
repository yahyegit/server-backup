<?php
 include 'db_connector.php';
 

// submited request handler
 
 if(isset($_POST))
        {

            if_logged_in('die');

            $location = 'http://' . $_SERVER['HTTP_HOST'];

        // Posted Values
        $imgfile = $_FILES["ads_image"]["name"];
        // get the image extension
        $extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
        // allowed extensions
        $allowed_extensions = array(".jpg","jpeg",".png",".gif");

        // Validation for allowed extensions .in_array() function searches an array for a specific value.
        if(!in_array($extension,$allowed_extensions))
        {

        //    echo "<script>alert('   Invalid format. Only jpg / jpeg/ png /gif format allowed');  window.location.href='$location'; </script>";
       
            mysqli_query_("update settings set  ads_text='".sanitize($_POST['ads_text'])."'  "); 
            echo  " 
            <html>
            <head>
             <title></title>
             <script type='text/javascript'>window.location.href='$location'; </script>
            </head>
            <body>
            
            
            </body>
            </html>";
        }else{
            //rename the image file
            $imgnewfile=md5($imgfile).'.'.$extension;
 
            // Code for move image into directory
           move_uploaded_file($_FILES["ads_image"]["tmp_name"],"../../css/images/".$imgnewfile);
            // Query for insertion data into database

            mysqli_query_("update settings set ads_image='$imgnewfile', ads_text='".sanitize($_POST['ads_text'])."'  "); 
  

     //     echo "update settings set ads_image='$imgnewfile', ads_text='".sanitize($_POST['ads_text'])."'  "; die(); 
  
                        echo  " 
<html>
<head>
 <title></title>
 <script type='text/javascript'>window.location.href='$location'; </script>
</head>
<body>


</body>
</html>";

        
        }
}
 ?>





