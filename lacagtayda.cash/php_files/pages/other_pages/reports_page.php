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
         
 
 


        
 $pro_ = ($date_to !='')?" date BETWEEN '$full_date_DB' AND  '$date_to' ":"date like'$full_date_DB' ";

 $debt_val = get_credit_debt('debt')['value'];
 $credit_val = get_credit_debt('credit')['value'];
      
    

$in_type = get_totals_($pro_,'in');
$out_type = get_totals_($pro_,'out');
$bl_type = get_totals_($pro_,'bl');
 $bl_row  = '';
   for ($i=0; $i <  count($in_type['in']); $i++){ 

 $oi =  ( floatval(explode(' ', $in_type['in'][$i])[1]) + floatval(explode(' ', $out_type['out'][$i])[1])) + floatval(explode(' ', $bl_type['bl'][$i])[1]);




      if ($oi) { 
 



        $in_type['in'][$i] = str_replace(' ','', $in_type['in'][$i]);
        $out_type['out'][$i] = str_replace(' ','', $out_type['out'][$i]);
        $bl_type['bl'][$i] = str_replace(' ','', $bl_type['bl'][$i]);



         $bl_row .= "<tr><td><div class=\"bl_list\"><div class='". ((preg_match('/-/',$in_type['in'][$i]))?'debt_color':'in_color')."'   >{$in_type['in'][$i]}</div></td> <td><div class=\"bl_list\"><div class='". ((preg_match('/-/',$out_type['out'][$i]))?'debt_color':'in_color')."'   >{$out_type['out'][$i]}</div></td> <td><div class=\"bl_list\"><div class='". ((preg_match('/-/',$bl_type['bl'][$i]))?'debt_color':'in_color')."'   >{$bl_type['bl'][$i]}</div></td>  </tr>"; 
      }

   }


  

  $data = "<div class='reports_page'>


<div class='on_hand '>    
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

 
  
 

 
 
<h3 class='title_'> Transaction totals <i>($full_date)</i>    </h3> 
 
 
<table class='table grid_1 c_ac_page' > <thead><tr><th>Total In </th> <th> Total Out </th><th> Balance </th></tr></thead><tbody>   $bl_row </tbody></table>
 
<table class='table c_ac_page' style=\"
    border-top: 3px solid #8050a2;
    margin-top: 28px;
\"> <tr><th>Forex Profits </th> <td> ".get_profit($pro_)
."  </td></tr> </table>
     
 

<h3 class='title_'>(<strong>".number_format(mysqli_result_(mysqli_query_("select count(id) from transactions where ".(($date_to !='')?" date BETWEEN '$full_date_DB' AND  '$date_to' ":"date like'$full_date_DB'")." and delete_status!='1' "),0))."</strong>) Transactions (<i>$full_date</i>) </h3> 
 
<table class='table dataTable'  table_file='php_files/pages/server-side-tables/transactions_history.php'  other_query=\"$other_query_\" >
<thead><tr><th> name </th><th> Amount </th> <th>Date</th><th>Description</th> <th>Action</th>  </tr></thead> 
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
