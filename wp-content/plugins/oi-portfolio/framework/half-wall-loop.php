<?php 
$e_tag = get_post_meta($post->ID, 'oi_tag', 1);
$p_tag = "";
if  ($e_tag !='All'){
$p_tag = get_term_by('name', $e_tag, 'portfolio-tags');
};
	global $wp_query;
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;
	if($p_tag !=''){
	$args = array(
		'post_type' 		=> 'portfolio',
		'posts_per_page' 	=> get_post_meta($post->ID, 'port-count', true),
		'post_status' 		=> 'publish',
		'orderby' 			=> 'date',
		'order' 			=> 'DESC',
		'paged' 			=> $paged,
		'tax_query' => array(
			array(
				'taxonomy' => 'portfolio-tags',
				'terms'    => $p_tag->term_id,
			),
		),
	);}else{
		$args = array(
		'post_type' 		=> 'portfolio',
		'posts_per_page' 	=> get_post_meta($post->ID, 'port-count', true),
		'post_status' 		=> 'publish',
		'orderby' 			=> 'date',
		'order' 			=> 'DESC',
		'paged' 			=> $paged,
	);
		}
	$wp_query = new WP_Query($args);
?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
    <?php
		$catt = get_the_terms( $post->ID, 'portfolio-category' );
		if (isset($catt) && ($catt!='')){
			$slugg = '';
			$slug = ''; 
			foreach($catt  as $vallue=>$key){
				$slugg .= strtolower($key->slug) . " ";
				$slug  .= ''.$key->name.', ';
			}
			
		};
	?>
    
	<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '') ?>
    <?php $thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '') ?>
	 	<?php
        	if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-squre'){ $col='oi_col col-md-6 oi_x1'; $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-squrex2'){ $col='oi_col col-md-6 oi_x1'; $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-wide'){ $col='oi_col col-md-6 oi_x1'; $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');};
			if (get_post_meta($post->ID, 'oi_th', 1) == 'portfolio-long'){ $col='oi_col col-md-6 oi_x1'; $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');};
		?>
		<div class="oi_strange_portfolio_item oi_port_style_ii <?php echo esc_attr($col);?> <?php echo esc_attr($slugg)?>">
            <div class="oi_vc_potrfolio" style="background:url('<?php echo esc_url($large_image_url[0]); ?>')">
            	<a data-id="<?php echo $post->ID?>" href="<?php the_permalink($post->ID)?>">
                <div class="oi_vc_port_mask"  style="background:<?php echo get_post_meta($post->ID, 'port-bg', true); ?>">
                    <div class="text-center">
                    	<i class="fa fa-eye" style="color:<?php echo get_post_meta($post->ID, 'port-text-color', true); ?>"></i>
                        <div class="hover_overlay">
                            <h3 class="oi_sub_legend" style="color:<?php echo get_post_meta($post->ID, 'port-text-color', true); ?>"><?php the_title();?></h3>
                            <div class="oi_vc_port_cat" style="color:<?php echo get_post_meta($post->ID, 'port-text-color', true); ?>"><?php echo esc_attr(substr($slug, '0', '-2'));?></div>
                            <div class="oi_vc_sep" style="background:<?php echo get_post_meta($post->ID, 'port-text-color', true); ?>"></div>
                    	</div>
                    </div>
                </div>
                </a>
            </div>
            <div class="oi_port_item_bottom">
                <h3 class="oi_sub_legend"><a data-id="<?php echo $post->ID?>" href="<?php the_permalink($post->ID)?>"><?php the_title();?></a></h3>
                <div class="oi_vc_port_cat"><?php echo esc_attr(substr($slug, '0', '-2'));?></div>
            </div>
        </div>
        
<?php endwhile; endif; ?>
