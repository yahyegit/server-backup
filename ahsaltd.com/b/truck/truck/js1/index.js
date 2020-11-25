// some public variables

 var  payment_name = '';
 var description_payment  = '';
 var payment_amount = '';
 var paymentDate = '';
var test = '';
var currentViewingSupplier = '';
var  autoComplateData = '';
totalsArray_main  = {p:{},o:{},w:{}};
var currentTruckInfo = '';
	
uniqueTable  = 0;

 // ---end public variables -----end \\ 







// is numeric expresstion 
isNumeric = /^(\d+|\d+\.\d*|\d*\.\d+)$/; 
  
 // comma  format function
function CommaFormattedN(amount) {
   var i = parseFloat(Math.round(amount * 100) / 100);//.toFixed(2);
   if($.trim(i) == '') { return ''; }
   if($.trim(i) == 'NaN') { return ''; }

 amount = i.toString().replace(/./g, function(c, i, a) {
               return i && c !== "." && ((a.length - i) % 3 === 0) ? ',' + c : c;
			});
  
    return amount;
}  
  


// special inline conditional 
  function condFunction(chackingValue,truec,falsec){
  if(chackingValue){
  return truec;
  }else{
  return falsec;
  }
  
  
  }
  


  
 //error function 
 function error_func(message){
 $("#error").html('<img src="css/error.jpg" alt="error" style="border-radius:2em; width:70px; height:40px; margin-right: 4px;"/>'+message).dialog({  show: "blind", hide: "explode", width: 'auto',  position:'top', height:'auto',  modal: true, buttons:  {
						"Okay": function() {
							$(this).dialog("close");
		}}, });
	 window.location.href = "#error";
	return false;
 }

// loading function
  function loading_func(){
    $("#loading").attr('title','loading').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, width: 'auto', position:'top', height:'auto'}).css('background-color', '#161616').css('background-image','url(pattern_40.gif)').css('background-position',' top left');
    window.location.href = "#loading";
  return false;
  }
  		 
 // success function 
 function success_func(message){
  $('#success').attr('title','success').html('<img src="css/success.gif" alt="success" style="border-radius:2em; width:80px; height:40px; margin-right: 4px; "/>'+message).dialog({  show: "blind",position:'top', hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
						"Close": function() {
							$(this).dialog("close");
		}}, });
	  window.location.href = "#success";
	return false;
 }
 
 
