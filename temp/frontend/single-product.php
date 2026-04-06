<?php
add_action( 'woocommerce_before_add_to_cart_button', 'propage_show_location' );
function propage_show_location(){
	global $product;
	$crntid = $product->get_id();

	if ( !empty( get_post_meta($crntid, '_tigonwm', true) )) 
	{
		?>

		<input type="hidden" name="_tigonwm_location" class="_tigonwm_location" value="<?=get_post_meta($crntid, '_tigonwm', true)?>">
		<script type="text/javascript">
			jQuery( document ).ready(function(){
				var location = jQuery('._tigonwm_location').val();
				jQuery('.woocommerce-product-gallery').append('<div class="loc_label">'+location+'</div>');
			});
		</script>
		<?php
	}	
}