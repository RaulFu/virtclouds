<?php
function aw_init() {  
  	if (is_admin()) {
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_script('jquery-ui-sortable');
		wp_register_script('jscolor', get_template_directory_uri().'/_admin/colorpicker/jquery.modcoder.excolor.js');
		wp_enqueue_script('jscolor');
		wp_register_script('effects', get_template_directory_uri().'/_admin/effects.js', array( 'jquery' ), '1.0', true);
		wp_enqueue_script('effects'); 
		wp_register_style('style', get_template_directory_uri().'/_admin/style.css');
		wp_enqueue_style('style');
  	}
} 
add_action('init', 'aw_init');


$categories = get_categories('hide_empty=0&orderby=name');  
$aw_wp_cats = array();  
foreach ($categories as $category_list ) {  
	$aw_wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}  

$themename = 'Deadline Responsive';
$shortname = 'aw';
$options = array (

	array(
		'name' => __('selected', 'framework'),
		'id' => $shortname.'_selectedtab',
		'std' => '',
		'type' => 'hidden'
	),
	
	array('type' => 'opentab'),
	
		array('type' => 'open'),
	
			array(
				'name' => __('Logo settings', 'framework'),
				'id' => $shortname.'_logo_settings',
				'type' => 'title'
			),
			
			array(
				'name' => __('Upload logo', 'framework'),
				'desc' => __('Browse your computer and upload your new logo.', 'framework'),
				'id' => $shortname.'_logo_url',
				'std' => '',
				'type' => 'file'
			),
	
			array(
				'name' => __('Enable plain text logo','framework'),
				'desc' => __('Check this to use a plain text logo rather than an image. Info will be taken from your WordPress settings.', 'framework'),
				'id' => $shortname.'_logo_text',
				'std' => 'false',
				'type' => 'checkbox'
			),
	
		array('type' => 'close'),
		
		array('type' => 'open'),
		
			array(
				'name' => __('Favicon settings', 'framework'),
				'id' => $shortname.'_favicon_settings',
				'type' => 'title'
			),
		
			array(
				'name' => __('Upload desktop favicon (16x16px)', 'framework'),
				'desc' => __('Browse your computer and upload your new favicon.', 'framework'),
				'id' => $shortname.'_favicon_url',
				'std' => get_template_directory_uri().'/favicon.ico',
				'type' => 'file'
			),
			
			array(
				'name' => __('Upload mobile favicon (144x144px)', 'framework'),
				'desc' => __('Browse your computer and upload your new mobile icon.', 'framework'),
				'id' => $shortname.'_mobileicon_url',
				'std' => get_template_directory_uri().'/mobileicon.png',
				'type' => 'file'
			),
			
		array('type' => 'close'),
		
		array('type' => 'open'),
		
			array(
				'name' => __('Sidebar settings', 'framework'),
				'id' => $shortname.'_sidebar_settings',
				'type' => 'title'
			),
			
			array(
				'name' => __('Sidebar position', 'framework'),
				'desc' => __('Select the sidebar position.', 'framework'),
				'id' => $shortname.'_sidebar_position',
				'std' => 'right',
				'type' => 'select',
				'options' => array('right', 'left'),
			),
			
		array('type' => 'close'),
		
		array('type' => 'open'),
		
			array(
				'name' => __('Topbar settings', 'framework'),
				'id' => $shortname.'_topbar_settings',
				'type' => 'title'
			),
		
			array(
				'name' => __('Enable topbar','framework'),
				'desc' => __('Check this if you want to display a widgetised area at the top of your page.', 'framework'),
				'id' => $shortname.'_topbar_enable',
				'std' => 'false',
				'type' => 'checkbox'
			),
			
			array(
				'name' => __('Topbar columns', 'framework'),
				'desc' => __('Select the number of columns you want to display.', 'framework'),
				'id' => $shortname.'_topbar_columns',
				'std' => '1',
				'type' => 'select',
				'options' => array('1', '3'),
			),
			
		array('type' => 'close'),
		
		array('type' => 'open'),
		
			array(
				'name' => __('Leaderboard settings', 'framework'),
				'id' => $shortname.'_leaderboard_settings',
				'type' => 'title'
			),
		
			array(
				'name' => __('Enable leaderboard','framework'),
				'desc' => __('Check this if you want to display a leaderboard ad (728x90).', 'framework'),
				'id' => $shortname.'_leaderboard_enable',
				'std' => 'false',
				'type' => 'checkbox'
			),
			
			array(
				'name' => __('Leaderboard content','framework'),
				'desc' => __('Enter your full ad code here.', 'framework'),
				'id' => $shortname.'_leaderboard_content',
				'std' => '',
				'type' => 'textarea'
			),
			
		array('type' => 'close'),
		
	array('type' => 'closetab'),
	
	array('type' => 'opentab'),
	
		array('type' => 'open'),
	
			array(
				'name' => __('Colour settings', 'framework'),
				'id' => $shortname.'_color_settings',
				'type' => 'title'
			),
	
			array(
				'name' => __('Primary font colour', 'framework'),
				'desc' => __('Choose your primary colour.', 'framework'),
				'id' => $shortname.'_color_primary',
				'std' => '#0099cc',
				'type' => 'color'
			),
			
			array(
				'name' => __('Secondary font colour', 'framework'),
				'desc' => __('Choose your secondary colour.', 'framework'),
				'id' => $shortname.'_color_secondary',
				'std' => '#b30000',
				'type' => 'color'
			),
	
		array('type' => 'close'),
	
	array('type' => 'closetab'),
	
	array('type' => 'opentab'),
		
		array('type' => 'open'),
		
			array(
				'name' => __('Background settings', 'framework'),
				'id' => $shortname.'_background_settings',
				'type' => 'title'
			),
		
			array(
				'name' => __('Background colour', 'framework'),
				'desc' => __('Choose your background colour.', 'framework'),
				'id' => $shortname.'_background_color',
				'std' => '#ffffff',
				'type' => 'color'
			),
			
			array(
				'name' => __('Background pattern', 'framework'),
				'desc' => __('Select your background pattern.', 'framework'),
				'id' => $shortname.'_background_pattern',
				'std' => 'none',
				'type' => 'select',
				'options' => array('none', 'blackmamba', 'carbon_fibre_big', 'carbon_fibre', 'circles', 'concrete_wall_2', 'dark_circles', 'dark_wood', 'darkdenim3', 'grunge_wall', 'inflicted', 'irongrip', 'merely_cubed', 'noise_pattern_with_crosslines', 'noisy', 'old_wall', 'project_papper', 'purty_wood', 'rockywall', 'smooth_wall', 'struckaxiom', 'subtle_freckles', 'tactile_noise', 'white_carbon', 'white_plaster', 'wood_pattern', 'worn_dots'),
			),
			
			array(
				'name' => __('Enable background fixed position','framework'),
				'desc' => __('Check this to enable a fixed position for the background pattern.', 'framework'),
				'id' => $shortname.'_background_fixed_enable',
				'std' => 'false',
				'type' => 'checkbox'
			),
			
			array(
				'name' => __('Enable custom background image','framework'),
				'desc' => __('Check this to enable the upload of a custom background image.', 'framework'),
				'id' => $shortname.'_background_pattern_custom_enable',
				'std' => 'false',
				'type' => 'checkbox'
			),
			
			array(
				'name' => __('Upload custom image', 'framework'),
				'desc' => __('Browse your computer and upload your image.', 'framework'),
				'id' => $shortname.'_background_pattern_custom_url',
				'std' => '',
				'type' => 'file'
			),
			
			array(
				'name' => __('Custom image repeat', 'framework'),
				'desc' => __('Select the repeat property of your uploaded image.', 'framework'),
				'id' => $shortname.'_background_pattern_custom_repeat',
				'std' => 'no-repeat',
				'type' => 'select',
				'options' => array('no-repeat', 'repeat', 'repeat-x', 'repeat-y'),
			),
			
			array(
				'name' => __('Custom image position-x', 'framework'),
				'desc' => __('Select the position-x property of your uploaded image.', 'framework'),
				'id' => $shortname.'_background_pattern_custom_positionx',
				'std' => 'center',
				'type' => 'select',
				'options' => array('center', 'left', 'right'),
			),
			
			array(
				'name' => __('Custom image position-y', 'framework'),
				'desc' => __('Select the position-y property of your uploaded image.', 'framework'),
				'id' => $shortname.'_background_pattern_custom_positiony',
				'std' => 'center',
				'type' => 'select',
				'options' => array('center', 'top', 'bottom'),
			),
			
		array('type' => 'close'),
		
	array('type' => 'closetab'),
		
	array('type' => 'opentab'),
		
		array('type' => 'open'),
		
			array(
				'name' => __('Post Format (Gallery) slider settings', 'framework'),
				'id' => $shortname.'_slider_settings',
				'type' => 'title'
			),
			
			array(
				'name' => __('Autoplay', 'framework'),
				'desc' => __('Milliseconds between slide transitions (0 to disable autoplay).', 'framework'),
				'id' => $shortname.'_slider_autoplay',
				'std' => '5000',
				'type' => 'text'
			),
			
			array(
				'name' => __('Animation duration', 'framework'),
				'desc' => __('Milliseconds from one slide to the next.', 'framework'),
				'id' => $shortname.'_slider_animation_duration',
				'std' => '1000',
				'type' => 'text'
			),
			
			array(
				'name' => __('Enable previous/next navigation','framework'),
				'desc' => __('Check this to create navigation for previous/next navigation.', 'framework'),
				'id' => $shortname.'_slider_directionnav_enable',
				'std' => 'false',
				'type' => 'checkbox'
			),
			
			array(
				'name' => __('Enable paging control navigation','framework'),
				'desc' => __('Check this to create navigation for paging control of each slide.', 'framework'),
				'id' => $shortname.'_slider_controlnav_enable',
				'std' => 'false',
				'type' => 'checkbox'
			),
			
			array(
				'name' => __('Enable keyboard','framework'),
				'desc' => __('Check this to allow slider navigating via keyboard left/right keys.', 'framework'),
				'id' => $shortname.'_slider_keyboardnav_enable',
				'std' => 'false',
				'type' => 'checkbox'
			),
			
			array(
				'name' => __('Enable mousewheel','framework'),
				'desc' => __('Check this to allow slider navigating via mousewheel.', 'framework'),
				'id' => $shortname.'_slider_mousewheel_enable',
				'std' => 'false',
				'type' => 'checkbox'
			),
			
			array(
				'name' => __('Enable randomisation','framework'),
				'desc' => __('Check this to randomise slide order.', 'framework'),
				'id' => $shortname.'_slider_randomize_enable',
				'std' => 'false',
				'type' => 'checkbox'
			),
							
		array('type' => 'close'),	
	
	array('type' => 'closetab'),
	
	array('type' => 'opentab'),
	
		array('type' => 'open'),
		
			array(
				'name' => __('Posts settings', 'framework'),
				'id' => $shortname.'_posts_settings',
				'type' => 'title'
			),
			
			array(
				'name' => __('Enable related posts', 'framework'),
				'desc' => __('Check this to show a related posts panel on each post page.', 'framework'),
				'id' => $shortname.'_posts_related',
				'std' => 'false',
				'type' => 'checkbox'
			),
			
			array(
				'name' => __('Number of related posts', 'framework'),
				'desc' => __('Select the number of related posts you want to display.', 'framework'),
				'id' => $shortname.'_nb_posts_related',
				'std' => '2',
				'type' => 'select',
				'options' => array('2', '3', '4', '5', '6', '7', '8', '9', '10'),
			),
			
			array(
				'name' => __('Enable author bio', 'framework'),
				'desc' => __('Check this to show an author bio panel on each post page.', 'framework'),
				'id' => $shortname.'_posts_bio',
				'std' => 'false',
				'type' => 'checkbox'
			),
	
		array('type' => 'close'),
		
	array('type' => 'closetab'),
	
	array('type' => 'opentab'),
				
		array('type' => 'open'),
		
			array(
				'name' => __('Contact form settings', 'framework'),
				'id' => $shortname.'_contact_form_settings',
				'type' => 'title'
			),
			
			array(
				'name' => __('Email address', 'framework'),
				'desc' => __('Enter the email address where you want to receive emails from the contact form, or leave blank to use admin email.', 'framework'),
				'id' => $shortname.'_contact_form_email',
				'std' => '',
				'type' => 'text'
			),
			
			array(
				'name' => __('Greeting message', 'framework'),
				'desc' => __('Enter the greeting message.', 'framework'),
				'id' => $shortname.'_contact_form_message',
				'std' => 'Thank you very much.',
				'type' => 'textarea'
			),
			
			array(
				'name' => __('Enable captcha', 'framework'),
				'desc' => __('Check this to enable a captcha', 'framework'),
				'id' => $shortname.'_captcha_select',
				'std' => 'false',
				'type' => 'checkbox'
			),
	
			array(
				'name' => __('Captcha public key', 'framework'),
				'desc' => __('Enter your public key. https://www.google.com/recaptcha/admin/create', 'framework'),
				'id' => $shortname.'_captcha_public_key',
				'std' => '',
				'type' => 'text'
			),
			
			array(
				'name' => __('Captcha private key', 'framework'),
				'desc' => __('Enter your private key. https://www.google.com/recaptcha/admin/create', 'framework'),
				'id' => $shortname.'_captcha_private_key',
				'std' => '',
				'type' => 'text'
			),
						
		array('type' => 'close'),
		
	array('type' => 'closetab'),
	
	array('type' => 'opentab'),
	
		array('type' => 'open'),
		
			array(
				'name' => __('Analytics settings', 'framework'),
				'id' => $shortname.'_analytics_settings',
				'type' => 'title'
			),
			
			array(
				'name' => __('Analytics code', 'framework'),
				'desc' => __('Enter your full Google Analytics code (or any other site tracking code) here. It will be inserted before the closing body tag.', 'framework'),
				'id' => $shortname.'_analytics_code',
				'std' => '',
				'type' => 'textarea'
			),
			
		array('type' => 'close'),
		
		array('type' => 'open'),
		
			array(
				'name' => __('FeedBurner settings', 'framework'),
				'id' => $shortname.'_feedburner_settings',
				'type' => 'title'
			),
			
			array(
				'name' => __('FeedBurner URL', 'framework'),
				'desc' => __('Enter your full FeedBurner URL (or any other preferred feed URL) if you want to use FeedBurner over the standard WordPress Feed (e.g. http://feeds.feedburner.com/awesem)', 'framework'),
				'id' => $shortname.'_feedburner_code',
				'std' => '',
				'type' => 'text'
			),
		
		array('type' => 'close'),
		
		array('type' => 'open'),
		
			array(
				'name' => __('Google Maps settings', 'framework'),
				'id' => $shortname.'_google_maps_settings',
				'type' => 'title'
			),
			
			array(
				'name' => __('Google Maps key', 'framework'),
				'desc' => __('Enter your full Google Maps API key here. Sign Up for the Google Maps API: http://code.google.com/apis/console/', 'framework'),
				'id' => $shortname.'_google_maps_key',
				'std' => '',
				'type' => 'text'
			),
		
		array('type' => 'close'),
				
	array('type' => 'closetab')

);

