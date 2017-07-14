<?php
defined( 'ABSPATH' ) or exit;

if(isset($_POST['action'])){
	$egoiform = $_POST['egoiform'];
	$post = $_POST;
	
	update_option($egoiform, $post);
	
	echo '<div class="updated notice is-dismissible"><p>';
		_e('Widgets Settings Updated!', 'egoi-for-wp'); 
	echo '</p></div>';
}

$opt = get_option('egoi_widget');
$egoiwidget = $opt['egoi_widget'];

if(!$egoiwidget['enabled']){
	$egoiwidget['enabled'] = 0;
}
?>

<h1 class="logo">Smart Marketing - <?php _e('Widgets', 'egoi-for-wp');?></h1>
	<p class="breadcrumbs">
		<span class="prefix"><?php echo __('You are here: ', 'egoi-for-wp'); ?></span>
		<strong>Smart Marketing</a> &rsaquo;
		<span class="current-crumb"><?php _e('Widgets Settings', 'egoi-for-wp');?></strong></span>
	</p>
	
		<div class="sidebar">
			<?php include ('egoi-for-wp-admin-sidebar.php'); ?>
		</div>
		<div id="egoi4wp-widget">
			<form method="post" action=""><?php
			settings_fields($FORM_OPTION);?>
			
			<input type="hidden" name="egoiform" value="egoi_widget">
			<table class="form-table" style="table-layout: fixed;">
				<tr valign="top">
					<th scope="row"><?php _e( 'Enable Widget', 'egoi-for-wp' ); ?></th>
					<td class="nowrap">
						<label>
							<input type="radio" name="egoi_widget[enabled]" value="1" <?php checked($egoiwidget['enabled'], 1); ?> />
							<?php _e( 'Yes', 'egoi-for-wp' ); ?>
						</label> &nbsp;
						<label>
							<input type="radio" name="egoi_widget[enabled]" value="0" <?php checked($egoiwidget['enabled'], 0); ?> />
							<?php _e( 'No', 'egoi-for-wp' ); ?>
						</label>
						<p class="help">
							<?php _e( 'Select "yes" to enable forms widget.', 'egoi-for-wp' ); ?>
						</p>
					</td>
				</tr>
				<hr/>
				
				<tr valign="top">
					<th scope="row"><label for="egoi_form_sync_subscribed"><?php _e( 'Successfully subscribed', 'egoi-for-wp' ); ?></label></th>
					<td>
						<input type="text" style="width:450px;" id="egoi_form_sync_subscribed" name="egoi_widget[msg_subscribed]" value="<?php echo esc_attr($egoiwidget['msg_subscribed']); ?>" />
						<p class="help"><?php _e( 'The text that shows when an email address is successfully subscribed to the selected list.', 'egoi-for-wp' ); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="egoi_form_sync_invalid_email"><?php _e( 'Invalid email address', 'egoi-for-wp' ); ?></label></th>
					<td>
						<input type="text" style="width:450px;" id="egoi_form_sync_invalid_email" name="egoi_widget[msg_invalid]" value="<?php echo esc_attr($egoiwidget['msg_invalid']); ?>" />
						<p class="help"><?php _e( 'The text that shows when an invalid email address is given.', 'egoi-for-wp' ); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="egoi_form_sync_email_empty"><?php _e( 'Empty email address', 'egoi-for-wp' ); ?></label></th>
					<td>
						<input type="text" style="width:450px;" id="egoi_form_sync_email_empty" name="egoi_widget[msg_empty]" value="<?php echo esc_attr($egoiwidget['msg_empty']); ?>" />
						<p class="help"><?php _e( 'The text that shows when the email is empty.', 'egoi-for-wp' ); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="egoi_form_sync_already_subscribed"><?php _e( 'Already subscribed', 'egoi-for-wp' ); ?></label></th>
					<td>
						<input type="text" style="width:450px;" id="egoi_form_sync_already_subscribed" name="egoi_widget[msg_exists_subscribed]" value="<?php echo esc_attr($egoiwidget['msg_exists_subscribed']); ?>" />
						<p class="help"><?php _e( 'The text that shows when the given email is already subscribed to the selected list.', 'egoi-for-wp' ); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="egoi_form_sync_error"><?php _e( 'General error' ,'egoi-for-wp' ); ?></label></th>
					<td>
						<input type="text" style="width:450px;" id="egoi_form_sync_error" name="egoi_widget[msg_error]" value="<?php echo esc_attr($egoiwidget['msg_error']); ?>" />
						<p class="help"><?php _e( 'The text that shows when a general error occured.', 'egoi-for-wp' ); ?></p>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><?php _e( 'Hide form after successful sign-up', 'egoi-for-wp' ); ?></th>
					<td class="nowrap">
						<label>
							<input type="radio" name="egoi_widget[hide_form]" value="1" <?php checked($egoiwidget['hide_form'], 1); ?> />
							<?php _e( 'Yes', 'egoi-for-wp' ); ?>
						</label> &nbsp;
						<label>
							<input type="radio" name="egoi_widget[hide_form]" value="0" <?php checked($egoiwidget['hide_form'], 0); ?> />
							<?php _e( 'No', 'egoi-for-wp' ); ?>
						</label>
						<p class="help">
							<?php _e( 'Select "yes" to hide the form after successful sign-up.', 'egoi-for-wp' ); ?>
						</p>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="egoi_form_sync_redirect"><?php _e( 'Redirect to URL after a successful sign-up', 'egoi-for-wp' ); ?></label></th>
					<td>
						<input type="text" style="width:450px;" name="egoi_widget[redirect]" id="egoi_form_sync_redirect" placeholder="<?php printf(__('Example: %s', 'egoi-for-wp'), esc_attr(site_url('/thank-you/')));?>" value="<?php echo esc_attr($egoiwidget['redirect']); ?>" />
						<p class="help"><?php _e( 'Leave empty for no redirect. Otherwise, use complete (absolute) URLs.', 'egoi-for-wp' ); ?></p>
					</td>
				</tr>

				<tr valign="top">
					<td colspan="2">
						<div style="display: -webkit-inline-box;">
							<button style="margin-top: 12px;" type="submit" class="button button-primary"><?php _e('Save Changes', 'egoi-for-wp');?></button>
						</div>
					</td>
				</tr>
			</table>
			</form>
		</div>
