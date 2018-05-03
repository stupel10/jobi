<?php

require_once '../config.php';

if( $_SERVER['REQUEST_METHOD']==='POST' ){
	$email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
	$password = $_POST['password'];
	$remember = $_POST['rememberMe'] ? true : false;


	$login = $auth->login($email, $password, $remember, NULL, 'admin');

	if($login['error']) {
		flash()->error($login['message']);
		redirect('/admin/admin-index');
	} else {
		// Logged in successfully, set cookie, display success message
		do_login( $login );

		flash()->success('Successfully logged in!');
		redirect('/admin/homepage');
	}
}

