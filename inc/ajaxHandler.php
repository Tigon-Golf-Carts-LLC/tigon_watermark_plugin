<?php
function add_watermark(){
    if ( ! current_user_can('manage_options') ) {
        wp_die('Unauthorized', 403);
    }

    Global $wpdb;
    $tigonwm_watermarks = 'tigonwm_watermarks';
    $watermark = isset($_POST['watermark']) ? sanitize_text_field($_POST['watermark']) : '';

    if ( empty($watermark) ) {
        wp_die('Missing watermark text', 400);
    }

    $wpdb->query($wpdb->prepare("INSERT INTO $tigonwm_watermarks (`watermark`) VALUES (%s)", $watermark ));

    wp_die();
}
add_action('wp_ajax_add_watermark', 'add_watermark');


function update_watermark(){
    if ( ! current_user_can('manage_options') ) {
        wp_die('Unauthorized', 403);
    }

    Global $wpdb;
    $tigonwm_watermarks = 'tigonwm_watermarks';
    $watermark = isset($_GET['watermark']) ? sanitize_text_field($_GET['watermark']) : '';
    $crntid    = isset($_GET['crntid']) ? intval($_GET['crntid']) : 0;

    if ( empty($watermark) || empty($crntid) ) {
        wp_die('Missing parameters', 400);
    }

    $wpdb->query($wpdb->prepare("UPDATE $tigonwm_watermarks SET watermark=%s WHERE id=%d",
    $watermark, $crntid ));
    wp_die();
}
add_action('wp_ajax_update_watermark', 'update_watermark');


function date_watermark(){
    if ( ! current_user_can('manage_options') ) {
        wp_die('Unauthorized', 403);
    }

    Global $wpdb;
    $tigonwm_watermarks = 'tigonwm_watermarks';
    $crntid = isset($_GET['crntid']) ? intval($_GET['crntid']) : 0;

    if ( empty($crntid) ) {
        wp_die('Missing parameters', 400);
    }

    $wpdb->query($wpdb->prepare("DELETE FROM $tigonwm_watermarks WHERE id=%d", $crntid ));
    wp_die();
}
add_action('wp_ajax_date_watermark', 'date_watermark');
