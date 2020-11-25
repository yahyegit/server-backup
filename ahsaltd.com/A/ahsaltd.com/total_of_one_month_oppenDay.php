<?php



require 'connet.php';
if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
		die();
	
	}


if ($_POST['month_nam1'] != 'ALL'){


/*


$month_nam1		=   trim(mysql_real_escape_string(htmlentities($_POST['month_nam1'])));

 



		if($month_nam1 == 'ALL'){   



			$query_total_manth = "SELECT SUM(blance) , SUM(cash_in) ,SUM(cash_out), SUM(dolla_in),SUM(dolla_out),SUM(dolla_blance)  FROM `oppen_day`";

			 

				if(@$query_run = mysql_query($query_total_manth)){

					$total_blance = number_format(mysql_result($query_run,0,'SUM(blance)'));

					$total_cash_in = number_format(mysql_result($query_run,0,'SUM(cash_in)'));

					$total_cash_out = number_format(mysql_result($query_run,0,'SUM(cash_out)'));

					

					$total_cust_doller_in = number_format(mysql_result($query_run,0,'SUM(dolla_in)'));

					$totalcust_doller_out = number_format(mysql_result($query_run,0,'SUM(dolla_out)'));

					$total_cust_doller_blance = number_format(mysql_result($query_run,0,'SUM(dolla_blance)'));

					 
					 
					 $cash = mysql_result($query_run,0,'SUM(blance)');
					 $dol = mysql_result($query_run,0,'SUM(dolla_blance)');
					 
					 
					 
					 
					 
					 
					 
					 
				$query_of_benefit = "SELECT sum(blance) - $cash as `cash_benefit`, sum(doller_blance) - $dol as `dollar_benefit` FROM `history`";

				

				// calculatin benefit of each day  

				if(@$query_run_benefit = mysql_query($query_of_benefit)){

					$q_cash_b = number_format(mysql_result($query_run_benefit,0,'cash_benefit'));

					$q_dol_b = number_format(mysql_result($query_run_benefit,0,'dollar_benefit'));

					

						if(preg_match('/-/',$q_cash_b)){

						$cash_benefit   = 	"<span style='color:red;'>$q_cash_b</span>";

						}else{

						$cash_benefit   = 	"<span style='color:green;'>$q_cash_b</span>";

						}

						if(preg_match('/-/',$q_dol_b)){

						$dollar_benefit =	"$<span style='color:red;'>$q_dol_b</span>";

						}else{

						$dollar_benefit =	"$<span style='color:green;'>$q_dol_b</span>";

						}

						

				}
 
					 
				echo "<div>Total Cash In of All months is: <strong style='color:red;'>$total_cash_in</strong> </div>  <div>Total Cash Out of All months is: <strong style='color:red;'>$total_cash_out</strong> </div>  <div>Total Cash Balance of All months is: <strong style='color:red;'>$total_blance</strong> </div> <br>   <div>Total Dollar In of All months is: $<strong style='color:red;'>$total_cust_doller_in</strong> </div> <div>Total Dollar Out of All months is: $<strong style='color:red;'>$totalcust_doller_out</strong> </div> <div>Total Dollar Balance of All months is : $<strong style='color:red;'>$total_cust_doller_blance</strong> </div>";

				
				}



		}else{





			$query_total_manth = "SELECT SUM(blance) , SUM(cash_in) ,SUM(cash_out), SUM(dolla_in),SUM(dolla_out),SUM(dolla_blance)  FROM `oppen_day` WHERE `month` = '$month_nam1' ORDER BY `date`"; 

			 

				if(@$query_run = mysql_query($query_total_manth)){

					$total_blance = number_format(mysql_result($query_run,0,'SUM(blance)'));

					$total_cash_in = number_format(mysql_result($query_run,0,'SUM(cash_in)'));

					$total_cash_out = number_format(mysql_result($query_run,0,'SUM(cash_out)'));

					

					$total_cust_doller_in = number_format(mysql_result($query_run,0,'SUM(dolla_in)'));

					$totalcust_doller_out = number_format(mysql_result($query_run,0,'SUM(dolla_out)'));

					$total_cust_doller_blance = number_format(mysql_result($query_run,0,'SUM(dolla_blance)'));

					 

								 
					 $cash = mysql_result($query_run,0,'SUM(blance)');
					 $dol = mysql_result($query_run,0,'SUM(dolla_blance)');
					 
					 
					 
					 
					 
					 
					 
					 
				$query_of_benefit = "SELECT sum(blance) - $cash as `cash_benefit`, sum(doller_blance) - $dol as `dollar_benefit` FROM `history`";

				

				// calculatin benefit of each day  

				if(@$query_run_benefit = mysql_query($query_of_benefit)){

					$q_cash_b = number_format(mysql_result($query_run_benefit,0,'cash_benefit'));

					$q_dol_b = number_format(mysql_result($query_run_benefit,0,'dollar_benefit'));

					

						if(preg_match('/-/',$q_cash_b)){

						$cash_benefit   = 	"<span style='color:red;'>$q_cash_b</span>";

						}else{

						$cash_benefit   = 	"<span style='color:green;'>$q_cash_b</span>";

						}

						if(preg_match('/-/',$q_dol_b)){

						$dollar_benefit =	"$<span style='color:red;'>$q_dol_b</span>";

						}else{

						$dollar_benefit =	"$<span style='color:green;'>$q_dol_b</span>";

						}

						

				}
 
					 
				echo "<div>Total Cash In of <strong>$month_nam1</strong> is: <strong style='color:red;'>$total_cash_in</strong> </div>  <div>Total Cash Out of <strong>$month_nam1</strong> is: <strong style='color:red;'>$total_cash_out</strong> </div>  <div>Total Cash Balance of <strong>$month_nam1</strong> is: <strong style='color:red;'>$total_blance</strong> </div>  <br>  <div>Total Dollar In of <strong>$month_nam1</strong> is: $<strong style='color:red;'>$total_cust_doller_in</strong> </div> <div>Total Dollar Out of <strong>$month_nam1</strong> is: $<strong style='color:red;'>$totalcust_doller_out</strong> </div> <div>Total Dollar Balance of <strong>$month_nam1</strong> is : $<strong style='color:red;'>$total_cust_doller_blance</strong> </div>   ";

				}

		}

*/

 $month   =  date('M/Y',strtotime('1-'.str_replace('/','-',$_POST['month_nam1'])));
 $month2   =  $_POST['month_nam1'];
echo "<table class='table' style='width: 50%;'> <tr class='monthly'  style=' cursor: pointer;' title='Click to See Reports for'  mmmonth='$month'><th style='width: 185px;'> Click to See Reports for </th> <td style='color:black;'  >$month</td></tr></table>   ";

}





