 <?php
   include '../../clasess/db_connector.php';
 

 function get_sent($data){ // y,m,d
   $data['id'] = sanitize($data['id']);
     $username =  mysqli_result_(mysqli_query_("select username from users where id='{$data['id']}' and delete_status!='1' "),0);
     $Remaining =  number_format(mysqli_result_(mysqli_query_("select current_remaining_limit from users where id='{$data['id']}' and delete_status!='1' "),0),2);

      
      
$data = "<div class='reports_page'>
 
  <p class='' style='margin:auto auto;color:#7c11a2 !important;text-align: center;margin-bottom: 13px;margin-top: 20px;'> Sent money for <b>$username</b> </p>

 
 
 <table  class='table dataTable'  other_query=\"user_id='{$data['id']}'\"   table_file='php_files/pages/server-side-tables/user_sent.php' ><thead> <tr> 
		 <th>  Refrence No </th> <th> Pay to </th>  <th> Amount </th>  <th> commission  </th> <th> Status </th> <th> Sender </th>   <th> Description </th>  <th> Action </th>
							 
							 </tr> </thead>
<tbody>
 </tbody></table>
 
 
 
 ";
 
return $data;
 
 }




 
 
if(isset($_POST['data'])){
    if_logged_in('die');
   echo get_sent($_POST['data']);

}







?>
