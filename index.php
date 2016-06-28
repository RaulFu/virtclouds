<?php 
include( TEMPLATEPATH . '/_admin/get-options.php' );
get_header();
?>

<?php if ($aw_sidebar_position == 'left') get_sidebar(); ?>

<!-- BEGIN .grid-8 -->
<div class="grid-8">

	<?php
	if (have_posts()) : while (have_posts()) : the_post();
	?>
	
	<?php
	$format = get_post_format();
	get_template_part( '_includes/'.$format );
	if($format == '') get_template_part( '_includes/standard' );
	?>
	
	<?php endwhile; endif; wp_reset_postdata(); wp_reset_query(); ?>
	
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