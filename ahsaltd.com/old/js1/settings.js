 // change Admin Email 
 
 function changeEmail(email){
   $('#change_Email input,div#change_Email li.choisesInvoice,div#change_Email br').remove();
     $('#change_Email li label').text("Email").after('<input type="email" style=" width: 376;" id="emailChange" >');
  
  
    $('#change_Email li').after('<li class="choisesInvoice" style="display:none;"> <label> <input type="checkbox">  change Password </label> </li> <br/ ><br/> <li class="choisesInvoice" id="pass2"> <label>Password:</label> <input type="password" id="passord"    style=" width: 376;"  >  </li>            <li class="choisesInvoice" id="pass1" > <label>Confirm Password:</label> <input type="password" id="passord2"    style=" width: 376;"  >  </li>  <br><br><br> <li class="worning2 choisesInvoice"> </li>');
 
	$('#change_Email li.choisesInvoice input[type="checkbox"]').prop('checked', false); 
   $('#change_Email li#pass2,#change_Email li#pass1').hide();
      // change password
	 $('#change_Email li.choisesInvoice input[type="checkbox"]').click(function (){
	 
	 if($(this).is(':checked')){
	     $('#change_Email li#pass2,#change_Email li#pass1').show();
	  }else{
	    $('#change_Email li#pass2,#change_Email li#pass1').hide();
	  }
	 
	 });	
	 
 
     $('#emailChange').val(email).select().attr('type','email');
 
$('#change_Email').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Change": function() {
				 
		          var enablePass = condFunction($('#change_Email li.choisesInvoice input[type="checkbox"]').is(':checked'),'1','0');
				 
				 	          var newEmail = $('#emailChange').val();
							  var password_  = $('#change_Email li input#passord').val();
							  var password_2 = $('#change_Email li input#passord2').val();
							  
								 if(jQuery.trim(newEmail) == ''){
								  error_func('Error Enter Email!');
								  $('#emailChange').css('border','2px groove red');
								 }else if(jQuery.trim(password_) == ''  && enablePass == '1' ){
								 	  error_func('Error enter Password !');
								  $('#change_Email li input#passord').css('border','2px groove red');
								 }else if(jQuery.trim(password_2) == '' && enablePass == '1'){
								 	  error_func('Error confirm Password !');
								 $('#change_Email li input#passord2').css('border','2px groove red');
								 }else if(password_2 != password_  && enablePass == '1' ){
								 	  error_func('Error password do not match!');
								 $('#change_Email li input#passord2').css('border','2px groove red');
								  $('#change_Email li input#passord').css('border','2px groove red');
								 }else{
									  loading_func(); // SHOW LOADING IMAGE DIALOG  
				 
							 $.post('php_f/change_email.php', {password_:password_,newEmail:newEmail}, function(feedback) {					
										if(feedback == 1){ 
										   success_func(' changed !!!');
										   	  setInterval(function(){
												  window.location.reload();
											  },1000);  
										   
									   }else if(feedback == ''){ 
										    window.location.reload();
									   }else{
									    $("#loading").dialog('close'); 
										 error_func(feedback);
									   }
						 	
							});
									
									
							  }
				 
 
							 
						 },
							
						"Cancel": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
 
   $('div [aria-describedby="change_Email"] div:first span').html(' changing Email '); 
 
 return false;
 }
 
 
 
//change_username

function changeUsername(username){
 $('#change_username_input').val(username).select();
$('#change_username').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Change": function() {
				 
				 
				 	          var newUsername = $('#change_username_input').val();
								 if(jQuery.trim(newUsername) == ''){
								  error_func('Error Enter UserName!');
								 }else{
									  loading_func(); // SHOW LOADING IMAGE DIALOG  
				 
							 $.post('php_f/change_username.php', {newUsername:newUsername}, function(feedback) {					
									if(jQuery.trim(feedback) == '211'){ 
										   success_func(' changed !!!');
										   	  setInterval(function(){
												 window.location.reload();
											  },1000);  
										   
									   }else if(feedback == ''){ 
										    window.location.reload();
									   }else{
									    $("#loading").dialog('close'); 
										 error_func(feedback);
									   }
						 	
							});
									
									
							  }
				 
				 
				 
				 
				 
				 
				 
				 
				 
							 
						 },
							
						"Cancel": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
							
 
 
 
 
 
 
   $('div [aria-describedby="change_username"] div:first span').html(' changing Username '); 


 
	
