<?php
    include '../../clasess/db_connector.php';

   require '../../clasess/reports_class.php';

function get_all_customers(){
 
 
  return "<h3 class='title_'>(".number_format(mysqli_result_(mysqli_query_("select count(id) from courses where delete_status!='1'  "), 0))
.") Coureses </h3>
 
         
  
 
  <button  style=\"
    margin-left:  ; font-size: 13px;
\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"get_template.customers('','transction_form','pages/forms/coureses_form.php');\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\"> Add Course </span></button> 


 <table  class='table dataTable' table_file='php_files/pages/server-side-tables/coureses.php' ><thead><tr> <th>Course</th> <th>Duration</th> <th> Cost </th><th> Course students </th>  <th  class='hide_for_print'> action </tr></thead>
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