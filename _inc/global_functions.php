<?php

function show_404(){
	header("HTTP/1.0 404 NOT FOUND");
	include_once "404.php";
	die();
}
function get_company_from_POST(){
	if( ! isset($_POST['name']) || empty($_POST['name']) ||
	    ! isset($_POST['pass']) || empty($_POST['pass']) ) {
		show_404();
	}

	global $database;

	if (
		$database->count("companies",
			[ "name" => $_POST['name'],
			  "password" => $_POST['pass']
			]) > 1
	){
		return false;
	}
	$company = $database->select("companies",['id','name','date_registered'] ,
		[ "name" => $_POST['name'],
		"password" => $_POST['pass']
	]);

	if( ! $company ){
		return false;
	}


	return $company[0];
}
function get_user(){
	if( ! isset($_POST['name']) || empty($_POST['name']) ||
	    ! isset($_POST['pass']) || empty($_POST['pass']) ) {
		show_404();
	}

	global $database;

	if (
			$database->count("users_details",
							[ "name" => $_POST['name'],
							"password" => $_POST['pass']
			]) > 1
		){
		return false;
	}
	$user = $database->select("users_details",['id','name','surname','email','birthdate','date_registered','jobs_registered'] , [
		"name" => $_POST['name'],
		"password" => $_POST['pass']
	]);

	if( ! $user ){
		return false;
	}


	return $user[0];
}

function get_job($id){
	if( ! isset($id) || empty($id) ) {
		show_404();
	}

	global $database;

	$job = $database->select("jobs",['id','company_id','title','text','qr_source'] ,
								[ "id" => $id ]);

	if( ! $job ){
		return false;
	}

	return $job[0];

}

function get_company($id){
	if( ! isset($id) || empty($id) ) {
		show_404();
	}

	global $database;

	$company = $database->select("companies",['id','name','date_created'] ,
												[ "id" => $id ]);

	if( ! $company ){
		return false;
	}

	return $company[0];

}
function get_resumes($user_id){
	if( ! isset($user_id) || empty($user_id) ) {
		show_404();
	}

	global $database;

	$resumes = $database->select("resumes",['id','text','date_created'] ,
		[ "user_id" => $user_id ]);

	if( ! $resumes ){
		return false;
	}

	return $resumes;

}
function redirect( $page ){
	global $base_url;

	$page = ltrim( $page, '/');

	header("Location: $base_url/$page");
	die();
}

/**
 * Do Login
 *
 * Create cookie after logging in
 *
 * @param $data
 * @return bool
 */
function do_login( $data ){

	global $auth_config;

	setcookie(
		$auth_config->cookie_name,
		$data['hash'],
		$data['expire'],
		$auth_config->cookie_path,
		$auth_config->cookie_domain,
		$auth_config->cookie_secure,
		$auth_config->cookie_http
	);
}