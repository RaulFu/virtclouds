<?php 
include( TEMPLATEPATH . '/_admin/get-options.php' );
get_header();
?>

<?php if ($aw_sidebar_position == 'left') get_sidebar(); ?>

<!-- BEGIN .grid-8 -->
<div class="grid-8">

	<?php if (have_posts()) : ?>
	
	<!-- BEGIN .entry-header -->
	<div class="entry-header">
		
		<h1><?php _e('Search results', 'framework') ?></h1>
			
	</div>
	<!-- END .entry-header -->
	
	<?php while (have_posts()) : the_post(); ?>
	
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
		
	<?php if (aw_show_posts_nav()) : ?>
		
	<!-- BEGIN .navigation -->
	<div class="navigation">
		
		<?php
		global $wp_query;
		$big = 999999999;
		echo paginate_links(
			array(
				'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages
			)
		);
		?>
			
	</div>
	<!-- END .navigation -->
			
	<?php endif; ?>
		
	<?php else : ?>

	<!-- BEGIN .entry-header -->
	<div class="entry-header">
		
		<h1><?php _e('Your search did not match any entries.', 'framework') ?></h1>
			
	</div>
	<!-- END .entry-header -->
	
	<!-- BEGIN .post -->
	<div class="post">

		<p><?php _e('Suggestions:','framework') ?></p>
		<ol>
			<li><?php _e('Make sure all words are spelled correctly.', 'framework') ?></li>
			<li><?php _e('Try different keywords.', 'framework') ?></li>
			<li><?php _e('Try more general keywords.', 'framework') ?></li>
		</ol>
	
	</div>
	<!-- END .post -->

	<?php endif; ?>

</div>
<!-- END .grid-8 -->

<?php if ($aw_sidebar_position == 'right') get_sidebar(); ?>

<div class="clear"></div>	

<?php get_footer(); ?>