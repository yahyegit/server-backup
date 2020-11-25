  $('document').ready(function (){ 
 
 // import data file upload
	 var options = { 
    beforeSend: function() 
    {
      var newEmail = $('#importDataBaseDiv input[type="file"]').val();
							 
		  if(jQuery.trim(newEmail) == ''){
				  error_func('Error Choose File !!');
		     $('#importDataBaseDiv input[type="file"]').css('border','2px groove red')
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
	
	  if(response == 1){ 
 
		     Load_Items();
			 if($("#loading").closest('.ui-dialog').is(':visible')) { 
				   $('#loading').dialog("close");
				  $("#importDataBaseDiv").dialog('close');
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
 
	  $("#form_importDataBase").ajaxForm(options);
  
   // add new Custom
	$('button.add_new_cust').click(function (){
	  add_to_sell_theCurrent_cus('0','','-','','');
	 });
	 
   $('#other_detials_').accordion({
   fillSpace:true,
    icons:{"header": "ui-icon-plus","headerSelected":"ui-icon-minus"},  collapsible:true,active:2});
 
  $('input[date="daidline"],input[date="daidline_"],#deadline_edit').datepicker({dateFormat:'dd-M-yy', minDate:0});
 
 
 $('#allow_sms_').change(function (){
	 var value_chak =  $(this).val();
	 if(value_chak == 'off'){
	 $(this).val('on');
	 
	 
		 var all_msg =  $(this).attr('old');
		 if(jQuery.trim(all_msg) == ''){
		 $('#message_1').removeAttr('disabled').focus().attr('placeholder','enter message here..').css('background','#fff');	
		 }else{  
		 $('#message_1').val(all_msg).removeAttr('disabled').focus().css('background','#fff');
		 }
	 
	 }else{
	$(this).val('off');
     var all_msg =  $('#message_1').val();
	  $('#message_1').val('');
	 $(this).attr('old',all_msg);
	 $('#message_1').attr('disabled','disabled').removeAttr('placeholder').css('background','gray');
	 }
 
 });
   
  // allow sms for updating

	$('button#add_more_sell2').click(function (){
	
	var itNmes__  = $('h5#max_select_ch').attr('heddenSelet');
     $('#max_select_ch').html(itNmes__);	
     $('#max_select_ch select').removeAttr('selectname');

	 
	 
	  var chack_max_select_ =   parseFloat($('h5#max_select_ch select option').length);	
	  var current_count_colle = $('#tabes_handler_ li').length;
 
     var chack_max_select = chack_max_select_ - 1; 
 
if(chack_max_select  == current_count_colle){
//return false;
}		

if(chack_max_select  ==  1){
//return false
}



	 
		var chosen_class  = $('select[selectName="itemName_"]').attr('class');  
		var items_name_for_select  = $('select[selectName="itemName_"]').attr('class','').outerHTML();  
		  var other_ditails_ = $('div#otherDetails_accordion_').attr('others_'); 	
		 $('select[selectName="itemName_"]').attr('class',chosen_class);
		
		var all_contents_sell = $('#tab__ ul').outerHTML();	
		var current_count = $('#tabes_handler_ li').length;
		var next_count  =  current_count + 1;
		
 
   
		 $('#tabes_handler_').append('<li id="tab__linkId_'+next_count+'" ><a href="#tab__'+next_count+'"  id="tab__link__'+next_count+'">Item '+next_count+' </a></li>');	 
		 $('#tabs_sell_').append('<div id="tab__'+next_count+'" class="sells_div_"> '+all_contents_sell+' </div>');
		
		 // insert tab id into each element in that tab 
		 $('div#tab__'+next_count+' * ').attr('tab_id_','tab__link__'+next_count+'');
		 
		  
		 $('#tab__'+next_count+' #list_itemn_').html('<label id="l">Item Name:</label>'+items_name_for_select).next().html('	<label>Type of Sell : </label><select class="chosen" id="payment_type_" style="width:200px  !important; margin:3px"><option class="opt">choose ..</option></select>');
	    $('#tab__'+next_count+' #list_itemn_ select').removeAttr('id');
	   $('#tab__'+next_count+'  #other_detials_').html(other_ditails_);
	  $('#tab__'+next_count+' #cunstname').text('');
	    $('#tab__'+next_count+' #mobile_li_').text('');
	 
		  $('#tab__'+next_count+' #newDeposit_li_').text('');
		  
       $('div#tab__'+next_count+' select , #tab__'+next_count+'  #other_detials_ * ').attr('tab_id_','tab__link__'+next_count+'');
	   
	     $('#tab__'+next_count+'  #other_detials_').accordion({
          fillSpace:false,
              icons:{"header": "ui-icon-plus","headerSelected":"ui-icon-minus"},  collapsible:true,active:2});  
	
    $('#tab__'+next_count+' li#daidsel_ input').attr('class','').attr('datepicter_','datepic_'+next_count);
 
  $('#tab__'+next_count+' li#daidsel_ input[date="daidline_"]').removeClass('hasDatepicker').removeAttr('id').datepicker({dateFormat:'dd-M-yy',minDate:0});	 
 //$('.deadlin:last').clone(false).removeClass('hasDatepicker').insertAfter('.deadlin:last').datepicker();
	 $('#tab__'+next_count+'  #other_detials_ input').change(function (){
	 var value_chak =  $(this).val();
	 if(value_chak == 'off'){
	 $(this).val('on');
	 
	 
		 var all_msg =  $(this).attr('old');
		 if(jQuery.trim(all_msg) == ''){
		 $('#tab__'+next_count+'  #message_1').removeAttr('disabled').focus().attr('placeholder','enter message here..').css('background','#fff');	
		 }else{  
		 $('#tab__'+next_count+'   #message_1').val(all_msg).removeAttr('disabled').focus().css('background','#fff');
		 }
	 
	 }else{
	  $(this).val('off');
       var all_msg =  $('#tab__'+next_count+'  #message_1').val();
	  $('#tab__'+next_count+'   #message_1').val('');
	 $(this).attr('old',all_msg);
	 $('#tab__'+next_count+'   #message_1').attr('disabled','disabled').removeAttr('placeholder').css('background','gray');
     }
 });
	
	
	
	
	   
	   // remove button 
	    $('div#tab__'+next_count+'').append('<button his_tabId="tab__'+next_count+'"   tabLinliId="tab__linkId_'+next_count+'"  id="remove_tab__but2" > remove </button>');
 
 
$('button#remove_tab__but2').button(
	  {
	    height:'10px',
		icons: {primary: 'ui-icon-circle-delete', secondary: null}
	  }
	).css('font-size','10px');
	
	  
	  $('#tab__'+next_count+' select').data("placeholder","Select item name...").chosen();
        $("div#tabs_sell_").tabs("refresh");
     //  $('#tab__'+next_count+' #list_itemn_').next().find('.chzn-search').remove();
		// reset price and balance 
 
         $('div#tab__'+next_count+' #price_').attr('price_','').text('0');	 
		 $('div#tab__'+next_count+' p#balance_').attr('balance_','').text('0');	 
		 
       $('div#tab__'+next_count+' select[selectName="itemName_"]').change(function (){
		   
		   if($(this).val() !='choose..'){ // change tab text to item name
	 $('#tabes_handler_ a#tab__link__'+next_count+'').html($(this).val());
}	
		   
		   
			  var element = $(this).find('option:selected'); 
			  var singleSele_price = element.attr('singleSele');
			  var wholseSell_price = element.attr('wholesell');
			  var numbrOfremaining_Items1 = element.attr('remaining_Items');
			    var maxDiscount = element.attr('maxDiscount');
		         var sigleSell =  "<option class='opt' singleSell="+element.attr('singleSele')+"  item_id_="+element.attr('item_id_')+"  singleSell_out="+ element.attr('singleSele_out') +"  > Retail </option>"; 
				 var wholseSell  = "<option class='opt' wholseSell="+element.attr('wholeSell')+"  item_id_="+element.attr('item_id_')+"   wholeSell_out="+element.attr('wholeSell_out')+" > WholeSell  </option>";
		 
	 
		 if (singleSele_price == 0){
		sigleSell = '';
		 }
		 if (wholseSell_price  == 0){
		 wholseSell ='';
		 }
	    if($(this).val() == 'choose..'){
		 sigleSell = '';
		 wholseSell = '';
	 }
	
		                    if(maxDiscount == '0'){
							    $('div#tab__'+next_count+' #discountOpoionMax').hide();
							   }else{
							    $('div#tab__'+next_count+' #discountOpoionMax').show();
							   }
							   
	
		  $('div#tab__'+next_count+' select#payment_type_').next().remove();
		  $('div#tab__'+next_count+' select#payment_type_').html( '<option class="opt">choose ..</option> ' +sigleSell + wholseSell);
		  $('div#tab__'+next_count+' select#payment_type_').attr('class','').chosen();
		   $('div#tab__'+next_count+' input#number_of_itm_').attr('remainingItms',numbrOfremaining_Items1);
		     
		   $('div#tab__'+next_count+'  #remaining_items_sell').text(CommaFormattedN(numbrOfremaining_Items1)+'  '); 

		    $('#tab__'+next_count+' #list_itemn_').next().find('.chzn-search').remove();
		  
		  
		   $('div#tab__'+next_count+' select#payment_type_ option:last').attr('selected','selected');  // force to select last option 		
				  
					     var element2 =    $('div#tab__'+next_count+' select#payment_type_').find('option:selected'); 
					     var paymnt_value = $('div#tab__'+next_count+' select#payment_type_').find('option:selected').val();
					 
					 if(paymnt_value == 'Retail'){   
					     var singleSele_price2 = element2.attr('singleSell'); 
						 var singleSele_out2 = element2.attr('singleSell_out');
						
						 var item_id_ = element2.attr('item_id_');  
							   
						 $('div#tab__'+next_count+' #price_').attr('maxDiscount',maxDiscount).attr('item_nam',item_id_).attr('price_',singleSele_price2).val(singleSele_out2).attr('oringinal_price',singleSele_price2);
						 	// reset fields
							$('div#tab__'+next_count+' #number_of_itm_').val('');
							$('div#tab__'+next_count+' #discount_').val('').attr('modified_price',maxDiscount);
							$('div#tab__'+next_count+' #paid_').val('');
							   $('div#tab__'+next_count+' p#balance_').attr('balance_',singleSele_price2).text(singleSele_out2);	
							   
						
							  
							   
							   
						}else if (paymnt_value == 'WholeSell'){
						  
					   	  var wholseSell_price2 = element2.attr('wholseSell');
						  var wholseSell_out2 = element2.attr('wholeSell_out');
						  var item_id_2 = element2.attr('item_id_'); 
						  $('div#tab__'+next_count+' #price_').attr('maxDiscount',maxDiscount).attr('item_nam',item_id_2).attr('price_',wholseSell_price2).val(wholseSell_out2).attr('oringinal_price',wholseSell_price2);
						  	// reset fields
							$('div#tab__'+next_count+' #number_of_itm_').val('');
							$('div#tab__'+next_count+' #discount_').val('').attr('modified_price',maxDiscount);
							$('div#tab__'+next_count+' #paid_').val('');
							   $('div#tab__'+next_count+' p#balance_').attr('balance_',wholseSell_price2).text(wholseSell_out2);	
							   
						    
						}else if(paymnt_value == 'choose ..'){
						  $('div#tab__'+next_count+' #price_').attr('price_','').val('0');	 
		                   $('div#tab__'+next_count+' p#balance_').attr('balance_','').text('0');	
						}
					  
					 

		  
		       });
 
 
 
 
 // when  remove button has been clicked 
			$('div#tab__'+next_count+' button#remove_tab__but2').click(function (){ 
				  var tabID = $(this).attr('his_tabId');
				  var tabLinkId = $(this).attr('tabLinliId');
				$('#tabs_sell_ div.sells_div_').last().remove();	
				  $('#tabes_handler_ li').last().remove();	
		         var last_tab__id = $('#tabes_handler_ li a').last().attr('id');
	 
                    //document.getElementById(last_tab__id).click();
				    $('#tabes_handler_ li a').last().click(); 
			  });

 
				        // auto calculate  balance_  and price_ by using number of items
						$('div#tab__'+next_count+' #number_of_itm_').keyup(function (){
							
						 
						 		 var discount_auto_dis = $('div#tab__'+next_count+' #discount_').val();
								 var paid_auto_paid = $('div#tab__'+next_count+' #paid_').val();
								 
								 if(jQuery.trim(discount_auto_dis) == ''){   
								 discount_auto_dis = 0;
								 }else if (!validate_number_value2(discount_auto_dis)){
								 discount_auto_dis = 0;
								 }
						 					    
								 if(jQuery.trim(paid_auto_paid) == ''){   
								 paid_auto_paid = 0;
								 }else if (!validate_number_value2(paid_auto_paid)){
								 paid_auto_paid = 0;
								 }
						 

						 
								        var remainingItms_ = parseFloat($(this).attr('remainingItms'));
										var current_price  = parseFloat($('div#tab__'+next_count+' #price_').attr('oringinal_price'));
										var numofimtsValue = parseFloat($(this).val());
										var maxDiscunt  =  parseFloat($('div#tab__'+next_count+' #price_').attr('maxDiscount')); 
							 
							 	  if(jQuery.trim($(this).val()) == ''){   
								 numofimtsValue = 1;
								 }
							 
							 
									if(!validate_number_value2(numofimtsValue) || !validate_number_value2(remainingItms_) || !validate_number_value2(current_price) ){
									}else{ 
								
										var current_total_price = numofimtsValue * current_price;
										var current_total_blance = current_total_price - paid_auto_paid;
	   
									    $('div#tab__'+next_count+'  #price_').val(parseFloat(Math.round(current_total_price * 100) / 100).toFixed(2));
										$('div#tab__'+next_count+'  #balance_').text(CommaFormattedN(current_total_blance)).attr('balance_',current_total_blance);
										$('div#tab__'+next_count+' #paid_').attr('current_price',current_total_price);
						                $('div#tab__'+next_count+' #discount_').attr('modified_price',(numofimtsValue * maxDiscunt));
										
										 if(jQuery.trim($(this).val()) == ''){   
											 numofimtsValue = 0;
											 }
								 
										$('div#tab__'+next_count+' #remaining_items_sell').text(CommaFormattedN(remainingItms_ - numofimtsValue) + '  '); 

									}
							});
					
						
	
	
				        // auto calculate  balance_  and price_ by using discount_ 
						$('div#tab__'+next_count+' #discount_').keyup(function (e){
							
						  if(e.keyCode == '9'){
									   return false;
									}
						 
								 var paid_auto_paid_d = $('div#tab__'+next_count+' #paid_').val();
								 
					 
						 					    
								 if(jQuery.trim(paid_auto_paid_d) == ''){   
								 paid_auto_paid_d = 0;
								 }else if (!validate_number_value2(paid_auto_paid_d)){
								 paid_auto_paid_d = 0;
								 }
						 

						 
								        var discount__dis_d = parseFloat($(this).val());
										var current_price_d  = parseFloat($('div#tab__'+next_count+' #price_').attr('oringinal_price'));
										var numofimtsValue_d = parseFloat($('div#tab__'+next_count+' #number_of_itm_').val());
										
							  if(jQuery.trim($(this).val()) == ''){   
								 discount__dis_d = 0;
								 }
								 
									if(!validate_number_value2(numofimtsValue_d) || !validate_number_value2(discount__dis_d) || !validate_number_value2(current_price_d) ){
									}else{
										var current_total_price_d = (numofimtsValue_d * current_price_d) - discount__dis_d;
										var current_total_blance_d = current_total_price_d - paid_auto_paid_d;

									    $('div#tab__'+next_count+' #price_').val(current_total_price_d);
										$('div#tab__'+next_count+' #balance_').text(CommaFormattedN(current_total_blance_d)).attr('balance_',current_total_blance_d);
										$('div#tab__'+next_count+' #paid_').attr('current_price',current_total_price_d);
										 
									}
							});
					
						
	                      // auto calculate  balance_  and price_ by using paid_ 
						$('div#tab__'+next_count+' #paid_').keyup(function (){
							
						 
						 		 var discount_auto_dis_ = $('div#tab__'+next_count+' #discount_').val();
								  
								 
								 if(jQuery.trim(discount_auto_dis_) == ''){   
								 discount_auto_dis_ = 0;
								 }else if (!validate_number_value2(discount_auto_dis_)){
								 discount_auto_dis_ = 0;
								 }
						 					    
 
								        var paid___p = parseFloat($(this).val());
										var current_price_p  = parseFloat($('div#tab__'+next_count+' #price_').val());
										var numofimtsValue_p = parseFloat($('div#tab__'+next_count+' #number_of_itm_').val());
							  
							  if(jQuery.trim($(this).val()) == ''){   
								 paid___p = 0;
								 }
									if(!validate_number_value2(numofimtsValue_p) || !validate_number_value2(paid___p) || !validate_number_value2(current_price_p) ){
									}else{
										//var current_total_price_p = (numofimtsValue_p * current_price_p) - discount_auto_dis_;
										var current_total_blance_p = current_price_p - paid___p;

									  //  $('div#tab__'+next_count+'  #price_').val(current_total_price_p);
										$('div#tab__'+next_count+'  #balance_').text(CommaFormattedN(current_total_blance_p)).attr('balance_',current_total_blance_p);
										//$('div#tab__'+next_count+' #paid_').attr('current_price',current_total_price_p);
										 
									}
							});
					
					// change price manualy
					  $('#update_custom div#tab__'+next_count+' #price_').keyup(function (){ 
					     var currenPrice1 = $(this).attr('price_');  // 3000
						  var currenPrice2 = condFunction(!validate_number_value2($(this).val()),0,$(this).val());  // 2500
						  var currntPaid = $('#update_custom div#tab__'+next_count+' #paid_').val();
                          var currntPaid_ = condFunction(!validate_number_value2(currntPaid),0,currntPaid);
						   var numofimtsValue_p = parseFloat($('div#tab__'+next_count+' #number_of_itm_').val());
						  numofimtsValue_p = condFunction(!validate_number_value2(numofimtsValue_p),1,numofimtsValue_p);
						  var currntdis = (currenPrice1 * numofimtsValue_p) - currenPrice2;
					 
						 $('#update_custom div#tab__'+next_count+' #discount_').val(condFunction(!validate_number_value2(currntdis),0,currntdis));
				 	     $(this).attr('oringinal_price',parseFloat($(this).val())); // change price 
			             $('div#tab__'+next_count+'  #balance_').text(CommaFormattedN(currenPrice2 - currntPaid_)).attr('balance_',currenPrice2 - currntPaid_);
						});	
		
					  $('#update_custom div#tab__'+next_count+' #price_').blur(function (){ 
						   //quantity_1_calc($('#update_custom div#tab__ #number_of_itm_'));

						        var quantity_element = $('div#tab__'+next_count+' #number_of_itm_');
						 
						 		 var discount_auto_dis = $('div#tab__'+next_count+' #discount_').val();
								 var paid_auto_paid = $('div#tab__'+next_count+' #paid_').val();
								 
								 if(jQuery.trim(discount_auto_dis) == ''){   
								 discount_auto_dis = 0;
								 }else if (!validate_number_value2(discount_auto_dis)){
								 discount_auto_dis = 0;
								 }
						 					    
								 if(jQuery.trim(paid_auto_paid) == ''){   
								 paid_auto_paid = 0;
								 }else if (!validate_number_value2(paid_auto_paid)){
								 paid_auto_paid = 0;
								 }
						 

						 
								        var remainingItms_ = parseFloat(quantity_element.attr('remainingItms'));
										var current_price  = parseFloat($('div#tab__'+next_count+' #price_').attr('oringinal_price'));
										var numofimtsValue = parseFloat(quantity_element.val());
										var maxDiscunt  =  parseFloat($('div#tab__'+next_count+' #price_').attr('maxDiscount')); 
							 
							 	  if(jQuery.trim(quantity_element.val()) == ''){   
								 numofimtsValue = 1;
								 }
							 
							 
									if(!validate_number_value2(numofimtsValue) || !validate_number_value2(remainingItms_) || !validate_number_value2(current_price) ){
									}else{ 
								
										var current_total_price = numofimtsValue * current_price;
										var current_total_blance = current_total_price - paid_auto_paid;
	   
									    $('div#tab__'+next_count+'  #price_').val(parseFloat(Math.round(current_total_price * 100) / 100).toFixed(2));
										$('div#tab__'+next_count+'  #balance_').text(CommaFormattedN(current_total_blance)).attr('balance_',current_total_blance);
										$('div#tab__'+next_count+' #paid_').attr('current_price',current_total_price);
						                $('div#tab__'+next_count+' #discount_').attr('modified_price',(numofimtsValue * maxDiscunt));
									}	
									 
					 
						});
 
 			
		
  document.getElementById('tab__link__'+next_count).click();	  // jump to the current tab
  return false;
	});
	
// allow sms for editing 	
    $('#allow_sms_edit').change(function (){
	 var value_chak =  $(this).val();
	 if(value_chak == 'off'){
	 $(this).val('on');
	 
	    
		 var all_msg_ =  $(this).attr('old');
		 if(jQuery.trim(all_msg_) == ''){
	 
		 $('#message_edit').removeAttr('disabled').focus().attr('placeholder','enter message here..').css('background','#fff');	
		 }else{  
		 $('#message_edit').val(all_msg_).removeAttr('disabled').focus().css('background','#fff');
		 }
		 
	 
	 }else{
	$(this).val('off');
     var all_msg_ =  $('#message_edit').val();
	  $('#message_edit').val('');
	 $(this).attr('old',all_msg_);
	 $('#message_edit').attr('disabled','disabled').removeAttr('placeholder').css('background','gray');
	 }
 
 });
 	  $('#other_detials_edit').accordion({
      fillSpace:true,
      icons:{"header": "ui-icon-plus","headerSelected":"ui-icon-minus"},  collapsible:true,active:2});
	  
 $('#otherclaps_edit').click(function (){
 var otherclaps_status =  $(this).attr('stutas');
  $('#other_detials_edit').accordion('destroy');
   if(otherclaps_status == 'off'){
	 $(this).attr('stutas','on');
	 
      $('#other_detials_edit').accordion({
      fillSpace:true,
      icons:{"header": "ui-icon-plus","headerSelected":"ui-icon-minus"},  collapsible:true,active:0});
	  
	  }else{
	      $(this).attr('stutas','off');
 	     $('#other_detials_edit').accordion({
			  fillSpace:true,
			  icons:{"header": "ui-icon-plus","headerSelected":"ui-icon-minus"},  collapsible:true,active:2});
			  
	
	 }
	 
 
 return false;
 })
  
  });

 	 //error function 
 function error_func2(message){
 $("#error").html('<img src="css/error.jpg" alt="error" style="border-radius:2em; width:70px; height:40px; margin-right: 4px;"/>'+message).dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
						"Okay": function() {
							$(this).dialog("close");
		}}, });
		
	return false;
 }


   // validate number by value 
 function validate_number_value2(textNumber){
 
    return /^[0-9+.]*$/.test(textNumber);
 
 }
 
 
	
 	
  function add_to_sell_theCurrent_cus(reminingDpst,email_cust,cust_id,nanme,number){
      
  
         $('div#tab__ #discountOpoionMax').hide();
   $('button#toggle_DepositRmng').button(
	  {
	    height:'auto',
		icons: {primary: 'ui-icon-plus', secondary: null}
	  }).css('font-size','8px').css('height','22px');

	 $('button#toggle_DepositRmng').attr('toggle','plus').attr('remaining',reminingDpst).show();
	 
	   $("#paybyDeposit").hide();
	      var roomsSelectors = $('h5#max_select_ch').attr('heddenSelet');
	   $('#tab__ li#list_itemn_').html(roomsSelectors).next().html(' 	<label>Type of Sell </label><select class="chosen" id="payment_type_" style="width:200px  !important; margin:3px" tab_id_="tab_link__1"  ><option class="opt">choose ..</option></select>');
	$("#tab__ select").chosen();
	
 
	// first div for default 
	  $('button#remove_tab__but2').each(function() {
							var bid = $(this).attr('id');
							document.getElementById(bid).click();	 
						});
						
	  $('#message_1').css({
	 width: "367px",
	 height: "179px"
	 }).val('');
	 if($('#allow_sms_').val() == 'on'){
	   document.getElementById('allow_sms_').click();	 
	 }			
	   $('#tab__ #list_itemn_').next().find('.chzn-search').remove();
	
     $('div#tab__ select[selectName="itemName_"]').change(function (){
			  var element = $(this).find('option:selected'); 
			  var singleSele_price = element.attr('singleSele');
			  var wholseSell_price = element.attr('wholesell');
			  var numbrOfremaining_Items = element.attr('remaining_Items');
			  var maxDiscount = element.attr('maxDiscount');
			 
if($(this).val() !='choose..'){ // change tab text to item name
	 $('#tabes_handler_ a#tab_link__1').html($(this).val());
}			 
			  
			  
		         var sigleSell =  "<option class='opt' singleSell="+element.attr('singleSele')+" item_id_="+element.attr('item_id_')+"   singleSell_out="+ element.attr('singleSele_out') +"  > Retail </option>";
				 var wholseSell  = "<option class='opt' wholseSell="+element.attr('wholeSell')+" item_id_="+element.attr('item_id_')+"   wholeSell_out="+element.attr('wholeSell_out')+" > WholeSell  </option>";
		 
	 
		 if (singleSele_price == 0){
		sigleSell = '';
		 }
		 if (wholseSell_price  == 0){
		 wholseSell ='';
		 }
	 	 if($(this).val() == 'choose..'){
			 sigleSell = '';
			 wholseSell = '';
		 }
		 
		 
		                    if(maxDiscount == '0'){
							    $('div#tab__ #discountOpoionMax').hide();
							   }else{
							    $('div#tab__ #discountOpoionMax').show();
							   }
							   
							   
		  $('div#tab__  select#payment_type_').next().remove();
		  $('div#tab__  select#payment_type_').html( '<option class="opt">choose ..</option> ' +sigleSell + wholseSell);
		  $('div#tab__  select#payment_type_').attr('class','').chosen();
		   $('div#tab__  input#number_of_itm_').attr('remainingItms',numbrOfremaining_Items);
		   
		   $('div#tab__  #remaining_items_sell').text(CommaFormattedN(numbrOfremaining_Items)+'  '); 

		    $('#tab__ #list_itemn_').next().find('.chzn-search').remove();
			
		  $('div#tab__ select#payment_type_ option:last').attr('selected','selected');  // force to select last option 		
				   // when th payment type has been chosen 
				    //   $('div#tab__ select#payment_type_').change(function (){
					 
					     var element3 =  $('div#tab__ select#payment_type_').find('option:selected'); 
					     var paymnt_value2 = $('div#tab__ select#payment_type_').find('option:selected').val();
					 if(paymnt_value2 == 'Retail'){   
					     var singleSele_price3 = element3.attr('singleSell');
						
						  
						 var singleSele_out3 = element3.attr('singleSell_out');
						 var item_id_ = element3.attr('item_id_');    
						 $('div#tab__ #price_').attr('maxDiscount',maxDiscount).attr('price_',singleSele_price3).val(singleSele_out3).attr('oringinal_price',singleSele_price3).attr('item_nam',item_id_);
						 
						 		// reset fields
							$('div#tab__ #number_of_itm_').val('');
							$('div#tab__ #discount_').val('').attr('modified_price',maxDiscount);
							$('div#tab__  #paid_').val('');	
						 
						   $('div#tab__ p.balance_').attr('balance_',singleSele_price3).text(singleSele_out3);
						   
						
							   
						}else if (paymnt_value2 == 'WholeSell'){
					 
					   	  var wholseSell_price3 = element3.attr('wholseSell');
						  var wholseSell_out3 = element3.attr('wholeSell_out');
						   var item_id_2 = element3.attr('item_id_');  
						  $('div#tab__ #price_').attr('maxDiscount',maxDiscount).attr('price_',wholseSell_price3).val(wholseSell_out3).attr('oringinal_price',wholseSell_price3).attr('item_nam',item_id_2);	

								// reset fields
							$('div#tab__ #number_of_itm_').val('');
							$('div#tab__ #discount_').val('').attr('modified_price',maxDiscount);
							$('div#tab__ #paid_').val('');	
							   $('div#tab__ p.balance_').attr('balance_',wholseSell_price3).text(wholseSell_out3);	
					    
						}else if(paymnt_value2 == 'choose ..'){
						  $('div#tab__ #price_').attr('price_','').val('0');	 
		                   $('div#tab__ p.balance_').attr('balance_','').text('0');	
						}
					  
					//  });
		  

		       });
 
 
				        // auto calculate  balance  and price by using number of items
						$('#update_custom div#tab__ #number_of_itm_').keyup(function (){
							
					 
						 		 var discount_auto_dis = $('div#tab__ #discount_').val();
								 var paid_auto_paid = $('div#tab__ #paid_').val();
								 
								 if(jQuery.trim(discount_auto_dis) == ''){   
								 discount_auto_dis = 0;
								 }else if (!validate_number_value2(discount_auto_dis)){
								 discount_auto_dis = 0;
								 }
						 					    
								 if(jQuery.trim(paid_auto_paid) == ''){   
								 paid_auto_paid = 0;
								 }else if (!validate_number_value2(paid_auto_paid)){
								 paid_auto_paid = 0;
								 }
						 

						 
								        var remainingItms_ = parseFloat($(this).attr('remainingItms'));
										var current_price  = parseFloat($('div#tab__ #price_').attr('oringinal_price'));
										var numofimtsValue = parseFloat($(this).val());
		                              var maxDiscunt  =  parseFloat($('div#tab__ #price_').attr('maxDiscount')); 
									  if(jQuery.trim($(this).val()) == ''){   
										 numofimtsValue = 1;
										 }
						 
									if(!validate_number_value2(numofimtsValue) || !validate_number_value2(remainingItms_) || !validate_number_value2(current_price)){
									//alert(numofimtsValue);alert(remainingItms_);alert(current_price);
									}else{
										var current_total_price = numofimtsValue * current_price;
										var current_total_blance = current_total_price - paid_auto_paid;

									    $('div#tab__  #price_').val(parseFloat(Math.round(current_total_price * 100) / 100).toFixed(2));
										$('div#tab__  #balance_').text(CommaFormattedN(current_total_blance)).attr('balance_',current_total_blance);
										$('div#tab__  #paid_').attr('current_price',current_total_price);
										$('div#tab__  #discount_').attr('modified_price',(numofimtsValue * maxDiscunt));
										
										 if(jQuery.trim($(this).val()) == ''){   
											 numofimtsValue = 0;
											 }
											 
											 
										$('div#tab__  #remaining_items_sell').text(CommaFormattedN(remainingItms_ - numofimtsValue) + '  '); 
									}
							});
					
						

	
				        // auto calculate  balance  and price by using discount 
						$('#update_custom div#tab__ #discount_').keyup(function (e){
							
						  if(e.keyCode == '9'){
									   return false;
									}
						 
								 var paid_auto_paid_d = $('div#tab__ #paid_').val();
								 
					 
						 					    
								 if(jQuery.trim(paid_auto_paid_d) == ''){   
								 paid_auto_paid_d = 0;
								 }else if (!validate_number_value2(paid_auto_paid_d)){
								 paid_auto_paid_d = 0;
								 }
						 

						 
								        var discount__dis_d = parseFloat($(this).val());
										var current_price_d  = parseFloat($('div#tab__ #price_').attr('oringinal_price'));
										var numofimtsValue_d = parseFloat($('div#tab__ #number_of_itm_').val());
									 
							  if(jQuery.trim($(this).val()) == ''){   
								 discount__dis_d = 0;
								 }
								 
									if(!validate_number_value2(numofimtsValue_d) || !validate_number_value2(discount__dis_d) || !validate_number_value2(current_price_d) ){
									//alert(numofimtsValue_d); alert(discount__dis_d); alert(current_price_d);
									}else{
										var current_total_price_d = (numofimtsValue_d * current_price_d) - discount__dis_d;
										var current_total_blance_d = current_total_price_d - paid_auto_paid_d;

									    $('div#tab__  #price_').val(current_total_price_d);
										$('div#tab__  #balance_').text(CommaFormattedN(current_total_blance_d)).attr('balance_',current_total_blance_d);
									//	$('div#tab__  #paid_').attr('current_price',current_total_price_d);
										  
									}
							});
					
						
	                      // auto calculate  balance  and price by using paid 
						$('#update_custom div#tab__ #paid_').keyup(function (){
							
						 
						 		 var discount_auto_dis_ = $('div#tab__ #discount_').val();
								  
								 
								 if(jQuery.trim(discount_auto_dis_) == ''){   
								 discount_auto_dis_ = 0;
								 }else if (!validate_number_value2(discount_auto_dis_)){
								 discount_auto_dis_ = 0;
								 }
						 					    
 
								        var paid___p = parseFloat($(this).val());
										var current_price_p  = parseFloat($('div#tab__ #price_').val());
										var numofimtsValue_p = parseFloat($('div#tab__ #number_of_itm_').val());
							  
							  if(jQuery.trim($(this).val()) == ''){   
								 paid___p = 0;
								 }
									if(!validate_number_value2(numofimtsValue_p) || !validate_number_value2(paid___p) || !validate_number_value2(current_price_p) ){
									}else{
									//var current_total_price_p = (numofimtsValue_p * current_price_p) - discount_auto_dis_;
										var current_total_blance_p = current_price_p - paid___p;

									   // $('div#tab__  #price_').val(current_total_price_p);
										$('div#tab__  #balance_').text(CommaFormattedN(current_total_blance_p)).attr('balance_',current_total_blance_p);
									//	$('div#tab__  #paid_').attr('current_price',current_total_price_p);
									 
									}
							});
					
					    // change price manualy
						$('#update_custom div#tab__ #price_').keyup(function (){ 
					     var currenPrice1 = $(this).attr('price_');  // 3000
						  var currenPrice2 = condFunction(!validate_number_value2($(this).val()),0,$(this).val());  // 2500
						  var currntPaid = $('#update_custom div#tab__ #paid_').val();
                          var currntPaid_ = condFunction(!validate_number_value2(currntPaid),0,currntPaid);
						  var numofimtsValue_p = parseFloat($('div#tab__ #number_of_itm_').val());
						  numofimtsValue_p = condFunction(!validate_number_value2(numofimtsValue_p),1,numofimtsValue_p);
						  var currntdis = (currenPrice1 * numofimtsValue_p) - currenPrice2;
						 $('#update_custom div#tab__ #discount_').val(condFunction(!validate_number_value2(currntdis),0,currntdis));
				 	      $(this).attr('oringinal_price',parseFloat($(this).val())); // change price 
			             $('div#tab__  #balance_').text(CommaFormattedN(currenPrice2 - currntPaid_)).attr('balance_',currenPrice2 - currntPaid_);
						 });
 
 
 				   	$('#update_custom div#tab__ #price_').blur(function (){ 
						   //quantity_1_calc($('#update_custom div#tab__ #number_of_itm_'));

						        var quantity_element = $('#update_custom div#tab__ #number_of_itm_');
								 var paid_auto_paid = $('div#tab__ #paid_').val();
								  if(jQuery.trim(paid_auto_paid) == ''){   
								 paid_auto_paid = 0;
								 }else if (!validate_number_value2(paid_auto_paid)){
								 paid_auto_paid = 0;
								 }
						 

						 
								        var remainingItms_ = parseFloat(quantity_element.attr('remainingItms'));
										var current_price  = parseFloat($('div#tab__ #price_').attr('oringinal_price'));
										var numofimtsValue = parseFloat(quantity_element.val());
		                              var maxDiscunt  =  parseFloat($('div#tab__ #price_').attr('maxDiscount')); 
									  if(jQuery.trim(quantity_element.val()) == ''){   
										 numofimtsValue = 1;
										 }
						 
									if(!validate_number_value2(numofimtsValue) || !validate_number_value2(remainingItms_) || !validate_number_value2(current_price)){
									//alert(numofimtsValue);alert(remainingItms_);alert(current_price);
									}else{
										var current_total_price = numofimtsValue * current_price;
										var current_total_blance = current_total_price - paid_auto_paid;

									    $('div#tab__  #price_').val(parseFloat(Math.round(current_total_price * 100) / 100).toFixed(2));
										$('div#tab__  #balance_').text(CommaFormattedN(current_total_blance)).attr('balance_',current_total_blance);
								 
										 
										 
										 	}
						 
						   
						   
						});
 
 
 
 // end of default
        $('#update_custom input[type="text"]').removeAttr('style').val('');	 
		$('#update_custom p').css("font-weight","bold").text('0');
		
		if(cust_id == '-'){
		var newNamce = 'selling Item ';
		$('li#cunstname,li#newDeposit_li_').show();	
		}else{
		var newNamce = 'selling to ('+nanme+')';		
	    $('li#cunstname,li#newDeposit_li_').hide();	
		}
		  $('#update_custom #email').val(email_cust); 
         $('#update_custom #mobile_b').val(number);   // put the current nu
		
	$("#update_custom").dialog({ show: "blind", hide: "explode",position:'top', width: '500',  height:'auto',  modal: true, buttons:  {
						"Confirm": function() {
 

	                 // validating status 
					   var custom_name_vali = 'off';
					   var itemm_name_vali = 'off';
					   var payment_type_sel_vali = 'off';
					   var number_of_itm_se_vali  = 'off';
					   var discount_sel_vali = 'off';
					   var balance_valdating = 'off';
					   var paid_sel_vali  = 'off';
					   var mobile_valiting = 'off'; 
					   var allowSms_validating = 'off';
						  		    var custom_name = condFunction(cust_id == '-',new Array($("#cust_name1").val()), new Array(nanme));
									
									var cust_id_ = new Array(cust_id);
									cust_id_[0]=cust_id
									var itemm_name = new Array();
									var payment_type_sel = new Array();
									var number_of_itm_se = new Array();
									var discount_sel =  new Array();	
									var price_sel   =  new Array();	
									var paid_sel  =  new Array();	
								 var  sellItemDeposit  =  new Array();	
									var balance_sel = new Array();
									var original_price_ =  new Array();
									var remaing_items_ = new Array();	
								    var item_ids  = new Array();
							   var newDeposit = $('#newDeposit').val();	
						     var mobile_  = new Array($('#mobile_b').val());
                            var truckNumber = new Array();	
						
						     var daidline  = new Array();
						     var allowSms  = new Array();
						     var message  = new Array();
							
						 // printings
						 var print_SellingStatus = ''; 
						
						 // end of printings	
						 
							 
						    //  check info 
					   
					    var paymentTypeStatus = '';
						var	checkBankName1 = '';
						var	checkDate1 = '';
						var	checkName1 = '';
						var	checkAddress1 = '';	
						var	checkAcountNo1 = '';	
						var	checkPayToName1 = '';
						var	checkInWords1 = '';
						var	checkMemo1 = '';
						var	paymentOption1 = '';
						var	priceStutus = '';
						// end of check info
						 
			                     // validate customer name and push to array 
								
								    if(jQuery.trim(custom_name[0]) == '' && cust_id == '-'){
											// error_func2('Error please enter Custom Name !!');	
											// $('#cust_name1').css('border','2px groove red');	
										//	 return false;
										}
							 
							 
								    if(!validate_number_value2(newDeposit) && cust_id == '-' && jQuery.trim(newDeposit) != '' ){
											 error_func2('Error Invalid Deposit !!');
                                              $('#newDeposit').css('border','2px groove red');											 
											 return false;
										}
							 
							 
								    $('input#number_of_itm_').each(function() {
									  
											var numbr_of_itm = $(this).val();
											var current_tab_Id_n =  $(this).attr('tab_id_'); 
											var field_id_number_of_item = $(this).attr('id');
											var remaining_itms = $(this).attr('remainingitms');
											
											if(jQuery.trim(numbr_of_itm) == ''){	
												// check if value is empty !
											document.getElementById(current_tab_Id_n).click();	  // jump to the current tab
											   error_func2('Error please enter number of item !');	
											     $(this).css('border-color','red');
												   number_of_itm_se_vali = 'on';
											   return false;
											}else if(!validate_number_value2(numbr_of_itm)){
											  // check if value is digit !
											   document.getElementById(current_tab_Id_n).click();	  // jump to the current tab 
											   error_func2('Error invalid number of item !');	
											    $(this).css('border','2px groove red');
												  number_of_itm_se_vali = 'on';
											   return false;
											}else if(remaining_itms < parseFloat($(this).val())){
											   document.getElementById(current_tab_Id_n).click();	  
											  error_func2('Error invalid number of item <br /> only ('+CommaFormattedN(remaining_itms)+') Items available !');	 
											     $(this).css('border','2px groove red');
												  number_of_itm_se_vali = 'on';
											   return false;
											}else{
											  number_of_itm_se_vali = 'off';
											   //  $(this).css('border','2px groove rgb(248, 248, 248)');
											    number_of_itm_se.push(numbr_of_itm);
												 remaing_items_.push(remaining_itms);
											}
										});
										
								  
								
							 		// validate payment type name and push to array 
									$('select#payment_type_').each(function() {
									
											var current_tab_Id =  $(this).attr('tab_id_'); 
											var  payment_type_ =  $(this).val();
											   
									//	alert(payment_type_);
								            if( payment_type_ == 'choose ..' ){
								              document.getElementById(current_tab_Id).click();	  // jump to the current tab
									          error_func2('Error please Select Type of Sell !');		
											    $(this).css('border','1px solid red');
												 payment_type_sel_vali = 'on';
										        return false;
										    }else{
											 payment_type_sel_vali = 'off';
										    // $(this).css('border','none');
										     payment_type_sel.push(payment_type_);
											}										
										});										 
								
								 
										  
								  // validate item  name and push to array 
							 		$("select[selectName='itemName_']").each(function() {
										 
									    	var payment_type_value = $(this).val();
											var current_tab_Id_ = $(this).attr('tab_id_'); 
								    
									  if(payment_type_value == 'choose..' ){
								               document.getElementById(current_tab_Id_).click();	  // jump to the current tab
									           error_func2('Error Please Select Item Name!');	
												// $(this).css('border','1px solid red');
												 itemm_name_vali = 'on';
										        return false;
										 }else{
										     itemm_name_vali = 'off';
											// $(this).css('border','none');
											itemm_name.push(payment_type_value);
							 
										}
										});
					 
		 
						 		
									                    
	                                $('input#price_').each(function() {
									var priceValue = $(this).val();
									var originalPrice = $(this).attr('oringinal_price');
									var curreitem_id = $(this).attr('item_nam');
									var current_tab_Id_ = $(this).attr('tab_id_'); 
									
									 if(jQuery.trim(priceValue) == '' ){ 
										  priceStutus = 'off';
											   price_sel.push('0');
											   original_price_.push(originalPrice); 
											   item_ids.push(curreitem_id);
										    }else if (!validate_number_value2(priceValue)){
									        // check if value is empty !
											 document.getElementById(current_tab_Id_).click();	  // jump to the current tab
											   error_func2('Error invalid price !');	
											  $(this).css('border','2px groove red');
											     priceStutus = 'on';
											    return false;
											}else{
											    price_sel.push(priceValue);
												original_price_.push(originalPrice);
												item_ids.push(curreitem_id);
										     }
										});

										                    
	                                $('p#balance_').each(function() {
									 var current_tab_Id_ba  =  $(this).attr('tab_id_');  
									  if(!validate_number_value2($(this).attr('balance_'))){
												 document.getElementById(current_tab_Id_ba).click();	  // jump to the current tab
											   error_func2('Error Invalid Paid !');	
											  //  $(this).css('border','2px groove red');
											     balance_valdating = 'on';
											   return false;
											}else{
									 balance_valdating = 'off';
									    balance_sel.push($(this).attr('balance_'));
											
											}// price is a digit and all ways equal to something
										});

											
			
					               $('input.paid_').each(function() {
									  

											var paid_of_itm = $(this).val();
											var current_tab_Id_p  =  $(this).attr('tab_id_');  
											var field_id_paid_of_item  = $(this).attr('id');
											var current_total_price_ = $(this).attr('current_price');
									    if(jQuery.trim(paid_of_itm) == '' ){ 
										  paid_sel_vali = 'off';
 										     paid_of_itm = 0;
											    $(this).css('border','2px groove rgb(248, 248, 248)');
											  paid_sel.push(paid_of_itm);
											   sellItemDeposit.push('0');
											 
										    }else if (!validate_number_value2(paid_of_itm) && jQuery.trim(paid_of_itm) != '') {
									        // check if value is empty !
											 document.getElementById(current_tab_Id_p).click();	  // jump to the current tab
											   error_func2('Error invalid Paid !');	
											  $(this).css('border','2px groove red');
											     paid_sel_vali = 'on';
											   return false;
											}else{
											  paid_sel_vali = 'off';
											    $(this).css('border','2px groove rgb(248, 248, 248)');
											    paid_sel.push(paid_of_itm);
											    sellItemDeposit.push('0');
											}
						
										});
                                 
					  	 
									$('input.discount_').each(function() {
										
											var disc_of_itm = $(this).val();
											var current_tab_Id_d  =  $(this).attr('tab_id_'); 
											var field_id_disc_of_item  = $(this).attr('id');
											var original_price_dis   =   $(this).attr('modified_price');
											
										    if(jQuery.trim(disc_of_itm) == '' ){
												discount_sel_vali = 'off';
										
										     disc_of_itm = 0;
											     $(this).css('border','2px groove rgb(248, 248, 248)');
											  discount_sel.push(disc_of_itm);
										    }else if (!validate_number_value2(disc_of_itm) && jQuery.trim(disc_of_itm) != '') {
									        // check if value is empty !
											 document.getElementById(current_tab_Id_d).click();	  // jump to the current tab
											   error_func2('Error invalid Discount !');	
											  $(this).css('border','2px groove red');
											     discount_sel_vali = 'on';
										
											   return false;
											}
											/* else if(original_price_dis < parseFloat($(this).val())){
												 document.getElementById(current_tab_Id_d).click();	  // jump to the current tab
											 error_func2('Error invalid Discount <br> Maximum Discount is: '+CommaFormattedN(original_price_dis)+'!');	
											    $(this).css('border','2px groove red');
											     discount_sel_vali = 'on';
										
											   return false;
											} */
											else{
											  discount_sel_vali = 'off';
										
											    $(this).css('border','2px groove rgb(248, 248, 248)');
											  discount_sel.push(disc_of_itm);
											}
										});
				 
									     
	                                $('div#update_custom #mobile_li_').each(function() {
									    
									   		var mobile_value = $('#mobile_b').val();
											var current_tab_Id_mobile  =  'tab_link__1' 
								            var message_send  =  $(this).next().next().find('#message_1').first().val(); 
											 
								
								     if (!validate_number_value(mobile_value) && jQuery.trim(mobile_value) != '') {
									        // check if value is empty !
											 document.getElementById(current_tab_Id_mobile).click();	  // jump to the current tab
											   error_func('Error invalid Mobile number !');	
											  $('#mobile_b').css('border','2px groove red');
											     mobile_valiting = 'on';
											   return false;
											}else if (jQuery.trim(message_send) != '' && jQuery.trim(mobile_value) == '') {
									        // check if value is empty !
											 document.getElementById(current_tab_Id_mobile).click();	  // jump to the current tab
											   error_func('Error please enter mobile number !');	
											  $('#mobile_b').css('border','2px groove red');
											     mobile_valiting = 'on';
											   return false;
											}else{ 
											   mobile_valiting = 'off';
						 	   	 $('#mobile_b').css('border','2px groove rgb(248, 248, 248)');
										if(jQuery.trim(message_send) ==''){
										   message_send = '0';
										    message.push(message_send); 
										   }else{
										      message.push(message_send); 
										   }
									   
											} 
										});

			 
			                       // others
				       
	                                $('input#allow_sms_').each(function() {
									 
									   	 	var allow_sms_value = $(this).val();
											var current_tab_Id_allow_sms  =  $(this).attr('tab_id_');  
								            var message =   $(this).parent().next().next().next().val();
								       
								   //  alert(allow_sms_value);
							   if (jQuery.trim(allow_sms_value) == 'on' && jQuery.trim(message) == '' ) { 
									      //  check  if message is empty!
										  document.getElementById(current_tab_Id_allow_sms).click();	  // jump to the current tab
									      error_func('Error the message is blank !');	
										   $(this).css('border','1px groove red');
									       allowSms_validating = 'on';
										    return false;
									}else{ 
										    allowSms_validating = 'off';
										 allowSms.push(allow_sms_value);
									  	}
								 
									});

											                    
	                                $('input[date="daidline_"]').each(function() {
									   var timeline_2 = $(this).val();
									 	 if(jQuery.trim(timeline_2) ==''){
										   
										     daidline.push('0');
										   }else{
										   daidline.push(timeline_2);
										   }
									  
											// price is a digit and all ways equal to something
										});
									 
									 $('input.truckNumber').each(function() {
									   var truckNumber_ = $(this).val();
									 	 if(jQuery.trim(truckNumber_) ==''){
										   
										     truckNumber.push('');
										   }else{
										   truckNumber.push(truckNumber_);
										   }
									  
											// price is a digit and all ways equal to something
										});
					 
				if( custom_name_vali == 'on' || itemm_name_vali == 'on' || payment_type_sel_vali == 'on'){
					}else if(number_of_itm_se_vali == 'on' ){
					}else if( discount_sel_vali == 'on' || paid_sel_vali == 'on' ){
					 
					 }else if( mobile_valiting == 'on' || allowSms_validating == 'on' || priceStutus  == 'on' ){
					 
					 }else if( balance_valdating == 'on' ){
					 }else{
			 var  remainingCulc = 0 ;   // current Remainig Cash 	
					var data_length = itemm_name.length;
		        	var conf_total_discount = 0;
			        var conf_total_price = 0;
					var conf_total_paid = 0;
					var conf_total_balance = 0; 
					var conf_total_numberOfItem = 0; 
					 
				 function confirmation_function(){
	  
				 var confirmation_table = '<table id="confima_table"   cellpadding="0" cellspacing="0" border="0" class="display" width="100%">   <thead>    <tr> <th> Item Name </th> <th> Quantity </th> <th> Price </th> <th> Paid </th><th> Balance </th> </tr> </thead> <tbody>'; 
				    data_length = itemm_name.length;
				    conf_total_numberOfItem = 0;
		        	 conf_total_discount = 0;
			        conf_total_price = 0;
					 conf_total_paid = 0;
					 conf_total_balance = 0;
				
				 for(x=0;x<data_length;x++){ 
				//  error_func2(balance_sel[x]);
				 confirmation_table +=   '<tr> <td>'+itemm_name[x]+'</td><td class="int_no">'+CommaFormattedN(number_of_itm_se[x])+'   </td> <td class="int_no">'+CommaFormattedN(price_sel[x])+'</td><td class="int_no">'+CommaFormattedN(paid_sel[x])+'</td><td class="int_no redBalance">'+CommaFormattedN(balance_sel[x])+'</td></tr>';
				 }
				 
				 confirmation_table  +='</tbody></table>';
				 
				 for(i=0;i<data_length; i++){
				        conf_total_numberOfItem  += Number(number_of_itm_se[i]);
				        conf_total_discount +=   Number(discount_sel[i]);
						conf_total_price    +=    Number(price_sel[i]);
						conf_total_paid    +=    Number(paid_sel[i]);
				        conf_total_balance  +=   Number(balance_sel[i]);
				   }
				   
				   
				    var link_edit  = condFunction(conf_total_balance != 0,"<td><a href='#' class='change' id='edtCshpepsitLaudySell'  title='click to Edit Balance !'> Edit </a></td>",'');
				    var action_colmn  =  condFunction(conf_total_balance != 0,"<th> Action </th>",'');
	 
			//	<label>Email:</label>
			
		    
				    confirmation_table  += '<table id="confima_table_total"   cellpadding="0" cellspacing="0" border="0" class="display" width="100%">   <thead>    <tr> <th> Total Quantitys </th>  <th> Total Price </th><th>Total Paid </th><th>Total Balance </th>'+action_colmn+'</tr></thead> <tbody>';
				    confirmation_table  += '<tr><td>'+CommaFormattedN(conf_total_numberOfItem)+'  </td>   <td class="int_no">'+CommaFormattedN(conf_total_price)+' </td> <td class="int_no">'+CommaFormattedN(conf_total_paid)+'</td> <td class="int_no redBalance">'+CommaFormattedN(conf_total_balance)+'</td>'+link_edit+'</tr></tbody></table>';
				
				confirmation_table  += '  <br> <form action=""> <table id="receipt_option" style="color:#fff;"> <th><label><input type="radio" onclick="" optNo="1" > Print Receipt </label> </th><th>  <label><input type="radio" onclick="" optNo="2" > Send Receipt </label> </th> <th>  <label><input type="radio" onclick="" optNo="3" > Both </label></th>  <th> <label><input type="radio" onclick=""  optNo="no" > Nothing </label> </th> </thead><tbody> ';   // printing options
				 confirmation_table  += '  <tr id="recieptOPions"> <td></td> <td><input type="email" value="" placeholder="Email" style="width:320px; display:none;"  id="email" class="email"  > </td> <td></td> <td></td></tr> ';
				  confirmation_table  += '</tbody></table> </form>';
				return confirmation_table;
		  }
		  
				    //confirm_selling_item  
					  $("#confirm_selling_item").html(confirmation_function()).dialog({  show: "blind", hide: "explode", width: 'auto', position:'top', height:'auto',  modal: true, buttons:  {
						"Agree": function() {
						 	 
						   var email_  = new Array($("#confirm_selling_item table#receipt_option #email").val());
						 
						 if(print_SellingStatus == 'send' && jQuery.trim(email_[0]) == ''){
							  error_func('Error Enter Email!');	
								$("#confirm_selling_item table#receipt_option #email").css('border','2px groove red');
								 return false;
						  }else if( print_SellingStatus == 'both' && jQuery.trim(email_[0]) == ''){
						         error_func('Error Enter Email!');	
								$("#confirm_selling_item table#receipt_option #email").css('border','2px groove red');
								 return false;
						  }
						  
						  	 if(print_SellingStatus == ''){
							       // print Reciept      print_Items(itemm_name,number_of_itm_se,price_sel);   
								 error_func('Error Please choose Receipt option !!');	
								$("#confirm_selling_item table#receipt_option tr#recieptOPions").css('border','2px groove red');
								 return false;
							  }
							
							 // submit The form
                              loading_func(); // SHOW LOADING IMAGE DIALOG
							  
				 if(cust_id_ == '-'){
					  
				 
		 
						$.post('php_f/add_new_custom.php', {truckNumber:truckNumber,balance_sel:balance_sel,print_SellingStatus:print_SellingStatus,paymentOption1:paymentOption1,checkMemo1:checkMemo1,checkInWords1:checkInWords1,checkPayToName1:checkPayToName1,checkAcountNo1:checkAcountNo1,checkAddress1:checkAddress1,checkName1:checkName1,checkDate1:checkDate1,checkBankName1:checkBankName1,email_:email_,newDeposit:newDeposit,message:message,allowSms:allowSms,daidline:daidline,mobile_:mobile_, custom_name:custom_name, item_ids:item_ids, original_price_:original_price_, remaing_items_:remaing_items_, itemm_name:itemm_name, payment_type_sel:payment_type_sel, number_of_itm_se:number_of_itm_se, discount_sel:discount_sel, price_sel:price_sel,paid_sel:paid_sel}, function(cust_feedback) {					
							
							    if( cust_feedback == 1){ 
								       Load_Items(); 
									if($("#loading").closest('.ui-dialog').is(':visible')) { 
									       $("#confirm_selling_item").dialog('close');
                                           $("#update_custom").dialog('close');
										  $("#loading").dialog('close');
										  
										  	  if(print_SellingStatus == 'print'){
													   // print Reciept  
							          						   
						             print_Items(custom_name,itemm_name,number_of_itm_se,discount_sel,price_sel,paid_sel,balance_sel,'','');							   
											//	  print_Items(itemm_name,number_of_itm_se,price_sel);   
												}else if(print_SellingStatus == 'both' ){
													   // print Reciept  
								      print_Items(custom_name,itemm_name,number_of_itm_se,discount_sel,price_sel,paid_sel,balance_sel,'','');							   
									
												}
							
										  success_func('<strong>Successfull</strong>'); 
									 } 
							 
							    }else{
							     $("#loading").dialog('close'); 
							     error_func2(cust_feedback);
							      }
							
						});
					  
				
					  }else{
				 
						$.post('php_f/updateCustom.php', {truckNumber:truckNumber,balance_sel:balance_sel,print_SellingStatus:print_SellingStatus,paymentOption1:paymentOption1,checkMemo1:checkMemo1,checkInWords1:checkInWords1,checkPayToName1:checkPayToName1,checkAcountNo1:checkAcountNo1,checkAddress1:checkAddress1,checkName1:checkName1,checkDate1:checkDate1,checkBankName1:checkBankName1,email_:email_,sellItemDeposit:sellItemDeposit,message:message,allowSms:allowSms,daidline:daidline,mobile_:mobile_,cust_id_:cust_id_,custom_name:custom_name, item_ids:item_ids, original_price_:original_price_, remaing_items_:remaing_items_, itemm_name:itemm_name, payment_type_sel:payment_type_sel, number_of_itm_se:number_of_itm_se, discount_sel:discount_sel, price_sel:price_sel,paid_sel:paid_sel}, function(cust_feedback) {					
							
							    if( cust_feedback == 1){ 
								    toggle_for_sold_items = '11';
									more_oppenStatus = 'on';	
									 $("#confirm_selling_item").dialog('close');
                                    $("#update_custom").dialog('close');									
						            Load_Items(); 
								   	 if(print_SellingStatus == 'print'){
											   // print Reciept  
										 // print_Items(itemm_name,number_of_itm_se,price_sel);   
								  print_Items(custom_name,itemm_name,number_of_itm_se,discount_sel,price_sel,paid_sel,balance_sel,'','');							   
									
										}else if(print_SellingStatus == 'both' ){
											   // print Reciept  
							 //print_Items(itemm_name,number_of_itm_se,price_sel);   
							   print_Items(custom_name,itemm_name,number_of_itm_se,discount_sel,price_sel,paid_sel,balance_sel,'','');							   
									
										}
							    }else{
							   $("#loading").dialog('close'); 
							   error_func2(cust_feedback);
							  }
							
						});
					
					  }
	  	        
					 
		},"Cancel" : function () {
		$(this).dialog('close');
		}}, });
	
	               // receipt option when clicked 
				  $("#confirm_selling_item").delegate("table#receipt_option input[type='radio']", "click", function (){ 
				  
				      var receiptOptionType = $(this).attr('optNo');
						if(receiptOptionType == '1'){
					    	print_SellingStatus = 'print';
						 $("#confirm_selling_item table#receipt_option input[optNo='no'],#confirm_selling_item table#receipt_option input[optNo='2'],#confirm_selling_item table#receipt_option input[optNo='3']").prop('checked', false);
						   $("#confirm_selling_item table#receipt_option #email").fadeOut();
						}else if(receiptOptionType == '2'){
					    	print_SellingStatus = 'send';
						 $("#confirm_selling_item table#receipt_option #email").fadeIn();
						 	 $("#confirm_selling_item table#receipt_option input[optNo='1'],#confirm_selling_item table#receipt_option input[optNo='no'],#confirm_selling_item table#receipt_option input[optNo='3']").prop('checked', false);
						}else if(receiptOptionType == '3'){
							print_SellingStatus = 'both';
						 	 $("#confirm_selling_item table#receipt_option #email").fadeIn();
							 $("#confirm_selling_item table#receipt_option input[optNo='1'],#confirm_selling_item table#receipt_option input[optNo='2'],#confirm_selling_item table#receipt_option input[optNo='no']").prop('checked', false);	 
						}else{
						    print_SellingStatus = 'no';
						  $("#confirm_selling_item table#receipt_option #email").fadeOut();	
						  	 $("#confirm_selling_item table#receipt_option input[optNo='1'],#confirm_selling_item table#receipt_option input[optNo='2'],#confirm_selling_item table#receipt_option input[optNo='3']").prop('checked', false);
						}
 
				   });
                  $("#confirm_selling_item table#receipt_option #email").val(email_cust);
	               applyButtons();	
	  
	   	    
		/*     $("#confirm_selling_item a#edtCshpepsitLaudySell").click(function (){ alert('tewss'); }); */
         $("#confirm_selling_item").delegate("a#edtCshpepsitLaudySell", "click", function (){ 
	 
	         $('#print_deposit2').prop('checked', false);  
 		 	$("li#liPynmTypeEl").html('<label>Paymen type : </label><select id="paymntType_1"><option class="opt" selected="selected">Choose.</option> <option class="opt">Cash</option>  <option class="opt">check</option> </select>');
		 // $("#paymntType_1 option").removeAttr('selected');
		  	$("li#liPynmTypeEl select#paymntType_1").data("placeholder","Select item name...").chosen();
		     $('#checkDiv_1,li#cashDiv_1').attr('style','display:none;');  // hide
			toggePaymentType();
					//payLaudryItemByDeposit(conf_total_balance,depositCashRemaining,data_length);
						 var balanceCulAll =  conf_total_balance;
						 var remainingDepst = parseFloat(reminingDpst)  - parseFloat(remainingCulc);
						// var data_length_len = data_length;
				 		
					//confirm_selling_item  and editing one Time 
		 
 
	   if(cust_id_ == '-'){
	       $('button#toggle_DepositRmng_laundry').hide();
	   }else{
			 $('button#toggle_DepositRmng_laundry').attr('toggle','plus').button({
			height:'auto',
			icons: {primary: 'ui-icon-plus', secondary: null}
		   }).css('font-size','9px').css('height','22px').attr('remaining',remainingDepst).show();
		}
	   
				 $("#paybyDepositLaundry").hide();
				$('#payOneTime_Laundry_div input[type="text"]').removeAttr('style').val('');
				$('#balanceLaundry_One').text(CommaFormattedN(balanceCulAll)).css('font-weight','bold').attr('oBalance',balanceCulAll);
				$('#reminingDpstLaundry').text(CommaFormattedN(remainingDepst)).css('font-weight','bold');
		     
			 
			 
			 //  when cash or paid is key up 
 		  
		 $('#depositCashLaudnry').keyup(function (){
				 
							   var paid_auto_dis_ = parseFloat($("#paid_laundry_One").val());
 
								 if(jQuery.trim(paid_auto_dis_) == ''){   
								 paid_auto_dis_ = 0;
								 }else if (!validate_number_value(paid_auto_dis_)){
								 paid_auto_dis_ = 0;
								 }
						 					    
 
								  var cashVal = parseFloat($(this).val());
								 
							     if(jQuery.trim($(this).val()) == ''){   
								 cashVal = 0;
								 }
								 
									if(!validate_number_value(cashVal)){
									}else{
									 
										var current_total_blance = balanceCulAll - (cashVal + paid_auto_dis_);
                               
                                        var currentRemainingCash_ = remainingDepst -  cashVal;
								 
									    $("p#reminingDpstLaundry").text(CommaFormattedN(currentRemainingCash_));
										$('#balanceLaundry_One').text(CommaFormattedN(current_total_blance));
 
									}
							});
				
         $('#paid_laundry_One').keyup(function (){
				 
							   var cashVal = parseFloat($("#depositCashLaudnry").val());
 
								 if(jQuery.trim(cashVal) == ''){   
								 cashVal = 0;
								 }else if (!validate_number_value(cashVal)){
								 cashVal = 0;
								 }
						 					    
 
								  var paid_auto_dis_ = parseFloat($(this).val());
								 
							     if(jQuery.trim($(this).val()) == ''){   
								 paid_auto_dis_ = 0;
								 }
								 
									if(!validate_number_value(paid_auto_dis_)){
									}else{
									 
										var current_total_blance = balanceCulAll - (cashVal + paid_auto_dis_);
 
										$('#balanceLaundry_One').text(CommaFormattedN(current_total_blance));
 
									}
									
									$('#checkInWords').text(toWords(paid_auto_dis_));
							});
  
  
		   var print_depositStatus = 'off';  
		$('#print_deposit2').click(function() {
			if( $(this).is(':checked')) {
			   print_depositStatus = 'on';
			}else{
			   print_depositStatus = 'off';  
			}

		}); 

			 $('#payOneTime_Laundry_div').dialog({  show: "blind", hide: "explode", width: '500',  height:'600',  modal: true, buttons:  {
						 "Ok": function() {
                       // validate and submit 
                         var newTotalPaid = $('#paid_laundry_One').val(); 
						 var depositCash =  $('#depositCashLaudnry').val();
                     	       var checkBankName = $('#checkBankName').val();
						       var checkDate =  $('#checkDate').val();
						       var checkName = $('#checkName').val();
						       var checkAddress =  $('#checkAddress').val();
						       var checkAcountNo =  $('#checkAcountNo').val();
						       var checkPayToName =  $('#checkPayToName').val();
						       var checkInWords =  $('#checkInWords').text();
						       var checkMemo =  $('#checkMemo').val();
				               var paymentOption =   $('#paymntType_1').val();		   
 
 
	 if(paymentOption == 'check'){
	 
		 if(jQuery.trim(checkBankName) == ''){
			   error_func('Error Enter Bank Name!');	
			 $('#checkBankName').css('border','2px groove red');
			  return false
		 }else if(jQuery.trim(checkDate) == ''){
		  error_func('Error Enter Date!');	
			 $('#checkDate').css('border','2px groove red');
			  return false
		 }else if(jQuery.trim(checkName) == ''){
		  error_func('Error Enter Name!');	
			 $('#checkName').css('border','2px groove red');
			  return false
		 }else if(jQuery.trim(checkAcountNo) == ''){
			 error_func('Error Enter Acount Number!');	
			 $('#checkAcountNo').css('border','2px groove red');
			  return false
		 }else if(jQuery.trim(checkPayToName) == ''){
			 error_func('Error Enter order Name!');	
			 $('#checkPayToName').css('border','2px groove red');
			  return false
		 }
	 
	 }else if(paymentOption == 'Choose.'){
	     error_func('Error Select Payment Type!');
		 return false;
	 }
				       
					   if(!validate_number_value(newTotalPaid) && !validate_number_value(depositCash) != ''){
					         error_func('Error invalid Paid Or Deposits !');	
					         $('#paid_laundry_One').css('border','2px groove red');
							  $('#depositCashLaudnry').css('border','2px groove red');
				          }else if((parseFloat(condFunction(jQuery.trim(newTotalPaid) == '',0,newTotalPaid)) + parseFloat(condFunction(jQuery.trim(depositCash) == '',0,depositCash))) > parseFloat(balanceCulAll)){
						       error_func('Error invalid Paid Or Deposits !');	
					          $('#paid_laundry_One').css('border','2px groove red');
							  $('#depositCashLaudnry').css('border','2px groove red');
						  }else if( parseFloat(depositCash) >  parseFloat(remainingDepst)){
						        error_func('Error invalid Deposits !');	
							  $('#depositCashLaudnry').css('border','2px groove red');
						  }else{
						  
					      newTotalPaid  =  parseFloat(condFunction(jQuery.trim(newTotalPaid) == '',0,newTotalPaid));
						  var amount_mony = newTotalPaid;
						  depositCash  =  parseFloat(condFunction(jQuery.trim(depositCash) == '',0,depositCash));
						  depositCash_1 = depositCash;
					

                               //  check info 
							checkBankName1 = checkBankName;	
							checkDate1 = checkDate;		
							checkName1 = checkName;		
							checkAddress1 = checkAddress;		
							checkAcountNo1 = checkAcountNo;		
							checkPayToName1 = checkPayToName;		
							checkInWords1 = checkInWords;
							checkMemo1 = checkMemo;
							paymentOption1 = paymentOption;	
							   // end of check info					
				 
					 var data_length_len = itemm_name.length;
						 //   pay by paid 	
						 for(i=0;i<data_length_len; i++){
						 
						            var ch_piad_andRemain =  Number(paid_sel[i])  +  newTotalPaid;
									if(ch_piad_andRemain > Number(price_sel[i])){
									// 600 > 400  = 600 - 400 = 200 
									 paid_sel[i] = Number(price_sel[i]);
									 balance_sel[i]  = 0;
									 newTotalPaid = ch_piad_andRemain - Number(price_sel[i]);
						 
									  }else{
                                   var oldPaid = paid_sel[i]; 
									 paid_sel[i] = Number(paid_sel[i]) + newTotalPaid;  
									 balance_sel[i] = Number(price_sel[i]) - Number(paid_sel[i]);
								 
									 newTotalPaid -= Number(paid_sel[i]) - oldPaid; 
						 
									}
		 
							   }
	 
 			            // pay by Deposit
 					    if(cust_id_ != '-'){
					
						 //   pay by deposit 
						 for(i=0;i<data_length_len; i++){
						   var ch_piad_andRemain1 =  Number(paid_sel[i])  +  depositCash;  // 500 d  200 p   pr 500    balance 300 
									
									if(ch_piad_andRemain1 > Number(price_sel[i])){
								 
									 sellItemDeposit[i] =  Number(condFunction(jQuery.trim(sellItemDeposit[i]) == '',0,sellItemDeposit[i])) + Number(balance_sel[i]);
									 
									 paid_sel[i] = Number(price_sel[i]);
									 
									 
									 balance_sel[i]  = 0;
									 depositCash = ch_piad_andRemain1 - Number(price_sel[i]);
									 
					
									  }else{
									   var oldPaid2 = paid_sel[i]; 
									   sellItemDeposit[i] =  Number(condFunction(jQuery.trim(sellItemDeposit[i]) == '',0,sellItemDeposit[i]))  + depositCash;
									 paid_sel[i] = Number(paid_sel[i]) + depositCash;
									 balance_sel[i] = Number(price_sel[i]) - Number(paid_sel[i]);
									 depositCash -= Number(paid_sel[i]) - oldPaid2; 
					 
									}
		 
							   }				 
			               
					  }else{
					  
					  }  
					
					
					
 					     $(this).dialog("close");
 	                      $("#confirm_selling_item").html(confirmation_function());
						  remainingCulc += depositCash_1;
					//	  alert(depositCash);    alert(remainingCulc); 
						   applayTableIntoConfiramtion();
						  applyButtons();
                        	
	   
								 if(paymentOption1 == 'check'){
											   if(print_depositStatus == 'on'){
											       // print check 
												       print_Check(checkBankName1,checkDate1,checkName1,checkAddress1,checkAcountNo1,checkPayToName1,checkInWords1,checkMemo1,amount_mony);
											    }
								     }
										   							
						  
						  }
						 
 
						  },
							
						"Cancel": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
              $('div [aria-describedby="payOneTime_Laundry_div"] div:first span').text('Editing Balance for ('+custom_name+')'); 
			    $('div#addDeposit').css('height','630px !important');   
	 	});
		   
 	
	    
			 function applayTableIntoConfiramtion(){
			  
				  $("#confirm_selling_item table#confima_table,#confirm_selling_item table#confima_table_total").dataTable({
							 "sPaginationType":"full_numbers",
							  "bJQueryUI":true
						 });
						 
					  $("#confirm_selling_item div#confima_table_total_wrapper #confima_table_total_filter").remove();
					 $("#confirm_selling_item div#confima_table_total_wrapper #confima_table_total_length").html('<label> Totals </label>');
					  
					 $('div [aria-describedby="confirm_selling_item"] div:first span').text('Confirmation of Selling Item To ('+custom_name+')'); 
                    //  format_number('.int_no');
					
					  	
					return false;
					}
		 
		        applayTableIntoConfiramtion();
	 
	      //edit balance link                

		
 
					
			 		  }	 
 
						}, 'Cancel': function(){
						  
     						$(this).dialog('close');
						}}});
 		
      $('div [aria-describedby="update_custom"] div:first span').text(newNamce); 
	 
return false;
}
 
 
 
 
 
 
function moreDetails_of_cust(checks,reminingCash,email_cust,table,id,id2,name,number){
  clicked_custom_id = id2;
  
  if(checks == '0'){
    var check_link = '';
   }else{
    var check_link = '<a  href=# title="click to see checks"     class="link_button" id="check_s_info"  > Checks </a>';
   }
  

 $("#moreDitails_of_cust_no_bal").html('<button id="add_sell" >Sell to <strong>('+name+') </strong> </button>'+check_link+table).dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto', position:'top', modal: true, buttons:  {
						"Close": function() {
							$(this).dialog("close");
		}}, });
		
					 $('div#moreDitails_of_cust_no_bal table').dataTable({
							 "sPaginationType":"full_numbers",
							  "bJQueryUI":true
						 });
 

					$("div#customs_table_total_wrapper #customs_table_total_filter").remove();
					 $("div#customs_table_total_wrapper #customs_table_total_length").html('<label>All Totals </label>');
					  $('div [aria-describedby="moreDitails_of_cust_no_bal"] div:first span').text(' Items for ('+name+')'); 
					  
					$('div#moreDitails_of_cust_no_bal button#add_sell').button(
					  {
						height:'10px',
						icons: {primary: 'ui-icon-circle-plus', secondary: null}
					  }
					).click(function (){
					    $('div#update_custom  input[type="text"]').val('');
 
					add_to_sell_theCurrent_cus(reminingCash,email_cust,id,name,number);
					});
					
				    $('div#moreDitails_of_cust_no_bal a#check_s_info').click(function (){
					   var custom_nme='Checks for (<strong>'+name+'</strong>)';
                         custDeposit(0,checks,custom_nme,0);
					 });
  
  
applyButtons();
return false;
}
 
// delete custom complete
 function delete_of_cust(custom_id,name){
 
 var wornin_messge = '';
 if (name == 'Unknown'){
 wornin_messge = 'Are sure you want to delete this person ?';
 }else{
  wornin_messge = 'Are sure you want to delete <strong> '+name+'</strong> ?';
 }
 
	   $('#warning').html('<img src="css/warning.png" alt="warning" style="border-radius:2.5em; width:80px; height:40px; margin-right: 4px; "/>'+wornin_messge).dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Yes": function() {
							 // delete the current Item 
							  
							  $(this).dialog("close");
							  loading_func(); // SHOW LOADING IMAGE DIALOG
							$.post('php_f/del_custom.php', {custom_id:custom_id}, function(feedback_date_del) {					
								
								if(feedback_date_del == 5){ 
								
								      toggle_for_sold_items = '3'; 
									  Load_Items();
						 
								 }else{
								  $("#loading").dialog('close'); 
								  error_func(feedback_date_del);
								}
								
							});
							 
							 
							 
						 },
							
						"No": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
							
	  $('div [aria-describedby="warning"] div:first span').text('Deleting'); 
 
 return false;
 }
 
 
 
  
  //change_name_of_cust
 function change_name_of_cust(custom_id_,name_,mobileNumber,cusEmail){
        // put value current name 
	
 
	   $('#warning').html('<label>Custom Name:</label><input type="text"   id="edit_custom_name"><br><br> <label>Mobile Number:</label><input type="text" id="mobile_editing" > <br><br>   <label> Email:</label><input type="text"  style=" width: 317px; "  id="custEmail"> ').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Ok": function() {
							 // change  the current Item 
							  	 
                                 var new_name   =  $('#warning #edit_custom_name').val();
								 var new_number  = $('#warning #mobile_editing').val();
								 var custEmail = $('#warning #custEmail').val();
								 
								 if(!validate_number_value2(new_number) && jQuery.trim(new_number) != '' ){
								   error_func2('Error invalid mobile number !');	
								 }else{
								   $(this).dialog("close");
							  loading_func(); // SHOW LOADING IMAGE DIALOG
							$.post('php_f/change_custom_name.php', {custom_id_:custom_id_,new_name:new_name,new_number:new_number,custEmail:custEmail}, function(feedback_date_edit) {					
								
								if(feedback_date_edit == 6){ 
								   
								      toggle_for_sold_items = '6'; 
									
								 	// $("div#loading").dialog('close'); 
									// success_func('<strong>Successfull</strong>'); 
									 Load_Items();
						 
								 }else{
								  $("#loading").dialog('close'); 
								  error_func(feedback_date_edit);
								}
								
							});
							 
								 }
							
							 
							 
						 },
							
						"Cancel": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
        $('div [aria-describedby="warning"] div:first span').text('Editing ('+name_+')'); 
		 	 $('#warning #edit_custom_name').val(name_);
			  $('#warning #custEmail').val(cusEmail);
		 $('#warning #mobile_editing').val(mobileNumber);
 return false;
 }
 
 
 
 // delete custom details 
 function delete_custom_detail(dele_id){
  
	   $('#warning').html('<img src="css/warning.png" alt="warning" style="border-radius:2.5em; width:80px; height:40px; margin-right: 4px; "/>Are you Sure you want to delete ?').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Yes": function() {
							 // submit the ans-ware
							  $(this).dialog("close");
							  loading_func(); // SHOW LOADING IMAGE DIALOG  
							$.post('php_f/del_custom_detail.php', {dele_id:dele_id}, function(feedback_data_del_detail) {					
								
								if(feedback_data_del_detail == 66){ 
								
								      toggle_for_sold_items = '66'; 
									    more_oppenStatus = 'on';
									  Load_Items();
						 
								 }else{
								  $("#loading").dialog('close'); 
								  error_func(feedback_data_del_detail);
								}
								
							});
							 
							 
							 
						 },
							
						"No": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
							
							
		    $('div [aria-describedby="warning"] div:first span').text('Deleting'); 
 
 return false;
 }
 
 
 // '.$daidline.','.$mobile.','.$message.','.$allowSms.','.$cust_name'.
 
 
 function edit_custom_detail(id,customer_id,paid,balance,daidline,mobile,message,allowSms,custom_name){
  
  
  $("li#pymentType2").html('<label>Paymen type : </label><select id="paymntType_2"><option class="opt">Cash</option>  <option class="opt">check</option> </select>');
		 // $("#paymntType_1 option").removeAttr('selected');
		  	$("li#pymentType2 select#paymntType_2").data("placeholder","Select item name...").chosen();
			 $('div#paymntType_2_chzn div.chzn-search').remove(); 
		     $('#checkDiv_2').attr('style','display:none;');  // hide
			toggePaymentType2();
  
 	$('#paid_edit').val('');
  
    $('#deadline_edit').val(daidline);
	$('#mobile_edit').val(mobile);
		$('#balance_edit').text(CommaFormattedN(balance));
 
  // var otherdetails_stutas =  $('#otherclaps_edit').attr('stutas','off');
  
 if(allowSms == 'on'){
 
   var chack_status_allow_   =  $('#allow_sms_edit').val();
	if(chack_status_allow_ == 'on'){
	  document.getElementById('allow_sms_edit').click();
	  $('#allow_sms_edit').attr('old',message);   
      document.getElementById('allow_sms_edit').click();
	}else{
	 $('#allow_sms_edit').attr('value','off');
	  $('#allow_sms_edit').attr('old',message);   
	     document.getElementById('allow_sms_edit').click();
	}
 
 
 
    var oppen_status_allow   = $('#otherclaps_edit').attr('stutas');
	if(oppen_status_allow == 'on' ){
	
	}else{
	  $('#otherclaps_edit').attr('stutas','off');
       document.getElementById('otherclaps_edit').click();
    }

 }else{
	 
    var chack_status_allow   =  $('#allow_sms_edit').val();
	if(chack_status_allow == 'on'){
	 
	  document.getElementById('allow_sms_edit').click();
	
	}
 
		var oppen_status_allow   = $('#otherclaps_edit').attr('stutas');
			if(oppen_status_allow == 'off' ){
			
			}else{
			  $('#otherclaps_edit').attr('stutas','on');
			   document.getElementById('otherclaps_edit').click();
			}
 }

				        // auto calculate  balance paid
						$('#paid_edit').keyup(function (){
							
			            var  paid_value =  $(this).val();
						  $('#checkInWords2').text(toWords(paid_value));
						 if(jQuery.trim($(this).val()) == '' ){
						 paid_value = 0;
						 }
			 
			 
			 
					    if(!validate_number_value2(paid_value)){
					    }else{
							
							 	var current_balance_remainig =  balance - paid_value;	 
									 $('#balance_edit').attr('balance_edit',current_balance_remainig).text(CommaFormattedN(current_balance_remainig));
							 
						    }
							
							  
							  });
					
   $('#edit_balance_col input[type="text"]').removeAttr('style');
   $('#edit_balance_col p').css('font-weight','bold');
   
   
   
   	   var print_depositStatus = 'off';  
		$('#print_balanceEdit1').click(function() {
			if( $(this).is(':checked')) {
			   print_depositStatus = 'on';
			}else{
			   print_depositStatus = 'off';  
			}

		}); 
		
		 $('#paid_edit').val('0'); 
	   $('#edit_balance_col').dialog({  show: "blind", position:'top',hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Ok": function() {
							 // change  the current Item 
							  	var paid_edit   =  $('#paid_edit').val(); 
								var paid_old   =   paid;
							    var balance_old   =   balance;
								var mobile_edit   =  $('#mobile_edit').val();
                                var deadline_edit   =  $('#deadline_edit').val();
								var allow_sms_edit   =  $('#allow_sms_edit').val();
								var message_edit   =  $('#message_edit').val();
								



   	                           var checkBankName = $('#checkBankName2').val();
						       var checkDate =  $('#checkDate2').val();
						       var checkName = $('#checkName2').val();
						       var checkAddress =  $('#checkAddress2').val();
						       var checkAcountNo =  $('#checkAcountNo2').val();
						       var checkPayToName =  $('#checkPayToName2').val();
						       var checkInWords =  $('#checkInWords2').text();
						       var checkMemo =  $('#checkMemo2').val();
				               var paymentOption =   $('#paymntType_2').val();		   
 
 
	 if(paymentOption == 'check'){
	 
		 if(jQuery.trim(checkBankName) == ''){
			   error_func('Error Enter Bank Name!');	
			 $('#checkBankName2').css('border','2px groove red');
			  return false
		 }else if(jQuery.trim(checkDate) == ''){
		  error_func('Error Enter Date!');	
			 $('#checkDate2').css('border','2px groove red');
			  return false
		 }else if(jQuery.trim(checkName) == ''){
		  error_func('Error Enter Name!');	
			 $('#checkName2').css('border','2px groove red');
			  return false
		 }else if(jQuery.trim(checkAcountNo) == ''){
			 error_func('Error Enter Acount Number!');	
			 $('#checkAcountNo2').css('border','2px groove red');
			  return false
		 }else if(jQuery.trim(checkPayToName) == ''){
			 error_func('Error Enter order Name!');	
			 $('#checkPayToName2').css('border','2px groove red');
			  return false
		 }
	 
	 }else if(paymentOption == 'Choose.'){
	     error_func('Error Select Payment Type!');
		 return false;
	 }
		


		
								if(jQuery.trim(paid_edit) == '' ){ 			 
											   error_func2('Error please enter Amount of paid !');	
											   $('#paid_edit').css('border','1px groove red');
								    }else if (!validate_number_value2(paid_edit) && jQuery.trim(paid_edit) != '') {
									        // check if value is is not valid
											 
											   error_func2('Error invalid Paid !');	
											   $('#paid_edit').css('border','2px groove red !');
									}else if(parseFloat(paid_edit) > (balance_old)){	 
											   error_func2('Error Invalid Paid !');	
											   $('#paid_edit').css('border','2px groove red !');
									}else if (jQuery.trim(allow_sms_edit) == 'on' && jQuery.trim(message_edit) == '' ) { 
									      //  check  if message is empty!
									        error_func2('Error the message is blank !');	
										    $('#message_edit').css('border','2px groove red !');       
									}else if (jQuery.trim(mobile_edit) == '' && jQuery.trim(message_edit) != '' ) { 
									      //  check  if message is empty!
									        error_func2('Error please enter mobile number !');	
										    $('#mobile_edit').css('border','2px groove red !');       
								     }else if (!validate_number_value2(mobile_edit) && jQuery.trim(mobile_edit) != '') {
										 error_func2('Error invalid mobile number !');	
										    $('#mobile_edit').css('border','2px groove red !'); 
									}else{
									
						      
							    var paid_edit   =  $('#paid_edit').val(); 
								var paid_old   =   paid;
							    var balance_old   =   balance;
								var mobile_edit   =  $('#mobile_edit').val();
                                var deadline_edit   =  $('#deadline_edit').val();
								var allow_sms_edit   =  $('#allow_sms_edit').val();
								var message_edit   =  $('#message_edit').val();
								
								
								
								    //  check info 
							checkBankName1 = checkBankName;	
							checkDate1 = checkDate;		
							checkName1 = checkName;		
							checkAddress1 = checkAddress;		
							checkAcountNo1 = checkAcountNo;		
							checkPayToName1 = checkPayToName;		
							checkInWords1 = checkInWords;
							checkMemo1 = checkMemo;
							paymentOption1 = paymentOption;	
							   // end of check info			
							 
								
							   loading_func(); // SHOW LOADING IMAGE DIALOG
							$.post('php_f/edit_custom_detail.php', {paymentOption1:paymentOption1,checkMemo1:checkMemo1,checkInWords1:checkInWords1,checkPayToName1:checkPayToName1,checkAcountNo1:checkAcountNo1,checkAddress1:checkAddress1,checkName1:checkName1,checkDate1:checkDate1,checkBankName1:checkBankName1,customer_id:customer_id,id:id,paid_edit:paid_edit,paid_old:paid_old,balance_old:balance_old, mobile_edit:mobile_edit, deadline_edit:deadline_edit,allow_sms_edit:allow_sms_edit,message_edit:message_edit}, function(feedback_data_edit_balace) {					
								
								if(feedback_data_edit_balace == 23){ 
								 
									      more_oppenStatus = 'on';
									       Load_Items();
									  if($("#loading").closest('.ui-dialog').is(':visible')) { 
										    $("#loading").dialog('close');
										    $("#edit_balance_col").dialog('close');
										    $("#moreDitails_of_cust_no_bal").dialog('close');
										  success_func('<strong>Successfull</strong>'); 
									     }
									  
									 if(paymentOption1 == 'check'){
											   if(print_depositStatus == 'on'){
											       // print check 
												       print_Check(checkBankName1,checkDate1,checkName1,checkAddress1,checkAcountNo1,checkPayToName1,checkInWords1,checkMemo1,amount_mony);
											    }
								       }	  
									
									
								 }else{
								  $("#loading").dialog('close'); 
								  error_func2(feedback_data_edit_balace);
								}
								
							});
							 
									
									}
								
								 
 
							 
						 },
							
						"Cancel": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
       $('div [aria-describedby="edit_balance_col"] div:first span').text('Editing ('+custom_name+')'); 
		//$('#warning input[type="text"]').val(name_).select();
 
 return false;
 }
 

 function paid_history_details(table,name){

  $("#paid_history_table").html(table).dialog({position:'top',  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
						"Okay": function() {
							$(this).dialog("close");
						
		}}, });
 
 applyButtons();
 
 $("div#paid_history_table div.receiveCgryTabs").tabs();
  
 $('div#paid_history_table table').attr({
    cellpadding:'0',
	cellspacing:'0',
	border:'0',
	class:'display',
    width:'100%' 
  });
  
  
  $('#paid_history_table table,#paid_history_table div#receiveCgryTabs table').dataTable({
							 "sPaginationType":"full_numbers",
							  "bJQueryUI":true
						 });
		
  var filter_ = /\(/;
 
if($("div#paid_history_table div.receiveCgryTabs").length){
     $('div [aria-describedby="paid_history_table"] div:first span').text(name); 
 
}else{
	 
if (filter_.test(name)) {
     $('div [aria-describedby="paid_history_table"] div:first span').text(name); 
	 $("#table_total_histry_deposit_filter").remove();//
	 $("#table_total_histry_deposit_length").html('<label>current Totals </label>');
	  $('div#paid_history_table div.dataTables_wrapper:last').find('div.dataTables_length').html('<label> </label>');	
	  $('div#paid_history_table div.dataTables_wrapper:last').find('div.dataTables_filter').remove();
}else{
     $('div [aria-describedby="paid_history_table"] div:first span').text('payment for ('+name+')'); 
	   $("div#table_total_histry_paid_wrapper #table_total_histry_paid_filter").remove();
		 $("div#table_total_histry_paid_wrapper #table_total_histry_paid_length").html('<label>current Totals </label>');
 
}

}		
   
 
      
     
 
 return false;
 }
 
 
 
 function  deletePaid_history(current_paid,current_balance,paid,colm_id,id){
   
	   $('#warning').html('<img src="css/warning.png" alt="warning" style="border-radius:2.5em; width:80px; height:40px; margin-right: 4px; "/>Are you Sure you want to delete ?').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Yes": function() {
							 // submit the ans-ware
							  $(this).dialog("close");
							  loading_func(); // SHOW LOADING IMAGE DIALOG  
							$.post('php_f/del_custom_paid.php', {current_paid:current_paid,current_balance:current_balance,paid:paid,colm_id:colm_id,id:id}, function(feedback_del_paid) {					
								
								if(feedback_del_paid == 44){ 
								      $('#paid_history_table').dialog("close");
								      toggle_for_sold_items = '44'; 
									  more_oppenStatus = 'on';
									  Load_Items();
						 
								 }else{
								  $("#loading").dialog('close'); 
								  error_func(feedback_del_paid);
								}
								
							});
							 
							 
							 
						 },
							
						"No": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
   $('div [aria-describedby="warning"] div:first span').text('Deleting'); 
 return false;
 }
 
