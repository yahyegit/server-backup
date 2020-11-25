<?php
/* dependence: dataBase_class.php  */

 include 'db_connector.php';
 require 'customers_class.php';
 
 

 function get_current_totals($customer_id = ''){
                  $customer_id  = (trim($customer_id) != '')?" customer_id='$customer_id' and ":'';
 
      return  array('current_out' => 
                  array('ksh' =>  mysqli_result_(mysqli_query_("select sum(current_ksh_balace) from customers where $customer_id  current_ksh_balace LIKE '-%' and delete_status!='1'"),0),'dollar'=> mysqli_result_(mysqli_query_("select sum(current_dollar_balace) from customers where $customer_id  current_dollar_balace LIKE '-%' and delete_status!='1'"),0)),
                  'current_in' => 
                  array('ksh' =>  mysqli_result_(mysqli_query_("select sum(current_ksh_balace) from customers where $customer_id  current_ksh_balace NOT LIKE '-%' and delete_status!='1'"),0),'dollar'=>mysqli_result_(mysqli_query_("select sum(current_dollar_balace) from customers where $customer_id  current_dollar_balace NOT LIKE '-%' and delete_status!='1'"),0)));
       
       

 }



function get_report_totals($full_date_DB,$date_to,$customer_id){

                $customer_id = sanitize($customer_id);
                $full_date_DB = sanitize($full_date_DB);
                $date_to = sanitize($date_to);
         
                $query = (trim($date_to) != '')?" date BETWEEN '$full_date_DB' AND '".sanitize($date_to)."' ":" date like '%$full_date_DB%' ";
                 $cust_id = (trim($customer_id) !='')?" and customer_id='$customer_id ":'';

    $out_ksh = mysqli_result_(mysqli_query_("select sum(r_amount_ksh) from transactions where type='out' and $query  $cust_id and delete_status!='1' "),0);
    $in_ksh = mysqli_result_(mysqli_query_("select sum(r_amount_ksh) from transactions where type='in' and $query  $cust_id and delete_status!='1' "),0);
    $in_dollar = mysqli_result_(mysqli_query_("select sum(r_amount_dollar) from transactions where type='in' and $query  $cust_id and delete_status!='1' "),0);
    $out_dollar = mysqli_result_(mysqli_query_("select sum(r_amount_dollar) from transactions where type='out' and $query  $cust_id and delete_status!='1' "),0);



    $totals['on_hand_ksh_total'] = array('in' => $in_ksh,'out'=>$out_ksh);    
    $totals['on_hand_dollar_total'] = array('in' => $in_dollar,'out'=>$out_dollar);     
     $totals['on_hand_balance'] = array('ksh' => $in_ksh - $out_ksh,'dollar'=>  $in_dollar - $out_dollar);
 
    $totals['on_hand_balance_debt_color'] = array('dollar' =>  ((preg_match('/-/', $totals['on_hand_balance']['dollar']) && number_format($totals['on_hand_balance']['dollar'],2) !='0.00')?'debt_color':'in_color'),'ksh' =>   ((preg_match('/-/', $totals['on_hand_balance']['ksh']) && number_format($totals['on_hand_balance']['ksh'],2) !='0.00')?'debt_color':'in_color'));




    $open = mysqli_fetch_assoc_(mysqli_query_("select id,sum(amount_ksh) as amount_ksh, sum(amount_dollar) as amount_dollar from open_cash where   $query  and delete_status!='1'  "));
    $open['amount_ksh_balance'] = $open['amount_ksh'] + $totals['on_hand_balance']['ksh']; 
    $open['amount_dollar_balance'] = $open['amount_dollar'] + $totals['on_hand_balance']['dollar'];
     $totals['open'] = $open;


$sell_rates  =  mysqli_result_(mysqli_query_("select sum(cash_rate) from transactions where  $query and type_msg like '%conveted_ksh%' and delete_status!='1'"),0);
$puy_rates  =  mysqli_result_(mysqli_query_("select sum(dollar_rate) from transactions where  $query and type_msg like '%conveted_dollar%' and delete_status!='1'"),0);
 
$o_ksh  =  mysqli_result_(mysqli_query_("select sum(r_amount_ksh) from transactions where  $query and type_msg like '%conveted_ksh%' and delete_status!='1'"),0);
$o_dollar  =  mysqli_result_(mysqli_query_("select sum(r_amount_dollar) from transactions where  $query and type_msg like '%conveted_dollar%' and delete_status!='1'"),0);
      

   $totals['exchange'] = array('o_ksh' => $o_ksh,'o_dollar' => $o_dollar,'sell_rate'=>'','puy_rate'=>'','to_dollar'=> floor($o_ksh/$puy_rates),'to_ksh'=> floor($o_dollar*$sell_rates));
    $totals['exchange']['to_dollar'] = (is_numeric($totals['exchange']['to_dollar']))?$totals['exchange']['to_dollar']:'0'; 
     
        $totals['exchange']['to_ksh'] = (is_numeric($totals['exchange']['to_ksh']))?$totals['exchange']['to_ksh']:'0'; 
       return $totals;
 }       




?>