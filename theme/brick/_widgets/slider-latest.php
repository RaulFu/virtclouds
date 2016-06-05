<?php

/* --

Plugin Name: Slider latest
Plugin URI: http://www.awesemthemes.com
Description: A widget that displays your latest posts in a slider
Version: 1.0
Author: AWESEM
Author URI: http://www.awesemthemes.com

-- */

/* -- Add function to widgets_init that'll load our widget -- */
add_action( 'widgets_init', 'aw_sliderlatest_widgets' );

/* -- Register widget -- */
function aw_sliderlatest_widgets() { register_widget( 'AW_SLIDERLATEST_Widget' ); }

/* -- Widget class -- */
class aw_sliderlatest_widget extends WP_Widget {

	/* -- Widget setup -- */
	function AW_SLIDERLATEST_Widget() {
		
		/* -- Widget settings -- */
		$widget_ops = array( 'classname' => 'aw_sliderlatest_widget', 'description' => __('A widget that displays your latest posts in a slider', 'framework') );

		/* -- Widget control settings -- */
		$control_ops = array( 'id_base' => 'aw_sliderlatest_widget' );

		/* -- Create the widget -- */
		$this->WP_Widget( 'aw_sliderlatest_widget', 'Deadline Responsive - '.__('Slider latest','framework'), $widget_ops, $control_ops );
	}

	/* -- Display widget -- */
	function widget( $args, $instance ) {
		extract( $args );

		/* -- Our variables from the widget settings -- */
		$effect = $instance['effect'];
		$autoplay = $instance['autoplay'];
		$animationduration = $instance['animationduration'];
		$controlnav = $instance['controlnav'];
		$keyboardnav = $instance['keyboardnav'];
		$mousewheel = $instance['mousewheel'];
		$randomize = $instance['randomize'];
		$caption = $instance['caption'];
		$number = $instance['number'];
		$offset = $instance['offset'];
		$exclude = $instance['exclude'];
		$exc = explode(',', $exclude);

		/* -- Before widget (defined by themes) -- */
		echo $before_widget;

		/* -- Display slider -- */	
		?>

		<!-- BEGIN .slider-wrap -->
		<div class="slider-wrap wrap-<?php echo $args['widget_id']; ?>">
	
			<!-- BEGIN #slider -->
			<div id="slider-<?php echo $args['widget_id']; ?>" class="flexslider">
				
				<!-- BEGIN .slides -->
				<ul class="slides">
	
					<?php
					$aw_slider = new WP_Query();
					$aw_slider->query( array( 'caller_get_posts' => 1, 'orderby' => date, 'showposts' => $number, 'post__not_in' => $exc, 'offset' => $offset ) );
					if($aw_slider->have_posts()): while ($aw_slider->have_posts()) : $aw_slider->the_post();
					$format = get_post_format(); if($format == '') $format = 'standard';
					?>
				
					<!-- BEGIN .slider-item -->
					<li class="slider-item">
						
						<?php if((function_exists('has_post_thumbnail')) && (has_post_thumbnail())): ?>
						
						<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><?php the_post_thumbnail('slider-image-blog'); ?></a>
						
						<?php else : ?>
								
						<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_assets/img/_thumbs/<?php echo $format; ?>-730x365.png" alt="" /></a>
						
						<?php endif; ?>
						
						<div class="slider-caption">
							<div class="slider-caption-wrap">
								<p class="slider-caption-title"><?php the_title(); ?></p>
								<?php the_excerpt(); ?>
								<p class="slider-caption-link"><a href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><?php _e('Read the rest of this entry', 'framework'); ?></a></p>
							</div>
						</div>
							
					</li>
					<!-- END .slider-item -->
					
					<?php endwhile;	wp_reset_postdata(); endif;	wp_reset_query(); ?>
				
				</ul>
				<!-- END .slides -->
								
			</div>
			<!-- END #slider -->
		
		</div>
		<!-- END .slider-wrap -->
		
		<script>
			jQuery(document).ready(function($){
				$("#slider-<?php echo $args['widget_id']; ?>").flexslider({
					animation: '<?php echo $effect; ?>',
					<?php if ($autoplay != '0') : ?>
					slideshow: true,
					slideshowSpeed: <?php echo $autoplay; ?>,
					<?php else : ?>
					slideshow: false,
					<?php endif; ?>
					animationDuration: <?php echo $animationduration; ?>,
					directionNav: false,
					<?php if ($controlnav == 'on') : ?>
					controlNav: true,
					<?php else : ?>
					controlNav: false,
					<?php endif; ?>
					<?php if ($keyboardnav == 'on') : ?>
					keyboardNav: true,
					<?php else : ?>
					keyboardNav: false,
					<?php endif; ?>
					<?php if ($mousewheel == 'on') : ?>
					mousewheel: true,
					<?php else : ?>
					mousewheel: false,
					<?php endif; ?>
					<?php if ($randomize == 'on') : ?>
					randomize: true,
					<?php else : ?>
					randomize: false,
					<?php endif; ?>
					controlsContainer: '.wrap-<?php echo $args['widget_id']; ?>'
				});
				<?php if ($caption == 'on') : ?>
				$('#<?php echo $args['widget_id']; ?> .slider-caption').css('display', 'none');
				$('#<?php echo $args['widget_id']; ?>').hover(function() {
			        $('#<?php echo $args['widget_id']; ?> .slider-caption').stop().fadeIn('fast')
			    }, function() {
			        $('#<?php echo $args['widget_id']; ?> .slider-caption').stop().fadeOut('fast')
			    });
			    <?php endif; ?>
			});
		</script>
		
		<?php 

		/* -- After widget (defined by themes) -- */
		echo $after_widget;
	}

