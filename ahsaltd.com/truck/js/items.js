function closeOrOpenItem(itemId,status,ItemName){

  
	   $('#warning').html('<img src="css/warning.png" alt="warning" style="border-radius:2.5em; width:80px; height:40px; margin-right: 4px; "/> '+condFunction( status == '0','Are you sure you whant to Open  <strong>'+ItemName+' </strong>? ','Are you sure you whant to Stop selling <strong>'+ItemName+' </strong> ? ')).dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Yes": function() {
							 // submit the ans-ware
							  $(this).dialog("close");
							  loading_func(); // SHOW LOADING IMAGE DIALOG  
							$.post('php_f/enableOrDisableItem.php', {itemId:itemId,status:status}, function(feedback_deleted_user) {					
								
								if(feedback_deleted_user == 1){ 
								 
								       Load_Items();
								  	if($("#loading").closest('.ui-dialog').is(':visible')) { 
								         $("#warning").dialog('close'); 
								          $("#loading").dialog('close'); 
										  success_func('<strong>Successfull</strong>'); 
									 }
								   
						 
								 }else{
								  $("#loading").dialog('close'); 
								  error_func(feedback_deleted_user);
								}
								
							});
							 
							 
							 
						 },
							
						"No": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
							
							
		    $('div [aria-describedby="warning"] div:first span').html(condFunction( status == '0','Opening ('+ItemName+')','Closing ('+ItemName+')')); 
 




return false;
}


// array sum 
function arraySumValues_j(array_po){
 var conf_total_price = 0;
 var data_length = array_po.length;	
 
				 for(i=0;i<data_length; i++){
				      //  conf_total_numberOfItem  += Number(number_of_itm_se[i]);
						conf_total_price    +=    Number(array_po[i]); 
				   }
				   
 
 return conf_total_price;
 
}


