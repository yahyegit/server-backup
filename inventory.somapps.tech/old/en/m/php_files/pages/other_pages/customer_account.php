 <?php
   include '../../clasess/db_connector.php';
 

 function get_page($data){ // y,m,d
     $id  = sanitize($data['id']);

global $ccc;




        $rResult = mysqli_query_("select * from customers where id='$id' ");
        $aRow = mysqli_fetch_assoc_($rResult);
        
       
  
      
$data = "



 <table class='table' > <tr><td>  "."<p> {$aRow['customer_name']}".((empty($aRow['mobile']))?'':" ({$aRow['mobile']})")
."</p><p><label class='float_label show_'>balance</label><span class='debt_color'>".$ccc.number_format($aRow['current_balance'],2)." </span><button  class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('',{id:{$aRow['id']} },'pages/forms/make_payment_form.php');\" role='button' aria-disabled='false' style='".((empty($aRow['current_balance']))?'display:none':'inline')."'><span class='ui-button-icon-primary ui-icon ui-icon- '></span><span class='ui-button-text'>Pay now</span></button> </p>  

         <p> <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['id']},'edit_customer_info_form','pages/forms/edit_customer.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit customer  </span></button>    <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'customers',id:{$aRow['id']},msg:'Deleting {$aRow['customer_name']} ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete customer </span></button>  </p>



          </td></tr></table>

 

 
   <p class='title_'> Items for <b>{$aRow['customer_name']}</b> </p>
   

 <table  class='table dataTable'  other_query=\" customer_id='$id'  \"   table_file='php_files/pages/server-side-tables/customer_items.php' ><thead> <tr> 
                 <th>    </th>  </tr> </thead>
<tbody>
 </tbody></table>
  
 


  <p class='title_'>    Payment history for <b>{$aRow['customer_name']}</b> </p>

 <table  class='table dataTable'  other_query=\" customer_id='$id'  \"   table_file='php_files/pages/server-side-tables/all_payments.php' > <thead> <tr> 
                  <th>   </th> 
               </tr> </thead> 
<tbody>
 </tbody></table>
  

 



<script type=\"text/javascript\">
      
 
 
    $( \".it_\" ).tabs();


 


</script>
 
 ";
 
return $data;
 
 }




 
 
if(isset($_POST['data'])){
    if_logged_in('die');
   echo get_page($_POST['data']);

}







?>
