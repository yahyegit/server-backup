 <?php
   include '../../clasess/db_connector.php';
 

 function get_expenses(){ // y,m,d
       
    
      
$data = "<div class='reports_page'>
 
  
   <button  style=\"
    margin-left:  ; font-size: 13px;
\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"get_template.customers('','transction_form','pages/forms/expense_form.php');\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\"> Add Expense </span></button> 

 <table  class='table dataTable' other_query=\"\" table_file='php_files/pages/server-side-tables/expenses.php' ><thead>   <th> Name </th><th>Quantity</th> <th>Cost</th> <th>Date</th> <th>Description</th><th> Action</th></tr></thead>
<tbody>
 </tbody></table> 


 ";
 
return $data;
 
 }




 
 
if(isset($_POST['data'])){
    if_logged_in('die');
   echo get_expenses();

}







?>