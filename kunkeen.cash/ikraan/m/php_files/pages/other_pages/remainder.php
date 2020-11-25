 <?php
   include '../../clasess/db_connector.php';
 

 function get_page($data){ // y,m,d
  global $current_user;
     $id  = sanitize($data['id']);
global $ccc;
   $count = number_format(mysqli_result_(mysqli_query_("SELECT COUNT(`id`) FROM customers where current_balance!='0' and  last_date<='".date('Y-m-d',strtotime("-2 weeks"))."' and delete_status!='1' ",0)));

   $total =  $ccc.number_format(mysqli_result_(mysqli_query_("SELECT sum(`current_balance`) FROM customers where current_balance!='0' and  last_date<='".date('Y-m-d',strtotime("-2 weeks"))."' and delete_status!='1' ",0)),2);


    $count_it = number_format(mysqli_result_(mysqli_query_("SELECT COUNT(`id`) FROM items where remainings='0' and delete_status!='1' ",0)));
 
 $da = (empty($count))?'display: ':'';
 $da_ = (empty($count_it))?'display: ':'';

$duu = str_replace(',','',$count_it)+ str_replace(',','',$count);
 


$daaa = ' <span style=" '.((empty($duu))?'display:none;':'').'  background: blue;padding: 2px;color: #fff;border-radius: 3em;font-size: 14px;/* font-weight:  ; *//* width: 20px; */ \" > '.number_format($duu).' </span>';
  if (is_admin($current_user)) {
        $recieve_items = "<button  class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('','','pages/forms/receive_items_form.php');\" role='button' aria-disabled='false' style=' display:inline;  margin-left:  '><span class='ui-button-icon-primary ui-icon ui-icon-plus '></span><span class='ui-button-text'>Recieve items </span></button> ";
 
 }else{
        $recieve_items = " ";
 
 }


$data = " 
<div id=' '>
 
<p class=' ' style='margin-bottom: 30px !important;'>
<button  class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('','','pages/forms/sale_items.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-plus '></span><span class='ui-button-text'>Make sale </span></button> 


$recieve_items


<button  class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('','','pages/forms/expense_form.php');\" role='button' aria-disabled='false' style=' display:inline;  margin-left: '><span class='ui-button-icon-primary ui-icon ui-icon-plus '></span><span class='ui-button-text'>Add Expense </span></button> 



</p>






 <p class='title_' style='  $da'> macaamisha lacagaha kudaaheen waa ($count) </p>
 

<p class='' style='  $da'> <label class=\"show_ float_label\" >Total   </label><span class='debt_color' >  $total</span>     </p>

 <table  class='table dataTable'  style='$da'  other_query=\"   current_balance!='0' and  last_date<='".date('Y-m-d',strtotime("-2 weeks"))."' \"   table_file='php_files/pages/server-side-tables/customers.php' ><thead> <tr> 
                 <th>    </th> 
               </tr> </thead>
<tbody>
 </tbody></table>

 
<br><br><br>

<p class='title_' style='$da_'> ($count_it) finished items  </p>
 <table  class='table dataTable'  style='$da'  other_query=\"  remainings='0' \"   table_file='php_files/pages/server-side-tables/items.php' > <thead> <tr> 
                 <th>   </th>  
               </tr> </thead>
 <tbody>
 </tbody></table>

 </div>

 
 


<script type=\"text/javascript\">
      
 

    $( \".spg\" ).html('$daaa');




 

 


</script>
 
 ";
 
return $data;
 
 }




 
 
if(isset($_POST['data'])){
    if_logged_in('die');
   echo get_page($_POST['data']);

}







?>
