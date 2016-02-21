<?php

/* --

Plugin Name: News in pictures
Plugin URI: http://www.awesemthemes.com
Description: A widget that displays your news in pictures
Version: 1.0
Author: AWESEM
Author URI: http://www.awesemthemes.com

-- */

/* -- Add function to widgets_init that'll load our widget -- */
add_action( 'widgets_init', 'aw_newsinpictures_widgets' );

/* -- Register widget -- */
function aw_newsinpictures_widgets() { register_widget( 'AW_NEWSINPICTURES_Widget' ); }

/* -- Widget class -- */
class aw_newsinpictures_widget extends WP_Widget {

	/* -- Widget setup -- */
	function AW_NEWSINPICTURES_Widget() {
	
		/* -- Widget settings -- */
		$widget_ops = array( 'classname' => 'aw_newsinpictures_widget', 'description' => __('A widget that displays your news in pictures', 'framework') );

		/* -- Widget control settings -- */
		$control_ops = array( 'id_base' => 'aw_newsinpictures_widget' );

		/* -- Create the widget -- */
		$this->WP_Widget( 'aw_newsinpictures_widget', 'Deadline Responsive - '.__('News in pictures', 'framework'), $widget_ops, $control_ops );
	}

	/* -- Display widget -- */
	function widget( $args, $instance ) {
		extract( $args );

		/* -- Our variables from the widget settings -- */
		$title = apply_filters('widget_title', $instance['title'] );
		$autoplay = $instance['autoplay'];
		$animationduration = $instance['animationduration'];

		/* -- Before widget (defined by themes) -- */
		echo $before_widget;

		/* -- Display News in Pictures -- */
		
		$aw_news_in_pictures = new WP_Query();
		$aw_news_in_pictures->query('tag=newsinpictures&posts_per_page=16');
		?>
	
		<!-- BEGIN .container -->
		<div class="container">
		
			<?php if ( $title ) echo '<div class="grid-8">' . $before_title . $title . $after_title . '</div><div class="clear"></div>'; ?>
		
			<div id="news-images" class="grid-4">
					
				<?php while ($aw_news_in_pictures->have_posts()) : $aw_news_in_pictures->the_post(); ?>
				
				<!-- BEGIN .news-image -->
				<div class="news-image">
					
					<?php if((function_exists('has_post_thumbnail')) && (has_post_thumbnail())): ?>
					
					<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><?php the_post_thumbnail('news-in-pictures'); ?></a>
						
					<?php else : ?>
							
					<?php $format = get_post_format(); if($format == '') $format = 'standard'; ?>
					<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_assets/img/_thumbs/<?php echo $format; ?>-300x300.png" alt="" /></a>
					
					<?php endif; ?>
					
					<!-- BEGIN .news-meta -->
					<div class="news-meta" style="position: absolute; bottom: 20px; left: 0; display: block; padding: 10px 20px; width: 260px; background: #333;">
					
						<span class="news-title"><a href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><?php the_title(); ?></a></span>
						<span class="news-desc"><?php $date_format = get_option( 'date_format' ); the_time($date_format); echo ' &middot; '; comments_popup_link(__('No comments', 'framework'), __('1 comment', 'framework'), __('% comments', 'framework')); ?></span>
					
					</div>
					<!-- END .news-meta -->
					
				</div>
				<!-- END .news-image -->
					
				<?php endwhile; ?>
			
			</div>
			
			<div id="news-thumbs" class="grid-4">
					
				<?php while ($aw_news_in_pictures->have_posts()) : $aw_news_in_pictures->the_post(); ?>
							
					<?php if((function_exists('has_post_thumbnail')) && (has_post_thumbnail())): ?>
					
					<?php echo the_post_thumbnail('grid-1'); ?>
						
					<?php else : ?>
							
					<?php $format = get_post_format(); if($format == '') $format = 'standard'; ?>
					<img src="<?php echo get_template_directory_uri(); ?>/_assets/img/_thumbs/<?php echo $format; ?>-60x60.png" alt="" />
					
					<?php endif; ?>
			
				<?php endwhile; ?>
					
			</div>
			
			<div class="clear"></div>
				
		</div>
		<!-- END .container -->
		
		<script>
			jQuery(document).ready(function($) {
				$div = null;
				$('#news-thumbs').children().each(function(i) {
					if ( i % 16 == 0) {
						$div = $( '<div />' );
						$div.appendTo( '#news-thumbs' );
					}
					$(this).appendTo( $div );
					$(this).addClass( 'itm'+i );
					$(this).click(function() {
						$('#news-images').trigger( 'slideTo', [i, 0, true] );
					});
				});
				$('#news-thumbs img.itm0').addClass( 'selected' );
				$('#news-images').carouFredSel({
					height: 300,
					items: 1,
					scroll: {
						fx: 'crossfade',
						duration: <?php echo $animationduration; ?>,
						onBefore: function() {
							var pos = $(this).triggerHandler( 'currentPosition' );
							$('#news-thumbs img').removeClass( 'selected' );
							$('#news-thumbs img.itm'+pos).addClass( 'selected' );
						}
					},
					auto: {
						<?php if ($autoplay != '0') : ?>
						play: true,
						pauseDuration: <?php echo $autoplay; ?>
						<?php else : ?>
						play: false
						<?php endif; ?>
					}
				});
				$('#news-thumbs').carouFredSel({
					height: 300,
					items: 1,
					align: false,
					auto: {
						<?php if ($autoplay != '0') : ?>
						play: true,
						pauseDuration: <?php echo $autoplay; ?>
						<?php else : ?>
						play: false
						<?php endif; ?>
					}
				});
			
			});
		</script>
					
		<?php
		
		wp_reset_postdata(); wp_reset_query();

		/* -- After widget (defined by themes) -- */
		echo $after_widget;
	}

	/* -- Update widget -- */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['autoplay'] = strip_tags( $new_instance['autoplay'] );
		$instance['animationduration'] = strip_tags( $new_instance['animationduration'] );
		return $instance;
	}
	
	/* -- Widget settings -- */
	function form( $instance ) {
		$defaults = array(
			'title' => 'News in Pictures',
			'autoplay' => '5000',
			'animationduration' => '1000'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
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
		
	<?php
	}
}
?>