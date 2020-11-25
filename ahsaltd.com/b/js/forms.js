
crf_code = '';
function get_crf_code(){
	$.post('php_f/get_crf_code.php',function(new_crf){
		new_crf = JSON.parse(new_crf);
		crf_code = new_crf.crf_code;
		current_date = new_crf.date;
	});	
}


submit_states = '';
function edit_settings(value,colmn,sql_colmn){

	// validate then submit 
	if($.trim(sql_colmn) == 'submit'){ 
		
				if(submit_states !='on'){ // don't overload the loading 

				if($('#change_password_form').is(':visible')){
						currentPass = $('#current_password').val();
						newPass = $('#new_password').val();
						confirmPass = $('#confirm_password').val();
						if($.trim(newPass) != $.trim(confirmPass)){
							error_func('New passwords did not match !');
							$('#confirm_password,#new_password').css('border','1px solid red');
						}else{
						
							submit_states = 'on';
							loading_fun('',20);
							$.post('php_f/change_password.php',{crf_code:crf_code,currentPass:currentPass,newPass:newPass},function(feedback){
								submit_states = 'off'; 
								

									i = setInterval(function(){ 
											if($('.horizantal_loading').attr('current_size') == '80'){
												 // finsh the loading 
												 loading_fun($('.horizantal_loading').attr('current_size'),13);
												 clearInterval(i);
											 }							
									},500); // finish the loading

								if($.trim(feedback) == 'login'){location.reload();}
								if($.trim(feedback) == '1'){
									// success
									$('#change_password_form').fadeOut();
									data_table_creator(settings)
									success_fun('password successfully changed !');

								}else{
									error_func(feedback);
									// display feadback
								}
							});
						}

						
				}else{

					if($('select.currency').is(':visible')){
						edit_value = $('select.currency').val();
						sql_colmn = 'currency';
					}else{
						edit_value = $('#edit_setting_value').val();
						sql_colmn = $('#settings_editing_name').attr('sql_colmn');
					}
						colmn_name = $('#settings_editing_name').html();


						if($.trim(edit_value) == ''){
							//error empty field
							$('#edit_setting_value').css('border','1px solid red');
							error_func(colmn_name+' is empty');
						}else{
							 loading_fun('',15); 
							$.post('php_f/edit_settings.php',{crf_code:crf_code,edit_value:edit_value,sql_colmn:sql_colmn},function(feedback){
								submit_states = 'off'; 

									i = setInterval(function(){ 
											if($('.horizantal_loading').attr('current_size') == '80'){
												 // finsh the loading 
												 loading_fun($('.horizantal_loading').attr('current_size'),13);
												 clearInterval(i);
											 }							
									},500); // finish the loading
								
								if($.trim(feedback) == 'login'){location.reload();}
								if($.trim(feedback) == '1'){
									$('#edit_settings').fadeOut();
									// success
									data_table_creator(settings);
									success_fun('<strong>'+colmn_name+'</strong> Successfully Changed !');
									if($('select.currency').is(':visible')){location.reload();}
								}else{
									error_func(feedback);
									// display feadback
								}
							});
						}
				}

		}	
	}else{
		// get crf 
		get_crf_code();
		// form ready 

		$('#hidden_form').hide(); 
		if($.trim(colmn) == 'password'){
			$('#pass_change input').attr('style','').val('');
			$('#change_password_form').fadeIn();
			window.location.href='#change_password_form';
		}else if($.trim(colmn) == 'currency'){
			$('#edit_settings .text input').hide();
			$('#edit_settings .text select.currency').show();
			$('#settings_editing_name').html('currency');
			$('#edit_settings').fadeIn();
			window.location.href='#edit_settings';
		}else{
			$('#edit_settings .text select.currency').hide();
			$('#edit_settings .text input').attr('style','').val(value);
			$('#settings_editing_name').html(colmn).attr('sql_colmn',sql_colmn);
			$('#edit_settings').fadeIn();
			window.location.href='#edit_settings';
		}

	}
}




