<?php
//error_reporting(0); 
 include 'db_connector.php';

  require("others/PHPMailer.php");
  require("others/SMTP.php");

// find the email 
 
// send login details plain text 
 $connection->select_db("kunkeen_service");

function reset_pass($data){
  $data = clean_security($data);

  $mail = new PHPMailer\PHPMailer\PHPMailer();

  $compnay_info  = mysqli_fetch_assoc_(mysqli_query_("select * from customers where email='{$data['email']}'"),0);


      if(isset($compnay_info['company_name'])){
       $mail->Body = "company name: {compnay_info['company_name']} /n username: {compnay_info['username']} /n password: {compnay_info['password']} ";

      }else{
        return "<strong>Sorry this email is not found in the system {$data['email']} </strong><br> <p> don't worry if you did not add your email jus call.  </p>";
      }



    $mail->IsSMTP(); // enable SMTP

    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "kunkeen.cash@gmail.com";
    $mail->Password = "5bkUvsmcD.#)Hq^.";
    $mail->SetFrom("kunkeen.cash@gmail.com");
    $mail->Subject = "Login Details for kunkeen App";
    $mail->Body = "company name: {$compnay_info['company_name']}  username:  {$compnay_info['username']} password: {$compnay_info['password']}";
    $mail->AddAddress("{$compnay_info['email']}");

     if(!$mail->Send()) {
        return "sorry somthing went wrong please try again !";
     } else {
        return "<script>                                                      success_fun(' login details was sent to : <strong> {$compnay_info['email']} .</strong>!');
 </script>";
     }






}


 


// submited request handler
if(isset($_POST)){
     echo reset_pass($_POST['data']);
}


   
?>