
<?php
  
 require 'includes/inc_func.php';
 if(if_logged_in() != true){
    session_destroy();
     echo '<script type="text/javascript" > location.href ="login.php";  </script>';
   die();
 } 
  


 

?>



<!doctype html>
<html>
<head>
 
<title> <?php echo mysql_result(mysql_query("SELECT  `company_name` FROM `settings` limit 1"),0); ?>  </title>
<meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="shortcut icon" type="image/png" href="images/fav_icon.png"/>
   
<!--theme --->
 <link   rel="stylesheet" class="themeToggle" href="js/jquery-ui-and-jquery/jquery-ui-1.12.1.custom/jquery-ui.css"   media="screen"  /> 
  <link   rel="stylesheet" class="themeToggle" href="js/jquery-ui-and-jquery/jquery-ui-1.12.1.custom/jquery-ui.structure.css"   media="screen"  /> 
 <link   rel="stylesheet" class="themeToggle" href="js/jquery-ui-and-jquery/jquery-ui-1.12.1.custom/jquery-ui.theme.css"   media="screen"  />  
 
 
 <!---- style ---->
 <link   rel="stylesheet" href="css/select plugin.css"  media="screen" />
 
<link   rel="stylesheet" href="css/style.css" media="screen"   />	
<link     rel="stylesheet" href="css/printStyle.css" media="print"   />


<!----- jquery js ---->
 <script    src="js/jquery-ui-and-jquery/js/jquery-1.9.1.js"  charset="utf-8"  type="text/javascript"></script>
 <script    src="js/jquery-ui-and-jquery/js/jquery-ui-1.10.3.custom.min.js" charset="utf-8"  type="text/javascript"></script>
 
 <!---DataTable js----->
 <script    src="js/DataTables-1.9.4/media/js/jquery.dataTables.js"  charset="utf-8" type="text/javascript"></script>
 <!----chosen plugin js-->
 <script    src="js/chosen.jquery.js"  charset="utf-8" ></script>


 <script    src="js/ganaral.js"  charset="utf-8" ></script>

<!----embeded js---->
  <script   type="text/javascript"  charset="utf-8" >

<?php

$cars_colmns = 'car_id,car_name,price';
$cars_theed = '<th> Car </th> <th> price </th> <th> Last Rented </th><th> more </th> <th> Action </th>'; // status e.g: availble = green color or rented by <a> customer name link </a>  , Last Rented e.g : <td>Date</td>
$cars = array(
		'status' => 'cars',	
	 	'available_cars_count' =>  number_format(mysql_result(mysql_query("SELECT count(`car_id`) FROM `cars` WHERE `status`='available' and `delete_status`!=1"), 0)),

	// all cars
 		'table_all_cars' => 'cars',
		'where_query_all_cars' => "",
		'primary_key_all_cars' => 'car_id',
		'colmns_all_cars' => $cars_colmns,
		'thead_all_cars' => $cars_theed,

	// available cars
 		'table_available' => 'cars',
		'where_query_available' => "status='available'",
		'primary_key_available' => 'car_id',
		'colmns_available' => $cars_colmns,
		'thead_available' => $cars_theed,


	);



$Customers = array(
	'table_type' => 'customers',
	'table' => 'customers',
	'where_query' => '',
	'primary_key' => 'customer_id',
	'colmns' => 'customer_id,customer_name,mobile,email',
	'thead' => '<th>Name </th><th>Balance</th><th>mobile</th> <th>email</th><th>more</th><th>Action</th>',
);

$rent_theed = '<th> name </th><th> car </th> <th> Rented Date </th> <th> price </th> <th> Paid </th> <th> Balance </th> '.get_dueDate_th('','').' <th> more </th> <th> Action </th> ';	
$rent_colmns = 'id, customer_id, car_name, from , price, paid, balance, due_date';


$rented = array(
		'table_type' => 'customers',
	 	'table' => 'rented_cars',
		'where_query' => "",
		'primary_key' => 'id',
		'colmns' => $rent_colmns,
		'thead' => $rent_theed
);

$Debts = array(
	'table_type' => 'customers',
	'table' => 'rented_cars',
	'where_query' => 'balance!=0',
	'primary_key' => 'id',
	'colmns' => $rent_colmns,
	'thead' => $rent_theed
);


 
 
