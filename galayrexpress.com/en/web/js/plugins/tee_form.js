
error_validate = [];
function empty_check(error_empty_msg,val,elm){
        			val = $.trim(val).toLowerCase();
            	if($.trim(error_empty_msg) !='' && val == '' || val == '..' || val == '0' || val == '0.00' || val == 'choose..'){
 							error_validate[elm.attr('name')] = 'on';   	                    
            		 	if(elm.attr('name') == 'course' || elm.attr('name') == 'name'){
            		 			elm.parents().find('.chzn-container').addClass('error_border');
			            	    elm.addClass('error_border');
 			            	}else{
			            		 elm.addClass('error_border');
			            	}
            		 }else{
 						delete	error_validate[elm.attr('name')]   	                    

            		 	if(elm.attr('name') == 'course' || elm.attr('name') == 'name'){
            		 			 elm.parents().find('.chzn-container').removeClass('error_border');
			            		 elm.removeClass('error_border');

			            	}else{
			            		 elm.removeClass('error_border');
			            	}

            		 elm.next('#error_line:first').hide(); 
            		//elm.css('border','2px solid red !important;'); // elm.next('#error_line:first').html(error_empty_msg).show();  // #error_line {border-botom: red 1px}
            	}



  }

  // atleast on is required
             
function one_required(parent,elm,error_msg){
         		 
            	if($.trim(elm) != ''){ 
		            		value = '';
		            		$(elm).each(function(){
		            				
		            			if($.trim($(this).attr('type')) == 'checkbox' || $.trim($(this).attr('type')) == 'radio'){
		            				 
		            				if($(this).is(':checked')){
		            					value = true;
		            					return false;
		            				}else{
 		            					value = '';
		            				}
		            			}else{
		            				value = value +''+$.trim($(this).val());
		            			}

		            		});
 
		            		if( $.trim(value) == '' || (parseFloat(value) + 1)  == '1'){
		            			 
		            			$(parent).next('#error_line').html(error_msg).show();  
		            			$(elm).addClass('error_border');
		            		}else{
		            			$(elm).removeClass('error_border');
		            			$(parent).next('#error_line').hide();
		            		}

					
                   }
}

function validate_1(elm){
								if($.trim(elm.attr('one_is_required'))){
									one_required('#'+$.trim(elm.attr('id')),elm.attr('one_is_required'),elm.attr('error_empty_msg'));
								}else if($.trim(elm.attr('error_empty_msg'))){
								    empty_check($.trim(elm.attr('error_empty_msg')),elm.val(),elm);
								}
								if($.trim(elm.attr('pw_confirm'))){
									
									if($.trim(elm.val()) != $.trim($(elm.attr('pw_confirm')).val()) && $.trim($(elm.attr('pw_confirm')).val()) != ''){
										// passwords did not match 
		            					elm.next('#error_line:first').html('new password and confirm password did not match !').show();  // #error_line {border-botom: red 1px}
									}else{
										elm.next('#error_line:first').hide(); 
									}

								}
}	



// submit the form
function submit_form(form_id,file_name){
	data = {}	
	amount_data = {}
	error_validate = [];
	

					$('#'+form_id+' *').each(function(){
							validate_1($(this));	
						
					});

	                      $('#'+form_id+' .amount_t [name]').each(function(){
					            		name = $(this).attr('name');  // crf is inthe hidden feild
					             		
					            		if($.trim($(this).attr('type')) == 'radio' || $.trim($(this).attr('type')) == 'checkbox'){
					            			if($(this).is(':checked')){
					            				

														if (amount_data.hasOwnProperty(name)){
																	amount_data[name].push($(this).val());
														}else{
														        	amount_data[name] = Array($(this).val());
														}

 					            			}
					            		}else{
														if (amount_data.hasOwnProperty(name)){
																	amount_data[name].push($(this).val());
														}else{
														        	amount_data[name] = Array($(this).val());
														}
									    }
			            	 });
								


			            			$('#'+form_id+' [name]').each(function(){
					            		name = $(this).attr('name');  // crf is inthe hidden feild
					             		 
					            			data[name] = $(this).val();
					            		 

			            			});
						
            	 if($('input[name="balance"]').is(":visible")){
            	 		if($('input[name="balance"]').val().toString().includes('-')){
								error_validate['balance'] = 'on';
								error_func('Invalid paid or cost');
							}else{
							   delete  error_validate['balance'];
							}
            	    }


            	   if(Object.keys(error_validate).length == 0){
            			// send now
			            			
									loading_fun('start','');

	data['courses_data'] = amount_data;
 								 
			  			          $.post(file_name,{data}, function (feedback){
				  			          	login_ = $.trim(feedback).toLowerCase().replace(/ok/g , '');
				  			          	if(login_ == 'login' || $.trim(feedback) == ''){
                     						window.location.reload();
                    						}else{
		                    						loading_fun('stop',''); // finish the loading 
						 							if($.trim(feedback) == 'ok'){
						 								// success

						 								success_fun(' successfull !');
						 							    if(file_name.includes("settings")){
								 										window.location.reload();
								 								} 
						 							   request_template(current_open_page.position,current_open_page.data,current_open_page.file);
						 	         //    request_template(current_open_page.position,current_open_page.data,current_open_page.file);

						 								// refresh the last page 
						 							    // close the form 
						 							    $('#'+form_id).fadeOut();	
						 							}else{
						 								// error 
						 								if (feedback.includes("window.location.href")) {
															// nothing 
															success_fun(feedback);
															}else{
						 									error_func(feedback);
  
														}
						 							}
                    						}
					  			          
			 							}).error(function(){
			 								 window.location.reload();
			 							});

			            }else{
			            	window.location.href="#error_line";
			            	error_func('fill the required fields ');
			            } 
}




