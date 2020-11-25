<?php

   require '../../clasess/dataBase_class.php';

function  get_customer_account($customer_id){
	$customer_id = sanitize($customer_id);

 if(mysqli_result_(mysqli_query_("SELECT customer_id FROM customers WHERE  `delete_status`!='1' AND `customer_id`=$customer_id"), 0) == '0'){ 
 		die('login');
	} // check if account is deleted



$cust_name = mysqli_result_(mysqli_query_("select customer_name from customers where customer_id=$customer_id"), 0);
$cust_mobile = mysqli_result_(mysqli_query_("select mobile from customers where customer_id=$customer_id"), 0);

$cust_balance =  mysqli_result_(mysqli_query_("SELECT sum(`balance`) FROM `products` WHERE  `customer_id`=$customer_id and `delete_status`!=1 "), 0);
  
$address = mysqli_result_(mysqli_query_("select address from customers where customer_id=$customer_id"), 0);
 
$trans_length = mysqli_result_(mysqli_query_("SELECT count(`id`) FROM `products` WHERE `delete_status`!='1' AND `customer_id`=$customer_id"), 0);

$rt = "
 <table class=\"table\"><thead><tr> <th>name</th> <th>mobile</th> <th> address</th><th> Balance</th>  <th>Action</th>  </tr><tr></tr></thead>
<tbody>
<tr> <td>$cust_name </td> <td>$cust_mobile</td>  <td> $address </td> <td> <b class='".(($cust_balance!='0')?'debt_color':'')."' >$".number_format($cust_balance,2)." </b></td> <td>  


 <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"request_template('',{customer_id:$customer_id},'pages/forms/edit_customer_info_form.php');\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit info</span></button> <button class=\"  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\"   onclick=\"delete_( {id:$customer_id,table:'customers',msg:'you are about to delete all products for <strong>$cust_name</strong> ?'}) \"  role=\"button\" aria-disabled=\"false\" style=\"font-size: 11px;\"><span class=\"ui-button-icon-primary ui-icon ui-icon-trash\"></span><span class=\"ui-button-text\">Delete account</span>  </button>
 </td></tr>
</tbody>
 </table>


<h3 class=\"title_\"  >($trans_length) products for $cust_name </h3> <table class=\"table dataTable\"   table_file='php_files/pages/server-side-tables/products.php' other_query=\"customer_id='$customer_id'\" primary_key='customer_id'  >
	<thead><tr><th> product </th> <th>Quantity</th><th>Price</th><th>Paid</th><th>Balance</th><th>address</th> <th>Date</th><th>Description</th> <th>Action</th>  </tr></thead> <tbody>

	</tbody>
	</table> ";
return $rt;
}


 
// submited 
if(isset($_POST['data'])){
     if_logged_in('die');
		echo get_customer_account($_POST['data']['customer_id']);

 
}else{


}
?> 