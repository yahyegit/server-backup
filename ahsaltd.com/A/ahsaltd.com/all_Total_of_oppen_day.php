<html><head> <style>  
    @import url('select.css');
*{
	margin:0px;
	padding:0px;
	list-style-type:none;
}


body{

	font-family:Arial;
	font-size:12px;
	color:#303030;
 
}

label{
	display:inline-block;
	font-weight:bold;
	text-align:right;
	line-height:25px;
	font-size:16px;
	color:white;
	text-shadow:1px 1px 3px #080808;
}

 
 
/*table design */

.table {
	
  background: white;
  border-radius:31px;
  border-collapse:collapse;
 
  margin: auto;
  
  padding:5px;
  width: 100%;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  animation: float 5s infinite;
  display: table; 
  padding: 31px;  
 
}


.table th {
  color:#D5DDE5;;
  background:#1b1e24;
  border-bottom:4px solid #9ea7af;
  border-right: 1px solid #343a45;
  font-size:16px;
  font-weight: bold;
  padding:16px;
  
  text-align:left;
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  vertical-align:middle;
}

.table th:first-child {
  border-top-left-radius:3px;
}

.table th:last-child {
  border-top-right-radius:3px;
  border-right:none;
}

.table tr {
  border-top: 1px solid #C1C3D1;
  border-bottom-: 1px solid #C1C3D1;
  color:#666B85;
  font-size:16px;
  font-weight:normal;
  text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
}


.table tr:hover td {
  background:#4E5066;
  color:#FFFFFF;
  border-top: 1px solid #22262e;
  border-bottom: 1px solid #22262e;
}
 
.table tr:first-child {
  border-top:none;
}

.table tr:last-child {
  border-bottom:none;
}
 
.table tr:nth-child(odd) td {
  background:#EBEBEB;
}
 
.table tr:nth-child(odd):hover td {
  background:#4E5066;
}

.table tr:last-child td:first-child {
  border-bottom-left-radius:3px;
}
 
.table tr:last-child td:last-child {
  border-bottom-right-radius:3px;
}
 
 
.table td {
  background:#FFFFFF;
  padding:15px;
  text-align:left;
  vertical-align:middle;
  font-weight:300;
  font-size:16px;
  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
  border-right: 1px solid #C1C3D1;
}

.table td:last-child {
  border-right: 0px;
}

/* end of table design */

 
 








img{
	border:none;
}
h2{ /*Dark gray titles*/
	font-family:Arial;
	font-size:14px;
	color:#404040;
}
h3{ /*For titles*/
	margin-bottom:15px;
	font-size:22px;
	color:white;
	text-shadow:1px 1px 3px #080808;
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
 
} body{ padding: 10px; background-color: orange;} </style></head> <body> <h1> All Dollar Debt Transactions for ( bashir m. shirwac ) </h1><br><table  class='table' ><tr><th>Total Dollar In </th> <th>Total Dollar Out</th> <th> Total Dollar Balance</th></tr><tr><td>$0</td><td>$4,000</td><td style='font-weight:bold;color:blue;' >$-4,000</td></tr></table><br>() <table class="table"><tr><th>Name </th> <th>Dollar In</th> <th>Dollar Out</th> <th>Dollar Balance</th> <th> Description </th> <th> Date </th></tr><tr> <td>bashir m. shirwac</td> <td>$0</td><td>$4,000 </td> <td style='font-weight:bold;color:blue;' >$-4,000 </td> <td>wiilka</td> <td>12/Nov/2015 </td> <tr></table><br><table  class='table' ><tr><th>Total Dollar In </th> <th>Total Dollar Out</th> <th> Total Dollar Balance</th></tr><tr><td>$0</td><td>$4,000</td><td style='font-weight:bold;color:blue;' >$-4,000</td></tr></table></body><html>                                                                                                                                                                                                                                                                                                                                    <?xpacket end="w"?>ÿâXICC_PROFILE   HLino  mntrRGB XYZ Î  	  1  acspMSFT    IEC sRGB             öÖ     Ó-HP                                                 cprt  P   3desc  „   lwtpt  ğ   bkpt     rXYZ     gXYZ  ,   bXYZ  @   dmnd  T   pdmdd  Ä   ˆvued  L   †view  Ô   $lumi  ø   meas     $tech  0   rTRC  <  gTRC  <  bTRC  <  text    Copyright (c) 1998 Hewlett-Packard Company  desc       sRGB IEC61966-2.1           sRGB IEC61966-2.1                                                  XYZ       óQ    ÌXYZ                 XYZ       o¢  8õ  XYZ       b™  ·…  ÚXYZ       $   „  ¶Ïdesc       IEC http://www.iec.ch           IEC http://www.iec.ch                                              desc       .IEC 61966-2.1 Default RGB colour space - sRGB           .IEC 61966-2.1 Default RGB colour space - sRGB                      desc       ,Reference Viewing Condition in IEC61966-2.1           ,Reference Viewing Condition in IEC61966-2.1                          view     ¤ş _. Ï íÌ  \   XYZ      L	V P   Wçmeas                            sig     CRT curv           
     # ( - 2 7 ; @ E J O T Y ^ c h m r w |  † ‹  • š Ÿ ¤ © ® ² · ¼ Á Æ Ë Ğ Õ Û à å ë ğ ö û%+28>ELRY`gnu|ƒ‹’š¡©±¹ÁÉÑÙáéòú&/8AKT]gqz„˜¢¬¶ÁËÕàëõ !-8COZfr~Š–¢®ºÇÓàìù -;HUcq~Œš¨¶ÄÓáğş+:IXgw†–¦µÅÕåö'7HYj{Œ¯ÀÑãõ+=Oat†™¬¿Òåø2FZn‚–ª¾Òçû		%	:	O	d	y		¤	º	Ï	å	û

