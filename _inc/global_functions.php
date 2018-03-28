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
	global $database;

	$job = $database->select("jobs","*",
								[ "id" => $id ]);

	if( ! $job ){
		return false;
	}

	return $job[0];

}
function get_company_profile($id){
	if( ! isset($id) || empty($id) ) {
		show_404();
	}

	global $database;
	global $auth_config;

	$company = $database->select($auth_config->table_company_profiles,"*" , [ "id" => $id ]);

	return $company ? $company[0] : $company;

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
 * Get public info of user
 *
 * @param $user_profile_id
 * @param $role
 *
 * @return bool | array
 */
function get_public_user_profile($user_profile_id,$role){
	global $auth_config;
	global $database;

	if($role === 'user' ){
		$table= $auth_config->table_user_profiles;
	}elseif ($role === 'company'){
		$table= $auth_config->table_company_profiles;
	}
	$user_profiles = $database->select($table, "*",[ "id" => $user_profile_id ]);

	if(!$user_profiles){
		return false;
	}

	return $user_profiles[0];
}


/**
 *
 * Get all jobs offered.
 **
 * @return array|bool
 */
function get_all_offered_jobs(){
	global $database;

	return $database->select('jobs',"*");
}

/**
 *
 * Get all jobs offered filtered
 **
 *
 * @param $category
 * @param $area
 *
 * @return array|bool
 */
function get_all_offered_jobs_filtered($category,$area){
	global $database;

	if( !empty($category) && !empty($area)){
		$return = $database->select('jobs',"*",['category'=>$category,'area'=>$area]);
	}elseif ( empty( $category ) && !empty($area) ) {
		$return =  $database->select( 'jobs', "*", [ 'area' => $area ] );
	} elseif( !empty( $category ) && empty($area) ) {
		$return =  $database->select( 'jobs', "*", [ 'category' => $category ] );
	}else{
		$return = $database->select( 'jobs', "*" );
	}

	return $return;
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
 * create link to QR code encoded to url.
 *
 * @param $type - type of QR code generated in ['job','user','company']
 * @param $id - id of selected type to be shown when scanned
 * @param string $more_params_formated - additional parameters to url correctly formated
 *
 * @return bool|string
 */
function createLinkToQR($type,$id,$more_params_formated = ''){

	$all_types = ['job','user','company'];
	if(empty($type) || empty($id) || !in_array($type,$all_types)){
		flash()->error('error input parameter swhen creating QR link');
		return false;
	}

	global $base_url;
	$result = $base_url.
	        '/public/page?page='.
	        $type.
	        '&'.
	        'id'.
	        '='.
	        $id;
	if($more_params_formated != ''){
		$more_params_formated = ltrim($more_params_formated,'&');
		$result = $result.'&'.$more_params_formated;
	}
	return urlencode($result);
}
/**
 *
 * Create qr
 *
 * @param $id - id of selected type to be shown when scanned
 * @param $type - type of created QR code from array ['job','user','company']
 * @param string $more_params - additional parameters to url correctly formated
 * @param $root_dir_path - path to root directory
 *
 * @return bool|string
 */
function createQR($type,$id,$root_dir_path = '../..',$more_params = ''){

	$all_types = ['job','user','company'];
	if( empty($id) || empty($type) || !in_array($type,$all_types)){
		flash()->error('error input parameters when creating QR');
		return false;
	}


	// CREATE GOOGLE LINK
	$width = 500;
	$height = 500;
	$google_root_link = 'https://chart.googleapis.com/chart?';
	$google_param_type = 'cht=qr';
	$google_param_size = 'chs='. $width.'x'.$height;
	$google_param_data = 'chl='.createLinkToQR($type,$id,$more_params);

	$google_link = $google_root_link.
	               $google_param_type.
	               '&'.
	               $google_param_size.
	               '&'.
	               $google_param_data;


	// CREATE FILE, WHERE TO SAVE IMAGE
	$root_dir_path = rtrim($root_dir_path,'/');
	$image_directory_root_link = $root_dir_path.'/assets/images/qr_codes/' ;
	$image_directory_relative_file_path = $type. '/'.$type.'_'.$id.'.png';
	$img_link_absolute = $image_directory_root_link.
	                     $image_directory_relative_file_path;


	$img = fopen($img_link_absolute,'w');
	fclose($img);

	if( ! file_put_contents($img_link_absolute, file_get_contents($google_link)) ){
		flash()->error('QR image not created correctly');
		return false;
	}

	$img_link_relative = '/assets/images/qr_codes/'.$image_directory_relative_file_path;
	return file_exists( $img_link_absolute ) ? $img_link_relative : false;
}

/**
 *  Register user CV to offered job
 *
 * @param $job_id
 * @param $cv_id
 *
 * @return bool
 */
function register_user_for_job($job_id,$cv_id){

	if( !isset($job_id) || empty($job_id) ||
	    !isset($cv_id) || empty($cv_id)
	){
		flash()->error('wrong parameters job_id or cv_id when connecting to DB.');
		return false;
	}

	// get job
	$job = get_job($_GET['job_id']);
	if(!$job){
		flash()->error('Job not found');
		return false;
	}

	// get resume;
	$user = get_user();
	$resume = get_user_cv($user->id,$_GET['cv_id']);
	if(!$user || !$resume) {
		flash()->error('USER or CV not found!');
		return false;
	}

	global $database;
	$users_before = $database->get('jobs',['users_registered'],['id'=>$job_id]);
	$users_before = $users_before['users_registered'];
	$users_before.= ','.$cv_id;
	$users_before = rtrim($users_before,',');
	$users_before = ltrim($users_before,',');
	$upd = $database->update('jobs',['users_registered'=> $users_before],['id'=>$job_id]);
	if(!$upd->rowCount()){
		return false;
	}else{
		return true;
	}
}