<?php
/* dependence: dataBase_class.php  */
if(!$myDB){
    die('Dependency: to use "reports_class.php" requires "dataBase_class.php"  ');
}
 
 function get_current_totals(){


$currents = array('current_out' => array('ksh' => 0,'dollar'=> 0),'current_in' => array('ksh' => 0,'dollar'=> 0));
 
 $result = mysqli_query_("select * from customers where delete_status!='1'");
  while($aRow = mysqli_fetch_assoc_($result))
            {
                    
                    
    $balance_ksh = mysqli_result_(mysqli_query_("select sum(amount_ksh) as amount_ksh from transactions where type='out' and customer_id={$aRow['customer_id']} and delete_status!='1' "), 0) - mysqli_result_(mysqli_query_("select sum(amount_ksh) as amount_ksh from transactions where type='in' and customer_id={$aRow['customer_id']} and delete_status!='1' "), 0);

    $balance_dollar =  mysqli_result_(mysqli_query_("select sum(amount_dollar) as amount_dollar from transactions where type='out' and customer_id={$aRow['customer_id']} and delete_status!='1' "), 0) -  mysqli_result_(mysqli_query_("select sum(amount_dollar) as amount_dollar from transactions where type='in' and customer_id={$aRow['customer_id']} and delete_status!='1' "), 0);


            // total credit 
           if(preg_match('/-/', $balance_ksh) && number_format($balance_ksh,2) !='0.00' ){
                  $currents['current_in']['ksh'] += $balance_ksh;
                 }
           if(preg_match('/-/', $balance_dollar) && number_format($balance_dollar,2) !='0.00'){
                  $currents['current_in']['dollar'] += $balance_dollar;
                 }        
               


           // total debts
           
            if(!preg_match('/-/', $balance_ksh) && number_format($balance_ksh,2) !='0.00' ){
                  $currents['current_out']['ksh'] += $balance_ksh;
                 }
           if(!preg_match('/-/', $balance_dollar) && number_format($balance_dollar,2) !='0.00'){
                  $currents['current_out']['dollar'] += $balance_dollar;
                 }              
    } 
                

return $currents;

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
     $totals['on_hand_balance'] = array('ksh' => $out_ksh - $in_ksh,'dollar'=>$out_dollar - $in_dollar);
 
    $totals['on_hand_balance_debt_color'] = array('dollar' =>  ((!preg_match('/-/', $totals['on_hand_balance']['dollar']) && number_format($totals['on_hand_balance']['dollar'],2) !='0.00')?'debt_color':'in_color'),'ksh' =>   ((!preg_match('/-/', $totals['on_hand_balance']['ksh']) && number_format($totals['on_hand_balance']['ksh'],2) !='0.00')?'debt_color':'in_color'));

 

       return $totals;
 }       




?>