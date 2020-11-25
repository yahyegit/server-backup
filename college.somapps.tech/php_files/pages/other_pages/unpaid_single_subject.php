
  <?php
   include '../../clasess/db_connector.php';
  
 function get_subjects_student($subject){ // y,m,d

	

 $data = "<div class='reports_page'>
 
  <h4 class='title_' style='margin:auto auto;color:#7c11a2 !important;text-align: center;margin-bottom: 13px;margin-top: 20px;'>  $subject </strong> </h4>

<p><label class=\"show_ float_label\"> Total class balance </label> <b class='debt_color'>$".number_format(get_total_class_bl($subject),2)."</p>
 
 <table  class='table dataTable'  other_query=\"student_subject='$subject' and status='1' and balance!='0'
 \"  table_file='php_files/pages/server-side-tables/unpaid_students_by_subject.php' ><thead><tr> <th> Student name </th> <th> Subject </th><th> Invoice date </th> <th> cost </th><th> monthly discount </th>  <th> Balance </th>   </tr></thead>
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