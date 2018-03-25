<?php

require_once '_inc/config.php';

if (isset($_GET['url'])) {
	$explode = explode("/", $_GET["url"]);
	$user_company_dir = $explode[0];
	$id = isset($explode[1]) ? intval($explode[1]) : 0;
	$page = isset($explode[1]) ? trim($explode[1]) : '';
	$param2 = isset($explode[2]) ? trim($explode[2]) : '';
	$param3 = isset($explode[3]) ? trim($explode[3]) : '';
}
else $user_company_dir = '';

	if( $user_company_dir !== '' ) {
		if( $user_company_dir === 'user'){
			include_once '_partials/user_header.php';
		}elseif ( $user_company_dir === 'company' && $page !== 'index-company'){
			include_once '_partials/company_header.php';
		}elseif ( $user_company_dir === 'public' ){
			if($page !== 'page'){
				include_once '_partials/public_header.php';
			}
		}else {
			include_once "_partials/header.php";
		}

		$link = 'pages/' . $user_company_dir .'/'. $page . '.php';
		//echo $link;
		include file_exists( $link ) ? $link : '404.php';
	}else {
		include_once "_partials/header.php";
		include 'main.php';
	}
include_once "_partials/footer.php";
?>


