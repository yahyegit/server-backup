 
 <?php
 
     include '../../clasess/db_connector.php';

 
	$aColumns = explode(",",'student_id,id,paid,time,balance,description');
	$sIndexColumn =  'id';  
	$other_query = sanitize_other_query(str_replace('~','',trim($_GET['other_query'])));   	 
	$sTable =  'payments';
	$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';
    $sWhere_query = "`paid` LIKE '%".sanitize($_GET['sSearch'])."%' OR `description` LIKE '%".sanitize($_GET['sSearch'])."%' OR `time` LIKE '%".sanitize($_GET['sSearch'])."%' ";

 	$default_order = 'time'; 

	include 'dataTable_exra.php';

 
	$output = array(
		"sEcho" => intval(sanitize($_GET['sEcho'])),
		"iTotalRecords" =>  mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')."  delete_status!='1'  "),0),
		"aaData" => array()
	);
 

        // all queries is static 
	     while($aRow = mysqli_fetch_assoc_($rResult))
			{

					 				 
						 $row = array();
	
		      			$row[] = '$'.$aRow['paid'];
 		 		      	$row[] = date('d-M-Y',strtotime($aRow['time']));
						$row[] = $aRow['description'];
 						if(preg_match('/student_id/', $other_query)){
        		      			$row[] = '$'.number_format($aRow['balance'],2);
						}
		 
 	                     $output['aaData'][] = $row;  
			 	        
			} 
				
	
	 /*
	 * Output
	 */

 	
		   $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
		         echo json_encode( $output );
	 
	 ?>
	
 
 
