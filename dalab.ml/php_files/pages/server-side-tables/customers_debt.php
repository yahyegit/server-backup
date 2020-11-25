 
 <?php

   require '../../clasess/dataBase_class.php';

	$aColumns = explode(",",'customer_id,customer_name,mobile,address');  
	$sIndexColumn =  'customer_id';  
 	 	$other_query = " customer_name !='' ";  
 	  	$default_order = 'customer_name'; 
	$sTable =  'customers';
	$_GET['sSearch'] = date_corrector($_GET['sSearch']);
    
    $sWhere_query = "`customer_name` LIKE '%".sanitize($_GET['sSearch'])."%' OR `mobile` LIKE '%".sanitize($_GET['sSearch'])."%' OR `address` LIKE '%".sanitize($_GET['sSearch'])."%'";

	include 'dataTable_exra.php';

 
// th>name</th> <th>mobile</th> <th>Current Balance</th> <th> more </th><th>Action</th> 
 
	$output = array(
		"sEcho" => intval(sanitize($_GET['sEcho'])),
		"iTotalRecords" =>  mysqli_result_(mysqli_query_("select count(distinct customer_id)  from products where  balance!=0 and delete_status!='1' "), 0),
 		"aaData" => array()
	);
 
        // all queries is static 
	     while($aRow = mysqli_fetch_assoc_($rResult))
			{
							
							  include 'common2.php';
 		if(  number_format($balance,2) !='0.00'){
 			

				 
 						 $row = array();
				 
						 include 'common.php';


						    $output['aaData'][] = $row;    //  print_r( $row);
				 }
				 		
			} 
				

 	
		   $output['iTotalDisplayRecords'] =  count($output['aaData']); 
      echo json_encode( $output );
	 
	 ?>
	
 
 
