

function empty_check(error_empty_msg,val,elm){
					el_name = $.trim(elm.attr('name'));
        			val = $.trim(val).toLowerCase();
            	if($.trim(error_empty_msg) !='' && val == '' || val == '..' || val == '0' || val == '0.00' || val == 'choose..'){
            		// error empty 
            		elm.parent().find('.'+el_name+'_error').html(error_empty_msg).show();  // #error_line {border-botom: red 1px}
            	}else{
            		elm.parent().find('.'+el_name+'_error').hide(); 
            	}
  }

  // atleast on is required
function one_required(parent,elm,error_msg){
				 el_name = $.trim(elm.attr('name'));

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
									
									if($.trim(elm.val()) != $.trim($(elm.attr('pw_confirm')).val())){
										// passwords did not match 
		            					elm.next('#error_line:first').html(error_empty_msg).show();  // #error_line {border-botom: red 1px}
									}else{
										elm.next('#error_line:first').hide(); 
									}

								}
}	



data = {}	
// submit the form
function submit_form(form_id,file_name){
						$('#'+form_id+' *').each(function(){
							validate_1($(this));	
						
					});


										
			            			$('#'+form_id+' [name]').each(function(){
					            		name = $(this).attr('name');  // crf is inthe hidden feild
					             		
					            		if($.trim($(this).attr('type')) == 'radio' || $.trim($(this).attr('type')) == 'checkbox'){
					            			if($(this).is(':checked')){
					            				data[name] = ($(this).attr('format_comma'))?$(this).val().replace(/,/g , ''):$(this).val();
					            			 
					            			}
					            		}else{
					            				data[name] = ($(this).attr('format_comma'))?$(this).val().replace(/,/g , ''):$(this).val();
					            		}

			            			});

            	   if(!$('#'+form_id+' #error_line').is(':visible')){
            			// send now
			            			
									loading_fun('start','');		
			  			          $.post(file_name,{data}, function (feedback){
				  			          	login_ = $.trim(feedback).toLowerCase().replace(/ok/g , '');
				  			          	if(login_ == 'login'){
                     						window.location.reload();
                    						}else{
		                    						loading_fun('stop',''); // finish the loading 
						 							if($.trim(feedback) == 'ok'){
						 								// success
						 														 							    $('.forms_container').fadeOut();	
						 							    $('.forms_container').fadeOut();	

						 								success_fun(' successfull !');
						 														 							    $('.forms_container').fadeOut();	
						 								// refresh the last page 
						 							    request_template(current_open_page.position,current_open_page.data,current_open_page.file);
						 							    // close the form 

						 							}else{
						 								// error 
						 								error_func(feedback);
						 							}
                    						}
					  			          
			 							}).error(function(){window.location.reload();});

			            }else{
			            	window.location.href="#error_line";
			            	error_func('fill the required fields ');
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
		window.location.href='#'+this.parent().attr('id'); 

 

 			// if checked by default 
 	/*		this.find("input[type='checkbox'],input[type='radio']").each(function(){
				if($(this).attr('selected')){
					$(this).prop('checked', true);
					$(this).click();
				}		

 			});*/

 			this.find("input[type='checkbox'],input[type='radio']").checkboxradio();


 			this.find("input[format_comma='true']").input_comma_formated();

 			form_id = this.attr('id');
 			this.attr('autocomplete','on');
            $('#'+form_id+' *').blur(function(){
					validate_1($(this));	
			  });

            $('#'+form_id+' *').keyup(function(){
      					validate_1($(this));	
				});


            // submit
            $('#'+form_id+' .submit_btn').click(function(e){
						submit_form(form_id,$(this).attr('file_name')); 
					 	
					 	e.preventDefault();
						return false;
            });
          // submit on enter
            $('#'+form_id+' input').keyup(function(e){
             	if(e.keyCode == 13){ // detect enter btn
             		 
						submit_form(form_id,$('#'+form_id+' .submit_btn').attr('file_name')); 
            	e.preventDefault();
            	}
            	 
				return false;
            });
      

    };
 
}( jQuery ));





/*
- validate // checks onblur() // it gets the errors from input attr
 	- if error is exists:
 		- dispaly error massage at bottom of the input field with red color,give border-bottom:1px solid red; // horizantal bottom line border the input field
 	- if no error :
 		- remove red border color at bottom and hide error massage at bottom of input	


- submit //
	- get file.php in the attr for submit file 
	- then send the data to server side*/



	/*  

	<form action='#'>
		<ul>
		<li> 
		<input type="hidden" name="crf_token">
		<label for="amount">Amount:</label>
		<input type="text" name="amount" error_empty_msg="amount is required " required></li>
			<p class="error_line"></p>

		

		</ul>
		

		<input type="submit" file_name="add_trans.php"  value="submit" >
	</form>
 






	*/