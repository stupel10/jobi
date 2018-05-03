<?php

if( isset($_GET['lang']) && !empty($_GET['lang'])){
	$language = $_GET['lang'];
	switch ($language){
		case 'SK':
			require_once 'sk.php';
			break;
		default:
			require_once 'en.php';
			break;
	}
}else{
	require_once 'en.php';
}