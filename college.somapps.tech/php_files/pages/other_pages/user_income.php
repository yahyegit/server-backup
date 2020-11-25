
 <?php
   include '../../clasess/db_connector.php';

    require '../../clasess/reports_class.php';

    require '../../global_functions/toggle_debt_or_in_color.php';



function get_exp_totols($date,$user_id){
$t = '   <div  class="bl_list  "  >';
$tq = mysqli_query_("select distinct type from expenses where  date like '%$date%' and delete_status!='1' and user_id='$user_id'  ");
  while ($qq = mysqli_fetch_assoc_($tq)){
    
    $t .= "<div> Total <b>{$qq['type']}:</b> $".number_format(mysqli_result_(mysqli_query_("select sum(cost) from expenses where type='{$qq['type']}' and  date like '%$date%' and delete_status!='1' and user_id='$user_id' "),0),2)."</div>"; 


  }
return $t."</div>";

}




 function get_report_user($data){ // y,m,d
         $date = (!ctype_digit(sanitize($data['date'])))?date('Y-m',strtotime($data['date'].'-01')):sanitize($data['date']);
     $date_ = (!ctype_digit(sanitize($data['date'])))?date('Y-M',strtotime($data['date'].'-01')):sanitize($data['date']);
     $user_id = sanitize($data['user_id']);
    $username = mysqli_result_(mysqli_query_("select username from users where id=$user_id"),0);
 $discounts_ = mysqli_result_(mysqli_query_("select sum(discount) from payments where date like '%$date%' and delete_status!='1' and taken_by=$user_id  "),0);

 $fee_ = mysqli_result_(mysqli_query_("select sum(amount) from payments where date like '%$date%' and description='registration fee' and delete_status!='1' and taken_by=$user_id "),0);

$other_p_ = mysqli_result_(mysqli_query_("select sum(amount) from payments where date like '%$date%' and description like '%*_%' and delete_status!='1' and taken_by=$user_id "),0);


  

      $expense_ = mysqli_result_(mysqli_query_("select sum(cost) from expenses where date like '%$date%' and delete_status!='1' and user_id=$user_id  "),0);
      $paid_ = mysqli_result_(mysqli_query_("select sum(amount) from payments where date like '%$date%' and delete_status!='1' and taken_by=$user_id  
        "),0);


      $profit = $paid_ - $expense_;
 
$list = get_list(explode('-', $date),$user_id);

 

$data = " <script type='text/javascript' > 

   
  
        $('.inco_linkd').click();
    $( \"#report_tabs\" ).tabs();

    </script> <br>




<div class='reports_page'>



<div class='title_ ' style='font-weight:normal !important;' >  
     Reports for <b style='font-weight:bold !important;'>$username</b> on
     <div style='font-weight:bold !important; display:inline'>
        <div style='display:inline;' class='debt_color years'> <select class='year_income' onchange=\" chosen_date_(); \"  ".(($list['y'] < 9)?'':"remove_filter='true'" )." > ".$list['y_']." </select> </div>


           <label class='float_label debt_color '> month </label> <div   style='display:inline;'  class='months'> <select class='month_income debt_color'  onchange=\" chosen_date_(); \" remove_filter='true' > ".$list['m_']." </select> </div> 
</div>

</div>
<br>
  <table  class='table  '    ><thead><tr> 
                    <th>Income </th> <th>Expense</th>   <th>Profit </th>  
               </tr>
              </thead> 
              <tbody>
               <tr><td>  $".number_format($paid_,2)." </td>   <td>   $".number_format($expense_,2)."</td> <td style='".((preg_match('/-/', $profit ))?'color:red;':'color:green;')."'> $".number_format($profit,2)." </td> </tr>
              </tbody>
  </table>


<div id='report_tabs' style='margin-top:20px;'>

 <ul style=\"
   
\" >  
       
          
       
           <li> <a href='#paid_'> Incomes </a> </li> 
            <li> <a href='#expense_'> Expenses  </a> </li> 
 

      </ul>
 

  <div id='paid_'>



 
 
  <table  class='table  '  style=\"
    width: 81%;
    margin-left: 0;    margin-bottom: 12px;
\"  > 
               
              <tbody>
               <tr> <th style=\"
    text-align: right;
\" >Total discounts </th><td>  $".number_format($discounts_,2)." </td>  <th  style=\"
    text-align: right;
\">Total registration fee </th><td>  $".number_format($fee_,2)." </td> 
<th  style=\"
    text-align: right;
\">Total other payments </th><td>  $".number_format($other_p_,2)." </td> 

 
</tr>
              </tbody>
  </table>
      <table  class='table dataTable'  other_query=\"date like '~$date~'  and taken_by=$user_id \"table_file='php_files/pages/server-side-tables/payment_history.php' ><thead><tr>  <th>Name</th> 
                    <th>Paid</th>     <th>discount</th>     <th>taken by</th>      <th>date</th>    
               </tr>
              </thead> 
              <tbody>
               
              </tbody>
              </table>

  </div>
  

  <div id='expense_'>

  

".get_exp_totols($date,$user_id)."





  <button  style=\"
    margin-left: 1%;
\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"request_template('','','pages/forms/expense_form.php'); \" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\"> Add expense </span></button> 
 

   <table  class='table dataTable'  other_query=\"date like '~$date~' and user_id=$user_id \"   table_file='php_files/pages/server-side-tables/expenses.php' ><thead><tr> 
                      <th>expense name</th>   <th>category</th>     <th> cost </th>    <th>Description</th>    <th>date</th>   <th>action </th>
                 </tr>
                </thead> 
                <tbody>
                 
                </tbody>
                </table>

  </div>


</div>



 
 ";
 
return $data;
 
 }


 



 

// submited 
if(isset($_POST['data'])){
    if_logged_in('die');
    if (is_admin($current_user)) {

 if (empty($_POST['data']['date'])) {
    $user_id =  sanitize($_POST['data']['id']);

     $date = sanitize($_POST['data']['date']);

 
     $date = (empty($date))?mysqli_result_(mysqli_query_("select date from payments where taken_by=$user_id and delete_status!='1' ORDER BY date DESC LIMIT 1 "),0):$date;
 
     $date = (empty($date))?mysqli_result_(mysqli_query_("select date from expenses where user_id=$user_id and delete_status!='1' ORDER BY date DESC LIMIT 1 "),0):$date;

 
     $date = explode('-', $date);
       $date =   $date[0].'-'.$date[1];   
}else{
   $date  = $_POST['data']['date'];
}




         echo get_report_user(array('date'=>$date,'user_id'=>$user_id));




    }


}

?>