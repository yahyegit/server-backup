<?php 
   error_reporting(0);
 
 
$myServer = "mysql.elconsltd.com";
$myUser = "trucksystem";  // 
$myPass = "IXO7IltKFjxv";

$myDB = "trucksytem"; 
 
/* 
$currentDate =  strtotime(date('d-M-Y'));
$expireDate =  strtotime('14-2-2017');
 	if ( $expireDate <= $currentDate )
{
die('<h1>the trail days is finished (+97158-897-6050) </h1> ');
}
*/
    //connection to the database
	if(!@mysql_connect($myServer, $myUser, $myPass)){
	 die("Error't connect To the server "); 
	}else if(!@mysql_select_db($myDB)){
		die("Couldn't open database "); 
	}else{
	
	}
	



 
function sanitize($value){
	$value = preg_replace('!\s+!', ' ', str_replace('"','',str_replace("'",'',$value)));  
	$value = str_replace('*','',$value);
	return htmlentities(mysql_real_escape_string(trim($value)));
}

 	  // special date validation
  function validate_date($date){
		 	$test_date = $date;
			$test_arr  = explode('/', $test_date);
			if (count($test_arr) == 3) {
				if (checkdate($test_arr[0], $test_arr[1], $test_arr[2])) {
					// valid date ...
				   return true;
				} else {
				  return false;

				}
			} else {
				  return false;
			}
	  }
// formartNumberser 

function formartNumbers($value){
	return number_format($value, 2);
}

 //  check multi loggin 
 
  function check_multi_loggin($current_logged_userId,$multiple){
 
 				if (active_ip($current_logged_userId) == true){
  
							 // check if ip addresss are seme 
						$ip_address = mysql_result(mysql_query("SELECT ip_address FROM users WHERE user_id=$current_logged_userId"),0);
						
							if ($ip_address == $multiple) {
                                      return true;
									}else{

								   return false;
								
									}	
 
				   }else{
                    return false;
				   }

 }
 
 // check login  		
   $userId_activities = 0;
  
 function if_logged_in(){
session_start();
if (isset($_SESSION['user_id'])){
global  $userId_activities;
 $userId_activities = $_SESSION['user_id'];
 
     if(mysql_result(mysql_query("SELECT `status` FROM `users` WHERE `user_id`=$userId_activities "), 0) != '1'){
       return false;
	 }
 
	 if(check_multi_loggin($_SESSION['user_id'],$_SESSION['multiple']) == true){
	 return true;
	 }else{
	 return false;
	 }
 
}else{

return false;
}

 
 }
 
  
  // check password
 function checkPass($userId_s,$password){
 
  return (mysql_result(mysql_query("SELECT count('user_id') FROM users WHERE password='$password' and user_id=$userId_s"),0) == 1) ?true :false;
 }
 
 



 // active ip 
 
 function active_ip($user_id){
  return (mysql_result(mysql_query("SELECT active_ip FROM users WHERE user_id=$user_id"),0) == 1) ?true :false;
 }
 
  // get expenses
 function  get_expenses(){
	 
        $type_arry = Array();
	 
	 	// product-types   
		if($expense_tabs = mysql_query("SELECT DISTINCT `type` FROM `expense` WHERE  `delete_status` !='1' ORDER BY `type` ASC")){
			
			   	$type_arry['all']["totalCost"] = number_format(mysql_result(mysql_query("SELECT sum(`cost`) FROM `expense` WHERE `delete_status` !='1'"),0),2);
				$type_arry['all']["totalQuantity"] = number_format(mysql_result(mysql_query("SELECT sum(`quantity`) FROM `expense` WHERE  `delete_status` !='1'"),0)); 
			     $type_arry['all']["count"] = number_format(mysql_result(mysql_query("SELECT count(`id`) FROM `expense` WHERE  `delete_status` !='1'"),0)); 
			 
			
			while($product_tabs_row = mysql_fetch_assoc($expense_tabs)){
				 // totals for current product-type
				 
				$type_arry[$product_tabs_row["type"]]["totalCost"] = number_format(mysql_result(mysql_query("SELECT sum(`cost`) FROM `expense` WHERE  `type`='".$product_tabs_row["type"]."' AND `delete_status` !='1'"),0),2);
				$type_arry[$product_tabs_row["type"]]["totalQuantity"] = number_format(mysql_result(mysql_query("SELECT sum(`quantity`) FROM `expense` WHERE  `type`='".$product_tabs_row["type"]."' AND `delete_status` !='1'"),0)); 
			    $type_arry[$product_tabs_row["type"]]["count"] = number_format(mysql_result(mysql_query("SELECT count(`id`) FROM `expense` WHERE   `type`='".$product_tabs_row["type"]."' AND `delete_status` !='1'"),0)); 
			 
			}
 
 	             
		}
          return json_encode($type_arry);
		
      }
 
