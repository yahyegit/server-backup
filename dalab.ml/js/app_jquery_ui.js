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