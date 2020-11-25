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
 
	}else{

		$('input[name="user_id"]').val(el.attr('user_id'));
		$('.rem').val(CommaFormattedN(el.attr('rem'))).attr('bl',el.attr('rem'));
 
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

 	   bl = clean($('.rem').attr('bl'));
 	   $('.rem').val(CommaFormattedN(bl + am));
  
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



function add_more_row(){
  $('.amount_t').append('<tr class="t124 "   >'+$('.first_').html()+"<td>  <button  title='remove ' style='background:red;font-size: 13px;' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\" $(this).closest('tr').remove(); update_balance(); display_balance_calc_1(); \" role='button' aria-disabled='false'><span class='ui-button-icon-primary ui-icon ui-icon-minus'></span> remove</button></td></tr>");
     $('.t124 ').find("label").addClass('float_label').hide();
     $('.t124 .chzn-container').remove();
     $('.t124 select').find('option:selected').removeAttr('selected');
     $('.t124 select').removeAttr('class').removeAttr('id').chosen({search_contains: true });
 	 $('.t124 input[name="course"]').hide();
     $('.t124').removeClass('t124');
}