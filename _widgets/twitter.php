<?php

/* --

Plugin Name: Twitter
Plugin URI: http://www.awesemthemes.com
Description: A widget that displays your latest tweets
Version: 1.0
Author: AWESEM
Author URI: http://www.awesemthemes.com

-- */

/* -- Add function to widgets_init that'll load our widget -- */
add_action( 'widgets_init', 'aw_twitter_widgets' );

/* -- Register widget -- */
function aw_twitter_widgets() { register_widget( 'AW_TWITTER_Widget' ); }

/* -- Widget class -- */
class aw_twitter_widget extends WP_Widget {

	/* -- Widget setup -- */
	function AW_TWITTER_Widget() {
		
		/* -- Widget settings -- */
		$widget_ops = array( 'classname' => 'aw_twitter_widget', 'description' => __('A widget that displays your latest tweets', 'framework') );

		/* -- Widget control settings -- */
		$control_ops = array( 'id_base' => 'aw_twitter_widget' );

		/* -- Create the widget -- */
		parent::__construct( 'aw_twitter_widget', 'Deadline Responsive - '.__('Twitter','framework'), $widget_ops, $control_ops );
	}

	/* -- Display widget -- */
	function widget( $args, $instance ) {
		extract( $args );

		/* -- Our variables from the widget settings -- */
		$title = apply_filters('widget_title', $instance['title'] );
		$username = $instance['username'];
		$postcount = $instance['postcount'];
		$tweettext = $instance['tweettext'];
		$cacheTime = 5;
		$transName = 'list-tweets';
		$backupName = $transName . '-backup';

		/* -- Before widget (defined by themes) -- */
		echo $before_widget;

		/* -- Display the widget title if one was input (before and after defined by themes) -- */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* -- Display latest tweets -- */
			if(false === ($tweets = get_transient($transName) ) ) :    
				$response = wp_remote_get('http://api.twitter.com/1/statuses/user_timeline.json?screen_name='.$username.'&count='.$postcount.'&exclude_replies=false');
    			if( !is_wp_error($response) && $response['response']['code'] == 200) :
					$tweets_json = json_decode($response['body'], true);
					foreach ($tweets_json as $tweet) :
            			$permalink = 'http://twitter.com/#!/'. $username .'/status/'. $tweet['id_str'];
            			$pattern = '/http:(\S)+/';
            			$replace = '<a href="${0}" target="_blank" rel="nofollow">${0}</a>';
            			$text = preg_replace($pattern, $replace, $tweet['text']);
            			$time = $tweet['created_at'];
            			$time = date_parse($time);
            			$uTime = mktime($time['hour'], $time['minute'], $time['second'], $time['month'], $time['day'], $time['year']);
            			$tweets[] = array(
							'text' => $text,
							'permalink' => $permalink,
							'time' => $uTime
						);
        			endforeach;
        			set_transient($transName, $tweets, 60 * $cacheTime);
        			update_option($backupName, $tweets);
				else :
        			$tweets = get_option($backupName);
    			endif;
			endif;

			if($tweets) : ?>
    			<ul>
    				<?php foreach($tweets as $t) : ?>
        			<li>
        				<div class="twitter-icon"></div>
        				<span><?php echo $t['text']; ?></span>
                     	<span class="twitter-time"><?php echo human_time_diff($t['time'], current_time('timestamp')); echo ' '; _e('ago', 'framework'); ?></span>
        			</li>
   					 <?php endforeach; ?>
   				</ul>
    			<p><a href="http://twitter.com/#!/<?php echo $username; ?>"><?php echo $tweettext; ?></a></p>
    
			<?php else : ?>
				<p><?php _e('No tweets found.', 'framework'); ?></p>
			<?php endif; ?>
		
		<?php 

		/* -- After widget (defined by themes) -- */
		echo $after_widget;
	}

	/* -- Update widget -- */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['postcount'] = strip_tags( $new_instance['postcount'] );
		$instance['tweettext'] = strip_tags( $new_instance['tweettext'] );
		return $instance;
	}
	
	/* -- Widget settings -- */
	function form( $instance ) {
		$defaults = array(
			'title' => 'Latest tweets',
			'username' => 'awesemthemes',
			'postcount' => '5',
			'tweettext' => 'Follow us on Twitter'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<!-- Username -->
		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Username:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
		</p>
		
		<!-- Postcount -->
		<p>
			<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of tweets:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
		</p>
		
		<!-- Tweet text -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tweettext' ); ?>"><?php _e('Follow Text:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'tweettext' ); ?>" name="<?php echo $this->get_field_name( 'tweettext' ); ?>" value="<?php echo $instance['tweettext']; ?>" />
		</p>
		
	<?php
	}
}
?>