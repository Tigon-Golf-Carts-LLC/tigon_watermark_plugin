<?php
function tigonwm_save_label_cart( $cart_item_data, $product_id, $variation_id, $quantity ) 
{
	if( ! empty( $_POST['_tigonwm_location'] ) ) 
	{
		// Add the item data
		$cart_item_data['_tigonwm_location'] = $_POST['_tigonwm_location'];
	}
	return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'tigonwm_save_label_cart', 10, 4 );

function tigonwm_display_label( $name, $cart_item, $cart_item_key ) 
{
	if( isset( $cart_item['_tigonwm_location'] ) ) 
	{
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $cart_item['product_id'] ), 'single-post-thumbnail' );
                              
		$name .= '<div class="mini_thumb"><img src="'.$image[0].'"><div class="loc_label">'. $cart_item['_tigonwm_location'].'</div></div>';
	}
	return $name;
}
add_filter( 'woocommerce_cart_item_name', 'tigonwm_display_label', 10, 3 );


function cfwc_add_custom_data_to_order( $item, $cart_item_key, $values, $order ) {
 	foreach( $item as $cart_item_key=>$values ) 
 	{
		if( isset( $values['_tigonwm_location'] ) ) 
		{
			$item->add_meta_data( __( 'Locatio Selected', 'cfwc' ), $values['_tigonwm_location'], true );
		}
	}
}
add_action( 'woocommerce_checkout_create_order_line_item', 'cfwc_add_custom_data_to_order', 10, 4 );
