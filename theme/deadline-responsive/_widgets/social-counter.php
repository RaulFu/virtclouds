<?php

/* --

Plugin Name: Social counter
Plugin URI: http://www.awesemthemes.com
Description: A widget that displays a social counter
Version: 1.0
Author: AWESEM
Author URI: http://www.awesemthemes.com

-- */

/* -- Add function to widgets_init that'll load our widget -- */
add_action( 'widgets_init', 'aw_socialcounter_widgets' );

/* -- Register widget -- */
function aw_socialcounter_widgets() { register_widget( 'AW_SOCIALCOUNTER_Widget' ); }

/* -- Widget class -- */
class aw_socialcounter_widget extends WP_Widget {

	/* -- Widget setup -- */
	function AW_SOCIALCOUNTER_Widget() {
	
		/* -- Widget settings -- */
		$widget_ops = array( 'classname' => 'aw_socialcounter_widget', 'description' => __('A widget that displays a social counter', 'framework') );
		
		/* -- Widget control settings -- */
		$control_ops = array( 'id_base' => 'aw_socialcounter_widget' );

		/* -- Create the widget -- */
		$this->WP_Widget( 'aw_socialcounter_widget', 'Deadline Responsive - '.__('Social counter','framework'), $widget_ops, $control_ops );
	}	

	/* -- Display widget -- */	
	function widget( $args, $instance ) {
		extract( $args );

		if (!extension_loaded('simplexml'))
			_e('You need to enable the SimpleXML extension (http://php.net/manual/en/book.simplexml.php) to be able to use this widget', 'framework');

		/* -- Our variables from the widget settings -- */
		$title = apply_filters('widget_title', $instance['title'] );
		$feedburner_title = $instance['feedburner_title'];
		$feedburner_username = $instance['feedburner_username'];
		$feedburner_url = $instance['feedburner_url'];
		$feedburner_subscribers = get_option('feedburner_subscribers');
		$feedburner_last_check = get_option('feedburner_last_check');
		$twitter_title = $instance['twitter_title'];
		$twitter_username = $instance['twitter_username'];
		$twitter_followers = get_option('twitter_followers');
		$twitter_last_check = get_option('twitter_last_check');
		$facebook_title = $instance['facebook_title'];
		$facebook_id = $instance['facebook_id'];
		$facebook_url = $instance['facebook_url'];
		$facebook_fans = get_option('facebook_fans');
		$facebook_last_check = get_option('facebook_last_check');
		$one_hour_ago = time() - 1800;
		
		/* -- FeedBurner -- */
		if(!empty($feedburner_username) && $feedburner_last_check < $one_hour_ago) { 
			try {
				$feedurl='https://feedburner.google.com/api/awareness/1.0/GetFeedData?uri='.$feedburner_username . '';
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_URL, $feedurl);
				$data = curl_exec($ch);
				curl_close($ch);
				$simplexml = new SimpleXMLElement($data);
				$subscribers = (string) $simplexml->feed->entry['circulation'];
				if($subscribers > 0) {
					$feedburner_subscribers = $subscribers;
					update_option("feedburner_subscribers",$feedburner_subscribers);
				}
				update_option("feedburner_last_check",time());
			}
			catch(Exception $e) { var_dump($e->getMessage()); } 
		}
		