function aw_add_admin() {
	
	global $themename, $shortname, $options;

    if ( isset($_GET['page']) && $_GET['page'] == basename(__FILE__) ) {
	
		$request_action = (isset($_REQUEST['action']) ? $_REQUEST['action'] : '');

        if ( 'save' == $request_action ) {

				$url = $_REQUEST['aw_selectedtab'];
            	if ($url == ''){
					$url = 'themes.php?page=options.php&saved=true&tab=1';
				} else {
					$t = substr($url, -1);
					$url = 'themes.php?page=options.php&saved=true&tab='.$t;
				}
				
    			foreach ($options as $value) {
    				if(!isset($value['id'])) continue;
					if ( ($value['id'] != 'aw_logo_url') && ($value['id'] != 'aw_favicon_url') && ($value['id'] != 'aw_mobileicon_url') && ($value['id'] != 'aw_background_pattern_custom_url') ){
                    	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } 
					}
				}
	
			if (  (isset($_FILES['aw_logo_url'])) && ($_FILES['aw_logo_url']['error'] == UPLOAD_ERR_OK)  ) {  

				$overrides = array('test_form' => false); 
		        $file = wp_handle_upload($_FILES['aw_logo_url'], $overrides);
				$urlimage = $file['url'];
				update_option('aw_logo_url', $urlimage);
			}
						
			if (  (isset($_FILES['aw_favicon_url'])) && ($_FILES['aw_favicon_url']['error'] == UPLOAD_ERR_OK)  ) {

				$overrides = array('test_form' => false); 
		        $file = wp_handle_upload($_FILES['aw_favicon_url'], $overrides);
				$urlimage = $file['url'];
				update_option('aw_favicon_url', $urlimage);
			}
			
			if (  (isset($_FILES['aw_mobileicon_url'])) && ($_FILES['aw_mobileicon_url']['error'] == UPLOAD_ERR_OK)  ) {

				$overrides = array('test_form' => false); 
		        $file = wp_handle_upload($_FILES['aw_mobileicon_url'], $overrides);
				$urlimage = $file['url'];
				update_option('aw_mobileicon_url', $urlimage);
			}
			
			if (  (isset($_FILES['aw_background_pattern_custom_url'])) && ($_FILES['aw_background_pattern_custom_url']['error'] == UPLOAD_ERR_OK)  ) {

				$overrides = array('test_form' => false); 
		        $file = wp_handle_upload($_FILES['aw_background_pattern_custom_url'], $overrides);
				$urlimage = $file['url'];
				update_option('aw_background_pattern_custom_url', $urlimage);
			}
			
				header('Location: '.$url);
                die;

        } else if( 'reset' == $request_action ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); }

            header('Location: themes.php?page=options.php&reset=true');
            die;
            
        }
    }

    add_theme_page('Theme Options', 'Theme Options', 'edit_pages', basename(__FILE__), 'aw_admin');

}

	
function aw_admin() {

	global $themename, $shortname, $options;

?>

<!-- BEGIN .wrap -->
<div class="wrap">
	
	<div id="icon-themes" class="icon32"></div>
	<h2><?php _e('Theme Options', 'framework') ?></h2>
	
	<?php if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '.__('settings saved', 'framework').'.</strong></p></div>'; ?>
	<?php if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '.__('settings reset', 'framework').'.</strong></p></div>'; ?>

	<!-- BEGIN #form-theme -->
	<form id="form-theme" method="post" action="" enctype="multipart/form-data" style="overflow:hidden;">
		
		<input type="hidden" name="selectedtab" id="selectedtab" value="0" />	
		
		<!-- BEGIN #tabs -->
		<div id="tabs" class="metabox-holder clearfix">
			
			<!-- BEGIN .left-column -->
			<div class="left-column">
			
				<p><img src="<?php echo get_template_directory_uri();; ?>/_assets/img/logo.png" width="145" alt="" style="display:block;" /></a></p>
				<ul id="tab-items">
					<li><a href="#tabs-1"><?php _e('General', 'framework') ?></a></li>
					<li><a href="#tabs-2"><?php _e('Colour', 'framework') ?></a></li>
					<li><a href="#tabs-3"><?php _e('Background', 'framework') ?></a></li>
					<li><a href="#tabs-4"><?php _e('Slider', 'framework') ?></a></li>
					<li><a href="#tabs-5"><?php _e('Posts', 'framework') ?></a></li>
					<li><a href="#tabs-6"><?php _e('Contact form', 'framework') ?></a></li>
					<li><a href="#tabs-7"><?php _e('API', 'framework') ?></a></li>
				</ul>
				<p>
					<input name="save" type="submit" class="button-primary" value="<?php _e('Save settings', 'framework'); ?>" />    
					<input type="hidden" name="action" value="save" />
				</p>
				<p class="border">Deadline Responsive - A Premium News/Magazine Theme by AWESEM</p>
			
			</div>
			<!-- END .left-column -->
			
			<!-- BEGIN .postbox-container -->
			<div class="postbox-container">

				<?php 
				$tab = 1;
				foreach ($options as $value) { 
				switch ( $value['type'] ) {

				case 'opentab': ?>
				<div id="tabs-<?php echo $tab;?>">
				
				<?php 
				$tab++;
				break;
				
				case 'closetab': ?>
				</div>
				<?php
				break;

				case 'open':
				?>
				<!-- BEGIN .postbox -->
				<div class="postbox">

					<?php 
					break;
					
					case 'note':
					?>
					<div class="notes"><p><?php echo $value['desc']; ?></p></div>
					
					<?php 
					break;
					
					case 'title':
					?>
					<h3 class="hndle"><span><?php echo $value['name']; ?></span></h3>
					
					<!-- BEGIN .inside -->
					<div class="inside">		
						
						<?php break;
						
						case 'hidden': ?>
						
						<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="hidden" value="<?php if ( get_option( $value['id'] ) != '') { echo stripslashes(htmlspecialchars(get_option( $value['id'] ), ENT_QUOTES)); } else { echo $value['std']; } ?>" />
						
						<?php break;
						
						case 'text':
						?>
						
						<!-- BEGIN .textcont -->
						<div class="textcont">
							<div class="value">
								<?php echo $value['name']; ?>:
							</div>
							<div class="input">
								<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != '') { echo stripslashes(htmlspecialchars(get_option( $value['id'] ), ENT_QUOTES)); } else { echo $value['std']; } ?>" />
								<p><?php echo stripslashes(htmlspecialchars($value['desc'])); ?></p>
							</div>
							<div class="clear"></div>
						</div>
						<!-- END .textcont -->
						
						<?php break;
						
						case 'color':
						?>
						
						<!-- BEGIN .textcont -->
						<div class="textcont">
							<div class="value">
								<?php echo $value['name']; ?>:
							</div>
							<div class="input">
								<input class="aw-color" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != '') { echo stripslashes(htmlspecialchars(get_option( $value['id'] ), ENT_QUOTES)); } else { echo $value['std']; } ?>" />
								<p><?php echo stripslashes(htmlspecialchars($value['desc'])); ?></p>
							</div>
							<div class="clear"></div>
						</div>
						<!-- END .textcont -->
						
						<?php break;
						
						case 'file':
						?>
						
						<!-- BEGIN .textcont -->
						<div class="textcont">
							<div class="value">
								<?php echo $value['name']; ?>:
							</div>
							<div class="input">
								<table class="form-table">
									<tr valign="top">
										<td><input type="file" name="<?php echo $value['id']; ?>" class="aw-upload" size="40" border="0" /></td>
									</tr>
								</table>
								<p><?php _e('Current file:', 'framework') ?> <?php echo get_option($value['id']); ?></p>
								<p><?php echo stripslashes(htmlspecialchars($value['desc'])); ?></p>
							</div>
							<div class="clear"></div>
						</div>
						<!-- END .textcont -->
						
						<?php break;
						
						case 'textarea':
						?>
						
						<!-- BEGIN .textcont -->
						<div class="textcont">
							<div class="value">
								<?php echo $value['name']; ?>:
							</div>
							<div class="input">
								<textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php if ( get_option( $value['id'] ) != '') { echo stripslashes(htmlspecialchars(get_option( $value['id'] ), ENT_QUOTES)); } else { echo $value['std']; } ?></textarea>
								<p><?php echo stripslashes(htmlspecialchars($value['desc'])); ?></p>
							</div>
							<div class="clear"></div>
						</div>
						<!-- END .textcont -->
							
						<?php break;
						
						case 'checkbox':
						?>
						
						<!-- BEGIN .textcont -->
						<div class="textcont">
							<div class="value">
								<?php echo $value['name']; ?>:
							</div>
							<div class="input">
								<?php if(get_option($value['id'])){ $checked = 'checked=\'checked\''; }else{ $checked = '';} ?>
								<p><input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> /></p>
								<p><?php echo stripslashes(htmlspecialchars($value['desc'])); ?></p>
							</div>
							<div class="clear"></div>
						</div>
						<!-- END .textcont -->
											
						<?php break;
						
						case 'select':
						?>
						
						<!-- BEGIN .textcont -->
						<div class="textcont">
							<div class="value">
								<?php echo $value['name']; ?>:
							</div>
							<div class="input">
								<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select>
								<p><?php echo stripslashes(htmlspecialchars($value['desc'])); ?></p>
							</div>
							<div class="clear"></div>
						</div>
						<!-- END .textcont -->
							
						<?php break;
						
						case 'close':
						?>
							
					</div>
					<!-- END .inside -->
					
				</div>
				<!-- END .postbox -->
				
				<?php break;
				} 
			}
			?>
			
			</div>
			<!-- END .postbox-container -->
			
			<div class="clear"></div>
			
		</div>
		<!-- END #tabs -->
						
	</form>
	<!-- END #form-theme -->
	
	<!-- BEGIN #reset-theme -->
	<form method="post" id="reset-theme" action="" onsubmit="return confirm('<?php _e('Are you sure you want to restore theme defaults?','framework'); ?>\n<?php _e('Please be advised that these changes cannot be undone.', 'framework') ?>');">
	
		<p class="submit">
			<input name="reset" type="submit" id="reset-button" class="button" value="<?php _e('Reset', 'framework'); ?>" />
			<input type="hidden" name="action" value="reset" />
		</p>
		
	</form>
	<!-- END #reset-theme -->

</div>
<!-- END .wrap -->

<?php
}

add_action('admin_menu', 'aw_add_admin');
?>