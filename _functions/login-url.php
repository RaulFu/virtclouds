<?php

/**
* ���ص�¼url
*/
function login_protection(){
	$authors = array("paul", "raul");
	if(!in_array($_GET['author'], $authors))
		header('Location: '.home_url());
}
add_action('login_enqueue_scripts','login_protection');

?>
