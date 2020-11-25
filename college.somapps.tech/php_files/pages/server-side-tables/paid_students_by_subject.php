 
 <?php
 
     include '../../clasess/db_connector.php';
 
 
	$aColumns = explode(",",'id,from_date,to_date,student_subject,student_id,balance');
	$sIndexColumn =  'id';  
	$other_query = sanitize_other_query(str_replace('~','',trim($_GET['other_query'])));  

  if(trim($other_query) == "''" || trim($other_query) == "undefined''"){
  	$other_query = '';
  }  	 
	$sTable =  'invoices';
	$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';
    $sWhere_query = "`student_subject` LIKE '%".sanitize($_GET['sSearch'])."%' OR  `balance` LIKE '%".sanitize($_GET['sSearch'])."%' OR  `from_date` LIKE '%".sanitize($_GET['sSearch'])."%' ";
 	$default_order = 'id'; 

	include 'dataTable_exra.php';

 
	$output = array(
		"sEcho" => intval(sanitize($_GET['sEcho'])),
		"iTotalRecords" =>  mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')."  delete_status!='1'  "),0),
		"aaData" => array()
	);
 

  $paid_all = 0;
        // all queries is static 
	     while($aRow = mysqli_fetch_assoc_($rResult))
			{
 
          $row = array();
 
				$row[] = mysqli_result_(mysqli_query_("select name from students where   student_id='{$aRow['student_id']}' and delete_status!='1' and status='1' "),0)." <button class='change primary_button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"request_template('',{id:{$aRow['student_id']}},'pages/other_pages/student_account.php');\" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon'></span><span class='ui-button-text'>show account</span></button> ";




				$row[] =   $aRow['student_subject']; 
 				$row[] =   date('d/M/2020',strtotime($aRow['from_date']))." <i> to </i>".date('d/M/2020',strtotime($aRow['to_date']));  

		 
		$cost = mysqli_result_(mysqli_query_("select cost from student_subjects where    student_id='{$aRow['student_id']}' and subject='{$aRow['student_subject']}' "), 0);
	   $discount = mysqli_result_(mysqli_query_("select discount from student_subjects where  student_id='{$aRow['student_id']}' and subject='{$aRow['student_subject']}' "), 0);
		
         $row[] = '$'.number_format(($cost-$discount),2);
         $row[] =   '$'.number_format($discount,2);

         $paid_all +=  ($cost-$discount) - $aRow['balance'];


				$row[] = "<span class='debt_color' style='margin-right:4px;'>$".number_format($aRow['balance'],2)."<span>   ";

 	                     $output['aaData'][] = $row;  
			 	        
			} 
				
	
	 /*
	 * Output
	 */
//print_r($output['aaData'][0]);

 	 	 $output['aaData'][0][0] .= '<span style="display:none;" class="class_paid_s"   >'.number_format($paid_all)."</span>";

		   $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
		         echo json_encode( $output );
	 
	 ?>
	
 
 
