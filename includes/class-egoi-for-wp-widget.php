<?php
/*
*
* Class to estend Widgets in E-goi
* 
*/
class Egoi4Widget extends WP_Widget {
	
	private $egoi_id;

	public function __construct() {
		
		$opt = get_option('egoi_widget');
		$this->widget_enabled = $opt['egoi_widget']['enabled'];
		$this->redirect = $opt['egoi_widget']['redirect'];
		$this->subscribed = $opt['egoi_widget']['msg_subscribed'];
		
		$widget_ops = array(
			'classname' => 'Egoi4Widget',
			'description' => 'E-goi Form Widget'
		);
		parent::__construct(false, $name = 'Smart Marketing Widget', $widget_ops);
		wp_enqueue_script('jquery');
		
	}
	
	public function widget($args, $instance) {
		
		if($this->widget_enabled){
			wp_enqueue_style('egoi-style', plugin_dir_url( __FILE__ ).'../public/css/egoi-for-wp-public.css');
			
			extract($args);
			$widgetid = $args['widget_id'];
			$this->egoi_id = $widgetid;
			
			$title = apply_filters('widget_title', $instance['title']);
			$list = $instance['list'];
			$fname = $instance['fname'];
			$fname_label = $instance['fname_label'];
			$lname = $instance['lname'];
			$lname_label = $instance['lname_label'];
			$email = $instance['email'];
			$email_label = $instance['email_label'];
			$mobile = $instance['mobile'];
			$mobile_label = $instance['mobile_label'];
			$button = $instance['button'];
			$tag = $instance['tag'];
			
			echo $before_widget;
			
			if ($title){
				echo $before_title . $title . $after_title;
			}

			echo '<script type="text/javascript">
					jQuery(document).ready(function($){
						var cl = new CanvasLoader("Loading_'.$this->egoi_id.'");
						cl.setColor(\'#ababab\');
						cl.setShape(\'spiral\');
						cl.setDiameter(28);
						cl.setDensity(77); 
						cl.setRange(1);
						cl.setSpeed(5);
						cl.show(); 
						$("#egoi-submit-sub'.$this->egoi_id.'").click(function() {  
							$(".error'.$this->egoi_id.'").hide();
							$("#Loading_'.$this->egoi_id.'").show();
							$.ajax({
								type : "POST",
								data : 
								{
									egoi_subscribe : "submited",
									widget_list : $("input#egoi-list-sub'.$this->egoi_id.'").val(),
									widget_fname : $("input#egoi-fname-sub'.$this->egoi_id.'").val(),
									widget_lname : $("input#egoi-lname-sub'.$this->egoi_id.'").val(),
									widget_email : $("input#egoi-email-sub'.$this->egoi_id.'").val(),
									widget_mobile : $("input#egoi-mobile-sub'.$this->egoi_id.'").val(),
									widget_id : $("input#egoi-id-sub'.$this->egoi_id.'").val(),
									widget_tag : $("input#egoi-tag-sub'.$this->egoi_id.'").val()
								},
								success : function(response) {
									$("#Loading_'.$this->egoi_id.'").hide();
									if(response == "hide"){
										$("#'.$this->egoi_id.'").html("<div class=\'egoi-success\'>'.$this->subscribed.'</div>");
									}else{
										$(response).appendTo($(".egoi_widget_style"));
									}
									if(response == "redirect"){
										$("#'.$this->egoi_id.'").html("<div class=\'egoi-success\'>'.$this->subscribed.'</div>");
										window.location.href="'.$this->redirect.'";
									}
								}
							});
							return false;
						});
					});
				</script>
			
			<div class="egoi_widget_style" id="'.$this->egoi_id.'">
			<form name="fname" id="egoi-widget-form"'.$this->egoi_id.'" action="" method="post">';
			if ($fname){
				echo "<label>".$fname_label."</label>";
				echo "<div class='widget-text'><input type='text' name='egoi-fname-sub".$this->egoi_id."' id='egoi-fname-sub".$this->egoi_id."' style='width:100%;' /></div>";
			}
			
			if ($lname){
				echo "<label>".$fname_label."</label>";
				echo "<div class='widget-text'><input type='text' name='egoi-lname-sub".$this->egoi_id."' id='egoi-lname-sub".$this->egoi_id."' style='width:100%;' /></div>";
			}
			
			echo "<label>".$email_label."</label>
			<div class='widget-text'><input type='text' required name='egoi-email-sub".$this->egoi_id."' id='egoi-email-sub".$this->egoi_id."' style='width:100%;' /></div>";
			if ($mobile){
				echo "<p><label>".$mobile_label."</label>";
				echo "<div class='widget-text'><input type='text' name='egoi-mobile-sub".$this->egoi_id."' id='egoi-mobile-sub".$this->egoi_id."' style='width:100%;' /></div>";
			}

			echo "<input type='hidden' name='egoi-list-sub".$this->egoi_id."' id='egoi-list-sub".$this->egoi_id."' value='".$list."' />
			<input type='hidden' name='egoi-id-sub".$this->egoi_id."' id='egoi-id-sub".$this->egoi_id."' value='".$this->egoi_id."' />
			<input type='hidden' name='egoi-tag-sub".$this->egoi_id."' id='egoi-tag-sub".$this->egoi_id."' value='".$tag."' />
			<input type='submit' class='submit_button' name='egoi-submit-sub".$this->egoi_id."' id='egoi-submit-sub".$this->egoi_id."' value='".$button."' />
			</form>
			<div id='Loading_".$this->egoi_id."' class='loader' style='display:none;'>
			</div>
			</div>
			</aside>";
			$after_widget;
		}
	}
	
	public function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['widgetid'] = strip_tags($new_instance['widgetid']);
		$instance['list'] = strip_tags($new_instance['list']);
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['fname'] = strip_tags($new_instance['fname']);
		$instance['fname_label'] = strip_tags($new_instance['fname_label']);
		$instance['lname'] = strip_tags($new_instance['lname']);
		$instance['lname_label'] = strip_tags($new_instance['lname_label']);
		$instance['email'] = strip_tags($new_instance['email']);
		$instance['email_label'] = strip_tags($new_instance['email_label']);
		$instance['mobile'] = strip_tags($new_instance['mobile']);
		$instance['mobile_label'] = strip_tags($new_instance['mobile_label']);
		$instance['button'] = strip_tags($new_instance['button']);
		$instance['tag'] = strip_tags($new_instance['tag']);

		if($new_instance['tag']){
			$api = new Egoi_For_Wp();
			$tags = $api->getTag($instance['tag']);

			if($tags['NEW_ID']){
				$instance['tag'] = $tags['NEW_ID'];
				$instance['tag_name'] = $tags['NEW_NAME'];
			}else{
				$instance['tag'] = $tags['ID'];
				$instance['tag_name'] = $tags['NAME'];
			}
		}

		return $instance;
	}
	
	public function form($instance) {
		
		if($this->widget_enabled){
			$instance = wp_parse_args( 
				(array)$instance, 
					array(
						'widgetid' => '',
						'list' => '',
						'title' => '', 
						'fname' => '',
						'fname_label' => '',
						'lname' => '',
						'lname_label' => '',
						'email' => '',
						'email_label' => '',
						'mobile' => '',
						'mobile_label' => '',
						'button' => '',
						'tag_name' => ''
					)
			); 

			$widgetid = esc_attr($instance['widgetid']);
			$list_id = esc_attr($instance['list']);
			$title = esc_attr($instance['title']);
			$fname = esc_attr($instance['fname']);
			$fname_label = esc_attr($instance['fname_label']);
			
			$lname = esc_attr($instance['lname']);
			$lname_label = esc_attr($instance['lname_label']);
			
			$email = esc_attr($instance['email']);
			$email_label = esc_attr($instance['email_label']);
			
			$mobile = esc_attr($instance['mobile']);
			$mobile_label = esc_attr($instance['mobile_label']);
			$button = esc_attr($instance['button']);
			
			$tag = esc_attr($instance['tag_name']);

			$Egoi4WP = get_option('Egoi4WpBuilderObject');
			$lists = $Egoi4WP->getLists();

			echo '
			<script>
			jQuery(document).ready(function ($){
				$(\'input[data-attribute="fname_id"]\').click(function (){
					if($(\'input[data-attribute="fname_label"]\').css("display") == "none") {
						$(\'input[data-attribute="fname_label"]\').show();
					}else{
						$(\'input[data-attribute="fname_label"]\').hide();
					}
				});
				
				$(\'input[data-attribute="lname_id"]\').click(function (){
					if($(\'input[data-attribute="lname_label"]\').css("display") == "none") {
						$(\'input[data-attribute="lname_label"]\').show();
					}else{
						$(\'input[data-attribute="lname_label"]\').hide();
					}
				});
				
				
				$(\'input[data-attribute="mobile_id"]\').click(function (){
					if($(\'input[data-attribute="mobile_label"]\').css("display") == "none") {
						$(\'input[data-attribute="mobile_label"]\').show();
					}else{
						$(\'input[data-attribute="mobile_label"]\').hide();
					}
				});
			});
			</script>
			<p>
				<label for="'.$this->get_field_id('title').'">'.__('Widget Title', 'egoi-for-wp').'</label>
				<input class="widefat" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" />
			</p>
			<p>
				<label for="'.$this->get_field_id('list').'">'.__('List', 'egoi-for-wp').'</label>
				<select class="widefat" name="'.$this->get_field_name('list').'" id="'.$this->get_field_id('list').'">';
					foreach($lists as $list) {
						if($list->title!=''){
							if ($list_id == $list->listnum){
								echo '<option value="'.$list->listnum.'" selected>'.$list->title.'</option>';
							}else{
								echo '<option value="'.$list->listnum.'">'.$list->title.'</option>';
							}
						}
					}

				echo '</select>
			<p>
				<input class="checkbox" id="'.$this->get_field_id('fname').'" name="'.$this->get_field_name('fname').'"';
					if($fname){ echo 'checked="checked"'; } echo 'type="checkbox" value="First Name" data-attribute="fname_id" />
				<label for="'.$this->get_field_id('fname').'">'.__('First Name:', 'egoi-for-wp').'</label>';

				if($fname){
					echo '<input type="text" name="'.$this->get_field_name('fname_label').'" id="'.$this->get_field_id('fname_label').'" placeholder="First Name" value="'.$fname_label.'" data-attribute="fname_label">';
				}else{
					echo '<input type="text" name="'.$this->get_field_name('fname_label').'" id="'.$this->get_field_id('fname_label').'" placeholder="First Name" value="'.$fname_label.'" data-attribute="fname_label" style="display:none;">';
				}
				

				echo '
			</p>
			<p>
				<input class="checkbox" id="'.$this->get_field_id('lname').'" name="'.$this->get_field_name('lname').'"';

					if($lname){ echo 'checked="checked"'; } echo 'type="checkbox" value="Last Name" data-attribute="lname_id" />
				<label for="'.$this->get_field_id('lname').'">'.__('Last Name: ', 'egoi-for-wp').'</label>';

				if($lname){
					echo '<input type="text" name="'.$this->get_field_name('lname_label').'" id="'.$this->get_field_id('lname_label').'" placeholder="Last Name" value="'.$lname_label.'" data-attribute="lname_label">';
				}else{
					echo '<input type="text" name="'.$this->get_field_name('lname_label').'" id="'.$this->get_field_id('lname_label').'" placeholder="Last Name" value="'.$lname_label.'" style="display:none;" data-attribute="lname_label">';
				}
				

				if(!$email)
					$email = 'Email';

				echo '
			</p>
			<p>
				<input class="checkbox" id="'.$this->get_field_id('email').'" name="'.$this->get_field_id('email').'"';
					if($email){ echo 'checked="checked"'; } echo 'type="checkbox" checked="checked" value="Email" disabled="disabled"/>
				<label for="'.$this->get_field_id('email').'">';
					_e('Email:', 'egoi-for-wp');
				echo '</label>';

				echo '<input type="text" name="'.$this->get_field_name('email_label').'" id="'.$this->get_field_id('email_label').'" placeholder="Email" value="'.$email_label.'">';
				

				echo '
			</p>
			<p>
				<input class="checkbox" id="'.$this->get_field_id('mobile').'" name="'.$this->get_field_name('mobile').'"';
					if($mobile){ echo 'checked="checked"'; } echo 'type="checkbox" value="Mobile" data-attribute="mobile_id" />
				<label for="'.$this->get_field_id('mobile').'">'.__('Mobile:', 'egoi-for-wp').
				'</label>';

				if($mobile){
					echo '<input type="text" name="'.$this->get_field_name('mobile_label').'" id="'.$this->get_field_id('mobile_label').'" placeholder="Number" value="'.$mobile_label.'" data-attribute="mobile_label">';
				}else{
					echo '<input type="text" name="'.$this->get_field_name('mobile_label').'" id="'.$this->get_field_id('mobile_label').'" placeholder="Number" value="'.$mobile_label.'" style="display:none;" data-attribute="mobile_label">';
				}
				
				if(!$button)
					$button = __('Subscribe', 'egoi-for-wp');

				echo '
			</p>
			<p>
				<label>'.__('Tag:', 'egoi-for-wp').'</label>';
				echo '<input type="text" name="'.$this->get_field_name('tag').'" id="'.$this->get_field_id('tag').'" placeholder="Tag" value="'.$tag.'">';
				
				echo '
			</p>
			<p>
				<label for="'.$this->get_field_id('button').'">'.__('Subscriber Button:', 'egoi-for-wp').'</label>';
				echo '<input type="text" name="'.$this->get_field_name('button').'" id="'.$this->get_field_id('button').'" placeholder="Subscribe" value="'.$button.'">';
				
				echo '
			</p>';
		}else{
			include('include_widget.php');
		}
	}
}

function egoi_widget_request() {
	
	if(isset($_POST['egoi_subscribe']) && ($_POST['egoi_subscribe'] == "submited")) {
	
		$id = $_POST['widget_id'];
		$list = $_POST['widget_list'];
		$fname = $_POST['widget_fname'];
		$lname = $_POST['widget_lname'];
		$tag = $_POST['widget_tag'];

		$opt = get_option('egoi_widget');
		$Egoi4WP = $opt['egoi_widget'];

		if(isset($_POST['widget_email'])) {

			if($_POST['widget_email'] != '') {

				$email = $_POST['widget_email'];
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					echo "<div class='egoi-form-error error".$id."'>".$Egoi4WP['msg_invalid']."</div>";
					exit;	
				}
			}else {
				echo "<div class='egoi-form-error error".$id."'>".$Egoi4WP['msg_empty']."</div>";
				exit;
			}
		}

		if(isset($_POST['widget_mobile'])) {

			if($_POST['widget_mobile'] != ''){
				$mobile = $_POST['widget_mobile'];
			}else{
				echo "<div class='egoi-form-error error".$id."'>There is no number! Please insert your number</div>";
				exit;
			}
		}

		$name = $fname.' '.$lname;
	
		$api = new Egoi_For_Wp();
		$get = $api->getSubscriber($list, $email);

		if($get->subscriber->UID){
			
			echo "<div class='egoi-error error".$id."'>".$Egoi4WP['msg_exists_subscribed']."</div>";
			exit;

		}else{

			$result = $api->addSubscriber($list, $name, $email, 1, $mobile, $tag);
			if($result){

				$redirect = $Egoi4WP['redirect'];
				$hide_form = $Egoi4WP['hide_form'];
				if($redirect){
					echo "redirect";
				}else{

					if($hide_form){
						echo "hide";
					}else{
						echo "<div class='egoi-success error".$id."'>".$Egoi4WP['msg_subscribed']."</div>";
					}
				}
				exit;
			}else{
				echo "<div class='egoi-error error".$id."'>".$Egoi4WP['msg_error']."</div>";
				exit;
			}
		}
	}
}
