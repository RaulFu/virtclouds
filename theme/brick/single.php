<?php 
include( TEMPLATEPATH . '/_admin/get-options.php' );
get_header();
?>

<?php if ($aw_sidebar_position == 'left') get_sidebar(); ?>

<!-- BEGIN .grid-8 -->
<div class="grid-8">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<?php
	$format = get_post_format();
	get_template_part( '_includes/'.$format );
	if($format == '') get_template_part( '_includes/standard' );
	?>
		
	<?php if ($aw_posts_bio == 'true') get_template_part( '_includes/author-bio' ); ?>
	
	<?php if ($aw_posts_related == 'true') get_template_part( '_includes/related-posts' ); ?>
			
	<?php comments_template(); ?>
	<?php endwhile; endif; ?>
	
	<?php if ( (get_adjacent_post(false, '', true)) || (get_adjacent_post(false, '', false)) ): ?>
			
	<!-- BEGIN .navigation -->
	<div class="navigation margin-20">
	
		<div class="alignleft"><?php previous_post_link('%link','&laquo; %title',true); ?></div>
		<div class="alignright"><?php next_post_link('%link','%title &raquo;',true); ?></div>
		<div class="clear"></div>

	</div>
	<!-- END .navigation -->
	
	<?php endif; ?>
	
</div>
<!-- END .grid-8 -->

<?php if ($aw_sidebar_position == 'right') get_sidebar(); ?>

<div class="clear"></div>	

<?php get_footer(); ?>