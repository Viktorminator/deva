<?php
/**
* Plugin Name: OI Portfolio
* Plugin URI: http://themeforest.net/user/OrangeIdea
* Description: Portfolio Plugin.
* Version: 1.0.0
* Author: OrangeIdea
* Author URI: http://themeforest.net/user/OrangeIdea
* License: 
*/

add_filter( 'template_include', 'include_template_function', 1 );
function include_template_function( $template_path ) {
    if ( get_post_type() == 'portfolio' ) {
        if ( is_single() ) {

                $template_path = dirname( __FILE__ ) . '/single-portfolio.php';
        }
    }
    return $template_path;
}


/* ------------------------------------------------------------------------ */
/* Plugin Scripts */
/* ------------------------------------------------------------------------ */
add_action('wp_enqueue_scripts', 'oi_plugin_scripts');
if ( !function_exists( 'oi_plugin_scripts' ) ) {
	function oi_plugin_scripts() {
		wp_enqueue_script('oi_custom_plugin',plugin_dir_url( __FILE__ ).'framework/js/custom_plugin.js',  array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script('oi_Waitimages', plugin_dir_url( __FILE__ ).'framework/js/jquery.waitforimages.js',  array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script('oi_isotope', plugin_dir_url( __FILE__ ).'framework/js/isotope.pkgd.min.js',  array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script('oi_imagesloaded', plugin_dir_url( __FILE__ ).'framework/js/imagesloaded.js',  array( 'jquery' ), '1.0.0', true );
		$oi_theme_plugin = array( 
				'theme_url' => plugin_dir_url( __FILE__ ),
			);
    	wp_localize_script( 'oi_custom_plugin', 'oi_theme_plugin', $oi_theme_plugin );
	}    
}


/* ------------------------------------------------------------------------ */
/* Portfolio Post Type.  */
/* ------------------------------------------------------------------------ */



//Create Post Formats
add_action( 'init', 'oi_portfolio' );
function oi_portfolio() {
	register_post_type( 'portfolio',
		array(
			'labels' => array(
				'name' => __( 'Portfolio', 'orangeidea' ),
				'singular_name' => __( 'Portfolio', 'orangeidea' ),
				'new_item' => __( 'Add New portfolio', 'orangeidea' ),
				'add_new_item' => __( 'Add New portfolio', 'orangeidea' )
			),
			'public' => true,
			'has_archive' => false,
			'supports' => array( 'comments', 'editor', 'excerpt', 'thumbnail', 'title' ),
			'capability_type' => 'post',
			'show_ui' => true,
			'publicly_queryable' => true,
			'rewrite' => array('slug' => 'portfolio'),
		)
	);
}


function oi_portfolio_taxonomies() {
	// Portfolio Categories	
	
	$labels = array(
		'add_new_item' => 'Add New Category',
		'all_items' => 'All Categories' ,
		'edit_item' => 'Edit Category' , 
		'name' => 'Portfolio Categories', 'taxonomy general name' ,
		'new_item_name' => 'New Genre Category' ,
		'menu_name' => 'Categories' ,
		'parent_item' => 'Parent Category' ,
		'parent_item_colon' => 'Parent Category:',
		'singular_name' => 'Portfolio Category', 'taxonomy singular name' ,
		'search_items' =>  'Search Categories' ,
		'update_item' => 'Update Category' ,
	);
	register_taxonomy( 'portfolio-category', array( 'portfolio' ), array(
		'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio/category' ),
		'show_ui' => true,
	));
	
	
	// Portfolio Tags	
	
	$labels = array(
		'add_new_item' => 'Add New Tag' ,
		'all_items' => 'All Tags' ,
		'edit_item' => 'Edit Tag' , 
		'menu_name' => 'Portfolio Tags' ,
		'name' => 'Portfolio Tags', 'taxonomy general name' ,
		'new_item_name' => 'New Genre Tag' ,
		'parent_item' => 'Parent Tag' ,
		'parent_item_colon' => 'Parent Tag:' ,
		'singular_name' =>  'Portfolio Tag', 'taxonomy singular name' ,
		'search_items' =>   'Search Tags' ,
		'update_item' => 'Update Tag' ,
	);
	register_taxonomy( 'portfolio-tags', array( 'portfolio' ), array(
		'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio/tag' ),
		'show_ui' => true,
	));
	
		
}

add_action( 'init', 'oi_portfolio_taxonomies', 0 );




class PageTemplater {
		/**
         * A Unique Identifier
         */
		 protected $plugin_slug;
        /**
         * A reference to an instance of this class.
         */
        private static $instance;
        /**
         * The array of templates that this plugin tracks.
         */
        protected $templates;
        /**
         * Returns an instance of this class. 
         */
        public static function get_instance() {
                if( null == self::$instance ) {
                        self::$instance = new PageTemplater();
                } 
                return self::$instance;
        } 
        /**
         * Initializes the plugin by setting filters and administration functions.
         */
        private function __construct() {
                $this->templates = array();
                // Add a filter to the attributes metabox to inject template into the cache.
                add_filter(
					'page_attributes_dropdown_pages_args',
					 array( $this, 'register_project_templates' ) 
				);
                // Add a filter to the save post to inject out template into the page cache
                add_filter(
					'wp_insert_post_data', 
					array( $this, 'register_project_templates' ) 
				);
                // Add a filter to the template include to determine if the page has our 
				// template assigned and return it's path
                add_filter(
					'template_include', 
					array( $this, 'view_project_template') 
				);
                // Add your templates to this array.
                $this->templates = array(
                        'portfolio.php'     => 'Portfolio',
                );
				
        } 
        /**
         * Adds our template to the pages cache in order to trick WordPress
         * into thinking the template file exists where it doens't really exist.
         *
         */
        public function register_project_templates( $atts ) {
                // Create the key used for the themes cache
                $cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );
                // Retrieve the cache list. 
				// If it doesn't exist, or it's empty prepare an array
				$templates = wp_get_theme()->get_page_templates();
                if ( empty( $templates ) ) {
                        $templates = array();
                } 
                // New cache, therefore remove the old one
                wp_cache_delete( $cache_key , 'themes');
                // Now add our template to the list of templates by merging our templates
                // with the existing templates array from the cache.
                $templates = array_merge( $templates, $this->templates );
                // Add the modified cache to allow WordPress to pick it up for listing
                // available templates
                wp_cache_add( $cache_key, $templates, 'themes', 1800 );
                return $atts;
        } 
        /**
         * Checks if the template is assigned to the page
        */
        public function view_project_template( $template ) {
                global $post;
                if (!isset($this->templates[get_post_meta($post->ID, '_wp_page_template', true)] ) ) {
                        return $template;
                } 
                $file = plugin_dir_path(__FILE__). get_post_meta( 
					$post->ID, '_wp_page_template', true 
				);
				
                // Just to be safe, we check if the file exist first
                if( file_exists( $file ) ) {
                        return $file;
                } 
				else { echo $file; }
                return $template;
        } 
} 
add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );


