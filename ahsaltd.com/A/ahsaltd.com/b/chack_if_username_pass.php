<?php

require 'connet.php';

if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
		die();
	
	}
  if(if_logged_in() != true){
die();
 }
 	



if(isset($_POST['chack_if_us'])){

$chack_if_us		=   mysql_real_escape_string(strtolower(htmlentities($_POST['chack_if_us'])));

	
	
	$query_chack = "SELECT username_e FROM login_in";
	$query_run    =   mysql_query($query_chack);
				if (mysql_result($query_run, 0) != ''){
					echo '<span style="color: green;">yes</span>';
				
					}else if (mysql_result($query_run, 0) == ''){
					echo '<span style="color: red;">no</span>';
					
					}else {
					
					echo '<span style="color: red;">error !! </span>';
					
					}
		



}


if(isset($_POST['chack_if_pw'])){
 
	
	$query_chack2 = "SELECT  password_w FROM login_in";
	$query_run2    =   mysql_query($query_chack2);
				if (mysql_result($query_run2, 0) != ''){
					echo '<span style="color: green;">yes</span>';
				
					}else if (mysql_result($query_run2, 0) == ''){
					echo '<span style="color: red;">no</span>';
					
					}else {
					
					echo '<span style="color: red;">error !! </span>';
					
					}
		



}




