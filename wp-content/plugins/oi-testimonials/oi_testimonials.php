<?php
/**
* Plugin Name: OI Testimonials
* Plugin URI: http://themeforest.net/user/OrangeIdea
* Description: Testimonials Plugin.
* Version: 1.0.0
* Author: OrangeIdea
* Author URI: http://themeforest.net/user/OrangeIdea
* License: 
*/

//Create Post Formats
add_action( 'init', 'oi_testimonials' );
function oi_testimonials() {
	register_post_type( 'testimonials',
		array(
			'labels' => array(
				'name' => __( 'Testimonials', 'orangeidea' ),
				'singular_name' => __( 'Testimonials', 'orangeidea' ),
				'new_item' => __( 'Add New testimonial', 'orangeidea' ),
				'add_new_item' => __( 'Add New testimonial', 'orangeidea' )
			),
			'public' => true,
			'has_archive' => false,
			'supports' => array( 'comments', 'editor', 'excerpt', 'thumbnail', 'title' ),
			'capability_type' => 'post',
			'show_ui' => true,
			'publicly_queryable' => true,
			'rewrite' => array('slug' => 'testimonials'),
		)
	);
}

/* ------------------------------------------------------------------------ */
/* Extra Fields.  */
/* ------------------------------------------------------------------------ */
add_action('admin_init', 'extra_fields_plugins_tesimonial', 1);
function extra_fields_plugins_tesimonial() {
	add_meta_box( 'extra_fields_plugin', 'Additional settings', 'extra_fields_for_testimonial', 'testimonials', 'normal', 'high'  );
}

function extra_fields_for_testimonial( $post ){
	?>
   <h4>Additional Text Line</h4>
   <textarea rows="10" style="width:600px;" type="text" name="extra[testimonial-descr]" value="<?php echo esc_textarea(get_post_meta($post->ID, 'testimonial-descr', true)); ?>" ><?php echo esc_textarea(get_post_meta($post->ID, 'testimonial-descr', true)); ?></textarea>
	
<?php };