// get workers
 function  get_history($s,$type,$id){
	  
	        // truckHistry and driver history
			$query = (trim($type) == 'truckHistry')?"truck_no='$id'":" driverLicenseNo='$id'";
			$type_arry = array();
			
			$queryex = (trim($type) == 'truckHistry')?"`name` like '%, Truck No ($id)'":"`name` like '%, Driver license No ($id)'";
			
				$type_arry['hCost'] =  number_format(mysql_result(mysql_query("SELECT sum(`cost`) FROM `trucks` WHERE $query AND `delete_status` !='1' "),0));
                $type_arry['id'] = $id;
				
				$type_arry['eCost'] =  number_format(mysql_result(mysql_query("SELECT sum(`cost`) FROM `expense` WHERE $queryex AND `delete_status` !='1' "),0),2);
                $type_arry['eQuantity']=  number_format(mysql_result(mysql_query("SELECT sum(`quantity`) FROM `expense` WHERE $queryex AND `delete_status` !='1'"),0));
				
				
				$type_arry["truckCount"] = number_format(mysql_result(mysql_query("SELECT count(DISTINCT `truck_no`) FROM trucks  WHERE $query AND `delete_status` !='1'  "),0));
			    $type_arry["driverName"] = mysql_result(mysql_query("SELECT  `driverName` FROM trucks  WHERE $query AND `delete_status` !='1' ORDER BY `driverName` LIMIT 1 "),0);
			    $type_arry["mobile"] = mysql_result(mysql_query("SELECT  `mobile` FROM trucks  WHERE $query AND `delete_status` !='1' ORDER BY `driverName` LIMIT 1 "),0);
			    $type_arry["licenseNo"] = mysql_result(mysql_query("SELECT  `driverLicenseNo` FROM trucks  WHERE $query AND `delete_status` !='1' ORDER BY `driverName` LIMIT 1 "),0);
			    $type_arry["countExp"] = number_format(mysql_result(mysql_query("SELECT count(DISTINCT `id`) FROM `expense`  WHERE $queryex  AND `delete_status` !='1' "),0));
			 
        return json_encode($type_arry); 
 }

 
 // get others
 function  get_others($projectName,$floorNo){
	 
			 $projectName = (trim($projectName) == '')?'':" AND `project-name`='$projectName'";
			 $floorNo = (trim($floorNo) == '')?'':" AND `floorNo`='$floorNo'";
			 $type_arry = Array();
	 	
				               // ALL others and totalls
				$type_arry["allCounts"] =   number_format(mysql_result(mysql_query("SELECT count(`id`) FROM `others` WHERE `delete_status` !='1' $projectName  $floorNo  "),0));
 	            $type_arry['all']['all_cost'] =  number_format(mysql_result(mysql_query("SELECT sum(`Cost`) FROM `others` WHERE `delete_status` !='1'  $projectName  $floorNo  "),0),2);
        return json_encode($type_arry); 
		}
 

   // get products
 function  get_trucks($tt){
	  
			 $type_arry = Array();
	 
				$type_arry["allCounts"] = number_format(mysql_result(mysql_query("SELECT count(DISTINCT `$tt`) FROM `registerd_trucks`  WHERE `delete_status` !='1'  "),0));

				 $type_arry['totalPrice'] =  mysql_result(mysql_query("SELECT sum(`cost`) FROM `trucks` WHERE `delete_status`!='1' "),0);
				 $type_arry['eCost'] =  mysql_result(mysql_query("SELECT sum(`cost`) FROM `expense` WHERE `delete_status`!='1' "),0);
				 $profitCalc =  $type_arry['totalPrice'] - $type_arry['eCost'];
				 $type_arry['eCost'] =	number_format($type_arry['eCost'],2);			
				$type_arry['totalPrice'] = number_format($type_arry['totalPrice'],2);
				$type_arry['profit'] = '<b style="color:'.((preg_match('/-/',$profitCalc))?'red':'green').';">'.number_format($profitCalc,2).'</b>';
				
				
	    return json_encode($type_arry); 
      }

