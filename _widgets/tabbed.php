<?php

/* --

Plugin Name: Tabbed
Plugin URI: http://www.awesemthemes.com
Description: A widget that displays your popular posts, recent posts, recent comments and tags
Version: 1.0
Author: AWESEM
Author URI: http://www.awesemthemes.com

-- */

/* -- Add function to widgets_init that'll load our widget -- */
add_action( 'widgets_init', 'aw_tabbed_widgets' );

/* -- Register widget -- */
function aw_tabbed_widgets() { register_widget( 'AW_TABBED_Widget' ); }

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/* -- Widget class -- */
class aw_tabbed_widget extends WP_Widget {

	/* -- Widget setup -- */
	function AW_TABBED_Widget() {
	
		/* -- Widget settings -- */
		$widget_ops = array( 'classname' => 'aw_tabbed_widget', 'description' => __('A widget that displays your popular posts, recent posts, recent comments and tags', 'framework') );
		
		/* -- Widget control settings -- */
		$control_ops = array( 'id_base' => 'aw_tabbed_widget' );

		/* -- Create the widget -- */
		parent::__construct( 'aw_tabbed_widget', 'Deadline Responsive - '.__('Tabbed','framework'), $widget_ops, $control_ops );
	}

	/* -- Display widget -- */	
	function widget( $args, $instance ) {
		global $wpdb;
		extract( $args );

		/* -- Our variables from the widget settings -- */
		$tab1 = $instance['tab1'];
		$tab2 = $instance['tab2'];
		$tab3 = $instance['tab3'];
		$tab4 = $instance['tab4'];
	

		/* -- Before widget (defined by themes) -- */
		echo $before_widget;

		/* -- Display Tabs -- */
		$tab = array();
			
		echo '<div class="tabs">';
			echo '<ul class="nav clearfix">';
				echo '<li><a id="link-popular-posts" href="#tab-popular-posts" title="'.$tab1.'">'.$tab1.'</a></li>';
				echo '<li><a id="link-latest-posts" href="#tab-latest-posts" title="'.$tab2.'">'.$tab2.'</a></li>';
				echo '<li><a id="link-latest-comments" href="#tab-latest-comments" title="'.$tab3.'">'.$tab3.'</a></li>';
				echo '<li><a id="link-tags" href="#tab-tags" title="'.$tab4.'">'.$tab4.'</a></li>';
			echo '</ul>';
					
			echo '<div id="tab-popular-posts" class="tab">';
				echo '<div class="floated-thumb">';
				if (is_plugin_active('post-views/post-views.php')) {
					$querystr = "SELECT DISTINCT $wpdb->posts.*, (post_views_total + 0) AS views, latest_view_time FROM $wpdb->posts LEFT JOIN ".WP_POST_VIEWS_TABLE." ON ".WP_POST_VIEWS_TABLE.".post_id = $wpdb->posts.ID   WHERE post_date < '".current_time('mysql')."' AND post_type = 'post' AND post_status = 'publish' AND '1=1' AND ".WP_POST_VIEWS_TABLE.".view_type = 'normal' AND ".WP_POST_VIEWS_TABLE.".output_type = 'content' AND '1=1' AND post_password = '' ORDER  BY views DESC LIMIT 5";
					$pageposts = $wpdb->get_results($querystr, OBJECT);
					if ($pageposts){
						foreach ($pageposts as $post_is) : setup_postdata($post_is); ?>
							
							<?php if ( get_the_post_thumbnail($post_is->ID, 'grid-1') != null ): ?>
						
							<!-- BEGIN .post-thumb -->
							<div class="post-thumb">
								
								<a href="<?php echo get_permalink($post_is->ID); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title($post_is->ID)); ?>"><?php echo get_the_post_thumbnail($post_is->ID, 'grid-1'); ?></a>
								
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
							<div class="post-meta <?php if ( get_the_post_thumbnail($post_is->ID, 'grid-1') == null ) echo ' no-thumb'; ?>">
							
								<p><a class="meta-title" href="<?php echo get_permalink($post_is->ID); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title($post_is->ID)); ?>"><?php echo get_the_title($post_is->ID); ?></a><br /><?php $date_format = get_option( 'date_format' ); echo get_the_time($date_format).' &middot; ';?><a href="<?php echo get_permalink( $post_is->ID );  ?>"><?php echo $post_is->views.' '.__('Views', 'framework'); ?></a></p>
									
							</div>
							<!-- END .post-meta -->
							
							<div class="clear"></div>
							
						<?php
						endforeach;	
					}
				} else {
					$popPosts = new WP_Query();
					$popPosts->query('showposts=5&orderby=comment_count&ignore_sticky_posts=1');
					while ($popPosts->have_posts()) : $popPosts->the_post(); ?>
						
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
						<div class="post-meta <?php if((!function_exists('has_post_thumbnail')) && (!has_post_thumbnail())) echo ' no-thumb'; ?>">
						
							<p><a class="meta-title" href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><?php the_title(); ?></a><br /><?php $date_format = get_option( 'date_format' ); the_time($date_format); echo ' &middot; '; comments_popup_link(__('No comments', 'framework'), __('1 comment', 'framework'), __('% comments', 'framework')); ?></p>
								
						</div>
						<!-- END .post-meta -->
						
						<div class="clear"></div>	
														
					<?php endwhile; 
					wp_reset_query();
				}
			
					
				echo '</div>';
			echo '</div>';

			echo '<div id="tab-latest-posts" class="tab">';
				echo '<div class="floated-thumb">';
					
					$recentPosts = new WP_Query();
					$recentPosts->query('showposts=5');
					while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
							
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
						<div class="post-meta <?php if((!function_exists('has_post_thumbnail')) && (!has_post_thumbnail())) echo ' no-thumb'; ?>">
						
							<p><a class="meta-title" href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><?php the_title(); ?></a><br /><?php $date_format = get_option( 'date_format' ); the_time($date_format); echo ' &middot; '; comments_popup_link(__('No comments', 'framework'), __('1 comment', 'framework'), __('% comments', 'framework')); ?></p>
								
						</div>
						<!-- END .post-meta -->
						
						<div class="clear"></div>
							
					<?php endwhile;
						
				echo '</div>';
			echo '</div>';

			echo '<div id="tab-latest-comments" class="tab">';
				echo '<div class="floated-thumb">';
				
				$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type, comment_author_url, SUBSTRING(comment_content,1,70) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT 5";
				$comments = $wpdb->get_results($sql);
					foreach ($comments as $comment) { ?>
					
						<!-- BEGIN .post-thumb -->
						<div class="post-thumb">
							
							<a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php echo strip_tags($comment->comment_author); ?> <?php _e('on ', 'framework'); ?><?php echo $comment->post_title; ?>"><?php echo get_avatar( $comment, '60' ); ?></a>
							
						</div>
						<!-- END .post-thumb -->
												
						<!-- BEGIN .post-meta -->
						<div class="post-meta">
						
							<p><a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php echo strip_tags($comment->comment_author); ?> <?php _e('on ', 'framework'); ?><?php echo $comment->post_title; ?>"><?php echo strip_tags($comment->com_excerpt); ?>...</a></p>
								
						</div>
						<!-- END .post-meta -->
						
						<div class="clear"></div>
					
					<?php }			
							
				echo '</div>';
			echo '</div>';

			//Tags tab
			echo '<div id="tab-tags" class="tab"><p>';
			$exclude_tag = get_term_by('slug', 'newsinpictures', 'post_tag');
			wp_tag_cloud('largest=15&smallest=15&unit=px&exclude='.$exclude_tag->term_id);
			echo '</p></div>';
		
		echo '</div>';

		/* -- After widget (defined by themes) -- */
		echo $after_widget;
	}

