 
 <?php
 
     include '../../clasess/db_connector.php';
 
 
	$aColumns = explode(",",'id,amount,user_id,description,date');

	$sIndexColumn =  'id';  
		$other_query =   trim($_GET['other_query']);


  if(trim($other_query) == "''" || trim($other_query) == "undefined''"){
  	$other_query = '';
  }  	 
	$sTable =  'limit_history';
	$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';
    $sWhere_query = "`amount` LIKE '%".sanitize($_GET['sSearch'])."%' OR  `description` LIKE '%".sanitize($_GET['sSearch'])."%' OR  `date` LIKE '%".sanitize($_GET['sSearch'])."%'   ";
 	$default_order = 'id'; 

	include 'dataTable_exra.php';

 
	$output = array(
		"sEcho" => intval(sanitize($_GET['sEcho'])),
		"iTotalRecords" =>  mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')."  delete_status!='1'  "),0),
		"aaData" => array()
	);
 

 
        // all queries is static 
	     while($aRow = mysqli_fetch_assoc_($rResult)){
           $row = array();
 
$mo_ = "<p><label class='show_ float_label'> Amount:</label> ".number_format($aRow['amount'],2)."</p> ";
$mo_ .= "<p><label class=\"show_ float_label\">username :</label> ".mysqli_result_(mysqli_query_("select username from users where id={$aRow['user_id']} "),0)."</p>";

$mo_ .= "<p><label class='show_ float_label'> description:</label> ".$aRow['description']."</p> ";

 $mo_ .= "<p><label class=\"show_ float_label\">date:</label> ".date('d-M-Y',strtotime($aRow['date']))."</p>  
";



$mo_ .= " <p  class='hide_for_print' > <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['id']},'edit_customer_info_form','pages/forms/add_limit_form.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit  </span></button>    <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['id']},msg:'Deleting limit record please confirm ? '}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete  </span></button>    </p>
 

			 	";
			 	$row[] = $mo_;
 	                     $output['aaData'][] = $row;  
			 	        
			} 
				
	
	 /*
	 * Output
	 */

 	
		   $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
		         echo json_encode( $output );
	 
	 ?>
	
 
 