// get Trash
 function  get_Trash(){
	  
			 $type_arry = Array();
	 	        $type_arry['hCost'] =  number_format(mysql_result(mysql_query("SELECT sum(`cost`) FROM `trucks` WHERE `delete_status` ='1' "),0));
				
				$type_arry['eCost'] =  number_format(mysql_result(mysql_query("SELECT sum(`cost`) FROM `expense` WHERE `delete_status` ='1' "),0),2);
                $type_arry['eQuantity']=  number_format(mysql_result(mysql_query("SELECT sum(`quantity`) FROM `expense` WHERE  `delete_status` ='1'"),0));
				
				
				$type_arry["truckCount"] = number_format(mysql_result(mysql_query("SELECT count(DISTINCT `id`) FROM trucks  WHERE `delete_status` ='1'  "),0));
			    $type_arry["countExp"] = number_format(mysql_result(mysql_query("SELECT count(DISTINCT `id`) FROM `expense`  WHERE `delete_status` ='1' "),0));
			 
        return json_encode($type_arry); 
      }	  
	  
// getAvailable Tags for AutoComplate
     function getData($query,$collmName){
						   $collectedData = Array();
						   $ll  = mysql_query($query);
							while($rows = mysql_fetch_assoc($ll)){
							   $collectedData[] = 	$rows[$collmName];
							}
						return $collectedData;
						}
 
 function  getAvailableTags(){
					$jsonData = Array();				
	
						$jsonData['eType'] = getData("SELECT DISTINCT `type` FROM `expense` WHERE `delete_status`!='1'",'type');
						$jsonData['names'] =  getData("SELECT DISTINCT `name` FROM `expense` WHERE `delete_status`!='1'",'name');
					    $jsonData['from'] =  getData("SELECT DISTINCT `source` FROM `trucks` WHERE `delete_status` !='1'",'source');
						$jsonData['to'] = getData("SELECT DISTINCT `distination` FROM `trucks` WHERE `delete_status` !='1'",'distination');
						$jsonData['itemName'] = getData("SELECT DISTINCT `itemName` FROM `trucks` WHERE `delete_status` !='1'",'distination');

						
						$jsonData['truck_no'] = getData("SELECT DISTINCT `truck_no` FROM `trucks` WHERE `delete_status` !='1'",'truck_no');
						$jsonData['driverLicenseNo'] =  getData("SELECT DISTINCT `driverLicenseNo` FROM `trucks` WHERE `delete_status` !='1'",'driverLicenseNo'); 

						$jsonData['mobiles'] =  getData("SELECT DISTINCT `mobile` FROM `trucks` WHERE `delete_status` !='1'",'mobile'); 
					
						$jsonData['driverName'] = getData("SELECT DISTINCT `driverName` FROM `trucks` WHERE `delete_status` !='1'",'driverName'); 
						return json_encode($jsonData); 
				}	  

