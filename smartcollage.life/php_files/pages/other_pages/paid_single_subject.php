
  <?php
   include '../../clasess/db_connector.php';
  
 function get_subjects_student($subject){ // y,m,d
 $data = "<div class='reports_page'>
<script type='text/javascript'>
		
	i = setInterval(function(){ 

				if($('.class_paid_s').length  > 0 ){
 
						$('.class_paid').html('$'+$('.class_paid_s').html()).show();
				clearInterval(i);

				}
},100);

</script>
 
  <h4 class='title_' style='margin:auto auto;color:#7c11a2 !important;text-align: center;margin-bottom: 13px;margin-top: 20px;'>  $subject </strong> </h4>

<p><label class=\"show_ float_label\"> Total class paid </label> <b class='class_paid' style='font-size:15px'></b>
<br>
<label class=\"show_ float_label\"> Total class balance </label> <b class='debt_color' style='font-size:15px' > $".number_format(mysqli_result_(mysqli_query_(" select sum(cost-balance) from  invoices where student_subject='$subject' and balance='0' and delete_status!='1' "), 0),2)."</b> 
<br>
<label class=\"show_ float_label\"> number of student</label> <b class='r' style='font-size:15px'>".number_format(mysqli_result_(mysqli_query_(" select count(id) from  invoices where student_subject='$subject' and balance='0' and delete_status!='1' "), 0))."</b>
</p>

  

 <table  class='table dataTable'  other_query=\"student_subject='$subject' and balance='0'
 \"  table_file='php_files/pages/server-side-tables/paid_students_by_subject.php' ><thead><tr> <th> Student name </th> <th> Subject </th><th> Invoice date </th> <th> cost </th><th> monthly discount </th>  <th> Balance </th>   </tr></thead>
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
