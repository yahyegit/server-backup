 <?php
   include '../../clasess/db_connector.php';
 

 function get_payments($data){ // y,m,d
    
      
$data = "<div class='reports_page'>
 
    <button  style=\"
    margin-left:3px; font-size: 13px;
\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"get_template.customers('','transction_form','pages/forms/send_money_form.php');\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\"> Send money </span></button>  
 
 <table  class='table dataTable'  other_query=\" \"  table_file='php_files/pages/server-side-tables/all_payments.php' ><thead> <tr>  <th> </th>	 </tr> </thead>
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
