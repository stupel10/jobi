<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	require_once '../config.php';

	$user         = get_user();
	$user_profile = get_user_profile( $user->id )[0];

	$email     = $_POST['email'];
	$name      = $_POST['name'];
	$street    = $_POST['street'];
	$number    = $_POST['number'];
	$psc       = $_POST['PSC'];
	$city      = $_POST['city'];
	$country   = $_POST['country'];
	$phone     = $_POST['phone'];

	global $database;
	global $auth_config;

	$upd = $database->update( $auth_config->table_company_profiles,
		[
			'email' => $email,
			'name' => $name,
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
		flash()->success('company profile updated');
		make_log('profile edited.');
	}else{
		flash()->error('company profile NOT updated');
	}
}else{
	flash()->error('no POST request');
}
redirect('/company/homepage');
