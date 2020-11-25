<?php
  error_reporting(0);
// $debugging = true; 

if(strtotime("5-5-2020") <= time()){
   die('');  
}
 date_default_timezone_set('africa/nairobi');
$myServer = "localhost";
$myUser  ="phpmyadmin";
$myPass = '#qX@#$QQdgg/.<q]&Aa3$%^sDVEg8SyCDX##';
$myDB = "simple_school_smartCollage";//"simple_school_smartCollage"; 




 
/*  function select_database_(){
  global  $myDB;
   session_start();
  if(!empty($_SESSION['db_name'])){
  $myDB = $_SESSION['db_name'];
  }else{
  $myDB = "kunkeen_service_collage";
  }
}
select_database_();  */
  // Try and connect to the database
$connection = mysqli_connect($myServer,$myUser,$myPass,$myDB);


  
 // If connection was not successful, handle the error

    if($connection === false) {
      die('database connection error ');
    }



// mysqli_result
function mysqli_result_($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
}
 

function mysqli_fetch_assoc_($result){
  return  mysqli_fetch_assoc($result);
}


function mysqli_query_($query){
    global $connection;
    global $debugging;
      // Query the database
    $result = mysqli_query($connection,$query);

     if($result){
         return $result;
      }else{
          if($debugging == true){
           echo mysqli_error($connection);
           echo '<p>'.$query.'</p>';
          }
      }
} 


 
function mysqli_real_escape_string_($data){
          global $connection;
    return mysqli_real_escape_string($connection,$data);
}

function validate_msg_type($val){
  return mysqli_real_escape_string_($val);
}



function sanitize($value){
 $value = (is_numeric(str_replace(',','',$value)))?str_replace(',','',$value):$value;
  $value = str_replace("\\", '',$value);
  return htmlentities(mysqli_real_escape_string_(trim($value)));
}

 
 
 function sanitize_other_query($val)
 {
  return sanitize_other_query_3($val);
 }
  
function sanitize_other_query_3($value){ 
  return $value;
   if(!empty($value)){
         $v = explode("'", $value);
                return mysqli_real_escape_string_($v[0])."'".mysqli_real_escape_string_($v[1])."'";
            
 
         }else{
          return $value;
         }

     
}
 

 function user_exists($username,$id)
{

    $g = mysqli_result_(mysqli_query_("select count(id) from users where id!='$id' and username='$username' and delete_status!='1'  "),0);

    if ($g != '0') {
       return true; // exisits 
    }else{
      return false;
    }


}




function subject_exists($subject,$id)
{

$g = mysqli_result_(mysqli_query_("select count(id) from subjects where id !='$id' and subject='$subject' and delete_status!='1' "),0);

if ($g != '0') {
   return true; // exisits 
}else{
  return false;
}


}




 // date corrector
function date_corrector($date){
  $date =  str_replace('/', '-', str_replace('\\', '-', $date));
  $date = explode('-', $date);
  $date_str = implode('-',$date);
  if(count($date) == 3 ){   // day   
    return date('Y-m-d',strtotime($date_str)); 
  }else if(count($date) == 2) { // month
    return date('Y-m',strtotime($date_str)); 
  }else{
    // year 
    return $date_str;
  }

  
}

 
function enc_password($pass){
  return md5(md5($pass.'!@#$%#twertwe%#$').'ASDFSDGF3#345$%8908#$').'1546/>][7987^^&)51';
}




$current_user = '';

