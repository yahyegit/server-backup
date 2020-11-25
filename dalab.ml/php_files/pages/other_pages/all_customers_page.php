<?php
   require '../../clasess/dataBase_class.php';

function get_all_customers(){

	return "<h3 class='title_'>(".number_format(mysqli_result_(mysqli_query_("select count(customer_id) from customers where customer_name !='' and delete_status!='1'  "), 0))
.") customers  </h3>
 
 <table class='table dataTable' table_file='php_files/pages/server-side-tables/customers_all.php' ><thead><tr> <th>name</th> <th>mobile</th> <th>address</th> <th> Balance</th>  <th>Action</th></tr></thead>
<tbody>
 </tbody></table>
 

</body></html>
";

}

// submited 
if(isset($_POST['data'])){
    if_logged_in('die');

	echo get_all_customers();

}


?>