	/* -- Update widget -- */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['tab1'] = $new_instance['tab1'];
		$instance['tab2'] = $new_instance['tab2'];
		$instance['tab3'] = $new_instance['tab3'];
		$instance['tab4'] = $new_instance['tab4'];
		return $instance;
	}
	
	/* -- Widget settings -- */
	function form( $instance ) {
		$defaults = array(
			'tab1' => 'Popular',
			'tab2' => 'Recent',
			'tab3' => 'Comments',
			'tab4' => 'Tags'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Tab 1 title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tab1' ); ?>"><?php _e('Tab 1 Title:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'tab1' ); ?>" name="<?php echo $this->get_field_name( 'tab1' ); ?>" value="<?php echo $instance['tab1']; ?>" />
		</p>
		
		<!-- Tab 2 title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link1' ); ?>"><?php _e('Tab 2 Title:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'tab2' ); ?>" name="<?php echo $this->get_field_name( 'tab2' ); ?>" value="<?php echo $instance['tab2']; ?>" />
		</p>
		
		<!-- Tab 3 title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tab2' ); ?>"><?php _e('Tab 3 Title:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'tab3' ); ?>" name="<?php echo $this->get_field_name( 'tab3' ); ?>" value="<?php echo $instance['tab3']; ?>" />
		</p>
		
		<!-- Tab 4 title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link2' ); ?>"><?php _e('Tab 4 Title:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'tab4' ); ?>" name="<?php echo $this->get_field_name( 'tab4' ); ?>" value="<?php echo $instance['tab4']; ?>" />
		</p>
	
	<?php
	}
}
?>