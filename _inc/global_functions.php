<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

function show_404(){
	header("HTTP/1.0 404 NOT FOUND");
	include_once "404.php";
	die();
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

function get_admin_profile($id){
	if( ! isset($id) || empty($id) ) {
		show_404();
	}

	global $database;
	global $auth_config;

	$company = $database->select($auth_config->table_admin_profiles,"*" , [ "id" => $id ]);

	return $company ? $company[0] : $company;

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

	//make_log("loggout");

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

	return ($auth->isUserLogged() || $auth->isCompanyLogged() || $auth->isAdminLogged());
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
 * Is company logged in?
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
 * Is admin logged in?
 *
 * returns true if user is logged in
 *
 * @return bool
 */
function is_admin_logged_in(){
	global $auth;

	return ($auth->isAdminLogged() );
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
 * Get user from users table
 *
 * @param $user_profile_id
 *
 * @return array|bool
 */
function get_user_of_user_profile($user_profile_id,$role = 'user'){

	global $database;
	global $auth;

	switch ($role){
		case 'company': $table='companies';break;
		case 'user': $table='users';break;
		default: return false;
	}
	$user = $database->select($table,'*',['active_profile'=>$user_profile_id]);

	return $user ? $user[0] : false;
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

	$all_types = ['job','user','company','admin'];
	if(empty($type) || empty($id) || !in_array($type,$all_types)){
		flash()->error('error 2 input parameters when creating QR link');
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


	$all_types = ['job','user','company','admin'];
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

	if(!is_logged_in()){
		flash()->error('Restricted - u are not logged in');
		return false;
	}

	if( !isset($job_id) || empty($job_id) ||
	    !isset($cv_id) || empty($cv_id)
	){
		flash()->error('wrong parameters job_id or cv_id when connecting to DB.');
		return false;
	}

	// get resume;
	$user = get_user();
	$resume = get_user_cv($user->id,$_GET['cv_id']);
	if(!$user || !$resume) {
		flash()->error('USER or CV not found!');
		return false;
	}
	$user_profile = get_user_profile($user->id)[0];

	// get job
	$job = get_job($_GET['job_id']);
	if(!$job){
		flash()->error('Job not found');
		return false;
	}

	global $database;
	$users_before = $database->get('jobs',['users_registered'],['id'=>$job_id]);
	$users_before = $users_before['users_registered'];
	//$users_before.= ',['.$user_profile['id'].'|'.$cv_id.']';
	$users_before.= ''.$cv_id;
	$users_before = rtrim($users_before,',');
	$users_before = ltrim($users_before,',');
	$upd = $database->update('jobs',['users_registered'=> $users_before],['id'=>$job_id]);
	if(!$upd->rowCount()){
		return false;
	}else{

		$company = get_company_profile($job['company_id']);
		if($job['send_email']){
			send_new_job_registration_email($company['email'].'',$job['title'],$user_profile['name'].' '.$user_profile['surname']);
		}

		make_log('user registered for job. job id:'.$job_id);
		return true;
	}
}

/**
 * Send email to company with new job registrant
 *
 * @param $job_email
 * @param $jobName
 * @param $registrantName
 */
function send_new_job_registration_email($job_email,$jobName,$registrantName){
	$mail = new PHPMailer(true);
	try {
		//Server settings
		$mail->SMTPDebug = 0;                                 // Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'jakub.vyskoc.tester@gmail.com';                 // SMTP username
		$mail->Password = 'Jakub9310027573';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		//Recipients
		$mail->setFrom('jakub.vyskoc.tester@gmail.com', 'JOBI');
		//$mail->addAddress('jakub.vyskoc@gmail.com', 'eng nav jakub');     // Add a recipient
		$mail->addAddress($job_email);               // Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		//Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = 'NEW JOB REGISTRANT';
		$mail->Body    = '<h2>You have new registrant</h2><p>Job:'.$jobName.'</p><p>Registrant:'.$registrantName.'</p><p>I wanted to send this to email:'.$job_email.'</p>';
		$mail->AltBody = 'You have new registrant for job:'.$jobName.'.Registrant name:'.$registrantName.'.';

		$mail->send();
		make_log('job registration email sent for job. recipient: '.$job_email.'. email text:'.$mail->Body);
	} catch (Exception $e) {
		echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	}

}
/**
 *
 * Get cv by id
 *
 * @param $cv_id
 *
 * @return bool|array
 */
function get_cv($cv_id){
	global $database;

	$cv = $database->select('resumes','*',['id'=>$cv_id]);

	return $cv ? $cv[0] : false;
}

function set_profile_photo($photo_link){
	global $database;
	global $auth;
	global $auth_config;

	$role = $auth->getRole();
	switch ($role){
		case 'company': $table=$auth_config->table_company_profiles;break;
		case 'user': $table=$auth_config->table_user_profiles;break;
		default: return false;
	}
	$user = get_user();
	$user_profile = get_user_profile($user->id)[0];

	$upd = $database->update($table,['photo_link'=>$photo_link],['id'=>$user_profile['id']]);

	if(!$upd->rowCount()){
		flash()->error('Photo link not updated.'.$user_profile['id'].$photo_link);
		return false;
	}

	make_log("profile photo changed to ".$photo_link);
	return true;
}

/**
 * Create a log
 *
 * @param $text
 *
 * @return bool
 */
function make_log($text){
	$user = get_user();
	$user_profile = get_user_profile($user->id)[0];

	global $database;
	global $auth;

	$log = $database->insert('logs',[
		'role' =>$auth->getRole(),
		'profile_id'=>$user_profile['id'],
		'log' => $text
	]);
	return $log ? true : false;
}

/**
 * Get text from $lang array by its key
 *
 * @param $str
 *
 * @return mixed
 */
function lang($str){
	global $lng;
	if ( isset($lng[$str]) && !empty($lng[$str]) ){
		return $lng[$str];
	}
	return $str;
}
