<?php
 include '../../clasess/db_connector.php';
   require '../../clasess/extra_functions.php';
   require '../../clasess/reports_class.php';

function get_debt_customers(){
    $currents = get_current_totals();
  
  return "<h3 class='title_'>(".number_format(mysqli_result_(mysqli_query_("select count(customer_id) from customers where  customer_name !='' and current_ksh_balance LIKE '-%' OR current_dollar_balance LIKE '-%'  and delete_status!='1'"),0)).") Customers in debt </h3>   
 
 <table class='table' style='
    width: 50%;background:rgba(128, 80, 162, 0.1) !important; 
    margin-top: 20px;  margin-bottom:20px;
    /* margin-left: 0px; */
'> <thead> <tr><th class=\"title_2\"> </th> </tr></thead>
<tbody>
  <tr> <td style='
    background: #fafbfc;
'>
  

      <p class='underline '   style=\"margin-top: 4px;\"   ><i><span class='gray' >Current Debt:</span></i> <b class='debt_color'>ksh".number_format($currents['current_out']['ksh'],2)."</b><span  class='hr_'>   </span><b  class='debt_color'>\$".number_format($currents['current_out']['dollar'],2)." </b> </p>
    

 
   </td>
  </tr>

</tbody>
 </table>
 
 

 <table class='table dataTable' table_file='php_files/pages/server-side-tables/customers_debt.php' style='
 
'><thead><tr> <th>Name</th> <th>Mobile</th> <th> Total ksh In </th><th> Total ksh Out </th> <th> Total ksh Balance </th> <th> Total dollar In </th><th> Total dollar Out </th><th> Total dollar Balance </th><th> more </th><th>Action</th></tr></thead>
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