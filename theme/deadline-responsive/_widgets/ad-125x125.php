<?php

/* --

Plugin Name: 125x125 Ad
Plugin URI: http://www.awesemthemes.com
Description: A widget that allows the display and configuration of 6 125x125 Ads
Version: 1.0
Author: AWESEM
Author URI: http://www.awesemthemes.com

-- */

/* -- Add function to widgets_init that'll load our widget -- */
add_action( 'widgets_init', 'aw_ad125x125_widgets' );

/* -- Register widget -- */ 
function aw_ad125x125_widgets() { register_widget( 'AW_AD125X125_Widget' ); }
function load_ad_js_125x125(){
	wp_register_script( 'ad_js', get_template_directory_uri() . '/_widgets/ad.js', false);
	wp_enqueue_script( 'ad_js' );
}
add_action('admin_enqueue_scripts', 'load_ad_js_125x125');

/* -- Widget class -- */
class aw_ad125x125_widget extends WP_Widget {

	/* -- Widget setup -- */
	function AW_AD125X125_Widget() {
	
		/* -- Widget settings -- */
		$widget_ops = array( 'classname' => 'aw_ad125x125_widget', 'description' => __('A widget that allows the display and configuration of 6 125x125 Ads', 'framework') );

		/* -- Widget control settings -- */
		$control_ops = array( 'id_base' => 'aw_ad125x125_widget' );

		/* -- Create the widget -- */
		$this->WP_Widget( 'aw_ad125x125_widget', 'Deadline Responsive - '.__('125x125 Ads', 'framework'), $widget_ops, $control_ops );
	}

	/* -- Display widget -- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* -- Our variables from the widget settings -- */
		$title = apply_filters('widget_title', $instance['title'] );
		$ad1 = $instance['ad1'];
		$ad2 = $instance['ad2'];
		$ad3 = $instance['ad3'];
		$ad4 = $instance['ad4'];
		$ad5 = $instance['ad5'];
		$ad6 = $instance['ad6'];
		$link1 = $instance['link1'];
		$link2 = $instance['link2'];
		$link3 = $instance['link3'];
		$link4 = $instance['link4'];
		$link5 = $instance['link5'];
		$link6 = $instance['link6'];
		$custom_text_ad1 = stripslashes($instance['custom_text_ad1']);
		$custom_text_ad2 = stripslashes($instance['custom_text_ad2']);
		$custom_text_ad3 = stripslashes($instance['custom_text_ad3']);
		$custom_text_ad4 = stripslashes($instance['custom_text_ad4']);
		$custom_text_ad5 = stripslashes($instance['custom_text_ad5']);
		$custom_text_ad6 = stripslashes($instance['custom_text_ad6']);
		$ad_type = $instance['ad_type'];
		$randomize = $instance['random'];

		/* -- Before widget (defined by themes) -- */
		echo $before_widget;

		/* -- Display the widget title if one was input (before and after defined by themes) -- */
		if ( $title )
			echo $before_title . $title . $after_title;
			
		/* -- Display Ads -- */
		$ads = array();

		/* -- Display Ad 1 -- */
		if ( $ad_type == 1 ) {
			if ( $link1 )
				$ads[] = '<div class="ad125x125 ad-1"><a href="' . $link1 . '"><img src="' . $ad1 . '" alt="" /></a></div>';
				
			elseif ( $ad1 )
			 	$ads[] = '<div class="ad125x125 ad-1"><img src="' . $ad1 . '" alt="" /></div>';
		} else {
			$ads[] =  '<div class="ad125x125 ad-1">'.$custom_text_ad1.'</div>';	
		}
		
		/* -- Display Ad 2 -- */
		if ( $ad_type == 1 ) {
			if ( $link2 )
				$ads[] = '<div class="ad125x125 ad-2"><a href="' . $link2 . '"><img src="' . $ad2 . '" alt="" /></a></div>';
				
			elseif ( $ad2 )
			 	$ads[] = '<div class="ad125x125 ad-2"><img src="' . $ad2 . '" alt="" /></div>';
		} else {
			$ads[] = '<div class="ad125x125 ad-2">'.$custom_text_ad2.'</div>';	
		}
		
