<?php
   include '../../clasess/db_connector.php';
 

 function get_page($data){ // y,m,d
     $id  = sanitize($data['id']);

global $ccc;




        $rResult = mysqli_query_("select * from suppliers where id='$id' ");
        $aRow = mysqli_fetch_assoc_($rResult);
        
       
  
      
$data = "



 <table class='table' > <tr><td>{$aRow['s_name']}</td><td>{$aRow['mobile']}</td><td>{$aRow['address']}</td><td>{$aRow['email']}</td><td> <span class='gray'>balance: </span> <span class='debt_color'>$ccc".number_format($aRow['current_balance'],2)."</span> <button  class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('',{id:{$aRow['id']} },'pages/forms/make_sup_payments_form.php');\" role='button' aria-disabled='false' style='".((empty($aRow['current_balance']))?'display:none':'inline')."'><span class='ui-button-icon-primary ui-icon ui-icon- '></span><span class='ui-button-text'>Pay now</span></button></td>  <td><div  class='hide_for_print' style='
    
    margin: 0px !important;
     
'> <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['id']},'edit_customer_info_form','pages/forms/edit_customer.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit supplier  </span></button>    <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'customers',id:{$aRow['id']},msg:'Deleting {$aRow['s_name']} ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete supplier </span></button>      </div></td></tr></table>




<div class='it_'>  <ul>  
       
          <li> <a href='#items'>  items for <b>{$aRow['s_name']}</b> </a> </li> 
           <li> <a href='#payments'> payment history for <b>{$aRow['s_name']}</b></a> </li> 
      </ul>





<div id='items'>
 <table  class='table dataTable'  other_query=\" s_id='$id'  \"  
 table_file='php_files/pages/server-side-tables/s_items.php' >
<thead> <tr> 
                 <th>    </th>  </tr> </thead>
<tbody>
 </tbody></table>
  
 



</div>



 <div id='payments'>
 
 
 <table  class='table dataTable'  other_query=\" s_id='$id'  \"   table_file='php_files/pages/server-side-tables/s_payments.php' > <thead> <tr> 
                  <th> Paid </th><th> Discount </th>   <th> Date </th>  <th> Desctiption </th>  <th> Action</th>  
               </tr> </thead> 
<tbody>
 </tbody></table>
 </div>

 </div>




<div style='display:none'>

<p class='title_'> dhaqdhaqaaqa <b> {$aRow['s_name']} </b></p>


<div>  chart here......  </div>


</div>


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
