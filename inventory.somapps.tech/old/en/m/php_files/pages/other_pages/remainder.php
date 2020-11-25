 <?php
   include '../../clasess/db_connector.php';
 

 function get_page($data){ // y,m,d
  global $current_user;
     $id  = sanitize($data['id']);
global $ccc;
   $count = number_format(mysqli_result_(mysqli_query_("SELECT COUNT(`id`) FROM customers where current_balance!='0' and  last_date<='".date('Y-m-d',strtotime("-2 weeks"))."' and delete_status!='1' ",0)));

   $total =  $ccc.number_format(mysqli_result_(mysqli_query_("SELECT sum(`current_balance`) FROM customers where current_balance!='0' and  last_date<='".date('Y-m-d',strtotime("-2 weeks"))."' and delete_status!='1' ",0)),2);

// if remaing is not == 0 and is expired show expired 

    $count_it = number_format(mysqli_result_(mysqli_query_("SELECT COUNT(`id`) FROM items where remainings='0' and delete_status!='1' ",0)));


    $count_af  = number_format(mysqli_result_(mysqli_query_("SELECT COUNT(`id`) FROM items where remainings<5 and delete_status!='1' ",0)));

 
 $da = (empty($count))?'display: ':'';
 $da_ = (empty($count_it))?'display: ':'';

$duu = str_replace(',','',$count_it)+ str_replace(',','',$count);
 

  $autoC = " ";

if (!mysqli_result_(mysqli_query_("SELECT count(id) from items where delete_status!='1' "),0)) {
  $autoC = " $('.receive_items').click();
";

}

$daaa = ' <span style=" '.((empty($duu))?'display:none;':'').'  background: #7c11a2;padding: 2px;color: #fff;border-radius: 3em;font-size: 14px;/* font-weight:  ; *//* width: 20px; */ \" > '.number_format($duu).' </span>';
  if (is_admin($current_user)) {
        $recieve_items = "<button  class='receive_items change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('','','pages/forms/receive_items_form.php');\" role='button' aria-disabled='false' style=' display:inline;  margin-left:  '><span class='ui-button-icon-primary ui-icon ui-icon-plus '></span><span class='ui-button-text'>Alaab kudar </span></button> ";
 
 }else{
        $recieve_items = " ";
 
 }


$data = " 
<div id=' '>
  



 
 <p class='title_' style='  $da'> macaamisha lacagaha kudaaheen waa ($count) </p>
 

<p class='' style='  $da'> <label class=\"show_ float_label\" >Total ka macaamisha dayta ladaaheen </label><span class='debt_color' >  $total</span>     </p>

 <table  class='table dataTable'  style='$da'  other_query=\"   current_balance!='0' and  last_date<='".date('Y-m-d',strtotime("-2 weeks"))."' \"   table_file='php_files/pages/server-side-tables/customers.php' ><thead> <tr> 
                <th>    </th> 
               </tr> </thead>
<tbody>
 </tbody></table>

 



<br><br> 

 <p class='title_' style='  $da_af'> alaabta damaan rabta ($count_af) </p>
 

 <table  class='table dataTable'  style='$da'  other_query=\"  remainings<5 \"   table_file='php_files/pages/server-side-tables/items.php' > <thead> <tr> 
                  <th>    </th> 
               </tr> </thead>
 <tbody>
 </tbody></table>




<br><br>

<p class='title_' style='$da_'> alaabta dhamaatay ($count_it)   </p>
 <table  class='table dataTable'  style='$da'  other_query=\"  remainings='0' \"   table_file='php_files/pages/server-side-tables/items.php' > <thead> <tr> 
                <th>    </th> 
               </tr> </thead>
 <tbody>
 </tbody></table>
 




 </div>

 
 


<script type=\"text/javascript\">
      
 

    $( \".spg\" ).html('$daaa');

$autoC
      

 


</script>
 
 ";
 
return $data;
 
 }




 
 
if(isset($_POST['data'])){
    if_logged_in('die');
   echo get_page($_POST['data']);

}







?>