'
=
T
j

˜
®
Å
Ü
ó"9Qi€˜°Èáù*C\u§ÀÙó&@Zt©ÃŞø.Id›¶Òî	%A^z–³Ïì	&Ca~›¹×õ1OmŒªÉè&Ed„£Ãã#Ccƒ¤Åå'Ij‹­Îğ4Vx›½à&Il²ÖúAe‰®Ò÷@eŠ¯Õú Ek‘·İ*QwÅì;cŠ²Ú*R{£ÌõGp™Ãì@j”¾é>i”¿ê  A l ˜ Ä ğ!!H!u!¡!Î!û"'"U"‚"¯"İ#
#8#f#”#Â#ğ$$M$|$«$Ú%	%8%h%—%Ç%÷&'&W&‡&·&è''I'z'«'Ü((?(q(¢(Ô))8)k))Ğ**5*h*›*Ï++6+i++Ñ,,9,n,¢,×--A-v-«-á..L.‚.·.î/$/Z/‘/Ç/ş050l0¤0Û11J1‚1º1ò2*2c2›2Ô33F33¸3ñ4+4e44Ø55M5‡5Â5ı676r6®6é7$7`7œ7×88P8Œ8È99B99¼9ù:6:t:²:ï;-;k;ª;è<'<e<¤<ã="=a=¡=à> >`> >à?!?a?¢?â@#@d@¦@çA)AjA¬AîB0BrBµB÷C:C}CÀDDGDŠDÎEEUEšEŞF"FgF«FğG5G{GÀHHKH‘H×IIcI©IğJ7J}JÄKKSKšKâL*LrLºMMJM“MÜN%NnN·O OIO“OİP'PqP»QQPQ›QæR1R|RÇSS_SªSöTBTTÛU(UuUÂVV\V©V÷WDW’WàX/X}XËYYiY¸ZZVZ¦Zõ[E[•[å\5\†\Ö]']x]É^^l^½__a_³``W`ª`üaOa¢aõbIbœbğcCc—cëd@d”dée=e’eçf=f’fèg=g“géh?h–hìiCišiñjHjŸj÷kOk§kÿlWl¯mm`m¹nnknÄooxoÑp+p†pàq:q•qğrKr¦ss]s¸ttptÌu(u…uáv>v›vøwVw³xxnxÌy*y‰yçzFz¥{{c{Â|!||á}A}¡~~b~Â#„å€G€¨
kÍ‚0‚’‚ôƒWƒº„„€„ã…G…«††r†×‡;‡ŸˆˆiˆÎ‰3‰™‰şŠdŠÊ‹0‹–‹üŒcŒÊ1˜ÿfÎ6nÖ‘?‘¨’’z’ã“M“¶” ”Š”ô•_•É–4–Ÿ—
—u—à˜L˜¸™$™™üšhšÕ›B›¯œœ‰œ÷dÒ@®ŸŸ‹Ÿú i Ø¡G¡¶¢&¢–££v£æ¤V¤Ç¥8¥©¦¦‹¦ı§n§à¨R¨Ä©7©©ªª««u«é¬\¬Ğ­D­¸®-®¡¯¯‹° °u°ê±`±Ö²K²Â³8³®´%´œµµŠ¶¶y¶ğ·h·à¸Y¸Ñ¹J¹Âº;ºµ».»§¼!¼›½½¾
¾„¾ÿ¿z¿õÀpÀìÁgÁãÂ_ÂÛÃXÃÔÄQÄÎÅKÅÈÆFÆÃÇAÇ¿È=È¼É:É¹Ê8Ê·Ë6Ë¶Ì5ÌµÍ5ÍµÎ6Î¶Ï7Ï¸Ğ9ĞºÑ<Ñ¾Ò?ÒÁÓDÓÆÔIÔËÕNÕÑÖUÖØ×\×àØdØèÙlÙñÚvÚûÛ€ÜÜŠİİ–ŞŞ¢ß)ß¯à6à½áDáÌâSâÛãcãëäsäüå„ææ–çç©è2è¼éFéĞê[êåëpëûì†ííœî(î´ï@ïÌğXğåñrñÿòŒóó§ô4ôÂõPõŞömöû÷Šøø¨ù8ùÇúWúçûwüü˜ı)ıºşKşÜÿmÿÿÿî !Adobe d                 ÿÛ „ 		



ÿÂ  ) È ÿÄ Ú                                 !1 0A@#4PB3$%(      !1Ñ"2¢3QBrAaRb‚’c‘¡´@qÁÒ#CS³$e         12 0!A"ğaqRr¡ÁBb²Â@P`Q±Ñá‚’¢ÒÿÚ    é˜kÊğ>ÕÆ^–ëuÌX£Œ>DÑŞİ‚uU<¼(¹Û®Ñ=  $åâ8·ÙVôNÉã+uº–Fm§TqdÖ#™Ãk-º/óßÍ™üæÖ¿«A¯Ø·ª¡”µª1É¹ïì3k†Pá1ç¼üJ®gf˜F³¦E½(Õâ³Û¢jâÚì‹z:^6á·±@>µòS³-éÑ#ƒ¤¯ô™,Ë0º²–¹+Œ 3ZÍ$a9£	¿©Õõò¶}½\h‹ù.Öí¤×†ñnåñ&8lSÕ\…úş“«F(˜µ4´   bER9.Ø  Zfs£&  &d¦!”€           ?ÿÚ    =èFÕÊ¹_àµ Ş„Öñ×:¿Ë8Ñ}9Pš¹Ğ¹ĞšàµhMæFõ¸¬¼„Ô®tğ[È¾€¡Púÿ qh+è4!E7¨…€=¾ Z/­[ÄjŞ@®5Æ„*Ş`®>Vòã\hÔ%¡
 µÔK@jğµZ­V«UªÕjZ­V«UªÕjµ	o@P«UªÕjµZ­ø¯ÿÚ   DdHs¹tT@ˆb¦ı1*g‡‹…Á"·\+‡¥HŞ
É”†,©Fš¹‹ò6ˆ”ÒŠs4x“¢.¼•É÷c ·‘1ÌÇYØ,İ»ó$GŠ”ÇV@İFêåz6]Ê©¨‹WfE3<ü•d)³á9¾îk¢q1<\“U+¶jA2iô3“|ß¤W¿ç7îâ­d¯Ó?íôzÌéš9É•#Ğÿ aÚ%"-ÒæÙ±„ôr¹N4Hx°üït„äM¨I2à“xàN‚,ÅÆr*¬ç3ê±@U  HcÄR<h˜ ÓVÅD«F	Îº"¢m[D½gqà¨¢Àå3Xş‘şY‚àÕ˜"?–À°"‰S/ôÿÚ   Yc¦1½ql‚<ØøS(­Ç%¹±'qpóLeã¹sæ5šeÍñH'0o–cù¾ØˆÄ§¹×!¾Cî:m¸Ègiëüı®iÈk×1®c\Æ¹rıB}W:,Ø=}%¿ç¾ù7¦œãeÖ§Ø"fYçoãÄ÷0ŞG	İ³iûŒÉ]¶ÉöB¶Ãwş%‹mLO È·Tùòü*zZnl(Dö¾{’bN³×ÛcÃíAKXd[®I‘ğM¼şjwù)8¢˜¼«©\s•(¹ÌFr“ÏÒâ3ç=%‚Ä¸“Äá\.ma®õ£¼ÃÚ˜pb0{P
Aèÿ è¯o`‡C"½'oãîZ?ó¶v¶È±é+œÊåîÔ)OµöF1¬°Ø½é)ãéää˜8{¹¡4‹˜Œ«Aƒ²N±HTÚB˜äI(â˜²ÖiOcĞ¸”C\Àcá0¼?RÅ@‚zNJ5ä—bú#"ÖA7;×I÷¾³Æ]äqmµLClÆ«ElKOûy}Y<äØ&1‡ÂäšiÜ‡-ˆ.E‰ëì]†©!qôöÄÕYcü_ZÉ°™Á5klO#4áZ9g&›öù3¤nWì€;v»v»v»v»v»v»vbñKµÁô¼&ë·aë·aë·aë·aë·aë·aë·aë5ÕÙRö¼Å`#;v»v»v‡‡6Ö±Ó,ã·aÿ ÿÚ ? ùîblÑ®¨êF•54Ò¯ÔOÿÚ ? –€A€¶øµ¬•<2£ˆ¬¸Œß)R¦¢²5$ÀĞS ·~èKàt¸rÇùåŠPp¼Ú¾U…­º,cƒ`xb51.–rÖêJ°µ¡íŒËºT”´À UZóøÂŒ-y@°1Ä>ÉŠßcì}UéîÇké™è;½U­Û[á‰ØŸ|==Xõîş1ÿ O½Çı§/ÃñCÌL¹¼0İŠÃÛÑJÒ7S]æƒ•ºû¡ÙÅš/S^›çè•—Oón!Ï&åq8ØÙz»Ğ1l´İİ‡™_4eÜ=0 ;[3AË»vx²{0€ü-êËD,[iêüå•„Q—"å—k@Ì÷[–]u|šÊBAÇP$-\>ÿÚ ? wTiY²Ä´ÜÄ
í TêÛí­ÕÓ4qÉp±ªNÓ²F5;iÙ«[¬œSÎ.å1E°BõUÜXïdF­²‘ØßGåøÅÚ#FòNT9á½TıMò+hŞ^¼¸é‘½¬ˆÎÅ^f…9L	w:ÓÃ¨r6.ïk8;£FŞT‚¬×i×n»N¥Í\ÛËum¢K%C!ÚÆ@óSQæ­­ŞÖ	d’4ŠFô¶ÔíáÇá¬f"îÚ[‡¿£M20U‚6}Šäãñ|¾»j?®İ^aïp—_ue!ŠB’ÆU©Ä2ğìe;µy*áov0}Äô’"Û9‰ ióJº¹ÈÚZËg½Á·	3+3Q·xx/›]§]ºí×n»uÛ®İryƒ›·.¾-µ¥iğ®®&ÿ •’WéRÕ«äjU’qulÿ ƒ¤«ë:ÅÃeY--1Ë|ÔãAvCn?¹ËÖ^ã¨¢I¬0¹½]à–IK±£¡˜HÚ´Ô¹‹N€³=)6A) 	9ªœĞv#	†?æÖ
ÿ §±qOŒËE;"M+‰ XßÍºŒãÅ»Å©bÈô÷.	"c´‰9g‰Ÿx!£’¿"};õuËâ¢±Éò¦{0¨°¡““2¾çZ…óàÕÓXôìO4%fVšXâŒÌ’]¡Nß(_«Y™ši‘²Õ/-Õ‹%PRD'Ö¡à|º±°µÃGqŠyD—“@‘İ·˜ãu¢+*Ÿæk¤s-‹ûˆïm¡¹µs1BTÍCèîÉú7jnšèü4y;›gxå.ZG†¼ŞZ#&ÕJ0ÜÍ¤½ËãÎ/"%’‹3»ÂbjWÆxµ–‘ü‰u7ãÁQ	Ö{+ƒE’K5Ù®LQ$±» ¨RTíS¦¸ƒõæBHÌÏ+ÆÉ2Â‡iH£'ú[Puµµ¬RHåk'‘‚‰†7Ep	ª‘^Ï.±˜|Vozªşe¸³íN¡Ö$›H-Å6jã¦3ØÅÅu
éV¼±©c«UÑ©âó>åÓA¸!’Ie´µ¢ğI^ßñ6±¹+¸„W–ñÍ<
ì*Êx…?kü„Ç]€Ó™ÛSÙµâ?*êå¼Î6¤ÛV¬*®ßİÖnæ´1XÜ0şˆ›]?™Dÿ {i{r³7ò®d @x×øµÖ™k‚eû,RZÛ³q#i~˜áQ®¦µŠ»÷4À~–2/õnUÓ4]M-¥ªÎñ\âB³ÆŒub¼Å_ŸË¬dB—Ó°Æ]müw5<»µÒô Úc;?)˜jôÿ :Oî:êÃ8¯±A)nÍ„Kº¿—us¥~ÜEd­ğÜn†Ïì¬8ÿ ËÈêkÿ œÓğÇ§÷³«¾®ÁLÒc$™®şâİöÍjÒ5Z´51ïn¿¿«•Ë?:ÿ *Ä×T¡•w!jpŞ(ÊÚÊ+ È÷p†SØATk¨cÃZ-”7\‰%†2voYw I¥Gnº]×6—¦öØİĞDŒÀ}Qï]b:„ØÜe–úVøF±ÒE§Ãj³ıZ¿±—"Øy®2SEúÔƒ!…›Í«¢¼êVº¸µ¹G3DCÊAÛ°ÈÒ1«¤fPÅ-®Y	‡p·1 |uÍº!ù`ùÜÍßì¥¼”]²Š;*£±!å©¿wJÒË!/!ø³Ÿí:½ÃÃK3z‚).
) ¸UâÀmÑéâd,J¼|ÕClvŞ§µ¼hüUõ˜é«l¢;e^ZŞ¼u+ŠC%@fT»µ’¶»Ì.K–¶û[ËC	Œš6äupÍµùu+ôÿ Xy|-Âhå)úXÂB¾±ØïıŠ†Í§š{‡„»Í=É]îIzĞ,hŠ5ÍMÔÇ>:XcAnJ±µñn>?÷6®zĞç#3³É9³ä»LF=›·şššÎã­2‡+}«<„È#–*Ê)3VSPhusÓùeKœ„ÑÏÈ˜‹åª"TmQõ~­Zô™Ï ‚ÖñïçíÎã¸nÿ Á™ía¡“©QFojÂÛ‰V”ñş`~î¯m¬ºÈÃ†ÈJòÜceåcïeTV+·v¿Ã­.¾âI_wtãkI% ìUP(««ÌÜİH°Ïw78"[Ô%(A/ÇhR`dÊGo-ÂÄ·7b2Û¹d3mJ»ÙW‡W¶3åá¼³¹”MºT„%v0bYV k¨²¸É7a±å­ñ’¿Zfñ4âªŠÁa—_â¶¹ÇeJªÌûÅ.Ş
Ì\—VyLçU¶TãI{VçIÉ´ª3s[ş;¨£åĞÌ¦u.÷G$RÀ`ÙQ'¼ÒŒ>3ã»QÅ*Å

qÚ(À“úµms^S]nXÔŸl)ÚÀ7ëb6®­¬‹Äî*?\\O«hĞåáş{·ï×±ë~ı{·ï×±ë~ı{·ï×±ë~ı{·ïÔĞ¢TdYC1*XSpÓ†®g·¼¸»K¨Õ$Šm UMUM¦¼N½[÷ëØõ¿~½[÷ëØõ¿~½[÷ëØõ¿~½[÷êÚÖk»‹+HÈğÀA7`,_w”WoÕ¤Çc­JÂ¤³;;w=¬äS¯cÖıúö=oß¯cÖıúö=oß£o<‡ì¢rö±)`’Z¼IŞÌß³»I.MÍÏ%9P’M@­x‘Ûõ{·ïÿ :ÿÙ