<?php

require 'connet.php';


  if(if_logged_in() != true){
die();
 }
 	



if(isset($_POST['_username']) && isset($_POST['password']) && isset($_POST['new_user'])){

$_username		=   mysql_real_escape_string(strtolower(htmlentities($_POST['_username'])));
$_pass		=   mysql_real_escape_string(strtolower(htmlentities($_POST['password'])));
$new_user		=    mysql_real_escape_string(strtolower(htmlentities($_POST['new_user'])));
	

 
	if(!empty($_username)){
		$pass = md5($_pass.'!@%#$').'b4f9c8c51';
			
			$query_chack = "SELECT count(username_e) FROM login_in WHERE username_e = '$_username' and password_w='$pass'"; 
				  $query_run    =   mysql_query($query_chack);
				
					if (mysql_result($query_run, 0) == 1){
						$update_query = "UPDATE login_in SET username_e='$new_user'";
						mysql_query($update_query);
						echo 2;		
					}else if (mysql_result($query_run, 0) == 0){
						echo 'incorrect username/password!';
					
					}else {
					
						echo 'error please try again!!';
					}
					
					
					
					
					
					
					
					
				
	}else {
	echo 'please fill all fields!';
	}


}

if(isset($_POST['c_username']) && isset($_POST['c_pass']) && isset($_POST['new_pass'])){

$c_username		=   mysql_real_escape_string(strtolower(htmlentities($_POST['c_username'])));
$c_pass		=    mysql_real_escape_string(strtolower(htmlentities($_POST['c_pass'])));
$new_pass		=   mysql_real_escape_string(strtolower(htmlentities($_POST['new_pass'])));
	
 
 
 
 // protection of keyloger 
if(strstr($new_pass,'.')){
exit('<p style="color:red; font:bold 12px italic;"> password can\'t contain dot .  !</p>');
}
 
 
 
 
 
	if(!empty($c_username)){
		$c_pass5 = md5($c_pass.'!@%#$').'b4f9c8c51';
		$new_pass1 = md5($new_pass.'!@%#$').'b4f9c8c51';
		
			$query_chack = "SELECT count(username_e) FROM login_in WHERE username_e = '$c_username' and password_w='$c_pass5'"; 
				  $query_run    =   mysql_query($query_chack);
				if (@mysql_result($query_run, 0) == 1){
					$update_query = "UPDATE login_in SET password_w='$new_pass1'";
					mysql_query($update_query);
						echo 2;		
					}else {
					echo'incorrect username/password!';
					}
				
	}else {
	echo 'please fill all fields!';
	}


}


?>

080808;
}
h4{
	font-family:Arial;
	font-size:14px;
	font-weight:normal;
	color:#606060;
}
h5{ /*address prompt*/
	text-align:center;
	font-family:Arial;
	font-size:14px;
	color:#404040;
}
h6{ /*address in shipping info*/
	text-align:center;
	font-family:Arial;
	font-size:14px;
	font-weight:normal;
	color:#606060;
}


.dates{
	color:#CC6600;
	font-weight:bold;
}
.offers{
	color:#404040;
	font-weight:bold;
}
.usernames{
	color:#006699;
	font-weight:900;
}
.subtitles{
	color:#707070;
}
#wrapper{
	 
	margin:15px auto;
	padding:10px;

	}




