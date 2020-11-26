<?php 
   error_reporting(0);
 
 
$myServer = "demo.yahyedemo.tk";
$myUser = "demosystems";  // 
$myPass = 'gSfgV2Sl$$xN';
$myDB = "constructiondemoo"; 
 
 
    //connection to the database
  if(!@mysql_connect($myServer, $myUser, $myPass)){
   die("Error't connect To the server "); 
  }else if(!@mysql_select_db($myDB)){
    die("Couldn't open database "); 
  }else{
  
  }
  


 mysql_query("CREATE DATABASE truckSystem");
 
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
 

// get workers
 function  get_workers($projectName,$floorNo){
   
   $projectName = (trim($projectName) == '')?'':" AND `project-name`='$projectName'";
   $floorNo = (trim($floorNo) == '')?'':" AND `floorNo`='$floorNo'"; 
   $type_arry = Array();
   
       // work-types   
    if($product_tabs = mysql_query("SELECT DISTINCT `work-type` FROM `workers` WHERE `delete_status` !='1'  $projectName $floorNo ORDER BY `work-type` ASC")){
         // ALL worker type and totalls
        $type_arry["work_types"]['All'][2] =  number_format(mysql_result(mysql_query("SELECT sum(`number-or-workers`) FROM `workers` WHERE `delete_status` !='1'   $projectName $floorNo "),0));
               
          $type_arry["work_types"]['All'][3] =  number_format(mysql_result(mysql_query("SELECT sum(`number-or-workers`) FROM `workers` WHERE `delete_status` !='1'   $projectName $floorNo  "),0));
               $type_arry["work_types"]['All'][4] =  number_format(mysql_result(mysql_query("SELECT sum(`cost`) FROM `workers` WHERE `delete_status` !='1'   $projectName $floorNo  "),0),2);
  
      
      while($product_tabs_row = mysql_fetch_assoc($product_tabs)){
         // worker type and totalls
       
        $type_arry["work_types"][$product_tabs_row["work-type"]][3] = number_format(mysql_result(mysql_query("SELECT sum(`number-or-workers`) FROM `workers` WHERE `work-type`='".$product_tabs_row["work-type"]."' AND `delete_status` !='1'  $projectName $floorNo "),0));
        $type_arry["work_types"][$product_tabs_row["work-type"]][4] =  number_format(mysql_result(mysql_query("SELECT sum(`cost`) FROM `workers` WHERE `work-type`='".$product_tabs_row["work-type"]."' AND `delete_status` !='1'   $projectName $floorNo  "),0),2);
 
        $type_arry["work_types"][$product_tabs_row["work-type"]][2] =number_format(mysql_result(mysql_query("SELECT sum(`number-or-workers`) FROM `workers` WHERE `work-type`='".$product_tabs_row["work-type"]."' AND `delete_status` !='1'   $projectName $floorNo  "),0));
      }
 
          }

    
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
 function  get_products($projectName,$floorNo,$id){
   
       $projectName = (trim($projectName) == '')?'':" AND `project-name`='$projectName'";
       $floorNo = (trim($floorNo) == '')?'':" AND `floorNo`='$floorNo'"; 
       $ext_query = $projectName.''.$floorNo; 
       $suplier = (trim($id) != '')?'`supplier-account-id`='.$id.' AND ':''; 
       
      
       $type_arry = Array();
   
     // product-types   
    if($product_tabs = mysql_query("SELECT DISTINCT `product-type` FROM `suppliers-history` WHERE $suplier `delete_status` !='1' $ext_query ORDER BY `product-type` ASC")){
      
         // totals for all for current supplier
        $type_arry["product_types"]['All'][2] =  number_format(mysql_result(mysql_query("SELECT count(`id`) FROM `suppliers-history` WHERE $suplier `delete_status` !='1' $ext_query"),0));
               
          $type_arry["product_types"]['All'][6] =  number_format(mysql_result(mysql_query("SELECT sum(`quantity`) FROM `suppliers-history`  WHERE $suplier `delete_status` !='1' $ext_query"),0));
               $type_arry["product_types"]['All'][3] =  number_format(mysql_result(mysql_query("SELECT sum(`total-Cost`) FROM `suppliers-history`  WHERE $suplier  `delete_status` !='1' $ext_query "),0),2);
        $type_arry["product_types"]['All'][4] =  number_format(mysql_result(mysql_query("SELECT sum(paid) FROM `suppliers-history`   WHERE  $suplier  `delete_status` !='1' $ext_query "),0),2);
        $type_arry["product_types"]['All'][5] =  number_format(mysql_result(mysql_query("SELECT sum(`balance`) FROM `suppliers-history` WHERE  $suplier  `delete_status` !='1' $ext_query"),0),2);
                  /// ganaral 
        $type_arry['id'] = $id;
        $type_arry['name'] =  mysql_result(mysql_query("SELECT `supplier-name` FROM `suppliers` WHERE $suplier `delete_status` !='1' $ext_query "),0);
        $type_arry['mobile'] =  mysql_result(mysql_query("SELECT `mobile` FROM `suppliers` WHERE $suplier `delete_status` !='1' $ext_query "),0);

      
      while($product_tabs_row = mysql_fetch_assoc($product_tabs)){
         // totals for current product-type
         
        $type_arry["product_types"][$product_tabs_row["product-type"]][6] = number_format(mysql_result(mysql_query("SELECT sum(`quantity`) FROM `suppliers-history` WHERE  $suplier `product-type`='".$product_tabs_row["product-type"]."' AND `delete_status` !='1' $ext_query "),0));
        $type_arry["product_types"][$product_tabs_row["product-type"]][3] =  number_format(mysql_result(mysql_query("SELECT sum(`total-Cost`) FROM `suppliers-history` WHERE  $suplier  `product-type`='".$product_tabs_row["product-type"]."' AND `delete_status` !='1' $ext_query "),0),2);
                $type_arry["product_types"][$product_tabs_row["product-type"]][4] = number_format(mysql_result(mysql_query("SELECT sum(`paid`) FROM `suppliers-history` WHERE  $suplier  `product-type`='".$product_tabs_row["product-type"]."' AND `delete_status` !='1' $ext_query"),0),2);
        $type_arry["product_types"][$product_tabs_row["product-type"]][5] =  number_format(mysql_result(mysql_query("SELECT sum(`balance`) FROM `suppliers-history` WHERE  $suplier `product-type`='".$product_tabs_row["product-type"]."' AND `delete_status` !='1' $ext_query "),0),2);
      
      
        $type_arry["product_types"][$product_tabs_row["product-type"]][2] =number_format(mysql_result(mysql_query("SELECT count(`id`) FROM `suppliers-history` WHERE  $suplier `product-type`='".$product_tabs_row["product-type"]."' AND `delete_status` !='1' $ext_query"),0));
 
      }
 
                
    }
        return json_encode($type_arry); 
    
      }
 
   // get products
 function  get_Suppliers(){
    
       $type_arry = Array();
   
        $type_arry["allCounts"] = number_format(mysql_result(mysql_query("SELECT count(DISTINCT `supplier-account-id`) FROM suppliers  WHERE `delete_status` !='1'  "),0));
        $type_arry["debsCounts"] = number_format(mysql_result(mysql_query("SELECT count(DISTINCT `supplier-account-id`) FROM suppliers WHERE total_balance !=0 AND `delete_status` !='1'   "),0));
        // totals 
        $type_arry["total_Paid"] = number_format(mysql_result(mysql_query("SELECT sum(`total_paid`) FROM suppliers WHERE `delete_status` !='1'   "),0),2);
        $type_arry["Total_Balance"] = number_format(mysql_result(mysql_query("SELECT sum(`total_balance`) FROM suppliers WHERE `delete_status` !='1'    "),0),2);
        $type_arry["total_Cost"] = number_format(mysql_result(mysql_query("SELECT sum(`total_total-Cost`) FROM suppliers WHERE `delete_status` !='1'    "),0),2);
       
        //totals for debts
        $type_arry["total_d_Paid"] = number_format(mysql_result(mysql_query("SELECT sum(`total_paid`) FROM suppliers WHERE total_balance !=0 AND `delete_status` !='1'    "),0),2);
        $type_arry["Total_d_Balance"] = number_format(mysql_result(mysql_query("SELECT sum(`total_balance`) FROM suppliers WHERE total_balance !=0 AND `delete_status` !='1'   "),0),2);
        $type_arry["total_d_Cost"] = number_format(mysql_result(mysql_query("SELECT sum(`total_total-Cost`) FROM suppliers WHERE total_balance !=0 AND `delete_status` !='1'  "),0),2);
       
      return json_encode($type_arry); 
      }

// get Trash
 function  get_Trash(){
    
       $trash = Array();
   
        $trash["countSup"] = number_format(mysql_result(mysql_query("SELECT count(DISTINCT `supplier-account-id`) FROM suppliers  WHERE `delete_status` ='1'  "),0));
        $trash["countProducts"] = number_format(mysql_result(mysql_query("SELECT count(`id`) FROM `suppliers-history` WHERE  `delete_status`='1'"),0));   
        $trash["countOthers"] = number_format(mysql_result(mysql_query("SELECT count(`id`) FROM `others` WHERE `delete_status` ='1'  "),0));
               $trash["countWorkers"] =  number_format(mysql_result(mysql_query("SELECT count(`id`) FROM `workers` WHERE `delete_status`='1' "),0));
                    $trash["countPayments"] =  number_format(mysql_result(mysql_query("SELECT count(`id`) FROM `payment_history` WHERE `delete_status`='1' "),0));

        return json_encode($trash); 
      }    
    
// getAvailable Tags for AutoComplate
     function getData($query,$collmName){
               $collectedData = Array();
               $ll  = mysql_query($query);
              while($rows = mysql_fetch_assoc($ll)){
                 $collectedData[] =   $rows[$collmName];
              }
            return $collectedData;
            }
 
 function  getAvailableTags(){
 
            $jsonData = Array();
                  $jsonData['workTypes'] =  getData("SELECT DISTINCT `work-type` FROM `workers` WHERE `delete_status` !='1'",'work-type');
            $jsonData['names'] =    array_unique(array_merge(getData("SELECT DISTINCT `name` FROM `workers` WHERE `delete_status` !='1' ",'name'),getData("SELECT DISTINCT `name` FROM `others` WHERE `delete_status` !='1' ",'name'), getData("SELECT DISTINCT `supplier-name` FROM `suppliers-history` WHERE `delete_status` !='1' ",'supplier-name')));
              $jsonData['floorNos'] =  array_merge(getData("SELECT DISTINCT `floorNo` FROM `workers` WHERE `delete_status` !='1' ",'floorNo'),getData("SELECT DISTINCT `floorNo` FROM `others` WHERE `delete_status` !='1' ",'floorNo'), getData("SELECT DISTINCT `floorNo` FROM `suppliers-history` WHERE `delete_status` !='1' ",'floorNo'));
            $jsonData['project_names'] = array_merge(getData("SELECT DISTINCT `project-name` FROM `workers` WHERE `delete_status` !='1' ",'project-name'),getData("SELECT DISTINCT `project-name` FROM `others` WHERE `delete_status` !='1' ",'project-name'), getData("SELECT DISTINCT `project-name` FROM `suppliers-history` WHERE `delete_status` !='1' ",'project-name'));
            
            
            $jsonData['product_types'] = getData("SELECT DISTINCT `product-type` FROM `suppliers-history` WHERE `delete_status` !='1' ",'product-type');
            $jsonData['product_Names'] = getData("SELECT DISTINCT `product-name` FROM `suppliers-history` WHERE `delete_status` !='1' ",'product-name');
            $jsonData['mobiles'] =  getData("SELECT DISTINCT `mobile` FROM `suppliers-history` WHERE `delete_status` !='1' ",'mobile');
            
          
            $jsonData['identitys'] = getData("SELECT DISTINCT `id_or_passport` FROM `workers` WHERE `delete_status` !='1'",'id_or_passport');
            
            $jsonData['floorNos'] = explode('*',implode('*', array_unique($jsonData['floorNos'])));
            $jsonData['project_names'] = explode('*',implode('*', array_unique($jsonData['project_names'])));
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
    
  }else if($data_arry['type'] == 'suppliers'){  // suppliers main tab 

       return get_Suppliers();
       
  }else if($data_arry['type'] == 'suppliers-history'){  
    
         return get_products('','',$id);
       
  }else if($data_arry['type'] == 'projects'){
        // projects    
 
              
    if($product_tabs = mysql_query("select distinct `project-name` from (select `project-name` from `workers` WHERE `delete_status` !='1' union select `project-name` from `suppliers-history` WHERE `delete_status` !='1' union select `project-name` from `others` WHERE `delete_status` !='1') t ORDER BY `project-name` DESC")){
                // floors 
        
      while($product_tabs_row = mysql_fetch_assoc($product_tabs)){
          // all for the entire project
              $type_arry["projects"][$product_tabs_row["project-name"]]['All']['products'] =  get_products($product_tabs_row["project-name"],'','');
              $type_arry["projects"][$product_tabs_row["project-name"]]['All']['workers'] =  get_workers($product_tabs_row["project-name"],'');
              $type_arry["projects"][$product_tabs_row["project-name"]]['All']['others'] =  get_others($product_tabs_row["project-name"],'');            
    
            $floors = mysql_query("select distinct `floorNo` from (select `floorNo` from `workers` WHERE `project-name`='".$product_tabs_row["project-name"]."' AND `delete_status` !='1' union select `floorNo` from `suppliers-history` WHERE `project-name`='".$product_tabs_row["project-name"]."' AND `delete_status` !='1' union select `floorNo` from `others` WHERE `project-name`='".$product_tabs_row["project-name"]."' AND `delete_status` !='1') t ORDER BY `floorNo` ASC");
            
    // get floors for the current project
            while($floors_row = mysql_fetch_assoc($floors)){    
              $type_arry["projects"][$product_tabs_row["project-name"]][$floors_row["floorNo"]]['products'] =  get_products($product_tabs_row["project-name"],$floors_row["floorNo"],'');
              $type_arry["projects"][$product_tabs_row["project-name"]][$floors_row["floorNo"]]['workers'] =  get_workers($product_tabs_row["project-name"],$floors_row["floorNo"]);
              $type_arry["projects"][$product_tabs_row["project-name"]][$floors_row["floorNo"]]['others'] =  get_others($product_tabs_row["project-name"],$floors_row["floorNo"]);            
              }
        
          

          // Floor numbers for the current project
          $floorNumbers =    mysql_result(mysql_query("SELECT count(DISTINCT aa.id) FROM (SELECT DISTINCT `floorNo` AS id FROM `workers` WHERE `project-name`='".$product_tabs_row["project-name"]."' AND `delete_status` !='1' UNION ALL SELECT DISTINCT `floorNo` AS id FROM `suppliers-history` WHERE `project-name`='".$product_tabs_row["project-name"]."' AND `delete_status` !='1'  UNION ALL SELECT DISTINCT `floorNo` AS id FROM `others` WHERE `project-name`='".$product_tabs_row["project-name"]."' AND `delete_status` !='1' )  AS aa "),0);

            $type_arry["projects"][$product_tabs_row["project-name"]]["allCounts"] = number_format($floorNumbers);
   
      }
 
                  // number of projects
          $number_of_projects =   mysql_result(mysql_query("SELECT count(DISTINCT aa.id) FROM (SELECT DISTINCT `project-name` AS id FROM `workers` WHERE `delete_status` !='1'  UNION ALL SELECT DISTINCT `project-name` AS id FROM `suppliers-history` WHERE `delete_status` !='1'  UNION ALL SELECT DISTINCT `project-name` AS id FROM `others` WHERE `delete_status` !='1' )  AS aa "),0);
                  $type_arry["allCounts"] = $number_of_projects;
 
    }
     
        return json_encode($type_arry); // return complate awsome projecs 
 
  }else if($data_arry['type'] == 'workers'){ 
        
         return get_workers('','');
    
  }else if($data_arry['type'] == 'others'){
    return get_others('','');
  }
    
 
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
  function register($type){  //  | returns id after registering 
       if(if_logged_in() != true){
      die();
      }
     if(mysql_query("INSERT INTO `suppliers`(`supplier-account-id`, `supplier-name`, `mobile`, `created_date`, `delete_status`) VALUES ('','".sanitize($type['name'])."','".sanitize($type['mobile'])."','".sanitize($type['date'])."','0')")){
       return mysql_result(mysql_query("SELECT `supplier-account-id` FROM suppliers ORDER BY `supplier-account-id` DESC LIMIT 1"),0);
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
        //  exit("empty($name) || empty(".$data['cost'][$i].") || empty($number_of_workers) || empty($project_name) || empty($floorNo) || !is_numeric(".$i.")");  
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
  $name = sanitize($data['name'][0]);
  $suplier_id = sanitize($data['account_id']);
  $mobile = sanitize($data['mobile'][0]);
    $payment_amount = sanitize($data['payment_amount']);
  $paymentDate = sanitize($data['paymentDate']);
  
    $paymentDate  =  ($paymentDate == '')?date('d-M-Y',time()):date('d-M-Y',strtotime(str_replace('/','-',$paymentDate)));
  $paymentDate =   strtotime($paymentDate);
 
  
    $register_arr = array('mobile'=>$mobile,'date'=>strtotime(date('d-M-Y',time())),'name'=>$name);
   //print_r($data);die();
     if(validate_add($data)){
 
          $dataLenth = count($data['floorNo']);

      for ($i=0; $i<$dataLenth; $i++) { 
            $identity = sanitize($data['id_or_passport'][$i]);
      $work_type = sanitize($data['work_type'][$i]);
      $number_of_workers = sanitize($data['number_of_workers'][$i]);
      $cost = sanitize($data['cost'][$i]);
      $w_single_cost = sanitize($data['w_single_cost'][$i]);
    
      $product_name = sanitize($data['product_name'][$i]);
      $product_type = sanitize($data['product_type'][$i]);
      $quantity = sanitize($data['quantity'][$i]);
    
      $total_cost = sanitize($data['total_cost'][$i]);
      $project_name = sanitize($data['project_name'][$i]);
      $floorNo = sanitize($data['floorNo'][$i]);    
      $description = sanitize($data['description'][$i]);
          
       $date  =  sanitize($data['date'][$i]); 

           $date  =  ($date == '')?date('d-M-Y',time()):date('d-M-Y',strtotime(str_replace('/','-',$date)));
           $date =   strtotime($date);
   
   
   
      // detect then validate and run queries
      if($tableName == 'suppliers'){
        // register if not 
        $suplier_id = (!is_numeric($suplier_id))?register($register_arr):$suplier_id;  
               // suplier products Query
                mysql_query("INSERT INTO `suppliers-history`(`supplier-name`,`mobile`,`product-name`, `product-type`, `quantity`, `single-cost`, `total-Cost`, `paid`, `balance`, `date`, `project-name`, `floorNo`, `delete_status`, `supplier-account-id`) VALUES ('$name','$mobile','$product_name','$product_type','$quantity','$single_cost','$total_cost','0','$total_cost','$date','$project_name','$floorNo','0','$suplier_id')");       
        }else if($tableName == 'others'){

          $name = sanitize($data['name'][$i]);
          $mobile = sanitize($data['mobile'][$i]);
          // others Query  
           mysql_query("INSERT INTO `others`(`name`, `cost`, `date`, `description`, `project-name`, `floorNo`, `delete_status`) VALUES ('$name','$cost','$date','$description','$project_name','$floorNo','0')");
  
        }else if($tableName == 'workers'){
                  $name = sanitize($data['name'][$i]);
          $mobile = sanitize($data['mobile'][$i]);
              // workers Query
                   mysql_query("INSERT INTO `workers`(`w_single_cost`,`name`, `id_or_passport`, `work-type`, `cost`, `date`, `number-or-workers`, `project-name`, `floorNo`, `delete_status`) VALUES ('$w_single_cost','$name','$identity','$work_type','$cost','$date','$number_of_workers','$project_name','$floorNo','0')");
        }
     
     
     
     
   }
    
    
      if($tableName == 'suppliers'){
         // update totals
         $current_quantity = mysql_result(mysql_query("SELECT sum(`total_quantity`) FROM `suppliers` WHERE `supplier-account-id`=$suplier_id"),0) + array_sum($data['quantity']);
         $current_total_single_cost = mysql_result(mysql_query("SELECT sum(`total_single-cost`) FROM `suppliers` WHERE `supplier-account-id`=$suplier_id"),0) + array_sum($data['single_cost']);
         $current_total_cost = mysql_result(mysql_query("SELECT sum(`total_total-Cost`) FROM `suppliers` WHERE `supplier-account-id`=$suplier_id"),0) + array_sum($data['total_cost']);
         $current_total_paid = mysql_result(mysql_query("SELECT sum(`total_paid`) FROM `suppliers` WHERE `supplier-account-id`=$suplier_id"),0);
         $current_total_balance =  $current_total_cost -  $current_total_paid;
         
         mysql_query("UPDATE `suppliers` SET `total_quantity`='$current_quantity',`total_single-cost`='$current_total_single_cost',`total_total-Cost`='$current_total_cost', `total_balance`='$current_total_balance' WHERE `supplier-account-id`='$suplier_id'");
         // call make_payment if payment_amount  is not empty
         if(!empty($payment_amount)){
             
            make_payment(array('date'=>$data['paymentDate'],'suplier_id'=>$suplier_id,'amount'=>$payment_amount,'description'=>$data['description_payment'])); // suplier_id, amount  
         }
        
       }
       
       // at end ------
       echo '1';
      } 
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
      $w_single_cost = sanitize($data['w_single_cost'][0]);    
   
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
                   mysql_query("UPDATE `workers` SET `w_single_cost`='$w_single_cost', `name`='$name',`id_or_passport`='$identity',`work-type`='$work_type',`cost`='$cost',`date`='$date',`number-or-workers`='$number_of_workers',`project-name`='$project_name',`floorNo`='$floorNo' WHERE `id`=$id ");
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
    }else if($tableName == 'suppliers'){ 
        // restore all for suplier products, payment history
          if(mysql_query("UPDATE `$tableName` SET `delete_status`='1' WHERE `$id_coll_Name`='$id'")){
         
         mysql_query("UPDATE `payment_history` SET `delete_status`='1' WHERE `supplier-account-id`='$id'"); // payments
         mysql_query("UPDATE `suppliers-history` SET `delete_status`='1' WHERE `supplier-account-id`='$id'"); // products
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
  $date_arr = array('current_date'=>date('d/M/Y',time()),'date_status'=>mysql_result(mysql_query('SELECT `date_settings` FROM `adminSettings` limit 1'),0));
  return json_encode($date_arr);
 }
  
  
  


?>
