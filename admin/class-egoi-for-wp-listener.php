<?php
/**
*  E-goi Listener 4 Syncronize Users with WP
*/
class Egoi_For_Wp_Listener {
	
	private $options_listen = '';

	private $user = '';

	private $enabled = '';


	public function __construct( $plugin_name, $version ){

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function init($user_id){

		if ($this->isActive()){
			if($user_id){
				$this->Listen($user_id);
			}
		}

	}

	public function isActive(){

		$options = get_option(Egoi_For_Wp_Admin::OPTION_NAME);
		$this->options_listen = $options;

		if($options['enabled']){
			$this->enabled = $options['enabled'];
			return $this->enabled;
		}

	}

	private function getMapping($user_id){

		global $wpdb;
		
		$table = $wpdb->prefix."egoi_map_fields";
		$sql="SELECT * FROM $table order by id DESC";
        $rows = $wpdb->get_results($sql);

        return $rows;
	}

	private function Listen($user_id){

		$user = get_userdata($user_id);
		$list = $this->options_listen['list'];

		$admin = new Egoi_For_Wp($this->plugin_name, $this->version);
		
		//mapping fields
		if(get_option('egoi_mapping')){
			
			$op = 1;
			$all_fields = get_user_meta($user_id);
			$all_fields['user_email'][0] = $user->user_email;
			$all_fields['user_url'][0] = $user->user_url;
			$all_fields['user_login'][0] = $user->user_login;
			foreach ($all_fields as $key => $value) {
				$row = $admin->getFieldMap(0, $key);

				if($row){
					$fields[$row] = $value[0];
				}
			}
		}

		$role = $this->options_listen['role'];
		$name = $user->display_name;
		$email = $user->user_email;


		if($role == $user->roles[0]){
			$addtags = $admin->addTag($user->roles[0]);
			if($addtags->ERROR == ''){
				$tag = $addtags->ID;
				$add = $admin->addSubscriberTags($list, $email, $tag, $name, $role, $fields, $op);

			}else{
				$get_tags = $admin->getTags();
				foreach($get_tags['TAG_LIST'] as $key => $tag){
					if(in_array(strtolower($user->roles[0]), $tag)){
						$add = $admin->addSubscriberTags($list, $email, $tag['ID'], $name, $role, $fields, $op);
					}
				}
			}
		}else{
			$add = $admin->addSubscriberTags($list, $email, '', $name, false, $fields, $op);
		}
			
	}

	public function Listen_update($user_id) {

		if ($this->isActive()){
			$user = get_userdata($user_id);
			$role = $user->roles[0];
			$email = $user->user_email;
			$fname = ucfirst($user->display_name);

			$list = $this->options_listen['list'];
			
			$admin = new Egoi_For_Wp($this->plugin_name, $this->version);

			//mapping fields
			if(get_option('egoi_mapping')){
				
				$op = 1;
				$all_fields = get_user_meta($user_id);
				$all_fields['user_email'][0] = $email;
				$all_fields['user_url'][0] = $user->user_url;
				$all_fields['user_login'][0] = $user->user_login;
				foreach ($all_fields as $key => $value) {
					$row = $admin->getFieldMap(0, $key);

					if($row){
						$fields[$row] = $value[0];
					}
				}

			}
		
			
			$get_user = $admin->editSubscriber($list, $email, $role, $fname, $fields, $op);		

			if($get_user->ERROR == 'SUBSCRIBER_NOT_FOUND'){
				$admin->addSubscriber($list, $user->user_login, $user->user_email, $fields);
			}

		}

	}

	public function Listen_delete($user_id) {

		if ($this->isActive()){
			$user = get_userdata($user_id);
			$list = $this->options_listen['list'];

			$admin = new Egoi_For_Wp($this->plugin_name, $this->version);
			$del_user = $admin->delSubscriber($list, $user->user_email);

			if($del_user->ERROR == 'SUBSCRIBER_NOT_FOUND'){
				return false;
			}
		}

	}

	/*private function Listen_bulk() {

		$users = count_users();
			$total_users = '';
			foreach($users['avail_roles'] as $role => $count){
				if($role == $this->options_list['role']){
					$total_users .= $count;
				}else{
					$total_users += $count;
				}

			}

			$total_users = ($total_users-1);
			if(count($all_subscribers) > ($total_users)){

				$userdata = array(
				    'user_login'  =>  $login,
				    'user_email'  =>  $email,
				    'user_pass'   =>  $pass,
				    'role'  => $this->options_listen['role']
				);

				wp_insert_user($userdata);

			}else if(count($current_subs) < ($index)){

				$add = $admin->addSubscriber($list,$login,$email);

			}else{

				$users = get_users();
					$wp_email = '';	
					foreach ($users as $user) {
						if($user->user_email != wp_get_current_user()){
							$wp_email .= $user->user_email.' - ';
						}
					}	
				$wp_emails = array_filter(explode(' - ', $wp_email));

			}

	}*/
}