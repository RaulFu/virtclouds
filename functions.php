<?php

/* -- Theme options -- */
include('_admin/options.php');
include('_admin/get-options.php');

/* -- Enqueue JS scripts -- */
function aw_enqueue_js() {  
	wp_register_script('modernizr', get_template_directory_uri() . '/_assets/js/modernizr.js', array(), '2.5.3', false);
	wp_enqueue_script('modernizr');
	wp_enqueue_script('jquery');
	wp_register_script('easing', get_template_directory_uri() . '/_assets/js/easing.js', array( 'jquery' ), '1.3', true);
	wp_enqueue_script('easing');
	wp_register_script('superfish', get_template_directory_uri() . '/_assets/js/superfish.js', array( 'jquery' ), '1.4.8', true);
	wp_enqueue_script('superfish');
	wp_register_script('validate', get_template_directory_uri() . '/_assets/js/validate.js', array( 'jquery' ), '1.9.0', true);
	wp_enqueue_script('validate');
	wp_register_script('touchwipe', get_template_directory_uri() . '/_assets/js/touchwipe.js', array( 'jquery' ), '1.1.1', true);
	wp_enqueue_script('touchwipe');
	wp_register_script('caroufredsel', get_template_directory_uri() . '/_assets/js/caroufredsel.js', array( 'jquery' ), '5.5.0', true);
	wp_enqueue_script('caroufredsel');
	wp_register_script('flexslider', get_template_directory_uri() . '/_assets/js/flexslider.js', array( 'jquery' ), '2.0', true);
	wp_enqueue_script('flexslider');
	wp_register_script('jplayer', get_template_directory_uri() . '/_assets/js/jplayer.js', array( 'jquery' ), '2.1.0', true);
	wp_enqueue_script('jplayer');
	wp_register_script('fitvids', get_template_directory_uri() . '/_assets/js/fitvids.js', array( 'jquery' ), '1.0', true);
	wp_enqueue_script('fitvids');
	wp_register_script('gmap', get_template_directory_uri() . '/_assets/js/gmap.js', array( 'jquery' ), '1.1.0', true);
	wp_enqueue_script('gmap');
	if (is_singular()) {
		wp_enqueue_script('comment-reply');
	}
	wp_register_script('effects', get_template_directory_uri() . '/_assets/js/effects.js', array( 'jquery' ), '1.0', true);
	wp_enqueue_script('effects');
} 
add_action( 'wp_enqueue_scripts', 'aw_enqueue_js' );  


/* -- Sidebar -- */
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Sidebar - Narrow 1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Sidebar - Narrow 2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Homepage - Full width',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Homepage - Narrow 1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Homepage - Narrow 2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Footer 1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Footer 2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Footer 3',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	if($aw_topbar_columns == '1') {
		register_sidebar(array(
			'name' => 'Topbar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	}
	if($aw_topbar_columns == '3') {
		register_sidebar(array(
			'name' => 'Topbar 1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'name' => 'Topbar 2',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'name' => 'Topbar 3',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	}
}


/* -- Thumbnails -- */
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 50, 50, true );
	add_image_size( 'grid-1', 50, 50, true );
	add_image_size( 'single-post-thumbnail', 730, 365, true );
	add_image_size( 'single-project-thumbnail', 940, 9999 );
	add_image_size( 'slider-image-portfolio', 940, 350, true );
	add_image_size( 'slider-image-blog', 730, 365, true );
	add_image_size( 'news-in-pictures', 300, 300, true );
	add_image_size( 'mugshot', 180, 180, true );
	add_image_size( 'project', 220, 160, true );
}
function aw_remove_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}
add_filter( 'post_thumbnail_html', 'aw_remove_attribute', 10 );
add_filter( 'image_send_to_editor', 'aw_remove_attribute', 10 );
function aw_remove_image_title( $attr ) {
	unset($attr['title']);
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'aw_remove_image_title');


/* -- Add classes to posts -- */
function aw_post_class ( $classes ) {
   global $current_class;
   $classes[] = $current_class;
   $current_class = ($current_class == 'odd') ? 'even' : 'odd';
   return $classes;
}
add_filter ( 'post_class' , 'aw_post_class' );
global $current_class;
$current_class = 'odd';


/* -- Remove info from wp_head -- */
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'wp_generator' );


/* -- Editor -- */
add_editor_style();


/* -- The excerpt -- */
function aw_excerpt_length( $length ) {
	return 80;
}
add_filter( 'excerpt_length', 'aw_excerpt_length', 999 );

function aw_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'aw_excerpt_more');


/* -- Automatic feed link -- */
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'automatic-feed-links' );
}


