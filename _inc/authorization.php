<?php

// Includes
require_once 'vendor_edited/phpauth/phpauth/languages/en_GB.php' ;
require_once 'vendor_edited/phpauth/phpauth/Config.php' ;
require_once 'vendor_edited/phpauth/phpauth/Auth.php' ;

$dbh = new PDO("mysql:host=localhost;dbname=jobi", "root", "root");

// Class initialization
$auth_config = new \PHPAuth\Config($dbh);
$auth = new PHPAuth\Auth($dbh, $auth_config, $lang);


// Login

//$call = $auth->login("email@example.com", "password", true);
//
//if($call['error']) {
//	echo $call['message'];
//	exit();
//}
//
//setcookie($auth_config->cookie_name, $call['hash'], $call['expire'], $auth_config->cookie_path, $auth_config->cookie_domain, $auth_config->cookie_secure, $auth_config->cookie_http);
//
//// Logout
//
//if(!$auth->logout($_COOKIE[$auth_config->cookie_name])) {
//	echo $call['message'];
//	exit();
//}
//
//setcookie($auth_config->cookie_name, "", time() - 3600, $auth_config->cookie_path, $auth_config->cookie_domain, $auth_config->cookie_secure, $auth_config->cookie_http);

?>