	/* -- Update widget -- */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['effect'] = strip_tags( $new_instance['effect'] );
		$instance['autoplay'] = strip_tags( $new_instance['autoplay'] );
		$instance['animationduration'] = strip_tags( $new_instance['animationduration'] );
		$instance['controlnav'] = $new_instance['controlnav'];
		$instance['keyboardnav'] = $new_instance['keyboardnav'];
		$instance['mousewheel'] = $new_instance['mousewheel'];
		$instance['randomize'] = $new_instance['randomize'];
		$instance['caption'] = $new_instance['caption'];
		$instance['number'] = $new_instance['number'];
		$instance['offset'] = $new_instance['offset'];
		$instance['exclude'] = strip_tags( $new_instance['exclude'] );
		return $instance;
	}
	
	/* -- Widget settings -- */
	function form( $instance ) {
		$defaults = array(
			'effect' => 'slide',
			'autoplay' => '5000',
			'animationduration' => '500',
			'controlnav' => 'on',
			'keyboardnav' => 'on',
			'mousewheel' => '',
			'randomize' => '',
			'caption' => '',
			'number' => '5',
			'offset' => '0',
			'exclude' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Effect -->
		<p>
			<label for="<?php echo $this->get_field_id( 'effect' ); ?>"><?php _e('Effect:', 'framework') ?></label>
			<select id="<?php echo $this->get_field_id( 'effect' ); ?>" name="<?php echo $this->get_field_name( 'effect' ); ?>" class="widefat">
				<option <?php if ( 'slide' == $instance['effect'] ) echo 'selected="selected"'; ?>>slide</option>
				<option <?php if ( 'fade' == $instance['effect'] ) echo 'selected="selected"'; ?>>fade</option>
			</select>
		</p>
		
		<!-- Autoplay -->
		<p>
			<label for="<?php echo $this->get_field_id( 'autoplay' ); ?>"><?php _e('Autoplay:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'autoplay' ); ?>" name="<?php echo $this->get_field_name( 'autoplay' ); ?>" value="<?php echo $instance['autoplay']; ?>" />
		</p>
		
		<!-- Animation duration -->
		<p>
			<label for="<?php echo $this->get_field_id( 'animationduration' ); ?>"><?php _e('Animation duration:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'animationduration' ); ?>" name="<?php echo $this->get_field_name( 'animationduration' ); ?>" value="<?php echo $instance['animationduration']; ?>" />
		</p>
		
		<!-- Control navigation -->
		<p>
			<label for="<?php echo $this->get_field_id( 'controlnav' ); ?>"><?php _e('Enable paging control navigation:', 'framework') ?></label>
			<input type="checkbox" class="checkbox" <?php checked( $instance['controlnav'], 'on' ); ?> id="<?php echo $this->get_field_id( 'controlnav' ); ?>" name="<?php echo $this->get_field_name( 'controlnav' ); ?>" />
		</p>
		
		<!-- Keyboard navigation -->
		<p>
			<label for="<?php echo $this->get_field_id( 'keyboardnav' ); ?>"><?php _e('Enable keyboard:', 'framework') ?></label>
			<input type="checkbox" class="checkbox" <?php checked( $instance['keyboardnav'], 'on' ); ?> id="<?php echo $this->get_field_id( 'keyboardnav' ); ?>" name="<?php echo $this->get_field_name( 'keyboardnav' ); ?>" />
		</p>
		
		<!-- Mousewheel navigation -->
		<p>
			<label for="<?php echo $this->get_field_id( 'mousewheel' ); ?>"><?php _e('Enable mousewheel:', 'framework') ?></label>
			<input type="checkbox" class="checkbox" <?php checked( $instance['mousewheel'], 'on' ); ?> id="<?php echo $this->get_field_id( 'mousewheel' ); ?>" name="<?php echo $this->get_field_name( 'mousewheel' ); ?>" />
		</p>
		
		<!-- Randomise -->
		<p>
			<label for="<?php echo $this->get_field_id( 'randomize' ); ?>"><?php _e('Enable randomisation:', 'framework') ?></label>
			<input type="checkbox" class="checkbox" <?php checked( $instance['randomize'], 'on' ); ?> id="<?php echo $this->get_field_id( 'randomize' ); ?>" name="<?php echo $this->get_field_name( 'randomize' ); ?>" />
		</p>
		
		<!-- Caption -->
		<p>
			<label for="<?php echo $this->get_field_id( 'caption' ); ?>"><?php _e('Autohide caption:', 'framework') ?></label>
			<input type="checkbox" class="checkbox" <?php checked( $instance['caption'], 'on' ); ?> id="<?php echo $this->get_field_id( 'caption' ); ?>" name="<?php echo $this->get_field_name( 'caption' ); ?>" />
		</p>
		
		<!-- Number -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Number of posts:', 'framework') ?></label>
			<select id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" class="widefat">
				<option <?php if ( '2' == $instance['number'] ) echo 'selected="selected"'; ?>>2</option>
				<option <?php if ( '3' == $instance['number'] ) echo 'selected="selected"'; ?>>3</option>
				<option <?php if ( '4' == $instance['number'] ) echo 'selected="selected"'; ?>>4</option>
				<option <?php if ( '5' == $instance['number'] ) echo 'selected="selected"'; ?>>5</option>
				<option <?php if ( '6' == $instance['number'] ) echo 'selected="selected"'; ?>>6</option>
				<option <?php if ( '7' == $instance['number'] ) echo 'selected="selected"'; ?>>7</option>
				<option <?php if ( '8' == $instance['number'] ) echo 'selected="selected"'; ?>>8</option>
				<option <?php if ( '9' == $instance['number'] ) echo 'selected="selected"'; ?>>9</option>
				<option <?php if ( '10' == $instance['number'] ) echo 'selected="selected"'; ?>>10</option>
			</select>
		</p>
		
		<!-- Offset -->
		<p>
			<label for="<?php echo $this->get_field_id( 'offset' ); ?>"><?php _e('Number of posts to pass over:', 'framework') ?></label>
			<select id="<?php echo $this->get_field_id( 'offset' ); ?>" name="<?php echo $this->get_field_name( 'offset' ); ?>" class="widefat">
				<option <?php if ( '0' == $instance['offset'] ) echo 'selected="selected"'; ?>>0</option>
				<option <?php if ( '1' == $instance['offset'] ) echo 'selected="selected"'; ?>>1</option>
				<option <?php if ( '2' == $instance['offset'] ) echo 'selected="selected"'; ?>>2</option>
				<option <?php if ( '3' == $instance['offset'] ) echo 'selected="selected"'; ?>>3</option>
				<option <?php if ( '4' == $instance['offset'] ) echo 'selected="selected"'; ?>>4</option>
				<option <?php if ( '5' == $instance['offset'] ) echo 'selected="selected"'; ?>>5</option>
				<option <?php if ( '6' == $instance['offset'] ) echo 'selected="selected"'; ?>>6</option>
				<option <?php if ( '7' == $instance['offset'] ) echo 'selected="selected"'; ?>>7</option>
				<option <?php if ( '8' == $instance['offset'] ) echo 'selected="selected"'; ?>>8</option>
				<option <?php if ( '9' == $instance['offset'] ) echo 'selected="selected"'; ?>>9</option>
				<option <?php if ( '10' == $instance['offset'] ) echo 'selected="selected"'; ?>>10</option>
			</select>
		</p>
		
		<!-- Exclude post -->
		<p>
			<label for="<?php echo $this->get_field_id( 'exclude' ); ?>"><?php _e('Exclude:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'exclude' ); ?>" name="<?php echo $this->get_field_name( 'exclude' ); ?>" value="<?php echo $instance['exclude']; ?>" />
		</p>
		
	<?php
	}
}
?>