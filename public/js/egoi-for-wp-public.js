jQuery(document).ready(function($) {
	'use strict';

		var hidden = document.cookie;
		var body = document.body;
		var bar = document.getElementById('egoi-bar');

		bar.style.display = 'none';
		
		function setCookie(hide_bar, cvalue, exdays) {
		    var d = new Date();
		    d.setTime(d.getTime() + (exdays*24*60*60*1000));
		    var expires = "expires="+d.toUTCString();
		    document.cookie = hide_bar + "=" + cvalue + "; " + expires;
		}

		function getCookie(hide_bar) {
			var name = hide_bar + "=";
		    var ca = document.cookie.split(';');
		    for(var i=0; i<ca.length; i++) {
		        var c = ca[i];
		        while (c.charAt(0)==' ') c = c.substring(1);
		        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
		    }
		    return "";
		}
		var subs_bar = getCookie("hide_bar");
		if(subs_bar == '0'){
			$(bar).show();

			$('body').css({'padding-top': '45px'});

			$('#tab_egoi_footer').addClass('egoi-bottom-close-action');
			$('#tab_egoi_footer').removeClass('egoi-bottom-open-action');

			$('#tab_egoi_footer_fixed').removeClass('egoi-bottom-open-action');
			$('#tab_egoi_footer_fixed').addClass('egoi-bottom-close-action');

			$('#tab_egoi').addClass('egoi-close-action');
			$('#tab_egoi').removeClass('egoi-open-action');

			if($('#tab_egoi_footer_fixed').hasClass('egoi-bottom-close-action')){
				$('body').css({'padding-top': '0px'});
			}

			if($('#tab_egoi_footer').hasClass('egoi-bottom-close-action')){
				$('body').css({'padding-top': '0px'});
			}
			
		}else{
			
			$('#tab_egoi').addClass('egoi-open-action');
			$('#tab_egoi').removeClass('egoi-close-action');
			$('body').css({'padding-top': '0px'});
		}
	
		//header
		jQuery('#tab_egoi').click(function() {
			if($(bar).is(":visible")){
				
				$(this).removeClass('egoi-close-action');
				$(this).addClass('egoi-open-action');
				
				$(bar).fadeOut(400).hide();
				$('body').animate({'padding-top': '0px'}, 100);
				
				setCookie("hide_bar", "1", 20);

			}else{
				
				$(this).removeClass('egoi-open-action');
				$(this).addClass('egoi-close-action');
				$('body').animate({'padding-top': '45px'});	
				
				$(bar).slideDown(400).show();
				setCookie("hide_bar", "0", 20);
			}

			return true;
		});
		
		//footer
		jQuery('#tab_egoi_footer').click(function() {
			if($(bar).is(":visible")){	
				
				$(this).removeClass('egoi-bottom-close-action');
				$(this).addClass('egoi-bottom-open-action');

				$(bar).fadeOut(400).hide();
				setCookie("hide_bar", "1", 20);
			}else{
				
				$(this).removeClass('egoi-bottom-open-action');
				$(this).addClass('egoi-bottom-close-action');

				$(bar).slideDown(400).show();
				$("html, body").animate({ scrollTop: $(document).height() }, 1000);
				setCookie("hide_bar", "0", 20);
			}

			return true;
		});
		
		//when fixed
		jQuery('#tab_egoi_footer_fixed').click(function() {
			if($(bar).is(":visible")){	
				$(this).addClass('egoi-bottom-open-action');
				$(this).removeClass('egoi-bottom-close-action');

				$(bar).hide();
				setCookie("hide_bar", "1", 20);
			}else{
				$(this).addClass('egoi-bottom-close-action');
				$(this).removeClass('egoi-bottom-open-action');

				$(bar).show();
				setCookie("hide_bar", "0", 20);
			}

			return true;
		});

});
