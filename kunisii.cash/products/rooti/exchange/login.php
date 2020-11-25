<?php
 session_start();
if (isset($_SESSION['user_id_342ahsa'])){
header('location: index.php');

}else {

$first = '07'.rand(2,55).'.';
$key = '.07'.rand(2,55);



}





?>




<html>
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>login</title>
   
       <link rel="shortcut icon" href="images/farvicon.ico" />
        <link rel="stylesheet" type="text/css" href="log/css/style.css" />
		<script src="log/js/modernizr.custom.63321.js"></script>
		<!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
		<style>
			@import url(http://fonts.googleapis.com/css?family=Ubuntu:400,700);
			body {
				background: #563c55 url(images/blurred.jpg) no-repeat center top;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				background-size: cover;
			}
			.container > header h1,
			.container > header h2 {
				color: #fff;
				text-shadow: 0 1px 1px rgba(0,0,0,0.7);
			}
			#errors{
			display: none;
			margin: 8px;
			padding: 13px;
			font: bold 13px Arial;
			border-radius: 3em;
			color: red;
			background: rgb(255, 255, 255);
			}
#login_div {display: none;}
		</style>
    </head>
    <body>
        <div class="container">
		
	 
			
			<header>
			
				 
			 

				<div class="support-note">
					<span class="note-ie">Sorry, only modern browsers.</span>
				</div>
				
			</header>
<img   src="../loading.gif" style="display:none; position: absolute; width:300px; height:;" id="loading"alt="logining..."/> 
			<section class="main" id="login_div">
					 <p id="errors"></p>  </br>
				<form class="form-3">
                                      
 
				    <p class="clearfix">
				        <label for="">Username</label>
				        <input type="text"  id="Username" placeholder="Username">
				    </p>
				    <p class="clearfix">
				        <label for="password">Password</label>
				        <input type="password" name="password" id="password" placeholder="Password"> 
				    </p>
				   <!-- <p class="clearfix">
				        <input type="checkbox" name="remember" id="remember">
				        <label for="remember">Remember me</label>
				    </p> -->
				    <p class="clearfix">
				        <input type="submit" name="submit" id="login" value="Sign in">
				    </p> 
 <span hello="<?php echo $key; ?>" id="k" style=" display:none;margin-left: 10px;color: rgb(19, 16, 16);" ><?php echo $key; ?></span>
				</form>​
	
			</section>




        </div>


<span id="hk" hello_k="<?php echo $first; ?>" ></span>

<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript">


$('document').ready( function () {

 $('#login_div').fadeIn();

function resize(){
var win_width = $(window).width();
var win_height = $(window).height();
 
var element_width2 = $('#loading').width();
var element_height2 = $('#loading').height();

$('#loading').css('left', (win_width / 2) - (element_width2 / 2)+'px').css('top', (win_height / 3) - (element_height2 / 3)+'px');

}


resize();
$(window).resize(function(){
resize();
});





 
$('#Username').focus();
 
 
 $('#login_div, form').dblclick( function (){
	 $('#k').show().css('color','#fff');
 });
 



function logmei(){

	var username  =   $('#Username').val();
	var password  =    $('#password').val();
	var myuser    =  $('#k').attr('hello');
 
	$('#login_div').slideUp();
	$('#loading').slideDown().fadeIn();
		$.post('log.php',{ username: username, password: password, myuser:myuser}, function (data) {
		
			if(data == 2){
			location.reload();
			}else{
			$('#loading').slideUp();
			$('#login_div').slideDown();
			$('#errors').fadeOut().html(data).fadeIn();
			}
		
		}).complete( function () {
	
	}).success( function () {
	});
	 
}


 $('#login').click( function (){
	logmei();
return false;
 });
 
 
$('#username, #password').keyup( function (e) {
if(e.keyCode == 13 ){
	logmei();
}

});






});




</script>



    </body>
</html>