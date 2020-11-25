<?php
 include 'db_connector.php';
 

// submited request handler
 
 if(isset($_POST))
        {
            if_logged_in('die');

            mysqli_query_("update settings set ads_image='' "); 
        }
 ?>