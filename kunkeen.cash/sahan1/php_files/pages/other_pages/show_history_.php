<?php
    include '../../clasess/db_connector.php';

   require '../../clasess/reports_class.php';

function get_history($data){
      $data['id'] = sanitize($data['id']);

      $blc = mysqli_result_(mysqli_query_("select balance from students where id='{$data['id']}' and delete_status !='1'"));
if (!empty($blc)) {
	$mkdpaye = "<button  title='make payment or set remainder ' class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('',{id:{$data['id']}},'pages/forms/make_payment.php');\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon-person  '></span><span class='ui-button-text'>make payment </span></button>";
}else{
$mkdpaye = '';
}
 
  return "<h3 class='title_'> payments for ".mysqli_result_(mysqli_query_("select  name from students where id='{$data['id']}' and delete_status!='1'  "), 0)." </h3>
 
         
  
  
 <table class='table ' style='
    width: 50%;background:rgba(128, 80, 162, 0.1) !important; 
    margin-top: 20px;
    margin-bottom:20px;
    /* margin-left: 0px; */
'> <thead> <tr><th class=\"title_2\"> </th> </tr></thead>
<tbody>
  <tr> <td class=' ' >
 current paid: $".number_format(mysqli_result_(mysqli_query_("select sum(paid) from payments where  student_id='{$data['id']}' and delete_status !='1'")),2)."   
 current balance: <span class='debt_color'>$".number_format($blc,2)."
 </span>     $mkdpaye
   </td>
  </tr>

</tbody>
 </table>
 
 
 

 <table  class='table dataTable' other_query=\"student_id='{$data['id']}'\" table_file='php_files/pages/server-side-tables/payment_history.php' ><thead>   <th> paid </th><th>date</th><th>Description</th>  <th>Balance</th>   </tr></thead>
<tbody>
 </tbody></table>
 

</body></html>
";

}

// submited 
if(isset($_POST['data'])){
    if_logged_in('die');
   echo get_history($_POST['data']);


}

?>