<!-- BEGIN #searchform -->
<form method="get" id="searchform" action="<?php echo home_url(); ?>/">

	<label class="none" for="s"><?php _e('Search for:', 'framework'); ?></label>
	<div class="input-wrapper"><input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php _e('Search', 'framework'); ?>" /></div>
	<input type="submit" id="searchsubmit" value="<?php esc_attr_e('Search', 'framework'); ?>" />
	
</form>
<!-- END #searchform -->