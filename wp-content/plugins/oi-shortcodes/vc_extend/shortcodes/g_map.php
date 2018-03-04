<?php
/*GOOGLE MAP*/
add_shortcode('vc_g_map', 'vc_g_map_f');
function vc_g_map_f( $atts, $content = null)
{
	extract(shortcode_atts(
		array(
			'address' => '7th Ave, New York, NY',
			'zoom' => '13',
			'height' => '450px',
			'apikey'=>'API KEY'
		), $atts)
	);
	$map = "$('#map').height($(window).outerHeight())";
	$the_content ='';
	if(isset($content) && $content !=''){$the_content = '<div id="map_description">'.do_shortcode($content).'</div>';};
	$content = $the_content.'<div id="map" style="height:'.$height.'">
					
			   </div>
			   <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key='.$apikey.'"></script>
			   <script>
				jQuery.noConflict()(function($){
					jQuery(document).ready(function($) {
				'.($height =='full' ? $map : '').'
				$("#map").gmap3({
					
					marker:{     
					// address:"93 Worth St, New York, NY",
					address :"'.$address.'", 
					options:{ icon: "'.get_template_directory_uri().'/framework/css/img/marker.png"}},
					map:{
					options:{
					styles: [ {
					stylers: [ { "saturation":-100 }, { "lightness": 0 }, { "gamma": 1}]},
					],
					zoom: '.$zoom.',
					scrollwheel:false,
					draggable: true }
					}
					});	
					$(document).on("opened", ".remodal", function () {
						 google.maps.event.trigger(map, "resize");
					});
				});
				});
				</script>';
	return $content;
};

vc_map( array(
	"name" => __("Google Map",'maxcode-pure-portfolio-and-business-theme'),
	"base" => "vc_g_map",
	"admin_enqueue_css" => array(get_template_directory_uri().'/framework/vc_extend/style.css'),
	"class" => "",
	"category" => __('OI','maxcode-pure-portfolio-and-business-theme'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "apikey",
			"description" => "Generate API KEY - https://developers.google.com/maps/documentation/javascript/get-api-key",
			"heading" => __("API KEY for Google Map", "orangeidea"),
			"value" => 'API KEY',
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "address",
			"heading" => __("Addres", "orangeidea"),
			"value" => '7th Ave, New York, NY',
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "zoom",
			"heading" => __("Zoom", "orangeidea"),
			"value" => '13',
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "height",
			"heading" => __("Map Height (enter 'full' to set fullheight map)", "orangeidea"),
			"value" => '450px',
		),
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"param_name" => "content",
			"heading" => __("HTML content on the map (right top corner)", "orangeidea"),
			"value" => '',
		),
	)
) );


