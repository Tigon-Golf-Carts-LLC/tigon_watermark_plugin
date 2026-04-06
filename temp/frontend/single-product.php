<?php
add_action( 'woocommerce_before_add_to_cart_button', 'propage_show_location' );
function propage_show_location(){
	global $product, $wpdb;
	$crntid = $product->get_id();
	$watermark_text = get_post_meta($crntid, '_tigonwm', true);

	if ( !empty( $watermark_text ))
	{
		// Look up the watermark ID from the database
		$watermark_row = $wpdb->get_row($wpdb->prepare(
			"SELECT id FROM tigonwm_watermarks WHERE watermark = %s LIMIT 1",
			$watermark_text
		));
		$watermark_id = $watermark_row ? intval($watermark_row->id) : 0;
		?>

		<input type="hidden" name="_tigonwm_location" class="_tigonwm_location" value="<?=esc_attr($watermark_text)?>">
		<input type="hidden" name="_tigonwm_location_id" class="_tigonwm_location_id" value="<?=esc_attr($watermark_id)?>">
		<script type="text/javascript">
			jQuery( document ).ready(function(){
				var location = jQuery('._tigonwm_location').val();
				var locationId = jQuery('._tigonwm_location_id').val();
				jQuery('.woocommerce-product-gallery').append('<div class="loc_label" data-watermark-id="'+locationId+'" id="tigonwm-'+locationId+'">'+location+'</div>');
			});
		</script>
		<?php
	}
}