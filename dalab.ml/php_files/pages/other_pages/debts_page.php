<?php
   require '../../clasess/dataBase_class.php';

function get_debt_customers(){
$balance = mysqli_result_(mysqli_query_("select sum(balance)  from products where  balance!=0 and delete_status!='1' "), 0);
	return "<h3 class='title_'>(".mysqli_result_(mysqli_query_("select count(customer_id)  from products where  balance!=0 and delete_status!='1' "), 0).") customers  </h3>
 


 <table class='table  '  style='width:50%;
    margin-top:20px;  margin-bottom:20px;margin:auto;
'><thead><tr> <th>Total Balance</th> <td class='".((number_format($balance,2) !='0.00')?'debt_color':'in_color')."' > 
".number_format($balance,2)."  </td></tr></thead>
<tbody>
 </tbody></table>
 

</body></html>
 

 <table class='table dataTable' table_file='php_files/pages/server-side-tables/customers_debt.php' style='
    margin-top: ;
'><thead><tr> <th>name</th> <th>mobile</th> <th> Balance</th> <th> more </th><th>Action</th></tr></thead>
<tbody>
 </tbody></table>
 

</body></html>
";

}
 
// submited 
if(isset($_POST)){
     if_logged_in('die');

	echo get_debt_customers();

}


?>