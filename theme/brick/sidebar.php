<!-- BEGIN #sidebar -->
<div id="sidebar" class="grid-4">

	<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar() ); ?>
	
	<!-- BEGIN .container -->
	<div class="container">
	
		<!-- BEGIN .grid-2 -->
		<div class="grid-2">
			
			<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Sidebar - Narrow 1') ); ?>
			
		</div>
		<!-- END .grid-2 -->
		
		<!-- BEGIN .grid-2 -->
		<div class="grid-2">
			
			<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Sidebar - Narrow 2') ); ?>
			
		</div>
		<!-- END .grid-2 -->
		
		<div class="clear"></div>
			
	</div>
	<!-- END .container -->

</div>
<!-- END #sidebar -->