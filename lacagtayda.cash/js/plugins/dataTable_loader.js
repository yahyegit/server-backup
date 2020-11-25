 // dataTable loader for every table in the system 
 (function( $ ) {
 
    $.fn.dataTable_loader = function() {
		      colms = this.attr('colms');
		      other_query = this.attr('other_query');
		       other_query2 = this.attr('other_query2');

		      file = this.attr('table_file');   // customers.php
			  primary_key = this.attr('primary_key');
			  table = this.attr('table');

			 this.DataTable({
                   "bProcessing": true,
				   "bServerSide": true,
				   "aLengthMenu": [31,62,100,200,400,600,"All"],
					"iDisplayLength": 31,	
				   "sAjaxSource": ""+file+"?colms="+colms+"&other_query2="+other_query2+"&other_query="+other_query+"&table="+table+"&primary_key="+primary_key,  // remove % from otherQuery
                   "fnCreatedRow": function( nRow, aData, iDataIndex ) {
                   	  	$('div.dataTables_wrapper').each(function(){
									     $(this).css('width',parseInt($(this).find('table.dataTable').width())+130+'px');
									});

                   	  $('.loading_cycle').hide();
                   		 //	$(nRow).find('.msg_type_div').parents().find('th.th_col_span').attr('colspan','2');
                   		 	//$(nRow).find('.msg_type_div').parent().attr('colspan','2');
                        },
					"responsive": true,
                    "bJQueryUI": true,
		            "sPaginationType":"full_numbers",
					 "fnDrawCallback": function() {
			 $('.dataTables_wrapper').css('width','auto');

	 
					 	//$(".title_:contains('in')" ).addClass('in_color').removeClass('title_');  
		  		// customize the dataTable toolbar....
		  		 if($('.horizantal_loading').is(':visible')){
					 loading_fun('stop','#');
					 $('#view').show();  
					$('.horizantal_loading').hide(); 		  		 	
		  		 }
                 $('.loading_cycle').hide();
                 	if($('#open_day_table').is(':visible')){

	 				    $('#open_day_table .dataTables_empty').html("<button class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"request_template('','','pages/forms/open_day_form.php');\" role=\"button\" aria-disabled=\"false\" style=\"font-size: 11px;\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\">Add Open Cash </span></button>");
 


	                 	if($('#open_day_table row').length < 9){
	                 			// remove toolbar 
	                 	    $('#open_day_table_wrapper .fg-toolbar').remove();
				         }
			          }

 
				}});
			loading_fun('start','');
			 $('.dataTables_processing').html($('#loading_cycle').html()).show();
             $('div.fg-toolbar .dataTables_processing .horizantal_loading').show();

			// html5 search field
			this.parent().find('div.fg-toolbar .dataTables_filter input').attr('onkeyup'," $('.loading_cycle').show(); loading_fun('start','#');"); 


            this.parent().find('div.fg-toolbar .dataTables_filter label input').attr('placeholder','Search');//.html('<input type="text" ="search" aria-controls="'+this.parent().find('div.fg-toolbar .dataTables_filter label input').attr('aria-controls')+'" > ');

            this.parent().find('div.fg-toolbar select').attr('remove_filter','true');
         	this.parent().find('div.fg-toolbar select[remove_filter="true"]').chosen({"disable_search": true});
         	 fix_chose_size();
			this.find('th').attr('onclick',"loading_fun('start',''); $('.loading_cycle').show();");	 									

this.find('th').each(function(){
$(this).html('<pre>'+$(this).html()+'</pre>');
});

this.parent().find('select').attr('onchange'," $('.loading_cycle').show(); loading_fun('start','');");
 					 //	this.parents().find('th.th_col_span').attr('colspan','2');
this.parent().find('.dataTables_length').append('<button class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="window.print()" role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-print"></span><span class="ui-button-text">Print</span></button>');

    };
 




}( jQuery ));
 		
	
  