		/* -- Display Ad 3 -- */
		if ( $ad_type == 1 ) {
			if ( $link3 )
				$ads[] = '<div class="ad125x125 ad-3"><a href="' . $link3 . '"><img src="' . $ad3 . '" alt="" /></a></div>';
				
			elseif ( $ad3 )
			 	echo '<div class="ad125x125 ad-3"><img src="' . $ad3 . '" alt="" /></div>';
		} else {
			$ads[] = '<div class="ad125x125 ad-3">'.$custom_text_ad3.'</div>';	
		}
		
		/* -- Display Ad 4 -- */
		if ( $ad_type == 1 ) {
			if ( $link4 )
				$ads[] = '<div class="ad125x125 ad-4"><a href="' . $link4 . '"><img src="' . $ad4 . '" alt="" /></a></div>';
				
			elseif ( $ad4 )
			 	$ads[] = '<div class="ad125x125 ad-4"><img src="' . $ad4 . '" alt="" /></div>';
		} else {
			$ads[] = '<div class="ad125x125 ad-4">'.$custom_text_ad4.'</div>';
		}
			
		/* -- Display Ad 5 -- */
		if ( $ad_type == 1 ) {
			if ( $link5 )
				$ads[] = '<div class="ad125x125 ad-5"><a href="' . $link5 . '"><img src="' . $ad5 . '" alt="" /></a></div>';
				
			elseif ( $ad5 )
			 	$ads[] = '<div class="ad125x125 ad-5"><img src="' . $ad5 . '" alt="" /></div>';
		} else {
			$ads[] = '<div class="ad125x125 ad-5">'.$custom_text_ad5."</div>";
		}
			
		/* -- Display Ad 6 -- */
		if ( $ad_type == 1 ) {
			if ( $link6 )
				$ads[] = '<div class="ad125x125 ad-6"><a href="' . $link6 . '"><img src="' . $ad6 . '" alt="" /></a></div>';
				
			elseif ( $ad6 )
			 	$ads[] = '<div class="ad125x125 ad-6"><img src="' . $ad6 . '" alt="" /></div>';
		} else {
			$ads[] = '<div class="ad125x125 ad-6">'.$custom_text_ad6.'</div>';
		}
		
		if ($randomize) shuffle($ads);
		
		foreach($ads as $ad){
			echo $ad;
		}
		
