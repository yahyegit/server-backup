
 function Loguut(){
 	 $('#warning').html('<img src="css/warning.png" alt="warning" style="border-radius:2.5em; width:80px; height:40px; margin-right: 4px; "/>Are you Sure you want to LogOut ?').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Yes": function() {
						 	 
	 // send logout
    if(loading_state == 'off'){
		clearInterval(j);
		loading_fun('finish',15);
	} 
	 $.post('php_f/logout.php', function(logged_out) {					
								
							window.location.reload();
	 });
		
							 
						 },
							
						"No": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
							
							
		    $('div [aria-describedby="warning"] div:first span').html('Logging Out'); 
 
		    return false;
 }
	
function searh_date(date,input){
	if($.trim(date.val()) != 'choose...'){
			$(input).find('input[aria-controls]').val(date.val());
			reload_data_tables();
	}
}

var i;
function dataTable_loader(table_id){
		totals = '';  
 		clearInterval(i);		
	 $('#view_container table#'+table_id).DataTable({
                   "bProcessing": true,
				   "bServerSide": true,
				   "aLengthMenu": [31,62,100,200,400,600],
					"iDisplayLength": 31,	
				   "sAjaxSource": "php_f/server_processing.php?table_type="+$('#view_container table#'+table_id).attr('table_type')+"&where_query="+$('#view_container table#'+table_id).attr('where_query')+"&table="+$('#view_container table#'+table_id).attr('table')+"&primary_key="+$('#view_container table#'+table_id).attr('primary_key')+"&colmns="+$('#view_container table#'+table_id).attr('colmns'),
                   "fnCreatedRow": function( nRow, aData, iDataIndex ) {
                   			   if($('td', nRow).find('div').hasClass('totals_')){  //  div.totals is in the first row
	                   			   	totals = $('td div.totals_', nRow).html();
	                   			   	$('td div.totals_', nRow).hide();
                   			   }

                   			/*	if($('td', nRow).find('div').hasClass('date_search')){  //  div.totals is in the first row
	                   			   	date_search = $('td div.date_search select', nRow).outerHTML();
									if(!$('#view_container div#'+table_id+'_wrapper div.fg-toolbar:first div.date_search').is(':visible')){
											$('#view_container div#'+table_id+'_wrapper div.fg-toolbar:first').append('<div class="date_search">'+date_search+'</div>');
									}
									
                   			   		$('td div.date_search', nRow).remove();	
                   			    } */  
                        },
					"responsive": true,
                    "bJQueryUI": true,
		            "sPaginationType":"full_numbers",
					 "fnDrawCallback": function() {
							$('#'+$('#view_container table#'+table_id).closest('div').parent().attr('id')).find('div.totals').html(totals);			 			  
							totals = '';
							$(this).fadeIn();

					$('div.get_details').closest('td').hover(function(){
					            $(this).addClass('ui-state-hover').css('cursor','pointer');
					    }).mouseleave(function(){ 
					        	$(this).removeClass('ui-state-hover').removeAttr('style');
					   });

					$('#view_container div#'+table_id+'_wrapper div.fg-toolbar select').chosen({search_contains: true });
					$('#view_container div#'+table_id+'_wrapper div.fg-toolbar .chzn-search:first').remove();  							 
		}});

 	 	 
}



cars_available = '';
c_active_car = false;

