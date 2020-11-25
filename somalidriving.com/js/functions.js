
 


// reports date select
function chosen_date(){
 	year = $("select.year_income").val();
	month = $("select.month_income").val();
user_id = $("select.month_income").attr('user_id');

	

if ($.trim(month) == 'all') {
 		 date = year;
 
}else{
	 date = year+'-'+month;

}


	request_template('',{date:date,id:user_id},'pages/other_pages/reports_page.php'); 
 
 	}
// reports date select
function chosen_date_(){
 	year = $("select.year_income").val();
	month = $("select.month_income").val();
if ($.trim(month) == 'all') {
 		 date = year;
 
}else{
	 date = year+'-'+month;

}


	request_template('',{date:date},'pages/other_pages/user_income.php'); 
 
 	}

 
function clean(value){  
  if (value) {

   v_ = parseFloat($.trim(value.replace(/,/g, '')));

   if ($.trim(v_) == 'NaN') {return 0;}else{ return v_;}

}else{
 return 0;}   

}


function chosen_report_date(){

	from_date = $("input#date_from").val();
	to_date = $("input#date_to").val();
 
	 get_template.reports({date_to:to_date,date_from:from_date},'pages/other_pages/income_reports_page.php');
	
       
	}
/*
	y = (($('select.report_date_y  option:selected').attr('date_value'))?$('select.report_date_y  option:selected').attr('date_value'):'');   
	y = ($.trim(y) == '..')?'':y;
	 
	m = (($('select.report_date_m  option:selected').attr('date_value'))?$('select.report_date_m  option:selected').attr('date_value'):'');   
	m = ($.trim(m) == '..' || $.trim(m) == '')?'':'-'+m;
	
 
	d = (($('select.report_date_d  option:selected').attr('date_value'))?$('select.report_date_d  option:selected').attr('date_value'):'');   
	d = ($.trim(d) == '..' || $.trim(d) == '')?'':'-'+d;
	

	 if($.trim(type) == 'y'){
	 	 get_template.reports(y,'pages/other_pages/reports_page.php');
	 }else if($.trim(type) == 'm'){
	 	 get_template.reports(y+m,'pages/other_pages/reports_page.php');
	 }else if($.trim(type) == 'd'){
	 	 get_template.reports(y+m+d,'pages/other_pages/reports_page.php');
	 }
*/
 

// global varibles 
current_customer = '';
function return_digit(value){

return (Number($.trim(value)))?Number($.trim(value)):0;

}
function close_element(elem){
	$(elem).fadeOut();
	$('#error,#success').hide();
	return false;
}




function fix_chose_size(){
return false;
$('.chzn-drop li').each(function(){
  data = $(this).html();

  if(!data.includes('<pre')){
       $(this).html('<pre>'+data+'</pre>');
	}else{}

})

}



// loading func
width_loading = 0;
var a;
var b;
function loading_fun(status,view_el){  // time = 13 to finish,  to start time = 15
	time = ($.trim(status).toLowerCase() == 'start')?10:4;
	$('.horizantal_loading').fadeIn();
	//window.location.href = "#horizantal_loading";
	// $(view_el).hide();

	if($.trim(status).toLowerCase() == 'start'){ // when starting 
		width_loading = 0;

			if(a){clearInterval(a);} // prevent loop
			 a = setInterval(function (){  
				if(width_loading >= 80 && $.trim(status).toLowerCase() == 'start')  {
					clearInterval(a);//clearInterval(b); 
				}else{
					width_loading++; $(view_el).hide();
					$('.horizantal_loading').css('width',width_loading+'%').show().css('visibility','visible');
				}	
				//
			},time);
		
	}else{ //  when ending 
			if(b){clearInterval(b);} // prevent loop
			 b = setInterval(function (){ 	 
			   
				if(width_loading >= 100 && $.trim(status).toLowerCase() != 'start') {
					$('.horizantal_loading').hide(); width_loading = 0; if(a){clearInterval(a);} $(view_el).fadeIn();    $('.form').tee_form();  fix_chose_size(); clearInterval(b); 
				}else if(width_loading >= 80 ){
						clearInterval(a); 
					width_loading++; $(view_el).hide();
					$('.horizantal_loading').css('width',width_loading+'%').show().css('visibility','visible');
				}	
			},time);
	} 
	
 
}  


