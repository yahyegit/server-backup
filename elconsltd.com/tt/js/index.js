// some public variables

 var  payment_name = '';
 var description_payment  = '';
 var payment_amount = '';
 var paymentDate = '';
var test = '';
var currentViewingSupplier = '';

totalsArray_main  = {p:{},o:{},w:{}};
	
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
				   "aLengthMenu": [				
							[25, 50, 100, 200, -1],
							[25, 50, 100, 200, "All"]
						],
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
 
 
	  if(jQuery.trim(tableName) == 'suppliers'){ // suppliers  main tabs  all and debt
	 
	 		    // aplly datable now 
	         apply_dataTable(other_query,tableName,primaryKey,collms,tableClassName,'<thead><tr><th>Supplier Name</th><th>Mobile</th><th>Total Cost</th><th>Total Paid </th><th>Balance</th> <th> Created Date </th> <th class="actions_collm_data">Actions</th></tr></thead>');
 
	  }else if(jQuery.trim(tableName) == 'suppliers-history'){  // if supplier account
	          // aplly datable now 
		 
            
			  apply_dataTable(other_query,tableName,primaryKey,collms,tableClassName,'<thead><tr>'+condFunction(other_query.match(/project-name/g) || jQuery.trim(other_query) == 'trash' ,'<th>Supplier Name</th><th>Mobile</th>','')+'<th>Product Name</th><th>Quantity</th><th>Single Cost</th><th>Total Cost </th><th>Paid</th>  <th> Balance </th> <th> Date </th> <th>Project Name</th><th>Floor No</th>'+condFunction(other_query.match(/project-name/g),'','<th class="actions_collm_data">Actions</th>')+'</tr></thead>');

	  
	  }else if(jQuery.trim(tableName) == 'workers'){ // if workers 
	  // aplly datable now   
	  apply_dataTable(other_query,tableName,primaryKey,collms,tableClassName,'<thead><tr><th>Name</th><th>ID/Passport</th><th>Work type</th><th>Number of Workers </th><th>Single Cost</th><th>Cost</th><th>Date</th><th>Project Name</th> <th>Floor No</th> '+condFunction(other_query.match(/project-name/g),'','<th class="actions_collm_data" >Actions</th>')+'</tr></thead>');
 
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
           var add_btn = '<a onclick=\"add($(this).parents().parents().find(\'table.dataTable:first th:first\'),\'\',getAddArgs(\'workers\',\'\',\'\',\'\')); \" class=" ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" style="float: left; font-size: 0.7em;" title="" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-circle-plus"></span><span class="ui-button-text">Add Workers </span></a>  ';
	    
           // creating tabs from objects
	     var type_tabs = '';
		 var type_divs = '';
		 var i = 0;
		       path = path.split("/");
			   floorNo = path[1];
			   projecName = path[0];
			    path2 =  projecName+'/'+floorNo+'/Workers ';
				 path3 =  projecName+'/'+floorNo+'';
			 $.each(tabsNames_json.work_types, function(work_type, totalsArray){ 
			     uniqueTable += i;
			
			    unique_randon = Math.round(Math.random()*100) + ($('.workers_tbl').length + 1);  
			     unique_randon += 'w'+uniqueTable;
			   
			 projecs_query = "`project-name`='"+projecName+"' "+condFunction(jQuery.trim(floorNo) == 'All' || !jQuery.trim(floorNo),''," AND `floorNo`='"+floorNo+"' ");
			 cond = (work_type == 'All')?condFunction(projecName != '',projecs_query,''):' '+condFunction(projecName != '',projecs_query+' AND ','')+" `work-type`='"+work_type+"' ";
			 
			    type_tabs += '<li><a href="#w_tabs-'+i+'">'+work_type+'<span class="badge" >('+totalsArray[2]+')</span></a> </li>';	
				type_divs += '<div id="w_tabs-'+i+'"> <table table_query="'+cond+'" table_class_name="workers_table'+unique_randon+'"  class="workers_tbl workers_table'+unique_randon+' display" cellspacing="0" width="100%" ></table>'; //  tab with total
                   wwCost = '<table class="table" ><tr><th>'+condFunction(projecName == '','Total Number of '+work_type+' Workers','Total Number of '+work_type+' Workers for ('+path3+')')+'</th><th>'+condFunction(projecName == '','Total Cost of '+work_type+' Workers ','Total Cost of '+work_type+' Workers for ('+path3+')')+'</th> </tr><tr><td>'+totalsArray[3]+'</td><td>'+totalsArray[4]+'</td> </tr></table>';
				type_divs += wwCost+'</div>';
				
		      if(work_type == 'All'){
			            
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
			 
			 
			     projecs_query = "`project-name`='"+projecName+"' "+condFunction(jQuery.trim(floorNo) == 'All' || !jQuery.trim(floorNo),''," AND `floorNo`='"+floorNo+"' ");
			
				 cond = (productType == 'All')?condFunction(projecName != '',projecs_query,''):' '+condFunction(projecName != '',projecs_query+' AND ','')+" `product-type`='"+productType+"' ";
				
			    type_tabs += '<li><a href="#tabs-'+i+'">'+productType+'<span class="badge" >('+totalsArray[2]+')</span></a> </li>';	
				type_divs += '<div id="tabs-'+i+'"> <table  table_query="'+cond+'" table_class_name="products_table'+unique_randon+'"  class="products_tbl products_table'+unique_randon+' display" cellspacing="0" width="100%" ></table> ';
				
				 totalPd  = '<table class="table" ><tr><th>'+condFunction(projecName == '','Total Quantity','Total Quantity of '+productType+' Products for ('+path3+')')+'</th><th>'+condFunction(projecName == '','Total Cost','Total Cost of '+productType+' Products for ('+path3+')')+'</th> <th>'+condFunction(projecName == '','Total Paid','Total Paid of '+productType+' Products for ('+path3+')')+'</th> <th>'+condFunction(projecName == '','Total Balance','Total Balance of '+productType+' Products for ('+path3+')')+'</th></tr><tr><td>'+totalsArray[6]+'</td><td>'+totalsArray[3]+'</td><td>'+totalsArray[4]+'</td><td style="color:blue; font-weight:bold;">'+totalsArray[5]+'</td></tr></table>'; //  tab with total
                type_divs += totalPd+'</div>';
		 
			  if(productType == 'All'){
			            
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
	if(jQuery.trim(type) == 'trash'){
 
			$('#'+jQuery.trim(div_id)).html(progressBar+getTrash(tabsNames_json,'')).dialog({ position:[50, 'top'], show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"close": function() {
						    $(this).dialog('close');
							 
	                          }
							  } });				
		  $('div [aria-describedby="'+jQuery.trim(div_id)+'"] div:first span').text('Trash'); 					
          $('#'+jQuery.trim(div_id)+' div.trash_tabs_div').tabs();
  
 	 data_table_loader('trash','workers','id','id,name,id_or_passport,work-type,number-or-workers,cost,date,project-name,floorNo','workers_trash_table'); 	 
	 data_table_loader('trash','suppliers','supplier-account-id','supplier-account-id,supplier-name,mobile,total_total-Cost,total_paid,total_balance,created_date','suppleirs_trash_table');  // all suppliers table
	 data_table_loader('trash','others','id','id,name,cost,description,date,project-name,floorNo','others_trash_table');   
     data_table_loader('trash','suppliers-history','id','id,supplier-name,mobile,product-name,quantity,single-cost,total-Cost,paid,balance,date,project-name,floorNo','products_trash_table'); 
	 
     data_table_loader('trash','payment_history','id','id,paid,date,description','payments_trash_table');  // all payment-history  table
				
	}else if(jQuery.trim(type) == 'suppliers'){ // suppliers main tabs debs and all with e.g Debs(x)
       clear_main_divs(div_id);
	    var add_btn = '<h3 class="h3"> <a class=" ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" style="float: right; font-size: 0.7em; float: left;" title=" " role="button" aria-disabled="false" onclick="add($(this).parents().parents().find(\'table.dataTable:first th:first\'),$(this).parents().parents().find(\'table.dataTable:last th:first\'),getAddArgs(\'suppliers\',\'\',\'\',\'\'));"><span class="ui-button-icon-primary ui-icon ui-icon-circle-plus"></span><span class="ui-button-text">Add Supplier</span></a></h3>';
	 	var type_tabs = add_btn+'<div class="suppliers_tabs" style="clear:both;"><ul>  <li><a href="#tabs-1">All<span class="badge" >('+tabsNames_json.allCounts+')</span></a> </li><li><a href="#tabs-2">Debs  <span class="badge" >('+tabsNames_json.debsCounts+')</span></a></li> </ul> ';
		    type_tabs += '<div id="tabs-1"> <table class="all_suppleirs_table display" cellspacing="0" width="100%" ></table> <table class="table" ><tr><th>Total Cost</th> <th>Total Paid</th> <th>Total Balance</th> </tr><tr><td>'+tabsNames_json.total_Cost+'</td><td>'+tabsNames_json.total_Paid+'</td><td style="color:blue; font-weight:bold;">'+tabsNames_json.Total_Balance+'</td></tr></table> </div>'; // all supplier table with total
		    type_tabs += '<div id="tabs-2"> <table class="debs_suppleirs_table display" cellspacing="0" width="100%" ></table> <table class="table" ><tr><th>Total Cost</th> <th>Total Paid</th> <th>Total Balance</th> </tr><tr><td>'+tabsNames_json.total_d_Cost+'</td><td>'+tabsNames_json.total_d_Paid+'</td><td style="color:blue; font-weight:bold;">'+tabsNames_json.Total_d_Balance+'</td></tr></table> </div>'; // debs supplier table  with total
	    type_tabs += '</div>';
	     was_visible = condFunction($('#'+jQuery.trim(div_id)).is(':visible'),1,0);
				
		$('#'+jQuery.trim(div_id)).fadeOut().html(progressBar+''+type_tabs);
		$('#'+jQuery.trim(div_id)+' div.suppliers_tabs').tabs();
	 	if(was_visible){
			$('#'+jQuery.trim(div_id)).fadeIn();	
		}
		 
 
		$('li a[href="#'+jQuery.trim(div_id)+'"]').html('Suppliers <span class="badge" >('+tabsNames_json.allCounts+')</span>');
		
 
    data_table_loader('','suppliers','supplier-account-id','supplier-account-id,supplier-name,mobile,total_total-Cost,total_paid,total_balance,created_date','all_suppleirs_table');  // all suppliers table

	data_table_loader(' `total_balance`!=0 ','suppliers','supplier-account-id','supplier-account-id,supplier-name,mobile,total_total-Cost,total_paid,total_balance,created_date','debs_suppleirs_table');  // all suppliers table
      	
	
	  }else if(jQuery.trim(type) == 'suppliers-history'){  // if supplier account
	        // header buttons
           var add_btn = '<a onclick="add($(this).parents().parents().find(\'table.dataTable:first th:first\'),$(this).parents().parents().find(\'table.dataTable:last th:first\'),getAddArgs(\'suppliers\',\''+tabsNames_json.id+'\',\''+tabsNames_json.name.replace(/"/g, '').replace(/\'/g,'')+'\',\''+tabsNames_json.mobile+'\'));" class=" ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" style="float: left; font-size: 0.7em;" title="" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-circle-plus"></span><span class="ui-button-text">Add Products To ('+tabsNames_json.name+') </span></a>  ';
	       var make_payment_btn =  (tabsNames_json.product_types.All[5] !='0.00')?"<button onclick=\"make_payment(getAddArgs_payment('"+tabsNames_json.product_types.All[5].replace(/,/g, '')+"','"+tabsNames_json.id+"','"+tabsNames_json.name.replace(/"/g, '').replace(/\'/g, '')+"'));\" class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' style='float: left; font-size: 0.7em;' title='' role='button' aria-disabled='false'><span class='ui-button-icon-primary ui-icon ui-icon-mony'></span><span class='ui-button-text'>Make Payment</span></button>":'';
		   var payment_history =  (tabsNames_json.product_types.All[4] !='0.00')?"<button onclick=\"payment_history('"+tabsNames_json.id+"','"+tabsNames_json.name.replace(/"/g, '').replace(/\'/g, '')+"','"+tabsNames_json.mobile+"','"+tabsNames_json.product_types.All[4]+"','"+tabsNames_json.product_types.All[5]+"');\" class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' style='float: left; font-size: 0.7em;' title='' role='button' aria-disabled='false'><span class='ui-button-icon-primary ui-icon ui-icon-mony'></span><span class='ui-button-text'>Payment History</span></button>":'';
           currentViewingSupplier = tabsNames_json.id;
		   
           // creating tabs from objects
	     var type_tabs = '';
		 var type_divs = '';
		 var i = 0;
			 $.each(tabsNames_json.product_types, function(productType, totalsArray){ 
			 
			    payment_action = (totalsArray[5] !='0.00' && productType == 'All')?'<th>Action</th>':'';
				payment_bnt =  (totalsArray[5] !='0.00' && productType == 'All' )?"<td><button onclick=\"make_payment(getAddArgs_payment('"+tabsNames_json.product_types.All[5].replace(/,/g, '')+"','"+tabsNames_json.id+"','"+tabsNames_json.name.replace(/"/g, '').replace(/\'/g, '')+"'));\"  class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' style='float: right; font-size: 0.7em;' title='' role='button' aria-disabled='false'><span class='ui-button-icon-primary ui-icon ui-icon-mony'></span><span class='ui-button-text'>Make Payment</span></button></td>":'';
		 
			    type_tabs += '<li><a href="#tabs-'+i+'">'+productType+'<span class="badge" >('+totalsArray[2]+')</span></a> </li>';	
				type_divs += '<div id="tabs-'+i+'"> <table class="suppleir_table'+i+' display" cellspacing="0" width="100%" ></table> <table class="table" ><tr><th>Total Quantity for '+productType+' </th><th>Total Cost for '+productType+'</th> <th>Total Paid for '+productType+'</th> <th>Total Balance for '+productType+'</th>'+payment_action+'</tr><tr><td>'+totalsArray[6]+'</td><td>'+totalsArray[3]+'</td><td>'+totalsArray[4]+'</td><td style="color:blue; font-weight:bold;">'+totalsArray[5]+'</td>'+payment_bnt+'</tr></table> </div>'; //  tab with total
                    i++;
				});
	          type_tabs += '</ul>'; 
			  
		  var complete_tabs = '<h3 class="h3">'+add_btn+'|  '+make_payment_btn+' | '+payment_history+'</h3>  <div class="supplier_tabs_div" style="clear:both;"><ul> '+type_tabs+'</ul>'+type_divs+'</div>';
	 
	   $('#suppliers-history').html(complete_tabs).dialog({ position:[50, 'top'], show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"close": function() {
						    $(this).dialog('close');
							 
	                          }
							  } });				
		  $('div [aria-describedby="suppliers-history"] div:first span').text('Products for '+tabsNames_json.name+' ('+tabsNames_json.mobile+')'); 					
 
 
 
	   $('#suppliers-history div.supplier_tabs_div').tabs();
		     // end creating tabs
			 
			 // applying dataTables
		     i = 0;
		  $.each(tabsNames_json.product_types, function(productType, totalsArray){ 
		            cond = (productType == 'All')?'`supplier-account-id`="'+tabsNames_json.id+'"':'`product-type`="'+productType+'" AND `supplier-account-id`="'+tabsNames_json.id+'"';
				    data_table_loader(cond,'suppliers-history','id','id,product-name,quantity,single-cost,total-Cost,paid,balance,date,project-name,floorNo','suppleir_table'+i); 
				i++;
				});
	  
	  }else if(jQuery.trim(type) == 'workers'){ // if workers 
           clear_main_divs(div_id);
       was_visible = condFunction($('#'+jQuery.trim(div_id)).is(':visible'),1,0);
		$('#'+jQuery.trim(div_id)).fadeOut().html(progressBar+getWorkers(tabsNames_json,''));
		$('#'+jQuery.trim(div_id)+' div.workers_tabs_div').tabs();
		   
			
		if(was_visible){
			$('#'+jQuery.trim(div_id)).fadeIn();	
		}
		
 
		$('li a[href="#'+jQuery.trim(div_id)+'"]').html('Workers <span class="badge" >('+tabsNames_json.work_types.All[2]+')</span>');
 
	 // end creating tabs
			 
	  // applying dataTables
		 $('#'+jQuery.trim(div_id)+' .workers_tbl').each(function(){  
			   var cond =  $(this).attr('table_query');
			   var uniqueClassName = $(this).attr('table_class_name');
			           data_table_loader(cond,'workers','id','id,name,id_or_passport,work-type,number-or-workers,w_single_cost,cost,date,project-name,floorNo',uniqueClassName); 	
			}); 
	  
		 
		 
	  }else if(jQuery.trim(type) == 'projects'){ // creates sub tabs for projects 
           clear_main_divs(div_id);
		 
           // creating tabs from objects
	     var projecs_tabs = '';
		 var projecs_divs = '';
		 var i = 0;
		 
		 
		 
       $.each(tabsNames_json.projects, function(projecName,l){ 
		 
                projecs_tabs += '<li><a href="#p_tabs-'+i+'">'+projecName+'<span class="badge" >('+l.allCounts+')</span></a> </li>';

				
				floorsTabs = '';
				floors_divs = '';
				 
				
			       c = 0;
						// floors for current projecName
					 $.each(l, function(floorNo,count){ 
					
							   if(floorNo != 'allCounts'){
                                path = projecName+'/'+condFunction(jQuery.trim(floorNo) == 'All','',floorNo);
                                 pp = json_loaded_data = JSON.parse(count.products);
                                 ww = json_loaded_data = JSON.parse(count.workers);
                                 oo = json_loaded_data = JSON.parse(count.others);								  
						    
								 var floorCont_tabs = '<h3>'+path+'</h3><div class="tabs_mulitple_all flc_tabs_'+i+'_'+c+'" style="clear:both;"><ul>  <li><a href="#flc-w-tabs-'+i+'_'+c+'">Workers <span class="badge" >('+ww.work_types.All[2]+')</span></a> </li> <li><a href="#flc-p-tabs-'+i+'_'+c+'">Products <span class="badge" >('+pp.product_types.All[2]+')</span></a> </li> <li><a href="#flc-o-tabs-'+i+'_'+c+'">Others <span class="badge" >('+oo.allCounts+')</span></a> </li> </ul> ';
									 floorCont_tabs += '<div id="flc-w-tabs-'+i+'_'+c+'"> '+getWorkers(ww,path)+'</div>'; // get workers
									 floorCont_tabs += '<div id="flc-p-tabs-'+i+'_'+c+'"> '+getProducts(pp,path)+'</div>'; // get products
									 floorCont_tabs += '<div id="flc-o-tabs-'+i+'_'+c+'"> '+getOthers(oo,path)+'</div>'; // get Others
									 floorCont_tabs += '</div>';
					
		 
							   floorsTabs += '<li><a href="#fl_tabs-'+i+'_'+c+'">'+floorNo+' </a> </li>';	
							   floors_divs += '<div id="fl_tabs-'+i+'_'+c+'"> '+floorCont_tabs+' </div>';  
                   
		  
						       }
						 c++;	   
					   });
				  path = projecName+'/';	  
                 f = path.charAt(0).toUpperCase();
 
				 //  current projects totals
            	/* 	tCostOthers	 = JSON.parse(l.All.others);
					tCostOthers.all.all_cost;
					
					tCostW = JSON.parse(l.All.workers);
					tCostW.work_types.All[2] */
					
					
                  complete_floor_tabs = '<h3 style="border-bottom: 2px solid blue; width: 403px;">'+'<b style="color:blue;">'+f+'</b>'+path.slice(1)+' <button onclick=\'export_fun("'+projecName+'")\' class=" ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" style="/* float: left; */ font-size: 0.7em;width: 148px;height: 30px;font-weight: bold;border: 2px solid blue;" title="" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-print" style="zoom: 1.4;"></span><span class="ui-button-text"> Print Reports </span></button></h3> <div class="tabs_mulitple_all floors_tabs_div_'+i+'" style="clear:both;"><ul> '+floorsTabs+'</ul>'+floors_divs+'</div>';
	 	  
		       
                 projecs_divs += '<div id="p_tabs-'+i+'"  >  '+complete_floor_tabs+' </div>';   
	 
					   
				  i++;	   
				});
		complete_projects_tabs = ' <div class="projecs_tabs_main" style="clear:both;"><ul> '+projecs_tabs+'</ul>'+projecs_divs+'</div>';
	 	   		
	 //complete_projects_tabs
	     was_visible = condFunction($('#'+jQuery.trim(div_id)).is(':visible'),1,0);
				
 		$('#'+jQuery.trim(div_id)).fadeOut().html(progressBar+complete_projects_tabs);
		$('#'+jQuery.trim(div_id)+' div.projecs_tabs_main').tabs();
		$('#'+jQuery.trim(div_id)+' div.tabs_mulitple_all').tabs();
		if(was_visible){
			$('#'+jQuery.trim(div_id)).fadeIn();	
		}
	
		
		// done
  
			  // applying dataTables workers
		 $('#'+jQuery.trim(div_id)+' .workers_tbl').each(function(){  
			   var cond =  $(this).attr('table_query');
			   var uniqueClassName = $(this).attr('table_class_name');
			           data_table_loader(cond,'workers','id','id,name,id_or_passport,work-type,number-or-workers,w_single_cost,cost,date,project-name,floorNo',uniqueClassName); 	
			});  
		 
			  // applying dataTables products
		 $('#'+jQuery.trim(div_id)+' .products_tbl').each(function(){  
			   var cond =  $(this).attr('table_query');
			   var uniqueClassName = $(this).attr('table_class_name');
			           data_table_loader(cond,'suppliers-history','id','id,supplier-name,mobile,product-name,quantity,single-cost,total-Cost,paid,balance,date,project-name,floorNo',uniqueClassName); 
				});  
		 
		 	  // applying dataTables others
		 $('#'+jQuery.trim(div_id)+' .others_tbl').each(function(){  
			   var cond =  $(this).attr('table_query');
			   var uniqueClassName = $(this).attr('table_class_name');
			        data_table_loader(cond,'others','id','id,name,cost,description,date,project-name,floorNo',uniqueClassName);   
   	        });  
		 
		 
	  }else if(jQuery.trim(type) == 'others'){
		    clear_main_divs(div_id);
         was_visible = condFunction($('#'+jQuery.trim(div_id)).is(':visible'),1,0);
				
		 $('#'+jQuery.trim(div_id)).fadeOut().html(progressBar+getOthers(tabsNames_json,''));
		  	if(was_visible){
			   $('#'+jQuery.trim(div_id)).fadeIn();	
		    }
		 
		 
		
		$('#'+jQuery.trim(div_id)).fadeIn();
		 $('li a[href="#'+jQuery.trim(div_id)+'"]').html('Others <span class="badge" >('+tabsNames_json.allCounts+')</span>');
	     
		 	 	  // applying dataTables others
		 $('#'+jQuery.trim(div_id)+' .others_tbl').each(function(){  
			   var cond =  $(this).attr('table_query');
			   var uniqueClassName = $(this).attr('table_class_name');
			        data_table_loader(cond,'others','id','id,name,cost,description,date,project-name,floorNo',uniqueClassName);   
   	        });  
		
		 
	  }
	
	
}	

 				
 // autoComplate  cache
  autoComplateData = '';
 function autocompleteCach(parent_elem){
	 
	 
	       if($.trim(parent_elem) == ''){
			    $(".workType,.name,.mobile,.identity,.productName,.productType,.project_name,.floorNo").each(function(){
				 if($(this).hasClass("ui-autocomplete-input")) {
				        $(this).autocomplete("destroy");
				  }
			  });   
		   }
			
	 

				 $(""+parent_elem+" .workType").autocomplete({
					  source: autoComplateData['workTypes']
					});
					
		        // name
			    $(""+parent_elem+" .name").autocomplete({
					  source: autoComplateData['names']
					});
					
					 // mobile
			    $(""+parent_elem+" .mobile").autocomplete({
					  source: autoComplateData['mobiles']
					});
					 // identity 
			   $(""+parent_elem+" .identity").autocomplete({
					  source: autoComplateData['identitys']
					});
					
					 // productName   
			    $(""+parent_elem+" .productName").autocomplete({
					  source: autoComplateData['product_Names']
					});
						 // productType
			    $(""+parent_elem+" .productType").autocomplete({
					  source: autoComplateData['product_types']
					});
					
					 // project_name
			    $(""+parent_elem+" .project_name").autocomplete({
					  source: autoComplateData['project_names']
					});
					
								 // floorNo 
			    $(""+parent_elem+" .floorNo").autocomplete({
					  source: autoComplateData['floorNos']
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
		   loading_func();
	   }else{
		   $('div.progressbar').html(progressBar);
		    $('div.progressbar').attr('id','progressbar');
		   window.location.href = "#progressbar";
		}
	   $('#'+jQuery.trim(type_id)).show();
	$.post('php_f/load.php', {type_id:type_id,type:type,id:id,tableName:tableName}, function(json_loaded_data){	
             
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
 

 
 function payment_history(account_id,name,mobile,total_paid,total_balance){
	 
		    payment_hist_tables = '<table class="payment_history_table display" cellspacing="0" width="100%" ></table> <table class="table" ><tr><th> Total Paid </th> <th> Total Balance </th>  </tr> <tr> <td style="font-weight:bold;">'+total_paid+'</td><td style="color:blue;font-weight:bold;">'+total_balance+'</td></tr></table> ';
	   $('#payment_history').html(payment_hist_tables).dialog({ position:[50, 'top'], show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"close": function() {
						    $(this).dialog('close');
							 
	                          }
							  } });				
		  $('div [aria-describedby="payment_history"] div:first span').text('Payment History for '+name+' ('+mobile+')'); 					
 
		 data_table_loader('`supplier-account-id`="'+account_id+'"','payment_history','id','id,paid,date,description','payment_history_table');  // all payment-history  table
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
function getAddArgs(current_type,id,name,mobile){
	     add_args = new Array();
		 add_args['tableName'] = current_type;
		 add_args['name'] = name;
		  add_args['mobile'] = mobile;
		 add_args['supplier-account-id'] = id; 
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
 
 
 //----  
	   // number of workers
	var noOfWorkers = jQuery.trim($('#'+tab_id+' .noOfWorkers').val().replace(/,/g, '')); 
	    noOfWorkers = (!isNumeric.test(noOfWorkers))?0:noOfWorkers;	
		
	   // single cost for workers
	var ww_single_cost2 = jQuery.trim($('#'+tab_id+' .w_single_cost').val().replace(/,/g, '')); 
	    ww_single_cost2 = (!isNumeric.test(ww_single_cost2))?0:ww_single_cost2;	
		
	// total cost for workers
	var w_totalCost = jQuery.trim($('#'+tab_id+' .cost').val().replace(/,/g, '')); 
	    w_totalCost = (!isNumeric.test(w_totalCost))?0:w_totalCost;	
				
		
		 
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
  
  }
  
 // add  data_array['tableName'] supplier-account-id
function add(tableElement1,tableElement2,data_array){    // 'type',etc // add more supleryers and workers then show confirmation box with agree button done


  rest_tabs();


    $('div#add input[type="text"], div#add textarea').val('');
	
	check_date();
	
	
 var title = '';
 
  if(data_array['tableName'] == 'suppliers'){
   addingStatus = 's';
	  // hide all in the add div  inputs and show supplier inputs
	  $('div#add input[type="text"], div#add textarea').hide();
	  $('div#add input[type="text"], div#add textarea').parent().closest('li').hide();
   
	  
	  $('div#add .suppliers').css({'display' : '' });
	  $('div#add .suppliers').parent().closest('li').css({'display' : '' });
		  
	 
		title = condFunction(data_array['name'] != '','Supplier: '+data_array['name'],"Adding New Supplier");
		confirm_thead = '  <th>Product Name</th> <th> Product Type </th> <th>Quantity</th> <th>Single Cost</th> <th>Total Cost</th>  <th> Project Name </th> <th> Floor No </th>';  
        totals_thead  = '<th> Total Paid </th> <th> Total Balance </th> <th class="conf_action">Actions</th>';              
 
       $('div#add .name').val(data_array['name']);
       $('div#add .mobile').val(data_array['mobile']);


  }else if(data_array['tableName'] == 'others'){
   addingStatus = 'o';
	    // hide all in the add div  inputs and show others inputs
		 $('div#add input[type="text"], div#add textarea').hide();
		 $('div#add input[type="text"], div#add textarea').parent().closest('li').hide();
	     $('div#add .others').css({'display' : '' });  	  
		 $('div#add .others').parent().closest('li').css({'display' : '' });
	  	 title = 'Adding Others';
	 confirm_thead = '<th> Name </th> <th>Cost</th>  <th> Project Name </th> <th> Floor No </th> <th> Description </th>';  
	  totals_thead  = '<th> Total Cost </th>   ';
  }else if(data_array['tableName'] == 'workers'){
      addingStatus = 'w'; 
 	confirm_thead = '<th> Name </th> <th>Mobile</th> <th>ID/Passport</th> <th> Work Type </th>   <th> Number Of Workers </th> <th> Single Cost </th> <th> Cost </th>  <th> Project Name </th> <th> Floor No </th>';  
     totals_thead  = '<th> Total Cost </th>   ';
	    // hide all in the add div  inputs and show workers inputs
		 $('div#add input[type="text"], div#add textarea').hide();
		 $('div#add input[type="text"], div#add textarea').parent().closest('li').hide();
	     $('div#add .workers').css({'display' : '' });
		 $('div#add .workers').parent().closest('li').css({'display' : '' });
         title = 'Adding New Workers';	

        $('div#add .mobile').hide(); // name and mobile
	     $('div#add .mobile').parent().closest('li').hide();		 
	  
  }


 
$('div#add').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Confirm": function() {
				 
				        var data = new Array();
	                    var account_id = (data_array['supplier-account-id'])?data_array['supplier-account-id']:'';
                        confStatus = 'off';
						total = $('div#add .'+jQuery.trim(data_array['tableName'])).length;
						$('div#add .'+jQuery.trim(data_array['tableName'])).each( function(index) {
						 
						  var tab_Class = $(this).attr('tab_id');
						  tab_Class = (jQuery.trim(tab_Class))?tab_Class:'tab_link';
						  	
						  var error_msg = $(this).attr('error_msg');
						  var required_error = $(this).attr('required_error'); 
						  var value = $(this).val().replace(/,/g, ''); 
						  var collName = jQuery.trim($(this).attr('collmName')); 
						  
						  // validate 
						  if(jQuery.trim(value) == '' && jQuery.trim(required_error) != ''){
							 document.getElementsByClassName(tab_Class)[0].click(); 
							 error_func(required_error);  
							  $(this).css('border','2px solid red');
							  $(this).focus();
							  
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
                              }
							  
						  }
						  
						  
						  
						});				 
               
			   
     if(confStatus != 'off'){
	 
                      // confation start
					 
	                     var confirmation  = '<table id="confima_table"   cellpadding="0" cellspacing="0" border="0" class="display" width="100%">   <thead> <tr>'+confirm_thead+' </tr></thead> <tbody>'; 
		      
							  for (x = 0; x < data['floorNo'].length; x++) { 
									 if(data_array['tableName'] == 'suppliers'){
											confirmation +=   '<tr> <td>'+data['product-name'][x]+'</td><td>'+data['product-type'][x]+'</td><td>'+CommaFormattedN(data['quantity'][x])+'</td><td>'+CommaFormattedN(data['single-cost'][x])+'</td><td>'+CommaFormattedN(data['total-Cost'][x])+'</td><td>'+data['project-name'][x]+'</td><td>'+data['floorNo'][x]+'</td></tr>';
									  }else if(data_array['tableName'] == 'others'){
											confirmation +=   '<tr> <td>'+data['name'][x]+'</td> <td>'+CommaFormattedN(data['cost'][x])+'</td><td>'+data['project-name'][x]+'</td><td>'+data['floorNo'][x]+'</td><td>'+data['description'][x]+'</td></tr>';
									   }else if(data_array['tableName'] == 'workers'){
											confirmation +=   '<tr> <td>'+data['name'][x]+'</td><td>'+data['mobile'][x]+'</td> <td>'+data['id_or_passport'][x]+'</td><td>'+data['work-type'][x]+'</td><td>'+CommaFormattedN(data['number-of-workers'][x])+'</td> <td>'+data['w_single_cost'][x]+'</td><td>'+CommaFormattedN(data['cost'][x])+'</td><td>'+data['project-name'][x]+'</td><td>'+data['floorNo'][x]+'</td></tr>';
															
									  }
							   
								 }
					                   conf_title = 'Confirmation';
									// totals in confirmation
									 if(data_array['tableName'] == 'suppliers'){
										  conf_title = 'Confirm Supplier ('+data['name'][0]+')('+data['mobile'][0]+')'; // title for confirmation
										  totals_row = '<td class="conf_total_paid">0</td><td style="color:blue;" class="conf_total_balance">'+CommaFormattedN(data['total-Cost'].reduce(function(a, b){return Number(a)+Number(b);}))+'</td> '+"<td class='conf_action'><button onclick=\"make_payment(getAddArgs_payment('"+data['total-Cost'].reduce(function(a, b){return Number(a)+Number(b);})+"','','"+data['name'][0]+"'));\" class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' style='float: right; font-size: 0.7em;' title='' role='button' aria-disabled='false'><span class='ui-button-icon-primary ui-icon ui-icon-mony'></span><span class='ui-button-text'>Make Payment</span></button></td>"; 
									   }else if(data_array['tableName'] == 'others'){
										 conf_title = 'Confirmation';
										 totals_row = '<td>'+CommaFormattedN(data['cost'].reduce(function(a, b){return Number(a)+Number(b);}))+'</td>';  
									   }else if(data_array['tableName'] == 'workers'){
										 conf_title = 'Confirmation';
										  totals_row = '<td>'+CommaFormattedN(data['cost'].reduce(function(a, b){return Number(a)+Number(b);}))+'</td>';  		 	                                            
									  }
					           
								var totals = "<table class='table'>  <thead><tr> "+totals_thead+"</tr></thead><tr>"+totals_row+"</tr> </table>";		 
								 confirmation +='</tbody></table> '+totals;
 
			   
									$("div#confirmation").html(confirmation).dialog({  show: "blind", hide: "explode", width: 'auto', position:'top', height:'auto',  modal: true, buttons:  {
											"Agree": function() {
												
											    // check if payment belogns to the current supplier
											 if(jQuery.trim(payment_name) != jQuery.trim(data['name'][0])){
												 description_payment = '';
												 payment_amount = '';
											 }
											 
											    //console.log(data['date']);
											          // agreed  
									                  loading_func(); // SHOW LOADING animation dialog  
										 	          $.post('php_f/add.php', {date:data['date'],paymentDate:paymentDate,description_payment:description_payment,payment_amount:payment_amount,tableName:data_array['tableName'],account_id:account_id,name:data['name'],mobile:data['mobile'], id_or_passport:data['id_or_passport'], work_type:data['work-type'], number_of_workers:data['number-of-workers'],cost:data['cost'], product_name:data['product-name'],product_type:data['product-type'], quantity:data['quantity'],  single_cost:data['single-cost'], total_cost:data['total-Cost'], project_name:data['project-name'], floorNo:data['floorNo'],description:data['description']}, function(feedback_add) {					
													  
														if(jQuery.trim(feedback_add) == ''){
															window.location.reload;
														}else if(jQuery.trim(feedback_add) == '1'){
															
															$('div#loading').dialog("close");
														    $("div#confirmation").dialog("close");
															$('div#add').dialog("close");
															autoComplate('h'); // update autoComplate
															
															if(account_id != ''){
															    load_function('','suppliers-history',account_id,'suppliers-history');
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
						 // reset payments variables
						 payment_name = '';
						  description_payment  = '';
						  payment_amount = '';
						 paymentDate = '';
						 test = '';	
							
							
							
							// confation end ******** end ****
         }
						 },
							
							"Cancel": function() {	 
									$(this).dialog("close");
								}
						
						
						
						},
			   
							
							});
       
		autocompleteCach(''); 
		$('div [aria-describedby="add"] div:first span').html(title); 
       
}
       
  	
 // edit
function  edit(tableElement,data_json){    // 'type',etc // add more supleryers and workers then show confirmation box with agree button done
  // data_json = JSON.parse(data_json);
 // autoComplate_values();  
       //  console.log(data_json);
	   
	   
	   
	     $('.modify_project_f,.modify_project, .floarsTitle').hide();
	   
	   
	   
 var title = '';
 	  // hide all in the add div  inputs and show supplier inputs
  if(data_json.tableName == 'suppliers'){
   title = 'Editing supplier ('+data_json.supplier_name+')'; 
	  // hide all in the add div  inputs and show supplier inputs
	  $('ul#ulBox input[type="text"], ul#ulBox textarea').hide();
	  $('ul#ulBox input[type="text"], ul#ulBox textarea').parent().closest('li').hide();
   
	  
	  $('ul#ulBox .name,ul#ulBox .mobile, ul#ulBox .date').css({'display' : '' }); // name and mobile
	  $('ul#ulBox .name,ul#ulBox .mobile, ul#ulBox .date').parent().closest('li').css({'display' : '' });
 
// current default values 
 $('ul#ulBox .name').val(data_json.supplier_name);
 $('ul#ulBox .mobile').val(data_json.mobile);
 $('ul#ulBox .date').val(data_json.created_date);

  }else if(data_json.tableName == 'suppliers_history'){
    title = 'Editing '+data_json.product_name; 
	  // hide all in the add div  inputs and show supplier inputs
	  $('ul#ulBox input[type="text"], ul#ulBox textarea').hide();
	  $('ul#ulBox input[type="text"], ul#ulBox textarea').parent().closest('li').hide();
   
   
	  
	  $('ul#ulBox .suppliers').css({'display' : '' });
	  $('ul#ulBox .suppliers').parent().closest('li').css({'display' : '' });
	  
      $('ul#ulBox .name,ul#ulBox .mobile').hide(); // name and mobile
	  $('ul#ulBox .name,ul#ulBox .mobile').parent().closest('li').hide();
		
 
  $('ul#ulBox .date').val(data_json.date);
  $('ul#ulBox .productType').val(data_json.product_type);
 
  }else if(data_json.tableName == 'others'){
       title = 'Editing '+data_json.name+' from Others'; 
	    // hide all in the add div  inputs and show others inputs
		 $('ul#ulBox input[type="text"], ul#ulBox textarea').hide();
		 $('ul#ulBox input[type="text"], ul#ulBox textarea').parent().closest('li').hide();
	     $('ul#ulBox .others').css({'display' : '' });  	  
		 $('ul#ulBox .others').parent().closest('li').css({'display' : '' });
 
  }else if(data_json.tableName == 'workers'){
         title = 'Editing '+data_json.name+' from Workers'; 
	    // hide all in the add div  inputs and show workers inputs
		 $('ul#ulBox input[type="text"], ul#ulBox textarea').hide();
		 $('ul#ulBox input[type="text"], ul#ulBox textarea').parent().closest('li').hide();
	     $('ul#ulBox .workers').css({'display' : '' });
		 $('ul#ulBox .workers').parent().closest('li').css({'display' : '' });
   
   
         $('ul#ulBox .mobile').hide(); // name and mobile
	     $('ul#ulBox .mobile').parent().closest('li').hide();
	  
  }else if(data_json.tableName == 'projects'){
         title = 'Editing '+data_json.name+' '; 
	    // hide all in the add div  inputs and show workers inputs
		 $('ul#ulBox input[type="text"], ul#ulBox textarea').hide();
		 $('ul#ulBox input[type="text"], ul#ulBox textarea').parent().closest('li').hide();
		 
	     $('ul#ulBox .projects').css({'display' : '' });
		 $('ul#ulBox .projects').parent().closest('li').css({'display' : '' });
   
   
         $('ul#ulBox .mobile, ul#ulBox #project_name2, ul#ulBox #floorNo2').hide(); // name and mobile
	     $('ul#ulBox .mobile').parent().closest('li').hide();
		 
 

		  $('.modify_project').html(projects_list()); //projects_list
		  $('.modify_project select').chosen();
  
  
	     $('.modify_project_f,.modify_project').show();
  

  } 
  	  $('ul#ulBox li.re3').hide(); // hide : from editing : quantity,single-cost and total-Cost

       // reset 
	      $('.changeTo').fadeIn().find('span').text('');
          $('.changeToF').fadeIn().find('span').text('');
		  
                                      // apply default data
		                            var typeClass = (data_json.tableName == 'suppliers_history')?'suppliers':data_json.tableName;
									$('ul#ulBox .'+jQuery.trim(typeClass)).each( function() {
									       var collName = jQuery.trim($(this).attr('collmName')).replace(/-/g, '_').replace(/number_of_workers/g, 'number_or_workers'); 
                                              currentColl = $(this);
											$.each(data_json, function(colmn, value){ 
													 if($.trim(colmn) == $.trim(collName)){
                                                         currentColl.val(value);
                                                        } 
 

												 });
                                       });				 
				

 

				

$('ul#ulBox').dialog({  show: "blind", hide: "explode", width: 'auto',  height:'auto',  modal: true, buttons:  {
							"Ok": function() {
				 
				        var data = new Array();
	                        skiped_colms = ['-','name','quantity','single-cost','total-Cost']


 
                               // data gruping and validating 
                            if(data_json.tableName == 'suppliers'){
                                 data['name'] = new Array();
                                  data['mobile'] =  new Array();
                                       data['date'] =  new Array();
								data['name'][0] = jQuery.trim($('ul#ulBox .name').val());
							    data['mobile'][0] = jQuery.trim($('ul#ulBox .mobile').val());
                                data['date'][0] = jQuery.trim($('ul#ulBox .date').val());
								 if(data['name'] == ''){
									   error_func('please enter the name !!!');  
									  $('ul#ulBox .name').css('border','2px solid red');
									  return false;
								  }
								
							 }else{
								         
										var typeClass = (data_json.tableName == 'suppliers_history')?'pe':data_json.tableName;
									$('ul#ulBox .'+jQuery.trim(typeClass)).each( function() {
									 
									  var tab_Class = $(this).attr('tab_id');
									  tab_Class = (jQuery.trim(tab_Class))?tab_Class:'tab_link';
										
									  var error_msg = $(this).attr('error_msg');
									  var required_error = $(this).attr('required_error'); 
									  var value = $(this).val().replace(/,/g, ''); 
									  var collName = jQuery.trim($(this).attr('collmName')); 
									  
									 
									   		  // validate 
											  if(jQuery.trim(value) == '' && jQuery.trim(required_error) != ''){
												// document.getElementsByClassName(tab_Class)[0].click(); 
												 error_func(required_error);  
												  $(this).css('border','2px solid red');
												  $(this).focus();
												 return false;
											  }else if(!isNumeric.test($.trim(value)) && jQuery.trim(error_msg) != ''  ){
												 
												// document.getElementsByClassName(tab_Class)[0].click(); 
												 error_func(error_msg); 
												  $(this).css('border','2px solid red');
												  $(this).focus();	  
												 return false;
												  
											  }else{
												  
												  // push to the data with collmName
												 if(collName in data){
													  data[collName].push(value);  
												  }else{
													  data[collName] = new Array();
													  data[collName].push(value); 
													  
												  }

												  
											  }
											   
									  
						  
									}).error(function(){
			 
																 error_func('Network Error please try Again or refresh the bage');
															 });		 
							
								 
							 }

                              
                              // end of data grupping an validating 

									                  loading_func(); // SHOW LOADING animation dialog  
										 	          $.post('php_f/edit.php', {id:data_json.id,date:data['date'],tableName:data_json.tableName,name:data['name'],mobile:data['mobile'], id_or_passport:data['id_or_passport'], work_type:data['work-type'], number_of_workers:data['number-of-workers'],cost:data['cost'], product_name:data['product-name'],product_type:data['product-type'], project_name:data['project-name'], floorNo:data['floorNo'],description:data['description'],}, function(feedback) {					
													  
														if(!jQuery.trim(feedback)){
															window.location.reload;
														}else if(jQuery.trim(feedback) == '1'){
															success_func('Successful');
															$('div#loading').dialog("close");
														    $('ul#ulBox').dialog("close");
															 
																autoComplate('h'); // update autoComplate
														tableElement.click();		
														}else{
                                                             error_func(feedback);
															$('div#loading').dialog("close");
														}
								 
								 
							                            }); 
 
						 },
							
							"Cancel": function() {	 
									$(this).dialog("close");
								}
						
						
						
						},
			   
							
							});
       
		    autocompleteCach(''); 
            $('div [aria-describedby="ulBox"] div:first span').html(title); 
       
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
               
				$('#addTabs div').last().remove();	
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
	$(document).on( 'blur', '.productName,.name', function () {   
	      value = $(this).val();
	      tab_Class = $(this).attr('tab_id');
		  tab_Class = (jQuery.trim(tab_Class))?tab_Class:'tab_link';
	
	if(jQuery.trim(value) != ''){
		if(addingStatus == 's' && $(this).hasClass('name')){
			  $('div[aria-describedby="add"] div:first span').html("suppleir : "+value);
		 }else if(addingStatus == 's' || addingStatus == 'w' || addingStatus == 'o'){
			  $('.'+tab_Class).text(value);	 
		 } 
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
	          load_function('suppliers_main_div','suppliers','','suppliers');
                      $('#projects_accordion').accordion(); 
					  
		              $('body').fadeIn(); 
					  $('.date').datepicker({dateFormat:"dd/M/yy"});
                      $('div#main_tabs,div#addTabs').tabs();
                      $('div#settings p a').button({height:'7px', icons: {primary: 'ui-icon-pencil', secondary: null} }).css('font-size','11px');
                      
					  autoComplate('h'); // update autoComplate
	               
					
				   // load_function('suppliers_main_div','suppliers','','suppliers');// show suppleirs for the first time

	 // add more tabs button
	$('.add_more').click(function (){
 
		var second_tab_div = $('div#add_tabs_').html();			
		var current_count = $('#add_tabs_handler li').length;
		var next_count  =  current_count + 1;
		
 
   
		 $('#add_tabs_handler').append('<li><a href="#add_tabs_'+next_count+'" class="tab_link'+next_count+'" >Tab '+next_count+' </a></li>');	 
		 $('#addTabs').append('<div id="add_tabs_'+next_count+'"  > '+second_tab_div+' </div>');
       
	    // remove unwhanted fields from other tabs 
		if($('div#add_tabs_ .productName') && addingStatus == 's'){
	    $('div#add_tabs_'+next_count+' .name,div#add_tabs_'+next_count+' .identity, div#add_tabs_'+next_count+' .mobile ').parent().closest('li').remove();
        }
		$('div#add_tabs_'+next_count+' .date').removeClass('hasDatepicker').removeAttr('id').datepicker({dateFormat:"dd/M/yy"}); // remove date fields from other tabs
	    $('div#add_tabs_'+next_count+' .date').val(currentDateDefault);

		
		
		 autocompleteCach('div#add_tabs_'+next_count+'');
		 
		 

  
		 // insert tab id into each element in that tab 
	    $('div#add_tabs_'+next_count+' * ').attr('tab_id','tab_link'+next_count+'');
 	    $('div#add_tabs_'+next_count+'').append('<button class="remove-tab ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" hover="click to Remove Tab " role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span><span class="ui-button-text">Remove</span></button>');
   $('div#addTabs').tabs("refresh");
         document.getElementsByClassName('tab_link'+next_count)[0].click();   // jump to the new tab
	
	});
	
	
	// skip projects
 	$('.skip_projects2,.skip_projects').click(function (){	 
						
					if ($(this).is(':checked')){  
						  $('.floorNo, .project_name').val('none');  
					}else{						
						  $('.floorNo, .project_name').val('');  
					}
		 
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
   
		  
		  
		  
		  
		  
		  
		  
 
