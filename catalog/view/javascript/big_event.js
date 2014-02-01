$(document).ready(function() {
	$('#big_event').click(function() {
		$(this).fadeOut(100);
	});
	$('#big_event .close_btn').click(function(e) {
		e.preventDefault();
		$('#big_event').fadeOut(100);
	});
});