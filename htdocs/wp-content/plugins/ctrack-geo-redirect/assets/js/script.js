var ct$ = jQuery.noConflict();

ct$(document).ready(function(){

	ct$('.add-row-btn').click(function(){
		if(ct$('.redirects-tbl tbody').children().length > 0) {
			nextRow = ct$('.redirects-tbl tr.redirect').last().data('id') + 1;
		}else{
			nextRow = 0;
		}

		ct$('.redirects-tbl').append("<tr class=\"redirect\" data-state=\"insert\"  data-id=\""+nextRow+"\"><td><input type=\"text\" class=\"regular-text\" name=\"redirect-code["+nextRow+"]\" value=\"\" placeholder=\"Country Code\"></td><td><input type=\"text\" class=\"regular-text\" name=\"redirect-url["+nextRow+"]\" value=\"\" placeholder=\"Redirect URL\"></td><td style=\"cursor: pointer;\" class=\"remove-row-btn\" data-id=\""+nextRow+"\"><a>&times; Remove Row</a></td>");
	});

	
	ct$('.redirects-tbl').on("click", ".remove-row-btn", function(){
		ct$(this).parent().remove();
	});
	
});