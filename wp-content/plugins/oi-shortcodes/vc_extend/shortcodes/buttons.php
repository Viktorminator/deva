<?php 
/*BUTTONS*/
add_shortcode('oi_vc_button', 'oi_vc_button_f');
function oi_vc_button_f( $atts, $content = null)
{
	
	if(isset($atts['icon_type'])){
	$icon_type = $atts['icon_type'];
	switch ( $icon_type ) {
		case 'fontawesome':
			$icon = $atts['icon_fontawesome'];
			break;
		case 'openiconic':
			$icon = $atts['icon_openiconic'];
			break;
		case 'typicons':
			$icon = $atts['icon_typicons'];
			break;
		case 'entypo':
			$icon = $atts['icon_entypo'];
			break;
		case 'linecons':
			$icon = $atts['icon_linecons'];
			break;
		
	};
	};
	// Enqueue the icon font that we're using.
	if(isset($atts['icon_type'])){vc_icon_element_fonts_enqueue( $icon_type );}
	extract(shortcode_atts(
		array(
			'icon_type' => 'None',
			'oi_title' => 'Button',
			'oi_title_size'=>'16px',
			'oi_title_color'=>'#fff',
			'modal_id' =>'',
			'oi_bg_color'=>'#000',
			'oi_url' => '#',
			'oi_display' => 'block',
			'oi_target'=>'_self',
			'oi_padding'=>'10px 20px',
			'modal_padding' =>'30px',
			'oi_border_w' => '1px',
			'oi_border_s' => 'solid',
			'oi_border_c' => '#000',
			'oi_border_r' => '3px',
			'oi_title_color_hover'=>'#fff',
			'oi_bg_color_hover'=>'#00f6ff',
			'oi_border_c_hover' => '#00f6ff',
			'oi_icon_s' => '16px',
			'oi_align' => 'left',
			'icon_fontawesome' => '',
			'icon_openiconic'  => '',
			'icon_typicons'    => '',
			'icon_entypo'      => '',
			'icon_linecons'    => '',

		), $atts)
	);
	$a = '';
	if(isset($atts['icon_type'])){
	$oi_icon_output ='<i class="'.$icon.' oi_button_icon oi_button_icon_'.$oi_align.'" style="font-size:'.$oi_icon_s.';"></i>';
	};

	$a .='<a class="oi_vc_button" data-title-color-hover="'.$oi_title_color_hover.'" data-bg-color-hover="'.$oi_bg_color_hover.'" data-border-c-hover="'.$oi_border_c_hover.'"';
	  if($oi_target =='Modal Window'){
		   $a .=' href="#" ';
		   $a .=' data-remodal-target="'.$modal_id.'" ';
	  }else{
	  	$a .=' href="'.$oi_url.'"  target="'.$oi_target.'"';
	  };
	  $a .='style="display:'.$oi_display.'; font-size:'.$oi_title_size.'; line-heigth:'.$oi_title_size.'; color:'.$oi_title_color.'; background-color:'.$oi_bg_color.'; padding:'.$oi_padding.'; border-width:'.$oi_border_w.'; border-style:'.$oi_border_s.'; border-color:'.$oi_border_c.'; border-radius:'.$oi_border_r.'">';
		if($icon_type !='None'){
			if ($oi_align == 'center'){
				$a .= '<span class="oi_vc_button_icon_holder">'.$oi_icon_output.'</span>';
			};
		};
		if($icon_type !='None'){
			if ($oi_align == 'left'){
				$a .= $oi_icon_output;
			};
		};
		$a .= $oi_title;
		if($icon_type !='None'){
			if ($oi_align == 'right'){
				$a .= $oi_icon_output;
			};
		};
	
	$a .='</a>';
	if($oi_target =='Modal Window'){
	 $a .='<div class="remodal" style="padding:'.$modal_padding.'" data-remodal-id="'.$modal_id.'">
				  <button data-remodal-action="close" class="remodal-close"></button>
				  '.do_shortcode($content).'
				</div>';
	}
	return $a;
};