// load function 
function load($data_arry){   // type and id 

   // check login 
   if(if_logged_in() != true){
    die();
   }
 
 // security validation 
 $id = sanitize($data_arry['id']);
 $data_arry['type'] = sanitize($data_arry['type']);


  // start 	 
	$type_arry = Array();

	if($data_arry['type'] == 'trash'){
		return get_Trash();
		
	}else if($data_arry['type'] == 'trucks'){  // suppliers main tab 

		   return get_trucks('truck_no');
		   
	}else if($data_arry['type'] == 'Income'){  //drivers

		   return get_trucks('truck_no');
		   
	}else if($data_arry['type'] == 'truckHistry' || $data_arry['type'] == 'driverHistry'){  
		
	       return get_history('',$data_arry['type'],$id);
		   
    }else if($data_arry['type'] == 'expenses'){ 
				
         return get_expenses('','');
		
	}else if($data_arry['type'] == 'others'){
		return get_others('','');
	}
	//  return ';;;;;'.$data_arry['type'];
 
  }

  
 
    
  // make payment
  function make_payment($data){  // suplier_id, amount , description
	 if(if_logged_in() != true){
      die();
      }
	  
	  	$amount = sanitize($data['amount']); 
		$description = (empty($data['description']))?'':sanitize($data['description']); 
		$suplier_id = sanitize($data['suplier_id']);
        $amount_1  = $amount;
 	  	$current_balance = mysql_result(mysql_query("SELECT sum(`total_balance`) FROM `suppliers` WHERE `supplier-account-id`=$suplier_id AND `delete_status` !='1' "),0);
  	  	$current_paid = mysql_result(mysql_query("SELECT sum(`total_paid`) FROM `suppliers` WHERE `supplier-account-id`=$suplier_id AND `delete_status` !='1'"),0);
        $date  =  sanitize($data['date']);  // date('d/M/Y @ h:i:s a',time());
	   	$date  =  ($date == '')?date('d-M-Y',time()):date('d-M-Y',strtotime(str_replace('/','-',$date)));
	    $date =   strtotime($date);
	
   
      // validation then queries
     if(!is_numeric($current_balance) || !is_numeric($amount)){
		 exit("error invalid Amount !!");	
	 }else if($current_balance < $amount){ 
		 exit("error invalid Amount !!");	
	 }else{
          
		 // fix the suplier products
		 if($suplier_products_query = mysql_query("SELECT `id`,`paid`,`balance` FROM `suppliers-history` WHERE `supplier-account-id`=$suplier_id AND `delete_status`!='1' ")){
			 while($product_row = mysql_fetch_array($suplier_products_query)){
	  
	            $id  = $product_row['id'];
	            $paid  = $product_row['paid'];					
				$balance = $product_row['balance'];
 
					  if ($amount != '0'){
						  
								if($amount > $balance){
								   $paid  = $balance + $paid;
								   $amount = $amount - $balance;
								   $balance = 0; 
								}else{
									$paid  = $paid + $amount;
									$balance = $balance - $amount;
									$amount = 0;
								}
								 mysql_query("UPDATE `suppliers-history` SET `paid`='$paid',`balance`='$balance' WHERE  `id`=$id");
					  }
 
	        }
		 }
		
		
		 	
	     // update suplier main totals 
		 $new_current_paid = $current_paid + $amount_1;
		 $new_current_balance = $current_balance - $amount_1;		 
         if(mysql_query("UPDATE `suppliers` SET `total_paid`='$new_current_paid',`total_balance`='$new_current_balance' WHERE `supplier-account-id`=$suplier_id")){
	               // payment history 
				   mysql_query("INSERT INTO `payment_history`(`paid`, `date`, `description`, `supplier-account-id`,`delete_status`) VALUES ('$amount_1','$date','$description','$suplier_id','0');");
		  }  
	
		 
		 return '1';
		 
	    }
 
	  
	  
  }
  
  
  // register
  function  register($truck_no,$driverName,$driverLicenseNo,$mobile){  //  | returns id after registering 
  	   if(if_logged_in() != true){
      die();
      }
	
		 if(mysql_result(mysql_query("SELECT COUNT(id) FROM `registerd_trucks` WHERE `truck_no`='$truck_no'"),0) == '1'){
			 return $truck_no;
		 }else{
			 mysql_query("INSERT INTO `registerd_trucks`(`id`, `truck_no`, `delete_status`, `driverName`, `mobile`, `driverLicenseNo`) VALUES ('','$truck_no','0','$driverName','$mobile','$driverLicenseNo')");
		     return $truck_no;
		 }

			 
			 }
 
  
  	// detects then validates 
  function validate_add($data){ 
	 	$tableName = sanitize($data['tableName']); 
		$name = sanitize($data['name'][0]);
		$suplier_id = sanitize($data['account_id']);
	 
   $dataLenth = count($data['floorNo']);

	  for ($i=0; $i<$dataLenth; $i++) { 

      	$work_type = sanitize($data['work_type'][$i]);
		$number_of_workers = sanitize($data['number_of_workers'][$i]);
		$cost = sanitize($data['cost'][$i]);
		$product_name = sanitize($data['product_name'][$i]);
		$product_type = sanitize($data['product_type'][$i]);
		$quantity = sanitize($data['quantity'][$i]);
		$single_cost = sanitize($data['single_cost'][$i]);
		$total_cost = sanitize($data['total_cost'][$i]);
		$project_name = sanitize($data['project_name'][$i]);
		$floorNo = sanitize($data['floorNo'][$i]);		
	    $description = sanitize($data['description'][$i]);
 
 
    	   
		// detect then validate  
		if($tableName == 'suppliers'){
				// suplier validation
			  if(empty($name) || empty($product_name) || empty($product_type) || empty($project_name) || empty($floorNo) || !is_numeric($quantity) || !is_numeric($single_cost) || !is_numeric($total_cost)){
					exit('sorry please fill required fields !!!');	
			  } 
			
			}else if($tableName == 'others'){
				// others validation
			  if(empty($name) || empty($project_name) || empty($floorNo) || !is_numeric($cost)){
					exit('sorry please fill required fields !!!');	
			  } 
 					  
			}else if($tableName == 'workers'){
		       // workers validation
			  if(empty($name) || empty($work_type) || empty($number_of_workers) || empty($project_name) || empty($floorNo) || !is_numeric($cost)){
				//	exit("empty($name) || empty(".$data['cost'][$i].") || empty($number_of_workers) || empty($project_name) || empty($floorNo) || !is_numeric(".$i.")");	
			    exit('sorry please fill required fields !!!');
               } 
					 
		    }
	 
	 
	 
	 
 }
    return true;
  }
 
  
  // add 
 function add($data){ // 'id','type',values_array['values']]  || you can suplier,others,workers
	   if(if_logged_in() != true){
      die();
      }

	$tableName = sanitize($data['tableName']);
    $id = sanitize($data['id']);
 	

	if($tableName == 'trucks'){
		$dataLenth = count($data['cost']);
	}else if($tableName == 'expense'){
         $dataLenth = count($data['excost']);
	}else{
		$dataLenth = count($data['truck_no']);
	}
 
			
		  for ($i=0; $i<$dataLenth; $i++) { 
		    
            $cost = sanitize($data['cost'][$i]);
			 $quantity = sanitize($data['quantity'][$i]);
			  $unit_price = sanitize($data['unit_price'][$i]);
			$date = sanitize($data['date'][$i]);
			$description = sanitize($data['description'][$i]);
			$driverLicenseNo = sanitize($data['driverLicenseNo'][$i]);
			$driverName = sanitize($data['driverName'][$i]);
			$itemName = sanitize($data['itemName'][$i]);
			$mobile = sanitize($data['mobile'][$i]);
			$source = sanitize($data['source'][$i]);
			$distination = sanitize($data['distination'][$i]);
		    $truck_no = sanitize($data['truck_no'][$i]);
			
			    $type = sanitize($data['type'][$i]);
			    $edate = sanitize($data['edate'][$i]);
			    $excost = sanitize($data['excost'][$i]);
			    $eDescription = sanitize($data['edescription'][$i]);
				$equantity = sanitize($data['equantity'][$i]);
				$expenseName = sanitize($data['name'][$i]);
			 
				   $exdriverLicenseNo = (!empty($driverLicenseNo))?" Driver license No (".$driverLicenseNo.")":'';
				   $extruck_no = (!empty($truck_no))?", Truck No (".$truck_no.")":'';
				$expenseName = "$expenseName $extruck_no";
				
		
			// detect run queries
	     if($data['status'] == 'add'){
			if($tableName == 'trucks'){
				
				$truck_no = register($truck_no,$driverName,$driverLicenseNo,$mobile);  
		       
						mysql_query("INSERT INTO `trucks`(`id`, `truck_no`, `unit_price`,`quantity`,`driverName`, `driverLicenseNo`,`itemName`, `source`, `distination`, `cost`, `date`, `description`, `delete_status`,`mobile`) VALUES ('','$truck_no','$unit_price','$quantity','$driverName','$driverLicenseNo','$itemName','$source','$distination','$cost','$date','$description','0','$mobile')");
				 if(!empty($excost)){ 
						$currentTripId = mysql_result(mysql_query("SELECT id FROM `trucks` WHERE `truck_no`='$truck_no' ORDER BY id desc limit 1"),0);

				 // extra expense
						 mysql_query("INSERT INTO `expense`(`id`, `tripId`,`name`, `quantity`, `type`, `cost`, `description`, `date`, `delete_status`) VALUES ('','$currentTripId','$expenseName','$equantity','$type','$excost','$eDescription','$edate','0')");
						}

  
			 }else if($tableName == 'expense'){
                	
					$currentTripId = (!empty($truck_no))?mysql_result(mysql_query("SELECT id FROM `trucks` WHERE `truck_no`='$truck_no' ORDER BY id desc limit 1"),0):'';
					mysql_query("INSERT INTO `expense`(`id`, `tripId`, `name`, `quantity`, `type`, `cost`, `description`, `date`, `delete_status`) VALUES ('','$currentTripId','$expenseName','$equantity','$type','$excost','$eDescription','$edate','0')");
			
			}
			
		 }else if($data['status'] == 'edit'){
			
			 if($tableName == 'trucks'){
					mysql_query("UPDATE `trucks` SET `unit_price`='$unit_price', `quantity`='$quantity',  `truck_no`='$truck_no',`driverName`='$driverName',`driverLicenseNo`='$driverLicenseNo',`itemName`='$itemName',`source`='$source',`distination`='$distination',`cost`=$cost,`date`='$date',`description`='$description' WHERE `id`=$id");
				 }else if($tableName == 'expense'){
					mysql_query("UPDATE `expense` SET `name`='$expenseName',`quantity`='$equantity',`type`='$type',`cost`='$excost',`description`='$eDescription',`date`='$edate' WHERE id='$id' ");
            }
		 }else if($data['status'] == 'editDriver'){
			        mysql_query("UPDATE `registerd_trucks` SET `truck_no`='$truck_no',`driverName`='$driverName',`driverLicenseNo`='$driverLicenseNo',mobile='$mobile' WHERE `truck_no`='$id'");
				    mysql_query("UPDATE `expense` SET `name`='`name`($driverLicenseNo)' WHERE name like '%$id%' ");
		 }else if($data['status'] == 'editTruck'){  
			      mysql_query("UPDATE `registerd_trucks` SET `truck_no`='$truck_no',`driverName`='$driverName',`driverLicenseNo`='$driverLicenseNo',mobile='$mobile' WHERE `truck_no`='$id'");
				    mysql_query("UPDATE `expense` SET `name`= REPLACE(`name`, '$id', '$truck_no') WHERE name like '%, Truck No ($id)%' ");
					mysql_query("UPDATE `trucks` SET `truck_no`='$truck_no' WHERE `truck_no`='$id'");

		}
		     
		 
	 }
		
	    
			 // at end ------
			 echo '1';
     
 }

 
    // edit  
 function edit($data){ // 'id','type',values_array['values']]  || you can edit suplier,others,workers and etc
	   if(if_logged_in() != true){
      die();
      }
  
	$tableName = sanitize($data['tableName']);
	$name = sanitize($data['name'][0]);
	$id = sanitize($data['id']);
	$mobile = sanitize($data['mobile'][0]);
	$identity = sanitize($data['id_or_passport'][0]);
    $date  =  sanitize($data['date'][0]);  // date('d/M/Y @ h:i:s a',time());
	
    $date  =  ($date == '')?date('d-M-Y',time()):date('d-M-Y',strtotime(str_replace('/','-',$date)));
	$date =   strtotime($date);
	  
	  
	  
			$work_type = sanitize($data['work_type'][0]);
			$number_of_workers = sanitize($data['number_of_workers'][0]);
			$cost = sanitize($data['cost'][0]);
			$product_name = sanitize($data['product_name'][0]);
			$product_type = sanitize($data['product_type'][0]);
			$quantity = sanitize($data['quantity'][0]);
			$single_cost = sanitize($data['single_cost'][0]);
			$total_cost = sanitize($data['total_cost'][0]);
			$project_name = sanitize($data['project_name'][0]);
			$floorNo = sanitize($data['floorNo'][0]);		
			$description = sanitize($data['description'][0]);
					
	 
	 		    // detect then validate  
		     if($tableName == 'suppliers'){ 
				// suplier validation
			  if(empty($name)){
					exit('sorry please fill required fields !!!');	
			  } 
			
			}else if($tableName == 'others'){
				// others validation
			  if(empty($name) || empty($project_name) || empty($floorNo) || !is_numeric($cost)){
					exit('sorry please fill required fields !!!');	
			  } 
 					  
			}else if($tableName == 'workers'){
		       // workers validation
			  if(empty($name) || empty($work_type) || empty($number_of_workers) || empty($project_name) || empty($floorNo) || !is_numeric($cost)){
					exit('sorry please fill required fields !!!');			  
                   } 
					 
		    }else if($tableName == 'suppliers_history'){
		       // 'supplier products validation
                if(empty($product_name) || empty($product_type) || empty($project_name) || empty($floorNo)){
					exit("sorry please fill required fields !!!");	
			    } 
 		    }
	 
	 
			// detect then run queries
			if($tableName == 'suppliers'){
			        // suplier Account
	              mysql_query("UPDATE `suppliers` SET `supplier-name`='$name',`created_date`='$date',`mobile`='$mobile' WHERE `supplier-account-id`='$id' ");			 
				}else if($tableName == 'others'){
				  // others Query	
			     mysql_query("UPDATE `others` SET `name`='$name',`cost`='$cost',`date`='$date',`description`='$description',`project-name`='$project_name',`floorNo`='$floorNo' WHERE `id`=$id");    
  
				}else if($tableName == 'workers'){
			        // workers Query
                   mysql_query("UPDATE `workers` SET  `name`='$name',`id_or_passport`='$identity',`work-type`='$work_type',`cost`='$cost',`date`='$date',`number-or-workers`='$number_of_workers',`project-name`='$project_name',`floorNo`='$floorNo' WHERE `id`=$id ");
                }else if($tableName == 'suppliers_history'){
			        // suplier products
                     mysql_query("UPDATE `suppliers-history` SET `product-name`='$product_name',`product-type`='$product_type', `date`='$date',`project-name`='$project_name',`floorNo`='$floorNo' WHERE `id`=$id ");

			   }
 
			 
			 // at end ------
			 echo '1';
   
 }
 
 
 // fix payments to the products
 function autoFixer($sts,$status,$newAmount,$suplier_id){

 
		$c_total_Cost = mysql_result(mysql_query("SELECT sum(`total-Cost`) FROM `suppliers-history` WHERE `supplier-account-id`=$suplier_id AND `delete_status` !='1' "),0);
  	  	$current_paid = mysql_result(mysql_query("SELECT sum(`paid`) FROM `payment_history` WHERE `supplier-account-id`=$suplier_id AND `delete_status` !='1'"),0);
        $amount = $current_paid;
   
   
   if($status == 'checkCost'){ // check befere delete/restore
         
          $fCost = ($sts == 'r')?$c_total_Cost + $newAmount:$c_total_Cost - $newAmount;
		  
         if($fCost < $current_paid){ 
		     return 'noo';
	     }else{
			return 'yes';
		 }
	   
   }else if($status == 'checkPayment'){ // check befere delete/restore
   
		  $fpayment = ($sts == 'r')?$current_paid + $newAmount:$current_paid - $newAmount;
   
	     if($c_total_Cost < $fpayment){ 
		     return 'noo';
	     }else{
			return 'yes';
		 }
	   
 
   }else{
	   	 // validate  if total-cost is less totalpaid 
    if($c_total_Cost < $current_paid ){ 
		 exit('error sorry Invalid...');
	 }else{
          
		 // fix the suplier products
		 if($suplier_products_query = mysql_query("SELECT `total-Cost`,`id`,`paid`,`balance` FROM `suppliers-history` WHERE `supplier-account-id`=$suplier_id AND `delete_status`!='1' ")){
			 while($product_row = mysql_fetch_array($suplier_products_query)){
	  
	            $id  = $product_row['id']; 
				$total_cost_prod  = (trim($product_row['total-Cost']) == '')?0:trim($product_row['total-Cost']);  
	            $paid  = (trim($product_row['paid']) == '')?0:trim($product_row['paid']);
                $balance = (trim($product_row['balance']) == '')?0:trim($product_row['balance']);
 
              
				 
								if($amount > $total_cost_prod){
								   $paid  = $total_cost_prod;
								   $balance = $total_cost_prod - $paid; 
								   $amount = $amount - $total_cost_prod;
								}else{
									$paid = $amount;
									$balance = $total_cost_prod - $paid;
									$amount = 0;
								}
			     		 		
								 mysql_query("UPDATE `suppliers-history` SET `paid`='$paid',`balance`='$balance' WHERE  `id`=$id");
					 
 
	        }
		 }
		
	     // update suplier main totals 
		 $new_current_balance = $c_total_Cost - $current_paid;		 
         mysql_query("UPDATE `suppliers` SET `total_paid`='$current_paid',`total_balance`='$new_current_balance' WHERE `supplier-account-id`=$suplier_id");
 
       }
 
	   
   }
  
 }
 
 
  // restore delete
 function restore($data){
	if(if_logged_in() != true){
      die();
      }
  
  
	$id = sanitize($data['id']);
	$tableName = sanitize($data['tableName']);
    $id_coll_Name =  sanitize($data['id_coll_Name']); 
	
	$suplier_id = mysql_result(mysql_query("SELECT `supplier-account-id` FROM `$tableName` WHERE `$id_coll_Name`='$id'"),0);
	
	     // validate date payment history only 
	   if($tableName == 'payment_history'){ 
	       $fpaid = mysql_result(mysql_query("SELECT `paid` FROM `$tableName` WHERE `$id_coll_Name`='$id'"),0);
 
			  if(autoFixer('r','checkPayment',$fpaid,$suplier_id) == 'noo'){
				   exit('sorry please Restore the products first in the trash > products tab ! <br>  This payment can\'t be Restored becouse  the cost of the products is less-then payments !' );  
			     
		       }else{
						if(mysql_query("UPDATE `$tableName` SET `delete_status`='0' WHERE `$id_coll_Name`='$id'")){
						     echo '1';
						}else{
							echo 'Sorry Error Restoring !!!';		
						}
			   }
			   
	   }else if($tableName == 'suppliers'){ 
				// restore all for suplier products, payment history
	   	   if(mysql_query("UPDATE `$tableName` SET `delete_status`='0' WHERE `$id_coll_Name`='$id'")){
			   
			   mysql_query("UPDATE `payment_history` SET `delete_status`='0' WHERE `supplier-account-id`='$id'"); // payments
			   mysql_query("UPDATE `suppliers-history` SET `delete_status`='0' WHERE `supplier-account-id`='$id'"); // products
				echo '1';
			}else{
				echo 'Sorry Error Restoring !!!';		
			}
	 
 
	   }else if($tableName == 'restTruck'){
		   
		   
				// restTruck truck, account
	   	   if(mysql_query("UPDATE `registerd_trucks` SET `delete_status`='0' WHERE `truck_no`='$id'")){
			   mysql_query("UPDATE `trucks` SET `delete_status`='0' WHERE `truck_no`=$id");
			   mysql_query("UPDATE `registerd_trucks` SET `delete_status`='0' WHERE `truck_no`='$id'"); // payments
			   mysql_query("UPDATE `expense` SET `delete_status`='0' WHERE `name` like '%, Truck No ('$id')%'"); // products
				echo '1';
			}else{
				echo 'Sorry Error Deleting !!!';		
			}
	 
	   }else{
		   
		   
			 
			   if(mysql_query("UPDATE `$tableName` SET `delete_status`='0' WHERE `$id_coll_Name`='$id'")){
					echo '1';
				}else{
					echo 'Sorry Error Restoring !!!';		
				}
			
		}
 
         // finally autoFix 
        if($tableName == 'payment_history' || $tableName == 'suppliers-history') {
			autoFixer('','','',$suplier_id);
		} 
 
 } 
 
 

  // delete function
 function delete_($data){
	if(if_logged_in() != true){
      die();
      }
  
	$id = sanitize($data['id']);
	$tableName = sanitize($data['tableName']);
    $id_coll_Name =  sanitize($data['id_coll_Name']); 
	$suplier_id = mysql_result(mysql_query("SELECT `supplier-account-id` FROM `$tableName` WHERE `$id_coll_Name`='$id'"),0);	
	
	// validate supplier history only 
	 if($tableName == 'suppliers-history'){ 
	       $fCost = mysql_result(mysql_query("SELECT `total-Cost` FROM `$tableName` WHERE `$id_coll_Name`='$id'"),0);  
           if(autoFixer('d','checkCost',$fCost,$suplier_id) == 'noo' ){
			    exit('sorry please delete the payment first > in the payment history !');  
		   }else{ 
				if(mysql_query("UPDATE `$tableName` SET `delete_status`='1' WHERE `$id_coll_Name`='$id'")){
				  echo '1';
				}else{
					echo 'Sorry Error Deleting !!!';		
				}
		   }
    }else if($tableName == 'dellTruck'){
		
				// dellate truck, account
	   	   if(mysql_query("UPDATE `registerd_trucks` SET `delete_status`='1' WHERE `truck_no`='$id'")){
			   mysql_query("UPDATE `trucks` SET `delete_status`='1' WHERE `truck_no`=$id");
			   mysql_query("UPDATE `registerd_trucks` SET `delete_status`='1' WHERE `truck_no`='$id'"); // payments
			   mysql_query("UPDATE `expense` SET `delete_status`='1' WHERE `name` like '%, Truck No ('$id')%'"); // products
				echo '1';
			}else{
				echo 'Sorry Error Deleting !!!';		
			}
	 
 
	   }else{
			if(mysql_query("UPDATE `$tableName` SET `delete_status`='1' WHERE `$id_coll_Name`='$id'")){
		      echo '1';
			}else{
				echo 'Sorry Error Deleting !!!';		
			}
		
	}
	 
          // finally autoFix  
     if($tableName == 'payment_history' || $tableName == 'suppliers-history'){
		 autoFixer('','','',$suplier_id);
		 
	 }  
 
 } 
  
  
  // check date manual or dynamic
 function check_date(){
	$date_arr = array('current_date'=>date('Y-m-d',time()),'date_status'=>mysql_result(mysql_query('SELECT `date_settings` FROM `adminSettings` limit 1'),0));
	return json_encode($date_arr);
 }
  
  
  


?>
