<?php
    include '../../clasess/db_connector.php';

   require '../../clasess/reports_class.php';

function get_all_customers(){
 
 
  return "<h3 class='title_'>(".number_format(mysqli_result_(mysqli_query_("select count(id) from students where balance!='0' and delete_status!='1'  "), 0))
.") students in debt </h3>
 
         
  
   
 <table class='table ' style='
    width: 50%;background:rgba(128, 80, 162, 0.1) !important; 
    margin-top: 20px;
    margin-bottom:20px;
    /* margin-left: 0px; */
'> <thead> <tr><th class=\"title_2\"> </th> </tr></thead>
<tbody>
  <tr> <td  >
 Total Debts: <span class='debt_color'  > $".number_format(mysqli_result_(mysqli_query_("select sum(balance) from students where balance!='0' and delete_status !='1'")),2)." </span>
       
   </td>
  </tr>

</tbody>
 </table>
 
 
 

 <table  class='table dataTable'  other_query=\"balance!='0'\"  table_file='php_files/pages/server-side-tables/customers_all.php' ><thead><tr> <th>Name</th> <th>courses</th>  <th> paid </th><th>Balance</th><th>Class time </th> <th>address</th>  <th>Description</th>  <th>date</th> <th  class='hide_for_print'> action </tr></thead>
<tbody>
 </tbody></table>
 

</body></html>
";

}
  echo get_all_customers();

// submited 
if(isset($_POST['data'])){
    if_logged_in('die');
 

}

?>