// add or edit car 
submit_states_x = '';
x_id = '';
function add_expense(data){
		if(data.status == 'add'){
			// reset the form
			get_crf_code();
			$('#x_name,#x_quantity, #x_cost').val('').removeAttr('style');
			$('#add_expense').fadeIn();
			$('#x_date').val(current_date);
			window.location.href='#add_expense';
		}else if(data.status == 'edit'){
			// reset the form
			// onclick="add_expense({"expense_name":"che","quantity":"10","cost":"1000","car_name":"Others","date":"2018-09-17 00:00:00","tableName":"expense","customer_id":"1","status":"edit"})"
			get_crf_code();
			x_id = data.x_id;
			$('#x_name,#x_quantity, #x_cost').removeAttr('style');
			$('#x_name').val(data.expense_name);
			$('#x_quantity').val(data.quantity);
			$('#x_cost').val(data.cost);
			$('#x_date').val((!empty(data.date))?data.date:$('#x_date').val());

			$('.x_car_name select').removeClass('chzn-done');
			$('.x_car_name div').remove();
			$('.x_car_name select option').each(function(){
						if($.trim($(this).val()) == data.car_name){
							$(this).attr('selected','selected');
							$('td.x_car_name select').chosen({search_contains: true });
							$('.x_car_name .chzn-container').css('width','200px'); 
							$('td.x_car_name div#x_car_name__chzn').nextAll('option').remove();
						}else{
							$(this).removeAttr('selected');
						}
			});
			$('#add_expense').fadeIn();
			window.location.href='#add_expense';
		}else{
			// submit 
			if(submit_states_x !='on'){

						x_name = $('#x_name').val();
						x_quantity = $('#x_quantity').val();
						x_cost = $('#x_cost').val();
						x_car_name = $('#x_car_name_').val();
						x_date = $('#x_date').val();

						if(empty(x_name)){
							$('#x_name').css('border','1px solid red');
							error_func('expense name is required !');
						}else if(empty(x_quantity)){
							$('#x_quantity').css('border','1px solid red');
							error_func('quantity is required !');
						}else if(empty(x_cost)){
							$('#x_cost').css('border','1px solid red');
							error_func('cost is required !');
						}else{

							submit_states_x = 'on';
							loading_fun('',20);
							$.post('php_f/'+((empty(x_id))?'add_expense.php':'edit_expense.php'),{x_id:x_id,crf_code:crf_code,x_name:x_name,x_quantity:x_quantity,x_cost:x_cost,x_car_name:x_car_name,x_date:x_date },function(feedback){
								submit_states_x = 'off'; 
							 	i = setInterval(function(){ 
											if($('.horizantal_loading').attr('current_size') == '80'){
												 // finsh the loading 
												 loading_fun($('.horizantal_loading').attr('current_size'),13);
												 clearInterval(i);
											 }		
											 console.log('goin..');					
									},500); // finish the loading 
								 if($.trim(feedback) == 'login'){location.reload();}
								if($.trim(feedback) == '1'){
									// success
									 reload_data_tables();
									$('#add_expense').fadeOut();
									success_fun(' successfully !');
								}else{
									error_func(feedback);
									// display feadback
								}
							});
						}

			}
		}
		
}





// add or edit car 
submit_states_cars = '';
car_id_edit = '';
function add_car(data){
		if(data.status == 'add'){
			// reset the form
			get_crf_code();
			$('.add_car_new table input').val('').removeAttr('style');
			$('.add_car_new').fadeIn();
			$('.chzn-container').css('width','auto'); 
			window.location.href='#add_car_new';	
		}else if(data.status == 'edit'){
			// reset the form
			get_crf_code();
			car_id_edit = data.car_id;
			$('#add_car_new table input').removeAttr('style');
			$('#car_name_new').val(data.car_name);
			$('#car_price_new').val(data.price.replace(/\,/g,''));
			$('.car_price select').removeClass('chzn-done');
			$('.car_price div').remove();
			$('.car_price select option').each(function(){
						if($.trim($(this).val()) == data.price_type){
							$(this).attr('selected','selected');
							$('.car_price select').chosen();
						    $('.car_price .chzn-search input').remove();
						 	$('.chzn-container').css('width','auto'); 
						}else{
							$(this).removeAttr('selected');
						}
			});
			$('.add_car_new').fadeIn();
			window.location.href='#add_car_new';
		}else{
			// submit 
			if(submit_states_cars !='on'){

						car_name_new = $('#car_name_new').val();
						car_price_new = $('#car_price_new').val();
						car_price_type = $('#car_price_type_new').val();

						if(empty(car_name_new)){
							$('#car_name_new').css('border','1px solid red');
							error_func('car is empty !');
						}else if(empty(car_price_new)){
							$('#car_price_new').css('border','1px solid red');
							error_func('car price is empty !');
						}else if($.trim(car_price_type) == 'per...'){
							$('.car_price').css('border','1px solid red');
							error_func('choose per daily/weekly/monthly/yearly !');
						}else{

							submit_states_cars = 'on';
							loading_fun('',20);
							$.post('php_f/'+((empty(car_id_edit))?'add_car.php':'edit_car.php'),{car_id:car_id_edit,crf_code:crf_code,car_name_new:car_name_new,car_price_new:car_price_new,car_price_type:car_price_type},function(feedback){
								submit_states_cars = 'off'; 
							 	i = setInterval(function(){ 
											if($('.horizantal_loading').attr('current_size') == '80'){
												 // finsh the loading 
												 loading_fun($('.horizantal_loading').attr('current_size'),13);
												 clearInterval(i);
											 }				
									},500); // finish the loading 
								 if($.trim(feedback) == 'login'){location.reload();}
								if($.trim(feedback) == '1'){
									// success
								 	reload_data_tables();
									$('.add_car_new').fadeOut();
									 get_avaible_cars_count();
									success_fun(' successfully !');
								}else{
									error_func(feedback);
									// display feadback
								}
							});
						}

			}
		}
		
}




