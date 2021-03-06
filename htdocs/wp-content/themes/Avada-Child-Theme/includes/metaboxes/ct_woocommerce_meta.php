<?php

/**
 * woocommerce custom meta fields
 */
// display fields in admin panel
function woo_add_custom_general_fields() {
	global $woocommerce;
	global $post;
  
  	echo '<div class="options_group">';

  	$currency_symbol = get_woocommerce_currency_symbol();

  	// per month price field
	woocommerce_wp_text_input( 
		array(
			'id'                => '_monthly_price',
			'label'             => __( "Monthly Price ($currency_symbol)", 'woocommerce' ),
			'placeholder'       => '',
			'description'       => __( 'per month', 'woocommerce' ),
			'type'				=> 'number', 
			'custom_attributes'	=> array(
				'step' 	=> 'any',
				'min'	=> '0'
			),
			'value'				=> get_post_meta($post->ID, '_monthly_price', true)
		)
	);
  
  	// quote field
	woocommerce_wp_text_input( 
		array( 
			'id'			=> '_product_quote', 
			'label'			=> __( 'Quote', 'woocommerce' ), 
			'placeholder'	=> '',
			'desc_tip'		=> 'true',
			'description'	=> __( 'Enter text here without quotation marks.', 'woocommerce' ),
			'value'			=> get_post_meta($post->ID, '_product_quote', true)
		)
	);
  
  	echo '</div>';	
}
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );



// save post meta
function woo_add_custom_general_fields_save(){
	//global $woocommerce;
	global $post;

	$woocommerce_monthly_price = $_POST['_monthly_price'];

	if( isset($woocommerce_monthly_price) && !empty($woocommerce_monthly_price) ) {
		add_post_meta( $post->ID, '_monthly_price', esc_attr( $woocommerce_monthly_price ), true ) || update_post_meta( $post->ID, '_monthly_price', esc_attr( $woocommerce_monthly_price ) );
	}
		
	
	$woocommerce_product_quote = $_POST['_product_quote'];

	if( isset($woocommerce_product_quote) && !empty($woocommerce_product_quote) ) {
		add_post_meta( $post->ID, '_product_quote', esc_attr( $woocommerce_product_quote ), true ) || update_post_meta( $post->ID, '_product_quote', esc_attr( $woocommerce_product_quote ) );
	}
}
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );

?>