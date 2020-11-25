<?php
    include '../../clasess/db_connector.php';

   require '../../clasess/reports_class.php';

function get_all_customers(){
 $count_due = number_format(mysqli_result_(mysqli_query_("select count(id) from students where due_date <='".date('Y-m-d')."'  and due_date!='0000-00-00' and balance!='0' and   delete_status!='1'  "), 0));

  
  return "   <script type='text/javascript' > 

   ".( (empty($count_due))?"$('.overdue_li,#view *').hide();$('.first_li').click();":'')."

      $( '.due_date_bg').html('".( (!empty($count_due))?"<span   style=\"  background: #fafbfc;padding: 2px;color: #7c11a2;border-radius: 3em;font-size: 14px;/* font-weight: bold; *//* width: 20px; */ \"> $count_due </span>":'')."');
 
  
    </script> <br> <h3 class='title_'>( $count_due) overdue debts  </h3>
 
         
  
  
 <table class='table ' style='
    width: 50%;background:rgba(128, 80, 162, 0.1) !important; 
    margin-top: 20px;
    margin-bottom:20px;
    /* margin-left: 0px; */
'> <thead> <tr><th class=\"title_2\"> </th> </tr></thead>
<tbody>
  <tr> <td >
 Total overdue balance: <span class='debt_color'>$".number_format(mysqli_result_(mysqli_query_("select sum(balance) from students where due_date <='".date('Y-m-d')."' and due_date!='0000-00-00' and balance!='0' and  delete_status !='1'")),2)."</span>
       
   </td>
  </tr>

</tbody>
 </table>
 
 
 

 <table  class='table dataTable' table_file='php_files/pages/server-side-tables/overdue.php' ><thead><tr> <th>Name</th> <th>courses</th>  <th> paid </th><th>Balance</th><th>address</th> <th>Description</th>  <th>date</th> <th  class='hide_for_print'> action </tr></thead>
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