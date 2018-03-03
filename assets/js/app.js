(function($) {

	var user_reg_form = $('#reg-user');
	makeAjax(user_reg_form);

	var company_reg_form = $('#reg-company');
	makeAjax(company_reg_form);

	var scan_qr_form = $('#job-qr-scan');
	makeAjax(scan_qr_form);

	var add_job_form = $('#add-job-form');
	makeAjax(add_job_form);


	function makeAjax(form) {
		form.on('submit', function () {
			event.preventDefault();

			var req = $.ajax({
				url     : form.attr('action'),
				type    : form.attr('method'),
				data    : form.serialize(),
				dataType: 'json'
			});
			req.done(function (data) {
				if (data.status === 'success') {
					alert("DONE");
				}
			});
		});
	}
}(jQuery));
