
availble_currencies = {};

function   apply_checkebox(el){
   el.find('.conv_check').html(" <label class='conv_check' ><input type='checkbox' name='convert' id='convert' onclick=\"     if($(this).is(':checked')){               $(this).closest('tr').find('.convert_div').show();                  }else{              $(this).closest('tr').find('.convert_div').hide();                      }auto_calc($(this).closest('tr'));    \"> Convert </label>");     

    $("input[type='checkbox'],input[type='radio']").checkboxradio();
    type = '';
    $('#transacion_form [name="type"]').each(function(){
                if($(this).val() == 'In') {
                      type = 'on';
                }else if ($(this).val() == 'Out') {
                      type = 'on';
                }
    });



 if (type == 'on') {
       $('#transacion_form  input[name="customer_name"]').attr('error_empty_msg','name is required !');
 }else{
    $('#transacion_form  input[name="customer_name"]').removeAttr('error_empty_msg');
 }



}

function call_auto_calc(){

        $('input[name="buy_rate"],input[name="sell_rate"]').keyup(function(){
                 auto_calc($(this).parents().closest('tr')); 
         });
        $('input[name="conv_to_currency"]').blur(function(){

                        old_c = $.trim($(this).attr('old_currency'));
                        new_c = $.trim($(this).val());
                        $(this).attr('old_currency',new_c);
                        if (old_c != new_c){
                          delete balance_to_display[old_c]; 
                          delete current_customer_bl[old_c]; 
                          console.log(balance_to_display[old_c]);
                           console.log(current_customer_bl[old_c]);
                        }
                       auto_calc($(this).parents().closest('tr')); 

         });

        $('input[name="currency"]').blur(function(){

            old_c = $.trim($(this).attr('old_currency'));
            new_c = $.trim($(this).val());
            $(this).attr('old_currency',new_c);
            if (old_c != new_c){
              delete balance_to_display[old_c]; 
              delete current_customer_bl[old_c]; 
              console.log(balance_to_display[old_c]);
               console.log(current_customer_bl[old_c]);
            }
             auto_calc($(this).closest('tr')); 

         });

}


function add_more_row(){
  $('.amount_t').append('<tr class="t124 " id="jk2" >'+$('.amount_row').html()+"<td>  <button  title='remove ' style='background:red;font-size: 13px;' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"$(this).closest('tr').remove();remove_currency($(this).closest('tr')); \" role='button' aria-disabled='false'><span class='ui-button-icon-primary ui-icon ui-icon-minus'></span> remove</button></td></tr>");
    $('.t124 .conv_check').html(" <label class='conv_check' ><input type='checkbox' name='convert' id='convert' onclick=\"     if($(this).is(':checked')){               $(this).closest('tr').find('.convert_div').show();                  }else{              $(this).closest('tr').find('.convert_div').hide();                      }auto_calc($(this).closest('tr'));                   \"> Convert </label>");
    $('.t124 .convert_div').hide();
    $('.t124 ').find("label").addClass('float_label').hide();

$('.t124  input[name="currency"], input[name="conv_to_currency"] ').removeAttr('old_currency'); 

$('.t124 input[name="amount"]').attr('old_result_bl',0).attr('amount_2',0);



$('.t124 input').val('');


        call_auto_calc();



 $('.t124 input.currency_input').autocomplete({minChars: 0 , source: availble_currencies }).focus(
    function() {
        if (this.value == '') {
               $(this).autocomplete('search', ' ');
            }
        }
    ); // display all availble options by default 



    $('.t124 .type_').html("   <label class=\"float_label show_\" >Type</label><br>                       <select name='type' error_empty_msg=' type is required ' remove_filter='true' onchange=\"                                       if($.trim($(this).val()) == 'forex'){                                             $(this).closest('tr').find('.conv_check').hide();  $(this).closest('tr').find('input[name=converted_result]').attr('old_result','0');                                                                                         $(this).closest('tr').find('.convert_div:first').show();                                        }else{                                            $(this).closest('tr').find('.conv_check').show();                                                                                        $(this).closest('tr').find('.convert_div:first').hide();                                       }                                     auto_calc($(this).closest('tr'),'selected');   apply_checkebox($(this).closest('tr'))  \">                                <option>..</option><option>forex</option><option>In</option> <option>Out</option>                       </select> ");
   
    
 $('.t124 .mu_td').html(" <label> choose </label><br>             <select remove_filter='true' onchange=\"auto_calc($(this).parents().closest('tr')); \" error_empty_msg='required' required  class='rate_multi' onchange='  '><option> .. </option> <option> divide </option> <option> multiply</option> </select>");


   $('.t124 select[remove_filter="true"').chosen({"disable_search": true});
       
 $('.t124 input[name="converted_result"]').attr('result_2',0); 
  $('.t124 input[name="amount"]').attr('amount_2',0); 

           $('.t124 *').removeClass('error_border');

  $('.t124 ').find("input[format_comma='true']").input_comma_formated();

    $('.t124').fadeIn().removeClass('t124');

    $(".amount_row input[format_comma='true']").input_comma_formated();
apply_checkebox();

$('#transacion_form p#error_line').remove();
}
 