// edit customer info
submit_states_cust_info = '';
cust_id = '';
function edit_customer(data){
		 if(data.status == 'edit'){
			// reset the form
			get_crf_code();
			cust_id = data.customer_id;
			$('#edit_customer_info table input').removeAttr('style');
			$('#cust_name').val(data.customer_name);
			$('#cust_mobile').val(data.mobile);
			$('#cust_email').val(data.email);
			$('#edit_customer_info').fadeIn();
			window.location.href='#edit_customer_info';
		}else{
			// submit 
			if(submit_states_cust_info !='on'){

						cust_name = $('#cust_name').val();
						cust_mobile = $('#cust_mobile').val();
						cust_email = $('#cust_email').val();

						if(empty(cust_name)){
							$('#cust_name').css('border','1px solid red');
							error_func('customer name is required !');
						}else{

							submit_states_cust_info = 'on';
							loading_fun('',20);
							$.post('php_f/edit_customer.php',{cust_id:cust_id,crf_code:crf_code,cust_name:cust_name,cust_mobile:cust_mobile,cust_email:cust_email},function(feedback){
								submit_states_cust_info = 'off'; 
							 		i = setInterval(function(){ 
											if($('.horizantal_loading').attr('current_size') == '80'){
												 // finsh the loading 
												 loading_fun($('.horizantal_loading').attr('current_size'),13);
												 clearInterval(i);
											 }		
											 console.log('goin..');					
									},500); // finish the loading  
								if($.trim(feedback) == 'login'){location.reload();}
								if($.trim(feedback) == '1'){
									// success
									 reload_data_tables();
									$('#edit_customer_info').fadeOut();
									success_fun(' successfully !');
								}else{
									error_func(feedback);
									// display feadback
								}
							});
						}

			}
		}
		
}



 

// make payment 
customer_id = '';
current_debt = '';
submit_states_payment = '';
function make_payment(data){

	if(data.status == 'ready'){
				// reset the form
				get_crf_code();
				$('#payment_form table input').removeAttr('style').val('');
				$('#payment_title').html('Paying '+data.title+'\'s debt.');
				$('.current_debt').html(CommaFormattedN(data.current_debt));
				$('#payment_date').val(data.current_date); 
				$('#paid_amount').attr('debt',data.current_debt);
				$('#payment_form').fadeIn();
				current_debt = data.current_debt;
				customer_id = data.customer_id;
				 $('#description').val('');
				window.location.href='#payment_form';
	}else{

			// submit 
			if(submit_states_payment !='on'){
						paid_amount = $('#paid_amount').val();
						payment_date = $('#payment_date').val();
						description = $('#description').val();
						 if(empty(paid_amount)){
							$('#paid_amount').css('border','1px solid red');
							error_func('sorry Amount is empty !');
						}else if(Number(paid_amount)>Number(current_debt)){
							$('#paid_amount').css('border','1px solid red');
							error_func('sorry invalid paid !');
						}else if(empty(payment_date)){
							$('#payment_date').css('border','1px solid red');
							error_func('Please enter payment date !');
						}else{

							submit_states_payment = 'on';
							loading_fun('',20);
							$.post('php_f/make_payment.php',{description:description,payment_date:payment_date,customer_id:customer_id,crf_code:crf_code,paid_amount:paid_amount},function(feedback){
								submit_states_payment = 'off'; 
									i = setInterval(function(){ 
											if($('.horizantal_loading').attr('current_size') == '80'){
												 // finsh the loading 
												 loading_fun($('.horizantal_loading').attr('current_size'),13);
												 clearInterval(i);
											 }							
									},500); // finish the loading 
								if($.trim(feedback) == 'login'){location.reload();}
								if($.trim(feedback) == '1'){
									// success
									reload_data_tables();
									$('#payment_form').fadeOut();
									success_fun(' successfully !');
								}else{
									error_func(feedback);
									// display feadback
								}
							});
						}
			}
		}
}			 
 

