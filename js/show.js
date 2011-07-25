if(window.location.hash == '#/instruction') {
	$('.instruction').show();
}

function checkHash() {
	if(window.location.hash == '#/instruction') {
		$('.instruction').show();
	}
} setInterval(checkHash, 100);
// 
// $(function() {
// 	// Check box if URL calls for it.
// 	if(window.location.hash == '#/new') {
// 		$('#new').not(':checked').click();
// 	}
// 
// 	// Clear URL if box is unchecked.
// 	$('#new:checked').change(function(){
// 		window.location.hash = "#";
// 	});
// 	
// 	// $('#new:checked').length > 0) {
// 	// 	window.location.hash = "#/new";
// 	// });
// });