function louch_form(){

    availble_currencies = JSON.parse($('#transacion_form ').attr('curencies'));
  $('#transacion_form  input.currency_input').autocomplete({minChars: 0 , source: availble_currencies }).focus(
    function() {
        if (this.value == '') {
               $(this).autocomplete('search', ' ');
            }
        }
    ); // display all availble options by default 



        call_auto_calc();
 

        chosen_customer($('.customer_names_select select').find('option:selected'));
    $('#transacion_form  input[name="customer_name"]').removeAttr('error_empty_msg');

}


function currency_to_upper(el){

    if ($.trim(el.val()) !=''){
          el.val(el.val().toUpperCase());
    }
 }


function convert_check(el){
    
   if($(this).is(':checked')){ 

              $(this).closest('tr').find('.convert_div').fadeIn("300",function(){
                 auto_calc(el.closest('tr'));

               });
          
        }else{  
  
          $(this).closest('tr').find('.convert_div').fadeIn("300",function(){
                 auto_calc(el.closest('tr'));

            });
          
    
        }
 
}



 function opbjec_checks(key2,key,obj){
 
       if(obj.hasOwnProperty(key)){
                        
                if (key2 != '' &&  key != '' &&  obj != ''){

                           if (obj[key].hasOwnProperty(key2)){
                                  return obj[key][key2];    
                            }else{
                                  return 0;
                            }    
                    }else{
                       return obj[key];    
                    }

              }else{
                return 0;    
              }
 }



 current_customer_bl = {};
 current_customer_bl_old = {};
 balance_to_display = {}; 
 
 function display_bl(c_key,type_){

//balance_to_display = {};

if($.trim($('#transacion_form  input[name="customer_name"]').val()) == ''){
      return false;
}




 
  for (currency in current_customer_bl_old) {
       
       c_balance = opbjec_checks('',currency,current_customer_bl_old);
       type = opbjec_checks('1',currency,current_customer_bl);
       value = opbjec_checks('0',currency,current_customer_bl);
       value =  (value !='NaN')?value:0;

         if(!balance_to_display.hasOwnProperty(currency)){

               if($.trim(type) == 'In'){
                            balance_to_display[$.trim(currency)] = c_balance+value;
         
                }else if ($.trim(type) == 'Out'){
                             balance_to_display[$.trim(currency)] = c_balance-value;
                }else  if($.trim(type_) == 'All'){
                        balance_to_display[$.trim(currency)] = c_balance;

                }else{
                        balance_to_display[$.trim(currency)] = c_balance;
                }
          }else{ 
                }
   
  }


 
       c_balance = opbjec_checks('',c_key,current_customer_bl_old);
       type = opbjec_checks('1',c_key,current_customer_bl);
       value = opbjec_checks('0',c_key,current_customer_bl);
       value =  (value !='NaN')?value:0;


        if($.trim(type) == 'In'){
                if(!balance_to_display.hasOwnProperty($.trim(c_key))){
                                  balance_to_display[$.trim(c_key)] = c_balance+value;              
                  }else{
                                  balance_to_display[$.trim(c_key)] = balance_to_display[$.trim(c_key)]+value;              
                  }
        }else if ($.trim(type) == 'Out'){
                if(!balance_to_display.hasOwnProperty($.trim(c_key))){
                                  balance_to_display[$.trim(c_key)] = c_balance-value;              
                  }else{
                                  balance_to_display[$.trim(c_key)] = balance_to_display[$.trim(c_key)]-value;              
                  }       
        }



          if (!current_customer_bl_old.hasOwnProperty(c_key) &&  balance_to_display[$.trim(c_key)] == 0){
              //  remove
              delete balance_to_display[c_key];
          }else{
           
          }
   

 
 

   // show balances
  blc = "";
  for (currency in balance_to_display) {

    if (balance_to_display[currency]){
          color  = (balance_to_display[currency].toString().includes('-'))?'debt_color':'in_color';
        blc += "  <div class='"+color+"  chip  "+currency+" '>"+currency+""+CommaFormattedN(balance_to_display[currency])+"</div> ";
     }else if (current_customer_bl_old.hasOwnProperty(currency)){
          color  = (balance_to_display[currency].toString().includes('-'))?'debt_color':'in_color';
        blc += "  <div class='"+color+"  chip  "+currency+" '>"+currency+""+CommaFormattedN(balance_to_display[currency])+"</div> ";
     }
  }




    $('#transacion_form .bl_list').hide().html(blc); 

/*    $('#transacion_form .'+animate).fadeIn("300",function(){
      $(this).css('opacity','1');
    });
*/

    $('#transacion_form .bl_list,#transacion_form .blcc,#transacion_form .bl_box').show();    

 
  
 }



