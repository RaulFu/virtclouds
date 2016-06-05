<?php

/* --

Plugin Name: 120x240 Ad
Plugin URI: http://www.awesemthemes.com
Description: A widget that allows the display and configuration of a 120x240 Ad
Version: 1.0
Author: AWESEM
Author URI: http://www.awesemthemes.com

-- */

/* -- Add function to widgets_init that'll load our widget -- */
add_action( 'widgets_init', 'aw_ad120x240_widgets' );

/* -- Register widget -- */ 
function aw_ad120x240_widgets() { register_widget( 'AW_AD120X240_Widget' ); }
function load_ad_js_120x240(){
	wp_register_script( 'ad_js', get_template_directory_uri() . '/_widgets/ad.js', false);
	wp_enqueue_script( 'ad_js' );
}
add_action('admin_enqueue_scripts', 'load_ad_js_120x240');

/* -- Widget class -- */
class aw_ad120x240_widget extends WP_Widget {

	/* -- Widget setup -- */
	function AW_AD120X240_Widget() {
	
		/* -- Widget settings -- */
		$widget_ops = array( 'classname' => 'aw_ad120x240_widget', 'description' => __('A widget that allows the display and configuration of a 120x240 Ad', 'framework') );

		/* -- Widget control settings -- */
		$control_ops = array( 'id_base' => 'aw_ad120x240_widget' );

		/* -- Create the widget -- */
		$this->WP_Widget( 'aw_ad120x240_widget', 'Deadline Responsive - '.__('120x240 Ad', 'framework'), $widget_ops, $control_ops );
	}

	/* -- Display widget -- */
	function widget( $args, $instance ) {
		extract( $args );

		/* -- Our variables from the widget settings -- */
		$title = apply_filters('widget_title', $instance['title'] );
		$ad = $instance['ad'];
		$link = $instance['link'];
		$custom_text = stripslashes($instance['custom_text']);
		$ad_type = $instance['ad_type'];

		/* -- Before widget (defined by themes) -- */
		echo $before_widget;

		/* -- Display the widget title if one was input (before and after defined by themes) -- */
		if ( $title )
			echo $before_title . $title . $after_title;
			
		/* -- Display Ad -- */
		if ( $ad_type == 1 ) {
			if ( $link )
				echo '<a href="' . $link . '"><img src="' . $ad . '" alt="" /></a>';
			
			elseif ( $ad )
			 	echo '<img src="' . $ad . '" alt="" />';
		
		} elseif ( $ad_type == 2 ) {		
			echo  $custom_text;			
		}
		
		/* -- After widget (defined by themes) -- */
		echo $after_widget;
	}

	/* -- Update widget -- */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['ad'] = $new_instance['ad'];
		$instance['link'] = $new_instance['link'];
		$instance['custom_text'] = addslashes($new_instance['custom_text']);
		$instance['ad_type'] = $new_instance['ad_type'];	
		return $instance;
	}
	
	/* -- Widget Settings -- */
	function form( $instance ) {
		$defaults = array(
			'title' => '',
			'ad' => "http://cdn.awesem.com/images/120x240.png",
			'link' => 'http://www.awesemthemes.com',
			'custom_text' => '',
			'ad_type' => '1'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<!-- Ad type -->
		<p>
			<label for="<?php echo $this->get_field_id( 'ad_type' ); ?>"><?php _e('Select Ad type:', 'framework') ?></label>
			<select id="<?php echo $this->get_field_id( 'ad_type' ); ?>" onchange="check_status('<?php echo $this->get_field_id( "ad_type" ); ?>');" name="<?php echo $this->get_field_name( 'ad_type' ); ?>" class="ad-type  widefat" style="width: 235px;">
				<option value="1" <?php if($instance['ad_type'] == 1 || $new_instance['ad_type'] == '1') { ?> selected="selected" <?php } ?>><?php _e('Image', 'framework'); ?></option>
				<option value="2" <?php if($instance['ad_type'] == 2 || $new_instance['ad_type'] == '1') { ?> selected="selected" <?php } ?>><?php _e('Custom ad code', 'framework'); ?></option>
			</select>
		</p>
		
		
		<div <?php if($instance['ad_type'] == 2) { ?>  style="display:none;" <?php } ?> id="type-image">
		
			<!-- Ad image URL -->
			<p>
				<label for="<?php echo $this->get_field_id( 'ad' ); ?>"><?php _e('Ad image URL:', 'framework') ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'ad' ); ?>" name="<?php echo $this->get_field_name( 'ad' ); ?>" value="<?php echo $instance['ad']; ?>" />
			</p>
			
			<!-- Ad link URL -->
			<p>
				<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e('Ad link URL:', 'framework') ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" />
			</p>
			
		</div>
		
		<div <?php if($instance['ad_type'] == 1) { ?> style="display:none;" <?php } ?> id="type-custom-text">
		
			<!-- Ad custom code --> 
			<p>
				<label for="<?php echo $this->get_field_id( 'custom_text' ); ?>"><?php _e('Ad custom code:', 'framework') ?></label>
				<textarea rows="5" cols="40" class="widefat" id="<?php echo $this->get_field_id( 'custom_text' ); ?>" name="<?php echo $this->get_field_name( 'custom_text' ); ?>"><?php echo stripslashes($instance['custom_text']); ?></textarea>
			</p>
		
		</div>
	<?php
	}
}
?>