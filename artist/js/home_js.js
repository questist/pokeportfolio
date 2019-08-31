$(document).ready(function(){
	$(".thumb-link").click(function(){
		//$("div.debug-text").html("this was here");
		var link = $(this);
		var href = link.attr("href");
		$(".featured-item").attr("src",href)
		return false;
	});
});