$current_date = date('Y-m-d');
$over_due = array(
	'overDue_count_all' => number_format(mysql_result(mysql_query(" SELECT count(id) FROM `rented_cars` WHERE balance!=0 and `due_date`!='0000-00-00' and `due_date`<='$current_date' and `delete_status`!=1 "), 0)),
	'table_type' => 'customers',

	'table' => 'rented_cars',
	'where_query' => "balance!=0 AND `due_date`!='0000-00-00' AND due_date<='$current_date'",
	'primary_key' => 'id',
	'colmns' => $rent_colmns,
	'thead' => $rent_theed
);




$income = array(
				'status' => 'income',
				'table' => 'payments',
				'where_query' => "",
				'primary_key' => 'id',
				'colmns' => 'id, paid, customer_id, car_name, date, description',
				'thead' => '<th>Paid</th><th>Name</th><th>Car</th><th>Date</th><th>Description</th><th>Action</th>'
);








$expense = array(
	'status' => 'expense',
	'table' => 'expense',
	'where_query' => "",
	'primary_key' => 'id',
	'colmns' => 'id, expense_name, quantity, cost , car_name, date',
	'thead' => '<th>Name</th><th>Quantity</th><th>Cost</th><th>Car</th><th>Date</th> <th>Action</th>'
);



	 
// settings 
$settings = array(
		'status' => 'settings',
		'username' => mysql_result(mysql_query("select username from settings limit 1"),0),
	 	'password' => '*******',
		'companyName' =>  mysql_result(mysql_query("select company_name from settings limit 1"),0),
		'companyMobile' =>  mysql_result(mysql_query("select company_mobile from settings limit 1"),0),
		'companyAddress' =>  mysql_result(mysql_query("select company_address from settings limit 1"),0),
		'companyEmail' =>  mysql_result(mysql_query("select company_email from settings limit 1"),0),
		 
);


?>

cars = <?php echo json_encode($cars);?>;
all_customers =   <?php echo json_encode($Customers);?>;
all_debts =   <?php echo json_encode($Debts);?>;
debts_over_due =   <?php echo json_encode($over_due);?>;
all_income =   <?php echo json_encode($income);?>;
all_expense =   <?php echo json_encode($expense);?>;
all_rented =   <?php echo json_encode($rented);?>;
settings =   <?php echo json_encode($settings);?>;

current_date =  <?php echo json_encode($current_date);?>;



chosen_per = '';

function get_to_date(number){
			if(!empty($('#rent_from_date').val()) && !empty(number) && !empty(chosen_per)){
				submit_states = 'on';
				$.post('php_f/get_to_date.php',{from_date:$('#rent_from_date').val(),number:number,chosen_per:chosen_per},function(feedback){
					submit_states = 'off';
					$('#rent_to_date').fadeOut().val($.trim(feedback)).attr('tt',feedback).fadeIn();
				});
			}
}

	function calc_func(){

		// rent from price caclution 

		$('#per_number,#rent_price,#rent_paid,#car_price_add').keyup(function(){


			if($(this).attr('id') == 'car_price_add'){
				$('#rent_price').attr('o_price',$(this).val());
				o = Number($('#rent_price').attr('o_price'));
				q = Number($('#per_number').val());
				a = (q == '0')?$(this).val():o * q;
				$('#rent_price').val(a);		
			}

			if($(this).attr('id') == 'per_number'){
				o = Number($('#rent_price').attr('o_price'));
				q = Number($(this).val());
				a = (q == '0')?$('#rent_price').val():o * q;
				$('#rent_price').val(a);
			}

			culc_func();
		});
		$('#per_number,#rent_price,#rent_paid,#car_price_add').change(function(){
			if($(this).attr('id') == 'car_price_add'){
				$('#rent_price').attr('o_price',$(this).val());
				o = Number($('#rent_price').attr('o_price'));
				q = Number($('#per_number').val());
				a = (q == '0')?$(this).val():o * q;
				$('#rent_price').val(a);	
			}

			if($(this).attr('id') == 'per_number'){
				o = Number($('#rent_price').attr('o_price'));
				q = Number($(this).val());
				a = (q == '0')?$('#rent_price').val():o * q;
				$('#rent_price').val(a);
			}
			
			culc_func();
		});

	}
