$(function() {
	$("#page").hover(
		function(){
			$(this).removeClass('issues');
		}, 
		function() {
			$(this).addClass('issues');
		}
	);
});