 <?php
   include '../../clasess/db_connector.php';
 

 function get_page($data){ // y,m,d
     $id  = sanitize($data['id']);


    $count_it = number_format(mysqli_result_(mysqli_query_("SELECT COUNT(`id`) FROM items where remainings='0' and delete_status!='1' ",0)));
 
$daaa = ' <span style=" '.((empty($count_it))?'display:none;':'').'  background: blue;padding: 2px;color: #fff;border-radius: 3em;font-size: 14px;/* font-weight: bold; *//* width: 20px; */ " class=\"\"> '.$count_it.' </span>';
 
      
$data = "

<div class='it'>  <ul>  <li> <a href='#all'>all items </a> </li><li> <a href='#finished'>finished items  $daaa </a> </li> </ul>


<div id='finished'>
 <p>
   <button  style=\"
    margin-left:  ; font-size: 13px;
\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"r_page('','','pages/forms/receive_items_form.php');\"  role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\"> receive items  </span></button>  </p>
 
 <table  class='table dataTable'  other_query=\" remainings='0' \"   table_file='php_files/pages/server-side-tables/items.php' ><thead> <tr> 
                 <th> item  </th> <th>  remainings </th><th> price </th>  <th> action </th> 
               </tr> </thead>
<tbody>
 </tbody></table>
 </div>

<div id='all'>
 
<p>
   <button  style=\"
    margin-left:  ; font-size: 13px;
\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"r_page('','','pages/forms/receive_items_form.php');\"  role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\"> receive items  </span></button>  </p>
 
 
 <table  class='table dataTable'  other_query=\" \"   table_file='php_files/pages/server-side-tables/items.php' ><thead> <tr> 
							   <th> item  </th> <th>  remainings </th><th> price </th>  <th> action </th> 
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
