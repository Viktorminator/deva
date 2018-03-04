<?php
/*CONTACT BLOCK*/
add_shortcode('oi_contacts', 'oi_contacts_f');
function oi_contacts_f( $atts, $content = null)
{
	extract(shortcode_atts(
		array(
			'height' => 'x2',
			'color' =>'#fff',
		), $atts)
	);
	$content ='<div class="oi_vc_text oi_contact_block_holder item_height_'.$height.'" style="background-color:'.$color.'">
					<div class="oi_vc_text_span">
						<div class="oi_tringle"></div>
						<a class="oi_contact_block" href="#" data-remodal-target="modal">
						<div class="circle">
							<div class="mail-box">
								<div class="flag"></div>
							</div>
						</div>
						</a>
					</div>
				   <div class="remodal" data-remodal-id="modal">
					  <button data-remodal-action="close" class="remodal-close"></button>
					  '.do_shortcode($content).'
					</div>
			   ';
	return $content;
};

vc_map( array(
	"name" => __("Contact Block",'maxcode-pure-portfolio-and-business-theme'),
	"base" => "oi_contacts",
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


