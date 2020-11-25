rotate = {
    close: function(){
         $('.rotate_wrapper').css('width','auto');
         $('.add_buttons_main').fadeOut();
         $('.rotate_btn_add').removeClass('rotate_open').addClass('rotate_close');
         $('#view').css('top','95px');
    },
    open: function(){
      $('html, body').animate({scrollTop: '0px'}, 200);
       $('.rotate_btn_add').removeClass('rotate_close').addClass('rotate_open');
       $('.add_buttons_main').fadeIn();
       $('.rotate_wrapper').css('width','192px');
       $('#view').css('top','167px');

     },
     defalut: function(){
       $('.rotate_btn_add').removeClass('rotate_close').addClass('rotate_open');
       $('.add_buttons_main').fadeIn();
       $('.rotate_wrapper').css('width','192px');
       $('#view').css('top','167px');
     }
  }


$('document').ready(function(){
  rotate.defalut();
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
 


 
 
 var position = $(window).scrollTop(); 
 
$(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if(scroll > position) {
        rotate.close();
     } 
    position = scroll;
});