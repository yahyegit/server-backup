
function edit_settings(value,colmn,sql_colmn){

	// validate then submit 
	if($.trim(sql_colmn) == 'submit'){
		crf_value = $('#crf_code').val();
		if($('#change_password').is('visible')){
				currentPass = $('#change_password').val();
				newPass = $('#change_password').val();
				confirmPass = $('#change_password').val();
				if($.trim(newPass) != $.trim(confirmPass)){
					//error new password did not match
				}else{
					$.post('php_f/change_password.php',{crf_value:crf_value,currentPass:currentPass,newPass:newPass,confirmPass:confirmPass},function(feedback){
						if($.trim(feedback) == 'login'){location.reload();}
						if($.trim(feedback) == '1'){
							// success
						}else{
							// display feadback
						}
					});
				}

				
		}else{
			edit_value = $('#edit_setting_value').val();
			sql_colmn = $('#settings_editing_name').attr('sql_colmn');

				if($.trim(edit_value) == ''){
					//error empty field
				}else{
					
					$.post('php_f/edit_settings.php',{crf_value:crf_value,edit_value:edit_value,sql_colmn:sql_colmn},function(feedback){
						if($.trim(feedback) == 'login'){location.reload();}
						if($.trim(feedback) == '1'){
							$('#edit_settings').fadeOut();
							// success
						}else{
							// display feadback
						}
					});
				}
		}
	}else{

		 // get the crf
		$.post('php_f/get_crf_code.php',function(new_crf){
					$('#crf_code').val(new_crf);  
			});		
		// form ready 
		$('#hidden_form').hide();
		if($.trim(colmn) == 'password'){
			$('#change_password input').attr('style','').val('');
			$('#change_password').fadeIn();
		}else{
			$('#edit_settings div.text input').attr('style','').val(value);
			$('#settings_editing_name').html(colmn).attr('sql_colmn',sql_colmn);
			$('#edit_settings').fadeIn();
		}

	}
}







// edit 





// delete func
function delete_func(data){
 

	   $('#warning').html('<div class="dataTables_processing" style="display:none;"></div> <img src="css/warning.png" alt="warning" style="border-radius:2.5em; width:80px; height:40px; margin-right: 4px; "/>'+data.msg).dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Yes": function() {
							 $('#warning input').attr('disabled','disabled');
							$.post('php_f/delete_.php', {id:data.id,table:data.table,colmn:data.colmn}, function(feedback) {					
								if($.trim(feedback) == 'login'){location.reload();}
								if($.trim(feedback) == '1'){
									$('#warning').dialog('close');
									
									// success
								}else{
									// display feadback
								}
							});
							 
							 
							 
						 },
							
						"No": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
							
	  $('div [aria-describedby="warning"] div:first span').text(data.title); 
}