/* ------------------------------------------------------------------------ */
/* Extra Fields.  */
/* ------------------------------------------------------------------------ */
add_action('admin_init', 'extra_fields_plugins', 1);
function extra_fields_plugins() {
	add_meta_box( 'extra_fields_plugin', 'Additional settings', 'extra_fields_for_portfolio', 'portfolio', 'normal', 'high'  );
	add_meta_box( 'extra_fields_plugin', 'Portfolio settings', 'extra_fields_for_pages_plugin', 'page', 'normal', 'high'  );
}

function extra_fields_for_portfolio( $post ){
	?>
	
    
    
    
    <h4>Hover BG color</h4>
    <input type="text" name="extra[port-bg]" value="<?php echo get_post_meta($post->ID, 'port-bg', true); ?>" />
    <h4>Hover TEXT color</h4>
    <input type="text" name="extra[port-text-color]" value="<?php echo get_post_meta($post->ID, 'port-text-color', true); ?>" />
    <h4>Thumbnail</h4>
    <select name="extra[oi_th]">
    <?php $oi_thumb_array = array(
		'1' => 'portfolio-squre',
		'2' => 'portfolio-squrex2',
		'3' => 'portfolio-wide',
		'4' => 'portfolio-long'
		);?>
    <?php foreach ($oi_thumb_array as $val){ ?>
    <option <?php if ($val == get_post_meta($post->ID, 'oi_th', 1)) { echo 'selected';} ?> value="<?php echo esc_attr($val) ?>"><?php echo esc_attr($val) ?></option>
	<?php } ?>
    </select>
    
    <h4><?php _e('Show Breadcrumbs','qoon-creative-wordpress-portfolio-theme')?></h4>
    <select name="extra[port_bread]">
    <?php
    $port_bread = array (
    "yes"  => array("name" => "Yes"),
    "no"  => array("name" => "No"),
    );
    ?>
    <?php foreach ($port_bread as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'port_bread', 1)) { echo 'selected';} ?> value="<?php echo $val['name'] ?>"><?php echo $val['name'] ?></option>
    <?php } ?>
    </select>
    
    
    <h4><?php _e('Contant Layout','qoon-creative-wordpress-portfolio-theme')?></h4>
    <select name="extra[port_cont_lay]">
    <?php
    $port_cont_lay = array (
    "with_paddings"  => array("name" => "Normal"),
	"full_page"  => array("name" => "Full Page"),
	"full_page_scroll"  => array("name" => "Full Page Raw Scroller"),
    );
    ?>
    <?php foreach ($port_cont_lay as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'port_cont_lay', 1)) { echo 'selected';} ?> value="<?php echo $val['name'] ?>"><?php echo $val['name'] ?></option>
    <?php } ?>
    </select>
    
    <h4><?php _e('Featured Image Height','qoon-creative-wordpress-portfolio-theme')?></h4>
    <select name="extra[feat_h]">
    <?php
    $feat_h = array (
    "Do Not Show"  => array("name" => "Do Not Show"),
	"1/3"  => array("name" => "1/3"),
    "1/2"  => array("name" => "1/2"),
	"1/1"  => array("name" => "Full Screen"),
    );
    ?>
    <?php foreach ($feat_h as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'feat_h', 1)) { echo 'selected';} ?> value="<?php echo $val['name'] ?>"><?php echo $val['name'] ?></option>
    <?php } ?>
    </select>
    <h4><?php _e('Featured Image Position','qoon-creative-wordpress-portfolio-theme')?></h4>
    <select name="extra[feat_h_pos]">
    <?php
    $feat_h_pos = array (
    "center bottom"  => array("name" => "center bottom"),
    "center center"  => array("name" => "center center"),
	"center top"  => array("name" => "center top"),
    );
    ?>
    <?php foreach ($feat_h_pos as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'feat_h_pos', 1)) { echo 'selected';} ?> value="<?php echo $val['name'] ?>"><?php echo $val['name'] ?></option>
    <?php } ?>
    </select>
    
    <h4><?php _e('Slider instead Featured Image?','qoon-creative-wordpress-portfolio-theme')?></h4>
    <select name="extra[rev_s]">
    <?php
	$slider = new RevSlider();
	$slugs = $slider->getAllSliderAliases();
	array_unshift($slugs, "Do not use Slider");
    ?>
    <?php foreach ($slugs as $val){ ?>
    <option <?php if ($val == get_post_meta($post->ID, 'rev_s', 1)) { echo 'selected';} ?> value="<?php echo $val ?>"><?php echo $val ?></option>
    <?php } ?>
    </select>
    
    
    <h4><?php _e('Description (For Creative Style Only)','qoon-creative-wordpress-portfolio-theme')?></h4>
    <textarea rows="10" style="width:100%" type="text" name="extra[port-description]" value="<?php echo esc_textarea(get_post_meta($post->ID, 'port-description', true)); ?>" ><?php echo esc_textarea(get_post_meta($post->ID, 'port-description', true)); ?></textarea>
	
