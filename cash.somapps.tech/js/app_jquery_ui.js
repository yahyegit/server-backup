 
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

 

$('document').ready(function(){

     
       
  

                       $('select[remove_filter="true"').chosen({"disable_search": true
});
                       $('select').chosen({search_contains: true });
$('#main_nav').tabs();
$('.action_feedbacks').show();
$('#main_nav li a:first').click();
if(logined_){
  get_template.customers('','transction_form','pages/forms/make_transction_form_page.php');


}




});
 
 $(window).scroll(function() {
    if ($(this).scrollTop()) {
        $('#back_toTop:hidden').stop(true, true).fadeIn();
    } else {
        $('#back_toTop').stop(true, true).fadeOut();
    }
});
