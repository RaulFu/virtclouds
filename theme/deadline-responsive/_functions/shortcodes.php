<?php

/* -- Shortcodes in widgets -- */
add_filter('widget_text', 'do_shortcode');


/* -- Alert -- */
function aw_alert($atts, $content = null) {
	extract(shortcode_atts(array(
		'color' => ''
	), $atts));
	$output = '<div class="alert margin-20 '.$color.'">'.do_shortcode($content).'</div>';
	return $output;
}
add_shortcode('alert', 'aw_alert');


/* -- Button -- */
function aw_button($atts, $content = null) {
	extract(shortcode_atts(array(
		'url' => '',
		'color' => '',
		'icon' => '',
		'size' => 'small'
	), $atts));
	$output = '<a href="'.$url.'" class="button '.$color.' '.$size.'">';
	if ($icon != '') $output .= '<i class="'.$icon.'"></i> ';
	$output .= $content;
	$output .= '</a>';
	return $output;
}
add_shortcode('button', 'aw_button');


/* -- Columns -- */

	/* -- One Half -- */
	function aw_one_half($atts, $content = null) {
		$output = '<div class="one-half">';
		$output .= do_shortcode($content);
		$output .= '</div>';
		return $output;
	}
	add_shortcode('one_half', 'aw_one_half');
	
	/* -- One Half (Last) -- */
	function aw_one_half_last($atts, $content = null) {
		$output = '<div class="one-half last">';
		$output .= do_shortcode($content);
		$output .= '</div>';
		$output .= '<div class="clear"></div>';
		return $output;
	}
	add_shortcode('one_half_last', 'aw_one_half_last');
	
	/* -- One Third -- */
	function aw_one_third($atts, $content = null) {
		$output = '<div class="one-third">';
		$output .= do_shortcode($content);
		$output .= '</div>';
		return $output;
	}
	add_shortcode('one_third', 'aw_one_third');
	
	/* -- One Third (Last) -- */
	function aw_one_third_last($atts, $content = null) {
		$output = '<div class="one-third last">';
		$output .= do_shortcode($content);
		$output .= '</div>';
		$output .= '<div class="clear"></div>';
		return $output;
	}
	add_shortcode('one_third_last', 'aw_one_third_last');
	
	/* -- Two Thirds -- */
	function aw_two_third($atts, $content = null) {
		$output = '<div class="two-third">';
		$output .= do_shortcode($content);
		$output .= '</div>';
		return $output;
	}
	add_shortcode('two_third', 'aw_two_third');
	
	/* -- Two Thirds (Last) -- */
	function aw_two_third_last($atts, $content = null) {
		$output = '<div class="two-third last">';
		$output .= do_shortcode($content);
		$output .= '</div>';
		$output .= '<div class="clear"></div>';
		return $output;
	}
	add_shortcode('two_third_last', 'aw_two_third_last');
	
	/* -- One Fourth -- */
	function aw_one_fourth($atts, $content = null) {
		$output = '<div class="one-fourth">';
		$output .= do_shortcode($content);
		$output .= '</div>';
		return $output;
	}
	add_shortcode('one_fourth', 'aw_one_fourth');
	
	/* -- One Fourth (Last) -- */
	function aw_one_fourth_last($atts, $content = null) {
		$output = '<div class="one-fourth last">';
		$output .= do_shortcode($content);
		$output .= '</div>';
		$output .= '<div class="clear"></div>';
		return $output;
	}
	add_shortcode('one_fourth_last', 'aw_one_fourth_last');
	
	/* -- Three Fourths -- */
	function aw_three_fourth($atts, $content = null) {
		$output = '<div class="three-fourth">';
		$output .= do_shortcode($content);
		$output .= '</div>';
		return $output;
	}
	add_shortcode('three_fourth', 'aw_three_fourth');
	
	/* -- Three Fourths (Last) -- */
	function aw_three_fourth_last($atts, $content = null) {
		$output = '<div class="three-fourth last">';
		$output .= do_shortcode($content);
		$output .= '</div>';
		$output .= '<div class="clear"></div>';
		return $output;
	}
	add_shortcode('three_fourth_last', 'aw_three_fourth_last');
	
	/* -- One Sixth -- */
	function aw_one_sixth($atts, $content = null) {
		$output = '<div class="one-sixth">';
		$output .= do_shortcode($content);
		$output .= '</div>';
		return $output;
	}
	add_shortcode('one_sixth', 'aw_one_sixth');
	
	/* -- One Sixth (Last) -- */
	function aw_one_sixth_last($atts, $content = null) {
		$output = '<div class="one-sixth last">';
		$output .= do_shortcode($content);
		$output .= '</div>';
		$output .= '<div class="clear"></div>';
		return $output;
	}
	add_shortcode('one_sixth_last', 'aw_one_sixth_last');