function chosen_customer(customer_el){
   // reset  first
    $("#transacion_form .amount_t tr").each(function(){
        if (!$(this).hasClass('dont_r')){
          $(this).remove();
        }

                  remove_currency($(this));

    });
    current_customer_bl = {};
    balance_to_display = {};
  

$('input[name="amount"]').attr('old_result_bl',0).attr('amount_2',0);
 



    $('.type_').html("   <label class=\"float_label show_\" >Type</label><br>                       <select name='type' error_empty_msg=' type is required ' remove_filter='true' onchange=\"                                       if($.trim($(this).val()) == 'forex'){                                             $(this).closest('tr').find('.conv_check').hide();   $(this).closest('tr').find('input[name=converted_result]').attr('old_result','0');                                                                                       $(this).closest('tr').find('.convert_div:first').show();                                        }else{                                            $(this).closest('tr').find('.conv_check').show();                                                                                        $(this).closest('tr').find('.convert_div:first').hide();                                       }                                     auto_calc($(this).closest('tr'),'selected');     apply_checkebox($(this).closest('tr'));\">                                <option>..</option><option>forex</option><option>In</option> <option>Out</option>                       </select> ");
    
  $('.mu_td').html(" <label> choose </label><br>             <select remove_filter='true' onchange=\"auto_calc($(this).parents().closest('tr')); \" error_empty_msg='required' required  class='rate_multi' onchange='  '><option> .. </option> <option> divide </option> <option> multiply</option> </select>");






    $(' select[remove_filter="true"').chosen({"disable_search": true});

    $("#transacion_form .amount_row input").val('');
    $('#transacion_form .convert_div,#transacion_form .bl_box').hide();
    $('#transacion_form .convert_div').find('input[name="profit"],input[name="converted_result"],input[name="sell_rate"],input[name="buy_rate"],input[name="conv_to_currency"]').removeAttr('error_empty_msg').val('');
    // end of reset


  if(customer_el.html() == 'Add New'){
              $("input[name='customer_name']").val('').fadeIn();

  }else{
        $("input[name='customer_name']").hide().val(customer_el.attr('customer_name')); 
  }

   

  $("input[name='mobile']").val(customer_el.attr('mobile')); 
  $("input[name='customer_id']").val(customer_el.attr('customer_id')); 
  current_customer_bl_old = JSON.parse(customer_el.attr('balance'));

  display_bl('.bl_list','All');
  

  // hide balance if 'choose' or 'add'
  if(customer_el.html() == 'choose..' || customer_el.html() == 'Add New'){
            $('.bl_list,.blcc').hide(); 
  }
}




 
function clean(value){  
  if (value) { 
    val =  parseFloat($.trim(value.replace(/,/g, '')));
    return (val == 'NaN')?0:val;
  }else{ return 0;}   
}


