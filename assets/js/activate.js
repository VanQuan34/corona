/* PressMart theme activation*/
jQuery( function ( $ ) {
	"use strict";
	$('body').on('click', '.ftc-activate-btn', function() {
		// alert('tesst');
		var purchase_code = $(".purchase-code").val();
		var activate_btn = $(this);
		activate_btn.addClass('loading');
		if( $.trim(purchase_code) != ''){
		$.ajax({
			type: "POST",
			timeout: 10000,
			url: ajaxurl,
			data: { 
				action: "active_theme_ftc",
				purchase_code : purchase_code,
			 },
			error: function (xhr, err) {
				console.log('err=', err)
			},
			success: function (response) {
				console.log('response=', response);
				if(response && response.trim() === 'failed'){
					alert('Invalid purchase code.');
					$(this).attr('disabled', 'true');
				} 
				else if(response && response.trim() === 'success'){
					alert('Theme activation successful!');
					setTimeout(()=>{
						window.location.href = '';
					}, 500);
				}
				else{
					alert('An error occurred from the server side, Please try again!');
					$(this).removeAttr('disabled');
				}
			},
		  });
	} else {
	alert('Please Enter Purchase Code');
	}
	
	return false;
	});
	
	});