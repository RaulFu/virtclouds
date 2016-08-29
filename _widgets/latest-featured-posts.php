<?php

/* --

Plugin Name: Latest & Featured posts
Plugin URI: http://www.awesemthemes.com
Description: A widget that displays your latest and featured posts
Version: 1.0
Author: AWESEM
Author URI: http://www.awesemthemes.com

-- */

/* -- Add function to widgets_init that'll load our widget -- */
add_action('widgets_init', 'aw_latestfeaturedposts_widgets');

/* -- Register widget -- */
function aw_latestfeaturedposts_widgets() { register_widget( 'AW_LATESTFEATUREDPOSTS_Widget' ); }

/* -- Widget class -- */
class aw_latestfeaturedposts_widget extends WP_Widget {

	/* -- Widget setup -- */
	function AW_LATESTFEATUREDPOSTS_Widget() {
	
		/* -- Widget settings -- */
		$widget_ops = array( 'classname' => 'aw_latestfeaturedposts_widget', 'description' => __('A widget that displays your latest and featured posts', 'framework') );

		/* -- Widget control settings -- */
		$control_ops = array( 'id_base' => 'aw_latestfeaturedposts_widget' );

		/* -- Create the widget -- */
		parent::__construct( 'aw_latestfeaturedposts_widget', 'Deadline Responsive - '.__('Latest & Featured posts', 'framework'), $widget_ops, $control_ops );
	}

