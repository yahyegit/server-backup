 <?php
   require '../../clasess/dataBase_class.php';
   require '../../clasess/reports_class.php';



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
  

      <p class='underline '   style=\"margin-top: 4px;\"   ><i><span>Current Out:</span></i> <b class='debt_color'>".number_format($currents['current_out']['ksh'],2)." ksh</b><span> and </span><b  class='debt_color'>\$".number_format($currents['current_out']['dollar'],2)." </b> </p>

         <p class='underline '  > <i><span>Current In:</span></i> <b  class='in_color' >".number_format($currents['current_in']['ksh'],2)." ksh </b><span> and </span><b  class='in_color' >\$".number_format($currents['current_in']['dollar'],2)." </b></p>   

 


   </td>
  </tr>

</tbody>
 </table>
 



</div>



 <h4 class='title_'> Totals for <div class='yearly_reports_list' style='
    display: inline;
'> <input type='date' id='date_from'  value=\"$full_date_DB\"  onchange=\"chosen_report_date();\" >  


 


  <label for=\"to_input_date\"> To </label>
    <input type='checkbox'  ".(($date_to !='')?'selected_check="true"':'')." onclick=\" if($(this).next('#date_to').is(':visible')){\$(this).next('#date_to').hide();}else{
     $(this).next('#date_to').show();
  }  \" id=\"to_input_date\"> 

 <input type='date' id='date_to'  value=\"$date_to\" style=\"display: ".(($date_to !='')?'':'none').";  \" onchange=\" if($.trim($('#date_from').val()) != ''){chosen_report_date();}\">  </h4>

 

 <table class='table' style='
    width: 50%;  
    margin-top: 20px;
    /* margin-left: 0px; */
'><thead><tr> <th class='title_2'> </th> </tr><tr></tr></thead>
<tbody>
  <tr> <td style='
    background: #fafbfc;
'>
   

       <p class='underline  '   style=\"margin-top: 4px;\"   ><i><span>Total Out <i>($full_date)</i></span></i> <b class='debt_color'>".number_format($totals['on_hand_ksh_total']['out'],2)." ksh</b><span> and </span><b class='debt_color' >\$".number_format($totals['on_hand_dollar_total']['out'],2)." </b> </p>

      <p class='underline  '  > <i><span>Total In <i>($full_date)</i></span></i> <b  class='in_color' >".number_format($totals['on_hand_ksh_total']['in'],2)." ksh </b><span> and </span><b  class='in_color' >\$".number_format($totals['on_hand_dollar_total']['in'],2)." </b></p>  


       
      <p class='underline  '   style=\"margin-top: 4px;\"   ><i><span> balance <i>($full_date)</i></span></i> <b class='{$totals['on_hand_balance_debt_color']['ksh']}'>".number_format($totals['on_hand_balance']['ksh'],2)." ksh</b><span> and </span><b class='{$totals['on_hand_balance_debt_color']['dollar']}' >\$".number_format($totals['on_hand_balance']['dollar'],2)." </b> </p>
     

   </td>
  </tr>

</tbody>
 </table>
 

<h3 class='title_'>(<strong>".number_format(mysqli_result_(mysqli_query_("select count(id) from transactions where ".(($date_to !='')?" date BETWEEN '$full_date_DB' AND  '$date_to' ":"date like'$full_date_DB'")." and delete_status!='1' "),0))."</strong>) Transactions (<i>$full_date</i>) </h3> 
</div>
  
<table class='table dataTable'  table_file='php_files/pages/server-side-tables/transactions_history.php'  other_query=\"$other_query_\" >
  <thead><tr><th> name </th><th> Amount </th> <th>Time</th><th>Description</th> <th>Action</th>  </tr></thead>
  <tbody>
 
  </tbody>
</table>
 ";
global $k;
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