// seccess func
function success_fun(msg){
	$('#error').html('').hide();
	// display seccess massage
  	$('#success').html('<img src="css/success.gif" alt="success" style="border-radius:2em; width:60px; height:40px; margin-right: 4px; "/>'+msg).fadeIn();
 	 
  
 	if($('div.action_feedbacks .horizantal_loading').length != 1){
    		 $('div.action_feedbacks ').append('<div class="horizantal_loading" style="display:none;" ></div> '); 
    }
    $('.form').slideUp();
    $('#success').delay('3000').fadeOut();
 	$('div.ui-dialog-content').dialog('close');

}

// error func
function error_func(msg){
	$('#success').hide();

	if($('.form').is(':visible')){
 	}else{
			$('div#error').css('width','auto').css('margin','');
	}

 
  	$('div#error').css('margin','auto auto').html('<img src="css/error.jpg" alt="error" style="border-radius:2em; width:60px; height:40px; margin-right: 4px;"/>'+msg).fadeIn(); 

  	 $('html, body').animate({scrollTop: '0px'}, 500);

}

// all input on focus in add primary color at bottom 
// all input fieds any 
// comma format function 

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





function display_balance_calc() {
	

am = clean($('input[name="amount"]').val());
dis = clean($('input[name="discount"]').val());
bl = clean($('input[name="balance"]').attr('bl'));

bll = bl-(dis+am);
if (bll.toString().includes('-')) {
	error_func('invalid balance check paid amount or discount !');
	return false;
}
$('input[name="balance"]').val(CommaFormattedN(bll));

}


function chosen_subject(el){
		sub = el.find('select option:selected');
	if(sub.html() != '..'){
			el.find('input[name="cost"]').attr('cost',sub.attr('cost')).val(CommaFormattedN(sub.attr('cost')));
			el.find('input[name="subject_id"]').val(sub.attr('subject_id'));	

	}
display_balance_calc_1();
}


function display_balance_calc_1() {
 
am = 0;
$('input[name="paid"]').each(function(){

		am += clean($(this).val());

});

oneTimeDisounct = clean( $('input[name="discount"]').val());



bl = 0;
$('input[name="cost"]').each(function(){

		bl += clean($(this).attr('cost'));

});

md = 0;
 
$('input[name="monthly_discount"]').each(function(){

		cost = $(this).closest('tr').find('select option:selected').attr('cost');
		this_val = clean($(this).val());
		this_val = (Number(this_val))?this_val:0;
		console.log(this_val);
		if (cost >= this_val) {
					 $(this).closest('tr').find('input[name="cost"]:first').val(cost-this_val);
		}		 
		
 

		 md += clean($(this).val());

});

cost = bl - (md+oneTimeDisounct);


bl = cost-am;

 if (bl.toString().includes('-')) {
	error_func('invalid balance  !');
	$('input[name="balance"]').css('border','1px solid red !important;');
	return false;
}else{
		$('input[name="balance"]').css('border','important;');

}
$('input[name="balance"]').val(CommaFormattedN(bl));

}













// rate culculate
function rate_calc(amount,type,rate_input_id,balance_id){   // type: ksh or dollar
/*
Cash rate: 100 ksh
Dollar rate: 102 ksh
*/

if($.trim($(rate_input_id).attr('defaut_done')) != 'true'){
  $(rate_input_id).show().val($(rate_input_id).attr('value')).attr('defaut_done','true');		
}

 	amount = Number($(amount).val().replace(/,/g , ''));
C 

if(($.trim(amount) == '' || $.trim(amount) == '0' ) || $.trim(amount) == '0.00'){
 	 $(rate_input_id).removeAttr('required').removeAttr('error_empty_msg');
 	 $(rate_input_id).next('#error_line').hide();
  }else{
     $(rate_input_id).attr('required','required').attr('error_empty_msg','Rate is required in order to convert !');
  }

 
	if(rate_input_id.includes('ksh')){
		$('.ksh_sign').show();
	}

	if(rate_input_id.includes('dollar')){
		$('.dollar_sign').show();
	} 

 

   converted_amount = '';
	$(balance_id).show();
	if(Number(selected_rate)){ 
		if($.trim(type) == 'ksh'){ // convert to ksh
			 converted_amount = amount * selected_rate;
			 $(balance_id).attr('balance',converted_amount).html(CommaFormattedN(converted_amount));
		}else{  // convert to dollar 
			converted_amount = amount / selected_rate;   // ksh amount / dollar_rate
			 $(balance_id).attr('balance',converted_amount).html(CommaFormattedN(converted_amount));
		}
	}
	new_current_balance();

	
}


