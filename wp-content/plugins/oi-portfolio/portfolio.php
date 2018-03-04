<?php // Template Name: Portfolio Template ?>
<?php get_header(); $oi_qoon_options = get_option('oi_qoon_options'); ?>
<div class="oi_port-hover-<?php echo $oi_qoon_options['portfolio-hover'];?>">
<?php if ($oi_qoon_options['site-layout']=='standard'){?><div class="container oi_p_width_<?php echo get_post_meta($post->ID, 'oi_ps_w', 1); ?>"><?php };?>
<?php if ((get_post_meta($post->ID, 'oi_ps', 1)!='creative') && get_post_meta($post->ID, 'oi_ps', 1)!='modern') {?>
<div class="potfolio_container_holder">
<div class="oi_page_holder <?php if ( isset($sb)  && $sb =='No'){?>oi_without_sidebar<?php };?> <?php if( get_post_meta($post->ID, 'cont_lay', 1) =="Without Paddings"){?>oi_page_without_paddings<?php };?>">
	<?php if (get_post_meta($post->ID, 'port_layout', 1) == 'Random Thumbnails With Spaces'){?>
	<div class="oi_r_t_w_s">
    <?php } elseif (get_post_meta($post->ID, 'port_layout', 1) == 'Random Thumbnails Without Spaces') {?>
    <div class="oi_r_t_wo_s">
    <?php } elseif (get_post_meta($post->ID, 'port_layout', 1) == 'Square Thumbnails Without Spaces') {?>
    <div class="oi_s_t_wo_s">
    <?php } elseif (get_post_meta($post->ID, 'port_layout', 1) == 'Square Thumbnails With Spaces') {?>
    <div class="oi_s_t_w_s">
    <?php } elseif (get_post_meta($post->ID, 'port_layout', 1) == '4 Square Thumbnails Without Spaces') {?>
    <div class="oi_f_s_t_wo_s">
    <?php } elseif (get_post_meta($post->ID, 'port_layout', 1) == '4 Square Thumbnails With Spaces') {?>
    <div class="oi_f_s_t_w_s">
    <?php } elseif (get_post_meta($post->ID, 'port_layout', 1) == 'Half Thumbnails With Spaces') {?>
    <div class="oi_h_t_w_s">
    <?php } elseif (get_post_meta($post->ID, 'port_layout', 1) == 'Half Thumbnails Without Spaces') {?>
    <div class="oi_h_t_wo_s">
    <?php };?>
    <div>
    <?php if (get_post_meta($post->ID, 'port_page', 1) == 'Top') {?>
    <?php
    if ( have_posts() ) : while ( have_posts() ) : the_post();
    the_content(); 
    endwhile; endif;?>
    <?php }; ?>
    <?php echo  html_entity_decode(get_post_meta($post->ID, 'page-legend', true))?>
   
    
   
    
    <?php if(get_post_meta($post->ID, 'oi_ps', 1) == 'creative'){ ?>

	<?php }else{?>
    
	<?php if (get_post_meta($post->ID, 'port_filters', 1) == 'Yes') {?>
   	<?php if ($oi_qoon_options['oi_filters']=='1'){?>
    <div class="oi_port_filter_holder">
        <div class="oi_port_filter" id="filters"> 
            <ul class="oi_list_cats">
				<?php $categories = get_categories(array('type' => 'portfolio', 'taxonomy' => 'portfolio-category')); 
                echo "<li class='cat-item'><a href='#' data-filter='*' class='filter_button'>All Works</a></li>";
                foreach($categories as $category) {
                    $group = $category->slug;
                    echo "<li><a href='#' data-filter='.$group' class='filter_button'>".$category->cat_name."</a></li>";
                }
            ?> 
            </ul>
    	</div>
    </div>
    <?php }else{ ?>
    <a href="#" class="oi_hamburger_filters"><i class="fa fa-fw fa-th"></i></a>
    <?php }; ?>
    <?php }; ?>
    
    
		<?php if (get_post_meta($post->ID, 'port_layout', 1) == 'Random Thumbnails With Spaces'){?>
        <div class="row oi_port_container">
            <?php include_once("framework/portfolio-loop.php");?>
        </div>
        <?php } elseif (get_post_meta($post->ID, 'port_layout', 1) == 'Random Thumbnails Without Spaces') {?>
        <div class="row oi_port_container oi_wall">
            <?php include_once("framework/portfolio-wall-loop.php");?>
        </div>
        <?php } elseif (get_post_meta($post->ID, 'port_layout', 1) == 'Square Thumbnails Without Spaces') {?>
        <div class="row oi_port_container oi_wall">
            <?php include_once("framework/portfolio-square-wall-loop.php");?>
        </div>
        <?php } elseif (get_post_meta($post->ID, 'port_layout', 1) == 'Square Thumbnails With Spaces') {?>
        <div class="row oi_port_container">
            <?php include_once("framework/portfolio-square-loop.php");?>
        </div>
        <?php } elseif (get_post_meta($post->ID, 'port_layout', 1) == '4 Square Thumbnails Without Spaces') {?>
        <div class="row oi_port_container oi_wall">
            <?php include_once("framework/portfolio-f-square-wall-loop.php");?>
        </div>
        <?php } elseif (get_post_meta($post->ID, 'port_layout', 1) == '4 Square Thumbnails With Spaces') {?>
        <div class="row oi_port_container">
            <?php include_once("framework/portfolio-f-square-loop.php");?>
        </div>
        <?php } elseif (get_post_meta($post->ID, 'port_layout', 1) == 'Half Thumbnails With Spaces') {?>
        <div class="row oi_port_container">
            <?php include_once("framework/half-loop.php");?>
        </div>
        <?php } elseif (get_post_meta($post->ID, 'port_layout', 1) == 'Half Thumbnails Without Spaces') {?>
        <div class="row oi_port_container oi_wall">
            <?php include_once("framework/half-wall-loop.php");?>
        </div>
        <?php };?>
    <?php }; ?>
    
    
    
    <?php wp_reset_query(); ?>
	<?php if (get_post_meta($post->ID, 'port_load_more', 1) == 'Yes') {?>
    <div class="oi_load_more_holder">
        <?php
			if(get_post_meta($post->ID, 'oi_tag', 1) =="All"){
			$count_posts = wp_count_posts('portfolio');
			$published_posts = $count_posts->publish;
			}else{
				$taxonomy = "portfolio-tags"; // can be category, post_tag, or custom taxonomy name
				// Using Term Slug
				$term_name = get_post_meta($post->ID, 'oi_tag', 1);
				$term = get_term_by('name', $term_name, $taxonomy);
				
				// Fetch the count
				$published_posts = $term->count;
			};
		?>
        
        <div class="oi_lmc_holder">
            <span>
                <span class="oi_counts"><span id="oi_masorny_posts_per_page"><?php echo esc_attr(get_post_meta($post->ID, 'port-count', true)); ?></span> / <span id="oi_max_masorny_posts"><?php echo esc_attr($published_posts);?></span></span>
                <a id="load_more_port_masorny_posts" data-tag="<?php echo get_post_meta($post->ID, 'oi_tag', 1)?>" data-offset="<?php echo esc_attr(get_post_meta($post->ID, 'port-count', true)); ?>" data-layout-mode="<?php echo esc_attr(get_post_meta($post->ID, 'port_layout', 1)) ?>" data-load-posts_count="<?php echo (get_post_meta($post->ID, 'port-load_count', true)); ?>"  class="oi_load_more"><span><?php _e("Load More ", "orangeidea");?></span></a>
            </span>
        </div>
    </div>
    <?php };?>
    <?php if (get_post_meta($post->ID, 'port_page', 1) == 'Bottom') {?>
    <div style="margin-top:40px;">
    <?php
    if ( have_posts() ) : while ( have_posts() ) : the_post();
    the_content(); 
    endwhile; endif;?>
    </div>
    <?php }; ?>
    </div>
    </div>
  </div>  
    <!--<a class="oi_full_btn" href="#">View our entire WordPress theme collection →</a>-->
   </div>
<?php };?>
<?php if ($oi_qoon_options['site-layout']=='standard'){?></div><?php };?>
</div>
<?php get_footer();?>