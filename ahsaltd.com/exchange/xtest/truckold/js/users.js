 
 
 
 
 
 // print Check only 

 function print_Check(bankName,chequeDate,checkName,chequeAddress,acountNumber,payToName,inword,memo,checkAmount){
 
 var templet = '<ul> <li style="float: left;" ><strong>'+bankName+'</strong>,<br>   <span style="clear:both;"> '+checkName+', <br/> '+chequeAddress+',<br> '+acountNumber+', </span> </li>';
     templet +='<li style="float:right;" >  <b>No:____________</b><br><br><br> <strong> Date: '+ chequeDate +' </strong>   </li>';
   templet += '<br><br><li style="margin-top: 4.4em;"> Pay To : <strong  style="text-decoration:underline;" >'+payToName+'</strong> </li>';
   templet += '<li style="float: left;"> Order of :   <strong style="text-decoration:underline;" >'+inword+'</strong></li>';
   templet += '<li style="padding:4px; border:1px solid black; float:right;" >Ksh: <strong>'+CommaFormattedN(checkAmount)+' </strong> </li>';
   templet += '<li style="clear: left;">Memo : <strong  style="text-decoration:underline; clear: left; " >'+memo+'</strong> </li>';
   templet += '<br> <ll style="float:right;"> Signatory: --------------------------</li> <br><br> </ul> ';
 

 $('#chechPrint_formant').html(templet);
  $('#recieptPrint_formant').html('');
  window.print();
   
   manulUpdate = "off";
  if_logged_in()  
 return false;
 }

 
 
 
 // pring Items
 
 function  print_Items(custName,item_name,number_of_item,discount,price,paid,balance,date,option){// Print items or invoice
   //  manulUpdate = "on";	
 
      
   
			var someDat = new Date();
			var month = someDat.getMonth();
			var day = someDat.getDate();
			var year = someDat.getFullYear()
       var in_date  = year + "/" + month + "/" + day;
		  
   custName = condFunction(custName == '','Unknown',custName);
 var temlete_design  = '<div id="print_div" style=" border-bottom: px; width: 100%; border: 1px solid black; border-radius: 2em; "> <div style=" height: 2; "></div> <div id="top" style=" padding: 5px; background: rgb(58, 57, 57); margin-top: 43px; color: #fff; height: 143px; "> <img src="'+$('#logoDiv img ').attr('src')+'" alt="logo" style=" width: 356; height: 120px; margin: 15px; border: none; float: left; ">   <div id="contacts" style=" padding: 5px; float: right; position: relative; text-shadow: 2px 2px 2px #000; ">'+storeNameAndLocation+'</div></div><div style="clear:both;"></div> <div id="nanmes" style=" margin-top: 38px; margin-left: 9px; font-size: 17px; color: rgb(58, 57, 57); "> DATE: '+in_date+' <p style=" width: 223; background: rgb(58, 57, 57); height: 1px; margin-top: 7px; margin-bottom: 4px; "></p> Hi <strong style=" font-size: 24px; font-weight: Arail; font: bold 25px verdana; font-weight: normal; ">'+custName+'</strong> here is you <strong style=" font-size: 24px; color: rgb(236, 89, 19); ">INVOICE</strong> <p style=" width: 323; background: rgb(58, 57, 57); height: 1px; margin-top: 7px; margin-bottom: 23px; "></p> </div>';
   temlete_design += '<table style=" margin-top: 7px; margin-bottom: 7px; color: #cccc; border-collapse: collapse; width: 100%; text-align: left; "> <thead><tr style=" border-bottom: 2px solid rgb(58, 57, 57); "><th style=" color: rgb(58, 57, 57); padding: 12px; background: rgb(235, 235, 235); ">Item</th><th style=" color: rgb(58, 57, 57); padding: 12px; background: rgb(224, 223, 223); ">Quantity</th> <th style=" color: rgb(58, 57, 57); padding: 12px; background: rgb(209, 209, 209); ">Price</th> <th style=" color: rgb(58, 57, 57); padding: 12px; background: rgb(235, 235, 235); ">Paid</th> <th style=" color: #fff; padding: 12px; background: rgb(252, 81, 38); ">Balance</th> </tr></thead> <tbody>';
 
  
			 		 data_length = item_name.length;
				 
				
					 for(x=0;x<data_length;x++){ 
					       if(option == 'balance' && balance[x] == '0'){
						//  temlete_design +=   '<tr> <td style="color: rgb(58, 57, 57);background: rgb(235, 235, 235);padding: 10px;" >'+item_name[x]+'</td>   <td style="color: rgb(58, 57, 57);background: rgb(224, 223, 223);padding: 10px;" >'+CommaFormattedN(number_of_item[x])+'   </td> <td style="color: rgb(58, 57, 57);background: rgb(209, 209, 209);padding: 10px;"  >'+CommaFormattedN(price[x])+'</td>  <td   style="color: rgb(58, 57, 57);background: rgb(235, 235, 235);padding: 10px;" >'+CommaFormattedN(paid[x])+'</td>     <td  style="color: #fff;font-weight: bold;background: rgb(252, 81, 38);padding: 10px;" >'+CommaFormattedN(balance[x])+'</td></tr>';
   
						   }else{
					  temlete_design +=   '<tr> <td style="color: rgb(58, 57, 57);background: rgb(235, 235, 235);padding: 10px;" >'+item_name[x]+'</td>   <td style="color: rgb(58, 57, 57);background: rgb(224, 223, 223);padding: 10px;" >'+CommaFormattedN(number_of_item[x])+'   </td> <td style="color: rgb(58, 57, 57);background: rgb(209, 209, 209);padding: 10px;"  >'+CommaFormattedN(price[x])+'</td>  <td   style="color: rgb(58, 57, 57);background: rgb(235, 235, 235);padding: 10px;" >'+CommaFormattedN(paid[x])+'</td>     <td  style="color: #fff;font-weight: bold;background: rgb(252, 81, 38);padding: 10px;" >'+CommaFormattedN(balance[x])+'</td></tr>';
	   
						   }
							 				       
					   }
					  
					     temlete_design  +='</tbody></table>';
 
	         var totalPaid = arraySumValues_j(paid);
			 var totalPrice = arraySumValues_j(price);
			 var totalBalance = arraySumValues_j(balance);
	
	
	temlete_design +='<div style=" background: rgb(58, 57, 57); width: 100%; text-align: right; font-size: large; font-weight: bold; color: rgb(247, 247, 247); text-shadow: 2px 2px 2px #000; "> <div style=" text-align: center; ">  Total Price:     '+CommaFormattedN(totalPrice)+' <br> Total Paid:    '+CommaFormattedN(totalPaid)+'  <br> Total Balance:    '+CommaFormattedN(totalBalance)+'  <br>';   
	
    temlete_design +=  '</div> </div><div style=" padding: 6; color: rgb(58, 57, 57); "> </div> <hr><div style=" text-align: center; padding: 3; color: rgb(58, 57, 57); "> Thank You for your Bussiness ! </div> </div>';
	
   // alert(temlete_design);
	$('#chechPrint_formant').html('');
			  $('#recieptPrint_formant').html(temlete_design);
			 window.print();
		//	 manulUpdate = "off";
          //   if_logged_in()  
 return false;
 }
 
 
 
/*  
  $('document').ready(function (){
  	var itemm_name = new Array();
	var number_of_itm_se = new Array();
    var price_sel   =  new Array();	
	itemm_name.push('water');
	number_of_itm_se.push('1');
    price_sel.push('1000');
 
  //print_Items( itemm_name ,number_of_itm_se ,price_sel );
   print_Check('','','','','','','','','')
  });
 
  */
 
 
 
 
 
 
 
 
 function userCollection(user_id,month,day){
 
 			             loading_func(); // SHOW LOADING IMAGE DIALOG  
							   //  expenceName  numberOfExpence  expenceCost  expenceDate
							$.post('php_f/collectUserMony.php', {user_id:user_id, month:month, day:day }, function(result) {					
								
								if(result == 1){ 
								  
								    Load_Items();
								 	if($("#loading").closest('.ui-dialog').is(':visible')) { 
										  $("#loading").dialog('close');
										   $("#moreDetails_for_users").dialog('close');
										  success_func('<strong>Successfull</strong>'); 
									 } 
 
								 }else{
								  $("#loading").dialog('close'); 
								  error_func(result);
								}
								
								
							});
						
 
  return false;
 }
 
 
 function importDatabase(){
 
  
  $('#importDataBaseDiv input[type="file"]').removeAttr('style').val('');
  
$('#importDataBaseDiv').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
				         "Cancel": function() {	 
								$(this).dialog("close");
							}
						},
							});
 
   $('div [aria-describedby="importDataBaseDiv"] div:first span').html(' Importing Data..'); 
 
 return false;
 }
 
 
 
 // deposit
 

function custDeposit(depositCsh,depositData,cusName,custId){

/*   var filter_ = /\(/;
	
    if (filter_.test(cusName)) { */
	  var add_laundryButton = '';
	/* }else{
	  var add_laundryButton = ' <button id="sell_laundry_button"  addBtton="add"  title="click to add New laundry to '+cusName+'"> Add laundry to '+cusName+' </button>';
	/* } */ 

	   $('#showBeds_div').html(add_laundryButton+depositData).dialog({  position:'top', show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Close": function() {
							 // submit the ans-ware
							  $(this).dialog("close");
						  
						 },
							
				 
							}});
							
			/*  $('#showBeds_div button#sell_laundry_button').click(function (){
			 sellLaundryToCust(depositCsh,cusName,custId);
			 return false;
			 }); */	
	
 
	    $('div [aria-describedby="showBeds_div"] div:first span').html(cusName); 
	 
	
 
 applyButtons();
 
 $('div#showBeds_div table').attr({
    cellpadding:'0',
	cellspacing:'0',
	border:'0',
	class:'display',
    width:'100%' 
  });
  
  
 	   $('div#showBeds_div table').dataTable({
							"sPaginationType":"full_numbers",
							"bJQueryUI":true
							}); 

			 $('div#showBeds_div div.dataTables_wrapper:last').find('div.dataTables_filter').remove();	
 
	 $('div#showBeds_div div.dataTables_wrapper:last').find('div.dataTables_length').html('<label> Totals </label>');	
 
