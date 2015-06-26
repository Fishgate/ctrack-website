var ct$ = jQuery.noConflict();

ct$(document).ready(function(){

	// add redirect
	ct$('.add-row-btn').click(function(){
		nextRow = (ct$('.redirects-tbl tbody').children().length > 0) ? ct$('.redirects-tbl tr.redirect').last().data('id')+1 : 0;

		ct$('.redirects-tbl').append("<tr class=\"redirect\" data-state=\"insert\"  data-id=\""+nextRow+"\"><td><input type=\"text\" class=\"regular-text\" name=\"redirect-code["+nextRow+"]\" value=\"\" placeholder=\"Country Code\"></td><td><input type=\"text\" class=\"regular-text\" name=\"redirect-url["+nextRow+"]\" value=\"\" placeholder=\"Redirect URL\"></td><td style=\"cursor: pointer;\" class=\"remove-row-btn\" data-id=\""+nextRow+"\"><a>&times; Remove Row</a></td>");
	});

	// remove redirect
	ct$('.redirects-tbl').on("click", ".remove-row-btn", function(){
		ct$(this).parent().remove();
	});
	
});