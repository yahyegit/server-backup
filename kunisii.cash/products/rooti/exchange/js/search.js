	// search function 



	function search(){	
 


	  var search_val  = 	 $('#search').val();



	  if (jQuery.trim(search_val) !='') {



	 $('#blance_sidbar').fadeOut();



	  $('#selpos2,#totals2').fadeOut();



   



	 $('#search_resalt').fadeIn();



	



	 $('#castomer_details2').html('<img src="loading.gif" alt="loadin..."/> ').fadeIn();



	



			 $.ajax({



			 type:'POST',



			 url: 'search.php',



			 data: 'search_val='+search_val,



			 success: function(data){



			 



			 if(data == 2){



			 location.reload();



			 }else{



			 	$('#totals2').hide();



				$('#castomer_details2').fadeOut().html(data);
                                $('#castomer_details2 div#search_tabs').tabs();
                                 $('#castomer_details2').fadeIn();

				 $('#blance_sidbar').fadeOut();



				  $('#blance_sidbar').fadeOut();



			 }



			



			}



			}).complete( function () {



 



				$('#castomer_details2 td[class="full_name"]').hover(function () {



					$(this).addClass('hover');



				}).mouseleave(function (){



					$(this).removeClass('hover');



				 });



			



			// more details of one person	



				$('#castomer_details2 td[class="full_name"]').click(function () {



					 id1 =  $(this).attr('id');



					 id2 =  $(this).attr('id');



					 id3 =  $(this).attr('id');



					 id4 =  $(this).attr('id');



					 id5 =  $(this).attr('id');



			



					



					 



					// put loading image here 



					// rows of the history 



					$('#castomer_details2').html('<img src="loading.gif" alt="loadin..."/> ');



					$.post('history.php',{ id1: id1}, function (history) {



							$('#castomer_details2').fadeOut().html(history).fadeIn();



							



								// delete histroy row



						 



						$('#castomer_details2 td a[id="delete_histry"]').click(function () {       



										delete_histryRow = $(this).attr('delet_hist');	



										id_card          = $(this).attr('id_card');



											




													$('#worning_to_delete_exp').html('are you sure you want to delete  <p><label>  Password: </label> <input type="password" class="input" id="dellPassword" /> </p>').dialog({ position:'top',buttons:{'YES': function (){	

 
													                                      dellPassword = $('#worning_to_delete_exp #dellPassword').val();

																										
																							if($.trim(dellPassword) == ''){
																								$('#worning_to_delete_exp').append('<p style="color:red;">please enter Delete Password !!<p>').fadeIn();
																			   
																							}else{
																							
																											 $('#changing').dialog({ position:'top',buttons:{}, closeOnEscape: true, draggable: false, resizable: false, modal: true, show:'fadeIn' });
 
																										$.post('delete_histry.php',{delete_histryRow:delete_histryRow, id_card:id_card,dellPassword:dellPassword}, function (deletedhis) {
																													
								 															                        if($.trim(deletedhis) != 1){
																														     $('#changing').dialog('close'); 
																															$('#worning_to_delete_exp').append(deletedhis);
																																	   
																														 }else{	 							
																															 
																															    search();
 
																															        $('#changing').dialog('close');  
																																	$('#worning_to_delete_exp').dialog('close');  																									
								                                                                                                   	$('#Deleted').html('<img src="success.gif" style="border-radius:6em"><p style="color: #fff;"><strong>Transaction </strong>  has been Deleted!</p>').dialog({ position:'top',buttons:{'Okay': function (){ $(this).dialog('close'); }}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'fadeIn' });

																
																														 } 
 
																											});

 
																								
																							}
					
													  

												






													},'NO': function (){



														$(this).dialog('close');	



													}}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'fadeIn' });	




									});



							



					 



							



							



							// all Totals 



								$('#totals2').html('<img src="loading2.gif" alt="loadin..."/> ').fadeIn();



								$.post('all_Total.php',{id5:id5}, function (all_totals) {



									// hide loading ..



									$('#totals2').html(all_totals).fadeIn();



															$('#totals2 input').click(function () {       



																	printDiv('castomer_details2');



															});



									}).complete( function () {



									}).success( function () {



								});



											



						}).complete( function () {



						}).success( function () {



					});



					



					// loading image



					// rows of one month and select options  or all



					$('#choosetim2').html('loading...');



					$.post('date_selector.php',{id4:id4}, function (datea) {



						$('#selpos2').fadeIn();



								$('#choosetim2').html('<option> ALL </option>"'+datea);



						// when you choose month or all 



								$('#choosetim2').change(function (){



										var date_name = $(this).val();



										var date_name2 = $(this).val();



										



										// rows of in one month or all



										$('#castomer_details2').html('<img src="loading.gif" alt="loadin..."/> ');



										$.post('history_detes.php',{ date_name: date_name, id2:id2}, function (datea_table) {



													$('#castomer_details2').fadeOut().html(datea_table).fadeIn();



												



												// delete histroy row



											$('#castomer_details2 td a[id="delete_histry"]').click(function () {       



															delete_histryRow = $(this).attr('delet_hist');	



															id_card          = $(this).attr('id_card');



															




													$('#worning_to_delete_exp').html('are you sure you want to delete  <p><label>  Password: </label> <input type="password" class="input" id="dellPassword" /> </p>').dialog({ position:'top',buttons:{'YES': function (){	

 
													                                      dellPassword = $('#worning_to_delete_exp #dellPassword').val();

																										
																							if($.trim(dellPassword) == ''){
																								$('#worning_to_delete_exp').append('<p style="color:red;">please enter Delete Password !!<p>').fadeIn();
																			   
																							}else{
																							
																											 $('#changing').dialog({ position:'top',buttons:{}, closeOnEscape: true, draggable: false, resizable: false, modal: true, show:'fadeIn' });
 
																										$.post('delete_histry.php',{delete_histryRow:delete_histryRow, id_card:id_card,dellPassword:dellPassword}, function (deletedhis) {
																							                   if($.trim(deletedhis) != 1){
																														     $('#changing').dialog('close'); 
																															$('#worning_to_delete_exp').append(deletedhis);
																																	   
																														 }else{	 							
																															 
																															    search();
 
																															        $('#changing').dialog('close');  
																																	$('#worning_to_delete_exp').dialog('close');  																									
								                                                                                                   	$('#Deleted').html('<img src="success.gif" style="border-radius:6em"><p style="color: #fff;"><strong>Transaction </strong>  has been Deleted!</p>').dialog({ position:'top',buttons:{'Okay': function (){ $(this).dialog('close'); }}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'fadeIn' });

																
																														 } 

 
 
																											});

 
																								
																							      }
					
													  

												






													},'NO': function (){



														$(this).dialog('close');	



													}}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'fadeIn' });	





														});



											



										 



											}).complete( function () {



											}).success( function () {



										});



										



										// Totals of month or all 



										$('#totals2').html('<img src="loading2.gif" alt="loadin..."/> ');



										$.post('total_of_one_month.php',{ date_name2: date_name2, id3:id3}, function (datea_data) {



												$('#totals2').html(datea_data).fadeIn();



																	$('#totals2 input').click(function () {       



																	printDiv('castomer_details2');



																	});



											}).complete( function () {



											}).success( function () {



										});



										







								});







						}).complete( function () {



					



						}).success( function () {



						



						});



					 



					 



					 



					 



					 



				});		



			



			



			// edit catomer 



				$('#castomer_details2 td a[edit="edit"]').click(function () {



				



					 id_edit		=  $(this).attr('id');



					var name		=  $(this).attr('name');



					 cash_in 	=  parseInt($(this).attr('cash_in'));



					 cash_out 	=  parseInt($(this).attr('cash_out'));



					var blance 		=  $(this).attr('blance');



					



					dol_in 		=  parseInt($(this).attr('doller_in'));



					 dol_out 	=  parseInt($(this).attr('doller_out'));



					 dol_blance  =  $(this).attr('doller_blance');



					



					var number =  $(this).attr('number');



					



					



						// reset the update fields



					$('#cash_in, #cash_out,#dol_in,#dol_out').val('0');					



					$('#error2').text('').hide();



					$('#ful_name').val(name);	



					$('#edi_blan').text(blance);



					$('#dol_blance').text(dol_blance);



					$('#edit_number').val(number);

					$('#id_or_passport_edit').val($(this).attr('passsport'));	

					


calculationFunction();
// 4488

					  
 



					// show edit div dialog



					edit_function2();



				 








					
 

				});



			



		 



			// delete costom  



				$('#castomer_details2 td a[del="del"]').click(function () {



				var magec2 =  $(this).attr('name');	



				var id_del =  $(this).attr('id');



				$('#error3').text('').hide();



				deme22();



				function deme22(){



				$('#worning_to_delete').dialog({ position:'top',buttons:{'YES': function (){


 	   
                    dellPassword  =  $('#worning_to_delete #dellPassword').val();

							
				if($.trim(dellPassword) == ''){
					 $('#error3').text('please enter Delete Password !!').fadeIn();
   
				}else{
					

				 

						 $('#changing').dialog({ position:'top',buttons:{}, closeOnEscape: true, draggable: false, resizable: false, modal: true, show:'fadeIn' });
		
 
					$.post('delete.php',{ id_del: id_del,dellPassword:dellPassword}, function (deleted) {



							



							



							if (deleted == 1){



								



									$('#error3').text('').hide();



									 	$('#worning_to_delete').dialog('close');





									 $('#changing').dialog('close');



									search();



									$('#Deleted').html('<img src="success.gif" style="border-radius:6em"><p style="color: #fff;">    Deleted!</p>').dialog({ position:'top',buttons:{'Okay': function (){



									                                    $(this).dialog('close'); }}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'fadeIn' });



								



								}else{



									 $('#changing').dialog('close');




									$('#error3').text(deleted).fadeIn();



									///delme();	



								}



								



	



						}).complete( function () {



						}).success( function () {



					});

					
				}
				
				
				
 


					

					



				},'NO': function (){



				$(this).dialog('close');



				}}, closeOnEscape: true, draggable: false, resizable: false,  modal: true, show:'fadeIn' });



}

 
				



				});



			}).success( function () {







			});



	  



	  



	  



	  



 



	  }



}

