<?php
     
 require 'includes/inc_func.php';
 if(if_logged_in() != true){
    session_destroy();
     echo '<script type="text/javascript" > location.href ="login.php";  </script>';
   die();
 } 
 
 $gethemeName = str_replace(" ",'',mysql_result(mysql_query("SELECT theme FROM users WHERE user_id=$userId_activities"),0));
 
 
 switch($gethemeName){
 case "theme1!":
 $user_theme = 'js/jquery-ui-and-jquery/css/le-frog/jquery-ui-1.10.3.custom.css';
 break;
 case "theme9":
 $user_theme =  'js/jquery-ui-and-jquery/css/dark-hive/jquery-ui-1.10.3.custom.css';
 break;
 case "theme2":
 $user_theme = 'js/jquery-ui-and-jquery/css/dot-luv/jquery-ui-1.10.3.custom.css';
 break;
 case "theme3":
 $user_theme =  'js/jquery-ui-and-jquery/css/eggplant/jquery-ui-1.10.3.custom.css';
 break;
 case "theme4":
 $user_theme = 'js/jquery-ui-and-jquery/css/flick/jquery-ui-1.10.3.custom.css';
 break;
 case "theme5":
 $user_theme = 'js/jquery-ui-and-jquery/css/mint-choc/jquery-ui-1.10.3.custom.css';
 break;
 case "theme6":
 $user_theme = 'js/jquery-ui-and-jquery/css/smoothness/jquery-ui-1.10.3.custom.css';
 break;
  case "theme7!":
 $user_theme = 'js/jquery-ui-and-jquery/css/sunny/jquery-ui-1.10.3.custom.css';
 break;
  case "theme8":
 $user_theme = 'js/jquery-ui-and-jquery/css/ui-darkness/jquery-ui-1.10.3.custom.css';
 break;
   case "theme9!":
 $user_theme = 'js/jquery-ui-and-jquery/css/ui-darkness/jquery-ui-1.10.3.custom.css';
 break;
 
  case "theme10":
 $user_theme = 'js/jquery-ui-and-jquery/css/theme 10/jquery-ui.css';
 break;
 
  case "theme11":
 $user_theme = 'js/jquery-ui-and-jquery/css/theme 11/jquery-ui.css';
 break;
 
  case "theme12":
 $user_theme = 'js/jquery-ui-and-jquery/css/theme12/jquery-ui.css';
 break;
 
   case "theme13":
 $user_theme = 'js/jquery-ui-and-jquery/css/theme13/jquery-ui.css';
 break;
 
  case "theme14!":
     $user_theme = "js1/Delta-jQuery-UI-Theme-master/theme/jquery-ui.css";
 break;
 
   case "theme15!":
     $user_theme = "js1/Absolution-master/compiled/absolution.css";
 break;
 
 default:
 $user_theme = 'js1/Delta-jQuery-UI-Theme-master/theme/jquery-ui.css';
 break;
 
 }

?>
<!doctype html>
<html lang="en">
 
<head>
 
<title> <?php echo mysql_result(mysql_query('SELECT storeName FROM `adminSettings` limit 1'),0);?></title>
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link checkAds="1"  rel="shortcut icon" href="images/truck_container.png" />
 <link checkAds="1"  rel="stylesheet" class="themeToggle" href="<?php echo $user_theme; ?>"   media="all"  /> <!-- this theme can be customizable  -->	
 <link checkAds="1"  rel="stylesheet" href="js/media/css/demo_table_jui.css"   media="all" />
 <link checkAds="1"  rel="stylesheet" href="css/style.css"  media="all"   />	
 <link checkAds="1"  rel="stylesheet" href="css/print.css" media="print"   />	
 <!--- <link checkAds="1"  rel="stylesheet" href="css/responsiveTable.css"   media="all" />  --->
 
 <script checkAds="1"  src="js/jquery-ui-and-jquery/js/jquery-1.9.1.js"  charset="utf-8"  type="text/javascript"><!--sorry this page is can't loaded correctly--></script>
 <script checkAds="1"  src="js/jquery-ui-and-jquery/js/jquery-ui-1.10.3.custom.min.js" charset="utf-8"  type="text/javascript"><!--sorry this page is can't loaded correctly--></script>
 <script checkAds="1"  src="js/DataTables-1.9.4/media/js/jquery.dataTables.js"  charset="utf-8" type="text/javascript"><!--sorry this page is can't loaded correctly--></script>
 
 
 <script checkAds="1"  src="js1/index.js"  charset="utf-8"  type="text/javascript"><!--sorry this page is can't loaded correctly--></script>
  <script checkAds="1"  src="js1/settings.js"  charset="utf-8" ><!--sorry this page is can't loaded correctly--></script>   

 </head>
