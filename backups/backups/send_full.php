<?php
//ini_set('display_error',1);
// error_reporting(0);
  require("others/PHPMailer.php");
  require("others/SMTP.php");
 
 


function send_backup_files($mysqlExportPath){

  // send to email 

    $mail = new PHPMailer\PHPMailer\PHPMailer();
 
    $mail->IsSMTP(); // enable SMTP
 
    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = 'tls://smtp.gmail.com';
    $mail->Port = 587; // or 587  or 465
    $mail->IsHTML(true);
    $mail->Username = 'kunkeen.cash@gmail.com';
    $mail->Password = '5bkUvsmcD.#)Hq^.';
    $mail->SetFrom('kunkeen.cash@gmail.com');
    $mail->addAttachment($mysqlExportPath); 
    $mail->Subject = $mysqlExportPath;
    $mail->Body = 'backup ready ';
    $mail->AddAddress("kunkeen.cash@gmail.com");

     if(!$mail->Send()) {
//    echo "Mailer Error: " . $mail->ErrorInfo;


     } else {
    
     }
     //unlink($mysqlExportPath); // to save disk space 


}
  send_backup_files('full_sql_backup/MySQLDB_'.date('m-d-Y').'.sql.gz');

 
?>