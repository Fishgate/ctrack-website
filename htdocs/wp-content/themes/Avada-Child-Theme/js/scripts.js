jQuery(document).ready(function(){
	jQuery('.ct_toggle .ct_toggle_header').each(function(){
		jQuery(this).click(function(){
			jQuery(this).next().slideToggle();
		})
	});
});