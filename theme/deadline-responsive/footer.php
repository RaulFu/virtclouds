<?php include( TEMPLATEPATH . '/_admin/get-options.php' ); ?>

</div>
<!-- END #wrapper -->

<!-- BEGIN footer -->
<footer>

	<!-- BEGIN .container -->
	<div class="container">
		
		<!-- BEGIN .grid-4 -->
		<div class="grid-4">
			
			<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 1') ); ?>
			
		</div>
		<!-- END .grid-4 -->
		
		<!-- BEGIN .grid-4 -->
		<div class="grid-4">
			
			<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 2') ); ?>
			
		</div>
		<!-- END .grid-4 -->
		
		<!-- BEGIN .grid-4 -->
		<div class="grid-4">
			
			<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 3') ); ?>
			
		</div>
		<!-- END .grid-4 -->
		
		<div class="clear"></div>
	
	</div>
	<!-- END .container -->

	<!-- BEGIN #bottom -->
	<div id="bottom">
	
		<!-- BEGIN .container -->
		<div class="container">
	
			<p class="grid-6">&copy; <?php the_time( 'Y' ); ?> <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>. <?php _e('Powered by', 'framework') ?> <a href="http://wordpress.org/">WordPress</a>. <a href="http://www.awesem.com/deadline-responsive/">Deadline Responsive</a> <?php _e('by', 'framework') ?> <a href="http://www.awesemthemes.com">AWESEM</a>.</p>
			<div class="clear"></div>
						
		</div>
		<!-- END .container -->
		
	</div>
	<!-- END #bottom -->
	
</footer>
<!-- END footer -->


<?php if($aw_google_maps_key != '') : ?>
	<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $aw_google_maps_key; ?>"></script>
<?php endif; ?>
	
<?php wp_footer(); ?>

<?php if(($aw_analytics_code != '') && !is_user_logged_in()) echo stripslashes($aw_analytics_code); ?>



<div id="full-top">
	<a><img src="http://www.jobbole.com/wp-content/themes/jobboleblogv3/_assets/img/back-top.png" alt="返回顶部" title="返回顶部" border="0" width="20"></a>
</div>
<div id="full-btm">
	<a><img src="http://www.jobbole.com/wp-content/themes/jobboleblogv3/_assets/img/back-btm.png" alt="跳到底部" title="跳到底部" border="0" width="20"></a>
</div>
<script type="text/javascript">
jQuery('#full-btm').click(function(){
    jQuery('html, body').animate({scrollTop:jQuery(document).height()}, 'slow');
    return false;
});
jQuery('#full-top').click(function(){
    jQuery('html, body').animate({scrollTop:0}, 'slow');
    return false;
});

</script>
</body>
<!-- END body -->

</html>
<!-- END html -->