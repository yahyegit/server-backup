
rotate = {
    close: function(){
         $('.rotate_wrapper').css('width','auto');
         $('.add_buttons_main').fadeOut();
         $('.rotate_btn_add').removeClass('rotate_open').addClass('rotate_close');
    },
    open: function(){
      $('.rotate_btn_add').removeClass('rotate_close').addClass('rotate_open');
     $('.add_buttons_main').fadeIn();
     $('.rotate_wrapper').css('width','192px');
     }
  }


$('document').ready(function(){
   rotate.open(); // open by default so that the user can learn quickly 
      $(".rotate_btn_add").effect( "bounce", {times:3}, 500 );

                       $('select[remove_filter="true"').chosen({"disable_search": true
});
                       $('select').chosen({search_contains: true });
$('#main_nav').tabs();
$('.action_feedbacks').show();
$('#main_nav li a:first').click();


});
 
 

function rotate_(){
  if($('.add_buttons_main').is(':visible')){
    rotate.close();
  }else{ 
    rotate.open();
  }
}
 





mobile_ = '';
 $(window).scroll(function() {
   rotate.close();

 

});