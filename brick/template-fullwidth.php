<?php

/* --
	
	Template Name: Full width

-- */

get_header();
?>

<!-- BEGIN .grid-12 -->
<div class="grid-12">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<!-- BEGIN .post -->
	<div class="post" id="post-<?php the_ID(); ?>">
	
		<!-- BEGIN .entry-header -->
		<div class="entry-header">
			
			<h1><?php the_title(); ?></h1>
				
		</div>
		<!-- BEGIN .entry-header -->
			
		<?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) : ?>
		
		<!-- BEGIN .entry-thumb -->
		<div class="entry-thumb">
		
			<?php the_post_thumbnail('single-post-thumbnail'); ?>
			
		</div>
		<!-- END .entry-thumb -->
		
		<?php endif; ?>

		<!-- BEGIN .entry -->
		<div class="entry">
		
			<?php the_content(); wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'framework').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); edit_post_link(__('Edit this entry.', 'framework'), '<p>', '</p>'); ?>
		
		</div>
		<!-- END .entry -->
		
	</div>
	<!-- END .post -->
	
	<?php comments_template(); ?>
	<?php endwhile; endif; ?>

</div>
<!-- END .grid-12 -->

<div class="clear"></div>

<?php get_footer(); ?>