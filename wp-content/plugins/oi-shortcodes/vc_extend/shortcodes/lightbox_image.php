<?php
/*Partner*/
add_shortcode('oi_lb_image', 'oi_lb_image_f');
function oi_lb_image_f( $atts, $content = null)
{
	extract(shortcode_atts(
		array(
			'image' => "",
			'gallery' => "gallery_name"
		), $atts)
	);
	$image_done = wp_get_attachment_image_src($image,'full img-responsive');
	$output = '<a href="'.$image_done[0].'" data-rel="lightcase:'.$gallery.':slideshow">
                	 <div class="oi_ff_img_holder">
                        <img class="img-responsive" src="'.$image_done[0].'" alt="" />
                    </div>
                </a>';
	return $output;
};


vc_map( array(
   "name" => __("LIghtbox Image",'maxcode_theme_orangeidea'),
   "base" => "oi_lb_image",
   "class" => "",
   "icon" => "icon-wpb-team_member",
   "admin_enqueue_css" => array(get_template_directory_uri().'/vc_extend/style.css'),
   "category" => __('OI','maxcode_theme_orangeidea'),
   "params" => array(
	  array(
         "type" => "attach_image",
         "class" => "",
         "heading" => __("Image",'maxcode_theme_orangeidea'),
         "param_name" => "image",
         "value" => "",
      ),
	  array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Gallery Name",'maxcode_theme_orangeidea'),
         "param_name" => "gallery",
         "value" => __("gallery_name",'maxcode_theme_orangeidea'),
      )
   )
) );

