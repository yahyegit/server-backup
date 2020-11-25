 
/*
   $('.dataTable tr').on({
             mouseenter: function () {
					$(this).css('background','#c75def').attr('o_class',$(this).attr('class')).removeClass('even');
            },
            mouseleave: function () {
                   $(this).removeAttr('style').addClass($(this).attr('o_class'));
            }
       });  


*/

$(document).on("contextmenu", "html", function(e){
                    if(body_hide == 'enable'){
                           if($('#body_hider').hasClass('body_hide')){$('#body_hider').removeClass('body_hide');}else{$('#body_hider').addClass('body_hide')};
                    }
      //     return false;
         });

$('document').ready(function(){

     
       
  

                       $('select[remove_filter="true"').chosen({"disable_search": true
});
                       $('select').chosen({search_contains: true });
$('#main_nav').tabs();
$('.action_feedbacks').show();
$('#main_nav li a:first').click();


});
 
 $(window).scroll(function() {
    if ($(this).scrollTop()) {
        $('#back_toTop:hidden').stop(true, true).fadeIn();
    } else {
        $('#back_toTop').stop(true, true).fadeOut();
    }
});