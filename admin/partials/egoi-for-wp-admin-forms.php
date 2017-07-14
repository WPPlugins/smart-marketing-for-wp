<?php 
defined( 'ABSPATH' ) or exit;

$Egoi4WpBuilderObject = get_option('Egoi4WpBuilderObject');
$form_id = $_GET['form'];

if(isset($_POST['action'])){
	
	$post = $_POST;
	$post['egoi_form_sync']['form_content'] = htmlentities($_POST['egoi_form_sync']['form_content']);
	$egoiform = $post['egoiform'];
	
	update_option($egoiform, $post);
	
	echo '<div class="updated notice is-dismissible"><p>';
		_e('Form Updated!', 'egoi-for-wp');
	echo '</p></div>';
}

add_thickbox();
$lists = $Egoi4WpBuilderObject->getLists();
?>

<style type="text/css">
	#TB_ajaxContent{
		overflow: hidden !important;
	}
	.form-table td{
		width: 80%;
	}
	.label_span{
		font-size: 14px;
		font-weight: 600;
	}
	#disabled{
		background: #5B5E5F !important;
   		border-color: none !important;
    	box-shadow: none !important;
	}
	#disabled:hover{
		background: #5B5E5F !important;
		cursor: default;
	}
</style>
<h1 class="logo">Smart Marketing - <?php _e('Forms', 'egoi-for-wp');?></h1>
	<p class="breadcrumbs">
		<span class="prefix"><?php echo __('You are here: ', 'egoi-for-wp'); ?></span>
		<strong>Smart Marketing &rsaquo;<?php
		if(isset($_GET['form'])){ ?>
			<a href="<?php echo admin_url( 'admin.php?page=egoi-4-wp-form' ); ?>"><?php _e('Forms List', 'egoi-for-wp');?></a> &rsaquo;
			<span class="current-crumb"><?php _e('Form '.$form_id, 'egoi-for-wp');?></strong></span><?php
		}else{ ?>
			<span class="current-crumb"><?php _e('Forms List', 'egoi-for-wp');?></strong></span><?php
		} ?>
	</p>
<hr/>

