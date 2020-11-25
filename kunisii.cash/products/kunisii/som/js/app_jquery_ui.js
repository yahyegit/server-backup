/*$("body").on("checkboxradio","input[type='checkbox']" function(e) {
    alert('ready');
});
 */

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