$('document').ready(function (){


	$('#per_number').keyup(function(){
			get_to_date($(this).val());
		});
	 
	$('#per_number').change(function(){
			get_to_date($(this).val());
		});
	 

	$('#rent_from_date,#rent_to_date').change(function(){
		cal_date($('#rent_from_date').val(),$('#rent_to_date').val());
	});

   // my own datepicker for safari
   if($('[type="date"]').prop('type') != 'date' ) {
		$('#rent_from_date,#rent_to_date,#payment_date,#x_date').datepicker({dateFormat:"mm/dd/yy"}).attr('placeholder','mm/dd/yyyy').attr('readonly','readonly');
		$('#due_date_rent').datepicker({dateFormat:"mm/dd/yy"}).attr('readonly','readonly').attr('placeholder','mm/dd/yyyy')
	}

	$('.car_price select').chosen();
	$('.car_price .chzn-search input').remove();
	$('.chzn-container').css('width','auto'); 
	$('div#main_tabs').tabs();
	$('div#main_tabs .ui-tabs-nav li a:first').click(); // auto click first tab

	// submit when enter button is pressed 
	$('input').keyup(function(e){
			if(e.keyCode == 13 ){
				// auto click closest submit btn
				$('.submit_btn:visible').click();
			}
	});





calc_func();

 
});

function empty(value){
	if($.trim(value) == ''){
		return true;
	}else{
		return false;
	}
}

function is_digit(value){
	if($.trim(value) == 'NaN'){
		return false;
	}else{
		return true;
	}
}

 function get_avaible_cars_count(){
	/*	$.post('php_f/available_cars_count.php',function(feedback){
 				cars_available = feedback;
				$('.available_cars_badget').html($.trim(feedback)).fadeIn();
			});	*/
		}
// seccess func
function success_fun(msg){
	if(is_digit(parseInt(cars_available)) && $.trim(cars_available) !='0'){
			 get_avaible_cars_count();
	}
		get_cars();
		get_customers();
		get_x_cars();
		success_fun_(msg);
		reload_data_tables();
      get_car_details();
 
		$('#success').delay('3000').fadeOut();

}


//outer htmml
jQuery.fn.outerHTML = function() {
return jQuery('<div />').append(this.eq(0).clone()).html();
};



// comma format function 
function CommaFormattedN(amount) {
   var i = parseFloat(Math.round(amount * 100) / 100).toFixed(2);
   if($.trim(i) == '') { return ''; }
   if($.trim(i) == 'NaN') { return ''; }

  filter_ = /\./; 
  if(filter_.test(i)){

  }

 amount = i.replace(/./g, function(c, i, a) {
               return i && c !== "." && ((a.length - i) % 3 === 0) ? ',' + c : c;
			});
  
    return amount;
}

function day_convert(name){
	chosen_per = name;
	if(name == 'Weekly'){
		return 'weeks';
	}else if(name == 'Monthly'){
		return 'months';
	}else if(name == 'Yearly'){
		return 'years';
	}else if(name == 'Daily'){
		return 'days';
	}


}

// select car or customer
current_selected_car = '';
current_selected_customer = '';
function car_or_customer_changed(da,value){
		da = JSON.parse(da);
		if(da.status == 'customer'){ // customers select
			if($.trim(value) == 'Add'){
				$('input#customer_name').show(); 
			    current_selected_customer = '';
			}else{
				$('input#customer_name').hide(); 
				current_selected_customer = da;
			}
			$('#rent_mobile').val(current_selected_customer.customer_mobile);
		}else{ // cars
			if($.trim(value) == 'Add'){
				$('div.add_car_auto').show(); 
			    current_selected_car = '';
			    $('#rent_price').attr('o_price',$('#car_price_add').val()).val($('#car_price_add').val());
			    $('#per_weeks').html(day_convert($('#car_price_type_add').val()));
			}else{
				$('div.add_car_auto').hide(); 
				current_selected_car = da;
				$('#rent_price').attr('o_price',current_selected_car.price).val(current_selected_car.price);
				$('#per_weeks').html(day_convert(current_selected_car.price_type));
			}

			culc_func();
			cal_date($('#rent_from_date').val(),$('#rent_to_date').val());
		}	
}