// delete func

function delete_(data){
	submit_states_cars = ''
	get_crf_code();
	$('#warning').html('<div class="horizantal_loading" style="display:none;"></div> <img src="css/warning.png" alt="warning" style="border-radius:2.5em; width:80px; height:40px; margin-right: 4px; "/>'+data.msg).dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: false, buttons:  {
							"Yes": function() {

							if(submit_states_cars != 'on'){
										submit_states_cars = 'on';
										$(this).dialog('close');
										loading_fun('',20);
										$.post('php_f/delete_.php', {crf_code:crf_code,id:data.id,table:data.table,colmn:data.colmn}, function(feedback) {					
											submit_states_cars = 'off'; 
											
														i = setInterval(function(){ 
														if($('.horizantal_loading').attr('current_size') == '80'){
															 // finsh the loading 
															 loading_fun($('.horizantal_loading').attr('current_size'),13);
															 clearInterval(i);
														 }							
														},500); // finish the loading 
											if($.trim(feedback) == 'login'){location.reload();}								
											if($.trim(feedback) == '1'){
												reload_data_tables();
												success_fun(' successfully !');
											}else{
												error_func(feedback);
												$('#error').delay('5000').fadeOut();
											}

										});
										 
								
							}
	 
							 
						 },
							
						"No": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
							
	  $('div [aria-describedby="warning"] div:first span').text('Deleting...');
	  window.location.href='#warning'; 
}



// calcuation
function culc_func(){
	price = Number($('#rent_price').val());
	paid = Number($('#rent_paid').val());
	if(is_digit(paid) && is_digit(price)){ 
				$('#rent_balace').html(CommaFormattedN(price - paid));
	}
}

 
val = '';
function cal_date(from,to){

	var d1 = new Date(from);
	var d2 = new Date(to);

	// if from date is piger then to date 
	if(d1.getTime() > d2.getTime()){
		error_func('sorry from date ('+from+') greater then to date ('+to+') !');
		$('#rent_from_date,#rent_to_date').css('border','2px solid red');
		return false;
	}else if(d1.getTime() <= d2.getTime()){ 
		$('#rent_from_date,#rent_to_date').removeAttr('style');
		$('#error').hide();
	}

	c = $('#per_weeks').html();

	if(c == 'weeks'){
 		val = DateDiff.inWeeks(d1, d2);
	}else if(c == 'months'){
  		val = DateDiff.inMonths(d1, d2);
	}else if(c == 'years'){
	 	val = DateDiff.inYears(d1, d2);
	}else if(c == 'days'){
		val = DateDiff.inDays(d1, d2);
	}
	val = ($.trim(val) == 'NaN')?'0':val;
	$('#per_number').val(val);

	o = Number($('#rent_price').attr('o_price'));
	q = Number(val);
	a = (q == '0')?$('#rent_price').val():o * q;
	$('#rent_price').val(a);

	culc_func();
}

submit_states = ''; 
function add_(status){
		if(status != 'submit'){
			// rest the form 
			console.log(33);
			$('#rent_car_form').fadeIn();
			$('#rent_car_form input').removeAttr('style');
			$('#rent_car_form  input').val('');
			$('#rent_car_form #rent_balace').text('0');
			$('#rent_car_form  input#customer_name').hide();
			get_crf_code();	
			$('#rent_from_date').val(current_date);
				apply_chosen('customers');apply_chosen('cars',status.carName);
			window.location.href='#rent_car_form';
		}else{  
				 	if(submit_states !='on'){
							// submit
							customer_name = ($('input#customer_name').is(':visible'))?$('input#customer_name').val():current_selected_customer.customer_name;
							rent_from_date = $.trim($('#rent_from_date').val());
							rent_to_date = $.trim($('#rent_to_date').val());
							per_number = $.trim($('#per_number').val());
							rent_price = $.trim($('#rent_price').val()); 
							rent_paid = $.trim($('#rent_paid').val()); 
							due_date_rent = $.trim($('#due_date_rent').val()); 
							rent_mobile = $.trim($('#rent_mobile').val()); 
							rented_car = new Array();







							if($('input#car_name').is(':visible') == false){
								// existing car
								rented_car['car_name'] = current_selected_car.car_name;
								rented_car['car_id'] = current_selected_car.car_id;
							} 
							
							if($('input#car_name').is(':visible')){
								// new car 
								rented_car['car_name'] = $.trim($('input#car_name').val());
								rented_car['car_price'] =  $.trim($('input#car_price_add').val()); 
								rented_car['car_price_type'] = $.trim($('#car_price_type_add').val()); 
							
						 			if(rented_car['car_name'] == ''){
										error_func('car name is required');
										$('input#car_name').css('border','1px solid red');
									return false;
									} if(rented_car['car_price'] == ''){
										error_func('car price is required');
										$('input#car_price_add').css('border','1px solid red');
										return false;
									} if(rented_car['car_price_type'] == 'per...'){
										error_func('please one of these options daily/weekly/monthly/yearly');
										$('div#car_price_type_add_chzn').css('border','1px solid red');
										return false;	
									}

							}
							 
						
							// validate 
							if(empty(customer_name)){
								error_func('customer name is empty');
								$('#customer_name_chzn').css('border','1px solid red');
							return false;} if($.trim($('select#car_name').val()) == 'choose...' ){
								error_func('please choose car name ');
								$('div#car_name_chzn').css('border','2px solid red');
							return false;} if(empty(rent_from_date)){
								
								error_func('rent date is empty');
								$('#rent_from_date').css('border','1px solid red');
							return false;} if(empty(rent_to_date)){
								error_func('rent date from is empty');
								$('#rent_to_date').css('border','1px solid red');
							return false;} if(empty(per_number)){
								error_func('rent date to is empty');
								$('#per_number').css('border','1px solid red');
							return false;} if(empty(rent_price)){
								error_func('Rent price is empty');
								$('#rent_price').css('border','1px solid red');
							return false;} 
								if(Number(rent_price) < Number(rent_paid)){
								error_func('invalid paid !');
								$('#rent_paid').css('border','1px solid red');
							return false;} 
								
								var d1 = new Date(rent_from_date);
								var d2 = new Date(rent_to_date);
								if(d1.getTime() > d2.getTime()){
									error_func('sorry from date ('+rent_from_date+') greater then to date ('+rent_to_date+') !');
									$('#rent_from_date,#rent_to_date').css('border','2px solid red');
							return false;}
									
							
						 
								// send 
								submit_states = 'on';
								 loading_fun('',20); 
								$.post('php_f/add_.php',{rented_car_name:rented_car['car_name'],rented_car_price:rented_car['car_price'],rented_car_price_type:rented_car['car_price_type'],rented_car_id:rented_car['car_id'],crf_code:crf_code,customer_id:current_selected_customer.customer_id,customer_name:customer_name,rent_from_date:rent_from_date,rent_to_date:rent_to_date,per_number:per_number,rent_price:rent_price,rent_paid:rent_paid,rent_mobile:rent_mobile,due_date_rent:due_date_rent},function(feedback){
										submit_states = 'off'; 
											i = setInterval(function(){ 
													 	if($('.horizantal_loading').attr('current_size') == '80'){
															 // finsh the loading 
															 loading_fun($('.horizantal_loading').attr('current_size'),13);
															 clearInterval(i);
														 }							
														},500); // finish the loading
										if($.trim(feedback) == 'login'){location.reload();}
										if($.trim(feedback) == '1'){
											// success
											success_fun('successfully added!!');
											current_selected_car = '';  current_selected_customer = '';
											apply_chosen('customers');apply_chosen('cars');
											$('#rent_car_form').fadeOut();
										}else{
											error_func(feedback);
											// display feadback
										}
								});
							 

					}

		}
}