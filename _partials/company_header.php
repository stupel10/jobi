<?php

if ( is_company_logged_in() ) {
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

	<title>JOBI COMPANY</title>

	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->

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
	<!--<script src="/assets/js/bootstrap.js"></script>-->
	<script src="/assets/plugins/ckeditor/ckeditor.js"></script>
	<script src="/assets/js/app.js"></script>
</head>
<body class="company <?php echo $page ?>">
<br>
<header class="container">
	<?= flash()->display() ?>
	<div class="row">
		<div class="col-sm-12">
			<div class="pull-right">
				<a href="/_inc/user/logout.php" class="btn btn-danger">LOG OUT</a>
			</div>
		</div>
	</div>
	<nav>
		<a href="/company/homepage" class="btn btn-primary">HOME</a>
		<a href="/company/offered_jobs" class="btn btn-primary">OFFERED JOBS</a>
	</nav>
	<br>
</header>
<main>
	<section>
		<div class="container">