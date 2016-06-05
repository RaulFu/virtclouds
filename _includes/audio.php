<!-- BEGIN .post -->
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<!-- BEGIN .entry-header -->
	<div class="entry-header">
	
		<?php if (is_singular()) : ?>
		
		<h1><span class="post-icon"></span><?php the_title(); ?></h1>
		
		<?php else : ?>
		
		<h2><span class="post-icon"></span><a href="<?php the_permalink() ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><?php the_title(); ?></a></h2>

		<?php endif; ?>
					
	</div>
	<!-- BEGIN .entry-header -->
	
	<!-- BEGIN .entry-meta -->
	<div class="entry-meta">
	
		<p><?php _e('By', 'framework'); echo ' '; the_author_link(); echo ' ';  _e('in', 'framework'); echo ' '; the_category(', '); echo ' &middot; '; $date_format = get_option( 'date_format' ); the_time($date_format); echo ' &middot; '; comments_popup_link(__('No comments', 'framework'), __('1 comment', 'framework'), __('% comments', 'framework')); ?></p>
		
		<?php 
		if (is_singular()) :
			$posttags = get_the_tags();
			if (count($posttags) != 0) :
				$fulltag = array();
	  			foreach($posttags as $tag) :
	  				$taglink = get_tag_link($tag->term_id);
	  				$tagname = $tag->name;
	    			$fulltag[] = '<a href="'.$taglink.'">'.$tagname.'</a>';
	  			endforeach;
	  			echo '<p>'.__('Tags:', 'framework').' '.implode(', ',$fulltag).'</p>';
	  		endif;
  		endif;
  		?>
		
	</div>
	<!-- END .entry-meta -->
	
	<?php get_template_part( '_includes/entry-audio' ); ?>
		
	<!-- BEGIN .entry -->
	<div class="entry">
					
		<?php
		if (is_singular()):
			the_content(); wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'framework').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); edit_post_link(__('Edit this entry.', 'framework'), '<p>', '</p>');
		else :
			if(!$post->post_excerpt) :
				the_content(__('Read the rest of this entry', 'framework'));
			else :
				the_excerpt();
				echo '<p><a href="'.get_permalink().'">'.__('Read the rest of this entry', 'framework').'</a></p>';
			endif;
		endif;
		?>
	
	</div>
	<!-- END .entry -->
		
</div>
<!-- END .post -->