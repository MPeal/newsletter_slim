function validate(){
	var good = true;
	$('#name').removeClass('missing');
	$('#email').removeClass('missing');

	var name = $('#name').val();
	var email = $('#email').val();
	if (name.length < 1) {
		$('#name').addClass('missing');
		$('#feedback').show();
		good = false;
	}

	if (email.length < 1) {
		$('#email').addClass('missing');
		$('#feedback').show();
		good = false;
	}

	good ? $('#feedback').hide() : '';
	return good;
}

function submitForm() {
	var dfd = $.Deferred();
	var ready = validate();
	var name = $('#name').val();
	var email = $('#email').val();

	if (ready) {
		$.ajax({
			type: 'POST',
			url: 'signup/submit',
			dataType: 'json',
			data: {
				name: name,
				email: email
			},
			success: function(response) {
				dfd.resolve(response);
			}
		});
	}

	return dfd;
}

function handleSubmitResponse(response) {
	if (response.success) {
		$('#feedback').addClass('done');
		$('#feedback').html('Great, you signed up!  Redirecting because this is a demo.');
		$('#feedback').show();
		setTimeout(function() {
			window.location.href = "subscribers_view";
		}, 4000);
	}
}

function bindEvents() {
	$('#submit_btn').on('click', function(){
		submitForm()
			.done(function(response) {
				handleSubmitResponse(response);
			});
	});
}

bindEvents();
