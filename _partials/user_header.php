<?php

if ( logged_in() ) {
	//echo 'logged in';

	$user = get_user();
	$user_profile = get_user_profile($user->id)[0];
	//echo '<pre>';
	//print_r( $user );
	//echo '</pre>';


}else {
	header('HTTP/1.0 403 Forbidden');

	include_once '403.php';
	//echo "Forbidden".
	//     "<br>".
	//     "<a href='/' class='btn btn-danger'>GO TO HOMEPAGE</a>";

	//echo "YOU ARE NOT LOGGED IN!!!";
	exit();
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>JOBI</title>

	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->

	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<!--<link rel="stylesheet" href="/assets/css/bootstrap-grid.css">-->
	<!--<link rel="stylesheet" href="/assets/css/bootstrap-reboot.css">-->
	<link rel="stylesheet" href="/assets/css/main.css">

	<script>
		var baseUrl = '<?php echo $base_url ?>'
	</script>
	<script src="/assets/js/jquery.js"></script>
	<script src="/assets/js/plugins.js"></script>
	<!--<script src="/assets/js/bootstrap.bundle.js"></script>-->
	<!--<script src="/assets/js/bootstrap.js"></script>-->
	<script src="/assets/js/app.js"></script>
</head>
<body class="user <?php echo $page ?>">
<br>
<header class="container">
	<?= flash()->display() ?>
	<div class="row">
		<div class="col-sm-12">
			<div class="pull-right">
				<form action="" method="post">
					<input type="file" name="snanedFile" id="scanBtn" accept=".png, .jpg, .jpeg" style="display:none;"/>
				</form>
				<a href="javacsript:void(0)" class="btn btn-success" onclick="$('#scanBtn').click();">SCAN JOB</a>
				<a href="/_inc/user/logout.php" class="btn btn-danger">LOG OUT</a>
			</div>
		</div>
	</div>
	<nav>
		<a href="/user/homepage" class="btn btn-primary">HOME</a>
		<a href="/user/jobs" class="btn btn-primary">SCANED JOBS</a>
		<a href="/user/cvs" class="btn btn-primary">MY CVs</a>
	</nav>
	<br>
</header>
<main>
	<section>
		<div class="container">