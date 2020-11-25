 
 <?php
 
     include '../../clasess/db_connector.php';

 
	$aColumns = explode(",",'id,full_name,username,type,password,responsibility,status');
	$sIndexColumn =  'id';  
	$other_query = trim($_GET['other_query']); 
$other_query =   trim(str_replace('~', '', $_GET['other_query']));
$other_query =   trim(str_replace('%', '', $other_query));

	  if(trim($other_query) == "''" || trim($other_query) == "undefined''"){
	  	$other_query = '';
	  }  	 
  
	$sTable =  'users';
	$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';
    $sWhere_query = "`full_name` LIKE '%".sanitize($_GET['sSearch'])."%' OR `password` LIKE '%".sanitize($_GET['sSearch'])."%' OR `username` LIKE '%".sanitize($_GET['sSearch'])."%' ";
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
 		$i = "display:none;";
 		$del_user = "";
        }else{
 		$i = "";

        	$del_user = "     <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['id']},msg:'deleting user please confirm <strong>{$aRow['username']}</strong> ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete user </span></button>";

 
}

			  $row[] = "<p><label class='float_label show_'>full name</label>".$aRow['full_name']."</p><p><label class='float_label show_'>username</label>{$aRow['username']} <label style='font-style:italic' class='float_label show_' >({$aRow['type']})</label> </p> <p><label class='float_label show_'>password</label> ******** <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['id']},'edit_customer_info_form','pages/forms/users_form.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>change</span></button> </p>   <p><label class='float_label show_'>status</label> ".(($aRow['status'] == '1')?"<span style='color:green;'>active</span>":"inactive")."  <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"toggle_disable_({table:'$sTable',id:{$aRow['id']},msg:'".(($aRow['status'] == '1')?'Disabling':'enabling') ." <strong>{$aRow['username']}</strong> are you sure ?'}); \" role='button' aria-disabled='false' style='   display: ; $i '><span class='ui-button-icon-primary ui-icon '></span><span class='ui-button-text'>".(($aRow['status'] == '1')?'Disable':'enable') ."</span></button></p> <p> <button  class='change ui-button ui-widget ui-state-default ui-corner-all  ui-button-text-icon-primary' onclick=\"r_page('',{id:{$aRow['id']}},'pages/other_pages/user_account.php');\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon-   '></span><span class='ui-button-text'>show paymens,expenses & sales by <b>{$aRow['username']}</b></span></button> </p>
			    <p> <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['id']},'edit_customer_info_form','pages/forms/users_form.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit info</span></button>    $del_user  </p>

			 	";
 	                     $output['aaData'][] = $row;  
			 	        
			} 
				
	
	 /*
	 * Output
	 */

 	
		   $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
		         echo json_encode( $output );
	 
	 ?>
	
 
 
