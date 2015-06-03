<?php

function ct_woo_product_func( $atts ) {
	global $woocommerce;

	$atts = shortcode_atts( array(
		'id' => 0
	), $atts, 'ct_woo_product' );

	if(class_exists(WC_Product)) {
		$product = new WC_Product($atts['id']);		

		$title 			= $product->get_title();
		$features_img 	= $product->get_image();
		$currency 		= get_woocommerce_currency_symbol();
		$monthly_price 	= get_post_meta($atts['id'], '_monthly_price', true);
		$quote 			= get_post_meta($atts['id'], '_product_quote', true);
		$description 	= apply_filters( 'the_content', get_post($atts['id'])->post_content );


		ob_start();

		// a lot of this is markup generated by the theme shortcodes to save time when i had to rebuild it using woocommerce.
		?>

		<div class="fusion-title title fusion-title-size-two no-border center">
			<h2 class="title-heading-left" data-fontsize="28" data-lineheight="27"><?php echo $title; ?></h2>
			<div class="title-sep-container">
				<div class="title-sep sep-none"></div>
			</div>
		</div>

		<div class="fusion-sep-clear"></div>
		<div class="fusion-separator fusion-full-width-sep sep-single" style="border-color:#667b91;border-top-width:2px;margin-left: auto;margin-right: auto;margin-top:px;margin-bottom:12px;"></div>

		<div>
			<table style="margin: 0 auto;" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td class="product-img" rowspan="2" valign="middle"><?php echo $features_img; ?></td>
					<td class="product-price" valign="middle"><h2><?php echo $currency.$monthly_price; ?>*<small>monthly</small></h2></td>
				</tr>
				
				<tr>
					<td class="product-quote" valign="middle"><p>&quot;<?php echo $quote; ?>&quot;</p></td>
				</tr>
			</table>
		</div>

		<div class="fusion-sep-clear"></div>
		<div class="fusion-separator fusion-full-width-sep sep-single" style="border-color:#667b91;border-top-width:2px;margin-left: auto;margin-right: auto;margin-top:9px;margin-bottom:14px;"></div>

		<?php echo $description; ?>

		<div class="fusion-sep-clear"></div>
		<div class="fusion-separator fusion-full-width-sep sep-single" style="border-color:#667b91;border-top-width:2px;margin-left: auto;margin-right: auto;margin-top:5px;margin-bottom:22px;"></div>

		<div class="fusion-button-wrapper fusion-aligncenter">
			<a class="fusion-button button-flat button-square button-medium button-custom shadow woo-button" href="" target="_self" style="">
				<span class="fusion-button-text">Buy Now</span>
			</a>
		</div>

		<?php

		$output_buffer = ob_get_contents();
		ob_end_clean();

		return $output_buffer;
	}else{
		return 'Please enable WooCommerce to use this shortcode.';
	}
	
}
add_shortcode( 'ct_woo_product', 'ct_woo_product_func' );

?>