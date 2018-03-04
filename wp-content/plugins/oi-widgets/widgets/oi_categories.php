<?php	 		 	
/*
-----------------------------------------------------------------------------------

 	Plugin Name: Categories Widget For Sidebar/Footer
 	Plugin URI: http://www.orange-idea.com
 	Description: A widget thats displays your recent comments
 	Version: 1.0
 	Author: OrangeIdea
 	Author URI:   http://www.orange-idea.com
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'OrangeIdea_load_categories_widgets');

function OrangeIdea_load_categories_widgets()
{
	register_widget('OrangeIdea_Categories_Widget');
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
	class OrangeIdea_Categories_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */		
	function OrangeIdea_Categories_Widget() {
		
		/* Widget settings. */
		$widget_ops = array('classname' => 'OrangeIdea_Categories_widget', 'description' => __( 'OrangeIdea: Categories', 'qoon-creative-wordpress-portfolio-theme' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'OrangeIdea_categories_widget' );

		/* Create the widget. */		
		$this->__construct( 'OrangeIdea_categories_widget', 'OrangeIdea: Categories ', $widget_ops);
	}

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	$number_of_posts_to_show = $instance['number_of_posts_to_show'];

	// Before widget (defined by theme functions file)
	echo $before_widget;
	// Display the widget title if one was input
	if ( $title )
		echo $before_title . $title . $after_title;

	// Display video widget
	?>
	<?php
// Grab the categories – top level only (depth=1)
$get_cats = wp_list_categories( 'echo=0&title_li=&depth=1&show_count=1' );
// Split into array items
$cat_array = explode('</li>',$get_cats);
// Amount of categories (count of items in array)
$results_total = count($cat_array);
// How many categories to show per list (round up total divided by 5)
$cats_per_list = ceil($results_total / 3);
// Counter number for tagging onto each list
$list_number = 1;
// Set the category result counter to zero
$result_number = 0;
?>

<ul class="oi_category_widget" id="cat-col-<?php echo $list_number; ?>">

<?php
foreach($cat_array as $category) {
$result_number++;

if($result_number % $cats_per_list == 0) {
$list_number++;
echo $category.'</li>
</ul>

<ul class="oi_category_widget" id="cat-col-'.$list_number.'">';

}

else {

echo $category.'</li>';

}

} ?>

</ul>
<div class="clearfix"></div>


   
	<?php	 		 	

	// After widget (defined by theme functions file)
	echo $after_widget;
	
}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );
	
	// Stripslashes for html inputs
	$instance['columns'] = stripslashes( $new_instance['columns']);

	// No need to strip tags

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array( 'title' => __( 'Categories' , 'qoon-creative-wordpress-portfolio-theme' ), 'columns' => '2' );
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'qoon-creative-wordpress-portfolio-theme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>


	<?php	 		 	
	}
}
?>