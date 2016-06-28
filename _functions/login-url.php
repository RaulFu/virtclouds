<?php

/**
* าþฒุตวยผurl
*/
function login_protection(){
	$authors = array("paul", "raul");
	if(!in_array($_GET['author'], $authors))
		header('Location: http://www.virtclouds.com/');
}
add_action('login_enqueue_scripts','login_protection');

?>