<?php
add_action ( "woocommerce_before_shop_loop_item_title", "after_li_started", 9 );

function after_li_started ()
{
	global $product;
	$proid = $product->get_id();
	if ( !empty( get_post_meta($proid, '_tigonwm', true) )) 
	{
		?>
		<style type="text/css">
			
				.product-block {
				    backface-visibility: hidden !important;
				    transform: translateZ(0) !important;
				}
		</style>
		<?php
    	echo '<span class="loc_label_loop_wrapper"><span class="loc_label_loop">'.get_post_meta($proid, '_tigonwm', true).'</span></span>' ;
	}
}
