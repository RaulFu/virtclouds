<?php
global $options;

foreach ($options as $value) {
	
	if(!isset($value['id'])) continue;
    
    if (get_option( $value['id'] ) === FALSE) {
    	$$value['id'] = (isset($value['std']) ? $value['std'] : null);
    } else { 
    	$$value['id'] = get_option( $value['id'] );
    }

}
?>