// refresh dataTables when changes is made 
function reload_data_tables(){
			$('#view_container div[aria-expanded="true"] th.ui-state-default:first').click();
			$('#view_container th.ui-state-default:first').click();
}

current_all_customers = '';
current_all_cars = '';
function apply_chosen(type,car_name_chosen){
	if($.trim(type) == 'customers'){
				$('td.customers_names').html(current_all_customers);
				$('td.customers_names select, select#car_price_type_add').chosen({search_contains: true });
				$('td.customers_names .chzn-search input').attr('placeholder','name or mobile');
	}else if($.trim(type) == 'cars'){
			$('td.cars_names').html(current_all_cars);
			$('td.cars_names select:first option').each(function (){
					data = JSON.parse($(this).attr('da'));
					if($.trim(car_name_chosen) == data.car_name){
						$(this).attr('selected','selected');
						car_or_customer_changed($(this).attr('da'),'');

					}else{
						$(this).removeAttr('selected');
					}
			});

			$('td.cars_names select').chosen({search_contains: true });
			$('td.cars_names .chzn-search input').attr('placeholder','car or car price');
			$('td.cars_names .chzn-search:last input').remove();
			$('div#car_price_type_add_chzn').removeAttr('style'); 

			$('#car_price_type_add').change(function(){
				$('#per_weeks').html(day_convert($(this).val()));
					cal_date($('#rent_from_date').val(),$('#rent_to_date').val());
			});	
			calc_func();
	}
	calc_func();
}	

// get customer names
function get_customers(){
		$.post('php_f/get_customers.php',function(feedback){
				if($.trim(feedback) == 'login'){location.reload();}else{
					current_all_customers = feedback;
					apply_chosen('customers');
				}
		});
}
get_customers();



// get cars
function get_cars(){
		$.post('php_f/get_cars.php',function(feedback){
				if($.trim(feedback) == 'login'){location.reload();}else{
						current_all_cars = feedback;
						apply_chosen('cars');
				}				
		});
}
get_cars();

// get cars
function get_x_cars(){
		$.post('php_f/get_x_cars.php',function(feedback){
							if($.trim(feedback) == 'login'){location.reload();}else{
									feedback = JSON.parse(feedback);
										$('td.x_car_name').html(feedback.select);
										$('td.x_car_name select').next('option')
										$('td.x_car_name select').chosen({search_contains: true });
										$('.x_car_name .chzn-container').css('width','200px'); 
										$('td.x_car_name div#x_car_name__chzn').nextAll('option').remove();
										$('#x_date').val(feedback.x_date) 
									}
			});
}
get_x_cars();



function close_div(elem){
	$(elem+', #error').fadeOut();
}


  </script>
 



<!---external js--->

 <script    src="js/index.js"  charset="utf-8" ></script>
 <script    src="js/forms.js"  charset="utf-8" ></script>

 </head>
<body>

 
	<div class="page_wrapper">
 
	 

		<div id="main_tabs">
                    <ul>
                    	<?php 
                    	if($over_due['overDue_count_all'] != '0'){
							// show dueDates
							echo '<li><a href="#view_container" onclick="data_table_creator(debts_over_due)">Over-due <span class="badge">'.number_format($over_due['overDue_count_all']).'</a></li>';
							}
						?>
                        <li><a href="#view_container" onclick="data_table_creator(all_customers)">Customers</a></li>
                        <li><a href="#view_container" onclick="data_table_creator(cars)">Cars</a></li>
                        <li><a href="#view_container"  onclick="data_table_creator(all_debts)">Debts</a></li>
                        <li><a href="#view_container"  onclick="data_table_creator(all_income)">Income</a></li>
                        <li><a href="#view_container"  onclick="data_table_creator(all_expense)">Expense</a></li>
                        <li><a href="#view_container"  onclick="data_table_creator(all_rented)">Rented cars</a></li>
                        <li><a href="#view_container"  onclick="data_table_creator(settings)">Settings</a></li>


 


						<a href="#" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="Loguut()" role="button" aria-disabled="false" style="float: right;"><span class="ui-button-icon-primary ui-icon"></span><span class="ui-button-text">Logout</span></a>  
 
			  
                    </ul>





