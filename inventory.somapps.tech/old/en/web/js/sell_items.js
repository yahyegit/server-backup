

 function chosen_custtomer(el){
 		if (el.val() == 'choose..'){$('input[name="customer_name"]').hide();$('.c_info').hide(); return false;}

		$('.c_info').show();

 			if (el.val() == 'Add new'){
				$('input[name="customer_name"]').val('').fadeIn().focusin();

				$('input[name="customer_id"]').val('');
				 $('input[name="mobile"]').val('');
				 $('input[name="address"]').val('');
				 $('input[name="email"]').val('');
 
			}else{
			    $('input[name="address"]').val(el.attr('address'));
				$('input[name="customer_name"]').val(el.val()).hide();
				$('input[name="customer_id"]').val(el.attr('customer_id'));
				$('input[name="mobile"]').val(el.attr('mobile'));
				$('input[name="email"]').val(el.attr('email'));
 	
			}
 }


 function add_more_row(){
   $('.amount_t').append('<tr class="t124 "  >'+$('.first_row').html()+"<td>  <button  title='remove ' style='background:red;font-size: 13px;' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"$(this).closest('tr').remove(); realTimeBl(); \" role='button' aria-disabled='false'><span class='ui-button-icon-primary ui-icon ui-icon-minus'></span> remove</button></td></tr>");
   $('.t124 ').find("label").addClass('float_label').hide();
   $('.t124 *').removeClass('error_border');
    // refresh chosen 
 $('.t124 .chzn-container').remove();
     $('.t124 select').find('option:selected').removeAttr('selected');
     $('.t124 select').removeAttr('class').removeAttr('id').chosen({search_contains: true });

     $('.t124').fadeIn().removeClass('t124');

  
}
 

 function items_salling(e){

 	if (e.val() == 'choose..'){return false;}

			if (e.val() == 'add new items'){

			    r_page('','','pages/forms/receive_items_form.php');


			}else{
 				$('input[name="price"]').attr('price',e.attr('price')).val(CommaFormattedN(e.attr('price')));
                $('input[name="item_name"]').val(e.val());
                 e.closest('tr').find('input[name="rem"]:first').attr('rem',e.attr('rem')).val(e.attr('rem'));
                 e.closest('tr').find('input[name="quantity"]:first').val('');
			}
 realTimeBl();

}

function realTimeBl(){

			// update balance 
			bl = 0;
			price = 0;
			$('input[name="price"]').each(function(){
                    quantity = clean($(this).closest('tr').find("input[name='quantity']:first").val());
                    price_t =  parseInt($(this).closest('tr').find("input[name='price']:first").attr('price'))*quantity;
//console.log(price_t);
//console.log('single:w '+ $(this).closest('tr').find("input[name='price']:first").attr('price'));
					price = price+price_t;

				 
		
                    rem = clean($(this).closest('tr').find("input[name='rem']:first").attr('rem'));
                     $(this).closest('tr').find("input[name='rem']:first").attr('type','text').val(CommaFormattedN(rem-quantity));

			$(this).closest('tr').find("input[name='price']:first").attr('type','text').val(price_t);

		    if((rem-quantity).toString().includes('-')) {
				$(this).closest('tr').find("input[name='rem']:first").attr('style','border:2px solid red !important;');
								error_func('invalid quantity   !');

				return false;
			}else{
				$('#error').hide();  

				$(this).closest('tr').find("input[name='rem']:first").removeAttr('style','border:2px solid red !important;');
			}
				 
			});

 

			amount = clean($('input[name="amount"]').val());
			discount = clean($('input[name="discount"]').val());
			full_amount = amount+discount;
			bl = price-full_amount;
			$('input[name="balance"]').val(CommaFormattedN(bl));
			 
			 if (bl.toString().includes('-')) {
				error_func('invalid paid or discount  !');
				$('input[name="balance"]').css('border','1px solid red !important;');
				return false;
			}else{
					$('input[name="balance"]').css('border','none important;');
			}


 
 }


