 (function( $ ) {
 
    $.fn.input_comma_formated = function() {

		var $input = this;

		this.keyup( function( event ) {
			
			
			// When user select text in the document, also abort.
			var selection = window.getSelection().toString();
			if ( selection !== '' ) {
				return;
			}
			
			// When the arrow keys are pressed, abort.
			if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
				return;
			}
			
			
			var $this = $( this );
			
			// Get the value.
	     //     $this.val(CommaFormattedN($this.val().replace(/,/g , '')));



		} );
 

 }
  
}( jQuery ));
