<?php

require_once '../config.php';


	if( ! isset($_GET['cv_id']) || empty($_GET['cv_id']) ){
		flash()->error('Missing CV id in url.');
		redirect('/user/cvs');
	}
	$cv_id     = $_GET['cv_id'];

	$user         = get_user();
	$user_profile = get_user_profile( $user->id )[0];


	global $database;
	global $auth_config;

	$cv = $database->get('resumes',"user_id",['id'=> $cv_id]);

	if($cv === $user_profile['id'] ){
		$database->delete('resumes',['id'=> $cv_id]);
		flash()->success('CV deleted!');
	}else {
		flash()->error('CV not deleted!');
	}

redirect('/user/cvs');
