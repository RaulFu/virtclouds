<?php include( TEMPLATEPATH . '/_admin/get-options.php' ); ?>

<!-- BEGIN .entry-thumb -->
<div class="entry-thumb">
				
	<?php $aw_attachments = get_children(array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID')); ?>
	
	<?php if(count($aw_attachments) > 1): ?>
	
	<!-- BEGIN .slider-wrap -->
	<div class="slider-wrap">

		<!-- BEGIN #slider -->
		<div id="slider-<?php the_ID(); ?>" class="flexslider">
			
			<!-- BEGIN .slides -->
			<ul class="slides">
						
				<?php 
				foreach($aw_attachments as $att_id => $aw_attachment) :
				$aw_img_attachment = wp_get_attachment_url($aw_attachment->ID);
				if(get_post_thumbnail_id() != $aw_attachment->ID) :
				?>
				
				<!-- BEGIN .slider-item -->
				<li class="slider-item">
					
					<?php echo '<img src="'.$aw_img_attachment.'" alt="" />'; ?>
					
				</li>
				<!-- END .slider-item -->
				
				<?php else : ?>
				
				<!-- BEGIN .slider-item -->
				<li class="slider-item">
				
					<?php the_post_thumbnail('single-project-thumbnail'); ?>
					
				</li>
				<!-- END .slider-item -->
						
				<?php endif; endforeach; ?>
			
			</ul>
			<!-- END .slides -->
													
		</div>
		<!-- END #slider -->
	
	</div>
	<!-- END .slider-wrap -->
	
	<script>
		jQuery(document).ready(function($){
			$("#slider-<?php the_ID(); ?>").flexslider({
				animation: 'slide',
				<?php if ($aw_slider_autoplay != '0') : ?>
				slideshow: true,
				slideshowSpeed: <?php echo $aw_slider_autoplay; ?>,
				<?php else : ?>
				slideshow: false,
				<?php endif; ?>
				animationDuration: <?php echo $aw_slider_animation_duration; ?>,
				directionNav: <?php echo $aw_slider_directionnav_enable ?>,
				controlNav: <?php echo $aw_slider_controlnav_enable ?>,
				keyboardNav: <?php echo $aw_slider_keyboardnav_enable ?>,
				mousewheel: <?php echo $aw_slider_mousewheel_enable ?>,
				randomize: <?php echo $aw_slider_randomize_enable ?>,
				controlsContainer: '.slider-wrap',
				smoothHeight: true
			});
		    $('#post-<?php the_ID(); ?> .slider-wrap').hover(function() {
		        $('#post-<?php the_ID(); ?> .flex-direction-nav, #post-<?php the_ID(); ?> .slider-caption').stop().fadeIn('fast')
		    }, function() {
		        $('#post-<?php the_ID(); ?> .flex-direction-nav, #post-<?php the_ID(); ?> .slider-caption').stop().fadeOut('fast')
		    });
		    $('#post-<?php the_ID(); ?> .flex-direction-nav li:first-child').addClass('first-child');
		    $('#post-<?php the_ID(); ?> .flex-direction-nav li:last-child').addClass('last-child');
		});
	</script>
	
	<?php else : ?>
	
	<!-- BEGIN .portfolio-image -->
	<div class="portfolio-image">
	
		<?php the_post_thumbnail('single-project-thumbnail'); ?>
	
	<!-- END .portfolio-image -->
	</div>
	
	<?php endif; ?>
					
</div>
<!-- END .entry-thumb -->