// -------------------------------------
// print 
function print(currentDataTable,currentTotals){
	  dataTableData = '<table class="display dataTable" cellspacing="0" width="100%" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 100%;">'+currentDataTable.html()+'<table>';
	
	
	if(!currentTotals){
		currentTotals = '';
	 } 
	
	  currentTotals_data = '<table class="table">'+currentTotals.html()+'</table>';
	
       $('div.printerBox').html(dataTableData+currentTotals_data);
	   
      
	   
	     $('#success').css({
			    'font-size': '50px',
				 'width': '500px',
			     'height': '500px'
		     }).html('<div style="padding:40px;" > press 	(ctrl + P) </div>').dialog({  show: "blind",position:'top', hide: "explode", width: 'auto', madal:true, height:'auto', open: function() { 
			   $(this).closest(".ui-dialog").find(".ui-dialog-titlebar:first").hide(); 
			   $(this).closest(".ui-dialog").find(".ui-dialog-buttonpane:first").addClass('hiddenFromPrinting');
			 }, buttons:  {
						"Close": function() {
							$(this).dialog("close");
			 } }}).addClass('hiddenFromPrinting');
		
		  $('div.printerBox').nextAll().addClass('hiddenFromPrinting');
		   $('div.printerBox').next().next().next().addClass('hiddenFromPrinting');
		  console.log( $('div.printerBox').next().next().next());
	   /// window.pring();
 } 
 
   
	// server-side dataTable after condition 
	  autoUpdate = '';
  function apply_dataTable(other_query,tableName,primaryKey,collms,tableClassName,table_thead){
	  colls_length = table_thead.split("/");
      col = colls_length.length;
	//  col += condFunction(other_query.match(/project-name/g) && $.trim(tableName) == 'suppliers-history',2,0);
    
	 
		     // create table heading 
	       $('.'+jQuery.trim(tableClassName)).html(table_thead); // create html collms 
 
   if( condFunction(tableClassName.match(/export_printTable/g),1,0) ){
	 
		 $('table.'+jQuery.trim(tableClassName)).DataTable({
                   "bProcessing": true,
				   "bServerSide": true,
				   "aLengthMenu": [[10,25, 50, 75, -1], [10,25, 50, 75, "All"]],
					"iDisplayLength": -1,	
					 
				   "sAjaxSource": "php_f/server_processing.php?other_query_="+other_query+"&tableName_="+tableName+"&primaryKey_="+primaryKey+"&collms_="+collms,
                   "fnCreatedRow": function( nRow, aData, iDataIndex ) {
					            
								   // row span
                              $('td:first div.weaklyTotals', nRow).each(function (){
								                 // col =  col - $('div.weaklyTotals').parent().parent().find('td').not(':first').not('.td_not_remove_dt').length;
											 	  $(this).parent().attr('colspan',''+20+''); 
							    });
								 
							      // add class 'actions_collm_data' if in action collms td 
							    $('td:last', nRow).addClass(condFunction(table_thead.match(/action/g),'actions_collm_data',''));
							

							 
                        },
					"responsive": true,
                    "bJQueryUI": true,
		            "sPaginationType":"full_numbers",
					 "fnDrawCallback": function() {
                                  // remove empty <td> in the weaklyTotals row  from the current
							  $('table.'+jQuery.trim(tableClassName)+' div.weaklyTotals').each(function (){
								// $(this).parent().parent().find('td:first').attr('colspan',''+col+''); 
								 $(this).parent().parent().find('td').not(':first').not('.td_not_remove_dt').hide();
								 $(this).find('td').show();
							 });

                                    // after loading last table you can open print
                             if(tableClassName ==  'products_export_printTable'){ 
                                         $('#loading').dialog('close');
									 $('#success').css({
													'font-size': '50px',
													 'width': '500px',
													 'height': '500px'
												 }).html('<div style="padding:40px;" > press 	(ctrl + P) </div>').dialog({  show: "blind",position:'top', hide: "explode", width: 'auto', madal:true, height:'auto', open: function() { 
												   $(this).closest(".ui-dialog").find(".ui-dialog-titlebar:first").hide(); 
												   $(this).closest(".ui-dialog").find(".ui-dialog-buttonpane:first").addClass('hiddenFromPrinting');
												 }, buttons:  {
															"Close": function() {
																$(this).dialog("close");
												 } }}).addClass('hiddenFromPrinting');
											
											  $('div.printerBox').nextAll().addClass('hiddenFromPrinting');
											  $('div.printerBox').next().next().next().addClass('hiddenFromPrinting');
									 
                               }
							
                      }
                   });
       
	 }else{
		
	  	 // apply dataTable and parse required details
			 $('table.'+jQuery.trim(tableClassName)).DataTable({
                   "bProcessing": true,
				   "bServerSide": true,
				  "aLengthMenu": [[10,25, 50, 75, -1], [10,25, 50, 75, "All"]],
				"iDisplayLength": 25,			       
				   "sAjaxSource": "php_f/server_processing.php?other_query_="+other_query+"&tableName_="+tableName+"&primaryKey_="+primaryKey+"&collms_="+collms,
                   "fnCreatedRow": function( nRow, aData, iDataIndex ) {
					            
								   // row span
                              $('td:first div.weaklyTotals', nRow).each(function (){
								                 // col =  col - $('div.weaklyTotals').parent().parent().find('td').not(':first').not('.td_not_remove_dt').length;
											 	  $(this).parent().attr('colspan',''+20+''); 
							    });
								 
							      // add class 'actions_collm_data' if in action collms td 
							  $('td:last', nRow).addClass(condFunction(table_thead.match(/action/g),'actions_collm_data',''));
							

							 
                        },
					"responsive": true,
                    "bJQueryUI": true,
		            "sPaginationType":"full_numbers",
					 "fnDrawCallback": function() {
                                  // remove empty <td> in the weaklyTotals row  from the current
							  $('table.'+jQuery.trim(tableClassName)+' div.weaklyTotals').each(function (){
								// $(this).parent().parent().find('td:first').attr('colspan',''+col+''); 
								 $(this).parent().parent().find('td').not(':first').not('.td_not_remove_dt').hide();
							 });

                          
                      }
                

				  });
   
     }
 
 //$('table.'+jQuery.trim(tableClassName)).closest("div").find('.fg-toolbar').find('select').append('<option value="all">all</option>');
	   
	   
	  	 //    autocompleteCach('')  // update autoComplate
				
             // printer button
            print_btn =  '<button onclick="print($(this).parent().next(\'.dataTable:first\'),$(this).parent().next(\'.dataTable:first\').parent().next(\'.table:first\'));" class=" ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" style="float: left; font-size: 0.7em;width: 100px;height: 30px;font-weight: bold;" title="" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-print" style="zoom: 1.4;"></span><span class="ui-button-text"> Print </span></button>';
		   $('.'+jQuery.trim(tableClassName)).parent().find('div.fg-toolbar div.dataTables_length').after(print_btn);
		 
		   // progressbar
		    	progressBar = '  <div class="meter red" style="margin-bottom: 1px; margin-top: 1px;"> <span style="width: 100%"></span>  </div>';
		    $('.'+jQuery.trim(tableClassName)).parent().find('div.fg-toolbar div.dataTables_processing').html(progressBar).css('border','none');
		   
		   
		  
		// return false;
	    }
		
    // create dymaic databale for all tables in the sysytem 
  function data_table_loader(other_query,tableName,primaryKey,collms,tableClassName){
 
 
	  if(jQuery.trim(tableName) == 'trucks'){ // suppliers  main tabs  all and debt
	 
	 		    // aplly datable now 
	         apply_dataTable(other_query,tableName,primaryKey,collms,tableClassName,'<thead><tr><th>Truck No</th><th>Current Driver</th><th>driver License No</th><th>mobile</th><th class="actions_collm_data">Actions</th></tr></thead>');
 
	  }else if(jQuery.trim(tableName) == 'suppliers-history'){  // if supplier account
	          // aplly datable now 
		 
            
			  apply_dataTable(other_query,tableName,primaryKey,collms,tableClassName,'<thead><tr>'+condFunction(other_query.match(/project-name/g) || jQuery.trim(other_query) == 'trash' ,'<th>Supplier Name</th><th>Mobile</th>','')+'<th>Product Name</th><th>Product type</th><th>Quantity</th><th>Single Cost</th><th>Total Cost </th><th>Paid</th>  <th> Balance </th> <th> Date </th> <th>Project Name</th><th>Floor No</th> <th class="actions_collm_data " '+condFunction(other_query.match(/project-name/g),'style="display:none;">','>')+'Actions</th></tr></thead>');

	  
	  }else if(jQuery.trim(tableName) == 'workers'){ // if workers 
	  // aplly datable now   
	  apply_dataTable(other_query,tableName,primaryKey,collms,tableClassName,'<thead><tr><th>Name</th><th>ID/Passport</th><th>Work type</th><th>Number of Workers </th><th>Single Cost</th><th>Cost</th><th>Date</th><th>Project Name</th> <th>Floor No</th> <th class="actions_collm_data " '+condFunction(other_query.match(/project-name/g),'style="display:none;">','>')+'Actions</th></tr></thead>');
 
	  }else if(jQuery.trim(tableName) == 'others'){ // if workers 
	  // aplly datable now                                                                            name,cost,date,description,project-name,floorNo                                                              
	  apply_dataTable(other_query,tableName,primaryKey,collms,tableClassName,'<thead><tr><th>Name</th><th>Cost</th><th>Description</th><th>Date</th><th>Project Name</th> <th>Floor No</th> '+condFunction(other_query.match(/project-name/g),'','<th class="actions_collm_data">Actions</th>')+'</tr></thead>');
 
	  }else if(jQuery.trim(tableName) == 'payment_history' && jQuery.trim(other_query) == 'trash' ){ // payment_history
	      // aplly datable now                                                                                                        
	      apply_dataTable(other_query,tableName,primaryKey,collms,tableClassName,'<thead><tr><th>Paid</th><th>Date</th><th>Description</th><th>Supplier Name</th><th>Mobile</th><th class="actions_collm_data">Actions</th></tr></thead>');
	  }else if(jQuery.trim(tableName) == 'payment_history'){ // payment_history
	  // aplly datable now                                                                                                        
	  apply_dataTable(other_query,tableName,primaryKey,collms,tableClassName,'<thead><tr><th>Paid</th><th>Date</th><th>Description</th><th class="actions_collm_data">Actions</th></tr></thead>');
	  }
	 
	  
 
    return false;
  }
  
  // get workers from objects
 function getWorkers(tabsNames_json,path){
		 

		 
		    // header buttons ad
           var add_btn = '<a onclick=\"add($(this).parents().parents().find(\'table.dataTable:first th:first\'),\'\',getAddArgs(\'expenses\',\'\',\'\',\'\'),\'\'); \" class=" ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" style="float: left; font-size: 0.7em;" title="" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-circle-plus"></span><span class="ui-button-text">Add Expense </span></a>  ';
	    
           // creating tabs from objects
	  


      // creating tabs from objects
	     var type_tabs = '';
		 var type_divs = '';
		 var i = 0;
			 $.each(tabsNames_json.expense_types, function(type, totalsArray){ 
			 
			    type_tabs += '<li><a href="#tabs-'+i+'">'+type+'<span class="badge" >('+totalsArray[2]+')</span></a> </li>';	
				type_divs += '<div id="tabs-'+i+'"> <table class="expenses_table'+i+' display" cellspacing="0" width="100%" ></table> <table class="table" ><tr><th>Total Quantity for '+type+' </th><th>Total Cost for '+type+'</th> </tr><tr><td>'+totalsArray[6]+'</td><td>'+totalsArray[3]+'</td></tr></table> </div>'; //  tab with total
			  
			  i++;
			 
				});
	   
   var complete_tabs = '<h3 class="h3">'+add_btn+'|</h3>  <div class="expense_tabs_div" style="clear:both;"><ul> '+type_tabs+'</ul>'+type_divs+'</div>';
	 
	 
	 
		
			 $.each(tabsNames_json.work_types, function(work_type, totalsArray){ 
			     uniqueTable += i;
				 
				
		      if(work_type == 'All'){
			    unique_randon = Math.round(Math.random()*100) + ($('.workers_tbl').length + 1);  
			     unique_randon += 'w'+uniqueTable;
			   
			 projecs_query = "`project-name`='"+projecName+"' "+condFunction(jQuery.trim(floorNo) == 'All' || !jQuery.trim(floorNo),''," AND `floorNo`='"+floorNo+"' ");
			 cond = (work_type == 'All')?condFunction(projecName != '',projecs_query,''):' '+condFunction(projecName != '',projecs_query+' AND ','')+" `work-type`='"+work_type+"' ";
			 
			   // type_tabs += '<li><a href="#w_tabs-'+i+'">'+work_type+'<span class="badge" >('+totalsArray[2]+')</span></a> </li>';	
				type_divs += '<div id="w_tabs-'+i+'"> <table table_query="'+cond+'" table_class_name="workers_table'+unique_randon+'"  class="workers_tbl workers_table'+unique_randon+' display" cellspacing="0" width="100%" ></table>'; //  tab with total
                   wwCost = '<table class="table" ><tr><th>'+condFunction(projecName == '','Total Number of '+work_type+' Workers','Total Number of '+work_type+' Workers for ('+path3+')')+'</th><th>'+condFunction(projecName == '','Total Cost of '+work_type+' Workers ','Total Cost of '+work_type+' Workers for ('+path3+')')+'</th> </tr><tr><td>'+totalsArray[3]+'</td><td>'+totalsArray[4]+'</td> </tr></table>';
				type_divs += wwCost+'</div>';
			
			            
				 if( jQuery.trim(floorNo) == 'All' || !jQuery.trim(floorNo)){
			            $.extend(totalsArray_main.w,{[projecName]:wwCost});
				  }
				 
				}


				i++;
				});
	          type_tabs += '</ul>'; 
			  
		  var complete_tabs = '<h3 class="h3">'+condFunction(projecName == '',add_btn,path2)+'</h3>  <div class="tabs_mulitple_all workers_tabs_div" style="clear:both;"><ul> '+type_tabs+'</ul>'+type_divs+'</div>';
	       
             

		    return complete_tabs;
		   }
 
 
  // get trash
 function getTrash(tabsNames_json,path){
	 
	    trash_box = '<div class="trash_tabs_div"><ul><li><a href="#s_trash_tab">Suppliers<span class="badge" >('+tabsNames_json.countSup+')</span></a> </li>';	
			    trash_box += '<li><a href="#pro_trash_tab">Products<span class="badge" >('+tabsNames_json.countProducts+')</span></a> </li>';	
				trash_box += '<li><a href="#others_trash_tab">Others<span class="badge" >('+tabsNames_json.countOthers+')</span></a> </li>';	
				trash_box += '<li><a href="#w_trash_tab">Workers<span class="badge" >('+tabsNames_json.countWorkers+')</span></a> </li> ';	
				trash_box += '<li><a href="#p_trash_tab">Payments<span class="badge" >('+tabsNames_json.countPayments+')</span></a> </li></ul>';	
				
			   trash_box += '<div id="s_trash_tab"> <table class="suppleirs_trash_table display" cellspacing="0" width="100%" ></table> </div>'; //  tab with total
			   trash_box += '<div id="pro_trash_tab"> <table class="products_trash_table display" cellspacing="0" width="100%" ></table> </div>'; //  tab with total
			   trash_box += '<div id="others_trash_tab"> <table class="others_trash_table display" cellspacing="0" width="100%" ></table> </div>'; //  tab with total
			   trash_box += '<div id="w_trash_tab"> <table class="workers_trash_table display" cellspacing="0" width="100%" ></table> </div> '; //  tab with total
               trash_box += '<div id="p_trash_tab"> <table class="payments_trash_table display" cellspacing="0" width="100%" ></table> </div></div>'; //  tab with total
 
	 return trash_box;

	 }

 // get product from objects
