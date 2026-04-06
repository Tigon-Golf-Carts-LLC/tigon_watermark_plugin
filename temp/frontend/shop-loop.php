<?php
add_action ( "woocommerce_before_shop_loop_item_title", "after_li_started", 9 );

function after_li_started ()
{
	global $product, $wpdb;
	$proid = $product->get_id();
	$watermark_text = get_post_meta($proid, '_tigonwm', true);
	if ( !empty( $watermark_text ))
	{
		// Look up the watermark ID from the database
		$watermark_row = $wpdb->get_row($wpdb->prepare(
			"SELECT id FROM tigonwm_watermarks WHERE watermark = %s LIMIT 1",
			$watermark_text
		));
		$watermark_id = $watermark_row ? intval($watermark_row->id) : 0;
		?>
		<style type="text/css">

				.product-block {
				    backface-visibility: hidden !important;
				    transform: translateZ(0) !important;
				}
		</style>
		<?php
    	echo '<span class="loc_label_loop_wrapper" data-watermark-id="' . esc_attr($watermark_id) . '" id="tigonwm-' . esc_attr($watermark_id) . '"><span class="loc_label_loop">' . esc_html($watermark_text) . '</span></span>';
	}
}
