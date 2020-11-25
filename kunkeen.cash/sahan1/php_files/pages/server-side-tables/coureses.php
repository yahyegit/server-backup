 
 <?php
 
     include '../../clasess/db_connector.php';

 
	$aColumns = explode(",",'id,course,cost,duration');
	$sIndexColumn =  'id';  
	$other_query = '';   	 
	$sTable =  'courses';
	$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';
    $sWhere_query = "`course` LIKE '%".sanitize($_GET['sSearch'])."%' OR `cost` LIKE '%".sanitize($_GET['sSearch'])."%' OR `duration` LIKE '%".sanitize($_GET['sSearch'])."%' ";

 	$default_order = 'course'; 

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
	 					 $row[] = $aRow['course'];
	 					 $row[] = $aRow['duration'];
		      			 $row[] = '$'.number_format($aRow['cost'],2);
 						 $row[] = '('.mysqli_result_(mysqli_query_("select count(id) from students where courses LIKE '%~{$aRow['course']}~%' "),0).') students' ;
 					      $row[] = " <div  class='hide_for_print' style='
    
    margin: 0px !important;
     
'> <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['id']},'edit_customer_info_form','pages/forms/coureses_form.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit course </span></button>  <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['id']},msg:'deleting course please confirm <strong>{$aRow['course']}</strong> ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete  </span></button>  </div>
 

			 	";
		 
 	                     $output['aaData'][] = $row;  
			 	        
			} 
				
	
	 /*
	 * Output
	 */

 	
		   $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
		         echo json_encode( $output );
	 
	 ?>
	
 
 
