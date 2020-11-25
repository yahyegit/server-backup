 
 <?php
 
     include '../../clasess/db_connector.php';

 
	$aColumns = explode(",",'id,subject,teacher,time,cost,description');
	$sIndexColumn =  'id';  
 	
 $other_query = '';

 	 	$sTable =  'subjects';
	$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';
    $sWhere_query = "`teacher` LIKE '%".sanitize($_GET['sSearch'])."%' OR `subject` LIKE '%".sanitize($_GET['sSearch'])."%' OR `cost` LIKE '%".sanitize($_GET['sSearch'])."%' OR `time` LIKE '%".sanitize($_GET['sSearch'])."%' OR `description` LIKE '%".sanitize($_GET['sSearch'])."%' ";
 	$default_order = 'subject'; 

	include 'dataTable_exra.php';

 
	$output = array(
		"sEcho" => intval(sanitize($_GET['sEcho'])),
		"iTotalRecords" =>  mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')."  delete_status!='1'  "),0),
		"aaData" => array()
	);
 

//  <th>subject</th><th>teacher</th> <th> time </th> <th> cost </th>  <th>Students</th>   <th>Description</th>  <th>action </th> 
        include '../../global_functions/toggle_debt_or_in_color.php'; // toggle_debt_color

        // all queries is static 
	     while($aRow = mysqli_fetch_assoc_($rResult))
			{

					 				 
						 $row = array();
					      		      $row[] = $aRow['subject'];
 					      		      $row[] = $aRow['teacher'];
 					      		      $row[] = $aRow['time'];
 					      		      $row[] = '$'.number_format($aRow['cost'],2);
 					 $scount = get_count_s("{$aRow['subject']}, ({$aRow['time']}) ({$aRow['teacher']})");

 

 					 $row[] =  (empty($scount))?"no students for {$aRow['subject']}":'('.number_format($scount).")<a href='#' onclick=\"request_template('',{student_subject:'{$aRow['subject']}, ({$aRow['time']}) ({$aRow['teacher']})',students:'$scount', subject:'{$aRow['subject']}'},'pages/other_pages/student_subjects.php');\" style='color:#7c11a2 !important; ' title='click to see students for {$aRow['subject']}'> students </a>";   

 					   $row[] =  "<button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary'  onclick=\"request_template('',{student_subject:'{$aRow['subject']}, ({$aRow['time']}) ({$aRow['teacher']})',students:'$scount', subject:'{$aRow['subject']}'},'pages/other_pages/exams.php');\"   role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon- '></span><span class='ui-button-text'>Show exams </span></button> ";   




 					      		      $row[] = $aRow['description'];
					      		    

			 	$row[] = " <div  class='hide_for_print' style='
    
    margin: 0px !important;
     
'> <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['id']},'edit_customer_info_form','pages/forms/subject_form.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit </span></button>  <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['id']},msg:'deleting subject please confirm <strong>{$aRow['subject']}</strong> ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete  </span></button>  </div>
 

			 	";
 	                     $output['aaData'][] = $row;  
			 	        
			} 
				
	
	 /*
	 * Output
	 */

 	
		   $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
		         echo json_encode( $output );
	 
	 ?>
	
 
 
