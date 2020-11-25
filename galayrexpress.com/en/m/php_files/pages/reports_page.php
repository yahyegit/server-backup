 <?php
   require '../../clasess/dataBase_class.php';
  
     if_logged_in('die');


 function get_reports($year,$month,$day,$full_date_DB,$date_to){ // y,m,d
        $full_date_DB = sanitize($full_date_DB);

global $current_user;



              if (is_admin($current_user)) {
              $sent_idx = " ";
        $paid_idx = " ";
    }else{

        $s_idx = " and user_id='$current_user' ";
        $p_idx = " and paid_user_id='$current_user' ";
    }


        if(empty($month) || empty($month) == '-'){ // yealy
            $full_date = $full_date_DB; 
        
        }else if(empty($day)){ // monthly 
            $full_date =  date('Y-M',strtotime($full_date_DB."-1")); 
    
        }else{  // daily 

    $full_date =  date('d-M-Y',strtotime($full_date_DB)).((trim($date_to) !='')?"<span class='span'> to </span>".date('d-M-Y',strtotime($date_to)):'');
           
        }
          
        $other_query_ = ($date_to !='')?" sent_date BETWEEN '%~$full_date_DB%' AND  '%~$date_to%' ":"sent_date like'%~$full_date_DB%'";
          
 
            
$data = "<div class='reports_page'>
 
 <h4 class='title_'> Report for <div class='yearly_reports_list' style='
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
   

       <p class='underline  '   style=\"margin-top: 4px;\"   > <label class=\"show_ float_label\" >Total sent <i>($full_date)</i></label> <b class=' '>$".
number_format(mysqli_result_(mysqli_query_("select sum(amount) from payments where ".(($date_to !='')?" sent_date BETWEEN '$full_date_DB' AND  '$date_to'  ":"sent_date like'$full_date_DB'")." and delete_status!='1' $s_idx "),0),2)."  </b>  </p>

    <p class='underline  '   style=\"margin-top: 4px;\"   > <label class=\"show_ float_label\" > Total payments <i>($full_date)</i></label>  <b class=' '>$".
number_format(mysqli_result_(mysqli_query_("select sum(amount) from payments where ".(($date_to !='')?" status='paid' and sent_date BETWEEN '$full_date_DB' AND  '$date_to'  ":"  status='paid' and  sent_date like'$full_date_DB'")." and delete_status!='1' $p_idx "),0),2)."  </b>  </p>
       
    <p class='underline  '   style=\"margin-top: 4px;\"   > <label class=\"show_ float_label\" >  Balance <i>($full_date)</i></label>  <b class=' '>$".
number_format(mysqli_result_(mysqli_query_("select sum(amount) from payments where ".(($date_to !='')?" sent_date BETWEEN '$full_date_DB' AND  '$date_to'  ":"sent_date like'$full_date_DB'")." and delete_status!='1' $s_idx "),0) - mysqli_result_(mysqli_query_("select sum(amount) from payments where ".(($date_to !='')?" status='paid' and sent_date BETWEEN '$full_date_DB' AND  '$date_to'  ":"  status='paid' and  sent_date like'$full_date_DB'")." and delete_status!='1' $p_idx "),0),2)."  </b>  </p>
    
       <p class='underline  '   style=\"margin-top: 4px;\"   > <label class=\"show_ float_label\" >Total commission <i>($full_date)</i></label> <b  style='color:green;'>$".
number_format(mysqli_result_(mysqli_query_("select sum(commission) from payments where ".(($date_to !='')?" sent_date BETWEEN '$full_date_DB' AND  '$date_to'  ":"sent_date like'$full_date_DB'")." and delete_status!='1' $s_idx "),0),2)."  </b>  </p>
   </td>
  </tr>

</tbody>
 </table>
 

<h3 class='title_'>(<strong>".number_format(mysqli_result_(mysqli_query_("select count(id) from payments where ".(($date_to !='')?" sent_date BETWEEN '$full_date_DB' AND  '$date_to'  ":"sent_date like'$full_date_DB'")." and delete_status!='1' $s_idx "),0))."</strong>)  sent money for (<i>$full_date</i>) </h3> 
 

 <table  class='table dataTable'  other_query=\"$other_query_ $s_idx\"   table_file='php_files/pages/server-side-tables/all_payments.php' ><thead> <tr>    <th>  Refrence No </th> <th> Pay to </th>  <th> Amount </th>   <th> commission  </th> <th> Status </th> <th> Sender </th>   <th> Description </th>  <th> Action </th>   </tr> </thead>
<tbody>
 </tbody></table>


<h3 class='title_'>(<strong>".number_format(mysqli_result_(mysqli_query_("select count(id) from payments where ".(($date_to !='')?" status='paid' and sent_date BETWEEN '$full_date_DB' AND  '$date_to'  ":"  status='paid' and sent_date like'$full_date_DB'")." and delete_status!='1' $p_idx "),0))."</strong>)  payments for (<i>$full_date</i>) </h3> 
 

 <table  class='table dataTable'  other_query=\"$other_query_ and  status='paid' $p_idx \"   table_file='php_files/pages/server-side-tables/all_payments.php' ><thead> <tr>    <th>  Refrence No </th> <th> Pay to </th>  <th> Amount </th>   <th> commission  </th> <th> Status </th> <th> Sender </th>   <th> Description </th>  <th> Action </th>   </tr> </thead>
<tbody>
 </tbody></table>
 </div>
 ";
global $k;
return $data;
 
 }








 
 
// submited 
 
if(isset($_POST['data'])){
  $date_from = $_POST['data']['date']['date_from'];
  $date_to =  $_POST['data']['date']['date_to'];

     $date_full = (strtolower(trim($date_from)) == 'latest' || strtolower(trim($date_from)) == '')?mysqli_result_(mysqli_query_("SELECT sent_date from payments  where delete_status!='1' ORDER BY `sent_date` DESC LIMIT 1"),0):sanitize(strtolower($date_from));
    $date_ = explode('-', $date_full);

    echo get_reports($date_[0],$date_[1],$date_[2],$date_full,sanitize(strtolower($date_to)));
 
    
}


 








?>