	/* -- Display widget -- */
	function widget( $args, $instance ) {
		extract( $args );

		/* -- Our variables from the widget settings -- */
		$latesttitle = $instance['latesttitle'];
		$featuredtitle = $instance['featuredtitle'];
		$number = $instance['number'];
		$offset = $instance['offset'];
		$exclude = $instance['exclude'];
		$exc = explode(',', $exclude);

		/* -- Before widget (defined by themes) -- */
		echo $before_widget;
		
		/* -- Display latest posts -- */
		?>
		
		<!-- BEGIN .container -->
		<div class="container">
		
			<!-- BEGIN .grid-4 -->
			<div class="grid-4">
			
				<h3 class="widget-title"><?php echo $latesttitle; ?></h3>
				
				<?php
				$aw_latest = new WP_Query();
				$aw_latest->query( array( 'posts_per_page' => $number, 'post__not_in' => $exc, 'offset' => $offset ) );
				$thumb = 0;
				if ($aw_latest->have_posts()) : while($aw_latest->have_posts()): $aw_latest->the_post();
				$thumb++;
				?>
				
				<?php if($thumb == 1): ?>
				
				<!-- BEGIN .the-latest -->
				<div class="the-latest">
				
					<?php if((function_exists('has_post_thumbnail')) && (has_post_thumbnail())): ?>
					
					<!-- BEGIN .post-thumb -->
					<div class="post-thumb">
							
						<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><?php the_post_thumbnail('slider-image-blog'); ?></a>
							
					</div>
					<!-- END .post-thumb -->
					
					<?php else : ?>
							
					<!-- BEGIN .post-thumb -->
					<div class="post-thumb">
						
						<?php $format = get_post_format(); if($format == '') $format = 'standard'; ?>
						<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_assets/img/_thumbs/<?php echo $format; ?>-730x365.png" alt="" /></a>
						
					</div>
					<!-- END .post-thumb -->
					
					<?php endif; ?>
					
				</div>
				<!-- END .the-latest -->
				
				<?php endif; ?>
				
				<!-- BEGIN .floated-thumb -->
				<div class="floated-thumb">
								
					<?php if((function_exists('has_post_thumbnail')) && (has_post_thumbnail())): ?>
						
					<!-- BEGIN .post-thumb -->
					<div class="post-thumb">
						
						<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><?php the_post_thumbnail('grid-1'); ?></a>
						
					</div>
					<!-- END .post-thumb -->
					
					<?php else : ?>
							
					<!-- BEGIN .post-thumb -->
					<div class="post-thumb">
						
						<?php $format = get_post_format(); if($format == '') $format = 'standard'; ?>
						<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_assets/img/_thumbs/<?php echo $format; ?>-60x60.png" alt="" /></a>
						
					</div>
					<!-- END .post-thumb -->
					
					<?php endif; ?>
					
					<!-- BEGIN .post-meta -->
					<div class="post-meta">
					
						<p><a class="meta-title" href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><?php the_title(); ?></a><br /><?php $date_format = get_option( 'date_format' ); the_time($date_format); echo ' &middot; '; comments_popup_link(__('No comments', 'framework'), __('1 comment', 'framework'), __('% comments', 'framework')); ?></p>
							
					</div>
					<!-- END .post-meta -->
					
					<div class="clear"></div>
								
				</div>
				<!-- END .floated-thumb -->
																	
				<?php endwhile; endif; wp_reset_query(); ?>
				
			</div>
			<!-- END .grid-4 -->
			
			<!-- BEGIN .grid-4 -->
			<div class="grid-4">
			
				<h3 class="widget-title"><?php echo $featuredtitle; ?></h3>
				
				<?php
				$aw_featured = new WP_Query();
				$aw_featured->query( array( 'posts_per_page' => $number, 'orderby' => date, 'meta_key' => '_featured_post', 'meta_value' => 'yes') );
				$thumb = 0;
				if ($aw_featured->have_posts()) : while($aw_featured->have_posts()): $aw_featured->the_post();
				$thumb++;
				?>
				
				<?php if($thumb == 1): ?>
				
				<!-- BEGIN .the-latest -->
				<div class="the-latest">
				
					<?php if((function_exists('has_post_thumbnail')) && (has_post_thumbnail())): ?>
					
					<!-- BEGIN .post-thumb -->
					<div class="post-thumb">
							
						<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><?php the_post_thumbnail('slider-image-blog'); ?></a>
							
					</div>
					<!-- END .post-thumb -->
					
					<?php else : ?>
							
					<!-- BEGIN .post-thumb -->
					<div class="post-thumb">
						
						<?php $format = get_post_format(); if($format == '') $format = 'standard'; ?>
						<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_assets/img/_thumbs/<?php echo $format; ?>-730x365.png" alt="" /></a>
						
					</div>
					<!-- END .post-thumb -->
					
					<?php endif; ?>
					
				</div>
				<!-- END .the-latest -->
				
				<?php endif; ?>
				
				<!-- BEGIN .floated-thumb -->
				<div class="floated-thumb">
								
					<?php if((function_exists('has_post_thumbnail')) && (has_post_thumbnail())): ?>
						
					<!-- BEGIN .post-thumb -->
					<div class="post-thumb">
						
						<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><?php the_post_thumbnail('grid-1'); ?></a>
						
					</div>
					<!-- END .post-thumb -->
					
					<?php else : ?>
							
					<!-- BEGIN .post-thumb -->
					<div class="post-thumb">
						
						<?php $format = get_post_format(); if($format == '') $format = 'standard'; ?>
						<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_assets/img/_thumbs/<?php echo $format; ?>-60x60.png" alt="" /></a>
						
					</div>
					<!-- END .post-thumb -->
					
					<?php endif; ?>
					
					<!-- BEGIN .post-meta -->
					<div class="post-meta">
					
						<p><a class="meta-title" href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><?php the_title(); ?></a><br /><?php $date_format = get_option( 'date_format' ); the_time($date_format); echo ' &middot; '; comments_popup_link(__('No comments', 'framework'), __('1 comment', 'framework'), __('% comments', 'framework')); ?></p>
							
					</div>
					<!-- END .post-meta -->
					
					<div class="clear"></div>
								
				</div>
				<!-- END .floated-thumb -->
																	
				<?php endwhile; endif; wp_reset_query(); ?>
				
			</div>
			<!-- END .grid-4 -->
			
			<div class="clear"></div>
					
		</div>
		<!-- END .container -->
					
		<?php

		/* -- After widget (defined by themes) -- */
		echo $after_widget;
	}

	/* -- Update widget -- */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['latesttitle'] = strip_tags( $new_instance['latesttitle'] );
		$instance['featuredtitle'] = strip_tags( $new_instance['featuredtitle'] );
		$instance['number'] = $new_instance['number'];
		$instance['offset'] = $new_instance['offset'];
		$instance['exclude'] = strip_tags( $new_instance['exclude'] );
		return $instance;
	}
	
	/* -- Widget settings -- */
	function form( $instance ) {
		$defaults = array(
			'latesttitle' => 'Latest posts',
			'featuredtitle' => 'Featured posts',
			'number' => '5',
			'offset' => '0',
			'exclude' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Latest posts title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'latesttitle' ); ?>"><?php _e('Latest posts - Title:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'latesttitle' ); ?>" name="<?php echo $this->get_field_name( 'latesttitle' ); ?>" value="<?php echo $instance['latesttitle']; ?>" />
		</p>
		
		<!-- Featured posts title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'featuredtitle' ); ?>"><?php _e('Featured posts - Title:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'featuredtitle' ); ?>" name="<?php echo $this->get_field_name( 'featuredtitle' ); ?>" value="<?php echo $instance['featuredtitle']; ?>" />
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