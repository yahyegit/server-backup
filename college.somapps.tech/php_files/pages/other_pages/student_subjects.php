 <?php
   include '../../clasess/db_connector.php';
 

 function get_subjects_student($data){ // y,m,d
    
 $students_counted = get_count_s($data['student_subject']); //mysqli_result_(mysqli_query_("SELECT COUNT(DISTINCT student_id) FROM `student_subjects` where subject='{$data['student_subject']}' and delete_status!='1' "),0);  
if ( $students_counted > 1) {
	$s = 's';
}
$data = "<div class='reports_page'>
 
  <p class='' style='margin:auto auto;color:#7c11a2 !important;text-align: center;margin-bottom: 13px;margin-top: 20px;'> (".number_format($students_counted).") student$s in class: <strong>{$data['student_subject']} </strong> </p>

 
 
 <table  class='table dataTable'  other_query=\"subject='{$data['student_subject']}'\"  table_file='php_files/pages/server-side-tables/student_subjects.php' ><thead> <tr> 
							 <th> name </th> <th> subject </th>  <th> monthly discount </th>  <th> cost </th> <th> Billing date </th> <th> action </th>
							 </tr> </thead>
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

