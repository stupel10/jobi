<?php

if ( is_user_logged_in() ) {
	$user = get_user();
	$user_profile = get_user_profile($user->id)[0];
}else {
	header('HTTP/1.0 403 Forbidden');
	include_once '403.php';
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

	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<!--<link rel="stylesheet" href="/assets/css/bootstrap-grid.css">-->
	<!--<link rel="stylesheet" href="/assets/css/bootstrap-reboot.css">-->
	<link rel="stylesheet" href="/assets/plugins/font-awesome.5.0.8/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="/assets/css/main.css">

	<script>
		var baseUrl = '<?php echo $base_url ?>'
	</script>
	<script src="/assets/js/jquery.js"></script>
	<script src="/assets/js/plugins.js"></script>
	<!--<script src="/assets/js/bootstrap.bundle.js"></script>-->
	<script src="/assets/js/bootstrap.js"></script>
	<script src="/assets/plugins/ckeditor/ckeditor.js"></script>
	<script src="/assets/js/app.js"></script>
</head>
<body class="user <?php echo $page ?>">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<div class="container">
		<a class="navbar-brand" href="#">Navbar</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarColor01">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active"><a href="/user/homepage" class="btn nav-link">HOME</a></li>
				<li class="nav-item"><a href="/user/scanned_jobs" class="btn nav-link">SCANED JOBS</a></li>
				<li class="nav-item"><a href="/user/all_jobs" class="btn nav-link">ALL OFFERED JOBS</a></li>
				<li class="nav-item"><a href="/user/cvs" class="btn nav-link">MY CVs</a></li>
			</ul>
			<div class="my-2 my-lg-0">
				<form action="" method="post">
					<input type="file" name="snanedFile" id="scanBtn" accept=".png, .jpg, .jpeg" style="display:none;" onchange="imageScanned(this);"/>
				</form>
				<a href="javacsript:void(0)" class="btn btn-success" onclick="scanImage()">SCAN JOB</a>
				<a href="/_inc/user/logout.php" class="btn btn-danger">LOG OUT</a>
			</div>
		</div>
	</div>
</nav>
<header class="container">
	<?= flash()->display() ?>
</header>
<main>
	<section>
		<div class="container">