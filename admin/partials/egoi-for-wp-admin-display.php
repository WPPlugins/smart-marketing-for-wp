<?php
$egoi = new Egoi_For_Wp;
update_option('Egoi4WpBuilderObject',$egoi);

$opt = get_option('egoi_data');

$apikey = get_option('egoi_api_key');
$api_key = $apikey['api_key'];

?>
<script type="text/javascript">
	function hide_show_apikey(){
		var apikey = document.getElementById('apikey');
		var span = document.getElementById('api_key_span');
		var ok = document.getElementById('ok');
		var edit = document.getElementById('edit');
		if(apikey.style.display == 'none'){
			span.style.display = 'none';
			edit.style.display = 'none';
			apikey.style.display = 'inline-block';
			ok.style.display = 'inline-block';
		}else{
			apikey.style.display = 'none';
			ok.style.display = 'none';
			span.style.display = 'inline-block';
			edit.style.display = 'block';
		}
	}

</script>
<style type="text/css">
.apikey-error{
    text-align: -webkit-center;
    background: #000;
    font-size: 20px;
    color: #fff;
    line-height: 38px;
}
.form-table th{
	padding: 15px 10px 10px 0 !important;
}
</style>
<h1 class="logo">Smart Marketing - <?php echo __('Account', 'egoi-for-wp');?></h1>
	<p class="breadcrumbs">
		<span class="prefix"><?php echo __('You are here: ', 'egoi-for-wp'); ?></span>
		<strong>Smart Marketing &rsaquo;
		<span class="current-crumb"><?php echo __('Account', 'egoi-for-wp');?></strong></span>
	</p>