/* -- Menu -- */
function aw_register_menu() {
	register_nav_menu('top-nav', __('Top Navigation', 'framework'));
	register_nav_menu('main-nav', __('Main Navigation', 'framework'));
}
add_action('init', 'aw_register_menu');


/* -- Custom login logo -- */
function aw_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.get_template_directory_uri().'/_assets/img/logo-login.png) !important; }
    </style>';
}
add_action('login_head', 'aw_login_logo');
function aw_login_url() {
	return site_url();
}
add_filter( 'login_headerurl', 'aw_login_url', 10, 4 );
function aw_login_title() {
	return get_bloginfo('name');
}
add_filter('login_headertitle','aw_login_title');


/* -- Browser detection -- */
function aw_browser_class($classes) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) $classes[] = 'ie';
	else $classes[] = 'unknown';
	if($is_iphone) $classes[] = 'iphone';
	return $classes;
}
add_filter('body_class','aw_browser_class');


/* -- Navigation -- */
function aw_show_posts_nav() {
	global $wp_query;
	return ($wp_query->max_num_pages > 1);
}
function aw_show_comments_nav() {
	global $wp_query;
	return ($wp_query->max_num_comment_pages > 1);
}


/* -- Theme localisation -- */
function aw_theme_language(){
	load_theme_textdomain ('framework');
}
add_action('after_setup_theme', 'aw_theme_language');


/* -- Tags: exclude 'newsinpictures' & 'sliderblog' -- */
function aw_exclude_tags($tags) {
	if(!$tags) return array();
	$newtags = array();
	foreach ($tags as $tag) {
		switch ($tag->name) {
 			case 'newsinpictures':
 			continue;
 			case 'sliderblog':
 			continue;
 			case 'featuredpost':
 			continue;
 			break;
 			default:
 			$newtags[] = $tag;
 			break;
 		}
	}
	return $newtags;
}
add_filter( 'get_the_tags', 'aw_exclude_tags');


/* -- Formatting -- */
function aw_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}
	return $new_content;
}
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');
add_filter('the_content', 'aw_formatter', 99);
add_filter('widget_text', 'aw_formatter', 99);


/* -- Disable google fonts -- */
function disable_open_sans( $translations, $text, $context, $domain )
{
	if ( 'Open Sans font: on or off' == $context && 'on' == $text ) {
		$translations = 'off';
	}
	return $translations;
}
add_filter('gettext_with_context', 'disable_open_sans', 888, 4 );


function dw_remove_open_sans() {   
	wp_deregister_style( 'open-sans' );   
	wp_register_style( 'open-sans', false );   
	wp_enqueue_style('open-sans','');   
}
add_action( 'init', 'dw_remove_open_sans' );


/* -- Content width -- */
if ( ! isset( $content_width ) ) $content_width = 940;


/* -- Post Format -- */
$formats = array( 'gallery', 'link', 'image', 'quote', 'audio', 'video' );
add_theme_support( 'post-formats', $formats ); 
add_post_type_support( 'post', 'post-formats' );
include('_functions/post-formats.php');


/* -- Shortcodes -- */
include('_functions/shortcodes.php');


/* -- Widget - Ad 120x60 -- */
include('_widgets/ad-120x60.php');


/* -- Widget - Ad 120x240 -- */
include('_widgets/ad-120x240.php');


/* -- Widget - Ad 125x125 -- */
include('_widgets/ad-125x125.php');


/* -- Widget - Ad 300x250 -- */
include('_widgets/ad-300x250.php');


/* -- Widget - Ad 300x600 -- */
include('_widgets/ad-300x600.php');


/* -- Widget - Categories -- */
include('_widgets/categories.php');


/* -- Widget - Flickr -- */
include('_widgets/flickr.php');


/* -- Widget - Latest blog posts -- */
include('_widgets/latest-blog-posts.php');


/* -- Widget - Latest & featured posts -- */
include('_widgets/latest-featured-posts.php');


/* -- Widget - News in pictures -- */
include('_widgets/news-in-pictures.php');


/* -- Widget - Slider blog -- */
include('_widgets/slider-blog.php');


/* -- Widget - Slider latest -- */
include('_widgets/slider-latest.php');


/* -- Widget - Social counter -- */
include('_widgets/social-counter.php');


/* -- Widget - Tabbed -- */
include('_widgets/tabbed.php');


/* -- Widget - Twitter -- */
include('_widgets/twitter.php');


/* -- Widget - Video -- */
include('_widgets/video.php');


/* -- Theme tab -- */
include('_admin/home.php');


/* -- Theme update -- */
include('_admin/update.php');


/** -- Login - Hide url --*/
include('_functions/login-url.php');


/** -- TinyMCE -- */
include('_functions/tinymce.php');
?>