function getProducts(tabsNames_json,path){
		 
           // creating tabs from objects
	     var type_tabs = '';
		 var type_divs = '';
		 var i = 0;
		      path = path.split("/");
			   floorNo = path[1];
			   projecName = path[0];
			    path2 =  projecName+'/'+floorNo+'/Products ';
				 path3 =  projecName+'/'+floorNo+'';
			 $.each(tabsNames_json.product_types, function(productType, totalsArray){ 
			 
                uniqueTable += i;
			
			        unique_randon = Math.round(Math.random()*100) + ($('.products_tbl').length + 1); 
			     unique_randon += 'p'+uniqueTable;
			   if(productType == 'All'){
			  
			 
			     projecs_query = "`project-name`='"+projecName+"' "+condFunction(jQuery.trim(floorNo) == 'All' || !jQuery.trim(floorNo),''," AND `floorNo`='"+floorNo+"' ");
			
				 cond = (productType == 'All')?condFunction(projecName != '',projecs_query,''):' '+condFunction(projecName != '',projecs_query+' AND ','')+" `product-type`='"+productType+"' ";
				
			  //  type_tabs += '<li><a href="#tabs-'+i+'">'+productType+'<span class="badge" >('+totalsArray[2]+')</span></a> </li>';	
				type_divs += '<div id="tabs-'+i+'"> <table  table_query="'+cond+'" table_class_name="products_table'+unique_randon+'"  class="products_tbl products_table'+unique_randon+' display" cellspacing="0" width="100%" ></table> ';
				
				 totalPd  = '<table class="table" ><tr><th>'+condFunction(projecName == '','Total Quantity','Total Quantity of '+productType+' Products for ('+path3+')')+'</th><th>'+condFunction(projecName == '','Total Cost','Total Cost of '+productType+' Products for ('+path3+')')+'</th> <th>'+condFunction(projecName == '','Total Paid','Total Paid of '+productType+' Products for ('+path3+')')+'</th> <th>'+condFunction(projecName == '','Total Balance','Total Balance of '+productType+' Products for ('+path3+')')+'</th></tr><tr><td>'+totalsArray[6]+'</td><td>'+totalsArray[3]+'</td><td>'+totalsArray[4]+'</td><td style="color:blue; font-weight:bold;">'+totalsArray[5]+'</td></tr></table>'; //  tab with total
                type_divs += totalPd+'</div>';
		 
			          
				 if(jQuery.trim(floorNo) == 'All' || !jQuery.trim(floorNo)){
			            $.extend(totalsArray_main.p,{[projecName]:totalPd});
				  }
				 
				}
				
				
				
				
				
				 
				 i++;
				});
	          type_tabs += '</ul>'; 
			 
		  var complete_tabs = '<h3 class="h3"> '+path2+'</h3>  <div class="tabs_mulitple_all supplier_tabs_div" style="clear:both;"><ul> '+type_tabs+'</ul>'+type_divs+'</div>';
	
			     return complete_tabs;
		   }
	

      // get others tabs
 function getOthers(tabsNames_json,path){
		 
		 
			   path = path.split("/");
			   floorNo = path[1];
			   projecName = path[0];
			    path2 =  projecName+'/'+floorNo+'/Others ';
			   


                uniqueTable += 2;
			
                 unique_randon = Math.round(Math.random()*100) + ($('.others_tbl').length + 1);  
			     unique_randon += 'o'+uniqueTable;

			    
			     
				 projecs_query = "`project-name`='"+projecName+"'"+condFunction(jQuery.trim(floorNo) == 'All'|| !jQuery.trim(floorNo),''," AND `floorNo`='"+floorNo+"'");
				 cond =  condFunction(projecName != '',projecs_query,'');
 
		 
	    var add_btn = '<h3 class="h3"> <a onclick=\"add($(this).parents().parents().find(\'table.dataTable:first th:first\'),\'\', getAddArgs(\'others\',\'\',\'\',\'\')); \" class=" ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" style="float: right; font-size: 0.7em; float: left;" title=" " role="button" aria-disabled="false" onclick="add(getAddArgs(\'others\',\'\',\'\',\'\'));"><span class="ui-button-icon-primary ui-icon ui-icon-circle-plus"></span><span class="ui-button-text">Add Others</span></a></h3>';
	 	var type_tabs = '<h3 class="h3">'+condFunction(projecName == '',add_btn,path2)+'</h3>'+'<div class="others_tabs" style="clear:both;"> ';
		    type_tabs += ' <table  table_query="'+cond+'" table_class_name="others_table'+unique_randon+'" class="others_tbl others_table'+unique_randon+' display" cellspacing="0" width="100%" ></table>'; 
			
			oocost = '<table class="table" ><tr><th>'+condFunction(projecName == '','Total Cost','Total cost of Others for ('+path2+')')+'</th></tr> <tr> <td style="font-weight:bold;">'+tabsNames_json.all.all_cost+'</td></tr></table> ';
		 type_tabs += oocost+'</div>';
		
			if(jQuery.trim(floorNo) == 'All'|| !jQuery.trim(floorNo)){
					  $.extend(totalsArray_main.o,{[projecName]:oocost});
				}

		 return type_tabs;
	 }
	


// export the project printerble
 
function export_fun(projecName){
  
	   // printing  tables 
 
	 
	tt1 = '<table class="workers_export_printTable display" cellspacing="0" width="100%" ></table> '+ totalsArray_main.w[projecName];
	tt2 = '<table class="others_export_printTable display" cellspacing="0" width="100%" ></table> '+ totalsArray_main.o[projecName];
	tt3 = '<table class="products_export_printTable  display" cellspacing="0" width="100%" ></table> '+ totalsArray_main.p[projecName];
	
	
    $('div.printerBox').html(tt1+tt2+tt3);

 
 
 	 // workers 
	   apply_dataTable("`project-name`='"+projecName+"'",'workers','id','id,name,id_or_passport,work-type,number-or-workers,cost,date,project-name,floorNo','workers_export_printTable','<thead><tr><th>Name</th><th>ID/Passport</th><th>Work type</th><th>Number of Workers </th><th>Cost</th><th>Date</th><th>Project Name</th> <th>Floor No</th>  </tr></thead>');
    
	 // others
	   apply_dataTable("`project-name`='"+projecName+"'",'others','id','id,name,cost,description,date,project-name,floorNo','others_export_printTable','<thead><tr><th>Name</th><th>Cost</th><th>Description</th><th>Date</th><th>Project Name</th> <th>Floor No</th> </tr></thead>');

	 // products
	   apply_dataTable("`project-name`='"+projecName+"'",'suppliers-history','id','id,supplier-name,mobile,product-name,quantity,single-cost,total-Cost,paid,balance,date,project-name,floorNo','products_export_printTable','<thead><tr> <th>Product Name</th><th>Quantity</th><th>Single Cost</th><th>Total Cost </th><th>Paid</th>  <th> Balance </th> <th> Date </th> <th>Project Name</th><th>Floor No</th></tr></thead>');
 
 
 // hide other btn from the printer
 
  $('div.printerBox .fg-toolbar').remove();
 
 
 
 
 
 
 
 
     $('body').css('background','#eeeeee'); 
 // print now 
  loading_func();
 
 return false;
}
	
// only one main div can visibile an the time	
function clear_main_divs(current){
		$('#suppliers_main_div,#workers_main_div,#projects_main_div,#others_main_div').not("#"+current).html('<div class="progressbar"></div>');	
}
	
  //  creates templates for the sysytem 