<?php };


	add_filter('manage_posts_columns', 'posts_columns_id', 5);
    add_action('manage_posts_custom_column', 'posts_custom_id_columns', 5, 2);
    add_filter('manage_pages_columns', 'posts_columns_id', 5);
    add_action('manage_pages_custom_column', 'posts_custom_id_columns', 5, 2);

function posts_columns_id($defaults){
    $defaults['wps_post_id'] = __('ID');
    return $defaults;
}
function posts_custom_id_columns($column_name, $id){
        if($column_name === 'wps_post_id'){
                echo $id;
    }
}

add_filter('manage_posts_columns', 'posts_columns', 1);
add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);

function posts_columns($defaults){
    $defaults['riv_post_thumbs'] = __('Thumbs');
    return $defaults;
}

function posts_custom_columns($column_name, $id){
        if($column_name === 'riv_post_thumbs'){
        echo the_post_thumbnail( 'thumbnail' );
    }
};


function extra_fields_for_pages_plugin( $post ){
?>
    <div style="padding:20px; border:1px solid #eaeaea; background:#f6f6f6; margin:20px;">
    <h2>Fot Portfolio Templates.</h2>
    <hr>
    
    <h4>Portfolio Style</h4>
    <select id="oi_ps" name="extra[oi_ps]">
    <?php $oi_ps_array = array(
		'1' => 'standard',
		'2' => 'creative',
		'3' => 'modern',
		);?>
    <?php foreach ($oi_ps_array as $val){ ?>
    <option <?php if ($val == get_post_meta($post->ID, 'oi_ps', 1)) { echo 'selected';} ?> value="<?php echo esc_attr($val) ?>"><?php echo esc_attr($val) ?></option>
	<?php } ?>
    </select>
    
    <h4>Portfolio page width</h4>
    <select id="oi_ps_w" name="extra[oi_ps_w]">
    <?php $oi_ps_w_array = array(
		'1' => 'boxed',
		'2' => 'fullwidth',
		);?>
    <?php foreach ($oi_ps_w_array as $val){ ?>
    <option <?php if ($val == get_post_meta($post->ID, 'oi_ps_w', 1)) { echo 'selected';} ?> value="<?php echo esc_attr($val) ?>"><?php echo esc_attr($val) ?></option>
	<?php } ?>
    </select>
    <h4>Show posts from (Use TAGS)</h4>
    <?php $tags = get_categories('taxonomy=portfolio-tags&orderby=name'); ?>
    <select name="extra[oi_tag]">
        <option <?php if ("All" == get_post_meta($post->ID, 'oi_tag', 1)) { echo 'selected';} ?> value="All">All</option>
        <?php
        foreach ( $tags as $val ) {  ?>
        <option <?php if ($val->name == get_post_meta($post->ID, 'oi_tag', 1)) { echo 'selected';} ?> value="<?php echo esc_attr($val->name) ?>"><?php echo esc_attr($val->name) ?></option>
        <?php } ?>
    </select>
    
    <div id="oi_p_creative">
    </div>
    
    <div id="oi_p_standard">
	
    <h4>Page Content Position?</h4>
    <select style="width:50%;" name="extra[port_page]">
    <?php
    $oi_port_page = array (
    "top"  => array("name" => "Top"),
    "bottom"  => array("name" => "Bottom"),
    );
    ?>
    <?php foreach ($oi_port_page as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'port_page', 1)) { echo 'selected';} ?> value="<?php echo esc_attr($val['name']) ?>"><?php echo esc_attr($val['name']) ?></option>
    <?php } ?>
    </select>
    <h4>Portfolio Layout</h4>
    <select style="width:50%;" name="extra[port_layout]">
    <?php
    $oi_port_lay = array (
    "rtws"  => array("name" => "Random Thumbnails With Spaces"),
    "rtwos"  => array("name" => "Random Thumbnails Without Spaces"),
	"sqws"  => array("name" => "Square Thumbnails With Spaces"),
	"sqwos"  => array("name" => "Square Thumbnails Without Spaces"),
	"fsqws"  => array("name" => "4 Square Thumbnails With Spaces"),
	"fsqwos"  => array("name" => "4 Square Thumbnails Without Spaces"),
	"htwos"  => array("name" => "Half Thumbnails Without Spaces"),
	"htws"  => array("name" => "Half Thumbnails With Spaces"),
    );
    ?>
    <?php foreach ($oi_port_lay as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'port_layout', 1)) { echo 'selected';} ?> value="<?php echo esc_attr($val['name']) ?>"><?php echo esc_attr($val['name']) ?></option>
    <?php } ?>
    </select>
    <h4>How many posts to show?</h4>
    <input type="text" name="extra[port-count]" value="<?php echo esc_attr(get_post_meta($post->ID, 'port-count', true)); ?>" />
	<h4>Show "Load More"?</h4>
    <select style="width:50%;" name="extra[port_load_more]">
    <?php
    $oi_port_load_more = array (
    "yes"  => array("name" => "Yes"),
    "no"  => array("name" => "No"),
    );
    ?>
    <?php foreach ($oi_port_load_more as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'port_load_more', 1)) { echo 'selected';} ?> value="<?php echo esc_attr($val['name']) ?>"><?php echo esc_attr($val['name']) ?></option>
    <?php } ?>
    </select>
    <h4>Show Filters?</h4>
    <select style="width:50%;" name="extra[port_filters]">
    <?php
    $oi_port_filters = array (
    "yes"  => array("name" => "Yes"),
    "no"  => array("name" => "No"),
    );
    ?>
    <?php foreach ($oi_port_filters as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'port_filters', 1)) { echo 'selected';} ?> value="<?php echo esc_attr($val['name']) ?>"><?php echo esc_attr($val['name']) ?></option>
    <?php } ?>
    </select>
    <h4>How many posts to load on button click?</h4>
    <input type="text" name="extra[port-load_count]" value="<?php echo esc_attr(get_post_meta($post->ID, 'port-load_count', true)); ?>" />
    </div>
    </div>
<?php }

?>