function get_car_details(){

if(c_active_car != false) {
alert('good');
		$.post('php_f/get_car_details.php',{car_id:c_active_car},function(feedback){
				if($.trim(json_data) == 'login'){location.reload();}
				$('div.car_details').fadeOut().html(feedback);
		
			$('div.car_details table').show();
       $('div.car_details').fadeIn();
			});	

}else { 
 alert(5555);
}


}
// dataTable creator
function data_table_creator(json_data,carDetails = ''){
	$('#view_container').fadeOut()
		cars_available = json_data.available_cars_count; 

  c_active_car = false;

		$('.form_div').fadeOut();
		add_car_btn = '<a href="#" class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="add_car({status:\'add\'})" role="button" aria-disabled="false" ><span class="ui-button-icon-primary ui-icon ui-icon-plus"></span><span class="ui-button-text">Add Cars</span></a>';
		rent_car_btn = '<a href="#" class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="add_({status:\'add\'})" role="button" aria-disabled="false" ><span class="ui-button-icon-primary ui-icon ui-icon-plus"></span><span class="ui-button-text">Rent Car</span></a>';

		if(json_data.status == 'cars'){   
			//  (all cars, available cars)			

			 $('#view_container').html(add_car_btn+'   <div id="all_cars"> <div class="totals"></div><table id="all_cars_table" class="table" width="100%" where_query="'+json_data.where_query_all_cars+'" table="'+json_data.table_all_cars+'" primary_key="'+json_data.primary_key_all_cars+'" table_type="cars"   colmns="'+json_data.colmns_all_cars+'"><thead> <tr> '+json_data.thead_all_cars+'  </tr></thead></table> </div> ');
			// $('#view_container #cars_tabs').tabs();
			 $('#view_container table').hide();

			  $('#view_container table').each(function(){
			  	 dataTable_loader($(this).attr('id'));
			  });

			 get_avaible_cars_count();

		}else if(json_data.status == 'car_account'){   
		 

			 $('#view_container').html(add_car_btn+'<div class="car_account_wrapper"> <div class="car_details">  </table> </div>  <div id="car_account_tabs"> <ul><li><a href="#single_car_rentHistory">Rents for '+json_data.carName+' </a></li> <li><a href="#single_car_income">Income  for '+json_data.carName+' </a></li> <li><a href="#single_car_expense">Expense  for '+json_data.carName+' </a></li></ul><div id="single_car_rentHistory"> <div class="totals"></div><table class="table" id="car_rents" width="100%" where_query="'+json_data.where_query_rent+'" table="'+json_data.table_rent+'" primary_key="'+json_data.primary_key_rent+'" table_type="customers"   colmns="'+json_data.colmns_rent+'"><thead> <tr> '+json_data.thead_rent+'  </tr></thead><tbody>  </tbody></table> </div>     <div id="single_car_income"> <div class="totals"></div><table class="table" width="100%" id="car_income"  where_query="'+json_data.where_query_income+'" table="'+json_data.table_income+'" primary_key="'+json_data.primary_key_income+'" table_type="income"   colmns="'+json_data.colmns_income+'"><thead> <tr> '+json_data.thead_income+'  </tr></thead><tbody>  </tbody></table> </div> <div id="single_car_expense"> <a href="#" class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="add_expense({status:\'edit\',car_name:\''+json_data.carName+'\'})" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-plus"></span><span class="ui-button-text">Add expense</span></a> <div class="totals"></div><table id="car_expense" class="table" width="100%" where_query="'+json_data.where_query_expense+'"  table_type="expense" table="'+json_data.table_expense+'" primary_key="'+json_data.primary_key_expense+'" colmns="'+json_data.colmns_expense+'"><thead> <tr> '+json_data.thead_expense+'  </tr></thead><tbody>  </tbody></table> </div></div> </div>');
			 $('#view_container #car_account_tabs').tabs();
			 $('#view_container table').hide();
			 			// get car details
  c_active_car = carDetails;
	get_car_details();
;
			  $('#view_container table').each(function(){
			  		if($(this).attr('id')){
			  			dataTable_loader($(this).attr('id'));
			  		}
			  	 
			  }); 
			  $('.car_details table').show();
			 // $('#car_details table td').show();
			
		}else if(json_data.status == 'customer_account'){
			// customer account page tabs (cars,debts,over-due,payments)

			overDue_tab = (json_data.overDue_count == '0')?'':'<li><a href="#overDue_customer">Over-due for '+json_data.customer_name+' <span class="badge">'+json_data.overDue_count+'</span> </a></li>';
			overDue_div = (json_data.overDue_count == '0')?'':'<div id="overDue_customer"> <div class="totals"></div> <table class="table" id="customer_overDue"  width="100%" where_query="'+json_data.where_query_rent_overDue+'"    table_type=""  table="'+json_data.table_rent_overDue+'" primary_key="'+json_data.primary_key_rent_overDue+'" colmns="'+json_data.colmns_rent_overDue+'"><thead> <tr> '+json_data.thead_rent_overDue+'  </tr></thead><tbody>  </tbody></table> </div>';
			 $('#view_container').html(rent_car_btn+'<div id="customer_account_tabs"> <ul>'+overDue_tab+' <li><a href="#cars_customer">Cars for '+json_data.customer_name+'</a></li> <li><a href="#debts_customer">debts for '+json_data.customer_name+'</a></li> <li><a href="#payments_customer">Payments</a></li></ul> '+overDue_div+' <div id="cars_customer"> <div class="totals"></div> <table class="table" id="customer_rents" width="100%" where_query="'+json_data.where_query_rent+'" table="'+json_data.table_rent+'" primary_key="'+json_data.primary_key_rent+'"   table_type=""     colmns="'+json_data.colmns_rent+'",><thead> <tr> '+json_data.thead_rent+'  </tr></thead><tbody>  </tbody></table> </div> <div id="debts_customer"> <div class="totals"></div> <table class="table" width="100%" id="customer_debts" where_query="'+json_data.where_query_rent_debt+'"   table_type=""   table="'+json_data.table_rent_debt+'" primary_key="'+json_data.primary_key_rent_debt+'" colmns="'+json_data.colmns_rent_debt+'"><thead> <tr> '+json_data.thead_rent_debt+'  </tr></thead><tbody>  </tbody></table> </div>    <div id="payments_customer"> <div class="totals"></div> <table class="table" width="100%" id="customer_payments" where_query="'+json_data.where_query_cust_payments+'" table="'+json_data.table_cust_payments+'" primary_key="'+json_data.primary_key_cust_payments+'"  table_type="income"   colmns="'+json_data.colmns_cust_payments+'"><thead> <tr> '+json_data.thead_cust_payments+'  </tr></thead><tbody>  </tbody></table> </div> </div>');
			 $('#view_container #customer_account_tabs').tabs();
			 $('#view_container table').hide(); 

			  $('#view_container table').each(function(){
			  	 dataTable_loader($(this).attr('id'));
			  });
		}else if(json_data.status == 'income'){
			$('#view_container').html('<div class="totals"></div><table  id="all_income" class="table" width="100%"  table_type="income" where_query="'+json_data.where_query+'" table="'+json_data.table+'" primary_key="'+json_data.primary_key+'" colmns="'+json_data.colmns+'"><thead> <tr> '+json_data.thead+'  </tr></thead><tbody>  </tbody></table>');
			$('#view_container table').hide();
			dataTable_loader('all_income');
		}else if(json_data.status == 'expense'){
			
			$('#view_container').html('<a href="#" class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="add_expense({status:\'add\'})" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-plus"></span><span class="ui-button-text">Add expense</span></a><div class="totals"></div><table id="all_expense" class="table" width="100%"  table_type="expense" where_query="'+json_data.where_query+'" table="'+json_data.table+'" primary_key="'+json_data.primary_key+'" colmns="'+json_data.colmns+'"><thead> <tr> '+json_data.thead+'  </tr></thead><tbody>  </tbody></table>');
			$('#view_container table').hide();
			dataTable_loader('all_expense');
		}else if(json_data.status == 'settings'){
			$.post('php_f/settings.php',function(json_data){
				if($.trim(json_data) == 'login'){location.reload();}
				json_data = JSON.parse(json_data);
				$('#view_container').html('<table id="settings_table" class="table" width="100%"> <tbody><tr> <th>username</th> <td>'+json_data.username+'</td><td> <a href="#" class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick=\'edit_settings("'+json_data.username+'","username","username")\' role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-pencil"></span><span class="ui-button-text">Change</span></a> </td></tr>   <tr> <th>password</th> <td> ******** </td><td>  <a href="#" class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick=\'edit_settings("","password","password")\' role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-pencil"></span><span class="ui-button-text">Change</span></a> </td></tr>  <tr> <th>Company name</th> <td>'+json_data.companyName+'</td><td>  <a href="#" class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick=\'edit_settings("'+json_data.companyName+'","company name","company_name")\' role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-pencil"></span><span class="ui-button-text">Change</span></a> </td></tr> <tr> <th>Company mobile</th> <td>'+json_data.companyMobile+'</td><td>  <a href="#" class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick=\'edit_settings("'+json_data.companyMobile+'","company tell or mobile","company_mobile")\' role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-pencil"></span><span class="ui-button-text">Change</span></a> </td></tr>  <tr> <th>Company address </th> <td>'+json_data.companyAddress+'</td><td> <a href="#" class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick=\'edit_settings("'+json_data.companyAddress+'","company address","company_address")\' role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-pencil"></span><span class="ui-button-text">Change</span></a> </td></tr> <tr> <th>Company Email </th> <td>'+json_data.companyEmail+'</td><td> <a href="#" class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick=\'edit_settings("'+json_data.companyEmail+'","company Email","company_email")\' role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-pencil"></span><span class="ui-button-text">Change</span></a> </td></tr>  <tr> <th>Currency</th> <td>'+json_data.currency+'</td><td>  <a href="#" class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick=\'edit_settings("'+json_data.currency+'","currency","currency")\' role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-pencil"></span><span class="ui-button-text">Change</span></a> </td></tr>  </tbody></table>');
				$('#view_container table').show();
			});
			
			 
		}else{
		// start the loading 
			$('#view_container').html(rent_car_btn+'<div class="totals"></div><table id="others_table" class="table" width="100%"  table_type="'+json_data.table_type+'" where_query="'+json_data.where_query+'" table="'+json_data.table+'" primary_key="'+json_data.primary_key+'" colmns="'+json_data.colmns+'"><thead> <tr> '+json_data.thead+'  </tr></thead><tbody>  </tbody></table>');
			$('#view_container table').hide();
			dataTable_loader('others_table');

		}
 

		 
	if(loading_state == 'off'){
		clearInterval(j);
		loading_fun('finish',15);
	}
 




$('#view_container').fadeIn();

}
