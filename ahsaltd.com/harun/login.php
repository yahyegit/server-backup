<?php

 session_start();
if (isset($_SESSION['user_id'])){
header('location: index.php');

}else {

$first = '07'.rand(2,55).'.';
$key = '.07'.rand(2,55);



}
 
 require 'includes/inc_func.php';

 
?>





<html>
<head>

<title>  login to <?php echo mysql_result(mysql_query("SELECT  `company_name` FROM `settings` limit 1"),0); ?>  </title>
 
  <link rel="shortcut icon" type="image/png" href="images/fav_icon.png"/>

 <script    src="js/ganaral.js"  charset="utf-8" ></script>

 
<link   rel="stylesheet" href="css/login.css" media="screen"   />    


 <script       src="js/jquery-ui-and-jquery/js/jquery-1.9.1.js"  charset="utf-8"  type="text/javascript"><!--sorry this page is can't loaded correctly--></script>
 <script       src="js/jquery-ui-and-jquery/js/jquery-ui-1.10.3.custom.min.js" charset="utf-8"  type="text/javascript"><!--sorry this page is can't loaded correctly--></script>


 <script charset="utf-8"  type="text/javascript"> 


$('document').ready( function () {
 
 
$('#username').focus();
 
 
 $('form').dblclick( function (){
     $('#k').show().css('color','#fff');
 });
 


$('input#submit').click( function (){
    logmei();
return false;
 });
 

$('input#reset_now').click( function (){
    reset();
return false;
 });
 

// login 
$('#username, #password').keyup( function (e) {
if(e.keyCode == 13 ){
    logmei();
    return false;
}

});



//  reset 
$('input#email').keyup( function (e) {
    if(e.keyCode == 13 ){
        reset();
        return false;
    }
});

});

// change password
function change_password(){
         new_password  =   $('#new_password').val();
         confirm_password  =   $('#confirm_password').val();
         reset_code = $('p#reset_code').attr('reset_code');

         if($.trim(new_password) == ''){
                  error_func('password is empty ');  
         }else if(new_password != confirm_password){
                  error_func('New password did not match !');
         }else{
             $('#change_pass').fadeOut();
         loading_fun('',20); 
        $.post('reset_passowrd.php',{new_password:new_password,confirm_password:confirm_password,reset_code:reset_code}, function (data) {
                 $('#change_pass').fadeIn();
                i = setInterval(function(){ 
                         if($('.horizantal_loading').attr('current_size') == '80'){
                                                                 // finsh the loading 
                                loading_fun($('.horizantal_loading').attr('current_size'),13);
                               clearInterval(i);
                           }                          
                     },500); // finish the loading 

            if(data == '1'){
               success_fun_('your password is succssfully changed.<br> login with the new password,  <a href="#" onclick="$(\'from\').fadeOut();$(\'#login\').fadeIn();"> Login</a>');

            }else{  
            error_func(data);  
            }
        
        });
         }
}

function reset(){

        var email  =   $('#email').val();
          if($.trim(email) == ''){
                  error_func('emai is empty ');  
                  return false;
         }
        $('#reset_now').fadeOut();
         loading_fun('',20); 
        $.post('reset.php',{email}, function (data) {
                 $('#reset_now').fadeIn();
                i = setInterval(function(){ 
                         if($('.horizantal_loading').attr('current_size') == '80'){
                                                                 // finsh the loading 
                                loading_fun($('.horizantal_loading').attr('current_size'),13);
                               clearInterval(i);
                           }                          
                     },500); // finish the loading 

            if($.trim(data) == '1'){
                    success_fun_('The password reset link was sent to '+email+', the password reset code will Expire after 1 day .');
            }else{
             
            error_func(data);  
            }
        
        });
     
}










