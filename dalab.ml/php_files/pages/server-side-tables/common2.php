<?php
 
	$balance =  mysqli_result_(mysqli_query_("select sum(balance)  from products where     customer_id={$aRow['customer_id']} and delete_status!='1' "), 0);

	 $debt_color = (number_format($balance,2) !='0.00')?'debt_color':'in_color';

?>