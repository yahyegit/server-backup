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


         $other_query_paid = ($date_to !='')?" time BETWEEN '%~$full_date_DB%' AND  '%~$date_to%' ":"time like'%~$full_date_DB%'";

        $totals = '';//get_report_totals($full_date_DB,$date_to,'');
         
        
 $pro_ = ($date_to !='')?" date BETWEEN '$full_date_DB' AND  '$date_to' ":"date like'$full_date_DB' ";
 $pro___paid = ($date_to !='')?" time BETWEEN '$full_date_DB' AND  '$date_to' ":"time like'$full_date_DB' ";
 $t_inc = mysqli_result_(mysqli_query_("select sum(paid) from payments where  $pro___paid and delete_status !='1'"));

 $t_expe_ = mysqli_result_(mysqli_query_("select sum(cost) from expenses where  $pro_ and delete_status !='1'")); 

  $proft_ = $t_inc - $t_expe_;


 
 
      
$data = "<div class='reports_page'>

  
 <table class='table ' style='
    width: 50%;background:rgba(128, 80, 162, 0.1) !important; 
    margin-top: 20px;
    margin-bottom:20px;
    /* margin-left: 0px; */
'> <thead> <tr><th class=\"title_2\"> </th> </tr></thead>
<tbody>
  <tr> <td  >
 Total Debts: <span class='debt_color'  > $".number_format(mysqli_result_(mysqli_query_("select sum(balance) from students where balance!='0' and delete_status !='1'")),2)." </span>
       
   </td>
  </tr>

</tbody>
 </table>

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

 
  
 
   
  <h3 class='title_'>  Totals for <i>($full_date)</i>  </h3> 

 <table class='table ' style='
    width: 50%;background:rgba(128, 80, 162, 0.1) !important; 
    margin-top: 20px;
    margin-bottom:20px;
    /* margin-left: 0px; */
'> <thead> <tr><th> Total income </th> <th> Total expense </th><th> profit </th> </tr></thead>
<tbody>
  <tr> <td  >
 $".number_format($t_inc,2)."
       
   </td> <td  >
 $".number_format($t_expe_ ,2)."
       
   </td>

    <td class='".((preg_match('/-/', $proft_))?'debt_color':'in_color')."' >
 $".number_format($proft_,2)."
       
   </td>


  </tr>

</tbody>
 </table>

 

    <h3 class='title_'>  incomes for <i>($full_date)</i>  </h3> 

 
 
 
 <table  class='table dataTable' other_query=\"$other_query_paid\" table_file='php_files/pages/server-side-tables/payment_history.php' ><thead>   <th> paid </th><th>date</th><th>Description</th>   </tr></thead>
<tbody>
 </tbody></table> 



  <h3 class='title_' style=\"
    margin-top: 147px;
\" >  Expenses for <i>($full_date)</i>  </h3> 
    <button  style=\"
    margin-left:  ; font-size: 13px;
\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"get_template.customers('','transction_form','pages/forms/expense_form.php');\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\"> Add Expense </span></button> 

 <table  class='table dataTable' other_query=\"$other_query_\" table_file='php_files/pages/server-side-tables/expenses.php' ><thead>   <th> Name </th><th>Quantity</th><th>cost</th><th>Date</th> <th>Description</th><th> Action</th></tr></thead>
<tbody>
 </tbody></table> 


 ";
 
return $data;
 
 }








 
 
// submited 
if(isset($_POST['data'])){
  $date_from = $_POST['data']['date']['date_from'];
  $date_to =  $_POST['data']['date']['date_to'];
 
    if_logged_in('die');
     $date_full = (strtolower(trim($date_from)) == 'latest' || strtolower(trim($date_from)) == '')?mysqli_result_(mysqli_query_("SELECT `time` from payments  where delete_status!='1' ORDER BY `time` DESC LIMIT 1"),0):sanitize(strtolower($date_from));
    $date_ = explode('-', $date_full);

    echo get_reports($date_[0],$date_[1],$date_[2],$date_full,sanitize(strtolower($date_to)));
 
    
}else{
}


 








?>