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

  $autoC = " ";

if (!mysqli_result_(mysqli_query_("SELECT count(id) from items where delete_status!='1' "),0)) {
  $autoC = " $('.receive_items').click();
";

}
 


$daaa = ' <span style=" '.((empty($duu))?'display:none;':'').'  background: #7c11a2 !important;padding: 5px;color: #fff;border-radius: 5em;padding-top: 1px;margin-bottom: 11px;font-size: 13px;/* font-weight:  ; */padding-bottom: 0px;dth: 20px; */ \" > '.number_format($duu).' </span>';
  if (is_admin($current_user)) {
        $recieve_items = "<button  class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('','','pages/forms/receive_items_form.php');\" role='button' aria-disabled='false' style=' display:inline;  margin-left:30px '><span class='ui-button-icon-primary ui-icon ui-icon-plus '></span><span class='ui-button-text'> Alaab kudar </span></button> ";
 
 }else{
        $recieve_items = " ";
 
 }


$data = " 
<div id=' '>
 
<p class=' ' style='margin-bottom: 30px !important;'>
<button  class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('','','pages/forms/sale_items.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-plus '></span><span class='ui-button-text'>Wax iibi </span></button> 


$recieve_items


<button  class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('','','pages/forms/expense_form.php');\" role='button' aria-disabled='false' style=' display:inline;  margin-left:30px'><span class='ui-button-icon-primary ui-icon ui-icon-plus '></span><span class='ui-button-text'>Add Expense </span></button> 



</p>






 <p class='title_' style='  $da'> macaamisha lacagaha kudaaheen waa ($count) </p>
 

<p class='' style='  $da'> <label class=\"show_ float_label\" >Total   </label><span class='debt_color' >  $total</span>     </p>

 <table  class='table dataTable'  style='$da'  other_query=\"   current_balance!='0' and  last_date<='".date('Y-m-d',strtotime("-2 weeks"))."' \"   table_file='php_files/pages/server-side-tables/customers.php' ><thead> <tr> 
                 <th> name  </th> <th>  mobile </th><th> balance </th> <th> items </th>  <th> action </th> 
               </tr> </thead>
<tbody>
 </tbody></table>

 
<br><br><br>

<p class='title_' style='$da_'> ($count_it) finished items  </p>
 <table  class='table dataTable'  style='$da'  other_query=\"  remainings='0' \"   table_file='php_files/pages/server-side-tables/items.php' > <thead> <tr> 
                 <th> item  </th> <th>  remainings </th><th> price </th>  <th> action </th> 
               </tr> </thead>
 <tbody>
 </tbody></table>

 </div>

 
 


<script type=\"text/javascript\">
      
 $autoC


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
