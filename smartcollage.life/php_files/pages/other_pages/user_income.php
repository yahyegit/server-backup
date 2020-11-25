<?php
    include '../../clasess/db_connector.php';

   require '../../clasess/reports_class.php';

function get_history($data){
  global $current_user;
  
  $data['id'] = $current_user;

  $date = (!ctype_digit(sanitize($data['date'])))?date('Y-m',strtotime($data['date'].'-01')):sanitize($data['date']);
     $date_ = (!ctype_digit(sanitize($data['date'])))?date('Y-M',strtotime($data['date'].'-01')):sanitize($data['date']);

 
    
 $list = get_list(explode('-',$date),$data['id']);

  return "<h3 class='title_'> income for ".mysqli_result_(mysqli_query_("select  username from users where id='{$data['id']}' and delete_status!='1'  "), 0)." ($date_) </h3>
 
         




 <table class='table  ' style='
    width: 50%;background:rgba(128, 80, 162, 0.1) !important; 
    margin-top: 20px;
    margin-bottom:20px;
    /* margin-left: 0px; */
'> <thead> <tr><th class=\"title_2\"> </th> </tr></thead>
<tbody>
  <tr><th style='font-weight:bold !important;  text-align:right'>totol income</th> <td>
 $".number_format(mysqli_result_(mysqli_query_("select sum(amount) from payments where  taken_by='{$data['id']}' and `date` like'%$date%' and delete_status !='1'")),2)."   
     
   </td>
  </tr>
  <tr><th style='font-weight:bold !important; text-align:right'>totol Discount</th> <td>
 $".number_format(mysqli_result_(mysqli_query_("select sum(discount) from payments where  taken_by='{$data['id']}' and date like '%$date%' and delete_status !='1'")),2)."   
     
   </td>
  </tr>
</tbody>
 </table>
 
 
 <div>  
    
      <label class='float_label show_'> Date </label>  <div style='display:inline;' class='years'> <select class='year_income' onchange=\" chosen_date_(); \"    > ".$list['y_']." </select> </div>


           <label class='float_label'> month </label> <div   style='display:inline;'  class='months'> <select class='month_income'  onchange=\" chosen_date_(); \" remove_filter='true' > ".$list['m_']." </select> </div> 

</div>



               <table  class='table dataTable '  other_query=\"taken_by=$current_user and date like '~$date~' \"  table_file='php_files/pages/server-side-tables/payment_history.php' ><thead><tr> 
                    <th>Paid</th>     <th>discount</th>     <th>taken by</th>      <th>date</th>     <th>description</th>    
               </tr>
              </thead> 
              <tbody>
               
              </tbody>
              </table>
 

</body></html>
";

}

// submited 
if(isset($_POST['data'])){
    if_logged_in('die');
    if (is_admin($current_user)) {

 if (empty($_POST['data']['date'])) {
     $date = mysqli_result_(mysqli_query_("select date from payments where delete_status!='1' ORDER BY date DESC LIMIT 1 "));
     $date = explode('-', $date);
       $date =   $date[0].'-'.$date[1];   
}else{
   $date  = $_POST['data']['date'];
}




         echo get_history(array('date'=>$date));
    }


}

?>