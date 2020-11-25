 <?php
   include '../../clasess/db_connector.php';
 

 function get_page($data){ // y,m,d
     $id  = sanitize($data['id']);


    $count_it = number_format(mysqli_result_(mysqli_query_("SELECT COUNT(`id`) FROM items where remainings='0' and delete_status!='1' ",0)));
 
$daaa = ' <span style=" '.((empty($count_it))?'display:none;':'').'  background: blue;padding: 2px;color: #fff;border-radius: 3em;font-size: 14px;/* font-weight: bold; *//* width: 20px; */ " class=\"\"> '.$count_it.' </span>';
 
    $count_af = number_format(mysqli_result_(mysqli_query_("SELECT COUNT(`id`) FROM items where remainings=<'5' and delete_status!='1' ",0)));
 

$daaaf = ' <span style=" '.((empty($count_af))?'display:none;':'').'  background: blue;padding: 2px;color: #fff;border-radius: 3em;font-size: 14px;    background: #7c11a2 !important;padding: 5px;color: #fff;border-radius: 5em;padding-top: 1px;margin-bottom: 11px;font-size: 13px;/* font-weight:  ; */padding-bottom: 0px;dth: 20px; */ /* font-weight: bold; *//* width: 20px; */ " class=\"\"> '.$count_af.' </span>';
$add_items_btn = "  <button  style=\"
    margin-left:  ; font-size: 13px;
\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"r_page('','','pages/forms/receive_items_form.php');\"  role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\"> alaab kudar   </span></button> 

 



";
      
$data = "

<div>

<p class='title_'> alaabta </p>


<p>
 $add_items_btn   </p>
 
 
 <table  class='table dataTable'  other_query=\" \"   table_file='php_files/pages/server-side-tables/items.php' ><thead> <tr> 
                 <th>    </th>  
               </tr> </thead>
<tbody>
 </tbody></table>


   


  <p class='title_'> alaabta dhamaanrabta  ($count_af) </p> 
<p>
 $add_items_btn </p>
 
 <table  class='table dataTable'  other_query=\" remainings<'5' \"   table_file='php_files/pages/server-side-tables/items.php' ><thead> <tr> 
                 <th>    </th>   
               </tr> </thead>
<tbody>
 </tbody></table>

 
  <p class='title_'>alaabta dhamaatay  ($count_it) </p> 

 <p>
 $add_items_btn  </p>
 
 <table  class='table dataTable'  other_query=\" remainings='0' \"   table_file='php_files/pages/server-side-tables/items.php' ><thead> <tr> 
                 <th>    </th>   
               </tr> </thead>
<tbody>
 </tbody></table>
 
 


 <div>




<script type=\"text/javascript\">
      
 
 
    $( \".it\" ).tabs();


 


</script>
 
 ";
 
return $data;
 
 }




 
 
if(isset($_POST['data'])){
    if_logged_in('die');
   echo get_page($_POST['data']);

}







?>
