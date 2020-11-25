 current_open_page = '';
function request_template(position,data,file){ 
                position = (file.includes('form'))?'.forms_container':'#view';

          loading_fun('start',position);  // start loading   
          $.post('php_files/'+file,{data}, function (feadback) {
                   $('#error').hide();

                    loading_fun('stop',position);
                    login_ = $.trim(feadback).toLowerCase().replace(/ok/g , '');
                
                    if(login_ == 'login'){
                                window.location.reload();
                    }else{  
                       
                       $(position).html(feadback);


                       $(position+' select[remove_filter="true"').chosen({"disable_search": true
});
                       $(position+' select').chosen({search_contains: true });
                        $(position+' .chzn-default span').text('..');



                       $(position+' .dataTable').dataTable_loader();

                       $("input[type='checkbox'],input[type='radio']").checkboxradio();

                       // save the url
                        //if request is included form don't save 
                         file_ = JSON.stringify(file);
                         if(!file_.includes("form")){
                             current_open_page  = {position:position,data:data,file:file};
                              $('.forms_container').slideUp();
                               
                          }else{
                              $('.forms_container').slideDown();
                              $('form').tee_form(); 
                              window.location.href = "#forms_container_";
                            

                          }

 fix_chose_size();

                    }
            }).error(function(){window.location.reload();});
          
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
