<?php
 include '../../clasess/db_connector.php';
 require '../../global_functions/toggle_debt_or_in_color.php';
 require '../../clasess/reports_class.php';

function  get_customer_account($data){
	   		  $data = clean_security($data);
			  $customer_id = $data['customer_id'];
 
 			if(empty($data['date_from'])){
 				// all 
              $full_date =  '';

              $other_query_ = " customer_id='$customer_id' ";
               $other_query_2 = "";

              $totals = get_report_totals('','',$customer_id);

 			}else{
              $full_date =  date('Y-M-d',strtotime($data['date_from'])).((trim($data['date_to']) !='')?"<span class='span'> to </span>".date('Y-M-d',strtotime($data['data[\'date_to\']'])):'');

              $other_query_ = ($data['date_to'] !='')?" date BETWEEN '%~{$data['date_from']}%' AND  '%~{$data['date_to']}%'  ":"date like'%~{$data['date_from']}%'  ";
 			  $other_query_2 = " customer_id='$customer_id' ";

 			  $totals = get_report_totals($data['date_from'],$data['date_to'],$customer_id);

 			}


 if(mysqli_result_(mysqli_query_("SELECT customer_id FROM customers WHERE  `delete_status`!='1' AND `customer_id`=$customer_id"), 0) == '0'){ 
 		die('login');
	} // check if account is deleted

   $cust_info =  mysqli_fetch_assoc_(mysqli_query_("select customer_id, current_ksh_balance,current_dollar_balance,mobile,customer_name from customers where customer_id='$customer_id' and delete_status!='1'"));
 
$trans_length = mysqli_result_(mysqli_query_("SELECT count(`id`) FROM `transactions` WHERE `delete_status`!='1' AND `customer_id`=$customer_id"), 0);



$rt = "
 <table class=\"table\"><thead><tr> <th>name</th> <th>mobile</th> <th>Current Balance</th> <th>Action</th>  </tr><tr></tr></thead>
<tbody>
<tr> <td> {$cust_info['customer_name']}    

<button title='click to add transaction to {$cust_info['customer_name']} ' class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary'  onclick=\"request_template('',{customer_info:'id:{$cust_info['customer_id']}\' {$cust_info['customer_name']}\' ".number_format($cust_info['current_ksh_balance'],2)." ksh and $".number_format($cust_info['current_dollar_balance'],2)." \' {$cust_info['mobile']}'},'pages/forms/make_transction_form_page.php');\"  role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-plus'></span><span class='ui-button-text'>Add trans</span></button>


</td> <td>{$cust_info['mobile']}</td> <td> <b class='".toggle_debt_color($cust_info['current_ksh_balance'])."' >".number_format($cust_info['current_ksh_balance'],2)." ksh</b><span>  and </span><b class='".toggle_debt_color($cust_info['current_dollar_balance'])."'  >$".number_format($cust_info['current_dollar_balance'],2)." </b></td> <td>  




  <button class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\"  onclick=\"get_template.customers($customer_id,'edit_customer_info_form','pages/forms/edit_customer_info_form.php');\"   role=\"button\" aria-disabled=\"false\" style=\"font-size: 11px;\"><span class=\"ui-button-icon-primary ui-icon ui-icon-pencil\"></span><span class=\"ui-button-text\">Edit info</span></button>  <button class=\"  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\"   onclick=\"delete_( {id:$customer_id,table:'customers',msg:'you are about to delete all transactions for <strong>{$cust_info['customer_name']}</strong> ?'}) \"  role=\"button\" aria-disabled=\"false\" style=\"font-size: 11px;\"><span class=\"ui-button-icon-primary ui-icon ui-icon-trash\"></span><span class=\"ui-button-text\">Delete account</span>  

  


 </td></tr>
</tbody>
 </table>





<h4 class='title_'> Totals for <div class='yearly_reports_list' style='
    display: inline;
'> <input type='date' id='date_from' customer_id='$customer_id'  value=\"{$data['date_from']}\"  onchange=\"chosen_cust_report_date();\" >  


 


  <label for=\"to_input_date\"> To </label>
    <input type='checkbox'  ".(($data['date_to'] !='')?'selected_check="true"':'')." onclick=\" if($(this).next('#date_to').is(':visible')){\$(this).next('#date_to').val('').hide();chosen_cust_report_date();}else{
     $(this).next('#date_to').show();
  }  \" id=\"to_input_date\"> 

 <input type='date' id='date_to'  value=\"{$data['date_to']}\" style=\"display: ".(($data['date_to'] !='')?'':'none').";  \" onchange=\" if($.trim($('#date_from').val()) != ''){chosen_cust_report_date();}\">  </h4>

 
 




 
 <table class='table' style='
    width: 50%; 
    border: 0.5px solid #7c11a2; 
    margin-top: 20px;
    /* margin-left: 0px; */
'><thead><tr> <th class='title_2'> Transaction totals for {$cust_info['customer_name']}  <i>($full_date)</i> </th> </tr><tr></tr></thead>
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
 


<h3 class=\"title_\"  >($trans_length) Transactions for {$cust_info['customer_name']} <i>($full_date)</i>  </h3> <table class=\"table dataTable\"   table_file='php_files/pages/server-side-tables/transactions_history.php' other_query2=\"$other_query_2\"  other_query=\"$other_query_\" primary_key='id'  >
	<thead><tr><th> cash in </th> <th> cash out </th> <th>  balance </th> <th> dollar in </th> <th> dollar out </th> <th>  balance </th> <th>Date</th><th>Description</th> <th>Action</th>  </tr></thead> <tbody>

	</tbody>
	</table> ";
return $rt;
}

  
// submited 
if(isset($_POST['data'])){
     if_logged_in('die');
     
		echo get_customer_account($_POST['data']);
 
}else{



}
?>