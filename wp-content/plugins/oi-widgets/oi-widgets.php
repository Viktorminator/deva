<?php
/**
* Plugin Name: OI Widgets
* Plugin URI: http://themeforest.net/user/OrangeIdea
* Description: Widgets Set.
* Version: 1.0.0
* Author: OrangeIdea
* Author URI: http://themeforest.net/user/OrangeIdea
* License: 
*/

/* ------------------------------------------------------------------------ */
/* Plugin Scripts */
/* ------------------------------------------------------------------------ */

add_action('wp_enqueue_scripts', 'oi_plugin_scripts_widget');
if ( !function_exists( 'oi_plugin_scripts_widget' ) ) {
	function oi_plugin_scripts_widget() {
		wp_enqueue_script('oi_instagrammmm',plugin_dir_url( __FILE__ ).'js/spectragram.min.js', false, null , true);
	}    
};

/*=======================================
	Widgets
=======================================*/
include(plugin_dir_path( __FILE__ ).'widgets/oi_about_widget.php');
include(plugin_dir_path( __FILE__ ).'widgets/oi_popular_posts.php');
include(plugin_dir_path( __FILE__ ).'widgets/oi_latest_posts.php');
include(plugin_dir_path( __FILE__ ).'widgets/oi_recent_posts_comments.php');
include(plugin_dir_path( __FILE__ ).'widgets/oi_instagram_widget.php');




?>