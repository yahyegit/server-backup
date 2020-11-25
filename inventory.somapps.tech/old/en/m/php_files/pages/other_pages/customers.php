 <?php
   include '../../clasess/db_connector.php';
 

 function get_page($data){ // y,m,d
     $id  = sanitize($data['id']);

   $count = number_format(mysqli_result_(mysqli_query_("SELECT COUNT(`id`) FROM customers where     delete_status!='1' ",0)));

   $total =  number_format(mysqli_result_(mysqli_query_("SELECT sum(`current_balance`) FROM customers where    delete_status!='1' ",0)),2);
  
 
 $da = '';
 
 $da_ = '';


$data = " 
<div id=' '>
 

 <button  class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('','','pages/forms/edit_customer.php');\" role='button' aria-disabled='false' style='  display:inline;/* float:left; */margin-bottom: -104px;position:;right:;  ' ><span class='ui-button-icon-primary ui-icon ui-icon-plus '></span><span class='ui-button-text'>macmiil kudar  </span></button> 




<p class='title_' style='$da_     text-align: right;'>




 


 ($count) macaamiil </p>
 
 <table  class='table dataTable'  style='$da'  other_query=\" customer_name!='' \"   table_file='php_files/pages/server-side-tables/customers.php' ><thead> <tr> 
                 <th>   </th>  
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
