<?php
   require '../../clasess/dataBase_class.php';
   require '../../clasess/customers_class.php';

function  get_customer_account($customer_id){
  $customer_id = sanitize($customer_id);

 if(mysqli_result_(mysqli_query_("SELECT customer_id FROM customers WHERE  `delete_status`!='1' AND `customer_id`=$customer_id"), 0) == '0'){ 
    die('login');
  } // check if account is deleted



$cust_name = mysqli_result_(mysqli_query_("select customer_name from customers where customer_id=$customer_id"), 0);
$cust_mobile = mysqli_result_(mysqli_query_("select mobile from customers where customer_id=$customer_id"), 0);
 
$trans_length = mysqli_result_(mysqli_query_("SELECT count(`id`) FROM `transactions` WHERE `delete_status`!='1' AND `customer_id`=$customer_id"), 0);

 

$rt = "
 <table class=\"table c_ac_page\"><thead><tr> <th>name</th> <th>mobile</th> <th>Current Balance</th> <th>Action</th>  </tr><tr></tr></thead>
<tbody>
<tr> <td>$cust_name    
<button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary'  onclick=\"get_template.customers($customer_id,'transction_form','pages/forms/make_transction_form_page.php');\"  role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-plus'></span><span class='ui-button-text'>Add trans</span></button> </td> <td>$cust_mobile</td> <td class='bl_list'>  

".get_balance_($customer_id)."

</td> <td>  




  <button class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\"  onclick=\"get_template.customers($customer_id,'edit_customer_info_form','pages/forms/edit_customer_info_form.php');\"   role=\"button\" aria-disabled=\"false\" style=\"font-size: 11px;\"><span class=\"ui-button-icon-primary ui-icon ui-icon-pencil\"></span><span class=\"ui-button-text\">Edit info</span></button>  <button class=\"  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\"   onclick=\"delete_( {id:$customer_id,table:'customers',msg:'you are about to delete all transactions for <strong>$cust_name</strong> ?'}) \"  role=\"button\" aria-disabled=\"false\" style=\"font-size: 11px;\"><span class=\"ui-button-icon-primary ui-icon ui-icon-trash\"></span><span class=\"ui-button-text\">Delete account</span>  

  


 </td></tr>
</tbody>
 </table>


<h3 class=\"title_\"  >($trans_length) Transactions for $cust_name </h3> <table class=\"table dataTable\"   table_file='php_files/pages/server-side-tables/transactions_history.php' other_query=\"customer_id='$customer_id'\" primary_key='id'  >
  <thead><tr><th> Amount </th> <th>Date</th><th>Description</th> <th>Action</th>  </tr></thead> <tbody>

  </tbody>
  </table> ";
return $rt;
}


 
// submited 
if(isset($_POST['data'])){
     if_logged_in('die');

     echo get_customer_account($_POST['data']['customer_id']);
  
 
}else{


/*print_r($_POST);*/
}
?>