return false;

}


 
//Change password 
function changePass(){
 
$('#change_pass').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Change": function() {
				 
				                  var change_pass_current = $('#change_pass_current').val();
							      var change_pass_new = $('#change_pass_new').val();
								  var change_pass_new_conf = $('#change_pass_new_conf').val();
				 	               var Change_middle =  $('#change_pass_new').attr('m');
								   
								 if(jQuery.trim(change_pass_current) == ''){
								  error_func('Error Enter Current Password!');
								 }else if(jQuery.trim(change_pass_new) == ''){
								   error_func('Error Enter new Password!');
								 }else if(change_pass_new != change_pass_new_conf){
								   error_func('Error Password do not match!');
								 }else{
									  loading_func(); // SHOW LOADING IMAGE DIALOG  
				                 change_pass_new =  Change_middle+''+change_pass_new; 

							 $.post('php_f/change_password.php', {change_pass_new:change_pass_new,change_pass_current:change_pass_current}, function(feedback) {					
										if(feedback == '1'){ 
										   success_func(' changed !!!');
										   	  setInterval(function(){
												  window.location.reload();
											  },1000);  
										   
									   }else if(feedback == ''){ 
										    window.location.reload();
									   }else{
									    $("#loading").dialog('close'); 
										 error_func(feedback);
									   }
						 	
							});
									
									
							  }
				 
				 
				 
				 
				 
				 
				 
				 
				 
							 
						 },
							
						"Cancel": function() {	 
						$('#change_pass li input').val('');
								$(this).dialog("close");
							}
						},
			   
							
							});
							
 
 
 
 
 
 
   $('div [aria-describedby="change_pass"] div:first span').html(' Changing Password '); 
 	
return false;

}


 
//change_username      change_mobile_input
 
function changeMobile(mobile){
 $('#change_mobile_input').val(mobile).select();
$('#change_mobile').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Change": function() {
				 
				 
				 	          var newMobileNumber =  $('#change_mobile_input').val();
								 if(jQuery.trim(newMobileNumber) == ''){
								  error_func('Error Enter Mobile Number!');
								 }else{
									  loading_func(); // SHOW LOADING IMAGE DIALOG  
				 
							 $.post('php_f/change_mobile.php', {newMobileNumber:newMobileNumber}, function(feedback) {					
										if(feedback == 411){ 
										   success_func(' changed !!!');
										   	  setInterval(function(){
												  window.location.reload();
											  },1000);  
										   
									   }else if(feedback == ''){ 
										    window.location.reload();
									   }else{
									    $("#loading").dialog('close'); 
										 error_func(feedback);
									   }
						 	
						 	
							});
									
									
							  }
				 
				 
				 
				 
				 
				 
				 
				 
				 
							 
						 },
							
						"Cancel": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
							
 
 
 
 
 
 
   $('div [aria-describedby="change_mobile"] div:first span').html(' changing Mobile Number'); 


 
	
return false;

}



//change_theme 

