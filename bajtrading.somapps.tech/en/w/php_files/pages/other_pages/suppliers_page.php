<?php
   include '../../clasess/db_connector.php';
 

 function get_page($data){ // y,m,d
     $id  = sanitize($data['id']);
     global $ccc;
   $count = number_format(mysqli_result_(mysqli_query_("SELECT COUNT(`id`) FROM suppliers where  delete_status!='1' ",0)));

   $total =  $ccc.number_format(mysqli_result_(mysqli_query_("SELECT sum(`current_balance`) FROM suppliers where current_balance!='0' and delete_status!='1' ",0)),2);
  
 
 
   $recieve_items = "<button  class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('','','pages/forms/receive_items_form.php');\" role='button' aria-disabled='false' style=' display:inline;  margin-left:30px '><span class='ui-button-icon-primary ui-icon ui-icon-plus '></span><span class='ui-button-text'> Receive items </span></button> ";


$data = " 
<div id=' '>
 
 
 
<p class='title_' style=' a_'> ($count) Suppliers </p>

<p class='' > <label class=\"show_ float_label\" >Total debts  </label><span class='debt_color' > $total</span>    </p>
$recieve_items
 <table  class='table dataTable'  style=' '  other_query=\" \"   table_file='php_files/pages/server-side-tables/suppliers.php' ><thead> <tr> 
                 <th> name  </th> <th>  mobile </th><th> balance </th> <th> more </th> <th> Action</th>  
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