function template_creator(type,tabsNames_json,div_id){
        progressBar =  '<div class="progressbar"></div>';
	if(jQuery.trim(type) == 'expenses'){
     clear_main_divs(div_id);
	  	 
		    // header buttons ad
           var add_btn = '<a onclick=\"add($(this).parents().parents().find(\'table.dataTable:first th:first\'),\'\',getAddArgs(\'expense\',\'\',\'\',\'add\'),\'\')\" class=" ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" style="float: left; font-size: 0.7em;" title="" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-circle-plus"></span><span class="ui-button-text">Add Expense </span></a>  ';
	    
    
      // create types 
	     var type_tabs = '';
		 var type_divs = '';
		 i = 0;
			 $.each(tabsNames_json, function(type, totalsArray){ 
			 
			    type_tabs += '<li><a href="#tabs-'+i+'">'+type+'<span class="badge" >('+totalsArray.count+')</span></a> </li>';	
				type_divs += '<div id="tabs-'+i+'"> <table class="expenses_table'+i+' display" cellspacing="0" width="100%" ></table> <table class="table" ><tr><th>Total Quantity for '+type+' </th><th>Total Cost for '+type+'</th> </tr><tr><td>'+totalsArray.totalQuantity+'</td><td>'+totalsArray.totalCost+'</td></tr></table> </div>'; //  tab with total
			  
			  i++;
			 
				});
	   
       var complete_tabs = '<h3 class="h3">'+add_btn+'|</h3>  <div class="expense_tabs_div" style="clear:both;"><ul> '+type_tabs+'</ul>'+type_divs+'</div>';
	 

		
   	     was_visible = condFunction($('#'+jQuery.trim(div_id)).is(':visible'),1,0);
				
		$('#'+jQuery.trim(div_id)).fadeOut().html(progressBar+''+complete_tabs);
		$('#'+jQuery.trim(div_id)+' div.expense_tabs_div').tabs();
	 	if(was_visible){
			$('#'+jQuery.trim(div_id)).fadeIn();	
		}
		
		// apply dataTable 
	  i = 0;     
    $.each(tabsNames_json, function(type, totalsArray){ 
			 otherQuery = ($.trim(type) == 'all')?'':'type="'+type+'" ';
		     apply_dataTable( otherQuery ,'expense','id','id,name,quantity,type,cost,description,date','expenses_table'+i+'','<thead><tr><th> Name</th><th> Quantity </th><th>Type </th><th>Cost</th><th>Description</th><th>Date</th><th class="actions_collm_data">Actions</th></tr></thead>');
  	  
			  i++;
			 
	});
	   
 	}else if(jQuery.trim(type) == 'trash'){
    
	   
	    type_tabs =  '<div class="trash_tabs" style="clear:both;"><ul>  <li><a href="#tabs-3"> Trucks </span></a> </li><li><a href="#tabs-2"> Trips </a></li><li><a href="#tabs-1"> expenses </a></li> </ul> ';
		    type_tabs += '<div id="tabs-1"> <table class="expenseTrashTable display" cellspacing="0" width="100%" ></table>   </div>'; // expenseTrashTable
	        type_tabs += '<div id="tabs-2"> <table class="tripTrashTable display" cellspacing="0" width="100%" ></table>  </div>'; // tripTrashTable
			type_tabs += '<div id="tabs-3"> <table class="truckTrashTable display" cellspacing="0" width="100%" ></table>   </div>'; // truckTrashTable

	   type_tabs += '</div>';
		
			$('#'+jQuery.trim(div_id)).html(progressBar+type_tabs).dialog({ position:[50, 'top'], show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"close": function() {
						    $(this).dialog('close');
							 
	                          }
							  } });				
		  $('div [aria-describedby="'+jQuery.trim(div_id)+'"] div:first span').text('Trash'); 					
          $('div.trash_tabs').tabs();
   
	      
 	
	     apply_dataTable('trash','trucks','id','id,truck_no,driverName,driverLicenseNo,source,distination,cost,date,description','tripTrashTable','<thead><tr><th>Truck No</th><th>Driver Name</th><th>driver License No</th><th>From</th><th>To</th><th>Cost</th><th>Date</th><th>Description</th><th class="actions_collm_data">Actions</th></tr></thead>');
         apply_dataTable('trash','registerd_trucks','id','id,truck_no,driverName,driverLicenseNo,mobile','truckTrashTable','<thead><tr><th>Truck No</th><th>Current Driver</th><th>driver License No</th><th>mobile</th><th class="actions_collm_data">Actions</th></tr></thead>');
 
		 apply_dataTable( "trash",'expense','id','id,name,quantity,type,cost,description,date','expenseTrashTable','<thead><tr><th> Name</th><th> Quantity </th><th>Type </th><th>Cost</th><th>Description</th><th>Date</th><th class="actions_collm_data">Actions</th></tr></thead>');
  	
	}else if(jQuery.trim(type) == 'trucks'){ // suppliers main tabs debs and all with e.g Debs(x)
       clear_main_divs(div_id);
	        add_btn = '<h3 class="h3"> <a class=" ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" style="float: right; font-size: 0.7em; float: left;" title=" " role="button" aria-disabled="false" onclick="add($(this).parents().parents().find(\'table.dataTable:first th:first\'),$(this).parents().parents().find(\'table.dataTable:last th:first\'),getAddArgs(\'trucks\',\'\',\'\',\'add\'),\'\');"><span class="ui-button-icon-primary ui-icon ui-icon-circle-plus"></span><span class="ui-button-text">Add New Trucks</span></a></h3>';
	    
		   type_tabs = add_btn+  ' <table class="all_trucks_table display" cellspacing="0" width="100%" ></table> '; 
		 
	     was_visible = condFunction($('#'+jQuery.trim(div_id)).is(':visible'),1,0);
				
		$('#'+jQuery.trim(div_id)).fadeOut().html(progressBar+''+type_tabs);

	 	if(was_visible){
			$('#'+jQuery.trim(div_id)).fadeIn();	
		}
		 
 
		$('li a[href="#'+jQuery.trim(div_id)+'"]').html('<span class="badge" >('+tabsNames_json.allCounts+') Trucks </span>');
		
			apply_dataTable('unique_tracks','registerd_trucks','id','id,truck_no,driverName,driverLicenseNo,mobile','all_trucks_table','<thead><tr><th>Truck No</th><th>Current Driver</th><th>driver License No</th><th>mobile</th><th class="actions_collm_data">Actions</th></tr></thead>');
 
	
	  }else if(jQuery.trim(type) == 'Income'){ // suppliers main tabs debs and all with e.g Debs(x)
				clear_main_divs(div_id);
					add_btn = '<h3 class="h3"> <a class=" ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" style="float: right; font-size: 0.7em; float: left;" title=" " role="button" aria-disabled="false" onclick="add($(this).parents().parents().find(\'table.dataTable:first th:first\'),$(this).parents().parents().find(\'table.dataTable:last th:first\'),getAddArgs(\'trucks\',\'\',\'\',\'add\'),\'\');"><span class="ui-button-icon-primary ui-icon ui-icon-circle-plus"></span><span class="ui-button-text">Add </span></a></h3>';
	       
					type_tabs += add_btn+ '<table class="incomeTable display" cellspacing="0" width="100%" ></table> <table class="table" ><tr><th>Total Price</th> <th>Total Profit</th>  </tr><tr><td>'+tabsNames_json.totalPrice+'</td><td>'+tabsNames_json.profit+'</td></tr></table> </div>'; // all supplier table with total

		 
		 
		 
	     was_visible = condFunction($('#'+jQuery.trim(div_id)).is(':visible'),1,0);
				
		$('#'+jQuery.trim(div_id)).fadeOut().html(progressBar+''+type_tabs);

	 	if(was_visible){
			$('#'+jQuery.trim(div_id)).fadeIn();	
		}
		 
 
		//$('li a[href="#'+jQuery.trim(div_id)+'"]').html('<span class="badge" >('+tabsNames_json.allCounts+') drivers </span>');
		
 
	     apply_dataTable('','trucks','id','id,truck_no,driverName,driverLicenseNo,mobile,source,distination,cost,date,description','incomeTable','<thead><tr><th>Truck No</th><th>Driver Name</th><th>driver License No</th><th>mobile</th><th>From</th><th>To</th><th>Cost</th><th>Date</th><th>Description</th><th>Income</th><th class="actions_collm_data">Actions</th></tr></thead>');
       
		
	
	  }else if( jQuery.trim(type) == 'truckHistry' ||  jQuery.trim(type) == 'driverHistry'){  // histry
	     currentTruckInfo = tabsNames_json;
	   // header buttons
          truck_no_add = (jQuery.trim(type) == 'truckHistry')?tabsNames_json.id:'';
		
			add_btn = '<h3 class="h3"> <a class=" ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" style="float: right; font-size: 0.7em; float: left;" title=" " role="button" aria-disabled="false" onclick="add($(this).parents().parents().find(\'table.dataTable:first th:first\'),$(this).parents().parents().find(\'table.dataTable:last th:first\'),getAddArgs(\'trucks\',\'\',\'\',\'add\'),\'\');"><span class="ui-button-icon-primary ui-icon ui-icon-circle-plus"></span><span class="ui-button-text">Add Trip to Truck ('+tabsNames_json.id+') </span></a>';
	          add_exp = '<a onclick=\"add($(this).parents().parents().find(\'table.dataTable:first th:first\'),\'\',getAddArgs(\'expense\',\'\',\'\',\'add\'),\'\')\" class=" ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" style="float: left; font-size: 0.7em;" title="" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-circle-plus"></span><span class="ui-button-text"> Add Expenses to Truck ('+tabsNames_json.id+') </span></a>  ';
	     add_btn = add_btn +' | '+ add_exp +'</h3>'; 

		  currentViewingSupplier = tabsNames_json.id;
		  
           // creating tabs from objects
	  // console.log(tabsNames_json);
		 	  
	    truck_ = (jQuery.trim(type) == 'truckHistry')?'Truck '+tabsNames_json.id:'<span class="badge" >('+tabsNames_json.truckCount+')</span> Trucks';
		tell = (tabsNames_json.mobile != '' )?'mobile: '+tabsNames_json.mobile:'';
	    title = ' Truck ('+tabsNames_json.id+'), '+tabsNames_json.driverName+ ', License no: ' +tabsNames_json.licenseNo+', '+tell;
		
	   
	   
	    type_tabs = add_btn+'<div class="truckHistry_tabs" style="clear:both;"><ul>  <li><a href="#tabs-1"> '+truck_+'</span></a> </li><li><a href="#tabs-2"> <span class="badge" >('+tabsNames_json.countExp+')</span>    Expenses for Truck('+tabsNames_json.id+')</a></li> </ul> ';
		    type_tabs += '<div id="tabs-1"> <table class="truckHistryTable display" cellspacing="0" width="100%" ></table> <table class="table" ><tr><th>Total Cost</th>  </tr><tr><td>'+tabsNames_json.hCost+'</td></tr></table> </div>'; // all supplier table with total
		    type_tabs += '<div id="tabs-2"> <table class="expenseHisryTable display" cellspacing="0" width="100%" ></table> <table class="table" ><tr><th>Total Quantity</th>  <th>Total Cost</th> </tr><tr><td>'+tabsNames_json.eQuantity+'</td><td>'+tabsNames_json.eCost+'</td> </tr></table> </div>'; // expense history  totals
	    type_tabs += '</div>';
	  
	  
	   $('#suppliers-history').html(type_tabs).dialog({ position:[50, 'top'], show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"close": function() {
						    $(this).dialog('close');
							 
	                          }
							  } });				
		  $('div [aria-describedby="suppliers-history"] div:first span').text(title); 					
          $('div.truckHistry_tabs').tabs();
	      
		
		
	   otherQuery  = (jQuery.trim(type) == 'truckHistry')?'truck_no="'+tabsNames_json.id+'"':'driverLicenseNo="'+tabsNames_json.id+'"';
	   otherQueryEx = (jQuery.trim(type) == 'truckHistry')?'`name` like "%, Truck No ('+$.trim(tabsNames_json.id)+')%"':'`name` like ", Driver license No ('+$.trim(tabsNames_json.id)+')%"';
	    
	     apply_dataTable(otherQuery,'trucks','id','id,truck_no,driverName,driverLicenseNo,source,distination,quantity,unit_price,cost,date,description','truckHistryTable','<thead><tr><th>Truck No</th><th>Driver Name</th><th>driver License No</th><th>From</th><th>To</th><th>Quantity</th> <th>Unit Price</th><th>Total Price</th><th>Date</th><th>Description</th><th>Income</th><th class="actions_collm_data">Actions</th></tr></thead>');
         
		 apply_dataTable(otherQueryEx,'expense','id','id,name,quantity,type,cost,description,date','expenseHisryTable','<thead><tr><th> Name</th><th>Quantity</th><th>Type </th><th>Cost</th><th>Description</th><th>Date</th><th class="actions_collm_data">Actions</th></tr></thead>');
  
 
	  }
		
 
	
}	

 				
 // autoComplate  cache

 function autocompleteCach(parent_elem){

	       if($.trim(parent_elem) == ''){
			  // 	alert(parent_elem+ '.driverName');
			    $(".dataTables_filter input, div#addTabs input").each(function(){
				 if($(this).hasClass("ui-autocomplete-input")) {
				        $(this).autocomplete("destroy");
				  }
			  });   
		   }

			   	// autocomplete dataTable
   				 $(".dataTables_filter input").autocomplete({
					  source: autoComplateData['allData']
					  });
				
		//
				 // name
			    $(""+parent_elem+" .driverName").autocomplete({
					  source: autoComplateData['driverName']
					});	
		        // name
			    $(""+parent_elem+" .driverLicenseNo").autocomplete({
					  source: autoComplateData['driverLicenseNo']
					});
					
					 // mobile
			    $(""+parent_elem+" .mobile").autocomplete({
					  source: autoComplateData['mobiles']
					});
					 // identity 
			   $(""+parent_elem+" .truck_no").autocomplete({
					  source: autoComplateData['truck_no']
					});
					
					 // productName   
			    $(""+parent_elem+" .from").autocomplete({
					  source: autoComplateData['source']
					});
						 // productType
			    $(""+parent_elem+" .to").autocomplete({
					  source: autoComplateData['distination']
					});
					
					 // project_name
			    $(""+parent_elem+" .name").autocomplete({
					  source: autoComplateData['name']
					});
					
								 // floorNo 
			    $(""+parent_elem+" .eType").autocomplete({
					  source: autoComplateData['eType']
					});
 }

 // get data for autoComplate 
 function autoComplate(starts){
      $.post('php_f/getAvailableTags.php', function(json_loaded_data){	
              autoComplateData = JSON.parse(json_loaded_data);
 		   	 
			  if(jQuery.trim(json_loaded_data) == ''){
				   window.location.reload(); // relogin 
			  }else{  
			      if(starts != 'h'){
					 autocompleteCach('');
				  }
					
			   }
					   
		 });	
 
	return false;
 }
 
 