return false;
}
 
 
 
 // user permission 
 
 
 function userPermissions(userid,title,deleteStatus){
 
        if(deleteStatus == '1'){
		  $('#userPermissions input#toggleDeletePermission').prop('checked', true); 
		}else{
		  $('#userPermissions input#toggleDeletePermission').prop('checked', false); 
		}
		
        
	   $('#userPermissions').dialog({  show: "blind", hide: "explode", width: '400px',  height:'auto',  modal: true, buttons:  {
							"Okay": function() {
							 // submit the ans-ware
							 
					  var currentDeleteStatus = condFunction($('#userPermissions input#toggleDeletePermission').is(':checked'),'1','0');
                              
							  loading_func(); // SHOW LOADING IMAGE DIALOG  
							$.post('php_f/ChangeUserPermission.php', {userid:userid,currentDeleteStatus:currentDeleteStatus}, function(respond) {					
								
								if(respond == 1){ 
								 
								       Load_Items();
								  	if($("#loading").closest('.ui-dialog').is(':visible')) { 
								         $("#userPermissions").dialog('close'); 
								          $("#loading").dialog('close'); 
										  success_func('<strong>Successfull</strong>'); 
									 }
								   
						 
								 }else{
								  $("#loading").dialog('close'); 
								  error_func(respond);
								}
								
							});
							 
							 
							 
						 },
							
						"Cancel": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
							
							
		    $('div [aria-describedby="userPermissions"] div:first span').html(title); 
 
 
 
 return false;
 }
   

 
  
 // Deposit 
function addDeposit(customer_id, fixBalaceSelect, customName){

 var filter_ = /\a/;
	
  if(customer_id == 'add'){
   var customer_id2 = customer_id;
  }else if (filter_.test(customer_id)) { 
  var customer_id2 = customer_id.replace('a','');
	 customer_id = 'edita';
	
  }else { 
  var customer_id2 = customer_id;
 
  }
  
  	$('li#pymentType3').show();
	
	   if(customer_id == 'add'){
	  
		$('li#fixBalancesItem_s_2').hide();
        $('li#nameOfNewCust,li#mobileNewCust').show();
	    }else if(customer_id == 'edita'){
		
	       $('li#fixBalancesItem_s_2').hide();
           $('li#nameOfNewCust,li#mobileNewCust').hide();
		   $('#enableFixBalance').prop('checked', true); 
		   
	    }else{
		 $('li#fixBalancesItem_s_2').show();
	    $('li#nameOfNewCust,li#mobileNewCust').hide();	
		}
		
	 
      $("li#pymentType3").html('<label>Paymen type : </label><select id="paymntType_3"><option class="opt" selected="selected">Choose.</option> <option class="opt">Cash</option>  <option class="opt">check</option> </select>');
		 // $("#paymntType_1 option").removeAttr('selected');
		  	$("li#pymentType3 select#paymntType_3").data("placeholder","Select item name...").chosen();
		     $('#checkDiv_3,li#paymnCash3').attr('style','display:none;');  // hide
			toggePaymentType3();
			
			
 // input#addDepositCash   label#currentBalance  input#enableFixBalance   li#fixBalancesItems
   $('div#addDeposit input[type="text"]').val('').removeAttr('style');  // 
     $('label#cashName').text(condFunction(customer_id == 'edita','Amount :','Deposit :'));  
   $('div#addDeposit li#fixBalancesItems').html("<label> Fix </label>"+fixBalaceSelect);
   $("div#addDeposit li#fixBalancesItems select option#laund").html("Laundry's  Balance"); 
   $('div#addDeposit li#fixBalancesItems  select').chosen();
    $('div#addDeposit li#fixBalancesItems .chzn-search').remove();
 $("li#reminingCash").hide(); 
 // .attr("style","font-weight: bold;");  // 
  $('#enableFixBalance,#print_deposit1').prop('checked', false);

  $("li#fixBalancesItems,#currentBalance").attr("hide","hiden").fadeOut(); 
   $("#currentBalance").val('0');
 
  
 var enableFixStatus = "";
$('#enableFixBalance').click(function() {
    if( $(this).is(':checked')) {
	enableFixStatus = "Balance"; 
       //  $("li#fixBalancesItems,#currentBalance").attr("hide","").fadeIn();
		 $("li#fixBalancesItems").html("<label> Fix </label>"+fixBalaceSelect);
		   $("div#addDeposit li#fixBalancesItems select option#laund").html("Laundry's Balance"); 
		      $('div#addDeposit li#fixBalancesItems  select').chosen();
			   $('div#addDeposit li#fixBalancesItems .chzn-search').remove();
		    $("#currentBalance").text('');
			
			
	  var CashValue	  =  $('#addDepositCash').val();  
	  if(!validate_number_value(CashValue)){
           CashValue = 0;
	      } 
     $('p#currentDeposit_rem').text(CommaFormattedN(CashValue ));
	 
	 
	   // $('div#addDeposit').attr('style',' height:300px !important;'); 
	   //	$('div#addDeposit').attr('style',' height:600px !important;'); 
		selectBalances();
		
    }else{
	enableFixStatus = "";
       //  $("li#fixBalancesItems,#currentBalance").attr("hide","hiden").fadeOut();
		  $("li#fixBalancesItems").html("<label> Fix </label>"+fixBalaceSelect);
          $("div#addDeposit li#fixBalancesItems select option#laund").html("Laundry's Balance"); 	
         $('div#addDeposit li#fixBalancesItems  select').chosen();		  
		    $("#currentBalance").text('');
		// $('div#addDeposit').attr('style',' height:300px !important;'); 
		// 	$('div#addDeposit').attr('style',' height:600px !important;'); 
      var CashValue	  =  $('input#addDepositCash').val();  
	  if(!validate_number_value(CashValue)){
           CashValue = 0;
	      } 
    // $('p#currentDeposit_rem').text(CommaFormattedN(CashValue));
   $('p#currentDeposit_rem').text(CommaFormattedN(CashValue)); 
	//	 selectBalances();
	 }
}); 
 
 
 var print_depositStatus = 'off';  
$('#print_deposit1').click(function() {
    if( $(this).is(':checked')) {
	   print_depositStatus = 'on';
	}else{
	   print_depositStatus = 'off';  
	}

}); 

 
 function selectBalances(){
 
 
   var currentBalance =  parseFloat($("li#fixBalancesItems select").find('option:selected').attr('balance'));
   var depositCash	  =  parseFloat($('#addDepositCash').val());  
      
	  if(!validate_number_value(depositCash)){
           depositCash = 0;
	      } 
		  
	 
			  
		/*  if($(this).val() ==  "Balance"){
		 */
			if(depositCash <= currentBalance){
			  $('p#currentDeposit_rem').text('0');
			  $('label#currentBalance').html("Current Balance is : <strong class='redBalance' >"+CommaFormattedN(currentBalance - depositCash)+"</strong>").show();
			 }else{  
			  $('p#currentDeposit_rem').text(CommaFormattedN(depositCash - currentBalance));
			  $('label#currentBalance').html("Current Balance is : <strong class='redBalance'>0</strong>").show();
			 }
			 
	  /* 	 }else{
		 $('label#currentBalance').html("");
		 }   */
 
 return false;
 }
 
  if(customer_id == 'edita'){
   enableFixStatus = "Balance"; 
   }
 
  $('input#addDepositCash').keyup(function (){
   
  
  	   if(customer_id == 'add'){
	       $("li#reminingCash").hide();
	    }else if(customer_id == 'edita'){
		    $("li#reminingCash").hide();
	    }else{
		    $("li#reminingCash").show();	
		}
		
 
   $('p#currentDeposit_rem').show();
    $('label#currentBalance').show();
	
   var currentBalance = condFunction( customer_id == 'edita',fixBalaceSelect,parseFloat($("li#fixBalancesItems select").find('option:selected').attr('balance')));
   var depositCash	  =  parseFloat($(this).val());  
      
	  if(!validate_number_value(depositCash)){
           depositCash = 0;
	      } 
 
		  
     if($('#enableFixBalance').is(':checked')) {
	    
 	    
			if(depositCash <= currentBalance){
			  $('p#currentDeposit_rem').text('0');
			  $('label#currentBalance').html("Current Balance is : <strong class='redBalance' >"+CommaFormattedN(currentBalance - depositCash)+"</strong>");
			 }else{  
			  $('p#currentDeposit_rem').text(CommaFormattedN(depositCash - currentBalance));
			  $('label#currentBalance').html("Current Balance is : <strong class='redBalance'>0</strong>");
			 }
			 
		 
		   
		 }else if(customer_id == 'edita'){
		 
			  $('label#currentBalance').html("Current Balance is : <strong class='redBalance' >"+CommaFormattedN(currentBalance - depositCash)+"</strong>");
		 
		 }else{
		   $('label#currentBalance').html("");
		     $('p#currentDeposit_rem').text(CommaFormattedN(depositCash)); 
		 }
  
	  $('#checkInWords3').text(toWords(depositCash)); 
  });
  
  
	//$('div#addDeposit').attr('style',' height:600px !important;'); 
	$('div#addDeposit p').text('0').css('font-weight','bold');
	 $('#checkInWords3').text('');
	  $('div#addDeposit').dialog({  position: 'top',show: "blind", hide: "explode", width: '404',  height:'504', modal: true, buttons:  {
							"Ok": function() {
							 // change  the current Item 
							 
							    var addDepositCash	   =  $('#addDepositCash').val();
                                var enableFixBalance	=  $('li#fixBalancesItems').attr("hide");
                                var fixBalaces	   =  enableFixStatus;
								
					    var customerName = $('#customerNameNew').val(); 
						var mobile_OfCust = $('#mobile_OfCust').val();
 
                              var checkBankName = $('#checkBankName3').val();
						       var checkDate =  $('#checkDate3').val();
						       var checkName = $('#checkName3').val();
						       var checkAddress =  $('#checkAddress3').val();
						       var checkAcountNo =  $('#checkAcountNo3').val();
						       var checkPayToName =  $('#checkPayToName3').val();
						       var checkInWords =  $('#checkInWords3').text();
						       var checkMemo =  $('#checkMemo3').val();
				               var paymentOption =   $('#paymntType_3').val();		   
 
 
	 if(paymentOption == 'check'){
	 
		 if(jQuery.trim(checkBankName) == ''){
			   error_func('Error Enter Bank Name!');	
			 $('#checkBankName3').css('border','2px groove red');
			  return false
		 }else if(jQuery.trim(checkDate) == ''){
		  error_func('Error Enter Date!');	
			 $('#checkDate3').css('border','2px groove red');
			  return false
		 }else if(jQuery.trim(checkName) == ''){
		  error_func('Error Enter Name!');	
			 $('#checkName3').css('border','2px groove red');
			  return false
		 }else if(jQuery.trim(checkAcountNo) == ''){
			 error_func('Error Enter Account Number!');	
			 $('#checkAcountNo3').css('border','2px groove red');
			  return false
		 }else if(jQuery.trim(checkPayToName) == ''){
			 error_func('Error Enter order Name!');	
			 $('#checkPayToName3').css('border','2px groove red');
			  return false
		 }
	 
	 }else if(paymentOption == 'Choose.'){
	     error_func('Error Select Payment Type!');
		 return false;
	 }
 
						       if(jQuery.trim(customerName) == '' && customer_id == 'add'){
								   error_func('Error Please Enter Name !');	
								    $('input#customerNameNew').css('border','2px groove red');
								 }else if(jQuery.trim(addDepositCash) == '' ){
								   error_func('Error Please Enter Amount!');	
								    $('input#addDepositCash').css('border','2px groove red');
								 }else if(!validate_number_value(addDepositCash)){
								   error_func('Error invalid  Amount !');	
								    $('input#addDepositCash').css('border','2px groove red');
								 }else if( enableFixBalance =='' &&  fixBalaces == "Choose..."){
								      error_func('Error Please Select Balance Option !');	
								 }else  if(customer_id == 'edita' && !validate_number_value(fixBalaceSelect - addDepositCash)){
		                               error_func('Error Please Enter Amount!');	
								      $('input#addDepositCash').css('border','2px groove red');
	                             }else{
 		   
							  loading_func(); // SHOW LOADING IMAGE DIALOG  
							   //  expenceName  numberOfExpence  expenceCost  expenceDate
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
						
		                        
							$.post('php_f/addDeposit.php', {mobile_OfCust:mobile_OfCust,customerName:customerName,paymentOption1:paymentOption1,checkMemo1:checkMemo1,checkInWords1:checkInWords1,checkPayToName1:checkPayToName1,checkAcountNo1:checkAcountNo1,checkAddress1:checkAddress1,checkName1:checkName1,checkDate1:checkDate1,checkBankName1:checkBankName1,addDepositCash:addDepositCash, fixBalaces:fixBalaces, customer_id2:customer_id2}, function(feedback_add_Deposit) {					
								
								if(feedback_add_Deposit == 1){ 
								  
								    Load_Items();
								 	if($("#loading").closest('.ui-dialog').is(':visible')) { 
									$('#addDeposit').dialog("close");  // 
										  $("#loading").dialog('close');
										   $("#showBeds_div").dialog('close');
										   
										   
										if(paymentOption1 == 'check'){
											   if(print_depositStatus == 'on'){
											       // print check 
							                       print_Check(checkBankName1,checkDate1,checkName1,checkAddress1,checkAcountNo1,checkPayToName1,checkInWords1,checkMemo1,addDepositCash);
											    }
										   }
										   
										   
										  success_func('<strong>Successfull</strong>'); 
									 } 
 
								 }else{
								  $("#loading").dialog('close'); 
								  error_func(feedback_add_Deposit);
								}
								
							}); 
							 
								 }
							
							 
							 
						 },
							
						"Cancel": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
        
		var titlebar =  'Adding New Deposit to ('+customName+")";
		//alert(customer_id);
	    if(customer_id == 'add'){
	      titlebar = "Adding New Deposit to New Custom ..";
	    }else if(customer_id == 'edita'){
		  titlebar =  'editing Balance for ('+customName+')';
		}else{ 
	    titlebar =  'Adding New Deposit to ('+customName+")";
		}	
		
		$('div [aria-describedby="addDeposit"] div:first span').html(titlebar); 
       
 return false;
 }
 
 
 
 // use Remaining Deposit Cash 
 function useTheRestOfDeposit(customer_id,fixBalaceSelect,custom_Name,depositCash){
    




	
	       $('li#fixBalancesItem_s_2').show();
           $('li#nameOfNewCust,li#mobileNewCust').hide();
		   $('#enableFixBalance').prop('checked', false); 
		 $("#reminingCash,#paymnCash3").show();   
	  

 // input#addDepositCash   label#currentBalance  input#enableFixBalance   li#fixBalancesItems      // 
   $('div#addDeposit input[type="text"]').val('').removeAttr('style');  //   currentDeposit_rem
    $('p#currentDeposit_rem').html("<strong>"+CommaFormattedN(depositCash)+"</strong>").attr("style","font-weight: bold;");
    $('label#cashName').text("Amount :"); 
	$('li#pymentType3').hide();
	     $('#checkDiv_3').attr('style','display:none;');  // hide
   $('div#addDeposit li#fixBalancesItems').html("<label> Fix </label>"+fixBalaceSelect);
   $("div#addDeposit li#fixBalancesItems select option#laund").html("Laundry's Balance"); 
   $('div#addDeposit li#fixBalancesItems  select').chosen();
    $('div#addDeposit li#fixBalancesItems .chzn-search').remove();
   $("li#reminingCash").show(); 
  $('#enableFixBalance').prop('checked', false);  
  $("li#fixBalancesItems,#currentBalance").attr("hide","hiden").fadeOut(); 
   $("#currentBalance").val('0');
   
  var enableFixStatus = "";
$('#enableFixBalance').click(function() {
    if( $(this).is(':checked')) {
		enableFixStatus = "Balance";
       //  $("li#fixBalancesItems,#currentBalance").attr("hide","").fadeIn();
		 $("li#fixBalancesItems").html("<label> Fix </label>"+fixBalaceSelect);
		   $("div#addDeposit li#fixBalancesItems select option#laund").html("Laundry's Balance"); 
		      $('div#addDeposit li#fixBalancesItems  select').chosen();
			 $('div#addDeposit li#fixBalancesItems .chzn-search').remove();
			  
			  
		    $("#currentBalance").text('');
	    $('div#addDeposit').attr('style',' height:300px !important;'); 
		
      var CashValue	  =  parseFloat($('#addDepositCash').val());  
	  if(!validate_number_value(CashValue)){
           CashValue = 0;
	      } 
      $('p#currentDeposit_rem').text(CommaFormattedN( depositCash - CashValue ));
	 
       selectBalances();
    }else{
         enableFixStatus = "";
      //   $("li#fixBalancesItems,#currentBalance").attr("hide","hiden").fadeOut();
		  $("li#fixBalancesItems").html("<label> Fix </label>"+fixBalaceSelect);
          $("div#addDeposit li#fixBalancesItems select option#laund").html("Laundry's Balance"); 	
         $('div#addDeposit li#fixBalancesItems  select').chosen();		  
		    $("#currentBalance").text('');
		 $('div#addDeposit').attr('style',' height:300px !important;'); 
		 
	  var CashValue	  =  parseFloat($('#addDepositCash').val());  
	  if(!validate_number_value(CashValue)){
           CashValue = 0;
	      } 
     $('p#currentDeposit_rem').text(CommaFormattedN( depositCash - CashValue ));
 
       // selectBalances();
    }

	
	
	}); 
 
   
 
 function selectBalances(){
  // $("li#fixBalancesItems select").change(function (){
 
   var currentBalance =  parseFloat($("li#fixBalancesItems select").find('option:selected').attr('balance'));
   var CashValue	  =  parseFloat($('#addDepositCash').val());  
      
	  if(!validate_number_value(CashValue)){
           CashValue = 0;
	      } 
		  
	/*  if($(this).val() ==  "Balance"){
	    */
	   if(depositCash < currentBalance){
		  $('p#currentDeposit_rem').html('<strong  >0</strong>');
		  $('label#currentBalance').html("Current Balance is : <strong  class='redBalance'>"+CommaFormattedN(currentBalance - depositCash)+"</strong>").show();
		 }else{  
		 //  alert(depositCash +"<"+ currentBalance);
		  $('p#currentDeposit_rem').html("<strong>"+CommaFormattedN((depositCash - currentBalance) - CashValue )+"</strong>");
		  $('label#currentBalance').html("Current Balance is : <strong  class='redBalance'>0</strong>").show();
		 }
		 
 /*     }else{ 
 
	     $('p#currentDeposit_rem').html("<strong>"+CommaFormattedN( depositCash - CashValue )+"</strong>");
	     $('label#currentBalance').html("");
	  } */
	  
	  
//  });
 return false;
 }


  $('#addDepositCash').keyup(function (){
   
  
   var currentBalance  =  parseFloat($("li#fixBalancesItems select").find('option:selected').attr('balance'));
   var CashValue	  =   parseFloat($('#addDepositCash').val());  
      
	  if(!validate_number_value(CashValue)){
           CashValue = 0;
	      } 
 
		   $("li#reminingCash").show(); 
	     if($('#enableFixBalance').is(':checked')) {
			
			
			if(depositCash < currentBalance){
			  $('p#currentDeposit_rem').text('0');
			  $('label#currentBalance').html("Current Balance is : <strong class='redBalance' >"+CommaFormattedN(currentBalance - depositCash)+"</strong>");
			 }else{  
			  $('p#currentDeposit_rem').text(CommaFormattedN((depositCash - currentBalance) - CashValue ));
			  $('label#currentBalance').html("Current Balance is : <strong  class='redBalance' >0</strong>");
			 }
			 
		 }else{
			 $('p#currentDeposit_rem').text(CommaFormattedN( depositCash - CashValue ));
			 $('label#currentBalance').html("");
		  }
	   
 
  });
  
	
	$('div#addDeposit').attr('style',' height:300px !important;'); 
	  $('div#addDeposit').dialog({  position: 'top',show: "blind", hide: "explode", width: '505',  modal: true, buttons:  {
							"Ok": function() {
							 // change  the current Item 
							 
							    var addDepositCash	   =  $('#addDepositCash').val();
                                var enableFixBalance	=  $('li#fixBalancesItems').attr("hide");
                                var fixBalaces	   =  enableFixStatus;
 
						         if(!validate_number_value(addDepositCash)  &&  jQuery.trim(addDepositCash) != '' ){
								   error_func('Error invalid  Cash !!');	
								    $('input#addDepositCash').css('border','2px groove red');
								 }else if( enableFixBalance =='' &&  fixBalaces == "Choose..."){
								      error_func('Error Please Select Balance Option !');	
								 }else if( parseFloat(addDepositCash)  > parseFloat(depositCash) ){
								 
								 	   error_func('Error invalid  Cash !');	
								    $('input#addDepositCash').css('border','2px groove red');
								 }else{
 		   
							  loading_func(); // SHOW LOADING IMAGE DIALOG  
							   //  expenceName  numberOfExpence  expenceCost  expenceDate
 
							$.post('php_f/useRemaining_Deposig.php', {  addDepositCash:addDepositCash, fixBalaces:fixBalaces, customer_id:customer_id}, function(feedback_add_Deposit) {					
								
								if(feedback_add_Deposit == 1){ 
								  
								    Load_Items();
								 	if($("#loading").closest('.ui-dialog').is(':visible')) { 
									    $('#addDeposit').dialog("close");
										  $("#loading").dialog('close');
										  $("#showBeds_div").dialog('close');
										  success_func('<strong>Successfull</strong>'); 
									 } 
 
								 }else{
								  $("#loading").dialog('close'); 
								  error_func(feedback_add_Deposit);
								}
								
							});
							 
								 }
							
							 
							 
						 },
							
						"Cancel": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
        $('div [aria-describedby="addDeposit"] div:first span').text("Using Deposit Balance For ("+custom_Name+")"); 
        $('div#addDeposit').css('height','248px !important');   
 
 
 return false;
 }
 
 
 function deleteDeposit(depositId,customer_id){
 
  
  
	   $('#warning').html('<img src="css/warning.png" alt="warning" style="border-radius:2.5em; width:80px; height:40px; margin-right: 4px; "/>Are you Sure you want to delete ?').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Yes": function() {
							 // submit the ans-ware
							  $(this).dialog("close");
							  loading_func(); // SHOW LOADING IMAGE DIALOG  
							$.post('php_f/deleteDeposit.php', {depositId:depositId, customer_id:customer_id}, function(feedback_del) {					
								
								if(feedback_del == 1){ 
								   
								   Load_Items();
								 	if($("#loading").closest('.ui-dialog').is(':visible')) { 
									 
										  $("#loading").dialog('close');
										     $("#showBeds_div").dialog('close');
										  success_func('<strong>Successfull</strong>'); 
									 } 
						 
								 }else{
								  $("#loading").dialog('close'); 
								  error_func(feedback_del);
								}
									 if($("#moreDetails_of_date_customers").closest('.ui-dialog').is(':visible')) { 
									$('#moreDetails_of_date_customers').dialog("close");
									 }
							});
							 
							 
							 
						 },
							
						"No": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
							
							
		    $('div [aria-describedby="warning"] div:first span').html('Deleting'); 
 

 
 }
 
 
  // edit depsit Cash 
 function editDeposit(cusomerId,depositId,custom_Name,remainingCash){
 
   	$('p#currentDeposit_rem_').text(CommaFormattedN(remainingCash)).attr('style','font-weight:bold;');
	
	 $('#editCashRemaining').keyup(function (){
	 var thisval = $(this).val();
		 if(!validate_number_value(thisval)){
		 thisval = 0;
		 }
	 
	  	$('p#currentDeposit_rem_').text(CommaFormattedN(remainingCash - thisval));
 
	 });
	 
	 
	$('div#editDeposit input[type="text"]').val('').removeAttr('style');
	  $('div#editDeposit').dialog({  position: 'top',show: "blind", hide: "explode", width: '505',  modal: true, buttons:  {
							"Ok": function() {
							 // change  the current Item 
							 
							    var editedCash	   =  $('#editCashRemaining').val();
							   if(jQuery.trim(editedCash) == ''){
										error_func('Error Please Enter Cash !!');	
										$('input#editCashRemaining').css('border','2px groove red');
								}else if(!validate_number_value(editedCash)){
									   error_func('Error invalid  Cash !!');	
								    $('input#editCashRemaining').css('border','2px groove red');
								 }else if( parseFloat(editedCash)  > remainingCash ){
								      error_func('Error invalid  Cash !!');	
								     $('input#editCashRemaining').css('border','2px groove red');
								 }else{
 		   
							  loading_func(); // SHOW LOADING IMAGE DIALOG  
							   //  expenceName  numberOfExpence  expenceCost  expenceDate
                                                       
							$.post('php_f/editRemainingCash.php', {  editedCash:editedCash, depositId:depositId, cusomerId:cusomerId}, function(feedback_add_Deposi) {					
								
								if(feedback_add_Deposi == 1){ 
								  
								    Load_Items();
								 	if($("#loading").closest('.ui-dialog').is(':visible')) { 
									$('#editDeposit').dialog("close");
										  $("#loading").dialog('close');
										     $("#showBeds_div").dialog('close');
										  success_func('<strong>Successfull</strong>'); 
									 } 
 
								 }else{
								  $("#loading").dialog('close'); 
								  error_func(feedback_add_Deposi);
								}
								
							});
							 
								 }
							
							 
							 
						 },
							
						"Cancel": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
        $('div [aria-describedby="editDeposit"] div:first span').text("Using Deposit Balance For ("+custom_Name+")"); 
      
 
 
 }
 
 
 // end of deposit
 





// items
 
function addItemToStore(){

// 	  sToreItemName  numberOfStore  add_editStore
 
 
   $('#add_editStore input[type="text"]').val('').removeAttr('style');
   // $('#numberOfStore').css('width','157');
	  $('#add_editStore').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Ok": function() {
							 // change  the current Item 
							  	 
                               var storeItemName   =  $('#sToreItemName').val();
							//   var numberOfstore	   =  $('#numberOfStore').val();
 
								 if(jQuery.trim(storeItemName) == ''){
								 error_func('Error Please enter Item Name!');	
								  $('input#storeItemName').css('border','2px groove red');		
								 }else{
								 
								 
								 
									   
							  loading_func(); // SHOW LOADING IMAGE DIALOG  
							   //  expenceName  numberOfExpence  expenceCost  expenceDate
 
							$.post('php_f/add_MainItem.php', {storeItemName:storeItemName}, function(feedback_add_store) {					
								
								if(feedback_add_store == 1){ 
								  
								    Load_Items();
								 	if($("#loading").closest('.ui-dialog').is(':visible')) { 
									$('#add_editStore').dialog("close");
										  $("#loading").dialog('close');
										  success_func('<strong>Successfull</strong>'); 
									 } 
 
								 }else{
								  $("#loading").dialog('close'); 
								  error_func(feedback_add_store);
								}
								
							});
							 
								 }
							
							 
							 
						 },
							
						"Cancel": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
        $('div [aria-describedby="add_editStore"] div:first span').text('Adding New Item'); 
 
 

return false;
}

 
 // edit main Item
  
function editMainItem(itemId,oldStoreItemName){
 
   $('#add_editStore input[type="text"]').removeAttr('style');
    $('#numberOfStore').css('width','157');
  $('#sToreItemName').val(oldStoreItemName);
 // $('#numberOfStore').val(itemNumber);
 
	  $('#add_editStore').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Ok": function() {
							 // change  the current Item 
							  	 
                               var storeItemName_   =  $('#sToreItemName').val();
							 
 
								 if(jQuery.trim(storeItemName_) == ''){
								 
						          error_func('Error Please enter Item Name!');	
								  $('input#storeItemName').css('border','2px groove red');		
								 }else{
								 
								 
								 
									   
							  loading_func(); // SHOW LOADING IMAGE DIALOG  
							   //  expenceName  numberOfExpence  expenceCost  expenceDate
 
							$.post('php_f/edit_MainItem.php', {itemId:itemId, storeItemName_:storeItemName_, oldStoreItemName:oldStoreItemName}, function(feedback_edit_store) {					
								
								if(feedback_edit_store == 1){ 
								  
								    Load_Items();
								 	if($("#loading").closest('.ui-dialog').is(':visible')) { 
									$('#add_editStore').dialog("close");
										  $("#loading").dialog('close');
										  success_func('<strong>Successfull</strong>'); 
									 } 
 
								 }else{
								  $("#loading").dialog('close'); 
								  error_func(feedback_edit_store);
								}
								
							});
							 
								 }
							
							 
							 
						 },
							
						"Cancel": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
        $('div [aria-describedby="add_editStore"] div:first span').text('Editing '+oldStoreItemName); 
 
return false;
}

 // delete main Item
 
 

function deleteMainItem(itemId,itemName){
 
  
	   $('#warning').html('<img src="css/warning.png" alt="warning" style="border-radius:2.5em; width:80px; height:40px; margin-right: 4px; "/>Are you Sure you want to delete <strong>'+itemName+'</strong> ?').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Yes": function() {
							 // submit the ans-ware
							  $(this).dialog("close");
							  loading_func(); // SHOW LOADING IMAGE DIALOG  
							$.post('php_f/deleteMainItem.php', {itemId:itemId}, function(feedback_deleted_exp) {					
								
								if(feedback_deleted_exp == 1){ 
								   
								   Load_Items();
								 	if($("#loading").closest('.ui-dialog').is(':visible')) { 
									$('#warning').dialog("close");
										  $("#loading").dialog('close');
										  success_func('<strong>Successfull</strong>'); 
									 } 
						 
								 }else{
								  $("#loading").dialog('close'); 
								  error_func(feedback_deleted_exp);
								}
									 if($("#moreDetails_of_date_customers").closest('.ui-dialog').is(':visible')) { 
									$('#moreDetails_of_date_customers').dialog("close");
									 }
							});
							 
							 
							 
						 },
							
						"No": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
							
							
		    $('div [aria-describedby="warning"] div:first span').html('Deleting <strong>'+itemName+'</strong>'); 
 

 return false;
}

	
 
 
 
function  moreOfStoreDetails(itemId,table,itemName){

/* 

	   $('#showBeds_div').html('<button id="add_storeNU_button"  addBtton="add"  title="click to add item !"> Add (<strong> '+itemName+'</strong> )</button>'+table).dialog({  position:'top', show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Close": function() {
							 // submit the ans-ware
							  $(this).dialog("close");
						  
						 },
							
				 
							}});
							
		/* 	 $('#showBeds_div button#add_storeNU_button').click(function (){
			 add_new_item(itemName,itemId)
			 return false;
			 }); */
			 
/* 		 
		    $('div [aria-describedby="showBeds_div"] div:first span').html('Details for (<strong>'+itemName+'</strong>)'); 
 
 applyButtons();
 
      $('div#showBeds_div table').dataTable({
								"bJQueryUI": true,
								"sPaginationType":"full_numbers",
							 
								} );
   */
return false;
}



// when recieve item changed
 function chooseRecieveItem(availbleItemsNow,value,decription){
 
  if(value == "New"){
  
  
		  $(this).removeClass("chosenExpencType");
		  $("li#itemNamesSelect input[type='text']:first").fadeIn().focus();
		   $('#availableItems').html(CommaFormattedN(condFunction(validate_number_value(numberOfItems),Number(numberOfItems)+Number(availbleItemsNow),availbleItemsNow)));
     // $("li#sellingPlane").fadeIn(); 
  sellingPlanChoiseFunc($('li#sellingPlane select#sellingPlanChoise').val());	  
	   $('#changePriceInReceing').prop('checked', true); 
		 }else{
	    $('#itemDescription1').attr('placeholder','Enter Description for '+value+''); 
		 $("li#itemNamesSelect input[type='text']:first").fadeOut();
		  var numberOfItems = $('#Number_of_Item').val();
		$('#itemDescription1').val(decription);  
          $('#availableItems').html(CommaFormattedN(condFunction(validate_number_value(numberOfItems),Number(numberOfItems)+Number(availbleItemsNow),availbleItemsNow)));
   
		  }
return false;
 }

 
// adding new Item
function add_new_item(mod,receivdId,item_iden,receiverNme,numbrofItems,cstOfItem){
	
	// clone tabs
	
	
	$('#add_more_sell_items').click(function (){
	    var items_selector =  $("h5#itemNamesSelectOpiond").html();
           
 	 
		var second_tab_div = $('div#items_tabs_').html();			
		var current_count = $('#tabes_handler_items li').length;
		var next_count  =  current_count + 1;
		
 
   
		 $('#tabes_handler_items').append('<li><a href="#items_tabs_'+next_count+'" id="tab_link'+next_count+'" >item '+next_count+' </a></li>');	 
		 $('#tabs_items_sell').append('<div id="items_tabs_'+next_count+'" class="sells_div"> '+second_tab_div+' </div>');
 
		 $('#items_tabs_'+next_count+' li#itemNamesSelect').html(items_selector);
	     $('#items_tabs_'+next_count+' li#itemNamesSelect input:first').attr('class','newItemName');
		   
		 // insert tab id into each element in that tab 
	  $('div#items_tabs_'+next_count+' * ').attr('tab_id','tab_link'+next_count+'').attr('div_id','items_tabs_'+next_count+'');
 	 
		 /*  $('#tab_'+next_count+' #list_itemn select').removeAttr('id');
  $('#tab_'+next_count+'  #other_detials').html(other_ditails); 
		$('#tab_'+next_count+' #cunstname').text('');
		$('#tab_'+next_count+' #mobile_li').text('');
  $('div#tab_'+next_count+' select , #tab_'+next_count+'  #other_detials *').attr('tab_id','tab_link'+next_count+'');
 
    */
	 
	
	   // remove button 
	    $('div#items_tabs_'+next_count+'').append('<button id="remove_tab_but_items" > remove </button>');
     

	  
	  $('#items_tabs_'+next_count+' select').data("placeholder","Select item name...").chosen();
        $("div#tabs_items_sell").tabs("refresh");
      // $('#items_tabs_'+next_count+' #list_itemn').next().find('.chzn-search').remove();
 
  
  
  
  
  
  
  
  
  	 
	
 // calculating singl and whole from number of items
 
      $('#items_tabs_'+next_count+' #Number_of_Item').keyup(function (){

          if(jQuery.trim($(this).val()) == ''){   
		  return false;
		}

          var singleCost  = parseFloat($('#items_tabs_'+next_count+' input.persentTage').val().replace(/,/g, ''));
	      var number_of_Item  =  parseFloat($(this).val().replace(/,/g, ''));
          $('#items_tabs_'+next_count+' #cost_of_item').val(CommaFormattedN(Math.floor(singleCost * number_of_Item)));
                  
        var availbleQuantity =  parseFloat($('#items_tabs_'+next_count+' li#itemNamesSelect select').find("option:selected").attr("availbleItemsNow"));
	    var satustion  = $(this).attr('mod');
	    var satustionVAl  = $(this).attr('removeAval');
 
	   
	   // calculate current available quantity
	  if(satustion == 'edit'){
	  
		 if(Number(number_of_Item) < satustionVAl){
		    $('#items_tabs_'+next_count+' #availableItems').html(CommaFormattedN(condFunction(validate_number_value(availbleQuantity),availbleQuantity,0)));
		  }else{
		   var number_of_Item2 =  number_of_Item - satustionVAl; 
		    $('#items_tabs_'+next_count+' #availableItems').html(CommaFormattedN(number_of_Item2 + availbleQuantity ));
		  }
		  
	  }else{
 $('#items_tabs_'+next_count+' #availableItems').html(CommaFormattedN(number_of_Item2 + availbleQuantity ));

 $('#items_tabs_'+next_count+' #availableItems').html(CommaFormattedN(number_of_Item + availbleQuantity));
	 
 }  	 
	 
	  
	 }); 	
	   
	 
	 
 
	
	
	 // $('#Number_of_Item').attr("disabled","disabled");
      $('#items_tabs_'+next_count+' input.persentTage').change(function (){

          if(jQuery.trim($(this).val()) == ''){   
		  return false;
		}

          var singleCost  = parseFloat($(this).val().replace(/,/g, ''));
	  var number_of_Item  =  parseFloat( $('#items_tabs_'+next_count+' #Number_of_Item').val().replace(/,/g, ''));	
         
	     $('#items_tabs_'+next_count+' #cost_of_item').val(CommaFormattedN(singleCost * number_of_Item));

   
          });
 
     
   
	$('#items_tabs_'+next_count+' li#itemNamesSelect select').change(function (){ 
	 var itemsElement =  $(this).find("option:selected");
	 var availbleItemsNow =  itemsElement.attr("availbleItemsNow");
	 var whole     = itemsElement.attr("whole");
	$('#items_tabs_'+next_count+' input#product_price').val(whole);   // current price
 
	 var retail     = itemsElement.attr("retail");
	 // var itemId =  itemsElement.attr("itemId");
	 
	   if (jQuery.trim(whole) == '0'){ // is retail
		     $('#items_tabs_'+next_count+' li#sellingPlane select#sellingPlanChoise option').each(function (){
			 var valueNow = $(this).val();
		//	 alert(valueNow);
			  if (jQuery.trim(valueNow) == 'Retail'){
			   $(this).attr("selected","selected");
			//	return false;
			  }else{
			    $(this).removeAttr("selected");
			  }
      
			 });
			 
			  }else{ // is wholesale
			  
			$('#items_tabs_'+next_count+' li#sellingPlane select#sellingPlanChoise option').each(function (){
			 var valueNow = $(this).val();
			  if (jQuery.trim(valueNow) == 'Wholesale'){
			   $(this).attr("selected","selected");
			   // $("li#itemNamesSelect select").chosen();
			//	return false;
			  }else{
			    $(this).removeAttr("selected");
			  }
      
			 });
			 
			  }
			  
	 
     if(jQuery.trim($(this).val())!='choose..'){
	
	
		 if(jQuery.trim($(this).val())=='New'){
		  $('span#ui-id-26').html('Receiving New Item'); 
		 }else{
		  $('#tabes_handler_items a#tab_link'+next_count+'').html($(this).val());
		  $('span#ui-id-26').html('Receiving ('+$(this).val()+')'); 
		 }
	 		 
	// when recieve item changed
 var decription = itemsElement.attr("decrptn");
 var value = $(this).val();
 
  if(value == "New"){
  
  
		  $(this).removeClass("chosenExpencType");
		 $('#items_tabs_'+next_count+' li#itemNamesSelect input[type="text"]:first').fadeIn().focus();
		 $('#items_tabs_'+next_count+' #availableItems').html(CommaFormattedN(condFunction(validate_number_value(numberOfItems),Number(numberOfItems)+Number(availbleItemsNow),availbleItemsNow)));
     // $("li#sellingPlane").fadeIn(); 
  sellingPlanChoiseFunc($('#items_tabs_'+next_count+' li#sellingPlane select#sellingPlanChoise').val());	  
	  $('#items_tabs_'+next_count+' #changePriceInReceing').prop('checked', true); 
		 }else{
	    $('#items_tabs_'+next_count+' #itemDescription1').attr('placeholder','Enter Description for '+value+''); 
		$('#items_tabs_'+next_count+' li#itemNamesSelect input[type="text"]:first').fadeOut();
		  var numberOfItems = $('#items_tabs_'+next_count+' #Number_of_Item').val();
		$('#items_tabs_'+next_count+' #itemDescription1').val(decription);  
        $('#items_tabs_'+next_count+' #availableItems').html(CommaFormattedN(condFunction(validate_number_value(numberOfItems),Number(numberOfItems)+Number(availbleItemsNow),availbleItemsNow)));
   
		 }
	 
	 } 
      
	  }); 
 
 
  	// tab text to the current item name 
	$('#items_tabs_'+next_count+' input.newItemName').change(function(){
        $('#tabes_handler_items a#'+$(this).attr("tab_id")+'').html($(this).val());
    });
  
  
               // when  remove button has been clicked 
			$('div#items_tabs_'+next_count+' button#remove_tab_but_items').click(function (){ 
			 
				$('#tabs_items_sell div.sells_div').last().remove();	
				  $('#tabes_handler_items li').last().remove();	
		         var last_tab_id = $('#tabes_handler_items li a').last().attr('id');
	 
                   document.getElementById(last_tab_id).click();					  
			  }).button(
	  {
	    height:'7px',
		icons: {primary: 'ui-icon-trush', secondary: null}
	  }).css('font-size','12px');
 
         document.getElementById('tab_link'+next_count).click();	  // jump to the current tab
	});
	
	
   $('div#items_tabs_ * ').attr('tab_id','tab_link').attr('div_id','items_tabs_');
	
	// clone tabs
	
	
	
	
calculatedCost_persentage = '';
 $("div#addUniqueItemOrEdit li#sellingPlane,div#addUniqueItemOrEdit li#sellPlan2,div#addUniqueItemOrEdit li#sellPlan1").remove(); 
 $("div#add_new_item_div li#sellingPlane,div#add_new_item_div li#sellPlan2,div#add_new_item_div li#sellPlan1").remove();
   $("#add_new_item_div input[type='text']").val('').removeAttr('style');	
  $("#add_new_item_div textarea").val('').attr('placeholder','enter description here ..');
 if(mod !='edit'){ 
  $("div#add_new_item_div ul li#append1").append('<li id="sellingPlane" style="display:none;">   </li> <li id="sellPlan1" style="display:none;" > <label> Wholesale Price : </label><input type="text" id="Wholesale_price" />  + <input type="text" id="wl_benefit" size="13" /> = <b id="t_wlPrice" style="font-weight:bold;">0</b>  </li><li id="sellPlan2" style="display:none;" > <label>Retail Price:  </label> <input type="text" id="Single_sell_Price"/>  + <input type="text" size="13" id="sl_benefit" /> = <b id="t_slPrice" style="font-weight:bold;">0</b></li>');
 $('div#add_new_item_div li#sellingPlane').html('<label>selling plan:  </label>  <select  onchange="sellingPlanChoiseFunc($(this).val())" id="sellingPlanChoise"  style="margin: 3px; width: 200px !important; display: ;"  ><option class="opt" >Retail</option>    <option class="opt" selected="selected">Wholesale</option> </select>');
 }   	 

                 $('li#sellingPlane').hide();
           
   var allCategoryOfExpence = $("h5#itemNamesSelectOpiond").html();
            $("li#itemNamesSelect").html(allCategoryOfExpence); 
			 $("li#itemNamesSelect input:first").attr('class','newItemName');
			 
	if(mod!='to'){
		  $("li#itemNamesSelect select").chosen();
	}		
	
  
	$("li#itemNamesSelect select").change(function (){ 
	 var itemsElement =  $(this).find("option:selected");
	 var availbleItemsNow =  itemsElement.attr("availbleItemsNow");
	 var whole     = itemsElement.attr("whole");
	 $('input#product_price').val(whole);   // current price
 
	 var retail     = itemsElement.attr("retail");
	 // var itemId =  itemsElement.attr("itemId");
	 
	   if (jQuery.trim(whole) == '0'){ // is retail
		      $('li#sellingPlane select#sellingPlanChoise option').each(function (){
			 var valueNow = $(this).val();
		//	 alert(valueNow);
			  if (jQuery.trim(valueNow) == 'Retail'){
			   $(this).attr("selected","selected");
			//	return false;
			  }else{
			    $(this).removeAttr("selected");
			  }
      
			 });
			 
			  }else{ // is wholesale
			  
			$('li#sellingPlane select#sellingPlanChoise option').each(function (){
			 var valueNow = $(this).val();
			  if (jQuery.trim(valueNow) == 'Wholesale'){
			   $(this).attr("selected","selected");
			   // $("li#itemNamesSelect select").chosen();
			//	return false;
			  }else{
			    $(this).removeAttr("selected");
			  }
      
			 });
			 
			  }
			  
			 //$("li#sellingPlane").find("div#sellingPlanChoise_chzn").remove();
			// $("li#sellingPlane select#sellingPlanChoise").removeClass("chzn-done").chosen();		  
 
 
     if(jQuery.trim($(this).val())!='choose..'){
	
		 if(jQuery.trim($(this).val())=='New'){
		  $('span#ui-id-26').html('Receiving New Item'); 
		 }else{
		  $('#tabes_handler_items a#tab_link').html($(this).val());
		  $('span#ui-id-26').html('Receiving ('+$(this).val()+')'); 
		 }
		 
		     chooseRecieveItem(availbleItemsNow,$(this).val(),itemsElement.attr("decrptn"));
	 } 
      
	  }); 
 
   	// tab text to the current item name 
	$("li#itemNamesSelect input:first").change(function(){
        $('#tabes_handler_items a#tab_link').html($(this).val());
    });
	
	  $("#add_new_item_div b,div#add_new_item_div strong#availableItems").text('0');	
	 $('#item_name').hide();
	 
	// $("div#add_new_item_div li#sellPlan1").show();
	 //$("div#add_new_item_div li#sellPlan2").hide();
     

	 
	 if(mod =='edit'){ 
	   
	    $('#receiverName').val(receiverNme);
          $("div#add_new_item_div li#itemNamesSelect div:first").hide();
	      $("li.product_price_box").hide();
		  
	        $('div#add_new_item_div li#itemNamesSelect select option').each(function (){
			 var valueNow = $(this).val();
			 var iden = $(this).attr('itemId');
    
		//	 alert(valueNow);
			  if (jQuery.trim(iden) == item_iden){
			   $(this).attr("selected","selected");
			    $("div#add_new_item_div li#itemNamesSelect ").append('<strong>'+valueNow+'</strong>');
            $("#add_new_item_div b,div#add_new_item_div strong#availableItems").text(CommaFormattedN($(this).attr("availbleItemsNow")));
			 	return false;
			  }else{
			    $(this).removeAttr("selected");
			  }
      
			 }); 

 $('#cost_of_item').val(cstOfItem);	
 $('#Number_of_Item').attr('mod','edit').attr('removeAval',numbrofItems).val(numbrofItems);
 
  $('#dscrptionLi,li#enablePricePlanes').hide();
  $('#receiverName').val(receiverNme);
  
    }else{
 $('#Number_of_Item').removeAttr('mod').val(numbrofItems);	
	//  $('#dscrptionLi,#enablePricePlanes').show();
	  $('#changePriceInReceing').prop('checked', false); 
	  
	}
	
   if(mod =='to'){ 
     
	        $('div#add_new_item_div li#itemNamesSelect select option').each(function (){
			 var valueNow = $(this).val();
			 var iden = $(this).attr('itemId');
			  var availbleItemsNow = $(this).attr("availbleItemsNow");
			  	 var whole  =  $(this).attr("whole");
		//	 alert(valueNow);
			  if (jQuery.trim(iden) == item_iden){
			   $(this).attr("selected","selected");
			   chooseRecieveItem(availbleItemsNow,$(this).val(),$(this).attr("decrptn"));

  
			  if (jQuery.trim(whole) == '0'){ // is retail
		      $('li#sellingPlane select#sellingPlanChoise option').each(function (){
			 var valueNow = $(this).val();
		//	 alert(valueNow);
			  if (jQuery.trim(valueNow) == 'Retail'){
			   $(this).attr("selected","selected");
			//	return false;
			  }else{
			    $(this).removeAttr("selected");
			  }
      
			 });
			 
			  }else{ // is wholesale
			  
			$('li#sellingPlane select#sellingPlanChoise option').each(function (){
			 var valueNow = $(this).val();
			  if (jQuery.trim(valueNow) == 'Wholesale'){
			   $(this).attr("selected","selected");
			   // $("li#itemNamesSelect select").chosen();
			//	return false;
			  }else{
			    $(this).removeAttr("selected");
			  }
      
			 });
			 
			  }
			  
			 $("li#sellingPlane").find("div#sellingPlanChoise_chzn").remove();
			 $("li#sellingPlane select#sellingPlanChoise").removeClass("chzn-done").chosen();		  
 
			   
			    $("li#itemNamesSelect select").chosen();
			 	return false;
			  }else{
			    $(this).removeAttr("selected");
			  }
      
			 });
		 
      }
 
	    
  $("li#sellPlan2,li#sellPlan1,li#sellingPlane").fadeOut();  // hide start up
  $('li#sellingPlane select#sellingPlanChoise option:last').attr('selected','selected');  // force to select last option 
  
 $("#add_new_item_div input[type='text'],#add_new_item_div input[type='number']").val('');
 
 
 // reset the tabs
  
	// first div for default 
	  $('div#add_new_item_div button#remove_tab_but_items').each(function() {
						
				   $('#tabs_items_sell div.sells_div').last().remove();	
				   $('#tabes_handler_items li').last().remove();	
				    
						});
				  $('#tabes_handler_items li a:first').html('items 1')	
				    document.getElementById('tab_link').click();
    
	if(mod =='edit'){
		// hide add more button edit mode
		
		   $('#add_more_sell_items').hide();
	}else{  
         $('#add_more_sell_items').show();
        $("li.product_price_box").show();
 }
	
	
	
	  //$('div#add_new_item_div').attr('style','height:500px !important;'); 
	  $("#add_new_item_div").dialog({  position:"top",show: "blind", hide: "explode", width: '700',  height:'auto',  modal: true, buttons:  {
						"Confirm": function() {
		$('li#sellingPlane select#sellingPlanChoise option:last').attr('selected','selected');  // force to select last option 					 
             
  
								     var receiveName = $('#receiverName').val();
									 var itemId =  new Array();
							
									var item_name =  new Array();
									var Number_of_Item =  new Array();
								    var cost_of_item = new Array();  
									var Wholesale_price = new Array();  
							 
									 
						  
						
						//  loop item IDs
						
						 $("li#itemNamesSelect select").each(function (){ 
						   var current_id = parseFloat($(this).find("option:selected").attr("itemId")); 
						   
							   itemId.push(current_id);
							   
							   
						 })
						
					 
							//  loop item names 
						
						 $("li#itemNamesSelect select").each(function (){ 
						   var currentItemName = '';
						   var divId = $(this).find('option:selected').attr('div_id'); 
						   var current_tab_Id_ = $(this).find('option:selected').attr('tab_id');
						   
						  if(jQuery.trim($(this).val())=='New'){   
						      currentItemName = $("div#"+divId+" li#itemNamesSelect input[type='text']:first").val();
						  }else if(jQuery.trim($(this).val()) == 'choose..' ){
							  currentItemName = '';
						  }else{
							  currentItemName = $(this).val();
						  }
						     
						     if (jQuery.trim(currentItemName) == '' && mod !='edit'){ 
									error_func('Error Please Enter or Select Item  Name !');
								    $("div#"+divId+" li#itemNamesSelect input[type='text']:first").css('border','2px groove red');
								 
										 document.getElementById(current_tab_Id_).click();	
										       var x = 0;
								     var close_confirm = setInterval(function(){ 
									        $("div#confirm_selling_item_items").dialog('close');  
											if(x = 15){clearInterval(close_confirm);}
											x++
									}, 500);
                                       return false;									 
								}else{
									//check if the item is exists
								 
								     item_name.push(currentItemName);
								}
						  
					 
						 });
				  
						
							 //  loop cost of items  
						 
						 $("input#cost_of_item").each(function (){ 
						    
						   var divId = $(this).attr('div_id'); 
						   var current_tab_Id_ = $(this).attr('tab_id');
						   var cost_of_item_a = parseFloat($(this).val().replace(/,/g, ''));

						   
						     if (jQuery.trim(cost_of_item_a) == 'NaN') {
										// empty cost of item
								     	 error_func('Error Please Enter cost! ');
										 $("div#"+divId+" .persentTage").css('border','2px groove red');
									 document.getElementById(current_tab_Id_).click();	
									      var x = 0;
								     var close_confirm = setInterval(function(){ 
									        $("div#confirm_selling_item_items").dialog('close');  
											if(x = 15){clearInterval(close_confirm);}
											x++
									}, 500);
									 return false;
							 }else{
									//check if the item is exists
								     cost_of_item.push(cost_of_item_a);
								}
						  
						 });
				 
					 	   //  loop number of items  
						
						 $("input#Number_of_Item").each(function (){ 
						 
						   var divId = $(this).attr('div_id'); 
						   var current_tab_Id_ = $(this).attr('tab_id');
						  
						     if (jQuery.trim($(this).val()) == '') {
								
										// empty number of item
									error_func('Error Please Enter liters ! ');
									$(this).css('border','2px groove red');
									       document.getElementById(current_tab_Id_).click();	
										      var x = 0;
								     var close_confirm = setInterval(function(){ 
									        $("div#confirm_selling_item_items").dialog('close');  
											if(x = 15){clearInterval(close_confirm);}
											x++
									}, 500);
                                       return false;	
									 
							 }else{
									//check if the item is exists
								     Number_of_Item.push(parseFloat($(this).val()));
								}
						  
						 });
				 
				   //  loop price of items  
						
						 $("input#product_price").each(function (){ 
						 
						   var divId = $(this).attr('div_id'); 
						   var current_tab_Id_ = $(this).attr('tab_id');
						   
						   
						     if (jQuery.trim($(this).val()) == '' && mod !='edit'){
										// empty number of item
									error_func('Error Please Enter the price ! ');
									 $("div#"+divId+" input#product_price").css('border','2px groove red');
									     var x = 0;
								     var close_confirm = setInterval(function(){ 
									        $("div#confirm_selling_item_items").dialog('close');  
											if(x = 15){clearInterval(close_confirm);}
											x++
									}, 500);
									 document.getElementById(current_tab_Id_).click();	
									  return false;
							 }else{
									//check if the item is exists
								     Wholesale_price.push(parseFloat($(this).val()));
								}
						  
						 });
				 
 
							 
					// confirmation pox 
 
	             var confirmation_table_items = '<table id="confima_table"   cellpadding="0" cellspacing="0" border="0" class="display" width="100%">   <thead>    <tr> <th> Item Name </th> <th> Quantity </th> <th> Total Cost </th> '+condFunction(mod =='edit','','<th> Price </th>')+' </tr> </thead> <tbody>'; 
		       dataSize = itemId.length;
			   for(x=0;x<dataSize;x++){ 
				//  error_func2(balance_sel[x]);
				 confirmation_table_items +=   '<tr> <td>'+item_name[x]+'</td><td class="int_no">'+CommaFormattedN(Number_of_Item[x])+'   </td> <td class="int_no">'+CommaFormattedN(cost_of_item[x])+'</td>'+condFunction(mod =='edit','','<td>'+CommaFormattedN(Wholesale_price[x])+'</td>')+'</tr>';
				 }
				 
				 confirmation_table_items  +='</tbody></table>';

               $("#confirm_selling_item_items").html(confirmation_table_items).dialog({  show: "blind", hide: "explode", width: 'auto', position:'top', height:'auto',  modal: true, buttons:  {
						"Agree": function() {
						   // agreed 
				 
					
				if(mod !='edit'){  // receive items 
				     
				             loading_func(); // SHOW LOADING IMAGE DIALOG
						$.post('php_f/add_new_item.php', {item_name:item_name, Number_of_Item:Number_of_Item, cost_of_item:cost_of_item, Wholesale_price:Wholesale_price}, function(feedback_data) {					
							$('span#ui-id-26').html('loading ...'); 
							 
							if(feedback_data == 01 ){ 
						        $("div#confirm_selling_item_items").dialog('close');  
								 Load_Items();
								 if($("#loading").closest('.ui-dialog').is(':visible')) { 
									$('#add_new_item_div').dialog("close");
										  $("#loading").dialog('close');
										  $('#showBeds_div').dialog("close");
										  success_func('<strong>Successfull</strong>'); 
									 } 
								 
							 }else{
							  $("#loading").dialog('close'); 
							  error_func(feedback_data);
							}
							
						});
								
				}else{
				 // edit 
				              loading_func(); // SHOW LOADING IMAGE DIALOG
						$.post('php_f/editReceivedItem.php', {receivdId:receivdId,Number_of_Item:Number_of_Item, cost_of_item:cost_of_item}, function(feedback_data) {					
								$('span#ui-id-26').html('loading ...'); 
							if(feedback_data == 01 ){ 
						        $("div#confirm_selling_item_items").dialog('close');  
								 Load_Items();
								 if($("#loading").closest('.ui-dialog').is(':visible')) { 
									$('#add_new_item_div').dialog("close");
										  $("#loading").dialog('close');
										  $('#showBeds_div').dialog("close");
										  success_func('<strong>Successfull</strong>'); 
									 } 
								 
							 }else{
							  $("#loading").dialog('close'); 
							  error_func(feedback_data);
							}
							
						});
						
				 
				}
								// submit The form
                 
						},
							
						"Cancel": function() {
								
								$(this).dialog("close");
							}
						},
			   
				 });	 
			    				
				   // apply dataTable to confirmation box
                  $("#confirm_selling_item_items table").dataTable({
							 "sPaginationType":"full_numbers",
							  "bJQueryUI":true
						 });
					 $('div [aria-describedby="confirm_selling_item_items"] div:first span').text('Confirmation'); 	 
							},
							
						"Cancel": function() {
								
								$(this).dialog("close");
							}
						},
			   
				 });
				 
				 
	 $('div [aria-describedby="add_new_item_div"] div:first span').html(condFunction(mod =='edit','Editing Received ('+$("li#itemNamesSelect select").find("option:selected").val()+' )',condFunction(mod =='to','Receiving ('+$("li#itemNamesSelect select").find("option:selected").val()+' )','Receiving Items'))); 	


	return false;
}

 
 
 
 
// end of items
 
 
 

  // more Details of user
  
  function initable(){
 
  $('div#moreDetails_table_user table').attr({
    cellpadding:'0',
	cellspacing:'0',
	border:'0',
	class:'display',
    width:'100%' 
  });

 	   $('div#moreDetails_table_user table').dataTable({
							"sPaginationType":"full_numbers",
							"bJQueryUI":true
							}); 

			 $('div#moreDetails_table_user div.dataTables_wrapper:last').find('div.dataTables_filter').remove();				
		 	 $('div#moreDetails_table_user div.dataTables_wrapper:last').find('div.dataTables_length').html('<label>Totals</label>');				
		 			
			$("#allDay_for_user select,#allMonths_for_user select").find('option').attr('class','opt');
            $("#allDay_for_user select,#allMonths_for_user select").chosen();		

return false;							
}
 
 
 
 
 
 
function moreDetails_of_customer(allDetails,username){
  
 // show dialog of the main div
  $("#moreDetails_for_users").dialog({  position:[100,0], show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
						"Okay": function() {
							$(this).dialog("close");
		}}, });
		
 
     // apply the current item name to the header 
      $('div [aria-describedby="moreDetails_for_users"] div:first span').html(username);
 
 

 //alert(allDetails);    moreDetails_for_users
  $('#allMonths_for_user').text('').html(allDetails);  
   var lastMonth =  $('#allMonths_for_user select').find('option:selected'); 
   var all_details_for_last_month =  lastMonth.attr('all_customers_in_month'); 

   var all_days =  "<b>Day: </b><select class='all_days_for_user' style='width:200px;'>  <option  class='opt' >all</option>  "+lastMonth.attr('all_days')+"</select>";
  $('#allDay_for_user').html(all_days);  
   
    var lastDay =  $('#allDay_for_user select').find('option:selected'); 
    var all_details_for_last_day =  lastDay.attr('contents_of_day'); 
    
	 $('#moreDetails_table_user').fadeOut().html(all_details_for_last_day).fadeIn(); 
 
      initable();
 
 
 
 // when the days of last month changed 
  $('#allDay_for_user select').change(function (){
  	var selected_value_ = $(this).val();
	if( selected_value_ == 'all' ){
	     var all_details_for_selected_day =  all_details_for_last_month; 
	   	 $('#moreDetails_table_user table').remove();
		 $('#moreDetails_table_user').fadeOut().html(all_details_for_selected_day).fadeIn(); 
			initable(); 
			applyButtons();
	}else{
		 var selectedDay =  $(this).find('option:selected'); 
		 var all_details_for_selected_day =  selectedDay.attr('contents_of_day');  
		 $('#moreDetails_table_user table').remove();
		 $('#moreDetails_table_user').fadeOut().html(all_details_for_selected_day).fadeIn(); 
			initable(); 
			applyButtons();
	}


  
  });
 
 
 
 // when month changes 
  $('#allMonths_for_user select').change(function (){
      var selected_Month =  $(this).find('option:selected'); 
	  var all_details_for_selected_month =  selected_Month.attr('all_customers_in_month'); 
      var all_days_selected_month =  "<b>Day: </b><select class='all_days_for_user' style='width:200px;'>  <option  class='opt' >all</option>  "+selected_Month.attr('all_days')+"</select>";

      $('#allDay_for_user').html(all_days_selected_month);  
	    $('#allDay_for_user select option:selected').removeAttr('selected');  
	    $('#moreDetails_table_user table').remove();
      $('#moreDetails_table_user').fadeOut().html(all_details_for_selected_month).fadeIn(); 
	      initable();
 
  applyButtons();
	// when the day changes after insertion    
    $('#allDay_for_user select').change(function (){
	var selected_value = $(this).val();
	 
	if( selected_value == 'all' ){
	 
	   var  all_details_for_selected_day_ =  all_details_for_selected_month; 
		  $('#moreDetails_table_user table').remove();
	      $('#moreDetails_table_user').fadeOut().html(all_details_for_selected_day_).fadeIn(); 
          initable();
		  applyButtons();
	}else{
	   var selectedDay_ =  $('#allDay_for_user select').find('option:selected'); 
	   var all_details_for_selected_day_ =  selectedDay_.attr('contents_of_day'); 
			 $('#moreDetails_table_user table').remove();
			 $('#moreDetails_table_user').fadeOut().html(all_details_for_selected_day_).fadeIn(); 
			 initable();
 applyButtons();
	}
  
  });
 
 
  }); 
 
 
  applyButtons();
 
 
 return false;
}
 

 
// edit user
function editUserDetails(user_id,username,fulName,mobileNumber,responsibilty){
 
// set currents      
 $('#edit_fulname').val(fulName);
 $('#edit_username').val(username);
 $('#edit_mobile').val(mobileNumber);
 $('#edit_password,#edit_confi_password').val('');
 $("li#userResponsibility").html("<label>Responsibility: </label>  <select><option class='opt' >choose..</option><option class='opt' >Expenses</option><option class='opt' >Sales</option>  <option class='opt' >Expenses,Sales</option> </select>");
      
	  $("li#userResponsibility select option").each(function (){
			 var valueNow = $(this).val();
			  if (jQuery.trim(valueNow) == jQuery.trim(responsibilty)){
			   $(this).attr("selected","selected");
			    $("li#userResponsibility select option:last").html('Both');
			    $("li#userResponsibility select").chosen();
				return false;
			  } 
 
			 });
			 
    $('#enableChangePass').prop('checked', false); 
    $('#edit_password,#edit_confi_password').val('').attr('disabled','disabled');
  $('div#edit_user').attr('style',' height:300px !important;  width:400px !important; ');
	   $('#edit_user').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Ok": function() {
							 // change  the current Item 
                               var edit__fulname   =  $('#edit_fulname').val();
							   var edit__mobile	   =  $('#edit_mobile').val();
							   var edit__username  =  $('#edit_username').val();
							   var edit__new_pass  =  $('#edit_password').val();
							   var edit_middle =  $('#edit_password').attr('m');
							   var edit__confirm_new_pass  =  $('#edit_confi_password').val();
							   var responsibilty =  $("li#userResponsibility select").val();
								 if(jQuery.trim(edit__fulname) == ''){
								 error_func('Error Please enter the Name!');	
								 }else if(!validate_number_value(edit__mobile) && jQuery.trim(edit__mobile) != '' ){
								   error_func('Error invalid mobile number !');	
								 }else if(jQuery.trim(edit__username) == ''){
								  error_func('Error Please enter the UserName!');	
								 }else if(jQuery.trim(edit__new_pass) != jQuery.trim(edit__confirm_new_pass)){
								  error_func('Error  password do not match!');
								 }else if(responsibilty ==  'choose..' ){  
								  error_func('Error please select user Responsibility !');
								 }else{
								 
								 
								 edit__new_pass =  edit_middle+''+edit__new_pass; 
								 
 
							  loading_func(); // SHOW LOADING IMAGE DIALOG
							$.post('php_f/edit_userDetail.php', {responsibilty:responsibilty,user_id:user_id,edit__fulname:edit__fulname,edit__mobile:edit__mobile,edit__username:edit__username,edit__new_pass:edit__new_pass}, function(feedback_edit_user) {					
								
								if(feedback_edit_user == 2){ 
						 
								     Load_Items();
								  	if($("#loading").closest('.ui-dialog').is(':visible')) { 
								         $("#edit_user").dialog('close'); 
								          $("#loading").dialog('close'); 
										  success_func('<strong>Successfull</strong>'); 
									 } 
						 
						 
						 
						 
								 }else{
								  $("#loading").dialog('close'); 
								  error_func(feedback_edit_user);
								}
								
							});
							 
								 }
							
							 
							 
						 },
							
						"Cancel": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
        $('div [aria-describedby="edit_user"] div:first span').html('Editing <strong>'+username+'</strong>'); 
 
return false;
}

// delete user 
function deleteUserDetails(user_id,username){
 
	   $('#warning').html('<img src="css/warning.png" alt="warning" style="border-radius:2.5em; width:80px; height:40px; margin-right: 4px; "/>Are you Sure you want to delete <strong>'+username+'</strong>?').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Yes": function() {
							 // submit the ans-ware
							  $(this).dialog("close");
							  loading_func(); // SHOW LOADING IMAGE DIALOG  
							$.post('php_f/delete_user.php', {user_id:user_id}, function(feedback_deleted_user) {					
								
								if(feedback_deleted_user == 3){ 
								 
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
							
							
		    $('div [aria-describedby="warning"] div:first span').html('Deleting <strong>'+username+'</strong>'); 
 
return false;
}
 
function enableOrDisable(userid,username,status){
 
	   $('#warning').html('<img src="css/warning.png" alt="warning" style="border-radius:2.5em; width:80px; height:40px; margin-right: 4px; "/> '+condFunction( status == '0','Are you sure you whant to Enable  <strong>'+username+' </strong> ? ','Are you sure you whant to Disable <strong>'+username+' </strong> ? ')).dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Yes": function() {
							 // submit the ans-ware
							  $(this).dialog("close");
							  loading_func(); // SHOW LOADING IMAGE DIALOG  
							$.post('php_f/enableOrDisable.php', {userid:userid,status:status}, function(feedback_deleted_user) {					
								
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
							
							
		    $('div [aria-describedby="warning"] div:first span').html(condFunction( status == '0','Enabling ('+username+')','Disabling ('+username+')')); 
 
return false;
}
 
$('document').ready(function(){
 
 

 
$('button#add_new_user').button(
	  {
	    height:'7px',
		icons: {primary: 'ui-icon-circle-plus', secondary: null}
	  }).css('font-size','11px');
	  
$('a#logout_button').button({height:'7px'}).css('font-size','13px');
$('a#logout_button').click(function(){
     
 
	 $('#warning').html('<img src="css/warning.png" alt="warning" style="border-radius:2.5em; width:80px; height:40px; margin-right: 4px; "/>Are you Sure you want to LogOut ?').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Yes": function() {
						 	 
	 // send logout
        loading_func(); // SHOW LOADING IMAGE DIALOG  
	 $.post('php_f/logout.php', function(logged_out) {					
								
								if(logged_out == 111){ 
								location.reload();
								 }else{
								  $("#loading").dialog('close'); 
								  error_func(logged_out);
								}
								
							});
		
							 
						 },
							
						"No": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
							
							
		    $('div [aria-describedby="warning"] div:first span').html('Logging Out'); 
  
	 
 
return false;
})
	  
	  
	  
	$('button#add_new_user').click(function(){
	   // reset 
	  $('#add_fulname,#add_mobile,#add_username,#add_password,#add_confi_password').val('');
	  $("li#userResponsibility2").html("<label>Responsibility: </label>  <select><option class='opt' >choose..</option><option class='opt' >Expenses</option><option class='opt' >Sales</option>  <option class='opt' >Both</option> </select>"); 
       $("li#userResponsibility2 select").chosen();
	   $("li#userResponsibility2 input[type='text']").remove();
	  $('div#add_user').attr('style',' height:300px !important;  width:400px !important; ');
	  $('#add_user').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Ok": function() {
							 // change  the current Item 
							  	 
                               var add__fulname   =  $('#add_fulname').val();
							   var add__mobile	   =  $('#add_mobile').val();
							   var add__username  =  $('#add_username').val();
							   var add__new_pass  =  $('#add_password').val();
							  var add_middle =  $('#add_password').attr('m');
							   var add__confirm_new_pass  =  $('#add_confi_password').val();
							   var responsibilty =  $("li#userResponsibility2 select").val();
							   
							   
							   
								 if(jQuery.trim(add__fulname) == ''){
								 error_func('Error Please enter the Name!');	
								 }else if(!validate_number_value(add__mobile) && jQuery.trim(add__mobile) != '' ){
								   error_func('Error invalid mobile number !');	
								 }else if(jQuery.trim(add__username) == ''){
								  error_func('Error Please enter the UserName!');	
								 }else if(jQuery.trim(add__new_pass) == ''){
								  error_func('Error  password can\'t be Empty!');
								 }else if(add__new_pass != add__confirm_new_pass){  
								  error_func('Error  password do not match!');
								 }else if(responsibilty ==  'choose..' ){  
								  error_func('Error please select user Responsibility !');
								 }else{
								 
								 add__new_pass = add_middle+''+add__new_pass;
								   //$(this).dialog("close");
							  loading_func(); // SHOW LOADING IMAGE DIALOG
							$.post('php_f/add_new_user.php', {responsibilty:responsibilty,add__fulname:add__fulname,add__mobile:add__mobile,add__username:add__username,add__new_pass:add__new_pass}, function(feedback_add_user) {					
								
								if(feedback_add_user == 1){ 
							 
						 	       Load_Items();
								  	if($("#loading").closest('.ui-dialog').is(':visible')) { 
								         $("#add_user").dialog('close'); 
								          $("#loading").dialog('close'); 
										  success_func('<strong>Successfull</strong>'); 
									 }
									 
								 }else{
								  $("#loading").dialog('close'); 
								  error_func(feedback_add_user);
								}
								
							});
							 
								 }
							
							 
							 
						 },
							
						"Cancel": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
        $('div [aria-describedby="add_user"] div:first span').text('Adding New User '); 
 
	
	
	});  
});

	

function moreDetails_of_monthculc(allDetails_1,date){
 //moreDetails_of_date_customers
  // show more Details dialog div 
  $("#moreDetails_of_date_customers").html(allDetails_1).dialog({   position:'top',show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
						"Close": function() {
							$(this).dialog("close");
		}}, });
		
		 
  $('div#moreDetails_of_date_customers table').attr({
    cellpadding:'0',
	cellspacing:'0',
	border:'0',
	class:'display',
    width:'100%' 
  });

	
	   $('div#moreDetails_of_date_customers table').dataTable({
							"sPaginationType":"full_numbers",
							"bJQueryUI":true
							}); 

      // apply the current item name to the header 
      $('div [aria-describedby="moreDetails_of_date_customers"] div:first span').html("All Details for <strong>("+date+")</strong>");
 
 
return false;
}	


 // change Admin Email 
 
 function changeEmail(email){
   $('#change_Email input,div#change_Email li.choisesInvoice,div#change_Email br').remove();
     $('#change_Email li label').text("Email").after('<input type="email" style=" width: 376;" id="emailChange" >');
  
  
    $('#change_Email li').after('<li class="choisesInvoice"> <label> <input type="checkbox">  change Password </label> </li> <br/ ><br/> <li class="choisesInvoice" id="pass2"> <label>Password:</label> <input type="password" id="passord"    style=" width: 376;"  >  </li>            <li class="choisesInvoice" id="pass1" > <label>Confirm Password:</label> <input type="password" id="passord2"    style=" width: 376;"  >  </li>  <br><br><br> <li class="worning2 choisesInvoice"> Note: The Email must be gmail account !</li>');
 
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
				 
							 $.post('php_f/change_email.php', {password_:password_,newEmail:newEmail}, function(emailResult) {					
										if(emailResult == 1){ 
										      Load_Items();
											 if($("#loading").closest('.ui-dialog').is(':visible')) { 
												  $('#loading').dialog("close");
												  $("#change_Email").dialog('close');
												  success_func('<strong>Successfull</strong>'); 
											   } 
								 
									   }else{
									    $("#loading").dialog('close'); 
										 error_func(emailResult);
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
				 
							 $.post('php_f/change_username.php', {newUsername:newUsername}, function(changed_username_feedback) {					
										if(changed_username_feedback == 211){ 
									    	usersToggle = '211';
										   Load_Items();
									   }else{
									    $("#loading").dialog('close'); 
										 error_func(changed_username_feedback);
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

							 $.post('php_f/change_password.php', {change_pass_new:change_pass_new,change_pass_current:change_pass_current}, function(changed_password_feedback) {					
										if(changed_password_feedback == 311){ 
										$('#change_pass li input').val('');
									    	usersToggle = '311';
										   Load_Items();
									   }else{
									    $("#loading").dialog('close'); 
										 error_func(changed_password_feedback);
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
								 }else if(!validate_number_value(newMobileNumber)){
								  error_func('Error Enter Invalid Mobile Number!');
								 }else{
									  loading_func(); // SHOW LOADING IMAGE DIALOG  
				 
							 $.post('php_f/change_mobile.php', {newMobileNumber:newMobileNumber}, function(changed_mobile_feedback) {					
										if(changed_mobile_feedback == 411){ 
									    	usersToggle = '411';
										   Load_Items();
									   }else{
									    $("#loading").dialog('close'); 
										 error_func(changed_mobile_feedback);
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
							 $.post('php_f/change_theme.php', {chosen_theme:chosen_theme}, function(changed_theme_feedback) {					
										if(changed_theme_feedback == 511){ 
									    	usersToggle = '511';
										   Load_Items();
									   }else{
									    $("#loading").dialog('close'); 
										 error_func(changed_theme_feedback);
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
    $('#changeStoreName label').text('Store Name:');

$('#changeStoreName').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Change": function() {
				 
				 
				 	          var storeName = $('#chageStoreName').val();
								 if(jQuery.trim(storeName) == ''){
								  error_func('Error Enter Store Name !');
								  $('#chageStoreName').css('border','2px groove red')
								 }else{
									  loading_func(); // SHOW LOADING IMAGE DIALOG  
				 
							 $.post('php_f/change_storeName.php', {storeName:storeName}, function(storeResult) {					
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
 
   $('div [aria-describedby="changeStoreName"] div:first span').html(' changing Store Name.. '); 
 
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
								  error_func('Error Enter Store Name !');
								  $('#chageStoreName').css('border','2px groove red')
								 }else{
									  loading_func(); // SHOW LOADING IMAGE DIALOG  
				 
							 $.post('php_f/change_location.php', {storeName:storeName}, function(storeResult) {					
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
 
   $('div [aria-describedby="changeStoreName"] div:first span').html(' changing Store Location '); 
 
 return false;
 }
 
 
 


































