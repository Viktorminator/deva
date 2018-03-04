<?php

add_shortcode('vc_legend_block', 'vc_legend_block_f');
function vc_legend_block_f( $atts, $content = null)
{
	extract(shortcode_atts(
		array(
			'height' => 'x2',
			'color' =>'#fff'
		), $atts)
	);
		$content ='<div class="oi_vc_text item_height_'.$height.'" style="background-color:'.$color.'">
					<div class="oi_vc_text_span">'.do_shortcode($content).'</div>
			   </div>';
	return $content;
};

vc_map( array(
	"name" => __("Legend Block",'maxcode-pure-portfolio-and-business-theme'),
	"base" => "vc_legend_block",
	"admin_enqueue_css" => array(get_template_directory_uri().'/framework/vc_extend/style.css'),
	"class" => "",
	"category" => __('OI','maxcode-pure-portfolio-and-business-theme'),
	"params" => array(
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"param_name" => "content",
			"heading" => __("content", "orangeidea"),
			"value" => '',
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "color",
			"heading" => __("Background Color", "orangeidea"),
			"value" => '#fff',
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "height",
			"heading" => __("Size", "orangeidea"),
			"value" => '',
			"description" => __( "x1 or x2", 'maxcode-pure-portfolio-and-business-theme' )
		)
	)
) );




?>