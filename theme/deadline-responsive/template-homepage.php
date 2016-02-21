<?php

/* -- 

	Template Name: Homepage
	
-- */

include( TEMPLATEPATH . '/_admin/get-options.php' );
get_header();
?>

<?php if ($aw_sidebar_position == 'left') get_sidebar(); ?>

<!-- BEGIN .grid-8 -->
<div class="grid-8">

	<!-- BEGIN .container -->
	<div class="container">
	
		<!-- BEGIN .grid-8 -->
		<div id="widgets-homepage-fullwidth" class="grid-8">
	
			<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Homepage - Full width') ); ?>
			<div class="clear"></div>
		
		</div>
		<!-- END .grid-8 -->
		
		<div class="clear"></div>
		
		<!-- BEGIN .grid-4 -->
		<div class="grid-4">
			
			<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Homepage - Narrow 1') ); ?>
			
		</div>
		<!-- END .grid-4 -->
		
		<!-- BEGIN .grid-4 -->
		<div class="grid-4">
			
			<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Homepage - Narrow 2') ); ?>
			
		</div>
		<!-- END .grid-4 -->
		
		<div class="clear"></div>
	
	</div>
	<!-- END .container -->

</div>
<!-- END .grid-8 -->

<?php if ($aw_sidebar_position == 'right') get_sidebar(); ?>

<div class="clear"></div>

<?php get_footer(); ?>