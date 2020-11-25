<?php


    /* 
      ------ dependenceis -------
            1)  require 'dataBase_class.php';
    */




function get_count_customers($type){
      $type = strtolower(trim($type));
      $c = 0;
      $res = mysqli_query_("select distinct customer_id from transactions where delete_status!='1'");
      while($q = mysqli_fetch_assoc_($res)){
         
                  $balance_ksh = mysqli_result_(mysqli_query_("select sum(amount_ksh) as amount_ksh from transactions where type='in' and customer_id={$q['customer_id']} and delete_status!='1' "), 0) - mysqli_result_(mysqli_query_("select sum(amount_ksh) as amount_ksh from transactions where type='out' and customer_id={$q['customer_id']} and delete_status!='1' "), 0);

                  $balance_dollar = mysqli_result_(mysqli_query_("select sum(amount_dollar) as amount_dollar from transactions where type='in' and customer_id={$q['customer_id']} and delete_status!='1' "), 0) - mysqli_result_(mysqli_query_("select sum(amount_dollar) as amount_dollar from transactions where type='out' and customer_id={$q['customer_id']} and delete_status!='1' "), 0);
          
          
          if(mysqli_result_(mysqli_query_("select count(customer_id) from customers where customer_id={$q['customer_id']} and customer_name !='' and delete_status !='1' "),0) == '1'){ 
                        if(((preg_match('/-/', $balance_ksh) == false && number_format($balance_ksh,2) !='0.00' )  || (preg_match('/-/', $balance_dollar) == false &&  number_format($balance_dollar,2) !='0.00')) && $type == 'credit' ){
                            $c++;
                        }else  if(((preg_match('/-/', $balance_ksh) && number_format($balance_ksh,2) !='0.00' )  || (preg_match('/-/', $balance_dollar) &&  number_format($balance_dollar,2) !='0.00')) && $type == 'debt' ){
                            $c++;
                        }

             }


}
return number_format($c);

}




function get_exchange_report($rate_name,$full_date_DB){

    return '';
/*              $rate_name = sanitize($rate_name);
              $full_date_DB = sanitize($full_date_DB);

    $exch_report = array('total_amount' => 
*/

/*
     array('ksh' => mysqli_result_(mysqli_query_("select sum(amount_ksh) from transactions where type='exchange' and date like'%$full_date_DB%'  and delete_status!='1' "), 0),

  'dollar' => mysqli_result_(mysqli_query_("select sum(amount_dollar) from transactions where type='exchange' and date like'%$full_date_DB%'  and delete_status!='1' "), 0)

      );
      
      ,
    'rate' =>  mysqli_result_(mysqli_query_("select $rate_name from current_rate where  date= like'%$full_date_DB%' and delete_status!='1' ORDER BY DESC LIMIT 1  "), 0));
 
   if(trim(strtolower($rate_name)) == 'dollar_rate'){
       $exch_report['converted'] = floor($exch_report['total_amount'] / ((number_format($exch_report['rate'],2) == '0.00')?1:$exch_report['rate']) );
    }else{
        $exch_report['converted'] = floor($exch_report['total_amount'] * $exch_report['rate']);  
    }

       foreach ($exch_report as $key => $value) {
          $exch_report[$key] = number_format($value,2);
       }
    return $exch_report;*/
}

 


function enc_password($pass){
  return md5(md5($pass.'!@#$%#twertwe%#$').'ASDFSDGF3#345$%8908#$').'1546/>][7987^^&)51';
}




?>