<?php
include( TEMPLATEPATH . '/_admin/get-options.php' );
include( TEMPLATEPATH . '/_functions/csscolor.php');
?>
<!DOCTYPE html>   
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]> <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]> <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]> <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->

<!-- BEGIN head -->
<head>

	<!-- Title -->
	<title><?php if(is_home() || is_search() || is_front_page()) { bloginfo('name'); echo ' - '; bloginfo('description'); } else { wp_title(''); echo ' - '; bloginfo('name'); } ?></title>
	
	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	
	<!-- Favicon & Mobileicon -->
	<link rel="shortcut icon" href="<?php echo $aw_favicon_url; ?>" />
	<link rel="apple-touch-icon" href="<?php echo $aw_mobileicon_url; ?>" />
	
	<!-- RSS, Atom & Pingbacks -->
	<?php if ($aw_feedburner_code != '') : ?>
	<link rel="alternate" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php echo $aw_feedburner_code; ?>" />
	<?php else : ?>
	<link rel="alternate" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
	<?php endif; ?>
	<link rel="alternate" title="RSS .92" href="<?php bloginfo( 'rss_url' ); ?>" />
	<link rel="alternate" title="Atom 0.3" href="<?php bloginfo( 'atom_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<!-- Theme Hook -->
	<?php wp_head(); ?>
	
	<!-- CSS -->
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" media="screen" />
	<!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noticia+Text:400,700italic,700,400italic" media="screen" />-->
	<style>
		<?php
			$aw_color_1 = new CSS_Color(str_replace('#','',$aw_color_primary));
			$aw_color_2 = new CSS_Color(str_replace('#','',$aw_color_secondary));
			$aw_color_primary_dark = '#'.$aw_color_1->bg['-2'];
			$aw_color_secondary_dark = '#'.$aw_color_2->bg['-2'];
		?>
		*::selection { background: <?php echo $aw_color_primary; ?>; }
		*::-moz-selection { background: <?php echo $aw_color_primary; ?>; }
		body { background: <?php $aw_background_fixed = ($aw_background_fixed_enable == 'true')  ? 'fixed' : 'scroll'; echo $aw_background_color.' '; if(($aw_background_pattern != 'none') && ($aw_background_pattern_custom_enable == 'false')) echo 'url("'.get_template_directory_uri().'/_assets/img/_background/'.$aw_background_pattern.'.png") 0 0 repeat '.$aw_background_fixed.';'; if($aw_background_pattern_custom_enable == 'true') echo 'url("'.$aw_background_pattern_custom_url.'") '.$aw_background_pattern_custom_positionx.' '.$aw_background_pattern_custom_positiony.' '.$aw_background_pattern_custom_repeat.' '.$aw_background_fixed.';'; ?> }
		a, .tabs ul.nav li a:hover, .tabs ul.nav li.active a, .dropcap, .toggle.hover .toggle-title, li.comment cite a:hover, h3.widget-title, .post-meta .meta-title:hover, .the-latest a:hover h4, .aw_socialcounter_widget li a:hover, .aw_tabbed_widget #tab-latest-comments a:hover { color: <?php echo $aw_color_primary; ?>; }
		a:hover { color: <?php echo $aw_color_secondary; ?>; }
		input:focus, textarea:focus { border-color: <?php echo $aw_color_primary; ?>; }
		#searchsubmit, .highlight, .aw_tabbed_widget .tabs ul.nav li.active a, footer .aw_tabbed_widget .tabs ul.nav li.active a, #top .aw_tabbed_widget .tabs ul.nav li.active a, .aw_tabbed_widget .tabs ul.nav li a:hover, footer .aw_tabbed_widget .tabs ul.nav li a:hover, #top .aw_tabbed_widget .tabs ul.nav li a:hover, .aw_twitter_widget .twitter-icon, .testimonial-icon, #top-closed:hover, .flex-control-nav a:hover, .flex-control-nav a.flex-active { background-color: <?php echo $aw_color_primary; ?>; }
		.submit { background-color: <?php echo $aw_color_primary; ?>; border-color: <?php echo $aw_color_primary_dark; ?>; }
		.submit:hover { background-color: <?php echo $aw_color_secondary; ?>; border-color: <?php echo $aw_color_secondary_dark; ?>; }
		#searchsubmit:hover { background-color: <?php echo $aw_color_secondary; ?>; }
		.toggle.hover .toggle-icon { border-top-color: <?php echo $aw_color_primary; ?>; }
		.toggle.hover.active .toggle-icon { border-bottom-color: <?php echo $aw_color_primary; ?>; }
		.flex-direction-nav li .flex-prev:hover { border-right-color: <?php echo $aw_color_primary; ?>; }
		.flex-direction-nav li .flex-next:hover { border-left-color: <?php echo $aw_color_primary; ?>; }
		@media only screen and (min-width: 768px) and (max-width: 959px) {
			.aw_tabbed_widget .tabs ul.nav li a:hover, .tabs ul.nav li.active a { color: <?php echo $aw_color_primary; ?>; }
		}
		@media screen and (max-width: 767px) {
			.tabs ul.nav li a:hover, .tabs ul.nav li.active a { color: <?php echo $aw_color_primary; ?>; }
		}
	</style>
		
	<!--[if IE 8]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
    <![endif]-->

	<!-- Links: RSS + Atom Syndication + Pingback etc. -->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo( 'rss_url' ); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo( 'atom_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<script>
		var _hmt = _hmt || [];
		(function() {
		  var hm = document.createElement("script");
		  hm.src = "//hm.baidu.com/hm.js?de84c9662794495c47872e090752ee9f";
		  var s = document.getElementsByTagName("script")[0]; 
		  s.parentNode.insertBefore(hm, s);
		})();
	</script>
<!-- END head -->
</head>

<!-- BEGIN body -->
<body <?php body_class(); ?>>

	<?php if($aw_topbar_enable == 'true') : ?>

	<!-- BEGIN #top -->
	<div id="top">
	
		<!-- BEGIN .container -->
		<div class="container">
		
			<?php if($aw_topbar_columns == '1') : ?>
		
			<!-- BEGIN .grid-12 -->
			<div class="grid-12">
				
				<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Topbar') ); ?>
				
			</div>
			<!-- END .grid-12 -->
			
			<div class="clear"></div>
			
			<?php endif; ?>
		
			<?php if($aw_topbar_columns == '3') : ?>
		
			<!-- BEGIN .grid-4 -->
			<div class="grid-4">
				
				<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Topbar 1') ); ?>
				
			</div>
			<!-- END .grid-4 -->
			
			<!-- BEGIN .grid-4 -->
			<div class="grid-4">
				
				<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Topbar 2') ); ?>
				
			</div>
			<!-- END .grid-4 -->
			
			<!-- BEGIN .grid-4 -->
			<div class="grid-4">
				
				<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Topbar 3') ); ?>
				
			</div>
			<!-- END .grid-4 -->
			
			<div class="clear"></div>
			
			<?php endif; ?>
				
		</div>
		<!-- END .container -->		
	
	</div>
	<!-- END #top -->
	
	<a id="top-open" href="#"><?php _e('Open', 'framework'); ?></a>
	<a id="top-closed" href="#"><?php _e('Close', 'framework'); ?></a>
	
	<?php endif; ?>

	<!-- BEGIN #top-nav -->
	<nav id="top-nav" class="menu-nav">
		
		<!-- BEGIN .container -->
		<div class="container">

			<?php
			if ( has_nav_menu( 'top-nav' ) ) :
				wp_nav_menu( array( 'theme_location' => 'top-nav', 'container_class'  => 'grid-9' ) );
			else : 
				echo wp_page_menu( array( 'echo' => 1, 'menu_class'  => 'grid-9' ) );
			endif;
			?>
			
			<!-- BEGIN #date -->
			<div id="date" class="grid-3">
				<p class="text-right margin-0">
					<span class="rounded"><?php $oldLocale = setlocale(LC_TIME, WPLANG);
					echo utf8_encode(strftime("%A %d %b %Y", time())); 
					setlocale(LC_TIME, $oldLocale);
				 ?></span>
				</p>
			</div>
			<!-- END #date -->
				
			<div class="clear"></div>
		
		</div>
		<!-- END .container -->
    
	</nav>
	<!-- END #top-nav -->
  	
	<!-- BEGIN #wrapper -->
	<div id="wrapper" class="container">

		<!-- BEGIN header -->
		<header>
		
			<?php if($aw_leaderboard_enable == 'true') : ?>
			
			<div class="header-wrapper">
								
				<!-- BEGIN #logo -->
				<div id="logo" class="leaderboard-true">
				
					<?php
					if ($aw_logo_text == 'true') : ?>
					<a id="logo-text" href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
					<p id="tagline"><?php bloginfo( 'description' ); ?></p>
					<?php elseif ($aw_logo_url) : ?>
					<a href="<?php echo home_url(); ?>"><img src="<?php echo $aw_logo_url; ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
					<?php else : ?>
					<a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_assets/img/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
					<?php endif; ?>
				
				</div>
				<!-- END #logo -->
				
				<!-- BEGIN #leaderboard -->
				<div id="leaderboard">
				
					<?php echo stripslashes(htmlspecialchars_decode($aw_leaderboard_content)); ?>
				
				</div>
				<!-- END #leaderboard -->
				
				<div class="clear"></div>
			
			</div>
			
			<?php else : ?>
			
			<!-- BEGIN #logo -->
			<div id="logo" class="grid-12">
			
				<?php
				if ($aw_logo_text == 'true') : ?>
				<a id="logo-text" href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
				<p id="tagline"><?php bloginfo( 'description' ); ?></p>
				<?php elseif ($aw_logo_url) : ?>
				<a href="<?php echo home_url(); ?>"><img src="<?php echo $aw_logo_url; ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
				<?php else : ?>
				<a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_assets/img/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
				<?php endif; ?>
			
			</div>
			<!-- END #logo -->
			
			<?php endif; ?>
			
			<div class="clear"></div>
			
			<!-- BEGIN #main-nav -->
			<nav id="main-nav" class="grid-12 menu-nav">
			
				<div id="main-navIcon"><?php _e('Menu', 'framework'); ?></div>

				<?php
				if ( has_nav_menu( 'main-nav' ) ) :
				wp_nav_menu( array( 'theme_location' => 'main-nav' ) );
				else :
				wp_page_menu( array( 'echo' => 1) );
				endif;
				?>
				
				<div class="clear"></div>
            
			</nav>
			<!-- END #main-nav -->
			
			<div class="clear"></div>

		</header>
		<!-- END header -->
		
		<?php 
		if( function_exists('bcn_display') && !is_front_page() ) :
			echo '<div id="breadcrumb" class="grid-12 margin-20"><div class="breadcrumb-wrapper">';
			bcn_display();
			echo '</div></div><div class="clear"></div>';
		endif;
		?>