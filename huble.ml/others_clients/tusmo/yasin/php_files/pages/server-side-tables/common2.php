<?php
 
	$balance_ksh = mysqli_result_(mysqli_query_("select sum(amount_ksh) as amount_ksh from transactions where type='out' and customer_id={$aRow['customer_id']} and delete_status!='1' "), 0) - mysqli_result_(mysqli_query_("select sum(amount_ksh) as amount_ksh from transactions where type='in' and customer_id={$aRow['customer_id']} and delete_status!='1' "), 0);

	$balance_dollar =  mysqli_result_(mysqli_query_("select sum(amount_dollar) as amount_dollar from transactions where type='out' and customer_id={$aRow['customer_id']} and delete_status!='1' "), 0) -  mysqli_result_(mysqli_query_("select sum(amount_dollar) as amount_dollar from transactions where type='in' and customer_id={$aRow['customer_id']} and delete_status!='1' "), 0);

								 $debt_color = array('dollar' =>  ((!preg_match('/-/',$balance_dollar) && number_format($balance_dollar,2) !='0.00')?'debt_color':(($balance_dollar != '0')?'in_color':'') ),'ksh' =>  ((!preg_match('/-/', $balance_ksh)  && number_format($balance_ksh,2) !='0.00')?'debt_color': (($balance_ksh != '0')?'in_color':'') ));


?>