/* -- Dropcap -- */
function aw_dropcap($atts, $content = null) {
	$output = '<span class="dropcap">'.$content.'</span>';
	return $output;
}
add_shortcode('dropcap', 'aw_dropcap');


/* -- Google Maps -- */
function aw_google_maps($atts, $content = null) {
   	extract(shortcode_atts(array(
		'address'  => '',
		'color'  => 'red',
		'zoom' => '15',
		'height' => '200',
		'width' => '',
		'id' => '1',
		'popuptext' => '',
		'popupstate' => 'false',
		'controls' => 'false',
		'scrollwheel' => 'false'
	), $atts));
	$output = '<script>';
	$output .= 'jQuery(function($) {';
	$output .= '$("#google-maps-'.$id.'").gMap({';
	if($controls == 'false') $output .= 'controls: false,';
	if($scrollwheel == 'false') $output .= 'scrollwheel: false,';
	$output .= 'markers: [{';
	$output .= 'address: "'.$address.'",';
	if($popuptext != '') $output .= 'html: "'.$popuptext.'", popup: '.$popupstate.',';
	$output .= 'icon: {';
	$output .= 'image: "'.get_template_directory_uri().'/_assets/img/_colors/'.$color.'/pin.png",';
    $output .= 'iconsize: [32, 32],';
    $output .= 'iconanchor: [16,27],';
    $output .= 'infowindowanchor: [16, 27]';
    $output .= '}';
	$output .= '}],';
    $output .= 'address: "'.$address.'",';
    $output .= 'zoom: '.$zoom.',';
    $output .= 'icon: {';
    $output .= 'image: "'.get_template_directory_uri().'/_assets/img/_colors/'.$color.'/pin.png",';
    $output .= 'iconsize: [32, 32],';
    $output .= 'iconanchor: [16,27],';
    $output .= 'infowindowanchor: [16, 27]';
    $output .= '}';
    $output .= '});';
    $output .= '});';
    $output .= '</script>';
    if($width == '') { $output .= '<div id="google-maps-'.$id.'" class="google-maps" style="width: 100%; height: '.$height.'px;"></div>'; }
    else { $output .= '<div id="google-maps-'.$id.'" class="google-maps" style="width: '.$width.'px; height: '.$height.'px;"></div>'; }
	return $output;
}
add_shortcode('map', 'aw_google_maps');


/* -- Highlight -- */
function aw_highlight($atts, $content = null) {
	$output = '<span class="highlight">'.do_shortcode($content).'</span>';
	return $output;
}
add_shortcode('highlight', 'aw_highlight');


/* -- List -- */
function aw_list($atts, $content = null) {
	extract(shortcode_atts(array(
		'color' => ''
	), $atts));
	$output = '<div class="list '.$color.'">'.do_shortcode($content).'</div>';
	return $output;
}
add_shortcode('list', 'aw_list');


/* -- Tabs -- */

	/* -- Titles -- */
	global $tabs_array, $tabs_count;
	$tabs_count = 0;
	function aw_tabs($atts, $content = null) {
		global $tabs_array, $tabs_count;
		do_shortcode($content);
		$output = '';
		if(is_array($tabs_array)) {
			$a = 0;
			$b = 0;
			$output .= '<div class="tabs">';
			$output .= '<ul class="nav clearfix">';
			foreach( $tabs_array as $tab ) {
				$a++;
				$output .= '<li class="' . ( ( $a == 1 ) ? 'first' : '' ) . '"><a title="' . $tab['title'] . '" href="#tab-' . $a . '">' . $tab['title'] . '</a></li>';
			}
			$output .= '</ul>';
			foreach($tabs_array as $tab) {
				$b++;
				$output .= '<div class="tab" id="tab-' . $b . '">' . do_shortcode( $tab['content'] ) .'</div>';
			}
			$output .= '</div>';
			return $output;
		}
	}
	add_shortcode('tabs', 'aw_tabs');
	
	/* -- Tab -- */
	function aw_tab($atts, $content = null) {
		global $tabs_array, $tabs_count;
		extract(shortcode_atts(array(
			'title' => ''
		), $atts));
		$tabs_array[] = array(
			'title' => $title,
			'content' => do_shortcode($content)
		);
		$tabs_count++;
	}
	add_shortcode('tab', 'aw_tab');


/* -- Toggle -- */
function aw_toggle($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => '',
		"state" => 'closed'
	), $atts));
	$output = '<div class="toggle '.$state.'">';
	$output .= '<span class="toggle-title">'.$title.'<span class="toggle-icon"></span></span>';
	$output .= '<div class="toggle-content">'.do_shortcode($content).'</div>';
	$output .= '</div>';
	return $output;
}
add_shortcode('toggle', 'aw_toggle');


