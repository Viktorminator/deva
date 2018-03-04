<?php
/*PORTFOLIO ITEM WITH FLUID HEIGHT*/
add_shortcode('vc_portfolio_item_fh', 'vc_portfolio_item_fh_f');
function vc_portfolio_item_fh_f( $atts, $content = null)
{
	extract(shortcode_atts(
		array(
			'id' => '',
			'height' => '',
		), $atts)
	);
	$post = get_post($id);
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full'); 
	$title = $post->post_title;
	$catt = get_the_terms( $id, 'portfolio-category' );
	if (isset($catt) && ($catt!='')){
		$slugg = '';
		$slug = ''; 
		foreach($catt  as $vallue=>$key){
			$slugg .= strtolower($key->slug) . " ";
			$slug  .= ''.$key->name.', ';
		}
		
	};
	$output ='<div class="oi_strange_portfolio_item oi_port_style_ii">';
            $output .='<div class="oi_vc_potrfolio item_height_'.$height.'" style="background:url('.$image[0].');">';
            	$output .='<a href="'.get_the_permalink($id).'">';
                $output .='<div class="oi_vc_port_mask"  style="background:'. get_post_meta($id, 'port-bg', true).'">';
                    $output .='<div class="text-center">';
                        $output .='<h3 class="oi_sub_legend" style="color:'.get_post_meta($id, 'port-text-color', true).'">'.$title.'</h3>';
                        $output .='<div class="oi_vc_port_cat" style="color:'.get_post_meta($id, 'port-text-color', true).'">'.substr($slug, '0', '-2').'</div>';
                        $output .='<div class="oi_vc_sep" style="background:'.get_post_meta($id, 'port-text-color', true).'"></div>';
                    $output .='</div>';
                $output .='</div>';
                $output .='</a>';
            $output .='</div>';
        $output .='</div>';

	
	return $output;
};

vc_map( array(
	"name" => __("Portfolio Item Fluid Height",'maxcode-pure-portfolio-and-business-theme'),
	"base" => "vc_portfolio_item_fh",
	"admin_enqueue_css" => array(get_template_directory_uri().'/framework/vc_extend/style.css'),
	"class" => "",
	"category" => __('OI','maxcode-pure-portfolio-and-business-theme'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "id",
			"heading" => __("Portfolio Item", "orangeidea"),
			"value" => '',
			"description" => __( "Portfolio ID", 'maxcode-pure-portfolio-and-business-theme' )
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "height",
			"heading" => __("Size", "orangeidea"),
			"value" => '',
			"description" => __( "x1 or x2", 'maxcode-pure-portfolio-and-business-theme' )
		),

	)
) );

