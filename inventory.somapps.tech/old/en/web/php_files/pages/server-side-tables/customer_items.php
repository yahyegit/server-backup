 
 <?php
 
     include '../../clasess/db_connector.php';
 
 
$aColumns = explode(",",'id,item_name,address,quantity,price,date,user_id,delevered_by,customer_id');

	$sIndexColumn =  'id';  
  	$other_query =   trim(str_replace('~', '', $_GET['other_query']));
 
  if(trim($other_query) == "''" || trim($other_query) == "undefined''"){
  	$other_query = '';
  } 

   $distinct = ' DISTINCT order_number, ';
	$sTable =  'invoices';
	$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';

    $sWhere_query = "`item_name` LIKE '%".sanitize($_GET['sSearch'])."%' OR  `price` LIKE '%".sanitize($_GET['sSearch'])."%'  OR  `date` LIKE '%".sanitize($_GET['sSearch'])."%'  OR  `delevered_by` LIKE '%".sanitize($_GET['sSearch'])."%'   ";  


 	$default_order = 'item_name'; 

	include 'dataTable_exra.php';

 
	$output = array(
		"sEcho" => intval(sanitize($_GET['sEcho'])),
		"iTotalRecords" =>  mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')."  delete_status!='1'  "),0),
		"aaData" => array()
	);
 
//      <th> item  </th> <th>  quantity </th><th> price </th>  <th> balance </th>  <th> action </th> 
 
        // all queries is static 
 	     while($aRow = mysqli_fetch_assoc_($rResult)){
 	
            $row = array();
 
  $customer_name =  mysqli_result_(mysqli_query_("select customer_name from customers where id='{$aRow['customer_id']}' "),0);

  $or = mysqli_query_("select * from invoices where order_number='{$aRow['order_number']}' ");
  $ot =  "<table class='table_order' >  <thead> <tr> <th>  item </th> <th>  tirada <i>(quantity)</i> </th> <th> price </th>   </tr>  </thead>   <tbody> ";
  $total_price = 0;
  $total_balance = 0;
  $o_date = mysqli_result_(mysqli_query_("select date from invoices where order_number='{$aRow['order_number']}'  order by id asc limit 1"),0);

  $paid = mysqli_result_(mysqli_query_("select sum(paid) from payments where order_number='{$aRow['order_number']}' "),0);
  $discount = mysqli_result_(mysqli_query_("select sum(paid) from payments where order_number='{$aRow['order_number']}' "),0);

   while($oRow = mysqli_fetch_assoc_($or)){
 	$total_price += $oRow['price'];
 	$total_balance += $oRow['balance'];	
   	$ot .= "<tr> <td class='not_td'>  {$oRow['item_name']} </td> <td class='not_td' >  ".number_format($oRow['quantity'])." </td> <td class='not_td' >  $ccc".number_format($oRow['price'],2)."  </td>   </tr>";

 	}
 $username = mysqli_result_(mysqli_query_("select username from users where id='{$aRow['user_id']}' "),0);

 
$hide_ = (trim($customer_name) !='' && !preg_match('/customer_id/',$other_query))?"20px;":"display:none;";



	$ot .=  "</tbody></table> <table class='table_order  ' style='width:auto'>   <tbody> ";



$username = "<button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary'  title='click to see full user account'  onclick=\"request_template('',{id:{$aRow['user_id']}},'pages/other_pages/user_account.php');\"  role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon- '></span><span class='ui-button-text'>$username  </span></button>"; 

 	$delevered_by = (!empty($aRow['delevered_by']))?"<span class='gray' style='margin-left:20px' > delivered by </span> <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary'  title='see all items delivered by {$aRow['delevered_by']} '   onclick=\"request_template('',{delevered_by:'{$aRow['delevered_by']}'},'pages/other_pages/delever_account.php');\"   role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon- '></span><span class='ui-button-text'>{$aRow['delevered_by']}   </span></button>":'';
   $address = (trim($aRow['address']) !='')?" <span class='gray' style='margin-left:20px' > address</span> {$aRow['address']} ":'';

	$ot .=  "</tbody></table> <table class='table_order  ' >   <tbody> ";

     $ot .=  "<tr   > <td  >      <span class='gray' style='margin-left: '   >  total price </span>  $ccc".number_format($total_price,2)."   <span class='gray' style='margin-left:20px ' > date </span>  ".date('d-M-Y',strtotime($o_date))."     </td>    


 <td> 

  <span  class='gray' style='$hide_' > customer </span>  

<button  class='change ui-button ui-widget ui-state-default ui-corner-all  ui-button-text-icon-primary' onclick=\"r_page('',{id:{$aRow['customer_id']}},'pages/other_pages/customer_account.php');\" role='button' aria-disabled='false' style='font-size: 11px; $hide_'><span class='ui-button-icon-primary ui-icon-   '></span><span class='ui-button-text'>$customer_name</span></button>



 $address  $delevered_by     <span class='gray' style='margin-left:20px' > sold by </span>  $username  <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['order_number']},msg:'Deleting order from <b> $customer_name </b> ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete order  </span></button>       </td>     </tr>



     ";

       $ot .=  " </tbody> </table> ";



 
 







 $row[] = $ot; " <div  class='hide_for_print' style='
    
    margin: 0px !important;
     
'>     </div>
 

			 	";
 	                     $output['aaData'][] = $row;  



 
			 	        
			} 
				
	
	 /*
	 * Output
	 */

 	
		   $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
		         echo json_encode( $output );
	 
	 ?>
	
 
 
