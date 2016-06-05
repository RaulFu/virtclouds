<?php

/* --
	
	Template Name: Archives

-- */

include( TEMPLATEPATH . '/_admin/get-options.php' );
get_header();
?>

<?php if ($aw_sidebar_position == 'left') get_sidebar(); ?>

<!-- BEGIN .grid-8 -->
<div class="grid-8">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
	<!-- BEGIN .post -->
	<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					
		<!-- BEGIN .entry-header -->
		<div class="entry-header">
			
			<h1><?php the_title(); ?></h1>
				
		</div>
		<!-- BEGIN .entry-header -->
					
		<!-- BEGIN .entry -->
		<div class="entry">
		
			<?php the_content(); wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'framework').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); edit_post_link(__('Edit this entry.', 'framework'), '<p>', '</p>'); ?>
		
		</div>
		<!-- END .entry -->
					
		<!-- BEGIN .archive-lists -->
		<div class="archive-lists">
			
			<h4><?php _e('Last 30 posts', 'framework') ?></h4>
			
			<ul>
			<?php $archive_30 = get_posts('numberposts=30');
			foreach($archive_30 as $post) : ?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
			<?php endforeach; ?>
			</ul>
			
			<h4><?php _e('Archives by month', 'framework') ?></h4>
			
			<ul>
				<?php wp_get_archives('type=monthly'); ?>
			</ul>
	
			<h4><?php _e('Archives by category', 'framework') ?></h4>
			
			<ul>
		 		<?php wp_list_categories( 'title_li=' ); ?>
			</ul>

		</div>
		<!-- END .archive-lists -->
                  
	</div>
	<!-- END .post -->
				
<?php endwhile; endif; ?>
				

</div>
<!-- END .grid-8 -->

<?php if ($aw_sidebar_position == 'right') get_sidebar(); ?>

<div class="clear"></div>	

<?php get_footer(); ?>