// load function 	
function load_function(type_id,type,id,tableName){
       	progressBar = '  <div class="meter red" style="margin-bottom: 1px; margin-top: 1px;"> <span style="width: 100%"></span>  </div>';
	   if(type_id == 'suppliers-history' || type == 'trash' ){
		    template_creator(type,'',type_id);
	   }else{
		   $('div.progressbar').html(progressBar);
		    $('div.progressbar').attr('id','progressbar');
		   window.location.href = "#progressbar";
		}
	   $('#'+jQuery.trim(type_id)).show();
	$.post('php_f/load.php', {type_id:type_id,type:type,id:id,tableName:tableName}, function(json_loaded_data){	
           //  console.log(json_loaded_data);
			  $('div.progressbar').html('');	 
          if(jQuery.trim(json_loaded_data) == ''){
			   window.location.reload(); // relogin 
		  }else{
			    json_loaded_data = JSON.parse(json_loaded_data);
			  if($("#loading").closest('.ui-dialog').is(':visible')) { 
				     $('#loading').dialog('close');
				}
				 template_creator(type,json_loaded_data,type_id);
             
		   }
				   
		 }).error(function(){
			 
			 error_func('Network Error please try Again or refresh the bage');
		 });
		return false;
}
 


 function trip_exp_history(row_total_exp,row_profit,row_totalPrice,truckNo,tripDate,source,distination,tripId){
	 
		    payment_hist_tables = '<table class="trip_exp_history_table display" cellspacing="0" width="100%" ></table><table class="table" ><tr><th>Total Price</th><th>Total Cost</th><th>Profit</th> </tr><tr><td>'+row_totalPrice+'</td><td>'+row_total_exp+'</td><td>'+row_profit+'</td></tr></table>';



	 $('#payment_history').html(payment_hist_tables).dialog({ position:[50, 'top'], show: "blind", hide: "explode", width: '900px',  height:'auto',  modal: true, buttons:  {
							"close": function() {
						    $(this).dialog('close');
							 
	                          }
							  } });				
		  $('div [aria-describedby="payment_history"] div:first span').text('Trip Exepenses for Truck('+truckNo+')      From '+source+' To '+distination+'      Date ('+tripDate+')'); 					
 
	   apply_dataTable('`name` like "%, Truck No ('+$.trim(truckNo)+')%" AND tripId="'+tripId+'"','expense','id','id,name,quantity,type,cost,description,date','trip_exp_history_table','<thead><tr><th> Name</th><th> Quantity </th><th>Type </th><th>Cost</th><th>Description</th><th>Date</th><th class="actions_collm_data">Actions</th></tr></thead>');

		 }
 
  // check date if manual or dynamic
  currentDateDefault =  '';
 	function check_date(){
		$.post('php_f/check_date.php', function(feedback){		
                 feedback = JSON.parse(feedback);		
				if(feedback.date_status == 'm'){   // m == manual and d == dymaic				 
				     $('.date').val(feedback.current_date);
					 $('.date_list').fadeIn();
                       currentDateDefault = feedback.current_date;
				}else{
				     $('.date').val(feedback.current_date);
                       currentDateDefault = feedback.current_date;
					 $('.date_list').hide();	 
				}					 
		 });
	}
 
 // make payment
 originalBalance  = 0;
 function make_payment(payment_array){  // args: supplier-account-id, name, total_balance,
 
    $('div#make_payment .total_balance_payment').text(CommaFormattedN(payment_array['total_balance']));
	$('div#make_payment .amount_paid, .payment_description').val('');
	 check_date();

	originalBalance  =  payment_array['total_balance'].replace(/,/g, ''); 
$('div#make_payment').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Pay Now": function() {
				                   var amount_paid = jQuery.trim($(".amount_paid").val().replace(/,/g, '')); 
				                   var payment_description = $(".payment_description").val(); 
							       var date = jQuery.trim($("div#make_payment .date").val()); 
							     if(amount_paid == ''){
									  error_func('please enter Amount');  
							         $(".amount_paid").css('border','2px solid red'); 
								 }else if(!isNumeric.test(amount_paid)){
					                  error_func('invalid Amount');  
							         $(".amount_paid").css('border','2px solid red');  
								 }else if(Number(amount_paid) > Number(payment_array['total_balance'])){
					                  error_func('sorry you cannot pay more than <strong style="color:red;">('+CommaFormattedN(payment_array['total_balance'])+')</strong>');  
							         $(".amount_paid").css('border','2px solid red');  
								 }else if(date == ''){
					                  error_func('Enter Payment Date !!');  
							         $("div#make_payment .date").css('border','2px solid red');  
								 }else{
									 
									 if(!isNumeric.test(payment_array['supplier-account-id'])){
										 // but the info in pulic variable
										  payment_name = payment_array['name'];
										  description_payment  = payment_description;
										  payment_amount = amount_paid;
										  paymentDate =  date;
										  current_b = originalBalance - amount_paid;
										  // show current paid and balance in the total table
										  $(".conf_total_balance").text(CommaFormattedN(current_b));
										  $(".conf_total_paid").text(CommaFormattedN(amount_paid));
										 
										  if(current_b == '0'){ // remove action if total balance is 0
										     $('.conf_action').remove();
										  }
										
										 $(this).dialog('close');
									 }else{
											 loading_func(); // SHOW LOADING animation dialog
											$.post('php_f/make_payment.php', {date:date,account_id:payment_array['supplier-account-id'],amount_paid:amount_paid,payment_description:payment_description}, function(feedback) {					
									                  if(jQuery.trim(feedback) == ''){
															window.location.reload;
														}else if(jQuery.trim(feedback) == '1'){
															success_func('Successful');
															$('div#loading').dialog("close");
														    $('div#make_payment').dialog("close");	 
															load_function('','suppliers-history',payment_array['supplier-account-id'],'suppliers-history');
														}else{
														     error_func(feedback);
															$('div#loading').dialog("close");
														}
								 
											}).error(function(){
			 
			 error_func('Network Error please try Again or refresh the bage');
		 }); 
									 }
									
									 
								 }
 
							},
							"Cancel": function() {	 
									$(this).dialog("close");
								}
						
						
						
						 
			            }});
 
	 $('div [aria-describedby="make_payment"] div:first span').html('making payment for ('+ payment_array['name'] +')'); 
 }
 
// get add function args by Array
function getAddArgs(current_type,id,name,status){
	     add_args = new Array();
		 add_args['tableName'] = current_type;
		 add_args['name'] = name;
		  add_args['status'] = status;
		 add_args['truck_no'] = id; 
	return add_args;
}

