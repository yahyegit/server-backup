 <?php
   include '../../clasess/db_connector.php';


// username in table should be link to his account 



  //(mysqli_result_(mysqli_query_("select sum(amount) from payments where  $date_qry and  delete_status!='1' "),0)-mysqli_result_(mysqli_query_("select sum(cost) from expenses where  $date_qry and delete_status!='1' "),0));
 
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
\" > Report date   <input type='date' id='date_from'  value=\"$full_date_DB\"  onchange=\"chosen_report_date('reports_page.php');\" >  
  <label for=\"to_input_date\"> To </label>
    <input type='checkbox'  ".(($date_to !='')?'selected_check="true"':'')." onclick=\" if($(this).next('#date_to').is(':visible')){\$(this).next('#date_to').val('').hide();chosen_report_date('reports_page.php');}else{
     $(this).next('#date_to').show();
  }  \" id=\"to_input_date\"> 

 <input type='date' id='date_to'  value=\"$date_to\" style=\"display: ".(($date_to !='')?'':'none').";  \" onchange=\" if($.trim($('#date_from').val()) != ''){chosen_report_date('reports_page.php');}\">  </p>

 <table  class='table  '  ><thead>  <th>total pice </th> <th> total discount </th>  <th>total income </th><th>total expense</th> <th > gross profit</th> <th > net profit</th>  </tr></thead>
    <tbody>
     <tr>
          <td>$totalPrice</td><td>$totalDiscount</td> <td>$totalIncome</td>  <td>$totalExpense </td> <td style='$pro_color_g'>$profit_g</td><td style='$pro_color_n'>$profit_n</td>
     </tr>
     </tbody></table> 
 

  <div class='it_' style=\"
    margin-top: 45px;
\">  <ul style=\"
    float:right;
\" >  
       
          <li> <a href='#items'> sales on <span> $full_date </span>  </a> </li> 
          <li> <a href='#payments'> payment on <span> $full_date </span> </a> </li> 
          <li> <a href='#expenses'> expenses on <span> $full_date </span> </a> </li> 
      </ul>

 <div id='expenses' style=\"display: block;margin-top: 48px;\">
    
         <table  class='table dataTable'  other_query=\" $date_qry_   \"   table_file='php_files/pages/server-side-tables/expenses.php' ><thead> <tr> 
                          <th> name </th><th> cost </th>   <th> date </th> <th> desctiption </th>  <th> by </th> <th> action </th> 
                       </tr> </thead>
        <tbody>
         </tbody></table>
 </div>




 <div id='items'  style=\"display: block;margin-top: 48px;\" >
 
     <table  class='table dataTable'  other_query=\"  $date_qry_ \"   table_file='php_files/pages/server-side-tables/customer_items.php' ><thead> <tr> 
                  <th>    </th>  
                   </tr> </thead>
    <tbody>
     </tbody></table>
 </div>

 <div id='payments'  style=\"display: block;margin-top: 48px;\" >
     
 <table  class='table dataTable'  other_query=\" $date_qry_  \"   table_file='php_files/pages/server-side-tables/all_payments.php' ><thead> <tr> 
                   <th> name </th> <th> Amount </th><th> discount </th><th> date </th>  <th> desctiption </th>  <th> taken by </th>  
               </tr> </thead>
<tbody>
 </tbody></table>
 </div>

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
                 $date_full = (strtolower(trim($date_from)) == 'latest' || strtolower(trim($date_from)) == '')?mysqli_result_(mysqli_query_("SELECT `date` from invoices  where delete_status!='1' ORDER BY `date` DESC LIMIT 1"),0):sanitize(strtolower($date_from));
                $date_ = explode('-', $date_full);

  $date_full = (trim($date_full) == '')?date('Y-m-d'):$date_full;

                echo get_reports($date_[0],$date_[1],$date_[2],$date_full,sanitize(strtolower($date_to)));
      }
}

?>
