(function($) {

	// --------------------------------------------------------
	// ALERTS
	setTimeout(function(){
		$('.alert:not(.alert-danger)').fadeOut();
	},3000);


	// --------------------------------------------------------
	// FORMS




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

function deleteCV( id ){
	if ( confirm("Realy delete this CV?") ){
		window.location.href = 	'/_inc/user/delete_cv.php?cv_id='+id;

	}
}
function deleteUserJob( id ){
	if ( confirm("Realy delete this Job you scanned?") ){
		window.location.href = 	'/_inc/user/delete_job.php?job_id='+id;
	}
}
function deleteJob(id){
	if ( confirm("Realy delete this Job?") ) {
		window.location.href = 	'/_inc/company/delete_job.php?job_id='+id;
	}
}
// ==========================================================
//    SCANING QR CODE
var scriptsLoaded = [false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false];
function scriptLoaded (num){
	scriptsLoaded[num] = true;

	if( isScritptsLoaded() ){
		$('#scanBtn').click();
	}
}
function isScritptsLoaded(){
	return (
		scriptsLoaded[0] && scriptsLoaded[1] && scriptsLoaded[2] &&
		scriptsLoaded[3] && scriptsLoaded[4] && scriptsLoaded[5] &&
		scriptsLoaded[6] && scriptsLoaded[7] && scriptsLoaded[8] &&
		scriptsLoaded[9] && scriptsLoaded[10] && scriptsLoaded[11] &&
		scriptsLoaded[12] && scriptsLoaded[13] && scriptsLoaded[14] &&
		scriptsLoaded[15] && scriptsLoaded[16]
	)
}
function scanImage(){
	if(!isScritptsLoaded()) {
		$.getScript("/assets/js/jsqrcode/src/grid.js", scriptLoaded(0));
		$.getScript("/assets/js/jsqrcode/src/version.js", scriptLoaded(1));
		$.getScript("/assets/js/jsqrcode/src/detector.js", scriptLoaded(2));
		$.getScript("/assets/js/jsqrcode/src/formatinf.js", scriptLoaded(3));
		$.getScript("/assets/js/jsqrcode/src/errorlevel.js", scriptLoaded(4));
		$.getScript("/assets/js/jsqrcode/src/bitmat.js", scriptLoaded(5));
		$.getScript("/assets/js/jsqrcode/src/datablock.js", scriptLoaded(6));
		$.getScript("/assets/js/jsqrcode/src/bmparser.js", scriptLoaded(7));
		$.getScript("/assets/js/jsqrcode/src/datamask.js", scriptLoaded(8));
		$.getScript("/assets/js/jsqrcode/src/rsdecoder.js", scriptLoaded(9));
		$.getScript("/assets/js/jsqrcode/src/gf256poly.js", scriptLoaded(10));
		$.getScript("/assets/js/jsqrcode/src/gf256.js", scriptLoaded(11));
		$.getScript("/assets/js/jsqrcode/src/decoder.js", scriptLoaded(12));
		$.getScript("/assets/js/jsqrcode/src/qrcode.js", scriptLoaded(13));
		$.getScript("/assets/js/jsqrcode/src/findpat.js", scriptLoaded(14));
		$.getScript("/assets/js/jsqrcode/src/alignpat.js", scriptLoaded(15));
		$.getScript("/assets/js/jsqrcode/src/databr.js", scriptLoaded(16));
	}else{
		$('#scanBtn').click();
	}
}
function imageScanned( fileInput ) {

	qrcode.callback = function (decodedData) {

		console.log('decodedData:');
		console.log(decodedData);

		var qr_data_json = parse_qr_data(decodedData);
		console.log( 'json: '+ JSON.stringify(qr_data_json) );
		var job_id = qr_data_json.searchObject.id;
		var page = qr_data_json.searchObject.page;

		if(page == 'job' && Number.isInteger( parseInt(job_id))) {
			window.location.href = "/_inc/user/add_job.php?job_id=" + job_id;
		}else {
			// TODO: ak je to cudzi kod, a je tam nieco ine, padne to....osetrit!
			alert('This is not QR code with jobi job!');
			window.location.href = decodedData;
		}

	}

	var file = fileInput.files[0];
	var reader = new FileReader();

	reader.onloadend = function () {
		//preview.src = reader.result;
		qrcode.decode(reader.result);
	}

	if (file) {
		reader.readAsDataURL(file);
	} else {
		//preview.src = "";
	}
}
function parse_qr_data(decodedData){
	return parseURL( decodeURIComponent(decodedData) );
}
function parseURL(url) {
	var parser = document.createElement('a'),
	    searchObject = {},
	    queries, split, i;
	// Let the browser do the work
	parser.href = url;
	// Convert query string to object
	queries = parser.search.replace(/^\?/, '').split('&');
	for( i = 0; i < queries.length; i++ ) {
		split = queries[i].split('=');
		searchObject[split[0]] = split[1];
	}
	return {
		protocol: parser.protocol,
		host: parser.host,
		hostname: parser.hostname,
		port: parser.port,
		pathname: parser.pathname,
		search: parser.search,
		searchObject: searchObject,
		hash: parser.hash
	};
}
//       END SCANING QR CODE
// ============================================================================================================