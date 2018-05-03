<?php

if ( is_admin_logged_in() ) {
	$user = get_user();
	$user_profile = get_admin_profile($user->id);
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

	<title>JOBI ADMIN</title>

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
	<script src="/assets/js/app.js"></script>
</head>
<body class="admin <?php echo $page ?>">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<div class="container">
		<a class="navbar-brand" href="#">Jobi</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarColor01">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item<?php if($page=='homepage') echo ' active'?>"><a href="/admin/homepage" class="btn nav-link">ADMIN HOME</a></li>
				<li class="nav-item<?php if($page=='query') echo ' active'?>"><a href="/admin/query" class="btn nav-link">DATABASE QUERY</a></li>
			</ul>
			<div class="my-2 my-lg-0">
				<a href="/_inc/user/logout.php" class="btn btn-danger"><?=lang('log_out')?></a>
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