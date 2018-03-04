<?php get_header(); ?>
<?php global $oi_options; ?>
<div class="this_page oi_page_holder <?php if(get_post_meta($post->ID, 'port_cont_lay', 1)=='Full Page'){echo 'oi_full_port_page';};  if(get_post_meta($post->ID, 'port_cont_lay', 1)=='Full Page Raw Scroller'){echo 'oi_full_port_page_raw_scroller';};?>">
	<?php if(get_post_meta($post->ID, 'port_bread', 1) !='No'){ echo qoon_breadcrumbs();};?>
	<div class="oi_sinle_portfolio_holder">
		<?php if ($oi_qoon_options['site-layout']=='standard'){ echo '<div class="container">';}?>        
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="oi_portfolio_page_holder">
			<?php  do_shortcode(the_content());?>
        </div>
        
        <div  class="oi_port_nav">
        	<?php
			$next_post = get_next_post();
			$previous_post = get_previous_post();
			if(isset($previous_post->ID)){
			$prev_image = wp_get_attachment_url( get_post_thumbnail_id($previous_post->ID,''));
			}
			if(isset($next_post->ID)){
			$next_image = wp_get_attachment_url( get_post_thumbnail_id($next_post->ID,''));
			}
			?>
            
        </div>
        <div class="oi_port_nav oi_main_port_nav">
        	<div class="raw">
            	<?php if (isset($next_post->ID)){?>
                <div class="<?php if (isset($previous_post->ID)){?>col-md-6 col-sm-6 col-xs-6<?php }else{echo 'col-md-12';};?> oi_np_holder" style=" background-image:url('<?php echo $next_image; ?>');">
                    <span class="oi_np_link"><?php next_post_link('%link','<span class="oi_a_holder" data-id="'.$next_post->ID.'"><i class="fa fa-long-arrow-left fa-fw"></i> %title</span>', false); ?></span>
                </div>
                <?php };?>
                <?php if (isset($previous_post->ID)){?>
                <div class="<?php if (isset($next_post->ID)){?>col-md-6 col-sm-6 col-xs-6<?php }else{echo 'col-md-12';};?> oi_np_holder" style="background-image:url('<?php echo $prev_image; ?>');">
                	<span class="oi_np_link"><?php  previous_post_link('%link','<span class="oi_a_holder" data-id="'.$previous_post->ID.'">%title <i class="fa fa-long-arrow-right fa-fw"></i></span>', false); ?></span>
                </div>
                <?php };?>
            </div>
        </div>
		<?php endwhile; endif;?>
        <?php if ($oi_qoon_options['site-layout']=='standard'){ echo '</div>';}?> 
       
    </div>
</div>
<?php get_footer(); ?>