
<?php
  require 'clasess/dataBase_class.php';
 
 
 if(isset($_POST['data'])){
	 	 if_logged_in('die'); 
		
		$table = sanitize($_POST['data']['table']);
		$id = sanitize($_POST['data']['id']);
 
 
		 
if($table == 'recieved_history'){
 // what if the items is sold or old detect how 

   // delete recieved order 
	$gg = mysqli_query_("select cost,id,quantity,item_name from recieved_history where order_number='$id' ");
	while( $qn = mysqli_fetch_assoc_($gg) ){				
			 
				//	mysqli_query_("UPDATE items SET  remainings=remainings-{$qn['quantity']}, remaining_cost=remaining_cost-$cost_total  where item_name='{$qn['item_name']}' ");

					mysqli_query_("update recieved_history set delete_status='1' where id={$qn['id']}");
	}


 }else if($table == 'customers'){

 		 mysqli_query_("update invoices set delete_status='1' where customer_id=$id");
 		 mysqli_query_("update payments set delete_status='1' where customer_id=$id");
  	    mysqli_query_("update $table set delete_status='1' where id=$id");

 			
}else if($table == 'items'){
	$item_name = mysqli_result_(mysqli_query_("select item_name from items where id='$id' "),0);
 
 		mysqli_query_("update recieved_history set delete_status='1' where item_name='$item_name'");
  	    mysqli_query_("update $table set delete_status='1' where id=$id");
 			
}else if($table == 'invoices'){
	die();
	$gg = mysqli_query_("select id,quantity,item_name,price,customer_id from invoices where order_number='$id' ");
	while ($qn = mysqli_fetch_assoc_($gg)) {
	     mysqli_query_("UPDATE items SET  remainings=remainings+{$qn['quantity']}  where item_name='{$qn['item_name']}' ");
	 
	     mysqli_query_("update $table set delete_status='1' where id={$qn['id']}");
	}
 

 			
}else if($table == 'payments'){

	$gg = mysqli_query_("select customer_id,paid,discount from payments where id='$id' ");
	$qn = mysqli_fetch_assoc_($gg); 
      $paid = $qn['paid']+$qn['discount'];

     mysqli_query_("UPDATE customers SET  current_balance=current_balance+$paid where id='{$qn['customer_id']}' ");
 
  	 mysqli_query_("update $table set delete_status='1s' where id=$id");
 			
}else if($table == 's_payments'){
    // delete supplier payment 
	$gg = mysqli_query_("select s_id,paid from s_payments where id='$id' ");
	$qn = mysqli_fetch_assoc_($gg); 
      $paid = $qn['paid'];

     mysqli_query_("UPDATE suppliers SET  current_balance=current_balance+$paid where id='{$qn['s_id']}' ");
 
  	 mysqli_query_("update $table set delete_status='1' where id=$id");
 			
}else if($table == 'suppliers'){
	mysqli_query_("update s_payments set delete_status='1' where s_id=$id");
//	mysqli_query_("update recieved_history set delete_status='1' where s_id=$id");
	mysqli_query_("update $table set delete_status='1' where id=$id");
} 

echo 'ok';
	
 }
?>

