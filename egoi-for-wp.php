<?php
error_reporting(E_ALL & ~E_NOTICE);

/**
 *
 * @link              https://www.e-goi.com
 * @since             1.0.9
 * @package           Egoi_For_Wp
 *
 * @wordpress-plugin
 * Plugin Name:       Smart Marketing for WP
 * Plugin URI:        https://www.e-goi.com/en/o/smart-marketing-para-wordpress/
 * Description:       E-goi Syncronization for Lists and Subscribers.
 * Version:           1.0.9
 * Author:            E-goi
 * Author URI:        https://www.e-goi.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       egoi-for-wp
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined( 'WPINC' )) {
	exit;
}

function activate_egoi_for_wp() {
	
	if (!version_compare(PHP_VERSION, '5.3.0', '>=')) {
	    echo 'This PHP Version - '.PHP_VERSION.' is obsolete, please update your PHP version to run this plugin';
	    exit;
	}

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-egoi-for-wp-activator.php';
	Egoi_For_Wp_Activator::activate();
}

function deactivate_egoi_for_wp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-egoi-for-wp-deactivator.php';
	Egoi_For_Wp_Deactivator::deactivate();
	remove_action('widgets_init', 'egoi_widget_init');
}

register_activation_hook( __FILE__, 'activate_egoi_for_wp');
register_deactivation_hook( __FILE__, 'deactivate_egoi_for_wp');


// HOOK USERS
add_action('wp_ajax_add_users', 'add_users');

function add_users(){
	$admin = new Egoi_For_Wp_Admin();
	return $admin->users_queue();
}

add_action('widgets_init', 'egoi_widget_init');
function egoi_widget_init(){
	wp_enqueue_script('canvas-loader', plugin_dir_url(__FILE__) . 'admin/js/egoi-for-wp-canvas.js');
	register_widget('Egoi4Widget');
	add_action('init', 'egoi_widget_request'); 
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-egoi-for-wp.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-egoi-for-wp-widget.php';

function run_egoi_for_wp() {

	$plugin = new Egoi_For_Wp();
	$plugin->run();

}
run_egoi_for_wp();
