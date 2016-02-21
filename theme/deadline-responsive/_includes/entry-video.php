<!-- BEGIN .entry-video -->
<div class="entry-video" id="video-<?php the_ID(); ?>">

	<?php 
	$aw_video_embed = get_post_meta(get_the_ID(), 'aw_video_embed', true);
	$aw_video_m4v = get_post_meta(get_the_ID(), 'aw_video_m4v', true);
	$aw_video_ogv = get_post_meta(get_the_ID(), 'aw_video_ogv', true);
	$aw_video_poster_id = get_post_thumbnail_id();
	$aw_video_poster = wp_get_attachment_image_src($aw_video_poster_id, 'single-project-thumbnail');
	$aw_video_poster = $aw_video_poster[0];
	?>
	
	<?php if($aw_video_embed == '') : ?>
	
	<!--[if lte IE 8 ]>	
	<script>
		jQuery(document).ready(function($){
			$("#jquery_jplayer_<?php the_ID(); ?>").jPlayer({
				ready: function (event) {
					$(this).jPlayer("setMedia", {
						m4v: "<?php echo $aw_video_m4v; ?>",
						ogv: "<?php echo $aw_video_ogv; ?>",
						poster: "<?php echo $aw_video_poster; ?>"
					});
				},
				swfPath: "<?php echo get_template_directory_uri(); ?>/_assets/js/jplayer.swf",
				supplied: "m4v, ogv",
				cssSelectorAncestor: "#jp_container_<?php the_ID(); ?>",
				size: {
					width: "100%",
					height: "350px"
				}
			});
		});
	</script>
	<![endif]-->
	
	<!--[if (gt IE 8)|!(IE)]><!-->	
	<script>
		jQuery(document).ready(function($){
			$("#jquery_jplayer_<?php the_ID(); ?>").jPlayer({
				ready: function (event) {
					$(this).jPlayer("setMedia", {
						m4v: "<?php echo $aw_video_m4v; ?>",
						ogv: "<?php echo $aw_video_ogv; ?>",
						poster: "<?php echo $aw_video_poster; ?>"
					});
				},
				swfPath: "<?php echo get_template_directory_uri(); ?>/_assets/js/jplayer.swf",
				supplied: "m4v, ogv",
				cssSelectorAncestor: "#jp_container_<?php the_ID(); ?>",
				size: {
					width: "100%",
					height: "auto"
				}
			});
		});
	</script>
	<!--<![endif]-->
	
	<!-- BEGIN .jp-video -->
	<div id="jp_container_<?php the_ID(); ?>" class="jp-video">
	
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
							<li><a href="javascript:;" class="jp-play" tabindex="1">Play</a></li>
							<li><a href="javascript:;" class="jp-pause" tabindex="1">Pause</a></li>
							<li><a href="javascript:;" class="jp-mute" tabindex="1">Mute</a></li>
							<li><a href="javascript:;" class="jp-unmute" tabindex="1">Unmute</a></li>
						</ul>
						<div class="jp-volume-bar">
							<div class="jp-volume-bar-value"></div>
						</div>
						<ul class="jp-toggles">
							<li><a href="javascript:;" class="jp-full-screen" tabindex="1">Enter fullscreen</a></li>
							<li><a href="javascript:;" class="jp-restore-screen" tabindex="1">Exit fullscreen</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<!-- END .jp-video -->
	
	<?php else : ?>
	
	<?php echo stripslashes(htmlspecialchars_decode($aw_video_embed)); ?>
	
	<?php endif; ?>

</div>
<!-- END .entry-video -->