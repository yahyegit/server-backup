/*$("body").on("checkboxradio","input[type='checkbox']" function(e) {
    alert('ready');
});
 */



 $(window).scroll(function() {
    if ($(this).scrollTop()) {
        $('#back_toTop:hidden').stop(true, true).fadeIn();
    } else {
        $('#back_toTop').stop(true, true).fadeOut();
    }
});






 (function( $ ) {  // apply checkboxradio checheck by default if selected 
 
    $.fn.apply_checkboxradio = function() {
    	this.checkboxradio();
    	this.each(function(){
    		if($(this).attr('selected_check')){
    			$(this).click();
    		}
    	});
    };
 
}( jQuery ));
 		
	
