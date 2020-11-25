<?php
    include '../../clasess/db_connector.php';

   require '../../clasess/reports_class.php';

function get_all_customers(){
  $mk = ' <button  style="
    margin-bottom: -100px;
" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="get_template.customers(\'\',\'transction_form\',\'pages/forms/make_transction_form_page.php\');" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-plus"></span><span class="ui-button-text">Make Transaction </span></button> ';


      $debt_val = get_credit_debt('debt')['value'];
   $credit_val = get_credit_debt('credit')['value'];
      
    
	return $mk."<h3 class='title_'>(".number_format(mysqli_result_(mysqli_query_("select count(customer_id) from customers where customer_name !='' and delete_status!='1'  "), 0))
.") All Customers  </h3>
 
         
  
  
 <table class='table ' style='
    width: 50%;background:rgba(128, 80, 162, 0.1) !important; 
    margin-top: 20px;
    margin-bottom:20px;
    /* margin-left: 0px; */
'> <thead> <tr><th class=\"title_2\"> </th> </tr></thead>
<tbody>
  <tr> <td style='
    background: #fafbfc;
'>
  
       
    Current Credit: ".$credit_val."
             <br> Current Debt: ".$debt_val."
      </div>    

       
   </td>
  </tr>

</tbody>
 </table>
 
 
 

 <table  class='table dataTable' table_file='php_files/pages/server-side-tables/customers_all.php' ><thead><tr> <th>Name</th> <th>Mobile</th>  <th> Current Balance </th><th  class='hide_for_print'> more </th><th class='hide_for_print'>Action</th></tr></thead>
<tbody>
 </tbody></table>
 

</body></html>
";

}
  echo get_all_customers();

// submited 
if(isset($_POST['data'])){
    if_logged_in('die');
 

}

?>
