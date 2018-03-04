<?php
/*VISUAL COMPOSER EXTEND*/
$attributes = array(
    'type' => 'dropdown',
    'heading' => "Inner Ellements Style",
    'param_name' => 'oi_ellements_style',
    'value' => array( "With Paddings", "Without Paddings","Stick Together" ),
    'description' => __( "Choose inner ellements style", "orangeidea" )
);
vc_add_param( 'vc_row', $attributes );

$equalizeHeights = array(
    'type' => 'dropdown',
    'heading' => "Inner Ellements Heights",
    'param_name' => 'oi_ellements_height',
    'value' => array( "Normal Heights", "Equalize Heights", ),
    'description' => __( "Choose inner ellements Heights", "orangeidea" )
);
vc_add_param( 'vc_row', $equalizeHeights ); 




/* ------------------------------------------------------------------------ */
/* SHORTCODES */
/* ------------------------------------------------------------------------ */

$uri = plugin_dir_path( __FILE__ );
include($uri.'shortcodes/custom_heading.php');
include($uri.'shortcodes/dropcap.php');
include($uri.'shortcodes/simple_icon.php');
include($uri.'shortcodes/icons_list.php');
include($uri.'shortcodes/buttons.php');
include($uri.'shortcodes/progress_bar.php');
include($uri.'shortcodes/partners.php');
include($uri.'shortcodes/custom_slider.php');
include($uri.'shortcodes/testimonial.php');
include($uri.'shortcodes/pricing_tables.php');
include($uri.'shortcodes/team_memder.php');
include($uri.'shortcodes/portfolio_item.php');
include($uri.'shortcodes/portfolio_item-fh.php');
include($uri.'shortcodes/legend_block.php');
include($uri.'shortcodes/g_map.php');
include($uri.'shortcodes/latest_news.php');
include($uri.'shortcodes/contacts.php');
include($uri.'shortcodes/lightbox_image.php');
include($uri.'shortcodes/ajax_portfolio.php');
include($uri.'shortcodes/console_text.php');


//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Oi_Icons_List extends WPBakeryShortCodesContainer {
    };
	class WPBakeryShortCode_Oi_Price_Table extends WPBakeryShortCodesContainer {
    };
	
	class WPBakeryShortCode_Oi_Custom_Slider extends WPBakeryShortCodesContainer {
    }
};
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Oi_List_Item extends WPBakeryShortCode {
    };
	 class WPBakeryShortCode_Vc_Testimonial_Item extends WPBakeryShortCode {
    }
};

?>