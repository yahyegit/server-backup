<?php
  include '../../clasess/db_connector.php';

    require '../../clasess/extra_functions.php';
   require '../../clasess/reports_class.php';

function get_credit_customers(){
 $currents = get_current_totals();

	return "<h3 class='title_'>(". number_format(mysqli_result_(mysqli_query_("select count(customer_id) from customers where  customer_name !='' and current_ksh_balance NOT LIKE '-%' OR current_dollar_balance NOT LIKE '-%'  and delete_status!='1'"),0)).") Customers in credit </h3>
 

 <table class='table' style='
    width: 90%;
    background:rgba(128, 80, 162, 0.1) !important; 
    margin-top: 20px;
    margin-bottom:20px;
    /* margin-left: 0px; */
'> <thead> <tr><th class=\"title_2\"> </th> </tr></thead>
<tbody>
  <tr> <td style='
    background: #fafbfc;
'>
  
 
         <p class='underline '  > <i><span class='gray'>Current Credit:</span></i> <b  class='in_color' >ksh".number_format($currents['current_in']['ksh'],2)." </b><span class='hr_'> </span><b  class='in_color' >\$".number_format($currents['current_in']['dollar'],2)." </b></p>   


   </td>
  </tr>

</tbody>
 </table>
 

 <table class='table dataTable' table_file='php_files/pages/server-side-tables/customers_credit.php' style='
  
'><thead><tr> <th>customers</th> </tr></thead>
<tbody>
 </tbody></table>
 

</body></html>
";

}
 
// submited 
if(isset($_POST)){
    if_logged_in('die');

	echo get_credit_customers();

}


?>