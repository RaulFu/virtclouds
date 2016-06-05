<?php 
include( TEMPLATEPATH . '/_admin/get-options.php' );
get_header();
?>

<?php if ($aw_sidebar_position == 'left') get_sidebar(); ?>

<!-- BEGIN .grid-8 -->
<div class="grid-8" id="archive">

	<?php if (have_posts()) : ?>

	<?php $post = $posts[0]; $offset = 1; ?>
	
	<?php
	if(get_query_var('author_name')) :
		$curauth = get_userdatabylogin(get_query_var('author_name'));
	else :
		$curauth = get_userdata(get_query_var('author'));
	endif;
	?>
	
	<!-- BEGIN .entry-header -->
	<div class="entry-header">
	
		<?php if (is_category()) { ?>
		<h1><?php printf(__('All posts in %s', 'framework'), single_cat_title('',false)); ?></h1>
		<?php } elseif( is_tag() ) { ?>
		<h1><?php printf(__('All posts tagged %s', 'framework'), single_tag_title('',false)); ?></h1>
	 	<?php } elseif (is_day()) { ?>
		<h1><?php _e('Archive for', 'framework') ?> <?php the_time('d/m/Y'); ?></h1>
	 	<?php } elseif (is_month()) { ?>
		<h1><?php _e('Archive for', 'framework') ?> <?php the_time('m/Y'); ?></h1>
	 	<?php } elseif (is_year()) { ?>
		<h1><?php _e('Archive for', 'framework') ?> <?php the_time('Y'); ?></h1>
		<?php } elseif (is_author()) { ?>
		<h1><?php _e('All posts by', 'framework') ?> <?php echo $curauth->display_name; ?></h1>
	 	<?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h1><?php _e('Blog archives', 'framework') ?></h1>
	 	<?php } ?>
 	
 	</div>
	<!-- END .entry-header -->	

	<?php while (have_posts()) : the_post(); ?>
		
	<?php if ($offset == 0) : ?>
	
	<!-- BEGIN .slider-wrap -->
	<div class="slider-wrap" id="sw-archive">

		<!-- BEGIN #slider -->
		<div id="slider-archive" class="flexslider">
			
			<!-- BEGIN .slides -->
			<ul class="slides">

				<!-- BEGIN .slider-item -->
				<li class="slider-item" style="display: block;">
										
					<?php if((function_exists('has_post_thumbnail')) && (has_post_thumbnail())): ?>
					
					<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><?php the_post_thumbnail('slider-image-blog'); ?></a>
					
					<?php else : ?>
							
					<?php $format = get_post_format(); if($format == '') $format = 'standard'; ?>
					<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_assets/img/_thumbs/<?php echo $format; ?>-730x365.png" alt="" /></a>
					
					<?php endif; ?>
					
					<div class="slider-caption">
						<div class="slider-caption-wrap">
							<p class="slider-caption-title"><?php the_title(); ?></p>
							<p class="post-meta"><?php $date_format = get_option( 'date_format' ); the_time($date_format); echo ' &middot; '; comments_popup_link(__('No comments', 'framework'), __('1 comment', 'framework'), __('% comments', 'framework')); ?></p>
							<?php the_excerpt(); ?>
							<p class="slider-caption-link"><a href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><?php _e('Read the rest of this entry', 'framework'); ?></a></p>
						</div>
					</div>
						
				</li>
				<!-- END .slider-item -->
							
			</ul>
			<!-- END .slides -->
							
		</div>
		<!-- END #slider -->
	
	</div>
	<!-- END .slider-wrap -->
	
	<script>
		$(document).ready(function(){
			$('#sw-archive .slider-caption').css('display', 'none');
			$('#sw-archive').hover(function() {
		        $('#sw-archive .slider-caption').stop().fadeIn('fast')
		    }, function() {
		        $('#sw-archive .slider-caption').stop().fadeOut('fast')
		    });
		});
	</script>
	
	<?php else : ?>
	
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
	
	<?php endif; $offset++; ?>

	<?php endwhile; endif; ?>
	
	<?php if (aw_show_posts_nav()) : ?>
		
	<!-- BEGIN .navigation -->
	<div class="navigation margin-20">
		
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
	
</div>
<!-- END .grid-8 -->

<?php if ($aw_sidebar_position == 'right') get_sidebar(); ?>

<div class="clear"></div>	

<?php get_footer(); ?>