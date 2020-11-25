// choose expence category
function chooseExpCategory(chosenType){
        //var chosenType = 
         var allCategoryOfExpence = $("h5#expCAtgry").html();
		 if(chosenType == "New"){
		  $(this).removeClass("chosenExpencType");
		  $("li#expncType input[type='text']:first").fadeIn().addClass("chosenExpencType").focus();
		 }else{
		  $(this).addClass("chosenExpencType");
		  $("li#expncType input[type='text']:first").fadeOut().removeClass("chosenExpencType");
		 }
 return false;
 }
 
 
  // edit depsit Cash 
 function editExpenceOrAdd(expence_id,expenceName,numberOfExpence,cost,expencetype){
          
	   var allCategoryOfExpence = $("h5#expCAtgry").html();
            $("li#expncType").html(allCategoryOfExpence); 
 
     if(expence_id == 'add'){
      $("li#expncType select").chosen();
	  }else{
	  
	  
	        $("li#expncType select option").each(function (){
			 var valueNow = $(this).val();
			  if (jQuery.trim(valueNow) == jQuery.trim(expencetype) ){
			   $(this).attr("selected","selected");
			    $("li#expncType select").chosen();
				return false;
			  }
 
			 });
  
	 }

	        $("li#expncType select").change(function (){ chooseExpCategory($(this).val());});		
	
 
	$('div#add_or_editExpence input[type="text"]').val('').removeAttr('style');
	   $("li#expncType input[type='text']:first").fadeOut().removeClass("chosenExpencType");
    
        $("li#expncType select").addClass("chosenExpencType");
	    $('#expenceName').css("width",'270px');
		
 	  $('#expenceName').val(expenceName);
	  $('#numberOfItems').val(CommaFormattedN(numberOfExpence));
	  $('#expenceCost').val(CommaFormattedN(cost));
	  $('div#add_or_editExpence').attr('style',' height:500px !important; width:596px !important;'); 
	  $('div#add_or_editExpence').dialog({  position: 'top',show: "blind", width:'596px', hide: "explode", modal: true, buttons:  {
							'Ok': function() {
						 var expenceName	   =  $('#expenceName').val();
						 var numberOfItems	   =  parseFloat($('#numberOfItems').val().replace(/,/g, ''));
						 var expenceCost	   =  parseFloat($('#expenceCost').val().replace(/,/g, '')); 
				         var chosenExpnctype   =  $("li#expncType .chosenExpencType").val();
						 
							   if(jQuery.trim(expenceName) == ''){
										error_func('Error Please Enter Expence Name !!');	
										$('input#expenceName').css('border','2px groove red');
								}else  if(jQuery.trim(numberOfItems) == ''){
										error_func('Error Please Enter Number of Items !!');	
										$('input#numberOfItems').css('border','2px groove red');
								}else  if(jQuery.trim(expenceCost) == ''){
										error_func('Error Please Enter Cost !!');	
										$('input#expenceCost').css('border','2px groove red');
								}else if(jQuery.trim(chosenExpnctype) == ''){
										error_func('Error Please Enter Expence Type or choose from the list !!');	
										$('input.chosenExpencType').css('border','2px groove red');
								}else if(chosenExpnctype == 'choose..'){
										error_func('Error Please Enter Expence Type or choose from the list !!');	
										//$('input.chosenExpencType').css('border','2px groove red');
								}else{
 		   
							  loading_func(); // SHOW LOADING IMAGE DIALOG  
							   //  expenceName  numberOfExpence  expenceCost  expenceDate
                                     


                   							 
							$.post('php_f/addExpenceOrEdit.php', { chosenExpnctype:chosenExpnctype, expence_id:expence_id, expenceName:expenceName, numberOfItems:numberOfItems, expenceCost:expenceCost}, function(feedback_addOrEdit_expence) {					
								
								if(feedback_addOrEdit_expence == 1){ 
								     Load_Items();
								 	if($("#loading").closest('.ui-dialog').is(':visible')) { 
									$('#add_or_editExpence').dialog("close");
										  $("#loading").dialog('close');
										  success_func('<strong>Successfull</strong>'); 
									 } 
 
								 }else{
								  $("#loading").dialog('close'); 
								  error_func(feedback_addOrEdit_expence);
								}
								
							});
							 
								 }
							
							 
							 
						 },
							
						"Cancel": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
	    $('div#add_or_editExpence').attr('style',' height:500px !important; width:596px !important;'); 				
        $('div [aria-describedby="add_or_editExpence"] div:first span').text(condFunction( expence_id == 'add','Adding New Expense..','Editing ('+expenceName+') ..')); 
   
 
 
 }
 
 
 
 
 // delete Expence 
 function deleteExpence(expenceId,expenceName){
 
 
 	   $('#warning').html('<img src="css/warning.png" alt="warning" style="border-radius:2.5em; width:80px; height:40px; margin-right: 4px; "/>Are you Sure you want to delete <strong>'+expenceName+'</strong> ?').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Yes": function() {
							 // submit the ans-ware
							  $(this).dialog("close");
							  loading_func(); // SHOW LOADING IMAGE DIALOG  
							$.post('php_f/delete_Expence.php', {expenceId:expenceId}, function(feedback_deleted_expence) {					
								
								if(feedback_deleted_expence == 1){ 
								 
								       Load_Items();
								  	if($("#loading").closest('.ui-dialog').is(':visible')) { 
								         $("#warning").dialog('close'); 
								          $("#loading").dialog('close'); 
										  success_func('<strong>Successfull</strong>'); 
									 }
								   
						 
								 }else{
								  $("#loading").dialog('close'); 
								  error_func(feedback_deleted_expence);
								}
								
							});
							 
							 
							 
						 },
							
						"No": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
							
							
		    $('div [aria-describedby="warning"] div:first span').html('Deleting <strong>'+expenceName+'</strong>'); 
 
 
 
 return false;
 }
 
 
 

 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
