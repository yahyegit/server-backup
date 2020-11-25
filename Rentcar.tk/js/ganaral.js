
// date diff
var DateDiff = {
 
    inDays: function(d1, d2) {
        var t2 = d2.getTime();
        var t1 = d1.getTime();
 
        return parseInt((t2-t1)/(24*3600*1000));
    },
 
    inWeeks: function(d1, d2) {
        var t2 = d2.getTime();
        var t1 = d1.getTime();
 
        return parseInt((t2-t1)/(24*3600*1000*7));
    },
 
    inMonths: function(d1, d2) {
        var d1Y = d1.getFullYear();
        var d2Y = d2.getFullYear();
        var d1M = d1.getMonth();
        var d2M = d2.getMonth();
 
        return (d2M+12*d2Y)-(d1M+12*d1Y);
    },
 
    inYears: function(d1, d2) {
        return d2.getFullYear()-d1.getFullYear();
    }
}
 




// loading func
loading_state = 'off';
j = '';
function loading_fun(size,time){  // time = 13 to finish,  to start time = 15
	width = (time == '13')?Number(size):0; 	 
	$('.horizantal_loading').fadeIn();
j = setInterval(function (){
		loading_state = 'on';
 			if(time == '13'){
				// finsh
				if(width >= 100){
					width++;
				//	 console.log(width+'  | about to finish');
 					if(width == 140){
						$('.horizantal_loading').removeAttr('current_size').hide();
							loading_state = 'off';
							// console.log(width+'  | finished ');
							clearInterval(j);
					}else if(width >= 141){
				//		 console.log(width+'  | ........ ');
						 clearInterval(j);
					}	 				
				}else{
					width++; 
				//	 console.log(width+'  | second');
					$('.horizantal_loading').css('width',width+'%').show().css('visibility','visible');
				}
			}else if($.trim(size) == 'finish'){
				if(width == 100){
					$('.horizantal_loading').removeAttr('current_size').hide();
					loading_state = 'off';
					clearInterval(j);
				}else{	
				//	console.log(width+'  | tab');
					width++; // = parseInt(width;
					$('.horizantal_loading').css('width',width+'%').show().css('visibility','visible');
				}
				if(width >= 102){
						window.location.reload();
					}	 
			}else{
				
				if(width == 80){
					$('.horizantal_loading').attr('current_size',width).show().css('visibility','visible');
					loading_state = 'off';
					clearInterval(j);
				}else{	
					//console.log(width+'  | first');
					width++; // = parseInt(width;
					$('.horizantal_loading').css('width',width+'%').show().css('visibility','visible');
				}
				   if(width >= 102){
						window.location.reload();
					}
			}
	},time);
}  




// seccess func
function success_fun_(msg){
	$('#error').hide();
	// display seccess massage
  	$('#success').html('<img src="css/success.gif" alt="success" style="border-radius:2em; width:60px; height:40px; margin-right: 4px; "/>'+msg).fadeIn();
 	$('div.ui-dialog-content').dialog('close');
}

// error func
function error_func(msg){
  	$('div#error').html('<img src="css/error.jpg" alt="error" style="border-radius:2em; width:60px; height:40px; margin-right: 4px;"/>'+msg).fadeIn().delay('10000').fadeOut();
}
