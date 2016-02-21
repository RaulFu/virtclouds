<?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) : ?>
		
<!-- BEGIN .entry-thumb -->
<div class="entry-thumb audio-thumb">
	
	<?php if (is_singular()) : ?>
	
	<?php the_post_thumbnail('single-project-thumbnail'); ?>
	
	<?php else : ?>
	
	<a class="image-link" href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'framework'), get_the_title()); ?>"><?php the_post_thumbnail('single-post-thumbnail'); ?></a>
	
	<?php endif; ?>
	
</div>
<!-- END .entry-thumb -->
	
<?php endif; ?>

<!-- BEGIN .entry-audio -->
<div class="entry-audio">

	<?php
	$aw_audio_mp3 =  get_post_meta(get_the_ID(), 'aw_audio_mp3', true);
	$aw_audio_ogg =  get_post_meta(get_the_ID(), 'aw_audio_ogg', true);
	?>
	
	<script>
		jQuery(document).ready(function($){
			$("#jquery_jplayer_<?php the_ID(); ?>").jPlayer({
				ready: function (event) {
					$(this).jPlayer("setMedia", {
						mp3: "<?php echo $aw_audio_mp3; ?>",
						oga: "<?php echo $aw_audio_ogg; ?>"
					});
				},
				swfPath: "<?php echo get_template_directory_uri(); ?>/_assets/js/jplayer.swf",
				supplied: "mp3, oga",
				cssSelectorAncestor: "#jp_container_<?php the_ID(); ?>",
				wmode: "window"
			});
		});
	</script>
	
	<!-- BEGIN .jp-audio -->
	<div id="jp_container_<?php the_ID(); ?>" class="jp-audio">
	
		<div class="jp-type-single">
			<div id="jquery_jplayer_<?php the_ID(); ?>" class="jp-jplayer"></div>
			<div class="jp-gui">
				<div class="jp-interface">
					<div class="jp-progress">
						<div class="jp-seek-bar">
							<div class="jp-play-bar"></div>
						</div>
					</div>
					<div class="jp-controls-holder">
						<div class="jp-time"><span class="jp-current-time"></span> / <span class="jp-duration"></span></div>
						<ul class="jp-controls">
							<li><a href="javascript:;" class="jp-play" tabindex="1">Play></a></li>
							<li><a href="javascript:;" class="jp-pause" tabindex="1">Pause</a></li>
							<li><a href="javascript:;" class="jp-mute" tabindex="1">Mute</a></li>
							<li><a href="javascript:;" class="jp-unmute" tabindex="1">Unmute</a></li>
						</ul>
						<div class="jp-volume-bar">
							<div class="jp-volume-bar-value"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<!-- END .jp-audio -->

</div>
<!-- END .entry-audio -->