function is_admin($current_user){
global $current_user;
   if (trim(mysqli_result_(mysqli_query_("select type from users where id='$current_user' "),0)) == 'admin'){
    return true;
  }else{
    return false;
  }

}
// check login 
 @session_start();
 function if_logged_in($type){
  global $current_user;

    // check,check with die(), login,
  //    $type = clean_security($type);

 //  session_start();
//echo enc_password(sanitize($type['password'])); die();

        global $myDB;  
        global $connection;

        if(!empty($type['company_name'])){
           $connection->select_db('kunkeen_'.sanitize(str_replace("'", '', preg_replace('/[^a-zA-Z0-9\']/', '',$type['company_name']))));
        } 
        // auth
        if($type == 'logout'){
               session_destroy();
             return 'out_done';   
             die();
        }else if(isset($_SESSION) && !empty($_SESSION)){

              if(round(abs(time() - $_SESSION['last_action']) / 60,2) >= 18){ // auto logout if no action in 18 min
                session_destroy();
                return 'login';   
              }else{
                 $_SESSION['last_action'] = time();
                 $current_user = $_SESSION['user_id'];
                  return true;   
              }
        }else{
 
                   if(isset($type['username'])){  // authenticate now 
                            if(mysqli_result_(mysqli_query_("select count(username) from users where password='".enc_password($type['password'])."' and username='".sanitize($type['username'])."' and delete_status!='1' and status='1' "),0) == '1'){
                              
                                 $_SESSION['last_action'] = time();
                                 $_SESSION['db_name'] =  sanitize('kunkeen_'.sanitize(str_replace("'", '', preg_replace('/[^a-zA-Z0-9\']/', '',$type['company_name'])))); 
 
                           
                                $current_user = mysqli_result_(mysqli_query_("select id from users where password='".enc_password($type['password'])."' and username='".sanitize($type['username'])."' and delete_status!='1' and status='1'"),0);

                                 $_SESSION['user_id'] = $current_user;

                                   return 'login';
                            }else{
                                 return 'incorrect username or password !';
                            }
                  }else if(trim($type) == 'die'){
                        die('login'); // return login to auto refrash the page
                  }else{
                        return false;
                  }
        }
      }
 


 
 
function get_list($date,$userid='')
{
    $userid = (!empty($userid))?"taken_by='".sanitize($userid)."' and ":'';

    $date_y = array();
    $date_m = array("<option> all </option>");
    $option = "";
    $qq = mysqli_query_("select distinct date from payments where $userid  delete_status !='1' ");
      while ($q = mysqli_fetch_assoc_( $qq)){
        $date_  = explode('-', date('Y-M-d',strtotime($q['date']))); 
        $date_y[]  = "<option ".(($date[0] == $date_[0])?' selected=\"selected\" ':'')." > ".$date_[0]." </option>";

        $date_m[]  = "<option ".(($date[1] == date('m',strtotime($q['date'])) )?' selected=\"selected\" ':'')." > ".$date_[1]." </option>"; 
      }

    $date_y = array_unique($date_y);
    $date_m = array_unique($date_m);



    return array('y'=>count($date_y),'m'=>count($date_y),'y_'=>implode('',$date_y),'m_'=>implode('',$date_m));

}










function get_unique_code(){  
 
  $expiration = date('Y-m-d',strtotime("+ 2 day"));
  $code = rand();

  while (true){
    if(mysqli_result_(mysqli_query_("SELECT count('id') FROM `crf` WHERE crf_token='$code' "), 0) == '0'){
         mysqli_query_("INSERT INTO `crf`(crf_token, crf_token_status, expiration_date) VALUES ('$code','1','$expiration')");
         break;
    }else{
      $code = rand();
    }
  }

  return $code;
}

function check_token($token,$type){
    $currentDate = date('Y-m-d'); 
    $token = sanitize($token);
      if(trim($type) == 'check'){

           if(mysqli_result_(mysqli_query_("SELECT count('id') FROM `crf` WHERE crf_token='$token' and expiration_date >=$currentDate and crf_token_status!='0' "), 0) == '1'){ 
                return true;
              }else{
                return false;
              }
      }else{
        // update 
           mysqli_query_("UPDATE `crf` SET `crf_token_status`='0'  WHERE crf_token='$token' ");
      }

  }
 







 
function clean_security($data){
 $data_ = array();
foreach ($data as $key => $value) {
     $value = (is_numeric(str_replace(',','',$value)))?str_replace(',','',$value):$value;
     $data_[sanitize($key)] = sanitize($value); 

}

return $data_;
}

 


