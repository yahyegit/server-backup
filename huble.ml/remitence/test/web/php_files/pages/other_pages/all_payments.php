 <?php
   include '../../clasess/db_connector.php';
 

 function get_payments($data){ // y,m,d
    
      
$data = "<div class='reports_page'>
 
  <p class='' style='margin:auto auto;color:#7c11a2 !important;text-align: center;margin-bottom: 13px;margin-top: 20px;'> All payments</p>

 
 
 <table  class='table dataTable'  other_query=\" \"  table_file='php_files/pages/server-side-tables/all_payments.php' ><thead> <tr> 	 <th>  Refrence No </th> <th> Pay to </th>  <th> Amount </th>  <th> commission  </th>  <th> Status </th> <th> Sender </th>   <th> Description </th>  <th> Action </th>	 </tr> </thead>
<tbody>
 </tbody></table>
 
 
 ";
 
return $data;
 
 }




 
 
if(isset($_POST['data'])){
    if_logged_in('die');
   echo get_payments($_POST['data']);

}







?>