.button {
	-moz-box-shadow: 0px 1px 0px 0px #fed897;
	-webkit-box-shadow: 0px 1px 0px 0px #fed897;
	box-shadow: 0px 1px 0px 0px #fed897;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #f6b33d), color-stop(1, #d29105) );
	background:-moz-linear-gradient( center top, #f6b33d 5%, #d29105 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f6b33d', endColorstr='#d29105');
	background-color:#f6b33d;
	-moz-border-radius:20px;
	-webkit-border-radius:20px;
	border-radius:20px;
	border:1px solid #eda933;
	display:inline-block;
	color:#ffffff;
	font-family:arial;
	font-size:14px;
	font-weight:bold;
	padding:2px 10px;
	text-decoration:none;
	text-shadow: 1px 1px 5px #303030;
}
.button:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #d29105), color-stop(1, #f6b33d) );
	background:-moz-linear-gradient( center top, #d29105 5%, #f6b33d 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#d29105', endColorstr='#f6b33d');
	background-color:#d29105;
}
.button:active {
	position:relative;
	top:1px;
}





.buttons
{
	display: inline-block;
	white-space: nowrap;
	background-color: #ccc;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#eee), to(#ccc));
	background-image: -webkit-linear-gradient(top, #eee, #ccc);
	background-image: -moz-linear-gradient(top, #eee, #ccc);
	background-image: -ms-linear-gradient(top, #eee, #ccc);
	background-image: -o-linear-gradient(top, #eee, #ccc);
	background-image: linear-gradient(top, #eee, #ccc);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#eeeeee', EndColorStr='#cccccc');
	border: 1px solid #777;
	padding: 0 1.5em;
	margin: 0.1em;
	font: bold 1em/2em Arial, Helvetica;
	text-decoration: none;
	color: #333;
	text-shadow: 0 1px 0 rgba(255,255,255,.8);
	-moz-border-radius: .2em;
	-webkit-border-radius: .2em;
	border-radius: .2em;
	-moz-box-shadow: 0 0 1px 1px rgba(255,255,255,.8) inset, 0 1px 0 rgba(0,0,0,.3);
	-webkit-box-shadow: 0 0 1px 1px rgba(255,255,255,.8) inset, 0 1px 0 rgba(0,0,0,.3);
	box-shadow: 0 0 1px 1px rgba(255,255,255,.8) inset, 0 1px 0 rgba(0,0,0,.3);
}

.buttons:hover
{
	background-color: #ddd;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#fafafa), to(#ddd));
	background-image: -webkit-linear-gradient(top, #fafafa, #ddd);
	background-image: -moz-linear-gradient(top, #fafafa, #ddd);
	background-image: -ms-linear-gradient(top, #fafafa, #ddd);
	background-image: -o-linear-gradient(top, #fafafa, #ddd);
	background-image: linear-gradient(top, #fafafa, #ddd);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#fafafa', EndColorStr='#dddddd');
}

.buttons:active
{
	-moz-box-shadow: 0 0 4px 2px rgba(0,0,0,.3) inset;
	-webkit-box-shadow: 0 0 4px 2px rgba(0,0,0,.3) inset;
	box-shadow: 0 0 4px 2px rgba(0,0,0,.3) inset;
	position: relative;
	top: 1px;
}

.buttons:focus
{
	outline: 0;
	background: #fafafa;
}

.buttons:before
{
	background: #ccc;
	background: rgba(0,0,0,.1);
	float: left;
	width: 1em;
	text-align: center;
	font-size: 1.5em;
	margin: 0 1em 0 -1em;
	padding: 0 .2em;
	-moz-box-shadow: 1px 0 0 rgba(0,0,0,.5), 2px 0 0 rgba(255,255,255,.5);
	-webkit-box-shadow: 1px 0 0 rgba(0,0,0,.5), 2px 0 0 rgba(255,255,255,.5);
	box-shadow: 1px 0 0 rgba(0,0,0,.5), 2px 0 0 rgba(255,255,255,.5);
	-moz-border-radius: .15em 0 0 .15em;
	-webkit-border-radius: .15em 0 0 .15em;
	border-radius: .15em 0 0 .15em;
        pointer-events: none;
}

/* Hexadecimal entities for the icons */

.add:before
{
	content: "\271A";
}

.edit:before
{
	content: "\270E";
}

.delete:before
{
	content: "\2718";
}

.save:before
{
	content: "\2714";
}

.email:before
{
	content: "\2709";
}

.like:before
{
	content: "\2764";
}

.next:before
{
	content: "\279C";
}

.star:before
{
	content: "\2605";
}

.spark:before
{
	content: "\2737";
}

.play:before
{
	content: "\25B6";
}









body {
	background-color: #f0f0f0;
	font-family: helvetica, "Times New Roman", Times, serif;
}

h3 {
 margin: 5px; /* vertical-align: middle; */ 
 /* text-align: left; */ border-bottom: 2px solid blue; 
 width: auto; 
 /* margin-left: 15%; */ 
}

a:focus {
	outline: none;
}
.clear {
	clear: both;
}

.error{
	border-radius:1em;
	color:red;
	background-color:#000;
	padding:10px;
	margin:10px;
	font-family:Arial;
	font-weight:bold;
	text-shadow:1px 1px 3px #080808;
}


.date_manual{    

width: 178px !important;

}

#settings_bage{
padding:10px;
}
#logout{
float:right;
}
#hr,#hr2{
margin:3px;

box-shadow: 3px 0px 8px #FC05DC;
}
 
 #hover_div{
 position:absolute;
 display:none;
 padding:5px;
 background:#ccc;
 color:blue;
 font-style:italic;
 font-size:11px;
 border-radius:2em;
  border-bottom-left-radius:0em;
 }
 

#settings_bage a{
float:right;
}
#settings_bage p{
	padding:4px;
	display:block;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #f6b33d), color-stop(1, #d29105) );
	background:-moz-linear-gradient( center top, #f6b33d 5%, #d29105 100% );
	width:700px;
}
#totals pre, #totals2 pre{
		-moz-box-shadow: 0px 1px 0px 0px #fed897;
		-webkit-box-shadow: 0px 1px 0px 0px #fed897;
		box-shadow: 0px 1px 0px 0px #fed897;
		background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #f6b33d), color-stop(1, #d29105) );
		background:-moz-linear-gradient( center top, #f6b33d 5%, #d29105 100% );
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f6b33d', endColorstr='#d29105');
		background-color:#f6b33d;
		 
		border-radius:5px;
		color:#ffffff;
		font-family:arial;
		font-size:14px;
		font-weight:bold;
		padding:5px;
		 
		display:inline-block;
}



#totals div, #totals2 div{
	width:auto; 
    color: #D5DDE5;
    background: #1b1e24;
    border-bottom: 4px solid #9ea7af;
    border-right: 1px solid #343a45;
    font-size: 16px;
    font-weight: bold;
    padding: 16px;
    text-align: left;
    text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    vertical-align: middle;
    display:inline-block;
}


#totals strong, #totals2 strong{
	/* width:700px !important; */
  background: #FFFFFF;
    padding: 15px;
    padding-left:0;
    text-align: left;
    vertical-align: middle;
    font-weight: 300;
    font-size: 16px;
    text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
    border-right: 1px solid #C1C3D1;
}

div#totals  .table tr:hover td ,div#totals2  .table tr:hover td,div#totals  td ,div#totals2  td{
  background:#FFFFFF;
}
div#totals  th ,div#totals2  th{
  width:165px;
}



#page-wrap {
	position: relative;
	width: 760px;
	margin-right: auto;
	margin-left: auto;
	margin-top: 50px;
}


#add_div, #change_delete_pass, #edit_div ,#new_exp_div2, #worning_to_delete_exp, #new_exp_div,#edit_exp_div, #worning_to_delete,#error_del, #change_username, #change_pass,#feedback, #Deleted,#feedback_log, #feedback_3{


	text-align:center;
	display:inline-block;
	color:#ffffff;
	font-family:arial;
	font-size:14px;
	font-weight:bold;
	text-decoration:none;
	text-shadow: 1px 1px 5px #303030;
	margin:10px;
	padding:20px;
	background:#61FD0A; 
	border-radius:7px;
	-moz-border-radius:7px;
	-webkit-border-radius:7px;
	box-shadow:5px 5px 15px #A0A0A0; /*zero*/
	-moz-box-shadow:5px 5px 15px #A0A0A0;
	-webkit-box-shadow:5px 5px 15px #A0A0A0;
}
 


