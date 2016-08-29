<?php

/* --

Plugin Name: Categories
Plugin URI: http://www.awesemthemes.com
Description: A widget that displays your categories
Version: 1.0
Author: AWESEM
Author URI: http://www.awesemthemes.com

-- */

/* -- Add function to widgets_init that'll load our widget -- */
add_action( 'widgets_init', 'aw_categories_widgets' );

/* --Register widget -- */
function aw_categories_widgets() { register_widget( 'AW_CATEGORIES_Widget' ); }
function load_categories_js(){
	wp_register_script( 'categories', get_template_directory_uri() . '/_widgets/categories.js', false );
	wp_enqueue_script( 'categories' );
}
add_action('admin_enqueue_scripts', 'load_categories_js');

/* -- Widget class -- */
class aw_categories_widget extends WP_Widget {

	/* -- Widget setup -- */
	function AW_CATEGORIES_Widget() {
	
		/* -- Widget settings -- */
		$widget_ops = array( 'classname' => 'aw_categories_widget', 'description' => __('A widget that displays your categories', 'framework') );

		/* -- Widget control settings -- */
		$control_ops = array( 'id_base' => 'aw_categories_widget' );

		/* -- Create the widget -- */
		parent::__construct( 'aw_categories_widget', 'Deadline Responsive - '.__('Categories', 'framework'), $widget_ops, $control_ops );
	}

	/* -- Display Widget -- */
	function widget( $args, $instance ) {
		extract( $args );
		
		/* -- Before widget (defined by themes) -- */
		echo $before_widget;
		
		/* -- Display Categories -- */
		?>
				
		<?php
		foreach ($instance AS $category_key => $category){
			
			if($category_key !== 'global'){
				$cat = $instance[$category_key]['category'];
				$cat_title = $instance[$category_key]['categorytitle'];
				$exclude = $instance[$category_key]['exclude'];
				$exc = explode(',', $exclude);
			?>	
		
		<!-- BEGIN .container -->
		<div class="container">
		
			<div class="grid-8"><h3 class="widget-title"><?php echo $cat_title; ?></h3></div><div class="clear"></div>
			
			<?php
			$aw_latest = new WP_Query();
			$aw_latest->query( array( 'posts_per_page' => 1, 'category_name' => $cat, 'post__not_in' => $exc ) );
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
			$aw_floated_thumb->query( array( 'offset' => 1, 'posts_per_page' => 4, 'category_name' => $cat, 'post__not_in' => $exc ) );
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
			}
		}
		?>
				
		<?php
		/* -- After widget (defined by themes) -- */
		echo $after_widget;
	}

