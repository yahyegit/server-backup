 
 <?php
 
   require '../../clasess/dataBase_class.php';

	$aColumns = explode(",",'customer_name,customer_id,mobile');  
	$sIndexColumn =  'customer_id';  
 	$other_query = " customer_name !='' ";  
 	 
	$sTable =  'customers';
	$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';
    $sWhere_query = "`customer_name` LIKE '%".sanitize($_GET['sSearch'])."%' OR `mobile` LIKE '%".sanitize($_GET['sSearch'])."%' ";
 	$default_order = 'customer_name'; 

	include 'dataTable_exra.php';

 
	$output = array(
		"sEcho" => intval(sanitize($_GET['sEcho'])),
		"iTotalRecords" =>  mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query and delete_status!='1'  "),0),
		"aaData" => array()
	);
 

// th>name</th> <th>mobile</th> <th>Current Balance</th> <th> more </th><th>Action</th> 
 
        // all queries is static 
	     while($aRow = mysqli_fetch_assoc_($rResult))
			{

					 
						 $row = array();

                          include 'common2.php';

						  include 'common.php';


						    $output['aaData'][] = $row;  
			 	        
			} 
				
	
	 /*
	 * Output
	 */

 	
		   $output['iTotalDisplayRecords'] = count($output['aaData']); 
      echo json_encode( $output );
	 
	 ?>
	
 
 