// get add function args by Array
function getAddArgs_payment(total_balance,acount_id,name){
	  var make_payment_arr = new Array(); 
		 make_payment_arr['total_balance'] = total_balance;
		 make_payment_arr['supplier-account-id'] = acount_id;  
		 make_payment_arr['name'] = name;
	return make_payment_arr;
}

// auto calculate single-cost and total-cost  payments
function auto_calc(tab_id,type){



if(tab_id == ''){
 
	   amount_paid = jQuery.trim($('#make_payment .amount_paid').val().replace(/,/g, '')); 
	    amount_paid = (!isNumeric.test(amount_paid))?0:amount_paid;
	  
	    $('#make_payment .total_balance_payment').text(CommaFormattedN(originalBalance - amount_paid));
}else{
	
 
  	var quantity = jQuery.trim($('#'+tab_id+' .quantity').val().replace(/,/g, '')); 
	    quantity = (!isNumeric.test(quantity))?1:quantity;
	  
	var single_cost = jQuery.trim($('#'+tab_id+' .single_cost').val().replace(/,/g, '')); 
	    single_cost = (!isNumeric.test(single_cost))?0:single_cost;	
		
	var totalCost = jQuery.trim($('#'+tab_id+' .totalCost').val().replace(/,/g, '')); 
	    totalCost = (!isNumeric.test(totalCost))?0:totalCost;	
				
		
		//single_cost_ = CommaFormattedN(totalCost/quantity);
 
 

		
		 
	  if(type == 'single_cost'){
		   single_cost_ = CommaFormattedN(totalCost/quantity);
			$('#'+tab_id+' .single_cost').val(condFunction(single_cost_ == '0.00','0',single_cost_));
		  
	  }else if(type == 'totalCost'){
		   totalCost_ = CommaFormattedN(quantity * single_cost);
		   $('#'+tab_id+' .totalCost').val(totalCost_);
		   
	  }else if(type == 'w_single_cost'){ // get single cost for workers 
			w_single_cost = CommaFormattedN(w_totalCost/noOfWorkers);
			$('#'+tab_id+' .w_single_cost').val(condFunction(w_single_cost == '0.00','0',w_single_cost));
		  
	  }else if(type == 'cost'){ // get total cost for workers
		   $('#'+tab_id+' .cost').val(CommaFormattedN(noOfWorkers * ww_single_cost2));
	  }
	 
 }
  
  
 

 
}
 
addingStatus = '';

function rest_tabs(){
	// reset tabs
	$('.remove-tab').each( function () {   
                  document.getElementsByClassName('remove-tab')[0].click(); 								  
	}); 

     $('.tab_link').html('tab 1');	

 //  autocompleteCach('div#add_tabs_');
  }
 

		 // reset expenses
		 
function expenseToggle(parrent_div,type){
			 if(type == 'hide'){
				 $(parrent_div+' div.add_exp input[type="text"],'+parrent_div+' div.add_exp textarea').removeClass('trucks');
				   $(parrent_div+' div.add_exp input[type="text"],'+parrent_div+' div.add_exp textarea,'+parrent_div+'  div.add_exp li').fadeOut();
				   $(parrent_div+' div.add_exp .ecost').addClass('trucks');
				   $(parrent_div+' div.add_exp .ecost').attr('currentVal',0).addClass('trucks').val('0');
			 }else{
				   $(parrent_div+' div.add_exp input[type="text"],'+parrent_div+' div.add_exp textarea').addClass('trucks');
				   $(parrent_div+' div.add_exp input[type="text"],'+parrent_div+' div.add_exp textarea,'+parrent_div+'  div.add_exp li').fadeIn();
				   $(parrent_div+' div.add_exp .ecost').val($('div.add_exp .ecost').attr('currentVal'));
			 }
				
			 
		 }
			


 tt = '';
 // add  data_array['tableName'] supplier-account-id
