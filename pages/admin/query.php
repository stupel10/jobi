<?php
$result = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$query = $_POST['query'];

	global $database;
	$result = $database->query($query)->fetchAll();

}
?>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<form action="#" method="POST">
				<div class="form-group">
					<label for="query">QUERY</label>
					<textarea name="query" id="query" cols="30" rows="10" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<input type="submit" value="MAKE QUERY" class="btn btn-danger">
				</div>
			</form>
		</div>
	</div>
	<? if($result) {?>
		<div class="row">
			<div class="col-sm-12">
				<h3>RESULT:</h3>
			</div>
			<div class="col-sm-12">
				<?php

				echo '<pre>';
				print_r( $result );
				echo '</pre>';

				?>
			</div>
		</div>
	<? } ?>
</div>
