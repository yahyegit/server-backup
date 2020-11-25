 <?php
   include '../../clasess/db_connector.php';
 

 function get_limit_history($data){ // y,m,d
  global $ccc;
     $id  = sanitize($data['id']);
      $rsi = mysqli_query_("select id,item_name,remainings,price,remaining_cost from items where id='$id' and delete_status!='1'");

       $aRow = mysqli_fetch_assoc_($rsi);
 
  if (empty($aRow['id'])) {
    exit('login');
  }
 
$item_name = " {$aRow['item_name']}   ";
 
$remainings = number_format($aRow['remainings'])."  <span class='gray'> oo kuugu fadhiya </span>$ccc.".number_format($aRow['remaining_cost'],2)."   <button  class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('',{id:{$aRow['id']} },'pages/forms/receive_items_form.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-plus '></span><span class='ui-button-text'></span></button>  ";


$price = $ccc.number_format($aRow['price'],2)." <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['id']},'edit_customer_info_form','pages/forms/change_price_form.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>change</span></button>  ";
 

 
 $action = " <div  class='hide_for_print' style='
    
    margin: 0px !important;
     
'> <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['id']},'edit_customer_info_form','pages/forms/change_price_form.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit item </span></button>    <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'items',id:{$aRow['id']},msg:'Deleting {$aRow['item_name']} ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete item </span></button> </div>";
 




$data = "<div class='reports_page'>
 







 <table  class='table  '  ><thead> <tr> 
                 <th> item  </th> <th>  remainings </th><th> price </th>  <th> action </th> 
               </tr> </thead>
<tbody>

<tr>


<td> $item_name </td>

<td>

$remainings


</td>
<td>

$price


</td> 
<td>

$action


</td>

 </tr>
 </tbody></table>


<p class='title_'> received history for <b>{$aRow['item_name']}</b> </p>

   <p><button  style=\"
    margin-left:  ; font-size: 13px;
\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"r_page('',{id:{$aRow['id']} },'pages/forms/receive_items_form.php');\"  role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\"> receive items  </span></button></p>
 
  
 <table  class='table dataTable'  other_query=\"item_name='{$aRow['item_name']}' \"   table_file='php_files/pages/server-side-tables/received_history.php' ><thead> <tr> 
							   <th> item </th> <th> quantity </th>   <th> cost </th>  <th> Date </th> <th> description </th>  <th> action </th> 
							 </tr> </thead>
<tbody>
 </tbody></table>
 
 
 ";
 
return $data;
 
 }




 
 
if(isset($_POST['data'])){
    if_logged_in('die');
   echo get_limit_history($_POST['data']);

}







?>