function add(tableElement1,tableElement2,data_array,data_json){    // 'type',etc // add more supleryers and workers then show confirmation box with agree button done

data_json = currentTruckInfo;

tt = data_json;

  rest_tabs();
  
				
//error_msg="invalid cost!" ="Please Enter the cost !" 
    $('div#add input[type="text"], div#add textarea').val('');
    $(' div#add .driverLicenseNo').attr('placeholder',"").attr('required_error',"Please Enter the license NO !");
	$('div#add .truck_no ').attr('placeholder',"").attr('required_error',"Please Enter Truck No!");
	
	check_date();
	
	
 var title = '';
confirm_thead = '';
  if(data_array['tableName'] == 'trucks'){
 
	  // hide all in the add div  inputs and show supplier inputs
	  $('div#add input[type="text"], div#add textarea').hide();
	  $('div#add input[type="text"], div#add textarea').parent().closest('li').hide();
   
	  
	  $('div#add .trucks').css({'display' : '' });
	  $('div#add .trucks').parent().closest('li').css({'display' : '' });
		  
	 
		title = (data_array['status'] != 'add')?'Editing Truck':'Adding Trucks';
		
		confirm_thead = '<th>Truck No</th><th>From</th><th>To</th><th>Cost</th><th>Description</th><th>Driver Name</th><th>driver License No</th><th>mobile</th><th>Expense Cost</th><th>Date</th>';
 
       $('div#add .driverName').val(data_array['driverName']);
       $('div#add .driverLicenseNo').val(data_array['driverLicenseNo']);
	   

       $('div#add .truck_no').val(data_array['truck_no']);
       $('div#add .mobile').val(data_array['mobile']);
			
			
				 if(data_array['status'] == 'add'){
					$(' .toggleExpli').html('<label> Add Expenses  <input type="checkbox" class="toggleExp trucks  expense"></label>');
				 }else{
					 $('.toggleExpli').html('');
					 
				 }	   	
			expenseToggle('div#add_tabs_','hide');
		

         totals_thead  = '<th> Total Cost </th> ';
  }else if(data_array['tableName'] == 'expense'){
	      $(' div#add .driverLicenseNo').attr('placeholder',"optional").attr('required_error',"");
	$('div#add .truck_no ').attr('placeholder',"optional").attr('required_error',"");
	
	    // hide all in the add div  inputs and show others inputs
	  $('div#add input[type="text"], div#add textarea').hide();
	  $('div#add input[type="text"], div#add textarea').parent().closest('li').hide();
   
	  $('div#add .expense').css({'display' : '' });
	  $('div#add .expense').parent().closest('li').css({'display' : '' });
	  
	  	 title = 'Adding Expense';
	  confirm_thead = '<th> Name</th><th>Quantity</th><th>Type </th><th>Cost</th><th>Date</th><th>Description</th>';
  totals_thead  = '<th> Total Cost </th> ';
		title = (data_array['status'] != 'add')?'Editing expense':'Adding expense';
		
      $('.toggleExpli').html('');
	  expenseToggle('div#add_tabs_','show');
  } 
  
     if(data_array['status'] == 'add'){
			   $('div#add .add_more').show(); 
			
		   }else{
			    
			    $('div#add .add_more').hide();
		   }
		   
     if(data_array['status'] == 'editTruck'){
	   	  $('div#add input[type="text"], div#add textarea').hide().val('0');
	      $('div#add input[type="text"], div#add textarea').parent().closest('li').hide();
       
	   $('div#add .truck_no,.driverName,.driverLicenseNo,.mobile').css({'display' : '' });
	   $('div#add .truck_no,.driverName,.driverLicenseNo,.mobile').parent().closest('li').css({'display' : '' });
	 
	  
	   $('div#add .truck_no').val(data_json.truck_no);
	   $('div#add .driverName').val(data_json.driverName);
	   
	       
			 $('div#add .mobile').val(data_json.mobile);
			 $('div#add .driverLicenseNo').val(data_json.driverLicenseNo);
			 
	   title = 'Editing Truck';//(data_array['status'] != 'add')?'Editing expense':'Adding expense';
		expenseToggle('div#add_tabs_','hide');
      }else if(data_array['status'] == 'editDriver'){
		    title = 'Editing Truck';//(data_array['status'] != 'add')?'Editing expense':'Adding expense';

		   $('div#add input[type="text"], div#add textarea').hide().val('0');
		   $('div#add input[type="text"], div#add textarea').parent().closest('li').hide();
       
		   $('div#add .driverName,.driverLicenseNo,.mobile').css({'display' : '' });
		   $('div#add .driverName,.driverLicenseNo,.mobile').parent().closest('li').css({'display' : '' });
		   
		   expenseToggle('div#add_tabs_','hide');
		
      
	  }else{

				 if(data_array['status'] != 'add'){

		 $('.toggleExpli').html('');
			 // Default data while editing 
				
				$('div#add .mobile').hide().parent().closest('li').hide(); // hide from editing  
				$('div#add .eecost').hide().parent().closest('li').hide(); // hide from editing 
				
				
					$('div#add .truck_no').val(data_json.truck_no);
				   $('div#add .driverName').val(data_json.driverName);
				  
					
						 $('div#add .driverLicenseNo').val(data_json.driverLicenseNo);
						 
				  $('div#add .from').val(data_json.source);
				  $('div#add .to').val(data_json.distination);
				  $('div#add .totalCost').val(data_json.cost);
				  $('div#add .description').val(data_json.description);
					$('div#add .single_cost').val(data_json.unit_price);
					$('div#add .quantity').val(data_json.quantity);
				
				if(data_array['tableName'] == 'expense'){
				  $('div#add .name').val(data_json.name);
				  $('div#add .equantity').val(data_json.quantity);
				  $('div#add .eType').val(data_json.type);
				  $('div#add .ecost').val(data_json.cost);
				  $('div#add .edescription').val(data_json.description);
				  $('div#add .date').val(data_json.date);
				//  alert('000');
				  }
				 }
			     
}
		
 		    // detecting adding to existing truck
		   if(data_array['status'] == 'add' && $.trim(data_json) != ''){
			  $('div#add .truck_no').val(data_json.id);
	          $('div#add .driverName').val(data_json.driverName);  
			  $('div#add .mobile').val(data_json.mobile);
			  $('div#add .driverLicenseNo').val(data_json.licenseNo);
			 
			 title = (data_array['tableName'] == 'expense')?'Adding expenses to Truck ('+data_json.id+')':'Adding Trip to Truck ('+data_json.id+') ';
  
		   }
		   
		   
		  
					
			
		   buttonVal = (data_array['status'] != 'add')?"OK":"Confirm";
$('div#add').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Confirm": function() {
				 
				        var data = new Array();
	                    var id = (data_json.id)?data_json.id:'';
                        confStatus = 'off';
					//	data_array['tableName'] = (data_array['tableName'] == 'registerd_trucks')?'trucks':data_array['tableName'];

						total = $('div#add .'+jQuery.trim(data_array['tableName'])).length;
						
						//alert(total);
						$('div#add .'+jQuery.trim(data_array['tableName'])).each( function(index) {
						 
						  var tab_Class = $(this).attr('tab_id');
						  tab_Class = (jQuery.trim(tab_Class))?tab_Class:'tab_link';
						
						  var error_msg = $(this).attr('error_msg');
						  var required_error = $(this).attr('required_error'); 
						  var value = $(this).val().replace(/,/g, ''); 
						  var collName = jQuery.trim($(this).attr('collmName')); 
						  //($('div#add .name').val() == '' && collName == 'excost')?:;	
						  // validate 
						// alert(collName + ':'+ value);  
						  if(jQuery.trim(value) == '' && jQuery.trim(required_error) != ''){
							 
							 error_func(required_error);  
							  $(this).css('border','2px solid red');
							  $(this).focus();
							  document.getElementsByClassName(tab_Class)[0].click(); 
							 return false;
						   }else if(!isNumeric.test($.trim(value)) && jQuery.trim(error_msg) != ''){
							 
							 document.getElementsByClassName(tab_Class)[0].click(); 
							 error_func(error_msg); 
							  $(this).css('border','2px solid red');
							  $(this).focus();	
                                  		
 	                              if($("#confirmation").closest('.ui-dialog').is(':visible')) { 
				                     $("div#confirmation").dialog("close");
				                  }
										
							 return false;
							  
						  }else{
							   
							  // push to the data with collmName
							 if(collName in data){
								
							      data[collName].push(value);  
							  }else{
								  data[collName] = new Array();
								  data[collName].push(value); 
								  
							  }
							
							// enable confimation box to open
							if (index === total - 1) {
                                         confStatus = 'on';
							//			  alert(index + ': on '+ total);  
                              }else{
							// alert(index + ':'+ total);  
							  }
							  
							  
						  }
						  
						  
						  
						});				 
               
			 
     if(confStatus != 'off'){
	
                      // confation start
				  if(data_array['status'] == 'add'){	 
	                     var confirmation  = '<table id="confima_table"   cellpadding="0" cellspacing="0" border="0" class="display" width="100%">   <thead> <tr>'+confirm_thead+' </tr></thead> <tbody>'; 
		      
					  
				   if(data_array['tableName'] == 'trucks'){
							lengthData = data['driverLicenseNo'].length;				
						}else if(data_array['tableName'] == 'expense'){
							lengthData = data['name'].length;
						}
									   
							  for (x = 0; x < lengthData; x++) { 
									 if(data_array['tableName'] == 'trucks'){
											confirmation +=   '<tr> <td>'+data['truck_no'][x]+'</td> <td>'+data['source'][x]+'</td><td>'+data['distination'][x]+'</td><td>'+CommaFormattedN(data['cost'][x])+'</td><td>'+data['description'][x]+'</td><td>'+data['driverName'][x]+'</td><td>'+data['driverLicenseNo'][x]+'</td><td>'+data['mobile'][x]+'</td><td>'+CommaFormattedN(condFunction(jQuery.trim(data['excost'][x]) == '','0',data['excost'][x]))+'</td><td>'+data['date'][x]+'</td></tr>';
									  }else if(data_array['tableName'] == 'expense'){
											confirmation +=   '<tr> <td>'+data['name'][x]+'</td> <td>'+CommaFormattedN(data['equantity'][x])+'</td><td>'+data['type'][x]+'</td><td>'+CommaFormattedN(data['excost'][x])+'</td><td>'+data['edate'][x]+'</td><td>'+data['edescription'][x]+'</td></tr>';
									   }
							   
								 }
					                   conf_title = 'Confirmation';
									// totals in confirmation
									 if(data_array['tableName'] == 'trucks'){
												totals_row =  '<td>'+CommaFormattedN(data['cost'].reduce(function(a, b){return Number(a)+Number(b);}))+'</td>'; 
		                                }else if(data_array['tableName'] == 'expense'){
												 totals_row =  '<td>'+CommaFormattedN(data['excost'].reduce(function(a, b){return Number(a)+Number(b);}))+'</td>'; 
										}
					
								var totals = "<table class='table'>  <thead><tr> "+totals_thead+"</tr></thead><tr>"+totals_row+"</tr> </table>";		 
								 confirmation +='</tbody></table> '+totals;
 
			                   
									// alert(data_array['status']);
									$("div#confirmation").html(confirmation).dialog({  show: "blind", hide: "explode", width: 'auto', position:'top', height:'auto',  modal: true, buttons:  {
											"Agree": function() {
												
											     //console.log(data['date']);
											          // agreed  
									                  loading_func(); // SHOW LOADING animation dialog   
													  
										 	          $.post('php_f/add.php', {equantity:data['equantity'],unit_price:data['unit_price'], tableName:data_array['tableName'],status:data_array['status'],name:data['name'],type:data['type'],edate:data['edate'],excost:data['excost'],edescription:data['edescription'],quantity:data['quantity'],truck_no:data['truck_no'],cost:data['cost'],date:data['date'],description:data['description'],driverLicenseNo:data['driverLicenseNo'],driverName:data['driverName'],ecost:data['ecost'],mobile:data['mobile'],source:data['source'],distination:data['distination'] }, function(feedback_add) {					
													 
														if(jQuery.trim(feedback_add) == ''){
															window.location.reload;
														}else if(jQuery.trim(feedback_add) == '1'){
															
															$('div#loading').dialog("close");
														    $("div#confirmation").dialog("close");
															$('div#add').dialog("close");
															autoComplate('h'); // update autoComplate
															
															if('1' == '3'){
														//    load_function('','suppliers-history',,'suppliers-history');
															 }else{
															     tableElement1.click();
																 if($.trim(tableElement2) != ''){
																	  tableElement2.click();
																 }
																
															 }
																success_func('Successful');
																
														}else{
														     error_func(feedback_add);
															$('div#loading').dialog("close");
														}
								 
								 
							                     }).error(function(){
			 
																 error_func('Network Error please try Again or refresh the bage');
															 });
												 
											},
												
											"Cancel": function() {
													
													$(this).dialog("close");
												}
											},
									 });	 
			    				
										
						   // apply dataTable to confirmation box
						  $("div#confirmation table:first").dataTable({
									 "sPaginationType":"full_numbers",
									  "bJQueryUI":true
								 });
								 
							 $('div [aria-describedby="confirmation"] div:first span').text(conf_title); 
								 }else{
									 // alert('seding');  
									   loading_func(); // SHOW LOADING animation dialog    
													  console.log(data_array['unit_price']);
										 	$.post('php_f/add.php', { unit_price:data['unit_price'],id:data_json.id,tableName:data_array['tableName'],status:data_array['status'],name:data['name'],type:data['type'],edate:data['edate'],excost:data['excost'],edescription:data['edescription'],equantity:data['equantity'],quantity:data['quantity'],truck_no:data['truck_no'],cost:data['cost'],date:data['date'],description:data['description'],driverLicenseNo:data['driverLicenseNo'],driverName:data['driverName'],ecost:data['ecost'],mobile:data['mobile'],source:data['source'],distination:data['distination'] }, function(feedback_add) {					
													 												 
														if(jQuery.trim(feedback_add) == ''){
															window.location.reload;
														}else if(jQuery.trim(feedback_add) == '1'){
														
															$('div#loading').dialog("close");
														    $('div#add').dialog("close");
															autoComplate('h'); // update autoComplate
															
															
															     tableElement1.click();
																 if($.trim(tableElement2) != ''){
																	  tableElement2.click();
																 }
																 
																success_func('Successful');
																
														}else{
														     error_func(feedback_add);
															$('div#loading').dialog("close");
														}
								 
								 
							                     }).error(function(){
			 
																 error_func('Network Error please try Again or refresh the bage');
															 });
												 
									
								}
								
						 
							
							
						 
         }
						 },
							
							"Cancel": function() {	 
									$(this).dialog("close");
								}
						
						
						
						},
			   
							
							});
       
		
		$('div [aria-describedby="add"] div:first span').html(title);
$('div [aria-describedby="add"] .ui-dialog-buttonset button:first span').html(buttonVal);		
       autocompleteCach('','');   
}
       
  	
 // edit
