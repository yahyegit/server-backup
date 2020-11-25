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
              $full_date =  '<span style="color:#7c11a2">'.date('d-M-Y',strtotime($data['date_from'])).((trim($data['date_to']) !='')?"</span><span class='span'> to </span><span style=\"color:#7c11a2\">".date('d-M-Y',strtotime($data['date_to'])):'').'</span>';

              $other_query_ = ($data['date_to'] !='')?" date BETWEEN '%~{$data['date_from']}%' AND  '%~{$data['date_to']}%'  ":"date like'%~{$data['date_from']}%'  ";
 			  $other_query_2 = " customer_id='$customer_id' ";


         $open_day_totals = current_balance_all_ksh(array('date' =>$data['date_from'],'date_to'=>$data['date_to'],'customer_id'=>$customer_id));


 			}
 
$tr_dn = (empty($data['date_from']))?'display:none;':'';

 if(mysqli_result_(mysqli_query_("SELECT customer_id FROM customers WHERE  `delete_status`!='1' AND `customer_id`=$customer_id"), 0) == '0'){ 
 		die('login');
	} // check if account is deleted

   $cust_info =  mysqli_fetch_assoc_(mysqli_query_("select * from customers where customer_id='$customer_id' and delete_status!='1'"));


  if(!empty($data['date_from'])){
    $oq = ($data['date_to'] !='')?" AND `date` BETWEEN '{$data['date_from']}' AND  '{$data['date_to']}'  ":" AND  date like'%{$data['date_from']}%'";
  }else{
    $oq = '';
  }

$trans_length = mysqli_result_(mysqli_query_("SELECT count(`id`) FROM `transactions` WHERE `delete_status`!='1' AND `customer_id`=$customer_id  $oq"), 0);

               $r = '<td><pre>ksh'.number_format($cust_info['total_cash_in'],2).' </pre></td>'; 
          $r .= '<td><pre>ksh'.number_format($cust_info['total_cash_out'],2).' </pre></td>'; 
          $r .= '<td><pre class='.toggle_debt_color($cust_info['current_ksh_balance']).' >ksh'.number_format($cust_info['current_ksh_balance'],2).'</pre></td>';  

          $r .= '<td><pre>$'.number_format($cust_info['total_dollar_in'],2).' </pre></td>'; 
          $r .= '<td><pre>$'.number_format($cust_info['total_dollar_out'],2).' </pre></td>'; 
          $r .= '<td><pre class='.toggle_debt_color($cust_info['current_dollar_balance']).' > $'.number_format($cust_info['current_dollar_balance'],2).'</pre></td>'; 





 
      $bl_ = '<p class="underline" style="
    margin-top: 1px;
"><span class="gray">Total In:</span><span> ksh'.number_format($totals['on_hand_ksh_total']['in'],2).'</span>   <span  class=\'hr_\'>  </span>   <span>$'.number_format($totals['on_hand_dollar_total']['in'],2).'</span></p>'; //total in



      $bl_ .=  '<p class="underline"><span class="gray">Total Out:</span><span> ksh'.number_format($totals['on_hand_ksh_total']['out'],2).'</span>   <span  class=\'hr_\'>  </span>   <span>$'.number_format($totals['on_hand_dollar_total']['out'],2).'</span></p>';  

       $bl_ .= '<p class="underline"><span  class="gray" > Balance:</span><span class='.number_format($totals['on_hand_balance']['ksh'],2).'>ksh'.number_format($totals['on_hand_balance']['ksh'],2).'  </span>   <span  class=\'hr_\'>  </span>   <span class='.number_format($totals['on_hand_balance']['dollar'],2).'>$'.number_format($totals['on_hand_balance']['dollar'],2).'</span></p>';

  
 $rt = "
 <table class=\"table\"><thead><tr> <th>Name</th> <th>Mobile</th> <th> Total ksh In </th><th> Total ksh Out </th> <th> Total ksh Balance </th> <th> Total dollar In </th><th> Total dollar Out </th><th> Total dollar Balance </th> <th>Action</th></tr></thead>
<tbody>
<tr> <td> {$cust_info['customer_name']}    

<button title='click to add transaction to {$cust_info['customer_name']} ' class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary'  onclick=\"request_template('',{customer_id:{$cust_info['customer_id']}},'pages/forms/make_transction_form_page.php');\"  role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-plus'></span><span class='ui-button-text'>Add trans</span></button>


</td> <td>{$cust_info['mobile']}</td>  $r <td>  



  <button class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\"  onclick=\"get_template.customers($customer_id,'edit_customer_info_form','pages/forms/edit_customer_info_form.php');\"   role=\"button\" aria-disabled=\"false\" style=\"font-size: 11px;\"><span class=\"ui-button-icon-primary ui-icon ui-icon-pencil\"></span><span class=\"ui-button-text\">Edit info</span></button>  <button class=\"  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\"   onclick=\"delete_( {id:$customer_id,table:'customers',msg:'you are about to delete all transactions for <strong>{$cust_info['customer_name']}</strong> ?'}) \"  role=\"button\" aria-disabled=\"false\" style=\"font-size: 11px;\"><span class=\"ui-button-icon-primary ui-icon ui-icon-trash\"></span><span class=\"ui-button-text\">Delete account</span>  

  


 </td></tr>
</tbody>
 </table>





<h4 class='title_'> Date <div class='yearly_reports_list' style='
    display: inline;
'> <input type='date' title='choose date ' id='date_from' customer_id='$customer_id'  value=\"{$data['date_from']}\"  onchange=\"chosen_cust_report_date();\" >  


 


  <label for=\"to_input_date\"> To </label>
    <input type='checkbox'  ".(($data['date_to'] !='')?'selected_check="true"':'')." onclick=\" if($(this).next('#date_to').is(':visible')){\$(this).next('#date_to').val('').hide();chosen_cust_report_date();}else{
     $(this).next('#date_to').show();
  }  \" id=\"to_input_date\"> 

 <input type='date' id='date_to'  value=\"{$data['date_to']}\" style=\"display: ".(($data['date_to'] !='')?'':'none').";  \" onchange=\" if($.trim($('#date_from').val()) != ''){chosen_cust_report_date();}\">  </h4>

 
 

 


 <h3 class='title_' style='margin-buttom:5px; color:gray !important; $tr_dn' >  Transaction totals for <span style='color:#7c11a2;'>{$cust_info['customer_name']}</span>  <i>($full_date)</i> </h3> 

 <table class='table' style='
    width: 90%;  $tr_dn
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
 
 
<h3 class=\"title_\" style='color:gray !important; ' >(<span style='color:#7c11a2;'>$trans_length</span>) Transactions for  <span style='color:#7c11a2;'>{$cust_info['customer_name']}</span>   <i>($full_date)</i>  </h3> <table class=\"table dataTable\"   table_file='php_files/pages/server-side-tables/transactions_history.php' other_query2=\"$other_query_2\"  other_query=\"$other_query_\" primary_key='id'  >
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