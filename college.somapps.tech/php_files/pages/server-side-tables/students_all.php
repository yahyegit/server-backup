 
 <?php
 
     include '../../clasess/db_connector.php';

 
	$aColumns = explode(",",'student_id,name,status,mobile,gender,description,address');
	$sIndexColumn =  'student_id';  
	$other_query = sanitize_other_query(str_replace('~','',trim($_GET['other_query']))); 

	  if(trim($other_query) == "''" || trim($other_query) == "undefined''"){
	  	$other_query = '';
	  }  	 
  
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
				 $row[] = " {$aRow['name']}<br>
					      	    <i style=\"color:gray !important;\">".$aRow['description']."</i> ".((!empty($aRow['description']))?'<br/>':'')."


 <button class='change primary_button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"request_template('',{id:{$aRow['student_id']}},'pages/other_pages/student_account.php');\" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon'></span><span class='ui-button-text'>show</span></button> 

					      		     ";
		      $row[] = $aRow['mobile'];

		      $row[] = get_subjects($aRow['student_id'])."											 
   <button  style=\"
    margin-left:  ; font-size: 13px;
\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"r_page('',{id:{$aRow['student_id']}},'pages/forms/register_student.php');\"  role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\"> </button> 
";
 			$balance =  mysqli_result_(mysqli_query_("select sum(balance) from invoices where delete_status!='1' and balance!='0' and student_id='{$aRow['student_id']}'"),0);
		    
							if (!empty($balance)) {
								$mkdpaye = "<button title='pay all balance for {$aRow['name']}'  class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('',{id:{$aRow['student_id']}},'pages/forms/make_payment.php');\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon-person  '></span><span class='ui-button-text'> Pay all </span></button>";
							}else{
							$mkdpaye = '';
							}


				$row[] = "<b class='debt_color' style='margin-right:3px;'>$".number_format($balance,2)."<b> $mkdpaye";	
  			    


			 	$row[] = " <div  class='hide_for_print' style='
    
    margin: 0px !important;
     
'> <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['student_id']},'edit_customer_info_form','pages/forms/edite_student.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit info</span></button>  <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"toggle_disable_({table:'$sTable',id:{$aRow['student_id']},msg:'".(($aRow['status'] == '1')?'Disabling':'enabling') ." <strong>{$aRow['name']}</strong> are you sure ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-'></span><span class='ui-button-text'>".(($aRow['status'] == '1')?'Disable':'enable') ."</span></button>  <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['student_id']},msg:'deleting student please confirm <strong>{$aRow['name']}</strong> ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete student</span></button>      </div>
 

			 	";
 	                     $output['aaData'][] = $row;  
			 	        
			} 
				
	
	 /*
	 * Output
	 */

 	
		   $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
		         echo json_encode( $output );
	 
	 ?>
	
 
 
