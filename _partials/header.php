<?php
	$user_logged = is_user_logged_in() ?  true :  false;
	$company_logged = is_company_logged_in() ? true :  false;

	$page = isset($page) ? $page : '';
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
	<?php if($user_logged || $company_logged){ ?>
	<script src="/assets/plugins/ckeditor/ckeditor.js"></script>
	<?php } ?>
	<?php if($user_logged){ ?>
		<script src="/assets/js/jsqrcode/src/grid.js"></script>
		<script src="/assets/js/jsqrcode/src/version.js"></script>
		<script src="/assets/js/jsqrcode/src/detector.js"></script>
		<script src="/assets/js/jsqrcode/src/formatinf.js"></script>
		<script src="/assets/js/jsqrcode/src/errorlevel.js"></script>
		<script src="/assets/js/jsqrcode/src/bitmat.js"></script>
		<script src="/assets/js/jsqrcode/src/datablock.js"></script>
		<script src="/assets/js/jsqrcode/src/bmparser.js"></script>
		<script src="/assets/js/jsqrcode/src/datamask.js"></script>
		<script src="/assets/js/jsqrcode/src/rsdecoder.js"></script>
		<script src="/assets/js/jsqrcode/src/gf256poly.js"></script>
		<script src="/assets/js/jsqrcode/src/gf256.js"></script>
		<script src="/assets/js/jsqrcode/src/decoder.js"></script>
		<script src="/assets/js/jsqrcode/src/qrcode.js"></script>
		<script src="/assets/js/jsqrcode/src/findpat.js"></script>
		<script src="/assets/js/jsqrcode/src/alignpat.js"></script>
		<script src="/assets/js/jsqrcode/src/databr.js"></script>
	<?php } ?>
	<script src="/assets/js/app.js"></script>
</head>
<body class="<?php echo isset($user_company_dir)? $user_company_dir : 'index' ?> <?php echo isset($page)? $page : 'homepage' ?>">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<div class="container">
		<a class="navbar-brand" href="#">Jobi</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<?php
		if($user_logged){?>
			<div class="collapse navbar-collapse" id="navbarColor01">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item<?php if($page=='homepage') echo ' active'?>"><a href="/user/homepage" class="btn nav-link"><?=lang('home')?></a></li>
					<li class="nav-item<?php if($page=='scanned_jobs') echo ' active'?>"><a href="/user/scanned_jobs" class="btn nav-link"><?=lang('scanned_jobs')?></a></li>
					<li class="nav-item<?php if($page=='all_jobs') echo ' active'?>"><a href="/user/all_jobs" class="btn nav-link"><?=lang('all_offered_jobs')?></a></li>
					<li class="nav-item<?php if($page=='cvs') echo ' active'?>"><a href="/user/cvs" class="btn nav-link"><?=lang('my_cvs')?></a></li>
				</ul>
				<div class="my-2 my-lg-0">
					<form action="" method="post">
						<input type="file" name="snanedFile" id="scanBtn" accept=".png, .jpg, .jpeg" style="display:none;" onchange="imageScanned(this);"/>
					</form>
					<a href="javacsript:void(0)" class="btn btn-success" onclick="scanImage()">SCAN JOB</a>
					<a href="/_inc/user/logout.php" class="btn btn-danger">LOG OUT</a>
				</div>
			</div>
		<?php }elseif($company_logged) {?>
			<div class="collapse navbar-collapse" id="navbarColor01">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item<?php if($page=='homepage') echo ' active'?>"><a href="/company/homepage" class="btn nav-link">HOME</a></li>
					<li class="nav-item<?php if($page=='offered_jobs') echo ' active'?>"><a href="/company/offered_jobs" class="btn nav-link">OFFERED JOBS</a></li>
				</ul>
				<div class="my-2 my-lg-0">
					<a href="/_inc/user/logout.php" class="btn btn-danger">LOG OUT</a>
				</div>
			</div>
		<?php } else{ ?>
			<div class="collapse navbar-collapse" id="navbar">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item<?php if($page=='') echo ' active'?>"><a href="/" class="btn nav-link"><?=lang('home')?></a></li>
					<li class="nav-item<?php if($page=='index-company') echo ' active'?>"><a href="/company/index-company" class="btn nav-link"><?=lang('company')?></a>

				</ul>
				<div class="my-2 my-lg-0">
					<a href="/_inc/user/login.php" class="btn btn-success"><?=lang('login')?></a>
				</div>
			</div>
		<?php } ?>
	</div>
</nav>

<header class="container">
	<?= flash()->display() ?>
</header>
<main>
	<section>
		<div class="container">