// reset balance
function reset_balance(input_val,balance,rate_input){
	$(rate_input).hide().removeAttr('required').removeAttr('error_empty_msg').removeAttr('defaut_done').next('#error_line').hide();  
	$(balance).hide().html('0');
 	$(balance).attr('balance','0');
	$(balance).attr('balance');

	new_current_balance();
}

function convert(val,type){
	if(type=='ksh'){
		if(val){
			
			rate_calc('#amount_money_dollar','ksh','input#rate_ksh','.balance_converted_to_ksh');
		}else{
			reset_balance('#amount_money_dollar','.balance_converted_to_ksh','input#rate_ksh');
		}
	}else{
		if(val){
			rate_calc('#amount_money_ksh','dollar','input#rate_dollar','.balance_converted_to_dollar');
		}else{
			reset_balance('#amount_money_ksh','.balance_converted_to_dollar','input#rate_dollar');
		}	
	}
	
}





function toggle_rate(trans_type){
			if(trans_type == 'exchange'){

				 $("#amount_validator input[type='number']").each(function(){
					 	 if(!$(this).is(':visible')){ 
								$(this).parent().find('input[type=checkbox]').click();  
					 	 }
					 });
  				$('#amount_validator label,#amount_validator input[type="checkbox"]').hide();
                    
			}else{

				if(!$('#amount_validator label,#amount_validator input[type="checkbox"]').is(':visible')){
                           // swich from exchange to in or out
					 $("#amount_validator input[type='number']").each(function(){
					 	 if($(this).is(':visible')){ 
								$(this).parent().find('input[type=checkbox]').click(); // hide it 
					 	 }
					 });
		 
					$('.ksh_sign,.dollar_sign').hide(); 	
 	            	$('#amount_validator label,#amount_validator input[type="checkbox"]').show();
				 }// else do nothing 

			}
			convert($('#convert_to_dollar_check').is(':checked'),'dollar');
			convert($('#convert_to_ksh_check').is(':checked'),'ksh'); 

}





function validate_msg(val){

		if(Number($.trim(val)) && $.trim(val) !='0'){
			return true;
		}else{
			return false;
		}

}



	msg_type = '';
