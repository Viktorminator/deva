<?php 
/*CUSTOM HEADING*/
add_shortcode('oi_vc_heading', 'oi_vc_heading_f');
function oi_vc_heading_f( $atts, $content = null)
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
		
	}
	
	// Enqueue the icon font that we're using.
	vc_icon_element_fonts_enqueue( $icon_type );
	};
	extract(shortcode_atts(
		array(
			'icon_type' => 'None',
			'oi_title' => 'This is Title',
			'oi_sub_title' => 'Asesome subtitle goes here',
			'oi_title_color'=>'#0000',
			'oi_title_size'=>'h3',
			'oi_title_style'=>'normal',
			'oi_sub_title_color'=>'#666',
			'oi_sub_title_size'=>'p',
			'oi_sub_title_style'=>'normal',
			'oi_align'=>'left',
			'oi_border' => 'none',
			'oi_border_w' => '100px',
			'oi_border_h' => '1px',
			'oi_border_s' => 'solid',
			'oi_border_c' => 'eaeaea',
			'oi_icon_c' => '#000',
			'oi_icon_w' => '24px',
			'oi_icon_p' => '0px',
			'oi_heading_mb' => '20px',
			'icon_fontawesome' => '',
			'icon_openiconic'  => '',
			'icon_typicons'    => '',
			'icon_entypo'      => '',
			'icon_linecons'    => '',
		), $atts)
	);
	$content = '';
	$oi_border_otput = '';
	$oi_icon_output ='';
	//_______________DETECT DEVICES__________________//
	$tablet_browser = 0;
	$mobile_browser = 0;
	
	if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		$tablet_browser++;
	}
	
	if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		$mobile_browser++;
	}
	
	if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
		$mobile_browser++;
	}
	
	$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
	$mobile_agents = array(
		'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
		'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
		'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
		'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
		'newt','noki','palm','pana','pant','phil','play','port','prox',
		'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
		'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
		'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
		'wapr','webc','winw','winw','xda ','xda-');
	
	if (in_array($mobile_ua,$mobile_agents)) {
		$mobile_browser++;
	}
	
	if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0) {
		$mobile_browser++;
		//Check for tablets on opera mini alternative headers
		$stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
		if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
		  $tablet_browser++;
		}
	}

	if ($mobile_browser > 0) {
		if($oi_align == 'right'){
		$oi_align = 'left';
		}
	
	}
	?>
	
	<?php if($oi_border == 'left'){
		$oi_border_otput ='border-left: '.$oi_border_h.' '.$oi_border_s.' '.$oi_border_c.';';
	}elseif($oi_border == 'right'){
		$oi_border_otput ='border-right: '.$oi_border_h.' '.$oi_border_s.' '.$oi_border_c.';';
	};
	$content .='<div class="oi_custom_heading_holder" style="margin-bottom:'.$oi_heading_mb.'">';
		if(isset($atts['icon_type'])){
		$oi_icon_output .='<i class="'.$icon.'" style="font-size:'.$oi_icon_w.'; line-height:'.$oi_icon_w.'; color:'.$oi_icon_c.'"></i>';
		};
		if($oi_border == 'top'){
			$content .='<div class="oi_heading_border oi_border_position_'.$oi_border.'" style="text-align:'.$oi_align.'; height:'.$oi_border_h.'"><span style="text-align:'.$oi_align.'; width:'.$oi_border_w.'; border-top:'.$oi_border_h.' '.$oi_border_s.' '.$oi_border_c.';"></span></div>';
		};
			if($icon_type !='None'){
				if ($oi_align == 'left'){
					$content .='<div class="oi_heading_icon oi_heading_icon_'.$oi_align.'">'.$oi_icon_output.'</div>';
				};
				if ($oi_align== 'right'){
					$content .='<div class="oi_heading_icon oi_heading_icon_'.$oi_align.'">'.$oi_icon_output.'</div>';
				};	
			};
			$content .='<div class="oi_vc_heading oi_border_position_'.$oi_border.'" style="text-align:'.$oi_align.'; '.$oi_border_otput.'">';
				if($icon_type !='None'){
					if ($oi_align == 'center'){
						$content .='<div class="oi_heading_icon oi_heading_icon_'.$oi_align.'">'.$oi_icon_output.'</div>';
					};
				};
				$content .='<'.$oi_title_size.' style="color:'.$oi_title_color.'; font-style:'.$oi_title_style.';" class="oi_icon_titile">'.$oi_title.'</'.$oi_title_size.'>';
				if($oi_border == 'center'){
					$content .='<div class="oi_heading_border oi_border_position_'.$oi_border.'" style="text-align:'.$oi_align.';"><span style="text-align:'.$oi_align.'; width:'.$oi_border_w.'; border-top:'.$oi_border_h.' '.$oi_border_s.' '.$oi_border_c.';"></span></div>';
				};
				if($oi_sub_title != '') {
					$content .='<'.$oi_sub_title_size.' style="color:'.$oi_sub_title_color.'; font-style:'.$oi_sub_title_style.';" class="oi_icon_sub_titile">'.$oi_sub_title.'</'.$oi_sub_title_size.'>';
				};
				if($oi_border == 'bottom'){
					$content .='<div class="oi_heading_border oi_border_position_'.$oi_border.'" style="text-align:'.$oi_align.';"><span style="text-align:'.$oi_align.'; width:'.$oi_border_w.'; border-top:'.$oi_border_h.' '.$oi_border_s.' '.$oi_border_c.';"></span></div>';
				};
	   		$content .='</div>';
			
		
	$content .='</div>';
	return $content;
};