<div class="wrap egoi4wp-settings">

	<div class="row">
	<?php
	if(isset($_GET['form']) && ($_GET['type']) && ($_GET['form'] <= 5)){
		

		include 'egoi-for-wp-admin-shortcodes.php';
		$FORM_OPTION = get_optionsform($form_id);
		$opt = get_option($FORM_OPTION);?>

		<!-- Main Content -->
		<div id="egoi4wp-form" class="main-content col col-4">

			<p>
				<form method="get" action="#">
					<input type="hidden" name="page" value="egoi-4-wp-form">
					<input type="hidden" name="form" value="<?php echo $form_id;?>">
					<span class="label_span"><?php _e('Select the Form Type you want', 'egoi-for-wp');?></span>
						<select name="type" style="width: 250px;" id="form_choice" onchange="this.form.submit();">
							<option value="" disabled><?php _e('Type', 'egoi-for-wp');?></option>
							<option value="popup" <?php selected($_GET['type'], 'popup');?>><?php _e('E-goi Popup', 'egoi-for-wp');?></option>
							<option value="html" <?php selected($_GET['type'], 'html');?>><?php _e('E-goi Advanced HTML', 'egoi-for-wp');?></option>
							<option value="iframe" <?php selected($_GET['type'], 'iframe');?>><?php _e('E-goi Iframe', 'egoi-for-wp');?></option>
						</select>
				</form>
			</p>

			<div style="background:#fff;border: 1px solid #ccc;text-align: center;">
				<input type="text" onfocus="this.select();" style="border:none;box-shadow:none;" readonly="readonly" value="<?php echo '[egoi_form_sync_'.$form_id.']';?>" size="17">
				<p class="egoi4wp-form-usage">
					<b><?php _e('Use this shortcode to display this form inside a post or page.', 'egoi-for-wp');?></b>
				</p>
			</div><p>

			<form method="post" action="#"><?php
				settings_fields($FORM_OPTION);?>

				<input type="hidden" name="egoi_form_sync[egoi]" value="<?php echo $_GET['type'];?>">
				<div id="titlediv" class="small-margin">
					<div id="titlewrap">
						<label class="screen-reader-text" for="title"><?php _e('Form Title', 'egoi-for-wp'); ?></label>
						<input type="hidden" name="egoi_form_sync[form_id]" value="<?php echo $form_id;?>">
						<input type="text" name="egoi_form_sync[form_name]" size="30" value="<?php echo $opt['egoi_form_sync']['form_name'];?>" id="title" spellcheck="true" autocomplete="off" placeholder="<?php echo __( "Form Title", 'egoi-for-wp' ); ?>" style="line-height: initial;" required pattern="\S.*\S">
						<input id="shortcode" type="hidden" name="egoiform" value="<?php echo 'egoi_form_sync_'.$form_id;?>">
					</div>
				</div>

				<h2 class="nav-tab-wrapper" id="egoi4wp-tabs-nav">

					<a class="nav-tab nav-tab-content nav-tab-active" id="nav-tab-content" style="cursor: pointer;" ><?php _e('Form | Content', 'egoi-for-wp');?></a>
					<a class="nav-tab nav-tab-appearance" id="nav-tab-appearance" style="cursor: pointer;"><?php _e('Form | Styles', 'egoi-for-wp');?></a>

				</h2>
				
				<div id="tab-content">
					<?php include ('custom/egoi-for-wp-form-content.php'); ?>
				</div>
				<div id="tab-appearance">
					<?php include ('custom/egoi-for-wp-form-appearance.php'); ?>
				</div>

				<div style="display: -webkit-inline-box;">
					<button style="margin-top: 12px;" type="submit" class="button button-primary"><?php _e('Save Changes', 'egoi-for-wp');?></button><?php
					if($opt['egoi_form_sync']['list']){?>
						<p style="padding-left: 20px;">
							<a target="_blank" class="button-secondary" tabindex="-1" id="preview_form">
								<span class="dashicons dashicons-welcome-view-site" style=""></span>
								<?php _e( 'Preview this form', 'egoi-for-wp' ); ?>
							</a>
						</p><?php
					} ?>
				</div>
			</form>
		</div>

		<?php
	}else{ ?>

		<a href="#TB_inline?width=0&height=450&inlineId=egoi-for-wp-form-choice&modal=true" id="form_type" class="thickbox button-secondary" style="display:none;"></a>
		
		<div class="main-content col col-4">
			<h2><?php echo __('Max number of forms:', 'egoi-for-wp');?> 5</h2>
			<table border='0' class="widefat striped">
			<thead>
				<tr>
					<th><?php _e('Form ID', 'egoi-for-wp');?></th>
					<th><?php _e('Title', 'egoi-for-wp');?></th>
					<th><?php _e('Shortcode', 'egoi-for-wp');?></th>
					<th><?php _e('Active', 'egoi-for-wp');?></th>
					<th><?php _e('Option', 'egoi-for-wp');?></th>
				</tr>
			</thead><?php

			$form_exists = '';
			for ($j=1; $j<=5; $j++){
				$form = get_option('egoi_form_sync_'.$j);
				if($form['egoi_form_sync']['form_id']){?>
					<tr>
						<td><?php echo $j;?></td>
						<td><?php echo $form['egoi_form_sync']['form_name'];?></td>
						<td><?php echo "[egoi_form_sync_$j]";?></td>
						<td><?php echo ($form['egoi_form_sync']['enabled']) ? '<div id="active">&nbsp;</div>' : '<div id="inactive">&nbsp;</div>';?></td>
						<td><a href="<?php echo $_SERVER['REQUEST_URI'];?>&form=<?php echo $j;?>&type=<?php echo $form['egoi_form_sync']['egoi'];?>">
						<?php _e('Edit', 'egoi-for-wp');?></a></td>
					</tr><?php
					$form_exists .= $form['egoi_form_sync']['form_id'].' - ';
				}
			}	

			$count_op = count(array_filter(explode(' - ', $form_exists)));
			if($count_op == 0){
				echo "<td colspan='3'>";
					_e('Subscriber Forms are empty', 'egoi-for-wp');
				echo "</td>";
			} ?>
			</table>

			<p><?php
				if($count_op == 5){ ?>
					<a id="disabled" class='button-primary'><?php _e('Create a new form', 'egoi-for-wp');?></a><?php
				}else{ ?>
					<a href="<?php echo $_SERVER['REQUEST_URI'];?>&form=<?php echo ($count_op+1);?>&type=html" class='button-primary'><?php _e('Create a new form', 'egoi-for-wp');?></a><?php
				} ?>
			</p>
		</div>

		<?php
			
	} ?>
	

	</div>
		
		<div class="sidebar">
			<?php include ('egoi-for-wp-admin-sidebar.php'); ?>
		</div>
			
		<div id="egoi-for-wp-form-choice" style="display:none;">
			<?php //include(dirname( __FILE__ ).'/custom/egoi-for-wp-form-choice.php');?>
		</div>

</div>