#blance_sidbar{
position: absolute;
text-align:left;
left: 577;
top: 22;
width:580px;
	
	padding:10px;
	background:#006699;
	border-radius:7px;
	-moz-border-radius:7px;
	-webkit-border-radius:7px;
	box-shadow:10px 10px 15px #A0A0A0; /*zero*/
	-moz-box-shadow:5px 5px 15px #A0A0A0;
	-webkit-box-shadow:5px 5px 15px #A0A0A0;
	height:600px;   /* 600px */
	overflow-x:auto;
}
#blance_sidbar pre{
box-shadow: 5px 5px 15px rgba(148, 26, 99, 0.41); /*zero*/
	border-radius:7px;
	margin:4px;
	color:#ffffff;
	font-family:arial;
	font-size:14px;
	font-weight:bold;
	text-decoration:none;
	text-shadow: 1px 1px 5px #303030;
	padding:4px;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #f6b33d), color-stop(1, #d29105) );
	background:-moz-linear-gradient( center top, #f6b33d 5%, #d29105 100% );

}


#blance_sidbar span{
color:red;
}



 #castomer_details, #castomer_details2{
 
 }


#main_details_bage{
	margin:10px;
	padding:20px;
	

}

ul#main-nav {
	margin-left: 20px;
}
ul#main-nav li {
	float: left;
	position: relative;
	margin-left: -20px;
	display: inline;
}
ul#main-nav li a {
	position: relative;
	width: 110px;
	height: 29px;
	display: block;
	background-image: url('../images/tabs.png');
	background-position: center center;
	color: #44403b;
	text-decoration: none;
	font-size: 14px;
	padding-top: 12px;
	text-align: left;
	padding-left: 30px;
	font-weight: bold;
}
ul#main-nav li.home a {
	background-image: url('../images/tab-home.png');
}
ul#main-nav li.current a {
	background-position: top;
	color: #ffffff;
}
ul#main-nav li a:hover {
	background-position: bottom;
	color: #ffffff;
}
ul#main-nav li.current a:hover {
	background-position: top; /*To Prevent the Current tab from changing colour on hover*/
	color: #ffffff;
}
ul#main-nav li.current {
	z-index: 100;
}
ul#main-nav li.home {
	z-index: 100;
}
ul#main-nav li.portfolio {
	z-index: 99;
}
ul#main-nav li.services {
	z-index: 98;
}
ul#main-nav li.about {
	z-index: 97;
}
ul#main-nav li.contact {
	z-index: 96;
}
#image {
	position: relative;
	float: left;
	margin-left: 40px;
	margin-top: 25px;
}
#container {

	position: relative;
	background-color: #577295;
	background-image: url('../images/featured-border.jpg');
	background-repeat: repeat-y;
	background-position: left;
 
	padding:10px;
	min-height:669px;
	 
	border-bottom-left-radius:0px;
	border-bottom-right-radius:0px;
 
	box-shadow:5px 5px 15px #A0A0A0; /*zero*/
	-moz-box-shadow:5px 5px 15px #A0A0A0;
	-webkit-box-shadow:5px 5px 15px #A0A0A0;
}