/*BUTTONS*/
vc_map( array(
	"name" => __("BUTTON",'maxcode-pure-portfolio-and-business-theme'),
	"base" => "oi_vc_button",
	"admin_enqueue_css" => array(get_template_directory_uri().'/framework/vc_extend/style.css'),
	"class" => "",
	"icon" => "oi_icon_button",
	"category" => __('OI','maxcode-pure-portfolio-and-business-theme'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_url",
			"heading" => __("URL", "orangeidea"),
			"value" => '#',
			"group" => "General"
		),
		array(
			'type' => 'dropdown',
			'heading' => "Target",
			'param_name' => 'oi_target',
			'value' => array( "_blank", "_self", "Modal Window" ),
			'std' => '_self',
			"group" => "General"
		),
		array(
			'type' => 'dropdown',
			'heading' => "Display",
			'param_name' => 'oi_display',
			'value' => array( "block", "inline-block" ),
			'std' => 'block',
			"group" => "General"
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_title",
			"heading" => __("Title", "orangeidea"),
			"value" => 'Button',
			"group" => "Title"
		),
		
		
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_title_size",
			"heading" => __("Font Size", "orangeidea"),
			"value" => '16px',
			"group" => "Title"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_title_color",
			"heading" => __("Title Color", "orangeidea"),
			"value" => '#fff',
			"group" => "Title"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_title_color_hover",
			"heading" => __("HOVER Title Color", "orangeidea"),
			"value" => '#fff',
			"group" => "Title"
		),
		
		array(
				'type' => 'dropdown',
				'heading' => __( 'Icon library', 'maxcode-pure-portfolio-and-business-theme' ),
				'value' => array(
					__( 'None', 'maxcode-pure-portfolio-and-business-theme' ) => 'None',
					__( 'Font Awesome', 'maxcode-pure-portfolio-and-business-theme' ) => 'fontawesome',
					__( 'Open Iconic', 'maxcode-pure-portfolio-and-business-theme' ) => 'openiconic',
					__( 'Typicons', 'maxcode-pure-portfolio-and-business-theme' ) => 'typicons',
					__( 'Entypo', 'maxcode-pure-portfolio-and-business-theme' ) => 'entypo',
					__( 'Linecons', 'maxcode-pure-portfolio-and-business-theme' ) => 'linecons',
				),
				
				'param_name' => 'icon_type',
				'description' => __( 'Select icon library.', 'maxcode-pure-portfolio-and-business-theme' ),
				"group" => "Icon"
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'maxcode-pure-portfolio-and-business-theme' ),
				'param_name' => 'icon_fontawesome',
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'iconsPerPage' => 200, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'fontawesome',
				),
				'description' => __( 'Select icon from library.', 'maxcode-pure-portfolio-and-business-theme' ),
				"group" => "Icon"
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'maxcode-pure-portfolio-and-business-theme' ),
				'param_name' => 'icon_openiconic',
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'openiconic',
					'iconsPerPage' => 200, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'openiconic',
				),
				'description' => __( 'Select icon from library.', 'maxcode-pure-portfolio-and-business-theme' ),
				"group" => "Icon"
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'maxcode-pure-portfolio-and-business-theme' ),
				'param_name' => 'icon_typicons',
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'typicons',
					'iconsPerPage' => 200, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'typicons',
				),
				'description' => __( 'Select icon from library.', 'maxcode-pure-portfolio-and-business-theme' ),
				"group" => "Icon"
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'maxcode-pure-portfolio-and-business-theme' ),
				'param_name' => 'icon_entypo',
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'entypo',
					'iconsPerPage' => 300, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'entypo',
				),
				"group" => "Icon"
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'maxcode-pure-portfolio-and-business-theme' ),
				'param_name' => 'icon_linecons',
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'linecons',
					'iconsPerPage' => 200, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'linecons',
				),
				'description' => __( 'Select icon from library.', 'maxcode-pure-portfolio-and-business-theme' ),
				"group" => "Icon"
			),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_icon_s",
			"heading" => __("Icon Size", "orangeidea"),
			"value" => '16px',
			"group" => "Icon"
		),
		

		array(
			'type' => 'dropdown',
			'heading' => "Icon align",
			'param_name' => 'oi_align',
			'value' => array( "left", "right", "center"),
			'std' => 'left',
			"group" => "Icon"
		),
		
		
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_bg_color",
			"heading" => __("Background Color", "orangeidea"),
			"value" => '#000',
			"group" => "Background"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_bg_color_hover",
			"heading" => __("HOVER Background Color", "orangeidea"),
			"value" => '#00f6ff',
			"group" => "Background"
		),
		
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_padding",
			"heading" => __("Padding", "orangeidea"),
			"value" => '10px 20px',
			"group" => "General"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "modal_id",
			"heading" => __("Modal ID ( for example: my_modal_1)", "orangeidea"),
			"value" => '',
			'dependency' => array(
				'element' => 'oi_target',
				'value' => 'Modal Window',
			),
			"group" => "General"
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "modal_padding",
			"heading" => __("Modal Window Paddings", "orangeidea"),
			"value" => '30px',
			'dependency' => array(
				'element' => 'oi_target',
				'value' => 'Modal Window',
			),
			"group" => "General"
		),
		
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"param_name" => "content",
			"heading" => __("Modal Window Content", "orangeidea"),
			"value" => '',
			"group" => "General",
			'dependency' => array(
				'element' => 'oi_target',
				'value' => 'Modal Window',
			),
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_border_w",
			"heading" => __("Border Width", "orangeidea"),
			"value" => '1px',
			"group" => "Border"
		),

		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_border_c",
			"heading" => __("Border Color", "orangeidea"),
			"value" => '#000',
			"group" => "Border"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_border_c_hover",
			"heading" => __("HOVER Border Color", "orangeidea"),
			"value" => '#00f6ff',
			"group" => "Border"
		),
		array(
			'type' => 'dropdown',
			'heading' => "Border Style",
			'param_name' => 'oi_border_s',
			'value' => array( "solid", "dotted", "dashed"),
			"group" => "Border"
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_border_r",
			"heading" => __("Border radius", "orangeidea"),
			"value" => '3px',
			"group" => "Border"
		),
		
		
		
		
	)
) );


