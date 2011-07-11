$(function() {
	if(window.location.hash == '#/instruction') {
		$('.instruction').show();
	}

	$('#suggestion').click(function(){
		$('.instruction').show();
	});
});