function remove_currency(el){
         if(el.find('select[name="type"]').val() !='forex' ){
                                                delete   current_customer_bl[el.attr('currency_name')];

                                                delete   balance_to_display[el.attr('currency_name')];
                                                
                                              if ($.trim(el.attr('currency_name')) !='') {
                                                $('#transacion_form .bl_list .'+el.attr('currency_name')).hide();
                                              }
        } 
}
 
function auto_calc(row_element,from_chosen){ // result, profit ,new balance  
     from_chosen = from_chosen || '';
  
if(from_chosen == 'selected'){
  row_element.find('input[name="amount"]').val('');//.attr('old_result_bl','0').attr('amount_2','0');
}




          // result calc   
        if(row_element.find('input[name="profit"]').is(":visible")){
          // set required 
          row_element.find('input[name="sell_rate"]').attr({error_empty_msg:'Sell rate is required '});
          row_element.find('input[name="buy_rate"]').attr({error_empty_msg:'buy rate is required '});
          row_element.find('input[name="conv_to_currency"]').attr({error_empty_msg:' currency to convert is required '});
                 
        if($.trim(row_element.find('select.rate_multi').val()) == 'divide'){
                // result =  clean(row_element.find('input[name="sell_rate"]').val()) / clean(row_element.find('input[name="amount"]').val())) / 100;  
        
               result =  parseFloat(clean(row_element.find('input[name="amount"]').val()) / clean(row_element.find('input[name="sell_rate"]').val())); 
               result = result.toFixed(2);


                profit  = parseFloat(clean(row_element.find('input[name="amount"]').val()) / clean(row_element.find('input[name="buy_rate"]').val()));
               profit = profit.toFixed(2);
 
                 profit = result - profit;
 


         }else   if($.trim(row_element.find('select.rate_multi').val()) == 'multiply'){
          
                         result = clean(row_element.find('input[name="sell_rate"]').val()) * clean(row_element.find('input[name="amount"]').val()); 
                 profit = result - (clean(row_element.find('input[name="amount"]').val()) * clean(row_element.find('input[name="buy_rate"]').val()));

        }else{
          return false;
        }





if(result == 'Infinity'){
  return false;
}


                 row_element.find('input[name="converted_result"]').attr('result',result).val(row_element.find('input[name="conv_to_currency"]').val()+' '+CommaFormattedN(result));
 
if(profit != '-Infinity'){
  row_element.find('input[name="profit"]').val(row_element.find('input[name="conv_to_currency"]').val()+' '+CommaFormattedN(profit));
   }       
row_element.find('input[name="profit"]').attr('size', row_element.find('input[name="profit"]').val().length);
row_element.find('input[name="converted_result"]').attr('size', row_element.find('input[name="converted_result"]').val().length);


        }else{          
          // remove required 
         row_element.find('input[name="profit"],input[name="converted_result"],input[name="sell_rate"],input[name="buy_rate"],input[name="conv_to_currency"]').removeAttr('error_empty_msg').val('');
          row_element.find('input[name="converted_result"]').attr('old_result',0);

        }



        //if current transacion is forex dont show balacance for current transacion
           if(row_element.find('[name="type"]').val() == 'forex' || row_element.find('[name="type"]').val() == '..'){
             return false;
             }else{


                     
                              // balacance update calc 
                              currency =  $.trim(row_element.find('input[name="currency"]').val());
                              amount =  clean(row_element.find('input[name="amount"]').val());
                               type =  row_element.find('select[name="type"]').val();
                              conv_to_currency =  $.trim(row_element.find('input[name="conv_to_currency"]').val());
                              converted_result = clean(row_element.find('input[name="converted_result"]').attr('result'));

                     
                              // update bl json 
                              c_key = '';

                              if(row_element.find('input[name="profit"]').is(":visible")){
                                    if($.trim(conv_to_currency)!=''){
                                        c_key = conv_to_currency;


                                      if (balance_to_display.hasOwnProperty(currency)){
                                        
                                        if (balance_to_display[currency] != '0'){
                                                   balance_to_display[currency] = balance_to_display[currency] - clean(row_element.find('input[name="amount"]').attr('amount_2')); 
                                                    row_element.find('input[name="amount"]').attr('amount_2',0);
                                       
                                      }
                                           row_element.find('input[name="converted_result"]').attr('result_2',converted_result);                                        }
                                           row_element.find('input[name="conv_to_currency"]').attr('conv_to_currency_2',conv_to_currency);

                                         if (balance_to_display.hasOwnProperty(c_key)){
                                        
                                              if (type == 'Out') {
                                                            balance_to_display[c_key] = balance_to_display[c_key] + clean(row_element.find('input[name="converted_result"]').attr('old_result'));
                                               }else if(type == 'In'){
                                                            balance_to_display[c_key] = balance_to_display[c_key] - clean(row_element.find('input[name="converted_result"]').attr('old_result'));
                                               
                                              }


                                         }


                                         current_customer_bl[conv_to_currency] = Array(converted_result,type); 
                                         display_bl(c_key,conv_to_currency);
                                        row_element.find('input[name="converted_result"]').attr('old_result',converted_result);
                                     }


                      
                              }else{ 
                                 
                                       converted_result_2 = clean(row_element.find('input[name="converted_result"]').attr('result_2'));
                                        conv_to_currency_2 =  $.trim(row_element.find('input[name="conv_to_currency"]').attr('conv_to_currency_2'));

                                    if (balance_to_display.hasOwnProperty(conv_to_currency_2)){
                                        
                                        if (balance_to_display[conv_to_currency_2] != '0'){
                                                   balance_to_display[conv_to_currency_2] = balance_to_display[conv_to_currency_2] - converted_result_2; 
                                                   row_element.find('input[name="converted_result"]').attr('result_2',0);
                                         }
                                      }


                                  row_element.find('input[name="amount"]').attr('amount_2',amount);


                                    if($.trim(currency)!=''){
                                       c_key = currency;


                                     if (balance_to_display.hasOwnProperty(c_key)){
          
 
         
                                                        if (type == 'Out') {
                                                            balance_to_display[c_key] = balance_to_display[c_key] + clean(row_element.find('input[name="amount"]').attr('old_result_bl'));
                                                       
                                                        }else if(type == 'In'){
                                                            balance_to_display[c_key] = balance_to_display[c_key] - clean(row_element.find('input[name="amount"]').attr('old_result_bl'));
                                                             
                                                        } 
                                     

                                         }
                       current_customer_bl[currency] = Array(amount,type);

                                           display_bl(c_key,type);
                                           row_element.find('input[name="amount"]').attr('old_result_bl',amount);
                                  console.log('new bl'+balance_to_display[c_key])

                                    }
                             
                              }
                                row_element.attr('currency_name',c_key);
          }
 
}
