<?php

require_once '../config.php';

if( $_SERVER['REQUEST_METHOD']==='POST' ){
	$email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
	$password = $_POST['password'];
	//$password_repeat = $_POST['repeat'];
	$password_repeat = $_POST['password'];

	$register = $auth->register($email,$password,$password_repeat, Array(),NULL,NULL,'user');

	if( $register['error'] ){
		flash()->error($register['message']);
		redirect('/');
	}else {
		flash()->success('Company registered!');
		redirect('/user/homepage');
	}

}
