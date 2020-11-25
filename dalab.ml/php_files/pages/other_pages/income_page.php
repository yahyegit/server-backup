 <?php
   require '../../clasess/dataBase_class.php';



 function get_expense($year,$month,$day,$full_date_DB,$date_to){ // y,m,d
        $full_date_DB = sanitize($full_date_DB);
        $date_to = sanitize($date_to); 

        $other_query_ = ($date_to !='')?" date BETWEEN '%~$full_date_DB%' AND  '%~$date_to%' ":"date like'%~$full_date_DB%'";

      $full_date =  date('Y-M-d',strtotime($full_date_DB)).((trim($date_to) !='')?"<span class='span'> to </span>".date('Y-M-d',strtotime($date_to)):'');

     $income  = mysqli_result_(mysqli_query_("select sum(paid) from products where  ".((trim($date_to) != '')?" date BETWEEN '$full_date_DB' AND '".sanitize($date_to)."' ":" date like '%$full_date_DB%' ")."and delete_status!='1'"), 0);
     $expense  = mysqli_result_(mysqli_query_("select sum(cost) from expenses where  ".((trim($date_to) != '')?" date BETWEEN '$full_date_DB' AND '".sanitize($date_to)."' ":" date like '%$full_date_DB%' ")."and delete_status!='1'"), 0);

     $profit = $income - $expense;


 
      
$data = "<div class='reports_page'>



 <h4 class='title_'> Totals for <div class='yearly_reports_list' style='
    display: inline;
'> <input type='date' id='date_from'  value=\"$full_date_DB\"  onchange=\"chosen_report_date();\" >  


 


  <label for=\"to_input_date\"> To </label>
    <input type='checkbox'  ".(($date_to !='')?'selected_check="true"':'')." onclick=\" if($(this).next('#date_to').is(':visible')){\$(this).next('#date_to').hide();}else{
     $(this).next('#date_to').show();
  }  \" id=\"to_input_date\"> 

 <input type='date' id='date_to'  value=\"$date_to\" style=\"display: ".(($date_to !='')?'':'none').";  \" onchange=\" if($.trim($('#date_from').val()) != ''){chosen_report_date();}\">  </h4>


<div>    
 <table class='table' style='
    width: 50%;
    margin-top: 20px;
    /* margin-left: 0px; */
'> <thead> <tr><th> Income ($full_date) </th> <th> Expense ($full_date) </th><th> Profit ($full_date) </th> </tr></thead>
<tbody>
  <tr>  
       <td>  ".number_format($income,2)." </td>   <td>  ".number_format($expense,2)." </td>  <td>  <b class='".((preg_match('/-/', $profit))?'debt_color':'in_color')."'>".number_format($profit,2)."</b> </td>
  </tr>

</tbody>
 </table>
 

</div>


 
<h3 class='title_'>(<strong>".number_format(mysqli_result_(mysqli_query_("select count(id) from products where  ".((trim($date_to) != '')?" date BETWEEN '$full_date_DB' AND '".sanitize($date_to)."' ":" date like '%$full_date_DB%' ")),0))."</strong>) products sold (<i>$full_date</i>) </h3> 
</div>
  
<table class='table dataTable'  table_file='php_files/pages/server-side-tables/products.php'  other_query=\"$other_query_\" ><thead><tr><th> product </th> <th>Quantity</th><th>Price</th><th>Paid</th><th>Balance</th><th>address</th> <th>Date</th><th>Description</th> <th>Action</th>  </tr></thead> 
  <tbody>
 
  </tbody>
</table>
 ";

return $data;
 
 }








 
 
// submited 
if(isset($_POST['data'])){
  $date_from = $_POST['data']['date']['date_from'];
  $date_to =  $_POST['data']['date']['date_to'];
 
    if_logged_in('die');
     $date_full = (strtolower(trim($date_from)) == 'latest' || strtolower(trim($date_from)) == '')?mysqli_result_(mysqli_query_("SELECT `date` from products  where delete_status!='1' ORDER BY `date` DESC LIMIT 1"),0):sanitize(strtolower($date_from));
    $date_ = explode('-', $date_full);

    echo get_expense($date_[0],$date_[1],$date_[2],$date_full,sanitize(strtolower($date_to)));
 
    
}


 








?>