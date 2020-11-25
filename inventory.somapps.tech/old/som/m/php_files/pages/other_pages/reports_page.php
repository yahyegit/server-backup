 <?php
   include '../../clasess/db_connector.php';


// username in table should be link to his account 

 function get_reports($year,$month,$day,$full_date_DB,$date_to){ // y,m,d
        $full_date_DB = sanitize($full_date_DB);
 
    $full_date =  date('d-M-Y',strtotime($full_date_DB)).((trim($date_to) !='')?"<span class='span'> to </span>".date('d-M-Y',strtotime($date_to)):'');
           
        $date_qry_ = ($date_to !='')?" date BETWEEN '~$full_date_DB' AND  '~$date_to' ":"date like'%~$full_date_DB%'";
        $date_qry = ($date_to !='')?" date BETWEEN '$full_date_DB' AND  '$date_to' ":"date like'%$full_date_DB%'";
     
  global $ccc;  //  currency 
global $current_user;

   $totalExpense = $ccc.number_format(mysqli_result_(mysqli_query_("select sum(cost) from expenses where  $date_qry and delete_status!='1' "),0),2);


  $totalPrice = $ccc.number_format(mysqli_result_(mysqli_query_("select sum(price) from invoices where  $date_qry and delete_status!='1' "),0),2);


  $totalDiscount = $ccc.number_format(mysqli_result_(mysqli_query_("select sum(discount) from payments where  $date_qry and  delete_status!='1' "),0),2);

  $totalIncome = $ccc.number_format(mysqli_result_(mysqli_query_("select sum(paid) from payments where  $date_qry and  delete_status!='1' "),0),2);

  $profit_g = mysqli_result_(mysqli_query_("select sum(profit) from invoices where  $date_qry and delete_status!='1' "),0);

  $profit_n = $profit_g-mysqli_result_(mysqli_query_("select sum(cost) from expenses where  $date_qry and delete_status!='1' "),0); 

$pro_color_g = (preg_match('/-/', $profit_g))?'color:red;':'color:green;';
$pro_color_n = (preg_match('/-/', $profit_n))?'color:red;':'color:green;';

$profit_g = $ccc.number_format(((trim($profit_g) == '')?0:$profit_g),2);  
$profit_n = $ccc.number_format($profit_n,2);


$data = " 
 
 
 <p class='title_' style=\"
    margin-bottom: 15px;
\" > From  <input type='date' id='date_from'  value=\"$full_date_DB\"  onchange=\"chosen_report_date('reports_page.php');\" >   <br>
To <input type='date' id='date_to'  value=\"$date_to\" style=\"display: ".(($date_to !='')?'':'').";  \" onchange=\" if($.trim($('#date_from').val()) != ''){chosen_report_date('reports_page.php');}\">  </p>

 <table  class='table repots_totals ' style='width:90%'  ><thead>   <th>   </th>   </tr></thead>
    <tbody>
      
          <tr><th>Total price </th><td>$totalPrice</td> </tr>

          <tr> <th>Total discount</th><td>$totalDiscount</td> </tr> 

          <tr> <th> Income </th> <td>$totalIncome</td> </tr>  

          <tr> <th> Expense </th> <td>$totalExpense </td> </tr> 
    <tr> <th> gross profit</th>  <td style='$pro_color_g'>$profit_g</td>     </tr>
          <tr> <th> net profit </th>  <td style='$pro_color_n'>$profit_n</td>   </tr> 
     
     </tbody></table> 
 

  <div class='it_' style=\"
    margin-top: 45px;
\">  <ul style=\"
 \" >  
       
  <p class='title_'>   expenses for <span> $full_date </span>  </p> 
        

        <button  class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('','','pages/forms/expense_form.php');\" role='button' aria-disabled='false' style=' display:inline;  margin-left: '><span class='ui-button-icon-primary ui-icon ui-icon-plus '></span><span class='ui-button-text'> Expense kudar</span></button> 
 
         <table  class='table dataTable'  other_query=\" $date_qry_   \"   table_file='php_files/pages/server-side-tables/expenses.php' ><thead> <tr> 
                          <th>   </th> 
                       </tr> </thead>
        <tbody>
         </tbody></table>
 



  <p class='title_'>   wixii la iibiyay <span> $full_date </span>  </p> 

     <table  class='table dataTable'  other_query=\"  $date_qry_ \"   table_file='php_files/pages/server-side-tables/customer_items.php' ><thead> <tr> 
                  <th>    </th> 
                   </tr> </thead>
    <tbody>
     </tbody></table>



  <p class='title_'>   payments for <span> $full_date </span>  </p> 
    
 <table  class='table dataTable'  other_query=\" $date_qry_  \"   table_file='php_files/pages/server-side-tables/all_payments.php' ><thead> <tr> 
                  <th>   </th> 
               </tr> </thead>
<tbody>
 </tbody></table>
 
 </div>




<script type=\"text/javascript\">
      
 
 
    $( \".it_\" ).tabs();


 


</script>
 
 ";
 
 
  
return $data;
 
 }




 
 
if(isset($_POST['data'])){
    if_logged_in('die');
      if (is_admin($current_user)) {

              $date_from = $_POST['data']['date']['date_from'];
              $date_to =  $_POST['data']['date']['date_to'];
             
                if_logged_in('die');


		$fromDate = mysqli_result_(mysqli_query_("SELECT `date` from customer_items  where delete_status!='1' ORDER BY `date` DESC LIMIT 1"),0);

		$fromDate = date('Y-m-d',strtotime("-1 month $fromDate"));

                 $date_full = (strtolower(trim($date_from)) == 'latest' || strtolower(trim($date_from)) == '')?$fromDate:sanitize(strtolower($date_from));
                $date_ = explode('-', $date_full);


		$date_to = (trim($date_to ) == '')?date('Y-m-d',strtotime("+1 month $date_full")):$date_to;

                echo get_reports($date_[0],$date_[1],$date_[2],$date_full,sanitize(strtolower($date_to)));
      }
}

?>