function changeTheme(){
$('#change_theme').dialog({ position:['right', 'bottom'], show: "blind", hide: "explode", width: 'auto',  height:600,  modal: false, buttons:  {
							"Change": function() {
				 
							var chosen_theme = $("select#themeRoller_ui_costom").val();
				 	       
							 loading_func(); // SHOW LOADING IMAGE DIALOG   
							 $.post('php_f/change_theme.php', {chosen_theme:chosen_theme}, function(feedback) {					
									if(jQuery.trim(feedback) == '511'){ 
										   success_func('theme  changed !!!');
										   	  setInterval(function(){
												  window.location.reload();
											  },1000);  
										   
									   }else if(feedback == ''){ 
										    window.location.reload();
									   }else{
									    $("#loading").dialog('close'); 
										 error_func(feedback);
									   }
						 	
							});
									
  		 
							 
						 },
							
						"Cancel": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
 
  $("select#themeRoller_ui_costom").change(function (){
    	var selected_value_ = $(this).val();
    	var selected_style = $(this).find('option:selected').attr('style_src');
        $('link.themeToggle').attr('href',selected_style);	 
     });
 
 
   $('div [aria-describedby="change_theme"] div:first span').html(' Changing Theme'); 


 
	
return false;

}
 

 // change store Name
 
 function changeStoreName(name){
 
 
  $('#changeStoreName').val(name).select().removeAttr('style');
    $('#changeStoreName label').text('Company Name:');

$('#changeStoreName').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Change": function() {
				 
				 
				 	          var storeName = $('#chageStoreName').val();
								 if(jQuery.trim(storeName) == ''){
								  error_func('Error Enter Company Name !');
								  $('#chageStoreName').css('border','2px groove red')
								 }else{
									  loading_func(); // SHOW LOADING IMAGE DIALOG  
				 
							 $.post('php_f/change_storeName.php', {storeName:storeName}, function(feedback) {					
										if(jQuery.trim(feedback) == '1'){ 
										   success_func('Company changed !!!');
										   	  setInterval(function(){
												  window.location.reload();
											  },1000);  
										   
									   }else if(feedback == ''){ 
										    window.location.reload();
									   }else{
									    $("#loading").dialog('close'); 
										 error_func(feedback);
									   }
						 	
							});
									
									
							  }
				 
 
							 
						 },
							
						"Cancel": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
 
   $('div [aria-describedby="changeStoreName"] div:first span').html(' changing Company Name.. '); 
 
 return false;
 }
 
 
 // change Location
 
 function changeLacation(name){
 $('#chageStoreName').hide();
 
   $('#changeStoreName textarea').remove();
   $('#changeStoreName li input').after('<textarea style="margin: 2px; width: 383px; height: 109px;" ></textarea>');
   
  $('#changeStoreName label').text('location:');
  $('#changeStoreName textarea').val(name);
  
$('#changeStoreName').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Change": function() {
				 
				 
				 	          var storeName =  $('#changeStoreName textarea').val();
								 if(jQuery.trim(storeName) == ''){
								  error_func('Error Enter Company Name !');
								  $('#chageStoreName').css('border','2px groove red')
								 }else{
									  loading_func(); // SHOW LOADING IMAGE DIALOG  
				 
							 $.post('php_f/change_location.php', {storeName:storeName}, function(feedback) {					
									if(jQuery.trim(feedback) == '1'){ 
										   success_func('Location changed !!!');
										   	  setInterval(function(){
												  window.location.reload();
											  },1000);  
										   
									   }else if(feedback == ''){ 
										    window.location.reload();
									   }else{
									    $("#loading").dialog('close'); 
										 error_func(feedback);
									   }
						 	
							});
									
									
							  }
				 
 
							 
						 },
							
						"Cancel": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
 
   $('div [aria-describedby="changeStoreName"] div:first span').html(' changing Company Location '); 
 
 return false;
 }
 
 
  

 //  Store contacts
 
 function changeStoreNumber(contacts){
 $('#chageStoreName').hide();
 
   $('#changeStoreName label').text('Contacts:');
   $('#changeStoreName textarea').remove();
   $('#changeStoreName li input').after('<textarea style="margin: 2px; width: 383px; height: 109px;" ></textarea>');
   
  $('#changeStoreName textarea').val(contacts);
  
$('#changeStoreName').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Change": function() {
				 
				 
				 	          var contacts = $('#changeStoreName textarea').val();
								 if(jQuery.trim(contacts) == ''){
								  error_func('Enter company Contacts !');
								  $('#chageStoreName').css('border','2px groove red')
								 }else{
									  loading_func(); // SHOW LOADING IMAGE DIALOG  
				 
							 $.post('php_f/changeStoreContacts.php', {contacts:contacts}, function(feedback) {					
										if(jQuery.trim(feedback) == '1'){ 
										   success_func(' changed !!!');
										   	  setInterval(function(){
												  window.location.reload();
											  },1000);  
										   
									   }else if(feedback == ''){ 
										    window.location.reload();
									   }else{
									    $("#loading").dialog('close'); 
										 error_func(feedback);
									   }
						 	
							});
									
									
							  }
				 
 
							 
						 },
							
						"Cancel": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
 
   $('div [aria-describedby="changeStoreName"] div:first span').html(' changing Company Contacts '); 
 
 return false;
 }
 
  
 // change Total Days
 
 function changeTotalDays(currentDayName){
  // default selected to current dayName
  $('#total_daysName option').each(function (){
	  if($.trim($(this).val()) == currentDayName){
		  $(this).attr('selected','selected');
	  }	  
  })
 
  
$('#change_total_days_box').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Change": function() {
				 
				 
				 	          var dayName = $('#total_daysName').val();
								/*  if($.trim(dayName) == 'Choose..'){
								  error_func('Please Select days Name!!');
								  $('#total_daysName').css('border','2px groove red')
								 }else{ */
									  loading_func(); // SHOW LOADING IMAGE DIALOG  
				 
							 $.post('php_f/change_total_days.php', {dayName:dayName}, function(feedback) {					
										if(feedback == 1){ 
										   success_func(' changed !!!');
										   	  setInterval(function(){
												  window.location.reload();
											  },1000);  
										   
									   }else if(feedback == ''){ 
										    window.location.reload();
									   }else{
									    $("#loading").dialog('close'); 
										 error_func(feedback);
									   }
						 	
							});
									
									
							 /* } */
				 
 
							 
						 },
							
						"Cancel": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
 
   $('div [aria-describedby="change_total_days_box"] div:first span').html(' changing .. '); 
 
 return false;
 }
 


// enable or disable time

function toggleTime(){
	                  loading_func(); // SHOW LOADING IMAGE DIALOG  
							$.post('php_f/toggleTime.php', function(feedback) {					
								
								 if(feedback == '1'){ 
										   success_func(' changed !!!');
										   	  setInterval(function(){
												  window.location.reload();
											  },1000);  
										   
								  }else if(feedback == ''){ 
										    window.location.reload();
								  }else{
									    $("#loading").dialog('close'); 
										 error_func(feedback);
								  }  
								
							});
return false;
}
 
 
