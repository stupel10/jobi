
<script type="text/javascript" src="assets/js/jsqrcode/src/grid.js"></script>
<script type="text/javascript" src="assets/js/jsqrcode/src/version.js"></script>
<script type="text/javascript" src="assets/js/jsqrcode/src/detector.js"></script>
<script type="text/javascript" src="assets/js/jsqrcode/src/formatinf.js"></script>
<script type="text/javascript" src="assets/js/jsqrcode/src/errorlevel.js"></script>
<script type="text/javascript" src="assets/js/jsqrcode/src/bitmat.js"></script>
<script type="text/javascript" src="assets/js/jsqrcode/src/datablock.js"></script>
<script type="text/javascript" src="assets/js/jsqrcode/src/bmparser.js"></script>
<script type="text/javascript" src="assets/js/jsqrcode/src/datamask.js"></script>
<script type="text/javascript" src="assets/js/jsqrcode/src/rsdecoder.js"></script>
<script type="text/javascript" src="assets/js/jsqrcode/src/gf256poly.js"></script>
<script type="text/javascript" src="assets/js/jsqrcode/src/gf256.js"></script>
<script type="text/javascript" src="assets/js/jsqrcode/src/decoder.js"></script>
<script type="text/javascript" src="assets/js/jsqrcode/src/qrcode.js"></script>
<script type="text/javascript" src="assets/js/jsqrcode/src/findpat.js"></script>
<script type="text/javascript" src="assets/js/jsqrcode/src/alignpat.js"></script>
<script type="text/javascript" src="assets/js/jsqrcode/src/databr.js"></script>



<input type="file" accept="image/*" id="fileInput">
<script>
	$( document ).ready(function() {

		var input = $('#fileInput');
		input.on('change', function () {

			if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
				alert('The File APIs are not fully supported in this browser.');
				return;
			}
			var input = document.getElementById('fileInput');
			if (!input) {
				alert("Um, couldn't find the file input element.");
			}
			else if (!input.files) {
				alert("This browser doesn't seem to support the `files` property of file inputs.");
			}
			else if (!input.files[0]) {
				alert("Please select a file first!!!");
			}
			else {
				var file = input.files[0];
				var fr = new FileReader();
				fr.onload = function (e) {
					qrcode.decode(e.target.result);
				};
				fr.readAsDataURL(file);
				qrcode.callback = function (decodedDATA) {

					var qrID = Number(decodedDATA);
					if( qrID !== null && qrID !== '' && qrID !== 'NaN') {
						var req = $.ajax({
							//url : baseUrl + '/_inc/job-qr-scan.php?job_qr_id='+qrID+'&user_id=<?php //echo $user['id']?>//',
							url : baseUrl + '/_inc/job-qr-scan.php?job_qr_id='+qrID+'&user_id=5',
							type: 'POST'
						});
						req.done(function (data) {
							if (data.status === 'success') {
								alert("DONE");
							}else{
								alert(data);
							}
						});
					}
				};
			}
		});
	});
</script>