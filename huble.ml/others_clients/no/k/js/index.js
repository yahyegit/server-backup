var cash_in =  0;
var cash_out = 0;
var dol_in  = 0;
var dol_out = 0;



// comma formart
 function idformatnumber(id){
     var x = $('#'+id+'').text();
    $('#'+id).text(x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
}






// edit customer

					function edit_function2(){

 $('#description2').val('');
 
					$('#edit_div').dialog({ position:'top',buttons:{'Okay': function (){












						 	var edit_ful_name		=  $('#ful_name').val();



							var edit_cash_in		=  validatePhone($('#cash_in').val());



							var edit_cash_out		=  validatePhone($('#cash_out').val());



							



							var edit_dol_in			=  validatePhone($('#dol_in').val());



							var edit_dol_out		=  validatePhone($('#dol_out').val());



							



							var edit_number			=  $('#edit_number').val();

							var description	=  $('#description2').val();

							var id_or_passport_edit	=  $('#id_or_passport_edit').val();



						


 



											



											// is okay do you jop



											$('#edit_div').dialog('close');



				 $('#changing').dialog({ position:'top',buttons:{}, closeOnEscape: true, draggable: false, resizable: false, modal: true, show:'fadeIn' });


 
	 $.post('edit.php',{id_or_passport_edit:id_or_passport_edit, description:description,id_edit:id_edit, edit_ful_name:edit_ful_name, edit_cash_in:edit_cash_in, edit_cash_out:edit_cash_out, edit_dol_in:edit_dol_in, edit_dol_out:edit_dol_out, cash_in:cash_in, cash_out:cash_out, dol_in:dol_in, dol_out:dol_out, edit_number:edit_number }, function (edited) {


 

													if (edited == 1){



 												 

		

														 $('#changing').dialog('close'); 
															var searc = (jQuery.trim(edit_number) !='' )?edit_number:edit_ful_name; 
													     $('#search').val(searc); 	
														  $('#home').click();

															search();


// respond feedback
$('#feedback').attr('title','updated').html('<img src="success.gif" style="border-radius:6em">'+edit_ful_name +' has been updated!').dialog({ position:'top',buttons:{'Okay': function (){					



		   $(this).dialog('close');	



		}}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'fadeIn' });	

// end of respond feedback

				



													}else{



													 $('#changing').dialog('close'); 	



													$('#error2').html(edited).fadeIn();	



													edit_function2();



													}


 




												});



  


// dia

 },'cancel': function (){
  $(this).dialog('close');	
 }}, closeOnEscape: true, draggable: false, resizable: false, width: 'auto', modal: true, show:'fadeIn'  });


 
	 
}



// edit cutomer 
 
$(document).delegate(".edit","click", function (){
			


					 id_edit		=  $(this).attr('id');



					var name		=  $(this).attr('name');



					  cash_in 	=  parseInt($(this).attr('cash_in'));



					 cash_out 	=  parseInt($(this).attr('cash_out'));



					var blance 		=  $(this).attr('blance');



					



					  dol_in 		=  parseInt($(this).attr('doller_in'));

// 777

					 dol_out 	=  parseInt($(this).attr('doller_out'));



					var dol_blance  =  $(this).attr('doller_blance');



					



					var number =  $(this).attr('number');
 

					



					



						// reset the update fields



					$('#cash_in, #cash_out,#dol_in,#dol_out').val('0');					



					$('#error2').text('').hide();



					$('#ful_name').val(name);	



					$('#edi_blan').text(blance);



					$('#dol_blance').text(dol_blance);


 
					$('#edit_number').val(number);
					$('#id_or_passport_edit').val($(this).attr('passsport'));	


					

					// 4455

					calculationFunction()

					







					// show edit div dialog



					edit_function2();


  	 


				});

 


function numberValidator(a) {


 


    var filter = /^[0-9 ]+$/;



	



    if (filter.test(a)) {



        return a;



    }



    else { 



        return 0;



    }



}






//number validator 



function validatePhone(a) {

 
if(jQuery.trim(a) == ''){
return 0;
}


    var filter = /^[0-9 ]+$/;



	



    if (filter.test(a)) {



        return a;



    }



    else { 



        return false;



    }



}











//phone validator 



function validatePhon(txtPhone) {







    var z = document.getElementById(txtPhone).value;
if(jQuery.trim(z) == ''){
return 0;
}



    var filterz = /^[0-9 +-]+$/;



	



    if (filterz.test(z)) {



        return true;



    }



    else {



        return false;



    }



}






// calculation 

 


function calculationFunction(){
		
$('div#new_exp_div input,div#add_div input').val(''); 

						// auto calculate cash blance  by using cash out 



						$('#new_cash_out').keyup(function (){

 	


 

										var new_cash_out_ = numberValidator(parseInt($(this).val()));



										var cash_in_new_val_ = numberValidator((parseInt($('#new_cash_in').val())));



										 



									 



										var current_cash_blance_add = cash_in_new_val_ - new_cash_out_;



							  $('#show_blnc_new').text(current_cash_blance_add);idformatnumber('show_blnc_new');



									 								 

 



							



							});



						



								



						// auto calculate cash blance by using cash in 



						$('#new_cash_in').keyup(function (){



								


 

									 


										var  cash_in_new_val_2 =  numberValidator(parseInt($(this).val()));



						var	 new_cash_out_2 = numberValidator(parseInt($('#new_cash_out').val()));



										



									 



										var current_cash_blance_add2 = cash_in_new_val_2 - new_cash_out_2;



										 $('#show_blnc_new').text(current_cash_blance_add2);idformatnumber('show_blnc_new');



									 								 

 



							});



								



					



							// auto calculate doller blance  by using doller in 



						$('#new_d_in').keyup(function (){



							



							 


							



							


 

										var new_dol_in_ =  numberValidator(parseInt($(this).val()));



										var dol_out_new_val_ = numberValidator(parseInt($('#new_d_out').val()));



										



									 



										var current_dol_blance_add = new_dol_in_ - dol_out_new_val_;



										 $('#show_d_new').text(current_dol_blance_add);

idformatnumber('show_d_new');

									 								 

 
									



							});



					



						



						// auto calculate doller blance  by using doller out 



						$('#new_d_out').keyup(function (){



							 



							

 


											var new_dol_out_ = numberValidator(parseInt($(this).val()));



											var dol_in_new_val_ = numberValidator(parseInt($('#new_d_in').val()));



				 					 



											var current_dol_blance_add2 = dol_in_new_val_ - new_dol_out_;



											 $('#show_d_new').text(current_dol_blance_add2);

idformatnumber('show_d_new');

																		 

 


							});



						



						



						





						// auto calculate cash blance  by using cash in



						$('#cashin_exp').keyup(function (){



							



							 



										

 


										var xp_cash_in_new_val_ =  numberValidator(parseInt($(this).val()));



										var xp_cash_out_ = numberValidator(parseInt($('#cashout_exp').val()));



										 



									 



										var xp_current_cash_blance_add = xp_cash_in_new_val_ - xp_cash_out_;



										 $('#show_blance_cash').text(xp_current_cash_blance_add);



					idformatnumber('show_blance_cash');				 								 


 

							



							});



						



						











						// auto calculate cash blance  by using cash out



						$('#cashout_exp').keyup(function (){



							

 


										
 


										var xp_cash_out_2 =  numberValidator(parseInt($(this).val()));



										var xp_cash_in_new_val_2 = numberValidator(parseInt($('#cashin_exp').val()));



										 



									 



										var xp_current_cash_blance_add2 = xp_cash_in_new_val_2 - xp_cash_out_2;



										 $('#show_blance_cash').text(xp_current_cash_blance_add2);


	idformatnumber('show_blance_cash');	
									 								 

 

							



							});



						



							







						



						// auto calculate cash blance by using doller in 



						$('#dollin_exp').keyup(function (){



								

 



																			

					  

									 


										var  xp_dol_in_new_val_2 =  numberValidator(parseInt($(this).val()));



						   var	 xp_d_new_cash_out_2 = numberValidator(parseInt($('#dollout_exp').val()));



										 



									 



										var xpcurrent_dol_blance_add2 = xp_dol_in_new_val_2 - xp_d_new_cash_out_2;



										 $('#show_blance_doller').text(xpcurrent_dol_blance_add2);


idformatnumber('show_blance_doller');
									 								 



									 



							});



							







							// auto calculate cash blance by using doller out



						$('#dollout_exp').keyup(function (){



								
 



																			


								 


										var  xp_d_new_cash_out_2_ =  numberValidator(parseInt($(this).val()));



										var	 xp_dol_in_new_val_2_= numberValidator(parseInt($('#dollin_exp').val()));



										 



									 



										var xpcurrent_dol_blance_add2_ = xp_dol_in_new_val_2_ - xp_d_new_cash_out_2_;



										 $('#show_blance_doller').text(xpcurrent_dol_blance_add2_);


idformatnumber('show_blance_doller');
									 								 



									 



							});



								









						// auto calculate cash blance  by using cash in



						$('#cashin_expx').keyup(function (){



							



								 


										


  



										var xp_cash_in_edit_val_ =  numberValidator(parseInt($(this).val()));



										var xp_cash_out_edit = numberValidator(parseInt($('#cashout_expx').val()));



										 



									 



										var xp_current_cash_blance_edit = xp_cash_in_edit_val_ - xp_cash_out_edit;



										 $('#show_blance_cashx').text(xp_current_cash_blance_edit);



				idformatnumber('show_blance_cashx');					 								 


 
							



							});



						



						











						// auto calculate cash blance  by using cash out



						$('#cashout_expx').keyup(function (){



							


 

										



					   



										var xp_cash_out__edit_2 = numberValidator(parseInt($(this).val()));



								var xp_cash_in_edit_val_2 = numberValidator(parseInt($('#cashin_expx').val()));



										 



									 



										var xp_current_cash_blance_edit_2 = xp_cash_in_edit_val_2 - xp_cash_out__edit_2;



										 $('#show_blance_cashx').text(xp_current_cash_blance_edit_2);

idformatnumber('show_blance_cashx');

									 								 



									 


							



							});



						



							







						



						// auto calculate cash blance by using doller in 



						$('#dollin_expx').keyup(function (){



								
 



																			



								 


										var  xp_dol_in_edit_val_2 =  numberValidator(parseInt($(this).val()));



					var	 xp_d_edit_cash_out_2 = numberValidator(parseInt($('#dollout_expx').val()));



										 



									 



										var xpcurrent_dol_blance_edit_2 = xp_dol_in_edit_val_2 - xp_d_edit_cash_out_2;



										 $('#show_blance_dollerx').text(xpcurrent_dol_blance_edit_2);



						idformatnumber('show_blance_dollerx');			 								 



								 



							});



							







							// auto calculate cash blance by using doller out



						$('#dollout_expx').keyup(function (){


 



																			
                                                             


									 

										var  xp_d_edit_cash_out_2_ =  numberValidator(parseInt($(this).val()));



						 var	 xp_dol_in_edit_val_2_= numberValidator(parseInt($('#dollin_expx').val()));



										 



									 



										var xpcurrent_dol_blance_edir2_ = xp_dol_in_edit_val_2_ - xp_d_edit_cash_out_2_;



										 $('#show_blance_dollerx').text(xpcurrent_dol_blance_edir2_);


	idformatnumber('show_blance_dollerx');	
									 								 



									 



							});



								








    // auto calculate cash blance  by using cash out 



						$('#cash_out').keyup(function (){



							


 

										



									 

										var e_new_cash_out = numberValidator(parseInt($(this).val()));
 


										var e_cash_in_new_val = numberValidator(parseInt($('#cash_in').val()));



										 



									 



										var current_cash_blance = (e_cash_in_new_val + cash_in) - (e_new_cash_out + cash_out);



										 $('#edi_blan').text(current_cash_blance);idformatnumber('edi_blan');
										 

	 	

									 								 



								 



							});



						



								



						// auto calculate cash blance by using cash in 



						$('#cash_in').keyup(function (){



								



							 


																			



									 


										var e_new_cash_in =  numberValidator(parseInt($(this).val()));



										var e_cash_out_new_val = numberValidator(parseInt($('#cash_out').val()));



										



									 



										var current_cash_blance2 = (e_new_cash_in + cash_in) - (e_cash_out_new_val + cash_out);



										 $('#edi_blan').text(current_cash_blance2); idformatnumber('edi_blan');



									 								 



								 



							});



								



					



							// auto calculate doller blance  by using doller in 



						$('#dol_in').keyup(function (){



							

 


							



							



							 



										var e_new_dol_in = numberValidator(parseInt($(this).val()));



										var e_dol_out_new_val = numberValidator(parseInt($('#dol_out').val()));



										



									 



										var current_dol_blance = (e_new_dol_in + dol_in) - (e_dol_out_new_val + dol_out);



										 $('#dol_blance').text(current_dol_blance); idformatnumber('dol_blance');



									 								 



									 



							});



					



						



						// auto calculate doller blance  by using doller out 



						$('#dol_out').keyup(function (){


 


								 


											var e_new_dol_out = numberValidator(parseInt($(this).val()));



							var e_dol_in_new_val = numberValidator(parseInt($('#dol_in').val()));



				 					 



											var current_dol_blance2 = (e_dol_in_new_val + dol_in) - (e_new_dol_out + dol_out);



											 $('#dol_blance').text(current_dol_blance2);idformatnumber('dol_blance');



																		 



									 



							});

}

// end of calculation 








function backupfunc(){
 	
return false;
}








// print



function printDiv(divName) {



     var printContents = document.getElementById(divName).innerHTML;



     var originalContents = document.body.innerHTML;







     document.body.innerHTML = printContents;







     window.print();







     document.body.innerHTML = originalContents;



}







	function windowmove(){



	



		window_width = $(window).width();



		window_height = $(window).height();











		height_wrapper = $('#wrapper').height();



		height_container = $('#container').height();











		$('#wrapper').css('min-height', (window_height - 100)+'px');







	}







		$(window).resize(function (){



		windowmove();







		});



		windowmove();












$('document').ready( function () {



 $('div#edit_exp_div table').find("td:eq(2),td:eq(5)").remove();
 $('div#edit_exp_div table').find("th:eq(2),th:eq(5)").remove();

 $('div#new_exp_div table').find("td:eq(2),td:eq(5)").remove();
 $('div#new_exp_div table').find("th:eq(2),th:eq(5)").remove();
 

  $('ul#main-nav').append('<button href="#"  class="new_cast register_custom" style="margin-left: 161px;" > Register Customer</button>');
  $(".register_custom,.update_btn").button();



// show home bage when i logged in 



	$('#date_exp').datepicker();



 	$('#main_details_bage,#expence_bage, #settings_bage').hide();



	$('#home_bage').show();



 



 sidebar();



 function sidebar(){



 // 



 blace_side = 1;



 	// people of blance



	 $('#blance_sidbar').html('<img src="loading.gif" alt="loading..."/> ').fadeIn();



	 $.post('side_bar.php',{blace_side:blace_side}, function (people_blance) {



			 if(people_blance == 2){

			 location.reload();

			 }



			 $('#blance_sidbar').fadeOut().html(people_blance).fadeIn();



				 



			 }).complete( function () {



		 }).success( function () {



	});



 



 }



 



 



 



 



 



 



 



 







function main_details(name1){

backupfunc();

$('#totals').fadeOut();



 var month = name1;



 	$('#castomer_details').html('<img src="loading.gif" alt="loading..."/> ');



			



			 $.post('main_details.php',{ month: month}, function (data) {



			 if(data == 2){



			 location.reload();



			 }else{



			 $('#castomer_details').fadeOut().html(data).fadeIn();



				



		 			



			 }



				



			



			}).complete( function () {



 



					$('#castomer_details td[class="full_name"]').hover(function () {



					$(this).addClass('hover');



					}).mouseleave(function (){



					$(this).removeClass('hover');



				 });



			



				// more details of one person 



				$('#castomer_details td[class="full_name"]').click(function () {



					 id1 =  $(this).attr('id');



					id2 =  $(this).attr('id');



					 id3 =  $(this).attr('id');



					 id4 =  $(this).attr('id');



					 id5 =  $(this).attr('id');



					 



					$('#new_cast').fadeOut();



					 



					// put loading image here 



					// rows of history 



					$('#castomer_details').html('<img src="loading.gif" alt="loading..."/> ');



					$.post('history.php',{ id1: id1}, function (history) {



							$('#castomer_details').fadeOut().html(history).fadeIn();



	



							// all Totals 



							 	$('#totals').html('<img src="loading2.gif" alt="loading..."/> ').fadeIn();



								$.post('all_Total.php',{id5:id5}, function (all_totals) {



									// hide loading ..



									$('#totals').fadeOut().html(all_totals).fadeIn();



														$('#totals input').click(function () {       



																	printDiv('castomer_details');



																	});



									}).complete( function () {



									}).success( function () {



								});



									



									// delete histroy row



								  



								 $('#castomer_details td a[id="delete_histry"]').click(function () {       



										delete_histryRow = $(this).attr('delet_hist');	



										id_card          = $(this).attr('id_card');	  







										



										$('#worning_to_delete_exp').html('are you sure you want to delete').dialog({ position:'top',buttons:{'YES': function (){	



											$('#worning_to_delete_exp').dialog('close'); 



											 $('#changing').dialog({ position:'top',buttons:{}, closeOnEscape: true, draggable: false, resizable: false, modal: true, show:'fadeIn' });



											$.post('delete_histry.php',{delete_histryRow:delete_histryRow, id_card:id_card}, function (deletedhis) {



															 load_oppen_daily();



															$('#changing').dialog('close');  



															$('#Deleted').html('<img src="success.gif" style="border-radius:6em">'+deletedhis).dialog({ position:'top',buttons:{'Okay': function (){



															$(this).dialog('close');	



															}}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'fadeIn' });	



															



													



													}).complete( function () {



												}).success( function () {



											});



											







										},'NO': function (){



											$(this).dialog('close');	



										}}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'fadeIn' });	



									});



									



						



						}).complete( function () {



						}).success( function () {



					});



					



					 



					// insert months into select



					$('#choosetim').html('loading');



					$.post('date_selector.php',{id4:id4}, function (datea) {



						$('#selpos').fadeIn();



								$('#choosetim').html('<option> ALL </option>"'+datea);



						// choose month or all



								$('#choosetim').change(function (){



										var date_name = $(this).val();



										var date_name2 = $(this).val();



										



										//rows of  in one month  or all 



										$('#castomer_details').html('<img src="loading.gif" alt="loading..."/> ');



										$.post('history_detes.php',{ date_name: date_name, id2:id2}, function (datea_table) {



											$('#castomer_details').html(datea_table).fadeIn();



														



												// delete histroy row



								  



								 $('#castomer_details td a[id="delete_histry"]').click(function () {       



										delete_histryRow = $(this).attr('delet_hist');	



										id_card          = $(this).attr('id_card');	  







										



										$('#worning_to_delete_exp').html('are you sure you want to delete').dialog({ position:'top',buttons:{'YES': function (){	



											$('#worning_to_delete_exp').dialog('close'); 



											 $('#changing').dialog({ position:'top',buttons:{}, closeOnEscape: true, draggable: false, resizable: false, modal: true, show:'fadeIn' });



											$.post('delete_histry.php',{delete_histryRow:delete_histryRow, id_card:id_card}, function (deletedhis) {



															 load_oppen_daily();



															$('#changing').dialog('close');  



															$('#Deleted').html('<img src="success.gif" style="border-radius:6em">'+deletedhis).dialog({ position:'top',buttons:{'Okay': function (){



															$(this).dialog('close');	



															}}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'fadeIn' });	



															



													



													}).complete( function () {



												}).success( function () {



											});



											







										},'NO': function (){



											$(this).dialog('close');	



										}}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'fadeIn' });	



									});



	 



						



											}).complete( function () {



											}).success( function () {



										});



										



										// Totals of month or all 



										$('#totals').html('<img src="loading2.gif" alt="loading..."/> ');



										$.post('total_of_one_month.php',{ date_name2: date_name2, id3:id3}, function (datea_data) {



												$('#totals').html(datea_data).fadeIn();



																	$('#totals input').click(function () {       



																	printDiv('castomer_details');



																	});



											}).complete( function () {



											}).success( function () {



										});



										







								});







						}).complete( function () {				



						}).success( function () {



						});



					 



				});		



				

			



			// delete costom



				$('#castomer_details td a[del="del"]').click(function () {



				var magec =  $(this).attr('name');



				var id_del =  $(this).attr('id');



				$('#error3').text('').hide();



				delme();



			function delme(){ 



				$('#worning_to_delete').dialog({ position:'top',buttons:{'YES': function (){



					



						$('#worning_to_delete').dialog('close');



						 $('#changing').dialog({ position:'top',buttons:{}, closeOnEscape: true, draggable: false, resizable: false, modal: true, show:'fadeIn' });



									



					$.post('delete.php',{ id_del: id_del}, function (deleted) {



							



							



							if (deleted == '<font style="color: green;"><strong>successfull</strong></font>'){



								



									$('#error3').text('').hide();



									 



									 $('#changing').dialog('close');



									load_oppen_daily();



									$('#Deleted').html('<img src="success.gif" style="border-radius:6em"><p style="color: #fff;"><strong>'+magec+'</strong>  has been Deleted!</p>').dialog({ position:'top',buttons:{'Okay': function (){



									$(this).dialog('close');



								



									}}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'fadeIn' });



								



								}else{



								



									$('#error3').text(deleted).fadeIn();



									delme();	



								}



								



	



						}).complete( function () {



						}).success( function () {



					});



					



				},'NO': function (){



				$(this).dialog('close');



				}}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'fadeIn' });



}



								



				



				});



			}).success( function () {







			});



}		







		$('#new_exp, #new_cast').mousemove( function (e) {



					var attribute = $(this).attr('hover');



					$('#hover_div').text(attribute).show();



					$('#hover_div').css('top', e.clientY-70).css('left', e.clientX-60);



					}).mouseleave( function () {



					$('#hover_div').hide();



			})




function oppen_daily_custom_table(){
 

};


 function load_oppen_daily(){
backupfunc();


 



	$('#new_exp').fadeIn();



 	$('#selpos').hide();



	$('#new_cast').hide();



	 



	$('#totals').hide();



 



 $('#selpos3').fadeOut();



 



//$('#castomer_details').html('<img src="loading.gif" alt="loading..."/> ');



 oppen ="oppen";



  oppen1 ="oppen";



    oppen2 ="oppen";



 	 	$('#castomer_details').html('<img src="loading.gif" alt="loading..."/> ').fadeIn();



		$.post('oppendaily.php',{oppen:oppen}, function (oppen_daily) {



					



					if(oppen_daily == 2){



					 location.reload();



					}



						// all current days of table



						$('#castomer_details').fadeOut().html(oppen_daily).fadeIn();



					//all_totals_op_oppenday 
 
			   


					$('#totals').html('<img src="loading2.gif" alt="loading..."/> ').fadeIn();
 
								$.post('all_Total_of_oppen_day.php',{oppen1:oppen1}, function (all_totals_op_oppenday) {

            								$('#totals').fadeOut().html(all_totals_op_oppenday).fadeIn();

								$('div#totals tr[class="monthly"]').click(function (){   
										    $('#castomer_details td[class="day"]:first').attr('date',$(this).attr('mmmonth'));
											$('#castomer_details td[class="day"]:first').click();
										});

	
oppen_daily_custom_table();
											 



									}).complete( function () {



									}).success( function () {



								});



									



			 







						// insert months into select



						



						$('#fuck').html('loading');



						$.post('date_selector_of_oppen_day.php',{oppen2:oppen2}, function (selectmonths_oppenday) {



							$('#selpos3').fadeIn();



								$('#fuck').html('<option> ALL </option>"'+selectmonths_oppenday);



								



								// choose month or all of oppen day 



								$('#fuck').change(function (){



										var month_name = $(this).val();



										var month_nam1 = $(this).val();



										



										//rows of  in one month  or all in oppen day 



										$('#castomer_details').html('<img src="loading.gif" alt="loading..."/> ');



										



										$.post('oppenDay_history_dat.php',{ month_name: month_name}, function (data_of_that_month) {



											$('#castomer_details').html(data_of_that_month).fadeIn();
								oppen_daily_custom_table();


										// continue over there  



										deleteAndEdit();



										someothers();



											}).complete( function () {



											}).success( function () {



										});



										



										// Totals of month or all 



										$('#totals').html('<img src="loading2.gif" alt="loading..."/> ');



										$.post('total_of_one_month_oppenDay.php',{ month_nam1: month_nam1}, function (total_of_that_month) {



												$('#totals').html(total_of_that_month).fadeIn();

oppen_daily_custom_table();

 

								$('div#totals tr[class="monthly"]').click(function (){   
										    $('#castomer_details td[class="day"]:first').attr('date',$(this).attr('mmmonth'));
											$('#castomer_details td[class="day"]:first').click();
										});

																 



											}).complete( function () {



											}).success( function () {



										});



										







								});







						}).complete( function () {				



						}).success( function () {



						});



					



					deleteAndEdit();



					function deleteAndEdit(){



					



						



								// edit day 



								$('#castomer_details a[edit="edit"]').click(function () {       



										id_edit_x =  $(this).attr('id');



										var namex =  $(this).attr('name');



										var cash_inx =  $(this).attr('cash_in');



										var cash_outx =  $(this).attr('cash_out');



										var blancex =  $(this).attr('blance');



										



										var dol_inx =  $(this).attr('dolla_in');



										var dol_outx =  $(this).attr('dolla_out');



										var doll_blancex =  $(this).attr('dolla_blance');



										



					



					 



										$('#error_exp').text('').hide();



										$('#name_expx').val(namex);



										$('#cashin_expx').val(cash_inx);



										$('#cashout_expx').val(cash_outx);



										$('#show_blance_cashx').text(blancex);



										



										$('#dollin_expx').val(dol_inx);



										$('#dollout_expx').val(dol_outx);



										$('#show_blance_dollerx').text(doll_blancex);



										
 calculationFunction();




							// show edit div dialog



							edit_function3();



							function edit_function3(){



							$('#edit_exp_div').dialog({ position:'top',buttons:{'Okay': function (){



												var namex1 =  $('#name_expx').val();



												var cash_inx1 =  validatePhone($('#cashin_expx').val());



												var cash_outx1 =  validatePhone($('#cashout_expx').val());



											



												var dol_inx1 = validatePhone( $('#dollin_expx').val());



												var dol_outx1 = validatePhone( $('#dollout_expx').val());



					



							



											if (false){


 
 

											}else{



										



													 



															



													$('#edit_exp_div').dialog('close');



													$('#changing').dialog({ position:'top',buttons:{}, closeOnEscape: true, draggable: false, resizable: false, modal: true, show:'fadeIn' });



													// $('#changing').dialog(); // show dialog loading..



													$.post('edit_daily.php',{ id_edit_x:id_edit_x, namex1: namex1, cash_inx1:cash_inx1, cash_outx1:cash_outx1, dol_inx1:dol_inx1, dol_outx1:dol_outx1 }, function (editedxpn) {



													



								



															if (editedxpn == 1){



																 



																	load_oppen_daily();



																 $('#changing').dialog('close'); 			 



																$('#feedback_3').html('<img src="success.gif" style="border-radius:6em">'+namex1 +' has been changed!').dialog({ position:'top',buttons:{'Okay': function (){																



																	$(this).dialog('close');	



																	}}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'fadeIn' });	



						



															}else{



															 $('#changing').dialog('close'); 	



															$('#error_exp').html(editedxpn).fadeIn();	



															edit_function3();



															}



													



														







														}).complete( function () {



													



														}).success( function () {



													});



										



													



													



													}











							



						},'cancel': function (){



						



																$('#show_blance_cashx').text('0');



																 $('#show_blance_dollerx').text('0');



																$('#name_expx,#cashin_expx, #cashout_expx,#dollin_expx,#dollout_expx').val('');



																$('#error_exp').text('').hide();



										



										$(this).dialog('close');



										



									}}, closeOnEscape: true, draggable: false, resizable: false, width: 'auto', modal: true, show:'fadeIn' });



					}



							



							



							



							



							



							



						});



				



				



		 	



									



								// delete day 



								$('#castomer_details a[delete="delet"]').click(function () {



			



								var date_del =  $(this).attr('date');



								var id_to_del =  $(this).attr('id');



								$('#error12').text('').hide();



								delete_1();



				



				function delete_1(){ 



			



				$('#worning_to_delete_exp').html('are sure you want to Delete '+date_del).dialog({ position:'top',buttons:{'YES': function (){



					



						$('#worning_to_delete_exp').dialog('close');



						 $('#changing').dialog({ position:'top',buttons:{}, closeOnEscape: true, draggable: false, resizable: false, modal: true, show:'fadeIn' });



									



					$.post('delete_exp.php',{date_del:date_del}, function (deleted_exp) {



							



							



							if (deleted_exp == 1){



								



									$('#error12').text('').hide();



									 // Deleted



									 $('#changing').dialog('close');



									load_oppen_daily();



									$('#Deleted').html('<img src="success.gif" style="border-radius:6em"><p style="color: #fff;"> <strong>'+date_del+'</strong>  has been Deleted!</p>').dialog({ position:'top',buttons:{'Okay': function (){



									$(this).dialog('close');



									



									}}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'fadeIn' });



								



								}else if (deleted_exp == 3){



								$('#error12').text('').hide();



									 



								 $('#changing').dialog('close');



								//error



								$('#error_del').html('<p style="color: red;">Error Deleting  <strong>'+date_del+'</strong> !</p>').dialog({ position:'top',buttons:{'Okay': function (){



									$(this).dialog('close');



									



								}}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'bounce' });



								



								}else{



								



									$('#worning_to_delete_exp').html(deleted_exp).fadeIn();



									delete_1();	



								}



								



	



						}).complete( function () {



						}).success( function () {



					});



					



				},'NO': function (){



				$(this).dialog('close');



				}}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'fadeIn' });



}



					



				



				});



						}



					



					someothers();



						function someothers(){



						



								// oppen day name hover



								 $('#castomer_details td[class="day"]').hover(function () {



											$(this).addClass('hover');



											}).mouseleave(function (){



											$(this).removeClass('hover');



										 });



																				



								// update histry  of one day 



								$('#castomer_details td[class="day"]').click(function (){



									$('#selpos3').fadeOut();
 
								     date1 =  $(this).attr('date');
								 
 


									$('#new_exp').hide();



									$('#new_cast').fadeIn();



										// go to The histry and find the updates of this date 



										$('#castomer_details').html('<img src="loading.gif" alt="loading..."/> ').fadeIn();



										$.post('findUpdates.php',{date1:date1}, function (updateofthatday) {



										$('#selpos3').fadeOut();



									    	$('#castomer_details').fadeOut().html(updateofthatday).fadeIn();



						  



						   



														// updates  name hover



														$('#castomer_details td[class="namehisy"]').hover(function () {



														$(this).addClass('hover');



														}).mouseleave(function (){



														$(this).removeClass('hover');



														});



												



					



															// click to see the current custom



															$('#castomer_details td[class="namehisy"]').click(function () {



																$('#new_cast').hide();



																 



																id_of_name = $(this).attr('myid');



																 main_details(id_of_name);



												



															});



														



															



														// delete one histroy row



														$('#castomer_details td a[id="delete_histry"]').click(function () {       



													delete_histryRow = $(this).attr('delet_hist');	



													id_card          = $(this).attr('id_crd');	  



				 



													$('#worning_to_delete_exp').html('are you sure you want to delete').dialog({ position:'top',buttons:{'YES': function (){	



														$('#worning_to_delete_exp').dialog('close'); 



														 $('#changing').dialog({ position:'top',buttons:{}, closeOnEscape: true, draggable: false, resizable: false, modal: true, show:'fadeIn' });



													



													$.post('delete_histry.php',{delete_histryRow:delete_histryRow, id_card:id_card}, function (deletedhis) {



																		 load_oppen_daily();



																		$('#changing').dialog('close');  



																		$('#Deleted').html('<img src="success.gif" style="border-radius:6em">'+deletedhis).dialog({ position:'top',buttons:{'Okay': function (){



																		$(this).dialog('close');	



																		}}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'fadeIn' });	



																		



																



																}).complete( function () {



															}).success( function () {



														});



														







													},'NO': function (){



														$(this).dialog('close');	



													}}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'fadeIn' });	



												});



									



														



														



											



										}).complete( function () {



										}).success( function () {



									});



									



									//	Total of that day  



										$('#totals').html('<img src="loading2.gif" alt="loading..."/> ').fadeIn();



										$.post('total.php',{ date1: date1}, function (onee) {



											$('#totals').html(onee).fadeIn();
  

											}).complete( function () {



											}).success( function () {



										});



						  



									



									



									



									



									



									



								});		



								



								}					



								



								



				



				}).complete( function () {



			}).success( function () {



		});



 }











 



 



// toggle navigatoin bar style 



$('#main-nav li').click( function () {

backupfunc();

	$('#main-nav li').removeClass('current');



	$(this).addClass('current');



});







// home



$('#home').click( function () {



		
backupfunc();


	$('#main_details_bage, #settings_bage').hide();



	$('#home_bage').show();



	$('#search_resalt').fadeOut();



	$('#blance_sidbar').fadeOut();



	$('#selpos2,#totals2').fadeOut();



	sidebar();



});







// main_details 



$('#main_details').click( function () {

backupfunc();

	$('#selpos').hide();



	$('#expence_bage, #settings_bage,#home_bage').hide();



	$('#main_details_bage').show();



	$('#totals').hide();



 



	load_oppen_daily();



});




 // all customers tab
$('#all_customers').click( function () {
 
	$('#selpos').hide();
     // hide all other bages
	$('#expence_bage, #settings_bage,#main_details_bage').hide();
	$('#totals').hide();

     $('#search').val('% %'); search() // search all customers
	 
	 $('#home_bage').show();
});


 // Debt Customers tab
$('#debt_custmers').click( function () {
 
	$('#selpos').hide();
     // hide all other bages
	$('#expence_bage, #settings_bage,#main_details_bage').hide();
	$('#totals').hide();

     $('#search').val('debt%'); search() // search all customers
	 $('#home_bage').show();
});

 



//  New day div dialog



$('#new_exp').click( function () {



$('#name_exp').val('');



$('#error_exp2').text('').hide();



$('#cashin_exp,#cashout_exp,#dollin_exp,#dollout_exp').val('0');



 $('#show_blance_doller').text('0');



 $('#show_blance_cash').text('0');



							



calculationFunction();



							



					



add_daily();



function add_daily(){







$('#new_exp_div').dialog({ position:'top',buttons:{'okay':function (){















			var namex2 =  $('#name_exp').val();



			var cash_inx2 =  validatePhone($('#cashin_exp').val());



			var cash_outx2 =  validatePhone($('#cashout_exp').val());



									



			var dol_inx2 =  validatePhone($('#dollin_exp').val());



			var dol_outx2 =  validatePhone($('#dollout_exp').val());



			



					 



											$('#new_exp_div').dialog('close');



											$('#changing').dialog({ position:'top',buttons:{}, closeOnEscape: true, draggable: false, resizable: false, modal: true, show:'fadeIn' });



											// $('#changing').dialog(); // show dialog loading..



											$.post('add_daily.php',{ namex2: namex2, cash_inx2:cash_inx2, cash_outx2:cash_outx2, dol_inx2:dol_inx2, dol_outx2:dol_outx2 }, function (addedaily) {



											



						



													if (addedaily == 1){



						



														 $('#changing').dialog('close'); 	



															load_oppen_daily();



														 



													}else{



													 $('#changing').dialog('close'); 	



													$('#error_exp2').html(addedaily).fadeIn();	



													add_daily();



													}



											



												







												}).complete( function () {



											



												}).success( function () {



											});



								


 






},'cancel': function (){ 



	$(this).dialog('close');	



}}, closeOnEscape: true, draggable: false, resizable: false, width:'auto', modal: true, show:'fadeIn' });



}



});


























	



	



// search button click



$('#search_button').click( function () {

 

  search();

 
});







 // enter search



$('#search').keyup(function (e) {



	



	if (e.keyCode == 13){	



	 



	  search();



	}



	



	});



	



	



 // new costom div dialog



$('#new_cast,.new_cast').click( function () {



	$('#show_blnc_new,#show_d_new').text('0');



	$('#new_cash_in, #new_cash_out,#new_d_in,#new_d_out').val(0);



	$('#new_ful_name,#new_number').val('');



	$('#error').text('').hide();



	



	


 // 4499

calculationFunction();

						



						



						



						



						



addednewone();



function addednewone(){



$('#description').val('');
$('#add_div input').val('');
$('#add_div').dialog({ position:'top',buttons:{'Add': function (){



				var new_ful_name	=  $('#new_ful_name').val();

                var new_ful_name	=  $('#new_ful_name').val();

				var new_cash_in	=  validatePhone($('#new_cash_in').val());



				var new_cash_out	=  validatePhone($('#new_cash_out').val());



			 	



				var new_doll_in		=  validatePhone($('#new_d_in').val());



				var new_doll_out	=  validatePhone($('#new_d_out').val());



				



				var new_number	=  $('#new_number').val();				


			  var desctiption	= $('#description').val();
		      var id_or_passport	= $('#id_or_passport').val();
 


							  if (false){


                     }else{



									



								$('#add_div').dialog('close');



								$('#changing').dialog({ position:'top',buttons:{}, closeOnEscape: true, draggable: false, resizable: false, modal: true, show:'fadeIn' });


  	
								$.post('add.php',{id_or_passport:id_or_passport, desctiption:desctiption, new_ful_name: new_ful_name, new_cash_in:new_cash_in, new_cash_out:new_cash_out, new_doll_in:new_doll_in, new_doll_out:new_doll_out, new_number:new_number }, function (added) {



										



										



										if (added == 2){



										location.reload();



										}else if (added == 1){									



											      $('#changing').dialog('close'); 	
													     $('#search').val(new_ful_name); 	
														  $('#home').click();

															search();


// respond feedback
$('#feedback').attr('title','updated').html('<img src="success.gif" style="border-radius:6em">Account for <strong>'+new_ful_name +'</strong> has been created!').dialog({ position:'top',buttons:{'Okay': function (){					



		   $(this).dialog('close');	



		}}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'fadeIn' });	

// end of respond feedback



										}else{



											$('#error').html(added).fadeIn();	



											$('#changing').dialog('close');



											addednewone();						



										}



								



									



									



									}).complete( function () {



								



									}).success( function () {



								});



					



								



								



								}











					



				},'cancel': function (){



								  $('#show_blnc_new').text('0');



								  $('#new_ful_name,#new_cash_in, #new_cash_out,#new_number').val('');



								  	$('#error').text('').hide();



								   $(this).dialog('close');



								 }}, closeOnEscape: true, draggable: false, resizable: false, width: 'auto', modal: true, show:'fadeIn' });



	}



});



















// logout 







$('#logout').click( function () {







	$('#feedback_log').html('are you sure you whant to logOut').dialog({ position:'top',buttons:{'YES': function (){



				logout = 'logout_me';



					$('#feedback_log').dialog('close');



					$('#chacking').dialog();	//  loading image here 



					$.post('logout.php',{ logout: logout}, function () {



	



									 location.reload();



									



						}).complete( function () {



						}).success( function () {



					});



					



				},'NO': function (){



				  



				$(this).dialog('close');



				}}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'fadeIn' });







					







});







 // protection



	function protect_nice(){



		var chack_multi =   $('#protection').text();



	  $('#protection').html('<span style="color:red;font-size:11px;">waiting..</span>');



	  $.post('chack_if_username_pass.php',{ chack_multi: chack_multi }, function (_chack_if_pw) {	   



	  $('#protection').html(_chack_if_pw);







					}).complete( function () {



					}).success( function () {



	});



	}



//  check password if set 



	function chackpword(){



	  var chack_if_pw =   $('#chack_if_pw').text();



	  $('#chack_if_pw').html('<span style="color:red;font-size:11px;">waiting..</span>');



	  $.post('chack_if_username_pass.php',{ chack_if_pw: chack_if_pw }, function (_chack_if_pw) {	   



	  $('#chack_if_pw').html(_chack_if_pw);







					}).complete( function () {



					}).success( function () {



	});



	}



// chack if username if set 



	function chaifusrnmaetest(){



	 var chack_if_us =   $('#chack_if_us').text();



	 $('#chack_if_us').html('<span style="color:red;font-size:11px;">waiting..</span>');



	 $.post('chack_if_username_pass.php',{ chack_if_us: chack_if_us }, function (_chack_if_us) {



if(_chack_if_us == 2){



location.reload();



}else{



	 $('#chack_if_us').html(_chack_if_us);



}



	 







					}).complete( function () {



					}).success( function () {



	});



	}



	



	



// settings bage 



$('#settings').click( function () {



	$('#main_details_bage, #expence_bage,#home_bage').hide();



	$('#settings_bage').show();



	chaifusrnmaetest(); 



	chackpword() ;



	protect_nice(); 



	});











// protection putton 	



$('#change_prot').click( function () {



multi = 1;



		$('#changing').dialog({ position:'top',buttons:{}, closeOnEscape: true, draggable: false, resizable: false, modal: true, show:'fadeIn' });  // show changin graphic



		$.post('protection.php',{ multi: multi}, function (multiy) {	   



					



					$('#changing').dialog('close');  



					protect_nice();



					$('#feedback_3').html('<img src="success.gif" style="border-radius:6em">'+multiy).dialog({ position:'top',buttons:{'Okay': function (){



					$(this).dialog('close');	



					}}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'fadeIn' });	



					



					}).complete( function () {



					}).success( function () {



	});



});







// change username div dialog



$('#change_user').click( function () {



	$('#change_username input').val('');



	$('#error5').html('').hide();



changeuse();



function changeuse(){



	$('#change_username').dialog({ position:'top',buttons:{'Change': function (){







	var _username   = $('#username').val();



	var password      =  $('#password').val();



	var new_user   =   $('#new_username').val();















				$('#change_username').dialog('close');



				$('#changing').dialog({ position:'top',buttons:{}, closeOnEscape: true, draggable: false, resizable: false, modal: true, show:'fadeIn' });  // show changin graphic



				$.post('change_username_and_password.php',{ _username: _username, password:password ,new_user:new_user }, function (change_std) {	   



				



				if(change_std == 2){	



				$('#change_username input').val('');



				$('#error5').html(change_std).hide();



					$('#changing').dialog('close');  



					chaifusrnmaetest();



					$('#feedback_3').html('<img src="success.gif" style="border-radius:6em"> your username has been Changed!').dialog({ position:'top',buttons:{'Okay': function (){



					$(this).dialog('close');	



					}}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'fadeIn' });					



				}else{



				$('#changing').dialog('close'); 



				$('#error5').html(change_std).fadeIn();



			 



				changeuse();



				}



				



				



					}).complete( function () {







					}).success( function () {



	});



		











	},'cancel':function (){



	$('#change_username input').val('');



	$('#error5').html('').hide();



	$(this).dialog('close');  



	}}, closeOnEscape: true, draggable: false, resizable: false, modal: true, show:'fadeIn' });











}



});







// change password div dialog



$('#change_passw').click( function () {



	$('#change_pass input').val('');



	$('#error6').html('').hide();



changepass();



	function changepass(){



	$('#change_pass').dialog({ position:'top',buttons:{'change':function (){







	var c_username   = $('#username1').val();



	var c_pass      =  $('#password1').val();



	var new_pass   =   $('#new_password').val();



	var con_pass   =   $('#con_password').val();







	if (new_pass != con_pass){



	$('#error6').html('password do not match!').fadeIn();



	}else{







		$('#change_pass').dialog('close');



		$('#changing').dialog({ position:'top',buttons:{}, closeOnEscape: true, draggable: false, resizable: false, modal: true, show:'fadeIn' });  // show changin graphic



		$.post('change_username_and_password.php',{ c_username: c_username, c_pass:c_pass ,new_pass:new_pass }, function (change_std_p) {	   







					if(change_std_p == 2){	



						$('#change_pass input').val('');



						$('#error6').html('').hide();



						$('#changing').dialog('close');  



						chackpword();



						$('#feedback_3').html('<img src="success.gif" style="border-radius:6em"> your password has been Changed!').dialog({ position:'top',buttons:{'Okay': function (){



						$(this).dialog('close');	



						}}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'fadeIn' });					



					}else{



					$('#changing').dialog('close'); 



					$('#error6').html(change_std_p).fadeIn();



				 



					changepass();



					}



					



















					}).complete( function () {







					}).success( function () {



	});



	}











	},'cancel':function (){



	$('#change_pass input').val('');



	$('#error6').html('').hide();



	$(this).dialog('close');  



	}}, closeOnEscape: true, draggable: false, resizable: false, modal: true, show:'fadeIn' });











	}



});



















	



});