/* -- Tooltip -- */
function aw_tooltip($atts, $content = null) {
	extract(shortcode_atts(array(
		"text" => ''
	), $atts));
	$output = '<span class="tooltip">';
	$output .= '<strong>'.do_shortcode($content).'</strong>';
	$output .= '<span class="tooltip-box">'.$text.'<span class="tooltip-arrow"></span></span>';
	$output .= '</span>';
	return $output;
}
add_shortcode('tooltip', 'aw_tooltip');


/* -- Videos -- */
	
	/* -- Custom Player -- */
	function aw_video($atts, $content = null) {
	   extract(shortcode_atts(array(
			'id'  => '1',
			'm4v' => '',
			'ogv' => '',
			'img' => ''
		), $atts));
		$output = '<div class="entry-video margin-20" id="video-'.$id.'">';
		$output .= '<script>';
		$output .= 'jQuery(document).ready(function($){';
		$output .= '$("#jquery_jplayer_'.$id.'").jPlayer({';
		$output .= 'ready: function (event) {';
		$output .= '$(this).jPlayer("setMedia", {';
		$output .= 'm4v: "'.$m4v.'",';
		$output .= 'ogv: "'.$ogv.'",';
		$output .= 'poster: "'.$img.'"';
		$output .= '});';
		$output .= '},';
		$output .= 'swfPath: "'.get_template_directory_uri().'/_assets/js/jplayer.swf",';
		$output .= 'supplied: "m4v, ogv",';
		$output .= 'cssSelectorAncestor: "#jp_container_'.$id.'",';
		$output .= 'size: {';
		$output .= 'width: "100%",';
		$output .= 'height: "auto"';
		$output .= '}';
		$output .= '});';
		$output .= '});';
		$output .= '</script>';
		$output .= '<div id="jp_container_'.$id.'" class="jp-video">';
		$output .= '<div class="jp-type-single">';
		$output .= '<div id="jquery_jplayer_'.$id.'" class="jp-jplayer"></div>';
		$output .= '<div class="jp-gui">';
		$output .= '<div class="jp-interface">';
		$output .= '<div class="jp-progress">';
		$output .= '<div class="jp-seek-bar">';
		$output .= '<div class="jp-play-bar"></div>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '<div class="jp-controls-holder">';
		$output .= '<div class="jp-time"><span class="jp-current-time"></span> / <span class="jp-duration"></span></div>';
		$output .= '<ul class="jp-controls">';
		$output .= '<li><a href="javascript:;" class="jp-play" tabindex="1">Play</a></li>';
		$output .= '<li><a href="javascript:;" class="jp-pause" tabindex="1">Pause</a></li>';
		$output .= '<li><a href="javascript:;" class="jp-mute" tabindex="1">Mute</a></li>';
		$output .= '<li><a href="javascript:;" class="jp-unmute" tabindex="1">Unmute></a></li>';
		$output .= '</ul>';
		$output .= '<div class="jp-volume-bar">';
		$output .= '<div class="jp-volume-bar-value"></div>';
		$output .= '</div>';
		$output .= '<ul class="jp-toggles">';
		$output .= '<li><a href="javascript:;" class="jp-full-screen" tabindex="1">Enter fullscreen</a></li>';
		$output .= '<li><a href="javascript:;" class="jp-restore-screen" tabindex="1">Exit fullscreen</a></li>';
		$output .= '</ul>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode('video', 'aw_video');
	
	/* -- Vimeo -- */
	function aw_vimeo($atts, $content = null) {
	   	extract(shortcode_atts(array(
			'id'  => '',
			'width'  => '590',
			'height' => '355'
		), $atts));
		$output = '<div class="entry-video margin-20">';
		$output .= '<iframe src="http://player.vimeo.com/video/'.$id.'?title=0&amp;byline=0&amp;portrait=0" width="'.$width.'" height="'.$height.'"></iframe>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode('vimeo', 'aw_vimeo');

	/* -- YouTube -- */
	function aw_youtube($atts, $content = null) {
	   	extract(shortcode_atts(array(
			'id'  => '',
			'width'  => '590',
			'height' => '355'
		), $atts));
		$output = '<div class="entry-video margin-20">';
		$output .= '<object type="application/x-shockwave-flash" height="'.$height.'" width="'.$width.'" data="http://www.youtube.com/v/'.$id.'&amp;hl=en_US&amp;fs=0&amp;"><param name="movie" value="http://www.youtube.com/v/'.$id.'&amp;hl=en_US&amp;fs=0&amp;" /></object>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode('youtube', 'aw_youtube');
	
?>