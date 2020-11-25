 <?php
   include '../../clasess/db_connector.php';
 

 function get_subjects_(){ // y,m,d
       
    
      
$data = "<div class='reports_page'>
 
  <h4 class='title_'> (".number_format(mysqli_result_(mysqli_query_("select count(id) from subjects where delete_status!='1'  	") )).") subjects  </h4>

   <button  style=\"
    margin-left:  ; font-size: 13px;
\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"get_template.customers('','','pages/forms/subject_form.php');\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\"> Add Subject </span></button> 

 <table  class='table dataTable' other_query=\"\" table_file='php_files/pages/server-side-tables/subjects.php' ><thead>   <th>subject</th><th>teacher</th> <th> time </th> <th> cost </th>  <th>Students</th> <th>Exams</th>  <th>Description</th>  <th>action </th>    </tr></thead>
<tbody>
 </tbody></table> 



 ";
 
return $data;
 
 }




 
 
if(isset($_POST['data'])){
    if_logged_in('die');

  if (is_admin($current_user)) {
   echo get_subjects_();

    }


}







?>