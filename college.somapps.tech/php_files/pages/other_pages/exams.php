 <?php
   include '../../clasess/db_connector.php';
 

 function get_subjects_student($data){ // y,m,d
    
      $sub = (!empty($data['student_subject']))?"  <p class='' style='margin:auto auto;color:#7c11a2 !important;text-align: center;margin-bottom: 13px;margin-top: 20px;'>  Exams for <strong>{$data['student_subject']} </strong> </p>":'';

         $other_query = (!empty($data['student_subject']))?"subject='{$data['student_subject']}'":'';
      
$data = "<div class='reports_page'>
 
  $sub

    <button  style=\"
    margin-left:  ; font-size: 13px;
\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"get_template.customers('','','pages/forms/exams_form.php');\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\"> Add Exam </span></button> 
 
 <table  class='table dataTable'  other_query=\"$other_query\"  table_file='php_files/pages/server-side-tables/exams.php' ><thead> 
<tr> 
							    <th>student name</th>  <th>subject</th><th>marks</th> <th>date</th> <th>Action</th> 
							 </tr>


  </thead>
<tbody>
 </tbody></table>
 
 
 ";
 
return $data;
 
 }




 
 
if(isset($_POST['data'])){
    if_logged_in('die');
   echo get_subjects_student($_POST['data']);

}







?>

