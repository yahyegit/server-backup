 
 <?php
 
     include '../../clasess/db_connector.php';
 
 
	$aColumns = explode(",",'student_subject');
	$sIndexColumn =  'id';  
	$other_query = " status='1' and balance!='0' " ;

  if(trim($other_query) == "''" || trim($other_query) == "undefined''"){
  	$other_query = '';
  }  	 
	$sTable =  'invoices';
	$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';
    $sWhere_query = "`student_subject` LIKE '%".sanitize($_GET['sSearch'])."%'   ";
 	$default_order = 'id'; 

	include 'dataTable_exra.php';


	$output = array(
		"sEcho" => intval(sanitize($_GET['sEcho'])),
		"iTotalRecords" =>  mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')."  delete_status!='1'  "),0),
		"aaData" => array()
	);
 
$exist = array();

         // all queries is static 
	     while($aRow = mysqli_fetch_assoc_($rResult))
			{
 
          $row = array();
 
 if(!in_array($aRow['student_subject'], $exist)){
 		$exist[] = $aRow['student_subject'];
				$row[] = $aRow['student_subject']; 
 
		  	 $row[] = "(".number_format(mysqli_result_(mysqli_query_("select count(id) from invoices where  student_subject='{$aRow['student_subject']}' and $other_query and delete_status!='1' and status='1' "), 0)).") paid students <button class='change primary_button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"request_template('','{$aRow['student_subject']}','pages/other_pages/unpaid_single_subject.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-'></span><span class='ui-button-text'>Show students </span></button> 
 ";

  	 $row[] = "$".number_format(mysqli_result_(mysqli_query_("select sum(balance) from invoices where  student_subject='{$aRow['student_subject']}' and $other_query and delete_status!='1' "), 0));
 	                     $output['aaData'][] = $row;  
			  } 	        
			} 
				
	
	 /*
	 * Output
	 */
 
  
		   $output['iTotalDisplayRecords'] = count($output['aaData']);
		         echo json_encode( $output );
	 
	 ?>
	
 
 