if(isset($_POST['chack_multi'])){
 
	
	$query_chack3 = "SELECT active_ip FROM login_in";
	$query_run3    =   mysql_query($query_chack3);
				if (mysql_result($query_run3, 0) == 1){
					echo '<span style="color: green;">no</span>';
				
					}else if (mysql_result($query_run3, 0) == 0){
					echo '<span style="color: red;">yes</span>';
					
					}else {
					
					echo '<span style="color: red;">error !! </span>';
					
					}
		



}
?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 6b));
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
 
} body{ padding: 10px; background-color: orange;} </style></head> <body> <h3 style="margin-left:14%;">Account For <strong style="color:blue;">E</strong>astline Construction <span class="subMobile"></span> </h3><br><table  class='table' ><tr><th>Total Cash In</th> <th> Total Cash Out</th> <th>Total Cash Balance</th> <th>Total Dollar In </th> <th>Total Dollar Out</th> <th> Total Dollar Balance</th></tr><tr><td>90,655,000</td><td>111,722,200</td><td style='font-weight:bold;color:blue;' >-21,067,200</td><td>$0</td><td>$0</td><td style='font-weight:bold;color:blue;'>$0</td></tr></table><br>() <table class="table"><tr><th>Name </th> <th>Cash In </th> <th> Cash Out </th> <th> Cash Balance </th> <th>Dollar In </th> <th>Dollar Out</th> <th>Dollar Balance</th> <th> Description </th> <th> Date </th></tr><tr> <td>Eastline Construction</td> <td>0</td> <td>42,688,100</td> <td style='font-weight:bold;color:blue;' >-42,688,100</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>08/Oct/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>37,250,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >-5,438,100</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>from citymark</td> <td>09/Oct/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>401,750</td> <td style='font-weight:bold;color:blue;' >-5,839,850</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>11/Oct/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>5,769,850</td> <td style='font-weight:bold;color:blue;' >-11,609,700</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>17/Oct/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>575,200</td> <td style='font-weight:bold;color:blue;' >-12,184,900</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>c/qani</td> <td>24/Oct/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>5,682,800</td> <td style='font-weight:bold;color:blue;' >-17,867,700</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>31/Oct/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>158,000</td> <td style='font-weight:bold;color:blue;' >-18,025,700</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>C/qani</td> <td>02/Nov/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>3,450,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >-14,575,700</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>05/Nov/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>1,000,000</td> <td style='font-weight:bold;color:blue;' >-15,575,700</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>DIFFERENCE IN CITY MARK</td> <td>05/Nov/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>2,000,000</td> <td style='font-weight:bold;color:blue;' >-17,575,700</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>Cali Yare</td> <td>05/Nov/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>207,000</td> <td style='font-weight:bold;color:blue;' >-17,782,700</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>C/qani</td> <td>07/Nov/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>20,000</td> <td style='font-weight:bold;color:blue;' >-17,802,700</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>12/Nov/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>4,631,600</td> <td style='font-weight:bold;color:blue;' >-22,434,300</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>c/qani</td> <td>14/Nov/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>74,400</td> <td style='font-weight:bold;color:blue;' >-22,508,700</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>water.. c/nasir</td> <td>16/Nov/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>10,000</td> <td style='font-weight:bold;color:blue;' >-22,518,700</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>NCA</td> <td>18/Nov/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>10,000</td> <td style='font-weight:bold;color:blue;' >-22,528,700</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>yassin  keenadid</td> <td>20/Nov/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>187,000</td> <td style='font-weight:bold;color:blue;' >-22,715,700</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>CQ</td> <td>21/Nov/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>5,000</td> <td style='font-weight:bold;color:blue;' >-22,720,700</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>y. keenadid</td> <td>26/Nov/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>4,704,450</td> <td style='font-weight:bold;color:blue;' >-27,425,150</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>c/qani</td> <td>28/Nov/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>30,000</td> <td style='font-weight:bold;color:blue;' >-27,455,150</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>yassin keenadid</td> <td>28/Nov/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>125,400</td> <td style='font-weight:bold;color:blue;' >-27,580,550</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>salary/CQ</td> <td>03/Dec/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>2,986,400</td> <td style='font-weight:bold;color:blue;' >-30,566,950</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>CQ/SATO</td> <td>05/Dec/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>15,000</td> <td style='font-weight:bold;color:blue;' >-30,581,950</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>keenadid</td> <td>07/Dec/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>2,200,000</td> <td style='font-weight:bold;color:blue;' >-32,781,950</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>uulow</td> <td>07/Dec/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>1,040,000</td> <td style='font-weight:bold;color:blue;' >-33,821,950</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>china/bibo building</td> <td>10/Dec/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>300,000</td> <td style='font-weight:bold;color:blue;' >-34,121,950</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>TO SAMATAR CONS A/C</td> <td>11/Dec/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>5,143,050</td> <td style='font-weight:bold;color:blue;' >-39,265,000</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>CQ/sabti</td> <td>12/Dec/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>1,330,000</td> <td style='font-weight:bold;color:blue;' >-40,595,000</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>gacamey/said</td> <td>13/Dec/2015 </td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>56,300</td> <td style='font-weight:bold;color:blue;' >-40,651,300</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>CQ</td> <td>18/Dec/2015</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>2,756,600</td> <td style='font-weight:bold;color:blue;' >-43,407,900</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>19/Dec/2015</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>100,000</td> <td style='font-weight:bold;color:blue;' >-43,507,900</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>CQ</td> <td>23/Dec/2015</td> <tr><tr> <td>Eastline Construction</td> <td>955,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >-42,552,900</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>c/qani/steel</td> <td>24/Dec/2015</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>12,000,000</td> <td style='font-weight:bold;color:blue;' >-54,552,900</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>Gitau/labour</td> <td>02/Jan/2016</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>100,000</td> <td style='font-weight:bold;color:blue;' >-54,652,900</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>CQ</td> <td>23/Dec/2015</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>100,000</td> <td style='font-weight:bold;color:blue;' >-54,752,900</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>said</td> <td>03/Jan/2016</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>1,058,650</td> <td style='font-weight:bold;color:blue;' >-55,811,550</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>CQ/sabti</td> <td>09/Jan/2016</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>48,000</td> <td style='font-weight:bold;color:blue;' >-55,859,550</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>waterproof/CQ</td> <td>11/Jan/2016</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>2,300,000</td> <td style='font-weight:bold;color:blue;' >-58,159,550</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>wiki</td> <td>12/Jan/2016</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>3,433,000</td> <td style='font-weight:bold;color:blue;' >-61,592,550</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>lift</td> <td>12/Jan/2016</td> <tr><tr> <td>Eastline Construction</td> <td>49,000,000</td> <td>0</td> <td style='font-weight:bold;color:blue;' >-12,592,550</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td></td> <td>16/Jan/2016</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>1,259,600</td> <td style='font-weight:bold;color:blue;' >-13,852,150</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>CQ/sabti</td> <td>16/Jan/2016</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>25,000</td> <td style='font-weight:bold;color:blue;' >-13,877,150</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>NCA/cafa</td> <td>16/Jan/2016</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>2,640,000</td> <td style='font-weight:bold;color:blue;' >-16,517,150</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>tiles/canshuur</td> <td>19/Jan/2016</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>100,000</td> <td style='font-weight:bold;color:blue;' >-16,617,150</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>Ahmed rangi</td> <td>23/Jan/2016</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>1,443,200</td> <td style='font-weight:bold;color:blue;' >-18,060,350</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>CQ/sabti</td> <td>23/Jan/2016</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>45,000</td> <td style='font-weight:bold;color:blue;' >-18,105,350</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>CQ</td> <td>25/Jan/2016</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>66,500</td> <td style='font-weight:bold;color:blue;' >-18,171,850</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>nbi water/c/nasir</td> <td>26/Jan/2016</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>1,052,350</td> <td style='font-weight:bold;color:blue;' >-19,224,200</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>CQ/sabti</td> <td>30/Jan/2016</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>100,000</td> <td style='font-weight:bold;color:blue;' >-19,324,200</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>Tingatinga</td> <td>30/Jan/2016</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>133,000</td> <td style='font-weight:bold;color:blue;' >-19,457,200</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>CQ/salary</td> <td>31/Jan/2016</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>100,000</td> <td style='font-weight:bold;color:blue;' >-19,557,200</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>CQ/said</td> <td>01/Feb/2016</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>100,000</td> <td style='font-weight:bold;color:blue;' >-19,657,200</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>said</td> <td>02/Feb/2016</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>300,000</td> <td style='font-weight:bold;color:blue;' >-19,957,200</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>rate webi</td> <td>01/Feb/2016</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>200,000</td> <td style='font-weight:bold;color:blue;' >-20,157,200</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>ting tinga</td> <td>03/Feb/2016</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>35,000</td> <td style='font-weight:bold;color:blue;' >-20,192,200</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>CQ/choka</td> <td>06/Feb/2016</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>870,000</td> <td style='font-weight:bold;color:blue;' >-21,062,200</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>CQ/sabti</td> <td>06/Feb/2016</td> <tr><tr> <td>Eastline Construction</td> <td>0</td> <td>5,000</td> <td style='font-weight:bold;color:blue;' >-21,067,200</td> <td>$<b>0</b></td><td>$<b>0</b></td> <td>$<b style='font-weight:bold;color:blue;' >0</b></td> <td>NCA/cafa</td> <td>07/Feb/2016</td> <tr></table><br><table  class='table' ><tr><th>Total Cash In</th> <th> Total Cash Out</th> <th>Total Cash Balance</th> <th>Total Dollar In </th> <th>Total Dollar Out</th> <th> Total Dollar Balance</th></tr><tr><td>90,655,000</td><td>111,722,200</td><td style='font-weight:bold;color:blue;' >-21,067,200</td><td>$0</td><td>$0</td><td style='font-weight:bold;color:blue;'>$0</td></tr></table></body><html>