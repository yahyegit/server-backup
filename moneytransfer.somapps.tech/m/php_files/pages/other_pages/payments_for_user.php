 <?php
   include '../../clasess/db_connector.php';
 

 function payments_for_user($data){ // y,m,d
   $data['id'] = sanitize($data['id']);

     $username =  mysqli_result_(mysqli_query_("select username from users where id='{$data['id']}' and delete_status!='1' "),0);
 
$data = "<div class='reports_page'>
 
  <p class='' style='margin:auto auto;color:#7c11a2 !important;text-align: center;margin-bottom: 13px;margin-top: 20px;'> Payments for <b>$username</b> </p>

 
 
 <table  class='table dataTable'  other_query=\"paid_user_id='{$data['id']}' and status='paid' \"  table_file='php_files/pages/server-side-tables/user_payments.php' ><thead> <tr> 
						<th> </th>
							 </tr> </thead>
<tbody>
 </tbody></table>
 
 
 ";
 
return $data;
 
 }




 
 
if(isset($_POST['data'])){
    if_logged_in('die');
   echo payments_for_user($_POST['data']);

}







?>