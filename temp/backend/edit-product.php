<?php
add_action( 'woocommerce_product_options_general_product_data', 'tphwp_add_product_options' );
function tphwp_add_product_options () 
{
	Global $wpdb;
	$tigonwm_watermarks = 'tigonwm_watermarks';
	$all_wm = $wpdb->get_results($wpdb->prepare("SELECT * from {$tigonwm_watermarks}" ));
	$option = [];
	foreach ( $all_wm as $wm ) 
	{
		$option[$wm->watermark] = $wm->watermark;
	}
	woocommerce_wp_select(array(
	    'id'      => '_tigonwm',
	    'label'   => __('Select Store Location', 'woocommerce'),
	    'options' => $option
	));
}


add_action( 'woocommerce_process_product_meta', 'tphwp_save_product_options' );
function tphwp_save_product_options($post_id)
{
    $_tigonwm = $_POST['_tigonwm'];
    if ( !empty($_tigonwm) )
        update_post_meta($post_id, '_tigonwm', esc_attr($_tigonwm));
}