<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.e-goi.com
 * @since      1.0.0
 *
 * @package    Egoi_For_Wp
 * @subpackage Egoi_For_Wp/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Egoi_For_Wp
 * @subpackage Egoi_For_Wp/includes
 * @author     E-goi <admin@e-goi.com>
 */
class Egoi_For_Wp_Deactivator {

	public static $version = '1.0.9';
	
	public static function deactivate() {
		
		$opt = get_option('egoi_data');
		if($opt){
			
			$option = array(
				'Egoi4WpBuilderObject',
				'egoi_sync',
				'egoi_bar_sync',
				'egoi_api_key',
				'widget_egoi4widget',
				'egoi_widget',
				'egoi_form_sync_1',
				'egoi_form_sync_2',
				'egoi_form_sync_3',
				'egoi_form_sync_4',
				'egoi_form_sync_5',
				'egoi_int',
				'egoi_data',
				'egoi_mapping'
			);
			foreach ($option as $opt) {
				delete_option($opt);
			}
			
			global $wpdb;
			
			$table = $wpdb->prefix."egoi_map_fields";
			$sql = "DROP TABLE $table";
			$result = $wpdb->query($sql);

		}

		$email = wp_get_current_user();
		$email = $email->data->user_email;

		self::serviceDeactivate(array('email' => $email));
	}

	public static function serviceDeactivate($data = array()) {
		
		try{

			$params = array(
				'email' => $data['email'],
				'smegoi_v' => 'Wordpress_'.self::$version,
				'smegoi_h' => isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : $_SERVER['HTTP_HOST'],
				'smegoi_m' => 1,
				'smegoi_e' => get_locale()
			);

			require('service/post_wsdl.php');
			if(class_exists("SoapClient")){
				$response = new SoapClient(NULL, $options);
				$response->call($params);
			}

		}catch(Exception $e){
			//continue
		}

		return '';
	}

}
