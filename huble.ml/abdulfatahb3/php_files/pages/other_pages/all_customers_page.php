<?php
   require '../../clasess/dataBase_class.php';
   require '../../clasess/reports_class.php';
   require '../../functions/toggle_debt_or_in_color.php';

function get_all_customers(){
 $currents = get_current_totals();

 $ksh_c_balance = floor($currents['current_out']['ksh'])-floor(str_replace('-','',$currents['current_in']['ksh']));
 $dollar_c_balance = floor($currents['current_out']['dollar'])-floor(str_replace('-','',$currents['current_in']['dollar']));
	return "<h3 class='title_'>(".number_format(mysqli_result_(mysqli_query_("select count(customer_id) from customers where customer_name !='' and delete_status!='1'  "), 0))
.") customers  </h3>
 
         
  
  

 <table class='table' style='
    width: 50%;
    margin-top: 20px;  margin-bottom:20px;
    /* margin-left: 0px; */
'> <thead> <tr><th class=\"title_2\"> </th> </tr></thead>
<tbody>
  <tr> <td style='
    background: #fafbfc;
'>
  

      <p class='underline '   style=\"margin-top: 4px;\"   ><i><span>Current Out:</span></i> <b class='debt_color'>".number_format($currents['current_out']['ksh'],2)." ksh</b><span> and </span><b  class='debt_color'>\$".number_format($currents['current_out']['dollar'],2)." </b> </p>

         <p class='underline '  > <i><span>Current In:</span></i> <b  class='in_color' >".number_format($currents['current_in']['ksh'],2)." ksh </b><span> and </span><b  class='in_color' >\$".number_format($currents['current_in']['dollar'],2)." </b></p>   

         <p class='underline ' > <i><span>Balance:</span></i> <b class='".toggle_debt_color($ksh_c_balance)."'>".number_format($ksh_c_balance,2)." ksh </b><span> and </span><b class='".toggle_debt_color($dollar_c_balance)."'>\$".number_format($dollar_c_balance,2)." </b></p>   

 

   </td>
  </tr>

</tbody>
 </table>
 



 <table  class='table dataTable' table_file='php_files/pages/server-side-tables/customers_all.php' ><thead><tr> <th>name</th> <th>mobile</th> <th>Current Balance</th> <th> more </th><th>Action</th></tr></thead>
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