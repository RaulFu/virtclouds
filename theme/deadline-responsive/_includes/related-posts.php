<?php include( TEMPLATEPATH . '/_admin/get-options.php' ); ?>

<!-- BEGIN #related-posts -->
<div id="related-posts">

	<h3 class="widget-title"><?php _e('Related posts', 'framework') ?></h3>
	
	<?php
	$aw_post_categories = wp_get_object_terms(get_the_ID(),'category',array('order_by' => 'term_order'));
	$cats = array();
	foreach($aw_post_categories as $c) { if($c->parent == 0) $cats[] = $c->term_id; }
	$args = array('post__not_in' => array(get_the_ID()), 'posts_per_page' => $aw_nb_posts_related );
	if(count($cats) != 0) $args['category__in'] = $cats;
	$aw_related = new WP_Query($args);
	?>
	
	<?php if($aw_related->have_posts()): while($aw_related->have_posts()): $aw_related->the_post(); ?>
	
	<!-- BEGIN .post -->
	<div class="post floated-thumb">
				
		<?php if((function_exists('has_post_thumbnail')) && (has_post_thumbnail())): ?>
						
		<!-- BEGIN .post-thumb -->
		<div class="post-thumb">
			
			<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><?php the_post_thumbnail('grid-1'); ?></a>
			
		</div>
		<!-- END .post-thumb -->
		
		<?php else : ?>
	
		<!-- BEGIN .post-thumb -->
		<div class="post-thumb">
		
			<?php $format = get_post_format(); if($format == '') $format = 'standard'; ?>
			<a href=""><img src="<?php echo get_template_directory_uri(); ?>/_assets/img/_thumbs/<?php echo $format; ?>-60x60.png" alt="" /></a>
			
		</div>
		<!-- END .post-thumb -->
		
		<?php endif; ?>
		
		<!-- BEGIN .post-meta -->
		<div class="post-meta">
		
			<p><a class="meta-title" href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><?php the_title(); ?></a><br /><?php $date_format = get_option( 'date_format' ); the_time($date_format); echo ' &middot; '; comments_popup_link(__('No comments', 'framework'), __('1 comment', 'framework'), __('% comments', 'framework')); ?></p>
			
			<p class="excerpt"><?php echo get_the_excerpt(); ?></p>
				
		</div>
		<!-- END .post-meta -->
		
		<div class="clear"></div>
	
	</div>
	<!-- END .post -->
	
	<?php endwhile; ?>

<?php
endif;
wp_reset_postdata();
?>

</div>
<!-- END #related-posts -->