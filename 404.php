<?php
header('HTTP/1.1 404 Not Found');
header('Status: 404 Not Found');
include( TEMPLATEPATH . '/_admin/get-options.php' );
get_header();
?>

<?php if ($aw_sidebar_position == 'left') get_sidebar(); ?>

<!-- BEGIN .grid-8 -->
<div class="grid-8">
	
	<!-- BEGIN .post -->
	<div class="post">
			
		<script type="text/javascript" src="http://www.qq.com/404/search_children.js" charset="utf-8" homePageUrl="http://virtclouds.com/" homePageName="回到云计算开发学习门户"></script>

	</div>
	<!-- END .post -->
	
</div>
<!-- END .grid-8 -->

<?php if ($aw_sidebar_position == 'right') get_sidebar(); ?>

<div class="clear"></div>	

<?php get_footer(); ?>
