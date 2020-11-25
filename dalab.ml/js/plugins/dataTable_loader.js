 // dataTable loader for every table in the system 
 (function( $ ) {
 
    $.fn.dataTable_loader = function() {
		      colms = this.attr('colms');
		      other_query = this.attr('other_query');
		      file = this.attr('table_file');   // customers.php
			  primary_key = this.attr('primary_key');
			  table = this.attr('table');

			 this.DataTable({
                   "bProcessing": true,
				   "bServerSide": true,
				   "aLengthMenu": [31,62,100,200,400,600],
					"iDisplayLength": 400,	
				   "sAjaxSource": ""+file+"?colms="+colms+"&other_query="+other_query+"&table="+table+"&primary_key="+primary_key,  // remove % from otherQuery
                   "fnCreatedRow": function( nRow, aData, iDataIndex ) {
                   		 	
                        },
					"responsive": true,
                    "bJQueryUI": true,
		            "sPaginationType":"full_numbers",
					 "fnDrawCallback": function() {
					 	$(".title_:contains('in')" ).addClass('in_color').removeClass('title_');  
		  		// customize the dataTable toolbar....
		  		 if($('.horizantal_loading').is(':visible')){
					 loading_fun('stop','#view');
					 $('#view').show();  
					$('.horizantal_loading').hide(); 		  		 	
		  		 }
 
				}});
			// html5 search field
			this.parent().find('div.fg-toolbar .dataTables_filter input').keyup(function(e){
				
				 	if(e.keyCode == 13){

							if($.trim($(this).val()) != ''){
								loading_fun('start','');
							}
					}



			});   

            this.parent().find('div.fg-toolbar .dataTables_filter label input').attr('placeholder','Search');//.html('<input type="text" ="search" aria-controls="'+this.parent().find('div.fg-toolbar .dataTables_filter label input').attr('aria-controls')+'" > ');

            this.parent().find('div.fg-toolbar select').attr('remove_filter','true');
         	this.parent().find('div.fg-toolbar select[remove_filter="true"]').chosen({"disable_search": true});
         	 fix_chose_size();
			this.find('th').attr('onclick',"loading_fun('start','')");	 									


    };
 
}( jQuery ));
 		
	
  