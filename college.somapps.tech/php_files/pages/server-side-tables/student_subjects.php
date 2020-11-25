 
 <?php
 
     include '../../clasess/db_connector.php';

 
	$aColumns = explode(",",'id,admin_date,subject,discount,cost,time,teacher,student_id,subject_id');
	$sIndexColumn =  'id';  
	$other_query = sanitize_other_query_3(str_replace('~','',trim($_GET['other_query'])));   	 
	$sTable =  'student_subjects ';
	$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';
    $sWhere_query = "`subject` LIKE '%".sanitize($_GET['sSearch'])."%' OR `teacher` LIKE '%".sanitize($_GET['sSearch'])."%' OR `cost` LIKE '%".sanitize($_GET['sSearch'])."%' ";

 	$default_order = 'id'; 

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

			 if (preg_match('/subject/', $other_query)  ){

			 			// skip disabled 
					  if(!mysqli_result_(mysqli_query_("select name from students where student_id='{$aRow['student_id']}' and status='1'"),0)){
					  			continue;
					  }


				     $row[] = "<a href='#'   onclick=\"request_template('',{id:{$aRow['student_id']}},'pages/other_pages/student_account.php');\" role='button' aria-disabled='false'  style=' display:inline !important; color:#7c11a2 !important; '  > ".mysqli_result_(mysqli_query_("select name from students where student_id='{$aRow['student_id']}' and delete_status!='1' and status='1'"),0)." </a> ";

				     

				 }



							$row[] = $aRow['subject'];
					 


		$cost = mysqli_result_(mysqli_query_("select cost from student_subjects where  student_id='{$aRow['student_id']}' and subject_id='{$aRow['subject_id']}' "), 0);
	   $discount = mysqli_result_(mysqli_query_("select discount from student_subjects where  student_id='{$aRow['student_id']}' and subject_id='{$aRow['subject_id']}' "), 0);
		
                      $row[] =   '$'.number_format($discount,2);

 
                      $row[] = '$'.number_format(($cost),2);
 								      			
 							$row[] =  '<strong>'.explode('-', $aRow['admin_date'])[2].'</strong>th of every month';

 							$row[] =  " <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"request_template('',{id:{$aRow['id']},student_id:{$aRow['student_id']} },'pages/forms/edite_student_subjects.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit  </span></button>    <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['id']},msg:'deleting subject for <strong>{$aRow['subject']}</strong> ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete  </span></button>";
 	                     $output['aaData'][] = $row;  
			 	       
			} 
				
	
	 /*
	 * Output
	 */

 	
		   $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
		         echo json_encode( $output );
	 
	 ?>
	
 
 
