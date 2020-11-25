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

      $full_date =  date('d-M-Y',strtotime($full_date_DB)).((trim($date_to) !='')?"<span class='span' style=\"font-weight:normal;\"> to </span>".date('d-M-Y',strtotime($date_to)):'');    
      $full_date = "<strong>$full_date</strong>";
        }
          
        $other_query_ = ($date_to !='')?" date BETWEEN '%~$full_date_DB%' AND  '%~$date_to%' ":"date like'%~$full_date_DB%'";
        $totals = '';//get_report_totals($full_date_DB,$date_to,'');
         
 
 
 $open_day_totals = current_balance_all_ksh(array('date' =>$full_date_DB ,'date_to'=>$date_to));

 $currents = get_current_totals();
      
       

      $bl = '<p class="underline" style="
    margin-top: 1px;
"><span class="gray">Total In:</span><span> ksh'.number_format($open_day_totals['total_ksh_in'],2).'</span>   <span  class=\'hr_\'>  </span>   <span>$'.number_format($open_day_totals['total_dollar_in'],2).'</span></p>'; //total in



      $bl .=  '<p class="underline"><span class="gray">Total Out:</span><span> ksh'.number_format($open_day_totals['total_ksh_out'],2).'</span>   <span  class=\'hr_\'>  </span>   <span>$'.number_format($open_day_totals['total_dollar_out'],2).'</span></p>';  

       $bl .= '<p class="underline"><span  class="gray" > Balance:</span><span class='.toggle_debt_color($open_day_totals['total_ksh_balance']).'>ksh'.number_format($open_day_totals['total_ksh_balance'],2).'  </span>   <span  class=\'hr_\'>  </span>   <span class='.toggle_debt_color($open_day_totals['total_dollar_balance']).'>$'.number_format($open_day_totals['total_dollar_balance'],2).'</span></p>';

  



      $bl_ = '<p class="underline" style="
    margin-top: 1px;
"><span class="gray">Total open cash:</span><span> ksh'.number_format($open_day_totals['open_totals']['amount_ksh'],2).'</span>   <span  class=\'hr_\'>  </span>   <span>$'.number_format($open_day_totals['open_totals']['amount_dollar'],2).'</span></p>'; //total in


 
       $bl_ .= '<p class="underline"><span  class="gray" > Total open cash Balance:</span><span class='.toggle_debt_color($open_day_totals['balance_ksh']).'>ksh'.number_format($open_day_totals['balance_ksh'],2).'  </span> </p>';

$data = "<div class='reports_page'>

 



<div class='on_hand  '>    


 <table class='table' style='
    width: 90%;background:rgba(128, 80, 162, 0.1) !important; 
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



 <h4 class='title_'> Report date: <div class='yearly_reports_list' style='
    display: inline;
'> <input type='date' id='date_from'  value=\"$full_date_DB\"  onchange=\"chosen_report_date();\" >  


 


  <label for=\"to_input_date\"> To </label>
    <input type='checkbox'  ".(($date_to !='')?'selected_check="true"':'')." onclick=\" if($(this).next('#date_to').is(':visible')){\$(this).next('#date_to').val('').hide();chosen_report_date();}else{
     $(this).next('#date_to').show();
  }  \" id=\"to_input_date\"> 

 <input type='date' id='date_to'  value=\"$date_to\" style=\"display: ".(($date_to !='')?'':'none').";  \" onchange=\" if($.trim($('#date_from').val()) != ''){chosen_report_date();}\">  </h4>

 
 






<!----open day with totals ----->
 
 
 <table class='table dashboard_panel' style='".((empty($date_to))?'display:none !important;':'')." margin-top:20px;'><thead><tr> <th>Open cash totals <i>($full_date)</i> </th></tr></thead>
<tbody><tr> <td>$bl_</td>  </tr></tbody>
 </table>

<table class='table dataTable ' id='open_day_table' table_file='php_files/pages/server-side-tables/open_day_table.php'  other_query=\"$other_query_\" >
  <thead><tr><th>Open Cash</th></tr></thead>
  <tbody>
 
  </tbody>
</table>
 

 
 <table class='table dashboard_panel' ><thead><tr> <th>Transaction totals <i>($full_date)</i> </th></tr></thead>
<tbody><tr> <td>$bl</td>  </tr></tbody>
 </table>
 
 

<h3 class='title_'  style=\"color:gray !important; font-weight:normal !important;\" >( <span style=\"font-weight:bold;\"> ".number_format(mysqli_result_(mysqli_query_("select count(id) from transactions where ".(($date_to !='')?" date BETWEEN '$full_date_DB' AND  '$date_to' ":"date like'$full_date_DB'")." and delete_status!='1' "),0))."</strong>)</span> Transactions (<i>$full_date</i>) </h3> 
</div>
  
<table class='table dataTable'  table_file='php_files/pages/server-side-tables/transactions_history.php'  other_query=\"$other_query_\" >
  <thead><tr> <th>transactions</th>  </tr></thead>
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





 