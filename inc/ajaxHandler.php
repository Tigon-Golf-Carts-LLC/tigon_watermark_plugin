<?php
function add_watermark(){
	Global $wpdb;
	$tigonwm_watermarks = 'tigonwm_watermarks';
    $watermark          = $_POST['watermark'];

    $wpdb->query($wpdb->prepare("INSERT INTO $tigonwm_watermarks (`watermark`) VALUES (%s)", $watermark ));	

    wp_die();
}
add_action('wp_ajax_add_watermark', 'add_watermark');
add_action('wp_ajax_nopriv_add_watermark', 'add_watermark');




function update_watermark(){
    Global $wpdb;
    $tigonwm_watermarks = 'tigonwm_watermarks';
    $watermark = $_GET['watermark'];
    $crntid    = $_GET['crntid'];

    $wpdb->query($wpdb->prepare("UPDATE $tigonwm_watermarks SET watermark=%s WHERE id=%d",
    $watermark, $crntid ));
    wp_die();
}
add_action('wp_ajax_update_watermark', 'update_watermark');
add_action('wp_ajax_nopriv_update_watermark', 'update_watermark');



function date_watermark(){
    Global $wpdb;
    $tigonwm_watermarks = 'tigonwm_watermarks';
    $crntid = $_GET['crntid'];

    $wpdb->query($wpdb->prepare("DELETE FROM $tigonwm_watermarks WHERE id=%d", $crntid ));
    wp_die();
}
add_action('wp_ajax_date_watermark', 'date_watermark');
add_action('wp_ajax_nopriv_date_watermark', 'date_watermark');