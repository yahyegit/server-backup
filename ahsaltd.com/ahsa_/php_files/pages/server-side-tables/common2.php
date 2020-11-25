<?php

    $cust_balance = get_customer_balance($aRow['customer_id']);
	$balance_ksh = $cust_balance['ksh'];

	$balance_dollar = $cust_balance['dollar']; 

								 $debt_color = array('dollar' =>  ((preg_match('/-/',$balance_dollar) && number_format($balance_dollar,2) !='0.00')?'debt_color':'in_color'),'ksh' =>((preg_match('/-/', $balance_ksh)  && number_format($balance_ksh,2) !='0.00')?'debt_color':'in_color'));


?>