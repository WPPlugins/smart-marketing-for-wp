<script>
jQuery(document).ready(function($) {	
	
	$('.egoi_fields').live("click", function(){

		var id = $(this).data('target');

		//del_map = function (arg, tr_id){
		var tr = 'egoi_fields_'+id;
		$('#load_map').show();
		
		$.ajax({
		    type: 'POST',
		    data:({
		        id_egoi: id
		    }),
		    success:function(data, status) {
		       $('#'+tr).remove();
		       $('#load_map').hide();
		    },
		    error:function(status){
		    	if(status){
			    	$("#error_map").show();
			    	$('#load_map').hide();
			    }
		    }
		});

	});
});
</script>
<div class="row">
	<h1><?php _e('E-goi Fields Mapping', 'egoi-for-wp');?></h1>
	<button style="margin-right: 20px;margin-top: -10%;" type="button" class="button button-secondary" id="TB_closeWindowButton"><?php _e( 'Close', 'egoi-for-wp' ); ?></button>
	<hr />
	<div class="col-sm-6" style="float:left;width: 40%;">
		<h2><?php _e('Wordpress Fields Base', 'egoi-for-wp');?></h2>
			<table class="table">
				<tr>
					<td>
						<select name="wp_fields" id="wp_fields" class="form-control">
							<option value=""><?php _e('Select Wordpress Field', 'egoi-for-wp');?></option>
							<optgroup label="Name">
								<option value="first_name"><?php _e('First Name', 'egoi-for-wp');?></option>
								<option value="last_name"><?php _e('Last Name', 'egoi-for-wp');?></option>
								<option value="user_login"><?php _e('Nickname', 'egoi-for-wp');?></option>
							</optgroup>
							<optgroup label="Contact">
								<option value="user_url"><?php _e('Website', 'egoi-for-wp');?></option>
							</optgroup>
							<optgroup label="About">
								<option value="description"><?php _e('Biographical Info', 'egoi-for-wp');?></option>
							</optgroup><?php
							if (class_exists('WooCommerce')) {
								echo '<optgroup label="Woocommerce">';
								foreach ($wp_fields as $key => $value) {
									echo '<option value="'.$key.'">';
									_e($value, 'egoi-for-wp');
									echo '</option>';
								}
								echo '</optgroup>';
							} ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>

	</div>

	<div class="col-sm-6" style="float:right;width: 60%;">
		<h2><?php _e('E-goi Fields (<span style="font-style:italic;font-size:14px;">From Selected List</span>)', 'egoi-for-wp');?></h2>
			<table class="table">
				<tr>
					<td><?php //var_dump($extra); ?>
						<select name="egoi" id="egoi" style="width: 180px;">
							<option value=""><?php _e('Select E-goi Field', 'egoi-for-wp');?></option><?php
							foreach($egoi_fields as $key => $field){ ?>
								<option value="<?php echo $key;?>"><?php echo $field;?></option><?php
							} ?>
						</select>
					</td>
					<td id="hide_button" style="display:none;">
						&nbsp; <button class="button button-secondary" type="button" id="save_map_fields" style="background:#900;color:#ddd;"><?php _e('Save', 'egoi-for-wp');?></button>
						&nbsp; <div id="load_map" style="display:none;"></div>
					</td>
				</tr>
			</table>
	</div>
</div>

<div id="error_map" style="display:none;"><?php _e('The selected fields are already mapped!', 'egoi-for-wp');?></div>

<div style="width:100%;margin-top:10%;">
	<table class='table' style='width:100%;' id="all_fields_mapped">
		<tr>
			<th style='font-size: x-large;'>Wordpress</th> 
			<th style='font-size: x-large;'>E-goi</th>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr><?php
		foreach ($mapped_fields as $key => $row) { 
			$wc = explode('_', $row->wp); ?>
			<tr id="egoi_fields_<?php echo $row->id;?>"><?php
				if(($wc[0] == 'billing') || ($wc[0] == 'shipping')){?>
					<td style='border-bottom: 1px solid #ccc;font-size: 16px;'><?php echo $row->wp_name;?> (WooCommerce)</td><?php
				}else{ ?>
					<td style='border-bottom: 1px solid #ccc;font-size: 16px;'><?php echo $row->wp_name;?></td><?php
				} ?>
				<td style='border-bottom: 1px solid #ccc;font-size: 16px;'><?php echo $row->egoi_name;?></td>
				<td><button type='button' id='field_<?php echo $row->id;?>' class='egoi_fields button button-secondary' data-target='<?php echo $row->id;?>'>
				<?php _e('Delete', 'egoi-for-wp');?></button></td>
			</tr><?php
		}?>
	</table>
</div>