<body style="display:none; background-image:url('images/background.jpg'); ">

 <div id="main_tabs">
  <ul>
	<li><a href="#HOME_div" onclick="">HOME</a></li>
    <li><a href="#suppliers_main_div" onclick="load_function('suppliers_main_div','trucks','','trucks')">Trucks</a></li>
    <li><a href="#workers_main_div" onclick="load_function('workers_main_div','Income','','Income')">Income</a></li>
	<li><a href="#others_main_div" onclick="load_function('others_main_div','expenses','','expenses')">Expenses</a></li>
    <li><span class="settings-icon ui-button-icon-primary ui-icon ui-icon-gear" ></span><a href="#settings" class="" > Settings </a></li>
 
 	<?php 
	echo '<a href="#" style="float:right;"  actn="logout" id="logout_button">LogOut (<strong>'.mysql_result(mysql_query("SELECT username FROM users WHERE user_id=".$_SESSION['user_id'].""),0).'</strong>)</a> '; ?>
 
 
  </ul>
  
  
  
  <div id="suppliers_main_div">
     <div class="progressbar"></div>                   

    </div>
   

	  <div id=" HOME_div">
       

  </div>

  <div id="workers_main_div">
        <div class="progressbar"></div>

  </div>
  
   <div id="others_main_div">
       <div class="progressbar"></div>
      <div id="others_main">
	  
	  </div>

   </div>
  
  <div id="projects_main_div">
           <div class="progressbar"></div>
	  <div id="projects_main">
	  
	  </div>
 
   </div>
 
   <div id="settings">
   
    <?php
 
 if(if_logged_in() != true){
     die();
 }
 
 $userdata = '<div>';
 	 $username =   mysql_result(mysql_query( "SELECT username FROM users WHERE user_id=$userId_activities"),0,'username');
	 $password = '**********';
	 $mobile =   mysql_result(mysql_query( "SELECT mobile_number FROM users WHERE user_id=$userId_activities"),0,'mobile_number');
	 $theme =   mysql_result(mysql_query( "SELECT theme FROM users WHERE user_id=$userId_activities"),0,'theme');
	 $email =   mysql_result(mysql_query("SELECT `email` FROM `adminSettings` limit 1"),0);
	 
	  $totalDays =   mysql_result(mysql_query("SELECT `total_days` FROM `adminSettings` limit 1"),0);  // total_days
	  $toggleTime =   mysql_result(mysql_query("SELECT `toggleTime` FROM `adminSettings` limit 1"),0);  // toggle time
	  
	 	$storeName =  mysql_result(mysql_query("SELECT `storeName` FROM `adminSettings`  LIMIT 1"),0);
 	$location =  mysql_result(mysql_query("SELECT   `storeLocation` FROM `adminSettings`  LIMIT 1"),0);
 $storeNumber =  mysql_result(mysql_query("SELECT `number` FROM `storeNumber` LIMIT 1 "),0);
 
     $userdata .= "<p><label> UserName : </label> $username   <a href='#' class='change' style='float:right' onclick=\"changeUsername('$username')\">Change</a></p>  " ;
	 $userdata .="<p> <label>Password: </label> $password   <a href='#' class='change' style='float:right' onclick=changePass()>Change</a></p>  ";
	 $userdata .="<p> <label> Mobile:  </label>$mobile    <a href='#' class='change' style='float:right' onclick=changeMobile('$mobile')>Change</a></p> ";
     $userdata .=" <p> <label>Theme: </label>$theme   <a href='#' class='change' style='float:right' onclick=\"changeTheme()\">Change</a></p>";
 
    $userdata .=" <p> <label>Company Name: </label>$storeName   <a href='#' class='change' style='float:right' onclick=\"changeStoreName('$storeName')\">Change</a></p>";
   $userdata .=" <p> <label>Location: </label>$location   <a href='#' class='change' style='float:right' onclick=\"changeLacation('$location')\">Change</a></p>";
   
   
  $userdata .=" <p> <label>Company Contacts: </label> $storeNumber   <a href='#' class='change' style='float:right' onclick=\"changeStoreNumber('$storeNumber')\">Change</a></p>";
   
   
   
   $userdata .=" <p> <label>Admin Email: </label>$email   <a href='#' class='change' style='float:right' onclick=\"changeEmail('$email')\">Change</a></p>";
 
 

 $userdata .= '</div>';
   echo $userdata;
 
