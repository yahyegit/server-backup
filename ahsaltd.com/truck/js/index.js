
 
	function sellingPlanChoiseFunc(chosenPlan){
 

 
	return false;
	}
	
	// for items only 
	function sellingPlanChoiseFunc2(chosenPlan2){

  
		  var Single_sell_Price  =  condFunction(jQuery.trim($('#Single_sell_Price').val())=="",0,Number($('#Single_sell_Price').val()));
		  var sl_benefit  =    condFunction(jQuery.trim($('#sl_benefit').val())=="",0,Number($('#sl_benefit').val()));
 	  
	   	  var Wholesale_price  =   condFunction(jQuery.trim($('#Wholesale_price').val())=="",0,Number($('#Wholesale_price').val()));
		  var wl_benefit  =     condFunction(jQuery.trim($('#wl_benefit').val())=="",0,Number($('#wl_benefit').val()));
 	   
 
   if(chosenPlan2 == "Retail"){
     //  $("li#sellPlan1 input").val('');
      $("li#sellPlan1").hide();  // wholesell
	  $("li#sellPlan2").show();   // retail
   $("#t_slPrice").text(CommaFormattedN( condFunction(!validate_number_value(Single_sell_Price),0,Single_sell_Price) + condFunction(!validate_number_value(sl_benefit),0,sl_benefit) ));
  //  $("#t_wlPrice").text('0');
  // $("#Single_sell_Price").val(condFunction(!validate_number_value(wl_benefit),0,wl_benefit));
   }else{
 $("#t_wlPrice").text(CommaFormattedN( condFunction(!validate_number_value(Wholesale_price),0,Wholesale_price) + condFunction(!validate_number_value(wl_benefit),0,wl_benefit) ));
 //$("#t_slPrice").text('0');
    // $("li#sellPlan2 input").val('');
      $("li#sellPlan2").hide();  // wholesell
	  $("li#sellPlan1").show();   // retail
   }

 
	return false;
	}
	
