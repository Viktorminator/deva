<?php
/**
* Plugin Name: OI Shortcodes
* Plugin URI: http://themeforest.net/user/OrangeIdea
* Description: Visual Composer Extantion.
* Version: 1.0.1
* Author: OrangeIdea
* Author URI: http://themeforest.net/user/OrangeIdea
* License: 
*/

/* ------------------------------------------------------------------------ */
/* Plugin Scripts */
/* ------------------------------------------------------------------------ */

add_action('wp_enqueue_scripts', 'oi_shortcodes_scripts');
if ( !function_exists( 'oi_shortcodes_scripts' ) ) {
	function oi_shortcodes_scripts() {
		wp_enqueue_script('oi_vc_custom',plugin_dir_url( __FILE__ ).'vc_extend/vc_custom.js', false, null , true);
	}    
};
function oi_enqueue_sstyle() {
    wp_enqueue_style( 'oi-vs-style', plugin_dir_url( __FILE__ ) . 'vc_extend/vc.css', array(), '1', 'all' );
}
add_action( 'wp_enqueue_scripts', 'oi_enqueue_sstyle' );

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
		include( plugin_dir_path( __FILE__ ).'vc_extend/vc.php'); //Visual Composer
	}



?>