<hr/>
<div class='wrap'>
	<div class="main-content">

		<div id="icon-wp-info" class="icon32"></div>
      	<?php 
      	if($api_key!=''){

      		$result = $egoi->getClient();
      		if($result->response == 'INVALID'){ ?>

      			<h3 style="background:#900;color:#fff;padding:5px;text-align: -webkit-center;"><?php echo __('Connection Refused!', 'egoi-for-wp');?></h3>
      			<div class="apikey-error"><?php echo __('API key is invalid OR is empty! Please insert you valid apikey <a href="admin.php?page=egoi-4-wp-account">here</a>', 'egoi-for-wp');?></div><?php

      			update_option('egoi_api_key', '');

      		}else{?>

				<div style="background:#fff;border: 1px solid #ccc;text-align: center;width: 65%;">
					<span style="background:#066;color:#fff;padding:5px;"><?php echo __('Connection Successful!', 'egoi-for-wp');?></span>
					<p><?php echo __('Your plugin is active!', 'egoi-for-wp');?></p>
				</div>
				<br><?php echo __('Your E-goi account information follows below:', 'egoi-for-wp');?>
				<form name='egoi_apikey_form' method='post' action='<?php echo admin_url('options.php');?>'>
				<?php
				settings_fields( Egoi_For_Wp_Admin::API_OPTION );
				settings_errors();
				?>
				<table class="form-table">
				<tr>
					<th>
						<label for="egoi_wp_apikey"><?php echo __('API Key');?></label>
					</th>
					<td>
						<span id="api_key_span"><?php echo $api_key;?></span>
						<input type="text" style="display:none;" size="45" maxlength="40" id="apikey" name="egoi_api_key[api_key]" value="<?php echo $api_key;?>"> &nbsp;&nbsp;
						<span id="ok" class="egoi_apikey_ok" style="display:none;" onclick="document.egoi_apikey_form.submit();">
						<?php echo __('Save', 'egoi-for-wp');?></span>
						<span id="edit" style="background:#666;color:#fff;padding:5px;cursor:pointer;" onclick="hide_show_apikey();"> <?php echo __('Edit my API Key', 'egoi-for-wp');?></span>
					</td>
				</tr>
				</form>
				<tr>
					<th>
						<label for="egoi_wp_clientid"><?php echo __('Client ID', 'egoi-for-wp');?></label>
					</th>
					<td>
						<?php echo $result->CLIENTE_ID; ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="egoi_wp_companyname"><?php echo __('Company Name', 'egoi-for-wp');?></label>
					</th>
					<td>
						<?php echo $result->COMPANY_NAME; ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="egoi_wp_companylegalname"><?php echo __('Company Legal Name', 'egoi-for-wp');?></label>
					</th>
					<td>
						<?php echo $result->COMPANY_LEGAL_NAME; ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="egoi_wp_companytype"><?php echo __('Company Type', 'egoi-for-wp');?></label>
					</th>
					<td>
						<?php echo $result->COMPANY_TYPE; ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="egoi_wp_country"><?php echo __('Country', 'egoi-for-wp');?></label>
					</th>
					<td>
						<?php echo $result->COUNTRY; ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="egoi_wp_state"><?php echo __('State', 'egoi-for-wp');?></label>
					</th>
					<td>
						<?php echo $result->STATE; ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="egoi_wp_city"><?php echo __('City', 'egoi-for-wp');?></label>
					</th>
					<td>
						<?php echo $result->CITY; ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="egoi_wp_address"><?php echo __('Address', 'egoi-for-wp');?></label>
					</th>
					<td>
						<?php echo $result->ADDRESS; ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="egoi_wp_zip"><?php echo __('Zip Code', 'egoi-for-wp');?></label>
					</th>
					<td>
						<?php echo $result->ZIP_CODE; ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="egoi_wp_website">Website</label>
					</th>
					<td>
						<?php echo $result->WEBSITE; ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="egoi_wp_signupdate"><?php echo __('Signup Date', 'egoi-for-wp');?></label>
					</th>
					<td>
						<?php echo $result->SIGNUP_DATE; ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="egoi_wp_credits"><?php echo __('Credits', 'egoi-for-wp');?></label>
					</th>
					<td>
						<?php echo $result->CREDITS; ?>
					</td>
				</tr>
				<tr>
					<th colspan="2">
						<a href="//bo.e-goi.com/?from=<?php echo urlencode('/?action=dados_cliente&menu=sec');?>" target="_blank" class='button-primary' id="egoi_edit_info">
						<?php echo __('Change Account Info', 'egoi-for-wp');?></a>
						<span style="font-style:italic;font-size:14px;"> &nbsp; <?php echo __('You will be redirected to E-goi', 'egoi-for-wp');?></span>
						<p>&nbsp;</p>
						<hr />
					</th>
				</tr>
				<tr>
					<th scope="row"><?php echo __('Remove Data', 'egoi-for-wp');?></th>
					<td class="nowrap">
						<label><input type="radio" name="egoi_data[remove]" <?php checked( $opt, 1 ); ?> value="1"><?php echo __('Yes', 'egoi-for-wp');?></label> &nbsp;
						<label><input type="radio" name="egoi_data[remove]" <?php checked( $opt, 0 ); ?> value="0"><?php echo __('No', 'egoi-for-wp');?></label>
						<p class="help"><?php echo __('Select "Yes" if you want REMOVE the plugin and delete all saved data', 'egoi-for-wp');?>
						</p>
					</td>
				</tr>
				<tr>
					<td style="padding: 0px;">
						<a class='button-secondary' id="egoi_remove_data">
						<?php echo __('Save option', 'egoi-for-wp');?></a>
						<span id="load_data" style="display:none;"></span>
						<span id="valid" style="display:none;"></span>
					</td>
				</tr>
			</table>

				<?php

			}


		}else{ ?>

			<h3><?php echo __('Enter the API key of your E-goi account', 'egoi-for-wp');?></h3>
			
			<form name='egoi_apikey_form' method='post' action='<?php echo admin_url('options.php'); ?>' autocomplete="off">
			<?php
			settings_fields(Egoi_For_Wp_Admin::API_OPTION);
			settings_errors();
			?>
			<table class="form-table">
			<tr>
				<th>
					<label for="egoi_wp_apikey"><?php echo __('Your API key', 'egoi-for-wp');?></label>
				</th>
				<td>
					<input type='text' size='60' name='egoi_api_key[api_key]' id="egoi_api_key_input" /> <div id="valid" style="display:none;"></div>
					<div id="error" style="display:none;"></div><div id="load" style="display:none;"></div>
					<p><?php echo __('To retrieve your E­goi API Key you must login to your E­goi account and click the menu “Apps”', 'egoi-for-wp');?></p>
				</td>
			</tr>
			<tr>
				<th>
					<input type="submit" class='button-primary' name="egoi_4_wp_login" id="egoi_4_wp_login" value="<?php echo __('Save and Connect', 'egoi-for-wp');?>" disabled="disabled" />
				</th>
			</tr>
			</table>
			</form>
			<h4><?php echo __("Don't have an E-goi account?", "egoi-for-wp");?>
			<a href="http://bo.e-goi.com/?action=registo" target="_blank"><?php echo __('Click here to create your account!</a> (takes less than 1 minute)</h4>', 'egoi-for-wp');
		}?>

	</div>
</div>

</body>
</html>