?>
 
   
  </div>
 
  
    <!---actions divs--->
 	<div id="add"  style="display:none;">
					
<div id="addTabs">
					
					
	  <ul id="add_tabs_handler">
		<li><a href="#add_tabs_" class="tab_link" >tab 1</a></li>
	  </ul>
	  
  <div id="add_tabs_"  >
 
					<ul class="ul" id=""> 
						<li> <label> Driver Name :  </label><input type="text" collmName="driverName" id="driverName" style="width: 240; margin-left: 19;" error_msg="" required_error="Please enter the Name !!" class="driverName  trucks registerd_trucks"/> </li>  <!-- autocomplate plugin -->
					    <li> <label> Mobile :  </label><input type="text" collmName="mobile" id="mobile" class="mobile  trucks registerd_trucks" error_msg="" required_error=""  />  </li> 
					    <li> <label> Driver license No :  </label><input type="text" collmName="driverLicenseNo" id="driverLicenseNo" class="driverLicenseNo  registerd_trucks trucks  " error_msg="" required_error="Please Enter the license NO !"  />  </li>
					    <li> <label> Truck No :  </label><input type="text" collmName="truck_no" id="truck_no" class="truck_no  trucks registerd_trucks expense" error_msg="" required_error="Please Enter Truck No"  />  </li>
					    <li> <label> Item Name :  </label><input type="text" collmName="itemName" id="itemName" class="itemName  trucks expense" error_msg=""  required_error="Please Enter Item Name !"  />  </li>
						<li> <label> FROM :  </label><input type="text" collmName="source" id="from" class="from trucks" error_msg="" required_error="Please Enter the  FROM"  />  </li>
					    <li> <label> To :  </label><input type="text" collmName="distination" id="to" class="to  trucks" error_msg="" required_error="Please Enter the  to" />  </li>
					  

						<li> <label> Quantity :  </label><input type="text" collmName="quantity" class="quantity trucks" error_msg="invalid Quantity!" required_error="Please Enter Quantity!!"/>  </li>
						<li> <label> Unit Price :  </label><input  collmName="unit_price" type="text"  class="single_cost trucks "  error_msg="invalid  Unit Price" required_error="Please Enter Unit Price or total Price!!" />  </li>
						<li> <label> Total Price :  </label><input  collmName="cost" type="text"   class="totalCost trucks" error_msg="invalid total Price" required_error="Please Enter Unit Price or total Price!!" />  </li>
			            
						
						<li> <label> Date :  </label><input type="text" collmName="date" class="date edate  trucks " error_msg="" required_error="Please Enter Quantity!!"/>  </li>
						 
						 <li><label>Description:</label> <textarea collmName="description"  class="description  trucks " style="width: 509px; height: 163px; padding:5px;" error_msg="" required_error="" > </textarea> </li>
				      
					<li class="toggleExpli"> <label> Add Expenses </label> <input type="checkbox" class="toggleExp trucks  expense"> </li>
					    

					  <div class="add_exp">
						 <li> <label> Name :  </label><input type="text" collmName="name" id="ename" style="width: 240; margin-left: 19;" error_msg="" required_error="Please enter the expense Name !!" class="name  expense trucks"/> </li>  <!-- autocomplate plugin -->
					     <li> <label> Quantity :  </label><input type="text" collmName="equantity" class="equantity expense trucks" error_msg="invalid Quantity!" required_error="Please Enter Quantity!!"/>  </li>
						 <li> <label> type :  </label><input type="text" collmName="type" class="eType trucks expense" error_msg="" required_error="Please Enter Type of expense!!"/>  </li>
						 <li> <label> cost :  </label><input type="text" collmName="excost" class="ecost trucks expense" error_msg="invalid Cost!" required_error="Please Enter  the cost !"/>  </li>
						 <li> <label> Date :  </label><input type="text" collmName="edate" class="date  trucks expense" error_msg="" required_error="Please Enter Date!! "/>  </li>
						 <li><label>Description:</label> <textarea collmName="edescription"  class="edescription   expense trucks" style="width: 509px; height: 163px; padding:5px;" error_msg="" required_error="" > </textarea> </li>
						</div>
					</ul>
  
  </div>  
 
    
      </div>

           <button class="add_more ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" style="float: right; font-size: 0.7em;" title="click to more tabs" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-circle-plus"></span><span class="ui-button-text">Add more</span></button>			
	
	</div>

 
 
 
                         <!---edi box--->
 
							<ul class="ul ulBoxEdit" href="#ulBox" id="ulBox"  style="display:none"> 
											<li> <label> Driver Name :  </label><input type="text" collmName="driverName" id="name" style="width: 240; margin-left: 19;" error_msg="" required_error="Please enter the Name !!" class="name  trucks expense"/> </li>  <!-- autocomplate plugin -->
											<li> <label> Mobile :  </label><input type="text" collmName="mobile" id="mobile" class="mobile  trucks expense" error_msg="" required_error=""  />  </li>
											<li> <label> Driver license No :  </label><input type="text" collmName="driverLicenseNo	" id="driverLicenseNo" class="driverLicenseNo  trucks expense" error_msg="" required_error=""  />  </li>
											<li> <label> Truck No :  </label><input type="text" collmName="truck_no" id="truck_no" class="truck_no  trucks expense" error_msg="" required_error=""  />  </li>

											

											<li> <label> FROM :  </label><input type="text" collmName="source" id="from" class="from trucks expense" error_msg="" required_error=""  />  </li>
											<li> <label> To :  </label><input type="text" collmName="distination" id="to" class="to  trucks expense" error_msg="" required_error=""  />  </li>
											
											 <li> <label> Cost :  </label><input  collmName="cost" type="text" class="cost  trucks expense" error_msg="invalid cost!" required_error="Please Enter the cost !" />  </li>
											 <li><label>Description:</label> <textarea collmName="description"  class="description  trucks expense" style="width: 509px; height: 163px; padding:5px;" error_msg="" required_error="" > </textarea> </li>
											 <li> <label> Date :  </label><input type="text" collmName="date" class="date  trucks expense" error_msg="invalid Quantity!" required_error="Please Enter Quantity!!"/>  </li>
											 
											<li> <label> skip Expenses! </label> <input type="checkbox" class="skip_Expense skip_projects  trucks expense"> </li>
											
											 <h3 class="h3"> Expense </h3>
											 <li> <label> Name :  </label><input type="text" collmName="name" id="ename" style="width: 240; margin-left: 19;" error_msg="" required_error="Please enter the expense Name !!" class="name  trucks expense"/> </li>  <!-- autocomplate plugin -->
											 <li> <label> Quantity :  </label><input type="text" collmName="quantity" class="equantity trucks expense" error_msg="invalid Quantity!" required_error="Please Enter Quantity!!"/>  </li>
											 <li> <label> type :  </label><input type="text" collmName="type" class="eType trucks expense" error_msg="invalid Quantity!" required_error="Please Enter Type of expense!!"/>  </li>
											 <li> <label> Date :  </label><input type="text" collmName="date" class="edate  trucks expense" error_msg="invalid Quantity!" required_error="Please Enter Expense Date!!"/>  </li>
											 <li><label>Description:</label> <textarea collmName="description"  class="edescription  trucks expense" style="width: 509px; height: 163px; padding:5px;" error_msg="" required_error="" > </textarea> </li>
										   
							</ul>
  
  
								  </div>  
							</div>
  
 
 
 
 
 
 
	   <!--payments-->   
	<div id="make_payment" style="display:none">   
		<div class="make_payment_accor">
			 
		   <div>		   
			 <ul class="ul">
				<li> <label> Total Balance :  </label> <strong class="total_balance_payment" style="color:blue; padding:5px;"> 0 </strong> </li>
				<li> <label> Paid :  </label><input type="text"   class="amount_paid"  />  </li> 
				
			    <li><label>Description:</label> <textarea   class="payment_description" style="width: 509px; height: 163px; padding:5px;" > </textarea> </li>
				<li class='date_list' > <label> Payment Date :  </label><input type="text"  placeholder="dd/mm/YY"  class="date"  />  </li> 
				
 
			 </ul>	
			</div>
		 
		</div>
			
	</div>
	
	<div id="payment_history"></div>
	
	
	<div id="suppliers-history"></div>
	<div id="trash_main_div"></div>
	<div id="confirmation"></div>
							
		
   <div id="error" style="display:none"> </div> 


   <div style="display:none" id="loading" > 
         <div class="meter red" style="margin-bottom: 1px; margin-top: 1px;"> <span style="width: 100%"></span>  </div>
   </div> 
 






   <div style="display:none" id="success"> </div>
 
    <div id="warning" class="worning" title="Warning" style="display:none;" ></div>>
	<!-----settings actions------>
		<div id="change_username" style="display:none;">
		<ul>
			 <li> 
			 <label> UserName: </label> <input type="text" id="change_username_input" >
			 </li>
		</ul>
	</div>
	
	<!-- store location and name of store -->
		<div id="changeStoreName" style="display:none;">
		<ul>
			 <li> 
			 <label> UserName: </label> <input type="text" id="chageStoreName" >
			 </li>
		</ul>
	      </div>
	
	<!--totals Days Name -->
		<div id="change_total_days_box" style="display:none;">
		<ul>
			 <li> 
			 <label> Select Day: </label> 
					 <select id="total_daysName">
					   <option>sunday</option>
					   <option>monday</option>
					   <option>tuesday</option> 
					   <option>wednesday</option>
					   <option>thursday</option>
					   <option>friday</option>
					   <option>saturday</option>
					 </select>
			 </li>
		</ul>
	      </div>	
	
 
	<!--  Change email --->

	<div id="change_Email" style="display:none;">
	   <form>
		<ul>
			 <li> 
	     	 <label> Email: </label> <input type="email" id="emailChange" >
			 </li>
		</ul>
		
	
		<ul>
		</form>
		
	</div>	
	
	
	<div id="change_mobile"  style="display:none;">  
		<ul>
			 <li> 
			 <label> Mobile Number: </label> <input type="text" id="change_mobile_input" >
			 </li>
		</ul>
	</div>

	<div id="change_pass"   style="display:none;">
		<ul>
			 <li> 
			   <label> Current password: </label> <input type="password" id="change_pass_current" >
			 </li>
			  <li> 
			    <label> New password: </label> <input type="password" m="<?php echo '07'.rand(2,55).'.';?>"  id="change_pass_new" >
			 </li>
			 <li> 
			   <label> Confirm new password: </label> <input type="password" id="change_pass_new_conf" >
			 </li>
		</ul>
	</div>
	
	<div id="change_theme"  style="display:none;">
		<ul>  
			 <li> <label> Theme: </label> 
			      <select class=""  id="themeRoller_ui_costom" >
				      <option class="opt" style_src="js/jquery-ui-and-jquery/css/le-frog/jquery-ui-1.10.3.custom.css" >theme1 !</option>
				      <option class="opt" style_src=" js/jquery-ui-and-jquery/css/dot-luv/jquery-ui-1.10.3.custom.css" >theme2</option>
				      <option class="opt" style_src=" js/jquery-ui-and-jquery/css/eggplant/jquery-ui-1.10.3.custom.css">theme3</option>
				      <option class="opt" style_src=" js/jquery-ui-and-jquery/css/flick/jquery-ui-1.10.3.custom.css">theme4</option>
				      <option class="opt" style_src=" js/jquery-ui-and-jquery/css/mint-choc/jquery-ui-1.10.3.custom.css">theme5</option>
					  <option class="opt" style_src=" js/jquery-ui-and-jquery/css/smoothness/jquery-ui-1.10.3.custom.css">theme6</option>
					  <option class="opt" style_src=" js/jquery-ui-and-jquery/css/sunny/jquery-ui-1.10.3.custom.css">theme7 !</option>
					  <option class="opt" style_src=" js/jquery-ui-and-jquery/css/ui-darkness/jquery-ui-1.10.3.custom.css">theme8</option>
                      <option class="opt" style_src="js/jquery-ui-and-jquery/css/dark-hive/jquery-ui-1.10.3.custom.css">theme9 !</option>
                                                     
                      <option class="opt" style_src="js/jquery-ui-and-jquery/css/theme 10/jquery-ui.css">theme10</option>
                      <option class="opt" style_src="js/jquery-ui-and-jquery/css/theme 11/jquery-ui.css">theme11</option>
					  
					   <option class="opt" style_src="js/jquery-ui-and-jquery/css/theme12/jquery-ui.css">theme12</option>
					   
					   
					    <option class="opt" style_src="js/jquery-ui-and-jquery/css/theme13/jquery-ui.css">theme13</option>   
					   
                        <option class="opt" style_src="js1/Delta-jQuery-UI-Theme-master/theme/jquery-ui.css">theme14 !</option>
                       <option class="opt" style_src="js1/Absolution-master/compiled/absolution.css">theme15 !</option>
 
				  </select>
			 </li>
		</ul>
	</div>
	
	
	
	</div>


