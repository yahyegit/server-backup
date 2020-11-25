 
 <?php
 
     include '../../clasess/db_connector.php';
 

 	$aColumns = explode(",",'id,item_id,item_name,cost,quantity,description,date');
 
	$sIndexColumn =  'id';  
	$other_query =   trim(str_replace('~', '', $_GET['other_query']));
 

  if(trim($other_query) == "''" || trim($other_query) == "undefined''"){
  	$other_query = '';
  }  	 
	$sTable =  'recieved_history';
	$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';

    $sWhere_query = "`item_name` LIKE '%".sanitize($_GET['sSearch'])."%' OR  `cost` LIKE '%".sanitize($_GET['sSearch'])."%' OR  `quantity` LIKE '%".sanitize($_GET['sSearch'])."%' OR  `description` LIKE '%".sanitize($_GET['sSearch'])."%' OR  `date` LIKE '%".sanitize($_GET['sSearch'])."%' ";


 	$default_order = 'id'; 

	include 'dataTable_exra.php';

 
	$output = array(
		"sEcho" => intval(sanitize($_GET['sEcho'])),
		"iTotalRecords" =>  mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')."  delete_status!='1'  "),0),
		"aaData" => array()
	);
 

//  <th> item </th> <th> quantity </th>   <th> cost </th>  <th> Date </th> <th> description </th>  <th> action </th> 
							  
        // <thea 
	     while($aRow = mysqli_fetch_assoc_($rResult)){
 	
          $row = array();
 
					  
          			$row[] =  $aRow['item_name'];
					$row[] = number_format($aRow['quantity']);
					$row[] = $ccc.number_format($aRow['cost']/$aRow['quantity'],2)."<span class='gray'> total: ". $ccc.number_format($aRow['cost'],2).'</span>'; 

					$row[] = date('Y-M-d',strtotime($aRow['date']));
					$row[] =  $aRow['description'];
					 
				 
					 
					 $row[] = " <div  class='hide_for_print' style='
					    
					    margin: 0px !important;
					     
					'>    <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['id']},msg:'Deleting received item ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete   </span></button>  </div>
					 

								 	";
 	       
 	                     $output['aaData'][] = $row;  
			 	        
			} 
				
	
	 /*
	 * Output
	 */

 	
		   $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
		         echo json_encode( $output );
	 
	 ?>
	
 
 
