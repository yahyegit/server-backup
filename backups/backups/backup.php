<?php

ini_set('display_error',0);
 error_reporting(0);

$new_files = array();

/* backup the db OR just a table */
function backup_now($mysqlDatabaseName)
{

//Enter your database information here and the name of the backup file
// $mysqlDatabaseName ='gorgor';
$mysqlUserName = "phpmyadmin";
$mysqlPassword = '#qX@#$QQdgg/.<q]&Aa3$%^sDVEg8SyCDX##';
$mysqlHostName ='localhost';
$mysqlExportPath    = 'sql_backup/backup_for('.$mysqlDatabaseName.')_on_'.date('d-m-Y').'.sql';
 
 
//Please do not change the following points
//Export of the database and output of the status
$command="mysqldump --opt -h $mysqlHostName  -u $mysqlUserName -p'$mysqlPassword' $mysqlDatabaseName  >  '$mysqlExportPath'";
exec($command,$output=array(),$worked);
echo $command;
/*
switch($worked){
case 0:
echo 'The database <b>' .$mysqlDatabaseName .'</b> was successfully stored in the following path ./' .$mysqlExportPath .'</b>';
break;
case 1:
echo 'An error occurred when exporting <b>' .$mysqlDatabaseName .'</b> zu  ./' .$mysqlExportPath .'</b>';
break;
case 2:
echo 'An export error has occurred, please check the following information: <br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' .$mysqlDatabaseName .'</b></td></tr><tr><td>MySQL User Name:</td><td><b>' .$mysqlUserName .'</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' .$mysqlHostName .'</b></td></tr></table>';
break;
}
*/


      global $new_files;
      $new_files[] = $mysqlExportPath;
}

function send_backup_files($mysqlExportPath){

echo $mysqlExportPath.'<br>';
  // send to email 

    $mail = new PHPMailer\PHPMailer\PHPMailer();
 
    $mail->IsSMTP(); // enable SMTP
 
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = 'tls://smtp.gmail.com';
    $mail->Port = 587; // or 587  or 465
    $mail->IsHTML(true);
    $mail->Username = 'kunkeen.cash@gmail.com';
    $mail->Password = '5bkUvsmcD.#)Hq^.';
    $mail->SetFrom('kunkeen.cash@gmail.com');
    $mail->addAttachment($mysqlExportPath); 
    $mail->Subject = $mysqlExportPath;
    $mail->Body = file_get_contents($mysqlExportPath);
    $mail->AddAddress("kunkeen.cash@gmail.com");

     if(!$mail->Send()) {
      //  return "sorry somthing went wrong please try again !";
     } else {
    
     }
     //unlink($mysqlExportPath); // to save disk space 


}


$client_dataBases = array('kunisii_girow','gorgor','abdulfatahb3','huble_system','hubleshops','kunisii_tusmo','kunisii_kazmoni','ahsaltd','hansharoltd','kunisii_ahsa','harun_rent','kunisii_dheere','kunisii_xarago','kunkeen_pacific');

// export all 
foreach ($client_dataBases as $db) {
    backup_now($db);
}

// send  
//print_r($new_files);
foreach ($new_files as $file) {
    send_backup_files($file);
}

 
?>