function logmei(){

        var username  =   $('#username').val();
        var password  =   $('#password').val();
        var myuser    =  "<?php echo $key; ?>";
        $('#submit').fadeOut();
         loading_fun('',20); 
        $.post('logPos.php',{ username: username, password: password, myuser:myuser}, function (data) {
                 $('#submit').fadeIn();
                i = setInterval(function(){ 
                         if($('.horizantal_loading').attr('current_size') == '80'){
                                                                 // finsh the loading 
                                loading_fun($('.horizantal_loading').attr('current_size'),13);
                               clearInterval(i);
                           }                          
                     },500); // finish the loading 

            if(data == 1){
            location.reload();
            }else{
            $('#loading').slideUp();
            error_func(data);  
            }
        
        }).complete( function () {
    
    }).success( function () {
    });
     
}

 
    </script>


</head>
<body style="background: whitesmoke;">

 
<div class="wrapper dashboard_panel">

 <div id="error" title="Error" style="display:none;" ></div>
<div id="success" title="Success" style="display:none;" ></div>
<div class="horizantal_loading" style="display:none;" ></div>


<?php

if(isset($_GET['reset'])){
    if(mysql_result(mysql_query("SELECT count('id') FROM `security` WHERE pass_reset_code='".sanitize($_GET['reset'])."' and pass_reset_code_status!='0'"), 0) == '0'){

echo ' <p id="error" > Sorry your reset code is Expired please request new one  
  <a href="#" onclick="$(\'#login\').fadeOut();$(\'#reset_form\').fadeIn();"> Request reset Code </a>
 </p>';

    }else{

            echo '<p style="display:none;" id="reset_code" reset_code="'.$_GET['reset'].'"></p>';

          ?>  
        <form id="change_form" class="dashboard" action="none">
          <h1 id="ff-proof" class="ribbon"> <?php echo $companyName;?> </h1>
            <fieldset id="inputs">
                <input id="new_password" type="text" placeholder="New password"  >
                <input id="confirm_password" type="text" placeholder="Confirm new password"  >
            </fieldset>
            <fieldset id="actions">

                 <input type="submit" id="change_pass" onclick="change_password()" value="Change"/>

            </fieldset>
         
        </form>
        ?>

        <?php 
        }
}else{


?>



<form id="reset_form"  style="display: none;" class="dashboard" action="none">
     <h1 id="ff-proof" class="ribbon"> <?php echo $companyName;?> </h1>
    <fieldset id="inputs">
        <input id="email" type="text" placeholder="Email"  >
    </fieldset>
    <fieldset id="actions">
         <input type="submit" id="reset_now"   value="Submit"/>
    </fieldset>
  <a href="#" onclick="$('#reset_form').fadeOut();$('#login').fadeIn();" style="
    position: relative;
    bottom: 26px;
    font-weight: bold;
" > login </a>
</form>


<form id="login"  class="dashboard" action="none">
    <h1 id="ff-proof" class="ribbon"> <?php echo mysql_result(mysql_query("SELECT  `company_name` FROM `settings` limit 1"),0); ?>  </h1>
 
    <fieldset id="inputs">
        <input id="username" type="text" placeholder="Username"  onblur="if(jQuery.trim($(this).val())=='')this.value='Username';" onfocus="if(this.value=='Username')this.value='';" value="Username" />
        <input id="password" type="password" placeholder="Password" />
    </fieldset>
    <fieldset id="actions">
       
          <div class="container" id="loading" title="loading"  style="display:none; padding:4px; margin:5px;" >
              <div class="content">
              <div id="loading" title="loading" class="circle" >    </div>
               <div id="loading" title="loading" class="circle1" >    </div>
          </div>
         </div>
        
        
        
         <input type="submit" id="submit" value="LogIn"/>
        
    </fieldset>
  <a href="#" onclick="$('#login').fadeOut();$('#reset_form').fadeIn();"  style="
    position: relative;
    bottom: 26px;
    font-weight: bold;
"> forget password or username </a>
</form>


<?php } ?>
</div>
 
</body>
</html>
