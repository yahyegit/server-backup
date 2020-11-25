 <?php
   include '../../clasess/db_connector.php';
 

 function delevered_history($data){ // y,m,d
       
         $name  = sanitize($data['delevered_by']);

      
$data = "<div class='reports_page'>

  <p class='title_' > all items deleverd by <b>$name</b></p>


 <table  class='table dataTable' other_query=\" delevered_by='$name' \" table_file='php_files/pages/server-side-tables/customer_items.php' > <thead> <tr> 
                 <th>    </th>  
               </tr> </thead> 
<tbody>
 </tbody></table> 


 ";
 
return $data;
 
 }




 
 
if(isset($_POST['data'])){
    if_logged_in('die');
   echo delevered_history($_POST['data']);

}







?>