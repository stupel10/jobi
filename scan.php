

<script type="text/javascript" src="/assets/js/jsqrcode/src/grid.js"></script>
<script type="text/javascript" src="/assets/js/jsqrcode/src/version.js"></script>
<script type="text/javascript" src="/assets/js/jsqrcode/src/detector.js"></script>
<script type="text/javascript" src="/assets/js/jsqrcode/src/formatinf.js"></script>
<script type="text/javascript" src="/assets/js/jsqrcode/src/errorlevel.js"></script>
<script type="text/javascript" src="/assets/js/jsqrcode/src/bitmat.js"></script>
<script type="text/javascript" src="/assets/js/jsqrcode/src/datablock.js"></script>
<script type="text/javascript" src="/assets/js/jsqrcode/src/bmparser.js"></script>
<script type="text/javascript" src="/assets/js/jsqrcode/src/datamask.js"></script>
<script type="text/javascript" src="/assets/js/jsqrcode/src/rsdecoder.js"></script>
<script type="text/javascript" src="/assets/js/jsqrcode/src/gf256poly.js"></script>
<script type="text/javascript" src="/assets/js/jsqrcode/src/gf256.js"></script>
<script type="text/javascript" src="/assets/js/jsqrcode/src/decoder.js"></script>
<script type="text/javascript" src="/assets/js/jsqrcode/src/qrcode.js"></script>
<script type="text/javascript" src="/assets/js/jsqrcode/src/findpat.js"></script>
<script type="text/javascript" src="/assets/js/jsqrcode/src/alignpat.js"></script>
<script type="text/javascript" src="/assets/js/jsqrcode/src/databr.js"></script>


<!--<form action='#' onsubmit="return false;">-->
	<input type='file' id='imgfile' />
	<!--<input type='button' id='btnLoad' value='Load' onclick='loadImage();' />-->
<!--</form>-->
<button onclick="nieco();">BUTTON</button>
	<!--<canvas id="canvas"></canvas>-->




<!--

Najlepsie na tomto plugine je, ze to je port ZXING a co viac,
 dokaze aj skenovat z videa pomocou funckie getUserMedia(), avsak ta nieje podporovana na iOS !!!
...ale pre androidy a PC je to supis
...takze casom mozme pridat funkciu skenovania z videa.
-->

<!--nejaky koment -  vymaz ho!-->
<script>
	function nieco() {
		qrcode.callback = function (decodedData) {
			//...
			console.log('decodedData:');
			console.log(decodedData);
		}
		//qrcode.decode("https://upload.wikimedia.org/wikipedia/commons/5/56/QR_with_URL_to_article_about_QR-code_%28Swedish%29.svg");

		//var preview = document.querySelector('img');
		var file    = document.querySelector('input[type=file]').files[0];
		var reader  = new FileReader();

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
</script>

