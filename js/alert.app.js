function ShowAlert(message){
	$('#alert-message').html(message);
	$('#alert').fadeIn(500);
}

function ToggleAlert(message){
	$('#alert-message').html(message);
	$('#alert').fadeIn(500).delay(3000).fadeOut(200);
}