// golobal veribals 
 var calculatedCost_persentage = 0;
 var persent_now = 0;
       $(document).delegate("#sl_benefit, #Single_sell_Price","keyup", function (){
	    var maxDisaad  =   parseFloat($('#maxDisc_newItem').val()); 
		  if($(this).attr('id') == 'Single_sell_Price'){
		    var sl_benefit  =  parseFloat($('#sl_benefit').val());
			var single_sell_Price  =  parseFloat($(this).val());		                
		  }else{
		    var sl_benefit  =    parseFloat($(this).val());
			var siglpnf  =   parseFloat($(this).attr('befitSingle')); 
 
			$(this).attr('befitSingle',condFunction((sl_benefit + maxDisaad) == siglpnf,siglpnf,sl_benefit));
 
			var single_sell_Price  =    parseFloat($("#Single_sell_Price").val());		                
		  }
		  

	     
		if(jQuery.trim(single_sell_Price) == ''){   
		     single_sell_Price = 0;
		}
		
		// calculate cost from price
		 var calculatedCost = condFunction(jQuery.trim($("input#Number_of_Item").val()) == '',single_sell_Price * 0,single_sell_Price * parseFloat($("input#Number_of_Item").val()));
		// $("input#cost_of_item").val(condFunction(jQuery.trim(calculatedCost) == 'NaN','',calculatedCost));
	 
	  // t_slPrice   t_wlPrice

		 $("#t_slPrice").text(CommaFormattedN( condFunction(validate_number_value(single_sell_Price),single_sell_Price,0) + condFunction(validate_number_value(sl_benefit),sl_benefit,0)));
	
	 });
	
        
	   $(document).delegate("#wl_benefit,#Wholesale_price","keyup", function (){
	 
             var maxDisaad  =   parseFloat($('#maxDisc_newItem').val()); 
	     if($(this).attr('id') == 'Wholesale_price'){
		    var wl_benefit  =    parseFloat($('#wl_benefit').val());
			var wholesale_price  =   parseFloat($(this).val());             
		  }else{
		    var wl_benefit  =    parseFloat($(this).val());
			var whlpnf  =   parseFloat($(this).attr('befitWhole')); 
 
			$(this).attr('befitWhole',condFunction((wl_benefit + maxDisaad) == whlpnf,whlpnf,wl_benefit));
			var wholesale_price  =   parseFloat($("#Wholesale_price").val());
		  }
		  

		if(jQuery.trim(wholesale_price) == ''){   
		     wholesale_price = 0;
		}
	 
	 	 // calculate cost from price
 
	 	 var calculatedCost = condFunction(jQuery.trim($("input#Number_of_Item").val()) == '',wholesale_price * 0,wholesale_price * parseFloat($("input#Number_of_Item").val()));
	//	 $("input#cost_of_item").val(condFunction(jQuery.trim(calculatedCost) == 'NaN','',calculatedCost));
	 
	 
	  // t_slPrice   t_wlPrice
 
       $("#t_wlPrice").text(CommaFormattedN( condFunction(validate_number_value(wholesale_price),wholesale_price,0) + condFunction(validate_number_value(wl_benefit),wl_benefit,0)));
	
 
	 });
 	
 $(document).ready(function(){
 
 
   $('#checkDate,#checkDate2,#checkDate3,#dateSchedule').datepicker({dateFormat:"yy/M/dd"});
   
   $('.expireDAte_item').datepicker({dateFormat:'dd-M-yy',minDate:0}); 
 
 //paymntType_1
 $('#enableChangePass').click(function(){
    if( $(this).is(':checked')) {
       $('#edit_password,#edit_confi_password').removeAttr('disabled');
	    $('#edit_password').focus();
    }else{
      $('#edit_password,#edit_confi_password').attr('disabled','disabled');
    }
});
	 

 $('#showCurrntPriceses').click(function(){
    if( $(this).is(':checked')) {
	// var maxDis_val  =  condFunction(validate_number_value(parseFloat($('#maxDisc_newItem').val())),parseFloat($('#maxDisc_newItem').val()),0) ; 
     var maxDis  =   parseFloat($('#maxDisc_newItem').val()); 
	      if(jQuery.trim(maxDis) == ''){   
			   maxDiscKeyUp(0);
			}else{
			   maxDiscKeyUp(maxDis);
			}
	 
    }else{
    	     pricCalcRest();
    
	}
});
		
// 	Number_of_Item     cost_of_item    Wholesale_price   wl_benefit    Single_sell_Price sl_benefit 
 
 	
	function maxDiscKeyUp(maxDis){
	    var whsBenefit  =    parseFloat($('#wl_benefit').attr('befitWhole'));
		var sgsBenefit  =    parseFloat($('#sl_benefit').attr('befitSingle'));
	    
		if(jQuery.trim(whsBenefit) == ''){   
		     whsBenefit = 0;	 
		}
		
		if(jQuery.trim(sgsBenefit) == ''){   
		     sgsBenefit = 0;	 
		}
      
	   $(this).attr('befitSingle');
	        var Wholesale_price_  =    parseFloat($('#Wholesale_price').val());
			var Single_sell_Price_  =    parseFloat($('#Single_sell_Price').val());
			
	if(whsBenefit >= maxDis){
	  var neWwhsBenefit  = whsBenefit - maxDis;
	// var neWsgsBenefit  = sgsBenefit - maxDis;
	  // t_slPrice   t_wlPrice
            $('#wl_benefit').val(neWwhsBenefit);
			//$('#sl_benefit').val(neWsgsBenefit);
			
		  $("#t_wlPrice").text(CommaFormattedN(Wholesale_price_ + neWwhsBenefit));
		  //$("#t_slPrice").text(CommaFormattedN(Single_sell_Price_ + neWsgsBenefit));
 
	}
	
	if(sgsBenefit >= maxDis){
	   //var neWwhsBenefit  = whsBenefit - maxDis;
	 var neWsgsBenefit  = sgsBenefit - maxDis;
	  // t_slPrice   t_wlPrice
            //$('#wl_benefit').val(neWwhsBenefit);
			$('#sl_benefit').val(neWsgsBenefit);
			
		 // $("#t_wlPrice").text(CommaFormattedN(Wholesale_price_ + neWwhsBenefit));
		  $("#t_slPrice").text(CommaFormattedN(Single_sell_Price_ + neWsgsBenefit));
	}
	
	  return false;
	  }
	      

 
  
	 
	
 // calculating singl and whole from number of items
 
      $('#Number_of_Item').keyup(function (){

          if(jQuery.trim($(this).val()) == ''){   
		  return false;
		}

          var singleCost  = parseFloat($("input.persentTage").val().replace(/,/g, ''));
	  var number_of_Item  =  parseFloat($(this).val().replace(/,/g, ''));
          $('#cost_of_item').val(CommaFormattedN(Math.floor(singleCost * number_of_Item)));
                  
      var availbleQuantity =  parseFloat($("li#itemNamesSelect select").find("option:selected").attr("availbleItemsNow"));
	    var satustion  = $(this).attr('mod');
	    var satustionVAl  = $(this).attr('removeAval');
 
	   
	   // calculate current available quantity
	  if(satustion == 'edit'){
	  
		 if(Number(number_of_Item) < satustionVAl){
			$('#availableItems').html(CommaFormattedN(condFunction(validate_number_value(availbleQuantity),availbleQuantity,0)));
		  }else{
		   var number_of_Item2 =  number_of_Item - satustionVAl; 
		   $('#availableItems').html(CommaFormattedN(number_of_Item2 + availbleQuantity ));
		  }
		  
	  }else{
 $('#availableItems').html(CommaFormattedN(number_of_Item2 + availbleQuantity ));

	   $('#availableItems').html(CommaFormattedN(number_of_Item + availbleQuantity));
	 
 }  	 
	 
	  
	 }); 	
	   
	 
	 	// tab text to the current item name 
	 $("input.newItemName").change(function(){
        $('#tabes_handler_items a#'+$(this).attr("tab_id")+'').html($(this).val());
    });
 
	
	
	 // $('#Number_of_Item').attr("disabled","disabled");
     $("input.persentTage").change(function (){

          if(jQuery.trim($(this).val()) == ''){   
		  return false;
		}

          var singleCost  = parseFloat($(this).val().replace(/,/g, ''));
	  var number_of_Item  =  parseFloat($("#Number_of_Item").val().replace(/,/g, ''));	
         
	    $('#cost_of_item').val(CommaFormattedN(singleCost * number_of_Item));

   
          });
 
     

 
 
  
  	 

	
  $('#sl_benefit, #wl_benefit').blur(function (){
  
	    if( $('#showCurrntPriceses').is(':checked')) {
            var maxDis  =   parseFloat($('#maxDisc_newItem').val()); 
	      if(jQuery.trim(maxDis) == ''){   
			   maxDiscKeyUp(0);
			}else{
			   maxDiscKeyUp(maxDis);
			}
	 
       }

  });
 
      $('#maxDisc_newItem').keyup(function (){
	  
	     if( $('#showCurrntPriceses').is(':checked')) {
	  	  var maxDis  =   parseFloat($(this).val()); 
		 if(jQuery.trim($(this).val()) == ''){   
		     maxDiscKeyUp(0);
			}else{
			maxDiscKeyUp(maxDis);
			}
		}
		
 
	 });
	 
  
 



  
 
 
 /*  $('#showBeds_div button#add_storeNU_button').click(function (){
			 ();
			 return false;
			 });
  			  */
 
 
 // toggle  button for selling laudry Item 
  
    $('button#toggle_DepositRmng_laundry').click(function (){
	 
	  if($(this).attr('toggle')  ==  'plus'){
	   // show
	 
	    $(this).attr("title","Click to Hide");    
	   $(this).attr('toggle','minus').button(
	  {
	    height:'auto',
		icons: {primary: 'ui-icon-minus', secondary: null}
	  }).css('font-size','9px').css('height','22px');
	  
	   $("#paybyDepositLaundry").show();
	   }else{
	   	   // hide
	     $(this).attr("title","Click to See Remaining Deposit ");   
	   
		$('#depositCashLaudnry').val('');
  
	   $(this).attr('toggle','plus').button(
	  {
	    height:'auto',
		icons: {primary: 'ui-icon-plus', secondary: null}
	  }).css('font-size','9px').css('height','22px');
	  
	   
	   $("#paybyDepositLaundry").hide();
	   
	   $('p#reminingDpstLaundry').text(CommaFormattedN($(this).attr('remaining'))).attr('style','font-weight:bold'); 
	   
	    
						       var balanceLaundry_One   = parseFloat($("#balanceLaundry_One").attr('oBalance'));  // price
							   var paid_auto_dis_ = parseFloat($("#paid_laundry_One").val());
					  
								 if(jQuery.trim(paid_auto_dis_) == ''){   
								 paid_auto_dis_ = 0;
								 }else if (!validate_number_value(paid_auto_dis_)){
								 paid_auto_dis_ = 0;
								 }
 
									if(!validate_number_value(balanceLaundry_One)){
									}else{
										var current_total_blance_p = balanceLaundry_One -  paid_auto_dis_;
                                       $('#balanceLaundry_One').text(CommaFormattedN(current_total_blance_p));
								 
									}
  
	   }
 
   });

 
 
 
 
 
 
 $('#other_detials').accordion({
   fillSpace:true,
    icons:{"header": "ui-icon-plus","headerSelected":"ui-icon-minus"},  collapsible:true,active:2});
 
 
 /*
 function warning_func(massege){
   $('#warning').html('<img src="css/warning.png" alt="warning" style="border-radius:2em; width:80px; height:40px; margin-right: 4px; "/>'+massege).dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
						"Okay": function() {
							$(this).dialog("close");
		}}, });
		
	return false;
 }
 
 */
 
// buttons layout
function buttons(){
	$('#add_new_item,.add_new_cust, div#moreDitails_of_cust_no_bal button#add_sell').button(
	  {
	    height:'10px',
		icons: {primary: 'ui-icon-circle-plus', secondary: null}
	  }
	);
	$('.add_new_cust').css('font-size','0.7em');  
	
	 
$('button#add_more_sell2').button(
	  {
	    height:'7px',
		icons: {primary: 'ui-icon-circle-plus', secondary: null}
	  });
	  
$('button#remove_tab__but2').button(
	  {
	    height:'10px',
		icons: {primary: 'ui-icon-circle-delete', secondary: null}
	  }
	).css('font-size','10px');
		
	
	$('button#remove_tab_but').button(
	  {
	    height:'10px',
		icons: {primary: 'ui-icon-circle-delete', secondary: null}
	  }
	).css('font-size','10px');
	
	
	$('#add_more_sell').button(
	  {
	    height:'7px',
		icons: {primary: 'ui-icon-circle-plus', secondary: null}
	  });
 
return false;
}
buttons();

 
 // toggle send sms checkbox
 	
 $('#allow_sms').change(function (){
	 var value_chak =  $(this).val();
	 if(value_chak == 'off'){
	 $(this).val('on');
	 
	 
		 var all_msg =  $(this).attr('old');
		 if(jQuery.trim(all_msg) == ''){
		 $('#message_').removeAttr('disabled').focus().attr('placeholder','enter message here..').css('background','#fff');	
		 }else{  
		 $('#message_').val(all_msg).removeAttr('disabled').focus().css('background','#fff');
		 }
	 
	 }else{
	$(this).val('off');
     var all_msg =  $('#message_').val();
	  $('#message_').val('');
	 $(this).attr('old',all_msg);
	 $('#message_').attr('disabled','disabled').removeAttr('placeholder').css('background','gray');
	 }
 
 });
 
 
 
// add new custom
function add_new_cust(){
 
 
	$('#add_more_sell').click(function (){
	 
		var chosen_class  = $('select[selectName="itemName"]').attr('class');  
		var items_name_for_select  = $('select[selectName="itemName"]').attr('class','').outerHTML(); 
        var other_ditails = $('div#otherDetails_accordion').attr('others'); 		
		 $('select[selectName="itemName"]').attr('class',chosen_class);
		var all_contents_sell = $('#tab_ ul').outerHTML();	
		var current_count = $('#tabes_handler li').length;
		var next_count  =  current_count + 1;
		
 
   
		 $('#tabes_handler').append('<li id="tab_linkId'+next_count+'" ><a href="#tab_'+next_count+'"  id="tab_link'+next_count+'">tab '+next_count+' </a></li>');	 
		 $('#tabs_sell').append('<div id="tab_'+next_count+'" class="sells_div"> '+all_contents_sell+' </div>');
		
		 // insert tab id into each element in that tab 
		 $('div#tab_'+next_count+' * ').attr('tab_id','tab_link'+next_count+'');
 
		 $('#tab_'+next_count+' #list_itemn').html('<label id="l">Item Name:</label>'+items_name_for_select).next().html('	<label>Payment type:</label><select class="chosen" id="payment_type" style="width:200px  !important; margin:3px"><option class="opt">choose ..</option></select>');
    $('#tab_'+next_count+' #list_itemn select').removeAttr('id');
  $('#tab_'+next_count+'  #other_detials').html(other_ditails); 
		$('#tab_'+next_count+' #cunstname').text('');
		$('#tab_'+next_count+' #mobile_li').text('');
  $('div#tab_'+next_count+' select , #tab_'+next_count+'  #other_detials *').attr('tab_id','tab_link'+next_count+'');
  $('#tab_'+next_count+'  #other_detials').accordion({
   fillSpace:false,
    icons:{"header": "ui-icon-plus","headerSelected":"ui-icon-minus"},  collapsible:true,active:2});  

 
   $('#tab_'+next_count+' li#daidsel input[date="daidline"]').removeClass('hasDatepicker').removeAttr('id').datepicker({dateFormat:'dd-M-yy',minDate:0}); 
	
	$('#tab_'+next_count+'  #other_detials input').change(function (){
	 var value_chak =  $(this).val();
	 if(value_chak == 'off'){
	 $(this).val('on');
	 
	 
		 var all_msg =  $(this).attr('old');
		 if(jQuery.trim(all_msg) == ''){
		 $('#tab_'+next_count+'  #message_').removeAttr('disabled').focus().attr('placeholder','enter message here..').css('background','#fff');	
		 }else{  
		 $('#tab_'+next_count+'   #message_').val(all_msg).removeAttr('disabled').focus().css('background','#fff');
		 }
	 
	 }else{
	  $(this).val('off');
       var all_msg =  $('#tab_'+next_count+'  #message_').val();
	  $('#tab_'+next_count+'   #message_').val('');
	 $(this).attr('old',all_msg);
	 $('#tab_'+next_count+'   #message_').attr('disabled','disabled').removeAttr('placeholder').css('background','gray');
     }
 });
	
	
	
	
	
 
 
	
	   // remove button 
	    $('div#tab_'+next_count+'').append('<button his_tabId="tab_'+next_count+'"   tabLinliId="tab_linkId'+next_count+'"  id="remove_tab_but" > remove </button>');
         buttons();

	  
	  $('#tab_'+next_count+' select').data("placeholder","Select item name...").chosen();
        $("div#tabs_sell").tabs("refresh");
       $('#tab_'+next_count+' #list_itemn').next().find('.chzn-search').remove();
		// reset price and balance 
 
         $('div#tab_'+next_count+' p#price').attr('price','').text('0');	 
		 $('div#tab_'+next_count+' p#balance').attr('balance','').text('0');	 
		 
       $('div#tab_'+next_count+' select[selectName="itemName"] ').change(function (){
			  var element = $(this).find('option:selected'); 
			  var singleSele_price = element.attr('singleSele');
			  var wholseSell_price = element.attr('wholesell');
			  var numbrOfremaining_Items1 = element.attr('remaining_Items');
			  
		         var sigleSell =  "<option class='opt' singleSell="+element.attr('singleSele')+"  item_id_="+element.attr('item_id_')+"  singleSell_out="+ element.attr('singleSele_out') +"  > Single Sell </option>"; 
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
	
	
		  $('div#tab_'+next_count+' select#payment_type').next().remove();
		  $('div#tab_'+next_count+' select#payment_type').html( '<option class="opt">choose ..</option> ' +sigleSell + wholseSell);
		  $('div#tab_'+next_count+' select#payment_type').attr('class','').chosen();
		   $('div#tab_'+next_count+' input#number_of_itm').attr('remainingItms',numbrOfremaining_Items1);
		    $('#tab_'+next_count+' #list_itemn').next().find('.chzn-search').remove();
		  
				// when th payment type has been chosen 
				       $('div#tab_'+next_count+' select#payment_type').change(function (){
					 
					     var element2 = $(this).find('option:selected'); 
					     var paymnt_value = $(this).val();
						
					 if(paymnt_value == 'Single Sell'){   
					     var singleSele_price2 = element2.attr('singleSell'); 
						 var singleSele_out2 = element2.attr('singleSell_out');
						 var item_id_ = element2.attr('item_id_');  
							   
						 $('div#tab_'+next_count+' p#price').attr('item_nam',item_id_).attr('price',singleSele_price2).text(singleSele_out2).attr('oringinal_price',singleSele_price2);
						 	// reset fields
							$('div#tab_'+next_count+' #number_of_itm').val('');
							$('div#tab_'+next_count+' #discount').val('').attr('modified_price',singleSele_price2);
							$('div#tab_'+next_count+' #paid').val('');
							   $('div#tab_'+next_count+' p#balance').attr('balance',singleSele_price2).text(singleSele_out2);	
						}else if (paymnt_value == 'WholeSell'){
					   	  var wholseSell_price2 = element2.attr('wholseSell');
						  var wholseSell_out2 = element2.attr('wholeSell_out');
						  var item_id_2 = element2.attr('item_id_'); 
						  $('div#tab_'+next_count+' p#price').attr('item_nam',item_id_2).attr('price',wholseSell_price2).text(wholseSell_out2).attr('oringinal_price',wholseSell_price2);
						  	// reset fields
							$('div#tab_'+next_count+' #number_of_itm').val('');
							$('div#tab_'+next_count+' #discount').val('').attr('modified_price',wholseSell_price2);
							$('div#tab_'+next_count+' #paid').val('');
							   $('div#tab_'+next_count+' p#balance').attr('balance',wholseSell_price2).text(wholseSell_out2);	
						}else if(paymnt_value == 'choose ..'){
						  $('div#tab_'+next_count+' p#price').attr('price','').text('0');	 
		                   $('div#tab_'+next_count+' p#balance').attr('balance','').text('0');	
						}
					  
					  });
		  

		  
		       });
 
 
 
 
 // when  remove button has been clicked 
			$('div#tab_'+next_count+' button#remove_tab_but').click(function (){ 
				  var tabID = $(this).attr('his_tabId');
				  var tabLinkId = $(this).attr('tabLinliId');
				$('#tabs_sell div.sells_div').last().remove();	
				  $('#tabes_handler li').last().remove();	
		         var last_tab_id = $('#tabes_handler li a').last().attr('id');
	 
                   document.getElementById(last_tab_id).click();					  
			  });

 
				        // auto calculate  balance  and price by using number of items
						$('div#tab_'+next_count+' #number_of_itm').keyup(function (){
							
						 
						 		 var discount_auto_dis = $('div#tab_'+next_count+' #discount').val();
								 var paid_auto_paid = $('div#tab_'+next_count+' #paid').val();
								 
								 if(jQuery.trim(discount_auto_dis) == ''){   
								 discount_auto_dis = 0;
								 }else if (!validate_number_value(discount_auto_dis)){
								 discount_auto_dis = 0;
								 }
						 					    
								 if(jQuery.trim(paid_auto_paid) == ''){   
								 paid_auto_paid = 0;
								 }else if (!validate_number_value(paid_auto_paid)){
								 paid_auto_paid = 0;
								 }
						 

						 
								        var remainingItms_ = parseFloat($(this).attr('remainingItms'));
										var current_price  = parseFloat($('div#tab_'+next_count+' #price').attr('oringinal_price'));
										var numofimtsValue = parseFloat($(this).val());
							 
							 	  if(jQuery.trim($(this).val()) == ''){   
								 numofimtsValue = 1;
								 }
							 
							 
									if(!validate_number_value(numofimtsValue) || !validate_number_value(remainingItms_) || !validate_number_value(current_price) ){
									}else{
										var current_total_price = (numofimtsValue * current_price) - discount_auto_dis;
										var current_total_blance = current_total_price - paid_auto_paid;

									    $('div#tab_'+next_count+'  #price').attr('price',current_total_price).text(CommaFormattedN(current_total_price));
										$('div#tab_'+next_count+'  #balance').text(CommaFormattedN(current_total_blance)).attr('balance',current_total_blance);
										$('div#tab_'+next_count+' #paid').attr('current_price',current_total_price);
						                $('div#tab_'+next_count+' #discount').attr('modified_price',(numofimtsValue * current_price));
									}
							});
					
						
	
	
				        // auto calculate  balance  and price by using discount 
						$('div#tab_'+next_count+' #discount').keyup(function (){
							
						 
						 
								 var paid_auto_paid_d = $('div#tab_'+next_count+' #paid').val();
								 
					 
						 					    
								 if(jQuery.trim(paid_auto_paid_d) == ''){   
								 paid_auto_paid_d = 0;
								 }else if (!validate_number_value(paid_auto_paid_d)){
								 paid_auto_paid_d = 0;
								 }
						 

						 
								        var discount__dis_d = parseFloat($(this).val());
										var current_price_d  = parseFloat($('div#tab_'+next_count+' #price').attr('oringinal_price'));
										var numofimtsValue_d = parseFloat($('div#tab_'+next_count+' #number_of_itm').val());
										
							  if(jQuery.trim($(this).val()) == ''){   
								 discount__dis_d = 0;
								 }
								 
									if(!validate_number_value(numofimtsValue_d) || !validate_number_value(discount__dis_d) || !validate_number_value(current_price_d) ){
							 
								     }else{
										var current_total_price_d = (numofimtsValue_d * current_price_d) - discount__dis_d;
										var current_total_blance_d = current_total_price_d - paid_auto_paid_d;

									    $('div#tab_'+next_count+' #price').attr('price',current_total_price_d).text(CommaFormattedN(current_total_price_d));
										$('div#tab_'+next_count+' #balance').text(CommaFormattedN(current_total_blance_d)).attr('balance',current_total_blance_d);
										$('div#tab_'+next_count+' #paid').attr('current_price',current_total_price_d);
									 
									}
							});
					
						
	                      // auto calculate  balance  and price by using paid 
						$('div#tab_'+next_count+' #paid').keyup(function (){
							
						 
						 		 var discount_auto_dis_ = $('div#tab_'+next_count+' #discount').val();
								  
								 
								 if(jQuery.trim(discount_auto_dis_) == ''){   
								 discount_auto_dis_ = 0;
								 }else if (!validate_number_value(discount_auto_dis_)){
								 discount_auto_dis_ = 0;
								 }
						 					    
 
								        var paid___p = parseFloat($(this).val());
										var current_price_p  = parseFloat($('div#tab_'+next_count+' #price').attr('oringinal_price'));
										var numofimtsValue_p = parseFloat($('div#tab_'+next_count+' #number_of_itm').val());
							  
							  if(jQuery.trim($(this).val()) == ''){   
								 paid___p = 0;
								 }
									if(!validate_number_value(numofimtsValue_p) || !validate_number_value(paid___p) || !validate_number_value(current_price_p) ){
									}else{
										var current_total_price_p = (numofimtsValue_p * current_price_p) - discount_auto_dis_;
										var current_total_blance_p = current_total_price_p - paid___p;

									    $('div#tab_'+next_count+'  #price').attr('price',current_total_price_p).text(CommaFormattedN(current_total_price_p));
										$('div#tab_'+next_count+'  #balance').text(CommaFormattedN(current_total_blance_p)).attr('balance',current_total_blance_p);
										//$('div#tab_'+next_count+' #paid').attr('current_price',current_total_price_p);
										 
									}
							});
					
  document.getElementById('tab_link'+next_count).click();	  // jump to the current tab
	});
	
		
 
	$('button.add_new_cust').click(function (){
	
 
     // first div for default 
     $('div#tabs_sell div#tab_ input[type="text"]').val('');
     $('#message_').css({
	 width: "367px",
	 height: "179px"
	 }).val('');
	 if($('#allow_sms').val() == 'on'){
	   document.getElementById('allow_sms').click();	 
	 }
   
 
	                   $('div#tabs_sell button#remove_tab_but').each(function() {
							var bid = $(this).attr('id');
							document.getElementById(bid).click();	 
						});
	 
	  $('#tab_ #list_itemn').next().find('.chzn-search').remove();
	  
   $('div#tab_ select[selectName="itemName"]').change(function (){
			  var element = $(this).find('option:selected'); 
			  var singleSele_price = element.attr('singleSele');
			  var wholseSell_price = element.attr('wholesell');
			  var numbrOfremaining_Items = element.attr('remaining_Items');
			  
		         var sigleSell =  "<option class='opt' singleSell="+element.attr('singleSele')+" item_id_="+element.attr('item_id_')+"   singleSell_out="+ element.attr('singleSele_out') +"  > Single Sell </option>";
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
		  $('div#tab_  select#payment_type').next().remove();
		  $('div#tab_  select#payment_type').html( '<option class="opt">choose ..</option> ' +sigleSell + wholseSell);
		  $('div#tab_  select#payment_type').attr('class','').chosen();
		   $('div#tab_  input#number_of_itm').attr('remainingItms',numbrOfremaining_Items);
		    $('#tab_ #list_itemn').next().find('.chzn-search').remove();
		  
				   // when th payment type has been chosen 
				       $('div#tab_ select#payment_type').change(function (){
					 
					     var element3 = $(this).find('option:selected'); 
					     var paymnt_value2 = $(this).val();
					 if(paymnt_value2 == 'Single Sell'){   
					     var singleSele_price3 = element3.attr('singleSell');
						 var singleSele_out3 = element3.attr('singleSell_out');
						 var item_id_ = element3.attr('item_id_');    
						 $('div#tab_ p#price').attr('price',singleSele_price3).text(singleSele_out3).attr('oringinal_price',singleSele_price3).attr('item_nam',item_id_);
						 
						 		// reset fields
							$('div#tab_ #number_of_itm').val('');
							$('div#tab_ #discount').val('').attr('modified_price',singleSele_price3);
							$('div#tab_  #paid').val('');	
						 
						   $('div#tab_ p.balance').attr('balance',singleSele_price3).text(singleSele_out3);
						}else if (paymnt_value2 == 'WholeSell'){
					   	  var wholseSell_price3 = element3.attr('wholseSell');
						  var wholseSell_out3 = element3.attr('wholeSell_out');
						   var item_id_2 = element3.attr('item_id_');  
						  $('div#tab_ p#price').attr('price',wholseSell_price3).text(wholseSell_out3).attr('oringinal_price',wholseSell_price3).attr('item_nam',item_id_2);	

								// reset fields
							$('div#tab_ #number_of_itm').val('');
							$('div#tab_ #discount').val('').attr('modified_price',wholseSell_price3);
							$('div#tab_ #paid').val('');	
							   $('div#tab_ p.balance').attr('balance',wholseSell_price3).text(wholseSell_out3);	
						}else if(paymnt_value2 == 'choose ..'){
						  $('div#tab_ p#price').attr('price','').text('0');	 
		                   $('div#tab_ p.balance').attr('balance','').text('0');	
						}
					  
					  });
		  

		       });
 
 
				        // auto calculate  balance  and price by using number of items
						$('div#tab_ #number_of_itm').keyup(function (){
							
						 
						 		 var discount_auto_dis = $('div#tab_ #discount').val();
								 var paid_auto_paid = $('div#tab_ #paid').val();
								 
								 if(jQuery.trim(discount_auto_dis) == ''){   
								 discount_auto_dis = 0;
								 }else if (!validate_number_value(discount_auto_dis)){
								 discount_auto_dis = 0;
								 }
						 					    
								 if(jQuery.trim(paid_auto_paid) == ''){   
								 paid_auto_paid = 0;
								 }else if (!validate_number_value(paid_auto_paid)){
								 paid_auto_paid = 0;
								 }
						 

						 
								        var remainingItms_ = parseFloat($(this).attr('remainingItms'));
										var current_price  = parseFloat($('div#tab_ #price').attr('oringinal_price'));
										var numofimtsValue = parseFloat($(this).val());
						 
						 	  if(jQuery.trim($(this).val()) == ''){   
								 numofimtsValue = 1;
								 }
						 
									if(!validate_number_value(numofimtsValue) || !validate_number_value(remainingItms_) || !validate_number_value(current_price) ){
									}else{
										var current_total_price = (numofimtsValue * current_price) - discount_auto_dis;
									 
										var current_total_blance = current_total_price - paid_auto_paid;

									    $('div#tab_  #price').attr('price',current_total_price).text(CommaFormattedN(current_total_price));
										$('div#tab_  #balance').text(CommaFormattedN(current_total_blance)).attr('balance',current_total_blance);
										$('div#tab_  #paid').attr('current_price',current_total_price);
										$('div#tab_  #discount').attr('modified_price',(numofimtsValue * current_price));
									 
									}
							});
					
						
	
	
				        // auto calculate  balance  and price by using discount 
						$('div#tab_ #discount').keyup(function (){
							
						 
						 
								 var paid_auto_paid_d = $('div#tab_ #paid').val();
								 
					 
						 					    
								 if(jQuery.trim(paid_auto_paid_d) == ''){   
								 paid_auto_paid_d = 0;
								 }else if (!validate_number_value(paid_auto_paid_d)){
								 paid_auto_paid_d = 0;
								 }
						 

						 
								        var discount__dis_d = parseFloat($(this).val());
										var current_price_d  = parseFloat($('div#tab_ #price').attr('oringinal_price'));
										var numofimtsValue_d = parseFloat($('div#tab_ #number_of_itm').val());
										
							  if(jQuery.trim($(this).val()) == ''){   
								 discount__dis_d = 0;
								 }
								 
									if(!validate_number_value(numofimtsValue_d) || !validate_number_value(discount__dis_d) || !validate_number_value(current_price_d) ){
									}else{
										var current_total_price_d = (numofimtsValue_d * current_price_d) - discount__dis_d;
										var current_total_blance_d = current_total_price_d - paid_auto_paid_d;

									    $('div#tab_  #price').attr('price',current_total_price_d).text( CommaFormattedN(current_total_price_d));
										$('div#tab_  #balance').text(CommaFormattedN(current_total_blance_d)).attr('balance',current_total_blance_d);
										$('div#tab_  #paid').attr('current_price',current_total_price_d);
										//$('div#tab_ #discount').attr('modified_price',current_total_price_d);
									 
									}
							});
					
						
	                      // auto calculate  balance  and price by using paid 
						$('div#tab_ #paid').keyup(function (){
							
						 
						 		 var discount_auto_dis_ = $('div#tab_ #discount').val();
								  
								 
								 if(jQuery.trim(discount_auto_dis_) == ''){   
								 discount_auto_dis_ = 0;
								 }else if (!validate_number_value(discount_auto_dis_)){
								 discount_auto_dis_ = 0;
								 }
						 					    
 
								        var paid___p = parseFloat($(this).val());
										var current_price_p  = parseFloat($('div#tab_ #price').attr('oringinal_price'));
										var numofimtsValue_p = parseFloat($('div#tab_ #number_of_itm').val());
							  
							  if(jQuery.trim($(this).val()) == ''){   
								 paid___p = 0;
								 }
									if(!validate_number_value(numofimtsValue_p) || !validate_number_value(paid___p) || !validate_number_value(current_price_p) ){
									}else{
										var current_total_price_p = (numofimtsValue_p * current_price_p) - discount_auto_dis_;
										var current_total_blance_p = current_total_price_p - paid___p;

									    $('div#tab_  #price').attr('price',current_total_price_p).text(CommaFormattedN(current_total_price_p));
										$('div#tab_  #balance').text(CommaFormattedN(current_total_blance_p)).attr('balance',current_total_blance_p);
										//$('div#tab_  #paid').attr('current_price',current_total_price_p);
										//$('div#tab_ #discount').attr('modified_price',current_total_price_p);
									}
							});
					
						
 
 // end of default 
									  
	$("#adding_custom").dialog({ show: "blind", hide: "explode", width: 'auto', position:'top',  height:'auto',  modal: true, buttons:  {
						"Okay": function() {
	 

	                 // validating status 
					   var custom_name_vali = 'off';
					   var itemm_name_vali = 'off';
					   var payment_type_sel_vali = 'off';
					   var number_of_itm_se_vali  = 'off';
					   var discount_sel_vali = 'off';
					   var paid_sel_vali  = 'off';
					   var mobile_valiting = 'off'; 
					   var allowSms_validating = 'off';
					   
						  		    var custom_name = new Array($('div#adding_custom .cust_name').val());
									var itemm_name = new Array();
									var payment_type_sel = new Array();
									var number_of_itm_se = new Array();
									var discount_sel =  new Array();	
									var price_sel   =  new Array();	
									var paid_sel  =  new Array();	
									var balance_sel = new Array();
									var original_price_ =  new Array();
									var remaing_items_ = new Array();	
								    var item_ids  = new Array();
										 var mobile_1  = new Array($('#mobile_').val());   
										 
										 var daidline1  = new Array();
										 var allowSms1  = new Array();
										 var message1  = new Array();
				 		
			                     // validate customer name and push to array 
								    if(jQuery.trim(custom_name[0]) == ''){
									        custom_name[0] = 'Unknown';
										}
							      
 
							 
								    $('div#adding_custom input#number_of_itm').each(function() {
									  
											var numbr_of_itm = $(this).val();
											var current_tab_Id_n =  $(this).attr('tab_id'); 
											var field_id_number_of_item = $(this).attr('id');
											var remaining_itms = $(this).attr('remainingitms');
											
											if(jQuery.trim(numbr_of_itm) == ''){	
												// check if value is empty !
											document.getElementById(current_tab_Id_n).click();	  // jump to the current tab
											   error_func('Error please enter number of item !');	
											     $(this).css('border-color','red');
												   number_of_itm_se_vali = 'on';
											   return false;
											}else if(!validate_number_value(numbr_of_itm)){
											  // check if value is digit !
											   document.getElementById(current_tab_Id_n).click();	  // jump to the current tab 
											   error_func('Error invalid number of item !');	
											    $(this).css('border-color','red');
												  number_of_itm_se_vali = 'on';
											   return false;
											}else if(remaining_itms < parseFloat($(this).val())){
											   document.getElementById(current_tab_Id_n).click();	  
											  error_func('Error invalid number of item  <br /> only ('+CommaFormattedN(remaining_itms)+') Items available !');	 
											    $(this).css('border-color','red');
												  number_of_itm_se_vali = 'on';
											   return false;
											}else{
											  number_of_itm_se_vali = 'off';
											     $(this).css('border','2px groove rgb(248, 248, 248)');
											    number_of_itm_se.push(numbr_of_itm);
												 remaing_items_.push(remaining_itms);
											}
										});
										
								  
								
							 		// validate payment type name and push to array 
									$('div#adding_custom select#payment_type').each(function() {
									   
											var current_tab_Id =  $(this).attr('tab_id'); 
											var  payment_type_ =  $(this).val();
									//	alert(payment_type_);
								            if( payment_type_ == 'choose ..' ){
								              document.getElementById(current_tab_Id).click();	  // jump to the current tab
									          error_func('Error please Select Payment type !');		
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
							 		$("div#adding_custom select[selectName='itemName']").each(function() {
										 
									    	var payment_type_value = $(this).val();
											var current_tab_Id_ = $(this).attr('tab_id'); 
								    
									  if(payment_type_value == 'choose..' ){
								               document.getElementById(current_tab_Id_).click();	  // jump to the current tab
									           error_func('Error Please Select Item Name!');	
												// $(this).css('border','1px solid red');
												 itemm_name_vali = 'on';
										        return false;
										 }else{
										     itemm_name_vali = 'off';
											// $(this).css('border','none');
											itemm_name.push(payment_type_value);
										}
										});
					 
		 
						 		
									                    
	                                $('div#adding_custom .price').each(function() {
										price_sel.push($(this).attr('price'));
									    original_price_.push($(this).attr('oringinal_price'));
										item_ids.push($(this).attr('item_nam'));
											// price is a digit and all ways equal to something
										});

										                    
	                                $('div#adding_custom p#balance').each(function() {
									 
									    balance_sel.push($(this).attr('balance'));
											// price is a digit and all ways equal to something
										});

											
			
					               $('div#adding_custom input.paid').each(function() {
									  

											var paid_of_itm = $(this).val();
											var current_tab_Id_p  =  $(this).attr('tab_id');  
											var field_id_paid_of_item  = $(this).attr('id');
											var current_total_price_ = $(this).attr('current_price');
									    if(jQuery.trim(paid_of_itm) == '' ){ 
										  paid_sel_vali = 'off';
 										     paid_of_itm = 0;
											   $(this).css('border','2px groove rgb(248, 248, 248)');
											  paid_sel.push(paid_of_itm);
											 
										    }else if (!validate_number_value(paid_of_itm) && jQuery.trim(paid_of_itm) != '') {
									        // check if value is empty !
											 document.getElementById(current_tab_Id_p).click();	  // jump to the current tab
											   error_func('Error invalid Paid !');	
											   $(this).css('border','1px groove red');
											     paid_sel_vali = 'on';
											   return false;
											}else if(current_total_price_ <  parseFloat($(this).val()) ){
												 document.getElementById(current_tab_Id_p).click();	  // jump to the current tab
											   error_func('Error Invalid Paid !');	
											   $(this).css('border','1px groove red');
											     paid_sel_vali = 'on';
											   return false;
											}else{
											  paid_sel_vali = 'off';
											    $(this).css('border','2px groove rgb(248, 248, 248)');
											  paid_sel.push(paid_of_itm);
											}
						
										});
                                 
					  	 
									$('div#adding_custom input.discount').each(function() {
										
											var disc_of_itm = $(this).val();
											var current_tab_Id_d  =  $(this).attr('tab_id'); 
											var field_id_disc_of_item  = $(this).attr('id');
											var original_price_dis   =   $(this).attr('modified_price');
											 
										    if(jQuery.trim(disc_of_itm) == '' ){
												discount_sel_vali = 'off';
										
										     disc_of_itm = 0;
											    $(this).css('border','2px groove rgb(248, 248, 248)');
											  discount_sel.push(disc_of_itm);
										    }else if (!validate_number_value(disc_of_itm) && jQuery.trim(disc_of_itm) != '') {
									        // check if value is empty !
											 document.getElementById(current_tab_Id_d).click();	  // jump to the current tab
											   error_func('Error invalid Discount !');	
											   $(this).css('border','1px groove red');
											     discount_sel_vali = 'on';
										
											   return false;
											}else if(original_price_dis < parseFloat($(this).val())){
												 document.getElementById(current_tab_Id_d).click();	  // jump to the current tab
											 error_func('Error invalid Discount !');	
											   $(this).css('border','1px groove red');
											     discount_sel_vali = 'on';
										
											   return false;
											}else{
											  discount_sel_vali = 'off';
										
											    $(this).css('border','2px groove rgb(248, 248, 248)');
											  discount_sel.push(disc_of_itm);
											}
										});
				                     
									     
	                                $('div#adding_custom #mobile_li').each(function() {
									    
									   		var mobile_value = $('#mobile_').val();
											var current_tab_Id_mobile  =  'tab_link_1';  
								            var message_send  =  $(this).next().next().find('#message_').first().val(); 
											 
								
								     if (!validate_number_value(mobile_value) && jQuery.trim(mobile_value) != '') {
									        // check if value is empty !
											 document.getElementById(current_tab_Id_mobile).click();	  // jump to the current tab
											   error_func('Error invalid Mobile number !');	
											     $('#mobile_').css('border','1px groove red');
											     mobile_valiting = 'on';
											   return false;
											}else if (jQuery.trim(message_send) != '' && jQuery.trim(mobile_value) == '') {
									        // check if value is empty !
											 document.getElementById(current_tab_Id_mobile).click();	  // jump to the current tab
											   error_func('Error please enter mobile number !');	
											     $('#mobile_').css('border','1px groove red');
											     mobile_valiting = 'on';
											   return false;
											}else{ 
											   mobile_valiting = 'off';
											   $('#mobile_').css('border','2px groove rgb(248, 248, 248)');
										    
										   if(jQuery.trim(message_send) ==''){
										   message_send = '0';
										   message1.push(message_send); 
										   }else{
										     message1.push(message_send); 
										   }
										   
											  
										 
											} 
										});

			 
			                        // others
				       
	                                $('input#allow_sms').each(function() {
									 
									   	 	var allow_sms_value = $(this).val();
											var current_tab_Id_allow_sms  =  $(this).attr('tab_id');  
								            var message =  $(this).parent().next().next().next().val();
								       
								    
							   if (jQuery.trim(allow_sms_value) == 'on' && jQuery.trim(message) == '' ) { 
									      //  check  if message is empty!
										  document.getElementById(current_tab_Id_allow_sms).click();	  // jump to the current tab
									      error_func('Error the message is blank !');	
										   $(this).css('border','1px groove red');
									       allowSms_validating = 'on';
										    return false;
									}else{ 
										    allowSms_validating = 'off';
										  allowSms1.push(allow_sms_value);
									  	}
								 
									});

										
			                        $('input[date="daidline"]').each(function() {
								
										var timeline = $(this).val();
										 
										if(jQuery.trim(timeline) ==''){
 
										   daidline1.push('0'); 
										   }else{
										     daidline1.push(timeline); 
										   }
									 
											// price is a digit and all ways equal to something
								    });

										
			
			
			
			
				if( custom_name_vali == 'on' || itemm_name_vali == 'on' || payment_type_sel_vali == 'on'){
					}else if(number_of_itm_se_vali == 'on' ){
					}else if( discount_sel_vali == 'on' || paid_sel_vali == 'on' ){
					 
					 }else if( mobile_valiting == 'on' || allowSms_validating == 'on' ){
					 
					 }else{
					 
				 var confirmation_table = '<table id="confima_table"   cellpadding="0" cellspacing="0" border="0" class="display" width="100%">   <thead>    <tr> <th> Item Name </th><th> Payment type </th><th> Number of Item</th><th> Discount  </th><th> Price </th> <th> Paid </th><th> Balance </th> </tr> </thead> <tbody>'; 
				 var data_length = itemm_name.length;
		        	var conf_total_discount = 0;
			        var conf_total_price = 0;
					var conf_total_paid = 0;
					var conf_total_balance = 0;
				
				 for(x=0;x<data_length;x++){ 
				//  error_func(balance_sel[x]);
				 confirmation_table +=   '<tr> <td>'+itemm_name[x]+'</td><td>'+payment_type_sel[x]+'</td><td class="int_no">'+number_of_itm_se[x]+'</td><td class="int_no">'+ discount_sel[x] +'</td><td class="int_no">'+price_sel[x]+'</td><td class="int_no">'+paid_sel[x]+'</td><td class="int_no">'+balance_sel[x]+'</td></tr>';
				 }
				 confirmation_table  +='</tbody></table>';
				 
			   
    			for(i=0;i<data_length; i++){
				        conf_total_discount +=   Number(discount_sel[i]);
						conf_total_price    +=    Number(price_sel[i]);
						conf_total_paid    +=    Number(paid_sel[i]);
				        conf_total_balance  +=   Number(balance_sel[i]);
				   }

 	   
				    confirmation_table  += '<table id="confima_table_total"   cellpadding="0" cellspacing="0" border="0" class="display" width="100%">   <thead>    <tr> <th> Total Discount </th><th> Total Price </th><th>Total Paid </th><th>Total Balance </th></tr></thead> <tbody>';
				    confirmation_table  += '<tr><td class="int_no">'+conf_total_discount+'</td><td class="int_no">'+conf_total_price+' </td> <td class="int_no">'+conf_total_paid+'</td> <td class="int_no">'+conf_total_balance+'</td></tr></tbody></table>';
				
				//confirm_selling_item  
	
					  $("#confirm_selling_item").html(confirmation_table).dialog({  show: "blind", position:'top', hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
						"Agree": function() {
						 	$(this).dialog('close');
							 // submit The form
                              loading_func(); // SHOW LOADING IMAGE DIALOG
						




						
						$.post('php_f/add_new_custom.php', {custom_name:custom_name, item_ids:item_ids, original_price_:original_price_, remaing_items_:remaing_items_, itemm_name:itemm_name, payment_type_sel:payment_type_sel, number_of_itm_se:number_of_itm_se, discount_sel:discount_sel, price_sel:price_sel,paid_sel:paid_sel, mobile_1:mobile_1,daidline1:daidline1,allowSms1:allowSms1,message1:message1}, function(cust_feedback) {					
							
							    if( 1 == 1){ 
								    toggle_for_sold_items = '1';	
									 $("#adding_custom").dialog('close');
						            Load_Items();
								
								
							    }else{
							   $("#loading").dialog('close'); 
							   error_func(cust_feedback);
							  }
							
						});
						  
	  
		},"Cancel" : function () {
		$(this).dialog('close');
		}}, });
					 $("#confirm_selling_item table").dataTable({
							 "sPaginationType":"full_numbers",
							  "bJQueryUI":true
						 });
					  $("#confirm_selling_item div#confima_table_total_wrapper #confima_table_total_filter").remove();
					 $("#confirm_selling_item div#confima_table_total_wrapper #confima_table_total_length").html('<label>All Totals </label>');
					  $('div [aria-describedby="confirm_selling_item"] div:first span').text('Confirmation of ('+custom_name[0]+')'); 
					 format_number('.int_no');
					 
					
			 		  }	 
 
						}, 'Cancel': function(){
						  
     						$(this).dialog('close');
						}}});
 		
	}
	
);
	 
return false;
}
 //add_new_cust();


































				
});
			
			