// update the new balance  if customer is chosen 
function new_current_balance(){

	function x_func(ksh_x_val,doll_x_val){
			$('b#current_cash_balance').html(CommaFormattedN(ksh_x_val)+' ksh').attr('class',((JSON.stringify(ksh_x_val).includes("-"))?'debt_color':''));
			$('b#current_dollar_balance').html('$'+CommaFormattedN(doll_x_val)).attr('class',((JSON.stringify(doll_x_val).includes("-"))?'debt_color':''));  		 
	}
	trans_type = $.trim($('#transaction_form input[name="trans_type"]:checked').val()).toLowerCase();
	ksh_x_amount = (return_digit($('.balance_converted_to_ksh').attr('balance')) + return_digit(((Number($('.balance_converted_to_dollar').attr('balance')))?0:$('#amount_money_ksh').val().replace(/,/g , ''))));
	dollar_x_amount = (return_digit($('.balance_converted_to_dollar').attr('balance')) +  return_digit(((Number($('.balance_converted_to_ksh').attr('balance')))?0:$('#amount_money_dollar').val().replace(/,/g , ''))));
		new_bl_c = '';
		new_bl_d = '';
		if(trans_type == 'out'){

	            new_bl_c = return_digit(current_customer.current_cash_balance) - ksh_x_amount;
	            new_bl_d = return_digit(current_customer.current_dollar_balance) - dollar_x_amount;
				x_func(new_bl_c, new_bl_d); 	 

		}else if(trans_type == 'in'){
	            new_bl_c = return_digit(current_customer.current_cash_balance) + ksh_x_amount;
	            new_bl_d = return_digit(current_customer.current_dollar_balance) + dollar_x_amount;
				x_func(new_bl_c, new_bl_d); 			
		}		



		// convertions  msg_type
		conv = '';
	if(trans_type == 'in' || trans_type == 'out'){
		if(validate_msg($('.balance_converted_to_dollar').attr('balance')) && validate_msg($('.balance_converted_to_ksh').attr('balance'))){
				// both conveted 
	                conv = '<br><p style=" margin-top: 4px;    margin-left: 13px;"> converted from <span style="display:none !important" _></span>'+CommaFormattedN($("#amount_money_ksh").val().replace(/,/g , ''))+'<span _ style="display:none !important"  conveted_dollar  ></span> ksh , sell rate: '+CommaFormattedN($("input#rate_dollar").val())+' ksh <br>'; 
					conv +=  '  and $<span style="display:none !important" _></span>'+CommaFormattedN($("#amount_money_dollar").val().replace(/,/g , ''))+'<span _ style="display:none !important" conveted_ksh  ></span>, puy rate :'+CommaFormattedN($("input#rate_ksh").val())+'ksh </p>';  

 		}else{ // single conv//   
				if(validate_msg($('.balance_converted_to_dollar').attr('balance'))){
	                conv = '<br><p style=" margin-top: 4px;    margin-left: 13px;"> converted from <span style="display:none !important" _></span>'+CommaFormattedN($("#amount_money_ksh").val().replace(/,/g , ''))+'<span _ style="display:none !important"   conveted_dollar ></span> ksh, sell rate: '+CommaFormattedN($("input#rate_dollar").val())+' ksh </p>'; 
				}else if(validate_msg($('.balance_converted_to_ksh').attr('balance'))){
					conv =  '<br><p style=" margin-top: 4px;    margin-left: 13px;"> converted from $<span style="display:none !important" _></span>'+CommaFormattedN($("#amount_money_dollar").val().replace(/,/g , ''))+'<span _ style="display:none !important"  conveted_dollar ></span>, puy rate was:'+CommaFormattedN($("input#rate_ksh").val())+' ksh </p>';  
				}
 
		}
	}else if(trans_type == 'exchange'){

		if(validate_msg($('.balance_converted_to_dollar').attr('balance')) && validate_msg($('.balance_converted_to_ksh').attr('balance'))){
				// both conveted 
					conv = '<b><b class="">Exchange:</b>  $'+CommaFormattedN($("#amount_money_dollar").val().replace(/,/g , ''))+'  <span><i>To</i></span> '+CommaFormattedN(validate_msg($('.balance_converted_to_ksh').attr('balance')))+' ksh,  <span conveted_dollar > puy rate:  '+CommaFormattedN($("input#rate_ksh").val())+' ksh </span> ';
					conv += '</b> <br><p tyle=" margin-top: 4px;    margin-left: 13px;">  and  <b>'+CommaFormattedN($("#amount_money_ksh").val().replace(/,/g , ''))+' ksh</b> <span><i>To</i></span> <b>$'+CommaFormattedN(validate_msg($('.balance_converted_to_dollar').attr('balance')))+'</b>,  <span conveted_ksh > sell rate: '+CommaFormattedN($("input#rate_dollar").val())+' ksh  </span> </p>';
		}else{ // single conv 
				if(validate_msg($('.balance_converted_to_dollar').attr('balance'))){
					conv = '<b><b class=" ">Exchange:</b>  '+CommaFormattedN($("#amount_money_ksh").val().replace(/,/g , ''))+' ksh <span><i>To</i></span> $'+CommaFormattedN(validate_msg($('.balance_converted_to_dollar').attr('balance')))+',  <span conveted_ksh  > sell rate:  '+CommaFormattedN($("input#rate_dollar").val())+' ksh  </span>  </b>';
				}else if(validate_msg($('.balance_converted_to_ksh').attr('balance'))){
					conv = '<b><b class=" ">Exchange:</b>  $'+CommaFormattedN($("#amount_money_dollar").val().replace(/,/g , ''))+'  <span><i>To</i></span> '+CommaFormattedN(validate_msg($('.balance_converted_to_ksh').attr('balance')))+' ksh, <span conveted_dollar >  puy rate: '+CommaFormattedN($("input#rate_ksh").val())+' ksh </span>   </b>';
				}
 
		}
	}





	if($.trim(trans_type) !='exchange' && $.trim(trans_type) !='' && $('input[name="customer_id"]').val() == ''){
		$('#customer_name_new').attr('required','required').attr('error_empty_msg','customer name is required if amount is In or Out !');		
	}else{
		$('#customer_name_new').removeAttr('required','required').removeAttr('error_empty_msg').next('#error_line:first').hide();		
	}
	$('#transaction_form input[name="trans_type"]:checked').parent().next('#error_line').hide();


 		msg_type = '';
	if(trans_type == 'exchange'){
	 			msg_type = conv; 
		}else{  // in or out 
			      value = '';
				 if(dollar_x_amount != '0' && ksh_x_amount != '0'){ // both 
				      value = '$'+CommaFormattedN(dollar_x_amount)+' <span>and</span>  '+CommaFormattedN(ksh_x_amount)+' ksh';	
				 }else if(dollar_x_amount != '0'){
				 	  value = '$'+CommaFormattedN(dollar_x_amount); 
				 }else if(ksh_x_amount != '0'){	
				 	  value =  CommaFormattedN(ksh_x_amount)+' ksh';
				 }
			 	 msg_type = ' <b> <b class="title_">'+trans_type+':</b> '+value+'  </b>'+conv+'<span style="    float: right;color: black;"><span> new balance is: : </span><span class="'+(( JSON.stringify(new_bl_c).includes('-'))?'debt_color':'in_color')+'" style="font-weight:normal">'+CommaFormattedN(new_bl_c)+' ksh </span><span> and </span><span class="'+((JSON.stringify(new_bl_d).includes('-'))?'debt_color':'in_color')+'" style="font-weight:normal">$'+CommaFormattedN(new_bl_d)+'</span> </span>';			
		} 
		// console.log({c:new_bl_c,d:new_bl_d});
		$('input[name="msg_type"]').val(msg_type);
		
 	if(trans_type == 'exchange'){
		$('input[name="amount_money_ksh"]').val($('#amount_money_ksh').val().replace(/,/g , '')); 
		$('input[name="amount_money_dollar"]').val($('#amount_money_dollar').val().replace(/,/g , ''));
	}else{
		$('input[name="amount_money_ksh"]').val(ksh_x_amount); 
		$('input[name="amount_money_dollar"]').val(dollar_x_amount);
	}

		$('input[name="r_amount_ksh"]').val($('#amount_money_ksh').val().replace(/,/g , '')); 
		$('input[name="r_amount_dollar"]').val($('#amount_money_dollar').val().replace(/,/g , ''));



	return false;
}


