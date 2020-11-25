 
 <?php
 
     include '../../clasess/db_connector.php';

 
	$aColumns = explode(",",'id,full_name,status,username,password,type,current_send_limit,current_remaining_limit');
	$sIndexColumn =  'id';  
	$other_query = trim($_GET['other_query']); 

	  if(trim($other_query) == "''" || trim($other_query) == "undefined''"){
	  	$other_query = '';
	  }  	 
  
	$sTable =  'users';
	$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';
    $sWhere_query = "`full_name` LIKE '%".sanitize($_GET['sSearch'])."%' OR `password` LIKE '%".sanitize($_GET['sSearch'])."%' OR `username` LIKE '%".sanitize($_GET['sSearch'])."%' OR `type` LIKE '%".sanitize($_GET['sSearch'])."%' ";
 	$default_order = 'full_name'; 

	include 'dataTable_exra.php';

 
	$output = array(
		"sEcho" => intval(sanitize($_GET['sEcho'])),
		"iTotalRecords" =>  mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')."  delete_status!='1'  "),0),
		"aaData" => array()
	);
 

//   <th>full name</th>     <th>username</th> <th> password </th>    <th>user type</th> <th> user income </th> <th> status </th>  <th>action </th> 

        // all queries is static 
	     while($aRow = mysqli_fetch_assoc_($rResult))
			{
 
          $row = array();

    if ($current_user == $aRow['id']) {
 		$st = '';
 		$del_user = "";
        }else{
        	$del_user = "<br>    <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['id']},msg:'deleting user please confirm <strong>{$aRow['username']}</strong> ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete user </span></button>";
	  $st = '<br> <labe class="show_ float_label">status:</label>'.(($aRow['status'] == '1')?"<span style='color:green;'>active</span>":"inactive")."  <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"toggle_disable_({table:'$sTable',id:{$aRow['id']},msg:'".(($aRow['status'] == '1')?'Disabling':'enabling') ." <strong>{$aRow['username']}</strong> are you sure ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon '></span><span class='ui-button-text'>".(($aRow['status'] == '1')?'Disable':'enable') ."</span></button>";
 
}

			  $row[] = $aRow['full_name'];
			  $row[] = $aRow['username']." <i style='color:gray;'>({$aRow['type']})</i> $st ";
			  $row[] = "***********";
		 
			  $row[] = '<p><label class="show_ float_label">current payment limit:</label> $'.number_format($aRow['current_remaining_limit'],2).'</p>
<p><label class="show_ float_label">current sending limit:</label> $'.number_format($aRow['current_send_limit'],2)." </p>

   <button  style=\"
    margin-left:3px; font-size: 13px;
\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"r_page('',{user_id:{$aRow['id']}},'pages/forms/add_limit_form.php');\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\"> Add limit to  <b>{$aRow['username']}</b> </span></button> 
 
  <button  class='change ui-button ui-widget ui-state-default ui-corner-all  ui-button-text-icon-primary' onclick=\"r_page('',{id:{$aRow['id']}},'pages/other_pages/limit_history.php');\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon-   '></span><span class='ui-button-text'> show limit history for <b>{$aRow['username']}</b></span></button>

 ";


			  $row[] =  "<button  class='change ui-button ui-widget ui-state-default ui-corner-all  ui-button-text-icon-primary' onclick=\"r_page('',{id:{$aRow['id']}},'pages/other_pages/payments_for_user.php');\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon-   '></span><span class='ui-button-text'>Show payments for <b>{$aRow['username']}</b></span></button> <br><br><button  class='change ui-button ui-widget ui-state-default ui-corner-all  ui-button-text-icon-primary' onclick=\"r_page('',{id:{$aRow['id']}},'pages/other_pages/sent_for_user.php');\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon-   '></span><span class='ui-button-text'>Show sent money for <b>{$aRow['username']}</b></span></button> 


			   ";  

		

			 	$row[] = " <div  class='hide_for_print' style='
    
    margin: 0px !important;
     
'> <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['id']},'edit_customer_info_form','pages/forms/users_form.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit info</span></button>  <br>  $del_user  </div>
 

			 	";
 	                     $output['aaData'][] = $row;  
			 	        
			} 
				
	
	 /*
	 * Output
	 */

 	
		   $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
		         echo json_encode( $output );
	 
	 ?>
	
 
 