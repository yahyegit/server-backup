 <?php
   include '../../clasess/db_connector.php';

    require '../../clasess/reports_class.php';

    require '../../global_functions/toggle_debt_or_in_color.php';


 function get_reports($year,$month,$day,$full_date_DB,$date_to){ // y,m,d
        $full_date_DB = sanitize($full_date_DB);

        if(empty($month) || empty($month) == '-'){ // yealy
            $full_date = $full_date_DB; 
        
        }else if(empty($day)){ // monthly 
            $full_date =  date('Y-M',strtotime($full_date_DB."-1")); 
    
        }else{  // daily 

    $full_date =  date('d-M-Y',strtotime($full_date_DB)).((trim($date_to) !='')?"<span class='span'> to </span>".date('d-M-Y',strtotime($date_to)):'');
           
        }
          
        $other_query_ = ($date_to !='')?" date BETWEEN '%~$full_date_DB%' AND  '%~$date_to%' ":"date like'%~$full_date_DB%'";
        $totals = '';//get_report_totals($full_date_DB,$date_to,'');
         
 
 
 $open_day_totals = current_balance_all_ksh(array('date' =>$full_date_DB ,'date_to'=>$date_to));

 $currents = get_current_totals();
      
      
$data = "<div class='reports_page'>


<div class='on_hand '>    
 <table class='table' style='
    width: 50%;background:rgba(128, 80, 162, 0.1) !important; 
    margin-top: 20px;
    /* margin-left: 0px; */
'> <thead> <tr><th class=\"title_2\"> </th> </tr></thead>
<tbody>
  <tr> <td style='
    background: #fafbfc;
'>
  
      <p class='underline '   style=\"margin-top: 4px;\"   ><i><span class='gray' >Current Debt:</span></i> <b class='debt_color'>ksh".number_format($currents['current_out']['ksh'],2)."</b><span class='hr_'>   </span><b  class='debt_color'>\$".number_format($currents['current_out']['dollar'],2)." </b> </p>

         <p class='underline '  > <i><span class='gray'>Current Credit:</span></i> <b  class='in_color' >ksh".number_format($currents['current_in']['ksh'],2)." </b><span class='hr_'> </span><b  class='in_color' >\$".number_format($currents['current_in']['dollar'],2)." </b></p>   

 
   </td>
  </tr>

</tbody>
 </table>

</div>


 <h4 class='title_' style=\"
    margin-bottom: 15px;
\" > Report date <div class='yearly_reports_list' style='
    display: inline;
'> <input type='date' id='date_from'  value=\"$full_date_DB\"  onchange=\"chosen_report_date();\" >  
  <label for=\"to_input_date\"> To </label>
    <input type='checkbox'  ".(($date_to !='')?'selected_check="true"':'')." onclick=\" if($(this).next('#date_to').is(':visible')){\$(this).next('#date_to').val('').hide();chosen_report_date();}else{
     $(this).next('#date_to').show();
  }  \" id=\"to_input_date\"> 

 <input type='date' id='date_to'  value=\"$date_to\" style=\"display: ".(($date_to !='')?'':'none').";  \" onchange=\" if($.trim($('#date_from').val()) != ''){chosen_report_date();}\">  </h4>

 
 
 



<!----open day with totals ----->
<table class='table ' style=\"
    ".(empty($date_to)?'display:none !important;':'')."
    width: 70%; background:rgba(128, 80, 162, 0.1) !important; 
    margin-bottom: 24px;
\">
  <thead><tr><th>Total open cash (<i>$full_date</i>) </th> <th>Total open cash balance (<i>$full_date</i>)</th>  </tr></thead>
  <tbody>
       <tr>
          <td> ksh".number_format($open_day_totals['open_totals']['amount_ksh'])." <span class='hr_'></span> $".number_format($open_day_totals['open_totals']['amount_dollar'])."  </td>
              <td> ksh <span class='".toggle_debt_color($open_day_totals['balance_ksh'])."'>".number_format($open_day_totals['balance_ksh'])." </span> </td>
       </tr>
  </tbody>
</table>

<table class='table dataTable ' id='open_day_table' table_file='php_files/pages/server-side-tables/open_day_table.php'  other_query=\"$other_query_\" >
  <thead><tr><th>Title</th><th>Date</th><th>Open cash</th> <th>Open cash Balance</th> <th>Rate</th><th> Action</th> </tr></thead>
  <tbody>
 
  </tbody>
</table>
 

 
 
<h3 class='title_'> Transaction totals <i>($full_date)</i>    </h3> 

 <table class='table' style='
    width: 90%; 
    border: 0.5px solid #7c11a2; 
     /* margin-left: 0px; */
'><thead><tr> <th> Total ksh in </th> <th> Total ksh Out </th> <th> ksh balance </th>  <th> Total dollar In </th> <th> Total dollar Out </th> <th> Dollar balance </th> </tr></thead>
<tbody>
  <tr>
   <td>ksh".number_format($open_day_totals['total_ksh_in'],2)." </td>
   <td>ksh".number_format($open_day_totals['total_ksh_out'],2)." </td>
   <td>ksh<span class='".toggle_debt_color($open_day_totals['total_ksh_balance'])."'>".number_format($open_day_totals['total_ksh_balance'],2)." </span></td>

   <td>$".number_format($open_day_totals['total_dollar_in'],2)." </td>
   <td>$".number_format($open_day_totals['total_dollar_out'],2)." </td>
   <td>$<span class='".toggle_debt_color($open_day_totals['total_dollar_balance'])."'>".number_format($open_day_totals['total_dollar_balance'],2)." </span></td>
   
  </tr>

</tbody>
 </table>
 
<h3 class='title_'>(<strong>".number_format(mysqli_result_(mysqli_query_("select count(id) from transactions where ".(($date_to !='')?" date BETWEEN '$full_date_DB' AND  '$date_to' ":"date like'$full_date_DB'")." and delete_status!='1' "),0))."</strong>) Transactions (<i>$full_date</i>) </h3> 
 
<table class='table dataTable'  table_file='php_files/pages/server-side-tables/transactions_history.php'  other_query=\"$other_query_\" >
  <thead><tr><th> Name </th> <th> cash in </th> <th> cash out </th> <th>  balance </th> <th> dollar in </th> <th> dollar out </th> <th>  balance </th> <th>Date</th><th>Description</th> <th>Action</th>  </tr></thead>
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
     $date_full = (strtolower(trim($date_from)) == 'latest' || strtolower(trim($date_from)) == '')?mysqli_result_(mysqli_query_("SELECT `date` from transactions  where delete_status!='1' ORDER BY `date` DESC LIMIT 1"),0):sanitize(strtolower($date_from));
    $date_ = explode('-', $date_full);

    echo get_reports($date_[0],$date_[1],$date_[2],$date_full,sanitize(strtolower($date_to)));
 
    
}


 








?>