<?php


/* -- Create menu -- */
function aw_update_notifier_menu() {
	$xml = get_latest_theme_version(86400);
	$theme_data = get_theme_data(TEMPLATEPATH . '/style.css');
	if(version_compare($theme_data['Version'], $xml->latest) == -1) {
		add_dashboard_page( __('Theme update', 'framework'), __('Theme', 'framework') . '<span class="update-plugins count-1"><span class="update-count">1</span></span>', 'administrator', 'theme-update', update_notifier);
	}
}  
add_action('admin_menu', 'aw_update_notifier_menu');


/* -- Add message to dashboard -- */
function aw_update_notifier_dashboard() {
	$xml = get_latest_theme_version(86400);
	$theme_data = get_theme_data(TEMPLATEPATH . '/style.css');
	if(version_compare($theme_data['Version'], $xml->latest) == -1) { ?>
		<div id="message" class="updated fade">
			<p><strong><?php printf(__('There is a new version of the %s theme available.', 'framework'), $theme_data['Name']); ?></strong> <?php printf(__('You have version %1$s. Update to %2$s.', 'framework'), $theme_data['Version'], $xml->latest); ?></p>			
		</div>
	<?php }
}  
add_action('admin_notices', 'aw_update_notifier_dashboard');


/* -- Add update page -- */
function update_notifier() {
	$xml = get_latest_theme_version(86400);
	$theme_data = get_theme_data(TEMPLATEPATH . '/style.css');

?>

<style>
	h3 { margin-top: 0; }
	#blocks { width: 50%; margin-top: 20px; }
	#blocks .updated { width: 100%; }
	.block { width: 100%; margin: 60px 0; }
	.block.last { float: right; }
	.big-block { width: 96%; border: 1px solid #dfdfdf; padding: 2%; margin-bottom: 20px; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px; background-color: #f5f5f5; background-image: -ms-linear-gradient(top,#F9F9F9,#f5f5f5); background-image: -moz-linear-gradient(top,#F9F9F9,#f5f5f5); background-image: -o-linear-gradient(top,#F9F9F9,#f5f5f5); background-image: -webkit-gradient(linear,left top,left bottom,from(#F9F9F9),to(#f5f5f5)); background-image: -webkit-linear-gradient(top,#F9F9F9,#f5f5f5); background-image: linear-gradient(top,#F9F9F9,#f5f5f5); }
	.clear { clear: both; margin-bottom: 0; }
	.alignleft { margin-right: 20px; }
	.notes { padding: 10px; font-weight: bold; }
</style>

<div class="wrap">

	<div id="icon-tools" class="icon32"></div>
	<h2><?php _e('Theme update', 'framework'); ?></h2>

	<div id="blocks">
	
		<p class="notes">
			<?php printf(__('Make a backup of the theme inside your WordPress installation folder /wp-content/themes/%s/','framework'), strtolower($theme_data['Name'])); ?>
		</p>
	
        <div class="block">
                
        	<img class="alignleft" src="<?php echo get_template_directory_uri(); ?>/screenshot.png" />
        	<img class="alignleft" src="<?php echo get_template_directory_uri(); ?>/_functions/img/instructions.png" alt="" />
            
            <h3><?php _e('Instructions', 'framework'); ?></h3>
            
            <p><?php printf(__('To update the theme, %1$slogin%2$s to your ThemeForest account, head over to your %3$sdownloads%4$s section and re-download the theme like you did when you bought it','framework'), '<a href="http://themeforest.net/signin/">', '</a>', '<strong>', '</strong>'); ?></p>
            <p><?php printf(__('Extract the zip\'s contents, look for the extracted theme folder, and after you have all the new files upload them using FTP to the %1$s/wp-content/themes/%3$s/%2$s folder overwriting the old ones (this is why it is important to backup any changes you have made to the theme files).','framework'), '<strong>', '</strong>', strtolower($theme_data['Name'])); ?></p>
            <p><?php _e('If you didn\'t make any changes to the theme files, you are free to overwrite them with the new ones without the risk of losing theme settings, pages, posts, etc...', 'framework'); ?></p>
           
            <div class="clear"></div>
            
        </div>

	    <div class="big-block">
			<h3><?php _e('Changelog','framework'); ?></h3>
			<?php echo $xml->changelog; ?>
		</div>
	    
	    <div class="big-block">
						
			<div style="float: left; margin: 0 10px 0 0;">
				<p style="margin: 0 0 20px 0;"><a href="http://www.awesemthemes.com/" style="display: block;"><img src="<?php echo get_template_directory_uri();; ?>/_functions/img/awesem.png" alt="" /></a></p>
				<strong>AWESEM Limited</strong><br />3rd Floor, 207 Regent Street<br />London W1B 3HH
			</div>
			
			<div style="float: right; margin: 0 0 0 10px; text-align: right">
				<a href="http://www.awesemthemes.com/">AWESEM Themes</a><br />
				<a href="http://themeforest.net/user/awesem?ref=awesem"><?php _e('Visit us on ThemeForest','framework'); ?></a><br />
				<a href="http://twitter.com/#!/awesemthemes"><?php _e('Follow us on Twitter','framework'); ?></a>
			</div>
			
			<div class="clear"></div>
			
		</div>
	
		<div class="clear"></div>
	
	</div>

</div>

<?php } 


/* -- Get theme version -- */
function get_latest_theme_version($interval) {
	return $xml;
	$notifier_file_url = 'http://www.awesem.com/_notifier/deadlineresponsive.xml';
	$db_cache_field = 'contempo-notifier-cache';
	$db_cache_field_last_updated = 'contempo-notifier-last-updated';
	$last = get_option( $db_cache_field_last_updated );
	$now = time();
	if ( !$last || (( $now - $last ) > $interval) ) {
		if( function_exists('curl_init') ) {
			$ch = curl_init($notifier_file_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			$cache = curl_exec($ch);
			curl_close($ch);
		} else {
			$cache = file_get_contents($notifier_file_url);
		}
		if ($cache) {
			update_option( $db_cache_field, $cache );
			update_option( $db_cache_field_last_updated, time() );
		}
		$notifier_data = get_option( $db_cache_field );
	}
	else {
		$notifier_data = get_option( $db_cache_field );
	}
	if(!empty($notifier_data)) {
		$xml = simplexml_load_string($notifier_data);
	}
	return $xml;
}

?>