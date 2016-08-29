<?php
/**
*  rename upload file name
**/
function aw_wp_handle_upload_prefilter($file){
    $time = date("YmdHis");
    $file['name'] = $time.floor(microtime()*1000).".".pathinfo($file['name'],PATHINFO_EXTENSION);
    return $file;
}

add_filter('wp_handle_upload_prefilter', 'aw_wp_handle_upload_prefilter');

?>
