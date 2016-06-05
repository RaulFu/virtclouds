<?php

function aw_admin_home() {
	$amp = 'add_menu_page';
	$amp('Deadline Responsive', 'Deadline Responsive', 'edit_themes', 'deadlineresponsive', 'aw_deadlineresponsive_home', get_stylesheet_directory_uri().'/favicon.ico');
	$asmp = 'add_submenu_page';
	$asmp('deadlineresponsive', __('Widgets', 'framework'), __('Widgets', 'framework'), 'edit_themes', 'widgets.php');
	$asmp('deadlineresponsive', __('Menus', 'framework'), __('Menus', 'framework'), 'edit_themes', 'nav-menus.php');
	$asmp('deadlineresponsive', __('Theme Options', 'framework'), __('Theme Options', 'framework'), 'edit_themes', 'themes.php?page=options.php');
}

function aw_deadlineresponsive_home() {

?>

<style type="text/css">
	h3 { margin-top: 0; }
	#blocks { width: 50%; margin-top: 20px; }
	.block { width: 49%; float: left; margin-bottom: 60px; margin-top: 40px; }
	.block.last { float: right; }
	.big-block { width: 96%; border: 1px solid #dfdfdf; padding: 2%; margin-bottom: 20px; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px; background-color: #f5f5f5; background-image: -ms-linear-gradient(top,#F9F9F9,#f5f5f5); background-image: -moz-linear-gradient(top,#F9F9F9,#f5f5f5); background-image: -o-linear-gradient(top,#F9F9F9,#f5f5f5); background-image: -webkit-gradient(linear,left top,left bottom,from(#F9F9F9),to(#f5f5f5)); background-image: -webkit-linear-gradient(top,#F9F9F9,#f5f5f5); background-image: linear-gradient(top,#F9F9F9,#f5f5f5); }
	.clear { clear: both; margin-bottom: 0; }
	.alignleft { margin-right: 20px; margin-bottom: 20px; }
	.notes { padding: 10px; font-weight: bold; }
	#blocks p.clear { margin-left: 68px; }
</style>

<div class="wrap">
	
	<div id="icon-themes" class="icon32"></div>
	<h2>Deadline Responsive</h2>
	
	<div id="blocks">
	
		<p class="notes">
			<?php _e('If you have any questions or problems, please read the documentation or contact us.','framework'); ?>
		</p>
	
		<div class="block featured">
			<img class="alignleft" src="<?php echo get_template_directory_uri();; ?>/_functions/img/theme.png" alt="" />
			<h3><?php _e('Theme Options','framework'); ?></h3>
			<p><?php _e('Our theme has extensive theme options to change the logo, background, slider, tracking code, colours, top bar, leaderboard ...','framework'); ?></p>
			<p class="clear"><a href="themes.php?page=options.php"><?php _e('Customise your theme','framework'); ?> &raquo;</a></p>
		</div>
		
		<div class="block featured last">
			<img class="alignleft" src="<?php echo get_template_directory_uri();; ?>/_functions/img/support.png" alt="" />
			<h3><?php _e('Support &amp; Contact','framework'); ?></h3>
			<p><?php printf(__('We provide detailed %1$stheme documentation%2$s. In case you still encounter problems please contact us using our %3$sTheme Support Forum%4$s.','framework'), '<a href="http://www.awesemthemes.com/theme-documentation/deadline-responsive">', '</a>', '<a href="http://support.awesem.com/">', '</a>'); ?></p>
			<p class="clear"><a href="http://support.awesem.com/"><?php _e('Visit our support forum','framework'); ?> &raquo;</a></p>
		</div>
		
		<div class="clear"></div>
		
		<div class="big-block">
			<h3><?php _e('What to do next?','framework'); ?></h3>
			<ol>
				<li><?php printf(__('%1$sCreate your homepage%2$s and %3$sset it up as your front page%4$s','framework'), '<a href="post-new.php?post_type=page">','</a>','<a href="options-reading.php">','</a>'); ?></li>
				
				<li><?php printf(__('%1$sCreate your blog page%2$s and %3$sset it up as your posts page%4$s','framework'), '<a href="post-new.php?post_type=page">','</a>','<a href="options-reading.php">','</a>'); ?></li>
				
				<li><?php printf(__('%1$sSetup your permalink structure%2$s as explained in the documentation','framework'), '<a href="options-permalink.php">','</a>'); ?></li>
				
				<li><?php printf(__('%1$sAdd some widgets%2$s to your homepage, your sidebar and your footer','framework'), '<a href="widgets.php">','</a>'); ?></li>

			</ol>
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

<?php

}

function theme_options() { include('options.php'); }

add_action('admin_menu', 'aw_admin_home');

?>