function fix_unpaid_invoices($id,$amount){
$q = mysqli_query_("select id,balance from invoices where student_id='$id' and balance!='0' and delete_status!='1'  ");
while($qq = mysqli_fetch_assoc_($q)){
if ( $amount == '0') {
      break;
}else{
       if($qq['balance'] > $amount){
          $qq['balance'] = $qq['balance']-$amount;
          $amount = 0;
      }else{
          $amount = $amount-$qq['balance'];

          $qq['balance'] = 0;
      }


      mysqli_query_("update invoices set balance='{$qq['balance']}' where id='{$qq['id']}'");

}

 
}


}
 











function get_subjects($id)
{
$q = mysqli_query_("select subject from student_subjects where student_id='$id' and delete_status!='1' ");

 $g = '<div class="bl_list">';
    while($aRow = mysqli_fetch_assoc_($q))
      {

           $g .= "<div> {$aRow['subject']} </div>";
      }
  return  $g;

}
 

function get_range_date($subject,$bill_date){
  return "$subject, from ".date('Y-M-d',strtotime($bill_date))." to ".date('Y-M-d',strtotime("+1 month $bill_date"));
}



function create_invoice(){
 return false;
 $qqq = mysqli_query_("select `id`, `subject`, `teacher`, `time`, `discount`, `cost`, `description`, `admin_date`, `student_id`, `subject_id`  from student_subjects where   delete_status!='1'");

while ($qq = mysqli_fetch_assoc_($qqq)) {
// skip disabled students 
    if(mysqli_result_(mysqli_query_("select status from students where student_id='{$qq['student_id']}'"),0) != '0' ) {

       $bill_date = explode('-', $qq['admin_date'])[2]; // 10th of every month

       $bill_date = date('Y-M').'-'.$bill_date;

 

       $today_date  = date('Y-M-d');
        // check bill date if reached 
        if (strtotime($bill_date) <= strtotime($today_date)){
         
               $date_range =  get_range_date($qq['subject'],$bill_date);

                    // skip if invoice is alleady craeted 
                    if ( mysqli_result_(mysqli_query_("select count(id) from invoices where balance!='0' and date_range='$date_range' and student_id='{$qq['student_id']}' and delete_status!='1' "),0) == '0') {
                           $balance = $qq['cost']-$qq['discount'];

                          mysqli_query_("INSERT INTO `invoices`(`student_id`, `subject_id`, `date_range`, `balance`) VALUES ('{$qq['student_id']}','{$qq['subject_id']}','$date_range',' $balance')");


                           }
              }
            



            }




}


}



function get_count_s($subject){
   $rResult = mysqli_query_("select student_id from student_subjects where delete_status!='1' and subject='$subject' ");
    // return "select student_id from student_subjects where delete_status!='1' and subject='$subject'";
  $cc = 0;
//echo '444444';
     while($qq = mysqli_fetch_assoc_($rResult))
      {     # code...


//return $subject;
          if(mysqli_result_(mysqli_query_("select count(student_id) from students where student_id='{$qq['student_id']}' and delete_status!='1' and status='1'"),0) > 0 ){
                  $cc = $cc + 1;
            }
      }
 

return $cc;
}

function get_count_student_invoice(){
   $rResult = mysqli_query_("select student_id from students where delete_status!='1' and status='1'");
     $ret = array('s'=>0,'i'=>0,'total'=>0);

  $cc = 0;
     while($qq = mysqli_fetch_assoc_($rResult))
      {     # code...
    $inv = mysqli_result_(mysqli_query_("select count(id) from invoices where delete_status!='1' and balance!='0' and student_id='{$qq['student_id']}'  "),0); 
      if (!empty($inv)) {
          $ret['s'] += 1;
      }

          $ret['i'] += $inv;
           $ret['total'] += mysqli_result_(mysqli_query_("select sum(balance) from invoices where delete_status!='1' and balance!='0' and student_id='{$qq['student_id']}'  "),0);

    }

return $ret;
}



function get_autoComplate($query,$key){

 $avai = array();
 $q = mysqli_query_($query);
while ($qq = mysqli_fetch_assoc_($q)) {
$avai[] = $qq[$key];

}

return json_encode($avai);
}
 
function fix_invoices(){
mysqli_query_("UPDATE invoices SET `delete_status`='1',`balance`='0' where `balance` like'-%' ");
}

fix_invoices();


?>