function  edit(tableElement,data_json){    // 'type',etc // add more supleryers and workers then show confirmation box with agree button done
  // data_json = JSON.parse(data_json);
 // autoComplate_values();  
       //  console.log(data_json);
	   currentTruckInfo = data_json;
add(tableElement,'',getAddArgs(data_json.tableName,'','',data_json.addStatus),data_json)	   
	 return false

}
       
  	


	
// delete function
function delete_(tableElement,id,tableName,id_coll_name){
 
	   $('#warning').html('<img src="css/warning.png" alt="warning" style="border-radius:2.5em; width:80px; height:40px; margin-right: 4px; "/> Are sure you want to delete ?').dialog({ position:[50, 'top'], show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Yes": function() {
							 // delete the current Item 
							  
							 
							  loading_func(); // SHOW LOADING IMAGE DIALOG
							$.post('php_f/delete.php', {id:id,tableName:tableName,id_coll_name:id_coll_name}, function(feedback_delete) {					
								
								if(jQuery.trim(feedback_delete) == ''){ 
								     window.location.reload();
								 }else if(feedback_delete == '1'){ 
								      $("#loading").dialog('close');  $('#warning').dialog('close'); 
									  success_func('successfully Deleted !!');
									  
									  	if($.trim(tableName) == 'suppliers-history'){   
										          
												 load_function('','suppliers-history',currentViewingSupplier,'suppliers-history');
									     }else{
											 	 tableElement.click();
										 }
															 
								
									 // $('table.'+autoUpdate.tableClassName).dataTable().fnDestroy();
									  
									// apply_dataTable(autoUpdate.other_query,autoUpdate.tableName,autoUpdate.primaryKey,autoUpdate.collms,autoUpdate.tableClassName,autoUpdate.table_thead);
								 }else{
								  $("#loading").dialog('close'); 
								  error_func(feedback_delete);
								}
								
							}).error(function(){
			 
																 error_func('Network Error please try Again or refresh the bage');
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
  
	
// Restore function
function restore(tableElement,id,tableName,id_coll_name){
 
	   $('#warning').html('<img src="css/warning.png" alt="warning" style="border-radius:2.5em; width:80px; height:40px; margin-right: 4px; "/> Are sure you want to Restore ?').dialog({ position:[50, 'top'], show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Yes": function() {
							 // restore per tab, per row, and restore all 
							 
							  
							 
							  loading_func(); // SHOW LOADING IMAGE DIALOG
							$.post('php_f/restore.php', {id:id,tableName:tableName,id_coll_name:id_coll_name}, function(feedback_restore) {					
								
								if(jQuery.trim(feedback_restore) == ''){ 
								     window.location.reload();
								 }else if(feedback_restore == '1'){ 
								      $("#loading").dialog('close');  $('#warning').dialog('close'); 
									  success_func('successfully Restored !!');
									    tableElement.click();
								 }else{
								  $("#loading").dialog('close'); 
								  error_func(feedback_restore);
								}
								
							}).error(function(){
			 
																 error_func('Network Error please try Again or refresh the bage');
															 });
							 
							 
							 
						 },
							
						"No": function() {	 
								$(this).dialog("close");
							}
						},
			   
							
							});
		  $('div [aria-describedby="warning"] div:first span').text('Restoring... '); 					
 
return false;
}
  
						 
	// remove button
	$(document).on( 'click', '.remove-tab', function () {   
               
				$('#addTabs div.tabs_contents').last().remove();	
				  $('#add_tabs_handler li').last().remove();	
		         var last_tab_ = $('#add_tabs_handler li a').last().attr('class');
	 
                  document.getElementsByClassName(last_tab_)[0].click(); 								  
	});
  
  
	// auto calculate
	$(document).on('keyup', '.noOfWorkers, .cost, .w_single_cost, .quantity, .single_cost, .totalCost, .amount_paid', function () {   
                 tab_div_id =  $('.'+$(this).attr('tab_id')).attr('href');
			     tab_div_id = (jQuery.trim(tab_div_id))?tab_div_id:'#add_tabs_';
				 tab_div_id = tab_div_id.replace(/#/g, ''); 
				  if($(this).hasClass('single_cost')){
							 auto_calc(tab_div_id,'totalCost');
				  }else if($(this).hasClass('totalCost') ||  $(this).hasClass('quantity')){
							  auto_calc(tab_div_id,'single_cost');
				  }else if($(this).hasClass('amount_paid')){
							  auto_calc('','');
							  
							  
				  }else if($(this).hasClass('w_single_cost')){
							 auto_calc(tab_div_id,'cost');
				  }else if($(this).hasClass('cost') ||  $(this).hasClass('noOfWorkers')){
							  auto_calc(tab_div_id,'w_single_cost');
				  }
 		  
	});   
	 
	 	// tab title and box title
	$(document).on( 'blur', '.truck_no, .name', function () {   
	      value = $(this).val();
	      tab_Class = $(this).attr('tab_id');
		  tab_Class = (jQuery.trim(tab_Class))?tab_Class:'tab_link';
	
	if(jQuery.trim(value) != '' ){
			  $('.'+tab_Class).text(value);	 
	    }	
	
 
	});
	
	
		// toggle expenses

$(document).on( 'click', '.toggleExp', function () {   

					if ($(this).is(':checked')){
								
					expenseToggle('#'+$(this).parent().parent().parent().parent().attr('id'),'');
					}else{						
					expenseToggle('#'+$(this).parent().parent().parent().parent().attr('id'),'hide');
				   
					}


});
	
	
	


					 // projects name 			 
				  $(document).on('change','.projects_list',function(){
						  floars = $(this).attr('floars');
						  discription = $(this).attr('discription');
						  val = $(this).val();
					  if(val == 'new'){
						   $('.changeTo').fadeIn().find('span').show().find('input').focus();
						   $('.changeTo').fadeIn().find('span').text('Change To :');
						   $('.pro_description').val('');
						   
						  }else{
							   $('.pro_description').val(discription);
							   $('.changeTo').fadeIn().find('span').hide();
							   $('.changeTo').fadeIn().find('span').show().find('input').focus();
							   $('.floarsTitle').text('Floors for <b style="color:blue;">'+val+'</b>');
							   $('.modify_project_f').html(floars).fadeIn();
							   $('.modify_project_f select').chosen();
						  }		
		 
					  });
     
						// change floors names
		  		  $(document).on('change','.projects_list_floars',function(){
			         val = $(this).val();
							  if(val == 'new'){
									$('.changeTo').fadeIn().find('span').hide(); 
									
								}else{
								  
									$('.changeToF').fadeIn().find('span').show(); $('.changeToF').find('input').focus();
									$('.changeToF').find('span').text('Change To :');
								 
								  }		
  
		             });
 

  $(document).ready(function() {
	           autoComplate('h'); // update autoComplate
	      // load_function('suppliers_main_div','trucks','','trucks');
                      $('#projects_accordion').accordion(); 
					  
		              $('body').fadeIn(); 
					  $('.date').datepicker({dateFormat:"yy-m-dd"});
                      $('div#main_tabs,div#addTabs').tabs();
                      $('div#settings p a').button({height:'7px', icons: {primary: 'ui-icon-pencil', secondary: null} }).css('font-size','11px');
                      
					 
	               
					
				   // load_function('suppliers_main_div','suppliers','','suppliers');// show suppleirs for the first time

	 // add more tabs button
	$('.add_more').click(function (){
 
		var second_tab_div = $('div#add_tabs_').html();			
		var current_count = $('#add_tabs_handler li').length;
		var next_count  =  current_count + 1;
		
 
   
		 $('#add_tabs_handler').append('<li><a href="#add_tabs_'+next_count+'" class="tab_link'+next_count+'" >Tab '+next_count+' </a></li>');	 
		 $('#addTabs').append('<div id="add_tabs_'+next_count+'" class="tabs_contents" > '+second_tab_div+' </div>');
       
	    // remove unwhanted fields from other tabs 
		if($('div#add_tabs_ .productName') && addingStatus == 's'){
	    $('div#add_tabs_'+next_count+' .name,div#add_tabs_'+next_count+' .identity, div#add_tabs_'+next_count+' .mobile ').parent().closest('li').remove();
        }
		$('div#add_tabs_'+next_count+' .date').removeClass('hasDatepicker').removeAttr('id').datepicker({dateFormat:"yy-m-dd"}); // remove date fields from other tabs
	    $('div#add_tabs_'+next_count+' .date').val(currentDateDefault);

	 
		 autocompleteCach('div#add_tabs_'+next_count+'');
		 
				// clone default data
			  $('div#add_tabs_'+next_count+' .truck_no').val(currentTruckInfo.id);
	          $('div#add_tabs_'+next_count+' .driverName').val(currentTruckInfo.driverName);  
			  $('div#add_tabs_'+next_count+' .mobile').val(currentTruckInfo.mobile);
			  $('div#add_tabs_'+next_count+' .driverLicenseNo').val(currentTruckInfo.licenseNo);
  
		 // insert tab id into each element in that tab 
	    $('div#add_tabs_'+next_count+' * ').attr('tab_id','tab_link'+next_count+'');
 	    $('div#add_tabs_'+next_count+'').append('<button class="remove-tab ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" hover="click to Remove Tab " role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span><span class="ui-button-text">Remove</span></button>');
   $('div#addTabs').tabs("refresh");
         document.getElementsByClassName('tab_link'+next_count)[0].click();   // jump to the new tab
	
	});
	
	

					  
					  
			// logout 
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
});
			
					  
/*  $('.date').keyup(function(){
      error_func('please use Date pr');  
      return false;
 }); */
			
 		  
	      });
   
		  
		  
		  
		  
		  
		  
		  
 
