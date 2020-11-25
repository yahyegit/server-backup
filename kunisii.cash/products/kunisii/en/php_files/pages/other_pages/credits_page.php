<?php
  include '../../clasess/db_connector.php';

    require '../../clasess/extra_functions.php';
   require '../../clasess/reports_class.php';

function get_credit_customers(){
 $currents = get_current_totals();

	return "<h3 class='title_'>(". number_format(mysqli_result_(mysqli_query_("select count(customer_id) from customers where  customer_name !='' and current_ksh_balace NOT LIKE '-%' OR current_dollar_balace NOT LIKE '-%'  and delete_status!='1'"),0)).") customers  </h3>
 

 <table class='table' style='
    width: 50%;
    margin-top: 20px;
    margin-bottom:20px;
    /* margin-left: 0px; */
'> <thead> <tr><th class=\"title_2\"> </th> </tr></thead>
<tbody>
  <tr> <td style='
    background: #fafbfc;
'>
  

         <p class='underline '  > <i><span>Total Credit:</span></i> <b  class='in_color' >".number_format($currents['current_in']['ksh'],2)." ksh </b><span> and </span><b  class='in_color' >\$".number_format($currents['current_in']['dollar'],2)." </b></p>   

 

   </td>
  </tr>

</tbody>
 </table>
 

 <table class='table dataTable' table_file='php_files/pages/server-side-tables/customers_credit.php' style='
  
'><thead><tr> <th>name</th> <th>mobile</th> <th>Current Balance</th> <th> more </th><th>Action</th></tr></thead>
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