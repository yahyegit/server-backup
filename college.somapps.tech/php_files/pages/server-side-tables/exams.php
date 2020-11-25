


 <?php
 
     include '../../clasess/db_connector.php';

 
	$aColumns = explode(",",'id,subject,student_id,date,marks');
	$sIndexColumn =  'id';  



	$other_query = (trim($_GET['other_query']) != 'undefined')?sanitize_other_query_3(str_replace('~','%',trim($_GET['other_query']))):'';	 

	$sTable =  'exams';
	$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';
    $sWhere_query = "`marks` LIKE '%".sanitize($_GET['sSearch'])."%' OR `subject` LIKE '%".sanitize($_GET['sSearch'])."%' OR `date` LIKE '%".sanitize($_GET['sSearch'])."%' ";

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
						 
					
						     $row[] = "<a href='#'   onclick=\"request_template('',{id:{$aRow['student_id']}},'pages/other_pages/student_account.php');\" role='button' aria-disabled='false'  style=' display:inline !important; color:#7c11a2 !important; '  > ".mysqli_result_(mysqli_query_("select name from students where student_id='{$aRow['student_id']}' and delete_status!='1' and status='1'"),0)." </a> ";	  

		      			$row[] =" <a href='#' onclick=\"request_template('',{student_subject:'{$aRow['subject']}'},'pages/other_pages/student_subjects.php');\" style=' display:inline !important; color:#7c11a2 !important; ' title='click to see students for {$aRow['subject']}'>{$aRow['subject']}</a>  ";

		      		$row[] = (ctype_digit($aRow['marks']))?number_format($aRow['marks']):$aRow['marks']; 

 		 		      	$row[] = date('d-M-Y',strtotime($aRow['date']));
  		

			 	$row[] = " <div  class='hide_for_print' style='
    
    margin: 0px !important;
     
'> <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['id']},'edit_customer_info_form','pages/forms/exams_form.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit </span></button>  <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['id']},msg:'deleting Exam please confirm  ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete  </span></button>  </div>
 

			 	";


 	                     $output['aaData'][] = $row;  
			 	        
			} 
				
	
	 /*
	 * Output
	 */

 	
		   $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
		         echo json_encode( $output );
	 
	 ?>
	
 
 
