<?php

require_once '../config.php';

if( $_SERVER['REQUEST_METHOD']==='POST' ){
	$email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
	$password = $_POST['password'];
	$password_repeat = $_POST['password_repeate'];
	//$password_repeat = $_POST['password'];

	$register = $auth->register($email,$password,$password_repeat, Array(),NULL,NULL,'company');

	if( $register['error'] ){
		flash()->error($register['message']);
		redirect('/company/index-company');
	}else {
		$login = $auth->login($email, $password, false, NULL, 'company');

		if($login['error']) {
			flash()->error($login['message']);
			redirect('/');
		} else {
			// Logged in successfully, set cookie, display success message
			do_login( $login );

			flash()->success('Company registered successfully!');
			redirect('/company/homepage');
		}
	}
}

