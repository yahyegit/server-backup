function chosen_sender(el){





	if ($.trim(el.val()) == 'Add') {
		$('input[name="sender_name"]').fadeIn().val('');
		$('input[name="sender_mobile"]').val('');
		$('input[name="sender_id_no"]').val('');

	}else{

		$('input[name="sender_name"]').fadeOut().val(el.attr('sender_name'));
		$('input[name="sender_mobile"]').val(el.attr('sender_mobile'));
		$('input[name="sender_id_no"]').val(el.attr('sender_id_no'));

	}

}

function chosen_user(el){

	if ($.trim(el.val()) == 'choose..') {
		$('input[name="user_id"]').val('');
		$('.rem').val('0');
       $('.rem_s').val('0');
 
	}else{

		$('input[name="user_id"]').val(el.attr('user_id'));
		$('.rem').val(CommaFormattedN(el.attr('rem'))).attr('bl',el.attr('rem'));
 		$('.rem_s').val(CommaFormattedN(el.attr('send_rem'))).attr('bl',el.attr('send_rem'));

	}


} 

 function remaining_calc(){
 	 $('.remaining_limit').val();
 	 	am  = clean($("input[name='amount']").val());
 	 	am = (am.toString() == 'NaN')?0:am;

 	   bl = clean($('.remaining_limit').attr('bl'));
 	   $('.remaining_limit').val(CommaFormattedN(bl - am));

		if((bl - am).toString().includes('-')){
 			$("input[name='amount']").addClass('error_input');
		}else{
			$("input[name='amount']").removeClass('error_input');
		}


 
 }


 function remaining_calc_(){
 	 	am  =  clean($("input[name='amount']").val());
 	 	am = (am.toString() == 'NaN')?0:am;

 	 	send_amount  =  clean($("input[name='send_amount']").val());
 	 	send_amount = (send_amount.toString() == 'NaN')?0:send_amount;

 	   bl = clean($('.rem').attr('bl'));
 	   $('.rem').val(CommaFormattedN(bl + am));
  
 	   bl = clean($('.rem_s').attr('bl'));
 	   $('.rem_s').val(CommaFormattedN(bl + send_amount));
  

 }


function chosen_pay_to(el){
 
 

	if ($.trim(el.val()) == 'Add') {
		$('input[name="pay_to_name"]').fadeIn().val('');
		$('input[name="pay_to_mobile"]').val('');
		$('input[name="sender_id_no"]').val('');

		
	}else{
		$('input[name="pay_to_name"]').fadeOut().val(el.attr('pay_to_name'));
		$('input[name="pay_to_mobile"]').val(el.attr('pay_to_mobile'));
		$('input[name="pay_to_id"]').val(el.attr('pay_to_id'));

	}

}




function update_balance(){
val = 0 ;
	$('input[name="cost"]').each(function (){

			val += Number($(this).attr('cost').replace(/,/g, ''));
	});
	
	paid = (Number($('input[name="paid"]').val().replace(/,/g, '')) == 'NaN')?0:Number($('input[name="paid"]').val().replace(/,/g, ''));
	bl = val - paid;
	bl = (bl == 'NaN')?0:bl;

	$('input[name="balance"]').attr('size',bl.length).val(CommaFormattedN(bl));
	if (bl.toString().includes('-')){
		$('input[name="balance"]').css('border','2px solid red');
	}else{
		 $('input[name="balance"]').removeAttr('style');//css('border','2px solid red');

	}
}


function update_balance2(){
 
	
	paid = (Number($('input[name="paid"]').val().replace(/,/g, '')) == 'NaN')?0:Number($('input[name="paid"]').val().replace(/,/g, ''));
	bl = (Number($('input[name="balance"]').attr('bl').replace(/,/g, '')) == 'NaN')?0:Number($('input[name="balance"]').attr('bl').replace(/,/g, ''));
    bl = bl - paid;
	bl = (bl == 'NaN')?0:bl;

	$('input[name="balance"]').attr('size',bl.length).val(CommaFormattedN(bl));
	if (bl.toString().includes('-')){
		$('input[name="balance"]').css('border','2px solid red');
	}else{
		 $('input[name="balance"]').removeAttr('style');//css('border','2px solid red');

	}
}



function chosen_course(el) {

				if (el.val() == 'Add') {
					 el.closest('tr').find('input[name="course"]').fadeIn().val('');
 				     el.closest('tr').find('input[name="cost"]').attr('cost',0).val('');
				     el.closest('tr').find(' input[name="duration"]').val('');

				}else{

				     el.closest('tr').find('input[name="course"]').fadeOut().val(el.val());
				     el.closest('tr').find('input[name="cost"]').attr('cost',el.attr('cost')).val(CommaFormattedN(el.attr('cost')));
				     el.closest('tr').find('input[name="duration"]').val(el.attr('duration'));
				}
update_balance();
}

 