function floating_labels(f_label,status){
	if($.trim(status) == 'hide'){
	      f_label.removeClass('f_label_active').fadeOut();      			 
	}else{ 
		  $('.f_label_active').removeClass('f_label_active'); 
	      f_label.addClass('f_label_active').fadeIn();       
	}

}


	(function( $ ) {
 	form_status = '';
    $.fn.tee_form = function( action ) {

    	// if already tee form return false
    	if($.trim(this.attr('tee_form')) == 'true'){return false;}else{this.attr('tee_form','true');}



    	if(!this.is(':visible')){
    		this.fadeIn();  // must be visble for jquery ui checkbox 
    	}
    	if(!this.find('form')){
    		return false;  // must be visble for jquery ui checkbox 
    	} 
		//window.location.href='#'+this.parent().attr('id'); 

     //  this.find('*').after("<p id='error_line' class='hide'></p>");

 
this.find("input[format_comma='true']").input_comma_formated();
 	
// chosen 

 	 this.find(' select[remove_filter="true"]').chosen({"disable_search": true});
     this.find(' select').chosen({search_contains: true });




         //this.find("input['name']:first:visble").attr('autofocus');
            this.find('input[name]:visible:first').click();
 
            this.find('input[name]:visible:first').attr('autofocus');

 			this.find("input[format_comma='true']").input_comma_formated();
 			this.find("input[format_comma='true']").each(function(){ 
 						$(this).attr('autocomplete','off');
 					});
 			this.find("label").addClass('float_label').hide();

 			form_id = this.attr('id');

 			//this.dialog();
 			

 			file_name =  $('#'+form_id+' .submit_btn').attr('file_name');
 			$('#'+form_id).css('windth','auto !important');
        /*    $('#'+form_id+' *').blur(function(){
					validate_1($(this));	
			  });*/

            /*$('#'+form_id+' *').keyup(function(){
      					validate_1($(this));	
				});*/
 

            // submit
             $('#'+form_id+' .submit_btn').attr('form_id',form_id);
            $('#'+form_id+' .submit_btn').click(function(e){
				 submit_form($(this).attr('form_id'),$(this).attr('file_name')); 
					 
					 	e.preventDefault();
						return false;
            }).addClass('primary_button');
          // submit on enter
           $('#'+form_id+' *[name]').each(function(){
           	        $(this).attr('form_id',form_id).attr('file_name',file_name);
           				if($.trim($(this).attr('name')) == 'crf_code' || $.trim($(this).val()) == ''){ //  || $.trim($(this).attr('type')) != 'password'
	            		}else{
 					  floating_labels($(this).parent().find('label'),'show'); 

	            		}
            })
            $('#'+form_id+' *[name]').focus(function(){
					 floating_labels($(this).parent().find('label:first'),'show'); 
            }).blur(function(){
	            		if($.trim($(this).val()) == ''){
	            			floating_labels($(this).parent().find('label'),'hide'); 
	            		}
            });

                     $('#'+form_id+' input').keyup(function(e){
                     	e.preventDefault();
             	if(e.keyCode == 13){ // detect enter btn
             		 
						submit_form($(this).attr('form_id'),$(this).attr('file_name')); 
            	
            	}
            	 
				return false;
            });
    		this.find("input[type='checkbox'],input[type='radio']").checkboxradio();
  
    };
 
}( jQuery ));


 
