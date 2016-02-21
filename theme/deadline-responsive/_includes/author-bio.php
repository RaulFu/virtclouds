<!-- BEGIN #author-bio -->
<div id="author-bio">
	
	<h3 class="widget-title"><?php _e('About the author:', 'framework'); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('id')); ?>"><?php echo get_the_author_meta('display_name'); ?></a></h3>
	<div class="alignleft"><a href="<?php echo get_author_posts_url(get_the_author_meta('id')); ?>"><?php echo get_avatar( get_the_author_meta('email'), '50' ); ?></a></div>
	<p><?php the_author_meta('description'); ?></p>
	<div class="clear"></div>
	
</div>
<!-- END #author-bio -->