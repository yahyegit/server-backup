 <?php
   include '../../clasess/db_connector.php';
 

 function get_unpaid($data){ // y,m,d
    
      $count = number_format(mysqli_result_(mysqli_query_("select count(id) from payments where status='unpaid' and delete_status!='1' "),0));
$scr = (!empty($count))?" $('.counts').html('$count').show();":" $('.counts').hide();";

$data = "
    <script type='text/javascript' > 

          
      $scr 
          

    </script> <br>






<div class='reports_page'>
 
  <p class='' style='margin:auto auto;color:#7c11a2 !important;text-align: center;margin-bottom: 13px;margin-top: 20px;'><b>$".number_format(mysqli_result_(mysqli_query_("select sum(amount) from payments where status='unpaid' and delete_status!='1' "),0),2)."</b> Unpaid Payments from <b>".$count."</b> customers </p>

 
  
 <table  class='table dataTable'  other_query=\" \"  table_file='php_files/pages/server-side-tables/unpaid.php' ><thead> <tr> 
							 <th>  Refrence No </th> <th> Pay to </th>  <th> Amount </th>  <th> commission  </th> <th> Status </th> <th> Sender </th>   <th> Description </th>  <th> Action </th>
							 </tr> </thead>
<tbody>
 </tbody></table>
 
 
 ";
 
return $data;
 
 }




 
 
if(isset($_POST['data'])){
    if_logged_in('die');
   echo get_unpaid($_POST['data']);

}







?>
