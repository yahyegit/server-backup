 <?php
   include '../../clasess/db_connector.php';
 

 function get_page($data){ // y,m,d
     $id  = sanitize($data['id']);


    $count_it = number_format(mysqli_result_(mysqli_query_("SELECT COUNT(`id`) FROM items where remainings='0' and delete_status!='1' ",0)));
 
    $count_it_ = number_format(mysqli_result_(mysqli_query_("SELECT COUNT(`id`) FROM items where remainings<'5' and remainings!='0' and delete_status!='1' ",0)));
 


$daaa = ' <span style=" '.((empty($count_it))?'display:none;':'').'     background: #7c11a2 !important;padding: 5px;color: #fff;border-radius: 5em;padding-top: 1px;margin-bottom: 11px;font-size: 13px;/* font-weight:  ; */padding-bottom: 0px;dth: 20px; */  \" class=\"\"> '.$count_it.' </span>';
 
  $daaa_ = ' <span style=" '.((empty($count_it_))?'display:none;':'').'     background: #7c11a2 !important;padding: 5px;color: #fff;border-radius: 5em;padding-top: 1px;margin-bottom: 11px;font-size: 13px;/* font-weight:  ; */padding-bottom: 0px;dth: 20px; */  " class=\"\"> '.$count_it_.' </span>';   


$add_items_btn = "  <button  style=\"
    margin-left:  ; font-size: 13px;
\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"r_page('','','pages/forms/receive_items_form.php');\"  role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\"> Receive items   </span></button> 


<button  class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('','','pages/forms/sale_items.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-plus '></span><span class='ui-button-text'>Sale items  </span></button> 




";

$data = "

<div class='it'>  <ul>  <li> <a href='#all'> Items </a> </li><li> <a href='#finished'> Finished items $daaa </a> </li> 


<li> <a href='#afinished'> Items about to finish  $daaa_ </a> </li> 
</ul>


<div id='finished'>
 <p>
  $add_items_btn  </p>
 
 <table  class='table dataTable'  other_query=\" remainings='0' \"   table_file='php_files/pages/server-side-tables/items.php' ><thead> <tr> 
                 <th> Item  </th> <th>  Remainings </th><th> Price </th>  <th> Action </th> 
               </tr> </thead>
<tbody>
 </tbody></table>
 </div>


<div id='afinished'>
 <p>
 $add_items_btn  </p>
 
 <table  class='table dataTable'  other_query=\" remainings<'5' and remainings!='0' \"   table_file='php_files/pages/server-side-tables/items.php' ><thead> <tr> 
                 <th> Item  </th> <th>  Remainings </th><th> Price </th>  <th> Action </th> 
               </tr> </thead>
<tbody>
 </tbody></table>
 </div>











<div id='all'>
 
<p>
  $add_items_btn</p>
 
 
 <table  class='table dataTable'  other_query=\" \"   table_file='php_files/pages/server-side-tables/items.php' ><thead> <tr> 
							   <th> Item  </th> <th>  Remainings </th><th> Price </th>  <th> Action </th> 
							 </tr> </thead>
<tbody>
 </tbody></table>
 </div></div>




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