<!---feedbacks ---->
<div id="warning" style="display: none;"></div>
<div id="error" title="Error" style="display:none;" ></div>
<div id="success" title="Success" style="display:none;" ></div>
<div class="horizantal_loading" style="display:none;" ></div>



<!-- make payment form--->
<div class=" dashboard_panel form_div" id="payment_form" style="display:none;width: 60%;">
 <table class="table"><tbody><tr><th id="payment_title" style="
    font-size: 16px;
    color: #bb60d6;
    text-align: center;
"></th> </tr> </tbody></table>
	 <table class="table"><tbody>
        
	 	<tr><th>Current Debt:</th> <td> <?php echo $us_; ?><b class="redBalance current_debt">900.00</b> <?php echo $ksh; ?></td> </tr>
	 	<tr><th>Paid</th> <td>  <?php echo $us_; ?><input type="number" autofocus="autofocus" id="paid_amount" debt=""><?php echo $ksh; ?></td>
	 </tr>
	<tr><th>Payment Date</th> <td> <input type="date" id="payment_date" ></td>
	 </tr>
	<tr> <th> Description  </th> <td> <textarea id="description" placeholder="Description is optional"  style="border: 2px groove;border-radius: 0.5em;"> </textarea> </td> </tr>
	</tbody></table>
     <input type="hidden" id="crf_code">

	<pre><a href="#" class="submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="make_payment('')" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon"></span><span class="ui-button-text">Submit</span></a>  <a href="#" class="  change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="close_div('#payment_form')" role="button" aria-disabled="false" style="
    margin-left: 32px;
"><span class="ui-button-icon-primary ui-icon"></span><span class="ui-button-text">Close</span></a>  </pre>
</div>


<!--edit settings form--->
<div class=" hidden_form dashboard_panel form_div" id="edit_settings">
	
	 <table class="table text" width="100%"><tbody><tr> 
		<th><b id="settings_editing_name"></b></th> <td> <input type="text" autofocus="autofocus" id="edit_setting_value">  
					<select class="currency"> <option>Ksh</option><option>$</option> </select>

			</td>
	 </tr></tbody></table>
     <input type="hidden" id="crf_code" >

	<pre><a href="#" id="submit_settings" class="submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="edit_settings('','','submit')" role="button" aria-disabled="false" ><span class="ui-button-icon-primary ui-icon"></span><span class="ui-button-text">Submit</span></a>  <a href="#" id="submit_settings" class="  change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="close_div('#edit_settings')" role="button" aria-disabled="false" style="
    margin-left: 32px;
"><span class="ui-button-icon-primary ui-icon"></span><span class="ui-button-text">Close</span></a>  </pre>
</div>


<!---change password form --->
<div class=" hidden_form dashboard_panel form_div" id="change_password_form">
	 <table class="table pass_change" width="100%"><tbody>
	 	<tr><th>Current password</th> <td> <input autofocus="autofocus" type="password" id="current_password"> </td></tr>
	 	<tr><th>New password</th> <td> <input type="password" id="new_password"> </td></tr>
	 	<tr><th>confirm password</th> <td> <input type="password" id="confirm_password"> </td></tr>	
	 	</tbody></table>
    <input type="hidden" id="crf_code" >
	<pre><a href="#" id="submit_settings" class="submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="edit_settings('','','submit')" role="button" aria-disabled="false" ><span class="ui-button-icon-primary ui-icon"></span><span class="ui-button-text">submit</span></a>   <a href="#" id="submit_settings" class="  change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="close_div('#change_password_form')" role="button" aria-disabled="false" style="
    margin-left: 32px;
"><span class="ui-button-icon-primary ui-icon"></span><span class="ui-button-text">Close</span></a>  </pre> 
</div>