#searchbox
{
	background: #eaf8fc;
	background-image: -moz-linear-gradient(#fff, #d4e8ec);
	background-image: -webkit-gradient(linear,left bottom,left top,color-stop(0, #d4e8ec),color-stop(1, #fff));
	
	-moz-border-radius: 35px;
	border-radius: 35px;
	
	border-width: 1px;
	border-style: solid;
	border-color: #c4d9df #a4c3ca #83afb7;            
	width: 500px;
	height: 35px;
	padding: 10px;
	margin:30px;
	overflow: hidden; /* Clear floats */
}





#search, #search_button
{
	
}

#search
{
	padding: 5px 9px;
	height: 35px;
	width: 380px;
	border: 1px solid #a4c3ca;
	font: normal 13px 'trebuchet MS', arial, helvetica;

	background: #f1f1f1;
	
	-moz-border-radius: 50px 3px 3px 50px;
	 border-radius: 50px 3px 3px 50px;
	 -moz-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25) inset, 0 1px 0 rgba(255, 255, 255, 1);
	 -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25) inset, 0 1px 0 rgba(255, 255, 255, 1);
	 box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25) inset, 0 1px 0 rgba(255, 255, 255, 1);            
}

/* ----------------------- */

#search_button
{		
	background: #6cbb6b;
	background-image: -moz-linear-gradient(#95d788, #6cbb6b);
	background-image: -webkit-gradient(linear,left bottom,left top,color-stop(0, #6cbb6b),color-stop(1, #95d788));
	
	-moz-border-radius: 3px 50px 50px 3px;
	border-radius: 3px 50px 50px 3px;
	
	border-width: 1px;
	border-style: solid;
	border-color: #7eba7c #578e57 #447d43;
	
	 -moz-box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
	 -webkit-box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
	 box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;   		

	height: 35px;
	margin: 0 0 0 10px;
        padding: 0;
	width: 90px;
	cursor: pointer;
	font: bold 14px Arial, Helvetica;
	color: #23441e;
	
	text-shadow: 0 1px 0 rgba(255,255,255,0.5);
}

#search_button:hover
{		
	background: #95d788;
	background-image: -moz-linear-gradient(#6cbb6b, #95d788);
	background-image: -webkit-gradient(linear,left bottom,left top,color-stop(0, #95d788),color-stop(1, #6cbb6b));
}	

#search_button:active
{		
	background: #95d788;
	outline: none;
   
	 -moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
	 -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
	 box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;		
}

#search_button::-moz-focus-inner
{
       border: 0;  /* Small centering fix for Firefox */
}		







.input{
	font:bold 16px verdana;
	padding:5px; 
	border:1px solid #b9bdc1;
	width:200px;
	color:#505050;
}
.input:focus{
	background-color:white;
	border:1px solid #f6bdd3;
}

.hover{
color:#fff;
cursor: pointer;

		background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #f6b33d), color-stop(1, #d29105) );
		background:-moz-linear-gradient( center top, #f6b33d 5%, #d29105 100% );
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f6b33d', endColorstr='#d29105');
		background-color:#f6b33d;
}

.feedback {

	text-align:center;
	display:inline-block;
	color:#ffffff;
	font-family:arial;
	font-size:14px;
	font-weight:bold;
	text-decoration:none;
	text-shadow: 1px 1px 5px #303030;
	margin:10px;
	padding:20px;
	background:#006699;
	border-radius:7px;
	-moz-border-radius:7px;
	-webkit-border-radius:7px;
	box-shadow:5px 5px 15px #A0A0A0; /*zero*/
	-moz-box-shadow:5px 5px 15px #A0A0A0;
	-webkit-box-shadow:5px 5px 15px #A0A0A0;
}

.remove_default_table_style{
 
} body{ padding: 10px; background-color: orange;} </style></head> <body> <h3 style="margin-left:14%;">Account For <strong style="color:blue;">F</strong>ive star <span class="subMobile"></span> </h3><br><table  class='table' ><tr><th>Total Cash In</th> <th> Total Cash Out</th> <th>Total Cash Balance</th> <th>Total Dollar In </th> <th>Total Dollar Out</th> <th> Total Dollar Balance</th></tr><tr><td>57,689,270</td><td>57,639,000</td><td style='font-weight:bold;color:blue;' >50,270</td><td>$0</td><td>$0</td><td style='font-weight:bold;color:blue;'>$0</td></tr></table><br>() <table class="table"><tr><th>Name </th> <th>Cash In </th> <th> Cash Out </th> <th> Cash Balance </th> <th>Dollar In </th> <th>Dollar Out</th> <th>Dollar Balance</th> <th> Description </th> <th> Date </th>  </tr><tr> <td>Five star</td> <td>0</td> <td>119,000</td> <td style='font-weight:bold;color:blue;' >12,708,870</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>Uulow</td> <td>01/Jul/2016</td> <tr><tr> <td>Five star</td> <td>780,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >18,717,270</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>01/Oct/2016</td> <tr><tr> <td>Five star</td> <td>243,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >6,472,620</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>02/Apr/2016</td> <tr><tr> <td>Five star</td> <td>3,056,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >4,732,200</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>uulow/cement</td> <td>02/Feb/2016</td> <tr><tr> <td>Five star</td> <td>280,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >1,000,000</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>02/Jan/2016</td> <tr><tr> <td>Five star</td> <td>617,150</td> <td>0</td> <td style='font-weight:bold;color:blue;' >13,326,020</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>02/Jul/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>2,000,000</td> <td style='font-weight:bold;color:blue;' >6,701,170</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>02/Jun/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>1,000,000</td> <td style='font-weight:bold;color:blue;' >3,699,770</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>02/Mar/2016</td> <tr><tr> <td>Five star</td> <td>3,514,800</td> <td>0</td> <td style='font-weight:bold;color:blue;' >12,238,920</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>uulow</td> <td>02/May/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>4,000,000</td> <td style='font-weight:bold;color:blue;' >14,717,270</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>cheques</td> <td>03/Oct/2016</td> <tr><tr> <td>Five star</td> <td>240,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >14,357,570</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>03/Sep/2016</td> <tr><tr> <td>Five star</td> <td>4,618,200</td> <td>0</td> <td style='font-weight:bold;color:blue;' >11,090,820</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>04/Apr/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>3,000,000</td> <td style='font-weight:bold;color:blue;' >1,732,200</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>GAB</td> <td>04/Feb/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>500,000</td> <td style='font-weight:bold;color:blue;' >12,826,020</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>04/Jul/2016</td> <tr><tr> <td>Five star</td> <td>1,923,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >8,624,170</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>04/Jun/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>2,000,000</td> <td style='font-weight:bold;color:blue;' >10,826,020</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>FCB</td> <td>05/Jul/2016</td> <tr><tr> <td>Five star</td> <td>675,500</td> <td>0</td> <td style='font-weight:bold;color:blue;' >4,375,270</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>05/Mar/2016</td> <tr><tr> <td>Five star</td> <td>240,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >15,760,270</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>05/Nov/2016</td> <tr><tr> <td>Five star</td> <td>1,404,600</td> <td>0</td> <td style='font-weight:bold;color:blue;' >15,811,620</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>06/Aug/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>3,000,000</td> <td style='font-weight:bold;color:blue;' >8,150,270</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>06/Dec/2016</td> <tr><tr><th>Name </th> <th>Cash In </th> <th> Cash Out </th> <th> Cash Balance </th> <th>Dollar In </th> <th>Dollar Out</th> <th>Dollar Balance</th> <th> Description </th> <th> Date </th>  </tr><tr> <td>Five star</td> <td>1,571,800</td> <td>0</td> <td style='font-weight:bold;color:blue;' >3,304,000</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>06/Feb/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>3,000,000</td> <td style='font-weight:bold;color:blue;' >3,050,270</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>06/Feb/2017</td> <tr><tr> <td>Five star</td> <td>140,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >12,378,920</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>07/May/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>3,000,000</td> <td style='font-weight:bold;color:blue;' >8,090,820</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>08/Apr/2016</td> <tr><tr> <td>Five star</td> <td>960,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >4,264,000</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>08/Feb/2016</td> <tr><tr> <td>Five star</td> <td>2,394,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >11,018,170</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>Uulow</td> <td>08/Jun/2016</td> <tr><tr> <td>Five star</td> <td>300,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >15,017,270</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>08/Oct/2016</td> <tr><tr> <td>Five star</td> <td>1,717,700</td> <td>0</td> <td style='font-weight:bold;color:blue;' >9,808,520</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>09/Apr/2016</td> <tr><tr> <td>Five star</td> <td>1,354,600</td> <td>0</td> <td style='font-weight:bold;color:blue;' >12,180,620</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>09/Jul/2016</td> <tr><tr> <td>Five star</td> <td>1,899,700</td> <td>0</td> <td style='font-weight:bold;color:blue;' >16,257,270</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>10/Sep/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>1,400,000</td> <td style='font-weight:bold;color:blue;' >2,864,000</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>paid by said</td> <td>11/Feb/2016</td> <tr><tr> <td>Five star</td> <td>503,550</td> <td>0</td> <td style='font-weight:bold;color:blue;' >11,521,720</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>11/Jun/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>2,000,000</td> <td style='font-weight:bold;color:blue;' >2,375,270</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>GAB</td> <td>11/Mar/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>1,200,000</td> <td style='font-weight:bold;color:blue;' >11,178,920</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>11/May/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>2,200,000</td> <td style='font-weight:bold;color:blue;' >13,560,270</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>11/Nov/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>1,000,000</td> <td style='font-weight:bold;color:blue;' >0</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>12/Jan/2016</td> <tr><tr> <td>Five star</td> <td>2,216,550</td> <td>0</td> <td style='font-weight:bold;color:blue;' >4,591,820</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>12/Mar/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>800,000</td> <td style='font-weight:bold;color:blue;' >10,378,920</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>12/May/2016</td> <tr><tr> <td>Five star</td> <td>210,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >13,770,270</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>12/Nov/2016</td> <tr><tr> <td>Five star</td> <td>1,134,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >16,945,620</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>13/Aug/2016</td> <tr><tr><th>Name </th> <th>Cash In </th> <th> Cash Out </th> <th> Cash Balance </th> <th>Dollar In </th> <th>Dollar Out</th> <th>Dollar Balance</th> <th> Description </th> <th> Date </th>  </tr><tr> <td>Five star</td> <td>1,160,500</td> <td>0</td> <td style='font-weight:bold;color:blue;' >4,024,500</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>13/Feb/2016</td> <tr><tr> <td>Five star</td> <td>162,250</td> <td>0</td> <td style='font-weight:bold;color:blue;' >10,541,170</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>14/May/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>4,000,000</td> <td style='font-weight:bold;color:blue;' >12,945,620</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>GAB</td> <td>15/Aug/2016</td> <tr><tr> <td>Five star</td> <td>367,400</td> <td>0</td> <td style='font-weight:bold;color:blue;' >15,384,670</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>15/Oct/2016</td> <tr><tr> <td>Five star</td> <td>189,650</td> <td>0</td> <td style='font-weight:bold;color:blue;' >9,998,170</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>16/Apr/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>1,600,000</td> <td style='font-weight:bold;color:blue;' >2,424,500</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>16/Feb/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>3,000,000</td> <td style='font-weight:bold;color:blue;' >50,270</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>Paid By Noor Ali dhawaq</td> <td>16/Feb/2017</td> <tr><tr> <td>Five star</td> <td>2,430,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >2,430,000</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>16/Jan/2016</td> <tr><tr> <td>Five star</td> <td>749,300</td> <td>0</td> <td style='font-weight:bold;color:blue;' >12,929,920</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>16/Jul/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>1,300,000</td> <td style='font-weight:bold;color:blue;' >12,470,270</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>17/Nov/2016</td> <tr><tr> <td>Five star</td> <td>276,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >16,533,270</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>17/Sep/2016</td> <tr><tr> <td>Five star</td> <td>60,800</td> <td>0</td> <td style='font-weight:bold;color:blue;' >11,582,520</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>18/Jun/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>1,420,000</td> <td style='font-weight:bold;color:blue;' >8,578,170</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>19/Apr/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>2,100,000</td> <td style='font-weight:bold;color:blue;' >6,050,270</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>Bibi walashed</td> <td>19/Dec/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>1,000,000</td> <td style='font-weight:bold;color:blue;' >11,929,920</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>19/Jul/2016</td> <tr><tr> <td>Five star</td> <td>1,361,050</td> <td>0</td> <td style='font-weight:bold;color:blue;' >5,952,870</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>19/Mar/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>1,500,000</td> <td style='font-weight:bold;color:blue;' >10,970,270</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>19/Nov/2016</td> <tr><tr> <td>Five star</td> <td>180,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >11,150,270</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>19/Nov/2016</td> <tr><tr> <td>Five star</td> <td>1,547,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >14,492,620</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>20/Aug/2016</td> <tr><tr> <td>Five star</td> <td>1,702,270</td> <td>0</td> <td style='font-weight:bold;color:blue;' >4,126,770</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>20/Feb/2016</td> <tr><tr><th>Name </th> <th>Cash In </th> <th> Cash Out </th> <th> Cash Balance </th> <th>Dollar In </th> <th>Dollar Out</th> <th>Dollar Balance</th> <th> Description </th> <th> Date </th>  </tr><tr> <td>Five star</td> <td>0</td> <td>2,000,000</td> <td style='font-weight:bold;color:blue;' >8,541,170</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>Equity bank</td> <td>20/May/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>2,000,000</td> <td style='font-weight:bold;color:blue;' >430,000</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>21/Jan/2016</td> <tr><tr> <td>Five star</td> <td>122,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >8,663,170</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>21/May/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>1,500,000</td> <td style='font-weight:bold;color:blue;' >10,082,520</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>22/Jun/2016</td> <tr><tr> <td>Five star</td> <td>135,600</td> <td>0</td> <td style='font-weight:bold;color:blue;' >15,520,270</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>22/Oct/2016</td> <tr><tr> <td>Five star</td> <td>1,700,450</td> <td>0</td> <td style='font-weight:bold;color:blue;' >10,278,620</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>23/Apr/2016</td> <tr><tr> <td>Five star</td> <td>455,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >885,000</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>23/Jan/2016</td> <tr><tr> <td>Five star</td> <td>1,658,700</td> <td>0</td> <td style='font-weight:bold;color:blue;' >13,588,620</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>23/Jul/2016</td> <tr><tr> <td>Five star</td> <td>1,404,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >17,937,270</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>24/Sep/2016</td> <tr><tr> <td>Five star</td> <td>1,465,350</td> <td>0</td> <td style='font-weight:bold;color:blue;' >11,547,870</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>25/Jun/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>2,000,000</td> <td style='font-weight:bold;color:blue;' >2,126,770</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>26/Feb/2016</td> <tr><tr> <td>Five star</td> <td>624,950</td> <td>0</td> <td style='font-weight:bold;color:blue;' >15,117,570</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>27/Aug/2016</td> <tr><tr> <td>Five star</td> <td>233,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >2,359,770</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>27/Feb/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>2,000,000</td> <td style='font-weight:bold;color:blue;' >8,278,620</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>28/Apr/2016</td> <tr><tr> <td>Five star</td> <td>2,340,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >4,699,770</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>Uulow</td> <td>28/Feb/2016</td> <tr><tr> <td>Five star</td> <td>276,750</td> <td>0</td> <td style='font-weight:bold;color:blue;' >6,229,620</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>28/Mar/2016</td> <tr><tr> <td>Five star</td> <td>38,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >8,701,170</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>28/May/2016</td> <tr><tr> <td>Five star</td> <td>720,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >720,000</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>28/Nov/2015 </td> <tr><tr> <td>Five star</td> <td>0</td> <td>1,000,000</td> <td style='font-weight:bold;color:blue;' >14,117,570</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>GULF</td> <td>29/Aug/2016</td> <tr><tr> <td>Five star</td> <td>0</td> <td>1,000,000</td> <td style='font-weight:bold;color:blue;' >10,547,870</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>29/Jun/2016</td> <tr><tr><th>Name </th> <th>Cash In </th> <th> Cash Out </th> <th> Cash Balance </th> <th>Dollar In </th> <th>Dollar Out</th> <th>Dollar Balance</th> <th> Description </th> <th> Date </th>  </tr><tr> <td>Five star</td> <td>445,500</td> <td>0</td> <td style='font-weight:bold;color:blue;' >8,724,120</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>30/Apr/2016</td> <tr><tr> <td>Five star</td> <td>791,200</td> <td>0</td> <td style='font-weight:bold;color:blue;' >1,676,200</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>30/Jan/2016</td> <tr><tr> <td>Five star</td> <td>818,400</td> <td>0</td> <td style='font-weight:bold;color:blue;' >14,407,020</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>30/Jul/2016</td> <tr><tr> <td>Five star</td> <td>2,280,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >12,827,870</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>UUlow</td> <td>30/Jun/2016</td> <tr></table><br><table  class='table' ><tr><th>Total Cash In</th> <th> Total Cash Out</th> <th>Total Cash Balance</th> <th>Total Dollar In </th> <th>Total Dollar Out</th> <th> Total Dollar Balance</th></tr><tr><td>57,689,270</td><td>57,639,000</td><td style='font-weight:bold;color:blue;' >50,270</td><td>$0</td><td>$0</td><td style='font-weight:bold;color:blue;'>$0</td></tr></table></body><html>