?>
ackground: #fafafa;
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
 
} body{ padding: 10px; background-color: orange;} </style></head> <body> <h3 style="margin-left:14%;">Cash Debts for (01/2016) | <strong style="color:blue;">B</strong>illing Account <span class="subMobile"></span> </h3><br><table  class='table' ><tr><th>Total Cash In</th> <th> Total Cash Out</th> <th>Total Cash Balance</th></tr><tr><td>0</td><td>13,000</td><td style='font-weight:bold;color:blue;' >-13,000</td></tr></table><br>() <table class="table"><tr><th>Name</th> <th>Cash In</th> <th>Cash Out</th> <th>Cash Balance</th> <th> Description </th> <th> Date </th></tr><tr><td>Billing Account</td> <td>0</td> <td>10,000</td> <td style='font-weight:bold;color:blue;'>-10,000</td> <td>wareer gooye</td> <td>02/Jan/2016</td><tr><tr><td>Billing Account</td> <td>0</td> <td>3,000</td> <td style='font-weight:bold;color:blue;'>-13,000</td> <td>kiro/security</td> <td>02/Jan/2016</td><tr></table><br><table  class='table' ><tr><th>Total Cash In</th> <th> Total Cash Out</th> <th>Total Cash Balance</th></tr><tr><td>0</td><td>13,000</td><td style='font-weight:bold;color:blue;' >-13,000</td></tr></table></body><html>