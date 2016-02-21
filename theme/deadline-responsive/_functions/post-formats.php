<?php

/* -- Define metabox fields -- */
$prefix = 'aw';

$meta_box_quote = array(
	'id' => 'aw-meta-box-quote',
	'title' =>  __('Quote settings', 'framework'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Quote','framework'),
			'desc' => __('Enter your quote','framework'),
			'id' => $prefix.'_quote',
			'type' => 'textarea'
		),
	),
);

$meta_box_link = array(
	'id' => 'aw-meta-box-link',
	'title' =>  __('Link settings', 'framework'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Link URL','framework'),
			'desc' => __('The full URL (including http://)','framework'),
			'id' => $prefix.'_link_url',
			'type' => 'text'
		),
	),
);

$meta_box_audio = array(
	'id' => 'aw-meta-box-audio',
	'title' =>  __('Audio settings', 'framework'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('MP3 File URL','framework'),
			'desc' => __('The full URL (including http://) to the mp3 file','framework'),
			'id' => $prefix.'_audio_mp3',
			'type' => 'text'
		),
		array(
			'name' => __('OGG File URL','framework'),
			'desc' => __('The full URL (including http://) to the ogg file','framework'),
			'id' => $prefix.'_audio_ogg',
			'type' => 'text'
		)
	),
);

$meta_box_video = array(
	'id' => 'aw-meta-box-video',
	'title' =>  __('Video settings', 'framework'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('M4V File URL','framework'),
			'desc' => __('The full URL (including http://) to the m4v file','framework'),
			'id' => $prefix.'_video_m4v',
			'type' => 'text'
		),
		array(
			'name' => __('OGV File URL','framework'),
			'desc' => __('The full URL (including http://) to the ogv file','framework'),
			'id' => $prefix.'_video_ogv',
			'type' => 'text'
		),
		array(
			'name' => __('Embedded Code','framework'),
			'desc' => __('If you\'re not using self hosted video then you can include embedded code here. Best viewed at 730px wide.','framework'),
			'id' => $prefix.'_video_embed',
			'type' => 'textarea'
		)
	)
);


/* -- Add metabox to edit page -- */
function aw_add_posts_box() {
	global $meta_box_quote, $meta_box_link, $meta_box_audio, $meta_box_video;
	add_meta_box($meta_box_quote['id'], $meta_box_quote['title'], 'aw_show_box_quote', $meta_box_quote['page'], $meta_box_quote['context'], $meta_box_quote['priority']);
	add_meta_box($meta_box_link['id'], $meta_box_link['title'], 'aw_show_box_link', $meta_box_link['page'], $meta_box_link['context'], $meta_box_link['priority']);
	add_meta_box($meta_box_audio['id'], $meta_box_audio['title'], 'aw_show_box_audio', $meta_box_audio['page'], $meta_box_audio['context'], $meta_box_audio['priority']);
	add_meta_box($meta_box_video['id'], $meta_box_video['title'], 'aw_show_box_video', $meta_box_video['page'], $meta_box_video['context'], $meta_box_video['priority']);
}
add_action('admin_menu', 'aw_add_posts_box');


/* -- Show fields in meta box -- */
function aw_show_box_quote() {
	global $meta_box_quote, $post;
	echo '<input type="hidden" name="aw_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	echo '<table class="form-table">';
	foreach ($meta_box_quote['fields'] as $field) {
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
			case 'textarea':
			echo '<tr>',
				 '<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				 '<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '</textarea>';
			break;
		}
	}
	echo '</table>';
}

function aw_show_box_link() {
	global $meta_box_link, $post;
	echo '<input type="hidden" name="aw_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	echo '<table class="form-table">';
	foreach ($meta_box_link['fields'] as $field) {
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
			case 'text':
			echo '<tr>',
				 '<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="display:block; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				 '<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:100%; margin-right: 20px; float:left;" />';
			break;
		}
	}
	echo '</table>';
}

function aw_show_box_audio() {
	global $meta_box_audio, $post;
	echo '<p style="padding:10px 0 0 10px;">'.__('Note: you must supply both MP3 and OGG files to satisfy all browsers.', 'framework').'</p>';
	echo '<input type="hidden" name="aw_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	echo '<table class="form-table">';
	foreach ($meta_box_audio['fields'] as $field) {
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
			case 'text':
			echo '<tr>',
				 '<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="display:block; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				 '<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:100%; margin-right: 20px; float:left;" />';
			break;
			case 'textarea':
			echo '<tr>',
				 '<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				 '<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '</textarea>';
			break;
		}
	}
	echo '</table>';
}

function aw_show_box_video() {
	global $meta_box_video, $post;
	echo '<p style="padding:10px 0 0 10px;">'.__('Note: you must supply both M4V and OGV files to satisfy all browsers.', 'framework').'</p>';
	echo '<input type="hidden" name="aw_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	echo '<table class="form-table">';
	foreach ($meta_box_video['fields'] as $field) {
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
			case 'text':
			echo '<tr>',
				 '<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="display:block; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				 '<td>';
			echo '<input type="text" name="' , $field['id'], '" id="' , $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:100%; margin-right: 20px; float:left;" />';
			break;
			case 'textarea':
			echo '<tr>',
				 '<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				 '<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '</textarea>';
			break;
		}
	}
	echo '</table>';
}


/* -- Save data -- */
function aw_save_data($post_id) {
	global $meta_box_quote, $meta_box_link, $meta_box_audio, $meta_box_video;
	if (!wp_verify_nonce($_POST['aw_meta_box_nonce'], basename(__FILE__))) return $post_id;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	foreach ($meta_box_quote['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	foreach ($meta_box_link['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	foreach ($meta_box_audio['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'],stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	foreach ($meta_box_video['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}
add_action('save_post', 'aw_save_data');

?>