		/* -- Twitter -- */
		if(!empty($twitter_username) && $twitter_last_check < $one_hour_ago) { 
			try {
				$twitter_url = 'http://twitter.com/users/show.xml?screen_name='.$twitter_username . '';
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_URL, $twitter_url);
				$data = curl_exec($ch);
				curl_close($ch);
				$simplexml = new SimpleXMLElement($data);
				$followers = (string) $simplexml->followers_count;
				if($followers > 0) {
					$twitter_followers = $followers;

					update_option("twitter_followers",$followers);
				}
				update_option("twitter_last_check",time());
			}
			catch(Exception $e) { var_dump($e->getMessage()); }
		}
					
		/* -- Facebook -- */
		if(!empty($facebook_id) && $facebook_last_check < $one_hour_ago) {
			try { 
				$page_id = $facebook_id;
				$facebook_url = "http://api.facebook.com/restserver.php?method=facebook.fql.query&query=SELECT%20fan_count%20FROM%20page%20WHERE%20page_id=".$page_id . "";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_URL, $facebook_url);
				$data = curl_exec($ch);
				curl_close($ch);
				$simplexml = new SimpleXMLElement($data);
				$fans = (string) $simplexml->page->fan_count;
				if($fans > 0) {
					$facebook_fans = $fans;
					update_option("facebook_fans",$facebook_fans);
				}
				update_option("facebook_last_check",time());
			}
			catch(Exception $e) { var_dump($e->getMessage()); }
		}

		/* -- Before widget (defined by themes) -- */
		echo $before_widget;

		/* -- Display the widget title if one was input (before and after defined by themes) -- */
		if ( $title )
			echo $before_title . $title . $after_title;
	?> 
		<ul>
		
			<?php if(!empty($feedburner_url) && !empty($feedburner_username) && !empty($feedburner_title)) : ?>
			
			<!-- BEGIN .feedburner -->
			<li class="feedburner">
				
				<img class="alignleft" src="<?php echo get_stylesheet_directory_uri() ?>/_assets/img/rss.png" alt="<?php echo $feedburner_title; ?>" />
				<a href="<?php echo $feedburner_url; ?>"><?php echo $feedburner_title; ?></a> <span><?php echo $feedburner_subscribers; ?> <?php _e('subscribers', 'framework'); ?></span>
				
			</li>
			<!-- END .feedburner -->
			
			<?php endif; ?>
			
			<?php if(!empty($twitter_username) && !empty($twitter_title)) : ?>
			
			<!-- BEGIN .twitter -->
			<li class="twitter">
				
				<img class="alignleft" src="<?php echo get_stylesheet_directory_uri() ?>/_assets/img/twitter.png" alt="<?php echo $twitter_title; ?>" />
				<a href="http://twitter.com/<?php echo $twitter_username; ?>"><?php echo $twitter_title; ?></a> <span><?php echo $twitter_followers; ?> <?php _e('followers', 'framework'); ?></span>
				
			</li>
			<!-- END .twitter -->
			
			<?php endif; ?>
			
			<?php if(!empty($facebook_url) && !empty($facebook_id) && !empty($facebook_title)) : ?>
			
			<!-- BEGIN .facebook -->
			<li class="facebook">
				
				<img class="alignleft" src="<?php echo get_stylesheet_directory_uri() ?>/_assets/img/facebook.png" alt="<?php echo $facebook_title; ?>" />
				<a href="<?php echo $facebook_url; ?>"><?php echo $facebook_title; ?></a> <span><?php echo $facebook_fans; ?> <?php _e('fans', 'framework'); ?></span>
				
			</li>
			<!-- END .facebook -->
			
			<?php endif; ?>
		
		</ul>
		
		<?php 

		/* -- After widget (defined by themes) -- */
		echo $after_widget;
	}

	/* -- Update widget -- */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['feedburner_title'] = strip_tags( $new_instance['feedburner_title'] );
		$instance['feedburner_username'] = strip_tags( $new_instance['feedburner_username'] );
		$instance['feedburner_url'] = strip_tags( $new_instance['feedburner_url'] );
		$instance['twitter_title'] = strip_tags( $new_instance['twitter_title'] );
		$instance['twitter_username'] = strip_tags( $new_instance['twitter_username'] );
		$instance['facebook_title'] = strip_tags( $new_instance['facebook_title'] );
		$instance['facebook_id'] = strip_tags( $new_instance['facebook_id'] );
		$instance['facebook_url'] = strip_tags( $new_instance['facebook_url'] );
		return $instance;
	}
	
	/* -- Widget settings -- */
	function form( $instance ) {
		$defaults = array(
			'title' => '',
			'feedburner_title' => 'Subscribe RSS Feed',
			'feedburner_username' => 'awesem',
			'feedburner_url' => 'http://feeds.feedburner.com/awesem',
			'twitter_title' => 'Follow us on Twitter',
			'twitter_username' => 'awesemthemes',
			'facebook_title' => 'Connect on Facebook',
			'facebook_id' => '322985184424451',
			'facebook_url' => 'https://www.facebook.com/awesemltd'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<!-- FeedBurner -->
		<p class="separator"><strong>FeedBurner</strong></p>

		<!-- FeedBurner title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'feedburner_title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'feedburner_title' ); ?>" name="<?php echo $this->get_field_name( 'feedburner_title' ); ?>" value="<?php echo $instance['feedburner_title']; ?>" />
		</p>

		<!-- FeedBurner username -->
		<p>
			<label for="<?php echo $this->get_field_id( 'feedburner_username' ); ?>"><?php _e('Username:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'feedburner_username' ); ?>" name="<?php echo $this->get_field_name( 'feedburner_username' ); ?>" value="<?php echo $instance['feedburner_username']; ?>" />
		</p>
		
		<!-- FeedBurner URL -->
		<p>
			<label for="<?php echo $this->get_field_id( 'feedburner_url' ); ?>"><?php _e('URL:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'feedburner_url' ); ?>" name="<?php echo $this->get_field_name( 'feedburner_url' ); ?>" value="<?php echo $instance['feedburner_url']; ?>" />
		</p>
		
		<!-- Twitter -->
		<p class="separator"><strong>Twitter</strong></p>
		
		<!-- Twitter title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter_title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'twitter_title' ); ?>" name="<?php echo $this->get_field_name( 'twitter_title' ); ?>" value="<?php echo $instance['twitter_title']; ?>" />
		</p>
		
		<!-- Twitter username -->
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter_username' ); ?>"><?php _e('Username:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'twitter_username' ); ?>" name="<?php echo $this->get_field_name( 'twitter_username' ); ?>" value="<?php echo $instance['twitter_username']; ?>" />
		</p>
		
		<!-- Facebook -->
		<p class="separator"><strong>Facebook</strong></p>
		
		<!-- Facebook title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook_title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'facebook_title' ); ?>" name="<?php echo $this->get_field_name( 'facebook_title' ); ?>" value="<?php echo $instance['facebook_title']; ?>" />
		</p>
		
		<!-- Facebook ID -->
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook_id' ); ?>"><?php _e('Page ID:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'facebook_id' ); ?>" name="<?php echo $this->get_field_name( 'facebook_id' ); ?>" value="<?php echo $instance['facebook_id']; ?>" />
		</p>
		
		<!-- Facebook URL -->
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook_url' ); ?>"><?php _e('Page URL:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'facebook_url' ); ?>" name="<?php echo $this->get_field_name( 'facebook_url' ); ?>" value="<?php echo $instance['facebook_url']; ?>" />
		</p>
		
	<?php
	}
}
?>