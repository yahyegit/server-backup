 current_open_page = '';
function request_template(position,data,file){ 
                position = (file.includes('form'))?'.forms_container':'#view';

          loading_fun('start',position);  // start loading   
/*    if( $('.ui-dialog-content').is(":visible")){
         $('.ui-dialog-content').dialog('close'); 
    }*/

         $('.form').remove(); 
         $('.drop_menu_').hide(); 
          $.post('php_files/'+file,{data}, function (feadback) {
                   $('#error').hide();
                     loading_fun('stop',position);

            if(typeof $.fn.tee_form == 'undefined') {
                                window.location.reload();

                 }

                    login_ = $.trim(feadback).toLowerCase().replace(/ok/g , '');
                
                    if(login_ == 'login'){
                                window.location.reload();
                    }else{  
                       
                       $(position).html(feadback);
                        $('form').addClass('form');
                        $(position).html($(position).html().replace('<form','<div').replace('</form','</div'));
                            



                       $(position+' .dataTable').each(function(){
                            $(this).dataTable_loader();
                           }); 

       $('.ui-icon-trash').closest('.ui-button').css('background','#ff000061');

                       // save the url
                        //if request is included form don't save 
                        $(position+' .submit_btn ').addClass('primary_button');  

                         file_ = JSON.stringify(file);
                         if(!file.includes("forms")){


                       $(position+' select[remove_filter]').chosen({"disable_search": true
});
                       

 
  $(position+' select ').each(function(){
  if($(this).attr('id') !='no'){  
    if( $(this).find('option').length < 8){
                              $(this).chosen({"disable_search": true
                              });
          }else{
                             $(this).chosen({search_contains: true });
     } 

  }

 });



                             current_open_page  = {position:position,data:data,file:file};
                              $('.forms_container').slideUp();
                               
                          }else{

 


         $(position+' select ').chosen({search_contains: true });
    
            
 

                          
                        $(position+' .chzn-default span').text('..');



                              $('.forms_container').slideDown();

                            $(position+' .form').each(function(){
                                 $(this).tee_form(); 
                               }); 
                              window.location.href = "#forms_container_";
                            

                          }
    $("input[type='checkbox'],input[type='radio']").checkboxradio();

 fix_chose_size();

                    }
            }).error(function(){
                  window.location.reload();
               });
          
}

function r_page(position,data,file){
  request_template(position,data,file);
}
 
get_template = {
  settings : function(file){ // type: display,edit_username_form,edit_pass_form,
    position = (file.includes('form'))?'.forms_container':'#view';
    request_template(position,'',file); 
  },
  customers : function(id,type,file){   // type = transction_form, edit_customer_info_form,customer_acount, credits,debts,all_customers
    position = (JSON.stringify(id).includes('form'))?'.forms_container':'#view';
    request_template(position,{id:id,type:type},file); 
  },
  reports : function(date,file){
    if($.trim(date) != ''){
          position = (JSON.stringify(file).includes('form'))?'.forms_container':'#view';
           request_template(position,{date},file); // daily or year,month 
    }

  },
}

