<?php
 include 'db_connector.php';
 // require 'extra_functions.php';
 

function approve_toggle($data){
  	 
    mysqli_query_("update students set active='".sanitize($data['active'])."'  where id='".sanitize($data['id'])."'  "); 
 
	  					return 'ok';
					 
						
	 

                    
		
}



// submited request handler
if(isset($_POST)){    
	 if_logged_in('die');
	  echo approve_toggle($_POST['data']);
}

?>





