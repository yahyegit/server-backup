<?php

   require '../../clasess/dataBase_class.php';
  // require '../../clasess/extra_functions.php';

	$aColumns = explode(",",'id,name,quantity,cost,description,date');  
	$sIndexColumn =  'id';  
	$default_order = 'date'; 
	$other_query = sanitize_other_query(str_replace('~','',trim($_GET['other_query'])));     
 	$_GET['sSearch'] = date_corrector($_GET['sSearch']);
    
    $sWhere_query = "`name` LIKE '%".sanitize($_GET['sSearch'])."%' OR `date` LIKE '%".sanitize($_GET['sSearch'])."%' OR `description` LIKE '%".sanitize($_GET['sSearch'])."%' OR `cost` LIKE '%".sanitize($_GET['sSearch'])."%'";

	$sTable =  'expenses'; // reports and customer account 

	include 'dataTable_exra.php';
 
 
	$output = array(
		"sEcho" => intval(sanitize($_GET['sEcho'])),
		"iTotalRecords" => mysqli_result_(mysqli_query_("select count(id) from $sTable where ".((trim($other_query) !='')?$other_query.' and ':'')." delete_status!='1'  "), 0),
 		"aaData" => array()
	);
 

      
	     while($aRow = mysqli_fetch_assoc_($rResult))
			{

			 // <tr><th> name </th> <th>Quantity</th><th>cost</th><th>Description</th> <th>date</th> <th>Action</th>
				$row = array();
			 
				$row[] = $aRow['name'];
				$row[] = number_format($aRow['quantity']);
				$row[] = number_format($aRow['cost']);
				$row[] = $aRow['description'];
                $row[] = '<a href="#" title="see expenses for ('.date('d/M/Y',strtotime($aRow['date'])).')" class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"
				 	onclick="get_template.reports({date_from:\''.$aRow["date"].'\'},\'pages/other_pages/expenses_page.php\');" role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-clock"></span><span class="ui-button-text">'.date('d/M/Y',strtotime($aRow['date'])).'</span></a>';// link 

				 


		// edit btn and delete btn   
 	$row[] = " <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['id']},msg:'Delete  {$aRow['name']}  ?'})\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete</span></button>";
  
			    $output['aaData'][] = $row;  
			} 
				

		   $output['iTotalDisplayRecords'] =  count($output['aaData']); 
  
      echo json_encode( $output );
	 
	 ?>
	
 
 
