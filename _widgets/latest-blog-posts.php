<?php

/* --

Plugin Name: Latest blog posts
Plugin URI: http://www.awesemthemes.com
Description: A widget that displays your latest posts
Version: 1.0
Author: AWESEM
Author URI: http://www.awesemthemes.com

-- */

/* -- Add function to widgets_init that'll load our widget -- */
add_action('widgets_init', 'aw_latestblogposts_widgets');

/* -- Register widget -- */
function aw_latestblogposts_widgets() { register_widget( 'AW_LATESTBLOGPOSTS_Widget' ); }

/* -- Widget class -- */
class aw_latestblogposts_widget extends WP_Widget {

	/* -- Widget setup -- */
	function AW_LATESTBLOGPOSTS_Widget() {
	
		/* -- Widget settings -- */
		$widget_ops = array( 'classname' => 'aw_latestblogposts_widget', 'description' => __('A widget that displays your latest posts', 'framework') );

		/* -- Widget control settings -- */
		$control_ops = array( 'id_base' => 'aw_latestblogposts_widget' );

		/* -- Create the widget -- */
		parent::__construct( 'aw_latestblogposts_widget', 'Deadline Responsive - '.__('Latest blog posts', 'framework'), $widget_ops, $control_ops );
	}

	/* -- Display widget -- */
	function widget( $args, $instance ) {
		extract( $args );

		/* -- Our variables from the widget settings -- */
		$title = apply_filters('widget_title', $instance['title'] );
		$offset = $instance['offset'];
		$exclude = $instance['exclude'];
		$exc = explode(',', $exclude);

		/* -- Before widget (defined by themes) -- */
		echo $before_widget;
		
		/* -- Display latest posts -- */
		?>
		
		<!-- BEGIN .container -->
		<div class="container">
		
		<?php if ( $title ) echo '<div class="grid-8">' . $before_title . $title . $after_title . '</div><div class="clear"></div>'; ?>
		
		<?php
		$aw_latest = new WP_Query();
		$aw_latest->query( array( 'posts_per_page' => 1, 'post__not_in' => $exc, 'offset' => $offset ) );
		if ($aw_latest->have_posts()) : while($aw_latest->have_posts()): $aw_latest->the_post();
		?>
			
			<!-- BEGIN .grid-4 -->
			<div class="grid-4 the-latest">
						
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
				
				<!-- BEGIN .post-title -->
				<div class="post-title">
				
					<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><h4><?php the_title(); ?></h4></a>
						
				</div>
				<!-- END .post-title -->
				
				<!-- BEGIN .post-meta -->
				<div class="post-meta">
				
					<p><?php $date_format = get_option( 'date_format' ); the_time($date_format); echo ' &middot; '; comments_popup_link(__('No comments', 'framework'), __('1 comment', 'framework'), __('% comments', 'framework')); ?></p>
						
				</div>
				<!-- END .post-meta -->
				
				<!-- BEGIN .post-excerpt -->
				<div class="post-excerpt">
				
					<?php the_excerpt(); ?>
						
				</div>
				<!-- END .post-excerpt -->
																		
			</div>
			<!-- END .grid-4 -->
				
		<?php endwhile; endif; wp_reset_query(); ?>
		
		<?php
		$aw_floated_thumb = new WP_Query();
		$aw_floated_thumb->query( array( 'posts_per_page' => 4, 'post__not_in' => $exc, 'offset' => $offset + 1 ) );
		if ($aw_floated_thumb->have_posts()) :
		?>
			
			<!-- BEGIN .grid-4 -->
			<div class="grid-4 floated-thumb">
			
			<?php while($aw_floated_thumb->have_posts()): $aw_floated_thumb->the_post(); ?>
			
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
			
			<?php endwhile; ?>
			
			</div>
			<!-- END .grid-4 -->
		
		<?php endif; wp_reset_query(); ?>
			
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
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['offset'] = $new_instance['offset'];
		$instance['exclude'] = strip_tags( $new_instance['exclude'] );
		return $instance;
	}
	
	/* -- Widget settings -- */
	function form( $instance ) {
		$defaults = array(
			'title' => 'Latest posts',
			'offset' => '0',
			'exclude' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
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
