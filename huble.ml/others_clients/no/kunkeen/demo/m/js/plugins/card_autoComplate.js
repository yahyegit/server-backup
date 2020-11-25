 
// ADD THIS TO CSS 
      /*.ui-menu-item-wrapper,.ui-menu-item{
  display: none !important;
} */


function cards_box_filter(){
$('.ui-autocomplete .ui-menu-item').each(function(){
		id = $(this).find('.ui-menu-item-wrapper').text().split("'")[1]; // e.g: 'cust_id_22', name (34444444) $3000 | ksh4000
		$(this).html(cards_box[id]).show();
});
 	if($('div').hasClass('.ui-autocomplete')){
  		 cards_box_filter();
	}
}

 cards_box = {};

(function( $ ) {
     $.fn.cards_autoComplate = function() {
    	cards_box = {cards_box, JSON.stringify($('#'+$.trim(this.cards_box_id)).html())}; // e.g:  {'cust_id_22':'box ','cust_id_23':'box '}
    	cards_box_filter();
 
 }( jQuery ));
 		
 		
	
  