// get item  name
 
 function getItemName(item_iden){
   
   var allCategoryOfExpence = $("h5#itemNamesSelectOpiond").html();
            $("li#itemNamesSelect").html(allCategoryOfExpence); 
      var itemNAme = '';
	        $('div#add_new_item_div li#itemNamesSelect select option').each(function (){
			 var valueNow = $(this).val();
			 var iden = $(this).attr('itemId');
		 
			  if (jQuery.trim(iden) == item_iden){
		            itemNAme = valueNow;
				//	return false;
			  }
      
			 });
		 return itemNAme;
 
 }



 
  // editUniqueItemOrAdd
 function editUniqueItemOrAdd(item_id,itemName,description,singleProfit,whole_selling_price,single_selling_price){
 $("div#addUniqueItemOrEdit li#sellingPlane,div#addUniqueItemOrEdit li#sellPlan2,div#addUniqueItemOrEdit li#sellPlan1").remove(); 
 $("div#add_new_item_div li#sellingPlane,div#add_new_item_div li#sellPlan2,div#add_new_item_div li#sellPlan1").remove();
 //$("div#addUniqueItemOrEdit ul li#spl3").append('<li  style="display:none !important;"  id="sellingPlane">   </li>  li id="sellPlan2"> <label>Retail Price:  </label> <input type="text" id="Single_sell_Price"/>  + <input type="text" size="13" id="sl_benefit" /> = <b id="t_slPrice" style="font-weight:bold;">0</b></li>');
 $('div#addUniqueItemOrEdit li#sellingPlane').html('<label>selling plan 2:  </label>  <select  onchange="sellingPlanChoiseFunc2($(this).val())" id="sellingPlanChoise"  style="margin: 3px; width: 200px !important; display: ;"  ><option class="opt" >Retail</option>    <option class="opt" selected="selected">Wholesale</option> </select>');
   
//$('div#addUniqueItemOrEdit input[type="number"]').val('').removeAttr('style');
    $('#uniqueItemsName').val(itemName);
	$('#itemDescription').val(description);
	$('#product_price_edit').val(whole_selling_price);
	   var t_benefit = singleProfit;
		        
		 if(jQuery.trim(whole_selling_price) != '0'){
	
		  $("div#addUniqueItemOrEdit #Wholesale_price").val(whole_selling_price -  t_benefit); 
		  $('div#addUniqueItemOrEdit #wl_benefit').val(condFunction(!validate_number_value(t_benefit),0,t_benefit)).attr('befitWhole',condFunction(!validate_number_value(t_benefit),0,t_benefit));
		    $("div#addUniqueItemOrEdit #t_wlPrice").text(whole_selling_price);
			
			
		  $('div#addUniqueItemOrEdit li#sellingPlane').html('<label>selling plan:  </label>  <select id="sellingPlanChoise"  onchange="sellingPlanChoiseFunc2($(this).val())" style="margin: 3px; width: 200px !important; display: ;"  ><option class="opt" >Retail</option>    <option class="opt" selected="selected">Wholesale</option> </select>');
          $('div#addUniqueItemOrEdit li#sellingPlane select#sellingPlanChoise').chosen();
          $('div#addUniqueItemOrEdit li#sellingPlane').find('.chzn-search').remove();
          $("div#addUniqueItemOrEdit li#sellPlan2,div#addUniqueItemOrEdit li#sellPlan1").hide();   	
			
		 }else{
		   $("li#sellPlan1,li#sellPlan2").hide();  
	 
		   $("#t_wlPrice").text('0');
		 $('div#addUniqueItemOrEdit #wl_benefit').val('0').attr('befitWhole','0');
		 $("div#addUniqueItemOrEdit #Wholesale_price").val('0');
		 }
		
		if(jQuery.trim(single_selling_price) != '0'){
		   $("li#sellPlan1").hide();  
		   $("li#sellPlan2").show();    
		 $("div#addUniqueItemOrEdit #t_slPrice").text(single_selling_price);
		$("#Single_sell_Price").val(single_selling_price - t_benefit);
		$('div#addUniqueItemOrEdit #sl_benefit').val(condFunction(!validate_number_value(t_benefit),0,t_benefit)).attr('befitSingle',condFunction(!validate_number_value(t_benefit),0,t_benefit));
		

          $('div#addUniqueItemOrEdit li#sellingPlane').html('<label>selling plan:  </label>  <select id="sellingPlanChoise" onchange="sellingPlanChoiseFunc2($(this).val())" style="margin: 3px; width: 200px !important; display: ;"  ><option class="opt" selected="selected">Retail</option>    <option class="opt" >Wholesale</option> </select>');
          $('div#addUniqueItemOrEdit li#sellingPlane select#sellingPlanChoise').chosen();
          $('div#addUniqueItemOrEdit li#sellingPlane').find('.chzn-search').remove();
          $("li#sellPlan2,li#sellPlan1").hide();  

		}else{
		  $("li#sellPlan1,li#sellPlan2").hide();  
		  $("#t_slPrice").text('0');
		 $('#sl_benefit').val('0').attr('befitSingle','0');
		 $("#Single_sell_Price").val('0');
		 }
		 
		 sellingPlanChoiseFunc2($('div#addUniqueItemOrEdit li#sellingPlane select#sellingPlanChoise').val());
	
 
	
	  $('div#addUniqueItemOrEdit').dialog({  position: 'top', show: "blind", width:'auto', hide: "explode", modal: true, buttons:  {
							'Ok': function() {
						 var uniItemName	 =  $('#uniqueItemsName').val();
						 var description_    =  $('#itemDescription').val();
					     var sellingPlan     =  $('div#addUniqueItemOrEdit li#sellingPlane select#sellingPlanChoise').val();
						 
						 var Wholesale_price = parseFloat($('#product_price_edit').val().replace(/,/g, ''));	 
						 var Single_sell_Price = condFunction(jQuery.trim($('#t_slPrice').text())=="",0,$('#t_slPrice').text());	
						 
						 var whsBenefit  =   condFunction(jQuery.trim($('#wl_benefit').attr('befitWhole'))=="",0,Number($('#wl_benefit').attr('befitWhole')));
		                 var sgsBenefit  =   condFunction(jQuery.trim($('#sl_benefit').attr('befitSingle'))=="",0,Number($('#sl_benefit').attr('befitSingle')));
						
						 
						     if(jQuery.trim(uniItemName) == ''){
										error_func('Error Please Enter Item Name !!');	
										$('input#uniqueItemsName').css('border','2px groove red');
							    }else if(jQuery.trim(Wholesale_price) == ''){
										error_func('Error Please Enter price !');	
										$('input#product_price_edit').css('border','2px groove red');
							    }else{
								
 		   
							  loading_func(); // SHOW LOADING IMAGE DIALOG  
							   //  expenceName  numberOfExpence  expenceCost  expenceDate
                        // ,
							$.post('php_f/editUniqueItemOrAdd.php', {item_id:item_id,description_:description_,uniItemName:uniItemName,sellingPlan:sellingPlan,Wholesale_price:Wholesale_price,Single_sell_Price:Single_sell_Price,whsBenefit:whsBenefit,sgsBenefit:sgsBenefit}, function(feedback) {					
								
								if(feedback == 1){ 
								     Load_Items();
								 	if($("#loading").closest('.ui-dialog').is(':visible')) { 
									$('div#addUniqueItemOrEdit').dialog("close");
										  $("#loading").dialog('close');
										  success_func('<strong>Successfull</strong>'); 
									 } 
 
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
 			
        $('div [aria-describedby="addUniqueItemOrEdit"] div:first span').text(condFunction( item_id == 'add','Adding New Item..','Editing ('+itemName+') ..')); 
   
 
 
 }
 
 
 
// delete Received history

function deleteReceiveHistory(recId,itemidd){

  
	   $('#warning').html('<img src="css/warning.png" alt="warning" style="border-radius:2.5em; width:80px; height:40px; margin-right: 4px; "/>Are you Sure you want to delete Received <strong>'+getItemName(itemidd)+'</strong> ?').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Yes": function() {
							 // submit the ans-ware
							  $(this).dialog("close");
							  loading_func(); // SHOW LOADING IMAGE DIALOG  
							$.post('php_f/deleteReceivedITem.php', {recId:recId}, function(feedback_deleted_exp) {					
								
								if(feedback_deleted_exp == 1){ 
								   
								   Load_Items();
								 	if($("#loading").closest('.ui-dialog').is(':visible')) { 
									$('#warning').dialog("close");
										  $("#loading").dialog('close');
										  success_func('<strong>Successfull</strong>'); 
									 } 
						 
						 		 if($("#paid_history_table").closest('.ui-dialog').is(':visible')) { 
									$('#paid_history_table').dialog("close");
									 }
							
								 }else{
								  $("#loading").dialog('close'); 
								  error_func(feedback_deleted_exp);
								}
							
							});
							 
							 
							 
						 },
							
						"No": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
							
							
		    $('div [aria-describedby="warning"] div:first span').html('Deleting Received (<strong>'+getItemName(itemidd)+'</strong>)'); 
 

return false;
}




	// logo 	
function changeLogo(){

  // import data file upload
	 var options = { 
    beforeSend: function() 
    {
      var newEmail = $('#logoDivChange input[type="file"]').val();
							 
		  if(jQuery.trim(newEmail) == ''){
				  error_func('Error Choose File !!');
		     $('#logoDivChange input[type="file"]').css('border','2px groove red')
			   return false;
			  }else{
				 loading_func(); // SHOW LOADING IMAGE DIALOG  
		   }
    },
    uploadProgress: function(event, position, total, percentComplete) 
    {
 
    },
    success: function() 
    {
 
    },
	complete: function(response) 
	{
	
	  if(response.responseText == 1){ 
 
		   loadLogo();
			 if($("#loading").closest('.ui-dialog').is(':visible')) { 
				   $('#loading').dialog("close");
				  $("#logoDivChange").dialog('close');
				 success_func('<strong>Successfull</strong>'); 
			 } 
		 }else{
				 $("#loading").dialog('close'); 
				   error_func(response.responseText);	
		 }
	},
	error: function()
	{
 
	}
    
	}; 
 
 $("#logoDivChangeForm").ajaxForm(options);
  
 
  $('#logoDivChange input[type="file"]').removeAttr('style').val('');
  
$('#logoDivChange').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
				         "Cancel": function() {	 
								$(this).dialog("close");
							}
						},
							});
 
   $('div [aria-describedby="logoDivChange"] div:first span').html(' Changing Logo ..'); 
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
								  error_func('Enter store Contacts !');
								  $('#chageStoreName').css('border','2px groove red')
								 }else{
									  loading_func(); // SHOW LOADING IMAGE DIALOG  
				 
							 $.post('php_f/changeStoreContacts.php', {contacts:contacts}, function(storeResult) {					
										if(storeResult == 1){ 
										      Load_Items();
											 if($("#loading").closest('.ui-dialog').is(':visible')) { 
												  $('#loading').dialog("close");
												  $("#changeStoreName").dialog('close');
												  success_func('<strong>Successfull</strong>'); 
											   } 
								 
									   }else{
									    $("#loading").dialog('close'); 
										 error_func(storeResult);
									   }
						 	
							});
									
									
							  }
				 
 
							 
						 },
							
						"Cancel": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
 
   $('div [aria-describedby="changeStoreName"] div:first span').html(' changing Store Contacts '); 
 
 return false;
 }
 
 
 
 
 
  // send invoice  
 
 function sendInvoice(email,cusName,custId){
   $('#change_Email input,div#change_Email li.choisesInvoice,div#change_Email br').remove();
     $('#change_Email li label').text("Email").after('<input type="email" style=" width: 376;" id="emailChange" >');
  $('#change_Email li').after('<li class="choisesInvoice"> <form action=""> <label> <input type="radio" o="1"> All Items </label>    <label> <input type="radio"> Balance Items Only  </label> </form> </li>  <br><br>  <li class="choisesInvoice" > <label>Description:</label>   <textarea style="margin: 1.09375px; width: 509px; height: 163px; padding:5px;" ></textarea>   </li>');
  
//  $('#change_Email').append('<li class="choisesInvoice" > <label>Description:</label>   <textarea style="margin: 1.09375px; width: 509px; height: 163px; padding:5px;" ></textarea>   </li>');
  
  $('#emailChange').val(email).select().attr('type','email');
    $('#change_Email li.choisesInvoice input[type="radio"]').prop('checked', false); 

	var optionType = '';	
	   $('#change_Email li.choisesInvoice input[type="radio"]').click(function (){ 
				     var lOptionType = $(this).attr('o');
					
						if(lOptionType == '1'){
					optionType = 'all';
					    $('#change_Email li.choisesInvoice input[type="radio"]:last').prop('checked', false); 
						 }else{
					optionType = 'balance';
						    $('#change_Email li.choisesInvoice input[type="radio"]:first').prop('checked', false); 
						 }
	
        });
	
	
	
	
	
 
$('#change_Email').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Send": function() {
				 		//var optionType = condFunction($('#change_Email li.choisesInvoice input[type="radio"]').is(':checked'),'1','0')
				 
				 	          var newEmail = $('#emailChange').val();
							   var description = $('#change_Email li textarea').val();
								 if(jQuery.trim(newEmail) == ''){
								  error_func('Error Enter Email!');
								  $('#emailChange').css('border','2px groove red')
								 }else if(optionType == ''){
								   error_func('Error choose Invoice option !');
								   $('#change_Email li.choisesInvoice"').css('border','2px groove red')
								 }else{
									  loading_func(); // SHOW LOADING IMAGE DIALOG  
				 
							 $.post('php_f/sendInvoice.php', {description:description,optionType:optionType,newEmail:newEmail,custId:custId}, function(emailResult) {					
										if(emailResult == 1){ 
										      Load_Items();
											 if($("#loading").closest('.ui-dialog').is(':visible')) { 
												  $('#loading').dialog("close");
												  $("#change_Email").dialog('close');
												  success_func('The <stron>Invoice</stron> has been sent to  <strong>'+newEmail+' </strong> !'); 
											   } 
								 
									   }else{
									    $("#loading").dialog('close'); 
										 error_func(condFunction(emailResult.length == 94,'The was an Error for sending the Email please check your internet Connection .',emailResult) );
									   }
						 	
							});
									
									
							  }
				 
 
							 
						 },
							
						"Cancel": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
 
   $('div [aria-describedby="change_Email"] div:first span').html('Sending Invoice to ('+cusName+')'); 
 
 return false;
 }
 
 
 
 
 
// print  options   (all items \ only balance items )

function printOptions(custName){
    $('#printInvoiceOptions li input[type="radio"]').prop('checked', false); 

	var optionType = '';	
	   $('#printInvoiceOptions li input[type="radio"]').click(function (){ 
				     var lOptionType = $(this).attr('z');
						if(lOptionType == '1'){
					optionType = 'all';
					    $('#printInvoiceOptions li input[type="radio"]:last').prop('checked', false); 
						 }else{
					optionType = 'balance';
						    $('#printInvoiceOptions li input[type="radio"]:first').prop('checked', false); 
						 }
	
        });
 
$('#printInvoiceOptions').dialog({  show: "blind", hide: "explode", width: '500',  height:'auto',  modal: true, buttons:  {
							"Okay": function() {
				 		 
				 	          if(optionType == ''){
								   error_func('Error choose Invoice option !');
								   $('#printInvoiceOptions li"').css('border','2px groove red')
								 }else{ 		
								// call print function 	
						 
								var  item_name =  Array();
								var  typeOfSell = Array();
								var	 number_of_item =  Array();
								var	 discount   =  Array();
								var	 price   =  Array();
								var	 paid =  Array();
								var	 balance  =  Array();
								var	 date =  Array();
									 
						 
							var itemLenth = $("div#moreDitails_of_cust_no_bal table tr td.it1").length;
							
							 $("div#moreDitails_of_cust_no_bal table tr td.it1").each(function (){ // itemName
							    item_name.push($(this).text());
							 });
							 
							  $("div#moreDitails_of_cust_no_bal table tr td.it3").each(function (){ // number of item 
							    number_of_item.push($(this).attr('number_of_item'));
							 });
							 
							   $("div#moreDitails_of_cust_no_bal table tr td.it4").each(function (){ // discount 
							    discount.push($(this).attr('discount'));
							 });
							 
							    $("div#moreDitails_of_cust_no_bal table tr td.it5").each(function (){ // price 
							    price.push($(this).attr('price'));
							   });
							   
							       $("div#moreDitails_of_cust_no_bal table tr td.it6").each(function (){ // paid 
							    paid.push($(this).attr('paid'));
							   });

							   
							       $("div#moreDitails_of_cust_no_bal table tr td.it7").each(function (){ // balance 
							    balance.push($(this).attr('blance'));
							   });
							   
							      $("div#moreDitails_of_cust_no_bal table tr td.it9").each(function (){ // date 
							    date.push($(this).text());
							   });
							   
						 
							if( item_name.length != itemLenth ||  number_of_item.length != itemLenth){
							
							}else if(discount.length != itemLenth || price.length != itemLenth){
							
							}else if(paid.length != itemLenth || balance.length != itemLenth){
							
							}else if(date.length != itemLenth  ){
							
							}else{
							 
									 if(optionType == 'balance' && arraySumValues_j(balance)=='0'){
										  error_func('There is no balance Items for <strong>'+custName+'</strong>!');
										}else{
											 if(optionType == 'balance'){
											 print_Items(custName,item_name,number_of_item,discount,price,paid,balance,date,'balance'); // Print
											 }else{
											 print_Items(custName,item_name,number_of_item,discount,price,paid,balance,date,''); // Print
											 
											 }
										} 
							  }	
 
							  
								 }
				 
 
							 
						 },
							
						"Cancel": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
 
$('div [aria-describedby="printInvoiceOptions"] div:first span').html('Printing Invoice for ('+custName+')'); 
 
 return false;
} 
 
 
 
 
 
 
 
// delete  something 

function deleteSomething(fileName,del_id,w_msg,title){

  
	   $('#warning').html('<img src="css/warning.png" alt="warning" style="border-radius:2.5em; width:80px; height:40px; margin-right: 4px; "/>'+w_msg+'').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Yes": function() {
							 // submit the ans-ware
							  $(this).dialog("close");
							  loading_func(); // SHOW LOADING IMAGE DIALOG  
							$.post('php_f/'+fileName, {del_id:del_id}, function(feedback_deleted_exp) {					
								
								if(feedback_deleted_exp == 1){ 
								   
								   Load_Items();
								 	if($("#loading").closest('.ui-dialog').is(':visible')) { 
									$('#warning').dialog("close");
										  $("#loading").dialog('close');
										  success_func('<strong>Successfull</strong>'); 
									 } 
						 
						 		 if($("#paid_history_table").closest('.ui-dialog').is(':visible')) { 
									$('#paid_history_table').dialog("close");
									 }
							
								 }else{
								  $("#loading").dialog('close'); 
								  error_func(feedback_deleted_exp);
								}
							
							});
							 
							 
							 
						 },
							
						"No": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
							
							
		    $('div [aria-describedby="warning"] div:first span').html(title); 
 

return false;
}

 
 
 
 
  // edite schedule or add
  
 function diteScheduleOradd(userName,id,date,description,address,mode){
 	$('div#addScheduleOrEdit input[type="text"]').val('').css('border','2px groove none');
    $('div#addScheduleOrEdit textarea').val('');
 
    $('#dateSchedule').val(date);
    $('#addressSchedule').val(address);
	$('#commentSchedule').val(description);   
	
	  $('div#addScheduleOrEdit').dialog({  position: 'top',show: "blind", width:'auto', hide: "explode", modal: true, buttons:  {
							'Ok': function() {
								var dateSchedule  =  $('#dateSchedule').val();
								var addressSchedule  =  $('#addressSchedule').val();
								var commentSchedule  =  $('#commentSchedule').val();  
						
						     if(jQuery.trim(dateSchedule) == ''){
										error_func('Error Please Enter  Date !!');	
										$('input#dateSchedule').css('border','2px groove red');
							    }else if(jQuery.trim(addressSchedule) == ''){
									    error_func('Error Please Enter Address !!');	
										$('input#addressSchedule').css('border','2px groove red');
								}else{
								
 		   
							  loading_func(); // SHOW LOADING IMAGE DIALOG  
							   //  expenceName  numberOfExpence  expenceCost  expenceDate
                        // ,
							$.post('php_f/editOrAddSchedul.php', {mode:mode,dateSchedule:dateSchedule,addressSchedule:addressSchedule,commentSchedule:commentSchedule,id:id}, function(feedback) {					
								
								if(feedback == 1){ 
								     Load_Items();
								 	if($("#loading").closest('.ui-dialog').is(':visible')) { 
									$('div#addScheduleOrEdit').dialog("close");
										  $("#loading").dialog('close');
										  success_func('<strong>Successfull</strong>'); 
									 } 
 
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
 			
        $('div [aria-describedby="addScheduleOrEdit"] div:first span').text(condFunction( mode != 'e','Adding New Schedule..','Editing Schedule for ('+userName+') ..')); 
   
 
 
 }
 
  
 
// readMore
function readMore(comment,title){

  
	   $('#reaMore').html(comment).dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Okay": function() {
					         // done reading 
							  $(this).dialog("close"); 	 
						 }},
			   
							
							});
							
							
		    $('div [aria-describedby="reaMore"] div:first span').html(title); 
 


return false;
}
 
 
 
 