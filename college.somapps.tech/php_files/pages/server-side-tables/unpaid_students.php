 
 <?php
 
     include '../../clasess/db_connector.php';

 
	$aColumns = explode(",",'student_id,name,status,mobile,gender,description,address');
	$sIndexColumn =  'student_id';  
	$other_query = '';

  	 
  
	$sTable =  'students';
	$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';
    $sWhere_query = "`name` LIKE '%".sanitize($_GET['sSearch'])."%' OR `mobile` LIKE '%".sanitize($_GET['sSearch'])."%' OR `gender` LIKE '%".sanitize($_GET['sSearch'])."%' OR `description` LIKE '%".sanitize($_GET['sSearch'])."%' ";
 	$default_order = 'name'; 

	include 'dataTable_exra.php';

 
	$output = array(
		"sEcho" => intval(sanitize($_GET['sEcho'])),
		"iTotalRecords" =>  mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')."  delete_status!='1'  "),0),
		"aaData" => array()
	);
 

// th>name</th> <th>mobile</th> <th>Current Balance</th> <th> more </th><th>Action</th> 

        // all queries is static 
	     while($aRow = mysqli_fetch_assoc_($rResult))
			{
 
          $row = array();

           			$invoice =  mysqli_result_(mysqli_query_("select count(balance) from invoices where delete_status!='1' and balance!='0' and student_id='{$aRow['student_id']}' "),0);

           if (!empty($invoice)) {
           		 
				 $row[] = " {$aRow['name']}<br>
					      		    (".$aRow['mobile'].")<br>  


 <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"request_template('',{id:{$aRow['student_id']}},'pages/other_pages/student_account.php');\" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon'></span><span class='ui-button-text'>show account</span></button> 

					      		     ";

		


 			 $row[] = ($invoice > 1)?"(<b>".number_format($invoice)."</b>) unpaid invoices ":"(<b>".number_format($invoice)."</b>) unpaid invoice";
		    
				  

				$row[] = "<b class='debt_color' style='margin-right:3px;'>$".number_format(  mysqli_result_(mysqli_query_("select sum(balance) from invoices where delete_status!='1' and balance!='0' and student_id='{$aRow['student_id']}'"),0),2)."</b>  <button  title='make payment or set remainder ' class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('',{id:{$aRow['student_id']}},'pages/forms/make_payment.php');\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon-person  '></span><span class='ui-button-text'> Pay now</span></button> "; 
 	                     $output['aaData'][] = $row;  

 	               }
			 	        
			} 
				
	
	 /*
	 * Output
	 */

 	
		   $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
		         echo json_encode( $output );
	 
	 ?>
	
 
 
