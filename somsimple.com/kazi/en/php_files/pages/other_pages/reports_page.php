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

    $full_date =  date('Y-M-d',strtotime($full_date_DB)).((trim($date_to) !='')?"<span class='span'> to </span>".date('Y-M-d',strtotime($date_to)):'');
           
        }
          
        $other_query_ = ($date_to !='')?" date BETWEEN '%~$full_date_DB%' AND  '%~$date_to%' ":"date like'%~$full_date_DB%'";
        $totals = get_report_totals($full_date_DB,$date_to,'');
         
 
 

 $currents = get_current_totals();
      
      
$data = "<div class='reports_page'>

 



<div class='on_hand  '>    


 <table class='table' style='
    width: 50%;
    margin-top: 20px;
    /* margin-left: 0px; */
'> <thead> <tr><th class=\"title_2\"> </th> </tr></thead>
<tbody>
  <tr> <td style='
    background: #fafbfc;
'>
  

      <p class='underline '   style=\"margin-top: 4px;\"   ><i><span>Current debt:</span></i> <b class='debt_color'>".number_format($currents['current_out']['ksh'],2)." ksh</b><span> and </span><b  class='debt_color'>\$".number_format($currents['current_out']['dollar'],2)." </b> </p>

         <p class='underline '  > <i><span>Current Credit:</span></i> <b  class='in_color' >".number_format($currents['current_in']['ksh'],2)." ksh </b><span> and </span><b  class='in_color' >\$".number_format($currents['current_in']['dollar'],2)." </b></p>   

 


   </td>
  </tr>

</tbody>
 </table>
 



</div>



 <h4 class='title_'> Totals for <div class='yearly_reports_list' style='
    display: inline;
'> <input type='date' id='date_from'  value=\"$full_date_DB\"  onchange=\"chosen_report_date();\" >  


 


  <label for=\"to_input_date\"> To </label>
    <input type='checkbox'  ".(($date_to !='')?'selected_check="true"':'')." onclick=\" if($(this).next('#date_to').is(':visible')){\$(this).next('#date_to').val('').hide();chosen_report_date();}else{
     $(this).next('#date_to').show();
  }  \" id=\"to_input_date\"> 

 <input type='date' id='date_to'  value=\"$date_to\" style=\"display: ".(($date_to !='')?'':'none').";  \" onchange=\" if($.trim($('#date_from').val()) != ''){chosen_report_date();}\">  </h4>

 
 

<div class=\"open_cash\">    


 <table class=\"table\" style=\"
    width: 50%;    border: 0.5px solid #7c11a2; 
    margin-top: 20px;
    /* margin-left: 0px; */
\"> <thead> <tr><th class=\"title_2\"> Open Cash <i>($full_date)</i> </th> </tr></thead>
<tbody>
  <tr> <td style=\"
    background: #fafbfc;
\"> 
  

    
".((ctype_digit($totals['open']['id']))?"
        <p class=\"underline \"> <i><span>Open cash :</span></i> <b class=\"\">".number_format($totals['open']['amount_ksh'],2)." ksh </b><span> and </span><b class=\"\"> $".number_format($totals['open']['amount_dollar'],2)." </b>    

".((!empty($date_to))?'':"<button class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"
           request_template('',{id:{$totals['open']['id']},amount_ksh:{$totals['open']['amount_ksh']},date:'$full_date_DB',amount_dollar:{$totals['open']['amount_dollar']}},'pages/forms/open_day_form.php');\" role=\"button\" aria-disabled=\"false\" style=\"font-size: 11px;\"><span class=\"ui-button-icon-primary ui-icon ui-icon-pencil\"></span><span class=\"ui-button-text\">Edit </span></button>")."

          </p> 
 
<p class=\"underline \"> <i><span>Open cash balance :</span></i> <b class=\"".toggle_debt_color($totals['open']['amount_ksh_balance'])."\">".number_format($totals['open']['amount_ksh_balance'],2)." ksh </b><span> and </span><b class=\"".toggle_debt_color($totals['open']['amount_dollar_balance'])."\">$".number_format($totals['open']['amount_dollar_balance'],2)." </b>     </p>



 ":" <button class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"
           request_template('','','pages/forms/open_day_form.php');\" role=\"button\" aria-disabled=\"false\" style=\"font-size: 11px;\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\">Add Open Cash </span></button>")."


   </td>
  </tr>

</tbody>
 </table>
 



</div>






 <table class='table' style='
    width: 50%; 
    border: 0.5px solid #7c11a2; 
    margin-top: 20px;
    /* margin-left: 0px; */
'><thead><tr> <th class='title_2'> Transaction totals <i>($full_date)</i> </th> </tr><tr></tr></thead>
<tbody>
  <tr> <td style='
    background: #fafbfc;
'>
   
      <p class='underline  '  > <i><span>Total In </span></i> <b  class='in_color' >".number_format($totals['on_hand_ksh_total']['in'],2)." ksh </b><span> and </span><b  class='in_color' >\$".number_format($totals['on_hand_dollar_total']['in'],2)." </b></p>  

       <p class='underline  '   style=\"margin-top: 4px;\"   ><i><span>Total Out </span></i> <b class='debt_color'>".number_format($totals['on_hand_ksh_total']['out'],2)." ksh</b><span> and </span><b class='debt_color' >\$".number_format($totals['on_hand_dollar_total']['out'],2)." </b> </p>

       
      <p class='underline  '   style=\"margin-top: 4px;\"   ><i><span> balance </span></i> <b class='{$totals['on_hand_balance_debt_color']['ksh']}'>".number_format($totals['on_hand_balance']['ksh'],2)." ksh</b><span> and </span><b class='{$totals['on_hand_balance_debt_color']['dollar']}' >\$".number_format($totals['on_hand_balance']['dollar'],2)." </b> </p>
     

   </td>
  </tr>

</tbody>
 </table>
 

 
<h3 class='title_'>(<strong>".number_format(mysqli_result_(mysqli_query_("select count(id) from transactions where ".(($date_to !='')?" date BETWEEN '$full_date_DB' AND  '$date_to' ":"date like'$full_date_DB'")." and delete_status!='1' "),0))."</strong>) Transactions (<i>$full_date</i>) </h3> 
</div>
  
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