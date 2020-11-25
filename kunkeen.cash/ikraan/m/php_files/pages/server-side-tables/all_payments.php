 
 <?php
 
     include '../../clasess/db_connector.php';
 
 
	$aColumns = explode(",",'id,customer_id,user_id,date,paid,discount,description');

	$sIndexColumn =  'id';  
	$other_query =   trim(str_replace('~', '', $_GET['other_query']));
 

  if(trim($other_query) == "''" || trim($other_query) == "undefined''"){
  	$other_query = '';
  }  	 
	$sTable =  'payments';
	$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';

    $sWhere_query = "`paid` LIKE '%".sanitize($_GET['sSearch'])."%' OR  `discount` LIKE '%".sanitize($_GET['sSearch'])."%' OR  `description` LIKE '%".sanitize($_GET['sSearch'])."%' ";


 	$default_order = 'id'; 

	include 'dataTable_exra.php';

 
	$output = array(
		"sEcho" => intval(sanitize($_GET['sEcho'])),
		"iTotalRecords" =>  mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')."  delete_status!='1'  "),0),
		"aaData" => array()
	);
 

 
        // <thea 
	     while($aRow = mysqli_fetch_assoc_($rResult)){
 	
          $row = array();
 	 $customer = mysqli_result_(mysqli_query_("select customer_name from customers where id={$aRow['customer_id']}"),0);

			$cust_name = '';
			if(!preg_match('/customer_id/',$other_query)){
			    $cust_name = "<p><label class='float_label show_'>name</label> $customer  </p> ";
			}



				$username = mysqli_result_(mysqli_query_("select username from users where id='{$aRow['user_id']}' "),0);
 				$description = (!empty($aRow['description']))?"<p>".$aRow['description']."</p>":'';




				 $row[] =  "$cust_name <p><label class='float_label show_'>paid</label>".$ccc.number_format($aRow['paid'],2)."</p> <p><label class='float_label show_'>discount</label>".$ccc.number_format($aRow['discount'],2)."</p><p><label class='float_label show_'>date</label>".date('Y-M-d',strtotime($aRow['date']))."</p> <p><label class='float_label show_'>taken by </label> <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary'  title='click to see full user account'  onclick=\"request_template('',{id:{$aRow['user_id']} },'pages/other_pages/user_account.php');\"  role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon- '></span><span class='ui-button-text'>$username  </span></button> </p> $description  <p>    </p>"; 
					  
				 
					 
 
 	       
 	                     $output['aaData'][] = $row;  
			 	        
			} 
				
	
	 /*
	 * Output
	 */

 	
		   $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
		         echo json_encode( $output );
	 
	 ?>
	
 
 