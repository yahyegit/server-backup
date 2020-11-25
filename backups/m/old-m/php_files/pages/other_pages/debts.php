 <?php
   include '../../clasess/db_connector.php';
 

 function get_page($data){ // y,m,d
     $id  = sanitize($data['id']);
     global $ccc;
   $count = number_format(mysqli_result_(mysqli_query_("SELECT COUNT(`id`) FROM customers where current_balance!='0' and delete_status!='1' ",0)));

   $total =  $ccc.number_format(mysqli_result_(mysqli_query_("SELECT sum(`current_balance`) FROM customers where current_balance!='0' and delete_status!='1' ",0)),2);
  
 
 


$data = " 
<div id=' '>
 
 
 
<p class='title_' style=' a_'> ($count) customers in debt </p>

<p class='' > <label class=\"show_ float_label\" >Total   </label><span class='debt_color' > $total</span>    </p>

 <table  class='table dataTable'  style=' '  other_query=\" current_balance!='0'  \"   table_file='php_files/pages/server-side-tables/customers.php' ><thead> <tr> 
                 <th> name  </th> <th>  mobile </th><th> balance </th> <th> items </th>  <th> action </th> 
               </tr> </thead>
<tbody>
 </tbody></table>



<script type=\"text/javascript\">
      
 

</script>
 
 ";
 
return $data;
 
 }




 
 
if(isset($_POST['data'])){
    if_logged_in('die');
   echo get_page($_POST['data']);

}







?>
