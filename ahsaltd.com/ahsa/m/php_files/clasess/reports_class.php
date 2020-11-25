<?php
/* dependence: dataBase_class.php  */

 include 'db_connector.php';
 require 'customers_class.php';
  function current_balance_all_ksh($data){
        // dollar_rate  ,amount_dollar , amount_ksh
         $data = clean_security($data);

    $open_cash = array();
 
    if(isset($data['customer_id'])){
        $query_date = (trim($data['date_to']) != '')?" customer_id='{$data['customer_id']}' and date BETWEEN '{$data['date']}' AND '{$data['date_to']}' ":" customer_id='{$data['customer_id']}' and date like '%{$data['date']}%' ";

    }else{
         $query_date = (trim($data['date_to']) != '')?" date BETWEEN '{$data['date']}' AND '{$data['date_to']}' ":" date like '%{$data['date']}%' ";
    }
  
 
     $open_cash['total_dollar_in'] = mysqli_result_(mysqli_query_("select sum(dollar_in) from transactions where  $query_date and delete_status!='1' "),0);
     $open_cash['total_dollar_out'] = mysqli_result_(mysqli_query_("select sum(dollar_out) from transactions where  $query_date and delete_status!='1' "),0);
     $open_cash['total_dollar_balance'] = $open_cash['total_dollar_in']-$open_cash['total_dollar_out']; 

     $open_cash['total_ksh_in'] = mysqli_result_(mysqli_query_("select sum(cash_in) from transactions where  $query_date and delete_status!='1' "),0);
      $open_cash['total_ksh_out'] = mysqli_result_(mysqli_query_("select sum(cash_out) from transactions where  $query_date and delete_status!='1' "),0);
     $open_cash['total_ksh_balance'] = $open_cash['total_ksh_in']-$open_cash['total_ksh_out']; 

  

   $open = mysqli_fetch_assoc_(mysqli_query_("select id,sum(amount_ksh) as amount_ksh, sum(amount_dollar) as amount_dollar,dollar_rate from open_cash where   $query_date  and delete_status!='1'  "));

   $open_cash['all_ksh'] = mysqli_result_(mysqli_query_("select sum(cash_in) -  sum(cash_out) as c_b from transactions where  $query_date  and delete_status!='1' "),0) + $open['amount_ksh'];

   $open_cash['all_dollar_ksh'] = (mysqli_result_(mysqli_query_("select sum(dollar_in) -  sum(dollar_out) as d_b from transactions where $query_date and delete_status!='1' "),0) * $open['dollar_rate']) + ($open['amount_dollar']*$open['dollar_rate']);

  
   $open_cash['balance_ksh'] = $open_cash['all_ksh']+$open_cash['all_dollar_ksh'];
 $open_cash['open_totals'] = $open;
  if(trim($data['date_to']) == ''){
     $open_cash['dollar_rate'] = '';
  }else{
    $open_cash['dollar_rate'] = number_format($open_cash['dollar_rate'],2).'ksh';
  }

  return $open_cash;
 }

 function get_current_totals($customer_id = ''){
                  $customer_id  = (trim($customer_id) != '')?" customer_id='$customer_id' and ":'';
 
      return  array('current_out' => 
                  array('ksh' =>  mysqli_result_(mysqli_query_("select sum(current_ksh_balance) from customers where $customer_id  current_ksh_balance LIKE '-%' and delete_status!='1'"),0),'dollar'=> mysqli_result_(mysqli_query_("select sum(current_dollar_balance) from customers where $customer_id  current_dollar_balance LIKE '-%' and delete_status!='1'"),0)),
                  'current_in' => 
                  array('ksh' =>  mysqli_result_(mysqli_query_("select sum(current_ksh_balance) from customers where $customer_id  current_ksh_balance NOT LIKE '-%' and delete_status!='1'"),0),'dollar'=>mysqli_result_(mysqli_query_("select sum(current_dollar_balance) from customers where $customer_id  current_dollar_balance NOT LIKE '-%' and delete_status!='1'"),0)));
       
       

 }



function get_report_totals($full_date_DB,$date_to,$customer_id){
/*
                $customer_id = sanitize($customer_id);
                $full_date_DB = sanitize($full_date_DB);
                $date_to = sanitize($date_to);
         
                $query = (trim($date_to) != '')?" date BETWEEN '$full_date_DB' AND '".sanitize($date_to)."' ":" date like '%$full_date_DB%' ";
                 $cust_id = (trim($customer_id) !='')?" and customer_id='$customer_id' ":'';

            $out_ksh = mysqli_result_(mysqli_query_("select sum(cash_out) from transactions where  $query  $cust_id and delete_status!='1' "),0);
            $in_ksh = mysqli_result_(mysqli_query_("select sum(cash_in) from transactions where   $query  $cust_id and delete_status!='1' "),0);
            $in_dollar = mysqli_result_(mysqli_query_("select sum(dollar_in) from transactions where  $query  $cust_id and delete_status!='1' "),0);
            $out_dollar = mysqli_result_(mysqli_query_("select sum(dollar_out) from transactions where  $query  $cust_id and delete_status!='1' "),0);



          $totals['on_hand_ksh_total'] = array('in' => $in_ksh,'out'=>$out_ksh);    
          $totals['on_hand_dollar_total'] = array('in' => $in_dollar,'out'=>$out_dollar);     
           $totals['on_hand_balance'] = array('ksh' => $in_ksh - $out_ksh,'dollar'=>  $in_dollar - $out_dollar);
       
          $totals['on_hand_balance_debt_color'] = array('dollar' =>  ((preg_match('/-/', $totals['on_hand_balance']['dollar']) && number_format($totals['on_hand_balance']['dollar'],2) !='0.00')?'debt_color':'in_color'),'ksh' =>   ((preg_match('/-/', $totals['on_hand_balance']['ksh']) && number_format($totals['on_hand_balance']['ksh'],2) !='0.00')?'debt_color':'in_color'));




    $open = mysqli_fetch_assoc_(mysqli_query_("select id,sum(amount_ksh) as amount_ksh, sum(amount_dollar) as amount_dollar from open_cash where   $query  and delete_status!='1'  "));
    $open['amount_ksh_balance'] = $open['amount_ksh'] + $totals['on_hand_balance']['ksh']; 
    $open['amount_dollar_balance'] = $open['amount_dollar'] + $totals['on_hand_balance']['dollar'];
     $totals['open'] = $open;

 
       return $totals;*/
 }       




?>