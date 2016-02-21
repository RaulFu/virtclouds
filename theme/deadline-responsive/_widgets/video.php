<?php
/* --

Plugin Name: Video
Plugin URI: http://www.awesemthemes.com
Description: A widget that displays a single video
Version: 1.0
Author: AWESEM
Author URI: http://www.awesemthemes.com

-- */

/* -- Add function to widgets_init that'll load our widget -- */
add_action( 'widgets_init', 'aw_video_widgets' );

/* -- Register widget -- */
function aw_video_widgets() { register_widget( 'AW_VIDEO_Widget' ); }

/* -- Widget class -- */
class aw_video_widget extends WP_Widget {

	/* -- Widget setup -- */
	function AW_VIDEO_Widget() {
	
		/* -- Widget settings -- */
		$widget_ops = array( 'classname' => 'aw_video_widget', 'description' => __('A widget that displays a single video', 'framework') );

		/* -- Widget control settings -- */
		$control_ops = array( 'id_base' => 'aw_video_widget' );

		/* -- Create the widget -- */
		$this->WP_Widget( 'aw_video_widget', 'Deadline Responsive - '.__('Video', 'framework'), $widget_ops, $control_ops );
	}

	/* -- Display widget -- */
	function widget( $args, $instance ) {
		extract( $args );

		/* -- Our variables from the widget settings -- */
		$title = apply_filters('widget_title', $instance['title'] );
		$embed = $instance['embed'];
		$desc = $instance['desc'];

		/* -- Before widget (defined by themes) -- */
		echo $before_widget;

		/* -- Display the widget title if one was input (before and after defined by themes) -- */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* -- Display video -- */
		?>
			
			<div class="entry-video"><?php echo $embed; ?></div>
			<p class="description"><?php echo $desc; ?></p>
		
		<?php

		/* -- After widget (defined by themes) -- */
		echo $after_widget;
	}

	/* -- Update widget -- */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['desc'] = stripslashes( $new_instance['desc']);
		$instance['embed'] = stripslashes( $new_instance['embed']);
		return $instance;
	}
	
	/* -- Widget settings -- */
	function form( $instance ) {
		$defaults = array(
			'title' => 'My video',
			'embed' => stripslashes('<iframe src="http://player.vimeo.com/video/1084537?title=0&amp;byline=0&amp;portrait=0" width="300" height="169"></iframe>'),
			'desc' => 'Big Buck Bunny by Blender Foundation'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<!-- Embed code -->
		<p>
			<label for="<?php echo $this->get_field_id( 'embed' ); ?>"><?php _e('Embed code:', 'framework') ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'embed' ); ?>" name="<?php echo $this->get_field_name( 'embed' ); ?>"><?php echo stripslashes(htmlspecialchars(( $instance['embed'] ), ENT_QUOTES)); ?></textarea>
		</p>
		
		<!-- Description -->
		<p>
			<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Description:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['desc'] ), ENT_QUOTES)); ?>" />
		</p>
		
	<?php
	}
}
?>