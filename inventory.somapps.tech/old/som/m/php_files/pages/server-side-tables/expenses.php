 
 <?php
 
     include '../../clasess/db_connector.php';

 
	$aColumns = explode(",",'id,name,date,cost,user_id,description');
	$sIndexColumn =  'id';  
 	  	$other_query =   trim(str_replace('~', '', $_GET['other_query']));

	  if(trim($other_query) == "''" || trim($other_query) == "undefined''"){
	  	$other_query = '';
	  } 


 	 	$sTable =  'expenses';
	$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';
    $sWhere_query = "`name` LIKE '%".sanitize($_GET['sSearch'])."%' OR `cost` LIKE '%".sanitize($_GET['sSearch'])."%' OR `date` LIKE '%".sanitize($_GET['sSearch'])."%' OR `description` LIKE '%".sanitize($_GET['sSearch'])."%' ";
 	$default_order = 'name'; 

	include 'dataTable_exra.php';

 
	$output = array(
		"sEcho" => intval(sanitize($_GET['sEcho'])),
		"iTotalRecords" =>  mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')."  delete_status!='1'  "),0),
		"aaData" => array()
	);
 

//  <th> name </th><th> cost </th>   <th> date </th> <th> desctiption </th>  <th> by </th> <th> action </th> 
        include '../../global_functions/toggle_debt_or_in_color.php'; // toggle_debt_color

        // all queries is static 
	     while($aRow = mysqli_fetch_assoc_($rResult))
			{

					 $username = mysqli_result_(mysqli_query_("select username from users where id='{$aRow['user_id']}' "),0);
				 	$description = (!empty($aRow['description']))?"<p>".$aRow['description']."</p>":'';
						  $row = array();
					      $row[] = "<p><label class='float_label show_'>full name</label> {$aRow['name']}</p> <p><label class='float_label show_'>cost</label>".$ccc.number_format($aRow['cost'],2).'</p>'."<p><label class='float_label show_'>date</label>".date('d-M-Y',strtotime($aRow['date']))."</p> $description <p> <label class='float_label show_'>by</label> <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary'  title='click to see full user account'  onclick=\"request_template('',{id:{$aRow['user_id']} },'pages/other_pages/user_account.php');\"  role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon- '></span><span class='ui-button-text'>$username  </span></button> </p>  <p> <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['id']},'edit_customer_info_form','pages/forms/expense_form.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit </span></button>  <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['id']},msg:'deleting expense <strong>{$aRow['name']}</strong> ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete  </span></button>  </p>
 

			 	";
 	                     $output['aaData'][] = $row;  
			 	        
			} 
				
	
	 /*
	 * Output
	 */

 	
		   $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
		         echo json_encode( $output );
	 
	 ?>
	
 
 
