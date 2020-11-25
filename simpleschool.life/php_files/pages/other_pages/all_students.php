<?php
    include '../../clasess/db_connector.php';

 
function get_all_customers(){
 
 
  return "<h3 class='title_'>(".number_format(mysqli_result_(mysqli_query_("select count(student_id) from students where  delete_status!='1'  "), 0))
.") students  </h3>
 
     <button  style=\"
    margin-left:  %; font-size: 13px;
\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"get_template.customers('','transction_form','pages/forms/register_student.php');\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\"> Register student </span></button> <br>       
 
 <table  class='table dataTable'  other_query=''  table_file='php_files/pages/server-side-tables/students_all.php' ><thead><tr> <th> name </th>  <th> mobile </th>  <th> subjects </th> <th> balance </th> <th> Action </th>    </tr></thead>
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