// delete func

function delete_(data){
	$('#warning').css('color','red !important;').html('<form style="display:none;" id="delete_form"><input type="hidden" name="id" value="'+data.id+'">  <input type="hidden" name="table" value="'+data.table+'">  </form> '+'<img src="css/warning.png" alt="warning" style="border-radius:2.5em; width:80px; height:40px; margin-right: 4px; "/>'+data.msg).dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: false, buttons:  {
							"Yes": function() {
										
							 submit_form($('#warning form').attr('id'),'php_files/delete.php');
 									 

						 },
							
						"No": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
							
	  $('div [aria-describedby="warning"] div:first span').text('Deleting...');
	  window.location.href='#warning'; 
}


function toggle_disable_(data){
	$('#warning').css('color','#9F6000 !important;').html('<form style="display:none;" id="delete_form"><input type="hidden" name="id" value="'+data.id+'">  <input type="hidden" name="table" value="'+data.table+'">  </form> '+'<img src="css/error.jpg" alt="error" style="border-radius:2em; width:60px; height:40px; margin-right: 4px;"/>'+data.msg).dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: false, buttons:  {
							"Yes": function() {
										
							 submit_form($('#warning form').attr('id'),'php_files/disable.php');
 									 

						 },
							
						"No": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
							
	  $('div [aria-describedby="warning"] div:first span').text('Deleting...');
	  window.location.href='#warning'; 
}

 
 function Loguut(){
 	 $('#warning').html('<img src="css/warning.png" alt="warning" style="border-radius:2.5em; width:80px; height:40px; margin-right: 4px; "/>Are you Sure you want to LogOut ?').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Yes": function() {
						 	
		loading_fun('start');
	 $.post('php_f/logout.php', function(logged_out) {					
					loading_fun('stop');			
							window.location.reload();
	 });
		
							 
						 },
							
						"No": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
							
							
		    $('div [aria-describedby="warning"] div:first span').html('Logging Out'); 
 
		    return false;
 }
	

 



// chosen customer 

function chosen_customer(selected_option ){   // e.g: $(this).find('option:selected');
  	current_customer = {customer_id:selected_option.attr('customer_id'),current_cash_balance:selected_option.attr('current_cash_balance'),current_dollar_balance:selected_option.attr('current_dollar_balance'),current_dollar_rate:selected_option.attr('dollar_rate'),current_cash_rate:selected_option.attr('cash_rate'),customer_mobile:selected_option.attr('mobile')}
  	
  	// set current rate
 
	$('#customer_mobile').val(current_customer.mobile);
	
    // display current totals 
    $('.trans_f_b').fadeOut();
    $('b#current_cash_balance').html(CommaFormattedN(current_customer.current_cash_balance)+'ksh').show();
    $('b#current_dollar_balance').html('$'+CommaFormattedN(current_customer.current_dollar_balance)).show();
	 $('.trans_f_b i').show(); $('.trans_f_b').fadeIn();
   
	 
	     // reset amounts dollar & ksh 
  		$('#amount_money_ksh,#amount_money_dollar').val('');
    // reset balances
		reset_balance('#amount_money_ksh','.balance_converted_ksh','input#rate_ksh');
		reset_balance('#amount_money_dollar','.balance_converted_dollar','input#rate_dollar');
    //  resetradio & checkboxes
		
    	if($(' form#transaction_form  .ui-checkboxradio-label').is(':visible')){
    		    	$('#trans_type_validate input[type="radio"], #amount_validator input[type="checkbox"]').prop('checked', false);
    				$('#trans_type_validate input[type="radio"], #amount_validator input[type="checkbox"]').checkboxradio('refresh');
    	}


		$('.ksh_sign, .dollar_sign  , .balance_converted_to_ksh, .balance_converted_to_dollar ').hide(); // hide rate text 


		trans_type = $.trim(selected_option.val()).toLowerCase();
	 
	  	if(trans_type   == 'add'){  
	  		$('#customer_name_new').attr('required','required').attr('error_empty_msg','customer name is required if amount is In or Out !');		
	  		$('#customer_name_new').fadeIn();
	  		$('input[name="customer_id"]').val('');	
	  	}else{
	  		$('input[name="customer_id"]').val(selected_option.attr('customer_id'));
	  		$('#customer_name_new').removeAttr('required','required').removeAttr('error_empty_msg').next('#error_line:first').hide();		
	  		$('#customer_name_new').fadeOut();

		}
		$('b#current_cash_balance').parent().fadeIn();
}


function chosen_trans_type(type){ // if chosen type != exchange  customer name is required 
	if($.trim(type) !='exchange' && $('input[name="customer_id"]').val() == ''){
		//customer_name_required('true');
		$('#customer_names_select').addClass('error_line');
		$('#customer_name_new').attr('required','required').attr('error_empty_msg','customer name is required if amount is In or Out !');		
	}else{
		$('#customer_names_select').removeClass('error_line');
		$('#customer_name_new').removeAttr('required','required').removeAttr('error_empty_msg');		

	}
}






