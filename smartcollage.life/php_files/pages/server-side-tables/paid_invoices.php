 
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
 

 
        // all queries is static 
	     while($aRow = mysqli_fetch_assoc_($rResult))
			{
 
          $row = array();
  
				$row[] =   $aRow['student_subject'].", ".date('d/M/2020',strtotime($aRow['from_date']))." <i>to</i> ".date('d/M/2020',strtotime($aRow['to_date']));
 				 
		$cost = mysqli_result_(mysqli_query_("select cost from student_subjects where    student_id='{$aRow['student_id']}' and subject='{$aRow['student_subject']}' "), 0);
	   $discount = mysqli_result_(mysqli_query_("select discount from student_subjects where  student_id='{$aRow['student_id']}' and subject='{$aRow['student_subject']}' "), 0);
		
         $row[] = '$'.number_format(($cost-$discount),2);
         $row[] =   '$'.number_format($discount,2);
 
 if(!empty($aRow['balance'])){
 	$pay_this = "<button  class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('',{id:{$aRow['id']} },'pages/forms/make_payment_subject.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon- '></span><span class='ui-button-text'>Pay this</span></button>";
 }else{
 	$pay_this = '';
 }
				$row[] = "<span class='debt_color' style='margin-right:4px;'>$".number_format($aRow['balance'],2)."<span> $pay_this ";

 	                     $output['aaData'][] = $row;  
			 	        
			} 
				
	
	 /*
	 * Output
	 */

 	
		   $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
		         echo json_encode( $output );
	 
	 ?>
	
 
 
