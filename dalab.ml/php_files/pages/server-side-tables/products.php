<?php

   require '../../clasess/dataBase_class.php';
  // require '../../clasess/extra_functions.php';

	$aColumns = explode(",",'id,customer_id,product_name,quantity,price,paid,balance,date, description, address');  
	$sIndexColumn =  'id';  
	$default_order = 'date'; 
	$other_query = sanitize_other_query(str_replace('~','',trim($_GET['other_query'])));     
 	$_GET['sSearch'] = date_corrector($_GET['sSearch']);
    
    $sWhere_query = "`product_name` LIKE '%".sanitize($_GET['sSearch'])."%' OR `date` LIKE '%".sanitize($_GET['sSearch'])."%' OR `description` LIKE '%".sanitize($_GET['sSearch'])."%' OR `address` LIKE '%".sanitize($_GET['sSearch'])."%'";

	$sTable =  'products'; // reports and customer account 

	include 'dataTable_exra.php';
 
 
	$output = array(
		"sEcho" => intval(sanitize($_GET['sEcho'])),
		"iTotalRecords" => mysqli_result_(mysqli_query_("select count(id) from $sTable where ".((trim($other_query) !='')?$other_query.' and ':'')." delete_status!='1'  "), 0),
 		"aaData" => array()
	);
 

      
	     while($aRow = mysqli_fetch_assoc_($rResult))
			{

				// <th> product </th> <th>Quantity</th><th>Price</th><th>Paid</th><th>Balance</th><th>Date</th><th>Description</th> <th>Action</th> 

				$row = array();
			 
				$row[] = $aRow['product_name'];

				$row[] = number_format($aRow['quantity']);
				$row[] = number_format($aRow['price']);
				$row[] = number_format($aRow['paid']);
				$row[] = number_format($aRow['balance']);
								$row[] = $aRow['address']; 

				 if(preg_match('/date/', $other_query)){
				 	$row[] = '<a href="#" title="view reports for ('.date('d/M/Y',strtotime($aRow['date'])).')" class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"
				 	onclick="get_template.reports({date_from:\''.$aRow["date"].'\'},\'pages/other_pages/income_page.php\');" role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-clock"></span><span class="ui-button-text">'.date('d/M/Y',strtotime($aRow['date'])).'</span></a>';// link 
				}else{
					 $row[] = date('d/M/Y',strtotime($aRow['date']));
				}

				$row[] = $aRow['description']; 
   


		// edit btn and delete btn   
 	$row[] = " <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['id']},msg:'Delete this product only  ?'})\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete</span></button>";
  
			    $output['aaData'][] = $row;  
			} 
				

		   $output['iTotalDisplayRecords'] =  count($output['aaData']); 
  
      echo json_encode( $output );
	 
	 ?>
	
 
 
