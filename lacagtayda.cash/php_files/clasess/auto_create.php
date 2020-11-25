<?php
 include 'db_connector.php';
		/// if_logged_in('die');
 include 'reports_class.php';
function auto_create_open_cash($date_){
	return false;
 	 if(mysqli_result_(mysqli_query_(" select count(id) from open_cash where date='$date_'  and delete_status!='1'"),0) != 0 ){
		 	     return false;
		    }else{
 
				$lr = mysqli_fetch_assoc_(mysqli_query_('select date,dollar_rate from open_cash where  delete_status!="1"  order by date desc limit 1'));
				 $totals = current_balance_all_ksh(array('date' =>$lr["date"],'date_to'=>''));
			 	$rate = $lr['dollar_rate'];
			 

				    mysqli_query_("INSERT INTO `open_cash`(`title`, `amount_ksh`, `amount_dollar`,`date`, `delete_status`,`dollar_rate`) VALUES ('No title','{$totals['balance_ksh']}','','$date_',0,'$rate')");
				 
 
	}

}
 
?>