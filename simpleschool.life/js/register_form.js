function add_more_exams() {
  $('.amount_t').append('<tr class="t124 "   >'+$('.more_exams:first').html()+"<td>  <button  title='remove ' style='background:red;font-size: 13px;' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\" $(this).closest('tr').remove(); update_balance(); display_balance_calc_1(); \" role='button' aria-disabled='false'><span class='ui-button-icon-primary ui-icon ui-icon-minus'></span> remove</button></td></tr>");
     $('.t124 ').find("label").addClass('float_label').hide();
     $('.t124 .chzn-container').remove();
     $('.t124 select').find('option:selected').removeAttr('selected');
     $('.t124 select').removeAttr('class').removeAttr('id').chosen({search_contains: true });
     $('.t124').removeClass('t124');

 }

function chosen_student(val,student_id,mobile){

	if ($.trim(val) == 'Add') {
		$('input[name="name"]').fadeIn().val('');
		$('input[name="student_id"]').val('');
		$('input[name="mobile"]').val('');

		
	}else{
				$('input[name="student_id"]').val(student_id);
		         $('input[name="mobile"]').val(mobile);

				$('input[name="name"]').fadeOut().val(val); //.val('');

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