	/* -- Update widget -- */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		sort($instance);
		$instance['global']['title'] = strip_tags( $new_instance['global']['title'] );
		while($element = current($new_instance)) {
			$i = key($new_instance);
			if ($i !== 'global'){
				$instance[$i]['category'] = stripslashes( $new_instance[$i]['category']);
				$instance[$i]['categorytitle'] = stripslashes( $new_instance[$i]['categorytitle']);
				$instance[$i]['exclude'] = stripslashes( $new_instance[$i]['exclude']);
			}
			next($new_instance);
		}
		foreach ($instance AS $old_instance_element => $v){
			if (!array_key_exists($old_instance_element, $new_instance)) {
				unset($instance[$old_instance_element]);				
			}
		}
		return $instance;
	}
	
	/* -- Get field function -- */
	function get_field_name($field_name, $i=0 ) {
		return 'widget-' . $this->id_base . '[' . $this->number . '][' . $i . '][' . $field_name . ']';
	}
	
	/* -- Widget settings -- */
	function form( $instance ) {
		$instance_original = $instance;
		$defaults = array(
			'global' => array(
				'title' => ''
			)
		);
		$instance = wp_parse_args( (array) $instance_original, $defaults ); 
		$container = '';
		$count_elements = 0;
		$i = ''; ?>
		
		<!-- Title -->
		<p style="display: none;">
			<label for="<?php echo $this->get_field_id( 'title', 'global' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title', 'global' ); ?>" name="<?php echo $this->get_field_name( 'title', 'global' ); ?>" value="<?php echo $instance['global']['title']; ?>" />
		</p>
		
		<?php $categories = get_categories('hide_empty=0&orderby=name');  
		$aw_wp_cats = array();  
		foreach ($categories as $category_list ) {  
			$aw_wp_cats[$category_list->cat_ID] = $category_list->slug;  
			}  
		array_unshift($aw_wp_cats, __('Choose a category', 'framework')); 
		
		while($element = current($instance)) {
		
			$i = key($instance);
			$count_elements++;
			if($count_elements > 1){
				$container = 'category-container-' . $this->number . '-' . $i;
			?> 
			<div id="<?php echo $container; ?>" class="separator">
			
				<!-- Category Title -->
				<p>
					<label for="<?php echo $this->get_field_id( 'categorytitle' ); ?>"><?php _e('Title:', 'framework') ?></label>
					<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'categorytitle' ); ?>" name="<?php echo $this->get_field_name( 'categorytitle', $i ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance[$i]['categorytitle'] ), ENT_QUOTES)); ?>" />
				</p>
								
				<!-- Category -->
				<p>
					<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e('Category:', 'framework') ?></label>
					<select id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category', $i ); ?>" class="widefat">
					<?php
					foreach($aw_wp_cats as $key => $value) { ?>
						<option <?php if ( $value == $instance[$i]['category'] ) echo 'selected="selected"'; ?>><?php echo $value; ?></option>
					<?php } ?>
					</select>
				</p>
				
				<!-- Exclude post -->
				<p>
					<label for="<?php echo $this->get_field_id( 'exclude' ); ?>"><?php _e('Exclude:', 'framework') ?></label>
					<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'exclude' ); ?>" name="<?php echo $this->get_field_name( 'exclude', $i ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance[$i]['exclude'] ), ENT_QUOTES)); ?>" />
				</p>
								
				<!-- Remove category -->
				<p id="remove_category">
			  		<a class="submitdelete" onclick="return true" href='javascript:removeFieldCategory("<?php echo $container; ?>")'><?php _e('Remove', 'framework') ?></a> 
			 	</p>
			 	
			</div>
		<?php 	
		
			}
			next($instance);
		}
			if ($count_elements < 2){
			$i = 0;
			$container = 'category-container-' . $this->number . '-' . $i;	?>
						
			<div id="<?php echo $container; ?>" class="separator">
			
				<!-- Category Title -->
				<p>
					<label for="<?php echo $this->get_field_id( 'categorytitle' ); ?>"><?php _e('Title:', 'framework') ?></label>
					<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'categorytitle' ); ?>" name="<?php echo $this->get_field_name( 'categorytitle', $i ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance[$i]['categorytitle'] ), ENT_QUOTES)); ?>" />
				</p>
				
				<!-- Category -->
				<p>
					<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e('Category:', 'framework') ?></label>
					<select id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category', $i ); ?>" class="widefat">
					<?php
					foreach($aw_wp_cats as $key => $value) { ?>
						<option <?php if ( $value == $instance[$i]['category'] ) echo 'selected="selected"'; ?>><?php echo $value; ?></option>
					<?php } ?>
					</select>
				</p>
				
				<!-- Exclude post -->
				<p>
					<label for="<?php echo $this->get_field_id( 'exclude' ); ?>"><?php _e('Exclude:', 'framework') ?></label>
					<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'exclude' ); ?>" name="<?php echo $this->get_field_name( 'exclude', $i ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance[$i]['exclude'] ), ENT_QUOTES)); ?>" />
				</p>
				
				<!-- Remove category -->
				<p id="remove_category">
			  		<a class="submitdelete" onclick="return true" href='javascript:removeFieldCategory("<?php echo $container; ?>")'><?php _e('Remove', 'framework') ?></a> 
			 	</p>
			 	
			</div>			
		<?php 		
		}
		
		/* -- Set up some values for new category -- */
		$i++;
		$title = $this->get_field_id( "title" );
		$categorytitle = $this->get_field_id( "categorytitle" );
		$category = $this->get_field_id( "category" );
		$exclude = $this->get_field_id( "exclude" );
		$title_name = $this->get_field_name( "title", $i );
		$categorytitle_name = $this->get_field_name( "categorytitle", $i );
		$category_name = $this->get_field_name( "category", $i );
		$exclude_name = $this->get_field_name( "exclude", $i );
		$title_title =  htmlspecialchars(__("Title:", "framework"), ENT_QUOTES);
		$categorytitle_title = htmlspecialchars( __("Title:", "framework"), ENT_QUOTES);
		$category_title = htmlspecialchars( __("Category:", "framework"), ENT_QUOTES);
		$exclude_title = htmlspecialchars( __("Exclude:", "framework"), ENT_QUOTES);
		$category_widget_number = $this->number;
		?>
		
		<p id="add_category_<?php echo $category_widget_number; ?>">
			<input onclick='addFieldCategory("<?php echo $i; ?>","<?php echo $title; ?>","<?php echo $categorytitle; ?>","<?php echo $category; ?>","<?php echo $exclude; ?>","<?php echo $title_name; ?>","<?php echo $categorytitle_name; ?>","<?php echo $category_name; ?>","<?php echo $exclude_name; ?>","<?php echo $title_title; ?>","<?php echo $categorytitle_title; ?>","<?php echo $category_title; ?>","<?php echo $exclude_title; ?>","<?php echo $container; ?>","<?php echo $category_widget_number; ?>")' type="button" class="button-secondary" value="<?php _e('Add more', 'framework') ?>" />
 		</p>
 		
 		<script>
 		function addFieldCategory(i, title, categorytitle, category, exclude, title_name, categorytitle_name, category_name, exclude_name, title_title, categorytitle_title, category_title, exclude_title, container, category_widget_number){
			code = '<div id="' + container + '" class="separator"><p><label for="' + categorytitle + '">' + categorytitle_title + '</label><input class="widefat" type="text" id="' + categorytitle + '" name="' + categorytitle_name + '" /></p><p><label for="' + category + '">' + category_title + '</label><select class="widefat" id="' + category + '" name="' + category_name + '"><?php foreach($aw_wp_cats as $key => $value) { ?><option><?php echo $value; ?></option><?php } ?></select></p><p><label for="' + exclude + '">' + exclude_title + '</label><input class="widefat" type="text" id="' + exclude + '" name="' + exclude_name + '" /></p><p id="remove_category"><a class="submitdelete" href="javascript:removeField("'+container+'")">Remove</a></div>';
			jQuery("p#add_category_"+category_widget_number).before(code);
			return true;
		}
 		</script>
		
	<?php 
	}
}
?>