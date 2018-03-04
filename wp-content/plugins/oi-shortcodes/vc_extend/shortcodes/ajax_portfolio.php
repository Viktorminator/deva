<?php 
/*DROPCAP*/
add_shortcode('oi_ajax_portfolio', 'oi_ajax_portfolio_f');
function oi_ajax_portfolio_f( $atts, $content = null)
{
	extract(shortcode_atts(array(), $atts));
	
	$args = array(
			'post_type' 		=> 'portfolio',
			'posts_per_page' 	=> 1,
			'post_status' 		=> 'publish',
			'orderby' 			=> 'date',
			'order' 			=> 'DESC',
		);
		$next_args = array(
			'post_type' 		=> 'portfolio',
			'posts_per_page' 	=> 1,
			'offset'           => 1,
			'post_status' 		=> 'publish',
			'orderby' 			=> 'date',
			'order' 			=> 'DESC',
		);
		$last_args = array(
			'post_type' 		=> 'portfolio',
			'posts_per_page' 	=> 1,
			'offset'           => 0,
			'post_status' 		=> 'publish',
			'orderby' 			=> 'date',
			'order' 			=> 'ASC',
		);
		$last_post = get_posts($last_args);
		$next_post = get_posts($next_args);
		$this_post = get_posts($args);
		$thisid = $this_post[0]->ID;
		$nextid = $next_post[0]->ID;
		$lastid = $last_post[0]->ID;
		$feat_image = wp_get_attachment_url( get_post_thumbnail_id($thisid) );
		$cat = get_the_terms( $thisid, 'portfolio-category' );
                if (isset($cat) && ($cat!='')){
                    $cat_name = ''; 
                    foreach($cat  as $vallue=>$key){
                        $cat_name  .= ''.$key->name.', ';
                    }
                };
                $this_date = get_the_date( get_option( 'date_format' ), $thisid );
                $next_post = get_next_post(true);
				$allowed_html_array = wp_kses_allowed_html( 'post' );
                $post_cont =  do_shortcode(wp_kses(get_post_meta($thisid, 'port-description', true), $allowed_html_array ));
		
		$output ='<div class="oi_ajax_port_holder">
						<div id="oi_next_image_shortcode" class="oi_bg_img_shortcod"></div>
						<div id="oi_current_image_shortcode" class="oi_bg_img_shortcode" style="background-image:url('.$feat_image.')"></div>
						<div class="oi_creative_p_content" data-first="'.$thisid.'" data-last="'.$lastid.'">
							<div class="oi_creative_p_holder">
								<div class="oi_c_resize"><span>↑</span><span></span>↓</div>
								<p class="oi_creative_p_date"><span class="oi_c_date">'.$this_date.'></span>  <span class="oi_c_cats">'.esc_attr(substr($cat_name, '0', '-2')).'</span></p>
								<h3 class="oi_c_title"><a data-menu="no" data-id="'.$thisid.'" href="'.get_permalink($thisid).'">'.get_the_title($thisid).'</a></h3>
								<a data-offset="0" data-id="'.$lastid.'" class="oi_crea_a oi_prev_c_p" href="#">←</a>
								<a data-offset="1" data-id="'.$nextid.'" class="oi_crea_a oi_next_c_p" href="#">→</a>
								<div class="oi_c_description">
									<hr>
									<div class="oi_c_description_content">'.$post_cont.'
									</div>
									<a class="oi_c_details" data-menu="no" data-id="'.$thisid.'"  href="'.get_permalink($thisid).'">'.esc_attr(__('Read More','qoon-creative-wordpress-portfolio-theme')).'</a>
								</div>
							</div>
						</div>
					</div>';
	
	
	
	return $output;
};

/*DROPCAP*/
vc_map( array(
	"name" => __("Ajax Portfolio",'oi_shortcodes'),
	"base" => "oi_ajax_portfolio",
	"admin_enqueue_css" => array(get_template_directory_uri().'/framework/vc_extend/style.css'),
	"class" => "",
	"icon" => "oi_icon_dropcap",
	"category" => __('OI','oi_shortcodes'),
	"params" => array(
		
	)
) );