/*VC_MAP*/
vc_map( array(
	"name" => __("Custom heading",'maxcode-pure-portfolio-and-business-theme'),
	"base" => "oi_vc_heading",
	"admin_enqueue_css" => array(get_template_directory_uri().'/framework/vc_extend/style.css'),
	"class" => "",
	"icon" => "oi_icon_heading",
	"category" => __('OI','maxcode-pure-portfolio-and-business-theme'),
	"params" => array(
		
		
		

		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_title",
			"heading" => __("Title", "orangeidea"),
			"value" => 'This is Title',
			"group" => "Title"
		),
		array(
			'type' => 'dropdown',
			'heading' => "Title Size",
			'param_name' => 'oi_title_size',
			'value' => array( "h1", "h2", "h3", "h4", "h5", "h6", "p" ),
			'std' => 'h3',
			"group" => "Title"
		),
		array(
			'type' => 'dropdown',
			'heading' => "Title Style",
			'param_name' => 'oi_title_style',
			'value' => array( "normal", "italic" ),
			"group" => "Title"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_title_color",
			"heading" => __("Title Color", "orangeidea"),
			"value" => '#000',
			"group" => "Title"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_sub_title",
			"heading" => __("Sub Title", "orangeidea"),
			"value" => 'Asesome subtitle goes here',
			"group" => "Sub Title"
		),
		array(
			'type' => 'dropdown',
			'heading' => "Sub Title Style",
			'param_name' => 'oi_sub_title_size',
			'value' => array( "p", "h6", "h5", "h4", "h3", "h2", "h1", ),
			'std' => 'p',
			"group" => "Sub Title"
		),
		array(
			'type' => 'dropdown',
			'heading' => "Sub Title Size",
			'param_name' => 'oi_sub_title_style',
			'value' => array( "normal", "italic" ),
			"group" => "Sub Title"
		),
		
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_sub_title_color",
			"heading" => __("Sub Title Color", "orangeidea"),
			"value" => '#666',
			"group" => "Sub Title"
		),
		array(
			'type' => 'dropdown',
			'heading' => "Heading align",
			'param_name' => 'oi_align',
			'value' => array( "left", "center", "right" ),
			"group" => "Title"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_heading_mb",
			"heading" => __("Heading margin bottom", "orangeidea"),
			"value" => '20px',
			"group" => "Title"
		),
		
		
		array(
			'type' => 'dropdown',
			'heading' => "Heading border",
			'param_name' => 'oi_border',
			'value' => array("none", "bottom", "center", "top", "left", "right" ),
			"group" => "Border"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_border_w",
			"heading" => __("Border Width", "orangeidea"),
			"value" => '100px',
			"group" => "Border"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_border_h",
			"heading" => __("Border height", "orangeidea"),
			"value" => '1px',
			"group" => "Border"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_border_c",
			"heading" => __("Border Color", "orangeidea"),
			"value" => '#eaeaea',
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
			"param_name" => "oi_icon_w",
			"heading" => __("Icon Size", "orangeidea"),
			"value" => '24px',
			"group" => "Icon"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_icon_c",
			"heading" => __("Icon Color", "orangeidea"),
			"value" => '#000',
			"group" => "Icon"
		),
		
		
		
	)
) );