<span class="toggleCoppyRight" href="#" onclick="$('.coppyRight').toggle();"> || </span>
<div id="containter" class="coppyRight" style="display:; width: 580px; font: bold 15px italic; text-align: center; color: #fff; margin-left: 18%; padding: 10px; background: #000000;border-radius: 7px;-moz-border-radius: 7px;-webkit-border-radius: 7px;box-shadow: 10px 10px 15px #A0A0A0;-moz-box-shadow: 5px 5px 15px #A0A0A0;-webkit-box-shadow: 5px 5px 15px #A0A0A0; /* height: 600px; */ /* overflow-x: auto; */}* {margin: 0px;padding: 0px;list-style-type: none; ;margin-top: 0; margin-bottom : 1;" > <a href="#" style="color: #fff;"> Developed by: Yahye  (+97158-897-6050) </a> </div>

  <img class="trashImageBox" src="images/trash.png" onclick="load_function('trash_main_div','trash','','trash')" style="border:none;cursor: pointer;width: 100px;height: 100px;/* float: right; */margin-left: 90%;     border: 2px solid blue;" />

 </div>
 
 <!-----pring box ----->
 <div class="printerBox">  </div>

<!---hidden elements----->
 
<div  class="hproducts hide"></div>
<div  class="hOcost hide"></div>
<div  class="wOcost hide"></div>



 </body>
</html>
