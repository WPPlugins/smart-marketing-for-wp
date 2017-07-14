jQuery(document).ready(function($) {
	'use strict';

	var $context = $( document.getElementById( 'egoi4wp-admin' ) );
	$context.find('.color').wpColorPicker();

	$("#egoi_api_key_input").keyup(function() {

		var key = $(this).val();
		if(key.length == 40){

			$("#load").show();
			
			$.ajax({
			    type: 'POST',
			    data:({
			        key: key
			    }),
			    success:function(data, status) {
			        
			        if(status=='404'){
			        	$("#egoi_4_wp_login").attr('disabled', 'disabled');
			        	$("#error").show();
			        	$("#valid").hide();
			        	$("#load").hide();
			        }else{
			        	$("#egoi_4_wp_login").removeAttr('disabled');
			        	$("#valid").show();
			        	$("#error").hide();
			        	$("#load").hide();
			        }
			    },
			    error:function(status){
			    	if(status){
				    	$("#egoi_4_wp_login").attr('disabled', 'disabled');
				    	$("#valid").hide();
				    	$("#error").show();
				    	$("#load").hide();
				    }
			    }
			});

		}else{
			$("#egoi_4_wp_login").attr('disabled', 'disabled');
			$("#valid").hide();
		}

	});

	// remove data from WP
	$('#egoi_remove_data').click(function() {

		var rmdata = $('input[name="egoi_data[remove]"]:checked').val();
		$('#load_data').show();

		$.ajax({
		    type: 'POST',
		    data:({
		        rmdata: rmdata
		    }),
		    success:function(data, status) {
		        $("#valid").show();
		        $("#load_data").hide();
		        $("#error").hide();
		    },
		    error:function(status){
		    	if(status){
			    	$("#valid").hide();
			    	$("#error").show();
			    }
		    }
		});
	});

});
