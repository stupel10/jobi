<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	require_once '../config.php';

	$user         = get_user();
	$user_profile = get_user_profile( $user->id )[0];

	$email     = $_POST['email'];
	$name      = $_POST['name'];
	$surname   = $_POST['surname'];
	$birthdate = $_POST['birthdate'];
	$sex       = $_POST['sex'];
	$title     = $_POST['title'];
	$street    = $_POST['street'];
	$number    = $_POST['number'];
	$psc       = $_POST['PSC'];
	$city      = $_POST['city'];
	$country   = $_POST['country'];
	$phone     = $_POST['phone'];

	global $database;
	global $auth_config;

	$upd = $database->update( $auth_config->table_user_profiles,
		[
			'email' => $email,
			'name' => $name,
			'surname' => $surname,
			'birthdate' => $birthdate,
			'sex' => $sex,
			'title' => $title,
			'address_street' => $street,
			'address_street_number' => $number,
			'address_PSC' => $psc,
			'address_city' => $city,
			'address_country' => $country,
			'phone' => $phone,
		],[
			'id' => $user_profile['id']
		]
	);
	if( $upd->rowCount() > 0  ){
		flash()->success('user profile updated');
	}else{
		flash()->error('user profile NOT updated');
	}
}else{
	flash()->error('no POST request');
}
redirect('/user/homepage');
