<?php
  include '../../clasess/db_connector.php';

    require '../../clasess/extra_functions.php';
   require '../../clasess/reports_class.php';

function get_credit_customers(){
   $debt_val = get_credit_debt('debt')['value'];
   $credit_val = get_credit_debt('credit')['value'];
   
	return "<h3 class='title_'>(".get_credit_debt('credit')['len'].") Customers in credit </h3>
 

 <table class='table ' style='
    width: 50%;background:rgba(128, 80, 162, 0.1) !important; 
    margin-top: 20px;
    margin-bottom:20px;
    /* margin-left: 0px; */
'> <thead> <tr><th class=\"title_2\"> </th> </tr></thead>
<tbody>
  <tr> <td style='
    background: #fafbfc;
'>
  
       
    Current Credit: ".$credit_val."
             <br> Current Debt: ".$debt_val."
      </div>    

       
   </td>
  </tr>

</tbody>
 </table>
 
 

 <table  class='table dataTable' table_file='php_files/pages/server-side-tables/customers_credit.php' ><thead><tr> <th>Name</th> <th>Mobile</th>  <th> Current Balance </th><th  class='hide_for_print'> more </th><th class='hide_for_print'>Action</th></tr></thead>
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