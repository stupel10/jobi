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
function get_user_from_POST(){
	if( ! isset($_POST['name']) || empty($_POST['name']) ||
	    ! isset($_POST['pass']) || empty($_POST['pass']) ) {
		show_404();
	}

	global $database;

	if (
			$database->count("user_profiles",
							[ "name" => $_POST['name'],
							"password" => $_POST['pass']
			]) > 1
		){
		return false;
	}
	$user = $database->select("user_profiles",['id','name','surname','email','birthdate','date_registered','jobs_registered'] , [
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
/**
 * Do Logout
 *
 * Logs the user out
 *
 * @return bool
 */
function do_logout(){
	if ( !is_logged_in() ){
		return true;
	}
	global $auth;
	global $auth_config;

	return $auth->logout( $_COOKIE[$auth_config->cookie_name] );

}
/**
 * Is user or company logged in?
 *
 * returns true if user is logged in
 *
 * @return bool
 */
function is_logged_in(){
	global $auth;

	return ($auth->isUserLogged() || $auth->isCompanyLogged() );
}

/**
 * Is user logged in?
 *
 * returns true if user is logged in
 *
 * @return bool
 */
function is_user_logged_in(){
	global $auth;

	return ($auth->isUserLogged() );
}

/**
 * Is user logged in?
 *
 * returns true if user is logged in
 *
 * @return bool
 */
function is_company_logged_in(){
	global $auth;

	return ($auth->isCompanyLogged() );
}


/**
 * Get user
 *
 * Grab data for the logged in user
 * @param int $user_id
 * @return bool|mixed
 */
function get_user( $user_id = 0){

	global $auth;

	$role = $auth->getRole();
	if( ! $user_id && is_logged_in() ){
		$user_id = $auth->getSessionUID($auth->getSessionHash(),$role);
	}
	return (object) $auth->getUser($user_id,$role);
}

function get_user_profile($user_id){
	global $auth;
	global $auth_config;
	global $database;

	$role = $auth->getRole();
	if( ! $user_id && is_logged_in() ){
		$user_id = $auth->getSessionUID($auth->getSessionHash(),$role);
	}
	if($role === 'user' ){
		$table= $auth_config->table_user_profiles;
	}elseif ($role === 'company'){
		$table= $auth_config->table_company_profiles;
	}
	$profile_id = $auth->getUserActiveProfile($user_id);
	$user_profiles = $database->select($table,
		//	[
		//	"id","email","name","surname","birthdate","sex","title","photo_link","address_street","address_street_number","address_PSC","address_city","address_country","phone","jobs_registered"
		//]
		"*"
		,[
			"id" => $profile_id
		]);

	return $user_profiles;
}

/**
 *
 * Get all jobs assigned to user.
 *
 * @param $user_id - id from table users
 *
 * @return array|bool
 */
function get_user_assigned_jobs($user_id){
	global $database;

	$user_active_profile = get_user_profile($user_id)[0];
	$jobs_array = explode(',',$user_active_profile['jobs_registered']);
	$jobs_array = array_unique($jobs_array);

	$jobs = $database->select('jobs',"*",[
		'id' => $jobs_array
	]);


	return $jobs;
}

/**
 *
 * Get all user CVs.
 *
 * @param $user_id - id from table users
 *
 * @return array|bool
 */
function get_user_CVs($user_id){
	global $database;

	$user_active_profile = get_user_profile($user_id)[0];


	$resumes = $database->select("resumes", "*" ,
		[ "user_id" => $user_active_profile['id'] ]);

	if( ! $resumes ){
		return false;
	}

	return $resumes;
}

/**
 *
 * Get cv by id. Must belong to user!
 *
 * @param $user_id - id of user in 'users' table
 * @param $cv_id - id of CV in resumes table
 *
 * @return object|bool
 */
function get_user_cv( $user_id,$cv_id){
	global $database;

	$user_active_profile = get_user_profile($user_id)[0];

	$resumes = $database->select("resumes", "*" ,
		[
			"id" => $cv_id,
			"user_id" => $user_active_profile['id'] ]);

	if( ! $resumes ){
		return false;
	}

	return $resumes[0];
}

/**
*
* Get all jobs company is offering
 *
 * @param $company_id - id of company in 'company_profiles' table
 *                                                                                *
 * @return object|bool
 */
function get_company_jobs($company_id){

	// is logged?
	if( !is_logged_in() ){
		return false;
	}

	global $database;

	$jobs = $database->select('jobs',"*",['company_id' => $company_id]);

	if( !$jobs ){
		return false;
	}

	return $jobs;
}

/**
 *
 * Get job by id. Must belong to company!
 *
 * @param $user_id - id of company in 'companies' table
 * @param $job_id - id of job in jobs table
 *
 * @return object|bool
 */
function get_company_job( $user_id,$job_id){
	global $database;

	$user_active_profile = get_user_profile($user_id)[0];

	$jobs = $database->select("jobs", "*" ,
		[
			"id" => $job_id,
			"company_id" => $user_active_profile['id'] ]);

	if( ! $jobs ){
		return false;
	}

	return $jobs[0];
}

/**
 *
 * Create qr
 *
 * @param $data
 * @param $link
 *
 * @return bool|string
 */
function createQR($data,$link,$root_dir = '../../'){
	//  data = '12'
	//	link = '/company_qr/company12.png'

	if( empty($data) || empty($link)){
		echo 'error input';
		return false;
	}

	// CREATE GOOGLE LINK
	$width = 500;
	$height = 500;
	$google_root_link = 'https://chart.googleapis.com/chart?';
	$google_param_type = 'cht=qr';
	$google_param_size = 'chs='. $width.'x'.$height;
	$google_param_data = 'chl='.$data;
	$google_link = $google_root_link.
	               $google_param_type.
	               '&'.
	               $google_param_size.
	               '&'.
	               $google_param_data;



	// CREATE FILE, WHERE TO SAVE IMAGE
	$image_directory_root_link = $root_dir.'assets/images/qr_codes/' ;
	$link = ltrim($link, '/');
	$img_link = $image_directory_root_link.
	            $link;
	$img = fopen($img_link,'w');
	fclose($img);

	if( ! file_put_contents($img_link, file_get_contents($google_link)) ){
		flash()->error('QR image not created correctly');
		return false;
	}

	$img_link2 = '/assets/images/qr_codes/'.$link;
	return file_exists( $img_link ) ? $img_link2 : false;
}