<!--- edit customer  --->
<div class=" hidden_form dashboard_panel form_div" id="change_password_form">
	 <table class="table pass_change" width="100%"><tbody>
	 	<tr><th>Current password</th> <td> <input type="password" id="current_password"> </td></tr>
	 	<tr><th>New password</th> <td> <input type="password" id="new_password"> </td></tr>
	 	<tr><th>confirm password</th> <td> <input type="password" id="confirm_password"> </td></tr>	
	 	</tbody></table>
    <input type="hidden" id="crf_code" >
	<a href="#" id="submit_settings" class="submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="edit_settings('','','submit')" role="button" aria-disabled="false" ><span class="ui-button-icon-primary ui-icon"></span><span class="ui-button-text">submit</span></a>
</div>



<!--- add or edit expense --->
<div  style="display:;width: 76%; display:none;" class='form_div dashboard_panel' id="add_expense">  
	<table class="table"> 
		<tr><th>Expense name</th><th>Quantity</th><th>Cost</th><th>Car name</th></tr>
		<tr><td><input type="text" id="x_name"  autofocus="autofocus"> </td>
				<td><input type="number" id="x_quantity" > </td>
				<td> <?php echo $us_; ?><input type="number" id="x_cost"> <?php echo $ksh; ?> </td>

				<td class="x_car_name"> </td></tr></table>
	<table class="table"> <tr><th>Date</th><td><input type="date" id="x_date"   > </td></tr> </table>

		<pre class="from-btns"><a href="#" id="submit_cust" class="submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="add_expense({status:'submit'})" role="button" aria-disabled="false" ><span class="ui-button-icon-primary ui-icon"></span><span class="ui-button-text">submit</span></a>  <a href="#" id="submit_settings" class="  change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="close_div('#add_expense')" role="button" aria-disabled="false" style="
    margin-left: 32px;
"><span class="ui-button-icon-primary ui-icon"></span><span class="ui-button-text">Close</span></a> </pre>
</div>





<!--- edit customer  --->
<div  style="display:;width: 60%; display:none;" class='form_div dashboard_panel' id="edit_customer_info">  
	<table class="table"> 
		<tr><th>Name</th><th>Mobile <span class="optional_element"> (optional) </span></th><th>email <span class="optional_element"> (optional) </span></th></tr>
		<tr><td><input type="text" id="cust_name"  autofocus="autofocus"> </td>
				<td><input type="number" id="cust_mobile" > </td>
<td><input type="email" id="cust_email" > </td></tr></table>

		<pre class="from-btns"><a href="#" id="submit_cust" class="submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="edit_customer({status:'submit'})" role="button" aria-disabled="false" ><span class="ui-button-icon-primary ui-icon"></span><span class="ui-button-text">submit</span></a>  <a href="#" id="submit_settings" class="  change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="close_div('#edit_customer_info')" role="button" aria-disabled="false" style="
    margin-left: 32px;
"><span class="ui-button-icon-primary ui-icon"></span><span class="ui-button-text">Close</span></a> </pre>
</div>



<!--- add car or edit car --->
<div  style="display:;width: 60%; display:none;" class='form_div dashboard_panel add_car_new' id="add_car_new">  
	<table class="table"> 
		<tr><th>Car</th></tr>
		<tr><td>  <input type="text" id="car_name_new"  autofocus="autofocus" placeholder='car name ' > 
 <?php echo $us_; ?>  <input placeholder="set price " type='number' id="car_price_new" class="digit_size"> <?php echo $ksh; ?>    
							
						<b class="car_price">	<select id='car_price_type_new'>
								<option>per...</option>
								<option>Daily</option>
								<option>Weekly</option>
								<option>Monthly</option>
								<option>Yearly</option>
							</select></b> </td></tr>
	</table>

		<pre class="from-btns"><a href="#" id="submit_settings" class="submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="add_car({status:'submit'})" role="button" aria-disabled="false" ><span class="ui-button-icon-primary ui-icon"></span><span class="ui-button-text">submit</span></a>  <a href="#" id="submit_settings" class="  change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="close_div('.add_car_new')" role="button" aria-disabled="false" style="
    margin-left: 32px;
"><span class="ui-button-icon-primary ui-icon"></span><span class="ui-button-text">Close</span></a> </pre>
</div>



