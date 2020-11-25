   
      function customer_info(value){
        value = value.replace("\\",'').split("'");
        balance = value[2].split('and');
        console.log(balance);
        $('#cash_balance').attr('cash_balance',balance[0].toString().replace('ksh','').replace('\\',''));
        $('#dollar_balance').attr('dollar_balance',balance[1].toString().replace('$','').replace('\\',''));
        calc_balance();
        $('input[name="mobile"]').val(value[3].toString().replace('|',''));
        val = value[1].replace("\\",''); console.log(value);
        $('input[name="customer_name"]').val(val);
        $('input[name="customer_id"]').val(value[0].toString().replace('id:','').replace('\\',''));
      }
 

      function calc_balance(){
          cash_balance = $('#cash_balance').attr('cash_balance');
          dollar_balance = $('#dollar_balance').attr('dollar_balance');

          $('#cash_balance').html(CommaFormattedN(Number(cash_balance.replace(',',''))+return_digit( $('input[name="cash_in"]').val().toString().replace(/,/g , '')) - return_digit( $('input[name="cash_out"]').val().toString().replace(/,/g , '')))+'ksh');
          $('#dollar_balance').html('$'+CommaFormattedN(Number(dollar_balance.replace(',',''))+return_digit( $('input[name="dollar_in"]').val().toString().replace(/,/g , '')) - return_digit( $('input[name="dollar_out"]').val().toString().replace(/,/g , ''))));
         
          $('#cash_balance').removeClass(((!$('#cash_balance').html().includes('-'))?'debt_color':'in_color')).addClass((($('#cash_balance').html().includes('-'))?'debt_color':'in_color'));
          $('#dollar_balance').removeClass(((!$('#dollar_balance').html().includes('-'))?'debt_color':'in_color')).addClass((($('#dollar_balance').html().includes('-'))?'debt_color':'in_color'));

      }
 