<?php
header('HTTP/1.1 404 Not Found');
header('Status: 404 Not Found');
include( TEMPLATEPATH . '/_admin/get-options.php' );
get_header();
?>

<?php if ($aw_sidebar_position == 'left') get_sidebar(); ?>

<!-- BEGIN .grid-8 -->
<div class="grid-8">
	
	<!-- BEGIN .post -->
	<div class="post">
			
		<!-- BEGIN .entry-header -->
		<div class="entry-header">
			
			<h1><?php _e('Error 404 - Not Found', 'framework') ?></h1>
				
		</div>
		<!-- BEGIN .entry-header -->
		
		<!-- BEGIN .entry -->
		<div class="entry">
		
			<p><?php _e('Sorry, but you are looking for something that isn\'t here.', 'framework') ?></p>
					
		</div>
		<!-- END .entry -->

	</div>
	<!-- END .post -->
	
</div>
<!-- END .grid-8 -->

<?php if ($aw_sidebar_position == 'right') get_sidebar(); ?>

<div class="clear"></div>	

<?php get_footer(); ?>