<div class=" hidden_form dashboard_panel form_div" id="change_password_form">
	 <table class="table pass_change" width="100%"><tbody>
	 	<tr><th>Current password</th> <td> <input type="password" id="current_password"> </td></tr>
	 	<tr><th>New password</th> <td> <input type="password" id="new_password"> </td></tr>
	 	<tr><th>confirm password</th> <td> <input type="password" id="confirm_password"> </td></tr>	
	 	</tbody></table>
    <input type="hidden" id="crf_code" >
	<a href="#" id="submit_settings" class="submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="edit_settings('','','submit')" role="button" aria-disabled="false" ><span class="ui-button-icon-primary ui-icon"></span><span class="ui-button-text">submit</span></a>
</div>



<!---rent car form --->
<!--
name , car , rent date 				, price, paid,balace,due-date,mobile
			from ..  to .. [1] week, 
--->

 <div id="rent_car_form" style="width: 93%; display:none;" class="dashboard_panel form_div">
	 <table class="table display" width="100%" style="
    /* margin: 8px; */
 
    margin-left: 0px;
    margin-bottom: 10px;
"> <thead><tr> <th>Name</th> <th>Car</th>   </tr></thead>
	 	<tbody><tr><td  class="customers_names" style="
    width: 30%;
"> 
	 		<input type="text" autofocus="autofocus" id="customer_name"> 
	 		<select id="customer_name"><option></option></select>


	 	</td> 
	 	  <td class="cars_names">       
	 				 </td>
 </tr></tbody></table>

 <table class="table" style="
    /* margin: 1px; */
    margin-left: 0px;
    margin-bottom: 10px;
	">
	 	<tr> <th>Rent Date </th> <td style="width: auto;"><pre> <strong>From:</strong> <input   type="date" id="rent_from_date"> <strong>To:</strong> <input type="date"  id="rent_to_date">, <input type="number" id="per_number" style="width: 60px"> <span id="per_weeks" style="
    font-style: italic;
    font-size: 15;
"></span> </pre></td>  </tr> </tbody></table>


<table class="table" style="
  
    /* margin: 1px; */
    margin-left: 0px;
    margin-bottom: 10px;
"> <tbody><tr> <th>Price</th><td> <pre> <?php echo $us_;?><input type="number" id="rent_price" class=""> <?php echo $ksh;?> </pre> </td> <th>Paid</th> 	<td>  <?php echo $us_;?><input type="number" id="rent_paid" class=""> <?php echo $ksh;?> </td>
			 	 	<th>Balance</th> <td> <?php echo $us_;?><b id="rent_balace" class="redBalance"> </b><?php echo $ksh;?></td> 
	 	 	 </tr></tbody></table> 

	 	 	<table class="table display" style="
    /* margin: 1px; */
    margin-left: 0px;
    margin-bottom: 10px;
	">  
		 	 	<tbody><tr>
		 	 		
 <th>Due-date <span class="optional_element"> (optional) </span></th><td><input type="date"  id="due_date_rent"> </td>
		 	 	<th>Mobile <span class="optional_element"> (optional) </span></th><td><input type="number" placeholder="optional" id="rent_mobile"> </td>

		 	 	</tr>
			</tbody></table>
	 		
	 		<a href="#"  id="submit_rent" class="submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="add_('submit')" role="button" aria-disabled="false" ><span class="ui-button-icon-primary ui-icon"></span><span class="ui-button-text">submit</span></a>

	 <a href="#" id="submit_settings" class="  change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="close_div('#rent_car_form')" role="button" aria-disabled="false" style="
    margin-left: 32px;
"><span class="ui-button-icon-primary ui-icon"></span><span class="ui-button-text">Close</span></a>

</div>



 
                    <div id="view_container"> 
 </div>


<p id="contact_us" class="dashboard_panel" style="/* background: black; */width: 300px;margin-left: 34%;font:italic 14px arial;text-align:center;">  <i> whatsapp </i><img src="images/what.png" style="width: 32px;height: 20px;border:none;margin-left: 1px;"> +25290-6564-472 
</br>
<b>  or call +252-613731-436 </b>  </p>

        </div>
	</div>



 <script   type="text/javascript"  charset="utf-8" >   

$('document').ready(function (){

});


  </script>


<div id="warning" style="display: none;"></div>

</body>
</html>
