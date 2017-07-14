jQuery(document).ready(function($) {
	
	$('#wp_fields').change(function() {
		if(($(this).val() != '') && ($('#egoi').val() != '')){
			$('#hide_button').show();
		}else{
			$('#hide_button').hide();
		}
	});

	$('#egoi').change(function() {
		if(($(this).val() != '') && ($('#wp_fields').val() != '')){
			$('#hide_button').show();
		}else{
			$('#hide_button').hide();
		}
	});

	$('#save_map_fields').click(function() {
		
		var $wp = $('#wp_fields');
		var $wp_name = $('#wp_fields option:selected');
		var $egoi = $('#egoi');
		var $egoi_name = $('#egoi option:selected');

		if(($wp.val() != '') && ($egoi.val() != '')){

			$('#load_map').show();

			$.ajax({
			    type: 'POST',
			    data:({
			        wp: $wp.val(),
			        wp_name: $wp_name.text(),
			        egoi: $egoi.val(),
			        egoi_name: $egoi_name.text(),
			        token_egoi_api: 1
			    }),
			    success:function(data, status) {
			       	if(data == 'ERROR'){
			       		$('#error_map').show();
			       	}else{
			       		$(data).appendTo('#all_fields_mapped');
			       		$('#error_map').hide();
			       	}
			       
			       $('#load_map').hide();
			    },
			    error:function(status){
			    	if(status){
				    	$("#error_map").show();
				    	$('#load_map').hide();
				    }
			    }
			});
		}

	});

});