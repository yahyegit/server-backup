   var cards_box_timer = '';
  
      function customer_info(option){


        if($.trim(option.val()) == 'Add'){
          $("input[name='customer_name']").val('').fadeIn();
        }else if($.trim(option.val()) == 'choose..'){ 
          return false;
        }else{
          $("input[name='customer_name']").fadeOut();
        }
       
        $('#cash_balance').attr('cash_balance',option.attr('cash_balance'));
        $('#dollar_balance').attr('dollar_balance',option.attr('dollar_balance'));
        calc_balance();
        $('input[name="mobile"]').val(option.attr('mobile'));
      
        $('input[name="customer_name"]').val(option.attr('customer_name'));
        $('input[name="customer_id"]').val(option.attr('customer_id'))//[0].toString().replace('id:','').replace('\\',''));
      }
 



 function cards_box_filter(){
     $('.ui-autocomplete .ui-menu-item .ui-menu-item-wrapper').each(function(){
        value = $(this).text().replace("\\",'').split("'");  
        id = "<span class=hiden_id>"+value[0].toString()+"'</span>";//.replace('id:','').replace('\\','')+"</span>";
        balance = value[2].split('and');//(value[2].includes('and'))?value[2].split('and'):[];
        balance[0] ="<pre class="+ ((balance[0].toString().includes('-'))?'debt_color':'in_color')+">"+balance[0].toString()+"</pre>";  // ksh
        balance[1] ="<pre class="+ ((balance[1].toString().includes('-'))?'debt_color':'in_color')+">"+balance[1].toString()+"</pre>";  // $
        mobile = value[3].toString(); // mobile
        name = value[1].replace("\\",''); // name

    complate = id+name+'('+mobile+')'+balance[0]+'|'+balance[1];
    $(this).html(complate);
     
    });
     if(!$('ul').hasClass('ui-autocomplete')){
           clearInterval(cards_box_timer);
      } 
}





      function calc_balance(){

          cash_balance = $('#cash_balance').attr('cash_balance');
          dollar_balance = $('#dollar_balance').attr('dollar_balance');

          $('#cash_balance').html('ksh'+CommaFormattedN(Number(cash_balance.replace(',',''))+return_digit( $('input[name="cash_in"]').val().toString().replace(/,/g , '')) - return_digit( $('input[name="cash_out"]').val().toString().replace(/,/g , '')))+'');
          $('#dollar_balance').html('$'+CommaFormattedN(Number(dollar_balance.replace(',',''))+return_digit( $('input[name="dollar_in"]').val().toString().replace(/,/g , '')) - return_digit( $('input[name="dollar_out"]').val().toString().replace(/,/g , ''))));
         
          $('#cash_balance').removeClass(((!$('#cash_balance').html().includes('-'))?'debt_color':'in_color')).addClass((($('#cash_balance').html().includes('-'))?'debt_color':'in_color'));
          $('#dollar_balance').removeClass(((!$('#dollar_balance').html().includes('-'))?'debt_color':'in_color')).addClass((($('#dollar_balance').html().includes('-'))?'debt_color':'in_color'));

      }
 