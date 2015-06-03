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
			<table style="margin: 0 auto;" border="1">
				<tr>
					<td rowspan="2"><?php echo $features_img; ?></td>
					<td><?php echo $currency.$monthly_price; ?>*<small>monthly</small></td>
				</tr>
				
				<tr>
					<td>&quot;<?php echo $quote; ?>&quot;</td>
				</tr>
			</table>
		</div>


		<!-- <div class="fusion-content-boxes content-boxes columns fusion-columns-1 fusion-content-boxes-1 content-boxes-icon-on-side row content-left transparent center" style="margin-top:0px;margin-bottom:0px;">
			<div class="fusion-column content-box-column content-box-column-1 col-lg-12 col-md-12 col-sm-12">
				<div class="col content-wrapper">
					<div class="heading heading-with-icon icon-left">
						<div class="image"><?php echo $features_img; ?></div>
						<h2 class="content-box-heading" style="font-size: 18px;line-height:20px;" data-inline-fontsize="true" data-inline-lineheight="true" data-fontsize="30" data-lineheight="20"><?php echo $currency.$monthly_price; ?>*<small>monthly</small></h2>
					</div>

					<div class="fusion-clearfix"></div>

					<div class="content-container" style="padding-left:69px;">
						&quot;<?php echo $quote; ?>&quot;
					</div>
				</div>
			</div>

			<div class="fusion-clearfix"></div>
		</div> -->

		<div class="fusion-sep-clear"></div>
		<div class="fusion-separator fusion-full-width-sep sep-single" style="border-color:#667b91;border-top-width:2px;margin-left: auto;margin-right: auto;margin-top:9px;margin-bottom:14px;"></div>

		<?php echo $description; ?>

		<div class="fusion-sep-clear"></div>
		<div class="fusion-separator fusion-full-width-sep sep-single" style="border-color:#667b91;border-top-width:2px;margin-left: auto;margin-right: auto;margin-top:5px;margin-bottom:22px;"></div>

		<div class="fusion-button-wrapper fusion-aligncenter">
			<style type="text/css" scoped="scoped">
				.fusion-button.button-5{border-width:0px;color:#ffffff;border-color:#ffffff;}
				.fusion-button.button-5:hover,.fusion-button.button-5:focus,.fusion-button.button-5:active{border-width:0px;border-color:#ffffff;color:#ffffff;}
				.fusion-button.button-5{background: #f31700;}
				.fusion-button.button-5:hover,.button-5:focus,.fusion-button.button-5:active{background: #f31700;}
			</style>

			<a class="fusion-button button-flat button-square button-medium button-custom shadow" href="" target="_self" style="">
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

		

	/*$product = new WC_Product($atts['id']);

	$markup = '<div class="fusion-title title fusion-title-size-two no-border center"><h2 class="title-heading-left" data-fontsize="28" data-lineheight="27">'.$product->get_title().'</h2><div class="title-sep-container"><div class="title-sep sep-none"></div></div></div>';

	

	return $markup;*/

	
}
add_shortcode( 'ct_woo_product', 'ct_woo_product_func' );

?>