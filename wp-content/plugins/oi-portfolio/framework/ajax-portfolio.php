<?php	 		 		 		 		 		 	
header("Content-type: application/json; charset=UTF-8");
if (!function_exists('__'))  
{
	require_once ("../../../../wp-load.php");
};

wp_reset_postdata();
global $post;

$result['new_posts'] ='';
if ($_GET['oi_tag'] =="All"){
$args = array(
		'post_type' => 'portfolio',
		'posts_per_page' => $_GET['oi_load_post_count'],
		'offset' => $_GET['oi_modal']
);}else{
$e_tag = $_GET['oi_tag'];
$p_tag = get_term_by('name', $e_tag, 'portfolio-tags');

	$args = array(
		'post_type' => 'portfolio',
		'posts_per_page' => $_GET['oi_load_post_count'],
		'offset' => $_GET['oi_modal'],
		'tax_query' => array(
			array(
				'taxonomy' => 'portfolio-tags',
				'terms'    => $p_tag->term_id,
			),
		),
);
	}
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
			$catt = get_the_terms( $post->ID, 'portfolio-category' );
			$slugg = '';
			$slug = ''; 
			foreach($catt  as $vallue=>$key){
				$slugg .= strtolower($key->slug) . " ";
				$slug  .= ''.$key->name.', ';
			}
			
		if ($_GET['oi_layout_mode'] == 'Random Thumbnails With Spaces') {
		
		
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '');
   
        	if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-squre'){ $col='oi_col col-md-3 oi_x1'; $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-squrex2'){ $col='oi_col col-md-6 oi_x2'; $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-wide'){ $col='oi_col col-md-6 oi_x1'; $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-long'){ $col='oi_col col-md-3 oi_x2'; $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');};

		$result['new_posts'] .='<div class="oi_strange_portfolio_item oi_port_style_ii '.$col.' '.$slugg.'">';
            $result['new_posts'] .='<div class="oi_vc_potrfolio" style="background:url('.$large_image_url[0].')">';
            	$result['new_posts'] .='<a href="'.get_the_permalink($post->ID).'">';
                $result['new_posts'] .='<div class="oi_vc_port_mask"  style="background:'.get_post_meta($post->ID, 'port-bg', true).'">';
                    $result['new_posts'] .='<div class="text-center">';
						$result['new_posts'] .='<i class="fa fa-eye" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'"></i>';
						$result['new_posts'] .='<div class="hover_overlay">';
							$result['new_posts'] .= '<h3 class="oi_sub_legend" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.get_the_title($post->ID).'</h3>';
							$result['new_posts'] .= '<div class="oi_vc_port_cat" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.substr($slug, '0', '-2').'</div>';
							$result['new_posts'] .= '<div class="oi_vc_sep" style="background:'.get_post_meta($post->ID, 'port-text-color', true).'"></div>';
                    	$result['new_posts'] .='</div>';
					$result['new_posts'] .='</div>';
                $result['new_posts'] .='</div>';
                $result['new_posts'] .='</a>';
            $result['new_posts'] .='</div>';
			$result['new_posts'] .='<div class="oi_port_item_bottom">';
				$result['new_posts'] .= '<h3 class="oi_sub_legend" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.get_the_title($post->ID).'</h3>';
				$result['new_posts'] .= '<div class="oi_vc_port_cat" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.substr($slug, '0', '-2').'</div>';
			$result['new_posts'] .='</div>';
        $result['new_posts'] .='</div>';

		};
		
		
		if ($_GET['oi_layout_mode'] == 'Random Thumbnails Without Spaces') {
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '');
   
        	if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-squre'){ $col='oi_col col-md-3 oi_x1'; $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-squrex2'){ $col='oi_col col-md-6 oi_x2'; $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-wide'){ $col='oi_col col-md-6 oi_x1'; $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-long'){ $col='oi_col col-md-3 oi_x2'; $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');};

		$result['new_posts'] .='<div class="oi_strange_portfolio_item oi_port_style_ii '.$col.' '.$slugg.'">';
            $result['new_posts'] .='<div class="oi_vc_potrfolio" style="background:url('.$large_image_url[0].')">';
            	$result['new_posts'] .='<a href="'.get_the_permalink($post->ID).'">';
                $result['new_posts'] .='<div class="oi_vc_port_mask"  style="background:'.get_post_meta($post->ID, 'port-bg', true).'">';
                    $result['new_posts'] .='<div class="text-center">';
						$result['new_posts'] .='<i class="fa fa-eye" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'"></i>';
						$result['new_posts'] .='<div class="hover_overlay">';
							$result['new_posts'] .= '<h3 class="oi_sub_legend" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.get_the_title($post->ID).'</h3>';
							$result['new_posts'] .= '<div class="oi_vc_port_cat" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.substr($slug, '0', '-2').'</div>';
							$result['new_posts'] .= '<div class="oi_vc_sep" style="background:'.get_post_meta($post->ID, 'port-text-color', true).'"></div>';
                    	$result['new_posts'] .='</div>';
					$result['new_posts'] .='</div>';
                $result['new_posts'] .='</div>';
                $result['new_posts'] .='</a>';
            $result['new_posts'] .='</div>';
			$result['new_posts'] .='<div class="oi_port_item_bottom">';
				$result['new_posts'] .= '<h3 class="oi_sub_legend" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.get_the_title($post->ID).'</h3>';
				$result['new_posts'] .= '<div class="oi_vc_port_cat" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.substr($slug, '0', '-2').'</div>';
			$result['new_posts'] .='</div>';
        $result['new_posts'] .='</div>';
		};
		
		
		if ($_GET['oi_layout_mode'] == 'Square Thumbnails With Spaces') {
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
		$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-squre'){ $col='col-md-4  oi_x1';};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-squrex2'){ $col='col-md-4  oi_x1';};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-wide'){ $col='col-md-4  oi_x1';};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-long'){ $col='col-md-4  oi_x1';};
				
		$result['new_posts'] .='<div class="oi_strange_portfolio_item oi_port_style_ii '.$col.' '.$slugg.'">';
            $result['new_posts'] .='<div class="oi_vc_potrfolio" style="background:url('.$large_image_url[0].')">';
            	$result['new_posts'] .='<a href="'.get_the_permalink($post->ID).'">';
                $result['new_posts'] .='<div class="oi_vc_port_mask"  style="background:'.get_post_meta($post->ID, 'port-bg', true).'">';
                    $result['new_posts'] .='<div class="text-center">';
						$result['new_posts'] .='<i class="fa fa-eye" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'"></i>';
						$result['new_posts'] .='<div class="hover_overlay">';
							$result['new_posts'] .= '<h3 class="oi_sub_legend" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.get_the_title($post->ID).'</h3>';
							$result['new_posts'] .= '<div class="oi_vc_port_cat" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.substr($slug, '0', '-2').'</div>';
							$result['new_posts'] .= '<div class="oi_vc_sep" style="background:'.get_post_meta($post->ID, 'port-text-color', true).'"></div>';
                    	$result['new_posts'] .='</div>';
					$result['new_posts'] .='</div>';
                $result['new_posts'] .='</div>';
                $result['new_posts'] .='</a>';
            $result['new_posts'] .='</div>';
			$result['new_posts'] .='<div class="oi_port_item_bottom">';
				$result['new_posts'] .= '<h3 class="oi_sub_legend" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.get_the_title($post->ID).'</h3>';
				$result['new_posts'] .= '<div class="oi_vc_port_cat" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.substr($slug, '0', '-2').'</div>';
			$result['new_posts'] .='</div>';
        $result['new_posts'] .='</div>';
		};
		
		if ($_GET['oi_layout_mode'] == 'Square Thumbnails Without Spaces') {
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
    	$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-squre'){ $col='oi_col col-md-4  oi_x1';};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-squrex2'){ $col='oi_col col-md-4  oi_x1';};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-wide'){ $col='oi_col col-md-4  oi_x1';};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-long'){ $col='oi_col col-md-4  oi_x1';};
				
		$result['new_posts'] .='<div class="oi_strange_portfolio_item oi_port_style_ii '.$col.' '.$slugg.'">';
            $result['new_posts'] .='<div class="oi_vc_potrfolio" style="background:url('.$large_image_url[0].')">';
            	$result['new_posts'] .='<a href="'.get_the_permalink($post->ID).'">';
                $result['new_posts'] .='<div class="oi_vc_port_mask"  style="background:'.get_post_meta($post->ID, 'port-bg', true).'">';
                    $result['new_posts'] .='<div class="text-center">';
						$result['new_posts'] .='<i class="fa fa-eye" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'"></i>';
						$result['new_posts'] .='<div class="hover_overlay">';
							$result['new_posts'] .= '<h3 class="oi_sub_legend" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.get_the_title($post->ID).'</h3>';
							$result['new_posts'] .= '<div class="oi_vc_port_cat" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.substr($slug, '0', '-2').'</div>';
							$result['new_posts'] .= '<div class="oi_vc_sep" style="background:'.get_post_meta($post->ID, 'port-text-color', true).'"></div>';
                    	$result['new_posts'] .='</div>';
					$result['new_posts'] .='</div>';
                $result['new_posts'] .='</div>';
                $result['new_posts'] .='</a>';
            $result['new_posts'] .='</div>';
			$result['new_posts'] .='<div class="oi_port_item_bottom">';
				$result['new_posts'] .= '<h3 class="oi_sub_legend" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.get_the_title($post->ID).'</h3>';
				$result['new_posts'] .= '<div class="oi_vc_port_cat" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.substr($slug, '0', '-2').'</div>';
			$result['new_posts'] .='</div>';
        $result['new_posts'] .='</div>';
		};
		
		if ($_GET['oi_layout_mode'] == 'Half Thumbnails Without Spaces') {
			$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '');
    		$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '');
			
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-squre'){ $col='oi_col col-md-6 oi_x1'; $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-squrex2'){ $col='oi_col col-md-6 oi_x1'; $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-wide'){ $col='oi_col col-md-6 oi_x1'; $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-long'){ $col='oi_col col-md-6 oi_x1'; $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');};
			
			$result['new_posts'] .='<div class="oi_strange_portfolio_item oi_port_style_ii '.$col.' '.$slugg.'">';
            $result['new_posts'] .='<div class="oi_vc_potrfolio" style="background:url('.$large_image_url[0].')">';
            	$result['new_posts'] .='<a href="'.get_the_permalink($post->ID).'">';
                $result['new_posts'] .='<div class="oi_vc_port_mask"  style="background:'.get_post_meta($post->ID, 'port-bg', true).'">';
                    $result['new_posts'] .='<div class="text-center">';
						$result['new_posts'] .='<i class="fa fa-eye" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'"></i>';
						$result['new_posts'] .='<div class="hover_overlay">';
							$result['new_posts'] .= '<h3 class="oi_sub_legend" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.get_the_title($post->ID).'</h3>';
							$result['new_posts'] .= '<div class="oi_vc_port_cat" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.substr($slug, '0', '-2').'</div>';
							$result['new_posts'] .= '<div class="oi_vc_sep" style="background:'.get_post_meta($post->ID, 'port-text-color', true).'"></div>';
                    	$result['new_posts'] .='</div>';
					$result['new_posts'] .='</div>';
                $result['new_posts'] .='</div>';
                $result['new_posts'] .='</a>';
            $result['new_posts'] .='</div>';
			$result['new_posts'] .='<div class="oi_port_item_bottom">';
				$result['new_posts'] .= '<h3 class="oi_sub_legend" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.get_the_title($post->ID).'</h3>';
				$result['new_posts'] .= '<div class="oi_vc_port_cat" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.substr($slug, '0', '-2').'</div>';
			$result['new_posts'] .='</div>';
        $result['new_posts'] .='</div>';
			
		}
		
		if ($_GET['oi_layout_mode'] == 'Half Thumbnails With Spaces') {	
		
			$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '');
    		$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '');
			
        	if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-squre'){ $col='col-md-6 oi_x1'; $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'wall-portfolio-squrex2');};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-squrex2'){ $col='col-md-6 oi_x1'; $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'wall-portfolio-squrex2');};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-wide'){ $col='col-md-6 oi_x1'; $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'wall-portfolio-squrex2');};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-long'){ $col='col-md-6 oi_x1'; $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'wall-portfolio-squrex2');};
			
			$result['new_posts'] .='<div class="oi_strange_portfolio_item oi_port_style_ii '.$col.' '.$slugg.'">';
            $result['new_posts'] .='<div class="oi_vc_potrfolio" style="background:url('.$large_image_url[0].')">';
            	$result['new_posts'] .='<a href="'.get_the_permalink($post->ID).'">';
                $result['new_posts'] .='<div class="oi_vc_port_mask"  style="background:'.get_post_meta($post->ID, 'port-bg', true).'">';
                    $result['new_posts'] .='<div class="text-center">';
						$result['new_posts'] .='<i class="fa fa-eye" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'"></i>';
						$result['new_posts'] .='<div class="hover_overlay">';
							$result['new_posts'] .= '<h3 class="oi_sub_legend" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.get_the_title($post->ID).'</h3>';
							$result['new_posts'] .= '<div class="oi_vc_port_cat" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.substr($slug, '0', '-2').'</div>';
							$result['new_posts'] .= '<div class="oi_vc_sep" style="background:'.get_post_meta($post->ID, 'port-text-color', true).'"></div>';
                    	$result['new_posts'] .='</div>';
					$result['new_posts'] .='</div>';
                $result['new_posts'] .='</div>';
                $result['new_posts'] .='</a>';
            $result['new_posts'] .='</div>';
			$result['new_posts'] .='<div class="oi_port_item_bottom">';
				$result['new_posts'] .= '<h3 class="oi_sub_legend" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.get_the_title($post->ID).'</h3>';
				$result['new_posts'] .= '<div class="oi_vc_port_cat" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.substr($slug, '0', '-2').'</div>';
			$result['new_posts'] .='</div>';
        $result['new_posts'] .='</div>';
		
		}
		
		if ($_GET['oi_layout_mode'] == '4 Square Thumbnails Without Spaces') {
			$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'wall-portfolio-squre');
			$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'wall-portfolio-squre');	
			
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-squre'){ $col='oi_col col-md-3 oi_x1';};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-squrex2'){ $col='oi_col col-md-3 oi_x1';};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-wide'){ $col='oi_col col-md-3 oi_x1';};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-long'){ $col='oi_col col-md-3 oi_x1';};
			
			$result['new_posts'] .='<div class="oi_strange_portfolio_item oi_port_style_ii '.$col.' '.$slugg.'">';
            $result['new_posts'] .='<div class="oi_vc_potrfolio" style="background:url('.$large_image_url[0].')">';
            	$result['new_posts'] .='<a href="'.get_the_permalink($post->ID).'">';
                $result['new_posts'] .='<div class="oi_vc_port_mask"  style="background:'.get_post_meta($post->ID, 'port-bg', true).'">';
                    $result['new_posts'] .='<div class="text-center">';
						$result['new_posts'] .='<i class="fa fa-eye" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'"></i>';
						$result['new_posts'] .='<div class="hover_overlay">';
							$result['new_posts'] .= '<h3 class="oi_sub_legend" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.get_the_title($post->ID).'</h3>';
							$result['new_posts'] .= '<div class="oi_vc_port_cat" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.substr($slug, '0', '-2').'</div>';
							$result['new_posts'] .= '<div class="oi_vc_sep" style="background:'.get_post_meta($post->ID, 'port-text-color', true).'"></div>';
                    	$result['new_posts'] .='</div>';
					$result['new_posts'] .='</div>';
                $result['new_posts'] .='</div>';
                $result['new_posts'] .='</a>';
            $result['new_posts'] .='</div>';
			$result['new_posts'] .='<div class="oi_port_item_bottom">';
				$result['new_posts'] .= '<h3 class="oi_sub_legend" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.get_the_title($post->ID).'</h3>';
				$result['new_posts'] .= '<div class="oi_vc_port_cat" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.substr($slug, '0', '-2').'</div>';
			$result['new_posts'] .='</div>';
        $result['new_posts'] .='</div>';
		
		}
		
		if ($_GET['oi_layout_mode'] == '4 Square Thumbnails With Spaces') {	
			$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
			$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
		
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-squre'){ $col='col-md-3 oi_x1';};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-squrex2'){ $col='col-md-3 oi_x1';};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-wide'){ $col='col-md-3 oi_x1';};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-long'){ $col='col-md-3 oi_x1';};
			
			$result['new_posts'] .='<div class="oi_strange_portfolio_item oi_port_style_ii '.$col.' '.$slugg.'">';
            $result['new_posts'] .='<div class="oi_vc_potrfolio" style="background:url('.$large_image_url[0].')">';
            	$result['new_posts'] .='<a href="'.get_the_permalink($post->ID).'">';
                $result['new_posts'] .='<div class="oi_vc_port_mask"  style="background:'.get_post_meta($post->ID, 'port-bg', true).'">';
                    $result['new_posts'] .='<div class="text-center">';
						$result['new_posts'] .='<i class="fa fa-eye" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'"></i>';
						$result['new_posts'] .='<div class="hover_overlay">';
							$result['new_posts'] .= '<h3 class="oi_sub_legend" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.get_the_title($post->ID).'</h3>';
							$result['new_posts'] .= '<div class="oi_vc_port_cat" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.substr($slug, '0', '-2').'</div>';
							$result['new_posts'] .= '<div class="oi_vc_sep" style="background:'.get_post_meta($post->ID, 'port-text-color', true).'"></div>';
                    	$result['new_posts'] .='</div>';
					$result['new_posts'] .='</div>';
                $result['new_posts'] .='</div>';
                $result['new_posts'] .='</a>';
            $result['new_posts'] .='</div>';
			$result['new_posts'] .='<div class="oi_port_item_bottom">';
				$result['new_posts'] .= '<h3 class="oi_sub_legend" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.get_the_title($post->ID).'</h3>';
				$result['new_posts'] .= '<div class="oi_vc_port_cat" style="color:'.get_post_meta($post->ID, 'port-text-color', true).'">'.substr($slug, '0', '-2').'</div>';
			$result['new_posts'] .='</div>';
        $result['new_posts'] .='</div>';
		
		}

		}
	}
$result['count_new_posts'] = $_GET['oi_post_count'] + $_GET['oi_load_post_count'];
$result['loading'] = __("Load More", "orangeidea");
$result['all_loaded'] = __("", "orangeidea");

wp_reset_postdata();
print json_encode($result)  ?>