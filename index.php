<?php include_once "_partials/header.php" ?>

<?php

if (isset($_GET['url'])) {
	$explode = explode("/", $_GET["url"]);
	$user_company_dir = $explode[0];
	$id = isset($explode[1]) ? intval($explode[1]) : 0;
	$page = isset($explode[1]) ? trim($explode[1]) : '';
	$param2 = isset($explode[2]) ? trim($explode[2]) : '';
	$param3 = isset($explode[3]) ? trim($explode[3]) : '';
}
else $user_company_dir = '';

?>

	<?php
	if( $user_company_dir !== '' ) {
		$link = 'pages/' . $user_company_dir .'/'. $page . '.php';
		echo $link;
		include file_exists( $link ) ? $link : '404.php';
	}else {
		include 'main.php';
	}
	?>




<?php include_once "_partials/footer.php" ?>

