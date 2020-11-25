 
 <?php
 
     include '../../clasess/db_connector.php';

 
	$aColumns = explode(",",'id,amount,discount,taken_by,date,description,student_id');
	$sIndexColumn =  'id';  



	$other_query = (trim($_GET['other_query']) != 'undefined')?sanitize_other_query_3(str_replace('~','%',trim($_GET['other_query']))):'';	 

	$sTable =  'payments';
	$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';
    $sWhere_query = "`amount` LIKE '%".sanitize($_GET['sSearch'])."%' OR `description` LIKE '%".sanitize($_GET['sSearch'])."%' OR `date` LIKE '%".sanitize($_GET['sSearch'])."%' ";

 	$default_order = 'date'; 

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
	
	if (!preg_match('/student_id/', $other_query)) {
 	
				     $row[] = "<a href='#'   onclick=\"request_template('',{id:{$aRow['student_id']}},'pages/other_pages/student_account.php');\" role='button' aria-disabled='false'  style=' display:inline !important; color:#7c11a2 !important; '  > ".mysqli_result_(mysqli_query_("select name from students where student_id='{$aRow['student_id']}' and delete_status!='1' and status='1'"),0)." </a> ";
}
				     
		      			$row[] = '$'.number_format($aRow['amount'],2);
		      			$row[] = '$'.number_format($aRow['discount'],2);
		      			 $row[] = mysqli_result_(mysqli_query_("select username from users where id='".$aRow['taken_by']."' and delete_status !='1' "),0);  
 		 		      	$row[] = date('d-M-Y',strtotime($aRow['date']));
						$row[] = str_replace('*_','',$aRow['description']);
 						 
		 
 	                     $output['aaData'][] = $row;  
			 	        
			} 
				
	
	 /*
	 * Output
	 */

 	
		   $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
		         echo json_encode( $output );
	 
	 ?>
	
 
 
