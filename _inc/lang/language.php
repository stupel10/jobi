<?php

$language = 'en';

if( isset($_GET['lang']) && !empty($_GET['lang'])){
	$language = $_GET['lang'];
	setcookie("lang",$language);
}elseif( isset($_COOKIE['lang']) && !empty($_COOKIE['lang'])){
	$language = $_COOKIE['lang'];
}

switch ($language){
	case 'SK':
		require_once 'sk.php';
		break;
	case 'sk':
		require_once 'sk.php';
		break;
	default:
		require_once 'en.php';
		break;
}
