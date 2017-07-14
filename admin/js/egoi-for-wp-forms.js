jQuery(document).ready(function($) {
	'use strict';
	
	$('#wp-form_content-editor-tools').append('<b>Editor</b>');
	var $context = $( document.getElementById('egoi4wp-form'));
	$context.find('.color').wpColorPicker();

	var $content = $(document.getElementById('tab-content'));
	//var $messages = $(document.getElementById('tab-messages'));
	//var $settings = $(document.getElementById('tab-settings'));
	var $appearance = $(document.getElementById('tab-appearance'));

	$appearance.hide();

	$('#nav-tab-content').click(function() {
		$content.show();
		$appearance.hide();
		$('#nav-tab-content').addClass('nav-tab-active');
		$('#nav-tab-appearance').removeClass('nav-tab-active');
	});

	/*$('#nav-tab-messages').click(function() {
		$messages.show();
			$content.hide();
			$settings.hide();
			$appearance.hide();
			$('#nav-tab-messages').addClass('nav-tab-active');
				$('#nav-tab-content').removeClass('nav-tab-active');
				$('#nav-tab-appearance').removeClass('nav-tab-active');
				$('#nav-tab-settings').removeClass('nav-tab-active');
	});

	$('#nav-tab-settings').click(function() {
		$settings.show();
			$content.hide();
			$messages.hide();
			$appearance.hide();
			$('#nav-tab-settings').addClass('nav-tab-active');
				$('#nav-tab-content').removeClass('nav-tab-active');
				$('#nav-tab-messages').removeClass('nav-tab-active');
				$('#nav-tab-appearance').removeClass('nav-tab-active');
	});*/

	$('#nav-tab-appearance').click(function() {
		$appearance.show();
		$content.hide();
		$('#nav-tab-appearance').addClass('nav-tab-active');
		$('#nav-tab-content').removeClass('nav-tab-active');
	});
	
	$('#select_text_box').click(function() {
		
		var $iframe = $('#form_content_ifr');
		var name = $('#input_fname');

		var iframe = document.getElementById('form_content_ifr');
		var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
		var data = '<input type="text" name="name" id="input_fname" placeholder="'+name.attr('placeholder')+'">';
		$iframe.ready(function() {
			if(innerDoc.getElementById('input_fname') == null){	
				$iframe.contents().find("body").append(data);
			}else {
				alert('First Name field already exists!');
			}
		});

		$('#TB_closeWindowButton').trigger("click");

	});

	$('#select_text_lbox').click(function() {
		
		var $iframe = $('#form_content_ifr');
		var name = $('#input_lname');

		var iframe = document.getElementById('form_content_ifr');
		var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
		var data = '<input type="text" name="name" id="input_lname" placeholder="'+name.attr('placeholder')+'">';
		$iframe.ready(function() {
			if(innerDoc.getElementById('input_lname') == null){	
				$iframe.contents().find("body").append(data);
			}else {
				alert('Last Name field already exists!');
			}
		});

		$('#TB_closeWindowButton').trigger("click");

	});

	$('#select_text_email').click(function() {
		
		var $iframe = $('#form_content_ifr');
		var email = $('#input_email');

		var iframe = document.getElementById('form_content_ifr');
		var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
		var data = '<input type="email" name="email" id="input_email" placeholder="'+email.attr('placeholder')+'">';
		
		$iframe.ready(function() {
			if(innerDoc.getElementById('input_email') == null){	
				$iframe.contents().find("body").append(data);
			}else{
				alert('Email field already exists!');
			}

		});

		$('#TB_closeWindowButton').trigger("click");

	});

	$('#select_text_number').click(function() {
		
		var $iframe = $('#form_content_ifr');
		var phone = $('#input_phone');

		var iframe = document.getElementById('form_content_ifr');
		var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
		var data = '<input type="text" name="phone_number" id="input_phone" placeholder="'+phone.attr('placeholder')+'">';
		$iframe.ready(function() {
			if(innerDoc.getElementById('input_phone') == null){	
				$iframe.contents().find("body").append(data);
			}else{
				alert('Number field already exists!');
			}
		});

		$('#TB_closeWindowButton').trigger("click");

	});

	$('#fname').keyup(function() {
		$("#input_fname").attr('placeholder', $(this).text());
	});

	$('#lname').keyup(function() {
		$("#input_lname").attr('placeholder', $(this).text());
	});

	$('#email').keyup(function() {
		$("#input_email").attr('placeholder', $(this).text());
	});

	$('#phone').keyup(function() {
		$("#input_phone").attr('placeholder', $(this).text());
	});

	$('#select_text_button').click(function() {
		
		var $iframe = $('#form_content_ifr');
		
		var iframe = document.getElementById('form_content_ifr');
		var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
		var data = '<p><button type="submit" id="subscribe_form"> &nbsp;Subscribe&nbsp; </button></p>';

		$iframe.ready(function() {
			
			if(innerDoc.getElementById('subscribe_form') == null){			
				$iframe.contents().find("body").append(data);
			}else{
				alert('Button Subscribe Already Exists');
				
			}
		});

		$('#TB_closeWindowButton').trigger("click");

	});

	$('#close_egoi').click(function() {
		$('#TB_closeWindowButton').trigger("click");
	});

	$('#form_choice').change(function() {
		var e = document.getElementById('form_choice');
		var option = e.options[e.selectedIndex].value;

		if(option == 'popup'){
			$('#help_popup').show();
			$('#help_html').hide();
			$('#help_iframe').hide();
		}else if(option == 'html'){
			$('#help_popup').hide();
			$('#help_iframe').hide();
			$('#help_html').show();
		}else if(option == 'iframe'){
			$('#help_popup').hide();
			$('#help_html').hide();
			$('#help_iframe').show();
		}

	});


	$('#get_type_form').click(function() {
		$('#form_type').trigger("click");
	});

	//Preview Form
	$('#preview_form').click(function() {
		$('#form_egoint').trigger('click');

		var TBwindow = $('#TB_window');
		$('#TB_ajaxContent').css('width', '700px');
  		TBwindow.css('width', '730px');
	});

	// ---------FORM E-GOI ---
	$('#formid_egoi').change(function() {
		var e = document.getElementById('formid_egoi');
		var strUser = e.options[e.selectedIndex].value;
		var res = strUser.split(" - ");

		if(strUser != ''){
			$.ajax({
			    url: '//'+window.location.host+'/wp-content/plugins/egoi-for-wp/admin/partials/custom/egoi-for-wp-form_egoi.php',
			    type: 'POST',
			    data:({
			        id: res[0],
			        url: res[1]
			    }),
			    success:function(data, status) {
			        $('#egoi_form_inter').html(data);
			        $('#form_egoint').trigger('click');

			        var TBwindow = $('#TB_window');
					$('#TB_ajaxContent').css('width', '700px');
			  		TBwindow.css('width', '730px');
			    },
			    error:function(status){
			    	if(status){
				    	$("#valid").hide();
				    	$("#error").show();
				    }
			    }
			});
		}

	});

});
