 
 <?php
 
     include '../../clasess/db_connector.php';

    require '../../clasess/customers_class.php';

	$aColumns = explode(",",'customer_id,customer_name,mobile');
	;$sIndexColumn =  'customer_id';  
 	$other_query = " customer_name !='' ";  
 	 
	$sTable =  'customers';
	$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';
    $sWhere_query = "`customer_name` LIKE '%".sanitize($_GET['sSearch'])."%' OR `mobile` LIKE '%".sanitize($_GET['sSearch'])."%' ";
 	$default_order = 'customer_name'; 

	include 'dataTable_exra.php';

 
	$output = array(
		"sEcho" => intval(sanitize($_GET['sEcho'])),
		"iTotalRecords" =>  mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')."  delete_status!='1'  "),0),
		"aaData" => array()
	);
 

// th>name</th> <th>mobile</th> <th>Current Balance</th> <th> more </th><th>Action</th> 
        include '../../global_functions/toggle_debt_or_in_color.php'; // toggle_debt_color

        // all queries is static 
	     while($aRow = mysqli_fetch_assoc_($rResult))
			{

					 					     include 'common2.php';

						 $row = array();
					     include 'common.php';

 	                     $output['aaData'][] = $row;  
			 	        
			} 
				
	
	 /*
	 * Output
	 */

 	
		   $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
		         echo json_encode( $output );
	 
	 ?>
	
 
 