		/* -- After widget (defined by themes) -- */
		echo '<div class="clear"></div>'.$after_widget;
	}

	/* -- Update widget -- */
	function update( $new_instance, $old_instance ) {
		print_r($new_instance);
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['ad1'] = $new_instance['ad1'];
		$instance['ad2'] = $new_instance['ad2'];
		$instance['ad3'] = $new_instance['ad3'];
		$instance['ad4'] = $new_instance['ad4'];
		$instance['ad5'] = $new_instance['ad5'];
		$instance['ad6'] = $new_instance['ad6'];
		$instance['link1'] = $new_instance['link1'];
		$instance['link2'] = $new_instance['link2'];
		$instance['link3'] = $new_instance['link3'];
		$instance['link4'] = $new_instance['link4'];
		$instance['link5'] = $new_instance['link5'];
		$instance['link6'] = $new_instance['link6'];		
		$instance['custom_text_ad1'] = addslashes($new_instance['custom_text_ad1']);
		$instance['custom_text_ad2'] = addslashes($new_instance['custom_text_ad2']);
		$instance['custom_text_ad3'] = addslashes($new_instance['custom_text_ad3']);
		$instance['custom_text_ad4'] = addslashes($new_instance['custom_text_ad4']);
		$instance['custom_text_ad5'] = addslashes($new_instance['custom_text_ad5']);
		$instance['custom_text_ad6'] = addslashes($new_instance['custom_text_ad6']);
		$instance['ad_type'] = $new_instance['ad_type'];	
		$instance['random'] = $new_instance['random'];
		return $instance;
	}
	
	/* -- Widget settings -- */
	function form( $instance ) {
		$defaults = array(
			'title' => '',
			'ad1' => "http://cdn.awesem.com/images/125x125.png",
			'link1' => 'http://www.awesemthemes.com',
			'custom_text_ad1' => '',
			'ad2' => "http://cdn.awesem.com/images/125x125.png",
			'link2' => 'http://www.awesemthemes.com',
			'custom_text_ad2' => '',
			'ad3' => 'http://cdn.awesem.com/images/125x125.png',
			'link3' => 'http://www.awesemthemes.com',
			'custom_text_ad3' => '',
			'ad4' => 'http://cdn.awesem.com/images/125x125.png',
			'link4' => 'http://www.awesemthemes.com',
			'custom_text_ad4' => '',
			'ad5' => 'http://cdn.awesem.com/images/125x125.png',
			'link5' => 'http://www.awesemthemes.com',
			'custom_text_ad5' => '',
			'ad6' => 'http://cdn.awesem.com/images/125x125.png',
			'link6' => 'http://www.awesemthemes.com',
			'custom_text_ad6' => '',
			'ad_type' => '1',
			'random' => false
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
		
			<!-- Ad 1 image URL -->
			<p>
				<label for="<?php echo $this->get_field_id( 'ad1' ); ?>"><?php _e('Ad 1 image URL:', 'framework') ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'ad1' ); ?>" name="<?php echo $this->get_field_name( 'ad1' ); ?>" value="<?php echo $instance['ad1']; ?>" />
			</p>
			
			<!-- Ad 1 link URL -->
			<p>
				<label for="<?php echo $this->get_field_id( 'link1' ); ?>"><?php _e('Ad 1 link url:', 'framework') ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link1' ); ?>" name="<?php echo $this->get_field_name( 'link1' ); ?>" value="<?php echo $instance['link1']; ?>" />
			</p>
			
			<!-- Ad 2 image URL -->
			<p>
				<label for="<?php echo $this->get_field_id( 'ad2' ); ?>"><?php _e('Ad 2 image url:', 'framework') ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'ad2' ); ?>" name="<?php echo $this->get_field_name( 'ad2' ); ?>" value="<?php echo $instance['ad2']; ?>" />
			</p>
			
			<!-- Ad 2 link URL -->
			<p>
				<label for="<?php echo $this->get_field_id( 'link2' ); ?>"><?php _e('Ad 2 link url:', 'framework') ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link2' ); ?>" name="<?php echo $this->get_field_name( 'link2' ); ?>" value="<?php echo $instance['link2']; ?>" />
			</p>
			
			<!-- Ad 3 image URL -->
			<p>
				<label for="<?php echo $this->get_field_id( 'ad3' ); ?>"><?php _e('Ad 3 image url:', 'framework') ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'ad3' ); ?>" name="<?php echo $this->get_field_name( 'ad3' ); ?>" value="<?php echo $instance['ad3']; ?>" />
			</p>
			
			<!-- Ad 3 link URL -->
			<p>
				<label for="<?php echo $this->get_field_id( 'link3' ); ?>"><?php _e('Ad 3 link url:', 'framework') ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link3' ); ?>" name="<?php echo $this->get_field_name( 'link3' ); ?>" value="<?php echo $instance['link3']; ?>" />
			</p>
			
			<!-- Ad 4 image URL -->
			<p>
				<label for="<?php echo $this->get_field_id( 'ad4' ); ?>"><?php _e('Ad 4 image url:', 'framework') ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'ad4' ); ?>" name="<?php echo $this->get_field_name( 'ad4' ); ?>" value="<?php echo $instance['ad4']; ?>" />
			</p>
			
			<!-- Ad 4 link URL: Text Input -->
			<p>
				<label for="<?php echo $this->get_field_id( 'link4' ); ?>"><?php _e('Ad 4 link url:', 'framework') ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link4' ); ?>" name="<?php echo $this->get_field_name( 'link4' ); ?>" value="<?php echo $instance['link4']; ?>" />
			</p>
			
			<!-- Ad 5 image URL -->
			<p>
				<label for="<?php echo $this->get_field_id( 'ad5' ); ?>"><?php _e('Ad 5 image url:', 'framework') ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'ad5' ); ?>" name="<?php echo $this->get_field_name( 'ad5' ); ?>" value="<?php echo $instance['ad5']; ?>" />
			</p>
			
			<!-- Ad 5 link URL -->
			<p>
				<label for="<?php echo $this->get_field_id( 'link5' ); ?>"><?php _e('Ad 5 link url:', 'framework') ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link5' ); ?>" name="<?php echo $this->get_field_name( 'link5' ); ?>" value="<?php echo $instance['link5']; ?>" />
			</p>
			
			<!-- Ad 6 image URL -->
			<p>
				<label for="<?php echo $this->get_field_id( 'ad6' ); ?>"><?php _e('Ad 6 image url:', 'framework') ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'ad6' ); ?>" name="<?php echo $this->get_field_name( 'ad6' ); ?>" value="<?php echo $instance['ad6']; ?>" />
			</p>
			
			<!-- Ad 6 link URL -->
			<p>
				<label for="<?php echo $this->get_field_id( 'link6' ); ?>"><?php _e('Ad 6 link url:', 'framework') ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link6' ); ?>" name="<?php echo $this->get_field_name( 'link6' ); ?>" value="<?php echo $instance['link6']; ?>" />
			</p>
			
		</div>		
		
		<div <?php if($instance['ad_type'] == 1) { ?> style="display:none;" <?php } ?> id="type-custom-text">
			<!-- Ad 1 custom code -->
			<p>
				<label for="<?php echo $this->get_field_id( 'custom_text_ad1' ); ?>"><?php _e('Ad 1 custom code:', 'framework') ?></label>
				<textarea rows="5" cols="40" class="widefat" id="<?php echo $this->get_field_id( 'custom_text_ad1' ); ?>" name="<?php echo $this->get_field_name( 'custom_text_ad1' ); ?>"><?php echo stripslashes($instance['custom_text_ad1']); ?></textarea>
			</p>
			
			<!-- Ad 2 custom code -->
			<p>
				<label for="<?php echo $this->get_field_id( 'custom_text_ad2' ); ?>"><?php _e('Ad 2 custom code:', 'framework') ?></label>
				<textarea rows="5" cols="40" class="widefat" id="<?php echo $this->get_field_id( 'custom_text_ad2' ); ?>" name="<?php echo $this->get_field_name( 'custom_text_ad2' ); ?>"><?php echo stripslashes($instance['custom_text_ad2']); ?></textarea>
			</p>
			
			<!-- Ad 3 custom code -->
			<p>
				<label for="<?php echo $this->get_field_id( 'custom_text_ad3' ); ?>"><?php _e('Ad 3 custom code:', 'framework') ?></label>
				<textarea rows="5" cols="40" class="widefat" id="<?php echo $this->get_field_id( 'custom_text_ad3' ); ?>" name="<?php echo $this->get_field_name( 'custom_text_ad3' ); ?>"><?php echo stripslashes($instance['custom_text_ad3']); ?></textarea>
			</p>
			
			<!-- Ad 4 custom code -->
			<p>
				<label for="<?php echo $this->get_field_id( 'custom_text_ad4' ); ?>"><?php _e('Ad 4 custom code:', 'framework') ?></label>
				<textarea rows="5" cols="40" class="widefat" id="<?php echo $this->get_field_id( 'custom_text_ad4' ); ?>" name="<?php echo $this->get_field_name( 'custom_text_ad4' ); ?>"><?php echo stripslashes($instance['custom_text_ad4']); ?></textarea>
			</p>
			
			<!-- Ad 5 custom code -->
			<p>
				<label for="<?php echo $this->get_field_id( 'custom_text_ad5' ); ?>"><?php _e('Ad 5 custom code:', 'framework') ?></label>
				<textarea rows="5" cols="40" class="widefat" id="<?php echo $this->get_field_id( 'custom_text_ad5' ); ?>" name="<?php echo $this->get_field_name( 'custom_text_ad5' ); ?>"><?php echo stripslashes($instance['custom_text_ad5']); ?></textarea>
			</p>
			
			<!-- Ad 6 custom code -->
			<p>
				<label for="<?php echo $this->get_field_id( 'custom_text_ad6' ); ?>"><?php _e('Ad 6 custom code:', 'framework') ?></label>
				<textarea rows="5" cols="40" class="widefat" id="<?php echo $this->get_field_id( 'custom_text_ad6' ); ?>" name="<?php echo $this->get_field_name( 'custom_text_ad6' ); ?>"><?php echo stripslashes($instance['custom_text_ad6']); ?></textarea>
			</p>
		
		</div>
		
		<!-- Randomize -->
		<p>
			<label for="<?php echo $this->get_field_id( 'random' ); ?>"><?php _e('Randomise ads order', 'framework') ?></label>
			<?php if ($instance['random']){ ?>
				<input type="checkbox" id="<?php echo $this->get_field_id( 'random' ); ?>" name="<?php echo $this->get_field_name( 'random' ); ?>" checked="checked" />
			<?php } else { ?>
				<input type="checkbox" id="<?php echo $this->get_field_id( 'random' ); ?>" name="<?php echo $this->get_field_name( 'random' ); ?>"  />
			<?php } ?>
		</p>
	<?php
	}
}
?>